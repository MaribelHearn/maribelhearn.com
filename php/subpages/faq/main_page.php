<p>This page answers some of the most frequently asked questions about the Touhou shoot 'em up games by beginning players.</p>
<p>If you are looking for information about the fighters, you are on the wrong website. See <a href='https://hisouten.koumakan.jp/wiki/Introduction'>hisouten.koumakan.jp</a> for Hisoutensoku (Touhou 12.3).</p>
<h2>Contents</h2>
<div class='contents'>
    <p><a href='#getstarted'>Getting started</a></p>
    <p><a href='#where'>Where do I get the games?</a></p>
    <p><a href='#setup'>Setting up</a></p>
    <p><a href='#eosd'>Getting EoSD (Touhou 6) to work</a></p>
    <p><a href='#gfx'>Graphical issues</a></p>
    <p><a href='#gameplay'>Gameplay questions</a></p>
    <p><a href='#desync'>Why does my replay desync?</a></p>
</div>
<hr>
<h2 id='getstarted'>Getting started</h2>
<p>The Touhou Wiki <a href='https://en.touhouwiki.net/wiki/Getting_Started'>Getting Started</a> page contains general information about the Touhou series of shoot 'em up games,
as well as what mindset to have when playing these games and gameplay tips. You will die a lot. Everyone dies all the time and this is normal.
You will need to learn and practice and you will improve over time.</p>
<h4 id='start'>What game should I start with?</h4>
<p><em>See the <a href='/faq/start'>Which game to start with</a> page for the full story.</em></p>
<p>Tl;dr: PCB, IN, MoF and DDC (Touhou 7, 8, 10 and 14) for simple mechanics and a smooth learning curve.
SA, UFO and LoLK (Touhou 11, 12 and 15) are not recommended, but are perfectly fine if you are up to the challenge.</p>
<hr>
<h2 id='where'>Where do I get the games?</h2>
<h4 id='steam'>Steam</h4>
<p>Steam is the most reliable way to purchase the official Touhou games. Shoot 'em up games from Shoot the Bullet (Touhou 9.5) onwards are all available on Steam. The mainline games cost $15 while spinoff games cost $11.
Go to <a href='https://hakureishrine.org'>hakureishrine.org</a> for all of the official games that are available on Steam.</p>
<h4 id='amazon'>Amazon and other webshops</h4>
<p>For games not on Steam, or if you do not want to use Steam, there are other places where you can buy the games legally. Amazon has physical copies of these games but for a higher price.
This currently is the only legal way to obtain games EoSD (Touhou 6) to PoFV (Touhou 9). Other distributors such as DLSite, DMM and PLAYISM have some of the entries if you do not want to buy from Steam.
Check out the Touhou Wiki <a href='https://en.touhouwiki.net/wiki/Purchasing_Guide'>Purchasing Guide</a> for help with this.</p>
<hr>
<h2 id='setup'>Setting up</h2>
<p>After getting the game, <em>assuming you got the game legally</em>, you will most likely want to set up before playing. If you want to play in English or any other language you will need to download THCRAP.
Many games will also require vpatch or the game will have input lag. EoSD (Touhou 6) is pretty stubborn and needs more setup, see the page <a href='/faq/eosd'>Getting EoSD to work</a>.</p>
<p>Other than the newest game, UM (18), Touhou does not have built-in rebinding for keyboards. An external program such as AutoHotkey is needed, explained further below.</p>
<h4 id='vpatch'>What is vpatch and how do I use it?</h4>
<p>An essential tool to remove input lag. See the <a href='/tools#vpatch'>Touhou Patches and Tools</a> page.</p>
<p>To set it up, extract it from the <span class=tt>.zip</span> archive file you downloaded. Read the readme file that is contained inside.
<h4 id='english'>How do I play in English / other languages?</h4>
<p>Use THCRAP. See the <a href='/tools#thcrap'>Touhou Patches and Tools</a> page.</p>
<h4 id='graphics'>Why is my game wide / pixelated / fuzzy / small?</h4>
<p><em>See the <a href='/faq/graphics'>Graphical issues</a> page.</em></p>
<h4 id='lag'>Why is my game lagging a lot?</h4>
<p>Try plugging in a controller and see if that fixes it. You do not need to actually use the controller.</p>
<h4 id='fps'>My game is running at a very high <abbr title='frames per second'>FPS</abbr>, what do I do?</h4>
<p>Use <a href='/tools#vpatch'>vpatch</a>. See the <a href='/tools#vpatch'>Touhou Patches and Tools</a> page.</p>
<h4 id='d3d9'>It says <span class='tt'>d3d9_xx.dll</span> is missing, what do I do?</h4>
<p>Download and install <a href='https://www.microsoft.com/en-us/download/details.aspx?id=8109'>DirectX End-User Runtimes</a> from the official Microsoft website.</p>
<h4 id='directx'>I get a DirectInput / Direct3D error, how do I fix it?</h4>
<p>If you are playing Touhou 11 or newer in fullscreen, try lowering the resolution in the dialog when you open the game.
If the dialog does not open, change it via <span class='tt'>custom.exe</span>. Be sure to launch it either in Japanese locale,
or in English using <a href='/tools#thcrap'>THCRAP</a>.</p>
<h4 id='keys'>How do I remap my keys?</h4>
<p>If you are playing UM (Touhou 18), you can do this in-game. Otherwise, use <a href='https://www.autohotkey.com/'>AutoHotKey</a>.
For Mac or Linux, see <a href='https://en.touhouwiki.net/wiki/Running_in_Linux_and_Mac_OS_X/Misc_fixes#Remapping_Keys'>this Touhou Wiki page</a>.</p>
<h4 id='maclinux'>I use Mac / Linux, can I play Touhou?</h4>
<p>Yes. See the Touhou Wiki <a href='https://en.touhouwiki.net/wiki/Running_in_Linux_and_Mac_OS_X'>Running in Linux and Mac OS X</a> page for help.</p>
<h4 id='misc'>My game still doesn't work even after applying aforementioned fixes</h4>
<p>If it's EoSD (Touhou 6), see the page <a href='/faq/eosd'>Getting EoSD to work</a>. If there is a <span class='code'>d3d8.dll</span> file in the game folder,
delete it and try again. Otherwise, try any of the following:</p>
<ul>
    <li><a href='https://www.microsoft.com/en-us/download/details.aspx?id=35'>DirectX End-User Runtime Web Installer</a></li>
    <li><a href='https://aka.ms/vs/16/release/vc_redist.x86.exe'>Visual C++ Redistributable (64-bit)</a></li>
    <li><a href='https://aka.ms/vs/16/release/vc_redist.x64.exe'>Visual C++ Redistributable (32-bit)</a></li>
