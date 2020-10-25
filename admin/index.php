<!DOCTYPE html>
<html lang='en'>
<?php
    include '../.stats/count.php';
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
        <link rel='stylesheet' type='text/css' href='admin.css'>
		<link rel='icon' type='image/x-icon' href='../favicon.ico'>
        <script src='../assets/shared/utils.js' defer></script>
    </head>

    <body class='<?php echo check_webp() ?>'>
        <nav>
            <div id='nav' class='wrap'><?php echo file_get_contents('nav.html'); ?></div>
        </nav>
        <main>
            <div id='wrap' class='wrap'>
                <span id='links'><a href='/'>Back to Main Page</a></span>
                <img id='hy' src='../assets/shared/h-bar.png' alt='Human-youkai gauge' title='Human Mode'>
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
            </div>
        </main>
        <?php echo '<input id="token" type="hidden" value=' . file_get_contents('../.stats/token') . '>'; ?>
        <script src='detect.js'></script>
        <script src='admin.js'></script>
    </body>

</html>
