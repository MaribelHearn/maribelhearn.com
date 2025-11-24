/*global _ getCookie deleteCookie setCookie fullNameNumber*/
const API_BASE = location.hostname.includes("maribelhearn.com") ? "https://maribelhearn.com" : "http://localhost";
const banList = ["Reimu", "Marisa", "Sanae", "Seiran", "Biten", "Enoko", "Chiyari"];
let language = "en_GB";
let selected = "";
let shots = {};
let pc98Excluded = false;
let versusIncluded = false;

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

function toggleVersus() {
    versusIncluded = !versusIncluded;
    versusIncluded ? setCookie("include_vs", true) : deleteCookie("include_vs");
    saveChanges();
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
        case "FW": return _("No. of LNNNs");
        default: return _("No. of LNNs");
    }
}

function shotRoute(game) {
    return game == "HRtP" || game == "GFW" ? _("Route") : _("Shottype");
}

function prepareShowLNNs(game) {
    if (selected !== "") {
        const selectedImg = document.getElementById(`${selected}_image`);
        const border = "none";
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
    xhr.open('GET', `${API_BASE}/api/v1/replay/?type=LNN&ordering=shot,route,player&game=${game}`);
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

        players.pushStrict(player);
        shotCount += 1;

        if (game != "UDoALG" || !banList.includes(shot)) {
            gameCount += 1;
        }

        const shotElement = document.getElementById(`${shot}${currentRoute}`);
        shotElement.innerHTML += `, ${player}`;
        
        if (route == "UFOs") {
            shotElement.innerHTML += " (UFOs)";
        }

        if (shotElement.innerHTML.substring(0, 2) == ", ") {
            shotElement.innerHTML = shotElement.innerHTML.replace(", ", "");
        }
    }

    if (LNNs.length > 0) {
        document.getElementById(`${currentShot}${currentRoute}n`).innerHTML = shotCount;
    }

    if (game == "UDoALG") {
        for (const chara of banList) {
            const element1 = document.getElementById(chara);
            const element2 = document.getElementById(`${chara}n`);

            if (element1 && element2) {
                element1.innerHTML = element2.innerHTML = '-';
            }
            
        }
    }

    players.sort((a, b) => a.toLowerCase().localeCompare(b.toLowerCase()));
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
        const border = "none";
        gameImg.style.border = border;
        document.getElementById("lnn_table").classList.remove(`${game}t`);
        document.getElementById("lnn_list").style.display = "none";
        selected = "";
    }
}

