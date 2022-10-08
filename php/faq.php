<div id='wrap' class='wrap'>
    <?php
        echo wrap_top();
        if (!empty($subpage) || !empty($_GET['p'])) {
            echo '<span id="back"><a href="/faq">&lt;= Back to Main Page</a></span>';
        }
        echo '<h1>Frequently Asked Questions</h1>';
        if (!empty($_GET['redirect'])) {
            echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        }
        if (!empty($subpage)) {
            if ($subpage == 'gfx') $subpage = 'graphics';
            if ($subpage == 'res') $subpage = 'resources';
            $path = 'php/subpages/faq/' . $subpage . '.php';
            if (file_exists($path)) {
                include_once $path;
            } else {
                echo '<p>No such page.</p>';
            }
        } else if (!empty($_GET['p'])) {
            $path = 'php/subpages/faq/' . $_GET['p'] . '.php';
            if (file_exists($path)) {
                include_once $path;
            } else {
                echo '<p>No such page.</p>';
            }
        } else {
            include_once 'php/subpages/faq/main_page.php';
        }
	?>
    <p><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
</div>
