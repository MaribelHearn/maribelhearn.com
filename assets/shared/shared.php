<?php
function hit($page) {
    $errors = ['401.php', '403.php', '404.php', '500.php'];
    $path = in_array($page, $errors) ? '../../.stats/token' : '.stats/token';
    if (file_exists($path)) {
        if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('~(bot|crawl|slurp|spider|archiver|facebook|lighthouse|jigsaw|validator|w3c|hexometer)~i', $_SERVER['HTTP_USER_AGENT'])) {
            return;
        }
        $token = trim(file_get_contents('.stats/token'));
        if ($_SERVER['SERVER_NAME'] !== 'localhost' && $_COOKIE['token'] !== $token) {
            $page = str_replace('.php', '', $page);
            $hitcount = '.stats/' . date('d-m-Y') . '.json';
            if (file_exists($hitcount)) {
                $json = file_get_contents($hitcount);
                $stats = json_decode($json, true);
                if (isset($stats[$page])) {
                    $stats[$page] += 1;
                } else {
                    $stats[$page] = 1;
                }
            } else {
                $stats = array($page => 1);
            }
            $file = fopen($hitcount, 'w');
            fwrite($file, json_encode($stats));
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
function navbar($page) {
    $token_path = ($page == 'admin' ? '../.stats/token' : '.stats/token');
    $token_path = ($page == 'error' ? '../../' . $token_path : $token_path);
    $navbar = '<div class="dropdown nav_left">';
    $navbar .= '<a href="/"><img class="icon index_icon" src="assets/shared/icon_sheet.png" alt="Cherry blossom icon"> Index</a> | ';

    if (isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents($token_path))) {
        $navbar .= '<a href="admin">Admin</a> | ';
    }

    $navbar .= '<a href="about">About Me</a> | <a href="privacy">Privacy Policy</a> ';
    $navbar .= '</div><div class="nav_right">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
                '<img class="icon thcrap_icon" src="assets/shared/icon_sheet.png" alt="Thpatch favicon">THPatch</a></p>';
                $navbar .= '<p><a href="http://replay.lunarcast.net">' .
                '<img class="icon lunarcast_icon" src="assets/shared/icon_sheet.png" alt="Lunarcast favicon">Lunarcast</a></p>';
                $navbar .= '<p><a href="http://score.royalflare.net">' .
                '<img class="icon royalflare_icon" src="assets/shared/icon_sheet.png" alt="Royalflare favicon">Royalflare</a></p>';
                $navbar .= '<p><a href="https://thscore.pndsng.com/index.php">' .
                '<img class="icon pndsng_icon" src="assets/shared/icon_sheet.png" alt="Pndsng favicon">PND List</a></p>';
                $navbar .= '<p><a href="https://priw8.github.io">' .
                '<img class="icon priw8_icon" src="assets/shared/icon_sheet.png" alt="Priw8 favicon">Priw8\'s Site</a></p>';
                $navbar .= '<p><a href="https://exphp.github.io/thpages/">' .
                '<img class="icon exphp_icon" src="assets/shared/icon_sheet.png" alt="ExpHP favicon">ExpHP\'s Site</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Links&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
                '<img class="icon youtube_icon" src="assets/shared/icon_sheet.png" alt="Youtube favicon">YouTube</a></p>';
                $navbar .= '<p><a href="https://twitter.com/MaribelHearn42">' .
                '<img class="icon twitter_icon" src="assets/shared/icon_sheet.png" alt="Twitter favicon">Twitter</a></p>';
                $navbar .= '<p><a href="https://www.twitch.tv/maribel_hearn">' .
                '<img class="icon twitch_icon" src="assets/shared/icon_sheet.png" alt="Twitch favicon">Twitch</a></p>';
                $navbar .= '<p><a href="https://steamcommunity.com/id/maribelhearn42">' .
                '<img class="icon steam_icon" src="assets/shared/icon_sheet.png" alt="Steam favicon">Steam</a></p>';
                $navbar .= '<p><a href="https://github.com/MaribelHearn">' .
                '<img class="icon github_icon" src="assets/shared/icon_sheet.png" alt="GitHub favicon">GitHub</a></p>';
                $navbar .= '<p><a href="https://github.com/MaribelHearn/maribelhearn.com">' .
                '<img class="icon source_icon" src="assets/shared/icon_sheet.png" alt="Code brackets icon">Source</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div>';
    $navbar .= '</div>';
    $navbar .= '<div class="dropdowns' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Games&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="scoring"><img class="icon scoring_icon" src="assets/shared/icon_sheet.png" alt="Spell Card icon"> Scoring</a></p>';
                $navbar .= '<p><a href="survival"><img class="icon survival_icon" src="assets/shared/icon_sheet.png" alt="1up item icon"> Survival</a></p>';
                $navbar .= '<p><a href="drc"><img class="icon drc_icon" src="assets/shared/icon_sheet.png" alt="Power item icon"> DRC</a></p>';
                $navbar .= '<p><a href="tools"><img class="icon tools_icon" src="assets/shared/icon_sheet.png" alt="UFO icon"> Tools</a></p>';
                $navbar .= '<p><a href="wr"><img class="icon wr_icon" src="assets/shared/icon_sheet.png" alt="Point item icon"> WR</a></p>';
                $navbar .= '<p><a href="lnn"><img class="icon lnn_icon" src="assets/shared/icon_sheet.png" alt="Full Power icon"> LNN</a></p>';
                $navbar .= '<p><a href="jargon"><img class="icon jargon_icon" src="assets/shared/icon_sheet.png" alt="Bomb icon"> Jargon</a></p>';
                $navbar .= '<p><a href="gensokyo"><img class="icon gensokyo_icon" src="assets/shared/icon_sheet.png" alt="Gensokyo.org icon"> Archive</a></p>';
                $navbar .= '<p><a href="pofv"><img class="icon pofv_icon" src="assets/shared/icon_sheet.png" alt="PoFV icon"> PoFV</a></p>';
                //$navbar .= '<p><a href="twc"><img class="icon twc_icon" src="assets/shared/icon_sheet.png" alt="Touhou World Cup icon"> TWC</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Other&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="thvote"><img class="icon thvote_icon" src="assets/shared/icon_sheet.png" alt="Tou kanji icon"> Poll</a></p>';
                $navbar .= '<p><a href="tiers"><img class="icon tiers_icon" src="assets/shared/icon_sheet.png" alt="Japanese castle icon"> Tiers</a></p>';
                $navbar .= '<p><a href="slots"><img class="icon slots_icon" src="assets/shared/icon_sheet.png" alt="Heart icon"> Slots</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Personal&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<p><a href="history"><img class="icon history_icon" src="assets/shared/icon_sheet.png" alt="Maribel icon"> History</a></p>';
                $navbar .= '<p><a href="c67"><img class="icon c67_icon" src="assets/shared/icon_sheet.png" alt="Banshiryuu C67 icon"> C67</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div id="ext_mobile">';
            $navbar .= '<div class="dropdown">';
                $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
                $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                    $navbar .= '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
                    '<img class="icon thcrap_icon" src="assets/shared/icon_sheet.png" alt="Thpatch favicon">THPatch</a></p>';
                    $navbar .= '<p><a href="http://replay.lunarcast.net">' .
                    '<img class="icon lunarcast_icon" src="assets/shared/icon_sheet.png" alt="Lunarcast favicon">Lunarcast</a></p>';
                    $navbar .= '<p><a href="http://score.royalflare.net">' .
                    '<img class="icon royalflare_icon" src="assets/shared/icon_sheet.png" alt="Royalflare favicon">Royalflare</a></p>';
                    $navbar .= '<p><a href="https://thscore.pndsng.com/index.php">' .
                    '<img class="icon pndsng_icon" src="assets/shared/icon_sheet.png" alt="Pndsng favicon">PND List</a></p>';
                    $navbar .= '<p><a href="https://priw8.github.io">' .
                    '<img class="icon priw8_icon" src="assets/shared/icon_sheet.png" alt="Priw8 favicon">Priw8\'s Site</a></p>';
                    $navbar .= '<p><a href="https://exphp.github.io/thpages">' .
                    '<img class="icon exphp_icon" src="assets/shared/icon_sheet.png" alt="ExpHP favicon">ExpHP\'s Site</a></p>';
                $navbar .= '</div>';
            $navbar .= '</div> ';
            $navbar .= '<div class="dropdown">';
                $navbar .= '<a href="#" class="dropdown_button">Links&#x25BF;</a>';
                $navbar .= '<div class="dropdown_content dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                    $navbar .= '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
                    '<img class="icon youtube_icon" src="assets/shared/icon_sheet.png" alt="Youtube favicon">YouTube</a></p>';
                    $navbar .= '<p><a href="https://twitter.com/MaribelHearn42">' .
                    '<img class="icon twitter_icon" src="assets/shared/icon_sheet.png" alt="Twitter favicon">Twitter</a></p>';
                    $navbar .= '<p><a href="https://www.twitch.tv/maribel_hearn">' .
                    '<img class="icon twitch_icon" src="assets/shared/icon_sheet.png" alt="Twitch favicon">Twitch</a></p>';
                    $navbar .= '<p><a href="https://steamcommunity.com/id/maribelhearn42">' .
                    '<img class="icon steam_icon" src="assets/shared/icon_sheet.png" alt="Steam favicon">Steam</a></p>';
                    $navbar .= '<p><a href="https://github.com/MaribelHearn">' .
                    '<img class="icon github_icon" src="assets/shared/icon_sheet.png" alt="GitHub favicon">GitHub</a></p>';
                    $navbar .= '<p><a href="https://github.com/MaribelHearn/maribelhearn.com">' .
                    '<img class="icon source_icon" src="assets/shared/icon_sheet.png" alt="Code brackets icon">Source</a></p>';
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
