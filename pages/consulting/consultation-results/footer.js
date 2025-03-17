// homepage.js (located inside the 'pages' folder)
document.addEventListener("DOMContentLoaded", function() {
    // Fetch the footer HTML and inject it into the footer div
    fetch('/front-end/footer/footer.html') // Adjust the path to navigate to the 'footer' folder
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer').innerHTML = data;
      })
      .catch(error => console.error('Error loading footer:', error));
});
