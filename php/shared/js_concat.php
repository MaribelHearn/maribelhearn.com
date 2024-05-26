<?php
header('Content-type: text/javascript');
if (file_exists('http.php')) {
    include_once 'http.php';
} else {
    include_once '../php/shared/http.php';
}
if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}
if (!isset($_GET['page'])) {
    exit();
}
$min = (!is_localhost($_SERVER['REMOTE_ADDR']) ? '-min' : '');
$sorttable = array('thvote');
$sortable = array('admin', 'fangame', 'gensokyo', 'lnn', 'royalflare', 'scoring', 'survival', 'wr');
$canvas = array('slots', 'survival', 'tiers');
$po2json = array('drc', 'lnn', 'wr');
$page = $_GET['page'];
$js = array();
if (in_array($page, $canvas)) {
    array_push($js, '../../js/lib/html2canvas' . $min . '.js');
    array_push($js, '../../js/lib/polyfill_promise' . $min . '.js');
}
if (in_array($page, $sorttable)) {
    array_push($js, '../../js/lib/sorttable' . $min . '.js');
}
if (in_array($page, $sortable)) {
    array_push($js, '../../js/lib/sortable' . $min . '.js');
}
if ($page == 'tiers' && isset($_GET['mobile']) && $_GET['mobile']) {
    array_push($js, '../../js/lib/polyfill_dragdrop' . $min . '.js');
} else if ($page == 'error') {
    array_push($js, 'https://maribelhearn.com/js/utils' . $min . '.js');
} else if ($page == 'admin') {
    if (file_exists('../../admin/detect.js')) {
        array_push($js, '../../admin/detect.js');
    }
    array_push($js, '../../admin/admin.js');
}
if ($page != 'error') {
    array_push($js, '../../js/utils' . $min . '.js');
}
if (file_exists('../../js/' . $page . $min . '.js')) {
    array_push($js, '../../js/' . $page . $min . '.js');
}
if ($page == 'survival') {
    echo 'let vals = ' . file_get_contents('../../json/defaults_survival.json') . ';';
    echo 'let sceneVals = ' . file_get_contents('../../json/defaults_scenes.json') . ';';
}
if ($page == 'scoring') {
    echo 'let scores = ' . file_get_contents('../../json/defaults_scoring.json') . ';';
}
if ($page == 'drc') {
    echo 'const rubrics = ' . file_get_contents('../../json/rubrics.json') . ';';
}
if ($page == 'tiers') {
    echo 'const categories = {' .
        '"characters":' . file_get_contents('../../json/characters.json') . ',' . 
        '"works":' . file_get_contents('../../json/works.json') . ',' .
        '"shots":' . file_get_contents('../../json/shots.json') . ',' .
        '"cards":' . file_get_contents('../../json/cards.json') .
    '};';
}
if ($page == 'slots') {
    echo 'const CHARS = ' . file_get_contents('../../json/charpos.json') . ';';
    echo 'const LOCATIONS = ' . file_get_contents('../../json/locations.json') . ';';
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
