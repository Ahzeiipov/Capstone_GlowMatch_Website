document.addEventListener("DOMContentLoaded", function() {
    // Load navigation bar
    fetch('../../component/navigation/navigation.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('navigation-bar').innerHTML = data;
      })
      .catch(error => console.error('Error loading navigation:', error));

    // Load footer
    fetch('../../component/footer/footer.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer').innerHTML = data;
      })
      .catch(error => console.error('Error loading footer:', error));
});