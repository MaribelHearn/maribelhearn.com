/*global $ html2canvas*/
var SPECIES = ["Human", "Magician", "Devil", "Ghost", "Yuki-onna", "Night sparrow", "Tengu", "Kappa",
    "Tsurube-otoshi", "Tsuchigumo", "Hashihime", "Satori", "Shuchuu", "Tsukumogami", "Nyuudou",
    "Nue", "Daidarabotchi", "Yamabiko", "Zombie", "Gashadokuro", "Kirin", "Wanyuudou", "Katawa-guruma",
    "Zashiki-warashi", "Hobgoblin", "Enenra", "Mermaid", "Rokurokubi", "Amanojaku", "Baku", "Yamanba"],
    NUMBERS = ["None", "1", "2", "3", "4", "5+"],
    NUMBER_OF_CHARS_FIRST = 81,
    NUMBER_OF_CHARS = 164,
    NUMBER_OF_LOCATIONS = 33,
    WIDTH = 120,
    NUMBER_OF_SLOTS = 9,
    slotTitles = ["You are a ...", "Best friend", "Hates you", "First kiss", "Has a crush on you",
    "Married to", "Honeymoon location", "No. of children", "Cockblocked by"],
    chars = {'1': {}, '2': {}},
    locs = {},
    slots = [],
    speed = 100,
    running;

String.prototype.escapeHTML = function () {
    return this.replace('<', "&lt;").replace('>', "&gt;").replace('&', "&amp;");
}

function isMobile() {
    return navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1;
}

function checkSpritesheet(max, slot) {
    var charNum = slots[slot] / WIDTH;

    if (charNum >= NUMBER_OF_CHARS_FIRST) {
        $("#slot" + slot).addClass("charslot_2");
        $("#slot" + slot).removeClass("charslot_1");
        slots[slot] -= NUMBER_OF_CHARS_FIRST * WIDTH;
        return 2;
    } else {
        $("#slot" + slot).addClass("charslot_1");
        $("#slot" + slot).removeClass("charslot_2");
        return 1;
    }
}

function randomiseImage(max, slot, previous) {
    var spritesheet;

    slots[slot] = Math.floor(Math.random() * (max - 1)) * WIDTH;

    if (slots[slot] == previous) {
        slots[slot] += (slots[slot] == WIDTH * (max - 1) ? -1 * WIDTH : WIDTH);
    }

    if (max == NUMBER_OF_CHARS) {
        spritesheet = checkSpritesheet(max, slot);
    }

    $("#slot" + slot).css("background-position", "-" + slots[slot] + "px 0");

    if (max == NUMBER_OF_CHARS) {
        $("#slot" + slot).html("<div id='text" + slot + "' class='name'>" + chars[spritesheet][slots[slot]] + "</div>");
    } else {
        $("#slot" + slot).html("<div id='text" + slot + "' class='name'>" + locs[slots[slot]] + "</div>");
    }
}

function randomiseArray(array, slot, previous) {
    slots[slot] = Math.floor(Math.random() * array.length);

    if (slots[slot] == previous) {
        slots[slot] = (slots[slot] == array.length - 1 ? 0 : slots[slot] + 1);
    }

    $("#slot" + slot).html(array[slots[slot]]);
}

function tick() {
    var previous, slot;

    for (slot = 0; slot < NUMBER_OF_SLOTS; slot++) {
        previous = slots[slot];

        if (slot === 0) {
            randomiseArray(SPECIES, slot, previous);
        } else if (slot == 6) {
            randomiseImage(NUMBER_OF_LOCATIONS, slot, previous);
        } else if (slot == 7) {
            randomiseArray(NUMBERS, slot, previous);
        } else {
            randomiseImage(NUMBER_OF_CHARS, slot, previous);
        }

    }
}

function startSlots() {
    if (running) {
        return;
    }

    running = setInterval(tick, speed);
}

function stopSlots() {
    clearInterval(running);
    running = undefined;
}

function emptyModal() {
    $("#modal_inner").html("");
    $("#modal_inner").css("display", "none");
    $("#modal").css("display", "none");
}

function fileName() {
    var date = new Date(),
        month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2}),
        seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});

    return "touhou_slot_machine_" + date.getFullYear() + "_" + month +
    "_" + day + "_" + hours + "_" + minutes + "_" + seconds + ".png";
}

