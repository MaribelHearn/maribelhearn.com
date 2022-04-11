<?php
$json = file_get_contents('assets/shared/json/gensokyo.json');
$reps = json_decode($json, true);
$games = Array('EoSD', 'PCB', 'IN', 'PoFV', 'StB', 'MoF', 'SA', 'UFO', 'DS', 'GFW', 'TD');
$diffs = Array('Easy', 'Normal', 'Hard', 'Lunatic', 'Extra', 'Phantasm', 'Last Word');
$types = Array('Normal', 'Practice', 'Spell');
if (empty($_GET['id'])) {
    $player = empty($_GET['player']) ? '-' : $_GET['player'];
    $shot = empty($_GET['shot']) ? '-' : $_GET['shot'];
    if (!empty($_GET['game']) && $_GET['game'] !== '-' && in_array($_GET['game'], $games)) {
        $game = $_GET['game'];
    } else {
        $game = '-';
    }
    if (!empty($_GET['type']) && in_array($_GET['type'], $types)) {
        $type = empty($_GET['type']) ? '-' : $_GET['type'];
    } else {
        $type = '-';
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
    } else {
        $diff = '-';
    }
} else {
    $player = $game = $shot = $type = $diff = '-';
}

function condition_name(string $cond_abbr) {
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

function format_conditions($conditions, string $category) {
    $result = '';
    if ($category != 'DS' && !empty($conditions)) {
        $conditions = preg_split('/,/', $conditions);
        foreach ($conditions as $key => $cond) {
            $cond_name = condition_name($cond);
            $result .= '<img src="assets/games/gensokyo/gif/' . $cond . '.gif" width="20" height="20" alt="' . $cond_name . '" title="' . $cond_name . '">';
        }
    }
    return $result;
}

function replay_table(array $rep) {
    $comment = str_replace('<', '&lt;', $rep['comment']);
    $comment = str_replace('>', '&gt;', $comment);
    $backlink = explode('&id', $_SERVER['REQUEST_URI']);
    $conditions = format_conditions($rep['conditions'], $rep['category']);
    echo '<div class="overflow"><table id="replay" class="sortable"><tbody>';
    echo '<tr><th class="general_header">Player</th><td id="player_td">' . $rep['player'] . '</td></tr>';
    echo '<tr><th class="general_header">Category</th><td>' . $rep['category'] . ($rep['category'] == 'DS' ? ' ' . $rep['slowdown'] : '') .
    '</td></tr>';
    echo '<tr><th class="general_header">Game Version</th><td>' . ($rep['category'] == 'DS' ? '' : $rep['ver']) . '</td></tr>';
    echo '<tr><th class="general_header">Upload Date</th><td>' . ($rep['category'] == 'DS' ? $rep['ver'] : $rep['date']) . '</td></tr>';
    echo '<tr><th class="general_header">Type</th><td>' . ($rep['category'] == 'DS' ? $rep['date'] : $rep['type']) . '</td></tr>';
    echo '<tr><th class="general_header">Score</th><td>' . ($rep['category'] == 'DS' ? number_format($rep['type'], 0, '.', ',') : $rep['score']) . '</td></tr>';
    echo '<tr><th class="general_header">Slowdown</th><td>' . ($rep['category'] == 'DS' ? '-' : $rep['slowdown']) . '</td></tr>';
    echo '<tr><th class="general_header">Shottype</th><td>' . ($rep['category'] == 'DS' ? $rep['slowdown'] : $rep['shottype']) . '</td></tr>';
    echo '<tr><th class="general_header">Conditions</th><td>' . $conditions . '</td></tr>';
    echo '<tr><th class="general_header">Comment</th><td>' . ($rep['category'] == 'DS' ? $rep['conditions'] : $comment) . '</td></tr>';
    foreach (glob('replays/gensokyo/' . $_GET['id'] . '/*.rpy') as $file) {
        $replay = explode('/', $file);
        echo '<tr><th class="general_header">Download</th><td><a href="' . $file . '">' . $replay[3] . '</a></td></tr>';
    }
    echo '</tbody><tfoot><tr><th id="back" colspan="2"><a href="' . $backlink[0] . '">Back</a></th></tr></tfoot></table></div>';
}

function input_validity() {
    global $player, $shot, $game, $type, $diff;
    if ($player == '-' && $shot == '-' && $game == '-' && $type == '-' && $diff == '-') {
        return 0;
    }
    if (($player != '-' && strlen($player) == 1) || ($shot != '-' && strlen($shot) == 1)) {
        return 1;
    }
    return 2;
}

function check_conditions(array $rep, string $player, string $shot, string $game, string $type, string $diff) {
    if (!empty($player) && $player != '-') {
        if (substr($player, 0, 1) == '"' && substr($player, -1) == '"') {
            $player = substr($player, 1, -1);
            $player_matches = $player == $rep['player'];
        } else {
            $player_matches = stripos($rep['player'], $player) !== false;
        }
        if (!$player_matches) {
            return false;
        }
    }
    if (!empty($shot) && $shot != '-') {
        if (substr($shot, 0, 1) == '"' && substr($shot, -1) == '"') {
            $shot = substr($shot, 1, -1);
            $shot_matches = $shot == $rep['shottype'];
        } else {
            $shot_matches = stripos($rep['shottype'], $shot) !== false;
        }
        if (!$shot_matches) {
            return false;
        }
    }
    if (!empty($game) && $game != '-' && strpos($rep['category'], $game) !== 0) {
        return false;
    }
    if (!empty($type) && $type != '-' && strpos($rep['type'], $type) === false) {
        return false;
    }
    if (!empty($diff) && $diff != '-') {
        if ($diff == 'Last Word') {
            $LWs = Array('206', '207', '208', '209', '210', '211', '212', '213', '214', '215', '216', '217', '218', '219', '220', '221', '222');
            $isLW = false;
            foreach ($LWs as $LW) {
                if (strpos($type, $LW)) {
                    $isLW = true;
                }
            }
            if (!$isLW) {
                return false;
            }
        } else if (strpos($rep['category'], $diff) === false) {
            return false;
        }
    }
    if (!empty($_GET['nd']) && $_GET['nd'] == 'on' && strpos($rep['conditions'], 'nd') === false) {
        return false;
    }
    if (!empty($_GET['nb']) && $_GET['nb'] == 'on' && strpos($rep['conditions'], 'nb') === false) {
        return false;
    }
    if (!empty($_GET['nf']) && $_GET['nf'] == 'on' && strpos($rep['conditions'], 'nf') === false) {
        return false;
    }
    if (!empty($_GET['nv']) && $_GET['nv'] == 'on' && strpos($rep['conditions'], 'nv') === false) {
        return false;
    }
    if (!empty($_GET['tas']) && $_GET['tas'] == 'on' && strpos($rep['conditions'], 'tas') === false) {
        return false;
    }
    if (!empty($_GET['chz']) && $_GET['chz'] == 'on' && strpos($rep['conditions'], 'chz') === false) {
        return false;
    }
    if (!empty($_GET['pa']) && $_GET['pa'] == 'on' && strpos($rep['conditions'], 'pa') === false) {
        return false;
    }
    if (!empty($_GET['co']) && $_GET['co'] == 'on' && strpos($rep['conditions'], 'co') === false) {
        return false;
    }
    return true;
}
?>
