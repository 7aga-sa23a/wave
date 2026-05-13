// // function 3ashan n-handle el sign up
// const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';
// function handleSignUp(event) {
//     // bnwa2f el form enaha tb3t request we t-refresh el page
//     event.preventDefault();
    
//     // bn-set el loggedIn state 3ashan el user yb2a da5el
//     localStorage.setItem('loggedIn', 'true');
    
//     // b-n-wadeh el user 3ala el dashboard
//     window.location.href = `${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}`;
// }
const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';

async function handleSignUp(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    const formData = new FormData();
    formData.append('register', '1');
    formData.append('name', name);
    formData.append('email', email);
    formData.append('password', password);
    
    const response = await fetch(`${_TEMPLATES_URL}/../core/signUp_logic.php`, {
        method: 'POST',
        body: formData
    });
    
    localStorage.setItem('loggedIn', 'true');
    window.location.href = `${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}`;
}
