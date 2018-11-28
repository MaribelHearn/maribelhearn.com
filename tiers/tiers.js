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
            "chars": ["Maribel Hearn", "Renko Usami", "Watatsuki no Toyohime", "Watatsuki no Yorihime", "Hieda no Akyuu", "Tokiko"]
        }
    },
    tiers = {},
    maxTiers = 15,
    maxNameLength = 15,
    following = "",
    charsHidden = false,
    mouseX,
    mouseY;

var getTierNumOf = function (character) {
    var tierNum, i;

    for (tierNum in tiers) {
        for (i in tiers[tierNum].chars) {
            if (tiers[tierNum].chars[i] == character) {
                return tierNum;
            }
        }
    }

    return false;
};

var changeToTier = function (tierNum) {
    var character = following;

    $("#msg_container").html("");

    if (getTierNumOf(character) !== false) {
        tiers[getTierNumOf(character)].chars.remove(character);
    }

    if (!JSON.stringify(tiers).contains(character)) {
        unfollowMouse();
        $("#" + character).removeClass("list");
        $("#" + character).css("position", "");
        $("#" + character).css("top", "");
        $("#" + character).css("left", "");
        $("#" + character).attr("onContextMenu", "removeFromTier('" + character + "', " + tierNum + ")");
        $("#tier" + tierNum).append($("#" + character));
        tiers[tierNum].chars.pushStrict(character);
    }
};

var removeFromTier = function (character, tierNum) {
    if (character === "") {
        return;
    }

    $("#msg_container").html("");
    $("#" + character).addClass("list");
    $("#" + character).attr("onContextMenu", "");
    $("#" + character + "C").append($("#" + character));

    if (tierNum !== false) {
        tiers[tierNum].chars.remove(character);
    }
};

var validateTierName = function (tierNum) {
    var tierName = $("#th" + tierNum).html();

    tierName = tierName.strip().substr(0, 15);
    $("#th" + tierNum).html(tierName);
};

var validateTierName = function (tierName) {
    return tierName.length <= maxNameLength;
};

