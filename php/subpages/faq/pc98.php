<h2 id='pc98'>Running PC-98 games</h2>
<p>The PC-98 Touhou games (Touhou 1 to Touhou 5) require the use of an emulator to play. These games were developed for the old Japanese NEC-PC9801 computers.</p>
<p>There are four emulators in use, with each one having its ups and downs. All of them run on Windows. See below for a quick summary.</p>
<p>Click an emulator icon to download its latest version. For downloading Neko Project 21, look for the line that says <span class='code'>通常版です</span>.</p>

<h2>Contents</h2>
<div class='contents'>
    <p><a href='#summary'>Summary</a></p>
    <p><a href='#mac_linux'>Mac and Linux</a></p>
    <p><a href='#retroarch'>RetroArch</a></p>
    <p><a href='#font_files'>Font files</a></p>
    <p><a href='#autofire'>Autofire</a></p>
    <p><a href='#anex'>Setup guides</a></p>
    <ul>
        <li><a href='#neko'>Neko Project 21</a></li>
        <li><a href='#dosbox'>DOSBox-X</a></li>
        <li><a href='#anex'>Anex86</a></li>
        <li><a href='#t98'>T98-Next</a></li>
    </ul>
</div>

<h3 id='files'>Summary</h3>
<p class='flat'><strong>TL;DR:</strong> In general, Neko Project 21 and DOSBox-X are the recommended emulators.</p>
<p class='wide-bottom'>If your system cannot run them very well, Anex86 can work instead. T98-Next is a last resort option.</p>
<table id='emus' class='noborders'>
    <thead>
        <tr>
            <th class='small_screen'></th>
            <th class='recommended'><em>Recommended!</em></th>
            <th class='small_screen'></th>
            <th class='recommended'><em>Recommended!</em></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class='small_screen'></th>
            <td><a href='https://simk98.github.io/np21w/download.html' target='_blank'><img src='/assets/games/faq/pc98/Neko.ico' alt='Neko Project 21 icon' class='emu'></a></td>
            <th class='small_screen'></th>
            <td><a href='https://dosbox-x.com/' target='_blank'><img src='/assets/games/faq/pc98/Dosbox.ico' alt='DOSBox icon' class='emu'></a></td>
            <td><a href='https://maribelhearn.com/mirror/Anex86.zip'><img src='/assets/games/faq/pc98/Anex86.ico' alt='Anex86 icon' class='emu'></a></td>
            <td><a href='https://maribelhearn.com/mirror/T98-Next.zip'><img src='/assets/games/faq/pc98/Next.ico' alt='T98-Next icon' class='emu t98next'></a></td>
        </tr>
        <tr id='emu_names'>
            <th class='recommended small_screen'><em>Recommended!</em></th>
            <td>Neko Project 21</td>
            <th class='recommended small_screen'><em>Recommended!</em></th>
            <td>DOSBox-X</td>
            <td>Anex86</td>
            <td>T98-Next</td>
        </tr>
        <tr>
            <th class='small_screen'></th>
            <td><ul>
                <li><span class='sign green'>+</span> Infinite savestate slots</li>
                <li><span class='sign green'>+</span> Very accurate</li>
                <li><span class='sign red'>−</span> Autofire scripts may have issues</li>
            </ul></td>
            <th class='small_screen'></th>
            <td><ul>
                <li><span class='sign green'>+</span> Supports Mac and Linux</li>
                <li><span class='sign green'>+</span> Possible to open games from desktop</li>
                <li><span class='sign red'>−</span> Savestates have issues</li>
            </ul></td>
            <td><ul>
                <li><span class='sign green'>+</span> Frameskips for running on old systems</li>
                <li><span class='sign green'>+</span> Savestates with thumbnails</li>
                <li><span class='sign red'>−</span> Only supports 8 savestates</li>
                <li><span class='sign red'>−</span> Least accurate sound</li>
            </ul></td>
            <td><ul>
                <li><span class='sign green'>+</span> Savestates with thumbnails<br> and timestamps</li>
                <li><span class='sign red'>−</span> Only supports 4 savestates</li>
                <li><span class='sign red'>−</span> Known to produce inaccurate behaviour</li>
            </ul></td>
        </tr>
    </tbody>
</table>
<div id='emus_text'>
    <p>See the setup guides below for how to set up, open games and use savestates.</p>
</div>

