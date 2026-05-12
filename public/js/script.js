// El settings el awaleya (Initial settings)
const TOTAL_TIME = 25 * 60; // 25 dqiqa bel sawany
let timeLeft = TOTAL_TIME;
let timerId = null;
const ringCircumference = 2 * Math.PI * 140;

const timeDisplay = document.getElementById("time-display");
const mainBtn = document.getElementById("main-btn");
const endBtn = document.getElementById("end-btn");
const progressRing = document.getElementById("progress-ring");
const endModal = document.getElementById("end-modal");
const modalCancel = document.getElementById("modal-cancel");
const modalConfirm = document.getElementById("modal-confirm");

// nzbat toul el dayra bta3et el progress
progressRing.style.strokeDasharray = ringCircumference;

function updateTimer() {
  const minutes = Math.floor(timeLeft / 60);
  const seconds = timeLeft % 60;
  timeDisplay.textContent = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
  const offset =
    ringCircumference - (timeLeft / TOTAL_TIME) * ringCircumference;
  progressRing.style.strokeDashoffset = offset;
}

function startTimer() {
  if (timerId !== null) return;
  mainBtn.textContent = "Pause Session";
  if (endBtn) endBtn.classList.remove("end-btn--hidden");

  timerId = setInterval(() => {
    timeLeft--;
    updateTimer();

    if (timeLeft <= 0) {
      clearInterval(timerId);
      timerId = null;
      if (endBtn) endBtn.classList.add("end-btn--hidden");
      mainBtn.textContent = "Start Session";
      // Redirect to quick summary when time is up
      window.location.href = "quicksummary.php";
    }
  }, 1000);
}

function pauseTimer() {
  clearInterval(timerId);
  timerId = null;
  mainBtn.textContent = "Resume Session";
}

function endSession() {
  clearInterval(timerId);
  timerId = null;
  // Redirect to quick summary
  window.location.href = "quicksummary.php";
}

// ---- Events bta3et el zrayer ----

mainBtn.addEventListener("click", () => {
  if (timerId === null) {
    startTimer();
  } else {
    pauseTimer();
  }
});

endBtn.addEventListener("click", () => {
  // Show confirmation modal before ending the session
  endModal.classList.add("show");
});

modalCancel.addEventListener("click", () => {
  endModal.classList.remove("show");
  // lw kant paused tfdal paused, w lw shaghala trg3 t-kamel
});

modalConfirm.addEventListener("click", () => {
  endModal.classList.remove("show");
  endSession();
});

// bn-2fel el modal lw 7ad das barra el card
endModal.addEventListener("click", (e) => {
  if (e.target === endModal) {
    endModal.classList.remove("show");
  }
});

updateTimer();

// ===== Taghyeer el theme (Theme Switcher) =====
const btnLight = document.getElementById("btn-light");
const btnDark = document.getElementById("btn-dark");
const htmlEl = document.documentElement;

function applyTheme(theme) {
  // Fade animation
  document.body.classList.add("theme-switching");
  setTimeout(() => document.body.classList.remove("theme-switching"), 350);

  if (theme === "dark") {
    htmlEl.setAttribute("data-theme", "dark");
    btnDark.classList.add("active");
    btnLight.classList.remove("active");
  } else {
    htmlEl.removeAttribute("data-theme");
    btnLight.classList.add("active");
    btnDark.classList.remove("active");
  }

  localStorage.setItem("session-theme", theme);
}

function triggerRipple(btn) {
  btn.classList.remove("ripple");
  void btn.offsetWidth; // reflow
  btn.classList.add("ripple");
  setTimeout(() => btn.classList.remove("ripple"), 400);
}

if (btnLight && btnDark) {
  btnLight.addEventListener("click", () => {
    triggerRipple(btnLight);
    applyTheme("light");
  });

  btnDark.addEventListener("click", () => {
    triggerRipple(btnDark);
    applyTheme("dark");
  });

  // N-apply el theme elly metsayev lma el saf7a t-load
  const savedTheme = localStorage.getItem("session-theme") || "light";
  applyTheme(savedTheme);
}

