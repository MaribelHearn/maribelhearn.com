/*global _ WRs westScores unverifiedScores MAX_SCORE isMobile setCookie getCookie deleteCookie gameAbbr shottypeAbbr sep fullNameNumber*/
const all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"];
const hsifsExtraShots = ["Reimu", "Cirno", "Aya", "Marisa"];
let seasonsEnabled, datesEnabled, unverifiedEnabled;
let language = "en_GB";
let selected = "";
let missingReplays = "";
let preferVideo = false;


function getSeason(string) {
    return string.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
}

function getCharacter(string) {
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

function toggleVideo() {
    preferVideo = !preferVideo;

    if (preferVideo) {
        setCookie("prefer_video", true);
    } else {
        deleteCookie("prefer_video");
    }

    const player = document.getElementById("player").value;
    location.reload();
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
        const overallMobile = document.getElementById(`${game}overallm`);
    
        if (overallMobile) {
            overallMobile.style.display = display;
        }
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

function appendShottypeHeaderPortrait(game, diff, shot) {
    if (game == "HSiFS" && diff != "Extra" && seasonsEnabled) {
        document.getElementById("world_tbody").innerHTML += `<tr id='${shot + diff}'><td>${_(getCharacter(shot))}<span class='${getSeason(shot)}'>${_(getSeason(shot))}</span></td></tr>`;
    } else {
        document.getElementById("world_tbody").innerHTML += `<tr id='${shot + diff}'><td>${_(shot)}</td></tr>`;
    }
}

function appendShottypeHeaders(game, shots) {
    const worldTable = document.getElementById("world_tbody");
    worldTable.innerHTML = "";

    if (isPortrait()) {
        for (const diff in WRs[game]) {
            worldTable.innerHTML += `<tr><th>${shotRoute(game)}</th><th class='${diff}'>${diff}</th></tr>`;

            if (game == "HSiFS" && diff == "Extra") {
                shots = hsifsExtraShots;
            }
            
            if (game != "GFW" || diff != "Extra") {
                for (const shot of shots) {
                    appendShottypeHeaderPortrait(game, diff, shot);
                }
            }
        }
    } else {
        document.getElementById("world_thead").innerHTML = `<tr id='world_thead_tr'><th>${shotRoute(game)}</th></tr>`;

        for (const shot of shots) {
            if (game == "HSiFS" && seasonsEnabled) {
                worldTable.innerHTML += `<tr id='${shot}'><td>${_(getCharacter(shot))}<span class='${getSeason(shot)}'>${_(getSeason(shot))}</span></td></tr>`;
            } else {
                worldTable.innerHTML += `<tr id='${shot}'><td>${_(shot)}</td></tr>`;
            }
        }
    }
}

function appendDifficultyHeaders(game, diff, shots) {
    const worldTableHeaderRow = document.getElementById("world_thead_tr");

    if (game == "GFW" && diff == "Extra") {
        const colspan = (isPortrait() ? "" : " colspan='4'");
        document.getElementById("world_tbody").innerHTML += `<tr id='Extra'><td>Extra</td><td id='GFWExtra-'${colspan}></td></tr>`;
    } else if (game == "HSiFS" && diff == "Extra" && seasonsEnabled) {
        if (!isPortrait()) {
            worldTableHeaderRow.innerHTML += "<th class='sorttable_numeric'>Extra</th>";
        }

        for (const shot of hsifsExtraShots) {
            const id = (isPortrait() ? `${shot}${diff}` : `${shot}Spring`);
            const rowspan = (isPortrait() ? "" : " rowspan='4'");
            document.getElementById(id).innerHTML += `<td id='${game + diff + shot}'${rowspan}></td>`;
        }
    } else {
        if (!isPortrait()) {
            worldTableHeaderRow.innerHTML += `<th class='sorttable_numeric'>${diff}</th>`;
        }

        for (const shot of shots) {
            const id = (isPortrait() ? shot + diff : shot);
            document.getElementById(id).innerHTML += `<td id='${game + diff + shot}'></td>`;
        }
    }
}

function prepareShowWR(game, records) {
    const diffKey = (game == 'StB' || game == 'DS' ? '1' : "Easy");
    let shots = [];

    for (const shot in WRs[game][diffKey]) {
        shots.pushStrict(seasonsEnabled ? shot : getCharacter(shot));
    }

    if (unverifiedEnabled) {
        document.getElementById("unverified").checked = true;
    }

    if (selected !== "") {
        const selectedImg = document.getElementById(`${selected}_image`);
        const border = selectedImg.classList.contains("cover98") ? "1px solid black" : "none";
        selectedImg.style.border = border;
    }

    const wrTable = document.getElementById("world");
    wrTable.classList.remove(`${selected}t`);
    wrTable.classList.add(`${game}t`);
    selected = game;
    document.getElementById(`${game}_image`).style.border = "3px solid gold";
    document.getElementById("fullname").innerHTML = fullNameNumber(game);
    appendShottypeHeaders(game, shots);

    for (const diff in records.WRs) {
        appendDifficultyHeaders(game, diff, shots);
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
        westTable.innerHTML += `<tr class='irregular_tr'><td colspan='3'>${diff}</td></tr>`;
        westTable.innerHTML += `<tr class='irregular_tr'><td>${world}<br>by <em>${worldPlayer}</em>${worldShot}</td>` +
                `<td>${west}<br>by <em>${westPlayer}</em>${westShot}</td><td class='${percentageClass(percentage)}'>(${percentageText}%)</td></tr>`;
    }
}

function bestSeason(diff, shot) {
    const shots = WRs.HSiFS[diff];
    let max = 0;
    let season;

    for (const key in shots) {
        if (!key.includes(shot)) {
            continue;
        }

        if (shots[key][0] > max) {
            season = key.replace(shot, "");
            max = shots[key][0];
        }
    }

    return season;
}

function showWRtable(game, records) {
    for (const diff in records.WRs) {
        for (const shot in records.WRs[diff]) {
            const chara = getCharacter(shot);
            const id = game + diff + (game == "HSiFS" && !seasonsEnabled ? chara : shot);
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
            
            if (game == "HSiFS" && !seasonsEnabled && getSeason(shot) != bestSeason(diff, chara)) {
                continue;
            }

            if (!replay) {
                if (gameAbbr(game) < 6 || missingReplays.includes(game + diff + shot)) {
                    replay = "";
                } else {
                    replay = replayPath(game, diff, shot);
                }
            } else if (!preferVideo && gameAbbr(game) >= 6 && !missingReplays.includes(game + diff + shot)) {
                replay = replayPath(game, diff, shot);
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
            bestShot.id = getCharacter(bestShot.id);
        }

        const shotRecord = document.getElementById(bestShot.id);
        shotRecord.innerHTML = "<u>" + shotRecord.innerHTML.replace("<br>", "</u><br>");
    }

    if (game == "HSiFS" && !seasonsEnabled) {
        records.overall.id = getCharacter(records.overall.id);
    }

    const overallRecord = document.getElementById(records.overall.id);
    overallRecord.innerHTML = overallRecord.innerHTML.replace("<u>", "<u><strong>").replace("</u>", "</strong></u>");
}

function showWRs(event) {
    const game = event.data ? event.data.game : this.id.replace("_image", "");

    if (game != selected) {
        const records = getWRs(game);
        prepareShowWR(game, records);
        showWRtable(game, records);
        highlightBests(game, records);
        showWesternRecords(game, records);
        document.getElementById("wr_list").style.display = "block";
        document.getElementById("toggle_season").style.display = (game == "HSiFS" ? "block" : "none");
        document.getElementById("seasons").checked = seasonsEnabled;
    } else {
        const gameImg = document.getElementById(`${game}_image`);
        const border = (gameImg.classList.contains("cover98") ? "1px solid black" : "none");
        gameImg.style.border = border;
        document.getElementById("world").classList.remove(`${game}t`);
        document.getElementById("wr_list").style.display = "none";
        selected = "";
    }
}

function addPlayerWR(playerWRs, game, diff, shot, isUnverified) {
    if (!playerWRs.cats.includes(game + diff)) {
        const space = (language != "ja_JP" && language != "zh_CN" ? " " : "");
        document.getElementById("player_tbody").innerHTML += `<tr>` +
                `<td class='${game}p'>${_(game)}${space}${diff}</td>` +
                `<td id='${game + diff}s'></td>` +
                `<td id='${game + diff}t'></td>` +
                `<td id='${game + diff}r'></td>` +
                `<td id='${game + diff}d' class='date_empty'></td>` +
                `</tr>`;
        playerWRs.cats.push(game + diff);
    }

    const wr = WRs[game][diff][shot][0];
    let score = ((game == "WBaWC" || game == "UM") && wr > MAX_SCORE
            ? `<span class='cs'>9,999,999,990<span class='tooltip truescore'>${sep(wr)}</span></span>`
            : sep(wr)
    );
    let date = formatDate(WRs[game][diff][shot][2]);
    let replay = WRs[game][diff][shot][3];
    let tmp;

    if (isUnverified) {
        score = formatUnverified(sep(unverifiedScores[game][diff][shot][0]));
        date = formatDate(unverifiedScores[game][diff][shot][2]);
        replay = "";
    }

    playerWRs.raw.push(wr);
    playerWRs.scores.push(score);
    playerWRs.shots.push(_(shot));
    playerWRs.dates.push(`<span class='datestring_player'>${date}</span>`);

    if (preferVideo && replay) {
        playerWRs.replays.push(`<a href='${replay}' target='_blank'>Video link</a>`);
    } else if (gameAbbr(game) < 6 || missingReplays.includes(game + diff + shot) || isUnverified) {
        if (replay) {
            playerWRs.replays.push(`<a href='${replay}' target='_blank'>Video link</a>`);
        } else {
            playerWRs.replays.push('-');
        }
    } else {
        replay = replayPath(game, diff, shot);
        tmp = replay.split('/');
        playerWRs.replays.push(`<a href='${location.origin}/${replay}'>${tmp[tmp.length - 1]}</a>`);
    }

    return playerWRs;
}

function showPlayerWRs(player) {
    const playerList = document.getElementById("player_list");

    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    if (player === "") {
        playerList.style.display = "none";
        return;
    }

    let playerWRs = {"raw": [], "scores": [], "shots": [], "replays": [], "dates": [], "cats": []};
    let sum = 0;
    document.getElementById("player_tbody").innerHTML = "";

    for (const game in WRs) {
        for (const diff in WRs[game]) {
            let diffSum = 0;

            for (const shot in WRs[game][diff]) {
                if (WRs[game][diff][shot].includes(player)) {
                    playerWRs = addPlayerWR(playerWRs, game, diff, shot, false);
                    diffSum += 1;
                    sum += 1;
                }
            }

            for (const shot in unverifiedScores[game][diff]) {
                if (unverifiedScores[game][diff][shot].includes(player) && !playerWRs.raw.includes(unverifiedScores[game][diff][shot][0])) {
                    playerWRs = addPlayerWR(playerWRs, game, diff, shot, true);
                    diffSum += 1;
                    sum += 1;
                }
            }

            if (diffSum === 0) {
                continue;
            }

            const scores = document.getElementById(`${game + diff}s`);
            const shots = document.getElementById(`${game + diff}t`);
            const replays = document.getElementById(`${game + diff}r`);
            const dates = document.getElementById(`${game + diff}d`);
            scores.innerHTML = playerWRs.scores.join("<br>");
            shots.innerHTML = playerWRs.shots.join("<br>");
            replays.innerHTML = playerWRs.replays.join("<br>");
            dates.innerHTML = playerWRs.dates.join("<br>");
            playerWRs.raw = [];
            playerWRs.scores = [];
            playerWRs.shots = [];
            playerWRs.replays = [];
            playerWRs.dates = [];
        }
    }

    if (sum === 0) {
        playerList.style.display = "none";
        return;
    }

    const dateEmpty = document.querySelectorAll(".date_empty");
    const dateStringPlayer = document.querySelectorAll(".datestring_player");

    for (const element of dateEmpty) {
        element.style.display = (datesEnabled ? "table-cell" : "none");
    }

    for (const element of dateStringPlayer) {
        element.style.display = (datesEnabled ? "inline" : "none");
    }

    document.getElementById("player_sum").innerHTML = sum;
    playerList.style.display = "block";
}

function reloadTable() {
    if (selected !== "") {
        const game = selected;
        selected = "";
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
    document.getElementById("toggle_video").addEventListener("click", toggleVideo, false);
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
    document.getElementById("seasons").addEventListener("click", toggleSeasons, false);
    document.getElementById("unverified").addEventListener("click", toggleUnverified, false);
    const gameImg = document.querySelectorAll(".game_img");

    for (const element of gameImg) {
        element.addEventListener("click", showWRs, false);
    }
}

function setAttributes() {
    if (!getCookie("wr_old_layout")) {
        document.getElementById("newlayout").style.display = "block";
        document.getElementById("contents_new").style.display = "inline-block";
    }
    
    document.getElementById("playersearch").style.display = "block";
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

function checkHash() {
    // player in hash links to player WRs
    if (location.hash !== "") {
        const hash = decodeURIComponent(location.hash.substring(1));
        const players = document.getElementById("player").children;

        for (const option of players) {
            const player = option.value;

            if (hash == player) {
                document.getElementById("player").value = player;
                document.getElementById("playersearch").scrollIntoView();
                showPlayerWRs(player);
                break;
            }
        }
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
    
    if (getCookie("prefer_video")) {
        preferVideo = Boolean(getCookie("prefer_video"));
        document.getElementById("toggle_video").checked = preferVideo;
    }

    if (!datesEnabled) {
        disableDates();
    } else {
        document.getElementById("dates").checked = true;
    }

    checkHash();
}

window.addEventListener("DOMContentLoaded", init, false);
window.addEventListener("hashchange", checkHash, false);
