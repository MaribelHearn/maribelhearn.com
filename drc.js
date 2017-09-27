var WRs, global = this, phantasm = true, noExtra = true, noShottypes = true, GAME = "#game", DIFFICULTY = "#difficulty", CHALLENGE = "#challenge", MISSES = "#misses", SCORING = "#scoring", RUBRICS = "#rubrics",
    BOMBS = "#bombs", SCORE = "#score", PERFORMANCE = "#performance", DRCPOINTS = "#drcpoints", ERROR = "#error", SHOTTYPE = "#shottype", NOTIFY = "#notify", RUBRICS_BUTTON = "#rubricsButton", NB = "#nb",
    NO_EXTRA = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>", NOTIFY_TEXT = "<b>Important Notice:</b> ", PHANTASMAGORIA = "#phantasmagoriaTable", IS = "#is",
    DIFF_OPTIONS = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option>", SHOTTYPE_MULTIPLIERS = "#shottypeMultipliersTable", LS = "#ls",
    PHANTASM = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option><option>Phantasm</option>", SHOTTYPE_LABEL = "#shottypeLabel",
    MISSES_INPUT = "<label for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100>", ERROR_TEXT = "<b style='color:red'>Error: ", CLEARED = "#cleared", SCENE = "#scene",
    SCORE_OPTIONS = "<label for='score'>Score</label><input id='score' type='text'>", SCORING_TABLE = "#scoringTable", SURV_TABLE = "#survivalTable", ROUTE = "#route", BB = "#bb", DS_TABLE = "#dsTable",
    MOF_TABLE = "#mofTable", RELEASES = "#releases", SEASON = "#season",
    SURV_RUBRICS = {
        "SoEW": {
            "Easy": {
                "base": 30,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 80,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 120,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Lunatic": {
                "base": 250,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 100,
                "exp": 1.1,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuC": 1.05
            }
        },
        "PoDD": {
            "Easy": {
                "base": 50,
                "min": 15,
                "lives": 5,
                "noBombBonus": 10
            },
            "Normal": {
                "base": 90,
                "min": 25,
                "lives": 5,
                "noBombBonus": 20
            },
            "Hard": {
                "base": 130,
                "min": 40,
                "lives": 5,
                "noBombBonus": 30
            },
            "Lunatic": {
                "base": 260,
                "min": 50,
                "lives": 5,
                "noBombBonus": 50
            },
            "multiplier": {
                "Mima": 1.1,
                "Marisa": 1.1,
                "Ellen": 1.2,
                "Kotohime": 1.1,
                "Kana": 1.15,
                "Chiyuri": 1.2
            }
        },
        "LLS": {
            "Easy": {
                "base": 40,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 90,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Hard": {
                "base": 140,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Lunatic": {
                "base": 280,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Extra": {
                "base": 90,
                "exp": 1.07,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuB": 1.05,
                "MarisaB": 1.05
            }
        },
        "MS": {
            "Easy": {
                "base": 60,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Lunatic": {
                "base": 300,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 100,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "Reimu": 1.05,
                "Marisa": 1.05,
                "Yuuka": 1.1
            }
        },
        "EoSD": {
            "Easy": {
                "base": 50,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Lunatic": {
                "base": 320,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuA": 1.05,
                "MarisaA": 1.1
            }
        },
        "PCB": {
            "Easy": {
                "base": 60,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Lunatic": {
                "base": 280,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Phantasm": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuA": 1.05,
                "MarisaB": 1.05,
                "SakuyaA": 1.05,
                "SakuyaB": 1.05
            }
        },
        "IN": {
            "Easy": {
                "base": 45,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 90,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 140,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Lunatic": {
                "base": 290,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "MagicTeam": 1.05,
                "ScarletTeam": 1.05,
                "Reimu": 1.1,
                "Marisa": 1.05,
                "Alice": 1.2,
                "Sakuya": 1.2,
                "Remilia": 1.05,
                "Yuyuko": 1.05
            }
        },
        "PoFV": {
            "Easy": {
                "base": 40,
                "min": 10,
                "lives": 7,
                "noBombBonus": 10
            },
            "Normal": {
                "base": 70,
                "min": 15,
                "lives": 7,
                "noBombBonus": 20
            },
            "Hard": {
                "base": 100,
                "min": 20,
                "lives": 7,
                "noBombBonus": 30
            },
            "Lunatic": {
                "base": 210,
                "min": 30,
                "lives": 7,
                "noBombBonus": 50
            },
            "Extra": {
                "base": 85,
                "min": 15,
                "lives": 8,
                "noBombBonus": 25
            },
            "multiplier": {
                "Reisen": 1.05,
                "Lyrica": 1.05,
                "Tewi": 1.05,
                "Aya": 0.5,
                "Medicine": 0.5,
                "Yuuka": 1.05
            }
        },
        "MoF": {
            "Easy": {
                "base": 60,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1
            },
            "Lunatic": {
                "base": 290,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 105,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuA": 1.05,
                "ReimuC": 1.15,
                "MarisaA": 1.15,
                "MarisaB": 1.05
            }
        },
        "SA": {
            "Easy": {
                "base": 50,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 110,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1
            },
            "Lunatic": {
                "base": 300,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuB": 1.05,
                "ReimuC": 1.1,
                "MarisaA": 1.05,
                "MarisaC": 1.15
            }
        },
        "UFO": {
            "Easy": {
                "base": 50,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 160,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1
            },
            "Lunatic": {
                "base": 315,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuB": 1.05,
                "MarisaA": 1.05,
                "MarisaB": 1.15,
                "SanaeA": 1.05
            }
        },
        "GFW": {
            "Easy": {
                "base": 50,
                "exp": 1.09,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 90,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 130,
                "exp": 1.06,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Lunatic": {
                "base": 260,
                "exp": 1.06,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1
            },
            "Extra": {
                "base": 130,
                "exp": 1.07,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "B1": 1.15,
                "B2": 1.05,
                "C1": 1.1
            }
        },
        "TD": {
            "Easy": {
                "base": 50,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 90,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 140,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1
            },
            "Lunatic": {
                "base": 280,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "Sanae": 1.1
            }
        },
        "DDC": {
            "Easy": {
                "base": 50,
                "exp": 1.07,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1
            },
            "Lunatic": {
                "base": 290,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "ReimuB": 1.1,
                "MarisaA": 1.2,
                "MarisaB": 1.05,
                "SakuyaB": 1.2
            }
        },
        "LoLK": {
            "Easy": {
                "base": 60,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1
            },
            "Normal": {
                "base": 120,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "Hard": {
                "base": 160,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1
            },
            "Lunatic": {
                "base": 320,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1
            },
            "Extra": {
                "base": 130,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1
            },
            "multiplier": {
                "Marisa": 1.15,
                "Sanae": 1.05,
                "Reisen": 1.05
            }
        },
        "HSiFS": {
            "Easy": {
                "base": 50,
                "exp": 1.07,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
                "firstRelease": 2,
                "release": 0.5
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
                "firstRelease": 2,
                "release": 0.5
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
                "firstRelease": 2,
                "release": 0.5
            },
            "Lunatic": {
                "base": 315,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
                "firstRelease": 3,
                "release": 0.5
            },
            "Extra": {
                "base": 105,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
                "firstRelease": 2,
                "release": 0.5
            },
            "multiplier": {
                "Cirno": 1.15,
                "Aya": 1.10,
                "Marisa": 1.05
            },
            "seasonMultiplier": {
                "Spring": 1.15,
                "Summer": 1.15,
                "Autumn": 1.05
            }
        }
    },
    SCORE_RUBRICS = {
        "HRtP": {
            "Easy": {
                "base": 300,
                "exp": 4
            },
            "Normal": {
                "base": 325,
                "exp": 4
            },
            "Hard": {
                "base": 375,
                "exp": 3
            },
            "Lunatic": {
                "base": 400,
                "exp": 3
            }
        },
        "SoEW": {
            "Easy": {
                "base": 300,
                "exp": 4
            },
            "Normal": {
                "base": 300,
                "exp": 4
            },
            "Hard": {
                "base": 350,
                "exp": 3
            },
            "Lunatic": {
                "base": 375,
                "exp": 2
            },
            "Extra": {
                "base": 325,
                "exp": 3
            }
        },
        "PoDD": {
            "Easy": {
                "base": 300,
                "exp": 4
            },
            "Normal": {
                "base": 350,
                "exp": 3
            },
            "Hard": {
                "base": 400,
                "exp": 3
            },
            "Lunatic": {
                "base": 450,
                "exp": 2
            }
        },
        "LLS": {
            "Easy": {
                "base": 300,
                "exp": 4
            },
            "Normal": {
                "base": 350,
                "exp": 3
            },
            "Hard": {
                "base": 375,
                "exp": 3
            },
            "Lunatic": {
                "base": 400,
                "exp": 2.5
            },
            "Extra": {
                "base": 350,
                "exp": 5
            }
        },
        "MS": {
            "Easy": {
                "base": 300,
                "exp": 4
            },
            "Normal": {
                "base": 350,
                "exp": 3
            },
            "Hard": {
                "base": 400,
                "exp": 3
            },
            "Lunatic": {
                "base": 425,
                "exp": 2
            },
            "Extra": {
                "base": 375,
                "exp": 3
            }
        },
        "EoSD": {
            "Easy": {
                "base": 350,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            }
        },
        "PCB": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            },
            "Phantasm": {
                "base": 450,
                "exp": 2.5
            }
        },
        "IN": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            }
        },
        "PoFV": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            }
        },
        "SA": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            }
        },
        "UFO": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            }
        },
        "GFW": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 7
            }
        },
        "TD": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 7
            }
        },
        "DDC": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            }
        },
        "LoLK": {
            "Easy": {
                "base": 375,
                "exp": 4
            },
            "Normal": {
                "base": 400,
                "exp": 3
            },
            "Hard": {
                "base": 450,
                "exp": 2.5
            },
            "Lunatic": {
                "base": 500,
                "exp": 2
            },
            "Extra": {
                "base": 450,
                "exp": 2.5
            }
        },
        "HSiFS": {
            "Easy": {
                "base": 300,
                "exp": 4
            },
            "Normal": {
                "base": 350,
                "exp": 3
            },
            "Hard": {
                "base": 400,
                "exp": 3
            },
            "Lunatic": {
                "base": 450,
                "exp": 2
            },
            "Extra": {
                "base": 350,
                "exp": 3
            }
        }
    },
    MAX_LAST_SPELLS = {
        "Easy": {
            "FinalA": 1,
            "FinalB": 5
        },
        "Normal": {
            "FinalA": 6,
            "FinalB": 10
        },
        "Hard": {
            "FinalA": 6,
            "FinalB": 10
        },
        "Lunatic": {
            "FinalA": 6,
            "FinalB": 10
        }
    },
    SCENE_THRESHOLDS = {
        "2-2": [0, 170000, 205000, 225000],
        "5-4": [0, 450000, 600000, 700000],
        "5-5": [0, 330000, 390000, 425000],
        "7-6": [0, 1000000, 1500000, 1800000],
        "10-1": [0, 700000, 940000, 1000000],
        "10-2": [0, 750000, 1350000, 1525000],
        "12-2": [0, 700000, 810000, 840000],
        "12-8": [0, 2000000, 2750000, 3050000],
        "EX-6": [0, 700000, 1200000, 1242000],
        "EX-9": [0, 3600000, 4040000, 4140000]
    },
    MOF_THRESHOLDS = {
        "Lunatic": {
            "ReimuB": {
                "score": [2000000000, 2100000000, 2150000000, 2170000000, 2180000000, 2190000000],
                "base": [220, 270, 320, 360, 410, 470],
                "increment": [5, 1, 2, 5, 6, 7],
                "step": [10000000, 1000000, 1000000, 1000000, 1000000, 1000000]
            },
            "MarisaC": {
                "score": [2000000000, 2100000000, 2150000000, 2190000000, 2200000000, 2210000000],
                "base": [210, 260, 310, 370, 420, 480],
                "increment": [5, 1, 1.5, 5, 6, 6],
                "step": [10000000, 1000000, 1000000, 1000000, 1000000, 1000000]
            }
        }
    };

