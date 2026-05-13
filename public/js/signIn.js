// // function 3ashan n-handle el sign in
// const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';
// function handleSignIn(event) {
//     // bnmna3 el form enaha t3ml refresh lel saf7a
//     event.preventDefault();
    
//     // bn-save fl local storage en el user 3amal login
//     localStorage.setItem('loggedIn', 'true');
    
//     // b-n-redirect el user 3ala saf7et el study session
//     window.location.href = `${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}`;
// }
const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';

async function handleSignIn(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    const response = await fetch(`${_TEMPLATES_URL}/../core/login.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
    });
    
    const data = await response.json();
    
    if (data.success) {
        localStorage.setItem('loggedIn', 'true');
        window.location.href = `${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}`;
    } else {
        alert(data.message);
    }
}