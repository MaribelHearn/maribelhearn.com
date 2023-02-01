<h3>Note that the original Royalflare leaderboard was not separated by season, so neither is this history.</h3>
<div><?php
    foreach ($diffs as $key => $diff) {
        if ($diff == 'Phantasm') {
            continue;
        }
        echo '<ul><li class="diff"><a href="#' . $diff . '">' . $diff . '</a></li>';
        foreach ($shots as $key => $shot) {
            if (substr($shot, -6) != 'Spring' && $diff != 'Extra' || substr($shot, -5) != 'Extra' && $diff == 'Extra') {
                continue;
            }
            $shot = preg_replace('/Spring|Extra/', '', $shot);
            echo '<li><a href="#' . $diff . $shot . '">' . tl_shot($shot, 'Japanese') . ' - ' . $shot . '</a></li>';
        }
        echo '</ul>';
    }
?></div>
<h2 id='Easy'>Easy</h2>
<h3 id='EasyReimu' class='shottype'>霊夢 - Reimu</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td>2017/09/09 11:04<!--<a href='/replays/royalflare/th16/th16_ud0000.rpy'>2017/09/09 11:04</a>--></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>742,842,010</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0026.rpy'>2017/08/26 22:27</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuSummer', $lang) ?></td>
		<td>Andrew</td>
		<td>1,170,241,780</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud014e.rpy'>2017/10/11 00:34</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuSummer', $lang) ?></td>
		<td>HRS</td>
		<td>1,256,520,760</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0180.rpy'>2017/10/31 00:56</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuSummer', $lang) ?></td>
		<td>HRS</td>
		<td>1,303,928,120</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0256.rpy'>2018/02/23 17:52</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuWinter', $lang) ?></td>
		<td>HRS</td>
		<td>1,547,947,340</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud025a.rpy'>2018/02/24 03:14</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuWinter', $lang) ?></td>
		<td>HRS</td>
		<td>1,606,568,110</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud056d.rpy'>2020/09/20 00:50</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuSummer', $lang) ?></td>
		<td>MTR</td>
		<td>1,643,476,450</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud056e.rpy'>2020/09/27 01:04</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuSummer', $lang) ?></td>
		<td>MTR</td>
		<td>1,661,734,710</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud0571.rpy'>2020/10/02 00:26</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('ReimuSummer', $lang) ?></td>
		<td>MTR</td>
		<td>1,762,469,580</td>
	</tr>
    </tbody>
</table>
<h3 id='EasyMarisa' class='shottype'>魔理沙 - Marisa</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0003.rpy'>2017/08/13 18:02</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>435,486,450</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0034.rpy'>2017/08/25 23:47</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSpring', $lang) ?></td>
		<td>もゆみ</td>
		<td>444,974,490</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud008c.rpy'>2017/09/13 16:35</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>453,817,390</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud00dc.rpy'>2017/09/21 14:37</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td>荏苒时光醉平生</td>
		<td>556,251,520</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud00e5.rpy'>2017/09/21 21:17</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,008,818,870</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud00f9.rpy'>2017/09/23 12:27</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,036,325,800</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud00fa.rpy'>2017/09/23 16:08</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,103,521,040</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0135.rpy'>2017/10/03 11:40</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,104,154,040</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud0136.rpy'>2017/10/03 12:16</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,110,002,280</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud0139.rpy'>2017/10/04 00:19</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,145,189,970</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud0140.rpy'>2017/10/07 12:35</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,185,374,020</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud0142.rpy'>2017/10/07 15:49</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,284,350,520</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud017e.rpy'>2017/10/30 00:45</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,306,666,970</td>
	</tr>
	<tr>
		<td>14</td>
		<td><a href='/replays/royalflare/th16/th16_ud0238.rpy'>2018/01/31 00:47</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,411,240,840</td>
	</tr>
	<tr>
		<td>15</td>
		<td><a href='/replays/royalflare/th16/th16_ud0252.rpy'>2018/02/22 17:23</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,429,501,290</td>
	</tr>
	<tr>
		<td>16</td>
		<td><a href='/replays/royalflare/th16/th16_ud0253.rpy'>2018/02/22 21:01</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,538,862,970</td>
	</tr>
	<tr>
		<td>17</td>
		<td><a href='/replays/royalflare/th16/th16_ud0254.rpy'>2018/02/22 23:03</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,566,786,740</td>
	</tr>
	<tr>
		<td>18</td>
		<td><a href='/replays/royalflare/th16/th16_ud0255.rpy'>2018/02/23 16:12</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>1,635,423,470</td>
	</tr>
	<tr>
		<td>19</td>
		<td><a href='/replays/royalflare/th16/th16_ud0504.rpy'>2020/06/01 02:24</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>MTR</td>
		<td>1,648,625,290</td>
	</tr>
	<tr>
		<td>20</td>
		<td><a href='/replays/royalflare/th16/th16_ud05a4.rpy'>2020/12/19 03:35</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td>MTR</td>
		<td>1,811,703,600</td>
	</tr>
    </tbody>
