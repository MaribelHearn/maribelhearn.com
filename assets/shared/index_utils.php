<?php
function closest_page(string $url) {
    $min_distance = PHP_INT_MAX;
    $min_page = '';
    foreach (glob('php/*') as $file) {
        if (strpos($file, '.php') && !strpos($file, '_') && $file != 'error.php') {
            $matching_file = preg_split('/\//', $file);
            $matching_file = end($matching_file);
            $matching_page = str_replace('.php', '', $matching_file);
            $min_distance = min(levenshtein($url, $matching_page), $min_distance);
            if (levenshtein($url, $matching_page) <= $min_distance) {
                $min_page = $matching_page;
            }
        }
    }
    return array($min_page, $min_distance);
}

function redirect_to_closest(string $url) {
    if (strpos($url, '/') === false) {
        $closest_page = closest_page($url);
        $min_page = $closest_page[0];
        $min_distance = $closest_page[1];
        if (!empty($min_page) && $min_distance < 3 && $min_distance >= 0) {
            $location = $_SERVER['SERVER_NAME'] !== 'localhost' ? 'https://maribelhearn.com/' : 'http://localhost/';
            header('Location: ' . $location . $min_page . '?redirect=' . $url);
        }
    }
}

function subpage_name(string $subpage) {
    switch ($subpage) {
        case 'eosd': return 'EoSD';
        case 'gfx': return 'Graphics';
        case 'res': return 'Resources';
        case 'extras': return 'Extra Statistics';
        default: return ucfirst($subpage);
    }
}

function redirect(string $page, string $page_path, string $request, string $error) {
    $aliases = (object) array('rf' => 'royalflare', 'surv' => 'survival', 'score' => 'scoring', 'poll' => 'thvote');
    $page_path = preg_split('/\?/', $page_path)[0];
    if (property_exists($aliases, $page)) {
        $location = $_SERVER['SERVER_NAME'] !== 'localhost' ? 'https://maribelhearn.com/' : 'http://localhost/';
        header('Location: ' . $location . $aliases->{$page} . '?redirect=' . $page);
        return $aliases->{$page};
    }
    if (!file_exists($page_path) && $page != 'index' || !empty($error)) {
        $page = 'error';
        $url = substr($request, 1);
        if (file_exists('assets/shared/json/admin.json')) {
            $json = file_get_contents('assets/shared/json/admin.json');
            $data = json_decode($json, true);
            if (isset($data[$url])) {
                header('Location: ' . $data[$url]);
                exit();
            }
        }
        redirect_to_closest($url);
    }
    return $page;
}

function hit(string $filename, string $status_code) {
    $path = $filename == 'error.php' ? '../../.stats/' : '.stats/';
    if (file_exists($path)) {
        if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('~(bot|crawl|slurp|spider|archiver|facebook|lighthouse|jigsaw|validator|w3c|hexometer)~i', $_SERVER['HTTP_USER_AGENT'])) {
            return;
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = substr($_SERVER['REQUEST_URI'], 1);
        $token = (file_exists($path . 'token') ? trim(file_get_contents($path . 'token')) : '');
        if (is_localhost($ip) || !isset($_COOKIE['token']) || $_COOKIE['token'] !== $token) {
            exec('nohup php admin/cache.php ' . $ip . ' > /dev/null 2>&1 &');
            $page = str_replace('.php', '', $filename);
            if (!empty($status_code)) {
                $page .= ' ' . $status_code;
            }
            $hitcount = $path . date('d-m-Y') . '.json';
            if (!file_exists($hitcount)) {
                $stats = array($page => (object) array());
                $stats[$page]->hits = 1;
                $stats[$page]->ips = (object) array();
                $stats[$page]->ips->{$ip} = 1;
                if (!empty($status_code)) {
                    $stats[$page]->urls = (object) array();
                    $stats[$page]->urls->{$url} = 1;
                }
                $file = fopen($hitcount, 'w');
                if (flock($file, LOCK_EX)) {
                    fwrite($file, json_encode($stats));
                    flock($file, LOCK_UN);
                }
            } else {
                $file = fopen($hitcount, 'r+');
                if (flock($file, LOCK_EX)) {
                    $json = fread($file, filesize($hitcount));
                    $json = trim($json);
                    $stats = json_decode($json, true);
                    if (isset($stats[$page])) {
                        $stats[$page] = (object) $stats[$page];
                        $stats[$page]->hits += 1;
                        $stats[$page]->ips = (object) $stats[$page]->ips;
                        if (property_exists($stats[$page]->ips, $ip)) {
                            $stats[$page]->ips->{$ip} += 1;
                        } else {
                            $stats[$page]->ips->{$ip} = 1;
                        }
                        if (!empty($status_code)) {
                            if (!property_exists($stats[$page], 'urls')) {
                                $stats[$page]->urls = (object) array();
                            }
                            $stats[$page]->urls = (object) $stats[$page]->urls;
                            if (property_exists($stats[$page]->urls, $url)) {
                                $stats[$page]->urls->{$url} += 1;
                            } else {
                                $stats[$page]->urls->{$url} = 1;
                            }
                        }
                    } else {
                        $stats[$page] = (object) array();
                        $stats[$page]->hits = 1;
                        $stats[$page]->ips = (object) array();
                        $stats[$page]->ips->{$ip} = 1;
                        if (!empty($status_code)) {
                            if (!property_exists($stats[$page], 'urls')) {
                                $stats[$page]->urls = (object) array();
                            }
                            $stats[$page]->urls = (object) $stats[$page]->urls;
                            if (property_exists($stats[$page]->urls, $url)) {
                                $stats[$page]->urls->{$url} += 1;
                            } else {
                                $stats[$page]->urls->{$url} = 1;
                            }
                        }
                    }
                    ftruncate($file, 0);
                    rewind($file);
                    fwrite($file, json_encode($stats));
                    flock($file, LOCK_UN);
                }
            }
            fclose($file);
        }
    }
}

