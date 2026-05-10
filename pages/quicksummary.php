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
    <link rel="stylesheet" href="../css/quicksummary.css" />
    <script src="../js/auth.js"></script>
    <script src="../js/quicksummary.js" defer></script>
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

        <!-- List (AI summary from session; see quicksummary.js) -->
        <div id="qs-list" class="qs-list" aria-live="polite"></div>

        <!-- Footer -->
        <div class="qs-footer">
          <span class="qs-count"></span>
          <button class="qs-btn" onclick="window.location.href = 'quiz.php'">
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
