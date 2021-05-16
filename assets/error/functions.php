<?php
if (empty($_GET['error']) || $_GET['error'] == '404') {
    $json = file_get_contents('../json/admin.json');
    $data = json_decode($json, true);
    if (isset($data[$url])) {
        header('Location: ' . $data[$url]);
        exit();
    }
}
function error_title() {
    if (empty($_GET['error']) || $_GET['error'] == '404') {
        return '404 Not Found';
    }
    switch ($_GET['error']) {
        case '400': return '400 Bad Request';
        case '401': return '401 Unauthorized';
        case '403': return '403 Forbidden';
        case '500': return '500 Internal Server Error';
        default: return '404 Not Found';
    }
}
function error_description_sub() {
    $description = '404 Not Found';
    $url = substr($_SERVER['REQUEST_URI'], 1);
    if (!strpos($url, '/')) {
        $max_sim = 0;
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
            $location = $_SERVER['SERVER_NAME'] !== 'localhost' ? 'https://maribelhearn.com/' : 'http://localhost/';
            header('Location: ' . $location . $max_page . '?redirect=' . $url);
        }
    }
    if ($max_sim > 0 && $max_sim > $len - 2) {
        $description .= ' - did you mean <a href="https://maribelhearn.com/' . $max_page . '">' . $max_page . '</a>?';
    }
    return $description;
}
function error_description() {
    $supported_errors = ['400', '401', '403', '500'];
    if (empty($_GET['error']) || $_GET['error'] == '404') {
        return error_description_sub();
    } else if (in_array($_GET['error'], $supported_errors)) {
        return error_title();
    } else {
        return error_description_sub();
    }
}
function error_text() {
    if (empty($_GET['error']) || $_GET['error'] == '404') {
        return 'You got only 404 points? That\'s not a very good score. I would suggest you go for at least 1 billion!';
    }
    switch ($_GET['error']) {
        case '400': return 'Your browser sent a request that this server could not understand.';
        case '401': return 'You are not authorized to access this resource.';
        case '403': return 'You do not have permission to access this resource.';
        case '500': return 'The server encountered an internal error or misconfiguration and was unable to complete your request.';
        default: 'You got only 404 points? That\'s not a very good score. I would suggest you go for at least 1 billion!';
    }
}
?>
