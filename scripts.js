var MAX_WIDTH_SMALL_SCREEN = 1160,
    clearHistory = {
        "SoEW": {
            "e": {
                "clear": "1-2-2014"
            },
            "n": {
                "clear": "1-2-2014"
            },
            "h": {
                "attempted": "1-2-2014"
            },
            "l": {
                "attempted": "3-11-2016"
            },
            "x": {
                "attempted": "1-11-2016",
                "clear": "2-11-2016"
            }
        },
        "PoDD": {
            "e": {
                "attempted": "4-2-2014"
            },
            "n": {
                "attempted": "4-2-2014"
            }
        },
        "LLS": {
            "e": {
                "clear": "30-1-2013",
                "nb": "1-11-2016"
            },
            "n": {
                "clear": "30-1-2013",
                "nb": "1-11-2016"
            },
            "h": {
                "clear": "25-1-2014",
                "nb": "1-11-2016"
            },
            "l": {
                "clear": "10-6-2015"
            },
            "x": {
                "clear": "27-8-2014",
                "nb": "29-10-2016"
            }
        },
        "MS": {
            "e": {
                "clear": "31-12-2012",
                "nb": "18-5-2016"
            },
            "n": {
                "clear": "31-12-2012",
                "nb": "1-11-2016"
            },
            "h": {
                "clear": "21-12-2013",
                "nb": "1-11-2016"
            },
            "l": {
                "clear": "22-4-2014"
            },
            "x": {
                "clear": "31-8-2013",
                "nb": "28-10-2016"
            }
        },
        "EoSD": {
            "e": {
                "clear": "29-11-2011",
                "nmnb": "29-9-2014"
            },
            "n": {
                "clear": "9-12-2011",
                "nb": "2-1-2016"
            },
            "h": {
                "clear": "18-12-2012",
                "nb": "15-2-2016"
            },
            "l": {
                "clear": "27-1-2014",
                "nb": "12-12-2016"
            },
            "x": {
                "clear": "31-8-2013",
                "nm": "28-8-2014",
                "nb": "18-2-2016",
                "nmnb": "24-9-2016"
            }
        },
        "PCB": {
            "e": {
                "clear": "15-1-2012",
                "nb": "12-12-2015",
                "nmnb": "24-6-2016"
            },
            "n": {
                "clear": "15-1-2012",
                "nb": "5-2-2016"
            },
            "h": {
                "clear": "27-9-2012",
                "nb": "19-6-2016"
            },
            "l": {
                "clear": "18-12-2013",
                "nb": "21-10-2016"
            },
            "x": {
                "clear": "6-11-2012",
                "nm": "3-3-2014",
                "nb": "19-1-2016"
            },
            "p": {
                "clear": "18-1-2013",
                "nm": "27-8-2014",
                "nb": "19-1-2016"
            }
        },
        "IN": {
            "e": {
                "clear": "25-2-2012",
                "nmnb": "12-12-2015"
            },
            "n": {
                "clear": "25-2-2012",
                "nb": "3-1-2016"
            },
            "h": {
                "clear": "8-4-2012",
                "nb": "27-1-2017"
            },
            "l": {
                "clear": "5-5-2013",
                "nb": "27-1-2017"
            },
            "x": {
                "clear": "7-12-2012",
                "nb": "12-5-2016"
            }
        },
        "PoFV": {
            "e": {
                "clear": "14-1-2012"
            },
            "n": {
                "clear": "13-7-2012"
            },
            "h": {
                "clear": "25-12-2012"
            },
            "l": {
                "clear": "25-12-2012"
            },
            "x": {
                "clear": "18-4-2013"
            }
        },
        "MoF": {
            "e": {
                "clear": "19-12-2011",
                "nb": "12-12-2015",
                "nmnb": "14-12-2015"
            },
            "n": {
                "clear": "2-2-2012",
                "nm": "13-12-2015",
                "nb": "5-2-2016"
            },
            "h": {
                "clear": "8-12-2013",
                "nb": "4-7-2016"
            },
            "l": {
                "clear": "6-6-2015"
            },
            "x": {
                "clear": "8-12-2012",
                "nm": "18-3-2014",
                "nb": "12-5-2016",
                "nmnb": "29-9-2016"
            }
        },
        "SA": {
            "e": {
                "clear": "2-12-2011",
                "nb": "12-12-2015",
                "nmnb": "16-2-2016"
            },
            "n": {
                "clear": "31-7-2012",
                "nb": "6-2-2016"
            },
            "h": {
                "clear": "23-9-2013"
            },
            "l": {
                "clear": "7-6-2015"
            },
            "x": {
                "clear": "5-9-2013",
                "nb": "12-5-2016",
                "nmnb": "29-9-2016"
            }
        },
        "UFO": {
            "e": {
                "clear": "11-2-2012",
                "nb": "12-12-2015",
                "nmnb": "25-6-2016"
            },
            "n": {
                "clear": "16-12-2012",
                "nb": "18-1-2016"
            },
            "h": {
                "clear": "7-9-2014"
            },
            "l": {
                "clear": "4-12-2015"
            },
            "x": {
                "clear": "17-9-2013",
                "nb": "1-6-2016",
                "nmnb": "4-7-2016"
            }
        },
        "GFW": {
            "e": {
                "clear": "20-7-2012",
                "nmnb": "12-12-2015"
            },
            "n": {
                "clear": "17-12-2012",
                "nb": "14-12-2015"
            },
            "h": {
                "clear": "15-3-2014",
                "nb": "14-12-2015"
            },
            "l": {
                "clear": "16-3-2014",
                "nb": "6-9-2016"
            },
            "x": {
                "clear": "17-3-2014",
                "nb": "30-5-2016"
            }
        },
        "TD": {
            "e": {
                "clear": "20-3-2012",
                "nmnb": "12-12-2015"
            },
            "n": {
                "clear": "20-3-2012",
                "nb": "14-12-2015",
                "nmnb": "17-1-2016"
            },
            "h": {
                "clear": "4-5-2013",
                "nb": "3-1-2016"
            },
            "l": {
                "clear": "3-6-2015"
            },
            "x": {
                "clear": "2-5-2013",
                "nb": "28-5-2016"
            }
        },
        "DDC": {
            "e": {
                "clear": "13-8-2013",
                "nmnb": "12-12-2015"
            },
            "n": {
                "clear": "13-8-2013",
                "nb": "6-2-2016"
            },
            "h": {
                "clear": "30-1-2014"
            },
            "l": {
                "clear": "8-6-2015"
            },
            "x": {
                "clear": "10-2-2014",
                "nb": "28-5-2016"
            }
        },
        "LoLK": {
            "e": {
                "clear": "16-8-2015",
                "nb": "18-1-2016"
            },
            "n": {
                "clear": "16-8-2015"
            },
            "h": {
                "clear": "16-8-2015"
            },
            "l": {
                "clear": "19-8-2015"
            },
            "x": {
                "clear": "15-8-2015"
            }
        },
        "SG": {
            "e": {
                "clear": "30-11-2012",
                "nb": "12-12-2015"
            },
            "n": {
                "clear": "30-11-2012"
            },
            "h": {
                "clear": "22-8-2013"
            },
            "l": {
                "clear": "2-2-2014"
            },
            "x": {
                "clear": "6-2-2014"
            }
        },
        "BSR": {
            "e": {
                "clear": "26-10-2012",
                "nm": "2-1-2016",
                "nb": "29-6-2016"
            },
            "n": {
                "clear": "26-10-2012"
            },
            "h": {
                "clear": "14-12-2012"
            },
            "l": {
                "clear": "26-8-2013"
            }
        },
        "SMD": {
            "n": {
                "clear": "7-12-2012",
                "nmnb": "20-9-2013"
            },
            "x": {
                "clear": "12-2-2013",
                "nmnb": "17-12-2013"
            }
        },
        "MRS": {
            "e": {
                "clear": "23-2-2013"
                "nb": "9-6-2016"
            },
            "n": {
                "clear": "26-2-2013"
            },
            "h": {
                "clear": "28-5-2013"
            },
            "x": {
                "clear": "27-2-2013",
                "nm": "19-4-2015",
                "nb": "16-5-2016"
            }
        },
        "DP": {
            "1": {
                "clear": "5-9-2015"
            }
        },
        "DDP": {
            "1": {
                "clear": "2-11-2014"
            }
        },
        "DOJ": {
            "1": {
                "attempted": "3-10-2013",
                "clear": "26-3-2014"
            },
            "2": {
                "attempted": "18-4-2014"
            }
        },
        "ESP": {
            "1": {
                "attempted": "28-3-2014"
            }
        },
        "ESPg": {
            "1": {
                "attempted": "28-3-2014",
                "clear": "28-11-2015"
            }
        },
        "Ketsui": {
            "1": {
                "attempted": "13-8-2014",
                "clear": "21-9-2015"
            }
        },
        "MSm": {
            "no": {
                "clear": "7-11-2015",
                "nb": "10-11-2015"
            },
            "nm": {
                "clear": "7-11-2015",
                "nb": "9-11-2015"
            },
            "nu": {
                "clear": "9-11-2015"
            },
            "o": {
                "clear": "8-11-2015"
            },
            "m": {
                "clear": "8-11-2015"
            }
        },
        "MSF": {
            "no": {
                "nm": "31-10-2013"
            },
            "nm": {
                "clear": "1-11-2013",
                "nm": "27-11-2013"
            },
            "nu": {
                "clear": "1-11-2013",
                "nm": "27-11-2013"
            }
        },
        "MSFbl": {
            "o": {
                "clear": "5-9-2015"
            }
        },
        "DSm": {
            "1": {
                "clear": "11-3-2016"
            },
            "2": {
                "clear": "12-3-2016"
            },
            "3": {
                "clear": "15-3-2016"
            }
        },
        "DSmbl": {
            "1": {
                "clear": "28-3-2014",
            },
            "2": {
                "clear": "11-4-2014",
            },
            "3": {
                "clear": "12-3-2016"
            }
        },
    },
	exceptions = ["Title", "Games", "GamesLeft", "GamesRight", "Links", "MusicPlayer", "Achievements"],
	games = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC",
	"LoLK", "SG", "BSR", "SMD", "MRS", "DP", "DDP", "DOJ", "DFK", "SDOJ",  "Batsugun", "ESP", "ESPg", "Ketsui", "MSm", "MSF", "DSm", "Ikaruga", "CCWI", "eX1", "eX2", "eX3"],
	arcade = ["DP", "DDP", "DOJ", "DFK", "SDOJ", "Batsugun", "ESP", "ESPg", "Ketsui", "MSm", "MSF", "DSm", "Ikaruga"],
	touhou = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC", "LoLK"],
	doujin = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC", "LoLK", "SG", "BSR", "SMD", "MRS", "CCWI", "eX1", "eX2", "eX3"],
    gamesLeft, gamesRight, gamesLeftOriginal, gamesRightOriginal, viewportWidth;

Object.defineProperty(Array.prototype, "contains", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        return this.indexOf(value) > -1;
    }
});

$(document).ready(function() {
	gamesLeft = document.getElementById("GamesLeft"),
	gamesRight = document.getElementById("GamesRight");
    gamesLeftOriginal = gamesLeft.innerHTML;
    gamesRightOriginal = gamesRight.innerHTML;
    viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    
	if (viewportWidth < MAX_WIDTH_SMALL_SCREEN) {
		gamesLeft.innerHTML = gamesLeftOriginal + gamesRightOriginal;
		gamesRight.style.display = "none";
	}
	
	// detect smartphone and tablet
	
	if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        document.getElementById("Achievements").innerHTML += "<strong><a href='#Title'>Back</a></strong>";
	}
});

window.addEventListener("resize", function (event) {
    gamesLeft = document.getElementById("GamesLeft");
    gamesRight = document.getElementById("GamesRight");
    viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    
    if (viewportWidth < MAX_WIDTH_SMALL_SCREEN) {
		gamesLeft.innerHTML = gamesLeftOriginal + gamesRightOriginal;
		gamesRight.style.display = "none";
	} else {
		gamesLeft.innerHTML = gamesLeftOriginal;
		gamesRight.style.display = "block";
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