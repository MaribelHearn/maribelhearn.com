/*global setCookie getCookie*/
function emptyModal() {
    document.getElementById("modal").style.display = "none";
    const innerModals = document.querySelectorAll(".modal_inner");
    
    for (const element of innerModals) {
        element.style.display = "none";
    }
}

function closeModal(event) {
    const modal = document.getElementById("modal");

    if ((event.target && event.target == modal) || (event.key && event.key == "Escape")) {
        emptyModal();
    }
}

function charInfo() {
    emptyModal();
    const chara = this.title.split(' ')[0].toLowerCase();
    document.getElementById(`${chara}_info`).style.display = "block";
    document.getElementById("modal").style.display = "block";
}

function setLanguage(event) {
    let newLanguage;

    if (event.target.getAttribute("data-lang") == "en_GB" || event.target.parentNode.getAttribute("data-lang") == "en_GB") {
        newLanguage = (getCookie("lang") == "en_US" ? "en_US" : "en_GB");
    } else {
        newLanguage = "zh_CN";
    }

    location.href = location.href.split('#')[0].split('?')[0];
    setCookie("lang", newLanguage);
}

function init() {
    document.body.addEventListener("click", closeModal, false);
    document.body.addEventListener("keyup", closeModal, false);
    document.getElementById("en_GB").addEventListener('click', setLanguage, false);
    const chars = document.querySelectorAll(".char");
    const flags = document.querySelectorAll(".flag, .language");

    for (const chara of chars) {
        chara.addEventListener("click", charInfo, false);
    }

    for (const element of flags) {
        element.setAttribute("href", "");
        element.addEventListener("click", setLanguage, false);
    }
}

window.addEventListener("DOMContentLoaded", init, false);
