/*global $ _ LNNs getCookie deleteCookie setCookie gameAbbr shottypeAbbr fullNameNumber*/
const alphaNums = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
let language = "en_GB";
let selected = "";
let missingReplays, videoLNNs;

function toggleLayout() {
    if (getCookie("lnn_old_layout")) {
        deleteCookie("lnn_old_layout");
    } else {
        setCookie("lnn_old_layout", true);
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

    return "replays/lnn/" + folder + "/th" + gameAbbr(game) +
    "_ud" + first + last + shottypeAbbr(character) + ".rpy";
}

function prepareShowLNNs(game) {
    if (selected !== "") {
        $(`#${selected}_image`).css("border", $("#" + selected + "_image").hasClass("cover98") ? "1px solid black" : "none");
    }

    if ($("#fullname").hasClass(selected + "f")) {
        $("#fullname").removeClass(selected + "f");
    }

    $("#" + game + "_image").css("border", "3px solid gold");
    selected = game;
    $("#fullname").addClass(`${game}f`);
    $("#fullname").html(_(fullNameNumber(game)));
    $("#listhead").html(`<tr><th class='general_header'>${shotRoute(game)}</th>` +
            `<th class='general_header sorttable_numeric'>${restrictions(game)}<br>${_("(Different players)")}</th>` +
            `<th class='general_header'>${_("Players")}</th></tr>`);
    $("#listfoot").html(`<tr><td class='foot'>${_("Overall")}</td><td id='count' class='foot'></td><td id='total' class='foot'></td></tr>`);
    $("#listbody").html("");
}

function showLNNs() { // .game_img onclick
    const game = this.id.replace("_image", "");
    let players = [];
    let gameCount = 0;

    if (game == selected) {
        $("#list").css("display", "none");
        $(`#${game}_image`).css("border", $(`#${game}_image`).hasClass("cover98") ? "1px solid black" : "none");
        $("#fullname, #listhead, #listbody, #listfoot").html("");
        $("#fullname").removeClass(game + "f");
        selected = "";
        return;
    }

    prepareShowLNNs(game);

    for (const shot in LNNs[game]) {
        if (shot.includes("UFOs")) {
            continue;
        }

        let shotPlayers = [];
        let shotCount = 0;

        if (game == "IN" || game == "HSiFS") {
            const character = shot.slice(0, -6);
            const type = shot.substr(-6);
            $("#listbody").append(`<tr><td class='nowrap'><span class='${character}'>${_(character)}</span>` +
                    `<span class='${type}'>${_(type)}</span></td><td id='${shot}n'></td><td id='${shot}'></td>`);
        } else {
            $("#listbody").append(`<tr><td class='nowrap'>${_(shot)}</td><td id='${shot}n'></td><td id='${shot}'></td>`);
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
        $(`#${shot}n`).html(shotCount);

        if (shotCount === 0) {
            continue;
        }

        for (const shotPlayer of shotPlayers) {
            $(`#${shot}`).append(", " + shotPlayer);
        }

        if ($(`#${shot}`).html().substring(0, 2) == ", ") {
            $(`#${shot}`).html($(`#${shot}`).html().replace(", ", ""));
        }
    }

    players.sort();

    for (const player of players) {
        $("#total").append(", " + player);
    }

    $("#count").html(`${gameCount} (${players.length})`);
    $("#total").html($("#total").html().replace(", ", ""));
    $("#list").css("display", "block");
}

function getPlayerLNNs(player, game) {
    let result = { "runs": [], "replays": [], "shots": [] };

    for (const shot in LNNs[game]) {
        if (LNNs[game][shot].includes(player)) {
            const character = shot.replace(/(FinalA|FinalB|UFOs)/g, "");
            const type = shot.replace(character, "");
            result.runs.push(_(character) + (type === "" ? "" : ` (${_(type)})`));

            if (gameAbbr(game) < 6 || missingReplays.includes(game + player.removeSpaces() + shot)) {
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

function showPlayerLNNs() { // player onchange, player onselect
    const player = this.value;

    if (player.trim() === "") {
        return;
    }

    let games = [];
    let sum = 0;
    $("#playerlistbody").html("");

    for (const game in LNNs) {
        if (game == "LM") {
            continue;
        }

        const playerLNNs = getPlayerLNNs(player, game);
        const max = (game == "UFO" ? 6 : Object.keys(LNNs[game]).length);

        if (playerLNNs.runs.length > 0) {
            games.push(game);
            sum += playerLNNs.runs.length;
            $("#playerlistbody").append(`<tr><td id='${game}l' class='${game}'>${_(game)}</td><td id='${game}s'></td><td id='${game}r'></td></tr>`);
            $(`#${game}s`).html(playerLNNs.runs.join("<br>"));
            $(`#${game}r`).html(playerLNNs.replays.join("<br>"));
        }

        if (playerLNNs.shots.length == max) {
            $(`#${game}l`).append(`<br><strong>${_("(All)")}</strong>`);
        }
    }

    if (sum === 0) {
        $("#playerlist").css("display", "none");
        return;
    }

    $("#playerlistfoot").html(`<tr><td colspan='3'></td></tr><tr><td>${_("Total")}</td><td colspan='2'>${sum}</td></tr>`);
    $("#playerlist").css("display", "block");
}

function setLanguage(event) {
    const newLanguage = event.data.language;

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    location.href = location.href.split('#')[0].split('?')[0];
    setCookie("lang", newLanguage);
}

function setEventListeners() {
    $("#player").on("change", showPlayerLNNs);
    $("#player").on("select", showPlayerLNNs);
    $("#layouttoggle").on("click", toggleLayout);
    $("#en").on("click", {language: (language == "en_US" ? "en_US" : "en_GB")}, setLanguage);
    $("#jp").on("click", {language: "ja_JP"}, setLanguage);
    $("#zh").on("click", {language: "zh_CN"}, setLanguage);
    $("#ru").on("click", {language: "ru_RU"}, setLanguage);
    $("#de").on("click", {language: "de_DE"}, setLanguage);
    $("#es").on("click", {language: "es_ES"}, setLanguage);
    $(".game_img").on("click", showLNNs);
}

function setAttributes() {
    $("#contents_new").css("display", "inline-block");
    $("#playersearch").css("display", "block");
    $("#playersearchlink").css("display", "block");
    $("#newlayout").css("display", "block");
    $(".flag").attr("href", "");
}

function parseVideos() {
    const videos = $("#videos").val().split(',');
    let result = {};

    for (let video of videos) {
        video = video.split(';');
        result[video[0]] = video[1];
    }

    return result;
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

    setEventListeners();
    setAttributes();
    videoLNNs = parseVideos();
    missingReplays = $("#missingReplays").val();
});
