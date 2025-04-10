<?php
// Include global configurations, database connection, and header
include 'global.php';
include 'db_conn.php';
include 'header.php';

// Check if the user is logged in
if (!loggedin()) {
    header('Location: login.php'); // Redirect if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get the current logged-in user ID

// Fetch current user data from the database
$query = "SELECT `id`, `email`, `username`, `password`, `profile_pic` FROM `users` WHERE `id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// If the form is submitted, update the user data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password']; // Update password only if provided
    $profilePicPath = $user['profile_pic']; // Default to current profile picture path

    // Handle file upload if there is a file
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded file details
        $fileName = $_FILES['profilePic']['name'];
        $fileTmpName = $_FILES['profilePic']['tmp_name'];
        $fileSize = $_FILES['profilePic']['size'];
        $fileError = $_FILES['profilePic']['error'];

        // Check if the uploaded file is an image
        $imageCheck = getimagesize($fileTmpName);
        if ($imageCheck !== false) {
            // File is an image, continue with validation
            if ($fileSize <= 5000000) { // 5MB size limit
                $newFileName = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $fileDestination = 'images/users/' . $newFileName;

                // Move the file to the desired folder
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $profilePicPath = $fileDestination; // Update profile pic path
                } else {
                    $errorMessage = "Error uploading file!";
                }
            } else {
                $errorMessage = "File is too large!";
            }
        } else {
            $errorMessage = "Invalid file type! The file is not a valid image.";
        }
    }

    // Update the user data in the database, including the profile picture path
    $updateQuery = "UPDATE `users` SET `email` = ?, `username` = ?, `password` = ?, `profile_pic` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssi", $email, $username, $password, $profilePicPath, $user_id);

    if ($stmt->execute()) {
        $successMessage = "Your settings have been updated successfully!";
    } else {
        $errorMessage = "An error occurred while updating your settings.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Settings</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Your Settings</h2>
        
        <?php if (isset($successMessage)) : ?>
            <div class="alert alert-success">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Settings Form -->
        <form method="POST" action="settings.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password (Leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="profilePic" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profilePic" name="profilePic">
                <?php if ($user['profile_pic']) : ?>
                    <img src="<?php echo $user['profile_pic']; ?>" alt="Current Profile Picture" class="mt-3" style="max-width: 150px;">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
