<?php
    $json = file_get_contents('assets/games/royalflare/json/hellsinker.json');
    $board = json_decode($json, true);
    echo '<div class="overflow"><table class="hellsinker sortable"><thead><tr><th id="head">#</th><th>使用キャラ<br>Shottype</th><th>ステージ<br>Stage</th>' .
    '<th>SPIRIT</th><th>KILL</th><th>TOKEN</th><th>日付<br>Date</th><th>PLAYER</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody>';
    foreach ($board as $key => $entry) {
        echo '<tr><td class="hidden"></td><td class="nowrap">' . $entry['charname'] . '</td><td>' . $entry['stagename'] . '</td><td data-sort="' . $entry['spirit'] . '">' . number_format($entry['spirit'], 0, '.', ',') .
        '</td><td data-sort="' . $entry['kill'] . '">' . number_format($entry['kill'], 0, '.', ',') . '</td><td data-sort="' . $entry['token'] . '">' . number_format($entry['token'], 0, '.', ',') .
        '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td>' . $entry['comment'] . '</td><td><a href="' . $entry['replay'] .
        '">' . array_slice(preg_split('/\//', $entry['replay']), -1)[0] . '</a></td></tr>';
    }
    echo '</tbody></table></div>';
?>
