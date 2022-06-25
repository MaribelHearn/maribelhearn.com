/*global CHARS LOCATIONS html2canvas isMobile getCookie*/
const SPECIES = ["Human", "Magician", "Devil", "Ghost", "Yuki-onna", "Night sparrow", "Tengu", "Kappa",
"Tsurube-otoshi", "Tsuchigumo", "Hashihime", "Satori", "Shuchuu", "Tsukumogami", "Nyuudou",
"Nue", "Daidarabotchi", "Yamabiko", "Zombie", "Gashadokuro", "Kirin", "Wanyuudou", "Katawa-guruma",
"Zashiki-warashi", "Hobgoblin", "Enenra", "Mermaid", "Rokurokubi", "Amanojaku", "Baku", "Yamanba"];
const NUMBERS = ["None", "1", "2", "3", "4", "5+"];
const OFFSET = -120;
const ROW_SIZE = 9;
const NUMBER_OF_SLOTS = 9;
const MAX_TITLE_LENGTH = 30;
const SPEED = 100;
const BANNED_CHARS = ['<', '>', '&'];
let slotTitles = ["You are a ...", "Best friend", "Hates you", "First kiss", "Has a crush on you", "Married to", "Honeymoon location", "No. of children", "Cockblocked by"];
let slots = [];
let running, currentID;

function randomiseImage(max, slot, previous) {
    slots[slot] = Math.floor(Math.random() * (max - 1));

    if (slots[slot] == previous) {
        slots[slot] = (slots[slot] + 1) % max;
    }

    let x = (slots[slot] % ROW_SIZE) * OFFSET;
    let y = Math.floor(slots[slot] / ROW_SIZE) * OFFSET;
    document.getElementById(`slot${slot}`).style.backgroundPosition = `${x}px ${y}px`;

    if (max == CHARS.length) {
        document.getElementById(`slot${slot}`).innerHTML = `<div id='text${slot}' class='name'>${CHARS[slots[slot]]}</div>`;
    } else {
        document.getElementById(`slot${slot}`).innerHTML = `<div id='text${slot}' class='name'>${LOCATIONS[slots[slot]]}</div>`;
    }
}

function randomiseArray(array, slot, previous) {
    slots[slot] = Math.floor(Math.random() * array.length);

    if (slots[slot] == previous) {
        slots[slot] = (slots[slot] == array.length - 1 ? 0 : slots[slot] + 1);
    }

    document.getElementById(`slot${slot}`).innerHTML = array[slots[slot]];
}

function tick() {
    for (let slot = 0; slot < NUMBER_OF_SLOTS; slot++) {
        const previous = slots[slot];

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

function emptyModal() {
    document.getElementById("modal_title").style.display = "none";
    document.getElementById("modal_screenshot").style.display = "none";
    document.getElementById("modal").style.display = "none";
}

function closeModal(event) {
    const modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.key && event.key == "Escape")) {
        emptyModal();
    }
}

function startSlots() {
    if (running) {
        return;
    }

    running = setInterval(tick, SPEED);
}

function stopSlots() {
    clearInterval(running);
    running = undefined;
}

