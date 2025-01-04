<?php
require_once("/home/rmatharu2/data/connect.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/authentication.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/validation.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/pagination.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/prepared.php");

session_start();

$title = "Admin Dashboard: Man United Season Tracker";
$auth = new Authentication($connection);
$auth->requireLogin();

$per_page = 20;
$total_count = count_records($connection);
$pagination = set_pagination($total_count, $per_page);
$records = find_records($connection, $per_page, $pagination['offset']);

include('/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="display-4">Admin Dashboard</h2>
                <div>
                    <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/add.php"
                        class="btn btn-danger">Add New Match</a>
                    <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/logout.php"
                        class="btn btn-outline-danger ms-2">Logout</a>
                </div>
            </div>

            <?php if ($records && $records->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Date</th>
                                <th>Opponent</th>
                                <th>Score</th>
                                <th>Added By</th>
                                <th>Last Edited</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($match = $records->fetch_assoc()): ?>
                                <tr>
                                    <td style="width: 100px">
                                        <?php
                                        $thumb_path = '../../public/uploads/images/thumbs/' . $match['match_image'];
                                        $full_path = '../../public/uploads/images/full/' . $match['match_image'];
                                        if (!empty($match['match_image']) && file_exists($thumb_path)):
                                            ?>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#imageModal<?php echo $match['match_id']; ?>">
                                                <img src="<?php echo $thumb_path; ?>" class="img-thumbnail"
                                                    style="width: 80px; height: 60px; object-fit: cover;" alt="Match thumbnail">
                                            </a>

                                            <!-- Image Modal -->
                                            <div class="modal fade" id="imageModal<?php echo $match['match_id']; ?>" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Match vs
                                                                <?php echo htmlspecialchars($match['opponent']); ?>
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="<?php echo $full_path; ?>" class="img-fluid"
                                                                alt="Full size match image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 60px;">
                                                <i class="bi bi-image text-secondary" style="font-size: 1.5rem;"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($match['match_date']))); ?></td>
                                    <td><?php echo htmlspecialchars($match['opponent']); ?></td>
                                    <td><?php echo htmlspecialchars($match['score_united'] . ' - ' . $match['score_opponent']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($match['added_by']); ?></td>
                                    <td><?php echo $match['date_edited'] ? htmlspecialchars(date('Y-m-d H:i', strtotime($match['date_edited']))) : 'Never'; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/edit.php?id=<?php echo $match['match_id']; ?>"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/delete.php?id=<?php echo $match['match_id']; ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this match?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo render_pagination($pagination, 'admin.php'); ?>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>No matches found.
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
include('/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/footer.php');
db_disconnect($connection);
?>