function formatDate(date, raw) {
    if (!date) {
        return "Unknown";
    }

    let tmp = date.replace(/-/g, '/');
    tmp = tmp.split(/\//);
    const day = tmp[2].padStart(2, '0');
    const month = tmp[1].padStart(2, '0');
    const year = tmp[0];

    if (raw) {
        return year + month + day;
    } else if (language == "en_US") {
        return `${month}/${day}/${year}`;
    } else if (language == "ja_JP" || language == "zh_CN") {
        return `${year}年${month}月${day}日`;
    } else if (language == 'ru_RU' || language == 'de_DE') {
        return `${day}.${month}.${year}`;
    } else { // en_GB || es_ES
        return `${day}/${month}/${year}`;
    }
}

function setPlayer(event) {
    const player = event.target.value;
    document.getElementById("player").value = player;
    getPlayerLNNs(player);
}

function showPlayerLNNs(player, LNNs) {
    const searchResults = document.getElementById("search_results");
    const emptyResults = document.getElementById("empty_player");

    if (player === "") {
        searchResults.style.display = "none";
        return;
    }

    let numberOfLNNs = 0;
    let currentGame = "";
    let first;
    const searchTable = document.getElementById("search_tbody");
    searchTable.innerHTML = "";

    for (const data of LNNs) {
        const game = data.category.game;
        let replay, video, date;

        if (currentGame != game) {
            if (currentGame !== "") {
                document.getElementById(`${currentGame}d`).setAttribute("data-sort", first.toISOString().split("T")[0].replace(/-/g, ""));
            }

            currentGame = game;
            searchTable.innerHTML += `<tr><td id='${game}l' class='${game}'>${_(game)}</td><td id='${game}s'></td><td id='${game}r'></td><td id='${game}v'></td><td id='${game}d'></td></tr>`;
            first = new Date("9999/12/31");
        }

        if (!data.replay) {
            replay = '-';
        } else {
            replay = `<a href='${data.replay.replace("com/replays", "com/media/replays")}'>${data.replay.split('/')[data.replay.split('/').length - 1]}</a>`;
        }

        if (!data.video) {
            video = '-';
        } else {
            video = `<a href='${data.video}' target='_blank'>${_("Link")}</a>`;
        }

        if (new Date(data.date) < first) {
            first = new Date(data.date);
        }

        date = (!data.date ? _("Unknown") : formatDate(data.date));

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
        let gameShots = shots[game].length;

        if (game == "IN") {
            gameShots *= 4; // span elements are also children
        }

        if (shots[game] && document.getElementById(`${game}s`).children.length == gameShots) {
            lnnShots.innerHTML += `<br><strong>${_("(All)")}</strong>`;
        }
    }

    if (numberOfLNNs === 0) {
        document.getElementById("empty_category").style.display = "none";
        searchResults.style.display = "none";
        emptyResults.style.display = "block";
        return;
    }

    document.getElementById("category").value = "";
    document.getElementById("first_header").innerHTML = _("Game");
    document.getElementById("first_header").classList.remove("first_header_category");
    document.getElementById("search_table").classList.add("sortable");
    document.getElementById("second_header").innerHTML = _("Shottype");
    document.getElementById("search_sum").innerHTML = numberOfLNNs;
    document.getElementById("empty_category").style.display = "none";
    emptyResults.style.display = "none";
    searchResults.style.display = "block";
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

function splitCategory(category, translate) {
    let parts = category.split(' ');

    const game = parts[0];
    parts.splice(0, 1);

    let shot, route;

    if (game == "IN" || game == "UFO") {
        route = parts[parts.length - 1];
        parts.splice(parts.length - 1, 1);
    }

    if (game == "UFO" && route != "UFOs") {
        shot = route;
        route = undefined;
    } else {
        shot = parts.join(' ');
    }

    let result = [];

    if (translate) {
        result.push(_(game));
        result.push(_(shot));
    } else {
        result.push(game);
        result.push(shot);
    }

    if (route) {
        result.push(translate ? _(route) : route);
    }

    return result;
}

function setCategory(event) {
    const category = event.target.value;

    if (category === "") {
        document.getElementById("category").value = "";
        getCategoryLNNs(category);
        return;
    }

    const categoryName = splitCategory(category, true);

    document.getElementById("category").value = categoryName.join(' ');
    getCategoryLNNs(category);
}

function showCategoryLNNs(category, LNNs) {
    const searchResults = document.getElementById("search_results");
    const emptyResults = document.getElementById("empty_category");
    let numberOfLNNs = 0;
    let first = true;
    const searchTable = document.getElementById("search_tbody");
    searchTable.innerHTML = "";

    for (const data of LNNs) {
        const game = data.category.game;
        const shot = data.category.shot;
        const route = data.category.route;
        let replay, video, date, dateRaw;

        if (!data.replay) {
            replay = '-';
        } else {
            replay = `<a href='${data.replay.replace("com/replays", "com/media/replays")}'>${data.replay.split('/')[data.replay.split('/').length - 1]}</a>`;
        }

        if (!data.video) {
            video = '-';
        } else {
            video = `<a href='${data.video}' target='_blank'>${_("Link")}</a>`;
        }

        if (new Date(data.date) < first) {
            first = new Date(data.date);
        }

        date = (!data.date ? _("Unknown") : formatDate(data.date));
        dateRaw = (!data.date ? _("Unknown") : formatDate(data.date), "raw");
        searchTable.innerHTML += `<tr id='tr_${numberOfLNNs}'></tr>`;

        if (first) {
            document.getElementById(`tr_${numberOfLNNs}`).innerHTML += `<td id='game_td' class='${game}'>${_(game)}${_(' ')}${_(shot)}${route ? _(' ') : ''}${_(route)}</td>`;
            first = false;
        }

        document.getElementById(`tr_${numberOfLNNs}`).innerHTML += `<td>${data.player}</td><td>${replay}</td><td>${video}</td><td data-sort="${dateRaw}">${date}</td>`;
        numberOfLNNs += 1;
    }

    if (numberOfLNNs === 0) {
        document.getElementById("empty_player").style.display = "none";
        searchResults.style.display = "none";
        emptyResults.style.display = "block";
        return;
    }

    document.getElementById("player").value = "";
    document.getElementById("game_td").rowSpan = numberOfLNNs;
    document.getElementById("first_header").innerHTML = _("Category");
    document.getElementById("first_header").classList.add("first_header_category");
    document.getElementById("search_table").classList.remove("sortable");
    document.getElementById("second_header").innerHTML = _("Player");
    document.getElementById("search_sum").innerHTML = numberOfLNNs;
    document.getElementById("empty_player").style.display = "none";
    emptyResults.style.display = "none";
    searchResults.style.display = "block";
}

function getCategoryLNNs(category) {
    const searchResults = document.getElementById("search_results");

    if (typeof category == "object") {
        category = this.value; // if event listener fired
    }

    if (category === "") {
        searchResults.style.display = "none";
        return;
    }

    const categoryName = splitCategory(category);
    let url = `${API_BASE}/api/v1/replay/?ordering=-date&game=${encodeURIComponent(categoryName[0])}&shot=${encodeURIComponent(categoryName[1])}`;

    if (categoryName.length > 2) { // has route
        url += `&route=${encodeURIComponent(categoryName[2])}`;
    }

    url += "&type=LNN";
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const LNNs = JSON.parse(this.response);
                showCategoryLNNs(category, LNNs);
            }
        }
    }

    xhr.send();
}

