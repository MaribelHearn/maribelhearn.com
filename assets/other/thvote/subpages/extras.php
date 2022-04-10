<h2>Contents</h2>
<div id='contents_extra' class='border'>
    <p><a href='#jumps'>Biggest jumps</a></p>
    <p><a href='#mpg'>Music vote per maingame</a></p>
    <ul><li><a href='#mtotals'>Totals per maingame</a></li><?php
        foreach ($games as $key => $game) {
            if ($key < 5 || $game == 'GFW') {
                continue;
            }
            echo '<li><a href="#m' . strtolower($game) . '">' . full_name($game) . '</a></li>';
        }
    ?></ul>
    <p><a href='#fraud'>Fraud correction</a></p>
    <p><a href='#gender'>Gender vote</a></p>
    <ul>
        <li><a href='#charas'>Characters</a></li>
        <li><a href='#works'>Works</a></li>
    </ul>
</div>
<h2 id='jumps'>Biggest jumps</h2>
<p>This section lists the biggest jumps in ranking for characters (top 150 only). Click a column to sort the table by jumps, drops or whatever you like.</p>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>1</td><td>Youmu Konpaku</td><td class='stable'>0</td></tr>
        <tr><td>4</td><td>2</td><td>Marisa Kirisame</td><td class='jump'>+2</td></tr>
        <tr><td>2</td><td>3</td><td>Reimu Hakurei</td><td class='drop'>-1</td></tr>
        <tr><td>3</td><td>4</td><td>Koishi Komeiji</td><td class='drop'>-1</td></tr>
        <tr><td>5</td><td>5</td><td>Flandre Scarlet</td><td class='stable'>0</td></tr>
        <tr><td>7</td><td>6</td><td>Sakuya Izayoi</td><td class='jump'>+1</td></tr>
        <tr><td>6</td><td>7</td><td>Remilia Scarlet</td><td class='drop'>-1</td></tr>
        <tr><td>9</td><td>8</td><td>Fujiwara no Mokou</td><td class='jump'>+1</td></tr>
        <tr><td>8</td><td>9</td><td>Satori Komeiji</td><td class='drop'>-1</td></tr>
        <tr><td>13</td><td>10</td><td>Yuyuko Saigyouji</td><td class='jump'>+3</td></tr>
        <tr><td>10</td><td>11</td><td>Aya Shameimaru</td><td class='drop'>-1</td></tr>
        <tr><td>11</td><td>12</td><td>Alice Margatroid</td><td class='drop'>-1</td></tr>
        <tr><td>12</td><td>13</td><td>Sanae Kochiya</td><td class='drop'>-1</td></tr>
        <tr><td>14</td><td>14</td><td>Reisen Udongein Inaba</td><td class='stable'>0</td></tr>
        <tr><td>16</td><td>15</td><td>Tenshi Hinanawi</td><td class='jump'>+1</td></tr>
        <tr><td>15</td><td>16</td><td>Yukari Yakumo</td><td class='drop'>-1</td></tr>
        <tr><td>17</td><td>17</td><td>Hata no Kokoro</td><td class='stable'>0</td></tr>
        <tr><td>24</td><td>18</td><td>Cirno</td><td class='jump'>+6</td></tr>
        <tr><td>18</td><td>19</td><td>Patchouli Knowledge</td><td class='drop'>-1</td></tr>
        <tr><td>20</td><td>20</td><td>Kogasa Tatara</td><td class='stable'>0</td></tr>
        <tr><td>23</td><td>21</td><td>Rumia</td><td class='jump'>+2</td></tr>
        <tr><td>21</td><td>22</td><td>Suwako Moriya</td><td class='drop'>-1</td></tr>
        <tr><td>19</td><td>23</td><td>Eiki Shiki, Yamaxanadu</td><td class='drop'>-4</td></tr>
        <tr><td>28</td><td>24</td><td>Yuuka Kazami</td><td class='jump'>+4</td></tr>
        <tr><td>25</td><td>25</td><td>Hong Meiling</td><td class='stable'>0</td></tr>
        <tr><td>29</td><td>26</td><td>Toyosatomimi no Miko</td><td class='jump'>+3</td></tr>
        <tr><td>22</td><td>27</td><td>Momiji Inubashiri</td><td class='drop'>-5</td></tr>
        <tr><td>26</td><td>28</td><td>Junko</td><td class='drop'>-2</td></tr>
        <tr><td>32</td><td>29</td><td>Seija Kijin</td><td class='jump'>+3</td></tr>
        <tr><td>30</td><td>30</td><td>Shion Yorigami</td><td class='stable'>0</td></tr>
        <tr><td>31</td><td>31</td><td>Suika Ibuki</td><td class='stable'>0</td></tr>
        <tr><td>39</td><td>32</td><td>Mononobe no Futo</td><td class='jump'>+7</td></tr>
        <tr><td>40</td><td>33</td><td>Sagume Kishin</td><td class='jump'>+7</td></tr>
        <tr><td>42</td><td>34</td><td>Hecatia Lapislazuli</td><td class='jump'>+8</td></tr>
        <tr><td>41</td><td>35</td><td>Kaguya Houraisan</td><td class='jump'>+6</td></tr>
        <tr><td>33</td><td>36</td><td>Nitori Kawashiro</td><td class='drop'>-3</td></tr>
        <tr><td>37</td><td>37</td><td>Ran Yakumo</td><td class='stable'>0</td></tr>
        <tr><td>27</td><td>38</td><td>Renko Usami</td><td class='drop'>-11</td></tr>
        <tr><td>38</td><td>39</td><td>Utsuho Reiuji</td><td class='drop'>-1</td></tr>
        <tr><td>35</td><td>40</td><td>Kasen Ibaraki</td><td class='drop'>-5</td></tr>
        <tr><td>34</td><td>41</td><td>Parsee Mizuhashi</td><td class='drop'>-7</td></tr>
        <tr><td>43</td><td>42</td><td>Okina Matara</td><td class='jump'>+1</td></tr>
        <tr><td>45</td><td>43</td><td>Nue Houjuu</td><td class='jump'>+2</td></tr>
        <tr><td>-</td><td>44</td><td>Chimata Tenkyuu</td><td class='stable'>0</td></tr>
        <tr><td>50</td><td>45</td><td>Hina Kagiyama</td><td class='jump'>+5</td></tr>
        <tr><td>36</td><td>46</td><td>Keiki Haniyasushin</td><td class='drop'>-10</td></tr>
        <tr><td>44</td><td>47</td><td>Byakuren Hijiri</td><td class='drop'>-3</td></tr>
        <tr><td>58</td><td>48</td><td>Eirin Yagokoro</td><td class='jump'>+10</td></tr>
        <tr><td>47</td><td>49</td><td>Rin Kaenbyou</td><td class='drop'>-2</td></tr>
        <tr><td>51</td><td>50</td><td>Doremy Sweet</td><td class='jump'>+1</td></tr>
        <tr><td>70</td><td>51</td><td>Minamitsu Murasa</td><td class='jump'>+19</td></tr>
        <tr><td>48</td><td>52</td><td>Clownpiece</td><td class='drop'>-4</td></tr>
        <tr><td>57</td><td>53</td><td>Keine Kamishirasawa</td><td class='jump'>+4</td></tr>
        <tr><td>49</td><td>54</td><td>Maribel Hearn</td><td class='drop'>-5</td></tr>
        <tr><td>-</td><td>55</td><td>Tsukasa Kudamaki</td><td class='stable'>0</td></tr>
        <tr><td>62</td><td>56</td><td>Sumireko Usami</td><td class='jump'>+6</td></tr>
        <tr><td>-</td><td>57</td><td>Megumu Iizunamaru</td><td class='stable'>0</td></tr>
        <tr><td>46</td><td>58</td><td>Yachie Kicchou</td><td class='drop'>-12</td></tr>
        <tr><td>59</td><td>59</td><td>Seiga Kaku</td><td class='stable'>0</td></tr>
        <tr><td>54</td><td>60</td><td>Daiyousei</td><td class='drop'>-6</td></tr>
        <tr><td>61</td><td>61</td><td>Chen</td><td class='stable'>0</td></tr>
        <tr><td>-</td><td>62</td><td>Momoyo Himemushi</td><td class='stable'>0</td></tr>
        <tr><td>53</td><td>63</td><td>Nazrin</td><td class='drop'>-10</td></tr>
        <tr><td>74</td><td>64</td><td>Tewi Inaba</td><td class='jump'>+10</td></tr>
        <tr><td>69</td><td>64</td><td>Sekibanki</td><td class='jump'>+5</td></tr>
        <tr><td>52</td><td>66</td><td>Kagerou Imaizumi</td><td class='drop'>-14</td></tr>
        <tr><td>71</td><td>67</td><td>Koakuma</td><td class='jump'>+4</td></tr>
        <tr><td>56</td><td>68</td><td>Kutaka Niwatari</td><td class='drop'>-12</td></tr>
        <tr><td>77</td><td>69</td><td>Yuugi Hoshiguma</td><td class='jump'>+8</td></tr>
        <tr><td>60</td><td>69</td><td>Kosuzu Motoori</td><td class='drop'>-9</td></tr>
        <tr><td>64</td><td>71</td><td>Mystia Lorelei</td><td class='drop'>-7</td></tr>
        <tr><td>65</td><td>72</td><td>Komachi Onozuka</td><td class='drop'>-7</td></tr>
        <tr><td>67</td><td>73</td><td>Shinmyoumaru Sukuna</td><td class='drop'>-6</td></tr>
        <tr><td>73</td><td>74</td><td>Hatate Himekaidou</td><td class='drop'>-1</td></tr>
        <tr><td>66</td><td>74</td><td>Soga no Tojiko</td><td class='drop'>-8</td></tr>
        <tr><td>63</td><td>76</td><td>Iku Nagae</td><td class='drop'>-13</td></tr>
        <tr><td>68</td><td>77</td><td>Mayumi Joutouguu</td><td class='drop'>-9</td></tr>
        <tr><td>78</td><td>78</td><td>Kanako Yasaka</td><td class='stable'>0</td></tr>
        <tr><td>75</td><td>79</td><td>Rinnosuke Morichika</td><td class='drop'>-4</td></tr>
        <tr><td>55</td><td>80</td><td>Joon Yorigami</td><td class='drop'>-25</td></tr>
        <tr><td>79</td><td>81</td><td>Mamizou Futatsuiwa</td><td class='drop'>-2</td></tr>
        <tr><td>81</td><td>82</td><td>Mima</td><td class='drop'>-1</td></tr>
        <tr><td>72</td><td>83</td><td>Hieda no Akyuu</td><td class='drop'>-11</td></tr>
        <tr><td>84</td><td>84</td><td>Lunasa Prismriver</td><td class='stable'>0</td></tr>
        <tr><td>94</td><td>85</td><td>Wriggle Nightbug</td><td class='jump'>+9</td></tr>
        <tr><td>80</td><td>86</td><td>Raiko Horikawa</td><td class='drop'>-6</td></tr>
        <tr><td>89</td><td>87</td><td>Yoshika Miyako</td><td class='jump'>+2</td></tr>
        <tr><td>76</td><td>88</td><td>Saki Kurokoma</td><td class='drop'>-12</td></tr>
        <tr><td>-</td><td>89</td><td>Mike Goutokuji</td><td class='stable'>0</td></tr>
        <tr><td>98</td><td>90</td><td>Watatsuki no Yorihime</td><td class='jump'>+8</td></tr>
        <tr><td>82</td><td>91</td><td>Lily White</td><td class='drop'>-9</td></tr>
        <tr><td>93</td><td>92</td><td>Miyoi Okunoda</td><td class='jump'>+1</td></tr>
        <tr><td>96</td><td>93</td><td>Shizuha Aki</td><td class='jump'>+3</td></tr>
        <tr><td>97</td><td>94</td><td>Minoriko Aki</td><td class='jump'>+3</td></tr>
        <tr><td>86</td><td>95</td><td>Medicine Melancholy</td><td class='drop'>-9</td></tr>
        <tr><td>83</td><td>96</td><td>Aunn Komano</td><td class='drop'>-13</td></tr>
        <tr><td>89</td><td>97</td><td>Wakasagihime</td><td class='drop'>-8</td></tr>
        <tr><td>88</td><td>98</td><td>Shinki</td><td class='drop'>-10</td></tr>
        <tr><td>85</td><td>99</td><td>Shou Toramaru</td><td class='drop'>-14</td></tr>
        <tr><td>108</td><td>100</td><td>Mai Teireida</td><td class='jump'>+8</td></tr>
        <tr><td>91</td><td>101</td><td>Yumemi Okazaki</td><td class='drop'>-10</td></tr>
        <tr><td>87</td><td>102</td><td>Kyouko Kasodani</td><td class='drop'>-15</td></tr>
        <tr><td>100</td><td>103</td><td>Letty Whiterock</td><td class='drop'>-3</td></tr>
        <tr><td>102</td><td>104</td><td>Yamame Kurodani</td><td class='drop'>-2</td></tr>
        <tr><td>109</td><td>105</td><td>Satono Nishida</td><td class='jump'>+4</td></tr>
        <tr><td>-</td><td>106</td><td>Misumaru Tamatsukuri</td><td class='stable'>0</td></tr>
        <tr><td>114</td><td>107</td><td>Watatsuki no Toyohime</td><td class='jump'>+7</td></tr>
        <tr><td>95</td><td>108</td><td>Seiran</td><td class='drop'>-13</td></tr>
        <tr><td>92</td><td>109</td><td>Unnamed Jinyou (Fortune Teller)</td><td class='drop'>-17</td></tr>
        <tr><td>99</td><td>110</td><td>Luna Child</td><td class='drop'>-11</td></tr>
        <tr><td>111</td><td>111</td><td>Merlin Prismriver</td><td class='stable'>0</td></tr>
        <tr><td>105</td><td>112</td><td>Ichirin Kumoi</td><td class='drop'>-7</td></tr>
        <tr><td>104</td><td>113</td><td>Gengetsu</td><td class='drop'>-9</td></tr>
        <tr><td>101</td><td>114</td><td>Star Sapphire</td><td class='drop'>-13</td></tr>
        <tr><td>106</td><td>115</td><td>Benben Tsukumo</td><td class='drop'>-9</td></tr>
        <tr><td>117</td><td>116</td><td>Alice's Dolls (Shanghai, Hourai, Ooedo, etc.)</td><td class='jump'>+1</td></tr>
        <tr><td>112</td><td>117</td><td>Lyrica Prismriver</td><td class='drop'>-5</td></tr>
        <tr><td>115</td><td>118</td><td>Unnamed Book-Reading Youkai (Tokiko)</td><td class='drop'>-3</td></tr>
        <tr><td>-</td><td>119</td><td>Takane Yamashiro</td><td class='stable'>0</td></tr>
        <tr><td>103</td><td>120</td><td>Sunny Milk</td><td class='drop'>-17</td></tr>
        <tr><td>107</td><td>121</td><td>Eternity Larva</td><td class='drop'>-14</td></tr>
        <tr><td>112</td><td>122</td><td>Ringo</td><td class='drop'>-10</td></tr>
        <tr><td>121</td><td>123</td><td>Rei'sen</td><td class='drop'>-2</td></tr>
        <tr><td>123</td><td>124</td><td>Yatsuhashi Tsukumo</td><td class='drop'>-1</td></tr>
        <tr><td>110</td><td>125</td><td>Narumi Yatadera</td><td class='drop'>-15</td></tr>
        <tr><td>118</td><td>126</td><td>Kana Anaberal</td><td class='drop'>-8</td></tr>
        <tr><td>119</td><td>127</td><td>Mugetsu</td><td class='drop'>-8</td></tr>
        <tr><td>119</td><td>128</td><td>Dolls in Pseudo Paradise CD Jacket Girl</td><td class='drop'>-9</td></tr>
        <tr><td>128</td><td>129</td><td>Yumeko</td><td class='drop'>-1</td></tr>
        <tr><td>127</td><td>130</td><td>Anxious Moustached Villager</td><td class='drop'>-3</td></tr>
        <tr><td>130</td><td>131</td><td>Kurumi</td><td class='drop'>-1</td></tr>
        <tr><td>138</td><td>132</td><td>Youki Konpaku</td><td class='jump'>+6</td></tr>
        <tr><td>124</td><td>133</td><td>Sariel</td><td class='drop'>-9</td></tr>
        <tr><td>131</td><td>134</td><td>Nemuno Sakata</td><td class='drop'>-3</td></tr>
        <tr><td>129</td><td>135</td><td>Chiyuri Kitashirakawa</td><td class='drop'>-6</td></tr>
        <tr><td>121</td><td>136</td><td>Urumi Ushizaki</td><td class='drop'>-15</td></tr>
        <tr><td>126</td><td>137</td><td>Kisume</td><td class='drop'>-11</td></tr>
        <tr><td>-</td><td>138</td><td>Sannyo Komakusa</td><td class='stable'>0</td></tr>
        <tr><td>134</td><td>139</td><td>Unzan</td><td class='drop'>-5</td></tr>
        <tr><td>136</td><td>139</td><td>Kedama</td><td class='drop'>-3</td></tr>
        <tr><td>133</td><td>141</td><td>Ellen</td><td class='drop'>-8</td></tr>
        <tr><td>136</td><td>142</td><td>Konngara</td><td class='drop'>-6</td></tr>
        <tr><td>125</td><td>143</td><td>Eika Ebisu</td><td class='drop'>-18</td></tr>
        <tr><td>134</td><td>144</td><td>Elis</td><td class='drop'>-10</td></tr>
        <tr><td>132</td><td>145</td><td>Mai</td><td class='drop'>-13</td></tr>
        <tr><td>139</td><td>146</td><td>Elly</td><td class='drop'>-7</td></tr>
        <tr><td>141</td><td>146</td><td>Yuki</td><td class='drop'>-5</td></tr>
        <tr><td>116</td><td>148</td><td>Otter Spirit</td><td class='drop'>-32</td></tr>
        <tr><td>139</td><td>149</td><td>Shadow Kasen (Ibaraki-Douji's Arm)</td><td class='drop'>-10</td></tr>
        <tr><td>144</td><td>150</td><td>Giant Catfish</td><td class='drop'>-6</td></tr>
    </tbody>
</table></div>
<h2 id='mpg'>Music vote per maingame</h2>
<h3 id='mtotals'>Totals per maingame</h3>
<div>
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
            <tr><td>1</td><td>EoSD</td><td>49,317</td><td>7,997</td><td>4,490</td></tr>
            <tr><td>2</td><td>IN</td><td>31,581</td><td>3,121</td><td>3,066</td></tr></tr>
            <tr><td>3</td><td>PCB</td><td>30,028</td><td>3,192</td><td>2,778</td></tr>
            <tr><td>4</td><td>MoF</td><td>23,315</td><td>2,302</td><td>2,462</td></tr>
            <tr><td>5</td><td>SA</td><td>18,531</td><td>2,050</td><td>1,848</td></tr>
            <tr><td>6</td><td>LoLK</td><td>13,339</td><td>1,333</td><td>1,601</td></tr>
            <tr><td>7</td><td>WBaWC</td><td>10,867</td><td>1,487</td><td>1,333</td></tr>
            <tr><td>8</td><td>UFO</td><td>9,429</td><td>873</td><td>1,041</td></tr>
            <tr><td>9</td><td>DDC</td><td>8,595</td><td>811</td><td>933</td></tr>
            <tr><td>10</td><td>UM</td><td>8,428</td><td>611</td><td>1,280</td></tr>
            <tr><td>11</td><td>TD</td><td>8,125</td><td>783</td><td>900</td></tr>
            <tr><td>12</td><td>PoFV</td><td>7,562</td><td>679</td><td>735</td></tr>
            <tr><td>13</td><td>HSiFS</td><td>5,680</td><td>380</td><td>770</td></tr>
        </tbody>
    </table></div>
</div>
<h3 id='meosd'>Touhou 6 - The Embodiment of Scarlet Devil</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Extra Boss</td><td>U.N. Owen Was Her?</td><td>11,848</td><td>2,748</td><td>1,299</td></tr>
        <tr><td>2</td><td>Stage 6 Boss</td><td>Septette for a Dead Princess</td><td>9,498</td><td>1,846</td><td>790</td></tr>
        <tr><td>3</td><td>Stage 3</td><td>Shanghai Teahouse ~ Chinese Tea</td><td>5,431</td><td>834</td><td>458</td></tr>
        <tr><td>4</td><td>Stage 5 Boss</td><td>Lunar Clock ~ Luna Dial</td><td>3,757</td><td>472</td><td>305</td></tr>
        <tr><td>5</td><td>Stage 2 Boss</td><td>Tomboyish Girl in Love</td><td>3,485</td><td>421</td><td>360</td></tr>
        <tr><td>6</td><td>Stage 3 Boss</td><td>Shanghai Alice of Meiji 17</td><td>2,249</td><td>268</td><td>192</td></tr>
        <tr><td>7</td><td>Extra Stage</td><td>The Centennial Festival for Magical Girls</td><td>2,072</td><td>190</td><td>186</td></tr>
        <tr><td>8</td><td>Stage 1 Boss</td><td>Apparitions Stalk the Night</td><td>1,926</td><td>262</td><td>177</td></tr>
        <tr><td>9</td><td>Stage 5</td><td>The Maid and the Pocket Watch of Blood</td><td>1,709</td><td>176</td><td>124</td></tr>
        <tr><td>10</td><td>Stage 4 Boss</td><td>Locked Girl ~ The Girl's Secret Room</td><td>1,544</td><td>169</td><td>106</td></tr>
        <tr><td>11</td><td>Title</td><td>A Dream that Is More Scarlet than Red</td><td>1,168</td><td>162</td><td>91</td></tr>
        <tr><td>12</td><td>Staff Roll/Credits</td><td>Crimson Tower ~ Eastern Dream...</td><td>1,082</td><td>110</td><td>105</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>A Soul as Red as a Ground Cherry</td><td>1,071</td><td>121</td><td>94</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>Lunate Elf</td><td>833</td><td>91</td><td>71</td></tr>
        <tr><td>15</td><td>Stage 4</td><td>Voile, the Magic Library</td><td>761</td><td>68</td><td>64</td></tr>
        <tr><td>16</td><td>Stage 6</td><td>The Young Descendant of Tepes</td><td>615</td><td>40</td><td>49</td></tr>
        <tr><td>17</td><td>Ending</td><td>An Eternity that Is More Transient than Scarlet</td><td>268</td><td>19</td><td>19</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>49,317</td><td>7,997</td><td>4,490</td><td></td></tr>
    </tfoot>
</table></div>
<h3 id='mpcb'>Touhou 7 - Perfect Cherry Blossom</h3>
<div class='overflow'><table class='poll table sortable'>
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
            <th>Point Chart</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Stage 6 Boss</td><td>Bloom Nobly, Ink-Black Cherry Blossom ~ Border of Life</td><td>5,403</td><td>684</td><td>442</td></tr>
        <tr><td>2</td><td>Stage 4 Boss</td><td>Ghostly Band ~ Phantom Ensemble</td><td>5,082</td><td>548</td><td>501</td></tr>
        <tr><td>3</td><td>Phantasm Boss</td><td>Necrofantasia</td><td>4,580</td><td>464</td><td>412</td></tr>
        <tr><td>4</td><td>Stage 5 Boss</td><td>Hiroari Shoots a Strange Bird ~ Till When?</td><td>2,395</td><td>315</td><td>227</td></tr>
        <tr><td>5</td><td>Stage 3 Boss</td><td>Doll Judgment</td><td>2,007</td><td>181</td><td>148</td></tr>
        <tr><td>6</td><td>Stage 5</td><td>Eastern Mystical Dream ~ Ancient Temple</td><td>1,493</td><td>166</td><td>136</td></tr>
        <tr><td>7</td><td>Final Spell</td><td>Border of Life</td><td>1,282</td><td>101</td><td>151</td></tr>
        <tr><td>8</td><td>Stage 2</td><td>The Fantastic Tales from Tono</td><td>1,278</td><td>137</td><td>140</td></tr>
        <tr><td>9</td><td>Staff Roll/Credits</td><td>Sakura, Sakura ~ Japanize Dream...</td><td>958</td><td>60</td><td>97</td></tr>
        <tr><td>10</td><td>Extra Boss</td><td>A Maiden's Illusionary Funeral ~ Necro-Fantasy</td><td>882</td><td>89</td><td>77</td></tr>
        <tr><td>11</td><td>Stage 4</td><td>The Capital City of Flowers in the Sky</td><td>876</td><td>100</td><td>72</td></tr>
        <tr><td>12</td><td>Stage 3</td><td>The Doll Maker of Bucuresti</td><td>735</td><td>61</td><td>50</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>Paradise ~ Deep Mountain</td><td>663</td><td>53</td><td>76</td></tr>
        <tr><td>14</td><td>Stage 6</td><td>Ultimate Truth</td><td>535</td><td>49</td><td>60</td></tr>
        <tr><td>15</td><td>Title</td><td>Mystic Dream ~ Snow or Cherry Petal</td><td>533</td><td>65</td><td>41</td></tr>
        <tr><td>16</td><td>Stage 1 Boss</td><td>Crystallized Silver</td><td>394</td><td>32</td><td>46</td></tr>
        <tr><td>17</td><td>Phantasm Stage</td><td>Youkai Domination ~ Who done it?</td><td>348</td><td>23</td><td>45</td></tr>
        <tr><td>18</td><td>Stage 2 Boss</td><td>Diao ye zong (Withered Leaf)</td><td>327</td><td>42</td><td>34</td></tr>
        <tr><td>19</td><td>Extra Stage</td><td>Youkai Domination</td><td>226</td><td>21</td><td>21</td></tr>
        <tr><td>20</td><td>Ending</td><td>Dream of a Spring Breeze</td><td>31</td><td>1</td><td>2</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>30,028</td><td>3,192</td><td>2,778</td></tr>
    </tfoot>
</table></div>
<h3 id='min'>Touhou 8 - Imperishable Night</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Extra Boss</td><td>Reach for the Moon, Immortal Smoke</td><td>5,921</td><td>771</td><td>560</td></tr>
        <tr><td>2</td><td>Stage 4B Boss</td><td>Love-Coloured Master Spark（Love-coloured Magic）</td><td>5,861</td><td>623</td><td>548</td></tr>
        <tr><td>3</td><td>Stage 6B Boss</td><td>Flight in the Bamboo Cutter ~ Lunatic Princess</td><td>3,212</td><td>299</td><td>306</td></tr>
        <tr><td>4</td><td>Stage 4A Boss</td><td>Maiden's Capriccio / Dream Battle</td><td>3,138</td><td>283</td><td>266</td></tr>
        <tr><td>5</td><td>Stage 6A Boss</td><td>Gensokyo Millennium ~ History of the Moon</td><td>2,765</td><td>276</td><td>272</td></tr>
        <tr><td>6</td><td>Stage 5 Boss</td><td>Lunatic Eyes ~ Invisible Full Moon</td><td>2,385</td><td>223</td><td>236</td></tr>
        <tr><td>7</td><td>Stage 2 Boss</td><td>Deaf to All but the Song</td><td>1,037</td><td>73</td><td>98</td></tr>
        <tr><td>8</td><td>Stage 5</td><td>Cinderella Cage ~ Kagome-Kagome</td><td>948</td><td>72</td><td>103</td></tr>
        <tr><td>9</td><td>Stage 3 Boss</td><td>Plain Asia</td><td>913</td><td>88</td><td>100</td></tr>
        <tr><td>10</td><td>Stage 6</td><td>Voyage 1969</td><td>907</td><td>75</td><td>80</td></tr>
        <tr><td>11</td><td>Extra Stage</td><td>Extend Ash ~ Person of Hourai</td><td>772</td><td>63</td><td>66</td></tr>
        <tr><td>12</td><td>Stage 3</td><td>Nostalgic Blood of the East ~ Old World</td><td>743</td><td>60</td><td>72</td></tr>
        <tr><td>13</td><td>Last Word</td><td>Eastern Youkai Beauty</td><td>616</td><td>33</td><td>60</td></tr>
        <tr><td>14</td><td>Stage 4</td><td>Retribution for the Eternal Night ~ Imperishable Night</td><td>531</td><td>39</td><td>76</td></tr>
        <tr><td>15</td><td>Stage 6 Last Spell</td><td>Voyage 1970</td><td>471</td><td>23</td><td>70</td></tr>
        <tr><td>16</td><td>Stage 1 Boss</td><td>Stirring an Autumn Moon ~ Mooned Insect</td><td>376</td><td>41</td><td>53</td></tr>
        <tr><td>17</td><td>Stage 2</td><td>Song of the Night Sparrow ~ Night Bird</td><td>299</td><td>30</td><td>28</td></tr>
        <tr><td>18</td><td>Title</td><td>Eternal Night Vignette ~ Eastern Night.</td><td>234</td><td>19</td><td>29</td></tr>
        <tr><td>19</td><td>Stage 1</td><td>Illusionary Night ~ Ghostly Eyes</td><td>222</td><td>15</td><td>20</td></tr>
        <tr><td>20</td><td>Staff Roll/Credits</td><td>Mystical Maple ~ Eternal Dream</td><td>176</td><td>12</td><td>20</td></tr>
        <tr><td>21</td><td>Ending</td><td>Evening Primrose</td><td>54</td><td>3</td><td>3</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>31,581</td><td>3,121</td><td>3,066</td></tr>
    </tfoot>
</table></div>
<h3 id='mpofv'>Touhou 9 - Phantasmagoria of Flower View</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Sakuya</td><td>Flowering Night</td><td>2,712</td><td>225</td><td>261</td></tr>
        <tr><td>2</td><td>Eiki</td><td>Eastern Judgement in the Sixtieth Year ~ Fate of Sixty Years</td><td>2,016</td><td>210</td><td>172</td></tr>
        <tr><td>3</td><td>Yuuka</td><td>Gensokyo, Past and Present ~ Flower Land</td><td>612</td><td>63</td><td>51</td></tr>
        <tr><td>4</td><td>Komachi</td><td>Higan Retour ~ Riverside View</td><td>593</td><td>41</td><td>65</td></tr>
        <tr><td>5</td><td>Marisa</td><td>Oriental Dark Flight</td><td>461</td><td>44</td><td>64</td></tr>
        <tr><td>6</td><td>Reimu</td><td>Spring Lane ~ Colorful Path</td><td>325</td><td>26</td><td>29</td></tr>
        <tr><td>7</td><td>Ending</td><td>The Flowers Remain in Fantasy</td><td>231</td><td>22</td><td>27</td></tr>
        <tr><td>8</td><td>Medicine</td><td>Poison Body ~ Forsaken Doll</td><td>194</td><td>18</td><td>17</td></tr>
        <tr><td>9</td><td>Tewi</td><td>White Flag of Usa Shrine</td><td>181</td><td>10</td><td>21</td></tr>
        <tr><td>10</td><td>Title</td><td>Flower Viewing Mound ~ Higan Retour</td><td>127</td><td>10</td><td>15</td></tr>
        <tr><td>11</td><td>Pre-Battle 1</td><td>The Mound Where the Flowers Reflect</td><td>53</td><td>6</td><td>7</td></tr>
        <tr><td>12</td><td>Staff Roll/Credits</td><td>Flower of Soul ~ Another Dream...</td><td>41</td><td>4</td><td>5</td></tr>
        <tr><td>13</td><td>Pre-Battle 2</td><td>Mound of Life</td><td>16</td><td>0</td><td>1</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>7,562</td><td>679</td><td>735</td></tr>
    </tfoot>
</table></div>
<h3 id='mmof'>Touhou 10 - Mountain of Faith</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Stage 3</td><td>The Gensokyo The Gods Loved</td><td>5,425</td><td>561</td><td>587</td></tr>
        <tr><td>2</td><td>Extra Boss</td><td>Native Faith</td><td>3,353</td><td>431</td><td>349</td></tr>
        <tr><td>3</td><td>Stage 5 Boss</td><td>Faith Is for the Transient People</td><td>2,467</td><td>262</td><td>234</td></tr>
        <tr><td>4</td><td>Stage 4</td><td>Fall of Fall ~ Autumnal Waterfall</td><td>1,640</td><td>212</td><td>162</td></tr>
        <tr><td>5</td><td>Extra Stage</td><td>Tomorrow Will Be Special, Yesterday Was Not</td><td>1,436</td><td>121</td><td>181</td></tr>
        <tr><td>6</td><td>Stage 3 Boss</td><td>Akutagawa Ryuunosuke's "Kappa" ~ Candid Friend</td><td>1,404</td><td>127</td><td>139</td></tr>
        <tr><td>7</td><td>Stage 4 Boss</td><td>The Youkai Mountain ~ Mysterious Mountain</td><td>1,394</td><td>129</td><td>138</td></tr>
        <tr><td>8</td><td>Stage 6 Boss</td><td>The Venerable Ancient Battlefield ~ Suwa Foughten Field</td><td>1,120</td><td>102</td><td>121</td></tr>
        <tr><td>9</td><td>Stage 2 Boss</td><td>Dark Side of Fate</td><td>1,114</td><td>86</td><td>96</td></tr>
        <tr><td>10</td><td>Stage 5</td><td>The Primal Scene of Japan the Girl Saw</td><td>1,104</td><td>80</td><td>120</td></tr>
        <tr><td>11</td><td>Stage 1 Boss</td><td>Because Princess Inada Is Scolding Me</td><td>1,074</td><td>78</td><td>122</td></tr>
        <tr><td>12</td><td>Stage 2</td><td>The Road of the Misfortune God ~ Dark Road</td><td>1,007</td><td>75</td><td>96</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>A God That Misses People ~ Romantic Fall</td><td>249</td><td>12</td><td>25</td></tr>
        <tr><td>14</td><td>Stage 6</td><td>Cemetery of Onbashira ~ Grave of Being</td><td>229</td><td>15</td><td>44</td></tr>
        <tr><td>15</td><td>Title</td><td>Sealed Gods</td><td>144</td><td>7</td><td>25</td></tr>
        <tr><td>16</td><td>Game Over</td><td>Player’s Score</td><td>67</td><td>1</td><td>13</td></tr>
        <tr><td>17</td><td>Staff Roll/Credits</td><td>The Gods Give Us Blessed Rain ~ Sylphid Dream</td><td>52</td><td>1</td><td>5</td></tr>
        <tr><td>18</td><td>Ending</td><td>Shrine at the Foot of the Mountain</td><td>36</td><td>2</td><td>5</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>23,315</td><td>2,302</td><td>2,462</td></tr>
    </tfoot>
</table></div>
<h3 id='msa'>Touhou 11 - Subterranean Animism</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Extra Boss</td><td>Hartmann's Youkai Girl</td><td>6,211</td><td>854</td><td>616</td></tr>
        <tr><td>2</td><td>Stage 4 Boss</td><td>Satori Maiden ~ 3rd eye</td><td>2,774</td><td>342</td><td>263</td></tr>
        <tr><td>3</td><td>Extra Stage</td><td>Last Remote</td><td>2,693</td><td>251</td><td>243</td></tr>
        <tr><td>4</td><td>Stage 6 Boss</td><td>Solar Sect of Mystic Wisdom ~ Nuclear Fusion</td><td>1,724</td><td>158</td><td>156</td></tr>
        <tr><td>5</td><td>Stage 5</td><td>Lullaby of Deserted Hell</td><td>1,287</td><td>108</td><td>128</td></tr>
        <tr><td>6</td><td>Stage 2 Boss</td><td>Green-Eyed Jealousy</td><td>920</td><td>126</td><td>90</td></tr>
        <tr><td>7</td><td>Stage 3</td><td>Walking the Streets of a Former Hell</td><td>660</td><td>36</td><td>72</td></tr>
        <tr><td>8</td><td>Stage 5 Boss</td><td>Corpse Voyage ~ Be of good cheer!</td><td>501</td><td>38</td><td>70</td></tr>
        <tr><td>9</td><td>Stage 3 Boss</td><td>A Flower-Studded Sake Dish on Mt. Ooe</td><td>423</td><td>40</td><td>55</td></tr>
        <tr><td>10</td><td>Stage 4</td><td>Heartfelt Fancy</td><td>396</td><td>34</td><td>36</td></tr>
        <tr><td>11</td><td>Stage 2</td><td>The Bridge People No Longer Cross</td><td>263</td><td>21</td><td>26</td></tr>
        <tr><td>12</td><td>Stage 1</td><td>The Dark Blowhole</td><td>189</td><td>14</td><td>32</td></tr>
        <tr><td>13</td><td>Stage 6</td><td>Hellfire Mantle</td><td>186</td><td>10</td><td>25</td></tr>
        <tr><td>14</td><td>Stage 1 Boss</td><td>The Sealed-Away Youkai ~ Lost Place</td><td>166</td><td>11</td><td>17</td></tr>
        <tr><td>15</td><td>Title</td><td>Awakening of the Earth Spirits</td><td>64</td><td>2</td><td>8</td></tr>
        <tr><td>16</td><td>Ending</td><td>The Earth Spirits' Homecoming</td><td>38</td><td>2</td><td>6</td></tr>
        <tr><td>17</td><td>Staff Roll/Credits</td><td>Energy Daybreak ~ Future Dream...</td><td>36</td><td>3</td><td>5</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>18,531</td><td>2,050</td><td>1,848</td></tr>
    </tfoot>
</table></div>
<h3 id='mufo'>Touhou 12 - Undefined Fantastic Object</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Stage 6 Boss</td><td>Emotional Skyscraper ~ Cosmic Mind</td><td>2,756</td><td>294</td><td>272</td></tr>
        <tr><td>2</td><td>Extra Boss</td><td>Heian Alien</td><td>1,460</td><td>134</td><td>180</td></tr>
        <tr><td>3</td><td>Stage 1</td><td>At the End of Spring</td><td>1,130</td><td>107</td><td>114</td></tr>
        <tr><td>4</td><td>Stage 2 Boss</td><td>Beware the Umbrella Left There Forever</td><td>796</td><td>77</td><td>84</td></tr>
        <tr><td>5</td><td>Stage 4</td><td>Interdimensional Voyage of a Ghostly Passenger Ship</td><td>756</td><td>70</td><td>82</td></tr>
        <tr><td>6</td><td>Extra Stage</td><td>UFO Romance in the Night Sky</td><td>470</td><td>41</td><td>70</td></tr>
        <tr><td>7</td><td>Stage 4 Boss</td><td>Captain Murasa</td><td>428</td><td>34</td><td>57</td></tr>
        <tr><td>8</td><td>Stage 5 Boss</td><td>The Tiger-Patterned Vaisravana</td><td>336</td><td>25</td><td>31</td></tr>
        <tr><td>9</td><td>Stage 6</td><td>Fires of Hokkai</td><td>336</td><td>18</td><td>32</td></tr>
        <tr><td>10</td><td>Stage 5</td><td>Rural Makai City Esoteria</td><td>302</td><td>18</td><td>35</td></tr>
        <tr><td>11</td><td>Stage 1 Boss</td><td>A Tiny, Tiny, Clever Commander</td><td>276</td><td>32</td><td>27</td></tr>
        <tr><td>12</td><td>Stage 3 Boss</td><td>The Traditional Old Man and the Stylish Girl</td><td>141</td><td>11</td><td>14</td></tr>
        <tr><td>13</td><td>Stage 3</td><td>Sky Ruin</td><td>66</td><td>5</td><td>10</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>The Sealed Cloud Route</td><td>66</td><td>4</td><td>6</td></tr>
        <tr><td>15</td><td>Staff Roll/Credits</td><td>Returning Home From the Sky ~ Sky Dream</td><td>65</td><td>1</td><td>17</td></tr>
        <tr><td>16</td><td>Title</td><td>A Shadow in the Blue Sky</td><td>39</td><td>2</td><td>10</td></tr>
        <tr><td>17</td><td>Ending</td><td>Youkai Temple</td><td>6</td><td>0</td><td>0</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>9,429</td><td>873</td><td>1,041</td></tr>
    </tfoot>
</table></div>
<h3 id='mtd'>Touhou 13 - Ten Desires</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Stage 4</td><td>Desire Drive</td><td>2,375</td><td>262</td><td>238</td></tr>
        <tr><td>2</td><td>Stage 6 Boss</td><td>Shoutoku Legend ~ True Administrator</td><td>1,524</td><td>196</td><td>162</td></tr>
        <tr><td>3</td><td>Stage 4 Boss</td><td>Old Yuanxian</td><td>982</td><td>73</td><td>104</td></tr>
        <tr><td>4</td><td>Stage 1</td><td>Night Sakura of Dead Spirits</td><td>666</td><td>54</td><td>72</td></tr>
        <tr><td>5</td><td>Stage 5 Boss</td><td>Omiwa Legend</td><td>619</td><td>73</td><td>79</td></tr>
        <tr><td>6</td><td>Extra Boss</td><td>Futatsuiwa from Sado</td><td>444</td><td>21</td><td>42</td></tr>
        <tr><td>7</td><td>Stage 5</td><td>Dream Palace of the Great Mausoleum</td><td>353</td><td>32</td><td>47</td></tr>
        <tr><td>8</td><td>Stage 3</td><td>Let's Live in a Lovely Cemetery</td><td>274</td><td>24</td><td>41</td></tr>
        <tr><td>9</td><td>Stage 3 Boss</td><td>Rigid Paradise</td><td>248</td><td>19</td><td>33</td></tr>
        <tr><td>10</td><td>Extra Stage</td><td>Youkai Back Shrine Road</td><td>157</td><td>9</td><td>20</td></tr>
        <tr><td>11</td><td>Stage 6</td><td>Starry Sky of Small Desires</td><td>118</td><td>2</td><td>11</td></tr>
        <tr><td>12</td><td>Staff Roll/Credits</td><td>Desire Dream</td><td>114</td><td>6</td><td>12</td></tr>
        <tr><td>13</td><td>Stage 1 Boss</td><td>Ghost Lead</td><td>74</td><td>0</td><td>7</td></tr>
        <tr><td>14</td><td>Stage 2 Boss</td><td>Youkai Girl at the Gate</td><td>67</td><td>5</td><td>7</td></tr>
        <tr><td>15</td><td>Stage 2</td><td>Welcome to Youkai Temple</td><td>58</td><td>2</td><td>10</td></tr>
        <tr><td>16</td><td>Title</td><td>Spirit of Avarice</td><td>46</td><td>5</td><td>14</td></tr>
        <tr><td>17</td><td>Ending</td><td>A New Wind at the Shrine</td><td>6</td><td>0</td><td>1</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>8,125</td><td>783</td><td>900</td></tr>
    </tfoot>
</table></div>
<h3 id='mddc'>Touhou 14 - Double Dealing Character</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Stage 6 Boss</td><td>Inchlings of the Shining Needle ~ Little Princess</td><td>2,988</td><td>339</td><td>275</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>Reverse Ideology</td><td>1,230</td><td>128</td><td>135</td></tr>
        <tr><td>3</td><td>Extra Boss</td><td>Primordial Beat ~ Pristine Beat</td><td>1,147</td><td>100</td><td>123</td></tr>
        <tr><td>4</td><td>Stage 4 Boss</td><td>Illusionary Joururi</td><td>760</td><td>68</td><td>78</td></tr>
        <tr><td>5</td><td>Title</td><td>Mysterious Purification Rod</td><td>693</td><td>62</td><td>92</td></tr>
        <tr><td>6</td><td>Stage 3</td><td>Bamboo Forest of the Full Moon</td><td>352</td><td>25</td><td>54</td></tr>
        <tr><td>7</td><td>Stage 2 Boss</td><td>Dullahan Under the Willows</td><td>343</td><td>27</td><td>38</td></tr>
        <tr><td>8</td><td>Stage 5</td><td>The Shining Needle Castle Sinking in the Air</td><td>246</td><td>20</td><td>29</td></tr>
        <tr><td>9</td><td>Stage 1 Boss</td><td>Mermaid from the Uncharted Land</td><td>207</td><td>13</td><td>17</td></tr>
        <tr><td>10</td><td>Stage 1</td><td>Mist Lake</td><td>164</td><td>9</td><td>25</td></tr>
        <tr><td>11</td><td>Stage 3 Boss</td><td>Lonesome Werewolf</td><td>158</td><td>10</td><td>14</td></tr>
        <tr><td>12</td><td>Extra Stage</td><td>Thunderclouds of Magical Power</td><td>75</td><td>2</td><td>16</td></tr>
        <tr><td>13</td><td>Staff Roll/Credits</td><td>Strange, Strange Instruments</td><td>66</td><td>3</td><td>12</td></tr>
        <tr><td>14</td><td>Stage 4</td><td>Magical Storm</td><td>56</td><td>1</td><td>14</td></tr>
        <tr><td>15</td><td>Stage 2</td><td>Humans and Youkai Traversing the Canal</td><td>50</td><td>3</td><td>4</td></tr>
        <tr><td>16</td><td>Stage 6</td><td>The Exaggerated Castle Keep</td><td>44</td><td>1</td><td>5</td></tr>
        <tr><td>17</td><td>Ending</td><td>Magical Power of the Mallet</td><td>16</td><td>0</td><td>2</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>8,595</td><td>811</td><td>933</td></tr>
    </tfoot>
</table></div>
<h3 id='mlolk'>Touhou 15 - Legacy of Lunatic Kingdom</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Stage 6 Boss</td><td>Pure Furies ~ Whereabouts of the Heart</td><td>5,098</td><td>775</td><td>547</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>The Pierrot of the Star-Spangled Banner</td><td>1,457</td><td>81</td><td>168</td></tr>
        <tr><td>3</td><td>Extra Boss</td><td>Pandemonic Planet</td><td>1,365</td><td>128</td><td>177</td></tr>
        <tr><td>4</td><td>Stage 6</td><td>The Sea Where the Home Planet is Reflected</td><td>1,140</td><td>63</td><td>143</td></tr>
        <tr><td>5</td><td>Stage 3 Boss</td><td>Eternal Spring Dream</td><td>934</td><td>65</td><td>117</td></tr>
        <tr><td>6</td><td>Stage 5</td><td>Faraway 380,000-Kilometer Voyage</td><td>707</td><td>38</td><td>87</td></tr>
        <tr><td>7</td><td>Stage 4 Boss</td><td>The Reversed Wheel of Fortune</td><td>516</td><td>44</td><td>71</td></tr>
        <tr><td>8</td><td>Stage 1 Boss</td><td>The Rabbit Has Landed</td><td>471</td><td>27</td><td>63</td></tr>
        <tr><td>9</td><td>Stage 4</td><td>The Frozen Eternal Capital</td><td>441</td><td>33</td><td>60</td></tr>
        <tr><td>10</td><td>Stage 2 Boss</td><td>September Pumpkin</td><td>342</td><td>21</td><td>38</td></tr>
        <tr><td>11</td><td>Extra Stage</td><td>A Never-Before-Seen World of Nightmares</td><td>316</td><td>21</td><td>51</td></tr>
        <tr><td>12</td><td>Stage 3</td><td>The Mysterious Shrine Maiden Flying Through Space</td><td>203</td><td>22</td><td>27</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>Unforgettable, the Nostalgic Greenery</td><td>123</td><td>8</td><td>16</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>The Lake Reflects the Cleansed Moonlight</td><td>86</td><td>4</td><td>17</td></tr>
        <tr><td>15</td><td>Title</td><td>The Space Shrine Maiden Appears</td><td>85</td><td>2</td><td>14</td></tr>
        <tr><td>16</td><td>Staff Roll/Credits</td><td>The Space Shrine Maiden Returns Home</td><td>28</td><td>0</td><td>3</td></tr>
        <tr><td>17</td><td>Ending</td><td>The Moon as Seen from the Shrine</td><td>27</td><td>1</td><td>2</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>13,339</td><td>1,333</td><td>1,601</td></tr>
    </tfoot>
</table></div>
<h3 id='mhsifs'>Touhou 16 - Hidden Star in Four Seasons</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Extra Boss</td><td>Secret God Matara ~ Hidden Star in All Seasons.</td><td>1,544</td><td>129</td><td>206</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>Crazy Backup Dancers</td><td>1,260</td><td>76</td><td>160</td></tr>
        <tr><td>3</td><td>Stage 6 Boss</td><td>The Concealed Four Seasons</td><td>1,034</td><td>77</td><td>138</td></tr>
        <tr><td>4</td><td>Stage 4</td><td>Illusionary White Traveler</td><td>524</td><td>29</td><td>70</td></tr>
        <tr><td>5</td><td>Stage 1</td><td>A Star of Hope Rises in the Blue Sky</td><td>353</td><td>27</td><td>64</td></tr>
        <tr><td>6</td><td>Stage 5</td><td>Does the Forbidden Door Lead to This World, or the World Beyond?</td><td>163</td><td>7</td><td>29</td></tr>
        <tr><td>7</td><td>Stage 1 Boss</td><td>A Midsummer Fairy's Dream</td><td>134</td><td>8</td><td>18</td></tr>
        <tr><td>8</td><td>Stage 3 Boss</td><td>A Pair of Divine Beasts</td><td>134</td><td>7</td><td>15</td></tr>
        <tr><td>9</td><td>Stage 3</td><td>Swim in a Cherry Blossom-Colored Sea</td><td>128</td><td>4</td><td>11</td></tr>
        <tr><td>10</td><td>Extra Stage</td><td>No More Going Through Doors</td><td>114</td><td>6</td><td>18</td></tr>
        <tr><td>11</td><td>Stage 4 Boss</td><td>The Magic Straw-Hat Ksitigarbha</td><td>78</td><td>2</td><td>9</td></tr>
        <tr><td>12</td><td>Stage 6</td><td>Into Backdoor</td><td>54</td><td>3</td><td>10</td></tr>
        <tr><td>13</td><td>Staff Roll/Credits</td><td>White Traveler</td><td>50</td><td>1</td><td>4</td></tr>
        <tr><td>14</td><td>Title</td><td>The Sky Where Cherry Blossoms Flutter Down</td><td>36</td><td>1</td><td>5</td></tr>
        <tr><td>15</td><td>Stage 2 Boss</td><td>Deep-Mountain Encounter</td><td>34</td><td>2</td><td>4</td></tr>
        <tr><td>16</td><td>Stage 2</td><td>The Colorless Wind on Youkai Mountain</td><td>32</td><td>0</td><td>7</td></tr>
        <tr><td>17</td><td>Ending</td><td>Unnatural Nature</td><td>8</td><td>1</td><td>2</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>5,680</td><td>380</td><td>770</td></tr>
    </tfoot>
</table></div>
<h3 id='mwbawc'>Touhou 17 - Wily Beast and Weakest Creature</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Stage 6 Boss</td><td>Entrust this World to Idols ~ Idolatrize World</td><td>7,107</td><td>1,271</td><td>826</td></tr>
        <tr><td>2</td><td>Stage 5 Boss</td><td>Joutoujin of Ceramics</td><td>817</td><td>57</td><td>122</td></tr>
        <tr><td>3</td><td>Stage 4</td><td>Unlocated Hell</td><td>790</td><td>55</td><td>110</td></tr>
        <tr><td>4</td><td>Extra Boss</td><td>Prince Shoutoku's Pegasus ~ Dark Pegasus</td><td>480</td><td>33</td><td>62</td></tr>
        <tr><td>5</td><td>Stage 5</td><td>Beast Metropolis</td><td>397</td><td>24</td><td>52</td></tr>
        <tr><td>6</td><td>Stage 6</td><td>Electric Heritage</td><td>332</td><td>7</td><td>48</td></tr>
        <tr><td>7</td><td>Stage 3 Boss</td><td>Seraphic Chicken</td><td>194</td><td>11</td><td>20</td></tr>
        <tr><td>8</td><td>Stage 4 Boss</td><td>Tortoise Dragon ~ Fortune and Misfortune</td><td>183</td><td>7</td><td>23</td></tr>
        <tr><td>9</td><td>Stage 1 Boss</td><td>Jelly Stone</td><td>164</td><td>7</td><td>29</td></tr>
        <tr><td>10</td><td>Stage 1</td><td>The Lamentations Known Only by Jizo</td><td>104</td><td>2</td><td>10</td></tr>
        <tr><td>11</td><td>Extra Stage</td><td>The Shining Law of the Strong Eating the Weak</td><td>93</td><td>7</td><td>11</td></tr>
        <tr><td>12</td><td>Title</td><td>Silent Beast Spirits</td><td>87</td><td>3</td><td>8</td></tr>
        <tr><td>13</td><td>Stage 2 Boss</td><td>The Stone Baby and the Submerged Bovine</td><td>48</td><td>1</td><td>5</td></tr>
        <tr><td>14</td><td>Stage 2</td><td>Lost River</td><td>29</td><td>0</td><td>5</td></tr>
        <tr><td>15</td><td>Stage 3</td><td>Everlasting Red Spider Lily</td><td>25</td><td>1</td><td>2</td></tr>
        <tr><td>16</td><td>Staff Roll/Credits</td><td>Returning Home from the Underground</td><td>10</td><td>1</td><td>0</td></tr>
        <tr><td>17</td><td>Ending</td><td>The Animals' Rest</td><td>7</td><td>0</td><td>0</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>10,867</td><td>1,487</td><td>1,333</td></tr>
    </tfoot>
</table></div>
<h3 id='mum'>Touhou 18 - Unconnected Marketeers</h3>
<div class='overflow'><table class='poll table sortable'>
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
        <tr><td>1</td><td>Stage 6 Boss</td><td>Where Is That Bustling Marketplace Now ~ Immemorial Marketeers</td><td>2,195</td><td>250</td><td>307</td></tr>
        <tr><td>2</td><td>Extra Boss</td><td>The Princess Who Slays Dragon Kings</td><td>1,434</td><td>79</td><td>209</td></tr>
        <tr><td>3</td><td>Stage 5 Boss</td><td>Starry Mountain of Tenma</td><td>877</td><td>62</td><td>136</td></tr>
        <tr><td>4</td><td>Stage 5</td><td>The Long-Awaited Oumagatoki</td><td>697</td><td>50</td><td>123</td></tr>
        <tr><td>5</td><td>Stage 1 Boss</td><td>Kitten of Great Fortune</td><td>618</td><td>32</td><td>75</td></tr>
        <tr><td>6</td><td>Extra Stage</td><td>The Great Fantastic Underground Railway Network</td><td>572</td><td>46</td><td>96</td></tr>
        <tr><td>7</td><td>Stage 3</td><td>The Perpetual Snow of Komakusa Blossoms</td><td>379</td><td>22</td><td>48</td></tr>
        <tr><td>8</td><td>Stage 4 Boss</td><td>Ore from the Age of the Gods</td><td>347</td><td>17</td><td>59</td></tr>
        <tr><td>9</td><td>Stage 4</td><td>The Obsolescent Industrial Remains</td><td>312</td><td>12</td><td>70</td></tr>
        <tr><td>10</td><td>Stage 3 Boss</td><td>Smoking Dragon</td><td>231</td><td>13</td><td>26</td></tr>
        <tr><td>11</td><td>Stage 2 Boss</td><td>Banditry Technology</td><td>229</td><td>12</td><td>29</td></tr>
        <tr><td>12</td><td>Stage 6</td><td>Lunar Rainbow</td><td>224</td><td>5</td><td>47</td></tr>
        <tr><td>13</td><td>Stage 1</td><td>A Shower of Strange Occurrences</td><td>117</td><td>6</td><td>23</td></tr>
        <tr><td>14</td><td>Title</td><td>A Rainbow Spanning Gensokyo</td><td>95</td><td>4</td><td>14</td></tr>
        <tr><td>15</td><td>Stage 2</td><td>The Cliff Hidden in Deep Green</td><td>52</td><td>0</td><td>13</td></tr>
        <tr><td>16</td><td>Staff Roll/Credits</td><td>A Rainbow-Colored World</td><td>46</td><td>1</td><td>5</td></tr>
        <tr><td>17</td><td>Ending</td><td>The Sunday After the Storm</td><td>3</td><td>0</td><td>0</td></tr>
    </tbody>
    <tfoot>
        <tr><th colspan='3'>Total</th><td>8,428</td><td>611</td><td>1,280</td></tr>
    </tfoot>
</table></div>
<p><strong><a href='#top'>Back to Top</a></strong></p>
<h2 id='fraud'>Fraud correction</h2>
<div class='overflow'><table id='fraud_table' class='poll table sortable'>
    <colgroup>
        <col class='col2'>
        <col class='col3game'>
        <col class='col4game'>
        <col class='col5per'>
        <col class='col2game'>
        <col class='col3game'>
        <col class='col4game'>
        <col class='col5per neg'>
        <col class='col2game neg'>
        <col class='col3game neg'>
    </colgroup>
    <thead>
        <tr>
            <th>Name</th>
            <th>Old points</th>
            <th>Old no. 1s</th>
            <th>Old comments</th>
            <th>New points</th>
            <th>New no. 1s</th>
            <th>New comments</th>
            <th>Point difference</th>
            <th>No. 1 difference</th>
            <th>Comment difference</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>Youmu Konpaku</td><td>13,009</td><td>3,263</td><td>2,288</td><td>12,951</td><td>3,253</td><td>2,288</td><td>-58</td><td>-10</td><td class='zero'>0</td></tr>
        <tr><td>Marisa Kirisame</td><td>11,874</td><td>2,228</td><td>2,131</td><td>11,816</td><td>2,216</td><td>2,131</td><td>-58</td><td>-12</td><td class='zero'>0</td></tr>
        <tr><td>Reimu Hakurei</td><td>11,471</td><td>2,155</td><td>1,933</td><td>11,404</td><td>2,124</td><td>1,933</td><td>-67</td><td>-31</td><td class='zero'>0</td></tr>
        <tr><td>Koishi Komeiji</td><td>11,184</td><td>2,207</td><td>1828</td><td>10,683</td><td>1,970</td><td>1,828</td><td class='huge'>-501</td><td class='huge'>-237</td><td class='zero'>0</td></tr>
        <tr><td>Flandre Scarlet</td><td>10,415</td><td>2,086</td><td>1,,975</td><td>10,335</td><td>2,049</td><td>1,975</td><td>-80</td><td>-37</td><td class='zero'>0</td></tr>
        <tr><td>Sakuya Izayoi</td><td>10,059</td><td>1,796</td><td>1,710</td><td>10,015</td><td>1,786</td><td>1,710</td><td>-44</td><td>-10</td><td class='zero'>0</td></tr>
        <tr><td>Remilia Scarlet</td><td>9,498</td><td>1,713</td><td>1,635</td><td>9,482</td><td>1,713</td><td>1,635</td><td>-16</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Fujiwara no Mokou</td><td>6,660</td><td>1,150</td><td>1,109</td><td>6,589</td><td>1,150</td><td>1,075</td><td>-71</td><td class='zero'>0</td><td>-34</td></tr>
        <tr><td>Satori Komeiji</td><td>6,318</td><td>837</td><td>1,001</td><td>6,305</td><td>837</td><td>1,001</td><td>-13</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Yuyuko Saigyouji</td><td>5,974</td><td>872</td><td>933</td><td>5,955</td><td>871</td><td>933</td><td>-19</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Aya Shameimaru</td><td>5,820</td><td>863</td><td>876</td><td>5,799</td><td>861</td><td>876</td><td>-21</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Alice Margatroid</td><td>5,635</td><td>914</td><td>853</td><td>5,608</td><td>904</td><td>853</td><td>-27</td><td>-10</td><td class='zero'>0</td></tr>
        <tr><td>Sanae Kochiya</td><td>5,286</td><td>801</td><td>778</td><td>5,261</td><td>801</td><td>778</td><td>-25</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Reisen Udongein Inaba</td><td>5,276</td><td>668</td><td>804</td><td>5,249</td><td>667</td><td>804</td><td>-27</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Tenshi Hinanawi</td><td>4,694</td><td>639</td><td>675</td><td>4,679</td><td>638</td><td>675</td><td>-15</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Yukari Yakumo</td><td>4,639</td><td>574</td><td>731</td><td>4,571</td><td>574</td><td>731</td><td>-68</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Hata no Kokoro</td><td>4,385</td><td>566</td><td>737</td><td>4,363</td><td>566</td><td>737</td><td>-22</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Cirno</td><td>4,272</td><td>662</td><td>886</td><td>4,226</td><td>661</td><td>852</td><td>-46</td><td>-1</td><td>-34</td></tr>
        <tr><td>Patchouli Knowledge</td><td>4,152</td><td>563</td><td>593</td><td>4,128</td><td>560</td><td>593</td><td>-24</td><td>-3</td><td class='zero'>0</td></tr>
        <tr><td>Kogasa Tatara</td><td>3,903</td><td>555</td><td>694</td><td>3,818</td><td>544</td><td>694</td><td>-85</td><td>-11</td><td class='zero'>0</td></tr>
        <tr><td>Rumia</td><td>3,741</td><td>531</td><td>798</td><td>3,726</td><td>530</td><td>798</td><td>-15</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Suwako Moriya</td><td>3,642</td><td>561</td><td>602</td><td>3,609</td><td>561</td><td>602</td><td>-33</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Eiki Shiki, Yamaxanadu</td><td>3,636</td><td>507</td><td>599</td><td>3,535</td><td>472</td><td>565</td><td class='huge'>-101</td><td>-35</td><td>-34</td></tr>
        <tr><td>Toyosatomimi no Miko</td><td>3,418</td><td>560</td><td>547</td><td>3,181</td><td>524</td><td>547</td><td class='huge'>-237</td><td>-36</td><td class='zero'>0</td></tr>
        <tr><td>Yuuka Kazami</td><td>3,348</td><td>457</td><td>480</td><td>3,339</td><td>457</td><td>480</td><td>-9</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Junko</td><td>3,273</td><td>465</td><td>511</td><td>3,048</td><td>394</td><td>511</td><td class='huge'>-225</td><td>-71</td><td class='zero'>0</td></tr>
        <tr><td>Hong Meiling</td><td>3,264</td><td>451</td><td>570</td><td>3,242</td><td>449</td><td>570</td><td>-22</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Momiji Inubashiri</td><td>3,196</td><td>471</td><td>613</td><td>3,149</td><td>471</td><td>579</td><td>-47</td><td class='zero'>0</td><td>-34</td></tr>
        <tr><td>Seija Kijin</td><td>2,957</td><td>492</td><td>546</td><td>2,928</td><td>485</td><td>546</td><td>-29</td><td>-7</td><td class='zero'>0</td></tr>
        <tr><td>Shion Yorigami</td><td>2,861</td><td>278</td><td>461</td><td>2,791</td><td>278</td><td>461</td><td>-70</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Suika Ibuki</td><td>2,693</td><td>287</td><td>410</td><td>2,684</td><td>285</td><td>410</td><td>-9</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Sagume Kishin</td><td>2,623</td><td>305</td><td>432</td><td>2,543</td><td>298</td><td>432</td><td>-80</td><td>-7</td><td class='zero'>0</td></tr>
        <tr><td>Mononobe no Futo</td><td>2,591</td><td>364</td><td>470</td><td>2,583</td><td>364</td><td>470</td><td>-8</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Hecatia Lapislazuli</td><td>2,589</td><td>272</td><td>478</td><td>2,467</td><td>250</td><td>478</td><td class='huge'>-122</td><td>-22</td><td class='zero'>0</td></tr>
        <tr><td>Kaguya Houraisan</td><td>2,432</td><td>265</td><td>381</td><td>2,421</td><td>264</td><td>381</td><td>-11</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Nitori Kawashiro</td><td>2,392</td><td>332</td><td>387</td><td>2,371</td><td>331</td><td>387</td><td>-21</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Ran Yakumo</td><td>2,321</td><td>285</td><td>356</td><td>2,314</td><td>284</td><td>356</td><td>-7</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Renko Usami</td><td>2,321</td><td>257</td><td>348</td><td>2,290</td><td>257</td><td>348</td><td>-31</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Utsuho Reiuji</td><td>2,279</td><td>353</td><td>372</td><td>2,276</td><td>352</td><td>372</td><td>-3</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Parsee Mizuhashi</td><td>2,237</td><td>340</td><td>403</td><td>2,184</td><td>339</td><td>403</td><td>-53</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Kasen Ibaraki</td><td>2,200</td><td>229</td><td>348</td><td>2,190</td><td>228</td><td>348</td><td>-10</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Okina Matara</td><td>2,192</td><td>280</td><td>356</td><td>1,968</td><td>227</td><td>356</td><td class='huge'>-224</td><td>-53</td><td class='zero'>0</td></tr>
        <tr><td>Nue Houjuu</td><td>2,001</td><td>197</td><td>330</td><td>1,967</td><td>196</td><td>330</td><td>-34</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Chimata Tenkyuu</td><td>1,944</td><td>139</td><td>389</td><td>1,834</td><td>129</td><td>389</td><td class='huge'>-110</td><td>-10</td><td class='zero'>0</td></tr>
        <tr><td>Keiki Haniyasushin</td><td>1,855</td><td>204</td><td>330</td><td>1,809</td><td>193</td><td>330</td><td>-46</td><td>-11</td><td class='zero'>0</td></tr>
        <tr><td>Hina Kagiyama</td><td>1,839</td><td>259</td><td>310</td><td>1,825</td><td>256</td><td>310</td><td>-14</td><td>-3</td><td class='zero'>0</td></tr>
        <tr><td>Byakuren Hijiri</td><td>1,815</td><td>168</td><td>282</td><td>1,805</td><td>167</td><td>282</td><td>-10</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Eirin Yagokoro</td><td>1,791</td><td>147</td><td>314</td><td>1,724</td><td>147</td><td>314</td><td>-67</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Minamitsu Murasa</td><td>1,787</td><td>207</td><td>290</td><td>1,613</td><td>201</td><td>290</td><td class='huge'>-174</td><td>-6</td><td class='zero'>0</td></tr>
        <tr><td>Rin Kaenbyou</td><td>1,705</td><td>186</td><td>295</td><td>1,700</td><td>186</td><td>295</td><td>-5</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Doremy Sweet</td><td>1,654</td><td>176</td><td>279</td><td>1,649</td><td>176</td><td>279</td><td>-5</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Clownpiece</td><td>1,635</td><td>120</td><td>265</td><td>1,609</td><td>119</td><td>265</td><td>-26</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Keine Kamishirasawa</td><td>1,559</td><td>140</td><td>247</td><td>1,555</td><td>140</td><td>247</td><td>-4</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Tsukasa Kudamaki</td><td>1,433</td><td>59</td><td>294</td><td>1,409</td><td>58</td><td>294</td><td>-24</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Maribel Hearn</td><td>1,423</td><td>103</td><td>233</td><td>1,423</td><td>103</td><td>233</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Megumu Iizunamaru</td><td>1,398</td><td>60</td><td>288</td><td>1,370</td><td>60</td><td>288</td><td>-28</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Yachie Kicchou</td><td>1,393</td><td>112</td><td>241</td><td>1,364</td><td>112</td><td>241</td><td>-29</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Sumireko Usami</td><td>1,389</td><td>127</td><td>218</td><td>1,385</td><td>127</td><td>218</td><td>-4</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Seiga Kaku</td><td>1,341</td><td>130</td><td>232</td><td>1,326</td><td>129</td><td>232</td><td>-15</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Momoyo Himemushi</td><td>1,304</td><td>81</td><td>272</td><td>1,246</td><td>79</td><td>272</td><td>-58</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Daiyousei</td><td>1,282</td><td>115</td><td>220</td><td>1,273</td><td>115</td><td>220</td><td>-9</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Chen</td><td>1,266</td><td>142</td><td>234</td><td>1,264</td><td>142</td><td>234</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Sekibanki</td><td>1,231</td><td>125</td><td>207</td><td>1,176</td><td>122</td><td>207</td><td>-55</td><td>-3</td><td class='zero'>0</td></tr>
        <tr><td>Nazrin</td><td>1,217</td><td>165</td><td>187</td><td>1,207</td><td>165</td><td>187</td><td>-10</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Tewi Inaba</td><td>1,186</td><td>104</td><td>196</td><td>1,176</td><td>103</td><td>196</td><td>-10</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Kagerou Imaizumi</td><td>1,177</td><td>114</td><td>204</td><td>1,175</td><td>114</td><td>204</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Koakuma</td><td>1,162</td><td>82</td><td>164</td><td>1,141</td><td>82</td><td>164</td><td>-21</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kutaka Niwatari</td><td>1,140</td><td>90</td><td>215</td><td>1,131</td><td>90</td><td>215</td><td>-9</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kosuzu Motoori</td><td>1,129</td><td>98</td><td>181</td><td>1,125</td><td>98</td><td>181</td><td>-4</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Yuugi Hoshiguma</td><td>1,128</td><td>101</td><td>215</td><td>1,125</td><td>101</td><td>215</td><td>-3</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Mystia Lorelei</td><td>1,116</td><td>171</td><td>181</td><td>1,109</td><td>169</td><td>181</td><td>-7</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Komachi Onozuka</td><td>1,114</td><td>102</td><td>170</td><td>1,090</td><td>101</td><td>170</td><td>-24</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Shinmyoumaru Sukuna</td><td>1,096</td><td>112</td><td>181</td><td>1,089</td><td>112</td><td>181</td><td>-7</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Iku Nagae</td><td>1,095</td><td>94</td><td>191</td><td>1,070</td><td>94</td><td>191</td><td>-25</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Soga no Tojiko</td><td>1,087</td><td>113</td><td>187</td><td>1,072</td><td>112</td><td>187</td><td>-15</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Kanako Yasaka</td><td>1,082</td><td>97</td><td>161</td><td>1,015</td><td>97</td><td>161</td><td>-67</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Shizuha Aki</td><td>1,080</td><td>202</td><td>127</td><td>722</td><td>67</td><td>127</td><td class='huge'>-358</td><td class='huge'>-135</td><td class='zero'>0</td></tr>
        <tr><td>Hatate Himekaidou</td><td>1,079</td><td>84</td><td>186</td><td>1,072</td><td>84</td><td>186</td><td>-7</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Mayumi Joutouguu</td><td>1,077</td><td>80</td><td>225</td><td>1,030</td><td>78</td><td>191</td><td>-47</td><td>-2</td><td>-34</td></tr>
        <tr><td>Rinnosuke Morichika</td><td>1,011</td><td>99</td><td>223</td><td>1,003</td><td>97</td><td>223</td><td>-8</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Joon Yorigami</td><td>986</td><td>81</td><td>154</td><td>972</td><td>80</td><td>154</td><td>-14</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Mamizou Futatsuiwa</td><td>978</td><td>83</td><td>187</td><td>964</td><td>82</td><td>187</td><td>-14</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Lunasa Prismriver</td><td>963</td><td>90</td><td>170</td><td>903</td><td>90</td><td>170</td><td>-60</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Wriggle Nightbug</td><td>960</td><td>200</td><td>182</td><td>897</td><td>172</td><td>182</td><td>-63</td><td>-28</td><td class='zero'>0</td></tr>
        <tr><td>Mima</td><td>960</td><td>84</td><td>205</td><td>958</td><td>84</td><td>205</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Hieda no Akyuu</td><td>922</td><td>87</td><td>142</td><td>917</td><td>87</td><td>142</td><td>-5</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Raiko Horikawa</td><td>853</td><td>82</td><td>142</td><td>830</td><td>80</td><td>142</td><td>-23</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Minoriko Aki</td><td>811</td><td>62</td><td>135</td><td>708</td><td>61</td><td>135</td><td class='huge'>-103</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Mike Goutokuji</td><td>803</td><td>30</td><td>142</td><td>764</td><td>30</td><td>142</td><td>-39</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Saki Kurokuma</td><td>794</td><td>41</td><td>143</td><td>770</td><td>41</td><td>143</td><td>-24</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Watatsuki no Yorihime</td><td>793</td><td>58</td><td>184</td><td>755</td><td>58</td><td>150</td><td>-38</td><td class='zero'>0</td><td>-34</td></tr>
        <tr><td>Yoshika Miyako</td><td>779</td><td>87</td><td>146</td><td>773</td><td>87</td><td>146</td><td>-6</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Lily White</td><td>757</td><td>92</td><td>159</td><td>750</td><td>92</td><td>159</td><td>-7</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Miyoi Okunoda</td><td>730</td><td>41</td><td>137</td><td>726</td><td>41</td><td>137</td><td>-4</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Medicine Melancholy</td><td>702</td><td>75</td><td>145</td><td>696</td><td>75</td><td>145</td><td>-6</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Yamame Kurodani</td><td>692</td><td>72</td><td>134</td><td>581</td><td>63</td><td>134</td><td class='huge'>-111</td><td>-9</td><td class='zero'>0</td></tr>
        <tr><td>Mai Teireida</td><td>678</td><td>47</td><td>132</td><td>646</td><td>47</td><td>132</td><td>-32</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Shinki</td><td>675</td><td>42</td><td>113</td><td>661</td><td>42</td><td>113</td><td>-14</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Shou Toramaru</td><td>671</td><td>72</td><td>122</td><td>651</td><td>72</td><td>122</td><td>-20</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Aunn Komano</td><td>670</td><td>38</td><td>133</td><td>667</td><td>38</td><td>133</td><td>-3</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Wakasagihime</td><td>667</td><td>57</td><td>139</td><td>662</td><td>56</td><td>139</td><td>-5</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Yumemi Okazaki</td><td>624</td><td>65</td><td>116</td><td>621</td><td>65</td><td>116</td><td>-3</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kyouko Kasodani</td><td>620</td><td>59</td><td>114</td><td>617</td><td>59</td><td>114</td><td>-3</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Letty Whiterock</td><td>610</td><td>95</td><td>136</td><td>604</td><td>94</td><td>136</td><td>-6</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Misumaru Tamatsukuri</td><td>607</td><td>33</td><td>144</td><td>556</td><td>28</td><td>144</td><td>-51</td><td>-5</td><td class='zero'>0</td></tr>
        <tr><td>Satono Nishida</td><td>598</td><td>25</td><td>84</td><td>576</td><td>25</td><td>84</td><td>-22</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Benben Tsukumo</td><td>586</td><td>47</td><td>99</td><td>457</td><td>44</td><td>99</td><td class='huge'>-129</td><td>-3</td><td class='zero'>0</td></tr>
        <tr><td>Watatsuki no Toyohime</td><td>586</td><td>35</td><td>137</td><td>546</td><td>35</td><td>103</td><td>-40</td><td class='zero'>0</td><td>-34</td></tr>
        <tr><td>Seiran</td><td>530</td><td>43</td><td>116</td><td>521</td><td>43</td><td>116</td><td>-9</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Unnamed Jinyou (Fortune Teller)</td><td>518</td><td>28</td><td>126</td><td>518</td><td>28</td><td>126</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Ichirin Kumoi</td><td>514</td><td>58</td><td>85</td><td>479</td><td>57</td><td>85</td><td>-35</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Star Sapphire</td><td>510</td><td>61</td><td>92</td><td>473</td><td>45</td><td>92</td><td>-37</td><td>-16</td><td class='zero'>0</td></tr>
        <tr><td>Luna Child</td><td>492</td><td>32</td><td>87</td><td>490</td><td>32</td><td>87</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Merlin Prismriver</td><td>486</td><td>47</td><td>99</td><td>481</td><td>46</td><td>99</td><td>-5</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Gengetsu</td><td>478</td><td>43</td><td>95</td><td>478</td><td>43</td><td>95</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Yatsuhashi Tsukumo</td><td>422</td><td>44</td><td>70</td><td>310</td><td>24</td><td>70</td><td class='huge'>-112</td><td>-20</td><td class='zero'>0</td></tr>
        <tr><td>Alice's Dolls (Shanghai, Hourai, Ooedo, etc.)</td><td>403</td><td>14</td><td>80</td><td>401</td><td>14</td><td>80</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Lyrica Prismriver</td><td>402</td><td>27</td><td>77</td><td>397</td><td>27</td><td>77</td><td>-5</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Takane Yamashiro</td><td>375</td><td>15</td><td>66</td><td>356</td><td>15</td><td>66</td><td>-19</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Unnamed Book-Reading Youkai (Tokiko)</td><td>361</td><td>38</td><td>75</td><td>360</td><td>38</td><td>75</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Ringo</td><td>354</td><td>26</td><td>73</td><td>339</td><td>23</td><td>73</td><td>-15</td><td>-3</td><td class='zero'>0</td></tr>
        <tr><td>Eternity Larva</td><td>349</td><td>16</td><td>85</td><td>340</td><td>16</td><td>85</td><td>-9</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Sunny Milk</td><td>347</td><td>26</td><td>72</td><td>345</td><td>26</td><td>72</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Rei'sen</td><td>318</td><td>31</td><td>49</td><td>317</td><td>31</td><td>49</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Narumi Yatadera</td><td>304</td><td>12</td><td>65</td><td>297</td><td>12</td><td>65</td><td>-7</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kana Anaberal</td><td>290</td><td>23</td><td>56</td><td>290</td><td>23</td><td>56</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Nemuno Sakata</td><td>265</td><td>16</td><td>40</td><td>192</td><td>16</td><td>40</td><td>-73</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Mugetsu</td><td>251</td><td>8</td><td>51</td><td>251</td><td>8</td><td>51</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Dolls in Pseudo Paradise CD Jacket Girl</td><td>243</td><td>26</td><td>54</td><td>243</td><td>26</td><td>54</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Yumeko</td><td>227</td><td>15</td><td>26</td><td>221</td><td>14</td><td>26</td><td>-6</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Anxious Moustached Villager</td><td>217</td><td>9</td><td>53</td><td>216</td><td>9</td><td>53</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Urumi Ushizaki</td><td>214</td><td>11</td><td>33</td><td>179</td><td>11</td><td>33</td><td>-35</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kurumi</td><td>206</td><td>9</td><td>39</td><td>205</td><td>9</td><td>39</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Youki Konpaku</td><td>201</td><td>6</td><td>51</td><td>201</td><td>6</td><td>51</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Sariel</td><td>199</td><td>15</td><td>44</td><td>199</td><td>15</td><td>44</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Chiyuri Kitashirakawa</td><td>185</td><td>10</td><td>36</td><td>180</td><td>10</td><td>36</td><td>-5</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Sannyo Komakusa</td><td>183</td><td>10</td><td>34</td><td>171</td><td>10</td><td>34</td><td>-12</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kisume</td><td>179</td><td>18</td><td>44</td><td>178</td><td>18</td><td>44</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kedama</td><td>164</td><td>12</td><td>33</td><td>163</td><td>12</td><td>33</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Unzan</td><td>164</td><td>11</td><td>39</td><td>163</td><td>11</td><td>39</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Eika Ebisu</td><td>160</td><td>18</td><td>30</td><td>149</td><td>16</td><td>30</td><td>-11</td><td>-2</td><td class='zero'>0</td></tr>
        <tr><td>Ellen</td><td>159</td><td>12</td><td>39</td><td>157</td><td>12</td><td>39</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Konngara</td><td>156</td><td>13</td><td>34</td><td>156</td><td>13</td><td>34</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Elis</td><td>141</td><td>10</td><td>24</td><td>141</td><td>10</td><td>24</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Mai</td><td>140</td><td>9</td><td>37</td><td>139</td><td>9</td><td>37</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Yuki</td><td>134</td><td>18</td><td>33</td><td>132</td><td>18</td><td>33</td><td>-2</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Elly</td><td>133</td><td>11</td><td>28</td><td>132</td><td>11</td><td>28</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Otter Spirit</td><td>130</td><td>6</td><td>47</td><td>130</td><td>6</td><td>47</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Shadow Kasen (Ibaraki-Douji's Arm)</td><td>125</td><td>1</td><td>26</td><td>125</td><td>1</td><td>26</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Giant Catfish</td><td>123</td><td>10</td><td>38</td><td>123</td><td>10</td><td>38</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Ruukoto</td><td>117</td><td>7</td><td>36</td><td>117</td><td>7</td><td>36</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>UFO tokens</td><td>105</td><td>2</td><td>43</td><td>104</td><td>2</td><td>43</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kotohime</td><td>100</td><td>13</td><td>21</td><td>100</td><td>13</td><td>21</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Dolls in Pseudo Paradise CD Label Girl</td><td>91</td><td>4</td><td>24</td><td>91</td><td>4</td><td>24</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Rika</td><td>87</td><td>12</td><td>20</td><td>87</td><td>12</td><td>20</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>PC-98 unnamed midbosses</td><td>83</td><td>9</td><td>18</td><td>82</td><td>9</td><td>18</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Meira</td><td>80</td><td>7</td><td>22</td><td>80</td><td>7</td><td>22</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Layla Prismriver</td><td>80</td><td>3</td><td>14</td><td>79</td><td>3</td><td>14</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Orange</td><td>78</td><td>9</td><td>13</td><td>59</td><td>8</td><td>13</td><td>-19</td><td>-1</td><td class='zero'>0</td></tr>
        <tr><td>Fairy (Maid, Sunflower, etc.)</td><td>73</td><td>3</td><td>22</td><td>73</td><td>3</td><td>22</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Rikako Asakura</td><td>66</td><td>8</td><td>12</td><td>65</td><td>8</td><td>12</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Genjii</td><td>66</td><td>4</td><td>16</td><td>66</td><td>4</td><td>16</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Thermonuclear Deity Hisou Tensoku</td><td>65</td><td>0</td><td>14</td><td>64</td><td>0</td><td>14</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>YuugenMagan</td><td>64</td><td>6</td><td>14</td><td>64</td><td>6</td><td>14</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Chang'e</td><td>63</td><td>1</td><td>21</td><td>62</td><td>1</td><td>21</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Louise</td><td>62</td><td>4</td><td>11</td><td>61</td><td>4</td><td>11</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>SinGyoku</td><td>59</td><td>6</td><td>21</td><td>59</td><td>6</td><td>21</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Tsuchinoko</td><td>58</td><td>0</td><td>14</td><td>58</td><td>0</td><td>14</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Mimi-chan</td><td>53</td><td>1</td><td>11</td><td>53</td><td>1</td><td>11</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Nameemon (Kosuzu's stuffed slug)</td><td>52</td><td>4</td><td>15</td><td>52</td><td>4</td><td>15</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Tupai</td><td>49</td><td>4</td><td>9</td><td>49</td><td>4</td><td>9</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Eagle Spirit</td><td>47</td><td>5</td><td>22</td><td>47</td><td>5</td><td>22</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Crows (Hell ravens, Yukari and Aya's familiars, etc.)</td><td>46</td><td>6</td><td>9</td><td>46</td><td>6</td><td>9</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Sara</td><td>44</td><td>2</td><td>9</td><td>44</td><td>2</td><td>9</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kikuri</td><td>43</td><td>8</td><td>14</td><td>43</td><td>8</td><td>14</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Wolf Spirit</td><td>39</td><td>2</td><td>12</td><td>39</td><td>2</td><td>12</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kasen's animals (Kume, Kanda, Raijuu, Houso, Jinkenmen, etc.)</td><td>39</td><td>0</td><td>11</td><td>39</td><td>0</td><td>11</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Misc. Human Villagers (BAiJR, PMiSS, SoPM, FS, etc.)</td><td>34</td><td>2</td><td>15</td><td>33</td><td>2</td><td>15</td><td>-1</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Dragons (Dragon child, Unnamed evil dragon, etc.)</td><td>34</td><td>1</td><td>11</td><td>33</td><td>1</td><td>9</td><td>-1</td><td class='zero'>0</td><td>-2</td></tr>
        <tr><td>Kappa (including yamawaro)</td><td>33</td><td>2</td><td>4</td><td>33</td><td>2</td><td>4</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Rabbits (Moon rabbits, Eientei youkai rabbits, etc.)</td><td>33</td><td>1</td><td>9</td><td>34</td><td>1</td><td>11</td><td class='one'>+1</td><td class='zero'>0</td><td class='one'>+2</td></tr>
        <tr><td>Sake Bug</td><td>28</td><td>0</td><td>10</td><td>28</td><td>0</td><td>10</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kitsune (Youkai kitsune, Unnamed fox student, etc.)</td><td>28</td><td>0</td><td>8</td><td>28</td><td>0</td><td>8</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Urban Legends (Okiku-san, Hasshaku-sama)</td><td>27</td><td>1</td><td>12</td><td>27</td><td>1</td><td>12</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Hobgoblin</td><td>24</td><td>2</td><td>6</td><td>24</td><td>2</td><td>6</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Keseran-pasaran</td><td>23</td><td>1</td><td>7</td><td>23</td><td>1</td><td>7</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Unshou</td><td>21</td><td>2</td><td>7</td><td>21</td><td>2</td><td>7</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Tengu (Kourindou Tengu, Great Tengu, etc.)</td><td>18</td><td>0</td><td>0</td><td>18</td><td>0</td><td>0</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Myouren</td><td>16</td><td>1</td><td>3</td><td>16</td><td>1</td><td>3</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Manzairaku</td><td>16</td><td>0</td><td>3</td><td>16</td><td>0</td><td>3</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Konohana-Sakuyahime</td><td>15</td><td>0</td><td>4</td><td>15</td><td>0</td><td>4</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Summoned Gods (Amaterasu, Izunome, etc.)</td><td>14</td><td>0</td><td>2</td><td>14</td><td>0</td><td>2</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Ghosts (including vengeful spirits, divine spirits, bakebake)</td><td>13</td><td>0</td><td>4</td><td>13</td><td>0</td><td>4</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Salt Merchant</td><td>12</td><td>2</td><td>5</td><td>12</td><td>2</td><td>5</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Iwakasa</td><td>12</td><td>0</td><td>7</td><td>12</td><td>0</td><td>7</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Moon Capital Gate Guards</td><td>12</td><td>0</td><td>4</td><td>12</td><td>0</td><td>4</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Unnamed Snake Youkai</td><td>11</td><td>0</td><td>0</td><td>11</td><td>0</td><td>0</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Bishamonten</td><td>9</td><td>1</td><td>0</td><td>9</td><td>1</td><td>0</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Shirou Sendai</td><td>9</td><td>0</td><td>4</td><td>9</td><td>0</td><td>4</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Unnamed Dormouse (Yamane)</td><td>9</td><td>0</td><td>2</td><td>9</td><td>0</td><td>2</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kosuzu Motoori's parents</td><td>9</td><td>0</td><td>2</td><td>9</td><td>0</td><td>2</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Tanuki (Bake-danuki, Noteppou, etc.)</td><td>8</td><td>0</td><td>0</td><td>8</td><td>0</td><td>0</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Kutsutsura</td><td>7</td><td>0</td><td>2</td><td>7</td><td>0</td><td>2</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Mizue no Uranoshimako</td><td>6</td><td>0</td><td>0</td><td>6</td><td>0</td><td>0</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Enenra</td><td>4</td><td>0</td><td>2</td><td>4</td><td>0</td><td>2</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
        <tr><td>Zashiki-warashi</td><td>2</td><td>0</td><td>0</td><td>2</td><td>0</td><td>0</td><td class='zero'>0</td><td class='zero'>0</td><td class='zero'>0</td></tr>
    </tbody>
</table></div>
<p><strong><a href='#top'>Back to Top</a></strong></p>
<h2 id='gender'>Gender vote</h2>
<h3 id='charas'>Characters</h3>
<div class='overflow'><table class='poll table sortable'>
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
<div class='overflow'><table class='poll table sortable'>
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
<p><strong><a href='#top'>Back to Top</a></strong></p>
