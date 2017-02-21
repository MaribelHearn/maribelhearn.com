var MAX_WIDTH_SMALL_SCREEN = 1160,
	exceptions = ["Title", "Games", "GamesLeft", "GamesRight", "Links", "MusicPlayer", "Achievements"],
	games = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC",
	"LoLK", "SG", "BSR", "SMD", "MRS", "DP", "DDP", "DOJ", "DFK", "SDOJ",  "Batsugun", "ESP", "ESPg", "Ketsui", "MSm", "MSF", "DSm", "Ikaruga", "CCWI", "eX1", "eX2", "eX3"],
	arcade = ["DP", "DDP", "DOJ", "DFK", "SDOJ", "Batsugun", "ESP", "ESPg", "Ketsui", "MSm", "MSF", "DSm", "Ikaruga"],
	touhou = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC", "LoLK"],
	doujin = ["SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "StB", "MoF", "SA", "UFO", "DS", "GFW", "TD", "DDC", "ISC", "LoLK", "SG", "BSR", "SMD", "MRS", "CCWI", "eX1", "eX2", "eX3"],
    gamesLeft, gamesRight, gamesLeftOriginal, gamesRightOriginal, viewportWidth;

String.prototype.toUnixTime = function () {
    return new Date(this).getTime();
};

Object.defineProperty(Array.prototype, "contains", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        return this.indexOf(value) > -1;
    }
});

