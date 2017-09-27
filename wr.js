var all = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS"],
    tracked = ["EoSD", "PCB", "IN", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS"],
    untracked = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "PoFV"],
    WRs;

function bestSeason(difficulty, shottype) {
    var shottypes = WRs.HSiFS[difficulty], max = 0, season, i;
    
    for (i in shottypes) {
        if (!i.contains(shottype)) {
            continue;
        }
        
        if (shottypes[i][0] > max) {
            season = i.replace(shottype, "");
            max = shottypes[i][0];
        }
    }
    
    return season;
}

$(document).ready(function() {
    var game, max, difficulty, bestshotmax, shottypes, shottype, wr, overall, overallplayer, overallseason, bestshot, bestshotplayer, bestshotseason, text;
    
    $.get("wrlist.json", function(data) {
        WRs = data;
    }, "json");
    
    for (game in WRs) {
        max = 0;
        
        for (difficulty in WRs[game]) {
            bestshotmax = 0;
            shottypes = (game == "HSiFS" ? {"Reimu": "", "Cirno": "", "Aya": "", "Marisa": ""} : WRs[game][difficulty]);
            
            for (shottype in shottypes) {
                season = (game == "HSiFS" ? bestSeason(difficulty, shottype) : "");
                wr = WRs[game][difficulty][shottype + season];
                
                if (wr[0] > max) {
                    overall = "#" + game + difficulty + shottype;
                    overallplayer = wr[1];
                    overallseason = season;
                    max = wr[0];
                }
                
                if (wr[0] > bestshotmax) {
                    bestshot = "#" + game + difficulty + shottype;
                    bestshotplayer = wr[1];
                    bestshotseason = season;
                    bestshotmax = wr[0];
                }
                
                text = sep(wr[0]) + "<br>by <em>" + wr[1] + "</em>";
                wr[0] > 0 ? $("#" + game + difficulty + shottype).html(text + (game == "HSiFS" && difficulty != "Extra" ? " (" + season + ")" : "")) : $("#" + game + difficulty + shottype).html('-');
            }
            
            $(bestshot).html("<u>" + sep(bestshotmax) + "</u><br>by <em>" + bestshotplayer + "</em>" + (game == "HSiFS" && difficulty != "Extra" ? " (" + bestshotseason + ")" : ""));
        }
        
        $(overall).html($(overall).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
        
        if (!$("#" + game + "c").is(":checked")) {
            hide(game);
        }
    }
});

function show(game) {
    $("#" + game).css("display", "block");
    
    if (!$("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", true);
    }
}

function hide(game) {
    $("#" + game).css("display", "none");
    
    if ($("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", false);
    }
}

function checkGame(arg) {
    if ($("#" + arg + "c").is(":checked")) {
        show(arg);
    } else {
        hide(arg);
    }
}

function checkTracked() {
    var checked = $("#tracked").is(":checked");
    
    for (var key in tracked) {
        checked ? show(tracked[key]) : hide(tracked[key]);
    }
}

function checkUntracked() {
    var checked = $("#untracked").is(":checked");
    
    for (var key in untracked) {
        checked ? show(untracked[key]) : hide(untracked[key]);
    }
}

function checkAll() {
    var checked = $("#all").is(":checked");
    
    if (checked) {
        $("#tracked").prop("checked", true);
        $("#untracked").prop("checked", true);
    } else {
        $("#tracked").prop("checked", false);
        $("#untracked").prop("checked", false);
    }
    
    for (var key in all) {
        checked ? show(all[key]) : hide(all[key]);
    }
}