$(document).ready(function() {
    $.get("wrlist.json", function(data) {
        WRs = data;
        checkValues(true, true, true);
        generateRubrics();
    }, "json");
});

function checkValues(changePerformance, changeShottypes, doubleSpoilerCheck) {
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(), shottype = $(SHOTTYPE).val();
    
    /*if (doubleSpoilerCheck) {
        if (game == "DS") {
            $(CHALLENGE).html("<option>Scoring</option>");
            $(DIFFICULTY).css("display", "none");
        } else {
            $(CHALLENGE).html("<option>Scoring</option><option>Survival</option>");
            $(DIFFICULTY).css("display", "inline");
        }
    }*/
    
    if (challenge == "Survival") {
        if (game == "MoF" && shottype == "MarisaB") {
            $(NOTIFY).html(NOTIFY_TEXT + "usage of the MarisaB damage bug is BANNED in survival.");
        } else if (game == "TD") {
            $(NOTIFY).html(NOTIFY_TEXT + "manual trances count as bombs (that is, trances from pressing C).");
        } else if (game == "PCB") {
            $(NOTIFY).html(NOTIFY_TEXT + "border breaks count as bombs (even if they are accidental).");
        } else {
            $(NOTIFY).html("");
        }
    }
    
    
    if (changePerformance) {
        $(ROUTE).css("display", "none");
        $(SEASON).css("display", "none");
        
        if (changeShottypes) {
            if (game == "PCB") {
                $(DIFFICULTY).html(PHANTASM);
                phantasm = true;
            } else if (phantasm) {
                $(DIFFICULTY).html(DIFF_OPTIONS);
                phantasm = false;
            }
            
            if (game == "HRtP" || game == "PoDD") {
                $(DIFFICULTY).html(NO_EXTRA);
                noExtra = true;
            } else if (game != "PCB" && noExtra) {
                $(DIFFICULTY).html(DIFF_OPTIONS);
                noExtra = false;
            }
        }
        
        if (game == "HSiFS" && $(DIFFICULTY).val() != "Extra") {
            $(SEASON).css("display", "inline");
        }
        
        if (challenge == "Survival") {
            var survOptions = MISSES_INPUT;
            
            if (game == "PoDD") {
                survOptions += "<br><label for='nb'>No Bomb</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace("Misses</label>", "Rounds lost</label>").replace("max=100", "max=5");
            } else if (game == "PoFV") {
                survOptions += "<br><label for='nb'>No Charge Attacks</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace("Misses</label>", "Rounds lost</label>").replace("max=100", "max=8");
            } else {
                survOptions += "<br><label for='bombs'>Bombs</label><input id='bombs' type='number' value=0 min=0 max=100>";
                
                if (game == "PCB") {
                    survOptions += "<br><label for='bb'>Border Breaks Only</label><input id='bb' type='checkbox'>";
                }
                
                if (game == "IN") {
                    difficulty = $(DIFFICULTY).val();
                    
                    if (difficulty == "Extra") {
                        survOptions += "<br><label for='is'>Imperishable Shooting Captured</label><input id='is' type='checkbox'>";
                    } else {
                        survOptions += "<br><label for='ls'>Last Spells Captured</label><input id='ls' type='number' value=0 min=0 max=10>";
                        $(ROUTE).css("display", "inline");
                    }
                }
                
                if (game == "HSiFS") {
                    survOptions += "<br><label for='releases'>Releases</label><input id='releases' type='number' value=0 min=0 max=1000>";
                }
            }
            
            $(PERFORMANCE).html(survOptions);
        } else {
            $(PERFORMANCE).html(game == "DS" ? "<label for='scene'>Scene</label><select id='scene'><option>2-2</option><option>5-4</option><option>5-5</option><option>7-6</option>" +
            "<option>10-1</option><option>10-2</option><option>12-2</option><option>12-8</option><option>EX-6</option><option>EX-9</option></select><br>" + SCORE_OPTIONS : SCORE_OPTIONS);
            $(NOTIFY).html("");
        }
    }
    
    if (changeShottypes) {
        checkShottypes(true);
    }
}

