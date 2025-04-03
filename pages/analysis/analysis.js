
function openModal() {
    document.getElementById('modal').style.display = 'flex';
}

// Close modal when clicking outside
window.onclick = function(event) {
    var modal = document.getElementById('modal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
