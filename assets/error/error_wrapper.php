<!DOCTYPE html>
<?php
    include_once '../shared/shared.php';
    $page = 'error';
    hit($page);
    $json = file_get_contents('error.json');
    $data = (object) json_decode($json, true);
    $favicon = 'favicon.ico';
    $is_mobile = false;
    $css_js_file = 'index';
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
        <title><?php echo property_exists($data, $lang_code) ? $data->{$lang_code} : (property_exists($data, 'title') ? $data->title : '') ?></title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width'>
        <meta name='description' content='<?php echo property_exists($data, 'description') ? $data->description : '' ?>'>
        <meta name='keywords' content='<?php echo property_exists($data, 'keywords') ? $data->keywords : '' ?>'>
        <link rel='preload' type='font/woff2' href='https://maribelhearn.com/assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='https://maribelhearn.com/assets/shared/css_concat.php?page=<?php echo $css_js_file . '&mobile=' . $is_mobile ?>'>
        <link rel='icon' type='image/x-icon' href='https://maribelhearn.com/<?php echo (file_exists($favicon) ? $favicon : 'favicon.ico') ?>'>
        <script src='https://maribelhearn.com/assets/shared/js_concat.php?page=<?php echo $css_js_file . '&mobile=' . $is_mobile ?>' defer></script>
    </head>

    <body>
        <nav data-html2canvas-ignore>
            <div id='nav' class='wrap'><?php echo navbar('error') ?></div>
        </nav>
        <main><?php include_once 'error.php' ?></main>
    </body>

</html>
