<?php
global $API_BASE;
$wrs = [];
$games_seen = [];
$diffs_seen = [];
$shots_seen = [];
$wr_data = curl_get($API_BASE . '/api/v1/replay/?ordering=game,difficulty,shot&type=Score&region=Eastern&verified=true');
if (strpos($wr_data, 'Internal Server Error') !== false) {
    $_GET['error'] = 500;
    include_once('php/error.php');
    include_once('php/shared/postscript.php');
    die();
} else if (strpos($wr_data, 'Service Unavailable') !== false || strpos($wr_data, 'ConnectionError') !== false) {
    $_GET['error'] = 503;
    include_once('php/error.php');
    include_once('php/shared/postscript.php');
    die();
} else {
    $wr_data = json_decode($wr_data, true);
    foreach ($wr_data as $key => $data) {
        $score = $data['score'];
        $player = $data['player'];
        $game = $data['category']['game'];
        $diff = $data['category']['difficulty'];
        $shot = $data['category']['shot'];
        if (!in_array($game, $games_seen)) {
            $wrs[$game] = [];
            $diffs_seen = [];
            $shots_seen = [];
            array_push($games_seen, $game);
        }
        if (!in_array($diff, $diffs_seen)) {
            $wrs[$game][$diff] = [];
            array_push($diffs_seen, $diff);
        }
        if (!in_array($shot, $shots_seen)) {
            $wrs[$game][$diff][$shot] = [];
            array_push($shots_seen, $shot);
        }
        if (empty($wrs[$game][$diff][$shot]) || $score > $wrs[$game][$diff][$shot][0]) {
            $wrs[$game][$diff][$shot] = [$score, $player];
        }
    }
    $games = curl_get($API_BASE . '/api/v1/game/');
    $games = json_decode($games, true);
}
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
        <noscript><p><?php echo _('<strong>Notice:</strong> this page requires JavaScript.') ?></p></noscript>
        <p>Enter your high scores. You can leave any high score empty. The scores you entered will be compared to the world records that
        were achieved with the same shottypes and percentages will be given. When you click the 'Calculate' button at the bottom of the
        page, sortable tables will be generated to tell you how your scores compare to the world records.</p>
        <div class='center'>
            <label for='precision'>Number of decimals for WR percentages:</label>
            <input id='precision' type='number' value='0' min='0' max='5' step='1'>
        </div>
        <p><?php echo _('Hotkeys:') ?></p>
        <ul id='hotkeys'>
            <li><?php echo _('Save: S') ?></li>
            <li><?php echo _('Generate Tables: T') ?></li>
            <li><?php echo _('Import: I') ?></li>
            <li><?php echo _('Export: E') ?></li>
            <li><?php echo _('Reset: R') ?></li>
        </ul>
        <div id='buttons'>
            <input id='save' type='button' value='Save'>
            <input id='apply' type='button' value='Generate Tables'>
            <br id='buttons_br'>
            <input id='import_button' type='button' value='Import'>
            <input id='export' type='button' value='Export'>
            <input id='reset' type='button' value='Reset'>
        </div>
        <p id='message' class='center'></p>
        <p id='error_message' class='center'></p>
    </div>
    <table id='summary_table' class='rendering'>
        <caption id='legend' class='legend_score'>
            <span class='legend big'></span> 70%
            <span class='legend bigger'></span> 85%
            <span class='legend superbig'></span> 95%
            <span class='legend biggest'></span> WR
        </caption>
        <thead>
            <tr>
                <th>Game</th>
                <th>Easy</th>
                <th>Normal</th>
                <th>Hard</th>
                <th>Lunatic</th>
                <th colspan='2'>Extra</th>
            </tr>
        </thead>
        <tbody><?php
            foreach ($games as $key => $data) {
                $game = $data['short_name'];
                if ($game == 'UDoALG') {
                    continue;
                }
                echo '<tr id="' . $game . 'tr">';
                echo '<th>' . $game . '</th>';
                echo '<td id="' . $game . 'Easy" class="overview"></td>';
                echo '<td id="' . $game . 'Normal" class="overview"></td>';
                echo '<td id="' . $game . 'Hard" class="overview"></td>';
                echo '<td id="' . $game . 'Lunatic" class="overview"></td>';
                if ($game === 'HRtP' || $game === 'PoDD') {
                    echo '<td id="' . $game . '" colspan="2" class="overview no_extra">X</td>';
                }
                else if ($game === 'PCB') {
                    echo '<td id="PCBExtra" class="overview_half"></td><td id="PCBPhantasm" class="overview_half"></td>';
                }
                else {
                    echo '<td id="' . $game . 'Extra" colspan="2" class="overview"></td>';
                }
                echo '</tr>';
            }
        ?></tbody>
    </table>
    <form>
        <table id='score_input' class='noborders'>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Shottype</th>
                    <th>Easy</th>
                    <th>Normal</th>
                    <th>Hard</th>
                    <th>Lunatic</th>
                    <th>Extra</th>
                    <th>Phantasm</th>
                </tr>
            </thead>
            <tbody><?php
                global $is_mobile;
                foreach ($games as $key => $data) {
                    $game = $data['short_name'];
                    if ($game == 'UDoALG') {
                        continue;
                    }
                    foreach ($data['shots'] as $key => $shot_data) {
                        $shot = $shot_data['name'];
                        if ($game == 'HSiFS' && strlen($shot) <= 6) {
                            continue;
                        }
                        $rowspan = count($data['shots']);
                        if ($game === 'GFW') {
                            $rowspan += 1;
                        }
                        if ($game === 'HSiFS') {
                            $rowspan -= 4;
                        }
                        if ($key === 0 && $is_mobile) {
                            echo '<td rowspan="' . $rowspan . '" class="nohide"><span id="' . $game . '_image" title="' . $data['full_name'] .
                                '" class="cover' . ($data['number'] <= 5 ? ' cover98' : '') . '"></span></td>';
                        }
                        if ($key === 0) {
                            echo '<tr><td colspan="8" class="nohide"><div id="dropdown_' . $game . '" class="dropdown-check-list" tabindex="100"><span class="anchor">Expand</span></div></td></tr>';
                        }
                        echo '<tr class="row_' . $game . '">';
                        if ($key === 0 && !$is_mobile) {
                            echo '<td rowspan="' . $rowspan . '" class="nohide"><span id="' . $game . '_image" title="' . $data['full_name'] .
                                '" class="cover' . ($data['number'] <= 5 ? ' cover98' : '') . '"></span></td>';
                        }
                        echo '<td>' . $shot . '</td>';
                        foreach ($shot_data['categories'] as $key => $category_data) {
                            if ($category_data['type'] == 'LNN' || $category_data['region'] == 'Western') {
                                continue;
                            }
                            $diff = $category_data['difficulty'];
                            if (($game == 'GFW' || $game == 'HSiFS') && $diff == 'Extra') {
                                continue;
                            }
                            $shot = str_replace(' ', '', $shot);
                            echo '<td><label for="' . $game . $diff . $shot . '" class="label">' . $diff . '</label>' .
                            '<input id="' . $game . $diff . $shot . '" type="text"></td>';
                            if ($game == 'HSiFS' && $diff == 'Lunatic' && strpos($shot, 'Spring') !== false) {
                                $shot = str_replace('Spring', '', $shot);
                                echo '<td><label for="' . $game . 'Extra' . $shot . '" class="label">Extra</label>' .
                                '<input id="' . $game . 'Extra' . $shot . '" type="text"></td>';
                            } else if ($game == 'HSiFS' && $diff == 'Lunatic' && strpos($shot, 'Spring') === false) {
                                echo '<td></td>'; // hidden
                            }
                        }
                        echo '</tr>';
                    }
                    if ($game == 'GFW') {
                        echo '<tr class="row_GFW"><td><label for="GFWExtraA1">Extra</label></td><td id="GFWExtra_td" colspan="4"><input id="GFWExtraA1" type="text"></td></tr>';
                    }
                }
            ?></tbody>
        </table>
    </form>
    <footer><strong><a href='#top'>Back to Top</a></strong></footer>
