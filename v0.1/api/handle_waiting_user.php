<?php
require_once('../config/db_connection.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];

    // Validate the input
    if (empty($fullName) || empty($email)) {
        $response = [
            'error' => 'Full name and email are required fields.'
        ];
        http_response_code(400);
    } else {
        // Start

        // Insert data into the database
$query = "INSERT INTO waitlist_users (full_name, email) VALUES ('$fullName', '$email')";
$result = mysqli_query($connection, $query);

if ($result) {
    $userId = mysqli_insert_id($connection); // Retrieve the last inserted id
        // Set the user_id as a cookie
        setcookie('userId', $userId, time() + (86400 * 30), "/"); // Set the cookie to expire in 30 days

    // Return the userId in the API response
    $response = [
        'message' => 'Waitlist user created successfully.',
        'userId' => $userId
    ];
    http_response_code(200);
} else {
    $response = [
        'error' => 'An error occurred while creating the waitlist user.'
    ];
    http_response_code(500);
}

        
        // End
    }
} else {
    $response = [
        'error' => 'Invalid request method.'
    ];
    http_response_code(405);
}

// Set the appropriate headers
header('Content-Type: application/json');

// Return the API response as JSON
echo json_encode($response);
exit;
?>
