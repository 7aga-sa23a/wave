document.addEventListener("DOMContentLoaded", function () {
  const currentPage = window.location.pathname.split("/").pop() || APP_PAGES.INDEX;
  const _TEMPLATES_URL = window.APP_PATHS?.TEMPLATES_URL || '';
  const _IMG_URL = window.APP_PATHS?.IMG_URL || '';

  const pages = {
    [APP_PAGES.STUDY_SESSION]: 0,
    [APP_PAGES.CIRCLE]: 1,
    [APP_PAGES.PROFILE]: 2,
    [APP_PAGES.SETTINGS]: 2,
    [APP_PAGES.ACHIEVEMENTS]: 2
  };

  const activeIndex = pages[currentPage] !== undefined ? pages[currentPage] : -1;

  // bn-check el login state mn el local storage (team el backend by-handle el session b3den)
  const isLoggedIn = localStorage.getItem('loggedIn') === 'true';

  const navbarEl = document.getElementById("navbar");
  if (!navbarEl) return;

  if (isLoggedIn) {
    navbarEl.innerHTML = `
    <nav class="navbar">
      <div class="logo" style="cursor:pointer;" onclick="window.location.href='${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}'"><img src="${_IMG_URL}/Container.png" alt="Wave Logo" width="120" height="auto">
</div>

      <div class="nav-links">
        <a href="${_TEMPLATES_URL}/${APP_PAGES.STUDY_SESSION}" class="${activeIndex === 0 ? "active" : ""}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 12l-2 0l9 -9l9 9l-2 0"/>
            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
          </svg>
          <span>Dashboard</span>
        </a>
        <a href="${_TEMPLATES_URL}/${APP_PAGES.CIRCLE}" class="${activeIndex === 1 ? "active" : ""}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 7a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/>
          </svg>
          <span>Circle</span>
        </a>
        <a href="${_TEMPLATES_URL}/${APP_PAGES.PROFILE}" class="${activeIndex === 2 ? "active" : ""}">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
          </svg>
          <span>Profile</span>
        </a>
      </div>

      <div class="user" onclick="window.location.href='${_TEMPLATES_URL}/${APP_PAGES.PROFILE}'" style="cursor:pointer;"><img src="${_IMG_URL}/b49352280919218a2934154cabbf4d02.jpg" alt="User" /></div>
    </nav>
    `;
  } else {
    navbarEl.innerHTML = `
    <nav class="navbar">
      <div class="logo" style="cursor:pointer;" onclick="window.location.href='${_TEMPLATES_URL}/${APP_PAGES.INDEX}'"><img src="${_IMG_URL}/Container.png" alt="Wave Logo" width="120" height="auto">
</div>
      <div style="display: flex; gap: 20px; align-items: center; margin-right: 10rem;">
        <a href="${_TEMPLATES_URL}/${APP_PAGES.SIGNIN}" style="text-decoration: none; color: #4F46E5; font-weight: 600; font-family: 'Inter', sans-serif; font-size: 16px;">Sign In</a>
        <button onclick="window.location.href='${_TEMPLATES_URL}/${APP_PAGES.SIGNUP}'" style="background-color: #4F46E5; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; font-family: 'Inter', sans-serif; font-size: 16px; cursor: pointer; transition: all 0.3s ease;">Get Started</button>
      </div>
    </nav>
    `;
  }
});

