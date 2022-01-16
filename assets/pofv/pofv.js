/*global $ setCookie getCookie*/
var language = "en_US", STATS = {
        "reimu": {
            "speed": 68,
            "focus": 136,
            "scope": 20,
            "charge": 25,
            "delay": 41
        },
        "marisa": {
            "speed": 55,
            "focus": 91,
            "scope": 101,
            "charge": 31,
            "delay": 36
        },
        "sakuya": {
            "speed": 68,
            "focus": 85,
            "scope": 31,
            "charge": 28,
            "delay": 46
        },
        "youmu": {
            "speed": 55,
            "focus": 130,
            "scope": 182,
            "charge": 45.5,
            "delay": 23
        },
        "reisen": {
            "speed": 61,
            "focus": 109,
            "scope": 12,
            "charge": 28.75,
            "delay": 51
        },
        "cirno": {
            "speed": 58,
            "focus": 83,
            "scope": 4,
            "charge": 34.5,
            "delay": 51
        },
        "lyrica": {
            "speed": 65,
            "focus": 124,
            "scope": 32,
            "charge": 35.75,
            "delay": 51
        },
        "merlin": {
            "speed": 72,
            "focus": 136,
            "scope": 48,
            "charge": 42,
            "delay": 31
        },
        "lunasa": {
            "speed": 61,
            "focus": 109,
            "scope": 16,
            "charge": 31.25,
            "delay": 51
        },
        "mystia": {
            "speed": 55,
            "focus": 80,
            "scope": 10,
            "charge": 33.5,
            "delay": 51
        },
        "tewi": {
            "speed": 61,
            "focus": 145,
            "scope": 38,
            "charge": 25,
            "delay": 51
        },
        "aya": {
            "speed": 50,
            "focus": 79,
            "scope": 50,
            "charge": 25,
            "delay": 51
        },
        "medicine": {
            "speed": 55,
            "focus": 114,
            "scope": 19,
            "charge": 35.75,
            "delay": 51
        },
        "yuuka": {
            "speed": 91,
            "focus": 148,
            "scope": 4,
            "charge": 25.75,
            "delay": 51
        },
        "komachi": {
            "speed": 67,
            "focus": 124,
            "scope": 20,
            "charge": 31.25,
            "delay": 51
        },
        "eiki": {
            "speed": 55,
            "focus": 114,
            "scope": 5,
            "charge": 31,
            "delay": 51
        }
    },
    TIER = {
        "marisa": "S",
        "reimu": "S",
        "youmu": "S",
        "komachi": "A",
        "eiki": "A",
        "lyrica": "B",
        "medicine": "B",
        "reisen": "B",
        "lunasa": "C",
        "merlin": "C",
        "yuuka": "D",
        "sakuya": "D",
        "aya": "D",
        "tewi": "E",
        "mystia": "E",
        "cirno": "E"
    },
    ABILITY = {
        "youmu": "Bullet-cancelling sword",
        "marisa": "Energy fills faster",
        "reimu": "Small hitbox",
        "komachi": "Scope instantly activates all spirits in her field",
        "eiki": "Activated spirits only emit a single red bullet",
        "lyrica": "Can shoot backwards as well as forwards",
        "medicine": "Cannot be hit by spirits",
        "yuuka": "Three-way shots",
        "reisen": "Activated spirits drift upwards faster",
        "sakuya": "Activated spirits do not drift upwards",
        "lunasa": "Three-way shots",
        "merlin": "Slanted shots",
        "aya": "Slightly slows down bullets in her field",
        "mystia": "Attracts spirits towards her",
        "cirno": "Activated spirits take longer to self-destruct",
        "tewi": "Auto-bombs when hit at 0.5 health"
    },
    SCOPE = {
        "youmu": "Huge circle that deploys very slowly",
        "marisa": "Forward focused scope that slowly expands horizontally",
        "reimu": "Basic circle that deploys pretty slowly",
        "komachi": "Entire screen, then shrinks into nothing",
        "eiki": "Basic circle that deploys really quickly",
        "lyrica": "Vertical line that slowly expands horizontally",
        "medicine": "Star pattern with decent deployment speed",
        "yuuka": "Medium-sized, average speed circle with spinning small circles",
        "reisen": "Eye formation that turns based on the player's movement",
        "sakuya": "Fan shape that moves opposite to the player's movement",
        "lunasa": "Two thin lines forming a cross",
        "merlin": "Horizontal line that deploys slowly",
        "aya": "Medium-sized fan shape with slow deployment",
        "mystia": "Small circle that quickly deploys in front of the player",
        "cirno": "Small circle that deploys fast",
        "tewi": "Big flat eye that deploys at a decent speed"
    },
    DESCRIPTION = {
        "youmu": {
            "en_US": "Her movement speeds allow her to be either very slow or very fast at will. " +
                "The sword has little cooldown, so it can be used repeatedly despite her slow charge speed. " +
                "With that speed, the bullet clearing effect, and the invincibility frames that come with all charge attacks, " +
                "she can easily cut through situations that no mortal should be able to dodge, and she can do it very often. " +
                "The dead souls suffocate the opponent much like Marisa's lasers (though they can be cleared away), " +
                "her spell attack is long lasting (so it cannot be totally countered by the opponent's spellcasting), " +
                "and the boss summon uses movement restricting patterns that are completely devoid of pellet bullets. " +
                "The result of these facts is that Youmu is absolutely top tier.",
            "zh_CN": "妖梦的高低速差距非常大，使得她在避弹时可控性强。她的C1几乎没有CD，所以她可以一直依赖她的C1进行防守，" +
                "尽管她的蓄力速度很慢。妖梦可以依靠自己的移动速度，C1的消弹及C1穿的无敌时间来高频率的躲避其他机体没有办法躲避的弹幕。" +
                "她的EX和魔理沙一样恶心（虽然可以被消掉）。并且C2的攻击是持久的，同时妖梦的Boss没有点弹，所以她很难被对手有效的依靠消弹反击。" +
                "因此，妖梦是毫无争议的强机。"
        },
        "marisa": {
            "en_US": "Marisa's charge attack not only instantly destroys spirits, but causes them to explode " +
                "as if they had been activated. This allows her to easily set off chain reactions anywhere on the screen, " +
                "without the need to rely on her scope. Her special ability means she can cast spells more often. " +
                "Her high unfocused speed is great for macrododging and synergizes with her laser, " +
                "which can be swept across the screen. Marisa can also make very good use of level 1 invincibility frames, " +
                "due to her fast charge and movement speeds. Altogether, these give her excellent survivability. " +
                "Offensively, her lasers suffocate the opponent and cannot be cleared by any means, " +
                "eventually producing nigh-impossible situations with brutal frequency. In a late game spell war, " +
                "Marisa is probably the strongest character in the game.",
            "zh_CN": "魔理沙的C1可以秒杀灵并且引发激活状态的连爆。利用这个特性使她不需要固灵就可以在任何的地方引发连爆。" +
                "同时她的特性使她可以更频繁的使用C2。魔理沙高速C1可以扫屏清屏，并且能够很好的利用C1的无敌穿越弹幕。因此，" +
                "魔理沙的特性给予了她非常强大的生存能力。在进攻时，她的无法消除的EX激光将带给对方很大避弹压力，创造出很多无解的状况。" +
                "在开花战中，魔理沙是无可争议的最强机体。"
        },
        "reimu": {
            "en_US": "She's powerful because of her level 2 spell, which limits the opponent's movement and " +
                "spawns over a long period of time, meaning it cannot itself be entirely countered by a spell from the opponent. " +
                "However, she faces extremely fast bullets constantly as they are returned from her own spells " +
                "(speed is retained when bullets are reflected). Her movement is slow, and her scope is slow to expand. " +
                "The charge attack is useless. These make surviving with her somewhat difficult. Overall, she's unremarkable " +
                "in every way except for her spell, which is by far the best in the game and " +
                "single-handedly makes her a high tier character.",
            "zh_CN": "灵梦的强大来自于C2攻击。她的C2可以限制对方的移动，并且持续的产生，导致她的C2很难被对手全部消掉。但是，" +
                "她同时也要承受对方消除C2后的很快速度的反击弹。灵梦的移动速度，固灵展开速度很慢，C1实用性较差，因此她的生存能力并不高。" +
                "总而言之，除了C2，灵梦的性能平庸。但是灵梦仅仅因为C2超强的进攻能力，使她成为了花映塚的顶级角色。"
        },
        "komachi": {
            "en_US": "Her awesome scope and auto-targeting charge attack give her a lot of freedom. " +
                "She can essentially start a combo at will, from anywhere on the screen. She's not obligated to chase the fairies and " +
                "spirits around to maintain her spell points, and so can pay more attention to dodging. " +
                "Her spell is not very dangerous, but neither does it feed the opponent much energy, " +
                "and since most characters' spells are basically free energy for the opponent anyway, " +
                "this is actually pretty good. Her Extra attacks are great. They constantly cover the opponent's screen " +
                "with random bullets, forcing them to the bottom. They're especially effective against fast characters who " +
                "like to macrododge since they cover the whole screen evenly. In short, Komachi is a strong character that " +
                "is definitely capable of winning matches against top tier characters.",
            "zh_CN": "她可怕的固灵范围和诱导的C1给予了她非常大的自由度，甚至可以在场上的任何地方引发连爆。小町没有必要去追妖精或者灵，" +
                "所以她可以更加集中精力去躲避。她的C2不强，但是同时也不会给对面能量。因为一般机体的C2都会给对方提供大量的点弹，而小町不会，" +
                "所以其实她的C2还是相当不错的。她的EX攻击很厉害，可以不断的使用随机的子弹覆盖对手的屏幕，迫使对方中弹。" +
                "她覆盖整个屏幕的进攻对移动速度快的避弹机体十分有效。总而言之，小町是绝对能够赢下比赛的强机。"
        },
        // Eiki
        "eiki": {
            "en_US": "Great movement speeds, scope, and charge attack. Her boss is also pretty good. " +
                "Her extra attack 'clones' existing bullets on the opponent's screen by firing a special, " +
                "faster bullet in the same trajectory. Because the speed is determined by the original bullet, " +
                "this is more effective against characters whose spells use fast bullets (Yuuka, Reimu, etc.). " +
                "It's less effective against fast characters, because pellet bullets are loosely aimed and " +
                "thus the Extra attacks they spawn will tend to all fly in one direction and can be macrododged. " +
                "Eiki's critical weakness is her spell. It's totally non-threatening and every apparent pellet " +
                "it creates is actually 2 or 3 pellets stacked directly on top of each other. " +
                "All this does is feed the opponent tons of free energy. Falling short of the top tier largely due to this " +
                "key disadvantage, Eiki is still a notable character that should not be taken lightly.",
            "zh_CN": "四季移速快，固灵大，C1性能好，Boss也很厉害。并且它的EX是复制对方的弹幕所形成的，在同一个轨迹上发射一个特殊的，" +
                "更快的子弹。所以对抗那些使用快速子弹的角色（幽香，灵梦等）更加的有效。但是这些子弹对抗移动速度快的机体效果并不是很好，" +
                "因为她的子弹是泛狙，可以轻松的被大幅度的走位引开。四季的弱点在于C2没有任何的进攻能力并且会给对方带来大量的点弹，" +
                "因为这些看似一个的点弹其实是由2-3个点弹叠加在一起的。因此，四季并不能登上强机的顶点，但是她仍然是一个性能非常优秀的强机，需要格外注意。"
        },
        // Lyrica
        "lyrica": {
            "en_US": "Lyrica's scope is similar to Marisa's, but is much harder to use due to her slowness. " +
                "Her charge attack also only shoots straight forward, and, due to the fact that it stays in place, " +
                "it cannot be swept horizontally in the hopes of hitting an exposed fairy. This lack of coverage, " +
                "again coupled with her slow movement, makes her extremely dependent on her scope to start chains, " +
                "and her scope is just not very good. She also has rather slow charge speed. Her saving grace is her offense, " +
                "particularly her spell. It covers a huge part of the screen and continues spawning over a long period of time, " +
                "becoming an omnipresent threat much like Youmu's. Her boss and extra attack are also solid. Similarly to Reimu, " +
                "but not as extremely, the spell turns Lyrica into a serious threat that should not be underestimated.",
            "zh_CN": "莉莉卡的固灵和魔理沙相似，但是展开很慢，所以使用起来比魔理沙要难受很多。她的C1只是向前射击，并且停留在原地，" +
                "导致不能横扫，只能依靠击中妖精或者活化灵来引发连爆。同时她的蓄力速度很慢，固灵和C1范围都很差，所以她非常依赖一个好的时机去引发连爆。" +
                "而她强大的进攻能力弥补了她生存上的缺点，尤其是她的C2：大范围的覆盖屏幕的曲线弹幕，并且持续很长时间，就像妖梦那样，" +
                "成为了一种无处不在的威胁。同时她的EX和Boss杀伤也很强，虽然不如灵梦那么极端，但是配合C2仍然让莉莉卡成为了一个不能忽视的严重威胁。"
        },
        // Medicine
        "medicine": {
            "en_US": "She boasts nice movement speeds and scope, and her ability to pass through spirits is sometimes useful. " +
                "Her charge speed is kind of low and her charge attack sucks. Her spell, much like Eiki's, " +
                "does nothing but feed her opponent. Her extra attack is terrifying and its effect stacks, " +
                "eventually almost freezing the enemy in place. Unfortunately they will usually have lots of energy " +
                "to save themselves and the absence of an Extra attack that is directly lethal becomes really " +
                "apparent as they have nothing to worry about but pellets. She's more effective against characters who " +
                "have weak charge attacks, whose spells use fast bullets, and who are forced to stay focused for a long time " +
                "in order to activate spirits, since this furthers their slowness and deprives them of fairy spawns. " +
                "While not a great character overall, Medicine is certainly usable and has some good matchups.",
            "zh_CN": "毒药的移速和固灵都比较优秀，并且她可以碰到灵的能力有时可以发挥奇效。她的C1速度慢，而且C1效果很糟糕。" +
                "C2则像四季那样给对方带来很多的点弹。她的EX攻击很厉害，因为效果叠加，所以经常能让对方动都动不了。可惜她的C2给对方带来了太多的资源，" +
                "所以对方会有大量的能量来救场，同时没有EX攻击时对方将没有任何的压力。她对C1防守性能较差和弹幕速度较快的机体杀伤很强。" +
                "如果毒药能够让对方被迫长时间的固灵，那么对方的妖精队将会减少，资源将会亏欠。虽然毒药的性能不是那么强大，" +
                "但是还是在很多地方可以打出奇效的机体。"
        },
        // Yuuka
        "yuuka": {
            "en_US": "Her boss, spell, and Extra attacks give her a decent offense as they force the opponent downward, " +
                "but her defense is ruined by her slow movement. She has a hard time getting high enough on the screen to " +
                "clear a decent area with her spells, and she's terrible at misdirecting and macrododging. " +
                "This is a big problem, because the number of pellets she creates tends to push the game toward a spell war, " +
                "and she's just poorly equipped to handle that. Her offense also suffers from this as its main strength " +
                "(trapping the opponent and pushing them down) starts to fail completely and the other player will actually " +
                "stay very high on the screen with ease. Even her normally powerful boss is bad at preventing this. " +
                "Despite these disadvantages that significantly impact her viability, she can perform fairly well in the right hands.",
            "zh_CN": "幽香的Boss，EX和C2使她拥有一个不错的进攻性能，因为这些进攻的组合能够让对方被迫向下。但是她跑的太慢了，防守能力并不高。" +
                "她很难顶上去放C2，而且躲不过很多狙和高速弹，这是个大问题。因为幽香的C2提供了很多的弹幕来使局面走向开花，" +
                "但是她本身又很难处理开花的快速弹幕。同时开花后幽香的主要进攻手段也失去了效果，对方可以很轻松的顶上去开花，" +
                "就算对方顶着幽香那个进攻性很强的Boss也能够开花。尽管幽香存在这些不利因素，但是幽香高手仍然能够把她玩的很好。"
        },
        // Reisen
        "reisen": {
            "en_US": "Good defense, terrible offense; that is Reisen in a nutshell. Her spell creates too many bullets. " +
                "She should only win against characters with slow charge speeds who cannot keep up with the all-out spell spam " +
                "that will inevitably ensue. Reisen herself is well-equipped to deal with that situation, " +
                "with her good scope, charge speed, and charge attack. Even then, between skilled enough players, " +
                "a single round with Reisen in it can easily take a half hour or longer, " +
                "regardless of which player theoretically has the upper hand. All in all, while Reisen is by no means high tier, " +
                "she is potentially dangerous by forcing her opponent to endure for a long time.",
            "zh_CN": "防守厉害进攻很差的机体就是铃仙。她的C2给对面太多子弹了，所以她只能赢那些蓄力速度很慢，在后期开花被淹死的机体。" +
                "铃仙本人则很擅长应对后期的开花，她的速度快，蓄力快，C1能打得远。尽管如此，厉害的花映塚玩家之间，只要有人祭出铃仙，" +
                "那么她们的比赛很容易打上半个小时，无论哪边更厉害一点。总而言之，铃仙虽然不是很厉害，但是她能够打击对方的膀胱，有潜在的杀伤力。"
        },
        // Sakuya
        "sakuya": {
            "en_US": "Her focused movement speed is barely different from her normal speed. This is strictly a weakness: " +
                "she's too fast for precision, while also being too slow for anything else. The scope is awkward. " +
                "The charge attack is even more useless than Reimu's. She is subject to a strange glitch; " +
                "her time stop ends the bullet clearing effect of her spells. The result is that both the level 2 and level 3 spells " +
                "clear the same area on her field, and this area is smaller than the area a normal character's level 2 would clear. " +
                "Additionally, should you cast a level 2 just before an automatic level 3 occurs (through spell points reaching 500k) " +
                "the time stop will cut it short instantaneously, and it will clear no bullets at all. " +
                "The time stop can also toy with enemy spells, causing bullets which should have spawned over time to spawn all at once " +
                "(for instance, Aya's spell can become a blanket across the whole screen). This is yet another weakness in many cases, " +
                "as it can lead to unpredictable things, though arguably it could be advantageous in some cases. Her spell itself is not " +
                "threatening to the opponent, since it spawns very few bullet that also appear all at once; " +
                "this makes it easy for the opponent to clear it away with their own spell. " +
                "In fact, it can often be cleared by a spell that was cast before the bullets even appeared. " +
                "The knife rows can limit the opponent's movement but are very slow and become a non-issue, as " +
                "spells are cast more frequently as the match progresses. The boss summon also uses slow, simple patterns. " +
                "To summarize, while she does have some minor positive points, the negative outweighs the positive for the " +
                "knife-throwing maid.",
            "zh_CN": "她的高低速没啥区别，算是个缺点，因为她很难精确的定位，并且需要大范围拉扯的时候又比较慢。她的固灵很难受，C1比灵梦还差。" +
                "并且16有个非常大的BUG，就是时间停止后C2的消弹就会被吃掉，也就是她的C2和C3消弹范围一样，并且比其他的机体还小。" +
                "同时到达50万的C3出现之前你放了个C2的话，那么你C2直接会被全部吃掉，无论是时停的时间还是消弹。同时时停还可以影响对方的C2，" +
                "使原本逐渐发出的C2在同一时间发出（比如文的C2就会变成一排），这大部分时间不可控，而且算是对自己防守不利的因素。她的C2子弹少，" +
                "而且出现在对方身边，导致对方很容易消除这些C2，甚至先放出C2都可以完美消除16的C2进攻。她的EX可以限制对手，但是速度比较慢，" +
                "所以压力并不大，因为随着时间的进行，C2的次数会变多。Boss进攻速度慢，并且招式较为单一。总而言之，虽然16有她强势的地方，但是还是弊大于利。"
        },
        // Lunasa
        "lunasa": {
            "en_US": "While her movement and charge speeds are good, her defense is still a bit low thanks to " +
                "her awkward scope and three-way shot. Her offense is likewise nothing to write home about. " +
                "Her spell is so slow it hardly matters at all. Her extra attacks are okay for limiting the opponent's space, " +
                "but are again very slow and can be easily streamed much like Aya's. Her boss is also unimpressive, " +
                "with one attack in particular that's just free energy for the opponent. The overall mediocre offensive and " +
                "defensive capability result in this Prismriver sister being a low tier character.",
            "zh_CN": "她的移速和蓄力速度虽然都很快，但是她的射程和三方向子弹让她的防守并不是那么的优秀。她的进攻一般般，C2很慢，没啥进攻能力。" +
            "她的EX可以堆积并限制对方的移动空间，但是又很慢，很容易像文那样流出屏幕。她的Boss没啥用，而且还有一种能给对方带来大量白弹的进攻。" +
            "整体上平庸的进攻能力和防守能力让露娜萨只能是个弱机。"
        },
        // Merlin
        "merlin": {
            "en_US": "Her movement, scope, and charge speed are all very slow. " +
                "The scope is essentially Lyrica's, but horizontal, and her charge attack shoots horizontally as well. " +
                "Her basic shots do not spawn from the center of her sprite but rather from two points to her left and right. " +
                "The shots from the right fly diagonally left and the ones from the left fly diagonally right, " +
                "crossing each other's paths a short distance in front of her. If she hugs a wall, " +
                "the shots that should be spawning from off screen will simply fail to appear. " +
                "Thanks to her scope, she has difficulty dealing with spirits, unless she stays focused for long stretches of time, " +
                "which of course slows her down even further and limits the fairy spawns on her screen. " +
                "Offensively, she's pretty good. Her spells last forever and limit the opponent's movement, " +
                "while her extra attacks send big bullets all over the screen. Her boss is also fairly strong. " +
                "Worse than her sisters in terms of defense, Merlin's offense somewhat makes up for it, keeping her out " +
                "of the lowest tier.",
            "zh_CN": "移动速度慢，蓄力速度慢，固灵展开慢，而且固灵是个横向莉莉卡，C1也是横向的。她的点射不是向上的，而是左边往右，" +
                "右边往左的交叉，同时如果她贴边，那墙外的射击就被吃掉了。而且因为她固灵差，所以她很难点射到妖精；而长时间的固灵则会使她走的更慢，" +
                "并且让场上的妖精队减少。但是她进攻还凑合，持续的C2限制对手的移动区域，并且EX的大子弹会大范围的在对方屏幕上堆积，同时Boss也很强。" +
                "虽然在防守方面很差，但是她强大的进攻或多或少的弥补了这一劣势，使她不是垫底角色。"
        },
        // Aya
        "aya": {
            "en_US": "Her focused speed is uncomfortably fast. Her spell and Extra attack aren't individually terrible, but " +
                "play exactly the same role, so as long as the opponent carefully moves in one direction, they have very little " +
                "to worry about. Still, her offense can be okay when the game picks up, especially when her boss is present, " +
                "since this makes it very hard for the opponent to move up. Her big problem is her defense. " +
                "She has a hard time micrododging and gets tons of fast bullets continuously sent back at her from her spells. " +
                "With this decidedly weak defense, combined with her decent, but not great, offense, she struggles to win most matches.",
            "zh_CN": "她低速移动太快了影响了自己的避弹，而且C2和EX并没有太大的杀伤，而且效果相同，所以对方只要微移躲狙就行了。" +
                "尽管这样，文开局的进攻还是很厉害的，尤其Boss在场的时候，对方很难向上移动。她主要问题是她的返弹太快了。她固灵使用很困难，" +
                "并且需要承受成吨的她本身的C2返弹。由于她防守很差，进攻有，但是不出色，所以她很难赢得大部分的比赛。"
        },
        // Mystia
        "mystia": {
            "en_US": "Defensively, she's not bad. Good speeds, fast scope, and an acceptable charge attack. " +
                "Her offense, however, is miserable. The spell takes a thousand years to appear, and even once it starts to move, " +
                "the bullets are slow. You might think at first that its slow appearance would make it somewhat resistant to " +
                "being cancelled by the opponent's spells, but there is actually a single 'generator' bullet (the bird-like thing) " +
                "that spawns all of the others, and when that gets cleared, the whole spell fails to appear. " +
                "Once the game picks up, the generator bullet will invariably be cleared away every time before the " +
                "spell does anything at all and her boss and extra attacks all behave similarly. Everything's just way too slow, " +
                "the combined effect of which leads to Mystia's bottom tier placement.",
            "zh_CN": "防守很强的机体。移动速度和蓄力速度都不错，固灵很舒服，C1也还凑合。但是她进攻能力太差了。她C2要一万年才能动，" +
                "而且就算动了子弹速度也很慢。你可能会认为她C2发生的慢可以让对方难以消除，但是你只要消掉领头的小鸟，整个C2就没了。" +
                "包括Boss的攻击和EX。这机体进攻速度太慢了，所以导致了她在整个花映塚机体排位中在底层。"
        },
        // Cirno
        "cirno": {
            "en_US": "She's fast and has an okay scope. She charges a bit slowly, but this doesn't matter too much. " +
                "Her spell attack creates a simple ring of bullets, then freezes all bullets on both players screens " +
                "(with the exception of a few character's extra attacks, including Cirno's), randomly changes their directions, " +
                "then sends them all moving at once. The original speed of the bullets is not retained. Additionally, " +
                "some non-pellet bullets on Cirno's screen (not the opponent's) will degrade into pellets, " +
                "allowing them to be reflected. Her boss is very weak and her extra attacks are nothing special. " +
                "Thanks to the freezing effect of her spells, Cirno has excellent defense and terrible offense, " +
                "as her spells essentially help the opponent just as much as they help her. She's like Reisen, but even more extreme. " +
                "The ice fairy's horribly skewed playability, fully specializing in defensive play, renders her hard to use " +
                "in a competitive environment.",
            "zh_CN": "她移动速度快，固灵速度也不错。蓄力有点慢，但是不重要。她的C2攻击会创建一个子弹环，" +
                "然后冻结场上的所有弹幕（包括琪露诺自己的，但是除了一些特定的EX）。然后改变子弹的移动方向，并且子弹不会保留冻结之前的速度。同时，" +
                "琪露诺场上的一些不可消子弹会退化成白弹，使它们可以被消除推过去。她的Boss性能差，EX也不行。琪露诺防守强，但是进攻实在太差，" +
                "她的C2给对面也缓和了压力，像是更极端的大兔子。完全在防守上面倾斜的机体，在竞技环境上很难使用。"
        },
        // Tewi
        "tewi": {
            "en_US": "Fast while unfocused, slow when focused. Her charge speed is excellent. " +
                "Her scope is slow and poorly shaped (much like Merlin's), her charge attack is terrible. " +
                "While slow focused speed is normally ideal, it's a rotten combination with slow scope speed, " +
                "so spirits become a much greater nuisance than they would usually be. Her extra attacks aren't garbage, " +
                "but aren't very good either. They move too slowly to really accomplish anything. " +
                "Her spell has barely any bullets and on top of that is easily cleared away before it does anything. " +
                "The boss is pretty wimpy and has a pellet attack that's basically free energy for the opponent. " +
                "Her ability is passable; it allows you attempt a level 2 rather than bombing even in very risky situations, " +
                "knowing the bomb will save you anyway if you get hit. Altogether, her offense is pathetic and " +
                "her terrible scope cripples her defense, making her one of the least viable characters in the game.",
            "zh_CN": "固灵时移速慢，不固灵时速度很快，蓄力速度也很快。但是她的固灵展开很慢，而且形状很差，就像梅露兰那样。" +
                "虽然固灵状态下的移速慢通常是件好事，但是和她固灵展开速度也慢这样的特性结合，就使得她很难处理灵。她的EX攻击强度一般般，" +
                "但是速度太慢，导致很难造成有效的杀伤。同时她的C2进攻没啥子弹，而且在产生有效的杀伤之前就很容易被消除。Boss进攻能力也很差，" +
                "也有个完全给对面送气的攻击。她的能力还不错，在高压下可以不用按X硬扭。总而言之，小兔子进攻差，而且固灵范围让她的防守也变得很差，" +
                "使得她是游戏中最弱的角色之一。"
        },
    },
    MIN_SPEED = 148,
    MIN_CHARGE = 45.5;

