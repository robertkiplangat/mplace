<?php
include 'global.php';
include 'db_conn.php';
include 'header.php';  
?>

<!-- Include Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<<<<<<< HEAD
<!-- Custom Styling for Modern UI -->
=======
<!-- USIU Theme Custom Styling -->
>>>>>>> 21eb294 (Final commit)
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Helvetica Neue', sans-serif;
    }

    /* Hero Section */
    .hero {
<<<<<<< HEAD
        background: linear-gradient(to right, #4e73df, #1cc88a);
=======
        background: linear-gradient(to right, #00205B, #FDB913); /* USIU Blue to Yellow */
>>>>>>> 21eb294 (Final commit)
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
<<<<<<< HEAD
        background-color: #007bff;
=======
        background-color: #00205B; /* USIU Navy Blue */
>>>>>>> 21eb294 (Final commit)
        border: none;
        padding: 12px 30px;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
<<<<<<< HEAD
        background-color: #0056b3;
=======
        background-color: #001437; /* Darker navy */
>>>>>>> 21eb294 (Final commit)
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
<<<<<<< HEAD
=======
        color: #00205B; /* Navy Blue Text */
>>>>>>> 21eb294 (Final commit)
    }

    .feature-card-body p {
        font-size: 1rem;
        color: #6c757d;
    }

    /* Footer */
    .footer {
<<<<<<< HEAD
        background-color: #343a40;
=======
        background-color: #00205B; /* Navy Blue */
>>>>>>> 21eb294 (Final commit)
        color: white;
        padding: 20px 0;
        text-align: center;
    }

    .footer a {
<<<<<<< HEAD
        color: #007bff;
=======
        color: #FDB913; /* Golden Yellow */
>>>>>>> 21eb294 (Final commit)
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer a:hover {
<<<<<<< HEAD
        color: #0056b3;
=======
        color: #fff;
>>>>>>> 21eb294 (Final commit)
    }
</style>

<!-- Hero Section -->
<div class="hero">
    <div>
<<<<<<< HEAD
        <h1>Welcome to Our Store!</h1>
=======
        <h1>Welcome to USIU Marketplace!</h1>
>>>>>>> 21eb294 (Final commit)
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
<<<<<<< HEAD
                <img src="images\site\AR406306.webp" alt="Feature 1">
=======
                <img src="images/site/AR406306.webp" alt="Feature 1">
>>>>>>> 21eb294 (Final commit)
                <div class="card-body feature-card-body">
                    <h5 class="card-title">High Quality</h5>
                    <p class="card-text">We provide products that are durable and made from the best materials, ensuring you get value for your money.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card feature-card">
<<<<<<< HEAD
                <img src="images\site\81VoENhBLOL._SX679.webp" alt="Feature 2">
=======
                <img src="images/site/81VoENhBLOL._SX679.webp" alt="Feature 2">
>>>>>>> 21eb294 (Final commit)
                <div class="card-body feature-card-body">
                    <h5 class="card-title">Fast Delivery</h5>
                    <p class="card-text">Get your orders quickly and efficiently. We offer fast delivery options for your convenience.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card feature-card">
<<<<<<< HEAD
                <img src="images\site\67309f7926c64818a9101b77_multiple payment options.png" alt="Feature 3">
=======
                <img src="images/site/67309f7926c64818a9101b77_multiple payment options.png" alt="Feature 3">
>>>>>>> 21eb294 (Final commit)
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
<<<<<<< HEAD
    <p>&copy; 2025 Mplace | <a href="#">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
=======
    <p>&copy; 2025 USIU Marketplace | <a href="#">Privacy Policy</a> | <a href="terms.php">Terms of Service</a></p>
>>>>>>> 21eb294 (Final commit)
</div>

<!-- Include Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<<<<<<< HEAD
<?php
include 'footer.php';
?>
=======
<?php include 'footer.php'; ?>

>>>>>>> 21eb294 (Final commit)
