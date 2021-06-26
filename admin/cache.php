<?php
$CACHE_FILE = '../.stats/cache';
$API_KEY = trim(str_replace(array('\r', '\n'), '', file_get_contents('../.stats/key')));
$URL = 'http://api.ipinfodb.com/v3/ip-city/?key=' . $API_KEY . '&ip=%i&format=json';

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
    $entries = preg_split('/,/', $_GET['entries']);
    foreach ($entries as $key => $entry) {
        $current_url = str_replace('%i', $entry, $URL);
        $json = file_get_contents($current_url);
        $data = json_decode($json, true);
        $data = (object) $data;
        if ($data->statusCode == 'OK') {
            $cache->{$entry} = format_country($data->countryName);
            echo 'Cached ' . $entry . '<br>';
        } else {
            echo 'Error while caching ' . $entry . '<br>';
        }
    }
    $file = fopen($CACHE_FILE, 'w');
    fwrite($file, json_encode($cache));
} else {
    echo 'No new cache entries.';
}
?>
