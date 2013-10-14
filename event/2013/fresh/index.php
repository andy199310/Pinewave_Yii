<?php
$mainData = array(
	'1' => 	array(
		'id' => '500',
		'link' => 'https://docs.google.com/forms/d/1BYBP83a_k26KpS24ttXfEbaDJGYEIqtkRrRT8jluKoo',
		'time' => '2013-09-19 21:00:00'),
	'2' => array(
		'id' => '501',
		'link' => 'https://docs.google.com/forms/d/1wVYPZv7CamBNppSqdqP3xISnqh-6TGGW1ng9WKucJ34',
		'time' => '2013-09-03 21:00:00'),
	'3' => array(
		'id' => '502',
		'link' => 'https://docs.google.com/forms/d/1rM0FjQRpz1zyd-Gl1V86yF532XJmk4cfe0_Hmc3WOW0',
		'time' => '2013-09-04 21:00:00'),
	'4' => array(
		'id' => '503',
		'link' => 'https://docs.google.com/forms/d/1PA6lvXdcB5qwosxfoEOFdrA5ijg-AuZ8RZcdXIlyqWA',
		'time' => '2013-09-05 21:00:00'),
	'5' => array(
		'id' => '504',
		'link' => 'https://docs.google.com/forms/d/1XwvnjvZI1B12BMb0LhnxVsHQt2sL72InfJGaNsiBHMs',
		'time' => '2013-09-06 21:00:00'),
);


$data = array();
$list = array();

foreach($mainData as $key => $pro){
	$proTime = strtotime($pro['time']);
	if(time() > $proTime){
		if(time() > $proTime + 7200){
			$data[$key] = $pro['id'];
		}else{
			$data[$key] = 'now';
		}
	}

	if(time() > $proTime){
		if(time() > $proTime + 10800){
			$list[$key] = 'over';
		}else{
			$list[$key] = $pro['link'];
		}
	}
}

?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新生FUN送</title>
<head>
	<link type="text/css" rel="stylesheet" href="top_css.css">
	<link type="text/css" rel="stylesheet" href="mid_css.css">
	<link type="text/css" rel="stylesheet" href="bot_css.css">
	<script src="player.js"></script>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="hahapo.js"></script>
	<script src="js.js"></script>
	<script>
		data=<?=json_encode($data)?>;
		list=<?=json_encode($list)?>;
	</script>
</head>
<body id="body">
<div id="bkfade"></div>
	<div id="top_container">
		<div id="top_img">

		</div>
		<div id="top_choser">
			<div id="top_ch1"></div>
			<a href="/index.php/board"><div id="top_ch2"></div></a>
		</div>
	</div>
	<div id="mid_container">
		<div id="mid_top">
			<div id="mid_top1">
				<div id="midtop_ch1"></div>
				<a href="/pinewave_radio.m3u"><div id="midtop_ch2"></div></a>
				<div id="midtop_ch3"></div>
			</div>
			<div id="mid_top2">
			
			</div>
		</div>
		<div id="mid_mid">
			<div id="day1">
				<div id="day1_left"></div>
				<a href=""><div id="day1_mid"></div></a>
				<div id="day1_right">
					<div id="day1_right_up"></div>
					<div id="day1_right_down">
						<div id="day1_right_down_1"></div>
						<div id="day1_right_down_2"></div>
					</div>
				</div>
				<div id="day1_bot"></div>
			</div>
			<div id="day2">
				<div id="day2_left"></div>
				<a href=""><div id="day2_mid"></div></a>
				<div id="day2_right">
					<div id="day2_right_up"></div>
					<div id="day2_right_down">
						<div id="day2_right_down_1"></div>
						<div id="day2_right_down_2"></div>
					</div>
				</div>
				<div id="day2_bot"></div>
			</div>
			<div id="day3">
				<div id="day3_left"></div>
				<a href=""><div id="day3_mid"></div></a>
				<div id="day3_right">
					<div id="day3_right_up"></div>
					<div id="day3_right_down">
						<div id="day3_right_down_1"></div>
						<div id="day3_right_down_2"></div>
					</div>
				</div>
				<div id="day3_bot"></div>
			</div>
			<div id="day4">
				<div id="day4_left"></div>
				<a href=""><div id="day4_mid"></div></a>
				<div id="day4_right">
					<div id="day4_right_up"></div>
					<div id="day4_right_down">
						<div id="day4_right_down_1"></div>
						<div id="day4_right_down_2"></div>
					</div>
				</div>
				<div id="day4_bot"></div>
			</div>
			<div id="day5">
				<div id="day5_left"></div>
				<a href=""><div id="day5_mid"></div></a>
				<div id="day5_right">
					<div id="day5_right_up"></div>
					<div id="day5_right_down">
						<div id="day5_right_down_1"></div>
						<div id="day5_right_down_2"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="mid_bot"></div>
	</div>
	<div id="bot_container">
		<div id="bot_up">
			<div id="bot_ch1"></div>
			<a target="_blank" href="http://radio.pinewave.tw/"><div id="bot_ch2"></div></a>
			<div id="bot_ch3"></div>
			<a target="_blank" href="https://www.facebook.com/pinewave"><div id="bot_ch4"></div></a>
			<div id="bot_ch5"></div>
			<a target="_blank" href="http://www.ncu.edu.tw/"><div id="bot_ch6"></div></a>
			<div id="bot_ch7"></div>
			<a target="_blank" href="http://love.adm.ncu.edu.tw/NCU_counsel/"><div id="bot_ch8"></div></a>
			<div id="bot_ch9"></div>
		</div>
		<div id="bot_down"></div>
	</div>
</body>

</html>