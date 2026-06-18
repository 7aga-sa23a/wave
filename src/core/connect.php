<?php
# Make sure these constants match your server & MySQL configuration
# DON'T CHANGE THE VALUES HERE
# ONLY MAKE YOUR LOCAL DATABASE CONFIGURATION ADAPT TO THESE VALUES

$servername = "localhost";
$username = "root";
$password = ""; # Set to an empty string if no password has been set
$dbname = "wave";
$port = 3306;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
