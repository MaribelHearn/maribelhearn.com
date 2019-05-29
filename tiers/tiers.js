var categories, gameCategories,
    defaultWidth = (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) ? 60 : 120,
    settings = {
        "categories": {
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true }, "LLS": { enabled: true }, "MS": { enabled: true },
            "EoSD": { enabled: true }, "PCB": { enabled: true }, "IaMP": { enabled: true }, "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true },
            "SWR": { enabled: true }, "SA": { enabled: true }, "UFO": { enabled: true }, "Soku": { enabled: true }, "DS": { enabled: true }, "GFW": { enabled: true },
            "TD": { enabled: true }, "HM": { enabled: true }, "DDC": { enabled: true }, "ULiL": { enabled: true }, "LoLK": { enabled: true }, "AoCF": { enabled: true },
            "HSiFS": { enabled: true }, "Manga": { enabled: true }, "CD": { enabled: true }
        },
        "gameCategories": {
            "PC-98": { enabled: true }, "Classic": { enabled: true }, "Modern1": { enabled: true }, "Modern2": { enabled: true },
            "Manga": { enabled: true }, "Books": { enabled: true }, "CDs": { enabled: true }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierHeaderWidth": defaultWidth,
        "artist": "Dairi",
        "sort": "characters"
    },
    windows = ["EoSD", "PCB", "IaMP", "IN", "PoFV", "MoF", "SWR", "SA", "UFO", "Soku", "DS", "GFW", "TD", "HM", "DDC", "ULiL", "LoLK", "AoCF", "HSiFS"],
    maleCharacters = ["SinGyokuM", "Genjii", "Unzan", "RinnosukeMorichika", "FortuneTeller"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"],
    tiers = {},
    gameTiers = {},
    order = [],
    gameOrder = [],
    maxTiers = 20,
    maxNameLength = 30,
    following = "",
    tierView = false,
    swapOngoing = -1,
    mostRecentTiers = {"characters": -1, "works": -1};

var isMobile = function () {
    return navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1;
};

var isLandscape = function () {
    return window.orientation == -90 || window.orientation == 90 || screen.width > screen.height;
};

var isCharacter = function (character) {
    return character !== "" && JSON.stringify(categories).removeSpaces().contains(character);
};

var isItem = function (item) {
    var cats = (settings.sort == "characters" ? categories : gameCategories);

    return item !== "" && JSON.stringify(cats).removeSpaces().contains(item);
};

var isCategory = function (category) {
    return category !== "" && (Object.keys(categories).contains(category) || Object.keys(gameCategories).contains(category));
};

var isTiered = function (item) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    return item !== "" && JSON.stringify(tierList).contains(item.removeSpaces());
};

var tierHeaderHeight = function () {
    return isMobile() ? 60 : 120;
};

var allTiered = function (categoryName) {
    var cats = (settings.sort == "characters" ? categories : gameCategories);

    for (var i = 0; i < cats[categoryName].chars.length; i++) {
        if (!isTiered(cats[categoryName].chars[i].removeSpaces())) {
            return false;
        }
    }

    return true;
};

var getTierNumOf = function (item) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), tierNum, i;

    for (tierNum in tierList) {
        for (i = 0; i < tierList[tierNum].chars.length; i++) {
            if (tierList[tierNum].chars[i] == item) {
                return Number(tierNum);
            }
        }
    }

    return false;
};

var getPositionOf = function (item) {
    return Number($("#" + item).parent().attr("id").split("_")[1]);
};

var getCategoryOf = function (item) {
    var cats = (settings.sort == "characters" ? categories : gameCategories), categoryName;

    for (categoryName in cats) {
        if (JSON.stringify(cats[categoryName].chars).removeSpaces().contains(item)) {
            return categoryName;
        }
    }

    return false;
};

var reloadTiers = function () {
    // empty tier display without emptying actual tiers
    var cats = (settings.sort == "characters" ? categories : gameCategories),
        tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder), i, item, id, j;

    for (i = 0; i < Object.keys(tiers).length; i++) {
        $("#tier" + i).html("");
    }

    // load content of other sort
    if (tierList.isEmpty()) {
        return;
    }

    for (tierNum in tierList) {
        tierNum = Number(tierNum);

        if (!tierList[tierNum].flag) {
            $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
            "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum + ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
            "); return false;' style='color: " + tierList[tierNum].colour + "; background-color: " + tierList[tierNum].bg +
            ";'>" + tierList[tierNum].name + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");

            for (i = 0; i < tierList[tierNum].chars.length; i++) {
                item = tierList[tierNum].chars[i];

                if (item == "Mai") { // fix legacy name
                    item = "Mai PC-98";
                }

                if (isMobile()) {
                    $("#" + item).attr("onClick", "");
                    $("#" + item).attr("onContextMenu", "modalChar('" + item + "', " + tierNum + "); return false;");
                } else {
                    $("#" + item).attr("onContextMenu", "removeFromTier('" + item + "', " + tierNum + "); return false;");
                }

                $("#" + item).removeClass("list");
                $("#" + item).addClass("tiered");
                id = "tier" + tierNum + "_" + i;
                $("#tier" + tierNum).append("<span id='" + id + "'></span>");
                $("#" + id).html($("#" + item));

                // check for category emptiness
                for (j in cats) {
                    if (!$("#" + j).html().contains("list")) {
                        $("#" + j).css("display", "none");
                    }
                }
            }
        }
    }
};

var initialise = function () {
    var noDisplay = true, tmp;

    addTier("S");
    addTier("A");
    tmp = settings.sort;
    settings.sort = (settings.sort == "characters" ? "works" : "characters");
    addTier("S", noDisplay);
    addTier("A", noDisplay);
    settings.sort = tmp;
    $("#tier_name").val("B");
};

var switchSort = function () {
    cancelOngoingSwap();
    $("#characters").html("");
    $("#tier_list_tbody").html("");
    settings.sort = (settings.sort == "characters" ? "works": "characters");
    loadItems();
    reloadTiers();
    saveSettingsPre();
    $("#msg_container").html("<strong style='color:green'>Switched to " + settings.sort + "!</strong>");

    if (isMobile()) {
        applyMobileCSS();
    }
};

var updateArrays = function () {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), tierNum, id, i;

    for (tierNum in tierList) {
        id = "#tier" + tierNum + "_";

        for (i = 0; i < tierList[tierNum].chars.length; i++) {
            if ($(id + i).children().length > 0) {
                tierList[tierNum].chars[i] = $(id + i).children()[0].id;
            }
        }
    }
};

