<h2>Contents</h2>
<div class='contents'>
    <p><a href='#jumps'>Biggest jumps</a></p>
    <p><a href='#cpg'>Character vote per maingame</a></p>
    <p><a href='#mpg'>Music vote per maingame</a></p>
    <ul><li><a href='#mtotals'>Totals per maingame</a></li><?php
        $games = ['HRtP', 'SoEW', 'PoDD', 'LLS', 'MS', 'EoSD', 'PCB', 'IN', 'PoFV', 'MoF', 'SA', 'UFO', 'GFW', 'TD', 'DDC', 'LoLK', 'HSiFS', 'WBaWC', 'UM'];
        foreach ($games as $key => $game) {
            if ($key < 5 || $game == 'GFW') {
                continue;
            }
            echo '<li><a href="#m' . strtolower($game) . '">' . full_name($game) . '</a></li>';
        }
    ?></ul>
    <!--<p><a href='#gender'>Gender vote</a></p>
    <ul>
        <li><a href='#charas'>Characters</a></li>
        <li><a href='#works'>Works</a></li>
    </ul>-->
</div>
<h2 id='jumps'>Biggest jumps</h2>
<p>This section lists the biggest jumps in ranking for characters (top 150 only). Click a column to sort the table by jumps, drops or whatever you like.</p>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col3game'>
        <col class='col4'>
        <col class='col5'>
    </colgroup>
    <thead>
        <tr><th>Previous Rank</th><th>Current Rank</th><th>Character</th><th id='change' class='sorttable_numeric'>Change</th></tr>
    </thead>
    <tbody>
        <tr><td>5</td><td>1</td><td>Flandre Scarlet</td><td class='jump'>+4</td></tr>
        <tr><td>2</td><td>2</td><td>Marisa Kirisame</td><td class='stable'>0</td></tr>
        <tr><td>3</td><td>3</td><td>Reimu Hakurei</td><td class='stable'>0</td></tr>
        <tr><td>1</td><td>4</td><td>Youmu Konpaku</td><td class='drop'>-3</td></tr>
        <tr><td>6</td><td>5</td><td>Sakuya Izayoi</td><td class='jump'>+1</td></tr>
        <tr><td>4</td><td>6</td><td>Koishi Komeiji</td><td class='drop'>-2</td></tr>
        <tr><td>7</td><td>7</td><td>Remilia Scarlet</td><td class='stable'>0</td></tr>
        <tr><td>8</td><td>8</td><td>Fujiwara no Mokou</td><td class='stable'>0</td></tr>
        <tr><td>9</td><td>9</td><td>Satori Komeiji</td><td class='stable'>0</td></tr>
        <tr><td>10</td><td>10</td><td>Yuyuko Saigyouji</td><td class='stable'>0</td></tr>
        <tr><td>12</td><td>11</td><td>Alice Margatroid</td><td class='jump'>+1</td></tr>
        <tr><td>11</td><td>12</td><td>Aya Shameimaru</td><td class='drop'>-1</td></tr>
        <tr><td>14</td><td>13</td><td>Reisen Udongein Inaba</td><td class='jump'>+1</td></tr>
        <tr><td>13</td><td>14</td><td>Sanae Kochiya</td><td class='drop'>-1</td></tr>
        <tr><td>18</td><td>15</td><td>Cirno</td><td class='jump'>+3</td></tr>
        <tr><td>16</td><td>16</td><td>Yukari Yakumo</td><td class='stable'>0</td></tr>
        <tr><td>21</td><td>17</td><td>Rumia</td><td class='jump'>+4</td></tr>
        <tr><td>15</td><td>18</td><td>Tenshi Hinanawi</td><td class='drop'>-3</td></tr>
        <tr><td>19</td><td>19</td><td>Patchouli Knowledge</td><td class='stable'>0</td></tr>
        <tr><td>22</td><td>20</td><td>Suwako Moriya</td><td class='jump'>+2</td></tr>
        <tr><td>17</td><td>21</td><td>Hata no Kokoro</td><td class='drop'>-4</td></tr>
        <tr><td>25</td><td>22</td><td>Hong Meiling</td><td class='jump'>+3</td></tr>
        <tr><td>23</td><td>23</td><td>Eiki Shiki, Yamaxanadu</td><td class='stable'>0</td></tr>
        <tr><td>27</td><td>24</td><td>Momiji Inubashiri</td><td class='jump'>+3</td></tr>
        <tr><td>20</td><td>25</td><td>Kogasa Tatara</td><td class='drop'>-5</td></tr>
        <tr><td>24</td><td>26</td><td>Yuuka Kazami</td><td class='drop'>-2</td></tr>
        <tr><td>26</td><td>27</td><td>Toyosatomimi no Miko</td><td class='drop'>-1</td></tr>
        <tr><td>28</td><td>28</td><td>Junko</td><td class='stable'>0</td></tr>
        <tr><td>34</td><td>29</td><td>Hecatia Lapislazuli</td><td class='jump'>+5</td></tr>
        <tr><td>30</td><td>30</td><td>Shion Yorigami</td><td class='stable'>0</td></tr>
        <tr><td>31</td><td>31</td><td>Suika Ibuki</td><td class='stable'>0</td></tr>
        <tr><td>29</td><td>32</td><td>Seija Kijin</td><td class='drop'>-3</td></tr>
        <tr><td>33</td><td>33</td><td>Sagume Kishin</td><td class='stable'>0</td></tr>
        <tr><td>37</td><td>34</td><td>Ran Yakumo</td><td class='jump'>+3</td></tr>
        <tr><td>36</td><td>35</td><td>Nitori Kawashiro</td><td class='jump'>+1</td></tr>
        <tr><td>39</td><td>36</td><td>Utsuho Reiuji</td><td class='jump'>+3</td></tr>
        <tr><td>32</td><td>37</td><td>Mononobe no Futo</td><td class='drop'>-5</td></tr>
        <tr><td>41</td><td>38</td><td>Parsee Mizuhashi</td><td class='jump'>+3</td></tr>
        <tr><td>40</td><td>39</td><td>Kasen Ibaraki</td><td class='jump'>+1</td></tr>
        <tr><td>35</td><td>40</td><td>Kaguya Houraisan</td><td class='drop'>-5</td></tr>
        <tr><td>38</td><td>41</td><td>Renko Usami</td><td class='drop'>-3</td></tr>
        <tr><td>45</td><td>42</td><td>Hina Kagiyama</td><td class='jump'>+3</td></tr>
        <tr><td>42</td><td>43</td><td>Okina Matara</td><td class='drop'>-1</td></tr>
        <tr><td>43</td><td>44</td><td>Nue Houjuu</td><td class='drop'>-1</td></tr>
        <tr><td>49</td><td>45</td><td>Rin Kaenbyou</td><td class='jump'>+4</td></tr>
        <tr><td>48</td><td>46</td><td>Eirin Yagokoro</td><td class='jump'>+2</td></tr>
        <tr><td>47</td><td>47</td><td>Byakuren Hijiri</td><td class='stable'>0</td></tr>
        <tr><td>52</td><td>48</td><td>Clownpiece</td><td class='jump'>+4</td></tr>
        <tr><td>63</td><td>49</td><td>Nazrin</td><td class='jump'>+14</td></tr>
        <tr><td>50</td><td>50</td><td>Doremy Sweet</td><td class='stable'>0</td></tr>
        <tr><td>46</td><td>51</td><td>Keiki Haniyasushin</td><td class='drop'>-5</td></tr>
        <tr><td>44</td><td>52</td><td>Chimata Tenkyuu</td><td class='drop'>-8</td></tr>
        <tr><td>-</td><td>53</td><td>Yuuma Toutetsu</td><td class='stable'>0</td></tr>
        <tr><td>67</td><td>54</td><td>Koakuma</td><td class='jump'>+13</td></tr>
        <tr><td>53</td><td>55</td><td>Keine Kamishirasawa</td><td class='drop'>-2</td></tr>
        <tr><td>61</td><td>56</td><td>Chen</td><td class='jump'>+5</td></tr>
        <tr><td>55</td><td>57</td><td>Tsukasa Kudamaki</td><td class='drop'>-2</td></tr>
        <tr><td>59</td><td>58</td><td>Seiga Kaku</td><td class='jump'>+1</td></tr>
        <tr><td>51</td><td>59</td><td>Minamitsu Murasa</td><td class='drop'>-8</td></tr>
        <tr><td>54</td><td>60</td><td>Maribel Hearn</td><td class='drop'>-6</td></tr>
        <tr><td>57</td><td>61</td><td>Megumu Iizunamaru</td><td class='drop'>-4</td></tr>
        <tr><td>76</td><td>62</td><td>Iku Nagae</td><td class='jump'>+14</td></tr>
        <tr><td>68</td><td>63</td><td>Kutaka Niwatari</td><td class='jump'>+5</td></tr>
        <tr><td>58</td><td>64</td><td>Yachie Kicchou</td><td class='drop'>-6</td></tr>
        <tr><td>56</td><td>65</td><td>Sumireko Usami</td><td class='drop'>-9</td></tr>
        <tr><td>60</td><td>66</td><td>Daiyousei</td><td class='drop'>-6</td></tr>
        <tr><td>64</td><td>67</td><td>Tewi Inaba</td><td class='drop'>-3</td></tr>
        <tr><td>80</td><td>68</td><td>Joon Yorigami</td><td class='jump'>+12</td></tr>
        <tr><td>71</td><td>69</td><td>Mystia Lorelei</td><td class='jump'>+2</td></tr>
        <tr><td>66</td><td>70</td><td>Kagerou Imaizumi</td><td class='drop'>-4</td></tr>
        <tr><td>64</td><td>71</td><td>Sekibanki</td><td class='drop'>-7</td></tr>
        <tr><td>69</td><td>72</td><td>Yuugi Hoshiguma</td><td class='drop'>-3</td></tr>
        <tr><td>74</td><td>73</td><td>Soga no Tojiko</td><td class='jump'>+1</td></tr>
        <tr><td>79</td><td>74</td><td>Rinnosuke Morichika</td><td class='jump'>+5</td></tr>
        <tr><td>82</td><td>75</td><td>Mima</td><td class='jump'>+7</td></tr>
        <tr><td>69</td><td>76</td><td>Kosuzu Motoori</td><td class='drop'>-7</td></tr>
        <tr><td>72</td><td>77</td><td>Komachi Onozuka</td><td class='drop'>-5</td></tr>
        <tr><td>81</td><td>78</td><td>Mamizou Futatsuiwa</td><td class='jump'>+3</td></tr>
        <tr><td>78</td><td>79</td><td>Kanako Yasaka</td><td class='drop'>-1</td></tr>
        <tr><td>74</td><td>80</td><td>Hatate Himekaidou</td><td class='drop'>-6</td></tr>
        <tr><td>85</td><td>81</td><td>Wriggle Nightbug</td><td class='jump'>+4</td></tr>
        <tr><td>73</td><td>82</td><td>Shinmyoumaru Sukuna</td><td class='drop'>-9</td></tr>
        <tr><td>62</td><td>83</td><td>Momoyo Himemushi</td><td class='drop'>-21</td></tr>
        <tr><td>84</td><td>84</td><td>Lunasa Prismriver</td><td class='stable'>0</td></tr>
        <tr><td>95</td><td>85</td><td>Medicine Melancholy</td><td class='jump'>+10</td></tr>
        <tr><td>87</td><td>86</td><td>Yoshika Miyako</td><td class='jump'>+1</td></tr>
        <tr><td>83</td><td>87</td><td>Hieda no Akyuu</td><td class='drop'>-4</td></tr>
        <tr><td>86</td><td>88</td><td>Raiko Horikawa</td><td class='drop'>-2</td></tr>
        <tr><td>93</td><td>89</td><td>Shizuha Aki</td><td class='jump'>+4</td></tr>
        <tr><td>98</td><td>90</td><td>Shinki</td><td class='jump'>+8</td></tr>
        <tr><td>90</td><td>91</td><td>Watatsuki no Yorihime</td><td class='drop'>-1</td></tr>
        <tr><td>94</td><td>92</td><td>Minoriko Aki</td><td class='jump'>+2</td></tr>
        <tr><td>88</td><td>93</td><td>Saki Kurokoma</td><td class='drop'>-5</td></tr>
        <tr><td>77</td><td>94</td><td>Mayumi Joutouguu</td><td class='drop'>-17</td></tr>
        <tr><td>96</td><td>95</td><td>Aunn Komano</td><td class='jump'>+1</td></tr>
        <tr><td>91</td><td>96</td><td>Lily White</td><td class='drop'>-5</td></tr>
        <tr><td>97</td><td>97</td><td>Wakasagihime</td><td class='stable'>0</td></tr>
        <tr><td>99</td><td>98</td><td>Shou Toramaru</td><td class='jump'>+1</td></tr>
        <tr><td>92</td><td>99</td><td>Miyoi Okunoda</td><td class='drop'>-7</td></tr>
        <tr><td>101</td><td>100</td><td>Yumemi Okazaki</td><td class='jump'>+1</td></tr>
        <tr><td>103</td><td>101</td><td>Letty Whiterock</td><td class='jump'>+2</td></tr>
        <tr><td>104</td><td>102</td><td>Yamame Kurodani</td><td class='jump'>+2</td></tr>
        <tr><td>100</td><td>103</td><td>Mai Teireida</td><td class='drop'>-3</td></tr>
        <tr><td>109</td><td>104</td><td>Unnamed Jinyou (Fortune Teller)</td><td class='jump'>+5</td></tr>
        <tr><td>102</td><td>105</td><td>Kyouko Kasodani</td><td class='drop'>-3</td></tr>
        <tr><td>89</td><td>106</td><td>Mike Goutokuji</td><td class='drop'>-17</td></tr>
        <tr><td>105</td><td>107</td><td>Satono Nishida</td><td class='drop'>-2</td></tr>
        <tr><td>107</td><td>108</td><td>Watatsuki no Toyohime</td><td class='drop'>-1</td></tr>
        <tr><td>111</td><td>109</td><td>Merlin Prismriver</td><td class='jump'>+2</td></tr>
        <tr><td>110</td><td>110</td><td>Luna Child</td><td class='stable'>0</td></tr>
        <tr><td>114</td><td>111</td><td>Star Sapphire</td><td class='jump'>+3</td></tr>
        <tr><td>121</td><td>112</td><td>Eternity Larva</td><td class='jump'>+9</td></tr>
        <tr><td>113</td><td>113</td><td>Gengetsu</td><td class='stable'>0</td></tr>
        <tr><td>112</td><td>114</td><td>Ichirin Kumoi</td><td class='drop'>-2</td></tr>
        <tr><td>116</td><td>115</td><td>Alice's Dolls (Shanghai, Hourai, Ooedo, etc.)</td><td class='jump'>+1</td></tr>
        <tr><td>108</td><td>116</td><td>Seiran</td><td class='drop'>-8</td></tr>
        <tr><td>115</td><td>117</td><td>Benben Tsukumo</td><td class='drop'>-2</td></tr>
        <tr><td>118</td><td>118</td><td>Unnamed Book-Reading Youkai (Tokiko)</td><td class='stable'>0</td></tr>
        <tr><td>117</td><td>119</td><td>Lyrica Prismriver</td><td class='drop'>-2</td></tr>
        <tr><td>122</td><td>120</td><td>Ringo</td><td class='jump'>+2</td></tr>
        <tr><td>120</td><td>121</td><td>Sunny Milk</td><td class='drop'>-1</td></tr>
        <tr><td>119</td><td>122</td><td>Takane Yamashiro</td><td class='drop'>-3</td></tr>
        <tr><td>106</td><td>123</td><td>Misumaru Tamatsukuri</td><td class='drop'>-17</td></tr>
        <tr><td>125</td><td>124</td><td>Narumi Yatadera</td><td class='jump'>+1</td></tr>
        <tr><td>128</td><td>125</td><td>Dolls in Pseudo Paradise CD Jacket Girl</td><td class='jump'>+3</td></tr>
        <tr><td>123</td><td>125</td><td>Rei'sen</td><td class='drop'>-2</td></tr>
        <tr><td>126</td><td>127</td><td>Kana Anaberal</td><td class='drop'>-1</td></tr>
        <tr><td>127</td><td>128</td><td>Mugetsu</td><td class='drop'>-1</td></tr>
        <tr><td>133</td><td>129</td><td>Sariel</td><td class='jump'>+4</td></tr>
        <tr><td>124</td><td>130</td><td>Yatsuhashi Tsukumo</td><td class='drop'>-6</td></tr>
        <tr><td>137</td><td>131</td><td>Kisume</td><td class='jump'>+6</td></tr>
        <tr><td>129</td><td>132</td><td>Yumeko</td><td class='drop'>-3</td></tr>
        <tr><td>130</td><td>133</td><td>Anxious Moustached Villager</td><td class='drop'>-3</td></tr>
        <tr><td>143</td><td>134</td><td>Eika Ebisu</td><td class='jump'>+9</td></tr>
        <tr><td>131</td><td>135</td><td>Kurumi</td><td class='drop'>-4</td></tr>
        <tr><td>132</td><td>136</td><td>Youki Konpaku</td><td class='drop'>-4</td></tr>
        <tr><td>165</td><td>137</td><td>Louise</td><td class='jump'>+28</td></tr>
        <tr><td>-</td><td>138</td><td>Mizuchi Miyadeguchi</td><td class='stable'>0</td></tr>
        <tr><td>135</td><td>139</td><td>Chiyuri Kitashirakawa</td><td class='drop'>-4</td></tr>
        <tr><td>136</td><td>140</td><td>Urumi Ushizaki</td><td class='drop'>-4</td></tr>
        <tr><td>153</td><td>141</td><td>Kotohime</td><td class='jump'>+12</td></tr>
        <tr><td>134</td><td>142</td><td>Nemuno Sakata</td><td class='drop'>-8</td></tr>
        <tr><td>138</td><td>143</td><td>Sannyo Komakusa</td><td class='drop'>-5</td></tr>
        <tr><td>142</td><td>144</td><td>Konngara</td><td class='drop'>-2</td></tr>
        <tr><td>139</td><td>145</td><td>Kedama</td><td class='drop'>-6</td></tr>
        <tr><td>139</td><td>146</td><td>Unzan</td><td class='drop'>-7</td></tr>
        <tr><td>145</td><td>147</td><td>Mai</td><td class='drop'>-2</td></tr>
        <tr><td>148</td><td>148</td><td>Otter Spirit</td><td class='stable'>0</td></tr>
        <tr><td>144</td><td>148</td><td>Elis</td><td class='drop'>-4</td></tr>
        <tr><td>141</td><td>150</td><td>Ellen</td><td class='drop'>-9</td></tr>
    </tbody>
