<?php

require_once __DIR__ . '/../core/config.php';


session_start();
$_SESSION = [
    'id'                  => 2,
    'name'                => 'John Doe',
    'email'               => 'john@example.com',
    'password'            => 'hashed_password_here',
    'streak'              => 5,
    'max_streak'          => 12,
    'points'              => 12124650,
    'last_week_points'    => 512,
    'sessions'            => 28,
    'achievements'        => 3,
    'achievements_points' => 150,
    'created_at'          => date('Y-m-d H:i:s')
];

// header('Content-Type: application/json');

// // Check login
// if (!isset($_SESSION['user_id'])) {
//     echo json_encode([
//         'error' => 'User not logged in'
//     ]);
//     exit;
// }

$user_id = $_SESSION['user_id'];

try {

    
    $pdo = new PDO(
        "mysql:host=localhost;dbname=wave",
        "root",
        ""
    );
    
    $stmt = $pdo->prepare("
        SELECT
            id,
            name,
            email,
            points,
            streak,
            sessions,
            created_at
        FROM users
        WHERE id = ?
    ");

    $stmt->execute([$user_id]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("
        SELECT
            COUNT(*) as total_sessions,
            SUM(length) as total_focus_time
        FROM sessions
        WHERE user_id = ?
    ");

    $stmt->execute([$user_id]);

    $session_stats = $stmt->fetch(PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare("
        SELECT
            COUNT(*) as total_quizzes,
            AVG(score) as avg_score,
            MAX(score) as highest_score
        FROM quizzes
        WHERE user_id = ?
    ");

    $stmt->execute([$user_id]);

    $quiz_stats = $stmt->fetch(PDO::FETCH_ASSOC);


    echo json_encode([
        'status' => 'success',

        'user' => $user,

        'session_stats' => [
            'total_sessions' =>
                $session_stats['total_sessions'] ?? 0,

            'total_focus_time' =>
                $session_stats['total_focus_time'] ?? 0,
        ],

        'quiz_stats' => [
            'total_quizzes' =>
                $quiz_stats['total_quizzes'] ?? 0,

            'avg_score' =>
                round($quiz_stats['avg_score'] ?? 0, 2),

            'highest_score' =>
                $quiz_stats['highest_score'] ?? 0,
        ],

        'friends' => [
            'total_friends' =>
                $friends['total_friends'] ?? 0,
        ]
    ]);

} catch (PDOException $e) {

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}