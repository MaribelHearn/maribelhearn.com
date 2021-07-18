var SPECIES = ["Human", "Magician", "Devil", "Ghost", "Yuki-onna", "Night sparrow", "Tengu", "Kappa",
    "Tsurube-otoshi", "Tsuchigumo", "Hashihime", "Satori", "Shuchuu", "Tsukumogami", "Nyuudou",
    "Nue", "Daidarabotchi", "Yamabiko", "Zombie", "Gashadokuro", "Kirin", "Wanyuudou", "Katawa-guruma",
    "Zashiki-warashi", "Hobgoblin", "Enenra", "Mermaid", "Rokurokubi", "Amanojaku", "Baku", "Yamanba"],
    NUMBERS = ["None", "1", "2", "3", "4", "5+"],
    NUMBER_OF_CHARS = 162,
    NUMBER_OF_LOCATIONS = 33,
    WIDTH = 120,
    BREAK_WORD = 24,
    NUMBER_OF_SLOTS = 9,
    MAX_NUMBER = 5,
    slotTitles = ["You are a ...", "Best friend", "Hates you", "First kiss", "Has a crush on you",
    "Married to", "Honeymoon location", "No. of children", "Cockblocked by"],
    chars = {},
    locs = {},
    slots = [],
    speed = 100,
    running;

String.prototype.escapeHTML = function () {
    return this.replace('<', "&lt;").replace('>', "&gt;").replace('&', "&amp;");
}

function isOnSecondSheet(slot) {
    var charNum = slots[slot] / WIDTH;

    if (charNum >= NUMBER_OF_CHARS / 2) {
        $("#slot" + slot).addClass("charslot_2");
        $("#slot" + slot).removeClass("charslot_1");
        return true;
    } else {
        $("#slot" + slot).addClass("charslot_1");
        $("#slot" + slot).removeClass("charslot_2");
        return false;
    }
}

function randomiseImage(max, slot, previous) {
    var secondSheet;

    slots[slot] = Math.floor(Math.random() * (max - 1)) * WIDTH;
    secondSheet = isOnSecondSheet(slot);

    if (slots[slot] == previous) {
        slots[slot] += (slots[slot] == WIDTH * (max - 1) ? -1 * WIDTH : WIDTH);
    }

    if (max == NUMBER_OF_CHARS && secondSheet) {
        slots[slot] -= NUMBER_OF_CHARS * WIDTH / 2;
    }

    $("#slot" + slot).css("background-position", "-" + slots[slot] + "px 0");

    if (max == NUMBER_OF_CHARS) {
        $("#slot" + slot).html("<div id='text" + slot + "' class='name'>" + chars[slots[slot]] + "</div>");
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
    var previous, species, slot;

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
function start() {
    if (running) {
        return;
    }

    running = setInterval(tick, speed);
}
function stop() {
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

function isMobile() {
    return navigator.userAgent.contains("Mobile") || navigator.userAgent.contains("Tablet");
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
    $("#content, #hy_container, h1").css("display", "none");
    try {
        html2canvas(document.getElementById("table"), {
            backgroundColor: backgroundColour()
        }).then(function(canvas) {
            var base64image = canvas.toDataURL("image/png"), link;

            $("#modal_inner").html("<h2>Screenshot</h2>");
            $("#modal_inner").append("<p><a id='save_link' href='" + base64image + "' download='" + fileName() + "'>" +
            "<input type='button' value='Save to Device'></a></p>" +
            "<p class='descr'>This feature currently does not work on Chromium-based browsers.</p>" +
            "<p><img id='base64' src='" + base64image + "' alt='Slot machine screenshot'></p>");
            $("#modal_inner, #modal, #content, h1").css("display", "block");
            $("#hy_container").css("display", "inline");
            $("#base64").css("max-width", screen.width);
            $("#base64").css("max-height", screen.width);
        });
    } catch (err) {
        $("#content, #hy_container, h1").css("display", "block");
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
    $("#start").on("click", start);
    $("#stop").on("click", stop);
    $("#screenshot").on("click", takeScreenshot);
    $("#reset").on("click", reset);
    $("body").on("click", closeModal);
    $("body").on("keyup", closeModal);
}

function changeTitle(event, id) {
    if ((event.key && event.key == "Enter") || event.type == "click") {
        $("#title" + event.data.id).html($("#custom_title").val().escapeHTML());
        slotTitles[event.data.id] = $("#custom_title").val();
        localStorage.setItem("slotTitles", JSON.stringify(slotTitles));
        emptyModal();
    }
}

function titleMenu(event, id) {
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
    var tempChars = $("#chars_load").children(), tempLocs = $("#locs_load").children(), i;

    for (i = 0; i < tempChars.length * WIDTH; i += WIDTH) {
        chars[i] = tempChars[i / WIDTH].value;
    }

    for (i = 0; i < tempLocs.length * WIDTH; i += WIDTH) {
        locs[i] = tempLocs[i / WIDTH].value;
    }

    $("#chars_load, #locs_load").remove();
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
