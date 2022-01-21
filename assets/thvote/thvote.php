<?php include_once 'assets/thvote/thvote_code.php' ?>
<div id='wrap' class='wrap'>
    <?php
        if (!empty($subpage)) {
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
            }
            echo '<span id="back"><a href="/thvote">&lt;= Back to Main Page</a></span>';
        }
        echo wrap_top();
        echo '<h1>THWiki Popularity Poll 2021 Results' . (!empty($subpage) ? ' - Extra Statistics' : '') . '</h1>';
        if (!empty($subpage)) {
            include_once 'assets/thvote/subpages/' . $subpage . '.php';
        } else {
            include_once 'assets/thvote/subpages/main_page.php';
        }
    ?>
</div>
