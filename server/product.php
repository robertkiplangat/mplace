<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Include DB and config
include 'db_conn.php';
include 'global.php';
include 'header.php';

// Check if 'prodid' is provided via GET
if (isset($_GET['prodid'])) {
    $prodid = (int) $_GET['prodid'];

    $stmt = $conn->prepare("SELECT p.id, p.tags, p.detail, p.pic, p.created, p.posterid, u.username
                            FROM posts p
                            JOIN users u ON p.posterid = u.id
                            WHERE p.id = ?");
    $stmt->bind_param("i", $prodid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Determine image URL
        $image_url = $row['pic']
            ? "http://localhost:8000/images/products/{$prodid}/{$row['pic']}"
            : "http://localhost:8000/images/site/default-image_450.png";

        // Return product data as JSON
        echo json_encode([
            "id" => $row['id'],
            "tags" => $row['tags'],
            "description" => $row['detail'],
            "image_url" => $image_url,
            "created" => $row['created'],
            "poster" => [
                "id" => $row['posterid'],
                "username" => $row['username']
            ]
        ]);
    } else {
        echo json_encode(["error" => "Product not found."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "No product ID provided."]);
}

$conn->close();
?>
