<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("/home/rmatharu2/data/connect.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/authentication.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/includes/validation.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/prepared.php");
require_once("/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/private/lib/image_processing.php");

$title = "Add Match: Man United Season Tracker";
$auth = new Authentication($connection);
$auth->requireLogin();

$errors = [];
$error_message = '';

if (isset($_POST['submit'])) {
    $numbers = $_POST['player_number'] ?? [];
    $names = $_POST['player_name'] ?? [];
    $formation = $_POST['custom_formation'] ?? '';

    $players = array_map(function ($number, $name) {
        return ['number' => $number, 'name' => $name];
    }, $numbers, $names);

    $lineup_json = json_encode([
        'formation' => $formation,
        'players' => $players
    ]);

    $match_data = [
        'match_date' => $_POST['match_date'] ?? '',
        'opponent' => $_POST['opponent'] ?? '',
        'venue' => $_POST['venue'] ?? '',
        'formation' => $_POST['formation'] ?? '',
        'score_united' => $_POST['score_united'] ?? '',
        'score_opponent' => $_POST['score_opponent'] ?? '',
        'possession' => $_POST['possession'] ?? '',
        'shots' => $_POST['shots'] ?? '',
        'shots_on_target' => $_POST['shots_on_target'] ?? '',
        'passes' => $_POST['passes'] ?? '',
        'pass_accuracy' => $_POST['pass_accuracy'] ?? '',
        'fouls' => $_POST['fouls'] ?? '',
        'yellow_cards' => $_POST['yellow_cards'] ?? '',
        'red_cards' => $_POST['red_cards'] ?? '',
        'corners' => $_POST['corners'] ?? '',
        'offsides' => $_POST['offsides'] ?? '',
        'lineup_json' => $lineup_json,
        'subs_json' => $_POST['subs_json'] ?? '',
        'match_description' => $_POST['match_description'] ?? ''
    ];

    if (!empty($_FILES['match_image']['name'])) {
        $image = $_FILES['match_image'];
        $image_path = process_image_upload($image, $error_message);
        if (!$image_path) {
            $errors[] = $error_message ?: "Failed to upload image. File must be JPG, PNG or WebP and under 2MB.";
        } else {
            $match_data['match_image'] = $image_path;
        }
    }

    if (empty($errors) && validate_match_data($match_data, $errors)) {
        $match_data['added_by'] = $_SESSION['username'];
        $match_data['date_added'] = date('Y-m-d H:i:s');

        $insert_result = insert_match($connection, $match_data);

        if ($insert_result) {
            header("Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php");
            exit();
        } else {
            $errors[] = "Failed to add match";
        }
    }
}

include('../../public/includes/header.php');
?>

