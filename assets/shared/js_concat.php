<?php
header('Content-type: text/javascript');
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}
function is_localhost(string $addr) {
    return $addr == '::1' || $addr == '127.0.0.1' || substr($addr, 0, 8) == '192.168.';
}
$min = (!is_localhost($_SERVER['REMOTE_ADDR']) ? '-min' : '');
$jquery = array('drc', 'lnn', 'pofv', 'scoring', 'slots', 'survival', 'tiers', 'twc', 'wr');
$sorttable = array('drc', 'gensokyo', 'lnn', 'scoring', 'survival', 'thvote', 'wr');
$utils = array('drc', 'lnn', 'tiers', 'twc', 'wr');
$canvas = array('slots', 'survival', 'tiers');
$page = $_GET['page'];
$js = array();
if (in_array($page, $canvas)) {
    array_push($js, 'html2canvas' . $min . '.js');
}
if (in_array($page, $jquery)) {
    array_push($js, 'jquery' . $min . '.js');
}
if (in_array($page, $utils)) {
    array_push($js, 'utils' . $min . '.js');
}
if (in_array($page, $sorttable)) {
    array_push($js, 'sorttable' . $min . '.js');
}
if ($page == 'tiers') {
    array_push($js, 'rgbcolor' . $min . '.js');
} else if ($page == 'error') {
    array_push($js, 'https://maribelhearn.com/assets/shared/dark' . $min . '.js');
} else if ($page == 'admin') {
    array_push($js, '../../admin/detect.js');
    array_push($js, '../../admin/admin.js');
    array_push($js, 'dark' . $min . '.js');
} else {
    array_push($js, 'dark' . $min . '.js');
}
if (file_exists('../' . $page . '/' . $page . $min . '.js')) {
    array_push($js, '../' . $page . '/' . $page . $min . '.js');
}
foreach ($js as $js_file) {
    $js_content = file_get_contents($js_file);
    echo $js_content;
}
?>
