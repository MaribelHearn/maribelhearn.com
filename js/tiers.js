/*global categories html2canvas isMobile setCookie getCookie deleteCookie MobileDragDrop ClipboardItem*/
if (typeof MobileDragDrop !== "undefined") {
    MobileDragDrop.polyfill({
        holdToDrag: 200
    });
}

String.prototype.strip = function () {
    return this.replace(/<\/?[^>]*>/g, "");
};

Object.defineProperty(Array.prototype, "remove", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        this.splice(this.indexOf(value), 1);
    }
});

Object.defineProperty(Object.prototype, "isEmpty", {
    configurable: true,
    enumerable: false,
    value: function () {
        return Object.keys(this).length === 0;
    }
});

const MAX_NUMBER_OF_TIERS = 100;
const MAX_NAME_LENGTH = 50;
const defaultBg = "#1b232e";
const defaultColour = "#a0a0a0";
const defaultWidth = isMobile() ? 60 : 120;
const defaultSize = 32;
const sorts = ["characters", "works", "shots", "cards"];
const windows = ["EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM", "UDoALG", "FW", "Spinoff"];
const spinoffs = ["IaMP", "SWR", "Soku", "DS", "GFW", "HM", "ULiL", "AoCF"];
const maleCharacters = ["SinGyokuM", "Genjii", "Unzan", "RinnosukeMorichika", "FortuneTeller"];
const clans = ["FujiwaranoMokou", "SoganoTojiko", "MononobenoFuto", "ToyosatomiminoMiko", "HiedanoAkyuu", "WatatsukinoToyohime", "WatatsukinoYorihime"];
const themeDuplicates = ["FiveMagicStones", "MarisaPC-98LLS", "YuukaPC-98Stage5", "YukiandMai", "AlicePC-98Extra", "YuyukoSaigyoujiResurrectionButterfly",
        "KaguyaHouraisanLastSpells", "YuyukoSaigyoujiTD", "OkinaMataraExtra", "MarisaKirisameGFW"]; // iCiel Gotham Ultra 24
const DEFAULT_TIER_NAMES = ["S", "A", "B", "C"];
const DEFAULT_TIERS = {
    "0": { "name": "S", "bg": "#1b232e", "colour": "#a0a0a0", "chars": [] },
    "1": { "name": "A", "bg": "#1b232e", "colour": "#a0a0a0", "chars": [] },
    "2": { "name": "B", "bg": "#1b232e", "colour": "#a0a0a0", "chars": [] },
    "3": { "name": "C", "bg": "#1b232e", "colour": "#a0a0a0", "chars": [] }
};
const DEFAULT_PROPS = {
    "tierListName": "",
    "tierListColour": defaultBg,
    "tierHeaderWidth": defaultWidth,
    "tierHeaderFontSize": defaultSize,
    "screenshotWidth": "",
};
const DEFAULT_SETTINGS = {
    "categories": {
        "characters": {
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true },
            "LLS": { enabled: true }, "MS": { enabled: true }, "EoSD": { enabled: true }, "PCB": { enabled: true },
            "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true }, "SA": { enabled: true },
            "UFO": { enabled: true }, "TD": { enabled: true }, "DDC": { enabled: true }, "LoLK": { enabled: true },
            "HSiFS": { enabled: true }, "WBaWC": { enabled: true }, "UM": { enabled: true }, "UDoALG": { enabled: true },
            "FW": { enabled: true }, "Spinoff": { enabled: true },
            "Manga": { enabled: true }, "CD": { enabled: true }
        },
        "works": {
            "PC-98": { enabled: true }, "Classic": { enabled: true }, "Modern1": { enabled: true }, "Modern2": { enabled: true },
            "Mangas": { enabled: true }, "Books": { enabled: true }, "CDs": { enabled: true }
        },
        "shots": {
            "SoEW": { enabled: true }, "PoDD": { enabled: true }, "LLS": { enabled: true }, "MS": { enabled: true },
            "EoSD": { enabled: true }, "PCB": { enabled: true }, "IN": { enabled: true }, "PoFV": { enabled: true },
            "MoF": { enabled: true }, "SA": { enabled: true }, "UFO": { enabled: true }, "TD": { enabled: true },
            "DDC": { enabled: true }, "LoLK": { enabled: true }, "HSiFS": { enabled: true }, "WBaWC": { enabled: true },
            "UM": { enabled: true }
        },
        "cards": {
            "Touhou18": { enabled: true }, "Touhou185": { enabled: true }, "Touhou19": { enabled: true}
        }
    },
    "props": {
        "characters": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize,
            "screenshotWidth": ""
        },
        "works": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize,
            "screenshotWidth": ""
        },
        "shots": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize,
            "screenshotWidth": ""
        },
        "cards": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize,
            "screenshotWidth": ""
        }
    },
    "pc98Enabled": true,
    "windowsEnabled": true,
    "maleEnabled": true,
    "themesEnabled": false,
    "sort": "characters"
};
let settings = DEFAULT_SETTINGS;
let tiers = {};
let multiSelection = [];
let following = "";
let tierView = false;
let firstTime = false;
let smallPicker = false;

function addSpacing(item) {
    const sort = whichSort(item);

    if (sort == "shots") {
        if (item.includes("HSiFS") || item.includes("WBaWC") || item.includes("UDoALG")) {
            return item.replace("HSiFS", "HSiFS ").replace("WBaWC", "WBaWC ").replace("UDoALG", "UDoALG ");
        }

        return item.replace(item.match(/[A-Z][A-Z][a-z]/)[0], item.match(/[A-Z][A-Z][a-z]/)[0].substr(0, 1) + " " + item.match(/[A-Z][A-Z][a-z]/)[0].substr(1)).replace("Team", " Team");
    }

    if (item == "ReisenII") {
        return "Reisen II";
    } else if (item == "Retrospective53minutes") {
        return "Retrospective 53 minutes";
    } else if (item == "AnnoyingUFO") {
        return "Annoying UFO";
    } else if (clans.includes(item)) {
        return item.substr(0, item.lastIndexOf("no")) + " " + item.substr(item.lastIndexOf("no"), 2) + " " + item.substr(item.lastIndexOf("no") + 2);
    }

    for (let i = 1; i < item.length; i++) {
        let c = item[i];
        if ((/[A-Z]/.test(c) || /\d+/.test(c)) && item.charAt(i - 1) !== ' ' && item.charAt(i - 1) !== '-') {
            item = item.substr(0, i) + " " + item.substr(i);
        }
    }

    if (sort == "works") {
        if (/of [A-Z]/.test(item)) {
            item = item.replace("of ", " of ");
        } else if (/in [A-Z]/.test(item)) {
            item = item.replace("in ", " in ");
        } else if (/and [A-Z]/.test(item) && item != "Lotus Land Story") {
            item = item.replace("and ", " and ");
        } else if ( /the [A-Z]/.test(item)) {
            item = item.replace("the ", " the ");
        } else if (/to [A-Z]/.test(item)) {
            item = item.replace("to ", " to ");
        }
    } else {
        item = item.replace("and ", " and ").replace("And ", "and ").replace("Its ", "its ").replace("To ", "to ").replace(" A ", " a ").replace("Of ", "of ");
        item = item.replace("The ", "the ").replace("Is ", "is ").replace("In ", "in ").replace("With ", "with ").replace("1 8 5", "(Touhou 18.5)");
        item = item.charAt(0).toUpperCase() + item.slice(1);
    }


    return item.replace("Sin Gyoku", "SinGyoku").replace("Yuugen Magan", "YuugenMagan").replace("P C-9 8", "PC-98").replace("L L S", "LLS").replace("G F W", "GFW").replace("T D", "TD");
}

function getTierNumOf(item) {
    const tierList = getCurrentTierList();

    for (const tierNum in tierList) {
        for (const otherItem of tierList[tierNum].chars) {
            if (otherItem === item) {
                return Number(tierNum);
            }
        }
    }

    return false;
}

function getPositionOf(item) {
    if (!item || !isItem(item)) {
        return -1;
    }

    const element = document.getElementById(item);
    return Number(element.parentNode.id.split('_')[1]);
}

function getItemAt(tierNum, pos) {
    const tierList = getCurrentTierList();
    return tierList[tierNum].chars[pos];
}

function getCategoryOf(item) {
    if (!item || !isItem(item)) {
        return false;
    }

    const cats = categories[settings.sort];

    for (const categoryName in cats) {
        if (cats[categoryName].chars.includes(item)) {
            return categoryName;
        }
    }

    return false;
}

function getCurrentTierList(sort) {
    if (!sort) {
        sort = settings.sort;
    }

    return tiers[sort];
}

function whichSort(item) {
    if (item === "") {
        return false;
    }

    for (const sort of sorts) {
        for (const category in categories[sort]) {
            if (categories[sort][category].chars.includes(item)) {
                return sort;
            }
        }
    }

    return false;
}

function isItem(item) {
    return whichSort(item) ? true : false;
}

function isCategory(category) {
    if (category === "") {
        return false;
    }

    for (const sort of sorts) {
        if (categories[sort].hasOwnProperty(category)) {
            return true;
        }
    }

    return false;
}

