<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user_id is set in session, redirect to homepage if not
if (!isset($_SESSION['user_id'])) {
    header("Location: /GlowMatch(1)/pages/homepage/homepage.php");
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

// Check if the user has existing consultation results
$sql = "SELECT COUNT(*) as count FROM skincondition WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
$conn->close();

// If results exist, redirect to the results page; otherwise, go to the welcome page
if ($row['count'] > 0) {
    header("Location: /GlowMatch(1)/pages/consultation/consulting-result/consulting-result.php");
} else {
    header("Location: /GlowMatch(1)/screen/wellcome_page/consulting_wellcome_page.php");
}
exit();
?>