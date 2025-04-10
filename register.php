<?php
// Make sure you include your database connection here
// Example: require 'db_connection.php';

if (loggedin()) {
    die();
} else {
    if (isset($_POST['emailR']) && isset($_POST['usernameR']) && isset($_POST['passwordR'])) {
        $emailR = $_POST['emailR'];
        $usernameR = $_POST['usernameR'];
        $passwordR = md5($_POST['passwordR']);  // Use password_hash() for better security

        if (!empty($emailR) && !empty($usernameR) && !empty($passwordR)) {
            // Check if the email already exists in the database
            $sql = "SELECT email FROM `users` WHERE email = '$emailR'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        E - mail exists!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                // Handle file upload if there is a file
                $profilePicPath = ''; // Default empty path if no file is uploaded
                if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
                    // Get the uploaded file details
                    $fileName = $_FILES['profilePic']['name'];
                    $fileTmpName = $_FILES['profilePic']['tmp_name'];
                    $fileSize = $_FILES['profilePic']['size'];
                    $fileError = $_FILES['profilePic']['error'];
                    $fileType = $_FILES['profilePic']['type'];

                    // Check if the uploaded file is an image
                    $imageCheck = getimagesize($fileTmpName);
                    if ($imageCheck !== false) {
                        // File is an image, continue with validation
                        if ($fileSize <= 5000000) { // 5MB size limit
                            $newFileName = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                            $fileDestination = 'images/users/' . $newFileName;

                            // Move the file to the desired folder
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                $profilePicPath = $fileDestination;
                            } else {
                                echo "Error uploading file!";
                            }
                        } else {
                            echo "File is too large!";
                        }
                    } else {
                        echo "Invalid file type! The file is not a valid image.";
                    }
                }

                // Insert user data into the database (including profile picture path)
                $sql = "INSERT INTO `users` (`id`, `email`, `username`, `password`, `profile_pic`) 
                        VALUES (NULL, '$emailR', '$usernameR', '$passwordR', '$profilePicPath')";
                $result = $conn->query($sql);

                if ($result) {
                    echo '<script type="text/javascript">
                            window.onload = function() {
                                alert("Registration Successful!");
                            };
                          </script>';
                } else {
                    echo "Error: " . $conn->error;
                }
            }
            $conn->close(); // close connection
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Please fill all the fields!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
}

?>
