<?php
include 'global.php';
include 'db_conn.php';

header("Content-Type: application/json");

// Check if the user is logged in
if (!loggedin()) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "Unauthorized. Please log in."]);
    exit;
}

$userId = $_SESSION['userid']; // Adjust to match your session variable

// Fetch unread or latest notifications
$sql = "SELECT id, type, message, created_at, is_read
        FROM notifications
        WHERE recipient_id = ?
        ORDER BY created_at DESC
        LIMIT 20";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
$notifications = [];

while ($row = $result->fetch_assoc()) {
    $notifications[] = [
        "id" => $row['id'],
        "type" => $row['type'],
        "message" => $row['message'],
        "created_at" => $row['created_at'],
        "is_read" => (bool)$row['is_read']
    ];
}

echo json_encode(["notifications" => $notifications]);

$stmt->close();
$conn->close();
?>
