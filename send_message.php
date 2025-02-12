<?php 
include 'global.php';
include 'db_conn.php';

if (!loggedin()) {
    echo '<script type="text/javascript">
                window.onload = function() {
                    alert("Please Login!");
                };
              </script>';
    die();
}

// Retrieve form data
$user_id = $_SESSION['user_id']; // Logged-in user ID
$recipient_id = $_POST['recipientid']; // ID of the person receiving the message
$message_content = $_POST['messageContent']; // Message content

// Prepare the query to insert the message
$sql = "INSERT INTO messages (senderid, recipientid, Content, is_read, created) 
        VALUES (?, ?, ?, 0, NOW())"; // is_read is 0 for unread messages, created stores the current timestamp

// Prepare and execute the query
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('iis', $user_id, $recipient_id, $message_content); // 'iis' means integer, integer, string
    if ($stmt->execute()) {
        // Successfully inserted, redirect back to the message exchange page
        header("Location: message_exchange.php?senderid=" . $recipient_id);
        exit;
    } else {
        echo '<script type="text/javascript">
                window.onload = function() {
                    alert("Failed to send message. Please try again.");
                };
              </script>';
    }
} else {
    echo '<script type="text/javascript">
            window.onload = function() {
                alert("Database query failed.");
            };
          </script>';
}

$stmt->close();
$conn->close();
?>
