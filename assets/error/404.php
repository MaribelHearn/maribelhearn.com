<!DOCTYPE html>
<html lang='en'>
<?php
    include '../shared/navbar.php';
    include '../../.stats/count.php';
    hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
    $json = file_get_contents('../json/admin.json');
    $data = json_decode($json, true);
    $url = substr($_SERVER['REQUEST_URI'], 1);
    if (isset($data[$url])) {
        header('Location: ' . $data[$url]);
        exit();
    }
?>

    <head>
		<title>404 Not Found</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='https://maribelhearn.com/assets/error/error.css'>
		<link rel='icon' type='image/x-icon' href='https://maribelhearn.com/favicon.ico'>
		<script src='https://maribelhearn.com/assets/error/404.js' defer></script>
    </head>

    <body class='<?php echo check_webp() ?>'>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar('error') ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</p>
                <img id='hy' src='https://maribelhearn.com/assets/shared/h-bar.png' title='Human Mode'>
                <h1>404</h1>
                <p><strong>File not found<span id='didyoumean'></span></strong></p>
                <p>You got only 404 points? That's not a very good score. I would suggest you go for at least 1 billion!</p>
                <script src='https://maribelhearn.com/assets/shared/dark.js'></script>
            </div>
        </main>
    </body>

</html>
