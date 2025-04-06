<?php
session_start();
header("Access-Control-Allow-Origin: *"); // You can replace * with http://localhost:3000 for stricter control
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'db_conn.php';

// Accept only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
    exit;
}

// Decode JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || !isset($data['username']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "error" => "Missing required fields"]);
    exit;
}

$email = trim($data['email']);
$username = trim($data['username']);
$password = $data['password'];

// Check if any field is empty
if (empty($email) || empty($username) || empty($password)) {
    echo json_encode(["success" => false, "error" => "All fields are required"]);
    exit;
}

// Check if email already exists
$sql = "SELECT email FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["success" => false, "error" => "Email already exists"]);
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$insert_sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sss", $email, $username, $hashedPassword);

if ($insert_stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registration successful"]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to register user"]);
}

$insert_stmt->close();
$conn->close();
?>
