/*global html2canvas isMobile getCookie deleteCookie ClipboardItem*/
String.prototype.strip = function () {
    return this.replace(/<\/?[^>]*>/g, "");
};

const games = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM", "FW"];
const diffs = ["Easy", "Normal", "Hard", "Lunatic", "Extra", "Phantasm"];
const screenshotOptions = {
    backgroundColor: "white",
    logging: false
};
const screenshotOptionsMobile = {
    scale: 1,
    backgroundColor: "white",
    logging: false
};
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

function printMessage(message, rendering, comparison) {
    if (comparison) {
        document.getElementById("comparison_message").innerHTML = `<strong class="message">${message}</strong>`;
        return;
    }

    if (rendering) {
        document.getElementById("rendering_message").innerHTML = `<strong class="message">${message}</strong>`;
        return;
    }

    document.getElementById("message").innerHTML = `<strong class="message">${message}</strong>`;
}

function printError(error, rendering) {
    if (rendering) {
        document.getElementById("rendering_message").innerHTML = `<strong class="error_message">${error}</strong>`;
        return;
    }

    document.getElementById("error_message").innerHTML = `<strong class="error_message">${error}</strong>`;
}

function clearMessages() {
    printMessage("");
    printError("");
    const rendering = true;
    printMessage("", rendering);
    const comparison = true;
    printMessage("", false, comparison);
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
    shot = shot.replace(" Team", "Team");

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
    let percentage, percentagePrecise, percentageSort, wrText;
    let categories = 0;
    let total = 0;

    if (wr[0] === 0) {
        percentage = '100';
        wrText = '-';
    } else {
        percentage = score / Math.max(wr[0], 1) * 100;
        wrText = `${sep(wr[0])} by <em>${wr[1]}</em>`;
        percentage = (precision === 0 ? Math.round(percentage) : Number(percentage).toFixed(precision));
        percentagePrecise = Math.min((score / Math.max(wr[0], 1) * 100).toFixed(8), 100);
    }

    const shotText = shot.replace("Team", " Team");
    categories += 1;
    total += Number(percentage);
    percentageSort = percentage * Math.pow(10, precision);
    return {
        "total": total,
        "categories": categories,
        "percentage": Number(percentagePrecise),
        "row": `<tr><td>${game} ${diff}</td><td>${shotText}</td><td data-sort='${score}'>${sep(score)}</td><td data-sort='${percentageSort}'>${percentage}%</td>` +
        `<td class='progress'><progress value='${percentage}' max='100'></progress></td><td data-sort='${wr[0]}'>${wrText}</td>`
    };
}

function comparisonToClipboard() {
    clearMessages();
    const rendering = false;
    const comparison = true;
    const text = document.getElementById("comparison_file").value;
    navigator.clipboard.writeText(text.replace(/<\/p><p>/g, "\n").strip());
    printMessage("Copied to clipboard!", rendering, comparison);
}

function exportComparison() {
    let comparison = document.getElementById("score_table").childNodes[3].innerHTML;
    comparison = comparison.slice(4, -5)
    comparison = comparison.split("</tr><tr>");
    
    for (let i = 0; i < comparison.length; i++) {
        comparison[i] = comparison[i].slice(4, -5);
        comparison[i] = comparison[i].replace(/ data-sort="\d+"/g, "");
        comparison[i] = comparison[i].replace(/<progress(.*?)\/progress>/g, "");
        comparison[i] = comparison[i].replace(/<\/?em>/g, "");
        comparison[i] = comparison[i].replace(/<\/td><td>/g, "\t");
        comparison[i] = comparison[i].replace(/\t\t/g, "\t");
        comparison[i] = comparison[i].replace(/\s\sTeam/g, " Team");
        const parts = comparison[i].split("\t");

        for (let j = 0; j < parts.length; j++) {
            if (parts[j].length <= 3) {
                comparison[i] = comparison[i].replace(parts[j] + "\t", parts[j] + "\t\t\t\t");
            }
            else if (parts[j].length <= 7) {
                comparison[i] = comparison[i].replace(parts[j] + "\t", parts[j] + "\t\t\t");
            }
            else if (parts[j].length <= 11) {
                comparison[i] = comparison[i].replace(parts[j] + "\t", parts[j] + "\t\t");
            }
        }
    }

    comparison = comparison.join("\n");
    const saveLink = document.getElementById("comparison_link");
    saveLink.href = "data:text/plain;charset=utf-8," + encodeURIComponent(comparison);
    saveLink.download = comparisonFileName("txt");
    document.getElementById("comparison_file").value = comparison;
    document.getElementById("clipboard_comp").addEventListener("click", comparisonToClipboard, false);
}

function percentageToHex(percentage) {
    if (percentage <= 50) {
        const blue = (255 - Math.round(percentage / 50 * 127)).toString(16);
        return "#FFFF" + blue.toString().padStart(2, '0');
    }

    if (percentage <= 70) {
        const blue = (128 - Math.round((percentage - 50) / 20 * 127)).toString(16);
        return "#FFFF" + blue.toString().padStart(2, '0');
    }

    if (percentage <= 85) {
        const green = (255 - Math.round((percentage - 70) / 15 * 127)).toString(16);
        return "#FF" + green.toString().padStart(2, '0') + "00";
    }

    if (percentage <= 95) {
        const green = (128 - Math.round((percentage - 85) / 10 * 127)).toString(16);
        return "#FF" + green.toString().padStart(2, '0') + "00";
    }

    const red = (255 - Math.round((percentage - 95) / 5 * 127)).toString(16);
    return "#" + red.toString().padStart(2, '0') + "0000";
}

