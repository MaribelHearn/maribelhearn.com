var WRs, step, global = this, phantasm = true, noExtra = true, noShottypes = true, dsActive = true, language = "English", DIFFICULTY = "#difficulty", CHALLENGE = "#challenge",
    PHANTASMAGORIA = "#phantasmagoriaTable", RUBRICS = "#rubrics", BOMBS = "#bombs", SCORE = "#score", PERFORMANCE = "#performance", DRCPOINTS = "#drcpoints", ERROR = "#error",
    SHOTTYPE = "#shottype", NOTIFY = "#notify", RUBRICS_BUTTON = "#rubricsButton", NB = "#nb", MISSES = "#misses", IMP_NOT = "#impNot", IMP_NOT_TEXT = "#impNotText",
    NO_EXTRA = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>", SHOTTYPE_MULTIPLIERS = "#shottypeMultipliersTable",
    DIFF_OPTIONS = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option>", LS = "#ls", IS = "#is",
    PHANTASM = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option><option>Phantasm</option>",
    SHOTTYPE_LABEL = "#shottypeLabel", MISSES_INPUT = "<label id='missesLabel' for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100>",
    SCORING_TABLE = "#scoringTable", SURV_TABLE = "#survivalTable", RUBRICS_TABLES = "#rubricsTables", CLEARED = "#cleared", SCENE = "#scene", POFV_FORMULA = "#pofvFormula",
    ROUTE = "#route", SCORE_OPTIONS = "<label id='scoreLabel' for='score'>Score</label><input id='score' type='text'>", DS_TABLE = "#dsTable", MOF_TABLE = "#mofTable",
    RELEASES = "#releases", SEASON = "#season", SPRING = "#spring", SUMMER = "#summer", AUTUMN = "#autumn", WINTER = "#winter", HRTP = "#hrtp", SOEW = "#soew", PODD = "#podd",
    LLS = "#lls", MS = "#ms", EOSD = "#eosd", PCB = "#pcb", IN = "#in", POFV = "#pofv", MOF = "#mof", SA = "#sa", UFO = "#ufo", GFW = "#gfw", TD = "#td", DDC = "#ddc",
    LOLK = "#lolk", HSIFS = "#hsifs", MISSES_LABEL = "#missesLabel", BOMBS_LABEL = "#bombsLabel", NB_LABEL = "#nbLabel", DIFFICULTY_LABEL = "#difficultyLabel",
    RELEASES_LABEL = "#releasesLabel", SURVIVAL = "#survival", SCORING = "#scoring", IS_LABEL = "#isLabel", LS_LABEL = "#lsLabel", SCORE_LABEL = "#scoreLabel",
    FINALA = "#finala", FINALB = "#finalb", SCORING_COLUMN = "<th id='game0'>Game</th><th id='maxPoints0'>Max points</th><th id='exp0'>Exponent</th>", BB_LABEL = "#bbLabel",
    SURV_COLUMN = "<th id='game2'>Game</th><th id='maxPoints1'>Max points</th><th id='base0'>Base</th><th id='lostLife'>Lost life (n)</th><th id='firstBomb'>" +
    "First bomb (n)</th><th id='further'>Further bombs (n)</th>", FIRST_BOMB = "#firstBomb", FURTHER = "#further", LOST_LIFE = "#lostLife", POFV_SURV = "#phantasmagoria",
    POFV_SURV_DESC = "#phantasmagoriaDesc", MOFAITH = "#mountainOfFaith", MOFAITH_DESC = "#mountainOfFaithDesc", SHOT_MULT = "#shottypeMultipliers",RULES_TEXT = "#rulesText",
    SHOT_MULT_DESC = "#shotMultDesc", BASE_POINTS = "#basePoints", MULTIPLIEDSHOTTYPE = "#multipliedShottype", MULTIPLIER = "#multiplier", MAX_POINTS = "#maxPoints",
    BASE = "#base", EXP = "#exp", WR = "#wr", SCORE_TEXT = "#scoreText", MIN_POINTS = "#minPoints", NB_BONUS = "#nbBonus", POINTS_CALCULATOR = "#pointsCalculator",
    RUBRICS_TEXT = "#rubricsText", ACK_TEXT = "#ackText", DRC_INTRO = "#drcIntro", CATEGORY = "#category", BACK_TO_TOP = "#backToTop", SCORE_FORMULA = "#scoreFormula",
    DRC_INTRO_PTS = "#drcIntroPts", DRC_SCORES = "#drcScores", RUBRICS_EXPL = "#rubricsExpl", SCORING_NOTES = "#scoringNotes", SURV_NOTES = "#survivalNotes",
    NEW_WR = "#newWR", MOF_SEPARATE = "#mofSeparate", MAINGAME = "#maingame", PHANTASMAGORIA_SEPARATE = "#phantasmagoriaSeparate", THRESHOLD = "#threshold",
    INCREMENTS = "#increments", IN_LS = "#inLS", HSIFS_RELEASES = "#hsifsReleases", CALCULATE = "#calculate", MAX_LIVES = "#maxLives", SURV_FORMULA = "#survFormula",
    JP_TL_CREDIT = "#jptlcredit", CN_TL_CREDIT = "#cntlcredit", COUNTDOWN = "#countdown", NO_CHARGE_LABEL = "#ncLabel", RULE1 = "#rule1", RULE2 = "#rule2", RULE3 = "#rule3",
    DS_SEPARATE = "#dsSeparate", DOUBLE_SPOILER = "#doubleSpoiler", DOUBLE_SPOILER_DESC = "#doubleSpoilerDesc", DS_TABLE = "#dsTable", DS = "#ds", GAME = "#game", BB = "#bb",
    // HRTP_SCORING = "#hrtpScoring", HRTP_SCORING_DESC = "#hrtpScoringDesc", HRTP_TABLE = "#hrtpTable", HRTP_SEPARATE = "#hrtpSeparate",
    Rubrics;
    
$(document).ready(function() {
    $.get("../json/wrlist.json", function(data) {
        WRs = data;
    
        $.get("../json/rubrics.json", function(data) {
            Rubrics = data;
            
            generateText(true);
            checkValues(true, true, true);
            generateRubrics();
            $(POFV_FORMULA).attr("colspan", 4);
            
            if (getCookie("lang") == "Japanese") {
                language = "Japanese";
                generateText(false);
            } else if (getCookie("lang") == "Chinese") {
                language = "Chinese";
                generateText(false);
            }
        }, "json");
              
    }, "json");
    
    step = setInterval(updateCountdown, 1000);
    updateCountdown();
});

function updateCountdown() {
    var countdownDate, now, distance, days, hours, minutes, seconds;
    
    countdownDate = Date.UTC("2018", "9", "18", "14", "30", "0");
    now = new Date().getTime();
    distance = countdownDate - now;
    days = Math.floor(distance / (1000 * 60 * 60 * 24));
    hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor((distance % (1000 * 60)) / 1000);
    $(COUNTDOWN).html("DRC End<br>" + days + translate("d ") + hours + translate("h ") + minutes + translate("m ") + seconds + translate("s"));
    
    if (distance < 0) {
        $(COUNTDOWN).html("");
        clearInterval(step);
    }
}

function translateCharName(charName) {
    if (language == "English") {
        return charName.replace("Team", " Team");
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
            "C2": "B2",
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
            "CirnoWinter": "チルノ冬",
            "AyaWinter": "文冬"
        }[charName]);
    } else {
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
            "C2": "B2",
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
            "CirnoWinter": "琪露诺冬",
            "AyaWinter": "文冬"
        }[charName]);
    }
}

function translateGameName(game) {
    if (language == "English") {
        return game;
    } else if (language == "Japanese") {
        game = game.trim();
        
        return ({
            "HRtP": "靈",
            "SoEW": "封",
            "PoDD": "夢",
            "LLS": "幻",
            "MS": "怪",
            "EoSD": "紅",
            "PCB": "妖",
            "IN": "永",
            "PoFV": "花",
            "MoF": "風",
            "SA": "地",
            "UFO": "星",
            "DS": "DS",
            "GFW": "大",
            "TD": "神",
            "DDC": "輝",
            "LoLK": "紺",
            "HSiFS": "天"
        }[game]);
    } else {
        game = game.trim();
        
        return ({
            "HRtP": "灵",
            "SoEW": "封",
            "PoDD": "梦",
            "LLS": "幻",
            "MS": "怪",
            "EoSD": "红",
            "PCB": "妖",
            "IN": "永",
            "PoFV": "花",
            "MoF": "风",
            "SA": "地",
            "UFO": "星",
            "DS": "DS",
            "GFW": "大",
            "TD": "神",
            "DDC": "辉",
            "LoLK": "绀",
            "HSiFS": "天"
        }[game]);
    }
}

