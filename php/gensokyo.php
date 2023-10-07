<?php
include_once 'php/shared/http.php';
if (file_exists('json/gensokyo.json')) {
    $json = file_get_contents('json/gensokyo.json');
} else {
    $json = curl_get('https://maribelhearn.com/json/gensokyo.json');
    if ($json === false) {
        die('Download failed!');
    }
}
$reps = json_decode($json, true);
$games = Array('EoSD', 'PCB', 'IN', 'PoFV', 'StB', 'MoF', 'SA', 'UFO', 'DS', 'GFW', 'TD', 'DDC');
$diffs = Array('Easy', 'Normal', 'Hard', 'Lunatic', 'Extra', 'Phantasm', 'Last Word');
$types = Array('Normal', 'Practice', 'Spell');
if (empty($_GET['id'])) {
    $player = empty($_GET['player']) ? '-' : htmlentities($_GET['player']);
    $shot = empty($_GET['shot']) ? '-' : htmlentities($_GET['shot']);
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
        default: return '';
    }
}

function format_conditions(string $conditions) {
    $result = '';
    if (!empty($conditions)) {
        $conditions = preg_split('/,/', $conditions);
        foreach ($conditions as $key => $cond) {
            $cond_name = condition_name($cond);
            if (!empty($cond_name)) {
                $result .= '<img src="assets/games/gensokyo/gif/' . $cond . '.gif" width="20" height="20" alt="' . $cond_name . '" title="' . $cond_name . '">';
            }
        }
    }
    return $result;
}

