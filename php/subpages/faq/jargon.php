<h2>Touhou Community Jargon</h2>
<p><?php echo _('This list contains explanations for terms and acronyms used in the community of Touhou players. It also contains general gaming and shoot \'em up terms that are relevant to Touhou.')?></p>
<h2><?php echo _('Contents')?></h2>
<div class='contents'>
    <p><a href='#spells'><?php echo _('Spell Card / Pattern Acronyms')?></a></p>
    <p><a href='#bullets'><?php echo _('Bullet Type Names')?></a></p>
</div>
<h2 id='main'><?php echo _('Gameplay Related Terms')?></h2>
<table id='jargontable' class='noborders'>
    <thead>
        <tr>
            <th class='jargon'><?php echo _('Jargon')?><hr></th>
            <th><?php echo _('Meaning')?><hr></th>
        </tr>
    </thead>
    <tbody>
        <tr id='term_0/0'>
            <th><?php echo _('0/0')?></th>
            <td><?php echo _('0 extra lives and 0 bombs, the point at which the player has no <a href="#term_resources">resources</a> left and is thus forced to survive all of the upcoming patterns to still clear. ' .
            'The \'x/y\' notation is often used to denote the number of spare lives and bombs a player has at a given point in time in a run.')?></td>
        </tr>
        <?php
            if ($lang == 'en_GB' || $lang == 'en_US') {
                echo '<tr id="term_10D"><th>10D</th><td>If you use this, please switch to using <a href="#term_td">TD</a> for that game now.</td></tr>';
            }
        ?>
        <tr id='term_1cc'>
            <th><?php echo _('1cc')?></th>
            <td><?php echo _('1 credit clear; a clear without using continues, which is equivalent to only using one coin if playing on an arcade machine, the origin of the term. ' .
            'This is the primary goal that people will have in a game when starting to play it.')?></td>
        </tr>
        <tr id='term_bottomhugging'>
            <th><?php echo _('Bottomhugging')?></th>
            <td><?php echo _('Being at the bottom of the screen all the time while playing, a tendency that newer players often have, due to being afraid of the bullets and ' .
            'wanting to be as far away from them as possible. While sometimes useful, this is not always the best general strategy.')?></td>
        </tr>
        <tr id='term_cancel'>
            <th><?php echo _('Cancel')?></th>
            <td><?php echo _('Bullets being converted into items, effectively wiping them from the screen, which is often important for score. ' .
            'This occurs when the player ends a boss pattern by shooting the boss, but can have several other causes too, such as enemies that cancel their bullets when killed, or bombing.')?></td>
        </tr>
        <tr id='term_capture'>
            <th><?php echo _('Cap')?></th>
            <td><?php echo _('Abbreviation of \'capture\'; a Spell Card being dodged without dying or bombing, which awards a Spell Card Bonus.')?></td>
        </tr>
        <tr id='term_clipdeath'>
            <th><?php echo _('Clipdeath')?></th>
            <td><?php echo _('Dying because of wrongly estimating bullet hitbox size(s).')?></td>
        </tr>
        <tr id='term_counterstop'>
            <th><?php echo _('Counterstop')?></th>
            <td><?php echo _('The point at which the score counter stops increasing; the score limit of a game. Sometimes this is reachable, but most of the time it is not. ' .
            'Not to be confused with <a href="#term_overflow">overflow</a> or <a href="#term_underflow">underflow</a>.')?></td>
        </tr>
        <tr id='term_cs'>
            <th><?php echo _('CS')?></th>
            <td><?php echo _('See <a href="#term_counterstop">counterstop</a>.')?></td>
        </tr>
        <tr id='term_db'>
            <th><?php echo _('DB')?></th>
            <td><?php echo _('Deathbomb; a bomb within a few frames after getting hit, which saves you from dying.')?></td>
        </tr>
        <tr id='term_ddc'>
            <th>DDC</th>
            <td><?php echo _('Touhou 14: Double Dealing Character.')?></td>
        </tr>
        <tr id='term_ds'>
            <th>DS</th>
            <td><?php echo _('Touhou 12.5: Double Spoiler.')?></td>
        </tr>
        <tr id='term_eosd'>
            <th>EoSD</th>
            <td><?php echo _('Touhou 6: the Embodiment of Scarlet Devil.')?></td>
        </tr>
        <tr id='term_ex'>
            <th><?php echo _('Ex')?></th>
            <td><?php echo _('Extra; the Extra Stage.')?></td>
        </tr>
        <tr id='term_extend'>
            <th><?php echo _('Extend')?></th>
            <td><?php echo _('An extra life; a 1up.')?></td>
        </tr>
        <tr id='term_exnn'>
            <th><?php echo _('ExNN')?></th>
            <td><?php echo _('Extra No Miss No Bomb; a <a href="#term_1cc">1cc</a> of some Extra Stage without dying or using bombs. A third \'N\' is appended if there is a game-specific third restriction.')?></td>
        </tr>
        <tr id='term_fs'>
            <th><?php echo _('FS')?></th>
            <td><?php echo _('Full Spell; a run that captures all Spell Cards.')?></td>
        </tr>
        <tr id='term_fw'>
            <th><?php echo _('FW')?></th>
            <td><?php echo _('See <a href="#term_gfw">GFW</a>.')?></td>
        </tr>
        <tr id='term_graze'>
            <th><?php echo _('Graze')?></th>
            <td><?php echo _('Having a bullet come very close to your hitbox, which means it touches your \'grazebox\', a hitbox larger than your main hitbox that is used to detect grazing.')?></td>
        </tr>
        <tr id='term_gfw'>
            <th>GFW</th>
            <td><?php echo _('Touhou 12.8: Great Fairy Wars.')?></td>
        </tr>
        <tr id='term_gameover'>
            <th><?php echo _('GO')?></th>
            <td><?php echo _('(Uncommon) Game over. Not to be confused with <a href="#term_go">"Good Omen"</a>, a Spell Card.')?></td>
        </tr>
        <tr id='term_hitbox'>
            <th><?php echo _('Hitbox')?></th>
            <td><?php echo _('The part of a sprite that is used for collision detection; that is, the part of the player character or an enemy that can get hit, and the part of a bullet that kills you when touched. ' .
            'In Touhou, hitboxes of a sprite are smaller than the full size of the sprite.')?></td>
        </tr>
        <tr id='term_hrtp'>
            <th>HRtP</th>
            <td><?php echo _('Touhou 1: Highly Responsive to Prayers.')?></td>
        </tr>
        <tr id='term_hsifs'>
            <th>HSiFS</th>
            <td><?php echo _('Touhou 16: Hidden Star in Four Seasons.')?></td>
        </tr>
        <tr id='term_iframes'>
            <th><?php echo _('I-frames')?></th>
            <td><?php echo _('Invincibility frames; frames during which something does not take any hits. Your player character has a number of I-frames after a death, as well as during a bomb. ' .
            'Under certain circumstances, some enemy characters can also have I-frames.')?></td>
        </tr>
        <tr id='term_in'>
            <th>IN</th>
            <td><?php echo _('Touhou 8: Imperishable Night.')?></td>
        </tr>
        <tr id='term_isc'>
            <th>ISC</th>
            <td><?php echo _('Touhou 14.3: Impossible Spell Card.')?></td>
        </tr>
        <tr id='term_lls'>
            <th>LLS</th>
            <td><?php echo _('Touhou 4: Lotus Land Story.')?></td>
        </tr>
        <tr id='term_lnb'>
            <th><?php echo _('LNB')?></th>
            <td><?php echo _('Lunatic No Bomb; a <a href="#term_1cc">1cc</a> of some game on Lunatic difficulty without using bombs.')?></td>
        </tr>
        <tr id='term_lnn'>
            <th><?php echo _('LNN')?></th>
            <td><?php echo _('Lunatic No Miss No Bomb; a <a href="#term_1cc">1cc</a> of some game on Lunatic difficulty without dying or using bombs. A third \'N\' is appended if there is a game-specific third restriction.')?></td>
        </tr>
        <tr id='term_lolk'>
            <th>LoLK</th>
            <td><?php echo _('Touhou 15: Legacy of Lunatic Kingdom.')?></td>
        </tr>
        <tr id='term_ls'>
            <th><?php echo _('LS')?></th>
            <td><?php echo _('Last Spell; a spell used at the end of an <a href="#term_in">IN</a> boss fight when the time requirement is met. It does not cost a life to die to it.')?></td>
        </tr>
        <tr id='term_lw'>
            <th><?php echo _('LW')?></th>
            <td><?php echo _('Last Word; a special spell (and the difficulty of such a spell) used by an <a href="#term_in">IN</a> boss,
            which is only available in Spell Practice mode.')?></td>
        </tr>
        <tr id='term_macrododging'>
            <th><?php echo _('Macrododging')?></th>
            <td><?php echo _('Dodging waves of bullets by going around them rather than through them, which may or may not be to avoid having to <a href="#term_micrododging">micrododge</a>. Often abbreviated to \'macro\'.')?></td>
        </tr>
        <tr id='term_maingames'>
            <th><?php echo _('Maingames')?></th>
            <td><?php echo _('<em>Disputed.</em> Generally means integer games, but the status of PC-98 games and <a href="#term_pofv">PoFV</a> as maingames is not agreed upon. The integer games ' .
            'from <a href="#term_eosd">EoSD</a> to <a href="#term_um">UM</a>, excluding <a href="#term_pofv">PoFV</a>, are always included.')?></td>
        </tr>
        <tr id='term_memo'>
            <th><?php echo _('Memo')?></th>
            <td><?php echo _('Memorisation; remembering a specific <a href="#term_route">route</a> for a pattern in order to dodge it.')?></td>
        </tr>
        <tr id='term_micrododging'>
            <th><?php echo _('Micrododging')?></th>
            <td><?php echo _('Dodging dense waves of bullets by navigating through them, usually using small taps to get safely through. Often abbreviated to \'micro\'.')?></td>
        </tr>
        <tr id='term_midnon'>
            <th><?php echo _('Midnon')?></th>
            <td><?php echo _('A <a href="#term_nonspell">nonspell</a> used by a midboss.')?></td>
        </tr>
        <tr id='term_midspell'>
            <th><?php echo _('Midspell')?></th>
            <td><?php echo _('A Spell Card used by a midboss.')?></td>
        </tr>
        <tr id='term_milking'>
            <th><?php echo _('Milking')?></th>
            <td><?php echo _('Stalling a pattern for as long as possible to maximise the value of something, which is mostly graze. In <a href="#term_gfw">GFW</a>, players milk freezes instead.')?></td>
        </tr>
        <tr id='term_misdirection'>
            <th><?php echo _('Misdirection')?></th>
            <td><?php echo _('Making aimed bullets go into a direction away from you, to make sure you are safe.')?></td>
        </tr>
        <tr id='term_miss'>
            <th><?php echo _('Miss')?></th>
            <td><?php echo _('Losing a life. This term came from the Japanese transliteration of "mistake", ミステイク misuteiku,
            which has as abbreviation ミス misu, i.e. "miss".')?></td>
        </tr>
        <tr id='term_mof'>
            <th>MoF</th>
            <td><?php echo _('Touhou 10: Mountain of Faith.')?></td>
        </tr>
        <tr id='term_ms'>
            <th>MS</th>
            <td><?php echo _('Touhou 5: Mystic Square.')?></td>
        </tr>
        <tr id='term_nonspell'>
            <th><?php echo _('Non')?></th>
            <td><?php echo _('Nonspell; a boss attack that is not a Spell Card.')?></td>
        </tr>
        <tr id='term_nb'>
            <th><?php echo _('NB')?></th>
            <td><?php echo _('No Bomb; a clear without bombing.')?></td>
        </tr>
        <tr id='term_nbb'>
            <th><?php echo _('NBB')?></th>
            <td><?php echo _('No Border Breaks; used in <a href="#term_pcb">PCB</a> to mean a clear without breaking Supernatural Borders, whether it be by getting hit during one or by pressing the X key.')?></td>
        </tr>
        <tr id='term_nc'>
            <th><?php echo _('NC')?></th>
            <td><?php echo _('No Cards; used in <a href="#term_um">UM</a> to mean a clear without using any active, equipment or passive cards. ' .
            'Cards that do not affect <a href="#term_nmnb">NMNB</a> play, such as the life card, the bomb card and the money card, may be exempt from this.')?></td>
        </tr>
        <tr id='term_nf'>
            <th><?php echo _('NF')?></th>
            <td><?php echo _('No Focus; a clear without using focus mode, that is, without pressing Shift.')?></td>
        </tr>
        <tr id='term_nm'>
            <th><?php echo _('NM')?></th>
            <td><?php echo _('No Miss; a clear without dying. Also known as \'1 life clear\'.')?></td>
        </tr>
        <tr id='term_nmnb'>
            <th><?php echo _('NMNB')?></th>
            <td><?php echo _('No Miss No Bomb; a clear without dying or bombing. Also known as <a href="#term_perfect">Perfect</a> or the even shorter acronym <a href="#term_nn">NN</a>.')?></td>
        </tr>
        <tr id='term_nn'>
            <th><?php echo _('NN')?></th>
            <td><?php echo _('See <a href="#term_nmnb">NMNB</a>.')?></td>
        </tr>
        <tr id='term_nnn'>
            <th><?php echo _('NNN')?></th>
            <td><?php echo _('<a href="#term_nmnb">NMNB</a>, plus a game-specific third restriction, which is
            <a href="#term_nbb">NBB</a> for <a href="#term_pcb">PCB</a>, <a href="#term_nv">NV</a>
            for <a href="#term_ufo">UFO</a>, <a href="#term_nt">NT</a>
            for <a href="#term_td">TD</a>, <a href="#term_nr">NR</a> for <a href="#term_hsifs">HSiFS</a>
            and <a href="#term_nc">NC</a> for <a href="#term_um">UM</a>. Also known
            as <a href="#term_perfect">Perfect</a> or a more comprehensive version of the acronym,
            such as \'NMNBNT\' for <a href="#term_td">TD</a>.')?></td>
        </tr>
        <tr id='term_nnnn'>
            <th><?php echo _('NNNN')?></th>
            <td><?php echo _('Used in <a href="#term_wbawc">WBaWC</a> to mean <a href="#term_nmnb">NMNB</a>,
            plus two game-specific restrictions, which are No Berserk Roars (No Hypers)
            and No Roar Breaks (No Hyper Breaks). Also known as <a href="#term_perfect">Perfect</a>.')?></td>
        </tr>
        <tr id='term_nr'>
            <th><?php echo _('NR')?></th>
            <td><?php echo _('No Release; used in <a href="#term_hsifs">HSiFS</a> to mean a clear without using releases; that is, without pressing the C key. ' .
            'In Japan, this is also used in <a href="#term_pcb">PCB</a>, to mean <a href="#term_nbb">NBB</a>.')?></td>
        </tr>
        <tr id='term_nt'>
            <th><?php echo _('NT')?></th>
            <td><?php echo _('No Trance; used in <a href="#term_td">TD</a> to mean a clear without using manual trances; that is, without pressing the C key.')?></td>
        </tr>
        <tr id='term_nufo'>
            <th><?php echo _('NUFO')?></th>
            <td><?php echo _('(Uncommon) No UFO summons; used in <a href="#term_ufo">UFO</a> to mean a clear without summoning UFOs. Because of the length of the acronym, <a href="#term_nv">NV</a> is often used instead.')?></td>
        </tr>
        <tr id='term_nv'>
            <th><?php echo _('NV')?></th>
            <td><?php echo _('No Ventora (Japanese for UFO summons); used in <a href="#term_ufo">UFO</a> to mean a clear without summoning UFOs.
            In Japanese, this also means not picking up any tokens at all.')?></td>
        </tr>
        <tr id='term_opener'>
            <th><?php echo _('Opener')?></th>
            <td><?php echo _('The first nonspell of a boss, which is the first attack that they use, unless there are only Spell Cards.')?></td>
        </tr>
        <tr id='term_overflow'>
            <th><?php echo _('Overflow')?></th>
            <td><?php echo _('When a number becomes higher than its maximum value, causing strange behaviour. Notoriously occurs in <a href="#term_ufo">UFO</a>, ' .
            'in which the score will be displayed wrongly once it reaches higher than 2,147,483,647. It loops back to 0 again once it reaches 4,294,967,295. ' .
            'Not to be confused with <a href="#term_counterstop">counterstop</a> or <a href="#term_underflow">underflow</a>.')?></td>
        </tr>
        <tr id='term_od'>
            <th><?php echo _('OD')?></th>
            <td><?php echo _('Overdrive; the difficulty above Lunatic that is used for a select few unlockable Spell Cards in <a href="#term_td">TD</a>.')?></td>
        </tr>
        <tr id='term_pb'>
            <th><?php echo _('PB')?></th>
            <td><?php echo _('Personal Best; someone\'s highest score or best survival in a specific category.')?></td>
        </tr>
        <tr id='term_pcb'>
            <th>PCB</th>
            <td><?php echo _('Touhou 7: Perfect Cherry Blossom.')?></td>
        </tr>
        <tr id='term_perfect'>
            <th><?php echo _('Perfect')?></th>
            <td><?php echo _('See <a href="#term_nmnb">NMNB</a> or <a href="#term_nnn">NNN</a>.')?></td>
        </tr>
        <tr id='term_pausebuffering'>
            <th><?php echo _('Pause buffering')?></th>
            <td><?php echo _('Repeatedly pausing the game in order to make reading and dodging a pattern easier. Doing this during a run is commonly considered cheating.')?></td>
        </tr>
        <tr id='term_penult'>
            <th><?php echo _('Penult')?></th>
            <td><?php echo _('The penultimate Spell Card of a boss fight.')?></td>
        </tr>
        <tr id='term_ph'>
            <th><?php echo _('Ph')?></th>
            <td><?php echo _('Phantasm; the Phantasm Stage in <a href="#term_pcb">PCB</a>.')?></td>
        </tr>
        <tr id='term_piv'>
            <th><?php echo _('PIV')?></th>
            <td><?php echo _('Point Item Value; the number of points awarded for collecting a point item (blue item). The higher up on the screen you are, the higher the value is, ' .
            'with the maximum value at the <a href="#term_poc">PoC</a>. Most games have a system that allows the player to increase this value in some way.')?></td>
        </tr>
        <tr id='term_pointblanking'>
            <th><?php echo _('Pointblanking')?></th>
            <td><?php echo _('See <a href="#term_shotgunning">shotgunning</a>.')?></td>
        </tr>
        <tr id='term_poc'>
            <th><?php echo _('PoC')?></th>
            <td><?php echo _('Point of Collection; this is the area at the top of the screen that, when entered,
            makes your character automatically collect all items on screen. In <a href="#term_td">TD</a>,
            this does not work on spirits. Also used as a verb, e.g. \'poccing\', to mean collecting
            items this way.')?></td>
        </tr>
        <tr id='term_podd'>
            <th>PoDD</th>
            <td><?php echo _('Touhou 3: Phantasmagoria of Dim.Dream.')?></td>
        </tr>
        <tr id='term_pofv'>
            <th>PoFV</th>
            <td><?php echo _('Touhou 9: Phantasmagoria of Flower View.')?></td>
        </tr>
        <tr id='term_ragephase'>
            <th><?php echo _('Rage phase')?></th>
            <td><?php echo _('See <a href="#term_timeoutphase">timeout phase</a>.')?></td>
        </tr>
        <tr id='term_resources'>
            <th><?php echo _('Resources')?></th>
            <td><?php echo _('Extra lives and bombs, the tools given to you to survive through a game with. Making good use of them is known as \'resource management\'. ' .
            'Resources are often denoted with the \'x/y\' notation, for example 0/0 for when the player has no extra lives and bombs left.')?></td>
        </tr>
        <tr id='term_restreaming'>
            <th><?php echo _('Restreaming')?></th>
            <td><?php echo _('Changing your <a href="#term_streaming">streaming</a> direction, usually by making a quick, ' .
            'unfocused movement to misdirect the bullets and then streaming into the other direction. Also known as \'cutback\'.')?></td>
        </tr>
        <tr id='term_rng'>
            <th><?php echo _('RNG')?></th>
            <td><?php echo _('Random Number Generator; used to refer to random bullet patterns, which, because of their randomness, do not have a <a href="#term_route">route</a>.')?></td>
        </tr>
        <tr id='term_route'>
            <th>Route</th>
            <td><?php echo _('A specific path used to navigate through one or more bullet patterns. The routing approach is used on both <a href="#term_static">static</a> patterns and patterns aimed at you.')?></td>
        </tr>
        <tr id='term_s1'>
            <th><?php echo _('s1')?></th>
            <td><?php echo _('Stage 1; similarly, \'s2\' means Stage 2, \'s3\' means Stage 3, etc.')?></td>
        </tr>
        <tr id='term_sa'>
            <th>SA</th>
            <td><?php echo _('Touhou 11: Subterranean Animism.')?></td>
        </tr>
        <tr id='term_safespot'>
            <th><?php echo _('Safespot')?></th>
            <td><?php echo _('A spot, or a larger area, inside of which the player cannot be hit by anything. There is a large grey area to the application of the term in practice, as it is not necessarily only used for singular spots;
            it can include safe areas that require the player to move, although safer than doing the pattern in question "normally". It can even include spots or areas that are not actually completely safe,
            just <em>mostly</em> safe.')?></td>
        </tr>
        <tr id='term_scb'>
            <th><?php echo _('SCB')?></th>
            <td><?php echo _('Spell Card Bonus; the score awarded from <a href="#term_capture">capturing</a> a Spell Card.')?></td>
        </tr>
        <tr id='term_shmup'>
            <th><?php echo _('Shmup')?></th>
            <td><?php echo _('Abbreviation of shoot \'em up, which is the genre of games that bullet hell is part of. <a href="#term_stg">STG</a> has the same meaning.')?></td>
        </tr>
        <tr id='term_shotgunning'>
            <th><?php echo _('Shotgunning')?></th>
            <td><?php echo _('Shooting an enemy up close. Typically done with a spreadshot to deal as much damage as possible, as most or all of the shots will hit. Also known as <a href="#term_pointblanking">pointblanking</a>.')?></td>
        </tr>
        <tr id='term_soew'>
            <th>SoEW</th>
            <td><?php echo _('Touhou 2: Story of Eastern Wonderland.')?></td>
        </tr>
        <tr id='term_speedkill'>
            <th><?php echo _('Speedkill')?></th>
            <td><?php echo _('Shooting down an enemy or ending a boss pattern as fast as possible.')?></td>
        </tr>
        <tr id='term_static'>
            <th><?php echo _('Static')?></th>
            <td><?php echo _('A bullet pattern that is always the exact same, and thus can be <a href="#term_route">routed</a>.')?></td>
        </tr>
        <tr id='term_stb'>
            <th>StB</th>
            <td><?php echo _('Touhou 9.5: Shoot the Bullet.')?></td>
        </tr>
        <tr id='term_stg'>
            <th><?php echo _('STG')?></th>
            <td><?php echo _('<strong>S</strong>hoo<strong>t</strong>ing <strong>G</strong>ame; an acronym used to refer to shoot \'em up games, just as <a href="#term_shmup">shmup</a> does. Used primarily by Japanese players.')?></td>
        </tr>
        <tr id='term_streaming'>
            <th><?php echo _('Streaming')?></th>
            <td><?php echo _('Tapping into a certain direction to dodge aimed bullets, making them move behind you in a stream-like fashion. This can be done either horizontally or vertically. ' .
            'If a player comes close to either edge of the screen while doing this, they will want to <a href="#term_restreaming">restream</a> the pattern.')?></td>
        </tr>
        <tr id='term_suicidebullets'>
            <th><?php echo _('Suicide bullets')?></th>
            <td><?php echo _('Extra bullets fired by an enemy when it dies, usually aimed at the player. On Hard or Lunatic difficulty in <a href="#term_gfw">GFW</a>, all enemies fire these.')?></td>
        </tr>
        <tr id='term_survivalspell'>
            <th><?php echo _('Survival spell')?></th>
            <td><?php echo _('A Spell Card during which the boss is invincible, forcing the player to survive until the time is up, which is referred to as a <a href="#term_timeout">timeout</a>. ' .
            'Because of this, such a spell is also known as a \'timeout spell\'.')?></td>
        </tr>
        <tr id='term_tas'>
            <th><?php echo _('TAS')?></th>
            <td><?php echo _('Tool-Assisted Superplay; used to refer not to speedruns, but to runs that used external tools, such as slowing down the game, savestates and <a href="#term_pausebuffering">pause buffering</a>,
            which is often done to see what is theoretically possible in a game.')?></td>
        </tr>
        <tr id='term_td'>
            <th>TD</th>
            <td><?php echo _('Touhou 13: Ten Desires.')?></td>
        </tr>
        <tr id='term_thcrap'>
            <th><?php echo _('Thcrap')?></th>
            <td><?php echo _('<strong>T</strong>ou<strong>h</strong>ou <strong>C</strong>ommunity <strong>R</strong>eliant <strong>A</strong>utomatic <strong>P</strong>atcher, ' .
            'a translation and modding tool; see <a href="/tools#thcrap">Touhou Patches and Tools</a> for more information. Not to be confused with <a href="#term_thprac">thprac</a>.')?></td>
        </tr>
        <tr id='term_thprac'>
            <th><?php echo _('Thprac')?></th>
            <td><?php echo _('Universal practice tool; see <a href="/tools#thprac">Touhou Patches and Tools</a> for more information. Not to be confused with <a href="#term_thcrap">thcrap</a>.')?></td>
        </tr>
        <tr id='term_timelock'>
            <th><?php echo _('Timelock')?></th>
            <td><?php echo _('A feature in <a href="#term_thprac">thprac</a> that allows the player to lock the timer on a boss pattern, so that it never ends. Typically used to practice dodging skills.')?></td>
        </tr>
        <tr id='term_timeout'>
            <th><?php echo _('Timeout')?></th>
            <td><?php echo _('Surviving a pattern until the time is up. <a href="#term_survivalspell">Survival spells</a>, Spell Cards that force this on the player, are also called timeout spells.')?></td>
        </tr>
        <tr id='term_timeoutphase'>
            <th><?php echo _('Timeout phase')?></th>
            <td><?php echo _('A (very) hard phase of a Spell Card that starts when you get close to timing it out. ' .
            'They typically start when the timer is at 30 seconds and they are typically found on final Spell Cards in final boss or Extra boss fights.')?></td>
        </tr>
        <tr id='term_to'>
            <th><?php echo _('TO')?></th>
            <td><?php echo _('(Uncommon) see <a href="#term_timeout">timeout</a>.')?></td>
        </tr>
        <tr id='term_token'>
            <th><?php echo _('Token')?></th>
            <td><?php echo _('Refers to either a small <a href="#term_ufo">UFO</a> or a beast in <a href="#term_wbawc">WBaWC</a>, both of which float around the screen.')?></td>
        </tr>
        <tr id='term_ufo'>
            <th>UFO</th>
            <td><?php echo _('Touhou 12: Undefined Fantastic Object.')?></td>
        </tr>
        <tr id='term_um'>
            <th>UM</th>
            <td><?php echo _('Touhou 18: Unconnected Marketeers.')?></td>
        </tr>
        <tr id='term_underflow'>
            <th><?php echo _('Underflow')?></th>
            <td><?php echo _('When a negative number is converted to a format that does not have negative numbers, causing a very high positive number. Notoriously occurs in <a href="#term_ddc">DDC</a> ' .
            'and <a href="#term_isc">ISC</a>, in which the Spell Card Bonus can be made negative, which, if the score becomes negative when the bonus is added, increases the score to 9,999,999,990, ' .
            'a <a href="#term_counterstop">counterstop</a>. Not to be confused with <a href="#term_overflow">overflow</a>.')?></td>
        </tr>
        <tr id='term_vd'>
            <th>VD</th>
            <td><?php echo _('Touhou 16.5: Violet Detector.')?></td>
        </tr>
        <tr id='term_wall'>
            <th><?php echo _('Wall')?></th>
            <td><?php echo _('A cluster of bullets with no space that a hitbox can pass through in between them, although it can also refer to a cluster of bullets that <em>looks</em> like that.')?></td>
        </tr>
        <tr id='term_wbawc'>
            <th>WBaWC</th>
            <td><?php echo _('Touhou 17: Wily Beast and Weakest Creature.')?></td>
        </tr>
    </tbody>
</table>
<h1 id='spells'><?php echo _('Common Spell Card / Pattern Acronyms') ?></h1>
<p><?php echo _('These acronyms for particular patterns usually refer to the Lunatic difficulty version of the abbreviated Spell Card or pattern.') ?></p>
<table id='spelltable' class='noborders'>
    <thead>
        <tr>
            <th class='jargon'><?php echo _('Acronym') ?><hr></th>
            <th><?php echo _('Spell Card / Pattern') ?><hr></th>
        </tr>
    </thead>
    <tbody>
        <tr id='term_aoj'>
            <th><?php echo _('AoJ')?></th>
            <td><?php echo _('"Aura of Justice", Shou\'s second spell in <a href="#term_ufo">UFO</a>.')?></td>
        </tr>
        <tr id='term_bd'>
            <th><?php echo _('BD')?></th>
            <td><?php echo _('"Buddhist Diamond", Kaguya\'s second Spell Card in <a href="#term_in">IN</a>.')?></td>
        </tr>
        <tr id='term_bdb'>
            <th><?php echo _('BDB')?></th>
            <td><?php echo _('"Brilliant Dragon Bullet", Kaguya\'s first Spell Card in <a href="#term_in">IN</a>.')?></td>
        </tr>
        <tr id='term_bls'>
            <th><?php echo _('BLS')?></th>
            <td><?php echo _('"Blue Lady Show", Raiko\'s <a href="#term_survivalspell">survival Spell Card</a> in <a href="#term_ddc">DDC</a>.')?></td>
        </tr>
        <tr id='term_bolad'>
            <th><?php echo _('BoLaD')?></th>
            <td><?php echo _('"Border of Life and Death", Yukari\'s semifinal Spell Card in <a href="#term_pcb">PCB</a>.')?></td>
        </tr>
        <tr id='term_books'>
            <th><?php echo _('Books')?></th>
            <td><?php echo _('The section of <a href="#term_eosd">EoSD</a> Stage 4 where books spawn in random locations and repeatedly shoot green bullets.')?></td>
        </tr>
        <tr id='term_bowap'>
            <th><?php echo _('BoWaP')?></th>
            <td><?php echo _('"Border of Wave and Particle", Satori\'s final Spell Card if you use ReimuA in <a href="#term_sa">SA</a>.')?></td>
        </tr>
        <tr id='term_catswalk'>
            <th><?php echo _('Cats Walk')?></th>
            <td><?php echo _('"Vengeful Cat Spirit\'s Erratic Step", Rin\'s midboss Spell Card in <a href="#term_sa">SA</a> Stage 5. This is the name on Easy and Normal only, but it\'s used for Lunatic regardless.')?></td>
        </tr>
        <tr id='term_cc'>
            <th><?php echo _('CC')?></th>
            <td><?php echo _('"Complete Clarification", Shou\'s final Spell Card in <a href="#term_ufo">UFO</a>.')?></td>
        </tr>
        <tr id='term_dbdb'>
            <th><?php echo _('DBDB')?></th>
            <td><?php echo _('"Double Black Death Butterfly", Satori\'s first ReimuA-specific Spell Card in <a href="#term_sa">SA</a>.')?></td>
        </tr>
        <tr id='term_dr'>
            <th><?php echo _('DR')?></th>
            <td><?php echo _('"Devil\'s Recitation", Byakuren\'s fourth Spell Card in <a href="#term_ufo">UFO</a>.')?></td>
        </tr>
        <tr id='term_fin'>
            <th><?php echo _('FIN')?></th>
            <td><?php echo _('"Flying Insect\'s Nest", Satori\'s second ReimuA-specific Spell Card in <a href="#term_sa">SA</a>.')?></td>
        </tr>
        <tr id='term_gc'>
            <th><?php echo _('GC')?></th>
            <td><?php echo _('"Geometric Creature", Keiki\'s penultimate Spell Card in <a href="#term_wbawc">WBaWC</a>.')?></td>
        </tr>
        <tr id='term_ghostwheels'>
            <th><?php echo _('Ghost Wheels')?></th>
            <td><?php echo _('"The Needles of Yore and the Vengeful Spirits in Pain", Rin\'s third Spell Card in <a href="#term_sa">SA</a>. Also known as \'needles\' or just \'wheels\'.')?></td>
        </tr>
        <tr id='term_go'>
            <th><?php echo _('GO')?></th>
            <td><?php echo _('"Good Omen", Byakuren\'s first Spell Card in <a href="#term_ufo">UFO</a>. Not to be confused with <a href="#term_gameover">game over</a>.')?></td>
        </tr>
        <tr id='term_gt'>
            <th><?php echo _('GT')?></th>
            <td><?php echo _('"Greatest Treasure", Nazrin\'s midboss Spell Card in <a href="#term_ufo">UFO</a> Stage 5.')?></td>
        </tr>
        <tr id='term_hbcb'>
            <th><?php echo _('HBCB')?></th>
            <td><?php echo _('"Hidden Breezy Cherry Blossom", Okina\'s final Spell Card if you use the Spring season in <a href="#term_hsifs">HSiFS</a>. Also known as \'BCB\'.')?></td>
        </tr>
        <tr id='term_hcfw'>
            <th><?php echo _('HCFW')?></th>
            <td><?php echo _('"Hidden Crazy Fall Wind", Okina\'s final Spell Card if you use the Autumn season in <a href="#term_hsifs">HSiFS</a>. Also known as \'CFW\'.')?></td>
        </tr>
        <tr id='term_hew'>
            <th><?php echo _('HEW')?></th>
            <td><?php echo _('"Hidden Extreme Winter", Okina\'s final Spell Card if you use the Winter season in <a href="#term_hsifs">HSiFS</a>. Also known as \'EW\'.')?></td>
        </tr>
        <tr id='term_hgs'>
            <th><?php echo _('HGS')?></th>
            <td><?php echo _('"Hell God Sword", Youmu\'s first Spell Card in <a href="#term_pcb">PCB</a>.')?></td>
        </tr>
        <tr id='term_hpsi'>
            <th><?php echo _('HPSI')?></th>
            <td><?php echo _('"Hidden Perfect Summer Ice", Okina\'s final Spell Card if you use the Summer season in <a href="#term_hsifs">HSiFS</a>. Also known as \'PSI\'.')?></td>
        </tr>
        <tr id='term_hj'>
            <th><?php echo _('HJ')?></th>
            <td><?php echo _('"Hourai Jewel", Kaguya\'s final Spell Card that is not a <a href="#term_ls">Last Spell</a> in <a href="#term_in">IN</a>.')?></td>
        </tr>
        <tr id='term_hmd'>
            <th><?php echo _('HMD')?></th>
            <td><?php echo _('"Honest Man\'s Death", Mokou\'s fifth Spell Card in <a href="#term_in">IN</a>.')?></td>
        </tr>
        <tr id='term_id'>
            <th><?php echo _('ID')?></th>
            <td><?php echo _('"Idola Diabolus", Keiki\'s final Spell Card in <a href="#term_wbawc">WBaWC</a>.')?></td>
        </tr>
        <tr id='term_is'>
            <th><?php echo _('IS')?></th>
            <td><?php echo _('"Imperishable Shooting", Mokou\'s final Spell Card in <a href="#term_in">IN</a>.')?></td>
        </tr>
        <tr id='term_kd'>
            <th><?php echo _('KD')?></th>
            <td><?php echo _('"Killing Doll", Sakuya\'s final Spell Card in <a href="#term_eosd">EoSD</a>.')?></td>
        </tr>
        <tr id='term_kks'>
            <th><?php echo _('KKS')?></th>
            <td><?php echo _('"King Kraken Strike", Ichirin\'s first Spell Card in <a href="#term_ufo">UFO</a>.')?></td>
        </tr>
        <tr id='term_lc'>
            <th><?php echo _('LC')?></th>
            <td><?php echo _('"Linear Creature", Keiki\'s third Spell Card in <a href="#term_wbawc">WBaWC</a>. Also known as "lines".')?></td>
        </tr>
        <tr id='term_lfs'>
            <th><?php echo _('LFS')?></th>
            <td><?php echo _('"Legendary Flying Saucer", Byakuren\'s final Spell Card in <a href="#term_ufo">UFO</a>.')?></td>
        </tr>
        <tr id='term_mdsw'>
            <th><?php echo _('MDSW')?></th>
            <td><?php echo _('"Modern Divine Spirit World", Junko\'s third Spell Card in <a href="#term_lolk">LoLK</a>.')?></td>
        </tr>
        <tr id='term_nds'>
            <th><?php echo _('NDS')?></th>
            <td><?php echo _('"Newborn Divine Spirit", Miko\'s final Spell Card in <a href="#term_td">TD</a>.')?></td>
        </tr>
        <tr id='term_nueball'>
            <th><?php echo _('Nueball')?></th>
            <td><?php echo _('Refers to both the Stage 4 midboss and Stage 6 midboss in <a href="#term_ufo">UFO</a>.')?></td>
        </tr>
        <tr id='term_peta'>
            <th><?php echo _('Peta')?></th>
            <td><?php echo _('"Peta Flare", Utsuho\'s second Spell Card in <a href="#term_sa">SA</a>.')?></td>
        </tr>
        <tr id='term_pdh'>
            <th><?php echo _('PDH')?></th>
            <td><?php echo _('"Pristine Danmaku Hell", Junko\'s final Spell Card in <a href="#term_lolk">LoLK</a>.')?></td>
        </tr>
        <tr id='term_pwg'>
            <th><?php echo _('PWG')?></th>
            <td><?php echo _('"Peerless Wind God", Aya\'s <a href="#term_survivalspell">survival Spell Card</a> in <a href="#term_mof">MoF</a>.')?></td>
        </tr>
        <tr id='term_qed'>
            <th><?php echo _('QED')?></th>
            <td><?php echo _('QED "Ripples of 495 Years", Flandre\'s final Spell Card in <a href="#term_eosd">EoSD</a>.')?></td>
        </tr>
        <tr id='term_rain'>
            <th><?php echo _('Rain')?></th>
            <td><?php echo _('The section of <a href="#term_lolk">LoLK</a> Stage 6 where blue bullets spawn in a rain pattern, combined with aimed red stars.')?></td>
        </tr>
        <tr id='term_rb'>
            <th><?php echo _('RB')?></th>
            <td><?php echo _('"Resurrection Butterfly", Yuyuko\'s final Spell Card in <a href="#term_pcb">PCB</a>.')?></td>
        </tr>
        <tr id='term_rings'>
            <th><?php echo _('Rings')?></th>
            <td><?php echo _('The final section of <a href="#term_lls">LLS</a> Stage 5.')?></td>
        </tr>
        <tr id='term_ringsofdeath'>
            <th><?php echo _('Rings of Death')?></th>
            <td><?php echo _('Mokou\'s final non in <a href="#term_in">IN</a>.')?></td>
        </tr>
        <tr id='term_rrop'>
            <th><?php echo _('RRoP')?></th>
            <td><?php echo _('"Rainbow Ring of People", Chimata\'s survival Spell Card in <a href="#term_um">UM</a>.')?></td>
        </tr>
        <tr id='term_rtg'>
            <th><?php echo _('RTG')?></th>
            <td><?php echo _('"Radiant Treasure Gun", Shou\'s first Spell Card in <a href="#term_ufo">UFO</a>.')?></td>
        </tr>
        <tr id='term_rw'>
            <th><?php echo _('RW')?></th>
            <td><?php echo _('"Rising World", Kaguya\'s final <a href="#term_ls">Last Spell</a> in <a href="#term_in">IN</a>.')?></td>
        </tr>
        <tr id='term_sg'>
            <th><?php echo _('SG')?></th>
            <td><?php echo _('"Scarlet Gensokyo", Remilia\'s final Spell Card in <a href="#term_eosd">EoSD</a>. Also commonly called \'Gensokyo\'.')?></td>
        </tr>
        <tr id='term_sm'>
            <th><?php echo _('SM')?></th>
            <td><?php echo _('"Scarlet Meister", Remilia\'s semifinal Spell Card in <a href="#term_eosd">EoSD</a>. Also commonly called \'Meister\'.')?></td>
        </tr>
        <tr id='term_spam'>
            <th><?php echo _('Spam')?></th>
            <td><?php echo _('If said without context, typically refers to the final section of Stage 6 in <a href="#term_pcb">PCB</a>. It can also refer to any other "bullet spam" stage section, typically with added context (such as "HSiFS Stage 4 spam").')?></td>
        </tr>
        <tr id='term_subsun'>
            <th><?php echo _('Subsun')?></th>
            <td><?php echo _('"Subterranean Sun", Utsuho\'s final Spell Card in <a href="#term_sa">SA</a>.')?></td>
        </tr>
        <tr id='term_sumizome'>
            <th><?php echo _('Sumizome')?></th>
            <td><?php echo _('"Perfect Ink-Black Cherry Blossom -Bloom-", Yuyuko\'s penultimate Spell Card in <a href="#term_pcb">PCB</a>. "Sumizome" comes from the old English translation patch.')?></td>
        </tr>
        <tr id='term_tss'>
            <th><?php echo _('TSS')?></th>
            <td><?php echo _('"Trembling Shivering Star", Junko\'s fourth Spell Card in <a href="#term_lolk">LoLK</a>.')?></td>
        </tr>
        <tr id='term_unr'>
            <th><?php echo _('UNR')?></th>
            <td><?php echo _('"Uncontainable Nuclear Reaction", Utsuho\'s first Spell Card in <a href="#term_sa">SA</a>.')?></td>
        </tr>
        <tr id='term_vi'>
            <th><?php echo _('VI')?></th>
            <td><?php echo _('"Vampire Illusion", Remilia\'s third Spell Card in <a href="#term_eosd">EoSD</a>.')?></td>
        </tr>
        <tr id='term_vowg'>
            <th><?php echo _('VoWG')?></th>
            <td><?php echo _('"Virtue of Wind God", Kanako\'s final Spell Card in <a href="#term_mof">MoF</a>. Occasionally it will be called \'DVoWG\' (D for Divine), ' .
            'because of either the translation as of 2020 or the old English translation patch.')?></td>
        </tr>
        <tr id='term_ydl'>
            <th><?php echo _('YDL')?></th>
            <td><?php echo _('"Young Demon Lord", Remilia\'s first Spell Card in <a href="#term_eosd">EoSD</a>.')?></td>
        </tr>
        <tr id='term_ygb'>
            <th><?php echo _('YGB')?></th>
            <td><?php echo _('"You Grow Bigger!", Shinmyoumaru\'s <a href="#term_survivalspell">survival Spell Card</a> in <a href="#term_ddc">DDC</a>.')?></td>
        </tr>
        <tr id='term_yydo'>
            <th><?php echo _('YYDO')?></th>
            <td><?php echo _('"Yin-Yang Divine Orbs", Misumaru\'s first Spell Card in <a href="#term_um">UM</a>.')?></td>
        </tr>
    </tbody>
</table>
<h1 id='bullets'><?php echo _('Bullet Type Names') ?></h1>
<table id='bullettable' class='noborders'>
    <thead>
        <tr>
            <th class='jargon'><?php echo _('Name') ?><hr></th>
            <th><?php echo _('Bullet') ?><hr></th>
        </tr>
    </thead>
    <tbody>
        <tr id='term_amulet'>
            <th><?php echo _('Amulet')?></th>
            <td><img src='/assets/games/faq/bullets/amulet.png' alt='Amulet bullet'></td>
        </tr>
        <tr id='term_arrow'>
            <th><?php echo _('Arrow')?></th>
            <td><img src='/assets/games/faq/bullets/arrow.png' alt='Arrow bullet'></td>
        </tr>
        <tr id='term_arrowhead'>
            <th><?php echo _('Arrowhead')?></th>
            <td><img src='/assets/games/faq/bullets/arrowhead.png' alt='Arrowhead'></td>
        </tr>
        <tr id='term_bacteria'>
            <th><?php echo _('Bacteria, dark rice')?></th>
            <td><img src='/assets/games/faq/bullets/bacteria.png' alt='Bacteria'></td>
        </tr>
        <tr id='term_ball'>
            <th><?php echo _('Ball')?></th>
            <td><img src='/assets/games/faq/bullets/ball.png' alt='Ball'></td>
        </tr>
        <tr id='term_balloutline'>
            <th><?php echo _('Ball (outlined)')?></th>
            <td><img src='/assets/games/faq/bullets/balloutline.png' alt='Ball (outlined)'></td>
        </tr>
        <tr id='term_bubble'>
            <th><?php echo _('Bubble')?></th>
            <td><img src='/assets/games/faq/bullets/bubble.png' alt='Bubble'></td>
        </tr>
        <tr id='term_bullet'>
            <th><?php echo _('Bullet')?></th>
            <td><img src='/assets/games/faq/bullets/bullet.png' alt='OG bullet'></td>
        </tr>
        <tr id='term_butterfly'>
            <th><?php echo _('Butterfly')?></th>
            <td><img src='/assets/games/faq/bullets/butterfly.png' alt='Butterfly'></td>
        </tr>
        <tr id='term_coin'>
            <th><?php echo _('Coin')?></th>
            <td><img src='/assets/games/faq/bullets/coin.png' alt='Coin'></td>
        </tr>
        <tr id='term_fireball'>
            <th><?php echo _('Fireball')?></th>
            <td><img src='/assets/games/faq/bullets/fireball.png' alt='Fireball'></td>
        </tr>
        <tr id='term_glowshit'>
            <th><?php echo _('Fireball (glowy)')?></th>
            <td><img src='/assets/games/faq/bullets/glowshit.png' alt='Fireball (glowy)'></td>
        </tr>
        <tr id='term_heart'>
            <th><?php echo _('Heart')?></th>
            <td><img src='/assets/games/faq/bullets/heart.png' alt='Heart'></td>
        </tr>
        <tr id='term_jellybean'>
            <th><?php echo _('Jellybean')?></th>
            <td><img src='/assets/games/faq/bullets/jellybean.png' alt='Jellybean'></td>
        </tr>
        <tr id='term_knife'>
            <th><?php echo _('Knife')?></th>
            <td><img src='/assets/games/faq/bullets/knife.png' alt='Knife'></td>
        </tr>
        <tr id='term_kunai'>
            <th><?php echo _('Kunai')?></th>
            <td><img src='/assets/games/faq/bullets/kunai.png' alt='Kunai'></td>
        </tr>
        <tr id='term_mentos'>
            <th><?php echo _('Mentos')?></th>
            <td><img src='/assets/games/faq/bullets/mentos.png' alt='Mentos'></td>
        </tr>
        <tr id='term_note'>
            <th><?php echo _('Note')?></th>
            <td><img src='/assets/games/faq/bullets/note.png' alt='Note'></td>
        </tr>
        <tr id='term_orb'>
            <th><?php echo _('Orb')?></th>
            <td><img src='/assets/games/faq/bullets/orb.png' alt='Orb'></td>
        </tr>
        <tr id='term_pellet'>
            <th><?php echo _('Pellet')?></th>
            <td><img src='/assets/games/faq/bullets/pellet.png' alt='Pellet'></td>
        </tr>
        <tr id='term_popcorn'>
            <th><?php echo _('Popcorn')?></th>
            <td><img src='/assets/games/faq/bullets/popcorn.png' alt='Popcorn'></td>
        </tr>
        <tr id='term_raindrop'>
            <th><?php echo _('Raindrop, droplet')?></th>
            <td><img src='/assets/games/faq/bullets/raindrop.png' alt='Raindrop'></td>
        </tr>
        <tr id='term_rest'>
            <th><?php echo _('Rest')?></th>
            <td><img src='/assets/games/faq/bullets/rest.png' alt='Rest'></td>
        </tr>
        <tr id='term_rice'>
            <th><?php echo _('Rice')?></th>
            <td><img src='/assets/games/faq/bullets/rice.png' alt='Rice'></td>
        </tr>
        <tr id='term_rose'>
            <th><?php echo _('Rose')?></th>
            <td><img src='/assets/games/faq/bullets/rose.png' alt='Rose'></td>
        </tr>
        <tr id='term_shard'>
            <th><?php echo _('Shard, icicle')?></th>
            <td><img src='/assets/games/faq/bullets/shard.png' alt='Shard'></td>
        </tr>
        <tr id='term_star'>
            <th><?php echo _('Star (big)')?></th>
            <td><img src='/assets/games/faq/bullets/star.png' alt='Star (big)'></td>
        </tr>
        <tr id='term_stars'>
            <th><?php echo _('Star (small)')?></th>
            <td><img src='/assets/games/faq/bullets/starsmall.png' alt='Star (small)'></td>
        </tr>
    </tbody>
</table>
