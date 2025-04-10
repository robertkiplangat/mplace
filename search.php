<?php
include 'global.php';  // Include any global configurations or variables
include 'db_conn.php';  // Include your database connection
include 'header.php';  // Include your header

// Fetch all products from the 'products' table
$result = $conn->query("SELECT `id`, `creatorid`, `tag`, `detail`, `price`, `created` FROM `products` WHERE 1");

// Check if query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!-- Include Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Styling for Image Scaling -->
<style>
    /* Ensures images scale to fit within the card */
    .product-card img {
        object-fit: cover; /* Ensures image maintains aspect ratio and covers the available space */
        width: 100%; /* Ensures the image takes up the full width of the card */
        height: 200px; /* Set a fixed height for the image */
    }

    /* Adjust card size and layout for 3-column view */
    .product-card-container {
        margin-top: 30px;
        margin-bottom: 30px;
    }
</style>

<div class="container product-container">
    <h2 class="text-center">Latest Products</h2>

    <div class="row product-card-container">
        <?php
        // Check if we have results
        if ($result->num_rows > 0) {
            // Loop through each product and display details
            while ($row = $result->fetch_assoc()) {
                $productId = $row['id'];  // Product ID
                $creatorId = $row['creatorid'];  // Creator ID
                $tag = $row['tag'];  // Tag
                $description = $row['detail'];  // Description
                $price = $row['price'];  // Price
                $created = $row['created'];  // Date created

                // Format the date if needed (for example, converting it to a more readable format)
                $formattedDate = date("F j, Y", strtotime($created));

                // Set image folder path dynamically for the product ID
                $imageFolder = "images/products/$productId/";

                // Get all image files in the folder (including jpg, jpeg, png, gif, and webp)
                $images = glob($imageFolder . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);  // Supports jpg, jpeg, png, gif, webp

                // Default image if no images are found
                if (empty($images)) {
                    $imageSrc = "images/products/default-image_450.png"; // Default image
                } else {
                    $imageSrc = $images[0];  // Use the first image if available
                }

                // Display the product details along with the image
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <div class="card-body">
                            <a href="product.php?prodid=' . $productId . '">
                                <h5 class="card-title">' . $tag . '</h5>
                            </a>
                            <img class="d-block w-100" src="' . $imageSrc . '" alt="Product Image">
                            <p class="card-text">' . $description . '</p>
                            <span class="product-date">Posted on: ' . $formattedDate . '</span><br>
                            <span class="product-price">$' . number_format($price, 2) . '</span>
                        </div>
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
