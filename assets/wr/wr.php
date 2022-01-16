<?php include_once 'assets/shared/tl.php'; include_once 'assets/wr/wr_code.php'; setlocale(LC_ALL, $locale); bindtextdomain($lang, 'locale'); textdomain($lang) ?>
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
    <p id='lastupdate'><?php echo format_lm($lm, $lang, $notation) ?></p>
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
            echo '<p><a href="#' . $game . '">' . _(full_name($game)) . '</a></p>';
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
	        <label id='label_dates' for='dates' class='dates'><?php echo _('Dates') ?></label>
        </p>
    </div>
    <div id='overall'>
        <h2 class='overallrecords'><?php echo _('Overall Records') ?></h2>
        <table class='sortable'>
            <tr>
                <th class='general_header'>#</th>
                <th class='general_header game'><?php echo _('Game') ?></th>
                <th id='score' class='general_header sorttable_numeric'><?php echo _('Score') ?></th>
                <th class='general_header player'><?php echo _('Player') ?></th>
                <th class='general_header difficulty'><?php echo _('Difficulty') ?></th>
                <th class='general_header shottype'><?php echo _('Shottype') ?></th>
                <th class='general_header date'><?php echo _('Date') ?></th>
            </tr>
            <?php
				foreach ($wr as $game => $value) {
                    if ($game == 'StB' || $game == 'DS') {
                        continue;
                    }
					$num = num($game);
					echo '<tr id="' . $game . 'o"><td>' . $num . '</td><td class="' . $game . '">' . _($game) . '</td>';
					echo '<td id="' . $game . 'overall0">' . ($game == 'WBaWC' || $game == 'UM' ? '<span class="cs">9,999,999,990' .
                    '<span class="tooltip truescore">' . number_format($overall[$num], 0, '.', ',') .
                    '</span></span> ' : number_format($overall[$num], 0, '.', ',')) . '</td>';
                    echo '<td id="' . $game . 'overall1">' . ($overall[$num] == 0 ? '-' : $overall_player[$num]) . ($game == 'WBaWC' || $game == 'UM' ? '*' : '') . '</td>';
					echo '<td id="' . $game . 'overall2">' . ($overall[$num] == 0 ? '-' : $overall_diff[$num]) . '</td>';
					echo '<td id="' . $game . 'overall3">' . ($overall[$num] == 0 ? '-' : _($overall_shottype[$num])) . '</td>';
					echo '<td id="' . $game . 'overall4" class="datestring">' . ($overall[$num] == 0 ? '-' : date_tl($overall_date[$num], $notation)) . '</td></tr>';
				}
			?>
        </table>
        <p>* Players that have scored 9,999,999,990:
            <?php
                $str = '';
                foreach ($cs as $player => $value) {
                    $str .= ', <span class="cs">' . $player . '<span class="tooltip truescores">';
                    if (gettype($value[0]) == 'array') {
                        $substr = '';
                        foreach ($value as $key => $val) {
                            $substr .= _($val[2]) . ($lang == 'en_US' ? ' ' : '') . $val[0] .
                            ($lang == 'en_US' ? ' (' : '（') . date_tl($val[1], $notation) .
                            ($lang == 'en_US' ? ')' : '）') . '<br>';
                        }
                        $str .= $substr;
                    } else {
                        $str .= _($value[2]) . ($lang == 'en_US' ? ' ' : '') . $value[0] .
                        ($lang == 'en_US' ? ' (' : '（') . date_tl($value[1], $notation) .
                        ($lang == 'en_US' ? ')' : '）') . '<br>';
                    }
                    $str .= '</span></span>';
                }
                echo substr($str, 2);
            ?>.
        </p>
    </div>
    <div id='overallm'>
        <h2 class='overallrecords'><?php echo _('Overall Records') ?></h2>
		<?php
            echo '<hr>';
			foreach ($wr as $game => $value) {
                if ($game == 'StB' || $game == 'DS') {
                    continue;
                }
				$num = num($game);
				echo '<p class="' . $game . '">' . _($game) . '</p><p>';
                echo '<span id="' . $game . 'overall0m">' . ($game == 'WBaWC' || $game == 'UM' ? '<span class="cs">9,999,999,990' .
                '<span class="tooltip truescore">' . number_format($overall[$num], 0, '.', ',') .
                '</span></span> ' : number_format($overall[$num], 0, '.', ',')) . '</span> ';
				echo '<span id="' . $game . 'overall2m">' . ($overall[$num] == 0 ? '-' : $overall_diff[$num]) . '</span> ';
				echo '<span id="' . $game . 'overall3m">' . ($overall[$num] == 0 ? '-' : _($overall_shottype[$num])) . '</span> by ';
				echo '<span id="' . $game . 'overall1m"><em>' . ($overall[$num] == 0 ? '-' : $overall_player[$num]) . ($game == 'WBaWC' || $game == 'UM' ? '*' : '') . '</em></span> ';
				echo '<br><span id="' . $game . 'overall4m" class="datestring_player">' . ($overall[$num] == 0 ? '-' : date_tl($overall_date[$num], $notation)) . '</span></p><hr>';
			}
            echo '<p>* Players that have scored 9,999,999,990: ';
            $str = '';
            foreach ($cs as $player => $value) {
                $str .= ', <abbr title="';
                if (gettype($value[0]) == 'array') {
                    $substr = '';
                    foreach ($value as $key => $val) {
                        $substr .= ', ' . $val[2] . ' ' . $val[0] . ' on ' . date_tl($val[1], $notation);
                    }
                    $str .= substr($substr, 2);
                } else {
                    $str .= $value[2] . ' ' . $value[0] . ' on ' . date_tl($value[1], $notation);
                }
                $str .= '">' . $player . '</abbr>';
            }
            echo substr($str, 2) . '</p>';
		?>
    </div>
    <h2 id='wrs' class='worldrecords'><?php echo _('World Records') ?></h2>
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
            echo '<table id="' . $game . '_table" class="' . $game .
            't sortable"><caption><p><span id="' . $game . '_image_old" ' .
            'class="cover sheet' . $sheet . (num($game) <= 5 ? ' cover98' : '') .
            '"></span> ' . _(full_name($game)) . '</p></caption>' .
            '<thead><tr><th>' . _(shot_route($game)) . '</th>';
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
                    } else {
                        $score = 0;
                        $player = '';
                        $date = '';
                    }
                    if ($game == 'GFW' && $diff == 'Extra') {
                        break;
                    } else if ($game == 'HSiFS' && $diff == 'Extra') {
                        if (strpos($shot, 'Spring')) {
                            $shot = substr($shot, 0, -6);
                            $score = number_format($shots[$shot][0], 0, '.', ',');
                            if (file_exists(replay_path($game, $diff, $shot))) {
                                $score = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score . '</a>';
                            }
                            echo '<td rowspan="4">' . $score . '<br>by <em>' . $shots[$shot][1] .
                            '</em><span class="dimgrey"><br><span class="datestring_game"' .
                            '>' . date_tl($shots[$shot][2], $notation) . '</span></span></td>';
                        }
                    } else {
                        if ($score >= $MAX_SCORE) {
                            $score_text = '<span class="cs">' . number_format($MAX_SCORE, 0, '.', ',') .
                            '<span class="tooltip">' . number_format($score, 0, '.', ',') . '</span></span>';
                        } else {
                            $score_text = number_format($score, 0, '.', ',');
                        }
                        if (file_exists(replay_path($game, $diff, $shot))) {
                            $score_text = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score_text . '</a>';
                        }
                        if ($score == $overall[num($game)] && $game != 'StB' && $game != 'DS') {
                            $score_text = '<strong>' . $score_text . '</strong>';
                        }
                        if ($score == $diff_max[$game][$diff][0] && $game != 'StB' && $game != 'DS') {
                            $score_text = '<u>' . $score_text . '</u>';
                        }
                        if ($score == 0) {
                            echo '<td></td>';
                        } else {
                            echo '<td>' . $score_text . '<br>by <em>' . $player . '</em><span class="dimgrey"><br>' .
                            '<span class="datestring_game">' . date_tl($date, $notation) . '</span></span></td>';
                        }
                    }
                }
                echo '</tr>';
            }
            if ($game == 'GFW') {
                $score = number_format($obj['Extra']['-'][0], 0, '.', ',');
                if (file_exists(replay_path($game, $diff, $shot))) {
                    $score = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score . '</a>';
                }
                echo '<tr><td>Extra</td><td colspan="4">' . $score . '<br>by <em>' . $obj['Extra']['-'][1] .
                '</em><span class="dimgrey"><br><span class="datestring_game">' . date_tl($obj['Extra']['-'][2], $notation) .
                '</span></span></td></tr>';
            }
            echo '</tbody></table></div>';
        }
        // Old layout western records
        echo '<h2 id="western">' . _('Western Records') . '</h2>';
        foreach ($west as $game => $obj) {
            echo '<table class="' . $game . 't"><tr class="west_tr"><th colspan="3">' . _($game) .
            '</th></tr><tr class="west_tr"><th>' . _('World') .
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
                echo '<tr class="west_tr"><td colspan="3">' . $diff . '</td></tr>' .
                '<tr class="west_tr"><td>' . $world_text .
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
                    '<span class="_ tooltip">' . _(full_name($game)) . '</span></span>';
                } else {
                    echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_2"></span>' .
                    '<span class="_ tooltip">' . _(full_name($game)) . '</span></span>';
                }
            }
            echo '</div>';
        }
	?>
	<div id='list'>
	</div>
    <div id='playersearch'>
		<?php echo '<h2>' . _('Player Search') . '</h2><p id="playerwrs">' . _('Choose a player name from the menu below to show their WRs.') . '</p>' ?>
		<label for='player' class='player'><?php echo _('Player') ?></label>
		<input id='player' list='autocomplete' type='text'>
        <datalist id='autocomplete'>
		    <?php
		        asort($pl);
		        foreach ($pl as $key => $player) {
		            echo '<option value="' . $player . '">';
		        }
		    ?>
        </datalist>
    </div>
	<div id='playerlist'>
		<table class='sortable'>
			<thead id='playerlisthead'><tr>
                <th class='category'><?php echo _('Category')  ?></th>
                <th class='score'><?php echo _('Score') ?></th>
                <th class='replay'><?php echo _('Replay') ?></th>
                <th class='datestring'><?php echo _('Date') ?></th>
            </tr></thead>
			<tbody id='playerlistbody'></tbody>
			<tfoot id='playerlistfoot'></tfoot>
		</table>
	</div>
    <div id='recent'>
        <h2><?php echo _('Recent Records') ?></h2>
        <table class='sortable'>
            <thead id='recenthead'><tr>
                <th class='general_header category'><?php echo _('Category')  ?></th>
                <th class='general_header score'><?php echo _('Score') ?></th>
                <th class='general_header player'><?php echo _('Player') ?></th>
                <th class='general_header replay'><?php echo _('Replay') ?></th>
                <th class='general_header datestring'><?php echo _('Date') ?></th>
            </tr></thead>
            <tbody id='recentbody'><?php
                foreach ($recent as $key => $obj) {
                    if (file_exists(replay_path($obj->game, $obj->diff, $obj->shot))) {
                        $path = replay_path($obj->game, $obj->diff, $obj->shot);
                        $replay = '<a href="' . $path . '">' . substr($path, 8) . '</a>';
                    } else if (!empty($obj->video)) {
						$replay = '<a href="' . $obj->video . '">YouTube link</a>';
					} else {
                        $replay = '-';
                    }
                    echo '<tr><td class="' . $obj->game . 'p">' . _($obj->game) . ($lang == 'en_US' || $lang == 'ru_RU' ? ' ' : '') .
					$obj->diff . ($lang == 'en_US' || $lang == 'ru_RU' ? ' ' : '') . _($obj->shot) . '</td>' .
                    '<td>' . number_format($obj->score, 0, '.', ',') . '</td><td>' . $obj->player . '</td>' .
                    '<td>' . $replay . '</td><td class="datestring">' . date_tl($obj->date, $notation) . '</td></tr>';
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
                echo '<p class="' . $obj->game . '">' . _($obj->game) . ($lang == 'en_US' || $lang == 'ru_RU' ? ' ' : '') .
				$obj->diff . ($lang == 'en_US' || $lang == 'ru_RU' ? ' ' : '') .
                '' . _($obj->shot) . '</p><p>' . number_format($obj->score, 0, '.', ',') .
                ' by <em>' . $obj->player . '</em><br><span class="datestring_player">' . date_tl($obj->date, $notation) . '</span></p>';
            }
        ?><hr>
    </div>
    <div id='players'>
        <h2 class='playerranking'><?php echo _('Player Ranking') ?></h2>
        <table id='ranking' class='sortable'>
            <thead>
                <tr>
					<th class='general_header head'>#</th>
                    <th class='general_header player'><?php echo _('Player') ?></th>
                    <th id='autosort' class='general_header sorttable_numeric'><?php echo _('No. of WRs') ?></th>
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
					foreach ($pl_wr as $key => $value) {
						if ($pl[$key] === '') {
							continue;
						}
						echo '<tr><td class="hidden"></td><td>' . $pl_wr[$key][0] . '</td>';
						echo '<td>' . $pl_wr[$key][1] . '</td>';
                        echo '<td>' . $pl_wr[$key][2] . '</td></tr>';
					}
				?>
			</tbody>
        </table>
    </div>
    <p id='back'><strong><a id='backtotop' href='#top'><?php echo _('Back to Top') ?></a></strong></p>
	<?php echo '<input id="missingReplays" type="hidden" value="' . implode('', $missing_replays) . '">' ?>
</div>
