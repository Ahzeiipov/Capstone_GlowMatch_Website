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

$row = null;

// Get ProductID from URL
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("
        SELECT ProductName, KeyIngredients, ShortDesrciption, MoreDescription, 
               ProductBenefits, TextureImage, SkinType, 
               ProductImage1, ProductImage2, ProductImage3, 
               ProductImage4, ProductImage5, ProductDetails, ProductType 
        FROM products 
        WHERE ProductID = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>Product not found.</p>";
        exit();
    }
    $stmt->close();
} else {
    echo "<p>No product selected.</p>";
    exit();
}


$conn->close();
?>