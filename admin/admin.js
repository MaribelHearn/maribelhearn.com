function set() {
    setCookie("token", document.getElementById("token").value);
    alert("Blocking cookie set!");
}
function dark() {
    style = document.createElement("link");
    style.id = "dark";
    style.href = "../assets/shared/dark.css";
    style.type = "text/css";
    style.rel = "stylesheet";
    head.append(style);
}
function ready() {
    if (done) {
        return;
    }

    done = true;

    if (localStorage.theme == "dark") {
        hy.src = "../assets/shared/y-bar.png";
        hy.title = "Youkai Mode";
        dark();
    }
}
function theme() {
    if (hy.src.indexOf("y") < 0) {
        hy.src = "../assets/shared/y-bar.png";
        hy.title = "Youkai Mode";
        localStorage.theme = "dark";
        dark();
    } else {
        hy.src = "../assets/shared/h-bar.png";
        hy.title = "Human Mode";
        head.removeChild(head.lastChild);
        localStorage.theme = "light";
    }
}

var ua = detect.parse(navigator.userAgent);

document.getElementById("setcookie").addEventListener("click", set);
document.documentElement.classList.remove("no-js");
document.getElementById("device").innerHTML = (ua.device.name ? "a " + ua.device.name : "an unknown device");
document.getElementById("os").innerHTML = "<img src='" + ua.os.name + ".png'>" + ua.os.name;
document.getElementById("browser").innerHTML = "<img src='" + ua.browser.family + ".png'>" + ua.browser.name;
head = document.getElementsByTagName("head")[0];
window.addEventListener("load", ready);
hy = document.getElementById("hy");
done = false;

if (hy) {
    hy.addEventListener("click", theme);
}
