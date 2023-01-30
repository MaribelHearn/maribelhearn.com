<h2 id='eosd'>Getting EoSD to work</h2>
<p><em>This guide is courtesy of <a href='https://www.twitch.tv/the_star_king'>Star King</a></em></p>
<p>Getting EoSD to run properly on Windows - especially Windows 10 - can seem like an arduous task, but generally speaking, there's really just three main issues that need to be addressed:</p>
<ol>
    <li>Incorrectly named files.</li>
    <li>Uncapped FPS bug, where your game runs at a much higher speed than the intended 60 FPS (issue with EoSD on Windows 10 specifically).</li>
    <li>The need to run EoSD on Japanese locale, or a way to bypass this need (issue with EoSD on any Windows).</li>
</ol>
<p>These three problems will be addressed, in order, by the following three sections. For the vast majority of people, this will be enough to get EoSD to run well.</p>
<h4 id='files'>File names</h4>
<div id='eosd_files'>
    <figure id='files_mb'>
        <img src='/assets/games/faq/eosd/eosd_files_mb.png' class='eosd_files' alt='Mojibake EoSD file names'>
        <figcaption><em><span class='red'>Wrong</span> file names</em></figcaption>
    </figure>
    <figure id='files_jp'>
        <img src='/assets/games/faq/eosd/eosd_files_jp.png' class='eosd_files' alt='EoSD file names in Japanese'>
        <figcaption><em><span class='green'>Correct</span> file names</em></figcaption>
    </figure>
</div>
<div id='files_text'>
    <p>The file names are supposed to look like the image on the right, but many people have something that looks like the left image.
    What are supposed to be Japanese characters have been replaced by this gibberish text, known as <strong>mojibake</strong> (the garbled text may look different for you than the images shown here).
    The most common source of this is when these files have been extracted from an archive, such as a <span class='tt'>.zip</span> file, without Japanese locale.</p>
    <p>Rename the <span class='tt'>.exe</span> file to <span class='code'>東方紅魔郷.exe</span> and rename the <span class='tt'>.dat</span> files to <span class='code'>紅魔郷XX.DAT</span>,
    where "XX" is the two English characters that should already be at the end of the file name, which you should keep the same (for example, renaming <span class='code'>ìgûéï╜CM.DAT</span>
    to <span class='code'>紅魔郷CM.DAT</span> - see the two images above).</p>
    <p>This process is just for the Japanese version (including if you want to use the THCRAP translation patch, which runs off of the Japanese executable).
    If you wish to use the static English patch, it's fine to leave the <span class='code'>th06e_XX.DAT</span> files alone, since those are the data files the patch uses instead.
    However, if you want to use vpatch with the static English patch (highly recommended - see next section), you still need to rename whatever
    your English executable is named (usually th06e.exe or eosd.exe) to <span class='code'>東方紅魔郷.exe</span> for vpatch to detect it.</p>
