/*global _ WRs rubrics getCookie setCookie*/
let phantasm = true;
let noExtra = true;
let noShottypes = true;
let dsActive = true;
let language = "en_GB";

function changeDifficulty() {
    const game = document.getElementById("game").value;

    if (game == "GFW") {
        const alwaysChange = true;
        checkShottypes(alwaysChange);
    }

    if (game == "IN" || game == "HSiFS") {
        checkValues({data: {changePerf: true, changeShots: false}});
    }
}

function checkValues(event) {
    const diffOptions = "<option>Easy</option>\n<option>Normal</option>\n<option>Hard</option>\n<option>Lunatic</option>";
    const changePerformance = event.data.changePerf;
    const changeShottypes = event.data.changeShots;
    const performance = document.getElementById("performance");
    const diffElement = document.getElementById("difficulty");
    const routeElement = document.getElementById("route");
    const seasonElement = document.getElementById("season");
    const game = document.getElementById("game").value;
    const challenge = document.getElementById("challenge").value;
    const shot = document.getElementById("shottype").value;
    const notif = document.getElementById("notify");
    let diff = diffElement.value;

    if (challenge == "Survival") {
        var notifyText = `<strong'>${_("Important Notice:")}</strong> `;

        if (game == "MoF" && shot == "MarisaB") {
            notif.innerHTML = notifyText + `<span>${_("usage of the MarisaB damage bug is BANNED in survival.")}</span>`;
        } else if (game == "TD") {
            notif.innerHTML = notifyText + `<span>${_("<em>manual</em> trances count as bombs (that is, trances from pressing C).")}</span>`;
        } else if (game == "PCB") {
            notif.innerHTML = notifyText + `<span>${_("border breaks count as bombs <em>even if they are accidental</em>.")}</span>`;
        } else {
            notif.innerHTML = "";
        }
    }

    if (changePerformance) {
        routeElement.style.display = "none";
        seasonElement.style.display = "none";

        if (changeShottypes) {
            if (game == "DS") {
                diffElement.style.display = "none";
                dsActive = true;
            } else if (dsActive) {
                diffElement.style.display = "inline";
                dsActive = false;
            }

            if (game == "PCB") {
                diffElement.innerHTML = diffOptions + "<option>Extra</option>\n<option>Phantasm</option>";
                phantasm = true;
            } else if (phantasm) {
                diffElement.innerHTML = diffOptions + "<option>Extra</option>";
                phantasm = false;
            }

            if (game == "HRtP" || game == "PoDD") {
                diffElement.innerHTML = diffOptions;
                noExtra = true;
            } else if (game != "PCB" && noExtra) {
                diffElement.innerHTML = diffOptions + "<option>Extra</option>";
                noExtra = false;
            }
        }

        diff = document.getElementById("difficulty").value;

        if (game == "HSiFS" && diff != "Extra") {
            seasonElement.style.display = "inline";
        }

        if (challenge == "Survival") {
            let survOptions = "<label id='misses_label' for='misses'>Misses</label><input id='misses' type='number' value=0 min=0 max=100>";

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
                    diff = document.getElementById("difficulty").value;

                    if (diff == "Extra") {
                        survOptions += "<br><label id='isLabel' for='is'>" + _("Imperishable Shooting Captured") +
                        "</label><input id='is' type='checkbox'>";
                    } else {
                        survOptions += "<br><label id='lsLabel' for='ls'>" + _("Last Spells Captured") +
                        "</label><input id='ls' type='number' value=0 min=0 max=10>";
                        routeElement.style.display = "inline";
                    }
                }
                if (game == "HSiFS") {
                    survOptions += "<br><label id='releasesLabel' for='releases'>" + _("Releases") +
                    "</label><input id='releases' type='number' value=0 min=0 max=1000>";
                }
            }
            performance.innerHTML = survOptions;
            document.getElementById("misses_label").innerHTML = _("Misses");
        } else {
            const scoreOptions = "<label id='score_label' for='score'>Score</label><input id='score' type='text'>";

            if (game == "DS") {
                performance.innerHTML = "<label for='scene'>Scene</label><select id='scene'><option>2-5</option><option>5" +
                "-3</option><option>7-3</option><option>8-1</option><option>8-5</option><option>1" +
                "1-8</option></select><br>" + scoreOptions;
            } else {
                performance.innerHTML = scoreOptions;
            }

            document.getElementById("score_label").innerHTML = _("Score");
            notif.innerHTML = "";
        }
    }
    if (changeShottypes) {
        const alwaysChange = true;
        checkShottypes(alwaysChange);
    }
}

