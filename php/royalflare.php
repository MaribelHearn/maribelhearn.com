<?php
function get_board(string $game) {
    $json = file_get_contents('assets/games/royalflare/json/' . $game . '.json');
    return json_decode($json, true);
}

function get_shots($game) {
    $json = file_get_contents('assets/shared/json/shots.json');
    $shots = json_decode($json, true);
    if ($game == 'StB') {
        return Array('Aya');
    } else if ($game == 'DS') {
        return Array('Aya', 'Hatate');
    } else if ($game == 'GFW') {
        return Array('A-1', 'A-2', 'B-1', 'B-2', 'C-1', 'C-2');
    } else if ($game == 'ISC') {
        return Array('Seija');
    } else if ($game == 'VD') {
        return Array('Sumireko');
    }
    return $shots[$game]['chars'];
}

function game_to_abbr(string $game) {
    switch ($game) {
        case 'th06': return 'EoSD';
        case 'th07': return 'PCB';
        case 'th08': return 'IN';
        case 'th095': return 'StB';
        case 'th10': return 'MoF';
        case 'th11': return 'SA';
        case 'th12': return 'UFO';
        case 'th125': return 'DS';
        case 'th128': return 'GFW';
        case 'th13': return 'TD';
        case 'th14': return 'DDC';
        case 'th143': return 'ISC';
        case 'th15': return 'LoLK';
        case 'th16': return 'HSiFS';
        case 'th165': return 'VD';
        case 'th17': return 'WBaWC';
        case 'th18': return 'UM';
        default: return '';
    }
}

function format_subpage(string $subpage) {
    if (strpos($subpage, '/') !== false) {
        $tmp = preg_split('/\//', $subpage);
        return ucfirst($tmp[0]) . ' - ' . (game_to_abbr($tmp[1]) ? strtoupper($tmp[1]) : $tmp[1]);
    }
    switch ($subpage) {
        case 'search': return 'Search Results';
        case 'alcostg': return 'Uwabami Breakers';
        case 'hellsinker': return 'Hellsinker';
        default: return strtoupper($subpage);
    }
}

function format_stage(string $game, int $stage) {
    if ($game == 'StB' && $stage == 11) {
        return 'EX';
    } else if ($game == 'DS') {
        if ($stage == 13) {
            return 'EX';
        } else if ($stage == 14) {
            return 'SP';
        }
    } else if ($game == 'VD') {
        switch ($stage) {
            case 1: return 'Sunday';
            case 2: return 'Monday';
            case 3: return 'Tuesday';
            case 4: return 'Wednesday';
            case 5: return 'Thursday';
            case 6: return 'Friday';
            case 7: return 'Saturday';
            case 8: return 'Wrong Sunday';
            case 9: return 'Wrong Monday';
            case 10: return 'Wrong Tuesday';
            case 11: return 'Wrong Wednesday';
            case 12: return 'Wrong Thursday';
            case 13: return 'Wrong Friday';
            case 14: return 'Wrong Saturday';
            case 15: return 'Nightmare Sunday';
            case 16: return 'Nightmare Monday';
            case 17: return 'Nightmare Tuesday';
            case 18: return 'Nightmare Wednesday';
            case 19: return 'Nightmare Thursday';
            case 20: return 'Nightmare Friday';
            case 21: return 'Nightmare Saturday';
            default: return 'Nightmare Diary';
        }
    }
    return $stage;
}

function format_title(string $game) {
    if ($game == 'VD') {
        return '';
    } else if ($game == 'ISC') {
        return 'Day ';
    }
    return 'Stage ';
}

function format_game(string $file) {
    $tmp = preg_split('/\//', $file)[4];
    return preg_split('/\./', $tmp)[0];
}

function links(string $game, array $diffs, array $shots) {
    echo '<div>';
    foreach ($diffs as $key => $diff) {
        if ($game != 'PCB' && $diff == 'Phantasm') {
            break;
        }
        echo '<ul><li class="diff"><a href="#' . $diff . '">' . $diff . '</a></li>';
        if ($game != 'GFW' || $diff != 'Extra') {
            foreach ($shots as $key => $shot) {
                echo '<li><a href="#' . $diff . $shot . '">' . (tl_shot(str_replace(' ', '', $shot), 'Japanese') != $shot ? tl_shot(str_replace(' ', '', $shot), 'Japanese') . ' - ' : '') . $shot . '</a></li>';
            }
        }
        echo '</ul>';
    }
    echo '</div>';
}

function check_slowdown(string $game, string $sd) {
    $sd = (int) preg_split('/\./', $sd)[0];
    if ($game == 'EoSD' || $game == 'PCB' || $game == 'IN' || $game == 'WBaWC' || $game == 'UM') {
        return $sd > 2;
    } else if ($game == 'StB' || $game == 'DS' || $game == 'ISC' || $game == 'VD') {
        return $sd > 3;
    } else {
        return $sd > 1;
    }
}