// ===== Mantiq el Panels el ganbaya (AI & Notes & Music) =====
const btnAi = document.getElementById("btn-ai");
const btnCloseAi = document.getElementById("btn-close-ai");
const btnNotes = document.getElementById("btn-notes");
const btnCloseNotes = document.getElementById("btn-close-notes");
const btnMusic = document.getElementById("btn-music");
const btnCloseMusic = document.getElementById("btn-close-music");
const mainLayout = document.querySelector(".main-layout");

const aiInput = document.getElementById("ai-input");
const aiSendBtn = document.getElementById("ai-send-btn");
const aiMessages = document.getElementById("ai-messages");

const notesText = document.getElementById("session-notes-text");
const saveNotesBtn = document.getElementById("save-notes-btn");
const newNoteBtn = document.getElementById("new-note-btn");
const sidebarNotesCard = document.getElementById("sidebar-notes-card");
const sidebarNotesPrev = document.getElementById("sidebar-notes-preview");

const ytLinkInput = document.getElementById("yt-link-input");
const loadYtBtn = document.getElementById("load-yt-btn");
const ytPlayerContainer = document.getElementById("yt-player-container");

function openPanel(panelName) {
  mainLayout.classList.remove("with-ai", "with-notes", "with-music");
  mainLayout.classList.add("with-" + panelName);
}

function closePanels() {
  mainLayout.classList.remove("with-ai", "with-notes", "with-music");
}

