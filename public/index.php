<?php
require_once("/home/rmatharu2/data/connect.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/prepared.php");
require_once("includes/validation.php");
require_once("includes/formation.php");

$title = "Home: Man United Season Tracker";

$latest_match = find_matches($connection, 1)->fetch_assoc();
include('includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-lg-10">
            <h1 class="display-4 mb-4">Manchester United Season Tracker</h1>

            <?php if ($latest_match): ?>
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title mb-0">Latest Match</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                $image_path = 'uploads/images/thumbs/' . $latest_match['match_image'];
                                if (!empty($latest_match['match_image']) && file_exists($image_path)):
                                    ?>
                                    <img src="<?php echo $image_path; ?>" class="img-fluid rounded"
                                        style="height: 250px; width: 100%; object-fit: cover;" alt="Latest match thumbnail">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center p-4"
                                        style="height: 250px;">
                                        <i class="bi bi-camera text-secondary mb-3" style="font-size: 2.5rem;"></i>
                                        <p class="text-secondary mb-1">No match image</p>
                                        <small class="text-muted">vs
                                            <?php echo sanitize_output($latest_match['opponent']); ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-8">
                                <h4>Manchester United vs <?php echo sanitize_output($latest_match['opponent']); ?></h4>
                                <h5 class="text-muted"><?php echo date('F j, Y', strtotime($latest_match['match_date'])); ?>
                                </h5>
                                <p class="mb-2">
                                    <strong>Score:</strong>
                                    <span
                                        class="ms-2 <?php echo $latest_match['score_united'] > $latest_match['score_opponent'] ? 'text-success' : ($latest_match['score_united'] < $latest_match['score_opponent'] ? 'text-danger' : ''); ?>">
                                        <?php echo $latest_match['score_united'] . ' - ' . $latest_match['score_opponent']; ?>
                                    </span>
                                </p>
                                <p class="mb-2">
                                    <strong>Venue:</strong> <?php echo sanitize_output($latest_match['venue']); ?>
                                </p>
                                <p><?php echo substr(sanitize_output($latest_match['match_description']), 0, 200) . '...'; ?>
                                </p>
                                <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/view.php?id=<?php echo $latest_match['match_id']; ?>"
                                    class="btn btn-outline-danger">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h3 class="card-title h5 mb-0">Quick Stats</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Possession:</strong>
                                        <?php echo $latest_match['possession']; ?>%</li>
                                    <li class="mb-2"><strong>Shots:</strong> <?php echo $latest_match['shots']; ?>
                                        (<?php echo $latest_match['shots_on_target']; ?> on target)</li>
                                    <li class="mb-0"><strong>Pass Accuracy:</strong>
                                        <?php echo $latest_match['pass_accuracy']; ?>%</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h3 class="card-title h5 mb-0">Formation</h3>
                            </div>
                            <div class="card-body">
                                <p>Playing <?php echo sanitize_output($latest_match['formation']); ?></p>
                                <?php echo render_formation($latest_match['lineup_json']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>No matches found.
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
include('includes/footer.php');
db_disconnect($connection);
?>