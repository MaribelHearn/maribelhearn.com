/*global $ _ WRs westScores unverifiedScores MAX_SCORE isMobile setCookie getCookie deleteCookie gameAbbr shottypeAbbr sep fullNameNumber*/
const all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"];
let missingReplays, seasonsEnabled, datesEnabled, unverifiedEnabled;
let language = "en_GB";
let selected = "";


function removeChar(string) {
    return string.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
}

function removeSeason(string) {
    return string.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
}

function isPortrait() {
    return window.innerHeight > window.innerWidth && isMobile();
}

function toggleSeasons() {
    seasonsEnabled = !seasonsEnabled;
    seasonsEnabled ? localStorage.setItem("seasonsEnabled", true) : localStorage.removeItem("seasonsEnabled");
    reloadTable();
}

function toggleLayout() {
    if (getCookie("wr_old_layout")) {
        deleteCookie("wr_old_layout");
    } else {
        setCookie("wr_old_layout", true);
    }
}

function toggleDates(event) {
    const alreadyDisabled = event.data.alreadyDisabled;

    if (!alreadyDisabled) {
        datesEnabled = !datesEnabled;
        datesEnabled ? localStorage.setItem("datesEnabled", true) : localStorage.removeItem("datesEnabled");
    }

    for (let game of all) {
        if (game == "overall") {
            continue;
        }

        $("#" + game + "overall4, #" + game + "overallm").css("display", datesEnabled ? "table-cell" : "none");
    }

    $(".datestring_player").css("display", datesEnabled ? "inline" : "none");
    $(".date, .date_empty").css("display", datesEnabled ? "table-cell" : "none");
    $(".datestring, .datestring_game").css("display", datesEnabled ? "table-cell" : "none");
}

function toggleUnverified() {
    unverifiedEnabled = !unverifiedEnabled;
    unverifiedEnabled ? localStorage.setItem("unverifiedEnabled", true) : localStorage.removeItem("unverifiedEnabled");
    reloadTable();
}

function disableDates() {
    toggleDates({data: {alreadyDisabled: true}});
}

function shotRoute(game) {
    return game == "HRtP" || game == "GFW" ? _("Route") : _("Shottype");
}

function replayPath(game, difficulty, shottype) {
    if (game == "StB") {
        difficulty = difficulty.padStart(2, 0);
        shottype = shottype.padStart(2, 0);
    }

    return "replays/th" + gameAbbr(game) + "_ud" + difficulty.substr(0, 2) + shottypeAbbr(shottype) + ".rpy";
}