</table>
<h3 id='EasyCirno' class='shottype'>チルノ - Cirno</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0001.rpy'>2017/08/19 23:40</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>575,328,500</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0064.rpy'>2017/08/18 11:30</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td>P.K</td>
		<td>1,156,583,720</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud013a.rpy'>2017/10/05 00:26</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,218,197,910</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0143.rpy'>2017/10/07 18:04</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,274,228,010</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0149.rpy'>2017/10/10 02:18</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,309,471,190</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud014a.rpy'>2017/10/10 18:35</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,323,701,860</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud0157.rpy'>2017/10/14 00:53</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,343,225,060</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0163.rpy'>2017/10/18 02:36</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,401,433,050</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud017c.rpy'>2017/10/29 20:29</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,404,503,830</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud01ee.rpy'>2017/12/24 13:40</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,405,036,830</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud01ef.rpy'>2017/12/24 17:13</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,407,209,260</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud01f0.rpy'>2017/12/24 17:49</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,489,235,230</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud01f1.rpy'>2017/12/24 19:33</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,493,278,460</td>
	</tr>
	<tr>
		<td>14</td>
		<td><a href='/replays/royalflare/th16/th16_ud01f2.rpy'>2017/12/24 21:05</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,551,361,400</td>
	</tr>
	<tr>
		<td>15</td>
		<td><a href='/replays/royalflare/th16/th16_ud01f5.rpy'>2017/12/27 23:48</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,621,412,360</td>
	</tr>
	<tr>
		<td>16</td>
		<td><a href='/replays/royalflare/th16/th16_ud0204.rpy'>2018/01/03 02:21</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,631,091,860</td>
	</tr>
	<tr>
		<td>17</td>
		<td><a href='/replays/royalflare/th16/th16_ud020b.rpy'>2018/01/06 14:34</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,644,244,570</td>
	</tr>
	<tr>
		<td>18</td>
		<td><a href='/replays/royalflare/th16/th16_ud021b.rpy'>2018/01/13 03:27</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,652,355,670</td>
	</tr>
	<tr>
		<td>19</td>
		<td><a href='/replays/royalflare/th16/th16_ud0226.rpy'>2018/01/21 19:52</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,747,028,830</td>
	</tr>
	<tr>
		<td>20</td>
		<td><a href='/replays/royalflare/th16/th16_ud022e.rpy'>2018/01/26 00:16</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,760,772,310</td>
	</tr>
	<tr>
		<td>21</td>
		<td><a href='/replays/royalflare/th16/th16_ud022f.rpy'>2018/01/27 01:39</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,801,031,120</td>
	</tr>
	<tr>
		<td>22</td>
		<td><a href='/replays/royalflare/th16/th16_ud0232.rpy'>2018/01/29 21:24</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,809,259,780</td>
	</tr>
	<tr>
		<td>23</td>
		<td><a href='/replays/royalflare/th16/th16_ud0234.rpy'>2018/01/29 23:05</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,826,352,390</td>
	</tr>
	<tr>
		<td>24</td>
		<td><a href='/replays/royalflare/th16/th16_ud023c.rpy'>2018/01/31 23:42</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,874,133,660</td>
	</tr>
	<tr>
		<td>25</td>
		<td><a href='/replays/royalflare/th16/th16_ud023f.rpy'>2018/02/02 19:19</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,879,739,550</td>
	</tr>
	<tr>
		<td>26</td>
		<td><a href='/replays/royalflare/th16/th16_ud0242.rpy'>2018/02/06 17:36</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,904,247,160</td>
	</tr>
	<tr>
		<td>27</td>
		<td><a href='/replays/royalflare/th16/th16_ud0246.rpy'>2018/02/15 00:47</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>1,952,521,500</td>
	</tr>
	<tr>
		<td>28</td>
		<td><a href='/replays/royalflare/th16/th16_ud02a8.rpy'>2018/03/31 23:17</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>1,983,091,650</td>
	</tr>
    </tbody>
