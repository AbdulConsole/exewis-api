<?php
$host = "localhost"; // Replace with your database host
$user = "myusername 😎"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "db_database 😂"; // Replace with your database name

// Create a database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>