function bestSeason(difficulty, shottype) {
    const shottypes = WRs.HSiFS[difficulty];
    let max = 0;
    let season;

    for (let key in shottypes) {
        if (!key.includes(shottype)) {
            continue;
        }

        if (shottypes[key][0] > max) {
            season = key.replace(shottype, "");
            max = shottypes[key][0];
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

function formatUnverified(score) {
    return "<span class='unver_container'><span class='unver'>" + score + "</span><span class='tooltip'>Unverified</span></span>";
}

function showWesternRecords(compareWRs, unverifiedObj, game) {
    if (game == "StB" || game == "DS") {
        return;
    }

    $("#west_tbody").html("");
    $("#west_thead").html(`<tr class='west_tr'><th class='world'>${_("World")}</th><th class='west'>${_("West")}</th><th class='percentage'>${_("Percentage")}</th></tr>`);

    for (let difficulty in westScores[game]) {
        if (westScores[game][difficulty].length === 0) {
            $("#" + game + difficulty).append("<td>-</td><th>-</th>");
            continue;
        }

        let west = westScores[game][difficulty][0];
        let westPlayer = westScores[game][difficulty][1];
        let westShottype = westScores[game][difficulty][2];
        let world = compareWRs[difficulty][0];
        let worldPlayer = compareWRs[difficulty][1];
        let worldShottype = compareWRs[difficulty][2];
        let percentage = (west / world * 100).toFixed(2);
        let percentageText = parseInt(percentage) == 100 ? 100 : percentage;
        westShottype = (westShottype != '-' ? "<br>(" + _(westShottype) + ")" : "");
        world = (unverifiedObj.hasOwnProperty(game + difficulty + worldShottype) ? formatUnverified(sep(world)) : sep(world));
        worldShottype = (worldShottype != '-' ? `<br>(` + _(worldShottype) + ")" : "");
        $("#west_tbody").append(`<tr class='west_tr'><td colspan='3'>${difficulty}</td>`);
        $("#west_tbody").append(`<td>${world}<br>by <em>${worldPlayer}</em>${worldShottype}</td>`);
        $("#west_tbody").append(`<td>${sep(west)}<br>by <em>${westPlayer}</em>${westShottype}</td><td class='${percentageClass(percentage)}'>(${percentageText}%)</td></tr>`);
    }
}

function appendShottypeHeader(game, difficulty, shottype) {
    if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled && removeChar(shottype) == "Spring") {
        $("#list_tbody").append(`<tr id='${shottype}'><td>${_(removeSeason(shottype))}</td></tr>`);
    } else {
        $("#list_tbody").append(`<tr id='${shottype + difficulty}'><td>${_(shottype)}</td></tr>`);
    }
}

function appendShottypeHeaders(game, shottypes) {
    $("#list_tbody").html("");

    if (isPortrait()) {
        for (let difficulty in WRs[game]) {
            $("#list_tbody").append(`<tr><th>${shotRoute(game)}</th><th class='${difficulty}'>${difficulty}</th></tr>`);

            if (game != "GFW" || difficulty != "Extra") {
                for (let shottype of shottypes) {
                    appendShottypeHeader(game, difficulty, shottype);
                }
            }
        }
    } else {
        $("#list_thead").html(`<tr id='list_thead_tr'><th>${shotRoute(game)}</th></tr>`);

        for (let i = 0; i < shottypes.length; i++) {
            if (game == "HSiFS" && seasonsEnabled) {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td><span>" + _(removeSeason(shottypes[i])) +
                "</span><span class='" + removeChar(shottypes[i]) + "'>" + _(removeChar(shottypes[i])) + "</span></td></tr>");
            } else {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td>" + _(shottypes[i]) + "</td></tr>");
            }
        }
    }
}

function appendDifficultyHeaders(game, difficulty, shottypes) {
    var extraShots = ["Reimu", "Cirno", "Aya", "Marisa"];

    if (game == "GFW" && difficulty == "Extra") {
        $("#list_tbody").append("<tr id='Extra'><td>Extra</td><td id='GFWExtra-'" + (isPortrait() ? "" : " colspan='4'") + "></td></tr>");
    } else if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled) {
        $("#list_thead_tr").append("<th class='sorttable_numeric'>Extra</th>");
        for (let i = 0; i < 4; i += 1) {
            $("#" + extraShots[i] + "Spring").append("<td id='" + game + difficulty + extraShots[i] + "'" + (isPortrait() ? "" : " rowspan='4'") + "></td>");
        }
    } else {
        if (!isPortrait()) {
            $("#list_thead_tr").append("<th class='sorttable_numeric'>" + difficulty + "</th>");
        }
        for (let shottype of shottypes) {
            if (isPortrait()) {
                $("#" + shottype + difficulty).append("<td id='" + game + difficulty + shottype + "'></td>");
            } else {
                $("#" + shottype).append("<td id='" + game + difficulty + shottype + "'></td>");
            }
        }
    }
}

