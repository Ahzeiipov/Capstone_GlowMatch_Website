document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = 0;
    const images = [
        "/project_capstone_skincare/GlowMatch-front/asset/image/moisirizer/pink/pink (1).png",
        "/project_capstone_skincare/GlowMatch-front/asset/image/moisirizer/pink/pink (2).png",
        "/project_capstone_skincare/GlowMatch-front/asset/image/moisirizer/pink/pink (3).png"
    ];
    const displayedImage = document.getElementById("displayedImage");

    function changeImage(index) {
        currentIndex = index;
        displayedImage.src = images[currentIndex];
    }

    window.nextImage = function () {
        currentIndex = (currentIndex + 1) % images.length;
        changeImage(currentIndex);
    };

    window.prevImage = function () {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        changeImage(currentIndex);
    };

    window.showTab = function (tabId) {
        document.querySelectorAll(".tab-content").forEach((tab) => {
            tab.classList.remove("active");
        });
        document.querySelectorAll(".tab-button").forEach((button) => {
            button.classList.remove("active");
        });

        document.getElementById(tabId).classList.add("active");
        document
            .querySelector(`.tab-button[onclick="showTab('${tabId}')"]`)
            .classList.add("active");
    };

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
    fetch("/project_capstone_skincare/GlowMatch-front/component/product/sunscreen.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("products-container-sunscreen").innerHTML = data;
        })
        .catch(error => console.error("Error loading products:", error));
});
