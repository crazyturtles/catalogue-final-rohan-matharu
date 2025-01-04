<?php
require_once("/home/rmatharu2/data/connect.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/authentication.php");

session_start();
session_destroy();
header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/login.php");
exit();
?>