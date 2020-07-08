<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

	<head>
		<title>Survival Progress Table Generator</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Generate a table that summarises your Touhou survival progress.'>
        <meta name='keywords' content='touhou, touhou project, survival, 1cc, 1ccs, clear, clears, progress, progress table'>
		<link rel='stylesheet' type='text/css' href='assets/survival/survival.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&display=swap'>
		<link rel='icon' type='image/x-icon' href='assets/survival/survival.ico'>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/survival/survival.js' defer></script>
        <script src='assets/shared/sorttable.js' defer></script>
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
			<img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
			<h1>Survival Progress Table Generator</h1>
			<?php
				if (!empty($_GET['redirect'])) {
					echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
				}
			?>
            <noscript><strong>Notice:</strong> this page cannot function properly with JavaScript disabled.</noscript>
			<p>Fill in the best survivals you have pulled off in the table below. If you leave a dropdown menu on the N/A option, it will not be factored in.
            At the bottom of the page, three different sortable tables indicating your survival progress will be generated.</p>
            <p>NM = No Miss (no deaths), NB = No Bomb, NMNB = No Miss No Bomb. There can also be a third restriction, depending on the game.
            In PCB this restriction is NBB (No Border Breaks), in UFO it is NV (No UFO Summons),
			in TD it is NT (No Trance), in HSiFS it is NR (No Releases) and in WBaWC it is No Berserk Roar No Roar Breaks (NHNRB).
            The Phantasm Stage counts as another Extra Stage.</p>
            <p>Use the below selectors to fill up many achievements at once. Normal, Hard and Lunatic will also fill the difficulties below them.</p>
            <p>To allow for proper screenshots, the background for the tables is not transparent.</p>
            <p>Legend: purple = NN (with third restriction, if any), dark blue = NB with third restriction, blue = NB, brown = NM, green = 1cc.</p>
            <p>
                <label for='fillGameDifficulty'>Game / Difficulty</label>
                <select id='fillGameDifficulty'>
                    <option>HRtP</option>
                    <option>SoEW</option>
                    <option>PoDD</option>
                    <option>LLS</option>
                    <option>MS</option>
                    <option>EoSD</option>
                    <option>PCB</option>
                    <option>IN</option>
                    <option>PoFV</option>
                    <option>MoF</option>
                    <option>SA</option>
                    <option>UFO</option>
                    <option>GFW</option>
                    <option>TD</option>
                    <option>DDC</option>
                    <option>LoLK</option>
                    <option>HSiFS</option>
                    <option>WBaWC</option>
                    <option>Easy</option>
                    <option>Normal</option>
                    <option>Hard</option>
                    <option>Lunatic</option>
                    <option>Extra</option>
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
			<div id='dummy'><div id='dummy_sub'></div></div>
			<div id='container'>
	            <table id='survival' class='nomargin'>
	                <tr>
	                    <th>Game</th>
	                    <th>Easy</th>
	                    <th>Normal</th>
	                    <th>Hard</th>
	                    <th>Lunatic</th>
	                    <th>Extra</th>
	                    <th>Phantasm</th>
	                </tr>
	                <tr>
	                    <td>HRtP</td>
	                    <td>
	                        <select id='HRtPEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HRtPNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HRtPHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HRtPLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>SoEW</td>
	                    <td>
	                        <select id='SoEWEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>PoDD</td>
	                    <td>
	                        <select id='PoDDEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoDDNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoDDHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoDDLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>LLS</td>
	                    <td>
	                        <select id='LLSEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>MS</td>
	                    <td>
	                        <select id='MSEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>EoSD</td>
	                    <td>
	                        <select id='EoSDEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>PCB</td>
	                    <td>
	                        <select id='PCBEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNBB</option>
	                            <option>NMNBNBB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PCBNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNBB</option>
	                            <option>NMNBNBB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PCBHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNBB</option>
	                            <option>NMNBNBB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PCBLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNBB</option>
	                            <option>NMNBNBB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PCBExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNBB</option>
	                            <option>NMNBNBB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PCBPhantasm' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNBB</option>
	                            <option>NMNBNBB</option>
	                        </select>
	                    </td>
	                </tr>
	                <tr>
	                    <td>IN</td>
	                    <td>
	                        <select id='INEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>PoFV</td>
	                    <td>
	                        <select id='PoFVEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>MoF</td>
	                    <td>
	                        <select id='MoFEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>SA</td>
	                    <td>
	                        <select id='SAEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SANormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SAHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SALunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SAExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>UFO</td>
	                    <td>
	                        <select id='UFOEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNV</option>
	                            <option>NMNB(NV)</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='UFONormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNV</option>
	                            <option>NMNB(NV)</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='UFOHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNV</option>
	                            <option>NMNB(NV)</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='UFOLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNV</option>
	                            <option>NMNB(NV)</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='UFOExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNV</option>
	                            <option>NMNB(NV)</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>GFW</td>
	                    <td>
	                        <select id='GFWEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>TD</td>
	                    <td>
	                        <select id='TDEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNT</option>
	                            <option>NMNBNT</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='TDNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNT</option>
	                            <option>NMNBNT</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='TDHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNT</option>
	                            <option>NMNBNT</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='TDLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNT</option>
	                            <option>NMNBNT</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='TDExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNT</option>
	                            <option>NMNBNT</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>DDC</td>
	                    <td>
	                        <select id='DDCEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>LoLK</td>
	                    <td>
	                        <select id='LoLKEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>HSiFS</td>
	                    <td>
	                        <select id='HSiFSEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNR</option>
	                            <option>NMNBNR</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HSiFSNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNR</option>
	                            <option>NMNBNR</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HSiFSHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNR</option>
	                            <option>NMNBNR</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HSiFSLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNR</option>
	                            <option>NMNBNR</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HSiFSExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNR</option>
	                            <option>NMNBNR</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	                <tr>
	                    <td>WBaWC</td>
	                    <td>
	                        <select id='WBaWCEasy' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNHNRB</option>
	                            <option>NNNN</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='WBaWCNormal' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNHNRB</option>
	                            <option>NNNN</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='WBaWCHard' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNHNRB</option>
	                            <option>NNNN</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='WBaWCLunatic' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNHNRB</option>
	                            <option>NNNN</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='WBaWCExtra' class='category'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NBNHNRB</option>
	                            <option>NNNN</option>
	                        </select>
	                    </td>
	                    <td>N/A</td>
	                </tr>
	            </table>
			</div>
            <br>
            <p><label for='toggleData'>Save Data</label><input id='toggleData' type='checkbox'></p>
			<p><input id='apply' type='button' value='Apply'><input id='reset' type='button' value='Reset'></p>
			<div id='results'></div>
			<h2 id='ack'>Acknowledgements</h2>
			<p id='credit'>The background image
			was drawn by <a href='https://www.pixiv.net/member.php?id=759506'>windtalker</a>.</p>
		</div>
        <script src='assets/shared/dark.js'></script>
	</body>

</html>
