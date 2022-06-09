<?php
header('Content-type: text/javascript');
if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}
if (!isset($_GET['page'])) {
    exit();
}
function curl_get(string $url){
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'MozillaXYZ/1.0');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
function is_localhost(string $addr) {
    return $addr == '::1' || $addr == '127.0.0.1' || substr($addr, 0, 8) == '192.168.';
}
function directory(string $page) {
    $main = array('index', 'admin', 'about', 'credits', 'privacy', 'error');
    $other = array('thvote', 'tiers', 'slots');
    $personal = array('history', 'c67');
    if (in_array($page, $main)) {
        return 'main';
    } else if (in_array($page, $other)) {
        return 'other';
    } else if (in_array($page, $personal)) {
        return 'personal';
    }
    return 'games';
}
$min = (!is_localhost($_SERVER['REMOTE_ADDR']) ? '-min' : '');
$sorttable = array('drc', 'fangame', 'gensokyo', 'lnn', 'royalflare', 'scoring', 'survival', 'thvote', 'wr');
$jquery = array('drc', 'tiers');
$canvas = array('slots', 'survival', 'tiers');
$wr_json = array('drc', 'scoring', 'wr');
$po2json = array('drc', 'lnn', 'wr');
$page = $_GET['page'];
$dir = directory($page);
$js = array();
if (in_array($page, $canvas)) {
    array_push($js, 'js/html2canvas' . $min . '.js');
    array_push($js, 'js/polyfill_promise' . $min . '.js');
}
if (in_array($page, $jquery)) {
    array_push($js, 'js/jquery' . $min . '.js');
}
if (in_array($page, $sorttable) && !($page == 'wr' && isset($_COOKIE['wr_old_layout'])) && ($page == 'lnn' && isset($_COOKIE['lnn_old_layout']))) {
    array_push($js, 'js/sorttable' . $min . '.js');
}
if ($page == 'tiers' && isset($_GET['mobile']) && $_GET['mobile']) {
    array_push($js, 'js/polyfill_dragdrop' . $min . '.js');
} else if ($page == 'error') {
    array_push($js, 'https://maribelhearn.com/assets/shared/js/utils' . $min . '.js');
} else if ($page == 'admin') {
    array_push($js, '../../admin/detect.js');
    array_push($js, '../../admin/admin.js');
}
if ($page != 'error') {
    array_push($js, 'js/utils' . $min . '.js');
}
if (file_exists('../' . $dir . '/' . $page . '/' . $page . $min . '.js')) {
    array_push($js, '../' . $dir . '/' . $page . '/' . $page . $min . '.js');
}
if ($page == 'scoring') {
    echo 'var scores = ' . file_get_contents('json/defaults.json') . ';';
}
if ($page == 'drc') {
    echo 'const Rubrics = ' . file_get_contents('json/rubrics.json') . ';';
}
if ($page == 'lnn') {
    if (file_exists('json/lnnlist.json')) {
        echo 'const LNNs = ' . file_get_contents('json/lnnlist.json') . ';';
    } else {
        echo 'const LNNs = ' . curl_get('https://maribelhearn.com/assets/shared/json/lnnlist.json') . ';';
    }
}
if ($page == 'wr') {
    if (file_exists('json/bestinthewest.json')) {
        echo 'const westScores = ' . file_get_contents('json/bestinthewest.json') . ';';
        echo 'const unverifiedScores = ' . file_get_contents('json/unverified.json') . ';';
    } else {
        echo 'const westScores = ' . curl_get('https://maribelhearn.com/assets/shared/json/bestinthewest.json') . ';';
        echo 'const unverifiedScores = ' . curl_get('https://maribelhearn.com/assets/shared/json/unverified.json') . ';';
    }
}
if ($page == 'pofv') {
    echo 'const STATS = ' . file_get_contents('json/pofv_stats.json') . ';';
    echo 'const DESCRIPTIONS = ' . file_get_contents('json/pofv_descriptions.json') . ';';
}
if ($page == 'tiers') {
    echo 'const categories = {"characters":' . file_get_contents('json/chars.json') .
    ',"works":' . file_get_contents('json/works.json') . ',"shots":' . file_get_contents('json/shots.json') .
    ',"cards":' . file_get_contents('json/cards.json') . '};';
}
if ($page == 'slots') {
    echo 'const CHARS = ' . file_get_contents('json/charpos.json') . ';';
    echo 'const LOCATIONS = ' . file_get_contents('json/locations.json') . ';';
}
if (in_array($page, $wr_json)) {
    if (file_exists('json/wrlist.json')) {
        echo 'const WRs = ' . file_get_contents('json/wrlist.json') . ';';
    } else {
        echo 'const WRs = ' . curl_get('https://maribelhearn.com/assets/shared/json/wrlist.json') . ';';
    }
}
if (in_array($page, $po2json) && !empty($_GET['hl'])) {
    $langs = array('en_GB', 'en_US', 'ja_JP', 'zh_CN', 'ru_RU', 'de_DE', 'es_ES');
    $lang = $_GET['hl'];
    if (!in_array($lang, $langs)) {
        $lang = 'en_US';
    }
    $path = '../../locale/' . $lang . '/LC_MESSAGES/' . $lang . '.json';
    if (file_exists($path)) {
        echo 'const TRANSLATIONS = ' . file_get_contents($path) . ';';
    } else {
        echo 'const TRANSLATIONS = ' . curl_get('https://maribelhearn.com/locale/' . $lang . '/LC_MESSAGES/' . $lang . '.json') . ';';
    }
}
foreach ($js as $js_file) {
    $js_content = file_get_contents($js_file);
    echo $js_content;
}
?>
