<?php
function validate_match_data($match_data, &$errors)
{
    $required_fields = [
        'match_date',
        'opponent',
        'venue',
        'formation',
        'possession',
        'pass_accuracy',
        'match_description',
        'lineup_json',
        'subs_json'
    ];

    $numeric_fields = [
        'score_united' => ['min' => 0],
        'score_opponent' => ['min' => 0],
        'shots' => ['min' => 0],
        'shots_on_target' => ['min' => 0],
        'passes' => ['min' => 0],
        'fouls' => ['min' => 0],
        'yellow_cards' => ['min' => 0],
        'red_cards' => ['min' => 0],
        'corners' => ['min' => 0],
        'offsides' => ['min' => 0]
    ];

    foreach ($required_fields as $field) {
        if (!isset($match_data[$field]) || $match_data[$field] === '') {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
        }
    }

    foreach ($numeric_fields as $field => $rules) {
        if (isset($match_data[$field]) && $match_data[$field] !== '') {
            if (!is_numeric($match_data[$field]) || $match_data[$field] < $rules['min']) {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . " must be a number greater than or equal to " . $rules['min'] . ".";
            }
        }
    }

    if (isset($match_data['possession']) && $match_data['possession'] !== '') {
        if (!is_numeric($match_data['possession']) || $match_data['possession'] < 0 || $match_data['possession'] > 100) {
            $errors[] = "Possession must be a number between 0 and 100.";
        }
    }

    if (isset($match_data['pass_accuracy']) && $match_data['pass_accuracy'] !== '') {
        if (!is_numeric($match_data['pass_accuracy']) || $match_data['pass_accuracy'] < 0 || $match_data['pass_accuracy'] > 100) {
            $errors[] = "Pass accuracy must be a number between 0 and 100.";
        }
    }

    if (!empty($match_data['lineup_json'])) {
        json_decode($match_data['lineup_json']);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errors[] = "Lineup must be valid JSON.";
        }
    }

    if (!empty($match_data['subs_json'])) {
        json_decode($match_data['subs_json']);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errors[] = "Substitutes must be valid JSON.";
        }
    }

    if (!empty($match_data['match_date'])) {
        $date = date_create($match_data['match_date']);
        if (!$date) {
            $errors[] = "Invalid date format.";
        }
    }

    return empty($errors);
}

function validate_id($id)
{
    return filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
}

function sanitize_output($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>