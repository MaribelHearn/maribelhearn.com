<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

	<head>
		<title>Touhou Patches and Tools</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Download links for Touhou patches and tools, including Vpatch, SpoilerAL, boss rushes and other practice utilities.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, tool, tools, patch, patches, scorefile, score file, scorefiles, score files, practice, spoileral, boss rush, bossrush, ultra, vpatch'>
		<link rel='stylesheet' type='text/css' href='assets/tools/tools.css'>
		<link rel='icon' type='image/x-icon' href='assets/tools/tools.ico'>
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
            <img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
            <h1>Touhou Patches and Tools</h1>
            <?php
                if (!empty($_GET['redirect'])) {
                    echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
                }
            ?>
            <p>This page contains download links to all kinds of different patches or tools applicable to the official Touhou shooting games.</p>
			<p>Some of the patches are also available at <a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers'>
			<img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> Touhou Patch Center</a> and can be used through
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Download'>their automatic translation patcher and modding tool</a>,
			which can also be downloaded using our mirror below (see THCRAP section).
			These patches will have the favicon of their site next to them.</p>
            <h2 id='contents'>Contents</h2>
            <div class='border'>
                <p><a href='#vpatch'>Vpatch</a></p>
                <p><a href='#thcrap'>THCRAP (Translation patches / Modding tool)</a></p>
                <p><a href='#enbconvertor'><strong>For Windows 10:</strong> DX8 to DX9</a></p>
                <p><a href='#scorefiles'>Completed Scorefiles</a></p>
                <p><a href='#spoileral'>SpoilerAL</a></p>
                <p><a href='#practools'>General Practice Tools</a></p>
                <p><a href='#bossrush'>Boss Rush Patches</a></p>
                <p><a href='#specific'>Specific Pattern Practice</a></p>
                <p><a href='#shottypes'>Shottype Modifications</a></p>
                <p><a href='#hardultra'>Hard Mode / Ultra Patches</a></p>
                <p><a href='#graphical'>Graphical Patches</a></p>
                <p><a href='#emulators'>PC-98 Emulators</a></p>
                <p><a href='#miscellaneous'>Miscellaneous</a></p>
				<p><a href='#ack'>Acknowledgements</a></p>
            </div>
            <!-- Vpatch -->
            <hr>
            <h2 id='vpatch'>Vpatch</h2>
            <p>Removes input delay, allows you to increase in-game FPS (default is 60), optionally fixes several bugs (PCB cherry display, MoF MarisaB 3-power unfocus, UFO 2.147b score display).
            The input delay is mostly prevalent in the older games (EoSD to IN) and running them on Vpatch will significantly improve the gameplay experience.</p>
            <p>Vpatch is applicable to all official shooting games bar HSiFS and WBaWC.</p>
            <a href='https://maribelhearn.com/VsyncPatch.zip' target='_blank'>Download</a>
            <!-- English Patches -->
            <hr>
            <h2 id='thcrap'>THCRAP (Translation patches / Modding tool) <a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'></a></h2>
            <p>Translation patches into English and many other languages, as well as countless modifications to gameplay,
			graphics and more, plus the ability to make your own, are provided by the Touhou Community Reliant Automatic Patcher (THCRAP) for all Windows Touhou games.
			The thpatch.net link also links to instructions on how to use the patcher.</p>
            <a href='https://maribelhearn.com/thcrap.zip' target='_blank'>Download (maribelhearn.com mirror)</a>
            <a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Download' target='_blank'>Download (thpatch.net)</a>
            <!-- Enbconvertor -->
            <hr>
            <h2 id='enbconvertor'>DX8 to DX9 converter</h2>
            <p>Makes the older Touhou Windows games (EoSD, PCB, IN, PoFV and StB) run properly on Windows 10. Extract it into the folders of these games for it to take effect.</p>
            <a href='http://enbdev.com/convertor_dx8_dx9_v0036.htm' target='_blank'>Download</a>
            <!-- Scorefiles for Practice -->
            <hr>
            <h2 id='scorefiles'>Completed Scorefiles</h2>
            <p>These are (mostly) complete <span class='code'>score.dat</span> files useful for practice combined with other tools, as they have unlocked the Extra Stage, every practice stage and spell in Spell Practice for all shottypes.</p>
            <p>All official shooting games aside from VD are included.</p>
            <a href='https://maribelhearn.com/Practice%20Scorefiles.zip' target='_blank'>Download</a>
			<!-- Old link without WBaWC: https://mega.nz/#F!r8hWmCrD!oOkBNotI88acvlhlKUXZiA -->
            <!-- SpoilerAL -->
            <hr>
            <h2 id='spoileral'>SpoilerAL</h2>
            <p>Japanese program that can load <span class='code'>.ssg</span> files that modify the game while it is running, allowing for practice options as well as cheats.
            SpoilerAL SSGs require the <em>original Japanese versions</em> of the games to work. The 4.6 SSGs have practice options such as skipping to a specific frame of the game
            or a specific spell, while the niL SSGs have cheat options such as invincibility. There is also a separate MoF SSG made by <a href='https://twitch.tv/akaldar' target='_blank'>Akaldar</a>
            for efficient practice in that game specifically, a separate GFW SSG, as well as a TD SSG specifically designed for efficient scoring practice,
            made by <a href='https://twitter.com/remilia_kawai' target='_blank'>Leo</a>, a DDC SSG and a LoLK Chapter Practice SSG by <a href='https://twitter.com/32th__System' target='_blank'>32th System</a>
            and separate HSiFS SSGs with cheat options. Be wary of an occasional menu bug that causes an SSG to duplicate itself and make other SSGs invisible.</p>
            <div>
                <p><a href='http://wcs.main.jp/index/software/spal/' target='_blank'>Main Program</a></p>
                <p><a href='http://thusagi.starfree.jp/ssg/th06ssg.zip' target='_blank'>EoSD SSG (4.6)</a></p>
                <p><a href='http://thusagi.starfree.jp/ssg/th07ssg.zip' target='_blank'>PCB SSG (4.6)</a></p>
                <p><a href='http://thusagi.starfree.jp/ssg/th08ssg.zip' target='_blank'>IN SSG (4.6)</a></p>
                <p><a href='http://thusagi.starfree.jp/ssg/th12ssg.zip' target='_blank'>UFO SSG (4.6)</a></p>
                <p><a href='http://thusagi.starfree.jp/ssg/th16ssg.zip' target='_blank'>HSiFS SSG (4.6)</a></p>
				<p><a href='https://mega.nz/#!OpxFSSJB!2eUH91vJAF_ejq7S5r3x5Jx7GYCP67LSSo4BuXhoDa4' target='_blank'>SSGs (niL)</a></p>
                <p><a href='https://cdn.wikiwiki.jp/to/w/let/etc/%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%A0%E3%81%AA%E3%81%A9/SpoilerAL%E7%94%A8%E3%81%AESSG%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB/::attach/th_ssg20080502.zip?rev=8b2466505ba323da7fc610fad805213f&t=20120111011846'>SSGs (LET)</a></p>
                <p><a href='http://www.mediafire.com/file/a4g4awdp4ll5a4n/SSG.zip' target='_blank'>SSGs (niL, English translated)</a></p>
                <p><a href='https://mega.nz/#!QUBTEB5J!idRbiOfr_BKFpMBy9e5qU5Ow1xPkxplVbR72G6Ud0KI' target='_blank'>MoF SSG by Akaldar</a></p>
                <p><a href='https://mega.nz/#!BJwhwYRB!5Zgr6redSWbA2v2vco0b7k00XH-BIeTAPUnW28gI-20' target='_blank'>GFW SSG (English translated)</a></p>
                <p><a href='https://drive.google.com/open?id=1Qs4jOBkDH3dN7tI5X2cJRzd_awZFf80d' target='_blank'>TD Scoring SSG by Leo (English translated)</a></p>
				<p><a href='https://maribelhearn.com/th16_score.ssg' target='_blank'>HSiFS Scoring SSG by Sonitsuku</a></p>
                <p><a href='https://gitlab.com/32th/th14ssg' target='_blank'>DDC SSG by 32th System</a></p>
				<p><a href='https://mega.nz/#!cAwknKTB!3PCN0me2Q3uTXwo4VgfBIouOqf5W0spBEhZwwR2uNfA' target='_blank'>LoLK SSG by CreepyNinja</a></p>
                <p><a href='https://gitlab.com/32th/th15ssg' target='_blank'>LoLK Chapter Practice SSG by 32th System</a></p>
                <p><a href='https://drive.google.com/open?id=1YqL8QSrnvDepMnkKUNPIBJVaJ2XWwZhP' target='_blank'>HSiFS SSG (cheats, English translated)</a></p>
                <p><a href='https://drive.google.com/open?id=1R8YcGWBE1c4jLy2RGfjuqtrpZzR26XA-' target='_blank'>Alternative HSiFS SSG (English translated) </a></p>
            </div>
            <!-- General Practice Tools -->
            <hr>
            <h2 id='practools'>General Practice Tools</h2>
            <p>Patches intended for efficient practice in one or more games, allowing the player to skip to patterns or changing power and such.</p>
			<p><strong>Universal Practice Tool by ACK</strong></p>
			<p>Single practice tool that works on all of the official Touhou shoot 'em up games, allowing you to change settings or skip to patterns at will.</p>
			<a href='https://github.com/ack7139/thprac/releases'>Download</a>
			<p><strong>Practice Tools by <a href='https://twitter.com/Ririanly'>Riri</a></strong></p>
            <p>Tools that allow you to skip to specific patterns in SA, UFO and LoLK, also allowing for other settings like your current power.
            The UFO and LoLK tools are external programs while the SA tool is a modification of the program. The LoLK one was made for v1.00a but mostly functions properly on v1.00b as well.</p>
            <div>
                <p><a href='https://drive.google.com/file/d/0BwqJeqvy1nDpRGRBUy1nX0dNWVU/view' target='_blank'>SA</a></p>
                <p><a href='https://drive.google.com/file/d/0BwqJeqvy1nDpQ1FQaUc5dDlpUEk/view' target='_blank'>UFO</a></p>
                <p><a href='http://www.mediafire.com/download/88ncjlua3hjrma2/th15_assist_2.2.rar' target='_blank'>LoLK</a></p>
            </div>
			<p><strong>WBaWC Practice by <a href='https://twitter.com/Priweejt'>Priw8</a></strong></p>
			<p>Allows skipping to any part of the game, similar to Riri's practice tools, using an in-game menu.</p>
			<a href='https://priw8.github.io/#s=patches/prac' target='_blank'>Download</a>
            <p><strong>GFW "Brown Label" Practice by <a href='https://twitter.com/givemeberserker'>MegaPulse</a></strong></p>
            <p>Modified <span class='code'>.dat</span> files that allow you to practice specific stages of any route in the game. Select A in-game for full stage practice,
            B for midboss and boss and C for boss only. Refer to the readme file for further information.</p>
            <a href='https://mega.nz/#!8LgRVLxa!TQpU7xqurMF9JgWloQAHORx6XhswuK_NaaCk1gStWfs' target='_blank'>Download</a>
            <!-- Boss Rush Patches -->
            <hr>
            <h2 id='bossrush'>Boss Rush Patches</h2>
            <p>Modifications to the main <span class='code'>.dat</span> files of the games that skip stage portions, allowing you to efficiently practice boss battles.
            The skipping applies to both full runs and practice runs.</p>
            <p><strong>Boss Rush Patches by <a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
            <p>All midbosses and bosses are included, everything else being kept the same. There are also 'boss-only' versions that do skip the midbosses.</p>
            <div>
                <p><a href='https://mega.nz/#F!rswTmICb!lnVEolHezNbe4pZPopSqwA' target='_blank'>MoF</a></p>
                <p><a href='https://mega.nz/#F!a4BCTACS!Z3gA684Me36gZK_i4y_5Dg' target='_blank'>SA</a></p>
                <p><a href='https://mega.nz/#F!rswTmICb!lnVEolHezNbe4pZPopSqwA' target='_blank'>UFO</a></p>
                <p><a href='https://mega.nz/#F!TlwUwBTb!hT-vr7hhft3dwt3slrhCEQ' target='_blank'>GFW</a></p>
                <p><a href='https://mega.nz/#F!axJSDILb!FPNSYOddqDosZ1I1Y-9UBQ' target='_blank'>TD</a></p>
                <p><a href='https://mega.nz/#F!K1AByK5I!7NrTie_DHQBrH5OKnIXfEg' target='_blank'>DDC</a></p>
                <p><a href='https://mega.nz/#F!npwSGaJC!pNfJemXgehNGbif2L-d6zQ' target='_blank'>LoLK</a></p>
                <p><a href='https://maribelhearn.com/HSiFS%20Boss%20Rush%20v1.0.zip' target='_blank'>HSiFS</a></p>
				<!--
				Old link boss-rush: https://mega.nz/#!60JyGaTB!HOQPcI7Pq6MiEMKqI-Ucv49CxoqJ8Sc1d3u5s4wNS94
				Old link boss-only: https://mega.nz/#!Ogh3hD5B!PT6aGiyqhGAS1r4Y0IfjLTP3hDtRKa1qGi3zi6XjaOA
				Old link full pack: https://mega.nz/#F!i0I0BIaI!A3wHnQYX2xFUTKS1po1GDw
				-->
                <p><a href='https://maribelhearn.com/Full%20Boss%20Rush.zip' target='_blank'>Full Pack</a></p>
            </div>
            <p><strong>Boss Rush Patches by <a href='https://twitter.com/drakeirving' target='_blank'>Drake</a></strong></p>
            <p>Patches for SA and UFO that not only remove stage portions, but also bombs. The SA one includes turning Stage 4 into 'Satori Rush',
            where you fight every single one of her Spell Cards. Note that the safe areas on Border of Wave and Particle and Utsuho's 3rd spell are removed in this patch.</p>
            <div>
                <p><a href='https://mega.nz/#!85MACTBK!wBZpEyv5rWp7_qwHTQCqa7F_4hFNF5JOpjh4JS5iSGY' target='_blank'>SA</a></p>
                <p><a href='https://mega.nz/#!lskyiIzZ!yJB6HLwRQnXs4wO9BmHNxkVtrKrdoKhM-GmMEBRy0ro' target='_blank'>UFO</a></p>
            </div>
            <p><strong>EoSD Boss Rush by <a href='https://twitter.com/mdude33' target='_blank'>Dass</a></strong></p>
            <p>Another boss rush patch for EoSD, also including 'Patchouli Rush'.</p>
            <a href='https://mega.nz/#!r88gwA7C!I2xVHGBbyh9KVVn3h_aiKDfPhl8fC9ajZscqzES7UFY' target='_blank'>Download</a>
            <p><strong>PCB Boss Rush by rsy_type1 and <a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
            <p>A boss rush patch for PCB.</p>
            <a href='http://www.mediafire.com/download/vd08pz9ogjbhq8g/th07b.rar' target='_blank'>Download</a>
			<p><strong>WBaWC Boss Rush by Plus</strong></p>
			<p>A boss rush patch for WBaWC.</p>
			<a href='https://mega.nz/#!e3wwQADS!8I4Rcr9wF-B-hV3b9wbEjGOOI9zbbz8mKj8oY86tWhY' target='_blank'>Download</a>
            <!-- Specific Pattern Practice -->
            <hr>
            <h2 id='specific'>Specific Pattern Practice</h2>
            <p>Patches intended for practicing one or a few specific patterns in a game. Usually <span class='code'>.dat</span> modifications.</p>
            <p><strong>Books Practice for EoSD by <a href='https://www.twitch.tv/akaldar' target='_blank'>Akaldar</a></strong></p>
            <p>Repeats the Stage 4 Books section for easy practicing.</p>
            <a href='https://mega.nz/#!sIhRFD7b!EKKnhhxKX2NQQg0jGaT1t3eAS7x5pcISSKr0abINvgM' target='_blank'>Download</a>
            <p><strong>VoWG + PWG Practice for MoF by <a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
            <p>Makes Kanako skip to Virtue of Wind God (her final spell) and makes Aya skip to Peerless Wind God (her timeout spell), which will also repeat itself indefinitely.</p>
            <a href='https://maribelhearn.com/th10vowg_pwg.dat' target='_blank'>Download</a>
			<!-- Dead link: https://www.dropbox.com/s/2u2fam39uya0zil/th10vowg%2Bpwg.dat?dl=0 -->
            <p><strong>IN Nonspell Practice</strong></p>
            <p>Patch that lets you practice nonspells in IN.</p>
            <a href='https://mega.nz/#!y9IwiD4A!aI-tS2lNbDWeu-FnA41lc76xtnkUjHNdYwyg4dyBkrs' target='_blank'>Download</a>
            <p><strong>Timeout Phase Collection by <a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
            <p>Patches for practicing the timeout phases of the final spells on Lunatic and Extra from MoF to HSiFS, plus Devil's Recitation, but not including GFW Stage 3 final spells.</p>
            <div>
                <p><a href='https://mega.nz/#F!yhwiWaTD!4AE7YYzsfixx1yXIGFcbdg' target='_blank'>MoF to LoLK</a></p>
                <p><a href='https://mega.nz/#!a4x2VIxa!zwwwT0PXDjKgjt8wfhp6n3mbrOH9N7OsNZ8MkgH7v_c' target='_blank'>HSiFS season finals and Extra final</a></p>
            </div>
            <!-- Shottype Modifications -->
            <hr>
            <h2 id='shottypes'>Shottype Modifications</h2>
			<p><strong>MoF Reisen by Kayu</strong></p>
			<p>Replaces ReimuC with Reisen in MoF.</p>
			<a href='https://mega.nz/#!SXYHzIAL!ybiykqvDKGJ-WB99fd1NzsXWh_F5l9N0VZN6IVyvZ8o' target='_blank'>Download</a>
			<p><strong>UFO Tsubakura mod by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> th12tsuba</a></p>
			<p>Replaces both Reimu shottypes in UFO with Tsubakura shottypes, a character from the Len'en series. Also changes the dialogues and endings.</p>
			<a href='https://mega.nz/#!10JzTKBC!GLi2MJZADsRPqdn1b9knvLfJknXepM69vHJ01-XjJ7s'>Download</a>
			<p><strong>DDC Sanae by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> th14sanae</a></p>
			<p>Replaces ReimuB with Sanae in DDC.</p>
			<a href='https://mega.nz/#!oh4lBA4C!Fq7UV5LfQulUaCAubGRk_LMLOeR4nfE9CdMa0OQZryA'>Download</a>
			<p><strong>HSiFS Sanae by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> th16sanae</a></p>
			<p>Replaces Marisa with Sanae in HSiFS.</p>
			<a href='https://mega.nz/#!lsBQxSwB!X-YB1uwIN1u8CRYjU-2HZnjhb7zrFE5WvQFZru-CXr8'>Download</a>
			<p><strong>LoLK Sakuya by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> th15sakuya</a></p>
			<p>Replaces Reisen with Sakuya in LoLK.</p>
			<a href='https://mega.nz/#!1s5GHIqI!sSPZm0FZCxE_EL0jzGqC4oheH5Xs7-MmlbjARxqbzQY' target='_blank'>Download</a>
			<p><strong>TD Yuuka by Gamer251</strong></p>
			<p>Replaces Marisa with Yuuka in TD. Also changes the dialogues.</p>
			<a href='https://drive.google.com/file/d/1UU6eEKDEu7n3SfZtZpV7EmGx2dDlJa0W/view?usp=sharing' target='_blank'>Download</a>
			<p><strong>DS Seija by BurntToast12</strong></p>
			<p>Replaces Aya in DS with Seija, including when she shows up as a boss.</p>
			<a href='https://mega.co.nz/#!CB4FTBwQ!JhXn6QwNeDTQu_Ys2KNt_mZlV61r8jcBF_FtVrRlcP0' target='_blank'>Download</a>
			<p><strong>WBaWC (Demo) Reisen by Kayu</strong></p>
			<a href='https://mega.nz/#!yeABgCSJ!_tZ_8tQeYORgcqVvTh6KLN8t7jrRy685zWqwmbykHrg' target='_blank'>Download</a>
			<p>Replaces ReimuOtter with Reisen in the WBaWC demo.</p>
			<p><strong>WBaWC Narumi by Kayu</strong></p>
			<p>Adds Narumi to WBaWC as a shottype.</p>
			<a href='https://mega.nz/#!nToG2QpA!t20hP8GMBB3cOqncqePXcwRo5qpRDDwXqzLPilyfiVw' target='_blank'>Download</a>
            <!-- Hard Mode / Ultra Patches -->
            <hr>
            <h2 id='hardultra'>Hard Mode / Ultra Patches</h2>
            <p>Patches that increase the bullet density and speed throughout the game, while giving you autobombs to compensate for it. The Hard Mode patches also change the actual patterns.
            The main Ultra patch collection includes the games up to ISC.</p>
            <div>
                <p><a href='http://cheater.seesaa.net/category/9478192-1.html' target='_blank'>Main Ultra Patches</a></p>
                <p><a href='https://www.axfc.net/u/785101' target='_blank'>Alternate EoSD Ultra</a></p>
            </div>
            <p><strong>Hard Mode patches by <a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
            <p>Patches for UFO and DDC that modify patterns, besides simply making them harder.</p>
            <div>
                <p><a href='https://www.mediafire.com/file/e3sx5g9jtbell33/th12.dat' target='_blank'>HardUFO</a></p>
                <p><a href='http://www.mediafire.com/file/usbud0rr385z2nn/th14.dat' target='_blank'>HarDDC</a></p>
            </div>
			<p><strong>RNG patches by <a href='https://www.twitch.tv/thedaikarasu' target='_blank'>Daikarasu</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> RNG</a></p>
			<p>A collection of modified <span class='code'>.dat</span> files that randomise the patterns in the game.</p>
			<a href='https://drive.google.com/file/d/14PGGkoxHTH-bHKfzSt3OGarZp_APq7KB/view' target='_blank'>Download</a>
            <p><strong>LoLK Black Label</strong></p>
            <p>A Chinese Ultra patch for LoLK, which does <em>not</em> have autobomb, but it doubles your shot power instead.</p>
            <a href='https://pan.baidu.com/s/1pJDYEsr' target='_blank'>Download (Baidu)</a>
            <p><strong>IN Double Stage 4/6</strong></p>
            <p>Allows you to play 4A, 4B, 6A and 6B in a single run. Optionally also includes Extra at the end.</p>
            <div>
                <p><a href='http://www.mediafire.com/file/a0nd1a6asqpy2de/th08_8stages.rar' target='_blank'>Without Extra</a></p>
                <p><a href='http://www.mediafire.com/file/sb7hzvb4fmwrwvb/th08_9stages.rar' target='_blank'>With Extra</a></p>
            </div>
            <p><strong>HSiFS UltraB by <a href='https://twitter.com/mdude33' target='_blank'>Dass</a></strong></p>
            <p>An alternate HSiFS Ultra patch that also increases density.</p>
            <a href='https://mega.nz/#!LxNAQbyB!a2qOOOgYQ8-NwTWvLSgcykBXsEmhgy6IDpdEdxlG-90' target='_blank'>Download</a>
			<p><strong>"LoDDK" by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> LoDDK</a></p>
			<p>Combines LoLK with DDC, making each boss fight a dual boss fight against the bosses of both games.
			It removes all stage portions, effectively making it a boss rush, and also combines the HUDs of both games.</p>
			<a href='https://priw8.github.io/#s=patches/loddk' target='_blank'>Download</a>
			<p><strong>OC Patches by Bravi</strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> BraviOCOkina</a></p>
			<p>Remastered version of Stage 6 and harder version of Extra in HSiFS, including an original character replacing Okina and alternate story along with pattern,
			bullet type, stage music and graphical changes. There is another patch with the same OC replacement and pattern modding for VD on the Okina scenes on the same download page.</p>
			<a href='https://mega.nz/file/8j5VBIIQ#sj2_W4xvSzsLLb3b2hSQxtQR1sjQMzJXfb6A8Jem6VM' target='_blank'>Downloads</a>
            <!-- Graphical Patches -->
            <hr>
            <h2 id='graphical'>Graphical Patches</h2>
            <p>Modifications to the main <span class='code'>.dat</span> files of the games that change the way the game looks.</p>
            <p><strong>Graphical Patches by <a href='https://twitter.com/Gastari_' target='_blank'>Gastari</a></strong></p>
            <p>Includes PCB and HSiFS in MS Paint style, an emoji-themed version of UFO and a Christmas-themed version of LoLK.</p>
            <div>
                <p><a href='http://www.mediafire.com/file/17gq2hnxtmtnrp9/Paint+Cherry+Blossom+GOTY+ver+1.0.zip' target='_blank'>Paint Cherry Blossom</a></p>
                <p><a href='http://www.mediafire.com/file/zark2co2d9637z4/Painting+Stars+in+Four+Seasons+%28Full+game+patch%29.rar' target='_blank'>Painting Stars in Four Seasons</a></p>
                <p><a href='http://www.mediafire.com/file/yinp1p2rxh04phd/Undefined+Fantastic+Emoji+patch.zip' target='_blank'>Undefined Fantastic Emoji</a></p>
                <p><a href='http://www.mediafire.com/file/apaks0mcs351ylr/Legacy+of+Lunatic+Christmas.zip' target='_blank'>Legacy of Lunatic Christmas</a></p>
            </div>
			<p><strong>Vertical Play Patches by <a href='http://bygzam.seesaa.net/'>niisaka</a></strong></p>
			<p>Makes MoF, SA, UFO and TD play in the arcade-style vertical (TATE) resolution.</p>
			<a href='https://bygzam.up.seesaa.net/zip/th_pivot_dx9-110924.zip' target='_blank'>Download</a>
            <!-- Emulators -->
            <hr>
            <h2 id='emulators'>PC-98 Emulators</h2>
			<p><strong>Neko Project 21</strong></p>
			<p>The only emulator that is currently still maintained together with DOSBox-X. It offers unlimited savestates and has high accuracy,
			but requires the right configurations; can be confusing for new users. The emulator is located in the bin folder with two versions, 32-bit and 64-bit (x64).</p>
			<a href='https://sites.google.com/site/np21win/' target='_blank'>Download</a>
			<p><strong>T98-Next</strong></p>
			<p>Easy-to-use emulator that will emulate the Touhou games properly without needing configuration of any kind, but less feature-rich,
			and allows 8 active savestates at a time, 4 of which through hotkeys.</p>
			<a href='http://www.mediafire.com/file/myjyjyett2d/T98+english.rar' target='_blank'>Download</a>
			<p><strong>Anex86</strong></p>
			<p>This emulator has low system requirements and can run even on very old computers.
			However, the graphics are mediocre and the sound emulation requires proper configuration to be accurate.
			Allows for 8 savestates and requires a separate font file, linked below.</p>
			<div>
				<p><a href='https://www.zophar.net/download_file/2133'>Download</a></p>
				<p><a href='https://www.zophar.net/download_file/2134'>Font</a></p>
			</div>
			<p><strong>DOSBox-X</strong></p>
			<p>A fork of the DOSBox project that has support for PC-98. It is the only emulator to run natively under not only Windows, but also Mac and Linux.
			A list of downloads for each system can be found via the link below.</p>
			<a href='https://github.com/joncampbell123/dosbox-x/releases' target='_blank'>Downloads (GitHub)</a>
            <!-- Miscellaneous -->
            <hr>
            <h2 id='miscellaneous'>Miscellaneous</h2>
			<p><strong>Real Time DRC Points Displayer by <a href='https://twitter.com/CaoMinh_Touhou' target='_blank'>Cao Minh</a></strong></p>
			<p>A tool that tracks in-game data such as misses, bombs, etc, thus calculating <a href='drc'>DRC</a> points for both survival and scoring during a Touhou run.</p>
			<a href='https://github.com/hoangcaominh/RealTimeDRCPointsDisplayer/releases/latest' target='_blank'>Download</a>
            <p><strong>MS Black Label by <a href='https://twitter.com/spaztron64' target='_blank'>Spaztron64</a></strong></p>
            <p>Increases the graze cap from 999 to 65536.</p>
            <a href='https://maribelhearn.com/MSBL.zip' target='_blank'>Download</a>
            <p><strong>EoSD Capture History Tracker by <a href='https://twitter.com/TrickOfHat' target='_blank'>TrickOfHat</a></strong></p>
            <p>Command-line tool that allows you to track how many times you captured spells in EoSD. Includes Stage 4 Books and Play Time tracking, as well as allowing for multiple save files.</p>
            <div>
                <p><a href='https://mega.nz/#!URxkUSAa!bmKsMnqX8XZxovn9TY1njoa0-2nnC57Sl15KJWs_iy0' target='_blank'>Download</a></p>
                <p><a href='https://cdn.discordapp.com/attachments/414701108854915072/435727033725878272/EoSD_History_Recorder.rar'>Source code</a></p>
            </div>
            <p><strong>PoFV Play Time Recorder by <a href='https://twitter.com/TrickOfHat' target='_blank'>TrickOfHat</a></strong></p>
            <p>Keeps track of your play time in PoFV.</p>
            <a href='https://mega.nz/#!JB4jHJhb!zXa3s_SsAv5P7A1Ua65bGyAJVc76n6iq0KEXWpwJxJE' target='_blank'>Download</a>
            <p><strong>PoFV Replay Save Crash Fixer</strong></p>
            <p>Launching this alongside the game fixes the bug that makes the game crash whenever you save a replay.</p>
            <a href='https://pan.baidu.com/share/link?shareid=3349324077&uk=1627698914' target='_blank'>Download (Baidu)</a>
            <p><strong>TD Arrange Patch by <a href='https://twitter.com/qu_ark' target='_blank'>Nereid</a></strong></p>
            <p>Modification of TD that removes the invincibility from trances, instead allowing you to use them starting at 1/3 full gauge.</p>
            <div>
                <p><a href='http://kawashi.ro/th13arr.zip'>Download</a></p>
                <p><a href='https://pastebin.com/1jD5GZRe' target='_blank'>Readme</a></p>
            </div>
            <p><strong>HSiFS Max Season Start by <a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
            <p>Lets you start with your season level at 6.</p>
            <a href='https://mega.nz/#!HxJRQKKR!MCaZzfVoamBmhvCkVmITQy7nI7WYX8M3FLEYncXNsxs' target='_blank'>Download</a>
            <p><strong>Polished Shooting Star by YoshiWeegee</strong></p>
            <p>Allows you to run the fangame Shining Shooting Star without requiring you to set your locale to Chinese.
            Note that it does not fix the pattern speed bug on locales that use a comma for decimals,
            which makes certain patterns extremely fast until a full run is played or a replay of one of certain stages is watched.</p>
            <a href='https://github.com/yoshiweegee/PolishedShootingStar/archive/master.zip' target='_blank'>Download</a>
            <p><strong>Input Display by <a href='https://twitter.com/drakeirving' target='_blank'>Drake</a></strong></p>
            <p>Shows your button presses. Works on both gameplay and replays.</p>
            <a href='https://mega.nz/#!Fl8zzIbA!5uVB1uDruZ-tFEc7AWilNmmuXCmx0YgAzghrsU1lsPo' target='_blank'>Download</a>
            <p><strong>LoLK Pointdevice no power loss by <a href='https://twitter.com/32th__System' target='_blank'>32th System</a></strong></p>
            <p>Disables the 0.01 power loss mechanic of Pointdevice Mode in LoLK, making sure you never lose power upon restarting a chapter.</p>
            <a href='https://drive.google.com/file/d/1VibcZoC-V0VI6cRw7r507dfimP9Dif1d' target='_blank'>Download</a>
			<p><strong>HSiFS UFO mod by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> th16ufos</a></p>
			<p>Adds UFOs to HSiFS.</p>
			<a href='https://priw8.github.io/#s=patches/uffs' target='_blank'>Download</a>
			<p><strong>WBaWC score cap mod by <a href='https://twitter.com/32th__System' target='_blank'>32th System</a></strong>
			<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><img src='ext/thcrap-icon-small.ico' alt='THCRAP favicon'> score_uncap</a></p>
			<p>Allows the in-game score counter to exceed 9,999,999,990 points.</p>
			<a href='https://maribelhearn.com/th17_score_uncap.zip' target='_blank'>Download</a>
			<hr>
			<h2 id='ack'>Acknowledgements</h2>
			<p id='credit' class='noborders'>The background image
			was drawn by <a href='https://www.pixiv.net/member.php?id=66609'>青葉</a>.</p>
			<hr>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
        </div>
        <script src='assets/shared/dark.js'></script>
    </body>
</html>
