/*global $ _ WRs Rubrics getCookie setCookie*/
var step, phantasm = true, noExtra = true, noShottypes = true, dsActive = true, language = "en_GB",
    DIFFICULTY = "#difficulty", BOMBS = "#bombs", SCORE = "#score", PERFORMANCE = "#performance", DRCPOINTS = "#drcpoints",
    ERROR = "#error", SHOTTYPE = "#shottype", NOTIFY = "#notify", NB = "#nb", MISSES = "#misses", CHALLENGE = "#challenge",
    NO_EXTRA = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>",
    DIFF_OPTIONS = "<option>Easy</option>\n<option>Normal</option>\n" +
    "<option>Hard</option>\n<option>Lunatic</option>\n<option>Extra</option>", LS = "#ls", IS = "#is",
    PHANTASM = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>\n" +
    "<option>Extra</option><option>Phantasm</option>", RELEASES = "#releases", SEASON = "#season", MISSES_LABEL = "#missesLabel",
    SHOTTYPE_LABEL = "#shottypeLabel", SCENE = "#scene", ROUTE = "#route",
    MISSES_INPUT = "<label id='missesLabel' for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100>",
    SCORE_OPTIONS = "<label id='scoreLabel' for='score'>Score</label><input id='score' type='text'>", SCORE_LABEL = "#scoreLabel",
    COUNTDOWN = "#countdown", GAME = "#game", BB = "#bb",
    SURV_BUTTON = "#survivalButton", SCORE_BUTTON = "#scoringButton",
    SURV_RUBRICS = "#survivalRubrics", SCORE_RUBRICS = "#scoringRubrics";

$(document).ready(function () {
    if (getCookie("lang") == "ja_JP" || location.href.includes("?hl=jp")) {
        language = "ja_JP";
    } else if (getCookie("lang") == "zh_CN" || location.href.includes("?hl=zh")) {
        language = "zh_CN";
    } else if (getCookie("lang") == "de_DE" || location.href.includes("?hl=de")) {
        language = "de_DE";
    } else if (getCookie("lang") == "en_US" || location.href.includes("?hl=en-us")) {
        language = "en_US";
    }

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
    $("#en").on("click", {language: (language == "en_US" ? "en_US" : "en_GB")}, setLanguage);
    $("#jp").on("click", {language: "ja_JP"}, setLanguage);
    $("#zh").on("click", {language: "zh_CN"}, setLanguage);
    $("#de").on("click", {language: "de_DE"}, setLanguage);
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
    $(COUNTDOWN).html("DRC End<br>" + days + "d " + hours + "h " + minutes + "m " + seconds + "s");

    if (distance < 0) {
        $(COUNTDOWN).html("");
        clearInterval(step);
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
        var notifyText = "<b id='impNot'>" + _("Important Notice:") + "</b> ";

        if (game == "MoF" && shottype == "MarisaB") {
            $(NOTIFY).html(notifyText + "<span id='impNotText0'>" +
            _("usage of the MarisaB damage bug is BANNED in survival.") + "</span>");
        } else if (game == "TD") {
            $(NOTIFY).html(notifyText + "<span id='impNotText1'>" +
            _("<em>manual</em> trances count as bombs (that is, trances from pressing C).") + "</span>");
        } else if (game == "PCB") {
            $(NOTIFY).html(notifyText + "<span id='impNotText2'>" +
            _("border breaks count as bombs <em>even if they are accidental</em>.") + "</span>");
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
                survOptions += "<br><label id='nbLabel' for='nb'>" + _("No Bomb") + "</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace(_("Misses") + "</label>", _("Rounds lost") +
                "</label>").replace("max=100", "max=5");
            } else if (game == "PoFV") {
                survOptions += "<br><label id='ncLabel' for='nb'>" + _("No Charge Attacks") + "</label><input id='nb' type='checkbox'>";
                survOptions = survOptions.replace(_("Misses") + "</label>", _("Rounds lost") +
                "</label>").replace("max=100", "max=8");
            } else {
                if (game == "PCB") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + _("Bombs") +
                    "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                    survOptions += "<br><label id='bbLabel' for='bb'>" + _("Border Breaks") +
                    "</label><input id='bb' type='number' value=0 min=0 max=100>";
                } else if (game == "TD") {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + _("Bombs / Trances") +
                    "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                } else {
                    survOptions += "<br><label id='bombsLabel' for='bombs'>" + _("Bombs") +
                    "</label><input id='bombs' type='number' value=0 min=0 max=100>";
                }
                if (game == "IN") {
                    difficulty = $(DIFFICULTY).val();
                    if (difficulty == "Extra") {
                        survOptions += "<br><label id='isLabel' for='is'>" + _("Imperishable Shooting Captured") +
                        "</label><input id='is' type='checkbox'>";
                    } else {
                        survOptions += "<br><label id='lsLabel' for='ls'>" + _("Last Spells Captured") +
                        "</label><input id='ls' type='number' value=0 min=0 max=10>";
                        $(ROUTE).css("display", "inline");
                    }
                }
                if (game == "HSiFS") {
                    survOptions += "<br><label id='releasesLabel' for='releases'>" + _("Releases") +
                    "</label><input id='releases' type='number' value=0 min=0 max=1000>";
                }
            }
            $(PERFORMANCE).html(survOptions);
            $(MISSES_LABEL).html(_("Misses"));
        } else {
            if (game == "DS") {
                $(PERFORMANCE).html("<label for='scene'>Scene</label><select id='scene'><option>2-5</option><option>5" +
                "-3</option><option>7-3</option><option>8-1</option><option>8-5</option><option>1" +
                "1-8</option></select><br>" + SCORE_OPTIONS);
            } else {
                $(PERFORMANCE).html(SCORE_OPTIONS);
            }

            $(SCORE_LABEL).html(_("Score"));
            $(NOTIFY).html("");
        }
    }
    if (changeShottypes) {
        checkShottypes({data: {alwaysChange: true}});
    }
}

