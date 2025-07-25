<!DOCTYPE html>
<html lang='en'>
<?php
    include_once '../php/shared/http.php';
    include_once '../php/shared/shared.php';
    include_once '../php/shared/navbar.php';
    require_once '../php/shared/mobile_detect.php';
    $detect_device = new Mobile_Detect;
    $is_mobile = $detect_device -> isMobile();
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
        if ($country == 'Turkey') {
            return 'Türkiye';
        }
        else if ($country == 'Netherlands') {
            return 'The-Netherlands';
        }
        return str_replace(' ', '-', $country);
    }

    class Cache extends SQLite3 {
        function __construct() {
            $path = '../.stats/cache.db';
            if (!file_exists($path)) {
                $this->open($path);
                $this->exec('CREATE TABLE Cache ( IP varchar(15) UNIQUE, Country varchar(255) )');
            } else {
                $this->open($path);
            }
        }
    }
?>

    <head>
		<title>Admin Panel - Maribel Hearn's Touhou Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='../php/shared/css_concat.php?page=index&mobile=<?php echo $is_mobile ?>'>
		<link rel='icon' type='image/x-icon' href='../favicon.ico'>
        <script src='../php/shared/js_concat.php?page=admin' defer></script>
    </head>

    <body>
		<nav>
            <div id='nav' class='wrap'><?php echo navbar('admin') ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <?php 
                    echo wrap_top();
                    if (file_exists('detect.js')) {
                        echo '<p class="wide-top center">You are visiting this page using <strong id="os"></strong>.</p>' .
                        '<p class="center">You are visiting this page using <strong id="browser"></strong>.</p>';
                    }
                ?>
                <p class='center'>PHP Version: <?php echo phpversion() ?></p>
                <section>
                    <input id='setcookie' type='button' value='Set Blocking Cookie'>
                </section>
                <h2>Cookie Editor</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id='cookies'></tbody>
                </table>
                <section>
                    <input id='savecookie' type='button' value='Save'>
                </section>
                <?php
                    if ($hitcount == 'error') {
                        echo '<p class="wide center">An error occurred while reading the stats.</p>';
                    } else if ($hitcount == 'empty') {
                        echo '<p class="wide center">No stats for today yet.</p>';
                    } else {
                        echo '<h2>Page Hits</h2>';
                        foreach ($stats as $page => $obj) {
                            if (strpos($page, 'error') !== false) {
                                continue;
                            }
                            $obj = (object) $obj;
                            echo '<p class="center"><strong>' . $page . '</strong> ' . $obj->hits . '</p>';
                            foreach ($obj->ips as $ip => $count) {
                                if (!property_exists($ip_count, $ip)) {
                                    $ip_count->{$ip} = $count;
                                } else {
                                    $ip_count->{$ip} += $count;
                                }
                            }
                        }
                        echo '<h2>Countries</h2><table id="countries" class="sortable noborders"><thead><tr><th class="no-sort">Flag</th><th>Country</th><th>Hits</th><th class="no-sort">Bar</th></tr></thead><tbody>';
                        $cache = new Cache();
                        foreach ($ip_count as $ip => $count) {
                            $entries = $cache->query('SELECT * FROM Cache WHERE IP="' .  $ip . '"');
                            $entries = $entries->fetchArray();
                            if ($entries && in_array($ip, $entries)) {
                                $country = $entries['Country'];
                            } else if (is_localhost($ip)) {
                                $country = 'Local';
                            } else {
                                $country = 'Unknown';
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
                            if ($country == 'Unknown' || $country == 'Local') {
                                echo '<td></td><td><strong>' . $country . '</strong></td><td>' . $count . '</td><td><progress value="' . $count . '" max="' . $max . '"></progress></td></tr>';
                            } else {
                                echo '<td><span id="' . format_country($country) . '" class="flag"></td><td><strong>' . $country . '</strong></td><td>' . $count .
                                '</td><td><progress value="' . $count . '" max="' . $max . '"></progress></td></tr>';
                            }
                            $total += 1;
                        }
                        echo '</tbody></table>';
                    }
                ?>
                <footer><strong><a href='#top'>Back to Top</a></strong></footer>
            </div>
        </main>
        <?php
            // Define token
            if (!file_exists('../.stats/token')) {
                $token = generate_string('token');
            } else {
                $token = file_get_contents('../.stats/token');
            }

            echo '<input id="token" type="hidden" value=' . $token . '>';
        ?>
        <script nonce='<?php echo file_get_contents('../.stats/nonce') ?>' defer>document.body.style.background="url('assets/main/index/index.jpg') center no-repeat fixed";document.body.style.backgroundSize="cover"</script>
        <noscript><link rel='stylesheet' href='php/shared/noscript_bg.php?page=index'></noscript>
    </body>

</html>
