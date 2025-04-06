<?php
session_start();  // Make sure the session is started
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Include DB connection
include 'global.php';
include 'db_conn.php';
include 'header.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Prepared statement to get distinct sender usernames
$stmt = $conn->prepare("SELECT DISTINCT u.id, u.username
                        FROM messages m
                        JOIN users u ON m.senderid = u.id
                        WHERE m.senderid = ? OR m.recipientid = ?");
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$senders = [];

while ($row = $result->fetch_assoc()) {
    $senders[] = [
        "id" => $row['id'],
        "username" => $row['username']
    ];
}

echo json_encode($senders);

$stmt->close();
$conn->close();
?>
