<p>A complete archive of the replays and history from <a href='http://score.royalflare.net'>http://score.royalflare.net</a>. It includes full search functionality that the original site did not have.</p>
<p>On 3 January 2022, Royalflare stopped allowing replay uploads, and it will shut down at the end of the month.
As such, this archive has been created to preserve all of its replays and history. Unlike the original website, these replays cannot be deleted.</p>
<p>The table resulting from search can be sorted by score, date etc. (note that this might be slow depending on the size).</p>
<h2>検索 - Search</h2>
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
<h2>Games</h2>
<dt>TH06</dt>
<dd><a href='/royalflare/th06'>東方紅魔郷　～ The Embodiment of Scarlet Devil</a></dd>
<dt>TH07</dt>
<dd><a href='/royalflare/th07'>東方妖々夢　～ Perfect Cherry Blossom</a></dd>
<dt>TH08</dt>
<dd><a href='/royalflare/th08'>東方永夜抄　～ Imperishable Night</a></dd>
<dt>TH09.5</dt>
<dd><a href='/royalflare/th095'>東方文花帖　～ Shoot the Bullet</a></dd>
<dt>TH10</dt>
<dd><a href='/royalflare/th10'>東方風神録　～ Mountain of Faith</a></dd>
<dt>TH11</dt>
<dd><a href='/royalflare/th11'>東方地霊殿　～ Subterranean Animism</a></dd>
<dt>TH12</dt>
<dd><a href='/royalflare/th12'>東方星蓮船　～ Undefined Fantastic Object</a></dd>
<dt>TH12.5</dt>
<dd><a href='/royalflare/th125'>ダブルスポイラー　～ 東方文花帖 (Double Spoiler)</a></dd>
<dt>TH12.8</dt>
<dd><a href='/royalflare/th128'>妖精大戦争　～ 東方三月精 (Great Fairy Wars)</a></dd>
<dt>TH13</dt>
<dd><a href='/royalflare/th13'>東方神霊廟　～ Ten Desires</a></dd>
<dt>TH14</dt>
<dd><a href='/royalflare/th14'>東方輝針城　～ Double Dealing Character</a></dd>
<dt>TH14.3</dt>
<dd><a href='/royalflare/th143'>弾幕アマノジャク　～ Impossible Spell Card</a></dd>
<dt>TH15</dt>
<dd><a href='/royalflare/th15'>東方紺珠伝　～ Legacy of Lunatic Kingdom</a></dd>
<dt>TH16</dt>
<dd><a href='/royalflare/th16'>東方天空璋　～ Hidden Star in Four Seasons</a></dd>
<dt>TH16.5</dt>
<dd><a href='/royalflare/th165'>秘封ナイトメアダイアリー　～ Violet Detector</a></dd>
<dt>TH17</dt>
<dd><a href='/royalflare/th17'>東方鬼形獣　～ Wily Beast and Weakest Creature</a></dd>
<dt>TH18</dt>
<dd><a href='/royalflare/th18'>東方虹龍洞　～ Unconnected Marketeers</a></dd>
<br>
<dt>UB</dt>
<dd><a href='/royalflare/alcostg'>黄昏酒場～Uwabami Breakers～</a></dd>
<dt>HS</dt>
<dd><a href='/royalflare/hellsinker'>Hellsinker.</a></dd>
