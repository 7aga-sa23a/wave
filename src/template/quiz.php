<?php require_once __DIR__ . '/../core/config.php'; ?>
<?php
include("../helpers/questions.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?= CSS_URL ?>/quiz.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />
      <script src="<?= JS_URL ?>/auth.js"></script>
</head>
  <body>
    <div class="page">
      <div class="quiz-card">
        <div class="quiz-meta">
          <div class="meta-time">
            <span class="meta-label">Time Spent</span>
            <span class="meta-value" id="timer">00:00</span>
          </div>
          <p class="meta-correct" id="correctCount">0 correct answers so far</p>
        </div>

        <div class="progress-row">
          <span class="progress-label" id="progressLabel">Question 1 of 5</span>
          <div class="progress-bar-wrap">
            <div class="progress-bar-fill" id="progressFill"></div>
          </div>
        </div>

        <div class="question-box">
          <h2 class="question-text" id="questionText"></h2>

          <div class="options-list" id="optionsList"></div>

          <div class="quiz-footer">
            <button class="btn-prev" id="btnPrev" onclick="prevQuestion()">
              <svg viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6" />
              </svg>
              Previous
            </button>
            <button class="btn-next" id="btnNext" onclick="nextQuestion()">
              Next Question
              <svg viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
<script>
  (function () {
    var fallback = <?php echo json_encode($questions); ?>;
    var q = null;
    try {
      var raw = sessionStorage.getItem("session-quiz-questions");
      if (raw) {
        var parsed = JSON.parse(raw);
        if (Array.isArray(parsed) && parsed.length > 0) {
          q = parsed;
        }
      }
    } catch (e) {}
    window.QUIZ_QUESTIONS = q || fallback;
  })();
</script>
    <script src="<?= JS_URL ?>/quiz.js"></script>
  </body>
</html>
