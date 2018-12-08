var ready = function () {
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
}
