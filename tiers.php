<!DOCTYPE html>
<html lang='en'>
<?php
	include 'assets/shared/shared.php';
    require_once 'assets/shared/mobile_detect.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
    $detect_device = new Mobile_Detect;
    $is_mobile = $detect_device -> isMobile();
?>

    <head>
		<title>Touhou Tier List Creator</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Create your own Touhou tier lists!'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, tier list, tiers, sorter, sort, sorting, creator'>
		<link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=<?php echo $page . '&mobile=' . $is_mobile ?>'>
		<link rel='icon' type='image/x-icon' href='assets/tiers/tiers.ico'>
        <script src='assets/shared/js_concat.php?page=<?php echo $page . '&mobile=' . $is_mobile ?>' defer></script>
    </head>

    <body>
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
				<div id='credits_container'>
		            <div id='acknowledgements'>
		                <p class='thin'>The artworks used for this page are drawn by:</p>
						<ul id='credits'>
							<li><a href='https://www.pixiv.net/member.php?id=4920496' target='_blank'>Dairi:</a> Characters</li>
							<li><a href='https://twitter.com/korindo' target='_blank'>ZUN:</a> Shottypes</li>
							<li><a href='http://www.pixiv.net/member.php?id=4678572' target='_blank'>ETERSIARUM:</a> Background</li>
		                </ul>
						<p class='thin'>Special thanks go to:</p>
						<ul id='special_thanks'>
							<li><a href='https://www.youtube.com/channel/UCI1HPxKRky4Zm_mrRUH415Q' target='_blank'>Plus:</a> Original idea, testing</li>
							<li><a href='https://twitter.com/Doroshii_Sweet' target='_blank'>Dorothy Sweet:</a> Design, testing</li>
							<li><a href='https://twitter.com/pienyan_' target='_blank'>pienyan:</a> Testing</li>
							<li><a href='https://twitter.com/TheDukeofBooms' target='_blank'>ZXNova:</a> Most Dairi face crops</li>
							<li><a href='https://twitter.com/CuprianLycoris'>Cuprian Lycoris:</a> Most ZUN face crops</li>
						</ul>
		            </div>
				</div>
				<p id='msg_container'></p>
            </div>
            <div id='tier_list_container' class='dark_bg'>
                <table id='tier_list_table'>
					<caption id='tier_list_caption'></caption>
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
            $json = file_get_contents('assets/json/chars.json');
            $chars = json_decode($json, true);
            $json = file_get_contents('assets/json/works.json');
            $works = json_decode($json, true);
            $json = file_get_contents('assets/json/shots.json');
            $shots = json_decode($json, true);
            echo '<div id="chars_load" class="dark_bg">';
            foreach ($chars as $category => $value) {
                foreach ($chars[$category] as $key => $value) {
                    echo '<input id="' . $category . '" type="hidden" value="' . implode(',', $value) . '">';
                }
            }
            echo '</div><div id="works_load" class="dark_bg">';
            foreach ($works as $category => $value) {
                foreach ($works[$category] as $key => $value) {
                    echo '<input id="' . $category . '" type="hidden" value="' . implode(',', $value) . '">';
                }
            }
            echo '</div><div id="shots_load" class="dark_bg">';
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
    </body>

</html>