function generateText(firstTime) {
    var numberOfShottypes = $(SHOTTYPE + " option").length, i;
    
    if (language == "English") {
        $(HRTP).html("HRtP");
        $(SOEW).html("SoEW");
        $(PODD).html("PoDD");
        $(LLS).html("LLS");
        $(MS).html("MS");
        $(EOSD).html("EoSD");
        $(PCB).html("PCB");
        $(IN).html("IN");
        $(POFV).html("PoFV");
        $(MOF).html("MoF");
        $(SA).html("SA");
        $(UFO).html("UFO");
        $(DS).html("DS");
        $(GFW).html("GFW");
        $(TD).html("TD");
        $(DDC).html("DDC");
        $(LOLK).html("LoLK");
        $(HSIFS).html("HSiFS");
        $(SPRING).html("Spring");
        $(SUMMER).html("Summer");
        $(AUTUMN).html("Autumn");
        $(WINTER).html("Winter");
        $(CATEGORY).html("Category");
        $(DIFFICULTY_LABEL).html("Difficulty");
        $(FINALA).html("FinalA");
        $(FINALB).html("FinalB");
        $(SCORE_LABEL).html("Score");
        $(SHOTTYPE_LABEL).html("Shottype");
        $(MISSES_LABEL).html("Misses");
        $(BOMBS_LABEL).html("Bombs");
        $(POINTS_CALCULATOR).html("Points Calculator");
        $(RULES_TEXT).html("Rules");
        $(RUBRICS_TEXT).html("Rubrics");
        $(ACK_TEXT).html("Acknowledgements");
        $(BACK_TO_TOP).html("Back to Top");
        game = $(GAME).val();
        
        if (game) {
            if (game == "TD") {
                $(BOMBS_LABEL).html("Bombs / Trances");
            } else if (game == "HRtP" || game == "GFW") {
                $(SHOTTYPE_LABEL).html("Route");
            }
        }
        
        for (i = 0; i < 2; i++) {
            $(SURVIVAL + i).html("Survival");
            $(SCORING + i).html("Scoring");
        }
        
        $(RULE1).html("No cheating by using external programs or modifying the game FPS.");
        $(RULE2).html("Replays are required for Windows game submissions, while for PC-98 a video or screenshot is accepted.");
        $(RULE3).html("All runs must be played using default lives and bombs.");
        $(NB_LABEL).html("No Bomb");
        $(NO_CHARGE_LABEL).html("No Charge Attacks");
        $(IS_LABEL).html("Imperishable Shooting Captured");
        $(LS_LABEL).html("Last Spells Captured");
        $(RELEASES_LABEL).html("Releases");
        $(DRCPOINTS).html($(DRCPOINTS).html().replace("DRCポイント: ", "Your DRC points for this run: ").replace("本轮DRC得分：", "Your DRC points for this run: "));
        
        if ($(RUBRICS_BUTTON).val() == "Show Rubrics" || $(RUBRICS_BUTTON).val() == "ルーブリックを見せて" || $(RUBRICS_BUTTON).val() == "显示计算公式") {
            $(RUBRICS_BUTTON).val("Show Rubrics");
        } else {
            $(RUBRICS_BUTTON).val("Hide Rubrics");
        }
        
        $(CALCULATE).val("Calculate");
        $(SCORING_NOTES).html("Scoring Notes");
        $(SURV_NOTES).html("Survival Notes");
        $(NEW_WR).html("If you achieve a new World Record, your points are equal to the max points; otherwise, the formula applies.");
        //$(HRTP_SEPARATE).html("HRtP uses a separate system. <a href='#hrtpScoring'>Click here</a> for said system.");
        $(MOF_SEPARATE).html("MoF uses a separate system. <a href='#mountainOfFaith'>Click here</a> for said system.");
        $(DS_SEPARATE).html("DS uses a separate system. <a href='#doubleSpoiler'>Click here</a> for said system.");
        $(MAINGAME).html("For a main game clear, a shottype multiplier is applied to your DRC points, the result of which is again rounded. " +
        "<a href='#shottypeMultipliers'>Click here</a> for the list of them.");
        $(PHANTASMAGORIA_SEPARATE).html("The Phantasmagorias use a separate system. <a href='#phantasmagoria'>Click here</a> for said system.");
        $(IN_LS).html("For IN, you obtain 2 (1 on Easy) additional points for each captured Last Spell, with the exception of Imperishable Shooting, which yields 5 points.");
        $(HSIFS_RELEASES).html("For HSiFS, the first release adds 2 to <em>n</em>, and further releases add 0.5, 0.4, 0.3, 0.2, 0.1 to <em>n</em>.");
        //$(HRTP_SCORING).html("HRtP Scoring");
        //$(HRTP_SCORING_DESC).html("For each difficulty there is a threshold, at which you will have the base points. " +
        //"Then, increments are done, dependent on how much higher than the threshold your score is.");
        $(MOFAITH).html("MoF Scoring");
        $(MOFAITH_DESC).html("For each difficulty and shottype there are six thresholds, at which you will have set numbers of points respectively. " +
        "Then, increments are done, dependent on how much higher than the threshold your score is. The maximum is 375 on Easy and 500 on Lunatic.");
        $(DOUBLE_SPOILER).html("DS Scoring");
        $(DOUBLE_SPOILER_DESC).html("For each scene there are three thresholds, at which you will have set numbers of points points respectively. " +
        "Then, increments are done, dependent on how much higher than the threshold your score is.");
        $(POFV_SURV).html("PoDD & PoFV Survival");
        $(POFV_SURV_DESC).html("In the below formula, MaxLives is equal to 5 for PoDD, 7 for PoFV main game and 8 for PoFV Extra. " +
        "NoBombBonus is a difficulty-specific No Bomb bonus for PoDD and a No Charge Attacks bonus for PoFV. RoundsLost is equal to how many rounds the player lost.");
        $(SHOT_MULT).html("Shottype Multipliers");
        $(SHOT_MULT_DESC).html("These are applied to the result of the survival formula for a main game run only; they do <em>not</em> apply for Extra, " +
        "nor do they apply for HSiFS runs that use releases. For all shots not listed here, the shottype multipliers are equal to 1.");
        $(SCORE_FORMULA).html("||Max * (Score / WR) ^ Exp||");
        $(SURV_FORMULA).html("||Max * (Base ^ -n)||");
        $(POFV_FORMULA).html("||Max - ((Max - Min) / MaxLives * RoundsLost)|| + NoBombBonus");
        
        for (i = 0; i < numberOfShottypes; i++) {
            $(SHOTTYPE + i).html($(SHOTTYPE + i).val().replace("Team", " Team"));
        }
        
        if (!firstTime) {
            $(IMP_NOT).html("Important Notice:");
            $(IMP_NOT_TEXT + "0").html("usage of the MarisaB damage bug is BANNED in survival.");
            $(IMP_NOT_TEXT + "1").html("<em>manual</em> trances count as bombs (that is, trances from pressing C).");
            $(IMP_NOT_TEXT + "2").html("border breaks count as bombs <em>even if they are accidental</em>.");
            generateRubrics();
        }
        
        $(DRC_INTRO).html("The <b>Dodging Rain Competition (DRC)</b> is a Touhou game competition that was invented by " +
        "<a href='https://twitter.com/VincentZeem'>ZM</a> and is held on <a href='https://discord.gg/Ucae3Uf'>the official DRC Discord</a>. " +
        "Two teams go up against each other in several different categories. Each player posts an arbitrarily long list of categories, ordered by preference, " +
        "which can be either survival or scoring of any Touhou shooting game and any difficulty. They will be matched up against a player from the other team, " +
        "in a category that both players had on their list. The teams and categories are determined by the DRC management team. Players are given two weeks to " +
        "sign up for the competition, and once it starts, two weeks to submit a replay, which will be awarded points dependent on the rubrics. " +
        "Runs done outside those two weeks are invalid. Players can submit an unlimited number of replays; the replay that is worth the most DRC points will count.");
        $(DRC_INTRO_PTS).html("If you want to know how many DRC points a run is worth, the points for a given run can be determined using the calculator below.");
        $(DRC_SCORES).html("Scores can only contain digits, commas, dots and spaces. Survival runs are assumed to have cleared, scoring runs not.");
        $(RUBRICS_EXPL).html("The rubrics are the formulas and fixed values used to calculate the number of DRC points for a run. " +
        "If you are curious about how your points are being determined, click the button below to expand.");
        $(JP_TL_CREDIT).html("The Japanese translation was done by <a href='https://twitter.com/7bitm'>7bitm</a> and " +
        "<a href='https://twitter.com/toho_yumiya'>Yu-miya</a>.");
        $(CN_TL_CREDIT).html("The Simplified Chinese translation was done by <a href='https://twitter.com/IzayoiMeirin'>Cero</a>, " +
        "<a href='https://twitter.com/CrestedPeak9'>CrestedPeak9</a> and <a href='https://twitter.com/Cerasis_th'>Cerasis</a>.");
    } else if (language == "Japanese") {
        $(HRTP).html(translateGameName("HRtP"));
        $(SOEW).html(translateGameName("SoEW"));
        $(PODD).html(translateGameName("PoDD"));
        $(LLS).html(translateGameName("LLS"));
        $(MS).html(translateGameName("MS"));
        $(EOSD).html(translateGameName("EoSD"));
        $(PCB).html(translateGameName("PCB"));
        $(IN).html(translateGameName("IN"));
        $(POFV).html(translateGameName("PoFV"));
        $(MOF).html(translateGameName("MoF"));
        $(SA).html(translateGameName("SA"));
        $(UFO).html(translateGameName("UFO"));
        $(GFW).html(translateGameName("GFW"));
        $(TD).html(translateGameName("TD"));
        $(DDC).html(translateGameName("DDC"));
        $(LOLK).html(translateGameName("LoLK"));
        $(HSIFS).html(translateGameName("HSiFS"));
        $(SPRING).html(translateCharName("Spring"));
        $(SUMMER).html(translateCharName("Summer"));
        $(AUTUMN).html(translateCharName("Autumn"));
        $(WINTER).html(translateCharName("Winter"));
        $(CATEGORY).html("カテゴリー");
        $(DIFFICULTY_LABEL).html("難易度");
        $(FINALA).html("Aルート");
        $(FINALB).html("Bルート");
        $(SCORE_LABEL).html("スコア");
        $(SHOTTYPE_LABEL).html("キャラ");
        $(MISSES_LABEL).html("ミス");
        $(BOMBS_LABEL).html("ボム");
        $(POINTS_CALCULATOR).html("ポイント計算機");
        $(RULES_TEXT).html("規定");
        $(RUBRICS_TEXT).html("ルーブリック");
        $(ACK_TEXT).html("謝辞");
        $(BACK_TO_TOP).html("上に帰る");
        game = $(GAME).val();
        
        if (game) {
            if (game == "PCB") {
                $(BOMBS_LABEL).html("ボム / 霊撃");
            } else if (game == "TD") {
                $(BOMBS_LABEL).html("ボム / トランス");
            } else if (game == "HRtP" || game == "GFW") {
                $(SHOTTYPE_LABEL).html("ルート");
            }
        }
        
        for (i = 0; i < 2; i++) {
            $(SURVIVAL + i).html("クリア重視");
            $(SCORING + i).html("稼ぎ");
        }
        
        $(RULE1).html("外部ツールを用いたチート行為やゲームのFPSを変更することを禁止します。");
        $(RULE2).html("Windows版作品の登録にはリプレイが必要です。PC-98版作品においては録画ファイルまたはスクリーンショットにて受け付け可能です。");
        $(RULE3).html("全てのプレイにおいて、初期残機、初期ボム数でのプレイが必須です。");
        $(NB_LABEL).html("ノーボム");
        $(NO_CHARGE_LABEL).html("ノーチャージ攻撃");
        $(IS_LABEL).html("「インペリシャブルシューティング」取得");
        $(LS_LABEL).html("ラストスペル取得");
        $(RELEASES_LABEL).html("解放");
        $(DRCPOINTS).html($(DRCPOINTS).html().replace("Your DRC points for this run: ", translate("Your DRC points for this run: ")).replace("本轮DRC得分：", translate("Your DRC points for this run: ") + " "));
        
        if ($(RUBRICS_BUTTON).val() == "Show Rubrics" || $(RUBRICS_BUTTON).val() == "显示计算公式") {
            $(RUBRICS_BUTTON).val(translate("Show Rubrics"));
        } else {
            $(RUBRICS_BUTTON).val(translate("Hide Rubrics"));
        }
        
        $(CALCULATE).val("計算する");
        $(SCORING_NOTES).html("稼ぎのノート");
        $(SURV_NOTES).html("クリア重視のノート");
        $(NEW_WR).html("もし新世界記録を達成すれば、あなたのポイントは最高点になります。そうでなければ式を適用します。");
        //$(HRTP_SEPARATE).html("東方靈異伝では別のシステムを使います。そのシステムは<a href='#hrtpScoring'>>ここをクリック</a>。");
        $(MOF_SEPARATE).html("東方風神録では別のシステムを使います。そのシステムは<a href='#mountainOfFaith'>ここをクリック</a>。");
        $(DS_SEPARATE).html("ダブルスポイラーでは別のシステムを使います。そのシステムは<a href='#doubleSpoiler'>ここをクリック</a>。");
        $(MAINGAME).html("本編クリアではキャラ倍率がDRCポイントに掛けられます。その結果は四捨五入されます。キャラ倍率のリストは<a href='#shottypeMultipliers'>ここをクリック</a>。");
        $(PHANTASMAGORIA_SEPARATE).html("東方夢時空と東方花映塚では別のシステムを使います。その方式は<a href='#phantasmagoria'>ここをクリック</a>。");
        $(IN_LS).html("東方永夜抄ではラストスペルを取得する度に２点（Easyのみ１点）の追加点を得ます。「インペリシャブルシューティング」の追加点は５点とします。");
        $(HSIFS_RELEASES).html("東方天空璋では、最初の季節解放は２ボム扱い、以降の解放は０.５、０.４、０.３、０.２、０.１ボム扱いとします。");
        //$(HRTP_SCORING).html("東方靈異伝の稼ぎ");
        //$(HRTP_SCORING_DESC).html("各難易度で閾値があり、それぞれで点数を設定しています。その後、あなたのスコアがどれだけ閾値より高いかに基づき増分します。");
        $(MOFAITH).html("東方風神録の稼ぎ");
        $(MOFAITH_DESC).html("各難易度各機体で６つの閾値があり、それぞれで点数を設定しています。その後、あなたのスコアがどれだけ閾値より高いかに基づき増分します。Easyの最大点は375です。Lunaticの最大点は500です。");
        $(DOUBLE_SPOILER).html("ダブルスポイラーの稼ぎ");
        $(DOUBLE_SPOILER_DESC).html("各撮影対象各機体で3つの閾値があり、それぞれで点数を設定しています。その後、あなたのスコアがどれだけ閾値より高いかに基づき増分します。");
        $(POFV_SURV).html("東方夢時空と東方花映塚のクリア重視");
        $(POFV_SURV_DESC).html("下式において、最大残機を夢時空で５、花映塚本編で７、花映塚エキストラでは８です。" +
        "ノーボムボーナスは難易度ごとに変わる、夢時空でのボムの不使用ボーナスと花映塚の（Ｃ１含む）チャージ攻撃の不使用ボーナスです。");
        $(SHOT_MULT).html("キャラ倍率");
        $(SHOT_MULT_DESC).html("これらは本編のクリア重視プレイの結果にのみ適用されます。Extraでは適用されません。" +
        "解放を使用した天空璋のプレイにも適用されません。ここに載っていない機体のキャラ倍率は１となります。");
        $(SCORE_FORMULA).html("||最大点 * (スコア / 世界記録) ^ 冪指数||");
        $(SURV_FORMULA).html("||最大点 * (底 ^ -n)||");
        $(POFV_FORMULA).html("||最大点 - ((最大点 - 最小点) / 最大残機 * 敗北数)|| + ノーボムボーナス");
        
        for (i = 0; i < numberOfShottypes; i++) {
            $(SHOTTYPE + i).html(translateCharName($(SHOTTYPE + i).val()));
        }
        
        generateRubrics();
        $(IMP_NOT).html("重要通知:");
        $(IMP_NOT_TEXT + "0").html("魔理沙Bのバグを使ってはいけまでん。");
        $(IMP_NOT_TEXT + "1").html("Cキー押下による手動トランスはボムとして扱います。");
        $(IMP_NOT_TEXT + "2").html("霊撃は偶発的なものであってもボムとして扱います。");
        $(LOST_LIFE).html("ミス (n)");
        $(FIRST_BOMB).html("第一ボム (n)");
        $(FURTHER).html("ボム (n)");
        $(MULTIPLIEDSHOTTYPE).html("キャラ");
        $(MULTIPLIER).html("倍率");
        $(WR).html("世界記録");
        $(SCORE_TEXT).html("スコア");
        $(MIN_POINTS).html("最小点");
        $(NB_BONUS).html("ノーボムボーナス");
        
        for (i = 0; i < 2; i++) {
            $(BASE + i).html("底");
        }
        
        for (i = 0; i < 2; i++) {
            $(EXP + i).html("冪指数");
        }
        
        for (i = 0; i < 3; i++) {
            $(GAME + i).html("ゲーム");
        }
        
        for (i = 0; i < 8; i++) {
            $(BASE_POINTS + i).html("素点");
        }
        
        for (i = 0; i < 9; i++) {
            $(MAX_POINTS + i).html("最大点");
        }
        
        for (i = 0; i < 8; i++) {
            $(THRESHOLD + i).html("閾値");
        }
        
        $(THRESHOLD + "8").html("閾値1");
        $(THRESHOLD + "9").html("閾値2");
        $(THRESHOLD + "10").html("閾値3");
        
        for (i = 0; i < 11; i++) {
            $(INCREMENTS + i).html("増加");
        }
        
        $(DRC_INTRO).html("<b>Dodging Rain Competition(DRC)</b>は<a href='https://twitter.com/VincentZeem'>ZM</a>により考案された" +
        "<a href='https://discord.gg/Ucae3Uf'>DRC Discord</a>で開かれる東方projectの定期大会です。" +
        "２つのチームが幾つかのカテゴリーで競争します。各プレイヤーは希望順に並べたカテゴリーのリストを作ります。" +
        "カテゴリーは東方STGゲームの任意の難易度での「クリア重視」と「スコアアタック（稼ぎ）」のどちらかを選ぶことができます。" +
        "相手チームのプレイヤーと、共通してリストされていた１つのカテゴリーで、マッチングされます。このチームとカテゴリーはDRC運営陣によって決められます。" +
        "プレイヤーには大会登録のために２週間が与えられます。そして大会が始まり、リプレイ提出のための２週間が与えられます。" +
        "その後ルーブリックに基づいてポイントが授与されます。この２週間以外でのプレイは無効です。" +
        "プレイヤーは無制限にリプレイを登録することが出来ますが、DRCポイントが最高であるリプレイのみが採用されます。");
        $(DRC_INTRO_PTS).html("リプレイにどれだけDRCポイントが貰えるか知りたいならば、下の計算機を使うことが出来ます。");
        $(DRC_SCORES).html("スコアは桁、カンマ、ドット、スペースを含めることができます。クリア重視ではクリアする必要があります。稼ぎではクリアしなくてもよいです。");
        $(RUBRICS_EXPL).html("ルーブリックとはプレイのDRCポイントを計算するために使用される式および固定数のことです。" +
        "ポイントの決定方法を知りたい場合は、下のボタンをクリックして展開して下さい。");
        $(JP_TL_CREDIT).html("<a href='https://twitter.com/7bitm'>7bitm</a>と" +
        "<a href='https://twitter.com/toho_yumiya'>ゆーみや</a>によって日本語に翻訳されました。");
        $(CN_TL_CREDIT).html("<a href='https://twitter.com/IzayoiMeirin'>Cero</a>と<a href='https://twitter.com/CrestedPeak9'>CrestedPeak9</a>" +
        "と<a href='https://twitter.com/Cerasis_th'>Cerasis</a>によって中国語に翻訳されました。");
    } else {
        $(HRTP).html(translateGameName("HRtP"));
        $(SOEW).html(translateGameName("SoEW"));
        $(PODD).html(translateGameName("PoDD"));
        $(LLS).html(translateGameName("LLS"));
        $(MS).html(translateGameName("MS"));
        $(EOSD).html(translateGameName("EoSD"));
        $(PCB).html(translateGameName("PCB"));
        $(IN).html(translateGameName("IN"));
        $(POFV).html(translateGameName("PoFV"));
        $(MOF).html(translateGameName("MoF"));
        $(SA).html(translateGameName("SA"));
        $(UFO).html(translateGameName("UFO"));
        $(GFW).html(translateGameName("GFW"));
        $(TD).html(translateGameName("TD"));
        $(DDC).html(translateGameName("DDC"));
        $(LOLK).html(translateGameName("LoLK"));
        $(HSIFS).html(translateGameName("HSiFS"));
        $(SPRING).html(translateCharName("Spring"));
        $(SUMMER).html(translateCharName("Summer"));
        $(AUTUMN).html(translateCharName("Autumn"));
        $(WINTER).html(translateCharName("Winter"));
        $(CATEGORY).html("项目");
        $(DIFFICULTY_LABEL).html("难度");
        $(FINALA).html("路线A");
        $(FINALB).html("路线B");
        $(SCORE_LABEL).html("分数");
        $(SHOTTYPE_LABEL).html("机体");
        $(MISSES_LABEL).html("被弹数");
        $(BOMBS_LABEL).html("扔雷数");
        $(POINTS_CALCULATOR).html("得分计算器");
        $(RULES_TEXT).html("规则");
        $(RUBRICS_TEXT).html("计算公式");
        $(ACK_TEXT).html("致谢");
        $(BACK_TO_TOP).html("回到顶部");
        game = $(GAME).val();
        
        if (game) {
            if (game == "PCB") {
                $(BOMBS_LABEL).html("扔雷数/灵击数");
            } else if (game == "TD") {
                $(BOMBS_LABEL).html("扔雷数/灵界数");
            } else if (game == "HRtP" || game == "GFW") {
                $(SHOTTYPE_LABEL).html("路线");
            }
        }
        
        for (i = 0; i < 2; i++) {
            $(SURVIVAL + i).html("生存");
            $(SCORING + i).html("打分");
        }
        
        $(RULE1).html("禁止通过使用内置程序或修改游戏帧数作弊。");
        $(RULE2).html("windows平台游戏需要提交rep；PC98平台游戏可提交视频或截图。");
        $(RULE3).html("所有游戏必须在默认残机数、bomb数的情况下进行。");
        $(NB_LABEL).html("禁雷");
        $(NO_CHARGE_LABEL).html("NC");
        $(IS_LABEL).html("【不朽的弹幕】收取");
        $(LS_LABEL).html("LSC收取数");
        $(RELEASES_LABEL).html("季节解放数");
        $(DRCPOINTS).html($(DRCPOINTS).html().replace("Your DRC points for this run: ", translate("Your DRC points for this run: ")).replace("DRCポイント: ", translate("Your DRC points for this run: ")));
        
        if ($(RUBRICS_BUTTON).val() == "Show Rubrics" || $(RUBRICS_BUTTON).val() == "ルーブリックを見せて") {
            $(RUBRICS_BUTTON).val(translate("Show Rubrics"));
        } else {
            $(RUBRICS_BUTTON).val(translate("Hide Rubrics"));
        }
        
        $(CALCULATE).val("计算");
        $(SCORING_NOTES).html("打分简介");
        $(SURV_NOTES).html("生存简介");
        $(NEW_WR).html("如果获得新世界纪录，你的分数即为最大值。否则，则按公式计算。");
        //$(HRTP_SEPARATE).html("东方灵异传采用单独的计分方式。<a href='#hrtpScoring'>单击此处</a>以获取系统介绍。");
        $(MOF_SEPARATE).html("东方风神录采用单独的计分方式。<a href='#mountainOfFaith'>单击此处</a>以获取系统介绍。");
        $(DS_SEPARATE).html("对抗新闻采用单独的计分方式。<a href='#doubleSpoiler'>单击此处</a>以获取系统介绍。");
        $(MAINGAME).html("当完成一项游戏，机体系数会影响DRC总分，结果会再次近似。<a href='#shottypeMultipliers'>单击此处</a>查看列表。");
        $(PHANTASMAGORIA_SEPARATE).html("东方梦时空和东方花映塚关卡采用单独的计分方式。<a href='#phantasmagoria'>单击此处</a>以获取系统介绍。");
        $(IN_LS).html("对于永夜抄，每收取一张LSC，则获得额外的2分（Easy难度为1分）。收取【不朽的弹幕】获得5分。");
        $(HSIFS_RELEASES).html("对于东方天空璋，初次季节解放则n+2，之后的季节释放n+0.5，0.4，0.3，0.2，0.1。");
        //$(HRTP_SCORING).html("东方灵异传打分");
        //$(HRTP_SCORING_DESC).html("对于每个难度有一个阈值，在每个阈值内有各自的得分系数且分数增量固定，仅取决于你的游戏内得分。");
        $(MOFAITH).html("东方风神录打分");
        $(MOFAITH_DESC).html("对于每个难度和机体有六个阈值，在每个阈值内有各自的得分系数且分数增量固定，仅取决于你的游戏内得分。Easy最大值是375。Lunatic最大值是500。");
        $(DOUBLE_SPOILER).html("对抗新闻打分");
        $(DOUBLE_SPOILER_DESC).html("对于每个场景和机体有三个阈值，在每个阈值内有各自的得分系数且分数增量固定，仅取决于你的游戏内得分。");
        $(POFV_SURV).html("东方梦时空和东方花映塚生存");
        $(POFV_SURV_DESC).html("在以下公式中，东方梦时空的最大残机数为5，东方花映塚故事模式为7，EX为8。NB奖分依难度而定。东方梦时空为NB奖分，东方花映塚为NC奖分。");
        $(SHOT_MULT).html("机体系数");
        $(SHOT_MULT_DESC).html("该要素仅适用于生存项目的计算公式，不适用于EX和使用了季节解放的天空璋。未列出的机体，系数均为1。");
        $(SCORE_FORMULA).html("||最大值 *（得分 / 世界纪录）^ 指数||");
        $(SURV_FORMULA).html("||最大值 *（基数 ^ -n）||");
        $(POFV_FORMULA).html("||最大值 -最大值 - 最小值） / 最大残机 * 败北数）|| + NB奖分");
        
        for (i = 0; i < numberOfShottypes; i++) {
            $(SHOTTYPE + i).html(translateCharName($(SHOTTYPE + i).val()));
        }
        
        generateRubrics();
        $(IMP_NOT).html("重要提示：");
        $(IMP_NOT_TEXT + "0").html("生存向 弑神炮禁止。");
        $(IMP_NOT_TEXT + "1").html("主动灵界视作扔雷。");
        $(IMP_NOT_TEXT + "2").html("灵击视作扔雷，无论是否被弹灵击。");
        $(LOST_LIFE).html("被弹（n）");
        $(FIRST_BOMB).html("第一次扔雷（n）");
        $(FURTHER).html("扔雷（从第二次扔雷开始）（n）");
        $(MULTIPLIEDSHOTTYPE).html("机体");
        $(MULTIPLIER).html("系数");
        $(WR).html("世界纪录");
        $(SCORE_TEXT).html("分数");
        $(MIN_POINTS).html("最小值");
        $(NB_BONUS).html("NB奖分");
        
        for (i = 0; i < 2; i++) {
            $(BASE + i).html("基数");
        }
        
        for (i = 0; i < 2; i++) {
            $(EXP + i).html("指数");
        }
        
        for (i = 0; i < 3; i++) {
            $(GAME + i).html("游戏");
        }
        
        for (i = 0; i < 8; i++) {
            $(BASE_POINTS + i).html("基数分");
        }
        
        for (i = 0; i < 9; i++) {
            $(MAX_POINTS + i).html("最大值");
        }
        
        for (i = 0; i < 8; i++) {
            $(THRESHOLD + i).html("阈值");
        }
        
        $(THRESHOLD + "8").html("第一阈值");
        $(THRESHOLD + "9").html("第二阈值");
        $(THRESHOLD + "10").html("第三阈值");
        
        for (i = 0; i < 11; i++) {
            $(INCREMENTS + i).html("增幅");
        }
        
        $(DRC_INTRO).html("<b>Dodging Rain Competition(DRC)</b>是由<a href='https://twitter.com/VincentZeem'>ZM</a>发起的东方比赛，举办地点：<a href='https://discord.gg/Ucae3Uf'>DRC Discord</a>。" +
        "两队进行不同项目的比赛。每位选手报名时写下想打的任意项目，根据偏好排序，可以是避弹向的生存，也可以是打分，任意作品、任意难度均可。列出的项目会与另一队进行匹配，相同项目的选手即匹配成功。分组与项目由DRC主办方决定。选手将会有二周时间报名。" +
        "一旦开赛，有两周时间提交参赛录像，录像所获得分根据计算公式而定。未在两周内提交则视为无效。玩家提交的rep个数无限制，最终DRC得分将选取最高分录入。");
        $(DRC_INTRO_PTS).html("如果你想知道得了多少DRC分，请将你完成的项目填入下方计算器内开始计算。");
        $(DRC_SCORES).html("分数可包含数字、逗号、句号、空格。生存向将会被假定为已通关，打分则不会。");
        $(RUBRICS_EXPL).html("计算公式将计算出你所完成项目的分数。如果你想知道分数是如何计算的，请点击下方按钮展开。");
        $(JP_TL_CREDIT).html("本页面由<a href='https://twitter.com/7bitm'>7bitm</a>，" +
        "<a href='https://twitter.com/toho_yumiya'>ゆーみや</a>日语翻译。");
        $(CN_TL_CREDIT).html("本页面由<a href='https://twitter.com/IzayoiMeirin'>Cero</a>，<a href='https://twitter.com/CrestedPeak9'>CrestedPeak9</a>，<a href='https://twitter.com/Cerasis_th'>Cerasis</a>中文翻译。");
    }
}

