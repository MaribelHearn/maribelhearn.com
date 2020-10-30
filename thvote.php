<!DOCTYPE html>
<html id='top' lang='en'>
<?php
	include 'assets/shared/shared.php';
	hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

    <head>
        <title>THWiki Popularity Poll 2020 Results</title>
        <meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <meta name='description' content='Complete English translation of the full results of the THWiki Popularity Poll.'>
        <meta name='keywords' content='touhou, touhou project, thwiki, popularity, poll, vote, contest, thpoll, thvote'>
		<link rel='stylesheet' type='text/css' href='assets/thvote/thvote.css'>
		<link rel='icon' type='image/x-icon' href='assets/thvote/thvote.ico'>
        <script src='assets/shared/sorttable.js' defer></script>
        <?php echo dark_theme() ?>
    </head>

    <body class='<?php echo check_webp() ?>'>
		<nav>
			<div id='nav' class='wrap'><?php echo navbar($page) ?></div>
		</nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack' class='noborders'>This background image<br id='ack_br'>
                was drawn by <a href='https://www.pixiv.net/member.php?id=2025430'>Yakumo_Stocking</a></p>
                <span id='hy_container'><img id='hy' src='../assets/shared/icon_sheet.png' alt='Human-youkai gauge'>
		            <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
		        </span>
                <h1>THWiki Popularity Poll 2020 Results</h1>
                <?php
                    if (!empty($_GET['redirect'])) {
                        echo '<p>(Redirected from <em>' . htmlentities($_GET['redirect']) . '</em>)</p>';
                    }
                ?>
                <p>An English translation of the full results of the 2020 incarnation of the annual THWiki Popularity Poll.</p>
                <!--<p>Confusingly, "preliminary" simply means the full results without the questionnaire results.
                It does <strong>not</strong> mean the results are not final. The number of votes for the characters,
                music and works will <strong>not</strong> change when the full results are published.</p>-->
                <p>All of the table columns for which sorting makes sense are sortable.</p>
                <p>Source: <a href='http://toho-vote.info/'>http://toho-vote.info/</a></p>
                <h2>Contents</h2>
                <div id='contents' class='border'>
                    <p><a href='#characters'>Characters</a></p>
                    <p><a href='#music'>Music</a></p>
                    <p><a href='#works'>Works</a></p>
                    <p><a href='#questionnaire'>Questionnaire</a></p>
                </div>
                <h2>Valid responses</h2>
                <div id='responses' class='border'>
                    <p>Characters: 34,573 <small>(in 2019: 23,883; in 2018: 32,062)</small></p>
                    <p>Music: 25,919 <small>(in 2019: 17,951; in 2018: 23,648)</small></p>
                    <p>Works: 19,274 <small>(in 2019: 13,946; in 2018: 18,470)</small></p>
                </div>
                <h1 id='characters'>Characters</h1>
                <div id='chars_dummy' class='dummy'><div class='dummy_sub'></div></div>
                <div id='chars_container' class='container'>
                    <table id='chars_table' class='poll table sortable'>
                        <colgroup>
                            <!--<col class="col1">-->
                            <col class="col2game">
                            <col class="col3game">
                            <col class="col4game">
                            <col class="col5">
                            <col class="col6per">
                            <col class="col7per">
                            <col class="col8per">
                            <col class="col5 w55">
                        </colgroup>
                        <thead>
                            <tr>
                                <!--<th id='chars_head' class='head noborders sorttable_numeric'>#</th>-->
                                <th class='sorttable_numeric'>Rank</th>
                                <th class='sorttable_numeric'>2019 rank</th>
                                <th class='sorttable_numeric'>2018 rank</th>
                                <th>Name</th>
                                <th class='sorttable_numeric'>Points</th>
                                <th class='sorttable_numeric'>No. 1 Votes</th>
                                <th class='sorttable_numeric'>Comments</th>
                                <th class='sorttable_numeric'>Supportive fanworks submitted</th>
                            </tr>
                        </thead>
                        <tbody>
