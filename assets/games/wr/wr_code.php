<?php
$MAX_SCORE = 9999999990;
$RECENT_LIMIT = 10;
$json = file_get_contents('assets/shared/json/wrlist.json');
$wr = json_decode($json, true);
$json = file_get_contents('assets/shared/json/bestinthewest.json');
$west = json_decode($json, true);
$layout = (isset($_COOKIE['wr_old_layout']) ? 'Old' : 'New');
$overall = array(0);
$overall_player = array(0);
$overall_diff = array(0);
$overall_shottype = array(0);
$overall_date = array(0);
$overall_video = array(0);
$missing_replays = array();
$diff_max = array();
$pl = array();
$pl_wr = array();
$flag = array();
$recent = array();
$lm = '0/0/0';

function has_space(string $lang) {
    return $lang == 'en_GB' || $lang == 'en_US' || $lang == 'ru_RU' || $lang == 'de_DE' || $lang == 'es_ES';
}

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

function date_tl(string $date, string $lang) {
    if ($date == '') {
        return '';
    }
    $tmp = preg_split('/\//', $date);
    $day = $tmp[0];
    $month = $tmp[1];
    $year = $tmp[2];
    if ($lang == 'en_US') {
        return $month . '/' . $day . '/' . $year;
    } else if ($lang == 'ja_JP' || $lang == 'zh_CN') {
        return $year . '年' . $month . '月' . $day . '日';
    } else if ($lang == 'ru_RU' || $lang == 'de_DE') {
        return $day . '.' . $month . '.' . $year;
    } else { // en_GB || es_ES
        return $day . '/' . $month . '/' . $year;
    }
}

function format_lm(string $lm, string $lang) {
    switch ($lang) {
        case 'ja_JP': return '<span id="lm">' . date_tl($lm, $lang) . '</span>現在の世界記録です。';
        case 'zh_CN': return '世界记录更新于<span id="lm">' . date_tl($lm, $lang) . '</span>。';
        case 'ru_RU': return 'Рекорды актуальны на <span id="lm">' . date_tl($lm, $lang) . '</span>.';
        case 'de_DE': return 'Die Weltrekorde sind ab <span id="lm">' . date_tl($lm, $lang) . '</span> aktuell.';
        case 'es_ES': return 'Los Récords Mundiales están actualizados hasta el <span id="lm">' . date_tl($lm, $lang) . '</span>.';
        default: return 'World records are current as of <span id="lm">' . date_tl($lm, $lang) . '</span>.';
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
            $video = empty($array[3]) ? '' : $array[3];
            if ($score >= $overall[$num]) {
                $overall[$num] = $score;
                $overall_diff[$num] = $diff;
                $overall_shottype[$num] = $shot;
                $overall_player[$num] = $player;
                $overall_date[$num] = $date;
                $overall_video[$num] = $video;
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
                    'video' => $video,
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
                            'video' => $video,
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
