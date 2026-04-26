document.addEventListener("DOMContentLoaded", () => {
  // 1. Select all elements
  const header = document.getElementById("main-header");
  const menuOpenButton = document.querySelector("#menu-open-button");
  const menuCloseButton = document.querySelector("#menu-close-button");
  const navLinks = document.querySelectorAll(".md\\:flex a"); // Selects links in your nav
  const navContainer = header?.querySelector("nav");

  // 2. Mobile Menu Logic (Only runs if buttons exist)
  if (menuOpenButton) {
    menuOpenButton.addEventListener("click", () => {
      document.body.classList.toggle("show-mobile-menu");
    });
  }

  if (menuCloseButton) {
    menuCloseButton.addEventListener("click", () => {
      document.body.classList.remove("show-mobile-menu");
    });
  }

  // Close menu when a link is clicked
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      document.body.classList.remove("show-mobile-menu");
    });
  });

  // 3. Scroll Logic
  window.addEventListener("scroll", function () {
    if (!header) return;

    if (window.scrollY > 50) {
      // Hides the navbar by moving it up and setting opacity to 0
      header.classList.add(
        "opacity-0",
        "-translate-y-full",
        "pointer-events-none",
      );
      header.classList.remove("opacity-100", "translate-y-0");
    } else {
      // Shows the navbar when back at the top
      header.classList.remove(
        "opacity-0",
        "-translate-y-full",
        "pointer-events-none",
      );
      header.classList.add("opacity-100", "translate-y-0");
    }
  });
});
