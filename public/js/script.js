// El settings el awaleya (Initial settings)
const TOTAL_TIME = 25 * 60; // 25 dqiqa bel sawany
const QUICKSUMMARY_STORAGE_KEY = "quicksummary-session";
let timeLeft = TOTAL_TIME;
let timerId = null;
const ringCircumference = 2 * Math.PI * 140;

const timeDisplay = document.getElementById("time-display");
const mainBtn = document.getElementById("main-btn");
const mainBtnIconPlay = mainBtn?.querySelector(".session-main-btn__icon--play");
const mainBtnIconPause = mainBtn?.querySelector(".session-main-btn__icon--pause");
const endBtn = document.getElementById("end-btn");
const progressRing = document.getElementById("progress-ring");
const endModal = document.getElementById("end-modal");
const modalCancel = document.getElementById("modal-cancel");
const modalConfirm = document.getElementById("modal-confirm");

// nzbat toul el dayra bta3et el progress
progressRing.style.strokeDasharray = ringCircumference;

function setSessionMainButtonState(state) {
  if (!mainBtn || !mainBtnIconPlay || !mainBtnIconPause) return;
  if (state === "running") {
    mainBtnIconPlay.classList.add("is-hidden");
    mainBtnIconPause.classList.remove("is-hidden");
    mainBtn.setAttribute("aria-label", "Pause session");
    mainBtn.setAttribute("title", "Pause session");
  } else if (state === "paused") {
    mainBtnIconPlay.classList.remove("is-hidden");
    mainBtnIconPause.classList.add("is-hidden");
    mainBtn.setAttribute("aria-label", "Resume session");
    mainBtn.setAttribute("title", "Resume session");
  } else {
    mainBtnIconPlay.classList.remove("is-hidden");
    mainBtnIconPause.classList.add("is-hidden");
    mainBtn.setAttribute("aria-label", "Start session");
    mainBtn.setAttribute("title", "Start session");
  }
}

function excerptFromMaterialFile(file) {
  if (!file || !file.dataUrl || typeof file.dataUrl !== "string") return "";
  const comma = file.dataUrl.indexOf(",");
  if (comma === -1) return "";
  const header = file.dataUrl.slice(0, comma);
  const b64 = file.dataUrl.slice(comma + 1);
  const mimeMatch = header.match(/data:([^;,]+)/i);
  const mime = mimeMatch ? mimeMatch[1].toLowerCase().trim() : "";
  const isText =
    mime.startsWith("text/") ||
    mime === "application/json" ||
    mime === "application/xml" ||
    mime.endsWith("+xml");
  if (!isText) return "";
  try {
    const binary = atob(b64);
    const bytes = new Uint8Array(binary.length);
    for (let i = 0; i < binary.length; i++) {
      bytes[i] = binary.charCodeAt(i);
    }
    const text = new TextDecoder("utf-8", { fatal: false }).decode(bytes);
    return text.length > 12000 ? text.slice(0, 12000) : text;
  } catch (e) {
    return "";
  }
}

function loadMaterialExcerptsFromIndexedDB() {
  return new Promise((resolve) => {
    if (!window.indexedDB) {
      resolve([]);
      return;
    }
    const openReq = indexedDB.open("CognifyDB", 1);
    openReq.onerror = () => resolve([]);
    openReq.onsuccess = () => {
      const db = openReq.result;
      if (!db.objectStoreNames.contains("materials")) {
        db.close();
        resolve([]);
        return;
      }
      const tx = db.transaction("materials", "readonly");
      const getAll = tx.objectStore("materials").getAll();
      getAll.onerror = () => {
        db.close();
        resolve([]);
      };
      getAll.onsuccess = () => {
        const rows = getAll.result || [];
        const excerpts = [];
        for (const file of rows) {
          if (!file || typeof file.name !== "string") continue;
          excerpts.push({
            name: file.name,
            excerpt: excerptFromMaterialFile(file),
          });
        }
        db.close();
        resolve(excerpts);
      };
    };
  });
}

async function gatherFocusSessionContextForSummary() {
  let notes = [];
  try {
    notes =
      JSON.parse(localStorage.getItem("focus-session-notes-list") || "[]") ||
      [];
  } catch (e) {
    notes = [];
  }
  const noteTexts = notes
    .map((n) => (n && n.text ? String(n.text).trim() : ""))
    .filter(Boolean);

  const materialItems = document.querySelectorAll(
    "#materials-list .sidebar-note-item span:last-child",
  );
  const materials = Array.from(materialItems)
    .map((el) => el.textContent.trim())
    .filter(Boolean);

  const chat = [];
  const aiMessagesEl = document.getElementById("ai-messages");
  if (aiMessagesEl) {
    aiMessagesEl.querySelectorAll(".ai-msg").forEach((msg) => {
      if (msg.querySelector(".typing-animation")) return;
      const role = msg.classList.contains("sent") ? "user" : "assistant";
      const text = msg.textContent.replace(/\s+/g, " ").trim();
      if (!text || text.length < 2) return;
      chat.push({
        role,
        text: text.length > 2000 ? text.slice(0, 2000) : text,
      });
    });
  }

  const materialExcerpts = await loadMaterialExcerptsFromIndexedDB();

  return {
    notes: noteTexts,
    materials,
    materialExcerpts,
    chat,
  };
}