function translate(arg) {
    if (language == "English") {
        return arg;
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
            "Scoring": "稼ぎ",
            "Survival": "クリア重視",
            "If score < 10m, then: ||145*(Score/10m)^3||": "スコアが1000万よりも小さければ、||145*(スコア/1000万)^3||",
            "If score < 10m, then: ||170*(Score/10m)^3||": "スコアが1000万よりも小さければ、||170*(スコア/1000万)^3||",
            "If score < 10m, then: ||175*(Score/10m)^3||": "スコアが1000万よりも小さければ、||175*(スコア/1000万)^3||",
            "If score < 13m, then: ||200*(Score/13m)^3||": "スコアが1300万よりも小さければ、||200*(スコア/1300万)^3||",
            "If score < 1st threshold, then: ||220*(Score/T1)^2||": "スコアが第一閾値よりも小さければ、||220*(スコア/第一閾値)^2||",
            "If score < 2b, then: ||200*(Score/2b)^2||": "スコアが20億よりも小さければ、||200*(スコア/20億)^2||",
            "Hide Rubrics": "ルーブリックを見せない",
            "Show Rubrics": "ルーブリックを見せて",
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
    } else {
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
            "Scoring": "打分",
            "Survival": "生存",
            "If score < 10m, then: ||145*(Score/10m)^3||": "若分数小于1000万，||145*(分数/1000万)^3||",
            "If score < 10m, then: ||170*(Score/10m)^3||": "若分数小于1000万，||170*(分数/1000万)^3||",
            "If score < 10m, then: ||175*(Score/10m)^3||": "若分数小于1000万，||175*(分数/1000万)^3||",
            "If score < 13m, then: ||200*(Score/13m)^3||": "若分数小于1300万，||200*(分数/1000万)^3||",
            "If score < 1st threshold, then: ||220*(Score/T1)^2||": "若分数小于第一阈值，||220*(分数/第一阈值)^2||",
            "If score < 2b, then: ||200*(Score/2b)^2||": "若分数小于20亿，||200*(分数/20亿)^2||",
            "Hide Rubrics": "隐藏计算公式",
            "Show Rubrics": "显示计算公式",
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
    }
}

