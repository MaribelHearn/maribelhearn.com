/*global getCookie deleteCookie*/
String.prototype.strip = function () {
    return this.replace(/<\/?[^>]*>/g, "");
};

const games = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM", "FW"];
const diffs = ["Easy", "Normal", "Hard", "Lunatic", "Extra", "Phantasm"];
let unsavedChanges = false;
let precision = 0;
let WRs = {};
let scores = {};

function closeModal(event) {
    const modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.key && event.key == "Escape")) {
        emptyModal();
    }

    // hotkeys
    if (modal.style.display != "block" && event.key) {
        switch (event.key) {
            case 's': save(); break;
            case 't': apply(); break;
            case 'i': importText(); break;
            case 'e': exportText(); break;
            case 'r': reset(); break;
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
    document.getElementById("message").innerHTML = `<strong class="message">${message}</strong>`;
}

function printError(error) {
    document.getElementById("error_message").innerHTML = `<strong class="error_message">${error}</strong>`;
}

function clearMessages() {
    printMessage("");
    printError("");
}

function save() {
    clearMessages();
    const precision = parseInt(document.getElementById("precision").value);
    localStorage.setItem("precision", precision);

    for (const game in scores) {
        localStorage.setItem(game, JSON.stringify(scores[game]));
    }

    unsavedChanges = false;
    printMessage("Scores saved!");
}

function parseScore(game, diff, shot) {
    if (shot.includes(" Team")) {
        shot = shot.replace(" Team", "Team");
    }

    // Legacy GFW Extra
    if (shot === '-') {
        shot = "A1";
    }

    return document.getElementById(game + diff + shot).value.replace(/[^0-9]+/g, "");
}

function validateScore(score) {
    if (score === "") {
        return true;
    }

    if (isNaN(score)) {
        return false;
    }
    
    if (score < 0) {
        return false;
    }

    return score;
}

function getRow(game, diff, shot, precision, emptyWR) {
    let score = parseScore(game, diff, shot);
    const valid = validateScore(score);

    if (!valid || score === "") {
        return false;
    }

    const wr = !emptyWR ? WRs[game][diff][shot] : [0, "no one"];
    score = parseInt(score);
    let percentage, percentageSort, wrText;
    let categories = 0;
    let total = 0;

    if (wr[0] === 0) {
        percentage = '100';
        wrText = '-';
    } else {
        percentage = score / Math.max(wr[0], 1) * 100;
        wrText = `${sep(wr[0])} by <em>${wr[1]}</em>`;
        percentage = (precision === 0 ? Math.round(percentage) : Number(percentage).toFixed(precision));
    }

    const shotText = shot.replace("Team", " Team");
    categories += 1;
    total += Number(percentage);
    percentageSort = percentage * Math.pow(10, precision);
    return {
        "total": total,
        "categories": categories,
        "row": `<tr><td>${game} ${diff}</td><td>${shotText}</td><td data-sort='${score}'>${sep(score)}</td><td data-sort='${percentageSort}'>${percentage}%</td>` +
        `<td><progress value='${percentage}' max='100'></progress></td><td data-sort='${wr[0]}'>${wrText}</td>`
    };
}

function apply() {
    clearMessages();
    let averages = {};
    let scoreTable = "";
    let gameTable = "";
    let zero = true;

    for (const game of games) {
        let total = 0;
        let categories = 0;

        for (const diff in scores[game]) {
            for (const shot in scores[game][diff]) {
                const emptyWR = !WRs.hasOwnProperty(game) || !WRs[game].hasOwnProperty(diff) || !WRs[game][diff].hasOwnProperty(shot);
                const row = getRow(game, diff, shot, precision, emptyWR);

                if (row === false) {
                    scores[game][diff][shot] = 0;
                    continue;
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
        gameTable += `<tr><td>${game}</td><td data-sort='${averages[game]}'>${averages[game]}%</td></tr>`;
    }

    document.getElementById("score_tbody").innerHTML = scoreTable;
    document.getElementById("game_tbody").innerHTML = gameTable;
    document.getElementById("score_table").style.display = "table";
    document.getElementById("game_table").style.display = "table";
    document.getElementById("top_list").style.display = "block";
    document.getElementById("modal").style.display = "block";
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
    printMessage("Copied to clipboard!");
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

        for (const game of games) {
            localStorage.removeItem(game);
        }

        const inputs = document.querySelectorAll("input[type=text]");
        
        for (const input of inputs) {
            input.value = "";
        }

        unsavedChanges = false;
        document.getElementById("score_table").style.display = "none";
        document.getElementById("game_table").style.display = "none";
        document.getElementById("score_tbody").innerHTML = "";
        document.getElementById("game_tbody").innerHTML = "";
        printMessage("Reset the scores!");
    }

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
        localStorage.removeItem("shown");
    }
}

function loadScores() {
    for (const game of games) {
        const data = localStorage.getItem(game);

        if (data) {
            scores[game] = JSON.parse(data);
        }
    }
}

function showScores() {
    for (const game in scores) {
        for (const diff in scores[game]) {
            for (let shot in scores[game][diff]) {
                if (scores[game][diff][shot] != 0) {
                    const score = sep(scores[game][diff][shot]);

                    if (game == "GFW" && diff == "Extra" && shot == '-') {
                        shot = "A1"; // legacy
                    }

                    document.getElementById(game + diff + shot).value = score;
                }
            }
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

    if (!valid) {
        return;
    }

    if (!scores.hasOwnProperty(category.game)) {
        scores[category.game] = {};
    }

    if (!scores[category.game].hasOwnProperty(category.diff)) {
        scores[category.game][category.diff] = {};
    }

    scores[category.game][category.diff][category.shot] = score ? score : 0;
    unsavedChanges = true;
}

function precisionChanged() {
    clearMessages();

    if (!document.getElementById("precision").checkValidity()) {
        document.getElementById("apply").removeEventListener("click", apply, false);
        printError("Invalid precision; minimum is 0, maximum is 5.");
        document.getElementById("precision").value = 0;
        precision = 0;
        return;
    }

    document.getElementById("apply").addEventListener("click", apply, false);
    precision = parseInt(this.value);
}

function setEventListeners() {
    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", closeModal, false);
    document.getElementById("save").addEventListener("click", save, false);
    document.getElementById("apply").addEventListener("click", apply, false);
    document.getElementById("import_button").addEventListener("click", importText, false);
    document.getElementById("export").addEventListener("click", exportText, false);
    document.getElementById("reset").addEventListener("click", reset, false);
    const input = document.querySelectorAll("input");
    const select = document.querySelectorAll(".dropdown-check-list");

    for (const element of input) {
        if (element.id == "precision") {
            element.addEventListener("change", precisionChanged, false);
            continue;
        }

        element.addEventListener("change", scoreChanged, false);
    }

    for (const element of select) {
        element.getElementsByClassName("anchor")[0].addEventListener("click", function() {
            if (element.classList.contains("visible")) {
                element.classList.remove("visible");
            } else {
                element.classList.add("visible");
            }
            
            element.childNodes[0].innerHTML = (element.childNodes[0].innerHTML === "Expand" ? "Collapse" : "Expand");
            const game = element.id.replace("dropdown_", "");
            const tr = document.getElementsByClassName(`row_${game}`);

            for (const row of tr) {
                if (row.classList.contains("visible")) {
                    row.classList.remove("visible");
                } else {
                    row.classList.add("visible");
                }
            }
        });
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
            printError("Error: invalid high scores. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.");
            return;
        }

        value = value.split(' ');
        shot = value[0];
        score = parseInt(value[1]);

        if (isNaN(score) || score < 0) {
            printError("Error: invalid high scores. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.");
            return;
        }

        if (scores[game].hasOwnProperty(diff)) {
            scores[game][diff][shot] = score;
            continue;
        } else {
            printError("Error: invalid high scores. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.");
            return;
        }
    }

    save();
    showScores();
    printMessage("High scores successfully imported!");
}

function init() {
    deleteLegacyCookies();
    const importElement = document.getElementById("import");
    const errorElement = document.getElementById("error");

    try {
        WRs = JSON.parse(document.getElementById("WRs").value);

        for (const game in WRs) {
            scores[game] = {};

            for (const diff in WRs[game]) {
                scores[game][diff] = {};

                for (const shot in WRs[game][diff]) {
                    scores[game][diff][shot] = 0;
                }
            }
        }
    } catch (e) {
        // do nothing
    }

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
