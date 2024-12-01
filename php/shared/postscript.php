<?php
// Called from root index.php (as well as WR/LNN on database error)
// To run after generating the page content

// Define nonce
if (!file_exists('.stats/nonce')) {
    $nonce = generate_string();
} else {
    $nonce = file_get_contents('.stats/nonce');
}

// Deferred page background
if (!$is_mobile || $page != 'slots' && $page != 'thvote' && $page != 'tiers') {
    echo '<script nonce="' . $nonce . '">document.body.style.background="url(\'' . ($page == 'error' ? 'https://maribelhearn.com/' : '/') . 'assets/' . $dir . '/' . $css_js_file . '/' . $css_js_file . '.jpg\') ';
    echo $bg_pos . ' no-repeat fixed";document.body.style.backgroundSize="cover"</script>';
    echo '<noscript><link rel="stylesheet" href="/php/shared/noscript_bg.php?page=' . $css_js_file . '&pos=' . $bg_pos . '"></noscript>';
}

// Session data
if (isset($_SESSION) && array_key_exists('data', $_SESSION)) {
    if (strpos($_SESSION['data'], '<') === false) {
        echo '<input id="import" type="hidden" value="' . file_get_contents($_SESSION['data']) . '">';
        unlink($_SESSION['data']);
    } else if (strpos($_SESSION['data'], '<') !== false) {
        echo '<input id="error" type="hidden" value="' . htmlentities($_SESSION['data']) . '">';
    }
    unset($_SESSION['data']);
}
?>