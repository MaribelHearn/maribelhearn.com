var MAX_NAME_LENGTH = 30,
    categories = {},
    gameCategories = {},
    tieredItems = [],
    defaultWidth = (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) ? 60 : 120,
    defaultSize = 32,
    settings = {
        "categories": {
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true },
            "LLS": { enabled: true }, "MS": { enabled: true }, "EoSD": { enabled: true }, "PCB": { enabled: true },
            "IaMP": { enabled: true }, "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true },
            "SWR": { enabled: true }, "SA": { enabled: true }, "UFO": { enabled: true }, "Soku": { enabled: true },
            "DS": { enabled: true }, "GFW": { enabled: true }, "TD": { enabled: true }, "HM": { enabled: true },
            "DDC": { enabled: true }, "ULiL": { enabled: true }, "LoLK": { enabled: true }, "AoCF": { enabled: true },
            "HSiFS": { enabled: true }, "WBaWC": { enabled: true }, "Manga": { enabled: true }, "CD": { enabled: true }
        },
        "gameCategories": {
            "PC-98": { enabled: true }, "Classic": { enabled: true }, "Modern1": { enabled: true }, "Modern2": { enabled: true },
            "Mangas": { enabled: true }, "Books": { enabled: true }, "CDs": { enabled: true }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierListName": "",
        "tierHeaderWidth": defaultWidth,
        "tierHeaderFontSize": defaultSize,
        "artist": "Dairi",
        "sort": "characters"
    },
    windows = ["EoSD", "PCB", "IaMP", "IN", "PoFV", "MoF", "SWR", "SA", "UFO", "Soku",
    "DS", "GFW", "TD", "HM", "DDC", "ULiL", "LoLK", "AoCF", "HSiFS", "WBaWC"],
    maleCharacters = ["SinGyokuM", "Genjii", "Unzan", "RinnosukeMorichika", "FortuneTeller"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"],
    tiers = {},
    gameTiers = {},
    order = [],
    gameOrder = [],
    multiSelection = [],
    maxTiers = 20,
    following = "",
    tierView = false,
    swapOngoing = -1;

function isMobile() {
    return navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1;
}

function isCharacter(character) {
    return character !== "" && JSON.stringify(categories).removeSpaces().contains(character);
}

function isItem(item) {
    var cats = (settings.sort == "characters" ? categories : gameCategories);
    return item !== "" && JSON.stringify(cats).removeSpaces().contains(item);
}

function isCategory(category) {
    return category !== "" && (Object.keys(categories).contains(category) || Object.keys(gameCategories).contains(category));
}

function isTiered(item) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    if (!item) {
        return false;
    }

    return item !== "" && $("#" + item).hasClass("tiered");
}

function allTiered(categoryName) {
    var cats = (settings.sort == "characters" ? categories : gameCategories);

    for (var i = 0; i < cats[categoryName].chars.length; i += 1) {
        if (!isTiered(cats[categoryName].chars[i].removeSpaces())) {
            return false;
        }
    }

    return true;
}

function getTierNumOf(item) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), tierNum, i;

    for (tierNum in tierList) {
        for (i = 0; i < tierList[tierNum].chars.length; i += 1) {
            if (tierList[tierNum].chars[i] == item) {
                return Number(tierNum);
            }
        }
    }

    return false;
}

function getPositionOf(item) {
    return Number($("#" + item).parent().attr("id").split("_")[1]);
}

function getItemAt(tierNum, pos) {
    return tiers[tierNum].chars[pos];
}

function getCategoryOf(item) {
    var cats = (settings.sort == "characters" ? categories : gameCategories), categoryName;

    for (categoryName in cats) {
        if (JSON.stringify(cats[categoryName].chars).removeSpaces().contains(item)) {
            return categoryName;
        }
    }

    return false;
}

function reloadTiers() {
    var cats = (settings.sort == "characters" ? categories : gameCategories),
        tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder),
        i, item, id, j;

    for (i = 0; i < Object.keys(tiers).length; i += 1) {
        $("#tier" + i).html("");
    }

    if (tierList.isEmpty()) {
        return;
    }

    $("#tier_list_caption").html(settings.tierListName);

    for (tierNum in tierList) {
        tierNum = Number(tierNum);

        if (!tierList[tierNum].flag) {
            $("#tier_list_tbody").append("<tr id='tr" + tierNum +
            "' class='tier'><th id='th" + tierNum +
            "' class='tier_header'>" + tierList[tierNum].name + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");
            $("#tr" + tierNum).on("dragover", allowDrop);
            $("#tr" + tierNum).on("drop", drop);
            $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
            $("#th" + tierNum).on("contextmenu", {tierNum: tierNum}, detectRightCtrlCombo);
            $("#th" + tierNum).css("background-color", tierList[tierNum].bg);
            $("#th" + tierNum).css("color", tierList[tierNum].colour);
            $("#th" + tierNum).css("max-width", settings.tierHeaderWidth + "px");
            $("#th" + tierNum).css("width", settings.tierHeaderWidth + "px");

            if (isMobile()) {
                $("#th" + tierNum).css("height", "60px");
            }

            for (i = 0; i < tierList[tierNum].chars.length; i += 1) {
                item = tierList[tierNum].chars[i];

                if (item == "Mai") {
                    item = "Mai PC-98";
                }

                if (isMobile()) {
                    $("#" + item).off("click");
                }

                $("#" + item).on("contextmenu", {tierNum: tierNum}, tieredContextMenu);
                $("#" + item).removeClass("list");
                $("#" + item).addClass("tiered");
                id = "tier" + tierNum + "_" + i;
                $("#tier" + tierNum).append("<span id='" + id + "'></span>");
                $("#" + id).html($("#" + item));

                for (j in cats) {
                    if (!$("#" + j).html().contains("list")) {
                        $("#" + j).css("display", "none");
                    }
                }
            }
        }
    }
}

function initialise() {
    var tmp;

    addTier({data: {tierName: "S"}});
    addTier({data: {tierName: "A"}});
    tmp = settings.sort;
    settings.sort = (settings.sort == "characters" ? "works" : "characters");
    addTier({data: {tierName: "S", noDisplay: true}});
    addTier({data: {tierName: "A", noDisplay: true}});
    settings.sort = tmp;
    $(isMobile() ? "#tier_name_mobile" : "#tier_name").val("B");
    $("#tier_list_caption").html(settings.tierListName);

    if (isMobile()) {
        $("#add_tier_cell_mobile").attr("colspan", 2);
    }
}

function switchSort() {
    cancelOngoingSwap();
    $("#characters").html("");
    $("#tier_list_tbody").html("");
    settings.sort = (settings.sort == "characters" ? "works" : "characters");
    loadItems();
    reloadTiers();
    saveSettingsPre();
    $("#msg_container").html("<strong class='confirmation'>Switched to " + settings.sort + "!</strong>");
}

function tieredContextMenu(event) {
    var character = this.id, name = this.title, tierNum = event.data.tierNum;

    if (isMobile()) {
        modalChar(character, name, tierNum);
    } else {
        removeFromTier(character, tierNum);
    }

    return false;
}

function insertAt(character, tierNum, pos, chars) {
    var counter, id, next;

    $("#tier" + tierNum + "_" + (pos)).append($("#" + character));

    for (counter = chars.length - 1; counter >= pos; counter -= 1) {
        id = getItemAt(tierNum, counter);
        next = "tier" + tierNum + "_" + (counter + 1);
        $("#" + next).append($("#" + id));
        chars[counter + 1] = id;
    }

    chars[pos] = character;
}

