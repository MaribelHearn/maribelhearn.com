/*global detect*/
var head = document.getElementsByTagName("head")[0], done = false;

function expandCountries() {
    var elements = document.getElementsByTagName('*'), i;

    for (i in elements) {
        if (elements[i].className && elements[i].className == "hidden") {
            elements[i].style = "display: table-row";
        }
    }

    document.getElementById("expand").style = "display: none";
}

function set() {
    var cookieString = ";expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;";

    if (location.protocol == "https:") {
        cookieString += "Secure;";
    }

    document.cookie = "token=" + JSON.stringify(document.getElementById("token").value) + cookieString;
    alert("Blocking cookie set!");
}

function dark() {
    var style = document.createElement("link");

    style.id = "dark_theme";
    style.href = (location.host == "maribelhearn.com" ? "https://maribelhearn.com/" : "") + "../assets/shared/dark.css";
    style.type = "text/css";
    style.rel = "stylesheet";
    head.appendChild(style);
}

function ready() {
    if (done) {
        return;
    }

    done = true;

    if (localStorage.theme == "dark") { // legacy
        document.cookie = "theme=dark;expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;Secure;";
        localStorage.removeItem("theme");
        document.getElementById("hy_tooltip").innerHTML = "Youkai Mode";
        dark();
    }
}

function theme() {
    if (document.head.contains(document.getElementById("dark_theme")) || localStorage.theme == "dark") {
        if (document.head.contains(document.getElementById("dark_theme"))) {
            head.removeChild(document.getElementById("dark_theme"));
        }

        document.cookie = "theme=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;" +
        "sameSite=Strict;" + (location.protocol == "https:" ? "Secure;" : "");
        document.getElementById("hy_tooltip").innerHTML = "Human Mode";
    } else {
        var cookieString = ";expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;";

        if (location.protocol == "https:") {
            cookieString += "Secure;";
        }

        document.cookie = "theme=" + JSON.stringify("dark") + cookieString;
        document.getElementById("hy_tooltip").innerHTML = "Youkai Mode";
        dark();
    }

    if (localStorage.theme) { // legacy
        localStorage.removeItem("theme");
    }
}

function userAgent() {
    var ua = detect.parse(navigator.userAgent);

    document.getElementById("os").innerHTML = "<img src='" + (location.host == "maribelhearn.com" ? "https://maribelhearn.com/" : "") +
    "admin/icons/" + ua.os.name + ".png' alt='" + ua.os.name + " icon'> " + ua.os.name;
    document.getElementById("browser").innerHTML = "<img src='" + (location.host == "maribelhearn.com" ? "https://maribelhearn.com/" : "") +
    "admin/icons/" + ua.browser.family + ".png' alt='" + ua.browser.name + " icon'> " + ua.browser.name;
}

function addEventListeners() {
    var hy = document.getElementById("hy"), expand = document.getElementById("expand");

    document.getElementById("setcookie").addEventListener("click", set);
    window.addEventListener("load", ready);
    done = false;

    if (expand) {
        expand.addEventListener("click", expandCountries);
    }

    if (hy) {
        hy.addEventListener("click", theme);
    }
}

function addCacheEntries() {
    var entries = document.getElementById("new_cache_entries"), xhr = new XMLHttpRequest();

    if (!entries) {
        document.getElementById("response").innerHTML = "No new cache entries.";
    } else {
        xhr.open("POST", "/admin/cache.php?entries=" + entries.value);
        xhr.onload = function () {
            document.getElementById("response").innerHTML = this.response;
        };
        xhr.send();
    }
}

userAgent();
addEventListeners();
addCacheEntries();
