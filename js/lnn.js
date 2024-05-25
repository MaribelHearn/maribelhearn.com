/*global _ getCookie deleteCookie setCookie fullNameNumber*/
const API_BASE = location.hostname.includes("maribelhearn.com") ? "https://maribelhearn.com" : "http://localhost";
const banList = ["Reimu", "Marisa", "Sanae", "Seiran", "Biten", "Enoko", "Chiyari"];
let language = "en_GB";
let selected = "";
let shots = {};

function toggleLayout() {
    if (getCookie("lnn_old_layout")) {
        deleteCookie("lnn_old_layout");
    } else {
        setCookie("lnn_old_layout", true);
    }
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

function restrictions(game) {
    switch (game) {
        case "PCB": return _("No. of LNNNs");
        case "IN": return _("No. of LNNFSs");
        case "UFO": return _("No. of LNN(N)s");
        case "TD": return _("No. of LNNNs");
        case "HSiFS": return _("No. of LNNNs");
        case "WBaWC": return _("No. of LNNNNs");
        case "UM": return _("No. of LNNNs");
        default: return _("No. of LNNs");
    }
}

function shotRoute(game) {
    return game == "HRtP" || game == "GFW" ? _("Route") : _("Shottype");
}

function prepareShowLNNs(game) {
    if (selected !== "") {
        const selectedImg = document.getElementById(`${selected}_image`);
        const border = (selectedImg.classList.contains("cover98") ? "1px solid black" : "none");
        selectedImg.style.border = border;
    }

    const lnnTable = document.getElementById("lnn_table");
    lnnTable.classList.remove(`${selected}t`);
    lnnTable.classList.add(`${game}t`);
    selected = game;
    document.getElementById(`${game}_image`).style.border = "3px solid gold";
    document.getElementById("fullname").innerHTML = fullNameNumber(game);
    document.getElementById("lnn_shotroute").innerHTML = shotRoute(game);
    document.getElementById("lnn_restrictions").innerHTML = restrictions(game);
    document.getElementById("lnn_tbody").innerHTML = "";
}

function getLNNs(game) {
    const gameImg = document.querySelectorAll(".game_img");

    for (const element of gameImg) {
        element.removeEventListener("click", showLNNs);
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?type=LNN&game=${game}`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const LNNs = JSON.parse(this.response);
                showLNNtable(game, LNNs);
            
                for (const element of gameImg) {
                    element.addEventListener("click", showLNNs, false);
                }
            }
        }
    }

    xhr.send();
}

function showLNNtable(game, LNNs) {
    const lnnTable = document.getElementById("lnn_tbody");
    let players = [];
    let gameCount = 0;
    let shotCount = 0;
    let currentShot = "";
    let currentRoute = "";

    for (const lnn of LNNs) {
        const player = lnn.player;
        const shot = lnn.category.shot;
        let route = lnn.category.route;

        let shotPlayers = [];

        let chara = shot;

        if (game == "HSiFS") {
            const tmp = shot.slice(0, -6);
            route = shot.replace(tmp, "");
            chara = tmp;
        }

        if (currentShot != shot || game != "UFO" && currentRoute != route) {
            if (currentShot !== "") {
                document.getElementById(`${currentShot}${currentRoute}n`).innerHTML = shotCount;
                shotCount = 0;
            }

            if (game == "IN" || game == "HSiFS") {
                currentRoute = route;
                lnnTable.innerHTML += `<tr><td class='nowrap'><span class='${chara}'>${_(chara)}</span>` +
                        `<span class='${route}'>${_(route)}</span></td><td id='${shot}${route}n'></td><td id='${shot}${route}'></td>`;
            } else {
                lnnTable.innerHTML += `<tr><td class='nowrap'>${_(shot)}</td><td id='${shot}n'></td><td id='${shot}'></td>`;
            }

            currentShot = shot;
        }

        shotPlayers.push(player);
        players.pushStrict(player);
        shotCount += 1;
        gameCount += 1;

        shotPlayers.sort();
        const shotElement = document.getElementById(`${shot}${currentRoute}`);

        for (const shotPlayer of shotPlayers) {
            shotElement.innerHTML += `, ${shotPlayer}`;
            
            if (route == "UFOs") {
                shotElement.innerHTML += " (UFOs)";
            }
        }

        if (shotElement.innerHTML.substring(0, 2) == ", ") {
            shotElement.innerHTML = shotElement.innerHTML.replace(", ", "");
        }
    }

    document.getElementById(`${currentShot}${currentRoute}n`).innerHTML = shotCount;

    if (game == "UDoALG") {
        for (const chara of banList) {
            document.getElementById(chara).innerHTML = '-';
            document.getElementById(`${chara}n`).innerHTML = '-';
        }
    }

    players.sort();
    const total = document.getElementById("total");
    total.innerHTML = "";

    for (const player of players) {
        total.innerHTML += `, ${player}`;
    }

    document.getElementById("count").innerHTML = `${gameCount} (${players.length})`;
    total.innerHTML = total.innerHTML.replace(", ", "");
}

function showLNNs() { // .game_img onclick
    const game = this.id.replace("_image", "");

    if (game != selected) {
        prepareShowLNNs(game);
        getLNNs(game);
        document.getElementById("lnn_list").style.display = "block";
    } else {
        const gameImg = document.getElementById(`${game}_image`);
        const border = (gameImg.classList.contains("cover98") ? "1px solid black" : "none");
        gameImg.style.border = border;
        document.getElementById("lnn_table").classList.remove(`${game}t`);
        document.getElementById("lnn_list").style.display = "none";
        selected = "";
    }
}

function formatDate(date) {
    if (language == "ja_JP" || language == "zh_CN") {
        return date.toLocaleString(language.replace('_', '-'), {"dateStyle": "long"});
    } else {
        return date.toLocaleString(language.replace('_', '-'), {"year": "numeric", "month": "2-digit", "day": "2-digit"});
    }
}

function setPlayer(event) {
    const player = event.target.value;
    document.getElementById("player").value = player;
    getPlayerLNNs(player);
}

function showPlayerLNNs(player, LNNs) {
    const playerList = document.getElementById("player_list");

    if (player === "") {
        playerList.style.display = "none";
        return;
    }

    let numberOfLNNs = 0;
    let currentGame = "";
    let first;
    const playerTable = document.getElementById("player_tbody");
    playerTable.innerHTML = "";

    for (const data of LNNs) {
        const game = data.category.game;
        let replay, video, date;

        if (currentGame != game) {
            if (currentGame !== "") {
                document.getElementById(`${currentGame}d`).setAttribute("data-sort", first.toISOString().split("T")[0].replace(/-/g, ""));
            }

            currentGame = game;
            playerTable.innerHTML += `<tr><td id='${game}l' class='${game}'>${_(game)}</td><td id='${game}s'></td><td id='${game}r'></td><td id='${game}v'></td><td id='${game}d'></td></tr>`;
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


        document.getElementById(`${game}s`).innerHTML += _(data.category.shot);

        if (game == "IN") {
            document.getElementById(`${game}s`).innerHTML += `<span class='${data.category.route}'>${_(data.category.route)}</span>`;
        }

        if (game == "UFO" && data.category.route == "UFOs") {
            document.getElementById(`${game}s`).innerHTML += " (UFOs)";
        }

        document.getElementById(`${game}s`).innerHTML += "<br>";
        document.getElementById(`${game}r`).innerHTML += replay + "<br>";
        document.getElementById(`${game}v`).innerHTML += video + "<br>";
        document.getElementById(`${game}d`).innerHTML += date + "<br>";
        numberOfLNNs += 1;

        const lnnShots = document.getElementById(`${game}l`);

        if (shots[game] && document.getElementById(`${game}s`).children.length == shots[game].length) {
            lnnShots.innerHTML += `<br><strong>${_("(All)")}</strong>`;
        }
    }

    if (numberOfLNNs === 0) {
        playerList.style.display = "none";
        return;
    }

    document.getElementById("player_sum").innerHTML = numberOfLNNs;
    playerList.style.display = "block";
}

function getPlayerLNNs(player) {
    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?ordering=game&player=${encodeURIComponent(player)}&type=LNN`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const LNNs = JSON.parse(this.response);
                showPlayerLNNs(player, LNNs);
            }
        }
    }

    xhr.send();
}

