<ul><?php
    foreach ($stages->{'DS'} as $key => $stage) {
        echo '<li class="scene_li"><span class="diff"><a href="#' . $stage . '">Stage ' . format_stage('DS', $stage) . '</a></span>';
        $scene_count = $scenes->{'DS'}[$stage - 1];
        for ($i = 1; $i <= $scene_count; $i++) {
            echo ' <a class="scene" href="#' . $stage . '-' . $i . '">' . format_stage('DS', $stage) . '-' . $i . '</a>';
        }
        echo '</li>';
    }
?></ul>
<?php
    function ds_table(array $board, string $stage, string $scene, string $shottype, string $lang_code) {
        echo '<table id="' . $stage . '-' . $scene . 't" class="' . 'DS' . 't' . ($shottype == 'Hatate' ? ' hatate' : '') .
        ' sortable"><tr><th class="head">#</th><th id="' . $stage . '-' . $scene . 'score">スコア<br>Score</th>' .
        '<th>処理落率<br>Slowdown</th><th><span class="nowrap">使用キャラ</span><br>Shottype</th><th><span class="nowrap">撮影対象</span><br>Scene</th>' .
        '<th>プレイ日付<br>Play Date</th><th>名前<br>Player</th>' . ($is_mobile ? '' : '<th>コメント<br>Comment</th>') . '<th>リプレイ<br>Replay</th></tr>';
        foreach ($board as $key => $entry) {
            if ($entry['stage'] == format_stage('DS', $stage) . '-' . $scene && $entry['chara'] == $shottype) {
                $slowdown_class = (check_slowdown('DS', $entry['slowdown']) ? ' class="slowdown"' : '');
                echo '<tr><td class="hidden"></td><td>' . number_format($entry['score'], 0, '.', ',') . '</td><td' . $slowdown_class . '>' . $entry['slowdown'] . '</td>' .
                '<td>' . tl_shot($shottype, $lang_code) . '</td><td>' . $entry['stage'] . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] .
                '</td>' . ($is_mobile ? '' : '<td class="break">' . $entry['comment'] . '</td>') . '<td><a href="' . $entry['replay'] . '">' . $entry['uploaded'] . '</a></td></tr>';
            }
        }
        echo '</table>';
    }

    foreach ($stages->{'DS'} as $key => $stage) {
        echo '<h2 id="' . $stage . '">Stage ' . format_stage('DS', $stage) . '</h2>';
        $scene_count = $scenes->{'DS'}[$stage - 1];
        for ($scene = 1; $scene <= $scene_count; $scene++) {
            echo '<p id="' . $stage . '-' . $scene . '" class="shottype">Scene ' . format_stage('DS', $stage) . '-' . $scene . '</p>';
            ds_table($board, $stage, $scene, 'Aya', $lang_code);
            if ($stage < 14 || $scene > 4) {
                ds_table($board, $stage, $scene, 'Hatate', $lang_code);
            }
        }
    }
?>
