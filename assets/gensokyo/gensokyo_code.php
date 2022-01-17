<?php
$json = file_get_contents('assets/shared/json/gensokyo.json');
$reps = json_decode($json, true);
$games = Array('EoSD', 'PCB', 'IN', 'PoFV', 'StB', 'MoF', 'SA', 'UFO', 'DS', 'GFW', 'TD');
$diffs = Array('Easy', 'Normal', 'Hard', 'Lunatic', 'Extra', 'Phantasm', 'Last Word');
$types = Array('Normal', 'Practice', 'Spell');
if (empty($_GET['id'])) {
    if (!empty($_GET['player'])) {
        $player = $_GET['player'];
    }
    if (!empty($_GET['game']) && $_GET['game'] !== '-' && in_array($_GET['game'], $games)) {
        $game = $_GET['game'];
    }
    if (!empty($_GET['shot'])) {
        $shot = $_GET['shot'];
    }
    if (!empty($_GET['type']) && in_array($_GET['type'], $types)) {
        $type = $_GET['type'];
    }
    if (!empty($_GET['diff']) && $_GET['diff'] !== '-' && in_array($_GET['diff'], $diffs)) {
        $diff = $_GET['diff'];
        if ($game == 'StB' || $game == 'DS') {
            $diff = '-';
        }
        if ($game != 'PCB' && $diff == 'Phantasm') {
            $diff = 'Extra';
        }
        if ($game != 'IN' && $diff == 'Last Word') {
            $diff = '-';
        }
    }
    if (!empty($_GET['pl'])) {
        $PAGE_LENGTH = (int) $_GET['pl'];
    } else {
        $PAGE_LENGTH = 25;
    }
    if (!empty($_GET['page'])) {
        $p = $_GET['page'] * $PAGE_LENGTH - $PAGE_LENGTH;
    } else {
        $p = 0;
    }
}

function condition_name($cond_abbr) {
    switch ($cond_abbr) {
        case 'nd': return 'No Deaths';
        case 'nb': return 'No Bomb Usage';
        case 'nf': return 'No Focused Movement';
        case 'nv': return 'No Vertical Movement';
        case 'tas': return 'Tool-Assisted Replay';
        case 'chz': return 'Tool-Assisted Replay (not marked by original uploader)';
        case 'pa': return 'Pacifist';
        case 'co': return 'Other Condition';
    }
}

function format_conditions($conditions, $category) {
    $result = '';
    if ($category != 'DS') {
        $conditions = preg_split('/,/', $conditions);
        foreach ($conditions as $key => $cond) {
            $cond_name = condition_name($cond);
            $result .= '<img src="/assets/gensokyo/gif/' . $cond . '.gif" width="20" height="20" alt="' . $cond_name . '" title="' . $cond_name . '">';
        }
    }
    return $result;
}
?>
