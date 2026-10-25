
<?php

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task 16";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8mb4");

?>