function checkShottypes(event) {
    var alwaysChange = event.data.alwaysChange, shots = JSON.parse($("#shots").val()), game = $(GAME).val(),
        difficulty = $(DIFFICULTY).val(), shottypes = shots[game], shottypeList = "", i;

    if (game == "HSiFS") {
        shottypes = ["Reimu", "Cirno", "Aya", "Marisa"];
    } else if (game == "DS") {
        shottypes = ["Aya", "Hatate"];
    }

    for (i = 0; i < shottypes.length; i += 1) {
        shottypeList += "<option id='shottype" + i + "' value='" + shottypes[i] + "'>" + _(shottypes[i]) + "</option>";
    }

    if (alwaysChange) {
        $(SHOTTYPE).html(shottypeList);
    }

    if (game == "HRtP" || game == "GFW") {
        $(SHOTTYPE_LABEL).html(_("Route"));
    } else {
        $(SHOTTYPE_LABEL).html(_("Shottype"));
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
    var game = $(GAME).val(), difficulty = $(DIFFICULTY).val(), challenge = $(CHALLENGE).val(),
        shottype = $(SHOTTYPE).val(), shottypeMultiplier, rubric, season, points;

    if (challenge == "Survival") {
        if (!Rubrics.SURV[game]) {
            $(ERROR).html("<strong class='error'>" + _("Error: ") + _("the survival rubrics for this game are undetermined as of now.") + "</strong>");
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
            $(ERROR).html("<strong class='error'>" + _("Error: ") + _("the scoring rubrics for this game are undetermined as of now.") + "</strong>");
            $(DRCPOINTS).html("<p id='result'>" + _("Your DRC points for this run: ") + " <strong>0</strong>!</p>");
            return
        } else {
            $(ERROR).html("");
        }

        if (game == "DS") {
            points = dsFormula();
        } else if (game == "MoF") {
            points = mofFormula(difficulty, shottype);
        } else {
            rubric = Rubrics.SCORE[game][difficulty];
            points = scoringPoints(rubric, game, difficulty, shottype);
        }
    }
    $(DRCPOINTS).html("<p id='result'>" + _("Your DRC points for this run: ") + " <strong>" + points + "</strong>!</p>");
}

function phantasmagoria(rubric, game, difficulty, shottypeMultiplier) {
    var roundsLost = Number($(MISSES).val()), bonus;

    if (roundsLost > rubric.lives) {
        if (language == "zh_CN") {
            $(ERROR).html("<strong class='error'>错误：败北数不能超过" + rubric.lives + "。</strong>");
        } else if (language == "ja_JP") {
            $(ERROR).html("<strong class='error'>エラー: 敗北数が" + rubric.lives + "を超えてはいけません。</strong>");
        } else { // en_US
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
        n = 0, decrement = 0, borderBreaks, route, lastSpells, releases, drcpoints, i;

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
                if (language == "zh_CN") {
                    $(ERROR).html("<strong class='error'>错误：" + route + "路线" + difficulty +
                    "难度中的LSC收取数不能超过" + Rubrics.MAX_LAST_SPELLS[difficulty][route] + "。");
                } else if (language == "ja_JP") {
                    $(ERROR).html("<strong class='error'>エラー: ラストスペルが" + Rubrics.MAX_LAST_SPELLS[difficulty][route] +
                    "を超えてはいけません。</strong>");
                } else { // en_US
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
        drcpoints = 0, thresholds, increment, step, i;

    if (difficulty != "Easy" && difficulty != "Lunatic" && difficulty != "Extra") {
        $(ERROR).html("<strong class='error'>" + _("Error: ") + _("the scoring rubrics for this difficulty are undetermined as of now.") + "</strong>");
        return drcpoints;
    } else if (difficulty == "Lunatic" && shottype != "ReimuB" && shottype != "MarisaC" || difficulty == "Extra" && shottype != "ReimuB") {
        $(ERROR).html("<strong class='error'>" + _("Error: ") + _("the scoring rubrics for this shottype are undetermined as of now.") + "</strong>");
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
        $(ERROR).html("<strong class='error'>" + _("Error: ") + _("invalid score.") + "</strong>");
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
    var challenge = event.data.challenge;

    $(challenge == "Survival" ? SURV_RUBRICS : SCORE_RUBRICS).css("display", "block");
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).on("click", {challenge: challenge}, hideRubrics);
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).val(_("Hide " + challenge + " Rubrics"));
}

function hideRubrics(event) {
    var challenge = event.data.challenge;

    $(challenge == "Survival" ? SURV_RUBRICS : SCORE_RUBRICS).css("display", "none");
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).on("click", {challenge: challenge}, showRubrics);
    $(challenge == "Survival" ? SURV_BUTTON : SCORE_BUTTON).val(_("Show " + challenge + " Rubrics"));
}

function setLanguage(event) {
    var newLanguage = event.data.language;

    if (language == newLanguage) {
        return;
    }

    language = newLanguage;
    setCookie("lang", newLanguage);
    location.href = location.href.split('#')[0].split('?')[0];
}
