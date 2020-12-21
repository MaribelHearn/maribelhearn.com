<!DOCTYPE html>
<html lang='en'>
<?php
	include 'assets/shared/shared.php';
	include 'assets/survival/survival.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

	<head>
		<title>Survival Progress Table Generator</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Generate a table that summarises your Touhou survival progress.'>
        <meta name='keywords' content='touhou, touhou project, survival, 1cc, 1ccs, clear, clears, progress, progress table'>
		<link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=survival'>
		<link rel='icon' type='image/x-icon' href='assets/survival/survival.ico'>
        <script src='assets/shared/js_concat.php?page=survival' defer></script>
        <?php echo dark_theme() ?>
	</head>

    <body>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
    		<div id='wrap' class='wrap'>
                <p id='ack'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=759506'>windtalker</a></p>
                <span id='hy_container'><img id='hy' src='assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
	            	<span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
        		</span>
                <div id='content'>
        			<h1>Survival Progress Table Generator</h1>
        			<?php
        				if (!empty($_GET['redirect'])) {
        					echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        				}
        			?>
                    <noscript><strong>Notice:</strong> this page will not function properly with JavaScript disabled.</noscript>
        			<p>Fill in the best survivals you have pulled off in the table below. If you leave a dropdown menu on the N/A option, it will not be factored in.
                    When you click Apply, three different tables indicating your survival progress will be generated.</p>
        			<p>The main survival progress table is an image and can be copied or saved to your device.</p>
                    <p>NM = No Miss (no deaths), NB = No Bomb, NMNB = No Miss No Bomb. There can also be a third restriction, depending on the game.
                    In PCB this restriction is NBB (No Border Breaks), in UFO it is NV (No UFO Summons),
        			in TD it is NT (No Trance), in HSiFS it is NR (No Releases) and in WBaWC it is NHNRB (No Berserk Roar No Roar Breaks).
                    The Phantasm Stage counts as another Extra Stage.</p>
                    <p>Use the below selectors to fill up many achievements at once. Normal, Hard and Lunatic will also fill the difficulties below them.</p>
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
                </div>
    			<div id='dummy'><div id='dummy_sub'></div></div>
    			<div id='container'>
    	            <table id='survival' class='nomargin'>
                        <caption id='legend'>
							<span class='legend clear'></span> 1cc
							<span class='legend nm'></span> NM
							<span class='legend nb'></span> NB
							<span class='legend nmnb'></span> NMNB
						</caption>
                        <thead>
        	                <tr>
        	                    <th>Game</th>
        						<?php
        							foreach ($diffs as $key => $diff) {
        								echo '<th id="' . $diff . '">' . $diff . '</th>';
        							}
        						?>
        	                    <th>Phantasm</th>
        	                </tr>
                        </thead>
                        <tbody>
        					<?php
        						foreach ($games as $key => $game) {
        							$achievs = achievs($game);
        							echo '<tr><td id="' . $game . '">' . $game . '</td>';
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
                        </tbody>
    	        	</table>
    			</div>
                <div id='bottom'>
                    <p><label for='toggleData'>Save Data</label><input id='toggleData' type='checkbox'></p>
        			<p><input id='apply' type='button' value='Apply'><input id='reset' type='button' value='Reset'></p>
                    <p id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=759506'>windtalker</a>.</p>
                </div>
    		</div>
            <div id='results'>
    			<div id='modal_inner'>
    				<h2>Progress Table</h2>
    				<p id='rendering_message'>Rendering image...</p>
    				<span id='screenshot'></span>
    		        <h2>Numbers of Achievements</h2>
    				<table id='number_table' class='sortable'>
    		        	<thead>
    						<tr>
    							<th>Difficulty</th>
    							<th>Not cleared</th>
    							<th>1cc</th>
    							<th>NM</th>
    			        		<th>NB</th>
    							<th>NB+</th>
    							<th>NMNB</th>
    						</tr>
    					</thead>
    					<tbody id='number_table_tbody'></tbody>
    				</table>
    		        <h2>Clear Completions</h2>
    				<table id='completion_table' class='sortable'>
    		        	<thead>
    						<tr>
    							<th>Game</th>
    							<th>Clear Completion</th>
    						</tr>
    					</thead>
    					<tbody id='completion_table_tbody'></tbody>
    				</table>
    		        <input id='close' type='button' value='Close'>
    			</div>
    		</div>
        </main>
	</body>

</html>
