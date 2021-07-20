<!DOCTYPE html>
<html id='top' lang='<?php if (empty($_GET['hl'])) { echo 'en'; } else { echo $_GET['hl']; } ?>'>
<?php
    include 'assets/shared/shared.php';
    hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

    <head>
		<title>Phantasmagoria of Flower View</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Portal for competitive PoFV play, featuring info about its metagame and tournaments and links to relevant resources.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, th9, th09, touhou 9, pofv, phantasmagoria of flower view, phantasmagoria, flower view, competitive, metagame, tiers, tier list, adonis'>
        <link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=pofv'>
		<link rel='icon' type='image/x-icon' href='assets/pofv/pofv.ico'>
        <script src='assets/shared/js_concat.php?page=pofv' defer></script>
    </head>

    <body>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
    	            <div id='topbar'>
    					<p id='ack'><?php
							if ($lang == 'Chinese') {
                                echo '背景画师：' .
    							'<a href="https://www.pixiv.net/member.php?id=21613">Kong Xian</a>';
                            } else {
                                echo 'This background image <br id="ack_br">was drawn by ' .
							    '<a href="https://www.pixiv.net/member.php?id=21613">Kong Xian</a>';
                            }
    					?></p>
    					<span id='hy_container'>
    	                    <span id='hy'></span>
    				        <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
    	                </span>
    					<div id='languages'>
    	                    <a id='en' class='flag' href='pofv?hl=en'>
    	                        <img class='flag_en' src='assets/flags/uk.png' alt='<?php echo 'Flag of the United Kingdom' ?>'>
    	                        <p class='language'>English</p>
    	                    </a>
    	                    <a id='zh' class='flag' href='pofv?hl=zh'>
    	                        <img src='assets/flags/china.png' alt='<?php echo 'Flag of the P.R.C.' ?>'>
    	                        <p class='language'>简体中文</p>
    	                    </a>
    		            </div>
    				</div>
                <h1>Phantasmagoria of Flower View</h1>
    			<?php
    				if (!empty($_GET['redirect'])) {
    					echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
    				}
    			?>
                <p>This is a portal for competitive PoFV play, featuring the current tier list, a guide to help you get started with
                netplay, and links to relevant resources as well as the rules of tournaments for the game, held at the
                <a id='discord' href='https://discord.gg/2QPPPpE'>
                    <span class='icon discord_icon'></span>
                    Phantasmagoria Netplay Discord server
                </a>.</p>
                <h2>Contents</h2>
                <div class='border'>
                    <p><a href='#tiers'>Tier List</a></p>
                    <p><a href='#guide'>Netplay Guide</a></p>
                    <p><a href='#trouble'>Troubleshooting</a></p>
                    <p><a href='#rules'>Tournament Rules</a></p>
                    <p><a href='#links'>Useful Links</a></p>
    				<p><a href='#acks'>Acknowledgements</a></p>
                </div>
                <h2 id='tiers'>Tier List</h2>
                <p>This tier list is an average of the opinions of competitive players in the English-speaking community.
                Click a character to see their stats and a brief description of their competitive use.</p>
                <noscript><p><em>Sorry, you cannot access the character info with JavaScript disabled as of now.</em></p></noscript>
                <table class='noborders'>
                    <tr>
                        <th id='s' class='tier'>S</th>
                        <td class='noborders'>
                            <span id='marisa' class='char' title='Marisa Kirisame'>
                        </td>
                        <td class='noborders'>
                            <span id='reimu' class='char' title='Reimu Hakurei'>
                        </td>
                        <td class='noborders'>
                            <span id='youmu' class='char' title='Youmu Konpaku'>
                        </td>
                        <td class='hidden'></td>
                    </tr>
                    <tr>
                        <th id='a' class='tier'>A</th>
                        <td class='noborders'>
                            <span id='komachi' class='char' title='Komachi Onozuka'>
                        </td>
                        <td class='noborders'>
                            <span id='eiki' class='char' title='Eiki Shiki Yamaxanadu'>
                        </td>
                        <td class='hidden'></td>
                    <tr>
                        <th id='b' class='tier'>B</th>
                        <td class='noborders'>
                            <span id='lyrica' class='char' title='Lyrica Prismriver'>
                        </td>
                        <td class='noborders'>
                            <span id='medicine' class='char' title='Medicine Melancholy'>
                        </td>
                        <td class='noborders'>
                            <span id='reisen' class='char' title='Reisen Udongein Inaba'>
                        </td>
                        <td class='hidden'></td>
                    </tr>
                    <tr>
                        <th id='c' class='tier'>C</th>
                        <td class='noborders'>
                            <span id='merlin' class='char' title='Merlin Prismriver'>
                        </td>
                        <td class='noborders'>
                            <span id='lunasa' class='char' title='Lunasa Prismriver'>
                        </td>
                        <td class='hidden'></td>
                    </tr>
                    <tr>
                        <th id='d' class='tier'>D</th>
                        <td class='noborders'>
                            <span id='yuuka' class='char' title='Yuuka Kazami'>
                        </td>
                        <td class='noborders'>
                            <span id='sakuya' class='char' title='Sakuya Izayoi'>
                        </td>
                        <td class='noborders'>
                            <span id='aya' class='char' title='Aya Shameimaru'>
                        </td>
                    </tr>
                    <tr>
                        <th id='e' class='tier'>E</th>
                        <td class='noborders'>
                            <span id='tewi' class='char' title='Tewi Inaba'>
                        </td>
                        <td class='noborders'>
                            <span id='mystia' class='char' title='Mystia Lorelei'>
                        </td>
                        <td class='noborders'>
                            <span id='cirno' class='char' title='Cirno'>
                        </td>
                    </tr>
                </table>
                <h2 id='guide'>Netplay Guide</h2>
                <p>First of all, you need to use the following link to download and install a package of necessary netplay tools:</p>
                <p><a href='https://maribelhearn.com/mirror/PoFV-Adonis-VPatch-Goodies.zip' target='_blank'>PoFV-Adonis-VPatch-Goodies.zip</a></p>
                <p>After that, you want to extract all of the content of the <span class='code'>.zip</span> file to your PoFV game folder,
                i.e. the one that contains <span class='code'>th09.exe</span>. Your folder should look like this:</p>
                <img class='guide' src='assets/pofv/folder.png' alt='PoFV folder'>
                <p>Once everything has been extracted to the folder, you are ready to connect to whoever hosts at any time, using programs
                called <strong>Adonis</strong>, <strong>Adonise</strong> (English) and <strong>Adonis2</strong>.
                This is what it looks like in Adonis2, the current standard tool used by the PoFV netplay community:</p>
                <img class='guide' src='assets/pofv/connect.png' alt='Connection in Adonis2'>
                <p>To be able to host, you need to either <a href='https://portforward.com'>port forward</a> or use
                <a href='https://zerotier.com/download'>
                    <span class='icon zerotier_icon'></span> Zerotier
                </a>
                (Hamachi works as well, but is not used but the PoFV netplay community). This is what it looks like in Adonis2:</p>
                <img class='guide' src='assets/pofv/host.png' alt='Hosting in Adonis2'>
                <h2 id='trouble'>Troubleshooting</h2>
                <p><strong>Adonis crashes while trying to connect to someone.</strong></p>
                <p>This means that you couldn’t connect to the host. If this happens, make sure that the host has port forwarded or
                is currently hosting via Hamachi or Zerotier.</p>
                <p><em>=&gt; The host is hosting via Zerotier.</em></p>
                <p>Make sure that you both have connected to someone already a part of the network first and then try again.
                For Zerotier to work, everyone needs to have some sort of connection to the host of the network.</p>
                <p><em>=&gt; The host has port forwarded or is 100% sure that Zerotier is working.</em></p>
                <p>Try to host by yourself and play in either compatibility mode or as an Administrator.</p>
                <p><em>=&gt; None of the above is working.</em></p>
                <p>Go into your firewall and click advanced settings and then inbound rules and
                make sure the rules for Adonis and th09 is enabled. If you are using Zerotier make sure that is enabled as well.
                (both host and person connecting needs to do this)</p>
                <img class='guide' src='assets/pofv/properties.png' alt='Windows Firewall properties'>
                <p><strong>The game crashes after successfully connecting to someone.</strong></p>
                <p>Try launching the game in either compatibility mode or as an Administrator.</p>
                <p><em>=&gt; It still doesn’t work with the solution above.</em></p>
                <p>Your Adonis might be broken. Try joining the Phantasmagoria Netplay Discord server and
                ask for someone else's files.</p>
                <h2 id='rules'>Tournament Rules</h2>
                <ol>
                    <li>Players must be in the <a href='https://discord.gg/2QPPPpE'>
                    <span class='icon discord_icon'></span> Phantasmagoria Netplay Discord server</a>
                    in order to submit replays and receive important communications about the tournament.</li>
                    <li>Participants will use the <strong>Adonis 2</strong> netplay tool, and will need a stable connection.
                    Players will need port forwarding set up or ZeroTier installed to ensure
                    they can play against other participants. Adonis 1 can be used instead if both players agree.</li>
                    <li>Replay auto-save must be enabled in Adonis 2. After a match, zip the replay files into a single archive and
                    send them to the organizer over Discord as soon as possible, via the
                    <span class='code'>#replay-submissions</span> channel.
                    These will be used for the stream, and shared afterwards as a tournament archive.
                    Please use the format "&lt;match number&gt; &lt;left player&gt; vs &lt;right player&gt;" for archive names.
                    Match number is from the bracket on Challonge. For example, if ZUN hosted a game against pbg, and
                    this was match #9 as listed on the bracket, afterwards it should be submitted as
                    <span class='code'>9 ZUN vs pbg.zip</span> to the <span class='code'>#replay-submissions</span> channel.
                    This makes it much easier for the streamer to keep track of everything.</li>
                    <li>All matches will be played as best of 3, until the Finals which will be played as best of 5.
                    (Finals includes Winners' Final, Losers' Final, and Grand Finals.)</li>
                    <li>All matches will be played on Lunatic difficulty to speed up sets.</li>
                    <li>All characters are allowed, but you must stay on your pick
                    if you win a game while the loser may change if desired.</li>
                    <li>The chosen stage for every set is Misty Lake, due to possible frame drops on other stages and bullet visibility,
                    especially for those that are color blind.</li>
                    <li>Test rounds are allowed. Checking for desyncs at round start by hugging the middle is recommended,
                    but not mandatory.</li>
                    <li>The host will always be player one, unless both participants agree otherwise.</li>
                    <li>Please use a random number generator for who picks their character first
                    if counterpicking becomes a problem on the first game.</li>
                    <li>Any form of smurfing or using alternate accounts will result in a ban for the next tournament.
                    This disrupts seeding, both for the current tournament and future ones, and causes inaccurate results.</li>
                </ol>
                <h2 id='links'>Useful Links</h2>
                <p><a href='https://docs.google.com/document/d/1IHtZb8-LbbDEK526JR7u9_HykrwxTcDI/edit'>
                    <span class='icon docs_icon'></span> Fundamentals of PoFV Gameplay
                </a></p>
                <p><a href='https://docs.google.com/spreadsheets/d/1_MikJ3MH_H3L9czPUl5oGC5xmIVN8EH4t5yIfvoRE0o/edit?usp=sharing'>
                    <span class='icon sheets_icon'></span> Tournament Archive</a>
                </p>
                <p><a href='https://cerise.moe/pofv.html'>
                    <img src='assets/flags/france16x16.png' alt='Flag of France'> French Guide
                </a></p>
                <h2 id='acks'>Acknowledgements</h2>
                <p>The netplay guide and tournament rules were written by <a href='https://twitter.com/SnortNails'>Knirgesh</a>.</p>
                <p>The character descriptions were written by <a href='https://twitter.com/UndreamtBoss'>Zil</a>.</p>
                <p>The averaged tier list was done by <a href='https://twitter.com/homoiconicbully'>Lesbea</a>.</p>
                <p>The artworks used for this page are original work by <a href='https://twitter.com/korindo'>ZUN</a>.</p>
                <p id='ack_mobile'><?php
                    if ($lang == 'Chinese') {
                        echo '背景画师：' .
                        '<a href="https://www.pixiv.net/member.php?id=21613">Kong Xian</a>。';
                    } else {
                        echo 'The background image was drawn by ' .
                        '<a href="https://www.pixiv.net/member.php?id=21613">Kong Xian</a>.';
                    }
                ?></p>
                <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
            </div>
            <div id='modal'>
                <div id='modal_inner'></div>
            </div>
        </main>
    </body>

</html>
