/*global TRANSLATIONS*/
/*eslint no-unused-vars: 0*/
const MAX_SCORE = 9999999990;
const MAX_AGE = "Fri, 31 Dec 9999 23:59:59 UTC";
const MIN_AGE = "Thu, 01 Jan 1970 00:00:00 UTC";
const head = document.getElementsByTagName("head")[0];
const hy = document.getElementById("hy_container");
let done = false;

window.addEventListener("DOMContentLoaded", ready, false);

if (hy) {
    hy.addEventListener("click", theme);
}

String.prototype.removeSpaces = function () {
    return this.replace(/ /g, "");
};

Object.defineProperty(Array.prototype, "pushStrict", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        if (!this.includes(value)) {
            this.push(value);
        }
    }
});

function _(text) {
    if (!["/drc", "/lnn", "/wr"].includes(location.pathname)) {
        return text;
    }

    return !TRANSLATIONS[text] || TRANSLATIONS[text][1] === "" ? text : TRANSLATIONS[text][1];
}

function isMobile() {
    return navigator.userAgent.includes("Mobile") || navigator.userAgent.indexOf("Tablet");
}

function setCookie(name, value) {
    document.cookie = name + "=" + value + ";expires=" + MAX_AGE + ";path=/;sameSite=Strict;" + (location.protocol == "https:" ? "Secure;" : "");
}

function getCookie(name) {
    let decodedCookies = decodeURIComponent(document.cookie);
    let cookieArray = decodedCookies.split(';');
    name += '=';

    for (let cookie of cookieArray) {
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }

        if (cookie.indexOf(name) === 0) {
            try {
                return JSON.parse(cookie.substring(name.length, cookie.length));
            } catch (err) {
                return JSON.parse("\"" + cookie.substring(name.length, cookie.length) + "\"");
            }
        }
    }

    return "";
}

function deleteCookie(name) {
    document.cookie = name + "=;expires=" + MIN_AGE + ";path=/;";
}

function dark() {
    const page = location.pathname.split('/')[1];
    let style = document.createElement("link");
    style.id = "dark_theme";
    style.href = (location.host != "localhost" || location.pathname.includes("error") ? "https://maribelhearn.com/" : "/") + "assets/shared/dark.css";
    style.type = "text/css";
    style.rel = "stylesheet";
    head.appendChild(style);

    if (["lnn", "gensokyo", "royalflare", "wr"].includes(page)) {
        style = document.createElement("style");
        style.id = "dark_theme_table";
        style.innerText = "tr:not(.west_tr):nth-child(even),tr.west_tr:nth-child(odd),#player_td{background-color:#555555;}";
        head.appendChild(style);
    }
}

function ready() {
    if (done) {
        return;
    }

    done = true;

    if (localStorage.theme) { // legacy
        document.cookie = "theme=dark;expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;Secure;";
        localStorage.removeItem("theme");
        document.getElementById("hy_text").innerHTML = _("Youkai mode (Dark)");
        dark();
    }

    if (document.getElementById("hy_link")) {
        document.getElementById("hy_container").innerHTML = document.getElementById("hy_link").innerHTML;
    }
}

function theme() {
    if (getCookie("theme") == "dark") {
        document.cookie = "theme=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;" +
        "sameSite=Strict;" + (location.protocol == "https:" ? "Secure;" : "");
        document.getElementById("hy_text").innerHTML = _("Human mode (Light)");

        if (document.head.contains(document.getElementById("dark_theme_table"))) {
            head.removeChild(document.getElementById("dark_theme_table"));
        }

        if (document.head.contains(document.getElementById("dark_theme"))) {
            head.removeChild(document.getElementById("dark_theme"));
        } else {
            window.location.reload(false);
        }
    } else {
        let cookieString = ";expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;";

        if (location.protocol == "https:") {
            cookieString += "Secure;";
        }

        document.cookie = "theme=dark" + cookieString;
        document.getElementById("hy_text").innerHTML = _("Youkai mode (Dark)");
        dark();
    }

    if (localStorage.theme) { // legacy
        localStorage.removeItem("theme");
    }
}

