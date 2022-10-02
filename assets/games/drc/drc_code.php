<?php
include_once 'assets/shared/http.php';
$id = 0;
if (file_exists('assets/shared/json/wrlist.json')) {
    $wrlist_json = file_get_contents('assets/shared/json/wrlist.json');
} else {
    $wrlist_json = curl_get('https://maribelhearn.com/assets/shared/json/wrlist.json');
    if ($wrlist_json === false) {
        die('Download failed!');
    }
}
$rubrics_json = file_get_contents('assets/shared/json/rubrics.json');
$WRs = json_decode($wrlist_json, true);
$Rubrics = json_decode($rubrics_json, true);

function manoku(string $str, int $len, int $offset, string $lang) {
    if ($str[$len-$offset] != '0') {
        $str = substr($str, 0, $len-$offset) . '.' . substr($str, $len-$offset, $len-1);
        $len += 1;
    }
    for ($i = 0; $i < $offset; $i++) {
        if (strrpos($str, '0') == $len - 1) {
            $str = substr($str, 0, $len - 1);
            $len -= 1;
        }
    }
    $char = ($lang == 'ja_JP' ? '億' : '亿');
    return $str . ($offset == 4 ? '万' : $char);
}

function illion(string $str, int $len, int $offset, string $lang) {
    if ($str[$len-$offset] != '0') {
        $str = substr($str, 0, $len-$offset) . '.' . substr($str, $len-$offset, $len-1);
        $len += 1;
    }
    for ($i = 0; $i < $offset; $i++) {
        if (strrpos($str, '0') == $len - 1) {
            $str = substr($str, 0, $len - 1);
            $len -= 1;
        }
    }
    return $str . ($offset == 6 ? 'm' : 'b');
}

function sep(int $num) {
    return number_format($num, 0, '.', ',');
}

function abbreviate(int $num, string $lang) {
    $str = strval($num);
    if ($lang == 'ja_JP' || $lang == 'zh_CN') {
        if (!strpos($str, '0') || strlen($str) <= 4) {
            return sep($str);
        } else {
            $offset = strlen($str) <= 8 ? 4 : 8;
            return manoku($str, strlen($str), $offset, $lang);
        }
    } else {
        if (strlen($str) <= 6) {
            return sep($str);
        } else {
            $offset = strlen($str) <= 9 ? 6 : 9;
            return illion($str, strlen($str), $offset, $lang);
        }
    }
}

function is_phantasmagoria(string $game) {
    return $game == 'PoDD' || $game == 'PoFV';
}
?>
