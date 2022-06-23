/*global html2canvas isMobile getCookie deleteCookie*/
const games = ["HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "INFinalA", "INFinalB", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM"];
let vals = {};
let unsavedChanges = false;
let originalContent, completions, na;

for (const game of games) {
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
    for (const difficulty in vals[game]) {
        const tmp = achievement;

        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB") {
            achievement = gameSpecific(game, achievement);
        }

        document.getElementById(game + difficulty).value = achievement;
        vals[game][difficulty] = achievement;
        achievement = tmp;
    }

    if (game == "INFinalB") {
        if (achievement == "NM+" || achievement == "NB+") {
            achievement = achievement.slice(0, -1);
        }

        document.getElementById("INFinalAExtra").value = achievement;
        vals["INFinalA"]["Extra"] = achievement;
    }
}

function fillDifficulty(difficulty, achievement) {
    if (difficulty == "Extra") {
        document.getElementById("PCBPhantasm").value = gameSpecific("PCB", achievement);
        vals.PCB.Phantasm = gameSpecific("PCB", achievement);
    }

    for (const game in vals) {
        let tmp;

        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB") {
            tmp = gameSpecific(game, achievement);
        } else {
            tmp = achievement;
        }

        if (difficulty == "Extra" && (game == "HRtP" || game == "PoDD" || game == "INFinalB")) {
            continue;
        }

        document.getElementById(game + difficulty).value = tmp;
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

function runQuerySelectors() {
    const toHide = ["nav", "hy_container", "content", "bottom"];
    const noBorders = document.querySelectorAll(".noborders");

    for (const id of toHide) {
        document.getElementById(id).style.display = "none";
    }

    for (const element of noBorders) {
        element.classList.add("overview");
        element.classList.add("no_extra");
    }

    const hidden = document.querySelectorAll(".hidden");
    const inRoute = document.querySelectorAll(".in_route");
    const noExtra = document.querySelectorAll(".no_extra");

    for (const element of hidden) {
        element.classList.add("overview_half");
        element.style.display = "table-cell";
    }

    for (const element of inRoute) {
        element.parentNode.removeChild(element);
    }

    for (const element of noExtra) {
        element.setAttribute("colspan", 2);
        element.innerHTML = "X";
        element.classList.remove("noborders");
    }

    const overview = document.querySelectorAll(".overview");
    const toRemove = document.getElementById("INFinalBtr");
    toRemove.parentNode.removeChild(toRemove);

    for (const element of overview) {
        element.setAttribute("rowspan", 1);
    }
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

function applyColours() {
    for (const game of games) {
        if (game == "INFinalB") {
            continue;
        }

        for (const diff in vals[game]) {
            const id = game + diff;
            const element = document.getElementById(id);

            if (id.includes("Extra") && !id.includes("PCB") && !id.includes("IN") || !id.includes("Extra") && id != "PCBPhantasm" && !id.includes("IN")) {
                element.parentNode.setAttribute("colspan", 2);
                element.parentNode.classList.add("overview");
            } else if (id == "PCBExtra" || id == "PCBPhantasm") {
                element.parentNode.classList.add("overview_half");
            } else if (id.includes("IN") && !id.includes("Extra")) {
                element.parentNode.classList.add("overview_half");
            } else {
                element.parentNode.classList.add("overview");
            }
    
            const value = element.value;
    
            if (format(value) !== "") {
                element.parentNode.classList.add(format(value));
            }
    
            element.parentNode.innerHTML = (needsText(value) ? value : "");

            if (id.includes("INFinalA") && !id.includes("Extra")) {
                const finalBelement = document.getElementById(id.replace("INFinalA", "B"));
                const value = vals["INFinalB"][diff];

                if (format(value) !== "") {
                    finalBelement.classList.add(format(value));
                }

                finalBelement.innerHTML = (needsText(value) ? value : "");
            }
        }
    }
}

function prepareRendering() {
    document.getElementById("Easy").setAttribute("colspan", 2);
    document.getElementById("Normal").setAttribute("colspan", 2);
    document.getElementById("Hard").setAttribute("colspan", 2);
    document.getElementById("Lunatic").setAttribute("colspan", 2);
    document.getElementById("Extra").setAttribute("colspan", 2);
    document.getElementById("rendering_message").style.display = "block";
    document.getElementById("legend").style.display = "table-caption";
    document.getElementById("INFinalA").classList.add("bold");
    document.getElementById("survival").classList.add("rendering");
    document.getElementById("survival").style.marginLeft = 0;
    document.getElementById("wrap").style.marginLeft = 0;
    document.getElementById("wrap").style.backgroundColor = "white";
    document.getElementById("container").style.backgroundColor = "white";
    document.getElementById("INFinalAExtra").parentNode.setAttribute("rowspan", 1);
    document.getElementById("INFinalAExtra").parentNode.setAttribute("colspan", 2);
    runQuerySelectors();
    applyColours();

    for (const game of games) {
        if (game.includes("IN")) {
            continue;
        }

        document.getElementById(game).classList.add("bold");
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
    const toDisplay = ["nav", "content", "bottom", "hy_container"];
    document.getElementById("screenshot_base64").style.maxWidth = screen.width;
    document.getElementById("screenshot_base64").style.maxHeight = screen.width;
    document.getElementById("container").innerHTML = originalContent;
    document.getElementById("wrap").style.marginLeft = marginLeft();
    document.getElementById("wrap").removeAttribute("style");
    document.getElementById("container").removeAttribute("style");
    document.getElementById("rendering_message").style.display = "none";
    document.getElementById("legend").style.display = "none";

    for (const id of toDisplay) {
        document.getElementById(id).style.display = "block";
    }

    initValues();
    setEventListenersSelect();
}

function fileName() {
    const date = new Date();
    const month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    return `touhou_survival_progress_${date.getFullYear()}_${month}_${day}_${hours}_${minutes}_${seconds}.png`;
}

function afterScreenshot(canvas) {
    const base64 = canvas.toDataURL("image/png");
    document.getElementById("screenshot_base64").src = base64;
    const saveLink = document.getElementById("save_link");
    saveLink.href = base64;
    saveLink.download = fileName();
    cleanupRendering();
}

function takeScreenshotMobile() {
    html2canvas(document.getElementById("survival"), {
        width: document.getElementById("modal_inner").offsetWidth,
        backgroundColor: "white",
        "logging": false
    }).then(afterScreenshot);
}

function takeScreenshot() {
    html2canvas(document.getElementById("survival"), {
        backgroundColor: "white",
        "logging": false
    }).then(afterScreenshot);
}

function drawOverview() {
    originalContent = document.getElementById("container").innerHTML;
    prepareRendering();

    try {
        if (isMobile()) {
            alert("m");
            takeScreenshotMobile();
        } else {
            takeScreenshot();
        }
    } catch (err) {
        document.getElementById("rendering_message").innerHTML = "Your browser is outdated. Use a different browser to generate an image of your survival progress table.";
    }
}

function printMessage(message) {
    document.getElementById("message").innerHTML = `<strong class='message'>${message}</strong>`;
}

function emptyModal() {
    cleanupRendering();
    document.getElementById("container").style.display = "block";
    document.getElementById("modal_inner").style.display = "none";
    document.getElementById("modal").style.display = "none";
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

    if (localStorage.hasOwnProperty("saveSurvivalData") || localStorage.hasOwnProperty("saveData")) {
        localStorage.removeItem("saveSurvivalData");
        localStorage.removeItem("saveData");
    }
}

function readLocalStorage() {
    try {
        const data = localStorage.getItem("vals");

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

            if (vals.INFinalB.hasOwnProperty("Extra")) {
                delete vals.INFinalB.Extra;
            }
        }
    } catch (err) {
        // do nothing
    }
}

function closeModal(event) {
    const modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.key && event.key == "Escape")) {
        emptyModal();
    }
}

