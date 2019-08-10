var ready = function () {
    if (location.protocol == "file:") {
        var path = location.pathname.split('/').pop(), length = document.links.length, href;

        for (var i = 0; i < length; i++) {
            href = document.links[i].href;

            if (document.links[i].protocol == "file:" && href.indexOf('#') == -1) {
                document.links[i].href = (href == "file:///" ? location.href.replace(path, "index.html") : href + ".html");
            }
        }
    }

    // detect smartphone and tablet
    if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        document.getElementById("notice").style.display = "block";
        document.styleSheets[0].insertRule("#wrap:before { content: ''; background-color: #FFFFFF; position: absolute; " +
        "height: " + document.body.clientHeight + "px; width: " + document.body.clientWidth + "; left: -2000px; z-index: -1; }", 0);
	}
};
window.onresize = function(event) {
    // detect smartphone and tablet
    if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        document.styleSheets[0].removeRule(0);
        document.styleSheets[0].insertRule("#wrap:before { content: ''; background-color: #FFFFFF; position: absolute; " +
        "height: " + document.body.clientHeight + "px; width: " + document.body.clientWidth + "; left: -2000px; z-index: -1; }", 0);
	}
};
