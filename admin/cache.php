<?php
function download_content(string $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($data === false) {
        echo 'Failed to use cURL to fetch country for ' . $ip . '<br>';
        curl_close($ch);
        return false;
    } else if ($status != 200) {
        echo 'Error ' . $status . ' while fetching country for ' . $ip . '<br>';
        curl_close($ch);
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
            echo 'Fetched country ' . $country;
            return $country;
        }
    }
    echo 'Failed to fetch country (possibly local IP)';
    exit();
}

function add_cache_entry(object $cache, string $ip) {
    $country = fetch_country($ip);
    $cache->exec('INSERT INTO Cache (IP, Country) VALUES ("' . $ip . '", "' . $country . '")');
}

class Cache extends SQLite3 {
    function __construct() {
        $path = '.stats/cache.db';
        if (!file_exists($path)) {
            $this->open($path);
            $this->exec('CREATE TABLE Cache ( IP varchar(15) UNIQUE, Country varchar(255) )');
        } else {
            $this->open($path);
        }
    }
}

$cache = new Cache();
if (array_key_exists(1, $argv)) {
    add_cache_entry($cache, $argv[1]);
}
?>
