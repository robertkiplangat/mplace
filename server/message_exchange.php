<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// Include DB connection
include 'db_conn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$otherPerson = isset($_GET['senderid']) ? intval($_GET['senderid']) : 0;

if ($otherPerson <= 0) {
    echo json_encode(["error" => "Invalid sender ID"]);
    exit;
}

// Fetch messages between the two users
$stmt = $conn->prepare("SELECT id, senderid, recipientid, Content, is_read, created_at
                        FROM messages
                        WHERE (senderid = ? AND recipientid = ?)
                           OR (senderid = ? AND recipientid = ?)
                        ORDER BY id ASC");

$stmt->bind_param("iiii", $otherPerson, $user_id, $user_id, $otherPerson);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = [
        "id" => (int)$row['id'],
        "senderid" => (int)$row['senderid'],
        "recipientid" => (int)$row['recipientid'],
        "content" => htmlspecialchars($row['Content']),
        "is_read" => (bool)$row['is_read'],
        "created_at" => $row['created_at'] ?? null
    ];
}

echo json_encode($messages);

$stmt->close();
$conn->close();
?>
