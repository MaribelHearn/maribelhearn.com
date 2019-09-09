var language = "English",
    selected = "",
    playerSelected = false,
    playergameLNNs;
function load() {
    if (getCookie("lang") == "Japanese") {
        language = "Japanese";
        generateText();
        generateShortNames()
    } else if (getCookie("lang") == "Chinese") {
        language = "Chinese";
        generateText();
        generateShortNames()
    }
}
function restrictions(game) {
    return ({
        "PCB": "n",
        "IN": "fs",
        "UFO": "u",
        "TD": "n",
        "HSiFS": "n",
        "WBaWC": "nn"
    }[game])
}
function shotRoute(game) {
    return game == "HRtP" || game == "GFW"
        ? "Route"
        : "Shottype"
}
function show(game) {
    $
        .get("json/lnnlist.json", function (LNNs) {
            if (game == selected) {
                $("#" + game + "i").css("border", $("#" + game).hasClass("cover98")
                    ? "1px solid black"
                    : "none");
                $("#fullname, #listhead, #listbody, #listfoot").html("");
                $("#fullname").removeClass(game + "f");
                $("#list").css("display", "none");
                selected = "";
                return
            }
            var playergameLNNs = {},
                overallplayers = [],
                players = [],
                typeString = "",
                gamecount = 0,
                shottype,
                shotplayers,
                shotplayersIN,
                shotcount,
                character,
                type,
                player,
                i;
            if (selected !== "") {
                $("#" + selected + "i").css("border", $("#" + selected).hasClass("cover98")
                    ? "1px solid black"
                    : "none")
            }
            if ($("#fullname").hasClass(selected + "f")) {
                $("#fullname").removeClass(selected + "f")
            }
            $("#" + game + "i").css("border", "3px solid gold");
            selected = game;
            $("#fullname").addClass(game + "f");
            $("#fullname").html(fullNameNumber(game));
            $("#listhead").html("<tr><th class='" + shotRoute(game).toLowerCase() + "'>" + shotRoute(game) + "</th><th class='sorttable_numeric'><span id='numeric' class='nooflnn" + (restrictions(game)
                ? restrictions(game)
                : "") + "s'>No. of LNNs</span><br><span class='different'>(Different players)</span></th>" +
                    "<th class='players'>Players</th></tr>");
            $("#listfoot").html("<tr><td colspan='3'></td></tr><tr><td class='count'><span class='overall'>Overal" +
                    "l</span></td><td id='count' class='count'></td><td id='total'></td></tr>");
            $("#listbody").html("");
            for (shottype in LNNs[game]) {
                if (game != "IN" && game != "UFO" && game != "HSiFS" || (game == "IN" && shottype.contains("FinalA")) || (game == "UFO" && !shottype.contains("UFOs")) || (game == "HSiFS" && shottype.contains("Spring"))) {
                    shotplayers = [];
                    shotplayersIN = [];
                    shotcount = 0;
                    character = shottype.replace(/Spring|Summer|Autumn|Winter|FinalA|FinalB|UFOs/, "");
                    $("#listbody").append("<tr><td class='" + character + "'>" + character + "</td><td id='" + character + "n'></td><td id='" + character + "'></td>")
                }
                if (game == "IN" || game == "UFO" || game == "HSiFS") {
                    type = shottype.replace(character, "");
                    typeString = (type !== ""
                        ? " (<span class='" + type + "'>" + type + "</span>)"
                        : "")
                }
                for (i in LNNs[game][shottype]) {
                    player = LNNs[game][shottype][i];
                    shotplayers.push(player + (game == "IN" || game == "UFO" || game == "HSiFS"
                        ? typeString
                        : ""));
                    shotplayersIN.pushStrict(player);
                    players.pushStrict(player);
                    shotcount += 1;
                    gamecount += 1
                }
                if (!(game == "IN" && type != "FinalB") && !(game == "UFO" && type != "UFOs") && !(game == "HSiFS" && type != "Winter")) {
                    shotplayers.sort();
                    $("#" + character + "n").html(shotcount + (game == "IN"
                        ? " (" + shotplayersIN.length + ")"
                        : ""));
                    if (shotcount === 0) {
                        $("#" + character).html('-');
                        continue
                    }
                    for (i in shotplayers) {
                        $("#" + character).append(", " + shotplayers[i])
                    }
                    if ($("#" + character).html().substring(0, 2) == ", ") {
                        $("#" + character).html($("#" + character).html().replace(", ", ""))
                    }
                }
            }
            players.sort();
            for (i in players) {
                $("#total").append(", " + players[i])
            }
            $("#count").html(gamecount + " (" + players.length + ")");
            $("#total").html($("#total").html().replace(", ", ""));
            $("#list").css("display", "block");
            generateTableText();
            generateShottypes();
            generateFullNames()
        }, "json")
}
function getPlayerLNNs(player) {
    $
        .get("json/lnnlist.json", function (LNNs) {
            if (player == "...") {
                $("#playerlist").css("display", "none");
                $("#playerlistbody, #playerlistfoot").html("");
                playerSelected = false;
                return
            }
            var games = [],
                sum = 0,
                game,
                array,
                shottype,
                character,
                type,
                i;
            playerSelected = true;
            $("#playerlistbody").html("");
            for (game in LNNs) {
                if (game == "LM") {
                    continue
                }
                array = [];
                for (shottype in LNNs[game]) {
                    if (LNNs[game][shottype].contains(player)) {
                        if (!games.contains(game)) {
                            $("#playerlistbody").append("<tr><td class='" + game + "'>" + game + "</td><td id='" + game + "s'></td></tr>");
                            games.push(game)
                        }
                        character = shottype.replace(/(FinalA|FinalB|UFOs)/g, "");
                        type = shottype.replace(character, "");
                        array.push("<span class='" + character + "'>" + character + "</span>" + (type === ""
                            ? ""
                            : " (<span class='" + type + "'>" + type + "</span>)"));
                        sum += 1
                    }
                }
                $("#" + game + "s").html(array.join(", "))
            }
            $("#playerlistfoot").html("<tr><td colspan='2'></td></tr><tr><td class='total'>Total</td><td>" + sum + "</td></tr>");
            $("#playerlist").css("display", "block");
            generateTableText();
            generateShottypes();
            generateShortNames()
        }, "json")
}
function generateText() {
    if (language == "English") {
        $("title").html("Touhou Lunatic No Miss No Bombs");
        $("h1").html("Touhou Lunatic No Miss No Bombs");
        $(".game").html("Game");
        $(".games").html("Games LNN'd");
        $(".player").html("Player");
        $(".players").html("Players");
        $(".differentn").html("Different players");
        $(".ranking").html("Ranking");
        $(".overall").html("Overall");
        $(".difficulty").html("Difficulty");
        $(".playerranking").html("Player Ranking");
        $(".overallcount").html("Overall Count");
        $(".nooflnns").html("No. of LNNs");
        $(".all").html(" (All)");
        $(".ack").html("Acknowledgements");
        $(".lnns").html("LNN Lists");
        $("#description").html("A list of Touhou Lunatic No Miss No Bomb (LNN) runs, updated every so often. For" +
                " every shottype in a game, tables will tell you which players have done an LNN w" +
                "ith it, if any. If a player has multiple LNNs for one particular shottype, those" +
                " are not factored in.");
        $("#conditions").html("Extra conditions are required for PCB, TD and HSiFS; these are No Border Breaks," +
                " No Trance and No Release respectively. LNN in these games is called LNNN, with " +
                "an extra N to denote the extra condition.The extra condition in UFO, no UFO summ" +
                "ons, is optional, as it is not considered to have a significant impact on the di" +
                "fficulty of the run. As for IN, an LNN is assumed to capture all Last Spells and" +
                " is referred to as LNNFS.");
        $("#tables").html("All of the table columns are sortable.");
        $("#contents_header").html("Contents");
        $("#clickgame").html("Click a game cover to show its list of LNNs.");
        $("#score").html("Score");
        $("#label_all").html("All");
        $("#autosort").html("No. of WRs");
        $("#differentgames").html("Different games");
        $("#jptlcredit").html("The Japanese translation of the top text was done by <a href='https://twitter.co" +
                "m/toho_yumiya'>Yu-miya</a>.");
        $("#cntlcredit").html("The Chinese translation of the top text was done by <a href='https://twitter.com" +
                "/williewillus'>williewillus</a>.");
        $("#backtotop").html("Back to Top")
    } else if (language == "Japanese") {
        $("title").html("東方Lunaticノーミスノーボム");
        $("h1").html("東方Lunaticノーミスノーボム");
        $(".game").html("ゲーム");
        $(".games").html("ゲーム");
        $(".player").html("プレイヤー");
        $(".players").html("プレイヤー");
        $(".differentn").html("プレイヤー");
        $(".overall").html("合計");
        $(".ranking").html("ランキング");
        $(".difficulty").html("難易度");
        $(".playerranking").html("プレイヤーのランキング");
        $(".overallcount").html("総数");
        $(".nooflnns").html("LNNの数");
        $(".all").html("（全）");
        $(".ack").html("謝辞");
        $(".lnns").html("LNNリスト");
        $("#description").html("東方原作STG各作品の難易度Lunaticのノーミスノーボム（LNN）リストです。適宜頻繁に更新します。各作品の表とも、各機体において誰が達成したかを記載してい" +
                "ます。特定の作品、ショットタイプで複数回のLNNを達成している場合でも１回とカウントされます。");
        $("#conditions").html("また妖々夢では霊撃無し、神霊廟ではトランス無し、天空璋では開放無し、鬼形獣では霊撃無し、暴走ロアリング無しが条件となります。この４作品では追加条件によってNが追" +
                "加され、LNNN又はLNNNNと呼称します。また星蓮船ではUFO招喚無しも考慮されますが、難易度が劇的に変化するわけではないため必須条件とはなっていません。永夜" +
                "抄ではラストスペル取得を含めLNNFSが条件となります。");
        $("#tables").html("各欄は並べ替え可能となっています。並べ替えには各表の最上段をクリックしてください。");
        $("#contents_header").html("内容");
        $("#clickgame").html("LNNリストはゲームをクリック。");
        $("#score").html("スコア");
        $("#label_all").html("全");
        $("#autosort").html("WR数");
        $("#differentgames").html("ゲーム");
        $("#jptlcredit").html("ページ上部のテキストは<a href='https://twitter.com/toho_yumiya'>Yu-miya</a>によって日本語に翻訳されました。");
        $("#cntlcredit").html("ページ上部のテキストは<a href='https://twitter.com/williewillus'>williewillus</a>によって中国語に翻訳" +
                "されました。");
        $("#backtotop").html("上に帰る")
    } else {
        $("title").html("东方LNN");
        $("h1").html("东方LNN");
        $(".game").html("游戏");
        $(".games").html("游戏");
        $(".player").html("玩家");
        $(".players").html("玩家");
        $(".differentn").html("玩家");
        $(".overall").html("合計");
        $(".ranking").html("排行");
        $(".difficulty").html("难度");
        $(".playerranking").html("玩家排行");
        $(".overallcount").html("总数");
        $(".nooflnns").html("LNN的数量");
        $(".all").html("（全）");
        $(".ack").html("致谢");
        $(".lnns").html("LNN列表");
        $("#description").html("这个网页记载所有「东方Project」的LNN（Lunatic No Miss No Bomb），时不时地更新。每作游戏的每个机体有一行显示打出LNN的玩家。如" +
                "果某一位玩家用一个机体打出多次LNN，只算一次，其余次数不算入统计。");
        $("#conditions").html("妖妖梦、神灵庙、天空璋打NN时有附加条件，即是不爆结界、不开灵界、不使用季节解放。此三作LNN被称为LNNN，以第三个N代表着附加的条件。星莲船的附加条件（不开" +
                "飞碟）由于对难度没有大量的影响，可以自选。永夜抄的LNN必须收取所有LSC，称做LNNFS。");
        $("#tables").html("点击任何标题即可排序表格内容。");
        $("#contents_header").html("内容");
        $("#clickgame").html("单击游戏处查看LNN列表。");
        $("#score").html("分数");
        $("#label_all").html("皆");
        $("#autosort").html("WR数量");
        $("#differentgames").html("游戏");
        $("#jptlcredit").html("感谢<a href='https://twitter.com/toho_yumiya'>Yu-miya</a>提供头部文字的日语翻译。");
        $("#cntlcredit").html("感谢<a href='https://twitter.com/williewillus'>williewillus</a>提供头部文字的中文翻译。");
        $("#backtotop").html("回到顶部")
    }
}
function generateTableText() {
    if (language == "English") {
        $(".shottype").html("Shottype");
        $(".route").html("Route");
        $(".players").html("Players");
        $(".overall").html("Overall");
        $(".total").html("Total");
        $(".nooflnns").html("No. of LNNs");
        $(".nooflnnus").html("No. of LNN(N)s");
        $(".nooflnnns").html("No. of LNNNs");
        $(".nooflnnfss").html("No. of LNNFSs");
        $(".nooflnnnns").html("No. of LNNNNs");
        $(".different").html("(Different players)")
    } else if (language == "Japanese") {
        $(".shottype").html("キャラ");
        $(".route").html("ルート");
        $(".players").html("プレイヤー");
        $(".overall").html("合計");
        $(".total").html("総計");
        $(".nooflnns").html("LNNの数");
        $(".nooflnnus").html("LNNの数");
        $(".nooflnnns").html("LNNNの数");
        $(".nooflnnfss").html("LNNFSの数");
        $(".nooflnnnns").html("LNNNNの数");
        $(".different").html("（プレイヤー）")
    } else {
        $(".shottype").html("机体");
        $(".route").html("路线");
        $(".players").html("玩家");
        $(".overall").html("合計");
        $(".total").html("总数");
        $(".nooflnns").html("LNN的数量");
        $(".nooflnnus").html("LNN的数量");
        $(".nooflnnns").html("LNNN的数量");
        $(".nooflnnfss").html("LNNFS的数量");
        $(".nooflnnnns").html("LNNNN的数量");
        $(".different").html("（玩家）")
    }
}
function generateShottypes() {
    if (language == "English") {
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
        $(".FinalA").html("FinalA");
        $(".FinalB").html("FinalB");
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
        $(".Spring").html("Spring");
        $(".Summer").html("Summer");
        $(".Autumn").html("Autumn");
        $(".Winter").html("Winter");
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
        $(".YoumuEagle").html("YoumuEagle")
    } else if (language == "Japanese") {
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
        $(".FinalA").html("Aルート");
        $(".FinalB").html("Bルート");
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
        $(".YoumuEagle").html("妖夢鷲")
    } else {
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
        $(".FinalA").html("路线A");
        $(".FinalB").html("路线B");
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
        $(".YoumuEagle").html("妖梦鹰")
    }
}
function generateFullNames() {
    if (language == "English") {
        $(".SoEWf").html("Touhou 2 - The Story of Eastern Wonderland");
        $(".PoDDf").html("Touhou 3 - Phantasmagoria of Dim.Dream");
        $(".LLSf").html("Touhou 4 - Lotus Land Story");
        $(".MSf").html("Touhou 5 - Mystic Square");
        $(".EoSDf").html("Touhou 6 - The Embodiment of Scarlet Devil");
        $(".PCBf").html("Touhou 7 - Perfect Cherry Blossom");
        $(".INf").html("Touhou 8 - Imperishable Night");
        $(".MoFf").html("Touhou 10 - Mountain of Faith");
        $(".SAf").html("Touhou 11 - Subterranean Animism");
        $(".UFOf").html("Touhou 12 - Undefined Fantastic Object");
        $(".GFWf").html("Touhou 12.8 - Great Fairy Wars");
        $(".TDf").html("Touhou 13 - Ten Desires");
        $(".DDCf").html("Touhou 14 - Double Dealing Character");
        $(".LoLKf").html("Touhou 15 - Legacy of Lunatic Kingdom");
        $(".HSiFSf").html("Touhou 16 - Hidden Star in Four Seasons");
        $(".WBaWCf").html("Touhou 17 - Wily Beast and Weakest Creature")
    } else if (language == "Japanese") {
        $(".SoEWf").html("東方封魔録　～ the Story of Eastern Wonderland");
        $(".PoDDf").html("東方夢時空　～ Phantasmagoria of Dim.Dream");
        $(".LLSf").html("東方幻想郷　～ Lotus Land Story");
        $(".MSf").html("東方怪綺談　～ Mystic Square");
        $(".EoSDf").html("東方紅魔郷　～ the Embodiment of Scarlet Devil");
        $(".PCBf").html("東方妖々夢　～ Perfect Cherry Blossom");
        $(".INf").html("東方永夜抄　～ Imperishable Night");
        $(".MoFf").html("東方風神録　～ Mountain of Faith");
        $(".SAf").html("東方地霊殿　～ Subterranean Animism");
        $(".UFOf").html("東方星蓮船　～ Undefined Fantastic Object");
        $(".GFWf").html("妖精大戦争　～ 東方三月精");
        $(".TDf").html("東方神霊廟　～ Ten Desires");
        $(".DDCf").html("東方輝針城　～ Double Dealing Character");
        $(".LoLKf").html("東方紺珠伝　～ Legacy of Lunatic Kingdom");
        $(".HSiFSf").html("東方天空璋　～ Hidden Star in Four Seasons");
        $(".WBaWCf").html("東方鬼形獣　～ Wily Beast and Weakest Creature")
    } else {
        $(".SoEWf").html("东方封魔录　～ the Story of Eastern Wonderland");
        $(".PoDDf").html("东方梦时空　～ Phantasmagoria of Dim.Dream");
        $(".LLSf").html("东方幻想乡　～ Lotus Land Story");
        $(".MSf").html("东方怪绮谈　～ Mystic Square");
        $(".EoSDf").html("东方红魔乡　～ the Embodiment of Scarlet Devil");
        $(".PCBf").html("东方妖妖梦　～ Perfect Cherry Blossom");
        $(".INf").html("东方永夜抄　～ Imperishable Night");
        $(".MoFf").html("东方风神录　～ Mountain of Faith");
        $(".SAf").html("东方地灵殿　～ Subterranean Animism");
        $(".UFOf").html("东方星莲船　～ Undefined Fantastic Object");
        $(".GFWf").html("妖精大战争　～ 东方三月精");
        $(".TDf").html("东方神灵庙　～ Ten Desires");
        $(".DDCf").html("东方辉针城　～ Double Dealing Character");
        $(".LoLKf").html("东方绀珠传　～ Legacy of Lunatic Kingdom");
        $(".HSiFSf").html("东方天空璋　～ Hidden Star in Four Seasons");
        $(".WBaWCf").html("东方鬼形獣　～ Wily Beast and Weakest Creature")
    }
}
function generateShortNames() {
    if (language == "English") {
        $(".SoEW").html("SoEW");
        $(".PoDD").html("PoDD");
        $(".LLS").html("LLS");
        $(".MS").html("MS");
        $(".EoSD").html("EoSD");
        $(".PCB").html("PCB");
        $(".IN").html("IN");
        $(".MoF").html("MoF");
        $(".SA").html("SA");
        $(".UFO").html("UFO");
        $(".DS").html("DS");
        $(".GFW").html("GFW");
        $(".TD").html("TD");
        $(".DDC").html("DDC");
        $(".LoLK").html("LoLK");
        $(".HSiFS").html("HSiFS");
        $(".WBaWC").html("WBaWC")
    } else if (language == "Japanese") {
        $(".SoEW").html("封");
        $(".PoDD").html("夢");
        $(".LLS").html("幻");
        $(".MS").html("怪");
        $(".EoSD").html("紅");
        $(".PCB").html("妖");
        $(".IN").html("永");
        $(".MoF").html("風");
        $(".SA").html("地");
        $(".UFO").html("星");
        $(".GFW").html("大");
        $(".TD").html("神");
        $(".DDC").html("輝");
        $(".LoLK").html("紺");
        $(".HSiFS").html("天");
        $(".WBaWC").html("鬼")
    } else {
        $(".SoEW").html("封");
        $(".PoDD").html("梦");
        $(".LLS").html("幻");
        $(".MS").html("怪");
        $(".EoSD").html("红");
        $(".PCB").html("妖");
        $(".IN").html("永");
        $(".MoF").html("风");
        $(".SA").html("地");
        $(".UFO").html("星");
        $(".GFW").html("大");
        $(".TD").html("神");
        $(".DDC").html("辉");
        $(".LoLK").html("绀");
        $(".HSiFS").html("天");
        $(".WBaWC").html("鬼")
    }
}
function generateAll() {
    generateText();
    generateTableText();
    generateShottypes();
    generateFullNames();
    generateShortNames()
}
function setLanguage(newLanguage) {
    if (language == newLanguage) {
        return
    }
    var oldLanguage = language,
        lm = $("#lm").html();
    language = newLanguage;
    if (selected !== "" || playerSelected) {
        generateAll()
    } else {
        generateText();
        generateShortNames()
    }
    setCookie("lang", newLanguage);
    if (language == "English") {
        $("#lastupdate").html("LNNs are current as of <span id='lm'>" + translateEADate(lm, "DMY") + "</span>.")
    } else if (language == "Japanese") {
        $("#lastupdate").html("<span id='lm'>" + (oldLanguage == "English"
            ? translateDate(lm, "YMD")
            : lm) + "</span>現在のLNN記録です</span>。")
    } else {
        $("#lastupdate").html("LNN更新于<span id='lm'>" + (oldLanguage == "English"
            ? translateDate(lm, "YMD")
            : lm) + "</span>。")
    }
}
function dark() {
    var style = document.createElement("link");
    style.id = "dark";
    style.href = "assets/shared/dark-wr.css";
    style.type = "text/css";
    style.rel = "stylesheet";
    $("head").append(style);
    $("#hy").attr("title", "Youkai Mode")
}
function theme(e) {
    if (e.src.indexOf("y") < 0) {
        e.src = "assets/shared/y-bar.png";
        localStorage.theme = "dark";
        dark()
    } else {
        e.src = "assets/shared/h-bar.png";
        $("head")
            .children("#dark")
            .remove();
        $("#hy").attr("title", "Human Mode");
        localStorage.theme = "light"
    }
}
$(document)
    .ready(function () {
        if (localStorage.theme == "dark") {
            $("#hy").attr("src", "assets/shared/y-bar.png");
            dark()
        }
        if (location.protocol == "file:") {
            var path = location
                .pathname
                .split('/')
                .pop();
            $("#nav a").attr("href", function (i, oldHref) {
                return (oldHref == '/'
                    ? location.href.replace(path, "index.html") + ""
                    : oldHref + ".html")
            })
        }
        load()
    });