function checkShottypes(alwaysChange) {
    var game = $(GAME).val(), challenge = $(CHALLENGE).val(), difficulty = $(DIFFICULTY).val(), shottypeList = "", shottypes, shottype, i;
    
    shottypes = (game == "DS" ? ["Aya", "Hatate"] : Object.keys(WRs[game][difficulty]));
    
    if (game == "HSiFS") {
        shottypes = ["Reimu", "Cirno", "Aya", "Marisa"];
    }
    
    for (i = 0; i < shottypes.length; i++) {
        shottype = (shottypes[i].indexOf("Team") > -1 ? shottypes[i].replace("Team", " Team") : shottypes[i]);
        shottypeList += "<option value='" + shottypes[i] + "'>" + shottype + "</option>";
    }
    
    if (alwaysChange) {
        $(SHOTTYPE).html(shottypeList);
    }
    
    if (game == "GFW" && difficulty == "Extra") {
        $(SHOTTYPE).html("<option value='-'>-</option>");
        noShottypes = true;
    } else if (noShottypes) {
        $(SHOTTYPE).html(shottypeList);
        noShottypes = false;
    }
}

function isPhantasmagoria(game) {
    return game == "PoDD" || game == "PoFV";
}

function drcPoints() {
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(), shottype = $(SHOTTYPE).val(), rubric, points;
    
    if (challenge == "Survival") {
        if (!SURV_RUBRICS[game]) {
            $(ERROR).html(ERROR_TEXT + "the survival rubrics for this game are undetermined as of now.</b>");
            $(DRCPOINTS).html("Your DRC points for this run: <b>0</b>!");
            return;
        } else {
            $(ERROR).html("");
        }
        
        rubric = SURV_RUBRICS[game][difficulty];
        shottypeMultiplier = (SURV_RUBRICS[game].multiplier[shottype] ? SURV_RUBRICS[game].multiplier[shottype] : 1);
        points = (isPhantasmagoria(game) ? phantasmagoria(rubric, game, difficulty, shottypeMultiplier) : survivalPoints(rubric, game, difficulty, shottypeMultiplier));
    } else {
        if (!(game == "MoF" && difficulty == "Lunatic") && !SCORE_RUBRICS[game]) {
            $(ERROR).html(ERROR_TEXT + "the scoring rubrics for this game are undetermined as of now.</b>");
            $(DRCPOINTS).html("Your DRC points for this run: <b>0</b>!");
            return;
        } else {
            $(ERROR).html("");
        }
        
        if (game == "DS") {
            points = dsFormula(shottype);
        } else if (game == "MoF") {
            points = mofFormula(difficulty, shottype);
        } else {
            rubric = SCORE_RUBRICS[game][difficulty];
            points = scoringPoints(rubric, game, difficulty, shottype);
        }
    }
    
    $(DRCPOINTS).html("Your DRC points for this run: <b>" + points + "</b>!");
}

