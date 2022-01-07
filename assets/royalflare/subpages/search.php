<form target='_self' action='/royalflare/search'>
    <div>
        <p><label for='player'>名前 Player</label>
        <input id='player' name='player' type='text' value='<?php echo !empty($player) ? $player : '' ?>'></p>
        <p><label for='game'>ゲーム Game</label>
        <select id='game' name='game'>
            <option value='-'>...</option>
            <?php
                foreach (glob('assets/royalflare/json/*.*') as $file) {
                    if (strpos($file, 'alcostg') !== false || strpos($file, 'hellsinker') !== false) {
                        continue;
                    }
                    echo '<option' . (!empty($game) && $game == format_game($file) ? ' selected' : '') . '>' . format_game($file) . '</option>';
                }
            ?>
        </select></p>
        <p><label for='shot'>使用キャラ Shottype</label>
        <input id='shot' name='shot' type='text' value='<?php echo !empty($shot) ? $shot : '' ?>'></p>
        <p><label for='diff'>難易度 Difficulty</label>
        <select id='diff' name='diff'>
            <option value='-'>...</option>
            <?php
                foreach ($diffs as $key => $value) {
                    echo '<option' . (!empty($diff) && $diff == $value ? ' selected' : '') . '>' . $value . '</option>';
                }
            ?>
        </select></p>
        <p><label for='comment'>コメント Comment</label>
        <input id='comment' name='comment' type='text' value='<?php echo !empty($comment) ? $comment : '' ?>'></p>
    </div>
    <p><input type='submit' value='検索 Search'></p>
</form>
<?php
    function check_conditions(array $entry, string $player, string $game, string $diff, string $shot, string $comment) {
        if (substr($player, 0, 1) == '"' && substr($player, -1) == '"') {
            $player = substr($player, 1, -1);
            $player_matches = $player == $entry['player'];
        } else {
            $player_matches = str_contains(strtolower($entry['player']), strtolower($player));
        }
        if (!empty($player) && !$player_matches) {
            return false;
        }
        if ($diff != '-' && $entry['difficulty'] != $diff) {
            return false;
        }
        if ($game == 'GFW') {
            if (substr($shot, 0, 1) == '"' && substr($shot, -1) == '"') {
                $shot = substr($shot, 1, -1);
                $shot_matches = $shot == $entry['route'];
            } else {
                $shot_matches = str_contains(strtolower($entry['route']), strtolower($shot));
            }
        } else if (isset($entry['chara'])) {
            if (substr($shot, 0, 1) == '"' && substr($shot, -1) == '"') {
                $shot = substr($shot, 1, -1);
                $shot_matches = $shot == $entry['chara'];
            } else {
                $shot_matches = str_contains(strtolower($entry['chara']), strtolower($shot));
            }
        }
        if (!empty($shot) && !$shot_matches) {
            return false;
        }
        if (substr($comment, 0, 1) == '"' && substr($comment, -1) == '"') {
            $comment = substr($comment, 1, -1);
            $comment_matches = $comment == $entry['comment'];
        } else {
            $comment_matches = str_contains(strtolower($entry['comment']), strtolower($comment));
        }
        if (!empty($comment) && !$comment_matches) {
            return false;
        }
        return true;
    }

    function results(string $player, string $game, string $diff, string $shot, string $comment, bool $gamecol) {
        $table = '';
        $board = get_board($game);
        foreach ($board as $key => $entry) {
            if (check_conditions($entry, $player, $game, $diff, $shot, $comment)) {
                if (!empty($entry['chara'])) {
                    $tmp_shot = $entry['chara'];
                } else if (!empty($entry['route'])) {
                    $tmp_shot = $entry['route'];
                } else {
                    $tmp_shot = '-';
                }
                if ($game == 'th095' || $game == 'th125' || $game == 'th143' || $game == 'th165') {
                    $tmp_diff = (empty($entry['stage']) ? '-' : $entry['stage']);
                } else {
                    $tmp_diff = (empty($entry['difficulty']) ? '-' : $entry['difficulty']);
                }
                $table .= '<tr><td class="hidden"></td>' . ($gamecol ? '<td class=' . game_to_abbr($game) . '>' . $game . '</td>' : '') .
                '<td>' . number_format($entry['score'], 0, '.', ',') . '</td><td>' . $entry['slowdown'] . '</td><td>' . $tmp_shot . '</td>' .
                '<td>' . $tmp_diff . '</td><td>' . $entry['date'] . '</td><td>' . $entry['player'] .
                '</td><td class="break">' . $entry['comment'] . '</td><td><a href="' . $entry['replay'] . '">' . $entry['uploaded'] . '</a></td></tr>';
            }
        }
        return $table;
    }

    if ($game != '-' || $diff != '-' || !empty($player) && strlen($player) > 1 || !empty($shot) && strlen($shot) > 1 || !empty($comment) && strlen($comment) > 1) {
        $count = 0;
        if ($game == '-') {
            $table = '<table id="results" class="search_header sortable"><thead><tr><th class="head">#</th><th>ゲーム<br>Game</th><th>スコア<br>Score</th><th>処理落率<br>Slowdown</th><th>使用キャラ<br>Shottype</th>' .
            '<th>難易度<br>Difficulty</th><th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody id="results_tbody">';
            foreach (glob('assets/royalflare/json/*.*') as $file) {
                if (strpos($file, 'alcostg') !== false || strpos($file, 'hellsinker') !== false) {
                    continue;
                }
                $results = results($player, format_game($file), $diff, $shot, $comment, true);
                if (!empty($results)) {
                    $count += 1;
                    $table .= $results;
                }
            }
        } else {
            $table = '<table id="results" class="' . game_to_abbr($game) . 't search sortable"><thead><tr><th class="head">#</th><th>スコア<br>Score</th><th>処理落率<br>Slowdown</th><th>使用キャラ<br>' .
            'Shottype</th><th>難易度<br>Difficulty</th><th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody id="results_tbody">';
            $results = results($player, $game, $diff, $shot, $comment, false);
            if (!empty($results)) {
                $count += 1;
                $table .= $results;
            }
        }
        if ($count > 0) {
            echo $table . '</tbody></table>';
        } else {
            echo '<p class="nodata">登録データがありません。<br>There is no registration data.</p>';
        }
    } else {
        echo '<p class="nodata">登録データがありません。<br>There is no registration data.</p>';
    }
?>
