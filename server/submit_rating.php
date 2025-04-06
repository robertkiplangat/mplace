<?php
include 'global.php';
include 'db_conn.php';

header("Content-Type: application/json");

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Only POST requests are allowed."]);
    exit;
}

// Check if user is logged in
if (!loggedin()) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "Unauthorized. Please log in."]);
    exit;
}

// Validate input
$data = $_POST;
if (
    !isset($data['productId']) ||
    !isset($data['rating']) ||
    !is_numeric($data['rating']) ||
    $data['rating'] < 1 || $data['rating'] > 5
) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Invalid or missing rating or productId."]);
    exit;
}

$productId = intval($data['productId']);
$rating = floatval($data['rating']);
$userId = $_SESSION['userid']; // Assuming user ID is stored in session

// Optionally: Prevent duplicate ratings by the same user for the same product
$checkSql = "SELECT id FROM product_ratings WHERE userid = ? AND productid = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("ii", $userId, $productId);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // Update the existing rating
    $updateSql = "UPDATE product_ratings SET rating = ?, rated_at = NOW() WHERE userid = ? AND productid = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("dii", $rating, $userId, $productId);

    if ($updateStmt->execute()) {
        echo json_encode(["success" => true, "message" => "Rating updated."]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to update rating."]);
    }

    $updateStmt->close();
} else {
    // Insert new rating
    $insertSql = "INSERT INTO product_ratings (userid, productid, rating, rated_at) VALUES (?, ?, ?, NOW())";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iid", $userId, $productId, $rating);

    if ($insertStmt->execute()) {
        echo json_encode(["success" => true, "message" => "Rating submitted."]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to submit rating."]);
    }

    $insertStmt->close();
}

$checkStmt->close();
$conn->close();
?>
