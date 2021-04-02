var WRs, westScores, missingReplays, seasonsEnabled, datesEnabled,
    notation = "DMY", language = "English", selected = "", playerSelected = false, skips = [],
    all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN",
    "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC"],
    windows = ["EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"];

function removeChar(string) {
    return string.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
}

function removeSeason(string) {
    return string.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
}

function isPortrait() {
    return window.innerHeight > window.innerWidth && (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1);
}

function toggleSeasons() {
    seasonsEnabled = !seasonsEnabled;
    seasonsEnabled ? localStorage.setItem("seasonsEnabled", true) : localStorage.removeItem("seasonsEnabled");
    showWRs({data: {game: "HSiFS", seasonSwitch: true}});
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
        datesEnabled ? localStorage.setItem("datesEnabled", true) : localStorage.removeItem("datesEnabled");
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

function showWesternRecords(compareWRs, game) {
    var difficulty, percentage, west, westPlayer, westShottype, world, worldPlayer, worldShottype;

    $("#west_tbody").html("");
    $("#west_thead").html("<tr><th class='world'>World</th><th class='west'>West</th><th class='percentage'>Percentage</th></tr>");

    for (difficulty in westScores[game]) {
        if (westScores[game][difficulty].length === 0) {
            $("#" + game + difficulty).append("<td>-</td><th>-</th>");
            continue;
        }

        west = compareWRs[difficulty][0];
        westPlayer = compareWRs[difficulty][1];
        westShottype = compareWRs[difficulty][2];
        world = compareWRs[difficulty][0];
        worldPlayer = compareWRs[difficulty][1];
        worldShottype = compareWRs[difficulty][2];
        percentage = (west / world * 100).toFixed(2);
        $("#west_tbody").append("<tr><td colspan='3'>" + difficulty + "</td></tr>");
        $("#west_tbody").append("<tr><td>" + sep(world) + "<br>by <em>" + worldPlayer +
        "</em>" + (worldShottype != '-' ? "<br>(<span class='" + worldShottype + "'>" + worldShottype + "</span>)" : "") +
        "</td><td>" + sep(west) + "<br>by <em>" + westPlayer + "</em>" + (westShottype != '-' ? "<br>(<span class='" + westShottype +
        "'>" + westShottype + "</span>)" : "") + "</td><td class='" + percentageClass(percentage) +
        "'>(" + (parseInt(percentage) == 100 ? 100 : percentage) + "%)</td></tr>");
    }
}

function appendShottypeHeaders(game, shottypes) {
    $("#list_tbody").html("");

    if (isPortrait()) {
        for (var difficulty in WRs[game]) {
            $("#list_tbody").append("<tr><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) + "</th><th class='" + difficulty + "'>" + difficulty + "</th></tr>");
            if (game != "GFW" || difficulty != "Extra") {
                for (i = 0; i < shottypes.length; i++) {
                    if (game == "HSiFS" && difficulty != "Extra" && seasonsEnabled) {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + difficulty + "'><td><span class='" + removeSeason(shottypes[i]) +
                        "'>" + removeSeason(shottypes[i]) + "</span><span class='" + removeChar(shottypes[i]) + "'>" + removeChar(shottypes[i]) + "</span></td></tr>");
                    } else if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled && removeChar(shottypes[i]) == "Spring") {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td class='" + removeSeason(shottypes[i]) + "'>" + removeSeason(shottypes[i]) + "</td></tr>");
                    } else if (game != "HSiFS" || !seasonsEnabled) {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + difficulty + "'><td class='" + shottypes[i] + "'>" + shottypes[i] + "</td></tr>");
                    }
                }
            }
        }
    } else {
        $("#list_thead").html("<tr id='list_thead_tr'><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) + "</th></tr>");
        for (i = 0; i < shottypes.length; i++) {
            if (game == "HSiFS" && seasonsEnabled) {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td><span class='" + removeSeason(shottypes[i]) + "'>" + removeSeason(shottypes[i]) +
                "</span><span class='" + removeChar(shottypes[i]) + "'>" + removeChar(shottypes[i]) + "</span></td></tr>");
            } else {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td class='" + shottypes[i] + "'>" + shottypes[i] + "</td></tr>");
            }
        }
    }
}

