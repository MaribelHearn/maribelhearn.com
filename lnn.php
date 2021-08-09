<!DOCTYPE html>
<html id='top' lang='<?php
    if (empty($_GET['hl'])) {
        echo 'en';
    } else {
        $iso = preg_split('/-/', $_GET['hl'])[0];
        $iso = str_replace('jp', 'ja', $iso);
        $iso = str_replace('ru', 'zh', $iso);
        echo $iso;
    }
?>'>
<?php
    include 'assets/shared/shared.php';
    include 'assets/shared/tl.php';
    include 'assets/lnn/lnn.php';
    require_once 'assets/shared/mobile_detect.php';
    hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
    $detect_device = new Mobile_Detect;
    $is_mobile = $detect_device -> isMobile();
?>

	<head>
		<title><?php echo tl_term('Touhou Lunatic No Miss No Bombs', $lang); ?></title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='List of Touhou Lunatic no miss no bomb (LNN) runs, clears that never die or bomb.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, lunatic, nmnb, lnn, lnns, no miss no bomb, no deaths no bombs'>
        <link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=<?php echo $page . '&mobile=' . $is_mobile ?>'>
		<link rel='icon' type='image/x-icon' href='assets/lnn/lnn.ico'>
        <script src='assets/shared/js_concat.php?page=lnn' defer></script>
	</head>

    <body>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <div id='topbar'>
                    <p id='ack'>
                        <?php
                            if ($lang == 'Chinese') {
                                echo '背景画师：<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>';
                            } else if ($lang == 'Japanese') {
                                echo '背景イメージは<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>' .
                                'さんの<br id="ack_br">ものを使用させていただいております';
                            } else if ($lang == 'Russian') {
                                echo 'Иллюстрацию на фоне <br id="ack_br">нарисовал(а) ' .
							    '<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>';
                            } else {
                                echo 'This background image<br id="ack_br"> was drawn by ' .
                                '<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>';
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
                        <span id='hy'></span>
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
	                    <a id='ru' class='flag' href='lnn?hl=ru'>
	                        <img src='assets/flags/russia.png' alt='<?php echo tl_term('Flag of Russia', $lang) ?>'>
	                        <p class='language'>Русский</p>
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
    				if ($lang == 'Chinese') {
    					echo '这个网页记载所有「东方Project」的LNN（Lunatic No Miss No Bomb），时不时地更新。' .
                        '每作游戏的每个机体有一行显示打出LNN的玩家。如果某一位玩家用一个机体打出多次LNN，只算一次，其余次数不算入统计。';
    				} else if ($lang == 'Japanese') {
    					echo '東方原作STG各作品の難易度Lunaticのノーミスノーボム（LNN）リストです。適宜頻繁に更新します。各作品の表とも、' .
                        '各機体において誰が達成したかを記載しています。特定の作品、ショットタイプで複数回のLNNを達成している場合でも１回とカウントされます。';
    				} else if ($lang == 'Russian') {
                        echo 'Регулярно обновляющийся список Lunatic No Miss No Bombs (LNN) забегов. ' .
                        'Таблицы показывают список игроков, которые сделали LNN на том или ином шоттипе. ' .
                        'Если у игрока есть несколько LNN за один и тот же шоттип, они не будут учтены.';
                    } else {
                        echo 'A list of Touhou Lunatic No Miss No Bomb (LNN) runs, updated every so often. ' .
                        'For every shottype in a game, tables will tell you which players have done an LNN with it, if any. ' .
                        'If a player has multiple LNNs for one particular shottype, those are not factored in.';
    				}
    			?></p>
                <p id='conditions'><?php
    				if ($lang == 'Chinese') {
    					echo '妖妖梦、神灵庙、天空璋、鬼形獣、虹龙洞打NN时有附加条件，即是不爆结界、不开灵界、不使用季节解放、不撞咆哮、不开暴走、不卡。此三作LNN被称为LNNN' .
                        '或LNNNN，以第三个N代表着附加的条件。星莲船的附加条件（不开飞碟）由于对难度没有大量的影响，可以自选。永夜抄的LNN必须收取所有LSC，称做LNNFS。';
    				} else if ($lang == 'Japanese') {
    					echo 'また妖々夢では霊撃無し、神霊廟ではトランス無し、天空璋では開放無し、鬼形獣では霊撃無し、' .
                        '暴走ロアリング無し、虹龍洞ではカード無しが条件となります。この５作品では追加条件によってNが追加され、LNNN又はLNNNNと呼称します。' .
                        'また星蓮船ではUFO招喚無しも考慮されますが、難易度が劇的に変化するわけではないため必須条件とはなっていません。' .
                        '永夜抄ではラストスペル取得を含めLNNFSが条件となります。';
                    } else if ($lang == 'Russian') {
                        echo 'Для PCB, TD, HSiFS и WBaWC также необходимы следующий условия: No Border Breaks для PCB, ' .
                        'No Trance для TD, No Release для HSiFS, No Berserk Roar No Roar Breaks для WBaWC и No Cards для UM. ' .
                        'Для этих игр LNN обычно назвают LNNN или LNNNN, с дополнительными N для индикации доп. условий. ' .
                        'Дополнительное условие в UFO, no UFO summons, не требуется, так как считается, что они не имеют ' .
                        'сильное влияние на сложность забега. В LNN IN\'а, впрочем, нужно захватить все Ласт Спеллы и называется LNNFS.';
    				} else {
                        echo 'Extra conditions are required for PCB, TD, HSiFS, WBaWC and UM; these are No Border Breaks for PCB, ' .
                        'No Trance for TD, No Release for HSiFS, No Berserk Roar No Roar Breaks for WBaWC and No Cards for UM. ' .
                        'LNN in these games is called LNNN or LNNNN, with extra Ns to denote the extra conditions. ' .
                        'The extra condition in UFO, no UFO summons, is optional, as it is not considered to have a significant ' .
                        'impact on the difficulty of the run. As for IN, an LNN is assumed to capture all Last Spells and '.
                        'is referred to as LNNFS.';
    				}
    			?></p>
                <p id='tables'><?php
    				if ($lang == 'Chinese') { echo '点击任何标题即可排序表格内容。'; }
                    else if ($lang == 'Japanese') { echo '各欄は並べ替え可能となっています。並べ替えには各表の最上段をクリックしてください'; }
                    else if ($lang == 'Russian') { echo 'Все столбцы таблицы можно отсортировать.'; }
                    else { echo 'All of the table columns are sortable.'; }
    			?></p>
                <p id='lastupdate'><?php echo format_lm($lnn['LM'], $lang) ?></p>
                <h2 id='contents_header'><?php
    				if ($lang == 'Chinese') { echo '内容'; }
    				else if ($lang == 'Japanese') { echo '内容'; }
                    else if ($lang == 'Russian') { echo 'Содержание'; }
    				else { echo 'Contents'; }
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
                        '<table id="' . $game . 't" class="sortable"><caption><p><span id="' . $game . '_image_old" ' .
                        'class="cover ' . (num($game) <= 5 ? 'cover98' : '') . '"></span> ' . full_name($game, $lang) .
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
        				if ($lang == 'Chinese') {
                            echo '单击游戏处查看LNN列表。';
                        } else if ($lang == 'Japanese') {
                            echo 'LNNリストはゲームをクリック。';
                        } else if ($lang == 'Russian') {
                            echo 'Нажмите на обложку игры для получения ее списка LNN.';
                        } else {
                            echo 'Click a game cover to show its list of LNNs.';
                        }
    			        echo '</p>';
        			    foreach ($lnn as $game => $value) {
        			        if ($game == 'LM') {
        			            continue;
        		            }
        			        echo '<span class="game_image"><span id="' . $game . '_image" class="game_img"></span>' .
                            '<span class="full_name tooltip">' . full_name($game, $lang) . '</span></span>';
        			    }
                        echo '<div id="list"><p id="fullname"></p><table class="sortable"><thead id="listhead"></thead>' .
                        '<tbody id="listbody"></tbody><tfoot id="listfoot"></tfoot></table></div></div>';
                    }
                ?>
                <div id='playersearch'>
                    <h2><?php echo player_search($lang); ?></h2>
        			<p id='playerlnns'><?php
        				if ($lang == 'Chinese') { echo '在以下的菜单选择玩家的名字则可查看其LNN。'; }
                        else if ($lang == 'Japanese') { echo '個人のLNNを表示するには、下記のメニューからプレイヤー名を選んでください。'; }
                        else if ($lang == 'Russian') { echo 'Выберите имя игрока из меню ниже чтобы получить список его LNN.'; }
                        else { echo 'Choose a player name from the menu below to show their LNNs.'; }
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
                    				if ($lang == 'Chinese') { echo '玩家'; }
                                    else if ($lang == 'Japanese') { echo 'プレイヤー'; }
                                    else { echo 'Different players'; }
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
                                    $shot_lnns = $pl_lnn[$key][1] == $ALL_LNN ? $pl_lnn[$key][1] . tl_term(' (All Windows)', $lang) : $pl_lnn[$key][1];
                                    $game_lnns = $pl_lnn[$key][2] == $ALL_GAME_LNN ? $pl_lnn[$key][2] . tl_term(' (All Windows)', $lang) : $pl_lnn[$key][2];
                                    echo '<tr><td>' . $pl_lnn[$key][0] . '</td><td>' . $shot_lnns . '</td><td>' . $game_lnns . '</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
    			<h2 id='acks' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></h2>
                <div id='ack_container'>
    				<p id='jptlcredit'><?php
                        if ($lang == 'Chinese') {
                            echo '感谢<a href="https://twitter.com/toho_yumiya">Yu-miya</a>' .
                            '提供头部文字的日语翻译。';
                        } else if ($lang == 'Japanese') {
                            echo 'ページ上部のテキストは<a href="https://twitter.com/toho_yumiya">ゆーみや</a>' .
                            'によって日本語に翻訳されました。';
						} else if ($lang == 'Russian') {
                            echo 'Японский перевод сделал ' .
                            '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                        } else {
                            echo 'The Japanese translation of the top text was done by ' .
                            '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                        }
                    ?></p>
                    <p id='cntlcredit'><?php
                        if ($lang == 'Chinese') {
                            echo '感谢<a href="https://twitter.com/williewillus">williewillus</a>' .
                            '提供头部文字的中文翻译。';
                        } else if ($lang == 'Japanese') {
                            echo 'ページ上部のテキストは<a href="https://twitter.com/williewillus">williewillus</a>' .
                            'によって中国語に翻訳されました。';
                        } else if ($lang == 'Russian') {
                            echo 'Китайский перевод сделал ' .
                            '<a href="https://twitter.com/williewillus">williewillus</a>.';
                        } else {
                            echo 'The Chinese translation of the top text was done by ' .
                            '<a href="https://twitter.com/williewillus">williewillus</a>.';
                        }
                    ?></p>
                    <p id='rutlcredit'><?php
                        if ($lang == 'Chinese') {
                            echo '感谢<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>' .
                            '提供头部文字的俄语翻译。';
                        } else if ($lang == 'Japanese') {
                            echo 'ページ上部のテキストは<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>' .
                            'によってロシア語に翻訳されました。';
                        } else if ($lang == 'Russian') {
                           echo 'Русский перевод сделал ' .
                           '<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>.';
                        } else {
                            echo 'The Russian translation of the top text was done by ' .
                            '<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>.';
                        }
                    ?></p>
    				<p id='ack_mobile'><?php
                        if ($lang == 'Chinese') {
                            echo '背景画师：<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>。';
                        } else if ($lang == 'Japanese') {
                            echo '背景イメージは<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>' .
                            'さんのものを使用させていただいております。';
                        } else if ($lang == 'Russian') {
                            echo 'Иллюстрацию на фоне нарисовал(а) ' .
                            '<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>.';
                        } else {
                            echo 'The background image was drawn by ' .
                            '<a href="https://www.pixiv.net/member.php?id=1111435">C.Z</a>.';
                        }
                    ?></p>
                </div>
                <p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
    			<?php echo '<input id="missingReplays" type="hidden" value="' . implode('', $missing_replays) . '">' ?>
    		</div>
        </main>
    </body>
</html>