var addToTier = function (character, tierNum, pos, noDisplay) {
    var cats = (settings.sort == "characters" ? categories : gameCategories),
        tierList = (settings.sort == "characters" ? tiers : gameTiers),
        categoryName = getCategoryOf(character), id, i;

    if (isTiered(character)) {
        return;
    }

    $("#msg_container").html("");
    $("#" + character).removeClass("list");
    $("#" + character).addClass("tiered");

    if (isMobile()) {
        $("#" + character).attr("onContextMenu", "modalChar('" + character + "', " + tierNum + "); return false;");
    } else {
        $("#" + character).attr("onContextMenu", "removeFromTier('" + character + "', " + tierNum + "); return false;");
    }

    // insert at specific position
    if (typeof pos == "number") {
        id = "tier" + tierNum + "_";

        if (!noDisplay) {
            $("#tier" + tierNum).append("<span id='" + id + tierList[tierNum].chars.length + "'></span>");

            for (i = tierList[tierNum].chars.length; i > (pos + 1); i--) {
                $("#" + id + i).html($("#" + id + (i - 1)).html());
            }

            $("#" + id + (pos + 1)).html($("#" + character));
        }

        tierList[tierNum].chars.pushStrict(character);
        updateArrays();
    // add to the back (default)
    } else {
        id = "tier" + tierNum + "_" + tierList[tierNum].chars.length;

        if (!noDisplay) {
            $("#tier" + tierNum).append("<span id='" + id + "'></span>");
            $("#" + id).html($("#" + character));
        }

        tierList[tierNum].chars.pushStrict(character);
    }

    window.onbeforeunload = function () { return confirm(); };

    // check for category emptiness
    for (i in cats[categoryName].chars) {
        if (!isTiered(cats[categoryName].chars[i])) {
            return;
        }
    }

    $("#" + categoryName).css("display", "none");
};

var addToMostRecent = function (character) {
    if (mostRecentTiers[settings.sort] >= 0) {
        addToTier(character, mostRecentTiers[settings.sort]);
    }
};

// Mobile-Only
var addToTierMobile = function (character, tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    $("#" + character.removeSpaces()).attr("onClick", "");
    addToTier(character.removeSpaces(), tierNum);
    emptyModal();
    $("#msg_container").html("<strong style='color:green'>Added " + character + " to " + tierList[tierNum].name + "!</strong>");
}

// Mobile-only
var addMenu = function (character) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder), tierNum, i;

    emptyModal();
    $("#mobile_modal").html("<h3>" + character + "</h3><p>Add to tier:</p>");

    for (i = 0; i < tierOrder.length; i++) {
        tierNum = tierOrder[i];

        if (!tierList[tierNum].flag) {
            $("#mobile_modal").append("<input type='button' value='" + tierList[tierNum].name +
            "' onClick='addToTierMobile(\"" + character + "\", " + tierNum + ")' " +
            "style='min-width: 25px; height: 25px; margin: 10px'>");
        }
    }

    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

var moveToBack = function (character, tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), help = $("#" + character);

    for (counter = getPositionOf(character); counter + 1 < tierList[tierNum].chars.length; counter++) {
        $("#tier" + tierNum + "_" + counter).html($("#tier" + tierNum + "_" + (counter + 1)).html());
    }

    $("#msg_container").html("");
    $("#tier" + tierNum + "_" + (tierList[tierNum].chars.length - 1)).html(help);
    updateArrays();
    window.onbeforeunload = function () { return confirm(); };
};

var removeFromTier = function (character, tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), pos, counter;

    if (character === "") {
        return;
    }

    $("#msg_container").html("");
    $("#" + character).removeClass("tiered");
    $("#" + character).addClass("list");
    $("#" + character).attr("onContextMenu", "");

    if (isMobile()) {
        $("#" + character).attr("onClick", "addMenu('" + $("#" + character).attr("alt") + "')");
    }

    pos = getPositionOf(character);
    $("#" + character + "C").append($("#" + character));
    $("#" + getCategoryOf(character)).css("display", "block");

    if (tierNum !== false) {
        // move all characters after the removed one a position backward
        for (counter = pos + 1; counter < tierList[tierNum].chars.length; counter++) {
            $("#tier" + tierNum + "_" + (counter - 1)).html($("#tier" + tierNum + "_" + counter).html());
        }

        $("#tier" + tierNum + "_" + (tierList[tierNum].chars.length - 1)).remove();
        tierList[tierNum].chars.remove(character);
    }

    if (isMobile()) {
        $("#msg_container").html("<strong style='color:green'>Removed " + $("#" + character).attr("alt") +
        " from " + tierList[tierNum].name + "!</strong>");
    }

    window.onbeforeunload = function () { return confirm(); };
};

var changeToTier = function (character, tierNum) {
    var oldTierNum = getTierNumOf(character), help, id;

    if (oldTierNum === tierNum) {
        moveToBack(character, tierNum);
    } else {
        removeFromTier(character, oldTierNum);

        if (isMobile()) {
            addToTierMobile(character, tierNum);
        } else {
            addToTier(character, tierNum);
        }
    }
};

// Mobile-only
var modalChar = function (character, tierNum) {
    var tierOrder = (settings.sort == "characters" ? order : gameOrder), above, below;

    emptyModal();
    $("#mobile_modal").html("<h3>" + character + "</h3><input type='button' value='Remove' onClick='removeFromTier(\"" + character +
    "\", " + tierNum + "); emptyModal()' style='margin:10px'>");

    if (tierOrder.indexOf(tierNum) !== 0) {
        above = tierOrder[tierOrder.indexOf(tierNum) - 1];
        $("#mobile_modal").append("<input type='button' value='Move Up' onClick='changeToTier(\"" + character +
        "\", " + above + "); emptyModal()' style='margin:10px'>");
    }

    if (tierOrder.indexOf(tierNum) != order.length - 1) {
        below = tierOrder[tierOrder.indexOf(tierNum) + 1];
        $("#mobile_modal").append("<input type='button' value='Move Down' onClick='changeToTier(\"" + character +
        "\", " + below + "); emptyModal()' style='margin:10px'>");
    }

    $("#mobile_modal").append("<input type='button' value='Move to Back' onClick='moveToBack(\"" + character +
    "\", " + tierNum + "); emptyModal()' style='margin:10px'>");
    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

var validateTierName = function (tierName) {
    return tierName.length <= maxNameLength;
};

var addTier = function (tierName, noDisplay) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder), tierNum = 0, otherTierNum;

    $("#msg_container").html("");

    // get an unused tier ID
    while (tierList[tierNum] && !tierList[tierNum].flag) {
        tierNum += 1;
    }

    // validate the tier
    if (tierNum >= maxTiers) {
        $("#msg_container").html("<strong style='color:orange'>Error: the number of tiers may not exceed " + maxTiers + ".</strong>");
        return;
    }

    tierName = tierName.strip().replace(/'/g, "");
    $("#tier_name").val(tierName);

    if (!tierName || tierName === "") {
        return;
    }

    if (!validateTierName(tierName)) {
        $("#msg_container").html("<strong style='color:orange'>Error: tier names may not exceed " + maxNameLength + " characters.</strong>");
        return;
    }

    // add the tier
    if (!noDisplay) {
        $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
        "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum + ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
        "); return false;' style='max-width:" + settings.tierHeaderWidth + "px" + (isMobile() ? ";height:60px" : "") + "'>" + tierName +
        "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr><hr>");
    }

    tierList[tierNum] = {};
    tierList[tierNum].name = tierName;
    tierList[tierNum].bg = "#1b232e";
    tierList[tierNum].colour = "#a0a0a0";
    tierList[tierNum].chars = [];
    tierList[tierNum].flag = false;
    tierOrder.push(tierNum);
    mostRecentTiers[settings.sort] = tierNum;

    // if tier swap ongoing, set onClick to swapTiers
    if (swapOngoing >= 0) {
        $("#th" + tierNum).attr("onClick", "swapTiers(" + swapOngoing + ", " + tierNum + ")");
    }

    window.onbeforeunload = function () { return confirm(); };
};