function getCookie(name) {
    var decodedCookies, cookieArray, cookie;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');
    name += '=';

    for (var i = 0; i < cookieArray.length; i += 1) {
        cookie = cookieArray[i];

        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }

        if (cookie.indexOf(name) === 0) {
            return JSON.parse(cookie.substring(name.length, cookie.length));
        }
    }

    return "";
}


function backgroundColour() {
    return getCookie("theme") == "dark" ? "#202020" : "white";
}

function takeScreenshot() {
    emptyModal();

    try {
        html2canvas(document.body, {
            "onclone": function (doc) {
                doc.getElementsByTagName("body")[0].style.backgroundImage = "none";
                doc.getElementById("table").style.marginLeft = "0px";
            },
            "backgroundColor": backgroundColour(),
            "windowWidth": $("#table").width() + 20,
            "width": $("#table").width() + 20,
            "windowHeight": $("#table").height() + (isMobile() ? 20 : 0),
            "height": $("#table").height() + (isMobile() ? 35 : 0),
            "logging": false
        }).then(function(canvas) {
            var base64image = canvas.toDataURL("image/png");

            $("#modal_inner").html("<h2>Screenshot</h2>");
            $("#modal_inner").append("<p><a id='save_link' href='" + base64image + "' download='" + fileName() + "'>" +
            "<input type='button' value='Save to Device'></a></p>" +
            "<p><img id='screenshot_base64' src='" + base64image + "' alt='Slot machine screenshot'></p>");
            $("#modal_inner, #modal").css("display", "block");
        });
    } catch (err) {
        alert("Your browser is outdated. Use a different browser to " +
        "screenshot your slot machine.");
    }
}

function reset() {
    slotTitles = ["You are a ...", "Best friend", "Hates you", "First kiss", "Has a crush on you",
    "Married to", "Honeymoon location", "No. of children", "Cockblocked by"];
    localStorage.removeItem("slotTitles");

    for (var i = 0; i < NUMBER_OF_SLOTS; i++) {
        $("#title" + i).html(slotTitles[i]);
    }
}

function closeModal(event) {
    var modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.key && event.key == "Escape")) {
        emptyModal();
    }
}

function setEventListeners() {
    $("#start").on("click", startSlots);
    $("#stop").on("click", stopSlots);
    $("#screenshot").on("click", takeScreenshot);
    $("#reset").on("click", reset);
    $("body").on("click", closeModal);
    $("body").on("keyup", closeModal);
}

function changeTitle(event) {
    if ((event.key && event.key == "Enter") || event.type == "click") {
        $("#title" + event.data.id).html($("#custom_title").val().escapeHTML());
        slotTitles[event.data.id] = $("#custom_title").val();
        localStorage.setItem("slotTitles", JSON.stringify(slotTitles));
        emptyModal();
    }
}

function titleMenu(event) {
    emptyModal();
    $("#modal_inner").html("<h2>Change Title</h2><p><input id='custom_title' " +
    "type='text' value='" + $("#title" + event.data.id).html() + "'></p>" +
    "<p><input id='change_title' type='button' value='Change'></p>");
    $("#custom_title").on("keyup", {id: event.data.id}, changeTitle);
    $("#change_title").on("click", {id: event.data.id}, changeTitle);
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
}

function loadCharsLocs() {
    var tempChars1 = $("#chars1_load").children(), tempChars2 = $("#chars2_load").children(),
        tempLocs = $("#locs_load").children(), i;

    for (i = 0; i < tempChars1.length * WIDTH; i += WIDTH) {
        chars['1'][i] = tempChars1[i / WIDTH].value;
    }

    for (i = 0; i < tempChars2.length * WIDTH; i += WIDTH) {
        chars['2'][i] = tempChars2[i / WIDTH].value;
    }

    for (i = 0; i < tempLocs.length * WIDTH; i += WIDTH) {
        locs[i] = tempLocs[i / WIDTH].value;
    }
    $("#chars1_load, #chars2_load, #locs_load").remove();
}

$(document).ready(function () {
    setEventListeners();

    if (localStorage.hasOwnProperty("slotTitles")) {
        slotTitles = JSON.parse(localStorage.getItem("slotTitles"));
    } else {
        localStorage.setItem("slotTitles", JSON.stringify(slotTitles));
    }

    for (var i = 0; i < NUMBER_OF_SLOTS; i++) {
        $("#title" + i).on("click", {id: i}, titleMenu);

        if (localStorage.hasOwnProperty("slotTitles")) {
            $("#title" + i).html(slotTitles[i]);
        }
    }

    loadCharsLocs();
});
