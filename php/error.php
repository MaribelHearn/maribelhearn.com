<?php
$error_code = empty($_GET['error']) ? '404' : $_GET['error'];
function error_title($error_code) {
    switch ($error_code) {
        case '400': return '400 Bad Request';
        case '401': return '401 Unauthorized';
        case '403': return '403 Forbidden';
        case '500': return '500 Internal Server Error';
        case '503': return '503 Service Unavailable';
        default: return '404 Not Found';
    }
}
function error_text($error_code) {
    switch ($error_code) {
        case '400': return 'Your browser sent a request that this server could not understand.';
        case '401': return 'You are not authorized to access this resource.';
        case '403': return 'You do not have permission to access this resource.';
        case '500': return 'The server encountered an internal error or misconfiguration and was unable to complete your request.';
        case '503': return 'The server could not handle your request.';
        default: return 'You got only 404 points? That\'s not a very good score. I would suggest you go for at least 1 billion!';
    }
}
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p class='center'><strong><?php
        $supported_errors = ['400', '401', '403', '500', '503'];
        if ($error_code == '404' || !in_array($error_code, $supported_errors)) {
            $description = '404 Not Found';
            $url = substr($_SERVER['REQUEST_URI'], 1);
            $closest_page = closest_page($url);
            $min_page = $closest_page[0];
            $min_distance = $closest_page[1];
            if (!empty($min_distance) && $min_distance < 5 && $min_distance >= 0) {
                $description .= ' - did you mean <a href="https://maribelhearn.com/' . $min_page . '">' . $min_page . '</a>?';
            }
            echo $description;
        } else {
            echo error_title($error_code);
        }
    ?></strong></p>
    <p class='wide center'><?php echo error_text($error_code) ?></p>
</div>
