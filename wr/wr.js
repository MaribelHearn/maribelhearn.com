var WRs, playerWRs, compareWRs, westScores, seasonsEnabled, language = "English", skips = [],
    all = ["overall", "HRtP", "SoEW", "PoDD", "LLS", "MS", "EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS"],
    windows = ["EoSD", "PCB", "IN", "PoFV", "MoF", "SA", "UFO", "GFW", "TD", "DDC", "LoLK", "HSiFS"],
    pc98 = ["HRtP", "SoEW", "PoDD", "LLS", "MS"],
    lastUpdate = "April 26, 2019";

String.prototype.removeChar = function () {
    return this.replace("Reimu", "").replace("Cirno", "").replace("Aya", "").replace("Marisa", "");
};

String.prototype.removeSeason = function () {
    return this.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
};

function generateText() {
    if (language == "English") {
        $("title").html("Touhou World Records");
        $("h1").html("Touhou World Records");
        $(".game").html("Game");
        $(".player").html("Player");
        $(".difficulty").html("Difficulty");
        $(".shottype").html("Shottype");
        $(".route").html("Route");
        $(".overall").html("Overall");
        $(".overallrecords").html("Overall Records");
        $(".playerranking").html("Player Ranking");
        $(".westernrecords").html("Western Records");
        $(".windows").html("Windows");
        $(".pc98").html("PC-98");
        $(".world").html("World");
        $(".west").html("West");
        $(".percentage").html("Percentage");
        $(".ack").html("Acknowledgements");
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
        $(".th1").html("Touhou 1 - The Highly Responsive to Prayers");
        $(".th2").html("Touhou 2 - The Story of Eastern Wonderland");
        $(".th3").html("Touhou 3 - Phantasmagoria of Dim.Dream");
        $(".th4").html("Touhou 4 - Lotus Land Story");
        $(".th5").html("Touhou 5 - Mystic Square");
        $(".th6").html("Touhou 6 - The Embodiment of Scarlet Devil");
        $(".th7").html("Touhou 7 - Perfect Cherry Blossom");
        $(".th8").html("Touhou 8 - Imperishable Night (FinalB)");
        $(".th9").html("Touhou 9 - Phantasmagoria of Flower View");
        $(".th10").html("Touhou 10 - Mountain of Faith");
        $(".th11").html("Touhou 11 - Subterranean Animism");
        $(".th12").html("Touhou 12 - Undefined Fantastic Object");
        $(".th128").html("Touhou 12.8 - Great Fairy Wars");
        $(".th13").html("Touhou 13 - Ten Desires");
        $(".th14").html("Touhou 14 - Double Dealing Character");
        $(".th15").html("Touhou 15 - Legacy of Lunatic Kingdom");
        $(".th16").html("Touhou 16 - Hidden Star in Four Seasons");
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
        $("#description").html("An accurate list of Touhou world records, updated every so often. Note that the player ranking at the bottom does not take into account" +
        "how strong specific records are, only numbers. The list does not include scene games as of now.");
        $("#clicktodl").html("Click a score to download the corresponding replay, if there is one available. All of the table columns are sortable.");
        $("#noreup").html("The replays provided are <strong>not</strong> meant to be reuploaded to any replay uploading services.");
        $("#lastupdate").html("World records are current as of " + lastUpdate + ".");
        $("#contents_header").html("Contents");
        $("#customize").html("Customize");
        $("#score").html("Score");
        $("#label_seasons").html("HSiFS Seasons");
        $("#label_all").html("All");
        $("#autosort").html("No. of WRs");
        $("#differentgames").html("Different games");
        $("#jptlcredit").html("The Japanese translation of the top text was done by <a href='https://twitter.com/toho_yumiya'>Yu-miya</a>.");
        $("#backtotop").html("Back to Top");
    } else if (language == "Japanese") {
        $("title").html("東方の世界記録");
        $("h1").html("東方の世界記録");
        $(".game").html("ゲーム");
        $(".player").html("プレイヤー");
        $(".difficulty").html("難易度");
        $(".shottype").html("キャラ");
        $(".route").html("ルート");
        $(".overall").html("WR一覧");
        $(".overallrecords").html("各作品世界記録一覧");
        $(".worldrecords").html("世界記録");
        $(".playerranking").html("プレイヤーのランキング");
        $(".westernrecords").html("海外記録");
        $(".windows").html("Windows");
        $(".pc98").html("PC-98");
        $(".world").html("世界");
        $(".west").html("海外"); // The West = 西洋
        $(".percentage").html("割合");
        $(".ack").html("謝辞");
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
        $(".th1").html("東方靈異伝　～ The Highly Responsive to Prayers");
        $(".th2").html("東方封魔録　～ the Story of Eastern Wonderland");
        $(".th3").html("東方夢時空　～ Phantasmagoria of Dim.Dream");
        $(".th4").html("東方幻想郷　～ Lotus Land Story");
        $(".th5").html("東方怪綺談　～ Mystic Square");
        $(".th6").html("東方紅魔郷　～ the Embodiment of Scarlet Devil");
        $(".th7").html("東方妖々夢　～ Perfect Cherry Blossom");
        $(".th8").html("東方永夜抄　～ Imperishable Night (Bルート)");
        $(".th9").html("東方花映塚　～ Phantasmagoria of Flower View");
        $(".th10").html("東方風神録　～ Mountain of Faith");
        $(".th11").html("東方地霊殿　～ Subterranean Animism");
        $(".th12").html("東方星蓮船　～ Undefined Fantastic Object");
        $(".th128").html("妖精大戦争　～ 東方三月精");
        $(".th13").html("東方神霊廟　～ Ten Desires");
        $(".th14").html("東方輝針城　～ Double Dealing Character");
        $(".th15").html("東方紺珠伝　～ Legacy of Lunatic Kingdom");
        $(".th16").html("東方天空璋　～ Hidden Star in Four Seasons");
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
        $("#description").html("東方原作STG各作品世界記録の正確なリストです。適宜頻繁に更新します。" +
        "下部に記載されているプレイヤーランキングは特定のスコアの高低を示すものではなく、あくまで世界記録取得数を示したものですのでご留意ください。" +
        "また今のところ文花帖のようなシーンを基準にするリストは作成しておりません。");
        $("#clicktodl").html("該当のリプレイファイルをダウンロードするにはスコアをクリックしてください。" +
        "各欄は並べ替え可能となっています。並べ替えには各表の最上段をクリックしてください。");
        $("#noreup").html("リプレイファイルの二次利用は禁止致します。");
        $("#lastupdate").html(translateDate(lastUpdate) + "現在の世界記録です。");
        $("#contents_header").html("内容");
        $("#customize").html("カスタマイズ");
        $("#score").html("スコア");
        $("#label_seasons").html("天の季節");
        $("#label_all").html("全");
        $("#autosort").html("WR数");
        $("#differentgames").html("ゲーム");
        $("#jptlcredit").html("ページ上部のテキストは<a href='https://twitter.com/toho_yumiya'>Yu-miya</a>によって日本語に翻訳されました。");
        $("#backtotop").html("上に帰る");
    } /*else { // language == "Chinese"
        $("title").html("东方世界纪录");
        $("h1").html("东方世界纪录");
        $(".game").html("游戏");
        $(".player").html("玩家");
        $(".difficulty").html("难度");
        $(".shottype").html("机体");
        $(".route").html("路线");
        $(".overall").html("整体");
        $(".overallrecords").html("整体世界纪录");
        $(".worldrecords").html("世界纪录");
        $(".playerranking").html("玩家排行");
        $(".westernrecords").html("西方纪录");
        $(".windows").html("Windows"); // tracked = 已纪录
        $(".pc98").html("PC-98"); // untracked = 未纪录
        $(".world").html("世界");
        $(".west").html("西方");
        $(".percentage").html("百分");
        $(".ack").html("致谢");
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
        $(".th1").html("东方灵异传　～ The Highly Responsive to Prayers");
        $(".th2").html("东方封魔录　～ the Story of Eastern Wonderland");
        $(".th3").html("东方梦时空　～ Phantasmagoria of Dim.Dream");
        $(".th4").html("东方幻想乡　～ Lotus Land Story");
        $(".th5").html("东方怪绮谈　～ Mystic Square");
        $(".th6").html("东方红魔乡　～ the Embodiment of Scarlet Devil");
        $(".th7").html("东方妖妖梦　～ Perfect Cherry Blossom");
        $(".th8").html("东方永夜抄　～ Imperishable Night (路线B)");
        $(".th9").html("东方花映塚　～ Phantasmagoria of Flower View");
        $(".th10").html("东方风神录　～ Mountain of Faith");
        $(".th11").html("东方地灵殿　～ Subterranean Animism");
        $(".th12").html("东方星莲船　～ Undefined Fantastic Object");
        $(".th128").html("妖精大战争　～ 东方三月精");
        $(".th13").html("东方神灵庙　～ Ten Desires");
        $(".th14").html("东方辉针城　～ Double Dealing Character");
        $(".th15").html("东方绀珠传　～ Legacy of Lunatic Kingdom");
        $(".th16").html("东方天空璋　～ Hidden Star in Four Seasons");
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
        $("#description").html("An accurate list of Touhou world records, updated every so often. Note that the player ranking at the bottom does not take into account" +
        "how strong specific records are, only numbers. The list does not include scene games as of now.");
        $("#clicktodl").html("Click a score to download the corresponding replay, if there is one available. All of the table columns are sortable.");
        $("#noreup").html("The replays provided are <strong>not</strong> meant to be reuploaded to any replay uploading services.");
        $("#lastupdate").html("World records are current as of " + translateDate(lastUpdate) + ".");
        $("#contents_header").html("内容");
        $("#customize").html("定制");
        $("#score").html("分数");
        $("#label_seasons").html("天季节");
        $("#label_all").html("皆");
        $("#autosort").html("WR数量");
        $("#differentgames").html("游戏");
        $("#jptlcredit").html("The Japanese translation of the top text was done by <a href='https://twitter.com/toho_yumiya'>Yu-miya</a>.");
        $("#backtotop").html("回到顶部");
    }*/
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

function show(game, skip) {
    if (game == "HSiFS") {
        if (seasonsEnabled) {
            $("#HSiFS").css("display", "block");
            $("#HSiFSlink").attr("href", "#HSiFS");
        } else {
            $("#HSiFSsmall").css("display", "block");
            $("#HSiFSlink").attr("href", "#HSiFSsmall");
        }

        $("#HSiFSo").css("display", "table-row");
    } else {
        $("#" + game).css("display", "block");
        $("#" + game + "o").css("display", "table-row");
    }

    for (var difficulty in WRs[game]) {
        $("#" + game + difficulty).css("display", "table-row");
        $("#cat_" + game + difficulty).css("display", "table-row");
    }

    if (!$("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", true);
    }

    if (skip && skips.contains(game)) {
        skips.remove(game);
        load();
    }
}

function hide(game, skip) {
    $("#" + game).css("display", "none");
    $("#" + game + "o").css("display", "none");

    if (game == "HSiFS") {
        $("#HSiFSsmall").css("display", "none");
    }

    for (var difficulty in WRs[game]) {
        $("#" + game + difficulty).css("display", "none");
        $("#cat_" + game + difficulty).css("display", "none");
    }

    if ($("#" + game + "c").is(":checked")) {
        $("#" + game + "c").prop("checked", false);
    }

    if (skip && !skips.contains(game)) {
        skips.pushStrict(game);
        load();
    }
}

function checkGame(arg) {
    if ($("#" + arg + "c").is(":checked")) {
        show(arg, true);
    } else {
        hide(arg, true);
    }
}

function checkWindows() {
    var checked = $("#windows").is(":checked");

    for (var key in windows) {
        if (checked) {
            show(windows[key], false);
            skips.remove(windows[key]);
        } else {
            hide(windows[key], false);
            skips.pushStrict(windows[key]);
        }
    }

    load();
}

function checkPC98() {
    var checked = $("#pc98").is(":checked");

    for (var key in pc98) {
        if (checked) {
            show(pc98[key], false);
            skips.remove(pc98[key]);
        } else {
            hide(pc98[key], false);
            skips.pushStrict(pc98[key]);
        }
    }

    load();
}

function checkAll() {
    var checked = $("#all").is(":checked");

    if (checked) {
        $("#windows").prop("checked", true);
        $("#pc98").prop("checked", true);
    } else {
        $("#windows").prop("checked", false);
        $("#pc98").prop("checked", false);
    }

    for (var key in all) {
        if (checked) {
            show(all[key], false);
            skips.remove(all[key]);
        } else {
            hide(all[key], false);
            skips.pushStrict(all[key]);
        }
    }

    load();
}

function swapTables() {
    if (skips.contains("HSiFS")) {
        return;
    }

    $("#HSiFSsmall").css("display", seasonsEnabled ? "none" : "block");
    $("#HSiFS").css("display", seasonsEnabled ? "block" : "none");
    $("#HSiFSlink").attr("href", seasonsEnabled ? "#HSiFS" : "#HSiFSsmall");
}

function toggleSeasons() {
    seasonsEnabled = !seasonsEnabled;
    swapTables();
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
        return "does_even_score_well"
    }
}

