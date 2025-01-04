<?php
require_once("/home/rmatharu2/data/connect.php");
require_once("includes/validation.php");
require_once("includes/pagination.php");

$title = "Search Matches: Man United Season Tracker";

$search = $_GET['search'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$venue = $_GET['venue'] ?? '';
$formation = $_GET['formation'] ?? '';

$per_page = 20;
$params = [];
$types = "";
$where_clauses = ["1=1"];

if ($search) {
    $where_clauses[] = "(opponent LIKE ? OR match_description LIKE ?)";
    $search_param = "%$search%";
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "ss";
}

if ($date_from) {
    $where_clauses[] = "match_date >= ?";
    $params[] = $date_from;
    $types .= "s";
}

if ($date_to) {
    $where_clauses[] = "match_date <= ?";
    $params[] = $date_to;
    $types .= "s";
}

if ($venue) {
    $where_clauses[] = "venue = ?";
    $params[] = $venue;
    $types .= "s";
}

if ($formation) {
    $where_clauses[] = "formation = ?";
    $params[] = $formation;
    $types .= "s";
}

$where_clause = implode(" AND ", $where_clauses);
$sql = "SELECT COUNT(*) FROM matches WHERE " . $where_clause;

$stmt = $connection->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$total_count = $stmt->get_result()->fetch_row()[0];

$pagination = set_pagination($total_count, $per_page);

$sql = "SELECT * FROM matches WHERE " . $where_clause . " ORDER BY match_date DESC LIMIT ? OFFSET ?";
$params[] = $per_page;
$params[] = $pagination['offset'];
$types .= "ii";

$stmt = $connection->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$results = $stmt->get_result();

include('includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-lg-8">
            <h2 class="display-4 mb-4">Search Matches</h2>

            <form method="get" class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control"
                            value="<?php echo sanitize_output($search); ?>"
                            placeholder="Search opponents or match descriptions...">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">From Date</label>
                            <input type="date" name="date_from" class="form-control" value="<?php echo $date_from; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">To Date</label>
                            <input type="date" name="date_to" class="form-control" value="<?php echo $date_to; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control"
                                value="<?php echo sanitize_output($venue); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Formation</label>
                            <input type="text" name="formation" class="form-control"
                                value="<?php echo sanitize_output($formation); ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger">Search</button>
                    <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/search.php"
                        class="btn btn-outline-secondary">Clear</a>
                </div>
            </form>

            <?php if (isset($_GET['search']) || isset($_GET['date_from']) || isset($_GET['date_to']) || isset($_GET['venue']) || isset($_GET['formation'])): ?>
                <h3 class="h4 mb-4">Search Results (<?php echo $total_count; ?>)</h3>

                <?php if ($results->num_rows > 0): ?>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php while ($match = $results->fetch_assoc()): ?>
                            <div class="col">
                                <div class="card h-100">
                                    <?php
                                    $image_path = 'uploads/images/thumbs/' . $match['match_image'];
                                    if (!empty($match['match_image']) && file_exists($image_path)):
                                        ?>
                                        <img src="<?php echo $image_path; ?>" class="card-img-top"
                                            style="height: 200px; object-fit: cover;" alt="Match thumbnail">
                                    <?php else: ?>
                                        <div class="card-img-top bg-light d-flex flex-column align-items-center justify-content-center"
                                            style="height: 200px;">
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
                                            <?php echo $match['score_united'] . ' - ' . $match['score_opponent']; ?><br>
                                            <strong>Venue:</strong> <?php echo sanitize_output($match['venue']); ?><br>
                                            <strong>Formation:</strong> <?php echo sanitize_output($match['formation']); ?>
                                        </p>
                                        <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/view.php?id=<?php echo $match['match_id']; ?>"
                                            class="btn btn-outline-danger">View Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php echo render_pagination($pagination, 'search.php', $_GET); ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>No matches found.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
include('includes/footer.php');
db_disconnect($connection);
?>