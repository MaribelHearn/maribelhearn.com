<?php
function tl_term(string $term, string $lang) {
    if ($lang == 'Japanese') {
        $term = trim($term);
        switch ($term) {
            case 'Flag of the United Kingdom': return 'イギリスの国旗';
            case 'Flag of the United States': return 'アメリカ合衆国の国旗';
            case 'Flag of Japan': return '日本の国旗';
            case 'Flag of the P.R.C.': return '中華人民共和国の国旗';
            case 'Flag of Russia': return 'ロシアの国旗';
            case 'Acknowledgements': return '謝辞';
            case 'Back to Top': return '上に帰る';
            case 'Downloads': return 'ダウンロード';
            case 'Download': return 'ダウンロード';
            case 'Font': return 'フォント';
            default: return $term;
        }
    } else if ($lang == 'Chinese') {
        $term = trim($term);
        switch ($term) {
            case 'Flag of the United Kingdom': return '英国旗';
            case 'Flag of the United States': return '美国旗';
            case 'Flag of Japan': return '日本旗';
            case 'Flag of the P.R.C.': return '中国旗';
            case 'Flag of Russia': return '俄羅斯國旗';
            case 'Back to Top': return '回到顶部';
            default: return $term;
        }
    } else if ($lang == 'Russian') {
        $term = trim($term);
        switch ($term) {
            case 'Flag of the United Kingdom': return 'флаг Великобритании';
            case 'Flag of the United States': return 'флаг США';
            case 'Flag of Japan': return 'флаг Японии';
            case 'Flag of the P.R.C.': return 'флаг Китая';
            case 'Flag of Russia': return 'флаг России';
            case 'Acknowledgements': return 'Примечания';
            case 'Back to Top': return 'Наверх';
            case 'Downloads': return 'Скачать';
            case 'Download': return 'Скачать';
            case 'Font': return 'Шрифты';
            default: return $term;
        }
    } else {
        return $term;
    }
}
function set_lang_cookie(string $value) {
    setcookie('lang', $value, array(
        'expires' => 2147483647,
        'path' => '/',
        'secure' => true,
        'samesite' => 'Strict'
    ));
}
if (isset($_COOKIE['lang'])) {
    $lang = str_replace('"', '', $_COOKIE['lang']);
} else {
    if (empty($_GET['hl'])) {
        $lang = 'English';
    } else if ($_GET['hl'] == 'en') {
        $lang = 'English';
        set_lang_cookie($lang);
    } else if ($_GET['hl'] == 'ru') {
        $lang = 'Russian';
        set_lang_cookie($lang);
    } else if ($_GET['hl'] == 'jp') {
        $lang = 'Japanese';
        set_lang_cookie($lang);
    } else {
        $lang = 'English';
    }
}
?>
