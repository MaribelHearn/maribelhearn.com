<?php
$ALL_LNN = 101;
$ALL_GAME_LNN = 13;
$json = file_get_contents('assets/json/lnnlist.json');
$video_json = file_get_contents('assets/json/lnnvideos.json');
$lnn = json_decode($json, true);
$lnn_videos = json_decode($video_json, true);
if (isset($_COOKIE['lang'])) {
    $lang = str_replace('"', '', $_COOKIE['lang']);
} else {
    if (empty($_GET['hl']) || $_GET['hl'] == 'en') {
        $lang = 'English';
    } else if ($_GET['hl'] == 'jp') {
         $lang = 'Japanese';
    } else if ($_GET['hl'] == 'zh') {
        $lang = 'Chinese';
    } else if ($_GET['hl'] == 'ru') {
        $lang = 'Russian';
    } else {
        $lang = 'English';
    }
}
$layout = (isset($_COOKIE['lnn_old_layout']) ? 'Old' : 'New');
$pl = array();
$pl_lnn = array();
$flag = array();
$missing_replays = array();
$video_lnns = array();
$gt = 0;
function lnn_type(string $game, string $lang) {
    if ($lang == 'Chinese') {
        switch ($game) {
            case 'PCB': return 'LNNN的数量';
            case 'IN': return 'LNNFS的数量';
            case 'UFO': return 'LNN的数量';
            case 'TD': return 'LNNN的数量';
            case 'HSiFS': return 'LNNN的数量';
            case 'WBaWC': return 'LNNNN的数量';
            case 'UM': return 'LNNN的数量';
            default: return 'LNN的数量';
        }
    } else if ($lang == 'Japanese') {
        switch ($game) {
            case 'PCB': return 'LNNNの数';
            case 'IN': return 'LNNFSの数';
            case 'UFO': return 'LNNの数';
            case 'TD': return 'LNNNの数';
            case 'HSiFS': return 'LNNNの数';
            case 'WBaWC': return 'LNNNNの数';
            case 'UM': return 'LNNNの数';
            default: return 'LNNの数';
        }
    } else { // English or Russian
        switch ($game) {
            case 'PCB': return 'No. of LNNNs';
            case 'IN': return 'No. of LNNFSs';
            case 'UFO': return 'No. of LNN(N)s';
            case 'TD': return 'No. of LNNNs';
            case 'HSiFS': return 'No. of LNNNs';
            case 'WBaWC': return 'No. of LNNNNs';
            case 'UM': return 'No. of LNNNs';
            default: return 'No. of LNNs';
        }
    }
}
function date_tl(string $date) {
    $tmp = preg_split('/\//', $date);
    $day = $tmp[0];
    $month = $tmp[1];
    $year = $tmp[2];
    return $year . '年' . $month . '月' . $day . '日';
}
function format_lm(string $lm, string $lang) {
    switch ($lang) {
        case 'Japanese': return '<span id="lm">' . date_tl($lm) . '</span>現在のLNN記録です。';
        case 'Chinese': return 'LNN更新于<span id="lm">' . date_tl($lm) . '</span>。';
        case 'Russian': return 'Список LNN\'ов актуален на ' . $lm . '</span>.';
        default: return 'LNNs are current as of <span id="lm">' . $lm . '</span>.';
    }
}
function player_search(string $lang) {
    if ($lang == 'Chinese') {
        return '玩家LNN';
    } else if ($lang == 'Japanese') {
        return '個人のLNN';
    } else if ($lang == 'Russian') {
        return 'Поиск игроков';
    } else {
        return 'Player Search';
    }
}
function replay_path(string $game, string $player, string $shot) {
    $ALPHA_NUMS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $char = preg_replace('/(FinalA|FinalB|UFOs)/i', '', $shot);
    $type = str_replace($char, '', $shot);
    $folder = str_replace(' ', '', $player);
    $first = $player[0];
    $last = $player[strlen($player) - 1];
    $player = preg_replace('/[^a-z\d ]/i', '', $player);
    if (!preg_match('/[a-z\d ]/i', $player)) {
        if ($first == $last) {
            $first = $ALPHA_NUMS[mb_strlen($folder) - 1];
            $last = ($type !== "" ? $type[mb_strlen($type) - 1] : $ALPHA_NUMS[mb_strlen($folder) - 1]);
        } else {
            $first = $ALPHA_NUMS[mb_strlen($folder) - 1];
            $last = ($type !== "" ? $type[mb_strlen($type) - 1] : $ALPHA_NUMS[mb_strlen($folder)]);
        }
    } else {
        $first = $player[0];
        $last = ($type !== "" ? $type[strlen($type) - 1] : $player[strlen($player) - 1]);
    }
    return 'replays/lnn/' . $folder . '/th' . num($game) . '_ud' . $first . $last . shot_abbr($char) . '.rpy';
}
foreach ($lnn as $game => $data1) {
    if ($game == 'LM') {
        continue;
    }
    $sum = 0;
    $flag = array_fill(0, sizeof($flag), true);
    foreach ($data1 as $shottype => $data2) {
        $sum += sizeof($data2);
        foreach ($data2 as $key => $player) {
            $nospaces = str_replace(' ', '', $player);
            if (!file_exists(replay_path($game, $nospaces, $shottype)) && num($game) > 5) {
                array_push($missing_replays, ($game . $nospaces . $shottype));
            }
            if (!in_array($player, $pl)) {
                array_push($pl, $player);
                array_push($pl_lnn, array($player, 1, 1));
                array_push($flag, false);
            } else {
                $key = array_search($player, $pl);
                $pl_lnn[$key][1] += 1;
                if ($flag[$key]) {
                    $pl_lnn[$key][2] += 1;
                    $flag[$key] = false;
                }
            }
            if (!empty($lnn_videos[$game][$shottype][$player])) {
                array_push($video_lnns, $game . $shottype . $player . ';' . $lnn_videos[$game][$shottype][$player]);
            }
        }
    }
    $gt += $sum;
}
?>
