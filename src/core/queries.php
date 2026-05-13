<?php
require_once __DIR__ . '/../../src/template/connect.php';

    // top performer
    $query = "SELECT name, last_week_points, streak FROM users ORDER BY last_week_points DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $top = mysqli_fetch_assoc($result);
    $nameParts = explode(" ", $top['name']);
    $initial = strtoupper($nameParts[0][0]);

    // leaderboard
    $lbQuery = "SELECT id, name, points, streak, sessions FROM users ORDER BY points DESC LIMIT 5";
    $lbResult = mysqli_query($conn, $lbQuery);
    $leaderboard = mysqli_fetch_all($lbResult, MYSQLI_ASSOC);
    $lbQuery = "SELECT u.id, u.name, u.points, u.streak, 
                COUNT(s.id) as sessions_count 
                FROM users u 
                LEFT JOIN sessions s ON u.id = s.user_id 
                GROUP BY u.id 
                ORDER BY u.points DESC 
                LIMIT 5";
    $lbResult = mysqli_query($conn, $lbQuery);
    $leaderboard = mysqli_fetch_all($lbResult, MYSQLI_ASSOC);

    // current user
    $currentUserQuery = "SELECT id, name, points, streak, sessions FROM users WHERE id = " . (int)$_SESSION['user_id'];
    $currentUserResult = mysqli_query($conn, $currentUserQuery);
    $currentUser = mysqli_fetch_assoc($currentUserResult);


    // User Rank 
    $rankQuery = "SELECT COUNT(*) + 1 as user_rank FROM users WHERE points > (SELECT points FROM users WHERE id = " . (int)$_SESSION['user_id'] . ")";
    $rankResult = mysqli_query($conn, $rankQuery);
    $rankRow = mysqli_fetch_assoc($rankResult);
    $userRank = $rankRow['user_rank'];

    // Points Diff
    $firstQuery = "SELECT points FROM users ORDER BY points DESC LIMIT 1";
    $firstResult = mysqli_query($conn, $firstQuery);
    $firstRow = mysqli_fetch_assoc($firstResult);
    $pointsDiff = $firstRow['points'] - $currentUser['points'];


    // Bar
    $maxPoints = $firstRow['points']; // 
    $progressPercent = $maxPoints > 0 ? round(($currentUser['points'] / $maxPoints) * 100) : 0;


    //  max sessions
    $maxSessionsQuery = "SELECT COUNT(id) as total FROM sessions WHERE user_id = (SELECT user_id FROM sessions GROUP BY user_id ORDER BY COUNT(id) DESC LIMIT 1)";
    $maxSessionsResult = mysqli_query($conn, $maxSessionsQuery);
    $maxSessionsRow = mysqli_fetch_assoc($maxSessionsResult);
    $maxSessions = $maxSessionsRow['total'] ?? 1;

    $userSessionsQuery = "SELECT COUNT(id) as total FROM sessions WHERE user_id = " . (int)$_SESSION['user_id'];
    $userSessionsResult = mysqli_query($conn, $userSessionsQuery);
    $userSessionsRow = mysqli_fetch_assoc($userSessionsResult);
    $userSessions = $userSessionsRow['total'];

    $sessionsPercent = $maxSessions > 0 ? round(($userSessions / $maxSessions) * 100) : 0;

    // max sessions in week
    $bestWeekQuery = "SELECT MAX(weekly_count) as best FROM (SELECT WEEK(date) as week, COUNT(id) as weekly_count FROM sessions WHERE user_id = " . (int)$_SESSION['user_id'] . " GROUP BY WEEK(date)) as weeks";
    $bestWeekResult = mysqli_query($conn, $bestWeekQuery);
    $bestWeekRow = mysqli_fetch_assoc($bestWeekResult);
    $bestWeek = $bestWeekRow['best'] ?? 0;

    // sessions of the week
    $thisWeekQuery = "SELECT COUNT(id) as total FROM sessions WHERE user_id = " . (int)$_SESSION['user_id'] . " AND WEEK(date) = WEEK(NOW())";
    $thisWeekResult = mysqli_query($conn, $thisWeekQuery);
    $thisWeekRow = mysqli_fetch_assoc($thisWeekResult);
    $thisWeekSessions = $thisWeekRow['total'];

    $sessionsNeeded = max(0, $bestWeek - $thisWeekSessions + 1);
?>