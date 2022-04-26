<?php include_once 'assets/games/survival/survival_code.php' ?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
        <noscript><strong>Notice:</strong> this page will not function properly with JavaScript disabled.</noscript>
		<p>Fill in the best survivals you have pulled off in the table below. If you leave a dropdown menu on the N/A option, it will not be factored in.
        When you click Apply, three different tables indicating your survival progress will be generated. The main survival progress table is an image and can be copied or saved to your device.
        Use the below selectors to fill up many achievements at once, either by game or by difficulty. See <a href='#acronyms'>the bottom of this page</a> for an explanation of the acronyms.</p>
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
                <option>NM+</option>
                <option>NB</option>
                <option>NB+</option>
                <option>NMNB</option>
            </select>
            <br>
            <input id='fillAll' type='button' value='Fill All'>
        </p>
    </div>
    <div id='container' class='overflow'>
        <table id='survival'>
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
    	</table>
    </div>
    <div id='bottom' data-html2canvas-ignore>
        <p><input id='save' type='button' value='Save'><input id='apply' type='button' value='Generate Tables'><input id='reset' type='button' value='Reset'></p>
        <p id='message'></p>
        <h2 id='acronyms'>Acronyms</h2>
        <ul>
            <li><strong>NM:</strong> No Miss. Clear without dying.</li>
            <li><strong>NB:</strong> No Bombs. Clear without bombing.</li>
            <li><strong>NMNB:</strong> No Miss No Bombs. Clear without dying or bombing.</li>
            <li><strong>NBB:</strong> No Border Breaks. Clear without breaking any borders (Touhou 7 PCB).</li>
            <li><strong>NV:</strong> No UFO Summons. Clear without summoning any UFOs (Touhou 12 UFO).</li>
            <li><strong>NT:</strong> No Trances. Clear without using any manual trances (Touhou 13 TD).</li>
            <li><strong>NR:</strong> No Releases. Clear without using season releases (Touhou 16 HSiFS).</li>
            <li><strong>NHNRB:</strong> No Hypers, No Roar Breaks. Clear without using Berserk Roar, also called hypers, and without breaking them. (Touhou 17 WBaWC).</li>
            <li><strong>NC:</strong> No Cards. Clear without using cards (Touhou 18 UM).</li>
            <li><strong>NNN:</strong> No Miss, No Bomb, No Third Condition. Clear without dying, bombing, or violating a third condition.</li>
            <li><strong>NNNN:</strong> The above, but including a fourth condition.</li>
        </ul>
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
                    <th>NM+</th>
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