</table></div>
<h2 id='cpg'>Character vote per maingame</h2>
<h3 id='ctotals'>Totals per maingame</h3>
<div class='overflow'><table class='poll table sortable'>
        <colgroup>
            <col class='col2game'>
            <col class='col3'>
            <col class='col4'>
            <col class='col5'>
            <col class='col6per'>
        </colgroup>
        <thead>
            <tr>
                <th class='sorttable_numeric'>Rank</th>
                <th>Name</th>
                <th class='sorttable_numeric'>Points</th>
                <th class='sorttable_numeric'>No. 1 Votes</th>
                <th class='sorttable_numeric'>Comments</th>
            </tr>
        </thead>
    <tbody>
        <tr><td>1</td><td>EoSD</td><td>67,673</td><td>11,679</td><td>13,362</td></tr>
        <tr><td>2</td><td>PCB</td><td>43,043</td><td>3,537</td><td>3,468</td></tr>
        <tr><td>3</td><td>Reimu &amp; Marisa</td><td>32,257</td><td>6,180</td><td>6,112</td></tr></tr>
        <tr><td>4</td><td>SA</td><td>31,251</td><td>4,740</td><td>5,657</td></tr>
        <tr><td>5</td><td>IN</td><td>25,835</td><td>3,439</td><td>4,532</td></tr></tr>
        <tr><td>6</td><td>MoF</td><td>24,013</td><td>3,372</td><td>4,295</td></tr>
        <tr><td>7</td><td>PoFV</td><td>17,370</td><td>2,233</td><td>2,854</td></tr>
        <tr><td>8</td><td>LoLK</td><td>14,972</td><td>1,532</td><td>2,665</td></tr>
        <tr><td>9</td><td>UFO</td><td>13,228</td><td>1,600</td><td>2,279</td></tr>
        <tr><td>10</td><td>TD</td><td>12,633</td><td>1,583</td><td>2,349</td></tr>
        <tr><td>11</td><td>DDC</td><td>9,646</td><td>1,200</td><td>1,823</td></tr>
        <tr><td>12</td><td>UM</td><td>7,845</td><td>520</td><td>1,581</td></tr>
        <tr><td>13</td><td>WBaWC</td><td>7,183</td><td>600</td><td>1,374</td></tr>
        <tr><td>14</td><td>HSiFS</td><td>5,560</td><td>454</td><td>1,117</td></tr>
    </tbody>
