$.get("wrlist.json", function(data) {
    WRs = data;
}, "json");

var NUMBER_OF_GAMES = 16s;

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
                score = $(id + "Score").val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "");
                
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
    $("#table").attr("align", "center");
    $("#gameTable").attr("align", "center");
    sorttable.makeSortable(document.getElementById("table"));
    sorttable.makeSortable(document.getElementById("gameTable"));
};