<?php
$lives = [
    'SoEW' => [2, 'Score', '1m, 2m, 3m, 5m, 8m'],
    'PoDD' => [3, 'Score', '10m and 20m'],
    'LLS' => [4, 'Score', '3m, 8m, 15m, 22m, 30m'],
    'MS' => [5, 'Point items', 'Every 100'],
    'EoSD' => [6, 'Score', '10m, 20m, 40m, 60m'],
    'PCB' => [7, 'Point items', 'Maingame: 50, 125, 200, 300, 450, 800, every +200 onwards<br>Extra/Phantasm: 200, 500, 800, 1300'],
    'IN' => [8, 'Point items', 'Maingame: 100, 250, 500, 800, 1100<br>Extra: 200 and 666'],
    'PoFV' => [9, 'Score', '10m, 30m, 50m, 70m, 90m'],
    'MoF' => [10, 'Score', '20m, 40m, 80m, 150m'],
    'SA' => [11, 'Lifepieces', 'Dropped when clearing a boss attack without dying, 5 per life'],
    'UFO' => [12, 'Lifepieces', 'Dropped from red UFOs and bosses, 4 per life'],
    'GFW' => [12.8, 'Motivation', 'Gained by freezing as well as shooting enemies'],
    'TD' => [13, 'Lifepieces', 'Dropped by pink spirits and boss attacks, gradually increases from 8 per life up to 25 per life'],
    'DDC' => [14, 'Lifepieces', 'Dropped every 5th bonus or on a x2.0 bonus, 3 per life'],
    'LoLK' => [15, 'Lifepieces', '<strong>Pointdevice Mode:</strong> -<br><strong>Legacy Mode:</strong> Gained by getting Chapter Bonuses, 3 per life*'],
    'HSiFS' => [16, 'Score', 'Maingame: 10m, 20m, 40m, 70m, 100m, 150m, 250m, 500m, 1b<br>Extra: 10m, 20m, 40m, 60m, 80m, 100m'],
    'WBaWC' => [17, 'Lifepieces', 'Dropped when ending Roaring Mode with a lifepiece spirit in stock, 3 per life'],
    'UM' => [18, 'Shop', 'Lifepieces, extends, as well as other cards that award lives can be bought from the shop']
];
$bombs = [
    'SoEW' => [2, 'Standard', '3**', 'Bomb items'],
    'PoDD' => [3, 'Standard', '2', '2 bombs every new round'],
    'LLS' => [4, 'Standard', '2', 'Bomb items, clearing a stage (except the Final Stage)'],
    'MS' => [5, 'Standard', '3', 'Bomb items'],
    'EoSD' => [6, 'Standard', '3', 'Bomb items'],
    'PCB' => [7, 'Standard', '3***', 'Bomb items'],
    'IN' => [8, 'Standard', '3', 'Bomb items****'],
    'PoFV' => [9, 'Standard', '-', '-'],
    'MoF' => [10, 'Power', '-', 'Every 1.00 power'],
    'SA' => [11, 'Power', '-', 'Every 1.00 power'],
    'UFO' => [12, 'Standard', '2', 'Bomb items and pieces dropped from green UFOs'],
    'GFW' => [12.8, 'Perfect Freeze', '-', 'Gained by freezing; you gain 25% when you die'],
    'TD' => [13, 'Standard', '2', 'Bombpieces dropped by green spirits and boss attacks, 8 per bomb'],
    'DDC' => [14, 'Standard', '3', 'Bombpieces dropped every bonus, unless a lifepiece is dropped; 8 per bomb'],
    'LoLK' => [15, 'Standard', '3', '<strong>Pointdevice Mode:</strong> Gained by getting Chapter Bonuses, 5 per bomb<br><strong>Legacy Mode:</strong> Dropped by Spell Cards in Extra only, 5 per bomb'],
    'HSiFS' => [16, 'Standard', '3', 'Bomb items, bombpieces dropped from capturing boss attacks and certain enemies'],
    'WBaWC' => [17, 'Standard', '3', 'Dropped when ending Roaring Mode with a bombpiece spirit in stock, 3 per bomb'],
    'UM' => [18, 'Standard', '3', 'Bombpieces, full bombs, as well as other cards that award bombs can be bought from the shop']
];
?>
<h2 id='resources'>How do I get more resources?</h2>
<h4 id='lives'>Extra lives</h4>
<p>Extra lives are commonly referred to as extends or 1ups. The table below tells you what system for awarding extends each game uses.</p>
<p>In LoLK (Touhou 15) on Pointdevice Mode, you do not get any extra lives, but instead have the ability to retry a section when you die.</p>
<table>
    <tr>
        <th>#</th>
        <th>Game</th>
        <th>Extend system</th>
        <th>Notes (m = million, b = billion)</th>
    </tr>
    <?php
        foreach ($lives as $game => $data) {
            echo '<tr><td>Touhou ' . strval($data[0]) . '</td><td>' . $game . '</td><td>' . $data[1] . '</td><td>' . $data[2] . '</td></tr>';
        }
    ?>
</table>
<p>* 5 per life in Extra</p>
<h4 id='bombs'>Bombs</h4>
<p>Most games have bombs as a separate resource, shown right below your life count. However, in MoF (Touhou 10) and SA (Touhou 11) you bomb by spending Power.
GFW (Touhou 12.8) has a unique bomb system, known as Perfect Freeze, which is a percentage up to 300% and costs 100% to use. Bombs do not exist in PoFV (Touhou 9).</p>
<p>The default stock is 3 bombs, which you receive both when starting a run and when you die. In some games though, it works a bit differently.
Furthermore, you are awarded a bomb if you get an extra life when you already have the maximum number of lives.</p>
<table>
    <tr>
        <th>#</th>
        <th>Game</th>
        <th>Bomb system</th>
        <th>Stock size</th>
        <th>How to get bombs</th>
    </tr>
    <?php
        foreach ($bombs as $game => $data) {
            echo '<tr><td>Touhou ' . strval($data[0]) . '</td><td>' . $game . '</td><td>' . $data[1] . '</td><td>' . $data[2] . '</td><td>' . $data[3] . '</td></tr>';
        }
    ?>
</table>
<p>** In SoEW (Touhou 2), when you die and have 0 extra lives left, you will receive 2 bombs in addition to the stock. You start out with 1 bomb in Extra.</p>
<p>*** In PCB (Touhou 7), Marisa and Sakuya have different bomb stocks. Marisa starts out with 2 bombs and Sakuya starts out with 4 bombs.</p>
<p>**** In IN (Touhou 8), if playing as Ghost Team, you get an extra bomb when clearing a stage with less than 3 bombs left.</p>
