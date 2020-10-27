<?php
function navbar($page) {
    $navbar = '<span class="nav_left">';
    $navbar .= '<a href="/"><img src="favicon.ico" alt="Cherry blossom icon"> Index</a> | ';

    if (isset($_COOKIE['token']) && $_COOKIE['token'] == trim(file_get_contents('.stats/token'))) {
        $navbar .= '<a href="admin">Admin Panel</a> | ';
    }

    $navbar .= '<a href="about">About Me</a> | <a href="privacy">Privacy Policy</a> ';
    $navbar .= '</span><span class="nav_right">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_right">';
                $navbar .= '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
                '<img src="assets/ext/thcrap-icon-small.ico" alt="Thpatch favicon">THPatch</a></p>';
                $navbar .= '<p><a href="http://replay.lunarcast.net">' .
                '<img src="assets/ext/lunarcast-icon.ico" alt="Lunarcast favicon">Lunarcast</a></p>';
                $navbar .= '<p><a href="http://score.royalflare.net">' .
                '<img src="assets/ext/royalflare-icon.ico" alt="Royalflare favicon">Royalflare</a></p>';
                $navbar .= '<p><a href="https://thscore.pndsng.com/index.php">' .
                '<img src="assets/ext/pndsng-icon.ico" alt="Pndsng favicon">PND List</a></p>';
                $navbar .= '<p><a href="https://priw8.github.io">' .
                '<img src="assets/ext/priw8-icon.ico" alt="Priw8 favicon">Priw8\'s Site</a></p>';
                $navbar .= '<p><a href="https://exphp.github.io/thpages">' .
                '<img src="assets/ext/exphp-icon.ico" alt="ExpHP favicon">ExpHP\'s Site</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Links&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content dropdown_right">';
                $navbar .= '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
                '<img src="assets/ext/youtube-icon-small.png" alt="Youtube favicon">YouTube</a></p>';
                $navbar .= '<p><a href="https://twitter.com/MaribelHearn42">' .
                '<img src="assets/ext/twitter-icon-small.png" alt="Twitter favicon">Twitter</a></p>';
                $navbar .= '<p><a href="https://twitch.tv/maribel_hearn">' .
                '<img src="assets/ext/twitch-icon-small.ico" alt="Twitch favicon">Twitch</a></p>';
                $navbar .= '<p><a href="https://steamcommunity.com/id/maribelhearn42">' .
                '<img src="assets/ext/steam-icon-small.ico" alt="Steam favicon">Steam</a></p>';
                $navbar .= '<p><a href="https://github.com/MaribelHearn">' .
                '<img src="assets/ext/github-icon.ico" alt="GitHub favicon">GitHub</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div>';
    $navbar .= '</span>';
    $navbar .= '<div class="dropdowns">';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Games&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content">';
                $navbar .= '<p><a href="scoring"><img src="assets/scoring/scoring.ico" alt="Spell Card icon"> Scoring</a></p>';
                $navbar .= '<p><a href="survival"><img src="assets/survival/survival.ico" alt="1up item icon"> Survival</a></p>';
                $navbar .= '<p><a href="drc"><img src="assets/drc/drc.ico" alt="Power item icon"> DRC</a></p>';
                $navbar .= '<p><a href="tools"><img src="assets/tools/tools.ico" alt="UFO icon"> Tools</a></p>';
                $navbar .= '<p><a href="wr"><img src="assets/wr/wr.ico" alt="Point item icon"> WR</a></p>';
                $navbar .= '<p><a href="lnn"><img src="assets/lnn/lnn.ico" alt="Full Power icon"> LNN</a></p>';
                $navbar .= '<p><a href="jargon"><img src="assets/jargon/jargon.ico" alt="Bomb icon"> Jargon</a></p>';
                $navbar .= '<p><a href="gensokyo"><img src="assets/gensokyo/gensokyo.ico" alt="Gensokyo.org icon"> Archive</a></p>';
                $navbar .= '<p><a href="pofv"><img src="assets/pofv/pofv.ico" alt="PoFV icon"> PoFV</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Other&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content">';
                $navbar .= '<p><a href="thvote"><img src="assets/thvote/thvote.ico" alt="Tou kanji icon"> Poll</a></p>';
                $navbar .= '<p><a href="tiers"><img src="assets/tiers/tiers.ico" alt="Japanese castle icon"> Tiers</a></p>';
                $navbar .= '<p><a href="slots"><img src="assets/slots/slots.ico" alt="Heart icon"> Slots</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div class="dropdown">';
            $navbar .= '<a href="#" class="dropdown_button">Personal&#x25BF;</a>';
            $navbar .= '<div class="dropdown_content">';
                $navbar .= '<p><a href="history"><img src="assets/history/history.ico" alt="Maribel icon"> History</a></p>';
                $navbar .= '<p><a href="c67"><img src="assets/c67/c67.ico" alt="Banshiryuu C67 icon"> C67</a></p>';
            $navbar .= '</div>';
        $navbar .= '</div> ';
        $navbar .= '<div id="ext_mobile">';
            $navbar .= '<div class="dropdown">';
                $navbar .= '<a href="#" class="dropdown_button">Touhou Sites&#x25BF;</a>';
                $navbar .= '<div class="dropdown_content dropdown_right">';
                    $navbar .= '<p><a href="https://www.thpatch.net/wiki/Touhou_Patch_Center:Main_page">' .
                    '<img src="assets/ext/thcrap-icon-small.ico" alt="Thpatch favicon">THPatch</a></p>';
                    $navbar .= '<p><a href="http://replay.lunarcast.net">' .
                    '<img src="assets/ext/lunarcast-icon.ico" alt="Lunarcast favicon">Lunarcast</a></p>';
                    $navbar .= '<p><a href="http://score.royalflare.net">' .
                    '<img src="assets/ext/royalflare-icon.ico" alt="Royalflare favicon">Royalflare</a></p>';
                    $navbar .= '<p><a href="https://thscore.pndsng.com/index.php">' .
                    '<img src="assets/ext/pndsng-icon.ico" alt="Pndsng favicon">PND List</a></p>';
                    $navbar .= '<p><a href="https://priw8.github.io">Priw8\'s Site</a></p>';
                    $navbar .= '<p><a href="https://exphp.github.io">ExpHP\'s Site</a></p>';
                $navbar .= '</div>';
            $navbar .= '</div> ';
            $navbar .= '<div class="dropdown">';
                $navbar .= '<a href="#" class="dropdown_button">Links&#x25BF;</a>';
                $navbar .= '<div class="dropdown_content dropdown_right">';
                    $navbar .= '<p><a href="https://www.youtube.com/c/MaribelHearn">' .
                    '<img src="assets/ext/youtube-icon-small.png" alt="Youtube favicon">YouTube</a></p>';
                    $navbar .= '<p><a href="https://twitter.com/MaribelHearn42">' .
                    '<img src="assets/ext/twitter-icon-small.png" alt="Twitter favicon">Twitter</a></p>';
                    $navbar .= '<p><a href="https://twitch.tv/maribel_hearn">' .
                    '<img src="assets/ext/twitch-icon-small.ico" alt="Twitch favicon">Twitch</a></p>';
                    $navbar .= '<p><a href="https://steamcommunity.com/id/maribelhearn42">' .
                    '<img src="assets/ext/steam-icon-small.ico" alt="Steam favicon">Steam</a></p>';
                    $navbar .= '<p><a href="https://github.com/MaribelHearn">' .
                    '<img src="assets/ext/github-icon.ico" alt="GitHub favicon">GitHub</a></p>';
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
        $cap = 'Admin Panel';
    } else if ($page == 'about') {
        $cap = 'About Me';
    } else if ($page == 'privacy') {
        $cap = 'Privacy Policy';
    }

    $navbar = str_ireplace($cap . '</a>', $cap . '</strong>', $navbar);

    if ($page == 'admin') {
        $navbar = str_replace('assets', '../assets', $navbar);
        $navbar = str_replace('fav', '../fav', $navbar);
    } else if ($page == 'error') {
        $navbar = str_replace('assets', 'https://maribelhearn.com/assets', $navbar);
        $navbar = str_replace('fav', 'https://maribelhearn.com/fav', $navbar);
    }

    return $navbar;
}
?>
