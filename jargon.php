<!DOCTYPE html>
<html id='top' lang='en'>
<?php
	include 'assets/shared/shared.php';
    require_once 'assets/shared/mobile_detect.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
    $detect_device = new Mobile_Detect;
    $is_mobile = $detect_device -> isMobile();
?>

	<head>
		<title>Touhou Community Jargon</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
		<meta name='description' content='Explanations of Touhou gameplay community jargon, such as achievements and Spell Card acronyms.'>
        <meta name='keywords' content='touhou, touhou project, community, jargon, terms, terminology, acronyms, abbreviations'>
		<link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=<?php echo $page . '&mobile=' . $is_mobile ?>'>
		<link rel='icon' type='image/x-icon' href='assets/jargon/jargon.ico'>
        <script src='assets/shared/js_concat.php' defer></script>
	</head>

    <body>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <span id='hy_container'><span id='hy'></span>
		            <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
		        </span>
                <h1>Touhou Community Jargon</h1>
    			<?php
    				if (!empty($_GET['redirect'])) {
    					echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
    				}
    			?>
                <p>This list contains explanations for terms and acronyms used in the community of Touhou players. It also contains general gaming and shoot 'em up terms that are relevant to Touhou.</p>
                <h2>Contents</h2>
                <div id='contents' class='border'>
                    <p><a href='#spells'>Spell Card / Pattern Acronyms</a></p>
                    <p><a href='#bullets'>Bullet Type Names</a></p>
                </div>
                <h2 id='main'>Gameplay Related Terms</h2>
                <table id='jargontable'>
                    <thead>
                        <tr>
                            <th class='jargon'>Jargon<hr></th>
                            <th>Meaning<hr></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id='term_0/0'>
                            <th>0/0</th>
                            <td>0 extra lives and 0 bombs, the point at which the player has no <a href='#term_resources'>resources</a> left and is thus forced to survive all of the upcoming patterns to still clear.
                            The 'x/y' notation is often used to denote the number of spare lives and bombs a player has at a given point in time in a run.</td>
                        </tr>
                        <tr id='term_10D'>
                            <th>10D</th>
                            <td>If you use this, please switch to using <a href='#term_td'>TD</a> for that game now.</td>
                        </tr>
                        <tr id='term_1cc'>
                            <th>1cc</th>
                            <td>1 credit clear; a clear without using continues, which is equivalent to only using one coin if playing on an arcade machine, the origin of the term.
                            This is the primary goal that people will have in a game when starting to play it.</td>
                        </tr>
                        <tr id='term_bottomhugging'>
                            <th>Bottomhugging</th>
                            <td>Being at the bottom of the screen all the time while playing, a tendency that newer players often have, due to being afraid of the bullets and
                            wanting to be as far away from them as possible. While sometimes useful, this is not always the best general strategy.</td>
                        </tr>
                        <tr id='term_cancel'>
                            <th>Cancel</th>
                            <td>Bullets being converted into items, effectively wiping them from the screen, which is often important for score.
                            This occurs when the player ends a boss pattern by shooting the boss, but can have several other causes too, such as enemies that cancel their bullets when killed, or bombing.</td>
                        </tr>
                        <tr id='term_capture'>
                            <th>Cap</th>
                            <td>Abbreviation of 'capture'; a Spell Card being dodged without dying or bombing, which awards a Spell Card Bonus.</td>
                        </tr>
                        <tr id='term_clipdeath'>
                            <th>Clipdeath</th>
                            <td>Dying because of wrongly estimating bullet hitbox size(s).</td>
                        </tr>
                        <tr id='term_counterstop'>
                            <th>Counterstop</th>
                            <td>The point at which the score counter stops increasing; the score limit of a game. Sometimes this is reachable, but most of the time it is not.
                            Not to be confused with <a href='#term_overflow'>overflow</a> or <a href='#term_underflow'>underflow</a>.</td>
                        </tr>
						<tr id='term_cs'>
							<th>CS</th>
							<td>See <a href='#term_counterstop'>counterstop</a>.</td>
						</tr>
                        <tr id='term_db'>
                            <th>DB</th>
                            <td>Deathbomb; a bomb within a few frames after getting hit, which saves you from dying.</td>
                        </tr>
                        <tr id='term_ds'>
                            <th>DS</th>
                            <td>Touhou 12.5: Double Spoiler.</td>
                        </tr>
                        <tr id='term_eosd'>
                            <th>EoSD</th>
                            <td>Touhou 6: the Embodiment of Scarlet Devil.</td>
                        </tr>
                        <tr id='term_exnn'>
                            <th>ExNN</th>
                            <td>Extra No Miss No Bomb; a <a href='#term_1cc'>1cc</a> of some Extra Stage without dying or using bombs.
							A third 'N' is appended if there is a game-specific third restriction.</td>
                        </tr>
                        <tr id='term_fs'>
                            <th>FS</th>
                            <td>Full Spell; a run that captures all Spell Cards.</td>
                        </tr>
						<tr id='term_fw'>
							<th>FW</th>
							<td>See <a href='#term_gfw'>GFW</a>.</td>
						</tr>
						<tr id='term_gfw'>
							<th>GFW</th>
							<td>Touhou 12.8: Great Fairy Wars.</td>
						</tr>
                        <tr id='term_gameover'>
                            <th>GO</th>
                            <td>(Uncommon) Game over. Not to be confused with <a href='#term_go'>"Good Omen"</a>, a Spell Card.</td>
                        <tr id='term_graze'>
                            <th>Graze</th>
                            <td>Having a bullet come very close to your hitbox, which means it touches your 'grazebox', a hitbox larger than your main hitbox that is used to detect grazing.</td>
                        </tr>
                        <tr id='term_hitbox'>
                            <th>Hitbox</th>
                            <td>The part of a sprite that is used for collision detection; that is, the part of the player character or an enemy that can get hit, and the part of a bullet that kills you when touched.
                            In Touhou, hitboxes of a sprite are smaller than the full size of the sprite.</td>
                        </tr>
						<tr id='term_hsifs'>
							<th>HSiFS</th>
							<td>Touhou 16: Hidden Star in Four Seasons.</td>
						</tr>
                        <tr id='term_iframes'>
                            <th>I-frames</th>
                            <td>Invincibility frames; frames during which something does not take any hits. Your player character has a number of I-frames after a death, as well as during a bomb.
                            Under certain circumstances, some enemy characters can also have I-frames.</td>
                        </tr>
                        <tr id='term_isc'>
                            <th>ISC</th>
                            <td>Touhou 14.3: Impossible Spell Card.</td>
                        </tr>
						<tr id='term_in'>
							<th>IN</th>
							<td>Touhou 8: Imperishable Night.</td>
						</tr>
                        <tr id='term_lolk'>
                            <th>LoLK</th>
                            <td>Touhou 15: Legacy of Lunatic Kingdom.</td>
                        </tr>
                        <tr id='term_lnb'>
                            <th>LNB</th>
                            <td>Lunatic No Bomb; a <a href='#term_1cc'>1cc</a> of some game on Lunatic difficulty without using bombs.</td>
                        </tr>
                        <tr id='term_lnn'>
                            <th>LNN</th>
                            <td>Lunatic No Miss No Bomb; a <a href='#term_1cc'>1cc</a> of some game on Lunatic difficulty without dying or using bombs.
							A third 'N' is appended if there is a game-specific third restriction.</td>
                        </tr>
                        <tr id='term_ls'>
                            <th>LS</th>
                            <td>Last Spell; a spell used at the end of an <a href='#term_in'>IN</a> boss fight when the time requirement is met.
							It does not cost a life to die to it.</td>
                        </tr>
                        <tr id='term_lw'>
                            <th>LW</th>
                            <td>Last Word; a special spell (and the difficulty of such a spell) used by an <a href='#term_in'>IN</a> boss,
							which is only available in Spell Practice mode.</td>
                        </tr>
                        <tr id='term_macrododging'>
                            <th>Macrododging</th>
                            <td>Dodging waves of bullets by going around them rather than through them,
							which may or may not be to avoid having to <a href='#term_micrododging'>micrododge</a>.
                            Often abbreviated to 'macro'.</td>
                        </tr>
    					<tr id='term_maingames'>
    						<th>Maingames</th>
    						<td><em>Disputed.</em> Generally means integer games, but the status of PC-98 games
							and <a href='#term_pofv'>PoFV</a> as maingames is not agreed upon. The integer games
							from <a href='#term_eosd'>EoSD</a> to <a href='#term_um'>UM</a>,
							excluding <a href='#term_pofv'>PoFV</a>, are always included.</td>
    					</tr>
                        <tr id='term_memo'>
                            <th>Memo</th>
                            <td>Memorisation; remembering a specific <a href='#term_route'>route</a> for a pattern in order to dodge it.</td>
                        </tr>
                        <tr id='term_micrododging'>
                            <th>Micrododging</th>
                            <td>Dodging dense waves of bullets by navigating through them, usually using small taps to get safely through.
							Often abbreviated to 'micro'.</td>
                        </tr>
                        <tr id='term_milking'>
                            <th>Milking</th>
                            <td>Stalling a pattern for as long as possible to maximise the value of something, which is mostly graze.
							In <a href='#term_gfw'>GFW</a>, players milk freezes instead.</td>
                        </tr>
                        <tr id='term_misdirection'>
                            <th>Misdirection</th>
                            <td>Making aimed bullets go into a direction away from you, to make sure you are safe.</td>
                        </tr>
                        <tr id='term_miss'>
                            <th>Miss</th>
                            <td>Losing a life. This term came from the Japanese transliteration of "mistake", ミステイク misuteiku,
							which has as abbreviation ミス misu, i.e. "miss".</td>
                        </tr>
						<tr id='term_mof'>
							<th>MoF</th>
							<td>Touhou 10: Mountain of Faith.</td>
						</tr>
                        <tr id='term_nonspell'>
                            <th>Non</th>
                            <td>Nonspell; a boss attack that is not a Spell Card.</td>
                        </tr>
                        <tr id='term_nb'>
                            <th>NB</th>
                            <td>No Bomb; a clear without bombing.</td>
                        </tr>
                        <tr id='term_nbb'>
                            <th>NBB</th>
                            <td>No Border Breaks; used in <a href='#term_pcb'>PCB</a> to mean a clear without breaking Supernatural Borders,
							whether it be by getting hit during one or by pressing the X key.</td>
                        </tr>
                        <tr id='term_nf'>
                            <th>NF</th>
                            <td>No Focus; a clear without using focus mode, that is, without pressing Shift.</td>
                        </tr>
                        <tr id='term_nm'>
                            <th>NM</th>
                            <td>No Miss; a clear without dying. Also known as '1 life clear'.</td>
                        </tr>
                        <tr id='term_nmnb'>
                            <th>NMNB</th>
                            <td>No Miss No Bomb; a clear without dying or bombing. Also known as <a href='#term_perfect'>Perfect</a>
							or the even shorter acronym <a href='#term_nn'>NN</a>.</td>
                        </tr>
                        <tr id='term_nn'>
                            <th>NN</th>
                            <td>See <a href='#term_nmnb'>NMNB</a>.</td>
                        </tr>
                        <tr id='term_nnn'>
                            <th>NNN</th>
                            <td><a href='#term_nmnb'>NMNB</a>, plus a game-specific third restriction, which is
                            <a href='#term_nbb'>NBB</a> for <a href='#term_pcb'>PCB</a>, <a href='#term_nv'>NV</a>
							for <a href='#term_ufo'>UFO</a>, <a href='#term_nt'>NT</a>
							for <a href='#term_td'>TD</a>, <a href='#term_nr'>NR</a> for <a href='#term_hsifs'>HSiFS</a>
							and <a href='#term_nc'>NC</a> for <a href='#term_um'>UM</a>. Also known
							as <a href='#term_perfect'>Perfect</a> or a more comprehensive version of the acronym,
							such as 'NMNBNT' for <a href='#term_td'>TD</a>.</td>
                        </tr>
                        <tr id='term_nnnn'>
                            <th>NNNN</th>
                            <td>Used in <a href='#term_wbawc'>WBaWC</a> to mean <a href='#term_nmnb'>NMNB</a>,
							plus two game-specific restrictions, which are No Berserk Roars (No Hypers)
							and No Roar Breaks (No Hyper Breaks). Also known as <a href='#term_perfect'>Perfect</a>.</td>
                        </tr>
                        <tr id='term_nc'>
                            <th>NC</th>
                            <td>No Cards; used in <a href='#term_um'>UM</a> to mean a clear without using any active, equipment or
							passive cards. Cards that do not affect <a href='#term_nmnb'>NMNB</a> play, such as the life card,
							the bomb card and the money card, are exempt from this.</td>
                        </tr>
                        <tr id='term_nr'>
                            <th>NR</th>
                            <td>No Release; used in <a href='#term_hsifs'>HSiFS</a> to mean a clear without using releases; that is, without pressing the C key. In Japan, this is also used in <a href='#term_pcb'>PCB</a>, to mean <a href='#term_nbb'>NBB</a>.</td>
                        </tr>
                        <tr id='term_nt'>
                            <th>NT</th>
                            <td>No Trance; used in <a href='#term_td'>TD</a> to mean a clear without using manual trances; that is, without pressing the C key.</td>
                        </tr>
                        <tr id='term_nufo'>
                            <th>NUFO</th>
                            <td>(Uncommon) No UFO summons; used in <a href='#term_ufo'>UFO</a> to mean a clear without summoning UFOs.
                            Because of the length of the acronym, <a href='#term_nv'>NV</a> is often used instead.</td>
                        </tr>
                        <tr id='term_nv'>
                            <th>NV</th>
                            <td>No Ventora (Japanese for UFO summons); used in <a href='#term_ufo'>UFO</a> to mean a clear without summoning UFOs.
							In Japanese, this also means not picking up any tokens at all.</td>
                        </tr>
                        <tr id='term_opener'>
                            <th>Opener</th>
                            <td>The first nonspell of a boss, which is the first attack that they use, unless there are only Spell Cards.</td>
                        </tr>
                        <tr id='term_overflow'>
                            <th>Overflow</th>
                            <td>When a number becomes higher than its maximum value, causing strange behaviour. Notoriously occurs in <a href='#term_ufo'>UFO</a>,
                            in which the score will be displayed wrongly once it reaches higher than 2,147,483,647. It loops back to 0 again once it reaches 4,294,967,295.
                            Not to be confused with <a href='#term_counterstop'>counterstop</a> or <a href='#term_underflow'>underflow</a>.</td>
                        </tr>
                        <tr id='term_od'>
                            <th>OD</th>
                            <td>Overdrive; the difficulty above Lunatic that is used for a select few unlockable Spell Cards in <a href='#term_td'>TD</a>.</td>
                        </tr>
                        <tr id='term_perfect'>
                            <th>Perfect</th>
                            <td>See <a href='#term_nmnb'>NMNB</a> or <a href='#term_nnn'>NNN</a>.</td>
                        </tr>
                        <tr id='term_pausebuffering'>
                            <th>Pause buffering</th>
                            <td>Repeatedly pausing the game in order to make reading and dodging a pattern easier. Doing this during a run is commonly considered cheating.</td>
                        </tr>
                        <tr id='term_pointblanking'>
                            <th>Pointblanking</th>
                            <td>See <a href='#term_shotgunning'>shotgunning</a>.</td>
                        </tr>
                        <tr id='term_poc'>
                            <th>PoC</th>
                            <td>Point of Collection; this is the area at the top of the screen that, when entered,
							makes your character automatically collect all items on screen. In <a href='#term_td'>TD</a>,
							this does not work on spirits. Also used as a verb, e.g. 'poccing', to mean collecting
							items this way.</td>
                        </tr>
						<tr id='term_pofv'>
							<th>PoFV</th>
							<td>Touhou 9: Phantasmagoria of Flower View.</td>
						</tr>
                        <tr id='term_pb'>
                            <th>PB</th>
                            <td>Personal Best; someone's highest score or best survival in a specific category.</td>
                        </tr>
						<tr id='term_pcb'>
							<th>PCB</th>
							<td>Touhou 7: Perfect Cherry Blossom.</td>
						</tr>
                        <tr id='term_piv'>
                            <th>PIV</th>
                            <td>Point Item Value; the number of points awarded for collecting a point item (blue item).
							The higher up on the screen you are, the higher the value is, with the maximum value at
							the <a href='#term_poc'>PoC</a>. Most games have a system that allows the player to increase
							this value in some way.</td>
                        </tr>
                        <tr id='term_resources'>
                            <th>Resources</th>
                            <td>Extra lives and bombs, the tools given to you to survive through a game with. Making good use of them is known as 'resource management'.
                            Resources are often denoted with the 'x/y' notation, for example 0/0 for when the player has no extra lives and bombs left.</td>
                        </tr>
                        <tr id='term_restreaming'>
                            <th>Restreaming</th>
                            <td>Changing your <a href='#term_streaming'>streaming</a> direction, usually by making a quick, unfocused movement to misdirect the bullets
                            and then streaming into the other direction. Also known as 'cutback'.</td>
                        </tr>
                        <tr id='term_rng'>
                            <th>RNG</th>
                            <td>Random Number Generator; used to refer to random bullet patterns, which, because of their randomness, do not have a <a href='#term_route'>route</a>.</td>
                        </tr>
                        <tr id='term_route'>
                            <th>Route</th>
                            <td>A specific path used to navigate through one or more bullet patterns. The routing approach is used on both <a href='#term_static'>static</a> patterns and patterns aimed at you.</td>
                        </tr>
                        <tr id='term_s1'>
                            <th>s1</th>
                            <td>Stage 1; similarly, 's2' means Stage 2, 's3' means Stage 3, etc.</td>
                        </tr>
                        <tr id='term_shmup'>
                            <th>Shmup</th>
                            <td>Abbreviation of shoot 'em up, which is the genre of games that bullet hell is part of. <a href='#term_stg'>STG</a> has the same meaning.</td>
                        </tr>
                        <tr id='term_shotgunning'>
                            <th>Shotgunning</th>
                            <td>Shooting an enemy up close. Typically done with a spreadshot to deal as much damage as possible, as most or all of the shots will hit. Also known as <a href='#term_pointblanking'>pointblanking</a>.</td>
                        </tr>
                        <!--<tr id='term_spellcard'>
                            <th>Spell Card</th>
                            <td>A bullet pattern that has a name, which, when dodged perfectly, adds a Spell Card Bonus to your score. Dodging one perfectly, that is without dying or bombing,
                            is called a <a href='#term_capture'>capture</a> of that Spell Card. Often abbreviated to 'spell' or 'card'.</td>
                        </tr>-->
                        <tr id='term_speedkill'>
                            <th>Speedkill</th>
                            <td>Shooting down an enemy or ending a boss pattern as fast as possible.</td>
                        </tr>
                        <tr id='term_static'>
                            <th>Static</th>
                            <td>A bullet pattern that is always the exact same, and thus can be <a href='#term_route'>routed</a>.</td>
                        </tr>
                        <tr id='term_streaming'>
                            <th>Streaming</th>
                            <td>Tapping into a certain direction to dodge aimed bullets, making them move behind you in a stream-like fashion. This can be done either horizontally or vertically.
                            If a player comes close to either edge of the screen while doing this, they will want to <a href='#term_restreaming'>restream</a> the pattern.</td>
                        </tr>
						<tr id='term_stb'>
							<th>StB</th>
							<td>Touhou 9.5: Shoot the Bullet.</td>
						</tr>
                        <tr id='term_suicidebullets'>
                            <th>Suicide bullets</th>
                            <td>Extra bullets fired by an enemy when it dies, usually aimed at the player.
							On Hard or Lunatic difficulty in <a href='#term_gfw'>GFW</a>, all enemies fire these.</td>
                        </tr>
                        <tr id='term_survivalspell'>
                            <th>Survival spell</th>
                            <td>A Spell Card during which the boss is invincible,
                            forcing the player to survive until the time is up, which is referred to as a <a href='#term_timeout'>timeout</a>.
                            Because of this, such a spell is also known as a 'timeout spell'.</td>
                        </tr>
						<tr id='term_sa'>
							<th>SA</th>
							<td>Touhou 11: Subterranean Animism.</td>
						</tr>
                        <tr id='term_scb'>
                            <th>SCB</th>
                            <td>Spell Card Bonus; the score awarded from <a href='#term_capture'>capturing</a> a Spell Card.</td>
                        </tr>
                        <tr id='term_stg'>
                            <th>STG</th>
                            <td><strong>S</strong>hoo<strong>t</strong>ing <strong>G</strong>ame; an acronym used to refer to shoot 'em up games, just as <a href='#term_shmup'>shmup</a> does. Used primarily by Japanese players.</td>
                        </tr>
                        <tr id='term_timeout'>
                            <th>Timeout</th>
                            <td>Surviving a pattern until the time is up. <a href='#term_survivalspell'>Survival spells</a>,
                            Spell Cards that force this on the player, are also called timeout spells.</td>
                        </tr>
                        <tr id='term_token'>
                            <th>Token</th>
                            <td>Refers to either a small <a href='#term_ufo'>UFO</a> or a beast
							in <a href='#term_wbawc'>WBaWC</a>, both of which float around the screen.</td>
                        </tr>
                        <tr id='term_tas'>
                            <th>TAS</th>
                            <td>Tool-Assisted Speedrun; used to refer not to speedruns, but to runs that used cheats, such as slowing down the game, using savestates and <a href='#term_pausebuffering'>pause buffering</a>,
                            which is often done to see what is theoretically possible in a game.</td>
                        </tr>
                        <tr id='term_td'>
                            <th>TD</th>
                            <td>Touhou 13: Ten Desires.</td>
                        </tr>
                        <tr id='term_to'>
                            <th>TO</th>
                            <td>(Uncommon) see <a href='#term_timeout'>timeout</a>.</td>
                        </tr>
                        <tr id='term_underflow'>
                            <th>Underflow</th>
                            <td>When a negative number is converted to a format that does not have negative numbers, causing a very high positive number. Notoriously occurs in <a href='#term_ddc'>DDC</a>
                            and  <a href='#term_isc'>ISC</a>, in which the Spell Card Bonus can be made negative, which, if the score becomes negative when the bonus is added, increases the score to 9,999,999,990,
                            a <a href='#term_counterstop'>counterstop</a>. Not to be confused with <a href='#term_overflow'>overflow</a>.</td>
                        </tr>
						<tr id='term_ufo'>
							<th>UFO</th>
							<td>Touhou 12: Undefined Fantastic Object.</td>
						</tr>
                        <tr id='term_um'>
                            <th>UM</th>
                            <td>Touhou 18: Unconnected Marketeers.</td>
                        </tr>
                        <tr id='term_wall'>
                            <th>Wall</th>
                            <td>A cluster of bullets with no space that a hitbox can pass through in between them, although it can also refer to a cluster of bullets that <em>looks</em> like that.</td>
                        </tr>
						<tr id='term_vd'>
							<th>VD</th>
							<td>Touhou 16.5: Violet Detector.</td>
						</tr>
                        <tr id='term_wbawc'>
                            <th>WBaWC</th>
                            <td>Touhou 17: Wily Beast and Weakest Creature.</td>
                        </tr>
                    </tbody>
                </table>
                <h1 id='spells'>Spell Card / Pattern Acronyms</h1>
                <p>These acronyms for particularly infamous patterns usually refer to the Lunatic difficulty version of the abbreviated Spell Card or pattern.</p>
                <table id='spelltable'>
                    <thead>
                        <tr>
                            <th class='jargon'>Acronym<hr></th>
                            <th>Spell Card / Pattern<hr></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id='term_aoj'>
                            <th>AoJ</th>
                            <td>"Aura of Justice", Shou's second spell in <a href='#term_ufo'>UFO</a>.</td>
                        </tr>
                        <tr id='term_books'>
                            <th>Books</th>
                            <td>The section of <a href='#term_eosd'>EoSD</a> Stage 4 where books spawn in random locations and shoot series of green bullets.</td>
                        </tr>
                        <tr id='term_bolad'>
                            <th>BoLaD</th>
                            <td>"Border of Life and Death", Yukari's semifinal Spell Card in <a href='#term_pcb'>PCB</a>.</td>
                        </tr>
                        <tr id='term_bowap'>
                            <th>BoWaP</th>
                            <td>"Border of Wave and Particle", Satori's final Spell Card if you use ReimuA in <a href='#term_sa'>SA</a>.</td>
                        </tr>
                        <tr id='term_bcb'>
                            <th>BCB</th>
                            <td>"Hidden Breezy Cherry Blossom", Okina's final Spell Card if you use the Spring season in <a href='#term_hsifs'>HSiFS</a>. Also known as 'HBCB'.</td>
                        </tr>
                        <tr id='term_bd'>
                            <th>BD</th>
                            <td>"Buddhist Diamond", Kaguya's second Spell Card in <a href='#term_in'>IN</a>.</td>
                        </tr>
                        <tr id='term_bdb'>
                            <th>BDB</th>
                            <td>"Brilliant Dragon Bullet", Kaguya's first Spell Card in <a href='#term_in'>IN</a>.</td>
                        </tr>
                        <tr id='term_bls'>
                            <th>BLS</th>
                            <td>"Blue Lady Show", Raiko's <a href='#term_survivalspell'>survival Spell Card</a> in <a href='#term_ddc'>DDC</a>.</td>
                        </tr>
                        <tr id='term_catswalk'>
                            <th>Cats Walk</th>
                            <td>"Vengeful Cat Spirit's Erratic Step", Rin's midboss Spell Card in <a href='#term_sa'>SA</a> Stage 5. This is the name on Easy and Normal only, but it's used for Lunatic regardless.</td>
                        </tr>
                        <tr id='term_cc'>
                            <th>CC</th>
                            <td>"Complete Clarification", Shou's final Spell Card in <a href='#term_ufo'>UFO</a>.</td>
                        </tr>
                        <tr id='term_cfw'>
                            <th>CFW</th>
                            <td>"Hidden Crazy Fall Wind", Okina's final Spell Card if you use the Autumn season in <a href='#term_hsifs'>HSiFS</a>. Also known as 'HCFW'.</td>
                        </tr>
                        <tr id='term_dbdb'>
                            <th>DBDB</th>
                            <td>"Double Black Death Butterfly", Satori's first ReimuA-specific Spell Card in <a href='#term_sa'>SA</a>.</td>
                        </tr>
                        <tr id='term_dr'>
                            <th>DR</th>
                            <td>"Devil's Recitation", Byakuren's fourth Spell Card in <a href='#term_ufo'>UFO</a>.</td>
                        </tr>
                        <tr id='term_ew'>
                            <th>EW</th>
                            <td>"Hidden Extreme Winter", Okina's final Spell Card if you use the Winter season in <a href='#term_hsifs'>HSiFS</a>. Also known as 'HEW'.</td>
                        </tr>
                        <tr id='term_fin'>
                            <th>FIN</th>
                            <td>"Flying Insect's Nest", Satori's second ReimuA-specific Spell Card in <a href='#term_sa'>SA</a>.</td>
                        </tr>
                        <tr id='term_ghostwheels'>
                            <th>Ghost Wheels</th>
                            <td>"The Needles of Yore and the Vengeful Spirits in Pain", Rin's third Spell Card in <a href='#term_sa'>SA</a>. Also known as 'needles' or just 'wheels'.</td>
                        </tr>
                        <tr id='term_gc'>
                            <th>GC</th>
                            <td>"Geometric Creature", Keiki's penultimate Spell Card in <a href='#term_wbawc'>WBaWC</a>.</td>
                        </tr>
                        <tr id='term_go'>
                            <th>GO</th>
                            <td>"Good Omen", Byakuren's first Spell Card in <a href='#term_ufo'>UFO</a>. Not to be confused with <a href='#term_gameover'>game over</a>.</td>
                        </tr>
                        <tr id='term_gt'>
                            <th>GT</th>
                            <td>"Greatest Treasure", Nazrin's midboss Spell Card in <a href='#term_ufo'>UFO</a> Stage 5.</td>
                        </tr>
                        <tr id='term_hgs'>
                            <th>HGS</th>
                            <td>"Hell God Sword", Youmu's first Spell Card in <a href='#term_pcb'>PCB</a>.</td>
                        </tr>
                        <tr id='term_hj'>
                            <th>HJ</th>
                            <td>"Hourai Jewel", Kaguya's final Spell Card that is not a <a href='#term_ls'>Last Spell</a> in <a href='#term_in'>IN</a>.</td>
                        </tr>
                        <tr id='term_hmd'>
                            <th>HMD</th>
                            <td>"Honest Man's Death", Mokou's fifth Spell Card in <a href='#term_in'>IN</a>.</td>
                        </tr>
                        <tr id='term_id'>
                            <th>ID</th>
                            <td>"Idola Diabolus", Keiki's final Spell Card in <a href='#term_wbawc'>WBaWC</a>.</td>
                        </tr>
                        <tr id='term_is'>
                            <th>IS</th>
                            <td>"Imperishable Shooting", Mokou's final Spell Card in <a href='#term_in'>IN</a>.</td>
                        </tr>
                        <tr id='term_kd'>
                            <th>KD</th>
                            <td>"Killing Doll", Sakuya's final Spell Card in <a href='#term_eosd'>EoSD</a>.</td>
                        </tr>
                        <tr id='term_kks'>
                            <th>KKS</th>
                            <td>"King Kraken Strike", Ichirin's first Spell Card in <a href='#term_ufo'>UFO</a>.</td>
                        </tr>
                        <tr id='term_lc'>
                            <th>LC</th>
                            <td>"Linear Creature", Keiki's third Spell Card in <a href='#term_wbawc'>WBaWC</a>.</td>
                        </tr>
                        <tr id='term_lfs'>
                            <th>LFS</th>
                            <td>"Legendary Flying Saucer", Byakuren's final Spell Card in <a href='#term_ufo'>UFO</a>.</td>
                        </tr>
                        <tr id='term_mdsw'>
                            <th>MDSW</th>
                            <td>"Modern Divine Spirit World", Junko's third Spell Card in <a href='#term_ddc'>LoLK</a>.</td>
                        </tr>
                        <tr id='term_nds'>
                            <th>NDS</th>
                            <td>"Newborn Divine Spirit", Miko's final Spell Card in <a href='#term_td'>TD</a>.</td>
                        </tr>
                        <tr id='term_peta'>
                            <th>Peta</th>
                            <td>"Peta Flare", Utsuho's second Spell Card in <a href='#term_sa'>SA</a>.</td>
                        </tr>
                        <tr id='term_pdh'>
                            <th>PDH</th>
                            <td>"Pristine Danmaku Hell", Junko's final Spell Card in <a href='#term_ddc'>LoLK</a>.</td>
                        </tr>
                        <tr id='term_psi'>
                            <th>PSI</th>
                            <td>"Hidden Perfect Summer Ice", Okina's final Spell Card if you use the Summer season
							in <a href='#term_hsifs'>HSiFS</a>. Also known as 'HPSI'.</td>
                        </tr>
                        <tr id='term_pwg'>
                            <th>PWG</th>
                            <td>"Peerless Wind God", Aya's <a href='#term_survivalspell'>survival Spell Card</a>
							in <a href='#term_mof'>MoF</a>.</td>
                        </tr>
                        <tr id='term_qed'>
                            <th>QED</th>
                            <td>QED "Ripples of 495 Years", Flandre's final Spell Card in <a href='#term_eosd'>EoSD</a>.</td>
                        </tr>
                        <tr id='term_rings'>
                            <th>Rings</th>
                            <td>Mokou's final non in <a href='#term_in'>IN</a>. Also commonly called 'Rings of Death'.</td>
                        </tr>
                        <tr id='term_rb'>
                            <th>RB</th>
                            <td>"Resurrection Butterfly", Yuyuko's final Spell Card in <a href='#term_pcb'>PCB</a>.</td>
                        </tr>
                        <tr id='term_rtg'>
                            <th>RTG</th>
                            <td>"Radiant Treasure Gun", Shou's first Spell Card in <a href='#term_ufo'>UFO</a>.</td>
                        </tr>
                        <tr id='term_rw'>
                            <th>RW</th>
                            <td>"Rising World", Kaguya's final <a href='#term_ls'>Last Spell</a> in <a href='#term_in'>IN</a>.</td>
                        </tr>
                        <tr id='term_sfn'>
                            <th>SFN</th>
                            <td>"Saigyouji Flawless Nirvana", Yuyuko's <a href='#term_lw'>Last Word</a> in <a href='#term_in'>IN</a>.</td>
                        </tr>
                        <tr id='term_sg'>
                            <th>SG</th>
                            <td>"Scarlet Gensokyo", Remilia's final Spell Card in <a href='#term_eosd'>EoSD</a>.
							Also commonly called 'Gensokyo'.</td>
                        </tr>
                        <tr id='term_sm'>
                            <th>SM</th>
                            <td>"Scarlet Meister", Remilia's semifinal Spell Card in <a href='#term_eosd'>EoSD</a>.
							Also commonly called 'Meister'.</td>
                        </tr>
                        <tr id='term_subsun'>
                            <th>Subsun</th>
                            <td>"Subterranean Sun", Utsuho's final Spell Card in <a href='#term_sa'>SA</a>.</td>
                        </tr>
                        <tr id='term_unr'>
                            <th>UNR</th>
                            <td>"Uncontainable Nuclear Reaction", Utsuho's first Spell Card in <a href='#term_sa'>SA</a>.</td>
                        </tr>
                        <tr id='term_vi'>
                            <th>VI</th>
                            <td>"Vampire Illusion", Remilia's third Spell Card in <a href='#term_eosd'>EoSD</a>.</td>
                        </tr>
                        <tr id='term_vowg'>
                            <th>VoWG</th>
                            <td>"Virtue of Wind God", Kanako's final Spell Card in <a href='#term_mof'>MoF</a>.
							Occasionally it will be called 'DVoWG' (D for Divine), because of the older English translation patch.</td>
                        </tr>
                        <tr id='term_ydl'>
                            <th>YDL</th>
                            <td>"Young Demon Lord", Remilia's first Spell Card in <a href='#term_eosd'>EoSD</a>.</td>
                        </tr>
                        <tr id='term_ygb'>
                            <th>YGB</th>
                            <td>"You Grow Bigger!", Shinmyoumaru's <a href='#term_survivalspell'>survival Spell Card</a>
							in <a href='#term_ddc'>DDC</a>.</td>
                        </tr>
                    </tbody>
                </table>
                <h1 id='bullets'>Bullet Type Names</h1>
                <table id='bullettable'>
                    <thead>
                        <tr>
                            <th class='jargon'>Name<hr></th>
                            <th>Bullet<hr></th>
                        </tr>
                    </thead>
                    <tbody>
    					<tr id='term_amulet'>
    						<th>Amulet</th>
    						<td><img src='assets/bullets/amulet.png' alt='Amulet bullet'></td>
    					</tr>
                        <tr id='term_arrow'>
                            <th>Arrow</th>
                            <td><img src='assets/bullets/arrow.png' alt='Arrow bullet'></td>
                        </tr>
                        <tr id='term_arrowhead'>
                            <th>Arrowhead</th>
                            <td><img src='assets/bullets/arrowhead.png' alt='Arrowhead'></td>
                        </tr>
                        <tr id='term_bacteria'>
                            <th>Bacteria, dark rice</th>
                            <td><img src='assets/bullets/bacteria.png' alt='Bacteria'></td>
                        </tr>
                        <tr id='term_ball'>
                            <th>Ball</th>
                            <td><img src='assets/bullets/ball.png' alt='Ball'></td>
                        </tr>
                        <tr id='term_balloutline'>
                            <th>Ball (outlined)</th>
                            <td><img src='assets/bullets/balloutline.png' alt='Ball (outlined)'></td>
                        </tr>
                        <tr id='term_bubble'>
                            <th>Bubble</th>
                            <td><img src='assets/bullets/bubble.png' alt='Bubble'></td>
                        </tr>
                        <tr id='term_bullet'>
                            <th>Bullet</th>
                            <td><img src='assets/bullets/bullet.png' alt='OG bullet'></td>
                        </tr>
                        <tr id='term_butterfly'>
                            <th>Butterfly</th>
                            <td><img src='assets/bullets/butterfly.png' alt='Butterfly'></td>
                        </tr>
                        <tr id='term_coin'>
                            <th>Coin</th>
                            <td><img src='assets/bullets/coin.png' alt='Coin'></td>
                        </tr>
                        <tr id='term_fireball'>
                            <th>Fireball</th>
                            <td><img src='assets/bullets/fireball.png' alt='Fireball'></td>
                        </tr>
                        <tr id='term_glowshit'>
                            <th>Fireball (glowy)</th>
                            <td><img src='assets/bullets/glowshit.png' alt='Fireball (glowy)'></td>
                        </tr>
                        <tr id='term_heart'>
                            <th>Heart</th>
                            <td><img src='assets/bullets/heart.png' alt='Heart'></td>
                        </tr>
                        <tr id='term_jellybean'>
                            <th>Jellybean</th>
                            <td><img src='assets/bullets/jellybean.png' alt='Jellybean'></td>
                        </tr>
                        <tr id='term_knife'>
                            <th>Knife</th>
                            <td><img src='assets/bullets/knife.png' alt='Knife'></td>
                        </tr>
                        <tr id='term_kunai'>
                            <th>Kunai</th>
                            <td><img src='assets/bullets/kunai.png' alt='Kunai'></td>
                        </tr>
                        <tr id='term_mentos'>
                            <th>Mentos</th>
                            <td><img src='assets/bullets/mentos.png' alt='Mentos'></td>
                        </tr>
                        <tr id='term_note'>
                            <th>Note</th>
                            <td><img src='assets/bullets/note.png' alt='Note'></td>
                        </tr>
                        <tr id='term_orb'>
                            <th>Orb</th>
                            <td><img src='assets/bullets/orb.png' alt='Orb'></td>
                        </tr>
                        <tr id='term_pellet'>
                            <th>Pellet</th>
                            <td><img src='assets/bullets/pellet.png' alt='Pellet'></td>
                        </tr>
                        <tr id='term_popcorn'>
                            <th>Popcorn</th>
                            <td><img src='assets/bullets/popcorn.png' alt='Popcorn'></td>
                        </tr>
                        <tr id='term_raindrop'>
                            <th>Raindrop, droplet</th>
                            <td><img src='assets/bullets/raindrop.png' alt='Raindrop'></td>
                        </tr>
                        <tr id='term_rest'>
                            <th>Rest</th>
                            <td><img src='assets/bullets/rest.png' alt='Rest'></td>
                        </tr>
                        <tr id='term_rice'>
                            <th>Rice</th>
                            <td><img src='assets/bullets/rice.png' alt='Rice'></td>
                        </tr>
                        <tr id='term_rose'>
                            <th>Rose</th>
                            <td><img src='assets/bullets/rose.png' alt='Rose'></td>
                        </tr>
                        <tr id='term_shard'>
                            <th>Shard, icicle</th>
                            <td><img src='assets/bullets/shard.png' alt='Shard'></td>
                        </tr>
                        <tr id='term_star'>
                            <th>Star (big)</th>
                            <td><img src='assets/bullets/star.png' alt='Star (big)'></td>
                        </tr>
                        <tr id='term_stars'>
                            <th>Star (small)</th>
                            <td><img src='assets/bullets/starsmall.png' alt='Star (small)'></td>
                        </tr>
                    </tbody>
                </table>
                <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
            </div>
        </main>
    </body>
</html>
