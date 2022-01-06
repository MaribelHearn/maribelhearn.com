function init() {
    var th = document.getElementsByTagName("th"), tables, table, tr, td, i;

    for (i = 0; i < th.length; i++) {
        if (th[i].id.includes("score")) {
            th[i].click();
            th[i].click();
        }
    }

    tables = document.getElementsByTagName("table");

    for (i = 0; i < tables.length; i++) {
        table = tables[i];

        if (table.id == "results") {
            continue;
        }

        tr = table.getElementsByTagName("tr");
        td = tr[1].getElementsByTagName("td");

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
