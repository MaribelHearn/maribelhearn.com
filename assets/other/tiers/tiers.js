/*global $ categories html2canvas isMobile setCookie getCookie deleteCookie MobileDragDrop*/
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
    "tierHeaderFontSize": defaultSize
};
const DEFAULT_SETTINGS = {
    "categories": {
        "characters": {
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true },
            "LLS": { enabled: true }, "MS": { enabled: true }, "EoSD": { enabled: true }, "PCB": { enabled: true },
            "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true }, "SA": { enabled: true },
            "UFO": { enabled: true }, "TD": { enabled: true }, "DDC": { enabled: true }, "LoLK": { enabled: true },
            "HSiFS": { enabled: true }, "WBaWC": { enabled: true }, "UM": { enabled: true }, "Spinoff": { enabled: true },
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
            "Item": { enabled: true }, "Equipment": { enabled: true }, "Passive": { enabled: true }, "Active": { enabled: true }
        }
    },
    "props": {
        "characters": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize
        },
        "works": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize
        },
        "shots": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize
        },
        "cards": {
            "tierListName": "",
            "tierListColour": defaultBg,
            "tierHeaderWidth": defaultWidth,
            "tierHeaderFontSize": defaultSize
        }
    },
    "pc98Enabled": true,
    "windowsEnabled": true,
    "maleEnabled": true,
    "themesEnabled": false,
    "sort": "characters"
};
let tieredItems = [];
let settings = DEFAULT_SETTINGS;
let tiers = {};
let multiSelection = [];
let following = "";
let tierView = false;
let smallPicker = false;
let unsavedChanges = false;

