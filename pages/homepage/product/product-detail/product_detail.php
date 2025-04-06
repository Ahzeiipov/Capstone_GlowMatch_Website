<?php

include '../../../../include/productdetail-con/product-detail-con.php';   

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../../asset/css/navigation.css"> 
    <script src="./scripts.js"></script>
    <script src="../../../js/navigation.js"></script>
    <link rel="stylesheet" href="../../../../asset/css/drop_down_menu.css">
    <link rel="stylesheet" href="../../asset/css/homepage.css">
    <link rel="stylesheet" href="../../../../asset/css/footer.css">
    <link rel="stylesheet" href="../../../../asset/global-style/product.css">
    <link rel="stylesheet" href="../../../../asset/css/product_detail.css">
    <link rel="shortcut icon" href="../../../../asset/image/gm.png" type="x-icon">
    <title>
       Product Details
    </title>
</head>
<body>
  <?php include '../../../../component/navigation/navigation.php'; ?> 
    
<div class="product-container">
    <div class="image-gallery">
    <div class="main-image">
        <img id="displayedImage" 
             src="data:image/jpeg;base64,<?php echo base64_encode($row['ProductImage3']); ?>" 
             alt="<?php echo htmlspecialchars($row['ProductName']); ?>">
    </div>

    <div class="thumbnail-container">
        <button class="nav-btn prev" onclick="prevImage()">&#10094;</button>
        <?php  
        for ($i = 1; $i <= 5; $i++): 
            if (!empty($row["ProductImage$i"])): 
        ?>
            <img class="thumbnail" 
                 src="data:image/jpeg;base64,<?php echo base64_encode($row["ProductImage$i"]); ?>" 
                 onclick="changeImage(this.src)">
        <?php 
            endif; 
        endfor; 
        ?>
        <button class="nav-btn next" onclick="nextImage()">&#10095;</button>
    </div>
</div>

    <div class="product-details">
        <h1><?php echo htmlspecialchars($row['ProductName']); ?></h1>
        <h3><?php echo htmlspecialchars($row['ShortDesrciption']); ?></h3>
        <p><strong>What It Is:</strong> <?php echo htmlspecialchars($row['MoreDescription']); ?></p>
        <p><strong>Product Benefits:</strong> <?php echo htmlspecialchars($row['ProductBenefits']); ?></p>
        <p><strong>Skin Type:</strong> <?php echo htmlspecialchars($row['SkinType']); ?></p>
        <p><strong>Key Ingredients:</strong> <?php echo htmlspecialchars($row['KeyIngredients']); ?></p>
        <hr>

        <div class="tabs">
            <button class="tab-button active" onclick="showTab('details')">Product details</button>
            <button class="tab-button" onclick="showTab('texture')">Texture</button>
        </div>

        <div id="details" class="tab-content active">
            <p><strong><?php echo htmlspecialchars($row['ProductName']); ?></strong></p>
            <p><?php echo htmlspecialchars($row['ProductDetails']); ?></p>
        </div>

        <div id="texture" class="tab-content">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['TextureImage']); ?>" alt="Texture Image" style="width: 30%; height: auto;">
        </div>
        
    </div>

</div>

<script>
    function showTab(tabName) {
  document.querySelectorAll('.tab-content').forEach((tab) => {
      tab.classList.remove('active');
  });

  document.querySelectorAll('.tab-button').forEach((button) => {
      button.classList.remove('active');
  });

  document.getElementById(tabName).classList.add('active');

  document.querySelector(`.tab-button[onclick="showTab('${tabName}')"]`).classList.add('active');
  }


let currentImageIndex = 0; 
let productImages = []; 

// Function to initialize the gallery and images
function initializeGallery() {
    const thumbnails = document.querySelectorAll('.thumbnail'); 
    productImages = Array.from(thumbnails).map(thumbnail => thumbnail.src); 

    if (productImages.length > 0) {
        document.getElementById('displayedImage').src = productImages[currentImageIndex]; 
    }
}


function changeImage(src) {
    document.getElementById('displayedImage').src = src; 
    currentImageIndex = productImages.indexOf(src); 
}

// Show the previous image
function prevImage() {
    currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : productImages.length - 1;
    document.getElementById('displayedImage').src = productImages[currentImageIndex]; 
}

// Show the next image
function nextImage() {
    currentImageIndex = (currentImageIndex < productImages.length - 1) ? currentImageIndex + 1 : 0;
    document.getElementById('displayedImage').src = productImages[currentImageIndex]; // Update displayed image
}

// Initialize the gallery when the document loads
document.addEventListener('DOMContentLoaded', initializeGallery);

</script>
    
<section>
        <h1 style="margin: 40px; font-size: 30px;">Others</h1>
        <?php
        if ($row['ProductType'] == 'Moisturizer') {
            include '../moisturizer.php';
            include '../foam.php';
            include '../sunscreen.php';
           
        } elseif ($row['ProductType'] == 'Sunscreen') {
            include '../sunscreen.php';
            include '../foam.php';
            include '../moisturizer.php';
        } elseif ($row['ProductType'] == 'Foam') {
            include '../foam.php';
            include '../sunscreen.php';
            include '../moisturizer.php';
        }
        ?>
</section>

</body>

<?php include '../../../../component/footer/footer.php'; ?>

</html>
