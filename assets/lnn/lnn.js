var LNNs, language = "English", selected = "", playerSelected = false, playergameLNNs;

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
        shottype, shotplayers, shotplayersIN, shotcount, character, type, player, i;

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
        if (game != "IN" && game != "UFO" && game != "HSiFS" || (game == "IN" && shottype.contains("FinalA")) || (game == "UFO" && !shottype.contains("UFOs")) || (game == "HSiFS" && shottype.contains("Spring"))) {
            shotplayers = [];
            shotplayersIN = [];
            shotcount = 0;
            character = shottype.replace(/Spring|Summer|Autumn|Winter|FinalA|FinalB|UFOs/, "");
            $("#listbody").append("<tr><td class='" + character + "'>" + character +
            "</td><td id='" + character + "n'></td><td id='" + character + "'></td>");
        }

        if (game == "IN" || game == "UFO" || game == "HSiFS") {
            type = shottype.replace(character, "");
            typeString = (type !== "" ? " (<span class='" + type + "'>" + type + "</span>)" : "");
        }

        for (i in LNNs[game][shottype]) {
            player = LNNs[game][shottype][i];
            shotplayers.push(player + (game == "IN" || game == "UFO" || game == "HSiFS" ? typeString : ""));
            shotplayersIN.pushStrict(player);
            players.pushStrict(player);
            shotcount += 1;
            gamecount += 1;
        }

        if (!(game == "IN" && type != "FinalB") && !(game == "UFO" && type != "UFOs") && !(game == "HSiFS" && type != "Winter")) {
            shotplayers.sort();
            $("#" + character + "n").html(shotcount + (game == "IN" ? " (" + shotplayersIN.length + ")" : ""));

            if (shotcount === 0) {
                $("#" + character).html('-');
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

    var games = [], sum = 0, game, array, gamesum, shottype, character, type, list, i;

    playerSelected = true;
    $("#playerlistbody").html("");

    for (game in LNNs) {
        if (game == "LM") {
            continue;
        }

        array = [];
        gamesum = 0;

        for (shottype in LNNs[game]) {
            if (LNNs[game][shottype].contains(player)) {
                if (!games.contains(game)) {
                    $("#playerlistbody").append("<tr><td class='" + game + "'>" + game + "</td><td id='" + game + "s'></td></tr>");
                    games.push(game);
                }
                character = shottype.replace(/(FinalA|FinalB|UFOs)/g, "");
                type = shottype.replace(character, "");
                array.push("<span class='" + character + "'>" + character +
                "</span>" + (type === "" ? "": " (<span class='" + type + "'>" + type + "</span>)"));
                gamesum += 1;
                sum += 1;
            }
        }

        list = array.join(", ");
        $("#" + game + "s").html(list);

        if (game == "UFO" && list.contains("ReimuA") && list.contains("ReimuB") && list.contains("MarisaA") && list.contains("MarisaB") && list.contains("SanaeA") && list.contains("SanaeB")) {
            $("#UFOs").append(" <strong class='all'>(All)</strong>");
        } else if (game != "UFO" && gamesum == Object.keys(LNNs[game]).length) {
            $("#" + game + "s").append(" <strong class='all'>(All)</strong>");
        }
    }

    $("#playerlistfoot").html("<tr><td colspan='2'></td></tr><tr><td class='total'>Total</td><td>" + sum + "</td></tr>");
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
    $(".en, .jp, .zh").attr("href", "lnn");
    $(".en").on("click", {language: "English"}, setLanguage);
    $(".jp").on("click", {language: "Japanese"}, setLanguage);
    $(".zh").on("click", {language: "Chinese"}, setLanguage);
    $(".game").on("click", show);

    if (getCookie("lang") == "Japanese" || location.href.contains("jp")) {
        language = "Japanese";
    } else if (getCookie("lang") == "Chinese" || location.href.contains("zh")) {
        language = "Chinese";
    }
});