function addSpacing(item) {
    const sort = whichSort(item);

    if (sort == "shots") {
        if (item.includes("HSiFS") || item.includes("WBaWC")) {
            return item.replace("HSiFS", "HSiFS ").replace("WBaWC", "WBaWC ");
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
        item = item.replace("And ", "and ").replace("Its ", "its ").replace("To ", "to ").replace(" A ", " a ").replace("Of ", "of ");
        item = item.replace("The ", "the ").replace("Is ", "is ").replace("In ", "in ").replace("With ", "with ");
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

    const itemClasses = document.getElementById(item).classList;

    for (const sort of sorts) {
        if (itemClasses.contains(`tiered_${sort}`)) {
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
    const element = document.getElementById(item);
    $("#" + item).on("dragstart", drag);
    element.addEventListener("click", toggleMulti, false);

    if (!isMobile()) {
        $("#" + item).on("dblclick", addMenu);
    } else {
        element.addEventListener("contextmenu", preventContextMenu, false);
    }
}

function setTieredItemEvents(item, tierNum) {
    $("#" + item).off("dblclick");
    $("#" + item).off("contextmenu");
    $("#" + item).off("dragstart");
    $("#" + item).off("dragover dragenter");
    $("#" + item).off("click");
    $("#" + item).on("dragstart", drag);
    $("#" + item).on("dragover dragenter", allowDrop);
    $("#" + item).on("click", toggleMulti);

    if (isMobile()) {
        $("#" + item).on("contextmenu", preventContextMenu);
    } else {
        $("#" + item).on("dblclick", addMenu);
        $("#" + item).on("contextmenu", {tierNum: tierNum}, tieredContextMenu);
    }
}

function reloadTiers() {
    var cats = categories[settings.sort], tierList = getCurrentTierList(), tierNum, i, item, id, j;

    for (i = 0; i < Object.keys(tiers).length; i++) {
        $("#tier" + i).html("");
    }

    if (tierList.isEmpty()) {
        return;
    }

    document.getElementById("tier_list_caption").innerHTML = settings.props[settings.sort].tierListName;

    for (tierNum in tierList) {
        tierNum = Number(tierNum);
        $("#tier_list_tbody").append("<tr id='tr" + tierNum +
        "' class='tier'><th id='th" + tierNum +
        "' class='tier_header' draggable='true'>" + tierList[tierNum].name + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");
        $("#tr" + tierNum).on("dragover dragenter", allowDrop);
        $("#tr" + tierNum).on("drop", drop);
        $("#tr" + tierNum).on("dragstart", drag);
        $("#tr" + tierNum).css("background-color", settings.props[settings.sort].tierListColour);
        $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
        $("#th" + tierNum).css("background-color", tierList[tierNum].bg);
        $("#th" + tierNum).css("color", tierList[tierNum].colour);
        $("#th" + tierNum).css("max-width", settings.props[settings.sort].tierHeaderWidth + "px");
        $("#th" + tierNum).css("width", settings.props[settings.sort].tierHeaderWidth + "px");
        $("#th" + tierNum).css("font-size", settings.props[settings.sort].tierHeaderFontSize + "px");

        if (isMobile()) {
            $("#th" + tierNum).css("height", "60px");
            $("#" + item).on("contextmenu", preventContextMenu);
        } else {
            $("#th" + tierNum).on("contextmenu", {tierNum: tierNum}, detectRightCtrlCombo);
        }

        for (i = 0; i < tierList[tierNum].chars.length; i++) {
            item = tierList[tierNum].chars[i];

            if (item == "Mai") {
                item = "Mai PC-98";
            }

            $("#" + item).removeClass("list_" + settings.sort);
            $("#" + item).addClass("tiered_" + settings.sort);
            id = "tier" + tierNum + "_" + i;
            $("#tier" + tierNum).append("<span id='" + id + "'></span>");
            $("#" + id).html($("#" + item));
            setTieredItemEvents(item, tierNum);

            for (j in cats) {
                if (!$("#" + j).html().includes("list_" + settings.sort)) {
                    $("#" + j).css("display", "none");
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
}

function printMessage(message) {
    const id = "msg_container" + (isMobile() ? "_mobile" : "");
    document.getElementById(id).innerHTML = message;
}

function switchSort() {
    document.getElementById("characters").innerHTML = "";
    document.getElementById("tier_list_tbody").innerHTML = "";

    if (isMobile()) {
        settings.sort = sorts[(sorts.indexOf(settings.sort) + 1) % sorts.length];
    } else {
        settings.sort = document.getElementById("sort").value;
    }

    loadItems(false);
    reloadTiers();
    saveWithoutMenu();
    setCookie("sort", settings.sort);

    if (isMobile()) {
        printMessage(`<strong class='confirmation'>Switched to ${settings.sort}!</strong>`);
    } else {
        printMessage("");
    }
}

function tieredContextMenu(event) {
    event.preventDefault();
    const item = this.id;
    const tierNum = Number(event.data.tierNum);
    removeFromTier(item, tierNum);
    return false;
}

function insertAt(character, tierNum, pos, chars) {
    const element = document.getElementById(character);
    document.getElementById(`tier${tierNum}_${pos}`).appendChild(element);

    for (let counter = chars.length - 1; counter >= pos; counter -= 1) {
        const id = getItemAt(tierNum, counter);
        const next = `tier${tierNum}_${counter + 1}`;
        const itemElement = document.getElementById(id);
        document.getElementById(next).appendChild(itemElement);
        chars[counter + 1] = id;
    }

    chars[pos] = character;
}

function addToTier(item, tierNum, pos, noDisplay) {
    var cats = categories[settings.sort], tierList = getCurrentTierList(), categoryName = getCategoryOf(item), id;

    if (isTiered(item)) {
        return;
    }

    printMessage("");
    const itemElement = document.getElementById(item);
    itemElement.classList.remove("selected");
    itemElement.classList.remove(`list_${settings.sort}`);
    itemElement.classList.add(`tiered_${settings.sort}`);

    if (isMobile()) {
        $("#" + item).on("contextmenu", preventContextMenu);
    } else {
        $("#" + item).on("contextmenu", {tierNum: tierNum}, tieredContextMenu);
    }

    $("#" + item).on("dragover dragenter", allowDrop);
    id = "tier" + tierNum + "_" + tierList[tierNum].chars.length;
    $("#tier" + tierNum).append("<span id='" + id + "'></span>");
    tieredItems.push(item);

    if (typeof pos == "number" && pos < tierList[tierNum].chars.length && !noDisplay) {
        insertAt(item, tierNum, pos, tierList[tierNum].chars);
    } else {
        if (!noDisplay) {
            $("#" + id).append($("#" + item));
        }

        tierList[tierNum].chars.pushStrict(item);
    }

    unsavedChanges = true;

    for (let chara of cats[categoryName].chars) {
        if (!isTiered(chara)) {
            return;
        }
    }

    $("#" + categoryName).css("display", "none");
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
            removeFromTier(item, getTierNumOf(item));
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

function addToTierMobile(event) {
    console.log(event.target.id);
    const id = event.target.id.split('_');
    const item = id[2];
    const tierNum = id[3];
    const tierList = getCurrentTierList();
    $("#" + item).off("click");

    if (typeof item == "object") { // multiselection
        following = item[0];
        const chars = multiSelectionToText();
        addMultiSelection(tierNum);
        printMessage("<strong class='confirmation'>Added " + chars + " to " + tierList[tierNum].name + "!</strong>");
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
    printMessage("");
    unsavedChanges = true;
}

function moveItemTo(sourceItem, targetItem) {
    var tierList = getCurrentTierList(), sourcePos = getPositionOf(sourceItem), targetPos = getPositionOf(targetItem),
        tierNum = getTierNumOf(targetItem), tmp = $("#tier" + tierNum + "_" + sourcePos).html(), prevPos, nextPos, item, i;

    if (targetPos == tierList[tierNum].chars.length - 1) {
        moveToBack(sourceItem, tierNum);
        return;
    }

    if (sourcePos > targetPos) {
        for (i = sourcePos; i > targetPos; i--) {
            prevPos = i - 1;
            $("#tier" + tierNum + "_" + i).html($("#tier" + tierNum + "_" + prevPos).html());
            tierList[tierNum].chars[i] = tierList[tierNum].chars[prevPos];
        }
    } else if (sourcePos < targetPos) {
        for (i = sourcePos; i < targetPos; i++) {
            nextPos = i + 1;
            $("#tier" + tierNum + "_" + i).html($("#tier" + tierNum + "_" + nextPos).html());
            tierList[tierNum].chars[i] = tierList[tierNum].chars[nextPos];
        }
    } else {
        return;
    }

    $("#tier" + tierNum + "_" + targetPos).html(tmp);
    tierList[tierNum].chars[targetPos] = sourceItem;
    printMessage("");

    for (i in tierList[tierNum].chars) {
        item = tierList[tierNum].chars[i];
        setTieredItemEvents(item, tierNum);
    }

    unsavedChanges = true;
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
    var tierList = getCurrentTierList(), pos, counter, tmp;

    if (!item || getTierNumOf(item) !== tierNum) {
        return;
    }

    printMessage("");
    const itemElement = document.getElementById(item);
    itemElement.classList.remove("tiered_" + settings.sort);
    itemElement.classList.add("list_" + settings.sort);
    $("#" + item).off("contextmenu dragenter dragover");

    if (isMobile()) {
        itemElement.addEventListener("contextmenu", preventContextMenu, false);
    }

    if (!noDisplay) {
        pos = getPositionOf(item);
        $("#" + item + "C").append($("#" + item));
        $("#" + getCategoryOf(item)).css("display", "block");

        if (tierNum !== false) {
            for (counter = pos + 1; counter < tierList[tierNum].chars.length; counter += 1) {
                tmp = getItemAt(tierNum, counter);
                $("#tier" + tierNum + "_" + counter).remove("#" + tmp);
                $("#tier" + tierNum + "_" + (counter - 1)).append($("#" + tmp));
            }

            const lastItemElement = document.getElementById(`tier${tierNum}_${tierList[tierNum].chars.length - 1}`);
            lastItemElement.parentNode.removeChild(lastItemElement);
        }
    }

    tierList[tierNum].chars.remove(item);
    tieredItems.remove(item);

    if (!multi && multiSelection.includes(item)) {
        itemElement.classList.remove("selected");
        multiSelection.remove(item);
    }

    unsavedChanges = true;
}

function changeToTier(item, tierNum, pos, multi) {
    removeFromTier(item, getTierNumOf(item), multi);

    if (isMobile()) {
        addToTierMobile({target: {id: `mobile_add_${item}_${tierNum}`}});
    } else {
        addToTier(item, tierNum, pos);
    }
}

function changeTierListName(event) {
    const tierListName = event.data.tierListName;
    settings.props[settings.sort].tierListName = tierListName.replace(/[^a-zA-Z0-9|!|?|,|.|+|-|*@$%^&() ]/g, "");
    document.getElementById("tier_list_caption").innerHTML = settings.props[settings.sort].tierListName;
    localStorage.setItem("settings", JSON.stringify(settings));
}

function validateTierName(tierName) {
    return tierName.length <= MAX_NAME_LENGTH;
}

function addTier(event) {
    const noDisplay = event.data.noDisplay;
    const tierList = getCurrentTierList();
    let tierName = event.data.tierName;
    let tierNum = 0;

    while (tierNum < Object.keys(tierList).length) {
        tierNum += 1;
    }

    if (tierNum >= MAX_NUMBER_OF_TIERS) {
        printMessage("<strong class='error'>Error: the number of tiers may not exceed " + MAX_NUMBER_OF_TIERS + ".</strong>");
        return;
    }

    tierName = tierName.strip().replace(/'/g, "");
    $(isMobile() ? "#tier_name_mobile" : "#tier_name").val(tierName);

    if (!tierName || tierName === "") {
        return;
    }

    if (!validateTierName(tierName)) {
        printMessage("<strong class='error'>Error: tier names may not exceed " + MAX_NAME_LENGTH +
        " characters.</strong>");
        return;
    }

    if (!noDisplay) {
        $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' class='tier'>" +
        "<th id='th" + tierNum + "' class='tier_header' draggable='true'>" + tierName +
        "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr><hr>");
        $("#tr" + tierNum).on("dragover dragenter", allowDrop);
        $("#tr" + tierNum).on("drop", drop);
        $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
        $("#th" + tierNum).on("dragstart", drag);
        $("#th" + tierNum).css("max-width", settings.props[settings.sort].tierHeaderWidth + "px");
        $("#th" + tierNum).css("width", settings.props[settings.sort].tierHeaderWidth + "px");
        $("#th" + tierNum).css("font-size", settings.props[settings.sort].tierHeaderFontSize + "px");
        $("#tier" + tierNum).css("background-color", settings.props[settings.sort].tierListColour);

        if (isMobile()) {
            $("#th" + tierNum).css("height", "60px");
            $("#th" + tierNum).on("contextmenu", preventContextMenu);
        } else {
            $("#th" + tierNum).on("contextmenu", {tierNum: tierNum}, detectRightCtrlCombo);
        }
    }

    tierList[tierNum] = {};
    tierList[tierNum].name = tierName;
    tierList[tierNum].bg = defaultBg;
    tierList[tierNum].colour = defaultColour;
    tierList[tierNum].chars = [];
    unsavedChanges = true;
}

function moveTierTo(sourceTierNum, targetTierNum) {
    var tierList = getCurrentTierList(), tmpHtml = $("#th" + sourceTierNum).html(), tmpChars = $("#tier" + sourceTierNum).html(),
        tmp = tierList[sourceTierNum], tierNum, prevTierNum, nextTierNum, item, i;

    if (sourceTierNum > targetTierNum) {
        for (tierNum = sourceTierNum; tierNum > targetTierNum; tierNum--) {
            prevTierNum = tierNum - 1;
            $("#th" + tierNum).css("color", tierList[prevTierNum].colour);
            $("#th" + tierNum).css("background-color", tierList[prevTierNum].bg);
            $("#th" + tierNum).html($("#th" + prevTierNum).html());
            $("#tier" + tierNum).html($("#tier" + prevTierNum).html().replace(new RegExp("tier" + prevTierNum + "_", "g"), "tier" + tierNum + "_"));
            tierList[tierNum] = tierList[prevTierNum];
        }
    } else { // sourceTierNum < targetTierNum
        for (tierNum = sourceTierNum; tierNum < targetTierNum; tierNum++) {
            nextTierNum = tierNum + 1;
            $("#th" + tierNum).css("color", tierList[nextTierNum].colour);
            $("#th" + tierNum).css("background-color", tierList[nextTierNum].bg);
            $("#th" + tierNum).html($("#th" + nextTierNum).html());
            $("#tier" + tierNum).html($("#tier" + nextTierNum).html().replace(new RegExp("tier" + nextTierNum + "_", "g"), "tier" + tierNum + "_"));
            tierList[tierNum] = tierList[nextTierNum];
        }
    }

    tierList[targetTierNum] = tmp;
    $("#th" + targetTierNum).css("color", tmp.colour);
    $("#th" + targetTierNum).css("background-color", tmp.bg);
    $("#th" + targetTierNum).html(tmpHtml);
    $("#tier" + targetTierNum).html(tmpChars);
    $("#tier" + targetTierNum).html($("#tier" + targetTierNum).html().replace(new RegExp("tier" + sourceTierNum + "_", "g"), "tier" + targetTierNum + "_"));
    printMessage("");

    for (tierNum in tierList) {
        for (i in tierList[tierNum].chars) {
            item = tierList[tierNum].chars[i];
            setTieredItemEvents(item, tierNum);
        }
    }

    unsavedChanges = true;
}

function removeCharacters(tierNum, noDisplay) {
    var tierList = getCurrentTierList();

    while (tierList[tierNum].chars.length > 0) {
        removeFromTier(tierList[tierNum].chars[tierList[tierNum].chars.length - 1], tierNum, false, noDisplay);
    }

    if (!noDisplay) {
        $("#tier" + tierNum).html(""); // temporary measure against sudden double digit spans
    }
}

function removeTierEvents(tierNum) {
    $("#tr" + tierNum).off("dragover dragenter");
    $("#tr" + tierNum).off("drop");
    $("#th" + tierNum).off("click");
    $("#th" + tierNum).off("contextmenu");
    $("#th" + tierNum).off("dragstart");
}

function setTierEvents(tierNum) {
    $("#tr" + tierNum).on("dragover dragenter", allowDrop);
    $("#tr" + tierNum).on("drop", drop);
    $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
    $("#th" + tierNum).on("dragstart", drag);

    if (isMobile()) {
        $("#th" + tierNum).on("contextmenu", preventContextMenu);
    } else {
        $("#th" + tierNum).on("contextmenu", {tierNum: tierNum}, detectRightCtrlCombo);
    }
}

function removeTierButton(event) {
    printMessage("<strong class='confirmation'>" + getCurrentTierList()[event.data.tierNum].name + " tier removed!</strong>");
    removeTier(event.data.tierNum);
    emptyModal();
}

function removeTier(tierNum, skipConfirmation, noDisplay) {
    const tierList = getCurrentTierList();
    let confirmation = true;

    if (tierList[tierNum].chars.length === 0) {
        skipConfirmation = true;
    }

    if (!skipConfirmation) {
        confirmation = confirm("Are you sure you want to remove this tier? This will return all characters in it to the picker.");
    }

    if (confirmation) {
        removeCharacters(Number(tierNum), noDisplay);

        for (const otherTierNum in tierList) {
            if (otherTierNum > tierNum) {
                removeTierEvents(otherTierNum - 1);
                $("#tr" + (otherTierNum - 1)).html($("#tr" + otherTierNum).html().replace("th" + otherTierNum, "th" + (otherTierNum - 1)).replace("tier" + otherTierNum, "tier" + (otherTierNum - 1)));
                $("#tier" + (otherTierNum - 1)).html($("#tier" + (otherTierNum - 1)).html().replace(new RegExp("tier" + otherTierNum + "_", "g"), "tier" + (otherTierNum - 1) + "_"));
                tierList[otherTierNum - 1] = tierList[otherTierNum];
                setTierEvents(otherTierNum - 1);

                for (const item of tierList[otherTierNum - 1].chars) {
                    setTieredItemEvents(item, otherTierNum - 1);
                }
            }
        }

        const lastTierNum = Object.keys(tierList).length - 1;
        delete tierList[lastTierNum];

        if (!noDisplay) {
            const lastTier = document.getElementById(`tr${lastTierNum}`);
            lastTier.parentNode.removeChild(lastTier);
        }
    }

    unsavedChanges = true;
    return false;
}

function emptyModal() {
    document.getElementById("modal").style.display = "none";
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
            for (const item of cats[categoryName].chars.length) {
                if (!isTiered(item)) {
                    addToTier(item, tierNum);
                }
            }
        }
    }
}

function saveSingleTierSettings(event) {
    emptyModal();
    const tierNum = event.data.tierNum;
    const tierName = document.getElementById("custom_name_tier").value.strip().replace(/'/g, "");
    const tierBg = document.getElementById("custom_bg_tier").value;
    const tierColour = document.getElementById("custom_colour_tier").value;

    if (!allowData()) {
        return;
    }

    if (!validateTierName(tierName)) {
        document.getElementById("settings_msg_container").innerHTML = `<strong class='error'>Error: tier names may not exceed ${MAX_NAME_LENGTH} characters.</strong>`;
        return;
    }

    const th = document.getElementById(`th${tierNum}`);
    th.innerHTML = tierName;
    th.style.backgroundColor = tierBg;
    th.style.color = tierColour;
    localStorage.setItem("settings", JSON.stringify(settings));
    saveTiersData();
    printMessage("<strong class='confirmation'>Tier settings saved!</strong>");
}

function tierMenu(tierNum) {
    const tierList = getCurrentTierList();
    emptyModal();
    document.getElementById("tier_menu_header").innerHTML = "Customise Tier " + tierList[tierNum].name;
    document.getElementById("custom_name_tier").value = tierList[tierNum].name;
    document.getElementById("custom_bg_tier").value = tierList[tierNum].bg;
    document.getElementById("custom_colour_tier").value = tierList[tierNum].colour;
    $("#save_tier_settings").off("click");
    $("#save_tier_settings").on("click", {tierNum: tierNum}, saveSingleTierSettings);
    $("#remove_tier").off("click");
    $("#remove_tier").on("click", {tierNum: tierNum}, removeTierButton);
    document.getElementById("tier_menu").style.display = "block";
    document.getElementById("modal").style.display = "block";

    for (const otherTierNum in tierList) {
        if (otherTierNum == tierNum) {
            continue;
        }

        $("#tier_dropdown").append("<option value='" + otherTierNum + "'>" + tierList[otherTierNum].name + "</option>");
    }
}

function detectLeftCtrlCombo(event) {
    const tierNum = event.data.tierNum;

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
    const tierNum = event.data.tierNum;

    if (event.ctrlKey) {
        emptyTier(tierNum);
    } else {
        removeTier(tierNum);
    }

    return false;
}

function storageUsed() {
    return localStorage.hasOwnProperty("settings") || localStorage.hasOwnProperty("tiers");
}

function allowData() {
    if (!storageUsed()) {
        return confirm("This will store data in your browser's local storage. Do you allow this?");
    } else {
        return true;
    }
}

function saveTiersData() {
    if (!allowData()) {
        return;
    }

    localStorage.setItem("tiers", JSON.stringify(tiers));
}

function saveTiersAndSettings() {
    saveSettingsData();
    saveTiersData();
    printMessage("<strong class='confirmation'>Tier list(s) and settings saved!</strong>");
}

function saveWithoutMenu() {
    localStorage.setItem("settings", JSON.stringify(settings));
    saveTiersData();
    printMessage("<strong class='confirmation'>Tier list(s) and settings saved!</strong>");
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
    var settingsArray = string.split(';');

    if (settingsArray.length == 3) {
        settings.props[sort].tierListName = settingsArray[0].replace(/[^a-zA-Z0-9|!|?|,|.|+|-|*@$%^&() ]/g, "");
        settings.props[sort].tierHeaderWidth = settingsArray[1];
        settings.props[sort].tierHeaderFontSize = settingsArray[2];
    } else {
        settings.props[sort].tierListName = settingsArray[0].replace(/[^a-zA-Z0-9|!|?|,|.|+|-|*@$%^&() ]/g, "");
        settings.props[sort].tierListColour = settingsArray[1];
        settings.props[sort].tierHeaderWidth = settingsArray[2];
        settings.props[sort].tierHeaderFontSize = settingsArray[3];
    }
}

function parseImport(text, tierList, sort, originalSort) {
    let alreadyAdded = [];
    let counter = -1;
    let noDisplay = (sort == originalSort ? false : true);
    let characters;

    try {
        clearTiers(tierList, sort, originalSort);

        for (let i = 0; i < text.length; i++) {
            if (i === 0 && sorts.includes(text[i])) {
                i += 1;
            }

            if (text[i].includes(';')) {
                parseSettings(text[i], sort);
                i += 1;
            }

            if (text[i].includes(':')) {
                addTier({data: {tierName: text[i].replace(':', ""), noDisplay: noDisplay}});
                counter += 1;
                i += 1;
            }

            if (text[i].charAt(0) == '#') {
                tierList[counter].bg = text[i].split(' ')[0];
                tierList[counter].colour = text[i].split(' ')[1];
                i += 1;
            }

            if (text[i] !== "") {
                characters = text[i].split(',');

                for (let item of characters) {
                    item = item.trim();

                    if (item == "Mai") {
                        item = "Mai PC-98";
                    }

                    try {
                        addToTier(item.removeSpaces(), counter, noDisplay);

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
        console.log(e);
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
    saveTiersData();
    localStorage.setItem("settings", JSON.stringify(settings));
    printMessage("<strong class='confirmation'>Tier list successfully imported!</strong>");
}

function importText() {
    emptyModal();
    printMessage("");
    document.getElementById("import_text").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function copyToClipboard(event) {
    emptyModal();
    navigator.clipboard.writeText(event.data.text.replace(/<\/p><p>/g, "\n").strip());
    printMessage("<strong class='confirmation'>Copied to clipboard!</strong>");
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
    ";" + settings.props[settings.sort].tierHeaderFontSize;

    for (const tierNum in tierList) {
        textFile += "\n" + tierList[tierNum].name + ":\n" + tierList[tierNum].bg +
        " " + tierList[tierNum].colour + "\n";
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
    $("#copy_to_clipboard").on("click", {text: textFile}, copyToClipboard);
    document.getElementById("export_text").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

/*function base64toBlob(dataURI) {
    var byteString = atob(dataURI.split(',')[1]), ab = new ArrayBuffer(byteString.length), ia = new Uint8Array(ab), i;

    for (i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    return new Blob([ab], {type: "image/png"});
}

function imageToClipboard(event) {
    try {
        navigator.clipboard.write([
            new ClipboardItem({
                "image/png": base64toBlob(event.data.blob)
            })
        ]);
    } catch (e) {
        emptyModal();
        alert("Your browser does not support image to clipboard functionality. On Firefox, go to about:config and set dom.events.asyncClipboard.clipboardItem to true.");
        return;
    }
    emptyModal();
    printMessage("<strong class='confirmation'>Copied to clipboard!</strong>");
}*/

function takeScreenshot() {
    emptyModal();

    try {
        const isTierView = tierView;

        if (!isMobile() && !isTierView) {
            toggleTierView();
        }

        printMessage("<strong class='confirmation'>Girls are being screenshotted, please watch warmly...</strong>");
        html2canvas(document.body, {
            "onclone": function (doc) {
                const wrap = doc.getElementById("wrap");
                const tierListContainer = doc.getElementById("tier_list_container");
                doc.getElementsByTagName("body")[0].style.backgroundImage = "none";
                wrap.style.width = "100%";
                wrap.style.height = "auto";
                wrap.style.maxHeight = "none";
                tierListContainer.style.width = "98%";
                tierListContainer.style.height = "auto";
                tierListContainer.style.maxHeight = "none";
                tierListContainer.style.marginLeft = "0px";
            },
            "windowHeight": $("#tier_list_tbody").height() + $("#tier_list_caption").height() + 15,
            "height": $("#tier_list_tbody").height() + $("#tier_list_caption").height() + 15,
            "logging": false,
            "scrollX": 0,
            "scrollY": 0
        }).then(function(canvas) {
            if (!isMobile() && !isTierView) {
                toggleTierView();
            }

            const base64image = canvas.toDataURL("image/png");
            const saveLink = document.getElementById("screenshot_link");
            saveLink.href = base64image;
            saveLink.download = fileName("png");
            document.getElementById("screenshot_base64").src = base64image;
            document.getElementById("screenshot").style.display = "block";
            document.getElementById("modal").style.display = "block";
            printMessage("");
            //$("#clipboard").on("click", {blob: base64image}, imageToClipboard);
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
    const windows = ["EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "TD", "DDC", "LoLK", "HSiFS", "WBaWC", "UM", "Spinoff"];

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
    if (!allowData()) {
        return;
    }

    const cats = categories[settings.sort];
    let checked = {};
    let toRemove = [];

    for (const categoryName in cats) {
        checked[categoryName] = document.getElementById(`checkbox_${categoryName}`).checked;
        settings.categories[settings.sort][categoryName].enabled = checked;

        if (!checked[categoryName]) {
            for (const item of cats[categoryName].chars.length) {
                if (isTiered(item)) {
                    toRemove.push(categoryName);
                }
            }
        }

        unsavedChanges = true;
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

    settings.props[settings.sort].tierListName = $("#tier_list_name_menu").val().replace(/[^a-zA-Z0-9|!|?|,|.|+|-|*@$%^&() ]/g, "");
    settings.props[settings.sort].tierListColour = $("#tier_list_colour").val();
    settings.props[settings.sort].tierHeaderWidth = $("#tier_header_width").val() > defaultWidth ? $("#tier_header_width").val() : defaultWidth;
    settings.props[settings.sort].tierHeaderFontSize = $("#tier_header_font_size").val() != defaultSize ? $("#tier_header_font_size").val() : defaultSize;
    $(".tier_header").css("width", settings.props[settings.sort].tierHeaderWidth + "px");
    $(".tier_header").css("max-width", settings.props[settings.sort].tierHeaderWidth + "px");
    $(".tier_header").css("font-size", settings.props[settings.sort].tierHeaderFontSize + "px");
    $(".tier_content").css("background-color", settings.props[settings.sort].tierListColour);
    $("#tier_list_caption").html(settings.props[settings.sort].tierListName);
    $("#modal_inner").html("");
    $("#modal_inner").css("display", "none");
    $("#modal").css("display", "none");
    localStorage.setItem("settings", JSON.stringify(settings));
}

function toggleTierView() {
    printMessage("");
    const wrap = document.getElementById("wrap");

    if (tierView) {
        document.getElementById("characters").style.display = "block";
        document.getElementById("toggle_picker").style.display = "inline";
        document.getElementById("toggle_view").value = "Tier List View";
        document.body.style.background = "url('assets/other/tiers/tiers.jpg') center no-repeat fixed";
        document.body.style.backgroundSize = "cover";
        wrap.style.width = (smallPicker ? "65%" : "45%");
        wrap.style.bottom =- "";
        wrap.style.left = "";
        wrap.style.border = "1px solid #000";
    } else {
        document.getElementById("characters").style.display = "none";
        document.getElementById("toggle_picker").style.display = "none";
        document.getElementById("toggle_view").value = "Normal View";
        document.body.style.background = defaultBg;
        document.body.style.backgroundSize = "default";
        wrap.style.width = "auto";
        wrap.style.bottom =- "5px";
        wrap.style.left = "5px";
        wrap.style.border = "none";
    }

    tierView = !tierView;
}

function togglePickerSize(event) {
    smallPicker = (event && event.data && event.data.load ? true : !smallPicker);
    document.getElementById("wrap").style.width = (smallPicker ? "65%" : "45%");
    document.getElementById("characters").style.width = ( smallPicker ? "31%" : "51%");
    document.getElementById("toggle_picker").value = (smallPicker ? "Large Picker" : "Small Picker");

    if (smallPicker) {
        settings.picker = "small";
    } else {
        delete settings.picker;
    }

    if (!event || !event.data || !event.data.load) {
        saveWithoutMenu();
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
    initialise();
    printMessage("<strong class='confirmation'>Reset the tier list and settings to their default states!</strong>");
    unsavedChanges = false;
}

function modalEraseAll() {
    eraseAllConfirmed();
    emptyModal();
}

function modalEraseSingle() {
    clearTiers(getCurrentTierList(), settings.sort, settings.sort);

    for (const tierName of DEFAULT_TIER_NAMES) {
        addTier({data: {tierName: tierName}});
    }

    settings.props[settings.sort].tierListName = "";
    settings.props[settings.sort].tierListColour = defaultBg;
    settings.props[settings.sort].tierHeaderWidth = defaultWidth;
    settings.props[settings.sort].tierHeaderFontSize = defaultSize;
    document.getElementById("tier_list_caption").innerHTML = "";
    $(".tier_content").css("background-color", defaultBg);
    $(".tier_header").css("max-width", defaultWidth + "px");
    $(".tier_header").css("font-size", defaultSize + "px");
    $(".tier_header").css("width", defaultWidth + "px");
    localStorage.setItem("settings", JSON.stringify(settings));
    unsavedChanges = false;
    saveTiersData();
    printMessage("<strong class='confirmation'>Reset the current tier list and its settings to their default states!</strong>");
    emptyModal();
}

function eraseAll() {
    emptyModal();
    document.getElementById("reset").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function drag(event) {
    event.dataTransfer = event.originalEvent.dataTransfer;
    event.dataTransfer.setData("text/plain", event.target.id);
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
    var tierNum = Number(event.target.id.replace("th", "").replace("tier", "").replace(/_\d+/, ""));

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

    if (event.target.id.substring(0, 2) === "th" || event.target.id.substring(0, 4) === "tier") {
        dropOntoTier(event);
    } else if (isTiered(event.target.id) && following.substring(0, 2) != "th") {
        itemOntoTieredItem(event);
    } else if ((isItem(event.target.id) || isCategory(event.target.id) || event.target.id === "characters") && isTiered(following)) {
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

function loadTier(tiersData, tierNum, tierSort) {
    tiers[tierSort][tierNum] = {};
    tiers[tierSort][tierNum].name = tiersData.name;
    tiers[tierSort][tierNum].bg = tiersData.bg;
    tiers[tierSort][tierNum].colour = tiersData.colour;
    tiers[tierSort][tierNum].chars = [];

    if (tierSort == settings.sort) {
        $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' class='tier'><th id='th" + tierNum +
        "' class='tier_header' draggable='true'>" + tiersData.name + "</th><td id='tier" + tierNum +
        "' class='tier_content'></td></tr>");
        $("#tr" + tierNum).on("dragover dragenter", allowDrop);
        $("#tr" + tierNum).on("drop", drop);
        $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
        $("#th" + tierNum).on("dragstart", drag);
        $("#th" + tierNum).css("background-color", tiers[tierSort][tierNum].bg);
        $("#th" + tierNum).css("color", tiers[tierSort][tierNum].colour);
        $("#th" + tierNum).css("max-width", settings.props[tierSort].tierHeaderWidth + "px");
        $("#th" + tierNum).css("width", settings.props[tierSort].tierHeaderWidth + "px");
        $("#th" + tierNum).css("font-size", settings.props[tierSort].tierHeaderFontSize + "px");

        if (isMobile()) {
            $("#th" + tierNum).css("height", "60px");
            $("#th" + tierNum).on("contextmenu", preventContextMenu);
        } else {
            $("#th" + tierNum).on("contextmenu", {tierNum: tierNum}, detectRightCtrlCombo);
        }
    }

    for (let item of tiersData.chars) {
        if (item == "Mai") {
            item = "Mai PC-98";
        }

        if (isMobile()) {
            $("#" + item).off("click");
        }

        if (tierSort == settings.sort) {
            addToTier(item, tierNum);
        } else {
            tiers[tierSort][tierNum].chars.pushStrict(item);
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
    } else {
        for (const categoryName in cats) {
            for (const item of cats[categoryName].chars) {
                setPickerItemEvents(item);
                document.getElementById(item).title = addSpacing(item);
            }
        }
    }

    for (const categoryName in cats) {
        if (!settings.categories[settings.sort][categoryName].enabled) {
            document.getElementById(categoryName).style.display = "none";
        }

        toggleMale();
        toggleThemes();
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
        }

        if (settingsData.picker && settingsData.picker == "small") {
            togglePickerSize({data: {load: true}});
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
            togglePickerSize({data: {load: true}});
        }

        for (const sort of sorts) {
            settings.categories[sort] = settingsData.categories.hasOwnProperty(sort) ? settingsData.categories[sort] : DEFAULT_SETTINGS.categories[sort];

            if (settingsData.props.hasOwnProperty(sort)) {
                settings.props[sort].tierListName = (settingsData.props[sort].tierListName ? settingsData.props[sort].tierListName : "");
                settings.props[sort].tierListColour = (settingsData.props[sort].tierListColour ? settingsData.props[sort].tierListColour : defaultBg);
                settings.props[sort].tierHeaderWidth = (settingsData.props[sort].tierHeaderWidth ? settingsData.props[sort].tierHeaderWidth : defaultWidth);
                settings.props[sort].tierHeaderFontSize = (settingsData.props[sort].tierHeaderFontSize ? settingsData.props[sort].tierHeaderFontSize : defaultSize);
            } else {
                settings.props[sort] = DEFAULT_PROPS;
            }
        }
    }
}

function setAddTierListeners() {
    $("#add_tier, #add_tier_mobile, #add_tier_list_name").off("click");
    $("#add_tier").on("click", {tierName: $("#tier_name").val()}, addTier);
    $("#add_tier_mobile").on("click", {tierName: $("#tier_name_mobile").val()}, addTier);
    $("#add_tier_list_name").on("click", {tierListName: $("#tier_list_name").val()}, changeTierListName);
}

function detectTierListNameEnter(event) {
    if (event.key && event.key == "Enter") {
        changeTierListName({data: {tierListName: $("#tier_list_name").val()}});
    } else {
        setAddTierListeners();
    }
}

function detectAddTierEnter(event) {
    if (event.key && event.key == "Enter") {
        addTier({data: {tierName: $(isMobile() ? "#tier_name_mobile" : "#tier_name").val()}});
    } else {
        setAddTierListeners();
    }
}

function detectSettingsEnter(event) {
    if (event.key && event.key == "Enter") {
        saveTiersAndSettings();
    }
}

function detectTiersEnter(event) {
    if (event.key && event.key == "Enter") {
        saveSingleTierSettings(event);
    }
}

function setEventListeners() {
    setAddTierListeners();
    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", detectKey, false);
    document.getElementById("sort").addEventListener("change", switchSort, false);
    document.getElementById("toggle_view").addEventListener("click", toggleTierView, false);
    document.getElementById("toggle_picker").addEventListener("click", togglePickerSize, false);
    document.getElementById("info_button").addEventListener("click", showInformation, false);
    document.getElementById("tier_name").addEventListener("keyup", detectAddTierEnter, false);
    document.getElementById("tier_name_mobile").addEventListener("keyup", detectAddTierEnter, false);
    document.getElementById("tier_list_name").addEventListener("keyup", detectTierListNameEnter, false);
    document.getElementById("save_button").addEventListener("click", saveWithoutMenu, false);
    document.getElementById("import_button").addEventListener("click", importText, false);
    document.getElementById("export_button").addEventListener("click", exportText, false);
    document.getElementById("screenshot_button").addEventListener("click", takeScreenshot, false);
    document.getElementById("settings_button").addEventListener("click", settingsMenu, false);
    document.getElementById("changelog_button").addEventListener("click", changeLog, false);
    document.getElementById("reset_button").addEventListener("click", eraseAll, false);
    document.getElementById("information_button").addEventListener("click", showInformation, false);
    document.getElementById("save_button_mobile").addEventListener("click", saveWithoutMenu, false);
    document.getElementById("menu_button").addEventListener("click", menuMobile, false);
    document.getElementById("switch_button").addEventListener("click", switchSort, false);
    document.getElementById("characters").addEventListener("dragover", allowDrop, false);
    document.getElementById("characters").addEventListener("dragenter", allowDrop, false);
    document.getElementById("characters").addEventListener("drop", drop, false);
    document.getElementById("pc98").addEventListener("click", togglePC98, false);
    document.getElementById("windows").addEventListener("click", toggleWindows, false);
    document.getElementById("save_settings").addEventListener("click", saveTiersAndSettings, false);
    $(".settings_input").on("keyup", detectSettingsEnter, false);
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
    window.onbeforeunload = function () {
        if (unsavedChanges) {
            return "";
        }

        return undefined;
    }
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
    document.getElementById("sort").value = settings.sort;
    loadItems(true);

    if (!localStorage.tiers && !localStorage.gameTiers && !localStorage.shotTiers) {
        showInformation();
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
        if (errorElement && errorElement.length) {
            printMessage(errorElement.value);
            errorElement.parentNode.removeChild(errorElement);
        }

        for (const element of tierContent) {
            element.style.backgroundColor = settings.props[settings.sort].tierListColour;
        }
    }

    setEventListeners();
    unsavedChanges = false;
}

window.addEventListener("DOMContentLoaded", init, false);
