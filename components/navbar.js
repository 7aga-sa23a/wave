document.addEventListener("DOMContentLoaded", function () {
  const currentPage = window.location.pathname.split("/").pop() || "index.php";

  const pages = {
    "study-session.php": 0,
    "Circle.php": 1,
    "Profile.php": 2,
    "settings.php": 2,
    "achievements.php": 2,
    "shop.php": 3
  };

  const activeIndex = pages[currentPage] !== undefined ? pages[currentPage] : -1;

  // bn-check el login state mn el local storage (team el backend by-handle el session b3den)
  const isLoggedIn = localStorage.getItem('loggedIn') === 'true';

  const navbarEl = document.getElementById("navbar");
  if (!navbarEl) return;

  if (isLoggedIn) {
    navbarEl.innerHTML = `
    <nav class="navbar">
      <div class="logo" style="cursor:pointer;" onclick="window.location.href='study-session.php'">Cognify</div>

      <div class="nav-links">
        <a href="study-session.php" class="${activeIndex === 0 ? "active" : ""}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 12l-2 0l9 -9l9 9l-2 0"/>
            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
          </svg>
          <span>Dashboard</span>
        </a>
        <a href="Circle.php" class="${activeIndex === 1 ? "active" : ""}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 7a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/>
          </svg>
          <span>Circle</span>
        </a>
        <a href="Profile.php" class="${activeIndex === 2 ? "active" : ""}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
          </svg>
          <span>Profile</span>
        </a>
        <a href="shop.php" class="${activeIndex === 3 ? "active" : ""}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
            <path d="M3 6h18"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
          <span>Shop</span>
        </a>
      </div>

      <div class="user" onclick="window.location.href='Profile.php'" style="cursor:pointer;"><img src="../assets/img/b49352280919218a2934154cabbf4d02.jpg" alt="User" /></div>
    </nav>
    `;
  } else {
    navbarEl.innerHTML = `
    <nav class="navbar">
      <div class="logo" style="cursor:pointer;" onclick="window.location.href='index.php'">Cognify</div>
      <div style="display: flex; gap: 20px; align-items: center; margin-right: 10rem;">
        <a href="signIn.php" style="text-decoration: none; color: #4F46E5; font-weight: 600; font-family: 'Inter', sans-serif; font-size: 16px;">Sign In</a>
        <button onclick="window.location.href='signUp.php'" style="background-color: #4F46E5; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; font-family: 'Inter', sans-serif; font-size: 16px; cursor: pointer; transition: all 0.3s ease;">Get Started</button>
      </div>
    </nav>
    `;
  }
});

