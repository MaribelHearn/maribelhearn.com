<!DOCTYPE html>
<html lang='en'>
<?php
    include '../assets/shared/shared.php';
    $NEW_ENTRY_LIMIT = 10;
    $hitcount = '../.stats/' . date('d-m-Y') . '.json';
    if (file_exists($hitcount)) {
        $file = fopen($hitcount, 'r');
        if (flock($file, LOCK_SH)) {
            $json = trim(fread($file, filesize($hitcount)));
            flock($file, LOCK_UN);
        }
        fclose($file);
        $stats = json_decode($json, true);
        if (isset($stats)) {
            arsort($stats);
        } else {
            $hitcount = 'error';
        }
    } else {
        $hitcount = 'empty';
    }
    $ip_count = (object) array();
    $countries = (object) array();
    $cache_file = '../.stats/cache';
    if (file_exists($cache_file)) {
        $json = file_get_contents($cache_file);
        $cache = (object) json_decode($json, true);
    } else {
        $cache = (object) array();
    }
    $flag_url = 'https://icons.iconarchive.com/icons/custom-icon-design/all-country-flag/16/';

    function format_image(string $country) {
        switch ($country) {
            case 'United Kingdom': return 'flag-';
            case 'Estonia': return '';
            default: return 'Flag-';
        }
    }
?>

    <head>
		<title>Admin Panel - Maribel Hearn's Touhou Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='../assets/shared/css_concat.php?page=index'>
		<link rel='icon' type='image/x-icon' href='../favicon.ico'>
        <script src='../assets/shared/js_concat.php?page=admin' defer></script>
    </head>

    <body>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar('admin') ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack_admin'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a></p>
                <span id='hy_container'><span id='hy'></span>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1>Admin Panel</h1>
                <p><input id='setcookie' type='button' value='Set Blocking Cookie'></p>
                <p id='response' class='wide-top'>Caching new entries...</p>
                <?php
                    if ($hitcount == 'error') {
                        echo '<p class="wide">An error occurred while reading the stats.</p>';
                    } else if ($hitcount == 'empty') {
                        echo '<p class="wide">No stats for today yet.</p>';
                    } else {
                        echo '<h2>Page Hits</h2>';
                        foreach ($stats as $page => $obj) {
                            $obj = (object) $obj;
                            echo '<p><strong>' . $page . '</strong> ' . $obj->hits . '</p>';
                            foreach ($obj->ips as $ip => $count) {
                                if (!property_exists($ip_count, $ip)) {
                                    $ip_count->{$ip} = $count;
                                } else {
                                    $ip_count->{$ip} += $count;
                                }
                            }
                        }
                        echo '<h2>Countries</h2>';
                        foreach ($ip_count as $ip => $count) {
                            if (property_exists($cache, $ip)) {
                                $country = $cache->{$ip};
                            } else if (is_localhost($ip)) {
                                $country = 'local';
                            } else {
                                $country = 'new';
                            }
                            if (!property_exists($countries, $country)) {
                                $countries->{$country} = $count;
                            } else {
                                $countries->{$country} += $count;
                            }
                        }
                        foreach ($countries as $country => $count) {
                            if ($country == 'new') {
                                echo '<p><strong>new</strong> ' . $count . '</p>';
                            } else if ($country == 'local') {
                                echo '<p><strong>local</strong> ' . $count . '</p>';
                            } else {
                                $url_country = ($country == 'Croatia' ? 'Croatian' : str_replace(' ', '-', $country));
                                if ($country == 'Kosovo') {
                                    echo '<p><strong><img src="https://icons.iconarchive.com/icons/wikipedia/flags/' .
                                    '16/XK-Kosovo-Flag-icon.png" alt="Flag of ' . $country . '"> ' . $country .
                                    '</strong> ' . $count . '</p>';
                                } else {
                                    echo '<p><strong><img src="' . $flag_url . $url_country .
                                    '-' . format_image($country) . 'icon.png" alt="Flag of ' . $country .
                                    '"> ' . $country . '</strong> ' . $count . '</p>';
                                }
                            }
                        }
                    }
                ?>
                <p class='wide-top'>You are visiting this page using <strong id='os'></strong>.</p>
                <p>You are visiting this page using <strong id='browser'></strong>.</p>
                <p id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=420928'>LM7</a>.</p>
            </div>
        </main>
        <?php
            echo '<input id="token" type="hidden" value=' . file_get_contents('../.stats/token') . '>';
            echo '<input id="new_cache_entries" type="hidden" value="';
            $new_entries = array();
            foreach ($stats as $page => $obj) {
                $obj = (object) $obj;
                foreach ($obj->ips as $ip => $count) {
                    if (!property_exists($cache, $ip) && !in_array($ip, $new_entries) && !is_localhost($ip)) {
                        array_push($new_entries, $ip);
                    }
                    if (count($new_entries) > $NEW_ENTRY_LIMIT) {
                        break;
                    }
                }
                if (count($new_entries) > $NEW_ENTRY_LIMIT) {
                    break;
                }
            }
            echo implode(',', $new_entries) . '">';
        ?>
    </body>

</html>