</ul>
<hr>
<h2 id='eosd'>Getting EoSD (Touhou 6) to work</h2>
<p><em>See the page <a href='/faq/eosd'>Getting EoSD to work</a> for how to run Touhou 6.</em></p>
<hr>
<h2 id='gfx'>Graphical issues</h2>
<p><em>See the page <a href='/faq/graphics'>Graphical issues</a>.</em></p>
<p>If your game is wide, small, pixelated or otherwise not shown correctly on your screen, check out the page linked above.</p>
<hr>
<h2 id='gameplay'>Gameplay questions</h2>
<h4 id='clear'>What is a '1cc'?</h4>
<p>1cc stands for <strong>1 credit clear</strong> and is also regularly called "clear", verb "clearing". This means beating the game without using any continues.
You do <em>not</em> need to see the Good Ending for a run to count as a 1cc. For more explanations of gameplay community terminology, see the <a href='/jargon'>Touhou Community Jargon</a> page.</p>
<h4 id='best'>Who is the best character / shottype?</h4>
<p><em>See the <a href='/faq/shots'>Shottypes</a> page.</em></p>
<h4 id='extra'>How do I unlock the Extra Stage?</h4>
<p><em>See the <a href='/faq/extra'>Extra Stage</a> page.</em></p>
<h4 id='res'>How do I get more lives / bombs?</h4>
<p><em>See the <a href='/faq/resources'>Resources</a> page.</em></p>
<h4 id='score'>How do I play for score?</h4>
<p><em>See the <a href='/faq/scoring'>Scoring</a> page.</em></p>
<h4 id='bombing'>When should I be bombing?</h4>
<p>Practice the game and find out which patterns you can dodge easily and which ones you cannot. You want to plan bombs for anything that is not consistent for you,
while also leaving some room for unplanned bombs, so you can bomb when you mess up.</p>
<h4 id='ending'>Does Easy 1cc give the Bad Ending?</h4>
<p>In most games, no, it does not. Only in LLS (Touhou 4), EoSD (Touhou 6) and MoF (Touhou 10) does this occur.</p>
<h4 id='replays'>How do I play <span class='tt'>.rpy</span> files?</h4>
<p>Open up your game and navigate to the Replay screen on the main menu. You can watch your replays there.</p>
<h4 id='ud'>I ran out of space for replays. How do I add more?</h4>
<p>You can add additional replays by naming them in the following format: <span class='code'>thX_udYYYY.rpy</span>. The "X" is the game number used for the replay files of the game,
while "YYYY" is any 4 letters or digits. These files will be detected by the game if put in its replay folder. You can reach them by using the right arrow key on the Replay screen in-game.
Note that most spinoffs consist of three digits; for example, GFW (Touhou 12.8) uses <span class='code'>th128</span> and ISC (Touhou 14.3) uses <span class='code'>th143</span>.</p>
<p><strong>Note:</strong> MoF (Touhou 10) does not read these extra replays, meaning you can only use the default slots.</p>
<h4 id='replayfolder'>Where can I find my replays / screenshots?</h4>
<p>For EoSD (Touhou 6) up to UFO (Touhou 12), replays are in the <span class='tt'>replay</span> subfolder in your game folder.
<br>From DS (Touhou 12.5) onwards, press Win+R and run <span class='code'>%appdata%/ShanghaiAlice</span> to open the folder. Making a shortcut to it is recommended.</p>
<p>Screenshots made using the Home or P key are in the <span class='tt'>snapshot</span> subfolder in your game folder.</p>
<h4 id='zip'>Why is the game not saving my progress?</h4>
<p>You are playing inside a <span class='tt'>.zip</span> archive file. Right click the file and extract its contents into a folder, then play the game from that folder.</p>
<hr>
<h2 id='desync'>Why does my replay desync?</h2>
<h4 id='classic'>EoSD to IN (Touhou 6-8)</h4>
<p>You paused during boss dialogue, or the replay was played on a static English patch while you are watching it on the original game.
Unpausing using the Esc key instead of the Z key prevents the dialogue desync.</p>
<h4 id='mof'>MoF (Touhou 10)</h4>
<p>You probably started a replay from Stage 4, which always desyncs in MoF. Start from another stage instead.
If this does not solve it, you might have saved a replay more than once. In MoF, saving a replay more than once will cause every replay except the first to glitch out; it may have 0 FPS and may crash.</p>
<h4 id='sa'>SA (Touhou 11)</h4>
<p>You fast-forwarded a replay, or started it from Stage 6, and then repeatedly died to Utsuho's first nonspell. You can prevent this by starting from any stage before Stage 6,
and <em>not</em> fast-forwarding after you defeat the Stage 5 boss. You can fast-forward again once the Stage 6 music plays.</p>
<h4 id='td'>TD (Touhou 13)</h4>
<p>If playing as Marisa, replays will desync if they are not started from Stage 1.</p>
<h4 id='ddc'>DDC (Touhou 14)</h4>
<p>Rarely, if playing as Marisa, one of the unfocused lasers may be angled diagonally, or gone entirely.
Replays in which this bug occurred will unfortunately desync once the game is closed.</p>
<h4 id='wbawc'>WBaWC (Touhou 17)</h4>
<p>You restarted a run in the time after a hyper, but before the extra tokens spawned; two tokens will spawn at the start of the broken replay.
To avoid this, either use <a href='/tools#thprac'>thprac</a> or reset your run twice if you are resetting during a hyper.</p>
<h4 id='um'>UM (Touhou 18)</h4>
<p>Desyncs can have several causes. Replays will desync if you changed your active card <em>after</em> beating a boss, or if you are using Momoyo's Centipede card.
Starting the Extra Stage with Byakuren's Scroll card equipped will also desync your run. These issues are fixed by <a href='/tools#thprac'>thprac</a> (use the F12 menu).</p>
<hr>
<?php // language detection hack ?>
<!--<h4 id='cd'>How do I set up the game starting from the CD?</h4>
<p><a href='https://www.youtube.com/watch?v=8Yt2bSh32K8'>This video</a> provides a quick explanation.</p>
<h4 id='fps'>Why is the game running at 5000 <abbr title='frames per second'>FPS</abbr>?</h4>
<p>You have to run the game with <a href='/tools#vpatch'>vpatch</a> to prevent this.</p>
<h4 id='pcb'>Touhou 7: Perfect Cherry Blossom (PCB)</h4>
<h4 id='border'>What is a 'Supernatural Border'?</h4>
<p>Commonly referred to simply as borders. For survival purposes, borders allow you to take one hit for free during their duration,
on which all bullets on screen will be converted into small cherry items. Borders also grant some invincibility frames if you let it time out,
though for 1cc you will want to break them manually instead. This can be done by pressing X during a border.</p>>-->
