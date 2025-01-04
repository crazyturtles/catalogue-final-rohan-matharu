<?php
require_once("/home/rmatharu2/data/connect.php");
require_once("includes/validation.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/prepared.php");
require_once("includes/formation.php");
require_once("includes/substitutes.php");

$title = "Match Details: Man United Season Tracker";

// Validate the match ID from URL parameters
$match_id = $_GET['id'] ?? '';
if (!validate_id($match_id)) {
    header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/browse.php");
    exit();
}

// Fetch match details from database
$match = get_match($connection, $match_id);
if (!$match) {
    header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/browse.php");
    exit();
}

include('includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-lg-10">
            <div class="card">
                <?php
                // Check for existence of the full-size match image
                $image_path = 'uploads/images/full/' . $match['match_image'];
                if (!empty($match['match_image']) && file_exists($image_path)):
                    ?>
                    <img src="<?php echo $image_path; ?>" class="card-img-top" style="max-height: 500px; object-fit: cover;"
                        alt="Match image from <?php echo sanitize_output($match['opponent']); ?> game">
                <?php else: ?>
                    <!-- Placeholder for missing match image -->
                    <div class="card-img-top bg-light d-flex flex-column align-items-center justify-content-center py-5">
                        <i class="bi bi-camera text-secondary mb-3" style="font-size: 3rem;"></i>
                        <p class="text-secondary h5 mb-0">No match image available</p>
                        <p class="text-secondary small">Manchester United vs
                            <?php echo sanitize_output($match['opponent']); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <h2 class="card-title">Manchester United vs <?php echo sanitize_output($match['opponent']); ?></h2>
                    <h3 class="h5 text-muted mb-4"><?php echo date('F j, Y', strtotime($match['match_date'])); ?></h3>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Match Details</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <strong>Score:</strong>
                                    <span
                                        class="ms-2 <?php echo $match['score_united'] > $match['score_opponent'] ? 'text-success' : ($match['score_united'] < $match['score_opponent'] ? 'text-danger' : ''); ?>">
                                        <?php echo $match['score_united'] . ' - ' . $match['score_opponent']; ?>
                                    </span>
                                </li>
                                <li class="mb-2"><strong>Venue:</strong> <?php echo sanitize_output($match['venue']); ?>
                                </li>
                                <li><strong>Formation:</strong> <?php echo sanitize_output($match['formation']); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Match Stats</h4>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <td>Possession:</td>
                                        <td><?php echo $match['possession']; ?>%</td>
                                    </tr>
                                    <tr>
                                        <td>Shots (On Target):</td>
                                        <td><?php echo $match['shots'] . ' (' . $match['shots_on_target'] . ')'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Passes (Accuracy):</td>
                                        <td><?php echo $match['passes'] . ' (' . $match['pass_accuracy'] . '%)'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cards:</td>
                                        <td>
                                            <span class="text-warning"><?php echo $match['yellow_cards']; ?>
                                                yellow</span>,
                                            <span class="text-danger"><?php echo $match['red_cards']; ?> red</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Corners:</td>
                                        <td><?php echo $match['corners']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Offsides:</td>
                                        <td><?php echo $match['offsides']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fouls:</td>
                                        <td><?php echo $match['fouls']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4>Match Description</h4>
                        <p class="mb-0"><?php echo nl2br(sanitize_output($match['match_description'])); ?></p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Formation</h4>
                            <?php echo render_formation($match['lineup_json']); ?>
                        </div>
                        <div class="col-md-6">
                            <h4>Substitutes</h4>
                            <?php echo render_substitutes($match['subs_json']); ?>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/browse.php"
                            class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left me-2"></i>Back to Browse
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include('includes/footer.php');
db_disconnect($connection);
?>