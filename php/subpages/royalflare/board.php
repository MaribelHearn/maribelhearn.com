<?php
    links($game, $diffs, $shots);
    if ($game != 'IN') {
        echo '<p class="left"><strong><a href="/royalflare/history/' . $subpage . '">履歴 - History</a></strong></p>';
    } else {
        $route =($_SESSION['subpage'] == 'th08a' ? 'A' : 'B');
    }
?>
<p class='right'><strong><a href='/royalflare/standings/<?php echo $subpage ?>'>ランキング - Player Standings</a></strong></p>
<?php
    if ($game == 'IN') { echo '<p><strong><a href="/royalflare/th08' . ($route == 'B' ? 'a' : '') . '">' . ($route == 'B' ? 'A' : 'B'). 'ルート - Final' . ($route == 'B' ? 'A' : 'B') . '</a></strong></p>'; }
    foreach ($diffs as $key => $diff) {
        if ($game != 'PCB' && $diff == 'Phantasm') {
            break;
        }
        echo '<h2 id="' . $diff . '">' . $diff . '</h2>';
        if ($game == 'GFW' && $diff == 'Extra') {
            echo '<div class="overflow"><table id="' . $diff . 't" class="' . $game . 't sortable"><thead><tr><th class="no-sort">#</th><th id="' . $diff .
            'score">スコア<br>Score</th><th>処理落率<br>Slowdown</th><th>難易度<br>Difficulty</th>' .
            '<th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody>';
            foreach ($board as $key => $entry) {
                if ($entry['difficulty'] == $diff) {
                    $slowdown_class = (check_slowdown($game, $entry['slowdown']) ? ' class="slowdown"' : '');
                    echo '<tr><td class="hidden"></td><td data-sort="' . $entry['score'] . '">' . number_format($entry['score'], 0, '.', ',') . '</td><td' . $slowdown_class . '>' . $entry['slowdown'] . '</td>' .
                    '<td>' . $entry['difficulty'] . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td class="break">' . $entry['comment'] .
                    '</td><td><a href="' . $entry['replay'] . '">' . $entry['uploaded'] . '</a></td></tr>';
                }
            }
            echo '</tbody></table></div>';
        } else {
            foreach ($shots as $key => $shot) {
                echo '<h3 id="' . $diff . $shot . '" class="shottype">' . (tl_shot(str_replace(' ', '', $shot), 'Japanese') != $shot ? tl_shot(str_replace(' ', '', $shot), 'Japanese') . ' - ' : '') . $shot .
                '</h3><div class="overflow"><table id="' . $diff . $shot . 't" class="' . $game . 't sortable"><thead><tr><th class="no-sort">#</th><th id="' . $diff . $shot .
                'score">スコア<br>Score</th><th>処理落率<br>Slowdown</th>' . ($game != 'GFW' ? '<th><span class="nowrap">使用キャラ</span><br>Shottype</th>' : '<th><span class="nowrap">ルート</span><br>Route</th>') .
                '<th>難易度<br>Difficulty</th><th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody>';
                foreach ($board as $key => $entry) {
                    $slowdown_class = (check_slowdown($game, $entry['slowdown']) ? ' class="slowdown"' : '');
                    if ($entry['difficulty'] == $diff && (($game != 'GFW' && $entry['chara'] == $shot) || ($game == 'GFW' && $entry['route'] == $shot))) {
                        if ($game != 'IN' || $diff == 'Extra' || $entry['route'] == ('Final' . $route)) {
                            echo '<tr><td></td><td data-sort="' . $entry['score'] . '">' . number_format($entry['score'], 0, '.', ',') . '</td><td' . $slowdown_class . '>' . $entry['slowdown'] .
                            '</td>' . ($game != 'GFW' ? '<td>' . tl_shot($entry['chara'], $lang) . '</td>' : '<td>' . $entry['route'] . '</td>') .
                            '<td>' . $entry['difficulty'] . ($game == 'IN' && $diff != 'Extra' ? '<br>' . (tl_term('Final' . $route, $lang)) : '') . '</td>' .
                            '<td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td class="break">' . $entry['comment'] . '</td>' .
                            '<td><a href="' . $entry['replay'] . '">' . (empty($entry['uploaded']) ? $entry['date'] : $entry['uploaded']) . '</a></td></tr>';
                        }
                    }
                }
                echo '</tbody></table></div>';
            }
        }
    }
?>
