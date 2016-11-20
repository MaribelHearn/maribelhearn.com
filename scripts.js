var MAX_WIDTH_SMALL_SCREEN = 1024,
	exceptions = ["Title", "Games", "GamesLeft", "GamesRight", "Links", "MusicPlayer", "Achievements"],
	games = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC",
	"LoLK", "SG", "BSR", "SMD", "MRS", "DP", "DDP", "DOJ", "DFK", "SDOJ",  "Batsugun", "ESP", "ESPg", "Ketsui", "MSm", "MSF", "DSm", "Ikaruga", "CCWI", "eX1", "eX2", "eX3"],
	arcade = ["DP", "DDP", "DOJ", "DFK", "SDOJ", "Batsugun", "ESP", "ESPg", "Ketsui", "MSm", "MSF", "DSm", "Ikaruga"],
	touhou = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC", "LoLK"],
	doujin = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC", "LoLK", "SG", "BSR", "SMD", "MRS", "CCWI", "eX1", "eX2", "eX3"],
	musicLink = ["", "wlY8pwFt6kg", "aQOtLRa8Phw", "bAdsMgIZAEE", "fb41shIeDCA", "QXrvaugGThA", "w5MOMgLvTqU", "OfH1FrSlDws", "BHppysY6Ib4",
	"XRRKWkW92O4", "Laj-7MA5g4M", "N0jhujOdrdY", "sZkUFWmBEiE", "SQL69b7_5Qs", "v8xtmqN6jpc", "8kb8SQOPiQY", "vu2TixUgsnQ", "OMWm9SmoZGo"];

Object.defineProperty(Array.prototype, "contains", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        return this.indexOf(value) > -1;
    }
});

$(document).ready(function() {
	if ($(window).width() <= MAX_WIDTH_SMALL_SCREEN) {
		var GamesLeft = document.getElementById("GamesLeft"),
			GamesRight = document.getElementById("GamesRight");
		GamesLeft.innerHTML = GamesLeft.innerHTML + GamesRight.innerHTML;
		GamesRight.style.display = "none";
	}
	
	// detect smartphone and tablet
	
	if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        document.getElementById("Achievements").innerHTML += "<strong><a href='#Title'>Back</a></strong>";
	}
});

window.addEventListener("resize", function (event) {
    if ($(window).width() <= MAX_WIDTH_SMALL_SCREEN) {
		var GamesLeft = document.getElementById("GamesLeft"),
			GamesRight = document.getElementById("GamesRight");
		GamesLeft.innerHTML = GamesLeft.innerHTML + GamesRight.innerHTML;
		GamesRight.style.display = "none";
	}
});

function collapse(exception) {
	var divList = document.getElementsByTagName("div");
	
	for (var i in divList) {
		if (!divList[i].id) {
			continue;
		}
        
		if (divList[i] && !exceptions.contains(divList[i].id) && divList[i].id != exception) {
			divList[i].style.display = "none";
		}
        
		if (divList[i] && !exceptions.contains(divList[i].id) && divList[i].id == exception) {
			divList[i].style.display = "block";
		}
	}
}

function showTouhou() {
	var divList = document.getElementsByTagName("div");
	
	for (var i in divList) {
		if (!divList[i].id) {
			continue;
		}
		if (divList[i] && !exceptions.contains(divList[i].id)) {
			divList[i].style.display = "none";
		}
	}
	
	for (var i in touhou) {
		document.getElementById(touhou[i]).style.display = "block";
	}
}

function showDoujin() {
	var divList = document.getElementsByTagName("div");
	
	for (var i in divList) {
		if (!divList[i].id) {
			continue;
		}
		if (divList[i] && !exceptions.contains(divList[i].id)) {
			divList[i].style.display = "none";
		}
	}
	
	for (var i in doujin) {
		document.getElementById(doujin[i]).style.display = "block";
	}
}

function showArcade() {
	var divList = document.getElementsByTagName("div");
	
	for (var i in divList) {
		if (!divList[i].id) {
			continue;
		}
		if (divList[i] && !arcade.contains(divList[i].id)) {
			divList[i].style.display = "none";
		}
	}
	
	for (var i in divList) {
		if (!divList[i].id) {
			continue;
		}
		if (exceptions.contains(divList[i].id)) {
			divList[i].style.display = "block";
		}
	}
	
	for (var i in arcade) {
		document.getElementById(arcade[i]).style.display = "block";
	}
}

function changeMusic(music) {
	if (music == "random") {	
		var random = Math.ceil(Math.random() * (musicLink.length - 1));
		document.getElementById("Frame").src = "https://www.youtube.com/embed/" + musicLink[random] +
		"?enablejsapi=1&origin=https%3A%2F%2Fdl.dropboxusercontent.com&autoplay=1";
	} else {
		document.getElementById("Frame").src = "https://www.youtube.com/embed/" + musicLink[music] +
		"?enablejsapi=1&origin=https%3A%2F%2Fdl.dropboxusercontent.com&autoplay=1";
	}
}

function musicOff() {
	var browser = navigator.userAgent;
	if (browser.indexOf("Chrome") > -1 && browser.indexOf("OPR") == -1 && browser.indexOf("Version") == -1) {
		alert("Why would you turn the epic music off? :( Do you REALLY want to do this? Okay then... ;_;");
		document.getElementById("Frame").src = "";
	} else {
		if (document.getElementById("Frame").style.display == "none") {
			document.getElementById("Frame").style.display = "block";
			document.getElementById("TurnOffMusic").value = "Turn Music Off";
		} else {
			document.getElementById("Frame").style.display = "none";
			document.getElementById("TurnOffMusic").value = "Turn Music On";
		}
	}
}

function changeTheme(theme) {
	document.getElementById("ADB").style.background = "url('./games/" + theme + "big.jpg')";
}