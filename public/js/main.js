// Function 3ashan n-toggle el menu fel mobile view
function toggleMenu() {
  document.querySelector(".nav-links").classList.toggle("active");
}

// Event listener 3ashan n-ghayar shakl el navbar lma n-scroll
window.addEventListener("scroll", () => {
  // lw e7na fel mobile msh h-n-apply el effect da
  if (window.innerWidth <= 768) return;

  const navbar = document.querySelector(".navbar");

  // lw 3mlna scroll aktar mn 50px n-dif class scrolled
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    // lw rge3na fo2 n-sheel el class
    navbar.classList.remove("scrolled");
  }
});
