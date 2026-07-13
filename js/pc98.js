/*global setCookie deleteCookie*/
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
        document.getElementById("recent_limit").addEventListener("keyup", setRecentLimit, false);
        document.getElementById("recent_limit").addEventListener("mouseup", setRecentLimit, false);
        document.getElementById("save_changes").addEventListener("click", saveChanges, false);
    }
}

window.addEventListener("DOMContentLoaded", init, false);
