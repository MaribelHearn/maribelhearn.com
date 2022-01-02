<!DOCTYPE html>
<?php
    session_start();
    include_once 'assets/shared/shared.php';
    $url = substr($_SERVER['REQUEST_URI'], 1);
	$page = preg_split('/\?/', $url)[0];
    if (str_starts_with($_SERVER['REQUEST_URI'], '/') && count(array_count_values(str_split($_SERVER['REQUEST_URI']))) == 1) {
        $page = 'index';
    }
    $page_path = 'assets/' . $page . '/' . $page . '.php';
    $status_code = empty($_GET['error']) ? '' : $_GET['error'];
    $page = redirect($page, $page_path, $_SERVER['REQUEST_URI'], $status_code);
    hit($page, $status_code);
    $page = preg_replace('/\//', '', $page);
    $json = file_get_contents('assets/' . $page . '/' . $page . '.json');
    $data = (object) json_decode($json, true);
    $use_index = array('index', 'about', 'privacy', 'error');
    $css_js_file = in_array($page, $use_index) ? 'index' : $page;
    $has_mobile_sheet = file_exists('assets/' . $css_js_file . '/' . (in_array($page, $use_index) ? 'main' : $page) . '_mobile.css');
    $favicon_ext = file_exists('assets/' . $page . '/'. $page . '.ico') ? '.ico' : '.png';
    $favicon = 'assets/' . $page . '/' . $page . $favicon_ext;
    if ($has_mobile_sheet) {
        require_once 'assets/shared/mobile_detect.php';
        $detect_device = new Mobile_Detect;
        $is_mobile = $detect_device -> isMobile();
    } else {
        $is_mobile = false;
    }
    $css_href = ($page == 'error' ? 'https://maribelhearn.com/' : '') . 'assets/shared/css_concat.php?page=' . $css_js_file . '&mobile=' . $is_mobile;
    $js_href = ($page == 'error' ? 'https://maribelhearn.com/' : '') . 'assets/shared/js_concat.php?page=' . $css_js_file . '&mobile=' . $is_mobile;
    $favicon_dir = ($page == 'error' ? 'https://maribelhearn.com/' : '') . (!in_array($page, $use_index) ? 'assets/' . $page : '');
    $bg_pos = background_position($page);
    $lang_code = lang_code();
    $file_upload = handle_file_upload();
    if (!empty($file_upload) && strpos($file_upload, '<') === false) {
        $_SESSION['data'] = $file_upload;
        unset($_POST);
        header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
        exit();
    }
?>
<html id='top' lang='<?php echo $lang_code ?>'>

    <head>
		<title><?php echo property_exists($data, $lang_code) ? $data->{$lang_code} : (property_exists($data, 'title') ? $data->title : '') ?></title>
		<meta charset='UTF-8'>
        <?php if ($page == 'privacy') { echo '<meta name="robots" content="noindex">'; } ?>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='<?php echo property_exists($data, 'description') ? $data->description : '' ?>'>
        <meta name='keywords' content='<?php echo property_exists($data, 'keywords') ? $data->keywords : '' ?>'>
        <meta name='msapplication-TileColor' content='#da532c'>
        <meta name='theme-color' content='#ffffff'>
        <link rel='preload' type='font/woff2' href='<?php echo $page == 'error' ? 'https://maribelhearn.com/' : '' ?>assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' href='<?php echo $css_href ?>'>
        <link rel='apple-touch-icon' sizes='180x180' href='apple-touch-icon.png'>
        <?php if (!in_array($page, $use_index)) { echo '<link rel="icon" type="image/' . ($favicon_ext == '.ico' ? 'x-icon' : 'png') . '" href="' . $favicon_dir . '/' . $page . $favicon_ext . '">'; } ?>
        <link rel='manifest' href='site.webmanifest'>
        <link rel='mask-icon' href='safari-pinned-tab.svg' color='#5bbad5'>
        <script src='<?php echo $js_href ?>' defer></script>
    </head>

    <body>
        <nav data-html2canvas-ignore>
            <div id='nav' class='wrap'><?php echo navbar($page) ?></div>
        </nav>
        <main><?php if ($page == 'error') { include_once 'assets/error/error.php'; } else { include_once $page_path; } ?></main>
        <?php if (!$is_mobile || $page != 'tiers') {
            echo '<script nonce="' . file_get_contents('.stats/nonce') . '" defer>document.body.style.background="url(\'' . ($page == 'error' ? 'https://maribelhearn.com/' : '') . 'assets/' . $css_js_file . '/' . $css_js_file . '.jpg\') ';
            echo $bg_pos . ' no-repeat fixed";document.body.style.backgroundSize="cover"</script>';
            echo '<noscript><link rel="stylesheet" href="assets/shared/noscript_bg.php?page=' . $css_js_file . '&pos=' . $bg_pos . '"></noscript>';
        }
        var_dump($_SESSION);
        if (isset($_SESSION) && array_key_exists('data', $_SESSION)) {
            if (strpos($_SESSION['data'], '<') === false) {
                echo '<input id="import" type="hidden" value="' . file_get_contents($_SESSION['data']) . '">';
                unlink($_SESSION['data']);
                unset($_SESSION['data']);
            } else if (strpos($_SESSION['data'], '<') !== false) {
                echo '<input id="error" type="hidden" value="' . htmlentities($_SESSION['data']) . '">';
            }
        } ?>
    </body>

</html>
