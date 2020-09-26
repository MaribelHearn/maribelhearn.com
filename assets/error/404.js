var pages = ["scoring", "survival", "drc", "tools", "wr", "lnn", "poll", "jargon", "tiers", "gensokyo", "pofv"];

function similarity(a, b) {
    var m = a.length, n = b.length, C = [], i, j;

    for (i = 0; i <= m; i += 1) {
        C.push([0]);
    }

    for (j = 0; j < n; j += 1) {
        C[0].push(0);
    }

    for (i = 0; i < m; i += 1) {
        for (j = 0; j < n; j += 1) {
            C[i + 1][j + 1] = a[i] === b[j]
                ? C[i][j] + 1
                : Math.max(C[i + 1][j], C[i][j + 1])
        }
    }

    return (function bt(i, j) {
        if (i * j === 0) {
            return ""
        }
        if (a[i - 1] === b[j - 1]) {
            return bt(i - 1, j - 1) + a[i - 1]
        }
        return (C[i][j - 1] > C[i - 1][j])
            ? bt(i, j - 1)
            : bt(i - 1, j)
    }(m, n)).length;
}

var path = location.pathname.split('/').pop(), loc = location.toString(), max = 0, maxPath, testPath, sim, i;

if (isNaN(path) && path != "404.php") {
    for (i = 0; i < pages.length; i += 1) {
        sim = similarity(path, pages[i]);
        if (sim > max) {
            max = sim;
            maxPath = pages[i];
        }
    }

    if (max > maxPath.length - 2) { // redirect
        location.replace(loc.replace(location.pathname.slice(1), maxPath) + "?redirect=" + path);
    } else if (isNaN(path) && path != "404.php" && max >= maxPath.length - 3) {
        document.getElementById("didyoumean").innerHTML = ", did you mean <a href='/" + maxPath + "'>" + maxPath + "</a>?";
    }
}
