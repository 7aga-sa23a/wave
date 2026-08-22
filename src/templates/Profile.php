<?php
require_once __DIR__ . '/../core/config.php';
require __DIR__ . '/../logic/get_profile.php';
require __DIR__ . '/partials/theme-head.php';
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
    <link rel="stylesheet" href="<?= CSS_URL ?>/profile.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/theme-global.css" />

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
            <h2 id="user-name"><?= $_SESSION['user_name'] ?></h2>
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
              <span class="stat-value" id="stat-focus"><?= number_format($session_stats['total_focus_time'] / 60)?> m</span>
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
              <span class="activity-points"><?php echo isset($_SESSION['last_week_points']) ? '+'. $_SESSION['last_week_points'] : '0'; ?></span>
            </div>

            <div class="activity-item">
              <div class="activity-info">
                <span class="activity-title">Perfect quiz score</span>
                <span class="activity-time" id = "max_score_date"><?= $quiztimeago ?></span>
              </div>
              <span class="activity-points"><?php echo isset($_SESSION['achievements']) ? '+'. $_SESSION['achievements'] : '0'; ?></span>
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
              <div class="profile-theme-row">
                <div class="profile-theme-label">
                  <span class="profile-theme-title">Appearance</span>
                  <span class="profile-theme-hint">Light or dark theme (saved for focus sessions too)</span>
                </div>
                <div class="theme-switcher profile-theme-switcher" aria-label="Theme">
                  <button type="button" class="theme-btn" id="btn-light" title="Light mode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z"/>
                    </svg>
                  </button>
                  <button type="button" class="theme-btn" id="btn-dark" title="Dark mode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2h.1A6.979 6.979 0 0 0 10 7zm-6 5a8 8 0 0 0 15.062 3.762A9 9 0 0 1 8.238 4.938 7.999 7.999 0 0 0 4 12z"/>
                    </svg>
                  </button>
                </div>
              </div>
<button class="settings-btn" onclick="window.location.href='<?= TEMPLATES_URL ?>/settings.php'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#4f46e5"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path
                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"
                    fill="none"
                  />
                  <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                </svg>
                Account Settings
              </button>
              <button class="settings-btn" onclick="window.location.href='<?= TEMPLATES_URL ?>/achievements.php'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#4f46e5"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M8 21l8 0" />
                  <path d="M12 17l0 4" />
                  <path d="M7 4l10 0" />
                  <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />
                  <path d="M3 9a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M17 9a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                </svg>
                Manage Achievements
              </button>
              <button class="settings-btn settings-btn-danger" onclick="localStorage.setItem('loggedIn', 'false'); window.location.href='<?= TEMPLATES_URL ?>/index.php'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#ef4444"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path
                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"
                  />
                  <path d="M9 12h12l-3 -3" />
                  <path d="M18 15l3 -3" />
                </svg>
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
    <?php require __DIR__ . '/partials/theme-foot.php'; ?>
  </body>
</html>