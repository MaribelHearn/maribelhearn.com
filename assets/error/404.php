<!DOCTYPE html>
<html lang='en'>
<?php
    $max_sim = 0;
    $url = substr($_SERVER['REQUEST_URI'], 1);
    foreach (glob('../../*') as $file) {
        if (strpos($file, '.php')) {
            $page = substr($file, 6, -4);
            $max_sim = max(similar_text($url, $page), $max_sim);
            if (similar_text($url, $page) >= $max_sim) {
                $max_page = $page;
            }
        }
    }
    $len = strlen($max_page) - 3;
    if ($max_sim > 0 && $max_sim > $len) {
        header('Location: https://maribelhearn.com/' . $max_page . '?redirect=' . $url);
    }
    $json = file_get_contents('../json/admin.json');
    $data = json_decode($json, true);
    if (isset($data[$url])) {
        header('Location: ' . $data[$url]);
        exit();
    }
    include '../shared/shared.php';
    hit('404');
?>

    <head>
		<title>404 Not Found</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='https://maribelhearn.com/assets/index/main.css'>
		<link rel='icon' type='image/x-icon' href='https://maribelhearn.com/favicon.ico'>
        <?php echo dark_theme('error') ?>
    </head>

    <body class='<?php echo check_webp() ?>'>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar('error') ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack_admin'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a></p>
                <span id='hy_container'><img id='hy' src='https://maribelhearn.com/assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1>404</h1>
                <p><strong>File not found<?php
                    if ($max_sim > 0 && $max_sim > $len - 2) {
                        echo ' - did you mean <a href="https://maribelhearn.com/' . $max_page . '">' . $max_page . '</a>?';
                    }
                ?></strong></p>
                <p class='wide'>You got only 404 points? That's not a very good score. I would suggest you go for at least 1 billion!</p>
                <p id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</p>
                <script src='https://maribelhearn.com/assets/shared/dark.js'></script>
            </div>
        </main>
    </body>

</html>
