<?php
$url = substr($_SERVER['REQUEST_URI'], 1);
if (empty($_GET['error']) || $_GET['error'] == '404') {
    $json = file_get_contents('../json/admin.json');
    $data = json_decode($json, true);
    if (isset($data[$url])) {
        header('Location: ' . $data[$url]);
        exit();
    }
    if (!strpos($url, '/')) {
        $min_distance = PHP_INT_MAX;
        foreach (glob('../../*') as $file) {
            if (strpos($file, '.php')) {
                $page = substr($file, 6, -4);
                $min_distance = min(levenshtein($url, $page), $min_distance);
                if (levenshtein($url, $page) <= $min_distance) {
                    $min_page = $page;
                }
            }
        }
        if ($min_distance < 3 && $min_distance >= 0) {
            echo 'Redirect triggered.';
            var_dump($min_page);
            var_dump($min_distance);
            $location = $_SERVER['SERVER_NAME'] !== 'localhost' ? 'https://maribelhearn.com/' : 'http://localhost/';
            header('Location: ' . $location . $min_page . '?redirect=' . $url);
        }
    }
}
function error_title() {
    switch ($_GET['error']) {
        case '400': return '400 Bad Request';
        case '401': return '401 Unauthorized';
        case '403': return '403 Forbidden';
        case '500': return '500 Internal Server Error';
        default: return '404 Not Found';
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
