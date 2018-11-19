var categories = {
        "Main": ["Reimu Hakurei", "Marisa Kirisame"],
        "EoSD": ["Rumia", "Daiyousei", "Cirno", "Hong Meiling", "Koakuma", "Patchouli Knowledge", "Sakuya Izayoi", "Remilia Scarlet", "Flandre Scarlet"],
        "PCB": ["Letty Whiterock", "Chen", "Alice Margatroid", "Lily White", "Lyrica Prismriver", "Lunasa Prismriver", "Merlin Prismriver", "Youmu Konpaku", "Yuyuko Saigyouji", "Ran Yakumo", "Yukari Yakumo"],
        "IaMP": ["Suika Ibuki"],
        "IN": ["Wriggle Nightbug", "Mystia Lorelei", "Keine Kamishirasawa", "Tewi Inaba", "Reisen Udongein Inaba", "Eirin Yagokoro", "Kaguya Houraisan", "Fujiwara no Mokou"],
        "PoFV": ["Aya Shameimaru", "Medicine Melancholy", "Yuuka Kazami", "Komachi Onozuka", "Eiki Shiki Yamaxanadu"],
        "MoF": ["Shizuha Aki", "Minoriko Aki", "Hina Kagiyama", "Nitori Kawashiro", "Momiji Inubashiri", "Sanae Kochiya", "Kanako Yasaka", "Suwako Moriya"],
        "SWR": ["Iku Nagae", "Tenshi Hinanawi"],
        "SA": ["Kisume", "Yamame Kurodani", "Parsee Mizuhashi", "Yuugi Hoshiguma", "Satori Komeiji", "Rin Kaenbyou", "Utsuho Reiuji", "Koishi Komeiji"],
        "UFO": ["Nazrin", "Kogasa Tatara", "Ichirin Kumoi", "Minamitsu Murasa", "Shou Toramaru", "Byakuren Hijiri", "Nue Houjuu"],
        "DS": ["Hatate Himekaidou"],
        "GFW": ["Luna Child", "Star Sapphire", "Sunny Milk"],
        "TD": ["Kyouko Kasodani", "Yoshika Miyako", "Seiga Kaku", "Soga no Tojiko", "Mononobe no Futo", "Toyosatomimi no Miko", "Mamizou Futatsuiwa"],
        "HM": ["Hata no Kokoro"],
        "DDC": ["Wakasagihime", "Sekibanki", "Kagerou Imaizumi", "Benben Tsukumo", "Yatsuhashi Tsukumo", "Seija Kijin", "Shinmyoumaru Sukuna", "Raiko Horikawa"],
        "ULiL": ["Kasen Ibaraki", "Sumireko Usami"],
        "LoLK": ["Seiran", "Ringo", "Doremy Sweet", "Sagume Kishin", "Clownpiece", "Junko", "Hecatia Lapislazuli"],
        "AoCF": ["Joon Yorigami", "Shion Yorigami"],
        "HSiFS": ["Eternity Larva", "Nemuno Sakata", "Aunn Komano", "Narumi Yatadera", "Satono Nishida", "Mai Teireida", "Okina Matara"],
        "Other": ["Maribel Hearn", "Renko Usami", "Watatsuki no Toyohime", "Watatsuki no Yorihime", "Hieda no Akyuu"]
    },
    /*gradients = [
        "radial-gradient(#8B0000, #C54500, #FF8C00)",
        "radial-gradient(#FF8C00, #FFA500, #FFFF00)",
        "radial-gradient(#FFFF00, #D6FF18, #ADFF2F)",
        "radial-gradient(#ADFF2F, #57A818, #008000)",
        "radial-gradient(#008080, #00BFBF, #00FFFF)",
        "radial-gradient(#FF69B4, #B34EA7, #663399)",
        "radial-gradient(#663399, #B31ACC, #FF00FF)"
    ],*/
    tiers = {},
    maxTiers = 15,
    maxNameLength = 15,
    following = "",
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
    
    //style='background:" + gradients[tierNum] +"' 
    $("#tier_list_tbody").append("<tr id='tr" + tierNum + "'><th id='th" + tierNum + "' class='tier_header' onClick='moveToTop(" + tierNum +
    ")' onContextMenu='removeTier(" + tierNum + ")'>" + tierName + "</th><td id='tier" + tierNum + "' class='tier_content'></td></tr>");
    $("#add").append("<option id='to" + tierNum + "' value='#tier" + tierNum + "'>" + tierName + "</option>");
    tiers[tierNum] = {};
    tiers[tierNum].name = tierName;
    tiers[tierNum].colour = "#888888";
    tiers[tierNum].chars = [];
    tiers[tierNum].flag = false;
};

