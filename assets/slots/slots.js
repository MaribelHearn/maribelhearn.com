var categories = {}, slots = [], list = [], speed = 100, running;

var start = function () {
    running = setInterval(function () {
        var i;

        for (i = 0; i < 9; i++) {
            slots[i] += 1;

            if (slots[i] == list.length) {
                slots[i] = 0;
            }

            character = list[slots[i]];
            $("#img" + i).attr("src", "art/Dairi/" + categories[character] + "/" + character.removeSpaces() + ".png");
            $("#img" + i).attr("title", character);
            $("#img" + i).attr("alt", character);
        }
    }, speed);
};

var stop = function () {
    clearInterval(running);
};

$(document).ready(function () {
    $.get("https://maribelhearn.github.io/json/chars.json", function (data) {
        var category, character, i, j;

        // convert chars object into array of names and category mapping
        for (i in data) {
            for (j in data[i].chars) {
                list.push(data[i].chars[j]);
                categories[data[i].chars[j]] = i;
            }
        }

        console.log(list);
        console.log(categories);

        for (i = 0; i < 9; i++) {
            slots[i] = rand(0, Object.keys(list).length - 1);
            character = list[rand(0, Object.keys(list).length - 1)];
            $("#slot" + i).html("<img id='img" + i + "' src='art/Dairi/" + categories[character] +
            "/" + character.removeSpaces() + ".png' alt='" + character + "' title='" + character + "'>");
        }
    });
});