function checkValues(changePerformance, changeShottypes, doubleSpoilerCheck) {
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(), shottype = $(SHOTTYPE).val();
    
    if (challenge == "Survival") {
        var notifyText = "<b id='impNot'>" + translate("Important Notice:") + "</b> ";
        
        if (game == "MoF" && shottype == "MarisaB") {
            $(NOTIFY).html(notifyText + "<span id='impNotText0'>" + translate("usage of the MarisaB damage bug is BANNED in survival.") + "</span>");
        } else if (game == "TD") {
            $(NOTIFY).html(notifyText + "<span id='impNotText1'>" + translate("<em>manual</em> trances count as bombs (that is, trances from pressing C).") + "</span>");
        } else if (game == "PCB") {
            $(NOTIFY).html(notifyText + "<span id='impNotText2'>" + translate("border breaks count as bombs <em>even if they are accidental</em>.") + "</span>");
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
                survOptions = survOptions.replace(translate("Misses") + "</label>", translate("Rounds lost") + "</label>").replace("max=100", "max=5");
            } else if (game == "PoFV") {
                survOptions += "<br><label id='ncLabel' for='nb'>" + translate("No Charge Attacks") + "</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace(translate("Misses") + "</label>", translate("Rounds lost") + "</label>").replace("max=100", "max=8");
            } else {
                if (game == "PCB") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + translate("Bombs") + "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                    survOptions += "<br><label id='bbLabel' for='bb'>" + translate("Border Breaks") + "</label><input id='bb' type='number' value=0 min=0 max=100>";
                } else if (game == "TD") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + translate("Bombs / Trances") + "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                } else {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + translate("Bombs") + "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                }
                
                if (game == "IN") {
                    difficulty = $(DIFFICULTY).val();
                    
                    if (difficulty == "Extra") {
                        survOptions += "<br><label id='isLabel' for='is'>" + translate("Imperishable Shooting Captured") + "</label><input id='is' type='checkbox'>";
                    } else {
                        survOptions += "<br><label id='lsLabel' for='ls'>" + translate("Last Spells Captured") + "</label><input id='ls' type='number' value=0 min=0 max=10>";
                        $(ROUTE).css("display", "inline");
                    }
                }
                
                if (game == "HSiFS") {
                    survOptions += "<br><label id='releasesLabel' for='releases'>" + translate("Releases") + "</label><input id='releases' type='number' value=0 min=0 max=1000>";
                }
            }
            
            $(PERFORMANCE).html(survOptions);
            $(MISSES_LABEL).html(translate("Misses"));
        } else {
            if (game == "DS") {
                $(PERFORMANCE).html("<label for='scene'>Scene</label><select id='scene'><option>4-7</option><option>9-6</option>" +
                "<option>10-1</option><option>11-8</option><option>12-4</option><option>EX-6</option></select><br>" + SCORE_OPTIONS);
            } else {
                $(PERFORMANCE).html(SCORE_OPTIONS);
            }
            
            $(SCORE_LABEL).html(translate("Score"));
            $(NOTIFY).html("");
        }
            
        if (language == "Japanese") {
            generateText(false);
        }
    }
    
    if (changeShottypes) {
        checkShottypes(true);
    }
}

