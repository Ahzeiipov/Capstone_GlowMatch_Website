<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user_id is set in session, redirect if not
if (!isset($_SESSION['user_id'])) {
    header("Location: /php/GlowMatch(1)/pages/homepage/homepage.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "skincareconsulting";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch user ID from session
$userId = $_SESSION['user_id']; // Replace hardcoded value with session-based user ID


// Fetch questions and options
if (!isset($_GET['recommend']) && !isset($_POST['question_id'])) {
    $sql = "SELECT q.QuestionID, q.QuestionText, q.Category, 
                   ao.OptionID, ao.OptionText, ao.SkinTypeEffect, ao.SeverityEffect, ao.Score
            FROM questions q
            LEFT JOIN answeroptions ao ON q.QuestionID = ao.QuestionID";
    $result = $conn->query($sql);
    $questions = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $questions[$row['QuestionID']]['text'] = $row['QuestionText'];
            $questions[$row['QuestionID']]['category'] = $row['Category'];
            if ($row['OptionID']) {
                $questions[$row['QuestionID']]['answers'][] = [
                    'option_id' => $row['OptionID'],
                    'text' => $row['OptionText'],
                    'skin_type_effect' => $row['SkinTypeEffect'],
                    'severity_effect' => $row['SeverityEffect'],
                    'score' => $row['Score']
                ];
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($questions);
    $conn->close();
    exit;
}

// Save user response
if (isset($_POST['question_id']) && isset($_POST['option_id'])) {
    $questionId = intval($_POST['question_id']);
    $optionId = intval($_POST['option_id']);
    $sql = "INSERT INTO responses (UserID, QuestionID, OptionID) VALUES ($userId, $questionId, $optionId)";
    $conn->query($sql);
    echo json_encode(['status' => 'success']);
    $conn->close();
    exit;
}

// Generate recommendation
if (isset($_GET['recommend']) && $_GET['recommend'] == 'true') {
    $sql = "SELECT ao.SkinTypeEffect, ao.SeverityEffect, ao.Score, q.Category
            FROM responses r
            JOIN answeroptions ao ON r.OptionID = ao.OptionID
            JOIN questions q ON r.QuestionID = q.QuestionID
            WHERE r.UserID = $userId";
    $result = $conn->query($sql);

    $skinTypeScores = ['Dry' => 0, 'Oily' => 0, 'Combination' => 0, 'Normal' => 0, 'Sensitive' => 0];
    $severityScores = ['Acne' => 0, 'Dark Spots' => 0, 'Large Pores' => 0];
    $totalScore = 0;

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $skinType = $row['SkinTypeEffect'];
            $severity = $row['SeverityEffect'];
            $score = $row['Score'];
            $category = $row['Category'];

            if ($skinType != 'None') {
                $skinTypeScores[$skinType] += $score;
            }
            if ($severity != 'None' && $category != 'Skin Type') {
                $severityScores[$category] += $score;
                $totalScore += $score;
            }
        }
    }

    // Determine skin type (highest score)
    $skinType = array_search(max($skinTypeScores), $skinTypeScores);

    // Determine severity levels
    $severityLevels = [];
    foreach ($severityScores as $concern => $score) {
        $percentage = $totalScore > 0 ? ($score * 100) / $totalScore : 0;
        if ($percentage <= 30) {
            $severityLevels[$concern] = 'None';
        } elseif ($percentage <= 70) {
            $severityLevels[$concern] = 'Mild';
        } else {
            $severityLevels[$concern] = 'Severe';
        }
    }

    // Default values if no responses for a concern
    $severityLevels['Acne'] = $severityLevels['Acne'] ?? 'None';
    $severityLevels['Dark Spots'] = $severityLevels['Dark Spots'] ?? 'None';
    $severityLevels['Large Pores'] = $severityLevels['Large Pores'] ?? 'None';

    // Save skin condition
    $sql = "INSERT INTO skincondition (UserID, SkinType, AcneSeverity, DarkSpotsSeverity, LargePoresSeverity)
            VALUES ($userId, '$skinType', '{$severityLevels['Acne']}', '{$severityLevels['Dark Spots']}', '{$severityLevels['Large Pores']}')
            ON DUPLICATE KEY UPDATE 
            SkinType = '$skinType', AcneSeverity = '{$severityLevels['Acne']}', 
            DarkSpotsSeverity = '{$severityLevels['Dark Spots']}', LargePoresSeverity = '{$severityLevels['Large Pores']}'";
    $conn->query($sql);

   // Fetch all matching products for the skin type
   $sql = "SELECT ProductID, ProductName, ShortDesrciption, SkinType, ConcernType, ProductImage3
   FROM products 
   WHERE FIND_IN_SET('$skinType', SkinType) > 0";
$result = $conn->query($sql);

$products = [];
$maxPossibleScore = 1; // Skin type match
foreach ($severityLevels as $concern => $severity) {
if ($severity != 'None') {
   $maxPossibleScore++;
}
}

if ($result && $result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
   $matchScore = 0;
   $concernTypes = explode(',', $row['ConcernType']);

   // Skin type match
   if (stripos($row['SkinType'], $skinType) !== false) {
       $matchScore++;
   }

   // Concern matches
   foreach ($concernTypes as $concern) {
       if (strpos($concern, 'Acne') !== false && $severityLevels['Acne'] != 'None' && strpos($concern, $severityLevels['Acne']) !== false) {
           $matchScore++;
       }
       if (strpos($concern, 'Dark Spots') !== false && $severityLevels['Dark Spots'] != 'None' && strpos($concern, $severityLevels['Dark Spots']) !== false) {
           $matchScore++;
       }
       if (strpos($concern, 'Large Pores') !== false && $severityLevels['Large Pores'] != 'None' && strpos($concern, $severityLevels['Large Pores']) !== false) {
           $matchScore++;
       }    
   }

   $matchPercentage = ($maxPossibleScore > 0) ? ($matchScore / $maxPossibleScore) * 100 : 0;

   // Add product to array with its match percentage
   $row['match_percentage'] = round($matchPercentage, 2);
   if (!empty($row['ProductImage3'])) {
       $row['ProductImage3'] = base64_encode($row['ProductImage3']);
   }
   $products[] = $row;
}
}

// Save the best product (optional, if you still want to track it)
if (!empty($products)) {
usort($products, function($a, $b) {
   return $b['match_percentage'] <=> $a['match_percentage'];
});
$bestProduct = $products[0];
$productId = $bestProduct['ProductID'];
$sql = "INSERT INTO recommendedproducts (UserID, ProductID) VALUES ($userId, $productId)
       ON DUPLICATE KEY UPDATE ProductID = $productId";
$conn->query($sql);
}

// Ingredient analysis (unchanged)
$ingredientsAnalysis = "No ingredients provided.";
$sql = "SELECT i.IngredientName, i.AcneEffect, i.DarkSpotsEffect, i.LargePoresEffect
   FROM userinputingredients ui
   JOIN ingredients i ON ui.IngredientName = i.IngredientName
   WHERE ui.UserID = $userId";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
$matches = 0;
$totalIngredients = $result->num_rows;
while ($row = $result->fetch_assoc()) {
   if ($severityLevels['Acne'] != 'None' && $row['AcneEffect'] == 'Beneficial') $matches++;
   if ($severityLevels['Dark Spots'] != 'None' && $row['DarkSpotsEffect'] == 'Beneficial') $matches++;
   if ($severityLevels['Large Pores'] != 'None' && $row['LargePoresEffect'] == 'Beneficial') $matches++;
}
$matchPercentages = ($matches * 100) / ($totalIngredients * 3);
$ingredientsAnalysis = "Ingredient Match: " . round($matchPercentages, 2) . "%";
}

