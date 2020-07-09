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
		<title>Admin Panel</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&text=AdminPaelgHts&display=swap'>
        <link rel='stylesheet' type='text/css' href='../assets/index/main.css'>
		<link rel='icon' type='image/x-icon' href='../favicon.ico'>
        <script src='../assets/shared/utils.js' defer></script>
    </head>

    <body class='<?php echo check_webp() ?>'>
        <div id='wrap'>
            <img id='hy' src='../assets/shared/h-bar.png' title='Human Mode'>
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
            <p class='wide-top'>You are visiting this page on <strong id='device'></strong>.</p>
            <p>You are visiting this page using <strong id='os'></strong>.</p>
            <p>You are visiting this page using <strong id='browser'></strong>.</p>
            <p class='wide'><a href='/'>Back to Main Page</a></p>
        </div>
        <?php echo '<input id="token" type="hidden" value=' . file_get_contents('../.stats/token') . '>'; ?>
        <script src='detect.js'></script>
        <script src='admin.js'></script>
    </body>

</html>
