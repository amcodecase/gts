<?php
// Database configuration
$host = 'localhost'; // Change if your database is hosted on a different server
$username = 'main';
$password = 'main';
$dbname = 'gts_db'; // Replace with your actual database name

// Create a connection
$db = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// echo "Connected successfully";

// Close the connection when done
// $conn->close();
?>
