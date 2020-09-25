<!DOCTYPE html>
<html id='top' lang='en'>
<?php
    include '.stats/count.php';
    include 'assets/shared/tl.php';
    hit(basename(__FILE__));
    $MAX_SCORE = 9999999990;
    $json = file_get_contents('json/wrlist.json');
    $wr = json_decode($json, true);
    $json = file_get_contents('json/bestinthewest.json');
    $west = json_decode($json, true);
    $json = file_get_contents('json/counterstops.json');
    $cs = json_decode($json, true);
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
    $layout = (isset($_COOKIE['wr_old_layout']) ? 'Old' : 'New');
	$overall = array(0);
	$overall_player = array(0);
	$overall_diff = array(0);
	$overall_shottype = array(0);
	$overall_date = array(0);
	$missing_replays = array();
    $diff_max = array();
    $pl = array();
	$pl_wr = array();
	$flag = array();
	$lm = '0/0/0';
    function pc_class($pc) {
        if ($pc < 50) {
            return 'does_not_even_score';
        } else if ($pc < 75) {
            return 'barely_even_scores';
        } else if ($pc < 90) {
            return 'moderately_even_scores';
        } else if ($pc < 100) {
            return 'does_even_score';
        } else {
            return 'does_even_score_well';
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
    function game_tl($game, $lang) {
        if ($lang == 'Japanese') {
            switch ($game) {
    			case 'HRtP': return '靈';
                case 'SoEW': return '封';
                case 'PoDD': return '夢';
                case 'LLS': return '幻';
                case 'MS': return '怪';
                case 'EoSD': return '紅';
                case 'PCB': return '妖';
                case 'IN': return '永';
                case 'PoFV': return '花';
                case 'MoF': return '風';
                case 'SA': return '地';
                case 'UFO': return '星';
                case 'GFW': return '大';
                case 'TD': return '神';
                case 'DDC': return '輝';
                case 'LoLK': return '紺';
                case 'HSiFS': return '天';
                case 'WBaWC': return '鬼';
                default: return $game;
            }
        } else if ($lang == 'Chinese') {
            switch ($game) {
    			case 'HRtP': return '灵';
                case 'SoEW': return '封';
                case 'PoDD': return '梦';
                case 'LLS': return '幻';
                case 'MS': return '怪';
                case 'EoSD': return '红';
                case 'PCB': return '妖';
                case 'IN': return '永';
                case 'PoFV': return '花';
                case 'MoF': return '风';
                case 'SA': return '地';
                case 'UFO': return '星';
                case 'GFW': return '大';
                case 'TD': return '神';
                case 'DDC': return '辉';
                case 'LoLK': return '绀';
                case 'HSiFS': return '天';
                case 'WBaWC': return '鬼';
                default: return $game;
            }
        }
        return $game;
    }
    function player_search($lang) {
        if ($lang == 'English') {
            return 'Player Search';
        } else if ($lang == 'Japanese') {
            return '個人のWR';
        } else {
            return '玩家WR';
        }
    }
	foreach ($wr as $game => $value) {
		$num = num($game);
		$overall[$num] = 0;
        $flag = array_fill(0, sizeof($flag), true);
        $diff_max[$game] = array();
		foreach ($wr[$game] as $diff => $value) {
            $diff_max[$game][$diff] = [0, '', ''];
			foreach ($wr[$game][$diff] as $shot => $array) {
				if ($array[0] > $overall[$num]) {
					$overall[$num] = $array[0];
					$overall_diff[$num] = $diff;
					$overall_shottype[$num] = $shot;
					$overall_player[$num] = $array[1];
					$overall_date[$num] = $array[2];
				}
                if ($array[0] > $diff_max[$game][$diff][0]) {
                    $diff_max[$game][$diff] = [$array[0], $array[1], $shot];
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
		<link rel='icon' type='image/x-icon' href='assets/wr/wr.ico'>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/wr/wr.js' defer></script>
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
			<div id='topbar'>
				<span id='toggle'>
                    <?php
                        $other = ($layout == 'New' ? 'Old' : 'New');
                        echo '<a id="layouttoggle" href="wr">' . $other . ' layout</a>';
                    ?>
                </span>
				<span id='hy_container'>
                    <img id='hy' src='assets/shared/h-bar.png' alt='Human-youkai gauge' title='Human Mode'>
                </span>
				<div id='languages'>
                    <a id='en-gb' class='flag' href='wr?hl=en-gb'>
                        <img class='flag_en' src='assets/flags/uk.png' alt='<?php echo tl_term('Flag of the United Kingdom', $lang) ?>'>
                        <p class='language'>English (UK)</p>
                    </a>
                    <a id='en-us' class='flag' href='wr?hl=en-us'>
                        <img class='flag_en' src='assets/flags/us.png' alt='<?php echo tl_term('Flag of the United States', $lang) ?>'>
                        <p class='language'>English (US)</p>
                    </a>
                    <a id='jp' class='flag' href='wr?hl=jp'>
                        <img src='assets/flags/japan.png' alt='<?php echo tl_term('Flag of Japan', $lang) ?>'>
                        <p class='language'>日本語</p>
                    </a>
                    <a id='zh' class='flag' href='wr?hl=zh'>
                        <img src='assets/flags/china.png' alt='<?php echo tl_term('Flag of the P.R.C.', $lang) ?>'>
                        <p class='language'>简体中文</p>
                    </a>
	            </div>
			</div>
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
            <?php
                // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
                if ($layout == 'New') {
                    echo '<div id="contents_new" class="border"><p id="overall_link"><a href="#overall" ' .
                    'class="overallrecords">' . tl_term('Overall Records', $lang) . '</a></p>' .
                    '<p id="overall_linkm"><a href="#overallm" class="overallrecords">' . tl_term('Overall Records', $lang) .
                    '</a></p><p><a href="#wrs" class="worldrecords">' . tl_term('World Records', $lang) . '
                    </a></p><p><a href="#players" class="playerranking">' . tl_term('Player Ranking', $lang) .
                    '</a></p><p><a href="#ack" class="ack">' . tl_term('Acknowledgements', $lang) .
                    '</a></p></div><noscript>';
                }
                echo '<div id="contents" class="border"><p id="overall_link"><a href="#overall" ' .
                'class="overallrecords">' . tl_term('Overall Records', $lang) . '</a></p>' .
                '<p id="overall_linkm"><a href="#overallm" class="overallrecords">' . tl_term('Overall Records', $lang) .
                '</a></p><p><a href="#wrs" class="worldrecords">' . tl_term('World Records', $lang) . '
                </a></p>';
                foreach ($wr as $game => $value) {
                    echo '<p><a href="#' . $game . '">' . full_name($game, $lang) . '</a></p>';
                }
                echo '<p id="westernlink"><a href="#western">' . tl_term('Western Records', $lang) . '</a></p>';
                echo '<p id="playersearchlink"><a href="#playerwrs">' . player_search($lang) . '</a></p>';
                echo '<p><a href="#players" class="playerranking">' . tl_term('Player Ranking', $lang) . '</a></p>';
                echo '<p><a href="#ack" class="ack">' . tl_term('Acknowledgements', $lang) . '</a></p></div>';
                if ($layout == 'New') {
                    echo '</noscript>';
                }
            ?>
            <div id='checkboxes' class='border'>
                <p>
                    <input id='dates' type='checkbox'>
			        <label id='label_dates' for='dates' class='dates'><?php echo tl_term('Dates', $lang); ?></label>
                </p>
            </div>
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
							echo '<tr id="' . $game . 'o"><td>' . $num . '</td><td class="' . $game . '">' . game_tl($game, $lang) . '</td>';
							echo '<td id="' . $game . 'overall0">' . ($game == 'WBaWC' ? '<abbr ' .
                            'title="' . number_format($overall[$num], 0, '.', ',') . '">9,999,999,990' .
                            '</abbr>' : number_format($overall[$num], 0, '.', ',')) . '</td>';
                            echo '<td id="' . $game . 'overall1">' . $overall_player[$num] . ($game == 'WBaWC' ? '*' : '') . '</td>';
							echo '<td id="' . $game . 'overall2">' . $overall_diff[$num] . '</td>';
							echo '<td id="' . $game . 'overall3">' . tl_shot($overall_shottype[$num], $lang) . '</td>';
							echo '<td id="' . $game . 'overall4" class="datestring">' . date_tl($overall_date[$num], $notation) . '</td></tr>';
						}
					?>
                </table>
                <p>* Players that have scored 9,999,999,990:
                    <?php
                        $str = '';
                        foreach ($cs as $player => $value) {
                            $str .= ', <abbr title="';
                            if (gettype($value[0]) == 'array') {
                                $substr = '';
                                foreach ($value as $key => $val) {
                                    $substr .= ', ' . $val[2] . ' ' . $val[0] . ' on ' . date_tl($val[1], $notation);
                                }
                                $str .= substr($substr, 2);
                            } else {
                                $str .= $value[2] . ' ' . $value[0] . ' on ' . date_tl($value[1], $notation);
                            }
                            $str .= '">' . $player . '</abbr>';
                        }
                        echo substr($str, 2);
                    ?>.
                </p>
            </div>
            <div id='overallm'>
                <h2 class='overallrecords'><?php echo tl_term('Overall Records', $lang); ?></h2>
				<?php
                    echo '<hr>';
					foreach ($wr as $game => $value) {
						$num = num($game);
						echo '<p class="' . $game . ' count">' . game_tl($game, $lang) . '</p><p>';
                        echo '<span id="' . $game . 'overall0m">' . ($game == 'WBaWC' ? '<abbr ' .
                        'title="' . number_format($overall[$num], 0, '.', ',') . '">9,999,999,990' .
                        '</abbr> ' : number_format($overall[$num], 0, '.', ',')) . '</span> ';
						echo '<span id="' . $game . 'overall2m">' . $overall_diff[$num] . '</span> ';
						echo '<span id="' . $game . 'overall3m">' . tl_shot($overall_shottype[$num], $lang) . '</span> by ';
						echo '<span id="' . $game . 'overall1m"><em>' . $overall_player[$num] . ($game == 'WBaWC' ? '*' : '') . '</em></span> ';
						echo '<br><span id="' . $game . 'overall4m" class="datestring">' . date_tl($overall_date[$num], $notation) . '</span></p><hr>';
					}
                    echo '* Players that have scored 9,999,999,990: ';
                    $str = '';
                    foreach ($cs as $player => $value) {
                        $str .= ', <abbr title="';
                        if (gettype($value[0]) == 'array') {
                            $substr = '';
                            foreach ($value as $key => $val) {
                                $substr .= ', ' . $val[2] . ' ' . $val[0] . ' on ' . date_tl($val[1], $notation);
                            }
                            $str .= substr($substr, 2);
                        } else {
                            $str .= $value[2] . ' ' . $value[0] . ' on ' . date_tl($value[1], $notation);
                        }
                        $str .= '">' . $player . '</abbr>';
                    }
                    echo substr($str, 2);
				?>
            </div>
            <h2 id='wrs' class='worldrecords'><?php echo tl_term('World Records', $lang); ?></h2>
            <?php
                // With JavaScript disabled OR wr_old_layout cookie set, show classic all games layout
                if ($layout == 'New') {
                    echo '<noscript>';
                }
                foreach ($wr as $game => $obj) {
                    echo '<div id="' . $game . '">';
                    echo '<table id="' . $game . '_table" class="' . $game .
                    't sortable"><caption><p><img' . (num($game) <= 5 ? ' class="cover98"' : '') .
                    ' src="assets/games/' . strtolower($game) . '50x50.jpg" alt="' . $game .
                    ' cover"> ' . full_name($game, $lang) .
                    '</p></caption></p><tr><th>' . tl_term(shot_route($game), $lang) . '</th>';
                    foreach ($obj as $diff => $shots) {
                        if ($game != 'GFW' || $diff != 'Extra') {
                            echo '<th>' . $diff . '</th>';
                        }
                    }
                    echo '</tr>';
                    for ($i = 0; $i < sizeof($obj['Easy']); $i++) {
                        $shot = array_keys($obj['Easy'])[$i];
                        echo '<tr><td>' . format_shot($game, $shot, $lang) . '</td>';
                        for ($j = 0; $j < sizeof($obj); $j++) {
                            $diff = array_keys($obj)[$j];
                            $shots = $obj[array_keys($obj)[$j]];
                            $score = $shots[$shot][0];
                            $player = $shots[$shot][1];
                            if ($game == 'GFW' && $diff == 'Extra') {
                                break;
                            } else if ($game == 'HSiFS' && $diff == 'Extra') {
                                if (strpos($shot, 'Spring')) {
                                    $shot = substr($shot, 0, -6);
                                    $score = number_format($shots[$shot][0], 0, '.', ',');
                                    if (file_exists(replay_path($game, $diff, $shot))) {
                                        $score = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score . '</a>';
                                    }
                                    echo '<td rowspan="4">' . $score . '</a><br>by <em>' . $shots[$shot][1] .
                                    '</em><span class="dimgrey"><br><span class="datestring_game"' .
                                    '>' . date_tl($shots[$shot][2], $notation) . '</span></span></td>';
                                }
                            } else {
                                if ($score >= $MAX_SCORE) {
                                    $score_text = '<abbr title="' . number_format($score, 0, '.', ',') .
                                    '">' . number_format($MAX_SCORE, 0, '.', ',') . '</abbr>';
                                } else {
                                    $score_text = number_format($score, 0, '.', ',');
                                }
                                if (file_exists(replay_path($game, $diff, $shot))) {
                                    $score_text = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score_text . '</a>';
                                }
                                if ($score == $overall[num($game)]) {
                                    $score_text = '<strong>' . $score_text . '</strong>';
                                }
                                if ($score == $diff_max[$game][$diff][0]) {
                                    $score_text = '<u>' . $score_text . '</u>';
                                }
                                echo '<td>' . $score_text . '</a><br>by <em>' . $player . '</em><span class="dimgrey"><br>' .
                                '<span class="datestring_game">' . date_tl($shots[$shot][2], $notation) . '</span></span></td>';
                            }
                        }
                        echo '</tr>';
                    }
                    if ($game == 'GFW') {
                        $score = number_format($obj['Extra']['-'][0], 0, '.', ',');
                        if (file_exists(replay_path($game, $diff, $shot))) {
                            $score = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score . '</a>';
                        }
                        echo '<tr><td>Extra</td><td colspan="4">' . $score . '<br>by <em>' . $obj['Extra']['-'][1] .
                        '</em><span class="dimgrey"><br><span class="datestring_game">' . date_tl($obj['Extra']['-'][2], $notation) .
                        '</span></span></td></tr>';
                    }
                    echo '</table>';
                }
                // Old layout western records
                echo '<h2 id="western">' . tl_term('Western Records', $lang) . '</h2>';
                foreach ($west as $game => $obj) {
                    echo '<table class="' . $game . 't"><tr><th colspan="3">' . game_tl($game, $lang) .
                    '</th></tr><tr><th>' . tl_term('World', $lang) .
                    '</th><th>' . tl_term('West', $lang) . '</th><th>' . tl_term('Percentage', $lang) . '</th></tr>';
                    foreach ($obj as $diff => $shots) {
                        $westt = $west[$game][$diff];
                        $world = $diff_max[$game][$diff];
                        if ($westt[0] == $world[0]) {
                            $percentage = 100;
                        } else {
                            $percentage = number_format((float) $westt[0] / $world[0] * 100, 2, '.', ',');
                        }
                        if ($world[0] >= $MAX_SCORE) {
                            $world_text = '<abbr title="' . number_format($world[0], 0, '.', ',') .
                            '">' . number_format($MAX_SCORE, 0, '.', ',') . '</abbr>';
                        } else {
                            $world_text = number_format($world[0], 0, '.', ',');
                        }
                        echo '<tr><td colspan="3">' . tl_term($diff, $lang) . '</td></tr>' .
                        '<tr><td>' . $world_text .
                        '<br>by <em>' . $world[1] . '</em><br>(' . tl_shot($world[2], $lang) .
                        ')</td><td>' . number_format($westt[0], 0, '.', ',') .
                        '<br>by <em>' . $westt[1] . '</em><br>(' . tl_shot($westt[2], $lang) .
                        ')</td><td class="' . pc_class($percentage) . '">(' . $percentage . '%)</td></tr>';
                    }
                    echo '</table>';
                }
                if ($layout == 'New') {
                    echo '</noscript>';
                }
                // With wr_old_layout cookie NOT set, show game image layout (CSS hides it with JavaScript disabled)
                if ($layout == 'New') {
                    echo '<div id="newlayout"><p id="clickgame">';
                    if ($lang == 'English') {
                        echo 'Click a game cover to show its list of world records.';
                    } else if ($lang == 'Japanese') {
                        echo '世界記録リストはゲームをクリック。';
                    } else {
                        echo '单击游戏处查看世界纪录列表。';
                    }
                    echo '</p>';
    			    foreach ($wr as $game => $value) {
    			        echo '<img id="' . $game . '" class="game" src="assets/games/' . strtolower($game) . '50x50.jpg" alt="' . $game . ' cover">';
                    }
                    echo '</div>';
                }
			?>
			<div id='list'>
			</div>
            <div id='playersearch'>
    			<p id='playerwrs'><?php
                    if ($layout == 'Old') { // if wr_old_layout is set, show header
                        echo '<h2>' . player_search($lang) . '</h2>';
                    }
    				if ($lang == 'English') { echo 'Choose a player name from the menu below to show their WRs.'; }
                    else if ($lang == 'Japanese') { echo '個人のWRを表示するには、下記のメニューからプレイヤー名を選んでください。'; }
                    else { echo '在以下的菜单选择玩家的名字则可查看其WR。'; }
    			?></p>
    			<label for='player' class='player'><?php echo tl_term('Player', $lang); ?></label>
    			<select id='player'>
    			    <option>...</option>
    			    <?php
    			        asort($pl);
    			        foreach ($pl as $key => $player) {
    			            echo '<option>' . $player . '</option>';
    			        }
    			    ?>
    		    </select>
            </div>
			<div id='playerlist'>
				<table class='sortable'>
					<thead id='playerlisthead'><tr>
                        <th class='category'><?php echo tl_term('Category', $lang) ; ?></th>
                        <th class='score'><?php echo tl_term('Score', $lang); ?></th>
                        <th class='replay'><?php echo tl_term('Replay', $lang); ?></th>
                        <th class='datestring'><?php echo tl_term('Date', $lang); ?></th>
                    </tr></thead>
					<tbody id='playerlistbody'></tbody>
					<tfoot id='playerlistfoot'></tfoot>
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
								echo '<tr><td>' . $pl_wr[$key][0] . '</td>';
								echo '<td>' . $pl_wr[$key][1] . '</td>';
                                echo '<td>' . $pl_wr[$key][2] . '</td></tr>';
							}
						?>
					</tbody>
                </table>
            </div>
            <h2 id='ack' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></h2>
            <div id='ack_container'>
				<p id='credit'><?php
                        if ($lang == 'English') {
                            echo 'The background image was drawn by ' .
                            '<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>.';
                        } else if ($lang == 'Japanese') {
                            echo '背景イメージは<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">' .
                            'Catboyjeremie</a>さんのものを使用させていただいております。';
                        } else {
                            echo '背景画师：<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>。';
                        }
                    ?>
				</p>
                <p id='jptlcredit'>
                    <?php
                        if ($lang == 'English') {
                            echo 'The Japanese translation of the top text was done by ' .
                            '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                        } else if ($lang == 'Japanese') {
                            echo 'ページ上部のテキストは<a href="https://twitter.com/toho_yumiya">Yu-miya</a>' .
                            'によって日本語に翻訳されました。';
                        } else {
                            echo '感谢<a href="https://twitter.com/toho_yumiya">Yu-miya</a>提供头部文字的日语翻译。';
                        }
                    ?>
                </p>
                <p id='cntlcredit'>
                    <?php
                        if ($lang == 'English') {
                            echo 'The Chinese translation of the top text was done by ' .
                            '<a href="https://twitter.com/williewillus">williewillus</a>.';
                        } else if ($lang == 'Japanese') {
                            echo 'ページ上部のテキストは<a href="https://twitter.com/williewillus">williewillus</a>' .
                            'によって中国語に翻訳されました。';
                        } else {
                            echo '感谢<a href="https://twitter.com/williewillus">williewillus</a>提供头部文字的中文翻译。';
                        }
                    ?>
                </p>
            </div>
            <p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
			<?php echo '<input id="missingReplays" type="hidden" value="' . implode($missing_replays, '') . '">' ?>
		</div>
        <script src='assets/shared/dark.js'></script>
    </body>
</html>
