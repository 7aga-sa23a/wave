<?php
// Make sure these constants match your server & MySQL configuration
$servername = "localhost";
$username = "root";
$password = ""; // Set to an empty string if no password has been set
$dbname = "wave";
$port = 3306;

// Create connection
try {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
} catch (Exception $e) {
    exit("" . $e->getMessage());
}

// Check connection
if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);
}
