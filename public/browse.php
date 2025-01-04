<?php
require_once("/home/rmatharu2/data/connect.php");
require_once("includes/pagination.php");
require_once("includes/validation.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/prepared.php");

$title = "Browse Matches: Man United Season Tracker";
$per_page = 6;
$total_count = count_matches($connection);
$pagination = set_pagination($total_count, $per_page);
$matches = find_matches($connection, $per_page, $pagination['offset']);

include('includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-lg-10">
            <h2 class="display-4 mb-4">Match History</h2>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php while ($match = $matches->fetch_assoc()): ?>
                    <div class="col">
                        <div class="card h-100">
                            <?php
                            $image_path = 'uploads/images/thumbs/' . $match['match_image'];
                            if (!empty($match['match_image']) && file_exists($image_path)): ?>
                                <div style="height: 250px; overflow: hidden;">
                                    <img src="<?php echo $image_path; ?>" class="card-img-top w-100 h-100"
                                        style="object-fit: contain;" alt="Match thumbnail">
                                </div>
                            <?php else: ?>
                                <div class="card-img-top bg-light d-flex flex-column align-items-center justify-content-center"
                                    style="height: 250px;">
                                    <i class="bi bi-image text-secondary mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-secondary mb-0">No match image</p>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title">Man United vs <?php echo sanitize_output($match['opponent']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <?php echo date('F j, Y', strtotime($match['match_date'])); ?>
                                </h6>
                                <p class="card-text">
                                    <strong>Score:</strong>
                                    <span
                                        class="ms-2 <?php echo $match['score_united'] > $match['score_opponent'] ? 'text-success' : ($match['score_united'] < $match['score_opponent'] ? 'text-danger' : ''); ?>">
                                        <?php echo $match['score_united'] . ' - ' . $match['score_opponent']; ?>
                                    </span>
                                    <br>
                                    <strong>Venue:</strong> <?php echo sanitize_output($match['venue']); ?><br>
                                    <strong>Formation:</strong> <?php echo sanitize_output($match['formation']); ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/view.php?id=<?php echo $match['match_id']; ?>"
                                        class="btn btn-outline-danger">View Details</a>
                                    <small class="text-muted">
                                        <?php echo $match['possession']; ?>% Possession
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php if ($matches->num_rows === 0): ?>
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>No matches found.
                </div>
            <?php endif; ?>

            <?php echo render_pagination($pagination, 'browse.php'); ?>
        </div>
    </section>
</main>

<?php
include('includes/footer.php');
db_disconnect($connection);
?>