// function 3ashan n-handle el sign up
const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';
function handleSignUp(event) {
    // bnwa2f el form enaha tb3t request we t-refresh el page
    event.preventDefault();
    
    // bn-set el loggedIn state 3ashan el user yb2a da5el
    localStorage.setItem('loggedIn', 'true');
    
    // b-n-wadeh el user 3ala el dashboard
    window.location.href = `${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}`;
}