function applyColours(highest) {
    for (const game of games) {
        for (const diff in scores[game]) {
            const id = game + diff;
            const percentage = highest[game + diff] || 0;
            const element = document.getElementById(id);
            element.style.backgroundColor = percentageToHex(percentage);

            if (percentage === 100) {
                element.style.color = "white";
                element.style.fontWeight = "bold";
                element.innerHTML = "WR";
            } else {
                element.style.removeProperty("fontWeight");
                element.innerHTML = "";
            }
        }
    }
}

function prepareRendering() {
    window.scrollTo(0, 0);
    document.getElementById("results").scrollTo(0, 0);
    document.getElementById("summary_table").style.display = "table";
    document.getElementById("wrap").style.marginLeft = 0;
    document.getElementById("wrap").style.backgroundColor = "white";
    const toHide = ["nav", "content", "hy_container"];

    for (const id of toHide) {
        document.getElementById(id).style.display = "none";
    }

    // Hide games without scores
    for (const game in scores) {
        let gameSum = 0;

        for (const diff in scores[game]) {
            for (const shot in scores[game][diff]) {
                const score = scores[game][diff][shot];
                gameSum += score;
            }
        }

        if (gameSum === 0) {
            const element = document.getElementById(`${game}tr`);
            element.classList.add("no_scores");
        }
    }
}

function afterScreenshot(canvas) {
    const base64 = canvas.toDataURL("image/png");
    document.getElementById("screenshot_base64").src = base64;
    const saveLink = document.getElementById("screenshot_link");
    saveLink.href = base64;
    saveLink.download = fileName("png");
}

function drawOverview() {
    try {
        if (isMobile()) {
            html2canvas(document.getElementById("summary_table"), screenshotOptionsMobile).then(afterScreenshot);
        } else {
            html2canvas(document.getElementById("summary_table"), screenshotOptions).then(afterScreenshot);
        }

        return true;
    } catch (err) {
        const rendering = true;
        printError("Your browser is outdated. Use a different browser to generate an image of your scoring summary table.", rendering);
        return false;
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
    document.getElementById("summary_table").style.display = "none";
    document.getElementById("wrap").style.marginLeft = marginLeft();
    document.getElementById("wrap").removeAttribute("style");
    const toDisplay = ["nav", "content", "hy_container"];

    for (const id of toDisplay) {
        document.getElementById(id).style.display = "block";
    }

    // Undo hidden games
    for (const game in scores) {
        let gameSum = 0;

        for (const diff in scores[game]) {
            for (const shot in scores[game][diff]) {
                const score = scores[game][diff][shot];
                gameSum += score;
            }
        }

        if (gameSum === 0) {
            const element = document.getElementById(`${game}tr`);
            element.classList.remove("no_scores");
        }
    }
}

function apply() {
    clearMessages();
    let averages = {};
    let highest = {};
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

                if (!highest[game + diff]) {
                    highest[game + diff] = row.percentage;
                }

                if (row.percentage > highest[game + diff]) {
                    highest[game + diff] = row.percentage;
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
    document.getElementById("results").style.display = "block";
    document.getElementById("modal").style.display = "block";
    exportComparison();
    applyColours(highest);
    prepareRendering();
    drawOverview();
    cleanupRendering();
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

function comparisonFileName(extension) {
    const date = new Date();
    const month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    return `touhou_wr_comparison_${date.getFullYear()}_${month}_${day}_${hours}_${minutes}_${seconds}.${extension}`;
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
    let expandedGames = []; // expanded at page load

    for (const game in scores) {
        for (const diff in scores[game]) {
            for (let shot in scores[game][diff]) {
                if (scores[game][diff][shot] !== 0) {
                    if (!expandedGames.includes(game)) {
                        document.getElementById(`dropdown_${game}`).childNodes[0].click();
                        expandedGames.push(game);
                    }

                    const score = sep(scores[game][diff][shot]);
                    shot = shot.replace(" Team", "Team");

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

    scores[category.game][category.diff][category.shot] = score ? parseInt(score) : 0;
    unsavedChanges = true;
}

function base64toBlob(b64Data, contentType) {
    const sliceSize = 512;
    const byteCharacters = atob(b64Data);
    const byteArrays = [];
  
    for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        const slice = byteCharacters.slice(offset, offset + sliceSize);
    
        const byteNumbers = new Array(slice.length);
        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }
    
        const byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }
      
    const blob = new Blob(byteArrays, {type: contentType});
    return blob;
}

function imageToClipboard() {
    clearMessages();
    const id = this.getAttribute("data_id");
    const rendering = true;

    try {
        const base64 = document.getElementById(id).src.slice(22);
        const blob = base64toBlob(base64, "image/png");
        navigator.clipboard.write([
            new ClipboardItem({
                [blob.type]: blob,
            })
        ]);
        printMessage("Copied to clipboard!", rendering);
    } catch (err) {
        printError("Your browser does not support image to clipboard.", rendering);
    }
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
    document.getElementById("clipboard").addEventListener("click", imageToClipboard, false);
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

        value = value.replace(" Team", "Team").split(' ');
        shot = value[0].replace("Team", " Team");
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
}

window.addEventListener("DOMContentLoaded", init, false);
