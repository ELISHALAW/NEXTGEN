document.addEventListener("DOMContentLoaded", () => {
    // 1. Select all elements
    const header = document.getElementById('main-header');
    const menuOpenButton = document.querySelector("#menu-open-button");
    const menuCloseButton = document.querySelector("#menu-close-button");
    const navLinks = document.querySelectorAll(".md\\:flex a"); // Selects links in your nav
    const navContainer = header?.querySelector('nav');

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
    navLinks.forEach(link => {
        link.addEventListener("click", () => {
            document.body.classList.remove("show-mobile-menu");
        });
    });

    // 3. Scroll Logic
    window.addEventListener('scroll', function () {
        if (!header) return;

        if (window.scrollY > 50) {
            header.classList.remove('py-6', 'w-full');
            header.classList.add('py-2', 'top-4', 'rounded-full', 'bg-opacity-90', 'backdrop-blur-md', 'max-w-[90%]', 'md:max-w-[70%]', 'mx-auto');
            if (navContainer) navContainer.classList.replace('py-2', 'py-1');
        } else {
            header.classList.add('py-6', 'w-full');
            header.classList.remove('py-2', 'top-4', 'rounded-full', 'bg-opacity-90', 'backdrop-blur-md', 'max-w-[90%]', 'md:max-w-[70%]', 'mx-auto');
            if (navContainer) navContainer.classList.replace('py-1', 'py-2');
        }
    });
});