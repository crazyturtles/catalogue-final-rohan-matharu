<?php
function find_matches($connection, $limit = 0, $offset = 0)
{
    $sql = "SELECT * FROM matches ORDER BY match_date DESC";
    if ($limit > 0) {
        $sql .= " LIMIT ?";
        if ($offset > 0) {
            $sql .= " OFFSET ?";
        }
    }

    $stmt = $connection->prepare($sql);
    if ($limit > 0 && $offset > 0) {
        $stmt->bind_param("ii", $limit, $offset);
    } elseif ($limit > 0) {
        $stmt->bind_param("i", $limit);
    }

    $stmt->execute();
    return $stmt->get_result();
}

function find_records($connection, $limit = 0, $offset = 0)
{
    return find_matches($connection, $limit, $offset);
}

function count_matches($connection)
{
    $sql = "SELECT COUNT(*) FROM matches";
    $result = $connection->query($sql);
    return $result->fetch_row()[0];
}

function count_records($connection)
{
    return count_matches($connection);
}

function insert_match($connection, $match_data)
{
    $match_date = $match_data['match_date'];
    $opponent = $match_data['opponent'];
    $venue = $match_data['venue'];
    $formation = $match_data['formation'];
    $score_united = empty($match_data['score_united']) ? null : (int) $match_data['score_united'];
    $score_opponent = empty($match_data['score_opponent']) ? null : (int) $match_data['score_opponent'];
    $possession = (float) $match_data['possession'];
    $shots = empty($match_data['shots']) ? null : (int) $match_data['shots'];
    $shots_on_target = empty($match_data['shots_on_target']) ? null : (int) $match_data['shots_on_target'];
    $passes = empty($match_data['passes']) ? null : (int) $match_data['passes'];
    $pass_accuracy = (float) $match_data['pass_accuracy'];
    $fouls = empty($match_data['fouls']) ? null : (int) $match_data['fouls'];
    $yellow_cards = empty($match_data['yellow_cards']) ? null : (int) $match_data['yellow_cards'];
    $red_cards = empty($match_data['red_cards']) ? null : (int) $match_data['red_cards'];
    $corners = empty($match_data['corners']) ? null : (int) $match_data['corners'];
    $offsides = empty($match_data['offsides']) ? null : (int) $match_data['offsides'];
    $match_image = $match_data['match_image'] ?? null;
    $match_description = $match_data['match_description'];
    $lineup_json = $match_data['lineup_json'];
    $subs_json = $match_data['subs_json'];
    $added_by = $match_data['added_by'];
    $date_added = $match_data['date_added'];

    $query = "INSERT INTO matches (match_date, opponent, venue, formation, score_united, score_opponent, possession, shots, shots_on_target, passes, pass_accuracy, fouls, yellow_cards, red_cards, corners, offsides, match_image, match_description, lineup_json, subs_json, added_by, date_added) VALUES ('$match_date', '$opponent', '$venue', '$formation', $score_united, $score_opponent, $possession, $shots, $shots_on_target, $passes, $pass_accuracy, $fouls, $yellow_cards, $red_cards, $corners, $offsides, '$match_image', '$match_description', '$lineup_json', '$subs_json', '$added_by', '$date_added')";

    $result = $connection->query($query);
    return $result;
}

function update_match($connection, $match_id, $match_data)
{
    $sql = "UPDATE matches SET 
      match_date = ?, opponent = ?, venue = ?, formation = ?,
      score_united = ?, score_opponent = ?, possession = ?,
      shots = ?, shots_on_target = ?, passes = ?, pass_accuracy = ?,
      fouls = ?, yellow_cards = ?, red_cards = ?, corners = ?, offsides = ?,
      match_description = ?, lineup_json = ?, subs_json = ?,
      match_image = ?, last_edited_by = ?, date_edited = ?
      WHERE match_id = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssssssssssssi",
        $match_data['match_date'],
        $match_data['opponent'],
        $match_data['venue'],
        $match_data['formation'],
        $match_data['score_united'],
        $match_data['score_opponent'],
        $match_data['possession'],
        $match_data['shots'],
        $match_data['shots_on_target'],
        $match_data['passes'],
        $match_data['pass_accuracy'],
        $match_data['fouls'],
        $match_data['yellow_cards'],
        $match_data['red_cards'],
        $match_data['corners'],
        $match_data['offsides'],
        $match_data['match_description'],
        $match_data['lineup_json'],
        $match_data['subs_json'],
        $match_data['match_image'],
        $match_data['last_edited_by'],
        $match_data['date_edited'],
        $match_id
    );

    if (!$stmt->execute()) {
        return false;
    }
    return true;
}

function delete_match($connection, $match_id)
{
    $sql = "DELETE FROM matches WHERE match_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $match_id);
    return $stmt->execute();
}

function get_match($connection, $match_id)
{
    $sql = "SELECT * FROM matches WHERE match_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $match_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>