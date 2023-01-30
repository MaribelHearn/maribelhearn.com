<?php
include_once 'assets/shared/http.php';
$id = 0;
if (file_exists('assets/shared/json/wrlist.json')) {
    $wrlist_json = file_get_contents('assets/shared/json/wrlist.json');
} else {
    $wrlist_json = curl_get('https://maribelhearn.com/assets/shared/json/wrlist.json');
    if ($wrlist_json === false) {
        die('Download failed!');
    }
}
$rubrics_json = file_get_contents('assets/shared/json/rubrics.json');
$WRs = json_decode($wrlist_json, true);
$Rubrics = json_decode($rubrics_json, true);

function manoku(string $str, int $len, int $offset, string $lang) {
    if ($str[$len-$offset] != '0') {
        $str = substr($str, 0, $len-$offset) . '.' . substr($str, $len-$offset, $len-1);
        $len += 1;
    }
    for ($i = 0; $i < $offset; $i++) {
        if (strrpos($str, '0') == $len - 1) {
            $str = substr($str, 0, $len - 1);
            $len -= 1;
        }
    }
    $char = ($lang == 'ja_JP' ? '億' : '亿');
    return $str . ($offset == 4 ? '万' : $char);
}

function illion(string $str, int $len, int $offset, string $lang) {
    if ($str[$len-$offset] != '0') {
        $str = substr($str, 0, $len-$offset) . '.' . substr($str, $len-$offset, $len-1);
        $len += 1;
    }
    for ($i = 0; $i < $offset; $i++) {
        if (strrpos($str, '0') == $len - 1) {
            $str = substr($str, 0, $len - 1);
            $len -= 1;
        }
    }
    return $str . ($offset == 6 ? 'm' : 'b');
}

function sep(int $num) {
    return number_format($num, 0, '.', ',');
}

function abbreviate(int $num, string $lang) {
    $str = strval($num);
    if ($lang == 'ja_JP' || $lang == 'zh_CN') {
        if (!strpos($str, '0') || strlen($str) <= 4) {
            return sep($str);
        } else {
            $offset = strlen($str) <= 8 ? 4 : 8;
            return manoku($str, strlen($str), $offset, $lang);
        }
    } else {
        if (strlen($str) <= 6) {
            return sep($str);
        } else {
            $offset = strlen($str) <= 9 ? 6 : 9;
            return illion($str, strlen($str), $offset, $lang);
        }
    }
}

