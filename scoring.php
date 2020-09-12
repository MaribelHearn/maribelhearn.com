<!DOCTYPE html>
<html lang='en'>
<?php
	include '.stats/count.php';
	hit(basename(__FILE__));
    $json = file_get_contents('json/wrlist.json');
    $wr = json_decode($json, true);
	$games = ['HRtP', 'SoEW', 'PoDD', 'LLS', 'MS', 'EoSD', 'PCB', 'IN', 'PoFV',
	'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLK', 'HSiFS', 'WBaWC'];
	$diffs = ['Easy', 'Normal', 'Hard', 'Lunatic', 'Extra'];
    function full_name($game) {
        switch ($game) {
			case 'HRtP': return 'Touhou 1 - The Highly Responsive to Prayers';
            case 'SoEW': return 'Touhou 2 - The Story of Eastern Wonderland';
            case 'PoDD': return 'Touhou 3 - Phantasmagoria of Dim.Dream';
            case 'LLS': return 'Touhou 4 - Lotus Land Story';
            case 'MS': return 'Touhou 5 - Mystic Square';
            case 'EoSD': return 'Touhou 6 - The Embodiment of Scarlet Devil';
            case 'PCB': return 'Touhou 7 - Perfect Cherry Blossom';
            case 'IN': return 'Touhou 8 - Imperishable Night';
            case 'PoFV': return 'Touhou 9 - Phantasmagoria of Flower View';
            case 'MoF': return 'Touhou 10 - Mountain of Faith';
            case 'SA': return 'Touhou 11 - Subterranean Animism';
            case 'UFO': return 'Touhou 12 - Undefined Fantastic Object';
            case 'GFW': return 'Touhou 12.8 - Great Fairy Wars';
            case 'TD': return 'Touhou 13 - Ten Desires';
            case 'DDC': return 'Touhou 14 - Double Dealing Character';
            case 'LoLK': return 'Touhou 15 - Legacy of Lunatic Kingdom';
            case 'HSiFS': return 'Touhou 16 - Hidden Star in Four Seasons';
            case 'WBaWC': return 'Touhou 17 - Wily Beast and Weakest Creature';
            default: return 'Unknown';
        }
    }
	function no_extra($game) {
		return in_array($game, ['HRtP', 'PoDD']);
	}
?>

	<head>
		<title>High Score Storage</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Save your Touhou game scores and calculate how they compare to the world records.'>
        <meta name='keywords' content='touhou, touhou project, score, high score, storage, scoring, wr, wrs, world record, world records'>
		<link rel='stylesheet' type='text/css' href='assets/scoring/scoring.css'>
		<link rel='icon' type='image/x-icon' href='assets/scoring/scoring.ico'>
        <script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/scoring/scoring.js' defer></script>
        <script src='assets/shared/sorttable.js' defer></script>
	</head>

    <body class='<?php echo check_webp() ?>'>
		<div id='nav' class='wrap'>
			<nav>
				<?php
					$nav = file_get_contents('nav.html');
					$page = str_replace('.php', '', basename(__FILE__));
					$nav = str_replace('<a href="' . $page . '">', '<strong>', $nav);
					$cap = strlen($page) < 4 ? strtoupper($page) : ucfirst($page);
					echo str_ireplace($page . '</a>', $cap . '</strong>', $nav);
				?>
			</nav>
		</div>
		<div id='wrap' class='wrap'>
			<img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
			<h1>High Score Storage</h1>
			<?php
				if (!empty($_GET['redirect'])) {
					echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
				}
			?>
            <noscript><strong>Notice:</strong> this page cannot function properly with JavaScript disabled.</noscript>
            <p>Enter your high scores. You can leave any high score empty. The scores you entered will be compared to the world records that
            were achieved with the same shottypes and percentages will be given. When you click the 'Calculate' button at the bottom of the
            page, sortable tables will be generated to tell you how your scores compare to the world records.</p>
            <p>Your scores should not include any characters other than digits, dots, commas and spaces.</p>
            <h2>Contents</h2>
            <table id='contents' class='center'>
				<?php
					foreach ($games as $key => $game) {
						echo '<tr><td><a href="#' . $game . '">' . full_name($game) . '</a></td></tr>';
						if ($game == 'MS') {
							echo '<tr><td><br></td></tr>';
						}
					}
				?>
                <tr><td><a href='#ack'>Acknowledgements</a></td></tr>
            </table>
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
					echo '<div id="' . $game . '"><p><img src="games/' . strtolower($game) .
					'50x50.jpg" ' . ($key < 5 ? 'class="cover98" ' : '') . 'alt="' . $game .
					' cover"><u>' . full_name($game) . '</u></p><table class="center"><tr><th>Route</th>';
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
			<h2 id='ack'>Acknowledgements</h2>
			<p id='credit'>The background image
			was drawn by <a href='https://www.pixiv.net/member.php?id=87950'>りすたる</a>.</p>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
		</div>
        <script src='assets/shared/dark.js'></script>
	</body>

</html>