</table>
<h3 id='EasyAya' class='shottype'>文 - Aya</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0002.rpy'>2017/08/18 23:19</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>688,415,280</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud00b6.rpy'>2017/09/17 09:16</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td>AIA</td>
		<td>689,176,370</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud00da.rpy'>2017/09/20 13:02</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,051,115,630</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud00f6.rpy'>2017/09/23 00:36</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,089,491,370</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud00fd.rpy'>2017/09/23 17:51</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,093,027,940</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud010b.rpy'>2017/09/24 14:51</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,100,001,040</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud011b.rpy'>2017/09/26 11:01</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,103,686,530</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0123.rpy'>2017/09/27 11:46</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,194,318,040</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud012c.rpy'>2017/10/01 11:48</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,205,699,540</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud0147.rpy'>2017/10/08 18:38</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,264,001,880</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud0148.rpy'>2017/10/09 01:14</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,316,986,300</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud0158.rpy'>2017/10/14 13:57</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,327,381,880</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud015a.rpy'>2017/10/14 17:53</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,354,207,050</td>
	</tr>
	<tr>
		<td>14</td>
		<td><a href='/replays/royalflare/th16/th16_ud0172.rpy'>2017/10/25 02:27</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,380,043,390</td>
	</tr>
	<tr>
		<td>15</td>
		<td><a href='/replays/royalflare/th16/th16_ud0178.rpy'>2017/10/28 18:26</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,402,318,230</td>
	</tr>
	<tr>
		<td>16</td>
		<td><a href='/replays/royalflare/th16/th16_ud017b.rpy'>2017/10/28 22:59</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,404,189,240</td>
	</tr>
	<tr>
		<td>17</td>
		<td><a href='/replays/royalflare/th16/th16_ud01ff.rpy'>2017/12/31 14:09</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,562,346,680</td>
	</tr>
	<tr>
		<td>18</td>
		<td><a href='/replays/royalflare/th16/th16_ud0200.rpy'>2018/01/01 11:42</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,571,905,320</td>
	</tr>
	<tr>
		<td>19</td>
		<td><a href='/replays/royalflare/th16/th16_ud0202.rpy'>2018/01/01 14:59</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,578,592,000</td>
	</tr>
	<tr>
		<td>20</td>
		<td><a href='/replays/royalflare/th16/th16_ud0203.rpy'>2018/01/01 18:06</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,618,172,850</td>
	</tr>
	<tr>
		<td>21</td>
		<td><a href='/replays/royalflare/th16/th16_ud0236.rpy'>2018/01/30 20:16</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,737,335,930</td>
	</tr>
	<tr>
		<td>22</td>
		<td><a href='/replays/royalflare/th16/th16_ud023b.rpy'>2018/01/31 02:50</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,739,407,020</td>
	</tr>
	<tr>
		<td>23</td>
		<td><a href='/replays/royalflare/th16/th16_ud024f.rpy'>2018/02/21 01:47</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,751,315,340</td>
	</tr>
	<tr>
		<td>24</td>
		<td><a href='/replays/royalflare/th16/th16_ud0250.rpy'>2018/02/21 04:03</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaWinter', $lang) ?></td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>1,824,520,580</td>
	</tr>
	<tr>
		<td>25</td>
		<td><a href='/replays/royalflare/th16/th16_ud06a3.rpy'>2021/08/21 03:07</a></td>
		<td>Easy</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td>MTR</td>
		<td>1,906,732,290</td>
	</tr>
    </tbody>
