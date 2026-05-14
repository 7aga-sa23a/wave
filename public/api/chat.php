<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

$userMessage = $_POST['message'] ?? '';

if(empty($userMessage)){

    echo json_encode([
        "error" => "No message"
    ]);

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
if (empty($apiKey)) {
    echo json_encode([
        "error" => "Missing OPENROUTER_API_KEY. Add it to .env file."
    ]);
    exit;
}

$systemPrompt = "
You are Zazou3 AI.

Your name is زعزوع.

You are STRICTLY an educational AI assistant.

You ONLY respond to:
- studying
- education
- school subjects
- university subjects
- programming
- coding
- productivity
- summaries
- quizzes
- learning

If the user asks anything unrelated to education or programming:
- refuse directly
- do NOT answer the question
- do NOT give partial help
- do NOT explain unrelated topics

For unrelated topics reply ONLY with:
'انا زعزوع ومقدرش اساعد غير في الدراسة والبرمجة.'

If someone says:
- اهلا
- سلام
- hello
- hi
- who are you
- انت مين

Reply ONLY with:
'اهلا انا زعزوع مساعدك الذكي للدراسة والبرمجة.'

Rules:
- NEVER use emojis
- NEVER use markdown formatting
- NEVER use lists unless requested
- Speak in Egyptian Arabic
- Keep responses clean and short
";

$data = [
    "model" => "openrouter/free",
    "messages" => [
        [
            "role" => "system",
            "content" => $systemPrompt
        ],
        [
            "role" => "user",
            "content" => $userMessage
        ]
    ]
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
    CURLOPT_SSL_VERIFYPEER => false

]);

$response = curl_exec($ch);

curl_close($ch);

echo $response;