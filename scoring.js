﻿var NUMBER_OF_GAMES = 16;

var WRs = {
  "HRtP": {
    "Easy": {
      "Makai": [
        11478940,
        "Zil",
        ""
      ],
      "Jigoku": [
        11605330,
        "SEO",
        ""
      ]
    },
    "Normal": {
      "Makai": [
        11412100,
        "Zil",
        ""
      ],
      "Jigoku": [
        11213090,
        "SEO",
        ""
      ]
    },
    "Hard": {
      "Makai": [
        11331720,
        "Zil",
        ""
      ],
      "Jigoku": [
        11365460,
        "Karisa",
        ""
      ]
    },
    "Lunatic": {
      "Makai": [
        14083170,
        "Vex",
        ""
      ],
      "Jigoku": [
        14292970,
        "Zil",
        ""
      ]
    }
  },
  "SoEW": {
    "Easy": {
      "ReimuA": [
        21049470,
        "KirbyComment",
        ""
      ],
      "ReimuB": [
        20713130,
        "KirbyComment",
        ""
      ],
      "ReimuC": [
        18783800,
        "KirbyComment",
        ""
      ]
    },
    "Normal": {
      "ReimuA": [
        21477840,
        "KirbyComment",
        ""
      ],
      "ReimuB": [
        22068970,
        "KirbyComment",
        ""
      ],
      "ReimuC": [
        19042440,
        "KirbyComment",
        ""
      ]
    },
    "Hard": {
      "ReimuA": [
        18772850,
        "Pearl",
        ""
      ],
      "ReimuB": [
        30858690,
        "KirbyComment",
        ""
      ],
      "ReimuC": [
        0,
        "",
        ""
      ]
    },
    "Lunatic": {
      "ReimuA": [
        30684360,
        "Pearl",
        ""
      ],
      "ReimuB": [
        21620680,
        "Cream",
        ""
      ],
      "ReimuC": [
        13666670,
        "theshim",
        ""
      ]
    },
    "Extra": {
      "ReimuA": [
        38386620,
        "KirbyComment",
        ""
      ],
      "ReimuB": [
        38105400,
        "KirbyComment",
        ""
      ],
      "ReimuC": [
        33862900,
        "KirbyComment",
        ""
      ]
    }
  },
  "PoDD": {
    "Easy": {
      "Reimu": [
        40240610,
        "KirbyComment",
        ""
      ],
      "Mima": [
        54217980,
        "Zil",
        ""
      ],
      "Marisa": [
        33508440,
        "Zil",
        ""
      ],
      "Ellen": [
        34445250,
        "KirbyComment",
        ""
      ],
      "Kotohime": [
        40921540,
        "KirbyComment",
        ""
      ],
      "Kana": [
        33508440,
        "Zil",
        ""
      ],
      "Rikako": [
        41872510,
        "Zil",
        ""
      ],
      "Chiyuri": [
        39007340,
        "Zil",
        ""
      ],
      "Yumemi": [
        32230170,
        "KirbyComment",
        ""
      ]
    },
    "Normal": {
      "Reimu": [
        46994700,
        "KirbyComment",
        ""
      ],
      "Mima": [
        69452980,
        "Zil",
        ""
      ],
      "Marisa": [
        53852230,
        "Zil",
        ""
      ],
      "Ellen": [
        51429240,
        "KirbyComment",
        ""
      ],
      "Kotohime": [
        54472060,
        "Zil",
        ""
      ],
      "Kana": [
        50178940,
        "Zil",
        ""
      ],
      "Rikako": [
        42041710,
        "KirbyComment",
        ""
      ],
      "Chiyuri": [
        54565290,
        "Zil",
        ""
      ],
      "Yumemi": [
        48953180,
        "Zil",
        ""
      ]
    },
    "Hard": {
      "Reimu": [
        72034400,
        "Zil",
        ""
      ],
      "Mima": [
        87838350,
        "Zil",
        ""
      ],
      "Marisa": [
        75329060,
        "Zil",
        ""
      ],
      "Ellen": [
        89790060,
        "KirbyComment",
        ""
      ],
      "Kotohime": [
        87731690,
        "Zil",
        ""
      ],
      "Kana": [
        71107660,
        "Zil",
        ""
      ],
      "Rikako": [
        62076530,
        "Zil",
        ""
      ],
      "Chiyuri": [
        82125270,
        "Zil",
        ""
      ],
      "Yumemi": [
        70987490,
        "Zil",
        ""
      ]
    },
    "Lunatic": {
      "Reimu": [
        103244120,
        "KirbyComment",
        ""
      ],
      "Mima": [
        127826260,
        "Zil",
        ""
      ],
      "Marisa": [
        109691220,
        "Zil",
        ""
      ],
      "Ellen": [
        122656180,
        "KirbyComment",
        ""
      ],
      "Kotohime": [
        123393850,
        "KirbyComment",
        ""
      ],
      "Kana": [
        109828660,
        "Zil",
        ""
      ],
      "Rikako": [
        95298150,
        "Zil",
        ""
      ],
      "Chiyuri": [
        132887750,
        "Zil",
        ""
      ],
      "Yumemi": [
        107138760,
        "Zil",
        ""
      ]
    }
  },
  "LLS": {
    "Easy": {
      "ReimuA": [
        56074820,
        "Karisa",
        ""
      ],
      "ReimuB": [
        68786970,
        "KirbyComment",
        ""
      ],
      "MarisaA": [
        0,
        "",
        ""
      ],
      "MarisaB": [
        60481450,
        "KirbyComment",
        ""
      ]
    },
    "Normal": {
      "ReimuA": [
        91536580,
        "Karisa",
        ""
      ],
      "ReimuB": [
        128477620,
        "KirbyComment",
        ""
      ],
      "MarisaA": [
        54023720,
        "S-TORA",
        ""
      ],
      "MarisaB": [
        108524270,
        "Chirpy",
        ""
      ]
    },
    "Hard": {
      "ReimuA": [
        100687310,
        "Karisa",
        ""
      ],
      "ReimuB": [
        0,
        "",
        ""
      ],
      "MarisaA": [
        99991110,
        "Pearl",
        ""
      ],
      "MarisaB": [
        0,
        "",
        ""
      ]
    },
    "Lunatic": {
      "ReimuA": [
        71755090,
        "BaitySM",
        ""
      ],
      "ReimuB": [
        107064900,
        "Chirpy",
        ""
      ],
      "MarisaA": [
        110559130,
        "Pearl",
        ""
      ],
      "MarisaB": [
        81845390,
        "Zodiac",
        ""
      ]
    },
    "Extra": {
      "ReimuA": [
        78308100,
        "Karisa",
        ""
      ],
      "ReimuB": [
        78625740,
        "Zil",
        ""
      ],
      "MarisaA": [
        80289020,
        "ぴえとろ",
        ""
      ],
      "MarisaB": [
        79182030,
        "Chirpy",
        ""
      ]
    }
  },
  "MS": {
    "Easy": {
      "Reimu": [
        73893590,
        "Zil",
        ""
      ],
      "Marisa": [
        72999090,
        "Zil",
        ""
      ],
      "Mima": [
        79992120,
        "Zil",
        ""
      ],
      "Yuuka": [
        70576320,
        "Zil",
        ""
      ]
    },
    "Normal": {
      "Reimu": [
        107903760,
        "Karisa",
        ""
      ],
      "Marisa": [
        105722950,
        "Karisa",
        ""
      ],
      "Mima": [
        125172350,
        "Zigzagwolf",
        ""
      ],
      "Yuuka": [
        97709710,
        "Karisa",
        ""
      ]
    },
    "Hard": {
      "Reimu": [
        129269130,
        "Karisa",
        ""
      ],
      "Marisa": [
        145311910,
        "Zigzagwolf",
        ""
      ],
      "Mima": [
        163109770,
        "Zil",
        ""
      ],
      "Yuuka": [
        113038430,
        "Karisa",
        ""
      ]
    },
    "Lunatic": {
      "Reimu": [
        153914430,
        "Zil",
        ""
      ],
      "Marisa": [
        145110450,
        "Zil",
        ""
      ],
      "Mima": [
        167946790,
        "Zigzagwolf",
        ""
      ],
      "Yuuka": [
        123103180,
        "Zil",
        ""
      ]
    },
    "Extra": {
      "Reimu": [
        202105820,
        "Zigzagwolf",
        ""
      ],
      "Marisa": [
        189402740,
        "Zigzagwolf",
        ""
      ],
      "Mima": [
        204022370,
        "部屋干し",
        ""
      ],
      "Yuuka": [
        186900220,
        "Zigzagwolf",
        ""
      ]
    }
  },
  "EoSD": {
    "Easy": {
      "ReimuA": [
        147501700,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud1203.rpy"
      ],
      "ReimuB": [
        172044560,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud13d0.rpy"
      ],
      "MarisaA": [
        152283550,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud10a2.rpy"
      ],
      "MarisaB": [
        156937990,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud1043.rpy"
      ]
    },
    "Normal": {
      "ReimuA": [
        303504070,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud135e.rpy"
      ],
      "ReimuB": [
        347208050,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud1130.rpy"
      ],
      "MarisaA": [
        308626960,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud1403.rpy"
      ],
      "MarisaB": [
        303379260,
        "MATSU",
        "http://score.royalflare.net/th06/replay6/th6_ud0f71.rpy"
      ]
    },
    "Hard": {
      "ReimuA": [
        403623070,
        "st",
        "http://score.royalflare.net/th06/replay6/th6_ud1040.rpy"
      ],
      "ReimuB": [
        551876370,
        "izumico",
        ""
      ],
      "MarisaA": [
        404007980,
        "TA",
        "http://score.royalflare.net/th06/replay6/th6_ud127d.rpy"
      ],
      "MarisaB": [
        438052810,
        "st",
        "http://score.royalflare.net/th06/replay6/th6_ud1026.rpy"
      ]
    },
    "Lunatic": {
      "ReimuA": [
        558947670,
        "OOSAKA",
        ""
      ],
      "ReimuB": [
        709947060,
        "SOC",
        ""
      ],
      "MarisaA": [
        581241260,
        "OOSAKA",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th6_ud0016.rpy"
      ],
      "MarisaB": [
        645324510,
        "OOSAKA",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th6_ud0003.rpy"
      ]
    },
    "Extra": {
      "ReimuA": [
        629609710,
        "OOSAKA",
        "https://zh.touhouwiki.net/images/0/08/Th6_ud0501.rpy"
      ],
      "ReimuB": [
        642579790,
        "OOSAKA",
        "https://zh.touhouwiki.net/images/e/e9/Th6_ud0502.rpy"
      ],
      "MarisaA": [
        631488580,
        "OOSAKA",
        "https://zh.touhouwiki.net/images/7/76/Th6_udz973.rpy"
      ],
      "MarisaB": [
        663244220,
        "OOSAKA",
        "https://zh.touhouwiki.net/images/5/53/Th6_udx716.jpg"
      ]
    }
  },
  "PCB": {
    "Easy": {
      "ReimuA": [
        1799871950,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d79.rpy"
      ],
      "ReimuB": [
        2042271460,
        "Yu-suke",
        ""
      ],
      "MarisaA": [
        1950541980,
        "Lcy",
        "http://score.royalflare.net/th07/replay7/th7_ud21ab.rpy"
      ],
      "MarisaB": [
        1768291980,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d45.rpy"
      ],
      "SakuyaA": [
        1777849120,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d7a.rpy"
      ],
      "SakuyaB": [
        1929606150,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d7b.rpy"
      ]
    },
    "Normal": {
      "ReimuA": [
        2001369010,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1b7a.rpy"
      ],
      "ReimuB": [
        2167768950,
        "clo-naga",
        "http://score.royalflare.net/th07/replay7/th7_ud212a.rpy"
      ],
      "MarisaA": [
        2132017710,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d94.rpy"
      ],
      "MarisaB": [
        2011470500,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1b88.rpy"
      ],
      "SakuyaA": [
        2014928480,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1b85.rpy"
      ],
      "SakuyaB": [
        2104019460,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d92.rpy"
      ]
    },
    "Hard": {
      "ReimuA": [
        2548721870,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1db4.rpy"
      ],
      "ReimuB": [
        2820415430,
        "st",
        "http://score.royalflare.net/th07/replay7/th7_ud1ef1.rpy"
      ],
      "MarisaA": [
        2576184230,
        "st",
        "http://score.royalflare.net/th07/replay7/th7_ud1ec6.rpy"
      ],
      "MarisaB": [
        2387521220,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d95.rpy"
      ],
      "SakuyaA": [
        2379101080,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d96.rpy"
      ],
      "SakuyaB": [
        2778765040,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1d97.rpy"
      ]
    },
    "Lunatic": {
      "ReimuA": [
        3001249690,
        "Yu-suke",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0251.rpy"
      ],
      "ReimuB": [
        3643993290,
        "Yu-suke",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0047.rpy"
      ],
      "MarisaA": [
        2899605950,
        "PTS",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0052.rpy"
      ],
      "MarisaB": [
        2703783480,
        "rori-",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0315.rpy"
      ],
      "SakuyaA": [
        2703191180,
        "pndsng",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0223.rpy"
      ],
      "SakuyaB": [
        3859588140,
        "Yu-suke",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th7_ud0283.rpy"
      ]
    },
    "Extra": {
      "ReimuA": [
        1369627450,
        "いな",
        ""
      ],
      "ReimuB": [
        1509003300,
        "Yu-suke",
        ""
      ],
      "MarisaA": [
        1257244350,
        "HS参謀",
        "http://score.royalflare.net/th07/replay7/th7_ud1f23.rpy"
      ],
      "MarisaB": [
        1244834970,
        "いな",
        ""
      ],
      "SakuyaA": [
        1277681830,
        "いな",
        "http://score.royalflare.net/th07/replay7/th7_ud2267.rpy"
      ],
      "SakuyaB": [
        1412782710,
        "いな",
        "http://score.royalflare.net/th07/replay7/th7_ud2233.rpy"
      ]
    },
    "Phantasm": {
      "ReimuA": [
        1580640510,
        "Yu-suke",
        "https://zh.touhouwiki.net/images/1/14/Th7_ud1f4a.rpy"
      ],
      "ReimuB": [
        1710441020,
        "Yu-suke",
        "http://score.royalflare.net/th07/replay7/th7_ud21a2.rpy"
      ],
      "MarisaA": [
        1515839630,
        "Yu-suke",
        "http://score.royalflare.net/th07/replay7/th7_ud21a1.rpy"
      ],
      "MarisaB": [
        1507090340,
        "Yu-suke",
        "http://score.royalflare.net/th07/replay7/th7_ud219b.rpy"
      ],
      "SakuyaA": [
        1524310930,
        "Yu-suke",
        "http://score.royalflare.net/th07/replay7/th7_ud218a.rpy"
      ],
      "SakuyaB": [
        1671913330,
        "Yu-suke",
        "http://score.royalflare.net/th07/replay7/th7_ud217c.rpy"
      ]
    }
  },
  "IN": {
    "Easy": {
      "BorderTeam": [
        2637629490,
        "st",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2361"
      ],
      "MagicTeam": [
        3084533670,
        "coco",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2839"
      ],
      "ScarletTeam": [
        3012091640,
        "coco",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=27da"
      ],
      "GhostTeam": [
        2764571140,
        "coco",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=28b1"
      ],
      "Reimu": [
        2777470790,
        "NALIS",
        ""
      ],
      "Yukari": [
        1812041920,
        "NALIS",
        ""
      ],
      "Marisa": [
        3127823070,
        "coco",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2845"
      ],
      "Alice": [
        1979902210,
        "NALIS",
        ""
      ],
      "Sakuya": [
        2748974260,
        "NALIS",
        ""
      ],
      "Remilia": [
        2066097660,
        "NALIS",
        ""
      ],
      "Youmu": [
        3379425090,
        "coco",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2873"
      ],
      "Yuyuko": [
        1804692830,
        "NALIS",
        ""
      ]
    },
    "Normal": {
      "BorderTeam": [
        3893073500,
        "st",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=23f8"
      ],
      "MagicTeam": [
        4040949070,
        "NALIS",
        ""
      ],
      "ScarletTeam": [
        4076786440,
        "NALIS",
        ""
      ],
      "GhostTeam": [
        3914237750,
        "NALIS",
        ""
      ],
      "Reimu": [
        3696303320,
        "NALIS",
        ""
      ],
      "Yukari": [
        2698842890,
        "NALIS",
        ""
      ],
      "Marisa": [
        4013581690,
        "NALIS",
        ""
      ],
      "Alice": [
        2712863460,
        "NALIS",
        ""
      ],
      "Sakuya": [
        3575396270,
        "NALIS",
        ""
      ],
      "Remilia": [
        2897204740,
        "NALIS",
        ""
      ],
      "Youmu": [
        4496668100,
        "coco",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2946"
      ],
      "Yuyuko": [
        2670363590,
        "NALIS",
        ""
      ]
    },
    "Hard": {
      "BorderTeam": [
        4611654980,
        "NALIS",
        ""
      ],
      "MagicTeam": [
        4761104730,
        "NALIS",
        ""
      ],
      "ScarletTeam": [
        4822813140,
        "NALIS",
        ""
      ],
      "GhostTeam": [
        4800527370,
        "NALIS",
        ""
      ],
      "Reimu": [
        4337288270,
        "NALIS",
        ""
      ],
      "Yukari": [
        3335090210,
        "NALIS",
        ""
      ],
      "Marisa": [
        4699343520,
        "NALIS",
        ""
      ],
      "Alice": [
        3312959350,
        "NALIS",
        ""
      ],
      "Sakuya": [
        4176608820,
        "NALIS",
        ""
      ],
      "Remilia": [
        3363249180,
        "NALIS",
        ""
      ],
      "Youmu": [
        5306388370,
        "NALIS",
        ""
      ],
      "Yuyuko": [
        3302388350,
        "NALIS",
        ""
      ]
    },
    "Lunatic": {
      "BorderTeam": [
        6121136060,
        "Inefushi",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th8_ud0088.rpy"
      ],
      "MagicTeam": [
        6168365790,
        "Inefushi",
        "http://pndsng.wwww.jp/touhou/highscores/replay/th8_ud0090.rpy"
      ],
      "ScarletTeam": [
        6609355970,
        "Yu-suke",
        "https://en.touhouwiki.net/images/9/94/Th8_ud2529.rpy"
      ],
      "GhostTeam": [
        6477682800,
        "IwanaM",
        ""
      ],
      "Reimu": [
        5044782510,
        "YASU",
        ""
      ],
      "Yukari": [
        3973007340,
        "Eon",
        "https://en.touhouwiki.net/images/0/09/Th8_ud0011.rpy"
      ],
      "Marisa": [
        5409275820,
        "YASU",
        "https://en.touhouwiki.net/images/d/d1/Th8_ud0000.rpy"
      ],
      "Alice": [
        3793096300,
        "Eon",
        "https://en.touhouwiki.net/images/9/96/Th8_ud0016.rpy"
      ],
      "Sakuya": [
        4780013310,
        "sogebu",
        "https://en.touhouwiki.net/images/7/75/Th8_udu397.rpy"
      ],
      "Remilia": [
        4209142350,
        "Eon",
        "https://en.touhouwiki.net/images/4/42/Th8_ud0010.rpy"
      ],
      "Youmu": [
        6802039750,
        "Inefushi",
        ""
      ],
      "Yuyuko": [
        3940090660,
        "Eon",
        "https://en.touhouwiki.net/images/b/b2/Th8_ud0012.rpy"
      ]
    },
    "Extra": {
      "BorderTeam": [
        2957550150,
        "ASL",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=274c"
      ],
      "MagicTeam": [
        3021639920,
        "ASL",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2936"
      ],
      "ScarletTeam": [
        3000284220,
        "ASL",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2937"
      ],
      "GhostTeam": [
        3001994340,
        "ASL",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=2938"
      ],
      "Reimu": [
        2435204430,
        "ASL",
        "https://en.touhouwiki.net/images/5/5b/Th8_ud1978.rpy"
      ],
      "Yukari": [
        2112244750,
        "ASL",
        "https://en.touhouwiki.net/images/8/8c/Th8_ud1ab1.rpy"
      ],
      "Marisa": [
        2600855470,
        "ASL",
        "https://en.touhouwiki.net/images/e/e1/Th8_ud1ffb.rpy"
      ],
      "Alice": [
        2092010760,
        "ASL",
        "https://en.touhouwiki.net/images/6/67/Th8_ud1936.rpy"
      ],
      "Sakuya": [
        2525295090,
        "ASL",
        "https://en.touhouwiki.net/images/3/39/Th8_ud252a.rpy"
      ],
      "Remilia": [
        2221694800,
        "ASL",
        "https://en.touhouwiki.net/images/4/4f/Th8_ud21cb.rpy"
      ],
      "Youmu": [
        3159508570,
        "Sakurei",
        "http://score.royalflare.net/th08/dlreplay.cgi?id=28be"
      ],
      "Yuyuko": [
        2179007270,
        "ASL",
        ""
      ]
    }
  },
  "PoFV": {
    "Easy": {
      "Reimu": [
        120818210,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36469"
      ],
      "Marisa": [
        154331830,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36470"
      ],
      "Sakuya": [
        116366730,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36471"
      ],
      "Youmu": [
        151506930,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40554"
      ],
      "Reisen": [
        230409230,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38663"
      ],
      "Cirno": [
        174712460,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=31997"
      ],
      "Lyrica": [
        119701340,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38651"
      ],
      "Mystia": [
        155081080,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40478"
      ],
      "Tewi": [
        118207340,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38652"
      ],
      "Aya": [
        100363590,
        "yet",
        "http://replays.gensokyo.org/download.php?id=41059"
      ],
      "Medicine": [
        110751140,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38654"
      ],
      "Yuuka": [
        116698540,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38648"
      ],
      "Komachi": [
        118727850,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36474"
      ],
      "Eiki": [
        213036900,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40315"
      ]
    },
    "Normal": {
      "Reimu": [
        213107450,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40778"
      ],
      "Marisa": [
        304726740,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38649"
      ],
      "Sakuya": [
        176406360,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36510"
      ],
      "Youmu": [
        236694220,
        "sonitsuku",
        "http://replays.gensokyo.org/download.php?id=40382"
      ],
      "Reisen": [
        332105510,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36511"
      ],
      "Cirno": [
        246385060,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=30102"
      ],
      "Lyrica": [
        181132720,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40776"
      ],
      "Mystia": [
        203944960,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38640"
      ],
      "Tewi": [
        179715380,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40775"
      ],
      "Aya": [
        112894390,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=33115"
      ],
      "Medicine": [
        126072650,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38656"
      ],
      "Yuuka": [
        201162000,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40774"
      ],
      "Komachi": [
        213809060,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=32685"
      ],
      "Eiki": [
        468800480,
        "FSX",
        ""
      ]
    },
    "Hard": {
      "Reimu": [
        200759220,
        "yet",
        "http://replays.gensokyo.org/download.php?id=37653"
      ],
      "Marisa": [
        304046510,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38650"
      ],
      "Sakuya": [
        179783750,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36515"
      ],
      "Youmu": [
        277507110,
        "sonitsuku",
        "http://replays.gensokyo.org/download.php?id=38867"
      ],
      "Reisen": [
        326521960,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36517"
      ],
      "Cirno": [
        250035470,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=29810"
      ],
      "Lyrica": [
        187700010,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36518"
      ],
      "Mystia": [
        202079560,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36519"
      ],
      "Tewi": [
        189226430,
        "yet",
        "http://replays.gensokyo.org/download.php?id=37652"
      ],
      "Aya": [
        128031230,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36521"
      ],
      "Medicine": [
        120397580,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38624"
      ],
      "Yuuka": [
        203621500,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=32452"
      ],
      "Komachi": [
        203882270,
        "yet",
        "http://replays.gensokyo.org/download.php?id=36522"
      ],
      "Eiki": [
        618812340,
        "FSX",
        ""
      ]
    },
    "Lunatic": {
      "Reimu": [
        270136420,
        "yet",
        "http://replays.gensokyo.org/download.php?id=37657"
      ],
      "Marisa": [
        562496870,
        "FSX",
        ""
      ],
      "Sakuya": [
        200448720,
        "yet",
        "http://replays.gensokyo.org/download.php?id=39778"
      ],
      "Youmu": [
        325671350,
        "yet",
        "http://replays.gensokyo.org/download.php?id=41812"
      ],
      "Reisen": [
        529084000,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38722"
      ],
      "Cirno": [
        415482300,
        "yet",
        "http://replays.gensokyo.org/download.php?id=41474"
      ],
      "Lyrica": [
        200312180,
        "yet",
        "http://replays.gensokyo.org/download.php?id=37655"
      ],
      "Mystia": [
        236264530,
        "yet",
        "http://replays.gensokyo.org/download.php?id=40584"
      ],
      "Tewi": [
        205777860,
        "yet",
        "http://replays.gensokyo.org/download.php?id=38510"
      ],
      "Aya": [
        145093750,
        "yet",
        "http://replays.gensokyo.org/download.php?id=41490"
      ],
      "Medicine": [
        148161920,
        "yet",
        "http://replays.gensokyo.org/download.php?id=41491"
      ],
      "Yuuka": [
        242127330,
        "yet",
        "http://replays.gensokyo.org/download.php?id=39976"
      ],
      "Komachi": [
        250366610,
        "yet",
        "http://replays.gensokyo.org/download.php?id=41840"
      ],
      "Eiki": [
        749744450,
        "FSX",
        ""
      ]
    },
    "Extra": {
      "Reimu": [
        124852720,
        "yet",
        "http://ux.getuploader.com/story_extra/download/14/th9_01.rpy"
      ],
      "Marisa": [
        140015550,
        "yet",
        "http://ux.getuploader.com/story_extra/download/13/th9_02.rpy"
      ],
      "Sakuya": [
        113998290,
        "yet",
        "http://ux.getuploader.com/story_extra/download/12/th9_03.rpy"
      ],
      "Youmu": [
        130081930,
        "yet",
        "http://ux.getuploader.com/story_extra/download/11/th9_04.rpy"
      ],
      "Reisen": [
        316861110,
        "LET",
        ""
      ],
      "Cirno": [
        132531100,
        "yet",
        "http://ux.getuploader.com/story_extra/download/9/th9_06.rpy"
      ],
      "Lyrica": [
        114566410,
        "yet",
        "http://ux.getuploader.com/story_extra/download/8/th9_07.rpy"
      ],
      "Mystia": [
        124277920,
        "yet",
        "http://ux.getuploader.com/story_extra/download/7/th9_08.rpy"
      ],
      "Tewi": [
        111379490,
        "yet",
        "http://ux.getuploader.com/story_extra/download/6/th9_09.rpy"
      ],
      "Aya": [
        110601940,
        "yet",
        "http://ux.getuploader.com/story_extra/download/5/th9_10.rpy"
      ],
      "Medicine": [
        174308280,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=32087"
      ],
      "Yuuka": [
        129349360,
        "yet",
        "http://ux.getuploader.com/story_extra/download/3/th9_12.rpy"
      ],
      "Komachi": [
        148733520,
        "rori-",
        "http://replays.gensokyo.org/download.php?id=38956"
      ],
      "Eiki": [
        235114260,
        "Zil",
        "http://replays.gensokyo.org/download.php?id=32093"
      ]
    }
  },
  "MoF": {
    "Easy": {
      "ReimuA": [
        1558354580,
        "LYX",
        ""
      ],
      "ReimuB": [
        1579887590,
        "LYX",
        ""
      ],
      "ReimuC": [
        1577688580,
        "LYX",
        ""
      ],
      "MarisaA": [
        1571928850,
        "LYX",
        ""
      ],
      "MarisaB": [
        1590048550,
        "LYX",
        ""
      ],
      "MarisaC": [
        1589804820,
        "LYX",
        ""
      ]
    },
    "Normal": {
      "ReimuA": [
        1698758210,
        "Keroko",
        "http://score.royalflare.net/th10/replay10/th10_ud1659.rpy"
      ],
      "ReimuB": [
        1707156960,
        "LYX",
        ""
      ],
      "ReimuC": [
        1693029340,
        "LYX",
        ""
      ],
      "MarisaA": [
        1682878740,
        "ZWB",
        "http://score.royalflare.net/th10/replay10/th10_ud1847.rpy"
      ],
      "MarisaB": [
        1718140240,
        "nanamaru",
        "http://score.royalflare.net/th10/replay10/th10_ud1667.rpy"
      ],
      "MarisaC": [
        1711257030,
        "LYX",
        ""
      ]
    },
    "Hard": {
      "ReimuA": [
        2017426220,
        "LYX",
        ""
      ],
      "ReimuB": [
        2039081470,
        "LYX",
        ""
      ],
      "ReimuC": [
        2027118720,
        "LYX",
        ""
      ],
      "MarisaA": [
        2027974800,
        "LYX",
        ""
      ],
      "MarisaB": [
        2061162630,
        "LYX",
        ""
      ],
      "MarisaC": [
        2063792040,
        "LYX",
        ""
      ]
    },
    "Lunatic": {
      "ReimuA": [
        2163513330,
        "dxk",
        ""
      ],
      "ReimuB": [
        2192469040,
        "dxk",
        ""
      ],
      "ReimuC": [
        2175863360,
        "Spira",
        "http://score.royalflare.net/th10/replay10/th10_ud189a.rpy"
      ],
      "MarisaA": [
        2134927060,
        "nanamaru",
        "http://score.royalflare.net/th10/replay10/th10_ud1732.rpy"
      ],
      "MarisaB": [
        2196175410,
        "LYX",
        ""
      ],
      "MarisaC": [
        2214529240,
        "Nanashi",
        "http://score.royalflare.net/th10/replay10/th10_ud17ad.rpy"
      ]
    },
    "Extra": {
      "ReimuA": [
        987343680,
        "nanamaru",
        "http://score.royalflare.net/th10/replay10/th10_ud1684.rpy"
      ],
      "ReimuB": [
        995609930,
        "seventh",
        ""
      ],
      "ReimuC": [
        992275980,
        "Jack",
        "http://score.royalflare.net/th10/replay10/th10_ud1652.rpy"
      ],
      "MarisaA": [
        990867060,
        "seventh",
        ""
      ],
      "MarisaB": [
        987521560,
        "seventh",
        ""
      ],
      "MarisaC": [
        1003229380,
        "nanamaru",
        ""
      ]
    }
  },
  "SA": {
    "Easy": {
      "ReimuA": [
        659735900,
        "morth",
        "http://score.royalflare.net/th11/replay11/th11_ud1349.rpy"
      ],
      "ReimuB": [
        623749430,
        "morth",
        "http://score.royalflare.net/th11/replay11/th11_ud135a.rpy"
      ],
      "ReimuC": [
        660024840,
        "morth",
        "http://score.royalflare.net/th11/replay11/th11_ud135f.rpy"
      ],
      "MarisaA": [
        706826820,
        "nyanko",
        "http://score.royalflare.net/th11/replay11/th11_ud1364.rpy"
      ],
      "MarisaB": [
        713931860,
        "morth",
        "http://score.royalflare.net/th11/replay11/th11_ud1371.rpy"
      ],
      "MarisaC": [
        639535650,
        "morth",
        "http://score.royalflare.net/th11/replay11/th11_ud13ba.rpy"
      ]
    },
    "Normal": {
      "ReimuA": [
        1089307060,
        "nyanko",
        ""
      ],
      "ReimuB": [
        1017688610,
        "小走先輩",
        "http://score.royalflare.net/th11/replay11/th11_ud1104.rpy"
      ],
      "ReimuC": [
        1071892480,
        "nyanko",
        "http://score.royalflare.net/th11/replay11/th11_ud110b.rpy"
      ],
      "MarisaA": [
        1147733170,
        "nyanko",
        ""
      ],
      "MarisaB": [
        1197670530,
        "nyanko",
        "http://score.royalflare.net/th11/replay11/th11_ud12f8.rpy"
      ],
      "MarisaC": [
        951080690,
        "悠木碧",
        "http://score.royalflare.net/th11/replay11/th11_ud1113.rpy"
      ]
    },
    "Hard": {
      "ReimuA": [
        1919799160,
        "nyanko",
        "http://score.royalflare.net/th11/replay11/th11_ud0d96.rpy"
      ],
      "ReimuB": [
        1704847550,
        "nyanko",
        "http://score.royalflare.net/th11/replay11/th11_ud0db3.rpy"
      ],
      "ReimuC": [
        1646055790,
        "ひろなex",
        ""
      ],
      "MarisaA": [
        1920135380,
        "夢路寿",
        "http://score.royalflare.net/th11/replay11/th11_ud119d.rpy"
      ],
      "MarisaB": [
        2033714330,
        "えなめる",
        "http://score.royalflare.net/th11/replay11/th11_ud10b1.rpy"
      ],
      "MarisaC": [
        1401024060,
        "K・G",
        "http://score.royalflare.net/th11/replay11/th11_ud1316.rpy"
      ]
    },
    "Lunatic": {
      "ReimuA": [
        5036683530,
        "Gobou",
        "http://score.royalflare.net/th11/replay11/th11_ud1320.rpy"
      ],
      "ReimuB": [
        3745660580,
        "UKT",
        "http://score.royalflare.net/th11/replay11/th11_ud1217.rpy"
      ],
      "ReimuC": [
        3642572170,
        "UKT",
        "http://score.royalflare.net/th11/replay11/th11_ud11ba.rpy"
      ],
      "MarisaA": [
        4347625050,
        "UKT",
        "http://score.royalflare.net/th11/replay11/th11_ud10d0.rpy"
      ],
      "MarisaB": [
        4423086650,
        "UKT",
        "http://score.royalflare.net/th11/replay11/th11_ud0f6c.rpy"
      ],
      "MarisaC": [
        3133453200,
        "UKT",
        "http://score.royalflare.net/th11/replay11/th11_ud0fc8.rpy"
      ]
    },
    "Extra": {
      "ReimuA": [
        1122028280,
        "IBUKI",
        "http://score.royalflare.net/th11/replay11/th11_ud12ba.rpy"
      ],
      "ReimuB": [
        1101316000,
        "ASL",
        "http://score.royalflare.net/th11/replay11/th11_ud1207.rpy"
      ],
      "ReimuC": [
        1076628060,
        "ASL",
        "http://score.royalflare.net/th11/replay11/th11_ud1237.rpy"
      ],
      "MarisaA": [
        1113194290,
        "ASL",
        "http://score.royalflare.net/th11/replay11/th11_ud1150.rpy"
      ],
      "MarisaB": [
        1102183510,
        "ASL",
        "http://score.royalflare.net/th11/replay11/th11_ud1127.rpy"
      ],
      "MarisaC": [
        1081890510,
        "ASL",
        "http://score.royalflare.net/th11/replay11/th11_ud11f8.rpy"
      ]
    }
  },
  "UFO": {
    "Easy": {
      "ReimuA": [
        1942160120,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0db5.rpy"
      ],
      "ReimuB": [
        1988891580,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0fe3.rpy"
      ],
      "MarisaA": [
        2158767550,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0daa.rpy"
      ],
      "MarisaB": [
        2167694350,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud1056.rpy"
      ],
      "SanaeA": [
        2108787630,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud105b.rpy"
      ],
      "SanaeB": [
        2152812300,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud1051.rpy"
      ]
    },
    "Normal": {
      "ReimuA": [
        2613435630,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud1073.rpy"
      ],
      "ReimuB": [
        2616846700,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud1039.rpy"
      ],
      "MarisaA": [
        2829615860,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0c63.rpy"
      ],
      "MarisaB": [
        2900503630,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud1038.rpy"
      ],
      "SanaeA": [
        2792713420,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0da8.rpy"
      ],
      "SanaeB": [
        2950387290,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud104f.rpy"
      ]
    },
    "Hard": {
      "ReimuA": [
        2892847470,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0e68.rpy"
      ],
      "ReimuB": [
        3045746740,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0faa.rpy"
      ],
      "MarisaA": [
        3063788870,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0ccb.rpy"
      ],
      "MarisaB": [
        3211129200,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0e9a.rpy"
      ],
      "SanaeA": [
        3029549370,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0d0b.rpy"
      ],
      "SanaeB": [
        3267272190,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0e5a.rpy"
      ]
    },
    "Lunatic": {
      "ReimuA": [
        3003541930,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0f6d.rpy"
      ],
      "ReimuB": [
        2908988540,
        "K・G",
        ""
      ],
      "MarisaA": [
        3292353200,
        "shin",
        "http://score.royalflare.net/th12/replay12/th12_ud0f01.rpy"
      ],
      "MarisaB": [
        3062639820,
        "K・G",
        "http://score.royalflare.net/th12/replay12/th12_ud115e.rpy"
      ],
      "SanaeA": [
        3136980120,
        "K・G",
        ""
      ],
      "SanaeB": [
        3357725380,
        "K・G",
        "http://score.royalflare.net/th12/replay12/th12_ud11c9.rpy"
      ]
    },
    "Extra": {
      "ReimuA": [
        670462130,
        "ニャムニャム",
        ""
      ],
      "ReimuB": [
        630584000,
        "ニャムニャム",
        "http://score.royalflare.net/th12/replay12/th12_ud11cd.rpy"
      ],
      "MarisaA": [
        710608440,
        "ニャムニャム",
        ""
      ],
      "MarisaB": [
        651194270,
        "ニャムニャム",
        ""
      ],
      "SanaeA": [
        653845970,
        "ニャムニャム",
        ""
      ],
      "SanaeB": [
        725648860,
        "wal",
        ""
      ]
    }
  },
  "GFW": {
    "Easy": {
      "A1": [
        36217610,
        "chum",
        ""
      ],
      "A2": [
        43852610,
        "DreamDweller",
        "http://score.royalflare.net/th128/replay128/th128_ud0668.rpy"
      ],
      "B1": [
        35685310,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0733.rpy"
      ],
      "B2": [
        39231480,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0705.rpy"
      ],
      "C1": [
        38077290,
        "chum",
        ""
      ],
      "C2": [
        41589020,
        "chum",
        ""
      ]
    },
    "Normal": {
      "A1": [
        61392690,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0786.rpy"
      ],
      "A2": [
        72022590,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud072f.rpy"
      ],
      "B1": [
        56655040,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0736.rpy"
      ],
      "B2": [
        60305550,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0709.rpy"
      ],
      "C1": [
        59624220,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0717.rpy"
      ],
      "C2": [
        58542010,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0729.rpy"
      ]
    },
    "Hard": {
      "A1": [
        76931620,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0745.rpy"
      ],
      "A2": [
        89236060,
        "chum",
        ""
      ],
      "B1": [
        76667300,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0741.rpy"
      ],
      "B2": [
        76905060,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0714.rpy"
      ],
      "C1": [
        75333510,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0716.rpy"
      ],
      "C2": [
        77488540,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud06f3.rpy"
      ]
    },
    "Lunatic": {
      "A1": [
        111136160,
        "MegaPulse",
        ""
      ],
      "A2": [
        125877380,
        "MegaPulse",
        ""
      ],
      "B1": [
        107163550,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0768.rpy"
      ],
      "B2": [
        102935550,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0728.rpy"
      ],
      "C1": [
        102247660,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud0724.rpy"
      ],
      "C2": [
        105483820,
        "chum",
        "http://score.royalflare.net/th128/replay128/th128_ud071d.rpy"
      ]
    },
    "Extra": {
      "-": [
        100742250,
        "みぞる",
        "http://score.royalflare.net/th128/replay128/th128_ud0556.rpy"
      ]
    }
  },
  "TD": {
    "Easy": {
      "Reimu": [
        952661470,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud09a4.rpy"
      ],
      "Marisa": [
        1003354190,
        "Mithril",
        ""
      ],
      "Sanae": [
        942901130,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud0a16.rpy"
      ],
      "Youmu": [
        1032057240,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud0a09.rpy"
      ]
    },
    "Normal": {
      "Reimu": [
        1805565010,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud09aa.rpy"
      ],
      "Marisa": [
        1968470320,
        "Mithril",
        ""
      ],
      "Sanae": [
        1806511210,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud0a14.rpy"
      ],
      "Youmu": [
        2044183240,
        "Mithril",
        ""
      ]
    },
    "Hard": {
      "Reimu": [
        3236612450,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud09c5.rpy"
      ],
      "Marisa": [
        3628480290,
        "leo",
        ""
      ],
      "Sanae": [
        3201011720,
        "Mithril",
        ""
      ],
      "Youmu": [
        3894970910,
        "おとど",
        ""
      ]
    },
    "Lunatic": {
      "Reimu": [
        3259421690,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud09e7.rpy"
      ],
      "Marisa": [
        3622725980,
        "Mithril",
        "http://score.royalflare.net/th13/replay13/th13_ud0a73.rpy"
      ],
      "Sanae": [
        3099392060,
        "ns",
        ""
      ],
      "Youmu": [
        4000147890,
        "otd",
        ""
      ]
    },
    "Extra": {
      "Reimu": [
        566200720,
        "T",
        ""
      ],
      "Marisa": [
        608553520,
        "morth",
        "http://score.royalflare.net/th13/replay13/th13_ud0acf.rpy"
      ],
      "Sanae": [
        535000480,
        "morth",
        ""
      ],
      "Youmu": [
        603783460,
        "omega",
        "http://score.royalflare.net/th13/replay13/th13_ud0641.rpy"
      ]
    }
  },
  "DDC": {
    "Easy": {
      "ReimuA": [
        920715460,
        "NSNSNS556",
        "http://score.royalflare.net/th14/replay14/th14_ud0724.rpy"
      ],
      "ReimuB": [
        775357770,
        "Karisa",
        "http://score.royalflare.net/th14/replay14/th14_ud074a.rpy"
      ],
      "MarisaA": [
        820076540,
        "SJF",
        ""
      ],
      "MarisaB": [
        789629180,
        "K・G",
        "http://score.royalflare.net/th14/replay14/th14_ud05d4.rpy"
      ],
      "SakuyaA": [
        917676840,
        "SJF",
        ""
      ],
      "SakuyaB": [
        1118074340,
        "LYX",
        ""
      ]
    },
    "Normal": {
      "ReimuA": [
        1060530260,
        "みょん吉",
        ""
      ],
      "ReimuB": [
        914525760,
        "K・G",
        ""
      ],
      "MarisaA": [
        945713840,
        "K・G",
        "http://score.royalflare.net/th14/replay14/th14_ud05a7.rpy"
      ],
      "MarisaB": [
        965259250,
        "K・G",
        "http://score.royalflare.net/th14/replay14/th14_ud05aa.rpy"
      ],
      "SakuyaA": [
        1080557710,
        "K・G",
        ""
      ],
      "SakuyaB": [
        1643366120,
        "LYX",
        ""
      ]
    },
    "Hard": {
      "ReimuA": [
        1252745050,
        "KG",
        ""
      ],
      "ReimuB": [
        969187110,
        "K・G",
        "http://score.royalflare.net/th14/replay14/th14_ud0616.rpy"
      ],
      "MarisaA": [
        1069240990,
        "K・G",
        ""
      ],
      "MarisaB": [
        1241630210,
        "K・G",
        "http://score.royalflare.net/th14/replay14/th14_ud066b.rpy"
      ],
      "SakuyaA": [
        1248118740,
        "苏",
        ""
      ],
      "SakuyaB": [
        1929988730,
        "苏",
        ""
      ]
    },
    "Lunatic": {
      "ReimuA": [
        1591598050,
        "White Rat",
        ""
      ],
      "ReimuB": [
        1140297420,
        "White Rat",
        ""
      ],
      "MarisaA": [
        1230732810,
        "White Rat",
        ""
      ],
      "MarisaB": [
        1870300300,
        "leo",
        ""
      ],
      "SakuyaA": [
        1511462090,
        "苏",
        ""
      ],
      "SakuyaB": [
        2204848600,
        "苏",
        "http://score.royalflare.net/th14/replay14/th14_ud0726.rpy"
      ]
    },
    "Extra": {
      "ReimuA": [
        800680870,
        "YSZK",
        ""
      ],
      "ReimuB": [
        723873600,
        "K・G",
        ""
      ],
      "MarisaA": [
        732504040,
        "K・G",
        "http://score.royalflare.net/th14/replay14/th14_ud072b.rpy"
      ],
      "MarisaB": [
        1231319630,
        "Marisa",
        ""
      ],
      "SakuyaA": [
        767279680,
        "K・G",
        ""
      ],
      "SakuyaB": [
        842596500,
        "LYX",
        ""
      ]
    }
  },
  "LoLK": {
    "Easy": {
      "Reimu": [
        1248920820,
        "kisara",
        ""
      ],
      "Marisa": [
        1341516550,
        "kisara",
        ""
      ],
      "Sanae": [
        1624647980,
        "kisara",
        ""
      ],
      "Reisen": [
        1667608350,
        "kisara",
        ""
      ]
    },
    "Normal": {
      "Reimu": [
        1807763690,
        "kisara",
        ""
      ],
      "Marisa": [
        1809184820,
        "kisara",
        "http://score.royalflare.net/th15/replay15/th15_ud026f.rpy"
      ],
      "Sanae": [
        2517604770,
        "kisara",
        "http://score.royalflare.net/th15/replay15/th15_ud026e.rpy"
      ],
      "Reisen": [
        2506064950,
        "kisara",
        ""
      ]
    },
    "Hard": {
      "Reimu": [
        1915404560,
        "kisara",
        ""
      ],
      "Marisa": [
        2087017840,
        "kisara",
        ""
      ],
      "Sanae": [
        2513954510,
        "kisara",
        "http://score.royalflare.net/th15/replay15/th15_ud026a.rpy"
      ],
      "Reisen": [
        2549910870,
        "kisara",
        ""
      ]
    },
    "Lunatic": {
      "Reimu": [
        2053725610,
        "K・G",
        ""
      ],
      "Marisa": [
        2106333590,
        "K・G",
        ""
      ],
      "Sanae": [
        3077565890,
        "kisara",
        "http://score.royalflare.net/th15/replay15/th15_ud029d.rpy"
      ],
      "Reisen": [
        2922020800,
        "HUF",
        ""
      ]
    },
    "Extra": {
      "Reimu": [
        928380670,
        "kisara",
        ""
      ],
      "Marisa": [
        923555520,
        "kisara",
        "http://score.royalflare.net/th15/replay15/th15_ud0263.rpy"
      ],
      "Sanae": [
        1009636890,
        "kisara",
        ""
      ],
      "Reisen": [
        1016971530,
        "kisara",
        "http://score.royalflare.net/th15/replay15/th15_ud0261.rpy"
      ]
    }
  },
  "HSiFS": {
    "Easy": {
      "ReimuSpring": [
        0,
        "",
        ""
      ],
      "ReimuSummer": [
        1170241780,
        "Andrew",
        ""
      ],
      "ReimuAutumn": [
        0,
        "",
        ""
      ],
      "ReimuWinter": [
        0,
        "",
        ""
      ],
      "CirnoSpring": [
        0,
        "",
        ""
      ],
      "CirnoSummer": [
        1070411910,
        "K.M",
        ""
      ],
      "CirnoAutumn": [
        0,
        "",
        ""
      ],
      "CirnoWinter": [
        0,
        "",
        ""
      ],
      "AyaSpring": [
        0,
        "",
        ""
      ],
      "AyaSummer": [
        0,
        "",
        ""
      ],
      "AyaAutumn": [
        0,
        "",
        ""
      ],
      "AyaWinter": [
        0,
        "",
        ""
      ],
      "MarisaSpring": [
        0,
        "",
        ""
      ],
      "MarisaSummer": [
        951436740,
        "K.M",
        ""
      ],
      "MarisaAutumn": [
        0,
        "",
        ""
      ],
      "MarisaWinter": [
        0,
        "",
        ""
      ]
    },
    "Normal": {
      "ReimuSpring": [
        0,
        "",
        ""
      ],
      "ReimuSummer": [
        0,
        "",
        ""
      ],
      "ReimuAutumn": [
        2823683680,
        "ROUND",
        ""
      ],
      "ReimuWinter": [
        0,
        "",
        ""
      ],
      "CirnoSpring": [
        0,
        "",
        ""
      ],
      "CirnoSummer": [
        0,
        "",
        ""
      ],
      "CirnoAutumn": [
        0,
        "",
        ""
      ],
      "CirnoWinter": [
        0,
        "",
        ""
      ],
      "AyaSpring": [
        0,
        "",
        ""
      ],
      "AyaSummer": [
        0,
        "",
        ""
      ],
      "AyaAutumn": [
        3406426470,
        "MASHIRO!",
        ""
      ],
      "AyaWinter": [
        0,
        "",
        ""
      ],
      "MarisaSpring": [
        0,
        "",
        ""
      ],
      "MarisaSummer": [
        0,
        "",
        ""
      ],
      "MarisaAutumn": [
        3142447070,
        "ROUND",
        ""
      ],
      "MarisaWinter": [
        0,
        "",
        ""
      ]
    },
    "Hard": {
      "ReimuSpring": [
        0,
        "",
        ""
      ],
      "ReimuSummer": [
        0,
        "",
        ""
      ],
      "ReimuAutumn": [
        0,
        "",
        ""
      ],
      "ReimuWinter": [
        0,
        "",
        ""
      ],
      "CirnoSpring": [
        0,
        "",
        ""
      ],
      "CirnoSummer": [
        0,
        "",
        ""
      ],
      "CirnoAutumn": [
        0,
        "",
        ""
      ],
      "CirnoWinter": [
        0,
        "",
        ""
      ],
      "AyaSpring": [
        0,
        "",
        ""
      ],
      "AyaSummer": [
        0,
        "",
        ""
      ],
      "AyaAutumn": [
        0,
        "",
        ""
      ],
      "AyaWinter": [
        0,
        "",
        ""
      ],
      "MarisaSpring": [
        0,
        "",
        ""
      ],
      "MarisaSummer": [
        0,
        "",
        ""
      ],
      "MarisaAutumn": [
        3375036970,
        "K・G",
        ""
      ],
      "MarisaWinter": [
        0,
        "",
        ""
      ]
    },
    "Lunatic": {
      "ReimuSpring": [
        3137305410,
        "Lutino",
        ""
      ],
      "ReimuSummer": [
        0,
        "",
        ""
      ],
      "ReimuAutumn": [
        0,
        "",
        ""
      ],
      "CirnoSpring": [
        0,
        "",
        ""
      ],
      "CirnoSummer": [
        0,
        "",
        ""
      ],
      "CirnoAutumn": [
        2985114950,
        "K・G",
        ""
      ],
      "CirnoWinter": [
        3507823580,
        "REX",
        ""
      ],
      "AyaSpring": [
        0,
        "",
        ""
      ],
      "AyaSummer": [
        0,
        "",
        ""
      ],
      "AyaAutumn": [
        6556886680,
        "collett",
        ""
      ],
      "AyaWinter": [
        0,
        "",
        ""
      ],
      "MarisaSpring": [
        0,
        "",
        ""
      ],
      "MarisaSummer": [
        0,
        "",
        ""
      ],
      "MarisaAutumn": [
        3823943740,
        "K・G",
        ""
      ],
      "MarisaWinter": [
        0,
        "",
        ""
      ]
    },
    "Extra": {
      "Reimu": [
        1239226580,
        "GmbRuby!",
        ""
      ],
      "Cirno": [
        1566843530,
        "GmbRuby!",
        ""
      ],
      "Aya": [
        1344230000,
        "ARF",
        ""
      ],
      "Marisa": [
        1346603740,
        "GmbRuby!",
        ""
      ]
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

var rand = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

var load = function (page) {
    var random = rand(1, 8);
    document.body.style.background = "url('./bg/" + random + ".png')";
    
    if (page === "wrlist") {
        var wrArray, score, player, replayLink, category, overallWr, overallWrCategory, overallWrReplayLink;
        
        for (var game in WRs) {
            for (var difficulty in WRs[game]) {
                overallWr = 0;
                overallWrCategory = "";
                overallWrReplayLink = "";
                
                for (var shottype in WRs[game][difficulty]) {
                    category = game + difficulty + shottype;
                    wrArray = WRs[game][difficulty][shottype];
                    
                    if (wrArray[0] === 0) {
                        document.getElementById(category).innerHTML = "Uncontested category";
                        continue;
                    }
                    
                    score = sep(wrArray[0]);
                    player = "<i>" + wrArray[1] + "</i>";
                    
                    if (wrArray[2] === "") {
                        replayLink = "<span class='wr'>" +score + " by " + player + "</span>";
                    } else {
                        replayLink = "<a class='wr' href='" + wrArray[2] + "'>" + score + " by " + player + "</a>";
                    }
                    
                    document.getElementById(category).innerHTML = replayLink;
                    
                    if (wrArray[0] > overallWr) {
                        overallWr = wrArray[0];
                        overallWrCategory = category;
                        overallWrReplayLink = replayLink;
                    }
                }
                
                if (overallWrCategory !== "") {
                    document.getElementById(overallWrCategory).innerHTML = "<b>" + overallWrReplayLink + "</b>";
                }
            }
        }
    }
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