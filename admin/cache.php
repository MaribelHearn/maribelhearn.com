<?php
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

function fetch_country(string $ip) {
    $url = 'http://ip-api.com/json/' . $ip;
    $json = download_content($url);
    if ($json !== false) {
        $data = json_decode($json, false);
        if ($data->status == 'success') {
            $country = $data->country;
            return $country;
        }
    }
    exit();
}

function add_cache_entry(object $cache, string $entry) {
    global $CACHE_FILE;
    if (property_exists($cache, $entry)) {
        return;
    }
    $cache->{$entry} = fetch_country($entry);
    $file = fopen($CACHE_FILE, 'w');
    if (flock($file, LOCK_EX)) {
        sleep(2);
        fwrite($file, json_encode($cache));
        flock($file, LOCK_UN);
    }
}

$CACHE_FILE = '.stats/cache';
if (file_exists($CACHE_FILE)) {
    $json = file_get_contents($CACHE_FILE);
    $cache = (object) json_decode($json, true);
} else {
    $cache = (object) array();
}
if (array_key_exists(1, $argv)) {
    add_cache_entry($cache, $argv[1]);
}
?>
