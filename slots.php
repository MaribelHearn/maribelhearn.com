<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

    <head>
		<title>Touhou Slot Machine</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Touhou randomizer based on Touhou Click and Drag Game, with customisation options.'>
        <meta name='keywords' content='touhou, touhou project, slots, slot machine, waifu'>
		<link rel='stylesheet' type='text/css' href='assets/slots/slots.css'>
		<link rel='icon' type='image/x-icon' href='assets/slots/slots.ico'>
		<script src='assets/shared/html2canvas.js' defer></script>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/slots/slots.js' defer></script>
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
            <img id='hy' src='assets/shared/h-bar.png' alt='Human-youkai gauge' title='Human Mode'>
            <h1>Touhou Slot Machine</h1>
            <p>Click any of the slot title texts to change what it says.</p>
            <p>
                <input id='start' type='button' value='Insert Coin'>
                <input id='stop' type='button' value='Stop'>
                <input id='screenshot' type='button' value='Screenshot'>
                <input id='reset' type='button' value='Reset Titles'>
            </p>
            <table id='table'>
                <tr>
                    <td id='title0' class='title'>You are a ...</td>
                    <td id='title1' class='title' valign='bottom'>Best friend</td>
                    <td id='title2' class='title' valign='bottom'>Hates you</td>
                </tr>
                <tr>
                    <td id='slot0'></td>
                    <td id='slot1' class='slot charslot'></td>
                    <td id='slot2' class='slot charslot'></td>
                </tr>
                <tr>
                    <td id='title3' class='title'>First kiss</td>
                    <td id='title4' class='title'>Has a crush on you</td>
                    <td id='title5' class='title'>Married to</td>
                </tr>
                <tr>
                    <td id='slot3' class='slot charslot'></td>
                    <td id='slot4' class='slot charslot'></td>
                    <td id='slot5' class='slot charslot'></td>
                </tr>
                <tr>
                    <td id='title6' class='title'>Honeymoon location</td>
                    <td id='title7' class='title'>No. of children</td>
                    <td id='title8' class='title'>Cockblocked by</td>
                </tr>
                <tr>
                    <td id='slot6' class='slot locslot'></td>
                    <td id='slot7'></td>
                    <td id='slot8' class='slot charslot'></td>
                </tr>
            </table>
            <p>The artworks used for this page are drawn by
            <a href='https://www.pixiv.net/member.php?id=4920496' target='_blank'>Dairi</a>.</p>
            <p>Credit to an unknown original creator for the idea of this randomizer.</p>
            <p>Originally known as Touhou Click and Drag Game.</p>
        </div>
        <div id='modal'>
            <div id='modal_inner'></div>
        </div>
        <script src='assets/shared/dark.js'></script>
        <?php
            $json = file_get_contents('assets/json/charpos.json');
            $chars = json_decode($json, true);
            $json = file_get_contents('assets/json/locs.json');
            $locs = json_decode($json, true);
            echo '<div id="chars_load">';
            foreach ($chars as $key => $name) {
                echo '<input id="' . $key . '" type="hidden" value="' . $name . '">';
            }
            echo '</div><div id="locs_load">';
            foreach ($locs as $key => $name) {
                echo '<input id="' . $key . '" type="hidden" value="' . $name . '">';
            }
            echo '</div>';
        ?>
    </body>

</html>
