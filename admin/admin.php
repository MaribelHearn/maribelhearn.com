<!DOCTYPE html>
<html lang='en'>
<?php
    include_once '../assets/shared/shared.php';
    require_once '../assets/shared/mobile_detect.php';
    $detect_device = new Mobile_Detect;
    $is_mobile = $detect_device -> isMobile();
    $DISPLAY_LIMIT = 5;
    $NEW_ENTRY_LIMIT = 45;
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
    $countries = new ArrayObject();
    $cache_file = '../.stats/cache';
    if (file_exists($cache_file)) {
        $json = file_get_contents($cache_file);
        $cache = (object) json_decode($json, true);
    } else {
        $cache = (object) array();
    }
    $flag_url = 'https://icons.iconarchive.com/icons/custom-icon-design/all-country-flag/16/';
    $lang_code = 'en';
    $page = 'admin';
    function cmp(int $a, int $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
    }
    function format_country(string $country) {
        switch ($country) {
            case 'U.S. Virgin Islands': return 'Virgin-Islands';
            case 'Palestine': return 'Palestinian-Territory';
            case 'Bosnia and Herzegovina': return 'Bosnian';
            case 'North Macedonia': return 'Macedonia';
            case 'Czechia': return 'Czech-Republic';
            case 'Curacao': return 'Netherlands';
            case 'Dominica': return 'Dominicana';
            case 'Eswatini': return 'Swaziland';
            case 'South Korea': return 'Korea';
            case 'Guadeloupe': return 'France';
            case 'Croatia': return 'Croatian';
            case 'Myanmar': return 'Burma';
            case 'Macao': return 'Macau';
            default: return str_replace(' ', '-', $country);
        }
    }
    function format_image(string $country) {
        switch ($country) {
            case 'Saint Kitts and Nevis': return '';
            case 'United Arab Emirates': return '';
            case 'Antigua and Barbuda': return '';
            case 'Trinidad and Tobago': return '';
            case 'United Kingdom': return 'flag-';
            case 'French Polynesia': return '';
            case 'Aland Islands': return '';
            case 'Palestine': return '';
            case 'Dominica': return '';
            case 'Estonia': return '';
            case 'Reunion': return '';
            case 'Bermuda': return '';
            case 'Aruba': return '';
            default: return 'Flag-';
        }
    }
?>

    <head>
		<title>Admin Panel - Maribel Hearn's Touhou Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='../assets/shared/css_concat.php?page=index&mobile=<?php echo $is_mobile ?>'>
		<link rel='icon' type='image/x-icon' href='../favicon.ico'>
        <script src='../assets/shared/js_concat.php?page=admin' defer></script>
    </head>

    <body>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar('admin') ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <?php echo wrap_top() ?>
                <p><input id='setcookie' type='button' value='Set Blocking Cookie'></p>
                <p id='response' class='wide'>Caching new entries...</p>
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
                        echo '<h2>Countries</h2><table id="countries"><tr><th>Flag</th><th>Country</th><th>Hits</th><th>Bar</th></tr>';
                        foreach ($ip_count as $ip => $count) {
                            if (property_exists($cache, $ip)) {
                                $country = $cache->{$ip};
                            } else if (is_localhost($ip)) {
                                $country = 'local';
                            } else {
                                $country = 'new';
                            }
                            if (gettype($country) == 'string') {
                                if (!$countries->offsetExists($country)) {
                                    $countries[$country] = $count;
                                } else {
                                    $countries[$country] += $count;
                                }
                            }
                        }
                        $countries->uasort('cmp');
                        $max = 1;
                        foreach ($countries as $country => $count) {
                            if ($count > $max) {
                                $max = $count;
                            }
                        }
                        $total = 0;
                        foreach ($countries as $country => $count) {
                            echo '<tr>';
                            if ($country == 'new' || $country == 'local') {
                                echo '<td></td><th>' . $country . '</th><td>' . $count . '</td><td><progress value="' . $count .
                                '" max="' . $max . '"></progress></td></tr>';
                            } else {
                                $url_country = format_country($country);
                                if ($country == 'Kosovo') {
                                    echo '<td><img src="https://icons.iconarchive.com/icons/wikipedia/flags/' .
                                    '16/XK-Kosovo-Flag-icon.png" alt="Flag of ' . $country . '"></td><th>' . $country .
                                    '</th><td>' . $count . '</td><td><progress value="' . $count . '" max="' . $max .
                                    '"></progress></td></tr>';
                                } else {
                                    echo '<td><img src="' . $flag_url . $url_country .
                                    '-' . format_image($country) . 'icon.png" alt="Flag of ' . $country .
                                    '"></td><th>' . $country . '</th><td>' . $count . '</td><td><progress value="' . $count .
                                    '" max="' . $max . '"></progress></td></tr>';
                                }
                            }
                            $total += 1;
                        }
                        echo '</table>';
                    }
                ?>
                <p class='wide-top'>You are visiting this page using <strong id='os'></strong>.</p>
                <p>You are visiting this page using <strong id='browser'></strong>.</p>
            </div>
        </main>
        <?php
            echo '<input id="token" type="hidden" value=' . file_get_contents('../.stats/token') . '>';
            echo '<input id="new_cache_entries" type="hidden" value="';
            if (isset($stats)) {
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
            }
        ?>
        <script nonce='<?php echo file_get_contents('../.stats/nonce') ?>' defer>document.body.style.background="url('assets/main/index/index.jpg') center no-repeat fixed";document.body.style.backgroundSize="cover"</script>
        <noscript><link rel='stylesheet' href='assets/shared/noscript_bg.php?page=index'></noscript>
    </body>

</html>
