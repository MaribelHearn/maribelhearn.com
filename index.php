<!DOCTYPE html>
<?php
    include 'assets/shared/shared.php';
	$page = preg_split('/\?/', str_replace('/', '', $_SERVER['REQUEST_URI']))[0];
    if ($_SERVER['REQUEST_URI'] == '/') {
        $page = 'index';
    }
    $page_path = 'assets/' . $page . '/' . $page . '.php';
    if (!file_exists($page_path) && $page != 'index') {
        $page = 'error';
    }
    hit($page);
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
    echo '<html lang="';
    if (empty($_GET['hl']) && !isset($_COOKIE['lang'])) {
        $lang_code = 'en';
    } else if (!empty($_GET['hl'])) {
        $iso = preg_split('/-/', $_GET['hl'])[0];
        $iso = str_replace('jp', 'ja', $iso);
        $iso = str_replace('ru', 'zh', $iso);
        $lang_code = $iso;
    } else if (isset($_COOKIE['lang'])) {
		if (str_replace('"', '', $_COOKIE['lang']) == 'Russian') {
			$lang_code = 'zh';
		} else if (str_replace('"', '', $_COOKIE['lang']) == 'Chinese') {
			$lang_code = 'zh';
		} else if (str_replace('"', '', $_COOKIE['lang']) == 'Japanese') {
			$lang_code = 'ja';
		} else {
			$lang_code = 'en';
		}
	}
    echo $lang_code . '">';
?>

    <head>
		<title><?php echo property_exists($data, $lang_code) ? $data->{$lang_code} : $data->title ?></title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='<?php echo $data->description ?>'>
        <meta name='keywords' content='<?php echo $data->keywords ?>'>
        <link rel='preload' type='font/woff2' href='<?php echo $page == 'error' ? 'https://maribelhearn.com/' : '' ?>assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='<?php echo $page == 'error' ? 'https://maribelhearn.com/' : '' ?>assets/shared/css_concat.php?page=<?php echo $css_js_file . '&mobile=' . $is_mobile ?>'>
		<link rel='icon' type='image/x-icon' href='<?php echo ($page == 'error' ? 'https://maribelhearn.com/' : '') . (file_exists($favicon) ? $favicon : 'favicon.ico') ?>'>
        <script src='<?php echo $page == 'error' ? 'https://maribelhearn.com/' : '' ?>assets/shared/js_concat.php?page=<?php echo $css_js_file . '&mobile=' . $is_mobile ?>' defer></script>
    </head>

    <body>
        <nav data-html2canvas-ignore>
            <div id='nav' class='wrap'><?php echo navbar($page) ?></div>
        </nav>
        <main><?php if ($page == 'error') { include_once 'assets/error/error.php'; } else { include_once $page_path; } ?></main>
    </body>

</html>
