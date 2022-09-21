<?php
$langs = array('en_GB', 'en_US', 'ja_JP', 'zh_CN', 'ru_RU', 'de_DE', 'es_ES');

function has_space(string $lang) {
    return $lang != 'ja_JP' && $lang != 'zh_CN';
}

function curl_get(string $url){
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'MozillaXYZ/1.0');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function is_localhost(string $addr) {
    return $addr == '::1' || $addr == '127.0.0.1' || substr($addr, 0, 8) == '192.168.';
}

function directory(string $page, array $main) {
    $other = array('thvote', 'tiers', 'slots');
    $personal = array('history', 'c67');
    if (in_array($page, $main)) {
        return 'main';
    } else if (in_array($page, $other)) {
        return 'other';
    } else if (in_array($page, $personal)) {
        return 'personal';
    }
    return 'games';
}

function closest_page(string $url) {
    $min_distance = PHP_INT_MAX;
    foreach (glob('assets/*/*/*') as $file) {
        if (strpos($file, '.php') && !strpos($file, '_') && $file != 'error.php') {
            $matching_file = end(preg_split('/\//', $file));
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
        if ($min_distance < 3 && $min_distance >= 0) {
            echo $min_page . '<br>' . $min_distance . '<br>';
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
function page_exists(string $page_path) {
    $main = str_replace('%dir', 'main', $page_path);
    $games = str_replace('%dir', 'games', $page_path);
    $other = str_replace('%dir', 'other', $page_path);
    $personal = str_replace('%dir', 'personal', $page_path);
    return file_exists($main) || file_exists($games) || file_exists($other) || file_exists($personal);
}

function redirect(string $page, string $page_path, string $request, string $error) {
    $aliases = (object) array('rf' => 'royalflare', 'surv' => 'survival', 'score' => 'scoring', 'poll' => 'thvote');
    $page_path = preg_split('/\?/', $page_path)[0];
    if (property_exists($aliases, $page)) {
        $location = $_SERVER['SERVER_NAME'] !== 'localhost' ? 'https://maribelhearn.com/' : 'http://localhost/';
        header('Location: ' . $location . $aliases->{$page} . '?redirect=' . $page);
        return $page;
    }
    if (!page_exists($page_path) && $page != 'index' || !empty($error)) {
        $page = 'error';
        $url = substr($request, 1);
        $json = file_get_contents('assets/shared/json/admin.json');
        $data = json_decode($json, true);
        if (isset($data[$url])) {
            header('Location: ' . $data[$url]);
            exit();
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

function background_position($page) {
    $top = array('c67', 'drc', 'history', 'jargon', 'survival', 'slots', 'tools');
    $bottom = array('fangame', 'lnn', 'scoring', 'wr');
    if (in_array($page, $top)) {
        return 'top';
    } else if (in_array($page, $bottom)) {
        return 'bottom';
    } else {
        return 'center';
    }
}

function touhou_sites() {
    return '<p><a href="https://en.touhouwiki.net">' .
    '<span class="icon wiki_icon"></span>Touhou Wiki</a></p>' .
    '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
    '<span class="icon thcrap_icon"></span>THPatch</a></p>' .
    '<p><a href="http://replay.lunarcast.net">' .
    '<span class="icon lunarcast_icon"></span>Lunarcast</a></p>' .
    '<p><a href="https://thscore.pndsng.com/index.php">' .
    '<span class="icon pndsng_icon"></span>PND List</a></p>' .
    '<p><a href="https://priw8.github.io">' .
    '<span class="icon priw8_icon"></span>Priw8\'s Site</a></p>' .
    '<p><a href="https://exphp.github.io/thpages">' .
    '<span class="icon exphp_icon"></span>ExpHP\'s Site</a></p>' .
    '<p><a href="https://wikiwiki.jp/thscorekg/">' .
    '<span class="icon kg_icon"></span>KG\'s Site</a></p>' .
    '<p><a href="https://gensakudan.com/">' .
    '<span class="icon gsd_icon"></span>Retrograde Road</a></p>' .
    '<p><a href="https://www.thspotify.moe/">' .
    '<span class="icon thspotify_icon"></span>Touhou Spotify Music</a></p>' .
    '<p><a href="https://touhouworldcup.com">' .
    '<span class="icon twc_icon"></span> Touhou World Cup</a></p>' .
    '<p><a href="https://nylilsa.github.io">' .
    '<span class="icon nylilsa_icon"></span>Nylilsa\'s Site</a></p>';
    //$navbar .= '<p><a href="https://zps-stg.github.io">' .
    //'<span class="icon zps_icon"></span>ZPS\'s Site</a></p>';
}

function own_sites() {
    return '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
    '<span class="icon youtube_icon"></span>YouTube</a></p>' .
    '<p><a href="https://twitter.com/MaribelHearn42">' .
    '<span class="icon twitter_icon"></span>Twitter</a></p>' .
    '<p><a href="https://www.twitch.tv/maribel_hearn">' .
    '<span class="icon twitch_icon"></span>Twitch</a></p>' .
    '<p><a href="https://steamcommunity.com/id/maribelhearn42">' .
    '<span class="icon steam_icon"></span>Steam</a></p>' .
    '<p><a href="https://github.com/MaribelHearn">' .
    '<span class="icon github_icon"></span>GitHub</a></p>' .
    '<p><a href="https://github.com/MaribelHearn/maribelhearn.com">' .
    '<span class="icon source_icon"></span>Source</a></p>';
}

function game_pages() {
    return '<p><a href="/scoring"><span class="icon scoring_icon"></span> Scoring</a></p>' .
    '<p><a href="/survival"><span class="icon survival_icon"></span> Survival</a></p>' .
    '<p><a href="/drc"><span class="icon drc_icon"></span> DRC</a></p>' .
    '<p><a href="/tools"><span class="icon tools_icon"></span> Tools</a></p>' .
    '<p><a href="/wr"><span class="icon wr_icon"></span> WR</a></p>' .
    '<p><a href="/lnn"><span class="icon lnn_icon"></span> LNN</a></p>' .
    '<p><a href="/jargon"><span class="icon jargon_icon"></span> Jargon</a></p>' .
    '<p><a href="/trs"><span class="icon trs_icon"></span> TRS</a></p>' .
    '<p><a href="/gensokyo"><span class="icon gensokyo_icon"></span> Gensokyo</a></p>' .
    '<p><a href="/pofv"><span class="icon pofv_icon"></span> PoFV</a></p>' .
    '<p><a href="/fangame"><span class="icon fangame_icon"></span> Fangame</a></p>' .
    '<p><a href="/faq"><span class="icon faq_icon"></span> FAQ</a></p>' .
    '<p><a href="/royalflare"><span class="icon royalflare_icon"></span> Royalflare</a></p>';
}

function other_pages() {
    return '<p><a href="/thvote"><span class="icon thvote_icon"></span> Poll</a></p>' .
    '<p><a href="/tiers"><span class="icon tiers_icon"></span> Tiers</a></p>' .
    '<p><a href="/slots"><span class="icon slots_icon"></span> Slots</a></p>';
}

function personal_pages() {
    return '<p><a href="/about"><span class="icon"></span> About</a></p>' .
    '<p><a href="/history"><span class="icon history_icon"></span> History</a></p>' .
    '<p><a href="/c67"><span class="icon c67_icon"></span> C67</a></p>';
}

function show_admin(string $token_path) {
    return isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents($token_path));
}

function navbar(string $page) {
    $token_path = ($page == 'admin' ? '../.stats/token' : '.stats/token');
    $navbar = '<div class="dropdown nav_left">';
    $navbar .= '<a href="/"><span class="icon index_icon"></span> Index</a>';

    if (is_localhost($_SERVER['REMOTE_ADDR'])) {
        $navbar .= ' <strong class="dev_instance">(Dev)</strong>';
    }

    $navbar .= ' | ';

    if (show_admin($token_path)) {
        $navbar .= '<a href="/admin">Admin</a> | ';
    }

    $navbar .= '<a href="/credits">Credits</a> | ';
    $navbar .= '<a href="https://github.com/MaribelHearn/maribelhearn.com/issues/new/choose">Report Issue</a> ';

    if (!show_admin($token_path)) {
        $navbar .= '| <a href="https://ko-fi.com/maribelhearn42">Buy me a coffee</a>';
    }

    $navbar .= '</div><div class="nav_right">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= touhou_sites();
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Links&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= own_sites();
            $navbar .= '</div>';
        $navbar .= '</div>';
    $navbar .= '</div>';
    $navbar .= '<div class="dropdowns' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Games&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= game_pages();
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Other&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= other_pages();
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Personal&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= personal_pages();
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div id="ext_mobile"' . ($page == 'tiers' ? ' class="dark_bg"' : '') . '>';
            $navbar .= '<div class="dropdown">';
                $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
                $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                    $navbar .= touhou_sites();
                $navbar .= '</div>';
            $navbar .= '</div> ';
            $navbar .= '<div class="dropdown">';
                $navbar .= '<a href="#" class="dropdown_button">Links&#x25BF;</a>';
                $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                    $navbar .= own_sites();
                $navbar .= '</div>';
            $navbar .= '</div>';
        $navbar .= '</div>';
    $navbar .= '</div>';
    $navbar = str_replace('<a href="' . ($page == 'index' ? '/' : '/' . $page) . '">', '<strong>', $navbar);
    $cap = strlen($page) < 4 ? strtoupper($page) : ucfirst($page);
    if ($page == 'thvote') {
        $cap = 'Poll';
    } else if ($page == 'pofv') {
        $cap = 'PoFV';
    } else if ($page == 'admin') {
        $cap = 'Admin';
    }
    $navbar = str_ireplace($cap . '</a>', $cap . '</strong>', $navbar);
    if ($page == 'admin') {
        $navbar = str_replace('href="', 'href="../', $navbar);
        $navbar = str_replace('../http', 'http', $navbar);
        $navbar = str_replace('assets', '../assets', $navbar);
        $navbar = str_replace('..//', '../', $navbar);
    } else if ($page == 'error') {
        $navbar = str_replace('assets', 'https://maribelhearn.com/assets', $navbar);
    }
    return $navbar;
}

function has_translation(string $page, string $lang = '-') {
    $langs = new ArrayObject();
    $langs['-'] = Array('drc', 'lnn', 'pofv', 'tools', 'wr');
    $langs['ja'] = Array('drc', 'lnn', 'tools', 'wr');
    $langs['zh'] = Array('drc', 'lnn', 'pofv', 'wr');
    $langs['ru'] = Array('lnn', 'tools', 'wr');
    $langs['de'] = Array('drc', 'lnn', 'tools', 'wr');
    $langs['es'] = Array('lnn', 'tools', 'wr');
    return in_array($page, $langs[$lang]);
}

function wrap_top() {
    global $page, $lang,  $error_code, $layout;
    $tl_title = Array('credits', 'lnn', 'wr');
    if (empty($page)) {
        $page = 'index';
    }
    $use_index = array('index', 'about', 'credits', 'privacy', 'error');
    $dir = directory($page, $use_index);
    $json = file_get_contents($page == 'admin' ? 'admin.json' : 'assets/' . $dir . '/' . $page . '/' . $page . '.json');
    $data = (object) json_decode($json, true);
    if (has_translation($page)) {
        echo '<div id="topbar">';
    }
    if (isset($_COOKIE)) {
        echo '<span id="hy_container" data-html2canvas-ignore><a id="hy_link" href="?theme=' . (isset($_COOKIE['theme']) ? 'light' : 'dark') .
        '"><span id="hy"></span><br><span id="hy_text">' . (isset($_COOKIE['theme']) ? _('Youkai mode (Dark)') : _('Human mode (Light)')) . '</span></a></span>';
    }
    if ($page == 'lnn' || $page == 'wr') {
        echo '<span id="toggle"><a id="toggle_layout" href="' . $page . '">' . ($layout == 'New' ? 'Old' : 'New') . ' layout</a></span>';
    }
    if (has_translation($page)) {
        echo '<div id="languages">';
        if ($page == 'wr') {
            echo '<a id="en_GB" class="flag" href="wr?hl=en-gb">' .
            '<img class="flag_en" src="assets/shared/flags/uk.png" alt="' . _('Flag of the United Kingdom') . '">' .
            '<p class="language">English (UK)</p></a>' .
            '<a id="en_US" class="flag" href="wr?hl=en-us">' .
            '<img class="flag_en" src="assets/shared/flags/us.png" alt="' . _('Flag of the United States') . '">' .
            '<p class="language">English (US)</p></a> ';
        } else {
            echo '<a id="en_GB" class="flag" href="' . $page . '?hl=en">' .
            '<img class="flag_en" src="assets/shared/flags/uk.png" alt="' . _('Flag of the United Kingdom') . '"><p class="language">English</p></a> ';
        }
        if (has_translation($page, 'ja')) {
            echo '<a id="ja_JP" class="flag" href="' . $page . '?hl=jp">' .
            '<img src="assets/shared/flags/japan.png" alt="' . _('Flag of Japan') . '"><p class="language">日本語</p></a> ';
        }
        if (has_translation($page, 'zh')) {
            echo '<a id="zh_CN" class="flag" href="' . $page . '?hl=zh">' .
            '<img src="assets/shared/flags/china.png" alt="' . _('Flag of the P.R.C.') . '"><p class="language">简体中文</p></a> ';
        }
        if (has_translation($page, 'ru')) {
            echo '<a id="ru_RU" class="flag" href="' . $page . '?hl=ru">' .
            '<img src="assets/shared/flags/russia.png" alt="' . _('Flag of Russia') . '"><p class="language">Русский</p></a>';
        }
        if (has_translation($page, 'de')) {
            echo '<a id="de_DE" class="flag" href="' . $page . '?hl=de">' .
            '<img src="assets/shared/flags/germany.png" alt="' . _('Flag of Germany') . '"><p class="language">Deutsch</p></a>';
        }
        if (has_translation($page, 'es')) {
            echo '<a id="es_ES" class="flag" href="' . $page . '?hl=es">' .
            '<img src="assets/shared/flags/spain.png" alt="' . _('Flag of Spain') . '"><p class="language">Español</p></a>';
        }
        echo '</div>';
    }
    if (has_translation($page)) {
        echo '</div>';
    }
    if ($page == 'survival' || $page == 'slots') {
        echo '<div id="content" data-html2canvas-ignore="" style="display:block">';
    }
    if ($page == 'faq' || $page == 'royalflare' || $page == 'thvote') {
        return;
    }
    if (empty($error_code)) {
        $title = preg_split('/ - /', $data->title)[0];
        echo '<h1 data-html2canvas-ignore>' . _($title) . '</h1>';
    } else {
        echo '<h1>' . $error_code . '</h1>';
    }
	if (!empty($_GET['redirect'])) {
		echo '<p class="wide" data-html2canvas-ignore>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
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

function shot_route(string $game) {
    return $game == 'HRtP' || $game == 'GFW' ? _('Route') : _('Shottype');
}

function game_num(string $game) {
    switch ($game) {
        case 'HRtP': return 1;
        case 'SoEW': return 2;
        case 'PoDD': return 3;
        case 'LLS': return 4;
        case 'MS': return 5;
        case 'EoSD': return 6;
        case 'PCB': return 7;
        case 'IN': return 8;
        case 'PoFV': return 9;
        case 'StB': return 95;
        case 'MoF': return 10;
        case 'SA': return 11;
        case 'UFO': return 12;
        case 'DS': return 125;
        case 'GFW': return 128;
        case 'TD': return 13;
        case 'DDC': return 14;
        case 'LoLK': return 15;
        case 'HSiFS': return 16;
        case 'WBaWC': return 17;
        case 'UM': return 18;
        default: return 0;
    }
}

function full_name(string $game) {
    switch ($game) {
        case 'HRtP': return _('Touhou 1 - The Highly Responsive to Prayers');
        case 'SoEW': return _('Touhou 2 - The Story of Eastern Wonderland');
        case 'PoDD': return _('Touhou 3 - Phantasmagoria of Dim.Dream');
        case 'LLS': return _('Touhou 4 - Lotus Land Story');
        case 'MS': return _('Touhou 5 - Mystic Square');
        case 'EoSD': return _('Touhou 6 - The Embodiment of Scarlet Devil');
        case 'PCB': return _('Touhou 7 - Perfect Cherry Blossom');
        case 'IN': return _('Touhou 8 - Imperishable Night');
        case 'PoFV': return _('Touhou 9 - Phantasmagoria of Flower View');
        case 'StB': return _('Touhou 9.5 - Shoot the Bullet');
        case 'MoF': return _('Touhou 10 - Mountain of Faith');
        case 'SA': return _('Touhou 11 - Subterranean Animism');
        case 'UFO': return _('Touhou 12 - Undefined Fantastic Object');
        case 'DS': return _('Touhou 12.5 - Double Spoiler');
        case 'GFW': return _('Touhou 12.8 - Great Fairy Wars');
        case 'TD': return _('Touhou 13 - Ten Desires');
        case 'DDC': return _('Touhou 14 - Double Dealing Character');
        case 'LoLK': return _('Touhou 15 - Legacy of Lunatic Kingdom');
        case 'HSiFS': return _('Touhou 16 - Hidden Star in Four Seasons');
        case 'WBaWC': return _('Touhou 17 - Wily Beast and Weakest Creature');
        case 'UM': return _('Touhou 18 - Unconnected Marketeers');
        default: return 'Unknown';
    }
}

function format_shot(string $game, string $shot) {
    if ($game == 'IN') {
        $tmp = str_replace('FinalA', '', $shot);
        $tmp = str_replace('FinalB', '', $tmp);
        $shot = str_replace($tmp, '', $shot);
        if (empty($shot)) {
            return _($tmp);
        } else {
            return _($tmp) . '<span class="in_route">' . _($shot) . '</span>';
        }
    } else if ($game == 'HSiFS') {
        $tmp = str_replace('Spring', '', $shot);
        $tmp = str_replace('Summer', '', $tmp);
        $tmp = str_replace('Autumn', '', $tmp);
        $tmp = str_replace('Winter', '', $tmp);
        $shot = str_replace('Spring', '<span class="Spring">' . _('Spring') . '</span>', $shot);
        $shot = str_replace('Summer', '<span class="Summer">' . _('Summer') . '</span>', $shot);
        $shot = str_replace('Autumn', '<span class="Autumn">' . _('Autumn') . '</span>', $shot);
        $shot = str_replace('Winter', '<span class="Winter">' . _('Winter') . '</span>', $shot);
        if (empty($shot)) {
            return _($tmp);
        } else {
            return _($tmp) . str_replace($tmp, '', $shot);
        }
    }
    return empty($shot) ? $shot : _($shot);
}

function shot_abbr(string $shot) {
    switch ($shot) {
        case 'Reimu': return 'Re';
        case 'ReimuA': return 'RA';
        case 'ReimuB': return 'RB';
        case 'ReimuC': return 'RC';
        case 'Marisa': return 'Ma';
        case 'MarisaA': return 'MA';
        case 'MarisaB': return 'MB';
        case 'MarisaC': return 'MC';
        case 'Sakuya': return 'Sk';
        case 'SakuyaA': return 'SA';
        case 'SakuyaB': return 'SB';
        case 'Sanae': return 'Sa';
        case 'SanaeA': return 'SA';
        case 'SanaeB': return 'SB';
        case 'BorderTeam': return 'BT';
        case 'MagicTeam': return 'MT';
        case 'ScarletTeam': return 'ST';
        case 'GhostTeam': return 'GT';
        case 'Yukari': return 'Yu';
        case 'Alice': return 'Al';
        case 'Remilia': return 'Rr';
        case 'Youmu': return 'Yo';
        case 'Yuyuko': return 'Yy';
        case 'Reisen': return 'Ud';
        case 'Cirno': return 'Ci';
        case 'Lyrica': return 'Ly';
        case 'Mystia': return 'My';
        case 'Tewi': return 'Te';
        case 'Aya': return 'Ay';
        case 'Medicine': return 'Me';
        case 'Yuuka': return 'Yu';
        case 'Komachi': return 'Ko';
        case 'Eiki': return 'Ei';
        case 'Hatate': return 'Ha';
        case 'A1': return 'A1';
        case 'A2': return 'A2';
        case 'B1': return 'B1';
        case 'B2': return 'B2';
        case 'C1': return 'C1';
        case 'C2': return 'C2';
        case '-': return 'tr';
        case 'ReimuSpring': return 'RS';
        case 'ReimuSummer': return 'RU';
        case 'ReimuAutumn': return 'RA';
        case 'ReimuWinter': return 'RW';
        case 'CirnoSpring': return 'CS';
        case 'CirnoSummer': return 'CU';
        case 'CirnoAutumn': return 'CA';
        case 'CirnoWinter': return 'CW';
        case 'AyaSpring': return 'AS';
        case 'AyaSummer': return 'AU';
        case 'AyaAutumn': return 'AA';
        case 'AyaWinter': return 'AW';
        case 'MarisaSpring': return 'MS';
        case 'MarisaSummer': return 'MU';
        case 'MarisaAutumn': return 'MA';
        case 'MarisaWinter': return 'MW';
        case 'ReimuWolf': return 'RW';
        case 'ReimuOtter': return 'RO';
        case 'ReimuEagle': return 'RE';
        case 'MarisaWolf': return 'MW';
        case 'MarisaOtter': return 'MO';
        case 'MarisaEagle': return 'ME';
        case 'YoumuWolf': return 'YW';
        case 'YoumuOtter': return 'YO';
        case 'YoumuEagle': return 'YE';
        default: return '';
    }
}
?>
