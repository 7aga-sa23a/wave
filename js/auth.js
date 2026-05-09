// auth.js - bn-protect el saf7at w n-manage 7alet el login
const _publicPages = ['index.php', 'signIn.php', 'signUp.php', 'forgot-password.php', 'email-check.php', ''];
const _currentPage = window.location.pathname.split("/").pop() || "index.php";
const _isLoggedIn  = localStorage.getItem('loggedIn') === 'true';

// lw el user msh 3amel login we da5el 3la saf7a ma7meya → n-rg3o 3la el login
if (!_isLoggedIn && !_publicPages.includes(_currentPage)) {
    window.location.replace('signIn.php');
}

// lw el user 3amel login we da5el 3la saf7et el login aw el signup → wadeh 3la el dashboard  
if (_isLoggedIn && (_currentPage === 'signIn.php' || _currentPage === 'signUp.php' || _currentPage === 'forgot-password.php' || _currentPage === 'email-check.php')) {
    window.location.replace('study-session.php');
}