var startTierSwap = function (tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    var tierName = $("#th" + tierNum).html(), invertedColour = new RGBColor(tierList[tierNum].colour),
        invertedBg = new RGBColor(tierList[tierNum].bg), otherTierNum;

    $("#th" + tierNum).css("color", "rgb(" + (255 - invertedColour.r) + ", " + (255 - invertedColour.g) + ", " + (255 - invertedColour.b) + ")");
    $("#th" + tierNum).css("background-color", "rgb(" + (255 - invertedBg.r) + ", " + (255 - invertedBg.g) + ", " + (255 - invertedBg.b) + ")");
    swapOngoing = tierNum;

    for (otherTierNum in tierList) {
        $("#th" + otherTierNum).attr("onClick", "swapTiers(" + tierNum + ", " + otherTierNum + ")");
    }
};

var swapTiers = function (tierNum1, tierNum2) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    var tmp = tierList[tierNum1], tierNum;

    $("#th" + tierNum1).attr("style", "color: " + tierList[tierNum2].colour + "; background-color: " + tierList[tierNum2].bg +
    "; max-width: " + settings.tierHeaderWidth + "px; width: " + settings.tierHeaderWidth + "px; height: " + tierHeaderHeight() + "px;");
    $("#th" + tierNum2).attr("style", "color: " + tierList[tierNum1].colour + "; background-color: " + tierList[tierNum1].bg +
    "; max-width: " + settings.tierHeaderWidth + "px; width: " + settings.tierHeaderWidth + "px; height: " + tierHeaderHeight() + "px;");
    tierList[tierNum1] = tierList[tierNum2];
    tierList[tierNum2] = tmp;
    tmp = $("#th" + tierNum1).html();
    $("#th" + tierNum1).html($("#th" + tierNum2).html());
    $("#th" + tierNum2).html(tmp);
    tmp = $("#tier" + tierNum1).html();
    $("#tier" + tierNum1).html($("#tier" + tierNum2).html());
    $("#tier" + tierNum2).html(tmp);
    swapOngoing = -1;

    for (tierNum in tierList) {
        $("#th" + tierNum).attr("onClick", "detectLeftCtrlCombo(event, " + tierNum + ")");
    }

    window.onbeforeunload = function () { return confirm(); };
};

var removeCharacters = function (tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    while (tierList[tierNum].chars.length > 0) {
        removeFromTier(tierList[tierNum].chars[0], tierNum);
    }
};

var cancelOngoingSwap = function () {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), tierNum;

    if (swapOngoing >= 0) {
        for (tierNum in tierList) {
            $("#th" + tierNum).attr("onClick", "detectLeftCtrlCombo(event, " + tierNum + ")");
        }

        swapOngoing = -1;
    }
};

var removeTier = function (tierNum, skipConfirmation) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder);

    var length = tierList[tierNum].chars.length, confirmation = true, otherTierNum, i;

    if (isMobile()) {
        skipConfirmation = true;
    }

    if (!skipConfirmation) {
        confirmation = confirm("Are you sure you want to remove this tier? Removal may take a moment with many characters inside.");
    }

    if (confirmation) {
        removeCharacters(tierNum);
        cancelOngoingSwap();
        $("#tr" + tierNum).remove();
        tierList[tierNum].flag = true;
        tierOrder.remove(tierNum);

        if (mostRecentTiers[settings.sort] == tierNum) {
            mostRecentTiers[settings.sort] = -1;
        }
    }

    window.onbeforeunload = function () { return confirm(); };
};

var swapCharacters = function (character1, character2) {
    var parent1 = $("#" + character1).parent(),
        parent2 = $("#" + character2).parent(),
        backup = $("#" + character1);

    $(parent1).html($("#" + character2));
    $(parent2).html(backup);
    updateArrays();

    if (isMobile()) {
        $("#" + character1).attr("onContextMenu", "modalChar('" + character1 + "', " + getTierNumOf(character1) + "); return false;");
        $("#" + character2).attr("onContextMenu", "modalChar('" + character2 + "', " + getTierNumOf(character2) + "); return false;");
    } else {
        $("#" + character1).attr("onContextMenu", "removeFromTier('" + character1 + "', " + getTierNumOf(character1) + "); return false;");
        $("#" + character2).attr("onContextMenu", "removeFromTier('" + character2 + "', " + getTierNumOf(character2) + "); return false;");
    }

    window.onbeforeunload = function () { return confirm(); };
};

var emptyModal = function () {
    $("#mobile_modal").html("");
    $("#text_conversion").html("");
    $("#customisation").html("");
    $("#settings").html("");
    $("#mobile_modal").css("display", "none");
    $("#text_conversion").css("display", "none");
    $("#customisation").css("display", "none");
    $("#settings").css("display", "none");
    $("#modal").css("display", "none");
}

var closeModal = function (event) {
    var modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.keyCode && event.keyCode == 27)) {
        emptyModal();
    }
};

var quickAdd = function (tierNum) {
    var cats = (settings.sort == "characters" ? categories : gameCategories), categoryName, character, i;

    for (categoryName in cats) {
        if (settings.sort == "characters" && settings.categories[categoryName].enabled || settings.sort == "works" && settings.gameCategories[categoryName].enabled) {
            for (i = 0; i < cats[categoryName].chars.length; i++) {
                character = cats[categoryName].chars[i].removeSpaces();

                if (!isTiered(character)) {
                    addToTier(character, tierNum);
                }
            }
        }
    }
};

var detectLeftCtrlCombo = function (event, tierNum) {
    if (event.ctrlKey) { // quick-add on ctrl + left click
        quickAdd(tierNum);
    } else { // initiate swap on left click
        startTierSwap(tierNum);
    }
};

var emptyTier = function (tierNum) {
    var confirmation;

    if (isMobile()) {
        removeCharacters(tierNum);
    }

    confirmation = confirm("Are you sure you want to empty this tier? Emptying may take a moment with many characters inside.");

    if (confirmation) {
        removeCharacters(tierNum);
    }
};

