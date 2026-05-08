// El settings el awaleya (Initial settings)
const TOTAL_TIME = 25 * 60; // 25 dqiqa bel sawany
let timeLeft = TOTAL_TIME;
let timerId = null;
const ringCircumference = 2 * Math.PI * 140;

const timeDisplay  = document.getElementById('time-display');
const mainBtn      = document.getElementById('main-btn');
const endBtn       = document.getElementById('end-btn');
const progressRing = document.getElementById('progress-ring');
const endModal     = document.getElementById('end-modal');
const modalCancel  = document.getElementById('modal-cancel');
const modalConfirm = document.getElementById('modal-confirm');

// nzbat toul el dayra bta3et el progress
progressRing.style.strokeDasharray = ringCircumference;

function updateTimer() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timeDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    const offset = ringCircumference - (timeLeft / TOTAL_TIME) * ringCircumference;
    progressRing.style.strokeDashoffset = offset;
}

function startTimer() {
    if (timerId !== null) return;
    mainBtn.textContent = "Pause Session";
    if (endBtn) endBtn.classList.remove('end-btn--hidden');

    timerId = setInterval(() => {
        timeLeft--;
        updateTimer();

        if (timeLeft <= 0) {
            clearInterval(timerId);
            timerId = null;
            if (endBtn) endBtn.classList.add('end-btn--hidden');
            mainBtn.textContent = "Start Session";
            // Redirect to quick summary when time is up
            window.location.href = 'quicksummary.php';
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
    window.location.href = 'quicksummary.php';
}

// ---- Events bta3et el zrayer ----

mainBtn.addEventListener('click', () => {
    if (timerId === null) {
        startTimer();
    } else {
        pauseTimer();
    }
});

endBtn.addEventListener('click', () => {
    // Show confirmation modal before ending the session
    endModal.classList.add('show');
});

modalCancel.addEventListener('click', () => {
    endModal.classList.remove('show');
    // lw kant paused tfdal paused, w lw shaghala trg3 t-kamel
});

modalConfirm.addEventListener('click', () => {
    endModal.classList.remove('show');
    endSession();
});

// bn-2fel el modal lw 7ad das barra el card
endModal.addEventListener('click', (e) => {
    if (e.target === endModal) {
        endModal.classList.remove('show');
    }
});

updateTimer();

// ===== Taghyeer el theme (Theme Switcher) =====
const btnLight = document.getElementById('btn-light');
const btnDark  = document.getElementById('btn-dark');
const htmlEl   = document.documentElement;

function applyTheme(theme) {
    // Fade animation
    document.body.classList.add('theme-switching');
    setTimeout(() => document.body.classList.remove('theme-switching'), 350);

    if (theme === 'dark') {
        htmlEl.setAttribute('data-theme', 'dark');
        btnDark.classList.add('active');
        btnLight.classList.remove('active');
    } else {
        htmlEl.removeAttribute('data-theme');
        btnLight.classList.add('active');
        btnDark.classList.remove('active');
    }

    localStorage.setItem('session-theme', theme);
}

function triggerRipple(btn) {
    btn.classList.remove('ripple');
    void btn.offsetWidth; // reflow
    btn.classList.add('ripple');
    setTimeout(() => btn.classList.remove('ripple'), 400);
}

if (btnLight && btnDark) {
    btnLight.addEventListener('click', () => {
        triggerRipple(btnLight);
        applyTheme('light');
    });

    btnDark.addEventListener('click', () => {
        triggerRipple(btnDark);
        applyTheme('dark');
    });

    // N-apply el theme elly metsayev lma el saf7a t-load
    const savedTheme = localStorage.getItem('session-theme') || 'light';
    applyTheme(savedTheme);
}

// ===== Mantiq el Panels el ganbaya (AI & Notes & Music) =====
const btnAi         = document.getElementById('btn-ai');
const btnCloseAi    = document.getElementById('btn-close-ai');
const btnNotes      = document.getElementById('btn-notes');
const btnCloseNotes = document.getElementById('btn-close-notes');
const btnMusic      = document.getElementById('btn-music');
const btnCloseMusic = document.getElementById('btn-close-music');
const mainLayout    = document.querySelector('.main-layout');

const aiInput       = document.getElementById('ai-input');
const aiSendBtn     = document.getElementById('ai-send-btn');
const aiMessages    = document.getElementById('ai-messages');

const notesText         = document.getElementById('session-notes-text');
const saveNotesBtn      = document.getElementById('save-notes-btn');
const newNoteBtn        = document.getElementById('new-note-btn');
const sidebarNotesCard  = document.getElementById('sidebar-notes-card');
const sidebarNotesPrev  = document.getElementById('sidebar-notes-preview');

const ytLinkInput       = document.getElementById('yt-link-input');
const loadYtBtn         = document.getElementById('load-yt-btn');
const ytPlayerContainer = document.getElementById('yt-player-container');

function openPanel(panelName) {
    mainLayout.classList.remove('with-ai', 'with-notes', 'with-music');
    mainLayout.classList.add('with-' + panelName);
}

function closePanels() {
    mainLayout.classList.remove('with-ai', 'with-notes', 'with-music');
}

if (mainLayout) {
    // AI Toggle (Zrar el AI)
    if (btnAi && btnCloseAi) {
        btnAi.addEventListener('click', () => {
            if (mainLayout.classList.contains('with-ai')) closePanels();
            else openPanel('ai');
        });
        btnCloseAi.addEventListener('click', closePanels);
    }

    // Notes Toggle (Zrar el Notes)
    function toggleNotesPanel() {
        if (mainLayout.classList.contains('with-notes')) closePanels();
        else openPanel('notes');
    }

    if (btnNotes && btnCloseNotes) {
        btnNotes.addEventListener('click', toggleNotesPanel);
        btnCloseNotes.addEventListener('click', closePanels);
    }

    // Removed conflicting sidebarNotesCard listener here. Handled below with delegation.

    // Music Toggle (Zrar el Music)
    if (btnMusic && btnCloseMusic) {
        btnMusic.addEventListener('click', () => {
            if (mainLayout.classList.contains('with-music')) closePanels();
            else openPanel('music');
        });
        btnCloseMusic.addEventListener('click', closePanels);
    }

    // Mantiq el YouTube Player
    if (loadYtBtn && ytLinkInput && ytPlayerContainer) {
        function getYoutubeId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }

        loadYtBtn.addEventListener('click', () => {
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
        
        ytLinkInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') loadYtBtn.click();
        });
    }
    let notesData = JSON.parse(localStorage.getItem('focus-session-notes-list')) || [];
    let currentNoteId = null;

    const sidebarNotesList = document.getElementById('sidebar-notes-list');
    const sidebarAddNoteBtn = document.getElementById('sidebar-add-note-btn');

    function renderSidebarNotes() {
        if (!sidebarNotesList) return;
        sidebarNotesList.innerHTML = '';
        
        if (notesData.length === 0) {
            sidebarNotesList.innerHTML = '<p class="tip-text" style="font-size: 12px; margin: 0;">No notes yet.</p>';
            return;
        }

        notesData.forEach(note => {
            const item = document.createElement('div');
            item.className = 'sidebar-note-item';
            item.textContent = note.text ? note.text.replace(/\n/g, ' ') : 'Empty Note';
            item.addEventListener('click', () => {
                currentNoteId = note.id;
                if (notesText) notesText.value = note.text;
                openPanel('notes');
            });
            sidebarNotesList.appendChild(item);
        });
    }

    // Load el notes el adema
    renderSidebarNotes();

    // Nebda2 Note gdeda
    function startNewNote() {
        currentNoteId = null;
        if (notesText) notesText.value = '';
        openPanel('notes');
    }

    if (sidebarAddNoteBtn) {
        sidebarAddNoteBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // n-mna3 el click 3ala el card
            startNewNote();
        });
    }

    if (newNoteBtn) {
        newNoteBtn.addEventListener('click', startNewNote);
    }

    // Save el Note
    if (saveNotesBtn && notesText) {
        saveNotesBtn.addEventListener('click', () => {
            const text = notesText.value.trim();
            if (!text) return; // bn-mna3 eno y-save note fadya

            if (currentNoteId) {
                // lw mawkoda b-n3ml update
                const note = notesData.find(n => n.id === currentNoteId);
                if (note) note.text = text;
            } else {
                // lw gdeda b-n-create wa7da
                const newNote = { id: Date.now(), text: text };
                notesData.push(newNote);
                currentNoteId = newNote.id;
            }

            localStorage.setItem('focus-session-notes-list', JSON.stringify(notesData));
            renderSidebarNotes();

            // bn-wary el user enak saved (feedback)
            const originalText = saveNotesBtn.textContent;
            saveNotesBtn.textContent = 'Saved!';
            saveNotesBtn.style.background = '#10b981'; // a5dar
            setTimeout(() => {
                saveNotesBtn.textContent = originalText;
                saveNotesBtn.style.background = ''; // n-raga3 kolo zay ma kan
            }, 2000);
        });
    }

    // e5tiyary: n-5aly el card kolha b-click tfta7 el panel
    if (sidebarNotesCard && sidebarNotesList) {
        // bn-dos 3la el mkan el fady bs msh 3ala el items nfsaha
        sidebarNotesCard.addEventListener('click', (e) => {
            if (e.target.closest('.sidebar-note-item') || e.target.closest('#sidebar-add-note-btn')) return;
            openPanel('notes');
        });
    }

    // Mantiq b3t rasayel el AI
    function sendAiMessage() {
        if (!aiInput) return;
        const text = aiInput.value.trim();
        if (!text) return;

        // resalet el user
        const userMsg = document.createElement('div');
        userMsg.className = 'ai-msg sent';
        userMsg.textContent = text;
        aiMessages.appendChild(userMsg);
        
        aiInput.value = '';
        aiMessages.scrollTop = aiMessages.scrollHeight;

        // bn-2aled el AI w hwa bykteb (delay)
        setTimeout(() => {
            const aiReply = document.createElement('div');
            aiReply.className = 'ai-msg received';
            aiReply.textContent = "That's a great point! Keep focusing and let me know if you need more tips.";
            aiMessages.appendChild(aiReply);
            aiMessages.scrollTop = aiMessages.scrollHeight;
        }, 1000);
    }

    if (aiSendBtn) aiSendBtn.addEventListener('click', sendAiMessage);
    
    if (aiInput) {
        aiInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendAiMessage();
        });
    }
}