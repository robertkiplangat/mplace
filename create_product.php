<?php
include 'global.php';
include 'db_conn.php';
include 'header.php';
if (isset($_FILES['file']['name']) && isset($_POST['tag']) && isset($_POST['detail'])) {
    if (!empty($_FILES['file']['name']) && isset($_POST['tag']) && isset($_POST['detail'])) {
        // move_uploaded_file($_FILES['file']['tmp_name'], './images/delete/' . $_FILES['file']['name']);


        // echo "File Name: " . $_FILES['file']['name'] . "<br>";

        // Display the tag
        // echo "Tag: " . $_POST['tag'] . "<br>";

        // Display the detail
        // echo "Detail: " . $_POST['detail'] . "<br>";
        $creatorid = 1;
        $tag = $_POST['tag'];
        $detail = $_POST['detail'];

        // SQL Query (following the provided format)
        $sql = "INSERT INTO `products` (`id`, `creatorid`, `tag`, `detail`) 
                    VALUES (NULL, '$creatorid', '$tag', '$detail')";
        $result = $conn->query($sql);
        $last_inserted_id = $conn->insert_id;
        // echo $last_inserted_id;
        mkdir('./images/products/' . $conn->insert_id, 0777, true);
        move_uploaded_file($_FILES['file']['tmp_name'], './images/products/' . $conn->insert_id . '/' . $_FILES['file']['name']);
        echo '<div class="notification success"><strong>Success!</strong> Product created successfully.</div><style>.notification { padding: 20px; margin: 20px; border-radius: 5px; font-family: Arial, sans-serif; color: #fff; text-align: center; display: inline-block; } .success { background-color: #4CAF50; border: 1px solid #45a049; } .notification strong { font-weight: bold; } .notification { animation: fadeOut 3s forwards; } @keyframes fadeOut { 0% { opacity: 1; } 100% { opacity: 0; display: none; } }</style>';

    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo 'Please choose a file';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Create Product</h3>
                    <form action="create_product.php" method="post" enctype="multipart/form-data">
                        <!-- File Upload Field -->
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose File</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <!-- Tag Field -->
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag</label>
                            <input type="text" name="tag" id="tag" class="form-control" placeholder="Enter product tag">
                        </div>

                        <!-- Detail Field -->
                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea name="detail" id="detail" class="form-control" rows="4" placeholder="Enter product details"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS link (optional, for better UI behavior) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'footer.php'; ?>