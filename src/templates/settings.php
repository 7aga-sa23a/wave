<?php require_once __DIR__ . '/../core/config.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require __DIR__ . '/partials/theme-head.php'; ?>
    <title>Cognify - Account Settings</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/navbarsticky.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/footer.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/profile.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/settings.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/theme-global.css" />
      <?php require __DIR__ . '/paths.php'; ?>
      <script src="<?= JS_URL ?>/auth.js"></script>
</head>
  <body>
    <div id="navbar"></div>
    <script src="<?= COMPONENTS_URL ?>/navbar.js"></script>
    <script src="<?= JS_URL ?>/main.js"></script>

    <div class="settings-page">

      <a href="<?= TEMPLATES_URL ?>/Profile.php" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6"/></svg>
        Back to Profile
      </a>

      <div class="page-title">
        <h1>Account Settings</h1>
        <p>Manage your account information and preferences</p>
      </div>

      <div class="settings-grid">

        <!-- LEFT COLUMN -->
        <div class="settings-left">

          <!-- Profile Information -->
          <form class="profile-card">
    <div class="card-title-row">
      <div class="card-icon-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="23.986900329589844" height="23.986900329589844" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
          <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
        </svg>
      </div>

      <h3 class="card-title">Profile Information</h3>
    </div>

    <div class="form-group">
      <label for="fullName">Full Name</label>
      <input 
        type="text" 
        id="fullName"
        name="fullName"
        placeholder="Enter your full name"
        required
      />
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input 
        type="email" 
        id="email"
        name="email"
        placeholder="Enter your email"
        required
      />
    </div>

    <button type="submit" class="btn-primary">
      Save Changes
    </button>
  </form>

            <!-- Change Password -->
  <form class="profile-card" method_exists="POST" action="">
    <div class="card-title-row">
      <div class="card-icon-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="23.986900329589844" height="23.986900329589844" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"/>
          <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/>
          <path d="M8 11v-4a4 4 0 1 1 8 0v4"/>
        </svg>
      </div>

      <h3 class="card-title">Change Password</h3>
    </div>

    <div class="form-group">
      <label for="currentPassword">Current Password</label>
      <input 
        type="password" 
        id="currentPassword"
        name="currentPassword"
        placeholder="Enter current password"
        required
      />
    </div>

    <div class="form-group">
      <label for="newPassword">New Password</label>
      <input 
        type="password" 
        id="newPassword"
        name="newPassword"
        placeholder="Enter new password"
        required
      />
    </div>

    <div class="form-group">
      <label for="confirmPassword">Confirm New Password</label>
      <input 
        type="password" 
        id="confirmPassword"
        name="confirmPassword"
        placeholder="Confirm new password"
        required
      />
    </div>

    <button type="submit" class="btn-primary">
      Update Password
    </button>
  </form>

          <!-- Notifications -->
          <div class="profile-card">
            <div class="card-title-row">
              <div class="card-icon-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="23.986900329589844" height="23.986900329589844" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/><path d="M9 17v1a3 3 0 0 0 6 0v-1"/></svg>
              </div>
              <h3 class="card-title">Notifications</h3>
            </div>

            <div class="toggle-item">
              <div class="toggle-info">
                <span class="toggle-title">Email Notifications</span>
                <span class="toggle-desc">Receive updates via email</span>
              </div>
              <label class="toggle">
                <input type="checkbox" />
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="toggle-item">
              <div class="toggle-info">
                <span class="toggle-title">Push Notifications</span>
                <span class="toggle-desc">Get push notifications on your device</span>
              </div>
              <label class="toggle">
                <input type="checkbox" checked />
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="toggle-item">
              <div class="toggle-info">
                <span class="toggle-title">Weekly Report</span>
                <span class="toggle-desc">Weekly summary of your progress</span>
              </div>
              <label class="toggle">
                <input type="checkbox" checked />
                <span class="toggle-slider"></span>
              </label>
            </div>

            <div class="toggle-item">
              <div class="toggle-info">
                <span class="toggle-title">Achievement Alerts</span>
                <span class="toggle-desc">Alerts when you unlock achievements</span>
              </div>
              <label class="toggle">
                <input type="checkbox" checked />
                <span class="toggle-slider"></span>
              </label>
            </div>

          </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="settings-right">

          <!-- Preferences -->
          <div class="profile-card">
            <div class="card-title-row">
              <div class="card-icon-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"/><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/></svg>
              </div>
              <h3 class="card-title">Preferences</h3>
            </div>

            <div class="form-group">
      <label for="language">Language</label>

      <div class="select-wrapper">
        <select id="language" name="language">
          <option value="en">English</option>
          <option value="ar">Arabic</option>
          <option value="fr">French</option>
        </select>

        <svg xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2">
          <path d="M6 9l6 6l6 -6"/>
        </svg>
      </div>
    </div>

            <div class="form-group">
              <label for="sessionDuration">Default Session Duration</label>

              <div class="select-wrapper">
                <select id="sessionDuration" name="sessionDuration">
                  <option value="25">25 min</option>
                  <option value="30">30 min</option>
                  <option value="45">45 min</option>
                  <option value="60">60 min</option>
                </select>

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                  <path d="M6 9l6 6l6 -6"/>
                </svg>
              </div>
            </div>

          <!-- Danger Zone -->
          <!-- <div class="danger-zone-card">
            <div class="card-title-row">
              <div class="card-icon-sm danger-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4"/><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"/><path d="M12 16h.01"/></svg>
              </div>
              <h3 class="card-title danger-title">Danger Zone</h3>
            </div>
            <p class="danger-desc">Delete your account and all associated data permanently.</p>
            <button class="btn-danger" onclick="localStorage.setItem('loggedIn', 'false'); window.location.href='<?= TEMPLATES_URL ?>/index.php'">Delete Account</button>
          </div> -->

        </div>
      </div>
    </div>

    <div id="footer"></div>
    <script src="<?= COMPONENTS_URL ?>/footer.js"></script>
    <?php require __DIR__ . '/partials/theme-foot.php'; ?>
  </body>
</html>
