var WRs, westScores, missingReplays, seasonsEnabled, datesEnabled,
    notation = "DMY", language = "English", selected = "", playerSelected = false, skips = [],
    all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN",
    "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC"],
    windows = ["EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"];

String.prototype.removeChar = function () {
    return this.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
};
String.prototype.removeSeason = function () {
    return this.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
};
function isPortrait() {
    return window.innerHeight > window.innerWidth && (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1);
}
function toggleSeasons() {
    seasonsEnabled = !seasonsEnabled;
    display({data: {game: "HSiFS", seasonSwitch: true}});
}
function toggleLayout() {
    if (getCookie("wr_old_layout")) {
        deleteCookie("wr_old_layout");
    } else {
        setCookie("wr_old_layout", true);
    }
}
function toggleDates(event) {
    var alreadyDisabled = event.data.alreadyDisabled, i;

    if (!alreadyDisabled) {
        datesEnabled = !datesEnabled;
    }

    for (i in all) {
        if (all[i] == "overall") {
            continue;
        }

        $("#" + all[i] + "overall4, #" + all[i] + "overallm").css("display", datesEnabled ? "table-cell" : "none");
    }

    $(".datestring_player").css("display", datesEnabled ? "inline" : "none");
    $(".date, .date_empty").css("display", datesEnabled ? "table-cell" : "none");
    $(".datestring, .datestring_game").css("display", datesEnabled ? "table-cell" : "none");
}
function disableDates() {
    toggleDates({data: {alreadyDisabled: true}});
}
function shotRoute(game) {
    return game == "HRtP" || game == "GFW" ? "Route" : "Shottype";
}
function replayPath(game, difficulty, shottype) {
    return "replays/th" + gameAbbr(game) + "_ud" + difficulty.substr(0, 2) + shottypeAbbr(shottype) + ".rpy";
}
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
        return "does_even_score_well";
    }
}
function display(event) {
    var game = event.data.game ? event.data.game : this.id, seasonSwitch = event.data.seasonSwitch;

    if (!WRs || !westScores) {
        $.get("json/wrlist.json", function (data1) {
            $.get("json/bestinthewest.json", function (data2) {
                WRs = data1;
                westScores = data2;
                display({data: {game: game, seasonSwitch: seasonSwitch}});
            }, "json");
        }, "json");
        return;
    }

    if (game == selected && !seasonSwitch) {
        $("#list").css("display", "none");
        $("#" + game).css("border", $("#" + game).hasClass("cover98")
            ? "1px solid black"
            : "none");
        $("#fullname, #list_thead, #list_tbody, #west_thead, #west_tbody").html("");
        $("#fullname").removeClass(game + "f");
        $("#table").removeClass(game + "t");
        selected = "";
        return;
    }

    var shottypes = [], compareWRs = {}, max = 0, difficulty, bestshotmax, shottype, wr, score, player, replay, overall,
        overallplayer, overalldifficulty, overallshottype, overallseason, overalldate, bestshot, bestshotplayer, bestshotseason,
        bestshotdate, text, count, seasonless, extrashots, west, world, percentage, sepScore, i;

    for (shottype in WRs[game]["Easy"]) {
        shottypes.pushStrict(seasonsEnabled ? shottype : shottype.removeSeason());
    }

    if (selected !== "") {
        $("#" + selected).css("border", $("#" + selected).hasClass("cover98") ? "1px solid black" : "none");
    }

    if ($("#fullname").hasClass(selected + "f")) {
        $("#fullname").removeClass(selected + "f");
    }

    if ($("#table").hasClass(selected + "t")) {
        $("#table").removeClass(selected + "t");
    }

    $("#" + game).css("border", "3px solid gold");
    selected = game;
    $("#fullname").addClass(game + "f");
    $("#fullname").html(fullNameNumber(game));
    $("#table").addClass(game + "t");
    $("#list_tbody").html("");

    if (isPortrait()) {
        for (difficulty in WRs[game]) {
            $("#list_tbody").append("<tr><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) + "</th><th class='" + difficulty + "'>" + difficulty + "</th></tr>");
            if (game != "GFW" || difficulty != "Extra") {
                for (i = 0; i < shottypes.length; i += 1) {
                    if (game == "HSiFS" && difficulty != "Extra" && seasonsEnabled) {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + difficulty + "'><td><span class='" + shottypes[i].removeSeason() + "'>" + shottypes[i].removeSeason() + "</span><span class='" + shottypes[i].removeChar() + "'>" + shottypes[i].removeChar() + "</span></td></tr>")
                    } else if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled && shottypes[i].removeChar() == "Spring") {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td class='" + shottypes[i].removeSeason() + "'>" + shottypes[i].removeSeason() + "</td></tr>")
                    } else if (game != "HSiFS" || !seasonsEnabled) {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + difficulty + "'><td class='" + shottypes[i] + "'>" + shottypes[i] + "</td></tr>")
                    }
                }
            }
        }
    } else {
        $("#list_thead").html("<tr id='list_thead_tr'><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) + "</th></tr>");
        for (i = 0; i < shottypes.length; i += 1) {
            if (game == "HSiFS" && seasonsEnabled) {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td><span class='" + shottypes[i].removeSeason() + "'>" + shottypes[i].removeSeason() + "</span><span class='" + shottypes[i].removeChar() + "'>" + shottypes[i].removeChar() + "</span></td></tr>")
            } else {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td class='" + shottypes[i] + "'>" + shottypes[i] + "</td></tr>")
            }
        }
    }

    for (difficulty in WRs[game]) {
        if (game == "GFW" && difficulty == "Extra") {
            $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td>Extra</td><td id='GFWExtra-'" + (isPortrait()
                ? ""
                : " colspan='4'") + "></td></tr>")
        } else if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled) {
            $("#list_thead_tr").append("<th class='sorttable_numeric'>Extra</th>");
            extrashots = ["Reimu", "Cirno", "Aya", "Marisa"];
            for (i = 0; i < 4; i += 1) {
                $("#" + extrashots[i] + "Spring").append("<td id='" + game + difficulty + extrashots[i] + "'" + (isPortrait()
                    ? ""
                    : " rowspan='4'") + "></td>")
            }
        } else {
            if (!isPortrait()) {
                $("#list_thead_tr").append("<th class='sorttable_numeric'>" + difficulty + "</th>")
            }
            for (i = 0; i < shottypes.length; i += 1) {
                if (isPortrait()) {
                    $("#" + shottypes[i] + difficulty).append("<td id='" + game + difficulty + shottypes[i] + "'></td>")
                } else {
                    $("#" + shottypes[i]).append("<td id='" + game + difficulty + shottypes[i] + "'></td>")
                }
            }
        }

        bestshotmax = 0;

        for (shottype in WRs[game][difficulty]) {
            season = shottype.removeChar();
            wr = WRs[game][difficulty][shottype];
            score = wr[0];
            player = wr[1];
            date = wr[2];
            if (wr[3]) {
                replay = wr[3];
            } else {
                if (gameAbbr(game) < 6 || missingReplays.contains(game + difficulty + shottype)) {
                    replay = "";
                } else {
                    replay = replayPath(game, difficulty, shottype);
                }
            }

            if (score > max) {
                overall = "#" + game + difficulty + shottype;
                overallplayer = player;
                overalldifficulty = difficulty;
                overallshottype = shottype;
                overallseason = season;
                overalldate = date;
                max = score;
            }

            if (score > bestshotmax) {
                bestshot = "#" + game + difficulty + shottype;
                bestshotplayer = player;
                bestshotseason = season;
                bestshotmax = score;
                bestshotreplay = replay;
                bestshotdate = date;
            }

            sepScore = (game == "WBaWC" && score > 9999999990 ? "<abbr title='" + sep(score) + "'>9,999,999,990</abbr>" : sep(score));
            text = (replay === "" ? sepScore : "<a class='replay' href='" + replay + "'>" + sepScore + "</a>") +
            "<br>by <em>" + player + "</em>" + (date && datesEnabled ? "<span class='dimgrey'><br>" +
            "<span class='datestring_game'>" + date + "</span></span>" : "");
            $("#" + game + difficulty + shottype).html(score > 0 ? text : '-');
            seasonless = shottype.removeSeason();

            if (game == "HSiFS" && shottype.removeChar() == bestSeason(difficulty, seasonless)) {
                $("#" + game + difficulty + seasonless + (difficulty == "Extra" ? "Small" : "")).html(text + (difficulty != "Extra" ? " (" + bestSeason(difficulty, seasonless) +
                ")" : ""));
            }
        }

        if (bestshotmax > 0) {
            sepScore = (game == "WBaWC" && bestshotmax > 9999999990 ? "<abbr title='" + sep(bestshotmax) + "'>9,999,999,990</abbr>" : sep(bestshotmax));
            $(bestshot).html((bestshotreplay === "" ? "<u>" + sepScore + "</u>" : "<u><a class='replay' href='" + bestshotreplay +
            "'>" + sepScore + "</a></u>") + "<br>by <em>" + bestshotplayer +
            "</em>" + (bestshotdate && datesEnabled ? "<span class='dimgrey'><br><span class='datestring_game'>" + bestshotdate + "</span></span>" : ""));
            compareWRs[difficulty] = [
                Math.min(bestshotmax, 9999999990), bestshotplayer, bestshot.replace("#" + game + difficulty, "")
            ];
        }

        if (game == "HSiFS") {
            $(bestshot.removeSeason() + (difficulty == "Extra" ? "Small" : "")).html((bestshotreplay === "" ? "<u>" + sep(bestshotmax) +
            "</u>" : "<u><a class='replay' href='" + bestshotreplay + "'>" + sep(bestshotmax) + "</a></u>") + "<br>by <em>" + bestshotplayer +
            "</em>" + (game == "HSiFS" && difficulty != "Extra" ? " (" + bestshotseason + ")" : "") + (bestshotdate && datesEnabled ? "<span class='dimgrey'><br>" +
            "<span class='datestring_game'>" + bestshotdate + "</span></span>" : ""));
        }
    }

    if (game == "HSiFS" && seasonsEnabled) {
        $(overall).html($(overall).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    } else {
        $(overall.removeSeason()).html($(overall.removeSeason()).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    }

    $("#west_tbody").html("");
    $("#west_thead").html("<tr><th class='world'>World</th><th class='west'>West</th><th class='percentage'>Percentage</th></tr>");

    for (difficulty in westScores[game]) {
        if (westScores[game][difficulty].length === 0) {
            $("#" + game + difficulty).append("<td>-</td><th>-</th>");
            continue;
        }

        west = westScores[game][difficulty][0];
        westPlayer = westScores[game][difficulty][1];
        westShottype = westScores[game][difficulty][2];
        world = compareWRs[difficulty][0];
        worldPlayer = compareWRs[difficulty][1];
        worldShottype = compareWRs[difficulty][2];
        percentage = (west / world * 100).toFixed(2);
        $("#west_tbody").append("<tr><td colspan='3'><u>" + difficulty + "</u></td></tr>");
        $("#west_tbody").append("<tr><td>" + sep(world) + "<br>by <em>" + worldPlayer +
        "</em>" + (worldShottype != '-' ? "<br>(<span class='" + worldShottype + "'>" + worldShottype + "</span>)" : "") +
        "</td><td>" + sep(west) + "<br>by <em>" + westPlayer + "</em>" + (westShottype != '-' ? "<br>(<span class='" + westShottype +
        "'>" + westShottype + "</span>)" : "") + "</td><td class='" + percentageClass(percentage) +
        "'>(" + (parseInt(percentage) == 100 ? 100 : percentage) + "%)</td></tr>");
    }

    $("#list").css("display", "block");
    $("#seasontoggle").css("display", game == "HSiFS" ? "block" : "none");
    generateTableText("wr");
    generateFullNames();
    generateShottypes();
    generateDates();
}
function getPlayerWRs(player) {
    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    if (!WRs) {
        $.get("json/wrlist.json", function (data) {
            WRs = data;
            getPlayerWRs(player);
        }, "json");
    }

    if (player == "...") {
        $("#playerlist").css("display", "none");
        $("#playerlistbody, #playerlistfoot").html("");
        playerSelected = false;
        return;
    }

    var cats = [], scoreArray = [], dateArray = [], replayArray = [], sum = 0, game, gamesum, difficulty, shottype, replay, i;

    playerSelected = true;
    $("#playerlistbody").html("");

    for (game in WRs) {
        gamesum = 0;

        for (difficulty in WRs[game]) {
            for (shottype in WRs[game][difficulty]) {
                if (WRs[game][difficulty][shottype].contains(player)) {
                    if (!cats.contains(game + difficulty)) {
                        $("#playerlistbody").append("<tr><td><span class='" + game + "'>" + game +
                        "</span>" + (language == "English" ? " " : "") + "<span class='" + difficulty + "'>" + difficulty +
                        "</span></td><td id='" + game + difficulty +
                        "s'></td><td id=" + game + difficulty + "r></td>" +
                        "<td id='" + game + difficulty + "d' class='date_empty'></td></tr>");
                        cats.push(game + difficulty);
                        scoreArray = [];
                        dateArray = [];
                        replayArray = [];
                    }
                    score = sep(WRs[game][difficulty][shottype][0]);
                    date = WRs[game][difficulty][shottype][2];
                    replay = WRs[game][difficulty][shottype][3];
                    scoreArray.push(score + (shottype === "" ? "": " (<span class='" + shottype + "'>" + shottype + "</span>)"));
                    dateArray.push("<span class='datestring_player'>" + date + "</span>");
                    if (replay) {
                        replayArray.push("<a href='" + replay + "'>" + replay + "</a>");
                    } else if (gameAbbr(game) < 6 || missingReplays.contains(game + difficulty + shottype)) {
                        replayArray.push('-');
                    } else {
                        replay = replayPath(game, difficulty, shottype);
                        tmp = replay.split('/');
                        replayArray.push("<a href='" + location.origin +
                        "/" + replay + "'>" + tmp[tmp.length - 1] + "</a>");
                    }
                    gamesum += 1;
                    sum += 1;
                }
            }
            $("#" + game + difficulty + "s").html(scoreArray.join("<br>"));
            $("#" + game + difficulty + "r").html(replayArray.join("<br>"));
            $("#" + game + difficulty + "d").html(dateArray.join("<br>"));
        }
    }

    $(".date_empty").css("display", datesEnabled ? "table-cell" : "none");
    $(".datestring_player").css("display", datesEnabled ? "inline" : "none");
    $("#playerlistfoot").html("<tr><td colspan='4'></td></tr><tr><td class='total'>Total</td><td colspan='3'>" + sum + "</td></tr>");
    $("#playerlist").css("display", "block");
    generateTableText("wr");
    generateShortNames();
    generateShottypes();
    generateDates(false, false, playerSelected);
}
function updateOrientation() {
    if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        if (selected !== "") {
            var tmp = selected;

            display({data: {game: tmp, seasonSwitch: false}});
            display({data: {game: tmp, seasonSwitch: false}});
        }
    }
}
function generateDates(oldLanguage, oldNotation, playerSelected) {
    var datestrings, date, i;

    if (oldLanguage) {
        datestrings = $(".datestring");
        alert(JSON.stringify(datestrings));

        for (i = 0; i < datestrings.length; i += 1) {
            date = $(datestrings[i]).html();

            if (language == "English") {
                if (oldLanguage == "English") {
                    if (notation == "DMY") {
                        $(datestrings[i]).html(translateUSDate(date, "DMY"));
                    } else if (notation == "MDY") {
                        $(datestrings[i]).html(translateDate(date, "MDY"));
                    }
                } else {
                    $(datestrings[i]).html(translateEADate(date, notation));
                }
            } else if (language == "Japanese" || language == "Chinese") {
                if (oldLanguage == "English") {
                    if (oldNotation == "DMY") {
                        $(datestrings[i]).html(translateDate(date, "YMD"));
                    } else if (oldNotation == "MDY") {
                        $(datestrings[i]).html(translateUSDate(date, "YMD"));
                    }
                }
            }
        }
    }

    if (selected !== "" || playerSelected) {
        datestrings = $(playerSelected ? ".datestring_player" : ".datestring_game");

        if (!oldNotation) {
            for (i = 0; i < datestrings.length; i += 1) {
                $(datestrings[i]).html(translateDate($(datestrings[i]).html(), notation))
            }
        } else if (notation != oldNotation) {
            for (i = 0; i < datestrings.length; i += 1) {
                if (oldNotation == "DMY") {
                    $(datestrings[i]).html(translateDate($(datestrings[i]).html(), notation))
                } else if (oldNotation == "MDY") {
                    $(datestrings[i]).html(translateUSDate($(datestrings[i]).html(), notation))
                } else if (oldNotation == "YMD") {
                    $(datestrings[i]).html(translateEADate($(datestrings[i]).html(), notation))
                }
            }
        }
    }
}
function setLanguage(event) {
    var newLanguage = event.data.language, newNotation = event.data.notation;

    if (language == newLanguage && notation == newNotation) {
        return;
    }

    var oldLanguage = language, oldNotation = notation, lm = $("#lm").html();

    language = newLanguage;
    setCookie("lang", newLanguage);
    notation = newNotation;
    setCookie("datenotation", newNotation);
    location.href = location.href.split('#')[0].split('?')[0];
}
$(document).ready(function () {
    var datestrings, i;
    $("#newlayout").css("display", "block");
    $("#playersearch").css("display", "block");
    $("#contents_new").css("display", "table");
    $("#westernlink").css("display", "block");
    $("#playersearchlink").css("display", "block");
    $("#layouttoggle").on("click", toggleLayout);
    $("#player").on("change", getPlayerWRs);
    $("body").on("resize", updateOrientation);
    $("#dates").on("click", {alreadyDisabled: false}, toggleDates);
    $("#seasons").on("click", toggleSeasons);
    $(".en-gb, .en-us, .jp, .zh").attr("href", "wr");
    $(".en-gb").on("click", {language: "English", notation: "DMY"}, setLanguage);
    $(".en-us").on("click", {language: "English", notation: "MDY"}, setLanguage);
    $(".jp").on("click", {language: "Japanese", notation: "YMD"}, setLanguage);
    $(".zh").on("click", {language: "Chinese", notation: "YMD"}, setLanguage);
    $(".game").on("click", {seasonSwitch: false}, display);
    $("#checkboxes").css("display", "table");
    seasonsEnabled = $("#seasons").is(":checked");
    datesEnabled = $("#dates").is(":checked");
    missingReplays = $("#missingReplays").val();

    if (getCookie("lang") == "Japanese" || location.href.contains("jp")) {
        language = "Japanese";
        notation = "YMD";
    } else if (getCookie("lang") == "Chinese" || location.href.contains("zh")) {
        language = "Chinese";
        notation = "YMD";
    } else if (getCookie("datenotation") == "MDY" || location.href.contains("en-us")) {
        notation = "MDY";
    }

    if (!datesEnabled) {
        disableDates();
    }

    if (navigator.userAgent.indexOf("Mobile") == -1 && navigator.userAgent.indexOf("Tablet") == -1) {
        $("#layouttoggle").css("display", "inline");
    }
});
