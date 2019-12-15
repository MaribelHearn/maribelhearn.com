<!DOCTYPE html>
<html lang='en' class='no-js'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

	<head>
		<title>High Score Storage</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Save your Touhou game scores and calculate how they compare to the world records.'>
        <meta name='keywords' content='touhou, touhou project, score, high score, storage, scoring, wr, wrs, world record, world records'>
		<link rel='stylesheet' type='text/css' href='assets/scoring/scoring.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&display=swap'>
		<link rel='icon' type='image/x-icon' href='assets/scoring/scoring.ico'>
        <script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/scoring/scoring.js' defer></script>
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
			<h1>High Score Storage</h1>
			<?php
				if (!empty($_GET['redirect'])) {
					echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
				}
			?>
            <noscript><strong>Notice:</strong> this page cannot function properly with JavaScript disabled.</noscript>
            <p>Enter your high scores. You can leave any high score empty. The scores you entered will be compared to the world records that
            were achieved with the same shottypes and percentages will be given. When you click the 'Calculate' button at the bottom of the
            page, sortable tables will be generated to tell you how your scores compare to the world records.</p>
            <p>Your scores should not include any characters other than digits, dots, commas and spaces.</p>
            <h2>Contents</h2>
            <table id='contents' class='center'>
                <tr><td><a href='#HRtP'>Touhou 1 - The Highly Responsive to Prayers</a></td></tr>
                <tr><td><a href='#SoEW'>Touhou 2 - The Story of Eastern Wonderland</a></td></tr>
                <tr><td><a href='#PoDD'>Touhou 3 - Phantasmagoria of Dim.Dream</a></td></tr>
                <tr><td><a href='#LLS'>Touhou 4 - Lotus Land Story</a></td></tr>
                <tr><td><a href='#MS'>Touhou 5 - Mystic Square</a></td></tr>
                <tr><td><br></td></tr>
                <tr><td><a href='#EoSD'>Touhou 6 - The Embodiment of Scarlet Devil</a></td></tr>
                <tr><td><a href='#PCB'>Touhou 7 - Perfect Cherry Blossom</a></td></tr>
                <tr><td><a href='#IN'>Touhou 8 - Imperishable Night</a></td></tr>
                <tr><td><a href='#PoFV'>Touhou 9 - Phantasmagoria of Flower View</a></td></tr>
                <tr><td><a href='#MoF'>Touhou 10 - Mountain of Faith</a></td></tr>
                <tr><td><a href='#SA'>Touhou 11 - Subterranean Animism</a></td></tr>
                <tr><td><a href='#UFO'>Touhou 12 - Undefined Fantastic Object</a></td></tr>
                <tr><td><a href='#GFW'>Touhou 12.8 - Great Fairy Wars</a></td></tr>
                <tr><td><a href='#TD'>Touhou 13 - Ten Desires</a></td></tr>
                <tr><td><a href='#DDC'>Touhou 14 - Double Dealing Character</a></td></tr>
                <tr><td><a href='#LoLK'>Touhou 15 - Legacy of Lunatic Kingdom</a></td></tr>
                <tr><td><a href='#HSiFS'>Touhou 16 - Hidden Star in Four Seasons</a></td></tr>
                <tr><td><a href='#WBaWC'>Touhou 17 - Wily Beast and Weakest Creature</a></td></tr>
                <tr><td><a href='#ack'>Acknowledgements</a></td></tr>
            </table>
            <h2>Customize</h2>
            <table id='checkboxes' class='center'>
                <tbody>
                    <tr>
                        <td>
                            <input id='HRtPc' type='checkbox' onClick='checkGame("HRtP")' checked>
                            <label for='HRtPc'>HRtP</label>
                        </td><td>
                            <input id='EoSDc' type='checkbox' onClick='checkGame("EoSD")' checked>
                            <label for='EoSDc'>EoSD</label>
                        </td><td>
                            <input id='SAc' type='checkbox' onClick='checkGame("SA")' checked>
                            <label for='SAc'>SA</label>
                        </td><td>
                            <input id='LoLKc' type='checkbox' onClick='checkGame("LoLK")' checked>
                            <label for='LoLKc'>LoLK</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id='SoEWc' type='checkbox' onClick='checkGame("SoEW")' checked>
                            <label for='SoEWc'>SoEW</label>
                        </td><td>
                            <input id='PCBc' type='checkbox' onClick='checkGame("PCB")' checked>
                            <label for='PCBc'>PCB</label>
                        </td><td>
                            <input id='UFOc' type='checkbox' onClick='checkGame("UFO")' checked>
                            <label for='UFOc'>UFO</label>
                        </td><td>
                            <input id='HSiFSc' type='checkbox' onClick='checkGame("HSiFS")' checked>
                            <label for='HSiFSc'>HSiFS</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id='PoDDc' type='checkbox' onClick='checkGame("PoDD")' checked>
                            <label for='PoDDc'>PoDD</label>
                        </td><td>
                            <input id='INc' type='checkbox' onClick='checkGame("IN")' checked>
                            <label for='INc'>IN</label>
                        </td><td>
                            <input id='GFWc' type='checkbox' onClick='checkGame("GFW")' checked>
                            <label for='GFWc'>GFW</label>
                        </td><td class='noborders'>
                            <input id='WBaWCc' type='checkbox' onClick='checkGame("WBaWC")' checked>
                            <label for='WBaWCc'>WBaWC</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id='LLSc' type='checkbox' onClick='checkGame("LLS")' checked>
                            <label for='LLSc'>LLS</label>
                        </td><td>
                            <input id='PoFVc' type='checkbox' onClick='checkGame("PoFV")' checked>
                            <label for='PoFVc'>PoFV</label>
                        </td><td>
                            <input id='TDc' type='checkbox' onClick='checkGame("TD")' checked>
                            <label for='TDc'>TD</label>
                        </td><td class='noborders'></td>
                    </tr>
                    <tr>
                        <td>
                            <input id='MSc' type='checkbox' onClick='checkGame("MS")' checked>
                            <label for='MSc'>MS</label>
                        </td><td>
                            <input id='MoFc' type='checkbox' onClick='checkGame("MoF")' checked>
                            <label for='MoFc'>MoF</label>
                        </td><td>
                            <input id='DDCc' type='checkbox' onClick='checkGame("DDC")' checked>
                            <label for='DDCc'>DDC</label>
                        </td><td class='noborders'></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <input id='tracked' type='checkbox' onClick='checkTracked()' checked>
                            <label for='tracked'>Tracked</label>
                        </td><td>
                            <input id='untracked' type='checkbox' onClick='checkUntracked()' checked>
                            <label for='untracked'>Untracked</label>
                        </td><td>
                            <input id='all' type='checkbox' onClick='checkAll()' checked>
                            <label for='all'>All</label>
                        </td><td class='noborders'></td>
                    </tr>
                </tfoot>
            </table>
            <div id='HRtP'>
                <p><img src='games/hrtp50x50.jpg' class='cover98' alt='HRtP cover'> <u>Touhou 1 - The Highly Responsive to Prayers</u></p>
                <table class='center'>
                    <tr>
                        <th>Route</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                    </tr><tr>
                        <td>Makai</td>
                        <td><input type='text' id='HRtPEasyMakai'></td>
                        <td><input type='text' id='HRtPNormalMakai'></td>
                        <td><input type='text' id='HRtPHardMakai'></td>
                        <td><input type='text' id='HRtPLunaticMakai'></td>
                    </tr><tr>
                        <td>Jigoku</td>
                        <td><input type='text' id='HRtPEasyJigoku'></td>
                        <td><input type='text' id='HRtPNormalJigoku'></td>
                        <td><input type='text' id='HRtPHardJigoku'></td>
                        <td><input type='text' id='HRtPLunaticJigoku'></td>
                    </tr>
                </table>
            </div>
            <div id='SoEW'>
                <p><img src='games/soew50x50.jpg' class='cover98' alt='SoEW cover'> <u>Touhou 2 - The Story of Eastern Wonderland</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='SoEWEasyReimuA'></td>
                        <td><input type='text' id='SoEWNormalReimuA'></td>
                        <td><input type='text' id='SoEWHardReimuA'></td>
                        <td><input type='text' id='SoEWLunaticReimuA'></td>
                        <td><input type='text' id='SoEWExtraReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='SoEWEasyReimuB'></td>
                        <td><input type='text' id='SoEWNormalReimuB'></td>
                        <td><input type='text' id='SoEWHardReimuB'></td>
                        <td><input type='text' id='SoEWLunaticReimuB'></td>
                        <td><input type='text' id='SoEWExtraReimuB'></td>
                    </tr><tr>
                        <td>ReimuC</td>
                        <td><input type='text' id='SoEWEasyReimuC'></td>
                        <td><input type='text' id='SoEWNormalReimuC'></td>
                        <td><input type='text' id='SoEWHardReimuC'></td>
                        <td><input type='text' id='SoEWLunaticReimuC'></td>
                        <td><input type='text' id='SoEWExtraReimuC'></td>
                    </tr>
                </table>
            </div>
            <div id='PoDD'>
                <p><img src='games/podd50x50.jpg' class='cover98' alt='PoDD cover'> <u>Touhou 3 - Phantasmagoria of Dim.Dream</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                    </tr><tr>
                        <td>Reimu</td>
                        <td><input type='text' id='PoDDEasyReimu'></td>
                        <td><input type='text' id='PoDDNormalReimu'></td>
                        <td><input type='text' id='PoDDHardReimu'></td>
                        <td><input type='text' id='PoDDLunaticReimu'></td>
                    </tr><tr>
                        <td>Mima</td>
                        <td><input type='text' id='PoDDEasyMima'></td>
                        <td><input type='text' id='PoDDNormalMima'></td>
                        <td><input type='text' id='PoDDHardMima'></td>
                        <td><input type='text' id='PoDDLunaticMima'></td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td><input type='text' id='PoDDEasyMarisa'></td>
                        <td><input type='text' id='PoDDNormalMarisa'></td>
                        <td><input type='text' id='PoDDHardMarisa'></td>
                        <td><input type='text' id='PoDDLunaticMarisa'></td>
                    </tr><tr>
                        <td>Ellen</td>
                        <td><input type='text' id='PoDDEasyEllen'></td>
                        <td><input type='text' id='PoDDNormalEllen'></td>
                        <td><input type='text' id='PoDDHardEllen'></td>
                        <td><input type='text' id='PoDDLunaticEllen'></td>
                    </tr><tr>
                        <td>Kotohime</td>
                        <td><input type='text' id='PoDDEasyKotohime'></td>
                        <td><input type='text' id='PoDDNormalKotohime'></td>
                        <td><input type='text' id='PoDDHardKotohime'></td>
                        <td><input type='text' id='PoDDLunaticKotohime'></td>
                    </tr><tr>
                        <td>Kana</td>
                        <td><input type='text' id='PoDDEasyKana'></td>
                        <td><input type='text' id='PoDDNormalKana'></td>
                        <td><input type='text' id='PoDDHardKana'></td>
                        <td><input type='text' id='PoDDLunaticKana'></td>
                    </tr><tr>
                        <td>Rikako</td>
                        <td><input type='text' id='PoDDEasyRikako'></td>
                        <td><input type='text' id='PoDDNormalRikako'></td>
                        <td><input type='text' id='PoDDHardRikako'></td>
                        <td><input type='text' id='PoDDLunaticRikako'></td>
                    </tr><tr>
                        <td>Chiyuri</td>
                        <td><input type='text' id='PoDDEasyChiyuri'></td>
                        <td><input type='text' id='PoDDNormalChiyuri'></td>
                        <td><input type='text' id='PoDDHardChiyuri'></td>
                        <td><input type='text' id='PoDDLunaticChiyuri'></td>
                    </tr><tr>
                        <td>Yumemi</td>
                        <td><input type='text' id='PoDDEasyYumemi'></td>
                        <td><input type='text' id='PoDDNormalYumemi'></td>
                        <td><input type='text' id='PoDDHardYumemi'></td>
                        <td><input type='text' id='PoDDLunaticYumemi'></td>
                    </tr>
                </table>
            </div>
            <div id='LLS'>
                <p><img src='games/lls50x50.jpg' class='cover98' alt='LLS cover'> <u>Touhou 4 - Lotus Land Story</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='LLSEasyReimuA'></td>
                        <td><input type='text' id='LLSNormalReimuA'></td>
                        <td><input type='text' id='LLSHardReimuA'></td>
                        <td><input type='text' id='LLSLunaticReimuA'></td>
                        <td><input type='text' id='LLSExtraReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='LLSEasyReimuB'></td>
                        <td><input type='text' id='LLSNormalReimuB'></td>
                        <td><input type='text' id='LLSHardReimuB'></td>
                        <td><input type='text' id='LLSLunaticReimuB'></td>
                        <td><input type='text' id='LLSExtraReimuB'></td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td><input type='text' id='LLSEasyMarisaA'></td>
                        <td><input type='text' id='LLSNormalMarisaA'></td>
                        <td><input type='text' id='LLSHardMarisaA'></td>
                        <td><input type='text' id='LLSLunaticMarisaA'></td>
                        <td><input type='text' id='LLSExtraMarisaA'></td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td><input type='text' id='LLSEasyMarisaB'></td>
                        <td><input type='text' id='LLSNormalMarisaB'></td>
                        <td><input type='text' id='LLSHardMarisaB'></td>
                        <td><input type='text' id='LLSLunaticMarisaB'></td>
                        <td><input type='text' id='LLSExtraMarisaB'></td>
                    </tr>
                </table>
            </div>
            <div id='MS'>
                <p><img src='games/ms50x50.jpg' class='cover98' alt='MS cover'> <u>Touhou 5 - Mystic Square</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>Reimu</td>
                        <td><input type='text' id='MSEasyReimu'></td>
                        <td><input type='text' id='MSNormalReimu'></td>
                        <td><input type='text' id='MSHardReimu'></td>
                        <td><input type='text' id='MSLunaticReimu'></td>
                        <td><input type='text' id='MSExtraReimu'></td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td><input type='text' id='MSEasyMarisa'></td>
                        <td><input type='text' id='MSNormalMarisa'></td>
                        <td><input type='text' id='MSHardMarisa'></td>
                        <td><input type='text' id='MSLunaticMarisa'></td>
                        <td><input type='text' id='MSExtraMarisa'></td>
                    </tr><tr>
                        <td>Mima</td>
                        <td><input type='text' id='MSEasyMima'></td>
                        <td><input type='text' id='MSNormalMima'></td>
                        <td><input type='text' id='MSHardMima'></td>
                        <td><input type='text' id='MSLunaticMima'></td>
                        <td><input type='text' id='MSExtraMima'></td>
                    </tr><tr>
                        <td>Yuuka</td>
                        <td><input type='text' id='MSEasyYuuka'></td>
                        <td><input type='text' id='MSNormalYuuka'></td>
                        <td><input type='text' id='MSHardYuuka'></td>
                        <td><input type='text' id='MSLunaticYuuka'></td>
                        <td><input type='text' id='MSExtraYuuka'></td>
                    </tr>
                </table>
            </div>
            <div id='EoSD'>
                <p><img src='games/eosd50x50.jpg' alt='EoSD cover'> <u>Touhou 6 - The Embodiment of Scarlet Devil</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='EoSDEasyReimuA'></td>
                        <td><input type='text' id='EoSDNormalReimuA'></td>
                        <td><input type='text' id='EoSDHardReimuA'></td>
                        <td><input type='text' id='EoSDLunaticReimuA'></td>
                        <td><input type='text' id='EoSDExtraReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='EoSDEasyReimuB'></td>
                        <td><input type='text' id='EoSDNormalReimuB'></td>
                        <td><input type='text' id='EoSDHardReimuB'></td>
                        <td><input type='text' id='EoSDLunaticReimuB'></td>
                        <td><input type='text' id='EoSDExtraReimuB'></td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td><input type='text' id='EoSDEasyMarisaA'></td>
                        <td><input type='text' id='EoSDNormalMarisaA'></td>
                        <td><input type='text' id='EoSDHardMarisaA'></td>
                        <td><input type='text' id='EoSDLunaticMarisaA'></td>
                        <td><input type='text' id='EoSDExtraMarisaA'></td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td><input type='text' id='EoSDEasyMarisaB'></td>
                        <td><input type='text' id='EoSDNormalMarisaB'></td>
                        <td><input type='text' id='EoSDHardMarisaB'></td>
                        <td><input type='text' id='EoSDLunaticMarisaB'></td>
                        <td><input type='text' id='EoSDExtraMarisaB'></td>
                    </tr>
                </table>
            </div>
            <div id='PCB'>
                <p><img src='games/pcb50x50.jpg' alt='PCB cover'> <u>Touhou 7 - Perfect Cherry Blossom</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                        <th>Phantasm</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='PCBEasyReimuA'></td>
                        <td><input type='text' id='PCBNormalReimuA'></td>
                        <td><input type='text' id='PCBHardReimuA'></td>
                        <td><input type='text' id='PCBLunaticReimuA'></td>
                        <td><input type='text' id='PCBExtraReimuA'></td>
                        <td><input type='text' id='PCBPhantasmReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='PCBEasyReimuB'></td>
                        <td><input type='text' id='PCBNormalReimuB'></td>
                        <td><input type='text' id='PCBHardReimuB'></td>
                        <td><input type='text' id='PCBLunaticReimuB'></td>
                        <td><input type='text' id='PCBExtraReimuB'></td>
                        <td><input type='text' id='PCBPhantasmReimuB'></td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td><input type='text' id='PCBEasyMarisaA'></td>
                        <td><input type='text' id='PCBNormalMarisaA'></td>
                        <td><input type='text' id='PCBHardMarisaA'></td>
                        <td><input type='text' id='PCBLunaticMarisaA'></td>
                        <td><input type='text' id='PCBExtraMarisaA'></td>
                        <td><input type='text' id='PCBPhantasmMarisaA'></td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td><input type='text' id='PCBEasyMarisaB'></td>
                        <td><input type='text' id='PCBNormalMarisaB'></td>
                        <td><input type='text' id='PCBHardMarisaB'></td>
                        <td><input type='text' id='PCBLunaticMarisaB'></td>
                        <td><input type='text' id='PCBExtraMarisaB'></td>
                        <td><input type='text' id='PCBPhantasmMarisaB'></td>
                    </tr><tr>
                        <td>SakuyaA</td>
                        <td><input type='text' id='PCBEasySakuyaA'></td>
                        <td><input type='text' id='PCBNormalSakuyaA'></td>
                        <td><input type='text' id='PCBHardSakuyaA'></td>
                        <td><input type='text' id='PCBLunaticSakuyaA'></td>
                        <td><input type='text' id='PCBExtraSakuyaA'></td>
                        <td><input type='text' id='PCBPhantasmSakuyaA'></td>
                    </tr><tr>
                        <td>SakuyaB</td>
                        <td><input type='text' id='PCBEasySakuyaB'></td>
                        <td><input type='text' id='PCBNormalSakuyaB'></td>
                        <td><input type='text' id='PCBHardSakuyaB'></td>
                        <td><input type='text' id='PCBLunaticSakuyaB'></td>
                        <td><input type='text' id='PCBExtraSakuyaB'></td>
                        <td><input type='text' id='PCBPhantasmSakuyaB'></td>
                    </tr>
                </table>
            </div>
            <div id='IN'>
                <p><img src='games/in50x50.jpg' alt='IN cover'> <u>Touhou 8 - Imperishable Night</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>Border Team</td>
                        <td><input type='text' id='INEasyBorderTeam'></td>
                        <td><input type='text' id='INNormalBorderTeam'></td>
                        <td><input type='text' id='INHardBorderTeam'></td>
                        <td><input type='text' id='INLunaticBorderTeam'></td>
                        <td><input type='text' id='INExtraBorderTeam'></td>
                    </tr><tr>
                        <td>Magic Team</td>
                        <td><input type='text' id='INEasyMagicTeam'></td>
                        <td><input type='text' id='INNormalMagicTeam'></td>
                        <td><input type='text' id='INHardMagicTeam'></td>
                        <td><input type='text' id='INLunaticMagicTeam'></td>
                        <td><input type='text' id='INExtraMagicTeam'></td>
                    </tr><tr>
                        <td>Scarlet Team</td>
                        <td><input type='text' id='INEasyScarletTeam'></td>
                        <td><input type='text' id='INNormalScarletTeam'></td>
                        <td><input type='text' id='INHardScarletTeam'></td>
                        <td><input type='text' id='INLunaticScarletTeam'></td>
                        <td><input type='text' id='INExtraScarletTeam'></td>
                    </tr><tr>
                        <td>Ghost Team</td>
                        <td><input type='text' id='INEasyGhostTeam'></td>
                        <td><input type='text' id='INNormalGhostTeam'></td>
                        <td><input type='text' id='INHardGhostTeam'></td>
                        <td><input type='text' id='INLunaticGhostTeam'></td>
                        <td><input type='text' id='INExtraGhostTeam'></td>
                    </tr><tr>
                        <td>Reimu</td>
                        <td><input type='text' id='INEasyReimu'></td>
                        <td><input type='text' id='INNormalReimu'></td>
                        <td><input type='text' id='INHardReimu'></td>
                        <td><input type='text' id='INLunaticReimu'></td>
                        <td><input type='text' id='INExtraReimu'></td>
                    </tr><tr>
                        <td>Yukari</td>
                        <td><input type='text' id='INEasyYukari'></td>
                        <td><input type='text' id='INNormalYukari'></td>
                        <td><input type='text' id='INHardYukari'></td>
                        <td><input type='text' id='INLunaticYukari'></td>
                        <td><input type='text' id='INExtraYukari'></td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td><input type='text' id='INEasyMarisa'></td>
                        <td><input type='text' id='INNormalMarisa'></td>
                        <td><input type='text' id='INHardMarisa'></td>
                        <td><input type='text' id='INLunaticMarisa'></td>
                        <td><input type='text' id='INExtraMarisa'></td>
                    </tr><tr>
                        <td>Alice</td>
                        <td><input type='text' id='INEasyAlice'></td>
                        <td><input type='text' id='INNormalAlice'></td>
                        <td><input type='text' id='INHardAlice'></td>
                        <td><input type='text' id='INLunaticAlice'></td>
                        <td><input type='text' id='INExtraAlice'></td>
                    </tr><tr>
                        <td>Sakuya</td>
                        <td><input type='text' id='INEasySakuya'></td>
                        <td><input type='text' id='INNormalSakuya'></td>
                        <td><input type='text' id='INHardSakuya'></td>
                        <td><input type='text' id='INLunaticSakuya'></td>
                        <td><input type='text' id='INExtraSakuya'></td>
                    </tr><tr>
                        <td>Remilia</td>
                        <td><input type='text' id='INEasyRemilia'></td>
                        <td><input type='text' id='INNormalRemilia'></td>
                        <td><input type='text' id='INHardRemilia'></td>
                        <td><input type='text' id='INLunaticRemilia'></td>
                        <td><input type='text' id='INExtraRemilia'></td>
                    </tr><tr>
                        <td>Youmu</td>
                        <td><input type='text' id='INEasyYoumu'></td>
                        <td><input type='text' id='INNormalYoumu'></td>
                        <td><input type='text' id='INHardYoumu'></td>
                        <td><input type='text' id='INLunaticYoumu'></td>
                        <td><input type='text' id='INExtraYoumu'></td>
                    </tr><tr>
                        <td>Yuyuko</td>
                        <td><input type='text' id='INEasyYuyuko'></td>
                        <td><input type='text' id='INNormalYuyuko'></td>
                        <td><input type='text' id='INHardYuyuko'></td>
                        <td><input type='text' id='INLunaticYuyuko'></td>
                        <td><input type='text' id='INExtraYuyuko'></td>
                    </tr>
                </table>
            </div>
            <div id='PoFV'>
                <p><img src='games/pofv50x50.jpg' alt='PoFV cover'> <u>Touhou 9 - Phantasmagoria of Flower View</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>Reimu</td>
                        <td><input type='text' id='PoFVEasyReimu'></td>
                        <td><input type='text' id='PoFVNormalReimu'></td>
                        <td><input type='text' id='PoFVHardReimu'></td>
                        <td><input type='text' id='PoFVLunaticReimu'></td>
                        <td><input type='text' id='PoFVExtraReimu'></td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td><input type='text' id='PoFVEasyMarisa'></td>
                        <td><input type='text' id='PoFVNormalMarisa'></td>
                        <td><input type='text' id='PoFVHardMarisa'></td>
                        <td><input type='text' id='PoFVLunaticMarisa'></td>
                        <td><input type='text' id='PoFVExtraMarisa'></td>
                    </tr><tr>
                        <td>Sakuya</td>
                        <td><input type='text' id='PoFVEasySakuya'></td>
                        <td><input type='text' id='PoFVNormalSakuya'></td>
                        <td><input type='text' id='PoFVHardSakuya'></td>
                        <td><input type='text' id='PoFVLunaticSakuya'></td>
                        <td><input type='text' id='PoFVExtraSakuya'></td>
                    </tr><tr>
                        <td>Youmu</td>
                        <td><input type='text' id='PoFVEasyYoumu'></td>
                        <td><input type='text' id='PoFVNormalYoumu'></td>
                        <td><input type='text' id='PoFVHardYoumu'></td>
                        <td><input type='text' id='PoFVLunaticYoumu'></td>
                        <td><input type='text' id='PoFVExtraYoumu'></td>
                    </tr><tr>
                        <td>Reisen</td>
                        <td><input type='text' id='PoFVEasyReisen'></td>
                        <td><input type='text' id='PoFVNormalReisen'></td>
                        <td><input type='text' id='PoFVHardReisen'></td>
                        <td><input type='text' id='PoFVLunaticReisen'></td>
                        <td><input type='text' id='PoFVExtraReisen'></td>
                    </tr><tr>
                        <td>Cirno</td>
                        <td><input type='text' id='PoFVEasyCirno'></td>
                        <td><input type='text' id='PoFVNormalCirno'></td>
                        <td><input type='text' id='PoFVHardCirno'></td>
                        <td><input type='text' id='PoFVLunaticCirno'></td>
                        <td><input type='text' id='PoFVExtraCirno'></td>
                    </tr><tr>
                        <td>Lyrica</td>
                        <td><input type='text' id='PoFVEasyLyrica'></td>
                        <td><input type='text' id='PoFVNormalLyrica'></td>
                        <td><input type='text' id='PoFVHardLyrica'></td>
                        <td><input type='text' id='PoFVLunaticLyrica'></td>
                        <td><input type='text' id='PoFVExtraLyrica'></td>
                    </tr><tr>
                        <td>Mystia</td>
                        <td><input type='text' id='PoFVEasyMystia'></td>
                        <td><input type='text' id='PoFVNormalMystia'></td>
                        <td><input type='text' id='PoFVHardMystia'></td>
                        <td><input type='text' id='PoFVLunaticMystia'></td>
                        <td><input type='text' id='PoFVExtraMystia'></td>
                    </tr><tr>
                        <td>Tewi</td>
                        <td><input type='text' id='PoFVEasyTewi'></td>
                        <td><input type='text' id='PoFVNormalTewi'></td>
                        <td><input type='text' id='PoFVHardTewi'></td>
                        <td><input type='text' id='PoFVLunaticTewi'></td>
                        <td><input type='text' id='PoFVExtraTewi'></td>
                    </tr><tr>
                        <td>Aya</td>
                        <td><input type='text' id='PoFVEasyAya'></td>
                        <td><input type='text' id='PoFVNormalAya'></td>
                        <td><input type='text' id='PoFVHardAya'></td>
                        <td><input type='text' id='PoFVLunaticAya'></td>
                        <td><input type='text' id='PoFVExtraAya'></td>
                    </tr><tr>
                        <td>Medicine</td>
                        <td><input type='text' id='PoFVEasyMedicine'></td>
                        <td><input type='text' id='PoFVNormalMedicine'></td>
                        <td><input type='text' id='PoFVHardMedicine'></td>
                        <td><input type='text' id='PoFVLunaticMedicine'></td>
                        <td><input type='text' id='PoFVExtraMedicine'></td>
                    </tr><tr>
                        <td>Yuuka</td>
                        <td><input type='text' id='PoFVEasyYuuka'></td>
                        <td><input type='text' id='PoFVNormalYuuka'></td>
                        <td><input type='text' id='PoFVHardYuuka'></td>
                        <td><input type='text' id='PoFVLunaticYuuka'></td>
                        <td><input type='text' id='PoFVExtraYuuka'></td>
                    </tr><tr>
                        <td>Komachi</td>
                        <td><input type='text' id='PoFVEasyKomachi'></td>
                        <td><input type='text' id='PoFVNormalKomachi'></td>
                        <td><input type='text' id='PoFVHardKomachi'></td>
                        <td><input type='text' id='PoFVLunaticKomachi'></td>
                        <td><input type='text' id='PoFVExtraKomachi'></td>
                    </tr><tr>
                        <td>Eiki</td>
                        <td><input type='text' id='PoFVEasyEiki'></td>
                        <td><input type='text' id='PoFVNormalEiki'></td>
                        <td><input type='text' id='PoFVHardEiki'></td>
                        <td><input type='text' id='PoFVLunaticEiki'></td>
                        <td><input type='text' id='PoFVExtraEiki'></td>
                    </tr>
                </table>
            </div>
            <div id='MoF'>
                <p><img src='games/mof50x50.jpg' alt='MoF cover'> <u>Touhou 10 - Mountain of Faith</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='MoFEasyReimuA'></td>
                        <td><input type='text' id='MoFNormalReimuA'></td>
                        <td><input type='text' id='MoFHardReimuA'></td>
                        <td><input type='text' id='MoFLunaticReimuA'></td>
                        <td><input type='text' id='MoFExtraReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='MoFEasyReimuB'></td>
                        <td><input type='text' id='MoFNormalReimuB'></td>
                        <td><input type='text' id='MoFHardReimuB'></td>
                        <td><input type='text' id='MoFLunaticReimuB'></td>
                        <td><input type='text' id='MoFExtraReimuB'></td>
                    </tr><tr>
                        <td>ReimuC</td>
                        <td><input type='text' id='MoFEasyReimuC'></td>
                        <td><input type='text' id='MoFNormalReimuC'></td>
                        <td><input type='text' id='MoFHardReimuC'></td>
                        <td><input type='text' id='MoFLunaticReimuC'></td>
                        <td><input type='text' id='MoFExtraReimuC'></td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td><input type='text' id='MoFEasyMarisaA'></td>
                        <td><input type='text' id='MoFNormalMarisaA'></td>
                        <td><input type='text' id='MoFHardMarisaA'></td>
                        <td><input type='text' id='MoFLunaticMarisaA'></td>
                        <td><input type='text' id='MoFExtraMarisaA'></td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td><input type='text' id='MoFEasyMarisaB'></td>
                        <td><input type='text' id='MoFNormalMarisaB'></td>
                        <td><input type='text' id='MoFHardMarisaB'></td>
                        <td><input type='text' id='MoFLunaticMarisaB'></td>
                        <td><input type='text' id='MoFExtraMarisaB'></td>
                    </tr><tr>
                        <td>MarisaC</td>
                        <td><input type='text' id='MoFEasyMarisaC'></td>
                        <td><input type='text' id='MoFNormalMarisaC'></td>
                        <td><input type='text' id='MoFHardMarisaC'></td>
                        <td><input type='text' id='MoFLunaticMarisaC'></td>
                        <td><input type='text' id='MoFExtraMarisaC'></td>
                    </tr>
                </table>
            </div>
            <div id='SA'>
                <p><img src='games/sa50x50.jpg' alt='SA cover'> <u>Touhou 11 - Subterranean Animism</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='SAEasyReimuA'></td>
                        <td><input type='text' id='SANormalReimuA'></td>
                        <td><input type='text' id='SAHardReimuA'></td>
                        <td><input type='text' id='SALunaticReimuA'></td>
                        <td><input type='text' id='SAExtraReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='SAEasyReimuB'></td>
                        <td><input type='text' id='SANormalReimuB'></td>
                        <td><input type='text' id='SAHardReimuB'></td>
                        <td><input type='text' id='SALunaticReimuB'></td>
                        <td><input type='text' id='SAExtraReimuB'></td>
                    </tr><tr>
                        <td>ReimuC</td>
                        <td><input type='text' id='SAEasyReimuC'></td>
                        <td><input type='text' id='SANormalReimuC'></td>
                        <td><input type='text' id='SAHardReimuC'></td>
                        <td><input type='text' id='SALunaticReimuC'></td>
                        <td><input type='text' id='SAExtraReimuC'></td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td><input type='text' id='SAEasyMarisaA'></td>
                        <td><input type='text' id='SANormalMarisaA'></td>
                        <td><input type='text' id='SAHardMarisaA'></td>
                        <td><input type='text' id='SALunaticMarisaA'></td>
                        <td><input type='text' id='SAExtraMarisaA'></td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td><input type='text' id='SAEasyMarisaB'></td>
                        <td><input type='text' id='SANormalMarisaB'></td>
                        <td><input type='text' id='SAHardMarisaB'></td>
                        <td><input type='text' id='SALunaticMarisaB'></td>
                        <td><input type='text' id='SAExtraMarisaB'></td>
                    </tr><tr>
                        <td>MarisaC</td>
                        <td><input type='text' id='SAEasyMarisaC'></td>
                        <td><input type='text' id='SANormalMarisaC'></td>
                        <td><input type='text' id='SAHardMarisaC'></td>
                        <td><input type='text' id='SALunaticMarisaC'></td>
                        <td><input type='text' id='SAExtraMarisaC'></td>
                    </tr>
                </table>
            </div>
            <div id='UFO'>
                <p><img src='games/ufo50x50.jpg' alt='UFO cover'> <u>Touhou 12 - Undefined Fantastic Object</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='UFOEasyReimuA'></td>
                        <td><input type='text' id='UFONormalReimuA'></td>
                        <td><input type='text' id='UFOHardReimuA'></td>
                        <td><input type='text' id='UFOLunaticReimuA'></td>
                        <td><input type='text' id='UFOExtraReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='UFOEasyReimuB'></td>
                        <td><input type='text' id='UFONormalReimuB'></td>
                        <td><input type='text' id='UFOHardReimuB'></td>
                        <td><input type='text' id='UFOLunaticReimuB'></td>
                        <td><input type='text' id='UFOExtraReimuB'></td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td><input type='text' id='UFOEasyMarisaA'></td>
                        <td><input type='text' id='UFONormalMarisaA'></td>
                        <td><input type='text' id='UFOHardMarisaA'></td>
                        <td><input type='text' id='UFOLunaticMarisaA'></td>
                        <td><input type='text' id='UFOExtraMarisaA'></td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td><input type='text' id='UFOEasyMarisaB'></td>
                        <td><input type='text' id='UFONormalMarisaB'></td>
                        <td><input type='text' id='UFOHardMarisaB'></td>
                        <td><input type='text' id='UFOLunaticMarisaB'></td>
                        <td><input type='text' id='UFOExtraMarisaB'></td>
                    </tr><tr>
                        <td>SanaeA</td>
                        <td><input type='text' id='UFOEasySanaeA'></td>
                        <td><input type='text' id='UFONormalSanaeA'></td>
                        <td><input type='text' id='UFOHardSanaeA'></td>
                        <td><input type='text' id='UFOLunaticSanaeA'></td>
                        <td><input type='text' id='UFOExtraSanaeA'></td>
                    </tr><tr>
                        <td>SanaeB</td>
                        <td><input type='text' id='UFOEasySanaeB'></td>
                        <td><input type='text' id='UFONormalSanaeB'></td>
                        <td><input type='text' id='UFOHardSanaeB'></td>
                        <td><input type='text' id='UFOLunaticSanaeB'></td>
                        <td><input type='text' id='UFOExtraSanaeB'></td>
                    </tr>
                </table>
            </div>
            <div id='GFW'>
                <p><img src='games/gfw50x50.jpg' alt='GFW cover'> <u>Touhou 12.8 - Great Fairy Wars</u></p>
                <table class='center'>
                    <tr>
                        <th>Route</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                    </tr><tr>
                        <td>A1</td>
                        <td><input type='text' id='GFWEasyA1'></td>
                        <td><input type='text' id='GFWNormalA1'></td>
                        <td><input type='text' id='GFWHardA1'></td>
                        <td><input type='text' id='GFWLunaticA1'></td>
                    </tr><tr>
                        <td>A2</td>
                        <td><input type='text' id='GFWEasyA2'></td>
                        <td><input type='text' id='GFWNormalA2'></td>
                        <td><input type='text' id='GFWHardA2'></td>
                        <td><input type='text' id='GFWLunaticA2'></td>
                    </tr><tr>
                        <td>B1</td>
                        <td><input type='text' id='GFWEasyB1'></td>
                        <td><input type='text' id='GFWNormalB1'></td>
                        <td><input type='text' id='GFWHardB1'></td>
                        <td><input type='text' id='GFWLunaticB1'></td>
                    </tr><tr>
                        <td>B2</td>
                        <td><input type='text' id='GFWEasyB2'></td>
                        <td><input type='text' id='GFWNormalB2'></td>
                        <td><input type='text' id='GFWHardB2'></td>
                        <td><input type='text' id='GFWLunaticB2'></td>
                    </tr><tr>
                        <td>C1</td>
                        <td><input type='text' id='GFWEasyC1'></td>
                        <td><input type='text' id='GFWNormalC1'></td>
                        <td><input type='text' id='GFWHardC1'></td>
                        <td><input type='text' id='GFWLunaticC1'></td>
                    </tr><tr>
                        <td>C2</td>
                        <td><input type='text' id='GFWEasyC2'></td>
                        <td><input type='text' id='GFWNormalC2'></td>
                        <td><input type='text' id='GFWHardC2'></td>
                        <td><input type='text' id='GFWLunaticC2'></td>
                    </tr><tr>
                        <td>Extra</td>
                        <td colspan='4' style='text-align:left'><input type='text' id='GFWExtra-'></td>
                    </tr>
                </table>
            </div>
            <div id='TD'>
                <p><img src='games/td50x50.jpg' alt='TD cover'> <u>Touhou 13 - Ten Desires</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>Reimu</td>
                        <td><input type='text' id='TDEasyReimu'></td>
                        <td><input type='text' id='TDNormalReimu'></td>
                        <td><input type='text' id='TDHardReimu'></td>
                        <td><input type='text' id='TDLunaticReimu'></td>
                        <td><input type='text' id='TDExtraReimu'></td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td><input type='text' id='TDEasyMarisa'></td>
                        <td><input type='text' id='TDNormalMarisa'></td>
                        <td><input type='text' id='TDHardMarisa'></td>
                        <td><input type='text' id='TDLunaticMarisa'></td>
                        <td><input type='text' id='TDExtraMarisa'></td>
                    </tr><tr>
                        <td>Sanae</td>
                        <td><input type='text' id='TDEasySanae'></td>
                        <td><input type='text' id='TDNormalSanae'></td>
                        <td><input type='text' id='TDHardSanae'></td>
                        <td><input type='text' id='TDLunaticSanae'></td>
                        <td><input type='text' id='TDExtraSanae'></td>
                    </tr><tr>
                        <td>Youmu</td>
                        <td><input type='text' id='TDEasyYoumu'></td>
                        <td><input type='text' id='TDNormalYoumu'></td>
                        <td><input type='text' id='TDHardYoumu'></td>
                        <td><input type='text' id='TDLunaticYoumu'></td>
                        <td><input type='text' id='TDExtraYoumu'></td>
                    </tr>
                </table>
            </div>
            <div id='DDC'>
                <p><img src='games/ddc50x50.jpg' alt='DDC cover'> <u>Touhou 14 - Double Dealing Character</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuA</td>
                        <td><input type='text' id='DDCEasyReimuA'></td>
                        <td><input type='text' id='DDCNormalReimuA'></td>
                        <td><input type='text' id='DDCHardReimuA'></td>
                        <td><input type='text' id='DDCLunaticReimuA'></td>
                        <td><input type='text' id='DDCExtraReimuA'></td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td><input type='text' id='DDCEasyReimuB'></td>
                        <td><input type='text' id='DDCNormalReimuB'></td>
                        <td><input type='text' id='DDCHardReimuB'></td>
                        <td><input type='text' id='DDCLunaticReimuB'></td>
                        <td><input type='text' id='DDCExtraReimuB'></td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td><input type='text' id='DDCEasyMarisaA'></td>
                        <td><input type='text' id='DDCNormalMarisaA'></td>
                        <td><input type='text' id='DDCHardMarisaA'></td>
                        <td><input type='text' id='DDCLunaticMarisaA'></td>
                        <td><input type='text' id='DDCExtraMarisaA'></td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td><input type='text' id='DDCEasyMarisaB'></td>
                        <td><input type='text' id='DDCNormalMarisaB'></td>
                        <td><input type='text' id='DDCHardMarisaB'></td>
                        <td><input type='text' id='DDCLunaticMarisaB'></td>
                        <td><input type='text' id='DDCExtraMarisaB'></td>
                    </tr><tr>
                        <td>SakuyaA</td>
                        <td><input type='text' id='DDCEasySakuyaA'></td>
                        <td><input type='text' id='DDCNormalSakuyaA'></td>
                        <td><input type='text' id='DDCHardSakuyaA'></td>
                        <td><input type='text' id='DDCLunaticSakuyaA'></td>
                        <td><input type='text' id='DDCExtraSakuyaA'></td>
                    </tr><tr>
                        <td>SakuyaB</td>
                        <td><input type='text' id='DDCEasySakuyaB'></td>
                        <td><input type='text' id='DDCNormalSakuyaB'></td>
                        <td><input type='text' id='DDCHardSakuyaB'></td>
                        <td><input type='text' id='DDCLunaticSakuyaB'></td>
                        <td><input type='text' id='DDCExtraSakuyaB'></td>
                    </tr>
                </table>
            </div>
            <div id='LoLK'>
                <p><img src='games/lolk50x50.jpg' alt='LoLK cover'> <u>Touhou 15 - Legacy of Lunatic Kingdom</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>Reimu</td>
                        <td><input type='text' id='LoLKEasyReimu'></td>
                        <td><input type='text' id='LoLKNormalReimu'></td>
                        <td><input type='text' id='LoLKHardReimu'></td>
                        <td><input type='text' id='LoLKLunaticReimu'></td>
                        <td><input type='text' id='LoLKExtraReimu'></td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td><input type='text' id='LoLKEasyMarisa'></td>
                        <td><input type='text' id='LoLKNormalMarisa'></td>
                        <td><input type='text' id='LoLKHardMarisa'></td>
                        <td><input type='text' id='LoLKLunaticMarisa'></td>
                        <td><input type='text' id='LoLKExtraMarisa'></td>
                    </tr><tr>
                        <td>Sanae</td>
                        <td><input type='text' id='LoLKEasySanae'></td>
                        <td><input type='text' id='LoLKNormalSanae'></td>
                        <td><input type='text' id='LoLKHardSanae'></td>
                        <td><input type='text' id='LoLKLunaticSanae'></td>
                        <td><input type='text' id='LoLKExtraSanae'></td>
                    </tr><tr>
                        <td>Reisen</td>
                        <td><input type='text' id='LoLKEasyReisen'></td>
                        <td><input type='text' id='LoLKNormalReisen'></td>
                        <td><input type='text' id='LoLKHardReisen'></td>
                        <td><input type='text' id='LoLKLunaticReisen'></td>
                        <td><input type='text' id='LoLKExtraReisen'></td>
                    </tr>
                </table>
            </div>
            <div id='HSiFS'>
                <p><img src='games/hsifs50x50.jpg' alt='HSiFS cover'> <u>Touhou 16 - Hidden Star in Four Seasons</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuSpring</td>
                        <td><input type='text' id='HSiFSEasyReimuSpring'></td>
                        <td><input type='text' id='HSiFSNormalReimuSpring'></td>
                        <td><input type='text' id='HSiFSHardReimuSpring'></td>
                        <td><input type='text' id='HSiFSLunaticReimuSpring'></td>
                        <td><input type='text' id='HSiFSExtraReimu'></td>
                    </tr><tr>
                        <td>ReimuSummer</td>
                        <td><input type='text' id='HSiFSEasyReimuSummer'></td>
                        <td><input type='text' id='HSiFSNormalReimuSummer'></td>
                        <td><input type='text' id='HSiFSHardReimuSummer'></td>
                        <td><input type='text' id='HSiFSLunaticReimuSummer'></td>
                        <td></td>
                    </tr><tr>
                        <td>ReimuAutumn</td>
                        <td><input type='text' id='HSiFSEasyReimuAutumn'></td>
                        <td><input type='text' id='HSiFSNormalReimuAutumn'></td>
                        <td><input type='text' id='HSiFSHardReimuAutumn'></td>
                        <td><input type='text' id='HSiFSLunaticReimuAutumn'></td>
                        <td></td>
                    </tr><tr>
                        <td>ReimuWinter</td>
                        <td><input type='text' id='HSiFSEasyReimuWinter'></td>
                        <td><input type='text' id='HSiFSNormalReimuWinter'></td>
                        <td><input type='text' id='HSiFSHardReimuWinter'></td>
                        <td><input type='text' id='HSiFSLunaticReimuWinter'></td>
                        <td></td>
                    </tr><tr>
                        <td>CirnoSpring</td>
                        <td><input type='text' id='HSiFSEasyCirnoSpring'></td>
                        <td><input type='text' id='HSiFSNormalCirnoSpring'></td>
                        <td><input type='text' id='HSiFSHardCirnoSpring'></td>
                        <td><input type='text' id='HSiFSLunaticCirnoSpring'></td>
                        <td><input type='text' id='HSiFSExtraCirno'></td>
                    </tr><tr>
                        <td>CirnoSummer</td>
                        <td><input type='text' id='HSiFSEasyCirnoSummer'></td>
                        <td><input type='text' id='HSiFSNormalCirnoSummer'></td>
                        <td><input type='text' id='HSiFSHardCirnoSummer'></td>
                        <td><input type='text' id='HSiFSLunaticCirnoSummer'></td>
                        <td></td>
                    </tr><tr>
                        <td>CirnoAutumn</td>
                        <td><input type='text' id='HSiFSEasyCirnoAutumn'></td>
                        <td><input type='text' id='HSiFSNormalCirnoAutumn'></td>
                        <td><input type='text' id='HSiFSHardCirnoAutumn'></td>
                        <td><input type='text' id='HSiFSLunaticCirnoAutumn'></td>
                        <td></td>
                    </tr><tr>
                        <td>CirnoWinter</td>
                        <td><input type='text' id='HSiFSEasyCirnoWinter'></td>
                        <td><input type='text' id='HSiFSNormalCirnoWinter'></td>
                        <td><input type='text' id='HSiFSHardCirnoWinter'></td>
                        <td><input type='text' id='HSiFSLunaticCirnoWinter'></td>
                        <td></td>
                    </tr><tr>
                        <td>AyaSpring</td>
                        <td><input type='text' id='HSiFSEasyAyaSpring'></td>
                        <td><input type='text' id='HSiFSNormalAyaSpring'></td>
                        <td><input type='text' id='HSiFSHardAyaSpring'></td>
                        <td><input type='text' id='HSiFSLunaticAyaSpring'></td>
                        <td><input type='text' id='HSiFSExtraAya'></td>
                    </tr><tr>
                        <td>AyaSummer</td>
                        <td><input type='text' id='HSiFSEasyAyaSummer'></td>
                        <td><input type='text' id='HSiFSNormalAyaSummer'></td>
                        <td><input type='text' id='HSiFSHardAyaSummer'></td>
                        <td><input type='text' id='HSiFSLunaticAyaSummer'></td>
                        <td></td>
                    </tr><tr>
                        <td>AyaAutumn</td>
                        <td><input type='text' id='HSiFSEasyAyaAutumn'></td>
                        <td><input type='text' id='HSiFSNormalAyaAutumn'></td>
                        <td><input type='text' id='HSiFSHardAyaAutumn'></td>
                        <td><input type='text' id='HSiFSLunaticAyaAutumn'></td>
                        <td></td>
                    </tr><tr>
                        <td>AyaWinter</td>
                        <td><input type='text' id='HSiFSEasyAyaWinter'></td>
                        <td><input type='text' id='HSiFSNormalAyaWinter'></td>
                        <td><input type='text' id='HSiFSHardAyaWinter'></td>
                        <td><input type='text' id='HSiFSLunaticAyaWinter'></td>
                        <td></td>
                    </tr><tr>
                        <td>MarisaSpring</td>
                        <td><input type='text' id='HSiFSEasyMarisaSpring'></td>
                        <td><input type='text' id='HSiFSNormalMarisaSpring'></td>
                        <td><input type='text' id='HSiFSHardMarisaSpring'></td>
                        <td><input type='text' id='HSiFSLunaticMarisaSpring'></td>
                        <td><input type='text' id='HSiFSExtraMarisa'></td>
                    </tr><tr>
                        <td>MarisaSummer</td>
                        <td><input type='text' id='HSiFSEasyMarisaSummer'></td>
                        <td><input type='text' id='HSiFSNormalMarisaSummer'></td>
                        <td><input type='text' id='HSiFSHardMarisaSummer'></td>
                        <td><input type='text' id='HSiFSLunaticMarisaSummer'></td>
                        <td></td>
                    </tr><tr>
                        <td>MarisaAutumn</td>
                        <td><input type='text' id='HSiFSEasyMarisaAutumn'></td>
                        <td><input type='text' id='HSiFSNormalMarisaAutumn'></td>
                        <td><input type='text' id='HSiFSHardMarisaAutumn'></td>
                        <td><input type='text' id='HSiFSLunaticMarisaAutumn'></td>
                        <td></td>
                    </tr><tr>
                        <td>MarisaWinter</td>
                        <td><input type='text' id='HSiFSEasyMarisaWinter'></td>
                        <td><input type='text' id='HSiFSNormalMarisaWinter'></td>
                        <td><input type='text' id='HSiFSHardMarisaWinter'></td>
                        <td><input type='text' id='HSiFSLunaticMarisaWinter'></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div id='WBaWC'>
                <p><img src='games/wbawc50x50.jpg' alt='WBaWC cover'> <u>Touhou 17 - Wily Beast and Weakest Creature</u></p>
                <table class='center'>
                    <tr>
                        <th>Shottype</th>
                        <th>Easy</th>
                        <th>Normal</th>
                        <th>Hard</th>
                        <th>Lunatic</th>
                        <th>Extra</th>
                    </tr><tr>
                        <td>ReimuWolf</td>
                        <td><input type='text' id='WBaWCEasyReimuWolf'></td>
                        <td><input type='text' id='WBaWCNormalReimuWolf'></td>
                        <td><input type='text' id='WBaWCHardReimuWolf'></td>
                        <td><input type='text' id='WBaWCLunaticReimuWolf'></td>
                        <td><input type='text' id='WBaWCExtraReimuWolf'></td>
                    </tr><tr>
                        <td>ReimuOtter</td>
                        <td><input type='text' id='WBaWCEasyReimuOtter'></td>
                        <td><input type='text' id='WBaWCNormalReimuOtter'></td>
                        <td><input type='text' id='WBaWCHardReimuOtter'></td>
                        <td><input type='text' id='WBaWCLunaticReimuOtter'></td>
                        <td><input type='text' id='WBaWCExtraReimuOtter'></td>
                    </tr><tr>
                        <td>ReimuEagle</td>
                        <td><input type='text' id='WBaWCEasyReimuEagle'></td>
                        <td><input type='text' id='WBaWCNormalReimuEagle'></td>
                        <td><input type='text' id='WBaWCHardReimuEagle'></td>
                        <td><input type='text' id='WBaWCLunaticReimuEagle'></td>
                        <td><input type='text' id='WBaWCExtraReimuEagle'></td>
                    </tr><tr>
                        <td>MarisaWolf</td>
                        <td><input type='text' id='WBaWCEasyMarisaWolf'></td>
                        <td><input type='text' id='WBaWCNormalMarisaWolf'></td>
                        <td><input type='text' id='WBaWCHardMarisaWolf'></td>
                        <td><input type='text' id='WBaWCLunaticMarisaWolf'></td>
                        <td><input type='text' id='WBaWCExtraMarisaWolf'></td>
                    </tr><tr>
                        <td>MarisaOtter</td>
                        <td><input type='text' id='WBaWCEasyMarisaOtter'></td>
                        <td><input type='text' id='WBaWCNormalMarisaOtter'></td>
                        <td><input type='text' id='WBaWCHardMarisaOtter'></td>
                        <td><input type='text' id='WBaWCLunaticMarisaOtter'></td>
                        <td><input type='text' id='WBaWCExtraMarisaOtter'></td>
                    </tr><tr>
                        <td>MarisaEagle</td>
                        <td><input type='text' id='WBaWCEasyMarisaEagle'></td>
                        <td><input type='text' id='WBaWCNormalMarisaEagle'></td>
                        <td><input type='text' id='WBaWCHardMarisaEagle'></td>
                        <td><input type='text' id='WBaWCLunaticMarisaEagle'></td>
                        <td><input type='text' id='WBaWCExtraMarisaEagle'></td>
                    </tr><tr>
                        <td>YoumuWolf</td>
                        <td><input type='text' id='WBaWCEasyYoumuWolf'></td>
                        <td><input type='text' id='WBaWCNormalYoumuWolf'></td>
                        <td><input type='text' id='WBaWCHardYoumuWolf'></td>
                        <td><input type='text' id='WBaWCLunaticYoumuWolf'></td>
                        <td><input type='text' id='WBaWCExtraYoumuWolf'></td>
                    </tr><tr>
                        <td>YoumuOtter</td>
                        <td><input type='text' id='WBaWCEasyYoumuOtter'></td>
                        <td><input type='text' id='WBaWCNormalYoumuOtter'></td>
                        <td><input type='text' id='WBaWCHardYoumuOtter'></td>
                        <td><input type='text' id='WBaWCLunaticYoumuOtter'></td>
                        <td><input type='text' id='WBaWCExtraYoumuOtter'></td>
                    </tr><tr>
                        <td>YoumuEagle</td>
                        <td><input type='text' id='WBaWCEasyYoumuEagle'></td>
                        <td><input type='text' id='WBaWCNormalYoumuEagle'></td>
                        <td><input type='text' id='WBaWCHardYoumuEagle'></td>
                        <td><input type='text' id='WBaWCLunaticYoumuEagle'></td>
                        <td><input type='text' id='WBaWCExtraYoumuEagle'></td>
                    </tr>
                </table>
            </div>
			<div id='topList'></div>
            <p>Number of decimals: <input id='precision' type='number' value='0' min='0' max='5' step='1'></p>
            <p id='error'></p>
			<p><label for='toggleData'>Save Data</label><input id='toggleData' type='checkbox' onClick='allowData()'></p>
			<p><input type='button' onClick='calc()' value='Calculate'><input type='button' onClick='reset()' value='Reset'></p>
			<h2 id='ack'>Acknowledgements</h2>
			<p id='credit'>The background image
			was drawn by <a href='https://www.pixiv.net/member.php?id=87950'>りすたる</a>.</p>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
		</div>
	</body>

</html>
