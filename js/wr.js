/*global _ MAX_SCORE setCookie getCookie deleteCookie sep fullNameNumber*/
const API_BASE = location.hostname.includes("maribelhearn.com") ? "https://maribelhearn.com" : "http://localhost";
const hsifsExtraShots = ["Reimu", "Cirno", "Aya", "Marisa"];
let language = "en_GB";
let selected = "";
let videoEnabled = false;
let westernEnabled = false;
let unverifiedEnabled = false;

function getSeason(string) {
    return string.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
}

function getCharacter(string) {
    return string.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
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

function toggleWestern() {
    westernEnabled = !westernEnabled;
    westernEnabled ? localStorage.setItem("westernEnabled", true) : localStorage.removeItem("westernEnabled");
    reloadTable();
}

function toggleUnverified() {
    unverifiedEnabled = !unverifiedEnabled;
    unverifiedEnabled ? localStorage.setItem("unverifiedEnabled", true) : localStorage.removeItem("unverifiedEnabled");
    reloadTable();
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

function appendShottypeHeaders(game, shots) {
    const worldTable = document.getElementById("world_tbody");
    worldTable.innerHTML = "";
    document.getElementById("world_thead").innerHTML = `<tr id='world_thead_tr'><th>${shotRoute(game)}</th></tr>`;

    for (const shot of shots) {
        if (game == "HSiFS") {
            worldTable.innerHTML += `<tr id='${shot}'><td>${_(getCharacter(shot))}<span class='${getSeason(shot)}'>${_(getSeason(shot))}</span></td></tr>`;
        } else {
            worldTable.innerHTML += `<tr id='${shot}'><td>${_(shot)}</td></tr>`;
        }
    }
}

function appendDifficultyHeaders(game, diff, shots) {
    const worldTableHeaderRow = document.getElementById("world_thead_tr");

    if (game == "GFW" && diff == "Extra") {
        document.getElementById("world_tbody").innerHTML += `<tr id='Extra'><td>Extra</td><td id='GFWExtra-' colspan='4'></td></tr>`;
    } else if (game == "HSiFS" && diff == "Extra") {
        worldTableHeaderRow.innerHTML += "<th class='sorttable_numeric'>Extra</th>";

        for (const shot of hsifsExtraShots) {
            document.getElementById(`${shot}Spring`).innerHTML += `<td id='${game + diff + shot}' rowspan='4'></td>`;
        }
    } else {
        worldTableHeaderRow.innerHTML += `<th class='sorttable_numeric'>${diff}</th>`;

        for (const shot of shots) {
            document.getElementById(shot).innerHTML += `<td id='${game + diff + shot}'></td>`;
        }
    }
}

function prepareShowWR(game) {
    //const diffKey = (game == 'StB' || game == 'DS' ? '1' : "Easy");
    const diffs = JSON.parse(document.getElementById("diffs").value)[game];
    const shots = JSON.parse(document.getElementById("shots").value)[game];

    if (westernEnabled) {
        document.getElementById("western").checked = true;
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
    const westTable = document.getElementById("west");
    wrTable.classList.remove(`${selected}t`);
    wrTable.classList.add(`${game}t`);
    westTable.classList.remove(`${selected}t`);
    westTable.classList.add(`${game}t`);
    selected = game;
    document.getElementById(`${game}_image`).style.border = "3px solid gold";
    document.getElementById("fullname").innerHTML = fullNameNumber(game);
    appendShottypeHeaders(game, shots);

    for (const diff of diffs) {
        appendDifficultyHeaders(game, diff, shots);
    }
}

function formatDate(date, raw) {
    if (raw) {
        return date.toLocaleString("en-GB", {"year": "numeric", "month": "2-digit", "day": "2-digit"}).split('/').reverse().join("");
    } else if (language == "ja_JP" || language == "zh_CN") {
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

    const west = document.getElementById("west");
    const westTable = document.getElementById("west_tbody");
    westTable.innerHTML = "";

    if (westScores.length === 0) {
        west.style.display = "none";
        return;
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

    west.style.display = "table";
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
    xhr.open('GET', `${API_BASE}/api/v1/replay/?type=Score&game=${game}&ordering=-date&region=Eastern&historical=false${verification}`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const records = JSON.parse(this.response);
                prepareShowWR(game);
                showWRtable(game, records);
                const overalls = highlightBests(game, records);
                getHistoryCategories(game);

                if (westernEnabled) {
                    getWesternRecords(game, overalls);
                } else {
                    document.getElementById("west").style.display = "none";
                }
            
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

        const diff = data.category.difficulty;
        const shot = data.category.shot;

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

        if (videoEnabled && data.video) {
            text = `<a class='replay' href='${data.video}' target='_blank'>${text}<span class='dl_icon'></span></a>`;
        } else if (data.replay) {
            text = `<a class='replay' href='${data.replay.replace("com/replays", "com/media/replays")}'>${text}<span class='dl_icon'></span></a>`;
        } else if (data.video) {
            text = `<a class='replay' href='${data.video}' target='_blank'>${text}<span class='dl_icon'></span></a>`;
        }

        text += `<br>by <em>${player}</em>`;

        if (date && date != "01/01/1970") {
            text += `<span class='dimgrey'><br>${date}</span>`;
        }

        if (game == "GFW" && diff == "Extra") {
            id = "GFWExtra-";
        }

        if (game == "HSiFS" && diff == "Extra") {
            id += "";
        }

        document.getElementById(id).innerHTML = text;
        currentScore[id] = score;
    }
}

function highlightBests(game, records) {
    const overalls = {};
    const sortedRecords = records.sort(function (a, b) { return b.score - a.score; });
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

function getHistoryCategories(game) {
    const historyCategory = document.getElementById("history_category");
    historyCategory.innerHTML = "<option value=''>...</option>";

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/category/?game=${game}&type=Score&region=Eastern`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const categories = JSON.parse(this.response);
                
                for (const category of categories) {
                    if (game == "GFW" && category.difficulty == "Extra") {
                        continue;
                    }

                    const categoryString = `${game} ${category.difficulty} ${category.shot}`;
                    historyCategory.innerHTML += `<option value='${categoryString}'>${_(category.difficulty)}${_(' ')}${_(category.shot)}</option>`;

                    if (game == "GFW" && category.difficulty == "Lunatic" && category.shot == "C2") {
                        historyCategory.innerHTML += `<option value='GFW Extra A1'>Extra</option>`;
                    }
                }
            }
        }
    }

    xhr.send();
}

function showWRs(event) {
    const game = event.data ? event.data.game : this.id.replace("_image", "");

    if (game != selected) {
        getWRs(game);
        document.getElementById("wr_list").style.display = "block";
        document.getElementById("history_table").classList.remove(`${selected}t`);
        document.getElementById("history_list").style.display = "none";
    } else {
        const gameImg = document.getElementById(`${game}_image`);
        const border = (gameImg.classList.contains("cover98") ? "1px solid black" : "none");
        gameImg.style.border = border;
        document.getElementById("world").classList.remove(`${game}t`);
        document.getElementById("wr_list").style.display = "none";
        selected = "";
    }
}

function reloadTable() {
    if (selected !== "") {
        const game = selected;
        selected = "";
        showWRs({ data: { game: game } });
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
            playerTable.innerHTML += `<tr><td class='${game}p'>${_(game)}${_(' ')}${diff}</td><td id='${game}${diff}s'></td><td id='${game}${diff}t'></td><td id='${game}${diff}r'></td><td id='${game}${diff}v'></td><td id='${game}${diff}d'></td></tr>`;
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
            replay = `<a href='${data.replay}'>${data.replay.split('/')[data.replay.split('/').length - 1]}</a>`;
        }

        if (!data.video) {
            video = '-';
        } else {
            video = `<a href='${data.video}' target='_blank'>${_("Link")}</a>`;
        }

        if (new Date(data.date) < first) {
            first = new Date(data.date);
        }

        date = (!data.date ? _("Unknown") : formatDate(new Date(data.date)));

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

    document.getElementById("player_sum").innerHTML = numberOfWRs;
    playerList.style.display = "block";
}

function getPlayerWRs(player) {
    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?ordering=game,difficulty&player=${encodeURIComponent(player)}&type=Score&region=Eastern&verified=true&historical=false`);
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

function showHistory(category, game, records, idSuffix) {
    const noHistory = document.getElementById(`no_history${idSuffix}`);
    const historyTable = document.getElementById(`history_table${idSuffix}`);
    const historyBody = document.getElementById(`history_tbody${idSuffix}`);
    let numberOfWRs = 0;
    historyBody.innerHTML = "";

    for (const data of records) {
        let replay, video, shot, date;

        if (!data.replay) {
            replay = '-';
        } else {
            replay = `<a href='${data.replay}'>${data.replay.split('/')[data.replay.split('/').length - 1]}</a>`;
        }

        if (!data.video) {
            video = '-';
        } else {
            video = `<a href='${data.video}' target='_blank'>${_("Link")}</a>`;
        }

        shot = (game == "GFW" && data.category.difficulty == "Extra" ? '-' : _(data.category.shot));
        date = (!data.date ? _("Unknown") : formatDate(new Date(data.date)));
        historyBody.innerHTML += "<tr id='" + data.score + "'></tr>";
        document.getElementById(data.score).innerHTML = `<td>${sep(data.score)}</td>`;
        document.getElementById(data.score).innerHTML += `<td>${data.player}</td>`;
        document.getElementById(data.score).innerHTML += `<td>${shot}</td>`;
        document.getElementById(data.score).innerHTML += `<td>${replay}</td>`;
        document.getElementById(data.score).innerHTML += `<td>${video}</td>`;
        document.getElementById(data.score).innerHTML += `<td>${date}</td>`;
        numberOfWRs += 1;
    }

    if (numberOfWRs === 0) {
        noHistory.style.display = "block";
        historyTable.style.display = "none";
        return;
    }

    if (historyTable.classList.length > 1) {
        historyTable.classList.remove(historyTable.classList[1]);
    }

    noHistory.style.display = "none";
    historyTable.classList.add(`${game}t`);
    historyTable.style.display = "table";
}

function getHistory(category) {
    let idSuffix;

    if (typeof category == "object") {
        category = this.value; // if event listener fired
        idSuffix = this.id.includes("old") ? "_old" : "";
    }

    if (category === "") {
        document.getElementById(`history_list${idSuffix}`).style.display = "none";
        return;
    }

    document.getElementById(`history_list${idSuffix}`).style.display = "block";

    let tmp = category.split(' ');
    const game = tmp[0];
    const diff = tmp[1];
    tmp.splice(0, 1);
    tmp.splice(0, 1);
    const shot = tmp.join(' ');
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?ordering=-score&game=${game}&shot=${shot}&difficulty=${diff}&type=Score&region=Eastern&verified=true`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const records = JSON.parse(this.response);
                showHistory(category, game, records, idSuffix);
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
    const newLanguage = event.target.getAttribute("data-lang") || event.target.parentNode.getAttribute("data-lang");

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    location.href = location.href.split('#')[0].split('?')[0];
    setCookie("lang", newLanguage);
}

function setEventListeners() {
    document.getElementById("toggle_layout").addEventListener("click", toggleLayout, false);
    document.getElementById("recent_limit").addEventListener("keyup", setRecentLimit, false);
    document.getElementById("recent_limit").addEventListener("mouseup", setRecentLimit, false);
    document.getElementById("save_changes").addEventListener("click", saveChanges, false);
    document.getElementById("search").addEventListener("change", setPlayer, false);
    document.getElementById("search").addEventListener("select", setPlayer, false);
    document.getElementById("player").addEventListener("change", getPlayerWRs, false);
    document.getElementById("player").addEventListener("keypress", detectEnter, false);
    document.getElementById("western").addEventListener("click", toggleWestern, false);
    document.getElementById("unverified").addEventListener("click", toggleUnverified, false);
    document.getElementById("toggle_video").addEventListener("click", toggleVideo, false);
    document.getElementById("history_category").addEventListener("change", getHistory, false);

    if (document.getElementById("history_category_old")) {
        document.getElementById("history_category_old").addEventListener("change", getHistory, false);
    }

    const gameImg = document.querySelectorAll(".game_img");

    for (const element of gameImg) {
        element.addEventListener("click", showWRs, false);
    }

    const flags = document.querySelectorAll(".flag, .language");

    for (const element of flags) {
        element.setAttribute("href", "");
        element.addEventListener("click", setLanguage, false);
    }
}

function setAttributes() {
    const flags = document.querySelectorAll(".flag");

    for (const flag of flags) {
        flag.setAttribute("href", "");
    }
}

function getLastModifiedDate() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?ordering=-date&date__isnull=False&type=Score&limit=1`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const response = JSON.parse(this.response);
                const lastModifiedDate = formatDate(new Date(response.results[0].submitted_date));
                let lastModified = _(`World records are current as of <span id="lm">%date</span>.`).replace("%date", lastModifiedDate);
                document.getElementById("last_modified").innerHTML = lastModified;
            }
        }
    }

    xhr.send();
}

/*function getPlayerSearchOptions() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/players/`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const playerSearch = document.getElementById("search");
                const players = JSON.parse(this.response).score.sort();
                
                for (const player of players) {
                    if (player == '-') {
                        continue;
                    }

                    playerSearch.innerHTML += `<option value="${player}">${player}</option>`;
                }
            }
        }
    }

    xhr.send();
}*/

function getRecentRecords() {
    const recentLimit = getCookie("recent_limit") ? Math.max(getCookie("recent_limit"), 1) : 15;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?limit=${recentLimit}&ordering=-date&type=Score&region=Eastern&verified=true`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const recentTable = document.getElementById("recentbody");
                const recent = JSON.parse(this.response).results;

                for (const entry of recent) {
                    if (!entry["date"]) {
                        continue;
                    }

                    const date = formatDate(new Date(entry["date"]));
                    const dateRaw = formatDate(new Date(entry["date"]), "raw");
                    let replay, video;

                    if (!entry["replay"]) {
                        replay = '-';
                    } else {
                        const chunks = entry["replay"].split(/\//);
                        replay = `<a href='${entry["replay"]}'>${chunks[chunks.length - 1]}</a>`;
                    }

                    if (!entry["video"]) {
                        video = '-';
                    } else {
                        video = `<a href='${entry["video"]}'>${_('Link')}</a>`;
                    }

                    let tableRow = '<tr>';
                    tableRow += `<td class="${entry["category"]["game"]}p">${_(entry["category"]["game"]) + _(' ') + _(entry["category"]["difficulty"]) + _(' ') + _(entry["category"]["shot"])}</td>`;
                    tableRow += `<td>${sep(entry["score"])}</td>`;
                    tableRow += `<td>${entry["player"]}</td>`;
                    tableRow += `<td class="no_mobile">${replay}</td>`;
                    tableRow += `<td>${video}</td>`;
                    tableRow += `<td data-sort='${dateRaw}'>${date}</td>`;
                    tableRow += '</tr>';
                    recentTable.innerHTML += tableRow;
                }
            }
        }
    }

    xhr.send();
}

function checkHash() {
    // player in hash links to player WRs
    if (location.hash !== "") {
        const hash = decodeURIComponent(location.hash.substring(1).replace('+', "%20"));
        const players = document.getElementById("search").children;

        for (const option of players) {
            const player = option.value;

            if (hash == player) {
                document.getElementById("player").value = player;
                document.getElementById("search").value = player;
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

    westernEnabled = localStorage.getItem("westernEnabled") ? true : false;
    unverifiedEnabled = localStorage.getItem("unverifiedEnabled") ? true : false;
    setEventListeners();
    setAttributes();
    getLastModifiedDate();
    //getPlayerSearchOptions();
    getRecentRecords();

    if (getCookie("video_enabled")) {
        videoEnabled = Boolean(getCookie("video_enabled"));
        document.getElementById("toggle_video").checked = videoEnabled;
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
