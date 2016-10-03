var tag = document.createElement("script");
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName("script")[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var done = false,
	player;
function onYouTubeIframeAPIReady() {
	player = new YT.Player("Frame", {
	  height: "110",
	  width: "220",
	  videoId: "",
	  events: {}
	});
	
	// detect chrome
	
	var browser = navigator.userAgent;
	
	if (browser.indexOf("Chrome") > -1 && browser.indexOf("OPR") == -1 && browser.indexOf("Version") == -1) {
		document.getElementById("Frame").style.display = "none";
		document.getElementById("br1").style.display = "none";
	}
}
function stopVideo() {
	player.stopVideo();
}