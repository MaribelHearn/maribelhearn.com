<div id='wrap' class='wrap'>
    <?php
        echo wrap_top();
        if (!empty($_SESSION['subpage'])) {
            $subpage = $_SESSION['subpage'];
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
            }
            echo '<aside id="back"><a href="/thvote">&lt;= Back to Main Page</a></aside>';
        } else {
            $subpage = '';
        }
        $subpage_title = (object) array();
        $subpage_title->extras = 'Extra Statistics';
        $subpage_title->guide = 'Voting Guide';
        echo '<h1>THWiki Popularity Poll 2022 Results' . (!empty($subpage) ? ' - ' . $subpage_title->{$subpage} : '') . '</h1>';
        if (!empty($_GET['redirect'])) {
            echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        }
        if ($subpage == 'extras' || $subpage == 'guide') {
            include_once 'php/subpages/thvote/' . $subpage . '.php';
        } else if (empty($subpage)) {
            include_once 'php/subpages/thvote/main_page.php';
        } else {
            echo '<p>No such page.</p>';
        }
    ?>
</div>
