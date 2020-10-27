<!DOCTYPE html>
<html id='top' lang='<?php if (empty($_GET['hl'])) { echo 'en'; } else { echo str_replace('jp', 'ja', $_GET['hl']); } ?>'>
<?php
	include 'assets/shared/navbar.php';
	include 'assets/drc/drc.php';
	include '.stats/count.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

	<head>
		<title>Dodging Rain Competition</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Webpage intended for the Dodging Rain Competition (DRC), a Touhou Project shooting game competition.'>
		<meta name='keywords' content='touhou, touhou project, 東方, 东方, drc, shooting game, shoot em up, shmup, stg, dodging, rain, competition'>
		<link rel='stylesheet' type='text/css' href='assets/drc/drc.css'>
		<link rel='icon' type='x/icon' href='assets/drc/drc.ico'>
		<script src='assets/shared/jquery.js' defer></script>
		<script src='assets/shared/utils.js' defer></script>
        <script src='assets/drc/drc.js' defer></script>
        <script src='assets/shared/sorttable.js' defer></script>
	</head>

    <body class='<?php echo check_webp() ?>'>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
		<div id='wrap' class='wrap'>
            <div id='topbar'>
				<p id='ack'>
					<?php
						if ($lang == 'English') { echo 'This background image <br id="ack_br">was drawn by ' .
						'<a href="https://www.pixiv.net/member.php?id=161300">ウータン</a>'; }
						else if ($lang == 'Japanese') { echo '背景イメージは' .
						'<a href="https://www.pixiv.net/member.php?id=161300">ウータン</a>さんのものを使用させていただいております'; }
						else { echo '背景画师：' .
						'<a href="https://www.pixiv.net/member.php?id=161300">ウータン</a>'; }
					?>
				</p>
				<span id='hy_container'>
                    <img id='hy' src='assets/shared/h-bar.png' alt='Human-youkai gauge' title='Human Mode'>
                </span>
				<div id='languages'>
                    <a id='en' class='flag' href='drc?hl=en'>
                        <img class='flag_en' src='assets/flags/uk.png' alt='<?php echo tl_term('Flag of the United Kingdom', $lang) ?>'>
                        <p class='language'>English</p>
                    </a>
                    <a id='jp' class='flag' href='drc?hl=jp'>
                        <img src='assets/flags/japan.png' alt='<?php echo tl_term('Flag of Japan', $lang) ?>'>
                        <p class='language'>日本語</p>
                    </a>
                    <a id='zh' class='flag' href='drc?hl=zh'>
                        <img src='assets/flags/china.png' alt='<?php echo tl_term('Flag of the P.R.C.', $lang) ?>'>
                        <p class='language'>简体中文</p>
                    </a>
	            </div>
			</div>
			<h1>Dodging Rain Competition</h1>
			<?php
				if (!empty($_GET['redirect'])) {
					echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
				}
			?>
            <p id='drcIntro'><?php
				if ($lang == 'English') {
					echo 'The <strong>Dodging Rain Competition (DRC)</strong> is a Touhou game competition that was invented by ' .
					'<a href="https://twitter.com/Zemuzu22">ZM</a> and is held on <a href="https://discord.gg/Ucae3Uf">' .
					'the official DRC Discord</a>. Two teams go up against each other in several different categories. ' .
					'Each player posts an arbitrarily long list of categories, ordered by preference, which can be either survival ' .
					'or scoring of any Touhou shooting game and any difficulty. They will be matched up against a player from ' .
					'the other team, in a category that both players had on their list. ' .
					'The teams and categories are determined by the DRC management team. ' .
					'Players are given two weeks to sign up for the competition, and once it starts, ' .
					'two weeks to submit a replay, which will be awarded points dependent on the rubrics. ' .
					'Runs done outside those two weeks are invalid. ' .
					'Players can submit an unlimited number of replays; the replay that is worth the most DRC points will count.';
				} else if ($lang == 'Japanese') {
					echo '<strong>Dodging Rain Competition(DRC)</strong>は<a href="https://twitter.com/Zemuzu22">ZM</a>' .
					'により考案された<a href="https://discord.gg/Ucae3Uf">DRC Discord</a>で開かれる東方projectの定期大会です。' .
					'２つのチームが幾つかのカテゴリーで競争します。各プレイヤーは希望順に並べたカテゴリーのリストを作ります。' .
					'カテゴリーは東方STGゲームの任意の難易度での「クリア重視」と「スコアアタック（稼ぎ）」のどちらかを選ぶことができます。' .
					'相手チームのプレイヤーと、共通してリストされていた１つのカテゴリーで、マッチングされます。' .
					'このチームとカテゴリーはDRC運営陣によって決められます。プレイヤーには大会登録のために２週間が与えられます。' .
					'そして大会が始まり、リプレイ提出のための２週間が与えられます。その後ルーブリックに基づいてポイントが授与されます。' .
					'この２週間以外でのプレイは無効です。プレイヤーは無制限にリプレイを登録することが出来ますが、' .
					'DRCポイントが最高であるリプレイのみが採用されます。';
				} else {
					echo '<strong>Dodging Rain Competition(DRC)</strong>是由<a href="https://twitter.com/Zemuzu22">ZM</a>' .
					'发起的东方比赛，举办地点：<a href="https://discord.gg/Ucae3Uf">DRC Discord</a>。两队进行不同项目的比赛。' .
					'每位选手报名时写下想打的任意项目，根据偏好排序，可以是避弹向的生存，也可以是打分，任意作品、任意难度均可。' .
					'列出的项目会与另一队进行匹配，相同项目的选手即匹配成功。分组与项目由DRC主办方决定。选手将会有二周时间报名。' .
					'一旦开赛，有两周时间提交参赛录像，录像所获得分根据计算公式而定。未在两周内提交则视为无效。' .
					'玩家提交的rep个数无限制，最终DRC得分将选取最高分录入。';
				}
			?></p>
            <p id='drcIntroPts'><?php
				if ($lang == 'English') {
					echo 'If you want to know how many DRC points a run is worth, ' .
					'the points for a given run can be determined using the calculator below.';
				} else if ($lang == 'Japanese') {
					echo 'リプレイにどれだけDRCポイントが貰えるか知りたいならば、下の計算機を使うことが出来ます。';
				} else {
					echo '如果你想知道得了多少DRC分，请将你完成的项目填入下方计算器内开始计算。';
				}
			?></p>
            <p id='countdown'></p>
            <h2 id='pointsCalculator'><?php
				if ($lang == 'English') { echo 'Points Calculator'; }
				else if ($lang == 'Japanese') { echo 'ポイント計算機'; }
				else { echo '得分计算器'; }
			?></h2>
			<noscript><?php
				if ($lang == 'English') {
					echo '<em>Sorry, you cannot calculate DRC points with JavaScript disabled.</em>';
				} else if ($lang == 'Japanese') {
					echo 'JavaScriptなしではDRCポイントを計算できません。';
				} else {
					echo '不好意思，目前计算DRC分必须开启JavaScript。';
				}
			?></noscript>
			<div id='calculator'>
	            <p id='drcScores'><?php
					if ($lang == 'English') {
						echo 'Scores can only contain digits, commas, dots and spaces. ' .
						' Survival runs are assumed to have cleared, scoring runs not.';
					} else if ($lang == 'Japanese') {
						echo 'スコアは桁、カンマ、ドット、スペースを含めることができます。クリア重視ではクリアする必要があります。' .
						'稼ぎではクリアしなくてもよいです。';
					} else {
						echo '分数可包含数字、逗号、句号、空格。生存向将会被假定为已通关，打分则不会。';
					}
				?></p>
	            <p id='notify'></p>
	            <label id='category' for='game'><?php echo tl_term('Category', $lang) ?></label>
	            <select id='game'>
	                <option id='hrtp' value='HRtP'><?php echo tl_game('HRtP', $lang) ?></option>
	                <option id='soew' value='SoEW'><?php echo tl_game('SoEW', $lang) ?></option>
	                <option id='podd' value='PoDD'><?php echo tl_game('PoDD', $lang) ?></option>
	                <option id='lls' value='LLS'><?php echo tl_game('LLS', $lang) ?></option>
	                <option id='ms' value='MS'><?php echo tl_game('MS', $lang) ?></option>
	                <option id='eosd' value='EoSD'><?php echo tl_game('EoSD', $lang) ?></option>
	                <option id='pcb' value='PCB'><?php echo tl_game('PCB', $lang) ?></option>
	                <option id='in' value='IN'><?php echo tl_game('IN', $lang) ?></option>
	                <option id='pofv' value='PoFV'><?php echo tl_game('PoFV', $lang) ?></option>
	                <option id='mof' value='MoF'><?php echo tl_game('MoF', $lang) ?></option>
	                <option id='sa' value='SA'><?php echo tl_game('SA', $lang) ?></option>
	                <option id='ufo' value='UFO'><?php echo tl_game('UFO', $lang) ?></option>
	                <option id='ds' value='DS'><?php echo tl_game('DS', $lang) ?></option>
	                <option id='gfw' value='GFW'><?php echo tl_game('GFW', $lang) ?></option>
	                <option id='td' value='TD'><?php echo tl_game('TD', $lang) ?></option>
	                <option id='ddc' value='DDC'><?php echo tl_game('DDC', $lang) ?></option>
	                <option id='lolk' value='LoLK'><?php echo tl_game('LoLK', $lang) ?></option>
	                <option id='hsifs' value='HSiFS'><?php echo tl_game('HSiFS', $lang) ?></option>
	                <option id='wbawc' value='WBaWC'><?php echo tl_game('WBaWC', $lang) ?></option>
	            </select>
	            <select id='difficulty'>
	                <option>Easy</option>
	                <option>Normal</option>
	                <option>Hard</option>
	                <option>Lunatic</option>
	                <option>Extra</option>
	            </select>
	            <select id='route'>
	                <option id='finala' value='FinalA'><?php echo tl_term('FinalA', $lang) ?></option>
	                <option id='finalb' value='FinalB'><?php echo tl_term('FinalB', $lang) ?></option>
	            </select>
	            <select id='challenge'>
	                <option id='scoring0' value='Scoring'><?php echo tl_term('Scoring', $lang) ?></option>
	                <option id='survival0' value='Survival'><?php echo tl_term('Survival', $lang) ?></option>
	            </select>
	            <div id='performance'></div>
	            <label id='shottypeLabel' for='shottype'></label>
				<select id='shottype'></select>
	            <select id='season'>
	                <option id='spring' value='Spring'><?php echo tl_char('Spring', $lang) ?></option>
	                <option id='summer' value='Summer'><?php echo tl_char('Summer', $lang) ?></option>
	                <option id='autumn' value='Autumn'><?php echo tl_char('Autumn', $lang) ?></option>
	                <option id='winter' value='Winter'><?php echo tl_char('Winter', $lang) ?></option>
	            </select>
				<div id='drcpoints'></div>
	            <div id='error'></div>
				<p><input id='calculate' type='button' value='<?php
					if ($lang == 'English') { echo 'Calculate'; } else if ($lang == 'Japanese') { echo '計算する'; } else { echo '计算'; }
				?>'></p>
			</div>
            <h2 id='rulesText'><?php
				if ($lang == 'English') { echo 'Rules'; } else if ($lang == 'Japanese') { echo '規定'; } else { echo '规则'; }
			?></h2>
			<ol>
                <li id='rule1'><?php
					if ($lang == 'English') { echo 'No cheating by using external programs or modifying the game FPS.'; }
					else if ($lang == 'Japanese') { echo '外部ツールを用いたチート行為やゲームのFPSを変更することを禁止します。'; }
					else { echo '禁止通过使用内置程序或修改游戏帧数作弊。'; }
				?></li>
                <li id='rule2'><?php
					if ($lang == 'English') { echo 'Replays are required for Windows game submissions, while for PC-98 a video is accepted.'; }
					else if ($lang == 'Japanese') { echo 'Windows版作品の登録にはリプレイが必要です。PC-98版作品においては録画ファイルにて受け付け可能です。'; }
					else { echo 'windows平台游戏需要提交rep；PC98平台游戏可提交视频。'; }
				?></li>
                <li id='rule3'><?php
					if ($lang == 'English') { echo 'All runs must be played using at most default lives and bombs.'; }
					else if ($lang == 'Japanese') { echo 'プレイに於いては、初期残機ボムにて参加すること。' .
					'ただし初期残機ボムを操作することが出来る作品においては減らすことのみ可能とする。なおペナルティーはないものとする。'; }
					else { echo '所有游戏必须在最大默认残机数、bomb数下进行。'; }
				?></li>
            </ol>
            <h2 id='rubricsText'><?php
				if ($lang == 'English') { echo 'Rubrics'; }
				else if ($lang == 'Japanese') { echo 'ルーブリック'; }
				else { echo '计算公式'; }
			?></h2>
            <p id='rubricsExpl'><?php
				if ($lang == 'English') {
					echo 'The rubrics are the formulas and fixed values used to calculate the number of DRC points for a run.
					If you are curious about how your points are being determined, click the button below to expand.';
				} else if ($lang == 'Japanese') {
					echo 'ルーブリックとはプレイのDRCポイントを計算するために使用される式および固定数のことです。' .
					'ポイントの決定方法を知りたい場合は、下のボタンをクリックして展開して下さい。';
				} else {
					echo '计算公式将计算出你所完成项目的分数。如果你想知道分数是如何计算的，请点击下方按钮展开。';
				}
			?></p>
            <input id='scoringButton' type='button' value='<?php
				if ($lang == 'English') { echo 'Show Scoring Rubrics'; }
				else if ($lang == 'Japanese') { echo '稼ぎのルーブリックを見せて'; }
				else { echo '显示打分计算公式'; }
			?>'>
            <input id='survivalButton' type='button' value='<?php
				if ($lang == 'English') { echo 'Show Survival Rubrics'; }
				else if ($lang == 'Japanese') { echo 'クリア重視のルーブリックを見せて'; }
				else { echo '显示生存计算公式'; }
			?>'>
            <div id='scoringRubrics'>
                <p><strong id='scoringNotes'><?php
					if ($lang == 'English') { echo 'Scoring Notes'; }
					else if ($lang == 'Japanese') { echo '稼ぎのノート'; }
					else { echo '打分简介'; }
				?></strong></p>
				<ul>
					<li id='WRpage'><?php
						if ($lang == 'English') { echo 'The World Records are taken from <a href="wr">the WR page</a>.'; }
						else if ($lang == 'Japanese') { echo 'WRのリストは<a href="wr">こちら</a>です。'; }
						else { echo '世界纪录参考自<a href="wr">此网页</a>。'; }
					?></li>
                    <li id='newWR'><?php
						if ($lang == 'English') { echo 'If you achieve a new World Record, your points are equal to the maximum ' .
						'number of points; otherwise, the formula applies.'; }
						else if ($lang == 'Japanese') { echo 'もし新世界記録を達成すれば、あなたのポイントは最高点になります。' .
							'そうでなければ式を適用します。'; }
						else { echo '如果获得新世界纪录，你的分数即为最大值。否则，则按公式计算。'; }
					?></li>
                    <li id='fictionalWR'><?php
						if ($lang == 'English') { echo 'Some categories use a fictional WR. ' .
						'<a href="#fictionalWRtitle">Click here</a> for the list of them.'; }
						else if ($lang == 'Japanese') { echo 'いくつかのカテゴリには、仮のWRを設定してあります。' .
						'仮のWRのリストは<a href="#fictionalWRtitle">ここをクリック</a>。'; }
						else { echo '某些项目将参考一个虚构的世界纪录。<a href="#fictionalWRtitle">单击此处</a>查看列表。'; }
					?></li>
                    <li id='WRdefinition'><?php
						if ($lang == 'English') { echo 'Some categories always use the WR of a specific shottype. ' .
						'<a href="#WRdefinitionTitle">Click here</a> for the list of them.'; }
						else if ($lang == 'Japanese') { echo '幾つかのカテゴリには、特定のショットタイプによるWRが設定されています。' .
						'WRの定義のリストは<a href="#WRdefinitionTitle">ここをクリック</a>。'; }
						else { echo '某些项目将一直参考具体某一机体。<a href="#WRdefinitionTitle">单击此处</a>查看列表。'; }
					?></li>
                    <li id='mofSeparate'><?php
						if ($lang == 'English') { echo 'MoF uses a separate system. ' .
						'<a href="#mountainOfFaith">Click here</a> for said system.'; }
						else if ($lang == 'Japanese') { echo '東方風神録では別のシステムを使います。' .
						'そのシステムは<a href="#mountainOfFaith">ここをクリック</a>。'; }
						else { echo '东方风神录采用单独的计分方式。<a href="#mountainOfFaith">单击此处</a>以获取系统介绍。'; }
					?></li>
                    <li id='dsSeparate'><?php
						if ($lang == 'English') { echo 'DS uses a separate system. ' .
						'<a href="#doubleSpoiler">Click here</a> for said system.'; }
						else if ($lang == 'Japanese') { echo 'ダブルスポイラーでは別のシステムを使います。' .
						'そのシステムは<a href="#doubleSpoiler">ここをクリック</a>。'; }
						else { echo '对抗新闻采用单独的计分方式。<a href="#doubleSpoiler">单击此处</a>以获取系统介绍。'; }
					?></li>
                </ul>
				<table class='nomargin'>
					<thead>
						<tr>
							<td colspan='3'><strong id='scoring1'><?php echo tl_term('Scoring', $lang) ?></strong><br>
							<span id='scoreFormula'><?php
								if ($lang == 'English') { echo '||Max * (Score/WR)^Exp||'; }
								else if ($lang == 'Japanese') { echo '||最大点 * (スコア / 世界記録) ^ 冪指数||'; }
								else { echo '||最大值 *（得分 / 世界纪录）^ 指数||'; }
							?></span></td>
						</tr>
					</thead>
					<tbody id='scoringTable'>
					<?php
						foreach ($Rubrics['SCORE'] as $game => $value) {
							if ($game == 'HRtP') {
								echo '<tr><th id="game0">' . tl_term('Game', $lang) .
								'</th><th id="maxPoints0">' . tl_term('Max points', $lang) .
								'</th><th id="exp0">' . tl_term('Exponent', $lang) . '</th></tr>';
							}
							foreach ($Rubrics['SCORE'][$game] as $diff => $rubric) {
								echo '<tr><th>' . tl_game($game . ' ', $lang) . $diff .
								'</th><td>' . $rubric['base'] . '</td><td>' . $rubric['exp'] . '</td></tr>';
							}
						}
					?>
					</tbody>
				</table>
				<br>
				<strong id='fictionalWRtitle'><?php
					if ($lang == 'English') { echo 'Fictional WRs'; }
					else if ($lang == 'Japanese') { echo '仮のWR'; }
					else { echo '虚构WR'; }
				?></strong>
				<p id='fictionalWRdesc'><?php
					if ($lang == 'English') { echo 'The categories in the table below use a fictional WR instead of the real one.'; }
					else if ($lang == 'Japanese') { echo '下記のものは、本来のWRの代わりに仮のWRを設定をしたものの表です。'; }
					else { echo '下列表中的项目将参考以下虚构的世界纪录。'; }
				?></p>
				<table class='nomargin'>
					<tbody id='fictionalWRtable'>
					<?php
						foreach ($Rubrics['SCORE'] as $game => $value) {
							foreach ($Rubrics['SCORE'][$game] as $diff => $rubric) {
								if (is_array($rubric['wr'])) {
				                    foreach ($rubric['wr'] as $shot => $score) {
				                        echo '<tr><th>' . tl_game($game . ' ', $lang) . $diff . ' ' . tl_char($shot, $lang) .
										'</th><td>' . abbreviate($score, $lang) . '</td></tr>';
				                    }
				                } else if (!empty($rubric['wr'])) {
				                    echo '<tr><th>' . tl_game($game . ' ', $lang) . $diff .
									'</th><td>' . abbreviate($rubric['wr'], $lang) . '</td></tr>';
				                }
							}
						}
					?>
					</tbody>
				</table>
				<br>
				<strong id='WRdefinitionTitle'><?php
					if ($lang == 'English') { echo '\'WR\' definition'; }
					else if ($lang == 'Japanese') { echo 'WRの定義'; }
					else { echo 'WR的定义'; }
				?></strong>
				<p id='WRdefinitionDesc'><?php
					if ($lang == 'English') { echo 'The categories in the table below always use the WR of a specific shottype.'; }
					else if ($lang == 'Japanese') { echo '表には、WRとして採用したショットタイプを紹介しています。'; }
					else { echo '以下表中的项目将独立于其他机体来计算。'; }
				?></p>
				<table class='nomargin'>
					<tbody id='WRdefinitionTable'>
					<?php
						foreach ($Rubrics['SCORE'] as $game => $value) {
							foreach ($Rubrics['SCORE'][$game] as $diff => $rubric) {
								if (!empty($rubric['basedOn'])) {
					                echo '<tr><th>' . tl_game($game . ' ', $lang) . $diff .
									'</th><td>' . tl_char($rubric['basedOn'], $lang) . '</td></tr>';
					            }
							}
						}
					?>
					</tbody>
				</table>
                <br>
                <strong id='mountainOfFaith'><?php
					if ($lang == 'English') { echo 'MoF Scoring'; }
					else if ($lang == 'Japanese') { echo '東方風神録の稼ぎ'; }
					else { echo '东方风神录打分'; }
				?></strong>
                <p id='mountainOfFaithDesc'><?php
					if ($lang == 'English') { echo 'For each difficulty and shottype there are six thresholds, ' .
					'at which you will have set numbers of points respectively. Then, increments are done, ' .
					'dependent on how much higher than the threshold your score is. ' .
					'The maximum is 375 on Easy and 500 on Lunatic.'; }
					else if ($lang == 'Japanese') { echo '各難易度各機体で６つの閾値があり、それぞれで点数を設定しています。' .
					'その後、あなたのスコアがどれだけ閾値より高いかに基づき増分します。Easyの最大点は375です。Lunaticの最大点は500です。'; }
					else { echo '对于每个难度和机体有六个阈值，在每个阈值内有各自的得分系数且分数增量固定，仅取决于你的游戏内得分。' .
					'Easy最大值是375。Lunatic最大值是500。'; }
				?></p>
                <table class='nomargin'>
                    <tbody id='mofTable'>
					<?php
						foreach ($Rubrics['MOF_THRESHOLDS'] as $diff => $value) {
							echo '<tr><th colspan="3">' . $diff . '</th></tr>';
							if ($diff == 'Easy') {
								if ($lang == 'English') {
									echo '<tr><td colspan="3">If score &lt; 1st threshold, then: ||220*(Score/T1)^2||</td></tr>';
								} else if ($lang == 'Japanese') {
									echo '<tr><td colspan="3">スコアが第一閾値よりも小さければ、||220*(スコア/第一閾値)^2||</td></tr>';
								} else {
									echo '<tr><td colspan="3">若分数小于第一阈值，||220*(分数/第一阈值)^2||</td></tr>';
								}
							} else if ($diff == 'Lunatic') {
								if ($lang == 'English') {
									echo '<tr><td colspan="3">If score &lt; 2b, then: ||200*(Score/2b)^2||</td></tr>';
								} else if ($lang == 'Japanese') {
									echo '<tr><td colspan="3">スコアが20億よりも小さければ、||200*(スコア/20億)^2||</td></tr>';
								} else {
									echo '<tr><td colspan="3">若分数小于20亿，||200*(分数/20亿)^2||</td></tr>';
								}
							} else if ($diff == 'Extra') {
								if ($lang == 'English') {
									echo '<tr><td colspan="3">If score &lt; 900m, then: ||100*(Score/900m)^2||</td></tr>';
								} else if ($lang == 'Japanese') {
									echo '<tr><td colspan="3">スコアが9億よりも小さければ、||100*(スコア/9億)^2||</td></tr>';
								} else {
									echo '<tr><td colspan="3">若分数小于9亿，||100*(分数/9亿)^2||</td></tr>';
								}
							}
							foreach ($value as $shot => $thresholds) {
								echo '<tr><th colspan="3">' . tl_char($shot, $lang) . '</th></tr>';
								echo '<tr><th class="threshold">' . tl_term('Threshold', $lang) .
								'</th><th class="basePoints">' . tl_term('Base points', $lang) . '</th>' .
								'<th class="increments">' . tl_term('Increments', $lang) . '</th></tr>';
								$id += 1;
								for ($i = 0; $i < sizeof($thresholds['base']); $i++) {
									if ($lang == 'English') {
										echo '<tr><td>' . abbreviate($thresholds['score'][$i], $lang) .
										'</td><td>' . $thresholds['base'][$i] . '</td><td>+' . $thresholds['increment'][$i] .
										' for every ' . abbreviate($thresholds['step'][$i], $lang) . '</td></tr>';
									} else if ($lang == 'Japanese') {
										echo '<tr><td>' . abbreviate($thresholds['score'][$i], $lang) .
										'</td><td>' . $thresholds['base'][$i] . '</td><td>' . abbreviate($thresholds['step'][$i], $lang) .
										'ごとに+' . $thresholds['increment'][$i] . '</td></tr>';
									} else {
										echo '<tr><td>' . abbreviate($thresholds['score'][$i], $lang) .
										'</td><td>' . $thresholds['base'][$i] . '</td><td>每' . abbreviate($thresholds['step'][$i], $lang) .
										'增加' . $thresholds['increment'][$i] . '</td></tr>';
									}
								}
							}
						}
					?>
					</tbody>
                </table>
                <br>
                <strong id='doubleSpoiler'><?php
					if ($lang == 'English') { echo 'DS Scoring'; }
					else if ($lang == 'Japanese') { echo 'ダブルスポイラーの稼ぎ'; }
					else { echo '对抗新闻打分'; }
				?></strong>
                <p id='doubleSpoilerDesc'><?php
					if ($lang == 'English') { echo 'For each scene there are three thresholds, ' .
					'at which you will have set numbers of points points respectively. Then, increments are done, ' .
					'dependent on how much higher than the threshold your score is.'; }
					else if ($lang == 'Japanese') { echo '各撮影対象各機体で3つの閾値があり、それぞれで点数を設定しています。' .
					'その後、あなたのスコアがどれだけ閾値より高いかに基づき増分します。'; }
					else { echo '对于每个场景和机体有三个阈值，在每个阈值内有各自的得分系数且分数增量固定，仅取决于你的游戏内得分。'; }
				?></p>
                <table class='nomargin'>
                    <tbody id='dsTable'>
					<?php
						echo '<tr><th>' . tl_term('Scene', $lang) . '</th><th class="basePoints">' . tl_term('Base points', $lang) .
						'</th><th id="increments">' . tl_term('Increments', $lang) . '</th>' .
						'<th class="threshold1">' . tl_term('Threshold 1', $lang) . '</th>';
						echo '<th class="increments">' . tl_term('Increments', $lang) .
						'</th><th class="threshold2">' . tl_term('Threshold 2', $lang) . '</th>';
						echo '<th class="increments">' . tl_term('Increments', $lang) .
						'</th><th class="threshold3">' . tl_term('Threshold 3', $lang) . '</th></tr>';
						foreach ($Rubrics['SCENE_THRESHOLDS'] as $scene => $thresholds) {
					        $n1 = $thresholds[1] * 1000;
					        $n2 = $thresholds[2] * 1000;
					        $n3 = $thresholds[3] * 1000;
					        $step1 = round($n1 / 20);
					        $step2 = round(($n2 - $n1) / 30);
					        $step3 = round(($n3 - $n2) / 30);
					        if ($lang == 'English') {
					            echo '<tr><td>' . $scene . '</td><td>0</td><td>+1 for every ' . sep($step1) .
								'</td><td>' . sep($n1) . '</td><td>+1 for every ' . sep($step2) . '</td><td>' . sep($n2) .
								'</td><td>+1 for every ' . sep($step3) . '</td><td>' . sep($n3) . '</td></tr>';
					        } else if ($lang == 'Japanese') {
					            echo '<tr><td>' . $scene . '</td><td>0</td><td>' . abbreviate($step1, $lang) .
								'ごとに+1</td><td>' . abbreviate($n1, $lang) . '</td><td>' . abbreviate($step2, $lang) .
								'ごとに+1</td><td>' . abbreviate($n2, $lang) . '</td><td>' . abbreviate($step3, $lang) .
								'ごとに+1</td><td>' . abbreviate($n3, $lang) . '</td></tr>';
					        } else {
					            echo '<tr><td>' . $scene . '</td><td>0</td><td>每' . abbreviate($step1, $lang) .
								'增加1</td><td>' . abbreviate($n1, $lang) . '</td><td>每' . abbreviate($step2, $lang) .
								'增加1</td><td>' . abbreviate($n2, $lang) . '</td><td>每' . abbreviate($step3, $lang) .
								'增加1</td><td>' . abbreviate($n3, $lang) . '</td></tr>';
					        }
					    }
					?>
					</tbody>
                </table>
                <br>
                <p><strong><a class='backToTop' href='#top'><?php echo tl_term('Back to Top', $lang) ?></a></strong></p>
			</div>
			<div id='survivalRubrics'>
                <p><strong id='survivalNotes'><?php
					if ($lang == 'English') { echo 'Survival Notes'; }
					else if ($lang == 'Japanese') { echo 'クリア重視のノート'; }
					else { echo '生存简介'; }
				?></strong></p>
				<ul>
                    <li id='maingame'>
					<?php
						if ($lang == 'English') { echo 'For a main game clear, a shottype multiplier is applied to your DRC points, ' .
						'the result of which is again rounded. <a href="#shottypeMultipliers">Click here</a> for the list of them.'; }
						else if ($lang == 'Japanese') { echo '本編クリアではキャラ倍率がDRCポイントに掛けられます。その結果は四捨五入されます。' .
						'キャラ倍率のリストは<a href="#shottypeMultipliers">ここをクリック</a>。'; }
						else { echo '当完成一项游戏，机体系数会影响DRC总分，结果会再次近似。' .
						'<a href="#shottypeMultipliers">单击此处</a>查看列表。'; }
					?></li>
                    <li id='phantasmagoriaSeparate'>
					<?php
						if ($lang == 'English') { echo 'The Phantasmagorias use a separate system. ' .
						'<a href="#phantasmagoria">Click here</a> for said system.'; }
						else if ($lang == 'Japanese') { echo '東方夢時空と東方花映塚では別のシステムを使います。その方式は' .
						'<a href="#phantasmagoria">ここをクリック</a>。'; }
						else { echo '东方梦时空和东方花映塚关卡采用单独的计分方式。' .
						'<a href="#phantasmagoria">单击此处</a>以获取系统介绍。'; }
					?></li>
                    <li id='inLS'>
					<?php
						if ($lang == 'English') { echo 'For IN, you obtain 2 (1 on Easy) additional points for each captured Last Spell, ' .
						'with the exception of Imperishable Shooting, which yields 5 points.'; }
						else if ($lang == 'Japanese') { echo '東方永夜抄ではラストスペルを取得する度に２点（Easyのみ１点）の追加点を得ます。' .
						'「インペリシャブルシューティング」の追加点は５点とします。'; }
						else { echo '对于永夜抄，每收取一张LSC，则获得额外的2分（Easy难度为1分）。收取【不朽的弹幕】获得5分。'; }
					?>
					</li>
                    <li id='hsifsReleases'>
					<?php
						if ($lang == 'English') { echo 'For HSiFS, the first release adds 2 to <em>n</em>, ' .
						'and further releases add 0.5, 0.4, 0.3, 0.2, 0.1 to <em>n</em>.'; }
						else if ($lang == 'Japanese') { echo '東方天空璋では、最初の季節解放は２ボム扱い、' .
						'以降の解放は０.５、０.４、０.３、０.２、０.１ボム扱いとします。'; }
						else { echo '对于东方天空璋，初次季节解放则n+2，之后的季节释放n+0.5，0.4，0.3，0.2，0.1。'; }
					?></li>
                </ul>
		        <table class='nomargin'>
		        	<thead>
						<tr>
							<td colspan='6'><strong id='survival1'><?php echo tl_term('Survival', $lang) ?></strong><br>
							<span id='survFormula'><?php
								if ($lang == 'English') { echo '||Max * (Base^-n)||'; }
								else if ($lang == 'Japanese') { echo '||最大点 * (底 ^ -n)||'; }
								else { echo '||最大值 *（基数 ^ -n）||'; }
							?></span></td>
						</tr>
					</thead>
		        	<tbody id='survivalTable'>
					<?php
						foreach ($Rubrics['SURV'] as $game => $value) {
							if (is_phantasmagoria($game)) {
								continue;
							}
							if ($game == 'HRtP') {
								echo '<tr><th id="game2">' . tl_term('Game', $lang) .
								'</th><th id="maxPoints1">' . tl_term('Game', $lang) .
								'</th><th id="base0">' . tl_term('Base', $lang) .
								'</th><th id="lostLife">Lost life (n)</th><th id="firstBomb">First bomb (n)</th>' .
								'<th id="further">Further bombs (n)</th></tr>';
							}
							foreach ($value as $diff => $rubric) {
								if ($diff == 'multiplier' || $diff == 'seasonMultiplier') {
									continue;
								}
					        	echo '<tr><th>' . tl_game($game . ' ', $lang) . $diff . '</th><td>' . $rubric['base'] .
								'</td><td>' . $rubric['exp'] . '</td><td>' . $rubric['miss'] .
								'</td><td>' . $rubric['firstBomb'] . '</td><td>' . $rubric['bomb'] . '</td></tr>';
							}
						}
					?>
					</tbody>
		        </table>
				<br>
                <strong id='phantasmagoria'><?php
					if ($lang == 'English') { echo 'PoDD & PoFV Survival'; }
					else if ($lang == 'Japanese') { echo '東方夢時空と東方花映塚のクリア重視'; }
					else { echo '东方梦时空和东方花映塚生存'; }
				?></strong>
                <p id='phantasmagoriaDesc'><?php
					if ($lang == 'English') { echo 'In the below formula, MaxLives is equal to 5 for PoDD, 7 for PoFV main game ' .
					'and 8 for PoFV Extra. NoBombBonus is a difficulty-specific No Bomb bonus for PoDD and a No Charge Attacks ' .
					'bonus for PoFV. RoundsLost is equal to how many rounds the player lost.'; }
					else if ($lang == 'Japanese') { echo '下式において、最大残機を夢時空で５、花映塚本編で７、花映塚エキストラでは８です。' .
					'ノーボムボーナスは難易度ごとに変わる、夢時空でのボムの不使用ボーナスと花映塚の（Ｃ１含む）チャージ攻撃の不使用ボーナスです。'; }
					else { echo '在以下公式中，东方梦时空的最大残机数为5，东方花映塚故事模式为7，EX为8。' .
					'NB奖分依难度而定。东方梦时空为NB奖分，东方花映塚为NC奖分。'; }
				?></p>
                <table class='nomargin'>
                    <thead><tr><td id='pofvFormula' colspan='4'><?php
						if ($lang == 'English') { echo '||Max - ((Max - Min) / MaxLives * RoundsLost)|| + NoBombBonus'; }
						else if ($lang == 'Japanese') { echo '||最大点 - ((最大点 - 最小点) / 最大残機 * 敗北数)|| + ノーボムボーナス'; }
						else { echo '||最大值 -最大值 - 最小值） / 最大残机 * 败北数）|| + NB奖分'; }
					?></td></tr></thead>
                    <tbody id='phantasmagoriaTable'>
					<?php
						foreach ($Rubrics['SURV'] as $game => $value) {
							if (is_phantasmagoria($game)) {
								if ($game == 'PoDD') {
									echo '<tr><th id="game1">' . tl_term('Game', $lang) .
									'</th><th id="maxPoints2">' . tl_term('Max points', $lang) .
									'</th><th id="minPoints">' . tl_term('Min points', $lang) .
									'</th><th id="nbBonus">' . tl_term('No Bomb bonus', $lang) . '</th></tr>';
								}
								foreach ($value as $diff => $rubric) {
									if ($diff == 'multiplier' || $diff == 'seasonMultiplier') {
										continue;
									}
						        	echo '<tr><th>' . tl_game($game . ' ', $lang) . $diff . '</th><td>' . $rubric['base'] .
									'</td><td>' . $rubric['min'] . '</td><td>' . $rubric['noBombBonus'] . '</td></tr>';
								}
							}
						}
					?>
					</tbody>
                </table>
                <br>
                <strong id='shottypeMultipliers'><?php
					if ($lang == 'English') { echo 'Shottype Multipliers'; }
					else if ($lang == 'Japanese') { echo 'キャラ倍率'; }
					else { echo '机体系数'; }
				?></strong>
                <p id='shotMultDesc'><?php
					if ($lang == 'English') { echo 'These are applied to the result of the survival formula for a main game ' .
					'run only; they do <em>not</em> apply for Extra, nor do they apply for HSiFS runs that use releases.' .
					'For all shots not listed here, the shottype multipliers are equal to 1.'; }
					else if ($lang == 'Japanese') { echo 'これらは本編のクリア重視プレイの結果にのみ適用されます。' .
					'Extraでは適用されません。解放を使用した天空璋のプレイにも適用されません。ここに載っていない機体のキャラ倍率は１となります。'; }
					else { echo '该要素仅适用于生存项目的计算公式，不适用于EX和使用了季节解放的天空璋。未列出的机体，系数均为1。'; }
				?></p>
                <table class='nomargin'>
                    <tbody id='shottypeMultipliersTable'>
					<?php
						foreach ($Rubrics['SURV'] as $game => $value) {
							if ($game == 'HRtP') {
								echo '<tr><th id="multipliedShottype">' . tl_term('Shottype', $lang) .
								'</th><th id="multiplier">' . tl_term('Multiplier', $lang) . '</th></tr>';
							}
							foreach ($value as $diff => $rubric) {
								if ($diff == 'multiplier' || $diff == 'seasonMultiplier') {
									foreach ($rubric as $shot => $mult) {
										echo '<tr><th>' . tl_game($game . ' ', $lang) . ($lang == 'Japanese' ? 'の' : '') .
										tl_char($shot, $lang) . '</th><td>' . $mult . '</td></tr>';
									}
								}
							}
						}
					?>
					</tbody>
                </table>
                <br>
                <p><strong><a class='backToTop' href='#top'><?php echo tl_term('Back to Top', $lang) ?></a></strong></p>
            </div>
            <h2 id='ackText'><?php
				if ($lang == 'English') { echo 'Acknowledgements'; }
				else if ($lang == 'Japanese') { echo '謝辞'; }
				else { echo '致谢'; }
			?></h2>
			<div id='ack_container' class='noborders'>
				<p id='jptlcredit'>
					<?php
						if ($lang == 'English') { echo 'The Japanese translation was done by ' .
						'<a href="https://twitter.com/7bitm">7bitm</a> and ' .
						'<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.'; }
						else if ($lang == 'Japanese') { echo '<a href="https://twitter.com/7bitm">7bitm</a>と' .
						'<a href="https://twitter.com/toho_yumiya">ゆーみや</a>によって日本語に翻訳されました。'; }
						else { echo '本页面由<a href="https://twitter.com/7bitm">7bitm</a>，' .
						'<a href="https://twitter.com/toho_yumiya">ゆーみや</a>日语翻译。'; }
					?>
				</p>
				<p id='cntlcredit'>
					<?php
						if ($lang == 'English') { echo 'The Simplified Chinese translation was done by ' .
						'<a href="https://twitter.com/IzayoiMeirin">Cero</a>, ' .
						'<a href="https://twitter.com/CrestedPeak9">CrestedPeak9</a> and ' .
						'<a href="https://twitter.com/Cerasis_th">Cerasis</a>.'; }
						else if ($lang == 'Japanese') { echo '<a href="https://twitter.com/IzayoiMeirin">Cero</a>と' .
						'<a href="https://twitter.com/CrestedPeak9">CrestedPeak9</a>と' .
						'<a href="https://twitter.com/Cerasis_th">Cerasis</a>によって中国語に翻訳されました。'; }
						else { echo '本页面由<a href="https://twitter.com/IzayoiMeirin">Cero</a>，' .
						'<a href="https://twitter.com/CrestedPeak9">CrestedPeak9</a>，' .
						'<a href="https://twitter.com/Cerasis_th">Cerasis</a>中文翻译。'; }
					?>
				</p>
				<p id='ack_mobile'>
					<?php
						if ($lang == 'English') { echo 'The background image was drawn by ' .
						'<a href="https://www.pixiv.net/member.php?id=161300">ウータン</a>.'; }
						else if ($lang == 'Japanese') { echo '背景イメージは' .
						'<a href="https://www.pixiv.net/member.php?id=161300">ウータン</a>さんのものを使用させていただいております。'; }
						else { echo '背景画师：' .
						'<a href="https://www.pixiv.net/member.php?id=161300">ウータン</a>。'; }
					?>
				</p>
            </div>
			<p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
			<input id='shots' type='hidden' value='<?php
				$shots = '{';
				foreach ($WRs as $game => $value) {
					$shots .= '"' . $game . '":[';
					foreach ($WRs[$game]['Easy'] as $shot => $value) {
						$shots .= '"' . $shot . '",';
					}
					$shots = substr($shots, 0, -1) . '],';
				}
				echo substr($shots, 0, -1) . '}';
			?>'>
		</div>
        <script src='assets/shared/dark.js'></script>
	</body>

</html>
