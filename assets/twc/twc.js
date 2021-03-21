var notation = "DMY", language = "English", timezone;

function toDateString(unix) {
    var date = new Date(Number(unix) * 1000);

    if (notation == "DMY") {
        return date.toLocaleString("en-GB", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("en-GB");
    } else if (notation == "MDY") {
        return date.toLocaleString("en-US", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("en-US");
    } else if (language == "Chinese") {
        return date.toLocaleString("zh-CN", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("zh-CN");
    } else { // language == "Japanese"
        return date.toLocaleString("ja-JP", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("ja-JP");
    }
}

function printSchedule(schedule) {
    var match, id, team;

    for (var unix in schedule) {
        match = schedule[unix];
        id = match.category.replace(/ /g, '_');
        $("#schedule_tbody").append("<tr id='" + unix + "'></tr>");
        $("#" + unix).html("<td class='noborders'>" + toDateString(unix) +
        "</td><th class='" + match.category.split(' ')[0] + " noborders'>" + match.category + "</th>" +
        "<td id='" + id + "_players' class='noborders'></td><td id='" + id +
        "_reset' class='noborders'>" + match.reset + "</td>");

        for (var i = 0; i < match.players.length; i++) {
            if (match.countries[i] == "cn") {
                team = "CHINA: ";
            } else if (match.countries[i] == "jp") {
                team = "JAPAN: ";
            } else {
                team = "WEST: ";
            }

            $("#" + id + "_players").append((i > 0 ? "<br>" : "") + team + match.players[i]);
        }
    }
}

function getClientTimeZone() {
    timezone = "UTC" + new Date().toString().split("GMT")[1];
    return timezone;
}

function setLanguage(event) {
    newLanguage = event.data.language;

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    setCookie("lang", newLanguage);
    location.href = location.href.split('#')[0].split('?')[0];
}

$(document).ready(function () {
    if (getCookie("lang") == "Japanese" || location.href.contains("jp")) {
        language = "Japanese";
    } else if (getCookie("lang") == "Chinese" || location.href.contains("zh")) {
        language = "Chinese";
    }

    $.get("assets/json/schedule.json", function (data) {
        printSchedule(data);
    }, "json");

    $("#top").attr("lang", langCode(language, false));
    $("#timezone").html(getClientTimeZone());
    $("#calculate").on("click", calcISCORE);
    $(".flag").attr("href", "");
    $("#en").on("click", {language: "English"}, setLanguage);
    $("#jp").on("click", {language: "Japanese"}, setLanguage);
    $("#zh").on("click", {language: "Chinese"}, setLanguage);
});