function appendDifficultyHeaders(game, difficulty, shottypes) {
    var extraShots = ["Reimu", "Cirno", "Aya", "Marisa"], i;

    if (game == "GFW" && difficulty == "Extra") {
        $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td>Extra</td><td id='GFWExtra-'" + (isPortrait() ? "" : " colspan='4'") + "></td></tr>");
    } else if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled) {
        $("#list_thead_tr").append("<th class='sorttable_numeric'>Extra</th>");
        for (i = 0; i < 4; i += 1) {
            $("#" + extraShots[i] + "Spring").append("<td id='" + game + difficulty + extraShots[i] + "'" + (isPortrait() ? "" : " rowspan='4'") + "></td>");
        }
    } else {
        if (!isPortrait()) {
            $("#list_thead_tr").append("<th class='sorttable_numeric'>" + difficulty + "</th>");
        }
        for (i = 0; i < shottypes.length; i += 1) {
            if (isPortrait()) {
                $("#" + shottypes[i] + difficulty).append("<td id='" + game + difficulty + shottypes[i] + "'></td>");
            } else {
                $("#" + shottypes[i]).append("<td id='" + game + difficulty + shottypes[i] + "'></td>");
            }
        }
    }
}

function showWRs(event) {
    var game = event.data.game ? event.data.game : this.id.replace("_image", ""), seasonSwitch = event.data.seasonSwitch;

    if (!WRs || !westScores) {
        $.get("assets/json/wrlist.json", function (data1) {
            $.get("assets/json/bestinthewest.json", function (data2) {
                WRs = data1;
                westScores = data2;
                showWRs({data: {game: game, seasonSwitch: seasonSwitch}});
            }, "json");
        }, "json");
        return;
    }

    if (game == selected && !seasonSwitch) {
        $("#list").html("");
        $("#" + game + "_image").css("border", $("#" + game + "_image").hasClass("cover98") ? "1px solid black" : "none");
        selected = "";
        return;
    }

    var overall = {}, bestShot = {}, compareWRs = {}, shottypes = [], max = 0, difficulty, shottype,
        char, season, wr, score, player, replay, text, count, seasonless, sepScore, bestShotMax;

    $("#list").html("<p id='fullname'></p><p id='seasontoggle'><input id='seasons' type='checkbox'>" +
    "<label id='label_seasons' class='Seasons' for='seasons'></label>" +
    "</p><table id='table' class='sortable'><thead id='list_thead'></thead><tbody id='list_tbody'></tbody></table>" +
    "<table><thead id='west_thead'></thead><tbody id='west_tbody'></tbody></table>");
    $("#seasons").on("click", toggleSeasons);

    for (shottype in WRs[game]["Easy"]) {
        shottypes.pushStrict(seasonsEnabled ? shottype : removeSeason(shottype));
    }

    if (selected !== "") {
        $("#" + selected + "_image").css("border", $("#" + selected + "_image").hasClass("cover98") ? "1px solid black" : "none");
    }

    $("#fullname").removeClass(selected + "f");
    $("#table").removeClass(selected + "t");
    $("#" + game + "_image").css("border", "3px solid gold");
    selected = game;
    $("#fullname").addClass(game + "f");
    $("#fullname").html(fullNameNumber(game));
    $("#table").addClass(game + "t");
    appendShottypeHeaders(game, shottypes);

    for (difficulty in WRs[game]) {
        appendDifficultyHeaders(game, difficulty, shottypes);
        bestShotMax = 0;

        for (shottype in WRs[game][difficulty]) {
            char = removeSeason(shottype);
            season = removeChar(shottype);
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
                overall.id = "#" + game + difficulty + shottype;
                overall.player = player;
                overall.difficulty = difficulty;
                overall.season = season;
                overall.date = date;
                max = score;
            }

            if (score > bestShotMax) {
                bestShot.id = "#" + game + difficulty + shottype;
                bestShot.player = player;
                bestShot.shottype = shottype;
                bestShot.season = season;
                bestShot.max = score;
                bestShot.replay = replay;
                bestShot.date = date;
                bestShotMax = score;
            }

            sepScore = (game == "WBaWC" && score > MAX_SCORE ? "<span class='cs'>9,999,999,990" +
            "<span class='tooltip truescore'>" + sep(score) + "</span></span>" : sep(score));
            text = (replay === "" ? sepScore : "<a class='replay' href='" + replay + "'>" + sepScore + "</a>") +
            "<br>by <em>" + player + "</em>" + (date && datesEnabled ? "<span class='dimgrey'><br>" +
            "<span class='datestring_game'>" + date + "</span></span>" : "");
            $("#" + game + difficulty + shottype).html(score > 0 ? text : '-');

            if (game == "HSiFS" && season == bestSeason(difficulty, char)) {
                $("#" + game + difficulty + char + (difficulty == "Extra" ? "Small" : "")).html(text + (difficulty != "Extra" ? " (" + bestSeason(difficulty, char) +
                ")" : ""));
            }
        }

        if (bestShotMax > 0) {
            sepScore = (game == "WBaWC" && bestShotMax > MAX_SCORE ? "<span class='cs'>9,999,999,990" +
            "<span class='tooltip truescore'>" + sep(bestShotMax) + "</span></span>" : sep(bestShotMax));
            $(bestShot.id).html((bestShot.replay === "" ? "<u>" + sepScore + "</u>" : "<u><a class='replay' href='" + bestShot.replay +
            "'>" + sepScore + "</a></u>") + "<br>by <em>" + bestShot.player +
            "</em>" + (bestShot.date && datesEnabled ? "<span class='dimgrey'><br><span class='datestring_game'>" + bestShot.date + "</span></span>" : ""));
            compareWRs[difficulty] = [Math.min(bestShotMax, MAX_SCORE), bestShot.player, bestShot.shottype];
        }

        if (game == "HSiFS") {
            $(removeSeason(bestShot.id) + (difficulty == "Extra" ? "Small" : "")).html((bestShot.replay === "" ? "<u>" + sep(bestShotMax) +
            "</u>" : "<u><a class='replay' href='" + bestShot.replay + "'>" + sep(bestShotMax) + "</a></u>") + "<br>by <em>" + bestShot.player +
            "</em>" + (game == "HSiFS" && difficulty != "Extra" ? " (" + bestShot.season + ")" : "") + (bestShot.date && datesEnabled ? "<span class='dimgrey'><br>" +
            "<span class='datestring_game'>" + bestShot.date + "</span></span>" : ""));
        }
    }

    if (game == "HSiFS" && seasonsEnabled) {
        $(overall.id).html($(overall.id).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    } else {
        $(removeSeason(overall.id)).html($(removeSeason(overall.id)).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    }

    showWesternRecords(compareWRs, game);
    generateTableText("wr");
    generateFullNames();
    generateShottypes();
    generateDates();
    $("#list").css("display", "block");
    $("#seasontoggle").css("display", game == "HSiFS" ? "block" : "none");
    $("#seasons").prop("checked", seasonsEnabled);
}

function showPlayerWRs(player) {
    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    if (!WRs) {
        $.get("assets/json/wrlist.json", function (data) {
            WRs = data;
            showPlayerWRs(player);
        }, "json");
    }

    if (player === "") {
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

    if (sum === 0) {
        $("#playerlist").css("display", "none");
        playerSelected = false;
        return;
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

            showWRs({data: {game: tmp, seasonSwitch: false}});
            showWRs({data: {game: tmp, seasonSwitch: false}});
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

function setEventListeners() {
    $("#layouttoggle").on("click", toggleLayout);
    $("#player").on("change", showPlayerWRs);
    $("#player").on("select", showPlayerWRs);
    $("body").on("resize", updateOrientation);
    $("#dates").on("click", {alreadyDisabled: false}, toggleDates);
    $("#en-gb").on("click", {language: "English", notation: "DMY"}, setLanguage);
    $("#en-us").on("click", {language: "English", notation: "MDY"}, setLanguage);
    $("#jp").on("click", {language: "Japanese", notation: "YMD"}, setLanguage);
    $("#zh").on("click", {language: "Chinese", notation: "YMD"}, setLanguage);
    $(".game").on("click", {seasonSwitch: false}, showWRs);
}

function setAttributes() {
    $("#newlayout").css("display", "block");
    $("#playersearch").css("display", "block");
    $("#contents_new").css("display", "table");
    $("#westernlink").css("display", "block");
    $("#playersearchlink").css("display", "block");
    $("#checkboxes").css("display", "table");
    $(".flag").attr("href", "");
}

$(document).ready(function () {
    missingReplays = $("#missingReplays").val();
    datesEnabled = localStorage.getItem("datesEnabled");
    seasonsEnabled = localStorage.getItem("seasonsEnabled");
    setEventListeners();
    setAttributes();

    if (getCookie("lang") == "Japanese" || location.href.contains("jp")) {
        language = "Japanese";
        notation = "YMD";
    } else if (getCookie("lang") == "Chinese" || location.href.contains("zh")) {
        language = "Chinese";
        notation = "YMD";
    } else if (getCookie("datenotation") == "MDY" || location.href.contains("en-us")) {
        notation = "MDY";
    }

    $("#top").attr("lang", langCode(language, notation));

    if (!datesEnabled) {
        disableDates();
    } else {
        $("#dates").prop("checked", true);
    }
});
