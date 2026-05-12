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
    <form action="<?= TEMPLATES_URL ?>/signIn.php" class="signup-form">
        <div class="check-email-container">
        <div class="verified"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-rosette-discount-check">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" />
            <path d="M9 12l2 2l4 -4" />
        </svg>
        </div>
        <h1 class="check-h1">Check Your Email</h1>
        <p class="p3">We've sent a password reset link to your email address.</p>
        <p class="p4">Didn't receive the email? Check your spam folder or try again.</p>
        </div>
        <button class="back-to-sign-in-button" type="button" onclick ="window.location.href = '<?= TEMPLATES_URL ?>/signIn.php'">Back to Sign In</button>
        <button class="resend-email" type="submit">Resend Email</button>
    </form>
    </div>
    <script src="<?= JS_URL ?>/script.js"></script>
    <?php require __DIR__ . '/partials/theme-foot.php'; ?>
</body>
</html>
