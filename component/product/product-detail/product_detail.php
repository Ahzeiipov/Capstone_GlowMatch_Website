<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../product_detail.js"></script>
    <link rel="stylesheet" href="../../../asset/css/navigation.css">
    <script src="../../../js/navigation.js"></script>
    <link rel="stylesheet" href="../../../asset/css/footer.css">
    <link rel="stylesheet" href="../../../asset/global-style/product.css">
    <link rel="stylesheet" href="../../../asset/css/product_detail.css">
</head>

<body>
    <?php include '../../../component/navigation/navigation.php'; ?>

    <div class="product-container">
        <?php
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";
        $database = "skincareconsulting"; 
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $productId = intval($_GET['id']); 

        // Use a prepared statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT ProductName, KeyIngredients, ShortDesrciption, MoreDescription, ProductBenefits, TextureImage, SkinType, ProductImage1, ProductImage2, ProductImage3, ProductImage4, ProductImage5, ProductDetails, ProductType FROM products WHERE ProductID = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if product data exists
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            ?>

            <div class="image-gallery">
                <div class="main-image">
                    <?php if ($product['ProductImage1']): ?>
                        <img id="displayedImage" src="data:image/jpeg;base64,<?php echo base64_encode($product['ProductImage1']); ?>" alt="Product Image">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                </div>
                <div class="thumbnail-container">
                    <button class="nav-btn prev" onclick="prevImage()">&#10094;</button>
                    <?php if ($product['ProductImage1']): ?>
                        <img class="thumbnail" src="data:image/jpeg;base64,<?php echo base64_encode($product['ProductImage1']); ?>" onclick="changeImage(this.src)">
                    <?php endif; ?>
                    <?php if ($product['ProductImage2']): ?>
                        <img class="thumbnail" src="data:image/jpeg;base64,<?php echo base64_encode($product['ProductImage2']); ?>" onclick="changeImage(this.src)">
                    <?php endif; ?>
                    <?php if ($product['ProductImage3']): ?>
                        <img class="thumbnail" src="data:image/jpeg;base64,<?php echo base64_encode($product['ProductImage3']); ?>" onclick="changeImage(this.src)">
                    <?php endif; ?>
                    <?php if ($product['ProductImage4']): ?>
                        <img class="thumbnail" src="data:image/jpeg;base64,<?php echo base64_encode($product['ProductImage4']); ?>" onclick="changeImage(this.src)">
                    <?php endif; ?>
                    <?php if ($product['ProductImage5']): ?>
                        <img class="thumbnail" src="data:image/jpeg;base64,<?php echo base64_encode($product['ProductImage5']); ?>" onclick="changeImage(this.src)">
                    <?php endif; ?>
                    <button class="nav-btn next" onclick="nextImage()">&#10095;</button>
                </div>
            </div>
            <div class="product-details">
                <h1 style="margin-top: 0px;"><?php echo htmlspecialchars($product['ProductName']); ?></h1>
                <p style="margin-left: 2px;"><?php echo htmlspecialchars($product['ShortDesrciption']); ?></p>
                <hr>
                <strong>What It Is:</strong>
                <p><?php echo htmlspecialchars($product['MoreDescription']); ?></p>
                <strong>Product Benefits:</strong>
                <p><?php echo htmlspecialchars($product['ProductBenefits']); ?></p>
                <strong>Skin Type:</strong>
                <p><?php echo htmlspecialchars($product['SkinType']); ?></p>
                <strong>Key Ingredients:</strong>
                <p><?php echo htmlspecialchars($product['KeyIngredients']); ?></p>
                <hr>
                <div class="tabs">
                    <button class="tab-button active" onclick="showTab('details', <?php echo $productId; ?>)">Product details</button>
                    <button class="tab-button" onclick="showTab('texture', <?php echo $productId; ?>)">Texture</button>
                </div>
                <div id="details" class="tab-content active">
                    <strong><?php echo htmlspecialchars($product['ProductName']); ?></strong>
                    <p><?php echo htmlspecialchars($product['ProductDetails']); ?></p>
                </div>
                <div id="texture" class="tab-content">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($product['TextureImage']); ?>" alt="Texture Image" style="width: 15%; height: auto;">
                </div>
            </div>

            <?php
        } else {
            echo "Product not found.";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <section>
        <h3 style="margin: 40px; font-size: 30px;">Others</h3>
        <?php
        if ($product['ProductType'] == 'Moisturizer') {
            include '../../../component/product/moisturizer.php';
        } elseif ($product['ProductType'] == 'Sunscreen') {
            include '../../../component/product/sunscreen.php';
        } elseif ($product['ProductType'] == 'Foam') {
            include '../../../component/product/foam.php';
        }
        ?>
    </section>
    
    <section>
        <?php include '../../../component/footer/footer.php'; ?>
    </section>

    <script>
    function showTab(tab, productId) {
        const detailsTab = document.getElementById('details');
        const textureTab = document.getElementById('texture');
        if (tab === 'details') {
            detailsTab.classList.add('active');
            textureTab.classList.remove('active');
            fetch(`../../../api/getProductDetails.php?id=${productId}&tab=details`)
                .then(response => response.json())
                .then(data => {
                    detailsTab.innerHTML = data.details;
                });
        } else if (tab === 'texture') {
            detailsTab.classList.remove('active');
            textureTab.classList.add('active');
            fetch(`../../../api/getProductDetails.php?id=${productId}&tab=texture`)
                .then(response => response.json())
                .then(data => {
                    textureTab.innerHTML = data.details;
                });
        }
    }
    </script>
</body>

</html>