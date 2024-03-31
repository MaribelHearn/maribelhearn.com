<?php
$games = ['HRtPMakai', 'HRtPJigoku', 'SoEW', 'PoDD', 'LLS', 'MS', 'EoSD', 'PCB', 'INFinalA', 'INFinalB', 'PoFV',
'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLKLegacy', 'LoLKPointdevice', 'HSiFS', 'WBaWC', 'UM', 'UDoALG'];
$diffs = ['Easy', 'Normal', 'Hard', 'Lunatic', 'Extra'];
$stb = (object) [
    '1' => 6,
    '2' => 6,
    '3' => 8,
    '4' => 9,
    '5' => 8,
    '5' => 8,
    '6' => 8,
    '7' => 8,
    '8' => 8,
    '9' => 8,
    '10' => 8,
    'EX' => 8
];
$ds = (object) [
    '1' => 6,
    '2' => 6,
    '3' => 8,
    '4' => 7,
    '5' => 8,
    '6' => 8,
    '7' => 7,
    '8' => 8,
    '9' => 8,
    '10' => 8,
    '11' => 8,
    '12' => 8,
    'EX' => 9,
    'SP' => 9
];
$isc = (object) [
    '1' => 6,
    '2' => 6,
    '3' => 7,
    '4' => 7,
    '5' => 8,
    '6' => 8,
    '7' => 8,
    '8' => 7,
    '9' => 8,
    '10' => 10
];
$vd = (object) [
    'Sun-Mon' => 6,
    'Tue-Wed' => 7,
    'Thu-Sat' => 7,
    'Wrong Sun' => 7,
    'Wrong Mon' => 4,
    'Wrong Tue' => 4,
    'Wrong Wed' => 6,
    'Wrong Thu' => 5,
    'Wrong Fri' => 5,
    'Wrong Sat' => 6,
    'Nightmare Sun' => 6,
    'Nightmare Mon' => 6,
    'Nightmare Tue' => 6,
    'Nightmare Wed' => 6,
    'Nightmare Thu' => 6,
    'Nightmare Fri' => 6,
    'Nightmare Sat' => 6,
    'Nightmare Diary' => 4,
];
function achievs(string $game) {
    $achievs = ['Not cleared', '1cc', 'NM', 'NB'];
    switch ($game) {
        case 'PCB': return array_merge($achievs, ['NBB']);
        case 'UFO': return array_merge($achievs, ['NV']);
        case 'TD': return array_merge($achievs, ['NT']);
        case 'HSiFS': return array_merge($achievs, ['NR']);
        case 'WBaWC': return array_merge($achievs, ['NH', 'NRB']);
        case 'UM': return array_merge($achievs, ['NC']);
        default: return $achievs;
    }
}
function no_extra(string $game) {
    return in_array($game, ['HRtPMakai', 'HRtPJigoku', 'PoDD', 'INFinalB', 'LoLKPointdevice', 'UDoALG']);
}
function display_name(string $game) {
    if ($game == 'HRtPMakai') {
        return 'HRtP <span class="hrtp_route">Makai</span>';
    } else if ($game == 'HRtPJigoku') {
        return 'HRtP <span class="hrtp_route">Jigoku</span>';
    } else if ($game == 'INFinalA') {
        return 'IN <span class="in_route">FinalA</span>';
    } else if ($game == 'INFinalB') {
        return 'IN <span class="in_route">FinalB</span>';
    } else if ($game == 'LoLKLegacy') {
        return 'LoLK <span class="lolk_mode">Legacy</span>';
    } else if ($game == 'LoLKPointdevice') {
        return 'LoLK <span class="lolk_mode">Pointdevice</span>';
    } else {
        return $game;
    }
}
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
        <noscript><?php echo _('<strong>Notice:</strong> this page requires JavaScript.') ?></noscript>
		<p><?php echo _('Fill in the best survivals you have pulled off in the table below. Click \'Save\' in the top left to save your progress.') ?></p>
        <p><?php echo _('When you click \'Generate Tables\', several tables indicating your survival progress will be generated. The coloured survival progress table are images that can be copied or saved to your device. ' .
        'Use the below selectors to fill up many achievements at once, either by game or by difficulty. See the bottom of this page for an explanation of the acronyms.') ?></p>
        <p><?php echo _('Hotkeys:') ?></p>
        <ul id='hotkeys'>
            <li><?php echo _('Save: S') ?></li>
            <li><?php echo _('Generate Tables: T') ?></li>
            <li><?php echo _('Import: I') ?></li>
            <li><?php echo _('Export: E') ?></li>
            <li><?php echo _('Reset: R') ?></li>
        </ul>
        <div id='buttons'>
            <section>
                <input id='save' type='button' value='Save'>
                <input id='apply' type='button' value='Generate Tables'>
                <br id='buttons_br'>
                <input id='import_button' type='button' value='Import'>
                <input id='export' type='button' value='Export'>
                <input id='reset' type='button' value='Reset'>
            </section>
        </div>
        <p class='message center'></p>
        <p class='error_message center'></p>
    </div>
    <div id='container' class='overflow'>
        <table id='survival' class='progress_table'>
            <caption id='legend' class='legend_surv'>
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
            <tbody><?php
                foreach ($games as $key => $game) {
                    $achievs = achievs($game);
                    echo '<tr id="' . $game . 'tr"><td id="' . $game . '">' . display_name($game) . '</td>';
                    foreach ($diffs as $key => $diff) {
                        if (no_extra($game, $diff) && $diff == 'Extra') {
                            if ($game != 'HRtPJigoku' && $game != 'INFinalB' && $game != 'LoLKPointdevice') {
                                echo '<td class="noborders"></td><td class="noborders"></td>';
                            }

                            continue;
                        }
                        echo (($game == 'INFinalA' || $game == 'LoLKLegacy') && $diff == 'Extra' ? '<td rowspan="2">' : '<td>');
                        echo '<div class="dropdown-check-list" tabindex="100"><span id="' . $game . $diff . 'a" class="anchor">Select</span><ul id="' . $game . $diff . '" class="category">';
                        foreach ($achievs as $key => $achiev) {
                            echo '<li><input type="checkbox" value="' . $achiev . '" id="' . $game . $diff . $key . '"><label for="' . $game . $diff . $key . '">' . _($achiev) . '</label></li>';
                        }
                        echo '</ul></div></td>';
                        if ($game == 'PCB' && $diff == 'Extra') {
                            echo '<td><div class="dropdown-check-list" tabindex="100"><span id="PCBPhantasma" class="anchor">Select</span><ul id="PCBPhantasm" class="category">';
                            foreach ($achievs as $key => $achiev) {
                                echo '<li><input type="checkbox" value="' . $achiev . '" id="' . $game . $diff . $key . '"><label for="' . $game . $diff . $key . '">' . _($achiev) . '</label></li>';
                            }
                            echo '</ul></div></td>';
                        } else if ($game != 'PCB' && $diff == 'Extra') {
                            echo '<td class="noborders"></td>';
                        }
                        if ($game == 'HRtPMakai') {
                            echo '<td id="J' . $diff . '" class="hidden">';
                        }
                        if ($game == 'INFinalA' && $diff != 'Extra') {
                            echo '<td id="B' . $diff . '" class="hidden">';
                        }
                        if ($game == 'LoLKLegacy' && $diff != 'Extra') {
                            echo '<td id="L' . $diff . '" class="hidden">';
                        }
                    }
                    echo '</tr>';
                }
            ?></tbody>
    	</table>
        <section>
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
                <option value='NMNB+'><?php echo _('NMNB+') ?></option>
            </select>
            <br>
            <input id='fill_all' type='button' value='Fill All'>
		</section>
        <h2><?php echo _('Touhou 9.5 - Shoot the Bullet') ?></h2>
        <p class='center'><?php echo _('Tick scenes that you have cleared.') ?></p>
        <p class='message center'></p>
        <p class='error_message center'></p>
        <table id='stb' class='progress_table'>
            <thead>
                <tr>
                    <th><?php echo _('Stage') ?></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th class='scene_th'>9</th>
                </tr>
            </thead>
            <tbody><?php
                foreach ($stb as $stage => $scenes) {
                    echo '<tr><th>' . $stage . '</th>';
                    for ($i = 1; $i <= $scenes; $i++) {
                        echo '<td class="stb_td scene_td"><input type="checkbox" id="stb' . $stage . '-' . $i . '" class="checkbox_scene"></td>';
                    }
                    echo '</tr>';
                }
            ?></tbody>
        </table>
        <section>
            <label for='fill_stb_stage'><?php echo _('Stage') ?></label>
            <select id='fill_stb_stage'><?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<option>' . _('Stage ' . $i) . '</option>';
                }
                echo '<option>Stage EX</option>';
            ?></select>
            <br>
            <label for='fill_stb_progress'><?php echo _('Achievement') ?></label>
            <select id='fill_stb_progress'>
                <option value='1cc'><?php echo _('Clear') ?></option>
                <option value='Not cleared'><?php echo _('Not cleared') ?></option>
            </select>
            <br>
            <input id='fill_stb' type='button' value='Fill All' data_id='stb'>
        </section>
        <h2><?php echo _('Touhou 12.5 - Double Spoiler') ?></h2>
        <p class='center'><?php echo _('You can specify whether you have cleared a scene with Aya or Hatate.') ?></p>
        <p class='message center'></p>
        <p class='error_message center'></p>
        <table id='ds' class='progress_table'>
            <caption id='legendDS' class='legend_surv'>
    			<span class='legend clear'></span> <?php echo _('Aya') ?>
    			<span class='legend nb'></span> <?php echo _('Hatate') ?>
    			<span class='legend nmnb'></span> <?php echo _('Both') ?>
    		</caption>
            <thead>
                <tr>
                    <th><?php echo _('Stage') ?></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th class='scene_th'>9</th>
                </tr>
            </thead>
            <tbody><?php
                foreach ($ds as $stage => $scenes) {
                    echo '<tr><th>' . $stage . '</th>';
                    for ($i = 1; $i <= $scenes; $i++) {
                        echo '<td class="ds_td scene_td"><div class="dropdown-check-list" tabindex="100"><span id="ds' . $stage . '-' . $i . 'a" class="anchor">Select</span><ul id="ds' . $stage . '-' . $i . '" class="category">';
                        if ($stage != 'SP' || $i < 4) {
                            echo '<li><input type="checkbox" value="' . _('Aya') . '" id="ds' . $stage . '-' . $i . '0"><label for="ds' . $stage . '-' . $i . '0">' . _('Aya') . '</label></li>';
                        }
                        if ($stage != 'SP' || $i >= 4) {
                            echo '<li><input type="checkbox" value="' . _('Hatate') . '" id="ds' . $stage . '-' . $i . '1"><label for="ds' . $stage . '-' . $i . '1">' . _('Hatate') . '</label></li>';
                            echo '</ul></div></td>';
                        }
                    }
                    echo '</tr>';
                }
            ?></tbody>
        </table>
        <section>
            <label for='fill_ds_stage'><?php echo _('Stage') ?></label>
            <select id='fill_ds_stage'><?php
                for ($i = 1; $i <= 12; $i++) {
                    echo '<option>' . _('Stage ' . $i) . '</option>';
                }
                echo '<option>Stage EX</option>';
                echo '<option>Stage SP</option>';
            ?></select>
            <br>
            <label for='fill_ds_progress'><?php echo _('Achievement') ?></label>
            <select id='fill_ds_progress'>
                <option value='Aya'><?php echo _('Aya') ?></option>
                <option value='Hatate'><?php echo _('Hatate') ?></option>
                <option value='Both'><?php echo _('Both') ?></option>
                <option value='Not cleared'><?php echo _('Not cleared') ?></option>
            </select>
            <br>
            <input id='fill_ds' type='button' value='Fill All' data_id='ds'>
        </section>
        <h2><?php echo _('Touhou 14.3 - Impossible Spell Card') ?></h2>
        <p class='center'><?php echo _('You can specify No Items clears as well as regular ones.') ?></p>
        <p class='message center'></p>
        <p class='error_message center'></p>
        <table id='isc' class='progress_table'>
            <caption id='legendISC' class='legend_surv'>
    			<span class='legend clear'></span> <?php echo _('Clear') ?>
    			<span class='legend nmnb'></span> <?php echo _('No Items') ?>
    		</caption>
            <thead>
                <tr>
                    <th><?php echo _('Day') ?></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th class='scene_th'>10</th>
                </tr>
            </thead>
            <tbody><?php
                foreach ($isc as $stage => $scenes) {
                    echo '<tr><th>' . $stage . '</th>';
                    for ($i = 1; $i <= $scenes; $i++) {
                        echo '<td class="isc_td scene_td"><div class="dropdown-check-list" tabindex="100"><span id="isc' . $stage . '-' . $i . 'a" class="anchor">Select</span><ul id="isc' . $stage . '-' . $i . '" class="category">';
                        echo '<li><input type="checkbox" value="' . _('Clear') . '" id="isc' . $stage . '-' . $i . '0"><label for="isc' . $stage . '-' . $i . '0">' . _('Clear') . '</label></li>';
                        echo '<li><input type="checkbox" value="' . _('No Items') . '" id="isc' . $stage . '-' . $i . '1"><label for="isc' . $stage . '-' . $i . '1">' . _('No Items') . '</label></li>';
                        echo '</ul></div></td>';
                    }
                    echo '</tr>';
                }
            ?></tbody>
        </table>
        <section>
            <label for='fill_isc_stage'><?php echo _('Stage') ?></label>
            <select id='fill_isc_stage'><?php
                for ($i = 1; $i <= 10; $i++) {
                    echo '<option>' . _('Day ' . $i) . '</option>';
                }
            ?></select>
            <br>
            <label for='fill_isc_progress'><?php echo _('Achievement') ?></label>
            <select id='fill_isc_progress'>
                <option value='Clear'><?php echo _('Clear') ?></option>
                <option value='No Items'><?php echo _('No Items') ?></option>
                <option value='Not cleared'><?php echo _('Not cleared') ?></option>
            </select>
            <br>
            <input id='fill_isc' type='button' value='Fill All' data_id='isc'>
        </section>
        <h2><?php echo _('Touhou 16.5 - Violet Detector') ?></h2>
        <p class='center'><?php echo _('Tick scenes that you have cleared.') ?></p>
        <p class='message center'></p>
        <p class='error_message center'></p>
        <table id='vd' class='progress_table'>
            <thead>
                <tr>
                    <th><?php echo _('Day') ?></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th class='scene_th'>7</th>
                </tr>
            </thead>
            <tbody><?php
                foreach ($vd as $stage => $scenes) {
                    echo '<tr><th>' . $stage . '</th>';
                    for ($i = 1; $i <= $scenes; $i++) {
                        echo '<td class="vd_td scene_td"><input type="checkbox" id="vd' . $stage . '-' . $i . '" class="checkbox_scene"></td>';
                    }
                    echo '</tr>';
                }
            ?></tbody>
        </table>
        <section>
            <label for='fill_vd_stage'><?php echo _('Stage') ?></label>
            <select id='fill_vd_stage'><?php
                foreach ($vd as $stage => $scenes) {
                    echo '<option>' . _($stage) . '</option>';
                }
            ?></select>
            <br>
            <label for='fill_vd_progress'><?php echo _('Achievement') ?></label>
            <select id='fill_vd_progress'>
                <option value='1cc'><?php echo _('Clear') ?></option>
                <option value='Not cleared'><?php echo _('Not cleared') ?></option>
            </select>
            <br>
            <input id='fill_vd' type='button' value='Fill All' data_id='vd'>
        </section>
    </div>
    <div id='bottom' data-html2canvas-ignore>
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
<div id='modal' data-html2canvas-ignore>
	<div id='results' class='modal_inner'>
		<h2><?php echo _('Progress Table') ?></h2>
		<div id='screenshot'>
            <a id='screenshot_link' href='' download='' class='device_link'>
                <input type='button' value='Save to Device'>
            </a>
            <input id='clipboard' type='button' value='Copy to Clipboard' data_id='screenshot_base64'>
		    <p id='rendering_message' class='rendering_message'></p>
            <p><img id='screenshot_base64' src='' alt='Survival progress table'></p>
        </div>
        <h2><?php echo _('Shoot the Bullet') ?></h2>
        <div>
            <a id='stb_link' href='' download='' class='device_link'>
                <input type='button' value='Save to Device'>
            </a>
            <input id='clipboard_stb' type='button' value='Copy to Clipboard' data_id='stb_base64'>
		    <p id='rendering_message_stb' class='rendering_message'></p>
            <p><img id='stb_base64' src='' alt='StB progress table'></p>
        </div>
        <h2><?php echo _('Double Spoiler') ?></h2>
        <div>
            <a id='ds_link' href='' download='' class='device_link'>
                <input type='button' value='Save to Device'>
            </a>
            <input id='clipboard_ds' type='button' value='Copy to Clipboard' data_id='ds_base64'>
		    <p id='rendering_message_ds' class='rendering_message'></p>
            <p><img id='ds_base64' src='' alt='DS progress table'></p>
        </div>
        <h2><?php echo _('Impossible Spell Card') ?></h2>
        <div>
            <a id='isc_link' href='' download='' class='device_link'>
                <input type='button' value='Save to Device'>
            </a>
            <input id='clipboard_isc' type='button' value='Copy to Clipboard' data_id='isc_base64'>
		    <p id='rendering_message_isc' class='rendering_message'></p>
            <p><img id='isc_base64' src='' alt='ISC progress table'></p>
        </div>
        <h2><?php echo _('Violet Detector') ?></h2>
        <div>
            <a id='vd_link' href='' download='' class='device_link'>
                <input type='button' value='Save to Device'>
            </a>
            <input id='clipboard_vd' type='button' value='Copy to Clipboard' data_id='vd_base64'>
		    <p id='rendering_message_vd' class='rendering_message'></p>
            <p><img id='vd_base64' src='' alt='VD progress table'></p>
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
					<th><?php echo _('NMNB+') ?></th>
				</tr>
			</thead>
			<tbody id='number_table_tbody'></tbody>
			<tfoot>
				<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr id='number_table_totals'><td><strong><?php echo _('Total') ?></strong></td></tr>
			</tfoot>
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
        <h2><?php echo _('Scene Game Completion') ?></h2>
        <table>
            <tr>
                <th><?php echo _('StB') ?></th><td id='completion_stb'></td>
            </tr><tr>
                <th><?php echo _('DS Aya') ?></th><td id='completion_aya'></td>
            </tr><tr>
                <th><?php echo _('DS Hatate') ?></th><td id='completion_hatate'></td>
            </tr><tr>
                <th><?php echo _('ISC') ?></th><td id='completion_isc'></td>
            </tr><tr>
                <th><?php echo _('ISC No Items') ?></th><td id='completion_noitems'></td>
            </tr><tr>
                <th><?php echo _('VD') ?></th><td id='completion_vd'></td>
            </tr>
        </table>
	</div>
    <div id='import_text' class='modal_inner'>
        <h2>Import from Text File</h2>
        <p>Note that the format should be the same as the exported text.</p>
        <p><strong>Warning:</strong> Importing can overwrite your current survival progress!</p>
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
            <a id='save_link' href='#' download='#' class='device_link'>
                <input type='button' class='button' value='Save to Device'>
            </a>
        </p>
    </div>
</div>
