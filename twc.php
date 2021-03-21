<!DOCTYPE html>
<html id='top' lang='<?php if (empty($_GET['hl'])) { echo 'en'; } else { echo str_replace('jp', 'ja', $_GET['hl']); } ?>'>
<?php
	include 'assets/shared/shared.php';
	include 'assets/twc/twc.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

    <head>
		<title>Touhou World Cup</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Main webpage for Touhou World Cup, containing the schedule, rules and other relevant information.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, world cup, touhou world cup, twc, 2020, 2021, competition, scoring, survival, tournament'>
		<link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=twc'>
		<link rel='icon' type='image/x-icon' href='assets/twc/twc.ico'>
        <script src='assets/shared/js_concat.php?page=twc' defer></script>
        <?php echo dark_theme() ?>
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
							if ($lang == 'Chinese') { echo 'This background image <br id="ack_br">was drawn by ' .
							'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>'; }
							else if ($lang == 'Japanese') { echo '背景イメージは' .
							'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>さんのものを使用させていただいております'; }
							else { echo '背景画师：' .
							'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>'; }
						?>
					</p>
					<span id='hy_container'>
	                    <img id='hy' src='assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
				        <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
	                </span>
					<div id='languages'>
	                    <a id='en' class='flag' href='twc?hl=en'>
	                        <img class='flag_en' src='assets/flags/uk.png' alt='<?php echo tl_term('Flag of the United Kingdom', $lang) ?>'>
	                        <p class='language'>English</p>
	                    </a>
	                    <a id='jp' class='flag' href='twc?hl=jp'>
	                        <img src='assets/flags/japan.png' alt='<?php echo tl_term('Flag of Japan', $lang) ?>'>
	                        <p class='language'>日本語</p>
	                    </a>
	                    <a id='zh' class='flag' href='twc?hl=zh'>
	                        <img src='assets/flags/china.png' alt='<?php echo tl_term('Flag of the P.R.C.', $lang) ?>'>
	                        <p class='language'>简体中文</p>
	                    </a>
		            </div>
				</div>
                <p id='ack'></p>
                <h1>Touhou World Cup</h1>
				<?php
					if ($lang == 'Chinese') {
						echo '<p><strong>Touhou World Cup (TWC)</strong>东方世界杯是一场每年一度的东方STG游戏比赛，' .
						'世界杯的第一场在2020由中国玩家群体主办, 而今年2021，TWC由西方玩家群体所筹办。</p><p>东方世界杯有三支参赛队伍，' .
						'西方队，中国队和日本队，三支队伍将在东方弹幕作的Lunatic与Extra模式中一决雌雄，' .
						'在避弹和打分两个环节上激烈对抗。</p><p>关于我们的官方社交媒体，解说流，时间表以及玩家需要遵守的规则，请往下读。</p>';
					} else if ($lang == 'Japanese') {
						echo '<p><strong>Touhou World Cup (TWC)</strong>は年に一度行われる東方STGの世界大会です。' .
						'第1回は2020年に中国の東方コミュニティ主催により開催され、' .
						'第2回となる2021年は西洋の東方コミュニティ主催により開催されます。</p>' .
						'<p>各試合は中国、日本、西洋3チームのオンライン同時並走により行われ、難易度Lunatic、' .
						'Extraのスコアアタック部門やサバイバル部門で競い合います。</p>' .
						'<p>公式ツイッター及びYouTubeチャンネル、各言語による解説音声付き配信チャンネル、スケジュール、プレイヤー一覧は以下をご覧ください。</p>';
					} else {
						echo '<strong>Touhou World Cup (TWC)</strong> is an annual international Touhou shooting game competition,' .
						'first held in 2020, organised by the Chinese gameplay community.' .
						'This time around, in 2021, it is organised by the Western gameplay community.</p>' .
						'<p>Three teams, a Western community team, a Chinese team, and a Japanese team, duke it out' .
						'on Lunatic and Extra mode, playing on live streams and playing both high score and survival.</p>' .
						'<p>See below for official communication channels, live streams with commentary, the schedule, ' .
						'and the rules the players play by.</p>';
					}
				?>
				<div id='links'>
					<?php
						echo '<p><img class="icon twitter_icon" src="assets/shared/icon_sheet.png" alt="Twitter icon">';
						if ($lang == 'Chinese') { echo '<a href="https://twitter.com/touhouworldcup">TWC的官方推特</a>'; }
						else if ($lang == 'Japanese') { echo '<a href="https://twitter.com/touhouworldcup">公式ツイッター</a>'; }
						else { echo '<a href="https://twitter.com/touhouworldcup">Official TWC Twitter</a>'; }
						echo '</p><p><img class="icon youtube_icon" src="assets/shared/icon_sheet.png" alt="YouTube icon">';
						if ($lang == 'Chinese') {
							echo '<a href="https://www.youtube.com/channel/UCk8o-jk-Zpn4CEmLUIkui0A">TWC的官方YouTube频道</a>';
						} else if ($lang == 'Japanese') {
							echo '<a href="https://www.youtube.com/channel/UCk8o-jk-Zpn4CEmLUIkui0A">公式YouTubeチャンネル</a>';
						} else {
							echo '<a href="https://www.youtube.com/channel/UCk8o-jk-Zpn4CEmLUIkui0A">Official TWC YouTube Channel</a>';
						}
						echo '</p><p><img src="assets/flags/uk16x16.png" alt="Flag of the United Kingdom">';
						if ($lang == 'Chinese') {
							echo '<a href="https://www.twitch.tv/touhou_replay_showcase">英文流解说（Twitch）</a>';
						} else if ($lang == 'Japanese') {
							echo '<a href="https://www.twitch.tv/touhou_replay_showcase">英語解説付き配信チャンネル(Twitch)</a>';
						} else {
							echo '<a href="https://www.twitch.tv/touhou_replay_showcase">English commentary stream (Twitch)</a>';
						}
						echo '</p><p><img src="assets/flags/cn16x16.png" alt="Flag of the P.R.C.">';
						if ($lang == 'Chinese') {
							echo '<a href="https://live.bilibili.com/22478102?share_source=copy_link">一号中文流解说（Bilibili)</a><br>';
						} else if ($lang == 'Japanese') {
							echo '<a href="https://live.bilibili.com/22478102?share_source=copy_link">中国語解説付き配信チャンネル１(Bilibili)</a><br>';
						} else {
							echo '<a href="https://live.bilibili.com/22478102?share_source=copy_link">Chinese commentary stream 1 (Bilibili)</a><br>';
						}
						echo '<img src="assets/flags/cn16x16.png" alt="Flag of the P.R.C.">';
						if ($lang == 'Chinese') {
							echo '<a href="https://live.bilibili.com/14315174?share_source=copy_link">二号中文流解说（Bilibili)</a>';
						} else if ($lang == 'Japanese') {
							echo '<a href="https://live.bilibili.com/14315174?share_source=copy_link">中国語解説付き配信チャンネル２(Bilibili)</a>';
						} else {
							echo '<a href="https://live.bilibili.com/14315174?share_source=copy_link">Chinese commentary stream 2 (Bilibili)</a>';
						}
						echo '</p><p><img src="assets/flags/jp16x16.png" alt="Flag of Japan">';
						if ($lang == 'Chinese') {
							echo '<a href="https://www.youtube.com/channel/UCfF3O4wo0YxppTZGmtTGDwg">日文流解说（YouTube）</a>';
						} else if ($lang == 'Japanese') {
							echo '<a href="https://www.youtube.com/channel/UCfF3O4wo0YxppTZGmtTGDwg">日本語解説付き配信チャンネル</a>';
						} else {
							echo '<a href="https://www.youtube.com/channel/UCfF3O4wo0YxppTZGmtTGDwg">Japanese commentary stream (YouTube)</a>';
						}
						echo '</p><p><img src="assets/flags/ru16x16.png" alt="Flag of the Russian Federation">';
						if ($lang == 'Chinese') {
							echo '<a href="https://www.twitch.tv/touhou_russian_kolkhoz">俄文流解说（Twitch）</a>';
						} else if ($lang == 'Japanese') {
							echo '<a href="https://www.twitch.tv/touhou_russian_kolkhoz">ロシア語解説付き配信チャンネル</a>';
						} else {
							echo '<a href="https://www.twitch.tv/touhou_russian_kolkhoz">Russian commentary stream (Twitch)</a>';
						}
						echo '</p>';
					?>
				</div>
                <h2 id='contents'><?php
					if ($lang == 'Chinese') { echo '目录'; }
					else if ($lang == 'Japanese') { echo 'コンテンツ'; }
					else { echo 'Contents'; }
				?></h2>
                <div id='contents_div' class='border'>
                    <p><a href='#schedule'><?php
						if ($lang == 'Chinese') { echo '时间表'; }
						else if ($lang == 'Japanese') { echo 'スケジュール'; }
						else { echo 'Schedule'; }
					?></a></p>
                    <p><a href='#rules'><?php
						if ($lang == 'Chinese') { echo '规则'; }
						else if ($lang == 'Japanese') { echo 'ルール'; }
						else { echo 'Rules'; }
					?></a></p>
                </div>
				<h2 id='schedule'><?php
					if ($lang == 'Chinese') { echo '时间表'; }
					else if ($lang == 'Japanese') { echo 'スケジュール'; }
					else { echo 'Schedule'; }
				?></h2>
				<p><?php
					if ($lang == 'Chinese') {
						echo '我们检测到您的时区是<span id="timezone"></span>。';
					} else if ($lang == 'Japanese') {
						echo '表示されているタイムゾーンは<span id="timezone"></span>です。';
					} else {
						echo 'Your time zone was detected as <span id="timezone"></span>.';
					}
				?></p>
				<p><?php
					if ($lang == 'English') {
						echo 'Daylight Saving Time (also known as Summer Time or DST) is taken into account automatically.';
					}
				?></p>
				<table id='schedule_table'>
					<thead>
						<tr>
							<th rowspan='3'><?php
								if ($lang == 'Chinese') { echo '日期/时间'; }
								else if ($lang == 'Japanese') { echo '日付と時間'; }
								else { echo 'Date/Time'; }
							?></th>
							<th rowspan='3'><?php
								if ($lang == 'Chinese') { echo '项目'; }
								else if ($lang == 'Japanese') { echo 'カテゴリー'; }
								else { echo 'Category'; }
							?></th>
							<th rowspan='3'><?php
								if ($lang == 'Chinese') { echo '玩家'; }
								else if ($lang == 'Japanese') { echo 'プレイヤー'; }
								else { echo 'Players'; }
							?></th>
							<th rowspan='3'><?php
								if ($lang == 'Chinese') { echo 'Reset Time<br>（分钟）'; }
								else if ($lang == 'Japanese') { echo 'リセットのタイマー（分）'; }
								else { echo 'Reset Time<br>(minutes)'; }
							?></th>
						</tr>
					</thead>
					<tbody id='schedule_tbody'>
					</tbody>
				</table>
				<h2 id='rules'><?php
					if ($lang == 'Chinese') { echo '规则'; }
					else if ($lang == 'Japanese') { echo 'ルール'; }
					else { echo 'Rules'; }
				?></h2>
				<h3><?php
					if ($lang == 'Chinese') { echo '比赛形式'; }
					else if ($lang == 'Japanese') { echo '概要'; }
					else { echo 'Format'; }
				?></h3>
				<p><?php
					if ($lang == 'Chinese') {
						echo '每场比赛以选手比赛中获得的最高积分进行排名，同时选手所在队伍获得相应的总分。';
					} else if ($lang == 'Japanese') {
						echo '各試合の順位によって各チームはポイントを獲得します。各試合の順位はISCORE（ISCOREについての欄を参照）' .
						'の高い順に決定されます。獲得ポイントは以下の通りです。';
					} else {
						echo 'For every match, each team can earn points. Ranking is based on whoever has the most points:';
					}
				?></p>
				<ul>
					<li><?php
						if ($lang == 'Chinese') { echo '冠军：2总分(避免负分歧义)'; }
						else if ($lang == 'Japanese') { echo '１位　２ポイント'; }
						else { echo '1st place - 2 pts'; }
					?></li>
					<li><?php
						if ($lang == 'Chinese') { echo '亚军：1总分'; }
						else if ($lang == 'Japanese') { echo '２位　１ポイント'; }
						else { echo '2nd place - 1 pt'; }
					?></li>
					<li><?php
						if ($lang == 'Chinese') { echo '季军：0总分'; }
						else if ($lang == 'Japanese') { echo '３位　０ポイント'; }
						else { echo '3rd place - 0 pts'; }
					?></li>
				</ul>
				<p><?php
					if ($lang == 'Chinese') {
						echo '即使是二人战，双方也按照以上描述得分，不参与队伍算季军。';
					} else if ($lang == 'Japanese') {
						echo 'なお２チームのみが出場する試合においては、１位が２ポイント、２位が１ポイントの獲得となります。';
					} else {
						echo 'In 2-team matches, the first place gets 2 points, and 2nd place gets 1 point.';
					}
				?></p>
				<p><?php
					if ($lang == 'Chinese') {
						echo '如果一个以上的玩家获得了同样的甜品站分数，他们将会得到同样的积分，' .
						'这同时意味着如果多人获得了同样的最高分，那么本场比赛将会为平局。';
					} else if ($lang == 'Japanese') {
						echo 'また、複数のチームが同じISCOREを獲得した場合は、チームへの獲得ポイントを分け合います' .
						'（例：２チームが同じISCOREを獲得し１位となった場合、トータル３ポイントを分け合い1.5ポイントずつを獲得します）';
					} else {
						echo 'If multiple players have the exact same amount of ISCORE, their points will be split equally. ' .
						'This also means that, if multiple players have the highest ISCORE, the match ends in a tie.';
					}
				?></p>
				<p><?php
					if ($lang == 'Chinese') {
						echo '在世界杯结束的时候，队伍将会按照积分排名。';
					} else if ($lang == 'Japanese') {
						echo '全試合終了後、獲得ポイントの多い順に順位が決定されます。';
					} else {
						echo 'At the end of the World Cup, the teams will be ranked based on has the most points.';
					}
				?></p>
				<h3><?php
					if ($lang == 'Chinese') { echo '计算积分'; }
					else if ($lang == 'Japanese') { echo 'ISCOREについて'; }
					else { echo 'Calculating Points'; }
				?></h3>
				<p><?php
					if ($lang == 'Chinese') {
						echo '积分使用<a href="https://www.isndes.com/jf">甜品站积分计</a>' .
						'算器计算，计算公式可上甜品站查看，大战争避弹除外（后述）。';
					} else if ($lang == 'Japanese') {
						echo '各試合で獲得するISCOREはISCORE Calculatorにより定められます。' .
						'(画面右上、右から4番目の「A文」と書かれたマークからEnglishに変更後、画面右上のAbout ISCOREの欄を参照)';
					} else {
						echo 'The points are based on the ' .
						'<a href="https://www.isndes.com/jf">ISCORE calculator</a> (see the "About ISCORE" link ' .
						'in the top right after changing to English via the language icon, fourth from the right).';
					}
				?></p>
				<p><?php
					if ($lang == 'Japanese') {
						echo 'スコアアタックマッチではISCORE Calculatorの計算結果により、' .
						'サバイバルマッチ（妖精大戦争を除く）では以下の計算式によりISCOREが決定されます。';
					} else if ($lang == 'English') {
						echo 'Score matches are calculated based on the ISCORE formula. ' .
						'Survival matches (except for GFW) are calculated as follows:';
					}
				?></p>
				<p><tt><?php
					if ($lang == 'Chinese') { echo '（甜品站积分 NMNB分数）*0.5^（死亡数）'; }
					else if ($lang == 'Japanese') { echo '(ISCORE表内のNNの値)*0.5^(被弾数)'; }
					else { echo '(ISCORE No Miss No Bomb Score)*0.5^(deaths)'; }
				?></tt></p>
				<p><?php
					if ($lang == 'Chinese') { echo '全作避弹项目中，丢雷算2 miss。'; }
					else if ($lang == 'Japanese') { echo 'サバイバルマッチではボムの使用は２被弾としてカウントされます。'; }
					else { echo 'In survival runs, bombs are counted as 2 deaths.'; }
				?></p>
				<p><?php
					if ($lang == 'Chinese') {
						echo '甜品站分数是可以将不同比赛的差异得分进行修补整合的打分矩阵，您可以点击上面的甜品站计算器来查看所用的公式。';
					} else if ($lang == 'Japanese') {
						echo 'ISCOREはショットタイプによる性能の差を補完するために開発された評価手法です。'.
						'計算方法は上記のAbout ISCOREからご覧いただけます。';
					} else {
						echo 'ISCORE is a scoring metric that compensates for the differences in performance ' .
						'between shot types and categories. The formulas used can be found in the ISCORE rubric ' .
						'with the calculator linked above.';
					}
				?></p>
				<h3><?php
					if ($lang == 'Chinese') { echo '额外提醒'; }
					else if ($lang == 'Japanese') { echo '作品固有のルール'; }
					else { echo 'Game-specific Concerns'; }
				?></h3>
				<h4><?php
					if ($lang == 'Chinese') { echo '妖妖梦'; }
					else if ($lang == 'Japanese') { echo '東方妖々夢　～ Perfect Cherry Blossom.'; }
					else { echo 'Touhou 7'; }
				?></h4>
				<p><?php
					if ($lang == 'Chinese') { echo '灵击，无论主动还是被动，都算1 miss。'; }
					else if ($lang == 'Japanese') { echo 'サバイバルマッチにおいて霊撃は被弾として扱われます。'; }
					else { echo 'A border break is considered a death in survival runs.'; }
				?></p>
				<h4><?php
					if ($lang == 'Chinese') { echo '永夜抄'; }
					else if ($lang == 'Japanese') { echo '東方永夜抄　～ Imperishable Night.'; }
					else { echo 'Touhou 8'; }
				?></h4>
				<p><?php
					if ($lang == 'Chinese') {
						echo 'LSC被弹不算1 miss。积分只在LNN的情况下才考虑全卡，LNNFS会获得额外积分。';
					}
					else if ($lang == 'Japanese') {
						echo 'サバイバルマッチにおいて、ラストスペルでの被弾はISCOREに影響を与えません。'.
						'ただし、全てのラストスペルを出現させ取得し、かつ、ノーミスノーボムを達成した場合にのみ、' .
						'より高いISCOREが与えられます（ISCORE CalculatorのFull-SC欄を参照）。';
					}
					else {
						echo 'Getting hit during a Last Spell is <strong>not</strong> considered a death in survival runs. '.
						'However, ISCORE gives a higher base value in this game to runs that capture all spells ' .
						'(which includes unlocking and capturing <strong>every</strong> Last Spell) AND do not die/bomb ' .
						'(NN + Full-SC).';
					}
				?></p>
				<h4><?php
					if ($lang == 'Chinese') { echo '星莲船'; }
					else if ($lang == 'Japanese') { echo '東方星蓮船　～ Undefined Fantastic Object.'; }
					else { echo 'Touhou 12'; }
				?></h4>
				<p>
				</p>
				<p><?php
					if ($lang == 'Chinese') {
						echo '开碟算1 miss。收碟碎片不影响miss数。';
					} else if ($lang == 'Japanese') {
						echo 'サバイバルマッチではUFOの召喚を被弾として扱います。ただし、ベントラーの取得はISCOREに影響を与えません。';
					} else {
						echo 'Summoning a UFO is considered a death in survival runs. ' .
						'However, collecting tokens does not affect the score in survival runs.';
					}
				?></p>
				<h4><?php
					if ($lang == 'Chinese') { echo '妖精大战争'; }
					else if ($lang == 'Japanese') { echo '妖精大戦争　～ 東方三月精'; }
					else { echo 'Touhou 12.8'; }
				?></h4>
				<p></p>
				<p><?php
					if ($lang == 'Chinese') { echo '使用冰冻技能不算miss。避弹公式是（金牌数*1.5）-（miss数）。'; }
					else if ($lang == 'Japanese') { echo 'この作品でのサバイバルマッチでの計算式は以下です。(金メダル獲得数*1.5)-(被弾数)'; }
					else { echo 'The survival formula for this game is (gold medals*1.5)-(deaths).'; }
				?></p>
				<h4><?php
					if ($lang == 'Chinese') { echo '神灵庙'; }
					else if ($lang == 'Japanese') { echo '東方神霊廟　～ Ten Desires.'; }
					else { echo 'Touhou 13'; }
				?></h4>
				<p><?php
					if ($lang == 'Chinese') {
						echo '主动开灵界算2 miss，被动灵界不算作miss，且可以在被动灵界中开枪积分只在LNNN的情况下才考虑全卡，LNNNFS会获得额外积分。';
					} else if ($lang == 'Japanese') {
						echo '任意トランスはサバイバルマッチでは２被弾として扱われます。また、全スペルカードを取得し、' .
						'かつ、ノーミスノーボムを達成した場合にのみ、より高いISCOREが与えられます（ISCORE CalculatorのFull-SC欄を参照）。';
					} else {
						echo 'A manual trance is considered 2 deaths in survival runs.' .
						'ISCORE gives a higher base value in this game to runs that capture all spells AND does not die/bomb ' .
						'(NN + Full-SC).';
					}
				?></p>
				<h4><?php
					if ($lang == 'Chinese') { echo '绀珠传'; }
					else if ($lang == 'Japanese') { echo '東方紺珠伝　～ Legacy of Lunatic Kingdom.'; }
					else { echo 'Touhou 15'; }
				?></h4>
				<p><?php
					if ($lang == 'Chinese') { echo '避弹打分都必须使用传统模式。'; }
					else if ($lang == 'Japanese') { echo 'サバイバルマッチ、スコアアタックマッチともに完全無欠モードでプレイすることは禁止されています。'; }
					else { echo 'All runs in both survival/score have to be done in Legacy Mode.'; }
				?></p>
				<h4><?php
					if ($lang == 'Chinese') { echo '天空璋'; }
					else if ($lang == 'Japanese') { echo '東方天空璋　～ Hidden Star in Four Seasons.'; }
					else { echo 'Touhou 16'; }
				?></h4>
				<p><?php
					if ($lang == 'Chinese') { echo '季节释放算2 miss。'; }
					else if ($lang == 'Japanese') { echo 'サバイバルマッチにおいて、季節解放は２被弾として扱われます。'; }
					else { echo 'Releasing your season gauge is considered 2 deaths in survival runs.'; }
				?></p>
				<h4><?php
					if ($lang == 'Chinese') { echo '鬼形兽'; }
					else if ($lang == 'Japanese') { echo '東方鬼形獣 ～ Wily Beast and Weakest Creature.'; }
					else { echo 'Touhou 17'; }
				?></h4>
				<p><?php
					if ($lang == 'Chinese') {
						echo '开暴走（吃了3个以上同样的动物灵）算2 miss。开正常hyper不算1 miss。灵击，无论主动还是被动，都算1 miss。';
					} else if ($lang == 'Japanese') {
						echo '同種の動物霊を３個以上集めることで発動する暴走ロアリングはサバイバルマッチでは２被弾として扱われます。' .
						'また、ロアリング中の霊撃（ボムボタン押下または被弾によるもの）はサバイバルマッチでは１被弾として扱われます。';
					} else {
						echo 'Channeling a berserk roar (3 or more of the same animal tokens during roar mode) ' .
						'is considered 2 deaths in survival runs. Breaking your roar ' .
						'(bombing or touching a bullet during roar mode) is considered a death in survival runs.';
					}
				?></p>
				<h3><?php
					if ($lang == 'Chinese') { echo '使用额外软件'; }
					else if ($lang == 'Japanese') { echo 'ツールやパッチの使用について'; }
					else { echo 'Use of Third Party Software &amp; Material'; }
				?></h3>
				<p><?php
					if ($lang == 'Chinese') {
						echo 'VP补丁允许使用。各种练习器都允许使用，但不能影响正式推把，也不能影响replay的正常播放。';
					} else if ($lang == 'Japanese') {
						echo 'パッチの使用は許可されています。試合中の練習のためにプラクティスツール（thprac等）を使用することは許可されていますが、' .
						'プラクティスツールを用いたプレイは無効とします。';
					} else {
						echo 'Vsync patch is allowed. Practice patches (such as thprac) are allowed, ' .
						'but all practice cheats have to be disabled for the runs.';
					}
				?></p>
				<p><?php
					if ($lang == 'Chinese') {
						echo '所有的贴图魔改一律禁止使用，包括红魔乡判定点补丁。翻译补丁（汉化版等）允许使用，但不推荐。' .
						'比赛时允许使用背景音乐魔改，或播自己的音乐，但必须保证没有任何版权问题。';
					} else if ($lang == 'Japanese') {
						echo '視覚面の変更を行うパッチ（当たり判定表示パッチなど）の使用は禁止されています。' .
						'翻訳パッチの使用は許可されていますが、非推奨です。オーディオパッチ（BGMの差し替え）' .
						'の使用は許可されていますが、ゲーム中もしくは著作権フリー以外の音楽の使用は禁止されています。';
					} else {
						echo 'Visual patches (e.g. hitbox patch) are prohibited. Translation patches are allowed but discouraged. ' .
						'Audio patches/background music is allowed but no copyrighted material.';
					}
				?></p>
				<h3><?php
					if ($lang == 'Chinese') { echo '其他规则'; }
					else if ($lang == 'Japanese') { echo 'その他のルール'; }
					else { echo 'Other Rules'; }
				?></h3>
				<ul>
					<?php
						if ($lang == 'Chinese') {
							echo '<li>比赛指定开始时间后的推把才算有效。</li>' .
							'<li>选手在比赛期间无限制推把，推把时间到了之后的推把无效。</li>' .
							'<li>比赛过程中，选手们必须全程直播游戏画面。' .
							'选手直播时请让游戏画面尽可能铺满直播画面，但请不要改变长宽比。</li>' .
							'<li>同时请选手们把游戏画面放在正中，减轻导播的负担。' .
							'游戏画面上可显示额外的图，按键，摄像头等，但不能遮挡任何信息（标题图以外）。</li>' .
							'<li>通关后要求选手们存rep，赛后提交最佳rep。</li>' .
							'<li>！！！特别注意！！！通关后选手们在直播画面不能显示ED画面（结局对话），可使用自选图遮挡。' .
							'请尽量遵守官方近期更新的东方使用规则。</li>';
						} else if ($lang == 'Japanese') {
							echo '<li>タイマースタート以降に開始したプレイのみ有効とします。</li>' .
							'<li>タイマーストップまでは何度でもリトライが可能です。</li>' .
							'<li>プレイヤーはプレイ中のゲーム画面を配信しなければなりません。' .
							'ゲーム画面をそのまま配信し、形を変えたり切り取りをしないでください。</li>' .
							'<li>プレイヤーは画像、入力表示、カメラなどの要素を画面上に配置することを許可されていますが、' .
							'その場合はゲーム内の各種情報を覆わないようにしてください。</li>' .
							'<li>クリア後は必ずリプレイを保存してください。</li>' .
							'<li>クリア後のエンディングは必ず隠してください。</li>';
						} else {
							echo '<li>Runs only count from the moment the timer has started.</li>' .
							'<li>Players can start as many runs as they want during the match. ' .
							'When the timer has finished on stream, no new runs can be started anymore.</li>' .
							'<li>The players have to stream their gameplay. Just stream game footage: ' .
							'no overlay that shapes/crops the stream.</li>' .
							'<li>Streamers are allowed to have elements (images, input displays, cameras, etc.) on top of their game. ' .
							'However, the gameplay window, as well as all information on the player\'s HUD, ' .
							'has to be visible at all times.</li><li>Finished runs need their replays saved.</li>' .
							'<li>Please hide the story ending when your run finishes.</li>';
						}
					?>
				</ul>
				<div id='ack_container'>
					<p id='jptlcredit'>
						<?php
							if ($lang == 'Chinese') { echo '本页面由' .
							'<a href="https://twitter.com/toho_yumiya">Yu-miya</a>日语翻译。'; }
							else if ($lang == 'Japanese') { echo '<a href="https://twitter.com/toho_yumiya">ゆーみや</a>' .
							'によって日本語に翻訳されました。'; }
							else { echo 'The Japanese translation was done by <a href="https://twitter.com/toho_yumiya">ゆーみや</a>.'; }
						?>
					</p>
					<p id='cntlcredit'>
						<?php
							if ($lang == 'Chinese') { echo '本页面由' .
							'<a href="https://space.bilibili.com/107846194">Komeiji Compiler</a>中文翻译。'; }
							else if ($lang == 'Japanese') { echo '<a href="https://space.bilibili.com/107846194">' .
							'Komeiji Compiler</a>によって中国語に翻訳されました。'; }
							else { echo 'The Simplified Chinese translation was done by ' .
							'<a href="https://space.bilibili.com/107846194">Komeiji Compiler</a>.'; }
						?>
					</p>
	                <p id='ack_mobile'>
						<?php
							if ($lang == 'Chinese') { echo '背景画师：' .
							'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>。'; }
							else if ($lang == 'Japanese') { echo '背景イメージは' .
							'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>さんのものを使用させていただいております。'; }
							else { echo 'The background image was drawn by ' .
							'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>.'; }
						?>
					</p>
				</div>
                <p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
            </div>
        </main>
    </body>

</html>