function phantasmagoria(rubric, game, difficulty, shottypeMultiplier) {
    var roundsLost = Number($(MISSES).val()), bonus;
    
    if (roundsLost > rubric.lives) {
        $(ERROR).html(ERROR_TEXT + "the number of rounds lost cannot exceed " + rubric.lives + ".");
        return 0;
    } else {
        $(ERROR).html("");
    }

    bonus = $(NB).is(":checked") ? rubric.noBombBonus : 0;
    
    if (difficulty == "Extra") {
        shottypeMultiplier = 1;
    }
    
    return Math.round(shottypeMultiplier * (rubric.base - ((rubric.base - rubric.min) / rubric.lives * roundsLost))) + bonus;
}

function survivalPoints(rubric, game, difficulty, shottypeMultiplier) {
    var misses = Number($(MISSES).val()), bombs = Number($(BOMBS).val()), n = 0, route, lastSpells, releases, season, seasonMultiplier;
    
    $(ERROR).html("");
    n += misses * rubric.miss;
    
    if (bombs >= 1 && !(game == "PCB" && $(BB).is(":checked"))) {
        n += rubric.firstBomb;
        bombs -= 1;
    }
    
    n += bombs * rubric.bomb;
    
    if (game == "HSiFS") {
        releases = Number($(RELEASES).val());
        
        if (releases >= 1) {
            n += rubric.firstRelease;
            releases -= 1;
        }
    
        n += releases * rubric.release;
    }
    
    drcpoints = Math.round(rubric.base * Math.pow(rubric.exp, -n));
    
    if (game == "IN") {
        if (difficulty == "Extra") {
            drcpoints += ($(IS).is(":checked") ? 5 : 0);
        } else {
            route = $(ROUTE).val();
            lastSpells = $(LS).val();
            
            if (lastSpells > MAX_LAST_SPELLS[difficulty][route]) {
                $(ERROR).html(ERROR_TEXT + "the number of Last Spells captured in a " + route + " clear on " + difficulty + " cannot exceed " + MAX_LAST_SPELLS[difficulty][route] + ".");
                return 0;
            }
            
            drcpoints += lastSpells * (difficulty == "Easy" ? 1 : 2);
        }
    }
    
    if (difficulty != "Extra" && difficulty != "Phantasm") {
        if (game == "HSiFS" && Number($(RELEASES).val()) === 0) {
            season = $(SEASON).val();
            seasonMultiplier = (SURV_RUBRICS[game].seasonMultiplier[season] ? SURV_RUBRICS[game].seasonMultiplier[season] : 1);
            drcpoints = Math.round(drcpoints * (shottypeMultiplier + seasonMultiplier - 1));
        } else {
            drcpoints = Math.round(drcpoints * shottypeMultiplier);
        }
    }
    
    return drcpoints;
}