var moveToTop = function (movedTierNum) {
    $("#tier_list_tbody").prepend($("#tr" + tierNum));
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
    var tierNum, i;
    
    following = character;
    
    for (tierNum = 0; tierNum < Object.keys(tiers).length; tierNum++) {
        $("#th" + tierNum).attr("onClick", "changeToTier(" + tierNum + ")");
        
        for (i = 0; i < tiers[tierNum].chars.length; i++) {
            $("#" + tiers[tierNum].chars[i]).attr("onClick", "");
        }
    }
};

var unfollowMouse = function () {
    var tierNum, i;
    
    following = "";
    
    for (tierNum = 0; tierNum < Object.keys(tiers).length; tierNum++) {
        $("#th" + tierNum).attr("onClick", "moveToTop(" + tierNum + ")");
        
        for (i = 0; i < tiers[tierNum].chars.length; i++) {
            $("#" + tiers[tierNum].chars[i]).attr("onClick", "removeFromTier('" + following + "', false); followMouse('" + tiers[tierNum].chars[i] + "'); updateMouseLoc(event);");
        }
    }
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
    
    $("#modal").css("display", "block");
    $("#customisation").html("<div><h2>Tier Customisation</h2></div><div>");
    
    for (tierNum in tiers) {
        $("#customisation").append("<p><strong>" + tiers[tierNum].name + "</strong></p>");
        $("#customisation").append("<p class='name'><label for='custom_name_tier" + tierNum +
        "'>Name</label><input id='custom_name_tier" + tierNum + "' type='text' value='" + tiers[tierNum].name + "'></p>");
        $("#customisation").append("<p class='colour'><label for='custom_colour_tier" + tierNum +
        "'>Colour</label><input id='custom_colour_tier" + tierNum + "' type='color' value='" + tiers[tierNum].colour + "'></p>");
    }
    
    $("#customisation").append("</div><div><p><input type='button' value='Save Changes' onClick='saveChanges()'></p><p id='custom_msg_container'></p></div>");
};

var saveChanges = function () {
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
    $("#modal").css("display", "none");
};

$(document).ready(function () {
    var insertRight = false, categoryName, character, i;
    
    for (categoryName in categories) {
        if (categoryName == "DS") {
            insertRight = true;
        }
        
        $(insertRight ? "#characters2" : "#characters1").append("<div id='" + categoryName + "'>");
        
        for (i in categories[categoryName]) {
            character = categories[categoryName][i];
            $("#" + categoryName).append("<span id='" + character.removeSpaces() + "C'><img id='" + character.removeSpaces() +
            "' class='list' src='tiers/" + categoryName + "/" + character.removeSpaces() + ".jpg' alt='" + character +
            "' onClick='removeFromTier(\"" + following + "\", false); followMouse(\"" + character.removeSpaces() + "\"); updateMouseLoc(event);'></span>");
        }
        
        $(insertRight ? "#characters2" : "#characters1").append("</div>");
    }
    
    try {
        var tiersCookie = JSON.parse(getCookie("tiers")), tierNum;

        for (tierNum = 0; tierNum < Object.keys(tiersCookie).length; tierNum++) {
            tiers[tierNum] = {};
            tiers[tierNum].name = tiersCookie[tierNum].name;
            tiers[tierNum].colour = tiersCookie[tierNum].colour;
            tiers[tierNum].chars = [];
            tiers[tierNum].flag = tiersCookie[tierNum].flag;
            
            if (!tiers[tierNum].flag) {
                $("#tier_list_tbody").append("<tr id='tr" + tierNum + "'><th id='th" + tierNum + "' class='tier_header' onClick='moveToTop(" + tierNum +
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
    } catch (error) {
        addTier("A");
        $("#tier_list_table").css("max-width", $("#wrap").width());
    }
});