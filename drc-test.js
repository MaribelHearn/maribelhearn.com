var WRs, global = this, phantasm = true, noExtra = true, noShottypes = true, language = "English", GAME = "#game", DIFFICULTY = "#difficulty", CHALLENGE = "#challenge", PHANTASMAGORIA = "#phantasmagoriaTable",
    RUBRICS = "#rubrics", BOMBS = "#bombs", SCORE = "#score", PERFORMANCE = "#performance", DRCPOINTS = "#drcpoints", ERROR = "#error", SHOTTYPE = "#shottype", NOTIFY = "#notify", RUBRICS_BUTTON = "#rubricsButton",
    NB = "#nb", NO_EXTRA = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>", MISSES = "#misses", IMP_NOT = "#impNot", IMP_NOT_TEXT = "#impNotText",
    DIFF_OPTIONS = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option>", SHOTTYPE_MULTIPLIERS = "#shottypeMultipliersTable", LS = "#ls",
    PHANTASM = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option><option>Phantasm</option>", SHOTTYPE_LABEL = "#shottypeLabel",IS = "#is", 
    MISSES_INPUT = "<label id='missesLabel' for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100>", ERROR_TEXT = "<b style='color:red'>Error: ", CLEARED = "#cleared", SCENE = "#scene",
    SCORE_OPTIONS = "<label id='scoreLabel' for='score'>Score</label><input id='score' type='text'>", SCORING_TABLE = "#scoringTable", SURV_TABLE = "#survivalTable", ROUTE = "#route", DS_TABLE = "#dsTable",
    MOF_TABLE = "#mofTable", RELEASES = "#releases", SEASON = "#season", SPRING = "#spring", SUMMER = "#summer", AUTUMN = "#autumn", WINTER = "#winter", HRTP = "#hrtp", SOEW = "#soew", PODD = "#podd",
    LLS = "#lls", MS = "#ms", EOSD = "#eosd", PCB = "#pcb", IN = "#in", POFV = "#pofv", MOF = "#mof", SA = "#sa", UFO = "#ufo", GFW = "#gfw", TD = "#td", DDC = "#ddc", LOLK = "#lolk", HSIFS = "#hsifs",
    MISSES_LABEL = "#missesLabel", BOMBS_LABEL = "#bombsLabel", NB_LABEL = "#nbLabel", DIFFICULTY_LABEL = "#difficultyLabel", RELEASES_LABEL = "#releasesLabel", SURVIVAL = "#survival", SCORING = "#scoring",
    IS_LABEL = "#isLabel", LS_LABEL = "#lsLabel", SCORE_LABEL = "#scoreLabel", FINALA = "#finala", FINALB = "#finalb", SCORING_COLUMN = "<th id='game0'>Game</th><th id='maxPoints0'>Max points</th><th id='exp0'>Exponent</th>",
    SURV_COLUMN = "<th id='game2'>Game</th><th id='maxPoints1'>Max points</th><th id='base0'>Base</th><th id='lostLife'>Lost life (n)</th><th id='firstBomb'>First bomb (n)</th><th id='further'>Further bombs (n)</th>",
    FIRST_BOMB = "#firstBomb", FURTHER = "#further", LOST_LIFE = "#lostLife", MOFAITH = "#mountainOfFaith", POFV_SURV = "#phantasmagoria", SHOT_MULT = "#shottypeMultipliers", BASE_POINTS = "#basePoints",
    MULTIPLIEDSHOTTYPE = "#multipliedShottype", MULTIPLIER = "#multiplier", MAX_POINTS = "#maxPoints", BASE = "#base", EXP = "#exp", WR = "#wr", SCORE_TEXT = "#scoreText", MIN_POINTS = "#minPoints", NB_BONUS = "#nbBonus",
    POINTS_CALCULATOR = "#pointsCalculator", RUBRICS_TEXT = "#rubricsText", LANGUAGE_TEXT = "#languageText", DRC_INTRO = "#drcIntro", CATEGORY = "#category", BACK_TO_TOP = "#backToTop", DRC_INTRO_PTS = "#drcIntroPts",
    DRC_SCORES = "#drcScores", RUBRICS_EXPL = "#rubricsExpl", SCORING_NOTES = "#scoringNotes", SURV_NOTES = "#survivalNotes", NEW_WR = "#newWR", MOF_SEPARATE = "#mofSeparate", MAINGAME = "#maingame",
    PHANTASMAGORIA_SEPARATE = "#phantasmagoriaSeparate", THRESHOLD = "#threshold", INCREMENTS = "#increments", IN_LS = "#inLS", HSIFS_RELEASES = "#hsifsReleases", CALCULATE = "#calculate", MAX_LIVES = "#maxLives",
    SURV_FORMULA = "#survFormula", SCORE_FORMULA = "#scoreFormula", POFV_FORMULA = "#pofvFormula", RUBRICS_TABLES = "#rubricsTables",
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
                "Aya": 0.8,
                "Medicine": 0.8,
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
                "exp": 2.5
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
        generateText(true);
        checkValues(true, true, true);
        generateRubrics();
    }, "json");
});