async function persistSessionSnapshotForQuickSummary() {
  let notes = [];
  try {
    notes =
      JSON.parse(localStorage.getItem("focus-session-notes-list") || "[]") ||
      [];
  } catch (e) {
    notes = [];
  }
  const noteTexts = notes
    .map((n) => (n && n.text ? String(n.text).trim() : ""))
    .filter(Boolean);

  const materialEls = document.querySelectorAll(
    "#materials-list .sidebar-note-item span:last-child",
  );
  const materials = Array.from(materialEls)
    .map((el) => el.textContent.trim())
    .filter(Boolean);

  const chat = [];
  const aiMessagesEl = document.getElementById("ai-messages");
  if (aiMessagesEl) {
    aiMessagesEl.querySelectorAll(".ai-msg").forEach((msg) => {
      if (msg.querySelector(".typing-animation")) return;
      const role = msg.classList.contains("sent") ? "user" : "assistant";
      const text = msg.textContent.replace(/\s+/g, " ").trim();
      if (!text || text.length < 2) return;
      chat.push({
        role,
        text: text.length > 2000 ? text.slice(0, 2000) : text,
      });
    });
  }

  const elapsedSeconds = Math.max(0, TOTAL_TIME - timeLeft);
  const materialExcerpts = await loadMaterialExcerptsFromIndexedDB();

  try {
    sessionStorage.removeItem("session-quiz-questions");
  } catch (e) {
    /* ignore */
  }

  const snapshot = {
    notes: noteTexts,
    materials,
    materialExcerpts,
    chat,
    elapsedSeconds,
    totalSessionMinutes: Math.round(TOTAL_TIME / 60),
  };
  try {
    sessionStorage.setItem(
      QUICKSUMMARY_STORAGE_KEY,
      JSON.stringify(snapshot),
    );
  } catch (e) {
    /* quota or disabled */
  }
}

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
  setSessionMainButtonState("running");
  if (endBtn) endBtn.classList.remove("end-btn--hidden");

  timerId = setInterval(() => {
    timeLeft--;
    updateTimer();

    if (timeLeft <= 0) {
      clearInterval(timerId);
      timerId = null;
      if (endBtn) endBtn.classList.add("end-btn--hidden");
      setSessionMainButtonState("start");
      persistSessionSnapshotForQuickSummary().then(() => {
        window.location.href = "quicksummary.php";
      });
    }
  }, 1000);
}

function pauseTimer() {
  clearInterval(timerId);
  timerId = null;
  setSessionMainButtonState("paused");
}

