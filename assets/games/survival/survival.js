/*global $ html2canvas deleteCookie*/
var games = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "INFinalA",
    "INFinalB", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"],
    vals = {}, unsavedChanges = false, originalContent, completions, na, i;

for (i = 0; i < games.length; i++) {
    vals[games[i]] = {
        "Easy": "N/A",
        "Normal": "N/A",
        "Hard": "N/A",
        "Lunatic": "N/A"
    };

    if (games[i] != "HRtP" && games[i] != "PoDD" && games[i] != "INFinalB") {
        vals[games[i]].Extra = "N/A";
    }

    if (games[i] == "PCB") {
        vals.PCB.Phantasm = "N/A";
    }
}

String.prototype.contains = function (string) {
    return this.indexOf(string) > -1;
};

function getPercentage(game) {
    if (game.contains("IN")) {
        return 100 / (Object.keys(vals["INFinalA"]).length + Object.keys(vals["INFinalB"]).length);
    }

    return 100 / Object.keys(vals[game]).length;
}

function gameSpecific(game, achievement) {
    if (achievement != "NB+" && achievement != "NMNB") {
        return achievement;
    }
    if (game == "PCB") {
        return ({"NB+": "NBNBB", "NMNB": "NMNBNBB"}[achievement]);
    } else if (game == "UFO") {
        return ({"NB+": "NBNV", "NMNB": "NMNB(NV)"}[achievement]);
    } else if (game == "TD") {
        return ({"NB+": "NBNT", "NMNB": "NMNBNT"}[achievement]);
    } else if (game == "HSiFS") {
        return ({"NB+": "NBNR", "NMNB": "NMNBNR"}[achievement]);
    } else if (game == "WBaWC") {
        return ({"NB+": "NBNHNRB", "NMNB": "NNNN"}[achievement]);
    } else if (game == "UM") {
        return ({"NB+": "NBNC", "NMNB": "NMNBNC"}[achievement]);
    } else {
        return ({"NB+": "NB", "NMNB": "NMNB"}[achievement]);
    }
}

function fillGame(game, achievement) {
    var difficulty, tmp;

    for (difficulty in vals[game]) {
        tmp = achievement;

        if (achievement == "NB+" || achievement == "NMNB") {
            achievement = gameSpecific(game, achievement);
        }

        $("#" + game + difficulty).val(achievement);
        vals[game][difficulty] = achievement;
        achievement = tmp;
    }

    if (game == "INFinalB") {
        if (achievement == "NB+" ) {
            achievement = "NB";
        }

        $("#INFinalAExtra").val(achievement);
        vals["INFinalA"]["Extra"] = achievement;
    }
}

function fillDifficulty(difficulty, achievement) {
    var game, tmp;

    if (difficulty == "Extra") {
        $("#PCBPhantasm").val(gameSpecific("PCB", achievement));
        vals.PCB.Phantasm = gameSpecific("PCB", achievement);
    }

    for (game in vals) {
        if (achievement == "NB+" || achievement == "NMNB") {
            tmp = gameSpecific(game, achievement);
        } else {
            tmp = achievement;
        }

        if (difficulty == "Extra" && (game == "HRtP" || game == "PoDD")) {
            continue;
        }

        $("#" + game + difficulty).val(tmp);
        vals[game][difficulty] = tmp;
    }
}

