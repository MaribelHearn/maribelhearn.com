<?php
global $API_BASE;
$last_modified = curl_get($API_BASE . '/api/v1/replay/?ordering=-date&game__lte=5&difficulty=Lunatic&difficulty=Extra&date__isnull=False&type=Score&limit=1');
if (strpos($last_modified, 'Internal Server Error') !== false) {
    $_GET['error'] = 500;
    include_once('php/error.php');
    include_once('php/shared/postscript.php');
    die();
} else if (strpos($last_modified, 'Service Unavailable') !== false) {
    $_GET['error'] = 503;
    include_once('php/error.php');
    include_once('php/shared/postscript.php');
    die();
} else {
    $last_modified = json_decode($last_modified, true);
    $last_modified = $last_modified['results'][0]['date'];
}

$thresholds = (object) [];
$thresholds->HRtP = [11000000, 14000000, 16000000];
$thresholds->SoEW = [35000000, 40000000, 45000000];
$thresholds->SoEWex = [32000000, 36000000, 40000000];
$thresholds->PoDD = [100000000, 120000000, 130000000];
$thresholds->LLS = [130000000, 150000000, 170000000];
$thresholds->LLSex = [76000000, 78000000, 80000000];
$thresholds->MS = [160000000, 180000000, 200000000];
$thresholds->MSlow = [140000000, 160000000, 180000000];
$thresholds->MSex = [150000000, 180000000, 200000000];
$thresholds->MSlowshots = ['Reimu', 'Yuuka'];

function format_lm(string $lm, string $lang) {
    $result = _('The scores are current as of <span id="lm">%date</span>.');
    return str_replace('%date', date_tl($lm, $lang), $result);
}

function date_tl($date, string $lang) {
    if (empty($date) || $date == '') {
        return _('Unknown');
    }
    $tmp = preg_replace('/-/', '/', $date);
    $tmp = preg_split('/\//', $tmp);
    $day = str_pad($tmp[2], 2, '0', STR_PAD_LEFT);
    $month = str_pad($tmp[1], 2, '0', STR_PAD_LEFT);
    $year = $tmp[0];
    if ($lang == 'raw') { // raw YMD; used for sorting
        return $year . $month . $day;
    } else if ($lang == 'en_US') {
        return $month . '/' . $day . '/' . $year;
    } else if ($lang == 'ja_JP' || $lang == 'zh_CN') {
        return $year . '年' . $month . '月' . $day . '日';
    } else if ($lang == 'ru_RU' || $lang == 'de_DE') {
        return $day . '.' . $month . '.' . $year;
    } else { // en_GB || es_ES
        return $day . '/' . $month . '/' . $year;
    }
}

function get_status($thresholds, $score, $game, $diff, $shot = '') {
    if ($diff == 'Extra') {
        $game .= 'ex';
    }
    $statuses = ['Big', 'Bigger', 'Super Big'];
    if ($game === 'MS' && in_array($shot, $thresholds->{$game . 'lowshots'})) {
        for ($key = 2; $key >= 0; $key--) {
            if ($score > $thresholds->{$game . 'low'}[$key]) {
                return $statuses[$key];
            }
        }
        return false;
    }
    for ($key = 2; $key >= 0; $key--) {
        if ($score > $thresholds->{$game}[$key]) {
            return $statuses[$key];
        }
    }
    return false;
}
?>
<div id='wrap' class='wrap'>
    <?php
        echo wrap_top();
        if (!empty($_SESSION['subpage'])) {
            $subpage = $_SESSION['subpage'];
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
            }
            echo '<aside id="back"><a href="/pc98">&lt;= Back to Main Page</a></aside>';
        }
        else {
            $subpage = '';
        }
        if (!empty($_GET['redirect'])) {
            echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
        }
        $game_names = [
            'Touhou 1 - The Highly Responsive to Prayers',
            'Touhou 2 - The Story of Eastern Wonderland',
            'Touhou 2 - The Story of Eastern Wonderland',
            'Touhou 3 - Phantasmagoria of Dim.Dream',
            'Touhou 4 - Lotus Land Story',
            'Touhou 4 - Lotus Land Story',
            'Touhou 5 - Mystic Square',
            'Touhou 5 - Mystic Square'
        ];
        $game_codes = ['HRtP', 'SoEW', 'SoEW', 'PoDD', 'LLS', 'LLS', 'MS', 'MS'];
        $subpages = ['th01', 'th02', 'th02ex', 'th03', 'th04', 'th04ex', 'th05', 'th05ex'];
        $subpages_alt = ['hrtp', 'soew', 'soewex', 'podd', 'lls', 'llsex', 'ms', 'msex'];
        if ($subpage == 'info') {
            include_once 'php/subpages/pc98/info.php';
        }
        else if (in_array($subpage, $subpages)) {
            $full_name = $game_names[array_search($subpage, $subpages)];
            $game = $game_codes[array_search($subpage, $subpages)];
            $diff = strpos($subpage, 'ex') !== false ? 'Extra' : 'Lunatic';
            include_once 'php/subpages/pc98/board.php';
        }
        else if (in_array($subpage, $subpages_alt)) {
            $full_name = $game_names[array_search($subpage, $subpages_alt)];
            $game = $game_codes[array_search($subpage, $subpages_alt)];
            $diff = strpos($subpage, 'ex') !== false ? 'Extra' : 'Lunatic';
            include_once 'php/subpages/pc98/board.php';
        }
        else if (empty($subpage)) {
            include_once 'php/subpages/pc98/main_page.php';
        }
        else {
            echo '<p>No such page.</p>';
        }
    ?>
</div>
