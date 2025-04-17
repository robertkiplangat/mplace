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
<<<<<<< HEAD
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

=======
$otherPerson = $_GET['senderid'];

// Mark messages as read
$conn->query("UPDATE `messages` SET `is_read`=1 WHERE `senderid`='$otherPerson' AND `recipientid`='$user_id' AND `is_read`=0");

// Retrieve messages
$result = $conn->query("SELECT m.`id`, m.`senderid`, m.`Content`, m.`is_read`, m.`recipientid`, m.`created`, u.`username` 
                        FROM `messages` m
                        JOIN `users` u ON m.senderid = u.id
                        WHERE (m.`senderid`='$otherPerson' AND m.`recipientid`='$user_id') 
                        OR (m.`senderid`='$user_id' AND m.`recipientid`='$otherPerson')
                        ORDER BY m.`created` ASC");
?>

<style>
    /* Balanced USIU Color Scheme */
    :root {
        --usiu-blue: #003366;       /* Primary blue - reduced usage */
        --usiu-gold: #FFA500;       /* Warmer gold/orange (#FFA500 = orange) */
        --usiu-light: #f8f9fa;      /* Light background */
        --usiu-dark: #001A33;       /* Dark blue */
        --usiu-accent: #FFD700;     /* Brighter gold accent (#FFD700 = gold) */
    }
    
    .message-container {
        max-height: 500px;
        overflow-y: auto;
        background-color: #fafafa;
        border-radius: 10px;
        padding: 15px;
        border: 1px solid #eee;
    }
    
    .message-sent {
        background-color: var(--usiu-gold);
        color: white;
        border-radius: 18px 18px 0 18px;
        max-width: 70%;
        margin-left: auto;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }
    
    .message-received {
        background-color: white;
        border: 1px solid #eee;
        border-radius: 18px 18px 18px 0;
        max-width: 70%;
        margin-right: auto;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }
    
    .message-time {
        font-size: 0.75rem;
        color: #666;
        margin-top: 5px;
    }
    
    .read-receipt {
        font-size: 0.7rem;
        color: var(--usiu-blue);
        margin-left: 5px;
    }
    
    .sender-name {
        font-weight: bold;
        color: var(--usiu-blue);
        margin-bottom: 5px;
    }
    
    .message-input-area {
        border-top: 1px solid #eee;
        background-color: white;
        padding: 15px;
        position: sticky;
        bottom: 0;
    }
    
    .btn-send {
        background-color: var(--usiu-gold);
        color: white;
        border: none;
    }
    
    .btn-send:hover {
        background-color: #e69500;
    }
    
    .chat-header {
        background: linear-gradient(135deg, var(--usiu-blue) 60%, var(--usiu-gold) 100%);
        color: white;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }
    
    .badge-username {
        background-color: var(--usiu-accent);
        color: var(--usiu-dark);
    }
    
    /* Profile image styling */
    .profile-img {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border-radius: 50%;
        background-color: #eee;
        flex-shrink: 0;
    }
    
    /* Input focus effect */
    textarea:focus {
        border-color: var(--usiu-gold);
        box-shadow: 0 0 0 0.25rem rgba(255, 165, 0, 0.25);
    }
</style>

<div class="container my-4" style="max-width: 800px;">
    <div class="card shadow-sm">
        <!-- Chat Header with gradient -->
        <div class="chat-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <a href="javascript:history.back()" class="text-white me-3"><i class="fas fa-arrow-left"></i></a>
                <i class="fas fa-comments me-2"></i>Messages
            </h5>
            <span class="badge badge-username">
                <?php 
                $userQuery = $conn->query("SELECT username FROM users WHERE id='$otherPerson'");
                echo htmlspecialchars($userQuery->fetch_assoc()['username']);
                ?>
            </span>
        </div>
        
        <!-- Messages Container -->
        <div class="message-container p-3">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="mb-3 <?php echo ($row['senderid'] == $user_id) ? 'text-end' : 'text-start'; ?>">
                        <?php if ($row['senderid'] != $user_id): ?>
                            <div class="sender-name"><?php echo htmlspecialchars($row['username']); ?></div>
                        <?php endif; ?>
                        
                        <div class="d-flex align-items-end <?php echo ($row['senderid'] == $user_id) ? 'justify-content-end' : 'justify-content-start'; ?>">
                            <?php if ($row['senderid'] != $user_id): ?>
                                <img src="images/profile/<?php echo $row['senderid']; ?>.jpg" 
                                     class="rounded-circle me-2 profile-img"
                                     onerror="this.onerror=null; this.src='images/profile/default.jpg';"
                                     alt="Profile Picture">
                            <?php endif; ?>
                            
                            <div class="<?php echo ($row['senderid'] == $user_id) ? 'message-sent' : 'message-received'; ?> p-3">
                                <div><?php echo htmlspecialchars($row['Content']); ?></div>
                                <div class="message-time d-flex align-items-center <?php echo ($row['senderid'] == $user_id) ? 'justify-content-end' : 'justify-content-start'; ?>">
                                    <?php echo date("h:i A", strtotime($row['created'])); ?>
                                    <?php if ($row['senderid'] == $user_id && $row['is_read']): ?>
                                        <span class="read-receipt ms-1"><i class="fas fa-check-double"></i></span>
                                    <?php elseif ($row['senderid'] == $user_id): ?>
                                        <span class="read-receipt text-muted ms-1"><i class="fas fa-check"></i></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-comment-slash fa-3x text-muted mb-3" style="color: var(--usiu-gold) !important;"></i>
                    <p class="text-muted">No messages yet. Start the conversation!</p>
                    <button class="btn btn-sm" style="background-color: var(--usiu-gold); color: white;" onclick="document.querySelector('textarea').focus()">
                        <i class="fas fa-pen me-1"></i>Write Message
                    </button>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Message Input Area -->
        <div class="message-input-area">
            <form action="send_message.php" method="POST" class="d-flex gap-2 align-items-center">
                <input type="hidden" name="recipientid" value="<?php echo $otherPerson; ?>">
                <textarea class="form-control flex-grow-1" name="messageContent" rows="1" placeholder="Type a message..." required style="resize: none; border-radius: 20px;"></textarea>
                <button type="submit" class="btn btn-send" style="border-radius: 20px; padding: 8px 20px;">
                    Send
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Auto-scroll to bottom and auto-resize textarea
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.message-container');
    container.scrollTop = container.scrollHeight;
    
    const textarea = document.querySelector('textarea');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
        
        // Keep scrolled to bottom when typing long messages
        container.scrollTop = container.scrollHeight;
    });
    
    // Focus textarea when empty state button clicked
    document.querySelector('[onclick="document.querySelector(\'textarea\').focus()"]')
        .addEventListener('click', function() {
            textarea.focus();
        });
});
</script>

>>>>>>> 21eb294 (Final commit)
<?php include 'footer.php'; ?>
