<?php
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
    foreach (glob('*/*/*') as $file) {
        if (strpos($file, '.php') && !strpos($file, '_') && $file != 'error.php') {
            $matching_page = substr(preg_split('/\//', $file)[2], 0, -4);
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
        $token = (file_exists($path . 'token')) ? trim(file_get_contents($path . 'token')) : '');
        if (is_localhost($ip) || !isset($_COOKIE['token']) || $_COOKIE['token'] !== $token) {
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
                    } else {
                        $stats[$page] = (object) array();
                        $stats[$page]->hits = 1;
                        $stats[$page]->ips = (object) array();
                        $stats[$page]->ips->{$ip} = 1;
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
    '<span class="icon twc_icon"></span> Touhou World Cup</a></p>';
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
function show_admin(string $token_path) {
    return is_localhost($_SERVER['REMOTE_ADDR']) || isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents($token_path));
}
function navbar(string $page) {
    $token_path = ($page == 'admin' ? '../.stats/token' : '.stats/token');
    $navbar = '<div class="dropdown nav_left">';
    $navbar .= '<a href="/"><span class="icon index_icon"></span> Index</a> | ';

    if (show_admin($token_path)) {
        $navbar .= '<a href="/admin">Admin</a> | ';
    }

    $navbar .= '<a href="/about">About Me</a> | <a href="/credits">Credits</a> | <a href="/privacy">Privacy</a> ';

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
                $navbar .= '<p><a href="/scoring"><span class="icon scoring_icon"></span> Scoring</a></p>';
                $navbar .= '<p><a href="/survival"><span class="icon survival_icon"></span> Survival</a></p>';
                $navbar .= '<p><a href="/drc"><span class="icon drc_icon"></span> DRC</a></p>';
                $navbar .= '<p><a href="/tools"><span class="icon tools_icon"></span> Tools</a></p>';
                $navbar .= '<p><a href="/wr"><span class="icon wr_icon"></span> WR</a></p>';
                $navbar .= '<p><a href="/lnn"><span class="icon lnn_icon"></span> LNN</a></p>';
                $navbar .= '<p><a href="/jargon"><span class="icon jargon_icon"></span> Jargon</a></p>';
                $navbar .= '<p><a href="/trs"><span class="icon trs_icon"></span> TRS</a></p>';
                $navbar .= '<p><a href="/gensokyo"><span class="icon gensokyo_icon"></span> Gensokyo</a></p>';
                $navbar .= '<p><a href="/pofv"><span class="icon pofv_icon"></span> PoFV</a></p>';
                $navbar .= '<p><a href="/fangame"><span class="icon fangame_icon"></span> Fangame</a></p>';
                $navbar .= '<p><a href="/faq"><span class="icon faq_icon"></span> FAQ</a></p>';
                $navbar .= '<p><a href="/royalflare"><span class="icon royalflare_icon"></span> Royalflare</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Other&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="/thvote"><span class="icon thvote_icon"></span> Poll</a></p>';
                $navbar .= '<p><a href="/tiers"><span class="icon tiers_icon"></span> Tiers</a></p>';
                $navbar .= '<p><a href="/slots"><span class="icon slots_icon"></span> Slots</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Personal&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="/history"><span class="icon history_icon"></span> History</a></p>';
                $navbar .= '<p><a href="/c67"><span class="icon c67_icon"></span> C67</a></p>';
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
    } else if ($page == 'about') {
        $cap = 'About Me';
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
        '"><span id="hy"></span><p id="hy_text">' . (isset($_COOKIE['theme']) ? _('Youkai mode (Dark)') : _('Human mode (Light)')) . '</p></a></span>';
    }
    if ($page == 'lnn' || $page == 'wr') {
        echo '<span id="toggle"><a id="layouttoggle" href="' . $page . '">' . ($layout == 'New' ? 'Old' : 'New') . ' layout</a></span>';
    }
    if (has_translation($page)) {
        echo '<div id="languages">';
        if ($page == 'wr') {
            echo '<a id="en-gb" class="flag" href="wr?hl=en-gb">' .
            '<img class="flag_en" src="assets/shared/flags/uk.png" alt="' . _('Flag of the United Kingdom') . '">' .
            '<p class="language">English (UK)</p></a><a id="en-us" class="flag" href="wr?hl=en-us">' .
            '<img class="flag_en" src="assets/shared/flags/us.png" alt="' . _('Flag of the United States') . '">' .
            '<p class="language">English (US)</p></a> ';
        } else {
            echo '<a id="en" class="flag" href="' . $page . '?hl=en">' .
            '<img class="flag_en" src="assets/shared/flags/uk.png" alt="' . _('Flag of the United Kingdom') . '"><p class="language">English</p></a> ';
        }
        if (has_translation($page, 'ja')) {
            echo '<a id="jp" class="flag" href="' . $page . '?hl=jp">' .
            '<img src="assets/shared/flags/japan.png" alt="' . _('Flag of Japan') . '"><p class="language">日本語</p></a> ';
        }
        if (has_translation($page, 'zh')) {
            echo '<a id="zh" class="flag" href="' . $page . '?hl=zh">' .
            '<img src="assets/shared/flags/china.png" alt="' . _('Flag of the P.R.C.') . '"><p class="language">简体中文</p></a> ';
        }
        if (has_translation($page, 'ru')) {
            echo '<a id="ru" class="flag" href="' . $page . '?hl=ru">' .
            '<img src="assets/shared/flags/russia.png" alt="' . _('Flag of Russia') . '"><p class="language">Русский</p></a>';
        }
        if (has_translation($page, 'de')) {
            echo '<a id="de" class="flag" href="' . $page . '?hl=de">' .
            '<img src="assets/shared/flags/germany.png" alt="' . _('Flag of Germany') . '"><p class="language">Deutsch</p></a>';
        }
        if (has_translation($page, 'es')) {
            echo '<a id="es" class="flag" href="' . $page . '?hl=es">' .
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
                    return '<strong class="error">Error: the file upload failed for an unknown reason.</strong>';
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
                return '<strong class="error">Error: the file exceeds the upload size limit.</strong>';
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
?>
