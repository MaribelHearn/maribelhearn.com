function toggle(detail) {
    document.getElementById("age_summary").style.display = (detail ? "none" : "table");
    document.getElementById("age_detail").style.display = (detail ? "table" : "none");
    document.getElementById("age_detail_button").style.display = (detail ? "none" : "inline");
    document.getElementById("age_summary_button").style.display = (detail ? "inline" : "none");
}

function init() {
    if (document.getElementById("jumps")) {
        const thElements = document.getElementsByTagName("th");

        for (const th of thElements) {
            if (th.id == "change") {
                th.click();
                th.click();
            }
        }
    }

    if (document.getElementById("age_detail_button")) {
        document.getElementById("age_detail_button").addEventListener("click", function wrap() { toggle(true); });
        document.getElementById("age_summary_button").addEventListener("click", function wrap() { toggle(false); });
    }
}

function navigateHistory(event) {
    if (event.key && event.key.startsWith("Arrow")) {
        const direction = event.key.replace("Arrow", "");
        const year = parseInt(window.location.pathname.split('/')[2]);
        
        if (direction === "Left" && year !== 2025) {
            window.location.pathname = `/thvote/${year + 1}`;
        } else if (direction === "Right" && year !== 2016) {
            window.location.pathname = `/thvote/${year - 1}`;
        }
    }
}

// history
if (window.location.pathname.includes("20")) {
    document.body.addEventListener("keydown", navigateHistory, false)
}

window.addEventListener("DOMContentLoaded", init, false);
