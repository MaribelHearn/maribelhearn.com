<!DOCTYPE html>
<html lang='en' class='no-js'>
<?php
    include '.stats/count.php';
    hit(basename(__FILE__));
    $json = file_get_contents('json/wrlist.json');
    $wr = json_decode($json, true);
    if (isset($_COOKIE['lang'])) {
		$lang = str_replace('"', '', $_COOKIE['lang']);
        $notation = str_replace('"', '', $_COOKIE['datenotation']);
	}
    if (empty($_GET['hl']) && !isset($_COOKIE['lang']) || $_GET['hl'] == 'en-gb') {
		$lang = 'English';
        $notation = 'DMY';
    } else if ($_GET['hl'] == 'en-us') {
        $lang = 'English';
        $notation = 'MDY';
    } else if ($_GET['hl'] == 'jp') {
		 $lang = 'Japanese';
         $notation = 'YMD';
	} else if ($_GET['hl'] == 'zh') {
		$lang = 'Chinese';
        $notation = 'YMD';
	}
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
    function date_tl($date, $notation) {
        $tmp = preg_split('/\//', $date);
        $day = $tmp[0];
        $month = $tmp[1];
        $year = $tmp[2];
        if ($notation == 'MDY') {
            return $month . '/' . $day . '/' . $year;
        } else if ($notation == 'YMD') {
            return $year . '年' . $month . '月' . $day . '日';
        } else { // DMY
            return $day . '/' . $month . '/' . $year;
        }
    }
    function format_lm($lm, $lang, $notation) {
        if ($lang == 'Japanese') {
            return '<span id="lm">' . date_tl($lm, 'YMD') . '</span>現在の世界記録です。';
        } else if ($lang == 'Chinese') {
            return '世界记录更新于<span id="lm">' . date_tl($lm, 'YMD') . '</span>。';
        } else if ($lang == 'English') {
            if ($notation == 'DMY') {
                return 'World records are current as of <span id="lm">' . $lm . '</span>.';
            } else {
                return 'World records are current as of <span id="lm">' . date_tl($lm, 'MDY') . '</span>.';
            }
        }
    }
    function tl_term($term, $lang) {
        if ($lang == 'Japanese') {
	        $term = trim($term);
			switch ($term) {
				case 'Game': return 'ゲーム';
				case 'Score': return 'スコア';
                case 'Player': return 'プレイヤー';
				case 'Difficulty': return '難易度';
                case 'Shottype': return 'キャラ';
                case 'Seasons': return '季節';
				case 'Date': return '日付';
				case 'Dates': return '日付';
				case 'No. of WRs': return 'WR数';
				case 'Different games': return 'ゲーム';
				case 'Overall': return '合計';
				case 'Overall Records': return '各作品世界記録一覧';
                case 'World Records': return '世界記録';
                case 'Player Ranking': return 'プレイヤーのランキング';
                case 'Acknowledgements': return '謝辞';
                case 'Touhou World Records': return '東方の世界記録';
				case 'Back to Top': return '上に帰る';
	            default: return $term;
	        }
		} else if ($lang == 'Chinese') {
	        $term = trim($term);
			switch ($term) {
				case 'Game': return '游戏';
				case 'Score': return '分数';
                case 'Player': return '玩家';
				case 'Difficulty': return '难度';
                case 'Shottype': return '机体';
                case 'Seasons': return '季节';
				case 'Date': return '日期';
				case 'Dates': return '日期';
				case 'No. of WRs': return 'WR数量';
				case 'Different games': return '游戏';
				case 'Overall': return '合計';
				case 'Overall Records': return '整体世界纪录';
                case 'World Records': return '世界纪录';
                case 'Player Ranking': return '玩家排行';
                case 'Acknowledgements': return '致谢';
                case 'Touhou World Records': return '东方世界纪录';
				case 'Back to Top': return '回到顶部';
	            default: return $term;
	        }
		} else {
			return $term;
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
		<title><?php echo tl_term('Touhou World Records', $lang); ?></title>
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
        <script src='assets/shared/dark.js'></script>
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
					<td id='emptytd' class='noborders'></td>
					<td id='languagestd' class='noborders'> <table id='languages' class='noborders'>
		                <tbody>
                            <tr class='noborders'>
		                        <td class='noborders'>
                                    <a class='en-gb' href='wr?hl=en-gb'><img src='assets/flags/uk.png' alt='<?php
										if ($lang == 'English') { echo 'Flag of the United Kingdom'; }
										else if ($lang == 'Japanese') { echo 'イギリスの国旗'; }
										else { echo '英国旗'; }
									?>'></a>
		                        </td>
    		                        <td class='noborders'>
                                        <a class='en-us' href='wr?hl=en-us'><img src='assets/flags/us.png' alt='<?php
    										if ($lang == 'English') { echo 'Flag of the United States'; }
    										else if ($lang == 'Japanese') { echo 'アメリカ合衆国の国旗'; }
    										else { echo '美国旗'; }
    									?>'></a>
    		                        </td>
		                        <td class='noborders'>
                                    <a class='jp' href='wr?hl=jp'><img src='assets/flags/japan.png' alt='<?php
										if ($lang == 'English') { echo 'Flag of Japan'; }
										else if ($lang == 'Japanese') { echo '日本の国旗'; }
										else { echo '日本旗'; }
									?>'></a>
		                        </td>
		                        <td class='noborders'>
                                    <a class='zh' href='wr?hl=zh'><img src='assets/flags/china.png' alt='<?php
										if ($lang == 'English') { echo 'Flag of the P.R.C.'; }
										else if ($lang == 'Japanese') { echo '中華人民共和国の国旗'; }
										else { echo '中国旗'; }
									?>'></a>
		                        </td>
		                    </tr>
		                    <tr class='noborders'>
		                        <td class='noborders'><a class='en-gb' href='wr?hl=en-gb'>English (UK)</a></td>
		                        <td class='noborders'><a class='en-us' href='wr?hl=en-us'>English (US)</a></td>
		                        <td class='noborders'><a class='jp' href='wr?hl=jp'>日本語</a></td>
		                        <td class='noborders'><a class='zh' href='wr?hl=zh'>简体中文</a></td>
		                    </tr>
		                </tbody>
		            </table></td>
					<td id='bartd' class='noborders'>
                        <img id='hy' src='assets/shared/h-bar.png' title='Human Mode' onClick='theme(this)' onLoad='ready()'>
                    </td>
				</tr>
			</table>
			<h1><?php echo tl_term('Touhou World Records', $lang); ?></h1>
            <?php
                if (!empty($_GET['redirect'])) {
                    echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
                }
            ?>
            <p id='description'><?php
                if ($lang == 'English') {
                    echo 'An accurate list of Touhou world records, updated every so often. ' .
                    'Note that the player ranking at the bottom does not take into account how strong specific records are, '.
                    'only numbers. The list does not include scene games as of now.';
                } else if ($lang == 'Japanese') {
                    echo '東方原作STG各作品世界記録の正確なリストです。適宜頻繁に更新します。' .
                    '下部に記載されているプレイヤーランキングは特定のスコアの高低を示すものではなく、あくまで世' .
                    '界記録取得数を示したものですのでご留意ください。また今のところ文花帖のようなシーンを基準にするリストは作成しておりません。';
                } else {
                    echo '这个网页准确地记载所有「东方Project」的打分世界记录，时不时地更新。注意：页底的玩家排行榜只算玩家们得到的记录有多少，' .
                    '并不算记录的强度。目前数据并不包括摄影游戏。';
                }
            ?></p>
            <p id='clicktodl'><?php
                if ($lang == 'English') {
                    echo 'Click a score to download the corresponding replay, if there is one available. ' .
                    'All of the table columns are sortable.';
                } else if ($lang == 'Japanese') {
                    echo '該当のリプレイファイルをダウンロードするにはスコアをクリックしてください。' .
                    '各欄は並べ替え可能となっています。並べ替えには各表の最上段をクリックしてください。';
                } else {
                    echo '点击任何分数即可下载对应的rep。点击任何标题即可排序表格内容。';
                }
            ?></p>
            <p id='noreup'><?php
                if ($lang == 'English') {
                    echo 'The replays provided are <strong>not</strong> meant to be reuploaded to any replay uploading services.';
                } else if ($lang == 'Japanese') {
                    echo 'リプレイファイルの二次利用は禁止致します。';
                } else {
                    echo '请勿将rep上传到别的存rep网站。';
                }
            ?></p>
            <p id='lastupdate'><?php echo format_lm($lm, $lang, $notation) ?></p>
            <h2 id='contents_header'><?php
				if ($lang == 'English') { echo 'Contents'; }
				else if ($lang == 'Japanese') { echo '内容'; }
				else { echo '内容'; }
			?></h2>
            <table id='contents'>
				<tr id='overall_link'><td><a href='#overall' class='overallrecords'>
                    <?php echo tl_term('Overall Records', $lang); ?>
                </a></td></tr>
				<tr id='overall_linkm'><td><a href='#overallm' class='overallrecords'>
                    <?php echo tl_term('Overall Records', $lang); ?>
                </a></td></tr>
				<tr><td><a href='#wrs' class='worldrecords'><?php echo tl_term('World Records', $lang); ?></a></td></tr>
                <tr><td><a href='#players' class='playerranking'><?php echo tl_term('Player Ranking', $lang); ?></a></td></tr>
				<tr><td><a href='#ack' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></a></td></tr>
            </table>
            <table id='checkboxes'>
                <tr class='noborders'><td class='noborders'>
                    <input id='dates' type='checkbox' onClick='toggleDates()'>
			        <label id='label_dates' for='dates' class='dates'>Dates</label>
                </td></tr>
            </table>
            <div id='overall'>
                <h2 class='overallrecords'><?php echo tl_term('Overall Records', $lang); ?></h2>
                <table class='sortable'>
                    <tr>
                        <th>#</th>
                        <th class='game'><?php echo tl_term('Game', $lang); ?></th>
                        <th id='score' class='sorttable_numeric'><?php echo tl_term('Score', $lang); ?></th>
                        <th class='player'><?php echo tl_term('Player', $lang); ?></th>
                        <th class='difficulty'><?php echo tl_term('Difficulty', $lang); ?></th>
                        <th class='shottype'><?php echo tl_term('Shottype', $lang); ?></th>
                        <th class='date'><?php echo tl_term('Date', $lang); ?></th>
                    </tr>
                    <?php
						foreach ($wr as $game => $value) {
							$num = num($game);
							echo '<tr id="' . $game . 'o"><td>' . $num . '</td><td class="' . $game . '">' . $game . '</td>';
							echo '<td id="' . $game . 'overall0">' . number_format($overall[$num], 0, '.', ',') . '</td>';
							echo '<td id="' . $game . 'overall1">' . $overall_player[$num] . '</td>';
							echo '<td id="' . $game . 'overall2">' . $overall_diff[$num] . '</td>';
							echo '<td id="' . $game . 'overall3">' . $overall_shottype[$num] . '</td>';
							echo '<td id="' . $game . 'overall4" class="datestring">' . date_tl($overall_date[$num], $notation) . '</td></tr>';
						}
					?>
                </table>
            </div>
            <div id='overallm'>
                <h2 class='overallrecords'><?php echo tl_term('Overall Records', $lang); ?></h2>
				<?php
                    echo '<hr>';
					foreach ($wr as $game => $value) {
						$num = num($game);
						echo '<p class="' . $game . ' count">' . $game . '</p><p>';
						echo '<span id="' . $game . 'overall0m">' . number_format($overall[$num], 0, '.', ',') . '</span> ';
						echo '<span id="' . $game . 'overall2m">' . $overall_diff[$num] . '</span> ';
						echo '<span id="' . $game . 'overall3m">' . $overall_shottype[$num] . '</span> by ';
						echo '<span id="' . $game . 'overall1m"><em>' . $overall_player[$num] . '</em></span> ';
						echo '<br><span id="' . $game . 'overall4m" class="datestring">' . date_tl($overall_date[$num], $notation) . '</span></p><hr>';
					}
				?>
            </div>
            <h2 id='wrs' class='worldrecords'><?php echo tl_term('World Records', $lang); ?></h2>
			<p id='clickgame'><?php
            if ($lang == 'English') {
                echo 'Click a game cover to show its list of world records.';
            } else if ($lang == 'Japanese') {
                echo '世界記録リストはゲームをクリック。';
            } else {
                echo '单击游戏处查看世界纪录列表。';
            }
            ?></p>
			<?php
			    foreach ($wr as $game => $value) {
			        echo '<img id="' . $game . '" src="games/' . strtolower($game) . '50x50.jpg" alt="' . $game . ' cover" onClick="display(this.id)">';
			    }
			?>
			<noscript><?php
				if ($lang == 'English') {
					echo '<p><em>Sorry, you cannot show the game world records with JavaScript disabled as of now.</em></p>';
				} else if ($lang == 'Japanese') {
					echo '<p>JavaScriptなしではWRを示すできません。</p>';
				} else {
					echo '<p>不好意思，目前查看世界纪录必须开启JavaScript。</p>';
				}
			?></noscript>
			<div id='list'>
				<p id='fullname'></p>
				<p id='seasontoggle'>
					<input id='seasons' type='checkbox' onClick='toggleSeasons()'>
					<label id='label_seasons' for='seasons'><?php echo tl_term('Seasons', $lang); ?></label>
				</p>
				<table id='table' class='sortable'>
					<thead id='list_thead'></thead>
                    <tbody id='list_tbody'></tbody>
				</table>
				<p id='cheat'><?php
                    if ($lang == 'English') {
                        echo '* This record is suspected of cheating. If it is found to have been cheated, ' .
                        'the record will be 2,209,324,900 by ななまる.';
                    } else if ($lang == 'Japanese') {
                        echo 'このスコアはチートの疑いがあります。不正が証明された場合、世界記録はななまるさんによる22.09億のスコアとなります。';
                    } else {
                        echo '* 这rep怀疑有作弊。若真有此事，世界纪录则归于ななまる，得分2,209,324,900。';
                    }
                ?></p>
                <table>
                    <thead id='west_thead'></thead>
                    <tbody id='west_tbody'></tbody>
                </table>
			</div>
            <div id='players'>
                <h2 class='playerranking'><?php echo tl_term('Player Ranking', $lang); ?></h2>
                <table id='ranking' class='sortable'>
                    <thead>
                        <tr>
                            <th class='player'><?php echo tl_term('Player', $lang); ?></th>
                            <th id='autosort' class='sorttable_numeric'><?php echo tl_term('No. of WRs', $lang); ?></th>
                            <th id='differentgames'><?php echo tl_term('Different games', $lang); ?></th>
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
            <h2 id='ack' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></h2>
            <table id='acks' class='noborders'>
                <tbody>
					<tr class='noborders'>
						<td id='credit' class='noborders'><?php
                            if ($lang == 'English') {
                                echo 'The background image was drawn by ' .
                                '<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>.';
                            } else if ($lang == 'Japanese') {
                                echo '背景イメージは<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">' .
                                'Catboyjeremie</a>さんのものを使用させていただいております。';
                            } else {
                                echo '背景画师：<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>。';
                            }
                        ?></td>
					</tr>
                    <tr class='noborders'>
                        <td id='jptlcredit' class='noborders'><?php
                            if ($lang == 'English') {
                                echo 'The Japanese translation of the top text was done by ' .
                                '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                            } else if ($lang == 'Japanese') {
                                echo 'ページ上部のテキストは<a href="https://twitter.com/toho_yumiya">Yu-miya</a>' .
                                'によって日本語に翻訳されました。';
                            } else {
                                echo '感谢<a href="https://twitter.com/toho_yumiya">Yu-miya</a>提供头部文字的日语翻译。';
                            }
                        ?></td>
                    </tr>
                    <tr class='noborders'>
                        <td id='cntlcredit' class='noborders'><?php
                            if ($lang == 'English') {
                                echo 'The Chinese translation of the top text was done by ' .
                                '<a href="https://twitter.com/williewillus">williewillus</a>.';
                            } else if ($lang == 'Japanese') {
                                echo 'ページ上部のテキストは<a href="https://twitter.com/williewillus">williewillus</a>' .
                                'によって中国語に翻訳されました。';
                            } else {
                                echo '感谢<a href="https://twitter.com/williewillus">williewillus</a>提供头部文字的中文翻译。';
                            }
                        ?></td>
                    </tr>
                </tbody>
            </table>
            <p id='back'><strong><a id='backtotop' href='#nav'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
			<?php echo '<input id="missingReplays" type="hidden" value="' . implode($missing_replays, '') . '">'; ?>
		</div>
    </body>
</html>
