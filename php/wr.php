<?php
include_once 'assets/shared/http.php';
$MAX_SCORE = 9999999990;
$RECENT_LIMIT = 10;
if (file_exists('assets/shared/json/wrlist.json')) {
    $json = file_get_contents('assets/shared/json/wrlist.json');
    $west_json = file_get_contents('assets/shared/json/bestinthewest.json');
} else {
    $json = curl_get('https://maribelhearn.com/assets/shared/json/wrlist.json');
    $west_json = curl_get('https://maribelhearn.com/assets/shared/json/bestinthewest.json');
    if ($json === false || $west_json === false) {
        die('Download failed!');
    }
}
$wr = json_decode($json, true);
$west = json_decode($west_json, true);
$layout = (isset($_COOKIE['wr_old_layout']) ? 'Old' : 'New');
$overall = array(0);
$overall_player = array(0);
$overall_diff = array(0);
$overall_shottype = array(0);
$overall_date = array(0);
$overall_video = array(0);
$missing_replays = array();
$diff_max = array();
$pl = array();
$pl_wr = array();
$flag = array();
$recent = array();
$lm = '0/0/0';

function pc_class(int $pc) {
    if ($pc < 50) {
        return 'does_not_even_score';
    } else if ($pc < 75) {
        return 'barely_even_scores';
    } else if ($pc < 90) {
        return 'moderately_even_scores';
    } else if ($pc < 100) {
        return 'does_even_score';
    } else {
        return 'does_even_score_well';
    }
}

function replay_path(string $game, string $diff, string $shot) {
    if ($game == 'StB') {
        $shot = '0' . $shot;
        if (strlen($diff) == 1) {
            $diff = '0' . $diff;
        }
    }
    return 'replays/th' . game_num($game) . '_ud' . substr($diff, 0, 2) . shot_abbr($shot) . '.rpy';
}

function date_tl(string $date, string $lang) {
    if ($date == '') {
        return '';
    }
    $tmp = preg_split('/\//', $date);
    $day = str_pad($tmp[0], 2, '0', STR_PAD_LEFT);
    $month = str_pad($tmp[1], 2, '0', STR_PAD_LEFT);
    $year = $tmp[2];
    if ($lang == 'en_US') {
        return $month . '/' . $day . '/' . $year;
    } else if ($lang == 'ja_JP' || $lang == 'zh_CN') {
        return $year . '年' . $month . '月' . $day . '日';
    } else if ($lang == 'ru_RU' || $lang == 'de_DE') {
        return $day . '.' . $month . '.' . $year;
    } else { // en_GB || es_ES
        return $day . '/' . $month . '/' . $year;
    }
}

function format_lm(string $lm, string $lang) {
    switch ($lang) {
        case 'ja_JP': return '<span id="lm">' . date_tl($lm, $lang) . '</span>現在の世界記録です。';
        case 'zh_CN': return '世界记录更新于<span id="lm">' . date_tl($lm, $lang) . '</span>。';
        case 'ru_RU': return 'Рекорды актуальны на <span id="lm">' . date_tl($lm, $lang) . '</span>.';
        case 'de_DE': return 'Die Weltrekorde sind ab <span id="lm">' . date_tl($lm, $lang) . '</span> aktuell.';
        case 'es_ES': return 'Los Récords Mundiales están actualizados hasta el <span id="lm">' . date_tl($lm, $lang) . '</span>.';
        default: return 'World records are current as of <span id="lm">' . date_tl($lm, $lang) . '</span>.';
    }
}

function is_later_date(string $date1, string $date2) {
    if (strpos($date1, '?')) {
        return false;
    }

    $date1 = preg_split('/\//', $date1);
    $date2 = preg_split('/\//', $date2);
    $year = $date1[2]; $month = $date1[1]; $day = $date1[0];
    $cond1 = $year > $date2[2];
    $cond2 = $year == $date2[2] && $month > $date2[1];
    $cond3 = $year == $date2[2] && $month == $date2[1] && $day >= $date2[0];
    return $cond1 || $cond2 || $cond3;
}

