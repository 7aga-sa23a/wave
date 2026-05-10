// function 3ashan n-handle el sign in
const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';
function handleSignIn(event) {
    // bnmna3 el form enaha t3ml refresh lel saf7a
    event.preventDefault();
    
    // bn-save fl local storage en el user 3amal login
    localStorage.setItem('loggedIn', 'true');
    
    // b-n-redirect el user 3ala saf7et el study session
    window.location.href = `${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}`;
}
