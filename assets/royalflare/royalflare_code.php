<?php
function get_board(string $game) {
    $json = file_get_contents('assets/royalflare/json/' . $game . '.json');
    return json_decode($json, true);
}

function get_shots($game) {
    $json = file_get_contents('assets/json/shots.json');
    $shots = json_decode($json, true);
    if ($game == 'GFW') {
        return Array('A-1', 'A-2', 'B-1', 'B-2', 'C-1', 'C-2');
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
    $tmp = preg_split('/\//', $file)[3];
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

if (!empty($_SESSION['subpage'])) {
    $subpage = $_SESSION['subpage'];
    if (substr($subpage, 0, 2) == 'th') {
        $game = game_to_abbr($subpage);
        $board = get_board($subpage);
        $shots = get_shots($game);
    } else if (strpos($subpage, 'history') !== false) {
        $game = game_to_abbr(preg_split('/\//', $subpage)[1]);
        $shots = get_shots($game);
    }
    if ($subpage == 'search') {
        $player = $_GET['player'];
        $game = $_GET['game'];
        $diff = $_GET['diff'];
        $shot = $_GET['shot'];
        if ($game == 'th095' || $game == 'th125' || $game == 'th143' || $game == 'th165') {
            $diff = '-';
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
