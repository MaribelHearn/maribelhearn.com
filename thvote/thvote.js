$(document).ready(function() {
    // detect smartphone and tablet
    if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        document.getElementById("notice").style.display = "block";
	}
});