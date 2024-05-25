/*global _ MAX_SCORE isMobile setCookie getCookie deleteCookie sep fullNameNumber*/
const API_BASE = location.hostname.includes("maribelhearn.com") ? "https://maribelhearn.com" : "http://localhost";
const all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"];
const hsifsExtraShots = ["Reimu", "Cirno", "Aya", "Marisa"];
let datesEnabled, unverifiedEnabled;
let language = "en_GB";
let selected = "";
let videoEnabled = false;

function getSeason(string) {
    return string.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
}

function getCharacter(string) {
    return string.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
}

function isPortrait() {
    return window.innerHeight > window.innerWidth && isMobile();
}

function toggleLayout() {
    if (getCookie("wr_old_layout")) {
        deleteCookie("wr_old_layout");
    } else {
        setCookie("wr_old_layout", true);
    }
}

function toggleVideo() {
    videoEnabled = !videoEnabled;
    videoEnabled ? setCookie("video_enabled", true) : deleteCookie("video_enabled");
    reloadTable();
}

function setRecentLimit(event) {
    let limit = Math.max(parseInt(event.target.value), 1);

    if (limit == 15 || isNaN(limit)) {
        deleteCookie("recent_limit");
    } else {
        setCookie("recent_limit", limit);
    }
}

function saveChanges() {
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

        document.getElementById(`${game}overall6`).style.display = display;
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
    if (score.includes("cs")) {
        return `<span class='unver'>${score}</span>`;
    }

    return `<span class='unver_container'><span class='unver'>${score}</span><span class='tooltip'>Unverified</span></span>`;
}

/*function appendShottypeHeaderPortrait(game, diff, shot) {
    if (game == "HSiFS" && diff != "Extra") {
        document.getElementById("world_tbody").innerHTML += `<tr id='${shot + diff}'><td>${_(getCharacter(shot))}<span class='${getSeason(shot)}'>${_(getSeason(shot))}</span></td></tr>`;
    } else {
        document.getElementById("world_tbody").innerHTML += `<tr id='${shot + diff}'><td>${_(shot)}</td></tr>`;
    }
}*/

function appendShottypeHeaders(game, shots) {
    const worldTable = document.getElementById("world_tbody");
    worldTable.innerHTML = "";

    /*if (isPortrait()) {
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
    } else {*/
        document.getElementById("world_thead").innerHTML = `<tr id='world_thead_tr'><th>${shotRoute(game)}</th></tr>`;

        for (const shot of shots) {
            if (game == "HSiFS") {
                worldTable.innerHTML += `<tr id='${shot}'><td>${_(getCharacter(shot))}<span class='${getSeason(shot)}'>${_(getSeason(shot))}</span></td></tr>`;
            } else {
                worldTable.innerHTML += `<tr id='${shot}'><td>${_(shot)}</td></tr>`;
            }
        }
    //}
}

