<?php
$data = json_encode([
    "notes" => ["Note 1", "Note 2"],
    "materials" => ["file1.txt"],
    "chat" => [["role" => "user", "text" => "hi"]],
    "elapsedSeconds" => 600,
    "totalSessionMinutes" => 25
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/public/api/session-summary.php");
// If the server is not running on 8000, we can just execute the script using include
?>
