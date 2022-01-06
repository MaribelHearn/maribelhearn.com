<?php
    links($game, $diffs, $shots);
    if ($game != 'IN') {
        echo '<p class="left"><strong><a href="/royalflare/history/' . $subpage . '">履歴 - History</a></strong></p>';
    }
?>
<p class='right'><strong><a href='/royalflare/standings/<?php echo $subpage ?>'>ランキング - Player Standings</a></strong></p>
<?php
    foreach ($diffs as $key => $diff) {
        if ($game != 'PCB' && $diff == 'Phantasm') {
            break;
        }
        echo '<h2 id="' . $diff . '">' . $diff . '</h2>';
        if ($game == 'GFW' && $diff == 'Extra') {
            echo '<table id="' . $diff . 't" class="' . $game . 't sortable"><tr><th class="head">#</th><th id="' . $diff .
            'score">スコア<br>Score</th><th>処理落率<br>Slowdown</th><th>難易度<br>Difficulty</th>' .
            '<th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr>';
            foreach ($board as $key => $entry) {
                if ($entry['difficulty'] == $diff) {
                    $slowdown_class = (check_slowdown($game, $entry['slowdown']) ? ' class="slowdown"' : '');
                    echo '<tr><td class="hidden"></td><td>' . number_format($entry['score'], 0, '.', ',') . '</td><td' . $slowdown_class . '>' . $entry['slowdown'] . '</td>' .
                    '<td>' . $entry['difficulty'] . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td class="break">' . $entry['comment'] .
                    '</td><td><a href="' . $entry['replay'] . '">' . array_slice(preg_split('/\//', $entry['replay']), -1)[0] . '</a></td></tr>';
                }
            }
            echo '</table>';
        } else {
            foreach ($shots as $key => $shot) {
                echo '<p id="' . $diff . $shot . '" class="shottype">' . (tl_shot(str_replace(' ', '', $shot), 'Japanese') != $shot ? tl_shot(str_replace(' ', '', $shot), 'Japanese') . ' - ' : '') . $shot . '</p>';
                echo '<table id="' . $diff . $shot . 't" class="' . $game . 't sortable"><tr><th class="head">#</th><th id="' . $diff . $shot .
                'score">スコア<br>Score</th><th>処理落率<br>Slowdown</th>' . ($game != 'GFW' ? '<th>使用キャラ<br>Shottype</th>' : '') . '<th>難易度<br>Difficulty</th>' .
                '<th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr>';
                foreach ($board as $key => $entry) {
                    $slowdown_class = (check_slowdown($game, $entry['slowdown']) ? ' class="slowdown"' : '');
                    if ($entry['difficulty'] == $diff && (($game != 'GFW' && $entry['chara'] == $shot) || ($game == 'GFW' && $entry['route'] == $shot))) {
                        echo '<tr><td class="hidden"></td><td>' . number_format($entry['score'], 0, '.', ',') . '</td>' .
                        '<td' . $slowdown_class . '>' . $entry['slowdown'] . '</td>' . ($game != 'GFW' ? '<td>' . $entry['chara'] . '</td>' : '') .
                        '<td>' . $entry['difficulty'] . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td class="break">' . $entry['comment'] .
                        '</td><td><a href="' . $entry['replay'] . '">' . array_slice(preg_split('/\//', $entry['replay']), -1)[0] . '</a></td></tr>';
                    }
                }
                echo '</table>';
            }
        }
    }
?>
