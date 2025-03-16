document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu li a"); // Select all menu links
    const currentPage = window.location.pathname; // Get the current page URL

    menuItems.forEach((item) => {
        // Normalize both the URL path and the link path
        const linkPath = new URL(item.href, window.location.origin).pathname;

        if (currentPage === linkPath) {
            item.parentElement.classList.add("active"); // Add 'active' class to the <li>
        }
    });
});
