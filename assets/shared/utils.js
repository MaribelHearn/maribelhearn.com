var minAge = "Thu, 01 Jan 1970 00:00:00 UTC", maxAge = "Fri, 31 Dec 9999 23:59:59 UTC";

String.prototype.contains = function (string) {
    return this.indexOf(string) > -1
};

String.prototype.cap = function () {
    return this
        .charAt(0)
        .toUpperCase() + this
        .slice(1)
        .toLowerCase()
};

String.prototype.removeSpaces = function () {
    return this.replace(/ /g, "")
};

String.prototype.strip = function () {
    return this.replace(/<\/?[^>]*>/g, "")
};

String.prototype.insertAt = function (index, string) {
    return this.substr(0, index) + string + this.substr(index)
};

String.prototype.removeAt = function (index) {
    return this.substr(0, index) + this.substr(index + 1)
};

Object.defineProperty(Array.prototype, "contains", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        return this.indexOf(value) > -1
    }
});

Object.defineProperty(Array.prototype, "pushStrict", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        if (!this.contains(value)) {
            this.push(value)
        }
    }
});

Object.defineProperty(Array.prototype, "remove", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        if (this.contains(value)) {
            this.splice(this.indexOf(value), 1)
        }
    }
});

Object.defineProperty(Array.prototype, "append", {
    configurable: true,
    enumerable: false,
    value: function (array) {
        for (var i = 0; i < array.length; i += 1) {
            this.push(array[i])
        }
    }
});

Object.defineProperty(Object.prototype, "isEmpty", {
    configurable: true,
    enumerable: false,
    value: function () {
        return Object
            .keys(this)
            .length === 0
    }
});

function setCookie(name, value) {
    document.cookie = name + "=" + JSON.stringify(value) + ";expires=" + maxAge + ";path=/;";
}

function getCookie(name) {
    var decodedCookies, cookieArray, cookie;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');
    name += '=';

    for (var i = 0; i < cookieArray.length; i += 1) {
        cookie = cookieArray[i];

        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }

        if (cookie.indexOf(name) === 0) {
            return JSON.parse(cookie.substring(name.length, cookie.length));
        }
    }

    return "";
}
function deleteCookie(name) {
    document.cookie = name + "=;expires=" + minAge + ";path=/;";
}

function listCookies() {
    var cookieNames = [], decodedCookies, cookieArray, i;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');

    for (i = 0; i < cookieArray.length; i += 1) {
        cookieNames.push(cookieArray[i].split('=')[0].removeSpaces());
    }

    return cookieNames;
}

function numericSort(a, b) {
    return b - a;
}

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function sep(number) {
    if (isNaN(number)) {
        return '-';
    }

    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function monthToNumber(month) {
    return {
        "January": 1,
        "February": 2,
        "March": 3,
        "April": 4,
        "May": 5,
        "June": 6,
        "July": 7,
        "August": 8,
        "September": 9,
        "October": 10,
        "November": 11,
        "December": 12
    }[month];
}

function translateDate(date, notation) {
    var tmp = date.split('/');

    var day = tmp[0], month = tmp[1], year = tmp[2];

    if (notation == "YMD") {
        return (year + "年" + month + "月" + day + "日");
    } else if (notation == "MDY") {
        return (month + "/" + day + "/" + year);
    }
}

function translateUSDate(date, notation) {
    var tmp = date.split('/');

    var day = tmp[1], month = tmp[0], year = tmp[2];

    if (notation == "YMD") {
        return (year + "年" + month + "月" + day + "日");
    } else if (notation == "DMY") {
        return (day + "/" + month + "/" + year);
    }
}

function translateEADate(date, notation) {
    var tmp = date.replace(/(年|月|日)/g, '/').split('/');

    var day = tmp[2], month = tmp[1], year = tmp[0];

    if (notation == "DMY") {
        return (day + "/" + month + "/" + year);
    } else if (notation == "MDY") {
        return (month + "/" + day + "/" + year);
    }
}

function fullNameNumber(game) {
    return ({
        "HRtP": "Touhou 1 - The Highly Responsive to Prayers",
        "SoEW": "Touhou 2 - The Story of Eastern Wonderland",
        "PoDD": "Touhou 3 - Phantasmagoria of Dim.Dream",
        "LLS": "Touhou 4 - Lotus Land Story",
        "MS": "Touhou 5 - Mystic Square",
        "EoSD": "Touhou 6 - The Embodiment of Scarlet Devil",
        "PCB": "Touhou 7 - Perfect Cherry Blossom",
        "IN": "Touhou 8 - Imperishable Night",
        "PoFV": "Touhou 9 - Phantasmagoria of Flower View",
        "MoF": "Touhou 10 - Mountain of Faith",
        "SA": "Touhou 11 - Subterranean Animism",
        "UFO": "Touhou 12 - Undefined Fantastic Object",
        "GFW": "Touhou 12.8 - Great Fairy Wars",
        "TD": "Touhou 13 - Ten Desires",
        "DDC": "Touhou 14 - Double Dealing Character",
        "LoLK": "Touhou 15 - Legacy of Lunatic Kingdom",
        "HSiFS": "Touhou 16 - Hidden Star in Four Seasons",
        "WBaWC": "Touhou 17 - Wily Beast and Weakest Creature"
    }[game]);
}
