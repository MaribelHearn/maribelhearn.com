<?php
include_once 'assets/shared/http.php';
$ALL_LNN = 101;
$ALL_GAME_LNN = 13;
if (file_exists('assets/shared/json/lnnlist.json')) {
    $json = file_get_contents('assets/shared/json/lnnlist.json');
    $video_json = file_get_contents('assets/shared/json/lnnvideos.json');
} else {
    $json = curl_get('https://maribelhearn.com/assets/shared/json/lnnlist.json');
    $video_json = curl_get('https://maribelhearn.com/assets/shared/json/lnnvideos.json');
    if ($json === false || $video_json === false) {
        die('Download failed!');
    }
}
$lnn = json_decode($json, true);
$lnn_videos = json_decode($video_json, true);
$layout = (isset($_COOKIE['lnn_old_layout']) ? 'Old' : 'New');
$pl = array();
$pl_lnn = array();
$flag = array();
$missing_replays = array();
$video_lnns = array();
$gt = 0;

function lnn_type(string $game, string $lang) {
    switch ($game) {
        case 'PCB': return _('No. of LNNNs');
        case 'IN': return _('No. of LNNFSs');
        case 'UFO': return _('No. of LNN(N)s');
        case 'TD': return _('No. of LNNNs');
        case 'HSiFS': return _('No. of LNNNs');
        case 'WBaWC': return _('No. of LNNNNs');
        case 'UM': return _('No. of LNNNs');
        default: return _('No. of LNNs');
    }
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
        case 'ja_JP': return '<span id="lm">' . date_tl($lm, $lang) . '</span>現在のLNN記録です。';
        case 'zh_CN': return 'LNN更新于<span id="lm">' . date_tl($lm, $lang) . '</span>。';
        case 'ru_RU': return 'Список LNN\'ов актуален на ' . date_tl($lm, $lang) . '</span>.';
        case 'de_DE': return 'Die LNNs sind ab ' . date_tl($lm, $lang) . ' aktuell.</span>';
        case 'es_ES': return 'Los LNNs están actualizados hasta el ' . date_tl($lm, $lang) . '.</span>';
        default: return 'LNNs are current as of <span id="lm">' . date_tl($lm, $lang) . '</span>.';
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
    return 'replays/lnn/' . $folder . '/th' . game_num($game) . '_ud' . $first . $last . shot_abbr($char) . '.rpy';
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
            if (!file_exists(replay_path($game, $nospaces, $shottype)) && game_num($game) > 5) {
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
