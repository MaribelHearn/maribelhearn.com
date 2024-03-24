/*global html2canvas isMobile getCookie deleteCookie*/
String.prototype.strip = function () {
    return this.replace(/<\/?[^>]*>/g, "");
};

const games = ["HRtPMakai", "HRtPJigoku", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "INFinalA", "INFinalB", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLKLegacy", "LoLKPointdevice", "HSiFS", "WBaWC", "UM", "UDoALG"];
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

    if (game != "HRtPMakai" && game != "HRtPJigoku" && game != "PoDD" && game != "INFinalB" && game != "LoLKPointdevice" && game != "UDoALG") {
        vals[game].Extra = "N/A";
    }

    if (game == "PCB") {
        vals.PCB.Phantasm = "N/A";
    }
}

function gameSpecific(game, achievement) {
    if (!achievement.includes('+')) {
        return achievement;
    }

    switch (game) {
        case "PCB": return ({"NM+": "NMNBB", "NB+": "NBNBB", "NMNB+": "NNN"}[achievement]);
        case "UFO": return ({"NM+": "NMNV", "NB+": "NBNV", "NMNB+": "NNN"}[achievement]);
        case "TD": return ({"NM+": "NMNT", "NB+": "NBNT", "NMNB+": "NNN"}[achievement]);
        case "HSiFS": return ({"NM+": "NMNR", "NB+": "NBNR", "NMNB+": "NNN"}[achievement]);
        case "WBaWC": return ({"NM+": "NMNHNRB", "NB+": "NBNHNRB", "NMNB+": "NNNN"}[achievement]);
        case "UM": return ({"NM+": "NMNC", "NB+": "NBNC", "NMNB+": "NNN"}[achievement]);
        default: return ({"NM+": "NM", "NB+": "NB", "NMNB+": "NMNB"}[achievement]);
    }
}

function fillGame(game, achievement) {
    for (const difficulty in vals[game]) {
        const tmp = achievement;

        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB+") {
            achievement = gameSpecific(game, achievement);
        }

        const category = game + difficulty;
        const checkboxes = document.querySelectorAll(`#${category} input[type='checkbox']`);
        const boxesToCheck = progressToCheckboxes(game, achievement);

        for (const element of checkboxes) {
            element.checked = boxesToCheck.includes(element.value);
        }

        document.getElementById(category + "a").innerHTML = achievement;
        vals[game][difficulty] = achievement;
        achievement = tmp;
    }

    if (game == "INFinalB") {
        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB+") {
            achievement = achievement.slice(0, -1);
        }

        document.getElementById("INFinalAExtraa").innerHTML = achievement;
        vals["INFinalA"]["Extra"] = achievement;
    }

    if (game == "LoLKPointdevice") {
        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB+") {
            achievement = achievement.slice(0, -1);
        }

        document.getElementById("LoLKLegacyExtraa").innerHTML = achievement;
        vals["LoLKLegacy"]["Extra"] = achievement;
    }
}

function fillDifficulty(difficulty, achievement) {
    if (difficulty == "Extra") {
        document.getElementById("PCBPhantasma").innerHTML = gameSpecific("PCB", achievement);
        vals.PCB.Phantasm = gameSpecific("PCB", achievement);
        const checkboxes = document.querySelectorAll("#PCBPhantasm input[type='checkbox']");
        const boxesToCheck = progressToCheckboxes("PCB", achievement);

        for (const element of checkboxes) {
            element.checked = boxesToCheck.includes(element.value);
        }
    }

    for (const game in vals) {
        let tmp;

        if (achievement == "NM+" || achievement == "NB+" || achievement == "NMNB+") {
            tmp = gameSpecific(game, achievement);
        } else {
            tmp = achievement;
        }

        if (difficulty == "Extra" && (game == "HRtPMakai" || game == "HRtPJigoku" || game == "PoDD" || game == "INFinalB" || game == "LoLKPointdevice")) {
            continue;
        }

        const category = game + difficulty;
        const checkboxes = document.querySelectorAll(`#${category} input[type='checkbox']`);
        const boxesToCheck = progressToCheckboxes(game, tmp);

        for (const element of checkboxes) {
            element.checked = boxesToCheck.includes(element.value);
        }

        document.getElementById(category + "a").innerHTML = tmp;
        vals[game][difficulty] = tmp;
    }
}