function prepareShowWR(game, shottypes) {
    $("#list").html("<p id='fullname'></p>" +
    "<p id='seasontoggle'><input id='seasons' type='checkbox'><label id='label_seasons' class='Seasons' for='seasons'>" + _("Seasons") + "</label></p>" +
    "<p><input id='unverified' type='checkbox'><label id='label_unverified' for='unverified' class='unverified'>Unverified Scores</label></p>" +
    "<table id='table' class='sortable'><thead id='list_thead'></thead><tbody id='list_tbody'></tbody></table>" +
    "<table><thead id='west_thead'></thead><tbody id='west_tbody'></tbody></table>");
    $("#seasons").on("click", toggleSeasons);
    $("#unverified").on("click", toggleUnverified);

    if (unverifiedEnabled) {
        $("#unverified").prop("checked", true);
    }

    if (selected !== "") {
        $("#" + selected + "_image").css("border", $("#" + selected + "_image").hasClass("cover98") ? "1px solid black" : "none");
    }

    $("#fullname").removeClass(selected + "f");
    $("#table").removeClass(selected + "t");
    $("#" + game + "_image").css("border", "3px solid gold");
    selected = game;
    $("#fullname").addClass(game + "f");
    $("#fullname").html(_(fullNameNumber(game)));
    $("#table").addClass(game + "t");
    appendShottypeHeaders(game, shottypes);
}

function formatDate(date) {
    date = date.split('/').reverse().join('/');

    if (language == "ja_JP" || language == "zh_CN") {
        date = new Date(date).toLocaleString(language.replace('_', '-'), {"dateStyle": "long"});
    } else {
        date = new Date(date).toLocaleString(language.replace('_', '-'), {"year": "numeric", "month": "2-digit", "day": "2-digit"});
    }

    return date;
}