var addTier = function (tierName) {
    var tierNum = 0;

    $("#msg_container").html("");

    while (tiers[tierNum] && !tiers[tierNum].flag) {
        tierNum += 1;
    }

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

    $("#tier_list_tbody").append("<tr id='tr" + tierNum + "'><th id='th" + tierNum + "' class='tier_header' onClick='startSwap(" + tierNum +
    ")' onContextMenu='removeTier(" + tierNum + ")'>" + tierName + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");
    $("#add").append("<option id='to" + tierNum + "' value='#tier" + tierNum + "'>" + tierName + "</option>");
    tiers[tierNum] = {};
    tiers[tierNum].name = tierName;
    tiers[tierNum].colour = "#888888";
    tiers[tierNum].chars = [];
    tiers[tierNum].flag = false;
};

var startSwap = function (tierNum) {
    var tierName = $("#th" + tierNum).html(), i;

    $("#th" + tierNum).html("<span id='ts" + tierNum + "' style='color: black; background-color: white;'></span>");
    $("#ts" + tierNum).html(tierName);

    for (i in tiers) {
        $("#th" + i).attr("onClick", "swap(" + tierNum + ", " + i + ")");
    }
};

var swap = function (tierNum1, tierNum2) {
    var tmp = tiers[tierNum1], tierNum;

    $("#th" + tierNum1).html($("#ts" + tierNum1).html());
    tiers[tierNum1] = tiers[tierNum2];
    tiers[tierNum2] = tmp;
    tmp = $("#th" + tierNum1).html();
    $("#th" + tierNum1).html($("#th" + tierNum2).html());
    $("#th" + tierNum2).html(tmp);
    tmp = $("#tier" + tierNum1).html();
    $("#tier" + tierNum1).html($("#tier" + tierNum2).html());
    $("#tier" + tierNum2).html(tmp);

    for (tierNum in tiers) {
        $("#th" + tierNum).attr("onClick", "startSwap(" + tierNum + ")");
    }
};

var removeTier = function (tierNum) {
    var i, length = tiers[tierNum].chars.length;

    while (tiers[tierNum].chars.length > 0) {
        removeFromTier(tiers[tierNum].chars[0], tierNum);
    }

    $("#tr" + tierNum).remove();
    $("#to" + tierNum).remove();
    tiers[tierNum].flag = true;
};

var followMouse = function (character) {
    var tierNum, i, j;

    following = character;

    for (tierNum = 0; tierNum < Object.keys(tiers).length; tierNum++) {
        $("#th" + tierNum).attr("onClick", "changeToTier(" + tierNum + ")");

        /*for (i = 0; i < tiers[tierNum].chars.length; i++) {
            $("#" + tiers[tierNum].chars[i]).attr("onClick", "");
        }*/
    }

    for (i in categories) {
        for (j in categories[i].chars) {
            $("#" + categories[i].chars[j].removeSpaces()).attr("onClick", "");
        }
    }

    $("body").attr("onContextMenu", "unfollowMouse(); $('#" + character + "').attr('style', '');");
};

var unfollowMouse = function () {
    var tierNum, character, i, j;

    following = "";

    for (tierNum = 0; tierNum < Object.keys(tiers).length; tierNum++) {
        $("#th" + tierNum).attr("onClick", "startSwap(" + tierNum + ")");
    }

    for (i in categories) {
        for (j in categories[i].chars) {
            character = categories[i].chars[j].removeSpaces();

            // check if the character is in a tier
            if ($("#" + character + "C").html() == "") {
                $("#" + character).attr("onClick", "removeFromTier('" + following +
                "', false); followMouse('" + character + "'); updateMouseLoc(event);");
            } else {
                $("#" + character).attr("onClick", "removeFromTier('', false); followMouse('" + character + "'); updateMouseLoc(event);");
            }
        }
    }

    $("body").attr("onContextMenu", "");
};

var updateMouseLoc = function (event) {
    mouseX = event.clientX;
    mouseY = event.clientY;

    if (following !== "") {
        $("#" + following).css("position", "fixed");
        $("#" + following).css("left", (mouseX + 1) + "px");
        $("#" + following).css("top", (mouseY + 1) + "px");
    }
};

var closeModal = function (event) {
    var modal = document.getElementById("modal");

    if (event.target == modal) {
        $("#customisation").html("");
        $("#settings").html("");
        $("#customisation").css("display", "none");
        $("#settings").css("display", "none");
        $("#modal").css("display", "none");
    }
};

var detectAddTierEnter = function (event) {
    if (event.keyCode == 13) { // enter press
        addTier($("#tier_name").val());
    }
};

var save = function () {
    setCookie("tiers", JSON.stringify(tiers));
    $("#msg_container").html("<strong style='color:green'>Tier list saved!</strong>");
};

var toText = function () {
    var tierNum, character, i;

    $("#msg_container").html("<strong style='color:green'>Textual version generated!</strong>");

    for (tierNum in tiers) {
        $("#msg_container").append("<p>" + tiers[tierNum].name + ": ");

        for (i = 0; i < tiers[tierNum].chars.length; i++) {
            character = $("#" + tiers[tierNum].chars[i]).attr("alt");
            $("#msg_container").append(character + (i == tiers[tierNum].chars.length - 1 ? "" : ", "));
        }

        $("#msg_container").append("</p>");
    }
};

var customise = function () {
    var tierNum;

    $("#customisation").html("<div><h2>Tier Customisation</h2></div><div id='custom_tier_container'>");

    for (tierNum in tiers) {
        if (!tiers[tierNum].flag) {
            $("#custom_tier_container").append("<p><strong>" + tiers[tierNum].name + "</strong></p>");
            $("#custom_tier_container").append("<p class='name'><label for='custom_name_tier" + tierNum +
            "'>Name</label><input id='custom_name_tier" + tierNum + "' type='text' value='" + tiers[tierNum].name + "'></p>");
            $("#custom_tier_container").append("<p class='colour'><label for='custom_colour_tier" + tierNum +
            "'>Colour</label><input id='custom_colour_tier" + tierNum + "' type='color' value='" + tiers[tierNum].colour + "'></p>");
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

    for (tierNum in tiers) {
        tierName = $("#custom_name_tier" + tierNum).val();
        tierColour = $("#custom_colour_tier" + tierNum).val();

        if (!validateTierName(tierName)) {
            $("#custom_msg_container").html("<strong style='color:orange'>Error: tier names may not exceed " + maxNameLength + " characters.</strong>");
            return;
        }

        $("#th" + tierNum).html();
        $("#to" + tierNum).html(tierName);
        $("#th" + tierNum).css("background-color", tierColour);
        tiers[tierNum].name = tierName;
        tiers[tierNum].colour = tierColour;
    }

    $("#customisation").html("");
    $("#customisation").css("display", "none");
    $("#modal").css("display", "none");
};

var settings = function () {
    var categoryName, current = 0, counter = 0;

    $("#settings").html("<div><h2>Settings</h2></div><div>Include the following characters:<table id='settings_table'><tbody><tr id='settings_tr0'>");

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

    $("#settings").append("</tr></tbody></table></div><div><p><input type='button' value='Save Changes' onClick='saveSettings()'></p></div>");
    $("#settings").css("display", "block");
    $("#modal").css("display", "block");
};

var confirmRemoval = function (removedCategories) {
    var confirmation = confirm("Do you want to remove characters from disabled categories from the current tiers?"),
        categoryName, character, i, j;

    if (confirmation) {
        for (i = 0; i < removedCategories.length; i++) {
            categoryName = removedCategories[i];

            for (j in categories[categoryName].chars) {
                character = categories[categoryName].chars[j].removeSpaces();

                if (getTierNumOf(character)) {
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
        $("#" + categoryName).css("display", $("#checkbox_" + categoryName).is(":checked") ? "block" : "none");

        // check if any disabled characters are in tiers
        if (!$("#checkbox_" + categoryName).is(":checked")) {
            for (i in categories[categoryName].chars) {
                character = categories[categoryName].chars[i].removeSpaces();

                if (getTierNumOf(character)) {
                    removedCategories.push(categoryName);
                }
            }
        }
    }

    if (removedCategories.length > 0) {
        confirmRemoval(removedCategories);
    }

    $("#settings").html("");
    $("#settings").css("display", "none");
    $("#modal").css("display", "none");
};

var hideShowChars = function () {
    $("#msg_container").html("");
    $("#characters").css("display", charsHidden ? "block" : "none");
    charsHidden = !charsHidden;
    $("#hideShow").val((charsHidden ? "Show" : "Hide") + " Character Boxes");
    $("#wrap").css("margin-left", charsHidden ? "0%" : "15%");
    $("#wrap").css("margin-right", charsHidden ? "0%" : "15%");
};

var loadCharacters = function () {
    var insertRight = false, categoryName, character, i;

    for (categoryName in categories) {
        // other half of chars on right side of the screen
        if (categoryName == "DS") {
            insertRight = true;
        }

        $(insertRight ? "#characters2" : "#characters1").append("<div id='" + categoryName + "'>");

        // no category separators at top
        if (categoryName != "Main" && categoryName != "DS") {
            $("#" + categoryName).append("<hr>");
        }

        for (i in categories[categoryName].chars) {
            character = categories[categoryName].chars[i];
            $("#" + categoryName).append("<span id='" + character.removeSpaces() + "C'><img id='" + character.removeSpaces() +
            "' class='list' src='tiers/" + categoryName + "/" + character.removeSpaces() + ".jpg' alt='" + character +
            "' onClick='removeFromTier(\"" + following + "\", false); followMouse(\"" + character.removeSpaces() + "\"); updateMouseLoc(event);'></span>");
        }

        $(insertRight ? "#characters2" : "#characters1").append("</div>");
    }
};

var loadFromCookie = function () {
    var tiersCookie = JSON.parse(getCookie("tiers")), tierNum;

    for (tierNum = 0; tierNum < Object.keys(tiersCookie).length; tierNum++) {
        tiers[tierNum] = {};
        tiers[tierNum].name = tiersCookie[tierNum].name;
        tiers[tierNum].colour = tiersCookie[tierNum].colour;
        tiers[tierNum].chars = [];
        tiers[tierNum].flag = tiersCookie[tierNum].flag;

        if (!tiers[tierNum].flag) {
            $("#tier_list_tbody").append("<tr id='tr" + tierNum + "'><th id='th" + tierNum + "' class='tier_header' onClick='startSwap(" + tierNum +
            ")' onContextMenu='removeTier(" + tierNum + ")' style='background-color: " + tiers[tierNum].colour +
            ";'>" + tiersCookie[tierNum].name + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");
            $("#add").append("<option id='to" + tierNum + "' value='#tier" + tierNum + "'>" + tiersCookie[tierNum].name + "</option>");
        }

        for (i = 0; i < tiersCookie[tierNum].chars.length; i++) {
            character = tiersCookie[tierNum].chars[i];
            $("#" + character).removeClass("list");
            $("#" + character).css("position", "");
            $("#" + character).css("top", "");
            $("#" + character).css("left", "");
            $("#" + character).attr("onContextMenu", "removeFromTier('" + character + "', " + tierNum + ")");
            $("#tier" + tierNum).append($("#" + character));
            tiers[tierNum].chars.pushStrict(character);
        }
    }
};

$(document).ready(function () {
    loadCharacters();

    try {
        loadFromCookie();
    } catch (error) {
        addTier("A");
    }
});
