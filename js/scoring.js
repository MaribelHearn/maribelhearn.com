/*global WRs scores getCookie deleteCookie*/
String.prototype.strip = function () {
    return this.replace(/<\/?[^>]*>/g, "");
};

const games = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"];
const diffs = ["Easy", "Normal", "Hard", "Lunatic", "Extra", "Phantasm"];
let unsavedChanges = false;
let precision = 0;

function closeModal(event) {
    const modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.key && event.key == "Escape")) {
        emptyModal();
    }
}

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
    document.getElementById("error_message").innerHTML = error;
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
    let percentage, percentageSort, wrText;
    let categories = 0;
    let total = 0;

    if (wr[0] === 0) {
        percentage = '-';
        wrText = '-';
    } else {
        percentage = score / wr[0] * 100;
        wrText = `${sep(wr[0])} by <em>${wr[1]}</em>`;
        percentage = (precision === 0 ? Math.round(percentage) : Number(percentage).toFixed(precision));
        percentageSort = percentage * Math.pow(10, precision);
        total += Number(percentage);
        categories += 1;
    }

    const shotText = shot.replace("Team", " Team");
    return {
        "total": total,
        "categories": categories,
        "row": `<tr><td>${game} ${diff}</td><td>${shotText}</td><td data-sort='${score}'>${sep(score)}</td><td data-sort='${percentageSort}'>${percentage}%</td>` +
        `<td><progress value='${percentage}' max='100'></progress></td><td data-sort='${wr[0]}'>${wrText}</td>`
    };
}

function calc() {
    clearMessages();
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

function emptyModal() {
    document.getElementById("modal").style.display = "none";
    const innerModals = document.querySelectorAll(".modal_inner");
    
    for (const element of innerModals) {
        element.style.display = "none";
    }
}

function importText() {
    emptyModal();
    clearMessages();
    document.getElementById("import_text").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function fileName(extension) {
    const date = new Date();
    const month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    return `touhou_high_scores_${date.getFullYear()}_${month}_${day}_${hours}_${minutes}_${seconds}.${extension}`;
}

function copyToClipboard() {
    emptyModal();
    const text = document.getElementById("text_file").value;
    navigator.clipboard.writeText(text.replace(/<\/p><p>/g, "\n").strip());
    printMessage("<strong>Copied to clipboard!</strong>");
}

function exportText() {
    emptyModal();
    clearMessages();
    let textFile = "";

    for (const game in scores) {
        textFile += `${game}:\n`;

        for (const diff in scores[game]) {
            textFile += `  ${diff}:\n`;

            for (const shot in scores[game][diff]) {
                textFile += `    ${shot}: ${scores[game][diff][shot]}\n`;
            }
        }

        textFile += '\n';
    }

    const saveLink = document.getElementById("save_link");
    saveLink.href = "data:text/plain;charset=utf-8," + encodeURIComponent(textFile);
    saveLink.download = fileName("txt");
    document.getElementById("copy_to_clipboard").addEventListener("click", copyToClipboard, false);
    document.getElementById("text_file").value = textFile;
    document.getElementById("export_text").style.display = "block";
    document.getElementById("modal").style.display = "block";
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
        }
    }
}

function showScores() {
    for (const game in scores) {
        for (const diff in scores[game]) {
            for (const shot in scores[game][diff]) {
                if (scores[game][diff][shot]) {
                    document.getElementById(game + diff + shot).value = sep(scores[game][diff][shot]);
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
    if (this.id == "import_file") {
        return;
    }

    const category = idToCategory(this.id);
    const score = parseScore(category.game, category.diff, category.shot);
    const valid = validateScore(score);

    if (valid === false || valid == "invalid") {
        return;
    }

    scores[category.game][category.diff][category.shot] = score;
    unsavedChanges = true;
}

function precisionChanged() {
    clearMessages();

    if (!document.getElementById("precision").checkValidity()) {
        document.getElementById("calc").removeEventListener("click", calc, false);
        printError("Invalid precision; minimum is 0, maximum is 5.");
        return;
    }

    document.getElementById("calc").addEventListener("click", calc, false);
    precision = parseInt(this.value);
}

function setEventListeners() {
    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", closeModal, false);
    document.getElementById("save").addEventListener("click", save, false);
    document.getElementById("calc").addEventListener("click", calc, false);
    document.getElementById("import_button").addEventListener("click", importText, false);
    document.getElementById("export").addEventListener("click", exportText, false);
    document.getElementById("reset").addEventListener("click", reset, false);
    document.getElementById("all").addEventListener("click", checkAll, false);
    const input = document.querySelectorAll("input");
    const check = document.querySelectorAll(".check");

    for (const element of input) {
        if (element.id == "precision") {
            element.addEventListener("change", precisionChanged, false);
            continue;
        }

        element.addEventListener("change", scoreChanged, false);
    }

    for (const element of check) {
        element.addEventListener("click", checkGame, false);
    }
}

function doImport() {
    const text = document.getElementById("import").value.trim().split('\n');
    let game;
    let diff;
    let shot;
    let score;

    for (const line of text) {
        if (line === "") {
            continue;
        }

        let value = line.replace(':', "").trim();

        if (games.includes(value)) {
            game = value;
            continue;
        } else if (diffs.includes(value)) {
            diff = value;
            continue;
        } else if (!game) {
            printError("<strong>Error: invalid high scores. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.</strong>");
            return;
        }

        value = value.split(' ');
        shot = value[0];
        score = parseInt(value[1]);

        if (isNaN(score) || score < 0) {
            printError("<strong>Error: invalid high scores. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.</strong>");
            return;
        }

        if (scores[game].hasOwnProperty(diff)) {
            scores[game][diff][shot] = score;
            continue;
        } else {
            printError("<strong>Error: invalid high scores. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.</strong>");
            return;
        }
    }

    save();
    showScores();
    checkShown();
    printMessage("<strong>High scores successfully imported!</strong>");
}

function init() {
    deleteLegacyCookies();
    const importElement = document.getElementById("import");
    const errorElement = document.getElementById("error");

    if (importElement) {
        doImport();
        importElement.parentNode.removeChild(importElement);
    } else {
        if (errorElement && errorElement.value) {
            printMessage(errorElement.value);
            errorElement.parentNode.removeChild(errorElement);
        }

        try {
            loadScores();
            showScores();
            checkShown();
        } catch (e) {
            // do nothing
        }
    }

    if (localStorage.hasOwnProperty("precision")) {
        precision = document.getElementById("precision").value = parseInt(localStorage.getItem("precision"));
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
