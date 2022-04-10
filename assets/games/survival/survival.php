<?php include_once 'assets/games/survival/survival_code.php' ?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
        <noscript><strong>Notice:</strong> this page will not function properly with JavaScript disabled.</noscript>
		<p>Fill in the best survivals you have pulled off in the table below. If you leave a dropdown menu on the N/A option, it will not be factored in.
        When you click Apply, three different tables indicating your survival progress will be generated.</p>
		<p>The main survival progress table is an image and can be copied or saved to your device.</p>
        <p>NM = No Miss (no deaths), NB = No Bomb, NMNB = No Miss No Bomb. There can also be a third restriction, depending on the game.
        In PCB this restriction is NBB (No Border Breaks), in UFO it is NV (No UFO Summons),
		in TD it is NT (No Trance), in HSiFS it is NR (No Releases), in WBaWC it is NHNRB (No Berserk Roar No Roar Breaks)
		and in UM it is NC (No Cards, that is, no cards that affect survival play).
        The Phantasm Stage counts as another Extra Stage.</p>
        <p>Use the below selectors to fill up many achievements at once, either by game or by difficulty.</p>
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
    <div class='overflow'><table id='survival'>
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
					echo '<tr id="' . $game . 'tr"><td id="' . $game . '">' . display_name($game) . '</td>';
					foreach ($diffs as $key => $diff) {
						if (no_extra($game, $diff) && $diff == 'Extra') {
							if ($game != 'INFinalB') {
								echo '<td class="noborders"></td><td class="noborders"></td>';
							}

							continue;
						}
						echo ($game == 'INFinalA' && $diff == 'Extra' ? '<td rowspan="2">' : '<td>');
						echo '<select id="' . $game . $diff . '" class="category">';
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
						if ($game == 'INFinalA' && $diff != 'Extra') {
							echo '<td id="B' . $diff . '" class="hidden">';
						}
					}
					echo '</tr>';
				}
			?>
        </tbody>
	</table></div>
    <div id='bottom' data-html2canvas-ignore>
        <p><input id='save' type='button' value='Save'><input id='apply' type='button' value='Generate Tables'><input id='reset' type='button' value='Reset'></p>
        <p id='message'></p>
    </div>
</div>
<div id='results' data-html2canvas-ignore>
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
	</div>
</div>
