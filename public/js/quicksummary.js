(function () {
  const STORAGE_KEY = "quicksummary-session";
  const QUIZ_STORAGE_KEY = "session-quiz-questions";

  function escapeHtml(text) {
    return String(text)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;");
  }

  function firstWordsHighlight(text, wordCount) {
    const words = text.trim().split(/\s+/);
    if (words.length <= wordCount) {
      return `<span class="highlight">${escapeHtml(text)}</span>`;
    }
    const head = words.slice(0, wordCount).join(" ");
    const rest = words.slice(wordCount).join(" ");
    return `<span class="highlight">${escapeHtml(head)}</span> ${escapeHtml(rest)}`;
  }

  function showLoading(listEl, footerCount) {
    listEl.innerHTML = `
      <div class="qs-item qs-item--loading" style="grid-column:1/-1;text-align:center;padding:24px;color:var(--text-light, #2f2a89);display:flex;flex-direction:column;align-items:center;">
        <div class="ai-glowing-scanner" style="margin-bottom:16px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="ai-brain-icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M15.5 13a3.5 3.5 0 0 0 -3.5 3.5v1a3.5 3.5 0 0 0 7 0v-1.8" />
                <path d="M8.5 13a3.5 3.5 0 0 1 3.5 3.5v1a3.5 3.5 0 0 1 -7 0v-1.8" />
                <path d="M17.5 16a3.5 3.5 0 0 0 0 -7h-.5" />
                <path d="M19 9.3v-2.8a3.5 3.5 0 0 0 -7 0" />
                <path d="M6.5 16a3.5 3.5 0 0 1 0 -7h.5" />
                <path d="M5 9.3v-2.8a3.5 3.5 0 0 1 7 0v10" />
            </svg>
            <div class="ai-scanner-line"></div>
        </div>
        <p style="margin:0 0 8px 0;font-weight:600;">Generating your session summary and quiz…</p>
        <p style="margin:0;font-size:14px;opacity:0.85;">This may take up to a minute</p>
      </div>`;
    if (footerCount) footerCount.textContent = "";
  }

  function showError(listEl, msg, footerCount) {
    listEl.innerHTML = `
      <div class="qs-item" style="grid-column:1/-1;">
        <span class="qs-num">!</span>
        <p class="qs-text">${escapeHtml(msg)}</p>
      </div>`;
    if (footerCount) footerCount.textContent = "";
  }

  async function fetchSummary(payload) {
    const res = await fetch("../../public/api/session-summary.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload),
    });
    const data = await res.json();
    if (!res.ok || data.error) {
      throw new Error(data.error || "Request failed");
    }
    return data.points || [];
  }

  async function fetchQuiz(payloadWithSummary) {
    const res = await fetch("../../public/api/session-quiz.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payloadWithSummary),
    });
    const data = await res.json();
    if (
      data.questions &&
      Array.isArray(data.questions) &&
      data.questions.length >= 3
    ) {
      try {
        sessionStorage.setItem(
          QUIZ_STORAGE_KEY,
          JSON.stringify(data.questions),
        );
      } catch (e) {
        /* ignore */
      }
    }
  }

  function renderPoints(listEl, points, footerCount, footerBtn) {
    listEl.innerHTML = points
      .map(
        (text, i) => `
      <div class="qs-item">
        <span class="qs-num">${i + 1}</span>
        <p class="qs-text">${firstWordsHighlight(text, 3)}</p>
      </div>`,
      )
      .join("");
    if (footerCount) {
      const n = points.length;
      footerCount.textContent =
        n === 1 ? "1 key point highlighted" : `${n} key points highlighted`;
    }
    if (footerBtn) footerBtn.disabled = false;
  }

  async function init() {
    const listEl = document.getElementById("qs-list");
    const footerCount = document.querySelector(".qs-count");
    const footerBtn = document.querySelector(".qs-btn");
    if (!listEl) return;

    if (footerBtn) footerBtn.disabled = true;

    let raw = null;
    try {
      raw = sessionStorage.getItem(STORAGE_KEY);
    } catch (e) {
      /* ignore */
    }

    let payload = {
      notes: [],
      materials: [],
      materialExcerpts: [],
      chat: [],
      elapsedSeconds: 0,
      totalSessionMinutes: 25,
    };

    if (raw) {
      try {
        const parsed = JSON.parse(raw);
        if (parsed && typeof parsed === "object") {
          payload = {
            notes: Array.isArray(parsed.notes) ? parsed.notes : [],
            materials: Array.isArray(parsed.materials)
              ? parsed.materials
              : [],
            materialExcerpts: Array.isArray(parsed.materialExcerpts)
              ? parsed.materialExcerpts
              : [],
            chat: Array.isArray(parsed.chat) ? parsed.chat : [],
            elapsedSeconds:
              typeof parsed.elapsedSeconds === "number"
                ? parsed.elapsedSeconds
                : 0,
            totalSessionMinutes:
              typeof parsed.totalSessionMinutes === "number"
                ? parsed.totalSessionMinutes
                : 25,
          };
        }
      } catch (e) {
        /* use defaults */
      }
    }

    showLoading(listEl, footerCount);

    try {
      const points = await fetchSummary(payload);
      if (!points.length) {
        showError(
          listEl,
          "No summary was generated. Try refreshing the page.",
          footerCount,
        );
        if (footerBtn) footerBtn.disabled = false;
        return;
      }
      if (footerBtn) {
        footerBtn.disabled = true;
        footerBtn.innerHTML = '<style>@keyframes qsSpin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }</style><div style="display:flex;align-items:center;gap:8px;justify-content:center;"><span style="width:16px;height:16px;border:2px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:qsSpin 0.8s linear infinite;"></span>Generating Quiz...</div>';
      }
      renderPoints(listEl, points, footerCount, null);
      try {
        await fetchQuiz({ ...payload, summaryPoints: points });
      } catch (e) {
        /* quiz optional; quiz page falls back to default questions */
      }
      if (footerBtn) {
        footerBtn.disabled = false;
        footerBtn.innerHTML = 'Continue to Quiz <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6" /></svg>';
      }
    } catch (err) {
      showError(
        listEl,
        err && err.message
          ? String(err.message)
          : "Something went wrong. Check your connection and OPENROUTER_API_KEY in .env.",
        footerCount,
      );
      if (footerBtn) footerBtn.disabled = false;
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
