<!DOCTYPE html>
<html id='top' lang='en'>
<?php
	include 'assets/shared/shared.php';
	include 'assets/scoring/scoring.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

	<head>
		<title>High Score Storage</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Save your Touhou game scores and calculate how they compare to the world records.'>
        <meta name='keywords' content='touhou, touhou project, score, high score, storage, scoring, wr, wrs, world record, world records'>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=scoring'>
		<link rel='icon' type='image/x-icon' href='assets/scoring/scoring.ico'>
        <script src='assets/shared/jquery.js' defer></script>
		<script src='assets/scoring/scoring.js' defer></script>
        <script src='assets/shared/sorttable.js' defer></script>
        <?php echo dark_theme() ?>
	</head>

    <body>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
    		<div id='wrap' class='wrap'>
    			<p id='ack'>This background image <br id='ack_br'>was drawn by
    			<a href='https://www.pixiv.net/member.php?id=87950'>りすたる</a></p>
    			<span id='hy_container'><img id='hy' src='assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
		            <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
		        </span>
    			<h1>High Score Storage</h1>
    			<?php
    				if (!empty($_GET['redirect'])) {
    					echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
    				}
    			?>
                <noscript><strong>Notice:</strong> this page cannot function properly with JavaScript disabled.</noscript>
                <p>Enter your high scores. You can leave any high score empty. The scores you entered will be compared to the world records that
                were achieved with the same shottypes and percentages will be given. When you click the 'Calculate' button at the bottom of the
                page, sortable tables will be generated to tell you how your scores compare to the world records.</p>
                <p>Your scores should not include any characters other than digits, dots, commas and spaces.</p>
                <h2>Contents</h2>
                <div id='contents' class='border'>
    				<?php
    					foreach ($games as $key => $game) {
    						echo '<p><a href="#' . $game . '">' . full_name($game) . '</a></p>';
    						if ($game == 'MS') {
    							echo '<p class="wide"> </p>';
    						}
    					}
    				?>
                </div>
                <h2>Customize</h2>
                <table id='checkboxes' class='center'>
                    <tbody>
                        <tr class='noborders'>
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
                        <tr class='noborders'>
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
                        <tr class='noborders'>
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
                        <tr class='noborders'>
                            <td>
                                <input id='LLSc' type='checkbox' class='check' checked>
                                <label for='LLSc'>LLS</label>
                            </td><td>
                                <input id='PoFVc' type='checkbox' class='check' checked>
                                <label for='PoFVc'>PoFV</label>
                            </td><td>
                                <input id='TDc' type='checkbox' class='check' checked>
                                <label for='TDc'>TD</label>
                            </td><td class='noborders'></td>
                        </tr>
                        <tr class='noborders'>
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
                        <tr class='noborders'>
                            <td>
                                <input id='tracked' type='checkbox' checked>
                                <label for='tracked'>Tracked</label>
                            </td><td>
                                <input id='untracked' type='checkbox' checked>
                                <label for='untracked'>Untracked</label>
                            </td><td>
                                <input id='all' type='checkbox' checked>
                                <label for='all'>All</label>
                            </td><td class='noborders'></td>
                        </tr>
                    </tfoot>
                </table>
    			<?php
    				foreach ($games as $key => $game) {
    					echo '<div id="' . $game . '"><table class="center"><caption><p><img id="' . $game . '_image" ' .
						'src="assets/shared/game_sheet50x50.png" class="cover ' . ($key < 5 ? ' cover98' : '') . '" alt="' . $game .
    					' cover"> ' . full_name($game) . '</p></caption><tr><th>Route</th>';
    					foreach ($diffs as $key => $diff) {
    						if (no_extra($game) && $diff == 'Extra') {
    							break;
    						}
    						echo '<th>' . $diff . '</th>';
    						if ($game == 'PCB' && $diff == 'Extra') {
    							echo '<th>Phantasm</th>';
    						}
    					}
    					foreach ($wr[$game]['Easy'] as $shot => $value) {
    						echo '<tr><td>' . $shot . '</td>';
    						foreach ($diffs as $key => $diff) {
    							if (no_extra($game) && $diff == 'Extra') {
    								break;
    							}
    							if ($game == 'HSiFS' && $diff == 'Extra' && substr($shot, -6) != 'Spring') {
    								echo '<td></td>';
    								continue;
    							} else if ($game == 'HSiFS' && $diff == 'Extra') {
    								$shot = substr($shot, 0, -6);
    							}
    							echo '<td' . ($diff == 'Hard' || $diff == 'Extra' ? ' class="break"' : '') .
    							'><label for="' . $game . $diff . $shot . '" class="label">' . $diff .
    							'</label><input id="' . $game . $diff . $shot . '" type="text"></td>';
    							if ($game == 'PCB' && $diff == 'Extra') {
    								$diff = 'Phantasm';
    								echo '<td><label for="' . $game . $diff . $shot . '" class="label">' . $diff .
    								'</label><input id="' . $game . $diff . $shot . '" type="text"></td>';
    							}
    						}
    						echo '</tr>';
    					}
    					if ($game == 'GFW') {
    						echo '<tr><td><label for="GFWExtra-">Extra</label></td>' .
    						'<td id="GFWExtra" colspan="4"><input id="GFWExtra-" type="text"></td></tr>';
    					}
    					echo '</table></div>';
    				}
    			?>
    			<div id='topList'></div>
                <p><label for='precision'>Number of decimals:</label> <input id='precision' type='number' value='0' min='0' max='5' step='1'></p>
                <p id='error'></p>
    			<p><label for='toggleData'>Save Data</label><input id='toggleData' type='checkbox'></p>
    			<p><input id='calc' type='button' value='Calculate'><input id='reset' type='button' value='Reset'></p>
                <div id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=87950'>りすたる</a>.</div>
                <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
                <script src='assets/shared/dark.js'></script>
    		</div>
        </main>
	</body>

</html>