</div>
<h4 id='vpatch'>vpatch</h4>
<p>Using vpatch is standard practice in the community. The main reason it's used is because it reduces input lag, especially for the older Windows games.
Importantly for this guide, it also happens to fix the uncapped FPS bug. <a href='https://maribelhearn.com/mirror/VsyncPatch.zip' target='_blank'>Download vpatch here</a>.</p>
<p>Follow the instructions in the text file that's in the folder. As it mentions, whatever executable you are running with vpatch must be named <span class='code'>東方紅魔郷.exe</span>.</p>
<p>Optionally, you can replace <span class='code'>vpatch_th06.dll</span>
with <span class='code'>vpatch_th06_unicode.dll</span>. <a href='https://www.thpatch.net/wiki/File:vpatch_th06_unicode.zip' target='_blank'>Download it here.</a></p>
<p>This bypasses the need for Japanese locale <em>if</em> you play with THCRAP or the static English patch. You still need Japanese locale to run the game in Japanese, which leads us to the next section.</p>
<h4 id='jplocale'>Japanese locale</h4>
<p>What changing your locale does is change the default language that is used for non-Unicode programs. It does <em>not</em> change the language your Windows environment will be in.
Unless you use the method mentioned above (English patch + vpatch Unicode DLL), you will need your locale to be Japanese to run EoSD on Windows.
Also, you will need Japanese locale to use any of the practice tools that exist.</p>
<p>You can do this in two ways: a locale emulator, or actually changing your computer's locale.</p>
<p>Locale Emulator allows you to run a program in a specific locale (such as Japanese) while keeping your computer in a different locale (such as English).
<a href='http://xupefei.github.io/Locale-Emulator/' target='_blank'>Download link</a>.</p>
<p>The second option is to simply change your computer's locale to Japanese instead. To do this, go to your Windows search bar and search for "Control Panel".
Open it, click on "Clock and Region", then "Region". Go to the "Administrative" tab and change the system locale to Japanese there. This will prompt a reboot.</p>
<h3 id='eosd_extra'>Extra</h3>
<h4 id='enbconvertor'>DirectX 8 to DirectX 9 converter</h4>
<p>This fixes some issues for the older Touhou games (Touhou 6 to 9.5). This is another solution to the uncapped FPS bug, although vpatch already does that.
Also, some people's computers may refuse to go to exclusive fullscreen for these games, and this fixes that (which also results in less input lag).
At the very least, it seems to have no negative effects, so it doesn't hurt to have it. When combined with vpatch, it may reduce input lag
even further (not confirmed). <a href='http://enbdev.com/convertor_dx8_dx9_v0036.htm' target='_blank'>Download link</a>.</p>
<h4 id='thprac'>thprac</h4>
<p>thprac (not to be confused with <a href='tools#thcrap'>thcrap</a>) is a popular practice tool. It requires Japanese locale to use with EoSD.
It can be <a href='https://github.com/ack7139/thprac/releases' target='_blank'>downloaded here</a>.</p>
<p>thprac is supposed to apply vpatch automatically if it's run in the same folder, but the vpatch Unicode DLL breaks this.
To get around this, simply run the game with vpatch first, then apply thprac by running it. It should detect EoSD and ask to apply itself.</p>
<p>thprac does not work with the static English patch.</p>
<h3 id='errors'>Error messages</h3>
<p>These are a few of the most common error messages, shown in both Japanese and mojibake. If you are getting an error message in mojibake,
it means you are not running the program in Japanese locale, which may be your problem: see <a href='#jplocale'>Japanese locale</a>.</p>
<h4><span class='tt'>.dat</span> error</h4>
<img class='error' src='/assets/games/faq/eosd/eosd_error_dat.png' alt='EoSD .dat error message'>
<p>This error message shows when EoSD fails to load data from the <span class='tt'>.dat</span> files properly. Make sure your <span class='tt'>.dat</span> files are named
as shown in the <a href='#files'>File names</a> section. Also, the mojibake version of this error message is what shows if you try to run the Japanese executable without Japanese locale.</p>
<h4>Duplication error</h4>
<img class='error' src='/assets/games/faq/eosd/eosd_error_dup.png' alt='EoSD duplicate error message'>
<p>This error message occurs when you try to open a second instance of EoSD. Make sure you have all EoSD processes closed before trying to run it again.</p>
<p>If you seemingly have no EoSD processes open and are still getting this message, you likely have a "ghost process".
This happens occasionally after you try to close the game - the game is still running in the background but isn't visible.
Open Task Manager, and you should be able to find it in the "Processes" tab (likely in the "Background Processes" section when it's a ghost process) and right click -> "End Task".</p>
<h4>vpatch error</h4>
<img class='error' src='/assets/games/faq/eosd/eosd_error_vpatch.png' alt='EoSD vpatch error message'>
<p>A "game not found" error message given by vpatch. Make sure your EoSD executable is named <span class='code'>東方紅魔郷.exe</span>.</p>
<?php // language detection hack ?>
