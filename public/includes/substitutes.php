<?php
function render_substitutes($subs_json)
{
    $subs = json_decode($subs_json, true);
    if (!$subs)
        return '<p class="text-danger">Invalid substitutes data</p>';

    ob_start();
    ?>
    <div class="substitutes-container">
        <?php if (!empty($subs['used'])): ?>
            <h5 class="mb-3">Used Substitutes</h5>
            <div class="table-responsive mb-4">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subs['used'] as $player): ?>
                            <tr>
                                <td class="text-danger fw-bold"><?php echo $player['number']; ?></td>
                                <td><?php echo htmlspecialchars($player['name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (!empty($subs['unused'])): ?>
            <h5 class="mb-3">Unused Substitutes</h5>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subs['unused'] as $player): ?>
                            <tr>
                                <td class="text-muted"><?php echo $player['number']; ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($player['name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
?>