<?php
if (isset($_COOKIE['lang'])) {
    $lang = str_replace('"', '', $_COOKIE['lang']);
} else {
    if (empty($_GET['hl']) && !isset($_COOKIE['lang']) || $_GET['hl'] == 'en') {
        $lang = 'English';
    } else if ($_GET['hl'] == 'jp') {
        $lang = 'Japanese';
    } else if ($_GET['hl'] == 'zh') {
        $lang = 'Chinese';
    } else if ($_GET['hl'] == 'ru') {
        $lang = 'Russian';
    }
}
function tl_char(string $char, string $lang) {
    if ($lang == 'Japanese') {
        switch ($char) {
            case 'Makai': return '魔界';
            case 'Jigoku': return '地獄';
            case 'ReimuA': return '霊夢A';
            case 'ReimuB': return '霊夢B';
            case 'ReimuC': return '霊夢C';
            case 'Reimu': return '霊夢';
            case 'Mima': return '魅魔';
            case 'Marisa': return '魔理沙';
            case 'Ellen': return 'エレン';
            case 'Kotohime': return '小兎姫';
            case 'Kana': return 'カナ';
            case 'Rikako': return '理香子';
            case 'Chiyuri': return 'ちゆり';
            case 'Yumemi': return '夢美';
            case 'Yuuka': return '幽香';
            case 'MarisaA': return '魔理沙A';
            case 'MarisaB': return '魔理沙B';
            case 'SakuyaA': return '咲夜A';
            case 'SakuyaB': return '咲夜B';
            case 'BorderTeam': return '霊夢＆紫';
            case 'MagicTeam': return '魔理沙＆アリス';
            case 'ScarletTeam': return '咲夜＆レミリア';
            case 'GhostTeam': return '妖夢＆幽々子';
            case 'Yukari': return '紫';
            case 'Alice': return 'アリス';
            case 'Sakuya': return '咲夜';
            case 'Remilia': return 'レミリア';
            case 'Youmu': return '妖夢';
            case 'Yuyuko': return '幽々子';
            case 'Reisen': return '鈴仙';
            case 'Cirno': return 'チルノ';
            case 'Lyrica': return 'リリカ';
            case 'Mystia': return 'ミスティア';
            case 'Tewi': return 'てゐ';
            case 'Aya': return '文';
            case 'Medicine': return 'メディスン';
            case 'Komachi': return '小町';
            case 'Eiki': return '映姫';
            case 'MarisaC': return '魔理沙C';
            case 'SanaeA': return '早苗A';
            case 'SanaeB': return '早苗B';
            case 'Sanae': return '早苗';
            case 'Spring': return '春';
            case 'Summer': return '夏';
            case 'Autumn': return '秋';
            case 'Winter': return '冬';
            case 'ReimuSpring': return '霊夢春';
            case 'CirnoSpring': return 'チルノ春';
            case 'AyaSpring': return '文春';
            case 'MarisaSpring': return '魔理沙春';
            case 'ReimuSummer': return '霊夢夏';
            case 'CirnoSummer': return 'チルノ夏';
            case 'AyaSummer': return '文夏';
            case 'MarisaSummer': return '魔理沙夏';
            case 'CirnoAutumn': return 'チルノ秋';
            case 'AyaAutumn': return '文秋';
            case 'MarisaAutumn': return '魔理沙秋';
            case 'CirnoWinter': return 'チルノ冬';
            case 'AyaWinter': return '文冬';
            case 'ReimuWolf': return '霊夢狼';
            case 'ReimuOtter': return '霊夢獺';
            case 'ReimuEagle': return '霊夢鷲';
            case 'MarisaWolf': return '魔理沙狼';
            case 'MarisaOtter': return '魔理沙獺';
            case 'MarisaEagle': return '魔理沙鷲';
            case 'YoumuWolf': return '妖夢狼';
            case 'YoumuOtter': return '妖夢獺';
            case 'YoumuEagle': return '妖夢鷲';
            default: return $char;
        }
    } else if ($lang == 'Chinese') {
        switch ($char) {
            case 'Makai': return '魔界';
            case 'Jigoku': return '地狱';
            case 'ReimuA': return '灵梦A';
            case 'ReimuB': return '灵梦B';
            case 'ReimuC': return '灵梦C';
            case 'Reimu': return '灵梦';
            case 'Mima': return '魅魔';
            case 'Marisa': return '魔理沙';
            case 'Ellen': return '爱莲';
            case 'Kotohime': return '小兔姬';
            case 'Kana': return '卡娜';
            case 'Rikako': return '理香子';
            case 'Chiyuri': return '千百合';
            case 'Yumemi': return '梦美';
            case 'Yuuka': return '幽香';
            case 'MarisaA': return '魔理沙A';
            case 'MarisaB': return '魔理沙B';
            case 'SakuyaA': return '咲夜A';
            case 'SakuyaB': return '咲夜B';
            case 'BorderTeam': return '结界组';
            case 'MagicTeam': return '咏唱组';
            case 'ScarletTeam': return '红魔组';
            case 'GhostTeam': return '幽冥组';
            case 'Yukari': return '紫';
            case 'Alice': return '爱丽丝';
            case 'Sakuya': return '咲夜';
            case 'Remilia': return '蕾米莉亚';
            case 'Youmu': return '妖梦';
            case 'Yuyuko': return '幽幽子';
            case 'Reisen': return '铃仙';
            case 'Cirno': return '琪露诺';
            case 'Lyrica': return '莉莉卡';
            case 'Mystia': return '米丝蒂亚';
            case 'Tewi': return '帝';
            case 'Aya': return '文';
            case 'Medicine': return '梅蒂薪';
            case 'Komachi': return '小町';
            case 'Eiki': return '映姬';
            case 'MarisaC': return '魔理沙C';
            case 'SanaeA': return '早苗A';
            case 'SanaeB': return '早苗B';
            case 'Sanae': return '早苗';
            case 'Spring': return '春';
            case 'Summer': return '夏';
            case 'Autumn': return '秋';
            case 'Winter': return '冬';
            case 'ReimuSpring': return '灵梦春';
            case 'CirnoSpring': return '琪露诺春';
            case 'AyaSpring': return '文春';
            case 'MarisaSpring': return '魔理沙春';
            case 'ReimuSummer': return '灵梦夏';
            case 'CirnoSummer': return '琪露诺夏';
            case 'AyaSummer': return '文夏';
            case 'MarisaSummer': return '魔理沙夏';
            case 'CirnoAutumn': return '琪露诺秋';
            case 'AyaAutumn': return '文秋';
            case 'MarisaAutumn': return '魔理沙秋';
            case 'CirnoWinter': return '琪露诺冬';
            case 'AyaWinter': return '文冬';
            case 'ReimuWolf': return '灵梦狼';
            case 'ReimuOtter': return '灵梦獺';
            case 'ReimuEagle': return '灵梦鹰';
            case 'MarisaWolf': return '魔理沙狼';
            case 'MarisaOtter': return '魔理沙獺';
            case 'MarisaEagle': return '魔理沙鹰';
            case 'YoumuWolf': return '妖梦狼';
            case 'YoumuOtter': return '妖梦獺';
            case 'YoumuEagle': return '妖梦鹰';
            default: return $char;
        }
    } else {
        return $char;
    }
}
function tl_term(string $term, string $lang) {
    if ($lang == 'Japanese') {
        $term = trim($term);
        switch ($term) {
            case 'Flag of the United Kingdom': return 'イギリスの国旗';
            case 'Flag of the United States': return 'アメリカ合衆国の国旗';
            case 'Flag of Japan': return '日本の国旗';
            case 'Flag of the P.R.C.': return '中華人民共和国の国旗';
            case 'Flag of Russia': return 'ロシアの国旗';
            case 'Back to Top': return '上に帰る';
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
            case 'Back to Top': return 'Наверх';
        }
    } else {
        return $term;
    }
}
?>
