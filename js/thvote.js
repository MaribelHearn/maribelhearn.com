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

window.addEventListener("DOMContentLoaded", init, false);
