<?php 
include 'global.php';
include 'db_conn.php';
include 'header.php';

if (!loggedin()) {
    echo '<script type="text/javascript">
                window.onload = function() {
                    alert("Please Login!");
                };
              </script>';
    die();
}

$user_id = $_SESSION['user_id'];
$otherPerson = $_GET['senderid']; // the person you are chatting with

// Retrieve messages where either sender or recipient matches the logged-in user or the other person
$result = $conn->query("SELECT `id`, `senderid`, `Content`, `is_read`, `recipientid`, `created` 
                        FROM `messages` 
                        WHERE (`senderid`='$otherPerson' AND `recipientid`='$user_id') 
                        OR (`senderid`='$user_id' AND `recipientid`='$otherPerson')");

?>

<?php
if ($result->num_rows > 0) {
    echo '<div class="container my-4">';
    echo '<h2 class="mb-4">Messages</h2>';
    
    // Loop through the messages and display them with conditional styling
    while ($row = $result->fetch_assoc()) {
        $message_content = htmlspecialchars($row['Content']);  // Prevent XSS by escaping special characters
        $message_class = ($row['senderid'] == $user_id) ? 'text-end' : 'text-start'; // Align based on sender/recipient
        $message_bg = ($row['senderid'] == $user_id) ? 'bg-primary text-white' : 'bg-light text-dark';
        
        echo '<div class="message-item mb-3 ' . $message_class . '">';
        echo '<div class="card ' . $message_bg . '">';
        echo '<div class="card-body">';
        echo '<p class="card-text">' . $message_content . '</p>';
        echo '<small class="text-muted">' . $row['created'] . '</small>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo '<div class="alert alert-info" role="alert">No messages found.</div>';
}
?>

<!-- Form to send new message -->
<div class="container">
    <h3>Send Message</h3>
    <form action="send_message.php" method="POST">
        <div class="mb-3">
            <label for="messageContent" class="form-label">Message</label>
            <textarea class="form-control" id="messageContent" name="messageContent" rows="3" required></textarea>
        </div>
        <input type="hidden" name="recipientid" value="<?php echo $otherPerson; ?>">
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>

<?php include 'footer.php'; ?>