</table></div>
<h2 id='mpg'>Music vote per maingame</h2>
<h3 id='mtotals'>Totals per maingame</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col3'>
        <col class='col4'>
        <col class='col5'>
        <col class='col6per'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>EoSD</td><td>71,386</td><td>11,783</td><td>7,599</td></tr>
        <tr><td>2</td><td>IN</td><td>40,021</td><td>4,003</td><td>3,978</td></tr></tr>
        <tr><td>3</td><td>PCB</td><td>35,913</td><td>3,537</td><td>3,468</td></tr>
        <tr><td>4</td><td>MoF</td><td>30,445</td><td>2,984</td><td>3,228</td></tr>
        <tr><td>5</td><td>SA</td><td>23,804</td><td>2,652</td><td>2,448</td></tr>
        <tr><td>6</td><td>LoLK</td><td>14,631</td><td>1,474</td><td>1,655</td></tr>
        <tr><td>7</td><td>WBaWC</td><td>11,581</td><td>1,539</td><td>1,418</td></tr>
        <tr><td>8</td><td>UFO</td><td>10,669</td><td>994</td><td>1,139</td></tr>
        <tr><td>12</td><td>PoFV</td><td>9,142</td><td>775</td><td>914</td></tr>
        <tr><td>11</td><td>TD</td><td>9,124</td><td>927</td><td>1,000</td></tr>
        <tr><td>9</td><td>DDC</td><td>8,341</td><td>812</td><td>898</td></tr>
        <tr><td>10</td><td>UM</td><td>7,047</td><td>465</td><td>860</td></tr>
        <tr><td>13</td><td>HSiFS</td><td>6,022</td><td>431</td><td>771</td></tr>
    </tbody>
</table></div>
<h3 id='meosd'>Touhou 6 - The Embodiment of Scarlet Devil</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Extra Boss</td><td>U.N. Owen Was Her?</td><td>18,520</td><td>4,765</td><td>2,410</td></tr>
        <tr><td>2</td><td>Stage 6 Boss</td><td>Septette for a Dead Princess</td><td>12,929</td><td>2,364</td><td>1,235</td></tr>
        <tr><td>3</td><td>Stage 3</td><td>Shanghai Teahouse ~ Chinese Tea</td><td>7,030</td><td>1,070</td><td>607</td></tr>
        <tr><td>4</td><td>Stage 5 Boss</td><td>Lunar Clock ~ Luna Dial</td><td>5,602</td><td>664</td><td>546</td></tr>
        <tr><td>5</td><td>Stage 2 Boss</td><td>Tomboyish Girl in Love</td><td>4,617</td><td>552</td><td>526</td></tr>
        <tr><td>6</td><td>Stage 3 Boss</td><td>Shanghai Alice of Meiji 17</td><td>3,236</td><td>416</td><td>310</td></tr>
        <tr><td>7</td><td>Extra Stage</td><td>The Centennial Festival for Magical Girls</td><td>3,087</td><td>274</td><td>325</td></tr>
        <tr><td>8</td><td>Stage 1 Boss</td><td>Apparitions Stalk the Night</td><td>2,906</td><td>406</td><td>301</td></tr>
        <tr><td>12</td><td>Staff Roll/Credits</td><td>Crimson Tower ~ Eastern Dream...</td><td>2,905</td><td>242</td><td>402</td></tr>
        <tr><td>9</td><td>Stage 5</td><td>The Maid and the Pocket Watch of Blood</td><td>2,464</td><td>253</td><td>219</td></tr>
        <tr><td>10</td><td>Stage 4 Boss</td><td>Locked Girl ~ The Girl's Secret Room</td><td>2,002</td><td>184</td><td>173</td></tr>
        <tr><td>11</td><td>Title</td><td>A Dream that Is More Scarlet than Red</td><td>1,579</td><td>212</td><td>167</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>A Soul as Red as a Ground Cherry</td><td>1,342</td><td>141</td><td>118</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>Lunate Elf</td><td>992</td><td>88</td><td>82</td></tr>
        <tr><td>15</td><td>Stage 4</td><td>Voile, the Magic Library</td><td>947</td><td>78</td><td>72</td></tr>
        <tr><td>16</td><td>Stage 6</td><td>The Young Descendant of Tepes</td><td>878</td><td>53</td><td>81</td></tr>
        <tr><td>17</td><td>Ending</td><td>An Eternity that Is More Transient than Scarlet</td><td>350</td><td>21</td><td>25</td></tr>
    </tbody>
    <tfoot>
        <tr>
            <th colspan='3'>Total</th><td>71,386</td><td>11,783</td><td>7,599</td></tr>
    </tfoot>
</table></div>
<h3 id='mpcb'>Touhou 7 - Perfect Cherry Blossom</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>3</td><td>Phantasm Boss</td><td>Necrofantasia</td><td>6,147</td><td>576</td><td>583</td></tr>
        <tr><td>1</td><td>Stage 6 Boss</td><td>Bloom Nobly, Ink-Black Cherry Blossom ~ Border of Life</td><td>6,023</td><td>728</td><td>524</td></tr>
        <tr><td>2</td><td>Stage 4 Boss</td><td>Ghostly Band ~ Phantom Ensemble</td><td>5,491</td><td>556</td><td>579</td></tr>
        <tr><td>4</td><td>Stage 5 Boss</td><td>Hiroari Shoots a Strange Bird ~ Till When?</td><td>2,699</td><td>328</td><td>255</td></tr>
        <tr><td>5</td><td>Stage 3 Boss</td><td>Doll Judgment</td><td>2,485</td><td>212</td><td>222</td></tr>
        <tr><td>7</td><td>Final Spell</td><td>Border of Life</td><td>2,327</td><td>139</td><td>275</td></tr>
        <tr><td>6</td><td>Stage 5</td><td>Eastern Mystical Dream ~ Ancient Temple</td><td>1,801</td><td>193</td><td>157</td></tr>
        <tr><td>8</td><td>Stage 2</td><td>The Fantastic Tales from Tono</td><td>1,470</td><td>164</td><td>144</td></tr>
        <tr><td>9</td><td>Staff Roll/Credits</td><td>Sakura, Sakura ~ Japanize Dream...</td><td>1,062</td><td>62</td><td>138</td></tr>
        <tr><td>11</td><td>Stage 4</td><td>The Capital City of Flowers in the Sky</td><td>958</td><td>117</td><td>79</td></tr>
        <tr><td>10</td><td>Extra Boss</td><td>A Maiden's Illusionary Funeral ~ Necro-Fantasy</td><td>942</td><td>79</td><td>90</td></tr>
        <tr><td>12</td><td>Stage 3</td><td>The Doll Maker of Bucuresti</td><td>855</td><td>78</td><td>71</td></tr>
        <tr><td>15</td><td>Title</td><td>Mystic Dream ~ Snow or Cherry Petal</td><td>727</td><td>68</td><td>57</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>Paradise ~ Deep Mountain</td><td>672</td><td>62</td><td>64</td></tr>
        <tr><td>14</td><td>Stage 6</td><td>Ultimate Truth</td><td>625</td><td>52</td><td>62</td></tr>
        <tr><td>17</td><td>Phantasm Stage</td><td>Youkai Domination ~ Who done it?</td><td>459</td><td>31</td><td>46</td></tr>
        <tr><td>16</td><td>Stage 1 Boss</td><td>Crystallized Silver</td><td>459</td><td>29</td><td>48</td></tr>
        <tr><td>18</td><td>Stage 2 Boss</td><td>Diao ye zong (Withered Leaf)</td><td>405</td><td>38</td><td>39</td></tr>
        <tr><td>19</td><td>Extra Stage</td><td>Youkai Domination</td><td>256</td><td>22</td><td>32</td></tr>
        <tr><td>20</td><td>Ending</td><td>Dream of a Spring Breeze</td><td>50</td><td>3</td><td>3</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>35,913</td><td>3,537</td><td>3,468</td></tr>
    </tfoot>
