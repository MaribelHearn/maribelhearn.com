/*global $ setCookie getCookie*/
var notation = "DMY", language = "en_US", timezone;

function toDateString(unix) {
    var date = new Date(Number(unix) * 1000);

    if (notation == "DMY") {
        return date.toLocaleString("en-GB", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("en-GB");
    } else if (notation == "MDY") {
        return date.toLocaleString("en-US", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("en-US");
    } else if (language == "zh_CN") {
        return date.toLocaleString("zh-CN", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("zh-CN");
    } else if (language == "de_DE") {
        return date.toLocaleString("de-DE", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("de-DE");
    } else { // language == "ja_JP"
        return date.toLocaleString("ja-JP", {"dateStyle": "full"}) + ", " + date.toLocaleTimeString("ja-JP");
    }
}

function printSchedule(schedule) {
    var highlight = false, match, id, dateString, team;

    for (var unix in schedule) {
        match = schedule[unix];
        id = match.category.replace(/ /g, '_');
        $("#schedule_tbody").append("<tr id='" + unix + "'></tr>");
        dateString = toDateString(unix);
        $("#" + unix).html("<td class='noborders'>" + dateString +
        "</td><th class='" + match.category.split(' ')[0] + " noborders'>" + match.category + "</th>" +
        "<td id='" + id + "_players' class='noborders'></td><td id='" + id +
        "_reset' class='noborders'>" + (match.reset === 0 ? "N/A" : match.reset) + "</td>");

        if (!highlight && unix >= new Date().getTime() / 1000) {
            $("#" + unix).addClass("highlight");
            highlight = true;
        }

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
    var newLanguage = event.data.language, newNotation = event.data.notation;

    if (language == newLanguage && notation == newNotation) {
        return;
    }

    language = newLanguage;
    setCookie("lang", newLanguage);

    if (newNotation == "DMY" && notation == "MDY") {
        newNotation = "MDY";
    }

    notation = newNotation;
    setCookie("datenotation", newNotation);
    location.href = location.href.split('#')[0].split('?')[0];
}

$(document).ready(function () {
    if (getCookie("lang") == "ja_JP" || location.href.contains("jp")) {
        language = "ja_JP";
        notation = "YMD";
    } else if (getCookie("lang") == "zh_CN" || location.href.contains("zh")) {
        language = "zh_CN";
        notation = "YMD";
    } else if (getCookie("lang") == "ru_RU") {
        language = "ru_RU";
    } else if (getCookie("lang") == "de_DE") {
        language = "de_DE";
    } else if (getCookie("datenotation") == "MDY" || location.href.contains("en-us")) {
        notation = "MDY";
    } else if (getCookie("datenotation") == "YMD") {
        notation = "YMD";
    }

    $.get("assets/shared/json/schedule.json", function (data) {
        printSchedule(data);
    }, "json");

    $("#timezone").html(getClientTimeZone());
    $(".flag").attr("href", "");
    $("#en").on("click", {language: "en_US", notation: "DMY"}, setLanguage);
    $("#jp").on("click", {language: "ja_JP", notation: "YMD"}, setLanguage);
    $("#zh").on("click", {language: "zh_CN", notation: "YMD"}, setLanguage);
    $("#ru").on("click", {language: "ru_RU", notation: "DMY"}, setLanguage);
    $("#de").on("click", {language: "de_DE", notation: "DMY"}, setLanguage);
});
