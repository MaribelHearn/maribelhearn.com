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
