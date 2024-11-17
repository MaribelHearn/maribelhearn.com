<?php
global $API_BASE;
$wrs = [];
$games_seen = [];
$diffs_seen = [];
$shots_seen = [];
$wr_data = curl_get($API_BASE . '/api/v1/replay/?ordering=game,difficulty,shot&type=Score&region=Eastern&verified=true');
if (strpos($wr_data, 'Internal Server Error') === false) {
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
}
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <noscript><strong>Notice:</strong> this page requires JavaScript.</noscript>
    <p>Enter your high scores. You can leave any high score empty. The scores you entered will be compared to the world records that
    were achieved with the same shottypes and percentages will be given. When you click the 'Calculate' button at the bottom of the
    page, sortable tables will be generated to tell you how your scores compare to the world records.</p>
    <p>Your scores should not include any characters other than digits, dots, commas and spaces.</p>
    <h2>Contents</h2>
    <div class='contents'>
		<?php
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
		?>
    </div>
    <table id='checkboxes'>
        <tbody>
            <tr>
                <td>
                    <input id='HRtPc' type='checkbox' class='check' checked>
                    <label for='HRtPc'>HRtP</label>
                </td><td>
                    <input id='EoSDc' type='checkbox' class='check' checked>
                    <label for='EoSDc'>EoSD</label>
                </td><td>
                    <input id='SAc' type='checkbox' class='check' checked>
                    <label for='SAc'>SA</label>
                </td><td>
                    <input id='LoLKc' type='checkbox' class='check' checked>
                    <label for='LoLKc'>LoLK</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input id='SoEWc' type='checkbox' class='check' checked>
                    <label for='SoEWc'>SoEW</label>
                </td><td>
                    <input id='PCBc' type='checkbox' class='check' checked>
                    <label for='PCBc'>PCB</label>
                </td><td>
                    <input id='UFOc' type='checkbox' class='check' checked>
                    <label for='UFOc'>UFO</label>
                </td><td>
                    <input id='HSiFSc' type='checkbox' class='check' checked>
                    <label for='HSiFSc'>HSiFS</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input id='PoDDc' type='checkbox' class='check' checked>
                    <label for='PoDDc'>PoDD</label>
                </td><td>
                    <input id='INc' type='checkbox' class='check' checked>
                    <label for='INc'>IN</label>
                </td><td>
                    <input id='GFWc' type='checkbox' class='check' checked>
                    <label for='GFWc'>GFW</label>
                </td><td>
                    <input id='WBaWCc' type='checkbox' class='check' checked>
                    <label for='WBaWCc'>WBaWC</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input id='LLSc' type='checkbox' class='check' checked>
                    <label for='LLSc'>LLS</label>
                </td><td>
                    <input id='PoFVc' type='checkbox' class='check' checked>
                    <label for='PoFVc'>PoFV</label>
                </td><td>
                    <input id='TDc' type='checkbox' class='check' checked>
                    <label for='TDc'>TD</label>
                </td><td>
					<input id='UMc' type='checkbox' class='check' checked>
					<label for='UMc'>UM</label>
				</td>
            </tr>
            <tr>
                <td>
                    <input id='MSc' type='checkbox' class='check' checked>
                    <label for='MSc'>MS</label>
                </td><td>
                    <input id='MoFc' type='checkbox' class='check' checked>
                    <label for='MoFc'>MoF</label>
                </td><td>
                    <input id='DDCc' type='checkbox' class='check' checked>
                    <label for='DDCc'>DDC</label>
                </td><td class='noborders'></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan='4'>
                    <input id='all' type='checkbox' checked>
                    <label for='all'>All</label>
                </td>
            </tr>
        </tfoot>
    </table>
    <form><?php
        if (gettype($games) != 'string' || strpos($games, 'Internal Server Error') === false) {
            foreach ($games as $key => $data) {
                $game = $data['short_name'];
                if ($game == 'UDoALG') {
                    continue;
                }
                echo '<div id="' . $game . '"><table class="noborders"><caption><p><span id="' . $game . '_image" ' .
                'class="cover ' . ($data['number'] <= 5 ? ' cover98' : '') . '"></span> ' . $data['full_name'] .
                '</p></caption><tr><th>' . shot_route($game) . '</th>';
                $categories = $data['shots'][0]['categories'];
                foreach ($categories as $key => $category_data) {
                    if ($category_data['type'] == 'LNN' || $category_data['region'] == 'Western') {
                        continue;
                    }
                    $diff = $category_data['difficulty'];
                    if ($game == 'GFW' && $diff == 'Extra') {
                        continue;
                    }
                    echo '<th>' . $diff . '</th>';
                }
                if ($game == 'HSiFS') {
                    echo '<th>Extra</th>';
                }
                echo '</tr>';
                foreach ($data['shots'] as $key => $shot_data) {
                    $shot = $shot_data['name'];
                    if ($game == 'HSiFS' && strlen($shot) <= 6) {
                        continue;
                    }
                    echo '<tr><td>' . $shot . '</td>';
                    foreach ($shot_data['categories'] as $key => $category_data) {
                        if ($category_data['type'] == 'LNN' || $category_data['region'] == 'Western') {
                            continue;
                        }
                        $diff = $category_data['difficulty'];
                        if (($game == 'GFW' || $game == 'HSiFS') && $diff == 'Extra') {
                            continue;
                        }
                        $shot = str_replace(' ', '', $shot);
                        echo '<td' . ($diff == 'Hard' || $diff == 'Extra' ? ' class="break"' : '') . '>' .
                        '<label for="' . $game . $diff . $shot . '" class="label">' . $diff . '</label>' .
                        '<input id="' . $game . $diff . $shot . '" type="text"></td>';
                        if ($game == 'HSiFS' && $diff == 'Lunatic' && strpos($shot, 'Spring') !== false) {
                            $shot = str_replace('Spring', '', $shot);
                            echo '<td class="break"><label for="' . $game . 'Extra' . $shot . '" class="label">Extra</label>' .
                            '<input id="' . $game . 'Extra' . $shot . '" type="text"></td>';
                        } else if ($game == 'HSiFS' && $diff == 'Lunatic' && strpos($shot, 'Spring') === false) {
                            echo '<td></td>'; // hidden
                        }
                    }
                    echo '</tr>';
                }
                if ($game == 'GFW') {
                    echo '<tr><td><label for="GFWExtraA1">Extra</label></td><td id="GFWExtra" colspan="4"><input id="GFWExtraA1" type="text"></td></tr>';
                }
                echo '</table></div>';
            }
        }
	    ?>
        <div class='center'>
            <label for='precision'>Number of decimals:</label>
            <input id='precision' type='number' value='0' min='0' max='5' step='1'>
        </div>
        <p id='message' class='center'></p>
        <p id='error_message' class='center'></p>
        <div class='center'>
            <input id='save' type='button' value='Save'>
            <input id='calc' type='button' value='Calculate'>
        	<input id='import_button' type='button' value='Import'>
        	<input id='export' type='button' value='Export'>
            <input id='reset' type='button' value='Reset'>
        </div>
    </form>
	<div id='top_list'>
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
    <footer><strong><a href='#top'>Back to Top</a></strong></footer>
</div>
<div id='modal'>
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
            <a id='save_link' href='#' download='#'>
                <input type='button' class='button' value='Save to Device'>
            </a>
        </p>
    </div>
	<input id='WRs' type='hidden' value='<?php echo json_encode($wrs); ?>'>
</div>