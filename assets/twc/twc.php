<?php setlocale(LC_ALL, $locale); bindtextdomain($lang, 'locale'); textdomain($lang) ?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p><?php
        echo _('<strong>Touhou World Cup (TWC)</strong> is an annual international Touhou shooting game competition, ' .
        'first held in 2020, organised by the Chinese gameplay community. ' .
        'This time around, in 2021, it is organised by the Western gameplay community.');
    ?></p>
    <p><?php
        echo _('Three teams, a Western community team, a Chinese team, and a Japanese team, duke it out ' .
        'on Lunatic and Extra mode, playing on live streams and playing both high score and survival.');
    ?></p>
    <p><?php
        echo _('See below for official communication channels, live streams with commentary, the schedule, ' .
        'and the rules the players play by.');
    ?></p>
    <div id='links'>
        <p><span class="icon twitter_icon"></span><a href="https://twitter.com/touhouworldcup"><?php echo _('Official TWC Twitter') ?></a></p>
        <p><span class="icon youtube_icon"></span><a href="https://www.youtube.com/channel/UCk8o-jk-Zpn4CEmLUIkui0A"><?php echo _('Official TWC YouTube Channel') ?></a></p>
        <p><span class="icon flag_uk"></span><a href="https://www.twitch.tv/touhou_replay_showcase"><?php echo _('English commentary stream (Twitch)') ?></a></p>
        <p>
            <span class="icon flag_china"></span><a href="https://live.bilibili.com/22478102?share_source=copy_link"><?php echo _('Chinese commentary stream 1 (Bilibili)') ?></a>
            <br>
            <span class="icon flag_china"></span><a href="https://live.bilibili.com/14315174?share_source=copy_link"><?php echo _('Chinese commentary stream 2 (Bilibili)') ?></a>
        </p>
        <p><span class="icon flag_japan"></span><a href="https://www.youtube.com/channel/UCfF3O4wo0YxppTZGmtTGDwg"><?php echo _('Japanese commentary stream (YouTube)') ?></a></p>
        <p><span class="icon flag_russia"></span><a class="dead" href="https://www.twitch.tv/touhou_russian_kolkhoz"><?php echo _('Russian commentary stream (Twitch)') ?></a></p>
    </div>
    <h2 id='contents'><?php echo _('Contents') ?></h2>
    <div id='contents_div' class='border'>
        <p><a href='#schedule'><?php echo _('Schedule') ?></a></p>
        <p><a href='#rules'><?php echo _('Rules') ?></a></p>
    </div>
    <h2 id='schedule'><?php echo _('Schedule') ?></h2>
    <p><?php echo _('Your time zone was detected as <span id="timezone"></span>.') ?></p>
    <p><?php
        if ($lang == 'en_US' || $lang == 'ru_RU') {
            echo _('Daylight Saving Time (also known as Summer Time or DST) is taken into account automatically.');
        }
    ?></p>
    <table id='schedule_table'>
        <thead>
            <tr>
                <th rowspan='3'><?php echo _('Date/Time') ?></th>
                <th rowspan='3'><?php echo _('Category') ?></th>
                <th rowspan='3'><?php echo _('Players') ?></th>
                <th rowspan='3'><?php echo _('Reset Time<br>(minutes)') ?></th>
            </tr>
        </thead>
        <tbody id='schedule_tbody'>
        </tbody>
    </table>
    <h2 id='rules'><?php echo _('Rules') ?></h2>
    <h3><?php echo _('Format') ?></h3>
    <p><?php echo _('For every match, each team can earn points. Ranking is based on whoever has the most points:') ?></p>
    <ul>
        <li><?php echo _('1st place - 2 pts') ?></li>
        <li><?php echo _('2nd place - 1 pt') ?></li>
        <li><?php echo _('3rd place - 0 pts') ?></li>
    </ul>
    <p><?php echo _('In 2-team matches, the first place gets 2 points, and 2nd place gets 1 point.') ?></p>
    <p><?php
        echo _('If multiple players have the exact same amount of ISCORE, their points will be split equally. ' .
        'This also means that, if multiple players have the highest ISCORE, the match ends in a tie.');
    ?></p>
    <p><?php echo _('At the end of the World Cup, the teams will be ranked based on has the most points.') ?></p>
    <h3><?php echo _('Calculating Points') ?></h3>
    <p><?php
        echo _('The points are based on the ' .
        '<a href="https://www.isndes.com/jf">ISCORE calculator</a> (see the "About ISCORE" link ' .
        'in the top right after changing to English via the language icon, fourth from the right).');
    ?></p>
    <p><?php
        echo _('Score matches are calculated based on the ISCORE formula. ' .
        'Survival matches (except for GFW) are calculated as follows:');
    ?></p>
    <p><tt><?php echo _('(ISCORE No Miss No Bomb Score)*0.5^(deaths)') ?></tt></p>
    <p><?php echo _('In survival runs, bombs are counted as 2 deaths.') ?></p>
    <p><?php
        echo _('ISCORE is a scoring metric that compensates for the differences in performance ' .
        'between shot types and categories. The formulas used can be found in the ISCORE rubric ' .
        'with the calculator linked above.');
    ?></p>
    <h3><?php echo _('Game-specific Concerns') ?></h3>
    <h4><?php echo _('Touhou 7') ?></h4>
    <p><?php echo _('A border break is considered a death in survival runs.') ?></p>
    <h4><?php echo _('Touhou 8') ?></h4>
    <p><?php
        echo _('Getting hit during a Last Spell is <strong>not</strong> considered a death in survival runs. '.
        'However, ISCORE gives a higher base value in this game to runs that capture all spells ' .
        '(which includes unlocking and capturing <strong>every</strong> Last Spell) AND do not die/bomb ' .
        '(NN + Full-SC).');
    ?></p>
    <h4><?php echo _('Touhou 12') ?></h4>
    <p>
    </p>
    <p><?php
        echo _('Summoning a UFO is considered a death in survival runs. ' .
        'However, collecting tokens does not affect the score in survival runs.');
    ?></p>
    <h4><?php echo _('Touhou 12.8') ?></h4>
    <p></p>
    <p><?php echo _('The survival formula for this game is (gold medals*1.5)-(deaths).') ?></p>
    <h4><?php echo _('Touhou 13') ?></h4>
    <p><?php
        echo _('A manual trance is considered 2 deaths in survival runs. ' .
        'ISCORE gives a higher base value in this game to runs that capture all spells AND does not die/bomb ' .
        '(NN + Full-SC).');
    ?></p>
    <h4><?php echo _('Touhou 15') ?></h4>
    <p><?php echo _('All runs in both survival/score have to be done in Legacy Mode.') ?></p>
    <h4><?php echo _('Touhou 16') ?></h4>
    <p><?php echo _('Releasing your season gauge is considered 2 deaths in survival runs.') ?></p>
    <h4><?php echo _('Touhou 17') ?></h4>
    <p><?php
        echo _('Channeling a berserk roar (3 or more of the same animal tokens during roar mode) ' .
        'is considered 2 deaths in survival runs. Breaking your roar ' .
        '(bombing or touching a bullet during roar mode) is considered a death in survival runs.');
    ?></p>
    <h3><?php echo _('Use of Third Party Software &amp; Material') ?></h3>
    <p><?php
        echo _('Vsync patch is allowed. Practice patches (such as thprac) are allowed, ' .
        'but all practice cheats have to be disabled for the runs.');
    ?></p>
    <p><?php
        echo _('Visual patches (e.g. hitbox patch) are prohibited. Translation patches are allowed but discouraged. ' .
        'Audio patches/background music is allowed but no copyrighted material.');
    ?></p>
    <h3><?php echo _('Other Rules') ?></h3>
    <ul><?php
        echo _('<li>Runs only count from the moment the timer has started.</li>' .
        '<li>Players can start as many runs as they want during the match. ' .
        'When the timer has finished on stream, no new runs can be started anymore.</li>' .
        '<li>A clear is always better than a gameover, no matter the score difference.</li>' .
        '<li>The players have to stream their gameplay. Just stream game footage: ' .
        'no overlay that shapes/crops the stream.</li>' .
        '<li>Streamers are allowed to have elements (images, input displays, cameras, etc.) on top of their game. ' .
        'However, the gameplay window, as well as all information on the player\'s HUD, ' .
        'has to be visible at all times.</li><li>Finished runs need their replays saved.</li>' .
        '<li>Please hide the story ending when your run finishes.</li>');
    ?></ul>
    <p id='back'><strong><a id='backtotop' href='#top'><?php echo _('Back to Top') ?></a></strong></p>
</div>
