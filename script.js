document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector("#main-header");
  const menuOpenButton = document.querySelector("#menu-open-button");
  const menuCloseButton = document.querySelector("#menu-close-button");
  const menuOverlay = document.querySelector("#menu-overlay");
  const navLinks = document.querySelectorAll(".nav-link");

  // Mobile Menu Logic
  if (menuOpenButton) {
    menuOpenButton.addEventListener("click", () => {
      document.body.classList.add("show-mobile-menu");
      header?.classList.remove("-translate-y-full", "opacity-0", "pointer-events-none");
      header?.classList.add("translate-y-0", "opacity-100");
    });
  }

  if (menuCloseButton) {
    menuCloseButton.addEventListener("click", () => {
      document.body.classList.remove("show-mobile-menu");
    });
  }

  if (menuOverlay) {
    menuOverlay.addEventListener("click", () => {
      document.body.classList.remove("show-mobile-menu");
    });
  }

  // Close menu when a link is clicked
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      document.body.classList.remove("show-mobile-menu");
    });
  });

  // Hide navbar while scrolling, show again at top.
  if (header) {
    header.classList.add("transition-all", "duration-500", "translate-y-0", "opacity-100");
    window.addEventListener("scroll", () => {
      if (document.body.classList.contains("show-mobile-menu")) return;

      if (window.scrollY > 50) {
        header.classList.add("-translate-y-full", "opacity-0", "pointer-events-none");
        header.classList.remove("translate-y-0", "opacity-100");
      } else {
        header.classList.remove("-translate-y-full", "opacity-0", "pointer-events-none");
        header.classList.add("translate-y-0", "opacity-100");
      }
    });
  }
});
