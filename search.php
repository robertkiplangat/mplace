<?php
<<<<<<< HEAD
include 'global.php';  // Include any global configurations or variables
include 'db_conn.php';  // Include your database connection
include 'header.php';  // Include your header

// Fetch all products from the 'products' table
$result = $conn->query("SELECT `id`, `creatorid`, `tag`, `detail`, `price`, `created` FROM `products` WHERE 1");

// Check if query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}
=======
include 'global.php';
include 'db_conn.php';
include 'header.php';

// Get search keyword if provided
$search_keyword = trim($_GET['q'] ?? '');

// Handle sorting options
$sort_option = $_GET['sort'] ?? '';
$order_by = 'ORDER BY created DESC'; // default sorting

switch ($sort_option) {
    case 'name_asc':
        $order_by = 'ORDER BY tag ASC';
        break;
    case 'name_desc':
        $order_by = 'ORDER BY tag DESC';
        break;
    case 'price_asc':
        $order_by = 'ORDER BY price ASC';
        break;
    case 'price_desc':
        $order_by = 'ORDER BY price DESC';
        break;
    case 'date_new':
        $order_by = 'ORDER BY created DESC';
        break;
}

// Build query based on search
$where_clause = "WHERE 1";
$params = [];
$types = "";

if (!empty($search_keyword)) {
    $where_clause .= " AND (tag LIKE ? OR detail LIKE ?)";
    $search_term = '%' . $search_keyword . '%';
    $params[] = $search_term;
    $params[] = $search_term;
    $types = "ss";
}

$query = "SELECT `id`, `creatorid`, `tag`, `detail`, `price`, `created` FROM `products` $where_clause $order_by";

$stmt = $conn->prepare($query);

// Bind parameters if searching
if (!empty($search_keyword)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
>>>>>>> 21eb294 (Final commit)
?>

<!-- Include Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<<<<<<< HEAD
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
=======
<!-- Custom Styling -->
<style>
    body {
        background-color: #f4f4f4;
        color: #333;
    }
    .product-container {
        margin-top: 30px;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        color: #F9A800;
    }
    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .product-card img {
        object-fit: cover;
        width: 100%;
        height: 200px;
        border-radius: 10px 10px 0 0;
    }
    .product-card-body {
        padding: 20px;
    }
    .product-card-title {
        font-weight: bold;
        color: #333;
    }
    .product-card-text {
        font-size: 14px;
        color: #666;
    }
    .product-price {
        color: #F9A800;
        font-weight: bold;
    }
    .product-date {
        color: #999;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
>>>>>>> 21eb294 (Final commit)
    }
</style>

<div class="container product-container">
<<<<<<< HEAD
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
=======
    <h2 class="text-center mb-4">Latest Products</h2>

    <!-- Search & Sort -->
    <form method="GET" class="row g-3 mb-4 align-items-center">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search products..." value="<?= htmlspecialchars($search_keyword) ?>">
        </div>
        <div class="col-md-4">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="">Sort By</option>
                <option value="name_asc" <?= $sort_option == 'name_asc' ? 'selected' : '' ?>>Name (A-Z)</option>
                <option value="name_desc" <?= $sort_option == 'name_desc' ? 'selected' : '' ?>>Name (Z-A)</option>
                <option value="price_asc" <?= $sort_option == 'price_asc' ? 'selected' : '' ?>>Price (Low to High)</option>
                <option value="price_desc" <?= $sort_option == 'price_desc' ? 'selected' : '' ?>>Price (High to Low)</option>
                <option value="date_new" <?= $sort_option == 'date_new' ? 'selected' : '' ?>>Newest First</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-warning w-100">Search</button>
        </div>
    </form>

    <!-- Results -->
    <div class="row product-card-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['id'];
                $creatorId = $row['creatorid'];
                $tag = $row['tag'];
                $description = $row['detail'];
                $price = $row['price'];
                $created = $row['created'];

                $formattedDate = date("F j, Y", strtotime($created));
                $imageFolder = "images/products/$productId/";
                $images = glob($imageFolder . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
                $imageSrc = empty($images) ? "images/products/default-image_450.png" : $images[0];

                echo '
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <div class="card-body product-card-body">
                            <a href="product.php?prodid=' . $productId . '">
                                <h5 class="card-title product-card-title">' . htmlspecialchars($tag) . '</h5>
                            </a>
                            <img class="d-block w-100" src="' . $imageSrc . '" alt="Product Image">
                            <p class="card-text product-card-text">' . htmlspecialchars(substr($description, 0, 100)) . '...</p>
                            <span class="product-date">Posted on: ' . $formattedDate . '</span><br>
                            <span class="product-price">Ksh. ' . number_format($price, 2) . '</span>
>>>>>>> 21eb294 (Final commit)
                        </div>
                    </div>
                </div>';
            }
        } else {
<<<<<<< HEAD
            echo "<p>No products found.</p>";
=======
            echo "<p class='text-danger'>No products found for your search.</p>";
>>>>>>> 21eb294 (Final commit)
        }
        ?>
    </div>
</div>

<<<<<<< HEAD
<!-- Include Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php
include 'footer.php';  // Include your footer
?>
=======
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'footer.php'; ?>
>>>>>>> 21eb294 (Final commit)