</table></div>
<h3 id='min'>Touhou 8 - Imperishable Night</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Extra Boss</td><td>Reach for the Moon, Immortal Smoke</td><td>8,154</td><td>1,110</td><td>838</td></tr>
        <tr><td>2</td><td>Stage 4B Boss</td><td>Love-Coloured Master Spark (Love-coloured Magic)</td><td>7,883</td><td>832</td><td>819</td></tr>
        <tr><td>4</td><td>Stage 4A Boss</td><td>Maiden's Capriccio / Dream Battle</td><td>4,031</td><td>359</td><td>406</td></tr>
        <tr><td>3</td><td>Stage 6B Boss</td><td>Flight in the Bamboo Cutter ~ Lunatic Princess</td><td>3,381</td><td>278</td><td>321</td></tr>
        <tr><td>6</td><td>Stage 5 Boss</td><td>Lunatic Eyes ~ Invisible Full Moon</td><td>3,357</td><td>270</td><td>334</td></tr>
        <tr><td>5</td><td>Stage 6A Boss</td><td>Gensokyo Millennium ~ History of the Moon</td><td>3,303</td><td>329</td><td>314</td></tr>
        <tr><td>7</td><td>Stage 2 Boss</td><td>Deaf to All but the Song</td><td>1,337</td><td>111</td><td>126</td></tr>
        <tr><td>8</td><td>Stage 5</td><td>Cinderella Cage ~ Kagome-Kagome</td><td>1,047</td><td>84</td><td>92</td></tr>
        <tr><td>12</td><td>Stage 3</td><td>Nostalgic Blood of the East ~ Old World</td><td>1,044</td><td>101</td><td>93</td></tr>
        <tr><td>9</td><td>Stage 3 Boss</td><td>Plain Asia</td><td>1,016</td><td>93</td><td>98</td></tr>
        <tr><td>10</td><td>Stage 6</td><td>Voyage 1969</td><td>998</td><td>74</td><td>87</td></tr>
        <tr><td>11</td><td>Extra Stage</td><td>Extend Ash ~ Person of Hourai</td><td>900</td><td>71</td><td>91</td></tr>
        <tr><td>14</td><td>Stage 4</td><td>Retribution for the Eternal Night ~ Imperishable Night</td><td>724</td><td>78</td><td>82</td></tr>
        <tr><td>13</td><td>Last Word</td><td>Eastern Youkai Beauty</td><td>705</td><td>37</td><td>85</td></tr>
        <tr><td>15</td><td>Stage 6 Last Spell</td><td>Voyage 1970</td><td>520</td><td>31</td><td>42</td></tr>
        <tr><td>16</td><td>Stage 1 Boss</td><td>Stirring an Autumn Moon ~ Mooned Insect</td><td>444</td><td>57</td><td>42</td></tr>
        <tr><td>17</td><td>Stage 2</td><td>Song of the Night Sparrow ~ Night Bird</td><td>354</td><td>28</td><td>30</td></tr>
        <tr><td>18</td><td>Title</td><td>Eternal Night Vignette ~ Eastern Night.</td><td>310</td><td>16</td><td>30</td></tr>
        <tr><td>19</td><td>Stage 1</td><td>Illusionary Night ~ Ghostly Eyes</td><td>251</td><td>19</td><td>24</td></tr>
        <tr><td>20</td><td>Staff Roll/Credits</td><td>Mystical Maple ~ Eternal Dream</td><td>193</td><td>22</td><td>19</td></tr>
        <tr><td>21</td><td>Ending</td><td>Evening Primrose</td><td>69</td><td>3</td><td>5</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>40,021</td><td>4,003</td><td>3,978</td></tr>
    </tfoot>
</table></div>
<h3 id='mpofv'>Touhou 9 - Phantasmagoria of Flower View</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Sakuya</td><td>Flowering Night</td><td>3,247</td><td>248</td><td>309</td></tr>
        <tr><td>2</td><td>Eiki</td><td>Eastern Judgement in the Sixtieth Year ~ Fate of Sixty Years</td><td>2,419</td><td>247</td><td>229</td></tr>
        <tr><td>3</td><td>Yuuka</td><td>Gensokyo, Past and Present ~ Flower Land</td><td>722</td><td>64</td><td>85</td></tr>
        <tr><td>4</td><td>Komachi</td><td>Higan Retour ~ Riverside View</td><td>653</td><td>61</td><td>59</td></tr>
        <tr><td>5</td><td>Marisa</td><td>Oriental Dark Flight</td><td>567</td><td>46</td><td>75</td></tr>
        <tr><td>6</td><td>Reimu</td><td>Spring Lane ~ Colorful Path</td><td>556</td><td>32</td><td>61</td></tr>
        <tr><td>8</td><td>Medicine</td><td>Poison Body ~ Forsaken Doll</td><td>262</td><td>25</td><td>28</td></tr>
        <tr><td>7</td><td>Ending</td><td>The Flowers Remain in Fantasy</td><td>236</td><td>22</td><td>19</td></tr>
        <tr><td>9</td><td>Tewi</td><td>White Flag of Usa Shrine</td><td>231</td><td>13</td><td>20</td></tr>
        <tr><td>10</td><td>Title</td><td>Flower Viewing Mound ~ Higan Retour</td><td>159</td><td>11</td><td>21</td></tr>
        <tr><td>12</td><td>Staff Roll/Credits</td><td>Flower of Soul ~ Another Dream...</td><td>34</td><td>4</td><td>2</td></tr>
        <tr><td>11</td><td>Pre-Battle 1</td><td>The Mound Where the Flowers Reflect</td><td>34</td><td>1</td><td>3</td></tr>
        <tr><td>13</td><td>Pre-Battle 2</td><td>Mound of Life</td><td>22</td><td>1</td><td>3</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>9,142</td><td>775</td><td>914</td></tr>
    </tfoot>
</table></div>
<h3 id='mmof'>Touhou 10 - Mountain of Faith</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 3</td><td>The Gensokyo The Gods Loved</td><td>7,015</td><td>754</td><td>798</td></tr>
        <tr><td>2</td><td>Extra Boss</td><td>Native Faith</td><td>5,096</td><td>590</td><td>561</td></tr>
        <tr><td>3</td><td>Stage 5 Boss</td><td>Faith Is for the Transient People</td><td>2,860</td><td>298</td><td>272</td></tr>
        <tr><td>4</td><td>Stage 4</td><td>Fall of Fall ~ Autumnal Waterfall</td><td>2,403</td><td>280</td><td>269</td></tr>
        <tr><td>6</td><td>Stage 3 Boss</td><td>Akutagawa Ryuunosuke's "Kappa" ~ Candid Friend</td><td>1,971</td><td>163</td><td>206</td></tr>
        <tr><td>5</td><td>Extra Stage</td><td>Tomorrow Will Be Special, Yesterday Was Not</td><td>1,698</td><td>136</td><td>179</td></tr>
        <tr><td>9</td><td>Stage 2 Boss</td><td>Dark Side of Fate</td><td>1,658</td><td>119</td><td>156</td></tr>
        <tr><td>7</td><td>Stage 4 Boss</td><td>The Youkai Mountain ~ Mysterious Mountain</td><td>1,500</td><td>158</td><td>148</td></tr>
        <tr><td>12</td><td>Stage 2</td><td>The Road of the Misfortune God ~ Dark Road</td><td>1,439</td><td>133</td><td>152</td></tr>
        <tr><td>8</td><td>Stage 6 Boss</td><td>The Venerable Ancient Battlefield ~ Suwa Foughten Field</td><td>1,333</td><td>108</td><td>145</td></tr>
        <tr><td>11</td><td>Stage 1 Boss</td><td>Because Princess Inada Is Scolding Me</td><td>1,297</td><td>86</td><td>130</td></tr>
        <tr><td>10</td><td>Stage 5</td><td>The Primal Scene of Japan the Girl Saw</td><td>1,228</td><td>101</td><td>109</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>A God That Misses People ~ Romantic Fall</td><td>301</td><td>26</td><td>32</td></tr>
        <tr><td>14</td><td>Stage 6</td><td>Cemetery of Onbashira ~ Grave of Being</td><td>276</td><td>14</td><td>30</td></tr>
        <tr><td>15</td><td>Title</td><td>Sealed Gods</td><td>192</td><td>14</td><td>22</td></tr>
        <tr><td>16</td><td>Game Over</td><td>Player’s Score</td><td>69</td><td>1</td><td>8</td></tr>
        <tr><td>17</td><td>Staff Roll/Credits</td><td>The Gods Give Us Blessed Rain ~ Sylphid Dream</td><td>64</td><td>1</td><td>8</td></tr>
        <tr><td>18</td><td>Ending</td><td>Shrine at the Foot of the Mountain</td><td>45</td><td>2</td><td>3</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>30,445</td><td>2,984</td><td>3,228</td></tr>
    </tfoot>