function ds_table_no_ver(string $id, array $rep, string $url, string $backlink) {
    $score = intval($rep['type']);
    echo '<div class="overflow"><table id="replay" class="sortable"><tbody>';
    echo '<tr><th class="general_header no-sort">Player</th><td>' . $rep['player'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Category</th><td>' . $rep['category'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Game Version</th><td>1.00a</td></tr>';
    echo '<tr><th class="general_header no-sort">Upload Date</th><td>' . substr($rep['ver'], 0, 10) . ' ' . substr($rep['ver'], 10) . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Type</th><td>' . $rep['date'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Score</th><td>' . number_format($score, 0, '.', ',') . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Slowdown</th><td>-</td></tr>';
    echo '<tr><th class="general_header no-sort">Shottype</th><td>' . $rep['slowdown'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Conditions</th><td></td></tr>';
    echo '<tr><th class="general_header no-sort">Comment</th><td>' . $rep['conditions'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Download</th><td><a href="' . $url . '">' . $rep['rpy'] . '</a></td></tr>';
    echo '</tbody><tfoot><tr><td id="back" colspan="2"><strong><a href="' . $backlink . '">Back</a></strong></td></tr></tfoot></table></div>';
}

function replay_table(string $id, array $rep) {
    if (empty($rep['rpy'])) {
        echo '<p>No such replay.</p>';
        return;
    }
    $comment = str_replace('<', '&lt;', $rep['comment']);
    $comment = str_replace('>', '&gt;', $comment);
    $backlink = explode('&id', $_SERVER['REQUEST_URI'])[0];
    $conditions = format_conditions($rep['conditions'], $rep['category']);
    $url = (is_localhost($_SERVER['REMOTE_ADDR']) ? 'https://maribelhearn.com/' : '') . 'replays/gensokyo/' . $id . '/' . $rep['rpy'];
    if ($rep['category'] == 'DS' && $rep['ver'] != '1.00a') {
        ds_table_no_ver($id, $rep, $url, $backlink);
        return;
    }
    echo '<div class="overflow"><table id="replay" class="sortable"><tbody>';
    echo '<tr><th class="general_header no-sort">Player</th><td>' . $rep['player'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Category</th><td>' . $rep['category'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Game Version</th><td>' . $rep['ver'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Upload Date</th><td>' . $rep['date'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Type</th><td>' . $rep['type'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Score</th><td>' . $rep['score'] . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Slowdown</th><td>' . $rep['slowdown'] . '</td></tr>';

    if (strpos($rep['category'], 'GFW') === false) {
        echo '<tr><th class="general_header no-sort">Shottype</th><td>' . $rep['shottype'] . '</td></tr>';
    }

    echo '<tr><th class="general_header no-sort">Conditions</th><td>' . $conditions . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Comment</th><td>' . $comment . '</td></tr>';
    echo '<tr><th class="general_header no-sort">Download</th><td><a href="' . $url . '">' . $rep['rpy'] . '</a></td></tr>';
    echo '</tbody><tfoot><tr><td id="back" colspan="2"><strong><a href="' . $backlink . '">Back</a></strong></td></tr></tfoot></table></div>';
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
            $shot_matches = strtolower($rep['shottype']) == strtolower($shot);
        }
        if (!$shot_matches) {
            return false;
        }
    }
    // extra if-statement such that searching TD also returns DDC results
    if ($game == 'TD' && strpos($rep['category'], $game) === false && strpos($rep['category'], 'DDC') === false) {
        return false;
    }
    if (!empty($game) && $game != '-' && $game != 'TD' && strpos($rep['category'], $game) !== 0) {
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
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p>A complete archive of the Touhou replays from replays.gensokyo.org, with the same search functionality as said website.</p>
    <p>On 25 September 2019, gensokyo.org expired, and as of the 30th it is inaccessible.
    As such, this archive has been created to preserve all of its replays.
    Unlike the original website, these replays cannot be deleted.</p>
    <p>The table resulting from search can be sorted by score, date etc. (note that this might be slow depending on the size),
    and the player name can be clicked to view the corresponding replay in detail.</p>
    <form>
        <p>
            <label for='player'>Player</label>
            <input id='player' name='player' type='text' value='<?php echo $player == '-' ? '' : $player ?>'>
            <label for='game'>Game</label>
            <select id='game' name='game'>
                <option value='-'>...</option>
                <?php
                    foreach ($games as $key => $value) {
                        echo '<option' . (!empty($game) && $game == $value ? ' selected' : '') . '>' . $value . '</option>';
                    }
                ?>
            </select>
            <label for='shot'>Shottype</label>
            <input id='shot' name='shot' type='text' value='<?php echo $shot == '-' ? '' : $shot ?>'>
            <label for='type'>Type of Run</label>
            <select id='type' name='type'>
                <option value='-'>...</option>
                <option value='Normal'<?php echo !empty($type) && $type == 'Normal' ? ' selected' : ''?>>Full Game</option>
                <option<?php echo !empty($type) && $type == 'Practice' ? ' selected' : ''?>>Practice</option>
                <option value='Spell'<?php echo !empty($type) && $type == 'Spell' ? ' selected' : ''?>>Spell Card</option>
            </select>
            <label for='diff'>Difficulty</label>
            <select id='diff' name='diff'>
                <option value='-'>...</option>
                <?php
                    foreach ($diffs as $key => $value) {
                        echo '<option' . (!empty($diff) && $diff == $value ? ' selected' : '') . '>' . $value . '</option>';
                    }
                ?>
            </select>
        </p>
        <section id='conditions'>
            <span><label for='nd'><img src='assets/games/gensokyo/gif/nd.gif' title='No Deaths' alt='No Deaths icon'></label>
            <input id='nd' name='nd' type='checkbox'<?php echo !empty($_GET['nd']) && $_GET['nd'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='nb'><img src='assets/games/gensokyo/gif/nb.gif' title='No Bomb Usage' alt='No Bombs icon'></label>
            <input id='nb' name='nb' type='checkbox'<?php echo !empty($_GET['nb']) && $_GET['nb'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='nf'><img src='assets/games/gensokyo/gif/nf.gif' title='No Focused Movement' alt='No Focus icon'></label>
            <input id='nf' name='nf' type='checkbox'<?php echo !empty($_GET['nf']) && $_GET['nf'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='nv'><img src='assets/games/gensokyo/gif/nv.gif' title='No Vertical Movement' alt='No Vertical icon'></label>
            <input id='nv' name='nv' type='checkbox'<?php echo !empty($_GET['nv']) && $_GET['nv'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='tas'><img src='assets/games/gensokyo/gif/tas.gif' title='Tool-Assisted Replay' alt='TAS icon'></label>
            <input id='tas' name='tas' type='checkbox'<?php echo !empty($_GET['tas']) && $_GET['tas'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='chz'><img src='assets/games/gensokyo/gif/chz.gif' title='Tool-Assisted Replay (not marked by original uploader)' alt='Cheater icon'></label>
            <input id='chz' name='chz' type='checkbox'<?php echo !empty($_GET['chz']) && $_GET['chz'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='pa'><img src='assets/games/gensokyo/gif/pa.gif' title='Pacifist' alt='Pacifist icon'></label>
            <input id='pa' name='pa' type='checkbox'<?php echo !empty($_GET['pa']) && $_GET['pa'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='co'><img src='assets/games/gensokyo/gif/co.gif' title='Other Condition' alt='Other icon'></label>
            <input id='co' name='co' type='checkbox'<?php echo !empty($_GET['co']) && $_GET['co'] == 'on' ? ' checked' : '' ?>></span>
        </section>
        <br>
        <section>
            <input type='submit' value='Search'>
        </section>
    </form>
    <?php
        $searched = !empty($_SERVER['QUERY_STRING']);
        if (!empty($_GET['id'])) {
            if (!array_key_exists($_GET['id'], $reps)) {
                echo '<p>Invalid replay ID. Please use the search functionality to find the replay(s) you are looking for.</p>';
                return;
            }
            replay_table($_GET['id'], $reps[$_GET['id']]);
        } else if ($searched) {
            $table = '';
            $found = 0;
            if (input_validity() == 2) {
                foreach ($reps as $key => $rep) {
                    if (!check_conditions($rep, $player, $shot, $game, $type, $diff)) {
                        continue;
                    }
                    if ($found === 0) {
                        $table .= '<div class="overflow"><table id="replays" class="sortable"><thead><tr><th class="general_header">Player</th><th class="general_header">Category</th>' .
                        '<th class="general_header">Score</th><th class="general_header sorttable_mmdd">Date added</th><th class="general_header">Type</th>' .
                        '<th class="general_header">Conditions</th><th class="general_header">Download</th></tr></thead><tbody>';
                    }
                    if (!empty($rep['rpy'])) {
                        $url = (is_localhost($_SERVER['REMOTE_ADDR']) ? 'https://maribelhearn.com/' : '') . 'replays/gensokyo/' . $key . '/' . $rep['rpy'];
                        if ($rep['category'] == 'DS' && $rep['ver'] != '1.00a') {
                            $score = intval($rep['type']);
                            $table .= '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] .
                            '</a></td><td>' . $rep['category'] . '<br>' . $rep['slowdown'] . // shottype
                            '</td><td data-sort="' . $score . '">' . number_format($score, 0, '.', ',') . // score
                            '</td><td>' . substr($rep['ver'], 0, 10) . '<br>' . substr($rep['ver'], 10) . // date
                            '</td><td>' . $rep['date'] . // type
                            '</td><td>' . format_conditions($rep['shottype']) . // conditions
                            '</td><td><a href="' . $url . '">' . $rep['rpy'] . '</a></td></tr>';
                        } else {
                            $conditions = format_conditions($rep['conditions']);
                            $table .= '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] .
                            '</a></td><td>' . $rep['category'] .
                            (strpos($rep['category'], 'GFW') === false
                                    ? '<br>' . $rep['shottype']
                                    : ''
                            ) . '</td><td data-sort="' . intval(str_replace(',', '', $rep['score'])) . '">' . $rep['score'] .
                            '</td><td>' . str_replace(' ', '<br>', $rep['date']) . '</td><td>' . $rep['type'] .
                            '</td><td>' . $conditions . '</td><td><a href="' . $url . '">' . $rep['rpy'] .
                            '</a></td></tr>';
                        }
                        $found += 1;
                    }
                }
            }
            if ($found > 0) {
                $grammar = ($found !== 1 ? 's' : '');
                echo '<p class="center">' . number_format($found, 0, '.', ',') . ' result' . $grammar . '.</p>' . $table . '</tbody></table></div>';
            } else if (input_validity() == 2) {
                echo '<p class="center">No replays found.</p>';
            } else if (input_validity() == 1) {
                echo '<p class="center">Invalid search. Please provide more than one character for the player name or shot name.</p>';
            } else {
                echo '<p class="center">Invalid search. Please provide a search query.</p>';
            }
        }
    ?>
    <footer><strong><a href='#nav'>Back to Top</a></strong></footer>
</div>
