<?php
function shot_route(string $game) {
    return $game == 'HRtP' || $game == 'GFW' ? 'Route' : 'Shottype';
}
function num(string $game) {
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
        default: return 0;
    }
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
function tl_shot(string $shot, string $lang) {
    if ($lang == 'Japanese' || $lang == 'ja') {
        switch ($shot) {
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
            case 'Hatate': return 'はたて';
            case 'MarisaC': return '魔理沙C';
            case 'SanaeA': return '早苗A';
            case 'SanaeB': return '早苗B';
            case 'Sanae': return '早苗';
            case 'Spring': return '春';
            case 'Summer': return '夏';
            case 'Autumn': return '秋';
            case 'Winter': return '冬';
            case 'ReimuSpring': return '霊夢(春)';
            case 'CirnoSpring': return 'チルノ(春)';
            case 'AyaSpring': return '文(春)';
            case 'MarisaSpring': return '魔理沙(春)';
            case 'ReimuSummer': return '霊夢(夏)';
            case 'CirnoSummer': return 'チルノ(夏)';
            case 'AyaSummer': return '文(夏)';
            case 'MarisaSummer': return '魔理沙(夏)';
            case 'ReimuAutumn': return '霊夢(秋)';
            case 'CirnoAutumn': return 'チルノ(秋)';
            case 'AyaAutumn': return '文(秋)';
            case 'MarisaAutumn': return '魔理沙(秋)';
            case 'ReimuWinter': return '霊夢(冬)';
            case 'CirnoWinter': return 'チルノ(冬)';
            case 'AyaWinter': return '文(冬)';
            case 'MarisaWinter': return '魔理沙(冬)';
            case 'ReimuWolf': return '霊夢W';
            case 'ReimuOtter': return '霊夢O';
            case 'ReimuEagle': return '霊夢E';
            case 'MarisaWolf': return '魔理沙W';
            case 'MarisaOtter': return '魔理沙O';
            case 'MarisaEagle': return '魔理沙E';
            case 'YoumuWolf': return '妖夢W';
            case 'YoumuOtter': return '妖夢O';
            case 'YoumuEagle': return '妖夢E';
            default: return $shot;
        }
    } else if ($lang == 'Chinese' || $lang == 'zh') {
        switch($shot) {
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
            case 'Hatate': return '羽立';
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
            case 'ReimuAutumn': return '灵梦秋';
            case 'CirnoAutumn': return '琪露诺秋';
            case 'AyaAutumn': return '文秋';
            case 'MarisaAutumn': return '魔理沙秋';
            case 'ReimuWinter': return '灵梦冬';
            case 'CirnoWinter': return '琪露诺冬';
            case 'AyaWinter': return '文冬';
            case 'MarisaWinter': return '魔理沙冬';
            case 'ReimuWolf': return '灵梦狼';
            case 'ReimuOtter': return '灵梦獭';
            case 'ReimuEagle': return '灵梦鹰';
            case 'MarisaWolf': return '魔理沙狼';
            case 'MarisaOtter': return '魔理沙獭';
            case 'MarisaEagle': return '魔理沙鹰';
            case 'YoumuWolf': return '妖梦狼';
            case 'YoumuOtter': return '妖梦獭';
            case 'YoumuEagle': return '妖梦鹰';
            default: return $shot;
        }
    }
    return str_replace('Team', ' Team', $shot);
}
function full_name(string $game, string $lang) {
    if ($lang == 'Japanese') {
        switch ($game) {
            case 'HRtP': return '東方靈異伝　～ The Highly Responsive to Prayers';
            case 'SoEW': return '東方封魔録　～ the Story of Eastern Wonderland';
            case 'PoDD': return '東方夢時空　～ Phantasmagoria of Dim.Dream';
            case 'LLS': return '東方幻想郷　～ Lotus Land Story';
            case 'MS': return '東方怪綺談　～ Mystic Square';
            case 'EoSD': return '東方紅魔郷　～ the Embodiment of Scarlet Devil';
            case 'PCB': return '東方妖々夢　～ Perfect Cherry Blossom';
            case 'IN': return '東方永夜抄　～ Imperishable Night';
            case 'PoFV': return '東方花映塚　～ Phantasmagoria of Flower View';
            case 'StB': return '東方文花帖　～ Shoot the Bullet';
            case 'MoF': return '東方風神録　～ Mountain of Faith';
            case 'SA': return '東方地霊殿　～ Subterranean Animism';
            case 'UFO': return '東方星蓮船　～ Undefined Fantastic Object';
            case 'DS': return 'ダブルスポイラー　～ 東方文花帖';
            case 'GFW': return '妖精大戦争　～ 東方三月精';
            case 'TD': return '東方神霊廟　～ Ten Desires';
            case 'DDC': return '東方輝針城　～ Double Dealing Character';
            case 'LoLK': return '東方紺珠伝　～ Legacy of Lunatic Kingdom';
            case 'HSiFS': return '東方天空璋　～ Hidden Star in Four Seasons';
            case 'WBaWC': return '東方鬼形獣　～ Wily Beast and Weakest Creature';
            case 'UM': return '東方虹龍洞　～ Unconnected Marketeers';
            default: return 'Unknown';
        }
    } else if ($lang == 'Chinese') {
        switch ($game) {
            case 'HRtP': return '东方灵异传　～ The Highly Responsive to Prayers';
            case 'SoEW': return '东方封魔录　～ the Story of Eastern Wonderland';
            case 'PoDD': return '东方梦时空　～ Phantasmagoria of Dim.Dream';
            case 'LLS': return '东方幻想乡　～ Lotus Land Story';
            case 'MS': return '东方怪绮谈　～ Mystic Square';
            case 'EoSD': return '东方红魔乡　～ the Embodiment of Scarlet Devil';
            case 'PCB': return '东方妖妖梦　～ Perfect Cherry Blossom';
            case 'IN': return '东方永夜抄　～ Imperishable Night';
            case 'PoFV': return '东方花映塚　～ Phantasmagoria of Flower View';
            case 'StB': return '东方文花帖　～ Shoot the Bullet';
            case 'MoF': return '东方风神录　～ Mountain of Faith';
            case 'SA': return '东方地灵殿　～ Subterranean Animism';
            case 'UFO': return '东方星莲船　～ Undefined Fantastic Object';
            case 'DS': return '对抗新闻　～ 东方文花帖';
            case 'GFW': return '妖精大战争　～ 东方三月精';
            case 'TD': return '东方神灵庙　～ Ten Desires';
            case 'DDC': return '东方辉针城　～ Double Dealing Character';
            case 'LoLK': return '东方绀珠传　～ Legacy of Lunatic Kingdom';
            case 'HSiFS': return '东方天空璋　～ Hidden Star in Four Seasons';
            case 'WBaWC': return '东方鬼形獣　～ Wily Beast and Weakest Creature';
            case 'UM': return '东方虹龙洞　～ Unconnected Marketeers';
            default: return 'Unknown';
        }
    } else {
        switch ($game) {
            case 'HRtP': return 'Touhou 1 - The Highly Responsive to Prayers';
            case 'SoEW': return 'Touhou 2 - The Story of Eastern Wonderland';
            case 'PoDD': return 'Touhou 3 - Phantasmagoria of Dim.Dream';
            case 'LLS': return 'Touhou 4 - Lotus Land Story';
            case 'MS': return 'Touhou 5 - Mystic Square';
            case 'EoSD': return 'Touhou 6 - The Embodiment of Scarlet Devil';
            case 'PCB': return 'Touhou 7 - Perfect Cherry Blossom';
            case 'IN': return 'Touhou 8 - Imperishable Night';
            case 'PoFV': return 'Touhou 9 - Phantasmagoria of Flower View';
            case 'StB': return 'Touhou 9.5 - Shoot the Bullet';
            case 'MoF': return 'Touhou 10 - Mountain of Faith';
            case 'SA': return 'Touhou 11 - Subterranean Animism';
            case 'UFO': return 'Touhou 12 - Undefined Fantastic Object';
            case 'DS': return 'Touhou 12.5 - Double Spoiler';
            case 'GFW': return 'Touhou 12.8 - Great Fairy Wars';
            case 'TD': return 'Touhou 13 - Ten Desires';
            case 'DDC': return 'Touhou 14 - Double Dealing Character';
            case 'LoLK': return 'Touhou 15 - Legacy of Lunatic Kingdom';
            case 'HSiFS': return 'Touhou 16 - Hidden Star in Four Seasons';
            case 'WBaWC': return 'Touhou 17 - Wily Beast and Weakest Creature';
            case 'UM': return 'Touhou 18 - Unconnected Marketeers';
            default: return 'Unknown';
        }
    }
}
function tl_term(string $term, string $lang) {
    if ($lang == 'Japanese' || $lang == 'ja') {
        $term = trim($term);
        switch ($term) {
            case 'Game': return 'ゲーム';
            case 'Games LNN\'d': return 'ゲーム';
            case 'Score': return 'スコア';
            case 'Player': return 'プレイヤー';
            case 'Players': return 'プレイヤー';
            case 'Category': return 'カテゴリー';
            case 'Difficulty': return '難易度';
            case 'Shottype': return 'キャラ';
            case 'Route': return 'ルート';
            case 'Seasons': return '季節';
            case 'Date': return '日付';
            case 'Dates': return '日付';
            case 'Replay': return 'リプレイ';
            case 'Replays': return 'リプレイ';
            case 'No. of WRs': return 'WR数';
            case 'Different games': return 'ゲーム';
            case 'World': return '世界';
            case 'West': return '海外';
            case 'Percentage': return '割合';
            case 'Overall': return '合計';
            case 'Overall Count': return '総数';
            case 'Overall Records': return '各作品世界記録一覧';
            case 'World Records': return '世界記録';
            case 'Western Records': return '海外記録';
            case 'Recent Records': return '最近の世界記録';
            case 'Player Ranking': return 'プレイヤーのランキング';
            case 'Credits': return '謝辞';
            case 'Touhou World Records': return '東方の世界記録';
            case 'Touhou Lunatic No Miss No Bombs': return '東方Lunaticノーミスノーボム';
            case 'No. of LNNs': return 'LNNの数';
            case 'LNN Lists': return 'LNNリスト';
            case '(Different players)': return '（プレイヤー）';
            case '(All)': return '（全）';
            case '(All Windows)': return '（全Windows）';
            case 'Back to Top': return '上に帰る';
            case 'FinalA': return 'Aルート';
            case 'FinalB': return 'Bルート';
            case 'Spring': return '春';
            case 'Summer': return '夏';
            case 'Autumn': return '秋';
            case 'Winter': return '冬';
            case 'Flag of the United Kingdom': return 'イギリスの国旗';
            case 'Flag of the United States': return 'アメリカ合衆国の国旗';
            case 'Flag of Japan': return '日本の国旗';
            case 'Flag of the P.R.C.': return '中華人民共和国の国旗';
            case 'Flag of Russia': return 'ロシアの国旗';
            case 'Contributors': return '寄稿者';
            case 'Translators': return 'トランスレーター';
            case 'Japanese': return '日本語';
            case 'Chinese': return '中国語';
            case 'Russian': return 'ロシア語';
            case 'Character Artists': return 'キャラのアーティスト';
            case 'Background Artists': return '背景のアーティスト';
            default: return $term;
        }
    } else if ($lang == 'Chinese' || $lang == 'zh') {
        $term = trim($term);
        switch ($term) {
            case 'Game': return '游戏';
            case 'Games LNN\'d': return '游戏';
            case 'Score': return '分数';
            case 'Player': return '玩家';
            case 'Players': return '玩家';
            case 'Category': return '项目';
            case 'Difficulty': return '难度';
            case 'Shottype': return '机体';
            case 'Route': return '路线';
            case 'Seasons': return '季节';
            case 'Date': return '日期';
            case 'Dates': return '日期';
            case 'Replay': return 'Rep';
            case 'Replays': return 'Rep';
            case 'No. of WRs': return 'WR数量';
            case 'Different games': return '游戏';
            case 'World': return '世界';
            case 'West': return '西方';
            case 'Percentage': return '百分';
            case 'Overall': return '合計';
            case 'Overall Count': return '总数';
            case 'Overall Records': return '整体世界纪录';
            case 'World Records': return '世界纪录';
            case 'Western Records': return '西方纪录';
            case 'Recent Records': return '最近世界纪录';
            case 'Player Ranking': return '玩家排行';
            case 'Credits': return '致谢';
            case 'Touhou World Records': return '东方世界纪录';
            case 'Touhou Lunatic No Miss No Bombs': return '东方LNN';
            case 'No. of LNNs': return 'LNN的数量';
            case 'LNN Lists': return 'LNN列表';
            case '(Different players)': return '（玩家）';
            case '(All)': return '（全）';
            case '(All Windows)': return '（全Windows）';
            case 'Back to Top': return '回到顶部';
            case 'FinalA': return '路线A';
            case 'FinalB': return '路线B';
            case 'Spring': return '春';
            case 'Summer': return '夏';
            case 'Autumn': return '秋';
            case 'Winter': return '冬';
            case 'Flag of the United Kingdom': return '英国旗';
            case 'Flag of the United States': return '美国旗';
            case 'Flag of Japan': return '日本旗';
            case 'Flag of the P.R.C.': return '中国旗';
            case 'Flag of Russia': return '俄羅斯國旗';
            case 'Contributors': return '合作者';
            case 'Translators': return '翻译';
            case 'Japanese': return '日语';
            case 'Chinese': return '简体中文';
            case 'Russian': return '俄语';
            case 'Character Artists': return '角色艺术家';
            case 'Background Artists': return '背景艺术家 ';
            default: return $term;
        }
    } else if ($lang == 'Russian' || $lang == 'ru') {
        $term = trim($term);
        switch ($term) {
            case 'Dates': return 'Даты';
            case 'LNN Lists': return 'Списки LNN';
            case 'Overall Count': return 'Общее количество';
            case 'Overall Records': return 'Общие рекорды';
            case 'World Records': return 'Мировые рекорды';
            case 'Player Ranking': return 'Рейтинг игроков';
            case 'Recent Records': return 'Последние Мировые Рекорды';
            case 'Credits': return 'Примечания';
            case 'Flag of the United Kingdom': return 'флаг Великобритании';
            case 'Flag of the United States': return 'флаг США';
            case 'Flag of Japan': return 'флаг Японии';
            case 'Flag of the P.R.C.': return 'флаг Китая';
            case 'Flag of Russia': return 'флаг России';
            case 'Back to Top': return 'Наверх';
            case 'Contributors': return 'Contributors';
            case 'Translators': return 'Translators';//Переводчики
            case 'Japanese': return 'Японский';
            case 'Chinese': return 'Китайский';
            case 'Russian': return 'Русский';
            case 'Character Artists': return 'Character Artists';
            case 'Background Artists': return 'Background Artists';
            default: return $term;
        }
    } else {
        return $term;
    }
}
function format_shot(string $game, string $shot, string $lang) {
    if ($game == 'IN') {
        $tmp = str_replace('FinalA', '', $shot);
        $tmp = str_replace('FinalB', '', $tmp);
        $shot = str_replace($tmp, '', $shot);
        return tl_shot($tmp, $lang) . '<span class="in_route">' . tl_term($shot, $lang) . '</span>';
    } else if ($game == 'HSiFS') {
        $tmp = str_replace('Spring', '', $shot);
        $tmp = str_replace('Summer', '', $tmp);
        $tmp = str_replace('Autumn', '', $tmp);
        $tmp = str_replace('Winter', '', $tmp);
        $shot = str_replace('Spring', '<span class="Spring">' . tl_term('Spring', $lang) . '</span>', $shot);
        $shot = str_replace('Summer', '<span class="Summer">' . tl_term('Summer', $lang) . '</span>', $shot);
        $shot = str_replace('Autumn', '<span class="Autumn">' . tl_term('Autumn', $lang) . '</span>', $shot);
        $shot = str_replace('Winter', '<span class="Winter">' . tl_term('Winter', $lang) . '</span>', $shot);
        return tl_shot($tmp, $lang) . str_replace($tmp, '', $shot);
    }
    return tl_shot($shot, $lang);
}
?>
