<?php include_once 'assets/tools/tools_code.php' ?>
<div id='wrap' class='wrap'>
	<div id='topbar'>
		<p id='ack'>
			<?php
				if ($lang == 'Russian') {
					echo 'Иллюстрацию на фоне <br id="ack_br">нарисовал(а) ' .
					'<a href="https://www.pixiv.net/member.php?id=66609">青葉</a>';
				} else if ($lang == 'Japanese') {
					echo '背景イメージは<a href="https://www.pixiv.net/member.php?id=66609">青葉</a>さんの' .
					'<br id="ack_br">ものを使用させていただいております';
				} else {
					echo 'This background image <br id="ack_br">was drawn by ' .
					'<a href="https://www.pixiv.net/member.php?id=66609">青葉</a>';
				}
			?>
		</p>
		<span id='hy_container'>
            <span id='hy'></span>
	        <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
        </span>
		<div id='languages'>
            <a id='en' class='flag' href='tools?hl=en'>
                <img class='flag_en' src='assets/flags/uk.png' alt='<?php echo tl_term('Flag of the United Kingdom', $lang) ?>'>
                <p class='language'>English</p>
            </a>
            <a id='jp' class='flag' href='tools?hl=jp'>
                <img src='assets/flags/japan.png' alt='<?php echo tl_term('Flag of Japan', $lang) ?>'>
                <p class='language'>日本語</p>
            </a>
            <a id='ru' class='flag' href='tools?hl=ru'>
                <img src='assets/flags/russia.png' alt='<?php echo tl_term('Flag of Russia', $lang) ?>'>
                <p class='language'>Русский</p>
            </a>
        </div>
	</div>
    <h1>Touhou Patches and Tools</h1>
    <?php
        if (!empty($_GET['redirect'])) {
            echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        }
    ?>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Эта страница содержит ссылки на скачивание различных патчей и инструментов для официальных Тохо шмапов.';
		} else if ($lang == 'Japanese') {
			echo 'このページでは公式の東方シューティングゲームに対応する多様なパッチ、ツールへのリンクを紹介しています。';
		} else {
			echo 'This page contains download links to all kinds of different patches or tools applicable to the official Touhou shooting games.';
		}
	?></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Некоторые из патчей также доступны в <a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers">' .
			'<span class="icon thcrap_icon"></span> Touhou Patch Center</a> ' .
			'и могут быть установлены при помощи их <a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Download">' .
			'автоматического патчера и инструмента для моддинга,</a> который можно скачать по ссылке ниже (см. THCRAP). ' .
			'У этих патчей будет показана иконка их сайта.';
		} else if ($lang == 'Japanese') {
			echo 'いくつかのパッチは<a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers">' .
            '<span class="icon thcrap_icon"></span> ' .
            'THCRAP東方パッチセンター</a>を通じて自動<a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Download">' .
            '翻訳パッチや改変ツール</a>とともに利用できます。またそれらは本サイトのミラーからもダウンロード可能で、' .
            'それらにはfaviconを併記してあります。(THCRAPの項目を参照)。';
		} else {
			echo 'Some of the patches are also available at <a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers">' .
			'<span class="icon thcrap_icon"></span> Touhou Patch Center</a> ' .
			'and can be used through <a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Download">their automatic ' .
			'translation patcher and modding tool</a>, which can also be downloaded using our mirror below ' .
			'(see THCRAP section). These patches will have the favicon of their site next to them.';
		}
	?></p>
    <h2 id='contents'><?php
		if ($lang == 'Russian') { echo 'Содержание'; }
		else if ($lang == 'Japanese') { echo 'コンテンツ'; }
		else { echo 'Contents'; }
	?></h2>
    <div class='border'>
        <p><a href='#vpatch'>Vpatch</a></p>
        <p><a href='#thcrap'>THCRAP</a></p>
        <p><a href='#enbconvertor'><?php
			if ($lang == 'Russian') { echo '<strong>Для Windows 10:</strong> DX8 to DX9'; }
			else if ($lang == 'Japanese') { echo '<strong>Windows 10</strong>のみ対応: DX8からDX9へのコンバータ'; }
			else { echo '<strong>For Windows 10:</strong> DX8 to DX9'; }
		?></a></p>
        <p><a href='#scorefiles'><?php
			if ($lang == 'Russian') { echo 'Полные скорфайлы'; }
			else if ($lang == 'Japanese') { echo '全開放済みのスコアデータファイル'; }
			else { echo 'Completed Scorefiles'; }
		?></a></p>
        <p><a href='#thprac'><strong>Thprac</strong></a></p>
        <p><a href='#spoileral'>SpoilerAL</a></p>
        <p><a href='#practools'><?php
			if ($lang == 'Russian') { echo 'Общие инструменты для практики'; }
			else if ($lang == 'Japanese') { echo '全般的プラクティスツール'; }
			else { echo 'General Practice Tools'; }
		?></a></p>
        <p><a href='#bossrush'><?php
			if ($lang == 'Russian') { echo 'Боссраш патчи'; }
			else if ($lang == 'Japanese') { echo 'ボスラッシュパッチ'; }
			else { echo 'Boss Rush Patches'; }
		?></a></p>
        <p><a href='#specific'><?php
			if ($lang == 'Russian') { echo 'Практика определенных паттернов'; }
			else if ($lang == 'Japanese') { echo '特定パターンのプラクティスツール'; }
			else { echo 'Specific Pattern Practice'; }
		?></a></p>
        <p><a href='#shottypes'><?php
			if ($lang == 'Russian') { echo 'Модификации шоттипов'; }
			else if ($lang == 'Japanese') { echo 'ショットタイプ改変ツール'; }
			else { echo 'Shottype Modifications'; }
		?></a></p>
        <p><a href='#hardultra'><?php
			if ($lang == 'Russian') { echo 'Хард мод / Ультра патчи'; }
			else if ($lang == 'Japanese') { echo 'ハードモード/ウルトラモードパッチ'; }
			else { echo 'Hard Mode / Ultra Patches'; }
		?></a></p>
        <p><a href='#graphical'><?php
			if ($lang == 'Russian') { echo 'Графические патчи'; }
			else if ($lang == 'Japanese') { echo 'グラフィックパッチ'; }
			else { echo 'Graphical Patches'; }
		?></a></p>
        <p><a href='#emulators'><?php
			if ($lang == 'Russian') { echo 'Эмуляторы PC-98'; }
			else if ($lang == 'Japanese') { echo 'PC-98エミュレータ'; }
			else { echo 'PC-98 Emulators'; }
		?></a></p>
        <p><a href='#miscellaneous'><?php
			if ($lang == 'Russian') { echo 'Прочее'; }
			else if ($lang == 'Japanese') { echo 'その他'; }
			else { echo 'Miscellaneous'; }
		?></a></p>
        <p><a href='#ack'><?php echo tl_term('Acknowledgements', $lang) ?></a></p>
    </div>
    <!-- Vpatch -->
    <hr>
    <h2 id='vpatch'>Vpatch</h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Убирает инпут лаг, позволяет увеличить внутриигровой FPS (60 по умолчанию), также по желанию фиксит ' .
			'некоторые баги (дисплей черри в PCB, 3-павер баг с МарисойБ в MoF, дисплей очков в UFO после 2.147 мильярдов). ' .
			'Инпут лаг больше всего замечен в более старых играх (EoSD-IN), потому Vpatch значительно улучшает опыт игры в ' .
			'этих играх.</p><p>Vpatch можно поставить на все официальные шмапы, кроме HSiFS, WBaWC и UM.</p>';
		} else if ($lang == 'Japanese') {
			echo '入力遅延の解消、ゲーム内FPS上昇可能化(デフォルト60)、またいくつかのバグの解消(妖々夢の桜表記バグ、' .
			'風神録魔理沙BのP3高速バグ、星蓮船21.47億スコアバグ解消)が可能です。入力遅延は主に紅魔郷、妖々夢、永夜抄で顕著で、' .
			'このパッチを使用することで劇的にプレイ体験を向上できます。</p><p>Vpatchは天空璋、' .
			'鬼形獣と虹龍洞を除く全てのシューティングゲームに適用可能です。';
		} else {
			echo 'Removes input delay, allows you to increase in-game FPS (default is 60), optionally fixes several bugs '
			.'(PCB cherry display, MoF MarisaB 3-power unfocus, UFO 2.147b score display). The input delay is mostly ' .
			'prevalent in the older games (EoSD to IN) and running them on Vpatch will significantly improve the gameplay ' .
			'experience. It allows you to set a custom screen resolution as well.</p>' .
			'<p>Vpatch is applicable to all official shooting games bar HSiFS, WBaWC and UM.';
		}

	?></p>
    <a href='https://maribelhearn.com/mirror/VsyncPatch.zip' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <!-- English Patches -->
    <hr>
    <?php
		if ($lang == 'Russian') {
			echo '<h2 id="thcrap">THCRAP <a id="thcrap_link" href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page" ' .
			'target="_blank"><span class="icon thcrap_icon"></span> thcrap</a></h2>' .
            '<h3>(Патчи с переводом / Инструмент для моддинга)</h3>';
		} else if ($lang == 'Japanese') {
			echo '<h2 id="thcrap">THCRAP <a id="thcrap_link" href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page" ' .
			'target="_blank"><span class="icon thcrap_icon"></span> thcrap</a></h2><h3>(翻訳パッチ / 改変ツール)</h3>';
		} else {
			echo '<h2 id="thcrap">THCRAP (Translation patches / Modding tool) ' .
			'<a id="thcrap_link" href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page" target="_blank">' .
			'<span class="icon thcrap_icon"></span> thcrap</a></h2>';
		}
	?>
	</h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Патчи с переводом на русский, украинский, английский и многие другие языки, а также бесчисленное ' .
			'количество модификаций геймплея, графики, и многого другого. Плюс, с возможностью сделать свой собственный ' .
			'патч. Это все можно сделать при помощи THCRAP, доступен для всех Windows Тохо игр. Ссылка на thpatch.net ' .
			'также содержит инструкции о том, как использовать патчер.';
		} else if ($lang == 'Japanese') {
			echo '英語や他の沢山の言語への翻訳パッチおよび無数のゲームプレイ向け、グラフィクス向けなど、' .
			'またはあなた自身の作成スキルにより作成されたパッチは全てのWindows版東方ゲーム向けのTouhou Community Reliant ' .
			'Automatic Patcher (THCRAP) として提供されています。thpatch.netへのリンクはパッチ使用方法の解説にもリンクしています。';
		} else {
			echo 'Translation patches into English and many other languages, as well as countless modifications to ' .
			'gameplay, graphics and more, plus the ability to make your own, are provided by the Touhou Community ' .
			'Reliant Automatic Patcher (THCRAP) for all Windows Touhou games. The thpatch.net link also links to ' .
			'instructions on how to use the patcher.';
		}
	?></p>
	<div>
    	<p><a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Download' target='_blank'>
			<?php echo tl_term('Download', $lang) ?> (thpatch.net)
		</a></p>
    	<p><a href='https://maribelhearn.com/mirror/thcrap.zip' target='_blank'><?php
			echo tl_term('Download', $lang);
			if ($lang == 'Russian') { echo ' (зеркало maribelhearn.com)'; }
			else { echo ' (maribelhearn.com mirror)'; }
		?></a></p>
	</div>
    <!-- Enbconvertor -->
    <hr>
    <h2 id='enbconvertor'><?php
		if ($lang == 'Russian') { echo 'Конвертер DX8 to DX9'; }
		else if ($lang == 'Japanese') { echo 'DX8からDX9へのコンバータ'; }
		else { echo 'DX8 to DX9 converter'; }
	?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'При помощи этого конвертера старые Тохо игры (6-9.5) могут работать правильно на Windows 10. ' .
			'Просто разархивируйте его в папку с игрой.';
		} else if ($lang == 'Japanese') {
			echo 'ウィンドウズ版の初期の作品（紅魔郷、妖々夢、永夜抄、花映塚、文花帖）をWindows10で正常に動作させるコンバータです。' .
			'ファイルを解凍し、適用したいゲームのフォルダに移動させると有効になります。';
		} else {
			echo 'Makes the older Touhou Windows games (EoSD, PCB, IN, PoFV and StB) run properly on Windows 10. ' .
			'Extract it into the folders of these games for it to take effect.';
		}
	?></p>
    <a href='http://enbdev.com/convertor_dx8_dx9_v0036.htm' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <!-- Scorefiles for Practice -->
    <hr>
    <h2 id='scorefiles'><?php
		if ($lang == 'Russian') { echo 'Полные скорфайлы'; }
		else if ($lang == 'Japanese') { echo '全開放済みのスコアデータファイル'; }
		else { echo 'Completed Scorefiles'; }
	?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo '(Почти) полные <span class="code">score.dat</span> файлы, которые можно использовать для практики ' .
			'совместно с другими инструментами, так как в них открыты Экстра-уровень, все уровни для пратики и ' .
			'спеллы в Практике Спелл-карт для всех шоттипов.';
		} else if ($lang == 'Japanese') {
			echo '（ほとんど）全てのスコアデータファイル（score.dat）です。エクストラステージ開放、ステージプラクティス開放、' .
			'スペルプラクティス開放を全ての機体で済ませてあり、他のツールと合わせての練習に役立ちます。';
		} else {
			echo 'These are (mostly) complete <span class="code">score.dat</span> files useful for practice combined ' .
			'with other tools, as they have unlocked the Extra Stage, every practice stage and spell in Spell Practice ' .
			'for all shottypes.';
		}
	?></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Включены все официальные шмапы кроме VD.';
		} else if ($lang == 'Japanese') {
			echo '全ての公式シューティングゲーム（ナイトメアダイアリーを除く）を含んでいます。';
		} else {
			echo 'All official shooting games aside from VD are included.';
		}
	?></p>
    <a href='https://maribelhearn.com/mirror/Practice%20Scorefiles.zip' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<!-- Old link without WBaWC: https://mega.nz/#F!r8hWmCrD!oOkBNotI88acvlhlKUXZiA -->
	<!-- Thprac -->
	<hr>
	<?php
		if ($lang == 'Russian') { echo '<h2 id="thprac">Thprac</h2><h3>(Универсальный инструмент для практики)</h3>'; }
		else if ($lang == 'Japanese') { echo '<h2 id="thprac">Thprac</h2><h3>(ユニバーサルプラクティスツール by ACK）</h3>'; }
		else { echo '<h2 id="thprac">Thprac (universal practice tool by ACK)</h2>'; }
	?>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Единый инструмент для практики всех официальных Тохо шмапов, ' .
			'позволяющий менять параметры и пропускать до нужных паттернов.';
		} else if ($lang == 'Japanese') {
			echo '全ての公式シューティング作品で多数の設定項目を持ち、また特定の箇所へのスキップ機能をもつ万能ツール。';
		} else {
			echo 'Single practice tool that works on all of the official Touhou shoot \'em up games, ' .
			'allowing you to change settings or skip to patterns at will.';
		}
	?></p>
	<a href='https://github.com/ack7139/thprac/releases'><?php echo tl_term('Download', $lang) ?></a>
    <!-- SpoilerAL -->
    <hr>
    <h2 id='spoileral'>SpoilerAL<?php if ($lang == 'Japanese') { echo '（すぽいらーえーる）'; } ?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Японская программа, загружающая <span class="code">.ssg</span> файлы, которые модифицируют игру пока ' .
			'она запущена, для практики а также читов. SSG файлы SpoilerAL требуют оригинальные японские версии игр, ' .
			'чтобы они сработали. Файлы 4.6 SSG имеют опции для практики, такие как скип до определенного фрейма игры ' .
			'или определенного спелла, тогда как niL SSG содержат читы, такие как неуязвимость. Также есть отдельный ' .
			'SSG для MoF от <a href="https://www.twitch.tv/akaldar" target="_blank">Akaldar</a> для эффективной ' .
			'практики в MoF, отдельные SSG для GFW и TD для эффективной практики скоринга от ' .
			'<a href="https://twitter.com/remilia_kawai" target="_blank">Leo</a>, SSG для DDC и LoLK от ' .
			'<a href="https://www.youtube.com/channel/UChyVpooBi31k3xPbWYsoq3w" target="_blank">32th System</a> и отдельные SSG для HSiFS с ' .
			'читами. Учтите, что иногда появлятся баг в меню который дюпает SSG и делает другие SSG невидимыми.';
		} else if ($lang == 'Japanese') {
			echo '<span class="code">.ssg</span>ファイルをゲームの動作中に読み込み、プラクティスオプションの設定やチートの' .
			'設定が出来る日本産のプログラムです。SpoilerALはオリジナルの日本語版ゲームにのみ適用可能です。';
		} else {
			echo 'Japanese program that can load <span class="code">.ssg</span> files that modify the game while it is running, ' .
			'allowing for practice options as well as cheats. SpoilerAL SSGs require the <em>original Japanese ' .
			'versions</em> of the games to work. The 4.6 SSGs have practice options such as skipping to a specific ' .
			'frame of the game or a specific spell, while the niL SSGs have cheat options such as invincibility. ' .
			'There is also a separate MoF SSG made by <a href="https://www.twitch.tv/akaldar" target="_blank">Akaldar</a>' .
			'for efficient practice in that game specifically, a separate GFW SSG, as well as a TD SSG specifically ' .
			'designed for efficient scoring practice, made by <a href="https://twitter.com/remilia_kawai" ' .
			'target="_blank">Leo</a>, a DDC SSG and a LoLK Chapter Practice SSG by ' .
			'<a href="https://www.youtube.com/channel/UChyVpooBi31k3xPbWYsoq3w" target="_blank">32th System</a> and separate HSiFS SSGs ' .
			'with cheat options. Be wary of an occasional menu bug that causes an SSG to duplicate itself and ' .
			'make other SSGs invisible.';
		}
	?></p>
    <div>
        <p><a href='http://wcs.main.jp/index/software/spal/' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Главная программа'; }
			else if ($lang == 'Japanese') { echo 'メインプログラム'; }
			else { echo 'Main Program'; }
		?></a></p>
		<p class='wide-top'><a href='https://maribelhearn.com/mirror/4.6_SSGs.zip' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Пак SSG (4.6)'; }
			else if ($lang == 'Japanese') { echo 'SSGパック（4.6）'; }
			else { echo 'SSG Pack (4.6)'; }
		?></a></p>
        <p class='wide-bottom'><a href='http://thusagi.starfree.jp/ssg/th06ssg.zip' target='_blank'>EoSD</a> |
        <a href='http://thusagi.starfree.jp/ssg/th07ssg.zip' target='_blank'>PCB</a> |
        <a href='http://thusagi.starfree.jp/ssg/th08ssg.zip' target='_blank'>IN</a> |
        <a href='http://thusagi.starfree.jp/ssg/th12ssg.zip' target='_blank'>UFO</a> |
        <a href='http://thusagi.starfree.jp/ssg/th16ssg.zip' target='_blank'>HSiFS</a></p>
		<p><a href='https://mega.nz/#!OpxFSSJB!2eUH91vJAF_ejq7S5r3x5Jx7GYCP67LSSo4BuXhoDa4' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Пак SSG (niL)'; }
			else if ($lang == 'Japanese') { echo 'SSGパック（niL）'; }
			else { echo 'SSG Pack (niL)'; }
		?></a></p>
        <p><a href='https://cdn.wikiwiki.jp/to/w/let/etc/%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%A0%E3%81%AA%E3%81%A9/SpoilerAL%E7%94%A8%E3%81%AESSG%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB/::attach/th_ssg20080502.zip?rev=8b2466505ba323da7fc610fad805213f&t=20120111011846'><?php
			if ($lang == 'Russian') { echo 'Пак SSG (LET)'; }
			else if ($lang == 'Japanese') { echo 'SSGパック（LET）'; }
			else { echo 'SSG Pack (LET)'; }
		?></a></p>
        <p class='wide-bottom'><a href='http://www.mediafire.com/file/a4g4awdp4ll5a4n/SSG.zip' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Пак SSG (niL с английским переводом)'; }
			else if ($lang == 'Japanese') { echo 'SSGパック（niL　英語翻訳版）'; }
			else { echo 'SSG Pack (niL, English translated)'; }
		?></a></p>
        <p><a href='https://mega.nz/#!QUBTEB5J!idRbiOfr_BKFpMBy9e5qU5Ow1xPkxplVbR72G6Ud0KI' target='_blank'><?php
			if ($lang == 'Russian') { echo 'MoF SSG от Akaldar'; }
			else if ($lang == 'Japanese') { echo '風神録SSG（Akaldar）'; }
			else { echo 'MoF SSG by Akaldar'; }
		?></a></p>
        <p><a href='https://mega.nz/#!BJwhwYRB!5Zgr6redSWbA2v2vco0b7k00XH-BIeTAPUnW28gI-20' target='_blank'><?php
			if ($lang == 'Russian') { echo 'GFW SSG (с английским переводом)'; }
			else if ($lang == 'Japanese') { echo '大戦争SSG（英語翻訳版）'; }
			else { echo 'GFW SSG (English translated)'; }
		?></a></p>
        <p><a href='https://drive.google.com/open?id=1Qs4jOBkDH3dN7tI5X2cJRzd_awZFf80d' target='_blank'><?php
			if ($lang == 'Russian') { echo 'TD Scoring SSG от Leo (с английским переводом)'; }
			else if ($lang == 'Japanese') { echo '神霊廟スコアリングSSG by Leo（英語翻訳版）'; }
			else { echo 'TD Scoring SSG by Leo (English translated)'; }
		?></a></p>
		<p><a href='https://maribelhearn.com/mirror/th16_score.ssg' target='_blank'><?php
			if ($lang == 'Russian') { echo 'HSiFS Scoring SSG от Sonitsuku'; }
			else if ($lang == 'Japanese') { echo '天空璋スコアリングSSG by Sonitsuku'; }
			else { echo 'HSiFS Scoring SSG by Sonitsuku'; }
		?></a></p>
        <p><a href='https://gitlab.com/32th/th14ssg' target='_blank'><?php
			if ($lang == 'Russian') { echo 'DDC SSG от 32th System'; }
			else if ($lang == 'Japanese') { echo '輝針城SSG by 32th System'; }
			else { echo 'DDC SSG by 32th System'; }
		?></a></p>
		<p><a href='https://mega.nz/#!cAwknKTB!3PCN0me2Q3uTXwo4VgfBIouOqf5W0spBEhZwwR2uNfA' target='_blank'><?php
			if ($lang == 'Russian') { echo 'LoLK SSG от CreepyNinja'; }
			else if ($lang == 'Japanese') { echo '紺珠伝SSG by CreepyNinja'; }
			else { echo 'LoLK SSG by CreepyNinja'; }
		?></a></p>
        <p><a href='https://gitlab.com/32th/th15ssg' target='_blank'><?php
			if ($lang == 'Russian') { echo 'LoLK SSG с практикой глав от 32th System'; }
			else if ($lang == 'Japanese') { echo '紺珠伝チャプタープラクティスSSG by 32th System'; }
			else { echo 'LoLK Chapter Practice SSG by 32th System'; }
		?></a></p>
        <p><a href='https://drive.google.com/open?id=1YqL8QSrnvDepMnkKUNPIBJVaJ2XWwZhP' target='_blank'><?php
			if ($lang == 'Russian') { echo 'HSiFS SSG (читы, с английским переводом)'; }
			else if ($lang == 'Japanese') { echo '天空璋SSG（チート用。英語翻訳版）'; }
			else { echo 'HSiFS SSG (cheats, English translated)'; }
		?></a></p>
        <p><a href='https://drive.google.com/open?id=1R8YcGWBE1c4jLy2RGfjuqtrpZzR26XA-' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Альтернативный HSiFS SSG (с английским переводом)'; }
			else if ($lang == 'Japanese') { echo 'オルタナティブ天空璋SSG（英語翻訳版）'; }
			else { echo 'Alternative HSiFS SSG (English translated)'; }
		?></a></p>
    </div>
    <!-- General Practice Tools -->
    <hr>
    <h2 id='practools'><?php
		if ($lang == 'Russian') { echo 'Общие инструменты для практики'; }
		else if ($lang == 'Japanese') { echo '全般的プラクティスツール'; }
		else { echo 'General Practice Tools'; }
	?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Патчи для эффективной практики в определенных играх, позволяющие игроку пропускать до ' .
			'определенных паттернов, менять свою силу и прочее.';
		} else if ($lang == 'Japanese') {
			echo 'パッチを使うことにより、複数の特定のゲームにおいてパターンの練習、または希望するパワーでの効果的な練習ができます。';
		} else {
			echo 'Patches intended for efficient practice in one or more games, ' .
			'allowing the player to skip to patterns or changing power and such.';
		}
	?></p>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'Инструменты для практики от '; }
		else if ($lang == 'Japanese') { echo 'プラクティスツール by '; }
		else { echo 'Practice Tools by '; }
	?><a href='https://twitter.com/Ririanly'>Riri</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Программы, позволяющие скипать до определенных паттернов в SA, UFO и LoLK, также с возможностью ' .
			'изменять параметры вроде силы. Программы UFO и LoLK являются внешними, тогда как программа для SA - ' .
			'ее модификация. Программа для LoLK была сделана для версии 1.00a, но должна работать для 1.00b.';
		} else if ($lang == 'Japanese') {
			echo '地霊殿、星蓮船、紺珠伝で開始パワーの調整などができ、さらに特定のシーンにスキップできるツールです。' .
			'星蓮船と紺珠伝では外部ツールとして動作しますが、地霊殿ではプログラム自体を改変して動作します。' .
			'紺珠伝では1.00a向けに作成されていますが、1.00bでも動作するはずです。';
		} else {
			echo 'Tools that allow you to skip to specific patterns in SA, UFO and LoLK, also allowing for other ' .
			'settings like your current power. The UFO and LoLK tools are external programs, while the SA tool ' .
			'is a modification of the program. The LoLK one was made for v1.00a but mostly functions properly ' .
			'on v1.00b as well.';
		}
	?></p>
    <div>
        <p><a href='https://drive.google.com/file/d/0BwqJeqvy1nDpRGRBUy1nX0dNWVU/view' target='_blank'>SA</a> |
        <a href='https://drive.google.com/file/d/0BwqJeqvy1nDpQ1FQaUc5dDlpUEk/view' target='_blank'>UFO</a> |
        <a href='http://www.mediafire.com/<?php echo tl_term('Download', $lang) ?>/88ncjlua3hjrma2/th15_assist_2.2.rar' target='_blank'>LoLK</a></p>
    </div>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'Практика для WBaWC от '; }
		else if ($lang == 'Japanese') { echo '鬼形獣プラクティス by '; }
		else { echo 'WBaWC Practice by '; }
	?><a href='https://twitter.com/Priweejt'>Priw8</a></strong></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Позволяет пропускать до любой части игры, используя внутриигровое меню, как программа Riri.';
		} else if ($lang == 'Japanese') {
			echo 'Ririさんのプラクティスツールに似た、ゲームの好きな箇所にスキップできるツールです。ゲーム内メニューで操作します。';
		} else {
			echo 'Allows skipping to any part of the game, similar to Riri\'s practice tools, using an in-game menu.';
		}
	?></p>
	<a href='https://priw8.github.io/#s=patches/prac' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'GFW "Brown Label" от '; }
		else if ($lang == 'Japanese') { echo '大戦争 "ブラウンレーベル" プラクティス by '; }
		else { echo 'GFW "Brown Label" Practice by '; }
	?><a href='https://twitter.com/givemeberserker'>MegaPulse</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Модифицированные <span class="code">.dat</span> файлы, которые позволяют практиковать определенные ' .
			'стейджи любого маршрута в игре. Выберите A-маршрут для практики всего стейджа, B для мидбосса и босса, или C ' .
			'- только босс. Для полной информации прочитайте файл readme.';
		} else if ($lang == 'Japanese') {
			echo '特定のルートの特定のステージを練習できる改変 <span class="code">.dat</span> ファイルです。';
		} else {
			echo 'Modified <span class="code">.dat</span> files that allow you to practice specific stages of ' .
			'any route in the game. Select A in-game for full stage practice, B for midboss and boss and C ' .
			'for boss only. Refer to the readme file for further information.';
		}
	?></p>
    <a href='https://mega.nz/#!8LgRVLxa!TQpU7xqurMF9JgWloQAHORx6XhswuK_NaaCk1gStWfs' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <!-- Boss Rush Patches -->
    <hr>
    <h2 id='bossrush'><?php
		if ($lang == 'Russian') { echo 'Боссраш патчи'; }
		else if ($lang == 'Japanese') { echo 'ボスラッシュパッチ'; }
		else { echo 'Boss Rush Patches'; }
	?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Это модификации к <span class="code">.dat</span> файлам игры которые пропускают стейджи, ' .
			'позволяя практиковать боссов. Пропуск стейджев работает как в практике, так и в полной игре.';
		} else if ($lang == 'Japanese') {
			echo 'メインの .dat ファイルを書き換え、道中をプレイすることなく効果的にボスを練習できるツールです。' .
			'本編にもプラクティスにも適用されます。';
		} else {
			echo 'Modifications to the main <span class="code">.dat</span> files of the games that skip ' .
			'stage portions, allowing you to efficiently practice boss battles. The skipping applies to ' .
			'both full runs and practice runs.';
		}
	?></p>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Боссраш патчи от '; }
		else if ($lang == 'Japanese') { echo 'ボスラッシュパッチ by '; }
		else { echo 'Boss Rush Patches by '; }
	?><a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Включены все мидбоссы и боссы. Также есть версия только с боссами.';
		} else if ($lang == 'Japanese') {
			echo '全ての中ボスとボスが登場します。通常のボスラッシュです。”ボスオンリー”バージョンでは中ボスもスキップされます。';
		} else {
			echo 'All midbosses and bosses are included, everything else being kept the same. ' .
			'There are also \'boss-only\' versions that do skip the midbosses.';
		}
	?></p>
    <div>
		<p><a href='https://maribelhearn.com/mirror/Full%20Boss%20Rush.zip' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Полный пак'; }
			else { echo 'Full Pack'; }
		?></a></p>
        <p><a href='https://mega.nz/#F!rswTmICb!lnVEolHezNbe4pZPopSqwA' target='_blank'>MoF</a> |
        <a href='https://mega.nz/#F!a4BCTACS!Z3gA684Me36gZK_i4y_5Dg' target='_blank'>SA</a> |
        <a href='https://mega.nz/#F!W1AGhJaA#8Hz_laGbtFnNG0-ldTUVZg' target='_blank'>UFO</a> |
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
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Боссраш патчи от '; }
		else if ($lang == 'Japanese') { echo 'ボスラッシュパッチ by '; }
		else { echo 'Boss Rush Patches by '; }
	?><a href='https://twitter.com/drakeirving' target='_blank'>Drake</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Патчи для SA и UFO которые убирают стейджи и бомбы. В SA четвертый уровень превращается в ' .
			'"Сатори раш", в котором вы сражаетесь с каждой ее спеллкартой вне зависимости от шоттипа. Сейфспоты ' .
			'на Boundary of Wave and Particle и 3-ем спелле Уцухо в этом патче пофикшены.';
		} else if ($lang == 'Japanese') {
			echo '地霊殿と星蓮船に適用されるボスラッシュパッチですが、こちらではボムが使用不可となります。' .
			'地霊殿ではステージ４で、全ての想起を攻略しなければならない"さとりラッシュ"が出現します。' .
			'波と粒の境界やお空３枚目の安全地帯はこのパッチでは消滅しています。';
		} else {
			echo 'Patches for SA and UFO that not only remove stage portions, but also bombs. ' .
			'The SA one includes turning Stage 4 into \'Satori Rush\', where you fight every single one ' .
			'of her Spell Cards. Note that the safe areas on Border of Wave and Particle and Utsuho\'s ' .
			'3rd spell are removed in this patch.';
		}
	?></p>
    <div>
        <p><a href='https://mega.nz/#!85MACTBK!wBZpEyv5rWp7_qwHTQCqa7F_4hFNF5JOpjh4JS5iSGY' target='_blank'>SA</a> |
        <a href='https://mega.nz/#!lskyiIzZ!yJB6HLwRQnXs4wO9BmHNxkVtrKrdoKhM-GmMEBRy0ro' target='_blank'>UFO</a></p>
    </div>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Боссраш EoSD от '; }
		else if ($lang == 'Japanese') { echo '紅魔郷ボスラッシュ by '; }
		else { echo 'EoSD Boss Rush by '; }
	?><a href='https://twitter.com/mdude33' target='_blank'>Dass</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Боссраш патч для EoSD, который включает в себя "Пачули раш".'; }
		else if ($lang == 'Japanese') { echo 'もうひとつの紅魔郷向けボスラッシュパッチです。こちらでは"パチュリーラッシュ"が実装されています。'; }
		else { echo 'Another boss rush patch for EoSD, also including \'Patchouli Rush\'.'; }
	?></p>
    <a href='https://mega.nz/#!r88gwA7C!I2xVHGBbyh9KVVn3h_aiKDfPhl8fC9ajZscqzES7UFY' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Боссраш PCB от rsy_type1 и '; }
		else if ($lang == 'Japanese') { echo '妖々夢ボスラッシュ by '; }
		else { echo 'PCB Boss Rush by rsy_type1 and '; }
	?><a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Боссраш патч для PCB.'; }
		else if ($lang == 'Japanese') { echo '妖々夢のボスラッシュパッチです。'; }
		else { echo 'A boss rush patch for PCB.'; }
	?></p>
    <a href='http://www.mediafire.com/<?php echo tl_term('Download', $lang) ?>/vd08pz9ogjbhq8g/th07b.rar' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'Боссраш WBaWC от '; }
		else if ($lang == 'Japanese') { echo '鬼形獣ボスラッシュ by '; }
		else { echo 'WBaWC Boss Rush by '; }
	?>Plus</strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Боссраш патч для WBaWC.'; }
		else if ($lang == 'Japanese') { echo '鬼形獣のボスラッシュパッチです。'; }
		else { echo 'A boss rush patch for WBaWC.'; }
	?></p>
	<a href='https://mega.nz/#!e3wwQADS!8I4Rcr9wF-B-hV3b9wbEjGOOI9zbbz8mKj8oY86tWhY' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <!-- Specific Pattern Practice -->
    <hr>
    <h2 id='specific'><?php
		if ($lang == 'Russian') { echo 'Практика определенных паттернов'; }
		else if ($lang == 'Japanese') { echo '特定パターンのプラクティスツール'; }
		else { echo 'Specific Pattern Practice'; }
	?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Патчи для практики определенных паттернов в игре, в основном это модификации ' .
			'<span class="code">.dat</span> файлов.';
		} else if ($lang == 'Japanese') {
			echo 'ゲーム内の特定のパターンの練習を目的とし作成されたツールです。';
		} else {
			echo 'Patches intended for practicing one or a few specific patterns in a game. ' .
			'Usually <span class="code">.dat</span> modifications.';
		}
	?></p>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Практика книг в EoSD от '; }
		else if ($lang == 'Japanese') { echo '紅魔郷４面、魔導書地帯練習ツール by '; }
		else { echo 'Books Practice for EoSD by '; }
	?><a href='https://www.twitch.tv/akaldar' target='_blank'>Akaldar</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Повторяет зелёные книги в четвертом уровне для практики.'; }
		else if ($lang == 'Japanese') { echo '４面魔導書地帯を簡易に反復練習できます。'; }
		else { echo 'Repeats the Stage 4 Books section for easy practicing.'; }
	?></p>
    <a href='https://mega.nz/#!sIhRFD7b!EKKnhhxKX2NQQg0jGaT1t3eAS7x5pcISSKr0abINvgM' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Практика DVoWG и PWG в MoF от '; }
		else { echo 'VoWG + PWG Practice for MoF by '; }
	?><a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Пропускает битву с Канако до ее финальной спеллкарты и битву с Аей до Peerless Wind God, ' .
			'которые будут бесконечно повторяться.';
		} else if ($lang == 'Japanese') {
			echo '風神録の神奈子ファイナルスペル"風神様の神徳"と、文の耐久スペル"無双風神"を無限に繰り返し練習出来るツールです。';
		} else {
			echo 'Makes Kanako skip to Virtue of Wind God (her final spell) and makes Aya skip to ' .
			'Peerless Wind God (her timeout spell), which will also repeat itself indefinitely.';
		}
	?></p>
    <a href='https://maribelhearn.com/mirror/th10vowg_pwg.dat' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<!-- Dead link: https://www.dropbox.com/s/2u2fam39uya0zil/th10vowg%2Bpwg.dat?dl=0 -->
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Практика нонспеллов в IN'; }
		else if ($lang == 'Japanese') { echo '永夜抄　通常攻撃プラクティスパッチ'; }
		else { echo 'IN Nonspell Practice'; }
	?></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Позволяет практиковать нонспеллы в IN.'; }
		else if ($lang == 'Japanese') { echo '永夜抄のボスの通常攻撃を練習できるようになるパッチです。'; }
		else { echo 'Patch that lets you practice nonspells in IN.'; }
	?></p>
    <a href='https://mega.nz/#!y9IwiD4A!aI-tS2lNbDWeu-FnA41lc76xtnkUjHNdYwyg4dyBkrs' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Коллекция фаз таймаутов от '; }
		else { echo 'Timeout Phase Collection by '; }
	?><a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Патчи для практики фаз таймаутов финальных спелл-карт в Лунатике и Экстре в Тохо ' .
			'10-16, плюс Devil\'s Recitation, но без GFW.';
		} else if ($lang == 'Japanese') {
			echo 'ルナティックとエクストラの時間切れ発狂を練習できるパッチです。' .
			'風神録から天空璋まで対応しています。また、星蓮船の魔神復誦を含みますが大戦争の３種の最終スペルは対応していません。';
		} else {
			echo 'Patches for practicing the timeout phases of the final spells on Lunatic and Extra from MoF to ' .
			'HSiFS, plus Devil\'s Recitation, but not including GFW Stage 3 final spells.';
		}
	?></p>
    <div>
        <p><a href='https://mega.nz/#F!yhwiWaTD!4AE7YYzsfixx1yXIGFcbdg' target='_blank'><?php
			if ($lang == 'Russian') { echo 'От MoF до LoLK'; }
			else if ($lang == 'Japanese') { echo '風神録から紺珠伝まで'; }
			else { echo 'MoF to LoLK'; }
		?></a></p>
        <p><a href='https://mega.nz/#!a4x2VIxa!zwwwT0PXDjKgjt8wfhp6n3mbrOH9N7OsNZ8MkgH7v_c' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Финальные спеллы HSiFS'; }
			else if ($lang == 'Japanese') { echo '天空璋各季節のファイナルスペルとエクストラファイナルスペル'; }
			else { echo 'HSiFS season finals and Extra final'; }
		?></a></p>
    </div>
    <!-- Shottype Modifications -->
    <hr>
    <h2 id='shottypes'><?php
		if ($lang == 'Russian') { echo 'Модификации шоттипов'; }
		else if ($lang == 'Japanese') { echo 'ショットタイプ改変ツール'; }
		else { echo 'Shottype Modifications'; }
	?></h2>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'MoF Рейсен от '; }
		else if ($lang == 'Japanese') { echo '風神録鈴仙 by '; }
		else { echo 'MoF Reisen by '; }
	?>Kayu</strong></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Заменяет РеймуЦ на Рейсен в MoF.'; }
		else if ($lang == 'Japanese') { echo '風神録の霊夢Cを鈴仙に置き換えます。'; }
		else { echo 'Replaces ReimuC with Reisen in MoF.'; }
	?></p>
	<a href='https://mega.nz/#!SXYHzIAL!ybiykqvDKGJ-WB99fd1NzsXWh_F5l9N0VZN6IVyvZ8o' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'UFO Цубакура от '; }
		else if ($lang == 'Japanese') { echo '星蓮船ツバクラ改変パッチ by '; }
		else { echo 'UFO Tsubakura mod by '; }
	?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th12tsuba</a></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Заменяет Рейму в UFO на Цубакуру из Len\'en. Также изменены диалоги и концовки.';
		} else if ($lang == 'Japanese') {
			echo '星蓮船の霊夢両機体を鏈縁キャラ"ツバクラ"に置き換えます。また、会話とエンディングも差し替えます。';
		} else {
			echo 'Replaces both Reimu shottypes in UFO with Tsubakura shottypes, a character from the ' .
			'Len\'en series. Also changes the dialogues and endings.';
		}
	?></p>
	<a href='https://mega.nz/#!10JzTKBC!GLi2MJZADsRPqdn1b9knvLfJknXepM69vHJ01-XjJ7s' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'DDC Санаэ от '; }
		else if ($lang == 'Japanese') { echo '輝針城早苗パッチ by '; }
		else { echo 'DDC Sanae by '; }
	?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th14sanae</a></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Заменяет РеймуБ на Санаэ в DDC.'; }
		else if ($lang == 'Japanese') { echo 'a'; }
		else { echo 'Replaces ReimuB with Sanae in DDC.'; }
	?></p>
	<a href='https://mega.nz/#!oh4lBA4C!Fq7UV5LfQulUaCAubGRk_LMLOeR4nfE9CdMa0OQZryA' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'HSiFS Санаэ от '; }
		else if ($lang == 'Japanese') { echo '天空璋早苗パッチ by '; }
		else { echo 'HSiFS Sanae by '; }
	?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th16sanae</a></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Заменяет Марису на Санаэ в HSiFS.'; }
		else if ($lang == 'Japanese') { echo '天空璋魔理沙を早苗に差し替えます。'; }
		else { echo 'Replaces Marisa with Sanae in HSiFS.'; }
	?></p>
	<a href='https://mega.nz/#!lsBQxSwB!X-YB1uwIN1u8CRYjU-2HZnjhb7zrFE5WvQFZru-CXr8' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'LoLK Сакуя от '; }
		else if ($lang == 'Japanese') { echo '紺珠伝咲夜パッチ by '; }
		else { echo 'LoLK Sakuya by '; }
	?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th15sakuya</a></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Заменяет Рейсен на Сакую в LoLK.'; }
		else if ($lang == 'Japanese') { echo '紺珠伝鈴仙を咲夜に差し替えます。'; }
		else { echo 'Replaces Reisen with Sakuya in LoLK.'; }
	?></p>
	<a href='https://mega.nz/#!1s5GHIqI!sSPZm0FZCxE_EL0jzGqC4oheH5Xs7-MmlbjARxqbzQY' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'TD Юка от '; }
		else if ($lang == 'Japanese') { echo '神霊廟幽香パッチ by '; }
		else { echo 'TD Yuuka by '; }
	?>Gamer251</strong></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Заменяет Марису на Юку в TD. Также меняет диалоги.'; }
		else if ($lang == 'Japanese') { echo '神霊廟魔理沙を幽香に差し替え、会話も変化させます。'; }
		else { echo 'Replaces Marisa with Yuuka in TD. Also changes the dialogues.'; }
	?></p>
	<a href='https://drive.google.com/file/d/1UU6eEKDEu7n3SfZtZpV7EmGx2dDlJa0W/view?usp=sharing' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'DS Сейджа от '; }
		else if ($lang == 'Japanese') { echo 'ダブルスポイラー正邪パッチ by '; }
		else { echo 'DS Seija by '; }
	?>BurntToast12</strong></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Заменяет Аю на Сейджу в DS, включая и босса.'; }
		else if ($lang == 'Japanese') { echo 'ダブルスポイラーの文を正邪に差し替えます。ボスとして出てきた際も有効です。'; }
		else { echo 'Replaces Aya in DS with Seija, including when she shows up as a boss.'; }
	?></p>
	<a href='https://mega.co.nz/#!CB4FTBwQ!JhXn6QwNeDTQu_Ys2KNt_mZlV61r8jcBF_FtVrRlcP0' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'WBaWC (Демо) Рейсен от '; }
		else if ($lang == 'Japanese') { echo '鬼形獣体験版、霊夢カワウソ鈴仙パッチ by '; }
		else { echo 'WBaWC (Demo) Reisen by '; }
	?>Kayu</strong></p>
	<a href='https://mega.nz/#!yeABgCSJ!_tZ_8tQeYORgcqVvTh6KLN8t7jrRy685zWqwmbykHrg' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><?php
		if ($lang == 'Russian') { echo 'Заменяет РеймуВыдру на Рейсен в демо-версии WBaWC.'; }
		else if ($lang == 'Japanese') { echo '鬼形獣体験版の霊夢カワウソを鈴仙に差し替えます。'; }
		else { echo 'Replaces ReimuOtter with Reisen in the WBaWC demo.'; }
	?></p>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'WBaWC Наруми от '; }
		else if ($lang == 'Japanese') { echo '鬼形獣成美パッチ by '; }
		else { echo 'WBaWC Narumi by '; }
	?>Kayu</strong></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Добавляет Наруми в WBaWC в качестве шоттипа.'; }
		else if ($lang == 'Japanese') { echo '成美を自機として鬼形獣に加えます。'; }
		else { echo 'Adds Narumi to WBaWC as a shottype.'; }
	?></p>
	<a href='https://mega.nz/#!nToG2QpA!t20hP8GMBB3cOqncqePXcwRo5qpRDDwXqzLPilyfiVw' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <!-- Hard Mode / Ultra Patches -->
    <hr>
    <h2 id='hardultra'><?php
		if ($lang == 'Russian') { echo 'Хард мод / Ультра патчи'; }
		else if ($lang == 'Japanese') { echo 'ハードモード/ウルトラモードパッチ'; }
		else { echo 'Hard Mode / Ultra Patches'; }
	?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Патчи, которые увеличивают плотность и скорость пуль, но взамен дают автобомбы в качестве ' .
			'компенсации. Хард моды также меняют сами паттерны. Главный пак ультра патчей включает в себя игры до ISC.';
		} else if ($lang == 'Japanese') {
			echo '弾幕密度を上げたり、ゲーム自体のスピードを上げるパッチです。攻略のためオートボムが補償されます。' .
			'ハードモードパッチはパターンの変更を余儀なくさせ、各ウルトラパッチはスペルカードを不可能弾幕に改変したりします。';
		} else {
			echo 'Patches that increase the bullet density and speed throughout the game, while giving you autobombs ' .
			'to compensate for it. The Hard Mode patches also change the actual patterns. The main Ultra patch ' .
			'collection includes the games up to ISC.';
		}
	?></p>
    <div>
        <p><a href='http://cheater.seesaa.net/category/9478192-1.html' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Главные ультра патчи'; }
			else if ($lang == 'Japanese') { echo 'メインウルトラパッチ'; }
			else { echo 'Main Ultra Patches'; }
		?></a></p>
        <p><a href='https://www.axfc.net/u/785101' target='_blank'><?php
			if ($lang == 'Russian') { echo 'Альтернативная ультра для EoSD'; }
			else if ($lang == 'Japanese') { echo '紅魔郷極弩パッチ'; }
			else { echo 'Alternate EoSD Ultra'; }
		?></a></p>
    </div>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Хард моды от '; }
		else if ($lang == 'Japanese') { echo 'ハードモードパッチ by '; }
		else { echo 'Hard Mode patches by '; }
	?><a href='https://twitter.com/chirpeh13' target='_blank'>Chirpy</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Патчи для UFO и DDC которые меняют и усложняют паттерны.'; }
		else if ($lang == 'Japanese') { echo '星蓮船と輝針城に使用できるパッチで、難易度が上昇します。'; }
		else { echo 'Patches for UFO and DDC that modify patterns, besides simply making them harder.'; }
	?></p>
    <div>
        <p><a href='https://www.mediafire.com/file/e3sx5g9jtbell33/th12.dat' target='_blank'>HardUFO</a> |
        <a href='http://www.mediafire.com/file/usbud0rr385z2nn/th14.dat' target='_blank'>HarDDC</a></p>
    </div>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'RNG патчи от '; }
		else if ($lang == 'Japanese') { echo 'ランダムパッチ by '; }
		else { echo 'RNG patches by '; }
	?><a href='https://www.twitch.tv/thedaikarasu' target='_blank'>Daikarasu</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> RNG</a></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Коллекция <span class="code">.dat</span> файлов которые добавляют рандом в паттерны.';
		} else if ($lang == 'Japanese') {
			echo '<span class="code">.dat</span> ファイルを改変し、敵の攻撃をランダムにする一連のパッチです。';
		} else {
			echo 'A collection of modified <span class="code">.dat</span> files that randomise the patterns in the game.';
		}
	?></p>
	<a href='https://mega.nz/folder/AY8iWQyZ#ItObpMjIGEfOXPZyCXAJfA/folder/lckTxKYa' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong>LoLK Black Label</strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Китайский ультра патч для LoLK <em>без</em> автобомб, но увеличивающий силу выстрела вдвое.';
		} else if ($lang == 'Japanese') {
			echo '中国製の紺珠伝ウルトラパッチです。オートボムは省略されていますが、ショット火力が倍になっています。';
		} else {
			echo 'A Chinese Ultra patch for LoLK, which does <em>not</em> have autobomb, ' .
			'but it doubles your shot power instead.';
		}
	?></p>
    <a href='https://pan.baidu.com/s/1pJDYEsr' target='_blank'><?php echo tl_term('Download', $lang) ?> (Baidu)</a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'IN Двойной стейдж '; }
		else if ($lang == 'Japanese') { echo '永夜抄ダブルステージ '; }
		else { echo 'IN Double Stage '; }
	?>4/6</strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Позволяет сыграть в стейджы 4А, 4Б, 6А и 6Б, а также по желанию в Экстра-уровень в одном забеге.';
		} else if ($lang == 'Japanese') {
			echo '永夜抄の１回のプレイでで4A,4B,6A,6Bを遊べるツールです。また最後にエクストラが追加されているバージョンもあります。';
		} else {
			echo 'Allows you to play 4A, 4B, 6A and 6B in a single run. Optionally also includes Extra at the end.';
		}
	?></p>
    <div>
        <p><a href='http://www.mediafire.com/file/a0nd1a6asqpy2de/th08_8stages.rar' target='_blank'>Without Extra</a> |
        <a href='http://www.mediafire.com/file/sb7hzvb4fmwrwvb/th08_9stages.rar' target='_blank'>With Extra</a></p>
    </div>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'HSiFS УльтраБ от '; }
		else if ($lang == 'Japanese') { echo '天空璋ウルトラB by '; }
		else { echo 'HSiFS UltraB by '; }
	?><a href='https://twitter.com/mdude33' target='_blank'>Dass</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Альтернативный ультра патч для HSiFS который увеличивает плотность.'; }
		else if ($lang == 'Japanese') { echo '天空璋の弾幕を激しくするもう一つのパッチです。'; }
		else { echo 'An alternate HSiFS Ultra patch that also increases density.'; }
	?></p>
    <a href='https://mega.nz/#!LxNAQbyB!a2qOOOgYQ8-NwTWvLSgcykBXsEmhgy6IDpdEdxlG-90' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong>"LoDDK" by <a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> LoDDK</a></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Совмещает вместе LoLK и DDC, каждая битва с боссом превращается в двойной боссфайт из обеих игр. ' .
			'В патче нет стейджей, то есть это боссраш. Также элементы интерфейса совмещены между собой.';
		} else if ($lang == 'Japanese') {
			echo '紺珠伝と輝針城を混在させ、各ステージのボスを各作品から同時に出現させ戦います。道中は省略され、' .
			'効率的なボスラッシュとなっています。また両作品のHUD(残機やボムなどの表記)は両作品が混在する形になります。';
		} else {
			echo 'Combines LoLK with DDC, making each boss fight a dual boss fight against the bosses of both games.' .
			'It removes all stage portions, effectively making it a boss rush, and also combines the HUDs of both games.';
		}
	?></p>
	<a href='https://priw8.github.io/#s=patches/loddk' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'OC патчи от '; }
		else if ($lang == 'Japanese') { echo 'OCパッチ by '; }
		else { echo 'OC Patches by '; }
	?><a href='https://www.twitch.tv/bravidunno'>Bravi</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> BraviOCOkina</a></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Переделанная версия шестого стейджа и более сложная Экстра в HSiFS, включая в себя оригинального ' .
			'персонажа вместо Окины и альтернативные историю, паттерны, типы пуль, музыку и графические изменения. ' .
			'Также есть патч с такими же изменениями для VD в сценах с Окиной.';
		} else if ($lang == 'Japanese') {
			echo '天空璋本編および天空璋エクストラのリマスターバージョンです。オリジナルの隠岐奈はオリジナルキャラへ差し替えられ、' .
			'ストーリーも変わります。パターン、弾種、BGM、グラフィックも変更されます。' .
			'ナイトメアダイアリーの隠岐奈登場シーンを改変する別のOCパッチも同じダウンロードページにあります。';
		} else {
			echo 'Remastered version of Stage 6 and harder version of Extra in HSiFS, including an original character ' .
			'replacing Okina and alternate story along with pattern, bullet type, stage music and graphical changes. ' .
			'There is another patch with the same OC replacement and pattern modding for VD on the Okina scenes on ' .
			'the same download page.';
		}
	?></p>
	<a href='https://mega.nz/file/1iQhyC5S#GLZTjEnQ1iKsN9fPGESJJK-xiyi7jqJMdC3gPH19LtM' target='_blank'><?php echo tl_term('Downloads', $lang) ?></a>
    <!-- Graphical Patches -->
    <hr>
    <h2 id='graphical'><?php
		if ($lang == 'Russian') { echo 'Графические патчи'; }
		else if ($lang == 'Japanese') { echo 'グラフィックパッチ'; }
		else { echo 'Graphical Patches'; }
	?></h2>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Модификации к <span class="code">.dat</span> файлам которые меняют графические составляющие игры.';
		} else if ($lang == 'Japanese') {
			echo 'ゲームの <span class="code">.dat</span> ファイルを改変し、ゲームの見た目を変更するパッチです。';
		} else {
			echo 'Modifications to the main <span class="code">.dat</span> files of the games ' .
			'that change the way the game looks.';
		}
	?></p>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Графические патчи от '; }
		else if ($lang == 'Japanese') { echo 'グラフィックパッチ by '; }
		else { echo 'Graphical Patches by '; }
	?><a href='https://twitter.com/Gastari_' target='_blank'>Gastari</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Включают в себя PCB и HSiFS в стиле MS Paint, UFO с эмодзи и рожденственский LoLK.';
		} else if ($lang == 'Japanese') {
			echo '妖々夢と天空璋をマイクロソフトペイントのスタイルでプレイできます。' .
			'絵文字テーマの星蓮船とクリスマステーマの紺珠伝のそれぞれパッチがあります。';
		} else {
			echo 'Includes PCB and HSiFS in MS Paint style, an emoji-themed version of UFO and ' .
			'a Christmas-themed version of LoLK.';
		}
	?></p>
    <div>
        <p><a href='http://www.mediafire.com/file/17gq2hnxtmtnrp9/Paint+Cherry+Blossom+GOTY+ver+1.0.zip' target='_blank'><?php
			if ($lang == 'Japanese') { echo 'ペイント妖々夢'; } else { echo 'Paint Cherry Blossom'; }
		?></a></p>
        <p><a href='http://www.mediafire.com/file/zark2co2d9637z4/Painting+Stars+in+Four+Seasons+%28Full+game+patch%29.rar' target='_blank'><?php
			if ($lang == 'Japanese') { echo 'ペインティングスター天空璋'; } else { echo 'Painting Stars in Four Seasons'; }
		?></a></p>
        <p><a href='http://www.mediafire.com/file/yinp1p2rxh04phd/Undefined+Fantastic+Emoji+patch.zip' target='_blank'><?php
			if ($lang == 'Japanese') { echo '絵文字星蓮船'; } else { echo 'Undefined Fantastic Emoji'; }
		?></a></p>
        <p><a href='http://www.mediafire.com/file/apaks0mcs351ylr/Legacy+of+Lunatic+Christmas.zip' target='_blank'><?php
			if ($lang == 'Japanese') { echo 'クリスマス紺珠伝'; } else { echo 'Legacy of Lunatic Christmas'; }
		?></a></p>
    </div>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'Вертикальные патчи от '; }
		else if ($lang == 'Japanese') { echo '真・東方縦画面化ツール by '; }
		else { echo 'Vertical Play Patches by '; }
	?><a href='http://bygzam.seesaa.net/'>niisaka</a></strong></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Патчи, которые переделывают интерфейс в стиле вертикальных шмапов для аркад (TATE).';
		} else if ($lang == 'Japanese') {
			echo '風神録、地霊殿、星蓮船、神霊廟をアーケードスタイルのバーティカル解像度、いわゆる縦画面でプレイできるようにするパッチです。';
		} else {
			echo 'Makes MoF, SA, UFO and TD play in the arcade-style vertical resolution, also known as TATE.';
		}
	?></p>
	<a href='https://bygzam.up.seesaa.net/zip/th_pivot_dx9-110924.zip' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <!-- Emulators -->
    <hr>
    <h2 id='emulators'><?php
		if ($lang == 'Russian') { echo 'Эмуляторы PC-98'; }
		else if ($lang == 'Japanese') { echo 'PC-98エミュレータ'; }
		else { echo 'PC-98 Emulators'; }
	?></h2>
	<p><strong>Neko Project 21</strong></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Эмулятор с активной поддержкой. Обладает неплохой точностью, но его достаточно сложно настроить ' .
			'и в целом не рекомендуется, если можно воспользоваться другими вариантами. Эмулятор находится в папке ' .
			'bin с 32bit и 64bit версиями.';
		} else {
			echo 'The only emulator that is currently still maintained together with DOSBox-X. It offers unlimited ' .
			'savestates and has high accuracy, but requires the right configurations; can be confusing for new users. ' .
			'The emulator is located in the bin folder with two versions, 32-bit and 64-bit (x64).';
		}
	?></p>
	<a href='https://sites.google.com/site/np21win/' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong>T98-Next</strong></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Простой в использовании эмулятор с высокой точностью, но низким функционалом.';
		} else {
			echo 'Easy-to-use emulator that will emulate the Touhou games properly without needing configuration ' .
			'of any kind, but less feature-rich, and allows 8 active savestates at a time, 4 of which through hotkeys.';
		}
	?></p>
	<a href='http://www.mediafire.com/file/myjyjyett2d/T98+english.rar' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong>Anex86</strong></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Эмулятор с низкими системными требованиями и возможностью добиться низкого инпут лага. ' .
			'Требует правильной настройки для эмуляции звука и обладает средней по качеству графикой. ' .
			'Также нужен файл со шрифтами, ссылка на скачивание ниже.';
		} else {
			echo 'This emulator has low system requirements and can run even on very old computers. ' .
			'However, the graphics are mediocre and the sound emulation requires proper configuration to be accurate. ' .
			'Allows for 8 savestates and requires a separate font file, linked below.';
		}
	?></p>
	<div>
		<p><a href='https://www.zophar.net/download_file/2133'><?php echo tl_term('Download', $lang) ?></a></p>
		<p><a href='https://www.zophar.net/download_file/2134'><?php echo tl_term('Font', $lang) ?></a></p>
	</div>
	<p><strong>DOSBox-X</strong></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Ветка DOSBox с поддержкой PC-98. Обладает высокой производительностью и нативно работает на Mac и Linux.';
		} else {
			echo 'A fork of the DOSBox project that has support for PC-98. It is the only emulator to run natively ' .
			'under not only Windows, but also Mac and Linux. A list of downloads for each system can be found ' .
			'via the link below.';
		}
	?></p>
	<a href='https://github.com/joncampbell123/dosbox-x/releases' target='_blank'><?php echo tl_term('Downloads', $lang) ?> (GitHub)</a>
    <!-- Miscellaneous -->
    <hr>
    <h2 id='miscellaneous'><?php
		if ($lang == 'Russian') { echo 'Прочее'; }
		else if ($lang == 'Japanese') { echo 'その他'; }
		else { echo 'Miscellaneous'; }
	?></h2>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'Калькулятор очков DRC в реальном времени от '; }
		else if ($lang == 'Japanese') { echo 'リアルタイムDRCポイント可視化ツール by '; }
		else { echo 'Real Time DRC Points Displayer by '; }
	?><a href='https://twitter.com/CaoMinh_Touhou' target='_blank'>Cao Minh</a></strong></p>
	<p><?php
		if ($lang == 'Russian') {
			echo 'Программа, которая отслеживает смерти, бомбы, прочее и высчитывает <a href="drc">DRC</a> ' .
			'очки для сурвайвала и скоринга в реальном времени.';
		} else if ($lang == 'Japanese') {
			echo 'ゲーム内データを追跡し、被弾やボムなどDRCポイントをいくつ獲得できるかを、' .
			'サバイバル、スコアリング両対応で支援するソフトウェアです。';
		} else {
			echo 'A tool that tracks in-game data such as misses, bombs, etc, thus calculating ' .
			'<a href="drc">DRC</a> points for both survival and scoring during a Touhou run.';
		}
	?></p>
	<a href='https://github.com/hoangcaominh/RealTimeDRCPointsDisplayer/releases/latest' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'MS Black Label от '; }
		else if ($lang == 'Japanese') { echo 'MSブラックレーベル by '; }
		else { echo 'MS Black Label by '; }
	?><a href='https://twitter.com/spaztron64' target='_blank'>Spaztron64</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Увеличивает потолок грейза с 999 до 65536.'; }
		else if ($lang == 'Japanese') { echo 'グレイズのカウントストップを999から65536に変更するツールです。'; }
		else { echo 'Increases the graze cap from 999 to 65536.'; }
	?></p>
    <a href='https://maribelhearn.com/mirror/MSBL.zip' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Трекер капрейта в EoSD от '; }
		else if ($lang == 'Japanese') { echo '紅魔郷スペルカードヒストリートラッカー by '; }
		else { echo 'EoSD Capture History Tracker by '; }
	?><a href='https://twitter.com/TrickOfHat' target='_blank'>TrickOfHat</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Консольная программа которая позволяет отслеживаеть капрейт в EoSD. ' .
			'Включает в себя зелёные книги с 4-го стейджа и общее время игры, с поддержкой нескольких файлов сохранений.';
		} else if ($lang == 'Japanese') {
			echo 'ステージ４魔導書地帯の突破カウント、複数のセーブファイルに対応した、' .
			'紅魔郷スペルカードの取得回数をカウントするコマンドラインツールです。';
		} else {
			echo 'Command-line tool that allows you to track how many times you captured spells in EoSD. ' .
			'Includes Stage 4 Books and Play Time tracking, as well as allowing for multiple save files.';
		}
	?></p>
    <div>
        <p><a href='https://mega.nz/#!URxkUSAa!bmKsMnqX8XZxovn9TY1njoa0-2nnC57Sl15KJWs_iy0' target='_blank'><?php echo tl_term('Download', $lang) ?></a></p>
        <p><a href='https://cdn.discordapp.com/attachments/414701108854915072/435727033725878272/EoSD_History_Recorder.rar'>Source code</a></p>
    </div>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Трекер игрового времени в PoFV от '; }
		else if ($lang == 'Japanese') { echo '花映塚プレイタイムレコーダー by '; }
		else { echo 'PoFV Play Time Recorder by '; }
	?><a href='https://twitter.com/TrickOfHat' target='_blank'>TrickOfHat</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Отслеживает время игры в PoFV.'; }
		else if ($lang == 'Japanese') { echo '花映塚のプレイ時間を追跡するツールです。'; }
		else { echo 'Keeps track of your play time in PoFV.'; }
	?></p>
    <a href='https://mega.nz/#!JB4jHJhb!zXa3s_SsAv5P7A1Ua65bGyAJVc76n6iq0KEXWpwJxJE' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Фикс сохранения реплеев в PoFV'; }
		else if ($lang == 'Japanese') { echo '花映塚リプレイ保存クラッシュ回避ツール'; }
		else { echo 'PoFV Replay Save Crash Fixer'; }
	?></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'При запуске с игрой фиксит краш при сохранении реплея.';
		} else if ($lang == 'Japanese') {
			echo 'このツールを起動した状態では、花映塚のリプレイ保存画面で花映塚がクラッシュしてリプレイを保存できない状況を回避できます。';
		} else {
			echo 'Launching this alongside the game fixes the bug that makes the game crash whenever you save a replay.';
		}
	?></p>
    <a href='https://pan.baidu.com/share/link?shareid=3349324077&uk=1627698914' target='_blank'><?php echo tl_term('Download', $lang) ?> (Baidu)</a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'TD Arrange от '; }
		else if ($lang == 'Japanese') { echo '神霊廟アレンジパッチ by '; }
		else { echo 'TD Arrange Patch by '; }
	?><a href='https://twitter.com/qu_ark' target='_blank'>Nereid</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Мод на TD который убирает неуязвимость в трансе, ' .
			'но позволяет его использовать при 1/3 шкалы транса.';
		} else if ($lang == 'Japanese') {
			echo '神霊廟のトランス中無敵をなくす代わりに、３ゲージのうち１ゲージ以上の状態であればトランスできるようになるツールです。';
		} else {
			echo 'Modification of TD that removes the invincibility from trances, ' .
			'instead allowing you to use them starting at 1/3 full gauge.';
		}
	?></p>
    <div>
        <p><a href='https://kawashi.ro/th13arr.zip'><?php echo tl_term('Download', $lang) ?></a></p>
        <p><a href='https://pastebin.com/1jD5GZRe' target='_blank'>Readme</a></p>
    </div>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'HSiFS максимальные сезоны от '; }
		else if ($lang == 'Japanese') { echo '天空璋季節ゲージマックススタート by '; }
		else { echo 'HSiFS Max Season Start by '; }
	?><a href='https://twitter.com/ReformedSmol' target='_blank'>Martin</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Позволяет начать с 6-ым уровнем сезона.'; }
		else if ($lang == 'Japanese') { echo '季節ゲージがマックスの状態で始められるツールです。'; }
		else { echo 'Lets you start with your season level at 6.'; }
	?></p>
    <a href='https://mega.nz/#!HxJRQKKR!MCaZzfVoamBmhvCkVmITQy7nI7WYX8M3FLEYncXNsxs' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Polished Shooting Star от '; }
		else if ($lang == 'Japanese') { echo 'ポリッシュシューティングスター by '; }
		else { echo 'Polished Shooting Star by '; }
	?>YoshiWeegee</strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Позволяет играть в фангейм Shining Shooting Star без надобности ставить китайскую локаль. ' .
			'Однако, на локалях, где используется запятая для десятичных, случится баг при котором некоторые ' .
			'паттерны станут слишком быстрыми. Это фиксится после просмотра реплея или после полного забега.';
		} else if ($lang == 'Japanese') {
			echo 'ロケールを中国語に設定することなく、ファンゲーム「Shining Shooting Star」を実行できるようにするツールです。' .
			'なお小数点にカンマを使用するロケールでは、フルランを再生するか特定のステージのリプレイを見るまで、' .
			'特定のパターンが極端に速くなるパターンスピードのバグは修正されません。';
		} else {
			echo 'Allows you to run the fangame Shining Shooting Star without requiring you to set your locale to ' .
			'Chinese. Note that it does not fix the pattern speed bug on locales that use a comma for decimals, ' .
			'which makes certain patterns extremely fast until a full run is played or a replay of one of certain ' .
			'stages is watched.';
		}
	?></p>
    <a href='https://github.com/yoshiweegee/PolishedShootingStar/archive/master.zip' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'Дисплей инпутов от '; }
		else if ($lang == 'Japanese') { echo 'インプットディスプレイ by '; }
		else { echo 'Input Display by '; }
	?><a href='https://twitter.com/drakeirving' target='_blank'>Drake</a></strong></p>
    <p><?php
		if ($lang == 'Russian') { echo 'Показывает нажатые кнопки. Работает в реальном времени и в реплеях.'; }
		else if ($lang == 'Japanese') { echo 'ボタンの押下状態を表示します。実際のプレイ中、リプレイ再生中ともに動作します。'; }
		else { echo 'Shows your button presses. Works on both gameplay and replays.'; }
	?></p>
    <a href='https://mega.nz/#!Fl8zzIbA!5uVB1uDruZ-tFEc7AWilNmmuXCmx0YgAzghrsU1lsPo' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
    <p><strong><?php
		if ($lang == 'Russian') { echo 'LoLK Pointdevice без потери силы от '; }
		else if ($lang == 'Japanese') { echo '紺珠伝完全無欠パワー低下無効パッチ by '; }
		else { echo 'LoLK Pointdevice no power loss by '; }
	?><a href='https://www.youtube.com/channel/UChyVpooBi31k3xPbWYsoq3w' target='_blank'>32th System</a></strong></p>
    <p><?php
		if ($lang == 'Russian') {
			echo 'Убирает механику потери 0.01 силы режима Pointdevice.';
		} else if ($lang == 'Japanese') {
			echo '紺珠伝完全無欠モードでの被弾時のパワー0.01の低下をなくし、再挑戦できるようにするツールです。';
		} else {
			echo 'Disables the 0.01 power loss mechanic of Pointdevice Mode in LoLK, ' .
			'making sure you never lose power upon restarting a chapter.';
		}
	?></p>
    <a href='https://drive.google.com/file/d/1VibcZoC-V0VI6cRw7r507dfimP9Dif1d' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'HSiFS UFO мод от '; }
		else if ($lang == 'Japanese') { echo '天空璋UFOモッド by '; }
		else { echo 'HSiFS UFO mod by '; }
	?><a href='https://twitter.com/Priweejt' target='_blank'>Priw8</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> th16ufos</a></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Добавляет НЛО в HSiFS.'; }
		else if ($lang == 'Japanese') { echo '天空璋に星蓮船のUFOシステムを移植するツールです。'; }
		else { echo 'Adds UFOs to HSiFS.'; }
	?></p>
	<a href='https://priw8.github.io/#s=patches/uffs' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<p><strong><?php
		if ($lang == 'Russian') { echo 'Фикс каунтерстопа в WBaWC от '; }
		else if ($lang == 'Japanese') { echo '鬼形獣スコアカンスト解除モッド by '; }
		else { echo 'WBaWC score cap mod by '; }
	?><a href='https://www.youtube.com/channel/UChyVpooBi31k3xPbWYsoq3w' target='_blank'>32th System</a></strong>
	<a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Servers' target='_blank'><span class='icon thcrap_icon'></span> score_uncap</a></p>
	<p><?php
		if ($lang == 'Russian') { echo 'Позволяет счетчику очков превышать 9.999.999.990 очков.'; }
		else if ($lang == 'Japanese') { echo 'ゲーム内の9,999,999,990を突破しているスコアを実際のスコアで表示するツールです。'; }
		else { echo 'Allows the in-game score counter to exceed 9,999,999,990 points.'; }
	?></p>
	<a href='https://maribelhearn.com/mirror/th17_score_uncap.zip' target='_blank'><?php echo tl_term('Download', $lang) ?></a>
	<hr>
    <h2 id='acks' class='ack'><?php echo tl_term('Acknowledgements', $lang); ?></h2>
    <div id='ack_container'>
		<p id='jptlcredit'>
			<?php
				if ($lang == 'Japanese') {
                    echo '<a href="https://twitter.com/toho_yumiya">ゆーみや</a>' .
				    'によって日本語に翻訳されました。';
                } else if ($lang == 'Russian') {
                    echo 'Японский перевод сделал ' .
				    '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                } else {
                    echo 'The Japanese translation was done by ' .
                    '<a href="https://twitter.com/toho_yumiya">Yu-miya</a>.';
                }
			?>
		</p>
		<p id='rutlcredit'>
		<?php
			if ($lang == 'Japanese') {
				echo '<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>' .
				'によってロシア語に翻訳されました。';
			} else if ($lang == 'Russian') {
				echo 'Русский перевод сделал <a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>.';
			} else {
				echo 'The Russian translation was done by ' .
				'<a href="https://www.twitch.tv/kvasovy_stg">kvasovy</a>.';
			}
		?>
		</p>
		<p id='ack_mobile' class='noborders'><?php
			if ($lang == 'Russian') {
				echo 'Иллюстрацию на фоне нарисовал(а) <a href="https://www.pixiv.net/member.php?id=66609">青葉</a>.';
			} else if ($lang == 'Japanese') {
				echo '背景イメージは<a href="https://www.pixiv.net/member.php?id=66609">青葉</a>さんの' .
				'ものを使用させていただいております。';
			} else {
				echo 'The background image was drawn by <a href="https://www.pixiv.net/member.php?id=66609">青葉</a>.';
			}
		?></p>
	</div>
    <p id='back'><strong><a id='backtotop' href='#top'><?php echo tl_term('Back to Top', $lang) ?></a></strong></p>
</div>
