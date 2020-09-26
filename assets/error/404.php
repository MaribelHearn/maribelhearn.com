<!DOCTYPE html>
<html lang='en'>
<?php
    $json = file_get_contents('../../json/admin.json');
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

    <body class='<?php include '../../.stats/count.php'; echo check_webp() ?>'>
        <main>
            <div id='wrap'>
                <img id='hy' src='https://maribelhearn.com/assets/shared/h-bar.png' title='Human Mode'>
                <h1>404</h1>
                <p><strong>File not found<span id='didyoumean'></span></strong></p>
                <p>You got only 404 points? That's not a very good score. I would suggest you go for at least 1 billion!</p>
                <p><a id='backtomain' href='/'>Back to Main Page</a></p>
                <script src='https://maribelhearn.com/assets/shared/dark.js'></script>
            </div>
        </main>
    </body>

</html>
