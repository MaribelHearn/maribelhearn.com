<?php
header('Content-type: text/css');
function is_localhost(string $addr) {
    return $addr == '::1' || $addr == '127.0.0.1' || substr($addr, 0, 8) == '192.168.';
}
$min = (!is_localhost($_SERVER['REMOTE_ADDR']) ? '-min' : '');
$page = $_GET['page'];
$css = array(
    '../' . $page . '/' . ($page == 'index' ? 'main' : $page) . $min . '.css',
    'shared' . $min . '.css'
);
if ($_GET['mobile']) {
    array_push($css, 'shared_mobile' . $min . '.css');
    array_push($css, '../' . $page . '/' . ($page == 'index' ? 'main' : $page) . '_mobile' . $min . '.css');
}
if ($page == 'tiers') {
    if ($_GET['mobile']) {
        array_push($css, '../tiers/sprites_mobile' . $min . '.css');
    } else {
        array_push($css, '../tiers/sprites' . $min . '.css');
    }
}
if (isset($_COOKIE['theme']) && $page != 'tiers') {
    if ($page == 'error') {
        array_push($css, 'https://maribelhearn.com/assets/shared/dark' . $min . '.css');
    } else {
        array_push($css, 'dark' . $min . '.css');
    }
}
if ($page == 'tiers') {
    array_push($css, '../tiers/tiers_override.css');
}
foreach ($css as $css_file) {
    $css_content = file_get_contents($css_file);
    echo $css_content;
}
?>
