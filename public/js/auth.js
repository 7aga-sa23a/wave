// auth.js - bn-protect el saf7at w n-manage 7alet el login
const APP_PAGES = {
  INDEX: 'index.php',
  SIGNIN: 'signIn.php',
  SIGNUP: 'signUp.php',
  FORGOT_PASSWORD: 'forgot-password.php',
  EMAIL_CHECK: 'email-check.php',
  STUDY_SESSION: 'study-session.php',
  CIRCLE: 'Circle.php',
  PROFILE: 'Profile.php',
  SETTINGS: 'settings.php',
  ACHIEVEMENTS: 'achievements.php',
  UPLOADING_MATERIAL: 'uploading-material.php',
  FOCUS_SESSION: 'focus-session.php',
  QUICKSUMMARY: 'quicksummary.php',
  QUIZ: 'quiz.php',
  RESULTS: 'results.php',
  NOT_FOUND: '404.php'
};
const _publicPages = [APP_PAGES.INDEX, APP_PAGES.SIGNIN, APP_PAGES.SIGNUP, APP_PAGES.FORGOT_PASSWORD, APP_PAGES.EMAIL_CHECK, ''];
const _currentPage = window.location.pathname.split("/").pop() || APP_PAGES.INDEX;
const _isLoggedIn  = localStorage.getItem('loggedIn') === 'true';
const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';

// lw el user msh 3amel login we da5el 3la saf7a ma7meya → n-rg3o 3la el login
if (!_isLoggedIn && !_publicPages.includes(_currentPage)) {
    window.location.replace(`${_TEMPLATES_URL}/${APP_PAGES.SIGNIN}`);
}

// lw el user 3amel login we da5el 3la saf7et el login aw el signup → wadeh 3la el dashboard  
if (_isLoggedIn && (_currentPage === APP_PAGES.SIGNIN || _currentPage === APP_PAGES.SIGNUP || _currentPage === APP_PAGES.FORGOT_PASSWORD || _currentPage === APP_PAGES.EMAIL_CHECK)) {
    window.location.replace(`${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}`);
}