if (mainLayout) {
  // AI Toggle (Zrar el AI)
  if (btnAi && btnCloseAi) {
    btnAi.addEventListener("click", () => {
      if (mainLayout.classList.contains("with-ai")) closePanels();
      else openPanel("ai");
    });
    btnCloseAi.addEventListener("click", closePanels);
  }

  // Notes Toggle (Zrar el Notes)
  function toggleNotesPanel() {
    if (mainLayout.classList.contains("with-notes")) closePanels();
    else openPanel("notes");
  }

  if (btnNotes && btnCloseNotes) {
    btnNotes.addEventListener("click", toggleNotesPanel);
    btnCloseNotes.addEventListener("click", closePanels);
  }

  // Removed conflicting sidebarNotesCard listener here. Handled below with delegation.

  // Music Toggle (Zrar el Music)
  if (btnMusic && btnCloseMusic) {
    btnMusic.addEventListener("click", () => {
      if (mainLayout.classList.contains("with-music")) closePanels();
      else openPanel("music");
    });
    btnCloseMusic.addEventListener("click", closePanels);
  }

  // Mantiq el YouTube Player
  if (loadYtBtn && ytLinkInput && ytPlayerContainer) {
    function getYoutubeId(url) {
      const regExp =
        /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
      const match = url.match(regExp);
      return match && match[2].length === 11 ? match[2] : null;
    }

    loadYtBtn.addEventListener("click", () => {
      const url = ytLinkInput.value.trim();
      if (!url) return;

      const videoId = getYoutubeId(url);
      if (videoId) {
        // Difna &vq=tiny 3ashan n-otlob gowda 144p
        ytPlayerContainer.innerHTML = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${videoId}?autoplay=1&vq=tiny" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
      } else {
        ytPlayerContainer.innerHTML = `<span style="color:#ef4444; padding:0 20px; text-align:center;">Invalid YouTube URL. Please try again.</span>`;
      }
    });

    ytLinkInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") loadYtBtn.click();
    });
  }
  let notesData =
    JSON.parse(localStorage.getItem("focus-session-notes-list")) || [];
  let currentNoteId = null;

  const sidebarNotesList = document.getElementById("sidebar-notes-list");
  const sidebarAddNoteBtn = document.getElementById("sidebar-add-note-btn");

  function renderSidebarNotes() {
    if (!sidebarNotesList) return;
    sidebarNotesList.innerHTML = "";

    if (notesData.length === 0) {
      sidebarNotesList.innerHTML =
        '<p class="tip-text" style="font-size: 12px; margin: 0;">No notes yet.</p>';
      return;
    }

    notesData.forEach((note) => {
      const item = document.createElement("div");
      item.className = "sidebar-note-item";
      item.textContent = note.text
        ? note.text.replace(/\n/g, " ")
        : "Empty Note";
      item.addEventListener("click", () => {
        currentNoteId = note.id;
        if (notesText) notesText.value = note.text;
        openPanel("notes");
      });
      sidebarNotesList.appendChild(item);
    });
  }

  // Load el notes el adema
  renderSidebarNotes();

  // Nebda2 Note gdeda
  function startNewNote() {
    currentNoteId = null;
    if (notesText) notesText.value = "";
    openPanel("notes");
  }

  if (sidebarAddNoteBtn) {
    sidebarAddNoteBtn.addEventListener("click", (e) => {
      e.stopPropagation(); // n-mna3 el click 3ala el card
      startNewNote();
    });
  }

  if (newNoteBtn) {
    newNoteBtn.addEventListener("click", startNewNote);
  }

  // Save el Note
  if (saveNotesBtn && notesText) {
    saveNotesBtn.addEventListener("click", () => {
      const text = notesText.value.trim();
      if (!text) return; // bn-mna3 eno y-save note fadya

      if (currentNoteId) {
        // lw mawkoda b-n3ml update
        const note = notesData.find((n) => n.id === currentNoteId);
        if (note) note.text = text;
      } else {
        // lw gdeda b-n-create wa7da
        const newNote = { id: Date.now(), text: text };
        notesData.push(newNote);
        currentNoteId = newNote.id;
      }

      localStorage.setItem(
        "focus-session-notes-list",
        JSON.stringify(notesData),
      );
      renderSidebarNotes();

      // bn-wary el user enak saved (feedback)
      const originalText = saveNotesBtn.textContent;
      saveNotesBtn.textContent = "Saved!";
      saveNotesBtn.style.background = "#10b981"; // a5dar
      setTimeout(() => {
        saveNotesBtn.textContent = originalText;
        saveNotesBtn.style.background = ""; // n-raga3 kolo zay ma kan
      }, 2000);
    });
  }

  // e5tiyary: n-5aly el card kolha b-click tfta7 el panel
  if (sidebarNotesCard && sidebarNotesList) {
    // bn-dos 3la el mkan el fady bs msh 3ala el items nfsaha
    sidebarNotesCard.addEventListener("click", (e) => {
      if (
        e.target.closest(".sidebar-note-item") ||
        e.target.closest("#sidebar-add-note-btn")
      )
        return;
      openPanel("notes");
    });
  }

  // Mantiq b3t rasayel el AI
  // ===== AI CHAT =====
  function escapeHtml(text) {
    return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;");
  }

  async function sendAiMessage() {
    if (!aiInput) return;

    const text = aiInput.value.trim();

    if (!text) return;

    // Resalet el user
    const userMsg = document.createElement("div");

    userMsg.className = "ai-msg sent";
    userMsg.setAttribute("dir", "auto");
    userMsg.textContent = text;

    aiMessages.appendChild(userMsg);

    aiInput.value = "";

    aiMessages.scrollTop = aiMessages.scrollHeight;

    // typing animation
    const typingMsg = document.createElement("div");

    typingMsg.className = "ai-msg received";

    typingMsg.innerHTML = `<div class="typing-animation"><span></span><span></span><span></span></div>`;

    aiMessages.appendChild(typingMsg);

    aiMessages.scrollTop = aiMessages.scrollHeight;

    try {
      const response = await fetch("../../public/api/chat.php", {
        method: "POST",

        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },

        body: "message=" + encodeURIComponent(text),
      });

      const data = await response.json();

      typingMsg.remove();

      const aiReply = document.createElement("div");

      aiReply.className = "ai-msg received";

      // Naga7 (success)
      if (data.choices) {
        let responseText = data.choices[0].message.content;

        const langIcons = {
          js: "ti-brand-javascript",
          javascript: "ti-brand-javascript",
          ts: "ti-brand-typescript",
          typescript: "ti-brand-typescript",
          py: "ti-brand-python",
          python: "ti-brand-python",
          html: "ti-brand-html5",
          css: "ti-brand-css3",
          php: "ti-elephant",
          sql: "ti-database",
          bash: "ti-terminal-2",
          sh: "ti-terminal-2",
          json: "ti-braces",
          xml: "ti-code",
          java: "ti-coffee",
          go: "ti-brand-golang",
          rust: "ti-brand-rust",
          swift: "ti-brand-swift",
          rb: "ti-gem",
          ruby: "ti-gem",
        };
        const parts = [];
        let lastIndex = 0;
        const codeRegex = /```(\w+)?\n?([\s\S]*?)```/g;
        let m;
        while ((m = codeRegex.exec(responseText)) !== null) {
          if (m.index > lastIndex) {
            const textPart = responseText
              .slice(lastIndex, m.index)
              .replace(/\n/g, "<br>");
            parts.push(`<span dir="auto">${textPart}</span>`);
          }
          const lang = (m[1] || "code").toLowerCase();
          const code = m[2].replace(/\n$/, "");
          const icon = langIcons[lang] || "ti-code";
          const langLabel = m[1] ? m[1].toLowerCase() : "code";
          parts.push(
            `<div class="code-block"><div class="code-block-header"><span class="code-block-lang"><i class="ti ${icon}" aria-hidden="true"></i>${langLabel}</span><button class="code-copy-btn" onclick="(function(btn){const pre=btn.closest('.code-block').querySelector('pre');navigator.clipboard.writeText(pre.textContent).then(()=>{btn.classList.add('copied');btn.innerHTML='<i class=\\'ti ti-check\\'></i> تم النسخ';setTimeout(()=>{btn.classList.remove('copied');btn.innerHTML='<i class=\\'ti ti-copy\\'></i> نسخ'},1800)})})(this)"><i class="ti ti-copy" aria-hidden="true"></i> نسخ</button></div><pre><code>${escapeHtml(code)}</code></pre></div>`,
          );
          lastIndex = m.index + m[0].length;
        }
        if (lastIndex < responseText.length) {
          const tail = responseText.slice(lastIndex).replace(/\n/g, "<br>");
          parts.push(`<span dir="auto">${tail}</span>`);
        }
        aiReply.setAttribute("dir", "auto");
        aiReply.innerHTML = parts.join("");
      }

      // Error men API
      else if (data.error) {
        aiReply.innerHTML = `<div class="ai-error-box"><i class="ti ti-alert-triangle ai-error-icon" aria-hidden="true"></i><div class="ai-error-content"><strong>زعزوع مشغول دلوقتي</strong><span>حصلت مشكلة أثناء توليد الرد.</span><button class="retry-btn"><i class="ti ti-refresh" aria-hidden="true"></i> إعادة المحاولة</button></div></div>`;
      }

      // fallback
      else {
        aiReply.textContent = "معرفتش افهم الرد.";
      }

      aiMessages.appendChild(aiReply);

      aiMessages.scrollTop = aiMessages.scrollHeight;

      // retry button
      const retryBtn = aiReply.querySelector(".retry-btn");

      if (retryBtn) {
        retryBtn.addEventListener("click", () => {
          aiReply.remove();

          aiInput.value = text;

          sendAiMessage();
        });
      }
    } catch (error) {
      typingMsg.remove();

      const aiReply = document.createElement("div");

      aiReply.className = "ai-msg received";

      aiReply.innerHTML = `<div class="ai-error-box"><i class="ti ti-wifi-off ai-error-icon" aria-hidden="true"></i><div class="ai-error-content"><strong>فشل الاتصال بزعزوع</strong><span>تحقق من الإنترنت أو حاول مرة أخرى.</span><button class="retry-btn"><i class="ti ti-refresh" aria-hidden="true"></i> إعادة المحاولة</button></div></div>`;

      aiMessages.appendChild(aiReply);

      aiMessages.scrollTop = aiMessages.scrollHeight;

      // retry button
      const retryBtn = aiReply.querySelector(".retry-btn");

      if (retryBtn) {
        retryBtn.addEventListener("click", () => {
          aiReply.remove();

          aiInput.value = text;

          sendAiMessage();
        });
      }

      console.error(error);
    }
  }

  // Zorar el ersal
  if (aiSendBtn) {
    aiSendBtn.addEventListener("click", sendAiMessage);
  }

  // Enter lel ersal
  if (aiInput) {
    aiInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        sendAiMessage();
      }
    });
  }
}

