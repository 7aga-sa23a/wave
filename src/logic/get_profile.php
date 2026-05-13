<?php
require_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/connect.php';

session_start();

/* FAKE SESSION */
/*$_SESSION = [
    'user_id' => 2,
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'hashed_password_here',
    'streak' => 5,
    'max_streak' => 12,
    'points' => 12124650,
    'last_week_points' => 512,
    'sessions' => 28,
    'achievements' => 3,
    'achievements_points' => 150,
    'created_at' => date('Y-m-d H:i:s')
];*/

header('Content-Type: application/json');

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'error' => 'User not logged in'
    ]);
    exit;
}


// fetch the data from the database based on the logged-in user
$user_id = $_SESSION['user_id'];
$users = $conn->prepare("
    SELECT id, name, email, points, streak, sessions, created_at
    FROM users
    WHERE id = ?
");

$users->execute([$user_id]);
$users = $users->get_result()->fetch_assoc();

// Fetch session stats
$session_stats = $conn->prepare("
    SELECT
        COUNT(*) as total_sessions,
        SUM(length) as total_focus_time,
        MAX(date) as last_session
    FROM sessions
    WHERE user_id = ?
");

$session_stats->execute([$user_id]);
$session_stats = $session_stats->get_result()->fetch_assoc();


// Helper function to convert date to "time ago" format
function timeAgo($date)
{

    if (!$date) {
        return "No sessions yet";
    }

    $created = new DateTime($date);
    $now = new DateTime();

    $diff = $created->diff($now);

    if ($diff->days == 0) {
        return "Today";
    }

    if ($diff->days == 1) {
        return "Yesterday";
    }

    return $diff->days . " days ago";
}

$timeago = timeAgo($session_stats['last_session'] ?? null);

// Fetch quiz stats
$quiz = $conn->prepare("
    SELECT
    AVG(score) as avg_score,
    MAX(score) as max_score,
    (
        SELECT date
        FROM quizzes
        WHERE user_id = ?
        ORDER BY score DESC, date DESC
        LIMIT 1
    ) as max_score_date
FROM quizzes
WHERE user_id = ?
");

$quiz->bind_param("ii", $user_id, $user_id);
$quiz->execute();
$quiz_stats = $quiz->get_result()->fetch_assoc();

$quiztimeago = timeAgo($quiz_stats['max_score_date'] ?? null);  


// Calculate user rank and top percentage
/*
1. Get the user's points from the session or database.
2. count the total number of users.
3. count how many users have more points than the current user.
4. Calculate the user's rank as (number of users with more points) + 1.
5. Calculate the top percentage as (user's rank / total users) * 100.
*/ 
$user_points = $users['points']; 
$total_users_query = $conn->query(" 
    SELECT COUNT(*) as total
    FROM users
");

$total_users = $total_users_query
    ->fetch_assoc()['total'];

$rank_query = $conn->prepare("
    SELECT COUNT(*) + 1 as user_rank
    FROM users
    WHERE points > ?
");

$rank_query->bind_param("i", $user_points);
$rank_query->execute();

$user_rank = $rank_query
    ->get_result()
    ->fetch_assoc()['user_rank'];

$top_percent = ($user_rank / $total_users) * 100;