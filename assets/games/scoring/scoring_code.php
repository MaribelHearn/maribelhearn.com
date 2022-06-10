<?php
$json = file_get_contents('assets/shared/json/defaults.json');
$wr = json_decode($json, true);
$games = ['HRtP', 'SoEW', 'PoDD', 'LLS', 'MS', 'EoSD', 'PCB', 'IN', 'PoFV',
'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLK', 'HSiFS', 'WBaWC', 'UM'];
$diffs = ['Easy', 'Normal', 'Hard', 'Lunatic', 'Extra'];

function no_extra(string $game) {
    return in_array($game, ['HRtP', 'PoDD', 'GFW']);
}
?>