function tl_shot(string $shot, string $lang) {
    if ($lang == 'ja_JP' || $lang == 'Japanese') {
        switch ($shot) {
            case 'Makai': return '魔界';
            case 'Jigoku': return '地獄';
            case 'ReimuA': return '霊夢A';
            case 'ReimuB': return '霊夢B';
            case 'ReimuC': return '霊夢C';
            case 'Reimu': return '霊夢';
            case 'Mima': return '魅魔';
            case 'Marisa': return '魔理沙';
            case 'Ellen': return 'エレン';
            case 'Kotohime': return '小兎姫';
            case 'Kana': return 'カナ';
            case 'Rikako': return '理香子';
            case 'Chiyuri': return 'ちゆり';
            case 'Yumemi': return '夢美';
            case 'Yuuka': return '幽香';
            case 'MarisaA': return '魔理沙A';
            case 'MarisaB': return '魔理沙B';
            case 'SakuyaA': return '咲夜A';
            case 'SakuyaB': return '咲夜B';
            case 'BorderTeam': return '霊夢＆紫';
            case 'MagicTeam': return '魔理沙＆アリス';
            case 'ScarletTeam': return '咲夜＆レミリア';
            case 'GhostTeam': return '妖夢＆幽々子';
            case 'Yukari': return '紫';
            case 'Alice': return 'アリス';
            case 'Sakuya': return '咲夜';
            case 'Remilia': return 'レミリア';
            case 'Youmu': return '妖夢';
            case 'Yuyuko': return '幽々子';
            case 'Reisen': return '鈴仙';
            case 'Cirno': return 'チルノ';
            case 'Lyrica': return 'リリカ';
            case 'Mystia': return 'ミスティア';
            case 'Tewi': return 'てゐ';
            case 'Aya': return '文';
            case 'Medicine': return 'メディスン';
            case 'Komachi': return '小町';
            case 'Eiki': return '映姫';
            case 'Hatate': return 'はたて';
            case 'MarisaC': return '魔理沙C';
            case 'SanaeA': return '早苗A';
            case 'SanaeB': return '早苗B';
            case 'Sanae': return '早苗';
            case 'Spring': return '春';
            case 'Summer': return '夏';
            case 'Autumn': return '秋';
            case 'Winter': return '冬';
            case 'ReimuSpring': return '霊夢(春)';
            case 'CirnoSpring': return 'チルノ(春)';
            case 'AyaSpring': return '文(春)';
            case 'MarisaSpring': return '魔理沙(春)';
            case 'ReimuSummer': return '霊夢(夏)';
            case 'CirnoSummer': return 'チルノ(夏)';
            case 'AyaSummer': return '文(夏)';
            case 'MarisaSummer': return '魔理沙(夏)';
            case 'ReimuAutumn': return '霊夢(秋)';
            case 'CirnoAutumn': return 'チルノ(秋)';
            case 'AyaAutumn': return '文(秋)';
            case 'MarisaAutumn': return '魔理沙(秋)';
            case 'ReimuWinter': return '霊夢(冬)';
            case 'CirnoWinter': return 'チルノ(冬)';
            case 'AyaWinter': return '文(冬)';
            case 'MarisaWinter': return '魔理沙(冬)';
            case 'ReimuWolf': return '霊夢W';
            case 'ReimuOtter': return '霊夢O';
            case 'ReimuEagle': return '霊夢E';
            case 'MarisaWolf': return '魔理沙W';
            case 'MarisaOtter': return '魔理沙O';
            case 'MarisaEagle': return '魔理沙E';
            case 'YoumuWolf': return '妖夢W';
            case 'YoumuOtter': return '妖夢O';
            case 'YoumuEagle': return '妖夢E';
            default: return $shot;
        }
    }
    return str_replace('Team', ' Team', $shot);
}


function tl_term(string $term, string $lang) {
    if ($lang == 'Japanese' || $lang == 'ja_JP') {
        $term = trim($term);
        switch ($term) {
            case 'Shottype': return 'キャラ';
            case 'Route': return 'ルート';
            case 'FinalA': return 'Aルート';
            case 'FinalB': return 'Bルート';
            default: return $term;
        }
    } else {
        return $term;
    }
}

