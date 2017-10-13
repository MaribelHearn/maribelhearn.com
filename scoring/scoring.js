var WRs, NUMBER_OF_GAMES = 16, scores = {
  "HRtP": {
    "Easy": {
      "Makai": 0,
      "Jigoku": 0
    },
    "Normal": {
      "Makai": 0,
      "Jigoku": 0
    },
    "Hard": {
      "Makai": 0,
      "Jigoku": 0
    },
    "Lunatic": {
      "Makai": 0,
      "Jigoku": 0
    }
  },
  "SoEW": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0
    }
  },
  "PoDD": {
    "Easy": {
      "Reimu": 0,
      "Mima": 0,
      "Marisa": 0,
      "Ellen": 0,
      "Kotohime": 0,
      "Kana": 0,
      "Rikako": 0,
      "Chiyuri": 0,
      "Yumemi": 0
    },
    "Normal": {
      "Reimu": 0,
      "Mima": 0,
      "Marisa": 0,
      "Ellen": 0,
      "Kotohime": 0,
      "Kana": 0,
      "Rikako": 0,
      "Chiyuri": 0,
      "Yumemi": 0
    },
    "Hard": {
      "Reimu": 0,
      "Mima": 0,
      "Marisa": 0,
      "Ellen": 0,
      "Kotohime": 0,
      "Kana": 0,
      "Rikako": 0,
      "Chiyuri": 0,
      "Yumemi": 0
    },
    "Lunatic": {
      "Reimu": 0,
      "Mima": 0,
      "Marisa": 0,
      "Ellen": 0,
      "Kotohime": 0,
      "Kana": 0,
      "Rikako": 0,
      "Chiyuri": 0,
      "Yumemi": 0
    }
  },
  "LLS": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    }
  },
  "MS": {
    "Easy": {
      "Reimu": 0,
      "Marisa": 0,
      "Mima": 0,
      "Yuuka": 0
    },
    "Normal": {
      "Reimu": 0,
      "Marisa": 0,
      "Mima": 0,
      "Yuuka": 0
    },
    "Hard": {
      "Reimu": 0,
      "Marisa": 0,
      "Mima": 0,
      "Yuuka": 0
    },
    "Lunatic": {
      "Reimu": 0,
      "Marisa": 0,
      "Mima": 0,
      "Yuuka": 0
    },
    "Extra": {
      "Reimu": 0,
      "Marisa": 0,
      "Mima": 0,
      "Yuuka": 0
    }
  },
  "EoSD": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0
    }
  },
  "PCB": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Phantasm": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    }
  },
  "IN": {
    "Easy": {
      "BorderTeam": 0,
      "MagicTeam": 0,
      "ScarletTeam": 0,
      "GhostTeam": 0,
      "Reimu": 0,
      "Yukari": 0,
      "Marisa": 0,
      "Alice": 0,
      "Sakuya": 0,
      "Remilia": 0,
      "Youmu": 0,
      "Yuyuko": 0
    },
    "Normal": {
      "BorderTeam": 0,
      "MagicTeam": 0,
      "ScarletTeam": 0,
      "GhostTeam": 0,
      "Reimu": 0,
      "Yukari": 0,
      "Marisa": 0,
      "Alice": 0,
      "Sakuya": 0,
      "Remilia": 0,
      "Youmu": 0,
      "Yuyuko": 0
    },
    "Hard": {
      "BorderTeam": 0,
      "MagicTeam": 0,
      "ScarletTeam": 0,
      "GhostTeam": 0,
      "Reimu": 0,
      "Yukari": 0,
      "Marisa": 0,
      "Alice": 0,
      "Sakuya": 0,
      "Remilia": 0,
      "Youmu": 0,
      "Yuyuko": 0
    },
    "Lunatic": {
      "BorderTeam": 0,
      "MagicTeam": 0,
      "ScarletTeam": 0,
      "GhostTeam": 0,
      "Reimu": 0,
      "Yukari": 0,
      "Marisa": 0,
      "Alice": 0,
      "Sakuya": 0,
      "Remilia": 0,
      "Youmu": 0,
      "Yuyuko": 0
    },
    "Extra": {
      "BorderTeam": 0,
      "MagicTeam": 0,
      "ScarletTeam": 0,
      "GhostTeam": 0,
      "Reimu": 0,
      "Yukari": 0,
      "Marisa": 0,
      "Alice": 0,
      "Sakuya": 0,
      "Remilia": 0,
      "Youmu": 0,
      "Yuyuko": 0
    }
  },
  "PoFV": {
    "Easy": {
      "Reimu": 0,
      "Marisa": 0,
      "Sakuya": 0,
      "Youmu": 0,
      "Reisen": 0,
      "Cirno": 0,
      "Lyrica": 0,
      "Mystia": 0,
      "Tewi": 0,
      "Aya": 0,
      "Medicine": 0,
      "Yuuka": 0,
      "Komachi": 0,
      "Eiki": 0
    },
    "Normal": {
      "Reimu": 0,
      "Marisa": 0,
      "Sakuya": 0,
      "Youmu": 0,
      "Reisen": 0,
      "Cirno": 0,
      "Lyrica": 0,
      "Mystia": 0,
      "Tewi": 0,
      "Aya": 0,
      "Medicine": 0,
      "Yuuka": 0,
      "Komachi": 0,
      "Eiki": 0
    },
    "Hard": {
      "Reimu": 0,
      "Marisa": 0,
      "Sakuya": 0,
      "Youmu": 0,
      "Reisen": 0,
      "Cirno": 0,
      "Lyrica": 0,
      "Mystia": 0,
      "Tewi": 0,
      "Aya": 0,
      "Medicine": 0,
      "Yuuka": 0,
      "Komachi": 0,
      "Eiki": 0
    },
    "Lunatic": {
      "Reimu": 0,
      "Marisa": 0,
      "Sakuya": 0,
      "Youmu": 0,
      "Reisen": 0,
      "Cirno": 0,
      "Lyrica": 0,
      "Mystia": 0,
      "Tewi": 0,
      "Aya": 0,
      "Medicine": 0,
      "Yuuka": 0,
      "Komachi": 0,
      "Eiki": 0
    },
    "Extra": {
      "Reimu": 0,
      "Marisa": 0,
      "Sakuya": 0,
      "Youmu": 0,
      "Reisen": 0,
      "Cirno": 0,
      "Lyrica": 0,
      "Mystia": 0,
      "Tewi": 0,
      "Aya": 0,
      "Medicine": 0,
      "Yuuka": 0,
      "Komachi": 0,
      "Eiki": 0
    }
  },
  "MoF": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    }
  },
  "SA": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "ReimuC": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "MarisaC": 0
    }
  },
  "UFO": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SanaeA": 0,
      "SanaeB": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SanaeA": 0,
      "SanaeB": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SanaeA": 0,
      "SanaeB": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SanaeA": 0,
      "SanaeB": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SanaeA": 0,
      "SanaeB": 0
    }
  },
  "GFW": {
    "Easy": {
      "A1": 0,
      "A2": 0,
      "B1": 0,
      "B2": 0,
      "C1": 0,
      "C2": 0
    },
    "Normal": {
      "A1": 0,
      "A2": 0,
      "B1": 0,
      "B2": 0,
      "C1": 0,
      "C2": 0
    },
    "Hard": {
      "A1": 0,
      "A2": 0,
      "B1": 0,
      "B2": 0,
      "C1": 0,
      "C2": 0
    },
    "Lunatic": {
      "A1": 0,
      "A2": 0,
      "B1": 0,
      "B2": 0,
      "C1": 0,
      "C2": 0
    },
    "Extra": {
      "-": 0
    }
  },
  "TD": {
    "Easy": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Youmu": 0
    },
    "Normal": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Youmu": 0
    },
    "Hard": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Youmu": 0
    },
    "Lunatic": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Youmu": 0
    },
    "Extra": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Youmu": 0
    }
  },
  "DDC": {
    "Easy": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Normal": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Hard": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Lunatic": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    },
    "Extra": {
      "ReimuA": 0,
      "ReimuB": 0,
      "MarisaA": 0,
      "MarisaB": 0,
      "SakuyaA": 0,
      "SakuyaB": 0
    }
  },
  "LoLK": {
    "Easy": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Reisen": 0
    },
    "Normal": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Reisen": 0
    },
    "Hard": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Reisen": 0
    },
    "Lunatic": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Reisen": 0
    },
    "Extra": {
      "Reimu": 0,
      "Marisa": 0,
      "Sanae": 0,
      "Reisen": 0
    }
  },
  "HSiFS": {
    "Easy": {
      "ReimuSpring": 0,
      "ReimuSummer": 0,
      "ReimuAutumn": 0,
      "ReimuWinter": 0,
      "CirnoSpring": 0,
      "CirnoSummer": 0,
      "CirnoAutumn": 0,
      "CirnoWinter": 0,
      "AyaSpring": 0,
      "AyaSummer": 0,
      "AyaAutumn": 0,
      "AyaWinter": 0,
      "MarisaSpring": 0,
      "MarisaSummer": 0,
      "MarisaAutumn": 0,
      "MarisaWinter": 0
    },
    "Normal": {
      "ReimuSpring": 0,
      "ReimuSummer": 0,
      "ReimuAutumn": 0,
      "ReimuWinter": 0,
      "CirnoSpring": 0,
      "CirnoSummer": 0,
      "CirnoAutumn": 0,
      "CirnoWinter": 0,
      "AyaSpring": 0,
      "AyaSummer": 0,
      "AyaAutumn": 0,
      "AyaWinter": 0,
      "MarisaSpring": 0,
      "MarisaSummer": 0,
      "MarisaAutumn": 0,
      "MarisaWinter": 0
    },
    "Hard": {
      "ReimuSpring": 0,
      "ReimuSummer": 0,
      "ReimuAutumn": 0,
      "ReimuWinter": 0,
      "CirnoSpring": 0,
      "CirnoSummer": 0,
      "CirnoAutumn": 0,
      "CirnoWinter": 0,
      "AyaSpring": 0,
      "AyaSummer": 0,
      "AyaAutumn": 0,
      "AyaWinter": 0,
      "MarisaSpring": 0,
      "MarisaSummer": 0,
      "MarisaAutumn": 0,
      "MarisaWinter": 0
    },
    "Lunatic": {
      "ReimuSpring": 0,
      "ReimuSummer": 0,
      "ReimuAutumn": 0,
      "CirnoSpring": 0,
      "CirnoSummer": 0,
      "CirnoAutumn": 0,
      "CirnoWinter": 0,
      "AyaSpring": 0,
      "AyaSummer": 0,
      "AyaAutumn": 0,
      "AyaWinter": 0,
      "MarisaSpring": 0,
      "MarisaSummer": 0,
      "MarisaAutumn": 0,
      "MarisaWinter": 0
    },
    "Extra": {
      "Reimu": 0,
      "Cirno": 0,
      "Aya": 0,
      "Marisa": 0
    }
  }
};

