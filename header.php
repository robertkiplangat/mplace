<?php
// Ensure global.php, db_conn.php, and header.php are only included once
<<<<<<< HEAD
include_once 'global.php';  // This file should define the loggedin() function
include_once 'db_conn.php';  // This file handles the DB connection
include_once 'header.php';    // This is your header, might include other stuff

// Check if the user is logged in
if (loggedin()) {
    // Get the user ID from session
    $user_id = $_SESSION['user_id'];

    // Query to fetch the profile picture from the database based on user ID
    $sql = "SELECT profile_pic FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql); // Prepared statement for security
    $stmt->bind_param("i", $user_id); // Bind the user_id as an integer
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result of the query
    $user = $result->fetch_assoc(); // Fetch the data
    $profile_pic = $user['profile_pic']; // Get the profile picture

    $stmt->close(); // Close the prepared statement

    // Query to check for unread messages
    $sql_unread = "SELECT COUNT(*) AS unread_count FROM messages WHERE recipientid = ? AND is_read = 0";
    $stmt_unread = $conn->prepare($sql_unread);
    $stmt_unread->bind_param("i", $user_id); // Bind the user_id as an integer
    $stmt_unread->execute(); // Execute the query
    $result_unread = $stmt_unread->get_result(); // Get the result of the query
    $unread_messages = $result_unread->fetch_assoc(); // Fetch the data
    $unread_count = $unread_messages['unread_count']; // Get the count of unread messages

    $stmt_unread->close(); // Close the prepared statement
=======
include_once 'global.php';
include_once 'db_conn.php';
include_once 'header.php';

// Initialize variables
$profile_pic = '';
$unread_count = 0;

if (loggedin()) {
    $user_id = $_SESSION['user_id'];

    // Fetch profile picture
    $sql = "SELECT profile_pic FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $profile_pic = $user['profile_pic'] ?? '';
    $stmt->close();

    // Fetch unread messages count
    $sql_unread = "SELECT COUNT(*) AS unread_count FROM messages WHERE recipientid = ? AND is_read = 0";
    $stmt_unread = $conn->prepare($sql_unread);
    $stmt_unread->bind_param("i", $user_id);
    $stmt_unread->execute();
    $result_unread = $stmt_unread->get_result();
    $unread_data = $result_unread->fetch_assoc();
    $unread_count = $unread_data['unread_count'] ?? 0;
    $stmt_unread->close();
>>>>>>> 21eb294 (Final commit)
} else {
    include 'login.php';
    include 'register.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
=======
    <title> USIU Marketplace</title>
>>>>>>> 21eb294 (Final commit)
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="main.css" rel="stylesheet">
<<<<<<< HEAD
    <link rel="icon" type="image/x-icon" href="images\site\shop.svg">
    <title>MPlace</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="bi bi-shop"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
=======
    <link rel="icon" type="image/x-icon" href="images/site/shop.svg">
    <style>
        :root {
            --usiu-blue: #00205B;
            --usiu-gold: #F6BE00;
            --usiu-light: #ffffff;
        }

        .navbar-usiu {
            background-color: var(--usiu-blue);
        }

        .navbar-usiu .nav-link,
        .navbar-usiu .navbar-brand,
        .navbar-usiu .btn-outline-light {
            color: var(--usiu-light) !important;
        }

        .navbar-usiu .nav-link:hover {
            color: var(--usiu-gold) !important;
        }

        .btn-primary {
            background-color: var(--usiu-gold);
            border-color: var(--usiu-gold);
            color: #000;
        }

        .btn-primary:hover {
            background-color: #d4a700;
            border-color: #d4a700;
        }

        .badge.bg-danger {
            background-color: red;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-usiu">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="bi bi-shop"></i> USIU Marketplace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

>>>>>>> 21eb294 (Final commit)
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">
<<<<<<< HEAD
                            <!-- Change the icon style based on unread messages -->
                            <i class="bi bi-chat-dots<?php echo $unread_count > 0 ? ' text-danger' : ''; ?>"></i>
                            <?php
                            if ($unread_count > 0) {
                                echo '<span class="badge bg-danger">' . $unread_count . '</span>';
                            }
                            ?>
=======
                            <i class="bi bi-chat-dots<?php echo $unread_count > 0 ? ' text-warning' : ''; ?>"></i>
                            <?php if ($unread_count > 0): ?>
                                <span class="badge bg-danger"><?php echo $unread_count; ?></span>
                            <?php endif; ?>
>>>>>>> 21eb294 (Final commit)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_product.php"><i class="bi bi-rocket-takeoff-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php"><i class="bi bi-gear"></i></a>
                    </li>
                </ul>

<<<<<<< HEAD
                <!-- Centered Search Box Without Making Navbar Wider -->
                <form class="d-flex justify-content-center" style="flex-grow: 1; max-width: 500px;" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="searchBox">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- Button to trigger modal -->
                <?php
                if (loggedin()) {
                    // Check if the profile picture exists and display it
                    if ($profile_pic) {
                        echo '<span style="color: white;">Hello, ' . user_det() . '
                        <img src="' . $profile_pic . ' " title= "'.' (User ID: ' . $_SESSION['user_id'] .')" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%; margin-left: 10px;"> 
                        <a href="logout.php" style="color: blue;">Log Out</a></span>';
                    } else {
                        echo '<span style="color: white;">Hello, ' . user_det() . ' (User ID: ' . $_SESSION['user_id'] . ') 
                        <a href="logout.php" style="color: blue;">Log Out</a></span>';
                    }
                } else {
                    echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authModal">Login / Register</button>';
                }
                ?>
=======
                <form class="d-flex justify-content-center" style="flex-grow: 1; max-width: 500px;" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search" id="searchBox">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>

                <?php if (loggedin()): ?>
                    <span class="ms-3 text-white d-flex align-items-center">
                        Hello, <?php echo user_det(); ?>
                        <?php if ($profile_pic): ?>
                            <img src="<?php echo $profile_pic; ?>" alt="Profile" title="User ID: <?php echo $_SESSION['user_id']; ?>" class="ms-2" style="width: 30px; height: 30px; border-radius: 50%;">
                        <?php endif; ?>
                        <a href="logout.php" class="ms-3 text-warning">Log Out</a>
                    </span>
                <?php else: ?>
                    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#authModal">Login / Register</button>
                <?php endif; ?>
>>>>>>> 21eb294 (Final commit)
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
<<<<<<< HEAD
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body (Login / Register forms) -->
                <div class="modal-body">
                    <!-- Login Form -->
                    <div id="loginForm">
                        <form action="<?php echo $current_file; ?>" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
=======
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Login -->
                    <div id="loginForm">
                        <form action="<?php echo $current_file; ?>" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
>>>>>>> 21eb294 (Final commit)
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
<<<<<<< HEAD
                    <!-- Registration Form -->
                    <div id="registerForm" style="display: none;">
                        <form action="<?php echo $current_file; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="emailR" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="emailR" name="emailR" value="<?php echo $emailR ?? ''; ?>" placeholder="Enter email" required>
                            </div>
                            <div class="mb-3">
                                <label for="usernameR" class="form-label">Username</label>
                                <input type="text" class="form-control" id="usernameR" name="usernameR" value="<?php echo $usernameR ?? ''; ?>" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="passwordR" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordR" name="passwordR" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="profilePic" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profilePic" name="profilePic" accept="image/*">
=======

                    <!-- Register -->
                    <div id="registerForm" style="display: none;">
                        <form action="<?php echo $current_file; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="emailR" class="form-label">Email</label>
                                <input type="email" name="emailR" id="emailR" class="form-control" value="<?php echo $emailR ?? ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="usernameR" class="form-label">Username</label>
                                <input type="text" name="usernameR" id="usernameR" class="form-control" value="<?php echo $usernameR ?? ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="passwordR" class="form-label">Password</label>
                                <input type="password" name="passwordR" id="passwordR" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="profilePic" class="form-label">Profile Picture</label>
                                <input type="file" name="profilePic" id="profilePic" class="form-control" accept="image/*">
>>>>>>> 21eb294 (Final commit)
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>
<<<<<<< HEAD
                <!-- Modal Footer (Switch Button) -->
=======

                <!-- Footer -->
>>>>>>> 21eb294 (Final commit)
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-link" id="switchToRegister" onclick="switchToRegister()">Don't have an account? Register</button>
                    <button type="button" class="btn btn-link" id="switchToLogin" onclick="switchToLogin()" style="display: none;">Already have an account? Login</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <!-- JavaScript to switch between forms -->
    <script>
        function switchToRegister() {
            // Switch to the register form
=======
    <!-- Switch JS -->
    <script>
        function switchToRegister() {
>>>>>>> 21eb294 (Final commit)
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = 'block';
            document.getElementById('authModalLabel').textContent = 'Register';
            document.getElementById('switchToRegister').style.display = 'none';
            document.getElementById('switchToLogin').style.display = 'block';
        }

        function switchToLogin() {
<<<<<<< HEAD
            // Switch to the login form
=======
>>>>>>> 21eb294 (Final commit)
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registerForm').style.display = 'none';
            document.getElementById('authModalLabel').textContent = 'Login';
            document.getElementById('switchToRegister').style.display = 'block';
            document.getElementById('switchToLogin').style.display = 'none';
        }
    </script>
<<<<<<< HEAD

</body>
=======
</body>

>>>>>>> 21eb294 (Final commit)
</html>