foreach ($wr as $game => $value) {
    $num = game_num($game);
    $overall[$num] = 0;
    $flag = array_fill(0, sizeof($flag), true);
    $diff_max[$game] = array();
    foreach ($wr[$game] as $diff => $value) {
        $diff_max[$game][$diff] = [0, '', ''];
        foreach ($wr[$game][$diff] as $shot => $array) {
            $score = $array[0];
            $player = $array[1];
            $date = $array[2];
            $video = empty($array[3]) ? '' : $array[3];
            if ($score >= $overall[$num]) {
                $overall[$num] = $score;
                $overall_diff[$num] = $diff;
                $overall_shottype[$num] = $shot;
                $overall_player[$num] = $player;
                $overall_date[$num] = $date;
                $overall_video[$num] = $video;
            }
            if ($score > $diff_max[$game][$diff][0]) {
                $diff_max[$game][$diff] = [$score, $player, $shot];
            }
            if (!file_exists(replay_path($game, $diff, $shot)) && $num > 5) {
                array_push($missing_replays, ($game . $diff . $shot));
            }
            if (!in_array($player, $pl)) {
                array_push($pl, $player);
                array_push($pl_wr, array($player, 1, 1));
                array_push($flag, false);
            } else {
                $key = array_search($array[1], $pl);
                $pl_wr[$key][1] += 1;
                if ($flag[$key]) {
                    $pl_wr[$key][2] += 1;
                    $flag[$key] = false;
                }
            }
            if (is_later_date($date, $lm)) {
                $lm = $date;
            }
            if (count($recent) < $RECENT_LIMIT) {
                $new_obj = (object) [
                    'game' => $game,
                    'diff' => $diff,
                    'shot' => $shot,
                    'score' => $score,
                    'player' => $player,
                    'date' => $date,
                    'video' => $video,
                ];
                array_push($recent, $new_obj);
            } else {
                foreach ($recent as $key => $obj) {
                    if (is_later_date($date, $obj->date)) {
                        $new_obj = (object) [
                            'game' => $game,
                            'diff' => $diff,
                            'shot' => $shot,
                            'score' => $score,
                            'player' => $player,
                            'date' => $date,
                            'video' => $video,
                        ];
                        for ($i = $RECENT_LIMIT - 1; $i > $key; $i--) {
                            $recent[$i] = $recent[$i - 1];
                        }
                        $recent[$key] = $new_obj;
                        break;
                    }
                }
            }
        }
    }
}
?>
<div id='wrap' class='wrap'>
	<?php echo wrap_top() ?>
    <p id='description'><?php
        echo _('An accurate list of Touhou world records, updated every so often. ' .
        'Note that the player ranking at the bottom does not take into account how strong specific records are, '.
        'only numbers. The list does not include scene games as of now.');
    ?></p>
    <p id='clicktodl'><?php
        echo _('Click a score to download the corresponding replay, if there is one available. ') .
        _('All of the table columns are sortable.');
    ?></p>
    <p id='noreup'><?php
        echo _('The replays provided are <strong>not</strong> meant to be reuploaded to any replay uploading services.');
    ?></p>
    <p id='unver'><?php
        echo _('If you toggle Unverified Scores, this will show scores that are higher than the World Record, but lack replay or video proof.');
    ?></p>
    <p id='lastupdate'><?php echo format_lm($lm, $lang) ?></p>
    <h2><?php echo _('Contents') ?></h2>
    <?php
        // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
        if ($layout == 'New') {
            echo '<div id="contents_new" class="contents"><p id="overall_link"><a href="#overall" ' .
            'class="overallrecords">' . _('Overall Records') . '</a></p>' .
            '<p id="overall_linkm"><a href="#overallm" class="overallrecords">' . _('Overall Records') .
            '</a></p><p><a href="#wrs" class="worldrecords">' . _('World Records') . '
            </a></p><p id="recent_link"><a href="#recent" >' . _('Recent Records') .
            '</a></p><p id="recent_linkm"><a href="#recentm">' . _('Recent Records') .
            '</a></p><p><a href="#players" class="playerranking">' . _('Player Ranking') .
            '</a></p></div><noscript>';
        }
        echo '<div class="contents"><p id="overall_linkn"><a href="#overall" ' .
        'class="overallrecords">' . _('Overall Records') . '</a></p>' .
        '<p id="overall_linkmn"><a href="#overallm" class="overallrecords">' . _('Overall Records') .
        '</a></p><p><a href="#wrs" class="worldrecords">' . _('World Records') . '
        </a></p>';
        foreach ($wr as $game => $value) {
            echo '<p><a href="#' . $game . '">' . full_name($game) . '</a></p>';
        }
        echo '<p id="westernlink"><a href="#western">' . _('Western Records') . '</a></p>';
        echo '<p id="playersearchlink"><a href="#playerwrs">' . _('Player Search') . '</a></p>';
        echo '<p id="recent_linkn"><a href="#recent">' . _('Recent Records') .
        '</a></p>';
        echo '<p id="recent_linkmn"><a href="#recentm">' . _('Recent Records') .
        '</a></p>';
        echo '<p><a href="#players" class="playerranking">' . _('Player Ranking') . '</a></p></div>';
        if ($layout == 'New') {
            echo '</noscript>';
        }
    ?>
    <div id='checkboxes' class='contents'>
        <p>
            <input id='dates' type='checkbox'>
	        <label for='dates'><?php echo _('Dates') ?></label>
        </p><p>
            <input id='toggle_video' type='checkbox'>
            <label for='toggle_video'><?php echo _('Show videos over replays') ?></label>
        </p>
    </div>
    <div id='overall'>
        <h2><?php echo _('Overall Records') ?></h2>
        <table class='sortable'>
            <thead>
                <tr>
                    <th class='general_header'>#</th>
                    <th class='general_header'><?php echo _('Game') ?></th>
                    <th id='score' class='general_header'><?php echo _('Score') ?></th>
                    <th class='general_header'><?php echo _('Player') ?></th>
                    <th class='general_header'><?php echo _('Difficulty') ?></th>
                    <th class='general_header'><?php echo _('Shottype') ?></th>
                    <th class='general_header date no-sort'><?php echo _('Date') ?></th>
                    <th class='general_header'><?php echo _('Replay') ?></th>
                </tr>
            </thead>
            <tbody><?php
				foreach ($wr as $game => $value) {
                    if ($game == 'StB' || $game == 'DS') {
                        continue;
                    }
					$num = game_num($game);
					echo '<tr id="' . $game . 'o"><td' . ($num == 128 ? ' data-sort="12.8"' : '') . '>' . $num . '</td><td class="' . $game . '">' . _($game) . '</td>';
					echo '<td id="' . $game . 'overall0" data-sort="' . $overall[$num] . '">' . ($game == 'WBaWC' || $game == 'UM'
                            ? '<span class="cs">9,999,999,990<span class="tooltip truescore">' . number_format($overall[$num], 0, '.', ',') . '</span></span> '
                            : number_format($overall[$num], 0, '.', ',')
                    ) . '</td>';
                    echo '<td id="' . $game . 'overall1">' . ($overall[$num] == 0 ? '-' : $overall_player[$num]) . '</td>';
					echo '<td id="' . $game . 'overall2">' . ($overall[$num] == 0 ? '-' : $overall_diff[$num]) . '</td>';
					echo '<td id="' . $game . 'overall3">' . ($overall[$num] == 0 ? '-' : _($overall_shottype[$num])) . '</td>';
					echo '<td id="' . $game . 'overall4" class="datestring">' . ($overall[$num] == 0 ? '-' : date_tl($overall_date[$num], $lang)) . '</td>';
                    if (isset($_COOKIE['prefer_video']) && !empty($overall_video[$num])) {
						$replay = '<a href="' . $overall_video[$num] . '" target="_blank">Video link</a>';
					} else if (file_exists(replay_path($game, $overall_diff[$num], $overall_shottype[$num]))) {
                        $path = replay_path($game, $overall_diff[$num], $overall_shottype[$num]);
                        $replay = '<a href="' . $path . '">' . substr($path, 8) . '</a>';
                    } else if (!empty($overall_video[$num])) {
                        $replay = '<a href="' . $overall_video[$num] . '" target="_blank">Video link</a>';
                    } else {
                        $replay = '-';
                    }
					echo '<td id="' . $game . 'overall5">' . $replay . '</td></tr>';
				}
			?></tbody>
        </table>
    </div>
    <div id='overallm'>
        <h2><?php echo _('Overall Records') ?></h2>
		<?php
            echo '<hr>';
			foreach ($wr as $game => $value) {
                if ($game == 'StB' || $game == 'DS') {
                    continue;
                }
				$num = game_num($game);
				echo '<p class="' . $game . '">' . _($game) . '</p><p>';
                echo '<span id="' . $game . 'overall0m">' . ($game == 'WBaWC' || $game == 'UM' ? '<span class="cs">9,999,999,990' .
                '<span class="tooltip truescore">' . number_format($overall[$num], 0, '.', ',') .
                '</span></span> ' : number_format($overall[$num], 0, '.', ',')) . '</span> ';
				echo '<span id="' . $game . 'overall2m">' . ($overall[$num] == 0 ? '-' : $overall_diff[$num]) . '</span> ';
				echo '<span id="' . $game . 'overall3m">' . ($overall[$num] == 0 ? '-' : _($overall_shottype[$num])) . '</span> by ';
				echo '<span id="' . $game . 'overall1m"><em>' . ($overall[$num] == 0 ? '-' : $overall_player[$num]) . '</em></span> ';
				echo '<br><span id="' . $game . 'overall4m" class="datestring_player">' . ($overall[$num] == 0 ? '-' : date_tl($overall_date[$num], $lang)) . '</span></p><hr>';
			}
		?>
    </div>
    <h2 id='wrs'><?php echo _('World Records') ?></h2>
    <?php
        // With JavaScript disabled OR wr_old_layout cookie set, show classic all games layout
        if ($layout == 'New') {
            echo '<noscript>';
        }
        $sheet = '_1';
        $diff_key = 'Easy';
        foreach ($wr as $game => $obj) {
            if ($game == 'MoF' || $game == 'GFW') {
                $sheet = '_2';
                $diff_key = 'Easy';
            } else if ($game == 'StB' || $game == 'DS') {
                $diff_key = '1';
            }
            echo '<div id="' . $game . '">';
            echo '<table id="' . $game . '_table" class="' . $game . 't' . ($game != 'HSiFS' ? ' sortable' : '') . '">' .
            '<caption><p><span id="' . $game . '_image_old" class="cover sheet' . $sheet . (game_num($game) <= 5 ? ' cover98' : '') . '"></span> ' . full_name($game) . '</p></caption>' .
            '<thead><tr><th>' . shot_route($game) . '</th>';
            foreach ($obj as $diff => $shots) {
                if ($game != 'GFW' || $diff != 'Extra') {
                    echo '<th>' . $diff . '</th>';
                }
            }
            echo '</tr></thead><tbody>';
            for ($i = 0; $i < sizeof($obj[$diff_key]); $i++) {
                $shot = array_keys($obj[$diff_key])[$i];
                echo '<tr><td>' . format_shot($game, $shot) . '</td>';
                for ($j = 0; $j < sizeof($obj); $j++) {
                    $diff = array_keys($obj)[$j];
                    $shots = $obj[array_keys($obj)[$j]];
                    if (isset($shots[$shot])) {
                        $score = $shots[$shot][0];
                        $player = $shots[$shot][1];
                        $date = $shots[$shot][2];
                        $video = empty($shots[$shot][3]) ? '' : $shots[$shot][3];
                    } else {
                        $score = 0;
                        $player = '';
                        $date = '';
                        $video = '';
                    }
                    if ($game == 'GFW' && $diff == 'Extra') {
                        break;
                    } else if ($game == 'HSiFS' && $diff == 'Extra') {
                        if (strpos($shot, 'Spring')) {
                            $shot = substr($shot, 0, -6);
                            $score_text = number_format($shots[$shot][0], 0, '.', ',');
                            if (isset($_COOKIE['prefer_video']) && !empty($video)) {
                                $score = '<a class="replay" href="' . $video . '" target="_blank">' . $score . '</a>';
                                echo '<td rowspan="4">' . $score_text . '<span class="dl_icon"></span>';
                            } else if (file_exists(replay_path($game, $diff, $shot))) {
                                $score = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score . '</a>';
                                echo '<td rowspan="4">' . $score_text . '<span class="dl_icon"></span>';
                            } else if (!empty($video)) {
                                $score = '<a class="replay" href="' . $video . '" target="_blank">' . $score . '</a>';
                                echo '<td rowspan="4">' . $score_text . '<span class="dl_icon"></span>';
                            } else {
                                echo '<td rowspan="4">' . $score_text;
                            }
                            echo '<br>by <em>' . $shots[$shot][1] . '</em><span class="dimgrey"><br>' .
                            '<span class="datestring_game">' . date_tl($shots[$shot][2], $lang) . '</span></span></td>';
                        }
                    } else {
                        if ($score >= $MAX_SCORE) {
                            $score_text = '<span class="cs">' . number_format($MAX_SCORE, 0, '.', ',') . '<span class="tooltip">' . number_format($score, 0, '.', ',') . '</span></span>';
                        } else {
                            $score_text = number_format($score, 0, '.', ',');
                        }
                        if (isset($_COOKIE['prefer_video']) && !empty($video)) {
                            $score_text = '<a class="replay" href="' . $video . '" target="_blank">' . $score_text . '<span class="dl_icon"></span></a>';
                        } else if (file_exists(replay_path($game, $diff, $shot))) {
                            $score_text = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score_text . '<span class="dl_icon"></span></a>';
                        } else if (!empty($video)) {
                            $score_text = '<a class="replay" href="' . $video . '" target="_blank">' . $score_text . '<span class="dl_icon"></span></a>';
                        }
                        if ($score == $overall[game_num($game)] && $game != 'StB' && $game != 'DS') {
                            $score_text = '<strong>' . $score_text . '</strong>';
                        }
                        if ($score == $diff_max[$game][$diff][0] && $game != 'StB' && $game != 'DS') {
                            $score_text = '<u>' . $score_text . '</u>';
                        }
                        if ($score == 0) {
                            echo '<td></td>';
                        } else {
                            echo '<td data-sort="' . $score . '">' . $score_text . '<br>by <em>' . $player . '</em><span class="dimgrey"><br>' .
                            '<span class="datestring_game">' . date_tl($date, $lang) . '</span></span></td>';
                        }
                    }
                }
                echo '</tr>';
            }
            if ($game == 'GFW') {
                $score = number_format($obj['Extra']['-'][0], 0, '.', ',');
                if (file_exists(replay_path($game, $diff, $shot))) {
                    $score = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score . '<span class="dl_icon"></span></a>';
                }
                echo '<tr><td>Extra</td><td colspan="4">' . $score . '<br>by <em>' . $obj['Extra']['-'][1] .
                '</em><span class="dimgrey"><br><span class="datestring_game">' . date_tl($obj['Extra']['-'][2], $lang) .
                '</span></span></td></tr>';
            }
            echo '</tbody></table></div>';
        }
        // Old layout western records
        echo '<h2 id="western">' . _('Western Records') . '</h2>';
        foreach ($west as $game => $obj) {
            echo '<table class="' . $game . 't"><tr class="irregular_tr"><th colspan="3">' . _($game) .
            '</th></tr><tr class="irregular_tr"><th>' . _('World') .
            '</th><th>' . _('West') . '</th><th>' . _('Percentage') . '</th></tr>';
            foreach ($obj as $diff => $shots) {
                $westt = $west[$game][$diff];
                $world = $diff_max[$game][$diff];
                if ($westt[0] == $world[0]) {
                    $percentage = 100;
                } else {
                    $percentage = number_format((float) $westt[0] / $world[0] * 100, 2, '.', ',');
                }
                if ($world[0] >= $MAX_SCORE) {
                    $world_text = '<abbr title="' . number_format($world[0], 0, '.', ',') .
                    '">' . number_format($MAX_SCORE, 0, '.', ',') . '</abbr>';
                } else {
                    $world_text = number_format($world[0], 0, '.', ',');
                }
                echo '<tr class="irregular_tr"><td colspan="3">' . $diff . '</td></tr>' .
                '<tr class="irregular_tr"><td>' . $world_text .
                '<br>by <em>' . $world[1] . '</em><br>(' . _($world[2]) .
                ')</td><td>' . number_format($westt[0], 0, '.', ',') .
                '<br>by <em>' . $westt[1] . '</em><br>(' . (empty($westt[2]) ? $westt[2] : _($westt[2])) .
                ')</td><td class="' . pc_class($percentage) . '">(' . $percentage . '%)</td></tr>';
            }
            echo '</table>';
        }
        if ($layout == 'New') {
            echo '</noscript>';
        }
        // With wr_old_layout cookie NOT set, show game image layout (CSS hides it with JavaScript disabled)
        if ($layout == 'New') {
            echo '<div id="newlayout"><p id="clickgame">' . _('Click a game cover to show its list of world records.') . '</p>';
            $second_row = false;
		    foreach ($wr as $game => $value) {
                if ($game == 'MoF') {
                    $second_row = true;
                    echo '<br>';
                }
                if (!$second_row) {
                    echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_1"></span>' .
                    '<span class="_ tooltip">' . full_name($game) . '</span></span>';
                } else {
                    echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_2"></span>' .
                    '<span class="_ tooltip">' . full_name($game) . '</span></span>';
                }
            }
            echo '</div>';
        }
	?>
	<div id='wr_list'>
        <p id='fullname' class='center'></p>
        <section id='toggle_season'>
            <input id='seasons' type='checkbox'>
            <label id='label_seasons' for='seasons'><?php echo _('Seasons') ?></label>
        </section>
        <section id='toggle_unverified'>
            <input id='unverified' type='checkbox'>
            <label id='label_unverified' for='unverified' class='unverified'><?php echo _('Unverified Scores') ?></label>
        </section>
        <table id='world' class='sortable'>
            <thead id='world_thead'></thead>
            <tbody id='world_tbody'></tbody>
        </table>
        <table id='west'>
            <thead id='west_thead'>
                <tr class='irregular_tr'>
                    <th><?php echo _('World') ?></th>
                    <th><?php echo _('West') ?></th>
                    <th><?php echo _('Percentage') ?></th>
                </tr>
            </thead>
            <tbody id='west_tbody'></tbody>
        </table>
	</div>
    <div id='player_search'>
		<h2><?php echo _('Player Search') ?></h2>
        <p id='playerwrs' class='center'><?php echo _('Choose a player name from the menu below to show their WRs.') ?></p>
        <section>
            <label for='player'><?php echo _('Player') ?></label>
            <input id='player' type='text'>
            <label class='hidden' for='search'><?php echo _('Search') ?></label>
            <select id='search'>
                <option value=''>...</option>
                <?php
                    natcasesort($pl);
                    foreach ($pl as $key => $player) {
                        echo '<option value="' . $player . '">' . $player . '</option>';
                    }
                ?>
            </select>
        </section>
    </div>
	<div id='player_list'>
		<table class='sortable'>
			<thead id='player_thead'>
                <tr>
                    <th class='general_header'><?php echo _('Category')  ?></th>
                    <th class='general_header'><?php echo _('Score') ?></th>
                    <th class='general_header'><?php echo _('Shottype') ?></th>
                    <th class='general_header'><?php echo _('Replay') ?></th>
                    <th class='general_header datestring'><?php echo _('Date') ?></th>
                </tr>
            </thead>
			<tbody id='player_tbody'></tbody>
			<tfoot id='player_tfoot'>
                <tr>
                    <td colspan='5'></td>
                </tr>
                <tr class='irregular_tr'>
                    <td><?php echo _('Total') ?></td>
                    <td id='player_sum' colspan='4'></td>
                </tr>
            </tfoot>
		</table>
	</div>
    <div id='recent'>
        <h2><?php echo _('Recent Records') ?></h2>
        <table class='sortable'>
            <thead id='recenthead'><tr>
                <th class='general_header'><?php echo _('Category')  ?></th>
                <th class='general_header'><?php echo _('Score') ?></th>
                <th class='general_header'><?php echo _('Player') ?></th>
                <th class='general_header'><?php echo _('Replay') ?></th>
                <th class='general_header datestring'><?php echo _('Date') ?></th>
            </tr></thead>
            <tbody id='recentbody'><?php
                foreach ($recent as $key => $obj) {
                    if (isset($_COOKIE['prefer_video']) && !empty($obj->video)) {
                        $replay = '<a href="' . $obj->video . '" target="_blank">Video link</a>';
                    } else if (file_exists(replay_path($obj->game, $obj->diff, $obj->shot))) {
                        $path = replay_path($obj->game, $obj->diff, $obj->shot);
                        $replay = '<a href="' . $path . '">' . substr($path, 8) . '</a>';
                    } else if (!empty($obj->video)) {
						$replay = '<a href="' . $obj->video . '" target="_blank">Video link</a>';
					} else {
                        $replay = '-';
                    }
                    $space = (has_space($lang) ? ' ' : '');
                    echo '<tr><td class="' . $obj->game . 'p">' . _($obj->game) . $space . $obj->diff . $space . _($obj->shot) . '</td>' .
                    '<td data-sort="' . $obj->score . '">' . number_format($obj->score, 0, '.', ',') . '</td><td>' . $obj->player . '</td>' .
                    '<td>' . $replay . '</td><td class="datestring">' . date_tl($obj->date, $lang) . '</td></tr>';
                }
            ?></tbody>
        </table>
    </div>
    <div id='recentm'>
        <h2><?php echo _('Recent Records') ?></h2>
        <?php
            foreach ($recent as $key => $obj) {
                echo '<hr>';
                if (file_exists(replay_path($obj->game, $obj->diff, $obj->shot))) {
                    $path = replay_path($obj->game, $obj->diff, $obj->shot);
                    $replay = '<a href="' . $path . '">' . substr($path, 8) . '</a>';
                } else {
                    $replay = '-';
                }
                $space = (has_space($lang) ? ' ' : '');
                echo '<p class="' . $obj->game . '">' . _($obj->game) . $space . $obj->diff . $space . _($obj->shot) . '</p>' .
                '<p>' . number_format($obj->score, 0, '.', ',') . ' by <em>' . $obj->player . '</em><br>' .
                '<span class="datestring_player">' . date_tl($obj->date, $lang) . '</span></p>';
            }
        ?><hr>
    </div>
    <div id='players'>
        <h2><?php echo _('Player Ranking') ?></h2>
        <table id='ranking' class='sortable'>
            <thead>
                <tr>
					<th class='general_header no-sort'>#</th>
                    <th class='general_header'><?php echo _('Player') ?></th>
                    <th class='general_header sorttable_numeric'><?php echo _('No. of WRs') ?></th>
                    <th id='differentgames' class='general_header'><?php echo _('Different games') ?></th>
                </tr>
            </thead>
            <tbody>
				<?php
                    uasort($pl_wr, function($a, $b) {
                        $val = $b[1] <=> $a[1];
                        if ($val == 0) {
                            $val = $b[2] <=> $a[2];
                        }
                        return $val;
                    });
                    $count = 0;
					foreach ($pl_wr as $key => $value) {
						if ($pl[$key] === '') {
							continue;
						}
						echo '<tr><td></td>';
                        echo '<td><a href="#' . $pl_wr[$key][0] . '">' . $pl_wr[$key][0] . '</a></td>';
						echo '<td>' . $pl_wr[$key][1] . '</td>';
                        echo '<td>' . $pl_wr[$key][2] . '</td></tr>';
					}
				?>
			</tbody>
        </table>
    </div>
    <footer><strong><a href='#top'><?php echo _('Back to Top') ?></a></strong></footer>
	<?php echo '<input id="missing_replays" type="hidden" value="' . implode('', $missing_replays) . '">' ?>
</div>