// Mobile-only
var modalTier = function (tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    emptyModal();
    $("#mobile_modal").html("<h3>" + tierList[tierNum].name + "</h3>");
    $("#mobile_modal").append("<p><input type='button' value='Remove' onClick='removeTier(" + tierNum + "); emptyModal()'></p>");
    $("#mobile_modal").append("<p><input type='button' value='Add All Characters' onClick='quickAdd(" + tierNum + "); emptyModal()'></p>");
    $("#mobile_modal").append("<p><input type='button' value='Remove All Characters' onClick='emptyTier(" + tierNum + "); emptyModal()'></p>");
    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

var detectRightCtrlCombo = function (event, tierNum) {
    if (event.ctrlKey) { // empty tier on ctrl + right click
        emptyTier(tierNum);
    } else { // remove tier on right click
        if (isMobile()) {
            modalTier(tierNum);
        } else {
            removeTier(tierNum);
        }
    }
};

var detectAddTierEnter = function (event) {
    if (event.keyCode == 13) { // enter press
        addTier($("#tier_name").val());
    }
};

var toggleInstructions = function () {
    $(".instructions").css("display", $(".instructions").css("display") == "none" ? "block" : "none");
    $("#toggle").html("<a href='javascript:toggleInstructions()'>Click here to " + ($(".instructions").css("display") == "none" ? "show" : "hide") + " the instructions.</a>");
};

var cookieSaved = function () {
    return listCookies().contains("tiers") || listCookies().contains("settings") || listCookies().contains("order") || listCookies().contains("gameTiers") || listCookies().contains("gameOrder");
};

var allowCookies = function () {
    if (!cookieSaved()) {
        return confirm("This will store a cookie file on your device. Do you allow this?");
    } else {
        return true;
    }
};

var saveTiersCookie = function () {
    if (isMobile()) {
        emptyModal();
    }

    setCookie("tiers", JSON.stringify(tiers));
    setCookie("order", JSON.stringify(order));
    setCookie("gameTiers", JSON.stringify(gameTiers));
    setCookie("gameOrder", JSON.stringify(gameOrder));
    $("#msg_container").html("<strong style='color:green'>Tier list(s) saved!</strong>");
    window.onbeforeunload = undefined;
};

var saveTiers = function () {
    if (isMobile() && !cookieSaved()) {
        emptyModal();
        $("#mobile_modal").html("<h3>Save Tiers</h3><p>This will store a cookie file on your device. Do you allow this?</p>");
        $("#mobile_modal").append("<input type='button' value='Yes' onClick='saveTiersCookie()' style='margin: 10px'>");
        $("#mobile_modal").append("<input type='button' value='No' onClick='emptyModal()' style='margin: 10px'>");
        $("#mobile_modal").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    if (!allowCookies()) {
        return;
    }

    saveTiersCookie();
};

var saveSettingsCookie = function () {
    if (isMobile()) {
        emptyModal();
    }

    setCookie("settings", JSON.stringify(settings));
    $("#msg_container").html("<strong style='color:green'>Settings saved!</strong>");
    window.onbeforeunload = undefined;
}

var saveSettingsPre = function () {
    if (isMobile() && !cookieSaved()) {
        emptyModal();
        $("#mobile_modal").html("<h3>Save Settings</h3><p>This will store a cookie file on your device. Do you allow this?</p>");
        $("#mobile_modal").append("<input type='button' value='Yes' onClick='saveSettingsCookie()' style='margin: 10px'>");
        $("#mobile_modal").append("<input type='button' value='No' onClick='emptyModal()' style='margin: 10px'>");
        $("#mobile_modal").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    if (!allowCookies()) {
        return;
    }

    saveSettingsCookie();
};

// Mobile-only
var modalInformation = function () {
    emptyModal();
    $("#mobile_modal").html("<h3>Acknowledgements</h3>" + $("#credits").html() +
    "<h3>Instructions</h3>" + $("#instructions").html());
    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

// Mobile-only
var menu = function () {
    emptyModal();
    $("#mobile_modal").html("<h3>Menu</h3>" + $("#menu").html() + "<h3>Navigation</h3>" +
    "<a href='/'><img src='favicon.ico' class='ico-32' alt='Index icon'> Index</a>" +
    "<a href='scoring'><img src='scoring/spell.ico' class='ico-32' alt='Spell Card icon'> Scoring</a>" +
    "<a href='survival'><img src='survival/survival.ico' class='ico-32' alt='1up Item icon'> Survival</a>" +
    "<a href='drc'><img src='drc/power.ico' alt='Power icon'> DRC</a>" +
    "<a href='tools'><img src='tools/ufo.ico' class='ico-32' alt='UFO icon'> Tools</a>" +
    "<a href='wr'><img src='wr/point.ico' alt='Point Item icon'> WR</a>" +
    "<a href='lnn'><img src='lnn/full.ico' class='ico-32' alt='Full Power icon'> LNN</a>" +
    "<a href='thvote'><img src='thvote/tou-32.ico' class='ico-32' alt='Tou kanji icon'> Poll</a>" +
    "<a href='jargon'><img src='jargon/bomb.ico' alt='Bomb icon'> Jargon</a>" +
    "<a href='trs'><img src='trs/shinto.png' alt='Shinto shrine icon'> TRS</a>" +
    "<strong><img src='tiers/castle.png' alt='Japanese castle icon'> Tiers</a></strong>");
    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

var checkSort = function (text) {
    var i, j, characters;

    for (i = 0; i < text.length; i++) {
        if (text[i].contains(':')) {
            continue;
        }

        if (text[i].charAt(0) == '#') {
            continue;
        }

        if (text[i] !== "") {
            characters = text[i].split(',');

            for (j = 0; j < characters.length; j++) {
                if (isCharacter(characters[j].removeSpaces())) {
                    return "characters";
                } else {
                    return "works";
                }
            }
        }
    }
};

var load = function () {
    var text = $("#import").val().split('\n'), noDisplay = true, counter = -1, tierList, tierSort, characters, i, j;

    tierSort = checkSort(text);

    if (tierSort != settings.sort) {
        $("#text_conversion").html("");
        $("#modal").css("display", "none");
        $("#text_conversion").css("display", "none");
        $("#msg_container").html("<strong style='color:orange'>Cannot import characters into works or vice versa!</strong>");
        return;
    }

    $("#import_msg_container").html("<strong style='color:orange'>Please watch warmly as your tier list is imported...</strong>");

    tierList = (settings.sort == "characters" ? tiers : gameTiers);

    for (tierNum in tierList) {
        removeTier(tierNum, true);
    }

    if (settings.sort == "characters") {
        order = [];
    } else {
        gameOrder = [];
    }

    for (i = 0; i < text.length; i++) {
        if (text[i].contains(':')) {
            addTier(text[i].replace(':', ""));
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

            for (j = 0; j < characters.length; j++) {
                if (characters[j] == "Mai") { // fix legacy name
                    characters[j] = "Mai PC-98";
                }

                addToTier(characters[j].removeSpaces(), counter);
            }
        }
    }

    $("#text_conversion").html("");
    $("#modal").css("display", "none");
    $("#text_conversion").css("display", "none");
    $("#msg_container").html("<strong style='color:green'>Tier list successfully imported!</strong>");
};

var importText = function () {
    var tierNum, character, i;

    emptyModal();
    $("#text_conversion").html("<h2>Import from Text</h2><p>Note that the format should be the same as the exported text.</p>");
    $("#text_conversion").append("<p><strong>Warning:</strong> Importing will overwrite your current tier list!");
    $("#text_conversion").append("<textarea id='import'></textarea><p><input type='button' value='Import' onClick='load()'></p>");
    $("#text_conversion").append("<p id='import_msg_container'></p>");
    $("#text_conversion").css("display", "block");
    $("#modal").css("display", "block");
};

var copyToClipboard = function () {
    navigator.clipboard.writeText($("#text").html().replace(/<\/p><p>/g, "\n").strip());
    emptyModal();
    $("#msg_container").html("<strong style='color:green'>Copied to clipboard!</strong>");
    window.onbeforeunload = undefined;
};

var exportText = function () {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder), tierNum, character, i, j;

    emptyModal();
    $("#text_conversion").html("<h2>Export to Text</h2><p id='text'></p>");
    $("#text_conversion").append("<p><input type='button' value='Copy to Clipboard' onClick='copyToClipboard()'></p>");

    for (i = 0; i < tierOrder.length; i++) {
        tierNum = tierOrder[i];

        if (!tierList[tierNum].flag) {
            $("#text").append("<p>" + tierList[tierNum].name +
            ":</p><p>" + tierList[tierNum].bg + " " + tierList[tierNum].colour + "</p><p>");

            for (j = 0; j < tierList[tierNum].chars.length; j++) {
                character = $("#" + tierList[tierNum].chars[j]).attr("alt");
                $("#text").append(character + (j == tierList[tierNum].chars.length - 1 ? "" : ", "));
            }

            $("#text").append("</p>");
        }
    }

    if ($("#text").html() === "") {
        $("#msg_container").html("<strong style='color:orange'>Error: there are no tiers to export.</strong>");
        $("#text_conversion").html("");
        return;
    }

    $("#text_conversion").css("display", "block");
    $("#modal").css("display", "block");
};

var customiseMenu = function () {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder), tierNum, i;

    emptyModal();
    $("#customisation").html("<div><h2>Tier Customisation</h2></div><div id='custom_tier_container'>");

    for (i = 0; i < tierOrder.length; i++) {
        tierNum = tierOrder[i];

        if (!tierList[tierNum].flag) {
            $("#custom_tier_container").append("<p><strong>" + tierList[tierNum].name + "</strong></p>");
            $("#custom_tier_container").append("<p class='name'><label for='custom_name_tier" + tierNum +
            "'>Name</label><input id='custom_name_tier" + tierNum + "' type='text' value='" + tierList[tierNum].name + "'></p>");
            $("#custom_tier_container").append("<p class='colour'><label for='custom_bg_tier" + tierNum +
            "'>Background Colour</label><input id='custom_bg_tier" + tierNum + "' type='color' value='" + tierList[tierNum].bg + "'>");
            $("#custom_tier_container").append("<label for='custom_colour_tier" + tierNum +
            "'>Text Colour</label><input id='custom_colour_tier" + tierNum + "' type='color' value='" + tierList[tierNum].colour + "'></p>");
        }
    }

    if ($("#custom_tier_container").html() === "") {
        $("#msg_container").html("<strong style='color:orange'>Error: there are no tiers to customise.</strong>");
        $("#customisation").html("");
        return;
    }

    $("#customisation").append("</div><div><p><input type='button' value='Save Changes' onClick='saveCustom()'></p><p id='custom_msg_container'></p></div>");
    $("#customisation").css("display", "block");
    $("#modal").css("display", "block");
};

var saveCustom = function () {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), tierNum, tierName, tierColour;

    cancelOngoingSwap();

    for (tierNum in tierList) {
        if (!tierList[tierNum].flag) {
            tierName = $("#custom_name_tier" + tierNum).val().strip().replace(/'/g, "");
            tierBg = $("#custom_bg_tier" + tierNum).val();
            tierColour = $("#custom_colour_tier" + tierNum).val();

            if (!validateTierName(tierName)) {
                $("#custom_msg_container").html("<strong style='color:orange'>Error: tier names may not exceed " + maxNameLength + " characters.</strong>");
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

    $("#customisation").html("");
    $("#customisation").css("display", "none");
    $("#modal").css("display", "none");
    saveTiers();
};

var settingsMenuChars = function () {
    var categoryName, current = 0, counter = 0;

    emptyModal();
    $("#settings").html("<h2>Settings</h2><div>Use the following art set:<form id='artist_form'></form></div>");
    $("#artist_form").append("<label for='dairi'>Dairi</label><input id='dairi' name='artist' type='radio'" + (settings.artist == "Dairi" ? " checked" : "") + ">");
    $("#artist_form").append("<label for='ruu'>るう</label><input id='ruu' name='artist' type='radio'" + (settings.artist == "Ruu" ? " checked" : "") + ">");
    $("#settings").append("Include characters in the following works of first appearance:<table id='settings_table'><tbody><tr id='settings_tr0'>");
    $("#artist_form").attr("onClick", "toggleArtist()");

    for (categoryName in categories) {
        if (counter > 0 && counter % 5 === 0) {
            counter = 0;
            current += 1;
            $("#settings_table").append("</tr><tr id='settings_tr" + current + "'>");
        }

        $("#settings_tr" + current).append("<td><input id='checkbox_" + categoryName +
        "' type='checkbox'" + (settings.categories[categoryName].enabled ? " checked" : "") +
        " " + ((pc98.contains(categoryName) || categoryName == "Soku") && settings.artist == "Ruu" ? "disabled=true" : "") +
        "><label for='" + categoryName + "'>" + categoryName + "</label></td>");
        counter += 1;
    }

    $("#settings").append("</tr></tbody></table>");
    $("#settings").append("<p><label for='pc-98'>PC-98</label><input id='pc98' type='checkbox' onClick='togglePC98()'" + (settings.pc98Enabled ? " checked" : "") +
    " " + (settings.artist == "Ruu" ? "disabled=true" : "") + "></p>");
    $("#settings").append("<p><label for='windows'>Windows</label><input id='windows' type='checkbox' " +
    "onClick='toggleWindows()'" + (settings.windowsEnabled ? " checked" : "") + "></p>");
    $("#settings").append("<p><label for='male'>Male Characters</label><input id='male' type='checkbox' " +
    "onClick='toggleMale()'" + (settings.maleEnabled ? " checked" : "") + " " + (settings.artist == "Ruu" ? "disabled=true" : "") + "></p>");
    $("#settings").append("<div>Other settings:<p><label for='tierHeaderWidth'>Max tier header width</label>" +
    "<input id='tierHeaderWidth' type='number' value=" + settings.tierHeaderWidth + " min=" + defaultWidth + "></p></div>");
    $("#settings").append("<div><p><input type='button' value='Save Changes' onClick='saveSettings()'></p><p id='settings_msg_container'></p></div>");
    $("#settings").css("display", "block");
    $("#modal").css("display", "block");
};

var settingsMenuWorks = function () {
    var categoryName, current = 0, counter = 0;

    emptyModal();
    $("#settings").html("<h2>Settings</h2>Include works in the following categories:<table id='settings_table'><tbody><tr id='settings_tr0'>");

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

    $("#settings").append("</tr></tbody></table>");
    $("#settings").append("<div>Other settings:<p><label for='tierHeaderWidth'>Max tier header width</label>" +
    "<input id='tierHeaderWidth' type='number' value=" + settings.tierHeaderWidth + " min=" + defaultWidth + "></p></div>");
    $("#settings").append("<div><p><input type='button' value='Save Changes' onClick='saveSettings()'></p><p id='settings_msg_container'></p></div>");
    $("#settings").css("display", "block");
    $("#modal").css("display", "block");
};

var settingsMenu = function () {
    if (settings.sort == "characters") {
        settingsMenuChars();
    } else {
        settingsMenuWorks();
    }
}

var massRemoval = function (removedCategories) {
    var cats = (settings.sort == "characters" ? categories : gameCategories), categoryName, character, i, j;

    $("#settings_msg_container").html("<strong style='color:orange'>Girls are being removed, please wait warmly...</strong>");

    for (i = 0; i < removedCategories.length; i++) {
        categoryName = removedCategories[i];

        if (isCategory(categoryName)) { // remove category
            for (j in categories[categoryName].chars) {
                character = categories[categoryName].chars[j].removeSpaces();

                if (isTiered(character)) {
                    removeFromTier(character, getTierNumOf(character));
                }
            }
        } else { // remove male character
            character = categoryName;
            removeFromTier(character, getTierNumOf(character));
        }
    }
};

var togglePC98 = function () {
    for (var i = 0; i < pc98.length; i++) {
        $("#checkbox_" + pc98[i]).prop("checked", $("#pc98").is(":checked") ? true : false);
    }
};

var toggleWindows = function () {
    for (var i = 0; i < windows.length; i++) {
        $("#checkbox_" + windows[i]).prop("checked", $("#windows").is(":checked") ? true : false);
    }
};

var toggleMale = function () {
    $("#checkbox_Soku").prop("checked", $("#male").is(":checked") ? true : false);
};

var toggleArtist = function () {
    var i;

    $("#pc98").attr("disabled", $("#ruu").is(":checked"));
    $("#male").attr("disabled", $("#ruu").is(":checked"));
    $("#checkbox_Soku").attr("disabled", $("#ruu").is(":checked"));

    for (i = 0; i < pc98.length; i++) {
        if ($("#ruu").is(":checked")) {
            $("#checkbox_" + pc98[i]).prop("checked", false);
        }

        $("#checkbox_" + pc98[i]).attr("disabled", $("#ruu").is(":checked"));
    }

    if ($("#ruu").is(":checked")) {
        $("#pc98").prop("checked", false);
        $("#male").prop("checked", false);
        $("#checkbox_Soku").prop("checked", false);
    }
};

var saveSettings = function () {
    var cats = (settings.sort == "characters" ? categories : gameCategories), removedCategories = [], categoryName, item, confirmation, i;

    for (categoryName in cats) {
        if (settings.sort == "characters") {
            settings.categories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");
        } else {
            settings.gameCategories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");
        }

        // check if any disabled characters are in tiers or being held
        if (!$("#checkbox_" + categoryName).is(":checked")) {
            for (i in cats[categoryName].chars) {
                item = cats[categoryName].chars[i].removeSpaces();

                if (isTiered(item)) {
                    removedCategories.push(categoryName);
                }
            }
        }

        window.onbeforeunload = function () { return confirm(); };
    }

    // male characters also trigger confirmation window
    if (settings.sort == "characters" && !$("#male").is(":checked")) {
        for (i in maleCharacters) {
            if (isTiered(maleCharacters[i])) {
                removedCategories.push(maleCharacters[i]);
            }
        }
    }

    if (removedCategories.length > 0) {
        confirmation = confirm("This will remove characters from disabled categories from the current tiers. Are you sure you want to do that?");

        if (isMobile() || confirmation) {
            massRemoval(removedCategories);
        } else {
            return;
        }
    }

    // show or hide categories and male characters based on checkboxes and tieredness
    for (categoryName in cats) {
        if ($("#checkbox_" + categoryName).is(":checked") && !allTiered(categoryName)) {
            $("#" + categoryName).css("display", "block");
        } else {
            $("#" + categoryName).css("display", "none");
        }
    }

    if (settings.sort == "characters") {
        for (i in maleCharacters) {
            if ($("#male").is(":checked") && !isTiered(maleCharacters[i])) {
                $("#" + maleCharacters[i]).css("display", "inline");
            } else {
                $("#" + maleCharacters[i]).css("display", "none");
            }
        }

        // check if artist changed
        if ($("#dairi").is(":checked") && settings.artist != "Dairi") {
            for (categoryName in categories) {
                for (i in categories[categoryName].chars) {
                    character = categories[categoryName].chars[i].removeSpaces();
                    $("#" + character).attr("src", $("#" + character).attr("src").replace("Ruu", "Dairi").replace("jpg", "png"));
                }
            }
        } else if ($("#ruu").is(":checked") && settings.artist != "Ruu") {
            for (categoryName in categories) {
                for (i in categories[categoryName].chars) {
                    character = categories[categoryName].chars[i].removeSpaces();
                    $("#" + character).attr("src", $("#" + character).attr("src").replace("Dairi", "Ruu").replace("png", "jpg"));
                }
            }
        }

        settings.artist = $("#dairi").is(":checked") ? "Dairi" : "Ruu";
        settings.pc98Enabled = $("#pc98").is(":checked");
        settings.windowsEnabled = $("#windows").is(":checked");
        settings.maleEnabled = $("#male").is(":checked");
    }

    settings.tierHeaderWidth = $("#tierHeaderWidth").val() > defaultWidth ? $("#tierHeaderWidth").val() : defaultWidth;
    $(".tier_header").css("max-width", settings.tierHeaderWidth + "px");
    $("#settings").html("");
    $("#settings").css("display", "none");
    $("#modal").css("display", "none");
    saveSettingsCookie();
};

var toggleTierView = function () {
    if (isMobile()) {
        tierView = !tierView;
        $("#tier_list_container").css("display", tierView ? "block" : "none");
        $("#characters").css("display", tierView ? "none" : "block");
        $("#hide").val(tierView ? "Picker View" : "Tier List View");
    } else {
        $("#msg_container").html("");
        $("#characters").css("display", tierView ? "block" : "none");
        $("#buttons").css("display", tierView ? "block" : "none");
        tierView = !tierView;
        $("#show").css("display", tierView ? "block" : "none");
        $("#wrap").css("max-height", tierView ? "100%" : "77%");
        $("#wrap").css("width", tierView ? "auto" : "48%");
        $("#wrap").css("bottom", tierView ? "5px" : "");
        $("#wrap").css("left", tierView ? "5px" : "");
    }
};

var eraseAllConfirmed = function () {
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
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true }, "LLS": { enabled: true }, "MS": { enabled: true },
            "EoSD": { enabled: true }, "PCB": { enabled: true }, "IaMP": { enabled: true }, "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true },
            "SWR": { enabled: true }, "SA": { enabled: true }, "UFO": { enabled: true }, "Soku": { enabled: true }, "DS": { enabled: true }, "GFW": { enabled: true },
            "TD": { enabled: true }, "HM": { enabled: true }, "DDC": { enabled: true }, "ULiL": { enabled: true }, "LoLK": { enabled: true }, "AoCF": { enabled: true },
            "HSiFS": { enabled: true }, "Manga": { enabled: true }, "CD": { enabled: true }
        },
        "gameCategories": {
            "PC-98": { enabled: true }, "Classic": { enabled: true }, "Modern1": { enabled: true }, "Modern2": { enabled: true },
            "Manga": { enabled: true }, "Books": { enabled: true }, "CDs": { enabled: true }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierHeaderWidth": defaultWidth,
        "artist": "Dairi",
        "sort": tmp
    };

    deleteCookie("order");
    deleteCookie("tiers");
    deleteCookie("gameOrder");
    deleteCookie("gameTiers");
    deleteCookie("settings");
    initialise();
    $("#msg_container").html("<strong style='color:green'>Reset the tier list and settings to their default states!</strong>");
    window.onbeforeunload = undefined;
};

var eraseAll = function () {
    var confirmation;

    if (isMobile()) {
        emptyModal();
        $("#mobile_modal").html("<h3>Reset</h3><p>Are you sure you want to reset your tier list and settings to the defaults?</p>");
        $("#mobile_modal").append("<input type='button' value='Yes' onClick='eraseAllConfirmed(); emptyModal()' style='margin: 10px'>");
        $("#mobile_modal").append("<input type='button' value='No' onClick='emptyModal()' style='margin: 10px'>");
        $("#mobile_modal").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    confirmation = confirm("Are you sure you want to reset your tier list and settings to the defaults?");

    if (confirmation) {
        eraseAllConfirmed();
    }
};

var drag = function (event) {
    following = event.target.id;
};

var allowDrop = function (event) {
    event.preventDefault();
};

var drop = function (event) {
    var tierNum;

    event.preventDefault();

    if (event.target.id.substring(0, 2) == "th" || event.target.id.substring(0, 4) == "tier") {
        tierNum = Number(event.target.id.replace("th", "").replace("tier", "").replace(/_\d+/, ""));

        if (isTiered(following)) {
            changeToTier(following, tierNum);
        } else {
            addToTier(following, tierNum);
        }
    } else if (isTiered(event.target.id)) {
        if (isTiered(following)) {
            swapCharacters(following, event.target.id);
        } else {
            addToTier(following, getTierNumOf(event.target.id), getPositionOf(event.target.id));
        }
    } else if ((isItem(event.target.id) || isCategory(event.target.id) || event.target.id == "characters") && isTiered(following)) {
        removeFromTier(following, getTierNumOf(following));
    }

    following = "";
}

var loadTier = function (tiersCookie, tierNum, tierSort) {
    var tierList = (tierSort == "characters" ? tiers : gameTiers), character;

    tierList[tierNum] = {};
    tierList[tierNum].name = tiersCookie[tierNum].name;
    tierList[tierNum].bg = tiersCookie[tierNum].bg;
    tierList[tierNum].colour = tiersCookie[tierNum].colour;
    tierList[tierNum].chars = [];
    tierList[tierNum].flag = tiersCookie[tierNum].flag;

    if (!tierList[tierNum].flag) {
        if (tierSort == settings.sort) {
            $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
            "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum + ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
            "); return false;' style='color: " + tierList[tierNum].colour + "; background-color: " + tierList[tierNum].bg +
            ";'>" + tiersCookie[tierNum].name + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");

            for (i = 0; i < tiersCookie[tierNum].chars.length; i++) {
                character = tiersCookie[tierNum].chars[i];

                if (character == "Mai") { // fix legacy name
                    character = "Mai PC-98";
                }

                if (isMobile()) {
                    $("#" + character).attr("onClick", "");
                }

                addToTier(character, tierNum);
            }
        } else {
            for (i = 0; i < tiersCookie[tierNum].chars.length; i++) {
                character = tiersCookie[tierNum].chars[i];

                if (character == "Mai") { // fix legacy name
                    character = "Mai PC-98";
                }

                if (isMobile()) {
                    $("#" + character).attr("onClick", "");
                }

                tierList[tierNum].chars.pushStrict(character);
            }
        }
    }
};

var loadTiersFromCookie = function () {
    var orderCookie = JSON.parse(getCookie("order")), tiersCookie = JSON.parse(getCookie("tiers")),
        gameOrderCookie = JSON.parse(getCookie("gameOrder")), gameTiersCookie = JSON.parse(getCookie("gameTiers")), tierNum, i;

    if (orderCookie) {
        order = orderCookie;

        for (i = 0; i < order.length; i++) {
            tierNum = order[i];
            loadTier(tiersCookie, tierNum, "characters");
        }
    } else {
        for (tierNum in tiersCookie) {
            tierNum = Number(tierNum);
            loadTier(tiersCookie, tierNum, "characters");
            order.push(tierNum);
        }
    }

    if (gameOrderCookie) {
        gameOrder = gameOrderCookie;

        for (i = 0; i < gameOrder.length; i++) {
            tierNum = gameOrder[i];
            loadTier(gameTiersCookie, tierNum, "works");
        }
    } else {
        for (tierNum in gameTiersCookie) {
            tierNum = Number(tierNum);
            loadTier(gameTiersCookie, tierNum, "works");
            gameOrder.push(tierNum);
        }
    }
};

var loadCharacters = function () {
    var categoryName, character, i;

    for (categoryName in categories) {
        $("#characters").append("<div id='" + categoryName + "'>");

        for (i in categories[categoryName].chars) {
            character = categories[categoryName].chars[i];

            if (isMobile()) {
                $("#" + categoryName).append("<span id='" + character.removeSpaces() + "C'><img id='" + character.removeSpaces() +
                "' class='list' onClick='addMenu(\"" + character + "\")' src='art/" + settings.artist +
                "/" + categoryName + "/" + character.removeSpaces() + "." + (settings.artist == "Dairi" ? "png" : "jpg") +
                "' alt='" + character + "'>");
            } else {
                $("#" + categoryName).append("<span id='" + character.removeSpaces() + "C'><img id='" + character.removeSpaces() +
                "' class='list'  onDblClick='addToMostRecent(\"" + character.removeSpaces() + "\")' draggable='true' " +
                "onDragStart='drag(event)' src='art/" + settings.artist + "/" + categoryName + "/" + character.removeSpaces() +
                "." + (settings.artist == "Dairi" ? "png" : "jpg") + "' alt='" + character + "' title='" + character + "'>");
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
};

var acronym = function (game) {
    var acronym = "", array = game.split(/[ -\.]/);

    if (game == "Touhou Hisoutensoku") {
        return "soku";
    } else if (game == "Retrospective 53 minutes") {
        return "r53m";
    } else if (array.contains("The")) {
        array.remove("The");
    }

    for (i = 0; i < array.length; i++) {
        acronym += array[i].charAt(0);
    }

    return acronym.toLowerCase();
};

var loadWorks = function () {
    var categoryName, game, i;

    for (categoryName in gameCategories) {
        $("#characters").append("<div id='" + categoryName + "'>");

        for (i in gameCategories[categoryName].chars) {
            game = gameCategories[categoryName].chars[i].replace("'", "");

            if (isMobile()) {
                $("#" + categoryName).append("<span id='" + game.removeSpaces() + "C'><img id='" + game.removeSpaces() +
                "' class='list' onClick='addMenu(\"" + game + "\")' src='games/" + acronym(game) +
                ".jpg' alt='" + game + "'>");
            } else {
                $("#" + categoryName).append("<span id='" + game.removeSpaces() + "C'><img id='" + game.removeSpaces() +
                "' class='list'  onDblClick='addToMostRecent(\"" + game.removeSpaces() + "\")' draggable='true' " +
                "onDragStart='drag(event)' src='games/" + acronym(game) +
                ".jpg' alt='" + game + "' title='" + game + "'>");
            }
        }

        $("#characters").append("</div>");

        if (!settings.gameCategories[categoryName].enabled) {
            $("#" + categoryName).css("display", "none");
        }
    }
};

var loadItems = function () {
    if (settings.sort == "characters") {
        loadCharacters();
    } else {
        loadWorks();
    }
};

var loadSettingsFromCookie = function () {
    var settingsCookie = JSON.parse(getCookie("settings")), category;

    if (settingsCookie.hasOwnProperty("categories")) { // new cookie
        for (category in settingsCookie.categories) {
            settings.categories[category].enabled = settingsCookie.categories[category].enabled;
        }

        if (settingsCookie.hasOwnProperty("gameCategories")) {
            for (category in settingsCookie.gameCategories) {
                settings.gameCategories[category].enabled = settingsCookie.gameCategories[category].enabled;
            }
        }

        settings.pc98Enabled = settingsCookie.pc98Enabled;
        settings.windowsEnabled = settingsCookie.windowsEnabled;
        settings.maleEnabled = settingsCookie.maleEnabled;
        settings.tierHeaderWidth = (settingsCookie.tierHeaderWidth ? settingsCookie.tierHeaderWidth : defaultWidth);
        settings.artist = settingsCookie.artist;
        settings.sort = settingsCookie.sort;
    } else { // legacy cookie
        for (category in settingsCookie) {
            if (category == "Other") {
                settings.categories["Manga"].enabled = settingsCookie[category].enabled;
                settings.categories["CD"].enabled = settingsCookie[category].enabled;
            } else {
                settings.categories[category].enabled = settingsCookie[category].enabled;
            }
        }
    }
};

// Mobile-only
var applyMobileCSS = function () {
    $("#sort_selection").css("display", "none");
    $(".instructions").css("display", "block");
    $("#instructions_list").html("<li>Tap a character to add them to a tier.</li>" +
    "<li>Long press a character in a tier to either remove them from that tier, " +
    "move them to the back of the tier, or move them a tier up or down.</li>" +
    "<li>Tap a tier and then another tier to swap their positions.</li>" +
    "<li>Long press a tier to either remove it, remove all its characters, or add all remaining characters to it.</li>");
    $("#information_button").html("<input type='button' value='Information' onClick='modalInformation()'>");
    $("#view_button").html($("#hide"));
    $("#mobile_button_split").html("<br>");
    $("#menu_button").html("<input type='button' value='Menu' onClick='menu()'>");
    $("#switch_button").html("<input type='button' value='Switch Mode' onClick='switchSort()'>");
    $("#tier_list_container").css("display", "none");
    $("#instructions").css("display", "none");
    $("#credits").css("display", "none");
    $("#menu").css("display", "none");
    $("p").css("margin", "2px");
    $("h1").css("margin", "5px");
    $("h1").css("font-size", "28px");
    $("#title").css("display", isLandscape() ? "none" : "block");
    $("#wrap").css("font", "12px verdana, sans-serif");
    $("#characters").css("font", "12px verdana, sans-serif");
    $("#buttons").css("font", "12px verdana, sans-serif");
    $("#show").css("font", "12px verdana, sans-serif");
    $("input[type=button]").css("width", "48%");
    $("input[type=button]").css("height", "25px");
    $("input[type=button]").css("font-size", "12px");
    $("#toggle").css("display", "none");
    $("#buttons").css("max-width", "98%");
    $("#buttons").css("padding-top", "5px");
    $("#buttons").css("left", "5px");
    $("#buttons").css("height", isLandscape() ? "22%" : "16%");
    $("#buttons").css("min-height", "50px");
    $("#characters").css("width", "auto");
    $("#characters").css("top", isLandscape() ? "2%" : "50px");
    $("#characters").css("right", "5px");
    $("#characters").css("bottom", isLandscape() ? "25%" : "18%");
    $("#tier_list_container").css("bottom", "100px");
    $("#tier_list_container").css("max-height", "71%");
    $("#tier_list_container").css("overflow-y", "auto");
    $("#tier_list_container").css("border", "1px solid black");
    $(".tier_header").css("width", "60px");
    $(".tier_header").css("height", "60px");
    $("#tier_list_thead").html($("#tier_list_tfoot").html());
    $("#tier_list_tfoot").remove();
    $("#add_tier_box").attr("colspan", "2");
    $("#tier_name").css("width", "auto");
    $("#add_tier").css("width", "auto");
    $(".list").css("width", "60px");
    $(".list").css("height", "60px");
    $(".tiered").css("width", "60px");
    $(".tiered").css("height", "60px");
    $("#nav").css("display", "none");
    $("#wrap").css("top", "5px");
    $("#wrap").css("bottom", "5px");
    $("#wrap").css("right", "5px");
    $("#wrap").css("left", "5px");
    $("#wrap").css("width", "auto");
    $("#wrap").css("height", "100%");
    $("#wrap").css("max-height", "100%");
    $("#modal").css("padding-top", isLandscape() ? "2%" : "10%");
};

// Mobile-Only
var checkHeight = function () {
    if (isMobile()) {
        if (window.innerHeight < 100) {
            $("#buttons").css("display", "none");
        } else {
            $("#buttons").css("display", "block");
        }
    }

    updateOrientation();
}

// Mobile-only
var updateOrientation = function () {
    if (isMobile()) {
        $("#title").css("display", isLandscape() ? "none" : "block");
        $("#buttons").css("height", isLandscape() ? "22%" : "16%");
        $("#characters").css("top", isLandscape() ? "2%" : "50px");
        $("#characters").css("bottom", isLandscape() ? "25%" : "18%");
        $("#modal").css("padding-top", isLandscape() ? "2%" : "10%");
    }
};

$(document).ready(function () {
    $.get("https://maribelhearn.github.io/json/chars.json", function (data1) {
        $.get("https://maribelhearn.github.io/json/works.json", function (data2) {
            categories = data1;
            gameCategories = data2;

            try {
                loadSettingsFromCookie();
            } catch (error) {
                // do nothing
            }

            $("#sort").val(settings.sort);
            loadItems();

            try {
                loadTiersFromCookie();
                mostRecentTiers["characters"] = -1;
                mostRecentTiers["works"] = -1;
            } catch (error) {
                initialise();
            }

            window.onbeforeunload = undefined;

            if (isMobile()) {
                applyMobileCSS();
        	}
        });
    });
});
