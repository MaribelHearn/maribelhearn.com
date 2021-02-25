<!DOCTYPE html>
<html lang='en'>
<?php
    include '../assets/shared/shared.php';
    $hitcount = '../.stats/' . date('d-m-Y') . '.json';
    if (file_exists($hitcount)) {
        $json = file_get_contents($hitcount);
        $stats = json_decode($json, true);
        arsort($stats);
    } else {
        $hitcount = false;
    }
?>

    <head>
		<title>Admin Panel - Maribel Hearn's Touhou Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='../assets/shared/css_concat.php?page=index'>
		<link rel='icon' type='image/x-icon' href='../favicon.ico'>
        <script src='../assets/shared/js_concat.php?page=admin' defer></script>
        <?php echo dark_theme('admin') ?>
    </head>

    <body>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar('admin') ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack_admin'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a></p>
                <span id='hy_container'><img id='hy' src='../assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1>Admin Panel</h1>
                <p><input id='setcookie' type='button' value='Set Blocking Cookie'></p>
                <?php
                    if ($hitcount === false) {
                        echo '<p class="wide">No stats for today yet.</p>';
                    } else {
                        echo '<h2>Page Hits</h2>';
                        foreach ($stats as $key => $value) {
                            echo '<p><strong>' . $key . '</strong> ' . $value . '</p>';
                        }
                    }
                ?>
                <p class='wide-top'>You are visiting this page using <strong id='os'></strong>.</p>
                <p>You are visiting this page using <strong id='browser'></strong>.</p>
                <p id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</p>
            </div>
        </main>
        <?php echo '<input id="token" type="hidden" value=' . file_get_contents('../.stats/token') . '>'; ?>
    </body>

</html>
