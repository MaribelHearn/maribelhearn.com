<!DOCTYPE html>
<html lang='en' class='no-js'>
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
        <script src='assets/shared/modernizr-custom.js' defer></script>
        <script>document.documentElement.classList.remove("no-js");</script>
	</head>

	<body>
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
			<img id='hy' src='assets/shared/h-bar.png' title='Human Mode' onClick='theme(this)'>
			<h1>Survival Progress Table Generator</h1>
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
                <input type='button' onClick='javascript:fillAll($("#fillGameDifficulty").val(), $("#fillAchievement").val())' value='Fill All'>
            </p>
			<div id='dummy'><div style='width:1000px;height:20px'></div></div>
			<div id='container'>
	            <table id='survival' class='center'>
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
	                        <select id='HRtPEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HRtPNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HRtPHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='HRtPLunatic' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='SoEWEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SoEWExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PoDDEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoDDNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoDDHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoDDLunatic' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='LLSEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LLSExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='MSEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MSExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='EoSDEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='EoSDExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PCBEasy' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PCBNormal' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PCBHard' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PCBLunatic' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PCBExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PCBPhantasm' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='INEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='INExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='PoFVEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='PoFVExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='MoFEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='MoFExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='SAEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SANormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SAHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SALunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='SAExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='UFOEasy' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='UFONormal' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='UFOHard' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='UFOLunatic' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='UFOExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='GFWEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='GFWExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='TDEasy' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='TDNormal' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='TDHard' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='TDLunatic' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='TDExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='DDCEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='DDCExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='LoLKEasy' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKNormal' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKHard' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKLunatic' onChange='setProgress(this.id, this.value)'>
	                            <option>N/A</option>
	                            <option>Not cleared</option>
	                            <option>1cc</option>
	                            <option>NM</option>
	                            <option>NB</option>
	                            <option>NMNB</option>
	                        </select>
	                    </td>
	                    <td>
	                        <select id='LoLKExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='HSiFSEasy' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='HSiFSNormal' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='HSiFSHard' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='HSiFSLunatic' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='HSiFSExtra' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='WBaWCEasy' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='WBaWCNormal' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='WBaWCHard' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='WBaWCLunatic' onChange='setProgress(this.id, this.value)'>
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
	                        <select id='WBaWCExtra' onChange='setProgress(this.id, this.value)'>
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
            <p><label for='toggleData'>Save Data</label><input id='toggleData' type='checkbox' onClick='allowData()'></p>
			<p><input type='button' onClick='apply()' value='Apply'><input type='button' onClick='reset()' value='Reset'></p>
			<div id='results'></div>
			<h2 id='ack'>Acknowledgements</h2>
			<p id='credit'>The background image
			was drawn by <a href='https://www.pixiv.net/member.php?id=759506'>windtalker</a>.</p>
		</div>
	</body>

</html>
