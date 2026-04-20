const menuOpenButton = document.querySelector("#menu-open-button");
const menuCloseButton = document.querySelector("#menu-close-button");
const navLinks = document.querySelectorAll(".nav-menu .nav-link")

menuOpenButton.addEventListener("click", () => {
    // Toggle mobile menu visibility
    document.body.classList.toggle("show-mobile-menu")
});


// Close menu when the close button is clicked
menuCloseButton.addEventListener("click", () => menuOpenButton.click())


// Close menu when the nav link is clicked
navLinks.forEach(link => {
    link.addEventListener("click", () => menuOpenButton.click())
})

window.addEventListener('scroll', function () {
    const header = document.getElementById('main-header');
    const navContainer = header.querySelector('nav'); // Targets the inner nav

    if (window.scrollY > 50) {
        // --- SCROLLED STATE (Ultra Slim) ---
        header.classList.remove('py-12');
        header.classList.add('py-0', 'mx-4', 'md:mx-40', 'top-2', 'rounded-full', 'bg-opacity-90', 'backdrop-blur-md');

        // Reduce the inner nav padding as well
        if (navContainer) navContainer.classList.replace('py-4', 'py-1');

    } else {
        // --- INITIAL STATE ---
        header.classList.add('py-12');
        header.classList.remove('py-0', 'mx-4', 'md:mx-40', 'top-2', 'rounded-full', 'bg-opacity-90', 'backdrop-blur-md');

        // Restore the inner nav padding
        if (navContainer) navContainer.classList.replace('py-1', 'py-4');
    }
});