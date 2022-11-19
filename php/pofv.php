<?php
function tier(string $chara) {
    switch ($chara) {
        case 'marisa': return 'S';
        case 'reimu': return 'S';
        case 'youmu': return 'S';
        case 'komachi': return 'A';
        case 'eiki': return 'A';
        case 'lyrica': return 'B';
        case 'medicine': return 'B';
        case 'reisen': return 'B';
        case 'lunasa': return 'C';
        case 'merlin': return 'C';
        case 'yuuka': return 'D';
        case 'sakuya': return 'D';
        case 'aya': return 'D';
        case 'tewi': return 'E';
        case 'mystia': return 'E';
        case 'cirno': return 'E';
        default: return '';
    }
}

function name(string $chara) {
    switch ($chara) {
        case 'marisa': return 'Marisa Kirisame';
        case 'reimu': return 'Reimu Hakurei';
        case 'youmu': return 'Youmu Konpaku';
        case 'komachi': return 'Komachi Onozuka';
        case 'eiki': return 'Eiki Shiki Yamaxanadu';
        case 'lyrica': return 'Lyrica Prismriver';
        case 'medicine': return 'Medicine Melancholy';
        case 'reisen': return 'Reisen Udongein Inaba';
        case 'lunasa': return 'Lunasa Prismriver';
        case 'merlin': return 'Merlin Prismriver';
        case 'yuuka': return 'Yuuka Kazami';
        case 'sakuya': return 'Sakuya Izayoi';
        case 'aya': return 'Aya Shameimaru';
        case 'tewi': return 'Tewi Inaba';
        case 'mystia': return 'Mystia Lorelei';
        case 'cirno': return 'Cirno';
        default: return '';
    }
}

function ability(string $chara) {
    switch ($chara) {
        case 'youmu': return 'Bullet-cancelling sword';
        case 'marisa': return 'Energy fills faster';
        case 'reimu': return 'Small hitbox';
        case 'komachi': return 'Scope instantly activates all spirits in her field';
        case 'eiki': return 'Activated spirits only emit a single red bullet';
        case 'lyrica': return 'Can shoot backwards as well as forwards';
        case 'medicine': return 'Cannot be hit by spirits';
        case 'yuuka': return 'Three-way shots';
        case 'reisen': return 'Activated spirits drift upwards faster';
        case 'sakuya': return 'Activated spirits do not drift upwards';
        case 'lunasa': return 'Three-way shots';
        case 'merlin': return 'Slanted shots';
        case 'aya': return 'Slightly slows down bullets in her field';
        case 'mystia': return 'Attracts spirits towards her';
        case 'cirno': return 'Activated spirits take longer to self-destruct';
        case 'tewi': return 'Auto-bombs when hit at 0.5 health';
        default: return '';
    }
}

