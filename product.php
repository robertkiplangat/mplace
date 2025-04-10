<?php
include 'global.php';
include 'db_conn.php';
include 'header.php';

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
</div>

<?php include 'footer.php'; ?>

<script>
  // Function to set the recipient ID dynamically when the "Message" button is clicked
  function setRecipient(creatorid) {
    // Set the recipient ID field in the form
    document.getElementById('recipientid').value = creatorid;
  }
</script>
