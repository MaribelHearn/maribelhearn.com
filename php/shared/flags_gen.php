<?php
$row_size = 16;
$offset = -16;
$flags = array('Afghanistan', 'Aland-Islands', 'Albania', 'Algeria', 'American-Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antigua-and-Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan',
'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia-and-Herzegovina', 'Botswana', 'Bouvet-Island', 'Brazil', 'British-Indian-Ocean-Territory',
'British-Virgin-Islands', 'Brunei', 'Bulgaria', 'Burkina-Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape-Verde', 'Cayman-Islands', 'Central-African-Republic', 'Chad', 'Chile', 'China', 'Christmas-Island',
'Cocos-Islands', 'Colombia', 'Comoros', 'Congo-Kinshasa', 'Republic-of-the-Congo', 'Cook-Islands', 'Costa-Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czechia', 'Denmark', 'Djibouti', 'Dominica', 'Dominican-Republic', 'East-Timor',
'Ecuador', 'Egypt', 'El-Salvador', 'Equatorial-Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Falkland-Islands', 'Faroe-Islands', 'Fiji', 'Finland', 'France', 'French-Polynesia', 'French-Southern-Territories',
'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea-Bissau', 'Guinea', 'Guyana', 'Haiti', 'Honduras', 'Hong-Kong',
'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Isle-of-Man', 'Israel', 'Italy', 'Ivory-Coast', 'Jamaica', 'Jan-Mayen', 'Japan', 'Jarvis-Island', 'Jersey', 'Jordan', 'Kazakhstan', 'Kenya',
'Kiribati', 'South-Korea', 'Kosovo', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macao', 'North-Macedonia', 'Madagascar', 'Malawi',
'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall-Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Montserrat', 'Morocco',
'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'The-Netherlands', 'New-Caledonia', 'New-Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk-Island', 'North-Korea', 'Northern-Mariana-Islands', 'Norway',
'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua-New-Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn', 'Poland', 'Portugal', 'Puerto-Rico', 'Qatar', 'Reunion', 'Romania', 'Russia',
'Rwanda', 'Saint-Barthelemy', 'Saint-Helena-Dependencies', 'Saint-Helena', 'Saint-Kitts-and-Nevis', 'Saint-Lucia', 'Saint-Martin', 'Saint-Pierre-and-Miquelon', 'Saint-Vincent-and-the-Grenadines', 'Samoa',
'San-Marino', 'Sao-Tome-and-Principe', 'Saudi-Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra-Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon-Islands', 'Somalia', 'South-Africa', 'South-Georgia', 'Spain',
'Sri-Lanka', 'Sudan', 'Suriname', 'Svalbard', 'Swaziland', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tokelau', 'Tonga', 'Trinidad-and-Tobago',
'Tunisia', 'Türkiye', 'Turkmenistan', 'Turks-and-Caicos-Islands', 'Tuvalu', 'Uganda', 'Ukraine', 'United-Arab-Emirates', 'United-Kingdom', 'United-States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican-City',
'Venezuela', 'Vietnam', 'Virgin-Islands', 'Wallis-and-Futuna', 'Western-Sahara', 'Yemen', 'Zambia', 'Zimbabwe');
for ($i = 0; $i < count($flags); $i++) {
    $x = ($i % $row_size) * $offset;
    $y = floor($i / $row_size) * $offset;
    echo '#' . $flags[$i] . '.flag{background-position:' . $x . 'px ' . $y . 'px}';
}
?>