<h3 id='mac_linux'>Mac and Linux</h3>
<p>As shown in the summary above, DOSBox-X is the only emulator that supports Mac and Linux; therefore, it is the recommended emulator.
Alternatively, <a href='https://www.retroarch.com/' target='_blank'>RetroArch</a> can run Neko Project; see the next section for how to do this.</p>
<p class='flat'>On Mac, you can download the emulator from <a href='https://dosbox-x.com/' target='_blank'>the official DOSBox-X website</a>.</p>
<p class='flat'>For Linux, you can install the <span class='code'>dosbox-x</span> package, or install the emulator through the game manager <a href='https://lutris.net/' target='_blank'>Lutris</a>.</p>

<h3 id='retroarch'>RetroArch</h3>
<p>If you use RetroArch, they have a Neko Project II Kai core, enabling PC-98 emulation. Install this core and apply the following settings:</p>
<table class='noborders'>
    <tr>
        <td>CPU Clock Multiplier</td>
        <td>52</td>
    </tr>
    <tr>
        <td>RAM Size</td>
        <td>16</td>
    </tr>
    <tr>
        <td>Sound Board</td>
        <td>PC9801-26K+86</td>
    </tr>
    <tr>
        <td>Volume VM</td>
        <td>128</td>
    </tr>
    <tr>
        <td>Volume SSG</td>
        <td>128</td>
    </tr>
    <tr>
        <td>Volume RHYTHM</td>
        <td>128</td>
    </tr>
    <tr>
        <td>Sound Generator</td>
        <td>Default</td>
    </tr>
</table>

<h3 id='font_files'>Font files</h3>
<p>Anex86 and Neko Project 21 require the use of a font file. The fonts are already included in the pre-configured downloads.
If you want, you can download the two fonts from the links below. You can use either font with either emulator.</p>
<div id='fonts' class='dual_images'>
    <figure class='dual_left'>
        <img src='/assets/games/faq/pc98/font_np.png' class='eosd_files' alt='Neko Project II font'>
        <figcaption><a href='https://maribelhearn.com/mirror/fontnp.bmp' target='_blank'>Neko Project 21 font</a></figcaption>
    </figure>
    <figure class='dual_right'>
        <img src='/assets/games/faq/pc98/font_anex.png' class='eosd_files' alt='Anex86 font'>
        <figcaption><a href='https://maribelhearn.com/mirror/anex86.bmp' target='_blank'>Anex86 font</a></figcaption>
    </figure>
</div>

<h3 id='autofire'>Autofire</h3>
<p>PoDD (Touhou 3) requires mashing the Z key to shoot, while in SoEW (Touhou 2), you deal more damage by mashing the Z key than by holding it.
The following autofire scripts allow you to play more comfortably for your hands, avoiding button mashing:
<p><a href='https://maribelhearn.com/mirror/PoDDofire.ahk'>PoDDofire.ahk</a></p>
<p><a href='https://maribelhearn.com/mirror/SoEWofire.ahk'>SoEWofire.ahk</a></p>
<p>You need to have <a href='https://www.autohotkey.com/' target='_blank'>AutoHotkey</a> installed to use these scripts.</p>

<h3 id='neko'>Neko Project 21</h3>
<p><em>This guide is courtesy of <a href='https://nc-roadgeek.neocities.org/mima/pc98-neko' target='_blank'>Feeva</a></em></p>
<img src='/assets/games/faq/pc98/neko_open.png' alt='Neko Project 21 main screen'>
<p>To open the emulator, open <span class='code'>np21.exe</span>.</p>
<p>To load a game, open the Harddisk tab and click Open under IDE #0. Choose your <span class='code'>.hdi</span> file.</p>
<p>For savestates, you need to have opened the emulator at least once. Once you have done that, open the <span class='code'>np21.ini</span> file and add this line: <span class='code'>STATSAVE=true</span>. This will add the Stat tab to the emulator window. This tab is used for savestates.
Open the Stat tab and click "Title" to change your current savestate collection. Any savestate you make will have the title in its name. This allows you to make essentially infinite savestates. To load a savestate from a different collection,
simply change the title back to that collection's name.</p>
<img src='/assets/games/faq/pc98/neko_config1.png' alt='Neko Project 21 config screen'>
<p>Open the Emulate tab and click Configure. Adjust the settings so that it looks like the screenshot.</p>
<p>Open the Device tab, then Memory, and set it to 1.6 MB.</p>
<div id='neko_config' class='dual_images'>
    <figure class='dual_left'>
        <img src='/assets/games/faq/pc98/neko_config2.png' alt='Neko Project 21 memory options'>
    </figure>
    <figure class='dual_right'>
        <img src='/assets/games/faq/pc98/neko_config3.png' alt='Neko Project 21 screen options'>
    </figure>
