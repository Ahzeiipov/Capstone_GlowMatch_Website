document.addEventListener("DOMContentLoaded", function () {
  // Load navigation bar
  fetch('../../component/navigation/navigation.html')
    .then(response => response.text())
    .then(data => {
      document.getElementById('navigation-bar').innerHTML = data;
    })
    .catch(error => console.error('Error loading navigation:', error));

  // Load footer
  fetch('../../component/footer/footer.html')
    .then(response => response.text())
    .then(data => {
      document.getElementById('footer').innerHTML = data;
    })
    .catch(error => console.error('Error loading footer:', error));

  // Load products
  fetch("../../component/product/moisturizer.html")
    .then(response => response.text())
    .then(data => {
      document.getElementById("products-container-moiserizer").innerHTML = data;
    })
    .catch(error => console.error("Error loading products:", error));

  fetch("../../component/product/foam.html")
    .then(response => response.text())
    .then(data => {
      document.getElementById("products-container-foam").innerHTML = data;
    })
    .catch(error => console.error("Error loading products:", error));

  fetch("../../component/product/sunscreen.html")
    .then(response => response.text())
    .then(data => {
      document.getElementById("products-container-sunscreen").innerHTML = data;
    })
    .catch(error => console.error("Error loading products:", error));
});