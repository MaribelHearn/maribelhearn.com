var MAX_SCORE = 9999999990, minAge = "Thu, 01 Jan 1970 00:00:00 UTC", maxAge = "Fri, 31 Dec 9999 23:59:59 UTC";

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
        for (var i = 0; i < array.length; i += 1) {
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

function setCookie(name, value) {
    document.cookie = name + "=" + JSON.stringify(value) + ";expires=" + maxAge + ";path=/;sameSite=Strict;Secure;";
}

function getCookie(name) {
    var decodedCookies, cookieArray, cookie;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');
    name += '=';

    for (var i = 0; i < cookieArray.length; i += 1) {
        cookie = cookieArray[i];

        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }

        if (cookie.indexOf(name) === 0) {
            return JSON.parse(cookie.substring(name.length, cookie.length));
        }
    }

    return "";
}

function deleteCookie(name) {
    document.cookie = name + "=;expires=" + minAge + ";path=/;";
}

function listCookies() {
    var cookieNames = [], decodedCookies, cookieArray, i;

    decodedCookies = decodeURIComponent(document.cookie);
    cookieArray = decodedCookies.split(';');

    for (i = 0; i < cookieArray.length; i += 1) {
        cookieNames.push(cookieArray[i].split('=')[0].removeSpaces());
    }

    return cookieNames;
}

function numericSort(a, b) {
    return b - a;
}

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function sep(number) {
    if (isNaN(number)) {
        return '-';
    }

    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function monthToNumber(month) {
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
}

function langCode(language, notation) {
    if (language == "English") {
        if (notation && notation == "MDY") {
            return "en-us";
        } else {
            return (notation ? "en-gb" : "en");
        }
    } else if (language == "Japanese") {
        return "ja";
    } else { // language == "Chinese"
        return "zh";
    }
}

function translateDate(date, notation) {
    var tmp = date.split('/');

    var day = tmp[0], month = tmp[1], year = tmp[2];

    if (notation == "YMD") {
        return (year + "年" + month + "月" + day + "日");
    } else if (notation == "MDY") {
        return (month + "/" + day + "/" + year);
    }
}

function translateUSDate(date, notation) {
    var tmp = date.split('/');

    var day = tmp[1], month = tmp[0], year = tmp[2];

    if (notation == "YMD") {
        return (year + "年" + month + "月" + day + "日");
    } else if (notation == "DMY") {
        return (day + "/" + month + "/" + year);
    }
}

function translateEADate(date, notation) {
    var tmp = date.replace(/(年|月|日)/g, '/').split('/');

    var day = tmp[2], month = tmp[1], year = tmp[0];

    if (notation == "DMY") {
        return (day + "/" + month + "/" + year);
    } else if (notation == "MDY") {
        return (month + "/" + day + "/" + year);
    }
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
        "WBaWC": 17,
        "UM": 18
    })[game];
}

