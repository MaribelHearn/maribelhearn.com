<?php
    function getAge($then) {
        $then_ts = strtotime($then);
        $then_year = date('Y', $then_ts);
        $age = date('Y') - $then_year;
        if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
        return $age;
    }
?>
<div id='wrap' class='wrap'>
    <?php echo wrap_top() ?>
    <p>Hello, I am Mari, a <?php echo getAge('1995-07-29'); ?> year old Dutch guy who
    likes to play shoot 'em up games seriously.</p>
    <p class='wide'>I am a nerdy person that studied Computer Science and takes keen interests in countries, travel,
    geography, history, and public transportation. Traveling is my absolute favourite activity in life. I have
    visited 43 different countries so far, including my home country of the Netherlands, and one of my life goals is to
    visit every country in Europe, as well as at least one country per continent. Of course, I also like Web development.</p>
    <figure>
        <img id='map' src='assets/main/about/countries.png' alt='Maribel&#39;s visited countries map'>
        <figcaption><em>Countries visited as of 2025</em></figcaption>
    </figure>
    <p class='wide'>Other than shoot 'em ups, there's a good number of games I value highly, as I loved playing them (still do) and they had
    a great positive influence on my life:</p>
    <ul>
        <li>Pokémon series (generations 3 to 5, including Colosseum, XD and especially Pokémon Battle Revolution)</li>
        <li>Kirby series (my favourite being Kirby &amp; the Amazing Mirror)</li>
        <li>Mario series (Mario Kart, Mario RPGs, both Paper Mario and Mario &amp; Luigi)</li>
        <li>Keitai Denjuu Telefang (both games)</li>
        <li>Super Smash Bros. series</li>
        <li>Labyrinth of Touhou</li>
    </ul>
    <p class='wide'>See <a href='#touhou'>the bottom of this page</a> for my favourite Touhou characters.</p>
    <h2 id='music'>Music</h2>
    <p class='wide'>I also absolutely love to listen to video game OST, especially that of many shoot 'em up games.
    My favourite composers to listen to themes of are the following:</p>
    <ul>
        <li>ZUN (Touhou series, Seihou Shuusou Gyoku)</li>
        <li>Manabu Namiki (many CAVE shoot 'em up titles)</li>
        <li>Rengoku Teien (their music as used in Labyrinth of Touhou)</li>
        <li>Saitama Saisyu Heiki (aka S.S.H, most notably eXceed 3rd)</li>
    </ul>
    <p class='wide'>OST makes up more than 90% of all of my time spent listening to music. My favourite OSTs to listen to
    include Labyrinth of Touhou, Seihou Shuusou Gyoku and various other games that I have played.
    Some of my favourite themes are listed in the table below.</p>
    <table id='music_links' class='noborders'>
        <thead>
            <tr>
                <th>Link</th>
                <th>Origin</th>
                <th>Composer</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=AAdHRSUNZUs' target='_blank'>Bloom Nobly, Ink-Black Cherry Blossom ~ Border of Life</a></td>
                <td>Touhou 7: Perfect Cherry Blossom, Final Boss</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=pw2WQjqKpVM' target='_blank'>Flight of the Bamboo Cutter ~ Lunatic Princess</a></td>
                <td>Touhou 8: Imperishable Night, Final Boss</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=PitDLZPaVhA' target='_blank'>The Primal Scene of Japan The Girl Watched</a></td>
                <td>Touhou 10: Mountain of Faith, Stage 5</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=ITYCfbE76ZM' target='_blank'>The Venerable Ancient Battlefield ~ Suwa Foughten Field</a></td>
                <td>Touhou 10: Mountain of Faith, Final Boss</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=mkziV4fQy2Y' target='_blank'>Skies Beyond the Clouds</a></td>
                <td>Touhou 10.5: Scarlet Weather Rhapsody, Iku Pre-Battle</td>
                <td>U2 Akiyama</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=5Bda8sKdoIk' target='_blank'>Heartfelt Fancy</a></td>
                <td>Touhou 11: Subterranean Animism, Stage 4</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=7wEHo_uUgZ0' target='_blank'>Hartmann's Youkai Girl</a></td>
                <td>Touhou 11: Subterranean Animism, Extra Stage Boss</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=yHlbViNW-eI' target='_blank'>The Refrain of the Lovely Great War</a></td>
                <td>Touhou 12.8: Great Fairy Wars, Stage 1</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=Sf0weS6_iuM' target='_blank'>Staking Your Life on a Prank</a></td>
                <td>Touhou 12.8: Great Fairy Wars, Boss Battle</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=IUKsMBN7dS4' target='_blank'>The Hall of Dreams' Great Mausoleum</a></td>
                <td>Touhou 13: Ten Desires, Stage 5</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=0o8xTL_W-9I' target='_blank'>Illusionary White Traveler</a></td>
                <td>Touhou 16: Hidden Star in Four Seasons, Stage 4</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=sxpRSGm-2ao#t=5m29s' target='_blank'>False Strawberry</a></td>
                <td>Seihou Shuusou Gyoku, Stage 1</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=sxpRSGm-2ao#t=13m22s' target='_blank'>Illusory Imperial Capital</a></td>
                <td>Seihou Shuusou Gyoku, Stage 2</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=sxpRSGm-2ao#t=22m11s' target='_blank'>Illusion of Flowers, Air of Scarlet Dream</a></td>
                <td>Seihou Shuusou Gyoku, Stage 3</td>
                <td>ZUN</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=HshrdY3Mu8I' target='_blank'>Endless Night View</a></td>
                <td>Seihou Banshiryuu C67, Stage 2</td>
                <td>halt, Doku Den P</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=gJuIRucytTc' target='_blank'>Trans--</a></td>
                <td>Seihou Banshiryuu C67, Final Boss</td>
                <td>halt, Doku Den P</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=OfH1FrSlDws' target='_blank'>Broken Strawberry Shortcake</a></td>
                <td>Samidare, Extra Stage Second Boss</td>
                <td>Ryu-Lighter</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=nAPXKiYenE0' target='_blank'>Setting Off ~ Departure Dream</a></td>
                <td>Mrs. Estacion, Stage 2</td>
                <td>Misora</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=hW0imzh6KiU' target='_blank'>And Forever, the End of the Dream</a></td>
                <td>Mrs. Estacion, Staff Roll</td>
                <Td>Misora</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=L_aUBbZ2rJQ' target='_blank'>Eternal Stars in Memories</a></td>
                <td>Touhou Shining Shooting Star, Stage 5</td>
                <td>Shihenwx</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=AoE-S6z5K-E' target='_blank'>Flowers in the Wind, Moon in the Snow</a></td>
                <td>Touhou Shining Shooting Star, Extra Boss</td>
                <td>11</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=8ym2uK-nm7k' target='_blank'>Reality</a></td>
                <td>Ikaruga, Stage 4</td>
                <td>Hiroshi Iuchi</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=5kjD1AYEpV0' target='_blank'>Geo Frontier</a></td>
                <td>Batsugun, Stage 5</td>
                <td>Yoshitatsu Sakai</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=MipAMcUWQfI' target='_blank'>Ai</a></td>
                <td>Dodonpachi Saidaioujou, Stage 3</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=m6wbfQkUI7I' target='_blank'>The Battle Was Just "To Continue That Future"</a></td>
                <td>Dodonpachi Daifukkatsu, Stage 5</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=SimTGe2xYno' target='_blank'>Vertigo</a></td>
                <td>Dodonpachi Daifukkatsu Black Label, Stage 5</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=TumC-lBTD6U' target='_blank'>Walking on the Land of Flame</a></td>
                <td>Mushihimesama, Stage 3</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=XqNZL6Vp-w8' target='_blank'>Like the Night of the Falling Stars</a></td>
                <td>Mushihimesama, Stage 4</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=PMSs_2f2iOE' target='_blank'>The Black Shell Beast King</a></td>
                <td>Mushihimesama Futari, Stage 4</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=OpUf3aaY1hQ' target='_blank'>Underworld Cherry Blossoms</a></td>
                <td>Guwange, Stage 3</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=CYSAwgic8nc' target='_blank'>Aerial ~ Sadness Bathes in Dust</a></td>
                <td>Espgaluda II, Stage 4</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=I-CmMZxvFO0' target='_blank'>Galuda ~ Achieving Perfection</a></td>
                <td>Espgaluda II, Stage 6</td>
                <td>Manabu Namiki</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=C4OIyerQUWU' target='_blank'>Maid to Order</a></td>
                <td>eXceed 3rd JADE PENETRATE, Stage 4</td>
                <td>Saitama Saisyu Heiki (S.S.H)</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=wBudg5ekli0' target='_blank'>Maid to Order (Arranged)</a></td>
                <td>eXceed 3rd JADE PENETRATE Black Package, Stage 4</td>
                <td>Saitama Saisyu Heiki (S.S.H)</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=UzCNF-ZQVfs' target='_blank'>Deceitful Wings (Arranged)</a></td>
                <td>Atelier Iris: Eternal Mana, Final Boss</td>
                <td>Saitama Saisyu Heiki (S.S.H)</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=ZG6n3zXnCiA' target='_blank'>The Fortress City Lea Monde</a></td>
                <td>Labyrinth of Touhou, Dungeon (floors 3F, 4F, 29F)**</td>
                <td>KMF</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=P5-0SONpflc' target='_blank'>Road to the Globe</a></td>
                <td>Labyrinth of Touhou, Dungeon (floors 7F, 13F, 22F, 24F)*</td>
                <td>Rengoku Teien</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=Hd26EqXP4PE' target='_blank'>Dark a Liar</a></td>
                <td>Labyrinth of Touhou, Final Boss*</td>
                <td>Rengoku Teien</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=gJkVwt_JJXo' target='_blank'>Stickerbush Symphony</a></td>
                <td>Super Smash Bros. Brawl</td>
                <td>Michiko Naruke</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=L_jHGmrmyh0' target='_blank'>Battle! Gym Leader</a></td>
                <td>Pokemon Ruby, Sapphire, Emerald</td>
                <td>Junichi Masuda</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=llnXhrCn9Yo' target='_blank'>Battle! Elite Four</a></td>
                <td>Pokemon Black and White, Elite Four</td>
                <td>Junichi Masuda</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=WuhqoZvyntA' target='_blank'>Miror B. Battle</a></td>
                <td>Pokemon XD</td>
                <td>Tsukasa Tawada</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=g-4iSpyW5YY' target='_blank'>Title Screen</a></td>
                <td>Pokemon Battle Revolution</td>
                <td>Tsukasa Tawada</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=wprKfKj7tsc' target='_blank'>Neon Colosseum</a></td>
                <td>Pokemon Battle Revolution</td>
                <td>Tsukasa Tawada</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=iFJ_0h2j-Zk' target='_blank'>Battle! T-Fanger</a></td>
                <td>Keitai Denjuu Telefang 2</td>
                <td>Minako Adachi</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=QWiztiajOtI' target='_blank'>Rock Star</a></td>
                <td>Kirby 64</td>
                <td>Jun Ishikawa</td>
            </tr>
            <tr>
                <td><a href='https://www.youtube.com/watch?v=HCIMHn5FEYQ' target='_blank'>Factory Inspection</a></td>
                <td>Kirby 64</td>
                <td>Jun Ishikawa</td>
            </tr>
        </tbody>
    </table>
    <p class='wide-top'>* Rengoku Teien is a group of composers that produces royalty-free music; Labyrinth of Touhou simply uses it, among music by other composers.</p>
    <p class='wide-top'>** Same story as above; this is royalty-free music that was used in Labyrinth of Touhou, but I personally associate it with the game.</p>
    <p class='wide-top'>Vertigo is possibly my favourite piece of music of all time.</p>
    <h2 id='trivia'>Trivia</h2>
    <ul>
        <li>I formerly used the default keyboard that came with my previous PC to play, which made me one of the
        rare serious keyboard players <em>not</em> to use a mechanical keyboard.</li>
        <li>Linux distributions are my preferred operating systems. I have used them on my laptop since late 2014 and
        on my main PC since late 2018.</li>
        <li>A heavily tweaked Firefox is my preferred browser (most tweaks being for privacy reasons). I also used Pale Moon for a while.</li>
        <li>As of my most recent measurement, I am 1.934 meters tall, or 6' 4'' in feet and inches.</li>
        <li>I cannot stand the smell of oranges. I also tend to dislike anything citrus, but only if the taste is too prevalent;
        lemon tea, for instance, is fine.</li>
        <li>My favourite movie series is Back to the Future, no contest.</li>
    </ul>
    <h2 id='touhou'>Touhou Taste</h2>
    <figure>
        <img id='tiers' src='assets/main/about/tiers.png' alt='Maribel&#39;s Touhou character tier list'>
        <figcaption><em>Touhou character tier list as of 27 November 2025</em></figcaption>
    </figure>
    <footer class='wide-top'><strong><a href='#top'>Back to Top</a></strong></footer>
</div>
