var LNNs, alphaNums = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",
    language = "English", selected = "", playerSelected = false, missingReplays, playergameLNNs;

function toggleLayout() {
    if (getCookie("lnn_old_layout")) {
        deleteCookie("lnn_old_layout");
    } else {
        setCookie("lnn_old_layout", true);
    }
}
function restrictions(game) {
    return ({
        "PCB": "n",
        "IN": "fs",
        "UFO": "u",
        "TD": "n",
        "HSiFS": "n",
        "WBaWC": "nn"
    }[game]);
}
function shotRoute(game) {
    return game == "HRtP" || game == "GFW" ? "Route" : "Shottype";
}
function replayPath(game, player, character, type) {
    var folder = player.removeSpaces(), first = player.charAt(0), last = player.charAt(player.length - 1);

    player = player.replace(/[^0-9a-z]/gi, "");

    if (!/[0-9a-z]/gi.test(player)) {
        if (first == last) {
            first = alphaNums.charAt(folder.length - 1);
            last = first;
        } else {
            first = alphaNums.charAt(folder.length - 1);
            last = alphaNums.charAt(folder.length);
        }
    } else {
        first = player.charAt(0);
        last = (type !== "" ? type.charAt(type.length - 1) : player.charAt(player.length - 1));
    }

    return "replays/lnn/" + folder + "/th" + gameAbbr(game) +
    "_ud" + first + last + shottypeAbbr(character) + ".rpy";
}
function show(game) {
    if (typeof game == "object") {
        game = this.id; // if event listener fired
    }

    if (!LNNs) {
        $.get("json/lnnlist.json", function (data) {
            LNNs = data;
            show(game);
        }, "json");
        return;
    }

    if (game == selected) {
        $("#list").css("display", "none");
        $("#" + game).css("border", $("#" + game).hasClass("cover98") ? "1px solid black" : "none");
        $("#fullname, #listhead, #listbody, #listfoot").html("");
        $("#fullname").removeClass(game + "f");
        selected = "";
        return;
    }

    var playergameLNNs = {}, overallplayers = [], players = [], typeString = "", gamecount = 0,
        shottype, shotplayers, shotcount, character, type, player, season, i;

    if (selected !== "") {
        $("#" + selected).css("border", $("#" + selected).hasClass("cover98") ? "1px solid black" : "none");
    }

    if ($("#fullname").hasClass(selected + "f")) {
        $("#fullname").removeClass(selected + "f");
    }

    $("#" + game).css("border", "3px solid gold");
    selected = game;
    $("#fullname").addClass(game + "f");
    $("#fullname").html(fullNameNumber(game));
    $("#listhead").html("<tr><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) +
    "</th><th class='sorttable_numeric'><span id='numeric' class='nooflnn" + (restrictions(game) ? restrictions(game) : "") +
    "s'>No. of LNNs</span><br><span class='different'>(Different players)</span></th><th class='players'>Players</th></tr>");
    $("#listfoot").html("<tr><td colspan='3'></td></tr><tr><td class='count'><span class='overall'>Overall</span></td>" +
    "<td id='count' class='count'></td><td id='total'></td></tr>");
    $("#listbody").html("");

    for (shottype in LNNs[game]) {
        if (game != "UFO" || (game == "UFO" && !shottype.contains("UFOs"))) {
            shotplayers = [];
            shotcount = 0;
            character = shottype.replace(/UFOs/, "");
            if (game == "IN" || game == "HSiFS") {
                season = shottype.substr(-6);
                $("#listbody").append("<tr><td class='nowrap'><span class='" + shottype.slice(0, -6) + "'>" + shottype.slice(0, -6) +
                "</span><span class='" + season + "'>" + season + "</span></td><td id='" + shottype +
                "n'></td><td id='" + shottype + "'></td>");
            } else {
                $("#listbody").append("<tr><td class='nowrap " + character + "'>" + character +
                "</td><td id='" + character + "n'></td><td id='" + character + "'></td>");
            }
        }

        if (game == "UFO") {
            type = shottype.replace(character, "");
            typeString = (type !== "" ? " (<span class='" + type + "'>" + type + "</span>)" : "");
        }

        for (i in LNNs[game][shottype]) {
            player = LNNs[game][shottype][i];
            shotplayers.push(player + (game == "IN" || game == "UFO" || game == "HSiFS" ? typeString : ""));
            players.pushStrict(player);
            shotcount += 1;
            gamecount += 1;
        }

        if (!(game == "UFO" && type != "UFOs")) {
            shotplayers.sort();
            $("#" + character + "n").html(shotcount);

            if (shotcount === 0) {
                continue;
            }

            for (i in shotplayers) {
                $("#" + character).append(", " + shotplayers[i]);
            }

            if ($("#" + character).html().substring(0, 2) == ", ") {
                $("#" + character).html($("#" + character).html().replace(", ", ""));
            }
        }
    }

    players.sort();

    for (i in players) {
        $("#total").append(", " + players[i])
    }

    $("#count").html(gamecount + " (" + players.length + ")");
    $("#total").html($("#total").html().replace(", ", ""));
    $("#list").css("display", "block");
    generateTableText("lnn");
    generateFullNames();
    generateShottypes();
}
function getPlayerLNNs(player) {
    if (typeof player == "object") {
        player = this.value; // if event listener fired
    }

    if (!LNNs) {
        $.get("json/lnnlist.json", function (data) {
            LNNs = data;
            getPlayerLNNs(player);
        }, "json");
    }

    if (player == "...") {
        $("#playerlist").css("display", "none");
        $("#playerlistbody, #playerlistfoot").html("");
        playerSelected = false;
        return;
    }

    var games = [], sum = 0, game, array, replays, gamesum, shottype, character, type, list, replay, tmp, i;

    playerSelected = true;
    $("#playerlistbody").html("");

    for (game in LNNs) {
        if (game == "LM") {
            continue;
        }

        array = [];
        replays = [];
        gamesum = 0;

        for (shottype in LNNs[game]) {
            if (LNNs[game][shottype].contains(player)) {
                if (!games.contains(game)) {
                    $("#playerlistbody").append("<tr><td class='" + game + "'>" + game + "</td><td id='" + game +
                    "s'></td><td id='" + game + "r'></td></tr>");
                    games.push(game);
                }
                character = shottype.replace(/(FinalA|FinalB|UFOs)/g, "");
                type = shottype.replace(character, "");
                array.push("<span class='" + character + "'>" + character +
                "</span>" + (type === "" ? "": " (<span class='" + type + "'>" + type + "</span>)"));
                if (gameAbbr(game) < 6 || missingReplays.contains(game + player.removeSpaces() + shottype)) {
                    replays.push('-');
                } else {
                    replay = replayPath(game, player, character, type);
                    tmp = replay.split('/');
                    replays.push("<a href='" + location.origin +
                    "/" + replay + "'>" + tmp[tmp.length - 1] + "</a>");
                }
                gamesum += 1;
                sum += 1;
            }
        }

        list = array.join("<br>");
        $("#" + game + "s").html(list);
        list = replays.join("<br>");
        $("#" + game + "r").html(list);

        if (game == "UFO" && list.contains("ReimuA") && list.contains("ReimuB") && list.contains("MarisaA") && list.contains("MarisaB") && list.contains("SanaeA") && list.contains("SanaeB")) {
            $("#UFOs").append(" <strong class='all'>(All)</strong>");
        } else if (game != "UFO" && gamesum == Object.keys(LNNs[game]).length) {
            $("#" + game + "s").append(" <strong class='all'>(All)</strong>");
        }
    }

    $("#playerlistfoot").html("<tr><td colspan='3'></td></tr><tr><td class='total'>Total</td><td colspan='2'>" + sum + "</td></tr>");
    $("#playerlist").css("display", "block");
    generateTableText("lnn");
    generateShortNames();
    generateShottypes();
}
function setLanguage(event) {
    var newLanguage = event.data.language;

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    setCookie("lang", newLanguage);
    location.href = location.href.split('#')[0].split('?')[0];
}
$(document).ready(function () {
    $("#player").on("change", getPlayerLNNs);
    $("#layouttoggle").on("click", toggleLayout);
    $("#layouttoggle").css("display", "inline");
    $("#contents_new").css("display", "inline-block");
    $("#playersearch").css("display", "block");
    $("#playersearchlink").css("display", "block");
    $("#newlayout").css("display", "block");
    $(".en, .jp, .zh").attr("href", "lnn");
    $(".en").on("click", {language: "English"}, setLanguage);
    $(".jp").on("click", {language: "Japanese"}, setLanguage);
    $(".zh").on("click", {language: "Chinese"}, setLanguage);
    $(".game").on("click", show);
    missingReplays = $("#missingReplays").val();

    if (getCookie("lang") == "Japanese" || location.href.contains("jp")) {
        language = "Japanese";
    } else if (getCookie("lang") == "Chinese" || location.href.contains("zh")) {
        language = "Chinese";
    }

    if (navigator.userAgent.indexOf("Mobile") == -1 && navigator.userAgent.indexOf("Tablet") == -1) {
        $("#layouttoggle").css("display", "inline");
    }
});