function fullNameNumber(game) {
    return ({
        "HRtP": "Touhou 1 - The Highly Responsive to Prayers",
        "SoEW": "Touhou 2 - The Story of Eastern Wonderland",
        "PoDD": "Touhou 3 - Phantasmagoria of Dim.Dream",
        "LLS": "Touhou 4 - Lotus Land Story",
        "MS": "Touhou 5 - Mystic Square",
        "EoSD": "Touhou 6 - The Embodiment of Scarlet Devil",
        "PCB": "Touhou 7 - Perfect Cherry Blossom",
        "IN": "Touhou 8 - Imperishable Night",
        "PoFV": "Touhou 9 - Phantasmagoria of Flower View",
        "MoF": "Touhou 10 - Mountain of Faith",
        "SA": "Touhou 11 - Subterranean Animism",
        "UFO": "Touhou 12 - Undefined Fantastic Object",
        "GFW": "Touhou 12.8 - Great Fairy Wars",
        "TD": "Touhou 13 - Ten Desires",
        "DDC": "Touhou 14 - Double Dealing Character",
        "LoLK": "Touhou 15 - Legacy of Lunatic Kingdom",
        "HSiFS": "Touhou 16 - Hidden Star in Four Seasons",
        "WBaWC": "Touhou 17 - Wily Beast and Weakest Creature",
        "UM": "Touhou 18 - Unconnected Marketeers"
    }[game]);
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
        "Sakuya": "Sk",
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

function generateText() {
    if (language == "Chinese") {
        $(".ranking").html("排行");
        $(".difficulty").html("难度");
        $("#score").html("分数");
        $("#label_all").html("皆");
        $("#differentgames").html("游戏");
        $(".westernrecords").html("西方纪录");
    } else if (language == "Japanese") {
        $(".ranking").html("ランキング");
        $(".difficulty").html("難易度");
        $("#score").html("スコア");
        $("#label_all").html("全");
        $("#differentgames").html("ゲーム");
        $(".westernrecords").html("海外記録");
    } else {
        $(".ranking").html("Ranking");
        $(".difficulty").html("Difficulty");
        $("#score").html("Score");
        $("#label_all").html("All");
        $("#differentgames").html("Different games");
        $(".westernrecords").html("Western Records");
    }
}

function generateTableText(page) {
    if (language == "Chinese") {
        $(".game").html("游戏");
        $(".player").html("玩家");
        $(".players").html("玩家");
        $(".difficulty").html("难度");
        $(".shottype").html("机体");
        $(".route").html("路线");
        $(".date").html("日期");
        $(".dates").html("日期");
        $(".total").html(page == "wr" ? "合計" : "总数");
        $(".overall").html(page == "wr" ? "整体" : "合計");
        $(".world").html("世界");
        $(".west").html("西方");
        $(".percentage").html("百分");
        $(".nooflnns").html("LNN的数量");
        $(".nooflnnus").html("LNN的数量");
        $(".nooflnnns").html("LNNN的数量");
        $(".nooflnnfss").html("LNNFS的数量");
        $(".nooflnnnns").html("LNNNN的数量");
        $(".different").html("（玩家）");
        $(".all").html("（全）");
    } else if (language == "Japanese") {
        $(".game").html("ゲーム");
        $(".player").html("プレイヤー");
        $(".players").html("プレイヤー");
        $(".difficulty").html("難易度");
        $(".shottype").html("キャラ");
        $(".route").html("ルート");
        $(".date").html("日付");
        $(".dates").html("日付");
        $(".total").html(page == "wr" ? "合計" : "総計");
        $(".overall").html(page == "wr" ? "WR一覧" : "合計");
        $(".world").html("世界");
        $(".west").html("海外");
        $(".percentage").html("割合");
        $(".nooflnns").html("LNNの数");
        $(".nooflnnus").html("LNNの数");
        $(".nooflnnns").html("LNNNの数");
        $(".nooflnnfss").html("LNNFSの数");
        $(".nooflnnnns").html("LNNNNの数");
        $(".different").html("（プレイヤー）");
        $(".all").html("（全）");
    } else {
        $(".game").html("Game");
        $(".player").html("Player");
        $(".players").html("Players");
        $(".difficulty").html("Difficulty");
        $(".shottype").html("Shottype");
        $(".route").html("Route");
        $(".date").html("Date");
        $(".dates").html("Dates");
        $(".total").html("Total");
        $(".overall").html("Overall");
        $(".world").html("World");
        $(".west").html("West");
        $(".percentage").html("Percentage");
        $(".nooflnns").html("No. of LNNs");
        $(".nooflnnus").html("No. of LNN(N)s");
        $(".nooflnnns").html("No. of LNNNs");
        $(".nooflnnfss").html("No. of LNNFSs");
        $(".nooflnnnns").html("No. of LNNNNs");
        $(".different").html("(Different players)");
        $(".all").html("(All)");
    }
}

function generateShortNames() {
    if (language == "Chinese") {
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
        $(".UM").html("虹");
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
        $(".UM").html("虹");
    } else {
        $(".SoEW").html("SoEW");
        $(".PoDD").html("PoDD");
        $(".LLS").html("LLS");
        $(".MS").html("MS");
        $(".EoSD").html("EoSD");
        $(".PCB").html("PCB");
        $(".IN").html("IN");
        $(".MoF").html("MoF");
        $(".PoFV").html("PoFV");
        $(".SA").html("SA");
        $(".UFO").html("UFO");
        $(".DS").html("DS");
        $(".GFW").html("GFW");
        $(".TD").html("TD");
        $(".DDC").html("DDC");
        $(".LoLK").html("LoLK");
        $(".HSiFS").html("HSiFS");
        $(".WBaWC").html("WBaWC");
        $(".UM").html("UM");
    }
}
function generateFullNames() {
    if (language == "Chinese") {
        $(".HRtPf").html("东方灵异传　～ Highly Responsive to Prayers");
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
        $(".UMf").html("东方虹龙洞　～ Unconnected Marketeers");
    } else if (language == "Japanese") {
        $(".HRtPf").html("東方靈異伝　～ Highly Responsive to Prayers");
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
        $(".UMf").html("東方虹龍洞　～ Unconnected Marketeers");
    } else {
        $(".HRtPf").html("Touhou 1 - Highly Responsive to Prayers");
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
        $(".UMf").html("Touhou 18 - Unconnected Marketeers");
    }
}
function generateShottypes() {
    if (language == "Chinese") {
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
        $(".Seasons").html("季節");
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
    } else if (language == "Japanese") {
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
        $(".Seasons").html("時期");
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
    } else {
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
        $(".Seasons").html("Seasons");
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
    }
}
