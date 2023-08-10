<?php
$langs = array('en_GB', 'en_US', 'ja_JP', 'zh_CN', 'ru_RU', 'de_DE', 'es_ES');

function has_space(string $lang) {
    return $lang != 'ja_JP' && $lang != 'zh_CN';
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
    $use_index = array('index', 'about', 'contact', 'credits', 'privacy', 'error');
    $dir = directory($page, $use_index);
    $page_tree = file_get_contents(($page == 'admin' ? '../' : '') . 'php/page_tree.json');
    $data = (object) json_decode($page_tree, true);
    $data = property_exists($data, $page) ? (object) $data->{$page} : (object) array();
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
            '<img class="flag_en" src="assets/shared/langs/uk.png" alt="' . _('Flag of the United Kingdom') . '">' .
            '<p class="language">English (UK)</p></a>' .
            '<a id="en_US" class="flag" href="wr?hl=en-us">' .
            '<img class="flag_en" src="assets/shared/langs/us.png" alt="' . _('Flag of the United States') . '">' .
            '<p class="language">English (US)</p></a> ';
        } else {
            echo '<a id="en_GB" class="flag" href="' . $page . '?hl=en">' .
            '<img class="flag_en" src="assets/shared/langs/uk.png" alt="' . _('Flag of the United Kingdom') . '"><p class="language">English</p></a> ';
        }
        if (has_translation($page, 'ja')) {
            echo '<a id="ja_JP" class="flag" href="' . $page . '?hl=jp">' .
            '<img src="assets/shared/langs/japan.png" alt="' . _('Flag of Japan') . '"><p class="language">日本語</p></a> ';
        }
        if (has_translation($page, 'zh')) {
            echo '<a id="zh_CN" class="flag" href="' . $page . '?hl=zh">' .
            '<img src="assets/shared/langs/china.png" alt="' . _('Flag of the P.R.C.') . '"><p class="language">简体中文</p></a> ';
        }
        if (has_translation($page, 'ru')) {
            echo '<a id="ru_RU" class="flag" href="' . $page . '?hl=ru">' .
            '<img src="assets/shared/langs/russia.png" alt="' . _('Flag of Russia') . '"><p class="language">Русский</p></a>';
        }
        if (has_translation($page, 'de')) {
            echo '<a id="de_DE" class="flag" href="' . $page . '?hl=de">' .
            '<img src="assets/shared/langs/germany.png" alt="' . _('Flag of Germany') . '"><p class="language">Deutsch</p></a>';
        }
        if (has_translation($page, 'es')) {
            echo '<a id="es_ES" class="flag" href="' . $page . '?hl=es">' .
            '<img src="assets/shared/langs/spain.png" alt="' . _('Flag of Spain') . '"><p class="language">Español</p></a>';
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
        case 'UDoALG': return 19;
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
        case 'UDoALG': return _('Touhou 19 - Unfinished Dream of All Living Ghost');
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

function generate_string(string $type = 'nonce') {
    $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    $number_of_chars = 62;
    $str = '';
    for ($i = 0; $i < 32; $i++) {
        $str .= $chars[rand(0, $number_of_chars - 1)];
    }
    $dir = ($type == 'token' ? '../' : '') . '.stats/';
    $file = fopen($dir . $type, 'w');
    if (flock($file, LOCK_EX)) {
        fwrite($file, $str);
        flock($file, LOCK_UN);
    }
    return $str;
}
?>
