<?php
require_once __DIR__ . '/../core/config.php';
require __DIR__ . '/../logic/get_profile.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cognify - Profile</title>


  <link rel="stylesheet" href="<?= CSS_URL ?>/profile.css" />
  <link rel="stylesheet" href="<?= CSS_URL ?>/navbar.css" />
  <link rel="stylesheet" href="<?= CSS_URL ?>/navbarsticky.css" />
  <link rel="stylesheet" href="<?= CSS_URL ?>/footer.css" />
  <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />

  <?php require __DIR__ . '/paths.php'; ?>
  <script src="<?= JS_URL ?>/auth.js"></script>
</head>

<body>
  <div id="navbar"></div>
  <script src="<?= COMPONENTS_URL ?>/navbar.js"></script>
  <script src="<?= JS_URL ?>/main.js"></script>

  <div class="profile-page">

    <div class="page-title">
      <h1>Profile</h1>
      <p>Manage your account and view your progress</p>
    </div>

    <div class="profile-grid">

      <!-- LEFT COLUMN -->
      <div class="profile-left">

        <!-- Profile Header Card -->
        <div class="profile-card profile-header-card">
          <div class="profile-avatar">
            <img src="<?= IMG_URL ?>/b49352280919218a2934154cabbf4d02.jpg" alt="Profile" />
          </div>

          <div class="profile-info">
            <h2 id="user-name"><?= $_SESSION['name'] ?></h2>
            <p class="profile-email" id="user-email"><?= $_SESSION['email'] ?></p>

            <div class="profile-badges">
              <span class="badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                </svg>
                <span id="user-points"><?= $_SESSION['points'] ?></span>
              </span>

              <span class="badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#ef4444">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M10 2c0 -.88 1.056 -1.331 1.692 -.722c1.958 1.876 3.096 5.995 1.75 9.12l-.08 .174l.012 .003c.625 .133 1.203 -.43 2.303 -2.173l.14 -.224a1 1 0 0 1 1.582 -.153c1.334 1.435 2.601 4.377 2.601 6.27c0 4.265 -3.591 7.705 -8 7.705s-8 -3.44 -8 -7.706c0 -2.252 1.022 -4.716 2.632 -6.301l.605 -.589c.241 -.236 .434 -.43 .618 -.624c1.43 -1.512 2.145 -2.924 2.145 -4.78" />
                </svg>
                <span id="user-streak"><?= $_SESSION['streak'] ?></span>
              </span>

              <span class="badge badge-plain" id="user-joined">Joined at <?= date('Y-m-d', strtotime($_SESSION['created_at'])) ?></span>
            </div>
          </div>
        </div>

        <!-- Statistics -->
        <div class="profile-card">
          <h3 class="card-title">Statistics</h3>

          <div class="stats-grid">
            <div class="stat-box">
              <div class="stat-icon" style="background: #ede9fe">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#7c3aed">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                  <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                </svg>
              </div>
              <span class="stat-value" id="stat-sessions"><?= $session_stats['total_sessions'] ?></span>
              <span class="stat-label" >Sessions Completed</span>
            </div>

            <div class="stat-box">
              <div class="stat-icon" style="background: #d1fae5">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#10b981">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8 -8a8 8 0 0 1 -8 8zm.5 -13h-1a.5 .5 0 0 0 -.5 .5v5.5h-2.5a.5 .5 0 0 0 0 1h3.5a.5 .5 0 0 0 .5 -.5v-6a.5 .5 0 0 0 -.5 -.5z" />
                </svg>
              </div>
              <span class="stat-value" id="stat-focus"><?= $session_stats['total_focus_time'] / 60?> m</span>
              <span class="stat-label">Total Focus Time</span>
            </div>

            <div class="stat-box">
              <div class="stat-icon" style="background: #fff7ed">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#f97316">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M3 17l4 -8l4 4l4 -6l4 10z" />
                </svg>
              </div>
              <span class="stat-value" id="stat-score"><?= number_format($quiz_stats['avg_score'], 0) ?></span>
              <span class="stat-label">Average Score</span>
            </div>
          </div>
        </div>

        <!-- Achievements -->
        <div class="profile-card">
          <h3 class="card-title">Achievements</h3>

          <div class="achievements-grid">
            <div class="achievement <?= ($_SESSION['streak'] >= 5) ? 'active' : '' ?>">
              <div class="achievement-icon">🔥</div>
              <span class="achievement-name">Hot Streak</span>
              <span class="achievement-desc" id = "streak" ><?=$_SESSION['streak']?>-day streak</span>
            </div>

            <div class="achievement <?= ($_SESSION['points'] >= 4000) ? 'active' : '' ?>">
              <div class="achievement-icon">⭐</div>
              <span class="achievement-name">Point Master</span>
              <span class="achievement-desc" id="points"><?php if($_SESSION['points'] >= 4000) { echo '4000+'; } else { echo $_SESSION['points']; } ?></span>
            </div>

            <div class="achievement <?= ( $session_stats['total_sessions']>= 10) ? 'active' : '' ?>">
              <div class="achievement-icon">🎯</div>
              <span class="achievement-name">Focused Mind</span>
              <span class="achievement-desc" id="total_sessions"><?= $session_stats['total_sessions']?> sessions</span>
            </div>

            <div class="achievement <?= ($quiz_stats['max_score'] >= 70) ? 'active' : '' ?>">
              <div class="achievement-icon">🏆</div>
              <span class="achievement-name">Perfect Score</span>
              <span class="achievement-desc" id="highest_score"><?= number_format($quiz_stats['max_score'], 0) ?>% on Quiz</span>
            </div>

            <div class="achievement <?= ($session_stats['total_sessions'] >= 20) ? 'active' : '' ?>">
              <div class="achievement-icon">📚</div>
              <span class="achievement-name">Knowledge Seeker</span>
              <span class="achievement-desc" id="total_sessions"><?= $session_stats['total_sessions']?> sessions</span>
            </div>

            <div class="achievement <?= ($_SESSION['points'] >= 5000) ? 'active' : '' ?>">
              <div class="achievement-icon">💎</div>
              <span class="achievement-name">Diamond League</span>
              <span class="achievement-desc" id="points"><?php if($_SESSION['points'] >= 5000) { echo '5000+'; } else { echo $_SESSION['points']; } ?></span>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="profile-card">
          <h3 class="card-title">Recent Activity</h3>

          <div class="activity-list">
            <div class="activity-item">
              <div class="activity-info">
                <span class="activity-title">Completed study session</span>
                <span class="activity-time" id = "max_date"><?= $timeago ?></span>
              </div>
              <span class="activity-points">+150</span>
            </div>

            <div class="activity-item">
              <div class="activity-info">
                <span class="activity-title">Perfect quiz score</span>
                <span class="activity-time" id = "max_score_date"><?= $quiztimeago ?></span>
              </div>
              <span class="activity-points">+200</span>
            </div>

          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN -->
      <div class="profile-right">

        <div class="profile-card">
          <h3 class="card-title">Quick Stats</h3>

          <div class="quick-stats-list">
            <div class="quick-stat-item">
              <span class="qs-label">Longest Streak</span>
              <span class="qs-value" id = "max_streak"><?= $_SESSION['max_streak'] ?> days</span>
            </div>

            <div class="quick-stat-item">
              <span class="qs-label">Achievements</span>
              <span class="qs-value" id="achievements"><?= $_SESSION['achievements'] ?></span>
            </div>

            <div class="quick-stat-item">
              <span class="qs-label">Member Since</span>
              <span class="qs-value qs-bold" id="qs-joined"><?= date('F j, Y', strtotime($_SESSION['created_at'])) ?></span>
            </div>
          </div>
        </div>

        <!-- Settings -->
        <div class="profile-card">
          <h3 class="card-title">Settings</h3>

          <div class="settings-list">

            <button class="settings-btn" onclick="window.location.href='<?= TEMPLATES_URL ?>/settings.php'">
              Account Settings
            </button>

            <button class="settings-btn" onclick="window.location.href='<?= TEMPLATES_URL ?>/achievements.php'">
              Manage Achievements
            </button>

            <button class="settings-btn settings-btn-danger"
              onclick="localStorage.setItem('loggedIn', 'false'); window.location.href='<?= TEMPLATES_URL ?>/index.php'">
              Sign Out
            </button>

          </div>
        </div>

        <div class="profile-card great-progress-card">
          <div class="gp-icon">🎉</div>
          <h4>Great Progress!</h4>
          <p>You're in the top <?= number_format($top_percent) ?>% of Cognify users this month</p>
        </div>

      </div>

    </div>

  </div>

  <div id="footer"></div>
  
  <script src="<?= COMPONENTS_URL ?>/footer.js"></script>





</body>

</html>