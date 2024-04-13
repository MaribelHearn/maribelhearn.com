<?php
function touhou_sites() {
    return '<p><a href="https://en.touhouwiki.net">' .
    '<span class="icon thwiki_icon"></span>Touhou Wiki</a></p>' .
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
    '<span class="icon twc_icon"></span>Touhou World Cup</a></p>' .
    '<p><a href="https://nylilsa.github.io">' .
    '<span class="icon nylilsa_icon"></span>Nylilsa\'s Site</a></p>' .
    '<p><a href="https://zps-stg.github.io">' .
    '<span class="icon zps_icon"></span>ZPS\'s Site</a></p>';
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
    return '<p><a href="/scoring"><span class="icon scoring_icon"></span>Scoring</a></p>' .
    '<p><a href="/survival"><span class="icon survival_icon"></span>Survival</a></p>' .
    '<p><a href="/drc"><span class="icon drc_icon"></span>DRC</a></p>' .
    '<p><a href="/tools"><span class="icon tools_icon"></span>Tools</a></p>' .
    '<p><a href="/wr"><span class="icon wr_icon"></span>WR</a></p>' .
    '<p><a href="/lnn"><span class="icon lnn_icon"></span>LNN</a></p>' .
    '<p><a href="/jargon"><span class="icon jargon_icon"></span>Jargon</a></p>' .
    '<p><a href="/trs"><span class="icon trs_icon"></span>TRS</a></p>' .
    '<p><a href="/gensokyo"><span class="icon gensokyo_icon"></span>Gensokyo</a></p>' .
    '<p><a href="/pofv"><span class="icon pofv_icon"></span>PoFV</a></p>' .
    '<p><a href="/fangame"><span class="icon fangame_icon"></span>Fangame</a></p>' .
    '<p><a href="/faq"><span class="icon faq_icon"></span>FAQ</a></p>' .
    '<p><a href="/royalflare"><span class="icon royalflare_icon"></span>Royalflare</a></p>' .
    '<p><a href="https://wiki.maribelhearn.com"><span class="icon wiki_icon"></span>Wiki</a></p>';
}

function other_pages() {
    return '<p><a href="/thvote"><span class="icon thvote_icon"></span>Poll</a></p>' .
    '<p><a href="/tiers"><span class="icon tiers_icon"></span>Tiers</a></p>' .
    '<p><a href="/slots"><span class="icon slots_icon"></span>Slots</a></p>';
}

function personal_pages() {
    return '<p><a href="/about"><span class="icon"></span>About</a></p>' .
    '<p><a href="/history"><span class="icon history_icon"></span>History</a></p>' .
    '<p><a href="/c67"><span class="icon c67_icon"></span>C67</a></p>';
}

function show_admin(string $token_path) {
    return is_localhost($_SERVER['REMOTE_ADDR']) || isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents($token_path));
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
    $navbar .= '<a href="/contact">Contact</a> ';

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
?>