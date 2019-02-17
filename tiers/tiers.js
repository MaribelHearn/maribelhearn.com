var categories,
    defaultWidth = (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) ? 60 : 120,
    settings = {
        "categories": {
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true }, "LLS": { enabled: true }, "MS": { enabled: true },
            "EoSD": { enabled: true }, "PCB": { enabled: true }, "IaMP": { enabled: true }, "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true },
            "SWR": { enabled: true }, "SA": { enabled: true }, "UFO": { enabled: true }, "Soku": { enabled: true }, "DS": { enabled: true }, "GFW": { enabled: true },
            "TD": { enabled: true }, "HM": { enabled: true }, "DDC": { enabled: true }, "ULiL": { enabled: true }, "LoLK": { enabled: true }, "AoCF": { enabled: true },
            "HSiFS": { enabled: true }, "Manga": { enabled: true }, "CD": { enabled: true }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierHeaderWidth": defaultWidth,
        "artist": "Dairi"
    },
    windows = ["EoSD", "PCB", "IaMP", "IN", "PoFV", "MoF", "SWR", "SA", "UFO", "Soku", "DS", "GFW", "TD", "HM", "DDC", "ULiL", "LoLK", "AoCF", "HSiFS"],
    maleCharacters = ["SinGyokuM", "Genjii", "Unzan", "RinnosukeMorichika", "FortuneTeller"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"],
    tiers = {},
    order = [],
    maxTiers = 20,
    maxNameLength = 30,
    following = "",
    tierView = false,
    swapOngoing = -1;

var isMobile = function () {
    return navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1;
};

var isLandscape = function () {
    return window.orientation == -90 || window.orientation == 90 || screen.width > screen.height;
};

var isCharacter = function (character) {
    return character !== "" && JSON.stringify(categories).removeSpaces().contains(character);
};

var isCategory = function (category) {
    return category !== "" && Object.keys(categories).contains(category);
};

var isTiered = function (character) {
    return character !== "" && JSON.stringify(tiers).contains(character.removeSpaces());
};

var tierHeaderHeight = function () {
    return isMobile() ? 60 : 120;
};

var allTiered = function (categoryName) {
    for (var i = 0; i < categories[categoryName].chars.length; i++) {
        if (!isTiered(categories[categoryName].chars[i].removeSpaces())) {
            return false;
        }
    }

    return true;
};

var getTierNumOf = function (character) {
    var tierNum, i;

    for (tierNum in tiers) {
        for (i = 0; i < tiers[tierNum].chars.length; i++) {
            if (tiers[tierNum].chars[i] == character) {
                return Number(tierNum);
            }
        }
    }

    return false;
};

var getPositionOf = function (character) {
    return Number($("#" + character).parent().attr("id").split("_")[1]);
};

var getCategoryOf = function (character) {
    var categoryName;

    for (categoryName in categories) {
        if (JSON.stringify(categories[categoryName].chars).removeSpaces().contains(character)) {
            return categoryName;
        }
    }

    return false;
}

var updateArrays = function () {
    var tierNum, id, i;

    for (tierNum in tiers) {
        id = "#tier" + tierNum + "_";

        for (i = 0; i < tiers[tierNum].chars.length; i++) {
            if ($(id + i).children().length > 0) {
                tiers[tierNum].chars[i] = $(id + i).children()[0].id;
            }
        }
    }
};

var addToTier = function (character, tierNum, pos) {
    var categoryName = getCategoryOf(character), id, i;

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
        $("#tier" + tierNum).append("<span id='" + id + tiers[tierNum].chars.length + "'></span>");

        for (i = tiers[tierNum].chars.length; i > (pos + 1); i--) {
            $("#" + id + i).html($("#" + id + (i - 1)).html());
        }

        $("#" + id + (pos + 1)).html($("#" + character));
        tiers[tierNum].chars.pushStrict(character);
        updateArrays();
    // add to the back (default)
    } else {
        id = "tier" + tierNum + "_" + tiers[tierNum].chars.length;
        $("#tier" + tierNum).append("<span id='" + id + "'></span>");
        $("#" + id).html($("#" + character));
        tiers[tierNum].chars.pushStrict(character);
    }

    window.onbeforeunload = function () { return confirm(); };

    // check for category emptiness
    for (i in categories[categoryName].chars) {
        if (!isTiered(categories[categoryName].chars[i])) {
            return;
        }
    }

    $("#" + categoryName).css("display", "none");
};