function load() {
    $.get("https://maribelhearn.github.io/json/wrlist.json", function (data) {
        WRs = data;
        playerWRs = {};
        compareWRs = {};

        var skip = {}, game, max, difficulty, bestshotmax, shottype, wr, score, player, replay, overall, overallplayer,
        overalldifficulty, overallshottype, overallseason, bestshot, bestshotplayer, bestshotseason, text, count, seasonless;

        for (game in WRs) {
            if (!$("#" + game + "c").is(":checked") || skips.contains(game)) {
                skips.pushStrict(game);
                hide(game);
                continue;
            }

            max = 0;
            compareWRs[game] = {};

            for (difficulty in WRs[game]) {
                bestshotmax = 0;

                for (shottype in WRs[game][difficulty]) {
                    season = (game == "HSiFS" ? shottype.removeChar() : "");

                    wr = WRs[game][difficulty][shottype];
                    score = wr[0];
                    player = wr[1];
                    replay = wr[2];

                    if (score > max) {
                        overall = "#" + game + difficulty + shottype;
                        overallplayer = player;
                        overalldifficulty = difficulty;
                        overallshottype = shottype;
                        overallseason = season;
                        max = score;
                    }

                    if (score > bestshotmax) {
                        bestshot = "#" + game + difficulty + shottype;
                        bestshotplayer = player;
                        bestshotseason = season;
                        bestshotmax = score;
                        bestshotreplay = replay;
                    }

                    if (player !== "") {
                        if (!playerWRs.hasOwnProperty(player)) {
                            playerWRs[player] = {};
                        }

                        if (!playerWRs[player].hasOwnProperty(game)) {
                            playerWRs[player][game] = 0;
                        }

                        playerWRs[player][game] += 1;
                    }

                    text = (replay === "" ? sep(score) : "<a class='replay' href='" + replay + "'>" + sep(score) + "</a>") + "<br>by <em>" + player + "</em>";

                    if (score > 0) {
                        $("#" + game + difficulty + shottype).html(text);
                    } else {
                        $("#" + game + difficulty + shottype).html('-');
                    }

                    seasonless = shottype.removeSeason();

                    if (game == "HSiFS" && shottype.removeChar() == bestSeason(difficulty, seasonless)) {
                        $("#" + game + difficulty + seasonless + (difficulty == "Extra" ? "Small" : "")).html(text +
                        (game == "HSiFS" && difficulty != "Extra" ? " (" + bestSeason(difficulty, seasonless) + ")" : ""));
                    }
                }

                $(bestshot).html((bestshotreplay === "" ? "<u>" + sep(bestshotmax) + "</u>" : "<u><a class='replay' href='" + bestshotreplay +
                "'>" + sep(bestshotmax) + "</a></u>") + "<br>by <em>" + bestshotplayer + "</em>");

                if (game == "HSiFS") {
                    $(bestshot.removeSeason() + (difficulty == "Extra" ? "Small" : "")).html((bestshotreplay === "" ? "<u>" + sep(bestshotmax) +
                    "</u>" : "<u><a class='replay' href='" + bestshotreplay + "'>" + sep(bestshotmax) + "</a></u>") + "<br>by <em>" + bestshotplayer +
                    "</em>" + (game == "HSiFS" && difficulty != "Extra" ? " (" + bestshotseason + ")" : ""));
                }

                compareWRs[game][difficulty] = [bestshotmax, bestshotplayer, bestshot.replace("#" + game + difficulty, "")];
            }

            $(overall).html($(overall).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));
            $(overall.removeSeason()).html($(overall.removeSeason()).html().replace("<u>", "<u><strong>").replace("</u>", "</strong></u>"));

            // Nanashi suspicion footnote
            if (game == "MoF") {
                $(overall).html($(overall).html().replace("</strong>", "*</strong>"));
            }

            $("#" + game + "overall0").html(sep(max));
            $("#" + game + "overall1").html(overallplayer);
            $("#" + game + "overall2").html(overalldifficulty);
            $("#" + game + "overall3").html("<span class='" + overallshottype + "'>" + overallshottype + "</span>");
        }

        $("#ranking_tbody").html("");
        $("#west_tbody").html("");

        for (player in playerWRs) {
            count = 0;

            for (game in playerWRs[player]) {
                if (skips.contains(game)) {
                    if (!skip.hasOwnProperty(player)) {
                        skip[player] = 0;
                    }

                    skip[player] += 1;
                    continue;
                }

                count += playerWRs[player][game];
            }

            $("#ranking_tbody").append("<tr id='player_" + player + "'><td>" + player + "</td><td id='player_" + player + "n'>" + count +
            "</td><td id='player_" + player + "g'>" + Object.keys(playerWRs[player]).length + "</td></tr>");
        }

        // west scores
        var west, world, percentage;

        $.get("https://maribelhearn.github.io/json/bestinthewest.json", function (data) {
            westScores = data;

            for (game in westScores) {
                if (skips.contains(game)) {
                    continue;
                }

                $("#west_tbody").append("<tr><td colspan='3'><strong><u class='" + game + "'>" + game + "</u></strong></td></tr>");

                for (difficulty in westScores[game]) {
                    if (westScores[game][difficulty].length === 0) {
                        $("#" + game + difficulty).append("<td>-</td><th>-</th>");
                        continue;
                    }

                    west = westScores[game][difficulty][0];
                    westPlayer = westScores[game][difficulty][1];
                    westShottype = westScores[game][difficulty][2];
                    world = compareWRs[game][difficulty][0];
                    worldPlayer = compareWRs[game][difficulty][1];
                    worldShottype = compareWRs[game][difficulty][2];
                    percentage = (west / world * 100).toFixed(2);
                    $("#west_tbody").append("<tr><td colspan='3'>" + difficulty + "</td></tr>");
                    $("#west_tbody").append("<tr><td>" + sep(world) + "<br>by <em>" + worldPlayer +
                    "</em>" + (worldShottype != '-' ? "<br>(<span class='" + worldShottype + "'>" + worldShottype + "</span>)" : "") + "</td>" +
                    "<td>" + sep(west) + "<br>by <em>" + westPlayer + "</em>" + (westShottype != '-' ? "<br>(<span class='" + westShottype +
                    "'>" + westShottype + "</span>)" : "") + "</td>" + "<th class='" + percentageClass(percentage) +
                    "'>(" + (parseInt(percentage) == 100 ? 100 : percentage) + "%)</th></tr>");
                }
            }

            if (getCookie("lang") == "Japanese") {
                language = "Japanese";
                generateText();
            } /*else if (getCookie("lang") == "Chinese") {
                language = "Chinese";
                generateText();
            }*/
        }, "json");

        if (!$("#overallc").is(":checked")) {
            hide("overall");
        }

        $("#autosort").click();
        $("#autosort").click();
    }, "json");
}

function setLanguage(newLanguage) {
    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    generateText();
    setCookie("lang", newLanguage);
}

$(document).ready(function() {
    // detect smartphone and tablet
    if (navigator.userAgent.contains("Mobile") || navigator.userAgent.contains("Tablet")) {
        $("#notice").css("display", "block");
	}

    seasonsEnabled = $("#seasons").is(":checked");
	load();
    swapTables();
});
