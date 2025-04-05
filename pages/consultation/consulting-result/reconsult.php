<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user_id is set in session, redirect if not
if (!isset($_SESSION['user_id'])) {
    header("Location: /php/GlowMatch(1)/pages/homepage/homepage.php");
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "skincareconsulting";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user ID from session
$userId = $_SESSION['user_id'];

// Delete user responses from the 'responses' table
$sqlResponses = "DELETE FROM responses WHERE UserID = ?";
$stmtResponses = $conn->prepare($sqlResponses);
$stmtResponses->bind_param("i", $userId);
$stmtResponses->execute();
$stmtResponses->close();

// Delete user skin condition from the 'skincondition' table
$sqlSkinCondition = "DELETE FROM skincondition WHERE UserID = ?";
$stmtSkinCondition = $conn->prepare($sqlSkinCondition);
$stmtSkinCondition->bind_param("i", $userId);
$stmtSkinCondition->execute();
$stmtSkinCondition->close();

// Close the database connection
$conn->close();

// Redirect to the consultation page
header("Location: /GlowMatch(1)/pages/consultation/consulting.php");
exit();
?>