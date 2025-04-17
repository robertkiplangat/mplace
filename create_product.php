<?php
include 'global.php';
include 'db_conn.php';
include 'header.php';

if (isset($_FILES['file']['name']) && isset($_POST['tag']) && isset($_POST['detail']) && isset($_POST['price'])) {
    if (!empty($_FILES['file']['name']) && isset($_POST['tag']) && isset($_POST['detail']) && isset($_POST['price'])) {
        
<<<<<<< HEAD
        // Set the creator ID
        $creatorid = $_SESSION['user_id'];

        // Get form data
        $tag = $_POST['tag'];
        $detail = $_POST['detail'];
        $price = $_POST['price']; // Get price from form

        // Validate price (ensure it's a number and not empty)
        if (!is_numeric($price) || $price <= 0) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Invalid price entered.</div>';
        } else {
            // SQL Query to insert product details (without 'created' as it's auto-generated)
=======
        $creatorid = $_SESSION['user_id'];
        $tag = $_POST['tag'];
        $detail = $_POST['detail'];
        $price = $_POST['price'];

        if (!is_numeric($price) || $price <= 0) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Invalid price entered.</div>';
        } else {
>>>>>>> 21eb294 (Final commit)
            $sql = "INSERT INTO `products` (`id`, `creatorid`, `tag`, `detail`, `price`) 
                    VALUES (NULL, '$creatorid', '$tag', '$detail', '$price')";
            $result = $conn->query($sql);

<<<<<<< HEAD
            // Check if the insert was successful
=======
>>>>>>> 21eb294 (Final commit)
            if ($result) {
                $last_inserted_id = $conn->insert_id;
                mkdir('./images/products/' . $last_inserted_id, 0777, true);
                move_uploaded_file($_FILES['file']['tmp_name'], './images/products/' . $last_inserted_id . '/' . $_FILES['file']['name']);
<<<<<<< HEAD
                
                echo '<div class="notification success"><strong>Success!</strong> Product created successfully.</div><style>.notification { padding: 20px; margin: 20px; border-radius: 5px; font-family: Arial, sans-serif; color: #fff; text-align: center; display: inline-block; } .success { background-color: #4CAF50; border: 1px solid #45a049; } .notification strong { font-weight: bold; } .notification { animation: fadeOut 3s forwards; } @keyframes fadeOut { 0% { opacity: 1; } 100% { opacity: 0; display: none; } }</style>';
=======

                echo '<div class="notification success"><strong>Success!</strong> Product created successfully.</div><style>
                    .notification { padding: 20px; margin: 20px; border-radius: 5px; font-family: Arial, sans-serif; color: #fff; text-align: center; display: inline-block; }
                    .success { background-color: #00274D; border: 1px solid #001933; }
                    .notification strong { font-weight: bold; }
                    .notification { animation: fadeOut 3s forwards; }
                    @keyframes fadeOut { 0% { opacity: 1; } 100% { opacity: 0; display: none; } }
                </style>';
>>>>>>> 21eb294 (Final commit)
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">There was an error creating the product.</div>';
            }
        }
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Please fill in all fields and choose a file.</div>';
    }
}
?>

<<<<<<< HEAD
=======
<!-- USIU Style with Yellow -->
<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        color: #00274D;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #FFD700;
        border-color: #FFD700;
        font-weight: bold;
        color: #00274D;
    }

    .btn-primary:hover {
        background-color: #e6c200;
        border-color: #e6c200;
        color: #00274D;
    }

    label {
        color: #00274D;
        font-weight: 500;
    }

    .form-control:focus {
        border-color: #FFD700;
        box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    }
</style>

>>>>>>> 21eb294 (Final commit)
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Create Product</h3>
                    <form action="create_product.php" method="post" enctype="multipart/form-data">
<<<<<<< HEAD
                        <!-- File Upload Field -->
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose File</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <!-- Tag Field -->
=======
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose File</label>
                            <input type="file" name="file" id="file" class="form-control" required>
                        </div>

>>>>>>> 21eb294 (Final commit)
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag</label>
                            <input type="text" name="tag" id="tag" class="form-control" placeholder="Enter product tag" required>
                        </div>

<<<<<<< HEAD
                        <!-- Detail Field -->
=======
>>>>>>> 21eb294 (Final commit)
                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea name="detail" id="detail" class="form-control" rows="4" placeholder="Enter product details" required></textarea>
                        </div>

<<<<<<< HEAD
                        <!-- Price Field -->
=======
>>>>>>> 21eb294 (Final commit)
                        <div class="mb-3">
                            <label for="price" class="form-label">Price in Ksh. /=</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Enter product price" required step="0.01">
                        </div>

<<<<<<< HEAD
                        <!-- Submit Button -->
=======
>>>>>>> 21eb294 (Final commit)
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD
<!-- Bootstrap 5 JS link (optional, for better UI behavior) -->
=======
>>>>>>> 21eb294 (Final commit)
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'footer.php'; ?>