function determineIncrement(thresholds, i) {
    var increment = (i === 1 ? 10 : 20), lowerBound = (i === 1 ? 0 : thresholds[i - 1]);
    
    return (thresholds[i] - lowerBound) / increment;
}

/*function dsFormula(shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), scene = $(SCENE).val(), thresholds = SCENE_THRESHOLDS[scene], drcpoints = 0, step, i;
    
    for (i = 2; i >= 0; i--) {
        step = determineIncrement(thresholds, i + 1);
        
        while (score > thresholds[i]) {
            drcpoints += 1;
            score -= step;
        }
    }
    
    return drcpoints;
}*/

function mofFormula(difficulty, shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), drcpoints = 0, originalScore = score, thresholds, i;
    
    // rubric currently only determined for Lunatic ReimuB and Lunatic MarisaC
    if (difficulty != "Lunatic") {
        $(ERROR).html(ERROR_TEXT + "the scoring rubrics for this difficulty are undetermined as of now.</b>");
        return drcpoints;
    } else if (shottype != "ReimuB" && shottype != "MarisaC") {
        $(ERROR).html(ERROR_TEXT + "the scoring rubrics for this shottype are undetermined as of now.</b>");
        return drcpoints;
    }
    
    thresholds = MOF_THRESHOLDS[difficulty][shottype];
    
    if (score < thresholds.score[0]) {
        return Math.round(Math.pow((score / thresholds.score[0]), 2) * 200);
    }
    
    for (i = thresholds.increment.length - 1; i >= 0; i--) {
        drcpoints = thresholds.base[i];
        step = thresholds.step[i];
        
        if (score >= thresholds.score[i]) {
            while (score > thresholds.score[i]) {
                drcpoints += thresholds.increment[i];
                score -= step;
            }
            
            break;
        }
    }
    
    return Math.min(Math.round(drcpoints), 500);
}

