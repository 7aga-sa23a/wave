<?php require_once __DIR__ . '/../core/config.php'; ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <?php require __DIR__ . '/partials/theme-head.php'; ?>
        <title>uploading materials</title>
        <link rel="stylesheet" href="<?= CSS_URL ?>/styles3.css" />
        <link rel="stylesheet" href="<?= CSS_URL ?>/theme-global.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <?php require __DIR__ . '/paths.php'; ?>
        <script src="<?= JS_URL ?>/auth.js?v=<?= time() ?>"></script>
</head>
    <body>
        <a href="<?= TEMPLATES_URL ?>/study-session.php" class="back-Dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6"/></svg>
        Back to Dashboard
        </a>

        <div class="uploading-material-container">
            <div class="study-material-txt">
                <h1>Upload Study Material</h1>
                <p>Optional: Add materials to enhance your study session</p>
        
            </div>
            <div class="study-materials">
                <div class="image">
                    <div class="photo-svg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-photo">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 8h.01" />
                        <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12" />
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                    </svg>
                    </div>
                    <h2>Upload Image</h2>
                    <p>JPG, PNG, or GIF</p>
                </div>
                <div class="pdf">
                    <div class="photo-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" />
                            <path d="M9 9l1 0" />
                            <path d="M9 13l6 0" />
                            <path d="M9 17l6 0" />
                        </svg>
                    </div>
                    <h2>Upload PDF</h2>
                    <p>Study materials or notes</p>
                </div>
                <div class="txt">
                    <div class="photo-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-text-size">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 7v-2h13v2" />
                            <path d="M10 5v14" />
                            <path d="M12 19h-4" />
                            <path d="M15 13v-1h6v1" />
                            <path d="M18 12v7" />
                            <path d="M17 19h2" />
                        </svg>
                    </div>
                    <h2>Text Input</h2>
                    <p>Paste or type content</p>
                </div>
            </div>
            <div class="drag-file">
                <div class="upload-file-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 9l5 -5l5 5" />
                        <path d="M12 4l0 12" />
                    </svg>
                </div>
                
                    <h2>Drag and Drop Files Here</h2>
                    <p>Or click to browse your computer</p>
                    <button class="choose-file-btn">Choose File</button>
                
            </div>
            <div class="drag-continue-btns">
                <button class="skip-btn" onclick="skipToSession()">Skip For Now</button>
                <button class="continue-btn" id="continue-btn" onclick="continueToSession()">Continue &rarr;</button>
            </div>
        </div>

        <!-- Hidden file input -->
        <input type="file" id="file-input" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.txt" style="display:none;">

        <!-- Uploaded files preview -->
        <div id="uploaded-files-preview" style="max-width:700px; margin: 20px auto; display:none;">
            <h3 style="font-family:'Inter',sans-serif; margin-bottom:12px; color:#4f46e5;">Uploaded Files</h3>
            <div id="files-list" style="display:flex; flex-direction:column; gap:10px;"></div>
        </div>

        <script src="<?= JS_URL ?>/uploading-material.js"></script>
        <?php require __DIR__ . '/partials/theme-foot.php'; ?>
    </body>
    </html>
