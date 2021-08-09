<!DOCTYPE html>
<html id='top' lang='<?php
    if (empty($_GET['hl'])) {
        echo 'en';
    } else {
        $iso = preg_split('/-/', $_GET['hl'])[0];
        $iso = str_replace('jp', 'ja', $iso);
        echo $iso;
    }
?>'>
<?php
    include 'assets/shared/shared.php';
    include 'assets/shared/tl.php';
    include 'assets/wr/wr.php';
    require_once 'assets/shared/mobile_detect.php';
    hit(basename(__FILE__));
    $page = str_replace('.php', '', basename(__FILE__));
    $detect_device = new Mobile_Detect;
    $is_mobile = $detect_device -> isMobile();
?>

	<head>
		<title><?php echo tl_term('Touhou World Records', $lang); ?></title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='List of Touhou shooting game world records.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, wr, wrs, world record, world records, scores, high scores, scoring'>
        <link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=<?php echo $page . '&mobile=' . $is_mobile ?>'>
		<link rel='icon' type='image/x-icon' href='assets/wr/wr.ico'>
        <script src='assets/shared/js_concat.php?page=wr' defer></script>
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
                                echo '背景画师：<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>';
                            } else if ($lang == 'Japanese') {
                                echo '背景イメージは<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">' .
                                'Catboyjeremie</a>さんの<br id="ack_br">ものを使用させていただいております';
                            } else if ($lang == 'Russian') {
								echo 'Иллюстрацию на фоне <br id="ack_br">нарисовал(а) ' .
								'<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>';
							} else {
                                echo 'This background image was<br id="ack_br"> drawn by ' .
                                '<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>';
                            }
                        ?>
    				</p>
    				<span id='toggle'>
                        <?php
                            $other = ($layout == 'New' ? 'Old' : 'New');
                            echo '<a id="layouttoggle" href="wr">' . $other . ' layout</a>';
                        ?>
                    </span>
    				<span id='hy_container'>
                        <span id='hy'></span>
                        <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
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
                        <a id='ru' class='flag' href='wr?hl=ru'>
                            <img src='assets/flags/russia.png' alt='<?php echo tl_term('Flag of Russia', $lang) ?>'>
                            <p class='language'>Русский</p>
                        </a>
    	            </div>
    			</div>
    			<h1><?php echo tl_term('Touhou World Records', $lang); ?></h1>
                <?php
                    if (!empty($_GET['redirect'])) {
                        echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
                    }
                ?>
                <p id='description'><?php
                    if ($lang == 'Chinese') {
                        echo '这个网页准确地记载所有「东方Project」的打分世界记录，时不时地更新。注意：页底的玩家排行榜只算玩家们得到的记录有多少，' .
                        '并不算记录的强度。目前数据并不包括摄影游戏。';
                    } else if ($lang == 'Japanese') {
                        echo '東方原作STG各作品世界記録の正確なリストです。適宜頻繁に更新します。' .
                        '下部に記載されているプレイヤーランキングは特定のスコアの高低を示すものではなく、あくまで世' .
                        '界記録取得数を示したものですのでご留意ください。また今のところ文花帖のようなシーンを基準にするリストは作成しておりません。';
                    } else if ($lang == 'Russian') {
                        echo 'Регулярно обновяющийся список всех мировых рекордов по Тохо. Замечание: рейтинг игроков снизу не ' .
                        'учитывает насколько их рекорды сложно побить, это всего лишь числа. Список на данный момент не включает ' .
                        'в себя фотошутеры.';
                    } else {
                        echo 'An accurate list of Touhou world records, updated every so often. ' .
                        'Note that the player ranking at the bottom does not take into account how strong specific records are, '.
                        'only numbers. The list does not include scene games as of now.';
                    }
                ?></p>
                <p id='clicktodl'><?php
                    if ($lang == 'Chinese') {
                        echo '点击任何分数即可下载对应的rep。点击任何标题即可排序表格内容。';
                    } else if ($lang == 'Japanese') {
                        echo '該当のリプレイファイルをダウンロードするにはスコアをクリックしてください。' .
                        '各欄は並べ替え可能となっています。並べ替えには各表の最上段をクリックしてください。';
                    } else if ($lang == 'Russian') {
                        echo 'Вы можете нажать на скор чтобы скачать реплей, если он доступен. Все столбцы таблицы ' .
                        'можно отсортировать.';
                    } else {
                        echo 'Click a score to download the corresponding replay, if there is one available. ' .
                        'All of the table columns are sortable.';
                    }
                ?></p>
                <p id='noreup'><?php
                    if ($lang == 'Chinese') {
                        echo '请勿将rep上传到别的存rep网站。';
                    } else if ($lang == 'Japanese') {
                        echo 'リプレイファイルの二次利用は禁止致します。';
                    } else if ($lang == 'Russian') {
                        echo 'Предоставленные здесь реплеи <strong>запрещается</strong> публиковать на сторонних ресурсах.';
                    } else {
                        echo 'The replays provided are <strong>not</strong> meant to be reuploaded to any replay uploading services.';
                    }
                ?></p>
                <p id='lastupdate'><?php echo format_lm($lm, $lang, $notation) ?></p>
                <h2 id='contents_header'><?php
    				if ($lang == 'Chinese') { echo '内容'; }
    				else if ($lang == 'Japanese') { echo '内容'; }
                    else if ($lang == 'Russian') { echo 'Содержание'; }
    				else { echo 'Contents'; }
    			?></h2>
                <?php
                    // With JavaScript disabled OR wr_old_layout cookie set, show links to all games and player search
                    if ($layout == 'New') {
                        echo '<div id="contents_new" class="border"><p id="overall_link"><a href="#overall" ' .
                        'class="overallrecords">' . tl_term('Overall Records', $lang) . '</a></p>' .
                        '<p id="overall_linkm"><a href="#overallm" class="overallrecords">' . tl_term('Overall Records', $lang) .
                        '</a></p><p><a href="#wrs" class="worldrecords">' . tl_term('World Records', $lang) . '
                        </a></p><p id="recent_link"><a href="#recent" class="recentrecords">' . tl_term('Recent Records', $lang) .
                        '</a></p><p id="recent_linkm"><a href="#recentm" class="recentrecords">' . tl_term('Recent Records', $lang) .
                        '</a></p><p><a href="#players" class="playerranking">' . tl_term('Player Ranking', $lang) .
                        '</a></p><p><a href="#acks" class="ack">' . tl_term('Acknowledgements', $lang) .
                        '</a></p></div><noscript>';
                    }
                    echo '<div id="contents" class="border"><p id="overall_linkn"><a href="#overall" ' .
                    'class="overallrecords">' . tl_term('Overall Records', $lang) . '</a></p>' .
                    '<p id="overall_linkmn"><a href="#overallm" class="overallrecords">' . tl_term('Overall Records', $lang) .
                    '</a></p><p><a href="#wrs" class="worldrecords">' . tl_term('World Records', $lang) . '
                    </a></p>';
                    foreach ($wr as $game => $value) {
                        echo '<p><a href="#' . $game . '">' . full_name($game, $lang) . '</a></p>';
                    }
                    echo '<p id="westernlink"><a href="#western">' . tl_term('Western Records', $lang) . '</a></p>';
                    echo '<p id="playersearchlink"><a href="#playerwrs">' . player_search($lang) . '</a></p>';
                    echo '<p id="recent_linkn"><a href="#recent" class="recentrecords">' . tl_term('Recent Records', $lang) .
                    '</a></p>';
                    echo '<p id="recent_linkmn"><a href="#recentm" class="recentrecords">' . tl_term('Recent Records', $lang) .
                    '</a></p>';
                    echo '<p><a href="#players" class="playerranking">' . tl_term('Player Ranking', $lang) . '</a></p>';
                    echo '<p><a href="#acks" class="ack">' . tl_term('Acknowledgements', $lang) . '</a></p></div>';
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
                                if ($game == 'StB' || $game == 'DS') {
                                    continue;
                                }
    							$num = num($game);
    							echo '<tr id="' . $game . 'o"><td>' . $num . '</td><td class="' . $game . '">' . game_tl($game, $lang) . '</td>';
    							echo '<td id="' . $game . 'overall0">' . ($game == 'WBaWC' ? '<span class="cs">9,999,999,990' .
                                '<span class="tooltip truescore">' . number_format($overall[$num], 0, '.', ',') .
                                '</span></span> ' : number_format($overall[$num], 0, '.', ',')) . '</td>';
                                echo '<td id="' . $game . 'overall1">' . ($overall[$num] == 0 ? '-' : $overall_player[$num]) . ($game == 'WBaWC' ? '*' : '') . '</td>';
    							echo '<td id="' . $game . 'overall2">' . ($overall[$num] == 0 ? '-' : $overall_diff[$num]) . '</td>';
    							echo '<td id="' . $game . 'overall3">' . ($overall[$num] == 0 ? '-' : tl_shot($overall_shottype[$num], $lang)) . '</td>';
    							echo '<td id="' . $game . 'overall4" class="datestring">' . ($overall[$num] == 0 ? '-' : date_tl($overall_date[$num], $notation)) . '</td></tr>';
    						}
    					?>
                    </table>
                    <p>* Players that have scored 9,999,999,990:
                        <?php
                            $str = '';
                            foreach ($cs as $player => $value) {
                                $str .= ', <span class="cs">' . $player . '<span class="tooltip truescores">';
                                if (gettype($value[0]) == 'array') {
                                    $substr = '';
                                    foreach ($value as $key => $val) {
                                        $substr .= tl_shot($val[2], $lang) . ($lang == 'English' ? ' ' : '') . $val[0] .
                                        ($lang == 'English' ? ' (' : '（') . date_tl($val[1], $notation) .
                                        ($lang == 'English' ? ')' : '）') . '<br>';
                                    }
                                    $str .= $substr;
                                } else {
                                    $str .= tl_shot($value[2], $lang) . ($lang == 'English' ? ' ' : '') . $value[0] .
                                    ($lang == 'English' ? ' (' : '（') . date_tl($value[1], $notation) .
                                    ($lang == 'English' ? ')' : '）') . '<br>';
                                }
                                $str .= '</span></span>';
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
                            if ($game == 'StB' || $game == 'DS') {
                                continue;
                            }
    						$num = num($game);
    						echo '<p class="' . $game . ' count">' . game_tl($game, $lang) . '</p><p>';
                            echo '<span id="' . $game . 'overall0m">' . ($game == 'WBaWC' ? '<span class="cs">9,999,999,990' .
                            '<span class="tooltip truescore">' . number_format($overall[$num], 0, '.', ',') .
                            '</span></span> ' : number_format($overall[$num], 0, '.', ',')) . '</span> ';
    						echo '<span id="' . $game . 'overall2m">' . ($overall[$num] == 0 ? '-' : $overall_diff[$num]) . '</span> ';
    						echo '<span id="' . $game . 'overall3m">' . ($overall[$num] == 0 ? '-' : tl_shot($overall_shottype[$num], $lang)) . '</span> by ';
    						echo '<span id="' . $game . 'overall1m"><em>' . ($overall[$num] == 0 ? '-' : $overall_player[$num]) . ($game == 'WBaWC' ? '*' : '') . '</em></span> ';
    						echo '<br><span id="' . $game . 'overall4m" class="datestring">' . ($overall[$num] == 0 ? '-' : date_tl($overall_date[$num], $notation)) . '</span></p><hr>';
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
                    $sheet = '_1';
                    $diff_key = 'Easy';
                    foreach ($wr as $game => $obj) {
                        if ($game == 'MoF' || $game == 'GFW') {
                            $sheet = '_2';
                            $diff_key = 'Easy';
                        } else if ($game == 'StB' || $game == 'DS') {
                            $diff_key = '1';
                        }
                        echo '<div id="' . $game . '">';
                        echo '<table id="' . $game . '_table" class="' . $game .
                        't sortable"><caption><p><span id="' . $game . '_image_old" ' .
                        'class="cover sheet' . $sheet . (num($game) <= 5 ? ' cover98' : '') .
                        '"></span> ' . full_name($game, $lang) . '</p></caption>' .
                        '<tr><th>' . tl_term(shot_route($game), $lang) . '</th>';
                        foreach ($obj as $diff => $shots) {
                            if ($game != 'GFW' || $diff != 'Extra') {
                                echo '<th>' . $diff . '</th>';
                            }
                        }
                        echo '</tr>';
                        for ($i = 0; $i < sizeof($obj[$diff_key]); $i++) {
                            $shot = array_keys($obj[$diff_key])[$i];
                            echo '<tr><td>' . format_shot($game, $shot, $lang) . '</td>';
                            for ($j = 0; $j < sizeof($obj); $j++) {
                                $diff = array_keys($obj)[$j];
                                $shots = $obj[array_keys($obj)[$j]];
                                if (isset($shots[$shot])) {
                                    $score = $shots[$shot][0];
                                    $player = $shots[$shot][1];
                                    $date = $shots[$shot][2];
                                } else {
                                    $score = 0;
                                    $player = '';
                                    $date = '';
                                }
                                if ($game == 'GFW' && $diff == 'Extra') {
                                    break;
                                } else if ($game == 'HSiFS' && $diff == 'Extra') {
                                    if (strpos($shot, 'Spring')) {
                                        $shot = substr($shot, 0, -6);
                                        $score = number_format($shots[$shot][0], 0, '.', ',');
                                        if (file_exists(replay_path($game, $diff, $shot))) {
                                            $score = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score . '</a>';
                                        }
                                        echo '<td rowspan="4">' . $score . '<br>by <em>' . $shots[$shot][1] .
                                        '</em><span class="dimgrey"><br><span class="datestring_game"' .
                                        '>' . date_tl($shots[$shot][2], $notation) . '</span></span></td>';
                                    }
                                } else {
                                    if ($score >= $MAX_SCORE) {
                                        $score_text = '<span class="cs">' . number_format($MAX_SCORE, 0, '.', ',') .
                                        '<span class="tooltip">' . number_format($score, 0, '.', ',') . '</span></span>';
                                    } else {
                                        $score_text = number_format($score, 0, '.', ',');
                                    }
                                    if (file_exists(replay_path($game, $diff, $shot))) {
                                        $score_text = '<a class="replay" href="' . replay_path($game, $diff, $shot) . '">' . $score_text . '</a>';
                                    }
                                    if ($score == $overall[num($game)] && $game != 'StB' && $game != 'DS') {
                                        $score_text = '<strong>' . $score_text . '</strong>';
                                    }
                                    if ($score == $diff_max[$game][$diff][0] && $game != 'StB' && $game != 'DS') {
                                        $score_text = '<u>' . $score_text . '</u>';
                                    }
                                    if ($score == 0) {
                                        echo '<td></td>';
                                    } else {
                                        echo '<td>' . $score_text . '<br>by <em>' . $player . '</em><span class="dimgrey"><br>' .
                                        '<span class="datestring_game">' . date_tl($date, $notation) . '</span></span></td>';
                                    }
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
                        echo '</table></div>';
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
                        if ($lang == 'Chinese') { echo '单击游戏处查看世界纪录列表。'; }
                        else if ($lang == 'Japanese') { echo '世界記録リストはゲームをクリック。'; }
                        else if ($lang == 'Russian') { echo 'Нажмите на обложку игры для получения ее списка рекордов.'; }
                        else { echo 'Click a game cover to show its list of world records.'; }
                        echo '</p>';
                        $second_row = false;
        			    foreach ($wr as $game => $value) {
                            if ($game == 'MoF') {
                                $second_row = true;
                                echo '<br>';
                            }
                            if (!$second_row) {
                                echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_1"></span>' .
                                '<span class="full_name tooltip">' . full_name($game, $lang) . '</span></span>';
                            } else {
                                echo '<span class="game_image"><span id="' . $game . '_image" class="game_img sheet_2"></span>' .
                                '<span class="full_name tooltip">' . full_name($game, $lang) . '</span></span>';
                            }
                        }
                        echo '</div>';
                    }
    			?>
    			<div id='list'>
    			</div>
                <div id='playersearch'>
        			<?php
                        echo '<h2>' . player_search($lang) . '</h2><p id="playerwrs">';
        				if ($lang == 'Chinese') { echo '在以下的菜单选择玩家的名字则可查看其WR。'; }
                        else if ($lang == 'Japanese') { echo '個人のWRを表示するには、下記のメニューからプレイヤー名を選んでください。'; }
                        else if ($lang == 'Russian') { echo 'Выберите имя игрока из меню ниже чтобы получить список его мировых рекордов.'; }
                        else { echo 'Choose a player name from the menu below to show their WRs.'; }
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
                            <th class='category'><?php echo tl_term('Category', $lang) ; ?></th>
                            <th class='score'><?php echo tl_term('Score', $lang); ?></th>
                            <th class='replay'><?php echo tl_term('Replay', $lang); ?></th>
                            <th class='datestring'><?php echo tl_term('Date', $lang); ?></th>
                        </tr></thead>
    					<tbody id='playerlistbody'></tbody>
    					<tfoot id='playerlistfoot'></tfoot>
    				</table>
    			</div>
                <div id='recent'>
                    <h2><?php echo tl_term('Recent Records', $lang); ?></h2>
                    <table class='sortable'>
                        <thead id='recenthead'><tr>
                            <th class='category'><?php echo tl_term('Category', $lang) ; ?></th>
                            <th class='score'><?php echo tl_term('Score', $lang); ?></th>
                            <th class='player'><?php echo tl_term('Player', $lang); ?></th>
                            <th class='replay'><?php echo tl_term('Replay', $lang); ?></th>
                            <th class='datestring'><?php echo tl_term('Date', $lang); ?></th>
                        </tr></thead>
                        <tbody id='recentbody'><?php
                            foreach ($recent as $key => $obj) {
                                if (file_exists(replay_path($obj->game, $obj->diff, $obj->shot))) {
                                    $path = replay_path($obj->game, $obj->diff, $obj->shot);
                                    $replay = '<a href="' . $path . '">' . substr($path, 8) . '</a>';
                                } else {
                                    $replay = '-';
                                }
                                echo '<tr><td class="' . $obj->game . 'p">' . game_tl($obj->game . ' ', $lang) .
                                '' . $obj->diff . category_sep($lang) . tl_shot($obj->shot, $lang) . '</td>' .
                                '<td>' . number_format($obj->score, 0, '.', ',') . '</td><td>' . $obj->player . '</td>' .
                                '<td>' . $replay . '</td><td>' . date_tl($obj->date, $notation) . '</td></tr>';
                            }
                        ?></tbody>
                    </table>
                </div>
                <div id='recentm'>
                    <h2><?php echo tl_term('Recent Records', $lang); ?></h2>
                    <?php
                        foreach ($recent as $key => $obj) {
                            echo '<hr>';
                            if (file_exists(replay_path($obj->game, $obj->diff, $obj->shot))) {
                                $path = replay_path($obj->game, $obj->diff, $obj->shot);
                                $replay = '<a href="' . $path . '">' . substr($path, 8) . '</a>';
                            } else {
                                $replay = '-';
                            }
                            echo game_tl($obj->game . ' ', $lang) . ' ' . $obj->diff . category_sep($lang) .
                            '' . tl_shot($obj->shot, $lang) . '<br>' . number_format($obj->score, 0, '.', ',') .
                            ' by ' . $obj->player . ' on ' . date_tl($obj->date, $notation) . '';
                        }
                    ?><hr>
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
                <h2 id='acks' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></h2>
                <div id='ack_container'>
                    <p id='jptlcredit'>
                        <?php
                            if ($lang == 'Chinese') {
                                echo '感谢<a href="https://twitter.com/toho_yumiya">Yu-miya</a>提供头部文字的日语翻译。';
                            } else if ($lang == 'Japanese') {
                                echo 'ページ上部のテキストは<a href="https://twitter.com/toho_yumiya">ゆーみや</a>' .
                                'によって日本語に翻訳されました。';
                            } else if ($lang == 'Russian') {
                                echo 'Японский перевод сделал <a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                            } else {
                                echo 'The Japanese translation of the top text was done by ' .
                                '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                            }
                        ?>
                    </p>
                    <p id='cntlcredit'>
                        <?php
                            if ($lang == 'Chinese') {
                                echo '感谢<a href="https://twitter.com/williewillus">williewillus</a>提供头部文字的中文翻译。';
                            } else if ($lang == 'Japanese') {
                                echo 'ページ上部のテキストは<a href="https://twitter.com/williewillus">williewillus</a>' .
                                'によって中国語に翻訳されました。';
                            } else if ($lang == 'Russian') {
                                echo 'Китайский перевод сделал <a href="https://twitter.com/williewillus">williewillus</a>.';
                            } else {
                                echo 'The Chinese translation of the top text was done by ' .
                                '<a href="https://twitter.com/williewillus">williewillus</a>.';
                            }
                        ?>
                    </p>
                    <p id='rutlcredit'>
                        <?php
                            if ($lang == 'Chinese') {
                                echo '感谢<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>提供头部文字的俄语翻译。';
                            } else if ($lang == 'Japanese') {
                                echo 'ページ上部のテキストは<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>' .
                                'によってロシア語に翻訳されました。';
                            } else if ($lang == 'Russian') {
                                echo 'Русский перевод сделал <a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>.';
                            } else {
                                echo 'The Russian translation of the top text was done by ' .
                                '<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>.';
                            }
                        ?>
                    </p>
    				<p id='ack_mobile'>
                        <?php
                            if ($lang == 'Chinese') {
                                echo '背景画师：<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>。';
                            } else if ($lang == 'Japanese') {
                                echo '背景イメージは<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">' .
                                'Catboyjeremie</a>さんのものを使用させていただいております。';
                            } else if ($lang == 'Russian') {
								echo 'Иллюстрацию на фоне нарисовал(а) ' .
								'<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>.';
							} else {
                                echo 'The background image was drawn by ' .
                                '<a href="https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ">Catboyjeremie</a>.';
                            }
                        ?>
    				</p>
                </div>
                <p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
    			<?php echo '<input id="missingReplays" type="hidden" value="' . implode('', $missing_replays) . '">' ?>
    		</div>
        </main>
    </body>
</html>
