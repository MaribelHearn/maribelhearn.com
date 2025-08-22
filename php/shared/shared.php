<?php
$langs = array('en_GB', 'en_US', 'ja_JP', 'zh_CN', 'ru_RU', 'de_DE', 'es_ES');

function has_space(string $lang) {
    return $lang != 'ja_JP' && $lang != 'zh_CN';
}

function directory(string $page, array $main) {
    $other = array('thvote', 'tiers', 'slots', 'touhoumon');
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
    $langs['-'] = Array('drc', 'jargon', 'lnn', 'pofv', 'tools', 'wr');
    $langs['ja'] = Array('drc', 'lnn', 'tools', 'wr');
    $langs['zh'] = Array('drc', 'jargon', 'lnn', 'pofv', 'wr');
    $langs['ru'] = Array('lnn', 'tools', 'wr');
    $langs['de'] = Array('drc', 'lnn', 'tools', 'wr');
    $langs['es'] = Array('lnn', 'tools', 'wr');
    $result = in_array($page, $langs[$lang]);
    if (isset($_SESSION['subpage'])) {
        $result = in_array($_SESSION['subpage'], $langs[$lang]);
    }
    return $result;
}

function wrap_top() {
    global $page, $subpage, $lang,  $error_code, $layout;
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
        echo '<span id="toggle"><a id="toggle_layout" href="' . $page . '?layout=' . ($layout == 'New' ? 'old' : 'new') . '">' . ($layout == 'New' ? 'Old' : 'New') . ' layout</a></span>';
    }
    if (has_translation($page)) {
        $path = $page;
        if (isset($_SESSION['subpage'])) {
            $path .= '/' . $subpage;
        }
        echo '<div id="languages">';
        if ($page == 'wr' || $page == 'lnn') {
            echo '<a data-lang="en_GB" class="flag" href="/' . $path . '?hl=en-gb">' .
            '<img class="flag_en" src="/assets/shared/langs/uk.png" alt="' . _('Flag of the United Kingdom') . '">' .
            '<p class="language">English (UK)</p></a>' .
            '<a data-lang="en_US" class="flag" href="/' . $path . '?hl=en-us">' .
            '<img class="flag_en" src="/assets/shared/langs/us.png" alt="' . _('Flag of the United States') . '">' .
            '<p class="language">English (US)</p></a> ';
        } else {
            echo '<a data-lang="en_GB" class="flag" href="/' . $path . '?hl=en">' .
            '<img class="flag_en" src="/assets/shared/langs/uk.png" alt="' . _('Flag of the United Kingdom') . '"><p class="language">English</p></a> ';
        }
        if (has_translation($page, 'ja')) {
            echo '<a data-lang="ja_JP" class="flag" href="/' . $path . '?hl=jp">' .
            '<img src="/assets/shared/langs/japan.png" alt="' . _('Flag of Japan') . '"><p class="language">日本語</p></a> ';
        }
        if (has_translation($page, 'zh')) {
            echo '<a data-lang="zh_CN" class="flag" href="/' . $path . '?hl=zh">' .
            '<img src="/assets/shared/langs/china.png" alt="' . _('Flag of the P.R.C.') . '"><p class="language">简体中文</p></a> ';
        }
        if (has_translation($page, 'ru')) {
            echo '<a data-lang="ru_RU" class="flag" href="/' . $path . '?hl=ru">' .
            '<img src="/assets/shared/langs/russia.png" alt="' . _('Flag of Russia') . '"><p class="language">Русский</p></a>';
        }
        if (has_translation($page, 'de')) {
            echo '<a data-lang="de_DE" class="flag" href="/' . $path . '?hl=de">' .
            '<img src="/assets/shared/langs/germany.png" alt="' . _('Flag of Germany') . '"><p class="language">Deutsch</p></a>';
        }
        if (has_translation($page, 'es')) {
            echo '<a data-lang="es_ES" class="flag" href="/' . $path . '?hl=es">' .
            '<img src="/assets/shared/langs/spain.png" alt="' . _('Flag of Spain') . '"><p class="language">Español</p></a>';
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
        fwrite($file, '"' . $str . '"');
        flock($file, LOCK_UN);
    }
    return $str;
}
?>
