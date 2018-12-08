var ready = function () {
    // detect smartphone and tablet
    if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        document.getElementById("notice").style.display = "block";
        document.styleSheets[0].insertRule("#wrap:before { content: ''; background-color: #FFFFFF; position: absolute; " +
        "height: " + document.body.clientHeight + "px; width: 4000px; left: -2000px; z-index: -1; }");
	}
};
