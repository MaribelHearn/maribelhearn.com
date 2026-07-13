/*global setCookie deleteCookie*/
/*const API_BASE = location.hostname.includes("maribelhearn.com") ? "https://maribelhearn.com" : "http://localhost";

function getScores(game, diff) {
    let recordsSeen = [];

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${API_BASE}/api/v1/replay/?type=Score&game=${game}&difficulty=${diff}&ordering=-score&region=Eastern`);
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const response = JSON.parse(this.response);
                let records = [];
                
                for (const record of response) {
                    if (recordsSeen.includes(record.player + record.category.shot)) {
                        continue;
                    }

                    records.push(record);
                    recordsSeen.push(record.player + record.category.shot);
                }

                // do_stuff
            }
        }
    }

    xhr.send();
}*/

function openModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "block";
    modal.childNodes[1].style.display = "block";
}

function emptyModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "none";
    modal.childNodes[1].style.display = "none";
}

function closeModal(event) {
    const modal = document.getElementById("modal");

    if (event.target && event.target == modal) {
        emptyModal();
    }
}

function detectKey(event) {
    if (event.key && event.key == "Escape") {
        emptyModal();
    }
}

function setRecentLimit(event) {
    let limit = Math.max(parseInt(event.target.value), 1);

    if (limit == 15 || isNaN(limit)) {
        deleteCookie("recent_limit");
    } else {
        setCookie("recent_limit", limit);
    }
}

function saveChanges() {
    location.reload();
}

function init() {
    const information = document.getElementById("information");
    
    if (information) {
        information.addEventListener("click", openModal, false);
        document.body.addEventListener("click", closeModal, false);
        document.body.addEventListener("keyup", detectKey, false);
        document.getElementById("recent_limit").addEventListener("keyup", setRecentLimit, false);
        document.getElementById("recent_limit").addEventListener("mouseup", setRecentLimit, false);
        document.getElementById("save_changes").addEventListener("click", saveChanges, false);
    }
}

window.addEventListener("DOMContentLoaded", init, false);