function japaneseCharNames(charName) {
    return ({
        "Makai": "魔界",
        "Jigoku": "地獄",
        "ReimuA": "霊夢A",
        "ReimuB": "霊夢B",
        "ReimuC": "霊夢C",
        "Reimu": "霊夢",
        "Mima": "魅魔",
        "Marisa": "魔理沙",
        "Ellen": "エレン",
        "Kotohime": "小兎姫",
        "Kana": "カナ",
        "Rikako": "理香子",
        "Chiyuri": "ちゆり",
        "Yumemi": "夢美",
        "Yuuka": "幽香",
        "MarisaA": "魔理沙A",
        "MarisaB": "魔理沙B",
        "SakuyaA": "咲夜A",
        "SakuyaB": "咲夜B",
        "BorderTeam": "霊夢＆紫",
        "MagicTeam": "魔理沙＆アリス",
        "ScarletTeam": "咲夜＆レミリア",
        "GhostTeam": "妖夢＆幽々子",
        "Yukari": "紫",
        "Alice": "アリス",
        "Sakuya": "咲夜",
        "Remilia": "レミリア",
        "Youmu": "妖夢",
        "Yuyuko": "幽々子",
        "Reisen": "鈴仙",
        "Cirno": "チルノ",
        "Lyrica": "リリカ",
        "Mystia": "ミスティア",
        "Tewi": "てゐ",
        "Aya": "文",
        "Medicine": "メディスン",
        "Komachi": "小町",
        "Eiki": "映姫",
        "MarisaC": "魔理沙C",
        "SanaeA": "早苗A",
        "SanaeB": "早苗B",
        "A1": "A1",
        "A2": "A2",
        "B1": "B1",
        "B2": "B2",
        "C1": "C1",
        "C2": "B2",
        "Sanae": "早苗",
        "Spring": "春",
        "Summer": "夏",
        "Autumn": "秋",
        "Winter": "冬"
    }[charName]);
}

function japaneseGameName(game) {
    return ({
        "HRtP": "靈",
        "SoEW": "封",
        "PoDD": "夢",
        "LLS": "幻",
        "MS": "怪",
        "EoSD": "紅",
        "PCB": "妖",
        "IN": "永",
        "PoFV": "花",
        "MoF": "風",
        "SA": "地",
        "UFO": "星",
        "GFW": "大",
        "TD": "神",
        "DDC": "輝",
        "LoLK": "紺",
        "HSiFS": "天"
    }[game]);
}

