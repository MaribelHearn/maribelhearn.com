<?php
header('Content-type: text/css');
if (file_exists('http.php')) {
    include_once 'http.php';
} else {
    include_once '../assets/shared/http.php';
}
if (!isset($_GET['page'])) {
    exit();
}
$min = (!is_localhost($_SERVER['REMOTE_ADDR']) ? '-min' : '');
$page = $_GET['page'];
$css = array(
    '../../css/icons' . $min . '.css',
    '../../css/shared' . $min . '.css',
    '../../css/' . ($page == 'index' ? 'main' : $page) . $min . '.css'
);
if (isset($_GET['mobile']) && $_GET['mobile']) {
    array_push($css, '../../css/shared_mobile' . $min . '.css');
    $page_specific_mobile = '../../css/' . ($page == 'index' ? 'main' : $page) . '_mobile' . $min . '.css';
    if (file_exists($page_specific_mobile)) {
        array_push($css, $page_specific_mobile);
    }
    
}
if ($page == 'tiers') {
    include_once 'sprite_gen.php';
} else if ($page == 'index') {
    include_once 'flags_gen.php';
}
if (isset($_COOKIE['theme']) && $page != 'tiers') {
    if ($page == 'error') {
        array_push($css, 'https://maribelhearn.com/css/dark' . $min . '.css');
    } else {
        array_push($css, '../../css/dark' . $min . '.css');
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
    echo 'tr:not(.irregular_tr):nth-child(even),tr.irregular_tr:nth-child(odd),#player_td{background-color:#555555;}';
}
?>
