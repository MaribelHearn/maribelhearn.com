function dark() {
    style = document.createElement("link");
    style.id = "dark";
    style.href = "assets/shared/dark.css";
    style.type = "text/css";
    style.rel = "stylesheet";
    head.appendChild(style);
}
function ready() {
    if (done) {
        return;
    }

    done = true;

    if (localStorage.theme == "dark") {
        hy.src = "assets/shared/y-bar.png";
        hy.title = "Youkai Mode";
        dark();
    }
}
function theme() {
    if (hy.src.indexOf("y") < 0) {
        hy.src = "assets/shared/y-bar.png";
        hy.title = "Youkai Mode";
        localStorage.theme = "dark";
        dark();
    } else {
        hy.src = "assets/shared/h-bar.png";
        hy.title = "Human Mode";
        head.removeChild(head.lastChild);
        localStorage.theme = "light";
    }
}

document.documentElement.classList.remove("no-js");
head = document.getElementsByTagName("head")[0];
window.addEventListener("load", ready);
hy = document.getElementById("hy");
done = false;

if (hy) {
    hy.addEventListener("click", theme);
}
