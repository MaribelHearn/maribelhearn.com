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
            $result .= '<img src="/assets/gensokyo/gif/' . $cond . '.gif" width="20" height="20" alt="' . $cond_name . '" title="' . $cond_name . '">';
        }
    }
    return $result;
}

function replay_table(array $rep) {
    $comment = str_replace('<', '&lt;', $rep['comment']);
    $comment = str_replace('>', '&gt;', $comment);
    $backlink = explode('&id', $_SERVER['REQUEST_URI']);
    $conditions = format_conditions($rep['conditions'], $rep['category']);
    echo '<table id="replay" class="sortable"><tbody>';
    echo '<tr><th>Player</th><td id="player_td">' . $rep['player'] . '</td></tr>';
    echo '<tr><th>Category</th><td>' . $rep['category'] . ($rep['category'] == 'DS' ? ' ' . $rep['slowdown'] : '') .
    '</td></tr>';
    echo '<tr><th>Game Version</th><td>' . ($rep['category'] == 'DS' ? '' : $rep['ver']) . '</td></tr>';
    echo '<tr><th>Upload Date</th><td>' . ($rep['category'] == 'DS' ? $rep['ver'] : $rep['date']) . '</td></tr>';
    echo '<tr><th>Type</th><td>' . ($rep['category'] == 'DS' ? $rep['date'] : $rep['type']) . '</td></tr>';
    echo '<tr><th>Score</th><td>' . ($rep['category'] == 'DS' ? number_format($rep['type'], 0, '.', ',') : $rep['score']) . '</td></tr>';
    echo '<tr><th>Slowdown</th><td>' . ($rep['category'] == 'DS' ? '-' : $rep['slowdown']) . '</td></tr>';
    echo '<tr><th>Shottype</th><td>' . ($rep['category'] == 'DS' ? $rep['slowdown'] : $rep['shottype']) . '</td></tr>';
    echo '<tr><th>Conditions</th><td>' . $conditions . '</td></tr>';
    echo '<tr><th>Comment</th><td>' . ($rep['category'] == 'DS' ? $rep['conditions'] : $comment) . '</td></tr>';
    foreach (glob('replays/gensokyo/' . $_GET['id'] . '/*.rpy') as $file) {
        $replay = explode('/', $file);
        echo '<tr><th>Download</th><td><a href="' . $file . '">' . $replay[3] . '</a></td></tr>';
    }
    echo '</tbody><tfoot><tr><th id="back" colspan="2"><a href="' . $backlink[0] . '">Back</a></th></tr></tfoot></table>';
}
?>