</div>
<div id='modal'>
	<div id='results' class='modal_inner'>
		<h2>Summary Table</h2>
		<div id='screenshot'>
            <a id='screenshot_link' href='#' download='#' class='device_link'>Save to Device</a>
            <input id='clipboard' type='button' value='Copy to Clipboard' data_id='screenshot_base64'>
		    <p id='rendering_message' class='rendering_message'></p>
            <p><img id='screenshot_base64' src='#' alt='Scoring summary table'></p>
        </div>
        <h2>WR Comparison</h2>
        <a id='comparison_link' href='#' download='#' class='device_link'>Save to Device</a>
        <input id='comparison_file' type='hidden' value=''>
        <input id='clipboard_comp' type='button' value='Copy to Clipboard'>
        <p id='comparison_message' class='rendering_message'></p>
        <table id='score_table' class='sortable result_table'>
            <thead>
                <tr>
                    <th>Game + Difficulty</th>
                    <th>Shottype / Route</th>
                    <th>Score</th>
                    <th>WR Percentage</th>
                    <th>Progress Bar</th>
                    <th>WR</th>
                </tr>
            </thead>
            <tbody id='score_tbody'>
            </tbody>
        </table>
        <table id='game_table' class='sortable result_table'>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Average Percentage</th>
                </tr>
            </thead>
            <tbody id='game_tbody'>
            </tbody>
        </table>
    </div>
    <div id='import_text' class='modal_inner'>
        <h2>Import from Text File</h2>
        <p>Note that the format should be the same as the exported text.</p>
        <p><strong>Warning:</strong> Importing can overwrite your current scores!</p>
        <form target='_self' method='post' enctype='multipart/form-data'>
            <label for='import_file'>Upload file:</label>
            <input id='import_file' name='import' type='file'>
            <p><input type='submit' value='Import'></p>
        </form>
    </div>
    <div id='export_text' class='modal_inner'>
        <h2>Export to Text File</h2>
        <p>
            <input id='copy_to_clipboard' type='button' value='Copy to Clipboard'>
            <input id='text_file' type='hidden' value=''>
        </p>
        <p>
            <a id='save_link' href='#' download='#' class='device_link'>Save to Device</a>
        </p>
    </div>
	<input id='WRs' type='hidden' value='<?php echo json_encode($wrs); ?>'>
</div>