<?php 
session_start();
require_once __DIR__ . '/../core/config.php'; 
require_once __DIR__ . '/../core/connect.php';
require_once __DIR__ . '/../core/queries.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: " . TEMPLATES_URL . "/signIn.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: " . TEMPLATES_URL . "/signIn.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require __DIR__ . '/partials/theme-head.php'; ?>
    <title>Cognify</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/navbarsticky.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/footer.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/theme-global.css" />
      <?php require __DIR__ . '/paths.php'; ?>
      <script src="<?= JS_URL ?>/auth.js"></script>
</head>
  <body>
    <div id="navbar"></div>
    <script src="<?= COMPONENTS_URL ?>/navbar.js"></script>
    <script src="<?= JS_URL ?>/main.js"></script>

    <div class="your-circle">
      <h1>Your Circle</h1>
      <p>See how you compare with your study group</p>
    </div>

    <div class="circle-content">
      <div class="left-col">
        <div class="top-performer">
          <div class="tp-left">
            <div class="tp-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#F59E0B"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-trophy tp-icon-svg"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M8 21l8 0" />
                <path d="M12 17l0 4" />
                <path d="M7 4l10 0" />
                <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />
                <path d="M3 9a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 9a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              </svg>
            </div>

          <!-- points earned -->
            <div class="tp-info">
              <h2 class="tp-name"><?= htmlspecialchars($top['name']) ?></h2>
                <span class="tp-points">
                <span class="points"><?= $top['last_week_points'] ?></span> 
                      points earned this week
                </span>
            </div>
          </div>

          <!-- number of streaks  -->
          <div class="tp-right">
            <span class="tp-streak-num"><?= $top['streak'] ?></span>
            <span class="tp-streak-label">Day Streak</span>
          </div>
        </div>


        <div class="leaderboard">
            <h3>Leaderboard</h3>

          <?php
          $medals = [1 => 'gold', 2 => 'silver', 3 => 'bronze'];

            foreach($leaderboard as $index => $user):
                $rank = $index + 1;
                $initial = strtoupper($user['name'][0]);
                $isYou = isset($_SESSION['user_id']) && ($user['id'] == $_SESSION['user_id']);
                $medalClass = $medals[$rank] ?? '';
            ?>
            <div class="lb-item <?= $isYou ? 'active' : '' ?>">
            <div class="lb-rank <?= $medalClass ?>">
             <?php if($rank <= 3): ?>
                  
                  <?php else: ?>
                    #<?= $rank ?>
                  <?php endif; ?>
            </div>

            <div class="lb-avatar <?= $isYou ? 'you' : 'dark' ?>">
              <?= $initial ?>
            </div>
            <div class="lb-info">
              <span class="lb-name"><?= $isYou ? 'You' : htmlspecialchars($user['name']) ?></span>
              <span class="lb-sessions"><?= $user['sessions_count'] ?> sessions completed</span>
            </div>


          <div class="lb-stats">
            <div class="lb-stat">
              <span class="stat-value">
                <!-- star svg -->
                <strong><?= $user['points'] ?></strong>
              </span>
              <span>total points</span>
            </div>
            <div class="lb-stat">
              <span class="stat-value">
                <!-- flame svg -->
                <strong><?= $user['streak'] ?></strong>
              </span>
              <span>day streak</span>
            </div>
          </div>
        </div>

        <?php endforeach; ?>
      </div> <!-- end leaderboard -->
      </div> <!-- end left-col -->

  <div class="right-col">
        <div class="ranking-card">
          <div class="card-header">
            <div class="card-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-big-up"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  stroke="white"
                  fill="white"
                  d="M9 20v-8h-3.586a1 1 0 0 1 -.707 -1.707l6.586 -6.586a1 1 0 0 1 1.414 0l6.586 6.586a1 1 0 0 1 -.707 1.707h-3.586v8a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1"
                />
              </svg>
            </div>

            <span>Your Ranking</span>
            </div>

            <div class="ranking-number">#<?= $userRank ?></div>
            <p class="ranking-desc">
            <?php if($pointsDiff > 0): ?>
                You're <strong><?= $pointsDiff ?> points</strong> away from #1
            <?php else: ?>
                You're <strong>#1!</strong> 🎉
            <?php endif; ?>
            </p>
            </div> 
          
        <div class="this-week-card">
          <div class="card-header">
            <div class="card-icon purple">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-medal-2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  stroke="white"
                  fill="white"
                  d="M9 3h6l3 7l-6 2l-6 -2l3 -7"
                />
                <path stroke="white" fill="white" d="M12 12l-3 -9" />
                <path stroke="white" fill="white" d="M15 11l-3 -8" />
                <path
                  stroke="white"
                  fill="white"
                  d="M12 19.5l-3 1.5l.5 -3.5l-2 -2l3 -.5l1.5 -3l1.5 3l3 .5l-2 2l.5 3.5l-3 -1.5"
                />
              </svg>
            </div>
           <span>This Week</span>
            </div>

          <div class="progress-item">
              <div class="progress-top">
                  <span>Points earned</span>
                  <strong><?= $currentUser['points'] ?></strong>
              </div>
              <div class="progress-bar">
                  <div class="progress-fill blue" style="width: <?= $progressPercent ?>%"></div>
              </div>
          </div>

          <div class="progress-item">
              <div class="progress-top">
                  <span>Sessions completed</span>
                  <strong><?= $userSessions ?></strong>
              </div>
              <div class="progress-bar">
                  <div class="progress-fill green" style="width: <?= $sessionsPercent ?>%"></div>
              </div>
          </div>
          </div> <!-- end this-week-card -->

          <div class="keep-going-card">
              <div class="kg-icon">🎯</div>
              <h4>Keep Going!</h4>
              <?php if($sessionsNeeded > 0): ?>
                  <p>Complete <strong><?= $sessionsNeeded ?> more sessions</strong> to beat your personal best this week</p>
              <?php else: ?>
                  <p>You've <strong>beaten your personal best</strong> this week! 🎉</p>
              <?php endif; ?>
          </div>

        <div id="footer"></div>

    <script src="<?= COMPONENTS_URL ?>/footer.js"></script>
    <?php require __DIR__ . '/partials/theme-foot.php'; ?>
  </body>
</html>

```