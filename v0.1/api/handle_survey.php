<?php
require_once('../config/db_connection.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
$question1 = $_POST['question1'];
$question2 = $_POST['question2'];
$question3 = $_POST['question3'];
$question4 = $_POST['question4'];
$question5 = $_POST['question5'];

// Retrieve the user_id from the cookie
$userId = $_COOKIE['userId'] ?? null;

// Insert data into the database
$query = "INSERT INTO survey_responses (user_id, question1, question2, question3, question4, question5)
          VALUES ('$userId', '$question1', '$question2', '$question3', '$question4', '$question5')";
          
$result = mysqli_query($connection, $query);

    if ($result) {
        $response = [
            'message' => 'Survey submitted successfully.',
            'userId' => $userId
        ];
        http_response_code(200);
    } else {
        $response = [
            'error' => 'An error occurred while submitting the survey.'
        ];
        http_response_code(500);
    }
} else {
    $response = [
        'error' => 'Invalid request method.'
    ];
    http_response_code(405);
}

// Set the appropriate headers.
header('Content-Type: application/json');

// Return the API response as JSON
echo json_encode($response);
exit;
?>