<?php include_once 'assets/other/thvote/thvote_code.php' ?>
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
        if (!empty($_GET['redirect'])) {
            echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        }
        if (!empty($subpage)) {
            include_once 'assets/other/thvote/subpages/' . $subpage . '.php';
        } else {
            include_once 'assets/other/thvote/subpages/main_page.php';
        }
    ?>
</div>
