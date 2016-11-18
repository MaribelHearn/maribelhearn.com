var rand = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

var load = function () {
    var random = rand(1, 8);
    document.body.style.background = "url('./bg/" + random + ".png')";
};


var games = {
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
    "LoLK": ["Easy", "Normal", "Hard", "Lunatic", "Extra"]
};

var isTripleNGame = function (game) {
    return game == "PCB" || game == "UFO" || game == "TD";
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
    var results = "", game, i, difficulty, id, survival,
        survivals = {
            "Not cleared": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            },
            "Clear": {
                "Easy": 0,
                "Normal": 0,
                "Hard": 0,
                "Lunatic": 0,
                "Extra": 0
            },
            "1cc / EX Clear": {
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
            "NN(N)": {
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
            "LoLK": 0
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
            "LoLK": 0
        };
    
    for (game in games) {
        for (i in games[game]) {
            difficulty = games[game][i];
            id = game + difficulty;
            survival = document.getElementById(id).value;
            
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
            
            if (survival == "Clear") {
                difficulty == "Extra" ? survivals["1cc / EX Clear"][difficulty]++ : survivals["Clear"][difficulty]++;
            }
            
            if (survival == "1cc") {
                survivals["1cc / EX Clear"][difficulty]++;
            }
            
            if (survival == "NM") {
                survivals["NM"][difficulty]++;
            }
            
            if (survival == "NB") {
                survivals["NB"][difficulty]++;
            }
            
            if (survival == "NN") {
                isTripleNGame(game) ? survivals["NN*"][difficulty]++ : survivals["NN(N)"][difficulty]++;
            }
            
            if (survival == "NNN") {
                survivals["NN(N)"][difficulty]++;
            }
            
            completions[game] += 100 / games[game].length;
        }
    }
    
    results = "<table id='table' class='sortable'><thead><tr><th>Survival</th><th>Easy</th><th>Normal</th><th>Hard</th><th>Lunatic</th><th>Extra</th></tr></thead><tbody>";
    
    for (survival in survivals) {
        results += "<tr><td>" + survival + "</td><td>" + survivals[survival]["Easy"] + "</td><td>" + survivals[survival]["Normal"] +
        "</td><td>" + survivals[survival]["Hard"] + "</td><td>" + survivals[survival]["Lunatic"] + "</td><td>" + survivals[survival]["Extra"] + "</td></tr>";
    }
    
    results += "</tbody></table><br><p>* Any NN that was achieved in a game with a third N.</p><br>" +
    "<table id='gameTable' class='sortable'><thead><tr><th>Game</th><th>Completion</th></tr></thead><tbody>";
    
    for (game in games) {
        if (Math.round(na[game]) == 100) {
            continue;
        }
        
        results += "<tr><td>" + game + "</td><td>" + Math.round(completions[game]) + "%</td></tr>";
    }
    
    results += "</tbody></table>";
    
    document.getElementById("results").innerHTML = results;
    table = document.getElementById("table");
    gameTable = document.getElementById("gameTable");
    table.setAttribute("align", "center");
    gameTable.setAttribute("align", "center");
    sorttable.makeSortable(table);
    sorttable.makeSortable(gameTable);
};