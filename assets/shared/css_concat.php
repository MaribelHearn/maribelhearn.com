<?php
header('Content-type: text/css');
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
$page = $_GET['page'];
$dir = directory($page);
$css = array(
    'shared' . $min . '.css',
    '../' . $dir . '/' . $page . '/' . ($page == 'index' ? 'main' : $page) . $min . '.css'
);
if ($_GET['mobile']) {
    array_push($css, 'shared_mobile' . $min . '.css');
    array_push($css, '../' . $dir . '/' . $page . '/' . ($page == 'index' ? 'main' : $page) . '_mobile' . $min . '.css');
}
if ($page == 'tiers') {
    include_once 'sprite_gen.php';
}
if (isset($_COOKIE['theme']) && $page != 'tiers') {
    if ($page == 'error') {
        array_push($css, 'https://maribelhearn.com/assets/shared/dark' . $min . '.css');
    } else {
        array_push($css, 'dark' . $min . '.css');
    }
}
if ($page == 'tiers') {
    array_push($css, '../other/tiers/tiers_override.css');
}
foreach ($css as $css_file) {
    $css_content = file_get_contents($css_file);
    echo $css_content;
}
if (isset($_COOKIE['theme']) && ($page == 'lnn' || $page == 'gensokyo' || $page == 'royalflare' || $page == 'wr')) {
    echo 'tr:not(.west_tr):nth-child(even),tr.west_tr:nth-child(odd),#player_td{background-color:#555555;}';
}
?>
