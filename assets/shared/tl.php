<?php
function shot_route($game) {
    return $game == 'HRtP' || $game == 'GFW' ? 'Route' : 'Shottype';
}
function num($game) {
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
        case 'MoF': return 10;
        case 'SA': return 11;
        case 'UFO': return 12;
        case 'GFW': return 128;
        case 'TD': return 13;
        case 'DDC': return 14;
        case 'LoLK': return 15;
        case 'HSiFS': return 16;
        case 'WBaWC': return 17;
        default: return 0;
    }
}
function tl_shot($shot, $lang) {
    if ($lang == 'Japanese') {
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
            case 'ReimuAutumn': return '霊夢秋';
            case 'CirnoAutumn': return 'チルノ秋';
            case 'AyaAutumn': return '文秋';
            case 'MarisaAutumn': return '魔理沙秋';
            case 'ReimuWinter': return '霊夢冬';
            case 'CirnoWinter': return 'チルノ冬';
            case 'AyaWinter': return '文冬';
            case 'MarisaWinter': return '魔理沙冬';
            case 'ReimuWolf': return '霊夢狼';
            case 'ReimuOtter': return '霊夢獺';
            case 'ReimuEagle': return '霊夢鷲';
            case 'MarisaWolf': return '魔理沙狼';
            case 'MarisaOtter': return '魔理沙獺';
            case 'MarisaEagle': return '魔理沙鷲';
            case 'YoumuWolf': return '妖夢狼';
            case 'YoumuOtter': return '妖夢獺';
            case 'YoumuEagle': return '妖夢鷲';
            default: return $shot;
        }
    } else if ($lang == 'Chinese') {
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
    return $shot;
}
function full_name($game, $lang) {
    if ($lang == 'English') {
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
            case 'MoF': return 'Touhou 10 - Mountain of Faith';
            case 'SA': return 'Touhou 11 - Subterranean Animism';
            case 'UFO': return 'Touhou 12 - Undefined Fantastic Object';
            case 'GFW': return 'Touhou 12.8 - Great Fairy Wars';
            case 'TD': return 'Touhou 13 - Ten Desires';
            case 'DDC': return 'Touhou 14 - Double Dealing Character';
            case 'LoLK': return 'Touhou 15 - Legacy of Lunatic Kingdom';
            case 'HSiFS': return 'Touhou 16 - Hidden Star in Four Seasons';
            case 'WBaWC': return 'Touhou 17 - Wily Beast and Weakest Creature';
            default: return 'Unknown';
        }
    } else if ($lang == 'Japanese') {
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
            case 'MoF': return '東方風神録　～ Mountain of Faith';
            case 'SA': return '東方地霊殿　～ Subterranean Animism';
            case 'UFO': return '東方星蓮船　～ Undefined Fantastic Object';
            case 'GFW': return '妖精大戦争　～ 東方三月精';
            case 'TD': return '東方神霊廟　～ Ten Desires';
            case 'DDC': return '東方輝針城　～ Double Dealing Character';
            case 'LoLK': return '東方紺珠伝　～ Legacy of Lunatic Kingdom';
            case 'HSiFS': return '東方天空璋　～ Hidden Star in Four Seasons';
            case 'WBaWC': return '東方鬼形獣　～ Wily Beast and Weakest Creature';
            default: return 'Unknown';
        }
    } else {
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
            case 'MoF': return '东方风神录　～ Mountain of Faith';
            case 'SA': return '东方地灵殿　～ Subterranean Animism';
            case 'UFO': return '东方星莲船　～ Undefined Fantastic Object';
            case 'GFW': return '妖精大战争　～ 东方三月精';
            case 'TD': return '东方神灵庙　～ Ten Desires';
            case 'DDC': return '东方辉针城　～ Double Dealing Character';
            case 'LoLK': return '东方绀珠传　～ Legacy of Lunatic Kingdom';
            case 'HSiFS': return '东方天空璋　～ Hidden Star in Four Seasons';
            case 'WBaWC': return '东方鬼形獣　～ Wily Beast and Weakest Creature';
            default: return 'Unknown';
        }
    }
}
?>
