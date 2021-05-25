<!DOCTYPE html>
<html lang='en'>
<?php
    include '../shared/shared.php';
    include 'functions.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

    <head>
		<title><?php echo error_title() ?></title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='preload' type='font/woff2' href='https://maribelhearn.com/assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <link rel='stylesheet' type='text/css' href='https://maribelhearn.com/assets/shared/css_concat.php?page=index'>
		<link rel='icon' type='image/x-icon' href='https://maribelhearn.com/favicon.ico'>
        <script src='https://maribelhearn.com/assets/shared/js_concat.php?page=error' defer></script>
        <?php echo dark_theme('error') ?>
    </head>

    <body>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack_admin'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a></p>
                <span id='hy_container'><span id='hy'></span>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1><?php echo empty($_GET['error']) ? '404' : $_GET['error'] ?></h1>
                <p><strong><?php echo error_description() ?></strong></p>
                <p class='wide'><?php echo error_text() ?></p>
                <p id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</p>
            </div>
        </main>
    </body>

</html>
