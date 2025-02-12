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

// Modify the query to join the `users` table and fetch the username instead of senderid
$result = $conn->query("SELECT DISTINCT u.id,u.username 
                        FROM messages m 
                        JOIN users u ON m.senderid = u.id 
                        WHERE m.senderid = '$user_id' OR m.recipientid = '$user_id'");

?>

<?php
if ($result->num_rows > 0) {
  // Start container for styling
  echo '<div class="container my-4">';
  echo '<h2 class="mb-4">Distinct Sender Usernames</h2>';

  // Loop through the result set
  while ($row = $result->fetch_assoc()) {
    // Wrap the entire card in a clickable <a> tag
    echo '<a href="message_exchange.php?senderid=' . $row['id'] . '" class="text-decoration-none">';
    echo '  <div class="card mb-3">';
    echo '    <div class="card-body">';
    echo '      <h5 class="card-title">Sender Username: ' . $row['username'] . '</h5>';
    echo '    </div>';
    echo '  </div>';
    echo '</a>';
  }

  echo '</div>';
} else {
  echo '<div class="alert alert-info" role="alert">No distinct sender usernames found.</div>';
}

?>

<?php include 'footer.php'; ?>
