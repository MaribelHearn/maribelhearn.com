<?php include_once 'assets/gensokyo/gensokyo_code.php' ?>
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
            <input id='player' name='player' type='text' value='<?php echo !empty($player) ? $player : '' ?>'>
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
            <input id='shot' name='shot' type='text' value='<?php echo !empty($shot) ? $shot : '' ?>'>
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
        <p>
            <label for='nd'><img src='assets/gensokyo/gif/nd.gif' title='No Deaths' alt='No Deaths icon'></label>
            <input id='nd' name='nd' type='checkbox'<?php echo !empty($_GET['nd']) && $_GET['nd'] == 'on' ? ' checked' : '' ?>>
            <label for='nb'><img src='assets/gensokyo/gif/nb.gif' title='No Bomb Usage' alt='No Bombs icon'></label>
            <input id='nb' name='nb' type='checkbox'<?php echo !empty($_GET['nb']) && $_GET['nb'] == 'on' ? ' checked' : '' ?>>
            <label for='nf'><img src='assets/gensokyo/gif/nf.gif' title='No Focused Movement' alt='No Focus icon'></label>
            <input id='nf' name='nf' type='checkbox'<?php echo !empty($_GET['nf']) && $_GET['nf'] == 'on' ? ' checked' : '' ?>>
            <label for='nv'><img src='assets/gensokyo/gif/nv.gif' title='No Vertical Movement' alt='No Vertical icon'></label>
            <input id='nv' name='nv' type='checkbox'<?php echo !empty($_GET['nv']) && $_GET['nv'] == 'on' ? ' checked' : '' ?>>
            <label for='tas'><img src='assets/gensokyo/gif/tas.gif' title='Tool-Assisted Replay' alt='TAS icon'></label>
            <input id='tas' name='tas' type='checkbox'<?php echo !empty($_GET['tas']) && $_GET['tas'] == 'on' ? ' checked' : '' ?>>
            <label for='chz'><img src='assets/gensokyo/gif/chz.gif' title='Tool-Assisted Replay (not marked by original uploader)' alt='Cheater icon'></label>
            <input id='chz' name='chz' type='checkbox'<?php echo !empty($_GET['chz']) && $_GET['chz'] == 'on' ? ' checked' : '' ?>>
            <label for='pa'><img src='assets/gensokyo/gif/pa.gif' title='Pacifist' alt='Pacifist icon'></label>
            <input id='pa' name='pa' type='checkbox'<?php echo !empty($_GET['pa']) && $_GET['pa'] == 'on' ? ' checked' : '' ?>>
            <label for='co'><img src='assets/gensokyo/gif/co.gif' title='Other Condition' alt='Other icon'></label>
            <input id='co' name='co' type='checkbox'<?php echo !empty($_GET['co']) && $_GET['co'] == 'on' ? ' checked' : '' ?>>
        </p>
        <p>
            <label for='pl'>Page length</label>
            <input id='pl' name='pl' type='number' value='<?php echo !empty($_GET['pl']) && $_GET['pl'] ? ((int) $_GET['pl']) : 25 ?>' min='1'>
        </p>
        <p><input type='submit' value='Search'></p>
    </form>
    <?php
        $tmp = explode('?', $_SERVER['REQUEST_URI']);
        $searched = !empty($tmp[1]);
        if (!empty($_GET['id'])) {
            $rep = $reps[$_GET['id']];
            $comment = str_replace('<', '&lt;', $rep['comment']);
            $comment = str_replace('>', '&gt;', $comment);
            $backlink = explode('&id', $_SERVER['REQUEST_URI']);
            $conditions = format_conditions($rep['conditions'], $rep['category']);
            echo '<table id="replay" class="sortable"><tbody>';
            echo '<tr><th>Player</th><td>' . $rep['player'] . '</td></tr>';
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
        } else if ($searched) {
            $i = -1;
            $found = 0;
            foreach ($reps as $key => $rep) {
                if (substr($player, 0, 1) == '"' && substr($player, -1) == '"') {
                    $player = substr($player, 1, -1);
                    $player_matches = $player == $entry['player'];
                } else {
                    $player_matches = stripos($rep['player'], $player) !== 0;
                }
                if (substr($shot, 0, 1) == '"' && substr($shot, -1) == '"') {
                    $shot = substr($shot, 1, -1);
                    $shot_matches = $shot == $entry['shottype'];
                } else {
                    $shot_matches = stripos($rep['shottype'], $shot) !== 0;
                }
                if (!empty($player) && $player_matches) {
                    continue;
                }
                if (!empty($game) && $game != '-' && strpos($rep['category'], $game) !== 0) {
                    continue;
                }
                if (!empty($shot) && $shot_matches) {
                    continue;
                }
                if (!empty($type) && $type != '-' && strpos($rep['type'], $type) === false) {
                    continue;
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
                            continue;
                        }
                    } else if (strpos($rep['category'], $diff) === false) {
                        continue;
                    }
                }
                if (!empty($_GET['nd']) && $_GET['nd'] == 'on' && strpos($rep['conditions'], 'No Deaths') === false) {
                    continue;
                }
                if (!empty($_GET['nb']) && $_GET['nb'] == 'on' && strpos($rep['conditions'], 'No Bomb Usage') === false) {
                    continue;
                }
                if (!empty($_GET['nf']) && $_GET['nf'] == 'on' && strpos($rep['conditions'], 'No Focused Movement') === false) {
                    continue;
                }
                if (!empty($_GET['nv']) && $_GET['nv'] == 'on' && strpos($rep['conditions'], 'No Vertical Movement') === false) {
                    continue;
                }
                if (!empty($_GET['tas']) && $_GET['tas'] == 'on' && strpos($rep['conditions'], 'Tool-Assisted Replay') === false) {
                    continue;
                }
                if (!empty($_GET['chz']) && $_GET['chz'] == 'on' && strpos($rep['conditions'], 'Tool-Assisted Replay (not marked by original uploader)') === false) {
                    continue;
                }
                if (!empty($_GET['pa']) && $_GET['pa'] == 'on' && strpos($rep['conditions'], 'Pacifist') === false) {
                    continue;
                }
                if (!empty($_GET['co']) && $_GET['co'] == 'on' && strpos($rep['conditions'], 'Other Condition') === false) {
                    continue;
                }
                $i += 1;
                if ($i < $p) {
                    continue;
                } else if ($i == $p + $PAGE_LENGTH) {
                    break;
                }
                foreach (glob('replays/gensokyo/' . $key . '/*.rpy') as $file) {
                    if ($found === 0) {
                        echo '<table id="replays" class="sortable"><thead><tr><th>Player</th><th>Category</th><th>Score</th>' .
                        '<th class="sorttable_mmdd">Date added</th><th>Type</th><th>Conditions</th><th>Download</th></tr></thead><tbody>';
                    }
                    $replay = explode('/', $file);
                    if ($rep['category'] == 'DS') {
                        echo '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] .
                        '</a></td><td>' . $rep['category'] . '<br>' . $rep['slowdown'] . // shottype
                        '</td><td>' . number_format($rep['type'], 0, '.', ',') . // score
                        '</td><td>' . substr($rep['ver'], 0, 10) . '<br>' . substr($rep['ver'], 10) . // date
                        '</td><td>' . $rep['date'] . '</td><td></td><td><a href="' . $file . '">' . $replay[3] .
                        '</a></td></tr>'; // date = type, conditions empty
                    } else {
                        $conditions = format_conditions($rep['conditions'], $rep['category']);
                        echo '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] .
                        '</a></td><td>' . $rep['category'] . '<br>' . $rep['shottype'] . '</td><td>' . $rep['score'] .
                        '</td><td>' . str_replace(' ', '<br>', $rep['date']) . '</td><td>' . $rep['type'] .
                        '</td><td>' . $conditions . '</td><td><a href="' . $file . '">' . $replay[3] . '</a></td></tr>';
                    }
                    $found += 1;
                }
            }
            if ($found > 0) {
                echo '</tbody></table>';
                if ($p > 0) {
                    $url = substr($_SERVER['REQUEST_URI'], 0, -1);
                    echo '<a id="previous" href="' . $url . ($p / $PAGE_LENGTH) . '">&lt;= Previous</a>';
                }
                if ($found >= $PAGE_LENGTH) {
                    $url = $_SERVER['REQUEST_URI'];
                    if (!strpos($url, '&page=')) {
                        echo '<a id="next" href="' . $url . '&page=2">Next =&gt;</a>';
                    } else {
                        echo '<a id="next" href="' . substr($url, 0, -1) . (($p / $PAGE_LENGTH) + 2) . '">Next =&gt;</a>';
                    }
                }
            } else {
                echo '<p>No replays found.</p>';
                $url = $_SERVER['REQUEST_URI'];
                if (strpos($url, '&page=')) {
                    echo '<p><a id="previous" href="' . substr($url, 0, -1) . ($p / $PAGE_LENGTH) .
                    '">&lt;= Previous</a></p>';
                }
            }
        }
    ?>
    <p><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
</div>
