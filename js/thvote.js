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
        
        if (direction === "Left" && year === 1) {
            window.location.pathname = "/thvote/2003";
        }
        else if (direction === "Right" && year === 2003) {
            window.location.pathname = "/thvote/1st";
        }
        else if (direction === "Left" && year !== 2025) {
            let nextYear = year + 1;
            if (nextYear === 2006) {
                nextYear += 1;
            }
            if (nextYear === 2007 || nextYear === 2013) {
                nextYear += 1;
            }
            window.location.pathname = `/thvote/${nextYear}`;
        }
        else if (direction === "Right" && year > 2003) {
            let previousYear = year - 1;
            if (previousYear === 2007) {
                previousYear -= 1;
            }
            if (previousYear === 2006 || previousYear === 2013) {
                previousYear -= 1;
            }
            window.location.pathname = `/thvote/${previousYear}`;
        }
    }
}

// history
if (window.location.pathname.includes("20") || window.location.pathname.includes("1st")) {
    document.body.addEventListener("keydown", navigateHistory, false);
}

window.addEventListener("DOMContentLoaded", init, false);
