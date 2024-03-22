<?php
include_once 'php/shared/http.php';
$ALL_LNN = 101;
$ALL_GAME_LNN = 13;
$RECENT_LIMIT = isset($_COOKIE['recent_limit']) ? max(intval($_COOKIE['recent_limit']), 1) : 15;
if (file_exists('json/lnnlist.json')) {
    $json = file_get_contents('json/lnnlist.json');
    $video_json = file_get_contents('json/lnnvideos.json');
} else {
    $json = curl_get('https://maribelhearn.com/json/lnnlist.json');
    $video_json = curl_get('https://maribelhearn.com/json/lnnvideos.json');
    if ($json === false || $video_json === false) {
        die('Download failed!');
    }
}
if (isset($_GET['date'])) {
    $date_limit = preg_replace('/\//', '-', $_GET['date']);
}
$pvp = ['PoDD', 'UDoALG'];
$lnn = json_decode($json, true);
$lnn_videos = json_decode($video_json, true);
$layout = (isset($_COOKIE['lnn_old_layout']) ? 'Old' : 'New');
$pl = array();
$pl_lnn = array();
$flag = array();
$missing_replays = array();
$video_lnns = array();
$recent = array();

function lnn_type(string $game, string $lang) {
    switch ($game) {
        case 'PCB': return _('No. of LNNNs');
        case 'IN': return _('No. of LNNFSs');
        case 'UFO': return _('No. of LNN(N)s');
        case 'TD': return _('No. of LNNNs');
        case 'HSiFS': return _('No. of LNNNs');
        case 'WBaWC': return _('No. of LNNNNs');
        case 'UM': return _('No. of LNNNs');
        default: return _('No. of LNNs');
    }
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
    $result = _('LNNs are current as of <span id="lm">%date</span>.');
    return str_replace('%date', date_tl($lm, $lang), $result);
}

function is_later_date(string $date1, string $date2) {
    if (empty($date1) || empty($date2)) {
        return true;
    }

    $date2 = preg_replace('/-/', '/', $date2);
    $date1 = preg_split('/\//', $date1);
    $date2 = preg_split('/\//', $date2);
    $year = $date1[2]; $month = $date1[1]; $day = $date1[0];
    $cond1 = $year > $date2[2];
    $cond2 = $year == $date2[2] && $month > $date2[1];
    $cond3 = $year == $date2[2] && $month == $date2[1] && $day > $date2[0];
    return $cond1 || $cond2 || $cond3;
}

function replay_path(string $game, string $player, string $shot) {
    $ALPHA_NUMS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $char = preg_replace('/(FinalA|FinalB|UFOs)/i', '', $shot);
    $type = str_replace($char, '', $shot);
    $folder = str_replace(' ', '', $player);
    $first = $player[0];
    $last = $player[strlen($player) - 1];
    $player = preg_replace('/[^a-z\d ]/i', '', $player);
    if (!preg_match('/[a-z\d ]/i', $player)) {
        if ($first == $last) {
            $first = $ALPHA_NUMS[mb_strlen($folder) - 1];
            $last = ($type !== "" ? $type[mb_strlen($type) - 1] : $ALPHA_NUMS[mb_strlen($folder) - 1]);
        } else {
            $first = $ALPHA_NUMS[mb_strlen($folder) - 1];
            $last = ($type !== "" ? $type[mb_strlen($type) - 1] : $ALPHA_NUMS[mb_strlen($folder)]);
        }
    } else {
        $first = $player[0];
        $last = ($type !== "" ? $type[strlen($type) - 1] : $player[strlen($player) - 1]);
    }
    return 'replays/lnn/' . $folder . '/th' . game_num($game) . '_ud' . $first . $last . shot_abbr($char) . '.rpy';
}

