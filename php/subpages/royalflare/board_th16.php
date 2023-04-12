<div><?php
    foreach ($diffs as $key => $diff) {
        if ($diff == 'Phantasm') {
            break;
        }
        echo '<ul><li class="diff"><a href="#' . $diff . '">' . $diff . '</a></li>';
        foreach ($shots as $key => $shot) {
            if (substr($shot, -6) != 'Spring' && $diff != 'Extra' || substr($shot, -5) != 'Extra' && $diff == 'Extra') {
                continue;
            }
            $shot = preg_replace('/Spring|Extra/', '', $shot);
            echo '<li><a href="#' . $diff . $shot . '">' . tl_shot($shot, 'Japanese') . ' - ' . $shot . '</a></li>';
        }
        echo '</ul>';
    }
?></div>
<p class='left'><strong><a href='/royalflare/history/th16'>履歴 - History</a></strong></p>
<p class='right'><strong><a href='/royalflare/standings/th16'>ランキング - Player Standings</a></strong></p>
<?php
    foreach ($diffs as $key => $diff) {
        if ($diff == 'Phantasm') {
            break;
        }
        echo '<h2 id="' . $diff . '">' . $diff . '</h2>';
        foreach ($shots as $key => $shot) {
            if (substr($shot, -5) == 'Extra' && $diff != 'Extra' || substr($shot, -5) != 'Extra' && $diff == 'Extra') {
                continue;
            }
            if (substr($shot, -6) == 'Spring') {
                $temp_shot = preg_replace('/Spring/', '', $shot);
                echo '<h3 id="' . $diff . $temp_shot . '" class="shottype">' . tl_shot($shot, 'Japanese') . ' - ' . $shot . '</h3>';
            } else if (substr($shot, -5) == 'Extra') {
                $shot = preg_replace('/Extra/', '', $shot);
                echo '<h3 id="' . $diff . $shot . '" class="shottype">' . tl_shot($shot, 'Japanese') . ' - ' . $shot . '</h3>';
            } else {
                echo '<h3 id="' . $diff . $shot . '" class="shottype">' . tl_shot($shot, 'Japanese') . ' - ' . $shot . '</h3>';
            }
            echo '<div class="overflow"><table id="' . $diff . $shot . 't" class="' . $game . 't sortable"><thead><tr><th class="no-sort">#</th><th id="' . $diff . $shot .
            'score">スコア<br>Score</th><th>処理落率<br>Slowdown</th><th>使用キャラ<br>Shottype</th><th>難易度<br>Difficulty</th>' .
            '<th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody>';
            foreach ($board as $key => $entry) {
                if ($entry['difficulty'] == $diff && $entry['chara'] == $shot) {
                    $slowdown_class = (check_slowdown($game, $entry['slowdown']) ? ' class="slowdown"' : '');
                    echo '<tr><td></td><td data-sort="' . $entry['score'] . '">' . number_format($entry['score'], 0, '.', ',') . '</td><td' . $slowdown_class . '>' . $entry['slowdown'] . '</td><td>' . $entry['chara'] .
                    '</td><td>' . $entry['difficulty'] . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td class="break">' . $entry['comment'] . '</td>' .
                    '<td><a href="' . $entry['replay'] . '">' . $entry['uploaded'] . '</a></td></tr>';
                }
            }
            echo '</tbody></table></div>';
        }
    }
?>
