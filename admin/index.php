<!DOCTYPE html>
<html lang='en' class='no-js'>
<?php
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
        <link rel='stylesheet' type='text/css' href='../assets/index/main.css'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&display=swap'>
		<link rel='icon' type='image/x-icon' href='../favicon.ico'>
        <script src='../assets/shared/utils.js' defer></script>
        <script src='../assets/shared/modernizr-custom.js' defer></script>
        <script>document.documentElement.classList.remove("no-js");
        function set(){setCookie("token",<?php echo file_get_contents('.stats/token') ?>);
        document.getElementById("set").style="display:block"}</script>
    </head>

    <body>
        <div id='wrap'>
            <h1>Admin Panel</h1>
            <p><input type='button' value='Set Blocking Cookie' onClick='set()'></p>
            <p id='set' style='display:none'>Blocking cookie set!</p>
            <?php
                if ($hitcount === false) {
                    echo '<p>No stats for today yet.</p>';
                } else {
                    echo '<h2>Page Hits</h2>';
                    foreach ($stats as $key => $value) {
                        echo '<strong>' . $key . '</strong> ' . $value . '<br>';
                    }
                }
            ?>
            <p><a href='/'>Back to Main Page</a></p>
        </div>
    </body>

</html>
