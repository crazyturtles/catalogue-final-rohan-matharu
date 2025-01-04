<?php
function render_formation($lineup_json)
{
    $players = json_decode($lineup_json, true);

    $svg = '<svg viewBox="0 0 100 100" class="formation-pitch" style="width: 100%; max-width: 500px; background: #3a813c;">';

    $svg .= '<rect x="0" y="0" width="100" height="100" fill="none" stroke="white" stroke-width="0.5"/>';
    $svg .= '<rect x="5" y="75" width="90" height="25" fill="none" stroke="white" stroke-width="0.5"/>';
    $svg .= '<rect x="35" y="75" width="30" height="10" fill="none" stroke="white" stroke-width="0.5"/>';
    $svg .= '<circle cx="50" cy="87" r="0.5" fill="white"/>';

    $positions = get_player_positions($players['formation']);

    foreach ($players['players'] as $index => $player) {
        if (isset($positions[$index])) {
            $pos = $positions[$index];
            $svg .= sprintf(
                '<g transform="translate(%d,%d)">
                   <circle cx="0" cy="0" r="3" fill="red"/>
                   <text x="0" y="5" text-anchor="middle" fill="white" font-size="2.5">%d</text>
                   <text x="0" y="-3" text-anchor="middle" fill="white" font-size="2.5">%s</text>
                </g>',
                $pos[0],
                $pos[1],
                $player['number'],
                $player['name']
            );
        }
    }

    $svg .= '</svg>';
    return $svg;
}

function get_player_positions($formation)
{
    $lines = explode('-', $formation);
    $total_lines = count($lines);
    $positions = [[50, 90]];

    $vertical_spacing = 75 / ($total_lines + 1);

    foreach ($lines as $line_index => $players_in_line) {
        $y = 90 - (($line_index + 1) * $vertical_spacing);

        if ((int) $players_in_line === 1) {
            $positions[] = [50, $y];
        } else {
            $spacing = 60 / ((int) $players_in_line - 1);
            for ($i = 0; $i < (int) $players_in_line; $i++) {
                $x = 20 + ($i * $spacing);
                $positions[] = [$x, $y];
            }
        }
    }

    return $positions;
}
?>