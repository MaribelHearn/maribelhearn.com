<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p><?php
		echo _('This page contains download links to all kinds of different patches or tools applicable to the official Touhou shooting games.');
	?></p>
	<p><?php
		echo _('Some of the patches are also available at <a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers">' .
		'<span class="icon thcrap_icon"></span> Touhou Patch Center</a> ' .
		'and can be used through <a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Download">their automatic ' .
		'translation patcher and modding tool</a>, which can also be downloaded using our mirror below ' .
		'(see THCRAP section). These patches will have the favicon of their site next to them.');
	?></p>
    <h2><?php echo _('Contents') ?></h2>
    <div class='contents'>
        <p><a href='#vpatch'><strong>Vpatch</strong></a></p>
        <p><a href='#thprac'><strong>thprac</strong></a></p>
        <p><a href='#thcrap'>thcrap</a></p>
        <p><a href='#d8d9'><?php echo _('DX8 to DX9 converter') ?></a></p>
        <p><a href='#oilp'><?php echo _('OpenInputLagPatch') ?></a></p>
        <p><a href='#shottypes'><?php echo _('Shottype Modifications') ?></a></p>
        <p><a href='#hardultra'><?php echo _('Hard Mode / Ultra Patches') ?></a></p>
        <p><a href='#graphical'><?php echo _('Graphical Patches') ?></a></p>
        <p><a href='#emulators'><?php echo _('PC-98 Emulators') ?></a></p>
        <p><a href='#miscellaneous'><?php echo _('Miscellaneous') ?></a></p>
        <p><a href='#legacy'><?php echo _('Deprecated') ?></a></p>
		<ul>
			<li><a href='#scorefiles'><?php echo _('Completed Scorefiles') ?></a></li>
			<li><a href='#spoileral'>SpoilerAL<?php if ($lang == 'ja_JP') { echo '（すぽいらーえーる）'; } ?></a></li>
			<li><a href='#practools'><?php echo _('General Practice Tools') ?></a></li>
			<li><a href='#bossrush'><?php echo _('Boss Rush Patches') ?></a></li>
			<li><a href='#specific'><?php echo _('Specific Pattern Practice') ?></a></li>
		</ul>
    </div>
    <!-- Vpatch -->
    <hr>
    <h2 id='vpatch'>Vpatch</h2>
    <p><?php
		echo _('Removes input delay, allows you to increase in-game FPS (default is 60), optionally fixes several bugs '
		.'(PCB cherry display, MoF MarisaB 3-power unfocus, UFO 2.147b score display). The input delay is mostly ' .
		'prevalent in the older games (EoSD to IN) and running them on Vpatch will significantly improve the gameplay ' .
		'experience. It allows you to set a custom screen resolution as well.</p>' .
		'<p>Vpatch is applicable to all official shooting games bar HSiFS, WBaWC and UM.');
	?></p>
	<div>
    	<p><a href='https://maribelhearn.com/mirror/VsyncPatch.zip' target='_blank'><?php echo _('Download') ?></a></p>
    	<p><a href='https://maribelhearn.com/mirror/VsyncPatchUnicode.zip' target='_blank'><?php echo _('Unicode vpatch for EoSD (th06)') ?></a></p>
	</div>
	<!-- Thprac -->
	<hr>
	<?php echo _('<h2 id="thprac">thprac (universal practice tool by Ack)</h2>') ?>
	<p>
		<?php echo _('Single practice tool that works on all of the official Touhou shoot \'em up games, ' .
		'allowing you to change settings or skip to patterns at will.'); ?>
	</p>
	<div><!--  class='main' -->
	<p><a href='https://github.com/touhouworldcup/thprac#thprac' target='_blank'><?php echo _('Download') ?></a></p>
	</div>
	<!--<div class='side'>
		<div id='thprac_img'></div>
		<p class='caption'><?php echo _('thprac main window') ?></p>
	</div>-->
    <!-- English Patches -->
    <hr>
    <?php
		echo _('<h2 id="thcrap">thcrap (Translation patches / Modding tool) ' .
		'<a id="thcrap_link" href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page" target="_blank">' .
		'<span class="icon thcrap_icon"></span> thcrap</a></h2>');
	?>
    <p><?php
		echo _('Translation patches into English and many other languages, as well as countless modifications to ' .
		'gameplay, graphics and more, plus the ability to make your own, are provided by the Touhou Community ' .
		'Reliant Automatic Patcher (thcrap) for all Windows Touhou games. The thpatch.net link also links to ' .
		'instructions on how to use the patcher.');
	?></p>
	<div>
    	<p><a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Download' target='_blank'>
			<?php echo _('Download') ?> (thpatch.net)
		</a></p>
    	<p><a href='https://maribelhearn.com/mirror/thcrap.zip' target='_blank'><?php
			echo _('Download') . _(' (maribelhearn.com mirror)')
		?></a></p>
	</div>
    <!-- d8d9 -->
    <hr>
    <h2 id='d8d9'><?php echo _('DX8 to DX9 converter') ?></h2>
    <p><?php
		echo _('Makes the older Touhou Windows games (EoSD, PCB, IN, PoFV and StB) run properly on Windows 10 and 11. ' .
		'Extract it into the folders of these games for it to take effect.');
	?></p>
    <p><a href='https://github.com/crosire/d3d8to9/releases/latest' target='_blank'><?php echo _('Download') ?></a></p>
    <!-- OILP -->
    <hr>
    <h2 id='oilp'><?php echo _('OpenInputLagPatch') ?></h2>
    <p><?php
		echo _('An alternative to vpatch, which fixes frame limiter and input lag issues in Touhou games. Put the files in the same directory as the game and run oilp_loader.exe to launch the game.');
	?></p>
	<p><?php
		echo _('If you are playing the older Touhou Windows games (EoSD, PCB, IN, PoFV and StB), you also need the <strong>DX8 to DX9 converter</strong>. 
		The older "enbconvertor" will not work; you need the converter linked above.');
	?></p>
    <p><a href='https://maribelhearn.com/mirror/OpenInputLagPatch.zip' target='_blank'><?php echo _('Download') ?></a></p>
    <!-- Shottype Modifications -->
    <hr>
    <h2 id='shottypes'><?php echo _('Shottype Modifications') ?></h2>
	<p><strong><?php echo _('MoF Reisen by ') ?>Kayu</strong></p>
	<p><?php echo _('Replaces ReimuC with Reisen in MoF.') ?></p>
	<p><a href='https://mega.nz/#!SXYHzIAL!ybiykqvDKGJ-WB99fd1NzsXWh_F5l9N0VZN6IVyvZ8o' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('UFO Tsubakura mod by ') ?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th12tsuba</a></p>
	<p><?php
		echo _('Replaces both Reimu shottypes in UFO with Tsubakura shottypes, a character from the ' .
		'Len\'en series. Also changes the dialogues and endings.');
	?></p>
	<p><a href='https://mega.nz/#!10JzTKBC!GLi2MJZADsRPqdn1b9knvLfJknXepM69vHJ01-XjJ7s' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('DDC Sanae by ') ?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th14sanae</a></p>
	<p><?php
		echo _('Replaces ReimuB with Sanae in DDC.');
	?></p>
	<p><a href='https://mega.nz/#!oh4lBA4C!Fq7UV5LfQulUaCAubGRk_LMLOeR4nfE9CdMa0OQZryA' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('HSiFS Sanae by ') ?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th16sanae</a></p>
	<p><?php
		echo _('Replaces Marisa with Sanae in HSiFS.');
	?></p>
	<p><a href='https://mega.nz/#!lsBQxSwB!X-YB1uwIN1u8CRYjU-2HZnjhb7zrFE5WvQFZru-CXr8' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('LoLK Sakuya by ') ?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th15sakuya</a></p>
	<p><?php
		echo _('Replaces Reisen with Sakuya in LoLK.');
	?></p>
	<p><a href='https://mega.nz/#!1s5GHIqI!sSPZm0FZCxE_EL0jzGqC4oheH5Xs7-MmlbjARxqbzQY' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('TD Yuuka by ') ?>Gamer251</strong></p>
	<p><?php
		echo _('Replaces Marisa with Yuuka in TD. Also changes the dialogues.');
	?></p>
	<p><a href='https://drive.google.com/file/d/1UU6eEKDEu7n3SfZtZpV7EmGx2dDlJa0W/view?usp=sharing' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('DS Seija by ') ?>BurntToast12</strong></p>
	<p><?php echo _('Replaces Aya in DS with Seija, including when she shows up as a boss.') ?></p>
	<p><a class='dead' href='https://mega.co.nz/#!CB4FTBwQ!JhXn6QwNeDTQu_Ys2KNt_mZlV61r8jcBF_FtVrRlcP0' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('WBaWC (Demo) Reisen by ') ?>Kayu</strong></p>
	<p><?php echo _('Replaces ReimuOtter with Reisen in the WBaWC demo.') ?></p>
	<p><a href='https://mega.nz/#!yeABgCSJ!_tZ_8tQeYORgcqVvTh6KLN8t7jrRy685zWqwmbykHrg' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('WBaWC Narumi by ') ?>Kayu</strong></p>
	<p><?php echo _('Adds Narumi to WBaWC as a shottype.') ?></p>
	<p><a href='https://mega.nz/#!nToG2QpA!t20hP8GMBB3cOqncqePXcwRo5qpRDDwXqzLPilyfiVw' target='_blank'><?php echo _('Download') ?></a></p>
    <!-- Hard Mode / Ultra Patches -->
    <hr>
    <h2 id='hardultra'><?php echo _('Hard Mode / Ultra Patches') ?></h2>
    <p><?php
		echo _('Patches that increase the bullet density and speed throughout the game, while giving you autobombs ' .
		'to compensate for it. The Hard Mode patches also change the actual patterns. The main Ultra patch ' .
		'collection includes the games up to ISC.');
	?></p>
    <div>
        <p><a href='http://cheater.seesaa.net/category/9478192-1.html' target='_blank'><?php echo _('Main Ultra Patches') ?></a></p>
        <p><a href='https://www.axfc.net/u/785101' target='_blank'><?php echo _('Alternate EoSD Ultra') ?></a></p>
    </div>
    <p><strong><?php echo _('Hard Mode patches by ') ?><a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
    <p><?php echo _('Patches for UFO and DDC that modify patterns, besides simply making them harder.') ?></p>
    <div>
        <p><a href='https://www.mediafire.com/file/e3sx5g9jtbell33/th12.dat' target='_blank'>HardUFO</a> |
        <a href='http://www.mediafire.com/file/usbud0rr385z2nn/th14.dat' target='_blank'>HarDDC</a></p>
    </div>
	<p><strong><?php echo _('RNG patches by ') ?><a href='https://twitter.com/dai_karasu' target='_blank'>Daikarasu</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> RNG</a></p>
	<p><?php
		echo _('A collection of modified <span class="code">.dat</span> files that randomise the patterns in the game.');
	?></p>
	<p><a href='https://mega.nz/folder/AY8iWQyZ#ItObpMjIGEfOXPZyCXAJfA/folder/lckTxKYa' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('IN Double Stage ') ?>4/6</strong></p>
    <p><?php
		echo _('Allows you to play 4A, 4B, 6A and 6B in a single run. Optionally also includes Extra at the end.');
	?></p>
    <div>
        <p><a href='http://www.mediafire.com/file/a0nd1a6asqpy2de/th08_8stages.rar' target='_blank'>Without Extra</a> |
        <a href='http://www.mediafire.com/file/sb7hzvb4fmwrwvb/th08_9stages.rar' target='_blank'>With Extra</a></p>
    </div>
    <p><strong><?php echo _('HSiFS UltraB by ') ?><a href='https://twitter.com/mdude33' target='_blank'>Dass</a></strong></p>
    <p><?php
		echo _('An alternate HSiFS Ultra patch that also increases density.');
	?></p>
    <p><a href='https://mega.nz/#!LxNAQbyB!a2qOOOgYQ8-NwTWvLSgcykBXsEmhgy6IDpdEdxlG-90' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong>"LoDDK" by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> LoDDK</a></p>
	<p><?php
		echo _('Combines LoLK with DDC, making each boss fight a dual boss fight against the bosses of both games.' .
		'It removes all stage portions, effectively making it a boss rush, and also combines the HUDs of both games.');
	?></p>
	<p><a href='https://priw8.github.io/#s=patches/loddk' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('OC Patches by ') ?><a href='https://www.twitch.tv/bravidunno'>Bravi</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> BraviOCOkina</a></p>
	<p><?php
		echo _('Remastered version of Stage 6 and harder version of Extra in HSiFS, including an original character ' .
		'replacing Okina and alternate story along with pattern, bullet type, stage music and graphical changes. ' .
		'There is another patch with the same OC replacement and pattern modding for VD on the Okina scenes on ' .
		'the same download page.');
	?></p>
	<p><a href='https://mega.nz/file/ouQEjJ7a#VpBj9EnbNbT3s1uba126AYZzggXz4Zb8jowSujitfdo' target='_blank'><?php echo _('Downloads') ?></a>
    <!-- Graphical Patches -->
    <hr>
    <h2 id='graphical'><?php echo _('Graphical Patches') ?></h2>
    <p><?php
		echo _('Modifications to the main <span class="code">.dat</span> files of the games ' .
		'that change the way the game looks.');
	?></p>
    <p><strong><?php echo _('Graphical Patches by ') ?><a href='https://twitter.com/Gastari_' target='_blank'>Gastari</a></strong></p>
    <p><?php
		echo _('Includes PCB and HSiFS in MS Paint style, an emoji-themed version of UFO and ' .
		'a Christmas-themed version of LoLK.');
	?></p>
    <div>
        <p><a href='http://www.mediafire.com/file/17gq2hnxtmtnrp9/Paint+Cherry+Blossom+GOTY+ver+1.0.zip' target='_blank'><?php
			echo _('Paint Cherry Blossom');
		?></a></p>
        <p><a href='http://www.mediafire.com/file/zark2co2d9637z4/Painting+Stars+in+Four+Seasons+%28Full+game+patch%29.rar' target='_blank'><?php
			echo _('Painting Stars in Four Seasons');
		?></a></p>
        <p><a href='http://www.mediafire.com/file/yinp1p2rxh04phd/Undefined+Fantastic+Emoji+patch.zip' target='_blank'><?php
			echo _('Undefined Fantastic Emoji');
		?></a></p>
        <p><a href='http://www.mediafire.com/file/apaks0mcs351ylr/Legacy+of+Lunatic+Christmas.zip' target='_blank'><?php
			echo _('Legacy of Lunatic Christmas');
		?></a></p>
    </div>
	<p><strong><?php echo _('Vertical Play Patches by ') ?><a href='http://bygzam.seesaa.net/'>niisaka</a></strong></p>
	<p><?php
		echo _('Makes MoF, SA, UFO and TD play in the arcade-style vertical resolution, also known as TATE.');
	?></p>
	<p><a href='https://bygzam.up.seesaa.net/zip/th_pivot_dx9-110924.zip' target='_blank'><?php echo _('Download') ?></a></p>
    <!-- Emulators -->
    <hr>
    <h2 id='emulators'><?php echo _('PC-98 Emulators') ?></h2>
	<p><em>This section has been moved.</em></p>
	<p>See the page <a href='/faq/pc98'>Running PC-98 games</a> in the <a href='/faq'>FAQ</a>.</p>
    <!-- Miscellaneous -->
    <hr>
    <h2 id='miscellaneous'><?php echo _('Miscellaneous') ?></h2>
	<p><strong><?php echo _('Real Time DRC Points Displayer by ') ?><a href='https://twitter.com/CaoMinh_Touhou' target='_blank'>Cao Minh</a></strong></p>
	<p><?php
		echo _('A tool that tracks in-game data such as misses, bombs, etc, thus calculating ' .
		'<a href="drc">DRC</a> points for both survival and scoring during a Touhou run.');
	?></p>
	<p><a href='https://github.com/hoangcaominh/RealTimeDRCPointsDisplayer/releases/latest' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('MS Black Label by ') ?><a href='https://twitter.com/spaztron64' target='_blank'>Spaztron64</a></strong></p>
    <p><?php echo _('Increases the graze cap from 999 to 65536.') ?></p>
	<p><a href='https://maribelhearn.com/mirror/MSBL.zip' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('EoSD Capture History Tracker by ') ?><a href='https://twitter.com/TrickOfHat' target='_blank'>TrickOfHat</a></strong></p>
    <p><?php
		echo _('Command-line tool that allows you to track how many times you captured spells in EoSD. ' .
		'Includes Stage 4 Books and Play Time tracking, as well as allowing for multiple save files.');
	?></p>
    <div>
		<p><a href='https://mega.nz/file/URxkUSAa!bmKsMnqX8XZxovn9TY1njoa0-2nnC57Sl15KJWs_iy0' target='_blank'><?php echo _('Download') ?></a></p>
        <p><a href='https://mega.nz/file/RIhCRDLB#2PElQfJqi9Mg5JV-1x8AKsQDzcbo51flK2Lxytt-s_k' target='_blank'><?php echo _('Source') ?></a></p>
    </div>
    <p><strong><?php
        echo _('PoFV Play Time Recorder by ');
	?><a href='https://twitter.com/TrickOfHat' target='_blank'>TrickOfHat</a></strong></p>
    <p><?php echo _('Keeps track of your play time in PoFV.') ?></p>
    <p><a href='https://mega.nz/#!JB4jHJhb!zXa3s_SsAv5P7A1Ua65bGyAJVc76n6iq0KEXWpwJxJE' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('PoFV Replay Save Crash Fixer') ?></strong></p>
    <p><?php
		echo _('Launching this alongside the game fixes the bug that makes the game crash whenever you save a replay.');
	?></p>
    <p><a href='https://maribelhearn.com/mirror/th09saverpyfix.zip' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('TD Arrange Patch by ') ?><a href='https://twitter.com/qu_ark' target='_blank'>Nereid</a></strong></p>
    <p><?php
		echo _('Modification of TD that removes the invincibility from trances, ' .
		'instead allowing you to use them starting at 1/3 full gauge.');
	?></p>
    <div>
        <p><a href='https://kawashi.ro/th13arr.zip'><?php echo _('Download') ?></a></p>
        <p><a href='https://pastebin.com/1jD5GZRe' target='_blank'>Readme</a></p>
    </div>
    <p><strong><?php
		echo _('HSiFS Max Season Start by ');
	?><a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
    <p><?php
		echo _('Lets you start with your season level at 6.');
	?></p>
    <p><a href='https://mega.nz/#!HxJRQKKR!MCaZzfVoamBmhvCkVmITQy7nI7WYX8M3FLEYncXNsxs' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php
		echo _('Polished Shooting Star by ');
	?>YoshiWeegee</strong></p>
    <p><?php
		echo _('Allows you to run the fangame Shining Shooting Star without requiring you to set your locale to ' .
		'Chinese. Note that it does not fix the pattern speed bug on locales that use a comma for decimals, ' .
		'which makes certain patterns extremely fast until a full run is played or a replay of one of certain ' .
		'stages is watched.');
	?></p>
    <p><a href='https://github.com/yoshiweegee/PolishedShootingStar/archive/master.zip' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php
		echo _('Input Display by ');
	?><a href='https://twitter.com/drakeirving' target='_blank'>Drake</a></strong></p>
    <p><?php
		echo _('Shows your button presses. Works on both gameplay and replays.');
	?></p>
    <p><a href='https://mega.nz/#!Fl8zzIbA!5uVB1uDruZ-tFEc7AWilNmmuXCmx0YgAzghrsU1lsPo' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php
		echo _('LoLK Pointdevice no power loss by ');
	?><a href='https://www.youtube.com/channel/UChyVpooBi31k3xPbWYsoq3w' target='_blank'>32th System</a></strong></p>
    <p><?php
		echo _('Disables the 0.01 power loss mechanic of Pointdevice Mode in LoLK, ' .
		'making sure you never lose power upon restarting a chapter.');
	?></p>
    <p><a href='https://drive.google.com/file/d/1VibcZoC-V0VI6cRw7r507dfimP9Dif1d' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php
		echo _('HSiFS UFO mod by ');
	?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th16ufos</a></p>
	<p><?php
		echo _('Adds UFOs to HSiFS.');
	?></p>
	<p><a href='https://priw8.github.io/#s=patches/uffs' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php
		echo _('WBaWC score cap mod by ');
	?><a href='https://www.youtube.com/channel/UChyVpooBi31k3xPbWYsoq3w' target='_blank'>32th System</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> score_uncap</a></p>
	<p><?php
		echo _('Allows the in-game score counter to exceed 9,999,999,990 points.');
	?></p>
	<p><a href='https://maribelhearn.com/mirror/th17_score_uncap.zip' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('PoDDofire') ?></strong></p>
	<p><?php
		echo _('PoDD autofire script for AutoHotkey, to avoid hand fatigue from button mashing. Hold Z to shoot, press X to bomb and press C to hyper.');
	?></p>
	<p><a href='https://maribelhearn.com/mirror/PoDDofire.ahk' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('SoEWofire') ?></strong></p>
	<p><?php
		echo _('SoEW autofire script for AutoHotkey. Holding down Z will shoot just as if you were mashing Z, dealing more damage than by holding Z without this script.');
	?></p>
	<p><a href='https://maribelhearn.com/mirror/SoEWofire.ahk' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('EditDisk') ?></strong></p>
	<p><?php
		echo _('Tool for modifying PC-98 game HDI files. Required to install English patches for the PC-98 games.');
	?></p>
	<p><a href='https://maribelhearn.com/mirror/editd169.zip' target='_blank'><?php echo _('Download') ?></a></p>
	<!-- Legacy / Deprecated -->
	<hr>
    <h2 id='legacy'><?php echo _('Deprecated') ?></h2>
    <!-- Scorefiles for Practice -->
    <h3 id='scorefiles'><?php echo _('Completed Scorefiles') ?></h3>
    <p><?php
		echo _('These are (mostly) complete <span class="code">score.dat</span> files useful for practice combined ' .
		'with other tools, as they have unlocked the Extra Stage, every practice stage and spell in Spell Practice ' .
		'for all shottypes.');
	?></p>
    <p><?php echo _('All official shooting games aside from VD are included.') ?></p>
    <p><a href='https://maribelhearn.com/mirror/Practice%20Scorefiles.zip' target='_blank'><?php echo _('Download') ?></a></p>
	<!-- Old link without WBaWC: https://mega.nz/#F!r8hWmCrD!oOkBNotI88acvlhlKUXZiA -->
    <!-- SpoilerAL -->
    <h3 id='spoileral'>SpoilerAL<?php if ($lang == 'ja_JP') { echo '（すぽいらーえーる）'; } ?></h3>
    <p><?php
		echo _('Japanese program that can load <span class="code">.ssg</span> files that modify the game while it is running, ' .
		'allowing for practice options as well as cheats. SpoilerAL SSGs require the <em>original Japanese ' .
		'versions</em> of the games to work. The 4.6 SSGs have practice options such as skipping to a specific ' .
		'frame of the game or a specific spell, while the niL SSGs have cheat options such as invincibility. ' .
		'There is also a separate MoF SSG made by <a href="https://www.twitch.tv/akaldar" target="_blank">Akaldar</a> ' .
		'for efficient practice in that game specifically, a separate GFW SSG, as well as a TD SSG specifically ' .
		'designed for efficient scoring practice, made by Leo, a DDC SSG and a LoLK Chapter Practice SSG by ' .
		'<a href="https://www.youtube.com/channel/UChyVpooBi31k3xPbWYsoq3w" target="_blank">32th System</a> and separate HSiFS SSGs ' .
		'with cheat options. Be wary of an occasional menu bug that causes an SSG to duplicate itself and ' .
		'make other SSGs invisible.');
	?></p>
    <div>
        <p><a href='http://wcs.main.jp/index/software/spal/' target='_blank'><?php echo _('Main Program') ?></a></p>
		<p class='wide-top'><a href='https://maribelhearn.com/mirror/4.6_SSGs.zip' target='_blank'><?php echo _('SSG Pack (4.6)') ?></a></p>
        <p class='wide-bottom'><a href='http://thusagi.starfree.jp/ssg/th06ssg.zip' target='_blank'>EoSD</a> |
        <a href='http://thusagi.starfree.jp/ssg/th07ssg.zip' target='_blank'>PCB</a> |
        <a href='http://thusagi.starfree.jp/ssg/th08ssg.zip' target='_blank'>IN</a> |
        <a href='http://thusagi.starfree.jp/ssg/th12ssg.zip' target='_blank'>UFO</a> |
        <a href='http://thusagi.starfree.jp/ssg/th16ssg.zip' target='_blank'>HSiFS</a></p>
		<p><a href='https://mega.nz/#!OpxFSSJB!2eUH91vJAF_ejq7S5r3x5Jx7GYCP67LSSo4BuXhoDa4' target='_blank'><?php
            echo _('SSG Pack (niL)')
        ?></a></p>
        <p><a href='https://cdn.wikiwiki.jp/to/w/let/etc/%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%A0%E3%81%AA%E3%81%A9/SpoilerAL%E7%94%A8%E3%81%AESSG%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB/::attach/th_ssg20080502.zip?rev=8b2466505ba323da7fc610fad805213f&t=20120111011846'><?php
			echo _('SSG Pack (LET)')
        ?></a></p>
        <p class='wide-bottom'><a href='http://www.mediafire.com/file/a4g4awdp4ll5a4n/SSG.zip' target='_blank'><?php
            echo _('SSG Pack (niL, English translated)')
        ?></a></p>
        <p><a href='https://mega.nz/#!QUBTEB5J!idRbiOfr_BKFpMBy9e5qU5Ow1xPkxplVbR72G6Ud0KI' target='_blank'><?php
            echo _('MoF SSG by Akaldar')
        ?></a></p>
        <p><a href='https://mega.nz/#!BJwhwYRB!5Zgr6redSWbA2v2vco0b7k00XH-BIeTAPUnW28gI-20' target='_blank'><?php
            echo _('GFW SSG (English translated)')
        ?></a></p>
        <p><a href='https://drive.google.com/open?id=1Qs4jOBkDH3dN7tI5X2cJRzd_awZFf80d' target='_blank'><?php
			echo _('TD Scoring SSG by Leo (English translated)')
		?></a></p>
		<p><a href='https://maribelhearn.com/mirror/th16_score.ssg' target='_blank'><?php
			echo _('HSiFS Scoring SSG by Sonitsuku')
		?></a></p>
        <p><a href='https://gitlab.com/32th/th14ssg' target='_blank'><?php
			echo _('DDC SSG by 32th System')
		?></a></p>
		<p><a href='https://mega.nz/#!cAwknKTB!3PCN0me2Q3uTXwo4VgfBIouOqf5W0spBEhZwwR2uNfA' target='_blank'><?php
			echo _('LoLK SSG by CreepyNinja')
		?></a></p>
        <p><a href='https://gitlab.com/32th/th15ssg' target='_blank'><?php
			echo _('LoLK Chapter Practice SSG by 32th System')
		?></a></p>
        <p><a href='https://drive.google.com/open?id=1YqL8QSrnvDepMnkKUNPIBJVaJ2XWwZhP' target='_blank'><?php
			echo _('HSiFS SSG (cheats, English translated)')
		?></a></p>
        <p><a href='https://drive.google.com/open?id=1R8YcGWBE1c4jLy2RGfjuqtrpZzR26XA-' target='_blank'><?php
			echo _('Alternative HSiFS SSG (English translated)')
		?></a></p>
    </div>
    <!-- General Practice Tools -->
    <h3 id='practools'><?php echo _('General Practice Tools') ?></h3>
    <p><?php
		echo _('Patches intended for efficient practice in one or more games, ' .
		'allowing the player to skip to patterns or changing power and such.');
	?></p>
	<p><strong><?php echo _('Practice Tools by ') ?><a href='https://twitter.com/Ririanly'>Riri</a></strong></p>
    <p><?php
		echo _('Tools that allow you to skip to specific patterns in SA, UFO and LoLK, also allowing for other ' .
		'settings like your current power. The UFO and LoLK tools are external programs, while the SA tool ' .
		'is a modification of the program. The LoLK one was made for v1.00a but mostly functions properly ' .
		'on v1.00b as well.');
	?></p>
    <div>
        <p><a href='https://drive.google.com/file/d/0BwqJeqvy1nDpRGRBUy1nX0dNWVU/view' target='_blank'>SA</a> |
        <a href='https://drive.google.com/file/d/0BwqJeqvy1nDpQ1FQaUc5dDlpUEk/view' target='_blank'>UFO</a> |
        <a href='http://www.mediafire.com/download/88ncjlua3hjrma2/th15_assist_2.2.rar' target='_blank'>LoLK</a></p>
    </div>
	<p><strong><?php echo _('WBaWC Practice by ') ?><a href='https://twitter.com/Priweejt'>Priw8</a></strong></p>
	<p><?php
		echo _('Allows skipping to any part of the game, similar to Riri\'s practice tools, using an in-game menu.');
	?></p>
	<p><a href='https://priw8.github.io/#s=patches/prac' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('GFW "Brown Label" Practice by ') ?><a href='https://twitter.com/eerokurkisuo'>MegaPulse</a></strong></p>
    <p><?php
		echo _('Modified <span class="code">.dat</span> files that allow you to practice specific stages of ' .
		'any route in the game. Select A in-game for full stage practice, B for midboss and boss and C ' .
		'for boss only. Refer to the readme file for further information.');
	?></p>
    <p><a href='https://mega.nz/#!8LgRVLxa!TQpU7xqurMF9JgWloQAHORx6XhswuK_NaaCk1gStWfs' target='_blank'><?php echo _('Download') ?></a></p>
    <!-- Boss Rush Patches -->
    <h3 id='bossrush'><?php echo _('Boss Rush Patches') ?></h3>
    <p><?php
		echo _('Modifications to the main <span class="code">.dat</span> files of the games that skip ' .
		'stage portions, allowing you to efficiently practice boss battles. The skipping applies to ' .
		'both full runs and practice runs.');
	?></p>
    <p><strong><?php echo _('Boss Rush Patches by ') ?><a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
    <p><?php
		echo _('All midbosses and bosses are included, everything else being kept the same. ' .
		'There are also \'boss-only\' versions that do skip the midbosses.');
	?></p>
    <div>
		<p><a href='https://maribelhearn.com/mirror/Full%20Boss%20Rush.zip' target='_blank'><?php echo _('Full Pack') ?></a></p>
        <p><a href='https://mega.nz/#F!rswTmICb!lnVEolHezNbe4pZPopSqwA' target='_blank'>MoF</a> |
        <a href='https://mega.nz/#F!a4BCTACS!Z3gA684Me36gZK_i4y_5Dg' target='_blank'>SA</a> |
        <a href='https://mega.nz/folder/W1AGhJaA#8Hz_laGbtFnNG0-ldTUVZg' target='_blank'>UFO</a> |
        <a href='https://mega.nz/#F!TlwUwBTb!hT-vr7hhft3dwt3slrhCEQ' target='_blank'>GFW</a> |
        <a href='https://mega.nz/#F!axJSDILb!FPNSYOddqDosZ1I1Y-9UBQ' target='_blank'>TD</a> |
        <a href='https://mega.nz/#F!K1AByK5I!7NrTie_DHQBrH5OKnIXfEg' target='_blank'>DDC</a> |
        <a href='https://mega.nz/#F!npwSGaJC!pNfJemXgehNGbif2L-d6zQ' target='_blank'>LoLK</a> |
        <a href='https://maribelhearn.com/mirror/HSiFS%20Boss%20Rush%20v1.0.zip' target='_blank'>HSiFS</a></p>
		<!--
		Old link boss-rush: https://mega.nz/#!60JyGaTB!HOQPcI7Pq6MiEMKqI-Ucv49CxoqJ8Sc1d3u5s4wNS94
		Old link boss-only: https://mega.nz/#!Ogh3hD5B!PT6aGiyqhGAS1r4Y0IfjLTP3hDtRKa1qGi3zi6XjaOA
		Old link full pack: https://mega.nz/#F!i0I0BIaI!A3wHnQYX2xFUTKS1po1GDw
		-->
    </div>
    <p><strong><?php echo _('Boss Rush Patches by ') ?><a href='https://twitter.com/drakeirving' target='_blank'>Drake</a></strong></p>
    <p><?php
		echo _('Patches for SA and UFO that not only remove stage portions, but also bombs. ' .
		'The SA one includes turning Stage 4 into \'Satori Rush\', where you fight every single one ' .
		'of her Spell Cards. Note that the safe areas on Border of Wave and Particle and Utsuho\'s ' .
		'3rd spell are removed in this patch.');
	?></p>
    <div>
        <p><a href='https://mega.nz/#!85MACTBK!wBZpEyv5rWp7_qwHTQCqa7F_4hFNF5JOpjh4JS5iSGY' target='_blank'>SA</a> |
        <a href='https://mega.nz/#!lskyiIzZ!yJB6HLwRQnXs4wO9BmHNxkVtrKrdoKhM-GmMEBRy0ro' target='_blank'>UFO</a></p>
    </div>
    <p><strong><?php echo _('EoSD Boss Rush by ')?><a href='https://twitter.com/mdude33' target='_blank'>Dass</a></strong></p>
    <p><?php echo _('Another boss rush patch for EoSD, also including \'Patchouli Rush\'.') ?></p>
    <p><a href='https://mega.nz/#!r88gwA7C!I2xVHGBbyh9KVVn3h_aiKDfPhl8fC9ajZscqzES7UFY' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('PCB Boss Rush by rsy_type1 and ') ?><a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
    <p><?php echo _('A boss rush patch for PCB.') ?></p>
    <p><a href='http://www.mediafire.com/download/vd08pz9ogjbhq8g/th07b.rar' target='_blank'><?php echo _('Download') ?></a></p>
	<p><strong><?php echo _('WBaWC Boss Rush by ') ?>Plus</strong></p>
    <p><?php echo _('A boss rush patch for WBaWC.') ?></p>
	<p><a class='dead' href='https://mega.nz/#!e3wwQADS!8I4Rcr9wF-B-hV3b9wbEjGOOI9zbbz8mKj8oY86tWhY' target='_blank'><?php echo _('Download') ?></a></p>
    <!-- Specific Pattern Practice -->
    <h3 id='specific'><?php echo _('Specific Pattern Practice') ?></h3>
    <p><?php
		echo _('Patches intended for practicing one or a few specific patterns in a game. ' .
		'Usually <span class="code">.dat</span> modifications.');
	?></p>
    <p><strong><?php echo _('Books Practice for EoSD by ') ?><a href='https://www.twitch.tv/akaldar' target='_blank'>Akaldar</a></strong></p>
    <p><?php echo _('Repeats the Stage 4 Books section for easy practicing.') ?></p>
    <p><a href='https://mega.nz/#!sIhRFD7b!EKKnhhxKX2NQQg0jGaT1t3eAS7x5pcISSKr0abINvgM' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('VoWG + PWG Practice for MoF by ') ?><a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
    <p><?php
		echo _('Makes Kanako skip to Virtue of Wind God (her final spell) and makes Aya skip to ' .
		'Peerless Wind God (her timeout spell), which will also repeat itself indefinitely.');
	?></p>
    <p><a href='https://maribelhearn.com/mirror/th10vowg_pwg.dat' target='_blank'><?php echo _('Download') ?></a></p>
	<!-- Dead link: https://www.dropbox.com/s/2u2fam39uya0zil/th10vowg%2Bpwg.dat?dl=0 -->
    <p><strong><?php echo _('IN Nonspell Practice') ?></strong></p>
    <p><?php echo _('Patch that lets you practice nonspells in IN.') ?></p>
    <p><a href='https://mega.nz/#!y9IwiD4A!aI-tS2lNbDWeu-FnA41lc76xtnkUjHNdYwyg4dyBkrs' target='_blank'><?php echo _('Download') ?></a></p>
    <p><strong><?php echo _('Timeout Phase Collection by ') ?><a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
    <p><?php
		echo _('Patches for practicing the timeout phases of the final spells on Lunatic and Extra from MoF to ' .
		'HSiFS, plus Devil\'s Recitation, but not including GFW Stage 3 final spells.');
	?></p>
    <div>
        <p><a href='https://mega.nz/#F!yhwiWaTD!4AE7YYzsfixx1yXIGFcbdg' target='_blank'><?php
			echo _('MoF to LoLK');
		?></a></p>
        <p><a href='https://mega.nz/#!a4x2VIxa!zwwwT0PXDjKgjt8wfhp6n3mbrOH9N7OsNZ8MkgH7v_c' target='_blank'><?php
			echo _('HSiFS season finals and Extra final');
		?></a></p>
    </div>
	<p><strong><?php echo _('Star Sapphire First Non Practice by ') ?><a href='https://twitter.com/eerokurkisuo' target='_blank'>MegaPulse</a></strong></p>
	<p><?php echo _('Gives Star\'s first non from Route A1 Stage 2 infinite health. This will produce an infinite amount of rings, since the nonspell adds more rings every wave. The stage background from Route A2 is used.') ?></p>
	<p><a href='https://mega.nz/file/0DAVjJjT#Gb279_wmj8ZOkkrVdcgTLQkH6151slKEIsbVWKaDuDY' target='_blank'><?php echo _('Download') ?></a></p>
	<hr>
    <footer><strong><a href='#top'><?php echo _('Back to Top') ?></a></strong></footer>
</div>
