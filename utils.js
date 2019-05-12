var minAge = "Thu, 01 Jan 1970 00:00:00 UTC", maxAge = "Fri, 31 Dec 9999 23:59:59 UTC";

String.prototype.contains = function (string) {
    return this.indexOf(string) > -1;
};

String.prototype.cap = function () {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
};

String.prototype.removeSpaces = function () {
    return this.replace(/ /g, "");
};

String.prototype.strip = function () {
    return this.replace(/<\/?[^>]*>/g, "");
};

String.prototype.insertAt = function (index, string) {
    return this.substr(0, index) + string + this.substr(index);
};

String.prototype.removeAt = function (index) {
    return this.substr(0, index) + this.substr(index + 1);
};

Object.defineProperty(Array.prototype, "contains", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        return this.indexOf(value) > -1;
    }
});

Object.defineProperty(Array.prototype, "pushStrict", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        if (!this.contains(value)) {
            this.push(value);
        }
    }
});

Object.defineProperty(Array.prototype, "remove", {
    configurable: true,
    enumerable: false,
    value: function (value) {
        if (this.contains(value)) {
            this.splice(this.indexOf(value), 1);
        }
    }
});

Object.defineProperty(Array.prototype, "append", {
    configurable: true,
    enumerable: false,
    value: function (array) {
        for (var i = 0; i < array.length; i++) {
            this.push(array[i]);
        }
    }
});

Object.defineProperty(Object.prototype, "isEmpty", {
    configurable: true,
    enumerable: false,
    value: function () {
        return Object.keys(this).length === 0;
    }
});

var setCookie = function (name, value) {
    document.cookie = name + "=" + JSON.stringify(value) + ";expires=" + maxAge + ";path=/;";
};

var getCookie = function (name) {
    var decodedCookies, cookieArray, cookie;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');
    name += '=';

    for (var i = 0; i < cookieArray.length; i++) {
        cookie = cookieArray[i];

        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }

        if (cookie.indexOf(name) === 0) {
            return JSON.parse(cookie.substring(name.length, cookie.length));
        }
    }

    return "";
};

var deleteCookie = function (name) {
    document.cookie = name + "=;expires=" + minAge + ";path=/;";
};

var listCookies = function () {
    var cookieNames = [], decodedCookies, cookieArray, i;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');

    for (i = 0; i < cookieArray.length; i++) {
        cookieNames.push(cookieArray[i].split('=')[0].removeSpaces());
    }

    return cookieNames;
};

var numericSort = function (a, b) {
    return b - a;
};

var rand = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

var sep = function (number) {
    if (isNaN(number)) {
        return '-';
    }
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
};

var monthToNumber = function (month) {
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
};

var translateDate = function (date, notation) { // <Month name> <Day>, <Full year>
    var tmp = date.split(", ");

    var date = tmp[0], year = tmp[1];

    tmp = date.split(' ');
    day = tmp[1];

    if (notation == "YMD") {
        month = monthToNumber(tmp[0]);

        return (year + "年" + month + "月" + day + "日");
    } else if (notation == "DMY") {
        month = tmp[0];

        return day + " " + month + ", " + year;
    }
};
