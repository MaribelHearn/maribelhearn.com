/*global $ CHARS LOCATIONS html2canvas isMobile getCookie*/
var SPECIES = ["Human", "Magician", "Devil", "Ghost", "Yuki-onna", "Night sparrow", "Tengu", "Kappa",
    "Tsurube-otoshi", "Tsuchigumo", "Hashihime", "Satori", "Shuchuu", "Tsukumogami", "Nyuudou",
    "Nue", "Daidarabotchi", "Yamabiko", "Zombie", "Gashadokuro", "Kirin", "Wanyuudou", "Katawa-guruma",
    "Zashiki-warashi", "Hobgoblin", "Enenra", "Mermaid", "Rokurokubi", "Amanojaku", "Baku", "Yamanba"],
    NUMBERS = ["None", "1", "2", "3", "4", "5+"],
    OFFSET = -120,
    ROW_SIZE = 9,
    NUMBER_OF_SLOTS = 9,
    MAX_TITLE_LENGTH = 30,
    slotTitles = ["You are a ...", "Best friend", "Hates you", "First kiss", "Has a crush on you",
    "Married to", "Honeymoon location", "No. of children", "Cockblocked by"],
    bannedChars = ['<', '>', '&'],
    slots = [],
    speed = 100,
    running;

function randomiseImage(max, slot, previous) {
    var x, y;

    slots[slot] = Math.floor(Math.random() * (max - 1));

    if (slots[slot] == previous) {
        slots[slot] = (slots[slot] + 1) % max;
    }

    x = (slots[slot] % ROW_SIZE) * OFFSET;
    y = Math.floor(slots[slot] / ROW_SIZE) * OFFSET;
    $("#slot" + slot).css("background-position", x + "px " + y + "px");

    if (max == CHARS.length) {
        $("#slot" + slot).html("<div id='text" + slot + "' class='name'>" + CHARS[slots[slot]] + "</div>");
    } else {
        $("#slot" + slot).html("<div id='text" + slot + "' class='name'>" + LOCATIONS[slots[slot]] + "</div>");
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
            randomiseImage(LOCATIONS.length, slot, previous);
        } else if (slot == 7) {
            randomiseArray(NUMBERS, slot, previous);
        } else {
            randomiseImage(CHARS.length, slot, previous);
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

function updateTitle(event) {
    var title = $("#custom_title").val();

    if (title.length > MAX_TITLE_LENGTH) {
        return;
    }

    $("#title" + event.data.id).html(title);
    slotTitles[event.data.id] = title;
    localStorage.setItem("slotTitles", JSON.stringify(slotTitles));
    emptyModal();
}

function titleChanged(event) {
    var length = $("#custom_title").val().length;

    if (event.key || event.type == "click") {
        if (event.key == "Enter" || event.type == "click") {
            updateTitle(event);
            return;
        }

        $("#title_length").html(length + "/" + MAX_TITLE_LENGTH);

        if (length > MAX_TITLE_LENGTH) {
            $("#title_length").css({"color": "red", "font-weight": "bold"});
        } else {
            $("#title_length").css({"color": "grey", "font-weight": "normal"});
        }
    }
}

function checkBannedChars(event) {
    if (event.key && bannedChars.includes(event.key)) {
        event.preventDefault();
        return;
    }
}

function titleMenu(event) {
    emptyModal();
    $("#modal_inner").html("<h2>Change Title</h2><p><input id='custom_title' " +
    "type='text' value='" + slotTitles[event.data.id] +
    "'><small id='title_length'>" + slotTitles[event.data.id].length +
    "/" + MAX_TITLE_LENGTH + "</small></p>" +
    "<p><input id='change_title' type='button' value='Change'></p>");
    $("#custom_title").on("keyup", {id: event.data.id}, titleChanged);
    $("#change_title").on("click", {id: event.data.id}, titleChanged);
    $("#custom_title").on("keypress", checkBannedChars);
    $("#modal_inner").css("display", "block");
    $("#modal").css("display", "block");
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
});
