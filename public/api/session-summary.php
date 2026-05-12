<?php

declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
    exit;
}

function getApiKeyFromEnv(): string
{
    $directKey = getenv("OPENROUTER_API_KEY");
    if (!empty($directKey)) {
        return $directKey;
    }

    $envPath = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . ".env";
    if (!file_exists($envPath)) {
        return "";
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return "";
    }

    foreach ($lines as $line) {
        $trimmed = trim($line);
        if ($trimmed === "" || str_starts_with($trimmed, "#")) {
            continue;
        }

        $parts = explode("=", $trimmed, 2);
        if (count($parts) !== 2) {
            continue;
        }

        $key = trim($parts[0]);
        $value = trim($parts[1], " \t\n\r\0\x0B\"'");

        if ($key === "OPENROUTER_API_KEY" && $value !== "") {
            return $value;
        }
    }

    return "";
}

$apiKey = getApiKeyFromEnv();
if ($apiKey === "") {
    echo json_encode(["error" => "Missing OPENROUTER_API_KEY"]);
    exit;
}

$raw = file_get_contents("php://input");
$payload = json_decode($raw ?? "", true);
if (!is_array($payload)) {
    echo json_encode(["error" => "Invalid JSON body"]);
    exit;
}

$notes = $payload["notes"] ?? [];
$materials = $payload["materials"] ?? [];
$materialExcerpts = $payload["materialExcerpts"] ?? [];
$chat = $payload["chat"] ?? [];
$elapsedSeconds = (int) ($payload["elapsedSeconds"] ?? 0);
$totalSessionMinutes = (int) ($payload["totalSessionMinutes"] ?? 25);

if (!is_array($notes)) {
    $notes = [];
}
if (!is_array($materials)) {
    $materials = [];
}
if (!is_array($materialExcerpts)) {
    $materialExcerpts = [];
}
if (!is_array($chat)) {
    $chat = [];
}

$notes = array_values(array_filter(array_map(static function ($n) {
    if (!is_string($n)) {
        return "";
    }
    $t = trim($n);
    return strlen($t) > 500 ? substr($t, 0, 500) : $t;
}, $notes)));

$materials = array_values(array_filter(array_map(static function ($m) {
    if (!is_string($m)) {
        return "";
    }
    $t = trim($m);
    return strlen($t) > 200 ? substr($t, 0, 200) : $t;
}, $materials)));

$chatLines = [];
foreach ($chat as $row) {
    if (!is_array($row)) {
        continue;
    }
    $role = isset($row["role"]) && is_string($row["role"]) ? $row["role"] : "user";
    $text = isset($row["text"]) && is_string($row["text"]) ? trim($row["text"]) : "";
    if ($text === "") {
        continue;
    }
    if (strlen($text) > 1200) {
        $text = substr($text, 0, 1200);
    }
    $chatLines[] = $role . ": " . $text;
}
$chatBlock = $chatLines !== [] ? implode("\n", $chatLines) : "(no chat messages)";

$notesBlock = $notes !== [] ? "- " . implode("\n- ", $notes) : "(no notes saved)";
$matBlock = $materials !== [] ? implode(", ", $materials) : "(no material filenames)";

$excerptBlock = "";
$exBudget = 12000;
foreach ($materialExcerpts as $row) {
    if (!is_array($row)) {
        continue;
    }
    $name = isset($row["name"]) && is_string($row["name"]) ? trim($row["name"]) : "";
    $ex = isset($row["excerpt"]) && is_string($row["excerpt"]) ? trim($row["excerpt"]) : "";
    if ($name === "" && $ex === "") {
        continue;
    }
    if (strlen($ex) > 6000) {
        $ex = substr($ex, 0, 6000);
    }
    $chunk = "File: {$name}\n{$ex}\n---\n";
    if (strlen($chunk) > $exBudget) {
        $chunk = substr($chunk, 0, $exBudget);
    }
    $excerptBlock .= $chunk;
    $exBudget -= strlen($chunk);
    if ($exBudget < 300) {
        break;
    }
}
if ($excerptBlock === "") {
    $excerptBlock = "(No plain-text excerpts; PDF/Word content is not extracted in the browser.)";
}

$minutesFocused = max(0, (int) round($elapsedSeconds / 60));

$userBlock = <<<TXT
Session context for summarization:
- Planned session length: {$totalSessionMinutes} minutes
- Approximate focused time: {$minutesFocused} minutes (from timer)
- Study material files: {$matBlock}
- User notes:
{$notesBlock}

Material excerpts (text files only):
{$excerptBlock}

AI companion chat excerpt:
{$chatBlock}

Task: Write a SIMPLE short summary of this study session in clear English. Exactly 5 bullet points. Each point is one short sentence (about 20 words max). Focus on what they studied, note themes, or chat topics when available; if information is thin, give brief, practical study tips that still fit the session. No emojis, no markdown.

Return STRICTLY a JSON array of exactly 5 strings, for example: ["First point...", "Second point..."]. No other text outside the JSON.
TXT;

$systemPrompt = "You output only valid JSON arrays of English strings for educational session summaries. Never use emojis or markdown.";

$data = [
    "model" => "openrouter/free",
    "messages" => [
        ["role" => "system", "content" => $systemPrompt],
        ["role" => "user", "content" => $userBlock],
    ],
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://openrouter.ai/api/v1/chat/completions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $apiKey,
        "Content-Type: application/json",
    ],
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_TIMEOUT => 60,
]);

$response = curl_exec($ch);
$curlErr = curl_error($ch);
curl_close($ch);

if ($response === false || $response === "") {
    echo json_encode(["error" => "API request failed: " . ($curlErr ?: "empty response")]);
    exit;
}

$decoded = json_decode($response, true);
if (!is_array($decoded)) {
    echo json_encode(["error" => "Invalid API response"]);
    exit;
}

if (isset($decoded["error"])) {
    echo json_encode(["error" => is_string($decoded["error"]) ? $decoded["error"] : json_encode($decoded["error"])]);
    exit;
}

$content = $decoded["choices"][0]["message"]["content"] ?? "";
if (!is_string($content) || $content === "") {
    echo json_encode(["error" => "No summary content from model"]);
    exit;
}

$trimmed = trim($content);
$match = preg_match('/\[[\s\S]*\]/u', $trimmed, $m);
if ($match) {
    $trimmed = $m[0];
}

$points = json_decode($trimmed, true);
if (!is_array($points)) {
    $lines = preg_split('/\R+/', $content);
    $points = [];
    foreach ($lines as $line) {
        $line = trim(preg_replace('/^[-*\d.]+\s*/u', '', $line));
        if (strlen($line) > 5) {
            $points[] = $line;
        }
    }
}

$points = array_values(array_filter(array_map(static function ($p) {
    return is_string($p) ? trim($p) : "";
}, $points)));

if (count($points) === 0) {
    echo json_encode(["error" => "Could not parse summary points"]);
    exit;
}

$points = array_slice($points, 0, 6);

echo json_encode(["points" => $points], JSON_UNESCAPED_UNICODE);
