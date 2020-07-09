<!DOCTYPE html>
<html lang='en'>

    <head>
		<title>401 Unauthorized</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Felipa&text=401&display=swap'>
        <link rel='stylesheet' type='text/css' href='https://maribelhearn.com/assets/error/error.css'>
		<link rel='icon' type='image/x-icon' href='https://maribelhearn.com/favicon.ico'>
    </head>

    <body class='<?php include '.stats/count.php'; echo check_webp() ?>'>
        <div id='wrap'>
            <img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
            <h1>401</h1>
            <p><strong>Unauthorized</strong></p>
            <p>You got only 401 points? That's not a very good score. I would suggest you go for at least 1 billion!</p>
            <p><a id='backtomain' href='/'>Back to Main Page</a></p>
        </div>
        <script src='assets/shared/dark.js'></script>
    </body>

</html>
