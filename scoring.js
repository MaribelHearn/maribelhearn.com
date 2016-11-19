var rand = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

var load = function () {
    var random = rand(1, 8);
    document.body.style.background = "url('./bg/" + random + ".png')";
};

var WRs = {
    "HRtP": {
        "Easy": {
            "Makai": [11478940, "Zil", ""],
            "Jigoku": [11605330, "SEO", ""]
        },
        "Normal": {
            "Makai": [11412100, "Zil", ""],
            "Jigoku": [11213090, "SEO", ""]
        },
        "Hard": {
            "Makai": [11331720, "Zil", ""],
            "Jigoku": [11365460, "Karisa", ""]
        },
        "Lunatic": {
            "Makai": [14083170, "Vex", ""],
            "Jigoku": [14292970, "Zil", ""]
        }
    },
    "SoEW": {
        "Easy": {
            "ReimuA": [21049470, "KirbyComment", ""],
            "ReimuB": [20713130, "KirbyComment", ""],
            "ReimuC": [18783800, "KirbyComment", ""]
        },
        "Normal": {
            "ReimuA": [21477840, "KirbyComment", ""],
            "ReimuB": [22068970, "KirbyComment", ""],
            "ReimuC": [19042440, "KirbyComment", ""]
        },
        "Hard": {
            "ReimuA": [18772850, "Das", ""],
            "ReimuB": [30858690, "KirbyComment", ""],
            "ReimuC": [0, "", ""]
        },
        "Lunatic": {
            "ReimuA": [30684360, "Das", ""],
            "ReimuB": [21620680, "Cream", ""],
            "ReimuC": [13666670, "theshim", ""]
        },
        "Extra": {
            "ReimuA": [38386620, "KirbyComment", ""],
            "ReimuB": [38105400, "KirbyComment", ""],
            "ReimuC": [33862900, "KirbyComment", ""]
        }
    },
    "PoDD": {
        "Easy": {
            "Reimu": [40240610, "KirbyComment", ""],
            "Mima": [54217980, "Zil", ""],
            "Marisa": [33508440, "Zil", ""],
            "Ellen": [34445250, "KirbyComment", ""],
            "Kotohime": [40921540, "KirbyComment", ""],
            "Kana": [33508440, "Zil", ""],
            "Rikako": [41872510, "Zil", ""],
            "Chiyuri": [39007340, "Zil", ""],
            "Yumemi": [32230170, "KirbyComment", ""]
        },
        "Normal": {
            "Reimu": [46994700, "KirbyComment", ""],
            "Mima": [69452980, "Zil", ""],
            "Marisa": [53852230, "Zil", ""],
            "Ellen": [51429240, "KirbyComment", ""],
            "Kotohime": [54472060, "Zil", ""],
            "Kana": [50178940, "Zil", ""],
            "Rikako": [42041710, "KirbyComment", ""],
            "Chiyuri": [54565290, "Zil", ""],
            "Yumemi": [48953180, "Zil", ""]
        },
        "Hard": {
            "Reimu": [72034400, "Zil", ""],
            "Mima": [87838350, "Zil", ""],
            "Marisa": [75329060, "Zil", ""],
            "Ellen": [89790060, "KirbyComment", ""],
            "Kotohime": [87731690, "Zil", ""],
            "Kana": [71107660, "Zil", ""],
            "Rikako": [62076530, "Zil", ""],
            "Chiyuri": [82125270, "Zil", ""],
            "Yumemi": [70987490, "Zil", ""]
        },
        "Lunatic": {
            "Reimu": [102765870, "Zil", ""],
            "Mima": [121289990, "Zil", ""],
            "Marisa": [109691220, "Zil", ""],
            "Ellen": [112796380, "Zil", ""],
            "Kotohime": [116461740, "Zil", ""],
            "Kana": [109828660, "Zil", ""],
            "Rikako": [95298150, "Zil", ""],
            "Chiyuri": [132887750, "Zil", ""],
            "Yumemi": [107138760, "Zil", ""]
        }
    },
    "LLS": {
        "Easy": {
            "ReimuA": [56074820, "Karisa", ""],
            "ReimuB": [68786970, "KirbyComment", ""],
            "MarisaA": [25375980, "Lollipop", ""],
            "MarisaB": [60481450, "KirbyComment", ""]
        },
        "Normal": {
            "ReimuA": [91536580, "Karisa", ""],
            "ReimuB": [128477620, "KirbyComment", ""],
            "MarisaA": [54023720, "S-TORA", ""],
            "MarisaB": [108524270, "Chirpy", ""]
        },
        "Hard": {
            "ReimuA": [100687310, "Karisa", ""],
            "ReimuB": [0, "", ""],
            "MarisaA": [99991110, "Das", ""],
            "MarisaB": [0, "", ""]
        },
        "Lunatic": {
            "ReimuA": [71755090, "BaitySM", ""],
            "ReimuB": [107064900, "Chirpy", ""],
            "MarisaA": [110559130, "Das", ""],
            "MarisaB": [81845390, "Zodiac", ""]
        },
        "Extra": {
            "ReimuA": [78308100, "Karisa", ""],
            "ReimuB": [78625740, "Zil", ""],
            "MarisaA": [80289020, "ぴえとろ", ""],
            "MarisaB": [79182030, "Chirpy", ""]
        }
    },
    "MS": {
        "Easy": {
            "Reimu": [73893590, "Zil", ""],
            "Marisa": [72999090, "Zil", ""],
            "Mima": [79992120, "Zil", ""],
            "Yuuka": [70576320, "Zil", ""]
        },
        "Normal": {
            "Reimu": [107903760, "Karisa", ""],
            "Marisa": [105722950, "Karisa", ""],
            "Mima": [125172350, "Zigzagwolf", ""],
            "Yuuka": [97709710, "Karisa", ""]
        },
        "Hard": {
            "Reimu": [129269130, "Karisa", ""],
            "Marisa": [145311910, "Zigzagwolf", ""],
            "Mima": [163109770, "Zil", ""],
            "Yuuka": [113038430, "Karisa", ""]
        },
        "Lunatic": {
            "Reimu": [153914430, "Zil", ""],
            "Marisa": [145110450, "Zil", ""],
            "Mima": [167946790, "Zigzagwolf", ""],
            "Yuuka": [123103180, "Zil", ""]
        },
        "Extra": {
            "Reimu": [193632780, "Zigzagwolf", ""],
            "Marisa": [170836740, "Zigzagwolf", ""],
            "Mima": [204022370, "部屋干し", ""],
            "Yuuka": [186900220, "Zigzagwolf", ""]
        }
    },
    "EoSD": {
        "Easy": {
            "ReimuA": [147501700, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud1203.rpy"],
            "ReimuB": [172044560, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud13d0.rpy"],
            "MarisaA": [152283550, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud10a2.rpy"],
            "MarisaB": [156937990, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud1043.rpy"]
        },
        "Normal": {
            "ReimuA": [303504070, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud135e.rpy"],
            "ReimuB": [347208050, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud1130.rpy"],
            "MarisaA": [308626960, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud1403.rpy"],
            "MarisaB": [303379260, "MATSU", "http://score.royalflare.net/th06/replay6/th6_ud0f71.rpy"]
        },
        "Hard": {
            "ReimuA": [403623070, "st", "http://score.royalflare.net/th06/replay6/th6_ud1040.rpy"],
            "ReimuB": [453340130, "st", "http://score.royalflare.net/th06/replay6/th6_ud0eed.rpy"],
            "MarisaA": [404007980, "TA", "http://score.royalflare.net/th06/replay6/th6_ud127d.rpy"],
            "MarisaB": [438052810, "st", "http://score.royalflare.net/th06/replay6/th6_ud1026.rpy"]
        },
        "Lunatic": {
            "ReimuA": [544487970, "Miki", "http://pndsng.wwww.jp/touhou/highscores/replay/th6_ud0008.rpy"],
            "ReimuB": [665148660, "Cactu", ""],
            "MarisaA": [581241260, "OOSAKA", "http://pndsng.wwww.jp/touhou/highscores/replay/th6_ud0016.rpy"],
            "MarisaB": [645324510, "OOSAKA", "http://pndsng.wwww.jp/touhou/highscores/replay/th6_ud0003.rpy"]
        },
        "Extra": {
            "ReimuA": [629609710, "OOSAKA", "https://zh.touhouwiki.net/images/0/08/Th6_ud0501.rpy"],
            "ReimuB": [642579790, "OOSAKA", "https://zh.touhouwiki.net/images/e/e9/Th6_ud0502.rpy"],
            "MarisaA": [631488580, "OOSAKA", "https://zh.touhouwiki.net/images/7/76/Th6_udz973.rpy"],
            "MarisaB": [663244220 , "OOSAKA", "https://zh.touhouwiki.net/images/5/53/Th6_udx716.jpg"]
        }
    },
    "PCB": {
        "Easy": {
            "ReimuA": [1799871950, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d79.rpy"],
            "ReimuB": [2042271460, "Yu-suke", ""],
            "MarisaA": [1950541980, "Lcy", "http://score.royalflare.net/th07/replay7/th7_ud21ab.rpy"],
            "MarisaB": [1768291980, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d45.rpy"],
            "SakuyaA": [1777849120, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d7a.rpy"],
            "SakuyaB": [1929606150, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d7b.rpy"]
        },
        "Normal": {
            "ReimuA": [2001369010, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1b7a.rpy"],
            "ReimuB": [2167768950, "clo-naga", "http://score.royalflare.net/th07/replay7/th7_ud212a.rpy"],
            "MarisaA": [2132017710, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d94.rpy"],
            "MarisaB": [2011470500, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1b88.rpy"],
            "SakuyaA": [2014928480, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1b85.rpy"],
            "SakuyaB": [2104019460, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d92.rpy"]
        },
        "Hard": {
            "ReimuA": [2548721870, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1db4.rpy"],
            "ReimuB": [2820415430, "st", "http://score.royalflare.net/th07/replay7/th7_ud1ef1.rpy"],
            "MarisaA": [2576184230, "st", "http://score.royalflare.net/th07/replay7/th7_ud1ec6.rpy"],
            "MarisaB": [2387521220, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d95.rpy"],
            "SakuyaA": [2379101080, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d96.rpy"],
            "SakuyaB": [2778765040, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d97.rpy"]
        },
        "Lunatic": {
            "ReimuA": [3001249690, "Yu-suke", "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0251.rpy"],
            "ReimuB": [3643993290, "Yu-suke", "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0047.rpy"],
            "MarisaA": [2899605950, "PTS", "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0052.rpy"],
            "MarisaB": [2703783480, "rori-", "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0315.rpy"],
            "SakuyaA": [2703191180, "pndsng", "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0223.rpy"],
            "SakuyaB": [3859588140, "Yu-suke", "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0283.rpy"]
        },
        "Extra": {
            "ReimuA": [1368382510, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1d14.rpy"],
            "ReimuB": [1441790870, "いな", "http://score.royalflare.net/th07/replay7/th7_ud2257.rpy"],
            "MarisaA": [1257244350, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1f23.rpy"],
            "MarisaB": [1242595110, "HS参謀", "http://score.royalflare.net/th07/replay7/th7_ud1f43.rpy"],
            "SakuyaA": [1277681830, "いな", "http://score.royalflare.net/th07/replay7/th7_ud2267.rpy"],
            "SakuyaB": [1412782710, "いな", "http://score.royalflare.net/th07/replay7/th7_ud2233.rpy"]
        },
        "Phantasm": {
            "ReimuA": [1580640510, "Yu-suke", "https://zh.touhouwiki.net/images/1/14/Th7_ud1f4a.rpy"],
            "ReimuB": [1710441020, "Yu-suke", "http://score.royalflare.net/th07/replay7/th7_ud21a2.rpy"],
            "MarisaA": [1515839630, "Yu-suke", "http://score.royalflare.net/th07/replay7/th7_ud21a1.rpy"],
            "MarisaB": [1507090340, "Yu-suke", "http://score.royalflare.net/th07/replay7/th7_ud219b.rpy"],
            "SakuyaA": [1524310930, "Yu-suke", "http://score.royalflare.net/th07/replay7/th7_ud218a.rpy"],
            "SakuyaB": [1671913330, "Yu-suke", "http://score.royalflare.net/th07/replay7/th7_ud217c.rpy"]
        }
    },
    "IN": {
        "Easy": {
            "BorderTeam": [2637629490, "st", "http://score.royalflare.net/th08/dlreplay.cgi?id=2361"],
            "MagicTeam": [3084533670, "coco", "http://score.royalflare.net/th08/dlreplay.cgi?id=2839"],
            "ScarletTeam": [3012091640, "coco", "http://score.royalflare.net/th08/dlreplay.cgi?id=27da"],
            "GhostTeam": [2764571140, "coco", "http://score.royalflare.net/th08/dlreplay.cgi?id=28b1"],
            "Reimu": [2714579940, "KWS", "http://score.royalflare.net/th08/dlreplay.cgi?id=1f48"],
            "Yukari": [1731029240, "ラビ", "http://score.royalflare.net/th08/dlreplay.cgi?id=1d41"],
            "Marisa": [3127823070, "coco", "http://score.royalflare.net/th08/dlreplay.cgi?id=2845"],
            "Alice": [1813182090, "Eternal", "http://score.royalflare.net/th08/dlreplay.cgi?id=0452"],
            "Sakuya": [2559477930, "Suika", "http://score.royalflare.net/th08/dlreplay.cgi?id=1901"],
            "Remilia": [191553325, "tomo", "http://score.royalflare.net/th08/dlreplay.cgi?id=09a7"],
            "Youmu": [3379425090, "coco", "http://score.royalflare.net/th08/dlreplay.cgi?id=2873"],
            "Yuyuko": [1734179460, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0f9f"]
        },
        "Normal": {
            "BorderTeam": [3893073500, "st", "http://score.royalflare.net/th08/dlreplay.cgi?id=23f8"],
            "MagicTeam": [3895532070, "LET", "http://score.royalflare.net/th08/dlreplay.cgi?id=0599"],
            "ScarletTeam": [4007899720, "LET", "http://score.royalflare.net/th08/dlreplay.cgi?id=096b"],
            "GhostTeam": [3907285270, "LET", "http://score.royalflare.net/th08/dlreplay.cgi?id=18a2"],
            "Reimu": [3394175570, "LET", "http://score.royalflare.net/th08/dlreplay.cgi?id=04f0"],
            "Yukari": [2419192380, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0f70"],
            "Marisa": [3570181460, "K・G", "http://score.royalflare.net/th08/dlreplay.cgi?id=2922"],
            "Alice": [2429706040, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0f79"],
            "Sakuya": [3055555970, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0f82"],
            "Remilia": [2755844610, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0f95"],
            "Youmu": [4496668100, "coco", "http://score.royalflare.net/th08/dlreplay.cgi?id=2946"],
            "Yuyuko": [2485053240, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0fa0"]
        },
        "Hard": {
            "BorderTeam": [4502225760, "LET", "http://score.royalflare.net/th08/dlreplay.cgi?id=09d2"],
            "MagicTeam": [4533616650, "LET", "http://score.royalflare.net/th08/dlreplay.cgi?id=0862"],
            "ScarletTeam": [4506799970, "LET", "http://score.royalflare.net/th08/dlreplay.cgi?id=081b"],
            "GhostTeam": [4708571630, "PALM", "http://score.royalflare.net/th08/dlreplay.cgi?id=27c7"],
            "Reimu": [3653112510, "Eternal", "http://score.royalflare.net/th08/dlreplay.cgi?id=0922"],
            "Yukari": [2991504170, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0ed9"],
            "Marisa": [3558337820, "KLG", "http://score.royalflare.net/th08/dlreplay.cgi?id=1bbd"],
            "Alice": [2758767770, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0f7a"],
            "Sakuya": [3687402450, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0f8e"],
            "Remilia": [3006963610, "AQUA", "http://score.royalflare.net/th08/dlreplay.cgi?id=1190"],
            "Youmu": [5242086820, "PALM", "http://score.royalflare.net/th08/dlreplay.cgi?id=287b"],
            "Yuyuko": [2828843340, "水性すらいむ", "http://score.royalflare.net/th08/dlreplay.cgi?id=0fa2"]
        },
        "Lunatic": {
            "BorderTeam": [6121136060, "Inefushi", "http://pndsng.wwww.jp/touhou/highscores/replay/th8_ud0088.rpy"],
            "MagicTeam": [6168365790, "Inefushi", "http://pndsng.wwww.jp/touhou/highscores/replay/th8_ud0090.rpy"],
            "ScarletTeam": [6565277950, "Inefushi", "http://pndsng.wwww.jp/touhou/highscores/replay/th8_ud0084.rpy"],
            "GhostTeam": [6458237920, "岩魚穣娘", "http://pndsng.wwww.jp/touhou/highscores/replay/th8_ud0100.rpy"],
            "Reimu": [4359005630, "R@P", "http://score.royalflare.net/th08/dlreplay.cgi?id=07f0"],
            "Yukari": [3646001370, "SET", "http://score.royalflare.net/th08/dlreplay.cgi?id=1702"],
            "Marisa": [4748592990, "PALM", "http://score.royalflare.net/th08/dlreplay.cgi?id=27c5"],
            "Alice": [3500438410, "asbr", "http://score.royalflare.net/th08/dlreplay.cgi?id=209d"],
            "Sakuya": [4022200840, "K・G", "http://score.royalflare.net/th08/dlreplay.cgi?id=2954"],
            "Remilia": [3727419620, "K・G", "http://score.royalflare.net/th08/dlreplay.cgi?id=2945"],
            "Youmu": [6695345940, "Inefushi", "http://pndsng.wwww.jp/touhou/highscores/replay/th8_ud0082.rpy"],
            "Yuyuko": [3691650760, "SET", "http://score.royalflare.net/th08/dlreplay.cgi?id=180d"]
        },
        "Extra": {
            "BorderTeam": [2957550150, "ASL", "http://score.royalflare.net/th08/dlreplay.cgi?id=274c"],
            "MagicTeam": [3021639920, "ASL", "http://score.royalflare.net/th08/dlreplay.cgi?id=2936"],
            "ScarletTeam": [3000284220, "ASL", "http://score.royalflare.net/th08/dlreplay.cgi?id=2937"],
            "GhostTeam": [3001994340, "ASL", "http://score.royalflare.net/th08/dlreplay.cgi?id=2938"],
            "Reimu": [2310715730, "ASAPIN", "http://score.royalflare.net/th08/dlreplay.cgi?id=0349"],
            "Yukari": [1817410330, "YABU", "http://score.royalflare.net/th08/dlreplay.cgi?id=1eaf"],
            "Marisa": [2549422900, "YABU", "http://score.royalflare.net/th08/dlreplay.cgi?id=217d"],
            "Alice": [1743695170, "Eternal", "http://score.royalflare.net/th08/dlreplay.cgi?id=06fc"],
            "Sakuya": [2357010670, "ASAPIN", "http://score.royalflare.net/th08/dlreplay.cgi?id=0314"],
            "Remilia": [1852942870, "専属メイド", "http://score.royalflare.net/th08/dlreplay.cgi?id=2776"],
            "Youmu": [3159508570, "Sakurei", "http://score.royalflare.net/th08/dlreplay.cgi?id=28be"],
            "Yuyuko": [1977266880, "YABU", "http://score.royalflare.net/th08/dlreplay.cgi?id=1f34"]
        }
    },
    "PoFV": {
        "Easy": {
            "Reimu": [120818210, "yet", "http://replays.gensokyo.org/download.php?id=36469"],
            "Marisa": [154331830, "yet", "http://replays.gensokyo.org/download.php?id=36470"],
            "Sakuya": [116366730, "yet", "http://replays.gensokyo.org/download.php?id=36471"],
            "Youmu": [151506930, "yet", "http://replays.gensokyo.org/download.php?id=40554"],
            "Reisen": [230409230, "yet", "http://replays.gensokyo.org/download.php?id=38663"],
            "Cirno": [174712460, "Zil", "http://replays.gensokyo.org/download.php?id=31997"],
            "Lyrica": [119701340, "yet", "http://replays.gensokyo.org/download.php?id=38651"],
            "Mystia": [155081080, "yet", "http://replays.gensokyo.org/download.php?id=40478"],
            "Tewi": [118207340, "yet", "http://replays.gensokyo.org/download.php?id=38652"],
            "Aya": [100363590, "yet", "http://replays.gensokyo.org/download.php?id=41059"],
            "Medicine": [110751140, "yet", "http://replays.gensokyo.org/download.php?id=38654"],
            "Yuuka": [116698540, "yet", "http://replays.gensokyo.org/download.php?id=38648"],
            "Komachi": [118727850, "yet", "http://replays.gensokyo.org/download.php?id=36474"],
            "Eiki": [213036900, "yet", "http://replays.gensokyo.org/download.php?id=40315"]
        },
        "Normal": {
            "Reimu": [213107450, "yet", "http://replays.gensokyo.org/download.php?id=40778"],
            "Marisa": [304726740, "yet", "http://replays.gensokyo.org/download.php?id=38649"],
            "Sakuya": [176406360, "yet", "http://replays.gensokyo.org/download.php?id=36510"],
            "Youmu": [236694220, "sonitsuku", "http://replays.gensokyo.org/download.php?id=40382"],
            "Reisen": [332105510, "yet", "http://replays.gensokyo.org/download.php?id=36511"],
            "Cirno": [246385060, "Zil", "http://replays.gensokyo.org/download.php?id=30102"],
            "Lyrica": [181132720, "yet", "http://replays.gensokyo.org/download.php?id=40776"],
            "Mystia": [203944960, "yet", "http://replays.gensokyo.org/download.php?id=38640"],
            "Tewi": [179715380, "yet", "http://replays.gensokyo.org/download.php?id=40775"],
            "Aya": [112894390, "Zil", "http://replays.gensokyo.org/download.php?id=33115"],
            "Medicine": [126072650, "yet", "http://replays.gensokyo.org/download.php?id=38656"],
            "Yuuka": [201162000, "yet", "http://replays.gensokyo.org/download.php?id=40774"],
            "Komachi": [213809060, "Zil", "http://replays.gensokyo.org/download.php?id=32685"],
            "Eiki": [468800480, "FSX", ""]
        },
        "Hard": {
            "Reimu": [200759220, "yet", "http://replays.gensokyo.org/download.php?id=37653"],
            "Marisa": [304046510, "yet", "http://replays.gensokyo.org/download.php?id=38650"],
            "Sakuya": [179783750, "yet", "http://replays.gensokyo.org/download.php?id=36515"],
            "Youmu": [277507110, "sonitsuku", "http://replays.gensokyo.org/download.php?id=38867"],
            "Reisen": [326521960, "yet", "http://replays.gensokyo.org/download.php?id=36517"],
            "Cirno": [250035470, "Zil", "http://replays.gensokyo.org/download.php?id=29810"],
            "Lyrica": [187700010, "yet", "http://replays.gensokyo.org/download.php?id=36518"],
            "Mystia": [202079560, "yet", "http://replays.gensokyo.org/download.php?id=36519"],
            "Tewi": [189226430, "yet", "http://replays.gensokyo.org/download.php?id=37652"],
            "Aya": [128031230, "yet", "http://replays.gensokyo.org/download.php?id=36521"],
            "Medicine": [120397580, "yet", "http://replays.gensokyo.org/download.php?id=38624"],
            "Yuuka": [203621500, "Zil", "http://replays.gensokyo.org/download.php?id=32452"],
            "Komachi": [203882270, "yet", "http://replays.gensokyo.org/download.php?id=36522"],
            "Eiki": [618812340, "FSX", ""]
        },
        "Lunatic": {
            "Reimu": [270136420, "yet", "http://replays.gensokyo.org/download.php?id=37657"],
            "Marisa": [413193840, "yet", "http://replays.gensokyo.org/download.php?id=40937"],
            "Sakuya": [200448720, "yet", "http://replays.gensokyo.org/download.php?id=39778"],
            "Youmu": [325671350, "yet", "http://replays.gensokyo.org/download.php?id=41812"],
            "Reisen": [529084000, "yet", "http://replays.gensokyo.org/download.php?id=38722"],
            "Cirno": [415482300, "yet", "http://replays.gensokyo.org/download.php?id=41474"],
            "Lyrica": [200312180, "yet", "http://replays.gensokyo.org/download.php?id=37655"],
            "Mystia": [236264530, "yet", "http://replays.gensokyo.org/download.php?id=40584"],
            "Tewi": [205777860, "yet", "http://replays.gensokyo.org/download.php?id=38510"],
            "Aya": [145093750, "yet", "http://replays.gensokyo.org/download.php?id=41490"],
            "Medicine": [148161920, "yet", "http://replays.gensokyo.org/download.php?id=41491"],
            "Yuuka": [242127330, "yet", "http://replays.gensokyo.org/download.php?id=39976"],
            "Komachi": [250366610, "yet", "http://replays.gensokyo.org/download.php?id=41840"],
            "Eiki": [670343800, "FSX", ""]
        },
        "Extra": {
            "Reimu": [124852720, "yet", "http://ux.getuploader.com/story_extra/download/14/th9_01.rpy"],
            "Marisa": [140015550, "yet", "http://ux.getuploader.com/story_extra/download/13/th9_02.rpy"],
            "Sakuya": [113998290, "yet", "http://ux.getuploader.com/story_extra/download/12/th9_03.rpy"],
            "Youmu": [130081930, "yet", "http://ux.getuploader.com/story_extra/download/11/th9_04.rpy"],
            "Reisen": [316861110, "LET", ""],
            "Cirno": [132531100, "yet", "http://ux.getuploader.com/story_extra/download/9/th9_06.rpy"],
            "Lyrica": [114566410, "yet", "http://ux.getuploader.com/story_extra/download/8/th9_07.rpy"],
            "Mystia": [124277920, "yet", "http://ux.getuploader.com/story_extra/download/7/th9_08.rpy"],
            "Tewi": [111379490, "yet", "http://ux.getuploader.com/story_extra/download/6/th9_09.rpy"],
            "Aya": [110601940, "yet", "http://ux.getuploader.com/story_extra/download/5/th9_10.rpy"],
            "Medicine": [174308280, "Zil", "http://replays.gensokyo.org/download.php?id=32087"],
            "Yuuka": [129349360, "yet", "http://ux.getuploader.com/story_extra/download/3/th9_12.rpy"],
            "Komachi": [148733520, "rori-", "http://replays.gensokyo.org/download.php?id=38956"],
            "Eiki": [235114260, "Zil", "http://replays.gensokyo.org/download.php?id=32093"]
        }
    },
    "MoF": {
        "Easy": {
            "ReimuA": [1551990910, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud15f8.rpy"],
            "ReimuB": [1559754320, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud1611.rpy"],
            "ReimuC": [1562041780, "coa", "http://score.royalflare.net/th10/replay10/th10_ud1482.rpy"],
            "MarisaA": [1557274280, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud1610.rpy"],
            "MarisaB": [1581187460, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud1577.rpy"],
            "MarisaC": [1577570860, "yume", "http://score.royalflare.net/th10/replay10/th10_ud15fd.rpy"]
        },
        "Normal": {
            "ReimuA": [1698758210, "Keroko", "http://score.royalflare.net/th10/replay10/th10_ud1659.rpy"],
            "ReimuB": [1692014350, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud15f9.rpy"],
            "ReimuC": [1636932500, "ark", "http://score.royalflare.net/th10/replay10/th10_ud16cd.rpy"],
            "MarisaA": [1682878740, "ZWB", "http://score.royalflare.net/th10/replay10/th10_ud1847.rpy"],
            "MarisaB": [1718140240, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud1667.rpy"],
            "MarisaC": [1673084100, "yume", "http://score.royalflare.net/th10/replay10/th10_ud1620.rpy"]
        },
        "Hard": {
            "ReimuA": [2000132070, "coa", "http://score.royalflare.net/th10/replay10/th10_ud090d.rpy"],
            "ReimuB": [2038649790, "dxk", "http://score.royalflare.net/th10/replay10/th10_ud1941.rpy"],
            "ReimuC": [2015786990, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud15f7.rpy"],
            "MarisaA": [1787193800, "水性すらいむ", "http://score.royalflare.net/th10/replay10/th10_ud04ee.rpy"],
            "MarisaB": [2015212370, "K・G", "http://score.royalflare.net/th10/replay10/th10_ud1940.rpy"],
            "MarisaC": [2048246580, "キャル", "http://score.royalflare.net/th10/replay10/th10_ud18f9.rpy"]
        },
        "Lunatic": {
            "ReimuA": [2160049630, "流星", "http://pndsng.wwww.jp/touhou/highscores/replay/th10_ud0245.rpy"],
            "ReimuB": [2191799870, "SOC", "http://score.royalflare.net/th10/replay10/th10_ud1919.rpy"],
            "ReimuC": [2175863360, "Spira", "http://score.royalflare.net/th10/replay10/th10_ud189a.rpy"],
            "MarisaA": [2134927060, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud1732.rpy"],
            "MarisaB": [2186471780, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud1624.rpy"],
            "MarisaC": [2214529240, "Nanashi", "http://score.royalflare.net/th10/replay10/th10_ud17ad.rpy"]
        },
        "Extra": {
            "ReimuA": [987343680, "nanamaru", "http://score.royalflare.net/th10/replay10/th10_ud1684.rpy"],
            "ReimuB": [995566970, "wreath", "http://score.royalflare.net/th10/replay10/th10_ud177f.rpy"],
            "ReimuC": [992275980, "Jack", "http://score.royalflare.net/th10/replay10/th10_ud1652.rpy"],
            "MarisaA": [990797120, "wreath", "http://score.royalflare.net/th10/replay10/th10_ud11a9.rpy"],
            "MarisaB": [986704560, "Jack", "http://score.royalflare.net/th10/replay10/th10_ud1570.rpy"],
            "MarisaC": [1002801340, "Jack", "http://score.royalflare.net/th10/replay10/th10_ud1287.rpy"]
        }
    },
    "SA": {
        "Easy": {
            "ReimuA": [659735900, "morth", "http://score.royalflare.net/th11/replay11/th11_ud1349.rpy"],
            "ReimuB": [623749430, "morth", "http://score.royalflare.net/th11/replay11/th11_ud135a.rpy"],
            "ReimuC": [660024840, "morth", "http://score.royalflare.net/th11/replay11/th11_ud135f.rpy"],
            "MarisaA": [706826820, "にゃんこ", "http://score.royalflare.net/th11/replay11/th11_ud1364.rpy"],
            "MarisaB": [713931860, "morth", "http://score.royalflare.net/th11/replay11/th11_ud1371.rpy"],
            "MarisaC": [639535650, "morth", "http://score.royalflare.net/th11/replay11/th11_ud13ba.rpy"]
        },
        "Normal": {
            "ReimuA": [1089307060, "Deep Brillante", "http://score.royalflare.net/th11/replay11/th11_ud119c.rpy"],
            "ReimuB": [1017688610, "小走先輩", "http://score.royalflare.net/th11/replay11/th11_ud1104.rpy"],
            "ReimuC": [1071892480, "にゃんこ", "http://score.royalflare.net/th11/replay11/th11_ud110b.rpy"],
            "MarisaA": [1145838900, "にゃんこ", "http://score.royalflare.net/th11/replay11/th11_ud0d67.rpy"],
            "MarisaB": [1197670530, "にゃんこ", "http://score.royalflare.net/th11/replay11/th11_ud12f8.rpy"],
            "MarisaC": [951080690, "悠木碧", "http://score.royalflare.net/th11/replay11/th11_ud1113.rpy"]
        },
        "Hard": {
            "ReimuA": [1919799160, "にゃんこ", "http://score.royalflare.net/th11/replay11/th11_ud0d96.rpy"],
            "ReimuB": [1704847550, "にゃんこ", "http://score.royalflare.net/th11/replay11/th11_ud0db3.rpy"],
            "ReimuC": [1591047400, "OYM", "http://score.royalflare.net/th11/replay11/th11_ud101d.rpy"],
            "MarisaA": [1920135380, "夢路寿", "http://score.royalflare.net/th11/replay11/th11_ud119d.rpy"],
            "MarisaB": [2033714330, "えなめる", "http://score.royalflare.net/th11/replay11/th11_ud10b1.rpy"],
            "MarisaC": [1401024060, "K・G", "http://score.royalflare.net/th11/replay11/th11_ud1316.rpy"]
        },
        "Lunatic": {
            "ReimuA": [5036683530, "Gobou", "http://score.royalflare.net/th11/replay11/th11_ud1320.rpy"],
            "ReimuB": [3745660580, "UKT", "http://score.royalflare.net/th11/replay11/th11_ud1217.rpy"],
            "ReimuC": [3642572170, "UKT", "http://score.royalflare.net/th11/replay11/th11_ud11ba.rpy"],
            "MarisaA": [4347625050, "UKT", "http://score.royalflare.net/th11/replay11/th11_ud10d0.rpy"],
            "MarisaB": [4423086650, "UKT", "http://score.royalflare.net/th11/replay11/th11_ud0f6c.rpy"],
            "MarisaC": [3133453200, "UKT", "http://score.royalflare.net/th11/replay11/th11_ud0fc8.rpy"]
        },
        "Extra": {
            "ReimuA": [1122028280, "IBUKI", "http://score.royalflare.net/th11/replay11/th11_ud12ba.rpy"],
            "ReimuB": [1101316000, "ASL", "http://score.royalflare.net/th11/replay11/th11_ud1207.rpy"],
            "ReimuC": [1076628060, "ASL", "http://score.royalflare.net/th11/replay11/th11_ud1237.rpy"],
            "MarisaA": [1113194290, "ASL", "http://score.royalflare.net/th11/replay11/th11_ud1150.rpy"],
            "MarisaB": [1102183510, "ASL", "http://score.royalflare.net/th11/replay11/th11_ud1127.rpy"],
            "MarisaC": [1081890510, "ASL", "http://score.royalflare.net/th11/replay11/th11_ud11f8.rpy"]
        }
    },
    "UFO": {
        "Easy": {
            "ReimuA": [1942160120, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0db5.rpy"],
            "ReimuB": [1988891580, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0fe3.rpy"],
            "MarisaA": [2158767550, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0daa.rpy"],
            "MarisaB": [2167694350, "shin", "http://score.royalflare.net/th12/replay12/th12_ud1056.rpy"],
            "SanaeA": [2108787630, "shin", "http://score.royalflare.net/th12/replay12/th12_ud105b.rpy"],
            "SanaeB": [2152812300, "shin", "http://score.royalflare.net/th12/replay12/th12_ud1051.rpy"]
        },
        "Normal": {
            "ReimuA": [2613435630, "shin", "http://score.royalflare.net/th12/replay12/th12_ud1073.rpy"],
            "ReimuB": [2616846700, "shin", "http://score.royalflare.net/th12/replay12/th12_ud1039.rpy"],
            "MarisaA": [2829615860, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0c63.rpy"],
            "MarisaB": [2900503630, "shin", "http://score.royalflare.net/th12/replay12/th12_ud1038.rpy"],
            "SanaeA": [2792713420, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0da8.rpy"],
            "SanaeB": [2950387290, "shin", "http://score.royalflare.net/th12/replay12/th12_ud104f.rpy"]
        },
        "Hard": {
            "ReimuA": [2892847470, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0e68.rpy"],
            "ReimuB": [3045746740, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0faa.rpy"],
            "MarisaA": [3063788870, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0ccb.rpy"],
            "MarisaB": [3211129200, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0e9a.rpy"],
            "SanaeA": [3029549370, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0d0b.rpy"],
            "SanaeB": [3267272190, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0e5a.rpy"]
        },
        "Lunatic": {
            "ReimuA": [3003541930, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0f6d.rpy"],
            "ReimuB": [2859531860, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0f37.rpy"],
            "MarisaA": [3292353200, "shin", "http://score.royalflare.net/th12/replay12/th12_ud0f01.rpy"],
            "MarisaB": [3062639820, "K・G", "http://score.royalflare.net/th12/replay12/th12_ud115e.rpy"],
            "SanaeA": [3128973420, "E-Splice", "http://score.royalflare.net/th12/replay12/th12_ud1150.rpy"],
            "SanaeB": [3357725380, "K・G", "http://score.royalflare.net/th12/replay12/th12_ud11c9.rpy"]
        },
        "Extra": {
            "ReimuA": [660751150, "ニャムニャム", "http://score.royalflare.net/th12/replay12/th12_ud11a0.rpy"],
            "ReimuB": [630584000, "ニャムニャム", "http://score.royalflare.net/th12/replay12/th12_ud11cd.rpy"],
            "MarisaA": [703054650, "ニャムニャム", "http://score.royalflare.net/th12/replay12/th12_ud11ee.rpy"],
            "MarisaB": [630651970, "omega", "http://score.royalflare.net/th12/replay12/th12_ud1029.rpy"],
            "SanaeA": [639197870, "omega", "http://score.royalflare.net/th12/replay12/th12_ud0ff9.rpy"],
            "SanaeB": [725404370, "SOC", "http://score.royalflare.net/th12/replay12/th12_ud0ff0.rpy"]
        }
    },
    "GFW": {
        "Easy": {
            "A1": [35412820, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0757.rpy"],
            "A2": [43852610, "Dream Dweller", "http://score.royalflare.net/th128/replay128/th128_ud0668.rpy"],
            "B1": [35685310, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0733.rpy"],
            "B2": [39231480, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0705.rpy"],
            "C1": [36504750, "chum", "http://score.royalflare.net/th128/replay128/th128_ud075d.rpy"],
            "C2": [40198900, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0760.rpy"]
        },
        "Normal": {
            "A1": [61392690, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0786.rpy"],
            "A2": [72022590, "chum", "http://score.royalflare.net/th128/replay128/th128_ud072f.rpy"],
            "B1": [56655040, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0736.rpy"],
            "B2": [60305550, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0709.rpy"],
            "C1": [59624220, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0717.rpy"],
            "C2": [58542010, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0729.rpy"]
        },
        "Hard": {
            "A1": [76931620, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0745.rpy"],
            "A2": [87425610, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0747.rpy"],
            "B1": [76667300, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0741.rpy"],
            "B2": [76905060, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0714.rpy"],
            "C1": [75333510, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0716.rpy"],
            "C2": [77488540, "chum", "http://score.royalflare.net/th128/replay128/th128_ud06f3.rpy"]
        },
        "Lunatic": {
            "A1": [110264740, "MegaPulse", "http://replays.gensokyo.org/download.php?id=41953"],
            "A2": [119625730, "chum", "http://score.royalflare.net/th128/replay128/th128_ud077c.rpy"],
            "B1": [107163550, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0768.rpy"],
            "B2": [102935550, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0728.rpy"],
            "C1": [102247660, "chum", "http://score.royalflare.net/th128/replay128/th128_ud0724.rpy"],
            "C2": [105483820, "chum", "http://score.royalflare.net/th128/replay128/th128_ud071d.rpy"]
        },
        "Extra": {
            "-": [100742250, "みぞる", "http://score.royalflare.net/th128/replay128/th128_ud0556.rpy"]
        }
    },
    "TD": {
        "Easy": {
            "Reimu": [952661470, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud09a4.rpy"],
            "Marisa": [973165140, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a34.rpy"],
            "Sanae": [942901130, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a16.rpy"],
            "Youmu": [1032057240, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a09.rpy"]
        },
        "Normal": {
            "Reimu": [1805565010, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud09aa.rpy"],
            "Marisa": [1932903320, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a32.rpy"],
            "Sanae": [1806511210, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a14.rpy"],
            "Youmu": [2005786190, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a03.rpy"]
        },
        "Hard": {
            "Reimu": [3236612450, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud09c5.rpy"],
            "Marisa": [3606074230, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a7f.rpy"],
            "Sanae": [3174586070, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a1c.rpy"],
            "Youmu": [3842591880, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a7b.rpy"]
        },
        "Lunatic": {
            "Reimu": [3259421690, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud09e7.rpy"],
            "Marisa": [3622725980, "Mithril", "http://score.royalflare.net/th13/replay13/th13_ud0a73.rpy"],
            "Sanae": [3099392060, "ns", ""],
            "Youmu": [3905681530, "Mithril", "http://pndsng.wwww.jp/touhou/highscores/replay/th13_ud0277.rpy"]
        },
        "Extra": {
            "Reimu": [559865500, "けいと", "http://score.royalflare.net/th13/replay13/th13_ud09a1.rpy"],
            "Marisa": [591623200, "morth", "http://score.royalflare.net/th13/replay13/th13_ud0a9b.rpy"],
            "Sanae": [532111870, "omega", "http://score.royalflare.net/th13/replay13/th13_ud06db.rpy"],
            "Youmu": [603783460, "omega", "http://score.royalflare.net/th13/replay13/th13_ud0641.rpy"]
        }
    },
    "DDC": {
        "Easy": {
            "ReimuA": [920715460, "NSNSNS556", "http://score.royalflare.net/th14/replay14/th14_ud0724.rpy"],
            "ReimuB": [755021000, "Karisa", "http://score.royalflare.net/th14/replay14/th14_ud073a.rpy"],
            "MarisaA": [803853320, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud05d2.rpy"],
            "MarisaB": [789629180, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud05d4.rpy"],
            "SakuyaA": [872467360, "苏", "http://score.royalflare.net/th14/replay14/th14_ud06cb.rpy"],
            "SakuyaB": [1118074340, "LYX", ""]
        },
        "Normal": {
            "ReimuA": [1039581950, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud05a4.rpy"],
            "ReimuB": [862853770, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud05ad.rpy"],
            "MarisaA": [945713840, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud05a7.rpy"],
            "MarisaB": [965259250, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud05aa.rpy"],
            "SakuyaA": [1066975790, "苏", "http://score.royalflare.net/th14/replay14/th14_ud06cc.rpy"],
            "SakuyaB": [1643366120, "LYX", ""]
        },
        "Hard": {
            "ReimuA": [1232640340, "White Rat", "http://score.royalflare.net/th14/replay14/th14_ud069d.rpy"],
            "ReimuB": [969187110, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud0616.rpy"],
            "MarisaA": [1017599040, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud0578.rpy"],
            "MarisaB": [1241630210, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud066b.rpy"],
            "SakuyaA": [1248118740, "苏", "http://score.royalflare.net/th14/replay14/th14_ud06d3.rpy"],
            "SakuyaB": [1929988730, "苏", "http://score.royalflare.net/th14/replay14/th14_ud06c2.rpy"]
        },
        "Lunatic": {
            "ReimuA": [1565969810, "White Rat", "http://score.royalflare.net/th14/replay14/th14_ud0652.rpy"],
            "ReimuB": [1140297420, "White Rat", "http://score.royalflare.net/th14/replay14/th14_ud0695.rpy"],
            "MarisaA": [1230732810, "White Rat", "http://score.royalflare.net/th14/replay14/th14_ud0699.rpy"],
            "MarisaB": [1759036540, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud06c0.rpy"],
            "SakuyaA": [1511462090, "苏", "http://score.royalflare.net/th14/replay14/th14_ud06d8.rpy"],
            "SakuyaB": [2204848600, "SenCy", "http://score.royalflare.net/th14/replay14/th14_ud0726.rpy"]
        },
        "Extra": {
            "ReimuA": [780112600, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud073b.rpy"],
            "ReimuB": [715926700, "KMK", "http://score.royalflare.net/th14/replay14/th14_ud059c.rpy"],
            "MarisaA": [732504040, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud072b.rpy"],
            "MarisaB": [1191151260, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud0744.rpy"],
            "SakuyaA": [759067670, "K・G", "http://score.royalflare.net/th14/replay14/th14_ud0733.rpy"],
            "SakuyaB": [842596500, "LYX", ""]
        }
    },
    "LoLK": {
        "Easy": {
            "Reimu": [1229423590, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud028d.rpy"],
            "Marisa": [1323232690, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud02a3.rpy"],
            "Sanae": [1583467770, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud02a0.rpy"],
            "Reisen": [1649644690, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud029f.rpy"]
        },
        "Normal": {
            "Reimu": [1624716830, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud0287.rpy"],
            "Marisa": [1809184820, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud026f.rpy"],
            "Sanae": [2517604770, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud026e.rpy"],
            "Reisen": [2454170970, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud0259.rpy"]
        },
        "Hard": {
            "Reimu": [1820860890, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud0250.rpy"],
            "Marisa": [1919488870, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud0235.rpy"],
            "Sanae": [2513954510, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud026a.rpy"],
            "Reisen": [2540876730, "K・G", "http://score.royalflare.net/th15/replay15/th15_ud0278.rpy"]
        },
        "Lunatic": {
            "Reimu": [2024337900, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud0268.rpy"],
            "Marisa": [2101532750, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud0267.rpy"],
            "Sanae": [3077565890, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud029d.rpy"],
            "Reisen": [2616458440, "HUF", "http://score.royalflare.net/th15/replay15/th15_ud0277.rpy"]
        },
        "Extra": {
            "Reimu": [819575170, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud0264.rpy"],
            "Marisa": [923555520, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud0263.rpy"],
            "Sanae": [1008302770, "AM", "http://score.royalflare.net/th15/replay15/th15_ud00c5.rpy"],
            "Reisen": [1016971530, "kisara", "http://score.royalflare.net/th15/replay15/th15_ud0261.rpy"]
        }
    }
};

var numericSort = function (a, b) {
    return b - a;
};

var sep = function (number) {
    if (isNaN(number)) {
        return '-';
    }
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
};

var calc = function () {
    var top = {}, averages = [], keys = [], total = 0, categories = 0, highest = 0, topList = "", hack = false,
        game, difficulty, id, span, score, shottype, wr, percentage, average, key, i, table, gameTable, temp,
        precision = parseInt(document.getElementById("precision").value);
        
    if (precision < 0 || precision > 5) {
        document.getElementById("invalidPrecision").innerHTML = "<b style='color:red'>Invalid precision; minimum is 0, maximum is 5.</b>";
        return;
    } else {
        document.getElementById("invalidPrecision").innerHTML = "";
    }
    
    for (game in WRs) {
        total = 0;
        categories = 0;
        
        for (difficulty in WRs[game]) {
            for (shottype in WRs[game][difficulty]) {
                id = game + difficulty + shottype;
                span = document.getElementById(id);
                score = document.getElementById(id + "Score").value.replace(/,/g, "").replace(/\./g, "").replace(/ /g, "");
                
                if (score === "") {
                    span.innerHTML = "";
                    continue;
                }
                
                if (isNaN(score)) {
                    span.innerHTML = "<b style='color:red'>Invalid score.</b>";
                    return;
                }
                
                score = parseInt(score);
                
                wr = WRs[game][difficulty][shottype][0];
                
                if (score == wr) {
                    hack = true;
                    score -= 1;
                }
                
                percentage = score / wr * 100;
                
                if (hack) {
                    score++;
                    hack = false;
                }
                
                span.innerHTML = "Percentage of WR: <b>" + (precision === 0 ? Math.round(percentage) : percentage.toFixed(precision)) + "%</b>";
                
                while (top[percentage]) {
                    percentage += 0.000000000000001;
                }
                
                top[percentage] = [game + " " + difficulty, shottype, score];
                
                if (percentage > highest) {
                    highest = percentage;
                }
                
                total += percentage;
                
                categories++;
            }
        }
        
        if (categories > 0) {
            average = total / categories;
            
            while (averages[average]) {
                average += 0.000000000000001;
            }
            
            averages[average] = game;
        }
    }
    
    if (highest === 0) {
        topList = "You have no significant scores! Try to score some more!";
    } else {
        for (key in top) {
            keys.push(key);
        }
        
        keys.sort(numericSort);
        topList = "<table id='table' class='sortable'><thead><tr><th>Rank</th><th>Game + Difficulty</th><th>Shottype / Route</th><th>Score</th><th>WR Percentage</th><th>Progress Bar</th><th>WR</th></tr></thead><tbody>";
        
        for (i = 0; i < keys.length; i++) {
            key = top[keys[i]];
            percentage = (precision === 0 ? Math.round(keys[i]) : Number(keys[i]).toFixed(precision));
            temp = key[0].split(' ');
            wrArray = (WRs[temp[0]][temp[1]][key[1]] ? WRs[temp[0]][temp[1]][key[1]] : WRs[temp[0]][temp[1]]);
            topList += "<tr><td>" + (i + 1) + "</td><td>" + key[0] + "</td><td>" + key[1].replace("Team", " Team") + "</td><td>" + sep(key[2]) +
            "</td><td>" + percentage + "%</td><td><progress value='" + percentage +
            "' max='100'></progress></td><td>" + sep(wrArray[0]) + " by <i>" + wrArray[1];
            
            if (wrArray[2] !== "") {
                topList += " [<a href='" + wrArray[2] + "'>Replay</a>]</td></tr>";
            }
        }
        
        topList += "</tbody></table><br><table id='gameTable' class='sortable'><thead><tr><th>Rank</th><th>Game</th><th>Average Percentage</th></tr></thead><tbody>";
        
        keys = [];
        
        for (key in averages) {
            keys.push(key);
        }
        
        keys.sort(numericSort);
        
        for (i = 0; i < keys.length; i++) {
            key = averages[keys[i]];
            percentage = (precision === 0 ? Math.round(keys[i]) : Number(keys[i]).toFixed(precision));
            topList += "<tr><td>" + (i + 1) + "</td><td>" + key + "</td><td>" + percentage + "%</td></tr>";
        }
        
        topList += "</tbody></table>";
    }
    
    document.getElementById("topList").innerHTML = topList;
    table = document.getElementById("table");
    gameTable = document.getElementById("gameTable");
    table.setAttribute("align", "center");
    gameTable.setAttribute("align", "center");
    sorttable.makeSortable(table);
    sorttable.makeSortable(gameTable);
};

var check = function (player) {
    var totalWRs = 0;
    
    for (var game in WRs) {
        for (var difficulty in WRs[game]) {
            for (var shottype in WRs[game][difficulty]) {
                if (WRs[game][difficulty][shottype][1].toLowerCase() == player.toLowerCase()) {
                    totalWRs += 1;
                }
            }
        }
    }
    
    return totalWRs;
};