</table>
<h2 id='Normal'>Normal</h2>
<h3 id='NormalReimu' class='shottype'>霊夢 - Reimu</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0004.rpy'>2017/08/13 20:44</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('ReimuSpring', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>108,408,960</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0042.rpy'>2017/08/22 20:37</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>round</td>
		<td>2,823,683,680</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud01b5.rpy'>2017/11/28 22:01</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>4,167,654,710</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud03c6.rpy'>2019/01/13 13:51</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>4,744,465,610</td>
	</tr>
    </tbody>
</table>
<h3 id='NormalMarisa' class='shottype'>魔理沙 - Marisa</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0006.rpy'>2017/08/13 17:24</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>1,309,272,660</td>
	</tr>
	<tr>
		<td>2</td>
		<td>2017/09/02 11:48<!--<a href='/replays/royalflare/th16/th16_ud002c.rpy'>2017/09/02 11:48</a>--></td>
		<td>Normal</td>
		<td><?php echo tl_shot('MarisaSpring', $lang) ?></td>
		<td>そにつく</td>
		<td>3,510,318,520</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud00ab.rpy'>2017/09/16 10:13</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>4,122,547,800</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud013f.rpy'>2017/10/06 23:03</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>4,601,923,520</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud03c8.rpy'>2019/01/15 21:51</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>5,047,009,430</td>
	</tr>
    </tbody>
</table>
<h3 id='NormalCirno' class='shottype'>チルノ - Cirno</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0005.rpy'>2017/08/15 13:53</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>1,631,672,010</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud003d.rpy'>2017/09/01 00:51</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>2,385,224,210</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0070.rpy'>2017/09/12 22:40</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>P.K</td>
		<td>2,450,411,270</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud00b4.rpy'>2017/09/17 01:18</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>2,665,809,860</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud016c.rpy'>2017/10/23 12:10</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>3,305,191,870</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud0183.rpy'>2017/11/01 23:31</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>3,411,022,550</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud0190.rpy'>2017/11/07 19:44</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>3,462,816,610</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0216.rpy'>2018/01/08 19:24</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>3,977,665,260</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud0219.rpy'>2018/01/10 20:28</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>4,014,445,530</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud0221.rpy'>2018/01/20 00:16</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>4,213,303,280</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud057e.rpy'>2020/10/29 23:51</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>MTR</td>
		<td>4,443,764,340</td>
	</tr>
    </tbody>
</table>
<h3 id='NormalAya' class='shottype'>文 - Aya</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0050.rpy'>2017/09/10 14:59</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td>K.Kano</td>
		<td>352,867,260</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0066.rpy'>2017/09/11 10:11</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td>故乡之星</td>
		<td>585,983,440</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud00d7.rpy'>2017/09/19 23:34</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>3,327,329,020</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud00e4.rpy'>2017/09/21 21:44</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaSpring', $lang) ?></td>
		<td>yuushaou</td>
		<td>3,678,384,480</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0122.rpy'>2017/09/26 20:53</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>4,126,059,020</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud0124.rpy'>2017/09/27 22:04</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>4,404,992,120</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud0152.rpy'>2017/10/12 22:52</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>4,617,112,600</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0164.rpy'>2017/10/18 21:29</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>4,725,348,150</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud0164.rpy'>2017/10/19 01:31</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>4,773,788,450</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud016e.rpy'>2017/10/23 23:01</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>4,842,904,450</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud0185.rpy'>2017/11/02 17:46</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>yuushaou</td>
		<td>5,022,740,050</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud025c.rpy'>2018/02/26 23:34</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>5,158,369,900</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud029d.rpy'>2018/03/28 21:18</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>5,252,741,570</td>
	</tr>
	<tr>
		<td>14</td>
		<td><a href='/replays/royalflare/th16/th16_ud02b0.rpy'>2018/04/04 02:14</a></td>
		<td>Normal</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>5,401,351,030</td>
	</tr>
    </tbody>
