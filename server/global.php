<?php
session_start();
ob_start();  // If you need output buffering

$current_file = $_SERVER["SCRIPT_NAME"];
$prev_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '#';

function loggedin()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function user_det()
{
    include 'db_conn.php';

    // Check if the connection is successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);  // "i" stands for integer
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    return $user['username'];
}

function is_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}
?>
