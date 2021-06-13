<?php
$MAX_SCORE = 9999999990;
$RECENT_LIMIT = 10;
$json = file_get_contents('assets/json/wrlist.json');
$wr = json_decode($json, true);
$json = file_get_contents('assets/json/bestinthewest.json');
$west = json_decode($json, true);
$json = file_get_contents('assets/json/counterstops.json');
$cs = json_decode($json, true);
if (isset($_COOKIE['lang'])) {
    $lang = str_replace('"', '', $_COOKIE['lang']);
    $notation = str_replace('"', '', $_COOKIE['datenotation']);
} else {
    if (empty($_GET['hl']) || $_GET['hl'] == 'en-gb') {
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
    } else {
        $lang = 'English';
        $notation = 'DMY';
    }
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
$recent = array();
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
    if ($game == 'StB') {
        $shot = '0' . $shot;
        if (strlen($diff) == 1) {
            $diff = '0' . $diff;
        }
    }
    return 'replays/th' . num($game) . '_ud' . substr($diff, 0, 2) . shot_abbr($shot) . '.rpy';
}
function date_tl(string $date, string $notation) {
    if ($date == '') {
        return '';
    }
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
            if ($lang == 'Russian') {
                return 'Рекорды актуальны на <span id="lm">' . $lm . '</span>.';
            } else {
                return 'World records are current as of <span id="lm">' . $lm . '</span>.';
            }
        } else {
            return 'World records are current as of <span id="lm">' . date_tl($lm, 'MDY') . '</span>.';
        }
    }
}
function game_tl(string $game, string $lang) {
    if ($lang == 'Japanese') {
        $game = trim($game);
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
            case 'StB': return '文';
            case 'MoF': return '風';
            case 'SA': return '地';
            case 'UFO': return '星';
            case 'GFW': return '大';
            case 'TD': return '神';
            case 'DDC': return '輝';
            case 'LoLK': return '紺';
            case 'HSiFS': return '天';
            case 'WBaWC': return '鬼';
            case 'UM': return '虹';
            default: return $game;
        }
    } else if ($lang == 'Chinese') {
        $game = trim($game);
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
            case 'StB': return '文';
            case 'MoF': return '风';
            case 'SA': return '地';
            case 'UFO': return '星';
            case 'GFW': return '大';
            case 'TD': return '神';
            case 'DDC': return '辉';
            case 'LoLK': return '绀';
            case 'HSiFS': return '天';
            case 'WBaWC': return '鬼';
            case 'UM': return '虹';
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
    } else if ($lang == 'Russian') {
        return 'Поиск игроков';
    } else {
        return 'Player Search';
    }
}
function is_later_date(string $date1, string $date2) {
    if (strpos($date1, '?')) {
        return false;
    }

    $date1 = preg_split('/\//', $date1);
    $date2 = preg_split('/\//', $date2);
    $year = $date1[2]; $month = $date1[1]; $day = $date1[0];
    $cond1 = $year > $date2[2];
    $cond2 = $year == $date2[2] && $month > $date2[1];
    $cond3 = $year == $date2[2] && $month == $date2[1] && $day >= $date2[0];
    return $cond1 || $cond2 || $cond3;
}
function category_sep(string $lang) {
    if ($lang == 'Chinese') {
        return '';
    } else if ($lang == 'Japanese') {
        return 'の';
    } else {
        return ' ';
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
            $score = $array[0];
            $player = $array[1];
            $date = $array[2];
            if ($score >= $overall[$num]) {
                $overall[$num] = $score;
                $overall_diff[$num] = $diff;
                $overall_shottype[$num] = $shot;
                $overall_player[$num] = $player;
                $overall_date[$num] = $date;
            }
            if ($score > $diff_max[$game][$diff][0]) {
                $diff_max[$game][$diff] = [$score, $player, $shot];
            }
            if (!file_exists(replay_path($game, $diff, $shot)) && $num > 5) {
                array_push($missing_replays, ($game . $diff . $shot));
            }
            if (!in_array($player, $pl)) {
                array_push($pl, $player);
                array_push($pl_wr, array($player, 1, 1));
                array_push($flag, false);
            } else {
                $key = array_search($array[1], $pl);
                $pl_wr[$key][1] += 1;
                if ($flag[$key]) {
                    $pl_wr[$key][2] += 1;
                    $flag[$key] = false;
                }
            }
            if (is_later_date($date, $lm)) {
                $lm = $date;
            }
            if (count($recent) < $RECENT_LIMIT) {
                $new_obj = (object) [
                    'game' => $game,
                    'diff' => $diff,
                    'shot' => $shot,
                    'score' => $score,
                    'player' => $player,
                    'date' => $date,
                ];
                array_push($recent, $new_obj);
            } else {
                foreach ($recent as $key => $obj) {
                    if (is_later_date($date, $obj->date)) {
                        $new_obj = (object) [
                            'game' => $game,
                            'diff' => $diff,
                            'shot' => $shot,
                            'score' => $score,
                            'player' => $player,
                            'date' => $date,
                        ];
                        for ($i = $RECENT_LIMIT - 1; $i > $key; $i--) {
                            $recent[$i] = $recent[$i - 1];
                        }
                        $recent[$key] = $new_obj;
                        break;
                    }
                }
            }
        }
    }
}
?>
