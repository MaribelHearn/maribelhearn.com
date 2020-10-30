<!DOCTYPE html>
<html id='top' lang='<?php if (empty($_GET['hl'])) { echo 'en'; } else { echo str_replace('jp', 'ja', $_GET['hl']); } ?>'>
<?php
    include 'assets/shared/shared.php';
    include 'assets/shared/tl.php';
    include 'assets/lnn/lnn.php';
    hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
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
        <?php echo dark_theme() ?>
	</head>

    <body class='<?php echo check_webp() ?>'>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <div id='topbar'>
                    <p id='ack'>
                        <?php
                            if ($lang == 'English') {
                                echo 'This background image<br id="ack_br"> was drawn by ' .
                                '<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>';
                            }
                            else if ($lang == 'Japanese') {
                                echo '背景イメージは<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>' .
                                'さんのものを使用させていただいております';
                            }
                            else {
                                echo '背景画师：<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>';
                            }
                        ?>
                    </p>
    				<span id='toggle'>
                        <?php
                            $other = ($layout == 'New' ? 'Old' : 'New');
                            echo '<a id="layouttoggle" href="lnn">' . $other . ' layout</a>';
                        ?>
                    </span>
    				<span id='hy_container'>
                        <img id='hy' src='../assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
                        <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                    </span>
    				<div id='languages'>
                        <a id='en' class='flag' href='lnn?hl=en'>
                            <img class='flag_en' src='assets/flags/uk.png' alt='<?php echo tl_term('Flag of the United Kingdom', $lang) ?>'>
                            <p class='language'>English</p>
                        </a>
                        <a id='jp' class='flag' href='lnn?hl=jp'>
                            <img src='assets/flags/japan.png' alt='<?php echo tl_term('Flag of Japan', $lang) ?>'>
                            <p class='language'>日本語</p>
                        </a>
                        <a id='zh' class='flag' href='lnn?hl=zh'>
                            <img src='assets/flags/china.png' alt='<?php echo tl_term('Flag of the P.R.C.', $lang) ?>'>
                            <p class='language'>简体中文</p>
                        </a>
    	            </div>
    			</div>
    			<h1><?php echo tl_term('Touhou Lunatic No Miss No Bombs', $lang); ?></h1>
                <?php
                    if (!empty($_GET['redirect'])) {
                        echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
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

                <?php
                    // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
                    if ($layout == 'New') {
                        echo '<div id="contents_new" class="border"><p><a href="#lnns" class="lnns">' . tl_term('LNN Lists', $lang) .
                        '</a></p><p><a href="#overall" class="overallcount">' . tl_term('Overall Count', $lang) .
                        '</a></p><p><a href="#players" class="playerranking">' . tl_term('Player Ranking', $lang) .
                        '</a></p><p><a href="#acks" class="ack">' . tl_term('Acknowledgements', $lang) . '</a></p></div><noscript>';
                    }
                    echo '<div id="contents" class="border"><p><a href="#lnns" class="lnns">' . tl_term('LNN Lists', $lang) . '</a></p>';
                    foreach ($lnn as $game => $obj) {
                        if ($game == 'LM') {
                            continue;
                        }
                        echo '<p><a href="#' . $game . '">' . full_name($game, $lang) . '</a></p>';
                    }
                    echo '<p id="playersearchlink"><a href="#playersearch">' . player_search($lang) .
                    '</a></p><p><a href="#overall" class="overallcount">' . tl_term('Overall Count', $lang) .
                    '</a></p><p><a href="#players" class="playerranking">' . tl_term('Player Ranking', $lang) .
                    '</a></p><p><a href="#acks" class="ack">' . tl_term('Acknowledgements', $lang) . '</a></p></div>';
                    if ($layout == 'New') {
                        echo '</noscript>';
                    }
                ?>
                <h2 id='lnns' class='lnns'><?php echo tl_term('LNN Lists', $lang) ?></h2>
                <?php
                    // With JavaScript disabled OR lnn_old_layout cookie set, show classic all games layout
                    if ($layout == 'New') {
                        echo '<noscript>';
                    }
                    foreach ($lnn as $game => $obj) {
                        if ($game == 'LM') {
                            continue;
                        }
                        $sum = 0;
                        $all = array();
                        echo '<div id="' . $game . '"><p>' .
                        '<table id="' . $game . 't" class="sortable"><caption><p><img src="assets/games/' . strtolower($game) .
                        '50x50.jpg"' . (num($game) <= 5 ? ' class="cover98"' : '') .
                        ' alt="' . $game . ' cover"> ' . full_name($game, $lang) .
                        '</p></caption><thead><tr><th>' . tl_term(shot_route($game), $lang) . '</th>' .
                        '<th class="sorttable_numeric">' . lnn_type($game, $lang) .
                        '<br>' . tl_term('(Different players)', $lang) . '</th><th>' . tl_term('Players', $lang) .
                        '</tr></thead><tbody>';
                        foreach ($obj as $shot => $players) {
                            if (strpos($shot, 'UFOs')) {
                                continue;
                            }
                            $count = sizeof($players);
                            $sum += $count;
                            $all = array_merge($all, $players);
                            if ($game == 'UFO') {
                                $count += sizeof($obj[$shot . 'UFOs']);
                            }
                            sort($players);
                            $tl_shot = format_shot($game, $shot, $lang);
                            echo '<tr><td class="nowrap">' . $tl_shot . '</td><td>' . $count . '</td><td>' . implode(', ', $players);
                            if ($game == 'UFO') {
                                $players = $obj[$shot . 'UFOs'];
                                $sum += sizeof($players);
                                $all = array_merge($all, $players);
                                for ($i = 0; $i < sizeof($players); $i++) {
                                    $players[$i] .= ' (UFOs)';
                                }
                                sort($players);
                                echo (sizeof($players) > 0 ? ', ' : '') . implode(', ', $players);
                            }
                            echo '</td></tr>';
                        }
                        $all = array_unique($all);
                        sort($all);
                        echo '</tbody><tfoot><tr><td colspan="3"></td></tr><tr><td>' . tl_term('Overall', $lang) .
                        '</td><td>' . $sum . ' (' . sizeof($all) . ')</td><td>' . implode(', ', $all) .
                        '</td></tr></tfoot></table></div>';
                    }
                    if ($layout == 'New') {
                        echo '</noscript>';
                    }
                    // With lnn_old_layout cookie NOT set, show game image layout (CSS hides it with JavaScript disabled)
                    if ($layout == 'New') {
                        echo '<div id="newlayout"><p id="clickgame">';
        				if ($lang == 'English') {
                            echo 'Click a game cover to show its list of LNNs.';
                        } else if ($lang == 'Japanese') {
                            echo 'LNNリストはゲームをクリック。';
                        } else {
                            echo '单击游戏处查看LNN列表。';
                        }
    			        echo '</p>';
        			    foreach ($lnn as $game => $value) {
        			        if ($game == 'LM') {
        			            continue;
        		            }
        			        echo '<img id="' . $game . 'i" class="game" src="assets/games/' . strtolower($game) .
                            '50x50.jpg" alt="' . $game . ' cover">';
        			    }
                        echo '<div id="list"><p id="fullname"></p><table class="sortable"><thead id="listhead"></thead>' .
                        '<tbody id="listbody"></tbody><tfoot id="listfoot"></tfoot></table></div></div>';
                    }
                ?>
                <div id='playersearch'>
                    <h2><?php echo player_search($lang); ?></h2>
        			<p id='playerlnns'><?php
        				if ($lang == 'English') { echo 'Choose a player name from the menu below to show their LNNs.'; }
                        else if ($lang == 'Japanese') { echo '個人のLNNを表示するには、下記のメニューからプレイヤー名を選んでください。'; }
                        else { echo '在以下的菜单选择玩家的名字则可查看其LNN。'; }
        			?></p>
        			<label for='player' class='player'><?php echo tl_term('Player', $lang); ?></label>
        			<input id='player' list='autocomplete' type='text'>
                    <datalist id='autocomplete'>
        			    <?php
        			        asort($pl);
        			        foreach ($pl as $key => $player) {
        			            echo '<option value="' . $player . '">';
        			        }
        			    ?>
        		    </datalist>
                </div>
    			<div id='playerlist'>
    				<table class='sortable'>
    					<thead id='playerlisthead'><tr>
                            <th class='game'><?php echo tl_term('Game', $lang) ; ?></th>
                            <th class='shottype'><?php echo tl_term('Shottype', $lang); ?></th>
                            <th class='replay'><?php echo tl_term('Replay', $lang); ?></th>
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
                                <td colspan='2'><span class='overall'><?php echo tl_term('Overall', $lang); ?></span></td>
                                <td><?php echo $gt ?></td>
                                <td><?php echo sizeof($pl_lnn) ?></td>
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
    			<h2 id='acks' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></h2>
                <div id='ack_container'>
    				<p id='jptlcredit'>
                        <?php
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
                        ?>
                    </p>
                    <p id='cntlcredit'>
                        <?php
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
                        ?>
                    </p>
    				<p id='ack_mobile'>
                        <?php
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
                        ?>
                    </p>
                </div>
                <p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
    			<?php echo '<input id="missingReplays" type="hidden" value="' . implode($missing_replays, '') . '">' ?>
                <script src='assets/shared/dark.js'></script>
    		</div>
        </main>
    </body>
</html>
