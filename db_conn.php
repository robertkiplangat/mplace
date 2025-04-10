<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mplace";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $conn->close(); // closed on ALL connections it is called