$gt = 0;
foreach ($lnn as $game => $data1) {
    if ($game == 'LM') {
        continue;
    }
    $sum = 0;
    $flag = array_fill(0, sizeof($flag), true);
    foreach ($data1 as $shottype => $data2) {
        foreach ($data2 as $player => $date) {
            if (isset($date_limit) && is_later_date($date, $date_limit)) {
                unset($lnn[$game][$shottype][$player]);
                unset($data2[$player]);
                continue;
            }
            $nospaces = str_replace(' ', '', $player);
            if (!file_exists(replay_path($game, $nospaces, $shottype)) && game_num($game) > 5) {
                array_push($missing_replays, ($game . $shottype . $nospaces));
            }
            if (!in_array($player, $pl)) {
                array_push($pl, $player);
                array_push($flag, false);
                if (!in_array($game, $pvp)) {
                    array_push($pl_lnn, array($player, 1, 1));
                }
            } else if (!in_array($game, $pvp)) {
                $key = array_search($player, $pl);
                $pl_lnn[$key][1] += 1;
                if ($flag[$key]) {
                    $pl_lnn[$key][2] += 1;
                    $flag[$key] = false;
                }
            }
            if (!empty($lnn_videos[$game][$shottype][$player])) {
                $video = $lnn_videos[$game][$shottype][$player];
                array_push($video_lnns, $game . $shottype . $nospaces . ';' . $video);
            } else {
                $video = '';
            }
            // add to recent LNNs if dated
            if (!empty($date)) {
                array_push($recent, (object) [
                    'game' => $game,
                    'shot' => $shottype,
                    'player' => $player,
                    'date' => $date,
                    'video' => $video,
                ]);
            }
        }
        $sum += sizeof($data2);
    }
    if (!in_array($game, $pvp)) {
        $gt += $sum;
    }
}
$missing_runs = $missing_replays;
for ($i = 0; $i < sizeof($video_lnns); $i++) {
    $entry = preg_split('/;/', $video_lnns[$i])[0];
    if (in_array($entry, $missing_runs)) {
        $key = array_search($entry, $missing_runs);
        unset($missing_runs[$key]);
    }
}
// sort recent LNNs by date
usort($recent, fn($a, $b) => is_later_date($a->date, $b->date) ? -1 : 1);
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p id='description'><?php
        echo _('A list of Touhou Lunatic No Miss No Bomb (LNN) runs, updated every so often. ' .
        'For every shottype in a game, tables will tell you which players have done an LNN with it, if any. ' .
        'If a player has multiple LNNs for one particular shottype, those are not factored in.');
	?></p>
    <p id='conditions'><?php
        echo _('Extra conditions are required for PCB, TD, HSiFS, WBaWC and UM; these are No Border Breaks for PCB, ' .
        'No Trance for TD, No Release for HSiFS, No Berserk Roar No Roar Breaks for WBaWC and No Cards for UM. ' .
        'LNN in these games is called LNNN or LNNNN, with extra Ns to denote the extra conditions. ' .
        'The extra condition in UFO, no UFO summons, is optional, as it is not considered to have a significant ' .
        'impact on the difficulty of the run. As for IN, an LNN is assumed to capture all Last Spells and '.
        'is referred to as LNNFS.');
	?></p>
    <p id='tables'><?php echo _('All of the table columns are sortable.') ?></p>
    <p id='lastupdate'><?php echo (isset($lnn['LM']) ? format_lm($lnn['LM'], $lang) : '') ?></p>
    <h2><?php echo _('Contents') ?></h2>
    <?php
        // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
        if ($layout == 'New') {
            echo '<div id="contents_new" class="contents"><p><a href="#lnns" class="lnns">' . _('LNN Lists') .
            '</a></p><p><a href="#player_search">' . _('Player Search') .
            '</a></p><p><a href="#recent">' . _('Recent LNNs') .
            '</a></p><p><a href="#overall">' . _('Overall Count') .
            '</a></p><p><a href="#players">' . _('Player Ranking') .
            '</a></p></div><noscript>';
        }
        echo '<div class="contents"><p><a href="#lnns">' . _('LNN Lists') . '</a></p>';
        foreach ($lnn as $game => $obj) {
            if ($game == 'LM') {
                continue;
            }
            echo '<p><a href="#' . $game . '">' . full_name($game) . '</a></p>';
        }
        echo '<p><a href="#player_search">' . _('Player Search') .
        '</a></p><p><a href="#recent">' . _('Recent LNNs') .
        '</a></p><p><a href="#overall">' . _('Overall Count') .
        '</a></p><p><a href="#players">' . _('Player Ranking') .
        '</a></p></div>';
        if ($layout == 'New') {
            echo '</noscript>';
        }
    ?>
    <div id='checkboxes' class='contents'>
        <p>
            <input id='toggle_video' type='checkbox'>
            <label for='toggle_video'><?php echo _('Show videos over replays') ?></label>
        </p><p>
            <label for='recent_limit'><?php echo _('Number of Recent LNNs') ?></label>
            <input id='recent_limit' type='number' value='<?php echo (isset($_COOKIE['recent_limit']) ? $_COOKIE['recent_limit'] : 15) ?>' min=1>
        </p><p>
            <input id='save_changes' type='button' value='<?php echo _('Save Changes') ?>'>
        </p>
    </div>
    <h2 id='lnns'><?php echo _('LNN Lists') ?></h2>
    <?php
        // With JavaScript disabled OR lnn_old_layout cookie set, show classic all games layout
        if ($layout == 'New') {
            echo '<noscript>';
        }
        $sheet = '_1';
        foreach ($lnn as $game => $shots) {
            if ($game == 'LM') {
                continue;
            }
            if ($game == 'MoF' || $game == 'GFW') {
                $sheet = '_2';
            }
            $sum = 0;
            $all = array();
            echo '<div id="' . $game . '"><p><table id="' . $game . 't" class="' . $game . 't">' .
            '<caption><span id="' . $game . '_image_old" class="cover sheet' . $sheet . (game_num($game) <= 5 ? ' cover98' : '') . '"></span> ' . full_name($game) . '</caption>' .
            '<thead><tr><th class="general_header">' . shot_route($game) . '</th>' .
            '<th class="general_header nowrap">' . lnn_type($game, $lang) . '<br>' . _('(Different players)') . '</th>' .
            '<th class="general_header">' . _('Players') . '</tr></thead><tbody>';
            foreach ($shots as $shot => $obj) {
                if (strpos($shot, 'UFOs')) {
                    continue;
                }
                $players = array_keys($obj);
                $count = sizeof($players);
                $sum += $count;
                $all = array_merge($all, $players);
                if ($game == 'UFO') {
                    $count += sizeof($shots[$shot . 'UFOs']);
                }
                sort($players);
                echo '<tr><td class="nowrap">' . format_shot($game, $shot) . '</td><td>' . $count . '</td><td>' . implode(', ', $players);
                if ($game == 'UFO') {
                    $players = array_keys($shots[$shot . 'UFOs']);
                    $sum += sizeof($players);
                    $all = array_merge($all, $players);
                    for ($i = 0; $i < sizeof($players); $i++) {
                        $players[$i] .= ' (UFOs)';
                    }
                    sort($players);
                    echo (sizeof($players) > 0 ? ', ' : '') . implode(', ', $players);
                }
                echo '</td></tr>';
            }
            $all = array_unique($all);
            sort($all);
            echo '</tbody><tfoot><tr><td class="foot">' . _('Overall') . '</td><td class="foot">' . $sum . ' (' . sizeof($all) . ')</td>' .
            '<td class="foot">' . implode(', ', $all) . '</td></tr></tfoot></table></div>';
        }
        if ($layout == 'New') {
            echo '</noscript>';
        }
        // With lnn_old_layout cookie NOT set, show game image layout (CSS hides it with JavaScript disabled)
        if ($layout == 'New') {
            echo '<div id="newlayout"><p id="clickgame">' . _('Click a game cover to show its list of LNNs.') . '</p>';
            $second_row = false;
		    foreach ($lnn as $game => $value) {
		        if ($game == 'LM' || in_array($game, $pvp)) {
		            continue;
	            }
                if ($game == 'MoF') {
                    $second_row = true;
                    echo '<br>';
                }
                if (!$second_row) {
                    echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_1"></span>' .
                    '<span class="full_name tooltip">' . full_name($game) . '</span></span>';
                } else {
                    echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_2"></span>' .
                    '<span class="full_name tooltip">' . full_name($game) . '</span></span>';
                }
		    }
            echo '<br><br>';
            foreach ($pvp as $key => $game) {
                echo '<span class="game_image"><span id="' . $game . '_image" class="game_img ' . ($game == 'UDoALG' ? 'sheet_2' : 'sheet_1') . '"></span>' .
                '<span class="full_name tooltip">' . full_name($game) . '</span></span>';
            }
            echo '</div>';
            echo '<div id="lnn_list"><p id="fullname" class="center"></p><table id="lnn_table">';
            echo '<thead id="lnn_thead"><tr><th id="lnn_shotroute" class="general_header">' . _('Shottype') . '</th>';
            echo '<th class="general_header nowrap"><span id="lnn_restrictions"></span><br>' . _('(Different players)') . '</th>';
            echo '<th class="general_header">' . _('Players') . '</th>';
            echo '</tr></thead><tbody id="lnn_tbody"></tbody><tfoot id="lnn_tfoot"><tr>';
            echo '<td id="lnn_overall" class="foot">' . _('Overall') . '</td><td id="count" class="foot"></td><td id="total" class="foot"></td></tr></tfoot></table>';
            echo '</div>';
        }
    ?>
    <div id='player_search'>
        <h2><?php echo _('Player Search'); ?></h2>
		<p id='playerlnns'><?php echo _('Choose a player name from the menu below to show their LNNs.') ?></p>
		<label for='player'><?php echo _('Player') ?></label>
        <input id='player' type='text'>
        <label id='search_label' for='search'><?php echo _('Search') ?></label>
		<select id='search'>
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
		<table class='sortable asc'>
			<thead id='player_thead'><tr>
                <th class='general_header'><?php echo _('Game') ?></th>
                <th class='general_header'><?php echo _('Shottype') ?></th>
                <th class='general_header'><?php echo _('Replay') ?></th>
                <th class='general_header'><?php echo _('Date') ?></th>
            </tr></thead>
			<tbody id='player_tbody'></tbody>
			<tfoot id='player_tfoot'>
                <tr>
                    <td colspan='4'></td>
                </tr>
                <tr class='irregular_tr'>
                    <td><?php echo _('Total') ?></td>
                    <td id='player_sum' colspan='3'></td>
                </tr>
            </tfoot>
		</table>
	</div>
    <div id='recent'>
        <h2><?php echo _('Recent LNNs') ?></h2>
        <table class='sortable'>
            <thead id='recenthead'><tr>
                <th class='general_header'><?php echo _('Category')  ?></th>
                <th class='general_header'><?php echo _('Player') ?></th>
                <th class='general_header'><?php echo _('Replay') ?></th>
                <th class='general_header'><?php echo _('Date') ?></th>
            </tr></thead>
            <tbody id='recentbody'><?php
                $i = 0;
                foreach ($recent as $key => $obj) {
                    if (isset($_COOKIE['prefer_video']) && !empty($obj->video)) {
                        $replay = '<a href="' . $obj->video . '" target="_blank">Video link</a>';
                    } else if (file_exists(replay_path($obj->game, $obj->player, $obj->shot))) {
                        $path = replay_path($obj->game, $obj->player, $obj->shot);
                        $path_parts = preg_split('/\//', $path);
                        $replay = '<a href="' . $path . '">' . $path_parts[3] . '</a>';
                    } else if (!empty($obj->video)) {
						$replay = '<a href="' . $obj->video . '" target="_blank">Video link</a>';
					} else {
                        $replay = '-';
                    }
                    $space = (has_space($lang) ? ' ' : '');
                    $shot = preg_replace('/(FinalA|FinalB|UFOs)/', '', $obj->shot);
                    $type = str_replace($shot, '', $obj->shot);
                    echo '<tr>' .
                    '<td class="' . $obj->game . 'p">' . _($obj->game) . $space . _($shot) . (!empty($type) ? $space . _($type) : '') . '</td>' .
                    '<td>' . $obj->player . '</td>' .
                    '<td>' . $replay . '</td>' .
                    '<td data-sort="' . date_tl($obj->date, 'raw') . '">' . date_tl($obj->date, $lang) . '</td>' .
                    '</tr>';
                    $i++;
                    if ($i == $RECENT_LIMIT) {
                        break;
                    }
                }
            ?></tbody>
        </table>
    </div>
    <div id='overall'>
        <h2><?php echo _('Overall Count'); ?></h2>
        <table class='sortable'>
            <thead>
                <tr>
                    <th class='general_header'>#</th>
                    <th class='general_header'><?php echo _('Game') ?></th>
                    <th class='general_header'><?php echo _('No. of LNNs') ?></th>
                    <th class='general_header'><?php echo _('Different players') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($lnn as $game => $data1) {
                        if ($game == 'LM' || in_array($game, $pvp)) {
                            continue;
                        }
                        $sum = 0;
                        $game_pl = array();
                        foreach ($lnn[$game] as $shottype => $data2) {
                            foreach ($lnn[$game][$shottype] as $player => $date) {
                                if (!in_array($player, $game_pl)) {
                                    array_push($game_pl, $player);
                                }
                            }
                            $sum += sizeof($lnn[$game][$shottype]);
                        }
                        if (game_num($game) < 6 || $sum > 0) {
                            echo '<tr><td' . (game_num($game) == 128 ? ' data-sort="12.8"' : '') . '>' . game_num($game) . '</td><td class="' . $game . '">' . _($game) . '</td>';
                            echo '<td>' . $sum . '</td><td>' . sizeof($game_pl) . '</td></tr>';
                        }
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class='foot' colspan='2'><?php echo _('Overall'); ?></td>
                    <td class='foot'><?php echo $gt ?></td>
                    <td class='foot'><?php echo sizeof($pl_lnn) ?></td>
                </tr>
                <tr>
                    <td colspan='2'><?php echo _('Replays'); ?></td>
                    <td colspan='2'><?php echo $gt - sizeof($missing_runs); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div id='players'>
        <h2><?php echo _('Player Ranking'); ?></h2>
        <table id='ranking' class='sortable'>
            <thead>
                <tr>
                    <th class='general_header no-sort'>#</th>
                    <th class='general_header'><?php echo _('Player'); ?></th>
                    <th class='general_header'><?php echo _('No. of LNNs'); ?></th>
                    <th class='general_header'><?php echo _('Games LNN\'d'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    uasort($pl_lnn, function($a, $b) {
                        $val = $b[1] <=> $a[1];
                        if ($val == 0) {
                            $val = $b[2] <=> $a[2];
                        }
                        return $val;
                    });
                    foreach ($pl_lnn as $key => $value) {
                        $shot_lnns = $pl_lnn[$key][1] == $ALL_LNN ? $pl_lnn[$key][1] . _(' (All Windows)') : $pl_lnn[$key][1];
                        $game_lnns = $pl_lnn[$key][2] >= $ALL_GAME_LNN ? $pl_lnn[$key][2] . _(' (All Windows)') : $pl_lnn[$key][2];
                        echo '<tr><td></td>';
                        echo '<td><a href="#' . $pl_lnn[$key][0] . '">' . $pl_lnn[$key][0] . '</a></td>';
                        echo '<td data-sort="' . $pl_lnn[$key][1] . '">' . $shot_lnns . '</td>';
                        echo '<td data-sort="' . $pl_lnn[$key][2] . '">' . $game_lnns . '</td></tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <footer><strong><a href='#top'><?php echo _('Back to Top'); ?></a></strong></footer>
	<?php echo '<input id="missing_replays" type="hidden" value="' . implode('', $missing_replays) . '">' ?>
	<?php echo '<input id="videos" type="hidden" value="' . implode(',', $video_lnns) . '">' ?>
</div>
