document.documentElement.classList.remove("no-js");
head = document.getElementsByTagName("head")[0];
done = false;

function dark() {
    style=document.createElement("link");
    style.id = "dark";
    style.href = "assets/shared/dark.css";
    style.type = "text/css";
    style.rel = "stylesheet";
    head.append(style);
}
function ready() {
    if (done) {
        return;
    }
    done = true;
    hy = document.getElementById("hy");

    if (localStorage.theme == "dark") {
        hy.src = "assets/shared/y-bar.png";
        hy.title = "Youkai Mode";
        dark();
    }
}
function theme(e){
    if (e.src.indexOf("y") < 0) {
        e.src = "assets/shared/y-bar.png";
        e.title = "Youkai Mode";
        localStorage.theme = "dark";
        dark();
    } else {
        e.src = "assets/shared/h-bar.png";
        e.title = "Human Mode";
        head.removeChild(head.lastChild);
        localStorage.theme = "light";
    }
}
