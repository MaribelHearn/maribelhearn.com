<ul><?php
    foreach ($stages->{$game} as $key => $stage) {
        echo '<li class="scene_li"><span class="diff"><a href="#' . $stage . '">' . format_title($game) . format_stage($game, $stage) . '</a></span>';
        $scene_count = $scenes->{$game}[$stage - 1];
        for ($i = 1; $i <= $scene_count; $i++) {
            echo ' <a class="scene" href="#' . $stage . '-' . $i . '">' . ($game != 'VD' ? format_stage($game, $stage) . '-'  : '') . $i . '</a>';
        }
        echo '</li>';
    }
?></ul>
<p class='right'><strong><a href='/royalflare/standings/<?php echo $subpage ?>'>ランキング - Player Standings</a></strong></p>
<?php
    foreach ($stages->{$game} as $key => $stage) {
        echo '<h2 id="' . $stage . '">' . format_title($game) . format_stage($game, $stage) . '</h2>';
        $scene_count = $scenes->{$game}[$stage - 1];
        for ($scene = 1; $scene <= $scene_count; $scene++) {
            $table = '';
            $count = 0;
            echo '<p id="' . $stage . '-' . $scene . '" class="wide shottype">' . ($game != 'VD' ? 'Scene ' : '') . format_stage($game, $stage) . '-' . $scene . '</p>';
            $table .= '<div class="overflow"><table id="' . $stage . '-' . $scene . 't" class="' . $game . 't sortable">' .
            '<thead><tr><th class="head">#</th><th id="' . $stage . '-' . $scene . 'score">スコア<br>Score</th><th>処理落率<br>Slowdown</th><th><span class="nowrap">撮影対象</span><br>Scene</th>' .
            '<th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody>';
            foreach ($board as $key => $entry) {
                if ($entry['stage'] == format_stage($game, $stage) . '-' . $scene) {
                    $slowdown_class = (check_slowdown($game, $entry['slowdown']) ? ' class="slowdown"' : '');
                    $table .= '<tr><td class="hidden"></td><td data-sort="' . $entry['score'] . '">' . number_format($entry['score'], 0, '.', ',') . '</td><td' . $slowdown_class . '>' . $entry['slowdown'] . '</td>' .
                    '<td>' . $entry['stage'] . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] . '</td><td class="break">' . $entry['comment'] .
                    '</td><td><a href="' . $entry['replay'] . '">' . $entry['uploaded'] . '</a></td></tr>';
                    $count += 1;
                }
            }
            $table .= '</tbody></table></div>';
            if ($count > 0) {
                echo $table;
            } else {
                echo '<p class="nodata">登録データがありません。<br>There is no registration data.</p>';
            }
        }
    }
?>
