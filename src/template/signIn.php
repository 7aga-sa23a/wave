<?php require_once __DIR__ . '/../core/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Sign In - Cognify</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/styles2.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="allPage">
        <div class="signup-header">
            <div class="cognify">
                <span><svg class="svg-cog" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15.5 13a3.5 3.5 0 0 0 -3.5 3.5v1a3.5 3.5 0 0 0 7 0v-1.8" />
                    <path d="M8.5 13a3.5 3.5 0 0 1 3.5 3.5v1a3.5 3.5 0 0 1 -7 0v-1.8" />
                    <path d="M17.5 16a3.5 3.5 0 0 0 0 -7h-.5" />
                    <path d="M19 9.3v-2.8a3.5 3.5 0 0 0 -7 0" />
                    <path d="M6.5 16a3.5 3.5 0 0 1 0 -7h.5" />
                    <path d="M5 9.3v-2.8a3.5 3.5 0 0 1 7 0v10" />
                </svg></span>
                <h3>Cognify</h3>
            </div>
            <div class="content">
                <h2>Welcome back</h2>
                <p>Sign in to continue your study journey</p>
            </div>
        </div>

        <form class="signup-form" onsubmit="handleSignIn(event)">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <p class="forgot-password"><a href="forgot-password.php">Forgot Password?</a></p>
            <button type="submit">Sign In</button>
            <p>Don't have an account? <a href="signUp.php">Sign Up</a></p>
        </form>

        <p class="agree">By continuing, you agree to our Terms of Service and Privacy Policy</p>
    </div>

    <script src="<?= JS_URL ?>/signIn.js"></script>
</body>
</html>

