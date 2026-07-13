<?php
global $thresholds;
?>
<h1><?php echo _('Information') ?></h1>
<p><?php echo _('This is an unofficial, community-maintained website.') ?></p><p><?php echo _('In general, you need to upload a video to an online platform for a score to be accepted on the website, ' .
    'for example <a href="https://www.silentselene.net" target="_blank">Silent Selene</a> or <a href="https://www.youtube.com" target="_blank">YouTube</a>. ' .
    'Streaming to a live streaming platform like <a href="https://twitch.tv" target="_blank">Twitch</a> is also accepted, provided that the VOD is not deleted. ' .
    'Exceptions may be made on a case-by-case basis.') ?></p>
<p><?php echo _('The threshold system was inspired by <a href="https://balisman.github.io/" target="_blank">Touhou Extra Scoreboard</a> that was originally made by Nyanko.') ?></p>
<p><?php echo _('To qualify for each leaderboard, you must meet at least its "Big" threshold. See below for the scoring thresholds that can be achieved. Game Over is allowed.') ?></p>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('HRtP') ?> Lunatic</td>
            <td rowspan='3'><span id='HRtP_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->HRtP[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->HRtP[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->HRtP[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('SoEW') ?> Lunatic</td>
            <td rowspan='3'><span id='SoEW_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->SoEW[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->SoEW[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->SoEW[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('PoDD') ?> Lunatic</td>
            <td rowspan='3'><span id='PoDD_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->PoDD[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->PoDD[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->PoDD[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('LLS') ?> Lunatic</td>
            <td rowspan='3'><span id='LLS_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->LLS[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->LLS[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->LLS[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('MS') ?> Lunatic<br>(Mima, Marisa)</td>
            <td rowspan='3'><span id='MS_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->MS[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->MS[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->MS[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('MS') ?> Lunatic<br>(Reimu, Yuuka)</td>
            <td rowspan='3'><span id='MS_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->MSlow[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->MSlow[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->MSlow[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('SoEW') ?> Extra</td>
            <td rowspan='3'><span id='SoEW_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->SoEWex[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->SoEWex[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->SoEWex[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('LLS') ?> Extra</td>
            <td rowspan='3'><span id='LLS_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->LLSex[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->LLSex[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->LLSex[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<table class='thresholds noborders'>
    <tbody>
        <tr>
            <td class='acronym' rowspan='3'><?php echo _('MS') ?> Extra</td>
            <td rowspan='3'><span id='MS_image' class='game_img sheet'></td>
            <th class='big'><?php echo _('Big') ?></th>
            <td><?php echo number_format($thresholds->MSex[0], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='bigger'><?php echo _('Bigger') ?></th>
            <td><?php echo number_format($thresholds->MSex[1], 0, '.', ',') ?></td>
        </tr>
        <tr>
            <th class='superbig'><?php echo _('Super Big') ?></th>
            <td><?php echo number_format($thresholds->MSex[2], 0, '.', ',') ?></td>
        </tr>
    </tbody>
</table>
<p><?php echo _('If a run is shown to have been cheated beyond reasonable doubt, for example by using savestates, pause buffering, or slowdown, it will be removed from the website.') ?></p>
<h2><?php echo _('Submission') ?></h2>
<p><?php echo _('At present, we do <strong>not</strong> use a submission form. If you upload your score somewhere, it will eventually be noticed by us and added to the website.') ?></p>
<p><?php echo _('If we missed your score, you can contact <a href="/contact" target="_blank">me</a> to add it to the website.') ?></p>