<?php
// Database settings
$servername = "localhost";  // Server name (usually 'localhost')
$username = "root";         // Default MySQL username in XAMPP
$password = "";             // Default password is empty in XAMPP
$dbname = "library";        // Database name we created

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session (for success/error messages)
session_start();
?>