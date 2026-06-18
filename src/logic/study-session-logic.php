<?php
require_once __DIR__ . '/../core/config.php'; # Paths
require_once __DIR__ . '/../core/connect.php'; # Database connector

# Start the session to load the $_SESSION array
session_start();

# If session is not started, redirect to login page
if (!isset($_SESSION['id'])) {
    # FOR TESTING
    # # starting a dump session    
    // session_start();
    // $_SESSION = [
    //     'id'                  => 2,
    //     'name'                => 'John Doe',
    //     'email'               => 'john@example.com',
    //     'password'            => 'hashed_password_here',
    //     'streak'              => 5,
    //     'max_streak'          => 12,
    //     'points'              => 12124650,
    //     'last_week_points'    => 512,
    //     'sessions'            => 28,
    //     'achievements'        => 3,
    //     'achievements_points' => 150,
    //     'created_at'          => date('Y-m-d H:i:s')
    // ];

    require __DIR__ .  "/../templates/signIn.php";
    exit();
}

/*************************************************************************************************/

# Add last 7 days sessions count to active session
# # Start date and end date
$now = date('Y-m-d H-i-s');

# # Get date 7 days ago
$seven_days_ago = date('Y-m-d H:i:s', strtotime('-7 days'));

# # Execute query
$result = $conn->prepare("SELECT * FROM sessions WHERE user_id = ? AND date BETWEEN ? AND ?");
$result->execute([$_SESSION['id'], $seven_days_ago, $now]);

# # Number of sessions found
$this_week_sessions = [];
$sessions = $result->get_result();
while ($session = $sessions->fetch_assoc()) {
    array_push($this_week_sessions, $session);
}

$this_week_sessions_count = count($this_week_sessions);

# # Update session to include this week's sessions count
$_SESSION['this_week_sessions_count'] = $this_week_sessions_count;

/*************************************************************************************************/

# Add increased focus time percentage to active session
# # Calculate last week's completed sessions count
# # # Start date and end date
# # # # Get date 14 days ago
$fourteen_days_ago = date('Y-m-d H:i:s', strtotime('-14 days'));

# # # Execute query
$result = $conn->prepare("SELECT * FROM sessions WHERE user_id = ? AND date BETWEEN ? AND ?");

if (!$result) {
    exit("Error: " . $conn->error);
}

$result->execute([$_SESSION['id'], $fourteen_days_ago, $seven_days_ago]);

if (!$result) {
    exit("Error: " . $conn->error);
}

# # # Number of sessions found last week
$last_week_sessions = [];
$sessions = $result->get_result();
while ($session = $sessions->fetch_assoc()) {
    array_push($last_week_sessions, $session);
}

# # Calculate the percentage
# # # Total focus time this week
$this_week_focus_time = 0;
foreach ($this_week_sessions as $session) {
    $this_week_focus_time += timeToSeconds($session['length']);
}

# # # Total focus time last week
$last_week_focus_time = 0;
foreach ($last_week_sessions as $session) {
    $last_week_focus_time += timeToSeconds($session['length']);
}

# # Calculate percentage
# # # Avoid division by zero
if ($last_week_focus_time == 0) {
    $focus_time_percentage = 0;
} else {
    $focus_time_percentage = round(($this_week_focus_time - $last_week_focus_time) / $last_week_focus_time * 100);
}

# # Update session to include focus time percentage
$_SESSION['focus_time_percentage'] = $focus_time_percentage;

/*************************************************************************************************/

# Add the circle leaderboard to active session
$circle_leaderboard = [];

# # Get user friends's data
$user_friends_sql = $conn->prepare("SELECT sender_id, receiver_id FROM friends WHERE (sender_id = ? OR receiver_id = ?) AND status = 1");
$user_friends_sql->execute([$_SESSION['id'], $_SESSION['id']]);

if (!$user_friends_sql) {
    exit("Error: " . $conn->error);
}

$user_friends = $user_friends_sql->get_result();

$user_friends_ids = [];
while ($friends = $user_friends->fetch_assoc()) {
    array_push($user_friends_ids, $friends['sender_id']);
    array_push($user_friends_ids, $friends['receiver_id']);
}

# # Check if user has no friends
if (count($user_friends_ids) == 0) {
    array_push($user_friends_ids, $_SESSION['id']);
}

$user_friends_ids = array_values(array_unique($user_friends_ids));

# # Get user friends's data
$placeholders = implode(',', array_fill(0, count($user_friends_ids), '?')); # Translates to "?, ?, ?, ..."

$user_friends_data_sql = $conn->prepare("SELECT id, name, points, streak FROM users WHERE id IN ($placeholders) ORDER BY points DESC, streak DESC");
$user_friends_data_sql->execute($user_friends_ids);

if (!$user_friends_data_sql) {
    exit("Error: " . $conn->error);
}

$user_friends_data = $user_friends_data_sql->get_result();

while ($friends_data = $user_friends_data->fetch_assoc()) {
    array_push($circle_leaderboard, $friends_data);
}

# # Store in session
$_SESSION['circle_leaderboard'] = $circle_leaderboard;

/*************************************************************************************************/

/**
 * Converts TIMESTAMP to seconds for easier calculations
 */
function timeToSeconds(string $time)
{
    # Split time into hours, minutes and seconds
    $parts = explode(':', $time);
    $hours = $parts[0];
    $minutes = $parts[1];
    $seconds = $parts[2];

    # Convert to seconds
    return ((int) $hours * 3600) + ((int) $minutes * 60) + ((int) $seconds);
}

/*************************************************************************************************/