function isTiered(item) {
    if (!item) {
        return false;
    }

    const tierList = getCurrentTierList();

    for (const tierNum in tierList) {
        if (tierList[tierNum].chars.includes(item)) {
            return true;
        }
    }

    return false;
}

function allTiered(categoryName) {
    const cats = categories[settings.sort];

    for (const item of cats[categoryName].chars) {
        if (!isTiered(item)) {
            return false;
        }
    }

    return true;
}

function setPickerItemEvents(item) {
    const itemElement = document.getElementById(item);
    itemElement.removeEventListener("dragstart", drag, false);
    itemElement.removeEventListener("dragover", allowDrop, false);
    itemElement.removeEventListener("dragenter", allowDrop, false);
    itemElement.removeEventListener("click", toggleMulti, false);
    itemElement.addEventListener("dragstart", drag, false);
    itemElement.addEventListener("click", toggleMulti, false);

    if (isMobile()) {
        itemElement.removeEventListener("contextmenu", preventContextMenu, false);
        itemElement.addEventListener("contextmenu", preventContextMenu, false);
    } else {
        itemElement.removeEventListener("contextmenu", tieredContextMenu, false);
        itemElement.removeEventListener("dblclick", addMenu, false);
        itemElement.addEventListener("dblclick", addMenu, false);
    }
}

function setTieredItemEvents(item) {
    const itemElement = document.getElementById(item);
    itemElement.removeEventListener("dragstart", drag, false);
    itemElement.removeEventListener("dragover", allowDrop, false);
    itemElement.removeEventListener("dragenter", allowDrop, false);
    itemElement.removeEventListener("click", toggleMulti, false);
    itemElement.addEventListener("dragstart", drag, false);
    itemElement.addEventListener("dragover", allowDrop, false);
    itemElement.addEventListener("dragenter", allowDrop, false);
    itemElement.addEventListener("click", toggleMulti, false);

    if (isMobile()) {
        itemElement.removeEventListener("contextmenu", preventContextMenu, false);
        itemElement.addEventListener("contextmenu", preventContextMenu, false);
    } else {
        itemElement.removeEventListener("contextmenu", tieredContextMenu, false);
        itemElement.addEventListener("contextmenu", tieredContextMenu, false);
        itemElement.removeEventListener("dblclick", addMenu, false);
        itemElement.addEventListener("dblclick", addMenu, false);
    }
}

function createTier(tierNum) {
    const tierList = getCurrentTierList();
    const tier = document.createElement("tr");
    const tierHeader = document.createElement("th");
    const tierContent = document.createElement("td");
    tier.id = `tr${tierNum}`;
    tier.classList.add("tier");
    tierHeader.id = `th${tierNum}`;
    tierHeader.draggable = true;
    tierHeader.innerHTML = tierList[tierNum].name;
    tierHeader.classList.add("tier_header");
    tierContent.id = `tier${tierNum}`;
    tierContent.classList.add("tier_content");
    document.getElementById("tier_list_tbody").appendChild(tier);
    tier.appendChild(tierHeader);
    tier.appendChild(tierContent);
    tier.addEventListener("dragover", allowDrop, false);
    tier.addEventListener("dragenter", allowDrop, false);
    tier.addEventListener("drop", drop, false);
    tier.style.backgroundColor = settings.props[settings.sort].tierListColour;
    tierHeader.addEventListener("dragstart", drag, false);
    tierHeader.addEventListener("click", detectLeftCtrlCombo, false);
    tierHeader.style.backgroundColor = tierList[tierNum].bg;
    tierHeader.style.color = tierList[tierNum].colour;
    tierHeader.style.maxWidth = settings.props[settings.sort].tierHeaderWidth + "px";
    tierHeader.style.width = settings.props[settings.sort].tierHeaderWidth + "px";
    tierHeader.style.fontSize = settings.props[settings.sort].tierHeaderFontSize + "px";

    if (isMobile()) {
        tierHeader.style.height = "60px";
    } else {
        tierHeader.addEventListener("contextmenu", detectRightCtrlCombo, false);
    }

    return tierContent;
}

function reloadTiers() {
    const cats = categories[settings.sort];
    const tierList = getCurrentTierList();
    document.getElementById("tier_list_caption").innerHTML = settings.props[settings.sort].tierListName;

    for (const tierNum in tierList) {
        const tierContent = createTier(tierNum);

        for (let item of tierList[tierNum].chars) {
            if (item == "Mai") {
                item = "Mai PC-98";
            }

            const itemElement = document.getElementById(item);
            itemElement.classList.remove(`list_${settings.sort}`);
            itemElement.classList.add(`tiered_${settings.sort}`);
            const tierEntry = document.createElement("span");
            tierEntry.id = "tier" + tierNum + "_" + tierList[tierNum].chars.indexOf(item);
            tierContent.appendChild(tierEntry);
            tierEntry.appendChild(itemElement);
            setTieredItemEvents(item);

            for (const categoryName in cats) {
                if (!document.getElementById(categoryName).innerHTML.includes(`list_${settings.sort}`)) {
                    document.getElementById(categoryName).style.display = "none";
                }
            }
        }
    }
}

function initialise() {
    for (const sort of sorts) {
        tiers[sort] = {
            "0": { "name": "S", "bg": defaultBg, "colour": defaultColour, "chars": [] },
            "1": { "name": "A", "bg": defaultBg, "colour": defaultColour, "chars": [] },
            "2": { "name": "B", "bg": defaultBg, "colour": defaultColour, "chars": [] },
            "3": { "name": "C", "bg": defaultBg, "colour": defaultColour, "chars": [] }
        };

        for (const tierNum in tiers[sort]) {
            loadTier(tiers[sort][tierNum], Number(tierNum), sort);
        }
    }

    setCookie("sort", settings.sort);
}

function printMessage(message) {
    const id = "msg_container" + (isMobile() ? "_mobile" : "");
    document.getElementById(id).innerHTML = message;
}

function switchSort(event) {
    if (!isMobile() && event.target.nodeName !== 'P') {
        return;
    }
    document.getElementById("characters").innerHTML = "";
    document.getElementById("tier_list_tbody").innerHTML = "";

    if (isMobile()) {
        settings.sort = sorts[(sorts.indexOf(settings.sort) + 1) % sorts.length];
    } else {
        document.getElementById(`sort_${settings.sort}`).classList.remove("current_sort");
        settings.sort = event.target.id.slice(5);
        document.getElementById(`sort_${settings.sort}`).classList.add("current_sort");
    }

    multiSelection = [];
    loadItems(false);
    reloadTiers();
    saveData();
    setCookie("sort", settings.sort);

    if (isMobile()) {
        printMessage(`<strong class='confirmation'>Switched to ${settings.sort}!</strong>`);
    } else {
        printMessage("");
    }
}

function tieredContextMenu(event) {
    event.preventDefault();
    const item = event.target.id;
    const tierNum = event.target.parentNode.parentNode.id.replace("tier", "");
    removeFromTier(item, tierNum);
    return false;
}

function insertAt(item, tierNum, pos, chars) {
    const element = document.getElementById(item);
    document.getElementById(`tier${tierNum}_${pos}`).appendChild(element);

    for (let counter = chars.length - 1; counter >= pos; counter -= 1) {
        const id = getItemAt(tierNum, counter);
        const next = `tier${tierNum}_${counter + 1}`;
        const itemElement = document.getElementById(id);
        document.getElementById(next).appendChild(itemElement);
        chars[counter + 1] = id;
    }

    chars[pos] = item;
}

function addToTier(item, tierNum, pos, noDisplay) {
    const cats = categories[settings.sort];
    const tierList = getCurrentTierList();
    const categoryName = getCategoryOf(item);
    let inserted = false;

    if (isTiered(item)) {
        return;
    }

    if (!noDisplay) {
        const itemElement = document.getElementById(item);
        itemElement.classList.remove("selected");
        itemElement.classList.remove(`list_${settings.sort}`);
        itemElement.classList.add(`tiered_${settings.sort}`);
        const tierEntry = document.createElement("span");
        tierEntry.id = "tier" + tierNum + "_" + tierList[tierNum].chars.length;
        document.getElementById(`tier${tierNum}`).appendChild(tierEntry);
        setTieredItemEvents(item);

        if (typeof pos == "number" && pos < tierList[tierNum].chars.length && !noDisplay) {
            insertAt(item, tierNum, pos, tierList[tierNum].chars);
            inserted = true;
        } else {
            tierEntry.appendChild(itemElement);
        }
    }

    if (!inserted) {
        tierList[tierNum].chars.pushStrict(item);
    }

    if (!noDisplay) {
        for (const item of cats[categoryName].chars) {
            if (!isTiered(item)) {
                saveData();
                return;
            }
        }
    
        document.getElementById(categoryName).style.display = "none";
    }
    
    saveData();
}

function addMultiSelection(tierNum) {
    const multi = true;

    if (multiSelection.includes(following)) {
        for (const item of multiSelection) {
            if (isTiered(item)) {
                removeFromTier(item, getTierNumOf(item), multi);
            }

            addToTier(item, tierNum);
        }
    } else {
        for (const item of multiSelection) {
            document.getElementById(item).classList.remove("selected");
        }

        if (isTiered(following)) {
            removeFromTier(following, getTierNumOf(following));
        }

        addToTier(following, tierNum);
    }

    multiSelection = [];
}

