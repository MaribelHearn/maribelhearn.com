var WRs, playerWRs, westScores, skips = [], all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS"],
    tracked = ["EoSD", "PCB", "IN", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS"], untracked = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "PoFV"];

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

function show(game, skip) {
    $("#" + game).css("display", "block");
    $("#" + game + "o").css("display", "table-row");
    
    if (!$("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", true);
    }
    
    if (skip && skips.contains(game)) {
        skips.remove(game);
        load();
    }
}

function hide(game, skip) {
    $("#" + game).css("display", "none");
    $("#" + game + "o").css("display", "none");
    
    if ($("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", false);
    }
    
    if (skip && !skips.contains(game)) {
        skips.pushStrict(game);
        load();
    }
}

function checkGame(arg) {
    if ($("#" + arg + "c").is(":checked")) {
        show(arg, true);
    } else {
        hide(arg, true);
    }
}

function checkTracked() {
    var checked = $("#tracked").is(":checked");
    
    for (var key in tracked) {
        if (checked) {
            show(tracked[key], false);
            skips.remove(tracked[key]);
        } else {
            hide(tracked[key], false);
            skips.pushStrict(tracked[key]);
        }
    }
    
    load();
}

function checkUntracked() {
    var checked = $("#untracked").is(":checked");
    
    for (var key in untracked) {
        if (checked) {
            show(untracked[key], false);
            skips.remove(untracked[key]);
        } else {
            hide(untracked[key], false);
            skips.pushStrict(untracked[key]);
        }
    }
    
    load();
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
        if (checked) {
            show(all[key], false);
            skips.remove(all[key]);
        } else {
            hide(all[key], false);
            skips.pushStrict(all[key]);
        }
    }
    
    load();
}

function load() {
    $.get("../json/wrlist.json", function(data) {
        WRs = data;
        playerWRs = {};
        
        var skip = {}, game, max, difficulty, bestshotmax, shottypes, shottype, wr, score, player, overall, overallplayer,
        overalldifficulty, overallshottype, overallseason, bestshot, bestshotplayer, bestshotseason, text, count, percentage;
        
        for (game in WRs) {
            if (!$("#" + game + "c").is(":checked") || skips.contains(game)) {
                skips.pushStrict(game);
                hide(game);
                continue;
            }
            
            max = 0;
            
            for (difficulty in WRs[game]) {
                bestshotmax = 0;
                shottypes = (game == "HSiFS" ? {"Reimu": "", "Cirno": "", "Aya": "", "Marisa": ""} : WRs[game][difficulty]);
                
                for (shottype in shottypes) {
                    season = (game == "HSiFS" ? bestSeason(difficulty, shottype) : "");
                    wr = WRs[game][difficulty][shottype + season];
                    score = wr[0];
                    player = wr[1];
                    
                    if (score > max) {
                        overall = "#" + game + difficulty + shottype;
                        overallplayer = player;
                        overalldifficulty = difficulty;
                        overallshottype = shottype;
                        overallseason = season;
                        max = score;
                    }
                    
                    if (score > bestshotmax) {
                        bestshot = "#" + game + difficulty + shottype;
                        bestshotplayer = player;
                        bestshotseason = season;
                        bestshotmax = score;
                    }
                    
                    if (player !== "") {
                        if (!playerWRs.hasOwnProperty(player)) {
                            playerWRs[player] = {};
                        }
                            
                        if (!playerWRs[player].hasOwnProperty(game)) {
                            playerWRs[player][game] = 0;
                        }
                        
                        playerWRs[player][game] += 1;
                    }
                    
                    text = sep(score) + "<br>by <em>" + player + "</em>";
                    score > 0 ? $("#" + game + difficulty + shottype).html(text + (game == "HSiFS" && difficulty != "Extra" ? " (" + season + ")" : "")) : $("#" + game + difficulty + shottype).html('-');
                }
                
                $(bestshot).html("<u>" + sep(bestshotmax) + "</u><br>by <em>" + bestshotplayer + "</em>" + (game == "HSiFS" && difficulty != "Extra" ? " (" + bestshotseason + ")" : ""));
                $("#west_tbody").append("<tr><td colspan='3'>" + game + " " + difficulty + "</td></tr>");
                $("#west_tbody").append("<tr id='#" + game + difficulty + "'><td><span id='wr_" + game + difficulty + "'>" + sep(bestshotmax) + "</span><br>by <em>" + bestshotplayer +
                "</em><br>(" + bestshot.replace("#" + game + difficulty, "") + (game == "HSiFS" && difficulty != "Extra" ? bestshotseason : "") + ")</td></tr>");
            }
            
            $(overall).html($(overall).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
            $("#" + game + "overall0").html(sep(max));
            $("#" + game + "overall1").html(overallplayer);
            $("#" + game + "overall2").html(overalldifficulty);
            $("#" + game + "overall3").html(overallshottype);
        }
        
        $("#ranking_tbody").html("");
        
        for (player in playerWRs) {
            count = 0;
            
            for (game in playerWRs[player]) {
                if (skips.contains(game)) {
                    if (!skip.hasOwnProperty(player)) {
                        skip[player] = 0;
                    }
                    
                    skip[player] += 1;
                    continue;
                }
                
                count += playerWRs[player][game];
            }
            
            $("#ranking_tbody").append("<tr id='player_" + player + "'><td>" + player + "</td><td id='player_" + player + "n'>" + count +
            "</td><td id='player_" + player + "g'>" + Object.keys(playerWRs[player]).length + "</td></tr>");
        }
        
        if (!$("#overallc").is(":checked")) {
            hide("overall");
        }
        
        $("#autosort").click();
        $("#autosort").click();
        $.get("../json/bestinthewest.json", function (data) {
            westScores = data;
            
            for (game in westScores) {
                for (difficulty in westScores[game]) {
                    percentage = (westScores[game][difficulty][0] / Number($("#wr_" + game + difficulty).html().replace(',', ""))).toFixed(2);
                    $("#" + game + difficulty).append("<td>" + sep(westScores[game][difficulty][0]) +
                    "<br>by <em>" + westScores[game][difficulty][1] + "</em><br>(" + westScores[game][difficulty][2] + ")</td>" +
                    "<th>(" + percentage + ")</th>");
                }
            }
        }, "json");
    }, "json");
}

$(document).ready(function() {
    // detect smartphone and tablet
    if (navigator.userAgent.contains("Mobile") || navigator.userAgent.contains("Tablet")) {
        $("#notice").css("display", "block");
        $("#back").css("display", "block");
	}
    
	load();
});