function scoringPoints(rubric, game, difficulty, shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), wr;
    
    if (isNaN(score)) {
        $(ERROR).html(ERROR_TEXT + "invalid score.</b>");
        return 0;
    } else {
        $(ERROR).html("");
    }
    
    if (game == "SoEW" && difficulty == "Hard") {
        wr = WRs[game][difficulty]["ReimuB"][0];
    } else if (game == "SoEW" && difficulty == "Lunatic") {
        wr = WRs[game][difficulty]["ReimuA"][0];
    } else if (game == "LLS") {
        wr = WRs[game][difficulty];
        
        if (difficulty == "Easy" || difficulty == "Normal") {
            wr = wr["ReimuB"][0];
        } else if (difficulty == "Hard") {
            wr = wr["MarisaB"][0];
        } else if (difficulty == "Lunatic" || difficulty == "Extra") {
            wr = wr["MarisaA"][0];
        }
    } else if (game == "HSiFS") {
        wr = WRs[game][difficulty];
        
        if (difficulty == "Easy") {
            wr = wr["CirnoSummer"][0];
        } else if (difficulty == "Normal" || difficulty == "Lunatic") {
            wr = wr["AyaAutumn"][0];
        } else if (difficulty == "Hard") {
            wr = wr["MarisaAutumn"][0];
        } else if (difficulty == "Extra") {
            wr = wr["Cirno"][0];
        }
    } else {
        wr = WRs[game][difficulty][shottype][0];
    }
    
    return (score >= wr ? rubric.base : Math.round(rubric.base * Math.pow((score / wr), rubric.exp)));
}

function abbreviate(num) {
    var string = String(num), original = string, i = 0, rest;
    
    while (string.indexOf("000") != -1) {
        string = string.replace("000", "");
        i += 1;
    }
    
    if (original.length >= 10) {
        rest = string.substr(1, string.length).replace("00", "").replace("0", "");
    
        return string.charAt(0) + (rest === "" ? "" : "." + rest) + "b";
    } else {
        return string + "m";
    }
}