function description(string $chara) {
    switch ($chara) {
        case 'youmu': return _('Her movement speeds allow her to be either very slow or very fast at will. ' .
                'The sword has little cooldown, so it can be used repeatedly despite her slow charge speed. ' .
                'With that speed, the bullet clearing effect, and the invincibility frames that come with all charge attacks, ' .
                'she can easily cut through situations that no mortal should be able to dodge, and she can do it very often. ' .
                'The dead souls suffocate the opponent much like Marisa\'s lasers (though they can be cleared away), ' .
                'her spell attack is long lasting (so it cannot be totally countered by the opponent\'s spellcasting), ' .
                'and the boss summon uses movement restricting patterns that are completely devoid of pellet bullets. ' .
                'The result of these facts is that Youmu is absolutely top tier.');
        case 'marisa': return _('Marisa\'s charge attack not only instantly destroys spirits, but causes them to explode ' .
                'as if they had been activated. This allows her to easily set off chain reactions anywhere on the screen, ' .
                'without the need to rely on her scope. Her special ability means she can cast spells more often. ' .
                'Her high unfocused speed is great for macrododging and synergizes with her laser, ' .
                'which can be swept across the screen. Marisa can also make very good use of level 1 invincibility frames, ' .
                'due to her fast charge and movement speeds. Altogether, these give her excellent survivability. ' .
                'Offensively, her lasers suffocate the opponent and cannot be cleared by any means, ' .
                'eventually producing nigh-impossible situations with brutal frequency. In a late game spell war, ' .
                'Marisa is probably the strongest character in the game.');
        case 'reimu': return _('She\'s powerful because of her level 2 spell, which limits the opponent\'s movement and ' .
                'spawns over a long period of time, meaning it cannot itself be entirely countered by a spell from the opponent. ' .
                'However, she faces extremely fast bullets constantly as they are returned from her own spells ' .
                '(speed is retained when bullets are reflected). Her movement is slow, and her scope is slow to expand. ' .
                'The charge attack is useless. These make surviving with her somewhat difficult. Overall, she\'s unremarkable ' .
                'in every way except for her spell, which is by far the best in the game and ' .
                'single-handedly makes her a high tier character.');
        case 'komachi': return _('Her awesome scope and auto-targeting charge attack give her a lot of freedom. ' .
                'She can essentially start a combo at will, from anywhere on the screen. She\'s not obligated to chase the fairies and ' .
                'spirits around to maintain her spell points, and so can pay more attention to dodging. ' .
                'Her spell is not very dangerous, but neither does it feed the opponent much energy, ' .
                'and since most characters\' spells are basically free energy for the opponent anyway, ' .
                'this is actually pretty good. Her Extra attacks are great. They constantly cover the opponent\'s screen ' .
                'with random bullets, forcing them to the bottom. They\'re especially effective against fast characters who ' .
                'like to macrododge since they cover the whole screen evenly. In short, Komachi is a strong character that ' .
                'is definitely capable of winning matches against top tier characters.');
        case 'eiki': return _('Great movement speeds, scope, and charge attack. Her boss is also pretty good. ' .
                'Her extra attack \'clones\' existing bullets on the opponent\'s screen by firing a special, ' .
                'faster bullet in the same trajectory. Because the speed is determined by the original bullet, ' .
                'this is more effective against characters whose spells use fast bullets (Yuuka, Reimu, etc.). ' .
                'It\'s less effective against fast characters, because pellet bullets are loosely aimed and ' .
                'thus the Extra attacks they spawn will tend to all fly in one direction and can be macrododged. ' .
                'Eiki\'s critical weakness is her spell. It\'s totally non-threatening and every apparent pellet ' .
                'it creates is actually 2 or 3 pellets stacked directly on top of each other. ' .
                'All this does is feed the opponent tons of free energy. Falling short of the top tier largely due to this ' .
                'key disadvantage, Eiki is still a notable character that should not be taken lightly.');
        case 'lyrica': return _('Lyrica\'s scope is similar to Marisa\'s, but is much harder to use due to her slowness. ' .
                'Her charge attack also only shoots straight forward, and, due to the fact that it stays in place, ' .
                'it cannot be swept horizontally in the hopes of hitting an exposed fairy. This lack of coverage, ' .
                'again coupled with her slow movement, makes her extremely dependent on her scope to start chains, ' .
                'and her scope is just not very good. She also has rather slow charge speed. Her saving grace is her offense, ' .
                'particularly her spell. It covers a huge part of the screen and continues spawning over a long period of time, ' .
                'becoming an omnipresent threat much like Youmu\'s. Her boss and extra attack are also solid. Similarly to Reimu, ' .
                'but not as extremely, the spell turns Lyrica into a serious threat that should not be underestimated.');
        case 'medicine': return _('She boasts nice movement speeds and scope, and her ability to pass through spirits is sometimes useful. ' .
                'Her charge speed is kind of low and her charge attack sucks. Her spell, much like Eiki\'s, ' .
                'does nothing but feed her opponent. Her extra attack is terrifying and its effect stacks, ' .
                'eventually almost freezing the enemy in place. Unfortunately they will usually have lots of energy ' .
                'to save themselves and the absence of an Extra attack that is directly lethal becomes really ' .
                'apparent as they have nothing to worry about but pellets. She\'s more effective against characters who ' .
                'have weak charge attacks, whose spells use fast bullets, and who are forced to stay focused for a long time ' .
                'in order to activate spirits, since this furthers their slowness and deprives them of fairy spawns. ' .
                'While not a great character overall, Medicine is certainly usable and has some good matchups.');
        case 'yuuka': return _('Her boss, spell, and Extra attacks give her a decent offense as they force the opponent downward, ' .
                'but her defense is ruined by her slow movement. She has a hard time getting high enough on the screen to ' .
                'clear a decent area with her spells, and she\'s terrible at misdirecting and macrododging. ' .
                'This is a big problem, because the number of pellets she creates tends to push the game toward a spell war, ' .
                'and she\'s just poorly equipped to handle that. Her offense also suffers from this as its main strength ' .
                '(trapping the opponent and pushing them down) starts to fail completely and the other player will actually ' .
                'stay very high on the screen with ease. Even her normally powerful boss is bad at preventing this. ' .
                'Despite these disadvantages that significantly impact her viability, she can perform fairly well in the right hands.');
        case 'reisen': return _('Good defense, terrible offense; that is Reisen in a nutshell. Her spell creates too many bullets. ' .
                'She should only win against characters with slow charge speeds who cannot keep up with the all-out spell spam ' .
                'that will inevitably ensue. Reisen herself is well-equipped to deal with that situation, ' .
                'with her good scope, charge speed, and charge attack. Even then, between skilled enough players, ' .
                'a single round with Reisen in it can easily take a half hour or longer, ' .
                'regardless of which player theoretically has the upper hand. All in all, while Reisen is by no means high tier, ' .
                'she is potentially dangerous by forcing her opponent to endure for a long time.');
        case 'sakuya': return _('Her focused movement speed is barely different from her normal speed. This is strictly a weakness: ' .
                'she\'s too fast for precision, while also being too slow for anything else. The scope is awkward. ' .
                'The charge attack is even more useless than Reimu\'s. She is subject to a strange glitch; ' .
                'her time stop ends the bullet clearing effect of her spells. The result is that both the level 2 and level 3 spells ' .
                'clear the same area on her field, and this area is smaller than the area a normal character\'s level 2 would clear. ' .
                'Additionally, should you cast a level 2 just before an automatic level 3 occurs (through spell points reaching 500k) ' .
                'the time stop will cut it short instantaneously, and it will clear no bullets at all. ' .
                'The time stop can also toy with enemy spells, causing bullets which should have spawned over time to spawn all at once ' .
                '(for instance, Aya\'s spell can become a blanket across the whole screen). This is yet another weakness in many cases, ' .
                'as it can lead to unpredictable things, though arguably it could be advantageous in some cases. Her spell itself is not ' .
                'threatening to the opponent, since it spawns very few bullets that also appear all at once; ' .
                'this makes it easy for the opponent to clear it away with their own spell. ' .
                'In fact, it can often be cleared by a spell that was cast before the bullets even appeared. ' .
                'The knife rows can limit the opponent\'s movement but are very slow and become a non-issue, as ' .
                'spells are cast more frequently as the match progresses. The boss summon also uses slow, simple patterns. ' .
                'To summarize, while she does have some minor positive points, the negative outweighs the positive for the ' .
                'knife-throwing maid.');
        case 'lunasa': return _('While her movement and charge speeds are good, her defense is still a bit low thanks to ' .
                'her awkward scope and three-way shot. Her offense is likewise nothing to write home about. ' .
                'Her spell is so slow it hardly matters at all. Her extra attacks are okay for limiting the opponent\'s space, ' .
                'but are again very slow and can be easily streamed much like Aya\'s. Her boss is also unimpressive, ' .
                'with one attack in particular that\'s just free energy for the opponent. The overall mediocre offensive and ' .
                'defensive capability result in this Prismriver sister being a low tier character.');
        case 'merlin': return _('Her movement, scope, and charge speed are all very slow. ' .
                'The scope is essentially Lyrica\'s, but horizontal, and her charge attack shoots horizontally as well. ' .
                'Her basic shots do not spawn from the center of her sprite but rather from two points to her left and right. ' .
                'The shots from the right fly diagonally left and the ones from the left fly diagonally right, ' .
                'crossing each other\'s paths a short distance in front of her. If she hugs a wall, ' .
                'the shots that should be spawning from off screen will simply fail to appear. ' .
                'Thanks to her scope, she has difficulty dealing with spirits, unless she stays focused for long stretches of time, ' .
                'which of course slows her down even further and limits the fairy spawns on her screen. ' .
                'Offensively, she\'s pretty good. Her spells last forever and limit the opponent\'s movement, ' .
                'while her extra attacks send big bullets all over the screen. Her boss is also fairly strong. ' .
                'Worse than her sisters in terms of defense, Merlin\'s offense somewhat makes up for it, keeping her out ' .
                'of the lowest tier.');
        case 'aya': return _('Her focused speed is uncomfortably fast. Her spell and Extra attack aren\'t individually terrible, but ' .
                'play exactly the same role, so as long as the opponent carefully moves in one direction, they have very little ' .
                'to worry about. Still, her offense can be okay when the game picks up, especially when her boss is present, ' .
                'since this makes it very hard for the opponent to move up. Her big problem is her defense. ' .
                'She has a hard time micrododging and gets tons of fast bullets continuously sent back at her from her spells. ' .
                'With this decidedly weak defense, combined with her decent, but not great, offense, she struggles to win most matches.');
        case 'mystia': return _('Defensively, she\'s not bad. Good speeds, fast scope, and an acceptable charge attack. ' .
                'Her offense, however, is miserable. The spell takes a thousand years to appear, and even once it starts to move, ' .
                'the bullets are slow. You might think at first that its slow appearance would make it somewhat resistant to ' .
                'being cancelled by the opponent\'s spells, but there is actually a single \'generator\' bullet (the bird-like thing) ' .
                'that spawns all of the others, and when that gets cleared, the whole spell fails to appear. ' .
                'Once the game picks up, the generator bullet will invariably be cleared away every time before the ' .
                'spell does anything at all and her boss and extra attacks all behave similarly. Everything\'s just way too slow, ' .
                'the combined effect of which leads to Mystia\'s bottom tier placement.');
        case 'cirno': return _('She\'s fast and has an okay scope. She charges a bit slowly, but this doesn\'t matter too much. ' .
                'Her spell attack creates a simple ring of bullets, then freezes all bullets on both players screens ' .
                '(with the exception of a few character\'s extra attacks, including Cirno\'s), randomly changes their directions, ' .
                'then sends them all moving at once. The original speed of the bullets is not retained. Additionally, ' .
                'some non-pellet bullets on Cirno\'s screen (not the opponent\'s) will degrade into pellets, ' .
                'allowing them to be reflected. Her boss is very weak and her extra attacks are nothing special. ' .
                'Thanks to the freezing effect of her spells, Cirno has excellent defense and terrible offense, ' .
                'as her spells essentially help the opponent just as much as they help her. She\'s like Reisen, but even more extreme. ' .
                'The ice fairy\'s horribly skewed playability, fully specializing in defensive play, renders her hard to use ' .
                'in a competitive environment.');
        case 'tewi': return _('Fast while unfocused, slow when focused. Her charge speed is excellent. ' .
                'Her scope is slow and poorly shaped (much like Merlin\'s), her charge attack is terrible. ' .
                'While slow focused speed is normally ideal, it\'s a rotten combination with slow scope speed, ' .
                'so spirits become a much greater nuisance than they would usually be. Her extra attacks aren\'t garbage, ' .
                'but aren\'t very good either. They move too slowly to really accomplish anything. ' .
                'Her spell has barely any bullets and on top of that is easily cleared away before it does anything. ' .
                'The boss is pretty wimpy and has a pellet attack that\'s basically free energy for the opponent. ' .
                'Her ability is passable; it allows you attempt a level 2 rather than bombing even in very risky situations, ' .
                'knowing the bomb will save you anyway if you get hit. Altogether, her offense is pathetic and ' .
                'her terrible scope cripples her defense, making her one of the least viable characters in the game.');
    }
}
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p>This is a portal for competitive PoFV play, featuring the current tier list, a guide to help you get started with
    netplay, and links to relevant resources as well as the rules of tournaments for the game, held at the
    <a id='discord' href='https://discord.gg/2QPPPpE'><span class='icon discord_icon'></span> Phantasmagoria Netplay Discord server</a>.</p>
    <h2>Contents</h2>
    <div class='contents'>
        <p><a href='#tiers'>Tier List</a></p>
        <p><a href='#guide'>Netplay Guide</a></p>
        <p><a href='#trouble'>Troubleshooting</a></p>
        <p><a href='#rules'>Tournament Rules</a></p>
        <p><a href='#links'>Useful Links</a></p>
    </div>
    <h2 id='tiers'>Tier List</h2>
    <p>This tier list is an average of the opinions of competitive players in the English-speaking community.
    Click a character to see their stats and a brief description of their competitive use.</p>
    <noscript><p><em>Sorry, you cannot access the character info with JavaScript disabled as of now.</em></p></noscript>
    <table class='noborders'>
        <tr>
            <th id='s' class='tier'>S</th>
            <td class='noborders'>
                <span id='marisa' class='char' title='Marisa Kirisame'></span>
            </td>
            <td class='noborders'>
                <span id='reimu' class='char' title='Reimu Hakurei'></span>
            </td>
            <td class='noborders'>
                <span id='youmu' class='char' title='Youmu Konpaku'></span>
            </td>
        </tr>
        <tr>
            <th id='a' class='tier'>A</th>
            <td class='noborders'>
                <span id='komachi' class='char' title='Komachi Onozuka'></span>
            </td>
            <td class='noborders'>
                <span id='eiki' class='char' title='Eiki Shiki Yamaxanadu'></span>
            </td>
            <td class='hidden'></td>
        <tr>
            <th id='b' class='tier'>B</th>
            <td class='noborders'>
                <span id='lyrica' class='char' title='Lyrica Prismriver'></span>
            </td>
            <td class='noborders'>
                <span id='medicine' class='char' title='Medicine Melancholy'></span>
            </td>
            <td class='noborders'>
                <span id='reisen' class='char' title='Reisen Udongein Inaba'></span>
            </td>
        </tr>
        <tr>
            <th id='c' class='tier'>C</th>
            <td class='noborders'>
                <span id='merlin' class='char' title='Merlin Prismriver'></span>
            </td>
            <td class='noborders'>
                <span id='lunasa' class='char' title='Lunasa Prismriver'></span>
            </td>
            <td class='hidden'></td>
        </tr>
        <tr>
            <th id='d' class='tier'>D</th>
            <td class='noborders'>
                <span id='yuuka' class='char' title='Yuuka Kazami'></span>
            </td>
            <td class='noborders'>
                <span id='sakuya' class='char' title='Sakuya Izayoi'></span>
            </td>
            <td class='noborders'>
                <span id='aya' class='char' title='Aya Shameimaru'></span>
            </td>
        </tr>
        <tr>
            <th id='e' class='tier'>E</th>
            <td class='noborders'>
                <span id='tewi' class='char' title='Tewi Inaba'></span>
            </td>
            <td class='noborders'>
                <span id='mystia' class='char' title='Mystia Lorelei'></span>
            </td>
            <td class='noborders'>
                <span id='cirno' class='char' title='Cirno'></span>
            </td>
        </tr>
    </table>
    <h2 id='guide'>Netplay Guide</h2>
    <p>First of all, you need to use the following link to download and install a package of necessary netplay tools:</p>
    <p><a href='https://maribelhearn.com/mirror/PoFV-Adonis-VPatch-Goodies.zip' target='_blank'>PoFV-Adonis-VPatch-Goodies.zip</a></p>
    <p>After that, you want to extract all of the content of the <span class='code'>.zip</span> file to your PoFV game folder,
    i.e. the one that contains <span class='code'>th09.exe</span>. Your folder should look like this:</p>
    <img class='guide' src='assets/games/pofv/images/folder.png' alt='PoFV folder'>
    <p>Once everything has been extracted to the folder, you are ready to connect to whoever hosts at any time, using programs
    called <strong>Adonis</strong>, <strong>Adonise</strong> (English) and <strong>Adonis2</strong>.
    This is what it looks like in Adonis2, the current standard tool used by the PoFV netplay community:</p>
    <img class='guide' src='assets/games/pofv/images/connect.png' alt='Connection in Adonis2'>
    <p>To be able to host, you need to either <a href='https://portforward.com'>port forward</a> or use
    <a href='https://zerotier.com/download'>
        <span class='icon zerotier_icon'></span> Zerotier
    </a>
    (Hamachi works as well, but is not used by the PoFV netplay community). This is what it looks like in Adonis2:</p>
    <img class='guide' src='assets/games/pofv/images/host.png' alt='Hosting in Adonis2'>
    <h2 id='trouble'>Troubleshooting</h2>
    <p><strong>Adonis crashes while trying to connect to someone.</strong></p>
    <p>This means that you couldn’t connect to the host. If this happens, make sure that the host has port forwarded or
    is currently hosting via Hamachi or Zerotier.</p>
    <p><em>=&gt; The host is hosted via Zerotier.</em></p>
    <p>Make sure that you both have connected to someone already a part of the network first and then try again.
    For Zerotier to work, everyone needs to have some sort of connection to the host of the network.</p>
    <p><em>=&gt; The host has port forwarded or is 100% sure that Zerotier is working.</em></p>
    <p>Try to host by yourself and play in either compatibility mode or as an Administrator.</p>
    <p><em>=&gt; None of the above is working.</em></p>
    <p>Go into your firewall and click advanced settings and then inbound rules and
    make sure the rules for Adonis and th09 are enabled. If you are using Zerotier make sure that is enabled as well.
    (both host and person connecting needs to do this)</p>
    <img class='guide' src='assets/games/pofv/images/properties.png' alt='Windows Firewall properties'>
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
        (Finals include Winners' Final, Losers' Final, and Grand Finals.)</li>
        <li>All matches will be played on Lunatic difficulty to speed up sets.</li>
        <li>All characters are allowed, but you must stay on your pick
        if you win a game while the loser may change if desired.</li>
        <li>The chosen stage for every set is Misty Lake, due to possible frame drops on other stages and bullet visibility,
        especially for those that are color blind.</li>
        <li>Test rounds are allowed. Checking for desyncs at round start by hugging the middle is recommended,
        but not mandatory.</li>
        <li>The host will always be player one, unless both participants agree otherwise.</li>
        <li>Please use a random number generator for who picks their character first
        if counterpicking becomes a problem in the first game.</li>
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
        <span class='icon flag_france'></span> French Guide
    </a></p>
    <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
