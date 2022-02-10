<?php include_once 'assets/games/royalflare/royalflare_code.php' ?>
<div id='wrap' class='wrap'>
    <?php
        echo wrap_top();
        if (!empty($subpage)) {
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
                if (($tmp[0] == 'history' || $tmp[0] == 'standings') && !empty(game_to_abbr($tmp[1]))) {
                    echo '<span id="back"><a href="/royalflare/' . $tmp[1] . '">&lt;= ' . $tmp[1] . 'に帰る - Back to ' . $tmp[1] . '</a></span>';
                } else {
                    echo '<span id="back"><a href="/royalflare">&lt;= メインページに帰る - Back to Main Page</a></span>';
                }
            } else {
                echo '<span id="back"><a href="/royalflare">&lt;= メインページに帰る - Back to Main Page</a></span>';
            }
        }
    ?>
    <h1>Royalflare Archive<?php if (!empty($subpage)) { echo ' - ' . format_subpage($subpage); } ?></h1>
	<?php
		if (!empty($_GET['redirect'])) {
			echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
		}
        if (!empty($subpage)) {
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
                if (($tmp[0] == 'history' || $tmp[0] == 'standings') && !empty(game_to_abbr($tmp[1]))) {
                    include_once 'assets/games/royalflare/' . $tmp[0] . '/' . $tmp[1] . '.' . ($tmp[0] == 'standings' ? 'html' : 'php');
                    echo '<p><strong><a href="/royalflare/' . $tmp[1] . '">' . $tmp[1] . 'に帰る - Back to ' . $tmp[1] . '</a></strong></p>';
                } else {
                    $exists = false;
                    echo '<p>No such page.</p>';
                }
            } else {
                if ($subpage == 'search') {
                    include_once 'assets/games/royalflare/subpages/search.php';
                } else if ($subpage == 'th08a') {
                    include_once 'assets/games/royalflare/subpages/board.php';
                } else if ($subpage == 'th16') {
                    include_once 'assets/games/royalflare/subpages/board_th16.php';
                } else if ($subpage == 'th125') {
                    include_once 'assets/games/royalflare/subpages/board_th125.php';
                } else if ($subpage == 'th095' || $subpage == 'th125' || $subpage == 'th143' || $subpage == 'th165') {
                    include_once 'assets/games/royalflare/subpages/board_scene.php';
                } else {
                    if (!empty(game_to_abbr($subpage))) {
                        include_once 'assets/games/royalflare/subpages/board.php';
                    } else if (file_exists('assets/games/royalflare/subpages/' . $subpage . '.php')) {
                        include_once 'assets/games/royalflare/subpages/' . $subpage . '.php';
                    } else {
                        $exists = false;
                        echo '<p>No such page.</p>';
                    }
                }
            }
            if ($exists && strpos($subpage, 'standings') === false) {
                echo '<p><strong><a id="backtotop" href="#top">上に帰る - Back to Top</a></strong></p>';
            }
        } else {
            include_once 'assets/games/royalflare/subpages/main_page.php';
        }
	?>
</div>
