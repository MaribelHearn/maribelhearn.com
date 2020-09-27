<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

    <head>
		<title>Touhou Tier List Creator</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Create your own Touhou tier lists!'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, tier list, tiers, sorter, sort, sorting, creator'>
		<link rel='stylesheet' type='text/css' href='assets/tiers/tiers.css'>
		<link rel='icon' type='image/x-icon' href='assets/tiers/tiers.ico'>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/html2canvas.js' defer></script>
		<script src='assets/tiers/tiers.js' defer></script>
        <script src='assets/tiers/rgbcolor.js' defer></script>
    </head>

    <body class='<?php echo check_webp() ?>'>
        <div id='wrap'>
            <div id='init' data-html2canvas-ignore>
    			<nav id='nav'>
    				<?php
    					$nav = file_get_contents('nav.html');
    					$page = str_replace('.php', '', basename(__FILE__));
    					$nav = str_replace('<a href="' . $page . '">', '<strong>', $nav);
    					$cap = strlen($page) < 4 ? strtoupper($page) : ucfirst($page);
    					echo str_ireplace($page . '</a>', $cap . '</strong>', $nav);
    				?>
    			</nav>
                <h1 id='title'>Touhou Tier List Creator</h1>
                <?php
                    if (!empty($_GET['redirect'])) {
                        echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
                    }
                ?>
                <div id='sort_selection'>
                    <label for='sort'>Currently tiering:</label>
                    <select id='sort'>
                        <option value='characters'>Characters</option>
                        <option value='works'>Works</option>
                    </select>
                    <label for='toggle_view'>Change view:</label>
                    <input id='toggle_view' class='button' type='button' value='Tier List View'>
                </div>
                <div id='instructions'>
                    <p id='instructions_text'>This page allows you to create your own Touhou character tier list. Usage instructions are listed below.</p>
                    <ul id='instructions_list'>
                        <li>Drag a character onto a tier box to add that character to it.</li>
                        <li>Drag a character from the picker onto a tiered character to insert them to the right of them.</li>
                        <li>Drag a tiered character onto another tiered character to swap their positions.</li>
                        <li>Double click a character to add them to the most recently added tier (not remembered after closure).</li>
                        <li>Right click a character in a tier, or drag them onto the picker, to remove them from that tier.</li>
                        <li>Click a tier and then another tier to swap their positions.</li>
                        <li>Ctrl+Click a tier to add all remaining characters to it, and Ctrl+Right Click a tier to empty it.</li>
                        <li>Right click a tier to remove that tier and all of its contents.</li>
                        <li>Hover your cursor above a character to see their name.</li>
                    </ul>
                    <ul id='instructions_mobile'>
                        <li>Tap a character to add them to a tier.</li>
                        <li>Long press a character in a tier to either remove them from that tier,
                        move them to the back of the tier, or move them a tier up or down.</li>
                        <li>Tap a tier and then another tier to swap their positions.</li>
                        <li>Long press a tier to either remove it, remove all its characters,
                        or add all remaining characters to it.</li>
                    </ul>
                </div>
                <p id='toggle'>
                    <input id='toggle_instructions' type='button' value='Show Instructions'>
                    <span id='screenshot_button_tierview'></span>
                </p>
            </div>
            <div id='tier_list_container'>
                <table id='tier_list_table'>
                    <thead id='tier_list_thead' data-html2canvas-ignore>
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
        <div id='buttons'>
            <div id='credits'>
                <p>The artworks used for this page are drawn by
                <a href='https://www.pixiv.net/member.php?id=4920496' target='_blank'>Dairi</a> and
                <a href='http://www.pixiv.net/member.php?id=4678572' target='_blank'>ETERSIARUM</a>.
                Special thanks go to <a href='https://www.youtube.com/channel/UCI1HPxKRky4Zm_mrRUH415Q' target='_blank'>Plus</a> for the original idea as well as testing,
                <a href='https://twitter.com/pienyan_' target='_blank'>pienyan</a> for testing,
                <a href='https://twitter.com/Doroshii_Sweet' target='_blank'>Dorothy Sweet</a> for design improvements and
                <a href='https://twitter.com/TheDukeofBooms' target='_blank'>ZXNova</a> for the Dairi face crops.</p>
            </div>
            <div id='menu'>
                <input id='save_button' type='button' class='button menu' value='Save Tiers'>
                <input id='import_button' type='button' class='button menu' value='Import'>
                <input id='export_button' type='button' class='button menu' value='Export'>
                <br id='button_split'>
                <span id='screenshot_button_container'>
                    <input id='screenshot_button' type='button' class='button menu' value='Take Screenshot'>
                </span>
                <input id='settings_button' type='button' class='button menu' value='Settings'>
                <input id='changelog_button' type='button' class='button menu' value='Changelog'>
                <input id='reset_button' type='button' class='button menu' value='Reset'>
            </div>
            <input id='information_button' class='button' type='button' value='Information'>
            <input id='view_button' class='button' type='button' value='Tier List View'>
            <br id='mobile_button_split'>
            <input id='menu_button' class='button' type='button' value='Menu'>
            <input id='switch_button' class='button' type='button' value='Switch Mode'>
            <p id='msg_container'></p>
        </div>
        <div id='modal'>
            <div id='modal_inner'></div>
        </div>
        <div id='characters'></div>
        <?php
            $json = file_get_contents('assets/json/chars.json');
            $chars = json_decode($json, true);
            $json = file_get_contents('assets/json/works.json');
            $works = json_decode($json, true);
            echo '<div id="chars_load">';
            foreach ($chars as $category => $value) {
                foreach ($chars[$category] as $key => $value) {
                    echo '<input id="' . $category . '" type="hidden" value="' . implode($value, ',') . '">';
                }
            }
            echo '</div><div id="works_load">';
            foreach ($works as $category => $value) {
                foreach ($works[$category] as $key => $value) {
                    echo '<input id="' . $category . '" type="hidden" value="' . implode($value, ',') . '">';
                }
            }
            echo '</div>';
        ?>
    </body>

</html>
