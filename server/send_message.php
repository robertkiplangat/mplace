<?php
session_start();
header("Access-Control-Allow-Origin: *"); // Or specify your frontend domain instead of *
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include 'db_conn.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Read and decode the raw JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (
    !isset($input['recipientid']) ||
    !isset($input['content']) ||
    empty($input['recipientid']) ||
    empty(trim($input['content']))
) {
    echo json_encode(["success" => false, "error" => "Recipient ID and message content are required"]);
    exit;
}

$recipient_id = (int)$input['recipientid'];
$message_content = htmlspecialchars(trim($input['content']), ENT_QUOTES, 'UTF-8');

// Prepare insert statement
$sql = "INSERT INTO messages (senderid, recipientid, Content, is_read, created)
        VALUES (?, ?, ?, 0, NOW())";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["success" => false, "error" => "Database error"]);
    exit;
}

$stmt->bind_param("iis", $user_id, $recipient_id, $message_content);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Message sent successfully"]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to send message"]);
}

$stmt->close();
$conn->close();
?>
