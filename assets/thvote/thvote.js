var w1, w2, w3, w4, w5, w6, w7, w8, w9, w0, th, i;

function toggle(detail) {
    document.getElementById("age_summary").style.display = (detail ? "none" : "table");
    document.getElementById("age_detail").style.display = (detail ? "table" : "none");
    document.getElementById("age_detail_button").style.display = (detail ? "none" : "inline");
    document.getElementById("age_summary_button").style.display = (detail ? "inline" : "none");
}

if (document.getElementById("age_detail_button")) {
    document.getElementById("age_detail_button").addEventListener("click", function wrap() { toggle(true); });
    document.getElementById("age_summary_button").addEventListener("click", function wrap() { toggle(false); });
}

function init() {
    if (document.getElementById("jumps")) {
        th = document.getElementsByTagName("th");

        for (i = 0; i < th.length; i++) {
            if (th[i].id == "change") {
                th[i].click();
                th[i].click();
            }
        }
    }
}

if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
    w1 = document.getElementById("chars_dummy");
    w2 = document.getElementById("chars_container");
    w1.onscroll = function() {
        w2.scrollLeft = w1.scrollLeft;
    };
    w2.onscroll = function() {
        w1.scrollLeft = w2.scrollLeft;
    }
    w3 = document.getElementById("music_dummy");
    w4 = document.getElementById("music_container");
    w3.onscroll = function() {
        w4.scrollLeft = w3.scrollLeft;
    };
    w4.onscroll = function() {
        w3.scrollLeft = w4.scrollLeft;
    }
    w5 = document.getElementById("works_dummy");
    w6 = document.getElementById("works_container");
    w5.onscroll = function() {
        w6.scrollLeft = w5.scrollLeft;
    };
    w6.onscroll = function() {
        w5.scrollLeft = w6.scrollLeft;
    }
    w7 = document.getElementById("clear_dummy");
    w8 = document.getElementById("clear_container");
    w7.onscroll = function() {
        w8.scrollLeft = w7.scrollLeft;
    };
    w8.onscroll = function() {
        w7.scrollLeft = w8.scrollLeft;
    }
    w9 = document.getElementById("corr_dummy");
    w0 = document.getElementById("corr_container");
    w9.onscroll = function() {
        w0.scrollLeft = w9.scrollLeft;
    };
    w0.onscroll = function() {
        w9.scrollLeft = w0.scrollLeft;
    }
}

window.addEventListener("DOMContentLoaded", init, false);
