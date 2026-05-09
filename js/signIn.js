// function 3ashan n-handle el sign in
function handleSignIn(event) {
    // bnmna3 el form enaha t3ml refresh lel saf7a
    event.preventDefault();
    
    // bn-save fl local storage en el user 3amal login
    localStorage.setItem('loggedIn', 'true');
    
    // b-n-redirect el user 3ala saf7et el study session
    window.location.href = 'study-session.php';
}
