<!DOCTYPE html>
<html id='top' lang='en'>
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
                <p id='ack'>This background image was drawn by <a href='https://www.pixiv.net/en/users/186860'>宇文風</a></p>
                <span id='hy_container'><img id='hy' src='../assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1>Touhou World Cup</h1>
				<p><strong>Touhou World Cup (TWC)</strong> is an annual international Touhou shooting game competition,
				first held in 2020, organised by the Chinese gameplay community.
				This time around, in 2021, it is organised by the Western gameplay community.</p>
				<p>Three teams, a Western community team, a Chinese team, and a Japanese team, duke it out
				on Lunatic and Extra mode, playing on live streams and playing both high score and survival.</p>
				<p>See below for official communication channels, live streams with commentary, the schedule, and the rules the players play by.</p>
				<div id='links'>
					<p>
	                    <img class='icon twitter_icon' src='assets/shared/icon_sheet.png' alt='Twitter icon'>
						<a href='https://twitter.com/touhouworldcup'>Official TWC Twitter</a>
					</p>
					<p>
	                    <img class='icon youtube_icon' src='assets/shared/icon_sheet.png' alt='YouTube icon'>
						<a href='https://www.youtube.com/channel/UCk8o-jk-Zpn4CEmLUIkui0A'>Official TWC YouTube Channel</a>
					</p>
					<p>
						<img src='assets/flags/uk16x16.png' alt='Flag of the United Kingdom'>
						<a href='https://www.twitch.tv/touhou_replay_showcase'>English commentary stream (Twitch)</a>
					</p>
					<p>
						<img src='assets/flags/cn16x16.png' alt='Flag of the P.R.C.'>
						<a href='https://live.bilibili.com/22478102?share_source=copy_link'>Chinese commentary stream 1 (Bilibili)</a><br>
						<img src='assets/flags/cn16x16.png' alt='Flag of the P.R.C.'>
						<a href='https://live.bilibili.com/14315174?share_source=copy_link'>Chinese commentary stream 2 (Bilibili)</a>
					</p>
					<p>
						<img src='assets/flags/jp16x16.png' alt='Flag of Japan'>
						<a href='https://www.youtube.com/channel/UCfF3O4wo0YxppTZGmtTGDwg'>Japanese commentary stream (YouTube)</a>
					</p>
					<p>
						<img src='assets/flags/ru16x16.png' alt='Flag of the Russian Federation'>
						<a href='https://www.twitch.tv/touhou_russian_kolkhoz'>Russian commentary stream (Twitch)</a>
					</p>
				</div>
                <h2 id='contents'>Contents</h2>
                <div id='contents_div' class='border'>
                    <p><a href='#schedule'>Schedule</a></p>
                    <p><a href='#rules'>Rules</a></p>
                </div>
				<h2 id='schedule'>Schedule</h2>
				<p>Your time zone was detected as <span id='timezone'></span>.</p>
				<p>Daylight Saving Time (also known as Summer Time or DST) is taken into account automatically.</p>
				<table id='schedule_table'>
					<thead>
						<tr>
							<th rowspan='3'>Date/Time</th>
							<th rowspan='3'>Category</th>
							<th rowspan='3'>Players</th>
							<th rowspan='3'>Reset Time<br>(minutes)</th>
						</tr>
					</thead>
					<tbody id='schedule_tbody'>
					</tbody>
				</table>
				<h2 id='rules'>Rules</h2>
				<h3>Format</h3>
				<p>For every match, each team can earn points. Ranking is based on whoever has the most points:</p>
				<ul>
					<li>1st place - 2 pts</li>
					<li>2nd place - 1 pt</li>
					<li>3rd place - 0 pts</li>
				</ul>
				<p>In 2-team matches, the first place gets 2 points, and 2nd place gets 1 point.</p>
				<p>If multiple players have the exact same amount of ISCORE, their points will be split equally.
				This also means that, if multiple players have the highest ISCORE, the match ends in a tie.</p>
				<p>At the end of the World Cup, the teams will be ranked based on has the most points.</p>
				<h3>Calculating Points</h3>
				<p>The points are based on the <a href='https://www.isndes.com/jf'>ISCORE calculator</a>.</p>
				<p>Score matches are calculated based on the ISCORE formula. Survival matches (except for GFW) are calculated as follows:</p>
				<p><tt>(ISCORE No Miss No Bomb Score)*0.5^(deaths)</tt></p>
				<p>In survival runs, bombs are counted as 2 deaths.</p>
				<p>ISCORE is a scoring metric that compensates for the differences in performance between shot types and categories.
				The formulas used can be found in the ISCORE rubric with the calculator linked above.</p>
				<h3>Game-specific Concerns</h3>
				<h4>Touhou 7</h4>
				<p>A border break is considered a death in survival runs.</p>
				<h4>Touhou 8</h4>
				<p>Getting hit during a Last Spell is <strong>not</strong> considered a death in survival runs.
				However, ISCORE gives a higher base value in this game to runs that capture all spells
				(which includes unlocking and capturing <strong>every</strong> Last Spell) AND do not die/bomb (NN + Full-SC).same </p>
				<h4>Touhou 12</h4>
				<p>Summoning a UFO is considered a death in survival runs.
				However, collecting tokens does not affect the score in survival runs.</p>
				<h4>Touhou 12.8</h4>
				<p>The survival formula for this game is (gold medals*1.5)-(deaths).</p>
				<h4>Touhou 13</h4>
				<p>A manual trance is considered 2 deaths in survival runs.
				ISCORE gives a higher base value in this game to runs that capture all spells AND does not die/bomb (NN + Full-SC).</p>
				<h4>Touhou 15</h4>
				<p>All runs in both survival/score have to be done in Legacy Mode.</p>
				<h4>Touhou 16</h4>
				<p>Releasing your season gauge is considered 2 deaths in survival runs.</p>
				<h4>Touhou 17</h4>
				<p>Channeling a berserk roar (3 or more of the same animal tokens during roar mode) is considered 2 deaths
				in survival runs. Breaking your roar (bombing or touching a bullet during roar mode) is considered a death
				in survival runs.</p>
				<h3>Use of Third Party Software &amp; Material</h3>
				<p>Vsync patch is allowed. Practice patches (such as thprac) are allowed,
				but all practice cheats have to be disabled for the runs.</p>
				<p>Visual patches (e.g. hitbox patch) are prohibited. Translation patches are allowed but discouraged.
				Audio patches/background music is allowed but no copyrighted material.</p>
				<h3>Other Rules</h3>
				<ul>
					<li>Runs only count from the moment the timer has started.</li>
					<li>Players can start as many runs as they want during the match.
					When the timer has finished on stream, no new runs can be started anymore.</li>
	    			<li>The players have to stream their gameplay. Just stream game footage: no overlay that shapes/crops the stream.</li>
	    			<li>Streamers are allowed to have elements (images, input displays, cameras, etc.) on top of their game.
					However, the gameplay window, as well as all information on the player's HUD, has to be visible at all times.</li>
	    			<li>Finished runs need their replays saved.</li>
	    			<li>Please hide the story ending when your run finishes.</li>
				</ul>
                <p id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/en/users/186860'>宇文風</a>.</p>
                <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
            </div>
        </main>
    </body>

</html>
