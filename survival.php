<!DOCTYPE html>
<html lang='en'>
<?php
	include '.stats/count.php';
	hit(basename(__FILE__));
	$games = ['HRtP', 'SoEW', 'PoDD', 'LLS', 'MS', 'EoSD', 'PCB', 'IN', 'PoFV',
	'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLK', 'HSiFS', 'WBaWC'];
	$diffs = ['Easy', 'Normal', 'Hard', 'Lunatic', 'Extra'];
	function achievs($game) {
		$achievs = ['N/A', 'Not cleared', '1cc', 'NM', 'NB'];
		switch ($game) {
			case 'PCB': return array_merge($achievs, ['NBB', 'NBNBB', 'NMNBNBB']);
			case 'UFO': return array_merge($achievs, ['NV', 'NBNV', 'NMNB(NV)']);
			case 'TD': return array_merge($achievs, ['NT', 'NBNT', 'NMNBNT']);
			case 'HSiFS': return array_merge($achievs, ['NR', 'NBNR', 'NMNBNR']);
			case 'WBaWC': return array_merge($achievs, ['NHNRB', 'NBNHNRB', 'NNNN']);
			default: return array_merge($achievs, ['NMNB']);
		}
	}
	function no_extra($game) {
		return in_array($game, ['HRtP', 'PoDD']);
	}
?>

	<head>
		<title>Survival Progress Table Generator</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Generate a table that summarises your Touhou survival progress.'>
        <meta name='keywords' content='touhou, touhou project, survival, 1cc, 1ccs, clear, clears, progress, progress table'>
		<link rel='stylesheet' type='text/css' href='assets/survival/survival.css'>
		<link rel='icon' type='image/x-icon' href='assets/survival/survival.ico'>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/survival/survival.js' defer></script>
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
			<h1>Survival Progress Table Generator</h1>
			<?php
				if (!empty($_GET['redirect'])) {
					echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
				}
			?>
            <noscript><strong>Notice:</strong> this page will not function properly with JavaScript disabled.</noscript>
			<p>Fill in the best survivals you have pulled off in the table below. If you leave a dropdown menu on the N/A option, it will not be factored in.
            At the bottom of the page, three different sortable tables indicating your survival progress will be generated.</p>
            <p>NM = No Miss (no deaths), NB = No Bomb, NMNB = No Miss No Bomb. There can also be a third restriction, depending on the game.
            In PCB this restriction is NBB (No Border Breaks), in UFO it is NV (No UFO Summons),
			in TD it is NT (No Trance), in HSiFS it is NR (No Releases) and in WBaWC it is NHNRB (No Berserk Roar No Roar Breaks).
            The Phantasm Stage counts as another Extra Stage.</p>
            <p>Use the below selectors to fill up many achievements at once. Normal, Hard and Lunatic will also fill the difficulties below them.</p>
            <p>To allow for proper screenshots, the background for the tables is not transparent.</p>
            <p>Legend: purple = NN (with third restriction, if any), blue = NB, brown = NM, green = 1cc.</p>
            <p>
                <label for='fillGameDifficulty'>Game / Difficulty</label>
                <select id='fillGameDifficulty'>
					<?php
						foreach ($games as $key => $game) {
							echo '<option>' . $game . '</option>';
						}
						foreach ($diffs as $key => $diff) {
							echo '<option>' . $diff . '</option>';
						}
					?>
                </select>
                <br>
                <label for='fillAchievement'>Achievement</label>
                <select id='fillAchievement'>
                    <option>N/A</option>
                    <option>Not cleared</option>
                    <option>1cc</option>
                    <option>NM</option>
                    <option>NB</option>
                    <option>NB+</option>
                    <option>NMNB</option>
                </select>
                <br>
                <input id='fillAll' type='button' value='Fill All'>
            </p>
			<div id='dummy'><div id='dummy_sub'></div></div>
			<div id='container'>
	            <table id='survival' class='nomargin'>
	                <tr>
	                    <th>Game</th>
						<?php
							foreach ($diffs as $key => $diff) {
								echo '<th>' . $diff . '</th>';
							}
						?>
	                    <th>Phantasm</th>
	                </tr>
					<?php
						foreach ($games as $key => $game) {
							$achievs = achievs($game);
							echo '<tr><td>' . $game . '</td>';
							foreach ($diffs as $key => $diff) {
								if (no_extra($game, $diff) && $diff == 'Extra') {
									echo '<td class="noborders"></td><td class="noborders"></td>';
									continue;
								}
								echo '<td><select id="' . $game . $diff . '" class="category">';
								foreach ($achievs as $key => $achiev) {
									echo '<option>' . $achiev . '</option>';
								}
								echo '</select></td>';
								if ($game == 'PCB' && $diff == 'Extra') {
									echo '<td><select id="PCBPhantasm" class="category">';
									foreach ($achievs as $key => $achiev) {
										echo '<option>' . $achiev . '</option>';
									}
									echo '</select></td>';
								} else if ($game != 'PCB' && $diff == 'Extra') {
									echo '<td class="noborders"></td>';
								}
							}
							echo '</tr>';
						}
					?>
	        	</table>
			</div>
            <br>
            <p><label for='toggleData'>Save Data</label><input id='toggleData' type='checkbox'></p>
			<p><input id='apply' type='button' value='Apply'><input id='reset' type='button' value='Reset'></p>
			<h2 id='ack'>Acknowledgements</h2>
			<p id='credit'>The background image
			was drawn by <a href='https://www.pixiv.net/member.php?id=759506'>windtalker</a>.</p>
		</div>
		<div id='results'>
			<div id='modal_inner'></div>
		</div>
        <script src='assets/shared/dark.js'></script>
	</body>

</html>
