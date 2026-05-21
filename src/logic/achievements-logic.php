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
    SELECT 
        u.achievements,
        u.points,
        u.streak,
        u.sessions,

        COUNT(q.id) AS quizzes_passed,

        MAX(q.score) AS best_score,

        SUM(
            CASE 
                WHEN q.score = 100 THEN 1 
                ELSE 0 
            END
        ) AS perfect_scores

    FROM users u
    LEFT JOIN quizzes q 
        ON u.id = q.user_id

    WHERE u.id = ?
    GROUP BY u.id
");


$users->execute([$user_id]);
$users = $users->get_result()->fetch_assoc();


$data = $users;

$achievements = 0;
$achievement_points = 0;


  // First Step
    if ($users['sessions'] >= 1) {
        $achievements++;
        $achievement_points += 50;
    }

    // Week Warrior
    if ($users['streak'] >= 7) {
        $achievements++;
        $achievement_points += 100;
    }

    // Hot Streak
    if ($users['streak'] >= 15) {
        $achievements++;
        $achievement_points += 200;
    }

    // Diamond Streak
    if ($users['streak'] >= 30) {
        $achievements++;
        $achievement_points += 500;
    }

    // Legendary
    if ($users['streak'] >= 100) {
        $achievements++;
        $achievement_points += 2000;
    }


    // Point Starter
    if ($users['points'] >= 100) {
        $achievements++;
        $achievement_points += 50;
    }

    // Point Collector
    if ($users['points'] >= 1000) {
        $achievements++;
        $achievement_points += 100;
    }

    // Point Master
    if ($users['points'] >= 2500) {
        $achievements++;
        $achievement_points += 200;
    }

    // Point Champion
    if ($users['points'] >= 5000) {
        $achievements++;
        $achievement_points += 500;
    }

    // Point Legend
    if ($users['points'] >= 10000) {
        $achievements++;
        $achievement_points += 1000;
    }

    // Getting Started
    if ($users['sessions'] >= 5) {
        $achievements++;
        $achievement_points += 50;
    }

    // Dedicated Learner
    if ($users['sessions'] >= 25) {
        $achievements++;
        $achievement_points += 150;
    }

    // Focused Mind
    if ($users['sessions'] >= 50) {
        $achievements++;
        $achievement_points += 300;
    }

    // Knowledge Seeker
    if ($users['sessions'] >= 100) {
        $achievements++;
        $achievement_points += 600;
    }

    // Master Scholar
    if ($users['sessions'] >= 250) {
        $achievements++;
        $achievement_points += 1500;
    }


    // First Victory
    if ($users['quizzes_passed'] >= 1) {
        $achievements++;
        $achievement_points += 50;
    }

    // High Achiever
    if ($users['best_score'] >= 90) {
        $achievements++;
        $achievement_points += 100;
    }

    // Perfect Score
    if ($users['perfect_scores'] >= 1) {
        $achievements++;
        $achievement_points += 200;
    }

    // Consistency King
    if ($users['perfect_scores'] >= 10) {
        $achievements++;
        $achievement_points += 500;
    }

    // Quiz Master
    if ($users['perfect_scores'] >= 50) {
        $achievements++;
        $achievement_points += 2000;
    }

    $update = $conn->prepare("
        UPDATE users
        SET
            achievements = ?,
            achievements_points = ?
        WHERE id = ?
    ");

    $update->execute([
        $achievements,
        $achievement_points,
        $user_id
    ]);
?>



