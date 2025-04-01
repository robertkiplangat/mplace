<?php

if (loggedin()) {
    die();
} else {
    if (isset($_POST['emailR']) && isset($_POST['usernameR']) && isset($_POST['passwordR'])) {
        $emailR = $_POST['emailR'];
        $usernameR = $_POST['usernameR'];
        $passpasswordR = md5($_POST['passwordR']);
        if (!empty($_POST['emailR']) && !empty($_POST['usernameR']) && !empty($_POST['passwordR'])) {
            $sql = "SELECT email FROM `users` WHERE email = '$emailR'";;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        E - mail exists!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            } else {
                $sql = "INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES (NULL, '$emailR', '$usernameR', '$passpasswordR')";;
                $result = $conn->query($sql);
                echo '<script type="text/javascript">
                window.onload = function() {
                    alert("Registration Successful!");
                };
              </script>';
            }
            $conn->close(); // closed on ALL connections it is called
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        Please fill all  the fields!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
}
