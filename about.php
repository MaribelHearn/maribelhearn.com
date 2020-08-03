<!DOCTYPE html>
<html lang='en'>
<?php
    include '.stats/count.php'; hit(basename(__FILE__));
    function getAge($then) {
        $then_ts = strtotime($then);
        $then_year = date('Y', $then_ts);
        $age = date('Y') - $then_year;
        if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
        return $age;
    }
?>

    <head>
		<title>About Me - Maribel Hearn's Web Portal</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='stylesheet' type='text/css' href='assets/index/main.css'>
		<link rel='icon' type='image/x-icon' href='favicon.ico'>
    </head>

    <body class='<?php echo check_webp() ?>'>
        <div id='wrap'>
            <img id='hy' src='assets/shared/h-bar.png' title='Human Mode'>
            <h1>About Me</h1>
            <p>Hello, I am Mari, a <?php echo getAge('1995-07-29'); ?> year old Dutch guy who
            likes to play shoot 'em up games seriously.</p>
            <p class='wide'>I am a nerdy person that studies Computer Science and takes keen interests in countries, travel,
            geography, history, and public transportation. I have visited 24 different countries so far in my life, including
            my home country of the Netherlands, and one of my life goals is to visit every country in Europe, as well as at least
            one country per continent.</p>
            <figure>
                <img class='map' src='assets/index/countries.png'>
                <figcaption><em>Countries visited as of 2020</em></figcaption>
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
            <p class='wide'>I also absolutely love to listen to video game OST, especially that of many shoot 'em up games.
            My favourite composers to listen to themes of are the following:</p>
            <ul>
                <li>ZUN (Touhou series, Seihou Shuusou Gyoku)</li>
                <li>Manabu Namiki (many CAVE shoot 'em up titles)</li>
                <li>Rengoku Teien (their music as used in Labyrinth of Touhou)</li>
                <li>Saitama Saisyu Heiki (most notably eXceed 3rd)</li>
            </ul>
            <p class='wide'>OST makes up more than 90% of all of my time spent listening to music. My favourite OSTs to listen to
            include Labyrinth of Touhou, Seihou Shuusou Gyoku, Samidare, Dodonpachi Saidaioujou, Mushihime-sama as well as Futari,
            Great Fairy Wars, Subterranean Animism, Shining Shooting Star, Mrs. Estacion, eXceed 3rd, Guwange and Ikaruga;
            many more follow suit.</p>
            <p class='wide'>My favourite Touhou characters are Maribel, Narumi, Kaguya, Yuyuko, Star Sapphire, Lily White,
            as well as Reimu and Marisa.</p>
            <h2>Trivia</h2>
            <img src='assets/index/maribelb.png'>
            <ul>
                <li>My current avatar (shown above) is a non-canon depiction of Maribel
                having gone berserk due to her powers overflowing, which is the final boss of Labyrinth of Touhou.</li>
                <li>I use the default keyboard that came with my PC to play, making me one of the
                rare serious keyboard players <em>not</em> to use a mechanical keyboard.</li>
                <li>Linux distributions are my preferred operating systems. I have used them on my laptop since late 2014 and
                on my main PC since late 2018. Firefox is my preferred browser and has been for a long time.</li>
                <li>As of my most recent measurement, I am 1.934 meters tall, or 6' 4'' in feet and inches.</li>
                <li>I have my smartphone hanging around my neck. It's very convenient, allows me to immediately grab it when I need it,
                yet I have yet to meet even a single other person that does this.</li>
                <li>I cannot stand the smell of oranges. I also tend to dislike anything citrus, but only if the taste is too prevalent;
                lemon tea, for instance, is fine.</li>
            </ul>
            <p class='wide'><a href='/'>Back to Main Page</a></p>
        </div>
        <script src='assets/shared/dark.js'></script>
    </body>

</html>