function addToTier(character, tierNum, pos, noDisplay) {
    var cats = (settings.sort == "characters" ? categories : gameCategories),
        tierList = (settings.sort == "characters" ? tiers : gameTiers), categoryName = getCategoryOf(character);

    if (isTiered(character)) {
        return;
    }

    $("#msg_container").html("");
    $("#" + character).removeClass("outline");
    $("#" + character).removeClass("list");
    $("#" + character).addClass("tiered");
    $("#" + character).off("click");
    $("#" + character).on("contextmenu", {tierNum: tierNum}, tieredContextMenu);
    id = "tier" + tierNum + "_" + tierList[tierNum].chars.length;
    $("#tier" + tierNum).append("<span id='" + id + "'></span>");
    tieredItems.push(character);

    if (typeof pos == "number" && pos < tierList[tierNum].chars.length - 1 && !noDisplay) {
        insertAt(character, tierNum, pos, tierList[tierNum].chars);
    } else {
        if (!noDisplay) {
            $("#" + id).append($("#" + character));
        }

        tierList[tierNum].chars.pushStrict(character);
    }

    window.onbeforeunload = function () {
        return confirm();
    };

    for (i = 0; i < cats[categoryName].chars.length; i++) {
        if (!isTiered(cats[categoryName].chars[i])) {
            return;
        }
    }

    $("#" + categoryName).css("display", "none");
}

function addMultiSelection(tierNum) {
    var i;

    if (multiSelection.contains(following)) {
        for (i = 0; i < multiSelection.length; i++) {
            addToTier(multiSelection[i], tierNum);
        }
    } else {
        for (i = 0; i < multiSelection.length; i++) {
            $("#" + multiSelection[i]).removeClass("outline");
        }

        multiSelection = [];
        addToTier(following, tierNum);
    }
}

function toggleMulti() {
    if (multiSelection.contains(this.id)) {
        multiSelection.remove(this.id);
        $("#" + this.id).removeClass("outline");
        return;
    }

    multiSelection.push(this.id);
    $("#" + this.id).addClass("outline");
}

function multiSelectionToText() {
    var result = [], i;

    for (i = 0; i < multiSelection.length; i++) {
        result.push($("#" + multiSelection[i]).attr("title"));
    }

    return result.join(", ");
}

function addToTierMobile(event) {
    var character = event.data.character, tierNum = event.data.tierNum,
        tierList = (settings.sort == "characters" ? tiers : gameTiers), chars, char;

    $("#" + char).off("click");

    if (typeof character == "object") { // multiselection
        following = character[0];
        chars = multiSelectionToText();
        addMultiSelection(tierNum);
        $("#msg_container").html("<strong class='confirmation'>Added " + chars + " to " + tierList[tierNum].name + "!</strong>");
        emptyModal();
        return;
    }

    char = character.removeSpaces();

    if (isTiered(char)) {
        changeToTier(char, tierNum);
        $("#msg_container").html("<strong class='confirmation'>Changed " + character + " to " + tierList[tierNum].name + "!</strong>");
    } else {
        addToTier(char, tierNum);
        $("#msg_container").html("<strong class='confirmation'>Added " + character + " to " + tierList[tierNum].name + "!</strong>");
    }

    emptyModal();
}

function addMenu(event) {
    var character = event.data.name, tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder), tierNum, i;

    emptyModal();

    if (typeof character == "object") { // multiselection
        $("#modal_inner").html("<h3>" + multiSelectionToText() + "</h3><p>Add to tier:</p>");
    } else {
        $("#modal_inner").html("<h3>" + character +
        "</h3><p>" + (isTiered(character.removeSpaces()) ? "Change" : "Add") + " to tier:</p>");
    }

    for (i = 0; i < tierOrder.length; i += 1) {
        tierNum = tierOrder[i];

        if (!tierList[tierNum].flag) {
            $("#modal_inner").append("<input id='mobile_addtotier_" + i +
            "' class='mobile_add' type='button' value='" + tierList[tierNum].name + "'>");
            $("#mobile_addtotier_" + i).on("click", {character: character, tierNum: tierNum}, addToTierMobile);
        }
    }
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function moveToBack(character, tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), help = $("#" + character);

    if (getPositionOf(character) === tiers[tierNum].chars.length - 1) {
        return;
    }

    removeFromTier(character, tierNum);
    addToTier(character, tierNum);
    $("#msg_container").html("");

    window.onbeforeunload = function () {
        return confirm();
    }
}

function removeFromTier(character, tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), pos, counter, tmp;

    if (character === "") {
        return;
    }

    $("#msg_container").html("");
    $("#" + character).removeClass("tiered");
    $("#" + character).addClass("list");
    $("#" + character).off("contextmenu");
    $("#" + character).on("click", toggleMulti);

    if (isMobile()) {
        $("#" + character).on("click", {name: $("#" + character).attr("title")}, addMenu);
    }

    pos = getPositionOf(character);
    $("#" + character + "C").append($("#" + character));
    $("#" + getCategoryOf(character)).css("display", "block");

    if (tierNum !== false) {
        for (counter = pos + 1; counter < tierList[tierNum].chars.length; counter += 1) {
            tmp = getItemAt(tierNum, counter);
            $("#tier" + tierNum + "_" + counter).remove("#" + tmp);
            $("#tier" + tierNum + "_" + (counter - 1)).append($("#" + tmp));
        }

        $("#tier" + tierNum + "_" + (tierList[tierNum].chars.length - 1)).remove();
        tierList[tierNum].chars.remove(character);
        tieredItems.remove(character);
    }

    if (isMobile()) {
        $("#msg_container").html("<strong class='confirmation'>Removed " + $("#" + character).attr("title") +
        " from " + tierList[tierNum].name + "!</strong>");
    }

    window.onbeforeunload = function () {
        return confirm();
    }
}

function changeToTier(character, tierNum) {
    var oldTierNum = getTierNumOf(character), help, id;

    if (oldTierNum === tierNum) {
        moveToBack(character, tierNum);
    } else {
        removeFromTier(character, oldTierNum);

        if (isMobile()) {
            addToTierMobile({data: {character: character, tierNum: tierNum}});
        } else {
            addToTier(character, tierNum);
        }
    }
}

function modalRemove(event) {
    removeFromTier(event.data.character, event.data.tierNum);
    emptyModal();
}

function modalUp(event) {
    var above = event.data.tierOrder[event.data.tierOrder.indexOf(event.data.tierNum) - 1];

    changeToTier(event.data.character, above);
    emptyModal();
}

function modalDown(event) {
    var below = event.data.tierOrder[event.data.tierOrder.indexOf(event.data.tierNum) + 1];

    changeToTier(event.data.character, below);
    emptyModal();
}

function modalBack(event) {
    moveToBack(event.data.character, event.data.tierNum);
    emptyModal();
}

