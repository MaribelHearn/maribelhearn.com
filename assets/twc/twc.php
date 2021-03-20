<?php
if (isset($_COOKIE['lang'])) {
    $lang = str_replace('"', '', $_COOKIE['lang']);
}
if (empty($_GET['hl']) && !isset($_COOKIE['lang']) || $_GET['hl'] == 'en') {
    $lang = 'English';
} else if ($_GET['hl'] == 'jp') {
    $lang = 'Japanese';
} else if ($_GET['hl'] == 'zh') {
    $lang = 'Chinese';
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
            case 'Game': return 'ゲーム';
            case 'Category': return 'カテゴリー';
            case 'Shottype': return 'キャラ';
            case 'Multiplier': return '倍率';
            case 'Base': return '底';
            case 'Base points': return '素点';
            case 'Exponent': return '冪指数';
            case 'Max points': return '最大点';
            case 'Min points': return '最小点';
            case 'No Bomb bonus': return 'ノーボムボーナス';
            case 'Increments': return '増加';
            case 'Threshold': return '閾値';
            case 'Threshold 1': return '閾値1';
            case 'Threshold 2': return '閾値2';
            case 'Threshold 3': return '閾値3';
            case 'Scene': return '撮影対象';
            case 'Scoring': return '稼ぎ';
            case 'Survival': return 'クリア重視';
            case 'FinalA': return 'Aルート';
            case 'FinalB': return 'Bルート';
            case 'Back to Top': return '上に帰る';
            default: return $term;
        }
    } else if ($lang == 'Chinese') {
        $term = trim($term);
        switch ($term) {
            case 'Game': return '游戏';
            case 'Category': return '项目';
            case 'Shottype': return '机体';
            case 'Multiplier': return '系数';
            case 'Base': return '基数';
            case 'Base points': return '基数分';
            case 'Exponent': return '指数';
            case 'Max points': return '最大值';
            case 'Min points': return '最小值';
            case 'No Bomb bonus': return 'NB奖分';
            case 'Increments': return '增幅';
            case 'Threshold': return '阈值';
            case 'Threshold 1': return '第一阈值';
            case 'Threshold 2': return '第二阈值';
            case 'Threshold 3': return '第三阈值';
            case 'Scene': return '场景';
            case 'Scoring': return '打分';
            case 'Survival': return '生存';
            case 'FinalA': return '路线A';
            case 'FinalB': return '路线B';
            case 'Back to Top': return '回到顶部';
            default: return $term;
        }
    } else {
        return $term;
    }
}
?>
