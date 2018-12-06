var categories = {
        "Main": {
            "chars": ["Reimu Hakurei", "Marisa Kirisame"]
        },
        "HRtP": {
            "chars": ["Reimu PC-98", "SinGyoku M", "SinGyoku F", "YuugenMagan", "Mima", "Elis", "Kikuri", "Sariel", "Konngara"]
        },
        "SoEW": {
            "chars": ["Genjii", "Rika", "Meira", "Marisa PC-98", "Evil Eye Sigma"]
        },
        "PoDD": {
            "chars": ["Ellen", "Kotohime", "Kana Anaberal", "Rikako Asakura", "Chiyuri Kitashirakawa", "Yumemi Okazaki", "Ruukoto", "Mimi-chan"]
        },
        "LLS": {
            "chars": ["Orange", "Kurumi", "Elly", "Yuuka PC-98", "Mugetsu", "Gengetsu"]
        },
        "MS": {
            "chars": ["Sara", "Luize", "Alice PC-98", "Yuki", "Mai PC-98", "Yumeko", "Shinki"]
        },
        "EoSD": {
            "chars": ["Rumia", "Daiyousei", "Cirno", "Hong Meiling", "Koakuma", "Patchouli Knowledge", "Sakuya Izayoi", "Remilia Scarlet", "Flandre Scarlet"]
        },
        "PCB": {
            "chars": ["Letty Whiterock", "Chen", "Alice Margatroid", "Lily White", "Lyrica Prismriver", "Lunasa Prismriver",
            "Merlin Prismriver", "Youmu Konpaku", "Yuyuko Saigyouji", "Ran Yakumo", "Yukari Yakumo"]
        },
        "IaMP": {
            "chars": ["Suika Ibuki"]
        },
        "IN": {
            "chars": ["Wriggle Nightbug", "Mystia Lorelei", "Keine Kamishirasawa", "Tewi Inaba", "Reisen Udongein Inaba", "Eirin Yagokoro", "Kaguya Houraisan", "Fujiwara no Mokou"]
        },
        "PoFV": {
            "chars": ["Aya Shameimaru", "Medicine Melancholy", "Yuuka Kazami", "Komachi Onozuka", "Eiki Shiki Yamaxanadu"]
        },
        "MoF": {
            "chars": ["Shizuha Aki", "Minoriko Aki", "Hina Kagiyama", "Nitori Kawashiro", "Momiji Inubashiri", "Sanae Kochiya", "Kanako Yasaka", "Suwako Moriya"]
        },
        "SWR": {
            "chars": ["Iku Nagae", "Tenshi Hinanawi"]
        },
        "SA": {
            "chars": ["Kisume", "Yamame Kurodani", "Parsee Mizuhashi", "Yuugi Hoshiguma", "Satori Komeiji", "Rin Kaenbyou", "Utsuho Reiuji", "Koishi Komeiji"]
        },
        "UFO": {
            "chars": ["Nazrin", "Kogasa Tatara", "Ichirin Kumoi", "Unzan", "Minamitsu Murasa", "Shou Toramaru", "Byakuren Hijiri", "Nue Houjuu"]
        },
        "Soku": {
            "chars": ["Hisoutensoku"]
        },
        "DS": {
            "chars": ["Hatate Himekaidou"]
        },
        "GFW": {
            "chars": ["Luna Child", "Star Sapphire", "Sunny Milk"]
        },
        "TD": {
            "chars": ["Kyouko Kasodani", "Yoshika Miyako", "Seiga Kaku", "Soga no Tojiko", "Mononobe no Futo", "Toyosatomimi no Miko", "Mamizou Futatsuiwa"]
        },
        "HM": {
            "chars": ["Hata no Kokoro"]
        },
        "DDC": {
            "chars": ["Wakasagihime", "Sekibanki", "Kagerou Imaizumi", "Benben Tsukumo", "Yatsuhashi Tsukumo", "Seija Kijin", "Shinmyoumaru Sukuna", "Raiko Horikawa"]
        },
        "ULiL": {
            "chars": ["Sumireko Usami"]
        },
        "LoLK": {
            "chars": ["Seiran", "Ringo", "Doremy Sweet", "Sagume Kishin", "Clownpiece", "Junko", "Hecatia Lapislazuli"]
        },
        "AoCF": {
            "chars": ["Joon Yorigami", "Shion Yorigami"]
        },
        "HSiFS": {
            "chars": ["Eternity Larva", "Nemuno Sakata", "Aunn Komano", "Narumi Yatadera", "Satono Nishida", "Mai Teireida", "Okina Matara"]
        },
        "Manga": {
            "chars": ["Hieda no Akyuu", "Watatsuki no Toyohime", "Watatsuki no Yorihime", "Reisen II",
            "Kasen Ibaraki", "Rinnosuke Morichika", "Tokiko", "Kosuzu Motoori", "Fortune Teller"]
        },
        "CD": {
            "chars": ["Maribel Hearn", "Renko Usami"]
        }
    },
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
        "artist": "Dairi"
    },
    windows = ["EoSD", "PCB", "IaMP", "IN", "PoFV", "MoF", "SWR", "SA", "UFO", "Soku", "DS", "GFW", "TD", "HM", "DDC", "ULiL", "LoLK", "AoCF", "HSiFS"],
    maleCharacters = ["SinGyokuM", "Genjii", "Unzan", "RinnosukeMorichika", "FortuneTeller"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"],
    tiers = {},
    maxTiers = 20,
    maxNameLength = 30,
    following = "",
    tierView = false,
    swapOngoing = -1;

var isCharacter = function (character) {
    return character !== "" && JSON.stringify(categories).removeSpaces().contains(character);
};

var isCategory = function (category) {
    return category !== "" && Object.keys(categories).contains(category);
};

var isTiered = function (character) {
    return character !== "" && JSON.stringify(tiers).contains(character.removeSpaces());
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

    window.onbeforeunload = function () { return confirm(); };

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
    window.onbeforeunload = function () { return confirm(); };
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

    window.onbeforeunload = function () { return confirm(); };
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

    if (!skipConfirmation) {
        confirmation = confirm("Are you sure you want to remove this tier? Removal may take a moment with many characters inside.");
    }

    if (confirmation) {
        removeCharacters(tierNum);
        cancelOngoingSwap();
        $("#tr" + tierNum).remove();
        tiers[tierNum].flag = true;
    }

    window.onbeforeunload = function () { return confirm(); };
};

var swapCharacters = function (character1, character2) {
    var parent1 = $("#" + character1).parent(),
        parent2 = $("#" + character2).parent(),
        backup = $("#" + character1);

    $(parent1).html($("#" + character2));
    $(parent2).html(backup);
    $("#" + character1).attr("onContextMenu", "removeFromTier(" + getTierNumOf(character1) + "); return false;");
    $("#" + character2).attr("onContextMenu", "removeFromTier(" + getTierNumOf(character2) + "); return false;");
    updateArrays();
    window.onbeforeunload = function () { return confirm(); };
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
    var confirmation = confirm("Are you sure you want to empty this tier? Emptying may take a moment with many characters inside.");

    if (confirmation) {
        removeCharacters(tierNum);
    }
};

var detectRightCtrlCombo = function (event, tierNum) {
    if (event.ctrlKey) { // empty tier on ctrl + right click
        emptyTier(tierNum);
    } else { // remove tier on right click
        removeTier(tierNum);
    }
};

var detectAddTierEnter = function (event) {
    if (event.keyCode == 13) { // enter press
        addTier($("#tier_name").val());
    }
};

var toggleInstructions = function () {
    $(".instructions").css("display", $(".instructions").css("display") == "none" ? "block" : "none");
    $("#toggle").html("Click here to " + ($(".instructions").css("display") == "none" ? "show" : "hide") + " the instructions.");
};

var allowCookies = function () {
    var confirmation;

    if (document.cookie === "") {
        return confirm("This will store a cookie file on your device. Do you allow this?");
    } else {
        return true;
    }
}

var saveTiersCookie = function () {
    if (!allowCookies()) {
        return;
    }

    setCookie("tiers", JSON.stringify(tiers));
    $("#msg_container").html("<strong style='color:green'>Tier list saved!</strong>");
    window.onbeforeunload = undefined;
};

var saveSettingsCookie = function () {
    if (!allowCookies()) {
        return;
    }

    setCookie("settings", JSON.stringify(settings));
    $("#msg_container").html("<strong style='color:green'>Settings saved!</strong>");
    window.onbeforeunload = undefined;
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

var customiseMenu = function () {
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
    saveTiersCookie();
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

        if (confirmation) {
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
    $("#settings").html("");
    $("#settings").css("display", "none");
    $("#modal").css("display", "none");
    saveSettingsCookie();
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

var eraseAll = function () {
    var confirmation = confirm("Are you sure you want to reset your tier list and settings to the defaults?"), tierNum;

    if (confirmation) {
        for (tierNum in tiers) {
            removeTier(tierNum, true);
        }

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
            "artist": "Dairi"
        };

        deleteCookie("tiers");
        deleteCookie("settings");
        addTier("S");
        addTier("A");
        $("#tier_name").val("B");
        $("#msg_container").html("<strong style='color:green'>Reset the tier list and settings to their default states!</strong>");
        window.onbeforeunload = undefined;
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
            "' class='tier_header' onClick='detectLeftCtrlCombo(event, " + tierNum + ")' onContextMenu='detectRightCtrlCombo(event, " + tierNum +
            "); return false;' style='color: " + tiers[tierNum].colour + "; background-color: " + tiers[tierNum].bg +
            ";'>" + tiersCookie[tierNum].name + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");

            for (i = 0; i < tiersCookie[tierNum].chars.length; i++) {
                character = tiersCookie[tierNum].chars[i];

                if (character == "Mai") { // fix legacy name
                    character = "Mai PC-98";
                }

                addToTier(character, tierNum);
            }
        }
    }
};

var loadCharacters = function () {
    var insertRight = false, categoryName, character, i;

    for (categoryName in categories) {
        $("#characters").append("<div id='" + categoryName + "'>");

        for (i in categories[categoryName].chars) {
            character = categories[categoryName].chars[i];

            $("#" + categoryName).append("<span id='" + character.removeSpaces() + "C'><img id='" + character.removeSpaces() +
            "' class='list' draggable='true' onDragStart='drag(event)' src='tiers/" + settings.artist + "/" + categoryName +
            "/" + character.removeSpaces() + "." + (settings.artist == "Dairi" ? "png" : "jpg") +
            "' alt='" + character + "' title='" + character + "'>");

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

$(document).ready(function () {
    // detect smartphone
    if (navigator.userAgent.indexOf("Mobile") > -1) {
        $("#notice").css("display", "block");
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

    window.onbeforeunload = undefined;
});
