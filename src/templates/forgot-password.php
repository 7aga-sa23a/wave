<?php require_once __DIR__ . '/../core/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require __DIR__ . '/partials/theme-head.php'; ?>
    <title>forgot password</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/styles2.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/theme-global.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <?php require __DIR__ . '/paths.php'; ?>
    <script src="<?= JS_URL ?>/auth.js"></script>
</head>
<body>
    <div class="allPage">
    <div class="signup-header">
        <div class="cognify">
            <div class="cognify">
                <img src="<?=IMG_URL ?>/Container.png" alt="wave Logo">
            </div>
            </div>
            <div class="content">
                <h2>Forgot Password?</h2>
                <p>No worries, we'll send you reset instructions</p>
            </div>
    </div>
    <form action="<?= TEMPLATES_URL ?>/email-check.php" class="signup-form">
        <div class="forget-password-massege">
            <span><svg class="mail" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
                <path d="M3 7l9 6l9 -6" />
            </svg></span>
            <p>Enter your email and we'll send you a link to reset your password</p>
        </div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <button class="send-reset-button" type="button"onclick = "window.location.href='<?= TEMPLATES_URL ?>/email-check.php'">Send Reset Link</button>
    </form>
    <div class="back-to-sign-in-container">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left">
	<path stroke="none" d="M0 0h24v24H0z" fill="none" />
	<path d="M5 12l14 0" />
	<path d="M5 12l4 4" />
	<path d="M5 12l4 -4" />
    </svg>
    <p class="back-to-sign-in"><a href="<?= TEMPLATES_URL ?>/signIn.php">Back to sign in</a></p>
    </div>
    </div>
    
    <script src="<?= JS_URL ?>/script.js"></script>
    <?php require __DIR__ . '/partials/theme-foot.php'; ?>
</body>
</html>