function appendDifficultyHeaders(game, diff, shots) {
    const worldTableHeaderRow = document.getElementById("world_thead_tr");

    if (game == "GFW" && diff == "Extra") {
        const colspan = (isPortrait() ? "" : " colspan='4'");
        document.getElementById("world_tbody").innerHTML += `<tr id='Extra'><td>Extra</td><td id='GFWExtra-'${colspan}></td></tr>`;
    } else if (game == "HSiFS" && diff == "Extra") {
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

function prepareShowWR(game) {
    //const diffKey = (game == 'StB' || game == 'DS' ? '1' : "Easy");
    const diffs = JSON.parse(document.getElementById("diffs").value)[game];
    const shots = JSON.parse(document.getElementById("shots").value)[game];

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

    for (const diff of diffs) {
        appendDifficultyHeaders(game, diff, shots);
    }
}

function formatDate(date) {
    if (language == "ja_JP" || language == "zh_CN") {
        date = new Date(date).toLocaleString(language.replace('_', '-'), {"dateStyle": "long"});
    } else {
        date = new Date(date).toLocaleString(language.replace('_', '-'), {"year": "numeric", "month": "2-digit", "day": "2-digit"});
    }

    return date;
}

function showWesternRecords(game, overalls, westScores) {
    /*if (game == "StB" || game == "DS") {
        return;
    }*/

    const westTable = document.getElementById("west_tbody");
    westTable.innerHTML = "";

    if (westScores.length === 0) {
        document.getElementById("west").style.display = "none";
        return;
    } else {
        document.getElementById("west").style.display = "table";
    }

    for (const data of westScores) {
        let west = data.score;
        const westPlayer = data.player;
        const diff = data.category.difficulty;
        let westShot = data.category.shot;
        let world = overalls[diff].score;
        let worldPlayer = overalls[diff].player;
        let worldShot = overalls[diff].category.shot;

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
        world = (overalls[diff].verified ? world : formatUnverified(world));
        worldShot = (worldShot != '-' ? `<br>(${_(worldShot)})` : "");
        westTable.innerHTML += `<tr class='irregular_tr'><td colspan='3'>${diff}</td></tr>`;
        westTable.innerHTML += `<tr class='irregular_tr'><td>${world}<br>by <em>${worldPlayer}</em>${worldShot}</td>` +
                `<td>${west}<br>by <em>${westPlayer}</em>${westShot}</td><td class='${percentageClass(percentage)}'>(${percentageText}%)</td></tr>`;
    }
}

function getWesternRecords(game, overalls) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?type=Score&game=${game}&ordering=difficulty&region=Western`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const westScores = JSON.parse(this.response);
                showWesternRecords(game, overalls, westScores);
            }
        }
    }

    xhr.send();
}

function getWRs(game) {
    const gameImg = document.querySelectorAll(".game_img");
    let verification = "";

    if (!unverifiedEnabled) {
        verification = "&verified=true";
    }

    for (const element of gameImg) {
        element.removeEventListener("click", showWRs);
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?type=Score&game=${game}&ordering=-score&region=Eastern${verification}`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const records = JSON.parse(this.response);
                prepareShowWR(game);
                showWRtable(game, records);
                const overalls = highlightBests(game, records);
                getWesternRecords(game, overalls);
            
                for (const element of gameImg) {
                    element.addEventListener("click", showWRs, false);
                }
            }
        }
    }

    xhr.send();
}

function showWRtable(game, records) {
    let currentScore = {};

    for (const data of records) {
        const score = data.score;
        const player = data.player;
        const date = formatDate(data.date);
        //let video = data.video;

        const diff = data.category.difficulty;
        const shot = data.category.shot;
        //let isUnverified = false;

        //const chara = getCharacter(shot);
        let id = game + diff + shot;

        if (score <= currentScore[id]) {
            continue;
        }

        if (score === 0) {
            document.getElementById(id).innerHTML = '-';
            continue;
        }

        let text = ((game == "WBaWC" || game == "UM") && score > MAX_SCORE
                ? `<span class='cs'>9,999,999,990<span class='tooltip truescore'>${sep(score)}</span></span>`
                : sep(score)
        );

        if (!data.verified) {
            text = formatUnverified(text);
        }

        if (data.replay) {
            text = `<a class='replay' href='${data.replay.replace("/replays", "/media/replays")}'>${text}<span class='dl_icon'></span></a>`;
        }

        text += `<br>by <em>${player}</em>`;

        if (date && datesEnabled && date != "01/01/1970") {
            text += `<span class='dimgrey'><br><span class='datestring_game'>${date}</span></span>`;
        }

        if (game == "GFW" && diff == "Extra") {
            id = "GFWExtra-";
        }

        document.getElementById(id).innerHTML = text;
        currentScore[id] = score;
    }
}

