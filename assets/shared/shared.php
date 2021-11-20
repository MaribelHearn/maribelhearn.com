<?php
function is_localhost(string $addr) {
    return $addr == '::1' || $addr == '127.0.0.1' || substr($addr, 0, 8) == '192.168.';
}
function closest_page($url) {
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
function redirect_to_closest($url) {
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
function redirect($page, $page_path, $request, $error) {
    if (!file_exists($page_path) && $page != 'index' || !empty($error)) {
        $page = 'error';
        $url = substr($request, 1);
        $json = file_get_contents('assets/json/admin.json');
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
        $token = trim(file_get_contents($path . 'token'));
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
function lang_code() {
    if (empty($_GET['hl']) && !isset($_COOKIE['lang'])) {
        return 'en';
    } else if (!empty($_GET['hl'])) {
        $iso = preg_split('/-/', $_GET['hl'])[0];
        $iso = str_replace('jp', 'ja', $iso);
        $iso = str_replace('ru', 'zh', $iso);
        return $iso;
    } else if (isset($_COOKIE['lang'])) {
		if (str_replace('"', '', $_COOKIE['lang']) == 'Russian') {
			return 'zh';
		} else if (str_replace('"', '', $_COOKIE['lang']) == 'Chinese') {
			return 'zh';
		} else if (str_replace('"', '', $_COOKIE['lang']) == 'Japanese') {
			return 'ja';
		} else {
			return 'en';
		}
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
function theme_name() {
    return isset($_COOKIE['theme']) ? 'Youkai Mode (click to toggle)' : 'Human Mode (click to toggle)';
}
function touhou_sites() {
    return '<p><a href="https://en.touhouwiki.net">' .
    '<span class="icon wiki_icon"></span>Touhou Wiki</a></p>' .
    '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
    '<span class="icon thcrap_icon"></span>THPatch</a></p>' .
    '<p><a href="http://replay.lunarcast.net">' .
    '<span class="icon lunarcast_icon"></span>Lunarcast</a></p>' .
    '<p><a href="http://score.royalflare.net">' .
    '<span class="icon royalflare_icon"></span>Royalflare</a></p>' .
    '<p><a href="https://thscore.pndsng.com/index.php">' .
    '<span class="icon pndsng_icon"></span>PND List</a></p>' .
    '<p><a href="https://priw8.github.io">' .
    '<span class="icon priw8_icon"></span>Priw8\'s Site</a></p>' .
    '<p><a href="https://exphp.github.io/thpages">' .
    '<span class="icon exphp_icon"></span>ExpHP\'s Site</a></p>' .
    '<p><a href="https://wikiwiki.jp/thscorekg/">' .
    '<span class="icon kg_icon"></span>KG\'s Site</a></p>';
    //$navbar .= '<p><a href="https://zps-stg.github.io">' .
    //'<span class="icon zps_icon"></span>ZPS\'s Site</a></p>';
}
function show_admin(string $token_path) {
    return is_localhost($_SERVER['REMOTE_ADDR']) || isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents($token_path));
}
function navbar(string $page) {
    $token_path = ($page == 'admin' ? '../.stats/token' : '.stats/token');
    $navbar = '<div class="dropdown nav_left">';
    $navbar .= '<a href="/"><span class="icon index_icon"></span> Index</a> | ';

    if (show_admin($token_path)) {
        $navbar .= '<a href="admin">Admin</a> | ';
    }

    $navbar .= '<a href="about">About Me</a> | <a href="privacy">Privacy Policy</a> ';

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
                $navbar .= '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
                '<span class="icon youtube_icon"></span>YouTube</a></p>';
                $navbar .= '<p><a href="https://twitter.com/MaribelHearn42">' .
                '<span class="icon twitter_icon"></span>Twitter</a></p>';
                $navbar .= '<p><a href="https://www.twitch.tv/maribel_hearn">' .
                '<span class="icon twitch_icon"></span>Twitch</a></p>';
                $navbar .= '<p><a href="https://steamcommunity.com/id/maribelhearn42">' .
                '<span class="icon steam_icon"></span>Steam</a></p>';
                $navbar .= '<p><a href="https://github.com/MaribelHearn">' .
                '<span class="icon github_icon"></span>GitHub</a></p>';
                $navbar .= '<p><a href="https://github.com/MaribelHearn/maribelhearn.com">' .
                '<span class="icon source_icon"></span>Source</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div>';
    $navbar .= '</div>';
    $navbar .= '<div class="dropdowns' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Games&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="scoring"><span class="icon scoring_icon"></span> Scoring</a></p>';
                $navbar .= '<p><a href="survival"><span class="icon survival_icon"></span> Survival</a></p>';
                $navbar .= '<p><a href="drc"><span class="icon drc_icon"></span> DRC</a></p>';
                $navbar .= '<p><a href="tools"><span class="icon tools_icon"></span> Tools</a></p>';
                $navbar .= '<p><a href="wr"><span class="icon wr_icon"></span> WR</a></p>';
                $navbar .= '<p><a href="lnn"><span class="icon lnn_icon"></span> LNN</a></p>';
                $navbar .= '<p><a href="jargon"><span class="icon jargon_icon"></span> Jargon</a></p>';
                $navbar .= '<p><a href="trs"><span class="icon trs_icon"></span> TRS</a></p>';
                $navbar .= '<p><a href="gensokyo"><span class="icon gensokyo_icon"></span> Archive</a></p>';
                $navbar .= '<p><a href="pofv"><span class="icon pofv_icon"></span> PoFV</a></p>';
                $navbar .= '<p><a href="twc"><span class="icon twc_icon"></span> TWC</a></p>';
                $navbar .= '<p><a href="fangame"><span class="icon fangame_icon"></span> Fangame</a></p>';
                $navbar .= '<p><a href="faq"><span class="icon faq_icon"></span> FAQ</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Other&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="thvote"><span class="icon thvote_icon"></span> Poll</a></p>';
                $navbar .= '<p><a href="tiers"><span class="icon tiers_icon"></span> Tiers</a></p>';
                $navbar .= '<p><a href="slots"><span class="icon slots_icon"></span> Slots</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Personal&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="history"><span class="icon history_icon"></span> History</a></p>';
                $navbar .= '<p><a href="c67"><span class="icon c67_icon"></span> C67</a></p>';
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
                    $navbar .= '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
                    '<span class="icon youtube_icon"></span>YouTube</a></p>';
                    $navbar .= '<p><a href="https://twitter.com/MaribelHearn42">' .
                    '<span class="icon twitter_icon"></span>Twitter</a></p>';
                    $navbar .= '<p><a href="https://www.twitch.tv/maribel_hearn">' .
                    '<span class="icon twitch_icon"></span>Twitch</a></p>';
                    $navbar .= '<p><a href="https://steamcommunity.com/id/maribelhearn42">' .
                    '<span class="icon steam_icon"></span>Steam</a></p>';
                    $navbar .= '<p><a href="https://github.com/MaribelHearn">' .
                    '<span class="icon github_icon"></span>GitHub</a></p>';
                    $navbar .= '<p><a href="https://github.com/MaribelHearn/maribelhearn.com">' .
                    '<span class="icon source_icon"></span>Source</a></p>';
                $navbar .= '</div>';
            $navbar .= '</div>';
        $navbar .= '</div>';
    $navbar .= '</div>';
    $navbar = str_replace('<a href="' . ($page == 'index' ? '/' : $page) . '">', '<strong>', $navbar);
    $cap = strlen($page) < 4 ? strtoupper($page) : ucfirst($page);
    if ($page == 'gensokyo') {
        $cap = 'Archive';
    } else if ($page == 'thvote') {
        $cap = 'Poll';
    } else if ($page == 'pofv') {
        $cap = 'PoFV';
    } else if ($page == 'admin') {
        $cap = 'Admin';
    } else if ($page == 'about') {
        $cap = 'About Me';
    } else if ($page == 'privacy') {
        $cap = 'Privacy Policy';
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
?>
