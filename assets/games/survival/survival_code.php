<?php
$games = ['HRtPMakai', 'HRtPJigoku', 'SoEW', 'PoDD', 'LLS', 'MS', 'EoSD', 'PCB', 'INFinalA',
'INFinalB', 'PoFV', 'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLK', 'HSiFS', 'WBaWC', 'UM'];
$diffs = ['Easy', 'Normal', 'Hard', 'Lunatic', 'Extra'];
function achievs(string $game) {
    $achievs = ['N/A', 'Not cleared', '1cc', 'NM', 'NB', 'NMNB'];
    switch ($game) {
        case 'PCB': return array_merge($achievs, ['NBB', 'NMNBB', 'NBNBB', 'NNN']);
        case 'UFO': return array_merge($achievs, ['NV', 'NMNV', 'NBNV', 'NNN']);
        case 'TD': return array_merge($achievs, ['NT', 'NMNT', 'NBNT', 'NNN']);
        case 'HSiFS': return array_merge($achievs, ['NR', 'NMNR', 'NBNR', 'NNN']);
        case 'WBaWC': return array_merge($achievs, ['NHNRB', 'NMNHNRB', 'NBNHNRB', 'NNNN']);
        case 'UM': return array_merge($achievs, ['NC', 'NMNC', 'NBNC', 'NNN']);
        default: return $achievs;
    }
}
function no_extra(string $game) {
    return in_array($game, ['HRtPMakai', 'HRtPJigoku', 'PoDD', 'INFinalB']);
}
function display_name(string $game) {
    if ($game == 'HRtPMakai') {
        return 'HRtP <span class="hrtp_route">Makai</span>';
    } else if ($game == 'HRtPJigoku') {
        return 'HRtP <span class="hrtp_route">Jigoku</span>';
    } else if ($game == 'INFinalA') {
        return 'IN <span class="in_route">FinalA</span>';
    } else if ($game == 'INFinalB') {
        return 'IN <span class="in_route">FinalB</span>';
    } else {
        return $game;
    }
}
?>