function initAchievementCounts() {
    return {
        "Easy": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0, "NMNB+": 0 },
        "Normal": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0, "NMNB+": 0 },
        "Hard": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0, "NMNB+": 0 },
        "Lunatic": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0, "NMNB+": 0 },
        "Extra": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0, "NMNB+": 0 },
        "Total": { "Not cleared": 0, "1cc": 0, "NM": 0, "NM+": 0, "NB": 0, "NB+": 0, "NMNB": 0, "NMNB+": 0 }
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
        "UM": 0,
        "UDoALG": 0
    };
}

function format(achievement) {
    if (achievement == "N/A" || achievement == "Not cleared") {
        return "";
    }

    if (achievement == "1cc") {
        return "clear";
    }

    if (achievement == "NM") {
        return "nm";
    }

    if (achievement == "NB") {
        return "nb";
    }

    if (achievement == "NMNB") {
        return "nmnb";
    }

    if (achievement == "NNN" || achievement == "NNNN") {
        return "nmnbp";
    }

    if (achievement.length >= 4 && achievement.includes("NM")) {
        return "nmp";
    }

    if (achievement.length >= 4 && achievement.includes("NB")) {
        return "nbp";
    }

    return "np";
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
    const hrtpRoute = document.querySelectorAll(".hrtp_route");
    const inRoute = document.querySelectorAll(".in_route");
    const lolkMode = document.querySelectorAll(".lolk_mode");
    const noExtra = document.querySelectorAll(".no_extra");

    for (const element of hidden) {
        element.classList.add("overview_half");
        element.style.display = "table-cell";
    }

    for (const element of hrtpRoute) {
        element.parentNode.removeChild(element);
    }

    for (const element of inRoute) {
        element.parentNode.removeChild(element);
    }

    for (const element of lolkMode) {
        element.parentNode.removeChild(element);
    }

    for (const element of noExtra) {
        element.setAttribute("colspan", 2);
        element.innerHTML = "X";
        element.classList.remove("noborders");
    }

    const overview = document.querySelectorAll(".overview");
    let toRemove = document.getElementById("INFinalBtr");
    toRemove.parentNode.removeChild(toRemove);
    toRemove = document.getElementById("HRtPJigokutr");
    toRemove.parentNode.removeChild(toRemove);
    toRemove = document.getElementById("LoLKPointdevicetr");
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
        case "nmnbp": return true;
        default: return false;
    }
}

