<?php include 'global.php';
session_destroy();
header('Location: ' . $prev_page);