function initValues() {
    for (const game in vals) {
        for (const difficulty in vals[game]) {
            const select = document.getElementById(game + difficulty);
            select.value = vals[game][difficulty];
        }
    }
}

function fillAll() {
    const value = document.getElementById("fillGameDifficulty").value;
    const achievement = document.getElementById("fillAchievement").value;

    if (vals.hasOwnProperty(value)) {
        fillGame(value, achievement);
    } else {
        fillDifficulty(value, achievement);
    }
}

function save() {
    localStorage.setItem("saveSurvivalData", true);
    localStorage.setItem("vals", JSON.stringify(vals));
    unsavedChanges = false;
    printMessage("Survival table saved!");
}

function getPercentage(game) {
    if (game.includes("IN")) {
        return 100 / (Object.keys(vals["INFinalA"]).length + Object.keys(vals["INFinalB"]).length);
    }

    return 100 / Object.keys(vals[game]).length;
}

function countAchievements(numbers) {
    for (const game in vals) {
        for (let diff in vals[game]) {
            let value = vals[game][diff];
            diff = (diff == "Phantasm" ? "Extra" : diff);
    
            if (value == "N/A") {
                na[game] += getPercentage(game);
            } else if (value == "Not cleared") {
                numbers[diff]["Not cleared"] += 1;
                numbers["Total"]["Not cleared"] += 1;
            } else {
                let gameTmp = (game.includes("IN") ? "IN" : game);
                completions[gameTmp] += getPercentage(gameTmp);
    
                if (value.substr(0, 2) == "NM" && value.length > 2 && value.substr(2, 2) != "NB") {
                    numbers[diff]["NM+"] += 1;
                    numbers["Total"]["NM+"] += 1;
                } else if (value.substr(0, 2) == "NB" && value.length > 2) {
                    numbers[diff]["NB+"] += 1;
                    numbers["Total"]["NB+"] += 1;
                } else if (value.substr(0, 4) == "NMNB" || value == "NNNN") {
                    numbers[diff]["NMNB"] += 1;
                    numbers["Total"]["NMNB"] += 1;
                } else {
                    value = (format(value) == "np" ? "1cc" : value);
                    numbers[diff][value] += 1;
                    numbers["Total"][value] += 1;
                }
            }
        }
    }

    return numbers;
}

