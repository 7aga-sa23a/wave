<?php require_once __DIR__ . '/../core/config.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cognify - Achievements</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/style.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/navbarsticky.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/footer.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/profile.css" />
    <link rel="stylesheet" href="<?= CSS_URL ?>/achievements.css" />
      <script src="<?= JS_URL ?>/auth.js"></script>
</head>
  <body>
    <div id="navbar"></div>
    <script src="<?= COMPONENTS_URL ?>/navbar.js"></script>
    <script src="<?= JS_URL ?>/main.js"></script>

    <div class="achievements-page">
      <a href="Profile.php" class="back-link">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M15 6l-6 6l6 6" />
        </svg>
        Back to Profile
      </a>

      <div class="page-title">
        <h1>Achievements</h1>
        <p>Track your progress and unlock rewards</p>
      </div>

      <div class="ach-stats-row">
        <div class="ach-stat-card" style="background: var(--primary)">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-military-award"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 13a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M8.5 10.5l-1 -2.5h-5.5l2.48 5.788a2 2 0 0 0 1.84 1.212h2.18" /><path d="M15.5 10.5l1 -2.5h5.5l-2.48 5.788a2 2 0 0 1 -1.84 1.212h-2.18" /></svg>
          <span class="ach-stat-num">11/20</span>
          <span class="ach-stat-label">Achievements Unlocked</span>
        </div>
        <div
          class="ach-stat-card"
          style="background: linear-gradient(135deg, #f97316, #f59e0b)"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="36"
            height="36"
            viewBox="0 0 24 24"
            fill="rgba(255,255,255,0.8)"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
              d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
            />
          </svg>
          <span class="ach-stat-num">1250</span>
          <span class="ach-stat-label">Achievement Points</span>
        </div>
        <div class="ach-stat-card" style="background: var(--green)">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="rgba(255,255,255,0.8)" class="icon icon-tabler icons-tabler-filled icon-tabler-trophy"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M17 3a1 1 0 0 1 .993 .883l.007 .117v2.17a3 3 0 1 1 0 5.659v.171a6.002 6.002 0 0 1 -5 5.917v2.083h3a1 1 0 0 1 .117 1.993l-.117 .007h-8a1 1 0 0 1 -.117 -1.993l.117 -.007h3v-2.083a6.002 6.002 0 0 1 -4.996 -5.692l-.004 -.225v-.171a3 3 0 0 1 -3.996 -2.653l-.003 -.176l.005 -.176a3 3 0 0 1 3.995 -2.654l-.001 -2.17a1 1 0 0 1 1 -1h10zm-12 5a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2" /></svg>
          <span class="ach-stat-num">55%</span>
          <span class="ach-stat-label">Completion Rate</span>
        </div>
      </div>

      <!-- Streaks -->
      <div class="ach-section">
        <h3>Streaks</h3>
        <div class="ach-list">
          <div class="ach-item unlocked">
            <div class="ach-item-icon">🔥</div>
            <div class="ach-item-info">
              <span class="ach-item-name">First Step</span>
              <span class="ach-item-desc">Complete your first session</span>
              <span class="ach-item-date">Unlocked on Jan 15, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>50</strong>
              <span>points</span>
            </div>
          </div>

          <div class="ach-item unlocked">
            <div class="ach-item-icon">⚡</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Week Warrior</span>
              <span class="ach-item-desc">7-day streak</span>
              <span class="ach-item-date">Unlocked on Jan 20, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>100</strong>
              <span>points</span>
            </div>
          </div>

          <div class="ach-item unlocked">
            <div class="ach-item-icon">🔥</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Hot Streak</span>
              <span class="ach-item-desc">15-day streak</span>
              <span class="ach-item-date">Unlocked on Today</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>200</strong>
              <span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Diamond Streak</span>
              <span class="ach-item-desc">30-day streak</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 50%"></div>
                </div>
                <span>50%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>500</strong>
              <span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Legendary</span>
              <span class="ach-item-desc">100-day streak</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 15%"></div>
                </div>
                <span>15%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>2000</strong>
              <span>points</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Points -->
      <div class="ach-section">
        <h3>Points</h3>
        <div class="ach-list">
          <div class="ach-item unlocked">
            <div class="ach-item-icon">⭐</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Point Starter</span>
              <span class="ach-item-desc">Earn 100 points</span>
              <span class="ach-item-date">Unlocked on Jan 15, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>50</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item unlocked">
            <div class="ach-item-icon">🌟</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Point Collector</span>
              <span class="ach-item-desc">Earn 1000 points</span>
              <span class="ach-item-date">Unlocked on Jan 25, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>100</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item unlocked">
            <div class="ach-item-icon">💫</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Point Master</span>
              <span class="ach-item-desc">Earn 2500 points</span>
              <span class="ach-item-date">Unlocked on Feb 10, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>200</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Point Champion</span>
              <span class="ach-item-desc">Earn 5000 points</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 58%"></div>
                </div>
                <span>58%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>500</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Point Legend</span>
              <span class="ach-item-desc">Earn 10000 points</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 29%"></div>
                </div>
                <span>29%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>1000</strong><span>points</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Sessions -->
      <div class="ach-section">
        <h3>Sessions</h3>
        <div class="ach-list">
          <div class="ach-item unlocked">
            <div class="ach-item-icon">📚</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Getting Started</span>
              <span class="ach-item-desc">5 sessions completed</span>
              <span class="ach-item-date">Unlocked on Jan 18, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>50</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item unlocked">
            <div class="ach-item-icon">📖</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Dedicated Learner</span>
              <span class="ach-item-desc">25 sessions completed</span>
              <span class="ach-item-date">Unlocked on Feb 5, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>150</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Focused Mind</span>
              <span class="ach-item-desc">50 sessions completed</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 94%"></div>
                </div>
                <span>94%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>300</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Knowledge Seeker</span>
              <span class="ach-item-desc">100 sessions completed</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 47%"></div>
                </div>
                <span>47%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>600</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Master Scholar</span>
              <span class="ach-item-desc">250 sessions completed</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 19%"></div>
                </div>
                <span>19%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>1500</strong><span>points</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Quiz Performance -->
      <div class="ach-section" style="margin-bottom: 6rem">
        <h3>Quiz Performance</h3>
        <div class="ach-list">
          <div class="ach-item unlocked">
            <div class="ach-item-icon">✅</div>
            <div class="ach-item-info">
              <span class="ach-item-name">First Victory</span>
              <span class="ach-item-desc">Pass your first quiz</span>
              <span class="ach-item-date">Unlocked on Jan 15, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>50</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item unlocked">
            <div class="ach-item-icon">🎯</div>
            <div class="ach-item-info">
              <span class="ach-item-name">High Achiever</span>
              <span class="ach-item-desc">Score 90% or higher</span>
              <span class="ach-item-date">Unlocked on Jan 22, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>100</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item unlocked">
            <div class="ach-item-icon">🏆</div>
            <div class="ach-item-info">
              <span class="ach-item-name">Perfect Score</span>
              <span class="ach-item-desc">Get 100% on a quiz</span>
              <span class="ach-item-date">Unlocked on Feb 8, 2026</span>
            </div>
            <div class="ach-item-points unlocked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="var(--gold)"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>200</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Consistency King</span>
              <span class="ach-item-desc">10 perfect scores</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 30%"></div>
                </div>
                <span>30%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>500</strong><span>points</span>
            </div>
          </div>

          <div class="ach-item locked">
            <div class="ach-item-icon locked-icon">🔒</div>
            <div class="ach-item-info">
              <span class="ach-item-name locked-text">Quiz Master</span>
              <span class="ach-item-desc">50 perfect scores</span>
              <div class="ach-progress">
                <div class="ach-progress-bar">
                  <div class="ach-progress-fill" style="width: 6%"></div>
                </div>
                <span>6%</span>
              </div>
            </div>
            <div class="ach-item-points locked-points">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="var(--gray)"
                stroke-width="2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                />
              </svg>
              <strong>2000</strong><span>points</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="footer"></div>
    <script src="<?= COMPONENTS_URL ?>/footer.js"></script>
  </body>
</html>
