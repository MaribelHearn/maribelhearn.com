<!DOCTYPE html>
<html lang='en' class='no-js'>
<?php
    include '.stats/count.php';
    hit(basename(__FILE__));
    $json = file_get_contents('json/lnnlist.json');
    $lnn = json_decode($json, true);
    $lang = $_COOKIE['lang'];
    $pl = array();
    $pl_lnn = array();
    $flag = array();
    $gt = 0;
    function num($game) {
        switch ($game) {
            case 'SoEW': return '2';
            case 'PoDD': return '3';
            case 'LLS': return '4';
            case 'MS': return '5';
            case 'EoSD': return '6';
            case 'PCB': return '7';
            case 'IN': return '8';
            case 'MoF': return '10';
            case 'SA': return '11';
            case 'UFO': return '12';
            case 'GFW': return '12.8';
            case 'TD': return '13';
            case 'DDC': return '14';
            case 'LoLK': return '15';
            case 'HSiFS': return '16';
            case 'WBaWC': return '17';
            default: return '1';
        }
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
            case '"Japanese"': return '<span id="lm">' . date_tl($lm) . '</span>現在のLNN記録です。';
            case '"Chinese"': return 'LNN更新于<span id="lm">' . date_tl($lm) . '</span>。';
            default: return 'LNNs are current as of <span id="lm">' . $lm . '</span>.';
        }
    }
    foreach ($lnn as $game => $data1) {
        if (num($game) < 6 || $game == 'LM') {
            continue;
        }
        $sum = 0;
        $flag = array_fill(0, sizeof($flag), true);
        foreach ($lnn[$game] as $shottype => $data2) {
            $sum += sizeof($lnn[$game][$shottype]);
            foreach ($lnn[$game][$shottype] as $player => $data3) {
                if (!in_array($data3, $pl)) {
                    array_push($pl, $data3);
                    array_push($pl_lnn, array($data3, 1, 1));
                    array_push($flag, false);
                } else {
                    $key = array_search($data3, $pl);
                    $pl_lnn[$key][1] += 1;
                    if ($flag[$key]) {
                        $pl_lnn[$key][2] += 1;
                        $flag[$key] = false;
                    }
                }
            }
        }
        $gt += $sum;
    }
