<?php include_once 'assets/games/survival/survival_code.php' ?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
        <noscript><?php echo _('<strong>Notice:</strong> this page requires JavaScript.') ?></noscript>
		<p><?php echo _('Fill in the best survivals you have pulled off in the table below. If you leave a dropdown menu on the N/A option, it will not be factored in. ' .
        'When you click Apply, three different tables indicating your survival progress will be generated. The main survival progress table is an image and can be copied or saved to your device. ' .
        'Use the below selectors to fill up many achievements at once, either by game or by difficulty. See <a href="#acronyms">the bottom of this page</a> for an explanation of the acronyms.') ?></p>
        <p>
            <label for='fillGameDifficulty'><?php echo _('Game / Difficulty') ?></label>
            <select id='fillGameDifficulty'>
				<?php
					foreach ($games as $key => $game) {
						echo '<option>' . _($game) . '</option>';
					}
					foreach ($diffs as $key => $diff) {
						echo '<option>' . $diff . '</option>';
					}
				?>
            </select>
            <br>
            <label for='fillAchievement'><?php echo _('Achievement') ?></label>
            <select id='fillAchievement'>
                <option value='N/A'><?php echo _('N/A') ?></option>
                <option value='Not cleared'><?php echo _('Not cleared') ?></option>
                <option value='1cc'><?php echo _('1cc') ?></option>
                <option value='NM'><?php echo _('NM') ?></option>
                <option value='NM+'><?php echo _('NM+') ?></option>
                <option value='NB'><?php echo _('NB') ?></option>
                <option value='NB+'><?php echo _('NB+') ?></option>
                <option value='NMNB'><?php echo _('NMNB') ?></option>
            </select>
            <br>
            <input id='fill_all' type='button' value='Fill All'>
        </p>
    </div>
    <div id='container' class='overflow'>
        <table id='survival'>
            <caption id='legend'>
    			<span class='legend clear'></span> <?php echo _('1cc') ?>
    			<span class='legend nm'></span> <?php echo _('NM') ?>
    			<span class='legend nb'></span> <?php echo _('NB') ?>
    			<span class='legend nmnb'></span> <?php echo _('NMNB') ?>
    		</caption>
            <thead>
                <tr>
                    <th><?php echo _('Game') ?></th>
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
    							echo '<option>' . _($achiev) . '</option>';
    						}
    						echo '</select></td>';
    						if ($game == 'PCB' && $diff == 'Extra') {
    							echo '<td><select id="PCBPhantasm" class="category">';
    							foreach ($achievs as $key => $achiev) {
    								echo '<option>' . _($achiev) . '</option>';
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
        <h2 id='acronyms'><?php echo _('Acronyms') ?></h2>
        <ul>
            <li><strong><?php echo _('NM:') ?></strong> <?php echo _('No Miss. Clear without dying.') ?></li>
            <li><strong><?php echo _('NB:') ?></strong> <?php echo _('No Bombs. Clear without bombing.') ?></li>
            <li><strong><?php echo _('NMNB:') ?></strong> <?php echo _('No Miss No Bombs. Clear without dying or bombing.') ?></li>
            <li><strong><?php echo _('NBB:') ?></strong> <?php echo _('No Border Breaks. Clear without breaking any borders (Touhou 7 PCB).') ?></li>
            <li><strong><?php echo _('NV:') ?></strong> <?php echo _('No UFO Summons. Clear without summoning any UFOs (Touhou 12 UFO).') ?></li>
            <li><strong><?php echo _('NT:') ?></strong> <?php echo _('No Trances. Clear without using any manual trances (Touhou 13 TD).') ?></li>
            <li><strong><?php echo _('NR:') ?></strong> <?php echo _('No Releases. Clear without using season releases (Touhou 16 HSiFS).') ?></li>
            <li><strong><?php echo _('NHNRB:') ?></strong> <?php echo _('No Hypers, No Roar Breaks. Clear without using Berserk Roar, also called hypers, and without breaking them. (Touhou 17 WBaWC).') ?></li>
            <li><strong><?php echo _('NC:') ?></strong> <?php echo _('No Cards. Clear without using cards (Touhou 18 UM).') ?></li>
            <li><strong><?php echo _('NNN:') ?></strong> <?php echo _('No Miss, No Bomb, No Third Condition. Clear without dying, bombing, or violating a third condition.') ?></li>
            <li><strong><?php echo _('NNNN:') ?></strong> <?php echo _('The above, but including a fourth condition.') ?></li>
        </ul>
    </div>
</div>
<div id='results' data-html2canvas-ignore>
	<div id='modal_inner'>
		<h2><?php echo _('Progress Table') ?></h2>
		<p id='rendering_message'><?php echo _('Rendering image...') ?></p>
		<div id='screenshot'>
            <a id='save_link' href='' download=''>
                <input type='button' value='Save to Device'>
            </a>
            <input id='close' type='button' value='Close'>
            <p><img id='screenshot_base64' src='' alt='Survival progress table'></p>
        </div>
        <h2><?php echo _('Numbers of Achievements') ?></h2>
		<table id='number_table' class='sortable'>
        	<thead>
				<tr>
					<th><?php echo _('Difficulty') ?></th>
					<th><?php echo _('Not cleared') ?></th>
					<th><?php echo _('1cc') ?></th>
					<th><?php echo _('NM') ?></th>
                    <th><?php echo _('NM+') ?></th>
	        		<th><?php echo _('NB') ?></th>
					<th><?php echo _('NB+') ?></th>
					<th><?php echo _('NMNB') ?></th>
				</tr>
			</thead>
			<tbody id='number_table_tbody'></tbody>
		</table>
        <h2><?php echo _('Clear Completions') ?></h2>
		<table id='completion_table' class='sortable'>
        	<thead>
				<tr>
					<th><?php echo _('Game') ?></th>
					<th><?php echo _('Clear Completion') ?></th>
				</tr>
			</thead>
			<tbody id='completion_table_tbody'></tbody>
		</table>
	</div>
</div>
