<!DOCTYPE html>
<html lang='en'>
<?php
    include 'assets/shared/navbar.php';
    include 'assets/shared/count.php';
    hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

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
            <div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a></p>
                <img id='hy' src='assets/shared/h-bar.png' alt='Human-youkai gauge' title='Human Mode'>
                <h1>Maribel Hearn's Touhou Portal</h1>
                <p>A privacy-friendly collection of convenient webpages for the Touhou community.</p>
                <p id='desktop_hover'>Hover your cursor over a link for a description of that page. Flags show available translations.</p>
                <h2 id='page_links'>Page Links</h2>
                <div>
                    <div class='pages_left'>
                        <h3>Games</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='scoring'><img src='assets/scoring/scoring.ico' alt='Spell Card icon'> High Score Storage</a>
                                <span class='tooltip'>Allows you to save your Touhou game scores,
                                as well as calculate how they compare to the world records.</span>
                            </p>
                            <p class='link'>
                                <a href='survival'><img src='assets/survival/survival.ico' alt='1up Item icon'>
                                Survival Progress Table Generator</a>
                                <span class='tooltip'>Tool that lets you generate a table that
                                summarises your Touhou survival progress.</span>
                            </p>
                            <p class='link'>
                                <a href='drc'><img src='assets/drc/drc.ico' alt='Power icon'> Dodging Rain Competition</a>
                                <img src='assets/flags/japan16x16.png' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <span class='tooltip'>Webpage intended for use by
                                the Dodging Rain Competition (see page for explanation).</span>
                            </p>
                            <p class='link'>
                                <a href='tools'><img src='assets/tools/tools.ico' alt='UFO icon'>
                                Touhou Patches and Tools</a>
                                <span class='tooltip'>A collection of helpful patches and tools for
                                the Touhou shooting games, many of which for efficient practicing.</span>
                            </p>
                            <p class='link'>
                                <a href='wr'>
                                    <img src='assets/wr/wr.ico' alt='Point Item icon'> Touhou World Records
                                </a>
                                <img src='assets/flags/japan16x16.png' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <span class='tooltip'>The world records for all Touhou shooting games except for the scene games.</span>
                            </p>
                            <p class='link'>
                                <a href='lnn'><img src='assets/lnn/lnn.ico' alt='Full Power icon'>
                                Touhou Lunatic No Miss No Bombs</a>
                                <img src='assets/flags/japan16x16.png' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/china16x16.png' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <span class='tooltip'>Players who have done Lunatic No Miss No Bomb (LNN)
                                runs of the Touhou shooting games are listed here.</span>
                            </p>
                            <p class='link'>
                                <a href='jargon'><img src='assets/jargon/jargon.ico' alt='Bomb icon'> Touhou Community Jargon</a>
                                <span class='tooltip'>List of terminology used by the Touhou community,
                                including but not limited to common acronyms for Spell Cards.</span>
                            </p>
                            <p class='link'>
                                <a href='gensokyo'><img src='assets/gensokyo/gensokyo.ico' alt='Gensokyo.org icon'>
                                Gensokyo Replay Archive</a>
                                <span class='tooltip'>A complete archive of the replays from replays.gensokyo.org.</span>
                            </p>
                            <p class='link'>
                                <a href='pofv'><img src='assets/pofv/pofv.ico' alt='PoFV icon'> Phantasmagoria of Flower View</a>
                                <span class='tooltip'>Portal for competitive PoFV play, featuring info about its metagame and tournaments and links to relevant resources.</span>
                            </p>
                        </div>
                    </div>
                    <div class='pages_right'>
                        <h3>Other</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='thvote'><img src='assets/thvote/thvote.ico' alt='Tou kanji icon'>
                                THWiki Popularity Poll 2020 Results Translation</a>
                                <span class='tooltip'>Complete English translation of the full
                                results of the THWiki Popularity Poll held in 2020.</span>
                            </p>
                            <p class='link'>
                                <a href='tiers'><img src='assets/tiers/tiers.ico' alt='Japanese castle icon'>
                                Touhou Tier List Creator</a>
                                <span class='tooltip'>Custom Touhou tier lists can be created here,
                                both characters and official works.</span>
                            </p>
                            <p class='link'>
                                <a href='slots'><img src='assets/slots/slots.ico' alt='Heart icon'> Touhou Slot Machine</a>
                                <span class='tooltip'>Touhou randomizer based on Touhou Click and Drag Game,
                                with customisation options.</span>
                            </p>
                        </div>
                        <h3>Personal</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='history'><img src='assets/history/history.ico' alt='Maribel icon'>
                                Shmup Achievement History</a>
                                <span class='tooltip'>Documentation of my history as a shmup player.</span>
                            </p>
                            <p class='link'>
                                <a href='c67'><img src='assets/c67/c67.ico' alt='Banshiryuu icon'> Seihou Banshiryuu C67</a>
                                <span class='tooltip'>Explanation of scoring in Banshiryuu C67,
                                the earlier version of the third Seihou game.</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!--<h2 id='ext_links'>External Links</h2>
                <div>
                    <div class='pages_left'>
                        <h3>Touhou</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page'>
                                    <img src='assets/ext/thcrap-icon-small.ico' alt='Thpatch favicon'> Touhou Patch Center
                                </a>
                                <span class='tooltip'>Main page of the Touhou Patch Center, where the translation
                                patch and modding tool known as THCRAP is developed.</span>
                            </p>
                            <p class='link'>
                                <a href='http://replay.lunarcast.net'>
                                    <img src='assets/ext/lunarcast-icon.ico' alt='Lunarcast favicon'> Lunarcast Replay Database
                                </a>
                                <span class='tooltip'>Touhou replay uploader that is actively moderated and supports all official games.</span>
                            </p>
                            <p class='link'>
                                <a href='http://score.royalflare.net'>
                                    <img src='assets/ext/royalflare-icon.ico' alt='Royalflare favicon'> Royalflare Scoreboard
                                </a>
                                <span class='tooltip'>The primary Japanese Touhou replay uploader and scoreboard.</span>
                            </p>
                            <p class='link'>
                                <a href='https://thscore.pndsng.com/index.php'>
                                    <img src='assets/ext/pndsng-icon.ico' alt='Pndsng favicon'> Pndsng's Score List
                                </a>
                                <span class='tooltip'>Also known as the "PND List",
                                this page lists Touhou game high scores above a certain threshold.</span>
                            </p>
                            <p class='link'>
                                <a href='https://priw8.github.io'>
                                    <img src='assets/ext/priw8-icon.ico' alt='Priw8 favicon'> Priw8's Site
                                </a>
                                <span class='tooltip'>Touhou patching and modding website featuring an extensive ECL documentation as well
                                as offering downloads for
                                <a class='tooltip_link' href='https://twitter.com/Priweejt' target='_blank'>Priw8</a>'s
                                creations.</span>
                            </p>
                            <p class='link'>
                                <a href='https://exphp.github.io/thpages'>
                                    <img src='assets/ext/exphp-icon.ico' alt='ExpHP favicon'> ExpHP's Site
                                </a>
                                <span class='tooltip'>Website containing Touhou modding resources such as explanations on ANM scripting
                                and <a class='tooltip_link' href='https://github.com/ExpHP' target='_blank'>ExpHP</a>'s creations.</span>
                            </p>
                        </div>
                    </div>
                    <div class='pages_right'>
                        <h3>My Pages</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='https://www.youtube.com/c/MaribelHearn'>
                                    <img src='assets/ext/youtube-icon-small.png' alt='Youtube favicon'>YouTube
                                </a>
                            </p>
                            <p class='link'>
                                <a href='https://twitter.com/MaribelHearn42'>
                                    <img src='assets/ext/twitter-icon-small.png' alt='Twitter favicon'>Twitter
                                </a>
                            </p>
                            <p class='link'>
                                <a href='https://twitch.tv/maribel_hearn'>
                                    <img src='assets/ext/twitch-icon-small.ico' alt='Twitch favicon'>Twitch
                                </a>
                            </p>
                            <p class='link'>
                                <a href='https://steamcommunity.com/id/maribelhearn42'>
                                    <img src='assets/ext/steam-icon-small.ico' alt='Steam favicon'>Steam
                                </a>
                            </p>
                            <p class='link'>
                                <a href='https://github.com/MaribelHearn'>
                                    <img src='assets/ext/github-icon.ico' alt='GitHub favicon'>GitHub
                                </a>
                            </p>
                        </div>
                    </div>
                </div>-->
                <div id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</div>
                <div id='bottom'></div>
                <script src='assets/shared/dark.js'></script>
            </div>
        </main>
    </body>

</html>
