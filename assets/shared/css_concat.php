<?php
header('Content-type: text/css');
$page = $_GET['page'];
$css = array(
    'shared-min.css',
    '../' . $page . '/' . ($page == 'index' ? 'main' : $page) . '-min.css'
);
foreach ($css as $css_file) {
    $css_content = file_get_contents($css_file);
    echo $css_content;
}
?>