</table>
<h2 id='Hard'>Hard</h2>
<h3 id='HardReimu' class='shottype'>霊夢 - Reimu</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0007.rpy'>2017/08/12 17:26</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('ReimuSummer', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>343,604,740</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0008.rpy'>2017/09/08 23:10</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>4,174,367,030</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0265.rpy'>2018/03/05 21:44</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>4,443,708,930</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0416.rpy'>2019/05/01 00:04</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>5,021,124,610</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0644.rpy'>2021/06/05 00:47</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>5,315,569,290</td>
	</tr>
    </tbody>
</table>
<h3 id='HardMarisa' class='shottype'>魔理沙 - Marisa</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud000e.rpy'>2017/08/15 19:43</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>476,820,940</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud000f.rpy'>2017/08/15 18:02</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>3,375,036,970</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0093.rpy'>2017/09/13 23:30</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>4,577,502,200</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud02be.rpy'>2018/04/08 17:14</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>4,757,827,840</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud02ed.rpy'>2018/04/07 23:50</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>5,836,318,000</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud064e.rpy'>2021/06/08 01:56</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>5,869,497,030</td>
	</tr>
    </tbody>
</table>
<h3 id='HardCirno' class='shottype'>チルノ - Cirno</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud000a.rpy'>2017/09/09 11:37</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>523,397,930</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud000b.rpy'>2017/09/06 22:47</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>4,108,881,910</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0402.rpy'>2019/03/31 23:27</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>4,720,045,640</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0640.rpy'>2021/06/04 12:25</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>くどう</td>
		<td>4,876,485,460</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0642.rpy'>2021/06/04 19:25</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>4,986,540,070</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud064a.rpy'>2021/06/06 00:59</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>くどう</td>
		<td>5,164,038,940</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud064b.rpy'>2021/06/06 19:08</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>5,341,649,070</td>
	</tr>
    </tbody>