function sep(number) {
    if (isNaN(number)) {
        return '-';
    }

    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function monthToNumber(month) {
    return {
        "January": 1,
        "February": 2,
        "March": 3,
        "April": 4,
        "May": 5,
        "June": 6,
        "July": 7,
        "August": 8,
        "September": 9,
        "October": 10,
        "November": 11,
        "December": 12
    }[month];
}

function gameAbbr(game) {
    return ({
        "HRtP": 1,
        "SoEW": 2,
        "PoDD": 3,
        "LLS": 4,
        "MS": 5,
        "EoSD": 6,
        "PCB": 7,
        "IN": 8,
        "PoFV": 9,
        "MoF": 10,
        "SA": 11,
        "UFO": 12,
        "GFW": 128,
        "TD": 13,
        "DDC": 14,
        "LoLK": 15,
        "HSiFS": 16,
        "WBaWC": 17,
        "UM": 18
    })[game];
}

function fullNameNumber(game) {
    return ({
        "HRtP": "Touhou 1 - The Highly Responsive to Prayers",
        "SoEW": "Touhou 2 - The Story of Eastern Wonderland",
        "PoDD": "Touhou 3 - Phantasmagoria of Dim.Dream",
        "LLS": "Touhou 4 - Lotus Land Story",
        "MS": "Touhou 5 - Mystic Square",
        "EoSD": "Touhou 6 - The Embodiment of Scarlet Devil",
        "PCB": "Touhou 7 - Perfect Cherry Blossom",
        "IN": "Touhou 8 - Imperishable Night",
        "PoFV": "Touhou 9 - Phantasmagoria of Flower View",
        "StB": "Touhou 9.5 - Shoot the Bullet",
        "MoF": "Touhou 10 - Mountain of Faith",
        "SA": "Touhou 11 - Subterranean Animism",
        "UFO": "Touhou 12 - Undefined Fantastic Object",
        "DS": "Touhou 12.5 - Double Spoiler",
        "GFW": "Touhou 12.8 - Great Fairy Wars",
        "TD": "Touhou 13 - Ten Desires",
        "DDC": "Touhou 14 - Double Dealing Character",
        "LoLK": "Touhou 15 - Legacy of Lunatic Kingdom",
        "HSiFS": "Touhou 16 - Hidden Star in Four Seasons",
        "WBaWC": "Touhou 17 - Wily Beast and Weakest Creature",
        "UM": "Touhou 18 - Unconnected Marketeers"
    }[game]);
}

function shottypeAbbr(shottype) {
    return ({
        "Reimu": "Re",
        "ReimuA": "RA",
        "ReimuB": "RB",
        "ReimuC": "RC",
        "Marisa": "Ma",
        "MarisaA": "MA",
        "MarisaB": "MB",
        "MarisaC": "MC",
        "Sakuya": "Sk",
        "SakuyaA": "SA",
        "SakuyaB": "SB",
        "Sanae": "Sa",
        "SanaeA": "SA",
        "SanaeB": "SB",
        "BorderTeam": "BT",
        "MagicTeam": "MT",
        "ScarletTeam": "ST",
        "GhostTeam": "GT",
        "Yukari": "Yu",
        "Alice": "Al",
        "Remilia": "Rr",
        "Youmu": "Yo",
        "Yuyuko": "Yy",
        "Reisen": "Ud",
        "Cirno": "Ci",
        "Lyrica": "Ly",
        "Mystia": "My",
        "Tewi": "Te",
        "Aya": "Ay",
        "Medicine": "Me",
        "Yuuka": "Yu",
        "Komachi": "Ko",
        "Eiki": "Ei",
        "Hatate": "Ha",
        "A1": "A1",
        "A2": "A2",
        "B1": "B1",
        "B2": "B2",
        "C1": "C1",
        "C2": "C2",
        "-": "tr",
        "ReimuSpring": "RS",
        "ReimuSummer": "RU",
        "ReimuAutumn": "RA",
        "ReimuWinter": "RW",
        "CirnoSpring": "CS",
        "CirnoSummer": "CU",
        "CirnoAutumn": "CA",
        "CirnoWinter": "CW",
        "AyaSpring": "AS",
        "AyaSummer": "AU",
        "AyaAutumn": "AA",
        "AyaWinter": "AW",
        "MarisaSpring": "MS",
        "MarisaSummer": "MU",
        "MarisaAutumn": "MA",
        "MarisaWinter": "MW",
        "ReimuWolf": "RW",
        "ReimuOtter": "RO",
        "ReimuEagle": "RE",
        "MarisaWolf": "MW",
        "MarisaOtter": "MO",
        "MarisaEagle": "ME",
        "YoumuWolf": "YW",
        "YoumuOtter": "YO",
        "YoumuEagle": "YE"
    })[shottype];
}
