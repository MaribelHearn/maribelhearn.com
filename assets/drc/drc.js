var WRs, Rubrics, step, global = this, phantasm = true, noExtra = true, noShottypes = true, dsActive = true, language = "English",
    DIFFICULTY = "#difficulty", BOMBS = "#bombs", SCORE = "#score", PERFORMANCE = "#performance", DRCPOINTS = "#drcpoints",
    ERROR = "#error", SHOTTYPE = "#shottype", NOTIFY = "#notify", NB = "#nb", MISSES = "#misses", CHALLENGE = "#challenge",
    NO_EXTRA = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>",
    SHOTTYPE_MULTIPLIERS = "#shottypeMultipliersTable", DIFF_OPTIONS = "<option>Easy</option>\n<option>Normal</option>\n" +
    "<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option>", LS = "#ls", IS = "#is",
    PHANTASM = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n" +
    "<option>Extra</option><option>Phantasm</option>", RELEASES = "#releases", SEASON = "#season", MISSES_LABEL = "#missesLabel",
    SHOTTYPE_LABEL = "#shottypeLabel", CLEARED = "#cleared", SCENE = "#scene", ROUTE = "#route", BOMBS_LABEL = "#bombsLabel",
    MISSES_INPUT = "<label id='missesLabel' for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100>",
    SCORE_OPTIONS = "<label id='scoreLabel' for='score'>Score</label><input id='score' type='text'>", NB_LABEL = "#nbLabel",
    RELEASES_LABEL = "#releasesLabel", IS_LABEL = "#isLabel", LS_LABEL = "#lsLabel", SCORE_LABEL = "#scoreLabel",
    BB_LABEL = "#bbLabel", COUNTDOWN = "#countdown", NO_CHARGE_LABEL = "#ncLabel", DS = "#ds", GAME = "#game", BB = "#bb",
    SURV_BUTTON = "#survivalButton", SCORE_BUTTON = "#scoringButton",
    SURV_RUBRICS = "#survivalRubrics", SCORE_RUBRICS = "#scoringRubrics";

