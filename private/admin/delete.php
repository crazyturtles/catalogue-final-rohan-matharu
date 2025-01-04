<?php

session_start();

require_once("/home/rmatharu2/data/connect.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/authentication.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/validation.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/prepared.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/image_processing.php");

$auth = new Authentication($connection);
$auth->requireLogin();

$match_id = $_GET['id'] ?? '';
if (!validate_id($match_id)) {
    header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php");
    exit();
}

$match = get_match($connection, $match_id);
if (!$match) {
    header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php");
    exit();
}

if (isset($_POST['confirm'])) {
    if (delete_match($connection, $match_id)) {
        delete_match_images($match['match_image']);
        header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php");
        exit();
    }
}

$title = "Delete Match: Man United Season Tracker";
include('/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="card-title mb-0">Confirm Delete</h4>
                </div>
                <div class="card-body">
                    <p>Are you sure you want to delete this match?</p>
                    <p><strong>Match:</strong> Manchester United vs <?php echo sanitize_output($match['opponent']); ?>
                    </p>
                    <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($match['match_date'])); ?></p>
                    <p><strong>Score:</strong> <?php echo $match['score_united'] . ' - ' . $match['score_opponent']; ?>
                    </p>

                    <form method="post">
                        <button type="submit" name="confirm" class="btn btn-danger">Delete Match</button>
                        <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php"
                            class="btn btn-outline-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include('/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/footer.php');
db_disconnect($connection);
?>