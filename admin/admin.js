document.documentElement.classList.remove("no-js");

function set() {
    setCookie("token", document.getElementById("token").value);
    document.getElementById("set").style = "display:block";
}
