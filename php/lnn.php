<?php
global $API_BASE;

$games = curl_get($API_BASE . '/api/v1/game/');
if (strpos($games, 'Internal Server Error') !== false) {
    $_GET['error'] = 500;
    include_once('php/error.php');
    include_once('php/shared/postscript.php');
    die();
} else if (strpos($games, 'Service Unavailable') !== false) {
    $_GET['error'] = 503;
    include_once('php/error.php');
    include_once('php/shared/postscript.php');
    die();
} else {
    $games = json_decode($games, true);
}

$ALL_LNN = 101;
$WINDOWS_LNN = ['EoSD', 'PCB', 'IN', 'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLK', 'HSiFS', 'WBaWC', 'UM'];
$RECENT_LIMIT = isset($_COOKIE['recent_limit']) ? max(intval($_COOKIE['recent_limit']), 1) : 15;
$layout = (isset($_COOKIE['lnn_old_layout']) ? 'Old' : 'New');
$pvp = ['PoDD', 'UDoALG'];
$number_of_lnns = (object) [];
$number_of_players = (object) [];
$player_lnns = (object) [];
$player_games = (object) [];
$pvp_full_names = [];
$total_players = 0;
$missing_runs = 0;

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
    $result = _('LNNs are current as of <span id="lm">%date</span>.');
    return str_replace('%date', date_tl($lm, $lang), $result);
}

