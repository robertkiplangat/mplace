<?php
if (loggedin()) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="main.css" rel="stylesheet">
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
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="messages.php"><i class="bi bi-chat-dots"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_product.php"><i class="bi bi-rocket-takeoff-fill"></i></a>
                </li>
            </ul>

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
                echo 'Hello,' . user_det() . ' <a href="logout.php">Log Out</a>';
            } else {
                echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authModal">Login / Register</button>';
            }
            ?>
        </div>
    </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
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
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <!-- Registration Form -->
                <div id="registerForm" style="display: none;">
                    <form action="<?php echo $current_file; ?>" method="POST">
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
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
            <!-- Modal Footer (Switch Button) -->
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-link" id="switchToRegister" onclick="switchToRegister()">Don't have an account? Register</button>
                <button type="button" class="btn btn-link" id="switchToLogin" onclick="switchToLogin()" style="display: none;">Already have an account? Login</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to switch between forms -->
<script>
    function switchToRegister() {
        // Switch to the register form
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'block';
        document.getElementById('authModalLabel').textContent = 'Register';
        document.getElementById('switchToRegister').style.display = 'none';
        document.getElementById('switchToLogin').style.display = 'block';
    }

    function switchToLogin() {
        // Switch to the login form
        document.getElementById('loginForm').style.display = 'block';
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('authModalLabel').textContent = 'Login';
        document.getElementById('switchToRegister').style.display = 'block';
        document.getElementById('switchToLogin').style.display = 'none';
    }
</script>