function showWRtable(game) {
    var overall = {}, bestShot = {}, compareWRs = {}, unverifiedObj = {}, shottypes = [], max = 0, diffKey = "Easy", difficulty,
    shottype, character, season, wr, score, player, replay, date, text, sepScore, bestShotMax, unverifiedScore;

    if (game == 'StB' || game == 'DS') {
        diffKey = '1';
    }

    for (shottype in WRs[game][diffKey]) {
        shottypes.pushStrict(seasonsEnabled ? shottype : removeSeason(shottype));
    }

    prepareShowWR(game, shottypes);

    for (difficulty in WRs[game]) {
        appendDifficultyHeaders(game, difficulty, shottypes);
        bestShotMax = 0;

        for (shottype in WRs[game][difficulty]) {
            character = removeSeason(shottype);
            season = removeChar(shottype);
            wr = WRs[game][difficulty][shottype];
            score = wr[0];
            player = wr[1];
            date = formatDate(wr[2]);

            if (wr[3]) {
                replay = wr[3];
            } else {
                if (gameAbbr(game) < 6 || missingReplays.includes(game + difficulty + shottype)) {
                    replay = "";
                } else {
                    replay = replayPath(game, difficulty, shottype);
                }
            }

            if (score > bestShotMax) {
                bestShot = {"id": "#" + game + difficulty + shottype, "player": player, "shottype": shottype, "season": season, "max": score, "replay": replay, "date": date};
                bestShotMax = score;

                if (unverifiedEnabled && unverifiedScores[game][difficulty][shottype][0] > score) {
                    unverifiedObj[game + difficulty + shottype] = unverifiedScores[game][difficulty][shottype];
                    unverifiedScore = unverifiedObj[game + difficulty + shottype];
                    score = unverifiedScore[0];
                    player = unverifiedScore[1];
                    date = formatDate(unverifiedScore[2]);
                    bestShot.player = player;
                    bestShot.max = score;
                    bestShot.date = date;
                    bestShot.replay = "";
                    bestShotMax = score;
                }
            }

            if (score > max) {
                overall = {"id": "#" + game + difficulty + shottype, "player": player, "difficulty": difficulty, "season": season, "date": date};
                max = score;

                if (unverifiedEnabled && unverifiedScores[game][difficulty][shottype][0] > score) {
                    unverifiedObj[game + difficulty + shottype] = unverifiedScores[game][difficulty][shottype];
                    unverifiedScore = unverifiedObj[game + difficulty + shottype];
                    score = unverifiedScore[0];
                    player = unverifiedScore[1];
                    date = formatDate(unverifiedScore[2]);
                    overall.player = player;
                    overall.date = date;
                    max = score;
                }
            }

            if (unverifiedEnabled && unverifiedScores[game][difficulty][shottype][0] > score) {
                unverifiedObj[game + difficulty + shottype] = unverifiedScores[game][difficulty][shottype];
                unverifiedScore = unverifiedObj[game + difficulty + shottype];
                score = unverifiedScore[0];
                player = unverifiedScore[1];
                date = formatDate(unverifiedScore[2]);
            } else {
                unverifiedScore = false;
            }

            sepScore = ((game == "WBaWC" || game == "UM") && score > MAX_SCORE ? "<span class='cs'>9,999,999,990" +
            "<span class='tooltip truescore'>" + sep(score) + "</span></span>" : sep(score));

            text = (replay === "" ? sepScore : "<a class='replay' href='" + replay + "'>" + sepScore + "<span class='dl_icon'></span></a>");

            if (unverifiedObj.hasOwnProperty(game + difficulty + shottype)) {
                text = formatUnverified(sepScore);
            }

            text += "<br>by <em>" + player + "</em>" + (date && datesEnabled ? "<span class='dimgrey'><br>" +
            "<span class='datestring_game'>" + date + "</span></span>" : "");
            $("#" + game + difficulty + shottype).html(score > 0 ? text : '-');

            if (game == "HSiFS" && season == bestSeason(difficulty, character)) {
                $("#" + game + difficulty + character + (difficulty == "Extra" ? "Small" : "")).html(text + (difficulty != "Extra" ? " (" + _(bestSeason(difficulty, character)) +
                ")" : ""));
            }
        }

        if (bestShotMax > 0) {
            sepScore = ((game == "WBaWC" || game == "UM") && bestShotMax > MAX_SCORE ? "<span class='cs'>9,999,999,990" +
            "<span class='tooltip truescore'>" + sep(bestShotMax) + "</span></span>" : sep(bestShotMax));

            text = (bestShot.replay === "" ? "<u>" + sepScore + "</u>" : "<u><a class='replay' href='" + bestShot.replay +
            "'>" + sepScore + "<span class='dl_icon'></span></a></u>");

            if (unverifiedObj.hasOwnProperty(game + difficulty + bestShot.shottype)) {
                text = formatUnverified("<u>" + sepScore + "</u>");
            }

            text += "<br>by <em>" + bestShot.player +
            "</em>" + (bestShot.date && datesEnabled ? "<span class='dimgrey'><br><span class='datestring_game'>" + bestShot.date + "</span></span>" : "");

            $(bestShot.id).html(text);
            compareWRs[difficulty] = [Math.min(bestShotMax, MAX_SCORE), bestShot.player, bestShot.shottype];
        }

        if (!compareWRs[difficulty]) {
            compareWRs[difficulty] = [0, "", ""];
        }

        if (game == "HSiFS") {
            sepScore = (bestShot.replay === ""
                ? "<u>" + sep(bestShotMax) + "</u>"
                : "<u><a class='replay' href='" + bestShot.replay + "'>" + sep(bestShotMax) + "<span class='dl_icon'></span></a></u>"
            );

            if (unverifiedObj.hasOwnProperty("HSiFS" + difficulty + bestShot.shottype)) {
                sepScore = formatUnverified(sepScore);
            }

            $(removeSeason(bestShot.id) + (difficulty == "Extra" ? "Small" : "")).html(sepScore + "<br>by <em>" + bestShot.player + "</em>" +
            (game == "HSiFS" && difficulty != "Extra"
                ? " (" + _(bestShot.season) + ")"
                : ""
            ) + (bestShot.date && datesEnabled
                ? "<span class='dimgrey'><br>" + "<span class='datestring_game'>" + bestShot.date + "</span></span>"
                : ""
            ));
        }
    }

    if (game == "HSiFS" && seasonsEnabled) {
        $(overall.id).html($(overall.id).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    } else if (overall.id) {
        $(removeSeason(overall.id)).html($(removeSeason(overall.id)).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    }

    showWesternRecords(compareWRs, unverifiedObj, game);
    $("#list").css("display", "block");
    $("#seasontoggle").css("display", game == "HSiFS" ? "block" : "none");
    $("#seasons").prop("checked", seasonsEnabled);
}

function verifyConditions(game) {
    if (game == selected) {
        $("#list").html("");
        $(`#${game}_image`).css("border", $(`#${game}_image`).hasClass("cover98") ? "1px solid black" : "none");
        selected = "";
        return false;
    }

    return true;
}

function showWRs(event) {
    const game = event.data ? event.data.game : this.id.replace("_image", "");

    if (verifyConditions(game)) {
        showWRtable(game);
    }
}

function addPlayerWR(playerWRs, game, difficulty, shottype, isUnverified) {
    if (!playerWRs.cats.includes(game + difficulty)) {
        let space = (language != "ja_JP" && language != "zh_CN" ? " " : "");
        $("#playerlistbody").append(`<tr>` +
                `<td class='${game}p'>${_(game)}${space}${difficulty}</td>` +
                `<td id='${game + difficulty}s'></td>` +
                `<td id='${game + difficulty}r'></td>` +
                `<td id='${game + difficulty}d' class='date_empty'></td>` +
                `</tr>`);
        playerWRs.cats.push(game + difficulty);
    }

    const shottypeText = (shottype === "" ? "" : " (" + _(shottype) + ")");
    let score = sep(WRs[game][difficulty][shottype][0]);
    let date = formatDate(WRs[game][difficulty][shottype][2]);
    let replay = WRs[game][difficulty][shottype][3];
    let tmp;

    if (isUnverified) {
        score = formatUnverified(sep(unverifiedScores[game][difficulty][shottype][0]));
        date = formatDate(unverifiedScores[game][difficulty][shottype][2]);
    }

    playerWRs.scores.push(score + shottypeText);
    playerWRs.dates.push(`<span class='datestring_player'>${date}</span>`);

    if (replay) {
        playerWRs.replays.push(`<a href='${replay}'>${replay}</a>`);
    } else if (gameAbbr(game) < 6 || missingReplays.includes(game + difficulty + shottype) || isUnverified) {
        playerWRs.replays.push('-');
    } else {
        replay = replayPath(game, difficulty, shottype);
        tmp = replay.split('/');
        playerWRs.replays.push(`<a href='${location.origin}/${replay}'>${tmp[tmp.length - 1]}</a>`);
    }

    return playerWRs;
}

function showPlayerWRs(player) {
    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    if (player === "") {
        return;
    }

    let playerWRs = {"scores": [], "replays": [], "dates": [], "cats": []};
    let sum = 0;

    $("#playerlistbody").html("");

    for (let game in WRs) {
        for (let difficulty in WRs[game]) {
            for (let shottype in WRs[game][difficulty]) {
                if (WRs[game][difficulty][shottype].includes(player)) {
                    playerWRs = addPlayerWR(playerWRs, game, difficulty, shottype, false);
                    sum += 1;
                }
            }

            $(`#${game + difficulty}s`).html(playerWRs.scores.join("<br>"));
            $(`#${game + difficulty}r`).html(playerWRs.replays.join("<br>"));
            $(`#${game + difficulty}d`).html(playerWRs.dates.join("<br>"));
            playerWRs.scores = [];
            playerWRs.replays = [];
            playerWRs.dates = [];
        }
    }

    if (JSON.stringify(unverifiedScores).includes(player)) {
        for (let game in unverifiedScores) {
            for (let difficulty in unverifiedScores[game]) {
                for (let shottype in unverifiedScores[game][difficulty]) {
                    if (unverifiedScores[game][difficulty][shottype].includes(player)) {
                        playerWRs = addPlayerWR(playerWRs, game, difficulty, shottype, true);
                        sum += 1;
                    }
                }

                if ($(`#${game + difficulty}s`).html() === "") {
                    $(`#${game + difficulty}s`).html(playerWRs.scores.join("<br>"));
                } else {
                    $(`#${game + difficulty}s`).append("<br>" + playerWRs.scores.join("<br>"));
                }

                if ($(`#${game + difficulty}r`).html() === "") {
                    $(`#${game + difficulty}r`).html(playerWRs.replays.join("<br>"));
                } else {
                    $(`#${game + difficulty}r`).append("<br>" + playerWRs.replays.join("<br>"));
                }

                if ($(`#${game + difficulty}d`).html() === "") {
                    $(`#${game + difficulty}d`).html(playerWRs.dates.join("<br>"));
                } else {
                    $(`#${game + difficulty}d`).append("<br>" + playerWRs.dates.join("<br>"));
                }

                playerWRs.scores = [];
                playerWRs.replays = [];
                playerWRs.dates = [];
            }
        }
    }

    if (sum === 0) {
        $("#playerlist").css("display", "none");
        return;
    }

    $(".date_empty").css("display", datesEnabled ? "table-cell" : "none");
    $(".datestring_player").css("display", datesEnabled ? "inline" : "none");
    $("#playerlistfoot").html("<tr><td colspan='4'></td></tr><tr><td class='total'>Total</td><td colspan='3'>" + sum + "</td></tr>");
    $("#playerlist").css("display", "block");
}

function reloadTable() {
    if (selected !== "") {
        showWRtable(selected);
    }
}

function updateOrientation() {
    if (isMobile()) {
        reloadTable();
    }
}

function setLanguage(event) {
    const newLanguage = event.data.language;

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    setCookie("lang", newLanguage);
    location.href = location.href.split('#')[0].split('?')[0];
}

function setEventListeners() {
    $("#layouttoggle").on("click", toggleLayout);
    $("#player").on("change", showPlayerWRs);
    $("#player").on("select", showPlayerWRs);
    $("body").on("resize", updateOrientation);
    $("#dates").on("click", {alreadyDisabled: false}, toggleDates);
    $("#en-gb").on("click", {language: "en_GB"}, setLanguage);
    $("#en-us").on("click", {language: "en_US"}, setLanguage);
    $("#jp").on("click", {language: "ja_JP"}, setLanguage);
    $("#zh").on("click", {language: "zh_CN"}, setLanguage);
    $("#ru").on("click", {language: "ru_RU"}, setLanguage);
    $("#de").on("click", {language: "de_DE"}, setLanguage);
    $("#es").on("click", {language: "es_ES"}, setLanguage);
    $(".game_img").on("click", showWRs);
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
    if (getCookie("lang") == "ja_JP" || location.href.includes("?hl=jp")) {
        language = "ja_JP";
    } else if (getCookie("lang") == "zh_CN" || location.href.includes("?hl=zh")) {
        language = "zh_CN";
    } else if (getCookie("lang") == "ru_RU" || location.href.includes("?hl=ru")) {
        language = "ru_RU";
    } else if (getCookie("lang") == "de_DE" || location.href.includes("?hl=de")) {
        language = "de_DE";
    } else if (getCookie("lang") == "es_ES" || location.href.includes("?hl=es")) {
        language = "es_ES";
    } else if (getCookie("lang") == "en_US" || location.href.includes("?hl=en-us")) {
        language = "en_US";
    }

    missingReplays = $("#missing_replays").val();
    datesEnabled = localStorage.getItem("datesEnabled") ? true : false;
    seasonsEnabled = localStorage.getItem("seasonsEnabled") ? true : false;
    unverifiedEnabled = localStorage.getItem("unverifiedEnabled") ? true : false;
    $("#missing_replays").remove();
    setEventListeners();
    setAttributes();

    if (!datesEnabled) {
        disableDates();
    } else {
        $("#dates").prop("checked", true);
    }
});