// ===== AI Summary Modal =====
// Bnfta7 el modal w bn-generate el summary men el AI

const btnSummary = document.getElementById("btn-summary");
const summaryModal = document.getElementById("summary-modal");
const closeSummaryBtn = document.getElementById("close-summary-btn");
const regenBtn = document.getElementById("summary-regenerate-btn");
const summaryLanguageSelect = document.getElementById("summary-language-select");
const summaryExportBtn = document.getElementById("summary-export-btn");
const summaryLoading = document.getElementById("summary-loading");
const summaryContent = document.getElementById("summary-content");
const summaryCount = document.getElementById("summary-points-count");

// bn-open el modal w n-generate
function openSummaryModal() {
  summaryModal.style.display = "flex";
  generateSummary();
}

// bn-2fel el modal
function closeSummaryModal() {
  summaryModal.style.display = "none";
}

// bn-generate el summary mn el AI
async function generateSummary() {
  // N-show el loading w n-hide el content
  summaryLoading.style.display = "flex";
  summaryContent.style.display = "none";
  summaryContent.innerHTML = "";
  summaryCount.textContent = "";

  // bn-gather el materials names mn el sidebar 3ashan n-eb3atha lel AI
  const materialItems = document.querySelectorAll(
    "#materials-list .sidebar-note-item span:last-child",
  );
  const materialNames = Array.from(materialItems)
    .map((el) => el.textContent.trim())
    .filter(Boolean);

  const contextHint =
    materialNames.length > 0
      ? `The user has uploaded these study materials: ${materialNames.join(", ")}. `
      : "";

  const selectedLanguage =
    summaryLanguageSelect && summaryLanguageSelect.value === "english"
      ? "English"
      : "Arabic";

  const prompt = `${contextHint}Generate a complete and detailed study summary of the uploaded PDF/materials, not a short recap. Cover the main ideas, definitions, important explanations, relationships between concepts, and practical takeaways a student needs to study from. Make each point explanatory (2 to 4 sentences), clear, and useful for revision. Return 10 to 15 detailed points. The output language must be strictly ${selectedLanguage}. Format your response STRICTLY as a JSON array of strings, where each string is one detailed summary point. Example: ["Detailed point one...", "Detailed point two..."]. Do not include any text outside the JSON array.`;

  try {
    const response = await fetch("../../public/api/chat.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "message=" + encodeURIComponent(prompt),
    });

    const data = await response.json();

    if (data.choices && data.choices[0]) {
      let raw = data.choices[0].message.content.trim();

      // bn-extract el JSON array lw fe 7aga zeyada
      const match = raw.match(/\[[\s\S]*\]/);
      if (match) raw = match[0];

      let points = [];
      try {
        points = JSON.parse(raw);
      } catch {
        // lw msh JSON, bn-split 3la el newlines
        points = raw
          .split("\n")
          .filter((l) => l.trim().length > 3)
          .map((l) => l.replace(/^[-*\d.]+\s*/, "").trim());
      }

      // bn-render el items
      summaryContent.innerHTML = points
        .map(
          (point, i) => `
        <div class="summary-item">
          <span class="summary-num">${i + 1}</span>
          <p class="summary-text">${escapeForSummary(point)}</p>
        </div>
      `,
        )
        .join("");

      summaryCount.textContent = `${points.length} detailed summary points`;
      summaryLoading.style.display = "none";
      summaryContent.style.display = "block";
    } else {
      showSummaryError("Couldn't generate a summary. Please try again.");
    }
  } catch (err) {
    showSummaryError("Connection error. Check your internet and try again.");
    console.error(err);
  }
}

