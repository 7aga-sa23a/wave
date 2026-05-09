<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cognify</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/navbarsticky.css" />
    <link rel="stylesheet" href="../css/footer.css" />
      <script src="../js/auth.js"></script>
</head>
  <body style="background: linear-gradient(to top, #ffffff, #efeff8)">
    <div id="navbar"></div>
    <script src="../components/navbar.js"></script>
    <script src="../js/main.js"></script>

    <div class="your-circle">
      <h1>Your Circle</h1>
      <p>See how you compare with your study group</p>
    </div>

    <div class="circle-content">
      <div class="left-col">
        <div class="top-performer">
          <div class="tp-left">
            <div class="tp-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#F59E0B"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-trophy tp-icon-svg"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M8 21l8 0" />
                <path d="M12 17l0 4" />
                <path d="M7 4l10 0" />
                <path d="M17 4v8a5 5 0 0 1 -10 0v-8" />
                <path d="M3 9a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 9a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              </svg>
            </div>
            <div class="tp-info">
              <span class="tp-label">Top Performer This Week</span>
              <h2 class="tp-name">Emma K.</h2>
              <span class="tp-points"
                ><span class="points" id="pints">420</span> points earned this
                week</span
              >
            </div>
          </div>
          <div class="tp-right">
            <span class="tp-streak-num">18</span>
            <span class="tp-streak-label">Day Streak</span>
          </div>
        </div>

        <div class="leaderboard">
          <h3>Leaderboard</h3>

          <div class="lb-item">
            <div class="lb-rank gold">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="#F59E0B"
                class="icon icon-tabler icons-tabler-filled icon-tabler-laurel-wreath-1"
              >
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M16.956 2.057c.355 .124 .829 .375 1.303 .796a3.77 3.77 0 0 1 1.246 2.204c.173 .989 -.047 1.894 -.519 2.683l-.123 .194q -.097 .147 -.196 .272q .066 .234 .117 .471q .26 -.178 .545 -.307c.851 -.389 1.727 -.442 2.527 -.306q .226 .04 .346 .076a1 1 0 0 1 .689 .712l.029 .13q .015 .08 .03 .18a4.45 4.45 0 0 1 -.324 2.496a3.94 3.94 0 0 1 -1.71 1.85l-.242 .12a4.23 4.23 0 0 1 -2.234 .349a9 9 0 0 1 -.443 1.023c.37 .016 .748 .093 1.128 .24c.732 .28 1.299 .758 1.711 1.367a3.95 3.95 0 0 1 .654 1.613a1 1 0 0 1 -.356 .917a3.8 3.8 0 0 1 -.716 .443c-.933 .455 -1.978 .588 -3.043 .179l-.032 -.015l-.205 -.086a3.6 3.6 0 0 1 -1.33 -1.069l-.143 -.197a4 4 0 0 1 -.26 -.433a6 6 0 0 1 -.927 .511q .18 .262 .337 .56a7.4 7.4 0 0 1 .66 1.747a1 1 0 0 1 -1.95 .444l-.028 -.11a6 6 0 0 0 -.449 -1.143c-.342 -.645 -.71 -.968 -1.048 -.968s-.706 .323 -1.048 .969a5.6 5.6 0 0 0 -.367 .874l-.082 .269l-.028 .11a1 1 0 0 1 -1.95 -.444a7.3 7.3 0 0 1 .66 -1.747q .158 -.298 .337 -.561a6.4 6.4 0 0 1 -.93 -.508a4 4 0 0 1 -.256 .43c-.366 .541 -.855 .98 -1.473 1.267l-.238 .1c-.994 .382 -1.97 .292 -2.855 -.091l-.188 -.087a3.8 3.8 0 0 1 -.716 -.443a1 1 0 0 1 -.356 -.917a3.95 3.95 0 0 1 .654 -1.613a3.6 3.6 0 0 1 1.71 -1.368c.38 -.146 .758 -.223 1.13 -.24a9 9 0 0 1 -.445 -1.023a4.23 4.23 0 0 1 -2.233 -.348a4 4 0 0 1 -.916 -.587l-.207 -.191a4 4 0 0 1 -.724 -.977l-.105 -.216a4.45 4.45 0 0 1 -.265 -2.806a1 1 0 0 1 .69 -.712q .119 -.036 .345 -.076c.801 -.135 1.678 -.082 2.53 .308q .283 .129 .545 .304q .048 -.235 .112 -.47a5 5 0 0 1 -.194 -.272c-.556 -.832 -.83 -1.806 -.642 -2.877l.05 -.242a3.75 3.75 0 0 1 1.027 -1.803l.169 -.159a4 4 0 0 1 1.303 -.796a1 1 0 0 1 .975 .178c.2 .168 .462 .446 .719 .83c.556 .833 .83 1.807 .642 2.878a3.77 3.77 0 0 1 -1.246 2.204c-.303 .27 -.607 .47 -.879 .61a7.5 7.5 0 0 0 -.255 1.971c0 3.502 2.285 6.272 5 6.272s5 -2.77 5 -6.276a7.6 7.6 0 0 0 -.253 -1.967a4.3 4.3 0 0 1 -.881 -.61a3.77 3.77 0 0 1 -1.246 -2.204c-.188 -1.07 .086 -2.045 .642 -2.877c.257 -.385 .52 -.663 .72 -.831a1 1 0 0 1 .974 -.178m-3.956 5.943v6a1 1 0 0 1 -2 0v-4.002h-.059a1 1 0 0 1 -.554 -.208l-.094 -.083a1 1 0 0 1 0 -1.414l1 -1c.63 -.63 1.707 -.184 1.707 .707"
                />
              </svg>
            </div>
            <div class="lb-avatar">E</div>
            <div class="lb-info">
              <span class="lb-name">Emma K.</span>
              <span class="lb-sessions">12 sessions completed</span>
            </div>
            <div class="lb-stats">
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#f59e0b"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-star"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                    /></svg
                  ><strong>3100</strong></span
                ><span>total points</span>
              </div>
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#ef4444"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-flame"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M10 2c0 -.88 1.056 -1.331 1.692 -.722c1.958 1.876 3.096 5.995 1.75 9.12l-.08 .174l.012 .003c.625 .133 1.203 -.43 2.303 -2.173l.14 -.224a1 1 0 0 1 1.582 -.153c1.334 1.435 2.601 4.377 2.601 6.27c0 4.265 -3.591 7.705 -8 7.705s-8 -3.44 -8 -7.706c0 -2.252 1.022 -4.716 2.632 -6.301l.605 -.589c.241 -.236 .434 -.43 .618 -.624c1.43 -1.512 2.145 -2.924 2.145 -4.78"
                    /></svg
                  ><strong>18</strong></span
                ><span>day streak</span>
              </div>
            </div>
          </div>

          <div class="lb-item active">
            <div class="lb-rank silver">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="#9CA3AF"
                class="icon icon-tabler icons-tabler-filled icon-tabler-laurel-wreath-2"
              >
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M16.956 2.057c.355 .124 .829 .375 1.303 .796a3.77 3.77 0 0 1 1.246 2.204c.173 .989 -.047 1.894 -.519 2.683l-.123 .194q -.097 .147 -.196 .272q .066 .234 .117 .471q .26 -.178 .545 -.307c.851 -.389 1.727 -.442 2.527 -.306q .226 .04 .346 .076a1 1 0 0 1 .689 .712l.029 .13q .015 .08 .03 .18a4.45 4.45 0 0 1 -.324 2.496a3.94 3.94 0 0 1 -1.71 1.85l-.242 .12a4.23 4.23 0 0 1 -2.234 .349a9 9 0 0 1 -.443 1.023c.37 .016 .748 .093 1.128 .24c.732 .28 1.299 .758 1.711 1.367a3.95 3.95 0 0 1 .654 1.613a1 1 0 0 1 -.356 .917a3.8 3.8 0 0 1 -.716 .443c-.933 .455 -1.978 .588 -3.043 .179l-.032 -.015l-.205 -.086a3.6 3.6 0 0 1 -1.33 -1.069l-.143 -.197a4 4 0 0 1 -.26 -.433a6 6 0 0 1 -.927 .511q .18 .262 .337 .56a7.4 7.4 0 0 1 .66 1.747a1 1 0 0 1 -1.95 .444l-.028 -.11a6 6 0 0 0 -.449 -1.143c-.342 -.645 -.71 -.968 -1.048 -.968s-.706 .323 -1.048 .969a5.6 5.6 0 0 0 -.367 .874l-.082 .269l-.028 .11a1 1 0 0 1 -1.95 -.444a7.3 7.3 0 0 1 .66 -1.747q .158 -.298 .337 -.561a6.4 6.4 0 0 1 -.93 -.508a4 4 0 0 1 -.256 .43c-.366 .541 -.855 .98 -1.473 1.267l-.238 .1c-.994 .382 -1.97 .292 -2.855 -.091l-.188 -.087a3.8 3.8 0 0 1 -.716 -.443a1 1 0 0 1 -.356 -.917a3.95 3.95 0 0 1 .654 -1.613a3.6 3.6 0 0 1 1.71 -1.368c.38 -.146 .758 -.223 1.13 -.24a9 9 0 0 1 -.445 -1.023a4.23 4.23 0 0 1 -2.233 -.348a4 4 0 0 1 -.916 -.587l-.207 -.191a4 4 0 0 1 -.724 -.977l-.105 -.216a4.45 4.45 0 0 1 -.265 -2.806a1 1 0 0 1 .69 -.712q .119 -.036 .345 -.076c.801 -.135 1.678 -.082 2.53 .308q .283 .129 .545 .304q .048 -.235 .112 -.47a5 5 0 0 1 -.194 -.272c-.556 -.832 -.83 -1.806 -.642 -2.877l.05 -.242a3.75 3.75 0 0 1 1.027 -1.803l.169 -.159a4 4 0 0 1 1.303 -.796a1 1 0 0 1 .975 .178c.2 .168 .462 .446 .719 .83c.556 .833 .83 1.807 .642 2.878a3.77 3.77 0 0 1 -1.246 2.204c-.303 .27 -.607 .47 -.879 .61a7.5 7.5 0 0 0 -.255 1.971c0 3.502 2.285 6.272 5 6.272s5 -2.77 5 -6.276a7.6 7.6 0 0 0 -.253 -1.967a4.3 4.3 0 0 1 -.881 -.61a3.77 3.77 0 0 1 -1.246 -2.204c-.188 -1.07 .086 -2.045 .642 -2.877c.257 -.385 .52 -.663 .72 -.831a1 1 0 0 1 .974 -.178m-4.356 4.943a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-1v1h2a1 1 0 0 1 0 2h-2a2 2 0 0 1 -2 -2v-1a2 2 0 0 1 2 -2h1v-1h-2a1 1 0 0 1 0 -2z"
                />
              </svg>
            </div>
            <div class="lb-avatar you">A</div>
            <div class="lb-info">
              <span class="lb-name">You</span>
              <span class="lb-sessions">10 sessions completed</span>
            </div>
            <div class="lb-stats">
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#f59e0b"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-star"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                    /></svg
                  ><strong>2890</strong></span
                ><span>total points</span>
              </div>
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#ef4444"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-flame"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M10 2c0 -.88 1.056 -1.331 1.692 -.722c1.958 1.876 3.096 5.995 1.75 9.12l-.08 .174l.012 .003c.625 .133 1.203 -.43 2.303 -2.173l.14 -.224a1 1 0 0 1 1.582 -.153c1.334 1.435 2.601 4.377 2.601 6.27c0 4.265 -3.591 7.705 -8 7.705s-8 -3.44 -8 -7.706c0 -2.252 1.022 -4.716 2.632 -6.301l.605 -.589c.241 -.236 .434 -.43 .618 -.624c1.43 -1.512 2.145 -2.924 2.145 -4.78"
                    /></svg
                  ><strong>15</strong></span
                ><span>day streak</span>
              </div>
            </div>
          </div>

          <div class="lb-item">
            <div class="lb-rank bronze">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="#D97706"
                class="icon icon-tabler icons-tabler-filled icon-tabler-laurel-wreath-3"
              >
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M16.956 2.057c.355 .124 .829 .375 1.303 .796a3.77 3.77 0 0 1 1.246 2.204c.173 .989 -.047 1.894 -.519 2.683l-.123 .194q -.097 .147 -.196 .272q .066 .234 .117 .471q .26 -.178 .545 -.307c.851 -.389 1.727 -.442 2.527 -.306q .226 .04 .346 .076a1 1 0 0 1 .689 .712l.029 .13q .015 .08 .03 .18a4.45 4.45 0 0 1 -.324 2.496a3.94 3.94 0 0 1 -1.71 1.85l-.242 .12a4.23 4.23 0 0 1 -2.234 .349a9 9 0 0 1 -.443 1.023c.37 .016 .748 .093 1.128 .24c.732 .28 1.299 .758 1.711 1.367a3.95 3.95 0 0 1 .654 1.613a1 1 0 0 1 -.356 .917a3.8 3.8 0 0 1 -.716 .443c-.933 .455 -1.978 .588 -3.043 .179l-.032 -.015l-.205 -.086a3.6 3.6 0 0 1 -1.33 -1.069l-.143 -.197a4 4 0 0 1 -.26 -.433a6 6 0 0 1 -.927 .511q .18 .262 .337 .56a7.4 7.4 0 0 1 .66 1.747a1 1 0 0 1 -1.95 .444l-.028 -.11a6 6 0 0 0 -.449 -1.143c-.342 -.645 -.71 -.968 -1.048 -.968s-.706 .323 -1.048 .969a5.6 5.6 0 0 0 -.367 .874l-.082 .269l-.028 .11a1 1 0 0 1 -1.95 -.444a7.3 7.3 0 0 1 .66 -1.747q .158 -.298 .337 -.561a6.4 6.4 0 0 1 -.93 -.508a4 4 0 0 1 -.256 .43c-.366 .541 -.855 .98 -1.473 1.267l-.238 .1c-.994 .382 -1.97 .292 -2.855 -.091l-.188 -.087a3.8 3.8 0 0 1 -.716 -.443a1 1 0 0 1 -.356 -.917a3.95 3.95 0 0 1 .654 -1.613a3.6 3.6 0 0 1 1.71 -1.368c.38 -.146 .758 -.223 1.13 -.24a9 9 0 0 1 -.445 -1.023a4.23 4.23 0 0 1 -2.233 -.348a4 4 0 0 1 -.916 -.587l-.207 -.191a4 4 0 0 1 -.724 -.977l-.105 -.216a4.45 4.45 0 0 1 -.265 -2.806a1 1 0 0 1 .69 -.712q .119 -.036 .345 -.076c.801 -.135 1.678 -.082 2.53 .308q .283 .129 .545 .304q .048 -.235 .112 -.47a5 5 0 0 1 -.194 -.272c-.556 -.832 -.83 -1.806 -.642 -2.877l.05 -.242a3.75 3.75 0 0 1 1.027 -1.803l.169 -.159a4 4 0 0 1 1.303 -.796a1 1 0 0 1 .975 .178c.2 .168 .462 .446 .719 .83c.556 .833 .83 1.807 .642 2.878a3.77 3.77 0 0 1 -1.246 2.204c-.303 .27 -.607 .47 -.879 .61a7.5 7.5 0 0 0 -.255 1.971c0 3.502 2.285 6.272 5 6.272s5 -2.77 5 -6.276a7.6 7.6 0 0 0 -.253 -1.967a4.3 4.3 0 0 1 -.881 -.61a3.77 3.77 0 0 1 -1.246 -2.204c-.188 -1.07 .086 -2.045 .642 -2.877c.257 -.385 .52 -.663 .72 -.831a1 1 0 0 1 .974 -.178m-4.956 4.943a2.5 2.5 0 0 1 2.125 3.817l-.125 .183l.019 .024c.273 .372 .445 .823 .477 1.312l.005 .164a2.5 2.5 0 0 1 -2.501 2.5h-1.5a1 1 0 0 1 0 -2h1.5a.5 .5 0 1 0 0 -1h-1l-.133 -.007c-1.199 -.129 -1.154 -1.993 .133 -1.993h1l.09 -.008a.5 .5 0 0 0 -.09 -.992h-1.5a1 1 0 1 1 0 -2z"
                />
              </svg>
            </div>
            <div class="lb-avatar dark">S</div>
            <div class="lb-info">
              <span class="lb-name">Sarah M.</span>
              <span class="lb-sessions">8 sessions completed</span>
            </div>
            <div class="lb-stats">
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#f59e0b"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-star"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                    /></svg
                  ><strong>2450</strong></span
                ><span>total points</span>
              </div>
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#ef4444"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-flame"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M10 2c0 -.88 1.056 -1.331 1.692 -.722c1.958 1.876 3.096 5.995 1.75 9.12l-.08 .174l.012 .003c.625 .133 1.203 -.43 2.303 -2.173l.14 -.224a1 1 0 0 1 1.582 -.153c1.334 1.435 2.601 4.377 2.601 6.27c0 4.265 -3.591 7.705 -8 7.705s-8 -3.44 -8 -7.706c0 -2.252 1.022 -4.716 2.632 -6.301l.605 -.589c.241 -.236 .434 -.43 .618 -.624c1.43 -1.512 2.145 -2.924 2.145 -4.78"
                    /></svg
                  ><strong>12</strong></span
                ><span>day streak</span>
              </div>
            </div>
          </div>

          <div class="lb-item">
            <div class="lb-rank">#4</div>
            <div class="lb-avatar dark">M</div>
            <div class="lb-info">
              <span class="lb-name">Mike R.</span>
              <span class="lb-sessions">7 sessions completed</span>
            </div>
            <div class="lb-stats">
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#f59e0b"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-star"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                    /></svg
                  ><strong>2120</strong></span
                ><span>total points</span>
              </div>
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#ef4444"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-flame"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M10 2c0 -.88 1.056 -1.331 1.692 -.722c1.958 1.876 3.096 5.995 1.75 9.12l-.08 .174l.012 .003c.625 .133 1.203 -.43 2.303 -2.173l.14 -.224a1 1 0 0 1 1.582 -.153c1.334 1.435 2.601 4.377 2.601 6.27c0 4.265 -3.591 7.705 -8 7.705s-8 -3.44 -8 -7.706c0 -2.252 1.022 -4.716 2.632 -6.301l.605 -.589c.241 -.236 .434 -.43 .618 -.624c1.43 -1.512 2.145 -2.924 2.145 -4.78"
                    /></svg
                  ><strong>8</strong></span
                ><span>day streak</span>
              </div>
            </div>
          </div>

          <div class="lb-item">
            <div class="lb-rank">#5</div>
            <div class="lb-avatar dark">J</div>
            <div class="lb-info">
              <span class="lb-name">John D.</span>
              <span class="lb-sessions">5 sessions completed</span>
            </div>
            <div class="lb-stats">
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#f59e0b"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-star"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"
                    /></svg
                  ><strong>1850</strong></span
                ><span>total points</span>
              </div>
              <div class="lb-stat">
                <span class="stat-value"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="#ef4444"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-flame"
                  >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M10 2c0 -.88 1.056 -1.331 1.692 -.722c1.958 1.876 3.096 5.995 1.75 9.12l-.08 .174l.012 .003c.625 .133 1.203 -.43 2.303 -2.173l.14 -.224a1 1 0 0 1 1.582 -.153c1.334 1.435 2.601 4.377 2.601 6.27c0 4.265 -3.591 7.705 -8 7.705s-8 -3.44 -8 -7.706c0 -2.252 1.022 -4.716 2.632 -6.301l.605 -.589c.241 -.236 .434 -.43 .618 -.624c1.43 -1.512 2.145 -2.924 2.145 -4.78"
                    /></svg
                  ><strong>6</strong></span
                ><span>day streak</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="right-col">
        <div class="ranking-card">
          <div class="card-header">
            <div class="card-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-big-up"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  stroke="white"
                  fill="white"
                  d="M9 20v-8h-3.586a1 1 0 0 1 -.707 -1.707l6.586 -6.586a1 1 0 0 1 1.414 0l6.586 6.586a1 1 0 0 1 -.707 1.707h-3.586v8a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1"
                />
              </svg>
            </div>
            <span>Your Ranking</span>
          </div>
          <div class="ranking-number">#2</div>
          <p class="ranking-desc">
            You're <strong>210 points</strong> away from #1
          </p>
        </div>

        <div class="this-week-card">
          <div class="card-header">
            <div class="card-icon purple">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-medal-2"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  stroke="white"
                  fill="white"
                  d="M9 3h6l3 7l-6 2l-6 -2l3 -7"
                />
                <path stroke="white" fill="white" d="M12 12l-3 -9" />
                <path stroke="white" fill="white" d="M15 11l-3 -8" />
                <path
                  stroke="white"
                  fill="white"
                  d="M12 19.5l-3 1.5l.5 -3.5l-2 -2l3 -.5l1.5 -3l1.5 3l3 .5l-2 2l.5 3.5l-3 -1.5"
                />
              </svg>
            </div>
            <span>This Week</span>
          </div>

          <div class="progress-item">
            <div class="progress-top">
              <span>Points earned</span>
              <strong>380</strong>
            </div>
            <div class="progress-bar">
              <div class="progress-fill blue" style="width: 75%"></div>
            </div>
          </div>

          <div class="progress-item">
            <div class="progress-top">
              <span>Sessions completed</span>
              <strong>10</strong>
            </div>
            <div class="progress-bar">
              <div class="progress-fill green" style="width: 60%"></div>
            </div>
          </div>
        </div>

        <div class="keep-going-card">
          <div class="kg-icon">🎯</div>
          <h4>Keep Going!</h4>
          <p>Complete 2 more sessions to beat your personal best this week</p>
        </div>
      </div>
    </div>

    <div id="footer"></div>

    <script src="../components/footer.js"></script>
  </body>
</html>