<tr><td>1</td><td>3</td><td>4</td><td class="left">Youmu Konpaku</td><td>9,841</td><td>2,290</td><td>1,360</td><td>35</td></tr>
<tr><td>2</td><td>1</td><td>1</td><td class="left">Reimu Hakurei</td><td>8,913</td><td>1,777</td><td>1,224</td><td>21</td></tr>
<tr><td>3</td><td>4</td><td>3</td><td class="left">Koishi Komeiji</td><td>8,865</td><td>1,591</td><td>1,176</td><td>17</td></tr>
<tr><td>4</td><td>2</td><td>2</td><td class="left">Marisa Kirisame</td><td>8,626</td><td>1,587</td><td>1,172</td><td>17</td></tr>
<tr><td>5</td><td>6</td><td>6</td><td class="left">Flandre Scarlet</td><td>8,497</td><td>1,607</td><td>1,207</td><td>20</td></tr>
<tr><td>6</td><td>5</td><td>7</td><td class="left">Remilia Scarlet</td><td>8,294</td><td>1,563</td><td>1,128</td><td>10</td></tr>
<tr><td>7</td><td>7</td><td>5</td><td class="left">Sakuya Izayoi</td><td>7,853</td><td>1,373</td><td>1,062</td><td>8</td></tr>
<tr><td>8</td><td>8</td><td>8</td><td class="left">Satori Komeiji</td><td>6,090</td><td>817</td><td>772</td><td>10</td></tr>
<tr><td>9</td><td>11</td><td>10</td><td class="left">Fujiwara no Mokou</td><td>5,657</td><td>883</td><td>747</td><td>2</td></tr>
<tr><td>10</td><td>9</td><td>11</td><td class="left">Aya Shameimaru</td><td>5,289</td><td>793</td><td>670</td><td>9</td></tr>
<tr><td>11</td><td>10</td><td>9</td><td class="left">Alice Margatroid</td><td>4,749</td><td>836</td><td>609</td><td>6</td></tr>
<tr><td>12</td><td>13</td><td>14</td><td class="left">Sanae Kochiya</td><td>4,737</td><td>746</td><td>581</td><td>10</td></tr>
<tr><td>13</td><td>15</td><td>18</td><td class="left">Yuyuko Saigyouji</td><td>4,541</td><td>689</td><td>598</td><td>14</td></tr>
<tr><td>14</td><td>16</td><td>16</td><td class="left">Reisen Udongein Inaba</td><td>4,257</td><td>474</td><td>547</td><td>5</td></tr>
<tr><td>15</td><td>12</td><td>13</td><td class="left">Yukari Yakumo</td><td>4,069</td><td>508</td><td>559</td><td>7</td></tr>
<tr><td>16</td><td>14</td><td>12</td><td class="left">Tenshi Hinanawi</td><td>3,765</td><td>554</td><td>470</td><td>10</td></tr>
<tr><td>17</td><td>17</td><td>17</td><td class="left">Hata no Kokoro</td><td>3,719</td><td>367</td><td>472</td><td>5</td></tr>
<tr><td>18</td><td>20</td><td>21</td><td class="left">Patchouli Knowledge</td><td>3,532</td><td>472</td><td>430</td><td>4</td></tr>
<tr><td>19</td><td>23</td><td>25</td><td class="left">Eiki Shiki, Yamaxanadu</td><td>3,238</td><td>412</td><td>434</td><td>5</td></tr>
<tr><td>20</td><td>19</td><td>20</td><td class="left">Kogasa Tatara</td><td>3,199</td><td>452</td><td>475</td><td>20</td></tr>
<tr><td>21</td><td>29</td><td>32</td><td class="left">Suwako Moriya</td><td>3,133</td><td>433</td><td>422</td><td>5</td></tr>
<tr><td>22</td><td>21</td><td>19</td><td class="left">Momiji Inubashiri</td><td>3,074</td><td>505</td><td>445</td><td>9</td></tr>
<tr><td>23</td><td>25</td><td>24</td><td class="left">Rumia</td><td>3,054</td><td>489</td><td>481</td><td>5</td></tr>
<tr><td>24</td><td>24</td><td>31</td><td class="left">Cirno</td><td>3,020</td><td>521</td><td>476</td><td>15</td></tr>
<tr><td>25</td><td>22</td><td>22</td><td class="left">Hong Meiling</td><td>3,013</td><td>475</td><td>441</td><td>14</td></tr>
<tr><td>26</td><td>28</td><td>29</td><td class="left">Junko</td><td>2,750</td><td>324</td><td>409</td><td>3</td></tr>
<tr><td>27</td><td>26</td><td>26</td><td class="left">Renko Usami</td><td>2,746</td><td>330</td><td>340</td><td>3</td></tr>
<tr><td>28</td><td>27</td><td>23</td><td class="left">Yuuka Kazami</td><td>2,700</td><td>349</td><td>318</td><td>3</td></tr>
<tr><td>29</td><td>40</td><td>39</td><td class="left">Toyosatomimi no Miko</td><td>2,573</td><td>388</td><td>363</td><td>8</td></tr>
<tr><td>30</td><td>18</td><td>15</td><td class="left">Shion Yorigami</td><td>2,473</td><td>157</td><td>303</td><td>4</td></tr>
<tr><td>31</td><td>43</td><td>43</td><td class="left">Suika Ibuki</td><td>2,460</td><td>278</td><td>292</td><td>10</td></tr>
<tr><td>32</td><td>31</td><td>30</td><td class="left">Seija Kijin</td><td>2,326</td><td>340</td><td>342</td><td>10</td></tr>
<tr><td>33</td><td>37</td><td>35</td><td class="left">Nitori Kawashiro</td><td>2,309</td><td>289</td><td>336</td><td>4</td></tr>
<tr><td>34</td><td>33</td><td>33</td><td class="left">Parsee Mizuhashi</td><td>2,290</td><td>355</td><td>321</td><td>4</td></tr>
<tr><td>35</td><td>49</td><td>48</td><td class="left">Kasen Ibaraki</td><td>2,289</td><td>189</td><td>296</td><td>3</td></tr>
<tr><td>36</td><td>-</td><td>-</td><td class="left">Keiki Haniyashushin</td><td>2,217</td><td>194</td><td>379</td><td>3</td></tr>
<tr><td>37</td><td>39</td><td>37</td><td class="left">Ran Yakumo</td><td>2,204</td><td>266</td><td>324</td><td>6</td></tr>
<tr><td>38</td><td>32</td><td>34</td><td class="left">Utsuho Reiuji</td><td>2,143</td><td>293</td><td>289</td><td>7</td></tr>
<tr><td>39</td><td>41</td><td>36</td><td class="left">Mononobe no Futo</td><td>2,142</td><td>272</td><td>313</td><td>5</td></tr>
<tr><td>40</td><td>30</td><td>28</td><td class="left">Sagume Kishin</td><td>2,118</td><td>204</td><td>286</td><td>3</td></tr>
<tr><td>41</td><td>35</td><td>38</td><td class="left">Kaguya Houraisan</td><td>2,048</td><td>237</td><td>289</td><td>2</td></tr>
<tr><td>42</td><td>34</td><td>44</td><td class="left">Hecatia Lapislazuli</td><td>1,934</td><td>168</td><td>328</td><td>1</td></tr>
<tr><td>43</td><td>48</td><td>45</td><td class="left">Okina Matara</td><td>1,932</td><td>215</td><td>295</td><td>5</td></tr>
<tr><td>44</td><td>45</td><td>41</td><td class="left">Byakuren Hijiri</td><td>1,913</td><td>228</td><td>284</td><td>2</td></tr>
<tr><td>45</td><td>42</td><td>40</td><td class="left">Nue Houjuu</td><td>1,766</td><td>208</td><td>226</td><td>8</td></tr>
<tr><td>46</td><td>-</td><td>-</td><td class="left">Yachie Kicchou</td><td>1,733</td><td>104</td><td>299</td><td>4</td></tr>
<tr><td>47</td><td>50</td><td>51</td><td class="left">Rin Kaenbyou</td><td>1,731</td><td>158</td><td>261</td><td>5</td></tr>
<tr><td>48</td><td>44</td><td>42</td><td class="left">Clownpiece</td><td>1,724</td><td>129</td><td>238</td><td>2</td></tr>
<tr><td>49</td><td>46</td><td>49</td><td class="left">Maribel Hearn</td><td>1,705</td><td>119</td><td>211</td><td>4</td></tr>
<tr><td>50</td><td>51</td><td>50</td><td class="left">Hina Kagiyama</td><td>1,610</td><td>248</td><td>219</td><td>4</td></tr>
<tr><td>51</td><td>38</td><td>27</td><td class="left">Doremy Sweet</td><td>1,595</td><td>158</td><td>250</td><td>1</td></tr>
<tr><td>52</td><td>47</td><td>46</td><td class="left">Kagerou Imaizumi</td><td>1,467</td><td>133</td><td>233</td><td>3</td></tr>
<tr><td>53</td><td>53</td><td>52</td><td class="left">Nazrin</td><td>1,401</td><td>181</td><td>197</td><td>11</td></tr>
<tr><td>54</td><td>56</td><td>62</td><td class="left">Daiyousei</td><td>1,366</td><td>161</td><td>187</td><td>11</td></tr>
<tr><td>55</td><td>36</td><td>54</td><td class="left">Joon Yorigami</td><td>1,358</td><td>104</td><td>218</td><td>6</td></tr>
<tr><td>56</td><td>-</td><td>-</td><td class="left">Kutaka Niwatari</td><td>1,353</td><td>79</td><td>246</td><td>2</td></tr>
<tr><td>57</td><td>54</td><td>56</td><td class="left">Keine Kamishirasawa</td><td>1,347</td><td>152</td><td>176</td><td>1</td></tr>
<tr><td>58</td><td>58</td><td>65</td><td class="left">Eirin Yagokoro</td><td>1,346</td><td>124</td><td>205</td><td>3</td></tr>
<tr><td>59</td><td>61</td><td>60</td><td class="left">Seiga Kaku</td><td>1,309</td><td>124</td><td>177</td><td>3</td></tr>
<tr><td>60</td><td>59</td><td>55</td><td class="left">Kosuzu Motoori</td><td>1,303</td><td>90</td><td>176</td><td>1</td></tr>
<tr><td>61</td><td>63</td><td>61</td><td class="left">Chen</td><td>1,290</td><td>152</td><td>210</td><td>4</td></tr>
<tr><td>62</td><td>52</td><td>53</td><td class="left">Sumireko Usami</td><td>1,164</td><td>95</td><td>171</td><td>2</td></tr>
<tr><td>63</td><td>55</td><td>57</td><td class="left">Iku Nagae</td><td>1,163</td><td>112</td><td>165</td><td>2</td></tr>
<tr><td>64</td><td>57</td><td>58</td><td class="left">Mystia Lorelei</td><td>1,147</td><td>160</td><td>174</td><td>6</td></tr>
<tr><td>65</td><td>67</td><td>73</td><td class="left">Komachi Onozuka</td><td>1,128</td><td>96</td><td>154</td><td>1</td></tr>
<tr><td>66</td><td>68</td><td>75</td><td class="left">Soga no Tojiko</td><td>1,119</td><td>124</td><td>156</td><td>1</td></tr>
<tr><td>67</td><td>66</td><td>59</td><td class="left">Shinmyoumaru Sukuna</td><td>1,107</td><td>100</td><td>189</td><td>5</td></tr>
<tr><td>68</td><td>-</td><td>-</td><td class="left">Mayumi Joutouguu</td><td>1,091</td><td>62</td><td>202</td><td>7</td></tr>
<tr><td>69</td><td>64</td><td>67</td><td class="left">Sekibanki</td><td>1,087</td><td>98</td><td>155</td><td>7</td></tr>
<tr><td>70</td><td>69</td><td>72</td><td class="left">Minamitsu Murasa</td><td>1,076</td><td>128</td><td>165</td><td>2</td></tr>
<tr><td>71</td><td>65</td><td>64</td><td class="left">Koakuma</td><td>1,069</td><td>84</td><td>156</td><td>2</td></tr>
<tr><td>72</td><td>72</td><td>74</td><td class="left">Hieda no Akyuu</td><td>1,060</td><td>90</td><td>156</td><td>0</td></tr>
<tr><td>73</td><td>62</td><td>63</td><td class="left">Hatate Himekaidou</td><td>1,024</td><td>81</td><td>143</td><td>1</td></tr>
<tr><td>74</td><td>70</td><td>70</td><td class="left">Tewi Inaba</td><td>999</td><td>84</td><td>131</td><td>2</td></tr>
<tr><td>75</td><td>79</td><td>80</td><td class="left">Rinnosuke Morichika</td><td>977</td><td>94</td><td>164</td><td>0</td></tr>
<tr><td>76</td><td>-</td><td>-</td><td class="left">Saki Kurokuma</td><td>947</td><td>35</td><td>150</td><td>2</td></tr>
<tr><td>77</td><td>77</td><td>77</td><td class="left">Yuugi Hoshiguma</td><td>946</td><td>103</td><td>138</td><td>2</td></tr>
<tr><td>78</td><td>76</td><td>71</td><td class="left">Kanako Yasaka</td><td>927</td><td>79</td><td>148</td><td>4</td></tr>
<tr><td>79</td><td>75</td><td>68</td><td class="left">Mamizou Futatsuiwa</td><td>893</td><td>78</td><td>153</td><td>1</td></tr>
<tr><td>80</td><td>71</td><td>68</td><td class="left">Raiko Horikawa</td><td>807</td><td>84</td><td>105</td><td>2</td></tr>
<tr><td>81</td><td>87</td><td>94</td><td class="left">Mima</td><td>795</td><td>75</td><td>116</td><td>0</td></tr>
<tr><td>82</td><td>92</td><td>101</td><td class="left">Lily White</td><td>794</td><td>86</td><td>131</td><td>9</td></tr>
<tr><td>83</td><td>60</td><td>47</td><td class="left">Aunn Komano</td><td>781</td><td>35</td><td>129</td><td>0</td></tr>
<tr><td>84</td><td>80</td><td>80</td><td class="left">Lunasa Prismriver</td><td>777</td><td>95</td><td>121</td><td>5</td></tr>
<tr><td>85</td><td>78</td><td>82</td><td class="left">Shou Toramaru</td><td>766</td><td>84</td><td>131</td><td>6</td></tr>
<tr><td>86</td><td>94</td><td>88</td><td class="left">Medicine Melancholy</td><td>761</td><td>78</td><td>122</td><td>1</td></tr>
<tr><td>87</td><td>74</td><td>78</td><td class="left">Kyouko Kasodani</td><td>736</td><td>55</td><td>109</td><td>3</td></tr>
<tr><td>88</td><td>82</td><td>85</td><td class="left">Shinki</td><td>726</td><td>54</td><td>102</td><td>0</td></tr>
<tr><td>89</td><td>90</td><td>89</td><td class="left">Yoshika Miyako</td><td>703</td><td>72</td><td>99</td><td>1</td></tr>
<tr><td>89</td><td>86</td><td>90</td><td class="left">Wakasagihime</td><td>703</td><td>56</td><td>123</td><td>4</td></tr>
<tr><td>91</td><td>83</td><td>92</td><td class="left">Yumemi Okazaki</td><td>701</td><td>56</td><td>100</td><td>2</td></tr>
<tr><td>92</td><td>73</td><td>66</td><td class="left">Unnamed Jinyou (Fortune Teller)</td><td>684</td><td>48</td><td>137</td><td>1</td></tr>
<tr><td>93</td><td>-</td><td>-</td><td class="left">Miyoi Okunoda</td><td>683</td><td>25</td><td>135</td><td>2</td></tr>
<tr><td>94</td><td>85</td><td>92</td><td class="left">Wriggle Nightbug</td><td>658</td><td>154</td><td>111</td><td>6</td></tr>
<tr><td>95</td><td>98</td><td>97</td><td class="left">Seiran</td><td>639</td><td>49</td><td>135</td><td>2</td></tr>
<tr><td>96</td><td>81</td><td>79</td><td class="left">Shizuha Aki</td><td>623</td><td>58</td><td>92</td><td>0</td></tr>
<tr><td>97</td><td>84</td><td>84</td><td class="left">Minoriko Aki</td><td>620</td><td>66</td><td>99</td><td>2</td></tr>
<tr><td>98</td><td>91</td><td>99</td><td class="left">Watatsuki no Yorihime</td><td>572</td><td>57</td><td>98</td><td>1</td></tr>
<tr><td>99</td><td>97</td><td>104</td><td class="left">Luna Child</td><td>570</td><td>40</td><td>92</td><td>0</td></tr>
<tr><td>100</td><td>99</td><td>98</td><td class="left">Letty Whiterock</td><td>531</td><td>75</td><td>87</td><td>2</td></tr>
<tr><td>101</td><td>102</td><td>103</td><td class="left">Star Sapphire</td><td>527</td><td>59</td><td>95</td><td>3</td></tr>
<tr><td>102</td><td>87</td><td>91</td><td class="left">Yamame Kurodani</td><td>495</td><td>63</td><td>95</td><td>4</td></tr>
<tr><td>103</td><td>104</td><td>107</td><td class="left">Sunny Milk</td><td>486</td><td>38</td><td>79</td><td>1</td></tr>
<tr><td>104</td><td>103</td><td>102</td><td class="left">Gengetsu</td><td>485</td><td>57</td><td>76</td><td>3</td></tr>
<tr><td>105</td><td>100</td><td>86</td><td class="left">Ichirin Kumoi</td><td>477</td><td>63</td><td>85</td><td>1</td></tr>
<tr><td>106</td><td>101</td><td>96</td><td class="left">Benben Tsukumo</td><td>461</td><td>47</td><td>81</td><td>3</td></tr>
<tr><td>107</td><td>93</td><td>95</td><td class="left">Eternity Larva</td><td>418</td><td>32</td><td>76</td><td>1</td></tr>
<tr><td>108</td><td>89</td><td>83</td><td class="left">Mai Teireida</td><td>414</td><td>17</td><td>66</td><td>2</td></tr>
<tr><td>109</td><td>95</td><td>87</td><td class="left">Satono Nishida</td><td>403</td><td>13</td><td>63</td><td>0</td></tr>
<tr><td>110</td><td>96</td><td>76</td><td class="left">Narumi Yatadera</td><td>398</td><td>18</td><td>72</td><td>2</td></tr>
<tr><td>111</td><td>109</td><td>106</td><td class="left">Merlin Prismriver</td><td>375</td><td>36</td><td>67</td><td>0</td></tr>
<tr><td>112</td><td>106</td><td>108</td><td class="left">Lyrica Prismriver</td><td>362</td><td>34</td><td>63</td><td>0</td></tr>
<tr><td>112</td><td>105</td><td>100</td><td class="left">Ringo</td><td>362</td><td>24</td><td>65</td><td>1</td></tr>
<tr><td>114</td><td>108</td><td>112</td><td class="left">Watatsuki no Toyohime</td><td>335</td><td>26</td><td>65</td><td>1</td></tr>
<tr><td>115</td><td>110</td><td>114</td><td class="left">Unnamed Book-Reading Youkai (Tokiko)</td><td>321</td><td>36</td><td>55</td><td>2</td></tr>
<tr><td>116</td><td>-</td><td>-</td><td class="left">Otter Spirit</td><td>295</td><td>14</td><td>99</td><td>0</td></tr>
<tr><td>117</td><td>112</td><td>110</td><td class="left">Alice's Dolls (Shanghai, Hourai, Ooedo, etc.)</td><td>290</td><td>13</td><td>52</td><td>2</td></tr>
<tr><td>118</td><td>112</td><td>115</td><td class="left">Kana Anaberal</td><td>279</td><td>26</td><td>49</td><td>1</td></tr>
<tr><td>119</td><td>114</td><td>117</td><td class="left">Dolls in Pseudo Paradise CD Jacket Girl</td><td>256</td><td>31</td><td>52</td><td>1</td></tr>
<tr><td>119</td><td>117</td><td>116</td><td class="left">Mugetsu</td><td>256</td><td>18</td><td>33</td><td>0</td></tr>
<tr><td>121</td><td>118</td><td>119</td><td class="left">Rei'sen</td><td>244</td><td>22</td><td>38</td><td>1</td></tr>
<tr><td>121</td><td>-</td><td>-</td><td class="left">Urumi Ushizaki</td><td>244</td><td>11</td><td>58</td><td>0</td></tr>
<tr><td>123</td><td>107</td><td>105</td><td class="left">Yatsuhashi Tsukumo</td><td>242</td><td>20</td><td>58</td><td>3</td></tr>
<tr><td>124</td><td>116</td><td>118</td><td class="left">Sariel</td><td>241</td><td>26</td><td>39</td><td>0</td></tr>
<tr><td>125</td><td>-</td><td>-</td><td class="left">Eika Ebisu</td><td>230</td><td>13</td><td>52</td><td>2</td></tr>
<tr><td>126</td><td>115</td><td>112</td><td class="left">Kisume</td><td>228</td><td>28</td><td>43</td><td>4</td></tr>
<tr><td>127</td><td>120</td><td>111</td><td class="left">Anxious Moustached Villager</td><td>208</td><td>4</td><td>41</td><td>0</td></tr>
<tr><td>128</td><td>119</td><td>120</td><td class="left">Yumeko</td><td>192</td><td>14</td><td>27</td><td>1</td></tr>
<tr><td>129</td><td>123</td><td>121</td><td class="left">Chiyuri Kitashirakawa</td><td>179</td><td>13</td><td>31</td><td>2</td></tr>
<tr><td>130</td><td>122</td><td>122</td><td class="left">Kurumi</td><td>174</td><td>12</td><td>36</td><td>0</td></tr>
<tr><td>131</td><td>111</td><td>109</td><td class="left">Nemuno Sakata</td><td>153</td><td>8</td><td>26</td><td>4</td></tr>
<tr><td>132</td><td>126</td><td>124</td><td class="left">Mai</td><td>151</td><td>11</td><td>29</td><td>0</td></tr>
<tr><td>133</td><td>121</td><td>123</td><td class="left">Ellen</td><td>141</td><td>12</td><td>30</td><td>1</td></tr>
<tr><td>134</td><td>132</td><td>125</td><td class="left">Unzan</td><td>135</td><td>13</td><td>26</td><td>0</td></tr>
<tr><td>134</td><td>124</td><td>127</td><td class="left">Elis</td><td>135</td><td>12</td><td>23</td><td>1</td></tr>
<tr><td>136</td><td>127</td><td>128</td><td class="left">Konngara</td><td>129</td><td>18</td><td>24</td><td>0</td></tr>
<tr><td>136</td><td>137</td><td>138</td><td class="left">Kedama</td><td>129</td><td>5</td><td>16</td><td>0</td></tr>
<tr><td>138</td><td>133</td><td>132</td><td class="left">Youki Konpaku</td><td>125</td><td>4</td><td>27</td><td>0</td></tr>
<tr><td>139</td><td>131</td><td>130</td><td class="left">Elly</td><td>124</td><td>7</td><td>21</td><td>0</td></tr>
<tr><td>139</td><td>-</td><td>-</td><td class="left">Shadow Kasen (Ibaraki-Douji's Arm)</td><td>124</td><td>2</td><td>28</td><td>1</td></tr>
<tr><td>141</td><td>124</td><td>126</td><td class="left">Yuki</td><td>121</td><td>10</td><td>20</td><td>0</td></tr>
<tr><td>142</td><td>129</td><td>134</td><td class="left">Dolls in Pseudo Paradise CD Label Girl</td><td>117</td><td>3</td><td>28</td><td>0</td></tr>
<tr><td>143</td><td>135</td><td>141</td><td class="left">Ruukoto</td><td>103</td><td>4</td><td>17</td><td>0</td></tr>
<tr><td>144</td><td>140</td><td>129</td><td class="left">Giant Catfish</td><td>98</td><td>5</td><td>13</td><td>0</td></tr>
<tr><td>145</td><td>128</td><td>131</td><td class="left">Kotohime</td><td>97</td><td>13</td><td>14</td><td>0</td></tr>
<tr><td>145</td><td>129</td><td>133</td><td class="left">Rika</td><td>97</td><td>11</td><td>18</td><td>8</td></tr>
<tr><td>145</td><td>-</td><td>-</td><td class="left">Wolf Spirit</td><td>97</td><td>4</td><td>27</td><td>0</td></tr>
<tr><td>148</td><td>141</td><td>139</td><td class="left">Fairy (Maid, Sunflower, etc.)</td><td>96</td><td>9</td><td>37</td><td>7</td></tr>
<tr><td>149</td><td>145</td><td>139</td><td class="left">UFO tokens</td><td>86</td><td>5</td><td>26</td><td>0</td></tr>
<tr><td>150</td><td>149</td><td>148</td><td class="left">Thermonuclear Deity Hisou Tensoku</td><td>77</td><td>2</td><td>15</td><td>0</td></tr>
<tr><td>151</td><td>134</td><td>136</td><td class="left">Meira</td><td>76</td><td>5</td><td>17</td><td>1</td></tr>
<tr><td>152</td><td>136</td><td>137</td><td class="left">Layla Prismriver</td><td>75</td><td>6</td><td>13</td><td>0</td></tr>
<tr><td>153</td><td>-</td><td>-</td><td class="left">Eagle Spirit</td><td>66</td><td>4</td><td>26</td><td>0</td></tr>
<tr><td>154</td><td>137</td><td>143</td><td class="left">YuugenMagan</td><td>63</td><td>5</td><td>16</td><td>2</td></tr>
<tr><td>154</td><td>142</td><td>149</td><td class="left">Louise</td><td>63</td><td>5</td><td>14</td><td>0</td></tr>
<tr><td>156</td><td>139</td><td>143</td><td class="left">Orange</td><td>60</td><td>6</td><td>18</td><td>0</td></tr>
<tr><td>157</td><td>148</td><td>141</td><td class="left">PC-98 unnamed midbosses</td><td>58</td><td>5</td><td>14</td><td>0</td></tr>
<tr><td>157</td><td>144</td><td>146</td><td class="left">Rikako Asakura</td><td>58</td><td>5</td><td>4</td><td>0</td></tr>
<tr><td>159</td><td>143</td><td>145</td><td class="left">SinGyoku</td><td>54</td><td>7</td><td>16</td><td>0</td></tr>
<tr><td>159</td><td>152</td><td>160</td><td class="left">Kikuri</td><td>54</td><td>7</td><td>14</td><td>1</td></tr>
<tr><td>161</td><td>149</td><td>146</td><td class="left">Chang'e</td><td>52</td><td>1</td><td>13</td><td>0</td></tr>
<tr><td>162</td><td>145</td><td>135</td><td class="left">Nameemon (Kosuzu's stuffed slug)</td><td>51</td><td>0</td><td>14</td><td>0</td></tr>
<tr><td>163</td><td>156</td><td>158</td><td class="left">Tupai</td><td>45</td><td>1</td><td>13</td><td>0</td></tr>
<tr><td>164</td><td>154</td><td>154</td><td class="left">Genjii</td><td>43</td><td>0</td><td>11</td><td>0</td></tr>
<tr><td>165</td><td>152</td><td>155</td><td class="left">Sara</td><td>40</td><td>5</td><td>6</td><td>1</td></tr>
<tr><td>166</td><td>156</td><td>151</td><td class="left">Kitsune (Youkai kitsune, Unnamed fox student, etc.)</td><td>39</td><td>1</td><td>10</td><td>0</td></tr>
<tr><td>167</td><td>147</td><td>156</td><td class="left">Mimi-chan</td><td>38</td><td>2</td><td>7</td><td>0</td></tr>
<tr><td>168</td><td>159</td><td>157</td><td class="left">Kappa (including yamawaro)</td><td>33</td><td>0</td><td>6</td><td>1</td></tr>
<tr><td>169</td><td>161</td><td>158</td><td class="left">Rabbits (Moon rabbits, Eientei youkai rabbits, etc.)</td><td>32</td><td>0</td><td>9</td><td>0</td></tr>
<tr><td>170</td><td>155</td><td>150</td><td class="left">Tsuchinoko</td><td>30</td><td>0</td><td>8</td><td>1</td></tr>
<tr><td>171</td><td>171</td><td>164</td><td class="left">Kasen's animals (Kume, Kanda, Raijuu, Houso, Jinkenmen, etc.)</td><td>29</td><td>0</td><td>8</td><td>0</td></tr>
<tr><td>172</td><td>156</td><td>151</td><td class="left">Dragons (Dragon child, Unnamed evil dragon, etc.)</td><td>28</td><td>2</td><td>6</td><td>0</td></tr>
<tr><td>173</td><td>168</td><td>168</td><td class="left">Misc. Human Villagers (BAiJR, PMiSS, SoPM, FS, etc.)</td><td>25</td><td>2</td><td>14</td><td>0</td></tr>
<tr><td>174</td><td>149</td><td>151</td><td class="left">Urban Legends (Okiku-san, Hasshaku-sama)</td><td>24</td><td>3</td><td>5</td><td>0</td></tr>
<tr><td>175</td><td>159</td><td>163</td><td class="left">Unnamed Snake Youkai</td><td>23</td><td>1</td><td>6</td><td>0</td></tr>
<tr><td>175</td><td>169</td><td>171</td><td class="left">Manzairaku</td><td>23</td><td>0</td><td>8</td><td>0</td></tr>
<tr><td>177</td><td>166</td><td>161</td><td class="left">Hobgoblin</td><td>22</td><td>1</td><td>9</td><td>0</td></tr>
<tr><td>178</td><td>162</td><td>167</td><td class="left">Sake Bug</td><td>21</td><td>2</td><td>4</td><td>0</td></tr>
<tr><td>178</td><td>164</td><td>169</td><td class="left">Unshou</td><td>21</td><td>1</td><td>8</td><td>0</td></tr>
<tr><td>180</td><td>164</td><td>164</td><td class="left">Tengu (Kourindou Tengu, Great Tengu, etc.)</td><td>20</td><td>2</td><td>3</td><td>0</td></tr>
<tr><td>180</td><td>167</td><td>172</td><td class="left">Keseran-pasaran</td><td>20</td><td>0</td><td>3</td><td>0</td></tr>
<tr><td>182</td><td>169</td><td>161</td><td class="left">Myouren</td><td>18</td><td>1</td><td>5</td><td>0</td></tr>
<tr><td>183</td><td>163</td><td>173</td><td class="left">Crows (Hell ravens, Yukari and Aya's familiars, etc.)</td><td>15</td><td>0</td><td>5</td><td>0</td></tr>
<tr><td>183</td><td>177</td><td>180</td><td class="left">Summoned Gods (Amaterasu, Izunome, etc.)</td><td>15</td><td>0</td><td>2</td><td>0</td></tr>
<tr><td>185</td><td>179</td><td>169</td><td class="left">Tanuki (Bake-danuki, Noteppou, etc.)</td><td>13</td><td>1</td><td>3</td><td>0</td></tr>
<tr><td>185</td><td>181</td><td>174</td><td class="left">Ghosts (including vengeful spirits, divine spirits, bakebake)</td><td>13</td><td>0</td><td>2</td><td>0</td></tr>
<tr><td>187</td><td>174</td><td>176</td><td class="left">Iwakasa</td><td>11</td><td>0</td><td>1</td><td>0</td></tr>
<tr><td>188</td><td>171</td><td>183</td><td class="left">Shirou Sendai</td><td>10</td><td>1</td><td>4</td><td>0</td></tr>
<tr><td>188</td><td>174</td><td>176</td><td class="left">Konohana-Sakuyahime</td><td>10</td><td>0</td><td>3</td><td>0</td></tr>
<tr><td>190</td><td>181</td><td>179</td><td class="left">Kosuzu Motoori's parents</td><td>9</td><td>1</td><td>4</td><td>0</td></tr>
<tr><td>191</td><td>185</td><td>184</td><td class="left">Zashiki-warashi</td><td>7</td><td>1</td><td>1</td><td>0</td></tr>
<tr><td>191</td><td>177</td><td>175</td><td class="left">Moon Capital Gate Guards</td><td>7</td><td>0</td><td>2</td><td>0</td></tr>
<tr><td>191</td><td>184</td><td>176</td><td class="left">Salt Merchant</td><td>7</td><td>0</td><td>2</td><td>0</td></tr>
<tr><td>191</td><td>183</td><td>180</td><td class="left">Bishamonten</td><td>7</td><td>0</td><td>0</td><td>0</td></tr>
<tr><td>195</td><td>185</td><td>185</td><td class="left">Enenra</td><td>5</td><td>0</td><td>2</td><td>0</td></tr>
<tr><td>196</td><td>176</td><td>166</td><td class="left">Unnamed Dormouse (Yamane)</td><td>4</td><td>0</td><td>1</td><td>0</td></tr>
<tr><td>196</td><td>179</td><td>180</td><td class="left">Kutsutsura</td><td>4</td><td>0</td><td>0</td><td>0</td></tr>
<tr><td>198</td><td>173</td><td>186</td><td class="left">Mizue no Uranoshimako</td><td>2</td><td>0</td><td>0</td><td>0</td></tr>
                        </tbody>
                    </table>
                </div>
                <h1 id='music'>Music</h1>
                <div id='music_dummy' class='dummy'><div class='dummy_sub'></div></div>
                <div id='music_container' class='container'>
                    <table id='music_table' class='poll table sortable'>
                        <colgroup>
                            <!--<col class="col1">-->
                            <col class="col2game">
                            <col class="col3game">
                            <col class="col4game">
                            <col class="col5">
                            <col class="col6per">
                            <col class="col7per">
                            <col class="col8per">
                        </colgroup>
                        <thead>
                            <tr>
                                <!--<th id='music_head' class='head noborders sorttable_numeric'>#</th>-->
                                <th class='sorttable_numeric'>Rank</th>
                                <th class='sorttable_numeric'>2019 rank</th>
                                <th class='sorttable_numeric'>2018 rank</th>
                                <th>Name</th>
                                <th class='sorttable_numeric'>Points</th>
                                <th class='sorttable_numeric'>No. 1 Votes</th>
                                <th class='sorttable_numeric'>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
<tr><td>1</td><td>2</td><td>1</td><td class="left">U.N. Owen Was Her?</td><td>8,568</td><td>1,771</td><td>661</td></tr>
<tr><td>2</td><td>1</td><td>2</td><td class="left">Septette for a Dead Princess</td><td>8,239</td><td>1,664</td><td>574</td></tr>
<tr><td>3</td><td>4</td><td>4</td><td class="left">Hartmann's Youkai Girl</td><td>6,204</td><td>856</td><td>495</td></tr>
<tr><td>4</td><td>-</td><td>-</td><td class="left">Entrust this World to Idols　〜 Idoratrize World</td><td>5,655</td><td>1,045</td><td>691</td></tr>
<tr><td>5</td><td>3</td><td>3</td><td class="left">Pure Furies ~ Whereabouts of the Heart</td><td>5,351</td><td>906</td><td>554</td></tr>
<tr><td>6</td><td>5</td><td>5</td><td class="left">Bloom Nobly, Ink-Black Cherry Blossom ~ Border of Life</td><td>5,051</td><td>683</td><td>320</td></tr>
<tr><td>7</td><td>6</td><td>7</td><td class="left">Reach for the Moon, Immortal Smoke</td><td>4,943</td><td>589</td><td>349</td></tr>
<tr><td>8</td><td>9</td><td>8</td><td class="left">Shanghai Teahouse ~ Chinese Tea</td><td>4,588</td><td>722</td><td>278</td></tr>
<tr><td>9</td><td>8</td><td>9</td><td class="left">The Gensokyo The Gods Loved</td><td>4,455</td><td>415</td><td>360</td></tr>
<tr><td>10</td><td>7</td><td>6</td><td class="left">Necrofantasia</td><td>4,390</td><td>467</td><td>307</td></tr>
<tr><td>11</td><td>12</td><td>12</td><td class="left">Love-Coloured Master Spark（Love-coloured Magic）</td><td>4,110</td><td>410</td><td>268</td></tr>
<tr><td>12</td><td>10</td><td>11</td><td class="left">Broken Moon</td><td>3,820</td><td>369</td><td>274</td></tr>
<tr><td>13</td><td>11</td><td>10</td><td class="left">Inchlings of the Shining Needle ~ Little Princess</td><td>3,490</td><td>421</td><td>304</td></tr>
<tr><td>14</td><td>15</td><td>13</td><td class="left">Ghostly Band ~ Phantom Ensemble</td><td>3,081</td><td>354</td><td>221</td></tr>
<tr><td>15</td><td>18</td><td>19</td><td class="left">Native Faith</td><td>3,039</td><td>319</td><td>242</td></tr>
<tr><td>16</td><td>19</td><td>16</td><td class="left">Lunar Clock ~ Luna Dial</td><td>2,937</td><td>362</td><td>182</td></tr>
<tr><td>17</td><td>14</td><td>15</td><td class="left">Satori Maiden ~ 3rd eye</td><td>2,894</td><td>306</td><td>202</td></tr>
<tr><td>18</td><td>16</td><td>13</td><td class="left">Emotional Skyscraper ~ Cosmic Mind</td><td>2,805</td><td>284</td><td>224</td></tr>
<tr><td>19</td><td>21</td><td>18</td><td class="left">Flight in the Bamboo Cutter ~ Lunatic Princess</td><td>2,730</td><td>234</td><td>206</td></tr>
<tr><td>20</td><td>13</td><td>22</td><td class="left">Tonight Stars an Easygoing Egoist (Live ver.) ~ Egoistic Flowers.</td><td>2,679</td><td>247</td><td>231</td></tr>
<tr><td>21</td><td>17</td><td>17</td><td class="left">Last Remote</td><td>2,667</td><td>240</td><td>185</td></tr>
<tr><td>22</td><td>24</td><td>26</td><td class="left">Maiden's Capriccio / Dream Battle</td><td>2,515</td><td>229</td><td>172</td></tr>
<tr><td>23</td><td>23</td><td>23</td><td class="left">Faith Is for the Transient People</td><td>2,446</td><td>239</td><td>167</td></tr>
<tr><td>24</td><td>25</td><td>28</td><td class="left">Tomboyish Girl in Love</td><td>2,418</td><td>329</td><td>163</td></tr>
<tr><td>25</td><td>20</td><td>21</td><td class="left">Gensokyo Millennium ~ History of the Moon</td><td>2,398</td><td>238</td><td>201</td></tr>
<tr><td>26</td><td>22</td><td>20</td><td class="left">Desire Drive</td><td>2,340</td><td>203</td><td>189</td></tr>
<tr><td>27</td><td>32</td><td>30</td><td class="left">Flowering Night</td><td>2,170</td><td>149</td><td>144</td></tr>
<tr><td>28</td><td>26</td><td>27</td><td class="left">The Centennial Festival for Magical Girls</td><td>2,023</td><td>184</td><td>131</td></tr>
<tr><td>29</td><td>36</td><td>36</td><td class="left">Lunatic Eyes ~ Invisible Full Moon</td><td>1,957</td><td>148</td><td>134</td></tr>
<tr><td>30</td><td>31</td><td>34</td><td class="left">Wind God Girl</td><td>1,834</td><td>178</td><td>128</td></tr>
<tr><td>31</td><td>35</td><td>47</td><td class="left">Shanghai Alice of Meiji 17</td><td>1,827</td><td>217</td><td>111</td></tr>
<tr><td>32</td><td>28</td><td>29</td><td class="left">Solar Sect of Mystic Wisdom ~ Nuclear Fusion</td><td>1,784</td><td>162</td><td>140</td></tr>
<tr><td>33</td><td>33</td><td>37</td><td class="left">Eastern Judgement in the Sixtieth Year ~ Fate of Sixty Years</td><td>1,780</td><td>159</td><td>126</td></tr>
<tr><td>34</td><td>30</td><td>33</td><td class="left">Fall of Fall ~ Autumnal Waterfall</td><td>1,775</td><td>214</td><td>134</td></tr>
<tr><td>35</td><td>51</td><td>55</td><td class="left">Hiroari Shoots a Strange Bird ~ Till When?</td><td>1,723</td><td>223</td><td>126</td></tr>
<tr><td>36</td><td>29</td><td>25</td><td class="left">Magus Night</td><td>1,663</td><td>128</td><td>157</td></tr>
<tr><td>37</td><td>27</td><td>24</td><td class="left">Secret God Matara ~ Hidden Star in All Seasons.</td><td>1,649</td><td>136</td><td>169</td></tr>
<tr><td>38</td><td>37</td><td>41</td><td class="left">Apparitions Stalk the Night</td><td>1,633</td><td>248</td><td>101</td></tr>
<tr><td>39</td><td>34</td><td>38</td><td class="left">Doll Judgment</td><td>1,606</td><td>137</td><td>102</td></tr>
<tr><td>40</td><td>45</td><td>43</td><td class="left">Greenwich in the Sky</td><td>1,538</td><td>124</td><td>102</td></tr>
<tr><td>41</td><td>38</td><td>44</td><td class="left">At the End of Spring</td><td>1,519</td><td>136</td><td>137</td></tr>
<tr><td>42</td><td>39</td><td>31</td><td class="left">The Pierrot of the Star-Spangled Banner</td><td>1,495</td><td>74</td><td>138</td></tr>
<tr><td>43</td><td>55</td><td>46</td><td class="left">Shoutoku Legend ~ True Administrator</td><td>1,476</td><td>168</td><td>132</td></tr>
<tr><td>44</td><td>43</td><td>51</td><td class="left">Tomorrow Will Be Special, Yesterday Was Not</td><td>1,475</td><td>126</td><td>135</td></tr>
<tr><td>45</td><td>44</td><td>49</td><td class="left">The Youkai Mountain ~ Mysterious Mountain</td><td>1,449</td><td>124</td><td>141</td></tr>
<tr><td>46</td><td>42</td><td>48</td><td class="left">Lullaby of Deserted Hell</td><td>1,399</td><td>111</td><td>126</td></tr>
<tr><td>47</td><td>47</td><td>51</td><td class="left">Akutagawa Ryuunosuke's "Kappa" ~ Candid Friend</td><td>1,389</td><td>122</td><td>111</td></tr>
<tr><td>48</td><td>54</td><td>62</td><td class="left">The Maid and the Pocket Watch of Blood</td><td>1,377</td><td>133</td><td>91</td></tr>
<tr><td>49</td><td>41</td><td>39</td><td class="left">The Fantastic Tales from Tono</td><td>1,372</td><td>138</td><td>121</td></tr>
<tr><td>50</td><td>56</td><td>65</td><td class="left">Locked Girl ~ The Girl's Secret Room</td><td>1,317</td><td>148</td><td>84</td></tr>
<tr><td>51</td><td>45</td><td>42</td><td class="left">Heian Alien</td><td>1,296</td><td>95</td><td>97</td></tr>
<tr><td>52</td><td>48</td><td>40</td><td class="left">Primordial Beat ~ Pristine Beat</td><td>1,266</td><td>104</td><td>125</td></tr>
<tr><td>53</td><td>-</td><td>-</td><td class="left">Unlocated Hell</td><td>1,229</td><td>124</td><td>215</td></tr>
<tr><td>53</td><td>50</td><td>45</td><td class="left">Catastrophe in Bhavaagra ~ Wonderful Heaven</td><td>1,229</td><td>98</td><td>82</td></tr>
<tr><td>55</td><td>58</td><td>73</td><td class="left">Crimson Tower ~ Eastern Dream...</td><td>1,216</td><td>112</td><td>104</td></tr>
<tr><td>56</td><td>59</td><td>61</td><td class="left">Eastern Mystical Dream ~ Ancient Temple</td><td>1,214</td><td>136</td><td>81</td></tr>
<tr><td>57</td><td>57</td><td>57</td><td class="left">Dark Side of Fate</td><td>1,199</td><td>86</td><td>75</td></tr>
<tr><td>58</td><td>61</td><td>66</td><td class="left">The Primal Scene of Japan the Girl Saw</td><td>1,182</td><td>104</td><td>111</td></tr>
<tr><td>59</td><td>40</td><td>32</td><td class="left">The Concealed Four Seasons</td><td>1,174</td><td>66</td><td>117</td></tr>
<tr><td>60</td><td>68</td><td>64</td><td class="left">Border of Life</td><td>1,146</td><td>81</td><td>122</td></tr>
<tr><td>61</td><td>64</td><td>60</td><td class="left">Old Yuanxian</td><td>1,140</td><td>82</td><td>91</td></tr>
<tr><td>62</td><td>52</td><td>53</td><td class="left">Dichromatic Lotus Butterfly ~ Ancients / Red and White</td><td>1,134</td><td>83</td><td>109</td></tr>
<tr><td>63</td><td>62</td><td>59</td><td class="left">The Venerable Ancient Battlefield ~ Suwa Foughten Field</td><td>1,120</td><td>62</td><td>90</td></tr>
<tr><td>64</td><td>53</td><td>56</td><td class="left">Pandemonic Planet</td><td>1,098</td><td>72</td><td>102</td></tr>
<tr><td>65</td><td>66</td><td>67</td><td class="left">Green-Eyed Jealousy</td><td>1,085</td><td>114</td><td>86</td></tr>
<tr><td>66</td><td>70</td><td>77</td><td class="left">The Sea Where the Home Planet is Reflected</td><td>1,070</td><td>55</td><td>135</td></tr>
<tr><td>67</td><td>49</td><td>35</td><td class="left">Crazy Backup Dancers</td><td>1,061</td><td>61</td><td>88</td></tr>
<tr><td>68</td><td>63</td><td>50</td><td class="left">Reverse Ideology</td><td>1,055</td><td>105</td><td>85</td></tr>
<tr><td>69</td><td>66</td><td>68</td><td class="left">Deaf to All but the Song</td><td>1,030</td><td>61</td><td>61</td></tr>
<tr><td>70</td><td>71</td><td>72</td><td class="left">Because Princess Inada Is Scolding Me</td><td>1,003</td><td>66</td><td>83</td></tr>
<tr><td>71</td><td>81</td><td>91</td><td class="left">Kid's Festival ~ Innocent Treasures</td><td>975</td><td>106</td><td>98</td></tr>
<tr><td>72</td><td>79</td><td>95</td><td class="left">The Capital City of Flowers in the Sky</td><td>950</td><td>106</td><td>91</td></tr>
<tr><td>73</td><td>76</td><td>81</td><td class="left">Alice in Wonderland</td><td>922</td><td>86</td><td>101</td></tr>
<tr><td>74</td><td>59</td><td>54</td><td class="left">Eternal Spring Dream</td><td>918</td><td>58</td><td>88</td></tr>
<tr><td>75</td><td>78</td><td>82</td><td class="left">Voyage 1969</td><td>891</td><td>58</td><td>73</td></tr>
<tr><td>76</td><td>77</td><td>63</td><td class="left">Night Falls</td><td>880</td><td>49</td><td>68</td></tr>
<tr><td>77</td><td>65</td><td>69</td><td class="left">Sleepless Night of the Eastern Country</td><td>878</td><td>60</td><td>58</td></tr>
<tr><td>78</td><td>73</td><td>80</td><td class="left">Mysterious Purification Rod</td><td>866</td><td>61</td><td>100</td></tr>
<tr><td>79</td><td>88</td><td>90</td><td class="left">Vanishing Dream ~ Lost Dream</td><td>861</td><td>85</td><td>80</td></tr>
<tr><td>80</td><td>83</td><td>87</td><td class="left">Hiroshige No.36 ~ Neo Super-Express</td><td>860</td><td>62</td><td>99</td></tr>
<tr><td>81</td><td>80</td><td>76</td><td class="left">The Road of the Misfortune God ~ Dark Road</td><td>856</td><td>64</td><td>59</td></tr>
<tr><td>82</td><td>92</td><td>96</td><td class="left">A Soul as Red as a Ground Cherry</td><td>849</td><td>98</td><td>55</td></tr>
<tr><td>83</td><td>74</td><td>71</td><td class="left">Cinderella Cage ~ Kagome-Kagome</td><td>841</td><td>54</td><td>65</td></tr>
<tr><td>84</td><td>82</td><td>83</td><td class="left">Night Sakura of Dead Spirits</td><td>840</td><td>72</td><td>95</td></tr>
<tr><td>85</td><td>75</td><td>75</td><td class="left">Demystify Feast</td><td>835</td><td>72</td><td>96</td></tr>
<tr><td>86</td><td>89</td><td>88</td><td class="left">Illusionary Joururi</td><td>831</td><td>78</td><td>73</td></tr>
<tr><td>87</td><td>84</td><td>78</td><td class="left">A Maiden's Illusionary Funeral ~ Necro-Fantasy</td><td>822</td><td>87</td><td>65</td></tr>
<tr><td>88</td><td>69</td><td>58</td><td class="left">Last Occultism ~ Esotericist of the Present World</td><td>810</td><td>54</td><td>77</td></tr>
<tr><td>89</td><td>86</td><td>79</td><td class="left">Plain Asia</td><td>808</td><td>73</td><td>59</td></tr>
<tr><td>90</td><td>72</td><td>70</td><td class="left">The Lost Emotion</td><td>786</td><td>53</td><td>64</td></tr>
<tr><td>91</td><td>-</td><td>-</td><td class="left">Joutoujin of Ceramics</td><td>757</td><td>46</td><td>99</td></tr>
<tr><td>92</td><td>110</td><td>112</td><td class="left">Bad Apple!!</td><td>752</td><td>48</td><td>73</td></tr>
<tr><td>93</td><td>102</td><td>101</td><td class="left">Interdimensional Voyage of a Ghostly Passenger Ship</td><td>745</td><td>48</td><td>81</td></tr>
<tr><td>94</td><td>90</td><td>92</td><td class="left">Girls' Sealing Club</td><td>724</td><td>69</td><td>64</td></tr>
<tr><td>95</td><td>96</td><td>94</td><td class="left">Beware the Umbrella Left There Forever</td><td>721</td><td>66</td><td>59</td></tr>
<tr><td>96</td><td>87</td><td>84</td><td class="left">Bell of Avici ~ Infinite Nightmare</td><td>716</td><td>48</td><td>61</td></tr>
<tr><td>96</td><td>91</td><td>89</td><td class="left">Faraway 380,000-Kilometer Voyage</td><td>716</td><td>36</td><td>87</td></tr>
<tr><td>98</td><td>100</td><td>98</td><td class="left">Eastern Heaven of Scarlet Perception</td><td>715</td><td>53</td><td>45</td></tr>
<tr><td>99</td><td>93</td><td>86</td><td class="left">Nostalgic Blood of the East ~ Old World</td><td>713</td><td>55</td><td>56</td></tr>
<tr><td>100</td><td>95</td><td>104</td><td class="left">Legend of Hourai</td><td>691</td><td>121</td><td>99</td></tr>
<tr><td>101</td><td>99</td><td>99</td><td class="left">Lunate Elf</td><td>689</td><td>88</td><td>51</td></tr>
<tr><td>102</td><td>104</td><td>97</td><td class="left">Extend Ash ~ Person of Hourai</td><td>659</td><td>45</td><td>49</td></tr>
<tr><td>103</td><td>103</td><td>103</td><td class="left">Reincarnation</td><td>649</td><td>49</td><td>64</td></tr>
<tr><td>104</td><td>109</td><td>119</td><td class="left">Voile, the Magic Library</td><td>646</td><td>66</td><td>38</td></tr>
<tr><td>105</td><td>115</td><td>132</td><td class="left">A Dream that Is More Scarlet than Red</td><td>645</td><td>67</td><td>46</td></tr>
<tr><td>106</td><td>94</td><td>85</td><td class="left">The Doll Maker of Bucuresti</td><td>642</td><td>71</td><td>42</td></tr>
<tr><td>107</td><td>101</td><td>109</td><td class="left">Higan Retour ~ Riverside View</td><td>627</td><td>44</td><td>47</td></tr>
<tr><td>108</td><td>145</td><td>158</td><td class="left">Eastern Youkai Beauty</td><td>625</td><td>38</td><td>53</td></tr>
<tr><td>108</td><td>85</td><td>74</td><td class="left">Illusionary White Traveler</td><td>625</td><td>33</td><td>101</td></tr>
<tr><td>110</td><td>98</td><td>93</td><td class="left">the Grimoire of Alice</td><td>618</td><td>36</td><td>48</td></tr>
<tr><td>111</td><td>105</td><td>108</td><td class="left">Paradise ~ Deep Mountain</td><td>612</td><td>61</td><td>63</td></tr>
<tr><td>112</td><td>97</td><td>100</td><td class="left">Ultimate Truth</td><td>602</td><td>53</td><td>71</td></tr>
<tr><td>113</td><td>107</td><td>109</td><td class="left">The Childlike Duo's Naturalis Historia</td><td>567</td><td>41</td><td>69</td></tr>
<tr><td>114</td><td>126</td><td>138</td><td class="left">Memory of Forgathering Dream</td><td>538</td><td>49</td><td>41</td></tr>
<tr><td>115</td><td>114</td><td>135</td><td class="left">The Rabbit Has Landed</td><td>535</td><td>39</td><td>71</td></tr>
<tr><td>116</td><td>106</td><td>113</td><td class="left">Retrospective Kyoto</td><td>530</td><td>24</td><td>35</td></tr>
<tr><td>117</td><td>-</td><td>-</td><td class="left">Electric Heritage</td><td>529</td><td>24</td><td>92</td></tr>
<tr><td>117</td><td>-</td><td>-</td><td class="left">Prince Shoutoku's Pegasus　〜 Dark Pegasus</td><td>529</td><td>22</td><td>80</td></tr>
<tr><td>119</td><td>111</td><td>111</td><td class="left">Corpse Voyage ~ Be of good cheer!</td><td>526</td><td>31</td><td>39</td></tr>
<tr><td>120</td><td>108</td><td>116</td><td class="left">UFO Romance in the Night Sky</td><td>519</td><td>41</td><td>61</td></tr>
<tr><td>121</td><td>130</td><td>136</td><td class="left">Walking the Streets of a Former Hell</td><td>517</td><td>18</td><td>42</td></tr>
<tr><td>122</td><td>116</td><td>123</td><td class="left">Sakura, Sakura ~ Japanize Dream...</td><td>513</td><td>30</td><td>39</td></tr>
<tr><td>123</td><td>118</td><td>115</td><td class="left">Oni's Island in the Fairyland ~ Missing Power</td><td>501</td><td>32</td><td>61</td></tr>
<tr><td>124</td><td>116</td><td>105</td><td class="left">Futatsuiwa from Sado</td><td>492</td><td>25</td><td>49</td></tr>
<tr><td>125</td><td>133</td><td>120</td><td class="left">A Flower-Studded Sake Dish on Mt. Ooe</td><td>485</td><td>41</td><td>44</td></tr>
<tr><td>126</td><td>129</td><td>121</td><td class="left">Vessel of Stars ~ Casket of Star</td><td>484</td><td>28</td><td>25</td></tr>
<tr><td>127</td><td>-</td><td>-</td><td class="left">Beast Metropolis</td><td>480</td><td>25</td><td>63</td></tr>
<tr><td>128</td><td>141</td><td>131</td><td class="left">Omiwa Legend</td><td>479</td><td>46</td><td>66</td></tr>
<tr><td>129</td><td>112</td><td>102</td><td class="left">Bhavaagra As Seen Through a Child's Mind</td><td>473</td><td>36</td><td>39</td></tr>
<tr><td>129</td><td>152</td><td>154</td><td class="left">The Young Descendant of Tepes</td><td>473</td><td>32</td><td>35</td></tr>
<tr><td>131</td><td>124</td><td>128</td><td class="left">Gensokyo, Past and Present ~ Flower Land</td><td>463</td><td>43</td><td>42</td></tr>
<tr><td>131</td><td>122</td><td>126</td><td class="left">Eastern Memory of Forgathering Dream</td><td>463</td><td>27</td><td>47</td></tr>
<tr><td>133</td><td>124</td><td>146</td><td class="left">Eternal Shrine Maiden</td><td>461</td><td>52</td><td>63</td></tr>
<tr><td>134</td><td>137</td><td>142</td><td class="left">The Witches' Ball</td><td>456</td><td>26</td><td>36</td></tr>
<tr><td>135</td><td>113</td><td>106</td><td class="left">Bamboo Forest of the Full Moon</td><td>453</td><td>26</td><td>58</td></tr>
<tr><td>136</td><td>137</td><td>137</td><td class="left">Lovely Mound of Cherry Blossoms ~ Flower of Japan / Japanese Flower</td><td>449</td><td>55</td><td>61</td></tr>
<tr><td>137</td><td>121</td><td>132</td><td class="left">Voyage 1970</td><td>448</td><td>22</td><td>35</td></tr>
<tr><td>138</td><td>132</td><td>125</td><td class="left">The Reversed Wheel of Fortune</td><td>444</td><td>41</td><td>34</td></tr>
<tr><td>139</td><td>146</td><td>140</td><td class="left">Retribution for the Eternal Night ~ Imperishable Night</td><td>440</td><td>40</td><td>58</td></tr>
<tr><td>140</td><td>119</td><td>121</td><td class="left">The Frozen Eternal Capital</td><td>437</td><td>29</td><td>60</td></tr>
<tr><td>141</td><td>127</td><td>143</td><td class="left">Heartfelt Fancy</td><td>436</td><td>27</td><td>47</td></tr>
<tr><td>142</td><td>133</td><td>141</td><td class="left">Now, Until the Moment You Die</td><td>429</td><td>31</td><td>44</td></tr>
<tr><td>143</td><td>136</td><td>139</td><td class="left">Strawberry Crisis!!</td><td>422</td><td>34</td><td>49</td></tr>
<tr><td>144</td><td>146</td><td>150</td><td class="left">Fires of Hokkai</td><td>418</td><td>27</td><td>34</td></tr>
<tr><td>144</td><td>133</td><td>127</td><td class="left">A Star of Hope Rises in the Blue Sky</td><td>418</td><td>16</td><td>64</td></tr>
<tr><td>146</td><td>153</td><td>151</td><td class="left">Heaven of Scarlet Perception</td><td>417</td><td>33</td><td>33</td></tr>
<tr><td>146</td><td>128</td><td>130</td><td class="left">Oriental Dark Flight</td><td>417</td><td>30</td><td>39</td></tr>
<tr><td>148</td><td>148</td><td>164</td><td class="left">Satellite Café Terrace</td><td>413</td><td>38</td><td>38</td></tr>
<tr><td>149</td><td>151</td><td>148</td><td class="left">A Tiny, Tiny, Clever Commander</td><td>407</td><td>36</td><td>32</td></tr>
<tr><td>150</td><td>123</td><td>116</td><td class="left">Eternal Short-Lived Reign</td><td>398</td><td>21</td><td>41</td></tr>
<tr><td>151</td><td>150</td><td>149</td><td class="left">Faint Dream ~ Inanimate Dream</td><td>388</td><td>42</td><td>43</td></tr>
<tr><td>152</td><td>171</td><td>156</td><td class="left">Crystallized Silver</td><td>386</td><td>36</td><td>35</td></tr>
<tr><td>152</td><td>142</td><td>145</td><td class="left">Spring Lane ~ Colorful Path</td><td>386</td><td>31</td><td>34</td></tr>
<tr><td>154</td><td>143</td><td>134</td><td class="left">The Tiger-Patterned Vaisravana</td><td>380</td><td>19</td><td>37</td></tr>
<tr><td>155</td><td>137</td><td>124</td><td class="left">September Pumpkin</td><td>372</td><td>17</td><td>29</td></tr>
<tr><td>156</td><td>131</td><td>114</td><td class="left">Flawless Clothing of the Celestials</td><td>362</td><td>20</td><td>31</td></tr>
<tr><td>157</td><td>140</td><td>106</td><td class="left">Unknown X ~ Unfound Adventure / Occultly Madness</td><td>358</td><td>10</td><td>31</td></tr>
<tr><td>158</td><td>149</td><td>160</td><td class="left">The Wheelchair's Future in Space</td><td>356</td><td>23</td><td>39</td></tr>
<tr><td>158</td><td>144</td><td>118</td><td class="left">The Eternal Steam Engine</td><td>356</td><td>15</td><td>39</td></tr>
<tr><td>160</td><td>163</td><td>175</td><td class="left">Dream Palace of the Great Mausoleum</td><td>354</td><td>45</td><td>35</td></tr>
<tr><td>161</td><td>156</td><td>162</td><td class="left">A Midnight Fairy Dance</td><td>349</td><td>24</td><td>37</td></tr>
<tr><td>162</td><td>154</td><td>147</td><td class="left">Captain Murasa</td><td>338</td><td>20</td><td>35</td></tr>
<tr><td>163</td><td>-</td><td>-</td><td class="left">Seraphic Chicken</td><td>333</td><td>14</td><td>27</td></tr>
<tr><td>164</td><td>177</td><td>180</td><td class="left">Mystic Dream ~ Snow or Cherry Petal</td><td>331</td><td>30</td><td>17</td></tr>
<tr><td>165</td><td>157</td><td>157</td><td class="left">Great Fairy Wars ~ Fairy Wars</td><td>329</td><td>15</td><td>28</td></tr>
<tr><td>166</td><td>173</td><td>168</td><td class="left">Romantic Children</td><td>324</td><td>26</td><td>42</td></tr>
<tr><td>167</td><td>161</td><td>170</td><td class="left">Rural Makai City Esoteria</td><td>322</td><td>19</td><td>39</td></tr>
<tr><td>168</td><td>-</td><td>-</td><td class="left">Jelly Stone</td><td>319</td><td>8</td><td>51</td></tr>
<tr><td>169</td><td>179</td><td>165</td><td class="left">Bibliophile with a Deciphering Eye</td><td>311</td><td>18</td><td>40</td></tr>
<tr><td>170</td><td>175</td><td>182</td><td class="left">The Bridge People No Longer Cross</td><td>301</td><td>30</td><td>28</td></tr>
<tr><td>171</td><td>166</td><td>165</td><td class="left">Diao ye zong (Withered Leaf)</td><td>295</td><td>29</td><td>21</td></tr>
<tr><td>172</td><td>161</td><td>169</td><td class="left">Song of the Night Sparrow ~ Night Bird</td><td>291</td><td>30</td><td>28</td></tr>
<tr><td>173</td><td>165</td><td>174</td><td class="left">Youkai Domination ~ Who done it?</td><td>290</td><td>13</td><td>25</td></tr>
<tr><td>174</td><td>172</td><td>152</td><td class="left">Battlefield of the Flower Threshold</td><td>289</td><td>25</td><td>35</td></tr>
<tr><td>175</td><td>158</td><td>163</td><td class="left">Alice Maestra</td><td>287</td><td>18</td><td>27</td></tr>
<tr><td>176</td><td>178</td><td>177</td><td class="left">Legendary Illusion ~ Infinite Being</td><td>285</td><td>24</td><td>27</td></tr>
<tr><td>177</td><td>176</td><td>159</td><td class="left">A Never-Before-Seen World of Nightmares</td><td>280</td><td>24</td><td>33</td></tr>
<tr><td>178</td><td>-</td><td>-</td><td class="left">Tortoise Dragon ~ Fortune and Misfortune</td><td>275</td><td>17</td><td>47</td></tr>
<tr><td>179</td><td>185</td><td>171</td><td class="left">Rigid Paradise</td><td>273</td><td>19</td><td>16</td></tr>
<tr><td>180</td><td>120</td><td>-</td><td class="left">Nightmare Diary</td><td>269</td><td>12</td><td>44</td></tr>
<tr><td>181</td><td>174</td><td>167</td><td class="left">The Shining Needle Castle Sinking in the Air</td><td>263</td><td>24</td><td>26</td></tr>
<tr><td>182</td><td>159</td><td>223</td><td class="left">Unknown Flower, Mesmerizing Journey</td><td>260</td><td>12</td><td>32</td></tr>
<tr><td>182</td><td>155</td><td>161</td><td class="left">Our Hisoutensoku</td><td>260</td><td>7</td><td>22</td></tr>
<tr><td>184</td><td>164</td><td>173</td><td class="left">Stirring an Autumn Moon ~ Mooned Insect</td><td>259</td><td>37</td><td>21</td></tr>
<tr><td>185</td><td>167</td><td>155</td><td class="left">Dullahan Under the Willows</td><td>255</td><td>19</td><td>11</td></tr>
<tr><td>186</td><td>169</td><td>177</td><td class="left">Magical Girl's Crusade</td><td>253</td><td>21</td><td>32</td></tr>
<tr><td>187</td><td>168</td><td>176</td><td class="left">Crimson in the Black Sea ~ Legendary Fish</td><td>249</td><td>21</td><td>22</td></tr>
<tr><td>188</td><td>187</td><td>180</td><td class="left">A God That Misses People ~ Romantic Fall</td><td>247</td><td>12</td><td>31</td></tr>
<tr><td>189</td><td>160</td><td>129</td><td class="left">Yorimashi Between Dreams and Reality ~ Necro-Fantasia</td><td>245</td><td>12</td><td>23</td></tr>
<tr><td>190</td><td>181</td><td>172</td><td class="left">Youkai Domination</td><td>243</td><td>22</td><td>20</td></tr>
<tr><td>191</td><td>169</td><td>144</td><td class="left">The Ground's Color is Yellow</td><td>241</td><td>11</td><td>25</td></tr>
<tr><td>192</td><td>188</td><td>183</td><td class="left">Cemetery of Onbashira ~ Grave of Being</td><td>240</td><td>12</td><td>28</td></tr>
<tr><td>193</td><td>189</td><td>189</td><td class="left">Eastern Mystical Love Consultation</td><td>238</td><td>13</td><td>27</td></tr>
<tr><td>194</td><td>195</td><td>184</td><td class="left">Magician's Melancholy</td><td>236</td><td>23</td><td>31</td></tr>
<tr><td>195</td><td>191</td><td>193</td><td class="left">The Dark Blowhole</td><td>233</td><td>19</td><td>27</td></tr>
<tr><td>196</td><td>195</td><td>207</td><td class="left">The Flowers Remain in Fantasy</td><td>232</td><td>22</td><td>31</td></tr>
<tr><td>197</td><td>185</td><td>186</td><td class="left">Enigmatic Doll</td><td>229</td><td>24</td><td>34</td></tr>
<tr><td>197</td><td>182</td><td>188</td><td class="left">Mist Lake</td><td>229</td><td>13</td><td>23</td></tr>
<tr><td>199</td><td>184</td><td>185</td><td class="left">Let's Live in a Lovely Cemetery</td><td>227</td><td>12</td><td>29</td></tr>
<tr><td>199</td><td>213</td><td>203</td><td class="left">Shinkirou Orchestra</td><td>227</td><td>12</td><td>15</td></tr>
<tr><td>201</td><td>205</td><td>199</td><td class="left">Illusionary Night ~ Ghostly Eyes</td><td>219</td><td>17</td><td>17</td></tr>
<tr><td>201</td><td>194</td><td>199</td><td class="left">G Free</td><td>219</td><td>15</td><td>31</td></tr>
<tr><td>203</td><td>199</td><td>195</td><td class="left">Cute Devil ~ Innocence</td><td>217</td><td>20</td><td>24</td></tr>
<tr><td>204</td><td>192</td><td>201</td><td class="left">Mermaid from the Uncharted Land</td><td>209</td><td>11</td><td>20</td></tr>
<tr><td>205</td><td>180</td><td>194</td><td class="left">Hellfire Mantle</td><td>207</td><td>10</td><td>18</td></tr>
<tr><td>206</td><td>216</td><td>222</td><td class="left">Complete Darkness</td><td>203</td><td>14</td><td>26</td></tr>
<tr><td>207</td><td>198</td><td>187</td><td class="left">Izanagi Object</td><td>195</td><td>18</td><td>23</td></tr>
<tr><td>208</td><td>216</td><td>231</td><td class="left">Gathering the Mysterious from All Around Japan</td><td>194</td><td>18</td><td>27</td></tr>
<tr><td>208</td><td>197</td><td>206</td><td class="left">Welcome to the Moon Tour</td><td>194</td><td>10</td><td>27</td></tr>
<tr><td>210</td><td>199</td><td>189</td><td class="left">Did You See That Shadow?</td><td>193</td><td>5</td><td>24</td></tr>
<tr><td>211</td><td>202</td><td>205</td><td class="left">Sunny Milk's Scarlet Mist Incident</td><td>190</td><td>11</td><td>32</td></tr>
<tr><td>212</td><td>226</td><td>221</td><td class="left">Celestial Wizardry ~ Magical Astronomy</td><td>189</td><td>7</td><td>15</td></tr>
<tr><td>213</td><td>204</td><td>192</td><td class="left">White Flag of Usa Shrine</td><td>185</td><td>10</td><td>17</td></tr>
<tr><td>214</td><td>211</td><td>218</td><td class="left">Poison Body ~ Forsaken Doll</td><td>184</td><td>7</td><td>18</td></tr>
<tr><td>215</td><td>231</td><td>234</td><td class="left">An Eternity that Is More Transient than Scarlet</td><td>183</td><td>11</td><td>6</td></tr>
<tr><td>216</td><td>-</td><td>-</td><td class="left">The Lamentations Known Only by Jizo</td><td>178</td><td>14</td><td>31</td></tr>
<tr><td>216</td><td>207</td><td>212</td><td class="left">Merry the Magician</td><td>178</td><td>10</td><td>17</td></tr>
<tr><td>218</td><td>220</td><td>189</td><td class="left">The Mysterious Shrine Maiden Flying Through Space</td><td>176</td><td>11</td><td>26</td></tr>
<tr><td>218</td><td>233</td><td>224</td><td class="left">Schrödinger's Bakeneko</td><td>176</td><td>6</td><td>18</td></tr>
<tr><td>220</td><td>229</td><td>215</td><td class="left">Wind of Agartha</td><td>175</td><td>16</td><td>35</td></tr>
<tr><td>221</td><td>201</td><td>179</td><td class="left">Lonesome Werewolf</td><td>173</td><td>10</td><td>15</td></tr>
<tr><td>222</td><td>203</td><td>238</td><td class="left">The Purest Sky and Sea</td><td>171</td><td>16</td><td>26</td></tr>
<tr><td>223</td><td>254</td><td>254</td><td class="left">Theme of Eastern Story</td><td>170</td><td>19</td><td>27</td></tr>
<tr><td>224</td><td>209</td><td>211</td><td class="left">Youkai Back Shrine Road</td><td>168</td><td>11</td><td>32</td></tr>
<tr><td>224</td><td>206</td><td>209</td><td class="left">Strange Bird of the Moon, Illusion of the Mysterious Cat</td><td>168</td><td>11</td><td>11</td></tr>
<tr><td>226</td><td>221</td><td>235</td><td class="left">Tabula rasa ~ The Empty Girl</td><td>165</td><td>11</td><td>21</td></tr>
<tr><td>226</td><td>210</td><td>198</td><td class="left">The Traditional Old Man and the Stylish Girl</td><td>165</td><td>8</td><td>15</td></tr>
<tr><td>228</td><td>237</td><td>227</td><td class="left">Curious old Shanghai tile</td><td>164</td><td>22</td><td>21</td></tr>
<tr><td>229</td><td>224</td><td>238</td><td class="left">Eternal Night Vignette ~ Eastern Night.</td><td>161</td><td>11</td><td>12</td></tr>
<tr><td>229</td><td>235</td><td>214</td><td class="left">Sleeping Terror</td><td>161</td><td>7</td><td>22</td></tr>
<tr><td>231</td><td>240</td><td>248</td><td class="left">The Strange Everyday Life of the Flying Shrine Maiden</td><td>159</td><td>16</td><td>20</td></tr>
<tr><td>232</td><td>226</td><td>231</td><td class="left">Mystical Maple ~ Eternal Dream</td><td>156</td><td>6</td><td>14</td></tr>
<tr><td>233</td><td>208</td><td>238</td><td class="left">Old Adam Bar</td><td>155</td><td>12</td><td>14</td></tr>
<tr><td>234</td><td>193</td><td>209</td><td class="left">Unforgettable, the Nostalgic Greenery</td><td>151</td><td>8</td><td>25</td></tr>
<tr><td>235</td><td>238</td><td>259</td><td class="left">The Far Side of the Moon</td><td>150</td><td>8</td><td>13</td></tr>
<tr><td>236</td><td>236</td><td>224</td><td class="left">Witch of Love Potion</td><td>144</td><td>12</td><td>25</td></tr>
<tr><td>237</td><td>225</td><td>219</td><td class="left">The Sealed-Away Youkai ~ Lost Place</td><td>142</td><td>17</td><td>19</td></tr>
<tr><td>237</td><td>183</td><td>153</td><td class="left">A Pair of Divine Beasts</td><td>142</td><td>5</td><td>19</td></tr>
<tr><td>239</td><td>222</td><td>237</td><td class="left">Year-Round Absorbed Curiosity</td><td>141</td><td>7</td><td>18</td></tr>
<tr><td>239</td><td>249</td><td>246</td><td class="left">Satellite TORIFUNE</td><td>141</td><td>7</td><td>14</td></tr>
<tr><td>241</td><td>214</td><td>213</td><td class="left">Staking Your Life on a Prank</td><td>138</td><td>4</td><td>12</td></tr>
<tr><td>242</td><td>229</td><td>228</td><td class="left">Blue Sea of 53 Minutes</td><td>135</td><td>14</td><td>13</td></tr>
<tr><td>243</td><td>214</td><td>224</td><td class="left">Romantic Escape Flight</td><td>133</td><td>7</td><td>9</td></tr>
<tr><td>244</td><td>-</td><td>-</td><td class="left">The Shining Law of the Strong Eating the Weak</td><td>131</td><td>4</td><td>15</td></tr>
<tr><td>245</td><td>233</td><td>235</td><td class="left">Plastic Mind</td><td>129</td><td>7</td><td>12</td></tr>
<tr><td>245</td><td>243</td><td>233</td><td class="left">Cheat Against the Impossible Danmaku</td><td>129</td><td>5</td><td>15</td></tr>
<tr><td>247</td><td>223</td><td>220</td><td class="left">Loose Rain</td><td>128</td><td>11</td><td>14</td></tr>
<tr><td>248</td><td>261</td><td>241</td><td class="left">Dying in the Dendera Fields in the Night</td><td>126</td><td>9</td><td>12</td></tr>
<tr><td>249</td><td>240</td><td>243</td><td class="left">Hangover of Bedfellows Dreaming Differently</td><td>124</td><td>11</td><td>17</td></tr>
<tr><td>249</td><td>244</td><td>208</td><td class="left">No More Going Through Doors</td><td>124</td><td>6</td><td>14</td></tr>
<tr><td>251</td><td>251</td><td>247</td><td class="left">Sealed Gods</td><td>123</td><td>6</td><td>13</td></tr>
<tr><td>252</td><td>211</td><td>216</td><td class="left">The Mystery in Your Town</td><td>121</td><td>6</td><td>8</td></tr>
<tr><td>253</td><td>249</td><td>270</td><td class="left">Flower Viewing Mound ~ Higan Retour</td><td>118</td><td>6</td><td>13</td></tr>
<tr><td>254</td><td>-</td><td>-</td><td class="left">Silent Beast Spirits</td><td>117</td><td>2</td><td>21</td></tr>
<tr><td>255</td><td>247</td><td>250</td><td class="left">Starry Sky of Small Desires</td><td>116</td><td>3</td><td>9</td></tr>
<tr><td>256</td><td>257</td><td>257</td><td class="left">Led On by a Cow to Visit Zenkou Temple</td><td>115</td><td>10</td><td>25</td></tr>
<tr><td>256</td><td>216</td><td>201</td><td class="left">Swim in a Cherry Blossom-Colored Sea</td><td>115</td><td>1</td><td>16</td></tr>
<tr><td>258</td><td>226</td><td>204</td><td class="left">A Midsummer Fairy's Dream</td><td>111</td><td>9</td><td>18</td></tr>
<tr><td>258</td><td>252</td><td>243</td><td class="left">A Drunkard's Lemuria</td><td>111</td><td>5</td><td>15</td></tr>
<tr><td>260</td><td>261</td><td>256</td><td class="left">The Refrain of the Lovely Great War</td><td>109</td><td>5</td><td>12</td></tr>
<tr><td>261</td><td>247</td><td>251</td><td class="left">Doll of Misery</td><td>108</td><td>7</td><td>14</td></tr>
<tr><td>261</td><td>242</td><td>242</td><td class="left">Japanese Saga</td><td>108</td><td>5</td><td>10</td></tr>
<tr><td>263</td><td>244</td><td>253</td><td class="left">Youkai Modern Colony</td><td>107</td><td>3</td><td>16</td></tr>
<tr><td>263</td><td>238</td><td>196</td><td class="left">Does the Forbidden Door Lead to This World, or the World Beyond?</td><td>107</td><td>2</td><td>12</td></tr>
<tr><td>265</td><td>216</td><td>197</td><td class="left">The Magic Straw-Hat Ksitigarbha</td><td>104</td><td>6</td><td>11</td></tr>
<tr><td>266</td><td>246</td><td>254</td><td class="left">Border Between Dreams and Reality</td><td>100</td><td>10</td><td>20</td></tr>
<tr><td>267</td><td>272</td><td>266</td><td class="left">Youkai Space Travel</td><td>99</td><td>8</td><td>15</td></tr>
<tr><td>267</td><td>261</td><td>275</td><td class="left">Swordsman of a Distant Star / Angel of a Distant Star</td><td>99</td><td>5</td><td>14</td></tr>
<tr><td>269</td><td>258</td><td>245</td><td class="left">Green Sanatorium</td><td>98</td><td>6</td><td>9</td></tr>
<tr><td>270</td><td>253</td><td>271</td><td class="left">Sky Ruin</td><td>97</td><td>7</td><td>14</td></tr>
<tr><td>270</td><td>189</td><td>-</td><td class="left">Lunatic Dreamer</td><td>97</td><td>3</td><td>18</td></tr>
<tr><td>272</td><td>255</td><td>248</td><td class="left">Desire Dream</td><td>95</td><td>4</td><td>12</td></tr>
<tr><td>273</td><td>232</td><td>278</td><td class="left">Bamboo Forest in Flames</td><td>94</td><td>5</td><td>12</td></tr>
<tr><td>273</td><td>278</td><td>289</td><td class="left">Illusory Science ~ Doll's Phantom</td><td>94</td><td>2</td><td>13</td></tr>
<tr><td>275</td><td>255</td><td>230</td><td class="left">Futatsuiwa from Gensokyo</td><td>92</td><td>1</td><td>8</td></tr>
<tr><td>276</td><td>271</td><td>261</td><td class="left">Dr. Latency's Sleepless Eyes</td><td>91</td><td>3</td><td>12</td></tr>
<tr><td>277</td><td>281</td><td>289</td><td class="left">Mechanical Circus ~ Reverie</td><td>90</td><td>9</td><td>15</td></tr>
<tr><td>277</td><td>309</td><td>283</td><td class="left">The Space Shrine Maiden Appears</td><td>90</td><td>4</td><td>6</td></tr>
<tr><td>277</td><td>269</td><td>252</td><td class="left">Fragrant Plants</td><td>90</td><td>3</td><td>5</td></tr>
<tr><td>280</td><td>267</td><td>278</td><td class="left">Treacherous Maiden ~ Judas Kiss</td><td>88</td><td>6</td><td>8</td></tr>
<tr><td>281</td><td>261</td><td>265</td><td class="left">Skygazer</td><td>87</td><td>5</td><td>18</td></tr>
<tr><td>282</td><td>266</td><td>261</td><td class="left">Ghost Lead</td><td>86</td><td>0</td><td>14</td></tr>
<tr><td>282</td><td>260</td><td>281</td><td class="left">Awakening of the Earth Spirits</td><td>86</td><td>0</td><td>9</td></tr>
<tr><td>284</td><td>333</td><td>333</td><td class="left">Fantasy Corridor</td><td>85</td><td>7</td><td>14</td></tr>
<tr><td>285</td><td>274</td><td>274</td><td class="left">Star Voyage 2,008</td><td>84</td><td>8</td><td>10</td></tr>
<tr><td>285</td><td>287</td><td>301</td><td class="left">the Last Judgement</td><td>84</td><td>6</td><td>14</td></tr>
<tr><td>287</td><td>269</td><td>296</td><td class="left">Girl's Divinity ~ Pandora's Box</td><td>83</td><td>4</td><td>17</td></tr>
<tr><td>288</td><td>274</td><td>294</td><td class="left">Tengu is Watching ~ Black Eyes</td><td>81</td><td>4</td><td>8</td></tr>
<tr><td>289</td><td>308</td><td>328</td><td class="left">Magic Mirror</td><td>80</td><td>12</td><td>12</td></tr>
<tr><td>289</td><td>306</td><td>331</td><td class="left">Maple Wise</td><td>80</td><td>10</td><td>11</td></tr>
<tr><td>289</td><td>338</td><td>289</td><td class="left">Player's Score</td><td>80</td><td>3</td><td>9</td></tr>
<tr><td>292</td><td>274</td><td>275</td><td class="left">Watatsuki's Spell Card ~ Lunatic Blue</td><td>79</td><td>7</td><td>4</td></tr>
<tr><td>292</td><td>285</td><td>319</td><td class="left">Peaceful Romancer</td><td>79</td><td>6</td><td>18</td></tr>
<tr><td>294</td><td>259</td><td>271</td><td class="left">Strange, Strange Instruments</td><td>78</td><td>6</td><td>16</td></tr>
<tr><td>295</td><td>285</td><td>283</td><td class="left">Thunderclouds of Magical Power</td><td>77</td><td>5</td><td>13</td></tr>
<tr><td>295</td><td>268</td><td>264</td><td class="left">Argue for and Against</td><td>77</td><td>0</td><td>4</td></tr>
<tr><td>297</td><td>290</td><td>283</td><td class="left">Boys and Girls of a Science Era</td><td>76</td><td>6</td><td>6</td></tr>
<tr><td>297</td><td>-</td><td>-</td><td class="left">The Stone Baby and the Submerged Bovine</td><td>76</td><td>2</td><td>14</td></tr>
<tr><td>299</td><td>296</td><td>310</td><td class="left">The Tank Girl's Dream</td><td>75</td><td>7</td><td>10</td></tr>
<tr><td>299</td><td>290</td><td>321</td><td class="left">Flower of Past Days ~ Fairy of Flower</td><td>75</td><td>3</td><td>14</td></tr>
<tr><td>299</td><td>326</td><td>292</td><td class="left">A Dream Transcending Space-time</td><td>75</td><td>3</td><td>11</td></tr>
<tr><td>302</td><td>281</td><td>268</td><td class="left">Dancing Water Spray</td><td>73</td><td>3</td><td>5</td></tr>
<tr><td>302</td><td>283</td><td>292</td><td class="left">Tengu's Notebook ~ Mysterious Note</td><td>73</td><td>3</td><td>5</td></tr>
<tr><td>304</td><td>298</td><td>308</td><td class="left">Returning Home From the Sky ~ Sky Dream</td><td>70</td><td>1</td><td>13</td></tr>
<tr><td>305</td><td>272</td><td>277</td><td class="left">Illusionary Sputnik Night</td><td>68</td><td>1</td><td>9</td></tr>
<tr><td>306</td><td>323</td><td>283</td><td class="left">Shrine of the Wind</td><td>65</td><td>7</td><td>10</td></tr>
<tr><td>306</td><td>290</td><td>325</td><td class="left">AN ORDEAL FROM GOD</td><td>65</td><td>4</td><td>10</td></tr>
<tr><td>306</td><td>296</td><td>261</td><td class="left">The Sky Where Cherry Blossoms Flutter Down</td><td>65</td><td>1</td><td>6</td></tr>
<tr><td>309</td><td>298</td><td>281</td><td class="left">Lotus Love</td><td>64</td><td>4</td><td>12</td></tr>
<tr><td>309</td><td>290</td><td>273</td><td class="left">The Inevitably Forbidden Game</td><td>64</td><td>4</td><td>7</td></tr>
<tr><td>309</td><td>290</td><td>283</td><td class="left">Trojan Asteroid Jungle</td><td>64</td><td>3</td><td>8</td></tr>
<tr><td>312</td><td>290</td><td>301</td><td class="left">Dim. Dream</td><td>63</td><td>2</td><td>7</td></tr>
<tr><td>313</td><td>278</td><td>304</td><td class="left">The Lake Reflects the Cleansed Moonlight</td><td>61</td><td>2</td><td>9</td></tr>
<tr><td>314</td><td>326</td><td>297</td><td class="left">Illusion of a Maid ~ Icemilk Magic</td><td>60</td><td>3</td><td>6</td></tr>
<tr><td>314</td><td>313</td><td>321</td><td class="left">Dream of Arcadia</td><td>60</td><td>2</td><td>9</td></tr>
<tr><td>314</td><td>331</td><td>328</td><td class="left">The Gods Give Us Blessed Rain ~ Sylphid Dream</td><td>60</td><td>1</td><td>7</td></tr>
<tr><td>317</td><td>304</td><td>333</td><td class="left">Legend of Aokigahara</td><td>58</td><td>5</td><td>4</td></tr>
<tr><td>317</td><td>287</td><td>310</td><td class="left">Magical Storm</td><td>58</td><td>4</td><td>9</td></tr>
<tr><td>317</td><td>317</td><td>314</td><td class="left">Wind Circulation ~ Wind Tour</td><td>58</td><td>2</td><td>8</td></tr>
<tr><td>317</td><td>306</td><td>257</td><td class="left">Outside World Folklore</td><td>58</td><td>1</td><td>5</td></tr>
<tr><td>321</td><td>298</td><td>325</td><td class="left">Hourai Illusion ~ far East</td><td>57</td><td>4</td><td>9</td></tr>
<tr><td>321</td><td>-</td><td>-</td><td class="left">Lost River</td><td>57</td><td>2</td><td>12</td></tr>
<tr><td>323</td><td>278</td><td>316</td><td class="left">Silk Road Alice</td><td>56</td><td>5</td><td>10</td></tr>
<tr><td>323</td><td>318</td><td>316</td><td class="left">Spirit of Avarice</td><td>56</td><td>4</td><td>8</td></tr>
<tr><td>323</td><td>309</td><td>298</td><td class="left">Youkai Girl at the Gate</td><td>56</td><td>4</td><td>5</td></tr>
<tr><td>323</td><td>274</td><td>229</td><td class="left">Into Backdoor</td><td>56</td><td>3</td><td>6</td></tr>
<tr><td>323</td><td>318</td><td>352</td><td class="left">The Darkness Brought In by Swallowstone Naturalis Historia</td><td>56</td><td>2</td><td>7</td></tr>
<tr><td>323</td><td>323</td><td>288</td><td class="left">Evening Primrose</td><td>56</td><td>2</td><td>3</td></tr>
<tr><td>323</td><td>370</td><td>333</td><td class="left">The Barrier of Ame-no-torifune Shrine</td><td>56</td><td>1</td><td>15</td></tr>
<tr><td>330</td><td>313</td><td>319</td><td class="left">Sunny Rutile Flection</td><td>55</td><td>4</td><td>6</td></tr>
<tr><td>330</td><td>318</td><td>333</td><td class="left">Eastern Strange Discourse</td><td>55</td><td>3</td><td>4</td></tr>
<tr><td>332</td><td>298</td><td>310</td><td class="left">A Land Resplendent With Nature's Beauty</td><td>54</td><td>6</td><td>16</td></tr>
<tr><td>332</td><td>328</td><td>347</td><td class="left">Darkening Dusk</td><td>54</td><td>5</td><td>0</td></tr>
<tr><td>332</td><td>343</td><td>305</td><td class="left">Humans and Youkai Traversing the Canal</td><td>54</td><td>4</td><td>6</td></tr>
<tr><td>335</td><td>360</td><td>342</td><td class="left">Maple Dream...</td><td>53</td><td>7</td><td>9</td></tr>
<tr><td>335</td><td>343</td><td>321</td><td class="left">Child of Are</td><td>53</td><td>7</td><td>6</td></tr>
<tr><td>335</td><td>350</td><td>345</td><td class="left">A Shadow in the Blue Sky</td><td>53</td><td>4</td><td>6</td></tr>
<tr><td>335</td><td>304</td><td>339</td><td class="left">Civilization of Magic / We Shall Die Together</td><td>53</td><td>3</td><td>7</td></tr>
<tr><td>335</td><td>346</td><td>301</td><td class="left">Raise the Signal Fire of Cheating</td><td>53</td><td>2</td><td>4</td></tr>
<tr><td>340</td><td>318</td><td>333</td><td class="left">Sailor of Time</td><td>52</td><td>4</td><td>7</td></tr>
<tr><td>340</td><td>338</td><td>358</td><td class="left">End of Daylight</td><td>52</td><td>3</td><td>8</td></tr>
<tr><td>340</td><td>-</td><td>-</td><td class="left">Everlasting Red Spider Lily</td><td>52</td><td>2</td><td>13</td></tr>
<tr><td>340</td><td>283</td><td>333</td><td class="left">Can't Sleep Because It's Nighttime</td><td>52</td><td>2</td><td>9</td></tr>
<tr><td>344</td><td>360</td><td>321</td><td class="left">Ame-no-torifune Shrine</td><td>51</td><td>3</td><td>8</td></tr>
<tr><td>344</td><td>261</td><td>216</td><td class="left">Sleep Sheep Parade</td><td>51</td><td>3</td><td>5</td></tr>
<tr><td>346</td><td>313</td><td>305</td><td class="left">The Sealed Cloud Route</td><td>50</td><td>2</td><td>8</td></tr>
<tr><td>346</td><td>313</td><td>331</td><td class="left">Welcome to Youkai Temple</td><td>50</td><td>2</td><td>5</td></tr>
<tr><td>348</td><td>356</td><td>325</td><td class="left">Dream Land</td><td>49</td><td>4</td><td>11</td></tr>
<tr><td>349</td><td>328</td><td>352</td><td class="left">Scarlet Symphony ~ Scarlet Phoneme</td><td>48</td><td>2</td><td>8</td></tr>
<tr><td>349</td><td>318</td><td>259</td><td class="left">Occult à la Carte</td><td>48</td><td>2</td><td>4</td></tr>
<tr><td>351</td><td>366</td><td>369</td><td class="left">Forest of Dolls</td><td>47</td><td>4</td><td>11</td></tr>
<tr><td>351</td><td>333</td><td>308</td><td class="left">Outsider Cocktail</td><td>47</td><td>4</td><td>7</td></tr>
<tr><td>351</td><td>366</td><td>363</td><td class="left">A Sacred Lot</td><td>47</td><td>0</td><td>7</td></tr>
<tr><td>354</td><td>370</td><td>352</td><td class="left">Ancient Temple of the Netherworld</td><td>46</td><td>6</td><td>6</td></tr>
<tr><td>354</td><td>350</td><td>358</td><td class="left">Hakurei ~ Eastern Wind </td><td>46</td><td>1</td><td>8</td></tr>
<tr><td>356</td><td>312</td><td>316</td><td class="left">Dream Express</td><td>45</td><td>6</td><td>6</td></tr>
<tr><td>356</td><td>298</td><td>280</td><td class="left">憑依華（OP曲）</td><td>45</td><td>4</td><td>6</td></tr>
<tr><td>356</td><td>333</td><td>340</td><td class="left">Magic Shop of Raspberry</td><td>45</td><td>3</td><td>10</td></tr>
<tr><td>356</td><td>287</td><td>266</td><td class="left">White Traveler</td><td>45</td><td>0</td><td>6</td></tr>
<tr><td>360</td><td>350</td><td>358</td><td class="left">Visionary Game ~ Dream War</td><td>43</td><td>6</td><td>3</td></tr>
<tr><td>360</td><td>333</td><td>315</td><td class="left">Herselves</td><td>43</td><td>2</td><td>9</td></tr>
<tr><td>360</td><td>350</td><td>328</td><td class="left">Energy Daybreak ~ Future Dream...</td><td>43</td><td>1</td><td>3</td></tr>
<tr><td>363</td><td>298</td><td>347</td><td class="left">Witching Dream</td><td>42</td><td>5</td><td>5</td></tr>
<tr><td>364</td><td>366</td><td>377</td><td class="left">The Mound Where the Flowers Reflect</td><td>41</td><td>2</td><td>3</td></tr>
<tr><td>364</td><td>411</td><td>399</td><td class="left">Eternal Full Moon</td><td>41</td><td>0</td><td>1</td></tr>
<tr><td>366</td><td>323</td><td>340</td><td class="left">Fly above Hatoyama at night</td><td>40</td><td>1</td><td>5</td></tr>
<tr><td>366</td><td>311</td><td>268</td><td class="left">Deep-Mountain Encounter</td><td>40</td><td>0</td><td>5</td></tr>
<tr><td>368</td><td>346</td><td>365</td><td class="left">Velvet Maiden Battle ~ Velvet Battle</td><td>38</td><td>3</td><td>9</td></tr>
<tr><td>368</td><td>338</td><td>365</td><td class="left">False Strawberry</td><td>38</td><td>3</td><td>6</td></tr>
<tr><td>370</td><td>350</td><td>377</td><td class="left">Flower of Soul ~ Another Dream...</td><td>37</td><td>2</td><td>5</td></tr>
<tr><td>370</td><td>383</td><td>352</td><td class="left">Midnight Spell Card</td><td>37</td><td>0</td><td>4</td></tr>
<tr><td>372</td><td>343</td><td>356</td><td class="left">Like the Brilliance of Fairies</td><td>36</td><td>3</td><td>2</td></tr>
<tr><td>373</td><td>338</td><td>299</td><td class="left">The Taboo Membrane Wall</td><td>35</td><td>1</td><td>3</td></tr>
<tr><td>374</td><td>349</td><td>392</td><td class="left">Forbidden Magic</td><td>34</td><td>2</td><td>2</td></tr>
<tr><td>374</td><td>359</td><td>387</td><td class="left">Shrine at the Foot of the Mountain</td><td>34</td><td>1</td><td>4</td></tr>
<tr><td>374</td><td>461</td><td>394</td><td class="left">Gensokyo ~ Lotus Land Story</td><td>34</td><td>1</td><td>3</td></tr>
<tr><td>377</td><td>395</td><td>413</td><td class="left">This Dull World's Unchanging Pessimism</td><td>33</td><td>1</td><td>2</td></tr>
<tr><td>378</td><td>377</td><td>385</td><td class="left">The Gensokyo That Floats in Outer Space</td><td>32</td><td>2</td><td>5</td></tr>
<tr><td>378</td><td>418</td><td>350</td><td class="left">Adventurer's Tavern of the Old World</td><td>32</td><td>2</td><td>5</td></tr>
<tr><td>378</td><td>381</td><td>365</td><td class="left">An Ice Fairy in Spring</td><td>32</td><td>2</td><td>4</td></tr>
<tr><td>378</td><td>397</td><td>413</td><td class="left">Drunk as I Like</td><td>32</td><td>2</td><td>4</td></tr>
<tr><td>378</td><td>366</td><td>382</td><td class="left">Himorogi, Burn in Violet </td><td>32</td><td>2</td><td>3</td></tr>
<tr><td>378</td><td>346</td><td>299</td><td class="left">The Colorless Wind on Youkai Mountain</td><td>32</td><td>1</td><td>4</td></tr>
<tr><td>378</td><td>333</td><td>342</td><td class="left">Magician of the Twilight</td><td>32</td><td>1</td><td>4</td></tr>
<tr><td>385</td><td>373</td><td>381</td><td class="left">Dreamy pilot</td><td>31</td><td>2</td><td>8</td></tr>
<tr><td>385</td><td>350</td><td>305</td><td class="left">Bell of the Antipodes</td><td>31</td><td>2</td><td>5</td></tr>
<tr><td>385</td><td>356</td><td>363</td><td class="left">The Earth Spirits' Homecoming</td><td>31</td><td>1</td><td>6</td></tr>
<tr><td>385</td><td>370</td><td>365</td><td class="left">Spirit Battle ~ Perdition crisis</td><td>31</td><td>1</td><td>3</td></tr>
<tr><td>389</td><td>389</td><td>433</td><td class="left">Crescent Dream</td><td>30</td><td>4</td><td>7</td></tr>
<tr><td>390</td><td>397</td><td>394</td><td class="left">The Positive and Negative</td><td>29</td><td>3</td><td>4</td></tr>
<tr><td>390</td><td>360</td><td>369</td><td class="left">Eternal Festival of Illusions</td><td>29</td><td>1</td><td>6</td></tr>
<tr><td>390</td><td>356</td><td>375</td><td class="left">The Exaggerated Castle Keep</td><td>29</td><td>0</td><td>2</td></tr>
<tr><td>393</td><td>338</td><td>358</td><td class="left">Decoration Battle</td><td>28</td><td>5</td><td>8</td></tr>
<tr><td>393</td><td>383</td><td>408</td><td class="left">Dimension of Reverie</td><td>28</td><td>1</td><td>2</td></tr>
<tr><td>393</td><td>383</td><td>385</td><td class="left">X, the Floating Objects in the Sky</td><td>28</td><td>0</td><td>2</td></tr>
<tr><td>396</td><td>377</td><td>350</td><td class="left">Two Worlds</td><td>27</td><td>3</td><td>4</td></tr>
<tr><td>396</td><td>397</td><td>399</td><td class="left">Hakurei Shrine Grounds</td><td>27</td><td>2</td><td>5</td></tr>
<tr><td>396</td><td>375</td><td>349</td><td class="left">The Instant is Shorter Than Planck Time</td><td>27</td><td>0</td><td>6</td></tr>
<tr><td>399</td><td>411</td><td>421</td><td class="left">Castle Explorer -in the Sky-</td><td>26</td><td>4</td><td>10</td></tr>
<tr><td>399</td><td>373</td><td>344</td><td class="left">Nemesis' Stronghold</td><td>26</td><td>1</td><td>3</td></tr>
<tr><td>399</td><td>383</td><td>345</td><td class="left">Heart-Stirring Urban Legends</td><td>26</td><td>0</td><td>4</td></tr>
<tr><td>402</td><td>389</td><td>387</td><td class="left">Crimson Maiden ~ Crimson Dead!!</td><td>25</td><td>3</td><td>3</td></tr>
<tr><td>402</td><td>397</td><td>429</td><td class="left">Sacred Battle</td><td>25</td><td>2</td><td>11</td></tr>
<tr><td>402</td><td>383</td><td>375</td><td class="left">Angel's Legend</td><td>25</td><td>1</td><td>2</td></tr>
<tr><td>402</td><td>407</td><td>387</td><td class="left">Disunified Field Theory of Magic</td><td>25</td><td>1</td><td>1</td></tr>
<tr><td>406</td><td>431</td><td>408</td><td class="left">The Moon as Seen from the Shrine</td><td>24</td><td>2</td><td>2</td></tr>
<tr><td>406</td><td>377</td><td>382</td><td class="left">Legendary Wonderland</td><td>24</td><td>1</td><td>6</td></tr>
<tr><td>406</td><td>383</td><td>369</td><td class="left">Swift Battle</td><td>24</td><td>1</td><td>3</td></tr>
<tr><td>406</td><td>389</td><td>358</td><td class="left">The Scenery of Living Dolls</td><td>24</td><td>1</td><td>0</td></tr>
<tr><td>406</td><td>414</td><td>399</td><td class="left">The Space Shrine Maiden Returns Home</td><td>24</td><td>0</td><td>2</td></tr>
<tr><td>406</td><td>360</td><td>373</td><td class="left">Skies Beyond the Clouds</td><td>24</td><td>0</td><td>2</td></tr>
<tr><td>412</td><td>407</td><td>421</td><td class="left">Power of Darkness </td><td>23</td><td>2</td><td>2</td></tr>
<tr><td>412</td><td>418</td><td>404</td><td class="left">Orphic Poetry ~ Pseudoclassic</td><td>23</td><td>1</td><td>7</td></tr>
<tr><td>412</td><td>402</td><td>394</td><td class="left">Extra Love</td><td>23</td><td>1</td><td>3</td></tr>
<tr><td>412</td><td>364</td><td>373</td><td class="left">A Rose Blooming in the Underworld</td><td>23</td><td>1</td><td>2</td></tr>
<tr><td>412</td><td>331</td><td>-</td><td class="left">Nightmare Journal</td><td>23</td><td>0</td><td>4</td></tr>
<tr><td>417</td><td>407</td><td>369</td><td class="left">The Fairies' Adventurous Tale</td><td>21</td><td>2</td><td>4</td></tr>
<tr><td>417</td><td>377</td><td>377</td><td class="left">Maniacal Princess</td><td>21</td><td>2</td><td>4</td></tr>
<tr><td>417</td><td>414</td><td>408</td><td class="left">Dream of a Spring Breeze</td><td>21</td><td>0</td><td>1</td></tr>
<tr><td>420</td><td>364</td><td>356</td><td class="left">A Huge Shadow and a Tiny Conclusion</td><td>20</td><td>3</td><td>3</td></tr>
<tr><td>421</td><td>414</td><td>397</td><td class="left">The Arcane Is Revealed</td><td>19</td><td>2</td><td>1</td></tr>
<tr><td>421</td><td>411</td><td>397</td><td class="left">She's in a temper!!</td><td>19</td><td>0</td><td>6</td></tr>
<tr><td>421</td><td>402</td><td>387</td><td class="left">Overcome a Thousand Trials</td><td>19</td><td>0</td><td>2</td></tr>
<tr><td>424</td><td>452</td><td>473</td><td class="left">Inventive City</td><td>18</td><td>1</td><td>7</td></tr>
<tr><td>424</td><td>402</td><td>444</td><td class="left">Morning Clouds</td><td>18</td><td>1</td><td>2</td></tr>
<tr><td>424</td><td>402</td><td>439</td><td class="left">Mound of Life</td><td>18</td><td>0</td><td>1</td></tr>
<tr><td>427</td><td>431</td><td>421</td><td class="left">the Legend of KAGE</td><td>17</td><td>3</td><td>1</td></tr>
<tr><td>427</td><td>423</td><td>452</td><td class="left">Illusionary Girl from Canaveral</td><td>17</td><td>1</td><td>2</td></tr>
<tr><td>427</td><td>389</td><td>-</td><td class="left">Lucid Dreamer</td><td>17</td><td>1</td><td>2</td></tr>
<tr><td>427</td><td>423</td><td>461</td><td class="left">Iris</td><td>17</td><td>1</td><td>0</td></tr>
<tr><td>427</td><td>442</td><td>417</td><td class="left">Winds of Time</td><td>17</td><td>0</td><td>4</td></tr>
<tr><td>427</td><td>414</td><td>399</td><td class="left">Blade of Banishment</td><td>17</td><td>0</td><td>3</td></tr>
<tr><td>427</td><td>461</td><td>473</td><td class="left">Officially-Sanctioned Twilight Newspaper</td><td>17</td><td>0</td><td>2</td></tr>
<tr><td>434</td><td>389</td><td>439</td><td class="left">The Hide-and-Seek Lifestyle at the Shrine</td><td>16</td><td>1</td><td>3</td></tr>
<tr><td>434</td><td>452</td><td>433</td><td class="left">End of the World ~ World's End</td><td>16</td><td>1</td><td>2</td></tr>
<tr><td>434</td><td>382</td><td>387</td><td class="left">Mushroom Waltz</td><td>16</td><td>0</td><td>2</td></tr>
<tr><td>434</td><td>397</td><td>404</td><td class="left">World of Empty Dreams </td><td>16</td><td>0</td><td>1</td></tr>
<tr><td>438</td><td>423</td><td>444</td><td class="left">Decisive Magic Battle! ~ Fight it out!</td><td>15</td><td>0</td><td>4</td></tr>
<tr><td>438</td><td>423</td><td>413</td><td class="left">Eastern Wind</td><td>15</td><td>0</td><td>2</td></tr>
<tr><td>438</td><td>442</td><td>473</td><td class="left">Eastern Recorded Sealing of a Demon ~ Pure Land Mandala</td><td>15</td><td>0</td><td>2</td></tr>
<tr><td>438</td><td>435</td><td>421</td><td class="left">Spiritual Heaven</td><td>15</td><td>0</td><td>2</td></tr>
<tr><td>442</td><td>418</td><td>421</td><td class="left">Starbow Dream</td><td>14</td><td>1</td><td>3</td></tr>
<tr><td>442</td><td>389</td><td>461</td><td class="left">Holy Knight of Orléans</td><td>14</td><td>1</td><td>2</td></tr>
<tr><td>442</td><td>423</td><td>408</td><td class="left">Newshound</td><td>14</td><td>1</td><td>1</td></tr>
<tr><td>442</td><td>328</td><td>377</td><td class="left">Shining Heavenly Armillary</td><td>14</td><td>0</td><td>4</td></tr>
<tr><td>442</td><td>423</td><td>433</td><td class="left">Magical and Hopeless</td><td>14</td><td>0</td><td>3</td></tr>
<tr><td>442</td><td>442</td><td>399</td><td class="left">Fair Scramble</td><td>14</td><td>0</td><td>0</td></tr>
<tr><td>448</td><td>407</td><td>439</td><td class="left">Magic of Life</td><td>13</td><td>1</td><td>5</td></tr>
<tr><td>448</td><td>435</td><td>417</td><td class="left">Wondrous Tales of Romance ~ Mystic Square</td><td>13</td><td>1</td><td>0</td></tr>
<tr><td>448</td><td>442</td><td>444</td><td class="left">Selene's light</td><td>13</td><td>0</td><td>1</td></tr>
<tr><td>448</td><td>423</td><td>404</td><td class="left">Magical Power of the Mallet</td><td>13</td><td>0</td><td>1</td></tr>
<tr><td>448</td><td>461</td><td>479</td><td class="left">Shuusou Gyoku ~ Clockworks</td><td>13</td><td>0</td><td>0</td></tr>
<tr><td>448</td><td>461</td><td>461</td><td class="left">Wanderings</td><td>13</td><td>0</td><td>0</td></tr>
<tr><td>454</td><td>-</td><td>-</td><td class="left">Returning Home from the Underground</td><td>12</td><td>0</td><td>5</td></tr>
<tr><td>454</td><td>435</td><td>429</td><td class="left">Eastern Recorded Sealing of a Demon ~ A Phantom's Boisterous Dance</td><td>12</td><td>0</td><td>2</td></tr>
<tr><td>454</td><td>519</td><td>498</td><td class="left">Primrose Shiver</td><td>12</td><td>0</td><td>2</td></tr>
<tr><td>454</td><td>402</td><td>392</td><td class="left">Ridiculous Game</td><td>12</td><td>0</td><td>0</td></tr>
<tr><td>458</td><td>489</td><td>489</td><td class="left">Bet on Death</td><td>11</td><td>2</td><td>0</td></tr>
<tr><td>458</td><td>423</td><td>452</td><td class="left">Antique Terror</td><td>11</td><td>1</td><td>3</td></tr>
<tr><td>458</td><td>435</td><td>429</td><td class="left">My Maid, Sweet Maid</td><td>11</td><td>1</td><td>2</td></tr>
<tr><td>458</td><td>452</td><td>408</td><td class="left">The Inverted Castle Lit by the Setting Sun</td><td>11</td><td>1</td><td>1</td></tr>
<tr><td>458</td><td>418</td><td>439</td><td class="left">Disastrous Gemini</td><td>11</td><td>0</td><td>1</td></tr>
<tr><td>458</td><td>375</td><td>310</td><td class="left">Immortal Red Soul</td><td>11</td><td>0</td><td>1</td></tr>
<tr><td>458</td><td>431</td><td>417</td><td class="left">Seven-Orb Collection Showdown</td><td>11</td><td>0</td><td>1</td></tr>
<tr><td>465</td><td>505</td><td>479</td><td class="left">Dream Machine ~ Innocent Power</td><td>10</td><td>2</td><td>2</td></tr>
<tr><td>465</td><td>472</td><td>452</td><td class="left">New Illusion ~ New Fantasy</td><td>10</td><td>1</td><td>2</td></tr>
<tr><td>465</td><td>472</td><td>404</td><td class="left">Highly Responsive to Prayers</td><td>10</td><td>1</td><td>1</td></tr>
<tr><td>465</td><td>442</td><td>479</td><td class="left">Frontal Attack</td><td>10</td><td>0</td><td>5</td></tr>
<tr><td>465</td><td>452</td><td>452</td><td class="left">Eternal Paradise</td><td>10</td><td>0</td><td>3</td></tr>
<tr><td>465</td><td>481</td><td>421</td><td class="left">The Ravine Kappa's Technological Prowess</td><td>10</td><td>0</td><td>3</td></tr>
<tr><td>465</td><td>452</td><td>421</td><td class="left">The Palanquin Ship Flies in the Sky</td><td>10</td><td>0</td><td>2</td></tr>
<tr><td>465</td><td>472</td><td>489</td><td class="left">Bad Omen</td><td>10</td><td>0</td><td>1</td></tr>
<tr><td>465</td><td>452</td><td>433</td><td class="left">An Ice Fairy in Spring - still -</td><td>10</td><td>0</td><td>1</td></tr>
<tr><td>465</td><td>435</td><td>444</td><td class="left">Usual Days</td><td>10</td><td>0</td><td>0</td></tr>
<tr><td>475</td><td>442</td><td>433</td><td class="left">A Popular Location</td><td>9</td><td>1</td><td>3</td></tr>
<tr><td>475</td><td>461</td><td>479</td><td class="left">Oriental Magician</td><td>9</td><td>1</td><td>1</td></tr>
<tr><td>475</td><td>505</td><td>479</td><td class="left">Constant and Unchanging Mazureum</td><td>9</td><td>0</td><td>4</td></tr>
<tr><td>475</td><td>461</td><td>461</td><td class="left">Plastic Space</td><td>9</td><td>0</td><td>3</td></tr>
<tr><td>475</td><td>461</td><td>461</td><td class="left">Illusion of Flowers, Air of Scarlet Dream</td><td>9</td><td>0</td><td>2</td></tr>
<tr><td>475</td><td>431</td><td>452</td><td class="left">Corridor Stretching to Eternity</td><td>9</td><td>0</td><td>1</td></tr>
<tr><td>475</td><td>395</td><td>417</td><td class="left">Phantasmagoria</td><td>9</td><td>0</td><td>1</td></tr>
<tr><td>475</td><td>-</td><td>-</td><td class="left">The Animals' Rest</td><td>9</td><td>0</td><td>0</td></tr>
<tr><td>475</td><td>519</td><td>452</td><td class="left">Game Over</td><td>9</td><td>0</td><td>0</td></tr>
<tr><td>484</td><td>442</td><td>444</td><td class="left">Warrior Maiden ~ Heart of Valkyrie</td><td>8</td><td>2</td><td>0</td></tr>
<tr><td>484</td><td>472</td><td>439</td><td class="left">Selection</td><td>8</td><td>1</td><td>3</td></tr>
<tr><td>484</td><td>489</td><td>498</td><td class="left">Each Ending</td><td>8</td><td>1</td><td>1</td></tr>
<tr><td>484</td><td>505</td><td>461</td><td class="left">Swing a Fish to Drive Away Flies</td><td>8</td><td>1</td><td>0</td></tr>
<tr><td>484</td><td>519</td><td>461</td><td class="left">The Moon</td><td>8</td><td>0</td><td>3</td></tr>
<tr><td>484</td><td>461</td><td>473</td><td class="left">Break the Sabbath</td><td>8</td><td>0</td><td>2</td></tr>
<tr><td>484</td><td>489</td><td>520</td><td class="left">Border Land</td><td>8</td><td>0</td><td>2</td></tr>
<tr><td>484</td><td>418</td><td>421</td><td class="left">Unexpected Visitor</td><td>8</td><td>0</td><td>1</td></tr>
<tr><td>484</td><td>489</td><td>461</td><td class="left">The Village in the Dead of Night</td><td>8</td><td>0</td><td>1</td></tr>
<tr><td>484</td><td>472</td><td>489</td><td class="left">Magic Formation ~ Magic Square</td><td>8</td><td>0</td><td>0</td></tr>
<tr><td>494</td><td>505</td><td>489</td><td class="left">Kioh Gyoku ~ Fairy Dance</td><td>7</td><td>1</td><td>1</td></tr>
<tr><td>494</td><td>452</td><td>429</td><td class="left">Gensokyo Mystery Discovery</td><td>7</td><td>1</td><td>0</td></tr>
<tr><td>494</td><td>452</td><td>382</td><td class="left">Firmament Army</td><td>7</td><td>0</td><td>3</td></tr>
<tr><td>494</td><td>435</td><td>461</td><td class="left">Soul's Resting Place</td><td>7</td><td>0</td><td>0</td></tr>
<tr><td>498</td><td>442</td><td>489</td><td class="left">The Value Is Unrealized</td><td>6</td><td>2</td><td>1</td></tr>
<tr><td>498</td><td>505</td><td>506</td><td class="left">Intermezzo</td><td>6</td><td>1</td><td>1</td></tr>
<tr><td>498</td><td>442</td><td>452</td><td class="left">Adoration of Magic</td><td>6</td><td>0</td><td>2</td></tr>
<tr><td>498</td><td>472</td><td>479</td><td class="left">Forms of Manifested Folklore</td><td>6</td><td>0</td><td>2</td></tr>
<tr><td>498</td><td>442</td><td>506</td><td class="left">Illusory Imperial Capital</td><td>6</td><td>0</td><td>2</td></tr>
<tr><td>498</td><td>461</td><td>444</td><td class="left">Silence</td><td>6</td><td>0</td><td>1</td></tr>
<tr><td>498</td><td>481</td><td>452</td><td class="left">Equality Under the Law of Dharma</td><td>6</td><td>0</td><td>1</td></tr>
<tr><td>498</td><td>519</td><td>506</td><td class="left">An Everyday Life with Balls</td><td>6</td><td>0</td><td>0</td></tr>
<tr><td>506</td><td>472</td><td>498</td><td class="left">Ghostly Person's Holiday</td><td>5</td><td>1</td><td>2</td></tr>
<tr><td>506</td><td>519</td><td>526</td><td class="left">Inner Heart</td><td>5</td><td>0</td><td>1</td></tr>
<tr><td>506</td><td>481</td><td>520</td><td class="left">Arcadian Dream</td><td>5</td><td>0</td><td>1</td></tr>
<tr><td>506</td><td>519</td><td>461</td><td class="left">Victory Demonstration</td><td>5</td><td>0</td><td>1</td></tr>
<tr><td>506</td><td>481</td><td>433</td><td class="left">The Legendary Titan</td><td>5</td><td>0</td><td>1</td></tr>
<tr><td>506</td><td>435</td><td>413</td><td class="left">The Curtain Shall Rise Soon</td><td>5</td><td>0</td><td>0</td></tr>
<tr><td>506</td><td>519</td><td>506</td><td class="left">Beautiful Nature Sight</td><td>5</td><td>0</td><td>0</td></tr>
<tr><td>506</td><td>472</td><td>473</td><td class="left">Scarlet Night</td><td>5</td><td>0</td><td>0</td></tr>
<tr><td>514</td><td>489</td><td>520</td><td class="left">Solitary Place</td><td>4</td><td>1</td><td>2</td></tr>
<tr><td>514</td><td>489</td><td>506</td><td class="left">Dream of Eternity</td><td>4</td><td>0</td><td>1</td></tr>
<tr><td>514</td><td>489</td><td>444</td><td class="left">Those Who Live in Illusions</td><td>4</td><td>0</td><td>1</td></tr>
<tr><td>514</td><td>461</td><td>498</td><td class="left">Shinto Shrine</td><td>4</td><td>0</td><td>1</td></tr>
<tr><td>514</td><td>519</td><td>506</td><td class="left">Those Who Know the Truth</td><td>4</td><td>0</td><td>0</td></tr>
<tr><td>514</td><td>505</td><td>506</td><td class="left">Arrival of the Winds of the Era</td><td>4</td><td>0</td><td>0</td></tr>
<tr><td>514</td><td>481</td><td>479</td><td class="left">Forest of Tono</td><td>4</td><td>0</td><td>0</td></tr>
<tr><td>514</td><td>472</td><td>479</td><td class="left">Mystic Dream</td><td>4</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>505</td><td>506</td><td class="left">Titled Maid</td><td>3</td><td>1</td><td>0</td></tr>
<tr><td>522</td><td>481</td><td>473</td><td class="left">In the Deep-Green Tanuki Forest</td><td>3</td><td>0</td><td>1</td></tr>
<tr><td>522</td><td>505</td><td>489</td><td class="left">Believe in Possibilities</td><td>3</td><td>0</td><td>1</td></tr>
<tr><td>522</td><td>481</td><td>498</td><td class="left">Sealed Demon's Finale</td><td>3</td><td>0</td><td>1</td></tr>
<tr><td>522</td><td>489</td><td>444</td><td class="left">Incomplete Plot</td><td>3</td><td>0</td><td>1</td></tr>
<tr><td>522</td><td>489</td><td>506</td><td class="left">Peaceful</td><td>3</td><td>0</td><td>1</td></tr>
<tr><td>522</td><td>489</td><td>506</td><td class="left">Lotus Road</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>481</td><td>526</td><td class="left">An Unpopular Location</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>505</td><td>461</td><td class="left">Unnatural Nature</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>452</td><td>461</td><td class="left">Youkai Temple</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>489</td><td>520</td><td class="left">An Unused Location</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>519</td><td>479</td><td class="left">Free and Easy</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>489</td><td>479</td><td class="left">Floating with the Tide</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>522</td><td>530</td><td>498</td><td class="left">A New Wind at the Shrine</td><td>3</td><td>0</td><td>0</td></tr>
<tr><td>536</td><td>505</td><td>452</td><td class="left">Endless</td><td>2</td><td>1</td><td>0</td></tr>
<tr><td>536</td><td>519</td><td>498</td><td class="left">Being Things Eye To Eye</td><td>2</td><td>0</td><td>0</td></tr>
<tr><td>536</td><td>489</td><td>489</td><td class="left">Days</td><td>2</td><td>0</td><td>0</td></tr>
<tr><td>536</td><td>461</td><td>489</td><td class="left">End of Summer</td><td>2</td><td>0</td><td>0</td></tr>
<tr><td>540</td><td>489</td><td>526</td><td class="left">Performer Selection</td><td>1</td><td>0</td><td>0</td></tr>
<tr><td>540</td><td>505</td><td>520</td><td class="left">Eastern Blue Sky</td><td>1</td><td>0</td><td>0</td></tr>
<tr><td>540</td><td>530</td><td>489</td><td class="left">Demonic Place</td><td>1</td><td>0</td><td>0</td></tr>
<tr><td>540</td><td>505</td><td>498</td><td class="left">Sunfall</td><td>1</td><td>0</td><td>0</td></tr>
<tr><td>540</td><td>489</td><td>506</td><td class="left">Scheming Outside the Box</td><td>1</td><td>0</td><td>0</td></tr>
                        </tbody>
                    </table>
                </div>
                <h1 id='works'>Works</h1>
                <div id='works_dummy' class='dummy'><div class='dummy_sub'></div></div>
                <div id='works_container' class='container'>
                    <table id='works_table' class='poll table sortable'>
                        <colgroup>
                            <!--<col class="col1">-->
                            <col class="col2game">
                            <col class="col3game">
                            <col class="col4game">
                            <col class="col5">
                            <col class="col6per">
                            <col class="col7per">
                            <col class="col8per">
                        </colgroup>
                        <thead>
                            <tr>
                                <!--<th id='works_head' class='head noborders sorttable_numeric'>#</th>-->
                                <th class='sorttable_numeric'>Rank</th>
                                <th class='sorttable_numeric'>2019 rank</th>
                                <th class='sorttable_numeric'>2018 rank</th>
                                <th>Name</th>
                                <th class='sorttable_numeric'>Points</th>
                                <th class='sorttable_numeric'>No. 1 Votes</th>
                                <th class='sorttable_numeric'>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
<tr><td>1</td><td>1</td><td>1</td><td class="left">EoSD</td><td>11,403</td><td>3,615</td><td>737</td></tr>
<tr><td>2</td><td>2</td><td>2</td><td class="left">IN</td><td>9,964</td><td>2,312</td><td>693</td></tr>
<tr><td>3</td><td>3</td><td>3</td><td class="left">PCB</td><td>8,646</td><td>1,889</td><td>579</td></tr>
<tr><td>4</td><td>4</td><td>4</td><td class="left">MoF</td><td>8,241</td><td>1,836</td><td>638</td></tr>
<tr><td>5</td><td>5</td><td>5</td><td class="left">SA</td><td>6,736</td><td>1,350</td><td>413</td></tr>
<tr><td>6</td><td>6</td><td>6</td><td class="left">LoLK</td><td>6,371</td><td>1,272</td><td>545</td></tr>
<tr><td>7</td><td>-</td><td>-</td><td class="left">WBaWC</td><td>3,746</td><td>543</td><td>361</td></tr>
<tr><td>8</td><td>8</td><td>8</td><td class="left">DDC</td><td>3,189</td><td>553</td><td>271</td></tr>
<tr><td>9</td><td>9</td><td>11</td><td class="left">UFO</td><td>3,170</td><td>567</td><td>258</td></tr>
<tr><td>10</td><td>7</td><td>7</td><td class="left">Forbidden Scrollery</td><td>3,154</td><td>359</td><td>256</td></tr>
<tr><td>11</td><td>12</td><td>13</td><td class="left">Wild and Horned Hermit</td><td>2,924</td><td>309</td><td>212</td></tr>
<tr><td>12</td><td>13</td><td>14</td><td class="left">TD</td><td>2,798</td><td>574</td><td>195</td></tr>
<tr><td>13</td><td>14</td><td>12</td><td class="left">Hisoutensoku</td><td>2,482</td><td>333</td><td>159</td></tr>
<tr><td>14</td><td>10</td><td>9</td><td class="left">HSiFS</td><td>2,430</td><td>326</td><td>235</td></tr>
<tr><td>15</td><td>11</td><td>10</td><td class="left">AoCF</td><td>2,265</td><td>219</td><td>157</td></tr>
<tr><td>16</td><td>15</td><td>15</td><td class="left">PoFV</td><td>2,106</td><td>313</td><td>164</td></tr>
<tr><td>17</td><td>16</td><td>17</td><td class="left">SWR</td><td>1,433</td><td>169</td><td>92</td></tr>
<tr><td>18</td><td>19</td><td>20</td><td class="left">Magical Astronomy</td><td>1,346</td><td>133</td><td>111</td></tr>
<tr><td>19</td><td>20</td><td>22</td><td class="left">Dolls in Pseudo Paradise</td><td>1,318</td><td>182</td><td>130</td></tr>
<tr><td>20</td><td>16</td><td>19</td><td class="left">Touhou Sangetsusei</td><td>1,227</td><td>123</td><td>115</td></tr>
<tr><td>21</td><td>21</td><td>21</td><td class="left">Touhou Bougetsushou</td><td>1,223</td><td>108</td><td>128</td></tr>
<tr><td>22</td><td>18</td><td>16</td><td class="left">ULiL</td><td>1,190</td><td>81</td><td>104</td></tr>
<tr><td>23</td><td>27</td><td>29</td><td class="left">LLS</td><td>1,143</td><td>241</td><td>58</td></tr>
<tr><td>24</td><td>22</td><td>18</td><td class="left">ISC</td><td>976</td><td>123</td><td>82</td></tr>
<tr><td>25</td><td>24</td><td>23</td><td class="left">Curiosities of Lotus Asia</td><td>934</td><td>110</td><td>81</td></tr>
<tr><td>26</td><td>23</td><td>24</td><td class="left">Perfect Memento in Strict Sense / Symposium of Post-mysticism</td><td>923</td><td>65</td><td>69</td></tr>
<tr><td>27</td><td>29</td><td>30</td><td class="left">MS</td><td>819</td><td>122</td><td>61</td></tr>
<tr><td>28</td><td>25</td><td>27</td><td class="left">StB</td><td>802</td><td>92</td><td>56</td></tr>
<tr><td>29</td><td>31</td><td>25</td><td class="left">HM</td><td>801</td><td>78</td><td>60</td></tr>
<tr><td>30</td><td>26</td><td>28</td><td class="left">GFW</td><td>772</td><td>68</td><td>67</td></tr>
<tr><td>31</td><td>-</td><td>-</td><td class="left">Lotus Eaters</td><td>737</td><td>51</td><td>81</td></tr>
<tr><td>32</td><td>33</td><td>31</td><td class="left">IaMP</td><td>733</td><td>85</td><td>55</td></tr>
<tr><td>33</td><td>30</td><td>26</td><td class="left">DS</td><td>708</td><td>63</td><td>65</td></tr>
<tr><td>34</td><td>32</td><td>33</td><td class="left">Retrospective 53 minutes</td><td>693</td><td>67</td><td>70</td></tr>
<tr><td>35</td><td>34</td><td>34</td><td class="left">PoDD</td><td>656</td><td>108</td><td>46</td></tr>
<tr><td>36</td><td>-</td><td>-</td><td class="left">Cheating Detective Satori</td><td>651</td><td>54</td><td>105</td></tr>
<tr><td>37</td><td>36</td><td>37</td><td class="left">HRtP</td><td>628</td><td>123</td><td>69</td></tr>
<tr><td>38</td><td>35</td><td>35</td><td class="left">Ghostly Field Club</td><td>558</td><td>71</td><td>45</td></tr>
<tr><td>39</td><td>38</td><td>39</td><td class="left">Changeability of Strange Dream</td><td>523</td><td>35</td><td>25</td></tr>
<tr><td>40</td><td>-</td><td>-</td><td class="left">The Grimoire of Usami</td><td>462</td><td>24</td><td>76</td></tr>
<tr><td>41</td><td>28</td><td>-</td><td class="left">VD</td><td>455</td><td>26</td><td>45</td></tr>
<tr><td>42</td><td>37</td><td>36</td><td class="left">Dr. Latency's Freak Report</td><td>452</td><td>32</td><td>33</td></tr>
<tr><td>43</td><td>41</td><td>40</td><td class="left">Neo-traditionalism of Japan</td><td>381</td><td>36</td><td>43</td></tr>
<tr><td>44</td><td>44</td><td>43</td><td class="left">SoEW</td><td>371</td><td>51</td><td>31</td></tr>
<tr><td>45</td><td>40</td><td>38</td><td class="left">The Grimoire of Marisa</td><td>344</td><td>36</td><td>33</td></tr>
<tr><td>46</td><td>45</td><td>42</td><td class="left">Trojan Green Asteroid</td><td>311</td><td>21</td><td>31</td></tr>
<tr><td>47</td><td>43</td><td>41</td><td class="left">Dateless Bar "Old Adam"</td><td>283</td><td>15</td><td>27</td></tr>
<tr><td>48</td><td>39</td><td>32</td><td class="left">Alternative Facts in Eastern Utopia</td><td>262</td><td>11</td><td>27</td></tr>
<tr><td>49</td><td>42</td><td>46</td><td class="left">Unknown Flower, Mesmerizing Journey</td><td>253</td><td>9</td><td>29</td></tr>
<tr><td>50</td><td>47</td><td>45</td><td class="left">Akyuu's Untouched Score</td><td>229</td><td>15</td><td>25</td></tr>
<tr><td>51</td><td>46</td><td>44</td><td class="left">Bohemian Archive in Japanese Red</td><td>176</td><td>11</td><td>14</td></tr>
<tr><td>52</td><td>-</td><td>-</td><td class="left">Gouyoku Ibun</td><td>158</td><td>10</td><td>27</td></tr>
<tr><td>53</td><td>-</td><td>-</td><td class="left">Who's Who of Humans &amp; Youkai in Gensokyo</td><td>126</td><td>3</td><td>12</td></tr>
                        </tbody>
                    </table>
                </div>
                <h1 id='questionnaire'>Questionnaire</h1>
                <h2>01. Age</h2>
                <div id='age_summary'>
                <table class='poll table sortable'>
                    <caption><p>Valid responses: 13,370　<input id='age_summary_button' type='button' value='Detailed view'></p></caption>
                    <colgroup>
                        <col class='col2qm'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Age range</th><th>Responses</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><th>&lt;= 9</th><td>14</td><td>0.10%</td></tr>
                        <tr><th>10-14</th><td>998</td><td>7.46%</td></tr>
                        <tr><th>15-19</th><td>5,038</td><td>37.68%</td></tr>
                        <tr><th>20-24</th><td>3,546</td><td>26.52%</td></tr>
                        <tr><th>25-29</th><td>1,946</td><td>14.55%</td></tr>
                        <tr><th>30-34</th><td>1,013</td><td>7.58%</td></tr>
                        <tr><th>35-39</th><td>468</td><td>3.50%</td></tr>
                        <tr><th>40-44</th><td>219</td><td>1.64%</td></tr>
                        <tr><th>45-49</th><td>82</td><td>0.61%</td></tr>
                        <tr><th>&gt;= 50</th><td>46</td><td>0.34%</td></tr>
                    </tbody>
                </table>
                </div>
                <div id='age_detail'>
                <table class='poll sortable'>
                    <caption><p>Valid responses: 13,370　<input id='age_detail_button' type='button' value='Simple view'></p></caption>
                    <colgroup>
                        <col class='col2qm'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Age</th><th>Responses</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><th>5</th><td>7</td><td>0.05%</td></tr>
                        <tr><th>7</th><td>1</td><td>0.01%</td></tr>
                        <tr><th>8</th><td>3</td><td>0.02%</td></tr>
                        <tr><th>9</th><td>3</td><td>0.02%</td></tr>
                        <tr><th>10</th><td>10</td><td>0.07%</td></tr>
                        <tr><th>11</th><td>22</td><td>0.16%</td></tr>
                        <tr><th>12</th><td>120</td><td>0.90%</td></tr>
                        <tr><th>13</th><td>326</td><td>2.44%</td></tr>
                        <tr><th>14</th><td>520</td><td>3.89%</td></tr>
                        <tr><th>15</th><td>892</td><td>6.67%</td></tr>
                        <tr><th>16</th><td>1,057</td><td>7.91%</td></tr>
                        <tr><th>17</th><td>1,107</td><td>8.28%</td></tr>
                        <tr><th>18</th><td>1,079</td><td>8.07%</td></tr>
                        <tr><th>19</th><td>903</td><td>6.75%</td></tr>
                        <tr><th>20</th><td>992</td><td>7.42%</td></tr>
                        <tr><th>21</th><td>755</td><td>5.65%</td></tr>
                        <tr><th>22</th><td>667</td><td>4.99%</td></tr>
                        <tr><th>23</th><td>580</td><td>4.34%</td></tr>
                        <tr><th>24</th><td>552</td><td>4.13%</td></tr>
                        <tr><th>25</th><td>507</td><td>3.79%</td></tr>
                        <tr><th>26</th><td>425</td><td>3.18%</td></tr>
                        <tr><th>27</th><td>353</td><td>2.64%</td></tr>
                        <tr><th>28</th><td>338</td><td>2.53%</td></tr>
                        <tr><th>29</th><td>323</td><td>2.42%</td></tr>
                        <tr><th>30</th><td>266</td><td>1.99%</td></tr>
                        <tr><th>31</th><td>218</td><td>1.63%</td></tr>
                        <tr><th>32</th><td>206</td><td>1.54%</td></tr>
                        <tr><th>33</th><td>170</td><td>1.27%</td></tr>
                        <tr><th>34</th><td>153</td><td>1.14%</td></tr>
                        <tr><th>35</th><td>131</td><td>0.98%</td></tr>
                        <tr><th>36</th><td>112</td><td>0.84%</td></tr>
                        <tr><th>37</th><td>96</td><td>0.72%</td></tr>
                        <tr><th>38</th><td>67</td><td>0.50%</td></tr>
                        <tr><th>39</th><td>62</td><td>0.46%</td></tr>
                        <tr><th>40</th><td>69</td><td>0.52%</td></tr>
                        <tr><th>41</th><td>44</td><td>0.33%</td></tr>
                        <tr><th>42</th><td>42</td><td>0.31%</td></tr>
                        <tr><th>43</th><td>35</td><td>0.26%</td></tr>
                        <tr><th>44</th><td>29</td><td>0.22%</td></tr>
                        <tr><th>45</th><td>23</td><td>0.17%</td></tr>
                        <tr><th>46</th><td>22</td><td>0.16%</td></tr>
                        <tr><th>47</th><td>18</td><td>0.13%</td></tr>
                        <tr><th>48</th><td>12</td><td>0.09%</td></tr>
                        <tr><th>49</th><td>7</td><td>0.05%</td></tr>
                        <tr><th>50</th><td>10</td><td>0.07%</td></tr>
                        <tr><th>51</th><td>5</td><td>0.04%</td></tr>
                        <tr><th>52</th><td>3</td><td>0.02%</td></tr>
                        <tr><th>53</th><td>3</td><td>0.02%</td></tr>
                        <tr><th>55</th><td>2</td><td>0.01%</td></tr>
                        <tr><th>56</th><td>2</td><td>0.01%</td></tr>
                        <tr><th>59</th><td>2</td><td>0.01%</td></tr>
                        <tr><th>80</th><td>1</td><td>0.01%</td></tr>
                        <tr><th>89</th><td>1</td><td>0.01%</td></tr>
                        <tr><th>100</th><td>17</td><td>0.13%</td></tr>
                    </tbody>
                </table>
                </div>
                <h2>02. Gender</h2>
                <table class='poll sortable'>
                    <caption><p>Valid responses: 13,416</p></caption>
                    <colgroup>
                        <col class='col2qm'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Gender</th><th>Responses</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><th>Male</th><td>11,268</td><td>83.99%</td></tr>
                        <tr><th>Female</th><td>2,148</td><td>16.01%</td></tr>
                    </tbody>
                </table>
                <h2>03. Location</h2>
                <table class='poll sortable'>
                    <caption><p>Valid responses: 13,034</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Location</th><th>Responses</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><th>Hokkaido</th><td>426</td><td>3.27%</td></tr>
                        <tr><td><strong>Northern Tohoku</strong><br>(Aomori, Iwate, Akita)</td><td>220</td><td>1.69%</td></tr>
                        <tr><td><strong>Southern Tohoku</strong><br>(Miyagi, Yamagata, Fukushima)</td><td>442</td><td>3.39%</td></tr>
                        <tr><td><strong>Northern Kanto</strong><br>(Ibaraki, Tochigi, Gunma)</td><td>589</td><td>4.52%</td></tr>
                        <tr><td><strong>Southern Kanto</strong><br>(Saitama, Chiba, Tokyo, Kanagawa)</td><td>3,765</td><td>28.89%</td></tr>
                        <tr><td><strong>Hokuriku</strong><br>(Toyama, Ishikawa, Fukui)</td><td>230</td><td>1.76%</td></tr>
                        <tr><td><strong>Koshinetsu</strong><br>(Niigata, Yamanashi, Nagano)</td><td>420</td><td>3.22%</td></tr>
                        <tr><td><strong>Tokai</strong><br>(Aichi, Mie, Gifu, Shizuoka)</td><td>1,221</td><td>9.37%</td></tr>
                        <tr><td><strong>Kansai</strong><br>(Osaka, Kyoto, Hyogo, Nara, Shiga, Wakayama)</td><td>1,663</td><td>12.76%</td></tr>
                        <tr><td><strong>Chugoku</strong><br>(Tottori, Shimane, Okayama, Hiroshima, Yamaguchi)</td><td>524</td><td>4.02%</td></tr>
                        <tr><td><strong>Shikoku</strong><br>(Tokushima, Ehime, Kagawa, Kochi)</td><td>236</td><td>1.81%</td></tr>
                        <tr><td><strong>Northern Kyushu</strong><br>(Fukuoka, Saga, Nagasaki, Oita)</td><td>425</td><td>3.26%</td></tr>
                        <tr><td><strong>Southern Kyushu</strong><br>(Kumamoto, Miyazaki, Kagoshima, Okinawa)</td><td>266</td><td>2.04%</td></tr>
                        <tr><td><strong>East Asia</strong><br>(China, Taiwan, Korea, etc.)</td><td>1,789</td><td>13.73%</td></tr>
                        <tr><th>Southeast Asia</th><td>145</td><td>1.11%</td></tr>
                        <tr><th>South, Central, West Asia</th><td>28</td><td>0.21%</td></tr>
                        <tr><th>Europe</th><td>229</td><td>1.76%</td></tr>
                        <tr><th>Africa</th><td>12</td><td>0.09%</td></tr>
                        <tr><th>North America</th><td>307</td><td>2.36%</td></tr>
                        <tr><th>South America</th><td>58</td><td>0.44%</td></tr>
                        <tr><th>Oceania</th><td>39</td><td>0.30%</td></tr>
                    </tbody>
                </table>
                <h2>04. Difficulty level 1cc'd</h2>
                <div id='clear_dummy' class='dummy'><div class='dummy_sub'></div></div>
                <div id='clear_container' class='container'>
                    <table class='poll'>
                        <colgroup>
                            <col class='col2 w7'>
                            <col class='col3q'>
                            <col class='col4 w7'>
                            <col class='col5 w7'>
                            <col class='col2 w7'>
                            <col class='col3 w7'>
                            <col class='col4 w7'>
                            <col class='col5 w7'>
                        </colgroup>
                        <tbody>
<tr><th>Game</th><th>Responses</th><th>Not played</th><th>Not cleared</th><th>Easy 1cc</th><th>Normal 1cc</th><th>Hard 1cc</th><th>Lunatic 1cc</th></tr>
<tr><th rowspan='3'>EoSD</th><td rowspan='3'>11,424</td><td>3,170</td><td>1,083</td><td>1,799</td><td>3,514</td><td>1,109</td><td>749</td></tr>
<tr><td>－</td><td>9.48%</td><td>15.75%</td><td>30.76%</td><td>9.71%</td><td>6.56%</td></tr>
<tr><td>27.75%</td><td colspan='5' style="text-align:center;">72.25%</td></tr>
<tr><th rowspan='3'>PCB</th><td rowspan='3'>11,243</td><td>3,475</td><td>961</td><td>1,602</td><td>3,274</td><td>1,062</td><td>869</td></tr>
<tr><td>－</td><td>8.55%</td><td>14.25%</td><td>29.12%</td><td>9.45%</td><td>7.73%</td></tr>
<tr><td>30.91%</td><td colspan='5' style="text-align:center;">69.09%</td></tr>
<tr><th rowspan='3'>IN</th><td rowspan='3'>11,209</td><td>3,395</td><td>709</td><td>1,602</td><td>3,403</td><td>1,184</td><td>916</td></tr>
<tr><td>－</td><td>6.33%</td><td>14.29%</td><td>30.36%</td><td>10.56%</td><td>8.17%</td></tr>
<tr><td>30.29%</td><td colspan='5' style="text-align:center;">69.71%</td></tr>
<tr><th rowspan='3'>PoFV</th><td rowspan='3'>10,826</td><td>5,013</td><td>764</td><td>1,402</td><td>2,453</td><td>514</td><td>680</td></tr>
<tr><td>－</td><td>7.06%</td><td>12.95%</td><td>22.66%</td><td>4.75%</td><td>6.28%</td></tr>
<tr><td>46.31%</td><td colspan='5' style="text-align:center;">53.69%</td></tr>
<tr><th rowspan='3'>MoF</th><td rowspan='3'>11,037</td><td>3,636</td><td>928</td><td>1,249</td><td>3,384</td><td>1,012</td><td>828</td></tr>
<tr><td>－</td><td>8.41%</td><td>11.32%</td><td>30.66%</td><td>9.17%</td><td>7.50%</td></tr>
<tr><td>32.94%</td><td colspan='5' style="text-align:center;">67.06%</td></tr>
<tr><th rowspan='3'>SA</th><td rowspan='3'>10,857</td><td>3,900</td><td>1,353</td><td>1,704</td><td>2,550</td><td>716</td><td>634</td></tr>
<tr><td>－</td><td>12.46%</td><td>15.69%</td><td>23.49%</td><td>6.59%</td><td>5.84%</td></tr>
<tr><td>35.92%</td><td colspan='5' style="text-align:center;">64.08%</td></tr>
<tr><th rowspan='3'>UFO</th><td rowspan='3'>10,747</td><td>4,499</td><td>1,323</td><td>1,415</td><td>2,497</td><td>557</td><td>456</td></tr>
<tr><td>－</td><td>12.31%</td><td>13.17%</td><td>23.23%</td><td>5.18%</td><td>4.24%</td></tr>
<tr><td>41.86%</td><td colspan='5' style="text-align:center;">58.14%</td></tr>
<tr><th rowspan='3'>TD</th><td rowspan='3'>10,771</td><td>4,540</td><td>868</td><td>1,244</td><td>2,783</td><td>715</td><td>621</td></tr>
<tr><td>－</td><td>8.06%</td><td>11.55%</td><td>25.84%</td><td>6.64%</td><td>5.77%</td></tr>
<tr><td>42.15%</td><td colspan='5' style="text-align:center;">57.85%</td></tr>
<tr><th rowspan='3'>DDC</th><td rowspan='3'>10,708</td><td>4,656</td><td>907</td><td>1,382</td><td>2,544</td><td>631</td><td>588</td></tr>
<tr><td>－</td><td>8.47%</td><td>12.91%</td><td>23.76%</td><td>5.89%</td><td>5.49%</td></tr>
<tr><td>43.48%</td><td colspan='5' style="text-align:center;">56.52%</td></tr>
<tr><th rowspan='3'>LoLK (PD)</th><td rowspan='3'>10,735</td><td>4,568</td><td>1,103</td><td>1,398</td><td>2,453</td><td>498</td><td>715</td></tr>
<tr><td>－</td><td>10.27%</td><td>13.02%</td><td>22.85%</td><td>4.64%</td><td>6.66%</td></tr>
<tr><td>42.55%</td><td colspan='5' style="text-align:center;">57.45%</td></tr>
<tr><th rowspan='3'>LoLK (Legacy)</th><td rowspan='3'>10,392</td><td>4,664</td><td>2,564</td><td>1,022</td><td>1,255</td><td>346</td><td>541</td></tr>
<tr><td>－</td><td>24.67%</td><td>9.83%</td><td>12.08%</td><td>3.33%</td><td>5.21%</td></tr>
<tr><td>44.88%</td><td colspan='5' style="text-align:center;">55.12%</td></tr>
<tr><th rowspan='3'>HSiFS</th><td rowspan='3'>10,690</td><td>4,881</td><td>914</td><td>1,417</td><td>2,301</td><td>488</td><td>689</td></tr>
<tr><td>－</td><td>8.55%</td><td>13.26%</td><td>21.52%</td><td>4.57%</td><td>6.45%</td></tr>
<tr><td>45.66%</td><td colspan='5' style="text-align:center;">54.34%</td></tr>
<tr><th rowspan='3'>WBaWC</th><td rowspan='3'>10,678</td><td>5,187</td><td>962</td><td>1,359</td><td>2,185</td><td>495</td><td>490</td></tr>
<tr><td>－</td><td>9.01%</td><td>12.73%</td><td>20.46%</td><td>4.64%</td><td>4.59%</td></tr>
<tr><td>48.58%</td><td colspan='5' style="text-align:center;">51.42%</td></tr>
                        </tbody>
                    </table>
                </div>
                <h2>05. Publications subscribed to</h2>
                <h3>Curiosities of Lotus Asia</h3>
                <table class='poll'>
                    <caption><p>Valid responses: 10,102</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <tbody>
                        <tr><th>Not bought</th><td>6,982</td><td>69.12%</td></tr>
                        <tr><th>Bought the serialization (Strange Creators of Outer World)</th><td>3,120</td><td>30.88%</td></tr>
                    </tbody>
                </table>
                <h3>Foul Detective Satori</h3>
                <table class='poll'>
                    <caption><p>Valid responses: 9,999</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <tbody>
                        <tr><th>Not read</th><td>6,005</td><td>60.06%</td></tr>
                        <tr><th>Reading on Comic Walker</th><td>1,543</td><td>15.43%</td></tr>
                        <tr><th>Reading on Niconico</th><td>1,160</td><td>11.60%</td></tr>
                        <tr><th>Reading on Strange Articles of the Outer World</th><td>1,291</td><td>12.91%</td></tr>
                    </tbody>
                </table>
                <h3>Lotus Eaters</h3>
                <table class='poll'>
                    <caption><p>Valid responses: 9,589</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <tbody>
                        <tr><th>Not bought</th><td>8,485</td><td>88.49%</td></tr>
                        <tr><th>Bought the serialization (Comp Ace)</th><td>1,104</td><td>11.51%</td></tr>
                    </tbody>
                </table>
                <h2>06. What do you like about Touhou? (Multiple answers possible)</h2>
                <table class='poll sortable'>
                    <caption><p>Valid responses: 14,324</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Aspect</th><th>Responses</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><th>Music</th><td>13,842</td><td>96.64%</td></tr>
                        <tr><th>Games</th><td>8,837</td><td>61.69%</td></tr>
                        <tr><th>Characters</th><td>13,057</td><td>91.15%</td></tr>
                        <tr><th>Story</th><td>9,190</td><td>64.16%</td></tr>
                        <tr><th>Universe</th><td>11,848</td><td>82.71%</td></tr>
                        <tr><th>Fanworks</th><td>10,963</td><td>76.54%</td></tr>
                        <tr><th>Fandom</th><td>6,164</td><td>43.03%</td></tr>
                    </tbody>
                </table>
                <h2>07. When did you discover Touhou?</h2>
                <table class='poll sortable'>
                    <caption><p>Valid responses: 13,834</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Time period</th><th>Responses</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>PC-98 - Shuusou Gyoku</strong><br>(October 1995 - December 2000)</td><td>63</td><td>0.46%</td></tr>
                        <tr><td><strong>Shuusou Gyoku - EoSD</strong><br>(December 2000 - August 2002)</td><td>133</td><td>0.96%</td></tr>
                        <tr><td><strong>EoSD - PCB</strong><br>(August 2002 - August 2003)</td><td>463</td><td>3.35%</td></tr>
                        <tr><td><strong>PCB - IN</strong><br>(August 2003 - August 2004)</td><td>253</td><td>1.83%</td></tr>
                        <tr><td><strong>IN - IaMP</strong><br>(August 2004 - December 2004)</td><td>199</td><td>1.44%</td></tr>
                        <tr><td><strong>IaMP - PoFV</strong><br>(December 2004 - August 2005)</td><td>152</td><td>1.10%</td></tr>
                        <tr><td><strong>PoFV - StB</strong><br>(August 2005 - December 2005)</td><td>148</td><td>1.07%</td></tr>
                        <tr><td><strong>StB - PMiSS</strong><br>(December 2005 - December 2006)</td><td>149</td><td>1.08%</td></tr>
                        <tr><td><strong>PMiSS - MoF</strong><br>(December 2006 - August 2007)</td><td>545</td><td>3.94%</td></tr>
                        <tr><td><strong>MoF - SA</strong><br>(August 2007 - August 2008)</td><td>1,197</td><td>8.65%</td></tr>
                        <tr><td><strong>SA - UFO</strong><br>(August 2008 - August 2009)</td><td>968</td><td>7.00%</td></tr>
                        <tr><td><strong>UFO - GFW</strong><br>(August 2009 - August 2010)</td><td>765</td><td>5.53%</td></tr>
                        <tr><td><strong>GFW - TD</strong><br>(August 2010 - August 2011)</td><td>723</td><td>5.23%</td></tr>
                        <tr><td><strong>TD - SoPM</strong><br>(August 2011 - April 2012)</td><td>1,010</td><td>7.30%</td></tr>
                        <tr><td><strong>SoPM - DDC</strong><br>(April 2012 - August 2013)</td><td>1,102</td><td>7.97%</td></tr>
                        <tr><td><strong>DDC - ISC</strong><br>(August 2013 - May 2014)</td><td>1,294</td><td>9.35%</td></tr>
                        <tr><td><strong>ISC - LoLK</strong><br>(May 2014 - August 2015)</td><td>1,286</td><td>9.30%</td></tr>
                        <tr><td><strong>LoLK - DBOA</strong><br>(August 2015 - August 2016)</td><td>1,085</td><td>7.84%</td></tr>
                        <tr><td><strong>DBOA - HSiFS</strong><br>(August 2016 - August 2017)</td><td>1,120</td><td>8.10%</td></tr>
                        <tr><td><strong>HSiFS - WBaWC</strong><br>(August 2017 - August 2019)</td><td>808</td><td>5.84%</td></tr>
                        <tr><td><strong>WBaWC - now</strong><br>(August 2019 - 13 June 2020)</td><td>371</td><td>2.68%</td></tr>
                    </tbody>
                </table>
                <h2>08. How did you discover Touhou?</h2>
                <table class='poll sortable'>
                    <caption><p>Valid responses: 13,475</p></caption>
                    <colgroup>
                        <col class='col2ql'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Means of discovery</th><th>Responses</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><th>Offline (School, club activities, family, etc.)</th><td>3,140</td><td>23.30%</td></tr>
                        <tr><th>Online games, online friends, chat (IRC, etc.)</th><td>520</td><td>3.86%</td></tr>
                        <tr><th>Personal sites, blogs, news sites, etc.</th><td>412</td><td>3.06%</td></tr>
                        <tr><th>Image sites (Pixiv, Nijie, TINAMI, SNS, etc.)</th><td>461</td><td>3.42%</td></tr>
                        <tr><th>Anonymous boards (2ch, Futaba, etc.)</th><td>219</td><td>1.63%</td></tr>
                        <tr><th>Niconico</th><td>2,704</td><td>20.07%</td></tr>
                        <tr><th>Other video sites (YouTube, etc.)</th><td>4,395</td><td>32.62%</td></tr>
                        <tr><th>Twitter</th><td>56</td><td>0.42%</td></tr>
                        <tr><th>Magazine articles, TV programs, etc.</th><td>64</td><td>0.47%</td></tr>
                        <tr><th>Doujinshi (Comiket, etc.)</th><td>92</td><td>0.68%</td></tr>
                        <tr><th>Doujin stores, general bookstores, etc.</th><td>178</td><td>1.32%</td></tr>
                        <tr><th>Rhythm games that contain Touhou music</th><td>715</td><td>5.31%</td></tr>
                        <tr><th>When looking for interesting games</th><td>334</td><td>2.48%</td></tr>
                        <tr><th>Smartphone fangames</th><td>185</td><td>1.37%</td></tr>
                    </tbody>
                </table>
                <h2>08. Correlation between when and how people discovered Touhou</h2>
                <div id='corr_dummy' class='dummy'><div class='dummy_sub'></div></div>
                <div id='corr_container' class='container'>
                    <table class='poll'>
                        <colgroup>
                            <col class='col2 w7'>
                            <col class='col3q'>
                            <col class='col4 w7'>
                            <col class='col5 w7'>
                            <col class='col2 w7'>
                            <col class='col3 w7'>
                            <col class='col4 w7'>
                            <col class='col5 w7'>
                            <col class='col2 w7'>
                            <col class='col3 w7'>
                            <col class='col4 w7'>
                            <col class='col5 w7'>
                            <col class='col2 w7'>
                            <col class='col3 w7'>
                            <col class='col4 w7'>
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Means of discovery</th>
                                <th>Offline</th>
                                <th>Online</th>
                                <th>Personal sites</th>
                                <th>Image sites</th>
                                <th>Anonymous boards</th>
                                <th>Nico</th>
                                <th>Other video sites</th>
                                <th>Twitter</th>
                                <th>Magazines / TV</th>
                                <th>Doujinshi</th>
                                <th>Doujin shops</th>
                                <th>Music games</th>
                                <th>Other games</th>
                                <th>Mobile apps</th>
                            </tr>
                        </thead>
                        <tbody>
<tr><th rowspan='2'>PC98-SG</th><td>19</td><td>4</td><td>2</td><td>0</td><td>1</td><td>3</td><td>3</td><td>2</td><td>0</td><td>5</td><td>4</td><td>1</td><td>10</td><td>3</td></tr>
<tr><td>33%</td><td>7%</td><td>4%</td><td>0%</td><td>2%</td><td>5%</td><td>5%</td><td>4%</td><td>0%</td><td>9%</td><td>7%</td><td>2%</td><td>18%</td><td>5%</td></tr>
<tr><th rowspan='2'>SG-EoSD</th><td>31</td><td>8</td><td>11</td><td>6</td><td>0</td><td>8</td><td>26</td><td>0</td><td>2</td><td>6</td><td>4</td><td>11</td><td>9</td><td>2</td></tr>
<tr><td>25%</td><td>6%</td><td>9%</td><td>5%</td><td>0%</td><td>6%</td><td>21%</td><td>0%</td><td>2%</td><td>5%</td><td>3%</td><td>9%</td><td>7%</td><td>2%</td></tr>
<tr><th rowspan='2'>EoSD-PCB</th><td>127</td><td>36</td><td>38</td><td>16</td><td>20</td><td>56</td><td>53</td><td>2</td><td>8</td><td>14</td><td>20</td><td>30</td><td>20</td><td>4</td></tr>
<tr><td>29%</td><td>8%</td><td>9%</td><td>4%</td><td>5%</td><td>13%</td><td>12%</td><td>0%</td><td>2%</td><td>3%</td><td>5%</td><td>7%</td><td>5%</td><td>1%</td></tr>
<tr><th rowspan='2'>PCB-IN</th><td>102</td><td>20</td><td>24</td><td>5</td><td>10</td><td>18</td><td>14</td><td>0</td><td>4</td><td>8</td><td>11</td><td>6</td><td>17</td><td>1</td></tr>
<tr><td>43%</td><td>8%</td><td>10%</td><td>2%</td><td>4%</td><td>8%</td><td>6%</td><td>0%</td><td>2%</td><td>3%</td><td>5%</td><td>3%</td><td>7%</td><td>0%</td></tr>
<tr><th rowspan='2'>IN-IaMP</th><td>60</td><td>12</td><td>27</td><td>2</td><td>13</td><td>24</td><td>10</td><td>0</td><td>3</td><td>2</td><td>8</td><td>2</td><td>24</td><td>1</td></tr>
<tr><td>32%</td><td>6%</td><td>14%</td><td>1%</td><td>7%</td><td>13%</td><td>5%</td><td>0%</td><td>2%</td><td>1%</td><td>4%</td><td>1%</td><td>13%</td><td>1%</td></tr>
<tr><th rowspan='2'>IaMP-PoFV</th><td>47</td><td>12</td><td>13</td><td>3</td><td>11</td><td>22</td><td>8</td><td>0</td><td>3</td><td>5</td><td>6</td><td>6</td><td>6</td><td>2</td></tr>
<tr><td>33%</td><td>8%</td><td>9%</td><td>2%</td><td>8%</td><td>15%</td><td>6%</td><td>0%</td><td>2%</td><td>3%</td><td>4%</td><td>4%</td><td>4%</td><td>1%</td></tr>
<tr><th rowspan='2'>PoFV-StB</th><td>47</td><td>9</td><td>19</td><td>5</td><td>10</td><td>19</td><td>9</td><td>1</td><td>2</td><td>6</td><td>3</td><td>0</td><td>5</td><td>0</td></tr>
<tr><td>35%</td><td>7%</td><td>14%</td><td>4%</td><td>7%</td><td>14%</td><td>7%</td><td>1%</td><td>1%</td><td>4%</td><td>2%</td><td>0%</td><td>4%</td><td>0%</td></tr>
<tr><th rowspan='2'>StB-PMiSS</th><td>40</td><td>9</td><td>16</td><td>1</td><td>14</td><td>23</td><td>15</td><td>0</td><td>1</td><td>0</td><td>6</td><td>4</td><td>10</td><td>0</td></tr>
<tr><td>29%</td><td>6%</td><td>12%</td><td>1%</td><td>10%</td><td>17%</td><td>11%</td><td>0%</td><td>1%</td><td>0%</td><td>4%</td><td>3%</td><td>7%</td><td>0%</td></tr>
<tr><th rowspan='2'>PMiSS-MoF</th><td>119</td><td>13</td><td>30</td><td>6</td><td>18</td><td>225</td><td>61</td><td>1</td><td>3</td><td>5</td><td>11</td><td>10</td><td>16</td><td>2</td></tr>
<tr><td>23%</td><td>3%</td><td>6%</td><td>1%</td><td>3%</td><td>43%</td><td>12%</td><td>0%</td><td>1%</td><td>1%</td><td>2%</td><td>2%</td><td>3%</td><td>0%</td></tr>
<tr><th rowspan='2'>MoF-SA</th><td>298</td><td>40</td><td>29</td><td>34</td><td>18</td><td>480</td><td>164</td><td>2</td><td>4</td><td>3</td><td>12</td><td>33</td><td>25</td><td>2</td></tr>
<tr><td>26%</td><td>3%</td><td>3%</td><td>3%</td><td>2%</td><td>42%</td><td>14%</td><td>0%</td><td>0%</td><td>0%</td><td>1%</td><td>3%</td><td>2%</td><td>0%</td></tr>
<tr><th rowspan='2'>SA-UFO</th><td>223</td><td>40</td><td>21</td><td>26</td><td>17</td><td>349</td><td>189</td><td>2</td><td>9</td><td>7</td><td>13</td><td>14</td><td>15</td><td>2</td></tr>
<tr><td>24%</td><td>4%</td><td>2%</td><td>3%</td><td>2%</td><td>38%</td><td>20%</td><td>0%</td><td>1%</td><td>1%</td><td>1%</td><td>2%</td><td>2%</td><td>0%</td></tr>
<tr><th rowspan='2'>UFO-GFW</th><td>162</td><td>34</td><td>18</td><td>25</td><td>11</td><td>221</td><td>210</td><td>1</td><td>2</td><td>2</td><td>10</td><td>24</td><td>17</td><td>3</td></tr>
<tr><td>22%</td><td>5%</td><td>2%</td><td>3%</td><td>1%</td><td>30%</td><td>28%</td><td>0%</td><td>0%</td><td>0%</td><td>1%</td><td>3%</td><td>2%</td><td>0%</td></tr>
<tr><th rowspan='2'>GFW-TD</th><td>188</td><td>28</td><td>15</td><td>24</td><td>7</td><td>174</td><td>216</td><td>0</td><td>3</td><td>5</td><td>4</td><td>21</td><td>10</td><td>2</td></tr>
<tr><td>27%</td><td>4%</td><td>2%</td><td>3%</td><td>1%</td><td>25%</td><td>31%</td><td>0%</td><td>0%</td><td>1%</td><td>1%</td><td>3%</td><td>1%</td><td>0%</td></tr>
<tr><th rowspan='2'>TD-SoPM</th><td>226</td><td>28</td><td>15</td><td>44</td><td>10</td><td>179</td><td>359</td><td>4</td><td>4</td><td>6</td><td>16</td><td>34</td><td>8</td><td>13</td></tr>
<tr><td>24%</td><td>3%</td><td>2%</td><td>5%</td><td>1%</td><td>19%</td><td>38%</td><td>0%</td><td>0%</td><td>1%</td><td>2%</td><td>4%</td><td>1%</td><td>1%</td></tr>
<tr><th rowspan='2'>SoPM-DDC</th><td>237</td><td>34</td><td>14</td><td>36</td><td>9</td><td>192</td><td>445</td><td>5</td><td>7</td><td>3</td><td>10</td><td>41</td><td>16</td><td>6</td></tr>
<tr><td>22%</td><td>3%</td><td>1%</td><td>3%</td><td>1%</td><td>18%</td><td>42%</td><td>0%</td><td>1%</td><td>0%</td><td>1%</td><td>4%</td><td>2%</td><td>1%</td></tr>
<tr><th rowspan='2'>DDC-ISC</th><td>264</td><td>34</td><td>14</td><td>49</td><td>13</td><td>207</td><td>562</td><td>3</td><td>2</td><td>3</td><td>4</td><td>58</td><td>17</td><td>6</td></tr>
<tr><td>21%</td><td>3%</td><td>1%</td><td>4%</td><td>1%</td><td>17%</td><td>45%</td><td>0%</td><td>0%</td><td>0%</td><td>0%</td><td>5%</td><td>1%</td><td>0%</td></tr>
<tr><th rowspan='2'>ISC-LoLK</th><td>258</td><td>40</td><td>23</td><td>38</td><td>5</td><td>146</td><td>571</td><td>6</td><td>2</td><td>2</td><td>8</td><td>81</td><td>17</td><td>16</td></tr>
<tr><td>21%</td><td>3%</td><td>2%</td><td>3%</td><td>0%</td><td>12%</td><td>47%</td><td>0%</td><td>0%</td><td>0%</td><td>1%</td><td>7%</td><td>1%</td><td>1%</td></tr>
<tr><th rowspan='2'>LoLK-DBOA</th><td>206</td><td>35</td><td>13</td><td>39</td><td>11</td><td>119</td><td>476</td><td>7</td><td>4</td><td>3</td><td>8</td><td>58</td><td>15</td><td>17</td></tr>
<tr><td>20%</td><td>3%</td><td>1%</td><td>4%</td><td>1%</td><td>12%</td><td>47%</td><td>1%</td><td>0%</td><td>0%</td><td>1%</td><td>6%</td><td>1%</td><td>2%</td></tr>
<tr><th rowspan='2'>DBOA-HSiFS</th><td>217</td><td>24</td><td>23</td><td>43</td><td>8</td><td>102</td><td>446</td><td>7</td><td>0</td><td>2</td><td>11</td><td>109</td><td>28</td><td>31</td></tr>
<tr><td>21%</td><td>2%</td><td>2%</td><td>4%</td><td>1%</td><td>10%</td><td>42%</td><td>1%</td><td>0%</td><td>0%</td><td>1%</td><td>10%</td><td>3%</td><td>3%</td></tr>
<tr><th rowspan='2'>HSiFS-WBaWC</th><td>137</td><td>26</td><td>22</td><td>29</td><td>6</td><td>67</td><td>286</td><td>5</td><td>1</td><td>1</td><td>6</td><td>95</td><td>34</td><td>36</td></tr>
<tr><td>18%</td><td>3%</td><td>3%</td><td>4%</td><td>1%</td><td>9%</td><td>38%</td><td>1%</td><td>0%</td><td>0%</td><td>1%</td><td>13%</td><td>5%</td><td>5%</td></tr>
<tr><th rowspan='2'>WBaWC-now</th><td>58</td><td>16</td><td>14</td><td>23</td><td>3</td><td>23</td><td>119</td><td>6</td><td>0</td><td>2</td><td>2</td><td>47</td><td>7</td><td>32</td></tr>
<tr><td>16%</td><td>5%</td><td>4%</td><td>7%</td><td>1%</td><td>7%</td><td>34%</td><td>2%</td><td>0%</td><td>1%</td><td>1%</td><td>13%</td><td>2%</td><td>9%</td></tr>
                        </tbody>
                    </table>
                </div>
                <h2>09. Participation in doujin events such as Comiket and Reitaisai (multiple answers possible)</h2>
                <table class='poll'>
                    <caption><p>Valid responses: 13,685</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                        <col class='col5q'>
                        <col class='col2qs'>
                    </colgroup>
                    <tbody>
                        <tr><th>No participation</th><td>6,910</td><td>50.49%</td><td>－</td><td>－</td></tr>
                        <tr><th>Bought official works</th><td rowspan='13'>6,775</td><td rowspan='13'>49.51%</td><td>3,610</td><td>53.28%</td></tr>
                        <tr><th>Bought doujinshi</th><td>5,445</td><td>80.37%</td></tr>
                        <tr><th>Bought doujin music</th><td>4,373</td><td>64.55%</td></tr>
                        <tr><th>Bought doujin games</th><td>2,538</td><td>37.46%</td></tr>
                        <tr><th>Bought doujin goods</th><td>3,840</td><td>56.68%</td></tr>
                        <tr><th>Bought corporate works</th><td>1,303</td><td>19.23%</td></tr>
                        <tr><th>Distributed works (as a circle)</th><td>1,269</td><td>18.73%</td></tr>
                        <tr><th>Staff</th><td>224</td><td>3.31%</td></tr>
                        <tr><th>Interacted with circles and friends</th><td>1,983</td><td>29.27%</td></tr>
                        <tr><th>Cosplayed</th><td>465</td><td>6.86%</td></tr>
                        <tr><th>Viewed or photographed cosplay</th><td>1,089</td><td>16.07%</td></tr>
                        <tr><th>Corporate collab events (for rhythm games, etc)</th><td>734</td><td>10.83%</td></tr>
                        <tr><th>Performed live music</th><td>867</td><td>12.80%</td></tr>
                    </tbody>
                </table>
                <h2>10. Have you voted on the Touhou Popularity Poll before?</h2>
                <table class='poll sortable'>
                    <caption><p>Valid responses: 14,151</p></caption>
                    <colgroup>
                        <col class='col2q'>
                        <col class='col3q'>
                        <col class='col4q'>
                    </colgroup>
                    <thead>
                        <tr><th>Times voted</th><th>Responses</th><th>Percentage</th></tr>
                    <tbody>
                        <tr><th>Never voted before</th><td>6,145</td><td>43.42%</td></tr>
                        <tr><th>Voted 1 to 3 times</th><td>4,664</td><td>32.96%</td></tr>
                        <tr><th>Voted 4 or more times</th><td>3,342</td><td>23.62%</td></tr>
                    </tbody>
                </table>
                <p id='ack_mobile' class='noborders'>The background image was drawn by <a href='https://www.pixiv.net/member.php?id=2025430'>Yakumo_Stocking</a>.</p>
                <p id='back'><strong><a id='backtotop' href='#top'>Back to Top</a></strong></p>
                <script src='assets/thvote/thvote.js'></script>
                <script src='assets/shared/dark.js'></script>
            </div>
        </main>
    </body>
</html>
