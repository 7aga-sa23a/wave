<?php require_once __DIR__ . '/../core/config.php'; ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <?php require __DIR__ . '/partials/theme-head.php'; ?>
        <title>focus session</title>
        <link rel="stylesheet" href="<?= CSS_URL ?>/styles-session.css?v=3" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <?php require __DIR__ . '/paths.php'; ?>
        <script src="<?= JS_URL ?>/auth.js"></script>
</head>
    <body>
<div class="container">
        <a href="<?= TEMPLATES_URL ?>/uploading-material.php" class="back-link">Back to Upload Study Material</a>
        <div class="main-layout">
            <div class="sidebar">
                <div class="card" id="materials-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span class="card-label">MATERIALS</span>
                        <a href="<?= TEMPLATES_URL ?>/uploading-material.php" style="font-size: 12px; color: var(--primary-color); text-decoration: none;">+ Add</a>
                    </div>
                    <div id="materials-list" style="display: flex; flex-direction: column; gap: 8px; max-height: 160px; overflow-y: auto; padding-right: 4px;">
                        <p class="tip-text" style="font-size: 12px; margin: 0;">No materials uploaded.</p>
                    </div>
                </div>

                <div class="card" id="sidebar-notes-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span class="card-label">MY NOTES</span>
                        <button id="sidebar-add-note-btn" style="background: var(--primary-color); color: #fff; border: none; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px;">+</button>
                    </div>
                    <div id="sidebar-notes-list" style="display: flex; flex-direction: column; gap: 8px; max-height: 150px; overflow-y: auto; padding-right: 4px;">
                        <!-- Notes will be injected here -->
                        <p class="tip-text" style="font-size: 12px; margin: 0;">No notes yet.</p>
                    </div>
                </div>
            </div>

            <div class="timer-section">
                <h1>Focus Session</h1>
                <p class="subtitle">Ready to begin your study session?</p>

                <div class="timer-container">
                    <svg class="progress-ring-svg" width="300" height="300">
                        <circle class="ring-bg" cx="150" cy="150" r="140"></circle>
                        <circle id="progress-ring" class="ring-bar" cx="150" cy="150" r="140"></circle>
                    </svg>
                    <div class="timer-content">
                        <span id="time-display">25:00</span>
                        <span class="timer-label">Minutes to focus</span>
                    </div>
                </div>

                <div class="btn-group">
                    <button id="main-btn" class="start-btn">Start Session</button>
                    <button id="end-btn" class="end-btn end-btn--hidden">End Session</button>
                </div>
            </div>

            <div class="side-panel ai-chat-window" id="ai-chat">
                <div class="ai-chat-header">
                    <div class="ai-header-info">
                        <div class="ai-avatar" style="display:flex; align-items:center; justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"/><path d="M12 2v2"/><path d="M9 12v9"/><path d="M15 12v9"/><path d="M5 16l4 -2"/><path d="M15 14l4 2"/><path d="M9 18h6"/><path d="M10 8v.01"/><path d="M14 8v.01"/></svg>
                        </div>
                        <span>AI Companion</span>
                    </div>
                    <button class="ai-close-btn" id="btn-close-ai">&times;</button>
                </div>
                <div class="ai-chat-messages" id="ai-messages">
                    <div class="ai-msg received">
                        Hi there! Ready to focus? I'm here to help you stay productive.
                    </div>
                </div>
                <div class="ai-chat-input-area">
                    <input type="text" id="ai-input" placeholder="Ask me anything...">
                    <button id="ai-send-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Notes Window -->
            <div class="side-panel notes-window" id="notes-window">
                <div class="ai-chat-header">
                    <div class="ai-header-info">
                        <div class="ai-avatar" style="background:#eab308; display:flex; align-items:center; justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/><path d="M13 8l2 0"/><path d="M13 12l2 0"/></svg>
                        </div>
                        <span>Session Notes</span>
                    </div>
                    <button class="ai-close-btn" id="btn-close-notes">&times;</button>
                </div>
                <div class="notes-content">
                    <textarea id="session-notes-text" placeholder="Jot down your brilliant ideas here..."></textarea>
                </div>
                <div class="ai-chat-input-area" style="justify-content: flex-end; gap: 10px;">
                    <button id="new-note-btn" style="width: auto; padding: 0 20px; border-radius: 8px; font-weight: 600; background: transparent; border: 1px solid var(--border-color); color: var(--text-main); cursor: pointer; transition: background 0.2s;">New Note</button>
                    <button id="save-notes-btn" style="width: auto; padding: 0 20px; border-radius: 8px; font-weight: 600;">Save Notes</button>
                </div>
            </div>

            <!-- Music Window -->
            <div class="side-panel music-window" id="music-window">
                <div class="ai-chat-header">
                    <div class="ai-header-info">
                        <div class="ai-avatar" style="background:#8b5cf6; display:flex; align-items:center; justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/><path d="M13 17a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/><path d="M9 17v-13l10 -2v13"/><path d="M9 8l10 -2"/></svg>
                        </div>
                        <span>Soundscape Player</span>
                    </div>
                    <button class="ai-close-btn" id="btn-close-music">&times;</button>
                </div>
                <div class="notes-content" style="flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 10px;">
                        <input type="text" id="yt-link-input" placeholder="Paste YouTube link here..." style="flex: 1; padding: 10px 14px; border-radius: 8px; border: 1px solid var(--border-color); background: transparent; color: var(--text-main); font-family: inherit;">
                        <button id="load-yt-btn" style="padding: 0 16px; border-radius: 8px; border: none; background: var(--primary-color); color: #fff; cursor: pointer; font-weight: 600;">Play</button>
                    </div>
                    <div id="yt-player-container" style="flex: 1; border-radius: 12px; overflow: hidden; background: #000; display: flex; align-items: center; justify-content: center; color: #666;">
                        <span>No video loaded</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="toolbar">
            <div class="theme-switcher">
                <button class="theme-btn" id="btn-light" title="Light Mode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z"/>
                    </svg>
                </button>
                <button class="theme-btn" id="btn-dark" title="Dark Mode">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2h.1A6.979 6.979 0 0 0 10 7zm-6 5a8 8 0 0 0 15.062 3.762A9 9 0 0 1 8.238 4.938 7.999 7.999 0 0 0 4 12z"/>
                    </svg>
                </button>
            </div>
            <div class="divider"></div>
            <div class="toolbar-info">
                <span>AI COMPANION</span>
                <!-- Brain / AI icon -->
                <button class="tool-icon" id="btn-ai" title="AI Assistant">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M15.5 13a3.5 3.5 0 0 0 -3.5 3.5v1a3.5 3.5 0 0 0 7 0v-1.8"/>
                        <path d="M8.5 13a3.5 3.5 0 0 1 3.5 3.5v1a3.5 3.5 0 0 1 -7 0v-1.8"/>
                        <path d="M17.5 16a3.5 3.5 0 0 0 0 -7h-.5"/>
                        <path d="M19 9.3v-2.8a3.5 3.5 0 0 0 -7 0"/>
                        <path d="M6.5 16a3.5 3.5 0 0 1 0 -7h.5"/>
                        <path d="M5 9.3v-2.8a3.5 3.5 0 0 1 7 0v10"/>
                    </svg>
                </button>
                <!-- Notes icon -->
                <button class="tool-icon" id="btn-notes" title="Notes">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/>
                        <path d="M13 8l2 0"/><path d="M13 12l2 0"/>
                    </svg>
                </button>
                <!-- Quiz icon -->
                <button class="tool-icon" title="Quiz">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"/>
                        <path d="M8 9h1l3 3l3 -3h1"/>
                        <path d="M8 15h8"/>
                        <path d="M9 12h6"/>
                    </svg>
                </button>
            </div>
            <div class="divider"></div>
            <button class="soundscape" id="btn-music" style="background:transparent; border:none; cursor:pointer; font-family:inherit; color:var(--text-muted); padding:0;">
                <!-- Music icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-right:4px;">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 17a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                    <path d="M13 17a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                    <path d="M9 17v-13l10 -2v13"/>
                    <path d="M9 8l10 -2"/>
                </svg>
                SOUNDSCAPE: <strong>YouTube Player</strong>
            </button>
        </div>
    </div>
    <div id="end-modal">
        <div class="modal-card">
            <h2 class="modal-title">End Session Early?</h2>
            <p class="modal-desc">
                You still have time left in your session.<br>Are you sure you want to end it now?
            </p>
            <div class="modal-actions">
                <button id="modal-cancel" class="modal-btn-cancel">Keep Going</button>
                <button id="modal-confirm" class="modal-btn-confirm">End Session</button>
            </div>
        </div>
    </div>

    <?php require __DIR__ . '/partials/theme-foot.php'; ?>
    <script src="<?= JS_URL ?>/script.js"></script>

    <!-- File Viewer Modal -->
    <div id="file-viewer-modal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.7); backdrop-filter:blur(6px); align-items:center; justify-content:center;">
        <div style="background:var(--card-bg); border-radius:20px; width:90%; max-width:900px; height:85vh; display:flex; flex-direction:column; box-shadow:0 25px 60px rgba(0,0,0,0.3); overflow:hidden;">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 24px; border-bottom:1px solid var(--border-color);">
                <div style="display:flex; align-items:center; gap:10px;">
                    <span id="viewer-file-icon" style="display:flex; align-items:center;"></span>
                    <span id="viewer-file-name" style="font-weight:600; font-size:15px; color:var(--text-main);"></span>
                </div>
                <button id="close-viewer-btn" style="background:transparent; border:none; font-size:22px; cursor:pointer; color:var(--text-muted); line-height:1;">&times;</button>
            </div>
            <div id="iframe-container" style="flex:1; overflow:hidden; padding:0;">
                <iframe id="viewer-iframe" src="" style="width:100%; height:100%; border:none;"></iframe>
            </div>
        </div>
    </div>

    <script src="<?= JS_URL ?>/focus-session-materials.js"></script>
    </body>
    </html>
