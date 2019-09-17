var categories,
    gameCategories,
    defaultWidth = (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) ? 60 : 120,
    settings = {
        "categories": {
            "Main": {
                enabled: true
            },
            "HRtP": {
                enabled: true
            },
            "SoEW": {
                enabled: true
            },
            "PoDD": {
                enabled: true
            },
            "LLS": {
                enabled: true
            },
            "MS": {
                enabled: true
            },
            "EoSD": {
                enabled: true
            },
            "PCB": {
                enabled: true
            },
            "IaMP": {
                enabled: true
            },
            "IN": {
                enabled: true
            },
            "PoFV": {
                enabled: true
            },
            "MoF": {
                enabled: true
            },
            "SWR": {
                enabled: true
            },
            "SA": {
                enabled: true
            },
            "UFO": {
                enabled: true
            },
            "Soku": {
                enabled: true
            },
            "DS": {
                enabled: true
            },
            "GFW": {
                enabled: true
            },
            "TD": {
                enabled: true
            },
            "HM": {
                enabled: true
            },
            "DDC": {
                enabled: true
            },
            "ULiL": {
                enabled: true
            },
            "LoLK": {
                enabled: true
            },
            "AoCF": {
                enabled: true
            },
            "HSiFS": {
                enabled: true
            },
            "Manga": {
                enabled: true
            },
            "CD": {
                enabled: true
            }
        },
        "gameCategories": {
            "PC-98": { enabled: true }, "Classic": { enabled: true },
            "Modern1": {
                enabled: true
            },
            "Modern2": {
                enabled: true
            },
            "Manga": {
                enabled: true
            },
            "Books": {
                enabled: true
            },
            "CDs": { enabled: true }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierHeaderWidth": defaultWidth,
        "artist": "Dairi",
        "sort": "characters"
    },
    windows = ["EoSD", "PCB", "IaMP", "IN", "PoFV", "MoF", "SWR", "SA", "UFO", "Soku",
    "DS", "GFW", "TD", "HM", "DDC", "ULiL", "LoLK", "AoCF", "HSiFS"],
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
    mostRecentTiers = { "characters": -1, "works": -1 };

function isMobile() {
    return navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1;
}
function isLandscape() {
    return window.orientation == -90 || window.orientation == 90 || screen.width > screen.height;
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
    return item !== "" && JSON.stringify(tierList).contains(item.removeSpaces());
}
function tierHeaderHeight() {
    return isMobile() ? 60 : 120;
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

    for (tierNum in tierList) {
        tierNum = Number(tierNum);
        if (!tierList[tierNum].flag) {
            $("#tier_list_tbody").append("<tr id='tr" + tierNum +
            "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
            "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum +
            ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
            "); return false;' style='color: " + tierList[tierNum].colour +
            "; background-color: " + tierList[tierNum].bg + ";'>" + tierList[tierNum].name +
            "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");

            for (i = 0; i < tierList[tierNum].chars.length; i += 1) {
                item = tierList[tierNum].chars[i];

                if (item == "Mai") {
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
    var noDisplay = true, tmp;
    addTier("S");
    addTier("A");
    tmp = settings.sort;
    settings.sort = (settings.sort == "characters" ? "works" : "characters");
    addTier("S", noDisplay);
    addTier("A", noDisplay);
    settings.sort = tmp;
    $(isMobile() ? "#tier_name_mobile" : "#tier_name").val("B");
}
function switchSort() {
    cancelOngoingSwap();
    $("#characters").html("");
    $("#tier_list_tbody").html("");
    settings.sort = (settings.sort == "characters" ? "works" : "characters");
    loadItems();
    reloadTiers();
    saveSettingsPre();
    $("#msg_container").html("<strong style='color:green'>Switched to " + settings.sort + "!</strong>");
}
function updateArrays() {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierNum, id, i;

    for (tierNum in tierList) {
        id = "#tier" + tierNum + "_";

        for (i = 0; i < tierList[tierNum].chars.length; i += 1) {
            if ($(id + i).children().length > 0) {
                tierList[tierNum].chars[i] = $(id + i).children()[0].id;
            }
        }
    }
}
var addToTier = function (character, tierNum, pos, noDisplay) {
    var cats = (settings.sort == "characters" ? categories : gameCategories),
        tierList = (settings.sort == "characters" ? tiers : gameTiers), categoryName = getCategoryOf(character), id, i;

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

    if (typeof pos == "number") {
        id = "tier" + tierNum + "_";

        if (!noDisplay) {
            $("#tier" + tierNum).append("<span id='" + id + tierList[tierNum].chars.length + "'></span>");

            for (i = tierList[tierNum].chars.length; i > (pos + 1); i -= 1) {
                $("#" + id + i).html($("#" + id + (i - 1)).html());
            }

            $("#" + id + (pos + 1)).html($("#" + character));
        }
        tierList[tierNum].chars.pushStrict(character);
        updateArrays();
    } else {
        id = "tier" + tierNum + "_" + tierList[tierNum].chars.length;

        if (!noDisplay) {
            $("#tier" + tierNum).append("<span id='" + id + "'></span>");
            $("#" + id).html($("#" + character));
        }

        tierList[tierNum].chars.pushStrict(character);
    }

    window.onbeforeunload = function () {
        return confirm()
    };

    for (i in cats[categoryName].chars) {
        if (!isTiered(cats[categoryName].chars[i])) {
            return;
        }
    }

    $("#" + categoryName).css("display", "none");
};
function addToMostRecent(character) {
    if (mostRecentTiers[settings.sort] >= 0) {
        addToTier(character, mostRecentTiers[settings.sort]);
    }
}
function addToTierMobile(character, tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);
    $("#" + character.removeSpaces()).attr("onClick", "");
    addToTier(character.removeSpaces(), tierNum);
    emptyModal();
    $("#msg_container").html("<strong style='color:green'>Added " + character + " to " + tierList[tierNum].name + "!</strong>");
}
var addMenu = function (character) {
    var tierList = (settings.sort == "characters"
            ? tiers
            : gameTiers),
        tierOrder = (settings.sort == "characters"
            ? order
            : gameOrder),
        tierNum,
        i;
    emptyModal();
    $("#modal_inner").html("<h3>" + character + "</h3><p>Add to tier:</p>");
    for (i = 0; i < tierOrder.length; i += 1) {
        tierNum = tierOrder[i];
        if (!tierList[tierNum].flag) {
            $("#modal_inner").append("<input type='button' value='" + tierList[tierNum].name + "' onClick='addToTierMobile(\"" + character + "\", " + tierNum + ")' style='min-width: 25px; height: 25px; margin: 10px'>")
        }
    }
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block")
};
var moveToBack = function (character, tierNum) {
    var tierList = (settings.sort == "characters"
            ? tiers
            : gameTiers),
        help = $("#" + character);
    for (counter = getPositionOf(character); counter + 1 < tierList[tierNum].chars.length; counter += 1) {
        $("#tier" + tierNum + "_" + counter).html($("#tier" + tierNum + "_" + (counter + 1)).html())
    }
    $("#msg_container").html("");
    $("#tier" + tierNum + "_" + (tierList[tierNum].chars.length - 1)).html(help);
    updateArrays();
    window.onbeforeunload = function () {
        return confirm()
    }
};
function removeFromTier(character, tierNum) {
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
        for (counter = pos + 1; counter < tierList[tierNum].chars.length; counter += 1) {
            $("#tier" + tierNum + "_" + (counter - 1)).html($("#tier" + tierNum + "_" + counter).html());
        }

        $("#tier" + tierNum + "_" + (tierList[tierNum].chars.length - 1)).remove();
        tierList[tierNum].chars.remove(character);
    }

    if (isMobile()) {
        $("#msg_container").html("<strong style='color:green'>Removed " + $("#" + character).attr("alt") +
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
            addToTierMobile(character, tierNum);
        } else {
            addToTier(character, tierNum);
        }
    }
}
function modalChar(character, tierNum) {
    var tierOrder = (settings.sort == "characters" ? order : gameOrder), above, below;

    emptyModal();
    $("#modal_inner").html("<h3>" + character + "</h3><input type='button' value='Remove' onClick='removeFromTier(\"" + character +
    "\", " + tierNum + "); emptyModal()' style='margin:10px'>");

    if (tierOrder.indexOf(tierNum) !== 0) {
        above = tierOrder[tierOrder.indexOf(tierNum) - 1];
        $("#modal_inner").append("<input type='button' value='Move Up' onClick='changeToTier(\"" + character +
        "\", " + above + "); emptyModal()' style='margin:10px'>");
    }

    if (tierOrder.indexOf(tierNum) != order.length - 1) {
        below = tierOrder[tierOrder.indexOf(tierNum) + 1];
        $("#modal_inner").append("<input type='button' value='Move Down' onClick='changeToTier(\"" + character +
        "\", " + below + "); emptyModal()' style='margin:10px'>");
    }

    $("#modal_inner").append("<input type='button' value='Move to Back' onClick='moveToBack(\"" + character +
    "\", " + tierNum + "); emptyModal()' style='margin:10px'>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
};
function validateTierName(tierName) {
    return tierName.length <= maxNameLength;
}
function addTier(tierName, noDisplay) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers),
        tierOrder = (settings.sort == "characters" ? order : gameOrder),
        tierNum = 0, otherTierNum;

    $("#msg_container").html("");

    while (tierList[tierNum] && !tierList[tierNum].flag) {
        tierNum += 1;
    }

    if (tierNum >= maxTiers) {
        $("#msg_container").html("<strong style='color:orange'>Error: the number of tiers may not exceed " + maxTiers + ".</strong>");
        return;
    }

    tierName = tierName.strip().replace(/'/g, "");
    $(isMobile() ? "#tier_name_mobile" : "#tier_name").val(tierName);

    if (!tierName || tierName === "") {
        return;
    }

    if (!validateTierName(tierName)) {
        $("#msg_container").html("<strong style='color:orange'>Error: tier names may not exceed " + maxNameLength + " characters.</strong>");
        return;
    }

    if (!noDisplay) {
        $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' onDragOver='allowDrop(event)' onDrop='drop(event)'>" +
        "<th id='th" + tierNum + "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum +
        ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum + "); return false;' " +
        "style='max-width:" + settings.tierHeaderWidth + "px;width:" + settings.tierHeaderWidth +
        "px" + (isMobile() ? ";height:60px" : "") + "'>" + tierName + "</th><td id='tier" + tierNum +
        "' class='tier_content'></td></tr><hr>");
    }

    tierList[tierNum] = {};
    tierList[tierNum].name = tierName;
    tierList[tierNum].bg = "#1b232e";
    tierList[tierNum].colour = "#a0a0a0";
    tierList[tierNum].chars = [];
    tierList[tierNum].flag = false;
    tierOrder.push(tierNum);
    mostRecentTiers[settings.sort] = tierNum;

    if (swapOngoing >= 0) {
        $("#th" + tierNum).attr("onClick", "swapTiers(" + swapOngoing + ", " + tierNum + ")");
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
        $("#th" + otherTierNum).attr("onClick", "swapTiers(" + tierNum + ", " + otherTierNum + ")");
    }
}
function swapTiers(tierNum1, tierNum2) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    var tmp = tierList[tierNum1], tierNum;

    $("#th" + tierNum1).attr("style", "color: " + tierList[tierNum2].colour +
    "; background-color: " + tierList[tierNum2].bg + "; max-width: " + settings.tierHeaderWidth +
    "px; width: " + settings.tierHeaderWidth + "px; height: " + tierHeaderHeight() + "px;");
    $("#th" + tierNum2).attr("style", "color: " + tierList[tierNum1].colour +
    "; background-color: " + tierList[tierNum1].bg + "; max-width: " + settings.tierHeaderWidth +
    "px; width: " + settings.tierHeaderWidth + "px; height: " + tierHeaderHeight() + "px;");
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

    window.onbeforeunload = function () {
        return confirm();
    }
}
function removeCharacters(tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    while (tierList[tierNum].chars.length > 0) {
        removeFromTier(tierList[tierNum].chars[0], tierNum);
    }
}
function cancelOngoingSwap() {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers), tierNum;

    if (swapOngoing >= 0) {
        for (tierNum in tierList) {
            $("#th" + tierNum).attr("onClick", "detectLeftCtrlCombo(event, " + tierNum + ")");
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

    window.onbeforeunload = function () {
        return confirm();
    }
}
var swapCharacters = function (character1, character2) {
    var parent1 = $("#" + character1).parent(),
        parent2 = $("#" + character2).parent(),
        backup = $("#" + character1);
    $(parent1).html($("#" + character2));
    $(parent2).html(backup);
    updateArrays();
    if (isMobile()) {
        $("#" + character1).attr("onContextMenu", "modalChar('" + character1 + "', " + getTierNumOf(character1) + "); return false;");
        $("#" + character2).attr("onContextMenu", "modalChar('" + character2 + "', " + getTierNumOf(character2) + "); return false;")
    } else {
        $("#" + character1).attr("onContextMenu", "removeFromTier('" + character1 + "', " + getTierNumOf(character1) + "); return false;");
        $("#" + character2).attr("onContextMenu", "removeFromTier('" + character2 + "', " + getTierNumOf(character2) + "); return false;")
    }
    window.onbeforeunload = function () {
        return confirm()
    }
};
var emptyModal = function () {
    $("#modal_inner").html("");
    $("#modal_inner").css("display", "none");
    $("#modal").css("display", "none")
};
var closeModal = function (event) {
    var modal = document.getElementById("modal");
    if ((event.target && event.target == modal) || (event.keyCode && event.keyCode == 27)) {
        emptyModal()
    }
};
var quickAdd = function (tierNum) {
    var cats = (settings.sort == "characters"
            ? categories
            : gameCategories),
        categoryName,
        character,
        i;
    for (categoryName in cats) {
        if (settings.sort == "characters" && settings.categories[categoryName].enabled || settings.sort == "works" && settings.gameCategories[categoryName].enabled) {
            for (i = 0; i < cats[categoryName].chars.length; i += 1) {
                character = cats[categoryName]
                    .chars[i]
                    .removeSpaces();
                if (!isTiered(character)) {
                    addToTier(character, tierNum)
                }
            }
        }
    }
};
var detectLeftCtrlCombo = function (event, tierNum) {
    if (event.ctrlKey) {
        quickAdd(tierNum)
    } else {
        startTierSwap(tierNum)
    }
};
var emptyTier = function (tierNum) {
    var confirmation;
    if (isMobile()) {
        removeCharacters(tierNum)
    }
    confirmation = confirm("Are you sure you want to empty this tier? Emptying may take a moment with many c" +
            "haracters inside.");
    if (confirmation) {
        removeCharacters(tierNum)
    }
};
var modalTier = function (tierNum) {
    var tierList = (settings.sort == "characters" ? tiers : gameTiers);

    emptyModal();
    $("#modal_inner").html("<h3>" + tierList[tierNum].name + "</h3>");
    $("#modal_inner").append("<p><input type='button' class='tier_button' value='Remove' onClick='removeTier(" + tierNum + "); emptyModal()'></p>");
    $("#modal_inner").append("<p><input type='button' class='tier_button' value='Add All Characters' onClick='quickAdd(" + tierNum + "); emptyModal()'></p>");
    $("#modal_inner").append("<p><input type='button' class='tier_button' value='Remove All Characters' onClick='emptyTier(" + tierNum + "); emptyModal()'></p>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}
function detectRightCtrlCombo(event, tierNum) {
    if (event.ctrlKey) {
        emptyTier(tierNum);
    } else {
        if (isMobile()) {
            modalTier(tierNum);
        } else {
            removeTier(tierNum);
        }
    }
}
function detectAddTierEnter(event) {
    if (event.keyCode == 13) {
        addTier($(isMobile() ? "#tier_name_mobile" : "#tier_name").val());
    }
}
function toggleInstructions() {
    $("#instructions").css("display", $("#instructions").css("display") == "none" ? "block" : "none");
    $("#toggle").html("<a href='javascript:toggleInstructions()'>Click here to " + ($(".instructions").css("display") == "none" ? "show" : "hide") + " the instructions.</a>")
}
function allowData() {
    if (localStorage.length <= 2) {
        return confirm("This will store data in your browser's Web Storage, which functions like a cookie. Do you allow this?");
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
    $("#msg_container").html("<strong style='color:green'>Tier list(s) saved!</strong>");
    window.onbeforeunload = undefined;
}
function saveTiers() {
    if (isMobile() && localStorage.length <= 2) {
        emptyModal();
        $("#modal_inner").html("<h3>Save Tiers</h3><p>This will store data in your browser's Web Storage, which " +
                "functions like a cookie. Do you allow this?</p>");
        $("#modal_inner").append("<input type='button' value='Yes' onClick='saveTiersData()' style='margin: 10px'>");
        $("#modal_inner").append("<input type='button' value='No' onClick='emptyModal()' style='margin: 10px'>");
        $("#modal_inner").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    if (!allowData()) {
        return;
    }

    saveTiersData();
};
var saveSettingsData = function () {
    if (isMobile()) {
        emptyModal();
    }

    localStorage.setItem("settings", JSON.stringify(settings));
    $("#msg_container").html("<strong style='color:green'>Settings saved!</strong>");
    window.onbeforeunload = undefined;
};
var saveSettingsPre = function () {
    if (isMobile() && localStorage.length <= 2) {
        emptyModal();
        $("#modal_inner").html("<h3>Save Settings</h3><p>This will store data in your browser's Web Storage, whi" +
                "ch functions like a cookie. Do you allow this?</p>");
        $("#modal_inner").append("<input type='button' value='Yes' onClick='saveSettingsData()' style='margin: 10p" +
                "x'>");
        $("#modal_inner").append("<input type='button' value='No' onClick='emptyModal()' style='margin: 10px'>");
        $("#modal_inner").css("display", "block");
        $("#modal").css("display", "block");
        return;
    }

    if (!allowData()) {
        return;
    }

    saveSettingsData();
};
function modalInformation() {
    emptyModal();
    $("#modal_inner").html("<h3>Acknowledgements</h3>" + $("#credits").html() +
    "<h3>Instructions</h3>" + $("#instructions_mobile").html() + "<br>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}
function menu() {
    emptyModal();
    $("#modal_inner").html("<h3>Menu</h3>" + $("#menu").html() + "<h3>Navigation</h3><a href='/'><img src='favicon.ico' alt='Index icon'> Index</a" +
            "><a href='scoring'><img src='assets/scoring/spell.ico' alt='Spell Card icon'> Sc" +
            "oring</a><a href='survival'><img src='assets/survival/survival.ico' alt='1up Ite" +
            "m icon'> Survival</a><a href='drc'><img src='assets/drc/power.ico' alt='Power ic" +
            "on'> DRC</a><a href='tools'><img src='assets/tools/ufo.ico' alt='UFO icon'> Tool" +
            "s</a><a href='wr'><img src='assets/wr/point.ico' alt='Point Item icon'> WR</a><a" +
            " href='lnn'><img src='assets/lnn/full.ico' alt='Full Power icon'> LNN</a><a href" +
            "='thvote'><img src='assets/thvote/tou-32.ico' alt='Tou kanji icon'> Poll</a><a h" +
            "ref='jargon'><img src='assets/jargon/bomb.ico' alt='Bomb icon'> Jargon</a><a hre" +
            "f='trs'><img src='assets/trs/shinto.png' alt='Shinto shrine icon'> TRS</a><stron" +
            "g><img src='assets/tiers/castle.png' alt='Japanese castle icon'> Tiers</a></stro" +
            "ng>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}
var checkSort = function (text) {
    var i,
        j,
        characters;
    for (i = 0; i < text.length; i += 1) {
        if (text[i].contains(':')) {
            continue
        }
        if (text[i].charAt(0) == '#') {
            continue
        }
        if (text[i] !== "") {
            characters = text[i].split(',');
            for (j = 0; j < characters.length; j += 1) {
                if (isCharacter(characters[j].removeSpaces())) {
                    return "characters"
                } else {
                    return "works"
                }
            }
        }
    }
};
var load = function () {
    var text = $("#import")
            .val()
            .split('\n'),
        noDisplay = true,
        counter = -1,
        tierList,
        tierSort,
        characters,
        i,
        j;
    tierSort = checkSort(text);
    if (tierSort != settings.sort) {
        $("#modal_inner").html("");
        $("#modal").css("display", "none");
        $("#modal_inner").css("display", "none");
        $("#msg_container").html("<strong style='color:orange'>Cannot import characters into works or vice versa!<" +
                "/strong>");
        return
    }
    $("#import_msg_container").html("<strong style='color:orange'>Please watch warmly as your tier list is imported.." +
            ".</strong>");
    tierList = (settings.sort == "characters"
        ? tiers
        : gameTiers);
    for (tierNum in tierList) {
        removeTier(tierNum, true)
    }
    if (settings.sort == "characters") {
        order = []
    } else {
        gameOrder = []
    }
    for (i = 0; i < text.length; i += 1) {
        if (text[i].contains(':')) {
            addTier(text[i].replace(':', ""));
            counter += 1;
            i += 1
        }
        if (text[i].charAt(0) == '#') {
            tierList[counter].bg = text[i].split(' ')[0];
            tierList[counter].colour = text[i].split(' ')[1];
            $("#th" + counter).css("background-color", tierList[counter].bg);
            $("#th" + counter).css("color", tierList[counter].colour);
            i += 1
        }
        if (text[i] !== "") {
            characters = text[i].split(',');
            for (j = 0; j < characters.length; j += 1) {
                if (characters[j] == "Mai") {
                    characters[j] = "Mai PC-98"
                }
                addToTier(characters[j].removeSpaces(), counter)
            }
        }
    }
    $("#modal_inner").html("");
    $("#modal").css("display", "none");
    $("#modal_inner").css("display", "none");
    $("#msg_container").html("<strong style='color:green'>Tier list successfully imported!</strong>")
};
var importText = function () {
    var tierNum,
        character,
        i;
    emptyModal();
    $("#modal_inner").html("<h2>Import from Text</h2><p>Note that the format should be the same as the expor" +
            "ted text.</p>");
    $("#modal_inner").append("<p><strong>Warning:</strong> Importing will overwrite your current tier list!");
    $("#modal_inner").append("<textarea id='import'></textarea><p><input type='button' value='Import' onClick=" +
            "'load()'></p>");
    $("#modal_inner").append("<p id='import_msg_container'></p>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block")
};
function copyToClipboard() {
    navigator.clipboard.writeText($("#text").html().replace(/<\/p><p>/g, "\n").strip());
    emptyModal();
    $("#msg_container").html("<strong style='color:green'>Copied to clipboard!</strong>");
    window.onbeforeunload = undefined;
}
var exportText = function () {
    var tierList = (settings.sort == "characters"
            ? tiers
            : gameTiers),
        tierOrder = (settings.sort == "characters"
            ? order
            : gameOrder),
        tierNum,
        character,
        i,
        j;
    emptyModal();
    $("#modal_inner").html("<h2>Export to Text</h2><p id='text'></p>");
    $("#modal_inner").append("<p><input type='button' value='Copy to Clipboard' onClick='copyToClipboard()'></" +
            "p>");
    for (i = 0; i < tierOrder.length; i += 1) {
        tierNum = tierOrder[i];
        if (!tierList[tierNum].flag) {
            $("#text").append("<p>" + tierList[tierNum].name + ":</p><p>" + tierList[tierNum].bg + " " + tierList[tierNum].colour + "</p><p>");
            for (j = 0; j < tierList[tierNum].chars.length; j += 1) {
                character = $("#" + tierList[tierNum].chars[j]).attr("alt");
                $("#text").append(character + (j == tierList[tierNum].chars.length - 1
                    ? ""
                    : ", "))
            }
            $("#text").append("</p>")
        }
    }
    if ($("#text").html() === "") {
        $("#msg_container").html("<strong style='color:orange'>Error: there are no tiers to export.</strong>");
        $("#modal_inner").html("");
        return
    }
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block")
};
var customiseMenu = function () {
    var tierList = (settings.sort == "characters"
            ? tiers
            : gameTiers),
        tierOrder = (settings.sort == "characters"
            ? order
            : gameOrder),
        tierNum,
        i;
    emptyModal();
    $("#modal_inner").html("<div><h2>Tier Customisation</h2></div><div id='custom_tier_container'>");
    for (i = 0; i < tierOrder.length; i += 1) {
        tierNum = tierOrder[i];
        if (!tierList[tierNum].flag) {
            $("#custom_tier_container").append("<p><strong>" + tierList[tierNum].name + "</strong></p>");
            $("#custom_tier_container").append("<p class='name'><label for='custom_name_tier" + tierNum + "'>Name</label><input id='custom_name_tier" + tierNum + "' type='text' value='" + tierList[tierNum].name + "'></p>");
            $("#custom_tier_container").append("<p class='colour'><label for='custom_bg_tier" + tierNum + "'>Background Colour</label><input id='custom_bg_tier" + tierNum + "' type='color' value='" + tierList[tierNum].bg + "'>");
            $("#custom_tier_container").append("<label for='custom_colour_tier" + tierNum + "'>Text Colour</label><input id='custom_colour_tier" + tierNum + "' type='color' value='" + tierList[tierNum].colour + "'></p>")
        }
    }
    if ($("#custom_tier_container").html() === "") {
        $("#msg_container").html("<strong style='color:orange'>Error: there are no tiers to customise.</strong>");
        $("#modal_inner").html("");
        return
    }
    $("#modal_inner").append("</div><div><p><input type='button' value='Save Changes' onClick='saveCustom()'><" +
            "/p><p id='custom_msg_container'></p></div>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block")
};
var saveCustom = function () {
    var tierList = (settings.sort == "characters"
            ? tiers
            : gameTiers),
        tierNum,
        tierName,
        tierColour;
    cancelOngoingSwap();
    for (tierNum in tierList) {
        if (!tierList[tierNum].flag) {
            tierName = $("#custom_name_tier" + tierNum)
                .val()
                .strip()
                .replace(/'/g, "");
            tierBg = $("#custom_bg_tier" + tierNum).val();
            tierColour = $("#custom_colour_tier" + tierNum).val();
            if (!validateTierName(tierName)) {
                $("#custom_msg_container").html("<strong style='color:orange'>Error: tier names may not exceed " + maxNameLength + " characters.</strong>");
                return
            }
            $("#th" + tierNum).html(tierName);
            $("#th" + tierNum).css("background-color", tierBg);
            $("#th" + tierNum).css("color", tierColour);
            tierList[tierNum].name = tierName;
            tierList[tierNum].bg = tierBg;
            tierList[tierNum].colour = tierColour
        }
    }
    $("#modal_inner").html("");
    $("#modal_inner").css("display", "none");
    $("#modal").css("display", "none");
    saveTiers()
};
var settingsMenuChars = function () {
    var categoryName,
        current = 0,
        counter = 0;
    emptyModal();
    $("#modal_inner").html("<h2>Settings</h2><div>Use the following art set:<form id='artist_form'></form></" +
            "div>");
    $("#artist_form").append("<label for='dairi'>Dairi</label><input id='dairi' name='artist' type='radio'" + (settings.artist == "Dairi"
        ? " checked"
        : "") + ">");
    $("#artist_form").append("<label for='ruu'>るう</label><input id='ruu' name='artist' type='radio'" + (settings.artist == "Ruu"
        ? " checked"
        : "") + ">");
    $("#modal_inner").append("Include characters in the following works of first appearance:<table id='setting" +
            "s_table'><tbody><tr id='settings_tr0'>");
    $("#artist_form").attr("onClick", "toggleArtist()");
    for (categoryName in categories) {
        if (counter > 0 && counter % 5 === 0) {
            counter = 0;
            current += 1;
            $("#settings_table").append("</tr><tr id='settings_tr" + current + "'>")
        }
        $("#settings_tr" + current).append("<td><input id='checkbox_" + categoryName + "' type='checkbox'" + (settings.categories[categoryName].enabled
            ? " checked"
            : "") + " " + ((pc98.contains(categoryName) || categoryName == "Soku") && settings.artist == "Ruu"
            ? "disabled=true"
            : "") + "><label for='" + categoryName + "'>" + categoryName + "</label></td>");
        counter += 1
    }
    $("#modal_inner").append("</tr></tbody></table>");
    $("#modal_inner").append("<p><label for='pc-98'>PC-98</label><input id='pc98' type='checkbox' onClick='tog" +
            "glePC98()'" + (settings.pc98Enabled
        ? " checked"
        : "") + " " + (settings.artist == "Ruu"
        ? "disabled=true"
        : "") + "></p>");
    $("#modal_inner").append("<p><label for='windows'>Windows</label><input id='windows' type='checkbox' onCli" +
            "ck='toggleWindows()'" + (settings.windowsEnabled
        ? " checked"
        : "") + "></p>");
    $("#modal_inner").append("<p><label for='male'>Male Characters</label><input id='male' type='checkbox' onC" +
            "lick='toggleMale()'" + (settings.maleEnabled
        ? " checked"
        : "") + " " + (settings.artist == "Ruu"
        ? "disabled=true"
        : "") + "></p>");
    $("#modal_inner").append("<div>Other settings:<p><label for='tierHeaderWidth'>Max tier header width</label" +
            "><input id='tierHeaderWidth' type='number' value=" + settings.tierHeaderWidth + " min=" + defaultWidth + "></p></div>");
    $("#modal_inner").append("<div><p><input type='button' value='Save Changes' onClick='saveSettings()'></p><" +
            "p id='settings_msg_container'></p></div>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block")
};
var settingsMenuWorks = function () {
    var categoryName,
        current = 0,
        counter = 0;
    emptyModal();
    $("#modal_inner").html("<h2>Settings</h2>Include works in the following categories:<table id='settings_t" +
            "able'><tbody><tr id='settings_tr0'>");
    for (categoryName in gameCategories) {
        if (counter > 0 && counter % 5 === 0) {
            counter = 0;
            current += 1;
            $("#settings_table").append("</tr><tr id='settings_tr" + current + "'>")
        }
        $("#settings_tr" + current).append("<td><input id='checkbox_" + categoryName + "' type='checkbox'" + (settings.gameCategories[categoryName].enabled
            ? " checked"
            : "") + "><label for='" + categoryName + "'>" + categoryName + "</label></td>");
        counter += 1
    }
    $("#modal_inner").append("</tr></tbody></table>");
    $("#modal_inner").append("<div>Other settings:<p><label for='tierHeaderWidth'>Max tier header width</label" +
            "><input id='tierHeaderWidth' type='number' value=" + settings.tierHeaderWidth + " min=" + defaultWidth + "></p></div>");
    $("#modal_inner").append("<div><p><input type='button' value='Save Changes' onClick='saveSettings()'></p><" +
            "p id='settings_msg_container'></p></div>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block")
};
function settingsMenu() {
    if (settings.sort == "characters") {
        settingsMenuChars();
    } else {
        settingsMenuWorks();
    }
}
var massRemoval = function (removedCategories) {
    var cats = (settings.sort == "characters"
            ? categories
            : gameCategories),
        categoryName,
        character,
        i,
        j;
    $("#settings_msg_container").html("<strong style='color:orange'>Girls are being removed, please wait warmly...</str" +
            "ong>");
    for (i = 0; i < removedCategories.length; i += 1) {
        categoryName = removedCategories[i];
        if (isCategory(categoryName)) {
            for (j in categories[categoryName].chars) {
                character = categories[categoryName]
                    .chars[j]
                    .removeSpaces();
                if (isTiered(character)) {
                    removeFromTier(character, getTierNumOf(character))
                }
            }
        } else {
            character = categoryName;
            removeFromTier(character, getTierNumOf(character))
        }
    }
};
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
function toggleArtist() {
    var i;

    $("#pc98").attr("disabled", $("#ruu").is(":checked"));
    $("#male").attr("disabled", $("#ruu").is(":checked"));
    $("#checkbox_Soku").attr("disabled", $("#ruu").is(":checked"));

    for (i = 0; i < pc98.length; i += 1) {
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
}
function saveSettings() {
    var cats = (settings.sort == "characters" ? categories : gameCategories),
        removedCategories = [], categoryName, item, confirmation, i;

    for (categoryName in cats) {
        if (settings.sort == "characters") {
            settings.categories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");
        } else {
            settings.gameCategories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");
        }

        if (!$("#checkbox_" + categoryName).is(":checked")) {
            for (i in cats[categoryName].chars) {
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
        for (i in maleCharacters) {
            if ($("#male").is(":checked") && !isTiered(maleCharacters[i])) {
                $("#" + maleCharacters[i]).css("display", "inline");
            } else {
                $("#" + maleCharacters[i]).css("display", "none");
            }
        }

        if ($("#dairi").is(":checked") && settings.artist != "Dairi") {
            for (categoryName in categories) {
                for (i in categories[categoryName].chars) {
                    character = categories[categoryName]
                        .chars[i]
                        .removeSpaces();
                    $("#" + character).attr("src", $("#" + character).attr("src").replace("Ruu", "Dairi").replace("jpg", "png"))
                }
            }
        } else if ($("#ruu").is(":checked") && settings.artist != "Ruu") {
            for (categoryName in categories) {
                for (i in categories[categoryName].chars) {
                    character = categories[categoryName]
                        .chars[i]
                        .removeSpaces();
                    $("#" + character).attr("src", $("#" + character).attr("src").replace("Dairi", "Ruu").replace("png", "jpg"))
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
    }
}
function changeLog() {
    emptyModal();
    $("#modal_inner").html("<h2>Changelog</h2><ul style='text-align:left'><li>05/12/2018: Initial release</li>" +
    "<li>05/12/2018: Dairi art added and made the default; PC-98 and male characters added</li>" +
    "<li>21/01/2019: Mobile version</li><li>24/04/2019: Works added</li><li>18/08/2019: Migrated to maribelhearn.com</li>" +
    "<li>17/09/2019: Mobile version bugs fixed and speed increased; changelog added</li></ul>");
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}
function eraseAllConfirmed() {
    var tierNum;
    if (settings.sort == "characters") {
        for (tierNum in tiers) {
            removeTier(tierNum, true)
        }
    }
    if (settings.sort == "works") {
        for (tierNum in gameTiers) {
            removeTier(tierNum, true)
        }
    }
    order = [];
    tiers = {};
    gameOrder = [];
    gameTiers = {};
    tmp = settings.sort;
    settings = {
        "categories": {
            "Main": {
                enabled: true
            },
            "HRtP": {
                enabled: true
            },
            "SoEW": {
                enabled: true
            },
            "PoDD": {
                enabled: true
            },
            "LLS": {
                enabled: true
            },
            "MS": {
                enabled: true
            },
            "EoSD": {
                enabled: true
            },
            "PCB": {
                enabled: true
            },
            "IaMP": {
                enabled: true
            },
            "IN": {
                enabled: true
            },
            "PoFV": {
                enabled: true
            },
            "MoF": {
                enabled: true
            },
            "SWR": {
                enabled: true
            },
            "SA": {
                enabled: true
            },
            "UFO": {
                enabled: true
            },
            "Soku": {
                enabled: true
            },
            "DS": {
                enabled: true
            },
            "GFW": {
                enabled: true
            },
            "TD": {
                enabled: true
            },
            "HM": {
                enabled: true
            },
            "DDC": {
                enabled: true
            },
            "ULiL": {
                enabled: true
            },
            "LoLK": {
                enabled: true
            },
            "AoCF": {
                enabled: true
            },
            "HSiFS": {
                enabled: true
            },
            "Manga": {
                enabled: true
            },
            "CD": {
                enabled: true
            }
        },
        "gameCategories": {
            "PC-98": {
                enabled: true
            },
            "Classic": {
                enabled: true
            },
            "Modern1": {
                enabled: true
            },
            "Modern2": {
                enabled: true
            },
            "Manga": {
                enabled: true
            },
            "Books": {
                enabled: true
            },
            "CDs": {
                enabled: true
            }
        },
        "pc98Enabled": true,
        "windowsEnabled": true,
        "maleEnabled": true,
        "tierHeaderWidth": defaultWidth,
        "artist": "Dairi",
        "sort": tmp
    };
    localStorage.removeItem("order");
    localStorage.removeItem("tiers");
    localStorage.removeItem("gameOrder");
    localStorage.removeItem("gameTiers");
    localStorage.removeItem("settings");
    initialise();
    $("#msg_container").html("<strong style='color:green'>Reset the tier list and settings to their default st" +
            "ates!</strong>");
    window.onbeforeunload = undefined;
}
function eraseAll() {
    var confirmation;

    if (isMobile()) {
        emptyModal();
        $("#modal_inner").html("<h3>Reset</h3><p>Are you sure you want to reset your tier list and settings to t" +
                "he defaults?</p>");
        $("#modal_inner").append("<input type='button' value='Yes' onClick='eraseAllConfirmed(); emptyModal()' sty" +
                "le='margin: 10px'>");
        $("#modal_inner").append("<input type='button' value='No' onClick='emptyModal()' style='margin: 10px'>");
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
            $("#tier_list_tbody").append("<tr id='tr" + tierNum +
            "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
            "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum +
            ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
            "); return false;' style='color: " + tierList[tierNum].colour +
            "; background-color: " + tierList[tierNum].bg + ";'>" + tiersData[tierNum].name +
            "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");

            for (i = 0; i < tiersData[tierNum].chars.length; i += 1) {
                character = tiersData[tierNum].chars[i];

                if (character == "Mai") {
                    character = "Mai PC-98";
                }

                if (isMobile()) {
                    $("#" + character).attr("onClick", "");
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
                    $("#" + character).attr("onClick", "");
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
                "C'><img id='" + character.removeSpaces() + "' class='list' onClick='addMenu(\"" + character +
                "\")' src='art/" + settings.artist + "/" + categoryName + "/" + character.removeSpaces() +
                "." + (settings.artist == "Dairi" ? "png" : "jpg") + "' alt='" + character + "'>");
            } else {
                $("#" + categoryName).append("<span id='" + character.removeSpaces() +
                "C'><img id='" + character.removeSpaces() + "' class='list' " +
                "onDblClick='addToMostRecent(\"" + character.removeSpaces() + "\")' draggable='true' onDragStart='drag(event)' " +
                "src='art/" + settings.artist + "/" + categoryName + "/" + character.removeSpaces() +
                "." + (settings.artist == "Dairi" ? "png" : "jpg") + "' alt='" + character + "' title='" + character + "'>");
            }

            if (maleCharacters.contains(character.removeSpaces()) && !settings.maleEnabled) {
                $("#" + character.removeSpaces()).css("display", "none")
            }
        }

        $("#characters").append("</div>");

        if (!settings.categories[categoryName].enabled) {
            $("#" + categoryName).css("display", "none")
        }
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
};
function loadWorks() {
    var categoryName, game, i;

    for (categoryName in gameCategories) {
        $("#characters").append("<div id='" + categoryName + "'>");
        for (i in gameCategories[categoryName].chars) {
            game = gameCategories[categoryName].chars[i].replace("'", "");

            if (isMobile()) {
                $("#" + categoryName).append("<span id='" + game.removeSpaces() +
                "C'><img id='" + game.removeSpaces() + "' class='list' onClick='addMenu(\"" + game +
                "\")' src='games/" + acronym(game) + "120x120.jpg' alt='" + game + "'>");
            } else {
                $("#" + categoryName).append("<span id='" + game.removeSpaces() +
                "C'><img id='" + game.removeSpaces() + "' class='list'  onDblClick='addToMostRecent(\"" + game.removeSpaces() +
                "\")' draggable='true' onDragStart='drag(event)' src='games/" + acronym(game) +
                "120x120.jpg' alt='" + game + "' title='" + game + "'>");
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
                settings.gameCategories[category].enabled = settingsData.gameCategories[category].enabled;
            }
        }

        settings.pc98Enabled = settingsData.pc98Enabled;
        settings.windowsEnabled = settingsData.windowsEnabled;
        settings.maleEnabled = settingsData.maleEnabled;
        settings.tierHeaderWidth = (settingsData.tierHeaderWidth ? settingsData.tierHeaderWidth : defaultWidth);
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
function checkHeight() {
    if (isMobile()) {
        $("#buttons").css("display", window.innerHeight < 100 ? "none" : "block");
    }
}
$(document).ready(function () {
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

    if (location.protocol == "file:") {
        var path = location.pathname.split('/').pop();

        $("#nav a").attr("href", function (i, oldHref) {
            return (oldHref == '/' ? location.href.replace(path, "index.html") + "" : oldHref + ".html");
        });
    }

    $.get("https://maribelhearn.com/json/chars.json", function (data1) {
        $.get("https://maribelhearn.com/json/works.json", function (data2) {
            categories = data1;
            gameCategories = data2;

            if (localStorage.settings) {
                loadSettingsFromStorage();
            }

            $("#sort").val(settings.sort);
            loadItems();

            if (localStorage.tiers || localStorage.gameTiers) {
                loadTiersFromStorage();
                mostRecentTiers["characters"] = -1;
                mostRecentTiers["works"] = -1;
            } else {
                initialise();
            }

            window.onbeforeunload = undefined;
        });
    });
});