</table></div>
<h3 id='msa'>Touhou 11 - Subterranean Animism</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Extra Boss</td><td>Hartmann's Youkai Girl</td><td>9,215</td><td>1,246</td><td>998</td></tr>
        <tr><td>2</td><td>Stage 4 Boss</td><td>Satori Maiden ~ 3rd eye</td><td>3,544</td><td>406</td><td>350</td></tr>
        <tr><td>3</td><td>Extra Stage</td><td>Last Remote</td><td>3,041</td><td>298</td><td>261</td></tr>
        <tr><td>4</td><td>Stage 6 Boss</td><td>Solar Sect of Mystic Wisdom ~ Nuclear Fusion</td><td>2,144</td><td>209</td><td>222</td></tr>
        <tr><td>5</td><td>Stage 5</td><td>Lullaby of Deserted Hell</td><td>1,389</td><td>129</td><td>138</td></tr>
        <tr><td>6</td><td>Stage 2 Boss</td><td>Green-Eyed Jealousy</td><td>1,125</td><td>120</td><td>103</td></tr>
        <tr><td>7</td><td>Stage 3</td><td>Walking the Streets of a Former Hell</td><td>728</td><td>39</td><td>78</td></tr>
        <tr><td>8</td><td>Stage 5 Boss</td><td>Corpse Voyage ~ Be of good cheer!</td><td>582</td><td>35</td><td>63</td></tr>
        <tr><td>9</td><td>Stage 3 Boss</td><td>A Flower-Studded Sake Dish on Mt. Ooe</td><td>514</td><td>49</td><td>63</td></tr>
        <tr><td>10</td><td>Stage 4</td><td>Heartfelt Fancy</td><td>409</td><td>39</td><td>33</td></tr>
        <tr><td>11</td><td>Stage 2</td><td>The Bridge People No Longer Cross</td><td>293</td><td>31</td><td>33</td></tr>
        <tr><td>12</td><td>Stage 1</td><td>The Dark Blowhole</td><td>234</td><td>14</td><td>32</td></tr>
        <tr><td>13</td><td>Stage 6</td><td>Hellfire Mantle</td><td>229</td><td>16</td><td>20</td></tr>
        <tr><td>14</td><td>Stage 1 Boss</td><td>The Sealed-Away Youkai ~ Lost Place</td><td>173</td><td>13</td><td>26</td></tr>
        <tr><td>15</td><td>Title</td><td>Awakening of the Earth Spirits</td><td>93</td><td>5</td><td>16</td></tr>
        <tr><td>16</td><td>Ending</td><td>The Earth Spirits' Homecoming</td><td>57</td><td>2</td><td>7</td></tr>
        <tr><td>17</td><td>Staff Roll/Credits</td><td>Energy Daybreak ~ Future Dream...</td><td>34</td><td>1</td><td>5</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>23,804</td><td>2,652</td><td>2,448</td></tr>
    </tfoot>
</table></div>
<h3 id='mufo'>Touhou 12 - Undefined Fantastic Object</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 6 Boss</td><td>Emotional Skyscraper ~ Cosmic Mind</td><td>2,956</td><td>322</td><td>275</td></tr>
        <tr><td>2</td><td>Extra Boss</td><td>Heian Alien</td><td>1,606</td><td>152</td><td>162</td></tr>
        <tr><td>3</td><td>Stage 1</td><td>At the End of Spring</td><td>1,490</td><td>144</td><td>158</td></tr>
        <tr><td>4</td><td>Stage 2 Boss</td><td>Beware the Umbrella Left There Forever</td><td>864</td><td>85</td><td>106</td></tr>
        <tr><td>5</td><td>Stage 4</td><td>Interdimensional Voyage of a Ghostly Passenger Ship</td><td>794</td><td>74</td><td>88</td></tr>
        <tr><td>6</td><td>Extra Stage</td><td>UFO Romance in the Night Sky</td><td>543</td><td>39</td><td>53</td></tr>
        <tr><td>7</td><td>Stage 4 Boss</td><td>Captain Murasa</td><td>529</td><td>43</td><td>65</td></tr>
        <tr><td>8</td><td>Stage 5 Boss</td><td>The Tiger-Patterned Vaisravana</td><td>377</td><td>27</td><td>59</td></tr>
        <tr><td>11</td><td>Stage 1 Boss</td><td>A Tiny, Tiny, Clever Commander</td><td>375</td><td>35</td><td>42</td></tr>
        <tr><td>9</td><td>Stage 6</td><td>Fires of Hokkai</td><td>357</td><td>24</td><td>31</td></tr>
        <tr><td>10</td><td>Stage 5</td><td>Rural Makai City Esoteria</td><td>324</td><td>27</td><td>46</td></tr>
        <tr><td>12</td><td>Stage 3 Boss</td><td>The Traditional Old Man and the Stylish Girl</td><td>162</td><td>12</td><td>14</td></tr>
        <tr><td>13</td><td>Stage 3</td><td>Sky Ruin</td><td>89</td><td>4</td><td>6</td></tr>
        <tr><td>15</td><td>Staff Roll/Credits</td><td>Returning Home From the Sky ~ Sky Dream</td><td>70</td><td>2</td><td>13</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>The Sealed Cloud Route</td><td>70</td><td>0</td><td>9</td></tr>
        <tr><td>16</td><td>Title</td><td>A Shadow in the Blue Sky</td><td>52</td><td>3</td><td>12</td></tr>
        <tr><td>17</td><td>Ending</td><td>Youkai Temple</td><td>11</td><td>1</td><td>0</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>10,669</td><td>994</td><td>1,139</td></tr>
    </tfoot>
</table></div>
<h3 id='mtd'>Touhou 13 - Ten Desires</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 4</td><td>Desire Drive</td><td>2,898</td><td>330</td><td>308</td></tr>
        <tr><td>2</td><td>Stage 6 Boss</td><td>Shoutoku Legend ~ True Administrator</td><td>1,691</td><td>183</td><td>170</td></tr>
        <tr><td>3</td><td>Stage 4 Boss</td><td>Old Yuanxian</td><td>1,109</td><td>98</td><td>116</td></tr>
        <tr><td>4</td><td>Stage 1</td><td>Night Sakura of Dead Spirits</td><td>668</td><td>68</td><td>72</td></tr>
        <tr><td>5</td><td>Stage 5 Boss</td><td>Omiwa Legend</td><td>622</td><td>76</td><td>79</td></tr>
        <tr><td>6</td><td>Extra Boss</td><td>Futatsuiwa from Sado</td><td>532</td><td>42</td><td>48</td></tr>
        <tr><td>7</td><td>Stage 5</td><td>Dream Palace of the Great Mausoleum</td><td>375</td><td>46</td><td>53</td></tr>
        <tr><td>9</td><td>Stage 3 Boss</td><td>Rigid Paradise</td><td>294</td><td>25</td><td>33</td></tr>
        <tr><td>8</td><td>Stage 3</td><td>Let's Live in a Lovely Cemetery</td><td>257</td><td>18</td><td>32</td></tr>
        <tr><td>10</td><td>Extra Stage</td><td>Youkai Back Shrine Road</td><td>170</td><td>11</td><td>23</td></tr>
        <tr><td>12</td><td>Staff Roll/Credits</td><td>Desire Dream</td><td>130</td><td>11</td><td>19</td></tr>
        <tr><td>11</td><td>Stage 6</td><td>Starry Sky of Small Desires</td><td>119</td><td>7</td><td>12</td></tr>
        <tr><td>13</td><td>Stage 1 Boss</td><td>Ghost Lead</td><td>72</td><td>1</td><td>10</td></tr>
        <tr><td>14</td><td>Stage 2 Boss</td><td>Youkai Girl at the Gate</td><td>64</td><td>9</td><td>8</td></tr>
        <tr><td>16</td><td>Title</td><td>Spirit of Avarice</td><td>58</td><td>1</td><td>7</td></tr>
        <tr><td>15</td><td>Stage 2</td><td>Welcome to Youkai Temple</td><td>55</td><td>1</td><td>10</td></tr>
        <tr><td>17</td><td>Ending</td><td>A New Wind at the Shrine</td><td>10</td><td>0</td><td>0</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>9,124</td><td>927</td><td>1,000</td></tr>
    </tfoot>
</table></div>
<h3 id='mddc'>Touhou 14 - Double Dealing Character</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 6 Boss</td><td>Inchlings of the Shining Needle ~ Little Princess</td><td>2,709</td><td>291</td><td>230</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>Reverse Ideology</td><td>1,356</td><td>170</td><td>164</td></tr>
        <tr><td>3</td><td>Extra Boss</td><td>Primordial Beat ~ Pristine Beat</td><td>1,132</td><td>103</td><td>125</td></tr>
        <tr><td>5</td><td>Title</td><td>Mysterious Purification Rod</td><td>711</td><td>65</td><td>100</td></tr>
        <tr><td>4</td><td>Stage 4 Boss</td><td>Illusionary Joururi</td><td>668</td><td>55</td><td>68</td></tr>
        <tr><td>6</td><td>Stage 3</td><td>Bamboo Forest of the Full Moon</td><td>348</td><td>28</td><td>30</td></tr>
        <tr><td>7</td><td>Stage 2 Boss</td><td>Dullahan Under the Willows</td><td>312</td><td>25</td><td>32</td></tr>
        <tr><td>8</td><td>Stage 5</td><td>The Shining Needle Castle Sinking in the Air</td><td>263</td><td>31</td><td>33</td></tr>
        <tr><td>9</td><td>Stage 1 Boss</td><td>Mermaid from the Uncharted Land</td><td>203</td><td>14</td><td>23</td></tr>
        <tr><td>10</td><td>Stage 1</td><td>Mist Lake</td><td>174</td><td>14</td><td>14</td></tr>
        <tr><td>11</td><td>Stage 3 Boss</td><td>Lonesome Werewolf</td><td>167</td><td>3</td><td>27</td></tr>
        <tr><td>13</td><td>Staff Roll/Credits</td><td>Strange, Strange Instruments</td><td>81</td><td>6</td><td>20</td></tr>
        <tr><td>12</td><td>Extra Stage</td><td>Thunderclouds of Magical Power</td><td>68</td><td>1</td><td>16</td></tr>
        <tr><td>15</td><td>Stage 2</td><td>Humans and Youkai Traversing the Canal</td><td>51</td><td>3</td><td>6</td></tr>
        <tr><td>16</td><td>Stage 6</td><td>The Exaggerated Castle Keep</td><td>41</td><td>2</td><td>1</td></tr>
        <tr><td>14</td><td>Stage 4</td><td>Magical Storm</td><td>39</td><td>1</td><td>6</td></tr>
        <tr><td>17</td><td>Ending</td><td>Magical Power of the Mallet</td><td>18</td><td>0</td><td>3</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>8,341</td><td>812</td><td>898</td></tr>
    </tfoot>
