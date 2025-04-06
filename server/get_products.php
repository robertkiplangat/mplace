<?php
include 'global.php';
include 'db_conn.php';

header("Content-Type: application/json");

// Optional: Admin check
if (!loggedin() || !is_admin()) {
    http_response_code(403); // Forbidden
    echo json_encode(["error" => "Access denied."]);
    exit;
}

// Fetch all products
$sql = "SELECT p.id, p.tag, p.detail, p.creatorid, u.username AS creator_name, p.created_at
        FROM products p
        JOIN users u ON p.creatorid = u.id
        ORDER BY p.created_at DESC";

$result = $conn->query($sql);

$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = [
        "id" => $row['id'],
        "tag" => $row['tag'],
        "detail" => $row['detail'],
        "creator_id" => $row['creatorid'],
        "creator_name" => $row['creator_name'],
        "created_at" => $row['created_at']
    ];
}

echo json_encode(["products" => $products]);

$conn->close();
?>
