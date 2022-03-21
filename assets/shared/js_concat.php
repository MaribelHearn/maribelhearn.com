<?php
header('Content-type: text/javascript');
if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
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
$jquery = array('drc', 'lnn', 'pofv', 'royalflare', 'scoring', 'slots', 'survival', 'tiers', 'wr');
$utils = array('drc', 'lnn', 'pofv', 'tiers', 'wr');
$canvas = array('slots', 'survival', 'tiers');
$wr_json = array('drc', 'scoring', 'wr');
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
if (in_array($page, $utils)) {
    array_push($js, 'js/utils' . $min . '.js');
}
if (in_array($page, $sorttable)) {
    array_push($js, 'js/sorttable' . $min . '.js');
}
if ($page == 'tiers' && $_GET['mobile']) {
    array_push($js, 'js/polyfill_dragdrop' . $min . '.js');
} else if ($page == 'error') {
    array_push($js, 'https://maribelhearn.com/assets/shared/js/dark' . $min . '.js');
} else if ($page == 'admin') {
    array_push($js, '../../admin/detect.js');
    array_push($js, '../../admin/admin.js');
    array_push($js, 'js/dark' . $min . '.js');
} else {
    array_push($js, 'js/dark' . $min . '.js');
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
    echo 'const LNNs = ' . file_get_contents('json/lnnlist.json') . ';';
    echo 'const unverifiedScores = ' . file_get_contents('json/unverified.json') . ';';
}
if ($page == 'wr') {
    echo 'const westScores = ' . file_get_contents('json/bestinthewest.json') . ';';
    echo 'const unverifiedScores = ' . file_get_contents('json/unverified.json') . ';';
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
    echo 'const WRs = ' . file_get_contents('json/wrlist.json') . ';';
}
foreach ($js as $js_file) {
    $js_content = file_get_contents($js_file);
    echo $js_content;
}
?>
