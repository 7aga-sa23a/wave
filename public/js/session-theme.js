(function () {
  var STORAGE_KEY = 'session-theme';
  var btnLight = document.getElementById('btn-light');
  var btnDark = document.getElementById('btn-dark');
  var htmlEl = document.documentElement;

  function readSavedTheme() {
    var savedTheme = 'dark';
    try {
      var stored = localStorage.getItem(STORAGE_KEY);
      if (stored === 'light' || stored === 'dark') savedTheme = stored;
    } catch (e) {
      /* ignore */
    }
    return savedTheme;
  }

  function applyTheme(theme, fromUserClick) {
    if (fromUserClick && document.body) {
      document.body.classList.add('theme-switching');
      setTimeout(function () {
        if (document.body) document.body.classList.remove('theme-switching');
      }, 350);
    }
    if (theme === 'dark') {
      htmlEl.setAttribute('data-theme', 'dark');
      if (btnDark) btnDark.classList.add('active');
      if (btnLight) btnLight.classList.remove('active');
    } else {
      htmlEl.removeAttribute('data-theme');
      if (btnLight) btnLight.classList.add('active');
      if (btnDark) btnDark.classList.remove('active');
    }
    try {
      localStorage.setItem(STORAGE_KEY, theme);
    } catch (e) {
      /* ignore */
    }
  }

  function triggerRipple(btn) {
    btn.classList.remove('ripple');
    void btn.offsetWidth;
    btn.classList.add('ripple');
    setTimeout(function () {
      btn.classList.remove('ripple');
    }, 400);
  }

  applyTheme(readSavedTheme(), false);

  if (btnLight && btnDark) {
    btnLight.addEventListener('click', function () {
      console.log('Light theme button clicked');
      triggerRipple(btnLight);
      applyTheme('light', true);
    });
    btnDark.addEventListener('click', function () {
      console.log('Dark theme button clicked');
      triggerRipple(btnDark);
      applyTheme('dark', true);
    });
  }
})();