function applyColours() {
    for (const game of games) {
        if (game == "HRtPJigoku" || game == "INFinalB" || game == "LoLKPointdevice") {
            continue;
        }

        for (const diff in vals[game]) {
            const id = game + diff;
            const element = document.getElementById(id);

            if (id.includes("Extra") && !id.includes("PCB") && !id.includes("IN")) {
                element.parentNode.parentNode.setAttribute("colspan", 2);
                element.parentNode.parentNode.classList.add("overview");
            } else if (!id.includes("Extra") && id != "PCBPhantasm" && !id.includes("HRtP") && !id.includes("IN") && !id.includes("LoLK")) {
                element.parentNode.parentNode.setAttribute("colspan", 2);
                element.parentNode.parentNode.classList.add("overview");
            } else if (id == "PCBExtra" || id == "PCBPhantasm") {
                element.parentNode.parentNode.classList.add("overview_half");
            } else if (id.includes("HRtP") || id.includes("IN") || id.includes("LoLK") && !id.includes("Extra")) {
                element.parentNode.parentNode.classList.add("overview_half");
            } else {
                element.parentNode.parentNode.classList.add("overview");
            }
    
            const checkboxes = document.querySelectorAll(`#${id} input[type='checkbox']`);
            const checkedBoxes = getCheckedBoxes(checkboxes);
            const value = determineProgress(game, checkedBoxes);
    
            if (format(value) !== "") {
                element.parentNode.parentNode.classList.add(format(value));
            }
    
            element.parentNode.parentNode.innerHTML = (needsText(value) ? value : "");

            if (id.includes("HRtPMakai")) {
                const jigokuElement = document.getElementById(id.replace("HRtPMakai", "J"));
                const value = vals["HRtPJigoku"][diff];

                if (format(value) !== "") {
                    jigokuElement.classList.add(format(value));
                }

                jigokuElement.innerHTML = (needsText(value) ? value : "");
            }

            if (id.includes("INFinalA") && !id.includes("Extra")) {
                const finalBelement = document.getElementById(id.replace("INFinalA", "B"));
                const value = vals["INFinalB"][diff];

                if (format(value) !== "") {
                    finalBelement.classList.add(format(value));
                }

                finalBelement.innerHTML = (needsText(value) ? value : "");
            }

            if (id.includes("LoLKLegacy") && !id.includes("Extra")) {
                const legacyElement = document.getElementById(id.replace("LoLKLegacy", "L"));
                const value = vals["LoLKPointdevice"][diff];

                if (format(value) !== "") {
                    legacyElement.classList.add(format(value));
                }

                legacyElement.innerHTML = (needsText(value) ? value : "");
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
    document.getElementById("HRtPMakai").classList.add("bold");
    document.getElementById("INFinalA").classList.add("bold");
    document.getElementById("LoLKLegacy").classList.add("bold");
    document.getElementById("survival").classList.add("rendering");
    document.getElementById("survival").style.marginLeft = 0;
    document.getElementById("wrap").style.marginLeft = 0;
    document.getElementById("wrap").style.backgroundColor = "white";
    document.getElementById("container").style.backgroundColor = "white";
    document.getElementById("INFinalAExtra").parentNode.parentNode.setAttribute("rowspan", 1);
    document.getElementById("INFinalAExtra").parentNode.parentNode.setAttribute("colspan", 2);
    document.getElementById("LoLKLegacyExtra").parentNode.parentNode.setAttribute("rowspan", 1);
    document.getElementById("LoLKLegacyExtra").parentNode.parentNode.setAttribute("colspan", 2);
    runQuerySelectors();
    applyColours();

    for (const game of games) {
        if (game.includes("HRtP")) {
            continue;
        }

        if (game.includes("IN")) {
            continue;
        }

        if (game.includes("LoLK")) {
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

function fileName(extension) {
    const date = new Date();
    const month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    return `touhou_survival_progress_${date.getFullYear()}_${month}_${day}_${hours}_${minutes}_${seconds}.${extension}`;
}


function afterScreenshot(canvas) {
    const base64 = canvas.toDataURL("image/png");
    document.getElementById("screenshot_base64").src = base64;
    const saveLink = document.getElementById("screenshot_link");
    saveLink.href = base64;
    saveLink.download = fileName("png");
    cleanupRendering();
}

function takeScreenshotMobile() {
    html2canvas(document.getElementById("survival"), {
        scale: 1,
        height: document.getElementById("container").offsetHeight,
        backgroundColor: "white",
        logging: false
    }).then(afterScreenshot);
}

function takeScreenshot() {
    html2canvas(document.getElementById("survival"), {
        backgroundColor: "white",
        logging: false
    }).then(afterScreenshot);
}

function drawOverview() {
    originalContent = document.getElementById("container").innerHTML;
    prepareRendering();

    try {
        if (isMobile()) {
            takeScreenshotMobile();
        } else {
            takeScreenshot();
        }
    } catch (err) {
        document.getElementById("rendering_message").innerHTML = "Your browser is outdated. Use a different browser to generate an image of your survival progress table.";
    }
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

function emptyModal() {
    document.getElementById("modal").style.display = "none";
    const innerModals = document.querySelectorAll(".modal_inner");
    
    for (const element of innerModals) {
        element.style.display = "none";
    }
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

            if (!vals.hasOwnProperty("UDoALG")) {
                vals.UDoALG = {
                    "Easy": "N/A",
                    "Normal": "N/A",
                    "Hard": "N/A",
                    "Lunatic": "N/A"
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

            if (vals.hasOwnProperty("HRtP")) {
                vals.HRtPMakai = vals.HRtP;
                vals.HRtPJigoku = {
                    "Easy": "N/A",
                    "Normal": "N/A",
                    "Hard": "N/A",
                    "Lunatic": "N/A"
                };
                delete vals.HRtP;
            }

            if (vals.hasOwnProperty("LoLK")) {
                vals.LoLKLegacy = vals.LoLK;
                vals.LoLKPointdevice = {
                    "Easy": "N/A",
                    "Normal": "N/A",
                    "Hard": "N/A",
                    "Lunatic": "N/A"
                };
                delete vals.LoLK;
            }

            if (vals.INFinalB.hasOwnProperty("Extra")) {
                delete vals.INFinalB.Extra;
            }

            if (vals.UDoALG.hasOwnProperty("Extra")) {
                delete vals.UDoALG.Extra;
            }

            for (const diff in vals.PCB) {
                if (vals.PCB[diff] == "NMNBNBB") {
                    vals.PCB[diff] = "NNN";
                }
            }

            for (const diff in vals.UFO) {
                if (vals.UFO[diff] == "NMNB(NV)") {
                    vals.UFO[diff] = "NMNB";
                }
            }

            for (const diff in vals.TD) {
                if (vals.TD[diff] == "NMNBNT") {
                    vals.TD[diff] = "NNN";
                }
            }

            for (const diff in vals.HSiFS) {
                if (vals.HSiFS[diff] == "NMNBNR") {
                    vals.HSiFS[diff] = "NNN";
                }
            }

            for (const diff in vals.UM) {
                if (vals.UM[diff] == "NMNBNC") {
                    vals.UM[diff] = "NNN";
                }
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

function progressToCheckboxes(game, progress) {
    let boxesToCheck = [];

    if (progress == "N/A") {
        return [];
    }

    if (progress == "Not cleared" || progress == "1cc" || progress.length == "2" || progress == "NBB" || progress == "NRB") {
        return [progress];
    }

    if (progress == "NNN" || progress == "NNNN") {
        return ["NM", "NB", "NBB", "NV", "NT", "NR", "NH", "NRB", "NC"];
    }

    if (progress.includes("NM")) {
        boxesToCheck.push("NM");
        progress = progress.replace("NM", "");
    }

    if (progress.includes("NB")) {
        boxesToCheck.push("NB");
        progress = progress.replace("NB", "");
    }

    if (progress.includes("NH")) {
        boxesToCheck.push("NH");
        progress = progress.replace("NH", "");
    }

    if (progress.includes("NRB")) {
        boxesToCheck.push("NRB");
        progress = progress.replace("NRB", "");
    }

    if (progress.length > 0) {
        boxesToCheck.push(progress);
    }

    return boxesToCheck;
}

function initValues() {
    for (const game in vals) {
        for (const difficulty in vals[game]) {
            const category = game + difficulty;
            const checkboxes = document.querySelectorAll(`#${category} input[type='checkbox']`);
            const progress = vals[game][difficulty];
            const boxesToCheck = progressToCheckboxes(game, progress);
            
            for (const element of checkboxes) {
                if (boxesToCheck.includes(element.value)) {
                    element.checked = true;
                    document.getElementById(category + "a").innerHTML = progress;
                }
            }
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
    printMessage("<strong>Survival table saved!</strong>");
}

function getPercentage(game) {
    if (game.includes("HRtP")) {
        return 100 / (Object.keys(vals["HRtPMakai"]).length + Object.keys(vals["HRtPJigoku"]).length);
    }

    if (game.includes("IN")) {
        return 100 / (Object.keys(vals["INFinalA"]).length + Object.keys(vals["INFinalB"]).length);
    }

    if (game.includes("LoLK")) {
        return 100 / (Object.keys(vals["LoLKLegacy"]).length + Object.keys(vals["LoLKPointdevice"]).length);
    }

    return 100 / Object.keys(vals[game]).length;
}

function countAchievements(numbers) {
    for (const game in vals) {
        for (let diff in vals[game]) {
            let gameTmp = (game.includes("LoLK") ? "LoLK" : (game.includes("IN") ? "IN" : (game.includes("HRtP") ? "HRtP" : game)));
            let value = vals[game][diff];
            diff = (diff == "Phantasm" ? "Extra" : diff);
    
            if (value == "N/A") {
                na[gameTmp] += getPercentage(game);
            } else if (value == "Not cleared") {
                numbers[diff]["Not cleared"] += 1;
                numbers["Total"]["Not cleared"] += 1;
            } else {
                completions[gameTmp] += getPercentage(gameTmp);
    
                if (value.substr(0, 2) == "NM" && value.length > 2 && value.substr(2, 2) != "NB") {
                    numbers[diff]["NM+"] += 1;
                    numbers["Total"]["NM+"] += 1;
                } else if (value.substr(0, 2) == "NB" && value.length > 2) {
                    numbers[diff]["NB+"] += 1;
                    numbers["Total"]["NB+"] += 1;
                } else if (value == "NMNB") {
                    numbers[diff]["NMNB"] += 1;
                    numbers["Total"]["NMNB"] += 1;
                } else if (value == "NNN" || value == "NNNN") {
                    numbers[diff]["NMNB+"] += 1;
                    numbers["Total"]["NMNB+"] += 1;
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
    const totals = document.getElementById("number_table_totals");
    tbody.innerHTML = "";
    totals.innerHTML = "<td><strong>Total</strong></td>";

    for (const difficulty in numbers) {
        if (difficulty == "Total") {
            for (const value in numbers[difficulty]) {
                const td = document.createElement("td");
                td.innerHTML = numbers[difficulty][value];
                totals.appendChild(td);
            }

            break;
        }

        tbody.innerHTML += `<tr id='${difficulty}_tr'><td><strong>${difficulty}</strong></td></tr>`;

        for (const value in numbers[difficulty]) {
            document.getElementById(`${difficulty}_tr`).innerHTML += `<td>${numbers[difficulty][value]}</td>`;
        }
    }
}

function fillCompletionTable() {
    const tbody = document.getElementById("completion_table_tbody");
    tbody.innerHTML = "";

    if (na.HRtP < 100) {
        tbody.innerHTML = `<tr><td>HRtP</td><td>${Math.round(completions["HRtP"])}%</td></tr>`;
    }

    for (const game in vals) {
        if (game.includes("HRtP")) {
            continue;
        }

        if (game.includes("IN")) {
            continue;
        }

        if (game.includes("LoLK")) {
            continue;
        }

        if (game == "PCB" && na.IN < 100) { // otherwise IN is at the end
            tbody.innerHTML += `<tr><td>IN</td><td>${Math.round(completions["IN"])}%</td></tr>`;
        }

        if (game == "DDC" && na.LoLK < 100) {
            tbody.innerHTML += `<tr><td>LoLK</td><td>${Math.round(completions["LoLK"])}%</td></tr>`;
        }

        if (Math.round(na[game]) == 100) {
            continue;
        }

        tbody.innerHTML += `<tr><td>${game}</td><td>${Math.round(completions[game])}%</td></tr>`;
    }
}

function apply() {
    let numbers = initAchievementCounts();
    na = initGameCounts();
    completions = initGameCounts();
    numbers = countAchievements(numbers);
    fillNumberTable(numbers);
    fillCompletionTable();
    document.getElementById("results").style.display = "block";
    document.getElementById("modal").style.display = "block";
    drawOverview();
    clearMessages();
}

function importText() {
    emptyModal();
    clearMessages();
    document.getElementById("import_text").style.display = "block";
    document.getElementById("modal").style.display = "block";
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

    for (const game in vals) {
        textFile += `${game}:\n`;

        for (const diff in vals[game]) {
            textFile += `${diff}: ${vals[game][diff]}\n`;
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
    const confirmation = confirm("Are you sure you want to reset your progress table?");

    if (confirmation) {
        localStorage.removeItem("vals");
    }

    for (const game in vals) {
        for (const difficulty in vals[game]) {
            vals[game][difficulty] = "N/A";
            const category = game + difficulty;
            const checkboxes = document.querySelectorAll(`#${category} input[type='checkbox']`);

            for (const element of checkboxes) {
                element.checked = false;
            }

            document.getElementById(category + "a").innerHTML = "Select";
        }
    }

    unsavedChanges = false;
    printMessage("<strong>Reset the survival table to its default state!</strong>");
}

function uncheckProgress(checkboxes) {
    for (const element of checkboxes) {
        if (element.value != "Not cleared") {
            element.checked = false;
        }
    }
}

function uncheckNotCleared(checkboxes) {
    checkboxes[0].checked = false;
}

function getCheckedBoxes(checkboxes) {
    let checkedBoxes = [];

    for (const element of checkboxes) {
        if (element.checked) {
            checkedBoxes.push(element.value);
        }
    }

    return checkedBoxes;
}

function determineProgress(game, checkedBoxes) {
    const thirdCondition = ["PCB", "UFO", "TD", "HSiFS", "WBaWC", "UM"];

    if (checkedBoxes.length === 0) {
        return "N/A";
    }

    if (checkedBoxes.length === 1) {
        return checkedBoxes[0];
    }

    if (checkedBoxes.includes("1cc")) {
        checkedBoxes.splice(checkedBoxes.indexOf("1cc"), 1);
    }

    if (checkedBoxes.length === 1) {
        return checkedBoxes[0];
    }

    if (!thirdCondition.includes(game) && checkedBoxes.length == 2) {
        return "NMNB";
    }

    if (game != "WBaWC" && checkedBoxes.length == 3) {
        return "NNN";
    }

    if (game == "WBaWC" && checkedBoxes.length == 4) {
        return "NNNN";
    }

    return checkedBoxes.join("");
}

function setProgress() {
    const category = this.parentNode.parentNode.id;
    const checkboxes = document.querySelectorAll(`#${category} input[type='checkbox']`);

    if (this.value == "Not cleared") {
        uncheckProgress(checkboxes);
    } else {
        uncheckNotCleared(checkboxes);
    }

    const difficulty = category.match(/Easy|Normal|Hard|Lunatic|Extra|Phantasm/)[0];
    const game = category.replace(difficulty, "");
    const checkedBoxes = getCheckedBoxes(checkboxes);
    const progress = determineProgress(game, checkedBoxes);

    document.getElementById(category + "a").innerHTML = (progress == "N/A" ? "Select" : progress);
    vals[game][difficulty] = progress;

    unsavedChanges = true;
}

function setEventListenersSelect() {
    const select = document.querySelectorAll(".dropdown-check-list");
    const categories = document.querySelectorAll("input[type='checkbox']");

    for (const element of select) {
        //
        element.getElementsByClassName("anchor")[0].addEventListener("click", function() {
            if (element.classList.contains("visible")) {
                element.classList.remove("visible");
            } else {
                element.classList.add("visible");
            }
        });
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
    document.getElementById("import_button").addEventListener("click", importText, false);
    document.getElementById("export").addEventListener("click", exportText, false);
    document.getElementById("reset").addEventListener("click", reset, false);
    document.getElementById("close").addEventListener("click", emptyModal, false);
    setEventListenersSelect();
}

function achievs(game) {
    const achievs = ["n/a", "not cleared", "1cc", "nm", "nb", "nmnb"];

    switch (game) {
        case "PCB": return achievs.concat(["nbb", "nmnbb", "nbnbb", "nnn"]);
        case "UFO": return achievs.concat(["nv", "nmnv", "nbnv", "nnn"]);
        case "TD": return achievs.concat(["nt", "nmnt", "nbnt", "nnn"]);
        case "HSiFS": return achievs.concat(["nr", "nmnr", "nbnr", "nnn"]);
        case "WBaWC": return achievs.concat( ["nhnrb", "nmnhnrb", "nbnhnrb", "nnnn"]);
        case "UM": return achievs.concat(["nc", "nmnc", "nbnc", "nnn"]);
        default: return achievs;
    }
}

function doImport() {
    const text = document.getElementById("import").value.trim().split('\n');
    let game;
    let difficulty;
    let achievement;

    for (const line of text) {
        if (line === "") {
            continue;
        }

        let value = line.replace(':', "");

        if (games.includes(value)) {
            game = value;
            continue;
        } else if (!game) {
            printError("<strong>Error: invalid survival progress. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.</strong>");
            return;
        }

        value = value.split(' ');
        difficulty = value[0];
        achievement = value[1];

        if (vals[game].hasOwnProperty(difficulty) && achievs(game).includes(achievement.toLowerCase())) {
            vals[game][difficulty] = achievement;
            continue;
        } else {
            printError("<strong>Error: invalid survival progress. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.</strong>");
            return;
        }
    }

    save();
    initValues();
    printMessage("<strong>Survival progress successfully imported!</strong>");
}

function init() {
    deleteLegacyCookies();
    readLocalStorage();
    initValues();
    setEventListeners();
    const importElement = document.getElementById("import");
    const errorElement = document.getElementById("error");

    if (importElement) {
        doImport();
        importElement.parentNode.removeChild(importElement);
    } else {
        if (errorElement && errorElement.value) {
            printError(errorElement.value);
            errorElement.parentNode.removeChild(errorElement);
        }
    }

    window.onbeforeunload = function () {
        if (unsavedChanges) {
            return "";
        }

        return undefined;
    }
}

window.addEventListener("DOMContentLoaded", init, false);
