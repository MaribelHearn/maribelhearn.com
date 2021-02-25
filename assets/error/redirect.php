<?php
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
$json = file_get_contents('../json/admin.json');
$data = json_decode($json, true);
if (isset($data[$url])) {
    header('Location: ' . $data[$url]);
    exit();
}
?>
