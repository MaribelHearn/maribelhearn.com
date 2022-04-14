<?php
$json = file_get_contents('assets/shared/json/defaults.json');
$wr = json_decode($json, true);
$games = ['HRtP', 'SoEW', 'PoDD', 'LLS', 'MS', 'EoSD', 'PCB', 'IN', 'PoFV',
'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLK', 'HSiFS', 'WBaWC', 'UM'];
$diffs = ['Easy', 'Normal', 'Hard', 'Lunatic', 'Extra'];
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
        case 'MoF': return 'Touhou 10 - Mountain of Faith';
        case 'SA': return 'Touhou 11 - Subterranean Animism';
        case 'UFO': return 'Touhou 12 - Undefined Fantastic Object';
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
function no_extra(string $game) {
    return in_array($game, ['HRtP', 'PoDD', 'GFW']);
}
?>
