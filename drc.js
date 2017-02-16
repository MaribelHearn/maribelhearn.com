var global = this, phantasm = true, noExtra = true, GAME = "#game", DIFFICULTY = "#difficulty", CHALLENGE = "#challenge", MISSES = "#misses", SCORING = "#scoring", NB = "#nb",
    BOMBS = "#bombs", SCORE = "#score", PERFORMANCE = "#performance", DRCPOINTS = "#drcpoints", ERROR = "#error", SHOTTYPE = "#shottype", NOTIFY = "#notify",
    NO_EXTRA = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>", NOTIFY_TEXT = "<b>Important Notice:</b> ",
    DIFF_OPTIONS = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option>",
    PHANTASM = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option><option>Phantasm</option>",
    MISSES_INPUT = "<label for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100>", ERROR_TEXT = "<b style='color:red'>Error: ",
    SCORE_OPTIONS = "<label for='score'>Score</label><input id='score' type='text'>",
    SURV_RUBRICS = {
        "SoEW": {
            "Easy": {
                "base": 30,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
            },
            "Normal": {
                "base": 80,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 120,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 250,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 100,
                "exp": 1.1,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "bomb": 1,
            },
            "Normal": {
                "base": 90,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
            },
            "Hard": {
                "base": 140,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 280,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Extra": {
                "base": 90,
                "exp": 1.07,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "shots": {
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
                "bomb": 1,
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 300,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 100,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "bomb": 1,
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 320,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "multiplier": {
                "ReimuA": 1.1,
                "MarisaA": 1.05
            }
        },
        "PCB": {
            "Easy": {
                "base": 60,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 300,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Phantasm": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "base": 50,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 305,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 115,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "base": 50,
                "min": 10,
                "lives": 7
            },
            "Normal": {
                "base": 90,
                "min": 15,
                "lives": 7
            },
            "Hard": {
                "base": 130,
                "min": 20,
                "lives": 7
            },
            "Lunatic": {
                "base": 260,
                "min": 30,
                "lives": 7
            },
            "Extra": {
                "base": 110,
                "min": 15,
                "lives": 8
            },
            "multiplier": {
                "Reimu": 1.1,
                "Marisa": 1.1,
                "Sakuya": 1.1,
                "Youmu": 1.1,
                "Reisen": 1.15,
                "Cirno": 1.1,
                "Lyrica": 1.15,
                "Mystia": 1.1,
                "Tewi": 1.15,
                "Yuuka": 1.15,
                "Komachi": 1.1,
                "Eiki": 1.1
            }
        },
        "MoF": {
            "Easy": {
                "base": 60,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 300,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 105,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "multiplier": {
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
                "bomb": 1,
            },
            "Normal": {
                "base": 110,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 300,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "bomb": 1,
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 160,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 320,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 2,
                "bomb": 1,
            },
            "Normal": {
                "base": 90,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 130,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 260,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
            },
            "Extra": {
                "base": 130,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "bomb": 1,
            },
            "Normal": {
                "base": 90,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 140,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 280,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
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
                "bomb": 1,
            },
            "Normal": {
                "base": 100,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 150,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 300,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 110,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "multiplier": {
                "ReimuB": 1.05,
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
                "bomb": 1,
            },
            "Normal": {
                "base": 120,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "Hard": {
                "base": 160,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 4,
                "bomb": 1,
            },
            "Lunatic": {
                "base": 330,
                "exp": 1.05,
                "miss": 2,
                "firstBomb": 5,
                "bomb": 1,
            },
            "Extra": {
                "base": 130,
                "exp": 1.08,
                "miss": 2,
                "firstBomb": 3,
                "bomb": 1,
            },
            "multiplier": {
                "Marisa": 1.15,
                "Sanae": 1.05,
                "Reisen": 1.05
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
                "base": 275,
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
                "exp": 2.5
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
        }
    };

$(document).ready(function() {
    checkValues(true, true);
});

function checkValues(changePerformance, changeShottypes) {
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(), shottype = $(SHOTTYPE).val();
    
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
        
        if (challenge == "Survival") {
            var survOptions = MISSES_INPUT;
            
            if (game == "PoDD") {
                survOptions += "<br><label for='nb'>No Bomb</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace("Misses</label>", "Rounds lost</label>").replace("max=100", "max=5");
            } else if (game == "PoFV") {
                survOptions = survOptions.replace("Misses</label>", "Rounds lost</label>").replace("max=100", "max=8");
            } else {
                survOptions += "<br><label for='bombs'>Bombs</label><input id='bombs' type='number' value=0 min=0 max=100>";
            }
            
            $(PERFORMANCE).html(survOptions);
        } else {
            $(PERFORMANCE).html(SCORE_OPTIONS);
            $(NOTIFY).html("");
        }
    }
    
    if (changeShottypes) {
        checkShottypes();
    }
}

function checkShottypes() {
    var game = $(GAME).val(), challenge = $(CHALLENGE).val(), difficulty = $(DIFFICULTY).val(), shottypes = Object.keys(WRs[game][difficulty]), shottypeList = "";
    
    for (var i in shottypes) {
        var shottype = (shottypes[i].indexOf("Team") > -1 ? shottypes[i].replace("Team", " Team") : shottypes[i]);
        
        shottypeList += "<option value='" + shottypes[i] + "'>" + shottype + "</option>";
    }
    
    if (game == "GFW" && difficulty == "Extra") {
        $(SHOTTYPE).html("<option value='-'>-</option>");
    } else {
        $(SHOTTYPE).html(shottypeList);
    }
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
        points = (game == "PoDD" || game == "PoFV" ? phantasmagoria(rubric, game, shottypeMultiplier) : survivalPoints(rubric, difficulty, shottypeMultiplier));
    } else {
        rubric = (game != "MoF" ? SCORE_RUBRICS[game][difficulty] : undefined);
        points = scoringPoints(rubric, game, difficulty, shottype);
    }
    
    $(DRCPOINTS).html("Your DRC points for this run: <b>" + points + "</b>!");
}

function phantasmagoria(rubric, game, shottypeMultiplier) {
    var roundsLost = Number($(MISSES).val()), bonus = 0;
    
    if (roundsLost > rubric.lives) {
        $(ERROR).html(ERROR_TEXT + "the number of rounds lost cannot exceed " + rubric.lives + ".");
        return 0;
    } else {
        $(ERROR).html("");
    }
    
    if (game == "PoDD") {
        bonus = $(NB).is(":checked") ? rubric.noBombBonus : 0;
    }
    
    return Math.round(shottypeMultiplier * (rubric.base - ((rubric.base - rubric.min) / rubric.lives * roundsLost))) + bonus;
}

function survivalPoints(rubric, difficulty, shottypeMultiplier) {
    var misses = Number($(MISSES).val()), bombs = Number($(BOMBS).val()), n = 0, originalBombs;
    
    $(ERROR).html("");
    n += misses * rubric.miss;
    originalBombs = bombs;
    
    if (bombs >= 1) {
        n += rubric.firstBomb;
        bombs -= 1;
    }
    
    n += bombs * rubric.bomb;
    
    drcpoints = Math.round(rubric.base * Math.pow(rubric.exp, -n));
    
    if (difficulty != "Extra" && originalBombs === 0) {
        drcpoints = Math.round(drcpoints * shottypeMultiplier);
    }
    
    return drcpoints;
}

function mofFormula(score) {
    var originalScore = score, drcpoints = 15;
    
    if (score < 1500000000) {
        while (score >= 30000000) {
            score -= 30000000;
            drcpoints += 2;
        }
        
        return drcpoints;
    }
    
    score = originalScore - 1500000000;
    drcpoints = 115;
    
    if (originalScore < 2000000000) {
        while (score >= 50000000) {
            score -= 50000000;
            drcpoints += 10;
        }
        
        return drcpoints;
    }
    
    score = originalScore - 2000000000;
    drcpoints = 215;
    
    if (originalScore < 2050000000) {
        while (score >= 10000000) {
            score -= 10000000;
            drcpoints += 5;
        }
        
        return drcpoints;
    }
    
    score = originalScore - 2050000000;
    drcpoints = 240;
    
    if (originalScore < 2100000000) {
        while (score >= 10000000) {
            score -= 10000000;
            drcpoints += 10;
        }
        
        return drcpoints;
    }
    
    score = originalScore - 2100000000;
    drcpoints = 290;
    
    while (score >= 10000000) {
        score -= 10000000;
        drcpoints += 15;
    }
    
    return drcpoints;
}

function scoringPoints(rubric, game, difficulty, shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), wr;
    
    if (isNaN(score)) {
        $(ERROR).html(ERROR_TEXT + "invalid score.</b>");
        return 0;
    } else {
        $(ERROR).html("");
    }
    
    if (game == "MoF") {
        return mofFormula(score);
    } else if (game == "SoEW" && difficulty == "Hard") {
        wr = WRs[game][difficulty]["ReimuB"][0];
    } else if (game == "SoEW" && difficulty == "Lunatic") {
        wr = WRs[game][difficulty]["ReimuA"][0];
    } else if (game == "LLS") {
        wr = WRs[game][difficulty];
        
        if (difficulty == "Easy" || difficulty == "Normal") {
            wr = wr["ReimuB"][0];
        } else if (difficulty == "Hard") {
            wr = wr["ReimuA"][0];
        } else if (difficulty == "Lunatic" || difficulty == "Extra") {
            wr = wr["MarisaA"][0];
        }
    } else {
        wr = WRs[game][difficulty][shottype][0];
    }
    
    return (score >= wr ? rubric.base : Math.round(rubric.base * Math.pow((score / wr), rubric.exp)));
}