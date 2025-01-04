<?php
session_start();
require_once("/home/rmatharu2/data/connect.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/authentication.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and password are required.";
        header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/login.php");
        exit();
    }

    $auth = new Authentication($connection);
    if ($auth->login($username, $password)) {
        $_SESSION['admin_id'] = $auth->getCurrentUser()['admin_id'];
        $_SESSION['username'] = $auth->getCurrentUser()['username'];
        header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/login.php");
        exit();
    }
} else {
    header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/login.php");
    exit();
}
?>