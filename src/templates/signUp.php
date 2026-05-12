<?php require_once __DIR__ . '/../core/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Sign Up - Cognify</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/styles2.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="allPage">
        <div class="signup-header">
            <div class="cognify">
                    <img src="<?=IMG_URL ?>/Container.png" alt="Cognify Logo">
            </div>
            <div class="content">
                <h2>Create your account</h2>
                <p>Start your study journey today</p>
            </div>
        </div>

        <form class="signup-form" onsubmit="handleSignUp(event)">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="<?= TEMPLATES_URL ?>/signIn.php">Sign In</a></p>
        </form>

        <p class="agree">By continuing, you agree to our Terms of Service and Privacy Policy</p>
    </div>

    <script src="<?= JS_URL ?>/signUp.js"></script>
</body>
</html>