function initAchievementCounts() {
    return {
        "Easy": { "Not cleared": 0, "1cc": 0, "NM": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Normal": { "Not cleared": 0, "1cc": 0, "NM": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Hard": { "Not cleared": 0, "1cc": 0, "NM": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Lunatic": { "Not cleared": 0, "1cc": 0, "NM": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Extra": { "Not cleared": 0, "1cc": 0, "NM": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Total": { "Not cleared": 0, "1cc": 0, "NM": 0, "NB": 0, "NB+": 0, "NMNB": 0 }
    };
}

function initGameCounts() {
    return {
        "HRtP": 0,
        "SoEW": 0,
        "PoDD": 0,
        "LLS": 0,
        "MS": 0,
        "EoSD": 0,
        "PCB": 0,
        "IN": 0,
        "PoFV": 0,
        "MoF": 0,
        "SA": 0,
        "UFO": 0,
        "GFW": 0,
        "TD": 0,
        "DDC": 0,
        "LoLK": 0,
        "HSiFS": 0,
        "WBaWC": 0,
        "UM": 0
    };
}

function format(achievement) {
    return ({
        "N/A": "",
        "Not cleared": "",
        "1cc": "clear",
        "NM": "nm",
        "NB": "nb",
        "NBB": "np",
        "NV": "np",
        "NT": "np",
        "NR": "np",
        "NHNRB": "np",
        "NC": "np",
        "NBNBB": "nbp",
        "NBNV": "nbp",
        "NBNT": "nbp",
        "NBNR": "nbp",
        "NBNHNRB": "nbp",
        "NBNC": "nbp",
        "NMNB": "nmnb",
        "NMNBNBB": "nmnb",
        "NMNB(NV)": "nmnb",
        "NMNBNT": "nmnb",
        "NMNBNR": "nmnb",
        "NNNN": "nmnb",
        "NMNBNC": "nmnb"
    })[achievement];
}

function fillOverviewGame(game, numbers) {
    var difficulty, value;

    for (difficulty in vals[game]) {
        value = vals[game][difficulty];
        $("#" + game + "_tr").append("<td class='" + format(value) + "'" + (difficulty == "Extra" && game != "PCB" ? " colspan='2'" : "") +
        ">" + (format(value) == "nbp" || format(value) == "np" ? value : "") + "</td>");

        if (value == "N/A") {
            na[game] += getPercentage(game);
        } else if (value == "Not cleared") {
            numbers[difficulty == "Phantasm" ? "Extra" : difficulty]["Not cleared"] += 1;
            numbers["Total"]["Not cleared"] += 1;
        } else {
            completions[game.contains("IN") ? "IN" : game] += getPercentage(game.contains("IN") ? "IN" : game);
            if (value.substr(0, 2) == "NB" && value.length > 2) {
                numbers[difficulty == "Phantasm" ? "Extra" : difficulty]["NB+"] += 1;
                numbers["Total"]["NB+"] += 1;
            } else if (value.substr(0, 4) == "NMNB" || value == "NNNN") {
                numbers[difficulty == "Phantasm" ? "Extra" : difficulty]["NMNB"] += 1;
                numbers["Total"]["NMNB"] += 1;
            } else {
                value = (format(value) == "np" ? "1cc" : value);
                numbers[difficulty == "Phantasm" ? "Extra" : difficulty][value] += 1;
                numbers["Total"][value] += 1;
            }
        }
    }

    return numbers;
}

function fillOverview(numbers) {
    var id = "#overview_tbody", game, gameID;

    $(id).html("");

    for (game in vals) {
        $(id).append("<tr id='" + game + "_tr'><th>" + game + "</th></tr>");
        gameID = "#" + game + "_tr";

        numbers = fillOverviewGame(game, numbers);

        if (game == "HRtP" || game == "PoDD") {
            $(gameID).append("<td colspan='2'>X</td>");
        }

        if (game == "MS") {
            $(id).append("<tr><td></td><td></td><td></td><td></td><td></td><td colspan='2'></td></tr>");
        }
    }

    return numbers;
}

function fillNumberTable(numbers) {
    var id = "#number_table_tbody", difficulty, value;

    $(id).html("");

    for (difficulty in numbers) {
        if (difficulty == "Total") {
            $(id).append("<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
        }

        $(id).append("<tr id='" + difficulty + "_tr'><th>" + difficulty + "</th></tr>");

        for (value in numbers[difficulty]) {
            $("#" + difficulty + "_tr").append("<td>" + numbers[difficulty][value] + "</td>");
        }
    }
}

function fillCompletionTable() {
    var id = "#completion_table_tbody", game;

    $(id).html("");

    for (game in vals) {
        if (Math.round(na[game]) == 100) {
            continue;
        }

        if (game == "INFinalA") {
            $(id).append("<tr><td>IN</td><td>" + Math.round(completions["IN"]) + "%</td></tr>");
        } else if (game == "INFinalB") {
            continue;
        } else {
            $(id).append("<tr><td>" + game + "</td><td>" + Math.round(completions[game]) + "%</td></tr>");
        }
    }
}

function fileName() {
    var date = new Date(),
        month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});

    return "touhou_survival_progress_" + date.getFullYear() + "_" + month +
    "_" + day + "_" + hours + "_" + minutes + "_" + seconds + ".png";
}

function isMobile() {
    return navigator.userAgent.contains("Mobile") || navigator.userAgent.contains("Tablet");
}

function applyColours() {
    var id, tmp;

    $("select").each(function () {
        id = $(this).attr("id");

        if (id.substr(0, 4) != "fill") {
            if (id.contains("Extra") && !id.contains("PCB") || !id.contains("Extra") && id != "PCBPhantasm" && !id.contains("IN")) {
                $(this).parent().attr("colspan", 2);
                $(this).parent().addClass("overview");
            } else if (id == "PCBExtra" || id == "PCBPhantasm") {
                $(this).parent().addClass("overview_half");
            } else if (id.contains("IN") && !id.contains("Extra")) {
                $(this).parent().addClass("overview_half");
            } else {
                $(this).parent().addClass("overview");
            }

            $(this).parent().addClass(format($(this).val()));
            $(this).parent().html(format($(this).val()) == "nbp" ? $(this).val() : "");

            if ($(this).attr("id").contains("INFinalB")) {
                tmp = $(this).attr("id").replace("INFinal", "");
                $("#" + tmp).addClass(format($(this).val()));
                $("#" + tmp).html(format($(this).val()) == "nbp" ? $(this).val() : "");
            }
        }
    });
}

function prepareRendering() {
    $("#Easy").attr("colspan", 2);
    $("#Normal").attr("colspan", 2);
    $("#Hard").attr("colspan", 2);
    $("#Lunatic").attr("colspan", 2);
    $("#Extra").attr("colspan", 2);
    $("#INFinalA").addClass("bold");
    $("#survival").addClass("rendering");
    $("#survival, #wrap").css("margin-left", "0");
    $("#container, #wrap").css("background-color", "white");
    $("#nav, #ack, #hy_container, #content, #bottom").css("display", "none");
    $("#rendering_message").html("Rendering image...");
    $("#rendering_message").css("display", "block");
    $("#legend").css("display", "table-caption");
    $(".noborders").addClass("overview no_extra");
    $(".no_extra").attr("colspan", 2);
    $(".no_extra").html("X");
    $(".no_extra").removeClass("noborders");
    $(".in_route").remove();
    $(".hidden").addClass("overview_half");
    $(".hidden").css("display", "table-cell");
    applyColours();
    $(".overview").attr("rowspan", 1);
    $("#INFinalBtr").remove();

    for (var i = 0; i < games.length; i++) {
        $("#" + games[i]).addClass("bold");
    }
}

function marginLeft() {
    if (screen.width < 800) {
        return "0";
    } else if (screen.width < 1100) {
        return "8%";
    } else if (screen.width < 1300) {
        return "10%";
    } else if (screen.width < 1500) {
        return "15%";
    } else if (screen.width < 1700) {
        return "20%";
    } else {
        return "24%";
    }
}

function cleanupRendering() {
    if (screen.width > 800) {
        $("#ack").css("display", "block");
    }

    $("#base64").css("max-width", screen.width);
    $("#base64").css("max-height", screen.width);
    $("#container").html(originalContent);
    $("#rendering_message, #legend").css("display", "none");
    $("#nav, #content, #bottom").css("display", "block");
    $("#hy_container").css("display", "block");
    $("#wrap").css("margin-left", marginLeft());
    $("#container, #wrap").removeAttr("style");
    init();
}

function drawOverview() {
    originalContent = $("#container").html();

    prepareRendering();
    try {
        html2canvas(document.getElementById("survival"), {
            backgroundColor: "white",
            "logging": false
        }).then(function(canvas) {
            var base64image = canvas.toDataURL("image/png");

            $("#screenshot").html("<a id='save_link' href='" + base64image + "' download='" + fileName() + "'>" +
            "<input type='button' value='Save to Device'></a> <input id='close' type='button' value='Close'></p>" +
            "<p><img id='base64' src='" + base64image + "' alt='Survival progress table'></p>");
            $("#close").on("click", emptyModal);
            cleanupRendering();
        });
    } catch (err) {
        $("#rendering_message").html("Your browser is outdated. Use a different browser to " +
        "generate an image of your survival progress table.");
    }
}

function printMessage(message) {
    $("#message").html("<strong class='message'>" + message + "</strong>");
}

function save() {
    localStorage.setItem("saveSurvivalData", true);
    localStorage.setItem("vals", JSON.stringify(vals));
    unsavedChanges = false;
    printMessage("Survival table saved!");
}

function apply() {
    var numbers = initAchievementCounts();

    na = initGameCounts();
    completions = initGameCounts();
    numbers = fillOverview(numbers);
    fillNumberTable(numbers);
    fillCompletionTable();
    $("#modal_inner").css("display", "block");
    $("#results").css("display", "block");
    save();
    drawOverview();
    printMessage("");
}

function emptyModal() {
    $("#modal_inner").css("display", "none");
    $("#results").css("display", "none");
    $("#overview_container").css("display", "inline");
    cleanupRendering();
}

function getCookie(name) {
    var decodedCookies, cookieArray, cookie;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');
    name += '=';

    for (var i = 0; i < cookieArray.length; i += 1) {
        cookie = cookieArray[i];

        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }

        if (cookie.indexOf(name) === 0) {
            try {
                return JSON.parse(cookie.substring(name.length, cookie.length));
            } catch (err) {
                return JSON.parse("\"" + cookie.substring(name.length, cookie.length) + "\"");
            }
        }
    }

    return "";
}

function deleteLegacyCookies() {
    if (getCookie("vals")) {
        localStorage.setItem("vals", JSON.stringify(getCookie("vals")));
        deleteCookie("vals");
    }

    if (getCookie("saveCookies")) {
        localStorage.setItem("saveSurvivalData", getCookie("saveCookies"));
        deleteCookie("saveCookies");
    }
}

function readLocalStorage() {
    try {
        if (localStorage.hasOwnProperty("saveSurvivalData") || localStorage.hasOwnProperty("saveData")) {
            $("#toggleData").prop("checked", true);
        }

        var data = localStorage.getItem("vals");

        if (data) {
            vals = JSON.parse(data);

            if (!vals.hasOwnProperty("WBaWC")) {
                vals.WBaWC = {
                    "Easy": "N/A",
                    "Normal": "N/A",
                    "Hard": "N/A",
                    "Lunatic": "N/A",
                    "Extra": "N/A"
                };
            }

            if (!vals.hasOwnProperty("UM")) {
                vals.UM = {
                    "Easy": "N/A",
                    "Normal": "N/A",
                    "Hard": "N/A",
                    "Lunatic": "N/A",
                    "Extra": "N/A"
                };
            }

            if (vals.hasOwnProperty("IN")) {
                vals.INFinalA = vals.IN;
                vals.INFinalB = {
                    "Easy": "N/A",
                    "Normal": "N/A",
                    "Hard": "N/A",
                    "Lunatic": "N/A"
                };
                delete vals.IN;
            }
        }
    } catch (err) {
        // do nothing
    }
}

function init() {
    for (var game in vals) {
        for (var difficulty in vals[game]) {
            $("#" + game + difficulty).val(vals[game][difficulty]);
        }
    }
}

function closeModal(event) {
    var modal = document.getElementById("results");

    if ((event.target && event.target == modal) || (event.keyCode && event.key == "Escape")) {
        emptyModal();
    }
}

function changed() {
    unsavedChanges = true;
}

function fillAll() {
    var value = $("#fillGameDifficulty").val(), achievement = $("#fillAchievement").val();

    if (vals.hasOwnProperty(value)) {
        fillGame(value, achievement);
    } else {
        fillDifficulty(value, achievement);
    }
}

function reset() {
    var confirmation = confirm("Are you sure you want to reset your progress table?"), game, difficulty;

    if (confirmation) {
        $("#toggleData").prop("checked", false);
        localStorage.removeItem("vals");
    }

    for (game in vals) {
        for (difficulty in vals[game]) {
            vals[game][difficulty] = "N/A";
            $("#" + game + difficulty).val("N/A");
        }
    }

    unsavedChanges = false;
    printMessage("Reset the survival table to its default state!");
}

function setProgress() {
    var category = this.id, val = this.value, game, difficulty;

    difficulty = category.match(/Easy|Normal|Hard|Lunatic|Extra|Phantasm/);
    game = category.replace(difficulty, "");
    vals[game][difficulty] = val;
}

function setEventListeners() {
    $("body").on("click", closeModal);
    $("body").on("keyup", closeModal);
    $("select").on("click", changed);
    $("#fillAll").on("click", fillAll);
    $("#save").on("click", save);
    $("#apply").on("click", apply);
    $("#reset").on("click", reset);
    $(".category").on("change", setProgress);
}

function addMobileScrollbars() {
    if (isMobile()) {
        $("#dummy").scroll(function(){
            $("#container").scrollLeft($("#dummy").scrollLeft());
        });
        $("#container").scroll(function(){
            $("#dummy").scrollLeft($("#container").scrollLeft());
        });
    }
}

$(document).ready(function () {
    deleteLegacyCookies();
    readLocalStorage();
    init();
    setEventListeners();
    addMobileScrollbars();
    window.onbeforeunload = function () {
        if (unsavedChanges) {
            return "";
        }

        return undefined;
    }
});
