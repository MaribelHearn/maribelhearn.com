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
    wa = document.getElementById("highlow_dummy");
    wb = document.getElementById("highlow_container");
    wa.onscroll = function() {
        wb.scrollLeft = wa.scrollLeft;
    };
    wb.onscroll = function() {
        wa.scrollLeft = wb.scrollLeft;
    }
    wc = document.getElementById("eosd_dummy");
    wd = document.getElementById("eosd_container");
    wc.onscroll = function() {
        wd.scrollLeft = wc.scrollLeft;
    };
    wd.onscroll = function() {
        wc.scrollLeft = wd.scrollLeft;
    }
    we = document.getElementById("pcb_dummy");
    wf = document.getElementById("pcb_container");
    we.onscroll = function() {
        wf.scrollLeft = we.scrollLeft;
    };
    wf.onscroll = function() {
        we.scrollLeft = wf.scrollLeft;
    }
    wg = document.getElementById("in_dummy");
    wh = document.getElementById("in_container");
    wg.onscroll = function() {
        wh.scrollLeft = wg.scrollLeft;
    };
    wh.onscroll = function() {
        wg.scrollLeft = wh.scrollLeft;
    }
    wi = document.getElementById("mof_dummy");
    wj = document.getElementById("mof_container");
    wi.onscroll = function() {
        wj.scrollLeft = wi.scrollLeft;
    };
    wj.onscroll = function() {
        wi.scrollLeft = wj.scrollLeft;
    }
    wk = document.getElementById("sa_dummy");
    wl = document.getElementById("sa_container");
    wk.onscroll = function() {
        wl.scrollLeft = wk.scrollLeft;
    };
    wl.onscroll = function() {
        wk.scrollLeft = wl.scrollLeft;
    }
    wm = document.getElementById("ufo_dummy");
    wn = document.getElementById("ufo_container");
    wm.onscroll = function() {
        wn.scrollLeft = wm.scrollLeft;
    };
    wn.onscroll = function() {
        wm.scrollLeft = wn.scrollLeft;
    }
    wo = document.getElementById("td_dummy");
    wp = document.getElementById("td_container");
    wo.onscroll = function() {
        wp.scrollLeft = wo.scrollLeft;
    };
    wp.onscroll = function() {
        wo.scrollLeft = wp.scrollLeft;
    }
    wq = document.getElementById("ddc_dummy");
    wr = document.getElementById("ddc_container");
    wq.onscroll = function() {
        wr.scrollLeft = wq.scrollLeft;
    };
    wr.onscroll = function() {
        wq.scrollLeft = wr.scrollLeft;
    }
    ws = document.getElementById("lolk_dummy");
    wt = document.getElementById("lolk_container");
    ws.onscroll = function() {
        wt.scrollLeft = ws.scrollLeft;
    };
    wt.onscroll = function() {
        ws.scrollLeft = wt.scrollLeft;
    }
    wu = document.getElementById("hsifs_dummy");
    wv = document.getElementById("hsifs_container");
    wu.onscroll = function() {
        wv.scrollLeft = wu.scrollLeft;
    };
    wv.onscroll = function() {
        wu.scrollLeft = wv.scrollLeft;
    }
}

function toggle(detail) {
    document.getElementById("age_summary").style.display = (detail ? "none" : "block");
    document.getElementById("age_detail").style.display = (detail ? "block" : "none");
}