function set_theme_cookie() {
    if (is_localhost($_SERVER['REMOTE_ADDR'])) {
        setcookie('theme', ($_GET['theme'] == 'dark' ? 'dark' : ''), array(
            'expires' => 2147483647,
            'path' => '/',
            'samesite' => 'Strict'
        ));
    } else {
        setcookie('theme', ($_GET['theme'] == 'dark' ? 'dark' : ''), array(
            'expires' => 2147483647,
            'path' => '/',
            'secure' => true,
            'samesite' => 'Strict'
        ));
    }
}

function set_lang_cookie() {
    if (empty($_GET['hl']) || $_GET['hl'] == 'en-gb' || $_GET['hl'] == 'en') {
        $lang = 'en_GB';
    } else if ($_GET['hl'] == 'en-us') {
        $lang = 'en_US';
    } else if ($_GET['hl'] == 'jp') {
        $lang = 'ja_JP';
    } else if ($_GET['hl'] == 'zh') {
        $lang = 'zh_CN';
    } else if ($_GET['hl'] == 'ru') {
        $lang = 'ru_RU';
    } else if ($_GET['hl'] == 'de') {
        $lang = 'de_DE';
    } else if ($_GET['hl'] == 'es') {
        $lang = 'es_ES';
    } else {
        $lang = 'en_US';
    }
    if (!empty($_GET['hl'])) {
        if (is_localhost($_SERVER['REMOTE_ADDR'])) {
            setcookie('lang', $lang, array(
                'expires' => 2147483647,
                'path' => '/',
                'samesite' => 'Strict'
            ));
        } else {
            setcookie('lang', $lang, array(
                'expires' => 2147483647,
                'path' => '/',
                'secure' => true,
                'samesite' => 'Strict'
            ));
        }
    } else {
        if (isset($_COOKIE['lang'])) {
            $lang = str_replace('"', '', $_COOKIE['lang']);
            $lang = (empty($lang) ? 'en_US' : $lang);
        }
    }

    return $lang;
}

function lang_code() {
    global $lang;
    switch ($lang) {
        case 'ja_JP': return 'ja';
        case 'zh_CN': return 'zh';
        case 'ru_RU': return 'zh';
        case 'de_DE': return 'de';
        case 'es_ES': return 'es';
        default: return 'en';
    }
}

function handle_file_upload() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['import']) && is_uploaded_file($_FILES['import']['tmp_name'])) {
            switch ($_FILES['import']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    return '<strong class="error">Error: no file sent.</strong>';
                default:
                    return '<strong class="error">Error: file upload failed for an unknown reason.</strong>';
            }
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['import']['tmp_name']),
                array(
                    '' => 'text/plain',
                    'txt' => 'text/plain',
                ),
                true
            )) {
                return '<strong class="error">Error: invalid file format; expected plain text.</strong>';
            }
            if ($_FILES['import']['size'] > 5000) {
                return '<strong class="error">Error: file exceeds the upload size limit.</strong>';
            }
            if (!empty($ext)) {
                $ext = '.' . $ext;
            }
            $path = sprintf('./assets/other/tiers/uploads/%s%s', sha1_file($_FILES['import']['tmp_name']), $ext);
            if (!move_uploaded_file($_FILES['import']['tmp_name'], $path)) {
                return '<strong class="error">Error: failed to move uploaded file.</strong>';
            }
            return $path;
        } else {
            return '<strong class="error">Error: no file sent.</strong>';
        }
    }
}

function generate_nonce() {
    $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    $number_of_chars = 62;
    $nonce = '';
    for ($i = 0; $i < 32; $i++) {
        $nonce .= $chars[rand(0, $number_of_chars - 1)];
    }
    $file = fopen('.stats/nonce', 'w');
    if (flock($file, LOCK_EX)) {
        fwrite($file, $nonce);
        flock($file, LOCK_UN);
    }
    return $nonce;
}
?>
