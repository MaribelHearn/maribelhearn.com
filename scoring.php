<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

	<head>
		<title>High Score Storage</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Save your Touhou game scores and calculate how they compare to the world records.'>
        <meta name='keywords' content='touhou, touhou project, score, high score, storage, scoring, wr, wrs, world record, world records'>
		<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&text=HighScoretaCnsumzAkwld&display=swap'>
		<link rel='stylesheet' type='text/css' href='assets/scoring/scoring.css'>
		<link rel='icon' type='image/x-icon' href='assets/scoring/scoring.ico'>
        <script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/scoring/scoring.js' defer></script>
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
                    <tr class='noborders'>
                        <td>
                            <input id='HRtPc' type='checkbox' class='check' checked>
                            <label for='HRtPc'>HRtP</label>
                        </td><td>
                            <input id='EoSDc' type='checkbox' class='check' checked>
                            <label for='EoSDc'>EoSD</label>
                        </td><td>
                            <input id='SAc' type='checkbox' class='check' checked>
                            <label for='SAc'>SA</label>
                        </td><td>
                            <input id='LoLKc' type='checkbox' class='check' checked>
                            <label for='LoLKc'>LoLK</label>
                        </td>
                    </tr>
                    <tr class='noborders'>
                        <td>
                            <input id='SoEWc' type='checkbox' class='check' checked>
                            <label for='SoEWc'>SoEW</label>
                        </td><td>
                            <input id='PCBc' type='checkbox' class='check' checked>
                            <label for='PCBc'>PCB</label>
                        </td><td>
                            <input id='UFOc' type='checkbox' class='check' checked>
                            <label for='UFOc'>UFO</label>
                        </td><td>
                            <input id='HSiFSc' type='checkbox' class='check' checked>
                            <label for='HSiFSc'>HSiFS</label>
                        </td>
                    </tr>
                    <tr class='noborders'>
                        <td>
                            <input id='PoDDc' type='checkbox' class='check' checked>
                            <label for='PoDDc'>PoDD</label>
                        </td><td>
                            <input id='INc' type='checkbox' class='check' checked>
                            <label for='INc'>IN</label>
                        </td><td>
                            <input id='GFWc' type='checkbox' class='check' checked>
                            <label for='GFWc'>GFW</label>
                        </td><td>
                            <input id='WBaWCc' type='checkbox' class='check' checked>
                            <label for='WBaWCc'>WBaWC</label>
                        </td>
                    </tr>
                    <tr class='noborders'>
                        <td>
                            <input id='LLSc' type='checkbox' class='check' checked>
                            <label for='LLSc'>LLS</label>
                        </td><td>
                            <input id='PoFVc' type='checkbox' class='check' checked>
                            <label for='PoFVc'>PoFV</label>
                        </td><td>
                            <input id='TDc' type='checkbox' class='check' checked>
                            <label for='TDc'>TD</label>
                        </td><td class='noborders'></td>
                    </tr>
                    <tr class='noborders'>
                        <td>
                            <input id='MSc' type='checkbox' class='check' checked>
                            <label for='MSc'>MS</label>
                        </td><td>
                            <input id='MoFc' type='checkbox' class='check' checked>
                            <label for='MoFc'>MoF</label>
                        </td><td>
                            <input id='DDCc' type='checkbox' class='check' checked>
                            <label for='DDCc'>DDC</label>
                        </td><td class='noborders'></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class='noborders'>
                        <td>
                            <input id='tracked' type='checkbox' checked>
                            <label for='tracked'>Tracked</label>
                        </td><td>
                            <input id='untracked' type='checkbox' checked>
                            <label for='untracked'>Untracked</label>
                        </td><td>
                            <input id='all' type='checkbox' checked>
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
                        <td>
							<label for='HRtPEasyMakai' class='label'>Easy</label>
							<input id='HRtPEasyMakai' type='text'>
						</td>
                        <td>
							<label for='HRtPNormalMakai' class='label'>Normal</label>
							<input id='HRtPNormalMakai' type='text'>
						</td>
                        <td class='break'>
							<label for='HRtPHardMakai' class='label'>Hard</label>
							<input id='HRtPHardMakai' type='text'>
						</td>
                        <td>
							<label for='HRtPLunaticMakai' class='label'>Lunatic</label>
							<input id='HRtPLunaticMakai' type='text'>
						</td>
                    </tr><tr>
                        <td>Jigoku</td>
                        <td>
							<label for='HRtPEasyJigoku' class='label'>Easy</label>
							<input id='HRtPEasyJigoku' type='text'>
						</td>
                        <td>
							<label for='HRtPNormalJigoku' class='label'>Normal</label>
							<input id='HRtPNormalJigoku' type='text'>
						</td>
                        <td class='break'>
							<label for='HRtPHardJigoku' class='label'>Hard</label>
							<input id='HRtPHardJigoku' type='text'>
						</td>
                        <td>
							<label for='HRtPLunaticJigoku' class='label'>Lunatic</label>
							<input id='HRtPLunaticJigoku' type='text'>
						</td>
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
                        <td>
							<label for='SoEWEasyReimuA' class='label'>Easy</label>
							<input id='SoEWEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='SoEWNormalReimuA' class='label'>Normal</label>
							<input id='SoEWNormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='SoEWHardReimuA' class='label'>Hard</label>
							<input id='SoEWHardReimuA' type='text'>
						</td>
                        <td>
							<label for='SoEWLunaticReimuA' class='label'>Lunatic</label>
							<input id='SoEWLunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='SoEWExtraReimuA' class='label'>Extra</label>
							<input id='SoEWExtraReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='SoEWEasyReimuB' class='label'>Easy</label>
							<input id='SoEWEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='SoEWNormalReimuB' class='label'>Normal</label>
							<input id='SoEWNormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='SoEWHardReimuB' class='label'>Hard</label>
							<input id='SoEWHardReimuB' type='text'>
						</td>
                        <td>
							<label for='SoEWLunaticReimuB' class='label'>Lunatic</label>
							<input id='SoEWLunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='SoEWExtraReimuB' class='label'>Extra</label>
							<input id='SoEWExtraReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuC</td>
                        <td>
							<label for='SoEWEasyReimuC' class='label'>Easy</label>
							<input id='SoEWEasyReimuC' type='text'>
						</td>
                        <td>
							<label for='SoEWNormalReimuC' class='label'>Normal</label>
							<input id='SoEWNormalReimuC' type='text'>
						</td>
                        <td class='break'>
							<label for='SoEWHardReimuC' class='label'>Hard</label>
							<input id='SoEWHardReimuC' type='text'>
						</td>
                        <td>
							<label for='SoEWLunaticReimuC' class='label'>Lunatic</label>
							<input id='SoEWLunaticReimuC' type='text'>
						</td>
                        <td class='break'>
							<label for='SoEWExtraReimuC' class='label'>Extra</label>
							<input id='SoEWExtraReimuC' type='text'>
						</td>
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
                        <td>
							<label for='PoDDEasyReimu' class='label'>Easy</label>
							<input id='PoDDEasyReimu' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalReimu' class='label'>Normal</label>
							<input id='PoDDNormalReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardReimu' class='label'>Hard</label>
							<input id='PoDDHardReimu' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticReimu' class='label'>Lunatic</label>
							<input id='PoDDLunaticReimu' type='text'>
						</td>
                    </tr><tr>
                        <td>Mima</td>
                        <td>
							<label for='PoDDEasyMima' class='label'>Easy</label>
							<input id='PoDDEasyMima' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalMima' class='label'>Normal</label>
							<input id='PoDDNormalMima' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardMima' class='label'>Hard</label>
							<input id='PoDDHardMima' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticMima' class='label'>Lunatic</label>
							<input id='PoDDLunaticMima' type='text'>
						</td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td>
							<label for='PoDDEasyMarisa' class='label'>Easy</label>
							<input id='PoDDEasyMarisa' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalMarisa' class='label'>Normal</label>
							<input id='PoDDNormalMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardMarisa' class='label'>Hard</label>
							<input id='PoDDHardMarisa' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticMarisa' class='label'>Lunatic</label>
							<input id='PoDDLunaticMarisa' type='text'>
						</td>
                    </tr><tr>
                        <td>Ellen</td>
                        <td>
							<label for='PoDDEasyEllen' class='label'>Easy</label>
							<input id='PoDDEasyEllen' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalEllen' class='label'>Normal</label>
							<input id='PoDDNormalEllen' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardEllen' class='label'>Hard</label>
							<input id='PoDDHardEllen' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticEllen' class='label'>Lunatic</label>
							<input id='PoDDLunaticEllen' type='text'>
						</td>
                    </tr><tr>
                        <td>Kotohime</td>
                        <td>
							<label for='PoDDEasyKotohime' class='label'>Easy</label>
							<input id='PoDDEasyKotohime' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalKotohime' class='label'>Normal</label>
							<input id='PoDDNormalKotohime' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardKotohime' class='label'>Hard</label>
							<input id='PoDDHardKotohime' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticKotohime' class='label'>Lunatic</label>
							<input id='PoDDLunaticKotohime' type='text'>
						</td>
                    </tr><tr>
                        <td>Kana</td>
                        <td>
							<label for='PoDDEasyKana' class='label'>Easy</label>
							<input id='PoDDEasyKana' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalKana' class='label'>Normal</label>
							<input id='PoDDNormalKana' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardKana' class='label'>Hard</label>
							<input id='PoDDHardKana' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticKana' class='label'>Lunatic</label>
							<input id='PoDDLunaticKana' type='text'>
						</td>
                    </tr><tr>
                        <td>Rikako</td>
                        <td>
							<label for='PoDDEasyRikako' class='label'>Easy</label>
							<input id='PoDDEasyRikako' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalRikako' class='label'>Normal</label>
							<input id='PoDDNormalRikako' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardRikako' class='label'>Hard</label>
							<input id='PoDDHardRikako' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticRikako' class='label'>Lunatic</label>
							<input id='PoDDLunaticRikako' type='text'>
						</td>
                    </tr><tr>
                        <td>Chiyuri</td>
                        <td>
							<label for='PoDDEasyChiyuri' class='label'>Easy</label>
							<input id='PoDDEasyChiyuri' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalChiyuri' class='label'>Normal</label>
							<input id='PoDDNormalChiyuri' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardChiyuri' class='label'>Hard</label>
							<input id='PoDDHardChiyuri' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticChiyuri' class='label'>Lunatic</label>
							<input id='PoDDLunaticChiyuri' type='text'>
						</td>
                    </tr><tr>
                        <td>Yumemi</td>
                        <td>
							<label for='PoDDEasyYumemi' class='label'>Easy</label>
							<input id='PoDDEasyYumemi' type='text'>
						</td>
                        <td>
							<label for='PoDDNormalYumemi' class='label'>Normal</label>
							<input id='PoDDNormalYumemi' type='text'>
						</td>
                        <td class='break'>
							<label for='PoDDHardYumemi' class='label'>Hard</label>
							<input id='PoDDHardYumemi' type='text'>
						</td>
                        <td>
							<label for='PoDDLunaticYumemi' class='label'>Lunatic</label>
							<input id='PoDDLunaticYumemi' type='text'>
						</td>
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
                        <td>
							<label for='LLSEasyReimuA' class='label'>Easy</label>
							<input id='LLSEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='LLSNormalReimuA' class='label'>Normal</label>
							<input id='LLSNormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSHardReimuA' class='label'>Hard</label>
							<input id='LLSHardReimuA' type='text'>
						</td>
                        <td>
							<label for='LLSLunaticReimuA' class='label'>Lunatic</label>
							<input id='LLSLunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSExtraReimuA' class='label'>Extra</label>
							<input id='LLSExtraReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='LLSEasyReimuB' class='label'>Easy</label>
							<input id='LLSEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='LLSNormalReimuB' class='label'>Normal</label>
							<input id='LLSNormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSHardReimuB' class='label'>Hard</label>
							<input id='LLSHardReimuB' type='text'>
						</td>
                        <td>
							<label for='LLSLunaticReimuB' class='label'>Lunatic</label>
							<input id='LLSLunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSExtraReimuB' class='label'>Extra</label>
							<input id='LLSExtraReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td>
							<label for='LLSEasyMarisaA' class='label'>Easy</label>
							<input id='LLSEasyMarisaA' type='text'>
						</td>
                        <td>
							<label for='LLSNormalMarisaA' class='label'>Normal</label>
							<input id='LLSNormalMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSHardMarisaA' class='label'>Hard</label>
							<input id='LLSHardMarisaA' type='text'>
						</td>
                        <td>
							<label for='LLSLunaticMarisaA' class='label'>Lunatic</label>
							<input id='LLSLunaticMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSExtraMarisaA' class='label'>Extra</label>
							<input id='LLSExtraMarisaA' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td>
							<label for='LLSEasyMarisaB' class='label'>Easy</label>
							<input id='LLSEasyMarisaB' type='text'>
						</td>
                        <td>
							<label for='LLSNormalMarisaB' class='label'>Normal</label>
							<input id='LLSNormalMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSHardMarisaB' class='label'>Hard</label>
							<input id='LLSHardMarisaB' type='text'>
						</td>
                        <td>
							<label for='LLSLunaticMarisaB' class='label'>Lunatic</label>
							<input id='LLSLunaticMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='LLSExtraMarisaB' class='label'>Extra</label>
							<input id='LLSExtraMarisaB' type='text'>
						</td>
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
                        <td>
							<label for='MSEasyReimu' class='label'>Easy</label>
							<input id='MSEasyReimu' type='text'>
						</td>
                        <td>
							<label for='MSNormalReimu' class='label'>Normal</label>
							<input id='MSNormalReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='MSHardReimu' class='label'>Hard</label>
							<input id='MSHardReimu' type='text'>
						</td>
                        <td>
							<label for='MSLunaticReimu' class='label'>Lunatic</label>
							<input id='MSLunaticReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='MSExtraReimu' class='label'>Extra</label>
							<input id='MSExtraReimu' type='text'>
						</td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td>
							<label for='MSEasyMarisa' class='label'>Easy</label>
							<input id='MSEasyMarisa' type='text'>
						</td>
                        <td>
							<label for='MSNormalMarisa' class='label'>Normal</label>
							<input id='MSNormalMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='MSHardMarisa' class='label'>Hard</label>
							<input id='MSHardMarisa' type='text'>
						</td>
                        <td>
							<label for='MSLunaticMarisa' class='label'>Lunatic</label>
							<input id='MSLunaticMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='MSExtraMarisa' class='label'>Extra</label>
							<input id='MSExtraMarisa' type='text'>
						</td>
                    </tr><tr>
                        <td>Mima</td>
                        <td>
							<label for='MSEasyMima' class='label'>Easy</label>
							<input id='MSEasyMima' type='text'>
						</td>
                        <td>
							<label for='MSNormalMima' class='label'>Normal</label>
							<input id='MSNormalMima' type='text'>
						</td>
                        <td class='break'>
							<label for='MSHardMima' class='label'>Hard</label>
							<input id='MSHardMima' type='text'>
						</td>
                        <td>
							<label for='MSLunaticMima' class='label'>Lunatic</label>
							<input id='MSLunaticMima' type='text'>
						</td>
                        <td class='break'>
							<label for='MSExtraMima' class='label'>Extra</label>
							<input id='MSExtraMima' type='text'>
						</td>
                    </tr><tr>
                        <td>Yuuka</td>
                        <td>
							<label for='MSEasyYuuka' class='label'>Easy</label>
							<input id='MSEasyYuuka' type='text'>
						</td>
                        <td>
							<label for='MSNormalYuuka' class='label'>Normal</label>
							<input id='MSNormalYuuka' type='text'>
						</td>
                        <td class='break'>
							<label for='MSHardYuuka' class='label'>Hard</label>
							<input id='MSHardYuuka' type='text'>
						</td>
                        <td>
							<label for='MSLunaticYuuka' class='label'>Lunatic</label>
							<input id='MSLunaticYuuka' type='text'>
						</td>
                        <td class='break'>
							<label for='MSExtraYuuka' class='label'>Extra</label>
							<input id='MSExtraYuuka' type='text'>
						</td>
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
                        <td>
							<label for='EoSDEasyReimuA' class='label'>Easy</label>
							<input id='EoSDEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='EoSDNormalReimuA' class='label'>Normal</label>
							<input id='EoSDNormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDHardReimuA' class='label'>Hard</label>
							<input id='EoSDHardReimuA' type='text'>
						</td>
                        <td>
							<label for='EoSDLunaticReimuA' class='label'>Lunatic</label>
							<input id='EoSDLunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDExtraReimuA' class='label'>Extra</label>
							<input id='EoSDExtraReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='EoSDEasyReimuB' class='label'>Easy</label>
							<input id='EoSDEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='EoSDNormalReimuB' class='label'>Normal</label>
							<input id='EoSDNormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDHardReimuB' class='label'>Hard</label>
							<input id='EoSDHardReimuB' type='text'>
						</td>
                        <td>
							<label for='EoSDLunaticReimuB' class='label'>Lunatic</label>
							<input id='EoSDLunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDExtraReimuB' class='label'>Extra</label>
							<input id='EoSDExtraReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td>
							<label for='EoSDEasyMarisaA' class='label'>Easy</label>
							<input id='EoSDEasyMarisaA' type='text'>
						</td>
                        <td>
							<label for='EoSDNormalMarisaA' class='label'>Normal</label>
							<input id='EoSDNormalMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDHardMarisaA' class='label'>Hard</label>
							<input id='EoSDHardMarisaA' type='text'>
						</td>
                        <td>
							<label for='EoSDLunaticMarisaA' class='label'>Lunatic</label>
							<input id='EoSDLunaticMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDExtraMarisaA' class='label'>Extra</label>
							<input id='EoSDExtraMarisaA' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td>
							<label for='EoSDEasyMarisaB' class='label'>Easy</label>
							<input id='EoSDEasyMarisaB' type='text'>
						</td>
                        <td>
							<label for='EoSDNormalMarisaB' class='label'>Normal</label>
							<input id='EoSDNormalMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDHardMarisaB' class='label'>Hard</label>
							<input id='EoSDHardMarisaB' type='text'>
						</td>
                        <td>
							<label for='EoSDLunaticMarisaB' class='label'>Lunatic</label>
							<input id='EoSDLunaticMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='EoSDExtraMarisaB' class='label'>Extra</label>
							<input id='EoSDExtraMarisaB' type='text'>
						</td>
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
                        <td>
							<label for='PCBEasyReimuA' class='label'>Easy</label>
							<input id='PCBEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='PCBNormalReimuA' class='label'>Normal</label>
							<input id='PCBNormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBHardReimuA' class='label'>Hard</label>
							<input id='PCBHardReimuA' type='text'>
						</td>
                        <td>
							<label for='PCBLunaticReimuA' class='label'>Lunatic</label>
							<input id='PCBLunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBExtraReimuA' class='label'>Extra</label>
							<input id='PCBExtraReimuA' type='text'>
						</td>
                        <td>
							<label for='PCBPhantasmReimuA' class='label'>Phantasm</label>
							<input id='PCBPhantasmReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='PCBEasyReimuB' class='label'>Easy</label>
							<input id='PCBEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='PCBNormalReimuB' class='label'>Normal</label>
							<input id='PCBNormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBHardReimuB' class='label'>Hard</label>
							<input id='PCBHardReimuB' type='text'>
						</td>
                        <td>
							<label for='PCBLunaticReimuB' class='label'>Lunatic</label>
							<input id='PCBLunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBExtraReimuB' class='label'>Extra</label>
							<input id='PCBExtraReimuB' type='text'>
						</td>
                        <td>
							<label for='PCBPhantasmReimuB' class='label'>Phantasm</label>
							<input id='PCBPhantasmReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td>
							<label for='PCBEasyMarisaA' class='label'>Easy</label>
							<input id='PCBEasyMarisaA' type='text'>
						</td>
                        <td>
							<label for='PCBNormalMarisaA' class='label'>Normal</label>
							<input id='PCBNormalMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBHardMarisaA' class='label'>Hard</label>
							<input id='PCBHardMarisaA' type='text'>
						</td>
                        <td>
							<label for='PCBLunaticMarisaA' class='label'>Lunatic</label>
							<input id='PCBLunaticMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBExtraMarisaA' class='label'>Extra</label>
							<input id='PCBExtraMarisaA' type='text'>
						</td>
                        <td>
							<label for='PCBPhantasmMarisaA' class='label'>Phantasm</label>
							<input id='PCBPhantasmMarisaA' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td>
							<label for='PCBEasyMarisaB' class='label'>Easy</label>
							<input id='PCBEasyMarisaB' type='text'>
						</td>
                        <td>
							<label for='PCBNormalMarisaB' class='label'>Normal</label>
							<input id='PCBNormalMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBHardMarisaB' class='label'>Hard</label>
							<input id='PCBHardMarisaB' type='text'>
						</td>
                        <td>
							<label for='PCBLunaticMarisaB' class='label'>Lunatic</label>
							<input id='PCBLunaticMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBExtraMarisaB' class='label'>Extra</label>
							<input id='PCBExtraMarisaB' type='text'>
						</td>
                        <td>
							<label for='PCBPhantasmMarisaB' class='label'>Phantasm</label>
							<input id='PCBPhantasmMarisaB' type='text'>
						</td>
                    </tr><tr>
                        <td>SakuyaA</td>
                        <td>
							<label for='PCBEasySakuyaA' class='label'>Easy</label>
							<input id='PCBEasySakuyaA' type='text'>
						</td>
                        <td>
							<label for='PCBNormalSakuyaA' class='label'>Normal</label>
							<input id='PCBNormalSakuyaA' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBHardSakuyaA' class='label'>Hard</label>
							<input id='PCBHardSakuyaA' type='text'>
						</td>
                        <td>
							<label for='PCBLunaticSakuyaA' class='label'>Lunatic</label>
							<input id='PCBLunaticSakuyaA' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBExtraSakuyaA' class='label'>Extra</label>
							<input id='PCBExtraSakuyaA' type='text'>
						</td>
                        <td>
							<label for='PCBPhantasmSakuyaA' class='label'>Phantasm</label>
							<input id='PCBPhantasmSakuyaA' type='text'>
						</td>
                    </tr><tr>
                        <td>SakuyaB</td>
                        <td>
							<label for='PCBEasySakuyaB' class='label'>Easy</label>
							<input id='PCBEasySakuyaB' type='text'>
						</td>
                        <td>
							<label for='PCBNormalSakuyaB' class='label'>Normal</label>
							<input id='PCBNormalSakuyaB' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBHardSakuyaB' class='label'>Hard</label>
							<input id='PCBHardSakuyaB' type='text'>
						</td>
                        <td>
							<label for='PCBLunaticSakuyaB' class='label'>Lunatic</label>
							<input id='PCBLunaticSakuyaB' type='text'>
						</td>
                        <td class='break'>
							<label for='PCBExtraSakuyaB' class='label'>Extra</label>
							<input id='PCBExtraSakuyaB' type='text'>
						</td>
                        <td>
							<label for='PCBPhantasmSakuyaB' class='label'>Phantasm</label>
							<input id='PCBPhantasmSakuyaB' type='text'>
						</td>
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
                        <td>
							<label for='INEasyBorderTeam' class='label'>Easy</label>
							<input id='INEasyBorderTeam' type='text'>
						</td>
                        <td>
							<label for='INNormalBorderTeam' class='label'>Normal</label>
							<input id='INNormalBorderTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardBorderTeam' class='label'>Hard</label>
							<input id='INHardBorderTeam' type='text'>
						</td>
                        <td>
							<label for='INLunaticBorderTeam' class='label'>Lunatic</label>
							<input id='INLunaticBorderTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraBorderTeam' class='label'>Extra</label>
							<input id='INExtraBorderTeam' type='text'>
						</td>
                    </tr><tr>
                        <td>Magic Team</td>
                        <td>
							<label for='INEasyMagicTeam' class='label'>Easy</label>
							<input id='INEasyMagicTeam' type='text'>
						</td>
                        <td>
							<label for='INNormalMagicTeam' class='label'>Normal</label>
							<input id='INNormalMagicTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardMagicTeam' class='label'>Hard</label>
							<input id='INHardMagicTeam' type='text'>
						</td>
                        <td>
							<label for='INLunaticMagicTeam' class='label'>Lunatic</label>
							<input id='INLunaticMagicTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraMagicTeam' class='label'>Extra</label>
							<input id='INExtraMagicTeam' type='text'>
						</td>
                    </tr><tr>
                        <td>Scarlet Team</td>
                        <td>
							<label for='INEasyScarletTeam' class='label'>Easy</label>
							<input id='INEasyScarletTeam' type='text'>
						</td>
                        <td>
							<label for='INNormalScarletTeam' class='label'>Normal</label>
							<input id='INNormalScarletTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardScarletTeam' class='label'>Hard</label>
							<input id='INHardScarletTeam' type='text'>
						</td>
                        <td>
							<label for='INLunaticScarletTeam' class='label'>Lunatic</label>
							<input id='INLunaticScarletTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraScarletTeam' class='label'>Extra</label>
							<input id='INExtraScarletTeam' type='text'>
						</td>
                    </tr><tr>
                        <td>Ghost Team</td>
                        <td>
							<label for='INEasyGhostTeam' class='label'>Easy</label>
							<input id='INEasyGhostTeam' type='text'>
						</td>
                        <td>
							<label for='INNormalGhostTeam' class='label'>Normal</label>
							<input id='INNormalGhostTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardGhostTeam' class='label'>Hard</label>
							<input id='INHardGhostTeam' type='text'>
						</td>
                        <td>
							<label for='INLunaticGhostTeam' class='label'>Lunatic</label>
							<input id='INLunaticGhostTeam' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraGhostTeam' class='label'>Extra</label>
							<input id='INExtraGhostTeam' type='text'>
						</td>
                    </tr><tr>
                        <td>Reimu</td>
                        <td>
							<label for='INEasyReimu' class='label'>Easy</label>
							<input id='INEasyReimu' type='text'>
						</td>
                        <td>
							<label for='INNormalReimu' class='label'>Normal</label>
							<input id='INNormalReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardReimu' class='label'>Hard</label>
							<input id='INHardReimu' type='text'>
						</td>
                        <td>
							<label for='INLunaticReimu' class='label'>Lunatic</label>
							<input id='INLunaticReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraReimu' class='label'>Extra</label>
							<input id='INExtraReimu' type='text'>
						</td>
                    </tr><tr>
                        <td>Yukari</td>
                        <td>
							<label for='INEasyYukari' class='label'>Easy</label>
							<input id='INEasyYukari' type='text'>
						</td>
                        <td>
							<label for='INNormalYukari' class='label'>Normal</label>
							<input id='INNormalYukari' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardYukari' class='label'>Hard</label>
							<input id='INHardYukari' type='text'>
						</td>
                        <td>
							<label for='INLunaticYukari' class='label'>Lunatic</label>
							<input id='INLunaticYukari' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraYukari' class='label'>Extra</label>
							<input id='INExtraYukari' type='text'>
						</td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td>
							<label for='INEasyMarisa' class='label'>Easy</label>
							<input id='INEasyMarisa' type='text'>
						</td>
                        <td>
							<label for='INNormalMarisa' class='label'>Normal</label>
							<input id='INNormalMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardMarisa' class='label'>Hard</label>
							<input id='INHardMarisa' type='text'>
						</td>
                        <td>
							<label for='INLunaticMarisa' class='label'>Lunatic</label>
							<input id='INLunaticMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraMarisa' class='label'>Extra</label>
							<input id='INExtraMarisa' type='text'>
						</td>
                    </tr><tr>
                        <td>Alice</td>
                        <td>
							<label for='INEasyAlice' class='label'>Easy</label>
							<input id='INEasyAlice' type='text'>
						</td>
                        <td>
							<label for='INNormalAlice' class='label'>Normal</label>
							<input id='INNormalAlice' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardAlice' class='label'>Hard</label>
							<input id='INHardAlice' type='text'>
						</td>
                        <td>
							<label for='INLunaticAlice' class='label'>Lunatic</label>
							<input id='INLunaticAlice' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraAlice' class='label'>Extra</label>
							<input id='INExtraAlice' type='text'>
						</td>
                    </tr><tr>
                        <td>Sakuya</td>
                        <td>
							<label for='INEasySakuya' class='label'>Easy</label>
							<input id='INEasySakuya' type='text'>
						</td>
                        <td>
							<label for='INNormalSakuya' class='label'>Normal</label>
							<input id='INNormalSakuya' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardSakuya' class='label'>Hard</label>
							<input id='INHardSakuya' type='text'>
						</td>
                        <td>
							<label for='INLunaticSakuya' class='label'>Lunatic</label>
							<input id='INLunaticSakuya' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraSakuya' class='label'>Extra</label>
							<input id='INExtraSakuya' type='text'>
						</td>
                    </tr><tr>
                        <td>Remilia</td>
                        <td>
							<label for='INEasyRemilia' class='label'>Easy</label>
							<input id='INEasyRemilia' type='text'>
						</td>
                        <td>
							<label for='INNormalRemilia' class='label'>Normal</label>
							<input id='INNormalRemilia' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardRemilia' class='label'>Hard</label>
							<input id='INHardRemilia' type='text'>
						</td>
                        <td>
							<label for='INLunaticRemilia' class='label'>Lunatic</label>
							<input id='INLunaticRemilia' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraRemilia' class='label'>Extra</label>
							<input id='INExtraRemilia' type='text'>
						</td>
                    </tr><tr>
                        <td>Youmu</td>
                        <td>
							<label for='INEasyYoumu' class='label'>Easy</label>
							<input id='INEasyYoumu' type='text'>
						</td>
                        <td>
							<label for='INNormalYoumu' class='label'>Normal</label>
							<input id='INNormalYoumu' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardYoumu' class='label'>Hard</label>
							<input id='INHardYoumu' type='text'>
						</td>
                        <td>
							<label for='INLunaticYoumu' class='label'>Lunatic</label>
							<input id='INLunaticYoumu' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraYoumu' class='label'>Extra</label>
							<input id='INExtraYoumu' type='text'>
						</td>
                    </tr><tr>
                        <td>Yuyuko</td>
                        <td>
							<label for='INEasyYuyuko' class='label'>Easy</label>
							<input id='INEasyYuyuko' type='text'>
						</td>
                        <td>
							<label for='INNormalYuyuko' class='label'>Normal</label>
							<input id='INNormalYuyuko' type='text'>
						</td>
                        <td class='break'>
							<label for='INHardYuyuko' class='label'>Hard</label>
							<input id='INHardYuyuko' type='text'>
						</td>
                        <td>
							<label for='INLunaticYuyuko' class='label'>Lunatic</label>
							<input id='INLunaticYuyuko' type='text'>
						</td>
                        <td class='break'>
							<label for='INExtraYuyuko' class='label'>Extra</label>
							<input id='INExtraYuyuko' type='text'>
						</td>
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
                        <td>
							<label for='PoFVEasyReimu' class='label'>Easy</label>
							<input id='PoFVEasyReimu' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalReimu' class='label'>Normal</label>
							<input id='PoFVNormalReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardReimu' class='label'>Hard</label>
							<input id='PoFVHardReimu' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticReimu' class='label'>Lunatic</label>
							<input id='PoFVLunaticReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraReimu' class='label'>Extra</label>
							<input id='PoFVExtraReimu' type='text'>
						</td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td>
							<label for='PoFVEasyMarisa' class='label'>Easy</label>
							<input id='PoFVEasyMarisa' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalMarisa' class='label'>Normal</label>
							<input id='PoFVNormalMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardMarisa' class='label'>Hard</label>
							<input id='PoFVHardMarisa' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticMarisa' class='label'>Lunatic</label>
							<input id='PoFVLunaticMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraMarisa' class='label'>Extra</label>
							<input id='PoFVExtraMarisa' type='text'>
						</td>
                    </tr><tr>
                        <td>Sakuya</td>
                        <td>
							<label for='PoFVEasySakuya' class='label'>Easy</label>
							<input id='PoFVEasySakuya' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalSakuya' class='label'>Normal</label>
							<input id='PoFVNormalSakuya' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardSakuya' class='label'>Hard</label>
							<input id='PoFVHardSakuya' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticSakuya' class='label'>Lunatic</label>
							<input id='PoFVLunaticSakuya' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraSakuya' class='label'>Extra</label>
							<input id='PoFVExtraSakuya' type='text'>
						</td>
                    </tr><tr>
                        <td>Youmu</td>
                        <td>
							<label for='PoFVEasyYoumu' class='label'>Easy</label>
							<input id='PoFVEasyYoumu' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalYoumu' class='label'>Normal</label>
							<input id='PoFVNormalYoumu' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardYoumu' class='label'>Hard</label>
							<input id='PoFVHardYoumu' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticYoumu' class='label'>Lunatic</label>
							<input id='PoFVLunaticYoumu' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraYoumu' class='label'>Extra</label>
							<input id='PoFVExtraYoumu' type='text'>
						</td>
                    </tr><tr>
                        <td>Reisen</td>
                        <td>
							<label for='PoFVEasyReisen' class='label'>Easy</label>
							<input id='PoFVEasyReisen' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalReisen' class='label'>Normal</label>
							<input id='PoFVNormalReisen' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardReisen' class='label'>Hard</label>
							<input id='PoFVHardReisen' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticReisen' class='label'>Lunatic</label>
							<input id='PoFVLunaticReisen' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraReisen' class='label'>Extra</label>
							<input id='PoFVExtraReisen' type='text'>
						</td>
                    </tr><tr>
                        <td>Cirno</td>
                        <td>
							<label for='PoFVEasyCirno' class='label'>Easy</label>
							<input id='PoFVEasyCirno' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalCirno' class='label'>Normal</label>
							<input id='PoFVNormalCirno' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardCirno' class='label'>Hard</label>
							<input id='PoFVHardCirno' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticCirno' class='label'>Lunatic</label>
							<input id='PoFVLunaticCirno' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraCirno' class='label'>Extra</label>
							<input id='PoFVExtraCirno' type='text'>
						</td>
                    </tr><tr>
                        <td>Lyrica</td>
                        <td>
							<label for='PoFVEasyLyrica' class='label'>Easy</label>
							<input id='PoFVEasyLyrica' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalLyrica' class='label'>Normal</label>
							<input id='PoFVNormalLyrica' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardLyrica' class='label'>Hard</label>
							<input id='PoFVHardLyrica' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticLyrica' class='label'>Lunatic</label>
							<input id='PoFVLunaticLyrica' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraLyrica' class='label'>Extra</label>
							<input id='PoFVExtraLyrica' type='text'>
						</td>
                    </tr><tr>
                        <td>Mystia</td>
                        <td>
							<label for='PoFVEasyMystia' class='label'>Easy</label>
							<input id='PoFVEasyMystia' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalMystia' class='label'>Normal</label>
							<input id='PoFVNormalMystia' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardMystia' class='label'>Hard</label>
							<input id='PoFVHardMystia' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticMystia' class='label'>Lunatic</label>
							<input id='PoFVLunaticMystia' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraMystia' class='label'>Extra</label>
							<input id='PoFVExtraMystia' type='text'>
						</td>
                    </tr><tr>
                        <td>Tewi</td>
                        <td>
							<label for='PoFVEasyTewi' class='label'>Easy</label>
							<input id='PoFVEasyTewi' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalTewi' class='label'>Normal</label>
							<input id='PoFVNormalTewi' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardTewi' class='label'>Hard</label>
							<input id='PoFVHardTewi' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticTewi' class='label'>Lunatic</label>
							<input id='PoFVLunaticTewi' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraTewi' class='label'>Extra</label>
							<input id='PoFVExtraTewi' type='text'>
						</td>
                    </tr><tr>
                        <td>Aya</td>
                        <td>
							<label for='PoFVEasyAya' class='label'>Easy</label>
							<input id='PoFVEasyAya' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalAya' class='label'>Normal</label>
							<input id='PoFVNormalAya' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardAya' class='label'>Hard</label>
							<input id='PoFVHardAya' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticAya' class='label'>Lunatic</label>
							<input id='PoFVLunaticAya' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraAya' class='label'>Extra</label>
							<input id='PoFVExtraAya' type='text'>
						</td>
                    </tr><tr>
                        <td>Medicine</td>
                        <td>
							<label for='PoFVEasyMedicine' class='label'>Easy</label>
							<input id='PoFVEasyMedicine' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalMedicine' class='label'>Normal</label>
							<input id='PoFVNormalMedicine' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardMedicine' class='label'>Hard</label>
							<input id='PoFVHardMedicine' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticMedicine' class='label'>Lunatic</label>
							<input id='PoFVLunaticMedicine' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraMedicine' class='label'>Extra</label>
							<input id='PoFVExtraMedicine' type='text'>
						</td>
                    </tr><tr>
                        <td>Yuuka</td>
                        <td>
							<label for='PoFVEasyYuuka' class='label'>Easy</label>
							<input id='PoFVEasyYuuka' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalYuuka' class='label'>Normal</label>
							<input id='PoFVNormalYuuka' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardYuuka' class='label'>Hard</label>
							<input id='PoFVHardYuuka' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticYuuka' class='label'>Lunatic</label>
							<input id='PoFVLunaticYuuka' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraYuuka' class='label'>Extra</label>
							<input id='PoFVExtraYuuka' type='text'>
						</td>
                    </tr><tr>
                        <td>Komachi</td>
                        <td>
							<label for='PoFVEasyKomachi' class='label'>Easy</label>
							<input id='PoFVEasyKomachi' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalKomachi' class='label'>Normal</label>
							<input id='PoFVNormalKomachi' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardKomachi' class='label'>Hard</label>
							<input id='PoFVHardKomachi' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticKomachi' class='label'>Lunatic</label>
							<input id='PoFVLunaticKomachi' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraKomachi' class='label'>Extra</label>
							<input id='PoFVExtraKomachi' type='text'>
						</td>
                    </tr><tr>
                        <td>Eiki</td>
                        <td>
							<label for='PoFVEasyEiki' class='label'>Easy</label>
							<input id='PoFVEasyEiki' type='text'>
						</td>
                        <td>
							<label for='PoFVNormalEiki' class='label'>Normal</label>
							<input id='PoFVNormalEiki' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVHardEiki' class='label'>Hard</label>
							<input id='PoFVHardEiki' type='text'>
						</td>
                        <td>
							<label for='PoFVLunaticEiki' class='label'>Lunatic</label>
							<input id='PoFVLunaticEiki' type='text'>
						</td>
                        <td class='break'>
							<label for='PoFVExtraEiki' class='label'>Extra</label>
							<input id='PoFVExtraEiki' type='text'>
						</td>
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
                        <td>
							<label for='MoFEasyReimuA' class='label'>Easy</label>
							<input id='MoFEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='MoFNormalReimuA' class='label'>Normal</label>
							<input id='MoFNormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFHardReimuA' class='label'>Hard</label>
							<input id='MoFHardReimuA' type='text'>
						</td>
                        <td>
							<label for='MoFLunaticReimuA' class='label'>Lunatic</label>
							<input id='MoFLunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFExtraReimuA' class='label'>Extra</label>
							<input id='MoFExtraReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='MoFEasyReimuB' class='label'>Easy</label>
							<input id='MoFEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='MoFNormalReimuB' class='label'>Normal</label>
							<input id='MoFNormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFHardReimuB' class='label'>Hard</label>
							<input id='MoFHardReimuB' type='text'>
						</td>
                        <td>
							<label for='MoFLunaticReimuB' class='label'>Lunatic</label>
							<input id='MoFLunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFExtraReimuB' class='label'>Extra</label>
							<input id='MoFExtraReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuC</td>
                        <td>
							<label for='MoFEasyReimuC' class='label'>Easy</label>
							<input id='MoFEasyReimuC' type='text'>
						</td>
                        <td>
							<label for='MoFNormalReimuC' class='label'>Normal</label>
							<input id='MoFNormalReimuC' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFHardReimuC' class='label'>Hard</label>
							<input id='MoFHardReimuC' type='text'>
						</td>
                        <td>
							<label for='MoFLunaticReimuC' class='label'>Lunatic</label>
							<input id='MoFLunaticReimuC' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFExtraReimuC' class='label'>Extra</label>
							<input id='MoFExtraReimuC' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td>
							<label for='MoFEasyMarisaA' class='label'>Easy</label>
							<input id='MoFEasyMarisaA' type='text'>
						</td>
                        <td>
							<label for='MoFNormalMarisaA' class='label'>Normal</label>
							<input id='MoFNormalMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFHardMarisaA' class='label'>Hard</label>
							<input id='MoFHardMarisaA' type='text'>
						</td>
                        <td>
							<label for='MoFLunaticMarisaA' class='label'>Lunatic</label>
							<input id='MoFLunaticMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFExtraMarisaA' class='label'>Extra</label>
							<input id='MoFExtraMarisaA' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td>
							<label for='MoFEasyMarisaB' class='label'>Easy</label>
							<input id='MoFEasyMarisaB' type='text'>
						</td>
                        <td>
							<label for='MoFNormalMarisaB' class='label'>Normal</label>
							<input id='MoFNormalMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFHardMarisaB' class='label'>Hard</label>
							<input id='MoFHardMarisaB' type='text'>
						</td>
                        <td>
							<label for='MoFLunaticMarisaB' class='label'>Lunatic</label>
							<input id='MoFLunaticMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFExtraMarisaB' class='label'>Extra</label>
							<input id='MoFExtraMarisaB' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaC</td>
                        <td>
							<label for='MoFEasyMarisaC' class='label'>Easy</label>
							<input id='MoFEasyMarisaC' type='text'>
						</td>
                        <td>
							<label for='MoFNormalMarisaC' class='label'>Normal</label>
							<input id='MoFNormalMarisaC' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFHardMarisaC' class='label'>Hard</label>
							<input id='MoFHardMarisaC' type='text'>
						</td>
                        <td>
							<label for='MoFLunaticMarisaC' class='label'>Lunatic</label>
							<input id='MoFLunaticMarisaC' type='text'>
						</td>
                        <td class='break'>
							<label for='MoFExtraMarisaC' class='label'>Extra</label>
							<input id='MoFExtraMarisaC' type='text'>
						</td>
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
                        <td>
							<label for='SAEasyReimuA' class='label'>Easy</label>
							<input id='SAEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='SANormalReimuA' class='label'>Normal</label>
							<input id='SANormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='SAHardReimuA' class='label'>Hard</label>
							<input id='SAHardReimuA' type='text'>
						</td>
                        <td>
							<label for='SALunaticReimuA' class='label'>Lunatic</label>
							<input id='SALunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='SAExtraReimuA' class='label'>Extra</label>
							<input id='SAExtraReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='SAEasyReimuB' class='label'>Easy</label>
							<input id='SAEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='SANormalReimuB' class='label'>Normal</label>
							<input id='SANormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='SAHardReimuB' class='label'>Hard</label>
							<input id='SAHardReimuB' type='text'>
						</td>
                        <td>
							<label for='SALunaticReimuB' class='label'>Lunatic</label>
							<input id='SALunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='SAExtraReimuB' class='label'>Extra</label>
							<input id='SAExtraReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuC</td>
                        <td>
							<label for='SAEasyReimuC' class='label'>Easy</label>
							<input id='SAEasyReimuC' type='text'>
						</td>
                        <td>
							<label for='SANormalReimuC' class='label'>Normal</label>
							<input id='SANormalReimuC' type='text'>
						</td>
                        <td class='break'>
							<label for='SAHardReimuC' class='label'>Hard</label>
							<input id='SAHardReimuC' type='text'>
						</td>
                        <td>
							<label for='SALunaticReimuC' class='label'>Lunatic</label>
							<input id='SALunaticReimuC' type='text'>
						</td>
                        <td class='break'>
							<label for='SAExtraReimuC' class='label'>Extra</label>
							<input id='SAExtraReimuC' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td>
							<label for='SAEasyMarisaA' class='label'>Easy</label>
							<input id='SAEasyMarisaA' type='text'>
						</td>
                        <td>
							<label for='SANormalMarisaA' class='label'>Normal</label>
							<input id='SANormalMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='SAHardMarisaA' class='label'>Hard</label>
							<input id='SAHardMarisaA' type='text'>
						</td>
                        <td>
							<label for='SALunaticMarisaA' class='label'>Lunatic</label>
							<input id='SALunaticMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='SAExtraMarisaA' class='label'>Extra</label>
							<input id='SAExtraMarisaA' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td>
							<label for='SAEasyMarisaB' class='label'>Easy</label>
							<input id='SAEasyMarisaB' type='text'>
						</td>
                        <td>
							<label for='SANormalMarisaB' class='label'>Normal</label>
							<input id='SANormalMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='SAHardMarisaB' class='label'>Hard</label>
							<input id='SAHardMarisaB' type='text'>
						</td>
                        <td>
							<label for='SALunaticMarisaB' class='label'>Lunatic</label>
							<input id='SALunaticMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='SAExtraMarisaB' class='label'>Extra</label>
							<input id='SAExtraMarisaB' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaC</td>
                        <td>
							<label for='SAEasyMarisaC' class='label'>Easy</label>
							<input id='SAEasyMarisaC' type='text'>
						</td>
                        <td>
							<label for='SANormalMarisaC' class='label'>Normal</label>
							<input id='SANormalMarisaC' type='text'>
						</td>
                        <td class='break'>
							<label for='SAHardMarisaC' class='label'>Hard</label>
							<input id='SAHardMarisaC' type='text'>
						</td>
                        <td>
							<label for='SALunaticMarisaC' class='label'>Lunatic</label>
							<input id='SALunaticMarisaC' type='text'>
						</td>
                        <td class='break'>
							<label for='SAExtraMarisaC' class='label'>Extra</label>
							<input id='SAExtraMarisaC' type='text'>
						</td>
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
                        <td>
							<label for='UFOEasyReimuA' class='label'>Easy</label>
							<input id='UFOEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='UFONormalReimuA' class='label'>Normal</label>
							<input id='UFONormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOHardReimuA' class='label'>Hard</label>
							<input id='UFOHardReimuA' type='text'>
						</td>
                        <td>
							<label for='UFOLunaticReimuA' class='label'>Lunatic</label>
							<input id='UFOLunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOExtraReimuA' class='label'>Extra</label>
							<input id='UFOExtraReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='UFOEasyReimuB' class='label'>Easy</label>
							<input id='UFOEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='UFONormalReimuB' class='label'>Normal</label>
							<input id='UFONormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOHardReimuB' class='label'>Hard</label>
							<input id='UFOHardReimuB' type='text'>
						</td>
                        <td>
							<label for='UFOLunaticReimuB' class='label'>Lunatic</label>
							<input id='UFOLunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOExtraReimuB' class='label'>Extra</label>
							<input id='UFOExtraReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td>
							<label for='UFOEasyMarisaA' class='label'>Easy</label>
							<input id='UFOEasyMarisaA' type='text'>
						</td>
                        <td>
							<label for='UFONormalMarisaA' class='label'>Normal</label>
							<input id='UFONormalMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOHardMarisaA' class='label'>Hard</label>
							<input id='UFOHardMarisaA' type='text'>
						</td>
                        <td>
							<label for='UFOLunaticMarisaA' class='label'>Lunatic</label>
							<input id='UFOLunaticMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOExtraMarisaA' class='label'>Extra</label>
							<input id='UFOExtraMarisaA' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td>
							<label for='UFOEasyMarisaB' class='label'>Easy</label>
							<input id='UFOEasyMarisaB' type='text'>
						</td>
                        <td>
							<label for='UFONormalMarisaB' class='label'>Normal</label>
							<input id='UFONormalMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOHardMarisaB' class='label'>Hard</label>
							<input id='UFOHardMarisaB' type='text'>
						</td>
                        <td>
							<label for='UFOLunaticMarisaB' class='label'>Lunatic</label>
							<input id='UFOLunaticMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOExtraMarisaB' class='label'>Extra</label>
							<input id='UFOExtraMarisaB' type='text'>
						</td>
                    </tr><tr>
                        <td>SanaeA</td>
                        <td>
							<label for='UFOEasySanaeA' class='label'>Easy</label>
							<input id='UFOEasySanaeA' type='text'>
						</td>
                        <td>
							<label for='UFONormalSanaeA' class='label'>Normal</label>
							<input id='UFONormalSanaeA' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOHardSanaeA' class='label'>Hard</label>
							<input id='UFOHardSanaeA' type='text'>
						</td>
                        <td>
							<label for='UFOLunaticSanaeA' class='label'>Lunatic</label>
							<input id='UFOLunaticSanaeA' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOExtraSanaeA' class='label'>Extra</label>
							<input id='UFOExtraSanaeA' type='text'>
						</td>
                    </tr><tr>
                        <td>SanaeB</td>
                        <td>
							<label for='UFOEasySanaeB' class='label'>Easy</label>
							<input id='UFOEasySanaeB' type='text'>
						</td>
                        <td>
							<label for='UFONormalSanaeB' class='label'>Normal</label>
							<input id='UFONormalSanaeB' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOHardSanaeB' class='label'>Hard</label>
							<input id='UFOHardSanaeB' type='text'>
						</td>
                        <td>
							<label for='UFOLunaticSanaeB' class='label'>Lunatic</label>
							<input id='UFOLunaticSanaeB' type='text'>
						</td>
                        <td class='break'>
							<label for='UFOExtraSanaeB' class='label'>Extra</label>
							<input id='UFOExtraSanaeB' type='text'>
						</td>
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
                        <td>
							<label for='GFWEasyA1' class='label'>Easy</label>
							<input id='GFWEasyA1' type='text'>
						</td>
                        <td>
							<label for='GFWNormalA1' class='label'>Normal</label>
							<input id='GFWNormalA1' type='text'>
						</td>
                        <td class='break'>
							<label for='GFWHardA1' class='label'>Hard</label>
							<input id='GFWHardA1' type='text'>
						</td>
                        <td>
							<label for='GFWLunaticA1' class='label'>Lunatic</label>
							<input id='GFWLunaticA1' type='text'>
						</td>
                    </tr><tr>
                        <td>A2</td>
                        <td>
							<label for='GFWEasyA2' class='label'>Easy</label>
							<input id='GFWEasyA2' type='text'>
						</td>
                        <td>
							<label for='GFWNormalA2' class='label'>Normal</label>
							<input id='GFWNormalA2' type='text'>
						</td>
                        <td class='break'>
							<label for='GFWHardA2' class='label'>Hard</label>
							<input id='GFWHardA2' type='text'>
						</td>
                        <td>
							<label for='GFWLunaticA2' class='label'>Lunatic</label>
							<input id='GFWLunaticA2' type='text'>
						</td>
                    </tr><tr>
                        <td>B1</td>
                        <td>
							<label for='GFWEasyB1' class='label'>Easy</label>
							<input id='GFWEasyB1' type='text'>
						</td>
                        <td>
							<label for='GFWNormalB1' class='label'>Normal</label>
							<input id='GFWNormalB1' type='text'>
						</td>
                        <td class='break'>
							<label for='GFWHardB1' class='label'>Hard</label>
							<input id='GFWHardB1' type='text'>
						</td>
                        <td>
							<label for='GFWLunaticB1' class='label'>Lunatic</label>
							<input id='GFWLunaticB1' type='text'>
						</td>
                    </tr><tr>
                        <td>B2</td>
                        <td>
							<label for='GFWEasyB2' class='label'>Easy</label>
							<input id='GFWEasyB2' type='text'>
						</td>
                        <td>
							<label for='GFWNormalB2' class='label'>Normal</label>
							<input id='GFWNormalB2' type='text'>
						</td>
                        <td class='break'>
							<label for='GFWHardB2' class='label'>Hard</label>
							<input id='GFWHardB2' type='text'>
						</td>
                        <td>
							<label for='GFWLunaticB2' class='label'>Lunatic</label>
							<input id='GFWLunaticB2' type='text'>
						</td>
                    </tr><tr>
                        <td>C1</td>
                        <td>
							<label for='GFWEasyC1' class='label'>Easy</label>
							<input id='GFWEasyC1' type='text'>
						</td>
                        <td>
							<label for='GFWNormalC1' class='label'>Normal</label>
							<input id='GFWNormalC1' type='text'>
						</td>
                        <td class='break'>
							<label for='GFWHardC1' class='label'>Hard</label>
							<input id='GFWHardC1' type='text'>
						</td>
                        <td>
							<label for='GFWLunaticC1' class='label'>Lunatic</label>
							<input id='GFWLunaticC1' type='text'>
						</td>
                    </tr><tr>
                        <td>C2</td>
                        <td>
							<label for='GFWEasyC2' class='label'>Easy</label>
							<input id='GFWEasyC2' type='text'>
						</td>
                        <td>
							<label for='GFWNormalC2' class='label'>Normal</label>
							<input id='GFWNormalC2' type='text'>
						</td>
                        <td class='break'>
							<label for='GFWHardC2' class='label'>Hard</label>
							<input id='GFWHardC2' type='text'>
						</td>
                        <td>
							<label for='GFWLunaticC2' class='label'>Lunatic</label>
							<input id='GFWLunaticC2' type='text'>
						</td>
                    </tr><tr>
                        <td><label for='GFWExtra-'>Extra</label></td>
                        <td id='GFWExtra' colspan='4'><input id='GFWExtra-' type='text'></td>
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
                        <td>
							<label for='TDEasyReimu' class='label'>Easy</label>
							<input id='TDEasyReimu' type='text'>
						</td>
                        <td>
							<label for='TDNormalReimu' class='label'>Normal</label>
							<input id='TDNormalReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='TDHardReimu' class='label'>Hard</label>
							<input id='TDHardReimu' type='text'>
						</td>
                        <td>
							<label for='TDLunaticReimu' class='label'>Lunatic</label>
							<input id='TDLunaticReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='TDExtraReimu' class='label'>Extra</label>
							<input id='TDExtraReimu' type='text'>
						</td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td>
							<label for='TDEasyMarisa' class='label'>Easy</label>
							<input id='TDEasyMarisa' type='text'>
						</td>
                        <td>
							<label for='TDNormalMarisa' class='label'>Normal</label>
							<input id='TDNormalMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='TDHardMarisa' class='label'>Hard</label>
							<input id='TDHardMarisa' type='text'>
						</td>
                        <td>
							<label for='TDLunaticMarisa' class='label'>Lunatic</label>
							<input id='TDLunaticMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='TDExtraMarisa' class='label'>Extra</label>
							<input id='TDExtraMarisa' type='text'>
						</td>
                    </tr><tr>
                        <td>Sanae</td>
                        <td>
							<label for='TDEasySanae' class='label'>Easy</label>
							<input id='TDEasySanae' type='text'>
						</td>
                        <td>
							<label for='TDNormalSanae' class='label'>Normal</label>
							<input id='TDNormalSanae' type='text'>
						</td>
                        <td class='break'>
							<label for='TDHardSanae' class='label'>Hard</label>
							<input id='TDHardSanae' type='text'>
						</td>
                        <td>
							<label for='TDLunaticSanae' class='label'>Lunatic</label>
							<input id='TDLunaticSanae' type='text'>
						</td>
                        <td class='break'>
							<label for='TDExtraSanae' class='label'>Extra</label>
							<input id='TDExtraSanae' type='text'>
						</td>
                    </tr><tr>
                        <td>Youmu</td>
                        <td>
							<label for='TDEasyYoumu' class='label'>Easy</label>
							<input id='TDEasyYoumu' type='text'>
						</td>
                        <td>
							<label for='TDNormalYoumu' class='label'>Normal</label>
							<input id='TDNormalYoumu' type='text'>
						</td>
                        <td class='break'>
							<label for='TDHardYoumu' class='label'>Hard</label>
							<input id='TDHardYoumu' type='text'>
						</td>
                        <td>
							<label for='TDLunaticYoumu' class='label'>Lunatic</label>
							<input id='TDLunaticYoumu' type='text'>
						</td>
                        <td class='break'>
							<label for='TDExtraYoumu' class='label'>Extra</label>
							<input id='TDExtraYoumu' type='text'>
						</td>
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
                        <td>
							<label for='DDCEasyReimuA' class='label'>Easy</label>
							<input id='DDCEasyReimuA' type='text'>
						</td>
                        <td>
							<label for='DDCNormalReimuA' class='label'>Normal</label>
							<input id='DDCNormalReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCHardReimuA' class='label'>Hard</label>
							<input id='DDCHardReimuA' type='text'>
						</td>
                        <td>
							<label for='DDCLunaticReimuA' class='label'>Lunatic</label>
							<input id='DDCLunaticReimuA' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCExtraReimuA' class='label'>Extra</label>
							<input id='DDCExtraReimuA' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuB</td>
                        <td>
							<label for='DDCEasyReimuB' class='label'>Easy</label>
							<input id='DDCEasyReimuB' type='text'>
						</td>
                        <td>
							<label for='DDCNormalReimuB' class='label'>Normal</label>
							<input id='DDCNormalReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCHardReimuB' class='label'>Hard</label>
							<input id='DDCHardReimuB' type='text'>
						</td>
                        <td>
							<label for='DDCLunaticReimuB' class='label'>Lunatic</label>
							<input id='DDCLunaticReimuB' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCExtraReimuB' class='label'>Extra</label>
							<input id='DDCExtraReimuB' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaA</td>
                        <td>
							<label for='DDCEasyMarisaA' class='label'>Easy</label>
							<input id='DDCEasyMarisaA' type='text'>
						</td>
                        <td>
							<label for='DDCNormalMarisaA' class='label'>Normal</label>
							<input id='DDCNormalMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCHardMarisaA' class='label'>Hard</label>
							<input id='DDCHardMarisaA' type='text'>
						</td>
                        <td>
							<label for='DDCLunaticMarisaA' class='label'>Lunatic</label>
							<input id='DDCLunaticMarisaA' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCExtraMarisaA' class='label'>Extra</label>
							<input id='DDCExtraMarisaA' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaB</td>
                        <td>
							<label for='DDCEasyMarisaB' class='label'>Easy</label>
							<input id='DDCEasyMarisaB' type='text'>
						</td>
                        <td>
							<label for='DDCNormalMarisaB' class='label'>Normal</label>
							<input id='DDCNormalMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCHardMarisaB' class='label'>Hard</label>
							<input id='DDCHardMarisaB' type='text'>
						</td>
                        <td>
							<label for='DDCLunaticMarisaB' class='label'>Lunatic</label>
							<input id='DDCLunaticMarisaB' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCExtraMarisaB' class='label'>Extra</label>
							<input id='DDCExtraMarisaB' type='text'>
						</td>
                    </tr><tr>
                        <td>SakuyaA</td>
                        <td>
							<label for='DDCEasySakuyaA' class='label'>Easy</label>
							<input id='DDCEasySakuyaA' type='text'>
						</td>
                        <td>
							<label for='DDCNormalSakuyaA' class='label'>Normal</label>
							<input id='DDCNormalSakuyaA' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCHardSakuyaA' class='label'>Hard</label>
							<input id='DDCHardSakuyaA' type='text'>
						</td>
                        <td>
							<label for='DDCLunaticSakuyaA' class='label'>Lunatic</label>
							<input id='DDCLunaticSakuyaA' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCExtraSakuyaA' class='label'>Extra</label>
							<input id='DDCExtraSakuyaA' type='text'>
						</td>
                    </tr><tr>
                        <td>SakuyaB</td>
                        <td>
							<label for='DDCEasySakuyaB' class='label'>Easy</label>
							<input id='DDCEasySakuyaB' type='text'>
						</td>
                        <td>
							<label for='DDCNormalSakuyaB' class='label'>Normal</label>
							<input id='DDCNormalSakuyaB' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCHardSakuyaB' class='label'>Hard</label>
							<input id='DDCHardSakuyaB' type='text'>
						</td>
                        <td>
							<label for='DDCLunaticSakuyaB' class='label'>Lunatic</label>
							<input id='DDCLunaticSakuyaB' type='text'>
						</td>
                        <td class='break'>
							<label for='DDCExtraSakuyaB' class='label'>Extra</label>
							<input id='DDCExtraSakuyaB' type='text'>
						</td>
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
                        <td>
							<label for='LoLKEasyReimu' class='label'>Easy</label>
							<input id='LoLKEasyReimu' type='text'>
						</td>
                        <td>
							<label for='LoLKNormalReimu' class='label'>Normal</label>
							<input id='LoLKNormalReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKHardReimu' class='label'>Hard</label>
							<input id='LoLKHardReimu' type='text'>
						</td>
                        <td>
							<label for='LoLKLunaticReimu' class='label'>Lunatic</label>
							<input id='LoLKLunaticReimu' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKExtraReimu' class='label'>Extra</label>
							<input id='LoLKExtraReimu' type='text'>
						</td>
                    </tr><tr>
                        <td>Marisa</td>
                        <td>
							<label for='LoLKEasyMarisa' class='label'>Easy</label>
							<input id='LoLKEasyMarisa' type='text'>
						</td>
                        <td>
							<label for='LoLKNormalMarisa' class='label'>Normal</label>
							<input id='LoLKNormalMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKHardMarisa' class='label'>Hard</label>
							<input id='LoLKHardMarisa' type='text'>
						</td>
                        <td>
							<label for='LoLKLunaticMarisa' class='label'>Lunatic</label>
							<input id='LoLKLunaticMarisa' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKExtraMarisa' class='label'>Extra</label>
							<input id='LoLKExtraMarisa' type='text'>
						</td>
                    </tr><tr>
                        <td>Sanae</td>
                        <td>
							<label for='LoLKEasySanae' class='label'>Easy</label>
							<input id='LoLKEasySanae' type='text'>
						</td>
                        <td>
							<label for='LoLKNormalSanae' class='label'>Normal</label>
							<input id='LoLKNormalSanae' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKHardSanae' class='label'>Hard</label>
							<input id='LoLKHardSanae' type='text'>
						</td>
                        <td>
							<label for='LoLKLunaticSanae' class='label'>Lunatic</label>
							<input id='LoLKLunaticSanae' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKExtraSanae' class='label'>Extra</label>
							<input id='LoLKExtraSanae' type='text'>
						</td>
                    </tr><tr>
                        <td>Reisen</td>
                        <td>
							<label for='LoLKEasyReisen' class='label'>Easy</label>
							<input id='LoLKEasyReisen' type='text'>
						</td>
                        <td>
							<label for='LoLKNormalReisen' class='label'>Normal</label>
							<input id='LoLKNormalReisen' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKHardReisen' class='label'>Hard</label>
							<input id='LoLKHardReisen' type='text'>
						</td>
                        <td>
							<label for='LoLKLunaticReisen' class='label'>Lunatic</label>
							<input id='LoLKLunaticReisen' type='text'>
						</td>
                        <td class='break'>
							<label for='LoLKExtraReisen' class='label'>Extra</label>
							<input id='LoLKExtraReisen' type='text'>
						</td>
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
                        <td>
							<label for='HSiFSEasyReimuSpring' class='label'>Easy</label>
							<input id='HSiFSEasyReimuSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalReimuSpring' class='label'>Normal</label>
							<input id='HSiFSNormalReimuSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardReimuSpring' class='label'>Hard</label>
							<input id='HSiFSHardReimuSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticReimuSpring' class='label'>Lunatic</label>
							<input id='HSiFSLunaticReimuSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSExtraReimu' class='label'>Extra</label>
							<input id='HSiFSExtraReimu' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuSummer</td>
                        <td>
							<label for='HSiFSEasyReimuSummer' class='label'>Easy</label>
							<input id='HSiFSEasyReimuSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalReimuSummer' class='label'>Normal</label>
							<input id='HSiFSNormalReimuSummer' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardReimuSummer' class='label'>Hard</label>
							<input id='HSiFSHardReimuSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticReimuSummer' class='label'>Lunatic</label>
							<input id='HSiFSLunaticReimuSummer' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>ReimuAutumn</td>
                        <td>
							<label for='HSiFSEasyReimuAutumn' class='label'>Easy</label>
							<input id='HSiFSEasyReimuAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalReimuAutumn' class='label'>Normal</label>
							<input id='HSiFSNormalReimuAutumn' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardReimuAutumn' class='label'>Hard</label>
							<input id='HSiFSHardReimuAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticReimuAutumn' class='label'>Lunatic</label>
							<input id='HSiFSLunaticReimuAutumn' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>ReimuWinter</td>
                        <td>
							<label for='HSiFSEasyReimuWinter' class='label'>Easy</label>
							<input id='HSiFSEasyReimuWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalReimuWinter' class='label'>Normal</label>
							<input id='HSiFSNormalReimuWinter' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardReimuWinter' class='label'>Hard</label>
							<input id='HSiFSHardReimuWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticReimuWinter' class='label'>Lunatic</label>
							<input id='HSiFSLunaticReimuWinter' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>CirnoSpring</td>
                        <td>
							<label for='HSiFSEasyCirnoSpring' class='label'>Easy</label>
							<input id='HSiFSEasyCirnoSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalCirnoSpring' class='label'>Normal</label>
							<input id='HSiFSNormalCirnoSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardCirnoSpring' class='label'>Hard</label>
							<input id='HSiFSHardCirnoSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticCirnoSpring' class='label'>Lunatic</label>
							<input id='HSiFSLunaticCirnoSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSExtraCirno' class='label'>Extra</label>
							<input id='HSiFSExtraCirno' type='text'>
						</td>
                    </tr><tr>
                        <td>CirnoSummer</td>
                        <td>
							<label for='HSiFSEasyCirnoSummer' class='label'>Easy</label>
							<input id='HSiFSEasyCirnoSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalCirnoSummer' class='label'>Normal</label>
							<input id='HSiFSNormalCirnoSummer' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardCirnoSummer' class='label'>Hard</label>
							<input id='HSiFSHardCirnoSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticCirnoSummer' class='label'>Lunatic</label>
							<input id='HSiFSLunaticCirnoSummer' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>CirnoAutumn</td>
                        <td>
							<label for='HSiFSEasyCirnoAutumn' class='label'>Easy</label>
							<input id='HSiFSEasyCirnoAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalCirnoAutumn' class='label'>Normal</label>
							<input id='HSiFSNormalCirnoAutumn' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardCirnoAutumn' class='label'>Hard</label>
							<input id='HSiFSHardCirnoAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticCirnoAutumn' class='label'>Lunatic</label>
							<input id='HSiFSLunaticCirnoAutumn' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>CirnoWinter</td>
                        <td>
							<label for='HSiFSEasyCirnoWinter' class='label'>Easy</label>
							<input id='HSiFSEasyCirnoWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalCirnoWinter' class='label'>Normal</label>
							<input id='HSiFSNormalCirnoWinter' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardCirnoWinter' class='label'>Hard</label>
							<input id='HSiFSHardCirnoWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticCirnoWinter' class='label'>Lunatic</label>
							<input id='HSiFSLunaticCirnoWinter' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>AyaSpring</td>
                        <td>
							<label for='HSiFSEasyAyaSpring' class='label'>Easy</label>
							<input id='HSiFSEasyAyaSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalAyaSpring' class='label'>Normal</label>
							<input id='HSiFSNormalAyaSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardAyaSpring' class='label'>Hard</label>
							<input id='HSiFSHardAyaSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticAyaSpring' class='label'>Lunatic</label>
							<input id='HSiFSLunaticAyaSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSExtraAya' class='label'>Extra</label>
							<input id='HSiFSExtraAya' type='text'>
						</td>
                    </tr><tr>
                        <td>AyaSummer</td>
                        <td>
							<label for='HSiFSEasyAyaSummer' class='label'>Easy</label>
							<input id='HSiFSEasyAyaSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalAyaSummer' class='label'>Normal</label>
							<input id='HSiFSNormalAyaSummer' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardAyaSummer' class='label'>Hard</label>
							<input id='HSiFSHardAyaSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticAyaSummer' class='label'>Lunatic</label>
							<input id='HSiFSLunaticAyaSummer' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>AyaAutumn</td>
                        <td>
							<label for='HSiFSEasyAyaAutumn' class='label'>Easy</label>
							<input id='HSiFSEasyAyaAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalAyaAutumn' class='label'>Normal</label>
							<input id='HSiFSNormalAyaAutumn' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardAyaAutumn' class='label'>Hard</label>
							<input id='HSiFSHardAyaAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticAyaAutumn' class='label'>Lunatic</label>
							<input id='HSiFSLunaticAyaAutumn' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>AyaWinter</td>
                        <td>
							<label for='HSiFSEasyAyaWinter' class='label'>Easy</label>
							<input id='HSiFSEasyAyaWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalAyaWinter' class='label'>Normal</label>
							<input id='HSiFSNormalAyaWinter' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardAyaWinter' class='label'>Hard</label>
							<input id='HSiFSHardAyaWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticAyaWinter' class='label'>Lunatic</label>
							<input id='HSiFSLunaticAyaWinter' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>MarisaSpring</td>
                        <td>
							<label for='HSiFSEasyMarisaSpring' class='label'>Easy</label>
							<input id='HSiFSEasyMarisaSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalMarisaSpring' class='label'>Normal</label>
							<input id='HSiFSNormalMarisaSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardMarisaSpring' class='label'>Hard</label>
							<input id='HSiFSHardMarisaSpring' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticMarisaSpring' class='label'>Lunatic</label>
							<input id='HSiFSLunaticMarisaSpring' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSExtraMarisa' class='label'>Extra</label>
							<input id='HSiFSExtraMarisa' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaSummer</td>
                        <td>
							<label for='HSiFSEasyMarisaSummer' class='label'>Easy</label>
							<input id='HSiFSEasyMarisaSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalMarisaSummer' class='label'>Normal</label>
							<input id='HSiFSNormalMarisaSummer' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardMarisaSummer' class='label'>Hard</label>
							<input id='HSiFSHardMarisaSummer' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticMarisaSummer' class='label'>Lunatic</label>
							<input id='HSiFSLunaticMarisaSummer' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>MarisaAutumn</td>
                        <td>
							<label for='HSiFSEasyMarisaAutumn' class='label'>Easy</label>
							<input id='HSiFSEasyMarisaAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalMarisaAutumn' class='label'>Normal</label>
							<input id='HSiFSNormalMarisaAutumn' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardMarisaAutumn' class='label'>Hard</label>
							<input id='HSiFSHardMarisaAutumn' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticMarisaAutumn' class='label'>Lunatic</label>
							<input id='HSiFSLunaticMarisaAutumn' type='text'>
						</td>
                        <td></td>
                    </tr><tr>
                        <td>MarisaWinter</td>
                        <td>
							<label for='HSiFSEasyMarisaWinter' class='label'>Easy</label>
							<input id='HSiFSEasyMarisaWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSNormalMarisaWinter' class='label'>Normal</label>
							<input id='HSiFSNormalMarisaWinter' type='text'>
						</td>
                        <td class='break'>
							<label for='HSiFSHardMarisaWinter' class='label'>Hard</label>
							<input id='HSiFSHardMarisaWinter' type='text'>
						</td>
                        <td>
							<label for='HSiFSLunaticMarisaWinter' class='label'>Lunatic</label>
							<input id='HSiFSLunaticMarisaWinter' type='text'>
						</td>
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
                        <td>
							<label for='WBaWCEasyReimuWolf' class='label'>Easy</label>
							<input id='WBaWCEasyReimuWolf' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalReimuWolf' class='label'>Normal</label>
							<input id='WBaWCNormalReimuWolf' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardReimuWolf' class='label'>Hard</label>
							<input id='WBaWCHardReimuWolf' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticReimuWolf' class='label'>Lunatic</label>
							<input id='WBaWCLunaticReimuWolf' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraReimuWolf' class='label'>Extra</label>
							<input id='WBaWCExtraReimuWolf' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuOtter</td>
                        <td>
							<label for='WBaWCEasyReimuOtter' class='label'>Easy</label>
							<input id='WBaWCEasyReimuOtter' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalReimuOtter' class='label'>Normal</label>
							<input id='WBaWCNormalReimuOtter' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardReimuOtter' class='label'>Hard</label>
							<input id='WBaWCHardReimuOtter' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticReimuOtter' class='label'>Lunatic</label>
							<input id='WBaWCLunaticReimuOtter' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraReimuOtter' class='label'>Extra</label>
							<input id='WBaWCExtraReimuOtter' type='text'>
						</td>
                    </tr><tr>
                        <td>ReimuEagle</td>
                        <td>
							<label for='WBaWCEasyReimuEagle' class='label'>Easy</label>
							<input id='WBaWCEasyReimuEagle' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalReimuEagle' class='label'>Normal</label>
							<input id='WBaWCNormalReimuEagle' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardReimuEagle' class='label'>Hard</label>
							<input id='WBaWCHardReimuEagle' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticReimuEagle' class='label'>Lunatic</label>
							<input id='WBaWCLunaticReimuEagle' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraReimuEagle' class='label'>Extra</label>
							<input id='WBaWCExtraReimuEagle' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaWolf</td>
                        <td>
							<label for='WBaWCEasyMarisaWolf' class='label'>Easy</label>
							<input id='WBaWCEasyMarisaWolf' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalMarisaWolf' class='label'>Normal</label>
							<input id='WBaWCNormalMarisaWolf' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardMarisaWolf' class='label'>Hard</label>
							<input id='WBaWCHardMarisaWolf' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticMarisaWolf' class='label'>Lunatic</label>
							<input id='WBaWCLunaticMarisaWolf' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraMarisaWolf' class='label'>Extra</label>
							<input id='WBaWCExtraMarisaWolf' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaOtter</td>
                        <td>
							<label for='WBaWCEasyMarisaOtter' class='label'>Easy</label>
							<input id='WBaWCEasyMarisaOtter' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalMarisaOtter' class='label'>Normal</label>
							<input id='WBaWCNormalMarisaOtter' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardMarisaOtter' class='label'>Hard</label>
							<input id='WBaWCHardMarisaOtter' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticMarisaOtter' class='label'>Lunatic</label>
							<input id='WBaWCLunaticMarisaOtter' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraMarisaOtter' class='label'>Extra</label>
							<input id='WBaWCExtraMarisaOtter' type='text'>
						</td>
                    </tr><tr>
                        <td>MarisaEagle</td>
                        <td>
							<label for='WBaWCEasyMarisaEagle' class='label'>Easy</label>
							<input id='WBaWCEasyMarisaEagle' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalMarisaEagle' class='label'>Normal</label>
							<input id='WBaWCNormalMarisaEagle' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardMarisaEagle' class='label'>Hard</label>
							<input id='WBaWCHardMarisaEagle' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticMarisaEagle' class='label'>Lunatic</label>
							<input id='WBaWCLunaticMarisaEagle' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraMarisaEagle' class='label'>Extra</label>
							<input id='WBaWCExtraMarisaEagle' type='text'>
						</td>
                    </tr><tr>
                        <td>YoumuWolf</td>
                        <td>
							<label for='WBaWCEasyYoumuWolf' class='label'>Easy</label>
							<input id='WBaWCEasyYoumuWolf' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalYoumuWolf' class='label'>Normal</label>
							<input id='WBaWCNormalYoumuWolf' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardYoumuWolf' class='label'>Hard</label>
							<input id='WBaWCHardYoumuWolf' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticYoumuWolf' class='label'>Lunatic</label>
							<input id='WBaWCLunaticYoumuWolf' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraYoumuWolf' class='label'>Extra</label>
							<input id='WBaWCExtraYoumuWolf' type='text'>
						</td>
                    </tr><tr>
                        <td>YoumuOtter</td>
                        <td>
							<label for='WBaWCEasyYoumuOtter' class='label'>Easy</label>
							<input id='WBaWCEasyYoumuOtter' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalYoumuOtter' class='label'>Normal</label>
							<input id='WBaWCNormalYoumuOtter' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardYoumuOtter' class='label'>Hard</label>
							<input id='WBaWCHardYoumuOtter' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticYoumuOtter' class='label'>Lunatic</label>
							<input id='WBaWCLunaticYoumuOtter' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraYoumuOtter' class='label'>Extra</label>
							<input id='WBaWCExtraYoumuOtter' type='text'>
						</td>
                    </tr><tr>
                        <td>YoumuEagle</td>
                        <td>
							<label for='WBaWCEasyYoumuEagle' class='label'>Easy</label>
							<input id='WBaWCEasyYoumuEagle' type='text'>
						</td>
                        <td>
							<label for='WBaWCNormalYoumuEagle' class='label'>Normal</label>
							<input id='WBaWCNormalYoumuEagle' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCHardYoumuEagle' class='label'>Hard</label>
							<input id='WBaWCHardYoumuEagle' type='text'>
						</td>
                        <td>
							<label for='WBaWCLunaticYoumuEagle' class='label'>Lunatic</label>
							<input id='WBaWCLunaticYoumuEagle' type='text'>
						</td>
                        <td class='break'>
							<label for='WBaWCExtraYoumuEagle' class='label'>Extra</label>
							<input id='WBaWCExtraYoumuEagle' type='text'>
						</td>
                    </tr>
                </table>
            </div>
			<div id='topList'></div>
            <p><label for='precision'>Number of decimals:</label> <input id='precision' type='number' value='0' min='0' max='5' step='1'></p>
            <p id='error'></p>
			<p><label for='toggleData'>Save Data</label><input id='toggleData' type='checkbox'></p>
			<p><input id='calc' type='button' value='Calculate'><input id='reset' type='button' value='Reset'></p>
			<h2 id='ack'>Acknowledgements</h2>
			<p id='credit'>The background image
			was drawn by <a href='https://www.pixiv.net/member.php?id=87950'>りすたる</a>.</p>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
		</div>
        <script src='assets/shared/dark.js'></script>
	</body>

</html>