function detectEnter(event) {
    if (event.key && event.key == "Enter") {
        const value = event.target.value;

        if (event.target.id == "player") {
            getPlayerLNNs(value);
        } else { // event.target.id == "search_category"
            getCategoryLNNs(value);
        }
        
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
    document.getElementById("toggle_layout").href = document.getElementById("toggle_layout").href.split('?')[0];
    document.getElementById("toggle_layout").addEventListener("click", toggleLayout, false);
    document.getElementById("recent_limit").addEventListener("keyup", setRecentLimit, false);
    document.getElementById("recent_limit").addEventListener("mouseup", setRecentLimit, false);
    document.getElementById("save_changes").addEventListener("click", saveChanges, false);
    document.getElementById("search_player").addEventListener("change", setPlayer, false);
    document.getElementById("search_player").addEventListener("select", setPlayer, false);
    document.getElementById("player").addEventListener("keypress", detectEnter, false);
    document.getElementById("search_category").addEventListener("change", setCategory, false);
    document.getElementById("search_category").addEventListener("select", setCategory, false);
    document.getElementById("category").addEventListener("keypress", detectEnter, false);
    document.getElementById("showversus1").addEventListener("click", toggleVersus, false);
    document.getElementById("showversus2").addEventListener("click", toggleVersus, false);
    const gameImg = document.querySelectorAll(".game_img");

    for (const element of gameImg) {
        element.addEventListener("click", showLNNs, false);
    }

    const flags = document.querySelectorAll(".flag, .language");

    for (const element of flags) {
        element.setAttribute("href", "");
        element.addEventListener("click", setLanguage, false);
    }
}

function setAttributes() {
    if (!getCookie("lnn_old_layout")) {
        document.getElementById("newlayout").style.display = "block";
        document.getElementById("contents_new").style.display = "block";
    }

    document.getElementById("search").style.display = "block";
    const flags = document.querySelectorAll(".flag");
    const searchLink = document.getElementById("searchlink");

    for (const flag of flags) {
        flag.setAttribute("href", "");
    }
    
    if (searchLink) {
        searchLink.style.display = "block";
    }
}

/*function getPlayerSearchOptions() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/players/`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const playerSearch = document.getElementById("search_player");
                const players = JSON.parse(this.response).lnn.sort();
                
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

function checkHash() {
    // player in hash links to player LNNs
    if (location.hash !== "") {
        const hash = decodeURIComponent(location.hash.substring(1));
        const players = document.getElementById("search_player").children;

        for (const option of players) {
            const player = option.value;

            if (hash == player) {
                document.getElementById("player").value = player;
                document.getElementById("search_player").value = player;
                document.getElementById("search").scrollIntoView();
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

    versusIncluded = getCookie("include_vs") ? true : false;
    document.getElementById("showversus1").checked = versusIncluded;
    document.getElementById("showversus2").checked = versusIncluded;
    setEventListeners();
    setAttributes();

    if (!getCookie("lnn_old_layout")) {
        //getPlayerSearchOptions();
    }

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
