var categories = {
        "Main": {
            "enabled": true,
            "chars": ["Reimu Hakurei", "Marisa Kirisame"]
        },
        "EoSD": {
            "enabled": true,
            "chars": ["Rumia", "Daiyousei", "Cirno", "Hong Meiling", "Koakuma", "Patchouli Knowledge", "Sakuya Izayoi", "Remilia Scarlet", "Flandre Scarlet"]
        },
        "PCB": {
            "enabled": true,
            "chars": ["Letty Whiterock", "Chen", "Alice Margatroid", "Lily White", "Lyrica Prismriver", "Lunasa Prismriver",
            "Merlin Prismriver", "Youmu Konpaku", "Yuyuko Saigyouji", "Ran Yakumo", "Yukari Yakumo"]
        },
        "IaMP": {
            "enabled": true,
            "chars": ["Suika Ibuki"]
        },
        "IN": {
            "enabled": true,
            "chars": ["Wriggle Nightbug", "Mystia Lorelei", "Keine Kamishirasawa", "Tewi Inaba", "Reisen Udongein Inaba", "Eirin Yagokoro", "Kaguya Houraisan", "Fujiwara no Mokou"]
        },
        "PoFV": {
            "enabled": true,
            "chars": ["Aya Shameimaru", "Medicine Melancholy", "Yuuka Kazami", "Komachi Onozuka", "Eiki Shiki Yamaxanadu"]
        },
        "MoF": {
            "enabled": true,
            "chars": ["Shizuha Aki", "Minoriko Aki", "Hina Kagiyama", "Nitori Kawashiro", "Momiji Inubashiri", "Sanae Kochiya", "Kanako Yasaka", "Suwako Moriya"]
        },
        "SWR": {
            "enabled": true,
            "chars": ["Iku Nagae", "Tenshi Hinanawi"]
        },
        "SA": {
            "enabled": true,
            "chars": ["Kisume", "Yamame Kurodani", "Parsee Mizuhashi", "Yuugi Hoshiguma", "Satori Komeiji", "Rin Kaenbyou", "Utsuho Reiuji", "Koishi Komeiji"]
        },
        "UFO": {
            "enabled": true,
            "chars": ["Nazrin", "Kogasa Tatara", "Ichirin Kumoi", "Minamitsu Murasa", "Shou Toramaru", "Byakuren Hijiri", "Nue Houjuu"]
        },
        "DS": {
            "enabled": true,
            "chars": ["Hatate Himekaidou"]
        },
        "GFW": {
            "enabled": true,
            "chars": ["Luna Child", "Star Sapphire", "Sunny Milk"]
        },
        "TD": {
            "enabled": true,
            "chars": ["Kyouko Kasodani", "Yoshika Miyako", "Seiga Kaku", "Soga no Tojiko", "Mononobe no Futo", "Toyosatomimi no Miko", "Mamizou Futatsuiwa"]
        },
        "HM": {
            "enabled": true,
            "chars": ["Hata no Kokoro"]
        },
        "DDC": {
            "enabled": true,
            "chars": ["Wakasagihime", "Sekibanki", "Kagerou Imaizumi", "Benben Tsukumo", "Yatsuhashi Tsukumo", "Seija Kijin", "Shinmyoumaru Sukuna", "Raiko Horikawa"]
        },
        "ULiL": {
            "enabled": true,
            "chars": ["Kasen Ibaraki", "Sumireko Usami"]
        },
        "LoLK": {
            "enabled": true,
            "chars": ["Seiran", "Ringo", "Doremy Sweet", "Sagume Kishin", "Clownpiece", "Junko", "Hecatia Lapislazuli"]
        },
        "AoCF": {
            "enabled": true,
            "chars": ["Joon Yorigami", "Shion Yorigami"]
        },
        "HSiFS": {
            "enabled": true,
            "chars": ["Eternity Larva", "Nemuno Sakata", "Aunn Komano", "Narumi Yatadera", "Satono Nishida", "Mai Teireida", "Okina Matara"]
        },
        "Other": {
            "enabled": true,
            "chars": ["Maribel Hearn", "Renko Usami", "Watatsuki no Toyohime", "Watatsuki no Yorihime", "Hieda no Akyuu", "Tokiko", "Kosuzu Motoori"]
        }
    },
    tiers = {},
    maxTiers = 15,
    maxNameLength = 15,
    following = "",
    tierView = false,
    swapOngoing = -1,
    innerWidth = window.innerWidth;

