<?php
include 'global.php';
include 'db_conn.php';

header("Content-Type: application/json");

// Optional: Ensure user is logged in
if (!loggedin()) {
    http_response_code(403);
    echo json_encode(["error" => "Access denied. Please log in."]);
    exit;
}

// Fetch distinct product categories (tags)
$sql = "SELECT DISTINCT tag FROM products ORDER BY tag ASC";
$result = $conn->query($sql);

$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row['tag'];
}

echo json_encode(["categories" => $categories]);

$conn->close();
?>
