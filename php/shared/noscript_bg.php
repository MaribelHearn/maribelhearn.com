<?php
header('Content-type: text/css');
$main = array('index', 'about', 'credits', 'privacy', 'error');
$other = array('thvote', 'tiers', 'slots');
$personal = array('history', 'c67');
$page = !empty($_GET['page']) ? $_GET['page'] : '';
$pos = !empty($_GET['pos']) ? $_GET['pos'] : 0;
if (in_array($page, $main)) {
    $directory = 'main';
} else if (in_array($page, $other)) {
    $directory = 'other';
} else if (in_array($page, $personal)) {
    $directory = 'personal';
} else {
    $directory = 'games';
}
echo 'body{background:url("../' . $directory . '/' . $page . '/' . $page . '.jpg") ' . $pos . ' no-repeat fixed;background-size:cover}';
?>
