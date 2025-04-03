// Function to open modal
function openModal() {
    console.log("openModal function called");
    document.getElementById("modal").classList.add("active");
}

// Function to close modal when clicking outside
window.onclick = function (event) {
    const modal = document.getElementById("modal");
    if (event.target === modal) {
        modal.classList.remove("active");
    }
};

// Function to close modal when clicking the close button
function closeModal() {
    document.getElementById("modal").classList.remove("active");
}