?>

	<head>
		<title>Touhou Lunatic No Miss No Bombs</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='List of Touhou Lunatic no miss no bomb (LNN) runs, clears that never die or bomb.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, lunatic, nmnb, lnn, lnns, no miss no bomb, no deaths no bombs'>
		<link rel='stylesheet' type='text/css' href='assets/lnn/lnn.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&display=swap'>
		<link rel='icon' type='image/x-icon' href='assets/lnn/lnn.ico'>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/lnn/lnn.js' defer></script>
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
			<table id='top' class='center noborders'>
				<tr class='noborders'>
					<td class='noborders' style='width:22%'></td>
					<td class='noborders' style='width:55%'><table id='languages' class='noborders'>
		                <tbody>
		                    <tr class='noborders'>
		                        <td class='noborders'>
		                            <a href='javascript:setLanguage("English")'><img src='assets/flags/uk.png' alt='Flag of the United Kingdom'></a>
		                        </td>
		                        <td class='noborders'>
		                            <a href='javascript:setLanguage("Japanese")'><img src='assets/flags/japan.png' alt='Flag of Japan'></a>
		                        </td>
		                        <td class='noborders'>
		                            <a href='javascript:setLanguage("Chinese")'><img src='assets/flags/china.png' alt='Flag of the P.R.C.'></a>
		                        </td>
		                    </tr>
		                    <tr class='noborders'>
		                        <td class='noborders'><a href='javascript:setLanguage("English")'>English</a></td>
		                        <td class='noborders'><a href='javascript:setLanguage("Japanese")'>日本語</a></td>
		                        <td class='noborders'><a href='javascript:setLanguage("Chinese")'>简体中文</a></td>
		                    </tr>
		                </tbody>
		            </table></td>
					<td class='noborders' style='width:22%;text-align:right;vertical-align:top'><img id='hy' src='assets/shared/h-bar.png' title='Human Mode' onClick='theme(this)'></td>
				</tr>
			</table>
			<h1>Touhou Lunatic No Miss No Bombs</h1>
            <noscript><strong>Notice:</strong> this page cannot function properly with JavaScript disabled.</noscript>
            <p id='description'>A list of Touhou Lunatic No Miss No Bomb (LNN) runs, updated every so often. For every shottype in a game,
			tables will tell you which players have done an LNN with it, if any.
            If a player has multiple LNNs for one particular shottype, those are not factored in.</p>
            <p id='conditions'>Extra conditions are required for PCB, TD, HSiFS and WBaWC; these are No Border Breaks for PCB, No Trance for TD,
			No Release for HSiFS and No Berserk Roar No Roar Breaks for WBaWC.
			LNN in these games is called LNNN or LNNNN, with extra Ns to denote the extra conditions.
            The extra condition in UFO, no UFO summons, is optional, as it is not considered to have a significant impact on the difficulty of the run.
            As for IN, an LNN is assumed to capture all Last Spells and is referred to as LNNFS.</p>
            <p id='tables'>All of the table columns are sortable.</p>
            <p id='lastupdate'><?php echo format_lm($lnn['LM'], $lang) ?></p>
            <h2 id='contents_header'>Contents</h2>
            <table id='contents'>
                <tr><td><a href='#lnns' class='lnns'>LNN Lists</a></td></tr>
                <tr><td><a href='#overall' class='overallcount'>Overall Count</a></td></tr>
                <tr><td><a href='#players' class='playerranking'>Player Ranking</a></td></tr>
				<tr><td><a href='#ack' class='ack'>Acknowledgements</a></td></tr>
            </table>
			<h2 id='lnns' class='lnns'>LNN Lists</h2>
			<p id='clickgame'>Click a game cover to show its list of LNNs.</p>
			<?php
			    foreach ($lnn as $game => $value) {
			        if ($game == 'LM') {
			            continue;
		            }
			        echo '<img id="' . $game . '" src="games/' . strtolower($game) . '50x50.jpg" alt="' . $game . ' cover" onClick="show(this.id)">';
			    }
			?>
            <div id='list'>
				<p id='fullname'></p>
				<table class='sortable'>
					<thead id='listhead'></thead>
                    <tbody id='listbody'></tbody>
                    <tfoot id='listfoot'></tfoot>
				</table>
			</div>
			<p id='playerlnns'>Choose a player name from the menu below to show their LNNs.</p>
			<label for='player' class='player'>Player</label>
			<select id='player' onChange='getPlayerLNNs(this.value)'>
			    <option>...</option>
			    <?php
			        asort($pl);
			        foreach ($pl as $key => $player) {
			            echo '<option>' . $player . '</option>';
			        }
			    ?>
		    </select>
			<div id='playerlist'>
				<table>
					<thead id='playerlisthead'><tr><th class='game'>Game</th><th class='shottype'>Shottype</th></tr></thead>
					<tbody id='playerlistbody'></tbody>
					<tfoot id='playerlistfoot'></tfoot>
				</table>
			</div>
            <div id='overall'>
                <h2 class='overallcount'>Overall Count</h2>
                <table class='sortable'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class='game'>Game</th>
                            <th id='autosort1' class='sorttable_numeric'><span class='nooflnns'>No. of LNNs</span></th>
                            <th id='autosort2' class='sorttable_numeric'><span class='differentn'>Different players</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($lnn as $game => $data1) {
                                if (num($game) < 6 || $game == 'LM') {
                                    continue;
                                }
                                echo '<tr><td>' . num($game) . '</td><td class="' . $game . '">' . $game . '</td>';
                                $sum = 0;
                                $game_pl = array();
                                foreach ($lnn[$game] as $shottype => $data2) {
                                    $sum += sizeof($lnn[$game][$shottype]);
                                    foreach ($lnn[$game][$shottype] as $player => $data3) {
                                        if (!in_array($data3, $game_pl)) {
                                            array_push($game_pl, $data3);
                                        }
                                    }
                                }
                                echo '<td>' . $sum . '</td><td>' . sizeof($game_pl) . '</td></tr>';
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr><td colspan='4'></td></tr>
                        <tr>
                            <td colspan='2' class='count'><span class='overall'>Overall</span></td>
                            <td class='count'><?php echo $gt ?></td>
                            <td class='count'><?php echo sizeof($pl_lnn) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div id='players'>
                <h2 class='playerranking'>Player Ranking</h2>
                <table id='ranking' class='sortable'>
                    <thead>
                        <tr>
                            <th class='player'>Player</th>
                            <th id='autosort1' class='sorttable_numeric'><span class='nooflnns'>No. of LNNs</span></th>
                            <th id='autosort2' class='sorttable_numeric'><span class='games'>Games LNNed</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            uasort($pl_lnn, function($a, $b) {
                                $val = $b[1] <=> $a[1];
                                if ($val == 0) {
                                    $val = $b[2] <=> $a[2];
                                }
                                return $val;
                            });
                            foreach ($pl_lnn as $key => $value) {
                                $game_lnns = $pl_lnn[$key][2] == 12 ? $pl_lnn[$key][2] . ' (All)' : $pl_lnn[$key][2];
                                echo '<tr><td>' . $pl_lnn[$key][0] . '</td><td>' . $pl_lnn[$key][1] . '</td><td>' . $game_lnns . '</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
			<div id='ack'>
            	<h2 class='ack'>Acknowledgements</h2>
	            <table class='noborders'>
					<tr class='noborders'>
						<td id='credit' class='noborders'>The background image
						was drawn by <a href='https://www.pixiv.net/member.php?id=1111435'>C.Z</a>.</td>
					</tr>
                    <tr class='noborders'>
                        <td id='jptlcredit' class='noborders'>The Japanese translation of
						the top text was done by <a href='https://twitter.com/toho_yumiya'>Yu-miya</a>.</td>
                    </tr>
                    <tr class='noborders'>
                        <td id='cntlcredit' class='noborders'>The Chinese translation of
						the top text was done by <a href='https://twitter.com/williewillus'>williewillus</a>.</td>
                    </tr>
	            </table>
			</div>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
		</div>
    </body>
</html>
