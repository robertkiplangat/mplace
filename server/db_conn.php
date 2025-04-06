<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mplace";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, close the connection after it's no longer needed
// $conn->close();
?>