</table></div>
<h3 id='mlolk'>Touhou 15 - Legacy of Lunatic Kingdom</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 6 Boss</td><td>Pure Furies ~ Whereabouts of the Heart</td><td>5,675</td><td>800</td><td>620</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>The Pierrot of the Star-Spangled Banner</td><td>1,651</td><td>95</td><td>200</td></tr>
        <tr><td>3</td><td>Extra Boss</td><td>Pandemonic Planet</td><td>1,594</td><td>157</td><td>173</td></tr>
        <tr><td>4</td><td>Stage 6</td><td>The Sea Where the Home Planet is Reflected</td><td>1,106</td><td>74</td><td>118</td></tr>
        <tr><td>5</td><td>Stage 3 Boss</td><td>Eternal Spring Dream</td><td>997</td><td>88</td><td>116</td></tr>
        <tr><td>6</td><td>Stage 5</td><td>Faraway 380,000-Kilometer Voyage</td><td>729</td><td>51</td><td>84</td></tr>
        <tr><td>7</td><td>Stage 4 Boss</td><td>The Reversed Wheel of Fortune</td><td>596</td><td>62</td><td>77</td></tr>
        <tr><td>9</td><td>Stage 4</td><td>The Frozen Eternal Capital</td><td>527</td><td>43</td><td>58</td></tr>
        <tr><td>8</td><td>Stage 1 Boss</td><td>The Rabbit Has Landed</td><td>511</td><td>26</td><td>70</td></tr>
        <tr><td>11</td><td>Extra Stage</td><td>A Never-Before-Seen World of Nightmares</td><td>350</td><td>23</td><td>41</td></tr>
        <tr><td>10</td><td>Stage 2 Boss</td><td>September Pumpkin</td><td>338</td><td>22</td><td>32</td></tr>
        <tr><td>12</td><td>Stage 3</td><td>The Mysterious Shrine Maiden Flying Through Space</td><td>191</td><td>14</td><td>18</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>Unforgettable, the Nostalgic Greenery</td><td>131</td><td>7</td><td>18</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>The Lake Reflects the Cleansed Moonlight</td><td>90</td><td>5</td><td>13</td></tr>
        <tr><td>15</td><td>Title</td><td>The Space Shrine Maiden Appears</td><td>78</td><td>5</td><td>8</td></tr>
        <tr><td>16</td><td>Staff Roll/Credits</td><td>The Space Shrine Maiden Returns Home</td><td>37</td><td>1</td><td>4</td></tr>
        <tr><td>17</td><td>Ending</td><td>The Moon as Seen from the Shrine</td><td>30</td><td>1</td><td>5</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>14,631</td><td>1,474</td><td>1,655</td></tr>
    </tfoot>
</table></div>
<h3 id='mhsifs'>Touhou 16 - Hidden Star in Four Seasons</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Extra Boss</td><td>Secret God Matara ~ Hidden Star in All Seasons.</td><td>1,871</td><td>160</td><td>249</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>Crazy Backup Dancers</td><td>1,109</td><td>54</td><td>124</td></tr>
        <tr><td>3</td><td>Stage 6 Boss</td><td>The Concealed Four Seasons</td><td>1,081</td><td>101</td><td>124</td></tr>
        <tr><td>4</td><td>Stage 4</td><td>Illusionary White Traveler</td><td>644</td><td>49</td><td>86</td></tr>
        <tr><td>5</td><td>Stage 1</td><td>A Star of Hope Rises in the Blue Sky</td><td>362</td><td>19</td><td>57</td></tr>
        <tr><td>7</td><td>Stage 1 Boss</td><td>A Midsummer Fairy's Dream</td><td>150</td><td>4</td><td>24</td></tr>
        <tr><td>8</td><td>Stage 3 Boss</td><td>A Pair of Divine Beasts</td><td>141</td><td>14</td><td>17</td></tr>
        <tr><td>9</td><td>Stage 3</td><td>Swim in a Cherry Blossom-Colored Sea</td><td>112</td><td>4</td><td>18</td></tr>
        <tr><td>10</td><td>Extra Stage</td><td>No More Going Through Doors</td><td>111</td><td>6</td><td>15</td></tr>
        <tr><td>6</td><td>Stage 5</td><td>Does the Forbidden Door Lead to This World, or the World Beyond?</td><td>111</td><td>4</td><td>15</td></tr>
        <tr><td>11</td><td>Stage 4 Boss</td><td>The Magic Straw-Hat Ksitigarbha</td><td>76</td><td>5</td><td>9</td></tr>
        <tr><td>12</td><td>Stage 6</td><td>Into Backdoor</td><td>66</td><td>4</td><td>10</td></tr>
        <tr><td>14</td><td>Title</td><td>The Sky Where Cherry Blossoms Flutter Down</td><td>57</td><td>1</td><td>8</td></tr>
        <tr><td>13</td><td>Staff Roll/Credits</td><td>White Traveler</td><td>45</td><td>0</td><td>5</td></tr>
        <tr><td>15</td><td>Stage 2 Boss</td><td>Deep-Mountain Encounter</td><td>42</td><td>4</td><td>5</td></tr>
        <tr><td>16</td><td>Stage 2</td><td>The Colorless Wind on Youkai Mountain</td><td>35</td><td>1</td><td>4</td></tr>
        <tr><td>17</td><td>Ending</td><td>Unnatural Nature</td><td>9</td><td>1</td><td>1</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>6,022</td><td>431</td><td>771</td></tr>
    </tfoot>
</table></div>
<h3 id='mwbawc'>Touhou 17 - Wily Beast and Weakest Creature</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 6 Boss</td><td>Entrust this World to Idols ~ Idolatrize World</td><td>7,850</td><td>1,305</td><td>922</td></tr>
        <tr><td>3</td><td>Stage 4</td><td>Unlocated Hell</td><td>726</td><td>58</td><td>95</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>Joutoujin of Ceramics</td><td>542</td><td>31</td><td>62</td></tr>
        <tr><td>4</td><td>Extra Boss</td><td>Prince Shoutoku's Pegasus ~ Dark Pegasus</td><td>520</td><td>42</td><td>70</td></tr>
        <tr><td>7</td><td>Stage 3 Boss</td><td>Seraphic Chicken</td><td>458</td><td>27</td><td>61</td></tr>
        <tr><td>5</td><td>Stage 5</td><td>Beast Metropolis</td><td>376</td><td>18</td><td>58</td></tr>
        <tr><td>6</td><td>Stage 6</td><td>Electric Heritage</td><td>319</td><td>13</td><td>43</td></tr>
        <tr><td>8</td><td>Stage 4 Boss</td><td>Tortoise Dragon ~ Fortune and Misfortune</td><td>221</td><td>19</td><td>28</td></tr>
        <tr><td>9</td><td>Stage 1 Boss</td><td>Jelly Stone</td><td>148</td><td>8</td><td>22</td></tr>
        <tr><td>10</td><td>Stage 1</td><td>The Lamentations Known Only by Jizo</td><td>108</td><td>7</td><td>15</td></tr>
        <tr><td>12</td><td>Title</td><td>Silent Beast Spirits</td><td>90</td><td>3</td><td>19</td></tr>
        <tr><td>11</td><td>Extra Stage</td><td>The Shining Law of the Strong Eating the Weak</td><td>89</td><td>3</td><td>9</td></tr>
        <tr><td>13</td><td>Stage 2 Boss</td><td>The Stone Baby and the Submerged Bovine</td><td>50</td><td>1</td><td>4</td></tr>
        <tr><td>15</td><td>Stage 3</td><td>Everlasting Red Spider Lily</td><td>47</td><td>3</td><td>7</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>Lost River</td><td>21</td><td>1</td><td>0</td></tr>
        <tr><td>16</td><td>Staff Roll/Credits</td><td>Returning Home from the Underground</td><td>9</td><td>0</td><td>3</td></tr>
        <tr><td>17</td><td>Ending</td><td>The Animals' Rest</td><td>7</td><td>0</td><td>0</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>11,581</td><td>1,539</td><td>1,418</td></tr>
    </tfoot>