var isCharacter = function (character) {
    return character !== "" && JSON.stringify(categories).removeSpaces().contains(character);
};

var isCategory = function (category) {
    return category !== "" && Object.keys(categories).contains(category);
};

var isTiered = function (character) {
    return character !== "" && JSON.stringify(tiers).contains(character.removeSpaces());
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
        for (i = 0; i < tiers[tierNum].chars.length; i++) {
            id = "#tier" + tierNum + "_";

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
    $("#" + character).attr("onContextMenu", "removeFromTier('" + character + "', " + tierNum + "); return false;");

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

    // check for category emptiness
    for (i in categories[categoryName].chars) {
        if (!isTiered(categories[categoryName].chars[i])) {
            return;
        }
    }

    $("#" + categoryName).css("display", "none");
};

var moveToBack = function (character, tierNum) {
    var help = $("#" + character);

    for (counter = getPositionOf(character); counter + 1 < tiers[tierNum].chars.length; counter++) {
        $("#tier" + tierNum + "_" + counter).html($("#tier" + tierNum + "_" + (counter + 1)).html());
    }

    $("#tier" + tierNum + "_" + (tiers[tierNum].chars.length - 1)).html(help);
    updateArrays();
};

var changeToTier = function (character, tierNum) {
    var oldTierNum = getTierNumOf(character), help, id;

    $("#msg_container").html("");

    if (oldTierNum === tierNum) {
        moveToBack(character, tierNum);
    } else {
        removeFromTier(character, oldTierNum);
        addToTier(character, tierNum);
    }
};

var removeFromTier = function (character, tierNum) {
    var pos, counter;

    if (character === "") {
        return;
    }

    $("#msg_container").html("");
    $("#" + character).addClass("list");
    $("#" + character).attr("onContextMenu", "");
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

    tierName = tierName.strip();
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
    "' class='tier_header' onClick='detectShiftCombo(event, " + tierNum + ")' onClick='detectShiftCombo(event)' onContextMenu='removeTier(" + tierNum +
    "); return false;'>" + tierName + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr><hr>");
    tiers[tierNum] = {};
    tiers[tierNum].name = tierName;
    tiers[tierNum].bg = "#1b232e";
    tiers[tierNum].colour = "#a0a0a0";
    tiers[tierNum].chars = [];
    tiers[tierNum].flag = false;

    // if tier swap ongoing, set onClick to swapTiers
    if (swapOngoing >= 0) {
        $("#th" + tierNum).attr("onClick", "swapTiers(" + swapOngoing + ", " + tierNum + ")");
    }
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

    $("#th" + tierNum1).attr("style", "color: " + tiers[tierNum2].colour + "; background-color: " + tiers[tierNum2].bg + ";");
    $("#th" + tierNum2).attr("style", "color: " + tiers[tierNum1].colour + "; background-color: " + tiers[tierNum1].bg + ";");
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
        $("#th" + tierNum).attr("onClick", "detectShiftCombo(event, " + tierNum + ")");
    }
};

var cancelOngoingSwap = function () {
    var tierNum;

    if (swapOngoing >= 0) {
        for (tierNum in tiers) {
            $("#th" + tierNum).attr("onClick", "detectShiftCombo(event, " + tierNum + ")");
        }

        swapOngoing = -1;
    }
}

var removeTier = function (tierNum, skipConfirmation) {
    var length = tiers[tierNum].chars.length, confirmation = true, otherTierNum, i;

    if (!skipConfirmation) {
        confirmation = confirm("Are you sure you want to remove this tier? Removal may take a moment with many characters inside.");
    }

    if (confirmation) {
        // remove all characters
        while (tiers[tierNum].chars.length > 0) {
            removeFromTier(tiers[tierNum].chars[0], tierNum);
        }

        cancelOngoingSwap();

        // remove the tier
        $("#tr" + tierNum).remove();
        tiers[tierNum].flag = true;
    }
};

var swapCharacters = function (character1, character2) {
    var parent1 = $("#" + character1).parent(),
        parent2 = $("#" + character2).parent(),
        backup = $("#" + character1);

    $(parent1).html($("#" + character2));
    $(parent2).html(backup);
    updateArrays();
};

