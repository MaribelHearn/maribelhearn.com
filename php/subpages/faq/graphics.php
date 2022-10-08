<h2 id='gfx'>Graphical issues</h2>
<p><strong>Note:</strong> this guide is based on Windows 10. Other operating systems may or may not have similar graphics configuration screens.</p>
<br>
<p>Touhou shoot 'em up games are 4:3 games, meaning they are intended to be played in that aspect ratio. However, when launching the games in fullscreen,
they might be stretched to your full display, which is likely a 16:9 display, the standard aspect ratio. Your game might also be too small or otherwise render weirdly.
<br>
If you encounter any of these issues, you are on the right page.</p>
<p>There are two ways to address this: configuring your graphics to maintain the game's aspect ratio, or using <a href='/faq#vpatch'>vpatch</a> to play in a window scaled to your preferred size.
<br>
<strong>Warning:</strong> When using Windows 10, playing in windowed mode increases input lag.</p>
<p>If you own an NVIDIA graphics card, such as the GeForce GTX 1060 or RTX 2070, see <a href='#nvidia'>NVIDIA</a>.
<br>
If you own an AMD graphics card, such as the Radeon RX 580 or Radeon Vega 8, see <a href='#amd'>AMD</a>.
<br>
For Intel integrated graphics, such as Intel HD Graphics 4000, commonly found on laptops, see <a href='#intel'>Intel</a>.
<br>
For vpatch window scaling, see <a href='#vpatch'>the vpatch section</a>.
<h4 id='nvidia'>NVIDIA</h4>
<img class='gpu' src='/assets/games/faq/graphics/nvidia.png' alt='NVIDIA Settings window'>
<p>Open up your NVIDIA Settings and navigate to "Adjust desktop size and position". Set the scaling mode to "Aspect ratio".</p>
<p>If this does not fix your problem, check "Override the scaling mode set by games and programs". If that also fails, try changing your resolution manually.
Alternatively, you can play in a window and use <a href='/faq#vpatch'>vpatch</a> to scale the window to your preferred size.</p>
<h4 id='amd'>AMD</h4>
<img class='gpu' src='/assets/games/faq/graphics/amd.png' alt='Radeon Settings window'>
<p>Open up your Radeon Settings and navigate to the "Display" tab (see image). Enable "GPU Scaling" and set the scaling mode to "Preserve aspect ratio" to make sure
the games will render in the correct aspect ratio (4:3).</p>
<p>If this does not fix your problem, go to "Custom Resolutions" on the right and click "Create New".
Adjust the values in the new window that opens to your liking.
Alternatively, you can play in a window and use <a href='/faq#vpatch'>vpatch</a> to scale the window to your preferred size.</p>
<h4 id='intel'>Intel</h4>
<img class='gpu' src='/assets/games/faq/graphics/intel.png' alt='Intel HD Graphics Control Panel'>
<p>Open up Intel HD Graphics Control Panel and navigate to "General Settings". Under "Scaling", check "Maintain Aspect Ratio".</p>
<p>If this does not fix your problem, go to "Custom Resolutions" and enter your own values under "Add". Click the '+' icon in the bottom right corner to add the resolution.
Use this resolution when playing Touhou. Alternatively, you can play in a window and use <a href='/faq#vpatch'>vpatch</a> to scale the window to your preferred size.</p>
<h4 id='vpatch'>vpatch</h4>
<p><strong>Warning:</strong> When using Windows 10, playing in windowed mode increases input lag.</p>
<p>Edit the <span class='code'>vpatch.ini</span> file in your game folder. If you want to get a fullscreen-like experience when playing windowed, set <span class='tt'>TitleBar</span>
to <span class='tt'>0</span> to hide the window title bar. Additionally, set <span class='tt'>AlwaysOnTop</span> to <span class='tt'>1</span> to make sure the Windows taskbar does
not obscure the bottom of your game. To change the window size, adjust the values for <span class='tt'>Width</span> and <span class='tt'>Height</span> to your liking.</p>
<p>To sum up, for a windowed game that works like fullscreen, make sure the following is set in your <span class='code'>vpatch.ini</span> file:</p>
<p>
    <span class='tt'>Width</span> = (Screen height / 3 * 4)<br>
    <span class='tt'>Height</span> = (Screen height)<br>
    <span class='tt'>TitleBar</span> = 0<br>
    <span class='tt'>AlwaysOnTop</span> = 1<br>
    <span class='tt'>Vsync</span> = 0<br>
</p>
<p>To center the game, set your <span class='tt'>X</span> value to half of the horizontal pixels left over on your screen. See below for some example values:</p>
<table>
    <tr>
        <th>Screen resolution</th>
        <th>X value</th>
    <tr>
        <td>1366x768</td>
        <td>170</td>
    </tr>
    <tr>
        <td>1600x900</td>
        <td>200</td>
    </tr>
    <tr>
        <td>1920x1080</td>
        <td>240</td>
    </tr>
    <tr>
        <td>2560x1440</td>
        <td>320</td>
    </tr>
    <tr>
        <td>3840x2160</td>
        <td>480</td>
    </tr>
</table>
<?php // language detection hack ?>
