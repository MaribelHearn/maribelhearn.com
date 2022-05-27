/*global $ html2canvas getCookie deleteCookie*/
let games = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "INFinalA",
    "INFinalB", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"],
    vals = {}, unsavedChanges = false, originalContent, completions, na;

for (let game of games) {
    vals[game] = {
        "Easy": "N/A",
        "Normal": "N/A",
        "Hard": "N/A",
        "Lunatic": "N/A"
    };

    if (game != "HRtP" && game != "PoDD" && game != "INFinalB") {
        vals[game].Extra = "N/A";
    }

    if (game == "PCB") {
        vals.PCB.Phantasm = "N/A";
    }
}

function getPercentage(game) {
    if (game.includes("IN")) {
        return 100 / (Object.keys(vals["INFinalA"]).length + Object.keys(vals["INFinalB"]).length);
    }

    return 100 / Object.keys(vals[game]).length;
}

function gameSpecific(game, achievement) {
    if (achievement != "NM+" && achievement != "NB+" && achievement != "NMNB") {
        return achievement;
    }

    switch (game) {
        case "PCB": return ({"NM+": "NMNBB", "NB+": "NBNBB", "NMNB": "NMNBNBB"}[achievement]);
        case "UFO": return ({"NM+": "NMNV", "NB+": "NBNV", "NMNB": "NMNB(NV)"}[achievement]);
        case "TD": return ({"NM+": "NMNT", "NB+": "NBNT", "NMNB": "NMNBNT"}[achievement]);
        case "HSiFS": return ({"NM+": "NMNR", "NB+": "NBNR", "NMNB": "NMNBNR"}[achievement]);
        case "WBaWC": return ({"NM+": "NMNHNRB", "NB+": "NBNHNRB", "NMNB": "NNNN"}[achievement]);
        case "UM": return ({"NM+": "NMNC", "NB+": "NBNC", "NMNB": "NMNBNC"}[achievement]);
        default: return ({"NM+": "NM", "NB+": "NB", "NMNB": "NMNB"}[achievement]);
    }
}

function fillGame(game, achievement) {
    for (let difficulty in vals[game]) {
        let tmp = achievement;

        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB") {
            achievement = gameSpecific(game, achievement);
        }

        $("#" + game + difficulty).val(achievement);
        vals[game][difficulty] = achievement;
        achievement = tmp;
    }

    if (game == "INFinalB") {
        if (achievement == "NM+" || achievement == "NB+") {
            achievement = achievement.slice(0, -1);
        }

        $("#INFinalAExtra").val(achievement);
        vals["INFinalA"]["Extra"] = achievement;
    }
}

function fillDifficulty(difficulty, achievement) {
    if (difficulty == "Extra") {
        $("#PCBPhantasm").val(gameSpecific("PCB", achievement));
        vals.PCB.Phantasm = gameSpecific("PCB", achievement);
    }

    for (let game in vals) {
        let tmp;

        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB") {
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
        "Easy": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Normal": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Hard": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Lunatic": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Extra": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0 },
        "Total": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0 }
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
        "NMNBB": "nmp",
        "NMNV": "nmp",
        "NMNT": "nmp",
        "NMNR": "nmp",
        "NMNHNRB": "nmp",
        "NMNC": "nmp",
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

function needsText(achievement) {
    achievement = format(achievement);

    switch (achievement) {
        case "np": return true;
        case "nmp": return true;
        case "nbp": return true;
        default: return false;
    }
}

