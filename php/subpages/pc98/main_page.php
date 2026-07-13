<?php
global $API_BASE;
$RECENT_LIMIT = isset($_COOKIE['recent_limit']) ? max(intval($_COOKIE['recent_limit']), 1) : 15;
?>
<h1><?php echo _('Touhou PC-98 Leaderboard') ?></h1>
<p><?php echo _('Welcome to the Touhou PC-98 leaderboard. This page contains lists of score runs performed Touhou PC-98 games, on Lunatic or Extra difficulty, which meet a certain scoring threshold.'); ?></p>
<p><a id='information' href='/pc98/info'><?php echo _('Click here to view further information and guidelines for this page.') ?></a></p>
<p><?php echo _('For help on how to set up the Touhou PC-98 games, consult <a href="/faq/pc98" target="_blank">the PC-98 FAQ page</a> on this website.') ?></p>
<div id='categories'>
    <h2><?php echo _('Categories') ?></h2>
    <div id='cards'>
        <div class='cards_inner'>
            <div class='card'><a href='/pc98/th01' class='card_link'>
                <span class='title large'><span id='HRtP_image' class='game_img sheet'></span>
                <?php echo _('Touhou 1 - The Highly Responsive to Prayers') ?>
            </a></div>
            <div class='card'><a href='/pc98/th02' class='card_link'>
                <span class='title large'><span id='SoEW_image' class='game_img sheet'></span>
                <?php echo _('Touhou 2 - The Story of Eastern Wonderland') ?>
            </a></div>
            <div class='card'><a href='/pc98/th03' class='card_link'>
                <span class='title large'><span id='PoDD_image' class='game_img sheet'></span>
                <?php echo _('Touhou 3 - Phantasmagoria of Dim.Dream') ?>
            </a></div>
            <div class='card'><a href='/pc98/th04' class='card_link'>
                <span class='title large'><span id='LLS_image' class='game_img sheet'></span>
                <?php echo _('Touhou 4 - Lotus Land Story') ?>
            </a></div>
            <div class='card'><a href='/pc98/th05' class='card_link'>
                <span class='title large'><span id='MS_image' class='game_img sheet'></span>
                <?php echo _('Touhou 5 - Mystic Square') ?>
            </a></div>
        </div>
        <div class='cards_inner'>
            <div class='card'><a href='/pc98/th02ex' class='card_link'>
                <span class='title large'><span id='SoEW_image' class='game_img sheet'></span>
                <?php echo _('Touhou 2 - The Story of Eastern Wonderland') ?> - Extra
            </a></div>
            <div class='card'><a href='/pc98/th04ex' class='card_link'>
                <span class='title large'><span id='LLS_image' class='game_img sheet'></span>
                <?php echo _('Touhou 4 - Lotus Land Story') ?> - Extra
            </a></div>
            <div class='card'><a href='/pc98/th05ex' class='card_link'>
                <span class='title large'><span id='MS_image' class='game_img sheet'></span>
                <?php echo _('Touhou 5 - Mystic Square') ?> - Extra
            </a></div>
        </div>
    </div>
</div>
<div id='recent'>
    <h2><?php echo _('Recent Scores') ?></h2>
    <div class='contents'>
        <p>
            <label for='recent_limit'><?php echo _('Number of Recent Records') ?></label>
            <input id='recent_limit' type='number' value='<?php echo (isset($_COOKIE['recent_limit']) ? $_COOKIE['recent_limit'] : 15) ?>' min=1>
        </p><p>
            <input id='save_changes' type='button' value='<?php echo _('Save Changes') ?>'>
        </p>
    </div>
    <div class='overflow_mobile'>
        <table class='sortable'>
            <thead><tr>
                <th class='general_header'><?php echo _('Game')  ?></th>
                <th class='general_header'><?php echo _('Score') ?></th>
                <th class='general_header'><?php echo _('Player') ?></th>
                <th class='general_header'><?php echo _('Shottype')  ?></th>
                <th class='general_header'><?php echo _('Status') ?></th>
                <th class='general_header'><?php echo _('Video') ?></th>
                <th class='general_header'><?php echo _('Date') ?></th>
            </tr></thead>
            <tbody><?php
                $recent = curl_get($API_BASE . '/api/v1/replay/?limit=' . $RECENT_LIMIT . '&ordering=-date,-score&game__lte=5&difficulty=Lunatic&difficulty=Extra&type=Score');
                $recent = json_decode($recent, true);
                $recent = $recent['results'];
                foreach ($recent as $key => $data) {
                    $status = get_status($thresholds, $data['score'], $data['category']['game'], $data['category']['difficulty']);
                    if (!$status) {
                        continue;
                    }
                    $score_text = number_format($data['score'], 0, '.', ',');
                    $date = date_tl($data['date'], $lang);
                    $date_raw = date_tl($data['date'], 'raw');
                    $status_class = strtolower(str_replace(' ', '', $status));
                    if (empty($data['replay'])) {
                        $replay = '-';
                    } else {
                        $chunks = preg_split('/\//', $data['replay']);
                        $replay = '<a href="' . $data['replay'] . '">' . $chunks[count($chunks) - 1] . '</a>';
                    }
                    if (empty($data['video'])) {
                        $video = '-';
                    } else {
                        $video = '<a href="' . $data['video'] . '">' . _('Link') . '</a>';
                    }
                    echo '<tr>';
                    echo '<td class="' . $data['category']['game'] . 'p">' . _($data['category']['game']) . _(' ') . _($data['category']['difficulty']) . '</td>';
                    echo '<td data-sort="' . $data['score'] . '">' . $score_text . '</td>';
                    echo '<td>' . $data['player'] . '</td>';
                    echo '<td>' . $data['category']['shot'] . '</td>';
                    echo '<td class="' . $status_class . '">' . $status . '</td>';
                    echo '<td>' . $video . '</td>';
                    echo '<td data-sort="' . $date_raw . '">' . $date . '</td>';
                    echo '</tr>';
                }
            ?></tbody>
        </table>
    </div>
</div>