$(document).ready(function () {
    if (getCookie("lang") == "Japanese" || location.href.contains("jp")) {
        language = "Japanese";
    } else if (getCookie("lang") == "Chinese" || location.href.contains("zh")) {
        language = "Chinese";
    } else if (getCookie("lang") == "Russian" || location.href.contains("ru")) {
        language = "Russian";
    }

    $("#top").attr("lang", langCode(language, false));
    $("#calculate").on("click", drcPoints);
    $("#scoringButton").on("click", {challenge: "Scoring"}, showRubrics);
    $("#survivalButton").on("click", {challenge: "Survival"}, showRubrics);
    $("#game").on("change", {changePerf: true, changeShots: true}, checkValues);
    $("#difficulty").on("change", changeDifficulty);
    $("#challenge").on("change", {changePerf: true, changeShots: false}, checkValues);
    $("#challenge").on("change", {alwaysChange: false}, checkShottypes);
    $("#shottype").on("change", {changePerf: false, changeShots: false}, checkValues);
    $("#calculator").css("display", "block");
    $("#scoringButton, #survivalButton").css("display", "inline");
    $("#scoringRubrics, #survivalRubrics").css("display", "none");
    $(".flag").attr("href", "");
    $("#en").on("click", {language: "English"}, setLanguage);
    $("#jp").on("click", {language: "Japanese"}, setLanguage);
    $("#zh").on("click", {language: "Chinese"}, setLanguage);
    checkValues({data: {changePerf: true, changeShots: true}});
    step = setInterval(updateCountdown, 1000);
    updateCountdown();
});
function updateCountdown() {
    var countdownDate, now, distance, days, hours, minutes, seconds;

    countdownDate = Date.UTC("2019", "5", "17", "14", "00", "0");
    now = new Date().getTime();
    distance = countdownDate - now;
    days = Math.floor(distance / (1000 * 60 * 60 * 24));
    hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor((distance % (1000 * 60)) / 1000);
    $(COUNTDOWN).html("DRC End<br>" + days + translate("d ") + hours + translate("h ")
    + minutes + translate("m ") + seconds + translate("s"));

    if (distance < 0) {
        $(COUNTDOWN).html("");
        clearInterval(step);
    }
}
function translateCharName(charName) {
    if (language == "Chinese") {
        return ({
            "Makai": "魔界",
            "Jigoku": "地狱",
            "ReimuA": "灵梦A",
            "ReimuB": "灵梦B",
            "ReimuC": "灵梦C",
            "Reimu": "灵梦",
            "Mima": "魅魔",
            "Marisa": "魔理沙",
            "Ellen": "爱莲",
            "Kotohime": "小兔姬",
            "Kana": "卡娜",
            "Rikako": "理香子",
            "Chiyuri": "千百合",
            "Yumemi": "梦美",
            "Yuuka": "幽香",
            "MarisaA": "魔理沙A",
            "MarisaB": "魔理沙B",
            "SakuyaA": "咲夜A",
            "SakuyaB": "咲夜B",
            "BorderTeam": "结界组",
            "MagicTeam": "咏唱组",
            "ScarletTeam": "红魔组",
            "GhostTeam": "幽冥组",
            "Yukari": "紫",
            "Alice": "爱丽丝",
            "Sakuya": "咲夜",
            "Remilia": "蕾米莉亚",
            "Youmu": "妖梦",
            "Yuyuko": "幽幽子",
            "Reisen": "铃仙",
            "Cirno": "琪露诺",
            "Lyrica": "莉莉卡",
            "Mystia": "米丝蒂亚",
            "Tewi": "帝",
            "Aya": "文",
            "Medicine": "梅蒂薪",
            "Komachi": "小町",
            "Eiki": "映姬",
            "MarisaC": "魔理沙C",
            "SanaeA": "早苗A",
            "SanaeB": "早苗B",
            "A1": "A1",
            "A2": "A2",
            "B1": "B1",
            "B2": "B2",
            "C1": "C1",
            "C2": "C2",
            "Sanae": "早苗",
            "Spring": "春",
            "Summer": "夏",
            "Autumn": "秋",
            "Winter": "冬",
            "ReimuSpring": "灵梦春",
            "CirnoSpring": "琪露诺春",
            "AyaSpring": "文春",
            "MarisaSpring": "魔理沙春",
            "ReimuSummer": "灵梦夏",
            "CirnoSummer": "琪露诺夏",
            "AyaSummer": "文夏",
            "MarisaSummer": "魔理沙夏",
            "CirnoAutumn": "琪露诺秋",
            "AyaAutumn": "文秋",
            "MarisaAutumn": "魔理沙秋",
            "CirnoWinter": "琪露诺冬",
            "AyaWinter": "文冬",
            "ReimuWolf": "灵梦狼",
            "ReimuOtter": "灵梦獺",
            "ReimuEagle": "灵梦鹰",
            "MarisaWolf": "魔理沙狼",
            "MarisaOtter": "魔理沙獺",
            "MarisaEagle": "魔理沙鹰",
            "YoumuWolf": "妖梦狼",
            "YoumuOtter": "妖梦獺",
            "YoumuEagle": "妖梦鹰"
        }[charName]);
    } else if (language == "Japanese") {
        return ({
            "Makai": "魔界",
            "Jigoku": "地獄",
            "ReimuA": "霊夢A",
            "ReimuB": "霊夢B",
            "ReimuC": "霊夢C",
            "Reimu": "霊夢",
            "Mima": "魅魔",
            "Marisa": "魔理沙",
            "Ellen": "エレン",
            "Kotohime": "小兎姫",
            "Kana": "カナ",
            "Rikako": "理香子",
            "Chiyuri": "ちゆり",
            "Yumemi": "夢美",
            "Yuuka": "幽香",
            "MarisaA": "魔理沙A",
            "MarisaB": "魔理沙B",
            "SakuyaA": "咲夜A",
            "SakuyaB": "咲夜B",
            "BorderTeam": "霊夢＆紫",
            "MagicTeam": "魔理沙＆アリス",
            "ScarletTeam": "咲夜＆レミリア",
            "GhostTeam": "妖夢＆幽々子",
            "Yukari": "紫",
            "Alice": "アリス",
            "Sakuya": "咲夜",
            "Remilia": "レミリア",
            "Youmu": "妖夢",
            "Yuyuko": "幽々子",
            "Reisen": "鈴仙",
            "Cirno": "チルノ",
            "Lyrica": "リリカ",
            "Mystia": "ミスティア",
            "Tewi": "てゐ",
            "Aya": "文",
            "Medicine": "メディスン",
            "Komachi": "小町",
            "Eiki": "映姫",
            "MarisaC": "魔理沙C",
            "SanaeA": "早苗A",
            "SanaeB": "早苗B",
            "A1": "A1",
            "A2": "A2",
            "B1": "B1",
            "B2": "B2",
            "C1": "C1",
            "C2": "C2",
            "Sanae": "早苗",
            "Spring": "春",
            "Summer": "夏",
            "Autumn": "秋",
            "Winter": "冬",
            "ReimuSpring": "霊夢春",
            "CirnoSpring": "チルノ春",
            "AyaSpring": "文春",
            "MarisaSpring": "魔理沙春",
            "ReimuSummer": "霊夢夏",
            "CirnoSummer": "チルノ夏",
            "AyaSummer": "文夏",
            "MarisaSummer": "魔理沙夏",
            "CirnoAutumn": "チルノ秋",
            "AyaAutumn": "文秋",
            "MarisaAutumn": "魔理沙秋",
            "CirnoWinter": "チルノ冬",
            "AyaWinter": "文冬",
            "ReimuWolf": "霊夢狼",
            "ReimuOtter": "霊夢獺",
            "ReimuEagle": "霊夢鷲",
            "MarisaWolf": "魔理沙狼",
            "MarisaOtter": "魔理沙獺",
            "MarisaEagle": "魔理沙鷲",
            "YoumuWolf": "妖夢狼",
            "YoumuOtter": "妖夢獺",
            "YoumuEagle": "妖夢鷲"
        }[charName]);
    } else { // English
        return charName.replace("Team", " Team");
    }
}
function translate(arg) {
    if (language == "Chinese") {
        return ({
            "Route": "路线",
            "Shottype": "机体",
            "Important Notice:": "重要提示：",
            "usage of the MarisaB damage bug is BANNED in survival.": "生存向 弑神炮禁止。",
            "<em>manual</em> trances count as bombs (that is, trances from pressing C).": "主动灵界视作扔雷。",
            "border breaks count as bombs <em>even if they are accidental</em>.": "灵击视作扔雷，无论是否被弹灵击。",
            "Your DRC points for this run: ": "本轮DRC得分：",
            "Error: ": "错误：",
            "the survival rubrics for this game are undetermined as of now.": "此游戏的生存向计算公式现在仍未决定。",
            "the scoring rubrics for this game are undetermined as of now.": "此游戏的打分向计算公式现在仍未决定。",
            "the scoring rubrics for this difficulty are undetermined as of now.": "此难度的打分向计算公式现在仍未决定。",
            "the scoring rubrics for this shottype are undetermined as of now.": "此机体的打分向计算公式现在仍未决定。",
            "invalid score.": "无效分数。",
            "||Max * (Score/WR)^Exp||": "||最大值 * (得分 / WR) ^ 指数||",
            "||Max * (Base^-n)||": "||最大值 * (基数 ^ -n)||",
            "Category": "项目",
            "WR based on": "机体",
            "Scoring": "打分",
            "Survival": "生存",
            "Hide Survival Rubrics": "隐藏生存计算公式",
            "Show Survival Rubrics": "显示生存计算公式",
            "Hide Scoring Rubrics": "隐藏打分计算公式",
            "Show Scoring Rubrics": "显示打分计算公式",
            "No Bomb": "禁雷",
            "Misses": "被弹数",
            "Rounds lost": "败北数",
            "No Charge Attacks": "NC",
            "Border Breaks": "灵击数",
            "Bombs / Trances": "扔雷数/灵界数",
            "Bombs": "扔雷数",
            "Imperishable Shooting Captured": "【不朽的弹幕】收取",
            "Last Spells Captured": "LSC收取数",
            "Releases": "季节解放数",
            "Score": "分数",
            "Scene": "场景",
            "Threshold 1": "第一阈值",
            "Threshold 2": "第二阈值",
            "Threshold 3": "第三阈值",
            "Base points": "基数分",
            "d ": "日",
            "h ": "时",
            "m ": "分",
            "s": "秒"
        }[arg]);
    } else if (language == "Japanese") {
        return ({
            "Route": "ルート",
            "Shottype": "キャラ",
            "Important Notice:": "重要通知:",
            "usage of the MarisaB damage bug is BANNED in survival.": "魔理沙Bのバグを使ってはいけまでん。",
            "<em>manual</em> trances count as bombs (that is, trances from pressing C).": "Cキー押下による手動トランスはボムとして扱います。",
            "border breaks count as bombs <em>even if they are accidental</em>.": "霊撃は偶発的なものであってもボムとして扱います。",
            "Your DRC points for this run: ": "DRCポイント: ",
            "Error: ": "エラー: ",
            "the survival rubrics for this game are undetermined as of now.": "このゲームのクリア重視のルーブリックはまだ決めていない。",
            "the scoring rubrics for this game are undetermined as of now.": "このゲームの稼ぎのルーブリックはまだ決めていない。",
            "the scoring rubrics for this difficulty are undetermined as of now.": "この難易度の稼ぎのルーブリックはまだ決めていない。",
            "the scoring rubrics for this shottype are undetermined as of now.": "このキャラの稼ぎのルーブリックはまだ決めていない。",
            "invalid score.": "無効のスコア。",
            "||Max * (Score/WR)^Exp||": "||最大点 * (スコア / WR) ^ 冪指数||",
            "||Max * (Base^-n)||": "||最大点 * (底 ^ -n)||",
            "Category": "カテゴリー",
            "WR based on": "キャラ",
            "Scoring": "稼ぎ",
            "Survival": "クリア重視",
            "Hide Survival Rubrics": "クリア重視のルーブリックを見せない",
            "Show Survival Rubrics": "クリア重視のルーブリックを見せて",
            "Hide Scoring Rubrics": "稼ぎのルーブリックを見せない",
            "Show Scoring Rubrics": "稼ぎのルーブリックを見せて",
            "No Bomb": "ノーボム",
            "Misses": "ミス",
            "Rounds lost": "敗北数",
            "No Charge Attacks": "ノーチャージ攻撃",
            "Border Breaks": "霊撃",
            "Bombs / Trances": "ボム / トランス",
            "Bombs": "ボム",
            "Imperishable Shooting Captured": "「インペリシャブルシューティング」取得",
            "Last Spells Captured": "ラストスペル取得",
            "Releases": "解放",
            "Score": "スコア",
            "Scene": "撮影対象",
            "Threshold 1": "閾値1",
            "Threshold 2": "閾値2",
            "Threshold 3": "閾値3",
            "Base points": "素点",
            "d ": "日",
            "h ": "時",
            "m ": "分",
            "s": "秒"
        }[arg]);
    } else { // English
        return arg;
    }
}
function changeDifficulty() {
    if ($(GAME).val() == "GFW") {
        checkShottypes({data: {alwaysChange: true}});
    }

    if ($(GAME).val() == "IN" || $(GAME).val() == "HSiFS") {
        checkValues({data: {changePerf: true, changeShots: false}});
    }
}
function checkValues(event) {
    var changePerformance = event.data.changePerf, changeShottypes = event.data.changeShots,
        game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(), shottype = $(SHOTTYPE).val();

    if (challenge == "Survival") {
        var notifyText = "<b id='impNot'>" + translate("Important Notice:") + "</b> ";

        if (game == "MoF" && shottype == "MarisaB") {
            $(NOTIFY).html(notifyText + "<span id='impNotText0'>" +
            translate("usage of the MarisaB damage bug is BANNED in survival.") + "</span>");
        } else if (game == "TD") {
            $(NOTIFY).html(notifyText + "<span id='impNotText1'>" +
            translate("<em>manual</em> trances count as bombs (that is, trances from pressing C).") + "</span>");
        } else if (game == "PCB") {
            $(NOTIFY).html(notifyText + "<span id='impNotText2'>" +
            translate("border breaks count as bombs <em>even if they are accidental</em>.") + "</span>");
        } else {
            $(NOTIFY).html("");
        }
    }

    if (changePerformance) {
        $(ROUTE).css("display", "none");
        $(SEASON).css("display", "none");

        if (changeShottypes) {
            if (game == "DS") {
                $(DIFFICULTY).css("display", "none");
                dsActive = true;
            } else if (dsActive) {
                $(DIFFICULTY).css("display", "inline");
                dsActive = false;
            }

            if (game == "PCB") {
                $(DIFFICULTY).html(PHANTASM);
                phantasm = true;
            } else if (phantasm) {
                $(DIFFICULTY).html(DIFF_OPTIONS);
                phantasm = false;
            }

            if (game == "HRtP" || game == "PoDD") {
                $(DIFFICULTY).html(NO_EXTRA);
                noExtra = true;
            } else if (game != "PCB" && noExtra) {
                $(DIFFICULTY).html(DIFF_OPTIONS);
                noExtra = false;
            }
        }

        if (game == "HSiFS" && $(DIFFICULTY).val() != "Extra") {
            $(SEASON).css("display", "inline");
        }

        if (challenge == "Survival") {
            var survOptions = MISSES_INPUT;

            if (game == "PoDD") {
                survOptions += "<br><label id='nbLabel' for='nb'>" + translate("No Bomb") + "</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace(translate("Misses") + "</label>", translate("Rounds lost") +
                "</label>").replace("max=100", "max=5");
            } else if (game == "PoFV") {
                survOptions += "<br><label id='ncLabel' for='nb'>" + translate("No Charge Attacks") + "</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace(translate("Misses") + "</label>", translate("Rounds lost") +
                "</label>").replace("max=100", "max=8");
            } else {
                if (game == "PCB") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + translate("Bombs") +
                    "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                    survOptions += "<br><label id='bbLabel' for='bb'>" + translate("Border Breaks") +
                    "</label><input id='bb' type='number' value=0 min=0 max=100>";
                } else if (game == "TD") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + translate("Bombs / Trances") +
                    "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                } else {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + translate("Bombs") +
                    "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                }
                if (game == "IN") {
                    difficulty = $(DIFFICULTY).val();
                    if (difficulty == "Extra") {
                        survOptions += "<br><label id='isLabel' for='is'>" + translate("Imperishable Shooting Captured") +
                        "</label><input id='is' type='checkbox'>";
                    } else {
                        survOptions += "<br><label id='lsLabel' for='ls'>" + translate("Last Spells Captured") +
                        "</label><input id='ls' type='number' value=0 min=0 max=10>";
                        $(ROUTE).css("display", "inline");
                    }
                }
                if (game == "HSiFS") {
                    survOptions += "<br><label id='releasesLabel' for='releases'>" + translate("Releases") +
                    "</label><input id='releases' type='number' value=0 min=0 max=1000>";
                }
            }
            $(PERFORMANCE).html(survOptions);
            $(MISSES_LABEL).html(translate("Misses"));
        } else {
            if (game == "DS") {
                $(PERFORMANCE).html("<label for='scene'>Scene</label><select id='scene'><option>2-5</option><option>5" +
                "-3</option><option>7-3</option><option>8-1</option><option>8-5</option><option>1" +
                "1-8</option></select><br>" + SCORE_OPTIONS);
            } else {
                $(PERFORMANCE).html(SCORE_OPTIONS);
            }

            $(SCORE_LABEL).html(translate("Score"));
            $(NOTIFY).html("");
        }
    }
    if (changeShottypes) {
        checkShottypes({data: {alwaysChange: true}});
    }
}
function checkShottypes(event) {
    var alwaysChange = event.data.alwaysChange, shots = JSON.parse($("#shots").val()), game = $(GAME).val(),
        challenge = $(CHALLENGE).val(), difficulty = $(DIFFICULTY).val(), shottypes = shots[game], shottypeList = "", shottype, i;

    if (game == "HSiFS") {
        shottypes = ["Reimu", "Cirno", "Aya", "Marisa"];
    } else if (game == "DS") {
        shottypes = ["Aya", "Hatate"];
    }

    for (i = 0; i < shottypes.length; i += 1) {
        shottypeList += "<option id='shottype" + i + "' value='" + shottypes[i] +
        "'>" + translateCharName(shottypes[i]) + "</option>";
    }

    if (alwaysChange) {
        $(SHOTTYPE).html(shottypeList);
    }

    if (game == "HRtP" || game == "GFW") {
        $(SHOTTYPE_LABEL).html(translate("Route"));
    } else {
        $(SHOTTYPE_LABEL).html(translate("Shottype"));
    }

    if (game == "GFW" && difficulty == "Extra") {
        $(SHOTTYPE).html("<option value='-'>-</option>");
        noShottypes = true;
    } else if (noShottypes) {
        $(SHOTTYPE).html(shottypeList);
        noShottypes = false;
    }
}
function isPhantasmagoria(game) {
    return game == "PoDD" || game == "PoFV";
}
function drcPoints() {
    if (!Rubrics) {
        $.get("assets/json/rubrics.json", function (data) {
            Rubrics = data;
            drcPoints();
        }, "json");
        return;
    }

    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(),
        shottype = $(SHOTTYPE).val(), rubric, season, points;

    if (challenge == "Survival") {
        if (!Rubrics.SURV[game]) {
            $(ERROR).html("<strong class='error'>" + translate("Error: ") + translate("the survival rubrics for this game are undetermined as of now.") + "</strong>");
            $(DRCPOINTS).html("");
            return;
        } else {
            $(ERROR).html("");
        }

        rubric = Rubrics.SURV[game][difficulty];

        if (game == "HSiFS" && Number($(RELEASES).val()) === 0) {
            season = $(SEASON).val();
            shottypeMultiplier = (Rubrics.SURV[game].multiplier[shottype + season] ? Rubrics.SURV[game].multiplier[shottype + season] : 1);
        } else {
            shottypeMultiplier = (Rubrics.SURV[game].multiplier[shottype] ? Rubrics.SURV[game].multiplier[shottype] : 1);
        }

        points = (isPhantasmagoria(game) ? phantasmagoria(rubric, game, difficulty, shottypeMultiplier) : survivalPoints(rubric, game, difficulty, shottypeMultiplier));
    } else {
        if (!(game == "MoF" && (difficulty == "Easy" || difficulty == "Lunatic" || difficulty == "Extra")) && game != "DS" && !Rubrics.SCORE[game]) {
            $(ERROR).html("<strong class='error'>" + translate("Error: ") + translate("the scoring rubrics for this game are undetermined as of now.") + "</strong>");
            $(DRCPOINTS).html(translate("Your DRC points for this run: ") + " <strong>0</strong>!");
            return
        } else {
            $(ERROR).html("");
        }

        if (game == "DS") {
            points = dsFormula();
        } else if (game == "MoF") {
            points = mofFormula(difficulty, shottype);
        } else {
            if (!WRs) {
                $.get("assets/json/wrlist.json", function (data) {
                    WRs = data;
                    drcPoints();
                }, "json");
                return;
            }

            rubric = Rubrics.SCORE[game][difficulty];
            points = scoringPoints(rubric, game, difficulty, shottype);
        }
    }
    $(DRCPOINTS).html(translate("Your DRC points for this run: ") + " <strong>" + points + "</strong>!");
}
function phantasmagoria(rubric, game, difficulty, shottypeMultiplier) {
    var roundsLost = Number($(MISSES).val()), bonus;

    if (roundsLost > rubric.lives) {
        if (language == "Chinese") {
            $(ERROR).html("<strong class='error'>错误：败北数不能超过" + rubric.lives + "。</strong>");
        } else if (language == "Japanese") {
            $(ERROR).html("<strong class='error'>エラー: 敗北数が" + rubric.lives + "を超えてはいけません。</strong>");
        } else { // English
            $(ERROR).html("<strong class='error'>Error: the number of rounds lost cannot exceed " + rubric.lives + "</strong>");
        }
        return 0;
    } else {
        $(ERROR).html("");
    }

    bonus = $(NB).is(":checked") ? rubric.noBombBonus : 0;

    if (difficulty == "Extra") {
        shottypeMultiplier = 1;
    }

    return Math.round(shottypeMultiplier * ((rubric.base - ((rubric.base - rubric.min) / rubric.lives * roundsLost)) + bonus));
}
function survivalPoints(rubric, game, difficulty, shottypeMultiplier) {
    var misses = Number($(MISSES).val()), bombs = Number($(BOMBS).val()), originalBombs = bombs,
        n = 0, decrement = 0, borderBreaks, route, lastSpells, releases, season, i;

    $(ERROR).html("");
    n += misses * rubric.miss;

    if (bombs >= 1) {
        n += rubric.firstBomb;
        bombs -= 1;
    }

    n += bombs * rubric.bomb;

    if (game == "PCB") {
        borderBreaks = Number($(BB).val());
        n += borderBreaks * rubric.bomb;
    }

    if (game == "HSiFS") {
        releases = Number($(RELEASES).val());

        if (releases >= 1) {
            n += rubric.firstRelease;
            releases -= 1;
        }

        while (releases > 0) {
            for (i = 0; i < 10; i += 1) {
                n += rubric.release - decrement;
                releases -= 1;

                if (releases === 0) {
                    break;
                }
            }

            decrement += (decrement == 0.4 ? 0 : 0.1);
            i = 0;
        }
    }
    drcpoints = Math.round(rubric.base * Math.pow(rubric.exp, -n));
    if (game == "IN") {
        if (difficulty == "Extra") {
            drcpoints += ($(IS).is(":checked") ? 5 : 0);
        } else {
            route = $(ROUTE).val();
            lastSpells = $(LS).val();

            if (lastSpells > Rubrics.MAX_LAST_SPELLS[difficulty][route]) {
                if (language == "Chinese") {
                    $(ERROR).html("<strong class='error'>错误：" + route + "路线" + difficulty +
                    "难度中的LSC收取数不能超过" + Rubrics.MAX_LAST_SPELLS[difficulty][route] + "。");
                } else if (language == "Japanese") {
                    $(ERROR).html("<strong class='error'>エラー: ラストスペルが" + Rubrics.MAX_LAST_SPELLS[difficulty][route] +
                    "を超えてはいけません。</strong>");
                } else { // English
                    $(ERROR).html("<strong class='error'>Error: the number of Last Spells captured in a " + route +
                    " clear on " + difficulty + " cannot exceed " + Rubrics.MAX_LAST_SPELLS[difficulty][route] + "</strong>");
                }
                return 0;
            }

            drcpoints += lastSpells * (difficulty == "Easy" ? 1 : 2);
        }
    }

    if (difficulty != "Extra" && difficulty != "Phantasm" && !(game == "LoLK" && originalBombs > 0)) {
        drcpoints = Math.round(drcpoints * shottypeMultiplier);
    }

    return drcpoints;
}
function mofFormula(difficulty, shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")),
        drcpoints = 0, originalScore = score, thresholds, increment, step, i;

    if (difficulty != "Easy" && difficulty != "Lunatic" && difficulty != "Extra") {
        $(ERROR).html("<strong class='error'>" + translate("Error: ") + translate("the scoring rubrics for this difficulty are undetermined as of now.") + "</strong>");
        return drcpoints;
    } else if (difficulty == "Lunatic" && shottype != "ReimuB" && shottype != "MarisaC" || difficulty == "Extra" && shottype != "ReimuB") {
        $(ERROR).html("<strong class='error'>" + translate("Error: ") + translate("the scoring rubrics for this shottype are undetermined as of now.") + "</strong>");
        return drcpoints;
    }

    thresholds = Rubrics.MOF_THRESHOLDS[difficulty][shottype];

    if (score < thresholds.score[0]) {
        return Math.round(Math.pow((score / thresholds.score[0]), 2) * (difficulty == "Easy" ? 220 : 200));
    }

    drcpoints = thresholds.base[0];

    for (i = thresholds.increment.length - 1; i >= 0; i -= 1) {
        increment = thresholds.increment[i];
        step = thresholds.step[i];

        while (score - step >= thresholds.score[i]) {
            drcpoints += increment;
            score -= step;
        }
    }

    return Math.min(Math.round(drcpoints), (difficulty == "Easy" ? 375 : 500));
}
function determineIncrement(thresholds, i) {
    if (i == 4) {
        i = 3;
    }

    var increment = (i === 1 ? 20 : 30), lowerBound = thresholds[i - 1] * 1000;

    return (thresholds[i] * 1000 - lowerBound) / increment;
}
function dsFormula() {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")),
    scene = $(SCENE).val(), thresholds = Rubrics.SCENE_THRESHOLDS[scene], drcpoints = 0, step, i;

    if (score == thresholds[3] * 1000) {
        drcpoints += 1;
    }

    for (i = 3; i >= 0; i -= 1) {
        step = determineIncrement(thresholds, i + 1);

        while (score - step >= thresholds[i] * 1000) {
            drcpoints += 1;
            score -= step;
        }
    }

    return drcpoints;
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
function removeSeason(shottype) {
    return shottype.replace("Spring", "").replace("Summer", "").replace("Autumn", "").replace("Winter", "");
}
function scoringPoints(rubric, game, difficulty, shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), wr, wrshottype, exp;

    if (isNaN(score)) {
        $(ERROR).html("<strong class='error'>" + translate("Error: ") + translate("invalid score.") + "</strong>");
        return 0;
    } else {
        $(ERROR).html("");
    }

    if (Rubrics.SCORE[game][difficulty].basedOn) {
        wr = WRs[game][difficulty][Rubrics.SCORE[game][difficulty].basedOn][0];
    } else if (Rubrics.SCORE[game][difficulty].wr && typeof Rubrics.SCORE[game][difficulty].wr == "object" && Rubrics.SCORE[game][difficulty].wr.hasOwnProperty(shottype)) {
        wr = Rubrics.SCORE[game][difficulty].wr[shottype];
    } else if (Rubrics.SCORE[game][difficulty].wr && typeof Rubrics.SCORE[game][difficulty].wr != "object") {
        wr = Rubrics.SCORE[game][difficulty].wr;
    } else {
        wrshottype = (game == "HSiFS" ? removeSeason(shottype) + bestSeason(difficulty, shottype) : shottype);
        wr = WRs[game][difficulty][wrshottype][0];
    }

    exp = (game == "DDC" && difficulty == "Extra" && shottype == "MarisaB" ? 7 : rubric.exp);

    return (score >= wr ? rubric.base : Math.round(rubric.base * Math.pow((score / wr), exp)));
}
function showRubrics(event) {
    challenge = event.data.challenge;
    $(challenge == "Survival" ? SURV_RUBRICS : SCORE_RUBRICS).css("display", "block");
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).on("click", {challenge: challenge}, hideRubrics);
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).val(translate("Hide " + challenge + " Rubrics"));
}
function hideRubrics(event) {
    challenge = event.data.challenge;
    $(challenge == "Survival" ? SURV_RUBRICS : SCORE_RUBRICS).css("display", "none");
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).on("click", {challenge: challenge}, showRubrics);
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).val(translate("Show " + challenge + " Rubrics"));
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
