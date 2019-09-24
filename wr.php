<!DOCTYPE html>
<html lang='en' class='no-js'>
<?php
    $json = file_get_contents('json/wrlist.json');
    $wr = json_decode($json, true);
    $lang = $_COOKIE['lang'];
	$overall = array(0);
	$overall_player = array(0);
	$overall_diff = array(0);
	$overall_shottype = array(0);
	$overall_date = array(0);
	$missing_replays = array();
    $pl = array();
	$pl_wr = array();
	$flag = array();
	$lm = '0/0/0';
    function num($game) {
        switch ($game) {
			case 'HRtP': return 1;
            case 'SoEW': return 2;
            case 'PoDD': return 3;
            case 'LLS': return 4;
            case 'MS': return 5;
            case 'EoSD': return 6;
            case 'PCB': return 7;
            case 'IN': return 8;
            case 'PoFV': return 9;
            case 'MoF': return 10;
            case 'SA': return 11;
            case 'UFO': return 12;
            case 'GFW': return 128;
            case 'TD': return 13;
            case 'DDC': return 14;
            case 'LoLK': return 15;
            case 'HSiFS': return 16;
            case 'WBaWC': return 17;
            default: return 0;
        }
    }
	function shot_abbr($shot) {
	    switch ($shot) {
	        case 'Reimu': return 'Re';
	        case 'ReimuA': return 'RA';
	        case 'ReimuB': return 'RB';
	        case 'ReimuC': return 'RC';
	        case 'Marisa': return 'Ma';
	        case 'MarisaA': return 'MA';
	        case 'MarisaB': return 'MB';
	        case 'MarisaC': return 'MC';
	        case 'Sakuya': return 'Sa';
	        case 'SakuyaA': return 'SA';
	        case 'SakuyaB': return 'SB';
	        case 'Sanae': return 'Sa';
	        case 'SanaeA': return 'SA';
	        case 'SanaeB': return 'SB';
	        case 'BorderTeam': return 'BT';
	        case 'MagicTeam': return 'MT';
	        case 'ScarletTeam': return 'ST';
	        case 'GhostTeam': return 'GT';
	        case 'Yukari': return 'Yu';
	        case 'Alice': return 'Al';
	        case 'Remilia': return 'Rr';
	        case 'Youmu': return 'Yo';
	        case 'Yuyuko': return 'Yy';
	        case 'Reisen': return 'Ud';
	        case 'Cirno': return 'Ci';
	        case 'Lyrica': return 'Ly';
	        case 'Mystia': return 'My';
	        case 'Tewi': return 'Te';
	        case 'Aya': return 'Ay';
	        case 'Medicine': return 'Me';
	        case 'Yuuka': return 'Yu';
	        case 'Komachi': return 'Ko';
	        case 'Eiki': return 'Ei';
	        case 'A1': return 'A1';
	        case 'A2': return 'A2';
	        case 'B1': return 'B1';
	        case 'B2': return 'B2';
	        case 'C1': return 'C1';
	        case 'C2': return 'C2';
	        case '-': return 'tr';
	        case 'ReimuSpring': return 'RS';
	        case 'ReimuSummer': return 'RU';
	        case 'ReimuAutumn': return 'RA';
	        case 'ReimuWinter': return 'RW';
	        case 'CirnoSpring': return 'CS';
	        case 'CirnoSummer': return 'CU';
	        case 'CirnoAutumn': return 'CA';
	        case 'CirnoWinter': return 'CW';
	        case 'AyaSpring': return 'AS';
	        case 'AyaSummer': return 'AU';
	        case 'AyaAutumn': return 'AA';
	        case 'AyaWinter': return 'AW';
	        case 'MarisaSpring': return 'MS';
	        case 'MarisaSummer': return 'MU';
	        case 'MarisaAutumn': return 'MA';
	        case 'MarisaWinter': return 'MW';
	        case 'ReimuWolf': return 'RW';
	        case 'ReimuOtter': return 'RO';
	        case 'ReimuEagle': return 'RE';
	        case 'MarisaWolf': return 'MW';
	        case 'MarisaOtter': return 'MO';
	        case 'MarisaEagle': return 'ME';
	        case 'YoumuWolf': return 'YW';
	        case 'YoumuOtter': return 'YO';
	        case 'YoumuEagle': return 'YE';
			default: return '';
	    }
	}
	function replay_path($game, $diff, $shot) {
	    return 'replays/th' . num($game) . '_ud' . substr($diff, 0, 2) . shot_abbr($shot) . '.rpy';
	}
    function date_tl($date) {
        $tmp = preg_split('/\//', $date);
        $day = $tmp[0];
        $month = $tmp[1];
        $year = $tmp[2];
        return $year . '年' . $month . '月' . $day . '日';
    }
    function format_lm($lm, $lang) {
        switch ($lang) {
            case '"Japanese"': return '<span id="lm">' . date_tl($lm) . '</span>現在の世界記録です。';
            case '"Chinese"': return '世界记录更新于<span id="lm">' . date_tl($lm) . '</span>。';
            default: return 'World records are current as of <span id="lm">' . $lm . '</span>.';
        }
    }
	foreach ($wr as $game => $value) {
		$num = num($game);
		$overall[$num] = 0;
        $flag = array_fill(0, sizeof($flag), true);
		foreach ($wr[$game] as $diff => $value) {
			foreach ($wr[$game][$diff] as $shot => $array) {
				if ($array[0] > $overall[$num]) {
					$overall[$num] = $array[0];
					$overall_diff[$num] = $diff;
					$overall_shottype[$num] = $shot;
					$overall_player[$num] = $array[1];
					$overall_date[$num] = $array[2];
				}
				if (!file_exists(replay_path($game, $diff, $shot)) && $num > 5) {
					array_push($missing_replays, ($game . $diff . $shot));
				}
				if (!in_array($array[1], $pl)) {
                    array_push($pl, $array[1]);
                    array_push($pl_wr, array($array[1], 1, 1));
                    array_push($flag, false);
                } else {
                    $key = array_search($array[1], $pl);
                    $pl_wr[$key][1] += 1;
                    if ($flag[$key]) {
                        $pl_wr[$key][2] += 1;
                        $flag[$key] = false;
                    }
                }
				$date = preg_split('/\//', $array[2]);
				$tmp = preg_split('/\//', $lm);
				$year = $date[2]; $month = $date[1]; $day = $date[0];
				if ($year > $tmp[2] || $year == $tmp[2] && $month > $tmp[1] || $year == $tmp[2] && $month == $tmp[1] && $day > $tmp[0]) {
					$lm = $array[2];
				}
			}
		}
	}
