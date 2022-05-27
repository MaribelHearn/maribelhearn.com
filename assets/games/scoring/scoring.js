/*global $ WRs scores sorttable getCookie deleteCookie*/
var tracked = ["EoSD", "PCB", "IN", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"],
    untracked = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "PoFV"];

function show(game) {
    $("#" + game).css("display", "block");

    if (!$("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", true);
    }
}

function hide(game) {
    $("#" + game).css("display", "none");

    if ($("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", false);
    }
}

function checkGame() {
    var checkbox = "#" + this.id, element = this.id.slice(0, -1);

    if ($(checkbox).is(":checked")) {
        show(element);
    } else {
        hide(element);
    }
}

function checkTracked() {
    var checked = $("#tracked").is(":checked"), key;

    for (key in tracked) {
        if (checked) {
            show(tracked[key]);
        } else {
            hide(tracked[key]);
        }
    }
}

function checkUntracked() {
    var checked = $("#untracked").is(":checked"), key;

    for (key in untracked) {
        if (checked) {
            show(untracked[key]);
        } else {
            hide(untracked[key]);
        }
    }
}

function checkAll() {
    var checked = $("#all").is(":checked");

    $("#tracked").prop("checked", checked);
    $("#untracked").prop("checked", checked);
    checkTracked();
    checkUntracked();
}

function sep(number) {
    if (isNaN(number)) {
        return '-';
    }

    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function calc() {
    var averages = {}, shown = {}, total = 0, categories = 0, highest = 0, game, difficulty,
        id, score, shottype, wr, percentage, wrText, average,
        topList = "<table id='table'><thead><tr><th>Game + Difficulty</th><th>Shottype / Route</th>" +
        "<th class='sorttable_numeric'>Score</th><th>WR Percentage</th><th>Progress Bar</th><th>WR</th></tr></thead><tbody>",
        precision = parseInt($("#precision").val());

    if (isNaN(precision) || precision < 0 || precision > 5) {
        $("#error").html("<strong class='error'>Invalid precision; minimum is 0, maximum is 5.</strong>");
        return;
    } else {
        $("#error").html("");
    }

    for (game in WRs) {
        if ($("#" + game).css("display") == "none") {
            continue;
        }
        total = 0;
        categories = 0;

        for (difficulty in WRs[game]) {
            for (shottype in WRs[game][difficulty]) {
                id = "#" + game + difficulty + shottype;
                score = $(id).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "");

                if (score === "" || score < 0) {
                    scores[game][difficulty][shottype] = 0;
                    $("#error").html("");
                    continue;
                }

                if (isNaN(score)) {
                    $("#error").html("<strong class='error'>You entered one or more invalid scores. " +
                    "Please use only digits, dots, commas and spaces.</strong>");
                    return;
                }

                score = parseInt(score);
                wr = WRs[game][difficulty][shottype];
                scores[game][difficulty][shottype] = score;

                if (score == wr[0]) {
                    score -= 1;
                }
                if (wr[0] === 0) {
                    percentage = '-';
                    wrText = '-';
                } else {
                    percentage = score / wr[0] * 100;
                    wrText = sep(wr[0]) + " by <i>" + wr[1] + "</i>";

                    if (percentage > highest) {
                        highest = percentage;
                    }

                    percentage = (precision === 0 ? Math.round(percentage) : Number(percentage).toFixed(precision));
                    total += Number(percentage);
                    categories += 1;
                }

                topList += "<tr><td>" + game + " " + difficulty + "</td><td>" + shottype.replace("Team", " Team") +
                "</td><td>" + sep(score) + "</td><td>" + percentage + "%</td><td><progress value='" + percentage +
                "' max='100'></progress></td><td>" + wrText + "</td>";
            }
        }

        if (categories > 0) {
            average = total / categories;
            averages[game] = (precision === 0 ? Math.round(average) : Number(average).toFixed(precision));
        }
    }

    topList += "</tbody></table><br><table id='gameTable'><thead><tr><th>Game</th><th>Average Percentage</th></tr></thead><tbody>";

    for (game in averages) {
        topList += "<tr><td>" + game + "</td><td>" + averages[game] + "%</td></tr>";
    }

    topList += "</tbody></table>";

    if (highest === 0) {
        $("#error").html("<strong class='error'>You have no significant scores! Try to score some more!</strong>");
        $("#topList").html("");
        return;
    }

    $("#topList").html(topList);
    sorttable.makeSortable(document.getElementById("table"));
    sorttable.makeSortable(document.getElementById("gameTable"));
    if ($("#toggleData").is(":checked")) {
        localStorage.setItem("saveScoringData", true);
        localStorage.setItem("precision", precision);

        for (game in scores) {
            shown[game] = $("#" + game + "c").is(":checked");
            localStorage.setItem("shown", JSON.stringify(shown));
            localStorage.setItem(game, JSON.stringify(scores[game]));
        }
    } else {
        localStorage.removeItem("saveScoringData");
    }
}

function save() {
    if ($("#toggleData").is(":checked")) {
        localStorage.setItem("saveScoringData", true);
    } else {
        localStorage.removeItem("saveScoringData");
    }
}

function reset() {
    var confirmation = confirm("Are you sure you want to erase all your scores?"), game, difficulty, shottype;

    if (confirmation) {
        localStorage.removeItem("shown");
        localStorage.removeItem("precision");
        for (game in scores) {
            localStorage.removeItem(game);

            for (difficulty in scores[game]) {
                for (shottype in scores[game][difficulty]) {
                    scores[game][difficulty][shottype] = 0;
                    $("#" + game + difficulty + shottype).val("");
                }
            }
        }
    }
}

function loadScores() {
    var game, data, difficulty, shottype;

    for (game in scores) {
        data = localStorage.getItem(game);

        if (data) {
            scores[game] = JSON.parse(data);

            for (difficulty in scores[game]) {
                for (shottype in scores[game][difficulty]) {
                    if (scores[game][difficulty][shottype] !== 0) {
                        $("#" + game + difficulty + shottype).val(sep(scores[game][difficulty][shottype]));
                    }
                }
            }
        }
    }
}

function checkShown() {
    var shownData = localStorage.getItem("shown"), game;

    if (shownData) {
        shownData = JSON.parse(shownData);
    }

    for (game in shownData) {
        if (!shownData[game]) {
            hide(game);
        }
    }
}

$(document).ready(function () {
    var game;

    if (getCookie("saveCookies")) {
        deleteCookie("saveCookies");
        deleteCookie("precision");
        deleteCookie("shown");

        for (game in scores) {
            deleteCookie(game);
        }
    }

    try {
        loadScores();
        checkShown();
        $("#precision").val(localStorage.precision ? Number(localStorage.precision) : 0);

        if (localStorage.hasOwnProperty("saveScoringData") || localStorage.hasOwnProperty("saveData")) {
            $("#toggleData").prop("checked", true);
        }
    } catch (e) {
        // do nothing
    }

    $("#calc").on("click", calc);
    $("#reset").on("click", reset);
    $("#tracked").on("click", checkTracked);
    $("#untracked").on("click", checkUntracked);
    $("#all").on("click", checkAll);
    $(".check").on("click", checkGame);
    $("#toggleData").on("click", save);
});
