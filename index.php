<!DOCTYPE html>
<?php
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
    $has_mobile_sheet = file_exists('assets/' . $page . '/' . $page . '_mobile.css');
    $favicon_ext = file_exists('assets/' . $page . '/'. $page . '.ico') ? '.ico' : '.png';
    $favicon = 'assets/' . $page . '/' . $page . $favicon_ext;
    if ($has_mobile_sheet) {
        require_once 'assets/shared/mobile_detect.php';
        $detect_device = new Mobile_Detect;
        $is_mobile = $detect_device -> isMobile();
    } else {
        $is_mobile = false;
    }
    $use_index = array('about', 'privacy', 'error');
    $css_js_file = in_array($page, $use_index) ? 'index' : $page;
    $css_href = ($page == 'error' ? 'https://maribelhearn.com/' : '') . 'assets/shared/css_concat.php?page=' . $css_js_file . '&mobile=' . $is_mobile;
    $favicon_href = ($page == 'error' ? 'https://maribelhearn.com/' : '') . (file_exists($favicon) ? $favicon : 'favicon.ico');
    $js_href = ($page == 'error' ? 'https://maribelhearn.com/' : '') . 'assets/shared/js_concat.php?page=' . $css_js_file . '&mobile=' . $is_mobile;
    $bg_pos = background_position($page);
    $lang_code = lang_code();
?>
<html id='top' lang='<?php echo $lang_code ?>'>

    <head>
		<title><?php echo property_exists($data, $lang_code) ? $data->{$lang_code} : (property_exists($data, 'title') ? $data->title : '') ?></title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='<?php echo property_exists($data, 'description') ? $data->description : '' ?>'>
        <meta name='keywords' content='<?php echo property_exists($data, 'keywords') ? $data->keywords : '' ?>'>
        <link rel='preload' type='font/woff2' href='<?php echo $page == 'error' ? 'https://maribelhearn.com/' : '' ?>assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' href='<?php echo $css_href ?>'>
		<link rel='icon' type='image/x-icon' href='<?php echo $favicon_href ?>'>
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
        } ?>
    </body>

</html>
