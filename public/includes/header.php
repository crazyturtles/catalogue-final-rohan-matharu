<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once("/home/rmatharu2/data/connect.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/authentication.php");
$auth = new Authentication($connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .formation-pitch {
            border: 1px solid #ccc;
            margin: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                <a class="navbar-brand"
                    href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/index.php">
                    <img src="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/images/mufc-badge.png"
                        alt="Manchester United Badge" width="48" height="48" class="me-2">
                    Man United Tracker
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/browse.php">Browse
                                Matches</a>
                        </li>
                    </ul>
                    <?php if ($auth->isLoggedIn()): ?>
                        <div class="d-flex">
                            <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php"
                                class="btn btn-outline-light me-2">Admin Panel</a>
                            <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/logout.php"
                                class="btn btn-outline-light">Logout</a>
                        </div>
                    <?php else: ?>
                        <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/login.php"
                            class="btn btn-outline-light">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>