function modalChar(character, name, tierNum) {
    var tierOrder = (settings.sort == "characters" ? order : gameOrder), above, below;

    emptyModal();
    $("#modal_inner").html("<h3>" + name + "</h3><input id='remove_button' class='mobile_button' type='button' value='Remove'>");
    $("#remove_button").on("click", {character: character, tierNum: tierNum}, modalRemove);

    if (tierOrder.indexOf(tierNum) !== 0) {
        $("#modal_inner").append("<input id='up_button' class='mobile_button' type='button' value='Move Up'>");
        $("#up_button").on("click", {character: character, tierNum: tierNum, tierOrder: tierOrder}, modalUp);
    }

    if (tierOrder.indexOf(tierNum) != order.length - 1) {
        $("#modal_inner").append("<input id='down_button' class='mobile_button' type='button' value='Move Down'>");
        $("#down_button").on("click", {character: character, tierNum: tierNum, tierOrder: tierOrder}, modalDown);
    }

    $("#modal_inner").append("<input id='back_button' class='mobile_button' type='button' value='Move to Back'>");
    $("#back_button").on("click", {character: character, tierNum: tierNum}, modalBack);
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function validateTierName(tierName) {
    return tierName.length <= MAX_NAME_LENGTH;
}

function addTier(event) {
    var tierName = event.data.tierName, noDisplay = event.data.noDisplay,
        tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder),
        tierNum = 0, otherTierNum;

    $("#msg_container").html("");

    while (tierList[tierNum] && !tierList[tierNum].flag) {
        tierNum += 1;
    }

    if (tierNum >= maxTiers) {
        $("#msg_container").html("<strong class='error'>Error: the number of tiers may not exceed " + maxTiers + ".</strong>");
        return;
    }

    tierName = tierName.strip().replace(/'/g, "");
    $(isMobile() ? "#tier_name_mobile" : "#tier_name").val(tierName);

    if (!tierName || tierName === "") {
        return;
    }

    if (!validateTierName(tierName)) {
        $("#msg_container").html("<strong class='error'>Error: tier names may not exceed " + MAX_NAME_LENGTH +
        " characters.</strong>");
        return;
    }

    if (!noDisplay) {
        $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' class='tier'>" +
        "<th id='th" + tierNum + "' class='tier_header'>" + tierName +
        "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr><hr>");
        $("#tr" + tierNum).on("dragover", allowDrop);
        $("#tr" + tierNum).on("drop", drop);
        $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
        $("#th" + tierNum).on("contextmenu", {tierNum: tierNum}, detectRightCtrlCombo);
        $("#th" + tierNum).css("max-width", settings.tierHeaderWidth + "px");
        $("#th" + tierNum).css("width", settings.tierHeaderWidth + "px");
        $("#th" + tierNum).css("font-size", settings.tierHeaderFontSize + "px");

        if (isMobile()) {
            $("#th" + tierNum).css("height", "60px");
        }
    }

    tierList[tierNum] = {};
    tierList[tierNum].name = tierName;
    tierList[tierNum].bg = "#1b232e";
    tierList[tierNum].colour = "#a0a0a0";
    tierList[tierNum].chars = [];
    tierList[tierNum].flag = false;
    tierOrder.push(tierNum);

    if (swapOngoing >= 0) {
        $("#th" + tierNum).off("click");
        $("#th" + tierNum).on("click", {tier1: swapOngoing, tier2: tierNum}, swapTiers);
    }

    window.onbeforeunload = function () {
        return confirm();
    }
}

function startTierSwap(tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierName = $("#th" + tierNum).html();

    var invertedColour = new RGBColor(tierList[tierNum].colour),
        invertedBg = new RGBColor(tierList[tierNum].bg), otherTierNum;

    $("#th" + tierNum).css("color", "rgb(" + (255 - invertedColour.r) +
    ", " + (255 - invertedColour.g) + ", " + (255 - invertedColour.b) + ")");
    $("#th" + tierNum).css("background-color", "rgb(" + (255 - invertedBg.r) +
    ", " + (255 - invertedBg.g) + ", " + (255 - invertedBg.b) + ")");
    swapOngoing = tierNum;

    for (otherTierNum in tierList) {
        $("#th" + otherTierNum).off("click");
        $("#th" + otherTierNum).on("click", {tier1: tierNum, tier2: otherTierNum}, swapTiers);
    }
}

function swapTiers(event) {
    var tierNum1 = event.data.tier1, tierNum2 = event.data.tier2,
        tierList = (settings.sort == "characters" ? tiers : gameTiers);

    var tmp = tierList[tierNum1], tierNum, item, i;

    $("#th" + tierNum1).css("color", tierList[tierNum2].colour);
    $("#th" + tierNum1).css("background-color", tierList[tierNum2].bg);
    $("#th" + tierNum2).css("color", tierList[tierNum1].colour);
    $("#th" + tierNum2).css("background-color", tierList[tierNum1].bg);
    tierList[tierNum1] = tierList[tierNum2];
    tierList[tierNum2] = tmp;
    tmp = $("#th" + tierNum1).html();
    $("#th" + tierNum1).html($("#th" + tierNum2).html());
    $("#th" + tierNum2).html(tmp);
    tmp = $("#tier" + tierNum1).html();
    $("#tier" + tierNum1).html($("#tier" + tierNum2).html().replace("tier" + tierNum2 + "_", "tier" + tierNum1 + "_"));
    $("#tier" + tierNum2).html(tmp.replace("tier" + tierNum1 + "_", "tier" + tierNum2 + "_"));
    swapOngoing = -1;

    for (tierNum in tierList) {
        $("#th" + tierNum).off("click");
        $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);

        for (i in tierList[tierNum].chars) {
            item = tierList[tierNum].chars[i];
            $("#" + item).on("contextmenu", {tierNum: tierNum}, tieredContextMenu);

            if (isMobile()) {
                $("#" + item).on("click", {name: $("#" + item).attr("title")}, addMenu);
            } else {
                $("#" + item).on("dblclick", {name: $("#" + item).attr("title")}, addMenu);
                $("#" + item).on("dragstart", drag);
            }
        }
    }

    window.onbeforeunload = function () {
        return confirm();
    }
}

function removeCharacters(tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    while (tierList[tierNum].chars.length > 0) {
        removeFromTier(tierList[tierNum].chars[tierList[tierNum].chars.length - 1], tierNum);
    }

    $("#tier" + tierNum).html(""); // temporary measure against sudden double digit spans
}

function cancelOngoingSwap() {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), tierNum;

    if (swapOngoing >= 0) {
        for (tierNum in tierList) {
            $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
        }
        swapOngoing = -1;
    }
}

function removeTier(tierNum, skipConfirmation) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder);
    var length = tierList[tierNum].chars.length, confirmation = true, otherTierNum, i;

    if (isMobile()) {
        skipConfirmation = true;
    }

    if (!skipConfirmation) {
        confirmation = confirm("Are you sure you want to remove this tier? This will return all characters in it to the picker.");
    }

    if (confirmation) {
        removeCharacters(tierNum);
        cancelOngoingSwap();
        $("#tr" + tierNum).remove();
        tierList[tierNum].flag = true;
        tierOrder.remove(tierNum);
    }

    window.onbeforeunload = function () {
        return confirm();
    }

    return false;
}

function swapItems(item1, item2) {
    if (item1 == item2) {
        return;
    }

    var tierNum1 = getTierNumOf(item1), tierNum2 = getTierNumOf(item2),
        pos1 = getPositionOf(item1), pos2 = getPositionOf(item2), tmp;

    $("#tier" + tierNum1 + "_" + pos1).remove("#" + item1);
    $("#tier" + tierNum2 + "_" + pos2).remove("#" + item2);
    $("#tier" + tierNum1 + "_" + pos1).append($("#" + item2));
    $("#tier" + tierNum2 + "_" + pos2).append($("#" + item1));
    tiers[tierNum1].chars[pos1] = item2;
    tiers[tierNum2].chars[pos2] = item1;

    window.onbeforeunload = function () {
        return confirm();
    }
}

function emptyModal() {
    $("#modal_inner").html("");
    $("#modal_inner").css("display", "none");
    $("#modal").css("display", "none");

    if (isMobile()) {
        $(".menu").off("click");
    }
}

function closeModal(event) {
    var modal = document.getElementById("modal");

    if (event.target && event.target == modal) {
        emptyModal();
    }
}

function detectKey(event) {
    if (event.key && event.key == "Enter" && multiSelection.length > 0) {
        addMenu({ data: { name: multiSelection } });
    } else if (event.key && event.key == "Escape") {
        emptyModal();
    }
}

function quickAdd(tierNum) {
    var cats = (settings.sort == "characters" ? categories : gameCategories), categoryName, character, i;

    for (categoryName in cats) {
        if (settings.sort == "characters" && settings.categories[categoryName].enabled || settings.sort == "works" && settings.gameCategories[categoryName].enabled) {
            for (i = 0; i < cats[categoryName].chars.length; i += 1) {
                character = cats[categoryName].chars[i].removeSpaces();

                if (!isTiered(character)) {
                    addToTier(character, tierNum);
                }
            }
        }
    }
}

function detectLeftCtrlCombo(event) {
    var tierNum = event.data.tierNum;

    if (event.ctrlKey) {
        quickAdd(tierNum);
    } else {
        startTierSwap(tierNum);
    }
}

function emptyTier(tierNum) {
    var confirmation;

    if (isMobile()) {
        removeCharacters(tierNum);
    }

    confirmation = confirm("Are you sure you want to empty this tier? This will return all characters in it to the picker.");

    if (confirmation) {
        removeCharacters(tierNum);
    }
}