function endSession() {
  clearInterval(timerId);
  timerId = null;
  persistSessionSnapshotForQuickSummary().then(() => {
    window.location.href = "quicksummary.php";
  });
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
const deleteNoteBtn = document.getElementById("delete-note-btn");
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

  const NOTES_TRASH_SVG = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 7h16"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/><path d="M9 7V5a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v2"/></svg>`;

  const NOTES_NOTEBOOK_ICON = `<span class="sidebar-note-preview__ico"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/><path d="M13 8l2 0"/><path d="M13 12l2 0"/></svg></span>`;

  const NOTES_SAVE_DISK_SVG = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21h-14a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h11l5 5v11a2 2 0 0 1 -2 2"/><path d="M17 21v-8h-10v8"/><path d="M7 3v6h8"/></svg>`;

  const NOTES_SAVE_CHECK_SVG = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>`;

  const NOTES_SIDEBAR_EMPTY_HTML = `<div class="sidebar-notes-empty" role="status" title="Tap + to add a note"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/><path d="M13 8l2 0"/><path d="M13 12l2 0"/><path d="M12 16h.01"/></svg><span class="notes-sr-only">No notes yet. Use the plus button to add one.</span></div>`;

  function syncNotesToolbar() {
    if (!deleteNoteBtn) return;
    const editing = !!currentNoteId;
    deleteNoteBtn.disabled = !editing;
    deleteNoteBtn.setAttribute("aria-disabled", editing ? "false" : "true");
  }

  function persistNotesAndRefreshSidebar() {
    localStorage.setItem(
      "focus-session-notes-list",
      JSON.stringify(notesData),
    );
    renderSidebarNotes();
    syncNotesToolbar();
  }

  function deleteNoteById(noteId) {
    if (noteId == null) return;
    if (
      typeof window.confirm === "function" &&
      !confirm("Delete this note? This cannot be undone.")
    ) {
      return;
    }
    notesData = notesData.filter((n) => n.id !== noteId);
    if (currentNoteId === noteId) {
      currentNoteId = null;
      if (notesText) notesText.value = "";
    }
    persistNotesAndRefreshSidebar();
  }

  function renderSidebarNotes() {
    if (!sidebarNotesList) return;
    sidebarNotesList.innerHTML = "";

    if (notesData.length === 0) {
      sidebarNotesList.innerHTML = NOTES_SIDEBAR_EMPTY_HTML;
      syncNotesToolbar();
      return;
    }

    notesData.forEach((note, index) => {
      const row = document.createElement("div");
      row.className = "sidebar-note-row";

      const preview = document.createElement("button");
      preview.type = "button";
      preview.className = "sidebar-note-preview";
      const previewSnippet = note.text
        ? note.text.replace(/\s+/g, " ").trim().slice(0, 140)
        : "";
      preview.innerHTML =
        NOTES_NOTEBOOK_ICON +
        `<span class="sidebar-note-preview__num" aria-hidden="true">${index + 1}</span>`;
      preview.setAttribute(
        "aria-label",
        previewSnippet
          ? `Open note ${index + 1}: ${previewSnippet}`
          : `Open note ${index + 1} (empty)`,
      );
      preview.setAttribute(
        "title",
        previewSnippet ||
          ("Empty note " + String(index + 1)),
      );
      preview.addEventListener("click", () => {
        currentNoteId = note.id;
        if (notesText) notesText.value = note.text || "";
        openPanel("notes");
        syncNotesToolbar();
      });

      const del = document.createElement("button");
      del.type = "button";
      del.className = "sidebar-note-delete";
      del.innerHTML = NOTES_TRASH_SVG;
      del.setAttribute("aria-label", "Delete note");
      del.setAttribute("title", "Delete note");
      del.addEventListener("click", (ev) => {
        ev.stopPropagation();
        deleteNoteById(note.id);
      });

      row.appendChild(preview);
      row.appendChild(del);
      sidebarNotesList.appendChild(row);
    });
    syncNotesToolbar();
  }

  // Load el notes el adema
  renderSidebarNotes();

  // Nebda2 Note gdeda
  function startNewNote() {
    currentNoteId = null;
    if (notesText) notesText.value = "";
    openPanel("notes");
    syncNotesToolbar();
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
      syncNotesToolbar();

      saveNotesBtn.innerHTML = NOTES_SAVE_CHECK_SVG;
      saveNotesBtn.classList.add("notes-icon-btn--saved");
      setTimeout(() => {
        saveNotesBtn.innerHTML = NOTES_SAVE_DISK_SVG;
        saveNotesBtn.classList.remove("notes-icon-btn--saved");
      }, 1600);
    });
  }

  // e5tiyary: n-5aly el card kolha b-click tfta7 el panel
  if (sidebarNotesCard && sidebarNotesList) {
    // bn-dos 3ala el mkan el fady bs msh 3ala el صف أو زر الإضافة
    sidebarNotesCard.addEventListener("click", (e) => {
      if (
        e.target.closest(".sidebar-note-row") ||
        e.target.closest("#sidebar-add-note-btn")
      )
        return;
      openPanel("notes");
    });
  }

  if (deleteNoteBtn) {
    deleteNoteBtn.addEventListener("click", () => {
      if (!currentNoteId) return;
      deleteNoteById(currentNoteId);
    });
  }

  syncNotesToolbar();

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

function renderStructuredSummary(data) {
  const lang = data.language
    ? data.language
    : summaryLanguageSelect && summaryLanguageSelect.value === "english"
      ? "english"
      : "arabic";
  const dir = lang === "arabic" ? "rtl" : "ltr";
  const overviewLabel =
    lang === "arabic" ? "نظرة سريعة" : "At a glance";
  const themesLabel =
    lang === "arabic" ? "أهم النقاط" : "Key themes";
  const bridgeLabel =
    lang === "arabic" ? "خلاصة الجلسة" : "Session takeaway";

  const highlights = Array.isArray(data.highlights) ? data.highlights : [];
  const hlHtml = highlights
    .map(
      (h, i) => `
    <article class="summary-highlight-card" style="animation-delay:${0.05 * i}s">
      <div class="summary-highlight-index">${i + 1}</div>
      <div class="summary-highlight-body">
        <h4 class="summary-highlight-title">${escapeForSummary(h.title || "")}</h4>
        <p class="summary-highlight-text">${escapeForSummary(h.text || "")}</p>
      </div>
    </article>`,
    )
    .join("");

  const bridge = (data.session_bridge || "").trim();
  const themesSection =
    highlights.length > 0
      ? `<h3 class="summary-section-heading">${themesLabel}</h3>
      <div class="summary-highlights-grid">${hlHtml}</div>`
      : "";

  const overviewSection = (data.overview || "").trim()
    ? `<section class="summary-overview-block" aria-label="${overviewLabel}">
        <span class="summary-overview-label">${overviewLabel}</span>
        <p class="summary-overview-text">${escapeForSummary(data.overview || "")}</p>
      </section>`
    : "";

  summaryContent.setAttribute("dir", dir);
  summaryContent.innerHTML = `
    <div class="summary-layout">
      ${overviewSection}
      ${themesSection}
      ${
        bridge
          ? `<aside class="summary-bridge" aria-label="${bridgeLabel}">
        <span class="summary-bridge-label">${bridgeLabel}</span>
        <p class="summary-bridge-text">${escapeForSummary(bridge)}</p>
      </aside>`
          : ""
      }
    </div>`;
}

// bn-generate el summary mn el AI (structured: overview + themed cards + bridge)
async function generateSummary() {
  summaryLoading.style.display = "flex";
  summaryContent.style.display = "none";
  summaryContent.innerHTML = "";
  summaryCount.textContent = "";

  const lang =
    summaryLanguageSelect && summaryLanguageSelect.value === "english"
      ? "english"
      : "arabic";

  try {
    const ctx = await gatherFocusSessionContextForSummary();
    const response = await fetch("../../public/api/focus-session-summary.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ ...ctx, language: lang }),
    });

    const data = await response.json();

    if (data.error) {
      showSummaryError(
        typeof data.error === "string"
          ? data.error
          : "Couldn't generate a summary. Please try again.",
      );
      return;
    }

    const hasBody =
      (data.overview && String(data.overview).trim()) ||
      (Array.isArray(data.highlights) && data.highlights.length > 0);
    if (!hasBody) {
      showSummaryError("Couldn't generate a summary. Please try again.");
      return;
    }

    renderStructuredSummary(data);
    const n = Array.isArray(data.highlights) ? data.highlights.length : 0;
    summaryCount.textContent =
      lang === "arabic"
        ? n === 1
          ? "نقطة رئيسية واحدة"
          : `${n} نقاط رئيسية`
        : n === 1
          ? "1 themed highlight"
          : `${n} themed highlights`;
    summaryLoading.style.display = "none";
    summaryContent.style.display = "block";
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
  summaryContent.style.display = "block";
  summaryContent.removeAttribute("dir");
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
  const overviewEl = summaryContent.querySelector(".summary-overview-text");
  const cards = summaryContent.querySelectorAll(".summary-highlight-card");
  if (!overviewEl && cards.length === 0) {
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

  wrapper.appendChild(title);
  wrapper.appendChild(dateRow);

  if (overviewEl && overviewEl.textContent.trim()) {
    const intro = document.createElement("p");
    intro.textContent = overviewEl.textContent.trim();
    intro.style.fontSize = "15px";
    intro.style.margin = "0 0 18px 0";
    intro.style.lineHeight = "1.65";
    wrapper.appendChild(intro);
  }

  cards.forEach((card) => {
    const ht = card.querySelector(".summary-highlight-title");
    const tx = card.querySelector(".summary-highlight-text");
    const h2 = document.createElement("h2");
    h2.textContent = ht ? ht.textContent.trim() : "";
    h2.style.fontSize = "16px";
    h2.style.margin = "14px 0 6px 0";
    const p = document.createElement("p");
    p.textContent = tx ? tx.textContent.trim() : "";
    p.style.fontSize = "14px";
    p.style.margin = "0 0 10px 0";
    p.style.lineHeight = "1.6";
    wrapper.appendChild(h2);
    wrapper.appendChild(p);
  });

  const bridgeEl = summaryContent.querySelector(".summary-bridge-text");
  if (bridgeEl && bridgeEl.textContent.trim()) {
    const bTitle = document.createElement("p");
    bTitle.textContent =
      selectedLanguage === "Arabic" ? "خلاصة الجلسة" : "Session takeaway";
    bTitle.style.fontSize = "13px";
    bTitle.style.fontWeight = "700";
    bTitle.style.margin = "18px 0 6px 0";
    const bBody = document.createElement("p");
    bBody.textContent = bridgeEl.textContent.trim();
    bBody.style.fontSize = "14px";
    bBody.style.margin = "0";
    wrapper.appendChild(bTitle);
    wrapper.appendChild(bBody);
  }

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

if (summaryLanguageSelect) {
  summaryLanguageSelect.addEventListener("change", () => {
    if (summaryModal && summaryModal.style.display === "flex") {
      generateSummary();
    }
  });
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