function detectEnter(event) {
    if (event.key && event.key == "Enter") {
        const player = event.target.value;
        getPlayerLNNs(player);
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
    document.getElementById("toggle_layout").addEventListener("click", toggleLayout, false);
    document.getElementById("recent_limit").addEventListener("keyup", setRecentLimit, false);
    document.getElementById("recent_limit").addEventListener("mouseup", setRecentLimit, false);
    document.getElementById("save_changes").addEventListener("click", saveChanges, false);
    document.getElementById("search").addEventListener("change", setPlayer, false);
    document.getElementById("search").addEventListener("select", setPlayer, false);
    document.getElementById("player").addEventListener("keypress", detectEnter, false);
    document.getElementById("en_GB").addEventListener("click", setLanguage, false);
    document.getElementById("en_US").addEventListener("click", setLanguage, false);
    document.getElementById("ja_JP").addEventListener("click", setLanguage, false);
    document.getElementById("zh_CN").addEventListener("click", setLanguage, false);
    document.getElementById("ru_RU").addEventListener("click", setLanguage, false);
    document.getElementById("de_DE").addEventListener("click", setLanguage, false);
    document.getElementById("es_ES").addEventListener("click", setLanguage, false);
    const gameImg = document.querySelectorAll(".game_img");

    for (const element of gameImg) {
        element.addEventListener("click", showLNNs, false);
    }
}

function setAttributes() {
    if (!getCookie("lnn_old_layout")) {
        document.getElementById("newlayout").style.display = "block";
        document.getElementById("contents_new").style.display = "block";
    }

    document.getElementById("player_search").style.display = "block";
    const flags = document.querySelectorAll(".flag");
    const playerSearchLink = document.getElementById("playersearchlink");

    for (const flag of flags) {
        flag.setAttribute("href", "");
    }

    if (playerSearchLink) {
        document.getElementById("playersearchlink").style.display = "block";
    }
}

function checkHash() {
    // player in hash links to player LNNs
    if (location.hash !== "") {
        const hash = decodeURIComponent(location.hash.substring(1));
        const players = document.getElementById("search").children;

        for (const option of players) {
            const player = option.value;

            if (hash == player) {
                document.getElementById("player").value = player;
                document.getElementById("player_search").scrollIntoView();
                getPlayerLNNs(player);
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

    setEventListeners();
    setAttributes();

    // legacy video toggle
    if (getCookie("prefer_video")) {
        deleteCookie("prefer_video");
    }

    const player = document.getElementById("player").value;

    try {
        shots = JSON.parse(document.getElementById("shots").value);
        shots.HSiFS.remove(["Reimu", "Cirno", "Aya", "Marisa"]);
    } catch (err) {
        // do nothing
    }    

    if (player !== "") {
        getPlayerLNNs(player);
    }

    checkHash();
    document.getElementById("number_of_lnns").click();
}

window.addEventListener("DOMContentLoaded", init, false);
window.addEventListener("hashchange", checkHash, false);
