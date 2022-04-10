<?php include_once 'assets/other/thvote/thvote_code.php' ?>
<div id='wrap' class='wrap'>
    <?php
        echo wrap_top();
        if (!empty($subpage)) {
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
            }
            echo '<span id="back"><a href="/thvote">&lt;= Back to Main Page</a></span>';
        }
        echo '<h1>THWiki Popularity Poll 2021 Results' . ($subpage == 'extras' ? ' - Extra Statistics' : '') . '</h1>';
        if (!empty($_GET['redirect'])) {
            echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        }
        if ($subpage == 'extras') {
            include_once 'assets/other/thvote/subpages/' . $subpage . '.php';
        } else if (empty($subpage)) {
            include_once 'assets/other/thvote/subpages/main_page.php';
        } else {
            echo '<p>No such page.</p>';
        }
    ?>
</div>
