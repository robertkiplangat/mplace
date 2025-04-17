<?php
<<<<<<< HEAD
=======
// Hide errors in production
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

>>>>>>> 21eb294 (Final commit)
include 'global.php';
include 'db_conn.php';
include 'header.php';

<<<<<<< HEAD
// Replacing the posts query with the products query
$result = $conn->query("SELECT `id`, `creatorid`, `tag`, `detail`, `price`, `created` FROM `products` WHERE 1");

?>

<!-- Add a container div to center the content -->
<div class="container d-flex justify-content-center flex-wrap">
  <?php
  while ($row = $result->fetch_assoc()) {
    $productId = $row['id'];  // Product ID

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

    // Other fields
    $tag = $row['tag']; // Using the 'tag' field from 'products'
    $creatorid = $row['creatorid']; // Using the 'creatorid' field
    $description = $row['detail']; // Using the 'detail' field for description
    $price = $row['price']; // Using the 'price' field for the product price
    $created = $row['created']; // Using the 'created' field for the creation date
    $message = "#"; // Placeholder for message link (update if you need a dynamic link)

    // Now we echo the card HTML with the dynamic variables
    echo '
    <div class="card" style="width:400px; margin: 10px;">
      <img class="card-img-top" src="' . $imageSrc . '" alt="Card image" style="width:100%">
      <div class="card-body">
        <h4 class="card-title">' . $tag . '</h4>
        <p class="card-text">' . $description . '</p>
        <p class="card-text"><strong>Price: $' . $price . '</strong></p>
        <p class="card-text"><small>Created on: ' . $created . '</small></p>
        <!-- Message button triggers the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal" onclick="setRecipient(' . $creatorid . ')">Message</button>
        <span class="ms-2">Creator ID: ' . $creatorid . '</span>
      </div>
    </div>
    ';
  }
  ?>
</div>

<!-- Modal for Message Form -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Send a Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="send_message.php" method="POST">
          <div class="mb-3">
            <label for="messageContent" class="form-label">Message</label>
            <textarea class="form-control" id="messageContent" name="messageContent" rows="3" required></textarea>
          </div>
          <input type="hidden" id="recipientid" name="recipientid" value="">
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>
=======
// Get product ID or fallback to 14
$productId = isset($_GET['id']) ? intval($_GET['id']) : 14;

// Fetch product
$stmt = $conn->prepare("SELECT `id`, `creatorid`, `tag`, `detail`, `price`, `created` FROM `products` WHERE `id` = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<div class="container mt-5"><div class="alert alert-danger">Product not found</div></div>';
    include 'footer.php';
    exit();
}

$row = $result->fetch_assoc();

// Image handling
$imageFolder = "images/products/{$row['id']}/";
$images = glob($imageFolder . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
$imageSrc = empty($images) ? "images/products/default-image_450.png" : $images[0];
?>

<style>
    :root {
        --usiu-blue: #003366;
        --usiu-gold: #FFCC00;
        --usiu-light-blue: #0066CC;
        --usiu-dark: #001A33;
    }

    .usiu-bg-primary { background-color: var(--usiu-blue) !important; }
    .usiu-text-primary { color: var(--usiu-blue) !important; }
    .usiu-bg-secondary { background-color: var(--usiu-gold) !important; }
    .usiu-text-secondary { color: var(--usiu-gold) !important; }

    .btn-usiu-primary {
        background-color: var(--usiu-blue);
        color: white;
        border-color: var(--usiu-blue);
    }

    .btn-usiu-primary:hover {
        background-color: var(--usiu-dark);
        border-color: var(--usiu-dark);
    }

    .btn-usiu-secondary {
        background-color: var(--usiu-gold);
        color: var(--usiu-blue);
        border-color: var(--usiu-gold);
    }

    .btn-usiu-secondary:hover {
        background-color: #E6B800;
        border-color: #E6B800;
    }

    .card {
        border: 1px solid var(--usiu-blue);
        box-shadow: 0 4px 8px rgba(0, 51, 102, 0.1);
    }

    .card-header, .modal-header {
        background-color: var(--usiu-blue);
        color: white;
    }
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">USIU-Africa Marketplace</h3>
                </div>
                <img src="<?php echo htmlspecialchars($imageSrc); ?>" class="card-img-top p-3" alt="<?php echo htmlspecialchars($row['tag']); ?>">
                <div class="card-body">
                    <h2 class="card-title usiu-text-primary"><?php echo htmlspecialchars($row['tag']); ?></h2>
                    <div class="usiu-bg-secondary p-2 mb-3 rounded">
                        <p class="card-text mb-0"><?php echo nl2br(htmlspecialchars($row['detail'])); ?></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="usiu-text-primary mb-0">Price: $<?php echo number_format($row['price'], 2); ?></h4>
                        <small class="text-muted">Posted: <?php echo htmlspecialchars($row['created']); ?></small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-usiu-primary" data-bs-toggle="modal" data-bs-target="#messageModal" onclick="setRecipient(<?php echo $row['creatorid']; ?>)">
                            <i class="fas fa-envelope"></i> Contact Seller
                        </button>
                        <span class="badge usiu-bg-secondary text-dark p-2">Seller ID: <?php echo htmlspecialchars($row['creatorid']); ?></span>
                    </div>
                </div>
                <div class="card-footer text-center usiu-bg-primary text-white">
                    USIU-Africa Marketplace © <?php echo date('Y'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel"><i class="fas fa-comment-alt"></i> Send Message to Seller</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="send_message.php" method="POST">
                    <div class="mb-3">
                        <label for="messageContent" class="form-label">Your Message</label>
                        <textarea class="form-control" id="messageContent" name="messageContent" rows="4" required></textarea>
                    </div>
                    <input type="hidden" id="recipientid" name="recipientid" value="">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-usiu-primary">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
>>>>>>> 21eb294 (Final commit)
</div>

<?php include 'footer.php'; ?>

<script>
<<<<<<< HEAD
  // Function to set the recipient ID dynamically when the "Message" button is clicked
  function setRecipient(creatorid) {
    // Set the recipient ID field in the form
    document.getElementById('recipientid').value = creatorid;
  }
=======
function setRecipient(creatorid) {
    document.getElementById('recipientid').value = creatorid;
}
>>>>>>> 21eb294 (Final commit)
</script>
