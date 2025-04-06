<?php
session_start();
header("Access-Control-Allow-Origin: *"); // Or use http://localhost:3000
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'db_conn.php';

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
    exit;
}

// Read raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Check for required fields
if (!isset($data['email'], $data['password'])) {
    echo json_encode(["success" => false, "error" => "Missing email or password"]);
    exit;
}

$email = trim($data['email']);
$password = $data['password'];

// Validate input
if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "error" => "Please fill in all fields"]);
    exit;
}

// Prepared statement to fetch user
$sql = "SELECT id, email, username, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user" => [
                "id" => $user['id'],
                "username" => $user['username'],
                "email" => $user['email']
            ]
        ]);
    } else {
        echo json_encode(["success" => false, "error" => "Incorrect password"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "User not found"]);
}

$stmt->close();
$conn->close();
?>
