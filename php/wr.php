<?php
global $API_BASE;
$MAX_SCORE = 9999999990;
$RECENT_LIMIT = isset($_COOKIE['recent_limit']) ? max(intval($_COOKIE['recent_limit']), 1) : 15;
$layout = (isset($_COOKIE['wr_old_layout']) ? 'Old' : 'New');

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

function date_tl($date, string $lang) {
    if (empty($date) || $date == '') {
        return _('Unknown');
    }
    $tmp = preg_replace('/-/', '/', $date);
    $tmp = preg_split('/\//', $tmp);
    $day = str_pad($tmp[2], 2, '0', STR_PAD_LEFT);
    $month = str_pad($tmp[1], 2, '0', STR_PAD_LEFT);
    $year = $tmp[0];
    if ($lang == 'raw') { // raw YMD; used for sorting
        return $year . $month . $day;
    } else if ($lang == 'en_US') {
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
    $result = _('World records are current as of <span id="lm">%date</span>.');
    return str_replace('%date', date_tl($lm, $lang), $result);
}

$last_modified = curl_get($API_BASE . '/api/v1/replay/?ordering=-date&date__isnull=False&type=Score&limit=1');
if (strpos($last_modified, 'Internal Server Error') === false) {
    $last_modified = json_decode($last_modified, true);
    $last_modified = $last_modified['results'][0]['date'];
} else {
    $last_modified = '';
}
$wrs = [];
$west = [];
$player_wrs = (object) [];
$player_games = (object) [];
$overall = (object) [];
$diff_max = (object) [];

$wr_data = curl_get($API_BASE . '/api/v1/replay/?ordering=game,difficulty,shot&type=Score&region=Eastern&verified=true');
$games_seen = [];
if (strpos($wr_data, 'Internal Server Error') === false) {
    $wr_data = json_decode($wr_data, true);
    foreach ($wr_data as $key => $data) {
        $score = $data['score'];
        $player = $data['player'];
        $date = $data['date'];
        $replay = $data['replay'];
        $video = $data['video'];
        $game = $data['category']['game'];
        $diff = $data['category']['difficulty'];
        $shot = $data['category']['shot'];
        if (!in_array($game, $games_seen)) {
            $wrs[$game] = [];
            $diffs_seen = [];
            $shots_seen = [];
            $overall->{$game} = 0;
            $diff_max->{$game} = (object) [];
            array_push($games_seen, $game);
        }
        if (!in_array($diff, $diffs_seen)) {
            $wrs[$game][$diff] = [];
            $diff_max->{$game}->{$diff} = [];
            array_push($diffs_seen, $diff);
        }
        if (!in_array($shot, $shots_seen)) {
            $wrs[$game][$diff][$shot] = [];
            array_push($shots_seen, $shot);
        }
        if (empty($wrs[$game][$diff][$shot]) || $score > $wrs[$game][$diff][$shot][0]) {
            $wrs[$game][$diff][$shot] = [$score, $player, $date];
            if (!isset($player_wrs->{$player})) {
                $player_wrs->{$player} = [];
            }
            array_push($player_wrs->{$player}, $game . $diff . $shot);
            if (!isset($player_games->{$player})) {
                $player_games->{$player} = [];
            }
            array_push($player_games->{$player}, $game);
        }
        if (!empty($replay)) {
            array_push($wrs[$game][$diff][$shot], $replay);
        } else {
            array_push($wrs[$game][$diff][$shot], '');
        }
        if (!empty($video)) {
            array_push($wrs[$game][$diff][$shot], $video);
        }
        if (empty($overall->{$game}) || $score >= $overall->{$game}['score']) {
            $overall->{$game} = $data;
        }
        if (empty($diff_max->{$game}->{$diff}) || $score >= $diff_max->{$game}->{$diff}['score']) {
            $diff_max->{$game}->{$diff} = $data;
            $diff_max->{$game}->{$diff}['shottype'] = $shot;
        }
    }
}

$west_data = curl_get($API_BASE . '/api/v1/replay/?ordering=game,difficulty&type=Score&region=Western');
$games_seen = [];
if (strpos($west_data, 'Internal Server Error') === false) {
    $west_data = json_decode($west_data, true);
    foreach ($west_data as $key => $data) {
        $score = $data['score'];
        $player = $data['player'];
        $game = $data['category']['game'];
        $diff = $data['category']['difficulty'];
        $shot = $data['category']['shot'];
        if (!in_array($game, $games_seen)) {
            $west[$game] = [];
            $diffs_seen = [];
            array_push($games_seen, $game);
        }
        if (!in_array($diff, $diffs_seen)) {
            $west[$game][$diff] = [];
            array_push($diffs_seen, $diff);
        }
        $west[$game][$diff] = [$score, $player, $shot];
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
    <p id='updaters'><?php echo _('For updates, you can contact <a href="https://twitter.com/MaribelHearn42" target="_blank">me</a> or <a href="https://www.youtube.com/@KirbyComment" target="_blank">KirbyComment</a>.') ?></p>
    <p id='lastupdate'><?php echo (!empty($last_modified) ? format_lm($last_modified, $lang) : '') ?></p>
    <h2><?php echo _('Contents') ?></h2>
    <?php
        // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
        if ($layout == 'New') {
            echo '<div id="contents_new" class="contents">' .
            '<p><a href="#overall" class="overallrecords">' . _('Overall Records') . '</a></p>' .
            '<p><a href="#wrs" class="worldrecords">' . _('World Records') . '</a></p>' .
            '<p><a href="#recent" >' . _('Recent Records') . '</a></p>' .
            '<p><a href="#players" class="playerranking">' . _('Player Ranking') . '</a></p>' .
            '</div><noscript>';
        }
        echo '<div class="contents">' .
        '<p><a href="#overall" class="overallrecords">' . _('Overall Records') . '</a></p>' .
        '<p><a href="#wrs" class="worldrecords">' . _('World Records') . '
        </a></p>';
        $games = curl_get($API_BASE . '/api/v1/game/');
        if (strpos($games, 'Internal Server Error') === false) {
            $games = json_decode($games, true);
            foreach ($games as $key => $data) {
                if ($data['short_name'] == 'UDoALG') {
                    continue;
                }
                echo '<p><a href="#' . $data['short_name'] . '">' . $data['full_name'] . '</a></p>';
            }
        }
        echo '<p id="westernlink"><a href="#western">' . _('Western Records') . '</a></p>';
        echo '<p id="playersearchlink"><a href="#playerwrs">' . _('Player Search') . '</a></p>';
        echo '<p><a href="#recent">' . _('Recent Records') . '</a></p>';
        echo '<p><a href="#players" class="playerranking">' . _('Player Ranking') . '</a></p></div>';
        if ($layout == 'New') {
            echo '</noscript>';
        }
    ?>
    <div id='checkboxes' class='contents'>
        <p>
            <label for='recent_limit'><?php echo _('Number of Recent Records') ?></label>
            <input id='recent_limit' type='number' value='<?php echo (isset($_COOKIE['recent_limit']) ? $_COOKIE['recent_limit'] : 15) ?>' min=1>
        </p><p>
            <input id='save_changes' type='button' value='<?php echo _('Save Changes') ?>'>
        </p>
    </div>
    <div id='overall'>
        <h2><?php echo _('Overall Records') ?></h2>
        <div class='overflow_mobile'><table class='sortable'>
            <thead>
                <tr>
                    <th id='game_number' class='general_header'>#</th>
                    <th class='general_header'><?php echo _('Game') ?></th>
                    <th id='score' class='general_header'><?php echo _('Score') ?></th>
                    <th class='general_header'><?php echo _('Player') ?></th>
                    <th class='general_header'><?php echo _('Difficulty') ?></th>
                    <th class='general_header'><?php echo _('Shottype') ?></th>
                    <th class='general_header'><?php echo _('Replay') ?></th>
                    <th class='general_header'><?php echo _('Video') ?></th>
                    <th class='general_header date'><?php echo _('Date') ?></th>
                </tr>
            </thead>
            <tbody><?php
                if (gettype($games) != 'string' || strpos($games, 'Internal Server Error') === false) {
                    foreach ($games as $key => $data) {
                        $game = $data['short_name'];
                        $num = $data['number'];
                        if ($game == 'UDoALG') {
                            continue;
                        }
                        $wr = $overall->{$game};
                        echo '<tr id="' . $game . 'o"><td' . ($num == 128 ? ' data-sort="12.8"' : '') . '>' . $num . '</td><td class="' . $game . '">' . _($game) . '</td>';
                        echo '<td id="' . $game . 'overall0" data-sort="' . $wr['score'] . '">' . ($game == 'WBaWC' || $game == 'UM'
                                ? '<span class="cs">9,999,999,990<span class="tooltip truescore">' . number_format($wr['score'], 0, '.', ',') . '</span></span> '
                                : number_format($wr['score'], 0, '.', ',')
                        ) . '</td>';
                        echo '<td id="' . $game . 'overall1">' . ($wr['score'] == 0 ? '-' : $wr['player']) . '</td>';
                        echo '<td id="' . $game . 'overall2">' . ($wr['score'] == 0 ? '-' : $wr['category']['difficulty']) . '</td>';
                        echo '<td id="' . $game . 'overall3">' . ($wr['score'] == 0 ? '-' : _($wr['category']['shot'])) . '</td>';
                        if (!empty($wr['replay'])) {
                            $chunks = preg_split('/\//', $wr['replay']);
                            $replay = '<a href="' . $wr['replay'] . '">' . $chunks[count($chunks) - 1] . '</a>';
                        } else {
                            $replay = '-';
                        }
                        if (!empty($wr['video'])) {
                            $video = '<a href="' . $wr['video'] . '" target="_blank">' . _('Link') . '</a>';
                        } else {
                            $video = '-';
                        }
                        echo '<td id="' . $game . 'overall4">' . $replay . '</td>';
                        echo '<td id="' . $game . 'overall5">' . $video . '</td>';
                        echo '<td id="' . $game . 'overall6" data-sort="' . date_tl($wr['date'], 'raw') . '">' . ($wr['score'] == 0 ? '-' : date_tl($wr['date'], $lang)) . '</td></tr>';
                    }
                }
			?></tbody>
        </table></div>
    </div>
    <h2 id='wrs'><?php echo _('World Records') ?></h2>
    <?php
        // With JavaScript disabled OR wr_old_layout cookie set, show classic all games layout
        if ($layout == 'New') {
            echo '<noscript>';
        }
        $sheet = '_1';
        $diff_key = 'Easy';
        foreach ($wrs as $game => $obj) {
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
                        $replay = $shots[$shot][3];
                        $video = empty($shots[$shot][4]) ? '' : $shots[$shot][4];
                    } else {
                        $score = 0;
                        $player = '';
                        $date = '';
                        $replay = '';
                        $video = '';
                    }
                    if ($game == 'GFW' && $diff == 'Extra') {
                        continue;
                    } else if ($game == 'HSiFS' && $diff == 'Extra') {
                        if (strpos($shot, 'Spring')) {
                            $shot = substr($shot, 0, -6);
                            $score_text = number_format($shots[$shot][0], 0, '.', ',');
                            if (isset($_COOKIE['prefer_video']) && !empty($video)) {
                                $score = '<a class="replay" href="' . $video . '" target="_blank">' . $score . '</a>';
                                echo '<td rowspan="4">' . $score_text . '<span class="dl_icon"></span>';
                            } else if (!empty($replay)) {
                                $score = '<a class="replay" href="' . $replay . '">' . $score . '</a>';
                                echo '<td rowspan="4">' . $score_text . '<span class="dl_icon"></span>';
                            } else if (!empty($video)) {
                                $score = '<a class="replay" href="' . $video . '" target="_blank">' . $score . '</a>';
                                echo '<td rowspan="4">' . $score_text . '<span class="dl_icon"></span>';
                            } else {
                                echo '<td rowspan="4">' . $score_text;
                            }
                            echo '<br>by <em>' . $shots[$shot][1] . '</em><span class="dimgrey"><br>' . date_tl($shots[$shot][2], $lang) . '</span></td>';
                        }
                    } else {
                        if ($score >= $MAX_SCORE) {
                            $score_text = '<span class="cs">' . number_format($MAX_SCORE, 0, '.', ',') . '<span class="tooltip">' . number_format($score, 0, '.', ',') . '</span></span>';
                        } else {
                            $score_text = number_format($score, 0, '.', ',');
                        }
                        if (isset($_COOKIE['prefer_video']) && !empty($video)) {
                            $score_text = '<a class="replay" href="' . $video . '" target="_blank">' . $score_text . '<span class="dl_icon"></span></a>';
                        } else if (!empty($replay)) {
                            $score_text = '<a class="replay" href="' . $replay . '">' . $score_text . '<span class="dl_icon"></span></a>';
                        } else if (!empty($video)) {
                            $score_text = '<a class="replay" href="' . $video . '" target="_blank">' . $score_text . '<span class="dl_icon"></span></a>';
                        }
                        if ($score == $overall->{$game}['score'] && $game != 'StB' && $game != 'DS') {
                            $score_text = '<strong>' . $score_text . '</strong>';
                        }
                        if ($score == $diff_max->{$game}->{$diff}['score'] && $game != 'StB' && $game != 'DS') {
                            $score_text = '<u>' . $score_text . '</u>';
                        }
                        if ($score == 0) {
                            echo '<td></td>';
                        } else {
                            echo '<td data-sort="' . $score . '">' . $score_text . '<br>by <em>' . $player . '</em><span class="dimgrey"><br>' . date_tl($date, $lang) . '</span></td>';
                        }
                    }
                }
                echo '</tr>';
            }
            if ($game == 'GFW') {
                $score = number_format($obj['Extra']['A1'][0], 0, '.', ',');
                if (!empty($replay)) {
                    $score = '<a class="replay" href="' .$replay . '">' . $score . '<span class="dl_icon"></span></a>';
                }
                echo '<tr><td>Extra</td><td colspan="4">' . $score . '<br>by <em>' . $obj['Extra']['A1'][1] .
                '</em><span class="dimgrey"><br>' . date_tl($obj['Extra']['A1'][2], $lang) . '</span></td></tr>';
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
                $world = $diff_max->{$game}->{$diff};
                if ($westt[0] == $world['score']) {
                    $percentage = 100;
                } else {
                    $percentage = number_format((float) $westt[0] / $world['score'] * 100, 2, '.', ',');
                }
                if ($world['score'] >= $MAX_SCORE) {
                    $world_text = '<abbr title="' . number_format($world['score'], 0, '.', ',') .
                    '">' . number_format($MAX_SCORE, 0, '.', ',') . '</abbr>';
                } else {
                    $world_text = number_format($world['score'], 0, '.', ',');
                }
                if ($westt[0] >= $MAX_SCORE) {
                    $west_text = '<abbr title="' . number_format($westt[0], 0, '.', ',') .
                    '">' . number_format($MAX_SCORE, 0, '.', ',') . '</abbr>';
                } else {
                    $west_text = number_format($westt[0], 0, '.', ',');
                }
                echo '<tr class="irregular_tr"><td colspan="3">' . $diff . '</td></tr>' .
                '<tr class="irregular_tr"><td>' . $world_text .
                '<br>by <em>' . $world['player'] . '</em><br>(' . _($world['shottype']) .
                ')</td><td>' . $west_text .
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
            if (gettype($games) != 'string' || strpos($games, 'Internal Server Error') === false) {
                foreach ($games as $key => $data) {
                    $game = $data['short_name'];
                    $full_name = $data['full_name'];
                    if ($game == 'UDoALG') {
                        continue;
                    }
                    if ($game == 'MoF') {
                        $second_row = true;
                        echo '<br>';
                    }
                    if (!$second_row) {
                        echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_1"></span>' .
                        '<span class="full_name tooltip">' . $full_name . '</span></span>';
                    } else {
                        echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_2"></span>' .
                        '<span class="full_name tooltip">' . $full_name . '</span></span>';
                    }
                }
            }
            echo '</div>';
        }
	?>
	<div id='wr_list'>
        <p id='fullname' class='center'></p>
        <section id='toggle_unverified'>
            <input id='unverified' type='checkbox'>
            <label id='label_unverified' for='unverified' class='unverified'><?php echo _('Unverified scores') ?></label>
            <br>
            <input id='toggle_video' type='checkbox'>
            <label id='label_video' for='toggle_video'><?php echo _('Link videos over replays') ?></label>
        </section>
        <div class='overflow_mobile'>
            <table id='world' class='sortable'>
                <thead id='world_thead'></thead>
                <tbody id='world_tbody'></tbody>
            </table>
        </div>
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
                    $players = curl_get($API_BASE . '/api/v1/replay/players/?region=Eastern&verified=true');
                    if (strpos($players, 'Internal Server Error') === false) {
                        $players = json_decode($players, true);
                        $players = $players['score'];
                        natcasesort($players);
                        foreach ($players as $key => $player) {
                            echo '<option value="' . $player . '">' . $player . '</option>';
                        }
                    }
                ?>
            </select>
        </section>
    </div>
	<div id='player_list' class='overflow_mobile'>
		<table class='sortable'>
			<thead id='player_thead'>
                <tr>
                    <th class='general_header'><?php echo _('Category')  ?></th>
                    <th class='general_header'><?php echo _('Score') ?></th>
                    <th class='general_header'><?php echo _('Shottype') ?></th>
                    <th class='general_header'><?php echo _('Replay') ?></th>
                    <th class='general_header'><?php echo _('Video') ?></th>
                    <th class='general_header'><?php echo _('Date') ?></th>
                </tr>
            </thead>
			<tbody id='player_tbody'></tbody>
			<tfoot id='player_tfoot'>
                <tr>
                    <td colspan='6'></td>
                </tr>
                <tr class='irregular_tr'>
                    <td><?php echo _('Total') ?></td>
                    <td id='player_sum' colspan='5'></td>
                </tr>
            </tfoot>
		</table>
	</div>
    <div id='recent'>
        <h2><?php echo _('Recent Records') ?></h2>
        <div class='overflow_mobile'>
            <table class='sortable'>
                <thead id='recenthead'><tr>
                    <th class='general_header'><?php echo _('Category')  ?></th>
                    <th class='general_header'><?php echo _('Score') ?></th>
                    <th class='general_header'><?php echo _('Player') ?></th>
                    <th class='general_header'><?php echo _('Replay') ?></th>
                    <th class='general_header'><?php echo _('Video') ?></th>
                    <th class='general_header'><?php echo _('Date') ?></th>
                </tr></thead>
                <tbody id='recentbody'><?php
                    $recent = curl_get($API_BASE . '/api/v1/replay/?limit=' . $RECENT_LIMIT . '&ordering=-date&type=Score&region=Eastern&verified=true');
                    if (strpos($recent, 'Internal Server Error') === false) {
                        $recent = json_decode($recent, true);
                        $recent = $recent['results'];
                        foreach ($recent as $key => $data) {
                            $date = date_tl($data['date'], $lang);
                            $date_raw = date_tl($data['date'], 'raw');
                            if (empty($data['replay'])) {
                                $replay = '-';
                            } else {
                                $chunks = preg_split('/\//', $data['replay']);
                                $replay = '<a href="' . $data['replay'] . '">' . $chunks[count($chunks) - 1] . '</a>';
                            }
                            if (empty($data['video'])) {
                                $video = '-';
                            } else {
                                $video = '<a href="' . $data['video'] . '">' . _('Link') . '</a>';
                            }
                            echo '<tr>';
                            echo '<td class="' . $data['category']['game'] . 'p">' . _($data['category']['game']) . _(' ') . _($data['category']['difficulty']) . _(' ') . _($data['category']['shot']) . '</td>';
                            echo '<td>' . number_format($data['score'], 0, '.', ',') . '</td>';
                            echo '<td>' . $data['player'] . '</td>';
                            echo '<td>' . $replay . '</td>';
                            echo '<td>' . $video . '</td>';
                            echo '<td data-sort="' . $date_raw . '">' . $date . '</td>';
                            echo '</tr>';
                        }
                    }
                ?></tbody>
            </table>
        </div>
    </div>
    <div id='players'>
        <h2><?php echo _('Player Ranking') ?></h2>
        <table id='ranking' class='sortable'>
            <thead>
                <tr>
					<th class='general_header no-sort'>#</th>
                    <th class='general_header'><?php echo _('Player') ?></th>
                    <th id='number_of_wrs' class='general_header sorttable_numeric'><?php echo _('No. of WRs') ?></th>
                    <th id='differentgames' class='general_header'><?php echo _('Different games') ?></th>
                </tr>
            </thead>
            <tbody>
				<?php
                    foreach ($player_wrs as $player => $count) {
                        $player_wrs->{$player} = count(array_unique($player_wrs->{$player}));
                        $player_games->{$player} = count(array_unique($player_games->{$player}));
                        echo '<tr><td></td>';
                        echo '<td><a href="#' . urlencode($player) . '">' . $player . '</a></td>';
                        echo '<td data-sort="' . $player_wrs->{$player} . '">' . $player_wrs->{$player} . '</td>';
                        echo '<td data-sort="' . $player_games->{$player} . '">' . $player_games->{$player} . '</td></tr>';
                    }
				?>
			</tbody>
        </table>
    </div>
    <footer><strong><a href='#top'><?php echo _('Back to Top') ?></a></strong></footer>
	<input id='diffs' type='hidden' value='<?php
		$diffs = '{';
		foreach ($games as $key => $data) {
            if ($data['short_name'] == 'UDoALG') {
                continue;
            }
			$diffs .= '"' . $data['short_name'] . '":[';
			foreach ($data['shots'][0]['categories'] as $key => $category) {
                if ($category['type'] == 'LNN') {
                    continue;
                }
                if ($category['region'] == 'Western') {
                    continue;
                }
				$diffs .= '"' . $category['difficulty'] . '",';
			}
            if ($data['short_name'] == 'HSiFS') {
                $diffs .= '"Extra",';
            }
			$diffs = substr($diffs, 0, -1) . '],';
		}
		echo substr($diffs, 0, -1) . '}';
	?>'>
	<input id='shots' type='hidden' value='<?php
		$shots = '{';
		foreach ($games as $key => $data) {
			$shots .= '"' . $data['short_name'] . '":[';
			foreach ($data['shots'] as $key => $shot) {
                if ($data['short_name'] == 'HSiFS' && strlen($shot['name']) <= 6) {
                    continue;
                }
				$shots .= '"' . $shot['name'] . '",';
			}
			$shots = substr($shots, 0, -1) . '],';
		}
		echo substr($shots, 0, -1) . '}';
	?>'>
</div>
