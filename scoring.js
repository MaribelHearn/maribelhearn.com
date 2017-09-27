var NUMBER_OF_GAMES = 16;

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