<?php
include 'global.php';  // Include global configurations
include 'db_conn.php';  // Database connection
include 'header.php';  // Site header, includes navigation, etc.
?>

<!-- Include Bootstrap 5 CSS (consider using a stable release) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Styling for Modern UI -->
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Helvetica Neue', sans-serif;
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(to right, #4e73df, #1cc88a);
        color: white;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 20px;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .hero p {
        font-size: 1.25rem;
        margin-bottom: 30px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 30px;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Features Section */
    .feature-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    .feature-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .feature-card-body {
        padding: 20px;
    }

    .feature-card-body h5 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .feature-card-body p {
        font-size: 1rem;
        color: #6c757d;
    }

    /* Footer */
    .footer {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
        text-align: center;
    }

    .footer a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer a:hover {
        color: #0056b3;
    }
</style>

<!-- Hero Section -->
<div class="hero">
    <div>
        <h1>Welcome to Our Store!</h1>
        <p>Your go-to destination for amazing products and exclusive deals. Discover what's new today.</p>
        <a href="search.php" class="btn btn-primary">Browse Products</a>
    </div>
</div>

<!-- Features Section -->
<div class="container py-5">
    <h2 class="text-center mb-4">What We Offer</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card feature-card">
                <img src="https://via.placeholder.com/400x200" alt="Feature 1">
                <div class="card-body feature-card-body">
                    <h5 class="card-title">High Quality</h5>
                    <p class="card-text">We provide products that are durable and made from the best materials, ensuring you get value for your money.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card feature-card">
                <img src="https://via.placeholder.com/400x200" alt="Feature 2">
                <div class="card-body feature-card-body">
                    <h5 class="card-title">Fast Delivery</h5>
                    <p class="card-text">Get your orders quickly and efficiently. We offer fast delivery options for your convenience.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card feature-card">
                <img src="https://via.placeholder.com/400x200" alt="Feature 3">
                <div class="card-body feature-card-body">
                    <h5 class="card-title">Secure Payments</h5>
                    <p class="card-text">Shop with peace of mind, knowing that your payment information is always safe with us.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<div class="footer">
    <p>&copy; 2025 Mplace | <a href="privacy-policy.php">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
</div>

<!-- Include Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php
include 'footer.php';  // Include footer content
?>