var emptyModal = function () {
    $("#text_conversion").html("");
    $("#customisation").html("");
    $("#settings").html("");
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
        for (i = 0; i < categories[categoryName].chars.length; i++) {
            character = categories[categoryName].chars[i].removeSpaces();

            if (!isTiered(character)) {
                addToTier(character, tierNum);
            }
        }
    }
};

var detectShiftCombo = function (event, tierNum) {
    if (event.shiftKey) { // quick-add on shift + left click
        quickAdd(tierNum);
    } else { // initiate swap on left click
        startTierSwap(tierNum);
    }
}

var detectAddTierEnter = function (event) {
    if (event.keyCode == 13) { // enter press
        addTier($("#tier_name").val());
    }
};

var save = function () {
    setCookie("tiers", JSON.stringify(tiers));
    setCookie("settings", JSON.stringify(categories));
    $("#msg_container").html("<strong style='color:green'>Tier list and settings saved!</strong>");
};

var load = function () {
    var text = $("#import").val().split('\n'), counter = -1, i, j;

    $("#import_msg_container").html("<strong style='color:orange'>Please watch warmly as your tier list is imported...</strong>");

    for (tierNum in tiers) {
        removeTier(tierNum, true);
    }

    for (i = 0; i < text.length; i++) {
        if (text[i].contains(':')) {
            addTier(text[i].replace(':', ""));
            counter += 1;
        } else if (text[i] !== "") {
            characters = text[i].split(',');
            for (j = 0; j < characters.length; j++) {
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
};

var exportText = function () {
    var tierNum, character, i;

    emptyModal();
    $("#text_conversion").html("<h2>Export to Text</h2><p id='text'></p>");

    for (tierNum in tiers) {
        if (!tiers[tierNum].flag) {
            $("#text").append("<p>" + tiers[tierNum].name + ":</p><p>");

            for (i = 0; i < tiers[tierNum].chars.length; i++) {
                character = $("#" + tiers[tierNum].chars[i]).attr("alt");
                $("#text").append(character + (i == tiers[tierNum].chars.length - 1 ? "" : ", "));
            }

            $("#text").append("</p>");
        }
    }

    if ($("#text").html() === "") {
        $("#msg_container").html("<strong style='color:orange'>Error: there are no tiers to export.</strong>");
        $("#text_conversion").html("");
        return;
    }

    $("#text_conversion").append("<p><input type='button' value='Copy to Clipboard' onClick='copyToClipboard()'></p>");
    $("#text_conversion").css("display", "block");
    $("#modal").css("display", "block");
};

var customise = function () {
    var tierNum;

    emptyModal();
    $("#customisation").html("<div><h2>Tier Customisation</h2></div><div id='custom_tier_container'>");

    for (tierNum in tiers) {
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
            tierName = $("#custom_name_tier" + tierNum).val();
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
};

var settings = function () {
    var categoryName, current = 0, counter = 0;

    emptyModal();
    $("#settings").html("<div><h2>Settings</h2></div><div>Include characters in the following games of first appearance:<table id='settings_table'><tbody><tr id='settings_tr0'>");

    for (categoryName in categories) {
        if (counter > 0 && counter % 5 === 0) {
            counter = 0;
            current += 1;
            $("#settings_table").append("</tr><tr id='settings_tr" + current + "'>");
        }

        $("#settings_tr" + current).append("<td><input id='checkbox_" + categoryName +
        "' type='checkbox' value=''" + (categories[categoryName].enabled ? " checked" : "") +
        "><label for='" + categoryName + "'>" + categoryName + "</label></td>");
        counter += 1;
    }

    $("#settings").append("</tr></tbody></table></div><div><p><input type='button' value='Save Changes' onClick='saveSettings()'></p>");
    $("#settings").append("<p id='settings_msg_container'></p></div>");
    $("#settings").css("display", "block");
    $("#modal").css("display", "block");
};

var confirmMassRemoval = function (removedCategories) {
    var confirmation = confirm("Do you want to remove characters from disabled categories from the current tiers?"),
        categoryName, character, i, j;

    if (confirmation) {
        $("#settings_msg_container").html("<strong style='color:orange'>Girls are being removed, please wait warmly...</strong>");

        for (i = 0; i < removedCategories.length; i++) {
            categoryName = removedCategories[i];

            for (j in categories[categoryName].chars) {
                character = categories[categoryName].chars[j].removeSpaces();

                if (isTiered(character)) {
                    removeFromTier(character, getTierNumOf(character));
                }
            }
        }
    }
}

var saveSettings = function () {
    var removedCategories = [], categoryName, character, i;

    for (categoryName in categories) {
        categories[categoryName].enabled = $("#checkbox_" + categoryName).is(":checked");

        // check if any disabled characters are in tiers or being held
        if (!$("#checkbox_" + categoryName).is(":checked")) {
            for (i in categories[categoryName].chars) {
                character = categories[categoryName].chars[i].removeSpaces();

                if (isTiered(character)) {
                    removedCategories.push(categoryName);
                }
            }
        }
    }

    if (removedCategories.length > 0) {
        confirmMassRemoval(removedCategories);
    }

    for (categoryName in categories) {
        $("#" + categoryName).css("display", $("#checkbox_" + categoryName).is(":checked") ? "block" : "none");
    }

    $("#settings").html("");
    $("#settings").css("display", "none");
    $("#modal").css("display", "none");
};

var toggleTierView = function () {
    $("#msg_container").html("");
    $("#characters").css("display", tierView ? "block" : "none");
    $("#buttons").css("display", tierView ? "block" : "none");
    tierView = !tierView;
    $("#show").css("display", tierView ? "block" : "none");
    $("#wrap").css("max-height", tierView ? "100%" : "77%");
    $("#wrap").css("width", tierView ? "auto" : "48%");
    $("#wrap").css("bottom", tierView ? "5px" : "");
    $("#wrap").css("left", tierView ? "5px" : "");
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
        tierNum = Number(event.target.id.replace("th", "").replace("tier", ""));

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

var loadTiersFromCookie = function () {
    var tiersCookie = JSON.parse(getCookie("tiers")), tierNum, character;

    for (tierNum in tiersCookie) {
        tiers[tierNum] = {};
        tiers[tierNum].name = tiersCookie[tierNum].name;
        tiers[tierNum].bg = tiersCookie[tierNum].bg;
        tiers[tierNum].colour = tiersCookie[tierNum].colour;
        tiers[tierNum].chars = [];
        tiers[tierNum].flag = tiersCookie[tierNum].flag;

        if (!tiers[tierNum].flag) {
            $("#tier_list_tbody").append("<tr id='tr" + tierNum + "' onDragOver='allowDrop(event)' onDrop='drop(event)'><th id='th" + tierNum +
            "' class='tier_header' onClick='detectShiftCombo(event, " + tierNum + ")' onContextMenu='removeTier(" + tierNum +
            "); return false;' style='color: " + tiers[tierNum].colour + "; background-color: " + tiers[tierNum].bg +
            ";'>" + tiersCookie[tierNum].name + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");

            for (i = 0; i < tiersCookie[tierNum].chars.length; i++) {
                character = tiersCookie[tierNum].chars[i];
                addToTier(character, tierNum);
            }
        }
    }
};

var loadCharacters = function () {
    var insertRight = false, categoryName, character, i;

    for (categoryName in categories) {
        $("#characters").append("<div id='" + categoryName + "'>");
        //(categoryName != "Main" ? " class='sep'" : "") + ">");

        for (i in categories[categoryName].chars) {
            character = categories[categoryName].chars[i];
            $("#" + categoryName).append("<span id='" + character.removeSpaces() + "C'><img id='" + character.removeSpaces() +
            "' class='list' draggable='true' onDragStart='drag(event)' src='tiers/" + categoryName + "/" + character.removeSpaces() +
            ".jpg' alt='" + character + "' title='" + character + "'>");
        }

        $("#characters").append("</div>");

        if (!categories[categoryName].enabled) {
            $("#" + categoryName).css("display", "none");
        }
    }
};

var loadSettingsFromCookie = function () {
    var settingsCookie = JSON.parse(getCookie("settings"));

    for (category in settingsCookie) {
        categories[category].enabled = settingsCookie[category].enabled;
    }
};

$(document).ready(function () {
    // detect smartphone
    if (navigator.userAgent.indexOf("Mobile") > -1) {
        $("notice").css("display", "block");
	}

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
});
