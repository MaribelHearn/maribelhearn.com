﻿var games = {
    "HRtP": ["Easy", "Normal", "Hard", "Lunatic"],
    "SoEW": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "PoDD": ["Easy", "Normal", "Hard", "Lunatic"],
    "LLS": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "MS": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "EoSD": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "PCB": ["Easy", "Normal", "Hard", "Lunatic", "Extra", "Phantasm"],
    "IN": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "PoFV": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "MoF": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "SA": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "UFO": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "GFW": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "TD": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "DDC": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "LoLK": ["Easy", "Normal", "Hard", "Lunatic", "Extra"],
    "HSiFS": ["Easy", "Normal", "Hard", "Lunatic", "Extra"]
};

var isTripleNGame = function (game) {
    return game == "PCB" || game == "UFO" || game == "TD" || game == "HSiFS";
};

var fillAll = function (value, achievement) {
    var value, i;
    
    if (games.hasOwnProperty(value)) {
        for (i in games[value]) {
            $("#" + value + games[value][i]).val(achievement);
        }
    } else {
        if (value == "Extra") {
            $("#PCBPhantasm").val(achievement);
        }
        
        for (game in games) {
            if (value == "Normal" || value == "Hard" || value == "Lunatic") {
                $("#" + game + "Easy").val(achievement);
                
                if (value == "Hard" || value == "Lunatic") {
                    $("#" + game + "Normal").val(achievement);
                    
                    if (value == "Lunatic") {
                        $("#" + game + "Hard").val(achievement);
                    }
                }
            }
            
            $("#" + game + value).val(achievement);
        }
    }
}

var format = function (achievement) {
    return ({
        "N/A": "",
        "Not cleared": "",
        "1cc": "clear",
        "NM": "nm",
        "NB": "nb",
        "NN": "nmnb",
        "NNN": "nmnb"
    })[achievement];
};

var apply = function () {
    var results = "", game, i, difficulty, id, survival,
        survivals = {
            "Not cleared": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            },
            "1cc": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            },
            "NM": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            },
            "NB": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            },
            "NN*": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            },
            "NN": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            }
        },
        na = {
            "HRtP": 0,
            "SoEW": 0,
            "PoDD": 0,
            "LLS": 0,
            "MS": 0,
            "EoSD": 0,
            "PCB": 0,
            "IN": 0,
            "PoFV": 0,
            "MoF": 0,
            "SA": 0,
            "UFO": 0,
            "GFW": 0,
            "TD": 0,
            "DDC": 0,
            "LoLK": 0,
            "HSiFS": 0
        }
        completions = {
            "HRtP": 0,
            "SoEW": 0,
            "PoDD": 0,
            "LLS": 0,
            "MS": 0,
            "EoSD": 0,
            "PCB": 0,
            "IN": 0,
            "PoFV": 0,
            "MoF": 0,
            "SA": 0,
            "UFO": 0,
            "GFW": 0,
            "TD": 0,
            "DDC": 0,
            "LoLK": 0,
            "HSiFS": 0
        };
    
    for (game in games) {
        for (i in games[game]) {
            difficulty = games[game][i];
            survival = $("#" + game + difficulty).val();
            
            if (survival == "N/A") {
                na[game] += 100 / games[game].length;
                continue;
            }
            
            if (difficulty == "Phantasm") {
                difficulty = "Extra";
            }
            
            if (survival == "Not cleared") {
                survivals["Not cleared"][difficulty]++;
                continue;
            }
            
            if (survival == "1cc") {
                survivals["1cc"][difficulty]++;
            }
            
            if (survival == "NM") {
                survivals["NM"][difficulty]++;
            }
            
            if (survival == "NB") {
                survivals["NB"][difficulty]++;
            }
            
            if (survival == "NN") {
                isTripleNGame(game) ? survivals["NN*"][difficulty]++ : survivals["NN"][difficulty]++;
            }
            
            if (survival == "NNN") {
                survivals["NN"][difficulty]++;
            }
            
            completions[game] += 100 / games[game].length;
        }
    }
    
    results = "<h2>Progress Table</h2><table id='overview'><thead><tr><th class='overview'>Game</th><th class='overview'>Easy</th><th class='overview'>Normal</th><th class='overview'>Hard</th>" +
    "<th class='overview'>Lunatic</th><th class='overview' colspan='2'>Extra</th></tr></thead><tbody>";
    
    for (game in games) {
        results += "<tr><th>" + game + "</th>";
        
        for (i in games[game]) {
            difficulty = games[game][i];
            results += "<td class='" + format($("#" + game + difficulty).val()) + "'" + (difficulty == "Extra" && game != "PCB" ? " colspan='2'" : "") + "></td>";
        }
            
        if (game == "HRtP" || game == "PoDD") {
            results += "<td colspan='2'>X</td>";
        }
        
        results += "</tr>";
        
        if (game == "MS") {
            results += "<tr><td></td><td></td><td></td><td></td><td></td><td colspan='2'></td></tr>";
        }
    }
    
    results += "</tbody></table><h2>Numbers of Achievements</h2><table id='table' class='sortable'><thead><tr><th>Survival</th><th>Easy</th><th>Normal</th><th>Hard</th><th>Lunatic</th><th>Extra</th></tr></thead><tbody>";
    
    for (survival in survivals) {
        results += "<tr><td>" + survival + "</td><td>" + survivals[survival]["Easy"] + "</td><td>" + survivals[survival]["Normal"] +
        "</td><td>" + survivals[survival]["Hard"] + "</td><td>" + survivals[survival]["Lunatic"] + "</td><td>" + survivals[survival]["Extra"] + "</td></tr>";
    }
    
    results += "</tbody></table><p>* Any NN that was achieved in a game with a third N.</p>" +
    "<h2>Clear Completions</h2><table id='gameTable' class='sortable'><thead><tr><th>Game</th><th>Clear Completion</th></tr></thead><tbody>";
    
    for (game in games) {
        if (Math.round(na[game]) == 100) {
            continue;
        }
        
        results += "<tr><td>" + game + "</td><td>" + Math.round(completions[game]) + "%</td></tr>";
    }
    
    results += "</tbody></table><br>";
    
    $("#results").html(results);
    $("#table").attr("align", "center");
    $("#gameTable").attr("align", "center");
    $("#overview").attr("align", "center");
    sorttable.makeSortable(table);
    sorttable.makeSortable(gameTable);
};

$(document).ready(function() {
    // detect smartphone and tablet
    if (navigator.userAgent.contains("Mobile") || navigator.userAgent.contains("Tablet")) {
        $("#notice").css("display", "block");
	}
});