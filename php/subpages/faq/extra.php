<?php
$extras = [
    'SoEW' => [2, 'Easy 1cc with all shottypes'],
    'LLS' => [4, 'Normal 1cc'],
    'MS' => [5, 'Easy 1cc'],
    'EoSD' => [6, 'Normal 1cc'],
    'PCB (Extra)' => [7, 'Easy 1cc'],
    'PCB (Phantasm)' => [7, 'Extra 1cc <strong>AND</strong> 60 Spell Cards captured across all shottypes'],
    'IN' => [8, 'Easy FinalA clear <strong>AND</strong> Easy FinalB 1cc'],
    'PoFV' => [9, 'Easy clear with all characters'],
    'MoF' => [10, 'Normal 1cc'],
    'SA' => [11, 'Normal 1cc*'],
    'UFO' => [12, 'Normal 1cc'],
    'GFW' => [12.8, 'Easy 1cc all routes'],
    'TD' => [13, 'Normal 1cc'],
    'DDC' => [14, 'Easy 1cc'],
    'LoLK' => [15, 'Pointdevice Easy 1cc <strong>OR</strong> Legacy Easy 1cc'],
    'HSiFS' => [16, 'Easy 1cc'],
    'WBaWC' => [17, 'Easy 1cc'],
    'UM' => [18, 'Easy 1cc'],
    'FW' => [20, 'Normal 1cc'],
];
?>
<h2 id='extra'>How do I unlock the Extra Stage?</h2>
<p>Extra unlock requirements depend on which game you are playing. The minimum requirements to unlock Extra for each game are listed in the table below.</p>
<p>Aside from SoEW (Touhou 2) and PoFV (Touhou 9), meeting the requirement with a certain shottype will only unlock Extra for that shottype.</p>
<div class='overflow'><table class='unlocks'>
    <tr>
        <th>#</th>
        <th>Game</th>
        <th>Minimum requirement</th>
    </tr>
    <?php
        foreach ($extras as $game => $data) {
            echo '<tr><td>Touhou ' . strval($data[0]) . '</td><td>' . $game . '</td><td>' . $data[1] . '</td></tr>';
        }
    ?>
</table></div>
<p>* SA (Touhou 11) has a bug where Extra is <em>locked</em> if you 1cc the game on Easy. This forces you to 1cc on Normal or higher again.</p>
