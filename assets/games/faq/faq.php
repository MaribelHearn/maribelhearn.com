<div id='wrap' class='wrap'>
    <?php
        if (!empty($subpage) || !empty($_GET['p'])) {
            echo '<span id="backtomain"><a href="/faq">&lt;= Back to Main Page</a></span>';
        }
        echo wrap_top();
        echo '<h1>Frequently Asked Questions</h1>';
        if (!empty($_GET['redirect'])) {
            echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        }
        if (!empty($subpage)) {
            if ($subpage == 'gfx') $subpage = 'graphics';
            if ($subpage == 'res') $subpage = 'resources';
            $path = 'assets/games/faq/' . ($subpage == 'eosd' ? 'eosd' : 'subpages') . '/' . $subpage . '.php';
            if (file_exists($path)) {
                include_once $path;
            } else {
                echo '<p>No such page.</p>';
            }
        } else if (!empty($_GET['p'])) {
            $path = 'assets/games/faq/' . ($_GET['p'] == 'eosd' ? 'eosd' : 'subpages') . '/' . $_GET['p'] . '.php';
            if (file_exists($path)) {
                include_once $path;
            } else {
                echo '<p>No such page.</p>';
            }
        } else {
            include_once 'assets/games/faq/subpages/main_page.php';
        }
	?>
    <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
</div>
