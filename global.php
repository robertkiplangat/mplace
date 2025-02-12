<?php
ob_start();
session_start();
$current_file = $_SERVER["SCRIPT_NAME"];
$prev_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '#';

function loggedin()
{
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        return true;
    }
}
function user_det()
{
    include 'db_conn.php';
    $user_id = $_SESSION['user_id'];
    return $conn->query("SELECT username FROM users WHERE id='$user_id'")->fetch_assoc()['username'];
       
}
