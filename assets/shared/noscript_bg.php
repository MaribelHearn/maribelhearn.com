<?php
header('Content-type: text/css');
echo 'body{background:url("../' . $_GET['page'] . '/' . $_GET['page'] . '.jpg") ' . $_GET['pos'] . ' no-repeat fixed;background-size:cover}';
?>
