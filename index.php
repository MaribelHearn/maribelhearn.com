<!DOCTYPE html>
<html lang='en'>
<?php
    include 'assets/shared/shared.php';
    hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

    <head>
		<title>Maribel Hearn's Touhou Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='World records, Lunatic no miss no bombs and more. A collection of convenience webpages for the Touhou gaming community.'>
        <meta name='keywords' content='touhou, touhou project, 東方, 东方, wrs, world records, lnns, lunatic, popularity poll, tiers, tier list, sorter, creator, tools, practice, vpatch, spoileral, drc, dodging rain competition'>
        <link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=index'>
		<link rel='icon' type='image/x-icon' href='favicon.ico'>
        <script src='assets/shared/js_concat.php?page=index' defer></script>
    </head>

    <body>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a></p>
                <span id='hy_container'><span id='hy'></span>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1>Maribel Hearn's Touhou Portal</h1>
                <p>A privacy-friendly collection of convenient webpages for the Touhou community.</p>
                <p id='desktop_hover'>Hover your cursor over a link for a description of that page. Flags show available translations.</p>
                <h2 id='page_links'>Page Links</h2>
                <div>
                    <div class='pages_left'>
                        <h3>Games</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='scoring'><span class='icon scoring_icon'></span>
                                High Score Storage</a>
                                <span class='tooltip'>Allows you to save your Touhou game scores,
                                as well as calculate how they compare to the world records.</span>
                            </p>
                            <p class='link'>
                                <a href='survival'><span class='icon survival_icon'></span>
                                Survival Progress Table Generator</a>
                                <span class='tooltip'>Tool that lets you generate a table that
                                summarises your Touhou survival progress.</span>
                            </p>
                            <p class='link'>
                                <a href='drc'><span class='icon drc_icon'></span>
                                Dodging Rain Competition</a>
                                <img src='assets/flags/jp16x16.png' width='16' height='16' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/cn16x16.png' width='16' height='16' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <span class='tooltip'>Webpage intended for use by
                                the Dodging Rain Competition (see page for explanation).</span>
                            </p>
                            <p class='link'>
                                <a href='tools'><span class='icon tools_icon'></span>
                                Touhou Patches and Tools</a>
                                <img src='assets/flags/jp16x16.png' width='16' height='16' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/ru16x16.png' width='16' height='16' alt='Flag of Russia' title='Russian'>
                                <span class='tooltip'>A collection of helpful patches and tools for
                                the Touhou shooting games, many of which for efficient practicing.</span>
                            </p>
                            <p class='link'>
                                <a href='wr'><span class='icon wr_icon'></span>
                                Touhou World Records</a>
                                <img src='assets/flags/jp16x16.png' width='16' height='16' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/cn16x16.png' width='16' height='16' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <img src='assets/flags/ru16x16.png' width='16' height='16' alt='Flag of Russia' title='Russian'>
                                <span class='tooltip'>The world records for all Touhou shooting games except for the scene games.</span>
                            </p>
                            <p class='link'>
                                <a href='lnn'><span class='icon lnn_icon'></span>
                                Touhou Lunatic No Miss No Bombs</a>
                                <img src='assets/flags/jp16x16.png' width='16' height='16' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/cn16x16.png' width='16' height='16' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <img src='assets/flags/ru16x16.png' width='16' height='16' alt='Flag of Russia' title='Russian'>
                                <span class='tooltip'>Players who have done Lunatic No Miss No Bomb (LNN)
                                runs of the Touhou shooting games are listed here.</span>
                            </p>
                            <p class='link'>
                                <a href='jargon'><span class='icon jargon_icon'></span> Touhou Community Jargon</a>
                                <span class='tooltip'>List of terminology used by the Touhou community,
                                including but not limited to common acronyms for Spell Cards.</span>
                            </p>
                            <p class='link'>
                                <a href='trs'><span class='icon trs_icon'></span>
                                Touhou Replay Showcase</a>
                                <span class='tooltip'>Read about the weekly Touhou Replay Showcase Twitch streams.</span>
                            </p>
                            <p class='link'>
                                <a href='gensokyo'><span class='icon gensokyo_icon'></span>
                                Gensokyo Replay Archive</a>
                                <span class='tooltip'>A complete archive of the replays from replays.gensokyo.org.</span>
                            </p>
                            <p class='link'>
                                <a href='pofv'><span class='icon pofv_icon'></span>
                                Phantasmagoria of Flower View</a>
                                <img src='assets/flags/cn16x16.png' width='16' height='16' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <span class='tooltip'>Portal for competitive PoFV play, featuring info about its metagame and tournaments and links to relevant resources.</span>
                            </p>
                            <p class='link'>
                                <a href='twc'><span class='icon twc_icon'></span>
                                Touhou World Cup</a>
                                <img src='assets/flags/jp16x16.png' width='16' height='16' alt='Flag of Japan' title='Japanese'>
                                <img src='assets/flags/cn16x16.png' width='16' height='16' alt='Flag of the P.R.C.' title='Chinese (Simplified)'>
                                <img src='assets/flags/ru16x16.png' width='16' height='16' alt='Flag of Russia' title='Russian'>
                                <span class='tooltip'>Main webpage for Touhou World Cup, containing the schedule, rules and other relevant information.</span>
                            </p>
                            <p class='link'>
                                <a href='fangame'><span class='icon fangame_icon'></span>
                                Fangame Accomplishments</a>
                                <span class='tooltip'>Notable accomplishments in Touhou fangames and Touhou-related games, including both LNNs and score runs.</span>
                            </p>
                        </div>
                    </div>
                    <div class='pages_right'>
                        <h3>Other</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='thvote'><span class='icon thvote_icon'></span>
                                THWiki Popularity Poll 2020 Results Translation</a>
                                <span class='tooltip'>Complete English translation of the full
                                results of the THWiki Popularity Poll held in 2020.</span>
                            </p>
                            <p class='link'>
                                <a href='tiers'><span class='icon tiers_icon'></span>
                                Touhou Tier List Creator</a>
                                <span class='tooltip'>Custom Touhou tier lists can be created here,
                                both characters and official works.</span>
                            </p>
                            <p class='link'>
                                <a href='slots'><span class='icon slots_icon'></span> Touhou Slot Machine</a>
                                <span class='tooltip'>Touhou randomizer based on Touhou Click and Drag Game,
                                with customisation options.</span>
                            </p>
                        </div>
                        <h3>Personal</h3>
                        <div class='page_table'>
                            <p class='link'>
                                <a href='history'><span class='icon history_icon'></span>
                                Shmup Achievement History</a>
                                <span class='tooltip'>Documentation of my history as a shmup player.</span>
                            </p>
                            <p class='link'>
                                <a href='c67'><span class='icon c67_icon'></span> Seihou Banshiryuu C67</a>
                                <span class='tooltip'>Explanation of scoring in Banshiryuu C67,
                                the earlier version of the third Seihou game.</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</div>
                <div id='bottom'>
                    <p id='last_modified'>Last updated at <?php echo date('Y-m-d H:i:s', filemtime('.git/FETCH_HEAD')) . ' ' . date('T') ?></p>
                </div>
            </div>
        </main>
    </body>

</html>
