<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $result = $conn->query("SELECT id, email, username FROM users WHERE email='$email' AND password='$password'");
    if ($result->num_rows > 0) {
      session_start();
      $_SESSION['user_id'] = $result->fetch_assoc()['id'];
      header('Location: index.php');
    } else {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Incorrect username/password! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    }
    $conn->close(); // closed on ALL connections it is called
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Please fill in the fields! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
  }
}
