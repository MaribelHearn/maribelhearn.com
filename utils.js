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