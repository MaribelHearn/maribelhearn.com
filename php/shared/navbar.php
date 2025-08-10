<?php
function affiliate_sites() {
    return '<p><a href="https://touhouworldcup.com">' .
    '<span class="icon twc_icon"></span>Touhou World Cup</a></p>' .
    '<p><a href="https://touhoureplayshowcase.com">' .
    '<span class="icon trs_icon"></span>Touhou Replay Showcase</a></p>' .
    '<p><a href="https://priw8.github.io">' .
    '<span class="icon priw8_icon"></span>Priw8\'s site</a></p>' .
    '<p><a href="https://exphp.github.io/thpages">' .
    '<span class="icon exphp_icon"></span>ExpHP\'s site</a></p>' .
    '<p><a href="https://gensakudan.com/">' .
    '<span class="icon gsd_icon"></span>Retrograde Road</a></p>' .
    '<p><a href="https://nylilsa.github.io">' .
    '<span class="icon nylilsa_icon"></span>Nylilsa\'s site</a></p>' .
    '<p><a href="https://zps-stg.github.io">' .
    '<span class="icon zps_icon"></span>ZPS\'s site</a></p>' .
    '<p><a href="https://touhou-memories.com/">' .
    '<span class="icon memories_icon"></span>touhou-memories</a></p>' .
    '<p><a href="https://thelibraryoflotus.neocities.org/">' .
    '<span class="icon rox_icon"></span>Library of Lotus</a></p>';
}

function touhou_sites() {
    return '<p><a href="https://en.touhouwiki.net">' .
    '<span class="icon thwiki_icon"></span>Touhou Wiki</a></p>' .
    '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
    '<span class="icon thcrap_icon"></span>THPatch</a></p>' .
    '<p><a href="https://www.silentselene.net/">' .
    '<span class="icon ss_icon"></span>Silent Selene</a></p>' .
    '<p><a href="http://replay.lunarcast.net">' .
    '<span class="icon lunarcast_icon"></span>Lunarcast</a></p>' .
    '<p><a href="https://thscore.pndsng.com/index.php">' .
    '<span class="icon pndsng_icon"></span>PND List</a></p>' .
    '<p><a href="https://thex-score.net/">' .
    '<span class="icon thex_icon"></span>Touhou Extra Scoreboard</a></p>' .
    '<p><a href="https://wikiwiki.jp/thscorekg/">' .
    '<span class="icon kg_icon"></span>KG\'s Site</a></p>';
}

function own_sites() {
    return '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
    '<span class="icon youtube_icon"></span>YouTube</a></p>' .
    '<p><a href="https://bsky.app/profile/maribelhearn42.bsky.social">' .
    '<span class="icon bluesky_icon"></span>Bluesky</a></p>' .
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
    '<p><a href="/slots"><span class="icon slots_icon"></span>Slots</a></p>' .
    '<p><a href="/touhoumon"><span class="icon touhoumon_icon"></span>Touhoumon</a></p>';
}

function personal_pages(bool $is_mobile, string $token_path) {
    $personal_pages = '<p><a href="/about"><span class="icon"></span>About</a></p>' .
    '<p><a href="/history"><span class="icon history_icon"></span>History</a></p>' .
    '<p><a href="/c67"><span class="icon c67_icon"></span>C67</a></p>';
    if ($is_mobile && show_admin($token_path)) {
        $personal_pages = '<p><a href="/admin"><span class="icon"></span>Admin</a></p>' . $personal_pages;
    }
    return $personal_pages;
}

function show_admin(string $token_path) {
    return is_localhost($_SERVER['REMOTE_ADDR']) || isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents($token_path));
}

function show_db(string $db_cookie_path) {
    $name = file_get_contents($db_cookie_path);
    return is_localhost($_SERVER['REMOTE_ADDR']) || isset($_COOKIE[$name]) && strlen($_COOKIE[$name]) == 32;
}