?>

	<head>
		<title>Touhou World Records</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='List of Touhou shooting game world records.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, wr, wrs, world record, world records, scores, high scores, scoring'>
		<link rel='stylesheet' type='text/css' href='assets/wr/wr.css'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&display=swap'>
		<link rel='icon' type='image/x-icon' href='assets/wr/wr.ico'>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/wr/wr.js' defer></script>
		<script src='assets/shared/sorttable.js' defer></script>
        <script src='assets/shared/modernizr-custom.js' defer></script>
        <script>document.documentElement.classList.remove("no-js");</script>
	</head>

	<body onResize='updateOrientation()'>
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
			<table id='top' class='center noborders'>
				<tr class='noborders'>
					<td id='emptytd' class='noborders' style='width:22%'></td>
					<td id='languagestd' class='noborders' style='width:55%'> <table id='languages' class='noborders'>
		                <tbody>
		                    <tr class='noborders'>
		                        <td class='noborders'>
		                            <a href='javascript:setLanguage("English", "DMY")'><img src='assets/flags/uk.png' alt='Flag of the United Kingdom'></a>
		                        </td>
		                        <td class='noborders'>
		                            <a href='javascript:setLanguage("English", "MDY")'><img src='assets/flags/us.png' alt='Flag of the United States'></a>
		                        </td>
		                        <td class='noborders'>
		                            <a href='javascript:setLanguage("Japanese", "YMD")'><img src='assets/flags/japan.png' alt='Flag of Japan'></a>
		                        </td>
		                        <td class='noborders'>
		                            <a href='javascript:setLanguage("Chinese", "YMD")'><img src='assets/flags/china.png' alt='Flag of the P.R.C.'></a>
		                        </td>
		                    </tr>
		                    <tr class='noborders'>
		                        <td class='noborders'><a href='javascript:setLanguage("English", "DMY")'>UK English</a></td>
		                        <td class='noborders'><a href='javascript:setLanguage("English", "MDY")'>US English</a></td>
		                        <td class='noborders'><a href='javascript:setLanguage("Japanese", "YMD")'>日本語</a></td>
		                        <td class='noborders'><a href='javascript:setLanguage("Chinese", "YMD")'>简体中文</a></td>
		                    </tr>
		                </tbody>
		            </table></td>
					<td class='noborders' style='width:22%;text-align:right;vertical-align:top'><img id='hy' src='assets/shared/h-bar.png' title='Human Mode' onClick='theme(this)'></td>
				</tr>
			</table>
			<h1>Touhou World Records</h1>
            <noscript><strong>Notice:</strong> this page cannot function properly with JavaScript disabled.</noscript>
            <p id='description'>An accurate list of Touhou world records, updated every so often. Note that the player ranking at the bottom does not take into account
			how strong specific records are, only numbers. The list does not include scene games as of now.</p>
            <p id='clicktodl'>Click a score to download the corresponding replay, if there is one available. All of the table columns are sortable.</p>
            <p id='noreup'>The replays provided are <strong>not</strong> meant to be reuploaded to any replay uploading services.</p>
            <p id='lastupdate'><?php echo format_lm($lm, $lang) ?></p>
            <h2 id='contents_header'>Contents</h2>
            <table id='contents'>
				<tr id='overall_link'><td><a href='#overall' class='overallrecords'>Overall Records</a></td></tr>
				<tr id='overall_linkm'><td><a href='#overallm' class='overallrecords'>Overall Records</a></td></tr>
				<tr><td><a href='#wrs' class='worldrecords'>World Records</a></td></tr>
                <tr><td><a href='#players' class='playerranking'>Player Ranking</a></td></tr>
                <tr><td><a href='#ack' class='ack'>Acknowledgements</a></td></tr>
            </table>
            <table id='checkboxes'><tr class='noborders'><td class='noborders'><input id='dates' type='checkbox' onClick='toggleDates()'>
			<label id='label_dates' for='dates' class='dates'>Dates</label></td></tr></table>
            <div id='overall'>
                <h2 class='overallrecords'>Overall Records</h2>
                <table class='sortable'>
                    <tr>
                        <th>#</th>
                        <th class='game'>Game</th>
                        <th id='score' class='sorttable_numeric'>Score</th>
                        <th class='player'>Player</th>
                        <th class='difficulty'>Difficulty</th>
                        <th class='shottype'>Shottype</th>
                        <th class='date'>Date</th>
                    </tr>
                    <?php
						foreach ($wr as $game => $value) {
							$num = num($game);
							echo '<tr id="' . $game . 'o"><td>' . $num . '</td><td class="' . $game . '">' . $game . '</td>';
							echo '<td id="' . $game . 'overall0">' . number_format($overall[$num], 0, '.', ',') . '</td>';
							echo '<td id="' . $game . 'overall1">' . $overall_player[$num] . '</td>';
							echo '<td id="' . $game . 'overall2">' . $overall_diff[$num] . '</td>';
							echo '<td id="' . $game . 'overall3">' . $overall_shottype[$num] . '</td>';
							echo '<td id="' . $game . 'overall4" class="datestring">' . $overall_date[$num] . '</td></tr>';
						}
					?>
                </table>
            </div>
            <div id='overallm'>
                <h2 class='overallrecords'>Overall Records</h2>
				<?php
                    echo '<hr>';
					foreach ($wr as $game => $value) {
						$num = num($game);
						echo '<p class="' . $game . ' count">' . $game . '</p><p>';
						echo '<span id="' . $game . 'overall0m">' . number_format($overall[$num], 0, '.', ',') . '</span> ';
						echo '<span id="' . $game . 'overall2m">' . $overall_diff[$num] . '</span> ';
						echo '<span id="' . $game . 'overall3m">' . $overall_shottype[$num] . '</span> by ';
						echo '<span id="' . $game . 'overall1m"><em>' . $overall_player[$num] . '</em></span> ';
						echo '<br><span id="' . $game . 'overall4m" class="datestring">' . $overall_date[$num] . '</span></p><hr>';
					}
				?>
            </div>
            <h2 id='wrs' class='worldrecords'>World Records</h2>
			<p id='clickgame'>Click a game cover to show its list of world records.</p>
			<?php
			    foreach ($wr as $game => $value) {
			        echo '<img id="' . $game . '" src="games/' . strtolower($game) . '50x50.jpg" alt="' . $game . ' cover" onClick="display(this.id)">';
			    }
			?>
			<div id='list'>
				<p id='fullname'></p>
				<p id='seasontoggle'>
					<input id='seasons' type='checkbox' onClick='toggleSeasons()'>
					<label id='label_seasons' for='seasons'>Seasons</label>
				</p>
				<table id='table' class='sortable'>
					<thead id='list_thead'></thead>
                    <tbody id='list_tbody'></tbody>
				</table>
				<p id='cheat'>* This record is suspected of cheating. If it is found to have been cheated, the record will be 2,209,324,900 by ななまる.</p>
                <table>
                    <thead id='west_thead'></thead>
                    <tbody id='west_tbody'></tbody>
                </table>
			</div>
            <div id='players'>
                <h2 class='playerranking'>Player Ranking</h2>
                <table id='ranking' class='sortable'>
                    <thead>
                        <tr>
                            <th class='player'>Player</th>
                            <th id='autosort' class='sorttable_numeric'>No. of WRs</th>
                            <th id='differentgames'>Different games</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
                            uasort($pl_wr, function($a, $b) {
                                $val = $b[1] <=> $a[1];
                                if ($val == 0) {
                                    $val = $b[2] <=> $a[2];
                                }
                                return $val;
                            });
							foreach ($pl_wr as $key => $value) {
								if ($pl[$key] === '') {
									continue;
								}
								echo '<tr id="' . $pl_wr[$key][0] . '"><td>' . $pl_wr[$key][0] . '</td>';
								echo '<td id="' . $pl_wr[$key][0] . 'n">' . $pl_wr[$key][1] . '</td>';
                                echo '<td id="' . $pl_wr[$key][0] . 'g">' . $pl_wr[$key][2] . '</td></tr>';
							}
						?>
					</tbody>
                </table>
            </div>
            <h2 id='ack' class='ack'>Acknowledgements</h2>
            <table id='acks' class='noborders'>
                <tbody>
					<tr class='noborders'>
						<td id='credit' class='noborders'>The background image was drawn by <a href='https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ'>Catboyjeremie</a>.</td>
					</tr>
                    <tr class='noborders'>
                        <td id='jptlcredit' class='noborders'>The Japanese translation of the top text was done by <a href='https://twitter.com/toho_yumiya'>Yu-miya</a>.</td>
                    </tr>
                    <tr class='noborders'>
                        <td id='cntlcredit' class='noborders'>The Chinese translation of the top text was done by <a href='https://twitter.com/williewillus'>williewillus</a>.</td>
                    </tr>
                </tbody>
            </table>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
			<?php echo '<input id="missingReplays" type="hidden" value="' . implode($missing_replays, '') . '">'; ?>
		</div>
		<!-- Default Statcounter code for Maribel Hearn's Web Portal
		http://maribelhearn.com -->
		<script>
		var sc_project=12065202;
		var sc_invisible=1;
		var sc_security="a3a19e1b";
		</script>
		<script
		src="https://www.statcounter.com/counter/counter.js"
		async></script>
		<noscript><div class="statcounter"><a title="Web Analytics"
		href="https://statcounter.com/" target="_blank"><img
		class="statcounter"
		src="https://c.statcounter.com/12065202/0/a3a19e1b/1/"
		alt="Web Analytics"></a></div></noscript>
		<!-- End of Statcounter Code -->
    </body>
</html>
