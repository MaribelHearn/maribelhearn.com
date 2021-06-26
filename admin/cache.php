<?php
$CACHE_FILE = '../.stats/cache';
$API_KEY = trim(str_replace(array('\r', '\n'), '', file_get_contents('../.stats/key')));
$URL = 'https://api.ipinfodb.com/v3/ip-city/?key=' . $API_KEY . '&ip=%i&format=json';

function download_content($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox 78.0');
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function format_country(string $country) {
    switch ($country) {
        case 'Viet Nam': return 'Vietnam';
        case 'Russian Federation': return 'Russia';
        case 'Korea (Republic of)': return 'Korea';
        case 'Taiwan (Province of China)': return 'Taiwan';
        case 'United States of America': return 'United States';
        case 'Venezuela (Bolivarian Republic of)': return 'Venezuela';
        case 'United Kingdom of Great Britain and Northern ': return 'United Kingdom';
        default: return $country;
    }
}

if (file_exists($CACHE_FILE)) {
    $json = file_get_contents($CACHE_FILE);
    $cache = (object) json_decode($json, true);
} else {
    $cache = (object) array();
}

if ($_GET['entries']) {
    var_dump($_GET['entries']);
    echo '<br>';
    $entries = preg_split('/,/', $_GET['entries']);
    foreach ($entries as $key => $entry) {
        if (property_exists($cache, $entry)) {
            echo 'Already cached ' . $entry . '<br>';
            continue;
        }
        $current_url = str_replace('%i', $entry, $URL);
        $json = download_content($current_url);
        if ($json) {
            $data = json_decode($json, true);
            $data = (object) $data;
            if ($data->statusCode == 'OK') {
                $cache->{$entry} = format_country($data->countryName);
                echo 'Cached ' . $entry . '<br>';
            } else {
                echo 'Error while caching ' . $entry . '<br>';
            }
        } else {
            echo 'Error while fetching country for ' . $entry . '<br>';
        }
    }
    $file = fopen($CACHE_FILE, 'w');
    fwrite($file, json_encode($cache));
} else {
    echo 'No new cache entries.';
}
?>