function fillNumberTable(numbers) {
    const tbody = document.getElementById("number_table_tbody");
    tbody.innerHTML = "";

    for (const difficulty in numbers) {
        if (difficulty == "Total") {
            tbody.innerHTML += "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
        }

        tbody.innerHTML += `<tr id='${difficulty}_tr'><th>${difficulty}</th></tr>`;

        for (const value in numbers[difficulty]) {
            document.getElementById(`${difficulty}_tr`).innerHTML += `<td>${numbers[difficulty][value]}</td>`;
        }
    }
}

function fillCompletionTable() {
    const tbody = document.getElementById("completion_table_tbody");
    tbody.innerHTML = "";

    for (let game in vals) {
        if (game.includes("IN")) {
            continue;
        }

        if (Math.round(na[game]) == 100) {
            continue;
        }

        tbody.innerHTML += `<tr><td>${game}</td><td>${Math.round(completions[game])}%</td></tr>`;

        if (game == "PCB") { // otherwise IN is at the end
            tbody.innerHTML += `<tr><td>IN</td><td>${Math.round(completions["IN"])}%</td></tr>`;
        }
    }
}

function apply() {
    let numbers = initAchievementCounts();
    na = initGameCounts();
    completions = initGameCounts();
    numbers = countAchievements(numbers);
    fillNumberTable(numbers);
    fillCompletionTable();
    document.getElementById("modal_inner").style.display = "block";
    document.getElementById("modal").style.display = "block";
    drawOverview();
    printMessage("");
}

function reset() {
    const confirmation = confirm("Are you sure you want to reset your progress table?");

    if (confirmation) {
        localStorage.removeItem("vals");
    }

    for (const game in vals) {
        for (const difficulty in vals[game]) {
            vals[game][difficulty] = "N/A";
            document.getElementById(game + difficulty).value = "N/A";
        }
    }

    unsavedChanges = false;
    printMessage("Reset the survival table to its default state!");
}

function setProgress() {
    const category = this.id;
    const val = this.value;
    const difficulty = category.match(/Easy|Normal|Hard|Lunatic|Extra|Phantasm/)[0];
    const game = category.replace(difficulty, "");
    vals[game][difficulty] = val;
}

function setEventListenersSelect() {
    const select = document.querySelectorAll("select");
    const categories = document.querySelectorAll(".category");

    for (const element of select) {
        element.addEventListener("click", function () { unsavedChanges = true }, false);
    }

    for (const element of categories) {
        element.addEventListener("change", setProgress, false);
    }
}

function setEventListeners() {
    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", closeModal, false);
    document.getElementById("fill_all").addEventListener("click", fillAll, false);
    document.getElementById("save").addEventListener("click", save, false);
    document.getElementById("apply").addEventListener("click", apply, false);
    document.getElementById("reset").addEventListener("click", reset, false);
    document.getElementById("close").addEventListener("click", emptyModal, false);
    setEventListenersSelect();
}

function init() {
    deleteLegacyCookies();
    readLocalStorage();
    initValues();
    setEventListeners();
    window.onbeforeunload = function () {
        if (unsavedChanges) {
            return "";
        }

        return undefined;
    }
}

window.addEventListener("DOMContentLoaded", init, false);
