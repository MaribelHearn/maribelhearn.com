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
                <option value='cards'>Cards</option>
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
        <table id='tier_list_table' class='noborders'>
			<caption id='tier_list_caption'></caption>
            <thead id='tier_list_thead' data-html2canvas-ignore>
                <tr id='tier_list_name_tr'>
                    <td id='tier_list_name_cell' colspan='2'>
                        <label for='tier_list_name'>Tier list name: </label><input id='tier_list_name' type='text' maxlength='200'>
                        <input id='add_tier_list_name' type='button' value='Apply'>
                    </td>
                </tr>
                <tr id='add_tier_box_mobile'>
                    <td id='add_tier_cell_mobile' colspan='2'>
                        <span id='msg_container_mobile'></span><br>
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
        <noscript><p><strong>Notice:</strong> this page requires JavaScript.</p></noscript>
    </div>
</div>
<div id='modal' data-html2canvas-ignore>
    <div id='info_desktop' class='modal_inner'>
        <h2>Welcome!</h2>
        <p>This page allows you to create your own Touhou tier lists. Currently, you can sort characters, works, and shottypes. Usage instructions are listed below.</p>
        <ul class='instructions_list'>
            <li><strong>Adding Items:</strong> Drag an item onto a tier box, or the field, to add that item to it. You can also double click an item to add it to a tier, using a popup menu.</li>
            <li><strong>Moving Items:</strong> Drag an item onto another item to move that item to its location. The same double click menu that can be used in the picker can also be used for this.</li>
            <li><strong>Multi Selection:</strong> Click multiple items to drag them together, adding them to a tier in your 
            clicking order. Alternatively, press Enter to add a selection of multiple characters to a tier, using a popup menu.</li>
            <li><strong>Removing Items:</strong> Right click an item in a tier, or drag it 
            onto the picker, to remove it from that tier.</li><li><strong>Add All Remaining:</strong> Ctrl+Click a 
            tier to add all remaining items to it.</li><li><strong>Adding Tiers:</strong> Use the Add Tier text field 
            and button at the bottom of the tier list to add a new tier, or press Enter while in the text field.</li>
            <li><strong>Moving Tiers:</strong> Drag a tier onto another tier to move it to its position.</li>
            <li><strong>Editing Tiers:</strong> Click a tier to edit that tier, such as its name or background colour.</li>
            <li><strong>Removing Tiers:</strong> Right click a tier to remove that tier and all of its contents. 
            Asks for confirmation if there are items in it.</li>
            <li><strong>Emptying Tiers:</strong> Ctrl+Right Click a tier to empty it. Asks for confirmation.</li>
        </ul>
        <p>Use the buttons at the top of the screen to save your tier lists, import/export to text, take a screenshot, change the tier list settings, view the changelog, or reset for a new start.</p>
        <p>Click outside the window, or press Esc, to close popup windows like this one.</p>
    </div>
    <div id='info_mobile' class='modal_inner'>
        <h3>Welcome!</h3>
        <p>This page allows you to create your own Touhou tier lists. Currently, you can sort characters, works, and shottypes. Usage instructions are listed below.</p>
        <ul class='instructions_list'>
            <li><strong>Adding Items:</strong> Long press and drag an item into a tier box or the field.</li>
            <li><strong>Moving Items:</strong> Long press and drag an item onto another item to move that item to its location.</li>
            <li><strong>Multi Selection:</strong> Tap multiple items to drag them together, adding them to a tier, in your clicking order.</li>
            <li><strong>Removing Items:</strong> Long press and drag an item from a tier onto the picker to remove it from that tier.</li>
            <li><strong>Adding Tiers:</strong> Use the Add Tier text field and button at the top of the tier list to add a new tier.</li>
            <li><strong>Moving Tiers:</strong> Long press and drag a tier onto another tier to move it to its position.</li>
            <li><strong>Editing Tiers:</strong> Tap a tier to edit that tier, such as its name or background colour.</li>
            <li><strong>Removing Tiers:</strong> Tap a tier and click the Remove This Tier button to remove it and all of its contents.</li>
        </ul>
        <p>Use the buttons at the bottom of the screen to save your tier lists, open the main menu, view these instructions, and switch between tiering characters, works, and shottypes (Switch Mode).</p>
        <p>Tap outside the window to close popup windows like this one.</p>
    </div>
    <div id='import_text' class='modal_inner'>
        <h2>Import from Text File</h2>
        <p>Note that the format should be the same as the exported text.</p>
        <p><strong>Warning:</strong> Importing can overwrite one of your current tier lists!</p>
        <form target='_self' method='post' enctype='multipart/form-data'>
            <label for='import_file'>Upload file:</label>
            <input id='import_file' name='import' type='file'>
            <p class='mobile_button_p'><input type='submit' value='Import'></p>
        </form>
    </div>
    <div id='export_text' class='modal_inner'>
        <h2>Export to Text File</h2>
        <p class='mobile_button_p'>
            <input id='copy_to_clipboard' type='button' value='Copy to Clipboard'>
            <input id='text_file' type='hidden' value=''>
        </p>
        <p class='mobile_button_p'>
            <a id='save_link' href='#' download='#'>
                <input type='button' class='button' value='Save to Device'>
            </a>
        </p>
    </div>
    <div id='screenshot' class='modal_inner'>
        <h2>Screenshot</h2>
        <p class='mobile_button_p'>
            <a id='screenshot_link' href='#' download='#'>
                <input type='button' class='button' value='Save to Device'>
            </a>
        </p>
        <!--<p><input id='clipboard' type='button' class='button' value='Copy to Clipboard'></p>-->
        <p>
            <img id='screenshot_base64' src='' alt='Tier list screenshot'>
        </p>
    </div>
    <div id='settings' class='modal_inner'>
        <h2>Settings</h2>
        <div id='settings_characters'>
            Include items in the following works of first appearance:
            <table id='settings_characters_table' class='noborders'>
                <tbody id='settings_characters_tbody'></tbody>
            </table>
            <p>
                <label for='pc98'>PC-98</label>
                <input id='pc98' type='checkbox'>
            </p>
            <p>
                <label for='windows'>Windows</label>
                <input id='windows' type='checkbox'>
            </p>
            <p>
                <label for='male'>Male Characters</label>
                <input id='male' type='checkbox'>
            </p>
            <p>
                <label for='themes'>Boss Theme Duplicates</label>
                <input id='themes' type='checkbox'>
            </p>
        </div>
        <div id='settings_other'>
            Include items in the following categories:
            <table id='settings_table'>
                <tbody id='settings_tbody'></tbody>
            </table>
        </div>
        <div>
            Other settings:
            <p>
                <label for='tier_list_name_menu'>Tier list name (optional)</label>
                <input id='tier_list_name_menu' class='settings_input' type='text' value=''>
            </p>
            <p>
                <label for='tier_list_colour'>Tier list colour</label>
                <input id='tier_list_colour' class='settings_input' type='color' value=''>
            </p>
            <p>
                <label for='tier_header_width'>Tier header width</label>
                <input id='tier_header_width' class='settings_input' type='number' value=''>
            </p>
            <p>
                <label for='tier_header_font_size'>Tier header font size</label>
                <input id='tier_header_font_size' class='settings_input' type='number' max='72' value=''>
            </p>
            <p>
                <label for='screenshot_width'>Screenshot width (by number of items)</label>
                <input id='screenshot_width' class='settings_input' type='number' min='1' value=''>
            </p>
            <p>To customise a tier's name and colour, click it in your tier list.</p>
            <p class='mobile_button_p'><input id='save_settings' type='button' value='Save Changes'></p>
            <p id='settings_msg_container'></p>
        </div>
    </div>
    <div id='changelog' class='modal_inner'>
        <h2>Changelog</h2>
        <ul class='left'>
            <li>05/12/2018: Initial release</li>
            <li>05/12/2018: Dairi art added and made the default; PC-98 and male characters added</li>
            <li>21/01/2019: Mobile version</li>
            <li>24/04/2019: Works added</li>
            <li>18/08/2019: Migrated to maribelhearn.com</li>
            <li>17/09/2019: Mobile version bugs fixed and speed increased; changelog added</li>
            <li>04/10/2019: WBaWC characters added</li>
            <li>19/12/2019: Fixed character disappearance bug and related issues</li>
            <li>02/01/2020: Fixed tier list loading bug</li>
            <li>13/03/2020: Fixed bug caused by swapping tiers as well as a bug caused by naming a tier after a character</li>
            <li>06/04/2020: Added ability to change the tier header font size and made tier header width changes apply immediately</li>
            <li>06/09/2020: Miyoi Okunoda added</li>
            <li>23/09/2020: Screenshotting added, only working on Firefox</li>
            <li>26/06/2021: UM characters added</li>
            <li>18/07/2021: Screenshotting fixed, works on all modern browsers</li>
            <li>20/07/2021: Shottypes added</li>
            <li>06/11/2021: Yuuma Toutetsu added</li>
            <li>01/01/2022: Import and export to text now uses files</li>
            <li>19/08/2023: UDoALG shottypes added</li>
            <li>22/09/2023: UDoALG characters added</li>
        </ul>
    </div>
    <div id='reset' class='modal_inner'>
        <h2>Reset</h2>
        <p>Are you sure you want to reset your tier lists and settings to the defaults?</p>
        <p><strong>Erase All</strong> will permanently erase all of your loaded tier lists and settings.</p>
        <p><strong>Erase Current Tier List</strong> will only erase the tier list that is currently open.</p>
        <p class='mobile_button_p'><input id='erase_all_button' class='mobile_button' type='button' value='Erase All'></p>
        <p class='mobile_button_p'><input id='erase_single_button' class='mobile_button' type='button' value='Erase Current Tier List'></p>
        <p class='mobile_button_p'><input id='cancel_button' class='mobile_button' type='button' value='Cancel'></p>
    </div>
    <div id='tier_menu' class='modal_inner'>
        <h2 id='tier_menu_header'>Customise Tier</h2>
        <p class='name'>
            <label for='custom_name_tier'>Name</label>
            <input id='custom_name_tier' type='text' value=''>
            <input id='tier_num' type='hidden' value=''>
        </p>
        <p class='colour'>
            <label for='custom_bg_tier'>Background Colour</label>
            <input id='custom_bg_tier' type='color' value=''>
        </p>
        <p>
            <label for='custom_colour_tier'>Text Colour</label>
            <input id='custom_colour_tier' type='color' value=''>
        </p>
        <p><input id='save_tier_settings' type='button' value='Save Changes'></p>
        <p><input id='remove_tier' type='button' value='Remove This Tier'></p>
        <p id='tier_menu_msg_container'></p>
    </div>
    <div id='menu_mobile' class='modal_inner'>
        <h3>Menu</h3>
        <input id='import_button_mobile' type='button' class='button menu' value='Import'>
        <input id='export_button_mobile' type='button' class='button menu' value='Export'>
        <input id='screenshot_button_mobile' type='button' class='button menu' value='Screenshot'>
        <input id='settings_button_mobile' type='button' class='button menu' value='Settings'>
        <input id='changelog_button_mobile' type='button' class='button menu' value='Changelog'>
        <input id='reset_button_mobile' type='button' class='button menu' value='Reset'>
        <h3>Navigation</h3>
        <p><a href='/'><span class='icon index_icon'></span> Index</a></p>
        <?php
            echo game_pages();
            $other_pages = other_pages();
            $other_pages = str_replace('<a href="/tiers">', '<strong>', $other_pages);
            echo str_replace('Tiers</a>', 'Tiers</strong>', $other_pages);
            echo personal_pages();
        ?>
    </div>
    <div id='add_menu_mobile' class='modal_inner'>
        <h3 id='selection'>Selection</h3>
        <p id='selection_text'>Add to tier:</p>
        <p id='add_menu_inputs'></p>
    </div>
</div>
<div id='buttons_mobile' class='dark_bg' data-html2canvas-ignore>
	<input id='save_button_mobile' type='button' value='Save'>
	<input id='menu_button' type='button' value='Menu'>
	<input id='information_button' class='button_bottom' type='button' value='Information'>
	<input id='switch_button' class='button_bottom' type='button' value='Switch Mode'>
</div>
<div id='characters' class='dark_bg' data-html2canvas-ignore><?php
    if (!isset($_COOKIE['sort'])) {
        $sort = 'characters';
    } else {
        $sort = $_COOKIE['sort'];
    }
    $json = file_get_contents('assets/shared/json/' . $sort . '.json');
    $cats = json_decode($json, true);
    foreach ($cats as $categoryName => $category) {
        echo '<div id="' . $categoryName . '" class="dark_bg">';
        foreach ($category['chars'] as $key => $item) {
            if ($sort == 'shots') {
                $item = $categoryName . str_replace(' Team', 'Team', $item);
            }
            echo '<span id="' . $item . 'C"><span id="' . $item . '" class="item list_' . $sort . '" draggable="true"></span></span>';
        }
        echo '</div>';
    }
?></div>
