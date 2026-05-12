<?php require_once __DIR__ . '/../core/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found | Cognify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #e0e2ff;
            --text: #25282d;
            --text-light: #6b7280;
            --white: #ffffff;
            --font: "Inter", sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font);
            background: linear-gradient(135deg, #f8f8ff 0%, #ededfc 50%, #e0e2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Background floating orbs */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }

        .bg-orb-1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #8b5cf6, #4f46e5);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .bg-orb-2 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #6366f1, #a78bfa);
            bottom: -80px;
            right: -80px;
            animation-delay: -4s;
        }

        .bg-orb-3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, #c4b5fd, #7c3aed);
            top: 50%;
            left: 10%;
            animation-delay: -2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50%       { transform: translateY(-30px) scale(1.05); }
        }

        /* Grid pattern */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(79, 70, 229, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(79, 70, 229, 0.04) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        .container {
            text-align: center;
            position: relative;
            z-index: 10;
            padding: 40px 20px;
            max-width: 650px;
        }

        /* Logo */
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 48px;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        /* 404 big number */
        .error-code {
            font-size: clamp(100px, 20vw, 160px);
            font-weight: 900;
            line-height: 1;
            letter-spacing: -8px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a78bfa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            animation: pulse-glow 3s ease-in-out infinite;
            margin-bottom: 8px;
        }

        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 20px rgba(79, 70, 229, 0.3)); }
            50%       { filter: drop-shadow(0 0 50px rgba(79, 70, 229, 0.6)); }
        }

        /* Glitch effect on the 404 */
        .error-code::before,
        .error-code::after {
            content: "404";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a78bfa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .error-code::before {
            animation: glitch-1 4s infinite;
            opacity: 0.5;
        }

        .error-code::after {
            animation: glitch-2 4s infinite;
            opacity: 0.3;
        }

        @keyframes glitch-1 {
            0%, 90%, 100% { clip-path: none; transform: none; }
            92%  { clip-path: inset(20% 0 60% 0); transform: translateX(-4px); }
            94%  { clip-path: inset(50% 0 20% 0); transform: translateX(4px); }
            96%  { clip-path: inset(10% 0 70% 0); transform: translateX(-2px); }
        }

        @keyframes glitch-2 {
            0%, 90%, 100% { clip-path: none; transform: none; }
            93%  { clip-path: inset(60% 0 10% 0); transform: translateX(4px); }
            95%  { clip-path: inset(30% 0 40% 0); transform: translateX(-4px); }
            97%  { clip-path: inset(70% 0 5%  0); transform: translateX(2px); }
        }

        /* Divider line */
        .divider {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #a78bfa);
            border-radius: 10px;
            margin: 0 auto 28px;
        }

        .error-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 14px;
            letter-spacing: -0.5px;
        }

        .error-description {
            font-size: 16px;
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 420px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Action buttons */
        .actions {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 48px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            font-family: var(--font);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(79, 70, 229, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.5);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            background: white;
            color: var(--primary);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            font-family: var(--font);
            border: 2px solid var(--primary-light);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            border-color: var(--primary);
        }

        /* Quick links */
        .quick-links {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .quick-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(79, 70, 229, 0.15);
            border-radius: 20px;
            text-decoration: none;
            color: var(--text-light);
            font-size: 13px;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        .quick-link:hover {
            background: white;
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        }

        /* Floating particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: var(--primary);
            opacity: 0;
            animation: particle-rise 6s ease-in infinite;
        }

        @keyframes particle-rise {
            0%   { opacity: 0; transform: translateY(0) scale(0); }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.1; }
            100% { opacity: 0; transform: translateY(-120vh) scale(1.2); }
        }

        /* Astronaut emoji illustration */
        .illustration {
            font-size: 64px;
            margin-bottom: 16px;
            display: block;
            animation: wobble 3s ease-in-out infinite;
        }

        @keyframes wobble {
            0%, 100% { transform: rotate(-5deg) translateY(0); }
            50%       { transform: rotate(5deg) translateY(-10px); }
        }

        @media (max-width: 480px) {
            .error-code { letter-spacing: -4px; }
            .actions { flex-direction: column; align-items: center; }
            .btn-primary, .btn-secondary { width: 100%; max-width: 280px; justify-content: center; }
        }
    </style>
</head>
<body>

    <!-- Background orbs -->
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <!-- Floating particles -->
    <div class="particle" style="width:6px;height:6px;left:15%;bottom:0;animation-delay:0s;animation-duration:7s;"></div>
    <div class="particle" style="width:4px;height:4px;left:30%;bottom:0;animation-delay:1.5s;animation-duration:9s;"></div>
    <div class="particle" style="width:8px;height:8px;left:55%;bottom:0;animation-delay:3s;animation-duration:6s;"></div>
    <div class="particle" style="width:5px;height:5px;left:70%;bottom:0;animation-delay:0.8s;animation-duration:8s;"></div>
    <div class="particle" style="width:6px;height:6px;left:85%;bottom:0;animation-delay:2.2s;animation-duration:7.5s;"></div>

    <div class="container">

        <!-- Logo -->
        <a href="<?= TEMPLATES_URL ?>/index.php" class="logo">
            
            <div class="cognify">
                <img src="<?=IMG_URL ?>/Container.png" alt="wave Logo" width="150" height="auto">
            </div>
        </a>

        <!-- Illustration -->
        <span class="illustration">🚀</span>

        <!-- 404 number -->
        <div class="error-code">404</div>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Title & description -->
        <h1 class="error-title">Oops! Page Not Found</h1>
        <p class="error-description">
            Looks like you've drifted into deep space. The page you're looking for doesn't exist or has been moved to another galaxy.
        </p>

        <!-- CTA buttons -->
        <div class="actions">
            <a href="<?= TEMPLATES_URL ?>/index.php" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"/>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
                </svg>
                Go Home
            </a>
            <button class="btn-secondary" onclick="history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M15 6l-6 6l6 6"/>
                </svg>
                Go Back
            </button>
        </div>

        <!-- Quick links -->
        <div class="quick-links">
            <a href="<?= TEMPLATES_URL ?>/study-session.php" class="quick-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0"/><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/></svg>
                Dashboard
            </a>
            <a href="<?= TEMPLATES_URL ?>/Circle.php" class="quick-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/></svg>
                Circle
            </a>
            <a href="<?= TEMPLATES_URL ?>/Profile.php" class="quick-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/></svg>
                Profile
            </a>
            <a href="<?= TEMPLATES_URL ?>/signIn.php" class="quick-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"/><path d="M20 12h-13l3 -3m0 6l-3 -3"/></svg>
                Sign In
            </a>
        </div>

    </div>

</body>
</html>
