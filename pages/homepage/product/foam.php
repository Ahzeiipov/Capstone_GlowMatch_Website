<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "skincareconsulting");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch only Moisturizer products from the database
$sql = "SELECT * FROM products WHERE ProductType = 'Foam'";
$result = $conn->query($sql);
?>

<section>
    <section class="products-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="products">
                    <!-- Clickable Image that redirects to product_detail.php with Product ID -->
                    <a href="http://localhost/php/GlowMatch/pages/homepage/product/product-detail/product_detail.php?id=<?php echo htmlspecialchars($row['ProductID']); ?>">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['ProductImage3']); ?>" 
                             alt="<?php echo htmlspecialchars($row['ProductName']); ?>" 
                             class="product-image">
                    </a>
                    <div class="box">
                        <h4><b><?php echo htmlspecialchars($row['ProductName']); ?></b></h4>
                        <p><?php echo htmlspecialchars($row['ShortDesrciption']); ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        
        $conn->close();
        ?>
    </section>  
</section>