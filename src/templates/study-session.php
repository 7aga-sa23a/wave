<?php
require_once __DIR__ . '/../core/config.php';
require_once __DIR__ .  '/../dashboard/study-session-logic.php';
require_once __DIR__ . '/paths.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>study session</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/styles3.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/navbar.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/navbarsticky.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/footer.css" />
    <script src="<?= JS_URL ?>/auth.js"></script>
</head>

<body>
    <div id="navbar"></div>
    <script src="<?= COMPONENTS_URL ?>/navbar.js?v=4"></script>
    <section class="section1">
        <section class="dashboard">
            <section class="study-session">
                <div class="head">
                    <h1>Welcome back!</h1>
                    <p>Ready to continue your learning journey?</p>
                </div>
                <div class="session">
                    <div>
                        <h2>Start Study Session</h2>
                        <p>Begin a focused study session and track your progress</p>
                    </div>
                    <div>
                        <button onclick="window.location.href='<?= TEMPLATES_URL ?>/uploading-material.php'">Start Session</button>
                    </div>
                </div>
                <div class="points-score-container">
                    <div class="score-days-container">
                        <div class="score-days-inner">
                            <div class="score-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-flame">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 10.941c2.333 -3.308 .167 -7.823 -1 -8.941c0 3.395 -2.235 5.299 -3.667 6.706c-1.43 1.408 -2.333 3.294 -2.333 5.588c0 3.704 3.134 6.706 7 6.706c3.866 0 7 -3.002 7 -6.706c0 -1.712 -1.232 -4.403 -2.333 -5.588c-2.084 3.353 -3.257 3.353 -4.667 2.235" />
                                </svg>
                            </div>
                            <div>
                                <h2><?= $_SESSION['streak'] ?></h2>
                                <p><?= $_SESSION['streak'] == 1 ? 'day' : 'days' ?></p>
                            </div>
                        </div>
                        <div class="current-streak">
                            <h2>Current Streak</h2>
                            <p>Keep it going! You're on fire</p>
                        </div>
                    </div>
                    <div class="score-days-container">
                        <div class="score-days-inner">
                            <div class="score-svg2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245" />
                                </svg>
                            </div>
                            <div>
                                <h2><?= number_format($_SESSION['points'], 0, '.', ',') ?></h2>
                                <p>Total Points</p>
                            </div>
                        </div>
                        <div class="current-streak">
                            <h2>Points Earned</h2>
                            <p><span><?= number_format($_SESSION['last_week_points'], 0, '.', ',') ?></span> points this week</p>
                        </div>
                    </div>
                </div>
                <div class="daily-insight">
                    <div class="svg3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sparkles">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M16 18a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2m0 -12a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2m-7 12a6 6 0 0 1 6 -6a6 6 0 0 1 -6 -6a6 6 0 0 1 -6 6a6 6 0 0 1 6 6" />
                        </svg>
                    </div>
                    <div class="insight-text">
                        <h2>Daily insight</h2>
                        <p>You've completed <span><?= $_SESSION['this_week_sessions_count'] ?></span> study sessions this week!
                            <?php
                            if ($_SESSION['focus_time_percentage'] > 0) {
                                echo "Your focus time has increased by {$_SESSION['focus_time_percentage']}% compared to last week. Keep up the excellent work!";
                            } else if ($_SESSION['focus_time_percentage'] < 0) {
                                echo "Your focus time has decreased by {$_SESSION['focus_time_percentage']}% compared to last week. Time to focus!";
                            } else {
                                echo "Your focus time has not changed compared to last week. You really take consistency seriously!";
                            }
                            ?></p>
                    </div>
                </div>
            </section>
            <section class="circle-card">
                <div class="circle-header">
                    <h2>Your Circle</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 17l6 -6l4 4l8 -8" />
                        <path d="M14 7l7 0l0 7" />
                    </svg>
                </div>

                <!-- person -->
                <?php
                foreach ($_SESSION['circle_leaderboard'] as $rank => $person) {
                    // Check if the person is the current user
                    if ($person['id'] == $_SESSION['id']) {
                        echo '<div class="person active">';
                        echo '<p class="rank">' . '#' . ($rank + 1) . '</p>';
                        echo '<div class="avatar purple">' . strtoupper($person['name'][0]) . '</div>';
                        echo '<div class="person-info">';
                        echo '    <h3>You</h3>';
                        echo '    <div class="details">';
                        echo '    <span> <svg class="star-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-flame"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 10.941c2.333 -3.308 .167 -7.823 -1 -8.941c0 3.395 -2.235 5.299 -3.667 6.706c-1.43 1.408 -2.333 3.294 -2.333 5.588c0 3.704 3.134 6.706 7 6.706c3.866 0 7 -3.002 7 -6.706c0 -1.712 -1.232 -4.403 -2.333 -5.588c-2.084 3.353 -3.257 3.353 -4.667 2.235" /></svg>' . $person['points'] . '</span>';
                        echo '    <span><svg class="fire-icon"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">';
                        echo '                <path stroke="none" d="M0 0h24v24H0z" fill="none" />';
                        echo '                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245" />';
                        echo '            </svg>' . $person['streak'] . 'd' . '</span>';
                        echo '    </div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    # Not the current user
                    else {
                        echo '<div class="person">';
                        echo '<p class="rank">' . '#' . ($rank + 1) . '</p>';
                        echo '<div class="avatar">' . strtoupper($person['name'][0]) . '</div>';
                        echo '<div class="person-info">';
                        echo '    <h3>' . $person['name'] . '</h3>';
                        echo '    <div class="details">';
                        echo '    <span> <svg class="star-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-flame"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 10.941c2.333 -3.308 .167 -7.823 -1 -8.941c0 3.395 -2.235 5.299 -3.667 6.706c-1.43 1.408 -2.333 3.294 -2.333 5.588c0 3.704 3.134 6.706 7 6.706c3.866 0 7 -3.002 7 -6.706c0 -1.712 -1.232 -4.403 -2.333 -5.588c-2.084 3.353 -3.257 3.353 -4.667 2.235" /></svg>' . $person['points'] . '</span>';
                        echo '    <span><svg class="fire-icon"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">';
                        echo '                <path stroke="none" d="M0 0h24v24H0z" fill="none" />';
                        echo '                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245" />';
                        echo '            </svg>' . $person['streak'] . 'd' . '</span>';
                        echo '    </div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>

                <button class="circle-btn" onclick="window.location.href='<?= TEMPLATES_URL ?>/Circle.php'">View Full Circle</button>
            </section>
        </section>
        <div id="footer"></div>
        <script src=\"<?= JS_URL ?>/script.js\"></script>
        <script src="<?= COMPONENTS_URL ?>/footer.js"></script>
        <script src="<?= JS_URL ?>/main.js"></script>
</body>

</html>