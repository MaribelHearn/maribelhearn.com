<!DOCTYPE html>
<html lang='en'>
<?php include '.stats/count.php'; hit(basename(__FILE__)); ?>

    <head>
		<title>Touhou Replay Showcase</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Submit to the Touhou Replay Showcase Twitch stream, see the schedule, and watch it live.'>
        <meta name='keywords' content='touhou, touhou project, replay, showcase, trs, twitch, stream, submit, submitting, submission, schedule, schedules'>
		<link rel='stylesheet' type='text/css' href='assets/trs/trs.css'>
		<link rel='icon' type='image/x-icon' href='assets/trs/trs.ico'>
        <script src='assets/trs/trs.js' defer></script>
    </head>

    <body class='<?php echo check_webp() ?>'>
		<div id='nav' class='wrap'>
			<nav>
                <?php
                    $nav = file_get_contents('nav.html');
                    $page = str_replace('.php', '', basename(__FILE__));
                    $nav = str_replace('<a href="' . $page . '">', '<strong>', $nav);
                    $cap = strlen($page) < 4 ? strtoupper($page) : ucfirst($page);
                    echo str_ireplace($page . '</a>', $cap . '</strong>', $nav);
                ?>
			</nav>
		</div>
        <div id='wrap' class='wrap'>
            <img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
            <h1>Touhou Replay Showcase</h1>
            <?php
                if (!empty($_GET['redirect'])) {
                    echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
                }
            ?>
            <p>This page allows you to watch the <a href='https://twitch.tv/touhou_replay_showcase'><img src='assets/ext/twitch-icon-small.ico' alt='Twitch favicon'> Touhou
            Replay Showcase</a> stream, read the current schedule, and submit a replay for it.</p>
            <div id='twitch-embed'></div>
            <input id='watch' type='button' value='Click here to watch the stream'>
            <h2>Current Schedule</h2>
            <p>Schedule pending.</p>
            <h2>Submit Your Replay</h2>
            <form id='submission' method='POST' action='submit.php' enctype='multipart/form-data'>
                <!-- Player name -->
                <label for='player' class='section'>Player name <span class='required'>*</span></label>
                <input id='player' type='text' name='player' maxlength='50' required>
                <!-- Game -->
                <label for='game' class='section'>Game <span class='required'>*</span></label>
                <select id='game' name='game' required>
                    <option value='HRtP'>1. HRtP</p>
                    <option value='SoEW'>2. SoEW</p>
                    <option value='PoDD'>3. PoDD</p>
                    <option value='LLS'>4. LLS</p>
                    <option value='MS'>5. MS</p>
                    <option value='EoSD'>6. EoSD</p>
                    <option value='PCB'>7. PCB</p>
                    <option value='IN'>8. IN</p>
                    <option value='PoFV'>9. PoFV</p>
                    <option value='StB'>9.5. StB</p>
                    <option value='MoF'>10. MoF</p>
                    <option value='SA'>11. SA</p>
                    <option value='UFO'>12. UFO</p>
                    <option value='DS'>12.5. DS</p>
                    <option value='GFW'>12.8. GFW</p>
                    <option value='TD'>13. TD</p>
                    <option value='DDC'>14. DDC</p>
                    <option value='ISC'>14.3. ISC</p>
                    <option value='LoLK'>15. LoLK</p>
                    <option value='HSiFS'>16. HSiFS</p>
                    <option value='VD'>16.5. VD</p>
                    <option value='WBaWC'>17. WBaWC</p>
                    <option value='Other'> Other</option>
                </select>
                <!-- Replay -->
                <label for='replay' class='section'>Replay <span class='required'>*</span></label>
                <input id='replay' type='file' name='replay' required>
                <!-- Difficulty -->
                <label for='difficulty' class='section'>Difficulty</label>
                <span class='input'>
                    <input id='difficulty' type='radio' name='difficulty' value='Easy'> Easy
                </span>
                <span class='input'>
                    <input id='difficulty_normal' type='radio' name='difficulty' value='Normal'>
                    <label for='difficulty_normal'>Normal</label>
                </span>
                <span class='input'>
                    <input id='difficulty_hard' type='radio' name='difficulty' value='Hard'>
                    <label for='difficulty_hard'>Hard</label>
                </span>
                <span class='input'>
                    <input id='difficulty_lunatic' type='radio' name='difficulty' value='Lunatic'>
                    <label for='difficulty_lunatic'>Lunatic</label>
                </span>
                <span class='input'>
                    <input id='difficulty_extra' type='radio' name='difficulty' value='Extra'>
                    <label for='difficulty_extra'>Extra</label>
                </span>
                <span class='input'>
                    <input id='difficulty_phantasm' type='radio' name='difficulty' value='Phantasm'>
                    <label for='difficulty_phantasm'>Phantasm</label>
                </span>
                <span class='input'>
                    <input id='difficulty_other' type='radio' name='difficulty' value='Other'>
                    <label for='difficulty_other'>Other</label>
                </span>
                <!-- Shottype -->
                <label for='shottype' class='section'>Shottype <span class='required'>*</span></label>
                <input id='shottype' type='text' name='shottype' required>
                <!-- Type of run -->
                <label for='type' class='section'>Type of run <span class='required'>*</span></label>
                <span class='input'>
                    <input id='type' type='radio' name='type' value='1cc' required> 1cc
                </span>
                <span class='input'>
                    <input id='scorerun' type='radio' name='type' value='Scoring' required>
                    <label for='scorerun'>Score Run</label>
                </span>
                <span class='input'>
                    <input id='nb' type='radio' name='type' value='NB' required>
                    <label for='nb'>No Bomb (NB)</label>
                </span>
                <span class='input'>
                    <input id='nm' type='radio' name='type' value='NM' required>
                    <label for='nm'>No Miss (NM)</label>
                </span>
                <span class='input'>
                    <input id='nmnb' type='radio' name='type' value='NMNB' required>
                    <label for='nmnb'>No Miss No Bomb (NMNB)</label>
                </span>
                <span class='input'>
                    <input id='nbx' type='radio' name='type' value='NB+' required>
                    <label for='nbx'>No Bomb + Extra Restriction(s) (NBN*)</label>
                </span>
                <span class='input'>
                    <input id='nmnbx' type='radio' name='type' value='NMNB+' required>
                    <label for='nmnbx'>No Miss No Bomb + Extra Restriction(s) (NMNBN*)</label>
                </span>
                <span class='input'>
                    <input id='type_other' type='radio' name='type' value='Other' required>
                    <label for='type_other'>Other</label>
                </span>
                <!-- Early or late preference -->
                <h3 id='preference'>Preference for earlier or later in the stream</h3>
                <span class='input'>
                    <input id='early' type='radio' name='preference' value='Early'>
                    <label for='early'>Early</label>
                </span>
                <span class='input'>
                    <input id='late' type='radio' name='preference' value='Late'>
                    <label for='late'>Late</label>
                </span>
                <span class='input'>
                    <input id='na' type='radio' name='preference' value=''>
                    <label for='na'>N/A</label>
                </span>
                <h3 id='parts'>Parts of the run to show</h3>
                <!-- Parts of the run -->
                <span class='input'>
                    <input id='s1' type='checkbox' name='parts[]' value='Stage 1'>
                    <label for='s1'>Stage 1</label>
                </span>
                <span class='input'>
                    <input id='s1b' type='checkbox' name='parts[]' value='Stage 1 Boss'>
                    <label for='s1b'>Stage 1 Boss</label>
                </span>
                <span class='input'>
                    <input id='s2' type='checkbox' name='parts[]' value='Stage 2'>
                    <label for='s2'>Stage 2</label>
                </span>
                <span class='input'>
                    <input id='s2b' type='checkbox' name='parts[]' value='Stage 2 Boss'>
                    <label for='s2b'>Stage 2 Boss</label>
                </span>
                <span class='input'>
                    <input id='s3' type='checkbox' name='parts[]' value='Stage 3'>
                    <label for='s3'>Stage 3</label>
                </span>
                <span class='input'>
                    <input id='s3b' type='checkbox' name='parts[]' value='Stage 3 Boss'>
                    <label for='s3b'>Stage 3 Boss</label>
                </span>
                <span class='input'>
                    <input id='s4' type='checkbox' name='parts[]' value='Stage 4'>
                    <label for='s4'>Stage 4</label>
                </span>
                <span class='input'>
                    <input id='s4b' type='checkbox' name='parts[]' value='Stage 4 Boss'>
                    <label for='s4b'>Stage 4 Boss</label>
                </span>
                <span class='input'>
                    <input id='s5' type='checkbox' name='parts[]' value='Stage 5'>
                    <label for='s5'>Stage 5</label>
                </span>
                <span class='input'>
                    <input id='s5b' type='checkbox' name='parts[]' value='Stage 5 Boss'>
                    <label for='s5b'>Stage 5 Boss</label>
                </span>
                <span class='input'>
                    <input id='s6' type='checkbox' name='parts[]' value='Stage 6'>
                    <label for='s6'>Stage 6</label>
                </span>
                <span class='input'>
                    <input id='s6b' type='checkbox' name='parts[]' value='Stage 6 Boss'>
                    <label for='s6b'>Stage 6 Boss</label>
                </span>
                <span class='input'>
                    <input id='parts_other' type='checkbox' name='parts[]' value='Other'>
                    <label for='parts_other'>Other</label>
                </span>
                <!-- Notes -->
                <label for='notes' class='section'>Notes about the run</label>
                <textarea id='notes' name='notes' class='center'></textarea>
                <!-- Submit button -->
                <input type='submit' value='Submit'>
            </form>
            <h2 id='ack'>Acknowledgements</h2>
            <p id='credit'>The background image was drawn by <a href='https://www.pixiv.net/en/users/20799'>白雪 睦月</a>.</p>
            <p id='back'><strong><a id='backtotop' href='#nav'>Back to Top</a></strong></p>
        </div>
        <script src='assets/shared/dark.js'></script>
    </body>

</html>
