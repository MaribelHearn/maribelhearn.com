<!DOCTYPE html>
<html lang='en'>
<?php
    include 'assets/shared/shared.php';
    hit(basename(__FILE__));
	$page = str_replace('.php', '', basename(__FILE__));
?>

    <head>
		<title>Touhou Replay Showcase</title>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width'>
        <link rel='preload' type='font/woff2' href='assets/fonts/Felipa-Regular.woff2' as='font' crossorigin>
        <meta name='description' content='Read about the weekly Touhou Replay Showcase Twitch streams.'>
        <meta name='keywords' content='touhou, touhou project, replay, showcase, trs, twitch, stream, submit, submitting, submission, schedule, schedules'>
		<link rel='stylesheet' type='text/css' href='assets/shared/css_concat.php?page=trs'>
		<link rel='icon' type='image/x-icon' href='assets/trs/trs.png'>
        <script src='assets/shared/js_concat.php?page=trs' defer></script>
    </head>

    <body>
        <nav>
            <div id='nav' class='wrap'><?php echo navbar($page) ?></div>
        </nav>
        <main>
            <div id='wrap' class='wrap'>
                <p id='ack'>The background image was drawn by <a href='https://www.pixiv.net/en/users/20799'>白雪 睦月</a></p>
                <span id='hy_container'><span id='hy'></span>
                    <span id='hy_tooltip' class='tooltip'><?php echo theme_name() ?></span>
                </span>
                <h1>Touhou Replay Showcase</h1>
                <?php
                    if (!empty($_GET['redirect'])) {
                        echo '<p>(Redirected from <em>' . $_GET['redirect'] . '</em>)</p>';
                    }
                ?>
                <p>Touhou Replay Showcase is a weekly community stream that is broadcast every weekend.
                Players can submit their Touhou replays to the stream, which will be showcased and commentated on in some future weekend.
                Any skill level or category is accepted. Currently, the stream is managed by
                <a href='https://twitter.com/Gastari_'>Gastari</a>.</p>
                <h2>Submission Rules</h2>
                <p>Copy from the Twitch stream description:</p>
                <p><strong>Submission Limit: ONE run per player per 2 months (temporary).</strong></p>
                <p>The runs submitted will be shown during one of the streams.
                Depending on how big the queue is it could take up to a month to get your run showcased.
                Any kind of run of the official shoot 'em up games (or a fan-made one) as well as Seihou is allowed to be submitted,
                including Game Overs. Bonus points if you keep whether it clears or not secret!
                If you would like your run to be replaced you can ask in the "Inquiries channel" on the TRS Community server,
                just be sure to specify the new informations about your run as well as the row in the queue of your old submission.</p>
                <p>For survival runs, we will fast-forward through the earlier three stages, and for scoring runs,
                the whole run will be shown at normal speed. If you want specific parts of the run shown at full speed,
                you can specify that in the form. For No Shooting or Pacifist runs large parts will be fast forwarded due to
                their long duration. For scene games a batch of at most 5 replays may be submitted at once
                (preferably in an archive format such as .zip).</p>
                <p>If you have any questions about submitting and the rules of the stream,
                feel free to ask us in the TRS Discord server.</p>
                <h2>Links</h2>
                <p><a href='https://twitch.tv/touhou_replay_showcase'>
                    <span class='icon twitch_icon'></span> Touhou Replay Showcase Twitch channel
                </a></p>
                <p><a href='https://discord.gg/xU3utzg'>
                    <span class='icon discord_icon'></span> Touhou Replay Community Discord server
                </a></p>
                <p><a href='https://forms.gle/nvpn2rcbmCvN6WZHA'>
                    <span class='icon forms_icon'></span> Submit your replays here
                </a></p>
                <p><a href='https://docs.google.com/spreadsheets/d/1YJ644DfyjU02ECytPoySlz4FMWwoiJQMZEJxlChz7I0/edit?usp=sharing'>
                    <span class='icon sheets_icon'></span> Current queue
                </a></p>
                <p id='ack_mobile'>The background image was drawn by <a href='https://www.pixiv.net/en/users/20799'>白雪 睦月</a>.</p>
            </div>
        </main>
    </body>

</html>