function generateText(firstTime) {
    var numberOfShottypes = $(SHOTTYPE + " option").length, i;
    
    if (language == "English") {
        $(HRTP).html("HRtP");
        $(SOEW).html("SoEW");
        $(PODD).html("PoDD");
        $(LLS).html("LLS");
        $(MS).html("MS");
        $(EOSD).html("EoSD");
        $(PCB).html("PCB");
        $(IN).html("IN");
        $(POFV).html("PoFV");
        $(MOF).html("MoF");
        $(SA).html("SA");
        $(UFO).html("UFO");
        $(GFW).html("GFW");
        $(TD).html("TD");
        $(DDC).html("DDC");
        $(LOLK).html("LoLK");
        $(HSIFS).html("HSiFS");
        $(SPRING).html("Spring");
        $(SUMMER).html("Summer");
        $(AUTUMN).html("Autumn");
        $(WINTER).html("Winter");
        $(CATEGORY).html("Category");
        $(DIFFICULTY_LABEL).html("Difficulty");
        $(FINALA).html("FinalA");
        $(FINALB).html("FinalB");
        $(SCORE_LABEL).html("Score");
        $(SHOTTYPE_LABEL).html("Shottype");
        $(MISSES_LABEL).html("Misses");
        $(BOMBS_LABEL).html("Bombs");
        $(POINTS_CALCULATOR).html("Points Calculator");
        $(RUBRICS_TEXT).html("Rubrics");
        $(LANGUAGE_TEXT).html("Language");
        $(BACK_TO_TOP).html("Back to Top");
        game = $(GAME).val();
        
        if (game) {
            if (game == "PCB") {
                $(BOMBS_LABEL).html("Bombs / Border Breaks");
            } else if (game == "TD") {
                $(BOMBS_LABEL).html("Bombs / Trances");
            } else if (game == "HRtP" || game == "GFW") {
                $(SHOTTYPE_LABEL).html("Route");
            }
        }
        
        for (i = 0; i < 2; i++) {
            $(SURVIVAL + i).html("Survival");
            $(SCORING + i).html("Scoring");
        }
        
        $(NB_LABEL).html("No Bomb");
        $(IS_LABEL).html("Imperishable Shooting Captured");
        $(LS_LABEL).html("Last Spells Captured");
        $(RELEASES_LABEL).html("Releases");
        $(DRCPOINTS).html($(DRCPOINTS).html().replace("DRCポイント", "Your DRC points for this run"));
        $(RUBRICS_BUTTON).val($(RUBRICS_BUTTON).val().replace("ルーブリックを見せて", "Show Rubrics").replace("ルーブリックを見せない", "Hide Rubrics"));
        $(CALCULATE).val("Calculate");
        $(SCORING_NOTES).html("Survival Notes");
        $(SURV_NOTES).html("Scoring Notes");
        $(NEW_WR).html("If you achieve a new World Record, your points are equal to the max points; otherwise, the formula applies.");
        $(MOF_SEPARATE).html("MoF uses a separate system. <a href='#mountainOfFaith'>Click here</a> for said system.");
        $(MAINGAME).html("For a main game clear, a shottype multiplier is applied to your DRC points, the result of which is again rounded. Click <a href='#shottypeMultipliers'>here</a> for the list of them.");
        $(PHANTASMAGORIA_SEPARATE).html("The Phantasmagorias use a separate system. <a href='#phantasmagoria'>Click here</a> for said system.");
        $(IN_LS).html("For IN, you obtain 2 (1 on Easy) additional points for each captured Last Spell, with the exception of Imperishable Shooting, which yields 5 points.");
        $(HSIFS_RELEASES).html("For HSiFS, the first release adds 2 to <em>n</em> (3 on Lunatic), and further releases add 0.5 to <em>n</em>.");
        $(POFV_SURV).html("PoDD & PoFV Survival");
        $(MOFAITH).html("MoF Scoring");
        $(SHOT_MULT).html("Shottype Multipliers");
        $(SCORE_FORMULA).html("||Max * (Score / WR) ^ Exp||");
        $(SURV_FORMULA).html("||Max * (Base ^ -n)||");
        $(POFV_FORMULA).html("||Max - ((Max - Min) / MaxLives * RoundsLost)|| + NoBombBonus");
        
        for (i = 0; i < numberOfShottypes; i++) {
            $(SHOTTYPE + i).html($(SHOTTYPE + i).val().replace("Team", " Team"));
        }
        
        if (!firstTime) {
            $(IMP_NOT).html("Important Notice:");
            $(IMP_NOT_TEXT + "0").html("usage of the MarisaB damage bug is BANNED in survival.");
            $(IMP_NOT_TEXT + "1").html("<em>manual</em> trances count as bombs (that is, trances from pressing C).");
            $(IMP_NOT_TEXT + "2").html("border breaks count as bombs <em>even if they are accidental</em>.");
            generateRubrics();
        }
        
        $(DRC_INTRO).html("The <b>Dodging Rain Competition (DRC)</b> is a Touhou game competition that was invented by ZM and is held on " +
        "<a href='http://eientei.boards.net/thread/829/official-dodging-rain-competition-thread'>Eientei Forums</a>. " +
        "Two teams go up against each other in several different categories. Each player posts an arbitrarily long list of categories, ordered by preference, " +
        "which can be either survival or scoring of any Touhou shooting game and any difficulty. They will be matched up against a player from the other team, in a category that both players had on their list. " +
        "The teams and categories are determined by the DRC management team. Players are given two weeks to sign up for the competition, and once it starts, two weeks to submit a replay, " +
        "which will be awarded points dependent on the rubrics. Runs done outside those two weeks are invalid.");
        $(DRC_INTRO_PTS).html("If you want to know how many DRC points a run is worth, the points for a given run can be determined using the calculator below.");
        $(DRC_SCORES).html("Scores can only contain digits, commas, dots and spaces. Survival runs are assumed to have cleared, scoring runs not.");
        $(RUBRICS_EXPL).html("The rubrics are the formulas and fixed values used to calculate the number of DRC points for a run. " +
        "If you are curious about how your points are being determined, click the button below to expand.");
    } else {
        $(HRTP).html(japaneseGameName("HRtP"));
        $(SOEW).html(japaneseGameName("SoEW"));
        $(PODD).html(japaneseGameName("PoDD"));
        $(LLS).html(japaneseGameName("LLS"));
        $(MS).html(japaneseGameName("MS"));
        $(EOSD).html(japaneseGameName("EoSD"));
        $(PCB).html(japaneseGameName("PCB"));
        $(IN).html(japaneseGameName("IN"));
        $(POFV).html(japaneseGameName("PoFV"));
        $(MOF).html(japaneseGameName("MoF"));
        $(SA).html(japaneseGameName("SA"));
        $(UFO).html(japaneseGameName("UFO"));
        $(GFW).html(japaneseGameName("GFW"));
        $(TD).html(japaneseGameName("TD"));
        $(DDC).html(japaneseGameName("DDC"));
        $(LOLK).html(japaneseGameName("LoLK"));
        $(HSIFS).html(japaneseGameName("HSiFS"));
        $(SPRING).html(japaneseCharNames("Spring"));
        $(SUMMER).html(japaneseCharNames("Summer"));
        $(AUTUMN).html(japaneseCharNames("Autumn"));
        $(WINTER).html(japaneseCharNames("Winter"));
        $(CATEGORY).html("カテゴリー");
        $(DIFFICULTY_LABEL).html("難易");
        $(FINALA).html("Aルート");
        $(FINALB).html("Bルート");
        $(SCORE_LABEL).html("スコア");
        $(SHOTTYPE_LABEL).html("キャラ");
        $(MISSES_LABEL).html("ミス");
        $(BOMBS_LABEL).html("ボム");
        $(POINTS_CALCULATOR).html("ポイントのカルキュレーター");
        $(RUBRICS_TEXT).html("ルーブリック");
        $(LANGUAGE_TEXT).html("言語");
        $(BACK_TO_TOP).html("上に帰る");
        game = $(GAME).val();
        
        if (game) {
            if (game == "PCB") {
                $(BOMBS_LABEL).html("ボム / 霊撃");
            } else if (game == "TD") {
                $(BOMBS_LABEL).html("ボム / トランス");
            } else if (game == "HRtP" || game == "GFW") {
                $(SHOTTYPE_LABEL).html("ルート");
            }
        }
        
        for (i = 0; i < 2; i++) {
            $(SURVIVAL + i).html("サバイバル");
            $(SCORING + i).html("稼ぎ");
        }
        
        $(NB_LABEL).html("ノーボム");
        $(IS_LABEL).html("「インペリシャブルシューティング」取得");
        $(LS_LABEL).html("最後のスペカ取得");
        $(RELEASES_LABEL).html("解放");
        $(DRCPOINTS).html($(DRCPOINTS).html().replace("Your DRC points for this run", "DRCポイント"));
        $(RUBRICS_BUTTON).val($(RUBRICS_BUTTON).val().replace("Show Rubrics", "ルーブリックを見せて").replace("Hide Rubrics", "ルーブリックを見せない"));
        $(CALCULATE).val("計算する");
        $(SCORING_NOTES).html("稼ぎのノート");
        $(SURV_NOTES).html("サバイバルのノート");
        $(NEW_WR).html("新しい世界記録が起こすと、あのプレイヤーは最大点をもらいます。");
        $(MOF_SEPARATE).html("東方風神録が別のシステムを使います。 <a href='#mountainOfFaith'>ここをクリック</a>そのシステムのために。");
        $(MAINGAME).html("ENHLクリアから、DRCポイントでキャラの倍率が適用されて、切り上げます。 リストを見せたいと<a href='#shottypeMultipliers'>ここをクリック</a>する。");
        $(PHANTASMAGORIA_SEPARATE).html("夢時空や花映塚も別のシステムを使う。 <a href='#phantasmagoria'>ここをクリック</a>そのシステムのために。");
        $(IN_LS).html("東方永夜抄にはそれぞれの最後のスペカは2点を与える。 Easy最後のスペカは1点を与える。 「インペリシャブルシューティング」取得をことは5点を与える。");
        $(HSIFS_RELEASES).html("For HSiFS, the first release adds 2 to <em>n</em> (3 on Lunatic), and further releases add 0.5 to <em>n</em>.");
        $(POFV_SURV).html("東方夢時空のサバイバル&花映塚のサバイバル");
        $(MOFAITH).html("東方風神録の稼ぎ");
        $(SHOT_MULT).html("キャラの倍率");
        $(SCORE_FORMULA).html("||最大点 * (スコア / 世界記録) ^ 冪指数||");
        $(SURV_FORMULA).html("||最大点 * (底 ^ -n)||");
        $(POFV_FORMULA).html("||最大点 - ((最大点 - 最小点) / 最大残機 * 試合失った)|| + ノーボムボーナス");
        
        for (i = 0; i < numberOfShottypes; i++) {
            $(SHOTTYPE + i).html(japaneseCharNames($(SHOTTYPE + i).val()));
        }
        
        generateRubrics();
        $(IMP_NOT).html("重要通知:");
        $(IMP_NOT_TEXT + "0").html("魔理沙Bのバグを使ってはいけまでん。");
        $(IMP_NOT_TEXT + "1").html("<em>manual</em> trances count as bombs (that is, trances from pressing C).");
        $(IMP_NOT_TEXT + "2").html("border breaks count as bombs <em>even if they are accidental</em>.");
        $(LOST_LIFE).html("ミス (n)");
        $(FIRST_BOMB).html("第一ボム (n)");
        $(FURTHER).html("ボム (n)");
        $(MULTIPLIEDSHOTTYPE).html("キャラ");
        $(MULTIPLIER).html("倍率");
        $(WR).html("世界記録");
        $(SCORE_TEXT).html("スコア");
        $(MIN_POINTS).html("最小点");
        $(NB_BONUS).html("ノーボムボーナス");
        
        for (i = 0; i < 2; i++) {
            $(BASE + i).html("底");
        }
        
        for (i = 0; i < 2; i++) {
            $(EXP + i).html("冪指数");
        }
        
        for (i = 0; i < 3; i++) {
            $(GAME + i).html("ゲーム");
        }
        
        for (i = 0; i < 2; i++) {
            $(BASE_POINTS + i).html("素点");
        }
        
        for (i = 0; i < 5; i++) {
            $(MAX_POINTS + i).html("最大点");
        }
        
        for (i = 0; i < 2; i++) {
            $(THRESHOLD + i).html("閾値");
        }
        
        for (i = 0; i < 2; i++) {
            $(INCREMENTS + i).html("増加");
        }
        
        $(DRC_INTRO).html("<b>Dodging Rain Competition(DRC)</b>はZMさんから作った<a href='http://eientei.boards.net/thread/829/official-dodging-rain-competition-thread'>Eientei Forums</a>で起こす東方Projectの定期大会です。 " +
        "大会のために二つのチームは幾すかのカテゴリーで競争します。 各の競技者が欲しかった稼ぎやサバイバルのカテゴリーの優先順位からリストを作ります。 リストを使いて、プレイヤー達が同じのカテゴリーにペアになります。DRCの経営陣がカテゴリーやチームを選びます。 申し込み期間は二週間です。そして、次の二週間は大会が起きています。 " +
        "この二週間で、競技者はリプレイを出して下さい。 大会が終わった後で、リプレイを出すはいけません。");
        $(DRC_INTRO_PTS).html("リプレイは幾つDRCポイントが稼ぐが知りたいなら、下のカルキュレーターを使ったもいいです。");
        $(DRC_SCORES).html("スコアは桁、カンマ、ドット、スペースを含めることができる。 サバイバルからクリアをしなければいけません。 稼ぎからクリアをしなくてもいいです。");
        $(RUBRICS_EXPL).html("ルーブリックは実行のDRCポイントの数を計算するために使用される式および固定値です。 ポイントの決定方法が不明な場合は、下のボタンをクリックして展開して下さい。");
    }
}

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
        var notifyText = (language == "English" ? "<b id='impNot'>Important Notice:</b> " : "<b id='impNot'>重要通知:</b> "), text;
        
        if (game == "MoF" && shottype == "MarisaB") {
            if (language == "English") {
                text = "<span id='impNotText0'>usage of the MarisaB damage bug is BANNED in survival.</span>";
            } else {
                text = "<span id='impNotText0'>魔理沙Bのバグを使ってはいけまでん。</span>";
            }
            
            $(NOTIFY).html(notifyText + text);
        } else if (game == "TD") {
            if (language == "English") {
                text = "<span id='impNotText1'><em>manual</em> trances count as bombs (that is, trances from pressing C).</span>";
            } else {
                text = "<span id='impNotText1'>Cキー押下による手動トランスはボムとして扱います。</span>";
            }
            
            $(NOTIFY).html(notifyText + text);
        } else if (game == "PCB") {
            if (language == "English") {
                text = "<span id='impNotText2'>border breaks count as bombs <em>even if they are accidental</em>.</span>";
            } else {
                text = "<span id='impNotText2'>霊撃は偶発的なものであってもボムとして扱います。</span>";
            }
            
            $(NOTIFY).html(notifyText + text);
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
                survOptions += "<br><label id='nbLabel' for='nb'>No Bomb</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace("Misses</label>", "Rounds lost</label>").replace("max=100", "max=5");
            } else if (game == "PoFV") {
                survOptions += "<br><label for='nb'>No Charge Attacks</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace("Misses</label>", "Rounds lost</label>").replace("max=100", "max=8");
            } else {
                if (game == "PCB") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>Bombs / Border Breaks</label><input id='bombs' type='number' value=0 min=0 max=100>";
                    survOptions += "<br><label id='nbLabel' for='nb'>No Bomb</label><input id='nb' type='checkbox'>";
                } else if (game == "TD") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>Bombs / Trances</label><input id='bombs' type='number' value=0 min=0 max=100>";
                } else {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>Bombs</label><input id='bombs' type='number' value=0 min=0 max=100>";
                }
                
                if (game == "IN") {
                    difficulty = $(DIFFICULTY).val();
                    
                    if (difficulty == "Extra") {
                        survOptions += "<br><label id='isLabel' for='is'>Imperishable Shooting Captured</label><input id='is' type='checkbox'>";
                    } else {
                        survOptions += "<br><label id='lsLabel' for='ls'>Last Spells Captured</label><input id='ls' type='number' value=0 min=0 max=10>";
                        $(ROUTE).css("display", "inline");
                    }
                }
                
                if (game == "HSiFS") {
                    survOptions += "<br><label id='releasesLabel' for='releases'>Releases</label><input id='releases' type='number' value=0 min=0 max=1000>";
                }
            }
            
            $(PERFORMANCE).html(survOptions);
        } else {
            $(PERFORMANCE).html(game == "DS" ? "<label for='scene'>Scene</label><select id='scene'><option>2-2</option><option>5-4</option><option>5-5</option><option>7-6</option>" +
            "<option>10-1</option><option>10-2</option><option>12-2</option><option>12-8</option><option>EX-6</option><option>EX-9</option></select><br>" + SCORE_OPTIONS : SCORE_OPTIONS);
            $(NOTIFY).html("");
        }
            
        if (language == "Japanese") {
            generateText(false);
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
        shottype = shottypes[i].replace("Team", " Team");
        shottypeList += "<option id='shottype" + i + "' value='" + shottypes[i] + "'>" + (language == "English" ? shottype : japaneseCharNames(shottypes[i])) + "</option>";
    }
    
    if (alwaysChange) {
        $(SHOTTYPE).html(shottypeList);
    }
    
    if (game == "HRtP" || game == "GFW") {
        $(SHOTTYPE_LABEL).html(language == "English" ? "Route" : "ルート");
    } else {
        $(SHOTTYPE_LABEL).html(language == "English" ? "Shottype" : "キャラ");
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
            $(DRCPOINTS).html((language == "English" ? "Your DRC points for this run" : "DRCポイント") + ": <b>0</b>!");
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
            $(DRCPOINTS).html((language == "English" ? "Your DRC points for this run" : "DRCポイント") + ": <b>0</b>!");
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
    
    $(DRCPOINTS).html((language == "English" ? "Your DRC points for this run" : "DRCポイント") + ": <b>" + points + "</b>!");
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
    
    if (bombs >= 1 && !(game == "PCB" && $(NB).is(":checked"))) {
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
        $(ERROR).html(ERROR_TEXT + (language == "English" ? "invalid score.</b>" : "無効のスコア。</b>"));
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

function abbreviateJapanese(num) {
     var string = String(num), original = string, i = 0, rest;
    
    while (string.indexOf("0000") != -1) {
        string = string.replace("0000", "");
        i += 1;
    }
    
    if (original.length >= 10) {
        rest = string.substr(2, string.length).replace("000", "").replace("00", "");
    
        return string.substr(0, 2) + (rest === "" ? "" : "." + rest) + "億";
    } else {
        return string + "万";
    }
}

function generateRubrics() {
    var id = 0, game, difficulty, rubric, shottype, thresholds, scene, i;
    $(DS_TABLE).html("");
    $(MOF_TABLE).html("");
    $(SURV_TABLE).html("");
    $(SCORING_TABLE).html("");
    $(PHANTASMAGORIA).html("");
    $(SHOTTYPE_MULTIPLIERS).html("");
    
    // detect smartphone
	if (navigator.userAgent.contains("Mobile")) {
        $(RUBRICS_TABLES).html("<table class='center'>" +
        "<thead><tr><td colspan='3'><b id='scoring1'>" + (language == "English" ? "Scoring" : "稼ぎ") +
        "</b><br><span id='scoreFormula'>" + (language == "English" ? "||Max * (Score/WR)^Exp||" : "||最大点 * (スコア / 世界記録) ^ 冪指数||") + "</span></td></tr></thead>" +
        "<tbody id='scoringTable'></tbody>" +
        "</table>" +
        "<table class='center'>" +
        "<thead><tr><td colspan='6'><b id='survival1'>" + (language == "English" ? "Survival" : "サバイバル") +
        "</b><br><span id='survFormula'>" + (language == "English" ? "||Max * (Base^-n)||" : "||最大点 * (底 ^ -n)||" ) + "</span></td></tr></thead>" +
        "<tbody id='survivalTable'></tbody>" +
        "</table>");
	} else {
        $(RUBRICS_TABLES).html("<table id='noborders'>" +
        "<tr class='noborders'>" +
        "<td class='noborders'>" +
        "<table>" +
        "<thead><tr><td colspan='3'><b id='scoring1'>" + (language == "English" ? "Scoring" : "稼ぎ") +
        "</b><br><span id='scoreFormula'>" + (language == "English" ? "||Max * (Score/WR)^Exp||" : "||最大点 * (スコア / 世界記録) ^ 冪指数||") + "</span></td></tr></thead>" +
        "<tbody id='scoringTable'></tbody>" +
        "</table>" +
        "</td>" +
        "<td class='noborders' style='float:left'>" +
        "<table>" +
        "<thead><tr><td colspan='6'><b id='survival1'>" + (language == "English" ? "Survival" : "サバイバル") +
        "</b><br><span id='survFormula'>" + (language == "English" ? "||Max * (Base^-n)||" : "||最大点 * (底 ^ -n)||" ) + "</span></td></tr></thead>" +
        "<tbody id='survivalTable'></tbody>" +
        "</table>" +
        "</td>" +
        "</tr>" +
        "</table>");
    }
    
    for (game in SCORE_RUBRICS) {
        $(SCORING_TABLE).append("<tr>");
        $(SCORING_TABLE).append(game == "HRtP" ? SCORING_COLUMN : "<th></th><td></td><td></td>");
        $(SCORING_TABLE).append("</tr>");
        
        for (difficulty in SCORE_RUBRICS[game]) {
            rubric = SCORE_RUBRICS[game][difficulty];
            $(SCORING_TABLE).append("<tr><th>" + (language == "English" ? game + " " : japaneseGameName(game)) + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.exp + "</td></tr>");
        }
    }
    
    for (game in SURV_RUBRICS) {
        if (isPhantasmagoria(game)) {
            $(PHANTASMAGORIA).append("<tr>");
            $(PHANTASMAGORIA).append(game == "PoDD" ? "<th id='game1'>Game</th><th id='maxPoints2'>Max points</th><th id='minPoints'>Min points</th><th id='nbBonus'>No Bomb bonus</th>" : "<th></th><td></td><td></td><td></td>");
            $(PHANTASMAGORIA).append("</tr>");
        } else {
            $(SURV_TABLE).append("<tr>");
            $(SURV_TABLE).append(game == "SoEW" ? SURV_COLUMN : "<th></th><td></td><td></td><td></td><td></td><td></td>");
            $(SURV_TABLE).append("</tr>");
        }
        
        for (difficulty in SURV_RUBRICS[game]) {
            rubric = SURV_RUBRICS[game][difficulty];
            
            if (difficulty == "multiplier" || difficulty == "seasonMultiplier") {
                $(SHOTTYPE_MULTIPLIERS).append("<tr>");
                $(SHOTTYPE_MULTIPLIERS).append(game == "SoEW" ? "<th id='multipliedShottype'>Shottype</th><th id='multiplier'>Multiplier</th><" : "<th></th><td></td>");
                $(SHOTTYPE_MULTIPLIERS).append("</tr>");
                
                for (shottype in rubric) {
                    $(SHOTTYPE_MULTIPLIERS).append("<tr><th>" + (language == "English" ? game : japaneseGameName(game)) +
                    " " + (language == "English" ? shottype.replace("Team", " Team") : japaneseCharNames(shottype)) + "</th><td>" + rubric[shottype] + "</td></tr>");
                }
                
                continue;
            }
            
            if (isPhantasmagoria(game)) {
                $(PHANTASMAGORIA).append("<tr><th>" + (language == "English" ? game + " " : japaneseGameName(game)) + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.min +
                "</td><td>" + rubric.noBombBonus + "</td></tr>");
            } else {
                $(SURV_TABLE).append("<tr><th>" + (language == "English" ? game + " " : japaneseGameName(game)) + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.exp +
                "</td><td>" + rubric.miss + "</td><td>" + rubric.firstBomb + "</td><td>" + rubric.bomb + "</td></tr>");
            }
        }
    }
    
    for (scene in SCENE_THRESHOLDS) {
        thresholds = SCENE_THRESHOLDS[scene];
        $(DS_TABLE).append("<tr><td>" + scene + "</td><td>" + sep(thresholds[1]) + "</td><td>" + sep(thresholds[2]) + "</td><td>" + sep(thresholds[3]) + "</td></tr>");
    }
    
    $(MOF_TABLE).append("<tr><td colspan='12'>" + (language == "English" ? "If score < 2b, then: ||200*(Score/2b)^2||" : "スコアが20億よりも小さければ、||200*(スコア/20億)^2||") + "</td></tr>");
            
    for (difficulty in MOF_THRESHOLDS) {
        $(MOF_TABLE).append("<tr><th colspan='12'>" + difficulty + "</th></tr>");
        
        for (shottype in MOF_THRESHOLDS[difficulty]) {
            $(MOF_TABLE).append("<tr><th colspan='3'>" + (language == "English" ? shottype : japaneseCharNames(shottype)) + "</th></tr>");
            $(MOF_TABLE).append("<tr><th id='threshold" + id + "'>Threshold</th><th id='basePoints" + id + "'>Base points</th><th id='increments" + id + "'>Increments</th></tr>");
            thresholds = MOF_THRESHOLDS[difficulty][shottype];
            id += 1;
            
            for (i = 0; i < thresholds.base.length; i++) {
                if (language == "English") {
                    $(MOF_TABLE).append("<tr><td>" + abbreviate(thresholds.score[i]) + "</td><td>" + thresholds.base[i] +
                    "</td><td>+" + thresholds.increment[i] + " for every " + abbreviate(thresholds.step[i]) + "</td></tr>");
                } else {
                    $(MOF_TABLE).append("<tr><td>" + abbreviateJapanese(thresholds.score[i]) + "</td><td>" + thresholds.base[i] +
                    "</td><td>" + abbreviateJapanese(thresholds.step[i]) + "ごとに+" + thresholds.increment[i] + "を</td></tr>");
                }
            }
        }
    }
}

function showRubrics() {
    $(RUBRICS).css("display", "block");
    $(RUBRICS_BUTTON).attr("onClick", "javascript:hideRubrics()");
    $(RUBRICS_BUTTON).val(language == "English" ? "Hide Rubrics" : "ルーブリックを見せない");
}

function hideRubrics() {
    $(RUBRICS).css("display", "none");
    $(RUBRICS_BUTTON).attr("onClick", "javascript:showRubrics()");
    $(RUBRICS_BUTTON).val(language == "English" ? "Show Rubrics" : "ルーブリックを見せて");
}

function setLanguage(newLanguage) {
    if (language == newLanguage) {
        return;
    }
    
    language = newLanguage;
    generateText(false);
}