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

function toggleDates(alreadyDisabled) {
    if (alreadyDisabled !== true) {
        datesEnabled = !datesEnabled;
        datesEnabled ? localStorage.setItem("datesEnabled", true) : localStorage.removeItem("datesEnabled");
    }

    const display = (datesEnabled ? "table-cell" : "none");
    const displayPlayer = (datesEnabled ? "inline" : "none");

    for (const game of all) {
        if (game == "overall") {
            continue;
        }

        document.getElementById(`${game}overall4`).style.display = display;
        document.getElementById(`${game}overallm`).style.display = display;
    }
    
    const dateStrings = document.querySelectorAll(".date, .date_empty, .datestring, .datestring_game");
    const playerDateStrings = document.querySelectorAll(".datestring_player");

    for (const dateString of dateStrings) {
        dateString.style.display = display;
    }

    for (const playerDateString of playerDateStrings) {
        playerDateString.style.display = displayPlayer;
    }
}

function toggleUnverified() {
    unverifiedEnabled = !unverifiedEnabled;
    unverifiedEnabled ? localStorage.setItem("unverifiedEnabled", true) : localStorage.removeItem("unverifiedEnabled");
    reloadTable();
}

function disableDates() {
    const alreadyDisabled = true;
    toggleDates(alreadyDisabled);
}

function shotRoute(game) {
    return game == "HRtP" || game == "GFW" ? _("Route") : _("Shottype");
}

function replayPath(game, difficulty, shottype) {
    if (game == "StB") {
        difficulty = difficulty.padStart(2, 0);
        shottype = shottype.padStart(2, 0);
    }

    return `replays/th${gameAbbr(game)}_ud${difficulty.substr(0, 2) + shottypeAbbr(shottype)}.rpy`;
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
    return `<span class='unver_container'><span class='unver'>${score}</span><span class='tooltip'>Unverified</span></span>`;
}

function verifyConditions(game) {
    if (game == selected) {
        const border = (document.getElementById(`${game}_image`).classList.contains("cover98") ? "1px solid black" : "none");
        document.getElementById("list").innerHTML = "";
        document.getElementById(`${game}_image`).style.border = border;
        selected = "";
        return false;
    }

    return true;
}

function getWRs(game) {
    let result = { "WRs": {}, "overall": { "score": 0 }, "bestShot": {} };

    for (const diff in WRs[game]) {
        result.WRs[diff] = WRs[game][diff];
        result.bestShot[diff] = { "score": 0 };

        for (const shot in result.WRs[diff]) {
            const category = result.WRs[diff][shot];
            const score = category[0];
            const player = category[1];
            const date = category[2];

            if (score > result.bestShot[diff].score) {
                result.bestShot[diff] = { "id": game + diff + shot, "score": score, "player": player, "date": date, "shottype": shot };
            }

            if (score > result.overall.score) {
                result.overall = { "id": game + diff + shot, "score": score, "player": player, "date": date };
            }
        }
    }

    return result;
}

function appendShottypeHeader(game, difficulty, shottype) {
    if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled && removeChar(shottype) == "Spring") {
        document.getElementById("list_tbody").innerHTML += `<tr id='${shottype}'><td>${_(removeSeason(shottype))}</td></tr>`;
    } else {
        document.getElementById("list_tbody").innerHTML += `<tr id='${shottype + difficulty}'><td>${_(shottype)}</td></tr>`;
    }
}

function appendShottypeHeaders(game, shots) {
    const list_tbody = document.getElementById("list_tbody");
    list_tbody.innerHTML = "";

    if (isPortrait()) {
        for (const difficulty in WRs[game]) {
            list_tbody.innerHTML += `<tr><th>${shotRoute(game)}</th><th class='${difficulty}'>${difficulty}</th></tr>`;

            if (game != "GFW" || difficulty != "Extra") {
                for (const shots of shots) {
                    appendShottypeHeader(game, difficulty, shots);
                }
            }
        }
    } else {
        document.getElementById("list_thead").innerHTML = `<tr id='list_thead_tr'><th>${shotRoute(game)}</th></tr>`;

        for (const shot of shots) {
            if (game == "HSiFS" && seasonsEnabled) {
                $("#list_tbody").append(`<tr id='${shot}'><td>${_(removeSeason(shot))}<span class='${removeChar(shot)}'>${_(removeChar(shot))}</span></td></tr>`);
            } else {
                $("#list_tbody").append(`<tr id='${shot}'><td>${_(shot)}</td></tr>`);
            }
        }
    }
}

