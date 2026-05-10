<?php require_once __DIR__ . '/../core/config.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quick Summary</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?= CSS_URL ?>/quicksummary.css" />
      <?php require __DIR__ . '/paths.php'; ?>
      <script src="<?= JS_URL ?>/auth.js"></script>
</head>
  <body>
    <!-- Page -->
    <div class="page">
      <div class="qs-card">
        <!-- Icon -->
        <div class="qs-icon-wrap">
          <div class="qs-icon">
            <svg viewBox="0 0 24 24">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>
        </div>

        <!-- Title -->
        <h1 class="qs-title">Quick Summary</h1>
        <p class="qs-subtitle">
          Here are the key takeaways from your study session
        </p>

        <!-- List -->
        <div class="qs-list">
          <div class="qs-item">
            <span class="qs-num">1</span>
            <p class="qs-text">
              <span class="highlight">Focused study sessions</span> improve
              retention by breaking learning into manageable intervals
            </p>
          </div>

          <div class="qs-item">
            <span class="qs-num">2</span>
            <p class="qs-text">
              <span class="highlight">Active recall through</span> quizzing
              strengthens neural pathways and long-term memory
            </p>
          </div>

          <div class="qs-item">
            <span class="qs-num">3</span>
            <p class="qs-text">
              <span class="highlight">Consistent practice with</span>
              gamification elements increases motivation and engagement
            </p>
          </div>

          <div class="qs-item">
            <span class="qs-num">4</span>
            <p class="qs-text">
              <span class="highlight">Progress tracking helps</span> identify
              weak areas and optimize study strategies
            </p>
          </div>

          <div class="qs-item">
            <span class="qs-num">5</span>
            <p class="qs-text">
              <span class="highlight">Regular breaks prevent</span> cognitive
              fatigue and maintain peak mental performance
            </p>
          </div>
        </div>

        <!-- Footer -->
        <div class="qs-footer">
          <span class="qs-count">5 key points highlighted</span>
          <button class="qs-btn" onclick="window.location.href = '<?= TEMPLATES_URL ?>/quiz.php'">
            Continue to Quiz
            <svg viewBox="0 0 24 24">
              <polyline points="9 18 15 12 9 6" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
