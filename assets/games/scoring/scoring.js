/*global WRs scores getCookie deleteCookie*/
let unsavedChanges = false;

function show(game) {
    document.getElementById(game).style.display = "block";

    if (!document.getElementById(`${game}c`).checked) {
        document.getElementById(`${game}c`).checked = true;
    }
}

function hide(game) {
    document.getElementById(game).style.display = "none";

    if (document.getElementById(`${game}c`).checked) {
        document.getElementById(`${game}c`).checked = false;
    }
}

function checkGame() {
    const checkbox = this.id;
    const element = checkbox.replace('c', "");

    if (document.getElementById(checkbox).checked) {
        show(element);
    } else {
        hide(element);
    }
}

function checkAll() {
    const games = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"];
    const checked = document.getElementById("all").checked;

    if (checked) {
        for (const game of games) {
            show(game);
        }
    } else {
        for (const game of games) {
            hide(game);
        }
    }
}

function sep(number) {
    if (isNaN(number)) {
        return '-';
    }

    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function printMessage(message) {
    document.getElementById("message").innerHTML = message;
}

function printError(error) {
    document.getElementById("error").innerHTML = error;
}

function clearMessages() {
    printMessage("");
    printError("");
}

function save() {
    clearMessages();
    const precision = parseInt(document.getElementById("precision").value);
    localStorage.setItem("precision", precision);
    let shown = {};

    for (const game in scores) {
        shown[game] = document.getElementById(`${game}c`).checked;
        localStorage.setItem(game, JSON.stringify(scores[game]));
    }

    localStorage.setItem("shown", JSON.stringify(shown));
    unsavedChanges = false;
    printMessage("Scores saved!");
}

function verifyConditions(precision) {
    if (isNaN(precision) || precision < 0 || precision > 5) {
        printError("Invalid precision; minimum is 0, maximum is 5.");
        return false;
    }

    return true;
}

function parseScore(game, diff, shot) {
    return document.getElementById(game + diff + shot).value.replace(/,/g, "").replace(/\./g, "").replace(/ /g, "");
}

function validateScore(score) {
    if (score === "" || score < 0) {
        return false;
    }

    if (isNaN(score)) {
        return "invalid";
    }

    return score;
}

function getRow(game, diff, shot, precision) {
    let score = parseScore(game, diff, shot);
    const valid = validateScore(score);

    if (valid === false || valid == "invalid") {
        return valid;
    }

    const wr = WRs[game][diff][shot];
    score = parseInt(score);
    let percentage, wrText;
    let categories = 0;
    let total = 0;

    if (score == wr[0]) {
        score -= 1;
    }
    if (wr[0] === 0) {
        percentage = '-';
        wrText = '-';
    } else {
        percentage = score / wr[0] * 100;
        wrText = `${sep(wr[0])} by <em>${wr[1]}</em>`;
        percentage = (precision === 0 ? Math.round(percentage) : Number(percentage).toFixed(precision));
        total += Number(percentage);
        categories += 1;
    }

    const shotText = shot.replace("Team", " Team");
    return {
        "total": total,
        "categories": categories,
        "row": `<tr><td>${game} ${diff}</td><td>${shotText}</td><td data-sort='${score}'>${sep(score)}</td><td>${percentage}%</td><td><progress value='${percentage}' max='100'></progress></td><td data-sort='${wr[0]}'>${wrText}</td>`
    };
}

function calc() {
    clearMessages();
    const precision = parseInt(document.getElementById("precision").value);

    if (!verifyConditions(precision)) {
        return;
    }

    let averages = {};
    let scoreTable = "";
    let gameTable = "";
    let zero = true;

    for (const game in WRs) {
        if (document.getElementById(game).style.display == "none") {
            continue;
        }

        let total = 0;
        let categories = 0;

        for (const diff in WRs[game]) {
            for (const shot in WRs[game][diff]) {
                const row = getRow(game, diff, shot, precision);

                if (row === false) {
                    scores[game][diff][shot] = 0;
                    continue;
                } else if (row == "invalid") {
                    printError("You entered one or more invalid scores. Please use only digits, dots, commas and spaces.");
                    return;
                } else {
                    total += row.total;
                    categories += row.categories;
                    scoreTable += row.row;
                    zero = false;
                }
            }
        }

        if (categories > 0) {
            const average = total / categories;
            averages[game] = (precision === 0 ? Math.round(average) : Number(average).toFixed(precision));
        }
    }

    if (zero) {
        printError("You have no significant scores! Try to score some more!");
        return;
    }

    for (const game in averages) {
        gameTable += `<tr><td>${game}</td><td>${averages[game]}%</td></tr>`;
    }

    document.getElementById("score_table").style.display = "table";
    document.getElementById("game_table").style.display = "table";
    document.getElementById("score_tbody").innerHTML = scoreTable;
    document.getElementById("game_tbody").innerHTML = gameTable;
}

function reset() {
    clearMessages();
    const confirmation = confirm("Are you sure you want to erase all your scores?");

    if (confirmation) {
        localStorage.removeItem("shown");
        localStorage.removeItem("precision");

        for (const game in scores) {
            localStorage.removeItem(game);

            for (const diff in scores[game]) {
                for (const shot in scores[game][diff]) {
                    scores[game][diff][shot] = 0;
                    document.getElementById(game + diff + shot).value = "";
                }
            }
        }
    }

    unsavedChanges = false;
    document.getElementById("score_table").style.display = "none";
    document.getElementById("game_table").style.display = "none";
    document.getElementById("score_tbody").innerHTML = "";
    document.getElementById("game_tbody").innerHTML = "";
    printMessage("Reset the scores!");
}

function deleteLegacyCookies() {
    if (getCookie("saveCookies")) {
        deleteCookie("saveCookies");
        deleteCookie("precision");
        deleteCookie("shown");

        for (const game in scores) {
            deleteCookie(game);
        }
    }

    if (localStorage.hasOwnProperty("saveScoringData") || localStorage.hasOwnProperty("saveData")) {
        localStorage.removeItem("saveScoringData");
        localStorage.removeItem("saveData");
    }
}

function loadScores() {
    for (const game in scores) {
        const data = localStorage.getItem(game);

        if (data) {
            scores[game] = JSON.parse(data);

            for (const diff in scores[game]) {
                for (const shot in scores[game][diff]) {
                    if (scores[game][diff][shot] !== 0) {
                        document.getElementById(game + diff + shot).value = sep(scores[game][diff][shot]);
                    }
                }
            }
        }
    }
}

function checkShown() {
    let shownData = localStorage.getItem("shown");

    if (shownData) {
        shownData = JSON.parse(shownData);
    }

    for (const game in shownData) {
        if (!shownData[game]) {
            hide(game);
        }
    }
}

function idToCategory(id) {
    const diffs = ["Easy", "Normal", "Hard", "Lunatic", "Extra", "Phantasm"];
    let result = {};

    for (const diff of diffs) {
        if (id.includes(diff)) {
            result.diff = diff;
            id = id.replace(diff, ' ');
            break;
        }
    }

    result.game = id.split(' ')[0];
    result.shot = id.split(' ')[1];
    return result;
}

function scoreChanged() {
    const category = idToCategory(this.id);
    const score = parseScore(category.game, category.diff, category.shot);
    const valid = validateScore(score);

    if (valid === false || valid == "invalid") {
        return;
    }

    scores[category.game][category.diff][category.shot] = score;
    unsavedChanges = true;
}

function setEventListeners() {
    document.getElementById("save").addEventListener("click", save, false);
    document.getElementById("calc").addEventListener("click", calc, false);
    document.getElementById("reset").addEventListener("click", reset, false);
    document.getElementById("all").addEventListener("click", checkAll, false);
    const input = document.querySelectorAll("input");
    const check = document.querySelectorAll(".check");

    for (const element of input) {
        element.addEventListener("change", scoreChanged, false);
    }

    for (const element of check) {
        element.addEventListener("click", checkGame, false);
    }
}

function init() {
    deleteLegacyCookies();

    try {
        loadScores();
        checkShown();
    } catch (e) {
        // do nothing
    }

    if (localStorage.hasOwnProperty("precision")) {
        document.getElementById("precision").value = Number(localStorage.getItem("precision"));
    }

    setEventListeners();
    window.onbeforeunload = function () {
        if (unsavedChanges) {
            return "";
        }

        return undefined;
    }
}

window.addEventListener("DOMContentLoaded", init, false);
