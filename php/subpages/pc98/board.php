<?php
global $API_BASE;
global $last_modified;
global $thresholds;
global $full_name;
global $game;
global $diff;
$game_code = $diff === 'Extra' ? $game . 'ex' : $game;
$lowest_threshold = $thresholds->{$game_code}[0];
$has_lowshots = false;
if (property_exists($thresholds, $game_code . 'low')) {
    $lowest_threshold = $thresholds->{$game_code . 'low'}[0];
    $has_lowshots = true;
}
$scores = curl_get($API_BASE . '/api/v1/replay/?ordering=-score&game=' . $game . '&difficulty=' . $diff . '&type=Score&score__gte=' . $lowest_threshold);
$scores = json_decode($scores, true);
?>
<h1><?php echo _($full_name) . ' - ' . $diff ?></h1>
<p><?php echo _('Welcome to the ' . $full_name . ($diff === 'Extra' ? ' Extra Stage' : '') . ' leaderboard.'); ?></p>
<p><?php echo _('To qualify for this leaderboard, you must meet at least the "Big" threshold. See below for the scoring thresholds that can be achieved.'); ?></p>
<p><?php echo (!empty($last_modified) ? format_lm($last_modified, $lang) : '') ?></p>
<table id='thresholds' class='noborders'>
    <tbody>
        <tr>
            <td rowspan='3'><?php echo '<span id="' . $game . '_image" class="game_img sheet">' ?></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->{$game_code}[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->{$game_code}[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->{$game_code}[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<?php if ($has_lowshots) {
    echo '<p class="center">' . implode(', ', $thresholds->{$game_code . 'lowshots'}) . ':</p>';
    echo '<table class="noborders"><tbody><tr>';
    echo '<td rowspan="3"><span id="' . $game . '_image" class="game_img sheet"></td>';
    echo '<th class="big">' . _('Big') . '</th>';
    echo '<td>' . number_format($thresholds->{$game_code . 'low'}[0], 0, '.', ',') . '</td>';
    echo '</tr><tr>';
    echo '<th class="bigger">' . _('Bigger') . '</th>';
    echo '<td>' . number_format($thresholds->{$game_code . 'low'}[1], 0, '.', ',') . '</td>';
    echo '</tr><tr>';
    echo '<th class="superbig">' . _('Super Big') . '</th>';
    echo '<td>' . number_format($thresholds->{$game_code . 'low'}[2], 0, '.', ',') . '</td>';
    echo '</tr></tbody></table>';
} ?>
<div>
    <div class='overflow_mobile'><table class='sortable'>
        <thead class='<?php echo $game ?>'>
            <tr>
                <th><?php echo _('Rank') ?></th>
                <th><?php echo _('Rank by player') ?></th>
                <th><?php echo _('Score') ?></th>
                <th><?php echo _('Player') ?></th>
                <th><?php echo shot_route($game) ?></th>
                <th><?php echo _('Status') ?></th>
                <th><?php echo _('Date') ?></th>
                <th><?php echo _('Video') ?></th>
            </tr>
        </thead>
        <tbody><?php
            $rank = 1;
            $rank_player = 1;
            $players_seen = [];
            $records_seen = [];
            foreach ($scores as $key => $data) {
                $shot = $data['category']['shot'];
                $record_id = $data['player'] . $shot;
                if ($has_lowshots && !in_array($shot, $thresholds->{$game_code . 'lowshots'}) && $data['score'] < $thresholds->{$game_code}[0]) {
                    continue;
                }
                if (in_array($record_id, $records_seen)) {
                    continue;
                }
                $score_text = number_format($data['score'], 0, '.', ',');
                $status = get_status($thresholds, $data['score'], $game, $diff, $shot);
                $status_class = strtolower(str_replace(' ', '', $status));
                $date_raw = date_tl($data['date'], 'raw');
                $date = date_tl($data['date'], $lang);
                echo '<tr>';
                echo '<td>' . $rank . '</td>';
                if (!in_array($data['player'], $players_seen)) {
                    echo '<td>' . $rank_player . '</td>';
                    array_push($players_seen, $data['player']);
                    $rank_player += 1;
                }
                else {
                    echo '<td data-sort=999></td>';
                }
                echo '<td data-sort="' . $data['score'] . '">' . $score_text . '</td>';
                echo '<td>' . $data['player'] . '</td>';
                echo '<td>' . $shot . '</td>';
                echo '<td class="' . $status_class . '">' . $status . '</td>';
                echo '<td data-sort="' . $date_raw . '">' . ($data['score'] == 0 ? '-' : $date) . '</td>';
                if (!empty($data['video'])) {
                    $video = '<a href="' . $data['video'] . '" target="_blank">' . _('Link') . '</a>';
                } else {
                    $video = '-';
                }
                echo '<td>' . $video . '</td>';
                echo '</tr>';
                array_push($records_seen, $record_id);
                $rank += 1;
            }
        ?></tbody>
    </table></div>
</div>