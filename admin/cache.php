<?php
$CACHE_FILE = '../.stats/cache';

function download_content(string $url) {
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

function fetch_country(string $ip) {
    $API_KEY = trim(str_replace(array('\r', '\n'), '', file_get_contents('../.stats/key')));
    $URL = 'https://api.ipinfodb.com/v3/ip-city/?key=' . $API_KEY . '&ip=%i&format=json';
    $fetch_url = str_replace('%i', $ip, $URL);
    $json = download_content($fetch_url);
    if ($json) {
        $data = json_decode($json, false);
        if ($data->statusCode == 'OK') {
            $country = format_country($data->countryName);
            echo 'Cached ' . $ip . '<br>';
            return $country;
        } else {
            echo 'Error while caching ' . $ip . '<br>';
        }
    } else {
        echo 'Error while fetching country for ' . $ip . '<br>';
    }
}

function add_cache_entries(string $path, object $cache, string $entries) {
    $entries = preg_split('/,/', $entries);
    foreach ($entries as $key => $entry) {
        if (property_exists($cache, $entry)) {
            echo 'Already cached ' . $entry . '<br>';
            continue;
        }
        $cache->{$entry} = fetch_country($entry);
    }
    $file = fopen($path, 'w');
    fwrite($file, json_encode($cache));
}

if (file_exists($CACHE_FILE)) {
    $json = file_get_contents($CACHE_FILE);
    $cache = (object) json_decode($json, true);
} else {
    $cache = (object) array();
}

if ($_GET['entries']) {
    add_cache_entries($CACHE_FILE, $cache, $_GET['entries']);
} else {
    echo 'No new cache entries.';
}
?>
