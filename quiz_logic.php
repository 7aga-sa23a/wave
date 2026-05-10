<?php
session_start();

include('connect.php');

if (isset($_SESSION['user_id'])) {
    $user_id            = $_SESSION['user_id'];
    $score              = $_GET['score'];
    $total_questions    = $_GET['total'];
    $answered_questions = $_GET['answered'];
    $time_seconds       = $_GET['time'];
} else {
    die("User not logged in.");
}

$score_percent = round(($score / $total_questions) * 100);
$length        = gmdate("H:i:s", $time_seconds);

$insert_query = "INSERT INTO quizzes (user_id, score, length, answered_questions, total_questions, date)";

if(mysqli_query($conn, $insert_query)) {
    echo "Quiz results saved successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
