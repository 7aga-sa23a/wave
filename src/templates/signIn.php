<?php session_start();
 require_once __DIR__ . '/../core/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <?php require __DIR__ . '/partials/theme-head.php'; ?>
    <title>Sign In - Cognify</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/styles2.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/theme-global.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/error.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="allPage">
        <div class="signup-header">
            <div class="cognify">
                <img src="<?=IMG_URL ?>/Container.png" alt="wave Logo">
            </div>
            <div class="content">
                <h2>Welcome back</h2>
                <?php if (isset($_SESSION["login_success"])): ?>
              <div class="pass-msg">
                <?php 
                echo htmlspecialchars($_SESSION["login_success"]);
                unset($_SESSION["login_success"]);
                 ?>
             </div>
                 <?php endif; ?>
                <p>Sign in to continue your study journey</p>
               <?php if (isset($_SESSION["login_error"])): ?>
              <div class="error-msg">
                <?php 
                echo htmlspecialchars($_SESSION["login_error"]);
                unset($_SESSION["login_error"]);
                 ?>
             </div>
                 <?php endif; ?>
            </div>
        </div>

        <form class="signup-form" action="<?= LOGIC_URL ?>/Login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <p class="forgot-password"><a href="<?= TEMPLATES_URL ?>/forgot-password.php">Forgot Password?</a></p>
            <button type="submit" name ="login">Sign In</button>
            <p>Don't have an account? <a href="<?= TEMPLATES_URL ?>/signUp.php">Sign Up</a></p>
        </form>

        <p class="agree">By continuing, you agree to our Terms of Service and Privacy Policy</p>
    </div>

    <script src="<?= JS_URL ?>/signIn.js"></script>
    <?php require __DIR__ . '/partials/theme-foot.php'; ?>
</body>
</html>
