<?php
$MAX_SCORE = 9999999990;
$json = file_get_contents('assets/json/wrlist-new.json');
$wr = json_decode($json, true);
$json = file_get_contents('assets/json/bestinthewest-new.json');
$west = json_decode($json, true);
$json = file_get_contents('assets/json/counterstops-new.json');
$cs = json_decode($json, true);
if (isset($_COOKIE['lang'])) {
    $lang = str_replace('"', '', $_COOKIE['lang']);
    $notation = str_replace('"', '', $_COOKIE['datenotation']);
}
if (empty($_GET['hl']) && !isset($_COOKIE['lang']) || $_GET['hl'] == 'en-gb') {
    $lang = 'English';
    $notation = 'DMY';
} else if ($_GET['hl'] == 'en-us') {
    $lang = 'English';
    $notation = 'MDY';
} else if ($_GET['hl'] == 'jp') {
     $lang = 'Japanese';
     $notation = 'YMD';
} else if ($_GET['hl'] == 'zh') {
    $lang = 'Chinese';
    $notation = 'YMD';
}
$layout = (isset($_COOKIE['wr_old_layout']) ? 'Old' : 'New');
$overall = array(0);
$overall_player = array(0);
$overall_diff = array(0);
$overall_shottype = array(0);
$overall_date = array(0);
$missing_replays = array();
$diff_max = array();
$pl = array();
$pl_wr = array();
$flag = array();
$lm = '0/0/0';
function pc_class(int $pc) {
    if ($pc < 50) {
        return 'does_not_even_score';
    } else if ($pc < 75) {
        return 'barely_even_scores';
    } else if ($pc < 90) {
        return 'moderately_even_scores';
    } else if ($pc < 100) {
        return 'does_even_score';
    } else {
        return 'does_even_score_well';
    }
}
function replay_path(string $game, string $diff, string $shot) {
    return 'replays/th' . num($game) . '_ud' . substr($diff, 0, 2) . shot_abbr($shot) . '.rpy';
}
function date_tl(string $date, string $notation) {
    $tmp = preg_split('/\//', $date);
    $day = $tmp[0];
    $month = $tmp[1];
    $year = $tmp[2];
    if ($notation == 'MDY') {
        return $month . '/' . $day . '/' . $year;
    } else if ($notation == 'YMD') {
        return $year . '年' . $month . '月' . $day . '日';
    } else { // DMY
        return $day . '/' . $month . '/' . $year;
    }
}
function format_lm(string $lm, string $lang, string $notation) {
    if ($lang == 'Japanese') {
        return '<span id="lm">' . date_tl($lm, 'YMD') . '</span>現在の世界記録です。';
    } else if ($lang == 'Chinese') {
        return '世界记录更新于<span id="lm">' . date_tl($lm, 'YMD') . '</span>。';
    } else {
        if ($notation == 'DMY') {
            return 'World records are current as of <span id="lm">' . $lm . '</span>.';
        } else {
            return 'World records are current as of <span id="lm">' . date_tl($lm, 'MDY') . '</span>.';
        }
    }
}
function game_tl(string $game, string $lang) {
    if ($lang == 'Japanese') {
        switch ($game) {
            case 'HRtP': return '靈';
            case 'SoEW': return '封';
            case 'PoDD': return '夢';
            case 'LLS': return '幻';
            case 'MS': return '怪';
            case 'EoSD': return '紅';
            case 'PCB': return '妖';
            case 'IN': return '永';
            case 'PoFV': return '花';
            case 'MoF': return '風';
            case 'SA': return '地';
            case 'UFO': return '星';
            case 'GFW': return '大';
            case 'TD': return '神';
            case 'DDC': return '輝';
            case 'LoLK': return '紺';
            case 'HSiFS': return '天';
            case 'WBaWC': return '鬼';
            default: return $game;
        }
    } else if ($lang == 'Chinese') {
        switch ($game) {
            case 'HRtP': return '灵';
            case 'SoEW': return '封';
            case 'PoDD': return '梦';
            case 'LLS': return '幻';
            case 'MS': return '怪';
            case 'EoSD': return '红';
            case 'PCB': return '妖';
            case 'IN': return '永';
            case 'PoFV': return '花';
            case 'MoF': return '风';
            case 'SA': return '地';
            case 'UFO': return '星';
            case 'GFW': return '大';
            case 'TD': return '神';
            case 'DDC': return '辉';
            case 'LoLK': return '绀';
            case 'HSiFS': return '天';
            case 'WBaWC': return '鬼';
            default: return $game;
        }
    }
    return $game;
}
function player_search(string $lang) {
    if ($lang == 'Chinese') {
        return '玩家WR';
    } else if ($lang == 'Japanese') {
        return '個人のWR';
    } else {
        return 'Player Search';
    }
}
foreach ($wr as $game => $value) {
    $num = num($game);
    $overall[$num] = 0;
    $flag = array_fill(0, sizeof($flag), true);
    $diff_max[$game] = array();
    foreach ($wr[$game] as $diff => $value) {
        $diff_max[$game][$diff] = [0, '', ''];
        foreach ($wr[$game][$diff] as $shot => $array) {
            if ($array[0] > $overall[$num]) {
                $overall[$num] = $array[0];
                $overall_diff[$num] = $diff;
                $overall_shottype[$num] = $shot;
                $overall_player[$num] = $array[1];
                $overall_date[$num] = $array[2];
            }
            if ($array[0] > $diff_max[$game][$diff][0]) {
                $diff_max[$game][$diff] = [$array[0], $array[1], $shot];
            }
            if (!file_exists(replay_path($game, $diff, $shot)) && $num > 5) {
                array_push($missing_replays, ($game . $diff . $shot));
            }
            if (!in_array($array[1], $pl)) {
                array_push($pl, $array[1]);
                array_push($pl_wr, array($array[1], 1, 1));
                array_push($flag, false);
            } else {
                $key = array_search($array[1], $pl);
                $pl_wr[$key][1] += 1;
                if ($flag[$key]) {
                    $pl_wr[$key][2] += 1;
                    $flag[$key] = false;
                }
            }
            $date = preg_split('/\//', $array[2]);
            $tmp = preg_split('/\//', $lm);
            $year = $date[2]; $month = $date[1]; $day = $date[0];
            if ($year > $tmp[2] || $year == $tmp[2] && $month > $tmp[1] || $year == $tmp[2] && $month == $tmp[1] && $day > $tmp[0]) {
                $lm = $array[2];
            }
        }
    }
}
?>