</div>
<p>Open the Screen tab and click Screen Option. Enable Skipline Revisions and set the ratio to the maximum value of 255. Click OK and restart the emulator, holding the End key <em>immediately</em> following the restart.
You should see a screen like the screenshot below.</p>
<img src='/assets/games/faq/pc98/neko_config4.png' alt='Neko Project 21 boot config screen'>
<p>Go to the second option and press Enter. Scroll down using the arrow keys until you reach the GDCクロック option. There, press the Right arrow key and press Enter to set it to 2.5 MHz.
Then, go to 終了 and hit Enter to save the setting. The emulator is now fully configured and ready for play.</p>
<img src='/assets/games/faq/pc98/neko_config5.png' alt='Neko Project 21 boot config screen'>

<h3 id='dosbox'>DOSBox-X</h3>
<p>Refer to the guide on <a href='https://dosbox-x.com/wiki/Guide%3APC%E2%80%9098-emulation-in-DOSBox%E2%80%90X' target='_blank'>the official DOSBox-X website</a> for how to set it up for PC-98 games.</p>
<p>For savestates, open the Capture tab and click Save state and Load state respectively. Under "Select save slot" you can find a total of 100 save slots; click Previous page and Next page for navigation.
There are currently various issues with savestates in this emulator, such as sound issues and broken graphics. Timing your savestates when there is no music playing may help prevent this.</p>
<p>If you want desktop shortcuts for your games, you can make shortcuts to the following:</p>
<p><span class='code'>&lt;path_to_dosbox&gt; -conf &lt;path_to_config_file&gt;</span></p>
<p>This will launch DOSBox-X with that particular config file. Each game should have its own config file. On Linux, the game manager <a href='https://lutris.net/' target='_blank'>Lutris</a> supports DOSBox-X,
so it is also possible to make shortcuts through there.</p>

<h3 id='anex'>Anex86</h3>
<img src='/assets/games/faq/pc98/anex86.png' alt='Anex86 main screen'>
<p>To load a game, click the three dots "..." next to HDD1 and click your desired <span class='code'>.hdi</span> file. Click the Start button to launch it.</p>
<p><em>The Anex86 download provided on this page is already correctly configured. If you obtained it elsewhere, follow the steps below.</em></p>
<p>Before getting started, click Config to improve the sound quality, as it is not great by default.</p>
<div class='dual_images'>
    <figure class='dual_left'>
        <img src='/assets/games/faq/pc98/anex86_sound.png' class='eosd_files' alt='Anex86 sound config screen'>
    </figure>
    <figure class='dual_right'>
        <img src='/assets/games/faq/pc98/anex86_wave.png' class='eosd_files' alt='Anex86 wave config screen'>
    </figure>
</div>
<p>Open the Sound tab and make sure all checkboxes are checked. On the Wave tab, Rate/Buffer should be set to 55 kHz and the buffer to 16. "Use wave out" should be checked and all of the bars should be centered.</p>
<p>To create a savestate, press anywhere between Alt+F1 to Alt+F9 (except for Alt+F4, of course). This will also create a thumbnail image in the emulator folder.
To load a savestate, press the same key combinations, but without the game window open.</p>

<h3 id='t98'>T98-Next</h3>
<img src='/assets/games/faq/pc98/t98.png' alt='T98-Next main screen'>
<p>To load a game, click the grey bar that is highlighted in the above screenshot, then choose your <span class='code'>.hdi</span> file.</p>
<p>The 1st button starts the game, 3rd button restarts the emulator, 4th button toggles between hiding and showing the menu, and the 6th button closes the emulator. The 2nd and 5th buttons are not used for these games.</p>
<img src='/assets/games/faq/pc98/t98_config.png' alt='T98-Next config screen'>
<p>Click the "MotherBoard Setting" tab and make sure it looks like the above screenshot.</p>
<p>To create a savestate, press F11, followed by anywhere between F1 and F4. To load a savestate, press F12, then F1-F4.</p>
<p>The F11 and F12 menus also include some other hotkeys:</p>
<table id='t98_hotkeys' class='noborders'>
    <tr>
        <td>F11 + F9</td>
        <td>Close game</td>
    </tr>
    <tr>
        <td>F11 + F10</td>
        <td>Reset game</td> 
    </tr>
    <tr>
        <td>F12 + F10</td>
        <td>Toggle fullscreen</td>
    </tr>
</table>
<?php // language detection hack ?>
