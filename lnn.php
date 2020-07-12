<!DOCTYPE html>
<html lang='en'>
<?php
    include '.stats/count.php';
    hit(basename(__FILE__));
    $json = file_get_contents('json/lnnlist.json');
    $lnn = json_decode($json, true);
	if (isset($_COOKIE['lang'])) {
		$lang = str_replace('"', '', $_COOKIE['lang']);
	}
    if (empty($_GET['hl']) && !isset($_COOKIE['lang']) || $_GET['hl'] == 'en') {
		$lang = 'English';
	} else if ($_GET['hl'] == 'jp') {
		 $lang = 'Japanese';
	} else if ($_GET['hl'] == 'zh') {
		$lang = 'Chinese';
	}
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
            case 'Japanese': return '<span id="lm">' . date_tl($lm) . '</span>現在のLNN記録です。';
            case 'Chinese': return 'LNN更新于<span id="lm">' . date_tl($lm) . '</span>。';
            default: return 'LNNs are current as of <span id="lm">' . $lm . '</span>.';
        }
    }
    function tl_term($term, $lang) {
	    if ($lang == 'Japanese') {
	        $term = trim($term);
			switch ($term) {
				case 'Game': return 'ゲーム';
                case 'Games LNN\'d': return 'ゲーム';
                case 'Player': return 'プレイヤー';
                case 'Shottype': return 'キャラ';
				case 'Overall': return '合計';
				case 'No. of LNNs': return 'LNNの数';
				case 'LNN Lists': return 'LNNリスト';
                case 'Overall Count': return '総数';
                case 'Player Ranking': return 'プレイヤーのランキング';
                case 'Acknowledgements': return '謝辞';
                case 'Touhou Lunatic No Miss No Bombs': return '東方Lunaticノーミスノーボム';
                case '(All)': return '（全）';
				case 'Back to Top': return '上に帰る';
	            default: return $term;
	        }
		} else if ($lang == 'Chinese') {
	        $term = trim($term);
			switch ($term) {
				case 'Game': return '游戏';
                case 'Games LNN\'d': return '游戏';
                case 'Player': return '玩家';
                case 'Shottype': return '机体';
				case 'Overall': return '合計';
				case 'No. of LNNs': return 'LNN的数量';
				case 'LNN Lists': return 'LNN列表';
                case 'Overall Count': return '总数';
                case 'Player Ranking': return '玩家排行';
                case 'Acknowledgements': return '致谢';
                case 'Touhou Lunatic No Miss No Bombs': return '东方LNN';
                case '(All)': return '（全）';
				case 'Back to Top': return '回到顶部';
	            default: return $term;
	        }
		} else {
			return $term;
		}
	}
    foreach ($lnn as $game => $data1) {
        if ($game == 'LM') {
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
		<title><?php echo tl_term('Touhou Lunatic No Miss No Bombs', $lang); ?></title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='List of Touhou Lunatic no miss no bomb (LNN) runs, clears that never die or bomb.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, lunatic, nmnb, lnn, lnns, no miss no bomb, no deaths no bombs'>
        <link rel='stylesheet' type='text/css' href='assets/lnn/lnn.css'>
		<link rel='icon' type='image/x-icon' href='assets/lnn/lnn.ico'>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
		<script src='assets/lnn/lnn.js' defer></script>
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
			<table id='top' class='center noborders'>
				<tr class='noborders'>
					<td id='emptytd' class='noborders'></td>
					<td id='languagestd' class='noborders'><table id='languages' class='noborders'>
		                <tbody>
		                    <tr class='noborders'>
		                        <td class='noborders'>
                                    <a class='en' href='lnn?hl=en'><img src='assets/flags/uk.png' alt='<?php
										if ($lang == 'English') { echo 'Flag of the United Kingdom'; }
										else if ($lang == 'Japanese') { echo 'イギリスの国旗'; }
										else { echo '英国旗'; }
									?>'></a>
		                        </td>
		                        <td class='noborders'>
                                    <a class='jp' href='lnn?hl=jp'><img src='assets/flags/japan.png' alt='<?php
										if ($lang == 'English') { echo 'Flag of Japan'; }
										else if ($lang == 'Japanese') { echo '日本の国旗'; }
										else { echo '日本旗'; }
									?>'></a>
		                        </td>
		                        <td class='noborders'>
                                    <a class='zh' href='lnn?hl=zh'><img src='assets/flags/china.png' alt='<?php
										if ($lang == 'English') { echo 'Flag of the P.R.C.'; }
										else if ($lang == 'Japanese') { echo '中華人民共和国の国旗'; }
										else { echo '中国旗'; }
									?>'></a>
		                        </td>
		                    </tr>
		                    <tr class='noborders'>
		                        <td class='noborders'><a class='en' href='lnn?hl=en'>English</a></td>
		                        <td class='noborders'><a class='jp' href='lnn?hl=jp'>日本語</a></td>
		                        <td class='noborders'><a class='zh' href='lnn?hl=zh'>简体中文</a></td>
		                    </tr>
		                </tbody>
		            </table></td>
					<td id='bartd' class='noborders'>
                        <img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
                    </td>
				</tr>
			</table>
			<h1><?php echo tl_term('Touhou Lunatic No Miss No Bombs', $lang); ?></h1>
            <?php
                if (!empty($_GET['redirect'])) {
                    echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
                }
            ?>
            <p id='description'><?php
				if ($lang == 'English') {
					echo 'A list of Touhou Lunatic No Miss No Bomb (LNN) runs, updated every so often. ' .
                    'For every shottype in a game, tables will tell you which players have done an LNN with it, if any. ' .
                    'If a player has multiple LNNs for one particular shottype, those are not factored in.';
				} else if ($lang == 'Japanese') {
					echo '東方原作STG各作品の難易度Lunaticのノーミスノーボム（LNN）リストです。適宜頻繁に更新します。各作品の表とも、' .
                    '各機体において誰が達成したかを記載しています。特定の作品、ショットタイプで複数回のLNNを達成している場合でも１回とカウントされます。';
				} else {
					echo '这个网页记载所有「东方Project」的LNN（Lunatic No Miss No Bomb），时不时地更新。' .
                    '每作游戏的每个机体有一行显示打出LNN的玩家。如果某一位玩家用一个机体打出多次LNN，只算一次，其余次数不算入统计。';
				}
			?></p>
            <p id='conditions'><?php
				if ($lang == 'English') {
					echo 'Extra conditions are required for PCB, TD, HSiFS and WBaWC; these are No Border Breaks for PCB, ' .
                    'No Trance for TD, No Release for HSiFS and No Berserk Roar No Roar Breaks for WBaWC. ' .
                    'LNN in these games is called LNNN or LNNNN, with extra Ns to denote the extra conditions. ' .
                    'The extra condition in UFO, no UFO summons, is optional, as it is not considered to have a significant ' .
                    'impact on the difficulty of the run. As for IN, an LNN is assumed to capture all Last Spells and '.
                    'is referred to as LNNFS.';
				} else if ($lang == 'Japanese') {
					echo 'また妖々夢では霊撃無し、神霊廟ではトランス無し、天空璋では開放無し、鬼形獣では霊撃無し、' .
                    '暴走ロアリング無しが条件となります。この４作品では追加条件によってNが追加され、LNNN又はLNNNNと呼称します。' .
                    'また星蓮船ではUFO招喚無しも考慮されますが、難易度が劇的に変化するわけではないため必須条件とはなっていません。' .
                    '永夜抄ではラストスペル取得を含めLNNFSが条件となります。';
				} else {
					echo '妖妖梦、神灵庙、天空璋打NN时有附加条件，即是不爆结界、不开灵界、不使用季节解放。此三作LNN被称为LNNN，' .
                    '以第三个N代表着附加的条件。星莲船的附加条件（不开飞碟）由于对难度没有大量的影响，可以自选。永夜抄的LNN必须收取所有LSC，称做LNNFS。';
				}
			?></p>
            <p id='tables'><?php
				if ($lang == 'English') { echo 'All of the table columns are sortable.'; }
                else if ($lang == 'Japanese') { echo '各欄は並べ替え可能となっています。並べ替えには各表の最上段をクリックしてください'; }
                else { echo '点击任何标题即可排序表格内容。'; }
			?></p>
            <p id='lastupdate'><?php echo format_lm($lnn['LM'], $lang) ?></p>
            <h2 id='contents_header'><?php
				if ($lang == 'English') { echo 'Contents'; }
				else if ($lang == 'Japanese') { echo '内容'; }
				else { echo '内容'; }
			?></h2>
            <table id='contents'>
                <tr><td><a href='#lnns' class='lnns'><?php echo tl_term('LNN Lists', $lang); ?></a></td></tr>
                <tr><td><a href='#overall' class='overallcount'><?php echo tl_term('Overall Count', $lang); ?></a></td></tr>
                <tr><td><a href='#players' class='playerranking'><?php echo tl_term('Player Ranking', $lang); ?></a></td></tr>
				<tr><td><a href='#ack' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></a></td></tr>
            </table>
			<h2 id='lnns' class='lnns'><?php echo tl_term('LNN Lists', $lang); ?></h2>
			<p id='clickgame'><?php
				if ($lang == 'English') { echo 'Click a game cover to show its list of LNNs.'; }
                else if ($lang == 'Japanese') { echo 'LNNリストはゲームをクリック。'; }
                else { echo '单击游戏处查看LNN列表。'; }
			?></p>
			<?php
			    foreach ($lnn as $game => $value) {
			        if ($game == 'LM') {
			            continue;
		            }
			        echo '<img id="' . $game . '" class="game" src="games/' . strtolower($game) . '50x50.jpg" alt="' . $game . ' cover">';
			    }
			?>
			<noscript><?php
				if ($lang == 'English') {
					echo '<p><em>Sorry, you cannot show the game LNNs with JavaScript disabled as of now.</em></p>';
				} else if ($lang == 'Japanese') {
					echo '<p>JavaScriptなしではLNNを示すできません。</p>';
				} else {
					echo '<p>不好意思，目前查看LNN必须开启JavaScript。</p>';
				}
			?></noscript>
            <div id='list'>
				<p id='fullname'></p>
				<table class='sortable'>
					<thead id='listhead'></thead>
                    <tbody id='listbody'></tbody>
                    <tfoot id='listfoot'></tfoot>
				</table>
			</div>
			<p id='playerlnns'><?php
				if ($lang == 'English') { echo 'Choose a player name from the menu below to show their LNNs.'; }
                else if ($lang == 'Japanese') { echo '個人のLNN(s)を表示するには、下記のメニューからプレイヤー名を選んでください。'; }
                else { echo '在以下的菜单选择玩家的名字则可查看其LNN。'; }
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
			<div id='playerlist'>
				<table>
					<thead id='playerlisthead'><tr>
                        <th class='game'><?php echo tl_term('Game', $lang) ; ?></th>
                        <th class='shottype'><?php echo tl_term('Shottype', $lang); ?></th>
                    </tr></thead>
					<tbody id='playerlistbody'></tbody>
					<tfoot id='playerlistfoot'></tfoot>
				</table>
			</div>
            <div id='overall'>
                <h2 class='overallcount'><?php echo tl_term('Overall Count', $lang); ?></h2>
                <table class='sortable'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class='game'><?php echo tl_term('Game', $lang); ?></th>
                            <th id='autosort1' class='sorttable_numeric'>
                                <span class='nooflnns'><?php echo tl_term('No. of LNNs', $lang); ?></span>
                            </th>
                            <th id='autosort2' class='sorttable_numeric'><span class='differentn'><?php
                				if ($lang == 'English') { echo 'Different players'; }
                                else if ($lang == 'Japanese') { echo 'プレイヤー'; }
                                else { echo '玩家'; }
                			?></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($lnn as $game => $data1) {
                                if ($game == 'LM') {
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
                            <td colspan='2' class='count'><span class='overall'><?php echo tl_term('Overall', $lang); ?></span></td>
                            <td class='count'><?php echo $gt ?></td>
                            <td class='count'><?php echo sizeof($pl_lnn) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div id='players'>
                <h2 class='playerranking'><?php echo tl_term('Player Ranking', $lang); ?></h2>
                <table id='ranking' class='sortable'>
                    <thead>
                        <tr>
                            <th class='player'><?php echo tl_term('Player', $lang); ?></th>
                            <th id='autosort3' class='sorttable_numeric'>
                                <span class='nooflnns'><?php echo tl_term('No. of LNNs', $lang); ?></span>
                            </th>
                            <th id='autosort4' class='sorttable_numeric'>
                                <span class='games'><?php echo tl_term('Games LNN\'d', $lang); ?></span>
                            </th>
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
                                $game_lnns = $pl_lnn[$key][2] == 12 ? $pl_lnn[$key][2] . tl_term(' (All)', $lang) : $pl_lnn[$key][2];
                                echo '<tr><td>' . $pl_lnn[$key][0] . '</td><td>' . $pl_lnn[$key][1] . '</td><td>' . $game_lnns . '</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
			<div id='ack'>
            	<h2 class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></h2>
	            <table class='noborders'>
					<tr class='noborders'>
						<td id='credit' class='noborders'><?php
                            if ($lang == 'English') {
                                echo 'The background image was drawn by ' .
                                '<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>.';
                            }
                            else if ($lang == 'Japanese') {
                                echo '背景イメージは<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>' .
                                'さんのものを使用させていただいております。';
                            }
                            else {
                                echo '背景画师：<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>。';
                            }
                        ?></td>
					</tr>
                    <tr class='noborders'>
                        <td id='jptlcredit' class='noborders'><?php
                            if ($lang == 'English') {
                                echo 'The Japanese translation of the top text was done by ' .
                                '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                            }
                            else if ($lang == 'Japanese') {
                                echo 'ページ上部のテキストは<a href="https://twitter.com/toho_yumiya">Yu-miya</a>' .
                                'によって日本語に翻訳されました。';
                            }
                            else {
                                echo '感谢<a href="https://twitter.com/toho_yumiya">Yu-miya</a>' .
                                '提供头部文字的日语翻译。';
                            }
                        ?></td>
                    </tr>
                    <tr class='noborders'>
                        <td id='cntlcredit' class='noborders'><?php
                            if ($lang == 'English') {
                                echo 'The Chinese translation of the top text was done by ' .
                                '<a href="https://twitter.com/williewillus">williewillus</a>.';
                            }
                            else if ($lang == 'Japanese') {
                                echo 'ページ上部のテキストは<a href="https://twitter.com/williewillus">williewillus</a>' .
                                'によって中国語に翻訳されました。';
                            }
                            else {
                                echo '感谢<a href="https://twitter.com/williewillus">williewillus</a>' .
                                '提供头部文字的中文翻译。';
                            }
                        ?></td>
                    </tr>
	            </table>
			</div>
            <p id='back'><strong><a id='backtotop' href='#nav'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
		</div>
        <script src='assets/shared/dark.js'></script>
    </body>
</html>
