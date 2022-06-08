/*global STATS DESCRIPTIONS isMobile setCookie getCookie*/
let language = "en_GB";
const TIER = {
    "marisa": "S",
    "reimu": "S",
    "youmu": "S",
    "komachi": "A",
    "eiki": "A",
    "lyrica": "B",
    "medicine": "B",
    "reisen": "B",
    "lunasa": "C",
    "merlin": "C",
    "yuuka": "D",
    "sakuya": "D",
    "aya": "D",
    "tewi": "E",
    "mystia": "E",
    "cirno": "E"
};
const ABILITY = {
    "youmu": "Bullet-cancelling sword",
    "marisa": "Energy fills faster",
    "reimu": "Small hitbox",
    "komachi": "Scope instantly activates all spirits in her field",
    "eiki": "Activated spirits only emit a single red bullet",
    "lyrica": "Can shoot backwards as well as forwards",
    "medicine": "Cannot be hit by spirits",
    "yuuka": "Three-way shots",
    "reisen": "Activated spirits drift upwards faster",
    "sakuya": "Activated spirits do not drift upwards",
    "lunasa": "Three-way shots",
    "merlin": "Slanted shots",
    "aya": "Slightly slows down bullets in her field",
    "mystia": "Attracts spirits towards her",
    "cirno": "Activated spirits take longer to self-destruct",
    "tewi": "Auto-bombs when hit at 0.5 health"
};
const SCOPE = {
    "youmu": "Huge circle that deploys very slowly",
    "marisa": "Forward focused scope that slowly expands horizontally",
    "reimu": "Basic circle that deploys pretty slowly",
    "komachi": "Entire screen, then shrinks into nothing",
    "eiki": "Basic circle that deploys really quickly",
    "lyrica": "Vertical line that slowly expands horizontally",
    "medicine": "Star pattern with decent deployment speed",
    "yuuka": "Medium-sized, average speed circle with spinning small circles",
    "reisen": "Eye formation that turns based on the player's movement",
    "sakuya": "Fan shape that moves opposite to the player's movement",
    "lunasa": "Two thin lines forming a cross",
    "merlin": "Horizontal line that deploys slowly",
    "aya": "Medium-sized fan shape with slow deployment",
    "mystia": "Small circle that quickly deploys in front of the player",
    "cirno": "Small circle that deploys fast",
    "tewi": "Big flat eye that deploys at a decent speed"
};
const MIN_SPEED = 148;
const MIN_CHARGE = 45.5;

function emptyModal() {
    document.getElementById("modal_inner").innerHTML = "";
    document.getElementById("modal_inner").style.display = "none";
    document.getElementById("modal").style.display = "none";
}

function closeModal(event) {
    const modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.key && event.key == "Escape")) {
        emptyModal();
    }
}

function charInfo() {
    const chara = this.title.split(' ')[0].toLowerCase();
    const speed = MIN_SPEED - STATS[chara].speed;
    const focus = Math.max(MIN_SPEED - STATS[chara].focus, 1.5);
    //const scope = Math.max(minScope - STATS[char].scope, 3);
    const charge = Math.max(MIN_CHARGE - STATS[chara].charge, 0.3);

    emptyModal();

    if (isMobile()) {
        document.getElementById("modal_inner").innerHTML = "<h2>" + this.title + "</h2><table class='noborders'><tr>" +
        "<td class='noborders'><img class='art' src='assets/games/pofv/characters/" + chara + ".png' alt='" + this.title + "'></td>" +
        "<td class='noborders'><table class='stats noborders'>" +
        "<tr><td class='noborders'>Tier</td>" +
        "<td class='noborders'><strong class='" + TIER[chara] + "'>" + TIER[chara] + "</strong></td></tr>" +
        "<tr><td class='noborders'>Normal Speed</td><td class='noborders'><progress value='" + speed + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Focused Speed</td><td class='noborders'><progress value='" + focus + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Charge Speed</td><td class='noborders'><progress value='" + charge + "' max='20.5'></td></tr>" +
        "<tr><td class='noborders'>Charge Delay</td><td class='noborders'>" + STATS[chara].delay + " frames</td></tr>" +
        "<tr><td class='noborders'>Special Ability</td><td class='noborders'>" + ABILITY[chara] + "</td></tr>" +
        "<tr><td class='noborders'>Scope</td><td class='noborders'>" + SCOPE[chara] + "</td></tr></table>" +
        "</td></tr></table><img class='scope' src='assets/games/pofv/scopes/" + chara +
        ".jpg'><p class='descr'>" + DESCRIPTIONS[chara][language] + "</p>";
    } else {
        document.getElementById("modal_inner").innerHTML = "<h2>" + this.title + "</h2><table class='noborders'><tr>" +
        "<td class='noborders'><img class='art' src='assets/games/pofv/characters/" + chara + ".png' alt='" + this.title + "'></td>" +
        "<td class='noborders'><table class='stats noborders'>" +
        "<tr><td class='noborders'>Tier</td>" +
        "<td class='noborders'><strong class='" + TIER[chara] + "'>" + TIER[chara] + "</strong></td></tr>" +
        "<tr><td class='noborders'>Normal Speed</td><td class='noborders'><progress value='" + speed + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Focused Speed</td><td class='noborders'><progress value='" + focus + "' max='98'></td></tr>" +
        "<tr><td class='noborders'>Charge Speed</td><td class='noborders'><progress value='" + charge + "' max='20.5'></td></tr>" +
        "<tr><td class='noborders'>Charge Delay</td><td class='noborders'>" + STATS[chara].delay + " frames</td></tr>" +
        "<tr><td class='noborders'>Special Ability</td><td class='noborders'>" + ABILITY[chara] + "</td></tr>" +
        "<tr><td class='noborders'>Scope</td><td class='noborders'>" + SCOPE[chara] + "</td></tr></table></td>" +
        "<td class='noborders'><img class='scope' src='assets/games/pofv/scopes/" + chara + ".jpg'></td></tr></table>" +
        "<p class='descr'>" + DESCRIPTIONS[chara][language] + "</p>";
    }

    document.getElementById("modal_inner").innerHTML += "";
    document.getElementById("modal_inner").style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function setLanguage(event) {
    let newLanguage;

    if (event.target.id == "en_GB" || event.target.parentNode.id == "en_GB") {
        newLanguage = (getCookie("lang") == "en_US" ? "en_US" : "en_GB");
    } else {
        newLanguage = "zh_CN";
    }

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    location.href = location.href.split('#')[0].split('?')[0];
    setCookie("lang", newLanguage);
}

function init() {
    if (getCookie("lang") == "zh_CN" || location.href.includes("?hl=zh")) {
        language = "zh_CN";
    } else if (getCookie("lang") == "en_US" || location.href.includes("?hl=en-us")) {
        language = "en_GB";
    }

    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", closeModal, false);
    document.getElementById("en").addEventListener('click', setLanguage, false);
    document.getElementById("zh").addEventListener("click", setLanguage, false);
    const chars = document.querySelectorAll(".char");
    const flags = document.querySelectorAll(".flag");

    for (const chara of chars) {
        chara.addEventListener("click", charInfo, false);
    }

    for (const flag of flags) {
        flag.setAttribute("href", "");
    }
}

window.addEventListener("DOMContentLoaded", init, false);
