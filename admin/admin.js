function set() {
    setCookie("token", document.getElementById("token").value);
    alert("Blocking cookie set!");
}

document.getElementById("setcookie").addEventListener("click", set);
document.documentElement.classList.remove("no-js");
