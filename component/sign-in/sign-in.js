document.getElementById('openPopup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'flex';
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('popup')) {
        document.getElementById('popup').style.display = 'none';
    }
});