</table>
<h3 id='HardAya' class='shottype'>文 - Aya</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud000c.rpy'>2017/09/07 22:20</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('AyaSummer', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>487,557,170</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud000d.rpy'>2017/09/04 23:57</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('AyaSpring', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>4,911,472,910</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud03d0.rpy'>2019/02/03 18:22</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>5,520,458,650</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0585.rpy'>2020/11/12 02:52</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>MTR</td>
		<td>6,221,076,070</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0650.rpy'>2021/06/08 23:45</a></td>
		<td>Hard</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>6,346,921,330</td>
	</tr>
    </tbody>
</table>
<h2 id='Lunatic'>Lunatic</h2>
<h3 id='LunaticReimu' class='shottype'>霊夢 - Reimu</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0010.rpy'>2017/09/02 11:54</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuSpring', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>466,353,070</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0012.rpy'>2017/08/19 00:46</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>904,826,820</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0013.rpy'>2017/08/26 13:06</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>985,598,010</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0014.rpy'>2017/09/03 23:08</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>2,393,178,620</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0015.rpy'>2017/08/15 13:14</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>3,598,801,760</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud00ae.rpy'>2017/09/16 21:14</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>4,326,415,840</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud00af.rpy'>2017/09/16 21:34</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>5,490,097,650</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0126.rpy'>2017/09/29 02:20</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>5,665,003,700</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud0173.rpy'>2017/10/26 18:26</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>6,372,028,560</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud0375.rpy'>2018/09/22 21:02</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>6,852,113,150</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud0413.rpy'>2019/04/21 16:51</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>6,927,014,090</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud043f.rpy'>2019/06/11 21:32</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>7,129,495,310</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud044f.rpy'>2019/07/16 23:58</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>7,368,837,880</td>
	</tr>
	<tr>
		<td>14</td>
		<td><a href='/replays/royalflare/th16/th16_ud0563.rpy'>2020/09/01 20:20</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>7,910,891,020</td>
	</tr>
	<tr>
		<td>15</td>
		<td><a href='/replays/royalflare/th16/th16_ud05b7.rpy'>2021/01/14 01:55</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>8,143,136,950</td>
	</tr>
	<tr>
		<td>16</td>
		<td><a href='/replays/royalflare/th16/th16_ud0678.rpy'>2021/07/05 19:54</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('ReimuAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>8,474,682,890</td>
	</tr>
    </tbody>
</table>
<h3 id='LunaticMarisa' class='shottype'>魔理沙 - Marisa</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud001c.rpy'>2017/09/08 23:41</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaSummer', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>570,364,710</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud001d.rpy'>2017/08/29 00:22</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>1,209,681,570</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud001e.rpy'>2017/08/15 19:12</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>3,823,943,740</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0038.rpy'>2017/08/27 14:35</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>えなめる</td>
		<td>4,670,168,330</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0134.rpy'>2017/10/03 02:51</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>6,056,420,460</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud0146.rpy'>2017/10/06 09:44</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>6,325,176,040</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud01f7.rpy'>2017/12/30 12:04</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>桜庭ローラ</td>
		<td>7,540,456,210</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud03f7.rpy'>2019/03/06 22:36</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>8,420,515,800</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud03fc.rpy'>2019/03/16 14:46</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>8,532,659,810</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud05fb.rpy'>2021/03/30 23:25</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>8,742,720,500</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud0610.rpy'>2021/04/02 23:23</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>8,789,361,460</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud06ad.rpy'>2021/08/29 23:15</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('MarisaAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>9,020,146,760</td>
	</tr>
    </tbody>
</table>
<h3 id='LunaticCirno' class='shottype'>チルノ - Cirno</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td>2017/09/09 12:09<!--<a href='/replays/royalflare/th16/th16_ud0017.rpy'>2017/09/09 12:09</a>--></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoSummer', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>665,809,680</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0018.rpy'>2017/08/27 13:35</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>885,220,840</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0019.rpy'>2017/08/14 12:32</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>2,985,114,950</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud003c.rpy'>2017/08/26 21:57</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>3,833,214,650</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud00ca.rpy'>2017/09/17 23:38</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoWinter', $lang) ?></td>
		<td>レックス</td>
		<td>4,460,456,150</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud017d.rpy'>2017/10/29 22:07</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>5,091,997,900</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud01c6.rpy'>2017/12/03 21:24</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>6,761,357,310</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0385.rpy'>2018/10/08 20:16</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>6,886,106,900</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud0557.rpy'>2020/08/19 19:09</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>7,422,483,780</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud0664.rpy'>2021/06/23 03:16</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>みょん吉</td>
		<td>7,449,452,040</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud0666.rpy'>2021/06/23 23:45</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>7,576,379,460</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud066f.rpy'>2021/06/29 23:31</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>7,762,771,710</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud066f.rpy'>2021/07/01 22:49</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>7,894,669,150</td>
	</tr>
	<tr>
		<td>14</td>
		<td><a href='/replays/royalflare/th16/th16_ud0672.rpy'>2021/07/03 03:39</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('CirnoAutumn', $lang) ?></td>
		<td>ひろ♪☆</td>
		<td>8,046,964,950</td>
	</tr>
    </tbody>
</table>
<h3 id='LunaticAya' class='shottype'>文 - Aya</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud001a.rpy'>2017/09/06 23:21</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>1,202,136,210</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud001b.rpy'>2017/09/02 11:07</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>6,010,889,100</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud002d.rpy'>2017/09/06 18:31</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>コレット</td>
		<td>7,116,020,860</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud019b.rpy'>2017/11/12 01:30</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>7,477,932,830</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0235.rpy'>2018/01/30 08:38</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>8,011,951,660</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud023a.rpy'>2018/01/31 02:16</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>あおち</td>
		<td>8,158,881,390</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud034b.rpy'>2018/08/05 10:34</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>8,172,403,170</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud036a.rpy'>2018/09/08 11:27</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>8,291,263,740</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud037b.rpy'>2018/10/02 22:53</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>8,377,262,100</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud03b5.rpy'>2018/12/21 22:45</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>8,629,652,250</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud03bc.rpy'>2018/12/30 00:58</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>8,796,409,900</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud03e6.rpy'>2019/02/17 15:10</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>9,145,566,010</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud0543.rpy'>2020/08/08 00:24</a></td>
		<td>Lunatic</td>
		<td><?php echo tl_shot('AyaAutumn', $lang) ?></td>
		<td>そにつく</td>
		<td>9,605,710,630</td>
	</tr>
    </tbody>
</table>
<h2 id='Extra'>Extra</h2>
<h3 id='ExtraReimu' class='shottype'>霊夢 - Reimu</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud001f.rpy'>2017/08/14 23:07</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>162,253,790</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0024.rpy'>2017/08/19 20:08</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>Epsilon</td>
		<td>172,026,910</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0027.rpy'>2017/08/31 09:03</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>Dide</td>
		<td>1,300,299,930</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud0030.rpy'>2017/09/02 15:13</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>1,752,530,800</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud0058.rpy'>2017/09/06 18:51</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>1,886,728,070</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud0095.rpy'>2017/09/14 13:32</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>yahoobb</td>
		<td>1,888,781,900</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud00a3.rpy'>2017/09/15 14:00</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>yahoobb</td>
		<td>1,956,365,370</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud00a8.rpy'>2017/09/16 01:38</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,000,017,020</td>
	</tr>
	<tr>
		<td>9</td>
		<td><a href='/replays/royalflare/th16/th16_ud00d5.rpy'>2017/09/19 00:03</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,002,756,120</td>
	</tr>
	<tr>
		<td>10</td>
		<td><a href='/replays/royalflare/th16/th16_ud00db.rpy'>2017/09/20 15:48</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>みょん吉</td>
		<td>2,082,596,350</td>
	</tr>
	<tr>
		<td>11</td>
		<td><a href='/replays/royalflare/th16/th16_ud00e8.rpy'>2017/09/22 00:56</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>mys</td>
		<td>2,143,910,400</td>
	</tr>
	<tr>
		<td>12</td>
		<td><a href='/replays/royalflare/th16/th16_ud00ec.rpy'>2017/09/22 13:06</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>yahoobb</td>
		<td>2,148,870,360</td>
	</tr>
	<tr>
		<td>13</td>
		<td><a href='/replays/royalflare/th16/th16_ud00ed.rpy'>2017/09/22 14:06</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,151,847,030</td>
	</tr>
	<tr>
		<td>14</td>
		<td><a href='/replays/royalflare/th16/th16_ud0100.rpy'>2017/09/23 21:26</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>みょん吉</td>
		<td>2,154,881,580</td>
	</tr>
	<tr>
		<td>15</td>
		<td><a href='/replays/royalflare/th16/th16_ud0104.rpy'>2017/09/24 00:41</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,186,457,820</td>
	</tr>
	<tr>
		<td>16</td>
		<td><a href='/replays/royalflare/th16/th16_ud0105.rpy'>2017/09/24 01:50</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,288,262,210</td>
	</tr>
	<tr>
		<td>17</td>
		<td><a href='/replays/royalflare/th16/th16_ud0106.rpy'>2017/09/24 01:48</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>fon</td>
		<td>2,386,016,050</td>
	</tr>
	<tr>
		<td>18</td>
		<td><a href='/replays/royalflare/th16/th16_ud012a.rpy'>2017/09/28 15:18</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>fon</td>
		<td>2,675,949,570</td>
	</tr>
	<tr>
		<td>19</td>
		<td><a href='/replays/royalflare/th16/th16_ud013c.rpy'>2017/10/05 20:01</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>fon</td>
		<td>2,781,361,700</td>
	</tr>
	<tr>
		<td>20</td>
		<td><a href='/replays/royalflare/th16/th16_ud0174.rpy'>2017/10/24 21:52</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>𝖈𝖍𝖎𝖓𝖕𝖔𝖚</td>
		<td>3,252,215,310</td>
	</tr>
	<tr>
		<td>21</td>
		<td><a href='/replays/royalflare/th16/th16_ud02b5.rpy'>2018/04/06 01:07</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>fon</td>
		<td>3,336,378,300</td>
	</tr>
	<tr>
		<td>22</td>
		<td><a href='/replays/royalflare/th16/th16_ud0691.rpy'>2021/07/29 23:17</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Reimu', $lang) ?></td>
		<td>idtn</td>
		<td>3,367,057,690</td>
	</tr>
    </tbody>
</table>
<h3 id='ExtraMarisa' class='shottype'>魔理沙 - Marisa</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0022.rpy'>2017/08/27 13:52</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>159,436,310</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0033.rpy'>2017/09/04 19:46</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>1,602,024,450</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud0059.rpy'>2017/09/05 00:50</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>1,822,368,030</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud00c4.rpy'>2017/09/17 19:27</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,078,531,550</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud02a9.rpy'>2018/04/01 23:46</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>E.G.I.</td>
		<td>2,298,043,270</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud02d7.rpy'>2018/04/26 22:05</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>みょん吉</td>
		<td>2,801,440,080</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud02e1.rpy'>2018/05/02 21:25</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>みょん吉</td>
		<td>3,043,604,540</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0714.rpy'>2021/12/24 18:20</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Marisa', $lang) ?></td>
		<td>idtn</td>
		<td>3,098,507,040</td>
	</tr>
    </tbody>