</table></div>
<h3 id='mum'>Touhou 18 - Unconnected Marketeers</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2game'>
        <col class='col4'>
        <col class='col3'>
        <col class='col5'>
        <col class='col6per'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th class='sorttable_numeric'>Rank</th>
            <th>Theme</th>
            <th>Name</th>
            <th class='sorttable_numeric'>Points</th>
            <th class='sorttable_numeric'>No. 1 Votes</th>
            <th class='sorttable_numeric'>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 6 Boss</td><td>Where Is That Bustling Marketplace Now ~ Immemorial Marketeers</td><td>2,187</td><td>206</td><td>234</td></tr>
        <tr><td>2</td><td>Extra Boss</td><td>The Princess Who Slays Dragon Kings</td><td>1,032</td><td>48</td><td>116</td></tr>
        <tr><td>3</td><td>Stage 5 Boss</td><td>Starry Mountain of Tenma</td><td>720</td><td>53</td><td>105</td></tr>
        <tr><td>4</td><td>Stage 5</td><td>The Long-Awaited Oumagatoki</td><td>666</td><td>43</td><td>89</td></tr>
        <tr><td>6</td><td>Extra Stage</td><td>The Great Fantastic Underground Railway Network</td><td>464</td><td>30</td><td>61</td></tr>
        <tr><td>5</td><td>Stage 1 Boss</td><td>Kitten of Great Fortune</td><td>461</td><td>22</td><td>47</td></tr>
        <tr><td>7</td><td>Stage 3</td><td>The Perpetual Snow of Komakusa Blossoms</td><td>287</td><td>8</td><td>31</td></tr>
        <tr><td>9</td><td>Stage 4</td><td>The Obsolescent Industrial Remains</td><td>262</td><td>11</td><td>40</td></tr>
        <tr><td>12</td><td>Stage 6</td><td>Lunar Rainbow</td><td>215</td><td>12</td><td>35</td></tr>
        <tr><td>8</td><td>Stage 4 Boss</td><td>Ore from the Age of the Gods</td><td>205</td><td>6</td><td>27</td></tr>
        <tr><td>11</td><td>Stage 2 Boss</td><td>Banditry Technology</td><td>176</td><td>8</td><td>17</td></tr>
        <tr><td>10</td><td>Stage 3 Boss</td><td>Smoking Dragon</td><td>125</td><td>4</td><td>20</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>A Shower of Strange Occurrences</td><td>90</td><td>6</td><td>15</td></tr>
        <tr><td>14</td><td>Title</td><td>A Rainbow Spanning Gensokyo</td><td>78</td><td>5</td><td>11</td></tr>
        <tr><td>15</td><td>Stage 2</td><td>The Cliff Hidden in Deep Green</td><td>39</td><td>2</td><td>6</td></tr>
        <tr><td>16</td><td>Staff Roll/Credits</td><td>A Rainbow-Colored World</td><td>37</td><td>1</td><td>6</td></tr>
        <tr><td>17</td><td>Ending</td><td>The Sunday After the Storm</td><td>3</td><td>0</td><td>0</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>7,047</td><td>465</td><td>860</td></tr>
    </tfoot>
</table></div>
<p><strong><a href='#top'>Back to Top</a></strong></p>
<!--<h2 id='gender'>Gender vote</h2>
<h3 id='charas'>Characters</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2'>
        <col class='col4'>
        <col class='col2'>
        <col class='col3'>
        <col class='col2'>
        <col class='col5'>
    </colgroup>
    <thead>
        <tr>
            <th>Character</th>
            <th>Male Voters</th>
            <th>Character</th>
            <th>Male Voters</th>
            <th>Character</th>
            <th>Male Voters</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>Unzan</td><td class='mextreme'>97.30%</td><td>Lyrica</td><td class='mlean'>84.75%</td><td>Sakuya</td><td class='ftilt'>77.58%</td></tr>
        <tr><td>Youki</td><td class='mextreme'>96.36%</td><td>Eternity</td><td class='mlean'>84.67%</td><td>Hina</td><td class='ftilt'>77.52%</td></tr>
        <tr><td>Fortune Teller</td><td class='mstrong'>93.55%</td><td>Nitori</td><td class='mlean'>84.60%</td><td>Rinnosuke</td><td class='ftilt'>77.47%</td></tr>
        <tr><td>Mystia</td><td class='mstrong'>92.46%</td><td>Kokoro</td><td class='mlean'>84.43%</td><td>Nemuno</td><td class='flean'>77.19%</td></tr>
        <tr><td>Minoriko</td><td class='mstrong'>92.44%</td><td>Shion</td><td class='mlean'>84.43%</td><td>Shadow Kasen</td><td class='flean'>77.14%</td></tr>
        <tr><td>Iku</td><td class='mstrong'>92.33%</td><td>Tewi</td><td class='mtilt'>84.32%</td><td>Mike</td><td class='flean'>76.95%</td></tr>
        <tr><td>Lily White</td><td class='mstrong'>92.18%</td><td>Aunn</td><td class='mtilt'>83.94%</td><td>Sariel</td><td class='flean'>76.79%</td></tr>
        <tr><td>Shizuha</td><td class='mstrong'>92.12%</td><td>Merlin</td><td class='mtilt'>83.85%</td><td>Kanako</td><td class='flean'>76.69%</td></tr>
        <tr><td>Miyoi</td><td class='mstrong'>92.11%</td><td>Kutaka</td><td class='mtilt'>83.63%</td><td>Yuugi</td><td class='flean'>76.60%</td></tr>
        <tr><td>Kogasa</td><td class='mstrong'>91.96%</td><td>Gengetsu</td><td class='mtilt'>83.57%</td><td>Flandre</td><td class='flean'>76.49%</td></tr>
        <tr><td>Sunny Milk</td><td class='mstrong'>91.67%</td><td>Doremy</td><td class='mtilt'>83.37%</td><td>Mugetsu</td><td class='flean'>76.47%</td></tr>
        <tr><td>Kagerou</td><td class='mstrong'>90.96%</td><td>Koishi</td><td class='mtilt'>83.35%</td><td>Elis</td><td class='flean'>76.32%</td></tr>
        <tr><td>Momiji</td><td class='mstrong'>90.57%</td><td>Cirno</td><td class='mtilt'>83.35%</td><td>Eika</td><td class='flean'>76.19%</td></tr>
        <tr><td>Star Sapphire</td><td class='mstrong'>90.36%</td><td>Yatsuhashi</td><td class='mtilt'>83.16%</td><td>Mokou</td><td class='flean'>75.94%</td></tr>
        <tr><td>Kyouko</td><td class='mstrong'>90.29%</td><td>Sagume</td><td class='mtilt'>83.00%</td><td>Sumireko</td><td class='flean'>75.89%</td></tr>
        <tr><td>A. m. villager</td><td class='mstrong'>90.16%</td><td>Rei’sen</td><td class='mtilt'>82.93%</td><td>Hecatia</td><td class='flean'>75.73%</td></tr>
        <tr><td>Giant Catfish</td><td class='mstrong'>89.29%</td><td>Raiko</td><td class='mtilt'>82.83%</td><td>Kaguya</td><td class='flean'>75.63%</td></tr>
        <tr><td>Tenshi</td><td class='mstrong'>89.23%</td><td>Chimata</td><td class='mtilt'>82.72%</td><td>Kurumi</td><td class='flean'>75.41%</td></tr>
        <tr><td>Kosuzu</td><td class='mstrong'>88.58%</td><td>Shinmyoumaru</td><td class='mavg'>82.61%</td><td>Megumu</td><td class='flean'>75.29%</td></tr>
        <tr><td>Tokiko</td><td class='mstrong'>88.57%</td><td>Rin</td><td class='mavg'>82.48%</td><td>Eirin</td><td class='flean'>75.23%</td></tr>
        <tr><td>Sanae</td><td class='mstrong'>88.12%</td><td>Koakuma</td><td class='mavg'>82.35%</td><td>Seija</td><td class='flean'>75.00%</td></tr>
        <tr><td>Otter Spirit</td><td class='mlean'>87.50%</td><td>Kana</td><td class='mavg'>82.18%</td><td>Shou</td><td class='flean'>75.00%</td></tr>
        <tr><td>Akyuu</td><td class='mlean'>87.41%</td><td>Patchouli</td><td class='mavg'>82.10%</td><td>Chiyuri</td><td class='flean'>75.00%</td></tr>
        <tr><td>Seiran</td><td class='mlean'>87.27%</td><td>Chen</td><td class='mavg'>82.03%</td><td>Keine</td><td class='flean'>74.42%</td></tr>
        <tr><td>Youmu</td><td class='mlean'>86.92%</td><td>Sekibanki</td><td class='mavg'>81.88%</td><td>Ellen</td><td class='flean'>74.14%</td></tr>
        <tr><td>Komachi</td><td class='mlean'>86.55%</td><td>Alice</td><td class='mavg'>81.86%</td><td>Futo</td><td class='flean'>74.00%</td></tr>
        <tr><td>Yorihime</td><td class='mlean'>86.54%</td><td>Ringo</td><td class='mavg'>81.82%</td><td>Marisa</td><td class='flean'>73.94%</td></tr>
        <tr><td>Daiyousei</td><td class='mlean'>86.48%</td><td>Yuyuko</td><td class='mavg'>81.77%</td><td>Alice’s dolls</td><td class='flean'>73.91%</td></tr>
        <tr><td>Ran</td><td class='mlean'>86.43%</td><td>Takane</td><td class='mavg'>81.60%</td><td>Saki</td><td class='fstrong'>73.42%</td></tr>
        <tr><td>Luna Child</td><td class='mlean'>86.42%</td><td>Maribel</td><td class='mavg'>81.40%</td><td>Yumeko</td><td class='fstrong'>73.33%</td></tr>
        <tr><td>Byakuren</td><td class='mlean'>86.39%</td><td>Yuki</td><td class='mavg'>81.25%</td><td>Mamizou</td><td class='fstrong'>73.18%</td></tr>
        <tr><td>Letty</td><td class='mlean'>86.39%</td><td>Renko</td><td class='mavg'>81.08%</td><td>Yachie</td><td class='fstrong'>72.83%</td></tr>
        <tr><td>Wakasagihime</td><td class='mlean'>86.26%</td><td>Yukari</td><td class='favg'>80.80%</td><td>Parsee</td><td class='fstrong'>72.75%</td></tr>
        <tr><td>Aya</td><td class='mlean'>86.13%</td><td>Hatate</td><td class='favg'>80.77%</td><td>Medicine</td><td class='fstrong'>72.11%</td></tr>
        <tr><td>Shinki</td><td class='mlean'>86.11%</td><td>Benben</td><td class='favg'>80.45%</td><td>Momoyo</td><td class='fstrong'>71.85%</td></tr>
        <tr><td>Narumi</td><td class='mlean'>86.11%</td><td>Sannyo</td><td class='favg'>80.28%</td><td>Miko</td><td class='fstrong'>71.83%</td></tr>
        <tr><td>Satori</td><td class='mlean'>85.93%</td><td>Rumia</td><td class='favg'>80.24%</td><td>Okina</td><td class='fstrong'>71.53%</td></tr>
        <tr><td>Reisen</td><td class='mlean'>85.93%</td><td>Clownpiece</td><td class='favg'>80.13%</td><td>Murasa</td><td class='fstrong'>71.46%</td></tr>
        <tr><td>Nazrin</td><td class='mlean'>85.81%</td><td>Remilia</td><td class='favg'>79.79%</td><td>Mayumi</td><td class='fstrong'>70.70%</td></tr>
        <tr><td>Yamame</td><td class='mlean'>85.81%</td><td>Junko</td><td class='favg'>79.78%</td><td>Mai Teireida</td><td class='fstrong'>68.37%</td></tr>
        <tr><td>Urumi</td><td class='mlean'>85.71%</td><td>Yumemi</td><td class='favg'>79.68%</td><td>Kedama</td><td class='fstrong'>67.57%</td></tr>
        <tr><td>Utsuho</td><td class='mlean'>85.53%</td><td>Misumaru</td><td class='favg'>79.58%</td><td>Ichirin</td><td class='fstrong'>67.16%</td></tr>
        <tr><td>Lunasa</td><td class='mlean'>85.48%</td><td>Reimu</td><td class='favg'>79.31%</td><td>Satono</td><td class='fstrong'>66.67%</td></tr>
        <tr><td>Joon</td><td class='mlean'>85.33%</td><td>Nue</td><td class='ftilt'>78.86%</td><td>Mai PC-98</td><td class='fextreme'>63.41%</td></tr>
        <tr><td>Suwako</td><td class='mlean'>85.30%</td><td>Yuuka</td><td class='ftilt'>78.64%</td><td>Konngara</td><td class='fextreme'>63.16%</td></tr>
        <tr><td>Toyohime</td><td class='mlean'>85.26%</td><td>Meiling</td><td class='ftilt'>78.61%</td><td>Mima</td><td class='fextreme'>62.34%</td></tr>
        <tr><td>Eiki</td><td class='mlean'>85.08%</td><td>Kisume</td><td class='ftilt'>78.26%</td><td>Tojiko</td><td class='fextreme'>61.87%</td></tr>
        <tr><td>Kasen</td><td class='mlean'>84.83%</td><td>Elly</td><td class='ftilt'>78.13%</td><td>Seiga</td><td class='fextreme'>61.79%</td></tr>
        <tr><td>Suika</td><td class='mlean'>84.81%</td><td>Keiki</td><td class='ftilt'>77.62%</td><td>Yoshika</td><td class='fextreme'>59.90%</td></tr>
        <tr><td>Tsukasa</td><td class='mlean'>84.79%</td><td>Wriggle</td><td class='ftilt'>77.60%</td><td>DiPP girl</td><td class='fextreme'>58.33%</td></tr>
    </tbody>
