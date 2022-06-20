<?php include_once 'assets/games/gensokyo/gensokyo_code.php' ?>
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
        <p id='conditions'>
            <span><label for='nd'><img src='assets/games/gensokyo/gif/nd.gif' title='No Deaths' alt='No Deaths icon'></label><br>
            <input id='nd' name='nd' type='checkbox'<?php echo !empty($_GET['nd']) && $_GET['nd'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='nb'><img src='assets/games/gensokyo/gif/nb.gif' title='No Bomb Usage' alt='No Bombs icon'></label><br>
            <input id='nb' name='nb' type='checkbox'<?php echo !empty($_GET['nb']) && $_GET['nb'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='nf'><img src='assets/games/gensokyo/gif/nf.gif' title='No Focused Movement' alt='No Focus icon'></label><br>
            <input id='nf' name='nf' type='checkbox'<?php echo !empty($_GET['nf']) && $_GET['nf'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='nv'><img src='assets/games/gensokyo/gif/nv.gif' title='No Vertical Movement' alt='No Vertical icon'></label><br>
            <input id='nv' name='nv' type='checkbox'<?php echo !empty($_GET['nv']) && $_GET['nv'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='tas'><img src='assets/games/gensokyo/gif/tas.gif' title='Tool-Assisted Replay' alt='TAS icon'></label><br>
            <input id='tas' name='tas' type='checkbox'<?php echo !empty($_GET['tas']) && $_GET['tas'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='chz'><img src='assets/games/gensokyo/gif/chz.gif' title='Tool-Assisted Replay (not marked by original uploader)' alt='Cheater icon'></label><br>
            <input id='chz' name='chz' type='checkbox'<?php echo !empty($_GET['chz']) && $_GET['chz'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='pa'><img src='assets/games/gensokyo/gif/pa.gif' title='Pacifist' alt='Pacifist icon'></label><br>
            <input id='pa' name='pa' type='checkbox'<?php echo !empty($_GET['pa']) && $_GET['pa'] == 'on' ? ' checked' : '' ?>></span>
            <span><label for='co'><img src='assets/games/gensokyo/gif/co.gif' title='Other Condition' alt='Other icon'></label><br>
            <input id='co' name='co' type='checkbox'<?php echo !empty($_GET['co']) && $_GET['co'] == 'on' ? ' checked' : '' ?>></span>
        </p>
        <p><input type='submit' value='Search'></p>
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
                        if ($rep['category'] == 'DS') {
                            $table .= '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] .
                            '</a></td><td>' . $rep['category'] . '<br>' . $rep['slowdown'] . // shottype
                            '</td><td>' . $rep['type'] . // score
                            '</td><td>' . substr($rep['ver'], 0, 10) . '<br>' . substr($rep['ver'], 10) . // date
                            '</td><td>' . $rep['date'] . '</td><td></td><td><a href="' . $url . '">' . $rep['rpy'] .
                            '</a></td></tr>'; // date = type, conditions empty
                        } else {
                            $conditions = format_conditions($rep['conditions'], $rep['category']);
                            $table .= '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '&id=' . $key . '">' . $rep['player'] .
                            '</a></td><td>' . $rep['category'] . '<br>' . $rep['shottype'] . '</td><td>' . $rep['score'] .
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
                echo '<p>' . number_format($found, 0, '.', ',') . ' result' . $grammar . '.</p>' . $table . '</tbody></table></div>';
            } else if (input_validity() == 2) {
                echo '<p>No replays found.</p>';
            } else if (input_validity() == 1) {
                echo '<p>Invalid search. Please provide more than one character for the player name or shot name.</p>';
            } else {
                echo '<p>Invalid search. Please provide a search query.</p>';
            }
        }
    ?>
    <p><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
</div>
