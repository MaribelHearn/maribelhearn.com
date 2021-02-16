<!DOCTYPE html>
<html>
	<head>
		<title>ZPS STG</title>
	</head>
<body bgcolor="#000000" text="ffa635" link="a5c2ff" alink="981213" vlink="a5c2ff">
	<center>
		<h1>
		<font face="Arial" color="ffffff">ZPS STG</font>
		</h1>
		Last Update: 2021 February 16
		<form>
			<a target="_top" href="https://zps-stg.github.io/">Home</a>	|
			<a target="_top" href="https://zps-stg.github.io/other">Back to Other Pages</a>
		</form>
	</center>
	<hr>
		<font face="Arial" size="+3" color="ffffff">
			<center><b>UFO Summon Score Calculator</b></center>
		</font>
	<hr>
	</br>
	<center>
		<font face="Arial">
			Made with help from Maribel Hearn, temporarily hosted on maribelhearn.com</br></br>
			<form>
			<label name='colorLabel' for='color'>Color</label>
			<select name='color'>
				<option value='red' <?php echo $_GET['color'] && $_GET['color'] == 'red' ? 'selected' : '' ?>>Red</option>
				<option value='green' <?php echo $_GET['color'] && $_GET['color'] == 'green' ? 'selected' : '' ?>>Green</option>
				<option value='blue' <?php echo $_GET['color'] && $_GET['color'] == 'blue' ? 'selected' : '' ?>>Blue</option>
				<option value='rainbow' <?php echo $_GET['color'] && $_GET['color'] == 'rainbow' ? 'selected' : '' ?>>Rainbow</option>
			</select>
			<label for='piv'>PIV</label>
			<input name='piv' type='number' min='0' <?php echo 'value=\'' . $_GET['piv']  . '\'' ?>>
			<label for='point'>Point Items</label>
			<input name='point' type='number' min='0' <?php echo 'value=\'' . $_GET['point']  . '\'' ?>>
			<label for='power'>Power Items</label>
			<input name='power' type='number' min='0' <?php echo 'value=\'' . $_GET['power']  . '\'' ?>>
			<label for='stage'>Stage</label>
			<select name='stage'>
				<option value='0' <?php echo $_GET['stage'] && $_GET['stage'] == '0' ? 'selected' : '' ?>>1</option>
				<option value='1' <?php echo $_GET['stage'] && $_GET['stage'] == '1' ? 'selected' : '' ?>>2</option>
				<option value='2' <?php echo $_GET['stage'] && $_GET['stage'] == '2' ? 'selected' : '' ?>>3</option>
				<option value='3' <?php echo $_GET['stage'] && $_GET['stage'] == '3' ? 'selected' : '' ?>>4</option>
				<option value='4' <?php echo $_GET['stage'] && $_GET['stage'] == '4' ? 'selected' : '' ?>>5</option>
				<option value='5' <?php echo $_GET['stage'] && $_GET['stage'] == '5' ? 'selected' : '' ?>>6</option>
				<option value='6' <?php echo $_GET['stage'] && $_GET['stage'] == '6' ? 'selected' : '' ?>>Extra</option>
			</select>
			<label for='full_power'>Full power?</label>
			<input name='full_power' type='checkbox' class='check' <?php echo $_GET['full_power'] && $_GET['full_power'] == 'on' ? 'checked' : '' ?>>
			<input type='submit' value='Calculate'>
			</form>
			<?php
				function item_reqs(int $stage) {
					switch ($stage) {
						case 1: return 36;
						case 2: return 39;
						case 3: return 42;
						case 4: return 46;
						case 5: return 51;
						case 6: return 56;
						default: return 34;
					}
				}
				function multiplier(bool $full_ufo, bool $full_power, string $color) {
					if ($color == 'red') {
						return $full_power ? 2 : 1;
					}
					if ($full_ufo == TRUE) {
						switch ($color) {
							case 'blue': return 8;
							case 'rainbow': return 4;
							case 'green': return 2;
						}
					} else {
						switch ($color) {
							case 'blue': return 6;
							case 'rainbow': return 3;
							case 'green': return 1;
						}
					}
				}
				function ufo_value() {
					$color = $_GET['color'];
					$piv = $_GET['piv'];
					$point = $_GET['point'];
					$power = $_GET['power'];
					$stage = (int) $_GET['stage'];
					$full_power = $_GET['full_power'] == 'on';
					$items = $point + $power;
					$full_ufo = $items >= item_reqs($stage);
					$multiplier = multiplier($full_ufo, $full_power, $color);
					$result = $piv * $multiplier;
					if ($color == 'red') {
						return $result * $items;
					} else if ($color == 'rainbow') {
						return $result * $power;
					} else {
						return $result * $point;
					}
				}
			?>
			</br>Note: For rainbow UFOs, enter the number of power and point items <i>BEFORE</i> conversion.</br></br>
			<h2><b><?php
			if ($_GET['color']) {
				$ufo_value = ufo_value();
				$message = 'The score for this summon is ' . number_format(ufo_value(), 0, '.', ',') . ' points.';
				if ($ufo_value >= 1000000000 || is_infinite($ufo_value)) {
					$message .= ' A summon of this value would crash the game!';
				}
				echo $message;
			}
			?></b></h2>
		</font>
	</center>
	<hr>
		<font face="Arial" size="+1" color="ffffff">
			<b>Explanation</b>
		</font>
	</br></br>
		<font face="Arial">
			Summons are the largest source of score in UFO.
			While a UFO is summoned, it will collect all point and power items on screen until either it is broken or it goes off screen.
			When the UFO is broken, a score bonus is awarded depending on a few factors.
			The three main factors in determining the score gained from a UFO summon are the color of the UFO, the number of items it collects, and your current point item value.
			Each UFO has two multipliers, a high multiplier and a low multiplier.
			For green, blue, and rainbow UFOs, this is determined by whether or not the UFO was filled before being broken.
			UFOs are filled when they collect a certain number of items, which increases after each stage.
			For Stage 1 this is 34 items, which goes up to 36 in Stage 2, then 39, 42, 46, 51, and finally, 56 in the Extra stage.
			Red UFOs instead give the high multiplier at full power and the low multiplier at 3.99 power and below.
			The high multipliers are 2 for red and green, 8 for blue, and 4 for rainbow, and the low multipliers are 1 for red and green, 6 for blue, and 3 for rainbow.
			From there: score is calculated from this formula:</br></br>
			[ Number of items ] x [ Point item value ] x [ UFO multiplier ]</br></br>
			For green and blue UFOs, only point items are factored in to this calculation.
			Red UFOs count power items <i>in addition to</i> point items.
			Rainbow UFOs reverse every item, so all power items it collects are converted to point items and vice versa.
		</font>
</body>
</html>