function highlightBests(game, records) {
    const overalls = {};
    const sortedRecords = records.sort(function (a, b) { return a.score <= b.score; });
    const overallRecord = document.getElementById(game + sortedRecords[0].category.difficulty + sortedRecords[0].category.shot);
    overallRecord.innerHTML = "<u><strong>" + overallRecord.innerHTML.replace("<br>", "</strong></u><br>");
    overalls[sortedRecords[0].category.difficulty] = sortedRecords[0];

    for (let i = 1; i < sortedRecords.length; i++) {
        const category = sortedRecords[i].category;

        if (!overalls.hasOwnProperty(category.difficulty)) {
            let id = game + category.difficulty + category.shot;

            if (game == "GFW" && category.difficulty == "Extra") {
                id = "GFWExtra-";
            }

            const diffRecord = document.getElementById(id);
            diffRecord.innerHTML = "<u>" + diffRecord.innerHTML.replace("<br>", "</u><br>");
            overalls[category.difficulty] = sortedRecords[i];
        }
    }

    return overalls;
}

function showWRs(event) {
    const game = event.data ? event.data.game : this.id.replace("_image", "");

    if (game != selected) {
        getWRs(game);
        document.getElementById("wr_list").style.display = "block";
    } else {
        const gameImg = document.getElementById(`${game}_image`);
        const border = (gameImg.classList.contains("cover98") ? "1px solid black" : "none");
        gameImg.style.border = border;
        document.getElementById("world").classList.remove(`${game}t`);
        document.getElementById("wr_list").style.display = "none";
        selected = "";
    }
}

function setPlayer(event) {
    const player = event.target.value;
    document.getElementById("player").value = player;
    getPlayerWRs(player);
}