if (!empty($_SESSION['subpage'])) {
    $subpage = $_SESSION['subpage'];
    if (file_exists('assets/games/royalflare/json/' . $subpage . '.json')) {
        if ($subpage == 'th08a') {
            $subpage = 'th08';
        }
        $game = game_to_abbr($subpage);
        $board = get_board($subpage);
        $shots = get_shots($game);
    } else if (strpos($subpage, 'history') !== false && strpos($subpage, '/') !== false) {
        $game = game_to_abbr(preg_split('/\//', $subpage)[1]);
        $shots = get_shots($game);
    }
    if ($subpage == 'search') {
        $player = (isset($_GET['player']) ? preg_replace('/</', '&lt;', preg_replace('/>/', '&gt;', $_GET['player'])) : '');
        $game = (isset($_GET['game']) ? preg_replace('/</', '&lt;', preg_replace('/>/', '&gt;', $_GET['game'])) : '-');
        $diff = (isset($_GET['diff']) ? preg_replace('/</', '&lt;', preg_replace('/>/', '&gt;', $_GET['diff'])) : '-');
        $shot = (isset($_GET['shot']) ? preg_replace('/</', '&lt;', preg_replace('/>/', '&gt;', $_GET['shot'])) : '');
        $comment = (isset($_GET['comment']) ? preg_replace('/</', '&lt;', preg_replace('/>/', '&gt;', $_GET['comment'])) : '');
        if ($game == 'th095' || $game == 'th125' || $game == 'th143' || $game == 'th165') {
            $diff = '-';
        }
        if ($game != 'th07' && $diff == 'Phantasm') {
            $diff = 'Extra';
        }
    }
} else {
    $subpage = '';
}

$exists = true;
$stages = (object) array();
$scenes = (object) array();
$stages->StB = Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
$stages->DS = Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);
$stages->ISC = Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$stages->VD = Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22);
$scenes->StB = Array(6, 6, 8, 9, 8, 8, 8, 8, 8, 8, 8);
$scenes->DS = Array(6, 6, 8, 7, 8, 8, 7, 8, 8, 8, 8, 8, 9, 9);
$scenes->ISC = Array(6, 6, 7, 7, 8, 8, 8, 7, 8, 10);
$scenes->VD = Array(2, 4, 3, 4, 3, 3, 1, 7, 4, 4, 6, 5, 5, 6, 6, 6, 6, 6, 6, 6, 6, 4);
$games = Array('EoSD', 'PCB', 'IN', 'StB', 'MoF', 'SA', 'UFO', 'DS', 'GFW', 'TD', 'DDC', 'ISC', 'LoLK', 'HSiFS', 'VD', 'WBaWC', 'UM');
$diffs = Array('Easy', 'Normal', 'Hard', 'Lunatic', 'Extra', 'Phantasm');
?>
<div id='wrap' class='wrap'>
    <?php
        echo wrap_top();
        if (!empty($subpage)) {
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
                if (($tmp[0] == 'history' || $tmp[0] == 'standings') && !empty(game_to_abbr($tmp[1]))) {
                    echo '<aside id="back"><a href="/royalflare/' . $tmp[1] . '">&lt;= ' . $tmp[1] . 'に帰る - Back to ' . $tmp[1] . '</a></aside>';
                } else {
                    echo '<aside id="back"><a href="/royalflare">&lt;= メインページに帰る - Back to Main Page</a></aside>';
                }
            } else {
                echo '<aside id="back"><a href="/royalflare">&lt;= メインページに帰る - Back to Main Page</a></aside>';
            }
        }
    ?>
    <h1>Royalflare Archive<?php if (!empty($subpage)) { echo ' - ' . format_subpage($subpage); } ?></h1>
	<?php
		if (!empty($_GET['redirect'])) {
			echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
		}
        if (!empty($subpage)) {
            if (strpos($subpage, '/') !== false) {
                $tmp = preg_split('/\//', $subpage);
                if (($tmp[0] == 'history' || $tmp[0] == 'standings') && !empty(game_to_abbr($tmp[1]))) {
                    include_once 'php/subpages/royalflare/' . $tmp[0] . '/' . $tmp[1] . '.' . ($tmp[0] == 'standings' ? 'html' : 'php');
                    echo '<footer><strong><a href="/royalflare/' . $tmp[1] . '">' . $tmp[1] . 'に帰る - Back to ' . $tmp[1] . '</a></strong></footer>';
                } else {
                    $exists = false;
                    echo '<p class="center">No such page.</p>';
                }
            } else {
                if ($subpage == 'search') {
                    include_once 'php/subpages/royalflare/search.php';
                } else if ($subpage == 'th08a') {
                    include_once 'php/subpages/royalflare/board.php';
                } else if ($subpage == 'th16') {
                    include_once 'php/subpages/royalflare/board_th16.php';
                } else if ($subpage == 'th125') {
                    include_once 'php/subpages/royalflare/board_th125.php';
                } else if ($subpage == 'th095' || $subpage == 'th125' || $subpage == 'th143' || $subpage == 'th165') {
                    include_once 'php/subpages/royalflare/board_scene.php';
                } else {
                    if (!empty(game_to_abbr($subpage))) {
                        include_once 'php/subpages/royalflare/board.php';
                    } else if (file_exists('php/subpages/royalflare/' . $subpage . '.php')) {
                        include_once 'php/subpages/royalflare/' . $subpage . '.php';
                    } else {
                        $exists = false;
                        echo '<p class="center">No such page.</p>';
                    }
                }
            }
            if ($exists && strpos($subpage, 'standings') === false) {
                echo '<footer><strong><a href="#top">上に帰る - Back to Top</a></strong></footer>';
            }
        } else {
            include_once 'php/subpages/royalflare/main_page.php';
        }
	?>
</div>
