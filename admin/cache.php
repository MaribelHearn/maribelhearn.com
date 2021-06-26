<?php
$CACHE_FILE = '../.stats/cache';

function download_content(string $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($data === false) {
        echo 'Failed to use cURL to fetch country for ' . $ip . '<br>';
        return false;
    } else if ($status != 200) {
        echo 'Error ' . $status . ' while fetching country for ' . $ip . '<br>';
        return false;
    }
    curl_close($ch);
    return $data;
}

function format_country(string $country) {
    switch ($country) {
        case 'South Korea': return 'Korea';
        default: return $country;
    }
}

function fetch_country(string $ip) {
    $url = 'http://ip-api.com/json/' . $ip;
    $json = download_content($url);
    if ($json !== false) {
        $data = json_decode($json, false);
        if ($data->status == 'success') {
            $country = format_country($data->country);
            echo 'Cached ' . $ip . '<br>';
            return $country;
        } else {
            echo 'Error while caching ' . $ip . '<br>';
        }
    }
}

function add_cache_entries(string $path, object $cache, string $entries) {
    $delay = 1;
    $entries = preg_split('/,/', $entries);
    foreach ($entries as $key => $entry) {
        if (property_exists($cache, $entry)) {
            echo 'Already cached ' . $entry . '<br>';
            continue;
        }
        $cache->{$entry} = fetch_country($entry);
        sleep($switch);
        $delay = ($delay == 1 ? 2 : 1);
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