$last_modified = curl_get($API_BASE . '/api/v1/replay/?ordering=-date&date__isnull=False&type=LNN&limit=1');
$last_modified = json_decode($last_modified, true);
$last_modified = $last_modified['results'][0]['date'];

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
    <p id='updaters'><?php echo _('For updates, you can contact <a href="https://bsky.app/profile/maribelhearn42.bsky.social" target="_blank">me</a>, <a href="https://hoangcaominh.github.io/#/profile" target="_blank">Hoàng Cao Minh</a>, ' .
            '<a href="https://www.youtube.com/@valivanvan" target="_blank">crazy4pokemon</a> or <a href="https://www.youtube.com/@allenko1122" target="_blank">AllenKO</a>.') ?></p>
    <p id='last_modified'><?php echo (!empty($last_modified) ? format_lm($last_modified, $lang) : '') ?></p>
    <h2><?php echo _('Contents') ?></h2>
    <?php
        // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
        if ($layout == 'New') {
            echo '<div id="contents_new" class="contents"><p><a href="#lnns" class="lnns">' . _('LNN Lists') .
            '</a></p><p><a href="#search">' . _('Search') .
            '</a></p><p><a href="#recent">' . _('Recent LNNs') .
            '</a></p><p><a href="#overall">' . _('Overall Count') .
            '</a></p><p><a href="#players">' . _('Player Statistics') .
            '</a></p></div><noscript>';
        }
        echo '<div class="contents"><p><a href="#lnns">' . _('LNN Lists') . '</a></p>';
        $games = curl_get($API_BASE . '/api/v1/game/');
        if (strpos($games, 'Internal Server Error') === false) {
            $games = json_decode($games, true);
            foreach ($games as $key => $data) {
                echo '<p><a href="#' . $data['short_name'] . '">' . $data['full_name'] . '</a></p>';
            }
        }
        echo '<p><a id="searchlink" href="#search">' . _('Search') .
        '</a></p><p><a href="#recent">' . _('Recent LNNs') .
        '</a></p><p><a href="#overall">' . _('Overall Count') .
        '</a></p><p><a href="#players">' . _('Player Statistics') .
        '</a></p></div>';
        if ($layout == 'New') {
            echo '</noscript>';
        }
    ?>
    <div id='checkboxes' class='contents'>
        <p>
            <label for='recent_limit'><?php echo _('Number of Recent LNNs') ?></label>
            <input id='recent_limit' type='number' value='<?php echo (isset($_COOKIE['recent_limit']) ? $_COOKIE['recent_limit'] : 15) ?>' min=1>
        </p><p>
            <input id='save_changes' type='button' value='<?php echo _('Save Changes') ?>'>
        </p>
    </div>
    <h2 id='lnns'><?php echo _('LNN Lists') ?></h2>
    <?php
        // With lnn_old_layout cookie set, show classic all games layout
        if ($layout == 'New') {
            echo '<noscript>';
        }
        $sheet = '_1';
        $lnn = curl_get($API_BASE . '/api/v1/replay/?ordering=game,shot&type=LNN');
        $games_seen = [];
        $lnn = json_decode($lnn, true);
        foreach ($lnn as $key => $data) {
            $player = $data['player'];
            $game = $data['category']['game'];
            $shot = $data['category']['shot'];
            $route = $data['category']['route'];
            if ($game == 'MoF' || $game == 'GFW') {
                $sheet = '_2';
            }
            if (!in_array($game, $games_seen)) {
                if (!empty($games_seen)) {
                    $players_shot = array_unique($players_shot);
                    sort($players_shot);
                    echo '<td>' . count($players_shot) . '</td><td>' . implode(', ', $players_shot) . '</td></tr>';
                    $prev_game = end($games_seen);
                    $number_of_lnns->{$prev_game} = count($players_game);
                    $players_game = array_unique($players_game);
                    $number_of_players->{$prev_game} = count($players_game);
                    sort($players_game);
                    echo '</tbody><tfoot><tr><td class="foot">' . _('Overall') . '</td><td class="foot">' . $number_of_lnns->{$prev_game} . ' (' . $number_of_players->{$prev_game} . ')</td>' .
                    '<td class="foot">' . implode(', ', $players_game) . '</td></tr></tfoot></table></div>';
                }
                array_push($games_seen, $game);
                $shots_seen = [];
                $players_game = [];
                echo '<div id="' . $game . '"><p><table id="' . $game . 't" class="' . $game . 't">' .
                '<caption><span id="' . $game . '_image_old" class="cover sheet' . $sheet . (game_num($game) <= 5 ? ' cover98' : '') . '"></span> ' . full_name($game) . '</caption>' .
                '<thead><tr><th class="general_header">' . shot_route($game) . '</th>' .
                '<th class="general_header nowrap">' . lnn_type($game, $lang) . '<br>' . _('(Different players)') . '</th>' .
                '<th class="general_header">' . _('Players') . '</tr></thead><tbody>';
            }
            if (!in_array($shot, $shots_seen)) {
                if (!empty($shots_seen)) {
                    $players_shot = array_unique($players_shot);
                    sort($players_shot);
                    echo '<td>' . count($players_shot) . '</td><td>' . implode(', ', $players_shot) . '</td></tr>';
                }
                array_push($shots_seen, $shot);
                $players_shot = [];
                echo '<tr><td class="nowrap">' . format_shot($game, $shot) . '</td>';
            }
            if (!in_array($game, $pvp)) {
                if (!isset($player_lnns->{$player})) {
                    $player_lnns->{$player} = 1;
                    $player_games->{$player} = [$game];
                    $total_players += 1;
                } else {
                    $player_lnns->{$player} += 1;
                    array_push($player_games->{$player}, $game);
                }
            }
            if ($route == 'UFOs') {
                array_push($players_shot, $player . ' (UFOs)');
            } else {
                array_push($players_shot, $player);
            }
            array_push($players_game, $player);
            if (empty($data['replay']) && empty($data['video'])) {
                $missing_runs += 1;
            }
        }
        $players_shot = array_unique($players_shot);
        sort($players_shot);
        echo '<td>' . count($players_shot) . '</td><td>' . implode(',', $players_shot) . '</td></tr>';
        $number_of_lnns->{$game} = count($players_game);
        $players_game = array_unique($players_game);
        $number_of_players->{$game} = count($players_game);
        sort($players_game);
        echo '</tbody><tfoot><tr><td class="foot">' . _('Overall') . '</td><td class="foot">' . $number_of_lnns->{$game} . ' (' . $number_of_players->{$game} . ')</td>' .
        '<td class="foot">' . implode(', ', $players_game) . '</td></tr></tfoot></table></div>';
        if ($layout == 'New') {
            echo '</noscript>';
        }
        // With lnn_old_layout cookie NOT set, show game image layout
        if ($layout == 'New') {
            echo '<div id="newlayout"><p id="clickgame">' . _('Click a game cover to show its list of LNNs.') . '</p>';
            $second_row = false;
            foreach ($games as $key => $data) {
                $game = $data['short_name'];
                $full_name = full_name($data['short_name']);
                if (in_array($game, $pvp)) {
                    array_push($pvp_full_names, $full_name);
                    continue;
                }
                if ($game == 'PoFV') {
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
            echo '<br><br>';
            foreach ($pvp as $key => $game) {
                echo '<span class="game_image"><span id="' . $game . '_image" class="game_img ' . ($game == 'UDoALG' ? 'sheet_2' : 'sheet_1') . '"></span>' .
                '<span class="full_name tooltip">' . $pvp_full_names[$key] . '</span></span>';
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
    <div id='search'>
        <h2><?php echo _('Search'); ?></h2>
		<p id='playerlnns'><?php echo _('Choose a player or category from the menus below to show their LNNs.') ?></p>
        <div id='player_search' class='center'>
            <label for='player'><?php echo _('Player') ?></label>
            <input id='player' type='text'>
            <label class='search_label' for='search_player'><?php echo _('Search') ?></label>
            <select id='search_player'>
                <option value=''>...</option>
                <?php
                    $players = curl_get($API_BASE . '/api/v1/replay/players/');
                    $players = json_decode($players, true);
                    $players = $players['lnn'];
                    natcasesort($players);
                    foreach ($players as $key => $player) {
                        if ($player == '-') {
                            continue;
                        }
                        echo '<option value="' . $player . '">' . $player . '</option>';
                    }
                ?>
            </select>
        </div>
        <div id='category_search' class='center'>
            <label for='category'><?php echo _('Category') ?></label>
            <input id='category' type='text'>
            <label class='search_label' for='search_category'><?php echo _('Search') ?></label>
            <select id='search_category'>
                <option value=''>...</option>
                <?php
                    $categories = curl_get($API_BASE . '/api/v1/category/?type=LNN&region=Eastern');
                    $categories = json_decode($categories, true);
                    foreach ($categories as $key => $category) {
                        $category_id = $category['game'] . ' ' . $category['shot'];
                        $category_name = _($category['game']) . ' ' . _($category['shot']);
                        if (!empty($category['route'])) {
                            $category_id .= ' ' . $category['route'];
                            $category_name .= ' ' . _($category['route']);
                        }
                        echo '<option value="' . $category_id . '">' . $category_name . '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
	<div id='search_results'>
		<table id='search_table' class='sortable asc'>
			<thead id='search_thead'><tr>
                <th id='first_header' class='general_header'><?php echo _('Game') ?></th>
                <th id='second_header' class='general_header'><?php echo _('Shottype') ?></th>
                <th class='general_header'><?php echo _('Replay') ?></th>
                <th class='general_header'><?php echo _('Video') ?></th>
                <th class='general_header'><?php echo _('Date') ?></th>
            </tr></thead>
			<tbody id='search_tbody'></tbody>
			<tfoot id='search_tfoot'>
                <tr>
                    <td colspan='5'></td>
                </tr>
                <tr class='irregular_tr'>
                    <td><?php echo _('Total') ?></td>
                    <td id='search_sum' colspan='4'></td>
                </tr>
            </tfoot>
		</table>
	</div>
    <p id='empty_player' class='center'><?php echo _('No such player.'); ?></p>
    <p id='empty_category' class='center'><?php echo _('There are currently no LNNs in that category.'); ?></p>
    <div id='recent'>
        <h2><?php echo _('Recent LNNs') ?></h2>
        <table class='sortable'>
            <thead id='recenthead'><tr>
                <th class='general_header'><?php echo _('Category')  ?></th>
                <th class='general_header'><?php echo _('Player') ?></th>
                <th class='general_header no_mobile'><?php echo _('Replay') ?></th>
                <th class='general_header'><?php echo _('Video') ?></th>
                <th class='general_header'><?php echo _('Date') ?></th>
            </tr></thead>
            <tbody id='recentbody'><?php
                $recent = curl_get($API_BASE . '/api/v1/replay/?limit=' . $RECENT_LIMIT . '&ordering=-date&date__isnull=False&type=LNN');
                $recent = json_decode($recent, true);
                $recent = $recent['results'];
                foreach ($recent as $key => $data) {
                    if (empty($data['date'])) {
                        continue;
                    }
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
                    if (empty($data['category']['route'])) {
                        $route = '';
                    } else {
                        $route = _(' ') . _($data['category']['route']);
                    }
                    echo '<tr>';
                    echo '<td class="' . $data['category']['game'] . 'p">' . _($data['category']['game']) . _(' ') . _($data['category']['shot'])  . $route . '</td>';
                    echo '<td>' . $data['player'] . '</td>';
                    echo '<td class="no_mobile">' . $replay . '</td>';
                    echo '<td>' . $video . '</td>';
                    echo '<td data-sort="' . $date_raw . '">' . $date . '</td>';
                    echo '</tr>';
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
            <tbody id='overallbody'>
                <?php
                    $total_lnns = 0;
                    if (!empty($number_of_lnns)) {
                        foreach ($number_of_lnns as $game => $count) {
                            if (in_array($game, $pvp)) {
                                continue;
                            }
                            if (game_num($game) < 6 || $count > 0) {
                                echo '<tr><td' . (game_num($game) == 128 ? ' data-sort="12.8"' : '') . '>' . game_num($game) . '</td><td class="' . $game . '">' . _($game) . '</td>';
                                echo '<td>' . $number_of_lnns->{$game} . '</td><td>' . $number_of_players->{$game} . '</td></tr>';
                                $total_lnns += $number_of_lnns->{$game};
                            }
                        }
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class='foot' colspan='2'><?php echo _('Overall') ?></td>
                    <td id='total_lnns' class='foot'><?php echo $total_lnns ?></td>
                    <td id='total_players' class='foot'><?php echo $total_players ?></td>
                </tr>
                <?php
                    if ($layout == 'Old') {
                        echo '<tr><td colspan="2">' . _('Replays') . '</td><td colspan="2">' . ($total_lnns - $missing_runs) . '</td></tr>';
                    }
                ?>
            </tfoot>
        </table>
    </div>
    <div id='players'>`
        <h2><?php echo _('Player Statistics') ?></h2>
        <table id='ranking' class='sortable'>
            <thead>
                <tr>
                    <th class='general_header no-sort'>#</th>
                    <th class='general_header'><?php echo _('Player'); ?></th>
                    <th id='number_of_lnns' class='general_header'><?php echo _('No. of LNNs'); ?></th>
                    <th class='general_header'><?php echo _('Games LNN\'d'); ?></th>
                </tr>
            </thead>
            <tbody id='rankingbody'>
                <?php
                    foreach ($player_lnns as $player => $count) {
                        $shot_lnns = $player_lnns->{$player} == $ALL_LNN ? $player_lnns->{$player} . _(' (All Windows)') : $player_lnns->{$player};
                        $game_lnns = array_intersect($WINDOWS_LNN, $player_games->{$player}) == $WINDOWS_LNN ? count(array_unique($player_games->{$player})) . _(' (All Windows)') : count(array_unique($player_games->{$player}));
                        echo '<tr><td></td>';
                        echo '<td><a href="#' . urlencode($player) . '">' . $player . '</a></td>';
                        echo '<td data-sort="' . $player_lnns->{$player} . '">' . $shot_lnns . '</td>';
                        echo '<td data-sort="' . count(array_unique($player_games->{$player})) . '">' . $game_lnns . '</td></tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <footer><strong><a href='#top'><?php echo _('Back to Top'); ?></a></strong></footer>
	<input id='shots' type='hidden' value='<?php
		$shots = '{';
		foreach ($games as $key => $data) {
			$shots .= '"' . $data['short_name'] . '":[';
			foreach ($data['shots'] as $key => $shot) {
				$shots .= '"' . $shot['name'] . '",';
			}
			$shots = substr($shots, 0, -1) . '],';
		}
		echo substr($shots, 0, -1) . '}';
	?>'>
</div>
