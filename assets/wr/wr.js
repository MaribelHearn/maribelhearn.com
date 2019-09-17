var WRs, westScores, missingReplays, seasonsEnabled, datesEnabled,
    notation = "DMY", language = "English", selected = "", skips = [],
    all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN",
    "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC"],
    windows = ["EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS", "WBaWC"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"];

String.prototype.removeChar = function () {
    return this.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
};
String.prototype.removeSeason = function () {
    return this.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
};
function isPortrait() {
    return window.innerHeight > window.innerWidth && (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1);
}
function toggleSeasons() {
    seasonsEnabled = !seasonsEnabled;
    display("HSiFS", true);
}
function toggleDates(alreadyDisabled) {
    var i;

    if (!alreadyDisabled) {
        datesEnabled = !datesEnabled;
    }

    for (i in all) {
        if (all[i] == "overall") {
            continue;
        }

        $("#" + all[i] + "overall4, #" + all[i] + "overallm").css("display", datesEnabled ? "table-cell" : "none");
    }

    $(".date").css("display", datesEnabled ? "table-cell" : "none");
    $(".datestring, .datestring_game").css("display", datesEnabled ? "inline" : "none");
}
function disableDates() {
    toggleDates(true);
}
function load() {
    var datestrings, i;

    missingReplays = $("#missingReplays").val();

    if (getCookie("lang") == "Japanese") {
        language = "Japanese";
        notation = "YMD";
        generateText();
    } else if (getCookie("lang") == "Chinese") {
        language = "Chinese";
        notation = "YMD";
        generateText();
    } else if (getCookie("datenotation") == "MDY") {
        notation = "MDY";
    }

    if (!datesEnabled) {
        disableDates();
    }

    if (notation != "DMY") {
        datestrings = $(".datestring");
        for (i = 0; i < datestrings.length; i += 1) {
            $(datestrings[i]).html(translateDate($(datestrings[i]).html(), notation));
        }
    }
}
function shotRoute(game) {
    return game == "HRtP" || game == "GFW" ? "Route" : "Shottype";
}
function gameAbbr(game) {
    return ({
        "HRtP": 1,
        "SoEW": 2,
        "PoDD": 3,
        "LLS": 4,
        "MS": 5,
        "EoSD": 6,
        "PCB": 7,
        "IN": 8,
        "PoFV": 9,
        "MoF": 10,
        "SA": 11,
        "UFO": 12,
        "GFW": 128,
        "TD": 13,
        "DDC": 14,
        "LoLK": 15,
        "HSiFS": 16,
        "WBaWC": 17
    })[game];
}
function shottypeAbbr(shottype) {
    return ({
        "Reimu": "Re",
        "ReimuA": "RA",
        "ReimuB": "RB",
        "ReimuC": "RC",
        "Marisa": "Ma",
        "MarisaA": "MA",
        "MarisaB": "MB",
        "MarisaC": "MC",
        "Sakuya": "Sa",
        "SakuyaA": "SA",
        "SakuyaB": "SB",
        "Sanae": "Sa",
        "SanaeA": "SA",
        "SanaeB": "SB",
        "BorderTeam": "BT",
        "MagicTeam": "MT",
        "ScarletTeam": "ST",
        "GhostTeam": "GT",
        "Yukari": "Yu",
        "Alice": "Al",
        "Remilia": "Rr",
        "Youmu": "Yo",
        "Yuyuko": "Yy",
        "Reisen": "Ud",
        "Cirno": "Ci",
        "Lyrica": "Ly",
        "Mystia": "My",
        "Tewi": "Te",
        "Aya": "Ay",
        "Medicine": "Me",
        "Yuuka": "Yu",
        "Komachi": "Ko",
        "Eiki": "Ei",
        "A1": "A1",
        "A2": "A2",
        "B1": "B1",
        "B2": "B2",
        "C1": "C1",
        "C2": "C2",
        "-": "tr",
        "ReimuSpring": "RS",
        "ReimuSummer": "RU",
        "ReimuAutumn": "RA",
        "ReimuWinter": "RW",
        "CirnoSpring": "CS",
        "CirnoSummer": "CU",
        "CirnoAutumn": "CA",
        "CirnoWinter": "CW",
        "AyaSpring": "AS",
        "AyaSummer": "AU",
        "AyaAutumn": "AA",
        "AyaWinter": "AW",
        "MarisaSpring": "MS",
        "MarisaSummer": "MU",
        "MarisaAutumn": "MA",
        "MarisaWinter": "MW",
        "ReimuWolf": "RW",
        "ReimuOtter": "RO",
        "ReimuEagle": "RE",
        "MarisaWolf": "MW",
        "MarisaOtter": "MO",
        "MarisaEagle": "ME",
        "YoumuWolf": "YW",
        "YoumuOtter": "YO",
        "YoumuEagle": "YE"
    })[shottype];
}
function replayPath(game, difficulty, shottype) {
    return "replays/th" + gameAbbr(game) + "_ud" + difficulty.substr(0, 2) + shottypeAbbr(shottype) + ".rpy";
}
function bestSeason(difficulty, shottype) {
    var shottypes = WRs.HSiFS[difficulty], max = 0, season, i;

    for (i in shottypes) {
        if (!i.contains(shottype)) {
            continue;
        }

        if (shottypes[i][0] > max) {
            season = i.replace(shottype, "");
            max = shottypes[i][0];
        }
    }

    return season;
}
function percentageClass(percentage) {
    if (percentage < 50) {
        return "does_not_even_score";
    } else if (percentage < 75) {
        return "barely_even_scores";
    } else if (percentage < 90) {
        return "moderately_even_scores";
    } else if (percentage < 100) {
        return "does_even_score";
    } else {
        return "does_even_score_well";
    }
}
function display(game, seasonSwitch) {
    if (!WRs || !westScores) {
        $.get("json/wrlist.json", function (data1) {
            $.get("json/bestinthewest.json", function (data2) {
                WRs = data1;
                westScores = data2;
                display(game, seasonSwitch);
            }, "json");
        }, "json");
        return;
    }

    if (game == selected && !seasonSwitch) {
        $("#list").css("display", "none");
        $("#" + game).css("border", $("#" + game).hasClass("cover98")
            ? "1px solid black"
            : "none");
        $("#fullname, #list_thead, #list_tbody, #west_thead, #west_tbody").html("");
        $("#fullname").removeClass(game + "f");
        $("#table").removeClass(game + "t");
        selected = "";
        return;
    }

    var shottypes = [], compareWRs = {}, max = 0, difficulty, bestshotmax, shottype, wr, score, player, replay, overall,
        overallplayer, overalldifficulty, overallshottype, overallseason, overalldate, bestshot, bestshotplayer, bestshotseason,
        bestshotdate, text, count, seasonless, extrashots, west, world, percentage, i;

    for (shottype in WRs[game]["Easy"]) {
        shottypes.pushStrict(seasonsEnabled ? shottype : shottype.removeSeason());
    }

    if (selected !== "") {
        $("#" + selected).css("border", $("#" + selected).hasClass("cover98") ? "1px solid black" : "none");
    }

    if ($("#fullname").hasClass(selected + "f")) {
        $("#fullname").removeClass(selected + "f");
    }

    if ($("#table").hasClass(selected + "t")) {
        $("#table").removeClass(selected + "t");
    }

    $("#" + game).css("border", "3px solid gold");
    selected = game;
    $("#fullname").addClass(game + "f");
    $("#fullname").html(fullNameNumber(game));
    $("#table").addClass(game + "t");
    $("#list_tbody").html("");

    if (isPortrait()) {
        for (difficulty in WRs[game]) {
            $("#list_tbody").append("<tr><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) + "</th><th class='" + difficulty + "'>" + difficulty + "</th></tr>");
            if (game != "GFW" || difficulty != "Extra") {
                for (i = 0; i < shottypes.length; i += 1) {
                    if (game == "HSiFS" && difficulty != "Extra" && seasonsEnabled) {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + difficulty + "'><td><span class='" + shottypes[i].removeSeason() + "'>" + shottypes[i].removeSeason() + "</span><span class='" + shottypes[i].removeChar() + "'>" + shottypes[i].removeChar() + "</span></td></tr>")
                    } else if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled && shottypes[i].removeChar() == "Spring") {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td class='" + shottypes[i].removeSeason() + "'>" + shottypes[i].removeSeason() + "</td></tr>")
                    } else if (game != "HSiFS" || !seasonsEnabled) {
                        $("#list_tbody").append("<tr id='" + shottypes[i] + difficulty + "'><td class='" + shottypes[i] + "'>" + shottypes[i] + "</td></tr>")
                    }
                }
            }
        }
    } else {
        $("#list_thead").html("<tr id='list_thead_tr'><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) + "</th></tr>");
        for (i = 0; i < shottypes.length; i += 1) {
            if (game == "HSiFS" && seasonsEnabled) {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td><span class='" + shottypes[i].removeSeason() + "'>" + shottypes[i].removeSeason() + "</span><span class='" + shottypes[i].removeChar() + "'>" + shottypes[i].removeChar() + "</span></td></tr>")
            } else {
                $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td class='" + shottypes[i] + "'>" + shottypes[i] + "</td></tr>")
            }
        }
    }

    for (difficulty in WRs[game]) {
        if (game == "GFW" && difficulty == "Extra") {
            $("#list_tbody").append("<tr id='" + shottypes[i] + "'><td>Extra</td><td id='GFWExtra-'" + (isPortrait()
                ? ""
                : " colspan='4'") + "></td></tr>")
        } else if (game == "HSiFS" && difficulty == "Extra" && seasonsEnabled) {
            $("#list_thead_tr").append("<th class='sorttable_numeric'>Extra</th>");
            extrashots = ["Reimu", "Cirno", "Aya", "Marisa"];
            for (i = 0; i < 4; i += 1) {
                $("#" + extrashots[i] + "Spring").append("<td id='" + game + difficulty + extrashots[i] + "'" + (isPortrait()
                    ? ""
                    : " rowspan='4'") + "></td>")
            }
        } else {
            if (!isPortrait()) {
                $("#list_thead_tr").append("<th class='sorttable_numeric'>" + difficulty + "</th>")
            }
            for (i = 0; i < shottypes.length; i += 1) {
                if (isPortrait()) {
                    $("#" + shottypes[i] + difficulty).append("<td id='" + game + difficulty + shottypes[i] + "'></td>")
                } else {
                    $("#" + shottypes[i]).append("<td id='" + game + difficulty + shottypes[i] + "'></td>")
                }
            }
        }

        bestshotmax = 0;

        for (shottype in WRs[game][difficulty]) {
            season = shottype.removeChar();
            wr = WRs[game][difficulty][shottype];
            score = wr[0];
            player = wr[1];
            date = wr[2];
            if (wr[3]) {
                replay = wr[3];
            } else {
                if (gameAbbr(game) < 6 || missingReplays.contains(game + difficulty + shottype)) {
                    replay = "";
                } else {
                    replay = replayPath(game, difficulty, shottype);
                }
            }

            if (score > max) {
                overall = "#" + game + difficulty + shottype;
                overallplayer = player;
                overalldifficulty = difficulty;
                overallshottype = shottype;
                overallseason = season;
                overalldate = date;
                max = score;
            }

            if (score > bestshotmax) {
                bestshot = "#" + game + difficulty + shottype;
                bestshotplayer = player;
                bestshotseason = season;
                bestshotmax = score;
                bestshotreplay = replay;
                bestshotdate = date;
            }

            text = (replay === "" ? sep(score) : "<a class='replay' href='" + replay + "'>" + sep(score) + "</a>") +
            "<br>by <em>" + player + "</em>" + (date ? "<span class='dimgrey'><br><span class='datestring_game'>" + date +
            "</span></span>" : "");
            $("#" + game + difficulty + shottype).html(score > 0 ? text : '-');
            seasonless = shottype.removeSeason();

            if (game == "HSiFS" && shottype.removeChar() == bestSeason(difficulty, seasonless)) {
                $("#" + game + difficulty + seasonless + (difficulty == "Extra"
                    ? "Small"
                    : "")).html(text + (difficulty != "Extra"
                    ? " (" + bestSeason(difficulty, seasonless) + ")"
                    : ""));
            }
        }

        if (bestshotmax > 0) {
            $(bestshot).html((bestshotreplay === ""
                ? "<u>" + sep(bestshotmax) + "</u>"
                : "<u><a class='replay' href='" + bestshotreplay + "'>" + sep(bestshotmax) + "</a></u>") + "<br>by <em>" + bestshotplayer + "</em>" + (bestshotdate
                ? "<span class='dimgrey'><br><span class='datestring_game'>" + bestshotdate + "</span></span>"
                : ""));
            compareWRs[difficulty] = [
                bestshotmax, bestshotplayer, bestshot.replace("#" + game + difficulty, "")
            ];
        }

        if (game == "HSiFS") {
            $(bestshot.removeSeason() + (difficulty == "Extra"
                ? "Small"
                : "")).html((bestshotreplay === ""
                ? "<u>" + sep(bestshotmax) + "</u>"
                : "<u><a class='replay' href='" + bestshotreplay + "'>" + sep(bestshotmax) + "</a></u>") + "<br>by <em>" + bestshotplayer + "</em>" + (game == "HSiFS" && difficulty != "Extra"
                ? " (" + bestshotseason + ")"
                : "") + (bestshotdate
                ? "<span class='dimgrey'><br><span class='datestring_game'>" + bestshotdate + "</span></span>"
                : ""));
        }
    }

    if (game == "HSiFS" && seasonsEnabled) {
        $(overall).html($(overall).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    } else {
        $(overall.removeSeason()).html($(overall.removeSeason()).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
    }

    if (game == "MoF") {
        $(overall).html($(overall).html().replace("</strong>", "*</strong>"));
    }

    $("#west_tbody").html("");
    $("#west_thead").html("<tr><th class='world'>World</th><th class='west'>West</th><th class='percentage'>Percentage</th></tr>");

    for (difficulty in westScores[game]) {
        if (westScores[game][difficulty].length === 0) {
            $("#" + game + difficulty).append("<td>-</td><th>-</th>");
            continue;
        }

        west = westScores[game][difficulty][0];
        westPlayer = westScores[game][difficulty][1];
        westShottype = westScores[game][difficulty][2];
        world = compareWRs[difficulty][0];
        worldPlayer = compareWRs[difficulty][1];
        worldShottype = compareWRs[difficulty][2];
        percentage = (west / world * 100).toFixed(2);
        $("#west_tbody").append("<tr><td colspan='3'><u>" + difficulty + "</u></td></tr>");
        $("#west_tbody").append("<tr><td>" + sep(world) + "<br>by <em>" + worldPlayer +
        "</em>" + (worldShottype != '-' ? "<br>(<span class='" + worldShottype + "'>" + worldShottype + "</span>)" : "") +
        "</td><td>" + sep(west) + "<br>by <em>" + westPlayer + "</em>" + (westShottype != '-' ? "<br>(<span class='" + westShottype +
        "'>" + westShottype + "</span>)" : "") + "</td><th class='" + percentageClass(percentage) +
        "'>(" + (parseInt(percentage) == 100 ? 100 : percentage) + "%)</th></tr>");
    }

    $("#list").css("display", "block");
    $("#cheat").css("display", game == "MoF" ? "block" : "none");
    $("#seasontoggle").css("display", game == "HSiFS" ? "block" : "none");
    generateTableText();
    generateDates();
}
function updateOrientation() {
    if (navigator.userAgent.indexOf("Mobile") > -1 || navigator.userAgent.indexOf("Tablet") > -1) {
        if (selected !== "") {
            var tmp = selected;
            display(tmp);
            display(tmp);
        }
    }
}
function generateText(oldLanguage, oldNotation) {
    if (language == "English") {
        $(".HRtP").html("HRtP");
        $(".SoEW").html("SoEW");
        $(".PoDD").html("PoDD");
        $(".LLS").html("LLS");
        $(".MS").html("MS");
        $(".EoSD").html("EoSD");
        $(".PCB").html("PCB");
        $(".IN").html("IN");
        $(".PoFV").html("PoFV");
        $(".MoF").html("MoF");
        $(".SA").html("SA");
        $(".UFO").html("UFO");
        $(".DS").html("DS");
        $(".GFW").html("GFW");
        $(".TD").html("TD");
        $(".DDC").html("DDC");
        $(".LoLK").html("LoLK");
        $(".HSiFS").html("HSiFS");
        $(".WBaWC").html("WBaWC");
        $("title").html("Touhou World Records");
        $("h1").html("Touhou World Records");
        $(".game").html("Game");
        $(".player").html("Player");
        $(".difficulty").html("Difficulty");
        $(".shottype").html("Shottype");
        $(".route").html("Route");
        $(".date").html("Date");
        $(".dates").html("Dates");
        $(".overall").html("Overall");
        $(".overallrecords").html("Overall Records");
        $(".worldrecords").html("World Records");
        $(".westernrecords").html("Western Records");
        $(".playerranking").html("Player Ranking");
        $(".ack").html("Acknowledgements");
        $("#description").html("An accurate list of Touhou world records, updated every so often. " +
        "Note that the player ranking at the bottom does not take into account how strong specific records are, only numbers. " +
        "The list does not include scene games as of now.");
        $("#clicktodl").html("Click a score to download the corresponding replay, if there is one available. " +
        "All of the table columns are sortable.");
        $("#noreup").html("The replays provided are <strong>not</strong> meant to be reuploaded to any replay uploading services.");
        $("#contents_header").html("Contents");
        $("#clickgame").html("Click a game cover to show its list of world records.");
        $("#cheat").html("* This record is suspected of cheating. If it is found to have been cheated, the record will be 2,209,324,900 by ななまる.");
        $("#score").html("Score");
        $("#label_all").html("All");
        $("#autosort").html("No. of WRs");
        $("#differentgames").html("Different games");
        $("#credit").html("The background image was drawn by " +
        "<a href='https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ'>Catboyjeremie</a>.");
        $("#jptlcredit").html("The Japanese translation of the top text was done by " +
        "<a href='https://twitter.com/toho_yumiya'>Yu-miya</a>.");
        $("#cntlcredit").html("The Chinese translation of the top text was done by " +
        "<a href='https://twitter.com/williewillus'>williewillus</a>.");
        $("#backtotop").html("Back to Top");
    } else if (language == "Japanese") {
        $(".HRtP").html("靈");
        $(".SoEW").html("封");
        $(".PoDD").html("夢");
        $(".LLS").html("幻");
        $(".MS").html("怪");
        $(".EoSD").html("紅");
        $(".PCB").html("妖");
        $(".IN").html("永");
        $(".PoFV").html("花");
        $(".MoF").html("風");
        $(".SA").html("地");
        $(".UFO").html("星");
        $(".GFW").html("大");
        $(".TD").html("神");
        $(".DDC").html("輝");
        $(".LoLK").html("紺");
        $(".HSiFS").html("天");
        $(".WBaWC").html("鬼");
        $("title").html("東方の世界記録");
        $("h1").html("東方の世界記録");
        $(".game").html("ゲーム");
        $(".player").html("プレイヤー");
        $(".difficulty").html("難易度");
        $(".shottype").html("キャラ");
        $(".route").html("ルート");
        $(".date").html("日付");
        $(".dates").html("日付");
        $(".overall").html("WR一覧");
        $(".overallrecords").html("各作品世界記録一覧");
        $(".worldrecords").html("世界記録");
        $(".westernrecords").html("海外記録");
        $(".playerranking").html("プレイヤーのランキング");
        $(".ack").html("謝辞");
        $("#description").html("東方原作STG各作品世界記録の正確なリストです。適宜頻繁に更新します。下部に記載されているプレイヤーランキングは特定のスコアの高低を示すものではなく、あくまで世" +
                "界記録取得数を示したものですのでご留意ください。また今のところ文花帖のようなシーンを基準にするリストは作成しておりません。");
        $("#clicktodl").html("該当のリプレイファイルをダウンロードするにはスコアをクリックしてください。各欄は並べ替え可能となっています。並べ替えには各表の最上段をクリックしてください。");
        $("#noreup").html("リプレイファイルの二次利用は禁止致します。");
        $("#contents_header").html("内容");
        $("#clickgame").html("世界記録リストはゲームをクリック。");
        $("#cheat").html("* このスコアはチートの疑いがあります。不正が証明された場合、世界記録はななまるさんによる22.09億のスコアとなります。");
        $("#score").html("スコア");
        $("#label_all").html("全");
        $("#autosort").html("WR数");
        $("#differentgames").html("ゲーム");
        $("#credit").html("背景イメージは" +
        "<a href='https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ'>Catboyjeremie</a>さんのものを使用させていただいております。");
        $("#jptlcredit").html("ページ上部のテキストは<a href='https://twitter.com/toho_yumiya'>Yu-miya</a>によって日本語に翻訳されました。");
        $("#cntlcredit").html("ページ上部のテキストは<a href='https://twitter.com/williewillus'>williewillus</a>によって中国語に翻訳されました。");
        $("#backtotop").html("上に帰る");
    } else {
        $(".HRtP").html("灵");
        $(".SoEW").html("封");
        $(".PoDD").html("梦");
        $(".LLS").html("幻");
        $(".MS").html("怪");
        $(".EoSD").html("红");
        $(".PCB").html("妖");
        $(".IN").html("永");
        $(".PoFV").html("花");
        $(".MoF").html("风");
        $(".SA").html("地");
        $(".UFO").html("星");
        $(".GFW").html("大");
        $(".TD").html("神");
        $(".DDC").html("辉");
        $(".LoLK").html("绀");
        $(".HSiFS").html("天");
        $(".WBaWC").html("鬼");
        $("title").html("东方世界纪录");
        $("h1").html("东方世界纪录");
        $(".game").html("游戏");
        $(".player").html("玩家");
        $(".difficulty").html("难度");
        $(".shottype").html("机体");
        $(".route").html("路线");
        $(".date").html("日期");
        $(".dates").html("日期");
        $(".overall").html("整体");
        $(".overallrecords").html("整体世界纪录");
        $(".worldrecords").html("世界纪录");
        $(".westernrecords").html("西方纪录");
        $(".playerranking").html("玩家排行");
        $(".ack").html("致谢");
        $("#description").html("这个网页准确地记载所有「东方Project」的打分世界记录，时不时地更新。注意：页底的玩家排行榜只算玩家们得到的记录有多少，并不算记录的强度。目前数据并不包括摄" +
                "影游戏。");
        $("#clicktodl").html("点击任何分数即可下载对应的rep。点击任何标题即可排序表格内容。");
        $("#noreup").html("请勿将rep上传到别的存rep网站。");
        $("#contents_header").html("内容");
        $("#clickgame").html("单击游戏处查看世界纪录列表。");
        $("#cheat").html("* This record is suspected of cheating. If it is found to have been cheated, the record will be 2,209,324,900 by ななまる.");
        $("#score").html("分数");
        $("#label_all").html("皆");
        $("#autosort").html("WR数量");
        $("#differentgames").html("游戏");
        $("#credit").html("The background image was drawn by " +
        "<a href='https://www.youtube.com/channel/UCa1hZ9f6azCdOkMtiHyyaBQ'>Catboyjeremie</a>.");
        $("#jptlcredit").html("感谢<a href='https://twitter.com/toho_yumiya'>Yu-miya</a>提供头部文字的日语翻译。");
        $("#cntlcredit").html("感谢<a href='https://twitter.com/williewillus'>williewillus</a>提供头部文字的中文翻译。");
        $("#backtotop").html("回到顶部");
    }
}
function generateTableText() {
    if (language == "English") {
        $(".HRtPf").html("Touhou 1 - The Highly Responsive to Prayers");
        $(".SoEWf").html("Touhou 2 - The Story of Eastern Wonderland");
        $(".PoDDf").html("Touhou 3 - Phantasmagoria of Dim.Dream");
        $(".LLSf").html("Touhou 4 - Lotus Land Story");
        $(".MSf").html("Touhou 5 - Mystic Square");
        $(".EoSDf").html("Touhou 6 - The Embodiment of Scarlet Devil");
        $(".PCBf").html("Touhou 7 - Perfect Cherry Blossom");
        $(".INf").html("Touhou 8 - Imperishable Night");
        $(".PoFVf").html("Touhou 9 - Phantasmagoria of Flower View");
        $(".MoFf").html("Touhou 10 - Mountain of Faith");
        $(".SAf").html("Touhou 11 - Subterranean Animism");
        $(".UFOf").html("Touhou 12 - Undefined Fantastic Object");
        $(".GFWf").html("Touhou 12.8 - Great Fairy Wars");
        $(".TDf").html("Touhou 13 - Ten Desires");
        $(".DDCf").html("Touhou 14 - Double Dealing Character");
        $(".LoLKf").html("Touhou 15 - Legacy of Lunatic Kingdom");
        $(".HSiFSf").html("Touhou 16 - Hidden Star in Four Seasons");
        $(".WBaWCf").html("Touhou 17 - Wily Beast and Weakest Creature");
        $(".Makai").html("Makai");
        $(".Jigoku").html("Jigoku");
        $(".ReimuA").html("ReimuA");
        $(".ReimuB").html("ReimuB");
        $(".ReimuC").html("ReimuC");
        $(".Reimu").html("Reimu");
        $(".Mima").html("Mima");
        $(".Marisa").html("Marisa");
        $(".Ellen").html("Ellen");
        $(".Kotohime").html("Kotohime");
        $(".Kana").html("Kana");
        $(".Rikako").html("Rikako");
        $(".Chiyuri").html("Chiyuri");
        $(".Yumemi").html("Yumemi");
        $(".Yuuka").html("Yuuka");
        $(".MarisaA").html("MarisaA");
        $(".MarisaB").html("MarisaB");
        $(".SakuyaA").html("SakuyaA");
        $(".SakuyaB").html("SakuyaB");
        $(".BorderTeam").html("Border Team");
        $(".MagicTeam").html("Magic Team");
        $(".ScarletTeam").html("Scarlet Team");
        $(".GhostTeam").html("Ghost Team");
        $(".Yukari").html("Yukari");
        $(".Alice").html("Alice");
        $(".Sakuya").html("Sakuya");
        $(".Remilia").html("Remilia");
        $(".Youmu").html("Youmu");
        $(".Yuyuko").html("Yuyuko");
        $(".Reisen").html("Reisen");
        $(".Cirno").html("Cirno");
        $(".Lyrica").html("Lyrica");
        $(".Mystia").html("Mystia");
        $(".Tewi").html("Tewi");
        $(".Aya").html("Aya");
        $(".Medicine").html("Medicine");
        $(".Komachi").html("Komachi");
        $(".Eiki").html("Eiki");
        $(".MarisaC").html("MarisaC");
        $(".SanaeA").html("SanaeA");
        $(".SanaeB").html("SanaeB");
        $(".Sanae").html("Sanae");
        $(".Spring").html("<br>Spring");
        $(".Summer").html("<br>Summer");
        $(".Autumn").html("<br>Autumn");
        $(".Winter").html("<br>Winter");
        $(".ReimuSpring").html("ReimuSpring");
        $(".CirnoSpring").html("CirnoSpring");
        $(".AyaSpring").html("AyaSpring");
        $(".MarisaSpring").html("MarisaSpring");
        $(".ReimuSummer").html("ReimuSummer");
        $(".CirnoSummer").html("CirnoSummer");
        $(".AyaSummer").html("AyaSummer");
        $(".MarisaSummer").html("MarisaSummer");
        $(".ReimuAutumn").html("ReimuAutumn");
        $(".CirnoAutumn").html("CirnoAutumn");
        $(".AyaAutumn").html("AyaAutumn");
        $(".MarisaAutumn").html("MarisaAutumn");
        $(".ReimuWinter").html("ReimuWinter");
        $(".CirnoWinter").html("CirnoWinter");
        $(".AyaWinter").html("AyaWinter");
        $(".MarisaWinter").html("MarisaWinter");
        $(".ReimuWolf").html("ReimuWolf");
        $(".ReimuOtter").html("ReimuOtter");
        $(".ReimuEagle").html("ReimuEagle");
        $(".MarisaWolf").html("MarisaWolf");
        $(".MarisaOtter").html("MarisaOtter");
        $(".MarisaEagle").html("MarisaEagle");
        $(".YoumuWolf").html("YoumuWolf");
        $(".YoumuOtter").html("YoumuOtter");
        $(".YoumuEagle").html("YoumuEagle");
        $(".world").html("World");
        $(".west").html("West");
        $(".percentage").html("Percentage");
        $(".shottype").html("Shottype");
        $(".route").html("Route");
        $("#label_seasons").html("Seasons");
    } else if (language == "Japanese") {
        $(".HRtPf").html("東方靈異伝　～ The Highly Responsive to Prayers");
        $(".SoEWf").html("東方封魔録　～ the Story of Eastern Wonderland");
        $(".PoDDf").html("東方夢時空　～ Phantasmagoria of Dim.Dream");
        $(".LLSf").html("東方幻想郷　～ Lotus Land Story");
        $(".MSf").html("東方怪綺談　～ Mystic Square");
        $(".EoSDf").html("東方紅魔郷　～ the Embodiment of Scarlet Devil");
        $(".PCBf").html("東方妖々夢　～ Perfect Cherry Blossom");
        $(".INf").html("東方永夜抄　～ Imperishable Night");
        $(".PoFVf").html("東方花映塚　～ Phantasmagoria of Flower View");
        $(".MoFf").html("東方風神録　～ Mountain of Faith");
        $(".SAf").html("東方地霊殿　～ Subterranean Animism");
        $(".UFOf").html("東方星蓮船　～ Undefined Fantastic Object");
        $(".GFWf").html("妖精大戦争　～ 東方三月精");
        $(".TDf").html("東方神霊廟　～ Ten Desires");
        $(".DDCf").html("東方輝針城　～ Double Dealing Character");
        $(".LoLKf").html("東方紺珠伝　～ Legacy of Lunatic Kingdom");
        $(".HSiFSf").html("東方天空璋　～ Hidden Star in Four Seasons");
        $(".WBaWCf").html("東方鬼形獣　～ Wily Beast and Weakest Creature");
        $(".Makai").html("魔界");
        $(".Jigoku").html("地獄");
        $(".ReimuA").html("霊夢A");
        $(".ReimuB").html("霊夢B");
        $(".ReimuC").html("霊夢C");
        $(".Reimu").html("霊夢");
        $(".Mima").html("魅魔");
        $(".Marisa").html("魔理沙");
        $(".Ellen").html("エレン");
        $(".Kotohime").html("小兎姫");
        $(".Kana").html("カナ");
        $(".Rikako").html("理香子");
        $(".Chiyuri").html("ちゆり");
        $(".Yumemi").html("夢美");
        $(".Yuuka").html("幽香");
        $(".MarisaA").html("魔理沙A");
        $(".MarisaB").html("魔理沙B");
        $(".SakuyaA").html("咲夜A");
        $(".SakuyaB").html("咲夜B");
        $(".BorderTeam").html("霊夢＆紫");
        $(".MagicTeam").html("魔理沙＆アリス");
        $(".ScarletTeam").html("咲夜＆レミリア");
        $(".GhostTeam").html("妖夢＆幽々子");
        $(".Yukari").html("紫");
        $(".Alice").html("アリス");
        $(".Sakuya").html("咲夜");
        $(".Remilia").html("レミリア");
        $(".Youmu").html("妖夢");
        $(".Yuyuko").html("幽々子");
        $(".Reisen").html("鈴仙");
        $(".Cirno").html("チルノ");
        $(".Lyrica").html("リリカ");
        $(".Mystia").html("ミスティア");
        $(".Tewi").html("てゐ");
        $(".Aya").html("文");
        $(".Medicine").html("メディスン");
        $(".Komachi").html("小町");
        $(".Eiki").html("映姫");
        $(".MarisaC").html("魔理沙C");
        $(".SanaeA").html("早苗A");
        $(".SanaeB").html("早苗B");
        $(".Sanae").html("早苗");
        $(".Spring").html("春");
        $(".Summer").html("夏");
        $(".Autumn").html("秋");
        $(".Winter").html("冬");
        $(".ReimuSpring").html("霊夢春");
        $(".CirnoSpring").html("チルノ春");
        $(".AyaSpring").html("文春");
        $(".MarisaSpring").html("魔理沙春");
        $(".ReimuSummer").html("霊夢夏");
        $(".CirnoSummer").html("チルノ夏");
        $(".AyaSummer").html("文夏");
        $(".MarisaSummer").html("魔理沙夏");
        $(".ReimuAutumn").html("霊夢秋");
        $(".CirnoAutumn").html("チルノ秋");
        $(".AyaAutumn").html("文秋");
        $(".MarisaAutumn").html("魔理沙秋");
        $(".ReimuWinter").html("霊夢冬");
        $(".CirnoWinter").html("チルノ冬");
        $(".AyaWinter").html("文冬");
        $(".MarisaWinter").html("魔理沙冬");
        $(".ReimuWolf").html("霊夢狼");
        $(".ReimuOtter").html("霊夢獺");
        $(".ReimuEagle").html("霊夢鷲");
        $(".MarisaWolf").html("魔理沙狼");
        $(".MarisaOtter").html("魔理沙獺");
        $(".MarisaEagle").html("魔理沙鷲");
        $(".YoumuWolf").html("妖夢狼");
        $(".YoumuOtter").html("妖夢獺");
        $(".YoumuEagle").html("妖夢鷲");
        $(".world").html("世界");
        $(".west").html("海外");
        $(".percentage").html("割合");
        $(".shottype").html("キャラ");
        $(".route").html("ルート");
        $("#label_seasons").html("季節");
    } else {
        $(".HRtPf").html("东方灵异传　～ The Highly Responsive to Prayers");
        $(".SoEWf").html("东方封魔录　～ the Story of Eastern Wonderland");
        $(".PoDDf").html("东方梦时空　～ Phantasmagoria of Dim.Dream");
        $(".LLSf").html("东方幻想乡　～ Lotus Land Story");
        $(".MSf").html("东方怪绮谈　～ Mystic Square");
        $(".EoSDf").html("东方红魔乡　～ the Embodiment of Scarlet Devil");
        $(".PCBf").html("东方妖妖梦　～ Perfect Cherry Blossom");
        $(".INf").html("东方永夜抄　～ Imperishable Night");
        $(".PoFVf").html("东方花映塚　～ Phantasmagoria of Flower View");
        $(".MoFf").html("东方风神录　～ Mountain of Faith");
        $(".SAf").html("东方地灵殿　～ Subterranean Animism");
        $(".UFOf").html("东方星莲船　～ Undefined Fantastic Object");
        $(".GFWf").html("妖精大战争　～ 东方三月精");
        $(".TDf").html("东方神灵庙　～ Ten Desires");
        $(".DDCf").html("东方辉针城　～ Double Dealing Character");
        $(".LoLKf").html("东方绀珠传　～ Legacy of Lunatic Kingdom");
        $(".HSiFSf").html("东方天空璋　～ Hidden Star in Four Seasons");
        $(".WBaWCf").html("东方鬼形獣　～ Wily Beast and Weakest Creature");
        $(".Makai").html("魔界");
        $(".Jigoku").html("地狱");
        $(".ReimuA").html("灵梦A");
        $(".ReimuB").html("灵梦B");
        $(".ReimuC").html("灵梦C");
        $(".Reimu").html("灵梦");
        $(".Mima").html("魅魔");
        $(".Marisa").html("魔理沙");
        $(".Ellen").html("爱莲");
        $(".Kotohime").html("小兔姬");
        $(".Kana").html("卡娜");
        $(".Rikako").html("理香子");
        $(".Chiyuri").html("千百合");
        $(".Yumemi").html("梦美");
        $(".Yuuka").html("幽香");
        $(".MarisaA").html("魔理沙A");
        $(".MarisaB").html("魔理沙B");
        $(".SakuyaA").html("咲夜A");
        $(".SakuyaB").html("咲夜B");
        $(".BorderTeam").html("结界组");
        $(".MagicTeam").html("咏唱组");
        $(".ScarletTeam").html("红魔组");
        $(".GhostTeam").html("幽冥组");
        $(".Yukari").html("紫");
        $(".Alice").html("爱丽丝");
        $(".Sakuya").html("咲夜");
        $(".Remilia").html("蕾米莉亚");
        $(".Youmu").html("妖梦");
        $(".Yuyuko").html("幽幽子");
        $(".Reisen").html("铃仙");
        $(".Cirno").html("琪露诺");
        $(".Lyrica").html("莉莉卡");
        $(".Mystia").html("米丝蒂亚");
        $(".Tewi").html("帝");
        $(".Aya").html("文");
        $(".Medicine").html("梅蒂薪");
        $(".Komachi").html("小町");
        $(".Eiki").html("映姬");
        $(".MarisaC").html("魔理沙C");
        $(".SanaeA").html("早苗A");
        $(".SanaeB").html("早苗B");
        $(".Sanae").html("早苗");
        $(".Spring").html("春");
        $(".Summer").html("夏");
        $(".Autumn").html("秋");
        $(".Winter").html("冬");
        $(".ReimuSpring").html("灵梦春");
        $(".CirnoSpring").html("琪露诺春");
        $(".AyaSpring").html("文春");
        $(".MarisaSpring").html("魔理沙春");
        $(".ReimuSummer").html("灵梦夏");
        $(".CirnoSummer").html("琪露诺夏");
        $(".AyaSummer").html("文夏");
        $(".MarisaSummer").html("魔理沙夏");
        $(".ReimuAutumn").html("灵梦秋");
        $(".CirnoAutumn").html("琪露诺秋");
        $(".AyaAutumn").html("文秋");
        $(".MarisaAutumn").html("魔理沙秋");
        $(".ReimuWinter").html("灵梦冬");
        $(".CirnoWinter").html("琪露诺冬");
        $(".AyaWinter").html("文冬");
        $(".MarisaWinter").html("魔理沙冬");
        $(".ReimuWolf").html("灵梦狼");
        $(".ReimuOtter").html("灵梦獭");
        $(".ReimuEagle").html("灵梦鹰");
        $(".MarisaWolf").html("魔理沙狼");
        $(".MarisaOtter").html("魔理沙獭");
        $(".MarisaEagle").html("魔理沙鹰");
        $(".YoumuWolf").html("妖梦狼");
        $(".YoumuOtter").html("妖梦獭");
        $(".YoumuEagle").html("妖梦鹰");
        $(".world").html("世界");
        $(".west").html("西方");
        $(".percentage").html("百分");
        $(".shottype").html("机体");
        $(".route").html("路线");
        $("#label_seasons").html("季节");
    }
}
function generateDates(oldLanguage, oldNotation) {
    var datestrings, date, i;

    if (oldLanguage) {
        datestrings = $(".datestring");

        for (i = 0; i < datestrings.length; i += 1) {
            date = $(datestrings[i]).html();

            if (language == "English") {
                if (oldLanguage == "English") {
                    if (notation == "DMY") {
                        $(datestrings[i]).html(translateUSDate(date, "DMY"));
                    } else if (notation == "MDY") {
                        $(datestrings[i]).html(translateDate(date, "MDY"));
                    }
                } else {
                    $(datestrings[i]).html(translateEADate(date, notation));
                }
            } else if (language == "Japanese" || language == "Chinese") {
                if (oldLanguage == "English") {
                    if (oldNotation == "DMY") {
                        $(datestrings[i]).html(translateDate(date, "YMD"));
                    } else if (oldNotation == "MDY") {
                        $(datestrings[i]).html(translateUSDate(date, "YMD"));
                    }
                }
            }
        }
    }

    if (selected !== "") {
        datestrings = $(".datestring_game");

        if (!oldNotation) {
            for (i = 0; i < datestrings.length; i += 1) {
                $(datestrings[i]).html(translateDate($(datestrings[i]).html(), notation))
            }
        } else if (notation != oldNotation) {
            for (i = 0; i < datestrings.length; i += 1) {
                if (oldNotation == "DMY") {
                    $(datestrings[i]).html(translateDate($(datestrings[i]).html(), notation))
                } else if (oldNotation == "MDY") {
                    $(datestrings[i]).html(translateUSDate($(datestrings[i]).html(), notation))
                } else if (oldNotation == "YMD") {
                    $(datestrings[i]).html(translateEADate($(datestrings[i]).html(), notation))
                }
            }
        }
    }
}
function setLanguage(newLanguage, newNotation) {
    if (language == newLanguage && notation == newNotation) {
        return;
    }

    var oldLanguage = language, oldNotation = notation, lm = $("#lm").html();

    language = newLanguage;
    setCookie("lang", newLanguage);
    notation = newNotation;
    setCookie("datenotation", newNotation);
    generateText();
    generateDates(oldLanguage, oldNotation);

    if (selected !== "") {
        generateTableText();
    }

    if (language == "English") {
        if (oldLanguage == "English" && oldNotation == "DMY") {
            $("#lastupdate").html("World records are current as of <span id='lm'>" + translateDate(lm, newNotation) + "</span>.");
        } else if (oldLanguage == "English" && oldNotation == "MDY") {
            $("#lastupdate").html("World records are current as of <span id='lm'>" + translateUSDate(lm, newNotation) + "</span>.");
        } else if (oldLanguage != "English") {
            $("#lastupdate").html("World records are current as of <span id='lm'>" + translateEADate(lm, newNotation) + "</span>.");
        }
    } else if (language == "Japanese") {
        if (oldNotation == "MDY") {
            $("#lastupdate").html("<span id='lm'>" + translateUSDate(lm, "YMD") + "</span>現在の世界記録です。");
        } else {
            $("#lastupdate").html("<span id='lm'>" + (oldLanguage == "English" ? translateDate(lm, "YMD") : lm) +
            "</span>現在の世界記録です。");
        }
    } else {
        if (oldNotation == "MDY") {
            $("#lastupdate").html("世界记录更新于<span id='lm'>" + translateUSDate(lm, "YMD") + "</span>。");
        } else {
            $("#lastupdate").html("世界记录更新于<span id='lm'>" + (oldLanguage == "English" ? translateDate(lm, "YMD") : lm) +
            "</span>。");
        }
    }
}
function dark() {
    var style = document.createElement("link");
    style.id = "dark";
    style.href = "assets/shared/dark-wr.css";
    style.type = "text/css";
    style.rel = "stylesheet";
    $("head").append(style);
    $("#hy").attr("title", "Youkai Mode");
}
function theme(e) {
    if (e.src.indexOf("y") < 0) {
        e.src = "assets/shared/y-bar.png";
        localStorage.theme = "dark";
        dark();
    } else {
        e.src = "assets/shared/h-bar.png";
        $("head").children("#dark").remove();
        $("#hy").attr("title", "Human Mode");
        localStorage.theme = "light";
    }
}
$(document).ready(function () {
    if (localStorage.theme == "dark") {
        $("#hy").attr("src", "assets/shared/y-bar.png");
        dark();
    }

    if (location.protocol == "file:") {
        var path = location.pathname.split('/').pop();

        $("#nav a").attr("href", function (i, oldHref) {
            return (oldHref == '/' ? location.href.replace(path, "index.html") + "" : oldHref + ".html");
        });
    }

    seasonsEnabled = $("#seasons").is(":checked");
    datesEnabled = $("#dates").is(":checked");
    load();
});