function removeMultiSelection() {
    const multi = true;

    if (multiSelection.includes(following)) {
        for (const item of multiSelection) {
            document.getElementById(item).classList.remove("selected");
            removeFromTier(item, getTierNumOf(item), multi);
        }
    } else {
        for (const item of multiSelection) {
            document.getElementById(item).classList.remove("selected");
        }

        removeFromTier(following, getTierNumOf(following), multi);
    }

    multiSelection = [];
}

function toggleMulti() {
    if (multiSelection.includes(this.id)) {
        multiSelection.remove(this.id);
        document.getElementById(this.id).classList.remove("selected");
        return;
    }

    multiSelection.push(this.id);
    document.getElementById(this.id).classList.add("selected");
}

function multiSelectionToText() {
    let result = [];

    for (const item of multiSelection) {
        result.push(document.getElementById(item).title);
    }

    return result.join(", ");
}

function getItems() {
    let selection = document.getElementById("selection").innerHTML;

    if (selection.includes(',')) {
        selection = selection.split(", ");

        for (let i =  0; i <  selection.length; i++) {
            selection[i] = selection[i].removeSpaces();
        }
    } else {
        selection = selection.removeSpaces();
    }

    return selection;
}

function addToTierMobile(event) {
    const id = event.target.id.split('_');
    const item = getItems();
    const tierNum = id[3];
    const tierList = getCurrentTierList();

    if (typeof item == "object") { // multiselection
        following = item[0];
        const chars = multiSelectionToText();
        addMultiSelection(tierNum);
        printMessage(`<strong class='confirmation'>Added ${chars} to ${tierList[tierNum].name}!</strong>`);
        emptyModal();
        return;
    }

    if (isTiered(item)) {
        changeToTier(item, tierNum);
    } else {
        addToTier(item, tierNum);
    }

    emptyModal();
}

