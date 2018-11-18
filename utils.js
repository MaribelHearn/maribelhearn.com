var minAge = "Thu, 01 Jan 1970 00:00:00 UTC", maxAge = "Fri, 31 Dec 9999 23:59:59 UTC";

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