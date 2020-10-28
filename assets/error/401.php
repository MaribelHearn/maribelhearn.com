<!DOCTYPE html>
<html lang='en'>
<?php
    include '../shared/navbar.php';
    include '../../.stats/count.php';
    hit(basename(__FILE__));
?>

    <head>
		<title>401 Unauthorized</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='https://maribelhearn.com/assets/error/error.css'>
		<link rel='icon' type='image/x-icon' href='https://maribelhearn.com/favicon.ico'>
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
                <h1>401</h1>
                <p><strong>Unauthorized</strong></p>
                <p>You got only 401 points? That's not a very good score. I would suggest you go for at least 1 billion!</p>
                <script src='https://maribelhearn.com/assets/shared/dark.js'></script>
            </div>
        </main>
    </body>

</html>
