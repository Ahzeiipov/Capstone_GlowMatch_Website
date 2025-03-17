<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "skin_care";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If a recommendation_id is requested, fetch the corresponding product
if (isset($_GET['recommendation_id'])) {
    $recommendation_id = intval($_GET['recommendation_id']);
    $sql = "SELECT r.*, a.answer_text 
            FROM recommendations r
            LEFT JOIN answers a ON r.id = a.recommendation_id
            WHERE r.id = $recommendation_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "No recommendation found"]);
    }
    $conn->close();
    exit;
}

// Fetch questions and answers
$sql = "SELECT q.id as question_id, q.question_text, a.id as answer_id, a.answer_text, a.recommendation_id, a.description
        FROM questions q 
        JOIN answers a ON q.id = a.question_id";
$result = $conn->query($sql);

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[$row['question_id']]['text'] = $row['question_text'];
        $questions[$row['question_id']]['answers'][] = [
            'id' => $row['answer_id'],
            'text' => $row['answer_text'],
            'recommendation_id' => $row['recommendation_id'],
            'description' => $row['description'] // add the description field
        ];
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($questions);
?>