// escape HTML 3ashan n-mna3 XSS
function escapeForSummary(text) {
  return text
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;");
}

// bn-show error state
function showSummaryError(msg) {
  summaryLoading.style.display = "none";
  summaryContent.style.display = "flex";
  summaryContent.innerHTML = `
    <div class="summary-error">
      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color:#ef4444;opacity:0.7">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4"/><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"/><path d="M12 16h.01"/>
      </svg>
      <p style="margin:0;font-size:15px;">${msg}</p>
    </div>
  `;
}

async function exportSummaryAsPdf() {
  const points = summaryContent.querySelectorAll(".summary-item .summary-text");
  if (!points.length) {
    showSummaryError("Generate a summary first, then export it as PDF.");
    return;
  }

  if (typeof html2pdf === "undefined") {
    showSummaryError("PDF tool failed to load. Please refresh and try again.");
    return;
  }

  const selectedLanguage =
    summaryLanguageSelect && summaryLanguageSelect.value === "english"
      ? "English"
      : "Arabic";

  const wrapper = document.createElement("div");
  wrapper.style.direction = selectedLanguage === "Arabic" ? "rtl" : "ltr";
  wrapper.style.fontFamily = "Inter, Arial, sans-serif";
  wrapper.style.padding = "20px";
  wrapper.style.color = "#111827";
  wrapper.style.lineHeight = "1.7";
  wrapper.style.background = "#ffffff";

  const title = document.createElement("h1");
  title.textContent =
    selectedLanguage === "Arabic"
      ? "ملخص المذاكرة"
      : "Study Summary";
  title.style.fontSize = "24px";
  title.style.margin = "0 0 14px 0";

  const dateRow = document.createElement("p");
  dateRow.textContent = new Date().toLocaleString();
  dateRow.style.fontSize = "12px";
  dateRow.style.opacity = "0.7";
  dateRow.style.margin = "0 0 18px 0";

  const list = document.createElement("ol");
  list.style.margin = "0";
  list.style.paddingInlineStart = selectedLanguage === "Arabic" ? "20px" : "24px";

  points.forEach((pointEl) => {
    const li = document.createElement("li");
    li.textContent = pointEl.textContent.trim();
    li.style.marginBottom = "10px";
    li.style.fontSize = "14px";
    list.appendChild(li);
  });

  wrapper.appendChild(title);
  wrapper.appendChild(dateRow);
  wrapper.appendChild(list);

  const fileName =
    selectedLanguage === "Arabic"
      ? "study-summary-ar.pdf"
      : "study-summary-en.pdf";

  const opt = {
    margin: 0.5,
    filename: fileName,
    image: { type: "jpeg", quality: 0.98 },
    html2canvas: { scale: 2, useCORS: true },
    jsPDF: { unit: "in", format: "a4", orientation: "portrait" },
  };

  const printableHtml = `
    <html>
      <head>
        <meta charset="UTF-8" />
        <title>${fileName}</title>
        <style>
          body{font-family:Inter,Arial,sans-serif;padding:24px;color:#111827;line-height:1.7;direction:${selectedLanguage === "Arabic" ? "rtl" : "ltr"};}
          h1{font-size:24px;margin:0 0 14px 0;}
          p{font-size:12px;opacity:.7;margin:0 0 18px 0;}
          li{font-size:14px;margin-bottom:10px;}
        </style>
      </head>
      <body>
        ${wrapper.innerHTML}
      </body>
    </html>
  `;

  const originalText = summaryExportBtn ? summaryExportBtn.textContent : "";
  if (summaryExportBtn) {
    summaryExportBtn.textContent = "Preparing PDF...";
    summaryExportBtn.disabled = true;
    summaryExportBtn.style.opacity = "0.7";
  }

  try {
    // Preferred: direct PDF download when library is available.
    if (typeof html2pdf === "undefined") {
      const printWindow = window.open("", "_blank");
      if (!printWindow) {
        showSummaryError("Popup blocked. Allow popups then try export again.");
        return;
      }
      printWindow.document.open();
      printWindow.document.write(printableHtml);
      printWindow.document.close();
      printWindow.focus();
      printWindow.print();
      return;
    }

    await html2pdf().set(opt).from(wrapper).save();
  } catch (error) {
    // Fallback: browser print dialog (Save as PDF) if direct export fails.
    const printWindow = window.open("", "_blank");
    if (!printWindow) {
      showSummaryError("Couldn't export PDF. Allow popups and try again.");
      console.error(error);
      return;
    }
    printWindow.document.open();
    printWindow.document.write(printableHtml);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    console.error(error);
  } finally {
    if (summaryExportBtn) {
      summaryExportBtn.textContent = originalText || "Download Summary PDF";
      summaryExportBtn.disabled = false;
      summaryExportBtn.style.opacity = "1";
    }
  }
}

// Events
if (btnSummary) {
  btnSummary.addEventListener("click", openSummaryModal);
}

if (closeSummaryBtn) {
  closeSummaryBtn.addEventListener("click", closeSummaryModal);
}

if (regenBtn) {
  regenBtn.addEventListener("click", generateSummary);
}

if (summaryExportBtn) {
  summaryExportBtn.addEventListener("click", exportSummaryAsPdf);
}

// N-2fel lw el user das barra el modal card
if (summaryModal) {
  summaryModal.addEventListener("click", (e) => {
    if (e.target === summaryModal) closeSummaryModal();
  });
}
