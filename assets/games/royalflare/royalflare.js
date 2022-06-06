function init() {
    const thElements = document.getElementsByTagName("th");

    for (const th of thElements) {
        if (th.id.includes("score")) {
            th.click();
            th.click();
        }
    }

    const tables = document.getElementsByTagName("table");

    for (const table of tables) {
        if (table.id == "results" || table.classList.contains("hellsinker")) {
            continue;
        }

        const tr = table.getElementsByTagName("tr");
        let td = tr[1].getElementsByTagName("td");

        if (!td[1].innerHTML.includes(',')) {
            return;
        }

        td[1].innerHTML = "☆" + td[1].innerHTML;
        td = tr[2].getElementsByTagName("td");
        td[1].innerHTML = "◇" + td[1].innerHTML;
        td = tr[3].getElementsByTagName("td");
        td[1].innerHTML = "△" + td[1].innerHTML;
    }
}

window.addEventListener("DOMContentLoaded", init, false);
