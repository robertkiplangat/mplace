<?php
include 'global.php';
include 'db_conn.php';

header("Content-Type: application/json");

// Optional: Admin check
if (!loggedin() || !is_admin()) {
    http_response_code(403); // Forbidden
    echo json_encode(["error" => "Access denied."]);
    exit;
}

// Fetch all users
$sql = "SELECT id, username, email, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);

$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = [
        "id" => $row['id'],
        "username" => $row['username'],
        "email" => $row['email'],
        "created_at" => $row['created_at']
    ];
}

echo json_encode(["users" => $users]);

$conn->close();
?>