function gameChanged() {
    checkValues({data: {changePerf: true, changeShots: true}});
}

function challengeChanged() {
    checkValues({data: {changePerf: true, changeShots: false}});
}

function shottypeChanged() {
    checkValues({data: {changePerf: false, changeShots: false}});
    
}

function checkShottypes(alwaysChange) {
    const shots = JSON.parse(document.getElementById("shots").value);
    const game = document.getElementById("game").value;
    const difficulty = document.getElementById("difficulty").value;
    const shotElement = document.getElementById("shottype");
    let shottypes = shots[game];
    let shottypeList = "";

    if (game == "HSiFS") {
        shottypes = ["Reimu", "Cirno", "Aya", "Marisa"];
    } else if (game == "DS") {
        shottypes = ["Aya", "Hatate"];
    }

    for (let i = 0; i < shottypes.length; i += 1) {
        shottypeList += "<option id='shottype" + i + "' value='" + shottypes[i] + "'>" + _(shottypes[i]) + "</option>";
    }

    if (alwaysChange) {
        shotElement.innerHTML = shottypeList;
    }

    if (game == "HRtP" || game == "GFW") {
        document.getElementById("shottype_label").innerHTML = _("Route");
    } else {
        document.getElementById("shottype_label").innerHTML = _("Shottype");
    }

    if (game == "GFW" && difficulty == "Extra") {
        shotElement.innerHTML = "<option value='-'>-</option>";
        noShottypes = true;
    } else if (noShottypes) {
        shotElement.innerHTML = shottypeList;
        noShottypes = false;
    }
}

function isPhantasmagoria(game) {
    return game == "PoDD" || game == "PoFV";
}

function printMessage(message) {
    if (message === "") {
        document.getElementById("error").innerHTML = "";
        return;
    }

    document.getElementById("error").innerHTML = `<strong class='error'>${_('Error: ')}${message}</strong>`;
}

function drcPoints() {
    const game = document.getElementById("game").value;
    const diff = document.getElementById("difficulty").value;
    const challenge = document.getElementById("challenge").value;
    const shot = document.getElementById("shottype").value;
    const drcPointsElement = document.getElementById("drcpoints");
    let shottypeMultiplier, rubric, season, points;

    if (challenge == "Survival") {
        if (!rubrics.SURV[game]) {
            printMessage(_("the survival rubrics for this game are undetermined as of now."));
            drcPointsElement.innerHTML = "";
            return;
        } else {
            printMessage("");
        }

        rubric = rubrics.SURV[game][diff];

        if (game == "HSiFS" && Number(document.getElementById("releases").value) === 0) {
            season = document.getElementById("season").value;
            shottypeMultiplier = (rubrics.SURV[game].multiplier[shot + season] ? rubrics.SURV[game].multiplier[shot + season] : 1);
        } else {
            shottypeMultiplier = (rubrics.SURV[game].multiplier[shot] ? rubrics.SURV[game].multiplier[shot] : 1);
        }

        points = (isPhantasmagoria(game) ? phantasmagoria(rubric, game, diff, shottypeMultiplier) : survivalPoints(rubric, game, diff, shottypeMultiplier));
    } else {
        if (!(game == "MoF" && (diff == "Easy" || diff == "Lunatic" || diff == "Extra")) && game != "DS" && !rubrics.SCORE[game]) {
            printMessage(_("the scoring rubrics for this game are undetermined as of now."));
            drcPointsElement.innerHTML = `<p id='result'>${_("Your DRC points for this run: ")}<strong>0</strong>!</p>`;
            return;
        } else {
            printMessage("");
        }

        if (game == "DS") {
            points = dsFormula();
        } else if (game == "MoF") {
            points = mofFormula(diff, shot);
        } else {
            rubric = rubrics.SCORE[game][diff];
            points = scoringPoints(rubric, game, diff, shot);
        }
    }

    drcPointsElement.innerHTML = `<p id='result'>${_("Your DRC points for this run: ")} <strong>${points}</strong>!</p>`;
}

