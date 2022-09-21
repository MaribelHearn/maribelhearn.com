<?php include_once 'assets/games/wr/wr_code.php' ?>
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
    <h2 id='contents_header'><?php echo _('Contents') ?></h2>
    <?php
        // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
        if ($layout == 'New') {
            echo '<div id="contents_new" class="border"><p id="overall_link"><a href="#overall" ' .
            'class="overallrecords">' . _('Overall Records') . '</a></p>' .
            '<p id="overall_linkm"><a href="#overallm" class="overallrecords">' . _('Overall Records') .
            '</a></p><p><a href="#wrs" class="worldrecords">' . _('World Records') . '
            </a></p><p id="recent_link"><a href="#recent" class="recentrecords">' . _('Recent Records') .
            '</a></p><p id="recent_linkm"><a href="#recentm" class="recentrecords">' . _('Recent Records') .
            '</a></p><p><a href="#players" class="playerranking">' . _('Player Ranking') .
            '</a></p></div><noscript>';
        }
        echo '<div id="contents" class="border"><p id="overall_linkn"><a href="#overall" ' .
        'class="overallrecords">' . _('Overall Records') . '</a></p>' .
        '<p id="overall_linkmn"><a href="#overallm" class="overallrecords">' . _('Overall Records') .
        '</a></p><p><a href="#wrs" class="worldrecords">' . _('World Records') . '
        </a></p>';
        foreach ($wr as $game => $value) {
            echo '<p><a href="#' . $game . '">' . full_name($game) . '</a></p>';
        }
        echo '<p id="westernlink"><a href="#western">' . _('Western Records') . '</a></p>';
        echo '<p id="playersearchlink"><a href="#playerwrs">' . _('Player Search') . '</a></p>';
        echo '<p id="recent_linkn"><a href="#recent" class="recentrecords">' . _('Recent Records') .
        '</a></p>';
        echo '<p id="recent_linkmn"><a href="#recentm" class="recentrecords">' . _('Recent Records') .
        '</a></p>';
        echo '<p><a href="#players" class="playerranking">' . _('Player Ranking') . '</a></p></div>';
        if ($layout == 'New') {
            echo '</noscript>';
        }
    ?>
    <div id='checkboxes' class='border'>
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
        <p id='fullname'></p>
        <p id='toggle_season'>
            <input id='seasons' type='checkbox'>
            <label id='label_seasons' for='seasons'><?php echo _('Seasons') ?></label>
        </p>
        <p id='toggle_unverified'>
            <input id='unverified' type='checkbox'>
            <label id='label_unverified' for='unverified' class='unverified'><?php echo _('Unverified Scores') ?></label>
        </p>
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
    <div id='playersearch'>
		<h2><?php echo _('Player Search') ?></h2>
        <p id='playerwrs'><?php echo _('Choose a player name from the menu below to show their WRs.') ?></p>
		<label for='player'><?php echo _('Player') ?></label>
		<select id='player'>
            <option value=''>...</option>
            <?php
                natcasesort($pl);
                foreach ($pl as $key => $player) {
                    echo '<option value="' . $player . '">' . $player . '</option>';
                }
		    ?>
        </select>
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
                        echo '<td>' . $pl_wr[$key][0] . '</td>';
						echo '<td>' . $pl_wr[$key][1] . '</td>';
                        echo '<td>' . $pl_wr[$key][2] . '</td></tr>';
					}
				?>
			</tbody>
        </table>
    </div>
    <p id='back'><strong><a id='backtotop' href='#top'><?php echo _('Back to Top') ?></a></strong></p>
	<?php echo '<input id="missing_replays" type="hidden" value="' . implode('', $missing_replays) . '">' ?>
</div>
