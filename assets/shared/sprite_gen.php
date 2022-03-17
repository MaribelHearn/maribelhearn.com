<?php
$row_size = 9;
$works_row_size = 8;
$offset = -120;
$picker_offset = -80;
$mobile_offset = -60;
$chars = array('MarisaKirisame', 'ReimuHakurei', 'Elis', 'Kikuri', 'Konngara', 'Mima', 'ReimuPC-98', 'Sariel', 'SinGyokuF', 'SinGyokuM', 'YuugenMagan', 'EvilEyeSigma', 'Genjii', 'MarisaPC-98', 'Meira', 'Rika',
'ChiyuriKitashirakawa', 'Ellen', 'KanaAnaberal', 'Kotohime', 'Mimi-chan', 'RikakoAsakura', 'Ruukoto', 'YumemiOkazaki', 'Elly', 'Gengetsu', 'Kurumi', 'Mugetsu', 'Orange', 'YuukaPC-98', 'AlicePC-98',
'Luize', 'MaiPC-98', 'Sara', 'Shinki', 'Yuki', 'Yumeko', 'Cirno', 'Daiyousei', 'FlandreScarlet', 'HongMeiling', 'Koakuma', 'PatchouliKnowledge', 'RemiliaScarlet', 'Rumia', 'SakuyaIzayoi',
'AliceMargatroid', 'Chen', 'LettyWhiterock', 'LilyWhite', 'LunasaPrismriver', 'LyricaPrismriver', 'MerlinPrismriver', 'RanYakumo', 'YoumuKonpaku', 'YukariYakumo', 'YuyukoSaigyouji', 'SuikaIbuki',
'EirinYagokoro', 'FujiwaranoMokou', 'KaguyaHouraisan', 'KeineKamishirasawa', 'MystiaLorelei', 'ReisenUdongeinInaba', 'TewiInaba', 'WriggleNightbug', 'AyaShameimaru', 'EikiShikiYamaxanadu', 'KomachiOnozuka',
'MedicineMelancholy', 'YuukaKazami', 'HinaKagiyama', 'KanakoYasaka', 'MinorikoAki', 'MomijiInubashiri', 'NitoriKawashiro', 'SanaeKochiya', 'ShizuhaAki', 'SuwakoMoriya', 'IkuNagae',
'TenshiHinanawi', 'Kisume', 'KoishiKomeiji', 'ParseeMizuhashi', 'RinKaenbyou', 'SatoriKomeiji', 'UtsuhoReiuji', 'YamameKurodani', 'YuugiHoshiguma', 'ByakurenHijiri', 'IchirinKumoi', 'KogasaTatara',
'MinamitsuMurasa', 'Nazrin', 'NueHoujuu', 'ShouToramaru', 'Unzan', 'Hisoutensoku', 'HatateHimekaidou', 'LunaChild', 'StarSapphire', 'SunnyMilk', 'KyoukoKasodani', 'MamizouFutatsuiwa',
'MononobenoFuto', 'SeigaKaku', 'SoganoTojiko', 'ToyosatomiminoMiko', 'YoshikaMiyako', 'HatanoKokoro', 'Clownpiece', 'DoremySweet', 'HecatiaLapislazuli', 'Junko', 'Ringo', 'SagumeKishin', 'Seiran',
'BenbenTsukumo', 'KagerouImaizumi', 'RaikoHorikawa', 'SeijaKijin', 'Sekibanki', 'ShinmyoumaruSukuna', 'Wakasagihime', 'YatsuhashiTsukumo', 'SumirekoUsami', 'JoonYorigami', 'ShionYorigami',
'AunnKomano', 'EternityLarva', 'MaiTeireida', 'NarumiYatadera', 'NemunoSakata', 'OkinaMatara', 'SatonoNishida', 'EikaEbisu', 'KeikiHaniyasushin', 'KutakaNiwatari', 'MayumiJoutouguu',
'SakiKurokoma', 'UrumiUshizaki', 'YachieKicchou', 'YuumaToutetsu', 'ChimataTenkyuu', 'MegumuIizunamaru', 'MikeGoutokuji', 'MisumaruTamatsukuri', 'MomoyoHimemushi', 'SannyoKomakusa',
'TakaneYamashiro', 'TsukasaKudamaki', 'FortuneTeller', 'HiedanoAkyuu', 'KasenIbaraki', 'KosuzuMotoori', 'MiyoiOkunoda', 'ReisenII', 'RinnosukeMorichika', 'Tokiko', 'WatatsukinoToyohime',
'WatatsukinoYorihime', 'MaribelHearn', 'RenkoUsami', 'AlicePC-98Extra', 'FiveMagicStones', 'KaguyaHouraisanLastSpells', 'MarisaKirisameGFW', 'MarisaPC-98LLS', 'OkinaMataraExtra', 'YukiandMai',
'YuukaPC-98Stage5', 'YuyukoSaigyoujiResurrectionButterfly', 'YuyukoSaigyoujiTD');
$works = array('HighlyResponsivetoPrayers', 'StoryofEasternWonderland', 'PhantasmagoriaofDimDream', 'LotusLandStory', 'MysticSquare', 'EmbodimentofScarletDevil', 'PerfectCherryBlossom', 'ImmaterialandMissingPower',
'ImperishableNight', 'PhantasmagoriaofFlowerView', 'ShoottheBullet', 'MountainofFaith', 'ScarletWeatherRhapsody', 'SubterraneanAnimism', 'UndefinedFantasticObject', 'TouhouHisoutensoku',
'DoubleSpoiler', 'GreatFairyWars', 'TenDesires', 'HopelessMasquerade', 'DoubleDealingCharacter', 'ImpossibleSpellCard', 'UrbanLegendinLimbo', 'LegacyofLunaticKingdom',
'AntinomyofCommonFlowers', 'HiddenStarinFourSeasons', 'VioletDetector', 'WilyBeastandWeakestCreature', 'UnconnectedMarketeers', 'TouhouSangetsusei', 'TouhouBougetsushou',
'WildandHornedHermit', 'CuriositiesofLotusAsia', 'ForbiddenScrollery', 'BohemianArchiveinJapaneseRed', 'PerfectMementoinStrictSense', 'TheGrimoireofMarisa', 'SymposiumofPost-mysticism',
'AlternativeFactsinEasternUtopia', 'DollsinPseudoParadise', 'GhostlyFieldClub', 'ChangeabilityofStrangeDream', 'Retrospective53minutes', 'AkyuusUntouchedScoreVolume1',
'AkyuusUntouchedScoreVolume2', 'AkyuusUntouchedScoreVolume3', 'AkyuusUntouchedScoreVolume4', 'AkyuusUntouchedScoreVolume5', 'MagicalAstronomy', 'UnknownFlowerMesmerizingJourney',
'TrojanGreenAsteroid', 'Neo-traditionalismofJapan', 'DrLatencysFreakReport', 'DatelessBarOldAdam', 'GouyokuIbun', 'TheGrimoireofUsami', 'FoulDetectiveSatori', 'LotusEaters');
$shots = array('EoSDReimuA', 'EoSDReimuB', 'EoSDMarisaA', 'EoSDMarisaB', 'PCBReimuA', 'PCBReimuB', 'PCBMarisaA', 'PCBMarisaB', 'PCBSakuyaA', 'PCBSakuyaB', 'INBorderTeam', 'INMagicTeam', 'INScarletTeam',
'INGhostTeam', 'INReimu', 'INYukari', 'INMarisa', 'INAlice', 'INSakuya', 'INRemilia', 'INYoumu', 'INYuyuko', 'PoFVReimu', 'PoFVMarisa', 'PoFVSakuya', 'PoFVYoumu', 'PoFVReisen', 'PoFVCirno',
'PoFVLyrica', 'PoFVMystia', 'PoFVTewi', 'PoFVAya', 'PoFVMedicine', 'PoFVYuuka', 'PoFVKomachi', 'PoFVEiki', 'MoFReimuA', 'MoFReimuB', 'MoFReimuC', 'MoFMarisaA', 'MoFMarisaB', 'MoFMarisaC',
'SAReimuA', 'SAReimuB', 'SAReimuC', 'SAMarisaA', 'SAMarisaB', 'SAMarisaC', 'UFOReimuA', 'UFOReimuB', 'UFOMarisaA', 'UFOMarisaB', 'UFOSanaeA', 'UFOSanaeB', 'TDReimu', 'TDMarisa', 'TDSanae',
'TDYoumu', 'DDCReimuA', 'DDCReimuB', 'DDCMarisaA', 'DDCMarisaB', 'DDCSakuyaA', 'DDCSakuyaB', 'LoLKReimu', 'LoLKMarisa', 'LoLKSanae', 'LoLKReisen', 'HSiFSReimuSpring', 'HSiFSReimuSummer', 'HSiFSReimuAutumn',
'HSiFSReimuWinter', 'HSiFSCirnoSpring', 'HSiFSCirnoSummer', 'HSiFSCirnoAutumn', 'HSiFSCirnoWinter', 'HSiFSAyaSpring', 'HSiFSAyaSummer', 'HSiFSAyaAutumn', 'HSiFSAyaWinter', 'HSiFSMarisaSpring',
'HSiFSMarisaSummer', 'HSiFSMarisaAutumn', 'HSiFSMarisaWinter', 'WBaWCReimuWolf', 'WBaWCReimuOtter', 'WBaWCReimuEagle', 'WBaWCMarisaWolf', 'WBaWCMarisaOtter', 'WBaWCMarisaEagle',
'WBaWCYoumuWolf', 'WBaWCYoumuOtter', 'WBaWCYoumuEagle', 'UMReimu', 'UMMarisa', 'UMSakuya', 'UMSanae', 'SoEWReimuA', 'SoEWReimuB', 'SoEWReimuC', 'PoDDReimu', 'PoDDMima', 'PoDDMarisa',
'PoDDEllen', 'PoDDKotohime', 'PoDDKana', 'PoDDRikako', 'PoDDChiyuri', 'PoDDYumemi', 'LLSReimuA', 'LLSReimuB', 'LLSMarisaA', 'LLSMarisaB', 'MSReimu', 'MSMarisa', 'MSMima', 'MSYuuka',
'PoFVMerlin', 'PoFVLunasa', 'HSiFSReimuExtra', 'HSiFSCirnoExtra', 'HSiFSAyaExtra', 'HSiFSMarisaExtra');
for ($i = 0; $i < count($chars); $i++) {
    $picker_x = ($i % $row_size) * $picker_offset;
    $picker_y = floor($i / $row_size) * $picker_offset;
    $tiered_x = ($i % $row_size) * $offset;
    $tiered_y = floor($i / $row_size) * $offset;
    if ($_GET['mobile']) {
        $picker_x = ($i % $row_size) * $mobile_offset;
        $picker_y = floor($i / $row_size) * $mobile_offset;
        $tiered_x = ($i % $row_size) * $mobile_offset;
        $tiered_y = floor($i / $row_size) * $mobile_offset;
    }
    echo '#' . $chars[$i] . '.list_characters{background-position:' . $picker_x . 'px ' . $picker_y . 'px}';
    echo '#' . $chars[$i] . '.tiered_characters{background-position:' . $tiered_x . 'px ' . $tiered_y . 'px}';
}
for ($i = 0; $i < count($works); $i++) {
    $picker_x = ($i % $works_row_size) * $picker_offset;
    $picker_y = floor($i / $works_row_size) * $picker_offset;
    $tiered_x = ($i % $works_row_size) * $offset;
    $tiered_y = floor($i / $works_row_size) * $offset;
    if ($_GET['mobile']) {
        $picker_x = ($i % $works_row_size) * $mobile_offset;
        $picker_y = floor($i / $works_row_size) * $mobile_offset;
        $tiered_x = ($i % $works_row_size) * $mobile_offset;
        $tiered_y = floor($i / $works_row_size) * $mobile_offset;
    }
    echo '#' . $works[$i] . '.list_works{background-position:' . $picker_x . 'px ' . $picker_y . 'px}';
    echo '#' . $works[$i] . '.tiered_works{background-position:' . $tiered_x . 'px ' . $tiered_y . 'px}';
}
for ($i = 0; $i < count($shots); $i++) {
    $picker_x = ($i % $row_size) * $picker_offset;
    $picker_y = floor($i / $row_size) * $picker_offset;
    $tiered_x = ($i % $row_size) * $offset;
    $tiered_y = floor($i / $row_size) * $offset;
    if ($_GET['mobile']) {
        $picker_x = ($i % $row_size) * $mobile_offset;
        $picker_y = floor($i / $row_size) * $mobile_offset;
        $tiered_x = ($i % $row_size) * $mobile_offset;
        $tiered_y = floor($i / $row_size) * $mobile_offset;
    }
    echo '#' . $shots[$i] . '.list_shots{background-position:' . $picker_x . 'px ' . $picker_y . 'px}';
    echo '#' . $shots[$i] . '.tiered_shots{background-position:' . $tiered_x . 'px ' . $tiered_y . 'px}';
}
?>
