<!DOCTYPE html>
<?php
    session_start();
    include_once 'php/shared/http.php';
    include_once 'php/shared/index_utils.php';
    include_once 'php/shared/shared.php';
    include_once 'php/shared/navbar.php';
    require_once 'php/shared/mobile_detect.php';

    // Determine page name
    $url = substr($_SERVER['REQUEST_URI'], 1);
	$page = preg_split('/\?/', $url)[0];
    if (empty($page) || str_starts_with($_SERVER['REQUEST_URI'], '/') && count(array_count_values(str_split($_SERVER['REQUEST_URI']))) == 1) {
        $page = 'index';
    }

    // Handle subpages
    if (strpos($page, '/') !== false) {
        $tmp = preg_split('/\//', $page);
        $subpage = $tmp[1];
        $mainpage = $tmp[0];
        if ($mainpage == 'royalflare' || $mainpage == 'thvote' || $mainpage == 'faq') {
            if (count($tmp) == 3) {
                $subpage .= '/' . $tmp[2];
            }
            $page = $mainpage;
            $_SESSION['subpage'] = $subpage;
        }
    } else {
        unset($_SESSION['subpage']);
    }

    // Check for redirection
    $status_code = empty($_GET['error']) ? '' : $_GET['error'];
    $page_path = 'php/' . $page . '.php'; // without subdir
    $page = redirect($page, $page_path, $status_code);

    // Record page hit
    if ($page == 'error' && empty($status_code)) {
        $status_code = '404';
    }
    if (!empty($status_code)) {
        http_response_code(intval($status_code));
    }
    hit($page, $status_code);

    // Set page language
    $lang = set_lang_cookie();
    $locale = $lang . '.UTF-8';
    if (has_translation($page)) {
        setlocale(LC_ALL, $locale);
        bindtextdomain($lang, 'locale');
        textdomain($lang);
    }

    // Background position
    function background_position($page) {
        $top = array('c67', 'drc', 'history', 'survival', 'slots', 'tools');
        $bottom = array('fangame', 'lnn', 'scoring', 'wr');
        if (in_array($page, $top)) {
            return 'top';
        } else if (in_array($page, $bottom)) {
            return 'bottom';
        } else {
            return 'center';
        }
    }

    // Resource paths
    $use_index = array('index', 'about', 'contact', 'credits', 'privacy', 'error');
    $dir = directory($page, $use_index);
    $page_path = 'php/' . $page . '.php';
    $page_tree = file_get_contents('php/page_tree.json');
    $data = (object) json_decode($page_tree, true);
    $data = property_exists($data, $page) ? (object) $data->{$page} : (object) array();
    $css_js_file = in_array($page, $use_index) ? 'index' : $page;
    $favicon_ext = file_exists('assets/' . $dir . '/' . $page . '/'. $page . '.ico') ? '.ico' : '.png';
    $favicon = 'assets/' . $page . '/' . $page . $favicon_ext;
    $detect_device = new Mobile_Detect;
    $is_mobile = $detect_device -> isMobile();
    $css_href = ($page == 'error' ? 'https://maribelhearn.com/' : '/') . 'php/shared/css_concat.php?page=' . $css_js_file . '&mobile=' . $is_mobile;
    $js_href = ($page == 'error' ? 'https://maribelhearn.com/' : '/') . 'php/shared/js_concat.php?page=' . $css_js_file . '&mobile=' . $is_mobile . '&hl=' . $lang;
    $favicon_dir = ($page == 'error' ? 'https://maribelhearn.com/' : '/') . (!in_array($page, $use_index) ? 'assets/' . $dir . '/' . $page : '');
    $bg_pos = background_position($page);

    // File uploads and theme changes
    $file_upload = handle_file_upload();
    if (!empty($_GET['theme'])) {
        set_theme_cookie($_GET['theme']);
        $page = ($page == 'index' ? '/' : preg_split('/\?/', $_SERVER['REQUEST_URI'])[0]);
        header("Location: {$page}", true, 303);
        exit();
    }
    if (!empty($file_upload)) {
        $_SESSION['data'] = $file_upload;
        unset($_POST);
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        exit();
    }
?>
<html id='top' lang='<?php echo lang_code() ?>'>

    <head>
		<title><?php echo (isset($_SESSION['subpage']) ? subpage_name($_SESSION['subpage']) . ' - ' : '') . (property_exists($data, 'title') ? _($data->title) : 'maribelhearn.com/' . $url) ?></title>
		<meta charset='UTF-8'>
        <?php if ($page == 'privacy') { echo '<meta name="robots" content="noindex">'; } ?>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='<?php echo property_exists($data, 'description') ? $data->description : '' ?>'>
        <meta name='keywords' content='<?php echo property_exists($data, 'keywords') ? $data->keywords : '' ?>'>
        <meta name='msapplication-TileColor' content='#da532c'>
        <meta name='theme-color' content='#ffffff'>
        <?php if (property_exists($data, 'description')) {
            echo '<meta name="og:title" content="' . $data->title . '">' .
            '<meta name="og:url" content="https://maribelhearn.com/' . $url . '">' .
            '<meta name="og:description" content="' . $data->description . '">' .
            '<meta name="og:image" content="https://maribelhearn.com/assets/' . $dir . '/' . $page . '/' . $page . '_og.jpg">' .
            '<meta property="og:image:width" content="500"><meta property="og:image:height" content="256">';
        } ?>
        <link rel='preload' type='font/woff2' href='<?php echo $page == 'error' ? 'https://maribelhearn.com/' : '/' ?>assets/shared/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' href='<?php echo $css_href ?>'>
        <link rel='apple-touch-icon' sizes='180x180' href='/apple-touch-icon.png'>
        <?php if (!in_array($page, $use_index)) { echo '<link rel="icon" type="image/' . ($favicon_ext == '.ico' ? 'x-icon' : 'png') . '" href="' . $favicon_dir . '/' . $page . $favicon_ext . '">'; } ?>
        <link rel='manifest' href='/site.webmanifest'>
        <link rel='mask-icon' href='/safari-pinned-tab.svg' color='#5bbad5'>
        <script src='<?php echo $js_href ?>' defer></script>
    </head>

    <body>
        <?php if ($page != 'tiers') { echo '<nav data-html2canvas-ignore><div id="nav" class="wrap">' . navbar($page) . '</div></nav>'; } ?>
        <main><?php if ($page == 'error') { include_once 'php/error.php'; } else { include_once $page_path; } ?></main>
        <?php include_once 'php/shared/postscript.php'; ?>
    </body>

</html>
