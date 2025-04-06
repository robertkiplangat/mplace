<?php
include 'global.php';
include 'db_conn.php';

header("Content-Type: application/json");

// Make sure the user is logged in
if (!loggedin()) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized access. Please log in."]);
    exit;
}

// Check if a file is provided
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(["error" => "No image uploaded or upload failed."]);
    exit;
}

$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 5 * 1024 * 1024; // 5MB

$file = $_FILES['image'];

if (!in_array($file['type'], $allowedTypes)) {
    http_response_code(400);
    echo json_encode(["error" => "Only JPG, PNG, and GIF files are allowed."]);
    exit;
}

if ($file['size'] > $maxFileSize) {
    http_response_code(400);
    echo json_encode(["error" => "Image exceeds 5MB size limit."]);
    exit;
}

// Sanitize and create safe file name
$filename = basename($file['name']);
$filename = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $filename);

// Create upload directory
$uploadDir = "uploads/images/" . $_SESSION['user_id'];
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Move uploaded file
$targetPath = $uploadDir . '/' . time() . '_' . $filename;
if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to move uploaded image."]);
    exit;
}

// Return image path (can be used for preview or storage)
echo json_encode(["success" => true, "imageUrl" => $targetPath]);
?>
