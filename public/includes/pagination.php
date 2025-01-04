<?php
function set_pagination($total_count, $per_page)
{
    $total_pages = ceil($total_count / $per_page);
    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

    if ($current_page < 1 || $current_page > $total_pages) {
        $current_page = 1;
    }

    $offset = $per_page * ($current_page - 1);
    $window_size = 2;
    $start_page = max(1, $current_page - $window_size);
    $end_page = min($total_pages, $current_page + $window_size);

    return [
        'total_pages' => $total_pages,
        'current_page' => $current_page,
        'offset' => $offset,
        'show_prev' => $current_page > 1,
        'show_next' => $current_page < $total_pages,
        'start_page' => $start_page,
        'end_page' => $end_page,
        'show_start_dots' => $start_page > 1,
        'show_end_dots' => $end_page < $total_pages
    ];
}

function render_pagination($pagination, $base_url, $params = [])
{
    $url_params = http_build_query($params);
    $url_params = $url_params ? "&" . $url_params : "";

    ob_start(); ?>
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php if ($pagination['show_prev']): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="<?php echo $base_url; ?>?page=<?php echo ($pagination['current_page'] - 1) . $url_params; ?>">Previous</a>
                </li>
            <?php endif; ?>

            <li class="page-item <?php echo $pagination['current_page'] == 1 ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo $base_url; ?>?page=1<?php echo $url_params; ?>">1</a>
            </li>

            <?php if ($pagination['show_start_dots']): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>

            <?php for ($i = $pagination['start_page']; $i <= $pagination['end_page']; $i++):
                if ($i != 1 && $i != $pagination['total_pages']): ?>
                    <li class="page-item <?php echo $pagination['current_page'] == $i ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="<?php echo $base_url; ?>?page=<?php echo $i . $url_params; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endif;
            endfor; ?>

            <?php if ($pagination['show_end_dots']): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>

            <?php if ($pagination['total_pages'] > 1): ?>
                <li class="page-item <?php echo $pagination['current_page'] == $pagination['total_pages'] ? 'active' : ''; ?>">
                    <a class="page-link"
                        href="<?php echo $base_url; ?>?page=<?php echo $pagination['total_pages'] . $url_params; ?>"><?php echo $pagination['total_pages']; ?></a>
                </li>
            <?php endif; ?>

            <?php if ($pagination['show_next']): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="<?php echo $base_url; ?>?page=<?php echo ($pagination['current_page'] + 1) . $url_params; ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php return ob_get_clean();
}
?>