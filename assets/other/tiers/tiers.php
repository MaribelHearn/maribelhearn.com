<div id='wrap' class='dark_bg'>
    <div id='init' class='dark_bg' data-html2canvas-ignore>
		<nav>
			<div id='nav' class='dark_bg'><?php echo navbar($page) ?></div>
		</nav>
        <h1 id='title'>Touhou Tier List Creator</h1>
        <?php
            if (!empty($_GET['redirect'])) {
                echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
            }
        ?>
        <div id='sort_selection' class='dark_bg'>
            <label id='currently_tiering' for='sort'>Currently tiering:</label>
            <select id='sort'>
                <option value='characters'>Characters</option>
                <option value='works'>Works</option>
                <option value='shots'>Shottypes</option>
            </select>
            <label for='toggle_view'>Change view:</label>
            <input id='toggle_view' class='button' type='button' value='Tier List View'>
            <input id='toggle_picker' class='button' type='button' value='Small Picker'>
        </div>
        <div id='buttons' class='dark_bg'>
            <input id='info_button' type='button' value='Information'>
            <input id='save_button' type='button' class='button menu' value='Save'>
        	<input id='import_button' type='button' class='button menu' value='Import'>
        	<input id='export_button' type='button' class='button menu' value='Export'>
            <input id='screenshot_button' type='button' class='button menu' value='Screenshot'>
        	<input id='settings_button' type='button' class='button menu' value='Settings'>
            <input id='changelog_button' type='button' class='button menu' value='Changelog'>
            <input id='reset_button' type='button' class='button menu' value='Reset'>
        </div>
		<p id='msg_container'></p>
    </div>
    <div id='tier_list_container' class='dark_bg'>
        <table id='tier_list_table'>
			<caption id='tier_list_caption'></caption>
            <thead id='tier_list_thead' data-html2canvas-ignore>
                <tr id='tier_list_name_tr'>
                    <td id='tier_list_name_cell' colspan='2'>
                        <label for='tier_list_name_input'>Tier list name: </label><input id='tier_list_name' type='text' maxlength='200'>
                        <input id='add_tier_list_name' type='button' value='Apply'>
                    </td>
                </tr>
                <tr id='add_tier_box_mobile'>
                    <td id='add_tier_cell_mobile' colspan='2'>
                        <label for='tier_name_mobile'>
                            <span class='hidden'>.</span>
                            <input id='tier_name_mobile' type='text' value=''>
                        </label>
                        <label for='add_tier_mobile'>
                            <span class='hidden'>.</span>
                            <input id='add_tier_mobile' type='button' value='Add Tier'>
                        </label>
                    </td>
                </tr>
            </thead>
            <tbody id='tier_list_tbody'></tbody>
            <tfoot id='tier_list_tfoot' data-html2canvas-ignore>
                <tr>
                    <td id='add_tier_desktop'>
                        <label for='tier_name'>
                            <span class='hidden'>.</span>
                            <input id='tier_name' type='text' value=''>
                        </label>
                        <label for='add_tier'>
                            <span class='hidden'>.</span>
                            <input id='add_tier' type='button' value='Add Tier'>
                        </label>
                    </td><td class='hidden'></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div id='modal' data-html2canvas-ignore>
    <div id='modal_inner'></div>
</div>
<div id='buttons_mobile' class='dark_bg' data-html2canvas-ignore>
	<input id='save_button_mobile' type='button' value='Save'>
	<input id='menu_button' type='button' value='Menu'>
	<input id='information_button' class='button_bottom' type='button' value='Information'>
	<input id='switch_button' class='button_bottom' type='button' value='Switch Mode'>
	<p id='msg_container_mobile'></p>
</div>
<div id='characters' class='dark_bg' data-html2canvas-ignore></div>
<?php
    $json = file_get_contents('assets/other/tiers/json/chars.json');
    $chars = json_decode($json, true);
    $json = file_get_contents('assets/other/tiers/json/works.json');
    $works = json_decode($json, true);
    $json = file_get_contents('assets/shared/json/shots.json');
    $shots = json_decode($json, true);
    echo '<div id="chars_load" class="dark_bg" data-html2canvas-ignore>';
    foreach ($chars as $category => $value) {
        foreach ($chars[$category] as $key => $value) {
            echo '<input id="' . $category . '" type="hidden" value="' . implode(',', $value) . '">';
        }
    }
    echo '</div><div id="works_load" class="dark_bg" data-html2canvas-ignore>';
    foreach ($works as $category => $value) {
        foreach ($works[$category] as $key => $value) {
            echo '<input id="' . $category . '" type="hidden" value="' . implode(',', $value) . '">';
        }
    }
    echo '</div><div id="shots_load" class="dark_bg" data-html2canvas-ignore>';
    foreach ($shots as $category => $value) {
        foreach ($shots[$category] as $key => $value) {
			foreach ($value as $key => $shot) {
				$value[$key] = $category . ' ' . $shot;
			}
            echo '<input id="' . $category . '" type="hidden" value="' . implode(',', $value) . '">';
        }
    }
    echo '</div>';
?>