function navbar(string $page) {
    global $lang, $is_mobile;
    $token_path = ($page == 'admin' ? '../.stats/token' : '.stats/token');
    $db_cookie_path = ($page == 'admin' ? '../.stats/db_cookie' : '.stats/db_cookie');
    $navbar = '<div class="dropdown nav_left">';
    $navbar .= '<a href="/"><span class="icon index_icon"></span> Index</a>';

    if (is_localhost($_SERVER['REMOTE_ADDR'])) {
        $navbar .= ' <strong class="dev_instance">(Dev)</strong>';
    }

    $navbar .= ' | ';

    if (!$is_mobile && show_admin($token_path)) {
        $navbar .= '<a href="/admin">Admin</a> | ';
    }

    if (show_db($db_cookie_path)) {
        $navbar .= '<a href="/db/">' . ($is_mobile ? 'DB' : 'Database') . '</a> | ';
    }

    $navbar .= '<a href="/credits">Credits</a> | ';
    $navbar .= '<a href="/contact">Contact</a> ';

    if (!show_admin($token_path) && $page != 'index') {
        $navbar .= '| <a href="https://ko-fi.com/maribelhearn42">Buy me a coffee</a>';
    }

    $navbar .= '</div><div class="nav_right">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Affiliates&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_affiliates dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= affiliate_sites();
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_affiliates dropdown_right' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
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
        $navbar .= '<div id="ext_desktop">';
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
                    $navbar .= personal_pages($is_mobile, $token_path);
                $navbar .= '</div>';
            $navbar .= '</div>';
        $navbar .= '</div>';
        $navbar .= '<div id="ext_mobile" class="ext_mobile">';
            $navbar .= '<span class="menu-icon"><span class="nav-icon"></span></span>';
            $navbar .= '<div class="ext_menu dropdown_right ' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                $navbar .= '<div class="dropdown">';
                    $navbar .= '<a href="#" class="dropdown_button">&#x25C3; Games</a>';
                    $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                        $navbar .= game_pages();
                    $navbar .= '</div>';
                $navbar .= '</div>';
                $navbar .= '<div class="dropdown">';
                    $navbar .= '<a href="#" class="dropdown_button">&#x25C3; Other</a>';
                    $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                        $navbar .= other_pages();
                    $navbar .= '</div>';
                $navbar .= '</div>';
                $navbar .= '<div class="dropdown">';
                    $navbar .= '<a href="#" class="dropdown_button">&#x25C3; Personal</a>';
                    $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                        $navbar .= personal_pages($is_mobile, $token_path);
                    $navbar .= '</div>';
                $navbar .= '</div>';
                $navbar .= '<div class="dropdown">';
                    $navbar .= '<a href="#" class="dropdown_button">&#x25C3; Affiliates</a>';
                    $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                        $navbar .= affiliate_sites();
                    $navbar .= '</div>';
                $navbar .= '</div>';
                $navbar .= '<div class="dropdown">';
                    $navbar .= '<a href="#" class="dropdown_button">&#x25C3; Touhou Sites</a>';
                    $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                        $navbar .= touhou_sites();
                    $navbar .= '</div>';
                $navbar .= '</div>';
                $navbar .= '<div class="dropdown">';
                    $navbar .= '<a href="#" class="dropdown_button">&#x25C3; Links</a>';
                    $navbar .= '<div class="dropdown_content' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                        $navbar .= own_sites();
                    $navbar .= '</div>';
                $navbar .= '</div>';
            $navbar .= '</div>';
        $navbar .= '</div>';
        if (has_translation($page)) {
            $navbar .= '<div id="languages_mobile" class="ext_mobile">';
                $navbar .= '<img id="lang_icon" class="lang_icon" src="/assets/shared/langs/lang.png" alt="Language icon">';
                $navbar .= '<img id="lang_icon_dark" class="lang_icon" src="/assets/shared/langs/lang_dark.png" alt="Language icon">';
                $navbar .= '<div class="ext_menu dropdown_right ' . ($page == 'tiers' ? ' dark_bg' : '') . '">';
                    $navbar .= '<ul id="lang_list">';
                        $navbar .= '<li class="subpage flag_container ' . ($lang == 'en_GB' ? 'selected' : '') . '"><a data-lang="en_GB" class="language" href="?hl=en-gb">';
                            $navbar .= '<img class="flag_img" src="/assets/shared/langs/uk.png" alt="' . _('Flag of the United Kingdom') . '"> English (UK)';
                        $navbar .= '</a></li>';
                        if ($page == 'wr' || $page == 'lnn') {
                            $navbar .= '<li class="subpage flag_container ' . ($lang == 'en_US' ? 'selected' : '') . '"><a data-lang="en_US" class="language" href="?hl=en-us">';
                                $navbar .= '<img class="flag_img" src="/assets/shared/langs/us.png" alt="' . _('Flag of the United States') . '"> English (US)';
                            $navbar .= '</a></li>';
                        }
                        if (has_translation($page, 'ja')) {
                            $navbar .= '<li class="subpage flag_container ' . ($lang == 'ja_JP' ? 'selected' : '') . '"><a data-lang="ja_JP" class="language" href="?hl=jp">';
                                $navbar .= '<img class="flag_img" src="/assets/shared/langs/japan.png" alt="' . _('Flag of Japan') . '"> 日本語';
                            $navbar .= '</a></li>';
                        }
                        if (has_translation($page, 'zh')) {
                            $navbar .= '<li class="subpage flag_container ' . ($lang == 'zh_CN' ? 'selected' : '') . '"><a data-lang="zh_CN" class="language" href="?hl=zh">';
                                $navbar .= '<img class="flag_img" src="/assets/shared/langs/china.png" alt="' . _('Flag of the P.R.C.') . '"> 简体中文';
                            $navbar .= '</a></li>';
                        }
                        if (has_translation($page, 'ru')) {
                            $navbar .= '<li class="subpage flag_container ' . ($lang == 'ru_RU' ? 'selected' : '') . '"><a data-lang="ru_RU" class="language" href="?hl=ru">';
                                $navbar .= '<img class="flag_img" src="/assets/shared/langs/russia.png" alt="' . _('Flag of Russia') . '"> Русский';
                            $navbar .= '</a></li>';
                        }
                        if (has_translation($page, 'de')) {
                            $navbar .= '<li class="subpage flag_container ' . ($lang == 'de_DE' ? 'selected' : '') . '"><a data-lang="de_DE" class="language" href="?hl=de">';
                                $navbar .= '<img class="flag_img" src="/assets/shared/langs/germany.png" alt="' . _('Flag of Germany') . '"> Deutsch';
                            $navbar .= '</a></li>';
                        }
                        if (has_translation($page, 'es')) {
                            $navbar .= '<li class="subpage flag_container ' . ($lang == 'es_ES' ? 'selected' : '') . '"><a data-lang="es_ES" class="language" href="?hl=es">';
                                $navbar .= '<img class="flag_img" src="/assets/shared/langs/spain.png" alt="' . _('Flag of Spain') . '"> Español';
                            $navbar .= '</a></li>';
                        }
                    $navbar .= '</ul>';
                $navbar .= '</div>';
            $navbar .= '</div>';
        }
    $navbar .= '</div>';
    $navbar .= '<div id="ext_mobile_spacer"></div>';
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