</div>
<div id='modal'><?php
    $MIN_SPEED = 148;
    $MIN_CHARGE = 45.5;
    $chars = array('marisa', 'reimu', 'youmu', 'komachi', 'eiki', 'lyrica', 'medicine', 'reisen', 'lunasa', 'merlin', 'yuuka', 'sakuya', 'aya', 'tewi', 'mystia', 'cirno');
    $json = file_get_contents('assets/games/pofv/pofv_stats.json');
    $stats = json_decode($json, true);
    foreach ($chars as $key => $chara) {
        $tier = tier($chara);
        $full_name = name($chara);
        $focus = max($MIN_SPEED - $stats[$chara]['focus'], 1.5);
        $charge = max($MIN_CHARGE - $stats[$chara]['charge'], 0.3);
        echo '<div id="' . $chara . '_info" class="modal_inner"><h2>' . $full_name . '</h2><table class="noborders"><tr>' .
        '<td class="noborders"><img class="pofv_chara_art" src="assets/games/pofv/characters/' . $chara . '.png" alt="' . $full_name . '"></td>' .
        '<td class="noborders"><table class="stats noborders"><tr><td class="noborders">Tier</td><td class="noborders"><strong class="' . $tier . '">' . $tier . '</strong></td></tr>' .
        '<tr><td class="noborders">Normal Speed</td><td class="noborders"><progress value="' . ($MIN_SPEED - $stats[$chara]['speed']) . '" max="98"></progress></td></tr>' .
        '<tr><td class="noborders">Focused Speed</td><td class="noborders"><progress value="' . $focus . '" max="98"></progress></td></tr>' .
        '<tr><td class="noborders">Charge Speed</td><td class="noborders"><progress value="' . $charge . '" max="20.5"></progress></td></tr>' .
        '<tr><td class="noborders">Charge Delay</td><td class="noborders">' .  $stats[$chara]['delay'] . ' frames</td></tr>' .
        '<tr><td class="noborders">Special Ability</td><td class="noborders">' . ability($chara) . '</td></tr>' .
        '<tr><td class="noborders">Scope</td><td class="noborders">' . $stats[$chara]['scope'] . '</td></tr></table></td>' .
        '<td class="noborders"><img class="scope" src="assets/games/pofv/scopes/' . $chara . '.jpg" alt="' . ucfirst($chara) . '\'s scope"></td></tr></table>' .
        '<p class="descr">' . description($chara) . '</p></div>';
    }
?></div>
