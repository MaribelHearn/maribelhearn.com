<form target='_self' action='/royalflare/search'>
    <div>
        <label for='player'>Player</label>
        <input id='player' name='player' type='text' value='<?php echo !empty($player) ? $player : '' ?>'>
        <label for='game'>Game</label>
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
        </select>
        <label for='shot'>Shottype</label>
        <input id='shot' name='shot' type='text' value='<?php echo !empty($shot) ? $shot : '' ?>'>
        <label for='diff'>Difficulty</label>
        <select id='diff' name='diff'>
            <option value='-'>...</option>
            <?php
                foreach ($diffs as $key => $value) {
                    echo '<option' . (!empty($diff) && $diff == $value ? ' selected' : '') . '>' . $value . '</option>';
                }
            ?>
        </select>
    </div>
    <p><input type='submit' value='Search'></p>
</form>
<?php
    function check_conditions(array $entry, string $player, string $game, string $diff, string $shot) {
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
            if (!empty($shot) && $entry['route'] != $shot) {
                return false;
            }
        } else {
            if (!empty($shot) && $entry['chara'] != $shot) {
                return false;
            }
        }
        return true;
    }

    function results(string $player, string $game, string $diff, string $shot, bool $gamecol) {
        $table = '';
        $board = get_board($game);
        foreach ($board as $key => $entry) {
            if (check_conditions($entry, $player, $game, $diff, $shot)) {
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
                '</td><td class="break">' . $entry['comment'] . '</td><td><a href="' . $entry['replay'] . '">' . array_slice(preg_split('/\//', $entry['replay']), -1)[0] . '</a></td></tr>';
            }
        }
        return $table;
    }

    if ($game != '-' || $diff != '-' || !empty($player) && strlen($player) > 1 || !empty($shot)) {
        $count = 0;
        if ($game == '-') {
            $table = '<table id="results" class="search_header sortable"><thead><tr><th class="head">#</th><th>ゲーム<br>Game</th><th>スコア<br>Score</th><th>処理落率<br>Slowdown</th><th>使用キャラ<br>Shottype</th>' .
            '<th>難易度<br>Difficulty</th><th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody id="results_tbody">';
            foreach (glob('assets/royalflare/json/*.*') as $file) {
                if (strpos($file, 'alcostg') !== false || strpos($file, 'hellsinker') !== false) {
                    continue;
                }
                $results = results($player, format_game($file), $diff, $shot, true);
                if (!empty($results)) {
                    $count += 1;
                    $table .= $results;
                }
            }
        } else {
            $table = '<table id="results" class="' . game_to_abbr($game) . 't search sortable"><thead><tr><th class="head">#</th><th>スコア<br>Score</th><th>処理落率<br>Slowdown</th><th>使用キャラ<br>' .
            'Shottype</th><th>難易度<br>Difficulty</th><th>プレイ日付<br>Play Date</th><th>名前<br>Player</th><th>コメント<br>Comment</th><th>リプレイ<br>Replay</th></tr></thead><tbody id="results_tbody">';
            $results = results($player, $game, $diff, $shot, false);
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