function appendDifficultyHeaders(game, diff, shottypes) {
    const extraShots = ["Reimu", "Cirno", "Aya", "Marisa"];

    if (game == "GFW" && diff == "Extra") {
        const colspan = (isPortrait() ? "" : " colspan='4'");
        $("#list_tbody").append(`<tr id='Extra'><td>Extra</td><td id='GFWExtra-'${colspan}></td></tr>`);
    } else if (game == "HSiFS" && diff == "Extra" && seasonsEnabled) {
        const rowspan = (isPortrait() ? "" : " rowspan='4'");
        $("#list_thead_tr").append("<th class='sorttable_numeric'>Extra</th>");

        for (const shot of extraShots) {
            $(`#${shot}Spring`).append(`<td id='${game + diff + shot}'${rowspan}></td>`);
        }
    } else {
        if (!isPortrait()) {
            $("#list_thead_tr").append("<th class='sorttable_numeric'>" + diff + "</th>");
        }

        for (const shottype of shottypes) {
            if (isPortrait()) {
                $("#" + shottype + diff).append(`<td id='${game + diff + shottype}'></td>`);
            } else {
                $("#" + shottype).append(`<td id='${game + diff + shottype}'></td>`);
            }
        }
    }
}

function prepareShowWR(game, records) {
    const diffKey = (game == 'StB' || game == 'DS' ? '1' : "Easy");
    let shottypes = [];

    for (const shottype in WRs[game][diffKey]) {
        shottypes.pushStrict(seasonsEnabled ? shottype : removeSeason(shottype));
    }

    $("#list").html("<p id='fullname'></p>" +
    "<p id='toggle_season'><input id='seasons' type='checkbox'><label id='label_seasons' class='Seasons' for='seasons'>" + _("Seasons") + "</label></p>" +
    "<p><input id='unverified' type='checkbox'><label id='label_unverified' for='unverified' class='unverified'>Unverified Scores</label></p>" +
    "<table id='table' class='sortable'><thead id='list_thead'></thead><tbody id='list_tbody'></tbody></table>" +
    "<table><thead id='west_thead'></thead><tbody id='west_tbody'></tbody></table>");
    $("#seasons").on("click", toggleSeasons);
    $("#unverified").on("click", toggleUnverified);

    if (unverifiedEnabled) {
        $("#unverified").prop("checked", true);
    }

    if (selected !== "") {
        $(`#${selected}_image`).css("border", $("#" + selected + "_image").hasClass("cover98") ? "1px solid black" : "none");
    }

    $("#fullname").removeClass(selected + "f");
    $("#table").removeClass(selected + "t");
    $(`#${game}_image`).css("border", "3px solid gold");
    selected = game;
    $("#fullname").addClass(game + "f");
    $("#fullname").html(_(fullNameNumber(game)));
    $("#table").addClass(game + "t");
    appendShottypeHeaders(game, shottypes);

    for (const diff in records.WRs) {
        appendDifficultyHeaders(game, diff, shottypes);
    }
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

function showWesternRecords(game, records) {
    if (game == "StB" || game == "DS") {
        return;
    }

    document.getElementById("west_tbody").innerHTML = "";
    document.getElementById("west_thead").innerHTML = `<tr class='west_tr'><th class='world'>${_("World")}</th><th class='west'>${_("West")}</th><th class='percentage'>${_("Percentage")}</th></tr>`;

    for (const diff in westScores[game]) {
        if (westScores[game][diff].length === 0) {
            document.getElementById(game + diff).innerHTML += "<td>-</td><th>-</th>";
            continue;
        }

        let west = westScores[game][diff][0];
        const westPlayer = westScores[game][diff][1];
        let westShot = westScores[game][diff][2];
        let world = records.bestShot[diff].score;
        let worldPlayer = records.bestShot[diff].player;
        let worldShot = records.bestShot[diff].shottype;
        let isUnverified = false;

        if (unverifiedEnabled && unverifiedScores[game][diff][worldShot][0] > world) {
            const unverifiedScore = unverifiedScores[game][diff][worldShot];
            world = unverifiedScore[0];
            worldPlayer = unverifiedScore[1];
            isUnverified = true;
        }

        const percentage = (west / world * 100).toFixed(2);
        const percentageText = parseInt(percentage) == 100 ? 100 : percentage;
        west = ((game == "WBaWC" || game == "UM") && west > MAX_SCORE
                ? `<span class='cs'>9,999,999,990<span class='tooltip truescore'>${sep(west)}</span></span>`
                : sep(west)
        );
        westShot = (westShot != '-' ? `<br>(${_(westShot)})` : "");

        world = ((game == "WBaWC" || game == "UM") && world > MAX_SCORE
                ? `<span class='cs'>9,999,999,990<span class='tooltip truescore'>${sep(world)}</span></span>`
                : sep(world)
        );
        world = (isUnverified ? formatUnverified(world) : world);
        worldShot = (worldShot != '-' ? `<br>(${_(worldShot)})` : "");
        const westTable = document.getElementById("west_tbody");
        westTable.innerHTML += `<tr class='west_tr'><td colspan='3'>${diff}</td></tr>`;
        westTable.innerHTML += `<tr class='west_tr'><td>${world}<br>by <em>${worldPlayer}</em>${worldShot}</td>` +
                `<td>${west}<br>by <em>${westPlayer}</em>${westShot}</td><td class='${percentageClass(percentage)}'>(${percentageText}%)</td></tr>`;
    }
}

function showWRtable(game, records) {
    for (const diff in records.WRs) {
        for (const shot in records.WRs[diff]) {
            const id = game + diff + (game == "HSiFS" && !seasonsEnabled ? removeSeason(shot) : shot);
            const wr = records.WRs[diff][shot];
            let score = wr[0];
            let player = wr[1];
            let date = formatDate(wr[2]);
            let replay = wr[3];
            let isUnverified = false;

            if (score === 0) {
                document.getElementById(id).innerHTML = '-';
                continue;
            }

            if (!replay) {
                if (gameAbbr(game) < 6 || missingReplays.includes(game + diff + shot)) {
                    replay = "";
                } else {
                    replay = replayPath(game, diff, shot);
                }
            }

            if (unverifiedEnabled && unverifiedScores[game][diff][shot][0] > score) {
                const unverifiedScore = unverifiedScores[game][diff][shot];
                score = unverifiedScore[0];
                player = unverifiedScore[1];
                date = formatDate(unverifiedScore[2]);
                isUnverified = true;
            }

            let text = ((game == "WBaWC" || game == "UM") && score > MAX_SCORE
                    ? `<span class='cs'>9,999,999,990<span class='tooltip truescore'>${sep(score)}</span></span>`
                    : sep(score)
            );

            if (isUnverified) {
                text = formatUnverified(text);
            }

            if (replay) {
                text = `<a class='replay' href='${replay}'>${text}`;

                if (isUnverified) {
                    text += "</a>";
                } else {
                    text += "<span class='dl_icon'></span></a>";
                }
            }

            text += `<br>by <em>${player}</em>`;

            if (date && datesEnabled) {
                text += `<span class='dimgrey'><br><span class='datestring_game'>${date}</span></span>`;
            }

            document.getElementById(id).innerHTML = text;
        }
    }
}

function highlightBests(game, records) {
    for (const diff in records.bestShot) {
        const bestShot = records.bestShot[diff];

        if (game == "HSiFS" && !seasonsEnabled) {
            bestShot.id = removeSeason(bestShot.id);
        }

        document.getElementById(bestShot.id).innerHTML = "<u>" + document.getElementById(bestShot.id).innerHTML.replace("<br>", "</u><br>");
    }

    if (game == "HSiFS" && !seasonsEnabled) {
        records.overall.id = removeSeason(records.overall.id);
    }

    document.getElementById(records.overall.id).innerHTML = document.getElementById(records.overall.id).innerHTML.replace("<u>", "<u><strong>").replace("</u>", "</strong></u>");
}

function showWRs(event) {
    const game = event.data ? event.data.game : this.id.replace("_image", "");

    if (verifyConditions(game)) {
        const records = getWRs(game);
        prepareShowWR(game, records);
        showWRtable(game, records);
        highlightBests(game, records);
        showWesternRecords(game, records);
        document.getElementById("list").style.display = "block";
        document.getElementById("toggle_season").style.display = (game == "HSiFS" ? "block" : "none");
        document.getElementById("seasons").checked = seasonsEnabled;
    }
}

function addPlayerWR(playerWRs, game, difficulty, shottype, isUnverified) {
    if (!playerWRs.cats.includes(game + difficulty)) {
        const space = (language != "ja_JP" && language != "zh_CN" ? " " : "");
        document.getElementById("playerlistbody").innerHTML += `<tr>` +
                `<td class='${game}p'>${_(game)}${space}${difficulty}</td>` +
                `<td id='${game + difficulty}s'></td>` +
                `<td id='${game + difficulty}r'></td>` +
                `<td id='${game + difficulty}d' class='date_empty'></td>` +
                `</tr>`;
        playerWRs.cats.push(game + difficulty);
    }

    const shottypeText = (shottype === "" ? "" : ` (${_(shottype)})`);
    const wr = WRs[game][difficulty][shottype][0];
    let score = ((game == "WBaWC" || game == "UM") && wr > MAX_SCORE
            ? `<span class='cs'>9,999,999,990<span class='tooltip truescore'>${sep(wr)}</span></span>`
            : sep(wr)
    );
    let date = formatDate(WRs[game][difficulty][shottype][2]);
    let replay = WRs[game][difficulty][shottype][3];
    let tmp;

    if (isUnverified) {
        score = formatUnverified(sep(unverifiedScores[game][difficulty][shottype][0]));
        date = formatDate(unverifiedScores[game][difficulty][shottype][2]);
        replay = "";
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
    document.getElementById("playerlistbody").innerHTML = "";

    for (const game in WRs) {
        for (const diff in WRs[game]) {
            for (const shot in WRs[game][diff]) {
                if (WRs[game][diff][shot].includes(player)) {
                    playerWRs = addPlayerWR(playerWRs, game, diff, shot, false);
                    sum += 1;
                }
            }

            for (const shot in unverifiedScores[game][diff]) {
                if (unverifiedScores[game][diff][shot].includes(player)) {
                    playerWRs = addPlayerWR(playerWRs, game, diff, shot, true);
                    sum += 1;
                }
            }

            const scores = document.getElementById(`${game + diff}s`);
            const replays = document.getElementById(`${game + diff}r`);
            const dates = document.getElementById(`${game + diff}d`);

            if (scores) {
                scores.innerHTML = playerWRs.scores.join("<br>");
            }

            if (replays) {
                replays.innerHTML = playerWRs.replays.join("<br>");
            }

            if (dates) {
                dates.innerHTML = playerWRs.dates.join("<br>");
            }

            playerWRs.scores = [];
            playerWRs.replays = [];
            playerWRs.dates = [];
        }
    }

    if (sum === 0) {
        document.getElementById("playerlist").style.display = "none";
        return;
    }

    $(".date_empty").css("display", datesEnabled ? "table-cell" : "none");
    $(".datestring_player").css("display", datesEnabled ? "inline" : "none");
    $("#playerlistfoot").html("<tr><td colspan='4'></td></tr><tr><td class='total'>Total</td><td colspan='3'>" + sum + "</td></tr>");
    $("#playerlist").css("display", "block");
}

function reloadTable() {
    if (selected !== "") {
        const game = selected;
        selected = "";
        document.getElementById("list").innerHTML = "";
        showWRs({ data: { game: game } });
    }
}

function updateOrientation() {
    if (isMobile()) {
        reloadTable();
    }
}

function setLanguage(event) {
    const newLanguage = event.target.id || event.target.parentNode.id;

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    location.href = location.href.split('#')[0].split('?')[0];
    setCookie("lang", newLanguage);
}

function setEventListeners() {
    document.body.addEventListener("resize", updateOrientation, false);
    document.getElementById("toggle_layout").addEventListener("click", toggleLayout, false);
    document.getElementById("player").addEventListener("change", showPlayerWRs, false);
    document.getElementById("player").addEventListener("select", showPlayerWRs, false);
    document.getElementById("en_GB").addEventListener("click", setLanguage, false);
    document.getElementById("en_US").addEventListener("click", setLanguage, false);
    document.getElementById("ja_JP").addEventListener("click", setLanguage, false);
    document.getElementById("zh_CN").addEventListener("click", setLanguage, false);
    document.getElementById("ru_RU").addEventListener("click", setLanguage, false);
    document.getElementById("de_DE").addEventListener("click", setLanguage, false);
    document.getElementById("es_ES").addEventListener("click", setLanguage, false);
    document.getElementById("dates").addEventListener("click", toggleDates, false);
    const gameImg = document.querySelectorAll(".game_img");

    for (const element of gameImg) {
        element.addEventListener("click", showWRs, false);
    }
}

function setAttributes() {
    document.getElementById("newlayout").style.display = "block";
    document.getElementById("playersearch").style.display = "block";
    document.getElementById("contents_new").style.display = "table";
    document.getElementById("checkboxes").style.display = "table";
    const flags = document.querySelectorAll(".flag");
    const westernRecordsLink = document.getElementById("westernlink");
    const playerSearchLink = document.getElementById("playersearchlink");

    for (const flag of flags) {
        flag.setAttribute("href", "");
    }
    
    if (westernRecordsLink) {
        document.getElementById("westernlink").style.display = "block";
    }

    if (playerSearchLink) {
        document.getElementById("playersearchlink").style.display = "block";
    }
}

function init() {
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

    missingReplays = document.getElementById("missing_replays").value;
    datesEnabled = localStorage.getItem("datesEnabled") ? true : false;
    seasonsEnabled = localStorage.getItem("seasonsEnabled") ? true : false;
    unverifiedEnabled = localStorage.getItem("unverifiedEnabled") ? true : false;
    const missingReplaysElement = document.getElementById("missing_replays");
    missingReplaysElement.parentNode.removeChild(missingReplaysElement);
    setEventListeners();
    setAttributes();

    if (!datesEnabled) {
        disableDates();
    } else {
        document.getElementById("dates").checked = true;
    }
}

window.addEventListener("DOMContentLoaded", init, false);
