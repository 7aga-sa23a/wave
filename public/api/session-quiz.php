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

function normalizeQuizQuestions(array $raw): array
{
    $out = [];
    foreach ($raw as $item) {
        if (!is_array($item)) {
            continue;
        }
        $text = isset($item["text"]) && is_string($item["text"]) ? trim($item["text"]) : "";
        $options = $item["options"] ?? null;
        if (!is_array($options)) {
            continue;
        }
        $opts = [];
        foreach ($options as $o) {
            if (is_string($o)) {
                $t = trim($o);
                if ($t !== "") {
                    $opts[] = $t;
                }
            }
        }
        if (count($opts) < 4) {
            continue;
        }
        $opts = array_slice($opts, 0, 4);
        $correct = $item["correct"] ?? 0;
        if (!is_int($correct) && !(is_string($correct) && ctype_digit($correct))) {
            $correct = 0;
        }
        $correct = (int) $correct;
        if ($correct < 0 || $correct > 3) {
            $correct = 0;
        }
        if (strlen($text) < 8) {
            continue;
        }
        $out[] = [
            "text" => strlen($text) > 500 ? substr($text, 0, 500) : $text,
            "options" => $opts,
            "correct" => $correct,
        ];
        if (count($out) >= 8) {
            break;
        }
    }
    return $out;
}

$apiKey = getApiKeyFromEnv();
if ($apiKey === "") {
    echo json_encode(["error" => "Missing OPENROUTER_API_KEY"]);
    exit;
}

$rawBody = file_get_contents("php://input");
$payload = json_decode($rawBody ?? "", true);
if (!is_array($payload)) {
    echo json_encode(["error" => "Invalid JSON body"]);
    exit;
}

$notes = is_array($payload["notes"] ?? null) ? $payload["notes"] : [];
$materials = is_array($payload["materials"] ?? null) ? $payload["materials"] : [];
$materialExcerpts = is_array($payload["materialExcerpts"] ?? null) ? $payload["materialExcerpts"] : [];
$chat = is_array($payload["chat"] ?? null) ? $payload["chat"] : [];
$summaryPoints = is_array($payload["summaryPoints"] ?? null) ? $payload["summaryPoints"] : [];
$elapsedSeconds = (int) ($payload["elapsedSeconds"] ?? 0);
$totalSessionMinutes = (int) ($payload["totalSessionMinutes"] ?? 25);

$notes = array_values(array_filter(array_map(static function ($n) {
    if (!is_string($n)) {
        return "";
    }
    $t = trim($n);
    return strlen($t) > 600 ? substr($t, 0, 600) : $t;
}, $notes)));

$materials = array_values(array_filter(array_map(static function ($m) {
    if (!is_string($m)) {
        return "";
    }
    $t = trim($m);
    return strlen($t) > 220 ? substr($t, 0, 220) : $t;
}, $materials)));

$summaryPoints = array_values(array_filter(array_map(static function ($s) {
    if (!is_string($s)) {
        return "";
    }
    $t = trim($s);
    return strlen($t) > 400 ? substr($t, 0, 400) : $t;
}, $summaryPoints)));

$excerptBlock = "";
$budget = 22000;
foreach ($materialExcerpts as $row) {
    if (!is_array($row)) {
        continue;
    }
    $name = isset($row["name"]) && is_string($row["name"]) ? trim($row["name"]) : "";
    $ex = isset($row["excerpt"]) && is_string($row["excerpt"]) ? trim($row["excerpt"]) : "";
    if ($name === "" && $ex === "") {
        continue;
    }
    if (strlen($ex) > 8000) {
        $ex = substr($ex, 0, 8000);
    }
    $chunk = "File: {$name}\nExcerpt:\n{$ex}\n---\n";
    if (strlen($chunk) > $budget) {
        $chunk = substr($chunk, 0, $budget);
    }
    $excerptBlock .= $chunk;
    $budget -= strlen($chunk);
    if ($budget < 500) {
        break;
    }
}
if ($excerptBlock === "") {
    $excerptBlock = "(No text excerpts available for binary files like PDF/Word; use file names, notes, chat, and summary.)";
}

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
    if (strlen($text) > 1000) {
        $text = substr($text, 0, 1000);
    }
    $chatLines[] = $role . ": " . $text;
}
$chatBlock = $chatLines !== [] ? implode("\n", $chatLines) : "(no chat)";

$notesBlock = $notes !== [] ? "- " . implode("\n- ", $notes) : "(no notes)";
$matBlock = $materials !== [] ? implode(", ", $materials) : "(no filenames)";
$summaryBlock = $summaryPoints !== [] ? "- " . implode("\n- ", $summaryPoints) : "(no summary yet)";
$minutesFocused = max(0, (int) round($elapsedSeconds / 60));

$userBlock = <<<TXT
Build a short multiple-choice quiz (English only) for this study session.

Session:
- Planned length: {$totalSessionMinutes} min, focused ~{$minutesFocused} min
- Material filenames: {$matBlock}
- Session summary points (from AI):
{$summaryBlock}
- User notes:
{$notesBlock}
- AI companion chat:
{$chatBlock}

Material text excerpts (when available):
{$excerptBlock}

Rules:
- Create exactly 5 questions.
- Each question: one clear question string, exactly 4 answer options, exactly one correct answer.
- Base questions on the summary, notes, chat, and excerpts when possible. If content is thin, ask practical study-skills questions still relevant to the session theme.
- Options should be distinct and plausible; correct index is 0-3.
- No emojis, no markdown.

Return STRICTLY a JSON array of 5 objects with this shape:
[{"text":"...","options":["","","",""],"correct":0}, ...]
No text outside the JSON array.
TXT;

$data = [
    "model" => "openrouter/free",
    "messages" => [
        [
            "role" => "system",
            "content" => "You output only valid JSON: an array of quiz objects with keys text, options (4 strings), correct (0-3). English only. No markdown.",
        ],
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
        "HTTP-Referer: http://localhost"
    ],
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_TIMEOUT => 90,
    CURLOPT_SSL_VERIFYPEER => false,
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
    echo json_encode(["error" => "No quiz content from model"]);
    exit;
}

$trimmed = trim($content);
if (preg_match('/\[[\s\S]*\]/u', $trimmed, $m)) {
    $trimmed = $m[0];
}

$arr = json_decode($trimmed, true);
if (!is_array($arr)) {
    echo json_encode(["error" => "Could not parse quiz JSON"]);
    exit;
}

$questions = normalizeQuizQuestions($arr);
if (count($questions) < 3) {
    echo json_encode(["error" => "Model returned too few valid questions"]);
    exit;
}

echo json_encode(["questions" => $questions], JSON_UNESCAPED_UNICODE);
