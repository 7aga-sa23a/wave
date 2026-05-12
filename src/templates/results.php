<?php require_once __DIR__ . '/../core/config.php'; ?>
  <!doctype html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Session Complete</title>
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
      />
      <link rel="stylesheet" href="<?= CSS_URL ?>/results.css" />
        <script src="<?= JS_URL ?>/auth.js"></script>
</head>
    <body>
      <div class="results-card">
        <!-- Trophy -->
        <div class="res-icon-wrap">
          <div class="res-icon">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-trophy"
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
        </div>

        <!-- Title -->
        <h1 class="res-title">Session Complete!</h1>
        <p class="res-subtitle">
          Nice try! Review the material and try again for better results.
        </p>

        <!-- 3 stat boxes -->
        <div class="res-stats-row">
          <div class="res-stat-box">
            <div class="res-stat-icon purple">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                width="22"
                height="22"
              >
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
            </div>
            <div class="res-stat-value">25m</div>
            <div class="res-stat-label">Focus Time</div>
          </div>

          <div class="res-stat-box">
            <div class="res-stat-icon green">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
                width="22"
                height="22"
              >
                <polyline points="20 6 9 17 4 12" />
              </svg>
            </div>
            <div class="res-stat-value" id="quizScore">0%</div>
            <div class="res-stat-label">Quiz Score</div>
          </div>

          <div class="res-stat-box">
            <div class="res-stat-icon orange">
              <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                width="22"
                height="22"
              >
                <path d="M12 2c0 6-6 8-6 13a6 6 0 0 0 12 0c0-5-6-7-6-13z" />
              </svg>
            </div>
            <div class="res-stat-value">16</div>
            <div class="res-stat-label">Day Streak</div>
          </div>
        </div>

        <!-- Points earned -->
        <div class="res-points-row">
          <div class="res-points-left">
            <div class="res-points-icon">
              <svg
                viewBox="0 0 24 24"
                width="22"
                height="22"
                fill="white"
                stroke="none"
              >
                <polygon
                  points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                />
              </svg>
            </div>
            <div>
              <div class="res-points-title">Points Earned</div>
              <div class="res-points-desc">
                Based on focus time and quiz performance
              </div>
            </div>
          </div>
          <div class="res-points-value">+50</div>
        </div>

        <!-- Bottom 2 boxes -->
        <div class="res-bottom-row">
          <div class="res-bottom-box">
            <div class="res-bottom-title">Session Stats</div>
            <div class="res-bottom-item">
              <span>Questions answered</span><span class="val" id="questionsAnswered">0/0</span>
            </div>
            <div class="res-bottom-item">
              <span>Accuracy rate</span><span class="val" id="accuracyRate">0%</span>
            </div>
            <div class="res-bottom-item">
              <span>Session duration</span><span class="val">25 min</span>
            </div>
          </div>

          <div class="res-bottom-box">
            <div class="res-bottom-title">Your Progress</div>
            <div class="res-bottom-item">
              <span>Total points</span><span class="val bold">2940</span>
            </div>
            <div class="res-bottom-item">
              <span>Current streak</span><span class="val bold">16 days</span>
            </div>
            <div class="res-bottom-item">
              <span>Sessions this week</span><span class="val bold">4</span>
            </div>
          </div>
        </div>

        <!-- Footer buttons -->
        <div class="res-footer">
          <button
            class="btn-dashboard"
            onclick="window.location.href = 'study-session.php'"
          >
            Back to Dashboard
          </button>
          <button class="btn-restart" onclick="window.location.href = 'uploading-material.php'">
            Start Another Session
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="#25282d"
              stroke-width="2.5"
              stroke-linecap="round"
              stroke-linejoin="round"
              width="16"
              height="16"
            >
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>
        </div>
      </div>

      <script src="<?= JS_URL ?>/results.js"></script>
    </body>
  </html>
