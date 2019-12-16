<!DOCTYPE html>
<html lang='en' class='no-js'>
<?php
    include '.stats/count.php';
    hit(basename(__FILE__));
    $json = file_get_contents('json/gensokyo.json');
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
?>

    <head>
		<title>Gensokyo Replay Archive</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Complete archive of the Touhou replays from replays.gensokyo.org.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, replay, replays, gensokyo, gensokyo.org, replays.gensokyo, replays.gensokyo.org'>
		<link rel='stylesheet' type='text/css' href='assets/gensokyo/gensokyo.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&display=swap'>
		<link rel='icon' type='image/x-icon' href='assets/gensokyo/gensokyo.ico'>
        <script src='assets/shared/jquery.js' defer></script>
        <script src='assets/shared/sorttable.js' defer></script>
        <script src='assets/shared/modernizr-custom.js' defer></script>
        <script>document.documentElement.classList.remove("no-js");head=document.getElementsByTagName("head")[0];done=false;
		function dark(){style=document.createElement("link");style.id="dark";style.href="assets/shared/dark.css";
		style.type="text/css";style.rel="stylesheet";head.append(style)}
        function ready(){if(done){return}done=true;hy=document.getElementById("hy");
        if(localStorage.theme=="dark"){hy.src="assets/shared/y-bar.png";hy.title="Youkai Mode";dark()}}
		function theme(e){if(e.src.indexOf("y")<0){e.src="assets/shared/y-bar.png";e.title="Youkai Mode";localStorage.theme="dark";
		dark()}else{e.src="assets/shared/h-bar.png";e.title="Human Mode";head.removeChild(head.lastChild);localStorage.theme="light"}}
		</script>
    </head>

    <body>
		<div id='nav' class='wrap'>
			<nav>
				<?php
					$nav = file_get_contents('nav.html');
					$page = str_replace('.php', '', basename(__FILE__));
					$nav = str_replace('<a href="' . $page . '">', '<strong>', $nav);
					$cap = strlen($page) < 4 ? strtoupper($page) : ucfirst($page);
					echo str_ireplace('Archive</a>', 'Archive</strong>', $nav);
				?>
			</nav>
		</div>
        <div id='wrap' class='wrap'>
            <img id='hy' src='assets/shared/h-bar.png' title='Human Mode' onClick='theme(this)' onLoad='ready()'>
            <h1>Gensokyo Replay Archive</h1>
            <?php
                if (!empty($_GET['redirect'])) {
                    echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
                }
            ?>
            <p>A complete archive of the Touhou replays from replays.gensokyo.org, with the same search functionality as said website.</p>
            <p>On 25 September 2019, gensokyo.org expired, and as of the 30th it is inaccessible.
            As such, this archive has been created to preserve all of its replays.
            Unlike the original website, these replays cannot be deleted.</p>
            <p>The table resulting from search can be sorted by date (note that this might be slow depending on the size),
            and the player name can be clicked to view the corresponding replay in detail.</p>
            <form>
                <table id='searchtable'>
                    <thead><tr><td>
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
                    </td></tr></thead>
                    <tbody><tr><td>
                        <label for='nd'><img src='assets/gensokyo/nd.gif' title='No Deaths'></label>
                        <input id='nd' name='nd' type='checkbox'<?php echo $_GET['nd'] == 'on' ? ' checked' : '' ?>>
                        <label for='nb'><img src='assets/gensokyo/nb.gif' title='No Bomb Usage'></label>
                        <input id='nb' name='nb' type='checkbox'<?php echo $_GET['nb'] == 'on' ? ' checked' : '' ?>>
                        <label for='nf'><img src='assets/gensokyo/nf.gif' title='No Focused Movement'></label>
                        <input id='nf' name='nf' type='checkbox'<?php echo $_GET['nf'] == 'on' ? ' checked' : '' ?>>
                        <label for='nv'><img src='assets/gensokyo/nv.gif' title='No Vertical Movement'></label>
                        <input id='nv' name='nv' type='checkbox'<?php echo $_GET['nv'] == 'on' ? ' checked' : '' ?>>
                        <label for='tas'><img src='assets/gensokyo/tas.gif' title='Tool-Assisted Replay'></label>
                        <input id='tas' name='tas' type='checkbox'<?php echo $_GET['tas'] == 'on' ? ' checked' : '' ?>>
                        <label for='chz'><img src='assets/gensokyo/chz.gif' title='Tool-Assisted Replay (not marked by original uploader)'></label>
                        <input id='chz' name='chz' type='checkbox'<?php echo $_GET['chz'] == 'on' ? ' checked' : '' ?>>
                        <label for='pa'><img src='assets/gensokyo/pa.gif' title='Pacifist'></label>
                        <input id='pa' name='pa' type='checkbox'<?php echo $_GET['pa'] == 'on' ? ' checked' : '' ?>>
                        <label for='co'><img src='assets/gensokyo/co.gif' title='Other Condition'></label>
                        <input id='co' name='co' type='checkbox'<?php echo $_GET['co'] == 'on' ? ' checked' : '' ?>>
                    </td></tr></tbody>
                    <tfoot><tr><td>
                        <input type='submit' value='Search'>
                    </td></tr></tfoot>
                </table>
            </form>
            <?php
                $tmp = explode('?', $_SERVER['REQUEST_URI']);
                $searched = !empty($tmp[1]);
                if (!empty($_GET['id'])) {
                    $rep = $reps[$_GET['id']];
                    $comment = str_replace('<', '&lt;', $rep['comment']);
                    $comment = str_replace('>', '&gt;', $comment);
                    $backlink = explode('&id', $_SERVER['REQUEST_URI']);
                    echo '<table class="sortable"><tbody>';
                    echo '<tr><th>Player</th><td>' . $rep['player'] . '</td></tr>';
                    echo '<tr><th>Category</th><td>' . $rep['category'] . '</td></tr>';
                    echo '<tr><th>Game Version</th><td>' . $rep['ver'] . '</td></tr>';
                    echo '<tr><th>Upload Date</th><td>' . $rep['date'] . '</td></tr>';
                    echo '<tr><th>Type</th><td>' . $rep['type'] . '</td></tr>';
                    echo '<tr><th>Score</th><td>' . $rep['score'] . '</td></tr>';
                    echo '<tr><th>Slowdown</th><td>' . $rep['slowdown'] . '</td></tr>';
                    echo '<tr><th>Shottype</th><td>' . $rep['shottype'] . '</td></tr>';
                    echo '<tr><th>Conditions</th><td>' . $rep['conditions'] . '</td></tr>';
                    echo '<tr><th>Comment</th><td>' . $comment . '</td></tr>';
                    foreach (glob('replays/gensokyo/' . $_GET['id'] . '/*.rpy') as $file) {
                        $replay = explode('/', $file);
                        echo '<tr><th>Download</th><td><a href="' . $file . '">' . $replay[3] . '</a></td></tr>';
                    }
                    echo '</tbody><tfoot><tr><th id="back" colspan="2"><a href="' . $backlink[0] . '">Back</a></th></tr></tfoot></table>';
                } else if ($searched) {
                    $found = false;
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
                        foreach (glob('replays/gensokyo/' . $key . '/*.rpy') as $file) {
                            if (!$found) {
                                echo '<table id="replays" class="center sortable"><thead><tr><th>Player</th><th>Category</th><th>Score</th>' .
                                '<th class="sorttable_mmdd">Date added</th><th>Type</th><th>Conditions</th><th>Download</th></tr></thead><tbody>';
                                $found = true;
                            }
                            $replay = explode('/', $file);
                            echo '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] . '</a></td><td>' . $rep['category'] .
                            '<br>' . $rep['shottype'] . '</td><td>' . $rep['score'] .
                            '</td><td>' . str_replace(' ', '<br>', $rep['date']) . '</td><td>' . $rep['type'] .
                            '</td><td>' . $rep['conditions'] . '</td><td><a href="' . $file . '">' . $replay[3] . '</a></td></tr>';
                        }
                    }
                    if ($found) {
                        echo '</tbody></table>';
                    } else {
                        echo 'No replays found.';
                    }
                }
            ?>
            <h2 id='ack'>Acknowledgements</h2>
            <p id='credit'>The background image was drawn by <a href='http://h-yde.deviantart.com/'>h-yde</a>.</p>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
        </div>
    </body>

</html>
