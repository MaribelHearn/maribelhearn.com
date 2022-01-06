<?php
    $json = file_get_contents('assets/royalflare/json/alcostg.json');
    $board = json_decode($json, true);
    echo '<p>All runs were performed on Version 1.00a.</p>';
    echo '<table class="alcostg sortable"><tr><th id="head">#</th><th id="score">スコア<br>Score</th><th>処理落率<br>Slowdown</th>' .
    '<th><span class="nowrap">プレイ日付</span><br>Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr>';
    foreach ($board as $key => $entry) {
        echo '<tr><td class="hidden"><td>' . number_format($entry['score'], 0, '.', ',') . '</td><td>' . $entry['slowdown'] . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td>' . $entry['comment'] .
        '</td><td><a href="' . $entry['replay'] . '">' . array_slice(preg_split('/\//', $entry['replay']), -1)[0] . '</a></td></tr>';
    }
    echo '</table>';
?>