function is_phantasmagoria(string $game) {
    return $game == 'PoDD' || $game == 'PoFV';
}
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p id='drcIntro'><?php
		echo _('The <strong>Dodging Rain Competition (DRC)</strong> is a Touhou game competition that was devised by ' .
		'<a href="https://www.youtube.com/user/mariomaster657">ZM</a> and is held on <a href="https://discord.gg/Ucae3Uf">' .
		'the official DRC Discord</a>. Two teams go up against each other in several different categories. ' .
		'Each player posts an arbitrarily long list of categories, ordered by preference, which can be either survival ' .
		'or scoring of any Touhou shooting game and any difficulty. They will be matched up against a player from ' .
		'the other team, in a category that both players had on their list. ' .
		'The teams and categories are determined by the DRC management team. ' .
		'Players are given two weeks to sign up for the competition, and once it starts, ' .
		'two weeks to submit a replay, which will be awarded points dependent on the rubrics. ' .
		'Runs done outside those two weeks are invalid. ' .
		'Players can submit an unlimited number of replays; the replay that is worth the most DRC points will count.');
	?></p>
    <p id='drcIntroPts'><?php
		echo _('If you want to know how many DRC points a run is worth, ' .
		'the points for a given run can be determined using the calculator below.');
	?></p>
    <p id='countdown'></p>
    <h2 id='pointsCalculator'><?php echo _('Points Calculator') ?></h2>
	<noscript><?php echo _('<em>Sorry, you cannot calculate DRC points with JavaScript disabled.</em>') ?></noscript>
	<div id='calculator'>
        <p id='drcScores'><?php echo _('Scores can only contain digits, commas, dots and spaces. Survival runs are assumed to have cleared, scoring runs not.') ?></p>
        <p id='notify'></p>
		<section>
			<label id='category' for='game'><?php echo _('Category') ?></label>
			<select id='game'>
				<option id='hrtp' value='HRtP'><?php echo _('HRtP') ?></option>
				<option id='soew' value='SoEW'><?php echo _('SoEW') ?></option>
				<option id='podd' value='PoDD'><?php echo _('PoDD') ?></option>
				<option id='lls' value='LLS'><?php echo _('LLS') ?></option>
				<option id='ms' value='MS'><?php echo _('MS') ?></option>
				<option id='eosd' value='EoSD'><?php echo _('EoSD') ?></option>
				<option id='pcb' value='PCB'><?php echo _('PCB') ?></option>
				<option id='in' value='IN'><?php echo _('IN') ?></option>
				<option id='pofv' value='PoFV'><?php echo _('PoFV') ?></option>
				<option id='mof' value='MoF'><?php echo _('MoF') ?></option>
				<option id='sa' value='SA'><?php echo _('SA') ?></option>
				<option id='ufo' value='UFO'><?php echo _('UFO') ?></option>
				<option id='ds' value='DS'><?php echo _('DS') ?></option>
				<option id='gfw' value='GFW'><?php echo _('GFW') ?></option>
				<option id='td' value='TD'><?php echo _('TD') ?></option>
				<option id='ddc' value='DDC'><?php echo _('DDC') ?></option>
				<option id='lolk' value='LoLK'><?php echo _('LoLK') ?></option>
				<option id='hsifs' value='HSiFS'><?php echo _('HSiFS') ?></option>
				<option id='wbawc' value='WBaWC'><?php echo _('WBaWC') ?></option>
				<option id='um' value='UM'><?php echo _('UM') ?></option>
			</select>
			<select id='difficulty'>
				<option>Easy</option>
				<option>Normal</option>
				<option>Hard</option>
				<option>Lunatic</option>
				<option>Extra</option>
			</select>
			<select id='route'>
				<option id='finala' value='FinalA'><?php echo _('FinalA') ?></option>
				<option id='finalb' value='FinalB'><?php echo _('FinalB') ?></option>
			</select>
			<select id='challenge'>
				<option id='scoring0' value='Scoring'><?php echo _('Scoring') ?></option>
				<option id='survival0' value='Survival'><?php echo _('Survival') ?></option>
			</select>
			<div id='performance'></div>
			<label id='shottype_label' for='shottype'></label>
			<select id='shottype'></select>
			<select id='season'>
				<option id='spring' value='Spring'><?php echo _('Spring') ?></option>
				<option id='summer' value='Summer'><?php echo _('Summer') ?></option>
				<option id='autumn' value='Autumn'><?php echo _('Autumn') ?></option>
				<option id='winter' value='Winter'><?php echo _('Winter') ?></option>
			</select>
		</section>
		<section>
			<div id='drcpoints'></div>
			<div id='error'></div>
		</section>
		<section>
			<input id='calculate' type='button' value='<?php echo _('Calculate') ?>'>
		</section>
	</div>
    <h2 id='rulesText'><?php echo _('Rules') ?></h2>
	<ol>
        <li id='rule1'><?php echo _('No cheating by using external programs or modifying the game FPS.') ?></li>
        <li id='rule2'><?php echo _('Replays are required for Windows game submissions, while for PC-98 a video is accepted.') ?></li>
        <li id='rule3'><?php echo _('All runs must be played using at most default lives and bombs.') ?></li>
    </ol>
    <h2 id='rubricsText'><?php echo _('Rubrics') ?></h2>
    <p id='rubricsExpl'><?php
        echo _('The rubrics are the formulas and fixed values used to calculate the number of DRC points for a run. ' .
        'If you are curious about how your points are being determined, click the button below to expand.');
    ?></p>
	<section>
		<input id='scoring_button' type='button' value='<?php echo _('Show Scoring Rubrics') ?>'>
		<input id='survival_button' type='button' value='<?php echo _('Show Survival Rubrics') ?>'>
	</section>
    <div id='scoring_rubrics' class='rubrics'>
        <p><strong id='scoringNotes'><?php echo _('Scoring Notes') ?></strong></p>
		<ul>
			<li id='WRpage'><?php
				echo _('The World Records are taken from <a href="wr">the WR page</a>.');
			?></li>
            <li id='newWR'><?php
				echo _('If you achieve a new World Record, your points are equal to the maximum ' .
				'number of points; otherwise, the formula applies.');
			?></li>
            <li id='fictionalWR'><?php
				echo _('Some categories use a fictional WR. ' .
				'<a href="#fictionalWRtitle">Click here</a> for the list of them.');
			?></li>
            <li id='WRdefinition'><?php
				echo _('Some categories always use the WR of a specific shottype. ' .
				'<a href="#WRdefinitionTitle">Click here</a> for the list of them.');
			?></li>
            <li id='mofSeparate'><?php
				echo _('MoF uses a separate system. ' .
				'<a href="#mountainOfFaith">Click here</a> for said system.');
			?></li>
            <li id='dsSeparate'><?php
				echo _('DS uses a separate system. ' .
				'<a href="#doubleSpoiler">Click here</a> for said system.');
			?></li>
        </ul>
		<div class='overflow'><table class='nomargin'>
			<thead>
				<tr>
					<td colspan='3'><strong id='scoring1'><?php echo _('Scoring') ?></strong><br>
					<span id='scoreFormula'><?php echo _('||Max * (Score/WR)^Exp||') ?></span></td>
				</tr>
			</thead>
			<tbody id='scoringTable'>
			<?php
				foreach ($Rubrics['SCORE'] as $game => $value) {
					if ($game == 'HRtP') {
						echo '<tr><th id="game0">' . _('Game') .
						'</th><th id="maxPoints0">' . _('Max points') .
						'</th><th id="exp0">' . _('Exponent') . '</th></tr>';
					}
					foreach ($Rubrics['SCORE'][$game] as $diff => $rubric) {
						echo '<tr><th>' . _($game) . (has_space($lang) ? ' ' : '') . $diff .
						'</th><td>' . $rubric['base'] . '</td><td>' . $rubric['exp'] . '</td></tr>';
					}
				}
			?>
			</tbody>
		</table></div>
		<br>
		<p id='fictionalWRtitle'><strong><?php echo _('Fictional WRs') ?></strong></p>
		<p id='fictionalWRdesc'><?php echo _('The categories in the table below use a fictional WR instead of the real one.') ?></p>
		<div class='overflow'><table class='nomargin'>
			<tbody id='fictionalWRtable'>
			<?php
				foreach ($Rubrics['SCORE'] as $game => $value) {
					foreach ($Rubrics['SCORE'][$game] as $diff => $rubric) {
						if (!empty($rubric['wr']) && is_array($rubric['wr'])) {
		                    foreach ($rubric['wr'] as $shot => $score) {
		                        echo '<tr><th>' . _($game) . (has_space($lang) ? ' ' : '') . $diff . ' ' . _($shot) .
								'</th><td>' . abbreviate($score, $lang) . '</td></tr>';
		                    }
		                } else if (!empty($rubric['wr'])) {
		                    echo '<tr><th>' . _($game) . (has_space($lang) ? ' ' : '') . $diff .
							'</th><td>' . abbreviate($rubric['wr'], $lang) . '</td></tr>';
		                }
					}
				}
			?>
			</tbody>
		</table></div>
		<br>
		<p id='WRdefinitionTitle'><strong><?php echo _('\'WR\' definition') ?></strong></p>
		<p id='WRdefinitionDesc'><?php
			echo _('The categories in the table below always use the WR of a specific shottype.');
		?></p>
		<div class='overflow'><table class='nomargin'>
			<tbody id='WRdefinitionTable'>
			<?php
				foreach ($Rubrics['SCORE'] as $game => $value) {
					foreach ($Rubrics['SCORE'][$game] as $diff => $rubric) {
						if (!empty($rubric['basedOn'])) {
			                echo '<tr><th>' . _($game) . (has_space($lang) ? ' ' : '') . $diff .
							'</th><td>' . _($rubric['basedOn']) . '</td></tr>';
			            }
					}
				}
			?>
			</tbody>
		</table></div>
        <br>
        <p id='mountainOfFaith'><strong><?php echo _('MoF Scoring') ?></strong></p>
        <p id='mountainOfFaithDesc'><?php
            echo _('For each difficulty and shottype there are six thresholds, ' .
			'at which you will have set numbers of points respectively. Then, increments are done, ' .
			'dependent on how much higher than the threshold your score is. ' .
			'The maximum is 375 on Easy and 500 on Lunatic.');
        ?></p>
        <div class='overflow'><table class='nomargin'>
            <tbody id='mofTable'>
			<?php
				foreach ($Rubrics['MOF_THRESHOLDS'] as $diff => $value) {
					echo '<tr><th colspan="3">' . $diff . '</th></tr>';
					if ($diff == 'Easy') {
						echo '<tr><td colspan="3">' . _('If score &lt; 1st threshold, then: ||220*(Score/T1)^2||') . '</td></tr>';
					} else if ($diff == 'Lunatic') {
						echo '<tr><td colspan="3">' . _('If score &lt; 2b, then: ||200*(Score/2b)^2||') . '</td></tr>';
					} else if ($diff == 'Extra') {
						echo '<tr><td colspan="3">' . _('If score &lt; 900m, then: ||100*(Score/900m)^2||') . '</td></tr>';
					}
					foreach ($value as $shot => $thresholds) {
						echo '<tr><th colspan="3">' . _($shot) . '</th></tr>';
						echo '<tr><th class="threshold">' . _('Threshold') .
						'</th><th class="basePoints">' . _('Base points') . '</th>' .
						'<th class="increments">' . _('Increments') . '</th></tr>';
						$id += 1;
						for ($i = 0; $i < sizeof($thresholds['base']); $i++) {
							if ($lang == 'zh_CN') {
								echo '<tr><td>' . abbreviate($thresholds['score'][$i], $lang) .
								'</td><td>' . $thresholds['base'][$i] . '</td><td>每' . abbreviate($thresholds['step'][$i], $lang) .
								'增加' . $thresholds['increment'][$i] . '</td></tr>';
							} else if ($lang == 'ja_JP') {
								echo '<tr><td>' . abbreviate($thresholds['score'][$i], $lang) .
								'</td><td>' . $thresholds['base'][$i] . '</td><td>' . abbreviate($thresholds['step'][$i], $lang) .
								'ごとに+' . $thresholds['increment'][$i] . '</td></tr>';
							} else {
								echo '<tr><td>' . abbreviate($thresholds['score'][$i], $lang) .
								'</td><td>' . $thresholds['base'][$i] . '</td><td>+' . $thresholds['increment'][$i] .
								' for every ' . abbreviate($thresholds['step'][$i], $lang) . '</td></tr>';
							}
						}
					}
				}
			?>
			</tbody>
        </table></div>
        <br>
        <p id='doubleSpoiler'><strong><?php echo _('DS Scoring') ?></strong></p>
        <p id='doubleSpoilerDesc'><?php
			echo _('For each scene there are three thresholds, ' .
			'at which you will have set numbers of points points respectively. Then, increments are done, ' .
			'dependent on how much higher than the threshold your score is.');
		?></p>
        <div class='overflow'><table class='nomargin'>
            <tbody id='dsTable'>
			<?php
				echo '<tr><th>' . _('Scene') . '</th><th class="basePoints">' . _('Base points') .
				'</th><th id="increments">' . _('Increments') . '</th>' .
				'<th class="threshold1">' . _('Threshold 1') . '</th>';
				echo '<th class="increments">' . _('Increments') .
				'</th><th class="threshold2">' . _('Threshold 2') . '</th>';
				echo '<th class="increments">' . _('Increments') .
				'</th><th class="threshold3">' . _('Threshold 3') . '</th></tr>';
				foreach ($Rubrics['SCENE_THRESHOLDS'] as $scene => $thresholds) {
			        $n1 = $thresholds[1] * 1000;
			        $n2 = $thresholds[2] * 1000;
			        $n3 = $thresholds[3] * 1000;
			        $step1 = round($n1 / 20);
			        $step2 = round(($n2 - $n1) / 30);
			        $step3 = round(($n3 - $n2) / 30);
			        if ($lang == 'zh_CN') {
			            echo '<tr><td>' . $scene . '</td><td>0</td><td>每' . abbreviate($step1, $lang) .
						'增加1</td><td>' . abbreviate($n1, $lang) . '</td><td>每' . abbreviate($step2, $lang) .
						'增加1</td><td>' . abbreviate($n2, $lang) . '</td><td>每' . abbreviate($step3, $lang) .
						'增加1</td><td>' . abbreviate($n3, $lang) . '</td></tr>';
			        } else if ($lang == 'ja_JP') {
			            echo '<tr><td>' . $scene . '</td><td>0</td><td>' . abbreviate($step1, $lang) .
						'ごとに+1</td><td>' . abbreviate($n1, $lang) . '</td><td>' . abbreviate($step2, $lang) .
						'ごとに+1</td><td>' . abbreviate($n2, $lang) . '</td><td>' . abbreviate($step3, $lang) .
						'ごとに+1</td><td>' . abbreviate($n3, $lang) . '</td></tr>';
			        } else {
			            echo '<tr><td>' . $scene . '</td><td>0</td><td>+1 for every ' . sep($step1) .
						'</td><td>' . sep($n1) . '</td><td>+1 for every ' . sep($step2) . '</td><td>' . sep($n2) .
						'</td><td>+1 for every ' . sep($step3) . '</td><td>' . sep($n3) . '</td></tr>';
			        }
			    }
			?>
			</tbody>
        </table></div>
        <br>
        <footer><strong><a href='#top'><?php echo _('Back to Top') ?></a></strong></footer>
	</div>
	<div id='survival_rubrics' class='rubrics'>
        <p><strong id='survivalNotes'><?php echo _('Survival Notes') ?></strong></p>
		<ul>
            <li id='maingame'>
			<?php
				echo _('For a main game clear, a shottype multiplier is applied to your DRC points, ' .
				'the result of which is again rounded. <a href="#shottypeMultipliers">Click here</a> for the list of them.');
			?></li>
            <li id='phantasmagoriaSeparate'>
			<?php
				echo _('The Phantasmagorias use a separate system. ' .
				'<a href="#phantasmagoria">Click here</a> for said system.');
			?></li>
            <li id='inLS'>
			<?php
				echo _('For IN, you obtain 2 (1 on Easy) additional points for each captured Last Spell, ' .
				'with the exception of Imperishable Shooting, which yields 5 points.');
			?>
			</li>
            <li id='hsifsReleases'>
			<?php
				echo _('For HSiFS, the first release adds 2 to <em>n</em>, ' .
				'and further releases add 0.5, 0.4, 0.3, 0.2, 0.1 to <em>n</em>.');
			?></li>
        </ul>
        <div class='overflow'><table class='nomargin'>
        	<thead>
				<tr>
					<td colspan='6'><strong id='survival1'><?php echo _('Survival') ?></strong><br>
					<span id='survFormula'><?php echo _('||Max * (Base^-n)||') ?></span></td>
				</tr>
			</thead>
        	<tbody id='survivalTable'>
			<?php
				foreach ($Rubrics['SURV'] as $game => $value) {
					if (is_phantasmagoria($game)) {
						continue;
					}
					if ($game == 'HRtP') {
						echo '<tr><th id="game2">' . _('Game') .
						'</th><th id="maxPoints1">' . _('Max points') .
						'</th><th id="base0">' . _('Base') .
						'</th><th id="lostLife">Lost life (n)</th><th id="firstBomb">First bomb (n)</th>' .
						'<th id="further">Further bombs (n)</th></tr>';
					}
					foreach ($value as $diff => $rubric) {
						if ($diff == 'multiplier' || $diff == 'seasonMultiplier') {
							continue;
						}
			        	echo '<tr><th>' . _($game) . (has_space($lang) ? ' ' : '') . $diff . '</th><td>' . $rubric['base'] .
						'</td><td>' . $rubric['exp'] . '</td><td>' . $rubric['miss'] .
						'</td><td>' . $rubric['firstBomb'] . '</td><td>' . $rubric['bomb'] . '</td></tr>';
					}
				}
			?>
			</tbody>
        </table></div>
		<br>
        <p id='phantasmagoria'><strong><?php echo _('PoDD & PoFV Survival') ?></strong></p>
        <p id='phantasmagoriaDesc'><?php
			echo _('In the below formula, MaxLives is equal to 5 for PoDD, 7 for PoFV main game ' .
			'and 8 for PoFV Extra. NoBombBonus is a difficulty-specific No Bomb bonus for PoDD and a No Charge Attacks ' .
			'bonus for PoFV. RoundsLost is equal to how many rounds the player lost.');
		?></p>
        <div class='overflow'><table class='nomargin'>
            <thead><tr><td id='pofvFormula' colspan='4'><?php
				echo _('||Max - ((Max - Min) / MaxLives * RoundsLost)|| + NoBombBonus');
			?></td></tr></thead>
            <tbody id='phantasmagoriaTable'>
			<?php
				foreach ($Rubrics['SURV'] as $game => $value) {
					if (is_phantasmagoria($game)) {
						if ($game == 'PoDD') {
							echo '<tr><th id="game1">' . _('Game') .
							'</th><th id="maxPoints2">' . _('Max points') .
							'</th><th id="minPoints">' . _('Min points') .
							'</th><th id="nbBonus">' . _('No Bomb bonus') . '</th></tr>';
						}
						foreach ($value as $diff => $rubric) {
							if ($diff == 'multiplier' || $diff == 'seasonMultiplier') {
								continue;
							}
				        	echo '<tr><th>' . _($game) . (has_space($lang) ? ' ' : '') . $diff . '</th><td>' . $rubric['base'] .
							'</td><td>' . $rubric['min'] . '</td><td>' . $rubric['noBombBonus'] . '</td></tr>';
						}
					}
				}
			?>
			</tbody>
        </table></div>
        <br>
        <p id='shottypeMultipliers'><strong><?php echo _('Shottype Multipliers') ?></strong></p>
        <p id='shotMultDesc'><?php
			echo _('These are applied to the result of the survival formula for a main game ' .
			'run only; they do <em>not</em> apply for Extra, nor do they apply for HSiFS runs that use releases.' .
			'For all shots not listed here, the shottype multipliers are equal to 1.');
		?></p>
        <div class='overflow'><table class='nomargin'>
            <tbody id='shottypeMultipliersTable'>
			<?php
				foreach ($Rubrics['SURV'] as $game => $value) {
					if ($game == 'HRtP') {
						echo '<tr><th id="multipliedShottype">' . _('Shottype') .
						'</th><th id="multiplier">' . _('Multiplier') . '</th></tr>';
					}
					foreach ($value as $diff => $rubric) {
						if ($diff == 'multiplier' || $diff == 'seasonMultiplier') {
							foreach ($rubric as $shot => $mult) {
								echo '<tr><th>' . _($game) . (has_space($lang) ? ' ' : '') . ($lang == 'ja_JP' ? 'の' : '') .
								_($shot) . '</th><td>' . $mult . '</td></tr>';
							}
						}
					}
				}
			?>
			</tbody>
        </table></div>
        <br>
        <footer><strong><a href='#top'><?php echo _('Back to Top') ?></a></strong></footer>
    </div>
	<input id='shots' type='hidden' value='<?php
		$shots = '{';
		foreach ($WRs as $game => $value) {
			$shots .= '"' . $game . '":[';
			foreach ($WRs[$game]['Easy'] as $shot => $value) {
				$shots .= '"' . $shot . '",';
			}
			$shots = substr($shots, 0, -1) . '],';
		}
		echo substr($shots, 0, -1) . '}';
	?>'>
</div>