</table>
<h3 id='ExtraCirno' class='shottype'>チルノ - Cirno</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0020.rpy'>2017/09/07 23:43</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>158,655,060</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0032.rpy'>2017/09/03 23:33</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>1,778,907,540</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud005b.rpy'>2017/09/10 21:53</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,056,085,430</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud00e3.rpy'>2017/09/21 20:16</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>みょん吉</td>
		<td>2,056,373,080</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud00ee.rpy'>2017/09/22 14:34</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,267,459,510</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud0151.rpy'>2017/10/01 17:57</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>みょん吉</td>
		<td>2,327,865,890</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud0257.rpy'>2018/02/19 17:18</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>fon</td>
		<td>3,185,889,870</td>
	</tr>
	<tr>
		<td>8</td>
		<td><a href='/replays/royalflare/th16/th16_ud0269.rpy'>2018/03/06 14:13</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Cirno', $lang) ?></td>
		<td>fon</td>
		<td>3,319,395,440</td>
	</tr>
    </tbody>
</table>
<h3 id='ExtraAya' class='shottype'>文 - Aya</h3>
<table class='HSiFSt'>
    <tbody class='ranking'>
        <tr>
    		<th>#</th>
    		<th>プレイ日付<br>Play Date</th>
    		<th>難易度<br>Difficulty</th>
    		<th>使用キャラ<br>Shottype</th>
    		<th>名前<br>Player</th>
    		<th>スコア<br>Score</th>
    	</tr>
	<tr>
		<td>1</td>
		<td><a href='/replays/royalflare/th16/th16_ud0021.rpy'>2017/09/09 12:55</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>Ｋ・Ｇ</td>
		<td>146,459,800</td>
	</tr>
	<tr>
		<td>2</td>
		<td><a href='/replays/royalflare/th16/th16_ud0031.rpy'>2017/09/03 00:46</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>1,754,820,410</td>
	</tr>
	<tr>
		<td>3</td>
		<td><a href='/replays/royalflare/th16/th16_ud005a.rpy'>2017/09/07 15:03</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,015,678,680</td>
	</tr>
	<tr>
		<td>4</td>
		<td><a href='/replays/royalflare/th16/th16_ud00fe.rpy'>2017/09/23 18:32</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>GmbRuby!</td>
		<td>2,208,042,510</td>
	</tr>
	<tr>
		<td>5</td>
		<td><a href='/replays/royalflare/th16/th16_ud02aa.rpy'>2018/04/02 14:19</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>E.G.I.</td>
		<td>2,362,267,770</td>
	</tr>
	<tr>
		<td>6</td>
		<td><a href='/replays/royalflare/th16/th16_ud02d8.rpy'>2018/04/27 20:27</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>みょん吉</td>
		<td>2,767,572,900</td>
	</tr>
	<tr>
		<td>7</td>
		<td><a href='/replays/royalflare/th16/th16_ud02db.rpy'>2018/04/29 01:27</a></td>
		<td>Extra</td>
		<td><?php echo tl_shot('Aya', $lang) ?></td>
		<td>みょん吉</td>
		<td>3,031,118,600</td>
	</tr>
    </tbody>
</table>
