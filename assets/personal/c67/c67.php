<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p>This page covers the scoring system and mechanics of the Comiket 67 release of Seihou Banshiryuu.</p>
    <picture>
        <source srcset='assets/personal/c67/images/boxart.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/boxart.jpg'>
        <img id='boxart' src='assets/personal/c67/images/boxart.jpg' alt='Banshiryuu Cover' width='280' height='280'>
    </picture>
    <hr>
    <h2 id='contents'>Contents</h2>
    <ol id='toc' class='border'>
        <li><a href='#items'>Items</a></li>
        <li><a href='#grazing'>Grazing</a></li>
        <li><a href='#se'>Special Equipment</a></li>
        <li><a href='#shottypes'>Shottypes</a>
            <ol type='I'>
                <li><a href='#vivitw'>VIVIT-W</a></li>
                <li><a href='#vivita'>VIVIT-A</a></li>
                <li><a href='#hiranos'>HiranoS</a></li>
                <li><a href='#hiranoo'>HiranoO</a></li>
                <li><a href='#comparison'>Comparison</a></li>
            </ol>
        </li>
    </ol>
    <hr>
    <h2 id='items'>Items</h2>
    <picture>
        <source srcset='assets/personal/c67/images/item_rank.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/item_rank.jpg'>
        <img loading='lazy' src='assets/personal/c67/images/item_rank.jpg' alt='Point item sprites' width='219' height='38'>
    </picture>
    <p>Items will be automatically collected when an enemy is killed in close proximity. As you collect more of the same item,
    the item rank will gradually increase, also changing what the items look like. The points awarded per item on each rank are as follows:</p>
    <p>100 -> 1,000 -> 6,400 -> 12,800 -> 51,200</p>
    <p>If an enemy is killed from a bit too far away, their item will be dropped but not automatically collected.
    If you fail to collect any item before it falls off-screen, your item rank will be reset and the item value will be 100 points again.</p>
    <p>In case an enemy is killed from even further away, it will not drop any item at all.</p>
    <hr>
    <h2 id='grazing'>Grazing</h2>
    <picture>
        <source srcset='assets/personal/c67/images/grazing.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/grazing.png'>
        <img id='graze' loading='lazy' src='assets/personal/c67/images/grazing.png' alt='VIVIT grazing lasers' width='350' height='145'>
    </picture>
    <br>
    <p class='description'>A counter appears as you perform continuous grazing,
    showing your current continuous graze and total graze points on the stage.</p>
    <p>It is possible to automatically collect all items on the screen by means of <em>grazing</em> bullets,
    which is having a bullet enter your 'grazebox', the area around your character in which a bullet is considered to be grazed.
    This area is larger when you are focused and focusing also makes the grazebox display on screen,
    as is depicted in the above screenshot. Bullets can be grazed only once, while lasers can be grazed indefinitely.
    For each graze point, 300 points are added to your score.</p>
    <hr>
    <h2 id='se'>Special Equipment (SE)</h2>
    <picture>
        <source srcset='assets/personal/c67/images/normal_se.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/normal_se.jpg'>
        <img loading='lazy' src='assets/personal/c67/images/normal_se.jpg' alt='SE-attack' width='210' height='280'>
    </picture>
    <p>Bosses and midbosses may use <em>SE attacks</em>. They have a set duration and the boss is invincible during one,
    as denoted by the text "-- ABSOLUTE DEFEND --" displayed on their health bar. During an SE, you should
    attempt to deal as much damage as possible; when an SE ends, the damage dealt to the boss during it
    is multiplied by 100 and added to your score. The damage dealt to the boss during an SE is displayed
    on the right of the screen, below your current score.</p>
    <picture>
        <source srcset='assets/personal/c67/images/se.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/se.jpg'>
        <img loading='lazy' src='assets/personal/c67/images/se.jpg' alt='Damage dealt to SE' width='208' height='64'>
    </picture>
    <br>
    <p class='description'>The bottom number is the current damage dealt to the boss during an SE.</p>
    <p>There are several different kinds of SE attacks. Every boss has an opening SE, which will always be used
    at the start of a boss battle. Bosses also have at least one SE that is always used when the boss reaches
    a specific amount of health, which will cause the SE to interrupt whatever pattern it was firing.
    When a regular pattern ends, an SE for that specific health range will be used. This is the kind of
    SE that can be skipped if enough damage is dealt to the boss to bring it past that health range before
    their regular pattern finishes. This is the most notable in the battle against VIVIT when using
    Hirano, due to VIVIT's low health.</p>
    <picture>
        <source srcset='assets/personal/c67/images/final_se.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/final_se.jpg'>
        <img loading='lazy' src='assets/personal/c67/images/final_se.jpg' alt='Final SE-attack' width='209' height='280'>
    </picture>
    <br>
    <p class='description'>The stage 1 midboss' final (and in this case, only) SE begins.</p>
    <p>Every boss also has a single <em>final SE</em>, which cannot be skipped and is used once their health bar
    is empty. Their health bar will be refilled with a red color when the final SE begins. If this health
    bar is emptied, it will say "-- OVER KILL --". The boss will explode and drop an item when the SE ends during
    said overkill, also awarding you the SE bonus as usual. If the bar is not emptied before the SE ends,
    the boss will fly off-screen and will not drop any item, nor award the SE bonus. Most of the bosses
    drop bomb items, exceptions being the stage 2 and 6 midbosses, which drop 1up items instead. They also
    award a fixed number of points for being defeated; these values are listed in the table below.</p>
    <table>
        <tr>
            <th>Boss of</th>
            <th>Name</th>
            <th>Points</th>
        </tr>
        <tr>
            <td>Stage 1</td>
            <td>Erich</td>
            <td>200,000</td>
        </tr>
        <tr>
            <td>Stage 2</td>
            <td>Yuuta</td>
            <td>200,000</td>
        </tr>
        <tr>
            <td>Stage 3</td>
            <td>The Tri Stars</td>
            <td>1,000,000</td>
        </tr>
        <tr>
            <td>Stage 4</td>
            <td>VIVIT / Hirano</td>
            <td>5,000</td>
        </tr>
        <tr>
            <td>Stage 5</td>
            <td>Lagunas</td>
            <td>1,000,000</td>
        </tr>
        <tr>
            <td>Stage 6</td>
            <td>Yuitia</td>
            <td>1,000,000</td>
        </tr>
    </table>
    <picture>
        <source srcset='assets/personal/c67/images/yuitia.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/yuitia.png'>
        <img id='yuitia' loading='lazy' src='assets/personal/c67/images/yuitia.png' alt='Yuitia (final boss)' width='235' height='457'>
    </picture>
    <br>
    <p class='description'>Yuitia, the stage 6 (final) boss of the game.</p>
    <p>The final boss, Yuitia, has some unique properties; she does not drop any item once she explodes and cannot
    be damaged by bombs, which makes bombing them <em>bad</em> for scoring rather than good.
    This is referred to as Yuitia having a <em>bombshield</em>. Exceptions to this are the patterns that spawn missiles,
    because they are separate entities that can be damaged. Also, she does not have any regular attacks; all of her patterns
    are SE attacks. She always uses all of them, so no skipping is possible here, and she doesn't have a final SE;
    her last SE works the same way as a regular SE. She fires large white bullets that cannot damage you as an
    intermission in between her SE attacks. Her actual health bar can only barely be damaged during that,
    and as such, it can never be emptied. It is automatically emptied by the game when Yuitia explodes, which,
    in her case, always occurs once her last SE ends, regardless of how much you damaged her, so the fixed points
    for defeating her are always awarded.</p>
    <hr>
    <h2 id='shottypes'>Shottypes</h2>
    <p>Note that for every shottype, the regular shot can only hit enemies in front of you, and the focused shot automatically aims at enemies.</p>
    <h3 id='vivitw'>VIVIT-W</h3>
    <picture>
        <source srcset='assets/personal/c67/images/vivitw.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/vivitw.jpg'>
        <img loading='lazy' class='shotinfo' src='assets/personal/c67/images/vivitw.jpg' alt='VIVIT-W Shottype Info' width='640' height='480'>
    </picture>
    <br>
    <p>A shottype with slow movement speed and medium powered shots. Her regular shot covers a wide area and is inconsistent,
    because the familiars change their firing direction, their shots on the side moving from left to right (independently
    of your movement). It's the weakest regular shot in the game, which matters a lot because you will want to be unfocused
    most of the time during the stage portions, in order to collect items and have faster movement speed than when focused.
    The focused shot of VIVIT-W has is the second strongest in the game and it automatically aims at the enemy closest to you
    when you start firing it, selects the next closest one when the enemy it's currently firing at dies, and so on.
    Her bomb is decently powerful as well and lasts very long, which is the main selling point of VIVIT-W; it allows her to
    kill enemies at point blank range that you couldn't otherwise get that close to, obtaining all their items in just a
    single bomb. The slow movement speed and medium damage may seem to make VIVIT-W a suboptimal shottype to use for
    scoring, but the long-lasting bomb makes up for it. Furthermore, survival-wise, her slow movement allows for precise dodging,
    which is helpful during certain patterns, though you may mostly want to be fast, still, given the fast bullet speeds in most
    of the game. Her bomb duration can also help her last out through patterns, having far more I-frames than other bombs.</p>
    <h3 id='vivita'>VIVIT-A</h3>
    <picture>
        <source srcset='assets/personal/c67/images/vivita.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/vivita.jpg'>
        <img loading='lazy' class='shotinfo' src='assets/personal/c67/images/vivita.jpg' alt='VIVIT-A Shottype Info' width='640' height='480'>
    </picture>
    <br>
    <p>The faster VIVIT, boasting the second fastest movement speed, the second most powerful regular shot and second weakest
    focused shot. Her regular shot is very thin and does not automatically end when you let go of the shot key; the lasers
    she fires will linger for a while, which is bad for scoring, since you will want to not shoot at times to avoid killing
    enemies when not close enough to collect their items. The damage dealt by the shot somewhat makes up for it, although
    you will always have to be directly under a boss or an enemy to hit them. VIVIT-A's focused shot is much weaker,
    being less than twice as powerful, but since focusing slows down your movement, it can be used for survival reasons.
    Her bomb is very powerful, being the second most powerful one in the game, and like her regular shot, it fires
    straight ahead. It has a short duration, as do Hirano's bombs; VIVIT-W has the only bomb with a long duration.
    All in all she is a solid shottype given her great power on her regular shot, but you will have to be cautious when
    not being in point blank range while killing enemies, as well as making sure she is always directly below what you
    want to deal damage to. Avoid focusing as much as possible and limit it to when it is needed for survival.</p>
    <h3 id='hiranos'>HiranoS</h3>
    <picture>
        <source srcset='assets/personal/c67/images/hiranos.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/hiranos.jpg'>
        <img loading='lazy' class='shotinfo' src='assets/personal/c67/images/hiranos.jpg' alt='HiranoS Shottype Info' width='640' height='480'>
    </picture>
    <br>
    <p>Arguably the best shottype in the game. Her regular shot is the most powerful shot in the game, beating not just all
    regular shots, but also all focused shots. On top of this, it covers more than twice as wide an area as the powerful
    shot of VIVIT-A, allowing for easier positioning to hit bosses. HiranoS also has the fastest movement speed in the
    game, which is very useful, since it allows her to easily sweep across stages, quickly kill enemies with her powerful
    arrows fired by her regular shot, and collect all their items. Her focused shot is very weak, being the weakest focused
    shot, and as such it should only be used when necessary for survival or when it is needed to kill an enemy with; it aims
    at enemies rather than firing straight ahead, which is useful in certain situations. HiranoS's bomb has her fire
    omnidirectional amulets for a short duration. It deals a lot of damage on Hirano's hitbox, the spawn point of the amulets,
    so you will want to sit on top of a boss when using it during a boss fight for optimal damage.
    Mastering unfocused dodging is very much necessary if you want to get good with HiranoS, since that will make her deal much more
    damage and achieve very high scores; her amazing damage combined with her speed is what makes her the best shottype to use overall.</p>
    <h3 id='hiranoo'>HiranoO</h3>
    <picture>
        <source srcset='assets/personal/c67/images/hiranoo.webp' type='image/webp'>
        <source srcset='assets/personal/c67/images/hiranoo.jpg'>
        <img loading='lazy' class='shotinfo' src='assets/personal/c67/images/hiranoo.jpg' alt='HiranoO Shottype Info' width='640' height='480'>
    </picture>
    <br>
    <p>HiranoO is a gimmicky shottype. Her regular shot is the third strongest, being twice as powerful as VIVIT-W's one but weaker
    than those of VIVIT-A and HiranoS, and it bends with horizontal movement; bending to the left when you move left, and vice
    versa for right. Her focused shot uses a blue field of sight that will appear on the screen when you start focusing. When an
    enemy or a boss enters this field, it will be targetted and bullets will be fired at it. The field moves into the opposite
    direction of your movement, making it difficult to control. HiranoO has the slowest movement speed, being slightly
    slower than VIVIT-W, which does not help, and in addition to that, her regular shot is thin (like VIVIT-A's) and does
    not always seem to be at its full potential when firing at a bigger enemy. In contrary, HiranoO's bomb is the strongest bomb from afar,
    and it covers a wide area on the screen as well, making it an excellent way of getting rid of enemies instantly and damaging
    bosses. Regardless, however, she is the worst shottype in the game, due to her awkward shots and difficulty to control her
    together with slow movement. These factors make her very poor at item collection. At least, her damage dealt to bosses is pretty good,
    having the strongest focused shot in the game (second strongest shot overall), only beaten by HiranoS's regular shot.</p>
    <h3 id='comparison'>Comparison</h3>
    <div class='overflow'><table>
        <tr>
            <th>Shottype</th>
            <th>Regular shot power</th>
            <th>Regular shot range</th>
            <th>Focused shot power</th>
            <th>Bomb power</th>
            <th>Bomb duration</th>
        </tr>
        <tr>
            <th>VIVIT-W</th>
            <td>75</td>
            <td>Wide</td>
            <td>125</td>
            <td>235</td>
            <td>Long</td>
        </tr>
        <tr>
            <th>VIVIT-A</th>
            <td>175</td>
            <td>Very narrow</td>
            <td>80</td>
            <td>450</td>
            <td>Short</td>
        </tr>
        <tr>
            <th>HiranoS</th>
            <td>195</td>
            <td>Narrow</td>
            <td>50</td>
            <td>25*</td>
            <td>Short</td>
        </tr>
        <tr>
            <th>HiranoO</th>
            <td>150</td>
            <td>Very narrow</td>
            <td>180</td>
            <td>512</td>
            <td>Short</td>
        </tr>
    </table></div>
    <p>* Much higher than any other bomb in practice (if used on top of an enemy or boss)</p>
    <p><strong><a href='#top'>Back to Top</a></strong></p>
</div>
