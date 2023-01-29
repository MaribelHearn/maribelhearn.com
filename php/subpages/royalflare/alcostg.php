<?php
    $json = file_get_contents('assets/games/royalflare/json/alcostg.json');
    $board = json_decode($json, true);
    echo '<p class="center">All runs were performed on Version 1.00a.</p>';
    echo '<div class="overflow"><table class="alcostg sortable"><thead><tr><th id="head">#</th><th id="score">スコア<br>Score</th><th>処理落率<br>Slowdown</th>' .
    '<th><span class="nowrap">プレイ日付</span><br>Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody>';
    foreach ($board as $key => $entry) {
        echo '<tr><td class="hidden"><td data-sort="' . $entry['score'] . '">' . number_format($entry['score'], 0, '.', ',') . '</td><td>' . $entry['slowdown'] . '</td>' .
        '<td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td>' . $entry['comment'] . '</td><td><a href="' . $entry['replay'] . '">' . $entry['uploaded'] . '</a></td></tr>';
    }
    echo '</tbody></table></div>';
?>