function fillOverviewGame(game, numbers) {
    for (let difficulty in vals[game]) {
        let value = vals[game][difficulty];
        $("#" + game + "_tr").append("<td class='" + format(value) + "'" + (difficulty == "Extra" && game != "PCB" ? " colspan='2'" : "") +
        ">" + (needsText(value) ? value : "") + "</td>");

        if (value == "N/A") {
            na[game] += getPercentage(game);
        } else if (value == "Not cleared") {
            numbers[difficulty == "Phantasm" ? "Extra" : difficulty]["Not cleared"] += 1;
            numbers["Total"]["Not cleared"] += 1;
        } else {
            completions[game.includes("IN") ? "IN" : game] += getPercentage(game.includes("IN") ? "IN" : game);
            if (value.substr(0, 2) == "NM" && value.length > 2 && value.substr(2, 2) != "NB") {
                numbers[difficulty == "Phantasm" ? "Extra" : difficulty]["NM+"] += 1;
                numbers["Total"]["NM+"] += 1;
            } else if (value.substr(0, 2) == "NB" && value.length > 2) {
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
    let id = "#overview_tbody";
    $(id).html("");

    for (let game in vals) {
        let gameID = "#" + game + "_tr";
        $(id).append("<tr id='" + game + "_tr'><th>" + game + "</th></tr>");
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
    let id = "#number_table_tbody";
    $(id).html("");

    for (let difficulty in numbers) {
        if (difficulty == "Total") {
            $(id).append("<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
        }

        $(id).append("<tr id='" + difficulty + "_tr'><th>" + difficulty + "</th></tr>");

        for (let value in numbers[difficulty]) {
            $("#" + difficulty + "_tr").append("<td>" + numbers[difficulty][value] + "</td>");
        }
    }
}

function fillCompletionTable() {
    let id = "#completion_table_tbody";
    $(id).html("");

    for (let game in vals) {
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
    let date = new Date(),
        month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});

    return "touhou_survival_progress_" + date.getFullYear() + "_" + month +
    "_" + day + "_" + hours + "_" + minutes + "_" + seconds + ".png";
}

function applyColours() {
    $("select").each(function () {
        let id = $(this).attr("id");

        if (id.substr(0, 4) != "fill") {
            if (id.includes("Extra") && !id.includes("PCB") || !id.includes("Extra") && id != "PCBPhantasm" && !id.includes("IN")) {
                $(this).parent().attr("colspan", 2);
                $(this).parent().addClass("overview");
            } else if (id == "PCBExtra" || id == "PCBPhantasm") {
                $(this).parent().addClass("overview_half");
            } else if (id.includes("IN") && !id.includes("Extra")) {
                $(this).parent().addClass("overview_half");
            } else {
                $(this).parent().addClass("overview");
            }

            let value = $(this).val();
            $(this).parent().addClass(format(value));
            $(this).parent().html(needsText(value) ? $(this).val() : "");

            if ($(this).attr("id").includes("INFinalB")) {
                let tmp = $(this).attr("id").replace("INFinal", "");
                $("#" + tmp).addClass(format(value));
                $("#" + tmp).html(needsText(value) ? value : "");
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

    for (let game of games) {
        $("#" + game).addClass("bold");
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
            const base64image = canvas.toDataURL("image/png");

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
    let numbers = initAchievementCounts();
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

        let data = localStorage.getItem("vals");

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
    for (let game in vals) {
        for (let difficulty in vals[game]) {
            $("#" + game + difficulty).val(vals[game][difficulty]);
        }
    }
}

function closeModal(event) {
    let modal = document.getElementById("results");

    if ((event.target && event.target == modal) || (event.keyCode && event.key == "Escape")) {
        emptyModal();
    }
}

function changed() {
    unsavedChanges = true;
}

function fillAll() {
    let value = $("#fillGameDifficulty").val();
    let achievement = $("#fillAchievement").val();

    if (vals.hasOwnProperty(value)) {
        fillGame(value, achievement);
    } else {
        fillDifficulty(value, achievement);
    }
}

function reset() {
    let confirmation = confirm("Are you sure you want to reset your progress table?");

    if (confirmation) {
        $("#toggleData").prop("checked", false);
        localStorage.removeItem("vals");
    }

    for (let game in vals) {
        for (let difficulty in vals[game]) {
            vals[game][difficulty] = "N/A";
            $("#" + game + difficulty).val("N/A");
        }
    }

    unsavedChanges = false;
    printMessage("Reset the survival table to its default state!");
}

function setProgress() {
    let category = this.id;
    let val = this.value;
    let difficulty = category.match(/Easy|Normal|Hard|Lunatic|Extra|Phantasm/);
    let game = category.replace(difficulty, "");
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

$(document).ready(function () {
    deleteLegacyCookies();
    readLocalStorage();
    init();
    setEventListeners();
    window.onbeforeunload = function () {
        if (unsavedChanges) {
            return "";
        }

        return undefined;
    }
});