function fileName() {
    const date = new Date();
    const month = (date.getMonth() + 1).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const day = (date.getDate()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const hours = (date.getHours()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const minutes = (date.getMinutes()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    const seconds = (date.getSeconds()).toLocaleString("en-US", {minimumIntegerDigits: 2});
    return `touhou_slot_machine_${date.getFullYear()}_${month}_${day}_${hours}_${minutes}_${seconds}.png`;
}


function backgroundColour() {
    return getCookie("theme") == "dark" ? "#202020" : "white";
}

function takeScreenshot() {
    const width = document.getElementById("table").offsetWidth + 20;
    const height = document.getElementById("table").offsetHeight + (isMobile() ? 20 : 0);
    const windowHeight = height + (isMobile() ? 15 : 0);

    try {
        html2canvas(document.body, {
            "onclone": function (doc) {
                doc.getElementsByTagName("body")[0].style.backgroundImage = "none";
                doc.getElementById("table").style.marginLeft = "0px";
            },
            "backgroundColor": backgroundColour(),
            "windowWidth": width,
            "width": width,
            "windowHeight": windowHeight,
            "height": height,
            "logging": false
        }).then(function(canvas) {
            const base64 = canvas.toDataURL("image/png");
            document.getElementById("screenshot_base64").src = base64;
            document.getElementById("save_link").href = base64;
            document.getElementById("save_link").download = fileName();
            document.getElementById("modal_screenshot").style.display = "block";
            document.getElementById("modal").style.display = "block";
        });
    } catch (err) {
        alert("Your browser is outdated. Use a different browser to screenshot your slot machine.");
    }
}

function reset() {
    slotTitles = ["You are a ...", "Best friend", "Hates you", "First kiss", "Has a crush on you", "Married to", "Honeymoon location", "No. of children", "Cockblocked by"];
    localStorage.removeItem("slotTitles");

    for (let i = 0; i < NUMBER_OF_SLOTS; i++) {
        document.getElementById(`title${i}`).innerHTML = slotTitles[i];
    }
}

function checkBannedChars(event) {
    if (event.key && BANNED_CHARS.includes(event.key)) {
        event.preventDefault();
        return;
    }
}

function setEventListeners() {
    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", closeModal, false);
    document.getElementById("start").addEventListener("click", startSlots, false);
    document.getElementById("stop").addEventListener("click", stopSlots, false);
    document.getElementById("screenshot").addEventListener("click", takeScreenshot, false);
    document.getElementById("reset").addEventListener("click", reset, false);
    document.getElementById("change_title").addEventListener("click", titleChanged, false);
    document.getElementById("custom_title").addEventListener("keyup", titleChanged, false);
    document.getElementById("custom_title").addEventListener("keypress", checkBannedChars, false);
    document.getElementById("custom_title").addEventListener("onblur", titleChanged, false);
}

function updateTitle() {
    const title = document.getElementById("custom_title").value;

    if (title.length > MAX_TITLE_LENGTH) {
        return;
    }

    document.getElementById(`title${currentID}`).innerHTML = title;
    slotTitles[currentID] = title;
    localStorage.setItem("slotTitles", JSON.stringify(slotTitles));
    emptyModal();
}

function titleChanged(event) {
    const length = document.getElementById("custom_title").value.length;
    document.getElementById("title_length").innerHTML = `${length}/${MAX_TITLE_LENGTH}`;

    if (event.key || event.type == "click") {
        if (event.key == "Enter" || event.type == "click") {
            updateTitle();
            return;
        }


        if (length > MAX_TITLE_LENGTH) {
            document.getElementById("title_length").style.color = "red";
            document.getElementById("title_length").style.fontWeight = "bold";
        } else {
            document.getElementById("title_length").style.color = "gray";
            document.getElementById("title_length").style.fontWeight = "normal";
        }
    }
}

function titleMenu(event) {
    const id = event.target.id.replace(/[a-z]/g, "");
    document.getElementById("custom_title").value = slotTitles[id];
    document.getElementById("title_length").innerHTML = `${slotTitles[id].length}/${MAX_TITLE_LENGTH}`;
    document.getElementById("modal_title").style.display = "block";
    document.getElementById("modal").style.display = "block";
    currentID = id;
}

function init() {
    setEventListeners();

    if (localStorage.hasOwnProperty("slotTitles")) {
        slotTitles = JSON.parse(localStorage.getItem("slotTitles"));
    } else {
        localStorage.setItem("slotTitles", JSON.stringify(slotTitles));
    }

    for (let i = 0; i < NUMBER_OF_SLOTS; i++) {
        document.getElementById(`title${i}`).addEventListener("click", titleMenu, false);

        if (localStorage.hasOwnProperty("slotTitles")) {
            document.getElementById(`title${i}`).innerHTML = slotTitles[i];
        }
    }
}

window.addEventListener("DOMContentLoaded", init, false);