$(document).ready(function() {
    calendar.set("calendar");
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

function getClearHistory(date) {
    var unixTime = new Date(date).getTime(), count = 0, clearHistory = {
        "SoEW": {
            "e": {
                "clear": "2/1/2014"
            },
            "n": {
                "clear": "2/1/2014"
            },
            "h": {
                "attempted": "2/1/2014"
            },
            "l": {
                "attempted": "11/3/2016"
            },
            "x": {
                "attempted": "11/1/2016",
                "clear": "11/2/2016"
            }
        },
        "PoDD": {
            "e": {
                "attempted": "2/4/2014"
            },
            "n": {
                "attempted": "2/4/2014"
            },
            "h": {},
            "l": {}
        },
        "LLS": {
            "e": {
                "clear": "1/30/2013",
                "nb": "11/1/2016"
            },
            "n": {
                "clear": "1/30/2013",
                "nb": "11/1/2016"
            },
            "h": {
                "clear": "1/25/2014",
                "nb": "11/1/2016"
            },
            "l": {
                "clear": "6/10/2015"
            },
            "x": {
                "clear": "8/27/2014",
                "nb": "10/29/2016"
            }
        },
        "MS": {
            "e": {
                "clear": "12/31/2012",
                "nb": "5/18/2016"
            },
            "n": {
                "clear": "12/31/2012",
                "nb": "11/1/2016"
            },
            "h": {
                "clear": "12/21/2013",
                "nb": "11/1/2016"
            },
            "l": {
                "clear": "4/22/2014"
            },
            "x": {
                "clear": "8/31/2013",
                "nb": "10/28/2016"
            }
        },
        "EoSD": {
            "e": {
                "clear": "11/29/2011",
                "nmnb": "9/29/2014"
            },
            "n": {
                "clear": "12/9/2011",
                "nb": "1/2/2016"
            },
            "h": {
                "attempted": "6/5/2012",
                "clear": "12/18/2012",
                "nb": "2/15/2016"
            },
            "l": {
                "attempted": "12/19/2013",
                "clear": "1/27/2014",
                "nb": "12/12/2016"
            },
            "x": {
                "attempted": "11/16/2011",
                "clear": "5/29/2012",
                "nm": "8/28/2014",
                "nb": "2/18/2016",
                "nmnb": "9/24/2016"
            }
        },
        "PCB": {
            "e": {
                "attempted": "11/2/2011",
                "clear": "1/15/2012",
                "nb": "12/12/2015",
                "nmnb": "6/24/2016"
            },
            "n": {
                "clear": "1/15/2012",
                "nb": "2/5/2016"
            },
            "h": {
                "attempted": "9/25/2012",
                "clear": "9/27/2012",
                "nb": "6/19/2016"
            },
            "l": {
                "attempted": "8/30/2013",
                "clear": "12/18/2013",
                "nb": "10/21/2016"
            },
            "x": {
                "clear": "11/6/2012",
                "nm": "3/3/2014",
                "nb": "1/19/2016"
            },
            "p": {
                "clear": "1/18/2013",
                "nm": "8/27/2014",
                "nb": "1/19/2016"
            }
        },
        "IN": {
            "e": {
                "clear": "2/25/2012",
                "nmnb": "12/12/2015"
            },
            "n": {
                "clear": "2/25/2012",
                "nb": "1/3/2016"
            },
            "h": {
                "attempted": "4/3/2012",
                "clear": "4/8/2012",
                "nb": "1/27/2017"
            },
            "l": {
                "clear": "5/5/2013",
                "nb": "1/27/2017"
            },
            "x": {
                "attempted": "12/5/2012",
                "clear": "12/7/2012",
                "nb": "5/12/2016"
            }
        },
        "PoFV": {
            "e": {
                "clear": "1/14/2012"
            },
            "n": {
                "clear": "7/13/2012"
            },
            "h": {
                "attempted": "12/22/2012",
                "clear": "12/25/2012"
            },
            "l": {
                "clear": "12/25/2012"
            },
            "x": {
                "clear": "4/18/2013"
            }
        },
        "MoF": {
            "e": {
                "attempted": "12/10/2011",
                "clear": "12/19/2011",
                "nb": "12/12/2015",
                "nmnb": "12/14/2015"
            },
            "n": {
                "attempted": "1/19/2012",
                "clear": "2/2/2012",
                "nm": "12/13/2015",
                "nb": "2/5/2016"
            },
            "h": {
                "attempted": "12/10/2012",
                "clear": "12/8/2013",
                "nb": "7/4/2016"
            },
            "l": {
                "attempted": "6/4/2015",
                "clear": "6/6/2015",
                "nb": "2/19/2017"
            },
            "x": {
                "clear": "12/8/2012",
                "nm": "3/18/2014",
                "nb": "5/12/2016",
                "nmnb": "9/29/2016"
            }
        },
        "SA": {
            "e": {
                "clear": "12/2/2011",
                "nb": "12/12/2015",
                "nmnb": "2/16/2016"
            },
            "n": {
                "attempted": "7/25/2012",
                "clear": "7/31/2012",
                "nb": "2/6/2016"
            },
            "h": {
                "clear": "9/23/2013"
            },
            "l": {
                "attempted": "10/31/2014",
                "clear": "6/7/2015"
            },
            "x": {
                "attempted": "12/9/2012",
                "clear": "9/5/2013",
                "nb": "5/12/2016",
                "nmnb": "5/17/2016"
            }
        },
        "UFO": {
            "e": {
                "clear": "2/11/2012",
                "nb": "12/12/2015",
                "nmnb": "6/25/2016"
            },
            "n": {
                "clear": "12/16/2012",
                "nb": "1/18/2016"
            },
            "h": {
                "attempted": "8/29/2014",
                "clear": "9/7/2014"
            },
            "l": {
                "attempted": "8/27/2015",
                "clear": "12/4/2015"
            },
            "x": {
                "attempted": "11/9/2012",
                "clear": "9/17/2013",
                "nb": "6/1/2016",
                "nmnb": "7/4/2016"
            }
        },
        "GFW": {
            "e": {
                "attempted": "7/2/2012",
                "clear": "7/20/2012",
                "nmnb": "12/12/2015"
            },
            "n": {
                "attempted": "7/2/2012",
                "clear": "12/17/2012",
                "nb": "12/14/2015"
            },
            "h": {
                "clear": "3/15/2014",
                "nb": "12/14/2015"
            },
            "l": {
                "clear": "3/16/2014",
                "nb": "9/6/2016"
            },
            "x": {
                "clear": "3/17/2014",
                "nb": "5/30/2016"
            }
        },
        "TD": {
            "e": {
                "clear": "3/20/2012",
                "nmnb": "12/12/2015"
            },
            "n": {
                "clear": "3/20/2012",
                "nb": "12/14/2015",
                "nmnb": "1/17/2016"
            },
            "h": {
                "clear": "5/4/2013",
                "nb": "1/3/2016"
            },
            "l": {
                "attempted": "4/28/2014",
                "clear": "6/3/2015"
            },
            "x": {
                "attempted": "12/14/2012",
                "clear": "5/2/2013",
                "nb": "5/28/2016"
            }
        },
        "DDC": {
            "e": {
                "clear": "8/13/2013",
                "nmnb": "12/12/2015"
            },
            "n": {
                "clear": "8/13/2013",
                "nb": "2/6/2016"
            },
            "h": {
                "attempted": "9/24/2013",
                "clear": "1/30/2014"
            },
            "l": {
                "clear": "6/8/2015"
            },
            "x": {
                "attempted": "2/9/2014",
                "clear": "2/10/2014",
                "nb": "5/28/2016"
            }
        },
        "LoLK": {
            "e": {
                "nm": "8/16/2015",
                "nb": "1/18/2016"
            },
            "n": {
                "clear": "8/16/2015"
            },
            "h": {
                "clear": "8/16/2015"
            },
            "l": {
                "attempted": "8/18/2015",
                "clear": "8/19/2015"
            },
            "x": {
                "clear": "8/15/2015"
            }
        },
        "SG": {
            "e": {
                "clear": "11/30/2012",
                "nb": "12/12/2015"
            },
            "n": {
                "clear": "11/30/2012"
            },
            "h": {
                "clear": "8/22/2013"
            },
            "l": {
                "clear": "2/2/2014"
            },
            "x": {
                "clear": "2/6/2014"
            }
        },
        "BSR": {
            "e": {
                "clear": "10/26/2012",
                "nm": "1/2/2016",
                "nb": "6/29/2016"
            },
            "n": {
                "clear": "10/26/2012"
            },
            "h": {
                "clear": "12/14/2012"
            },
            "l": {
                "attempted": "8/24/2013",
                "clear": "8/26/2013"
            }
        },
        "SMD": {
            "n": {
                "clear": "12/7/2012",
                "nmnb": "9/20/2013"
            },
            "x": {
                "clear": "2/12/2013",
                "nmnb": "12/17/2013"
            }
        },
        "MRS": {
            "e": {
                "clear": "2/23/2013",
                "nb": "6/9/2016"
            },
            "n": {
                "clear": "2/26/2013"
            },
            "h": {
                "clear": "5/28/2013"
            },
            "x": {
                "clear": "2/27/2013",
                "nm": "4/19/2015",
                "nb": "5/16/2016"
            }
        },
        "DP": {
            "1": {
                "attempted": "3/6/2015",
                "clear": "9/5/2015"
            }
        },
        "DDP": {
            "1": {
                "clear": "11/2/2014"
            }
        },
        "DOJ": {
            "1": {
                "attempted": "10/3/2013",
                "clear": "3/26/2014"
            },
            "2": {
                "attempted": "4/18/2014"
            }
        },
        "ESP": {
            "1": {
                "attempted": "3/28/2014"
            }
        },
        "ESPg": {
            "1": {
                "attempted": "3/28/2014",
                "clear": "11/28/2015"
            }
        },
        "Ketsui": {
            "1": {
                "attempted": "8/13/2014",
                "clear": "9/21/2015"
            },
            "2o": {},
            "2u": {}
        },
        "MSm": {
            "no": {
                "clear": "11/7/2015",
                "nb": "11/10/2015"
            },
            "nm": {
                "clear": "11/7/2015",
                "nb": "11/9/2015"
            },
            "nu": {
                "clear": "11/9/2015"
            },
            "or": {
                "clear": "11/8/2015"
            },
            "m": {
                "clear": "11/8/2015"
            },
            "u": {}
        },
        "MSF": {
            "no": {
                "nm": "10/31/2013"
            },
            "nm": {
                "clear": "11/1/2013",
                "nm": "11/27/2013"
            },
            "nu": {
                "clear": "11/1/2013",
                "nm": "11/27/2013"
            },
            "or": {},
            "m": {},
            "u": {}
        },
        "MSFbl": {
            "or": {
                "clear": "9/5/2015"
            },
            "m": {},
            "g": {}
        },
        "DSm": {
            "1": {
                "clear": "3/11/2016"
            },
            "2": {
                "clear": "3/12/2016"
            },
            "3": {
                "clear": "3/15/2016"
            }
        },
        "DSmbl": {
            "1": {
                "clear": "3/28/2014",
                "nb": "10/31/2016"
            },
            "2": {
                "clear": "4/11/2014",
                "nb": "10/31/2016"
            },
            "3": {
                "clear": "3/12/2016"
            },
            "999": {}
        },
    };
    
    for (var game in clearHistory) {
        for (var mode in clearHistory[game]) {
            var clears = clearHistory[game][mode], element = "#" + mode + game;
            
            $(element).removeClass("attempted");
            $(element).removeClass("clear");
            $(element).removeClass("nm");
            $(element).removeClass("nb");
            $(element).removeClass("nmnb");
            
            if (!jQuery.isEmptyObject(clears)) {
                if (clears.hasOwnProperty("nmnb") && unixTime >= clears.nmnb.toUnixTime()) {
                    $(element).addClass("nmnb");
                    count++;
                    continue;
                }
                
                if (clears.hasOwnProperty("nb") && unixTime >= clears.nb.toUnixTime()) {
                    $(element).addClass("nb");
                    count++;
                    continue;
                }
                
                if (clears.hasOwnProperty("nm") && unixTime >= clears.nm.toUnixTime()) {
                    $(element).addClass("nm");
                    count++;
                    continue;
                }
                
                if (clears.hasOwnProperty("clear") && unixTime >= clears.clear.toUnixTime()) {
                    $(element).addClass("clear");
                    count++;
                    continue;
                }
                
                if (clears.hasOwnProperty("attempted") && unixTime >= clears.attempted.toUnixTime()) {
                    $(element).addClass("attempted");
                    count++;
                    continue;
                }
            }
        }
        
        $("#o" + game).css("display", count === 0 ? "none" : "");
        count = 0;
    }
}