// Fetch skin descriptions (unchanged)
$descriptions = [];
$sql = "SELECT sd.SkinDescriptionID, sd.SkinCondition, sd.Description
   FROM skincondition sc
   JOIN skindescription sd
   WHERE sc.UserID = $userId
   AND (
       sd.SkinCondition = sc.SkinType
       OR sd.SkinCondition = CONCAT(sc.AcneSeverity, ' Acne')
       OR sd.SkinCondition = CONCAT(sc.DarkSpotsSeverity, ' Dark Spots')
       OR sd.SkinCondition = CONCAT(sc.LargePoresSeverity, ' Large Pores')
   )";
$result = $conn->query($sql);

if ($result === false) {
error_log("SQL Error: " . $conn->error);
$descriptions = ['error' => 'Database query failed: ' . $conn->error];
} elseif ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
   $descriptions[] = [
       'SkinCondition' => $row['SkinCondition'],
       'Description' => $row['Description']
   ];
}
} else {
$descriptions = ['message' => 'No matching descriptions found for UserID ' . $userId];
}

header('Content-Type: application/json');
echo json_encode([
'skin_type' => $skinType,
'acne_severity' => $severityLevels['Acne'],
'dark_spots_severity' => $severityLevels['Dark Spots'],
'large_pores_severity' => $severityLevels['Large Pores'],
'products' => $products ?: [['error' => 'No products found']],
'ingredients_analysis' => $ingredientsAnalysis,
'descriptions' => $descriptions
]);
exit;
}
$conn->close();
?>