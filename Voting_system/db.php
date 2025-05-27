<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "voting_system";

// Create a secure database connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8");
?>
