<?php
include 'global.php';
include 'db_conn.php';
include 'header.php';
if (isset($_GET['prodid'])) {
  $prodid = $_GET['prodid'];
  $result = $conn->query("SELECT `id`, `tags`, `detail`, `pic`, `created`, `posterid` FROM `posts` WHERE `id`='$prodid'");
  
}
?>

<?php
while ($row = $result->fetch_assoc()) {
  $imageSrc = "images\site\default-image_450.png";
  $tag = $row['tags']; // to be repalced  with names
  $name = $row['posterid']; // to be repalced  with names
  $description = $row['detail']; // Dynamic description
  $message = "#"; // Dynamic link

  // Now we echo the card HTML with the dynamic variables
  echo '
<div class="card" style="width:400px">
  <img class="card-img-top" src="' . $imageSrc . '" alt="Card image" style="width:100%">
  <div class="card-body">
    <h4 class="card-title">' . $tag . '</h4>
    <p class="card-text">' . $description . '</p>
    <a href="' . $message . '" class="btn btn-primary">Message</a>
    <span class="ms-2">Posted by: ' . $name . '</span>
  </div>
</div>
<br>';
}
?>
<?php include 'footer.php'; ?>