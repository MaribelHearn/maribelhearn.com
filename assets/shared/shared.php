<?php
function is_localhost(string $addr) {
    return $addr == '::1' || $addr == '127.0.0.1' || substr($addr, 0, 8) == '192.168.';
}
function hit(string $filename) {
    $path = $filename == 'error.php' ? '../../.stats/' : '.stats/';
    if (file_exists($path)) {
        if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('~(bot|crawl|slurp|spider|archiver|facebook|lighthouse|jigsaw|validator|w3c|hexometer)~i', $_SERVER['HTTP_USER_AGENT'])) {
            return;
        }
        $token = trim(file_get_contents($path . 'token'));
        if (!is_localhost($_SERVER['REMOTE_ADDR']) && !isset($_COOKIE['token']) || $_COOKIE['token'] !== $token) {
            $page = str_replace('.php', '', $filename);
            $hitcount = $path . date('d-m-Y') . '.json';
            if (!file_exists($hitcount)) {
                $stats = array($page => 1);
                $file = fopen($hitcount, 'w');
                fwrite($file, json_encode($stats));
            } else {
                $file = fopen($hitcount, 'w+');
                if (flock($file, LOCK_EX)) {
                    $json = fread($file, filesize($hitcount));
                    $stats = json_decode($json, true);
                    if (isset($stats[$page])) {
                        $stats[$page] += 1;
                    } else {
                        $stats[$page] = 1;
                    }
                    fwrite($file, json_encode($stats));
                    flock($file, LOCK_UN);
                }
            }
            fclose($file);
        }
    }
}
function dark_theme($page = 'other') {
    if (isset($_COOKIE['theme'])) {
        if ($page == 'error') {
            return '<link id="dark_theme" rel="stylesheet" type="text/css" href="https://maribelhearn.com/assets/shared/dark.css">';
        }
        return '<link id="dark_theme" rel="stylesheet" type="text/css" ' .
        'href="' . ($page == 'admin' ? '../' : '') . 'assets/shared/dark.css">';
    }
    return '';
}
function theme_name() {
    return isset($_COOKIE['theme']) ? 'Youkai Mode (click to toggle)' : 'Human Mode (click to toggle)';
}
function navbar(string $page) {
    $token_path = ($page == 'admin' ? '../.stats/token' : '.stats/token');
    $token_path = ($page == 'error' ? '../../' . $token_path : $token_path);
    $navbar = '<div class="dropdown nav_left">';
    $navbar .= '<a href="/"><span class="icon index_icon"></span> Index</a> | ';

    if (isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents($token_path))) {
        $navbar .= '<a href="admin">Admin</a> | ';
    }

    $navbar .= '<a href="about">About Me</a> | <a href="privacy">Privacy Policy</a> ';
    $navbar .= '</div><div class="nav_right">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
                '<span class="icon thcrap_icon"></span>THPatch</a></p>';
                $navbar .= '<p><a href="http://replay.lunarcast.net">' .
                '<span class="icon lunarcast_icon"></span>Lunarcast</a></p>';
                $navbar .= '<p><a href="http://score.royalflare.net">' .
                '<span class="icon royalflare_icon"></span>Royalflare</a></p>';
                $navbar .= '<p><a href="https://thscore.pndsng.com/index.php">' .
                '<span class="icon pndsng_icon"></span>PND List</a></p>';
                //$navbar .= '<p><a href="https://zps-stg.github.io">' .
                //'<span class="icon exphp_icon"></span>ZPS\'s Site</a></p>';
                $navbar .= '<p><a href="https://priw8.github.io">' .
                '<span class="icon priw8_icon"></span>Priw8\'s Site</a></p>';
                $navbar .= '<p><a href="https://exphp.github.io/thpages/">' .
                '<span class="icon exphp_icon"></span>ExpHP\'s Site</a></p>';
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
                $navbar .= '<p><a href="gensokyo"><span class="icon gensokyo_icon"></span> Archive</a></p>';
                $navbar .= '<p><a href="pofv"><span class="icon pofv_icon"></span> PoFV</a></p>';
                $navbar .= '<p><a href="twc"><span class="icon twc_icon"></span> TWC</a></p>';
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
        $navbar .= '<div id="ext_mobile">';
            $navbar .= '<div class="dropdown">';
                $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
                $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                    $navbar .= '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
                    '<span class="icon thcrap_icon"></span>THPatch</a></p>';
                    $navbar .= '<p><a href="http://replay.lunarcast.net">' .
                    '<span class="icon lunarcast_icon"></span>Lunarcast</a></p>';
                    $navbar .= '<p><a href="http://score.royalflare.net">' .
                    '<span class="icon royalflare_icon"></span>Royalflare</a></p>';
                    $navbar .= '<p><a href="https://thscore.pndsng.com/index.php">' .
                    '<span class="icon pndsng_icon"></span>PND List</a></p>';
                    //$navbar .= '<p><a href="https://zps-stg.github.io">' .
                    //'<span class="icon exphp_icon"></span>ZPS\'s Site</a></p>';
                    $navbar .= '<p><a href="https://priw8.github.io">' .
                    '<span class="icon priw8_icon"></span>Priw8\'s Site</a></p>';
                    $navbar .= '<p><a href="https://exphp.github.io/thpages">' .
                    '<span class="icon exphp_icon"></span>ExpHP\'s Site</a></p>';
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
