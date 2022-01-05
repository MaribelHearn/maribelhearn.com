<?php include_once 'assets/twc/twc_code.php' ?>
<div id='wrap' class='wrap'>
	<div id='topbar'>
		<p id='ack'>
			<?php
				if ($lang == 'Chinese') {
					echo '背景画师：<a href="https://www.pixiv.net/en/users/186860">宇文風</a>';
				} else if ($lang == 'Japanese') {
					echo '背景イメージは<a href="https://www.pixiv.net/en/users/186860">宇文風</a>' .
					'さんの<br id="ack_br">ものを使用させていただいております';
				} else if ($lang == 'Russian') {
					echo 'Иллюстрацию на фоне <br id="ack_br">нарисовал(а) ' .
					'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>';
				} else {
					echo 'This background image <br id="ack_br">was drawn by ' .
					'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>';
				}
			?>
		</p>
		<span id='hy_container'>
            <span id='hy'></span>
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
            <a id='ru' class='flag' href='twc?hl=ru'>
                <img src='assets/flags/russia.png' alt='<?php echo tl_term('Flag of Russia', $lang) ?>'>
                <p class='language'>Русский</p>
            </a>
        </div>
	</div>
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
			'<p>公式ツイッター及びYouTubeチャンネル、各言語による解説音声付き配信チャンネル、' .
			'スケジュール、プレイヤー一覧は以下をご覧ください。</p>';
		} else if ($lang == 'Russian') {
			echo '<p><strong>Touhou World Cup (TWC)</strong> - ежегодное международное состязание по шмапам Тохо, ' .
			'впервые проведено в 2020 году китайским сообществом. В этот раз, в 2021, ивент организовывает западное ' .
			'сообщество.</p><p>Три команды, Запад, Китай, и Япония сражаются в режимах Лунатика и Экстры, ' .
			'и играют вживую на стримах, как на очки, так и на выживание.</p><p>Снизу можете увидеть ссылки на ' .
			'официальные каналы, стримы, расписание и правила.</p>';
		} else {
			echo '<p><strong>Touhou World Cup (TWC)</strong> is an annual international Touhou shooting game competition, ' .
			'first held in 2020, organised by the Chinese gameplay community. ' .
			'This time around, in 2021, it is organised by the Western gameplay community.</p>' .
			'<p>Three teams, a Western community team, a Chinese team, and a Japanese team, duke it out ' .
			'on Lunatic and Extra mode, playing on live streams and playing both high score and survival.</p>' .
			'<p>See below for official communication channels, live streams with commentary, the schedule, ' .
			'and the rules the players play by.</p>';
		}
	?>
	<div id='links'>
		<?php
			echo '<p><span class="icon twitter_icon"></span>';
			if ($lang == 'Chinese') { echo '<a href="https://twitter.com/touhouworldcup">TWC的官方推特</a>'; }
			else if ($lang == 'Japanese') { echo '<a href="https://twitter.com/touhouworldcup">公式ツイッター</a>'; }
			else if ($lang == 'Russian') { echo '<a href="https://twitter.com/touhouworldcup">Официальный Твиттер TWC</a>'; }
			else { echo '<a href="https://twitter.com/touhouworldcup">Official TWC Twitter</a>'; }
			echo '</p><p><span class="icon youtube_icon"></span>' .
			'<a href="https://www.youtube.com/channel/UCk8o-jk-Zpn4CEmLUIkui0A">';
			if ($lang == 'Chinese') { echo 'TWC的官方YouTube频道'; }
			else if ($lang == 'Japanese') { echo '公式YouTubeチャンネル'; }
			else if ($lang == 'Russian') { echo 'Официальный канал TWC на Youtube'; }
			else { echo 'Official TWC YouTube Channel'; }
			echo '</a></p><p><span class="icon flag_uk"></span>' .
			'<a href="https://www.twitch.tv/touhou_replay_showcase">';
			if ($lang == 'Chinese') { echo '英文流解说（Twitch）'; }
			else if ($lang == 'Japanese') { echo '英語解説付き配信チャンネル(Twitch)'; }
			else if ($lang == 'Russian') { echo 'Английский стрим (Twitch)'; }
			else { echo 'English commentary stream (Twitch)'; }
			echo '</a></p><p><span class="icon flag_china"></span>' .
			'<a href="https://live.bilibili.com/22478102?share_source=copy_link">';
			if ($lang == 'Chinese') { echo '一号中文流解说（Bilibili)'; }
			else if ($lang == 'Japanese') { echo '中国語解説付き配信チャンネル１(Bilibili)'; }
			else if ($lang == 'Russian') { echo 'Китайский стрим 1 (Bilibili)'; }
			else { echo 'Chinese commentary stream 1 (Bilibili)'; }
			echo '</a><br><span class="icon flag_china"></span>' .
			'<a href="https://live.bilibili.com/14315174?share_source=copy_link">';
			if ($lang == 'Chinese') {
				echo '二号中文流解说（Bilibili)';
			} else if ($lang == 'Japanese') {
				echo '中国語解説付き配信チャンネル２(Bilibili)';
			} else if ($lang == 'Russian') {
				echo 'Китайский стрим 2 (Bilibili)';
			} else {
				echo 'Chinese commentary stream 2 (Bilibili)';
			}
			echo '</a></p><p><span class="icon flag_japan"></span>' .
			'<a href="https://www.youtube.com/channel/UCfF3O4wo0YxppTZGmtTGDwg">';
			if ($lang == 'Chinese') {
				echo '日文流解说（YouTube）';
			} else if ($lang == 'Japanese') {
				echo '日本語解説付き配信チャンネル';
			} else if ($lang == 'Russian') {
				echo 'Японский стрим (Youtube)';
			} else {
				echo 'Japanese commentary stream (YouTube)';
			}
			echo '</a></p><p><span class="icon flag_russia"></span>' .
			'<a href="https://www.twitch.tv/touhou_russian_kolkhoz">';
			if ($lang == 'Chinese') {
				echo '俄文流解说（Twitch）';
			} else if ($lang == 'Japanese') {
				echo 'ロシア語解説付き配信チャンネル';
			} else if ($lang == 'Russian') {
				echo 'Русский стрим (Twitch)';
			} else {
				echo 'Russian commentary stream (Twitch)';
			}
			echo '</a></p>';
		?>
	</div>
    <h2 id='contents'><?php
		if ($lang == 'Chinese') { echo '目录'; }
		else if ($lang == 'Japanese') { echo 'コンテンツ'; }
		else if ($lang == 'Russian') { echo 'Содержание'; }
		else { echo 'Contents'; }
	?></h2>
    <div id='contents_div' class='border'>
        <p><a href='#schedule'><?php
			if ($lang == 'Chinese') { echo '时间表'; }
			else if ($lang == 'Japanese') { echo 'スケジュール'; }
			else if ($lang == 'Russian') { echo 'Расписание'; }
			else { echo 'Schedule'; }
		?></a></p>
        <p><a href='#rules'><?php
			if ($lang == 'Chinese') { echo '规则'; }
			else if ($lang == 'Japanese') { echo 'ルール'; }
			else if ($lang == 'Russian') { echo 'Правила'; }
			else { echo 'Rules'; }
		?></a></p>
    </div>
	<h2 id='schedule'><?php
		if ($lang == 'Chinese') { echo '时间表'; }
		else if ($lang == 'Japanese') { echo 'スケジュール'; }
		else if ($lang == 'Russian') { echo 'Расписание'; }
		else { echo 'Schedule'; }
	?></h2>
	<p><?php
		if ($lang == 'Chinese') {
			echo '我们检测到您的时区是<span id="timezone"></span>。';
		} else if ($lang == 'Japanese') {
			echo '表示されているタイムゾーンは<span id="timezone"></span>です。';
		} else if ($lang == 'Russian') {
			echo 'Ваш часовой пояс: <span id="timezone"></span>.';
		} else {
			echo 'Your time zone was detected as <span id="timezone"></span>.';
		}
	?></p>
	<p><?php
		if ($lang == 'English') {
			echo 'Daylight Saving Time (also known as Summer Time or DST) is taken into account automatically.';
		} else if ($lang == 'Russian') {
			echo 'Переход на летнее время также учитан автоматически.';
		}
	?></p>
	<table id='schedule_table'>
		<thead>
			<tr>
				<th rowspan='3'><?php
					if ($lang == 'Chinese') { echo '日期/时间'; }
					else if ($lang == 'Japanese') { echo '日付と時間'; }
					else if ($lang == 'Russian') { echo 'Дата/Время'; }
					else { echo 'Date/Time'; }
				?></th>
				<th rowspan='3'><?php
					if ($lang == 'Chinese') { echo '项目'; }
					else if ($lang == 'Japanese') { echo 'カテゴリー'; }
					else if ($lang == 'Russian') { echo 'Категория'; }
					else { echo 'Category'; }
				?></th>
				<th rowspan='3'><?php
					if ($lang == 'Chinese') { echo '玩家'; }
					else if ($lang == 'Japanese') { echo 'プレイヤー'; }
					else if ($lang == 'Russian') { echo 'Игроки'; }
					else { echo 'Players'; }
				?></th>
				<th rowspan='3'><?php
					if ($lang == 'Chinese') { echo 'Reset Time<br>（分钟）'; }
					else if ($lang == 'Japanese') { echo 'リセットのタイマー（分）'; }
					else if ($lang == 'Russian') { echo 'Время на рестарт<br>(минуты)'; }
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
		else if ($lang == 'Russian') { echo 'Правила'; }
		else { echo 'Rules'; }
	?></h2>
	<h3><?php
		if ($lang == 'Chinese') { echo '比赛形式'; }
		else if ($lang == 'Japanese') { echo '概要'; }
		else if ($lang == 'Russian') { echo 'Формат'; }
		else { echo 'Format'; }
	?></h3>
	<p><?php
		if ($lang == 'Chinese') {
			echo '每场比赛以选手比赛中获得的最高积分进行排名，同时选手所在队伍获得相应的总分。';
		} else if ($lang == 'Japanese') {
			echo '各試合の順位によって各チームはポイントを獲得します。各試合の順位はISCORE（ISCOREについての欄を参照）' .
			'の高い順に決定されます。獲得ポイントは以下の通りです。';
		} else if ($lang == 'Russian') {
			echo 'В каждом матче, каждая команда может набрать очки. ' .
			'Рейтинг основан на том, у какой команды больше всего очков:';
		} else {
			echo 'For every match, each team can earn points. Ranking is based on whoever has the most points:';
		}
	?></p>
	<ul>
		<li><?php
			if ($lang == 'Chinese') { echo '冠军：2总分(避免负分歧义)'; }
			else if ($lang == 'Japanese') { echo '１位　２ポイント'; }
			else if ($lang == 'Russian') { echo 'Первое место - 2 очка'; }
			else { echo '1st place - 2 pts'; }
		?></li>
		<li><?php
			if ($lang == 'Chinese') { echo '亚军：1总分'; }
			else if ($lang == 'Japanese') { echo '２位　１ポイント'; }
			else if ($lang == 'Russian') { echo 'Второе место - 1 очко'; }
			else { echo '2nd place - 1 pt'; }
		?></li>
		<li><?php
			if ($lang == 'Chinese') { echo '季军：0总分'; }
			else if ($lang == 'Japanese') { echo '３位　０ポイント'; }
			else if ($lang == 'Russian') { echo 'Третье место - 0 очков'; }
			else { echo '3rd place - 0 pts'; }
		?></li>
	</ul>
	<p><?php
		if ($lang == 'Chinese') {
			echo '即使是二人战，双方也按照以上描述得分，不参与队伍算季军。';
		} else if ($lang == 'Japanese') {
			echo 'なお２チームのみが出場する試合においては、１位が２ポイント、２位が１ポイントの獲得となります。';
		} else if ($lang == 'Russian') {
			echo 'В матчах с двумя командами, первое место получает 2 очка, второе место получает 1.';
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
		} else if ($lang == 'Russian') {
			echo 'Если несколько игроков получают одинаковое количество ISCORE, их очки будут разделены пополам. ' .
			'Это также означает что если у всех игроков получается одинаковый ISCORE, матч заканчивается ничьёй.';
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
		} else if ($lang == 'Russian') {
			echo 'В конце Touhou World Cup будет создан рейтинг команд по заработанным очкам.';
		} else {
			echo 'At the end of the World Cup, the teams will be ranked based on has the most points.';
		}
	?></p>
	<h3><?php
		if ($lang == 'Chinese') { echo '计算积分'; }
		else if ($lang == 'Japanese') { echo 'ISCOREについて'; }
		else if ($lang == 'Russian') { echo 'Расчёт очков'; }
		else { echo 'Calculating Points'; }
	?></h3>
	<p><?php
		if ($lang == 'Chinese') {
			echo '积分使用<a href="https://www.isndes.com/jf">甜品站积分计</a>' .
			'算器计算，计算公式可上甜品站查看，大战争避弹除外（后述）。';
		} else if ($lang == 'Japanese') {
			echo '各試合で獲得するISCOREは<a href="https://www.isndes.com/jf">ISCORE Calculator</a>により定められます。' .
			'(画面右上、右から4番目の「A文」と書かれたマークからEnglishに変更後、画面右上のAbout ISCOREの欄を参照)';
		} else if ($lang == 'Russian') {
			echo 'Очки основаны на <a href="https://www.isndes.com/jf">ISCORE калькуляторе</a> ' .
			'(поменяйте язык на английский в правом верхнем углу и нажмите на About ISCORE).';
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
		} else if ($lang == 'Russian') {
			echo 'Матчи скоринга расчитаны по калькулятору ISCORE. ' .
			'Матчи на выживание (кроме Тохо 12.8) расчитаны так:';
		}
	?></p>
	<p><tt><?php
		if ($lang == 'Chinese') { echo '（甜品站积分 NMNB分数）*0.5^（死亡数）'; }
		else if ($lang == 'Japanese') { echo '(ISCORE表内のNNの値)*0.5^(被弾数)'; }
		else if ($lang == 'Russian') { echo '(ISCORE NN Score)*0.5^(смерти)'; }
		else { echo '(ISCORE No Miss No Bomb Score)*0.5^(deaths)'; }
	?></tt></p>
	<p><?php
		if ($lang == 'Chinese') { echo '全作避弹项目中，丢雷算2 miss。'; }
		else if ($lang == 'Japanese') { echo 'サバイバルマッチではボムの使用は２被弾としてカウントされます。'; }
		else if ($lang == 'Russian') { echo 'В матчах на выживание, бомбы считаются как 2 смерти.'; }
		else { echo 'In survival runs, bombs are counted as 2 deaths.'; }
	?></p>
	<p><?php
		if ($lang == 'Chinese') {
			echo '甜品站分数是可以将不同比赛的差异得分进行修补整合的打分矩阵，您可以点击上面的甜品站计算器来查看所用的公式。';
		} else if ($lang == 'Japanese') {
			echo 'ISCOREはショットタイプによる性能の差を補完するために開発された評価手法です。'.
			'計算方法は上記のAbout ISCOREからご覧いただけます。';
		} else if ($lang == 'Russian') {
			echo 'ISCORE это система измерения очков, которая создана для компенсации разницы между ' .
			'сложностями разных типов стрельбы и категорий. Формулы можно найти в рубрике про ISCORE ' .
			'с калькулятором по ссылке выше.';
		} else {
			echo 'ISCORE is a scoring metric that compensates for the differences in performance ' .
			'between shot types and categories. The formulas used can be found in the ISCORE rubric ' .
			'with the calculator linked above.';
		}
	?></p>
	<h3><?php
		if ($lang == 'Chinese') { echo '额外提醒'; }
		else if ($lang == 'Japanese') { echo '作品固有のルール'; }
		else if ($lang == 'Russian') { echo 'Правила для определенных игр'; }
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
		else if ($lang == 'Russian') { echo 'Разрыв бордера считается как смерть в матчах на выживание.'; }
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
		} else if ($lang == 'Japanese') {
			echo 'サバイバルマッチにおいて、ラストスペルでの被弾はISCOREに影響を与えません。'.
			'ただし、全てのラストスペルを出現させ取得し、かつ、ノーミスノーボムを達成した場合にのみ、' .
			'より高いISCOREが与えられます（ISCORE CalculatorのFull-SC欄を参照）。';
		} else if ($lang == 'Russian') {
			echo 'Получение урона во время бонусных спеллов не считается смертью в матчах на выживание. ' .
			'Однако ISCORE дает большее количество очков за забеги, в которых были захвачены все бонусные ' .
			'спеллы И ОДНОВРЕМЕННО без бомб и смертей.';
		} else {
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
		} else if ($lang == 'Russian') {
			echo 'Призыв НЛО считается смертью в матчах на выживание. Однако, сбор НЛО-предметов не влияет на очки.';
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
		else if ($lang == 'Russian') { echo 'Формула для выживания в этой игре считается следующим образом: ' .
		'(золотые медали*1.5)-(смерти)'; }
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
		} else if ($lang == 'Russian') {
			echo 'Намеренный транс считается как 2 смерти в матчах на выживание. ' .
			'ISCORE дает большее количество очков за забеги, в которых были захвачены все ' .
			'спеллы И ОДНОВРЕМЕННО без бомб и смертей.';
		} else {
			echo 'A manual trance is considered 2 deaths in survival runs. ' .
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
		else if ($lang == 'Japanese') { echo 'サバイバルマッチ、' .
		'スコアアタックマッチともに完全無欠モードでプレイすることは禁止されています。'; }
		else if ($lang == 'Russian') { echo 'Все забеги должны быть выполнены в режиме Legacy.'; }
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
		else if ($lang == 'Russian') { echo 'Высвобождение сезона считается как 2 смерти в матчах на выживание.'; }
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
		} else if ($lang == 'Russian') {
			echo 'Гипер берсерка (сбор 3 или более животных токенов для гипера) считается как 2 смерти ' .
			'в матчах на выживание. Получение урона во время гипера считается как смерть в матчах на выживание.';
		} else {
			echo 'Channeling a berserk roar (3 or more of the same animal tokens during roar mode) ' .
			'is considered 2 deaths in survival runs. Breaking your roar ' .
			'(bombing or touching a bullet during roar mode) is considered a death in survival runs.';
		}
	?></p>
	<h3><?php
		if ($lang == 'Chinese') { echo '使用额外软件'; }
		else if ($lang == 'Japanese') { echo 'ツールやパッチの使用について'; }
		else if ($lang == 'Russian') { echo 'Использование стороннего ПО'; }
		else { echo 'Use of Third Party Software &amp; Material'; }
	?></h3>
	<p><?php
		if ($lang == 'Chinese') {
			echo 'VP补丁允许使用。各种练习器都允许使用，但不能影响正式推把，也不能影响replay的正常播放。';
		} else if ($lang == 'Japanese') {
			echo 'パッチの使用は許可されています。試合中の練習のためにプラクティスツール（thprac等）を使用することは許可されていますが、' .
			'プラクティスツールを用いたプレイは無効とします。';
		} else if ($lang == 'Russian') {
			echo 'Vsync патч разрешен. Патчи для практики (например thprac) можно использовать, ' .
			'но читы должны быть отключены во время забегов.';
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
		} else if ($lang == 'Russian') {
			echo 'Визуальные патчи (например для показа хитбокса) запрещены. Патчи на перевод разрешены, ' .
			'но нежелательны. Патчи на изменение аудио/музыки разрешены если они не нарушают авторских прав.';
		} else {
			echo 'Visual patches (e.g. hitbox patch) are prohibited. Translation patches are allowed but discouraged. ' .
			'Audio patches/background music is allowed but no copyrighted material.';
		}
	?></p>
	<h3><?php
		if ($lang == 'Chinese') { echo '其他规则'; }
		else if ($lang == 'Japanese') { echo 'その他のルール'; }
		else if ($lang == 'Russian') { echo 'Другие правила'; }
		else { echo 'Other Rules'; }
	?></h3>
	<ul>
		<?php
			if ($lang == 'Chinese') {
				echo '<li>比赛指定开始时间后的推把才算有效。</li>' .
				'<li>选手在比赛期间无限制推把，推把时间到了之后的推把无效。</li>' .
				'<li>通关总是优于疮痍，不论分数。</li>' .
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
				'<li>スコアアタックマッチのプレイでは、スコアの如何に関わらず、' .
				'クリアリプレイが満身創痍のリプレイより常に優位となります。</li>' .
				'<li>プレイヤーはプレイ中のゲーム画面を配信しなければなりません。' .
				'ゲーム画面をそのまま配信し、形を変えたり切り取りをしないでください。</li>' .
				'<li>プレイヤーは画像、入力表示、カメラなどの要素を画面上に配置することを許可されていますが、' .
				'その場合はゲーム内の各種情報を覆わないようにしてください。</li>' .
				'<li>クリア後は必ずリプレイを保存してください。</li>' .
				'<li>クリア後のエンディングは必ず隠してください。</li>';
			} else if ($lang == 'Russian') {
				echo '<li>Считаются только забеги которые начались после старта таймера.</li>' .
				'<li>Игроки могут начать столько забегов, сколько захотят. Когда на стриме таймер остановлен, ' .
				'начинать новый забег нельзя.</li><li>Полное прохождение (1сс) игры всегда будет побеждать ' .
				'над геймовером вне зависимости от разницы в скоре.</li><li>Игроки должны стримить свои забеги. '
				.'Только стрим своей игры: нельзя использовать оверлеи которые каким-то образом обрезают стрим</li>' .
				'<li>Стримерам разрешено использовать оверлеи (такие как картинки, дисплей нажатых ' .
				'клавиш, вебкамеры и т.д.) в своих стримах, но окно геймплея и всю информацию в интерфейсе ' .
				'игры скрывать нельзя.</li><li>Законченные забеги должны быть сохранены в качестве реплея.</li>' .
				'<li>Нельзя показывать концовку игры после забега.</li>';
			} else {
				echo '<li>Runs only count from the moment the timer has started.</li>' .
				'<li>Players can start as many runs as they want during the match. ' .
				'When the timer has finished on stream, no new runs can be started anymore.</li>' .
				'<li>A clear is always better than a gameover, no matter the score difference.</li>' .
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
				else if ($lang == 'Russian') { echo 'Японский перевод сделал ' .
				'<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.'; }
				else { echo 'The Japanese translation was done by <a href="https://twitter.com/toho_yumiya">Yu-miya</a>.'; }
			?>
		</p>
		<p id='cntlcredit'>
			<?php
				if ($lang == 'Chinese') { echo '本页面由' .
				'<a href="https://space.bilibili.com/107846194">Komeiji Compiler</a>中文翻译。'; }
				else if ($lang == 'Japanese') { echo '<a href="https://space.bilibili.com/107846194">' .
				'Komeiji Compiler</a>によって中国語に翻訳されました。'; }
				else if ($lang == 'Russian') { echo 'Китайский перевод сделал ' .
				'<a href="https://space.bilibili.com/107846194">Komeiji Compiler</a>.'; }
				else { echo 'The Simplified Chinese translation was done by ' .
				'<a href="https://space.bilibili.com/107846194">Komeiji Compiler</a>.'; }
			?>
		</p>
		<p id='rutlcredit'>
			<?php
				if ($lang == 'Chinese') { echo '本页面由' .
				'<a href="https://www.twitch.tv/kvs_stg">kvasovy</a>俄语翻译。'; }
				else if ($lang == 'Japanese') { echo '<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>' .
				'によってロシア語に翻訳されました。'; }
				else if ($lang == 'Russian') { echo 'Русский перевод сделал ' .
				'<a href="https://www.twitch.tv/kvs_stg">kvasovy</a>.'; }
				else { echo 'The Russian translation was done by ' .
				'<a href="https://www.twitch.tv/kvs_stg">kvasovy</a>.'; }
			?>
		</p>
        <p id='ack_mobile'>
			<?php
				if ($lang == 'Chinese') { echo '背景画师：' .
				'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>。'; }
				else if ($lang == 'Japanese') { echo '背景イメージは' .
				'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>さんのものを使用させていただいております。'; }
				else if ($lang == 'Russian') { echo 'Иллюстрацию на фоне нарисовал(а) ' .
				'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>.'; }
				else { echo 'The background image was drawn by ' .
				'<a href="https://www.pixiv.net/en/users/186860">宇文風</a>.'; }
			?>
		</p>
	</div>
    <p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang); ?></a></strong></p>
</div>
