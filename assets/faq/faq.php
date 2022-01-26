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
            include_once 'assets/faq/' . ($subpage == 'eosd' ? 'eosd' : 'subpages') . '/' . $subpage . '.php';
        } else if (!empty($_GET['p'])) {
            include_once 'assets/faq/' . ($subpage == 'eosd' ? 'eosd' : 'subpages') . '/' . $_GET['p'] . '.php';
        } else {
            include_once 'assets/faq/subpages/main_page.php';
        }
	?>
    <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
</div>