// Mobile-Only
var addToTierMobile = function (character, tierNum) {
    $("#" + character.removeSpaces()).attr("onClick", "");
    addToTier(character.removeSpaces(), tierNum);
    emptyModal();
    $("#msg_container").html("<strong style='color:green'>Added " + character + " to " + tiers[tierNum].name + "!</strong>");
}

// Mobile-only
var addMenu = function (character) {
    var tierNum, i;

    emptyModal();
    $("#mobile_modal").html("<h3>" + character + "</h3><p>Add to tier:</p>");

    for (i = 0; i < order.length; i++) {
        tierNum = order[i];

        if (!tiers[tierNum].flag) {
            $("#mobile_modal").append("<input type='button' value='" + tiers[tierNum].name +
            "' onClick='addToTierMobile(\"" + character + "\", " + tierNum + ")' " +
            "style='min-width: 25px; height: 25px; margin: 10px'>");
        }
    }

    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

var moveToBack = function (character, tierNum) {
    var help = $("#" + character);

    for (counter = getPositionOf(character); counter + 1 < tiers[tierNum].chars.length; counter++) {
        $("#tier" + tierNum + "_" + counter).html($("#tier" + tierNum + "_" + (counter + 1)).html());
    }

    $("#msg_container").html("");
    $("#tier" + tierNum + "_" + (tiers[tierNum].chars.length - 1)).html(help);
    updateArrays();
    window.onbeforeunload = function () { return confirm(); };
};

var removeFromTier = function (character, tierNum) {
    var pos, counter;

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
        for (counter = pos + 1; counter < tiers[tierNum].chars.length; counter++) {
            $("#tier" + tierNum + "_" + (counter - 1)).html($("#tier" + tierNum + "_" + counter).html());
        }

        $("#tier" + tierNum + "_" + (tiers[tierNum].chars.length - 1)).remove();
        tiers[tierNum].chars.remove(character);
    }

    if (isMobile()) {
        $("#msg_container").html("<strong style='color:green'>Removed " + $("#" + character).attr("alt") +
        " from " + tiers[tierNum].name + "!</strong>");
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
    var above, below;

    emptyModal();
    $("#mobile_modal").html("<h3>" + character + "</h3><input type='button' value='Remove' onClick='removeFromTier(\"" + character +
    "\", " + tierNum + "); emptyModal()' style='margin:10px'>");

    if (order.indexOf(tierNum) !== 0) {
        above = order[order.indexOf(tierNum) - 1];
        $("#mobile_modal").append("<input type='button' value='Move Up' onClick='changeToTier(\"" + character +
        "\", " + above + "); emptyModal()' style='margin:10px'>");
    }

    if (order.indexOf(tierNum) != order.length - 1) {
        below = order[order.indexOf(tierNum) + 1];
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

var addTier = function (tierName) {
    var tierNum = 0, otherTierNum;

    $("#msg_container").html("");

    // get an unused tier ID
    while (tiers[tierNum] && !tiers[tierNum].flag) {
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
    $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
    "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum + ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
    "); return false;' style='max-width:" + settings.tierHeaderWidth + "px" + (isMobile() ? ";height:60px" : "") + "'>" + tierName +
    "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr><hr>");
    tiers[tierNum] = {};
    tiers[tierNum].name = tierName;
    tiers[tierNum].bg = "#1b232e";
    tiers[tierNum].colour = "#a0a0a0";
    tiers[tierNum].chars = [];
    tiers[tierNum].flag = false;
    order.push(tierNum);

    // if tier swap ongoing, set onClick to swapTiers
    if (swapOngoing >= 0) {
        $("#th" + tierNum).attr("onClick", "swapTiers(" + swapOngoing + ", " + tierNum + ")");
    }

    window.onbeforeunload = function () { return confirm(); };
};

var startTierSwap = function (tierNum) {
    var tierName = $("#th" + tierNum).html(), invertedColour = new RGBColor(tiers[tierNum].colour),
        invertedBg = new RGBColor(tiers[tierNum].bg), otherTierNum;

    $("#th" + tierNum).css("color", "rgb(" + (255 - invertedColour.r) + ", " + (255 - invertedColour.g) + ", " + (255 - invertedColour.b) + ")");
    $("#th" + tierNum).css("background-color", "rgb(" + (255 - invertedBg.r) + ", " + (255 - invertedBg.g) + ", " + (255 - invertedBg.b) + ")");
    swapOngoing = tierNum;

    for (otherTierNum in tiers) {
        $("#th" + otherTierNum).attr("onClick", "swapTiers(" + tierNum + ", " + otherTierNum + ")");
    }
};

var swapTiers = function (tierNum1, tierNum2) {
    var tmp = tiers[tierNum1], tierNum;

    $("#th" + tierNum1).attr("style", "color: " + tiers[tierNum2].colour + "; background-color: " + tiers[tierNum2].bg +
    "; max-width: " + settings.tierHeaderWidth + "px; width: " + settings.tierHeaderWidth + "px; height: " + tierHeaderHeight() + "px;");
    $("#th" + tierNum2).attr("style", "color: " + tiers[tierNum1].colour + "; background-color: " + tiers[tierNum1].bg +
    "; max-width: " + settings.tierHeaderWidth + "px; width: " + settings.tierHeaderWidth + "px; height: " + tierHeaderHeight() + "px;");
    tiers[tierNum1] = tiers[tierNum2];
    tiers[tierNum2] = tmp;
    tmp = $("#th" + tierNum1).html();
    $("#th" + tierNum1).html($("#th" + tierNum2).html());
    $("#th" + tierNum2).html(tmp);
    tmp = $("#tier" + tierNum1).html();
    $("#tier" + tierNum1).html($("#tier" + tierNum2).html());
    $("#tier" + tierNum2).html(tmp);
    swapOngoing = -1;

    for (tierNum in tiers) {
        $("#th" + tierNum).attr("onClick", "detectLeftCtrlCombo(event, " + tierNum + ")");
    }

    window.onbeforeunload = function () { return confirm(); };
};

var removeCharacters = function (tierNum) {
    while (tiers[tierNum].chars.length > 0) {
        removeFromTier(tiers[tierNum].chars[0], tierNum);
    }
};

var cancelOngoingSwap = function () {
    var tierNum;

    if (swapOngoing >= 0) {
        for (tierNum in tiers) {
            $("#th" + tierNum).attr("onClick", "detectLeftCtrlCombo(event, " + tierNum + ")");
        }

        swapOngoing = -1;
    }
};

var removeTier = function (tierNum, skipConfirmation) {
    var length = tiers[tierNum].chars.length, confirmation = true, otherTierNum, i;

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
        tiers[tierNum].flag = true;
        order.remove(tierNum);
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
    var categoryName, character, i;

    for (categoryName in categories) {
        if (settings.categories[categoryName].enabled) {
            for (i = 0; i < categories[categoryName].chars.length; i++) {
                character = categories[categoryName].chars[i].removeSpaces();

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
    emptyModal();
    $("#mobile_modal").html("<h3>" + tiers[tierNum].name + "</h3>");
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
    return listCookies().contains("tiers") || listCookies().contains("settings");
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
    $("#msg_container").html("<strong style='color:green'>Tier list saved!</strong>");
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

var saveSettings = function () {
    if (isMobile() && !cookieSaved()) {
        emptyModal();
        $("#mobile_modal").html("<h3>Save Tiers</h3><p>This will store a cookie file on your device. Do you allow this?</p>");
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
var modalInstructions = function () {
    emptyModal();
    $("#mobile_modal").html("<h3>Instructions</h3>" + $("#instructions").html());
    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

// Mobile-only
var modalCredits = function () {
    emptyModal();
    $("#mobile_modal").html("<h3>Acknowledgements</h3>" + $("#credits").html());
    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

// Mobile-only
var menu = function () {
    emptyModal();
    $("#mobile_modal").html("<h3>Menu</h3>" + $("#menu").html());
    $("#mobile_modal").css("display", "block");
    $("#modal").css("display", "block");
};

var load = function () {
    var text = $("#import").val().split('\n'), counter = -1, tierToAdd, i, j;

    $("#import_msg_container").html("<strong style='color:orange'>Please watch warmly as your tier list is imported...</strong>");

    for (tierNum in tiers) {
        removeTier(tierNum, true);
    }

    order = [];
    tiers = {};

    for (i = 0; i < text.length; i++) {
        if (text[i].contains(':')) {
            addTier(text[i].replace(':', ""));
            counter += 1;
            i += 1;
        }

        if (text[i].charAt(0) == '#') {
            tiers[counter].bg = text[i].split(' ')[0];
            tiers[counter].colour = text[i].split(' ')[1];
            $("#th" + counter).css("background-color", tiers[counter].bg);
            $("#th" + counter).css("color", tiers[counter].colour);
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
    var tierNum, character, i, j;

    emptyModal();
    $("#text_conversion").html("<h2>Export to Text</h2><p id='text'></p>");
    $("#text_conversion").append("<p><input type='button' value='Copy to Clipboard' onClick='copyToClipboard()'></p>");

    for (i = 0; i < order.length; i++) {
        tierNum = order[i];

        if (!tiers[tierNum].flag) {
            $("#text").append("<p>" + tiers[tierNum].name +
            ":</p><p>" + tiers[tierNum].bg + " " + tiers[tierNum].colour + "</p><p>");

            for (j = 0; i < tiers[tierNum].chars.length; j++) {
                character = $("#" + tiers[tierNum].chars[i]).attr("alt");
                $("#text").append(character + (j == tiers[tierNum].chars.length - 1 ? "" : ", "));
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
    var tierNum, i;

    emptyModal();
    $("#customisation").html("<div><h2>Tier Customisation</h2></div><div id='custom_tier_container'>");

    for (i = 0; i < order.length; i++) {
        tierNum = order[i];

        if (!tiers[tierNum].flag) {
            $("#custom_tier_container").append("<p><strong>" + tiers[tierNum].name + "</strong></p>");
            $("#custom_tier_container").append("<p class='name'><label for='custom_name_tier" + tierNum +
            "'>Name</label><input id='custom_name_tier" + tierNum + "' type='text' value='" + tiers[tierNum].name + "'></p>");
            $("#custom_tier_container").append("<p class='colour'><label for='custom_bg_tier" + tierNum +
            "'>Background Colour</label><input id='custom_bg_tier" + tierNum + "' type='color' value='" + tiers[tierNum].bg + "'>");
            $("#custom_tier_container").append("<label for='custom_colour_tier" + tierNum +
            "'>Text Colour</label><input id='custom_colour_tier" + tierNum + "' type='color' value='" + tiers[tierNum].colour + "'></p>");
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
    var tierNum, tierName, tierColour;

    cancelOngoingSwap();

    for (tierNum in tiers) {
        if (!tiers[tierNum].flag) {
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
            tiers[tierNum].name = tierName;
            tiers[tierNum].bg = tierBg;
            tiers[tierNum].colour = tierColour;
        }
    }

    $("#customisation").html("");
    $("#customisation").css("display", "none");
    $("#modal").css("display", "none");
    saveTiers();
};

var settingsMenu = function () {
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

var massRemoval = function (removedCategories) {
    var categoryName, character, i, j;

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
    var removedCategories = [], categoryName, character, confirmation, i;

    for (categoryName in categories) {
        settings.categories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");

        // check if any disabled characters are in tiers or being held
        if (!$("#checkbox_" + categoryName).is(":checked")) {
            for (i in categories[categoryName].chars) {
                character = categories[categoryName].chars[i].removeSpaces();

                if (isTiered(character)) {
                    removedCategories.push(categoryName);
                }
            }
        }

        window.onbeforeunload = function () { return confirm(); };
    }

    // male characters also trigger confirmation window
    if (!$("#male").is(":checked")) {
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
    for (categoryName in categories) {
        if ($("#checkbox_" + categoryName).is(":checked") && !allTiered(categoryName)) {
            $("#" + categoryName).css("display", "block");
        } else {
            $("#" + categoryName).css("display", "none");
        }
    }

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

    for (tierNum in tiers) {
        removeTier(tierNum, true);
    }

    order = [];
    tiers = {};
    settings = {
        "categories": {
            "Main": { enabled: true }, "HRtP": { enabled: true }, "SoEW": { enabled: true }, "PoDD": { enabled: true }, "LLS": { enabled: true }, "MS": { enabled: true },
            "EoSD": { enabled: true }, "PCB": { enabled: true }, "IaMP": { enabled: true }, "IN": { enabled: true }, "PoFV": { enabled: true }, "MoF": { enabled: true },
            "SWR": { enabled: true }, "SA": { enabled: true }, "UFO": { enabled: true }, "Soku": { enabled: true }, "DS": { enabled: true }, "GFW": { enabled: true },
            "TD": { enabled: true }, "HM": { enabled: true }, "DDC": { enabled: true }, "ULiL": { enabled: true }, "LoLK": { enabled: true }, "AoCF": { enabled: true },
            "HSiFS": { enabled: true }, "Manga": { enabled: true }, "CD": { enabled: true }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierHeaderWidth": defaultWidth,
        "artist": "Dairi"
    };

    deleteCookie("tiers");
    deleteCookie("settings");
    addTier("S");
    addTier("A");
    $("#tier_name").val("B");
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
    } else if ((isCharacter(event.target.id) || isCategory(event.target.id) || event.target.id == "characters") && isTiered(following)) {
        removeFromTier(following, getTierNumOf(following));
    }

    following = "";
}

var loadTier = function (tiersCookie, tierNum) {
    var character;

    tiers[tierNum] = {};
    tiers[tierNum].name = tiersCookie[tierNum].name;
    tiers[tierNum].bg = tiersCookie[tierNum].bg;
    tiers[tierNum].colour = tiersCookie[tierNum].colour;
    tiers[tierNum].chars = [];
    tiers[tierNum].flag = tiersCookie[tierNum].flag;

    if (!tiers[tierNum].flag) {
        $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
        "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum + ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
        "); return false;' style='color: " + tiers[tierNum].colour + "; background-color: " + tiers[tierNum].bg +
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
    }
};

var loadTiersFromCookie = function () {
    var orderCookie = JSON.parse(getCookie("order")), tiersCookie = JSON.parse(getCookie("tiers")), tierNum, i;

    if (orderCookie) {
        order = orderCookie;

        for (i = 0; i < order.length; i++) {
            tierNum = order[i];
            loadTier(tiersCookie, tierNum);
        }
    } else {
        for (tierNum in tiersCookie) {
            tierNum = Number(tierNum);
            loadTier(tiersCookie, tierNum);
            order.push(tierNum);
        }
    }
};

var loadCharacters = function () {
    var insertRight = false, categoryName, character, i;

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
                "' class='list' draggable='true' onDragStart='drag(event)' src='art/" + settings.artist + "/" + categoryName +
                "/" + character.removeSpaces() + "." + (settings.artist == "Dairi" ? "png" : "jpg") +
                "' alt='" + character + "' title='" + character + "'>");
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

var loadSettingsFromCookie = function () {
    var settingsCookie = JSON.parse(getCookie("settings")), category;

    if (settingsCookie.hasOwnProperty("categories")) { // new cookie
        for (category in settingsCookie.categories) {
            settings.categories[category].enabled = settingsCookie.categories[category].enabled;
        }

        settings.pc98Enabled = settingsCookie.pc98Enabled;
        settings.windowsEnabled = settingsCookie.windowsEnabled;
        settings.maleEnabled = settingsCookie.maleEnabled;
        settings.tierHeaderWidth = (settingsCookie.tierHeaderWidth ? settingsCookie.tierHeaderWidth : defaultWidth);
        settings.artist = settingsCookie.artist;
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
    $("#instructions_list").html("<li>Tap a character to add them to a tier.</li>" +
    "<li>Long press a character in a tier to either remove them from that tier, " +
    "move them to the back of the tier, or move them a tier up or down.</li>" +
    "<li>Tap a tier and then another tier to swap their positions.</li>" +
    "<li>Long press a tier to either remove it, remove all its characters, or add all remaining characters to it.</li>");
    $("#instructions_button").html("<input type='button' value='Instructions' onClick='modalInstructions()'>");
    $("#view_button").html($("#hide"));
    $("#mobile_button_split").html("<br>");
    $("#menu_button").html("<input type='button' value='Menu' onClick='menu()'>");
    $("#credits_button").html("<input type='button' value='Acknowledgements' onClick='modalCredits()'>");
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
    $.get("https://maribelhearn.github.io/json/chars.json", function (data) {
        categories = data;

        try {
            loadSettingsFromCookie();
        } catch (error) {
            // do nothing
        }

        loadCharacters();

        try {
            loadTiersFromCookie();
        } catch (error) {
            addTier("S");
            addTier("A");
            $("#tier_name").val("B");
        }

        window.onbeforeunload = undefined;

        if (isMobile()) {
            applyMobileCSS();
    	}
    });
});