function phantasmagoria(rubric, game, difficulty, shottypeMultiplier) {
    const roundsLost = Number(document.getElementById("misses").value);

    if (roundsLost > rubric.lives) {
        if (language == "zh_CN") {
            printMessage("<strong class='error'>错误：败北数不能超过" + rubric.lives + "。</strong>");
        } else if (language == "ja_JP") {
            printMessage("<strong class='error'>エラー: 敗北数が" + rubric.lives + "を超えてはいけません。</strong>");
        } else { // en_US
            printMessage("<strong class='error'>Error: the number of rounds lost cannot exceed " + rubric.lives + "</strong>");
        }
        return 0;
    } else {
        printMessage("");
    }

    const bonus = document.getElementById("nb").checked ? rubric.noBombBonus : 0;

    if (difficulty == "Extra") {
        shottypeMultiplier = 1;
    }

    return Math.round(shottypeMultiplier * ((rubric.base - ((rubric.base - rubric.min) / rubric.lives * roundsLost)) + bonus));
}

function survivalPoints(rubric, game, difficulty, shottypeMultiplier) {
    const misses = Number(document.getElementById("misses").value);
    let bombs = Number(document.getElementById("bombs").value);
    let originalBombs = bombs, n = 0, decrement = 0, borderBreaks, route, lastSpells, releases, drcpoints, i;

    printMessage("");
    n += misses * rubric.miss;

    if (bombs >= 1) {
        n += rubric.firstBomb;
        bombs -= 1;
    }

    n += bombs * rubric.bomb;

    if (game == "PCB") {
        borderBreaks = Number(document.getElementById("bb").value);
        n += borderBreaks * rubric.bomb;
    }

    if (game == "HSiFS") {
        releases = Number(document.getElementById("releases").value);

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
            drcpoints += (document.getElementById("is").checked ? 5 : 0);
        } else {
            route = document.getElementById("route").value;
            lastSpells = document.getElementById("ls").value;

            if (lastSpells > rubrics.MAX_LAST_SPELLS[difficulty][route]) {
                if (language == "zh_CN") {
                    printMessage("<strong class='error'>错误：" + route + "路线" + difficulty +
                    "难度中的LSC收取数不能超过" + rubrics.MAX_LAST_SPELLS[difficulty][route] + "。");
                } else if (language == "ja_JP") {
                    printMessage("<strong class='error'>エラー: ラストスペルが" + rubrics.MAX_LAST_SPELLS[difficulty][route] +
                    "を超えてはいけません。</strong>");
                } else { // en_US
                    printMessage("<strong class='error'>Error: the number of Last Spells captured in a " + route +
                    " clear on " + difficulty + " cannot exceed " + rubrics.MAX_LAST_SPELLS[difficulty][route] + "</strong>");
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
    var score = Number(document.getElementById("score").value.replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")),
        drcpoints = 0, thresholds, increment, step, i;

    if (difficulty != "Easy" && difficulty != "Lunatic" && difficulty != "Extra") {
        printMessage("<strong class='error'>" + _("Error: ") + _("the scoring rubrics for this difficulty are undetermined as of now.") + "</strong>");
        return drcpoints;
    } else if (difficulty == "Lunatic" && shottype != "ReimuB" && shottype != "MarisaC" || difficulty == "Extra" && shottype != "ReimuB") {
        printMessage("<strong class='error'>" + _("Error: ") + _("the scoring rubrics for this shottype are undetermined as of now.") + "</strong>");
        return drcpoints;
    }

    thresholds = rubrics.MOF_THRESHOLDS[difficulty][shottype];

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
    var score = Number(document.getElementById("score").value.replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")),
    scene = document.getElementById("scene").value, thresholds = rubrics.SCENE_THRESHOLDS[scene], drcpoints = 0, step, i;

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
        if (!i.includes(shottype)) {
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
    var score = Number(document.getElementById("score").value.replace(/,/g, "").replace(/\./g, "").replace(/ /g, "")), wr, wrshottype, exp;

    if (isNaN(score)) {
        printMessage("<strong class='error'>" + _("Error: ") + _("invalid score.") + "</strong>");
        return 0;
    } else {
        printMessage("");
    }

    if (rubrics.SCORE[game][difficulty].basedOn) {
        wr = WRs[game][difficulty][rubrics.SCORE[game][difficulty].basedOn][0];
    } else if (rubrics.SCORE[game][difficulty].wr && typeof rubrics.SCORE[game][difficulty].wr == "object" && rubrics.SCORE[game][difficulty].wr.hasOwnProperty(shottype)) {
        wr = rubrics.SCORE[game][difficulty].wr[shottype];
    } else if (rubrics.SCORE[game][difficulty].wr && typeof rubrics.SCORE[game][difficulty].wr != "object") {
        wr = rubrics.SCORE[game][difficulty].wr;
    } else {
        wrshottype = (game == "HSiFS" ? removeSeason(shottype) + bestSeason(difficulty, shottype) : shottype);
        wr = WRs[game][difficulty][wrshottype][0];
    }

    exp = (game == "DDC" && difficulty == "Extra" && shottype == "MarisaB" ? 7 : rubric.exp);

    return (score >= wr ? rubric.base : Math.round(rubric.base * Math.pow((score / wr), exp)));
}

function cap(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function toggleRubrics(event) {
    const challenge = event.target.id.replace("_button", "");
    const rubricsElement = document.getElementById(`${challenge}_rubrics`);
    rubricsElement.style.display = (rubricsElement.style.display == "block" ? "none" : "block");
    document.getElementById(event.target.id).value = _(`${rubricsElement.style.display == "block" ? "Hide" : "Show"} ${cap(challenge)} Rubrics`);
}

function setLanguage(event) {
    event.preventDefault();
    let newLanguage;

    if (event.target.getAttribute("data-lang") == "en_GB" || event.target.parentNode.getAttribute("data-lang") == "en_GB") {
        newLanguage = (getCookie("lang") == "en_US" ? "en_US" : "en_GB");
    } else {
        newLanguage = event.target.getAttribute("data-lang") || event.target.parentNode.getAttribute("data-lang");
    }

    language = newLanguage;
    location.href = location.href.split('#')[0].split('?')[0];
    setCookie("lang", newLanguage);
}

function setEventListeners() {
    document.getElementById("calculate").addEventListener("click", drcPoints, false);
    document.getElementById("scoring_button").addEventListener("click", toggleRubrics), false;
    document.getElementById("survival_button").addEventListener("click", toggleRubrics, false);
    document.getElementById("game").addEventListener("change", gameChanged, false);
    document.getElementById("difficulty").addEventListener("change", changeDifficulty, false);
    document.getElementById("challenge").addEventListener("change", challengeChanged, false);
    document.getElementById("challenge").addEventListener("change", checkShottypes, false);
    document.getElementById("shottype").addEventListener("change", shottypeChanged, false);
    document.getElementById("calculator").style.display = "block";
    document.getElementById("scoring_button").style.display = "inline";
    document.getElementById("survival_button").style.display = "inline";
    document.getElementById("scoring_rubrics").style.display = "none";
    document.getElementById("survival_rubrics").style.display = "none";
}

function init() {
    if (getCookie("lang") == "ja_JP" || location.href.includes("?hl=jp")) {
        language = "ja_JP";
    } else if (getCookie("lang") == "zh_CN" || location.href.includes("?hl=zh")) {
        language = "zh_CN";
    } else if (getCookie("lang") == "de_DE" || location.href.includes("?hl=de")) {
        language = "de_DE";
    } else if (getCookie("lang") == "en_US" || location.href.includes("?hl=en-us")) {
        language = "en_US";
    }

    setEventListeners();
    checkValues({data: {changePerf: true, changeShots: true}});
    const flags = document.querySelectorAll(".flag, .language");

    for (const element of flags) {
        element.setAttribute("href", "");
        element.addEventListener("click", setLanguage, false);
    }

    //step = setInterval(updateCountdown, 1000);
    //updateCountdown();
}

window.addEventListener("DOMContentLoaded", init, false);
