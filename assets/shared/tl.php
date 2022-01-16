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

function full_name(string $game) {
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
?>
