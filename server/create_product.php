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

if (!isset($_FILES['file']) || !isset($_POST['tag']) || !isset($_POST['detail'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Missing required fields (file, tag, detail)."]);
    exit;
}

if (empty($_FILES['file']['name']) || empty($_POST['tag']) || empty($_POST['detail'])) {
    http_response_code(400);
    echo json_encode(["error" => "File, tag, and detail cannot be empty."]);
    exit;
}

// Validate file
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 5 * 1024 * 1024; // 5MB

if (!in_array($_FILES['file']['type'], $allowedTypes)) {
    http_response_code(415); // Unsupported Media Type
    echo json_encode(["error" => "Only JPG, PNG, and GIF files are allowed."]);
    exit;
}

if ($_FILES['file']['size'] > $maxFileSize) {
    http_response_code(413); // Payload Too Large
    echo json_encode(["error" => "File size exceeds 5MB limit."]);
    exit;
}

// Sanitize inputs
$creatorid = $_SESSION['userid'];
$tag = htmlspecialchars(trim($_POST['tag']));
$detail = htmlspecialchars(trim($_POST['detail']));
$filename = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", basename($_FILES['file']['name']));

// Save product
$stmt = $conn->prepare("INSERT INTO products (creatorid, tag, detail) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $creatorid, $tag, $detail);

if ($stmt->execute()) {
    $productId = $stmt->insert_id;

    // Save the file
    $targetDir = './images/products/' . $productId;
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $filePath = $targetDir . '/' . $filename;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        echo json_encode([
            "success" => true,
            "message" => "Product created successfully.",
            "productId" => $productId,
            "imagePath" => $filePath
        ]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to move uploaded file."]);
    }
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Database error."]);
}

$stmt->close();
$conn->close();
?>