var calc = function () {
    var top = {}, averages = {}, total = 0, categories = 0, highest = 0,
        game, difficulty, id, span, score, shottype, wr, percentage, average, key, i, table, gameTable, temp,
        topList = "<table id='table'><thead><tr><th>Game + Difficulty</th><th>Shottype / Route</th><th class='sorttable_numeric'>Score</th><th>WR Percentage</th><th>Progress Bar</th><th>WR</th></tr></thead><tbody>",
        precision = parseInt($("#precision").val());
        
    if (isNaN(precision) || precision < 0 || precision > 5) {
        $("#error").html("<b style='color:red'>Invalid precision; minimum is 0, maximum is 5.</b>");
        return;
    } else {
        $("#error").html("");
    }
    
    for (game in WRs) {
        total = 0;
        categories = 0;
        
        for (difficulty in WRs[game]) {
            for (shottype in WRs[game][difficulty]) {
                id = "#" + game + difficulty + shottype;
                score = $(id).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "");
                
                if (score === "") {
                    $("#error").html("");
                    continue;
                }
                
                if (isNaN(score)) {
                    $("#error").html("<b style='color:red'>You entered one or more invalid scores. Please use only digits, dots, commas and spaces.</b>");
                    return;
                }
                
                score = parseInt(score);
                wr = WRs[game][difficulty][shottype];
                scores[game][difficulty][shottype] = score;
                
                if (score == wr[0]) {
                    hack = true;
                    score -= 1;
                }
                
                percentage = (wr[0] === 0 ? 100 : score / wr[0] * 100);
                
                if (percentage > highest) {
                    highest = percentage;
                }
                
                percentage = (precision === 0 ? Math.round(percentage) : Number(percentage).toFixed(precision));
                topList += "<tr><td>" + game + " " + difficulty + "</td><td>" + shottype.replace("Team", " Team") + "</td><td>" + sep(score) + "</td><td>" + percentage +
                "%</td><td><progress value='" + percentage + "' max='100'></progress></td><td>" + sep(wr[0]) + " by <i>" + wr[1] + "</i>";
                
                total += Number(percentage);
                categories++;
            }
        }
        
        if (categories > 0) {
            average = total / categories;
            averages[game] = (precision === 0 ? Math.round(average) : Number(average).toFixed(precision));
        }
    }
    
    topList += "</tbody></table><br><table id='gameTable'><thead><tr><th>Game</th><th>Average Percentage</th></tr></thead><tbody>";
    
    for (game in averages) {
        topList += "<tr><td>" + game + "</td><td>" + averages[game] + "%</td></tr>";
    }
    
    topList += "</tbody></table>";
    
    if (highest === 0) {
        $("#error").html("<b style='color:red'>You have no significant scores! Try to score some more!</b>");
        $("#topList").html("");
        return;
    }
    
    $("#topList").html(topList);
    sorttable.makeSortable(document.getElementById("table"));
    sorttable.makeSortable(document.getElementById("gameTable"));
    setCookie("scores", scores);
};

$(document).ready(function() {
    var cookie = getCookie("scores");
    
    if (cookie) {
        scores = cookie;
    }
    
    for (var game in scores) {
        for (difficulty in scores[game]) {
            for (var shottype in scores[game][difficulty]) {
                if (scores[game][difficulty][shottype] !== 0) {
                    $("#" + game + difficulty + shottype).val(scores[game][difficulty][shottype]);
                }
            }
        }
    }
    
    // detect smartphone and tablet
    if (navigator.userAgent.contains("Mobile") || navigator.userAgent.contains("Tablet")) {
        $("#notice").css("display", "block");
	}
    
    $.get("../json/wrlist.json", function(data) {
        WRs = data;
    }, "json");
});