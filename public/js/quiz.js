// ── State (7alet el quiz wel arqam) ──
const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';
let currentIndex = 0; // raqam el so2al el 7ali
let answers = new Array(questions.length).fill(null); // el egabat elly e5tarha el user
let correctCount = 0; // 3adad el egabat el sa7
let seconds = 5 * 60; // 5 daqaye2 timer
let timerInterval = null;

// ── DOM refs (haykl el saf7a w el elements) ──
const timerEl = document.getElementById("timer");
const correctCountEl = document.getElementById("correctCount");
const progressLabel = document.getElementById("progressLabel");
const progressFill = document.getElementById("progressFill");
const questionText = document.getElementById("questionText");
const optionsList = document.getElementById("optionsList");
const btnPrev = document.getElementById("btnPrev");
const btnNext = document.getElementById("btnNext");

// Function b-tbda2 el waqt
function startTimer() {
  updateTimerDisplay();

  timerInterval = setInterval(() => {
    if (seconds <= 0) {
      clearInterval(timerInterval);

      timerEl.textContent = "00:00";

      timerEl.style.color = "var(--red)";

      alert("Time's up!");

      return;
    }

    seconds--;

    updateTimerDisplay();

    if (seconds <= 60) {
      timerEl.style.color = "var(--red)";
    }
  }, 1000);
}

// Function b-tzbat shakal el waqt 3ala el shasha (00:00)
function updateTimerDisplay() {
  const m = String(Math.floor(seconds / 60)).padStart(2, "0");

  const s = String(seconds % 60).padStart(2, "0");

  timerEl.textContent = `${m}:${s}`;
}

// Function b-t-render el so2al w el e5tiyarat 3ala el shasha
function render() {
  const q = questions[currentIndex];

  const total = questions.length;

  progressLabel.textContent = `Question ${currentIndex + 1} of ${total}`;

  progressFill.style.width = `${(currentIndex / (total - 1)) * 100}%`;

  questionText.textContent = q.text;

  correctCountEl.textContent = `${correctCount} correct answer${correctCount !== 1 ? "s" : ""} so far`;

  optionsList.innerHTML = "";

  const answered = answers[currentIndex] !== null;

  q.options.forEach((opt, i) => {
    const div = document.createElement("div");

    div.className = "option";

    const textSpan = document.createElement("span");

    textSpan.textContent = opt;

    const iconWrap = document.createElement("span");

    iconWrap.className = "option-icon";

    if (answered) {
      div.classList.add("disabled");

      if (i === answers[currentIndex] && i !== q.correct) {
        div.classList.add("wrong");

        iconWrap.innerHTML = `
          <svg viewBox="0 0 24 24">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        `;
      } else if (i === q.correct) {
        div.classList.add("correct");

        iconWrap.innerHTML = `
          <svg viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        `;
      }
    } else {
      div.addEventListener("click", () => selectOption(i));
    }

    div.appendChild(textSpan);

    div.appendChild(iconWrap);

    optionsList.appendChild(div);
  });

  // Zrayer el ta7akom wel as2ela
  btnPrev.disabled = currentIndex === 0;

  btnNext.textContent = currentIndex === total - 1 ? "Finish" : "Next Question";

  // bn-dif sahme tany lel zorar
  const arrow = document.createElementNS("http://www.w3.org/2000/svg", "svg");

  arrow.setAttribute("viewBox", "0 0 24 24");

  const poly = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "polyline",
  );

  poly.setAttribute("points", "9 18 15 12 9 6");

  arrow.appendChild(poly);

  btnNext.appendChild(arrow);
}

// ── E5tiyar el egaba ──
function selectOption(index) {
  // lw el user gawab abl kda, msh hynf3 y-gawab tany
  if (answers[currentIndex] !== null) return;

  const q = questions[currentIndex];

  answers[currentIndex] = index;

  if (index === q.correct) {
    correctCount++;
  }

  render();
}

// ── Tanaqol ben el as2ela ──
function nextQuestion() {
  if (currentIndex < questions.length - 1) {
    currentIndex++;

    render();
  } else {
    showQuizModal();
  }
}

function prevQuestion() {
  if (currentIndex > 0) {
    currentIndex--;

    render();
  }
}

// ── Modal el nehaya ──
function showQuizModal() {
  const percentage = Math.round((correctCount / questions.length) * 100);

  localStorage.setItem("quizScore", percentage);

  localStorage.setItem("correctAnswers", correctCount);

  localStorage.setItem("totalQuestions", questions.length);

  const modal = document.createElement("div");

  modal.className = "quiz-modal-overlay";

  modal.innerHTML = `
    <div class="quiz-modal">

      <div class="quiz-modal-icon">
        <svg xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">

          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>

          <path d="M8.243 7.34l-6.38 .925
                   l-.113 .023a1 1 0 0 0 -.44 1.684
                   l4.622 4.499l-1.09 6.355
                   l-.013 .11a1 1 0 0 0 1.464 .944
                   l5.706 -3l5.693 3l.1 .046
                   a1 1 0 0 0 1.352 -1.1
                   l-1.091 -6.355l4.624 -4.5
                   l.078 -.085a1 1 0 0 0 -.633 -1.62
                   l-6.38 -.926l-2.852 -5.78
                   a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
        </svg>
      </div>

      <h2>Quiz Complete!</h2>

      <p>
        You got
        <span class="quiz-modal-score">
          ${correctCount} out of ${questions.length}
        </span>
        correct.
      </p>

      <div class="quiz-modal-actions">

        <button
          class="quiz-modal-btn"
          onclick="window.location.href='${_TEMPLATES_URL}/${APP_PAGES.RESULTS}'">

          View Results

        </button>

      </div>

    </div>
  `;

  document.body.appendChild(modal);
}

render();
startTimer();