function addMenu(event) {
    emptyModal();
    const item = event.target.id;
    const tierList = getCurrentTierList();
    event.preventDefault();

    if (multiSelection.length > 1) {
        document.getElementById("selection").innerHTML = multiSelectionToText();
    } else {
        document.getElementById("selection").innerHTML = event.target.title;
        document.getElementById("selection_text").innerHTML = (isTiered(item) ? "Change" : "Add") + " to tier:";
    }

    const inputs = document.getElementById("add_menu_inputs");
    inputs.innerHTML = "";

    for (let tierNum = 0; tierNum < Object.keys(tierList).length; tierNum++) {
        const input = document.createElement("input");
        input.type = "button";
        input.id = `mobile_addtotier_${item}_${tierNum}`;
        input.classList.add("mobile_add");
        input.value = tierList[tierNum].name;
        inputs.appendChild(input);
        input.addEventListener("click", addToTierMobile, false);
    }

    document.getElementById("add_menu_mobile").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function moveToBack(character, tierNum) {
    const tierList = getCurrentTierList();

    if (getPositionOf(character) === tierList[tierNum].chars.length - 1) {
        return;
    }

    removeFromTier(character, tierNum);
    addToTier(character, tierNum);
    saveData();
}

function moveItemTo(sourceItem, targetItem) {
    const tierList = getCurrentTierList();
    const sourcePos = getPositionOf(sourceItem);
    const targetPos = getPositionOf(targetItem);
    const tierNum = getTierNumOf(targetItem);
    const tierBackup = document.getElementById("tier" + tierNum + "_" + sourcePos).firstChild;
    if (targetPos == tierList[tierNum].chars.length - 1) {
        moveToBack(sourceItem, tierNum);
        return;
    }

    if (sourcePos > targetPos) {
        for (let pos = sourcePos; pos > targetPos; pos--) {
            const prevPos = pos - 1;
            document.getElementById("tier" + tierNum + "_" + pos).appendChild(document.getElementById("tier" + tierNum + "_" + prevPos).firstChild);
            tierList[tierNum].chars[pos] = tierList[tierNum].chars[prevPos];
        }
    } else if (sourcePos < targetPos) {
        for (let pos = sourcePos; pos < targetPos; pos++) {
            const nextPos = pos + 1;
            document.getElementById("tier" + tierNum + "_" + pos).appendChild(document.getElementById("tier" + tierNum + "_" + nextPos).firstChild);
            tierList[tierNum].chars[pos] = tierList[tierNum].chars[nextPos];
        }
    } else {
        return;
    }

    document.getElementById("tier" + tierNum + "_" + targetPos).appendChild(tierBackup);
    tierList[tierNum].chars[targetPos] = sourceItem;

    for (const item of tierList[tierNum].chars) {
        setTieredItemEvents(item);
    }

    saveData();
}

function moveMultiSelectionTo(targetItem) {
    const tierNum = getTierNumOf(targetItem);

    for (const item of multiSelection) {
        document.getElementById(item).classList.remove("selected");
        moveItemTo(item, targetItem, tierNum);
    }

    multiSelection = [];
}

function changeMultiSelectionTo(tierNum, pos, multi) {
    for (const item of multiSelection) {
        document.getElementById(item).classList.remove("selected");
        changeToTier(item, tierNum, pos, multi);
    }

    multiSelection = [];
}

function removeFromTier(item, tierNum, multi, noDisplay) {
    const tierList = getCurrentTierList();

    if (!item || getTierNumOf(item) !== Number(tierNum)) {
        return;
    }

    if (!noDisplay) {
        const itemElement = document.getElementById(item);
        itemElement.classList.remove("tiered_" + settings.sort);
        itemElement.classList.add("list_" + settings.sort);
        const pos = getPositionOf(item);
        document.getElementById(`${item}C`).appendChild(itemElement);
        setPickerItemEvents(item);
        document.getElementById(getCategoryOf(item)).style.display = "block";

        if (tierNum !== false) {
            for (let counter = pos + 1; counter < tierList[tierNum].chars.length; counter += 1) {
                const itemBackup = document.getElementById(getItemAt(tierNum, counter));
                document.getElementById("tier" + tierNum + "_" + (counter - 1)).appendChild(itemBackup);
            }

            const lastItemElement = document.getElementById(`tier${tierNum}_${tierList[tierNum].chars.length - 1}`);
            lastItemElement.parentNode.removeChild(lastItemElement);
        }

    }

    tierList[tierNum].chars.remove(item);

    if (!multi && multiSelection.includes(item)) {
        document.getElementById(item).classList.remove("selected");
        multiSelection.remove(item);
    }

    saveData();
}

function changeToTier(item, tierNum, pos, multi) {
    removeFromTier(item, getTierNumOf(item), multi);
    addToTier(item, tierNum, pos);
}

function escapeHTML(string) {
    return string.replace(/</g, "").replace(/>/g, "").replace(/&/g, "");
}

function changeTierListName() {
    const tierListName = escapeHTML(document.getElementById("tier_list_name").value);
    settings.props[settings.sort].tierListName = tierListName;
    document.getElementById("tier_list_caption").innerHTML = settings.props[settings.sort].tierListName;
    localStorage.setItem("settings", JSON.stringify(settings));
}

function validateTierName(tierName) {
    return tierName.length <= MAX_NAME_LENGTH && tierName.length > 0;
}

function addTier(tierName, noDisplay) {
    const tierList = getCurrentTierList();
    let tierNum = 0;

    while (tierNum < Object.keys(tierList).length) {
        tierNum += 1;
    }

    if (tierNum >= MAX_NUMBER_OF_TIERS) {
        printMessage(`<strong class='error'>Error: the number of tiers may not exceed ${MAX_NUMBER_OF_TIERS}.</strong>`);
        return;
    }

    tierName = tierName.replace(/</g, "").replace(/'/g, "");

    if (isMobile()) {
        document.getElementById("tier_name_mobile").value = tierName;
    } else {
        document.getElementById("tier_name").value = tierName;
    }

    if (!tierName || tierName === "") {
        return;
    }

    if (!validateTierName(tierName)) {
        printMessage(`<strong class='error'>Error: tier names may not exceed ${MAX_NAME_LENGTH} characters.</strong>`);
        return;
    }

    tierList[tierNum] = {};
    tierList[tierNum].name = tierName;
    tierList[tierNum].bg = defaultBg;
    tierList[tierNum].colour = defaultColour;
    tierList[tierNum].chars = [];

    if (!noDisplay) {
        createTier(tierNum);
    }
    
    saveData();
}

function copyTierSettings(tierList, tierNum, otherTierNum) {
    const tierHeader = document.getElementById(`th${tierNum}`);
    tierHeader.style.color = tierList[otherTierNum].colour;
    tierHeader.style.backgroundColor = tierList[otherTierNum].bg;
    tierHeader.innerHTML = tierList[otherTierNum].name;
    tierList[tierNum].colour = tierList[otherTierNum].colour;
    tierList[tierNum].bg = tierList[otherTierNum].bg;
    tierList[tierNum].name = tierList[otherTierNum].name;
}

function moveTierTo(sourceTierNum, targetTierNum) {
    const tierList = getCurrentTierList();
    const sourceBackup = JSON.parse(JSON.stringify(tierList[sourceTierNum]));

    if (sourceTierNum > targetTierNum) {
        for (let tierNum = sourceTierNum; tierNum > targetTierNum; tierNum--) {
            const prevTierNum = tierNum - 1;
            const removedItems = removeCharacters(prevTierNum);
            copyTierSettings(tierList, tierNum, prevTierNum);

            for (let i = removedItems.length - 1; i >= 0; i--) {
                const item = removedItems[i];
                addToTier(item, tierNum);
            }
        }
    } else { // sourceTierNum < targetTierNum
        for (let tierNum = sourceTierNum; tierNum < targetTierNum; tierNum++) {
            const nextTierNum = tierNum + 1;
            const removedItems = removeCharacters(nextTierNum);
            copyTierSettings(tierList, tierNum, nextTierNum);

            for (let i = removedItems.length - 1; i >= 0; i--) {
                const item = removedItems[i];
                addToTier(item, tierNum);
            }
        }
    }

    for (const item of sourceBackup.chars) {
        removeFromTier(item, sourceTierNum);
        addToTier(item, targetTierNum);
    }

    const targetTierHeader = document.getElementById(`th${targetTierNum}`);
    targetTierHeader.style.color = sourceBackup.colour;
    targetTierHeader.style.backgroundColor = sourceBackup.bg;
    targetTierHeader.innerHTML = sourceBackup.name;
    tierList[targetTierNum].colour = sourceBackup.colour;
    tierList[targetTierNum].bg = sourceBackup.bg;
    tierList[targetTierNum].name = sourceBackup.name;
    saveData();
}

function removeCharacters(tierNum, noDisplay) {
    const tierList = getCurrentTierList();
    let removedItems = [];

    while (tierList[tierNum].chars.length > 0) {
        const item = tierList[tierNum].chars[tierList[tierNum].chars.length - 1];
        const multi = (noDisplay ? false : multiSelection.includes(item));
        removeFromTier(item, tierNum, multi, noDisplay);
        removedItems.push(item);
    }

    if (!noDisplay) {
        document.getElementById(`tier${tierNum}`).innerHTML = ""; // temporary measure against sudden double digit spans
    }
    
    return removedItems;
}

function removeTierButton() {
    const tierList = getCurrentTierList();
    const tierNum = document.getElementById("tier_num").value;
    const tierName = tierList[tierNum].name;
    const isRemoved = removeTier(tierNum);

    if (isRemoved) {
        printMessage(`<strong class='confirmation'>${tierName} tier removed!</strong>`);
    }

    emptyModal();
}

function removeTier(sourceTierNum, skipConfirmation, noDisplay) {
    const tierList = getCurrentTierList();
    let confirmation = true;

    if (tierList[sourceTierNum].chars.length === 0) {
        skipConfirmation = true;
    }

    if (!skipConfirmation) {
        confirmation = confirm("Are you sure you want to remove this tier? This will return all characters in it to the picker.");
    }

    if (confirmation) {
        const lastTierNum = Object.keys(tierList).length - 1;
        removeCharacters(sourceTierNum, noDisplay);

        for (let tierNum = Number(sourceTierNum) + 1; tierNum <= lastTierNum; tierNum++) {
            const prevTierNum = tierNum - 1;

            if (!noDisplay) {
                const removedItems = removeCharacters(tierNum);
                copyTierSettings(tierList, prevTierNum, tierNum);

                for (let i = removedItems.length - 1; i >= 0; i--) {
                    const item = removedItems[i];
                    addToTier(item, prevTierNum);
                }
            } else { // noDisplay
                tierList[prevTierNum] = tierList[tierNum];
            }
        }

        delete tierList[lastTierNum];
        saveData();

        if (!noDisplay) {
            const lastTier = document.getElementById(`tr${lastTierNum}`);
            lastTier.parentNode.removeChild(lastTier);
        }
    }   

    return confirmation;
}

function emptyModal() {
    if (firstTime) {
        document.getElementById("modal").style.cssText = "display: none !important;";
    } else {
        document.getElementById("modal").style.display = "none";
    }
    
    document.getElementById("tier_menu_msg_container").innerHTML = "";
    document.getElementById("screenshot_msg_container").innerHTML = "";
    const innerModals = document.querySelectorAll(".modal_inner");
    
    for (const element of innerModals) {
        element.style.display = "none";
    }
}

function closeModal(event) {
    const modal = document.getElementById("modal");

    if (event.target && event.target == modal) {
        emptyModal();
    }
}

function detectKey(event) {
    if (event.key && event.key == "Enter" && multiSelection.length > 0) {
        addMenu();
    } else if (event.key && event.key == "Escape") {
        emptyModal();
    }
}

function quickAdd(tierNum) {
    const cats = categories[settings.sort];

    for (const categoryName in cats) {
        if (settings.categories[settings.sort][categoryName].enabled) {
            for (const item of cats[categoryName].chars) {
                if (!isTiered(item) && (!themeDuplicates.includes(item) || settings.themesEnabled)) {
                    addToTier(item, tierNum);
                }
            }
        }
    }
}

function saveSingleTierSettings() {
    const tierList = getCurrentTierList();
    const tierNum = document.getElementById("tier_num").value;
    const tierName = document.getElementById("custom_name_tier").value.replace(/</g, "").replace(/'/g, "");
    const tierBg = document.getElementById("custom_bg_tier").value;
    const tierColour = document.getElementById("custom_colour_tier").value;

    if (!validateTierName(tierName)) {
        document.getElementById("tier_menu_msg_container").innerHTML = `<strong class='error'>Error: tier names may not be empty, nor exceed ${MAX_NAME_LENGTH} characters.</strong>`;
        return;
    }

    emptyModal();
    const th = document.getElementById(`th${tierNum}`);
    th.innerHTML = tierName;
    th.style.backgroundColor = tierBg;
    th.style.color = tierColour;
    tierList[tierNum].name = tierName;
    tierList[tierNum].bg = tierBg;
    tierList[tierNum].colour = tierColour;
    saveData();
}

function tierMenu(tierNum) {
    const tierList = getCurrentTierList();
    emptyModal();
    printMessage("");
    document.getElementById("tier_num").value = tierNum;
    document.getElementById("tier_menu_header").innerHTML = "Customise Tier " + tierList[tierNum].name;
    document.getElementById("custom_name_tier").value = tierList[tierNum].name;
    document.getElementById("custom_bg_tier").value = tierList[tierNum].bg;
    document.getElementById("custom_colour_tier").value = tierList[tierNum].colour;
    const saveTierSettings = document.getElementById("save_tier_settings");
    saveTierSettings.removeEventListener("click", saveSingleTierSettings, false);
    saveTierSettings.addEventListener("click", saveSingleTierSettings, false);
    const removeTier = document.getElementById("remove_tier");
    removeTier.removeEventListener("click", removeTierButton, false);
    removeTier.addEventListener("click", removeTierButton, false);
    document.getElementById("tier_menu").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function detectLeftCtrlCombo(event) {
    const tierNum = event.target.id.replace("th", "");

    if (event.ctrlKey) {
        quickAdd(tierNum);
    } else {
        tierMenu(tierNum);
    }
}

function emptyTier(tierNum) {
    if (isMobile()) {
        removeCharacters(tierNum);
    }

    let confirmation = confirm("Are you sure you want to empty this tier? This will return all items in it to the picker.");

    if (confirmation) {
        removeCharacters(tierNum);
    }
}

function detectRightCtrlCombo(event) {
    event.preventDefault();
    const tierNum = event.target.id.replace("th", "");

    if (event.ctrlKey) {
        emptyTier(tierNum);
    } else {
        removeTier(tierNum);
    }

    return false;
}

function saveData() {
    localStorage.setItem("settings", JSON.stringify(settings));
    localStorage.setItem("tiers", JSON.stringify(tiers));
    printMessage("");
}

function showInformation() {
    emptyModal();
    printMessage("");

    if (isMobile()) {
        document.getElementById("info_mobile").style.display = "block";
    } else {
        document.getElementById("info_desktop").style.display = "block";
    }

    document.getElementById("modal").style.display = "block";
}

function menuMobile() {
    emptyModal();
    printMessage("");
    document.getElementById("menu_mobile").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function checkSort(text) {
    if (sorts.includes(text[0])) {
        return text[0];
    }

    if (text.join('\n').trim() === "") {
        return false;
    }

    for (const line of text) {
        if (line.includes(':') || line.includes(';')) {
            continue;
        }

        if (line.charAt(0) == '#') {
            continue;
        }

        if (line !== "") {
            const items = line.split(',');

            for (const item of items) {
                return whichSort(item.removeSpaces());
            }
        }
    }

    return false;
}

function clearTiers(tierList, sort, sortBackup) {
    const skipConfirmation = true;
    const noDisplay = (sort == sortBackup ? false : true);

    for (let tierNum = Object.keys(tierList).length - 1; tierNum >= 0; tierNum--) {
        removeTier(tierNum, skipConfirmation, noDisplay);
    }
}

function parseSettings(string, sort) {
    const settingsArray = string.split(';');

    if (settingsArray.length == 3) {
        settings.props[sort].tierListName = escapeHTML(settingsArray[0]);
        settings.props[sort].tierHeaderWidth = settingsArray[1];
        settings.props[sort].tierHeaderFontSize = settingsArray[2];
    } else if (settingsArray.length == 4) {
        settings.props[sort].tierListName = escapeHTML(settingsArray[0]);
        settings.props[sort].tierListColour = settingsArray[1];
        settings.props[sort].tierHeaderWidth = settingsArray[2];
        settings.props[sort].tierHeaderFontSize = settingsArray[3];
    } else {
        settings.props[sort].tierListName = escapeHTML(settingsArray[0]);
        settings.props[sort].tierListColour = settingsArray[1];
        settings.props[sort].tierHeaderWidth = settingsArray[2];
        settings.props[sort].tierHeaderFontSize = settingsArray[3];
        settings.props[sort].screenshotWidth = settingsArray[4];
    }
}

function parseImport(text, tierList, sort, originalSort) {
    const noDisplay = (sort == originalSort ? false : true);
    let alreadyAdded = [];
    let counter = -1;
    let characters, item;

    try {
        clearTiers(tierList, sort, originalSort);

        for (let i = 0; i < text.length; i++) {
            if (i === 0 && sorts.includes(text[i])) { // sort on first line
                i += 1;
            }

            if (text[i].includes(';')) { // settings on first or second line
                parseSettings(text[i], sort);
                i += 1;
            }

            if (text[i].includes(':')) { // tier name
                addTier(text[i].replace(':', ""), noDisplay);
                counter += 1;
                i += 1;
            }

            if (text[i].charAt(0) == '#') { // colouring
                tierList[counter].bg = text[i].split(' ')[0];
                tierList[counter].colour = text[i].split(' ')[1];
                i += 1;
            }

            if (text[i] !== "") { // tier list items
                characters = text[i].split(',');

                for (let j = 0; j < characters.length; j++) {
                    item = characters[j];
                    item = item.trim();

                    if (item == "Mai") {
                        item = "Mai PC-98";
                    }

                    try {
                        addToTier(item.removeSpaces(), counter, j, noDisplay);

                        if (alreadyAdded.includes(item)) {
                            throw "Item already added";
                        }

                        alreadyAdded.push(item);
                    } catch (e) {
                        tierList[counter].chars.remove(item);
                    }
                }
            }
        }

        return true;
    } catch (e) {
        return false;
    }
}

function applyImport(tierList) {
    for (const tierNum in tierList) {
        const tierHeader = document.getElementById(`th${tierNum}`);
        tierHeader.style.backgroundColor = tierList[tierNum].bg;
        tierHeader.style.color = tierList[tierNum].colour;
    }

    document.getElementById("tier_list_caption").innerHTML = settings.props[settings.sort].tierListName;
    const tierContent = document.querySelectorAll(".tier_content");

    for (const element of tierContent) {
        element.style.backgroundColor = settings.props[settings.sort].tierListColour;
    }
}

function doImport() {
    const text = document.getElementById("import").value.split('\n');
    const tierSort = checkSort(text);
    const originalSort = settings.sort;
    settings.sort = tierSort;
    const tierList = getCurrentTierList();

    if (!tierSort || !parseImport(text, tierList, tierSort, originalSort)) {
        settings.sort = originalSort;
        document.getElementById("import_text").style.display = "none";
        document.getElementById("modal").style.display = "none";

        if (!tierSort) {
            printMessage("<strong class='error'>Error: cannot import an empty list!</strong>");
        } else {
            printMessage("<strong class='error'>Error: invalid tier list. Either there is a typo somewhere, or this is a bug. Please contact Maribel in case of the latter.</strong>");
        }

        return;
    }

    if (tierSort == originalSort) {
        applyImport(tierList);
    }

    settings.sort = originalSort;
    document.getElementById("import_text").style.display = "none";
    document.getElementById("modal").style.display = "none";
    saveData();
    printMessage("<strong class='confirmation'>Tier list successfully imported!</strong>");
}

function importText() {
    emptyModal();
    printMessage("");
    document.getElementById("import_text").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function copyToClipboard() {
    emptyModal();
    const text = document.getElementById("text_file").value;
    navigator.clipboard.writeText(text.replace(/<\/p><p>/g, "\n").strip());
    printMessage("<strong class='confirmation'>Copied to clipboard!</strong>");
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
    try {
        const base64 = document.getElementById("screenshot_base64").src.slice(22);
        const blob = base64toBlob(base64, "image/png");
        navigator.clipboard.write([
            new ClipboardItem({
                [blob.type]: blob,
            })
        ]);
        document.getElementById("screenshot_msg_container").innerHTML = "<strong class='confirmation'>Copied to clipboard!</strong>";
    } catch (err) {
        document.getElementById("screenshot_msg_container").innerHTML = "<strong class='error'>Your browser does not support image to clipboard.</strong>";
    }
}

function fileName(extension) {
    const date = new Date();
    const month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    let name = "touhou_tier_list";

    if (settings.props[settings.sort].tierListName !== "") {
        name = settings.props[settings.sort].tierListName.toLowerCase().replace(/\s/g, '_');
    }

    return `${name}_${date.getFullYear()}_${month}_${day}_${hours}_${minutes}_${seconds}.${extension}`;
}

function exportText() {
    emptyModal();
    printMessage("");
    const tierList = getCurrentTierList();
    let textFile = settings.sort +
    "\n" + (settings.props[settings.sort].tierListName ? settings.props[settings.sort].tierListName : "-") +
    ";" + settings.props[settings.sort].tierListColour +
    ";" + settings.props[settings.sort].tierHeaderWidth +
    ";" + settings.props[settings.sort].tierHeaderFontSize +
    ";" + settings.props[settings.sort].screenshotWidth;

    for (const tierNum in tierList) {
        textFile += "\n" + tierList[tierNum].name + ":\n" + tierList[tierNum].bg + " " + tierList[tierNum].colour + "\n";
        let items = [];

        for (const item of tierList[tierNum].chars) {
            const title = document.getElementById(item).getAttribute("title");
            items.push(title);
        }

        textFile += items.join(", ") + "\n";
    }

    const saveLink = document.getElementById("save_link");
    saveLink.href = "data:text/plain;charset=utf-8," + encodeURIComponent(textFile);
    saveLink.download = fileName("txt");
    document.getElementById("copy_to_clipboard").addEventListener("click", copyToClipboard, false);
    document.getElementById("text_file").value = textFile;
    document.getElementById("export_text").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function getScreenshotWidth() {
    let screenshotWidth = settings.props[settings.sort].screenshotWidth;

    if (screenshotWidth === "") {
        return atLeastHalfTiered() ? 15 : 10;
    }
    
    return screenshotWidth;
}

function tieredItems() {
    const tierList = getCurrentTierList();
    let result = 0;

    for (const tier in tierList) {
        result += tierList[tier].chars.length;
    }

    return result;
}

function atLeastHalfTiered() {
    const tiered = tieredItems();
    const category = categories[settings.sort];
    let groupSize = 0;

    for (const group in category) {
        groupSize += category[group].chars.length;
    }

    if (settings.sort == "characters" && !settings.themesEnabled) {
        groupSize -= themeDuplicates.length;
    }

    return tiered >= (groupSize / 2);
}

function longestTier() {
    const tierList = getCurrentTierList();
    let longest = 0;
    let length;

    for (const tier in tierList) {
        length = tierList[tier].chars.length;

        if (length > longest) {
            longest = length;
        }
    }

    return longest;
}

function takeScreenshot() {
    const BASE = getScreenshotWidth() + 1;
    const MAX_WIDTH = defaultWidth * BASE + 15;

    try {
        const isTierView = tierView;

        if (!isMobile() && !isTierView) {
            toggleTierView();
        }

        printMessage("<strong class='confirmation'>Girls are being screenshotted, please watch warmly...</strong>");
        const tierListTable = document.getElementById("tier_list_tbody");
        let width = longestTier() * (isMobile() ? 60 : 120) + parseInt(settings.props[settings.sort].tierHeaderWidth) + 50;

        if (width > MAX_WIDTH) {
            document.getElementById("tier_list_table").style.tableLayout = "fixed";
            document.getElementById("tier_list_table").style.width = MAX_WIDTH;
        }

        const positionInfo = tierListTable.getBoundingClientRect();
        width = Math.min(width, MAX_WIDTH);
        let height = positionInfo.height + 50;

        if (isMobile()) {
            document.getElementById("tier_list_container").classList.add("screenshot_margin");
        }

        html2canvas(document.body, {
            "width": width,
            "windowWidth": width,
            "height": height,
            "windowHeight": height,
            "logging": false,
            "scrollX": 0,
            "scrollY": 0
        }).then(function (canvas) {
            emptyModal();
            const base64image = canvas.toDataURL("image/png");
            const saveLink = document.getElementById("screenshot_link");
            saveLink.href = base64image;
            saveLink.download = fileName("png");
            document.getElementById("image_to_clipboard").addEventListener("click", imageToClipboard, false);
            document.getElementById("screenshot_base64").src = base64image;
            document.getElementById("screenshot").style.display = "block";
            document.getElementById("modal").style.display = "block";

            if (isMobile()) {
                document.getElementById("tier_list_container").classList.remove("screenshot_margin");
            }

            printMessage("");
            document.getElementById("tier_list_table").style.removeProperty("table-layout");
            document.getElementById("tier_list_table").style.removeProperty("width");

            if (!isMobile() && !isTierView) {
                toggleTierView();
            }
        });
    } catch (e) {
        printMessage("<strong class='error'>Error: your browser is outdated. Use a different browser to screenshot your tier list.</strong>");
    }
}

function showCheckboxes() {
    const cats = categories[settings.sort];
    const id = (settings.sort == "characters" ? "settings_characters" : "settings");
    const settingsTable = document.getElementById(`${id}_tbody`);
    let counter = 0;
    settingsTable.innerHTML = `<tr id='${id}_tr0'>`;

    for (const categoryName in cats) {
        const current = Math.floor(counter / 5);
    
        if (counter > 0 && counter % 5 === 0) {
            settingsTable.innerHTML += `</tr><tr id='${id}_tr${current}'>`;
        }

        const isChecked = (settings.categories[settings.sort][categoryName].enabled ? " checked" : "");
        document.getElementById(`${id}_tr${current}`).innerHTML += `<td><input id='checkbox_${categoryName}' type='checkbox'${isChecked}><label for='${categoryName}'>${categoryName}</label></td>`;
        counter += 1;
    }

    settingsTable.innerHTML += "</tr>";

    if (settings.sort == "characters") {
        document.getElementById("pc98").checked = settings.pc98Enabled;
        document.getElementById("windows").checked = settings.pc98Enabled;
        document.getElementById("male").checked = settings.maleEnabled;
        document.getElementById("themes").checked = settings.themesEnabled;
    }
}

function settingsMenu() {
    emptyModal();
    printMessage("");
    showCheckboxes();
    const isCharacters = (settings.sort == "characters");
    document.getElementById("settings_characters").style.display = (isCharacters ? "block" : "none");
    document.getElementById("settings_other").style.display = (isCharacters ? "none" : "block");
    document.getElementById("tier_list_name_menu").value = settings.props[settings.sort].tierListName;
    document.getElementById("tier_list_colour").value = settings.props[settings.sort].tierListColour;
    document.getElementById("tier_header_width").value = settings.props[settings.sort].tierHeaderWidth;
    document.getElementById("tier_header_width").min = defaultWidth;
    document.getElementById("tier_header_font_size").value = settings.props[settings.sort].tierHeaderFontSize;
    document.getElementById("screenshot_width").value = getScreenshotWidth();
    document.getElementById("settings").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function massRemoval(toRemove) {
    const cats = categories[settings.sort];

    for (const value of toRemove) {
        if (isCategory(value)) {
            for (const item of cats[value].chars) {
                if (isTiered(item)) {
                    removeFromTier(item, getTierNumOf(item));
                }
            }
        } else {
            const item = value;
            removeFromTier(item, getTierNumOf(item));
        }
    }
}

function togglePC98() {
    const pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"];

    for (const id of pc98) {
        const element = document.getElementById(`checkbox_${id}`);
        element.checked = !element.checked;
    }
}

function toggleWindows() {  
    for (const id of windows) {
        const element = document.getElementById(`checkbox_${id}`);
        element.checked = !element.checked;
    }
}

function toggleMale() {
    const display = (settings.maleEnabled ? "inline-block" : "none");

    for (const maleCharacter of maleCharacters) {
        document.getElementById(maleCharacter).style.display = display;
    }
}

function toggleThemes() {
    const display = (settings.themesEnabled ? "inline-block" : "none");

    for (const themeDuplicate of themeDuplicates) {
        document.getElementById(themeDuplicate).style.display = display;
    }
}

function saveSettingsData() {
    const fontSizeLimit = 72;
    const cats = categories[settings.sort];
    let checked = {};
    let toRemove = [];

    for (const categoryName in cats) {
        checked[categoryName] = document.getElementById(`checkbox_${categoryName}`).checked;
        settings.categories[settings.sort][categoryName].enabled = checked;

        if (!checked[categoryName]) {
            for (const item of cats[categoryName].chars) {
                if (isTiered(item)) {
                    toRemove.push(categoryName);
                }
            }
        }
    }

    const maleChecked = document.getElementById("male").checked;

    if (settings.sort == "characters" && !maleChecked) {
        for (const maleCharacter of maleCharacters) {
            if (isTiered(maleCharacter)) {
                toRemove.push(maleCharacter);
            }
        }
    }

    if (toRemove.length > 0) {
        const confirmation = confirm("This will remove characters from disabled categories from the current tiers. Are you sure you want to do that?");

        if (isMobile() || confirmation) {
            massRemoval(toRemove);
        } else {
            return;
        }
    }

    for (const categoryName in cats) {
        const display = (checked[categoryName] && !allTiered(categoryName) ? "block" : "none");
        document.getElementById(categoryName).style.display = display;
    }

    if (settings.sort == "characters") {
        settings.pc98Enabled = document.getElementById("pc98").checked;
        settings.windowsEnabled = document.getElementById("windows").checked;
        settings.maleEnabled = maleChecked;
        settings.themesEnabled = document.getElementById("themes").checked;
        toggleMale();
        toggleThemes();
    }

    const tierHeaders = document.querySelectorAll(".tier_header");
    const tierContents = document.querySelectorAll(".tier_content");
    const tierHeaderWidth = document.getElementById("tier_header_width").value;
    const tierHeaderFontSize = Math.min(document.getElementById("tier_header_font_size").value, fontSizeLimit);
    const screenshotWidth = document.getElementById("screenshot_width").value;
    settings.props[settings.sort].tierListName = escapeHTML(document.getElementById("tier_list_name_menu").value);
    settings.props[settings.sort].tierListColour = document.getElementById("tier_list_colour").value;
    settings.props[settings.sort].tierHeaderWidth = tierHeaderWidth > defaultWidth ? tierHeaderWidth : defaultWidth;
    settings.props[settings.sort].tierHeaderFontSize = tierHeaderFontSize != defaultSize ? tierHeaderFontSize : defaultSize;
    settings.props[settings.sort].screenshotWidth = Math.max(parseInt(screenshotWidth), 1);

    for (const element of tierHeaders) {
        element.style.width = settings.props[settings.sort].tierHeaderWidth + "px";
        element.style.maxWidth = settings.props[settings.sort].tierHeaderWidth + "px";
        element.style.fontSize =  settings.props[settings.sort].tierHeaderFontSize + "px";
    }

    for (const element of tierContents) {
        element.style.backgroundColor = settings.props[settings.sort].tierListColour;
    }

    document.getElementById("tier_list_caption").innerHTML = settings.props[settings.sort].tierListName;
    document.getElementById("settings").style.display = "none";
    document.getElementById("modal").style.display = "none";
    saveData();
    printMessage("<strong class='confirmation'>Settings saved!</strong>");
}

function toggleTierView() {
    const wrap = document.getElementById("wrap");

    if (tierView) {
        document.getElementById("characters").style.display = "block";
        document.getElementById("toggle_picker").style.display = "inline";
        document.getElementById("toggle_view").value = "Tier List View";
        document.body.style.background = "url('assets/other/tiers/tiers.jpg') center no-repeat fixed";
        document.body.style.backgroundSize = "cover";
        wrap.style.width = (smallPicker ? "65%" : "45%");
        wrap.style.bottom = "";
        wrap.style.left = "";
        wrap.style.border = "1px solid #000";
    } else {
        document.getElementById("characters").style.display = "none";
        document.getElementById("toggle_picker").style.display = "none";
        document.getElementById("toggle_view").value = "Normal View";
        document.body.style.background = defaultBg;
        document.body.style.backgroundSize = "auto";
        wrap.style.width = "auto";
        wrap.style.bottom = "5px";
        wrap.style.left = "5px";
        wrap.style.border = "none";
    }

    printMessage("");
    tierView = !tierView;
}

function togglePickerSize(onLoad) {
    smallPicker = (onLoad === true ? true : !smallPicker);
    document.getElementById("wrap").style.width = (smallPicker ? "65%" : "45%");
    document.getElementById("characters").style.width = ( smallPicker ? "31%" : "51%");
    document.getElementById("toggle_picker").value = (smallPicker ? "Large Picker" : "Small Picker");

    if (smallPicker) {
        settings.picker = "small";
    } else {
        delete settings.picker;
    }

    if (onLoad !== true) {
        saveData();
    }

    printMessage("");
}

function changeLog() {
    emptyModal();
    printMessage("");
    document.getElementById("changelog").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function eraseAllConfirmed() {
    clearTiers(getCurrentTierList(), settings.sort, settings.sort);
    tiers = {};

    for (const sort of sorts) {
        tiers[sort] = {};
    }

    settings = DEFAULT_SETTINGS;
    localStorage.removeItem("tiers");
    localStorage.removeItem("settings");
    deleteCookie("sort");
    initialise();
    printMessage("<strong class='confirmation'>Reset the tier lists and settings to their default states!</strong>");
}

function modalEraseAll() {
    eraseAllConfirmed();
    emptyModal();
}

function modalEraseSingle() {
    emptyModal();
    clearTiers(getCurrentTierList(), settings.sort, settings.sort);

    for (const tierName of DEFAULT_TIER_NAMES) {
        addTier(tierName);
    }

    settings.props[settings.sort].tierListName = "";
    settings.props[settings.sort].tierListColour = defaultBg;
    settings.props[settings.sort].tierHeaderWidth = defaultWidth;
    settings.props[settings.sort].tierHeaderFontSize = defaultSize;
    settings.props[settings.sort].screenshotWidth = "";
    document.getElementById("tier_list_caption").innerHTML = "";
    const tierHeaders = document.querySelectorAll(".tier_header");
    const tierContents = document.querySelectorAll(".tier_content");

    for (const element of tierHeaders) {
        element.style.width = defaultWidth + "px";
        element.style.maxWidth = defaultWidth + "px";
        element.style.fontSize = defaultSize + "px";
    }

    for (const element of tierContents) {
        element.style.backgroundColor = defaultBg;
    }

    localStorage.setItem("settings", JSON.stringify(settings));
    saveData();
    printMessage("<strong class='confirmation'>Reset the current tier list and its settings to their default states!</strong>");
}

function eraseAll() {
    emptyModal();
    document.getElementById("reset").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function drag(event) {
    following = event.target.id;
}

function allowDrop(event) {
    event.preventDefault();
}

function preventContextMenu(event) {
    event.preventDefault();
}

function tierOntoTier(tierNum) {
    if (following.substring(0, 2) != tierNum) {
        moveTierTo(Number(following.replace("th", "")), tierNum);
    }
}

function itemOntoTier(tierNum) {
    if (following === "") { // duplicate from wrap drop event
        return;
    }

    if (multiSelection.length > 0 && multiSelection.includes(following)) {
        addMultiSelection(tierNum);
    } else {
        if (isTiered(following)) {
            changeToTier(following, tierNum);
        } else {
            addToTier(following, tierNum);
        }
    }
}

function dropOntoTier(event) {
    const tierNum = Number(event.target.id.replace("th", "").replace("tier", "").replace(/_\d+/, ""));

    if (following.substring(0, 2) == "th") {
        tierOntoTier(tierNum);
    } else {
        itemOntoTier(tierNum);
    }
}

function itemOntoTieredItem(event) {
    if (isTiered(following)) {
        if (getTierNumOf(following) === getTierNumOf(event.target.id)) {
            if (multiSelection.length > 0) {
                moveMultiSelectionTo(event.target.id);
            } else {
                moveItemTo(following, event.target.id);
            }
        } else {
            if (multiSelection.length > 0) {
                changeMultiSelectionTo(getTierNumOf(event.target.id), getPositionOf(event.target.id));
            } else {
                changeToTier(following, getTierNumOf(event.target.id), getPositionOf(event.target.id));
            }
        }
    } else {
        addToTier(following, getTierNumOf(event.target.id), getPositionOf(event.target.id));
    }
}

function tieredItemOntoPicker() {
    if (multiSelection.length > 0) {
        removeMultiSelection();
    } else {
        removeFromTier(following, getTierNumOf(following));
    }
}

function drop(event) {
    event.preventDefault();

    if (!following) {
        return;
    }

    if (event.target.id.substring(0, 2) === "th" || event.target.id.substring(0, 4) === "tier" && event.target.id !== "tier_list_table") {
        dropOntoTier(event);
    }
    else if (isTiered(event.target.id) && following.substring(0, 2) != "th") {
        itemOntoTieredItem(event);
    }
    else if ((isItem(event.target.id) || isCategory(event.target.id) || event.target.id === "characters") && isTiered(following)) {
        tieredItemOntoPicker();
    }
    else if (isMobile() && event.target.id == "wrap") {
        tieredItemOntoPicker();
    }

    following = "";
}

function deleteLegacyCookies() {
    if (getCookie("order")) {
        deleteCookie("order");
    }

    if (getCookie("gameOrder")) {
        deleteCookie("gameOrder");
    }

    if (getCookie("tiers")) {
        tiers.characters = getCookie("tiers");
        localStorage.setItem("tiers", JSON.stringify(tiers));
        deleteCookie("tiers");
    }

    if (getCookie("gameTiers")) {
        tiers.works = getCookie("gameTiers");
        localStorage.setItem("tiers", JSON.stringify(tiers));
        deleteCookie("gameTiers");
    }

    if (getCookie("settings")) {
        localStorage.setItem("settings", getCookie("settings"));
        deleteCookie("settings");
    }

    if (localStorage.getItem("tiers") && JSON.parse(localStorage.getItem("tiers")).hasOwnProperty("0")) {
        tiers.characters = JSON.parse(localStorage.getItem("tiers"));
        localStorage.setItem("tiers", JSON.stringify(tiers));
    }

    if (localStorage.getItem("gameTiers")) {
        tiers.works = JSON.parse(localStorage.getItem("gameTiers"));
        localStorage.setItem("tiers", JSON.stringify(tiers));
        localStorage.removeItem("gameTiers");
    }

    if (localStorage.getItem("shotTiers")) {
        tiers.shots = JSON.parse(localStorage.getItem("shotTiers"));
        localStorage.setItem("tiers", JSON.stringify(tiers));
        localStorage.removeItem("shotTiers");
    }

    localStorage.removeItem("order");
    localStorage.removeItem("gameOrder");
    localStorage.removeItem("shotOrder");
}

function addCategoryNamesToShots() {
    for (const key in categories.shots) {
        for (let i = 0; i < categories.shots[key].chars.length; i++) {
            categories.shots[key].chars[i] = key + categories.shots[key].chars[i].replace(" Team", "Team");
        }
    }
}

function loadTier(tiersData, tierNum, sort) {
    tiers[sort][tierNum] = {};
    tiers[sort][tierNum].name = tiersData.name;
    tiers[sort][tierNum].bg = tiersData.bg;
    tiers[sort][tierNum].colour = tiersData.colour;
    tiers[sort][tierNum].chars = [];

    if (sort == settings.sort) {
        createTier(tierNum);
    }

    for (let item of tiersData.chars) {
        if (item == "Mai") {
            item = "Mai PC-98";
        }

        if (sort == settings.sort) {
            addToTier(item, tierNum);
        } else {
            tiers[sort][tierNum].chars.pushStrict(item);
        }
    }
}

function loadTiersFromStorage() {
    const tiersData = JSON.parse(localStorage.getItem("tiers"));

    for (const sort in tiers) {
        if (!tiersData.hasOwnProperty(sort)) {
            tiers[sort] = DEFAULT_TIERS;

            for (const tierNum in tiers[sort]) {
                loadTier(tiers[sort][tierNum], Number(tierNum), sort);
            }

            continue;
        }

        const tierList = tiersData[sort];

        if (tierList.isEmpty()) {
            tiers[sort] = DEFAULT_TIERS;

            for (const tierNum in tiers[sort]) {
                loadTier(tiers[sort][tierNum], Number(tierNum), sort);
            }
        } else {
            for (const tierNum in tierList) {
                const tier = tierList[tierNum];
                loadTier(tier, Number(tierNum), sort);
            }
        }
    }
}

function loadItems(pageLoad) {
    const cats = categories[settings.sort];

    try {
        if (!pageLoad) {
            const items = document.getElementById("characters");
    
            for (const categoryName in cats) {
                const category = document.createElement("div");
                category.id = categoryName;
                category.classList.add("dark_bg");
                items.appendChild(category);
        
                for (const item of cats[categoryName].chars) {
                    let span = document.createElement("span");
                    let childSpan = document.createElement("span");
                    span.id = `${item}C`;
                    childSpan.id = `${item}`;
                    childSpan.classList.add("item");
                    childSpan.classList.add(`list_${settings.sort}`);
                    childSpan.draggable = true;
                    childSpan.title = addSpacing(item);
                    category.appendChild(span);
                    span.appendChild(childSpan);
                    setPickerItemEvents(item);
                }
            }
        } else { // on page load
            for (const categoryName in cats) {
                for (const item of cats[categoryName].chars) {
                    setPickerItemEvents(item);
                    document.getElementById(item).title = addSpacing(item);
                }
            }
        }
    
        for (const categoryName in cats) {
            if (!settings.categories[settings.sort][categoryName]) {
                settings.categories[settings.sort][categoryName] = { enabled: true };
            } else if (!settings.categories[settings.sort][categoryName].enabled) {
                document.getElementById(categoryName).style.display = "none";
            }
    
            if (settings.sort == "characters") {
                toggleMale();
                toggleThemes();
            }
        }
    } catch (e) { // if load is broken due to outdated save
        settings.sort = "characters";
        localStorage.setItem("settings", JSON.stringify(settings));
    }
}

function loadLegacySettings(settingsData) {
    if (settingsData.hasOwnProperty("categories")) {
        for (let category in settingsData.categories) {
            if (spinoffs.includes(category)) {
                settings.categories.characters["Spinoff"].enabled = settingsData.categories[category].enabled;
            } else {
                settings.categories.characters[category].enabled = settingsData.categories[category].enabled;
            }
        }

        if (settingsData.hasOwnProperty("gameCategories")) {
            for (let category in settingsData.gameCategories) {
                if (category == "Manga") { // fix legacy manga
                    settings.categories.works["Mangas"] = settingsData.gameCategories[category];
                    continue;
                }

                settings.categories.works[category].enabled = settingsData.gameCategories[category].enabled;
            }
        }

        if (settingsData.hasOwnProperty("shotCategories")) {
            for (let category in settingsData.shotCategories) {
                if (!settings.categories.shots[category]) {
                    settings.categories.shots[category] = { enabled: true };
                }

                settings.categories.shots[category].enabled = settingsData.shotCategories[category].enabled;
            }
        }

        for (const sort of sorts) {
            settings.props[sort].tierListName = (settingsData[sort] && settingsData[sort].tierListName ? settingsData[sort].tierListName : "");
            settings.props[sort].tierListColour = (settingsData[sort] && settingsData[sort].tierListColour ? settingsData[sort].tierListColour : defaultBg);
            settings.props[sort].tierHeaderWidth = (settingsData[sort] && settingsData[sort].tierHeaderWidth ? settingsData[sort].tierHeaderWidth : defaultWidth);
            settings.props[sort].tierHeaderFontSize = (settingsData[sort] && settingsData[sort].tierHeaderFontSize ? settingsData[sort].tierHeaderFontSize : defaultSize);
            settings.props[sort].screenshotWidth = (settingsData[sort] && settingsData[sort].screenshotWidth ? settingsData[sort].screenshotWidth : "");
        }

        if (settingsData.picker && settingsData.picker == "small") {
            const onLoad = true;
            togglePickerSize(onLoad);
        }

        settings.pc98Enabled = settingsData.pc98Enabled;
        settings.windowsEnabled = settingsData.windowsEnabled;
        settings.maleEnabled = settingsData.maleEnabled;
        settings.themesEnabled = (settingsData.themesEnabled ? settingsData.themesenabled: false);
        settings.sort = settingsData.sort;
    } else {
        for (const category in settingsData) {
            if (category == "Other") {
                settings.categories.characters["Manga"].enabled = settingsData[category].enabled;
                settings.categories.characters["CD"].enabled = settingsData[category].enabled;
            } else {
                settings.categories.characters[category].enabled = settingsData[category].enabled;
            }
        }
    }
}

function loadSettingsFromStorage() {
    const settingsData = JSON.parse(localStorage.getItem("settings"));

    if (settingsData.hasOwnProperty("gameCategories")) {
        loadLegacySettings(settingsData);
        return;
    }

    if (settingsData.hasOwnProperty("categories")) {
        for (const item in settings) {
            if (item == "categories" || item == "props") {
                continue;
            }

            settings[item] = settingsData[item];
        }

        if (settingsData.picker && settingsData.picker == "small") {
            const onLoad = true;
            togglePickerSize(onLoad);
        }

        for (const sort of sorts) {
            settings.categories[sort] = settingsData.categories.hasOwnProperty(sort) ? settingsData.categories[sort] : DEFAULT_SETTINGS.categories[sort];

            if (settingsData.props.hasOwnProperty(sort)) {
                settings.props[sort].tierListName = (settingsData.props[sort].tierListName ? settingsData.props[sort].tierListName : "");
                settings.props[sort].tierListColour = (settingsData.props[sort].tierListColour ? settingsData.props[sort].tierListColour : defaultBg);
                settings.props[sort].tierHeaderWidth = (settingsData.props[sort].tierHeaderWidth ? settingsData.props[sort].tierHeaderWidth : defaultWidth);
                settings.props[sort].tierHeaderFontSize = (settingsData.props[sort].tierHeaderFontSize ? settingsData.props[sort].tierHeaderFontSize : defaultSize);
                settings.props[sort].screenshotWidth = (settingsData.props[sort].screenshotWidth ? settingsData.props[sort].screenshotWidth : "");
            } else {
                settings.props[sort] = DEFAULT_PROPS;
            }
        }
    }
}

function addTierDesktop() {
    addTier(document.getElementById("tier_name").value);
}

function addTierMobile() {
    addTier(document.getElementById("tier_name_mobile").value);
}

function detectTierListNameEnter(event) {
    if (event.key && event.key == "Enter") {
        changeTierListName(document.getElementById("tier_list_name").value);
    }
}

function detectAddTierEnter(event) {
    if (event.key && event.key == "Enter") {
        if (isMobile()) {
            addTierMobile();
        } else {
            addTierDesktop();
        }
    }
}

function detectSettingsEnter(event) {
    if (event.key && event.key == "Enter") {
        saveSettingsData();
    }
}

function detectTiersEnter(event) {
    if (event.key && event.key == "Enter") {
        saveSingleTierSettings(document.getElementById("tier_num").value);
    }
}

function setEventListeners() {
    const settingsInput = document.querySelectorAll(".settings_input");

    for (const element of settingsInput) {
        element.addEventListener("keyup", detectSettingsEnter, false);
    }

    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", detectKey, false);
    document.getElementById("sort").addEventListener("click", switchSort, false);
    document.getElementById("toggle_view").addEventListener("click", toggleTierView, false);
    document.getElementById("toggle_picker").addEventListener("click", togglePickerSize, false);
    document.getElementById("info_button").addEventListener("click", showInformation, false);
    document.getElementById("tier_name").addEventListener("keyup", detectAddTierEnter, false);
    document.getElementById("tier_name_mobile").addEventListener("keyup", detectAddTierEnter, false);
    document.getElementById("tier_list_name").addEventListener("keyup", detectTierListNameEnter, false);
    document.getElementById("import_button").addEventListener("click", importText, false);
    document.getElementById("export_button").addEventListener("click", exportText, false);
    document.getElementById("screenshot_button").addEventListener("click", takeScreenshot, false);
    document.getElementById("settings_button").addEventListener("click", settingsMenu, false);
    document.getElementById("changelog_button").addEventListener("click", changeLog, false);
    document.getElementById("reset_button").addEventListener("click", eraseAll, false);
    document.getElementById("information_button").addEventListener("click", showInformation, false);
    document.getElementById("menu_button").addEventListener("click", menuMobile, false);
    document.getElementById("switch_button").addEventListener("click", switchSort, false);
    document.getElementById("characters").addEventListener("dragover", allowDrop, false);
    document.getElementById("characters").addEventListener("dragenter", allowDrop, false);
    document.getElementById("characters").addEventListener("drop", drop, false);
    document.getElementById("wrap").addEventListener("dragover", allowDrop, false);
    document.getElementById("wrap").addEventListener("dragenter", allowDrop, false);
    document.getElementById("wrap").addEventListener("drop", drop, false);
    document.getElementById("pc98").addEventListener("click", togglePC98, false);
    document.getElementById("windows").addEventListener("click", toggleWindows, false);
    document.getElementById("save_settings").addEventListener("click", saveSettingsData, false);
    document.getElementById("erase_all_button").addEventListener("click", modalEraseAll, false);
    document.getElementById("erase_single_button").addEventListener("click", modalEraseSingle, false);
    document.getElementById("cancel_button").addEventListener("click", emptyModal, false);
    document.getElementById("custom_name_tier").addEventListener("keyup", detectTiersEnter, false);
    document.getElementById("import_button_mobile").addEventListener("click", importText, false);
    document.getElementById("export_button_mobile").addEventListener("click", exportText, false);
    document.getElementById("screenshot_button_mobile").addEventListener("click", takeScreenshot, false);
    document.getElementById("settings_button_mobile").addEventListener("click", settingsMenu, false);
    document.getElementById("changelog_button_mobile").addEventListener("click", changeLog, false);
    document.getElementById("reset_button_mobile").addEventListener("click", eraseAll, false);
    document.getElementById("add_tier").addEventListener("click", addTierDesktop, false);
    document.getElementById("add_tier_mobile").addEventListener("click", addTierMobile, false);
    document.getElementById("add_tier_list_name").addEventListener("click", changeTierListName, false);
}

function init() {
    for (const sort of sorts) {
        tiers[sort] = {};
    }

    deleteLegacyCookies();
    addCategoryNamesToShots();

    if (localStorage.settings) {
        loadSettingsFromStorage();
    }

    document.getElementById("tier_list_caption").innerHTML = settings.props[settings.sort].tierListName;
    document.getElementById(`sort_${settings.sort}`).classList.add("current_sort");
    loadItems(true);

    if (!getCookie("sort")) {
        firstTime = true;
    }

    if (!localStorage.tiers && !localStorage.gameTiers && !localStorage.shotTiers) {
        initialise();
    } else {
        loadTiersFromStorage();
    }

    const importElement = document.getElementById("import");
    const errorElement = document.getElementById("error");
    const tierContent = document.querySelectorAll(".tier_content");

    if (importElement) {
        doImport();
        importElement.parentNode.removeChild(importElement);
    } else {
        if (errorElement && errorElement.value) {
            printMessage(errorElement.value);
            errorElement.parentNode.removeChild(errorElement);
        }

        for (const element of tierContent) {
            element.style.backgroundColor = settings.props[settings.sort].tierListColour;
        }
    }

    setEventListeners();
}

window.addEventListener("DOMContentLoaded", init, false);
