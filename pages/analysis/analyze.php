<?php
header('Content-Type: application/json');

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "skincareconsulting";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Fetch the UserID from session
$userId = $_SESSION['user_id'];  // Dynamic UserID

// Read JSON input
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['ingredients']) || empty($data['ingredients'])) {
    echo json_encode(['error' => 'No ingredients provided']);
    exit;
}

$userIngredients = array_map('strtolower', array_map('trim', $data['ingredients']));

// Fetch user skin condition
$sql = "SELECT SkinType, AcneSeverity, DarkSpotsSeverity, LargePoresSeverity FROM skincondition WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$userCondition = $result->fetch_assoc();

if (!$userCondition) {
    echo json_encode(['error' => 'User skin condition not found for UserID: ' . $userId]);
    exit;
}

$skinTypeEnum = $userCondition['SkinType'];
$acneSeverityEnum = $userCondition['AcneSeverity'];
$darkSpotsSeverityEnum = $userCondition['DarkSpotsSeverity'];
$largePoresSeverityEnum = $userCondition['LargePoresSeverity'];

// Store user input ingredients
foreach ($userIngredients as $ingredient) {
    $sql = "INSERT INTO userinputingredients (UserID, IngredientName) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $userId, $ingredient);
    $stmt->execute();
}

// Fetch matching ingredients
$sql = "SELECT IngredientName, AcneEffect, DarkSpotsEffect, LargePoresEffect 
        FROM ingredients 
        WHERE FIND_IN_SET(?, SkinTypeEffect)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $skinTypeEnum);
$stmt->execute();
$result = $stmt->get_result();

$matchedIngredients = [];
$points = 0;

while ($row = $result->fetch_assoc()) {
    $ingredientName = trim(strtolower($row['IngredientName']));
    if (in_array($ingredientName, $userIngredients)) {
        $matchedIngredients[] = $row['IngredientName'];
        
        // Check if ingredient has at least one beneficial effect
        $isBeneficial = false;
        if (($acneSeverityEnum !== 'None') && $row['AcneEffect'] === 'Beneficial') {
            $isBeneficial = true;
        }
        if (($darkSpotsSeverityEnum !== 'None') && $row['DarkSpotsEffect'] === 'Beneficial') {
            $isBeneficial = true;
        }
        if (($largePoresSeverityEnum !== 'None') && $row['LargePoresEffect'] === 'Beneficial') {
            $isBeneficial = true;
        }
        
        // Add 1 point if the ingredient has at least one beneficial effect
        if ($isBeneficial) {
            $points += 1;
        }
    }
}

// Calculate match percentage
$numberOfUserIngredients = count($userIngredients);
$maxPossiblePoints = $numberOfUserIngredients; // Now max points is just number of ingredients
$matchPercentage = ($maxPossiblePoints > 0) ? round(($points / $maxPossiblePoints) * 100, 2) : 0;

// Determine percentage range
if ($matchPercentage >= 80) {
    $percentageRange = 'Perfect';
} elseif ($matchPercentage >= 60) {
    $percentageRange = 'Good';
} elseif ($matchPercentage >= 40) {
    $percentageRange = 'Satisfactory';
} else {
    $percentageRange = 'Low';
}

// Fetch descriptions from skindescription table
$conditions = [$skinTypeEnum, $acneSeverityEnum, $darkSpotsSeverityEnum, $largePoresSeverityEnum, $percentageRange];
$descriptions = [];

foreach ($conditions as $condition) {
    $sql = "SELECT Description FROM skindescription WHERE skincondition = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $condition);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($descriptionRow = $result->fetch_assoc()) {
        $descriptions[] = $descriptionRow['Description'];
    }
}

// Special case for "Perfect" range
if ($percentageRange === 'Perfect') {
    $combinedDescription = "These ingredients are highly effective and well-suited to your skin’s condition. They provide optimal benefits and are a great match for achieving noticeable results with minimal risk of irritation.";
} elseif ($percentageRange === 'Good') {
    $combinedDescription = " These ingredients are generally compatible with your skin’s condition. They offer solid benefits and can support your skincare goals, though they might not be as targeted or potent as those in the Perfect range.";
}elseif ($percentageRange === 'Satisfactory') {
    $combinedDescription =  "These ingredients are somewhat matched to your skin’s condition and can provide mild benefits. While not as strong as higher-rated ingredients, they can still support basic skincare needs and contribute to overall skin health.";
} else {
    $combinedDescription = " These ingredients may not be the best match for your skin’s current condition. While they can provide some benefits, they are less likely to effectively address your specific needs or may not be as compatible with your skin type, potentially offering limited or less noticeable results.";
}

// Return JSON response
echo json_encode([
    'matchedIngredients' => $matchedIngredients,
    'matchPercentage' => $matchPercentage,
    'description' => $combinedDescription
]);

$conn->close();
?>