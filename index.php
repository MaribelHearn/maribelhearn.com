<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

    <head>
		<title>Maribel Hearn's Web Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='World records, Lunatic no miss no bombs and more. A collection of convenience webpages for the Touhou gaming community.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, wrs, world records, lnns, lunatic, popularity poll, tiers, tier list, sorter, creator, tools, practice, vpatch, spoileral, drc, dodging rain competition'>
        <link rel='stylesheet' type='text/css' href='assets/index/main.css'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&display=swap'>
		<link rel='icon' type='image/x-icon' href='favicon.ico'>
    </head>

    <body class='<?php echo check_webp() ?>'>
        <div id='wrap'>
            <a id='privacy' href='privacy'>Privacy Policy</a>
            <img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
            <h1>Maribel Hearn's Web Portal</h1>
            <p class='thin'>A collection of convenience webpages for the Touhou community.</p>
            <h2>Page Links</h2>
            <div class='center'>
                <div class='left'>
                    <p><a href='scoring'><img src='assets/scoring/scoring.ico' alt='Spell Card icon'> High Score Storage</a></p>
                    <p><em>Allows you to save your Touhou game scores, as well as calculate how they compare to the world records.</em></p>
                </div>
                <div class='right'>
                    <p><a href='survival'><img src='assets/survival/survival.ico' alt='1up Item icon'> Survival Progress Table Generator</a></p>
                    <p><em>Tool that lets you generate a table that summarises your Touhou survival progress.</em></p>
                </div>
            </div>
            <div class='center'>
                <div class='left'>
                    <p>
                        <a href='drc'><img src='assets/drc/drc.ico' alt='Power icon'> Dodging Rain Competition</a>
                        <picture>
                            <source srcset='assets/flags/japan16x16.webp' type='image/webp'>
                            <source srcset='assets/flags/japan16x16.png'>
                            <img src='assets/flags/japan16x16.png' alt='Flag of Japan'>
                        </picture>
                        <picture>
                            <source srcset='assets/flags/china16x16.webp' type='image/webp'>
                            <source srcset='assets/flags/china16x16.png'>
                            <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.'>
                        </picture>
                    </p>
                    <p><em>Webpage intended for use by the Dodging Rain Competition (see page for explanation).</em></p>
                </div>
                <div class='right'>
                    <p><a href='tools'><img src='assets/tools/tools.ico' alt='UFO icon'> Touhou Patches and Tools</a></p>
                    <p><em>A collection of helpful patches and tools for the Touhou shooting games, many of which for efficient practicing.</em></p>
                </div>
            </div>
            <div class='center'>
                <div class='left'>
                    <p>
                        <a href='wr'><img src='assets/wr/wr.ico' alt='Point Item icon'> Touhou World Records</a>
                        <picture>
                            <source srcset='assets/flags/japan16x16.webp' type='image/webp'>
                            <source srcset='assets/flags/japan16x16.png'>
                            <img src='assets/flags/japan16x16.png' alt='Flag of Japan'>
                        </picture>
                        <picture>
                            <source srcset='assets/flags/china16x16.webp' type='image/webp'>
                            <source srcset='assets/flags/china16x16.png'>
                            <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.'>
                        </picture>
                    </p>
                    <p><em>The world records for all Touhou shooting games except for the scene games.</em></p>
                </div>
                <div class='right'>
                    <p>
                        <a href='lnn'><img src='assets/lnn/lnn.ico' alt='Full Power icon'> Touhou Lunatic No Miss No Bombs</a>
                        <picture>
                            <source srcset='assets/flags/japan16x16.webp' type='image/webp'>
                            <source srcset='assets/flags/japan16x16.png'>
                            <img src='assets/flags/japan16x16.png' alt='Flag of Japan'>
                        </picture>
                        <picture>
                            <source srcset='assets/flags/china16x16.webp' type='image/webp'>
                            <source srcset='assets/flags/china16x16.png'>
                            <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.'>
                        </picture>
                    </p>
                    <p><em>Players who have done Lunatic No Miss No Bomb (LNN) runs of the Touhou shooting games are listed here.</em></p>
                </div>
            </div>
            <div class='center'>
                <div class='left'>
                    <p><a href='thvote'><img src='assets/thvote/thvote.ico' alt='Tou kanji icon'> THWiki Popularity Poll 2020 Results Translation</a></p>
                    <p><em>Complete English translation of the full results of the THWiki Popularity Poll held in 2020.</em></p>
                </div>
                <div class='right'>
                    <p><a href='jargon'><img src='assets/jargon/jargon.ico' alt='Bomb icon'> Touhou Community Jargon</a></p>
                    <p><em>List of terminology used by the Touhou community, including but not limited to common acronyms for Spell Cards.</em></p>
                </div>
            </div>
            <div class='center'>
                <div class='left'>
                    <p><a href='trs'><img src='assets/trs/trs.ico' alt='Shinto shrine icon'> Touhou Replay Showcase</a></p>
                    <p><em>(U.C.) Submit your replays, read the schedules, and watch the Touhou Replay Showcase Twitch streams.</em></p>
                </div>
                <div class='right'>
                    <p><a href='tiers'><img src='assets/tiers/tiers.ico' alt='Japanese castle icon'> Touhou Tier List Creator</a></p>
                    <p><em>Custom Touhou tier lists can be created here, both characters and official works.</em><p>
                </div>
            </div>
            <div class='center'>
                <div class='left'>
                    <p><a href='gensokyo'><img src='assets/gensokyo/gensokyo.ico' alt='Gensokyo.org icon'> Gensokyo Replay Archive</a></p>
                    <p><em>A complete archive of the replays from replays.gensokyo.org.</em></p>
                </div>
                <div class='right'>
                    <p><a href='pofv'><img src='assets/pofv/pofv.ico' alt='PoFV icon'> Phantasmagoria of Flower View</a></p>
                    <p><em>Portal for competitive PoFV play, featuring info about its metagame and tournaments and links to relevant resources.</em></p>
                </div>
            </div>
            <hr>
            <div class='center'>
                <div class='left'>
                    <p><a href='history'><img src='assets/history/history.ico' alt='Maribel icon'> Shmup Achievement History</a></p>
                    <p><em>Documentation of my history as a shmup player.</em></p>
                </div>
                <div class='right'>
                    <p><a href='c67'><img src='assets/c67/c67.ico' alt='Banshiryuu icon'> Seihou Banshiryuu C67</a></p>
                    <p><em>Explanation of scoring in Banshiryuu C67, the earlier version of the third Seihou game (unfinished).</em></p>
                </div>
            </div>
            <div>
    			<h2>External Links</h2>
    			<p class='wide'>Find me at: <a href='https://www.youtube.com/c/MaribelHearn'><img src='ext/youtube-icon-small.png' alt='Youtube favicon'>YouTube</a>
    			<a href='https://twitter.com/MaribelHearn42'><img src='ext/twitter-icon-small.png' alt='Twitter favicon'>Twitter</a>
                <a href='https://twitch.tv/maribel_hearn'><img src='ext/twitch-icon-small.ico' alt='Twitch favicon'>Twitch</a>
                <a href='https://steamcommunity.com/id/maribelhearn42'><img src='ext/steam-icon-small.ico' alt='Steam favicon'>Steam</a>
                <a href='https://github.com/MaribelHearn'><img src='ext/github-icon.ico' alt='GitHub favicon'>GitHub</a></p>
                <?php
                    if (isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents('.stats/token'))) {
                        echo '<a id="admin" href="admin">Admin Panel</a>';
                    }
                ?>
                <p class='wide'>Partners: <a href='http://replay.lunarcast.net'><img src='ext/favicon-lunarcast.ico' alt='Lunarcast favicon'>Lunarcast Replay Database</a></p>
            </div>
        </div>
        <script src='assets/shared/dark.js'></script>
    </body>

</html>
