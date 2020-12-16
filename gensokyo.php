<!DOCTYPE html>
<html lang='en'>
<?php
    include 'assets/shared/shared.php';
    include 'assets/gensokyo/gensokyo.php';
    hit(basename(__FILE__));
    $page = str_replace('.php', '', basename(__FILE__));
?>

    <head>
		<title>Gensokyo Replay Archive</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Complete archive of the Touhou replays from replays.gensokyo.org.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, replay, replays, gensokyo, gensokyo.org, replays.gensokyo, replays.gensokyo.org'>
        <link rel='stylesheet' type='text/css' href='assets/gensokyo/gensokyo.css'>
		<link rel='icon' type='image/x-icon' href='assets/gensokyo/gensokyo.ico'>
        <script src='assets/shared/sorttable.js' defer></script>
        <?php echo dark_theme() ?>
    </head>

    <body>
        <nav>
    		<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
        </nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack'>This background image<br id='ack_br'>
                was drawn by <a href='http://h-yde.deviantart.com/'>h-yde</a></p>
                <span id='hy_container'><img id='hy' src='assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1>Gensokyo Replay Archive</h1>
    			<?php
    				if (!empty($_GET['redirect'])) {
    					echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
    				}
    			?>
                <p>A complete archive of the Touhou replays from replays.gensokyo.org, with the same search functionality as said website.</p>
                <p>On 25 September 2019, gensokyo.org expired, and as of the 30th it is inaccessible.
                As such, this archive has been created to preserve all of its replays.
                Unlike the original website, these replays cannot be deleted.</p>
                <p>The table resulting from search can be sorted by date (note that this might be slow depending on the size),
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
                        <label for='nd'><img src='assets/gensokyo/nd.gif' title='No Deaths' alt='No Deaths icon'></label>
                        <input id='nd' name='nd' type='checkbox'<?php echo $_GET['nd'] == 'on' ? ' checked' : '' ?>>
                        <label for='nb'><img src='assets/gensokyo/nb.gif' title='No Bomb Usage' alt='No Bombs icon'></label>
                        <input id='nb' name='nb' type='checkbox'<?php echo $_GET['nb'] == 'on' ? ' checked' : '' ?>>
                        <label for='nf'><img src='assets/gensokyo/nf.gif' title='No Focused Movement' alt='No Focus icon'></label>
                        <input id='nf' name='nf' type='checkbox'<?php echo $_GET['nf'] == 'on' ? ' checked' : '' ?>>
                        <label for='nv'><img src='assets/gensokyo/nv.gif' title='No Vertical Movement' alt='No Vertical icon'></label>
                        <input id='nv' name='nv' type='checkbox'<?php echo $_GET['nv'] == 'on' ? ' checked' : '' ?>>
                        <label for='tas'><img src='assets/gensokyo/tas.gif' title='Tool-Assisted Replay' alt='TAS icon'></label>
                        <input id='tas' name='tas' type='checkbox'<?php echo $_GET['tas'] == 'on' ? ' checked' : '' ?>>
                        <label for='chz'><img src='assets/gensokyo/chz.gif' title='Tool-Assisted Replay (not marked by original uploader)' alt='Cheater icon'></label>
                        <input id='chz' name='chz' type='checkbox'<?php echo $_GET['chz'] == 'on' ? ' checked' : '' ?>>
                        <label for='pa'><img src='assets/gensokyo/pa.gif' title='Pacifist' alt='Pacifist icon'></label>
                        <input id='pa' name='pa' type='checkbox'<?php echo $_GET['pa'] == 'on' ? ' checked' : '' ?>>
                        <label for='co'><img src='assets/gensokyo/co.gif' title='Other Condition' alt='Other icon'></label>
                        <input id='co' name='co' type='checkbox'<?php echo $_GET['co'] == 'on' ? ' checked' : '' ?>>
                    </p>
                    <p>
                        <label for='pl'>Page length</label>
                        <input id='pl' name='pl' type='number' value='<?php echo $_GET['pl'] ? ((int) $_GET['pl']) : 25 ?>' min='1'>
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
                        echo '<tr><th>Conditions</th><td>' . ($rep['category'] == 'DS' ? '' : $rep['conditions']) . '</td></tr>';
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
                            if (!empty($player) && stripos($rep['player'], $player) !== 0) {
                                continue;
                            }
                            if (!empty($game) && $game != '-' && strpos($rep['category'], $game) !== 0) {
                                continue;
                            }
                            if (!empty($shot) && $rep['shottype'] != $shot) {
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
                            if ($_GET['nd'] == 'on' && strpos($rep['conditions'], 'No Deaths') === false) {
                                continue;
                            }
                            if ($_GET['nb'] == 'on' && strpos($rep['conditions'], 'No Bomb Usage') === false) {
                                continue;
                            }
                            if ($_GET['nf'] == 'on' && strpos($rep['conditions'], 'No Focused Movement') === false) {
                                continue;
                            }
                            if ($_GET['nv'] == 'on' && strpos($rep['conditions'], 'No Vertical Movement') === false) {
                                continue;
                            }
                            if ($_GET['tas'] == 'on' && strpos($rep['conditions'], 'Tool-Assisted Replay') === false) {
                                continue;
                            }
                            if ($_GET['chz'] == 'on' && strpos($rep['conditions'], 'Tool-Assisted Replay (not marked by original uploader)') === false) {
                                continue;
                            }
                            if ($_GET['pa'] == 'on' && strpos($rep['conditions'], 'Pacifist') === false) {
                                continue;
                            }
                            if ($_GET['co'] == 'on' && strpos($rep['conditions'], 'Other Condition') === false) {
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
                                    echo '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] .
                                    '</a></td><td>' . $rep['category'] . '<br>' . $rep['shottype'] . '</td><td>' . $rep['score'] .
                                    '</td><td>' . str_replace(' ', '<br>', $rep['date']) . '</td><td>' . $rep['type'] .
                                    '</td><td>' . $rep['conditions'] . '</td><td><a href="' . $file . '">' . $replay[3] . '</a></td></tr>';
                                }
                                $found += 1;
                            }
                        }
                        if ($found > 0) {
                            echo '</tbody></table>';
                            if ($p > 0) {
                                $url = substr($_SERVER[REQUEST_URI], 0, -1);
                                echo '<a id="previous" href="' . $url . ($p / $PAGE_LENGTH) . '">&lt;= Previous</a>';
                            }
                            if ($found >= $PAGE_LENGTH) {
                                $url = $_SERVER[REQUEST_URI];
                                if (!strpos($url, '&page=')) {
                                    echo '<a id="next" href="' . $url . '&page=2">Next =&gt;</a>';
                                } else {
                                    echo '<a id="next" href="' . substr($url, 0, -1) . (($p / $PAGE_LENGTH) + 2) . '">Next =&gt;</a>';
                                }
                            }
                        } else {
                            echo 'No replays found.';
                            $url = $_SERVER[REQUEST_URI];
                            if (strpos($url, '&page=')) {
                                echo '<p><a id="previous" href="' . substr($url, 0, -1) . ($p / $PAGE_LENGTH) .
                                '">&lt;= Previous</a></p>';
                            }
                        }
                    }
                ?>
                <p id='ack_mobile'>The background image was drawn by <a href='http://h-yde.deviantart.com/'>h-yde</a>.</p>
                <p><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
                <script src='assets/shared/dark.js'></script>
            </div>
        </main>
    </body>

</html>