function modalRemoveTier(event) {
     removeTier(event.data.tierNum);
     emptyModal();
}

function modalQuickadd(event) {
     quickAdd(tierNum);
     emptyModal();
}

function modalRemoveAll(event) {
    emptyTier(tierNum);
    emptyModal();
}

function modalTier(tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    emptyModal();
    $("#modal_inner").html("<h3>" + tierList[tierNum].name + "</h3>");
    $("#modal_inner").append("<p><input id='remove_tier_button' type='button' class='tier_button' value='Remove'></p>");
    $("#remove_tier_button").on("click", {tierNum: tierNum}, modalRemoveTier);
    $("#modal_inner").append("<p><input id='quickadd_button' type='button' class='tier_button' value='Add All Characters'></p>");
    $("#quickadd_button").on("click", {tierNum: tierNum}, modalQuickadd);
    $("#modal_inner").append("<p><input id='removeall_button' type='button' class='tier_button' value='Remove All Characters'></p>");
    $("#removeall_button").on("click", {tierNum: tierNum}, modalRemoveAll);
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function detectRightCtrlCombo(event, tierNum) {
    var tierNum = event.data.tierNum;

    if (event.ctrlKey) {
        emptyTier(tierNum);
    } else {
        if (isMobile()) {
            modalTier(tierNum);
        } else {
            removeTier(tierNum);
        }
    }

    return false;
}

function toggleInstructions() {
    $("#instructions").css("display", $("#instructions").css("display") == "none" ? "block" : "none");
    $("#toggle_instructions").attr("value", ($("#instructions").css("display") == "none" ? "Show" : "Hide") + " Instructions");
}

function storageUsed() {
    return localStorage.hasOwnProperty("settings") || localStorage.hasOwnProperty("tiers") || localStorage.hasOwnProperty("gameTiers");
}

function allowData() {
    if (!storageUsed()) {
        return confirm("This will store data in your browser's local storage. Do you allow this?");
    } else {
        return true;
    }
}

function saveTiersData() {
    if (isMobile()) {
        emptyModal();
    }

    localStorage.setItem("tiers", JSON.stringify(tiers));
    localStorage.setItem("order", JSON.stringify(order));
    localStorage.setItem("gameTiers", JSON.stringify(gameTiers));
    localStorage.setItem("gameOrder", JSON.stringify(gameOrder));
    $("#msg_container").html("<strong class='confirmation'>Tier list(s) saved!</strong>");
    window.onbeforeunload = undefined;
}

function saveTiers() {
    if (isMobile() && !storageUsed()) {
        emptyModal();
        $("#modal_inner").html("<h3>Save Tiers</h3><p>This will store data in your browser's local storage. Do you allow this?</p>");
        $("#modal_inner").append("<input id='save_tiers_data' class='mobile_button' type='button' value='Yes'>");
        $("#modal_inner").append("<input id='empty_modal' class='mobile_button' type='button' value='No'>");
        $("#save_tiers_data").on("click", saveTiersData);
        $("#empty_modal").on("click", emptyModal);
        $("#modal_inner").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    if (!allowData()) {
        return;
    }

    saveTiersData();
}

function saveSettingsData() {
    if (isMobile()) {
        emptyModal();
    }

    localStorage.setItem("settings", JSON.stringify(settings));
    $("#msg_container").html("<strong class='confirmation'>Settings saved!</strong>");
    window.onbeforeunload = undefined;
}

function saveSettingsPre() {
    if (isMobile() && !storageUsed()) {
        emptyModal();
        $("#modal_inner").html("<h3>Save Settings</h3><p>This will store data in your browser's local storage. Do you allow this?</p>");
        $("#modal_inner").append("<input id='save_settings_pre' class='mobile_button' type='button' value='Yes'>");
        $("#save_settings_pre").on("click", saveSettingsData);
        $("#modal_inner").append("<input id='empty_modal' class='mobile_button' type='button' value='No'>");
        $("#empty_modal").on("click", emptyModal);
        $("#modal_inner").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    if (!allowData()) {
        return;
    }

    saveSettingsData();
}

function modalInformation() {
    emptyModal();
    $("#modal_inner").html("<h3>Acknowledgements</h3>" + $("#credits").html() +
    "<h3>Instructions</h3>" + $("#instructions_mobile").html() + "<br>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function nav() {
    return "<h3>Navigation</h3>" +
    "<p><a href='scoring'><img src='assets/scoring/scoring.ico' alt='Spell Card icon'> High Score Storage</a></p>" +
    "<p><a href='survival'><img src='assets/survival/survival.ico' alt='1up Item icon'> Survival Progress Table Generator</a></p>" +
    "<p><a href='drc'><img src='assets/drc/drc.ico' alt='Power icon'> Dodging Rain Competition</a></p>" +
    "<p><a href='tools'><img src='assets/tools/tools.ico' alt='UFO icon'> Touhou Patches and Tools</a></p>" +
    "<p><a href='wr'><img src='assets/wr/wr.ico' alt='Point Item icon'> Touhou World Records</a></p>" +
    "<p><a href='lnn'><img src='assets/lnn/lnn.ico' alt='Full Power icon'> Touhou Lunatic No Miss No Bombs</a></p>" +
    "<p><a href='jargon'><img src='assets/jargon/jargon.ico' alt='Bomb icon'> Touhou Community Jargon</a></p>" +
    "<p><a href='gensokyo'><img src='assets/gensokyo/gensokyo.ico' alt='Gensokyo.org icon'> Gensokyo Replay Archive</a></p>" +
    "<p><a href='pofv'><img src='assets/pofv/pofv.ico' alt='PoFV icon'> Phantasmagoria of Flower View</a></p>" +
    "<p><a href='thvote'><img src='assets/thvote/thvote.ico' alt='Tou kanji icon'> THWiki Popularity Poll 2020 Results Translation</a></p>" +
    "<p><a href='slots'><img src='assets/slots/slots.ico' alt='Heart icon'> Touhou Slot Machine</a></p>" +
    "<p><a href='history'><img src='assets/history/history.ico' alt='Maribel icon'> Shmup Achievement History</a></p>" +
    "<p><a href='c67'><img src='assets/c67/c67.ico' alt='Banshiryuu icon'> Seihou Banshiryuu C67</a></p>";
}

function menu() {
    emptyModal();
    $("#modal_inner").html("<h3>Menu</h3>" + $("#menu").html().replace(/_button/g, "_button_m") + nav());
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
    $("#save_button_m").on("click", saveTiers);
    $("#import_button_m").on("click", importText);
    $("#export_button_m").on("click", exportText);
    $("#screenshot_button_m").on("click", takeScreenshot);
    $("#settings_button_m").on("click", settingsMenu);
    $("#changelog_button_m").on("click", changeLog);
    $("#reset_button_m").on("click", eraseAll);
}

function checkSort(text) {
    if (text.join('\n').trim() === "") {
        return false;
    }

    var i, j, characters;

    for (i = 0; i < text.length; i += 1) {
        if (text[i].contains(':')) {
            continue;
        }

        if (text[i].charAt(0) == '#') {
            continue;
        }

        if (text[i] !== "") {
            characters = text[i].split(',');

            for (j = 0; j < characters.length; j += 1) {
                if (isCharacter(characters[j].removeSpaces())) {
                    return "characters";
                } else {
                    return "works";
                }
            }
        }
    }
}

function load() {
    var text = $("#import").val().split('\n'), noDisplay = true, counter = -1, tierList, tierSort, characters, i, j;

    tierSort = checkSort(text);

    if (!tierSort || tierSort != settings.sort) {
        $("#modal_inner").html("");
        $("#modal").css("display", "none");
        $("#modal_inner").css("display", "none");
        $("#msg_container").html("<strong class='error'>Cannot import " + (!tierSort ? "an empty list!" : "characters " +
        "into works or vice versa!") + "</strong>");
        return;
    }

    $("#import_msg_container").html("<strong class='error'>Please watch warmly as your tier list is imported...</strong>");
    tierList = (settings.sort == "characters" ? tiers : gameTiers);

    for (tierNum in tierList) {
        removeTier(tierNum, true);
    }

    if (settings.sort == "characters") {
        order = [];
    } else {
        gameOrder = [];
    }

    for (i = 0; i < text.length; i += 1) {
        if (text[i].contains(':')) {
            addTier({data: {tierName: text[i].replace(':', "")}});
            counter += 1;
            i += 1;
        }

        if (text[i].charAt(0) == '#') {
            tierList[counter].bg = text[i].split(' ')[0];
            tierList[counter].colour = text[i].split(' ')[1];
            $("#th" + counter).css("background-color", tierList[counter].bg);
            $("#th" + counter).css("color", tierList[counter].colour);
            i += 1;
        }

        if (text[i] !== "") {
            characters = text[i].split(',');

            for (j = 0; j < characters.length; j += 1) {
                if (characters[j] == "Mai") {
                    characters[j] = "Mai PC-98";
                }
                addToTier(characters[j].removeSpaces(), counter);
            }
        }
    }

    $("#modal_inner").html("");
    $("#modal").css("display", "none");
    $("#modal_inner").css("display", "none");
    $("#msg_container").html("<strong class='confirmation'>Tier list successfully imported!</strong>");
}

function importText() {
    var tierNum, character, i;

    emptyModal();
    $("#modal_inner").html("<h2>Import from Text</h2><p>Note that the format should be the same as the exported text.</p>");
    $("#modal_inner").append("<p><strong>Warning:</strong> Importing will overwrite your current tier list!");
    $("#modal_inner").append("<textarea id='import'></textarea><p><input id='load_button' type='button' value='Import'></p>");
    $("#load_button").on("click", load);
    $("#modal_inner").append("<p id='import_msg_container'></p>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function copyToClipboard() {
    navigator.clipboard.writeText($("#text").html().replace(/<\/p><p>/g, "\n").strip());
    emptyModal();
    $("#msg_container").html("<strong class='confirmation'>Copied to clipboard!</strong>");
    window.onbeforeunload = undefined;
}

function exportText() {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
    tierOrder = (settings.sort == "characters" ? order : gameOrder),
    tierNum, character, i, j;

    emptyModal();
    $("#modal_inner").html("<h2>Export to Text</h2><p><input id='copy_to_clipboard' " +
    "type='button' value='Copy to Clipboard'></p><p id='text'></p>");
    $("#copy_to_clipboard").on("click", copyToClipboard);

    for (i = 0; i < tierOrder.length; i += 1) {
        tierNum = tierOrder[i];

        if (!tierList[tierNum].flag) {
            $("#text").append("<p>" + tierList[tierNum].name + ":</p><p>" + tierList[tierNum].bg +
            " " + tierList[tierNum].colour + "</p><p>");

            for (j = 0; j < tierList[tierNum].chars.length; j += 1) {
                character = $("#" + tierList[tierNum].chars[j]).attr("title");
                $("#text").append(character + (j == tierList[tierNum].chars.length - 1 ? "" : ", "));
            }

            $("#text").append("</p>");
        }
    }

    if ($("#text").html() === "") {
        $("#msg_container").html("<strong class='error'>Error: there are no tiers to export.</strong>");
        $("#modal_inner").html("");
        return;
    }

    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function fileName() {
    var date = new Date(),
        month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});

    return "touhou_tier_list_" + date.getFullYear() + "_" + month +
    "_" + day + "_" + hours + "_" + minutes + "_" + seconds + ".png";
}

function takeScreenshot() {
    var tempTierView = false;

    if (!tierView) {
        toggleTierView();
        tempTierView = true;
    }

    emptyModal();
    html2canvas(document.body, {
        "height": ($("#tier_list_tbody").height() + 50),
        "windowHeight": Math.max(400, ($("#tier_list_tbody").height() + 50))
    }).then(function(canvas) {
        var base64image = canvas.toDataURL("image/png"), link;

        if (tempTierView) {
            toggleTierView();
        }

        $("#modal_inner").append("<h2>Screenshot</h2><p>");
        $("#modal_inner").append("<a id='save_link' href='" + base64image + "' download='" + fileName() + "'>" +
        "<input type='button' value='Save to Device'></a></p>" +
        "<p>This feature currently does not work on Linux when using Chromium-based browsers. If the tier list is large, it also does not work on Android.</p>" +
        "<p><img id='screenshot_base64' src='" + base64image + "' alt='Tier list screenshot'></p>");
        $("#modal_inner").css("display", "block");
        $("#modal").css("display", "block");
    });
}

function settingsMenuChars() {
    var categoryName, current = 0, counter = 0, i;

    emptyModal();
    $("#modal_inner").append("<h2>Settings</h2><div>Include characters in the following works of first appearance:" +
    "<table id='settings_table'><tbody><tr id='settings_tr0'>");

    for (categoryName in categories) {
        if (counter > 0 && counter % 5 === 0) {
            counter = 0;
            current += 1;
            $("#settings_table").append("</tr><tr id='settings_tr" + current + "'>");
        }

        $("#settings_tr" + current).append("<td><input id='checkbox_" + categoryName +
        "' type='checkbox'" + (settings.categories[categoryName].enabled ? " checked" : "") +
        " " + (pc98.contains(categoryName) || categoryName == "Soku" ? "disabled=true" : "") +
        "><label for='" + categoryName + "'>" + categoryName + "</label></td>");
        counter += 1;
    }

    $("#modal_inner").append("</tr></tbody></table>");
    $("#modal_inner").append("<p><label for='pc-98'>PC-98</label><input id='pc98' type='checkbox'" +
    " " + (settings.pc98Enabled ? " checked" : "") + " " + "></p>");
    $("#pc98").on("click", togglePC98);
    $("#modal_inner").append("<p><label for='windows'>Windows</label><input id='windows' type='checkbox'" +
    " " + (settings.windowsEnabled ? " checked" : "") + "></p>");
    $("#windows").on("click", toggleWindows);
    $("#modal_inner").append("<p><label for='male'>Male Characters</label><input id='male' type='checkbox'" +
    " " + (settings.maleEnabled ? " checked" : "") + " " + "></p></div>");
    $("#pc98").on("click", toggleMale);
}

function settingsMenuWorks() {
    var categoryName, current = 0, counter = 0;

    emptyModal();
    $("#modal_inner").html("<h2>Settings</h2>Include works in the following categories:" +
    "<table id='settings_table'><tbody><tr id='settings_tr0'>");

    for (categoryName in gameCategories) {
        if (counter > 0 && counter % 5 === 0) {
            counter = 0;
            current += 1;
            $("#settings_table").append("</tr><tr id='settings_tr" + current + "'>");
        }

        $("#settings_tr" + current).append("<td><input id='checkbox_" + categoryName +
        "' type='checkbox'" + (settings.gameCategories[categoryName].enabled ? " checked" : "") +
        "><label for='" + categoryName + "'>" + categoryName + "</label></td>");
        counter += 1;
    }
    $("#modal_inner").append("</tr></tbody></table>");
}

function customisationMenu() {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder), tierNum;

    $("#modal_inner").append("<h2>Tier Customisation</h2><div id='custom_tier_container'>");

    for (i = 0; i < tierOrder.length; i += 1) {
        tierNum = tierOrder[i];

        if (!tierList[tierNum].flag) {
            $("#custom_tier_container").append("<p><strong>" + tierList[tierNum].name + "</strong></p>");
            $("#custom_tier_container").append("<p class='name'><label for='custom_name_tier" + tierNum +
            "'>Name</label><input id='custom_name_tier" + tierNum + "' type='text' value='" + tierList[tierNum].name + "'></p>");
            $("#custom_tier_container").append("<p class='colour'><label for='custom_bg_tier" + tierNum +
            "'>Background Colour</label><input id='custom_bg_tier" + tierNum + "' type='color' value='" + tierList[tierNum].bg + "'>");
            $("#custom_tier_container").append("<label for='custom_colour_tier" + tierNum +
            "'>Text Colour</label><input id='custom_colour_tier" + tierNum +
            "' type='color' value='" + tierList[tierNum].colour + "'></p>");
        }
    }
}

function settingsMenu() {
    if (settings.sort == "characters") {
        settingsMenuChars();
    } else {
        settingsMenuWorks();
    }

    $("#modal_inner").append("<div>Other settings:<p><label for='tier_list_name'>Tier list name (optional)</label>" +
    "<input id='tier_list_name' class='settings_input' type='text' value='" + settings.tierListName + "'></p>" +
    "<label for='tier_header_width'>Tier header width</label>" +
    "<input id='tier_header_width' class='settings_input' type='number' value=" + settings.tierHeaderWidth + " min=" + defaultWidth + "></p>" +
    "<p><label for='tier_header_font_size'>Tier header font size</label>" +
    "<input id='tier_header_font_size' class='settings_input' type='number' value=" + settings.tierHeaderFontSize + "></p></div>");
    customisationMenu();
    $("#modal_inner").append("<div><p><input id='save_settings' type='button' value='Save Changes'></p>" +
    "<p id='settings_msg_container'></p></div>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
    $("#save_settings").on("click", saveSettings);
    $(".settings_input").on("keyup", detectSettingsEnter);
}

function massRemoval(removedCategories) {
    var cats = (settings.sort == "characters" ? categories : gameCategories), categoryName, character, i, j;

    $("#settings_msg_container").html("<strong class='error'>Girls are being removed, please wait warmly...</strong>");

    for (i = 0; i < removedCategories.length; i += 1) {
        categoryName = removedCategories[i];

        if (isCategory(categoryName)) {
            for (j in categories[categoryName].chars) {
                character = categories[categoryName].chars[j].removeSpaces();

                if (isTiered(character)) {
                    removeFromTier(character, getTierNumOf(character));
                }
            }
        } else {
            character = categoryName;
            removeFromTier(character, getTierNumOf(character));
        }
    }
}

function togglePC98() {
    for (var i = 0; i < pc98.length; i += 1) {
        $("#checkbox_" + pc98[i]).prop("checked", $("#pc98").is(":checked") ? true : false);
    }
}

function toggleWindows() {
    for (var i = 0; i < windows.length; i += 1) {
        $("#checkbox_" + windows[i]).prop("checked", $("#windows").is(":checked") ? true : false);
    }
}

function toggleMale() {
    $("#checkbox_Soku").prop("checked", $("#male").is(":checked") ? true : false);
}

function saveTierSettings() {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierNum, tierName, tierBg, tierColour;

    for (tierNum in tierList) {
        if (!tierList[tierNum].flag) {
            tierName = $("#custom_name_tier" + tierNum).val().strip().replace(/'/g, "");
            tierBg = $("#custom_bg_tier" + tierNum).val();
            tierColour = $("#custom_colour_tier" + tierNum).val();

            if (!validateTierName(tierName)) {
                $("#settings_msg_container").html("<strong class='error'>Error: tier names may not exceed " + MAX_NAME_LENGTH +
                " characters.</strong>");
                return;
            }

            $("#th" + tierNum).html(tierName);
            $("#th" + tierNum).css("background-color", tierBg);
            $("#th" + tierNum).css("color", tierColour);
            tierList[tierNum].name = tierName;
            tierList[tierNum].bg = tierBg;
            tierList[tierNum].colour = tierColour;
        }
    }
}

function saveSettings() {
    var cats = (settings.sort == "characters" ? categories : gameCategories),
        removedCategories = [], categoryName, item, confirmation, i;

    cancelOngoingSwap();
    saveTierSettings();
    saveTiers();

    for (categoryName in cats) {
        if (settings.sort == "characters") {
            settings.categories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");
        } else {
            settings.gameCategories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");
        }

        if (!$("#checkbox_" + categoryName).is(":checked")) {
            for (i = 0; i < cats[categoryName].chars.length; i++) {
                item = cats[categoryName].chars[i].removeSpaces();

                if (isTiered(item)) {
                    removedCategories.push(categoryName);
                }
            }
        }

        window.onbeforeunload = function () {
            return confirm();
        }
    }

    if (settings.sort == "characters" && !$("#male").is(":checked")) {
        for (i in maleCharacters) {
            if (isTiered(maleCharacters[i])) {
                removedCategories.push(maleCharacters[i]);
            }
        }
    }

    if (removedCategories.length > 0) {
        confirmation = confirm("This will remove characters from disabled categories from the current tiers. " +
        "Are you sure you want to do that?");

        if (isMobile() || confirmation) {
            massRemoval(removedCategories);
        } else {
            return;
        }
    }

    for (categoryName in cats) {
        if ($("#checkbox_" + categoryName).is(":checked") && !allTiered(categoryName)) {
            $("#" + categoryName).css("display", "block");
        } else {
            $("#" + categoryName).css("display", "none");
        }
    }

    if (settings.sort == "characters") {
        settings.artist = "Dairi";
        settings.pc98Enabled = $("#pc98").is(":checked");
        settings.windowsEnabled = $("#windows").is(":checked");
        settings.maleEnabled = $("#male").is(":checked");

        for (i in maleCharacters) {
            $("#" + maleCharacters[i]).css("display", settings.maleEnabled ? "inline-block" : "none");
        }
    }

    settings.tierListName = $("#tier_list_name").val();
    settings.tierHeaderWidth = $("#tier_header_width").val() > defaultWidth ? $("#tier_header_width").val() : defaultWidth;
    settings.tierHeaderFontSize = $("#tier_header_font_size").val() != defaultSize ? $("#tier_header_font_size").val() : defaultSize;
    $(".tier_header").css("width", settings.tierHeaderWidth + "px");
    $(".tier_header").css("max-width", settings.tierHeaderWidth + "px");
    $(".tier_header").css("font-size", settings.tierHeaderFontSize + "px");
    $("#tier_list_caption").html(settings.tierListName);
    $("#modal_inner").html("");
    $("#modal_inner").css("display", "none");
    $("#modal").css("display", "none");
    saveSettingsData();
}

function toggleTierView() {
    if (isMobile()) {
        tierView = !tierView;
        $("#tier_list_container").css("display", tierView ? "block" : "none");
        $("#characters, #instructions_mobile, #instructions_text").css("display", tierView ? "none" : "block");
        $("#view_button").val(tierView ? "Picker View" : "Tier List View");
    } else {
        $("#msg_container").html("");
        $("#characters").css("display", tierView ? "block" : "none");
        $("#buttons").css("display", tierView ? "block" : "none");
        tierView = !tierView;
        $("#toggle_view").val(tierView ? "Normal View" : "Tier List View");
        $("#wrap").css("max-height", tierView ? "100%" : "77%");
        $("#wrap").css("width", tierView ? "auto" : "48%");
        $("#wrap").css("bottom", tierView ? "5px" : "");
        $("#wrap").css("left", tierView ? "5px" : "");
        $("#wrap").css("border", tierView ? "none" : "1px solid #000");
        $(".webp").css("background", tierView ? "#1b232e" : "url('assets/tiers/tiers.webp') center no-repeat fixed");
        $(".no-webp").css("background", tierView ? "#1b232e" : "url('assets/tiers/tiers.jpg') center no-repeat fixed");

        if (tierView) {
            $("#screenshot_button_tierview").html($("#screenshot_button"));
            $("#screenshot_button").addClass("tierview_screenshot_button");
        } else {
            $("#screenshot_button").removeClass("tierview_screenshot_button");
            $("#screenshot_button_container").html($("#screenshot_button"));
        }
    }
}

function changeLog() {
    emptyModal();
    $("#modal_inner").html("<h2>Changelog</h2><ul class='left'><li>05/12/2018: Initial release</li>" +
    "<li>05/12/2018: Dairi art added and made the default; PC-98 and male characters added</li>" +
    "<li>21/01/2019: Mobile version</li>" +
    "<li>24/04/2019: Works added</li>" +
    "<li>18/08/2019: Migrated to maribelhearn.com</li>" +
    "<li>17/09/2019: Mobile version bugs fixed and speed increased; changelog added</li>" +
    "<li>04/10/2019: WBaWC characters added</li>" +
    "<li>19/12/2019: Fixed character disappearance bug and related issues</li>" +
    "<li>02/01/2020: Fixed tier list loading bug</li>" +
    "<li>13/03/2020: Fixed bug caused by swapping tiers as well as a bug caused by naming a tier after a character</li>" +
    "<li>06/04/2020: Added ability to change the tier header font size and made tier header width changes apply immediately</li>" +
    "<li>06/09/2020: Miyoi Okunoda added</li>" +
    "<li>23/09/2020: Screenshotting added</li></ul>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function eraseAllConfirmed() {
    var tierNum;

    if (settings.sort == "characters") {
        for (tierNum in tiers) {
            removeTier(tierNum, true);
        }
    }

    if (settings.sort == "works") {
        for (tierNum in gameTiers) {
            removeTier(tierNum, true);
        }
    }

    order = [];
    tiers = {};
    gameOrder = [];
    gameTiers = {};
    tmp = settings.sort;
    settings = {
        "categories": {
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true },
            "LLS": { enabled: true }, "MS": { enabled: true }, "EoSD": { enabled: true }, "PCB": { enabled: true },
            "IaMP": { enabled: true }, "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true },
            "SWR": { enabled: true }, "SA": { enabled: true }, "UFO": { enabled: true }, "Soku": { enabled: true },
            "DS": { enabled: true }, "GFW": { enabled: true }, "TD": { enabled: true }, "HM": { enabled: true },
            "DDC": { enabled: true }, "ULiL": { enabled: true }, "LoLK": { enabled: true }, "AoCF": { enabled: true },
            "HSiFS": { enabled: true }, "WBaWC": { enabled : true }, "Manga": { enabled: true }, "CD": { enabled: true }
        },
        "gameCategories": {
            "PC-98": { enabled: true }, "Classic": { enabled: true }, "Modern1": { enabled: true }, "Modern2": { enabled: true },
            "Mangas": { enabled: true }, "Books": { enabled: true }, "CDs": { enabled: true }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierListName": "",
        "tierHeaderWidth": defaultWidth,
        "tierHeaderFontSize": defaultSize,
        "artist": "Dairi",
        "sort": tmp
    };
    localStorage.removeItem("order");
    localStorage.removeItem("tiers");
    localStorage.removeItem("gameOrder");
    localStorage.removeItem("gameTiers");
    localStorage.removeItem("settings");
    initialise();
    $("#msg_container").html("<strong class='confirmation'>Reset the tier list and settings to their default states!</strong>");
    window.onbeforeunload = undefined;
}

function modalEraseAll() {
    eraseAllConfirmed();
    emptyModal();
}

function eraseAll() {
    var confirmation;

    if (isMobile()) {
        emptyModal();
        $("#modal_inner").html("<h3>Reset</h3><p>Are you sure you want to reset your tier list and settings to the defaults?</p>");
        $("#modal_inner").append("<input id='erase_all_button' type='button' value='Yes'>");
        $("#erase_all_button").on("click", modalEraseAll);
        $("#modal_inner").append("<input id='empty_modal' class='mobile_button' type='button' value='No'>");
        $("#empty_modal").on("click", emptyModal);
        $("#modal_inner").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    confirmation = confirm("Are you sure you want to reset your tier list and settings to the defaults?");

    if (confirmation) {
        eraseAllConfirmed();
    }
}

function drag(event) {
    following = event.target.id;
}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event) {
    var tierNum, pos;

    event.preventDefault();

    if (event.target.id.substring(0, 2) == "th" || event.target.id.substring(0, 4) == "tier") {
        tierNum = Number(event.target.id.replace("th", "").replace("tier", "").replace(/_\d+/, ""));

        if (multiSelection.length > 1) {
            addMultiSelection(tierNum);
        } else {
            if (isTiered(following)) {
                changeToTier(following, tierNum);
            } else {
                addToTier(following, tierNum);
            }
        }

        multiSelection = [];
    } else if (isTiered(event.target.id)) {
        if (isTiered(following)) {
            swapItems(following, event.target.id);
        } else {
            addToTier(following, getTierNumOf(event.target.id), getPositionOf(event.target.id));
        }
    } else if ((isItem(event.target.id) || isCategory(event.target.id) || event.target.id == "characters") && isTiered(following)) {
        removeFromTier(following, getTierNumOf(following));
    }

    following = "";
}

function deleteLegacyCookies() {
    if (getCookie("settings")) {
        localStorage.setItem("settings", getCookie("settings"));
        deleteCookie("settings");
    }

    if (getCookie("tiers")) {
        localStorage.setItem("tiers", getCookie("tiers"));
        deleteCookie("tiers");
    }

    if (getCookie("order")) {
        localStorage.setItem("order", getCookie("order"));
        deleteCookie("order");
    }

    if (getCookie("gameTiers")) {
        localStorage.setItem("gameTiers", getCookie("gameTiers"));
        deleteCookie("gameTiers");
    }

    if (getCookie("gameOrder")) {
        localStorage.setItem("gameOrder", getCookie("gameOrder"));
        deleteCookie("gameOrder");
    }
}

function loadCategories() {
    var chars = $("#chars_load").children(), works = $("#works_load").children(), val, i, j;

    for (i = 0; i < chars.length; i++) {
        val = chars[i].value.split(',');
        categories[chars[i].id] = {"chars": []};

        for (j = 0; j < val.length; j++) {
            categories[chars[i].id].chars.push(val[j]);
        }
    }

    for (i = 0; i < works.length; i++) {
        val = works[i].value.split(',');
        gameCategories[works[i].id] = {"chars": []};

        for (j = 0; j < val.length; j++) {
            gameCategories[works[i].id].chars.push(val[j]);
        }
    }
}

function loadTier(tiersData, tierNum, tierSort) {
    var tierList = (tierSort == "characters" ? tiers : gameTiers), character;

    tierList[tierNum] = {};
    tierList[tierNum].name = tiersData[tierNum].name;
    tierList[tierNum].bg = tiersData[tierNum].bg;
    tierList[tierNum].colour = tiersData[tierNum].colour;
    tierList[tierNum].chars = [];
    tierList[tierNum].flag = tiersData[tierNum].flag;

    if (!tierList[tierNum].flag) {
        if (tierSort == settings.sort) {
            $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' class='tier'><th id='th" + tierNum +
            "' class='tier_header'>" + tiersData[tierNum].name + "</th><td id='tier" + tierNum +
            "' class='tier_content'></td></tr>");
            $("#tr" + tierNum).on("dragover", allowDrop);
            $("#tr" + tierNum).on("drop", drop);
            $("#th" + tierNum).on("click", {tierNum: tierNum}, detectLeftCtrlCombo);
            $("#th" + tierNum).on("contextmenu", {tierNum: tierNum}, detectRightCtrlCombo);
            $("#th" + tierNum).css("background-color", tierList[tierNum].bg);
            $("#th" + tierNum).css("color", tierList[tierNum].colour);
            $("#th" + tierNum).css("max-width", settings.tierHeaderWidth + "px");
            $("#th" + tierNum).css("width", settings.tierHeaderWidth + "px");
            $("#th" + tierNum).css("font-size", settings.tierHeaderFontSize + "px");

            if (isMobile()) {
                $("#th" + tierNum).css("height", "60px");
            }

            for (i = 0; i < tiersData[tierNum].chars.length; i += 1) {
                character = tiersData[tierNum].chars[i];

                if (character == "Mai") {
                    character = "Mai PC-98";
                }

                if (isMobile()) {
                    $("#" + character).off("click");
                }

                addToTier(character, tierNum);
            }
        } else {
            for (i = 0; i < tiersData[tierNum].chars.length; i += 1) {
                character = tiersData[tierNum].chars[i];

                if (character == "Mai") {
                    character = "Mai PC-98";
                }

                if (isMobile()) {
                    $("#" + character).off("click");
                }

                tierList[tierNum].chars.pushStrict(character);
            }
        }
    }
}

function loadTiersFromStorage() {
    var orderData = JSON.parse(localStorage.getItem("order")),
        tiersData = JSON.parse(localStorage.getItem("tiers")),
        gameOrderData = JSON.parse(localStorage.getItem("gameOrder")),
        gameTiersData = JSON.parse(localStorage.getItem("gameTiers")),
        tierNum, i;

    if (orderData) {
        order = orderData;

        for (i = 0; i < order.length; i += 1) {
            tierNum = order[i];
            loadTier(tiersData, tierNum, "characters");
        }
    } else {
        for (tierNum in tiersData) {
            tierNum = Number(tierNum);
            loadTier(tiersData, tierNum, "characters");
            order.push(tierNum);
        }
    }

    if (gameOrderData) {
        gameOrder = gameOrderData;

        for (i = 0; i < gameOrder.length; i += 1) {
            tierNum = gameOrder[i];
            loadTier(gameTiersData, tierNum, "works");
        }
    } else {
        for (tierNum in gameTiersData) {
            tierNum = Number(tierNum);
            loadTier(gameTiersData, tierNum, "works");
            gameOrder.push(tierNum);
        }
    }
}

function loadCharacters() {
    var categoryName, character, i;

    for (categoryName in categories) {
        $("#characters").append("<div id='" + categoryName + "'>");

        for (i in categories[categoryName].chars) {
            character = categories[categoryName].chars[i];

            if (isMobile()) {
                $("#" + categoryName).append("<span id='" + character.removeSpaces() +
                "C'><span id='" + character.removeSpaces() + "' class='list' title='" + character + "'>");
                $("#" + character.removeSpaces()).on("click", {name: $("#" + character.removeSpaces()).attr("title")}, addMenu);
            } else {
                $("#" + categoryName).append("<span id='" + character.removeSpaces() +
                "C'><span id='" + character.removeSpaces() + "' class='list' draggable='true' title='" + character + "'>");
                $("#" + character.removeSpaces()).on("dblclick", {name: $("#" + character.removeSpaces()).attr("title")}, addMenu);
                $("#" + character.removeSpaces()).on("dragstart", drag);
                $("#" + character.removeSpaces()).on("click", toggleMulti);
            }

            if (maleCharacters.contains(character.removeSpaces()) && !settings.maleEnabled) {
                $("#" + character.removeSpaces()).css("display", "none");
            }
        }

        $("#characters").append("</div>");

        if (!settings.categories[categoryName].enabled) {
            $("#" + categoryName).css("display", "none");
        }
    }

    if (isMobile()) {
        $(".list, .tiered").css("background-image", "url('assets/shared/spritesheet60x60.png')");
    }
}

function acronym(game) {
    var acronym = "", array = game.split(/[ -\.]/);

    if (game == "Touhou Hisoutensoku") {
        return "soku";
    } else if (game == "Retrospective 53 minutes") {
        return "r53m";
    } else if (array.contains("The")) {
        array.remove("The");
    }

    for (i = 0; i < array.length; i += 1) {
        acronym += array[i].charAt(0);
    }

    return acronym.toLowerCase();
}

function loadWorks() {
    var categoryName, game, i;

    for (categoryName in gameCategories) {
        $("#characters").append("<div id='" + categoryName + "'>");

        for (i in gameCategories[categoryName].chars) {
            game = gameCategories[categoryName].chars[i].replace("'", "");

            if (isMobile()) {
                $("#" + categoryName).append("<span id='" + game.removeSpaces() +
                "C'><img id='" + game.removeSpaces() +
                "' class='list' src='assets/games/" + acronym(game) + "120x120.jpg' title='" + game + "'>");
                $("#" + game.removeSpaces()).on("click", {name: $("#" + game.removeSpaces()).attr("title")}, addMenu);
            } else {
                $("#" + categoryName).append("<span id='" + game.removeSpaces() +
                "C'><img id='" + game.removeSpaces() + "' class='list' draggable='true' " +
                "src='assets/games/" + acronym(game) + "120x120.jpg' alt='" + game + "' title='" + game + "'>");
                $("#" + game.removeSpaces()).on("dblclick", {name: $("#" + game.removeSpaces()).attr("title")}, addMenu);
                $("#" + game.removeSpaces()).on("dragstart", drag);
            }
        }

        $("#characters").append("</div>");

        if (!settings.gameCategories[categoryName].enabled) {
            $("#" + categoryName).css("display", "none");
        }
    }
}

function loadItems() {
    if (settings.sort == "characters") {
        loadCharacters();
    } else {
        loadWorks();
    }
}

function loadSettingsFromStorage() {
    var settingsData = JSON.parse(localStorage.getItem("settings")), category;

    if (settingsData.hasOwnProperty("categories")) {
        for (category in settingsData.categories) {
            settings.categories[category].enabled = settingsData.categories[category].enabled;
        }

        if (settingsData.hasOwnProperty("gameCategories")) {
            for (category in settingsData.gameCategories) {
                if (category == "Manga") { // fix legacy manga
                    settings.gameCategories["Mangas"] = settingsData.gameCategories[category];
                    continue;
                }

                settings.gameCategories[category].enabled = settingsData.gameCategories[category].enabled;
            }
        }

        settings.pc98Enabled = settingsData.pc98Enabled;
        settings.windowsEnabled = settingsData.windowsEnabled;
        settings.maleEnabled = settingsData.maleEnabled;
        settings.tierListName = (settingsData.tierListName ? settingsData.tierListName : "");
        settings.tierHeaderWidth = (settingsData.tierHeaderWidth ? settingsData.tierHeaderWidth : defaultWidth);
        settings.tierHeaderFontSize = (settingsData.tierHeaderFontSize ? settingsData.tierHeaderFontSize : defaultSize);
        settings.artist = settingsData.artist;
        settings.sort = settingsData.sort;
    } else {
        for (category in settingsData) {
            if (category == "Other") {
                settings.categories["Manga"].enabled = settingsData[category].enabled;
                settings.categories["CD"].enabled = settingsData[category].enabled;
            } else {
                settings.categories[category].enabled = settingsData[category].enabled;
            }
        }
    }
}

function setAddTierListeners() {
    $("#add_tier, #add_tier_mobile").off("click");
    $("#add_tier").on("click", {tierName: $("#tier_name").val()}, addTier);
    $("#add_tier_mobile").on("click", {tierName: $("#tier_name_mobile").val()}, addTier);
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
        saveSettings();
    }
}

function setEventListeners() {
    setAddTierListeners();
    $("body").on("click", closeModal);
    $("body").on("keyup", detectKey);
    $("#sort").on("change", switchSort);
    $("#toggle_view").on("click", toggleTierView);
    $("#toggle_instructions").on("click", toggleInstructions);
    $("#tier_name, #tier_name_mobile").on("keyup", detectAddTierEnter);
    $("#save_button").on("click", saveTiers);
    $("#import_button").on("click", importText);
    $("#export_button").on("click", exportText);
    $("#screenshot_button").on("click", takeScreenshot);
    $("#settings_button").on("click", settingsMenu);
    $("#changelog_button").on("click", changeLog);
    $("#reset_button").on("click", eraseAll);
    $("#information_button").on("click", modalInformation);
    $("#view_button").on("click", toggleTierView);
    $("#menu_button").on("click", menu);
    $("#switch_button").on("click", switchSort);
    $("#characters").on("dragover", allowDrop);
    $("#characters").on("drop", drop);
}

$(document).ready(function () {
    deleteLegacyCookies();

    if (localStorage.settings) {
        loadSettingsFromStorage();
    }

    loadCategories();
    $("#chars_load, #works_load").remove();
    $("#sort").val(settings.sort);
    loadItems();

    if (localStorage.tiers || localStorage.gameTiers) {
        loadTiersFromStorage();
    } else {
        initialise();
    }

    setEventListeners();
    window.onbeforeunload = undefined;
});
