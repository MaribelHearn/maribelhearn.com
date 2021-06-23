<!DOCTYPE html>
<html id='top' lang='en'>
<?php
	include 'assets/shared/shared.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

	<head>
		<title>Touhou Fangame and Related Game Accomplishments</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='List of accomplishments for fanmade Touhou shooting games as well as Touhou-related or Touhou-inspired ones. Includes both notable score runs as well as LNNs (no miss no bomb).'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, fangame, fangames, fanmade, lnn, seihou, 西方, scores, high scores, scoring'>
		<link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=fangame'>
		<link rel='icon' type='image/x-icon' href='assets/fangame/fangame.png'>
        <script src='assets/shared/js_concat.php?page=fangame' defer></script>
	</head>

    <body>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
			<div id='wrap' class='wrap'>
				<p id='ack'>This background image<br class='ack_br'>
				was drawn by <a href='https://www.pixiv.net/en/users/4936550'>明ノ宮 飛鳥</a><br class='ack_br'>
				(<a href='https://www.pixiv.net/en/artworks/75237542'>Source</a>)</p>
				<span id='hy_container'><span id='hy'></span>
					<span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
				</span>
				<h1>Touhou Fangame and Related Game Accomplishments</h1>
	            <p id='description'>This page lists known Lunatic No Miss No Bomb (LNN) clears and
				notable high scores for Touhou fangames, as well as Touhou-related games. For LNNs, any additional
				survival condition(s) are listed with the game titles.</p>
	            <p id='tables'>All of the table columns are sortable.</p>
	            <p id='noreup'>The replays or videos provided are <strong>not</strong> meant to be reuploaded anywhere.</p>
	            <p id='lastupdate'>Accomplishments are current as of 21 June 2021.</p>
	            <h2 id='contents_header'>Contents</h2>
	            <div id='contents' class='border'>
					<p><a href='#lnns'>LNN Clears</a></p>
	                <p><a href='#scores'>Notable Scores</a></p>
	            </div>
				<h2 id='lnns'>LNN Clears</h2>
				<h3 class='fangames'>Fangames</h3>
				<p><span class='fangame sss'></span> Shining Shooting Star (No Border Breaks, Full Spell)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>HNY</td>
						<td>Reimu</td>
						<td>3,454,497,870</td>
						<td>9 September 2016</td>
						<td><a href='http://www.bilibili.com/video/av6213977'>Video</a></td>
					</tr><tr>
						<td>CreepyNinja</td>
						<td>Marisa</td>
						<td>5,860,706,620</td>
						<td>3 May 2018</td>
						<td><a href='https://mega.nz/#!4VRBnZbT!qcNY8rHd8jhV8fHt-WYYOHndrrcEZ54BxsjTlUZ6dhA'>Replay</a><br>
						<a href='https://www.youtube.com/watch?v=M0l9Q7gTIK0'>Video</a></td>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>Sanae</td>
						<td>3,995,013,640</td>
						<td>30 January 2019</td>
						<td><a href='https://cdn.discordapp.com/attachments/175267714904883200/540134437212520458/thSSS_24.rpy'>Replay</a><br>
						<a href='https://www.youtube.com/watch?v=Po8j8fqmsQY'>Video</a></td>
					</tr><tr>
						<td>4411022</td>
						<td>Sanae</td>
						<td>3,532,814,310</td>
						<td>8 July 2020</td>
						<td><a href='https://www.bilibili.com/video/BV1j54y1q73u'>Video</a></td>
					</tr><tr>
						<td>SLSPC</td>
						<td>Koishi</td>
						<td>6,225,979,700</td>
						<td>6 June 2018</td>
						<td><a href='https://pan.baidu.com/s/1jNRpFqsCPwC7sWiDdla1zA'>Replay</a></td>
					</tr>
				</table>
				<p><span class='fangame mb'></span> Marine Benefit</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>A2</td>
						<td>ReimuA</td>
						<td>342,936,850</td>
						<td>5 January 2018</td>
						<td><a href='https://www.bilibili.com/video/av18002342/'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame wnsp'></span> White Names Spoiled Past</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>A2</td>
						<td>ReimuA</td>
						<td>342,936,850</td>
						<td>9 May 2018</td>
						<td><a href='https://www.bilibili.com/video/av18002342'>Video (Lap 2)</a></td>
					</tr>
				</table>
				<p><span class='fangame fos'></span> Fairies of Sorcery (No Burst)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>A2</td>
						<td>MarisaD</td>
						<td>1,283,711,976</td>
						<td>29 April 2018</td>
						<td><a href='https://www.bilibili.com/video/av18002342'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame fdf'></span> Fantastic Danmaku Festival</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='version'>Version</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>CYH</td>
						<td>Reimu</td>
						<td>1.05</td>
						<td>1,859,705,300</td>
						<td>9 October 2019</td>
						<td><a href='https://www.bilibili.com/video/av70648792'>Video</a></td>
					</tr><tr>
						<td>Pieraz</td>
						<td>Reimu</td>
						<td>1.05</td>
						<td>1,766,199,550</td>
						<td>9 April 2021</td>
						<td><a href='https://www.youtube.com/watch?v=x5WZXunfCzw'>Video</a></td>
					</tr><tr>
						<td>ZY</td>
						<td>Reimu</td>
						<td>1.04</td>
						<td>984,670,662</td>
						<td>21 June 2018</td>
						<td><a href='https://www.bilibili.com/video/av25450352'>Video</a></td>
					</tr><tr>
						<td>CYH</td>
						<td>Marisa</td>
						<td>1.05</td>
						<td>1,702,676,940</td>
						<td>18 November 2019</td>
						<td><a href='https://www.bilibili.com/video/av76141490'>Video</a></td>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>Marisa</td>
						<td>1.05</td>
						<td>1,633,333,410</td>
						<td>6 February 2019</td>
						<td><a href='https://cdn.discordapp.com/attachments/229569755344928768/857279171978068028/thmhj_10.rpy'>Replay<br>
						<a href='https://www.youtube.com/watch?v=9GvQe8pdhVg'>Video</a></td>
					</tr><tr>
						<td>CreepyNinja</td>
						<td>Marisa</td>
						<td>1.04</td>
						<td>1,021,134,292</td>
						<td>19 June 2018</td>
						<td><a href='https://mega.nz/#!kIhikCTD!6Y4CK4FFf7-Z-t-NMwGwYhEZfKpuLMXqZk8XQJ7B_M8'>Replay</a><br>
						<a href='https://www.youtube.com/watch?v=bAJjVB7EYmw'>Video</a></td>
					</tr><tr>
						<td>CYH</td>
						<td>Patchouli</td>
						<td>1.05</td>
						<td>1,820,677,710</td>
						<td>18 November 2019</td>
						<td><a href='https://www.bilibili.com/video/av76228814'>Video</a></td>
					</tr><tr>
						<td>Seiko</td>
						<td>Patchouli</td>
						<td>1.05</td>
						<td>1,755,614,240</td>
						<td>-</td>
						<td><a href='https://www.bilibili.com/video/av56467454' class='dead'>Video</a></td>
					</tr><tr>
						<td>Seiko</td>
						<td>Patchouli</td>
						<td>1.02</td>
						<td>1,288,052,780</td>
						<td>-</td>
						<td><a href='https://www.bilibili.com/video/av56247099' class='dead'>Video</a></td>
					</tr><tr>
						<td>A2</td>
						<td>Patchouli</td>
						<td>1.04</td>
						<td>1,056,326,631</td>
						<td>7 March 2018</td>
						<td><a href='https://www.bilibili.com/video/av20483547'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame fdf2'></span> Fantastic Danmaku Festival Part II (No Border Breaks)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>HNY</td>
						<td>Reimu</td>
						<td>16,410,120,970</td>
						<td>6 May 2019</td>
						<td><a href='https://www.bilibili.com/video/av51649165'>Video</a></td>
					</tr><tr>
						<td>Seiko</td>
						<td>Youmu</td>
						<td>15,896,422,930</td>
						<td>-</td>
						<td><a href='https://www.bilibili.com/video/av74628342' class='dead'>Video</a></td>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>Youmu</td>
						<td>13,460,164,050</td>
						<td>6 March 2020</td>
						<td><a href='https://www.youtube.com/watch?v=vCxVc8SxGC8'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame tfs'></span> The Flower Shooter</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>A2</td>
						<td>PlaneB</td>
						<td>848,259,620</td>
						<td>9 January 2018</td>
						<td><a href='https://www.bilibili.com/video/av18118720'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame hsob'></span> Hollow Song of Birds (No Z-Spells, Full Spell)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>NFkarl</td>
						<td>ReimuOrange</td>
						<td>5,934,573,570</td>
						<td>16 February 2019</td>
						<td><a href='https://www.bilibili.com/video/av43824461'>Video</a></td>
					</tr><tr>
						<td>namae ex</td>
						<td>SakuyaOrange</td>
						<td>6,138,736,940</td>
						<td>17 October 2019</td>
						<td><a href='https://www.youtube.com/watch?v=jNcVg9TVcUQ'>Video</a></td>
					</tr><tr>
						<td>cody.porsche</td>
						<td>KaguyaBlue</td>
						<td>5,525,596,490</td>
						<td>21 March 2020</td>
						<td><a href='https://www.youtube.com/watch?v=0XhWfIpLLkQ'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame mpp'></span> Mystical Power Plant</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='route'>Route</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>ReimuB</td>
						<td>Omote</td>
						<td>42,963,771,265</td>
						<td>23 February 2019</td>
						<td><a href='https://cdn.discordapp.com/attachments/175267714904883200/549591467149230108/MPP_Package_replay07.dat'>Replay<br>
						<a href='https://www.youtube.com/watch?v=kuagd1wUJeQ'>Video</a></td>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>ReimuB</td>
						<td>Ura</td>
						<td>11,345,581,028</td>
						<td>2 March 2019</td>
						<td><a href='https://cdn.discordapp.com/attachments/175267714904883200/552123320519098369/MPP_Package_replay11.dat'>Replay<br>
						<a href='https://www.youtube.com/watch?v=C9endry0cno'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame bosm'></span> Book of Star Mythology (Full Spell)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>namae ex</td>
						<td>ReimuA</td>
						<td>22,237,781,980</td>
						<td>18 October 2020</td>
						<td><a href='https://www.youtube.com/watch?v=e0SAQQ3TNIk'>Video</a></td>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>ReimuB</td>
						<td>20,724,198,480</td>
						<td>5 November 2019</td>
						<td><a href='https://cdn.discordapp.com/attachments/229569755344928768/857279695740338225/Main_replay70.dat'>Replay</a><br>
						<a href='https://www.youtube.com/watch?v=WDx-WbUOFO4&t=0s'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame gods'></span> Glory of Deep Skies (No Elemental Burst, Full Spell)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>ReimuB</td>
						<td>457,145,370</td>
						<td>10 October 2019</td>
						<td><a href='https://cdn.discordapp.com/attachments/229569755344928768/857279863279190016/Package_replay10.dat'>Replay</a><br>
						<a href='https://www.youtube.com/watch?v=nz4ZpqsyoKM'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame rss'></span> Riverbed Soul Saver (No Hyper)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>DarkPermafrost</td>
						<td>FutoB</td>
						<td>10,340,653,140</td>
						<td>23 February 2020</td>
						<td><a href='https://cdn.discordapp.com/attachments/229569755344928768/857280067289874432/Package_replay14.dat'>Replay</a><br>
						<a href='https://www.youtube.com/watch?v=GikbAJLP0UM'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame rss'></span> Riverbed Soul Saver Overdrive (No Hyper)</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>EOH</td>
						<td>MarisaB</td>
						<td>30,273,098,120</td>
						<td>5 June 2015</td>
						<td><a href='https://www.bilibili.com/video/av2400519'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame ibp'></span> Infinite Blade Pavilion</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>namae ex</td>
						<td>ReimuA</td>
						<td>4,192,893,820</td>
						<td>22 September 2020</td>
						<td><a href='https://www.youtube.com/watch?v=6VhfizriE1M'>Video</a></td>
					</tr><tr>
						<td>cody.porsche</td>
						<td>YoumuA</td>
						<td>3,422,339,570</td>
						<td>5 October 2020</td>
						<td><a href='https://www.youtube.com/watch?v=3-l_gWYCakA'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame bm'></span> Barrage Musical</p>
				<table class='sortable'>
					<tr>
						<th class='player'>Player</th>
						<th class='shottype'>Shottype</th>
						<th class='sorttable_numeric'>Score</th>
						<th class='date'>Date</th>
						<th class='source'>Source</th>
					</tr><tr>
						<td>HNY</td>
						<td>MistyB</td>
						<td>19,206,981,440</td>
						<td>22 September 2017</td>
						<td><a href='https://www.bilibili.com/video/BV1xx411u7Yz'>Video</a></td>
					</tr>
				</table>
				<h2 id='scores'>Notable Scores</h2>
				<h3 class='fangames'>Fangames</h2>
	            <p><span class='fangame sss'></span> Shining Shooting Star</p>
	            <table class='sortable'>
	                <tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
	                    <td>Lunatic</td>
	                    <td>Sanae</td>
	                    <td><strong><u><abbr title='10,214,869,510'>9,999,999,999</abbr></u></strong><br>by <em>LYX</em></td>
	                    <td>11 August 2016</td>
	                    <td><a href='https://www.youtube.com/watch?v=BDp0uCQuf4A'>Video</a></td>
	                </tr><tr>
	                    <td>Lunatic</td>
	                    <td>Koishi</td>
	                    <td><strong><u><abbr title='10,724,671,580'>9,999,999,999</abbr></u></strong><br>by <em>LYX</em></td>
	                    <td>23 April 2017</td>
	                    <td><a href='https://www.youtube.com/watch?v=E-JRFQDO-mE'>Video</a></td>
	                </tr><tr>
	                    <td>Lunatic</td>
	                    <td>Reimu</td>
	                    <td><strong><u><abbr title='10,097,406,430'>9,999,999,999</abbr></u></strong><br>by <em>LYX</em></td>
	                    <td>3 June 2017</td>
	                    <td><a href='https://www.youtube.com/watch?v=LkoHld-Ec_Q'>Video</a></td>
	                </tr><tr>
	                    <td>Extra</td>
	                    <td>Koishi</td>
	                    <td><u>1,212,656,860</u><br>by <em>LYX</em></td>
	                    <td>9 May 2017</td>
	                    <td><a href='http://www.bilibili.com/video/av10443836'>Video</a></td>
	                </tr>
	            </table>
				<p><span class='fangame bosm'></span> Book of Star Mythology</p>
				<table class='sortable'>
					<tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Easy</td>
						<td>SanaeA</td>
						<td><u>16,291,785,740</u><br>by <em>LIDERA</em></td>
						<td>23 November 2016</td>
						<td><a href='https://pbs.twimg.com/media/C05xFANUcAAwi5T?format=jpg&name=small'>Screenshot</a></td>
					</tr><tr>
						<td>Normal</td>
						<td>SanaeA</td>
						<td><u>21,218,595,690</u><br>by <em>LIDERA</em></td>
						<td>19 November 2016</td>
						<td><a href='https://cdn.discordapp.com/attachments/229569755344928768/856824581636620288/Main_replay33.dat'>Replay</a></td>
					</tr><tr>
	                    <td>Lunatic</td>
	                    <td>SanaeA</td>
	                    <td><strong><u>33,001,077,600</u></strong><br>by <em>LIDERA</em></td>
	                    <td>4 November 2016</td>
	                    <td><a href='https://cdn.discordapp.com/attachments/229569755344928768/856824843667243038/Main_replay28.dat'>Replay</a></td>
	                </tr><tr>
	                    <td>Extra</td>
	                    <td>SanaeA</td>
	                    <td><u>15,161,710,590</u><br>by <em>LIDERA</em></td>
	                    <td>30 December 2016</td>
	                    <td><a href='https://cdn.discordapp.com/attachments/229569755344928768/856824119134781440/Main_replay09.dat'>Replay</a></td>
	                </tr>
				</table>
				<p><span class='fangame fdf2'></span> Fantastic Danmaku Festival Part II</p>
				<table class='sortable'>
					<tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Easy</td>
						<td>Reimu</td>
						<td><u>21,372,820,800</u><br>by <em>LYX</em></td>
						<td>22 November 2019</td>
						<td><a href='https://www.bilibili.com/video/BV18J41117VQ'>Video</a></td>
					</tr><tr>
						<td>Normal</td>
						<td>Marisa</td>
						<td><u>29,279,007,010</u><br>by <em>LYX</em></td>
						<td>22 November 2019</td>
						<td><a href='https://www.bilibili.com/video/BV1HJ41117Rm'>Video</a></td>
					</tr><tr>
						<td>Hard</td>
						<td>Sanae</td>
						<td><u>35,987,665,340</u><br>by <em>LYX</em></td>
						<td>22 November 2019</td>
						<td><a href='https://www.bilibili.com/video/BV1sJ41117sC'>Video</a></td>
					</tr><tr>
						<td>Lunatic</td>
						<td>Reimu</td>
						<td><u><strong>42,733,440,570</strong></u><br>by <em>sogo omiya</em></td>
						<td>10 June 2020</td>
						<td><a href='https://www.twitch.tv/videos/646450904'>VOD</a></td>
					</tr><tr>
						<td>Lunatic</td>
						<td>Youmu</td>
						<td>41,295,590,120<br>by <em>LYX</em></td>
						<td>9 January 2020</td>
						<td><a href='https://www.bilibili.com/video/BV1FJ411V79a'>Video</a></td>
					</tr><tr>
						<td>Lunatic</td>
						<td>Marisa</td>
						<td>36,005,710,130<br>by <em>sogo omiya</em></td>
						<td>-</td>
						<td>-</td>
					</tr><tr>
						<td>Lunatic</td>
						<td>Sanae</td>
						<td>32,539,279,420<br>by <em>sogo omiya</em></td>
						<td>7 September 2019</td>
						<td><a href='https://www.bilibili.com/video/BV1r4411k7JM'>Video</a></td>
					</tr><tr>
						<td>Extra</td>
						<td>Marisa</td>
						<td><u>8,360,481,850</u><br>by <em>LYX</em></td>
						<td>21 August 2019</td>
						<td><a href='https://www.bilibili.com/video/BV1t441197Rb'>Video</a></td>
					</tr><tr>
						<td>Phantasm</td>
						<td>Youmu</td>
						<td><u>9,000,906,610</u><br>by <em>LYX</em></td>
						<td>21 August 2019</td>
						<td><a href='https://www.bilibili.com/video/BV14441197Hi'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame hsob'></span> Hollow Song of Birds</p>
				<table class='sortable'>
					<tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Lunatic</td>
						<td>SakuyaPurple</td>
						<td><u><strong>55,169,742,690</strong></u><br>by <em>LIDERA</em></td>
						<td>3 March 2019</td>
						<td><a href='https://www.nicovideo.jp/watch/sm34720492'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame ibp'></span> Infinite Blade Pavilion</p>
				<table class='sortable'>
					<tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
						<th class='version'>Version</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Lunatic</td>
						<td>MarisaB</td>
						<td>1.00a</td>
						<td><u><strong>36,041,077,480</strong></u><br>by <em>LIDERA</em></td>
						<td>18 September 2020</td>
						<td><a href='https://www.youtube.com/watch?v=ZOSDZbKp4-U'>Video</a></td>
					</tr><tr>
						<td>Extra</td>
						<td>MarisaB</td>
						<td>1.10</td>
						<td><u>3,993,833,440</u><br>by <em>LIDERA</em></td>
						<td>22 March 2021</td>
						<td><a href='https://www.youtube.com/watch?v=vBmKScNyNmk'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame pt'></span> Phantasmagoria Trues</p>
				<table class='sortable'>
					<tr>
	                    <th class='zone'>Zone</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Advanced</td>
						<td>Default MarisaA</td>
						<td><u><strong>4,508,088,108,712,984,576</strong></u><br>by <em>yakamino</em></td>
						<td>1 August 2020</td>
						<td><a href='https://pbs.twimg.com/media/EeUije9UwAIRd-6.jpg:large'>Screenshot</a></td>
					</tr><tr>
						<td>Unlimited</td>
						<td>Default MarisaA</td>
						<td><u>3,162,576,147,384,893,440</u><br>by <em>yakamino</em></td>
						<td>1 February 2020</td>
						<td><a href='https://pbs.twimg.com/media/EPr5ZjCUYAA_2jJ.jpg:large'>Screenshot</a></td>
					</tr><tr>
						<td>Unlimited</td>
						<td>Default ReimuB</td>
						<td>1,625,850,043,015,626,752<br>by <em>Vierne</em></td>
						<td>6 August 2016</td>
						<td><a href='https://www.youtube.com/watch?v=GAYmbKeVZE8'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame eios'></span> Elegant Impermanence of Sakura</p>
				<table class='sortable'>
					<tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Easy</td>
						<td>Marisa &amp; Yuyuko</td>
						<td><u>16,446,817,420</u><br>by <em>LYX</em></td>
						<td>2 June 2020</td>
						<td><a href='https://www.bilibili.com/video/BV1Sg4y1i77d'>Video</a></td>
					</tr><tr>
						<td>Normal</td>
						<td>Mokou &amp; Keine</td>
						<td><u>17,284,976,810</u><br>by <em>LYX</em></td>
						<td>16 June 2020</td>
						<td><a href='https://www.bilibili.com/video/BV1Xt4y1X72f'>Video</a></td>
					</tr><tr>
						<td>Hard</td>
						<td>Mokou &amp; Keine</td>
						<td><u>23,332,866,690</u><br>by <em>LYX</em></td>
						<td>2 July 2020</td>
						<td><a href='https://www.bilibili.com/video/BV1Zk4y1z731'>Video</a></td>
					</tr><tr>
						<td>Lunatic</td>
						<td>Mokou &amp; Keine</td>
						<td><u><strong>29,569,674,680</strong></u><br>by <em>LYX</em></td>
						<td>29 August 2020</td>
						<td><a href='https://www.bilibili.com/video/BV1xh411R7HK'>Video</a></td>
					</tr><tr>
						<td>Extra</td>
						<td>Mokou &amp; Keine</td>
						<td><u>5,034,477,510</u><br>by <em>LYX</em></td>
						<td>16 May 2020</td>
						<td><a href='https://www.bilibili.com/video/BV1zZ4y1s7ya'>Video</a></td>
					</tr>
				</table>
				<p><span class='fangame sohw'></span> Servants of Harvest Wish</p>
				<table class='sortable'>
					<tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Lunatic</td>
						<td>RyoukoB</td>
						<td><u><strong>11,210,861,390</strong></u><br>by <em>XCF</em></td>
						<td>22 January 2021</td>
						<td><a href='https://www.bilibili.com/video/BV18y4y117aF'>Video</a></td>
					</tr><tr>
						<td>Lunatic</td>
						<td>RyoukoB</td>
						<td>5,661,758,500<br>by <em>LIDERA</em></td>
						<td>12 July 2020</td>
						<td><a href='https://www.youtube.com/watch?v=d_1lHqpnhLA'>Video</a></td>
					</tr><tr>
						<td>Extra</td>
						<td>RyoukoB</td>
						<td><u>3,012,190,710</u><br>by <em>LIDERA</em></td>
						<td>14 July 2020</td>
						<td><a href='https://www.youtube.com/watch?v=zNTMsiprIGA'>Video</a></td>
					</tr>
				</table>
				<h3 class='related'>Related Games</h3>
	            <p><span class='fangame sg'></span> Seihou 1 - Shuusou Gyoku</p>
	            <table class='sortable'>
	                <tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
	                    <td>Lunatic</td>
	                    <td>VIVIT-C</td>
	                    <td><strong><u>614,467,900</u></strong><br>by <em>Starshine</em></td>
	                    <td>13 September 2019</td>
	                    <td><a href='https://www.youtube.com/watch?v=QuC_XwimX7A'>Video</a></td>
	                </tr><tr>
	                    <td>Lunatic</td>
	                    <td>VIVIT-C</td>
	                    <td>512,626,640<br>by <em>Starshine</em></td>
	                    <td>20 September 2018</td>
	                    <td><a href='https://www.youtube.com/watch?v=yg1v4aqELyI'>Video</a></td>
	                </tr>
	            </table>
	        	<p><span class='fangame kg'></span> Seihou 2 - Kioh Gyoku</p>
	            <table class='sortable'>
	                <tr>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Yuuka</td>
						<td><strong><u>12,322,190</u></strong><br>by <em>Senora Papaya</em></td>
						<td>27 October 2019</td>
						<td><a href='https://www.youtube.com/watch?v=_knC-Mn9Onw'>Video</a></td>
					</tr><tr>
						<td>VIVIT</td>
						<td><u>11,910,350</u><br>by <em>Senora Papaya</em></td>
						<td>6 March 2021</td>
						<td><a href='https://www.youtube.com/watch?v=wGP0jzm_Xm0'>Video</a></td>
					</tr><tr>
	                    <td>VIVIT</td>
	                    <td>8,074,490<br>by <em>Zigzagwolf</em></td>
	                    <td>1 October 2016</td>
	                    <td><a href='https://www.youtube.com/watch?v=dhlwHyF8yqY'>Video</a></td>
	                </tr><tr>
	                    <td>Gates</td>
	                    <td><u>9,463,930</u><br>by <em>Senora Papaya</em></td>
	                    <td>11 August 2020</td>
						<td><a href='https://www.youtube.com/watch?v=cMikTTjYmTg'>Video</a></td>
					</tr><tr>
	                    <td>Mei and Mai</td>
	                    <td><u>9,084,670</u><br>by <em>Senora Papaya</em></td>
	                    <td>9 October 2020</td>
						<td><a href='https://www.youtube.com/watch?v=v4GKuPz7vHU'>Video</a></td>
					</tr><tr>
	                    <td>Marie</td>
	                    <td><u>8,444,670</u><br>by <em>Senora Papaya</em></td>
	                    <td>3 January 2021</td>
						<td><a href='https://www.youtube.com/watch?v=7QFytfKP7r8'>Video</a></td>
					</tr><tr>
	                    <td>Muse</td>
	                    <td><u>7,369,000</u><br>by <em>Senora Papaya</em></td>
	                    <td>11 October 2020</td>
						<td><a href='https://www.youtube.com/watch?v=t5yqWKTT2Os'>Video</a></td>
					</tr>
	            </table>
	        	<p><span class='fangame bsr'></span> Seihou 3 - Banshiryuu (C67 version)</p>
	            <table class='sortable'>
	                <tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
	                    <td>Easy</td>
	                    <td>HiranoS</td>
	                    <td><strong><u>206,254,030</u></strong><br>by <em>Maribel Hearn</em></td>
						<td>21 October 2019</td>
	                    <td><a href='https://www.youtube.com/watch?v=r-xKFTUhNP8'>Video</a></td>
	                </tr><tr>
						<td>Easy</td>
						<td>HiranoS</td>
						<td>168,311,500<br>by <em>morth</em></td>
						<td>29 September 2016</td>
						<td><a href='https://www.youtube.com/watch?v=s-mv2j1jtao'>Video</a></td>
					</tr>
	            </table>
	        	<p><span class='fangame smd'></span> Samidare</p>
	            <table class='sortable'>
	                <tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Maingame</td>
						<td><u>49,426,402</u><br>by <em>nonokuro</em></td>
						<td>4 January 2006</td>
						<td><a href='https://www.youtube.com/watch?v=XB4AuLZAmEk'>Video</td>
					</tr><tr>
						<td>Maingame</td>
						<td>46,815,936<br>by <em>Maribel Hearn</em></td>
						<td>9 December 2017</td>
						<td><a href='https://www.youtube.com/watch?v=V0-Vb1TX7V8'>Video</a></td>
					</tr><tr>
	                    <td>Extra</td>
	                    <td><strong><u>294,204,460</u></strong><br>by <em>Maribel Hearn</em></td>
						<td>17 November 2017</td>
	                    <td><a href='https://www.youtube.com/watch?v=ALCrslNqGmo'>Video</a></td>
	                </tr><tr>
	                    <td>Extra</td>
	                    <td>293,801,780<br>by <em>Cube</em></td>
						<td>9 January 2010</td>
	                    <td>-</td>
	                </tr><tr>
	                    <td>Extra</td>
	                    <td>290,153,720<br>by <em>DXS</em></td>
						<td>5 October 2010</td>
	                    <td><a href='https://www.nicovideo.jp/watch/sm12329692'>Video</a></td>
	                </tr><tr>
	                    <td>Extra</td>
	                    <td>289,552,640<br>by <em>KKC</em></td>
						<td>3 December 2008</td>
	                    <td>-</td>
	                </tr><tr>
						<td>Extra</td>
						<td>277,084,090<br>by <em>nonokuro</em></td>
						<td>6 March 2005</td>
	                    <td>-</td>
					</tr><tr>
						<td>Extra</td>
						<td>244,718,310<br>by <em>NULLPO</em></td>
						<td>1 February 2005</td>
	                    <td>-</td>
					</tr>
	            </table>
	        	<p><span class='fangame mrs'></span> Mrs. Estacion</p>
	            <table class='sortable'>
	                <tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
	                    <td>Easy</td>
	                    <td>HimekaB</td>
	                    <td><u>348,933,504,628</u><br>by <em>Maribel Hearn</em></td>
						<td>11 January 2018</td>
	                    <td><a href='https://www.youtube.com/watch?v=9gCZ_RilU40'>Video</a></td>
	                </tr><tr>
						<td>Normal</td>
						<td>HimekaB</td>
	                    <td><strong><u>813,055,575,838</u></strong><br>by <em>Tabris</em></td>
						<td>27 July 2010</td>
	                    <td><a href='http://www.nicovideo.jp/watch/sm11528998'>Video</a></td>
					</tr><tr>
						<td>Special</td>
						<td>HimekaB</td>
						<td><u>114,994,208,403</u><br>by <em>Maribel Hearn</em></td>
						<td>17 June 2016</td>
						<td><a href='https://www.youtube.com/watch?v=hRM74eMjGuY'>Video</a></td>
					</tr>
	            </table>
	        	<p><span class='fangame bm'></span> Barrage Musical</p>
				<table class='sortable'>
	                <tr>
	                    <th class='difficulty'>Difficulty</th>
	                    <th class='shottype'>Shottype</th>
	                    <th class='sorttable_numeric'>Score</th>
	                    <th class='date'>Date</th>
	                    <th class='source'>Source</th>
	                </tr><tr>
						<td>Ultra</td>
						<td>MistyC</td>
	                    <td><strong><u>193,738,728,220</u></strong><br>by <em>sogo omiya</em></td>
						<td>25 January 2018</td>
	                    <td><a href='https://www.youtube.com/watch?v=IZWDG7W67kI'>Video</a></td>
					</tr>
				</table>
				<p id='ack_mobile'>This background image
				was drawn by <a href='https://www.pixiv.net/en/users/4936550'>明ノ宮 飛鳥</a>
				(<a href='https://www.pixiv.net/en/artworks/75237542'>Source</a>).</p>
	            <p id='back'><strong><a href='#top'>Back to Top</a></strong></p>
			</div>
		</main>
    </body>
</html>