function emptyModal() {
    $("#modal_inner").html("");
    $("#modal_inner").css("display", "none");
    $("#modal").css("display", "none");
}

function closeModal(event) {
    var modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.keyCode && event.keyCode == 27)) {
        emptyModal();
    }
}

function isMobile() {
    return navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1;
}

function charInfo() {
    var chara = this.title.split(' ')[0].toLowerCase();

    var speed = MIN_SPEED - STATS[chara].speed,
        focus = Math.max(MIN_SPEED - STATS[chara].focus, 1.5),
        //scope = Math.max(minScope - STATS[char].scope, 3),
        charge = Math.max(MIN_CHARGE - STATS[chara].charge, 0.3);

    emptyModal();

    if (isMobile()) {
        $("#modal_inner").html("<h2>" + this.title + "</h2><table class='noborders'><tr>" +
        "<td class='noborders'><img class='art' src='assets/pofv/characters/" + chara + ".png' alt='" + this.title + "'></td>" +
        "<td class='noborders'><table class='stats noborders'>" +
        "<tr><td class='noborders'>Tier</td>" +
        "<td class='noborders'><strong class='" + TIER[chara] + "'>" + TIER[chara] + "</strong></td></tr>" +
        "<tr><td class='noborders'>Normal Speed</td><td class='noborders'><progress value='" + speed + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Focused Speed</td><td class='noborders'><progress value='" + focus + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Charge Speed</td><td class='noborders'><progress value='" + charge + "' max='20.5'></td></tr>" +
        "<tr><td class='noborders'>Charge Delay</td><td class='noborders'>" + STATS[chara].delay + " frames</td></tr>" +
        "<tr><td class='noborders'>Special Ability</td><td class='noborders'>" + ABILITY[chara] + "</td></tr>" +
        "<tr><td class='noborders'>Scope</td><td class='noborders'>" + SCOPE[chara] + "</td></tr></table>" +
        "</td></tr></table><img class='scope' src='assets/pofv/scopes/" + chara +
        ".jpg'><p class='descr'>" + DESCRIPTION[chara][language] + "</p>");
    } else {
        $("#modal_inner").html("<h2>" + this.title + "</h2><table class='noborders'><tr>" +
        "<td class='noborders'><img class='art' src='assets/pofv/characters/" + chara + ".png' alt='" + this.title + "'></td>" +
        "<td class='noborders'><table class='stats noborders'>" +
        "<tr><td class='noborders'>Tier</td>" +
        "<td class='noborders'><strong class='" + TIER[chara] + "'>" + TIER[chara] + "</strong></td></tr>" +
        "<tr><td class='noborders'>Normal Speed</td><td class='noborders'><progress value='" + speed + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Focused Speed</td><td class='noborders'><progress value='" + focus + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Charge Speed</td><td class='noborders'><progress value='" + charge + "' max='20.5'></td></tr>" +
        "<tr><td class='noborders'>Charge Delay</td><td class='noborders'>" + STATS[chara].delay + " frames</td></tr>" +
        "<tr><td class='noborders'>Special Ability</td><td class='noborders'>" + ABILITY[chara] + "</td></tr>" +
        "<tr><td class='noborders'>Scope</td><td class='noborders'>" + SCOPE[chara] + "</td></tr></table></td>" +
        "<td class='noborders'><img class='scope' src='assets/pofv/scopes/" + chara + ".jpg'></td></tr></table>" +
        "<p class='descr'>" + DESCRIPTION[chara][language] + "</p>");
    }

    $("#modal_inner").append();
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function setLanguage(event) {
    var newLanguage = event.data.language;

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    setCookie("lang", newLanguage);
    location.href = location.href.split('#')[0].split('?')[0];
}

$(document).ready(function () {
    if (getCookie("lang") == "zh_CN" || location.href.contains("zh")) {
        language = "zh_CN";
    }

    $("body").on("click", closeModal);
    $("body").on("keypress", closeModal);
    $(".char").on("click", charInfo);
    $(".flag").attr("href", "");
    $("#en").on("click", {language: "en_US"}, setLanguage);
    $("#zh").on("click", {language: "zh_CN"}, setLanguage);
});
