var WRs, playerWRs, compareWRs, westScores, skips = [], all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS"],
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
    
    for (var difficulty in WRs[game]) {
        $("#" + game + difficulty).css("display", "table-row");
        $("#cat_" + game + difficulty).css("display", "table-row");
    }
    
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
    
    for (var difficulty in WRs[game]) {
        $("#" + game + difficulty).css("display", "none");
        $("#cat_" + game + difficulty).css("display", "none");
    }
    
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

function percentageClass(percentage) {
    if (percentage < 50) {
        return "does_not_even_score";
    } else if (percentage < 75) {
        return "barely_even_scores";
    } else if (percentage < 90) {
        return "moderately_even_scores";
    } else if (percentage < 100) {
        return "does_even_score";
    } else {
        return "does_even_score_well"
    }
}

function load() {
    $.get("../json/wrlist.json", function (data) {
        WRs = data;
        playerWRs = {};
        compareWRs = {};
        
        var skip = {}, game, max, difficulty, bestshotmax, shottypes, shottype, wr, score, player, replay, overall, overallplayer,
        overalldifficulty, overallshottype, overallseason, bestshot, bestshotplayer, bestshotseason, text, count;
        
        for (game in WRs) {
            if (!$("#" + game + "c").is(":checked") || skips.contains(game)) {
                skips.pushStrict(game);
                hide(game);
                continue;
            }
            
            max = 0;
            compareWRs[game] = {};
            
            for (difficulty in WRs[game]) {
                bestshotmax = 0;
                shottypes = (game == "HSiFS" ? {"Reimu": "", "Cirno": "", "Aya": "", "Marisa": ""} : WRs[game][difficulty]);
                
                for (shottype in shottypes) {
                    season = (game == "HSiFS" ? bestSeason(difficulty, shottype) : "");
                    wr = WRs[game][difficulty][shottype + season];
                    score = wr[0];
                    player = wr[1];
                    replay = wr[2];
                    
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
                    
                    text = (replay === "" ? sep(score) : "<a class='replay' href='" + replay + "'>" + sep(score) + "</a>") + "<br>by <em>" + player + "</em>";
                    score > 0 ? $("#" + game + difficulty + shottype).html(text + (game == "HSiFS" && difficulty != "Extra" ? " (" + season + ")" : "")) : $("#" + game + difficulty + shottype).html('-');
                }
                
                $(bestshot).html((replay === "" ? "<u>" + sep(bestshotmax) + "</u>" : "<u><a class='replay' href='" + replay + "'>" + sep(bestshotmax) + "</a>") + "</u><br>by <em>" + bestshotplayer +
                "</em>" + (game == "HSiFS" && difficulty != "Extra" ? " (" + bestshotseason + ")" : ""));
                compareWRs[game][difficulty] = [bestshotmax, bestshotplayer, bestshot.replace("#" + game + difficulty, "") + (game == "HSiFS" && difficulty != "Extra" ? bestshotseason : "")];
            }
            
            $(overall).html($(overall).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
            $("#" + game + "overall0").html(sep(max));
            $("#" + game + "overall1").html(overallplayer);
            $("#" + game + "overall2").html(overalldifficulty);
            $("#" + game + "overall3").html(overallshottype);
        }
        
        $("#ranking_tbody").html("");
        $("#west_tbody").html("");
        
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
        
        // west scores
        var west, world, percentage;
        
        $.get("../json/bestinthewest.json", function (data) {
            westScores = data;
            
            for (game in westScores) {
                if (skips.contains(game)) {
                    continue;
                }
                
                $("#west_tbody").append("<tr><td colspan='3'><u>" + game + "</u></td></tr>");
                
                for (difficulty in westScores[game]) {
                    if (westScores[game][difficulty].length === 0) {
                        $("#" + game + difficulty).append("<td>-</td><th>-</th>");
                        continue;
                    }
                    
                    west = westScores[game][difficulty][0];
                    westPlayer = westScores[game][difficulty][1];
                    westShottype = westScores[game][difficulty][2];
                    world = compareWRs[game][difficulty][0];
                    worldPlayer = compareWRs[game][difficulty][1];
                    worldShottype = compareWRs[game][difficulty][2];
                    percentage = (west / world * 100).toFixed(2);
                    $("#west_tbody").append("<tr><td colspan='3'>" + difficulty + "</td></tr>");
                    $("#west_tbody").append("<tr><td>" + sep(world) + "<br>by <em>" + worldPlayer + "</em>" + (worldShottype != '-' ? "<br>(" + worldShottype + ")" : "") + "</td>" +
                    "<td>" + sep(west) + "<br>by <em>" + westPlayer + "</em>" + (westShottype != '-' ? "<br>(" + westShottype + ")" : "") +
                    "</td>" + "<th class='" + percentageClass(percentage) + "'>(" + (parseInt(percentage) == 100 ? 100 : percentage) + "%)</th></tr>");
                }
            }
            
        }, "json");
        
        if (!$("#overallc").is(":checked")) {
            hide("overall");
        }
        
        $("#autosort").click();
        $("#autosort").click();
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