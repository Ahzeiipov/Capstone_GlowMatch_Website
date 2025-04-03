document.addEventListener("DOMContentLoaded", function () {
    // Select all menu links
    const menuItems = document.querySelectorAll(".menu li a");
    // Get the current page URL path
    const currentPage = window.location.pathname;

    // Highlight the active menu item
    menuItems.forEach((item) => {
        const linkPath = new URL(item.href).pathname; // Ensure it's an absolute URL and get the pathname
        if (currentPage === linkPath || currentPage === linkPath.replace(/\/$/, "")) {
            item.parentElement.classList.add("active"); // Add active class to the parent <li>
        }
    });

    // Add scroll functionality to change navbar background color
    window.addEventListener('scroll', function () {
        const nav = document.querySelector('nav');
        if (window.scrollY > 0) {
            nav.classList.add('scrolled'); // Add class when scrolled down
        } else {
            nav.classList.remove('scrolled'); // Remove class when at the top
        }
    });
});

// // Function to open modal
// function openModal() {
//     console.log("openModal function called");
//     document.getElementById("modal").classList.add("active");
// }

// // Function to close modal when clicking outside
// window.onclick = function (event) {
//     const modal = document.getElementById("modal");
//     if (event.target === modal) {
//         modal.classList.remove("active");
//     }
// };

// // Function to close modal when clicking the close button
// function closeModal() {
//     document.getElementById("modal").classList.remove("active");
// }