<?php
session_start();

require_once("/home/rmatharu2/data/connect.php");
require_once("includes/validation.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/authentication.php");

$title = "Admin Login: Man United Season Tracker";
$auth = new Authentication($connection);

if ($auth->isLoggedIn()) {
    header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php");
    exit();
}

$errors = [];
if (isset($_POST['submit'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $auth = new Authentication($connection);
    if ($auth->login($username, $password)) {
        header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php");
        exit();
    } else {
        $errors[] = "Login failed. Please check your username and password.";
    }
}

include('includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-md-6 col-lg-4">
            <h2 class="display-4 mb-4">Admin Login</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php echo implode('<br>', $errors); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="login.php" class="border rounded p-4">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" name="submit" class="btn btn-danger w-100">Login</button>
            </form>
        </div>
    </section>
</main>

<?php
include('includes/footer.php');
db_disconnect($connection);
?>