</table></div>
<p><strong><a href='#top'>Back to Top</a></strong></p>
<h3 id='works'>Works</h3>
<div class='overflow'><table class='poll table sortable noborders'>
    <colgroup>
        <col class='col2'>
        <col class='col4'>
    </colgroup>
    <thead>
        <tr>
            <th>Work</th>
            <th>Male Voters</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>Hisoutensoku - Touhou 12.3</td><td class='mstrong'>92.06%</td></tr>
        <tr><td>Lotus Eaters</td><td class='mstrong'>91.41%</td></tr>
        <tr><td>SWR - Touhou 10.5</td><td class='mstrong'>89.06%</td></tr>
        <tr><td>Touhou Sangetsusei</td><td class='mstrong'>88.40%</td></tr>
        <tr><td>StB - Touhou 9.5</td><td class='mlean'>87.04%</td></tr>
        <tr><td>Gouyoku Ibun - Touhou 17.5</td><td class='mlean'>85.90%</td></tr>
        <tr><td>Alternative Facts in Eastern Utopia</td><td class='mlean'>85.32%</td></tr>
        <tr><td>MoF - Touhou 10</td><td class='mlean'>85.20%</td></tr>
        <tr><td>Wild and Horned Hermit</td><td class='mtilt'>84.35%</td></tr>
        <tr><td>AoCF - Touhou 15.5</td><td class='mtilt'>84.01%</td></tr>
        <tr><td>UM - Touhou 18</td><td class='mtilt'>83.67%</td></tr>
        <tr><td>PCB - Touhou 7</td><td class='mtilt'>83.56%</td></tr>
        <tr><td>Changeability of Strange Dream</td><td class='mtilt'>83.54%</td></tr>
        <tr><td>DS - Touhou 12.5</td><td class='mtilt'>83.15%</td></tr>
        <tr><td>Foul Detective Satori</td><td class='mtilt'>83.14%</td></tr>
        <tr><td>Retrospective 53 minutes</td><td class='mtilt'>83.09%</td></tr>
        <tr><td>Trojan Green Asteroid</td><td class='mtilt'>82.95%</td></tr>
        <tr><td>GFW - Touhou 12.8</td><td class='mtilt'>82.84%</td></tr>
        <tr><td>ISC - Touhou 14.3</td><td class='mtilt'>82.67%</td></tr>
        <tr><td>IaMP - Touhou 7.5</td><td class='mtilt'>82.64%</td></tr>
        <tr><td>HM - Touhou 13.5</td><td class='mavg'>82.25%</td></tr>
        <tr><td>Bohemian Archive in Japanese Red</td><td class='mavg'>81.91%</td></tr>
        <tr><td>Ghostly Field Club</td><td class='mavg'>81.90%</td></tr>
        <tr><td>Magical Astronomy</td><td class='mavg'>81.86%</td></tr>
        <tr><td>SA - Touhou 11</td><td class='mavg'>81.65%</td></tr>
        <tr><td>LoLK - Touhou 15</td><td class='mavg'>81.55%</td></tr>
        <tr><td>Forbidden Scrollery</td><td class='mavg'>81.48%</td></tr>
        <tr><td>Akyuu's Untouched Score</td><td class='mavg'>81.48%</td></tr>
        <tr><td>UFO - Touhou 12</td><td class='mavg'>81.08%</td></tr>
        <tr><td>DDC - Touhou 14</td><td class='favg'>80.75%</td></tr>
        <tr><td>Dr. Latency's Freak Report</td><td class='favg'>80.47%</td></tr>
        <tr><td>Perfect Memento in Strict Sense / Symposium of Post-mysticism</td><td class='favg'>80.00%</td></tr>
        <tr><td>EoSD - Touhou 6</td><td class='favg'>79.92%</td></tr>
        <tr><td>IN - Touhou 8</td><td class='favg'>79.78%</td></tr>
        <tr><td>Curiosities of Lotus Asia</td><td class='favg'>79.63%</td></tr>
        <tr><td>PoFV - Touhou 9</td><td class='favg'>79.24%</td></tr>
        <tr><td>Neo-traditionalism of Japan</td><td class='ftilt'>79.14%</td></tr>
        <tr><td>HSiFS - Touhou 16</td><td class='ftilt'>78.10%</td></tr>
        <tr><td>ULiL - Touhou 14.5</td><td class='ftilt'>77.86%</td></tr>
        <tr><td>Touhou Bougetsushou</td><td class='flean'>77.24%</td></tr>
        <tr><td>WBaWC - Touhou 17</td><td class='flean'>76.94%</td></tr>
        <tr><td>Unknown Flower, Mesmerizing Journey</td><td class='flean'>76.77%</td></tr>
        <tr><td>Dateless Bar "Old Adam"</td><td class='flean'>76.64%</td></tr>
        <tr><td>Who's Who of Humans & Youkai in Gensokyo</td><td class='flean'>76.34%</td></tr>
        <tr><td>VD - Touhou 16.5</td><td class='flean'>76.02%</td></tr>
        <tr><td>PoDD - Touhou 3</td><td class='flean'>74.91%</td></tr>
        <tr><td>LLS - Touhou 4</td><td class='flean'>74.41%</td></tr>
        <tr><td>Dolls in Pseudo Paradise</td><td class='fstrong'>73.74%</td></tr>
        <tr><td>Grimoire of Usami</td><td class='fstrong'>71.50%</td></tr>
        <tr><td>TD - Touhou 13</td><td class='fstrong'>71.46%</td></tr>
        <tr><td>HRtP - Touhou 1</td><td class='fstrong'>70.53%</td></tr>
        <tr><td>MS - Touhou 5</td><td class='fstrong'>70.51%</td></tr>
        <tr><td>Grimoire of Marisa</td><td class='fstrong'>66.93%</td></tr>
        <tr><td>SoEW - Touhou 2</td><td class='fextreme'>63.98%</td></tr>
    </tbody>
</table></div>
<p><strong><a href='#top'>Back to Top</a></strong></p>-->
