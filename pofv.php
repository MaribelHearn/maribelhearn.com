<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

    <head>
		<title>Phantasmagoria of Flower View</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Portal for competitive PoFV play, featuring info about its metagame and tournaments and links to relevant resources.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, th9, th09, touhou 9, pofv, phantasmagoria of flower view, phantasmagoria, flower view, competitive, metagame, tiers, tier list, adonis'>
        <link rel='stylesheet' type='text/css' href='assets/pofv/pofv.css'>
		<link rel='icon' type='image/x-icon' href='assets/pofv/pofv.ico'>
        <script src='assets/shared/jquery.js' defer></script>
        <script src='assets/pofv/pofv.js' defer></script>
    </head>

    <body class='<?php echo check_webp() ?>'>
		<div id='nav' class='wrap'>
			<nav>
				<?php
					$nav = file_get_contents('nav.html');
					$page = str_replace('.php', '', basename(__FILE__));
					$nav = str_replace('<a href="' . $page . '">', '<strong>', $nav);
					$cap = strlen($page) < 4 ? strtoupper($page) : ucfirst($page);
					echo str_ireplace($page . '</a>', 'PoFV</strong>', $nav);
				?>
			</nav>
		</div>
        <div id='wrap' class='wrap'>
            <img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
            <h1>Phantasmagoria of Flower View</h1>
            <p>This is a portal for competitive PoFV play, featuring the current tier list, a guide to help you get started with
            netplay, and links to relevant resources as well as the rules of tournaments for the game, held at the
            <a href='https://discord.gg/2QPPPpE'><img src='assets/ext/discord-icon-small.ico' alt='Discord icon'>
            Phantasmagoria Netplay Discord server</a>.</p>
            <h2>Contents</h2>
            <div class='border'>
                <p><a href='#tiers'>Tier List</a></p>
                <p><a href='#guide'>Netplay Guide</a></p>
                <p><a href='#trouble'>Troubleshooting</a></p>
                <p><a href='#rules'>Tournament Rules</a></p>
                <p><a href='#links'>Useful Links</a></p>
				<p><a href='#ack'>Acknowledgements</a></p>
            </div>
            <h2 id='tiers'>Tier List</h2>
            <p>This tier list is an average of the opinions of competitive players in the English-speaking community.
            Click a character to see their stats and a brief description of their competitive use.</p>
            <noscript><p><em>Sorry, you cannot access the character info with JavaScript disabled as of now.</em></p></noscript>
            <table class='noborders'>
                <tr>
                    <th id='s' class='tier'>S</th>
                    <td class='noborders'>
                        <abbr title='Youmu Konpaku'><img class='char' src='assets/pofv/characters/youmu-cropped.png' alt='Youmu Konpaku'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Marisa Kirisame'><img class='char' src='assets/pofv/characters/marisa-cropped.png' alt='Marisa Kirisame'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Reimu Hakurei'><img class='char' src='assets/pofv/characters/reimu-cropped.png' alt='Reimu Hakurei'></abbr>
                    </td>
                    <td class='hidden'></td>
                </tr>
                <tr>
                    <th id='a' class='tier'>A</th>
                    <td class='noborders'>
                        <abbr title='Komachi Onozuka'><img class='char' src='assets/pofv/characters/komachi-cropped.png' alt='Komachi Onozuka'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Eiki Shiki Yamaxanadu'><img class='char' src='assets/pofv/characters/eiki-cropped.png' alt='Eiki Shiki Yamaxanadu'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Lyrica Prismriver'><img class='char' src='assets/pofv/characters/lyrica-cropped.png' alt='Lyrica Prismriver'></abbr>
                    </td>
                    <td class='hidden'></td>
                <tr>
                    <th id='b' class='tier'>B</th>
                    <td class='noborders'>
                        <abbr title='Medicine Melancholy'><img class='char' src='assets/pofv/characters/medicine-cropped.png' alt='Medicine Melancholy'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Yuuka Kazami'><img class='char' src='assets/pofv/characters/yuuka-cropped.png' alt='Yuuka Kazami'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Reisen Udongein Inaba'><img class='char' src='assets/pofv/characters/reisen-cropped.png' alt='Reisen Udongein Inaba'></abbr>
                    </td>
                    <td class='hidden'></td>
                </tr>
                <tr>
                    <th id='c' class='tier'>C</th>
                    <td class='noborders'>
                        <abbr title='Sakuya Izayoi'><img class='char' src='assets/pofv/characters/sakuya-cropped.png' alt='Sakuya Izayoi'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Lunasa Prismriver'><img class='char' src='assets/pofv/characters/lunasa-cropped.png' alt='Lunasa Prismriver'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Merlin Prismriver'><img class='char' src='assets/pofv/characters/merlin-cropped.png' alt='Merlin Prismriver'></abbr>
                    </td>
                    <td class='hidden'></td>
                </tr>
                <tr>
                    <th id='d' class='tier'>D</th>
                    <td class='noborders'>
                        <abbr title='Aya Shameimaru'><img class='char' src='assets/pofv/characters/aya-cropped.png' alt='Aya Shameimaru'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Mystia Lorelei'><img class='char' src='assets/pofv/characters/mystia-cropped.png' alt='Mystia Lorelei'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Cirno'><img class='char' src='assets/pofv/characters/cirno-cropped.png' alt='Cirno'></abbr>
                    </td>
                    <td class='noborders'>
                        <abbr title='Tewi Inaba'><img class='char' src='assets/pofv/characters/tewi-cropped.png' alt='Tewi Inaba'></abbr>
                    </td>
                </tr>
            </table>
            <h2 id='guide'>Netplay Guide</h2>
            <p>First of all, you need to use the following link to download and install a package of necessary netplay tools:</p>
            <p><a href='https://maribelhearn.com/PoFV-Adonis-VPatch-Goodies.zip' target='_blank'>PoFV-Adonis-VPatch-Goodies.zip</a></p>
            <p>After that, you want to extract all of the content of the <span class='code'>.zip</span> file to your PoFV game folder,
            i.e. the one that contains <span class='code'>th09.exe</span>. Your folder should look like this:</p>
            <img class='guide' src='assets/pofv/folder.png' alt='PoFV folder'>
            <p>Once everything has been extracted to the folder, you are ready to connect to whoever hosts at any time, using programs
            called <strong>Adonis</strong>, <strong>Adonise</strong> (English) and <strong>Adonis2</strong>.
            This is what it looks like in Adonis2, the current standard tool used by the PoFV netplay community:</p>
            <img class='guide' src='assets/pofv/connect.png' alt='Connection in Adonis2'>
            <p>To be able to host, you need to either <a href='https://portforward.com'>port forward</a> or use
            <a href='https://zerotier.com/download'><img src='assets/ext/zerotier-icon-small.png' alt='Zerotier favicon'> Zerotier</a>
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
                <img src='assets/ext/discord-icon-small.ico' alt='Discord icon'> Phantasmagoria Netplay Discord server</a>
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
            <p><a href='https://docs.google.com/document/d/1IHtZb8-LbbDEK526JR7u9_HykrwxTcDI/edit'><img src='assets/ext/docs-icon-small.png' alt='Google Docs favicon'> Fundamentals of PoFV Gameplay</a></p>
            <p><a href='https://docs.google.com/spreadsheets/d/1_MikJ3MH_H3L9czPUl5oGC5xmIVN8EH4t5yIfvoRE0o/edit?usp=sharing'><img src='assets/ext/spreadsheets-icon-small.png' alt='Google Spreadsheets favicon'> Tournament Archive</a></p>
            <p><a href='https://cerise.moe/pofv.html'><img src='assets/flags/france16x16.png' alt='Flag of France'> French Guide</a></p>
            <h2 id='ack'>Acknowledgements</h2>
            <p>The netplay guide and tournament rules were written by <a href='https://twitter.com/SnortNails'>Knirgesh</a>.</p>
            <p>The character descriptions were written by <a href='https://twitter.com/UndreamtBoss'>Zil</a>.</p>
            <p>The averaged tier list was done by <a href='https://twitter.com/homoiconicbully'>Lesbea</a>.</p>
            <p>The artworks used for this page are original work by <a href='https://twitter.com/korindo'>ZUN</a>.</p>
            <p>The background image was drawn by <a href='http://www.pixiv.net/member.php?id=21613'>Kong Xian</a>.</p>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
        </div>
        <div id='modal'>
            <div id='modal_inner'></div>
        </div>
        <script src='assets/shared/dark.js'></script>
    </body>

</html>
