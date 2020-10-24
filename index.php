<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

    <head>
		<title>Maribel Hearn's Touhou Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='World records, Lunatic no miss no bombs and more. A collection of convenience webpages for the Touhou gaming community.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, wrs, world records, lnns, lunatic, popularity poll, tiers, tier list, sorter, creator, tools, practice, vpatch, spoileral, drc, dodging rain competition'>
        <link rel='stylesheet' type='text/css' href='assets/index/main.css'>
		<link rel='icon' type='image/x-icon' href='favicon.ico'>
    </head>

    <body class='<?php echo check_webp() ?>'>
		<nav>
    		<div id='nav' class='wrap'>
                <?php
                    $nav = file_get_contents('nav.html');
                    $nav = str_replace('<a href="/">', '<strong>', $nav);
                    echo str_ireplace('Index</a>', 'Index</strong>', $nav);
                ?>
    		</div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <span id='links'>
                <?php
                    if (isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents('.stats/token'))) {
                        echo '<a href="admin">Admin Panel</a> || ';
                    }
                ?>
                <a href='about'>About Me</a> || <a href='privacy'>Privacy Policy</a></span>
                <img id='hy' src='assets/shared/h-bar.png' alt='Human-youkai gauge' title='Human Mode'>
                <h1>Maribel Hearn's Touhou Portal</h1>
                <p id='intro'>A privacy-friendly collection of convenient webpages for the Touhou community.</p>
                <p>Hover your cursor over a link for a description of that page. Flags show available translations.</p>
                <h2>Page Links</h2>
                <div id='pages'>
                    <div id='pages_left'>
                        <h3>Games</h3>
                        <div class='page_table'>
                            <p><a href='scoring' title='Allows you to save your Touhou game scores, as well as calculate how they compare to the world records.'>
                                    <img src='assets/scoring/scoring.ico' alt='Spell Card icon'> High Score Storage</a>
                            </a></p>
                            <p><a href='survival' title='Tool that lets you generate a table that summarises your Touhou survival progress.'>
                                <img src='assets/survival/survival.ico' alt='1up Item icon'> Survival Progress Table Generator
                            </a></p>
                            <p>
                                <a href='drc' title='Webpage intended for use by the Dodging Rain Competition (see page for explanation).'>
                                    <img src='assets/drc/drc.ico' alt='Power icon'> Dodging Rain Competition
                                </a>
                                <img src='assets/flags/japan16x16.png' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                            </p>
                            <p><a href='tools' title='A collection of helpful patches and tools for the Touhou shooting games, many of which for efficient practicing.'>
                                <img src='assets/tools/tools.ico' alt='UFO icon'> Touhou Patches and Tools
                            </a></p>
                            <p>
                                <a href='wr' title='The world records for all Touhou shooting games except for the scene games.'>
                                    <img src='assets/wr/wr.ico' alt='Point Item icon'> Touhou World Records
                                </a>
                                <img src='assets/flags/japan16x16.png' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                            </p>
                            <p>
                                <a href='lnn' title='Players who have done Lunatic No Miss No Bomb (LNN) runs of the Touhou shooting games are listed here.'>
                                    <img src='assets/lnn/lnn.ico' alt='Full Power icon'> Touhou Lunatic No Miss No Bombs
                                </a>
                                <img src='assets/flags/japan16x16.png' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                            </p>
                            <p><a href='jargon' title='List of terminology used by the Touhou community, including but not limited to common acronyms for Spell Cards.'>
                                <img src='assets/jargon/jargon.ico' alt='Bomb icon'> Touhou Community Jargon
                            </a></p>
                            <p><a href='gensokyo' title='A complete archive of the replays from replays.gensokyo.org.'>
                                <img src='assets/gensokyo/gensokyo.ico' alt='Gensokyo.org icon'> Gensokyo Replay Archive
                            </a></p>
                            <p><a href='pofv' title='Portal for competitive PoFV play, featuring info about its metagame and tournaments and links to relevant resources.'>
                                <img src='assets/pofv/pofv.ico' alt='PoFV icon'> Phantasmagoria of Flower View
                            </a></p>
                        </div>
                    </div>
                    <div id='pages_right'>
                        <h3>Other</h3>
                        <div class='page_table'>
                            <p><a href='tiers' title='Custom Touhou tier lists can be created here, both characters and official works.'>
                                <img src='assets/tiers/tiers.ico' alt='Japanese castle icon'> Touhou Tier List Creator
                            </a></p>
                            <p><a href='thvote' title='Complete English translation of the full results of the THWiki Popularity Poll held in 2020.'>
                                <img src='assets/thvote/thvote.ico' alt='Tou kanji icon'> THWiki Popularity Poll 2020 Results Translation
                            </a></p>
                            <p><a href='slots' title='Touhou randomizer based on Touhou Click and Drag Game, with customisation options.'>
                                <img src='assets/slots/slots.ico' alt='Heart icon'> Touhou Slot Machine
                            </a></p>
                        </div>
                        <h3>Personal</h3>
                        <div class='page_table'>
                            <p><a href='history' title='Documentation of my history as a shmup player.'>
                                <img src='assets/history/history.ico' alt='Maribel icon'> Shmup Achievement History
                            </a></p>
                            <p><a href='c67' title='Explanation of scoring in Banshiryuu C67, the earlier version of the third Seihou game (unfinished).'>
                                <img src='assets/c67/c67.ico' alt='Banshiryuu icon'> Seihou Banshiryuu C67
                            </a></p>
                        </div>
                    </div>
                </div>
                <div>
        			<h2>External Links</h2>
        			<p class='wide'>Find me at: <a href='https://www.youtube.com/c/MaribelHearn'><img src='assets/ext/youtube-icon-small.png' alt='Youtube favicon'>YouTube</a>
        			<a href='https://twitter.com/MaribelHearn42'><img src='assets/ext/twitter-icon-small.png' alt='Twitter favicon'>Twitter</a>
                    <a href='https://twitch.tv/maribel_hearn'><img src='assets/ext/twitch-icon-small.ico' alt='Twitch favicon'>Twitch</a>
                    <a href='https://steamcommunity.com/id/maribelhearn42'><img src='assets/ext/steam-icon-small.ico' alt='Steam favicon'>Steam</a>
                    <a href='https://github.com/MaribelHearn'><img src='assets/ext/github-icon.ico' alt='GitHub favicon'>GitHub</a></p>
                    <p class='wide'>Partners: <a href='http://replay.lunarcast.net'><img src='assets/ext/favicon-lunarcast.ico' alt='Lunarcast favicon'>Lunarcast Replay Database</a></p>
                </div>
                <div>
                    <h2>Acknowledgements</h2>
                    <p class='wide'>The background image
        			was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</p>
                </div>
            </div>
        </main>
        <script src='assets/shared/dark.js'></script>
    </body>

</html>
