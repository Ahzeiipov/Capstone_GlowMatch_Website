document.addEventListener("DOMContentLoaded", function() {
    // Load navigation bar
    fetch('/project_capstone_skincare/GlowMatch-front/component/navigation/navigation.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('navigation-bar').innerHTML = data;
      })
      .catch(error => console.error('Error loading navigation:', error));

    // Load footer
    fetch('/project_capstone_skincare/GlowMatch-front/component/footer/footer.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer').innerHTML = data;
      })
      .catch(error => console.error('Error loading footer:', error));
});