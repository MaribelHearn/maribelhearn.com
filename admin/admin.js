function set() {
    document.cookie = "token=" + JSON.stringify(document.getElementById("token").value) + ";expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;Secure;";
    alert("Blocking cookie set!");
}

function dark() {
    style = document.createElement("link");
    style.id = "dark_theme";
    style.href = (location.host != "localhost" ? "https://maribelhearn.com/" : "") + "../assets/shared/dark.css";
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

        document.cookie = "theme=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
        document.getElementById("hy_tooltip").innerHTML = "Human Mode";
    } else {
        document.cookie = "theme=" + JSON.stringify("dark") + ";expires=Fri, 31 Dec 9999 23:59:59 UTC;path=/;sameSite=Strict;Secure;";
        document.getElementById("hy_tooltip").innerHTML = "Youkai Mode";
        dark();
    }

    if (localStorage.theme) { // legacy
        localStorage.removeItem("theme");
    }
}

var ua = detect.parse(navigator.userAgent);

document.getElementById("setcookie").addEventListener("click", set);
document.getElementById("os").innerHTML = "<img src='https://maribelhearn.com/admin/icons/" + ua.os.name + ".png' alt='" + ua.os.name + " icon'>" + ua.os.name;
document.getElementById("browser").innerHTML = "<img src='https://maribelhearn.com/admin/icons/" + ua.browser.family +
".png' alt='" + ua.browser.name + " icon'>" + ua.browser.name;
head = document.getElementsByTagName("head")[0];
window.addEventListener("load", ready);
hy = document.getElementById("hy");
done = false;

if (hy) {
    hy.addEventListener("click", theme);
}
