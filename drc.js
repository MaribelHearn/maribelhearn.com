var global = this, phantasm = true, GAME = "#game", DIFFICULTY = "#difficulty", CHALLENGE = "#challenge", MISSES = "#misses", SCORING = "#scoring",
    BOMBS = "#bombs", SCORE = "#score", PERFORMANCE = "#performance", DRCPOINTS = "#drcpoints", ERROR = "#error", SHOTTYPE = "#shottype",
    DIFF_OPTIONS = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option>",
    SURV_OPTIONS = "<label for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100><br><label for='bombs'>Bombs</label><input id='bombs' type='number' value=0 min=0 max=100>",
    SCORE_OPTIONS = "<label for='score'>Score</label><input id='score' type='text'><br><label for='shottype'>Shottype / Route</label><select id='shottype'></select>",
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
            }
        }
    },
    SCORE_RUBRICS = {
        "EoSD": {
            "Lunatic": {
                "base": 0,
                "exp": 0
            }
        }
    };

$(document).ready(function() {
    checkGame($(GAME).val());
    checkChallenge($(CHALLENGE).val());
});

function checkGame(game) {
    var challenge = $(CHALLENGE).val();
    
    if (game == "PCB") {
        $(DIFFICULTY).append("<option>Phantasm</option>");
        phantasm = true;
    } else if (phantasm) {
        $(DIFFICULTY).html(DIFF_OPTIONS);
        phantasm = false;
    }
    
    if (challenge == "Scoring") {
        checkShottypes();
    }
}

function checkChallenge(challenge) {
    if (challenge == "Survival") {
        $(PERFORMANCE).html(SURV_OPTIONS);
    } else {
        $(PERFORMANCE).html(SCORE_OPTIONS);
        checkShottypes();
    }
}

function checkShottypes() {
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), shottypes = Object.keys(WRs[game][difficulty]), shottypeList = "";
    
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
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(), rubric, points, shottype;
    
    if (challenge == "Survival") {
        rubric = SURV_RUBRICS[game][difficulty];
        points = survivalPoints(rubric);
    } else {
        rubric = undefined;
        // rubric = SCORE_RUBRICS[game][difficulty];
        shottype = $(SHOTTYPE).val();
        points = scoringPoints(rubric, game, difficulty, shottype);
    }
    
    $(DRCPOINTS).html("Your DRC points for this run: <b>" + points + "</b>!");
}

function survivalPoints(rubric) {
    var misses = Number($(MISSES).val()), bombs = Number($(BOMBS).val()), n = 0;
    
    $(ERROR).html("");
    
    n += misses * rubric.miss;
    
    if (bombs >= 1) {
        n += rubric.firstBomb;
        bombs -= 1;
    }
    
    n += bombs * rubric.bomb;
    
    return Math.round(rubric.base * Math.pow(rubric.exp, -n));
}

function scoringPoints(rubric, game, difficulty, shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), wr;
    
    if (isNaN(score)) {
        $(ERROR).html("<b style='color:red'>Invalid score.</b>");
    } else {
        $(ERROR).html("");
    }
    
    wr = WRs[game][difficulty][shottype][0];
    
    return 0;
    // return Math.round(rubric.base * Math.pow((score / wr), rubric.exp));
}