/*global _ LNNs getCookie deleteCookie setCookie gameAbbr shottypeAbbr fullNameNumber*/
const alphaNums = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
let selected = "";
let preferVideo = false;
let missingReplays, videoLNNs;

function toggleLayout() {
    if (getCookie("lnn_old_layout")) {
        deleteCookie("lnn_old_layout");
    } else {
        setCookie("lnn_old_layout", true);
    }
}

function toggleVideo() {
    preferVideo = !preferVideo;

    if (preferVideo) {
        localStorage.setItem("preferVideo", true);
    } else {
        localStorage.removeItem("preferVideo");
    }

    const player = document.getElementById("player").value;

    if (player !== "") {
        showPlayerLNNs(player);
    }
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

function replayPath(game, player, character, type) {
    const folder = player.removeSpaces();
    let first = player.charAt(0);
    let last = player.charAt(player.length - 1);
    player = player.replace(/[^0-9a-z]/gi, "");

    if (!/[0-9a-z]/gi.test(player)) {
        first = alphaNums.charAt(folder.length - 1);

        if (first == last) {
            last = (type !== "" ? type.charAt(type.length - 1) : alphaNums.charAt(folder.length - 1));
        } else {
            last = (type !== "" ? type.charAt(type.length - 1) : alphaNums.charAt(folder.length));
        }
    } else {
        first = player.charAt(0);
        last = (type !== "" ? type.charAt(type.length - 1) : player.charAt(player.length - 1));
    }

    return `replays/lnn/${folder}/th${gameAbbr(game)}_ud${first + last + shottypeAbbr(character)}.rpy`;
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

function showLNNtable(game) {
    const lnnTable = document.getElementById("lnn_tbody");
    let players = [];
    let gameCount = 0;

    for (const shot in LNNs[game]) {
        if (shot.includes("UFOs")) {
            continue;
        }

        let shotPlayers = [];
        let shotCount = 0;

        if (game == "IN" || game == "HSiFS") {
            const character = shot.slice(0, -6);
            const type = shot.slice(-6);
            lnnTable.innerHTML += `<tr><td class='nowrap'><span class='${character}'>${_(character)}</span>` +
                    `<span class='${type}'>${_(type)}</span></td><td id='${shot}n'></td><td id='${shot}'></td>`;
        } else {
            lnnTable.innerHTML += `<tr><td class='nowrap'>${_(shot)}</td><td id='${shot}n'></td><td id='${shot}'></td>`;
        }

        for (const player of LNNs[game][shot]) {
            shotPlayers.push(player);
            players.pushStrict(player);
            shotCount += 1;
            gameCount += 1;
        }

        if (game == "UFO") {
            for (const player of LNNs[game][shot + "UFOs"]) {
                shotPlayers.pushStrict(player + " (UFOs)");
                players.pushStrict(player);
                shotCount += 1;
                gameCount += 1;
            }
        }

        shotPlayers.sort();
        document.getElementById(`${shot}n`).innerHTML = shotCount;

        if (shotCount === 0) {
            continue;
        }

        const shotElement = document.getElementById(`${shot}`);

        for (const shotPlayer of shotPlayers) {
            shotElement.innerHTML += `, ${shotPlayer}`;
        }

        if (shotElement.innerHTML.substring(0, 2) == ", ") {
            shotElement.innerHTML = shotElement.innerHTML.replace(", ", "");
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
        showLNNtable(game);
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

function getPlayerGameLNNs(player, game) {
    let result = { "runs": [], "replays": [], "shots": [] };

    for (const shot in LNNs[game]) {
        if (LNNs[game][shot].includes(player)) {
            const character = shot.replace(/(FinalA|FinalB|UFOs)/g, "");
            const type = shot.replace(character, "");
            result.runs.push(_(character) + (type === "" ? "" : ` (${_(type)})`));

            if (preferVideo && videoLNNs.hasOwnProperty(game + shot + player)) {
                result.replays.push(`<a href='${videoLNNs[game + shot + player]}' target='_blank'>${videoLNNs[game + shot + player]}</a>`);
            } else if (gameAbbr(game) < 6 || missingReplays.includes(game + player.removeSpaces() + shot)) {
                if (videoLNNs.hasOwnProperty(game + shot + player)) {
                    result.replays.push(`<a href='${videoLNNs[game + shot + player]}' target='_blank'>${videoLNNs[game + shot + player]}</a>`);
                } else {
                    result.replays.push('-');
                }
            } else {
                const replay = replayPath(game, player, character, type);
                const replayArray = replay.split('/');
                result.replays.push(`<a href='${location.origin}/${replay}'>${replayArray[replayArray.length - 1]}</a>`);
            }

            result.shots.pushStrict(shot.replace("UFOs", ""));
        }
    }


    return result;
}

function showPlayerLNNs(player) {
    const playerList = document.getElementById("player_list");

    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    if (player === "") {
        playerList.style.display = "none";
        return;
    }

    let games = [];
    let sum = 0;
    const playerTable = document.getElementById("player_tbody");
    playerTable.innerHTML = "";

    for (const game in LNNs) {
        if (game == "LM") {
            continue;
        }

        const playerLNNs = getPlayerGameLNNs(player, game);
        const max = (game == "UFO" ? 6 : Object.keys(LNNs[game]).length);

        if (playerLNNs.runs.length > 0) {
            games.push(game);
            sum += playerLNNs.runs.length;
            playerTable.innerHTML += `<tr><td id='${game}l' class='${game}'>${_(game)}</td><td id='${game}s'></td><td id='${game}r'></td></tr>`;
            document.getElementById(`${game}s`).innerHTML = playerLNNs.runs.join("<br>");
            document.getElementById(`${game}r`).innerHTML = playerLNNs.replays.join("<br>");
        }

        const lnnShots = document.getElementById(`${game}l`);

        if (playerLNNs.shots.length == max) {
            lnnShots.innerHTML += `<br><strong>${_("(All)")}</strong>`;
        }
    }

    if (sum === 0) {
        playerList.style.display = "none";
        return;
    }

    document.getElementById("player_sum").innerHTML = sum;
    playerList.style.display = "block";
}

function setLanguage(event) {
    let newLanguage;

    if (event.target.id == "en_GB" || event.target.parentNode.id == "en_GB") {
        newLanguage = (getCookie("lang") == "en_US" ? "en_US" : "en_GB");
    } else {
        newLanguage = event.target.id || event.target.parentNode.id;
    }

    location.href = location.href.split('#')[0].split('?')[0];
    setCookie("lang", newLanguage);
}

function setEventListeners() {
    document.getElementById("toggle_layout").addEventListener("click", toggleLayout, false);
    document.getElementById("toggle_video").addEventListener("click", toggleVideo, false);
    document.getElementById("player").addEventListener("change", showPlayerLNNs, false);
    document.getElementById("player").addEventListener("select", showPlayerLNNs, false);
    document.getElementById("en_GB").addEventListener("click", setLanguage, false);
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
        document.getElementById("contents_new").style.display = "inline-block";
    }

    document.getElementById("playersearch").style.display = "block";
    const flags = document.querySelectorAll(".flag");
    const playerSearchLink = document.getElementById("playersearchlink");

    for (const flag of flags) {
        flag.setAttribute("href", "");
    }

    if (playerSearchLink) {
        document.getElementById("playersearchlink").style.display = "block";
    }
}

function parseVideos() {
    const videos = document.getElementById("videos").value.split(',');
    let result = {};

    for (let video of videos) {
        video = video.split(';');
        result[video[0]] = video[1];
    }

    return result;
}

function checkHash() {
    // player in hash links to player LNNs
    if (location.hash !== "") {
        const hash = decodeURIComponent(location.hash.substring(1));
        const players = document.getElementById("player").children;

        for (const option of players) {
            const player = option.value;

            if (hash == player) {
                document.getElementById("player").value = player;
                document.getElementById("playersearch").scrollIntoView();
                showPlayerLNNs(player);
                break;
            }
        }
    }
}

function init() {
    setEventListeners();
    setAttributes();
    videoLNNs = parseVideos();
    missingReplays = document.getElementById("missing_replays").value;
    checkHash();
    
    if (localStorage.hasOwnProperty("preferVideo")) {
        preferVideo = Boolean(localStorage.getItem("preferVideo"));
        document.getElementById("toggle_video").checked = preferVideo;
    }
}

window.addEventListener("DOMContentLoaded", init, false);
window.addEventListener("hashchange", checkHash, false);
