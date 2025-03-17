// homepage.js (located inside the 'pages' folder)
document.addEventListener("DOMContentLoaded", function() {
    // Use fetch to load the navigation bar HTML into the homepage
    fetch('../../../navigation/navigation-bar.html') // Adjust the path to navigate to the 'navigation-bar' folder
      .then(response => response.text())
      .then(data => {
        document.getElementById('navigation-bar').innerHTML = data;
      })
      .catch(error => console.error('Error loading navigation:', error));
  });
  
  