function checkShottypes(alwaysChange) {
    var game = $(GAME).val(), challenge = $(CHALLENGE).val(), difficulty = $(DIFFICULTY).val(), shottypeList = "", shottypes, shottype, i;
    
    shottypes = (game == "DS" ? ["Aya", "Hatate"] : Object.keys(WRs[game][difficulty]));
    
    if (game == "HSiFS") {
        shottypes = ["Reimu", "Cirno", "Aya", "Marisa"];
    }
    
    for (i = 0; i < shottypes.length; i++) {
        shottypeList += "<option id='shottype" + i + "' value='" + shottypes[i] + "'>" + translateCharName(shottypes[i]) + "</option>";
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
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(), shottype = $(SHOTTYPE).val(), rubric, season, points;
    
    if (challenge == "Survival") {
        if (!Rubrics.SURV_RUBRICS[game]) {
            $(ERROR).html("<strong style='color:red'>" + translate("Error: ") + translate("the survival rubrics for this game are undetermined as of now.") + "</strong>");
            $(DRCPOINTS).html(translate("Your DRC points for this run: ") + " <strong>0</strong>!");
            return;
        } else {
            $(ERROR).html("");
        }
        
        rubric = Rubrics.SURV_RUBRICS[game][difficulty];
        
        if (game == "HSiFS" && Number($(RELEASES).val()) === 0) {
            season = $(SEASON).val();
            shottypeMultiplier = (Rubrics.SURV_RUBRICS[game].multiplier[shottype + season] ? Rubrics.SURV_RUBRICS[game].multiplier[shottype + season] : 1);
        } else {
            shottypeMultiplier = (Rubrics.SURV_RUBRICS[game].multiplier[shottype] ? Rubrics.SURV_RUBRICS[game].multiplier[shottype] : 1);
        }
        
        points = (isPhantasmagoria(game) ? phantasmagoria(rubric, game, difficulty, shottypeMultiplier) : survivalPoints(rubric, game, difficulty, shottypeMultiplier));
    } else {
        if (!(game == "MoF" && (difficulty == "Easy" || difficulty == "Lunatic")) && game != "DS" && !Rubrics.SCORE_RUBRICS[game]) {
            $(ERROR).html("<strong style='color:red'>" + translate("Error: ") + translate("the scoring rubrics for this game are undetermined as of now.") + "</strong>");
            $(DRCPOINTS).html(translate("Your DRC points for this run: ") + " <strong>0</strong>!");
            return;
        } else {
            $(ERROR).html("");
        }
        
        if (game == "DS") {
            points = dsFormula();
        } else if (game == "MoF") {
            points = mofFormula(difficulty, shottype);
        } else {
            rubric = Rubrics.SCORE_RUBRICS[game][difficulty];
            points = scoringPoints(rubric, game, difficulty, shottype);
        }
    }
    
    $(DRCPOINTS).html(translate("Your DRC points for this run: ") + " <strong>" + points + "</strong>!");
}

function phantasmagoria(rubric, game, difficulty, shottypeMultiplier) {
    var roundsLost = Number($(MISSES).val()), bonus;
    
    if (roundsLost > rubric.lives) {
        if (language == "English") {
            $(ERROR).html("<strong style='color:red'>Error: the number of rounds lost cannot exceed " + rubric.lives + "</strong>");
        } else if (language == "Japanese") {
            $(ERROR).html("<strong style='color:red'>エラー: 敗北数が" + rubric.lives + "を超えてはいけません。</strong>");
        } else {
            $(ERROR).html("<strong style='color:red'>错误：败北数不能超过" + rubric.lives + "。</strong>");
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
    var misses = Number($(MISSES).val()), bombs = Number($(BOMBS).val()), n = 0, decrement = 0;

    var borderBreaks, route, lastSpells, releases, season, i;
    
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
            for (i = 0; i < 10; i++) {
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
                if (language == "English") {
                    $(ERROR).html("<strong style='color:red'>Error: the number of Last Spells captured in a " + route +
                    " clear on " + difficulty + " cannot exceed " + Rubrics.MAX_LAST_SPELLS[difficulty][route] + "</strong>");
                } else if (language == "Japanese") {
                    $(ERROR).html("<strong style='color:red'>エラー: ラストスペルが" + Rubrics.MAX_LAST_SPELLS[difficulty][route] + "を超えてはいけません。</strong>");
                } else {
                    $(ERROR).html("<strong style='color:red'>错误：" + route + "路线" + difficulty +
                    "难度中的LSC收取数不能超过" + Rubrics.MAX_LAST_SPELLS[difficulty][route] + "。");
                }
                
                return 0;
            }
            
            drcpoints += lastSpells * (difficulty == "Easy" ? 1 : 2);
        }
    }
    
    if (difficulty != "Extra" && difficulty != "Phantasm") {
        drcpoints = Math.round(drcpoints * shottypeMultiplier);
    }
    
    return drcpoints;
}

/*function hrtpFormula(difficulty) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), drcpoints = 0, thresholds;
    
    thresholds = HRTP_THRESHOLDS[difficulty];
    
    if (score < thresholds.score) {
        return Math.round(Math.pow((score / thresholds.score), 3) * thresholds.base);
    }
    
    drcpoints = thresholds.base;
   
    while (score > thresholds.score) {
        score -= thresholds.step;
        drcpoints += 1;
    }
    
    return Math.min(drcpoints, thresholds.cap);
}*/

function mofFormula(difficulty, shottype) {
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), drcpoints = 0, originalScore = score, thresholds, increment, step, i;
    
    // rubric currently only determined for Easy, Lunatic ReimuB and Lunatic MarisaC
    if (difficulty != "Easy" && difficulty != "Lunatic") {
        $(ERROR).html("<strong style='color:red'>" + translate("Error: ") + translate("the scoring rubrics for this difficulty are undetermined as of now.") + "</strong>");
        return drcpoints;
    } else if (difficulty == "Lunatic" && shottype != "ReimuB" && shottype != "MarisaC") {
        $(ERROR).html("<strong style='color:red'>" + translate("Error: ") + translate("the scoring rubrics for this shottype are undetermined as of now.") + "</strong>");
        return drcpoints;
    }
    
    thresholds = Rubrics.MOF_THRESHOLDS[difficulty][shottype];
    
    if (score < thresholds.score[0]) {
        return Math.round(Math.pow((score / thresholds.score[0]), 2) * (difficulty == "Easy" ? 220 : 200));
    }
    
    drcpoints = thresholds.base[0];
    
    for (i = thresholds.increment.length - 1; i >= 0; i--) {
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
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), scene = $(SCENE).val(), thresholds = Rubrics.SCENE_THRESHOLDS[scene], drcpoints = 0, step, i;
    
    for (i = 3; i >= 0; i--) {
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
    var score = Number($(SCORE).val().replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), wr;
    
    if (isNaN(score)) {
        $(ERROR).html("<strong style='color:red'>" + translate("Error: ") + translate("invalid score.") + "</strong>");
        return 0;
    } else {
        $(ERROR).html("");
    }
    
    if (game == "HRtP") {
        if (difficulty == "Lunatic") {
            wr = 15500000;
        } else {
            wr = 13400000;
        }
    } else if (game == "SoEW" && difficulty == "Hard") {
        wr = WRs[game][difficulty]["ReimuB"][0];
    } else if (game == "SoEW" && difficulty == "Lunatic") {
        wr = WRs[game][difficulty]["ReimuA"][0];
    } else if (game == "LLS") {
        wr = WRs[game][difficulty];
        
        if (difficulty == "Easy") {
            wr = wr["ReimuA"][0];
        } else if (difficulty == "Normal" || difficulty == "Hard" || difficulty == "Extra") {
            wr = wr["ReimuB"][0];
        } else if (difficulty == "Lunatic") {
            wr = 165000000;
        }
    } else if (game == "MS" && difficulty == "Lunatic") {
        wr = 200000000;
    } else if (game == "PCB" && difficulty == "Lunatic") {
        wr = WRs[game][difficulty];
        
        if (shottype == "ReimuB") {
            wr = 3300000000;
        } else if (shottype == "MarisaA") {
            wr = 3100000000;
        } else if (shottype == "SakuyaB") {
            wr = 3600000000;
        } else {
            wr = wr[shottype][0];
        }
    } else if (game == "LoLK" && difficulty == "Lunatic") {
        wr = WRs[game][difficulty];
        
        if (shottype == "Reimu") {
            wr = 2500000000;
        } else if (shottype == "Marisa") {
            wr = 2400000000;
        } else {
            wr = wr[shottype][0];
        }
    } else if (game == "HSiFS" && difficulty == "Hard") {
        wr = WRs[game][difficulty]["AyaAutumn"][0];
    } else {
        wr = WRs[game][difficulty][removeSeason(shottype) + (game == "HSiFS" ? bestSeason(difficulty, shottype) : "")][0];
    }
    
    return (score >= wr ? rubric.base : Math.round(rubric.base * Math.pow((score / wr), rubric.exp)));
}

function abbreviate(num) {
    var string = String(num), original = string, i = 0, rest;
    
    while (string.indexOf("000") != -1) {
        string = string.replace("000", "");
        i += 1;
    }
    
    if (original.length >= 10) {
        rest = string.substr(1, string.length).replace("00", "");
        
        if (rest.lastIndexOf("0") == rest.length - 1) {
            rest = rest.replace("0", "");
        }
    
        return string.charAt(0) + (rest === "" ? "" : "." + rest) + "b";
    } else {
        return string + "m";
    }
}

function zeroes(num) {
    var result = "", i;
    
    for (i = 0; i < num; i++) {
        result += "0";
    }
    
    return result;
}

function abbreviateJapanese(num) {
    var string = String(num), original = string, current = string.lastIndexOf("0"), index = string.length, count = 0;
    
    if (string.length < 5) {
        return string;
    }
    
    while (string.charAt(current) == "0") {
        current -= 1;
    }
    
    string = string.substr(0, current + 1);
    
    while (index - 4 > 0) {
        index -= 4;
        count += 1;
    }
    
    if (string.substr(index, string.length) === "") {
        if (count == 2) {
            return string + (string.length <= original.length - 9 ? zeroes(original.length - 9) : "") + "億";
        } else {
            return string + (string.length <= original.length - 5 ? zeroes(original.length - 5) : "") + "万";
        }
    } else {
        return string.substr(0, index) + "." + string.substr(index, string.length) + (count == 2 ? "億" : "万");
    }
}

function abbreviateChinese(num) {
    var string = String(num), original = string, current = string.lastIndexOf("0"), index = string.length, count = 0;
    
    if (string.length < 5) {
        return string;
    }
    
    while (string.charAt(current) == "0") {
        current -= 1;
    }
    
    string = string.substr(0, current + 1);
    
    while (index - 4 > 0) {
        index -= 4;
        count += 1;
    }
    
    if (string.substr(index, string.length) === "") {
        if (count == 2) {
            return string + (string.length <= original.length - 9 ? zeroes(original.length - 9) : "") + "亿";
        } else {
            return string + (string.length <= original.length - 5 ? zeroes(original.length - 5) : "") + "万";
        }
    } else {
        return string.substr(0, index) + "." + string.substr(index, string.length) + (count == 2 ? "亿" : "万");
    }
}

function generateRubrics() {
    var id = 0, id2 = 3, game, difficulty, rubric, shottype, thresholds, scene, i, n1, n2, n3, step1, step2;
    //$(HRTP_TABLE).html("");
    $(MOF_TABLE).html("");
    $(DS_TABLE).html("");
    $(SURV_TABLE).html("");
    $(SCORING_TABLE).html("");
    $(PHANTASMAGORIA).html("");
    $(SHOTTYPE_MULTIPLIERS).html("");
    
    // detect smartphone
	if (navigator.userAgent.contains("Mobile")) {
        $(RUBRICS_TABLES).html("<table class='center'>" +
        "<thead><tr><td colspan='3'><b id='scoring1'>" + translate("Scoring") +
        "</b><br><span id='scoreFormula'>" + translate("||Max * (Score/WR)^Exp||") + "</span></td></tr></thead>" +
        "<tbody id='scoringTable'></tbody>" +
        "</table>" +
        "<table class='center'>" +
        "<thead><tr><td colspan='6'><b id='survival1'>" + translate("Survival") +
        "</b><br><span id='survFormula'>" + translate("||Max * (Base^-n)||") + "</span></td></tr></thead>" +
        "<tbody id='survivalTable'></tbody>" +
        "</table>");
	} else {
        $(RUBRICS_TABLES).html("<table id='noborders'>" +
        "<tr class='noborders'>" +
        "<td class='noborders'>" +
        "<table>" +
        "<thead><tr><td colspan='3'><b id='scoring1'>" + translate("Scoring") +
        "</b><br><span id='scoreFormula'>" + translate("||Max * (Score/WR)^Exp||") + "</span></td></tr></thead>" +
        "<tbody id='scoringTable'></tbody>" +
        "</table>" +
        "</td>" +
        "<td class='noborders' style='float:left'>" +
        "<table>" +
        "<thead><tr><td colspan='6'><b id='survival1'>" + translate("Survival") +
        "</b><br><span id='survFormula'>" + translate("||Max * (Base^-n)||") + "</span></td></tr></thead>" +
        "<tbody id='survivalTable'></tbody>" +
        "</table>" +
        "</td>" +
        "</tr>" +
        "</table>");
    }

    for (game in Rubrics.SCORE_RUBRICS) {
        $(SCORING_TABLE).append("<tr>");
        $(SCORING_TABLE).append(game == "HRtP" ? SCORING_COLUMN : "<th></th><td></td><td></td>");
        $(SCORING_TABLE).append("</tr>");
        
        for (difficulty in Rubrics.SCORE_RUBRICS[game]) {
            rubric = Rubrics.SCORE_RUBRICS[game][difficulty];
            $(SCORING_TABLE).append("<tr><th>" + translateGameName(game + " ") + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.exp + "</td></tr>");
        }
    }
    
    for (game in Rubrics.SURV_RUBRICS) {
        if (isPhantasmagoria(game)) {
            $(PHANTASMAGORIA).append("<tr>");
            $(PHANTASMAGORIA).append(game == "PoDD" ? "<th id='game1'>Game</th><th id='maxPoints2'>Max points</th><th id='minPoints'>Min points</th><th id='nbBonus'>No Bomb bonus</th>" : "<th></th><td></td><td></td><td></td>");
            $(PHANTASMAGORIA).append("</tr>");
        } else {
            $(SURV_TABLE).append("<tr>");
            $(SURV_TABLE).append(game == "HRtP" ? SURV_COLUMN : "<th></th><td></td><td></td><td></td><td></td><td></td>");
            $(SURV_TABLE).append("</tr>");
        }
        
        for (difficulty in Rubrics.SURV_RUBRICS[game]) {
            rubric = Rubrics.SURV_RUBRICS[game][difficulty];
            
            if (difficulty == "multiplier" || difficulty == "seasonMultiplier") {
                $(SHOTTYPE_MULTIPLIERS).append("<tr>");
                $(SHOTTYPE_MULTIPLIERS).append(game == "HRtP" ? "<th id='multipliedShottype'>Shottype</th><th id='multiplier'>Multiplier</th><" : "<th></th><td></td>");
                $(SHOTTYPE_MULTIPLIERS).append("</tr>");
                
                for (shottype in rubric) {
                    $(SHOTTYPE_MULTIPLIERS).append("<tr><th>" + translateGameName(game + " ") + (language == "Japanese" ? "の" : "") + (language == "Chinese" ? " " : "") + translateCharName(shottype) + "</th><td>" + rubric[shottype] + "</td></tr>");
                }
                
                continue;
            }
            
            if (isPhantasmagoria(game)) {
                $(PHANTASMAGORIA).append("<tr><th>" + translateGameName(game + " ") + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.min +
                "</td><td>" + rubric.noBombBonus + "</td></tr>");
            } else {
                $(SURV_TABLE).append("<tr><th>" + translateGameName(game + " ") + difficulty + "</th><td>" + rubric.base + "</td><td>" + rubric.exp +
                "</td><td>" + rubric.miss + "</td><td>" + rubric.firstBomb + "</td><td>" + rubric.bomb + "</td></tr>");
            }
        }
    }
    
    /*for (difficulty in HRTP_THRESHOLDS) {
        thresholds = HRTP_THRESHOLDS[difficulty];
        $(HRTP_TABLE).append("<tr><th colspan='12'>" + difficulty + "</th></tr>");
        $(HRTP_TABLE).append("<tr><td colspan='4'>" + translate("If score < " + abbreviate(thresholds.score) +
        ", then: ||" + thresholds.base + "*(Score/" + abbreviate(thresholds.score) + ")^3||") + "</td></tr>");
        $(HRTP_TABLE).append("<tr><th id='threshold" + id + "'>Threshold</th><th id='basePoints" + id +
        "'>Base points</th><th id='increments" + id + "'>Increments</th><th id='maxPoints" + id2 + "'>Max points</th></tr>");
        id += 1;
        id2 += 1;
        
        if (language == "English") {
            $(HRTP_TABLE).append("<tr><td>" + abbreviate(thresholds.score) + "</td><td>" + thresholds.base +
            "</td><td>+1 for every " + sep(thresholds.step) + "</td><td>" + thresholds.cap + "</td></tr>");
        } else if (language == "Japanese") {
            $(HRTP_TABLE).append("<tr><td>" + abbreviateJapanese(thresholds.score) + "</td><td>" + thresholds.base +
            "</td><td>" + abbreviateJapanese(thresholds.step) + "ごとに+1を</td><td>" + thresholds.cap + "</td></tr>");
        } else {
            $(HRTP_TABLE).append("<tr><td>" + abbreviateChinese(thresholds.score) + "</td><td>" + thresholds.base +
            "</td><td>每" + abbreviateChinese(thresholds.step) + "增加1</td><td>" + thresholds.cap + "</td></tr>");
        }
    }*/
    
            
    for (difficulty in Rubrics.MOF_THRESHOLDS) {
        $(MOF_TABLE).append("<tr><th colspan='12'>" + difficulty + "</th></tr>");
        $(MOF_TABLE).append("<tr><td colspan='12'>" + (difficulty == "Easy" ? translate("If score < 1st threshold, " +
        "then: ||220*(Score/T1)^2||") : translate("If score < 2b, then: ||200*(Score/2b)^2||")) + "</td></tr>");
        
        for (shottype in Rubrics.MOF_THRESHOLDS[difficulty]) {
            $(MOF_TABLE).append("<tr><th colspan='3'>" + translateCharName(shottype) + "</th></tr>");
            $(MOF_TABLE).append("<tr><th id='threshold" + id + "'>Threshold</th><th id='basePoints" + id + "'>Base points</th><th id='increments" + id + "'>Increments</th></tr>");
            thresholds = Rubrics.MOF_THRESHOLDS[difficulty][shottype];
            id += 1;
            
            for (i = 0; i < thresholds.base.length; i++) {
                if (language == "English") {
                    $(MOF_TABLE).append("<tr><td>" + abbreviate(thresholds.score[i]) + "</td><td>" + thresholds.base[i] +
                    "</td><td>+" + thresholds.increment[i] + " for every " + abbreviate(thresholds.step[i]) + "</td></tr>");
                } else if (language == "Japanese") {
                    $(MOF_TABLE).append("<tr><td>" + abbreviateJapanese(thresholds.score[i]) + "</td><td>" + thresholds.base[i] +
                    "</td><td>" + abbreviateJapanese(thresholds.step[i]) + "ごとに+" + thresholds.increment[i] + "</td></tr>");
                } else {
                    $(MOF_TABLE).append("<tr><td>" + abbreviateChinese(thresholds.score[i]) + "</td><td>" + thresholds.base[i] +
                    "</td><td>每" + abbreviateChinese(thresholds.step[i]) + "增加" + thresholds.increment[i] + "</td></tr>");
                }
            }
        }
    }
    
    $(DS_TABLE).append("<tr><th>" + translate("Scene") + "</th><th id='basePoints" + (id + 1) + "'>" + translate("Base points") +
    "</th><th id='increments" + (id) + "'>" + translate("Increments") + "</th><th id='threshold" + (id) + "'>" + translate("Threshold 1") +
    "</th><th id='increments" + (id + 1) + "'>" + translate("Increments") + "</th><th id='threshold" + (id + 1) + "'>" + translate("Threshold 2") +
    "</th><th id='increments" + (id + 2) + "'>" + translate("Increments") + "</th><th id='threshold" + (id + 2) + "'>" + translate("Threshold 3") + "</th></tr>");
    
    for (scene in Rubrics.SCENE_THRESHOLDS) {
        thresholds = Rubrics.SCENE_THRESHOLDS[scene];
        n1 = thresholds[1] * 1000;
        n2 = thresholds[2] * 1000;
        n3 = thresholds[3] * 1000;
        step1 = Math.round(n1 / 20);
        step2 = Math.round((n2 - n1) / 30);
        step3 = Math.round((n3 - n2) / 30);
        
        if (language == "English") {
            $(DS_TABLE).append("<tr><td>" + scene + "</td><td>0</td><td>+1 for every " + sep(step1) +
            "</td><td>" + sep(n1) + "</td><td>+1 for every " + sep(step2) +
            "</td><td>" + sep(n2) + "</td><td>+1 for every " + sep(step3) +
            "</td><td>" + sep(n3) + "</td></tr>");
        } else if (language == "Japanese") {
            $(DS_TABLE).append("<tr><td>" + scene + "</td><td>0</td><td>" + abbreviateJapanese(step1) +
            "ごとに+1</td><td>" + abbreviateJapanese(n1) + "</td><td>" + abbreviateJapanese(step2) +
            "ごとに+1</td><td>" + abbreviateJapanese(n2) + "</td><td>" + abbreviateJapanese(step3) +
            "ごとに+1</td><td>" + abbreviateJapanese(n3) + "</td></tr>");
        } else {
            $(DS_TABLE).append("<tr><td>" + scene + "</td><td>0</td><td>每" + abbreviateChinese(step1) +
            "增加1</td><td>" + abbreviateChinese(n1) + "</td><td>每" + abbreviateChinese(step2) +
            "增加1</td><td>" + abbreviateChinese(n2) + "</td><td>每" + abbreviateChinese(step3) +
            "增加1</td><td>" + abbreviateChinese(n3) + "</td></tr>");
        }
    }
}

function showRubrics() {
    $(RUBRICS).css("display", "block");
    $(RUBRICS_BUTTON).attr("onClick", "javascript:hideRubrics()");
    $(RUBRICS_BUTTON).val(translate("Hide Rubrics"));
}

function hideRubrics() {
    $(RUBRICS).css("display", "none");
    $(RUBRICS_BUTTON).attr("onClick", "javascript:showRubrics()");
    $(RUBRICS_BUTTON).val(translate("Show Rubrics"));
}

function setLanguage(newLanguage) {
    if (language == newLanguage) {
        return;
    }
    
    language = newLanguage;
    generateText(false);
    setCookie("lang", newLanguage);
}