function showPlayerWRs(player, records) {
    const playerList = document.getElementById("player_list");

    if (player === "") {
        playerList.style.display = "none";
        return;
    }

    let numberOfWRs = 0;
    let currentGame = "";
    let currentDiff = "";
    let first;
    const playerTable = document.getElementById("player_tbody");
    playerTable.innerHTML = "";

    for (const data of records) {
        const game = data.category.game;
        const diff = data.category.difficulty;
        let replay, video, date;

        if (currentGame != game) {
            if (currentGame !== "" && currentDiff !== "") {
                document.getElementById(`${currentGame}${currentDiff}d`).setAttribute("data-sort", first.toISOString().split("T")[0].replace(/-/g, ""));
            }

            currentGame = game;
            currentDiff = diff;
            playerTable.innerHTML += `<tr><td class='${game}p'>${_(game)} ${diff}</td><td id='${game}${diff}s'></td><td id='${game}${diff}t'></td><td id='${game}${diff}r'></td><td id='${game}${diff}v'></td><td id='${game}${diff}d'></td></tr>`;
            first = new Date("9999/12/31");
        } else if (currentDiff != diff) {
            if (currentGame !== "" && currentDiff !== "") {
                document.getElementById(`${currentGame}${currentDiff}d`).setAttribute("data-sort", first.toISOString().split("T")[0].replace(/-/g, ""));
            }

            currentDiff = diff;
            playerTable.innerHTML += `<tr><td class='${game}p'>${_(game)} ${diff}</td><td id='${game}${diff}s'></td><td id='${game}${diff}t'></td><td id='${game}${diff}r'></td><td id='${game}${diff}v'></td><td id='${game}${diff}d'></td></tr>`;
            first = new Date("9999/12/31");
        }

        if (!data.replay) {
            replay = '-';
        } else {
            replay = `<a href='${data.replay.replace("/replays", "/media/replays")}'>${data.replay.split('/')[data.replay.split('/').length - 1]}</a>`;
        }

        if (!data.video) {
            video = '-';
        } else {
            video = `<a href='${data.video}'>Video link</a>`;
        }

        if (new Date(data.date) < first) {
            first = new Date(data.date);
        }

        date = formatDate(new Date(data.date));

        if (date == "01/01/1970") {
            date = _("Unknown");
        }

        document.getElementById(`${game}${diff}s`).innerHTML += sep(data.score) + "<br>";
        document.getElementById(`${game}${diff}t`).innerHTML += _(data.category.shot) + "<br>";
        document.getElementById(`${game}${diff}r`).innerHTML += replay + "<br>";
        document.getElementById(`${game}${diff}v`).innerHTML += video + "<br>";
        document.getElementById(`${game}${diff}d`).innerHTML += date + "<br>";
        numberOfWRs += 1;
    }

    if (numberOfWRs === 0) {
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

    document.getElementById("player_sum").innerHTML = numberOfWRs;
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

function getPlayerWRs(player) {
    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?ordering=game,difficulty&player=${encodeURIComponent(player)}&type=Score&region=Eastern&verified=true`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const records = JSON.parse(this.response);
                showPlayerWRs(player, records);
            }
        }
    }

    xhr.send();
}

function detectEnter(event) {
    if (event.key && event.key == "Enter") {
        const player = event.target.value;
        getPlayerWRs(player);
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
    document.getElementById("recent_limit").addEventListener("keyup", setRecentLimit, false);
    document.getElementById("recent_limit").addEventListener("mouseup", setRecentLimit, false);
    document.getElementById("save_changes").addEventListener("click", saveChanges, false);
    document.getElementById("search").addEventListener("change", setPlayer, false);
    document.getElementById("search").addEventListener("select", setPlayer, false);
    document.getElementById("player").addEventListener("change", getPlayerWRs, false);
    document.getElementById("player").addEventListener("keypress", detectEnter, false);
    document.getElementById("en_GB").addEventListener("click", setLanguage, false);
    document.getElementById("en_US").addEventListener("click", setLanguage, false);
    document.getElementById("ja_JP").addEventListener("click", setLanguage, false);
    document.getElementById("zh_CN").addEventListener("click", setLanguage, false);
    document.getElementById("ru_RU").addEventListener("click", setLanguage, false);
    document.getElementById("de_DE").addEventListener("click", setLanguage, false);
    document.getElementById("es_ES").addEventListener("click", setLanguage, false);
    document.getElementById("dates").addEventListener("click", toggleDates, false);
    document.getElementById("unverified").addEventListener("click", toggleUnverified, false);
    document.getElementById("toggle_video").addEventListener("click", toggleVideo, false);
    const gameImg = document.querySelectorAll(".game_img");

    for (const element of gameImg) {
        element.addEventListener("click", showWRs, false);
    }
}

function setAttributes() {
    if (!getCookie("wr_old_layout")) {
        document.getElementById("newlayout").style.display = "block";
        document.getElementById("contents_new").style.display = "block";
    }
    
    document.getElementById("player_search").style.display = "block";
    document.getElementById("checkboxes").style.display = "block";
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
        const players = document.getElementById("search").children;

        for (const option of players) {
            const player = option.value;

            if (hash == player) {
                document.getElementById("player").value = player;
                document.getElementById("player_search").scrollIntoView();
                getPlayerWRs(player);
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

    datesEnabled = localStorage.getItem("datesEnabled") ? true : false;
    unverifiedEnabled = localStorage.getItem("unverifiedEnabled") ? true : false;
    setEventListeners();
    setAttributes();

    if (getCookie("prefer_video")) {
        videoEnabled = Boolean(getCookie("prefer_video"));
        document.getElementById("toggle_video").checked = videoEnabled;
    }

    if (!datesEnabled) {
        disableDates();
    } else {
        document.getElementById("dates").checked = true;
    }

    const player = document.getElementById("player").value;

    if (player !== "") {
        getPlayerWRs(player);
    }

    checkHash();
    document.getElementById("number_of_wrs").click();
}

window.addEventListener("DOMContentLoaded", init, false);
window.addEventListener("hashchange", checkHash, false);
