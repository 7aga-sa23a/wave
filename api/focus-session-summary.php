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

    $envPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . ".env";
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

function normalizeHighlights(mixed $raw): array
{
    if (!is_array($raw)) {
        return [];
    }
    $out = [];
    foreach ($raw as $row) {
        if (!is_array($row)) {
            continue;
        }
        $title = isset($row["title"]) && is_string($row["title"]) ? trim($row["title"]) : "";
        $text = isset($row["text"]) && is_string($row["text"]) ? trim($row["text"]) : "";
        if ($title === "" && $text === "") {
            continue;
        }
        if ($title === "") {
            $title = "Highlight";
        }
        if (strlen($title) > 120) {
            $title = substr($title, 0, 120);
        }
        if (strlen($text) > 900) {
            $text = substr($text, 0, 900);
        }
        $out[] = ["title" => $title, "text" => $text];
        if (count($out) >= 10) {
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

$lang = isset($payload["language"]) && is_string($payload["language"])
    ? strtolower(trim($payload["language"]))
    : "english";
if ($lang !== "arabic") {
    $lang = "english";
}

$notes = is_array($payload["notes"] ?? null) ? $payload["notes"] : [];
$materials = is_array($payload["materials"] ?? null) ? $payload["materials"] : [];
$materialExcerpts = is_array($payload["materialExcerpts"] ?? null) ? $payload["materialExcerpts"] : [];
$chat = is_array($payload["chat"] ?? null) ? $payload["chat"] : [];

$notes = array_values(array_filter(array_map(static function ($n) {
    if (!is_string($n)) {
        return "";
    }
    $t = trim($n);
    return strlen($t) > 700 ? substr($t, 0, 700) : $t;
}, $notes)));

$materials = array_values(array_filter(array_map(static function ($m) {
    if (!is_string($m)) {
        return "";
    }
    $t = trim($m);
    return strlen($t) > 200 ? substr($t, 0, 200) : $t;
}, $materials)));

$excerptBlock = "";
$budget = 20000;
foreach ($materialExcerpts as $row) {
    if (!is_array($row)) {
        continue;
    }
    $name = isset($row["name"]) && is_string($row["name"]) ? trim($row["name"]) : "";
    $ex = isset($row["excerpt"]) && is_string($row["excerpt"]) ? trim($row["excerpt"]) : "";
    if ($name === "" && $ex === "") {
        continue;
    }
    if (strlen($ex) > 7000) {
        $ex = substr($ex, 0, 7000);
    }
    $chunk = "File: {$name}\n{$ex}\n---\n";
    if (strlen($chunk) > $budget) {
        $chunk = substr($chunk, 0, $budget);
    }
    $excerptBlock .= $chunk;
    $budget -= strlen($chunk);
    if ($budget < 400) {
        break;
    }
}
if ($excerptBlock === "") {
    $excerptBlock = "(No plain-text excerpts in browser; PDF/Word are filenames only.)";
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
    if (strlen($text) > 1200) {
        $text = substr($text, 0, 1200);
    }
    $chatLines[] = $role . ": " . $text;
}
$chatBlock = $chatLines !== [] ? implode("\n", $chatLines) : "(no AI chat in this session)";

$notesBlock = $notes !== [] ? "- " . implode("\n- ", $notes) : "(no session notes)";
$matBlock = $materials !== [] ? implode(", ", $materials) : "(no files listed)";

$langRules = $lang === "arabic"
    ? "Output language: Egyptian Arabic (العامية المصرية) for educational tone. No English in the JSON values."
    : "Output language: clear, concise English suitable for study notes.";

$userBlock = <<<TXT
You are helping a student with a structured session recap.

{$langRules}

Inputs:
- Uploaded file names: {$matBlock}
- Session notes:
{$notesBlock}
- Plain-text excerpts from materials (when available):
{$excerptBlock}
- AI companion conversation:
{$chatBlock}

Method (follow this structure in your writing):
1) Overview: 2–3 sentences that state what this session was mainly about and who it helps.
2) Highlights: 5–7 short themed blocks. Each block has a bold-worthy short title (3–8 words) and 2–4 sentences explaining the idea, why it matters, or how to remember it. Ground content in excerpts, notes, or chat when possible; if data is thin, give honest, useful study guidance tied to the file names or session theme.
3) Session bridge: 1–2 sentences linking their notes/chat to the materials (or suggesting a next step).

Return STRICTLY one JSON object (no markdown, no extra text) with this exact shape:
{
  "overview": "string",
  "highlights": [
    {"title": "string", "text": "string"}
  ],
  "session_bridge": "string"
}

Rules: no emojis; "highlights" must have between 5 and 7 items; titles must be unique when possible.
TXT;

$data = [
    "model" => "openrouter/free",
    "messages" => [
        [
            "role" => "system",
            "content" => "You reply with only valid JSON objects for study summaries. No markdown fences. No emojis.",
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
    ],
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_TIMEOUT => 90,
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
$trimmed = preg_replace('/^```(?:json)?\s*/i', '', $trimmed);
$trimmed = preg_replace('/\s*```\s*$/', '', $trimmed);

if (preg_match('/\{[\s\S]*\}/u', $trimmed, $m)) {
    $trimmed = $m[0];
}

$obj = json_decode($trimmed, true);

// Fallback: legacy flat array of strings
if (!is_array($obj)) {
    if (preg_match('/\[[\s\S]*\]/u', $content, $am)) {
        $arr = json_decode($am[0], true);
        if (is_array($arr) && $arr !== []) {
            $obj = [
                "overview" => $lang === "arabic"
                    ? "ده ملخص سريع لنقاط الجلسة."
                    : "Here is a quick recap of your session points.",
                "highlights" => [],
                "session_bridge" => "",
            ];
            foreach ($arr as $i => $line) {
                if (!is_string($line) || trim($line) === "") {
                    continue;
                }
                $line = trim($line);
                $words = preg_split('/\s+/', $line, 6);
                $shortTitle = count($words) >= 3
                    ? implode(" ", array_slice($words, 0, 3))
                    : "Point " . ($i + 1);
                $obj["highlights"][] = ["title" => $shortTitle, "text" => $line];
            }
        }
    }
}

if (!is_array($obj)) {
    echo json_encode(["error" => "Could not parse summary JSON"]);
    exit;
}

$overview = isset($obj["overview"]) && is_string($obj["overview"]) ? trim($obj["overview"]) : "";
$sessionBridge = isset($obj["session_bridge"]) && is_string($obj["session_bridge"])
    ? trim($obj["session_bridge"])
    : "";
$highlights = normalizeHighlights($obj["highlights"] ?? []);

if ($overview === "" && $highlights === []) {
    echo json_encode(["error" => "Empty summary from model"]);
    exit;
}

if (strlen($overview) > 1200) {
    $overview = substr($overview, 0, 1200);
}
if (strlen($sessionBridge) > 500) {
    $sessionBridge = substr($sessionBridge, 0, 500);
}

echo json_encode([
    "overview" => $overview,
    "highlights" => $highlights,
    "session_bridge" => $sessionBridge,
    "language" => $lang,
], JSON_UNESCAPED_UNICODE);