function generateRubrics() {
    var game, difficulty, rubric, shottype, thresholds, scene, i;
    
    for (game in SCORE_RUBRICS) {
        $(SCORING_TABLE).append("<tr>");
        $(SCORING_TABLE).append(game == "HRtP" ? "<th>Game</th><th>Max points</th><th>Exponent</th>" : "<th></th><td></td><td></td>");
        $(SCORING_TABLE).append("</tr>");
        
        for (difficulty in SCORE_RUBRICS[game]) {
            rubric = SCORE_RUBRICS[game][difficulty];
            $(SCORING_TABLE).append("<tr><th>" + game + " " + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.exp + "</td></tr>");
        }
    }
    
    for (game in SURV_RUBRICS) {
        if (isPhantasmagoria(game)) {
            $(PHANTASMAGORIA).append("<tr>");
            $(PHANTASMAGORIA).append(game == "PoDD" ? "<th>Game</th><th>Max points</th><th>Min points</th><th>No Bomb bonus</th>" : "<th></th><td></td><td></td><td></td>");
            $(PHANTASMAGORIA).append("</tr>");
        } else {
            $(SURV_TABLE).append("<tr>");
            $(SURV_TABLE).append(game == "SoEW" ? "<th>Game</th><th>Max points</th><th>Base</th><th>Lost life (n)</th>" +
            "<th>First bomb (n)</th><th>Further bombs (n)</th>" : "<th></th><td></td><td></td><td></td><td></td><td></td>");
            $(SURV_TABLE).append("</tr>");
        }
        
        for (difficulty in SURV_RUBRICS[game]) {
            rubric = SURV_RUBRICS[game][difficulty];
            
            if (difficulty == "multiplier" || difficulty == "seasonMultiplier") {
                $(SHOTTYPE_MULTIPLIERS).append("<tr>");
                $(SHOTTYPE_MULTIPLIERS).append(game == "SoEW" ? "<th>Shottype</th><th>Multiplier</th><" : "<th></th><td></td>");
                $(SHOTTYPE_MULTIPLIERS).append("</tr>");
                
                for (shottype in rubric) {
                    $(SHOTTYPE_MULTIPLIERS).append("<tr><th>" + game + " " + shottype.replace("Team", " Team") + "</th><td>" + rubric[shottype] + "</td></tr>");
                }
                
                continue;
            }
            
            if (isPhantasmagoria(game)) {
                $(PHANTASMAGORIA).append("<tr><th>" + game + " " + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.min +
                "</td><td>" + rubric.noBombBonus + "</td></tr>");
            } else {
                $(SURV_TABLE).append("<tr><th>" + game + " " + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.exp +
                "</td><td>" + rubric.miss + "</td><td>" + rubric.firstBomb + "</td><td>" + rubric.bomb + "</td></tr>");
            }
        }
    }
    
    for (scene in SCENE_THRESHOLDS) {
        thresholds = SCENE_THRESHOLDS[scene];
        $(DS_TABLE).append("<tr><td>" + scene + "</td><td>" + sep(thresholds[1]) + "</td><td>" + sep(thresholds[2]) + "</td><td>" + sep(thresholds[3]) + "</td></tr>");
    }
    
    $(MOF_TABLE).append("<tr><td colspan='12'>If score < 2b, then: ||200 * (Score/2b)^2||</td></tr>");
            
    for (difficulty in MOF_THRESHOLDS) {
        $(MOF_TABLE).append("<tr><th colspan='12'>" + difficulty + "</th></tr>");
        
        for (shottype in MOF_THRESHOLDS[difficulty]) {
            $(MOF_TABLE).append("<tr><th colspan='3'>" + shottype + "</th></tr>");
            $(MOF_TABLE).append("<tr><th>Threshold</th><th>Base points</th><th>Increments</th></tr>");
            thresholds = MOF_THRESHOLDS[difficulty][shottype];
            
            for (i = 0; i < thresholds.base.length; i++) {
                $(MOF_TABLE).append("<tr><td>" + abbreviate(thresholds.score[i]) + "</td><td>" + thresholds.base[i] + "</td><td>+" + thresholds.increment[i] + " for every " + abbreviate(thresholds.step[i]) + "</td></tr>");
            }
        }
    }
}

function showRubrics() {
    $(RUBRICS).css("display", "block");
    $(RUBRICS_BUTTON).attr("onClick", "javascript:hideRubrics()");
    $(RUBRICS_BUTTON).val("Hide Rubrics");
}

function hideRubrics() {
    $(RUBRICS).css("display", "none");
    $(RUBRICS_BUTTON).attr("onClick", "javascript:showRubrics()");
    $(RUBRICS_BUTTON).val("Show Rubrics");
}