<?php
header('Content-type: text/css');
$main = array('index', 'about', 'credits', 'privacy', 'error');
$other = array('thvote', 'tiers', 'slots');
$personal = array('history', 'c67');
$page = $_GET['page'];
if (in_array($page, $main)) {
    $directory = 'main';
} else if (in_array($page, $other)) {
    $directory = 'other';
} else if (in_array($page, $personal)) {
    $directory = 'personal';
} else {
    $directory = 'games';
}
echo 'body{background:url("../' . $directory . '/' . $page . '/' . $page . '.jpg") ' . $_GET['pos'] . ' no-repeat fixed;background-size:cover}';
?>
