<?php
include 'global.php';  // Include any global configurations or variables
include 'db_conn.php';  // Include your database connection
include 'header.php';  // Include your header

// Fetch all products from the 'products' table
$result = $conn->query("SELECT `id`, `creatorid`, `tag`, `detail`, `created` FROM `products` WHERE 1");

?>

<!-- Include Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Styling for Modern UI -->
<style>
    body {
        background-color: #f7f7f7;
        font-family: 'Helvetica Neue', sans-serif;
    }

    .product-container {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .product-container h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 40px;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #ffffff;
        border: none;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .carousel-inner img {
        object-fit: cover;
        height: 200px;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 15px;
    }

    .card-text {
        font-size: 1rem;
        color: #555;
        height: 75px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-date {
        font-size: 0.875rem;
        color: #888;
    }

    .product-price {
        font-weight: bold;
        color: #007bff;
    }

    .product-card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        padding: 0 20px;
    }

    /* Hover Effect on Carousel Image */
    .carousel-item img {
        transition: transform 0.3s ease;
    }

    .carousel-item:hover img {
        transform: scale(1.05);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .product-card-container {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
    }

    @media (max-width: 576px) {
        .product-card-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container product-container">
    <h2>Our Latest Products</h2>

    <div class="product-card-container">
        <?php
        // Check if we have results
        if ($result->num_rows > 0) {
            // Loop through each product and display in a Bootstrap 5 card
            while ($row = $result->fetch_assoc()) {
                $productId = $row['id'];  // Product ID
                $creatorId = $row['creatorid'];  // Creator ID (you may want to replace this with the actual creator's name later)
                $tag = $row['tag'];  // Tag
                $description = $row['detail'];  // Description
                $created = $row['created'];  // Date created
                
                // Set image folder path
                $imageFolder = "images/products/$productId/";
                $images = glob($imageFolder . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);  // Get all images in the folder (supports jpg, jpeg, png, gif)

                // Format the date if needed (for example, converting it to a more readable format)
                $formattedDate = date("F j, Y", strtotime($created));

                // Default image if no images are found
                if (empty($images)) {
                    // Use the default image in the product folder path
                    $imageSrc = "images/products/$productId/default-image_450.png";
                    $carouselHTML = '<img class="d-block w-100" src="' . $imageSrc . '" alt="Default Product Image">';
                } else {
                    // Prepare the carousel HTML
                    $carouselHTML = '';
                    $isFirstImage = true;
                    foreach ($images as $image) {
                        // Use the first image as the active one
                        $activeClass = $isFirstImage ? 'active' : '';
                        $carouselHTML .= '<div class="carousel-item ' . $activeClass . '">
                                            <img class="d-block w-100" src="' . $image . '" alt="Product Image">
                                          </div>';
                        $isFirstImage = false;
                    }

                    // Wrap the images in the carousel structure
                    $carouselHTML = '
                        <div id="carousel' . $productId . '" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                ' . $carouselHTML . '
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel' . $productId . '" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel' . $productId . '" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>';
                }

                // Display the product in a modern-looking Bootstrap 5 card with the carousel of images
                echo '
                <div class="card product-card">
                    <div class="card-body">
                        <a href="product.php?prodid=' . $productId . '">
                            <h5 class="card-title">' . $tag . '</h5>
                        </a>
                        <div>' . $carouselHTML . '</div>
                        <p class="card-text">' . $description . '</p>
                        <span class="product-date">Posted on: ' . $formattedDate . '</span><br>
                        <span class="product-price">$29.99</span>
                    </div>
                </div>';
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</div>

<!-- Include Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php
include 'footer.php';  // Include your footer
?>