<main class="container">
    <section class="row justify-content-center my-5">
        <div class="col-lg-8">
            <h2 class="display-4 mb-4">Add New Match</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert-container">
                    <?php foreach ($errors as $error): ?>
                        <div class="alert <?php echo strpos($error, 'Failed to upload image') !== false ? 'alert-warning' : 'alert-danger'; ?> alert-dismissible fade show"
                            role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" class="border rounded p-4">
                <div class="mb-3">
                    <label class="form-label">Match Image</label>
                    <input type="file" name="match_image" class="form-control" accept="image/*">
                    <small class="text-muted">Max file size: 2MB. Allowed formats: JPG, PNG, WebP</small>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Date</label>
                        <input type="date" name="match_date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Opponent</label>
                        <input type="text" name="opponent" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Venue</label>
                        <input type="text" name="venue" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Formation</label>
                        <input type="text" name="formation" class="form-control" required placeholder="e.g. 4-2-3-1">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">United Score</label>
                        <input type="number" name="score_united" class="form-control" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Opponent Score</label>
                        <input type="number" name="score_opponent" class="form-control" min="0">
                    </div>
                </div>

                <!-- Formation and Lineup Section -->
                <div class="mb-3">
                    <label class="form-label">Formation and Lineup</label>
                    <input type="text" name="custom_formation" class="form-control mb-3" value="4-4-2"
                        placeholder="Enter formation (e.g. 4-4-2)" pattern="\d+(-\d+)*" required>

                    <?php for ($i = 0; $i < 11; $i++): ?>
                        <div class="d-flex gap-2 mb-2">
                            <input type="number" name="player_number[]" class="form-control" style="width: 80px"
                                placeholder="#" min="1">
                            <input type="text" name="player_name[]" class="form-control"
                                placeholder="<?php echo $i === 0 ? 'Goalkeeper' : 'Player name'; ?>" required>
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Substitutes Section -->
                <div class="mb-3">
                    <label class="form-label">Substitutes</label>
                    <?php
                    $used_subs = [['number' => '', 'name' => '']];
                    $unused_subs = [['number' => '', 'name' => '']];
                    ?>

                    <div class="mb-4">
                        <h5 class="mb-3">Used Substitutes</h5>
                        <div id="used-subs-container">
                            <?php foreach ($used_subs as $index => $sub): ?>
                                <div class="d-flex gap-2 mb-2 used-sub-row">
                                    <input type="number" name="used_subs[<?php echo $index; ?>][number]"
                                        class="form-control" style="width: 80px" placeholder="#"
                                        value="<?php echo htmlspecialchars($sub['number']); ?>">
                                    <input type="text" name="used_subs[<?php echo $index; ?>][name]" class="form-control"
                                        placeholder="Player name" value="<?php echo htmlspecialchars($sub['name']); ?>">
                                    <?php if ($index > 0): ?>
                                        <button type="button" class="btn btn-outline-danger remove-sub">Remove</button>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="btn btn-outline-secondary mt-2" id="add-used-sub">
                            Add Used Substitute
                        </button>
                    </div>

                    <div>
                        <h5 class="mb-3">Unused Substitutes</h5>
                        <div id="unused-subs-container">
                            <?php foreach ($unused_subs as $index => $sub): ?>
                                <div class="d-flex gap-2 mb-2 unused-sub-row">
                                    <input type="number" name="unused_subs[<?php echo $index; ?>][number]"
                                        class="form-control" style="width: 80px" placeholder="#"
                                        value="<?php echo htmlspecialchars($sub['number']); ?>">
                                    <input type="text" name="unused_subs[<?php echo $index; ?>][name]" class="form-control"
                                        placeholder="Player name" value="<?php echo htmlspecialchars($sub['name']); ?>">
                                    <?php if ($index > 0): ?>
                                        <button type="button" class="btn btn-outline-danger remove-sub">Remove</button>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="btn btn-outline-secondary mt-2" id="add-unused-sub">
                            Add Unused Substitute
                        </button>
                    </div>

                    <input type="hidden" name="subs_json" id="subs-json">
                </div>

                <h4 class="mt-4">Match Statistics</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Possession (%)</label>
                        <input type="number" name="possession" class="form-control" required min="0" max="100"
                            step="0.1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Shots</label>
                        <input type="number" name="shots" class="form-control" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Shots on Target</label>
                        <input type="number" name="shots_on_target" class="form-control" min="0">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Passes</label>
                        <input type="number" name="passes" class="form-control" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pass Accuracy (%)</label>
                        <input type="number" name="pass_accuracy" class="form-control" required min="0" max="100"
                            step="0.1">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Fouls</label>
                        <input type="number" name="fouls" class="form-control" min="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Yellow Cards</label>
                        <input type="number" name="yellow_cards" class="form-control" min="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Red Cards</label>
                        <input type="number" name="red_cards" class="form-control" min="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Corners</label>
                        <input type="number" name="corners" class="form-control" min="0">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Offsides</label>
                    <input type="number" name="offsides" class="form-control" min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label">Match Description</label>
                    <textarea name="match_description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" name="submit" class="btn btn-danger">Add Match</button>
                    <a href="https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/private/admin/admin.php"
                        class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const usedContainer = document.getElementById('used-subs-container');
        const unusedContainer = document.getElementById('unused-subs-container');

        function addSubRow(type) {
            const container = type === 'used' ? usedContainer : unusedContainer;
            const index = container.children.length;
            const newRow = document.createElement('div');
            newRow.className = `d-flex gap-2 mb-2 ${type}-sub-row`;
            newRow.innerHTML = `
            <input type="number" name="${type}_subs[${index}][number]" 
                   class="form-control" style="width: 80px" placeholder="#">
            <input type="text" name="${type}_subs[${index}][name]" 
                   class="form-control" placeholder="Player name">
            <button type="button" class="btn btn-outline-danger remove-sub">Remove</button>
        `;
            container.appendChild(newRow);
            updateSubsJson();
        }

        document.getElementById('add-used-sub').addEventListener('click', () => addSubRow('used'));
        document.getElementById('add-unused-sub').addEventListener('click', () => addSubRow('unused'));

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-sub')) {
                e.target.closest('div').remove();
                updateSubsJson();
            }
        });

        function updateSubsJson() {
            const used = [...usedContainer.querySelectorAll('.used-sub-row')].map(row => ({
                number: row.querySelector('input[type="number"]').value,
                name: row.querySelector('input[type="text"]').value
            })).filter(sub => sub.number && sub.name);

            const unused = [...unusedContainer.querySelectorAll('.unused-sub-row')].map(row => ({
                number: row.querySelector('input[type="number"]').value,
                name: row.querySelector('input[type="text"]').value
            })).filter(sub => sub.number && sub.name);

            document.getElementById('subs-json').value = JSON.stringify({ used, unused });
        }

        document.querySelector('form').addEventListener('input', updateSubsJson);
        updateSubsJson();
    });

    document.querySelector('form').addEventListener('submit', function (e) {
        const formation = document.querySelector('input[name="custom_formation"]').value;
        if (!formation.match(/^\d+(-\d+)*$/)) {
            e.preventDefault();
            alert('Formation must be in format like 4-4-2');
            return;
        }

        const outfieldPlayers = formation.split('-').reduce((sum, num) => sum + parseInt(num), 0);
        if (outfieldPlayers !== 10) {
            e.preventDefault();
            alert('Formation must add up to 10 outfield players');
            return;
        }

        const playerNumbers = document.querySelectorAll('input[name="player_number[]"]');
        const playerNames = document.querySelectorAll('input[name="player_name[]"]');
        const numbers = new Set();

        for (let i = 0; i < playerNumbers.length; i++) {
            const num = playerNumbers[i].value;
            const name = playerNames[i].value.trim();

            if (!num || !name) {
                e.preventDefault();
                alert('All players must have both number and name');
                return;
            }

            if (numbers.has(num)) {
                e.preventDefault();
                alert('Duplicate player numbers are not allowed');
                return;
            }
            numbers.add(num);
        }
    });
</script>

<?php
include('../../public/includes/footer.php');
db_disconnect($connection);
?>