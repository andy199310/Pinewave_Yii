<?php
$cs=Yii::app()->clientScript;
$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/main.css');
//$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/bootstrap.css');
$cs->registerCoreScript('jquery');
//$cs->registerCoreScript('jquery.ui');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/hahapo.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/main.js');

?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body id="body">
		<div id="bkfade"></div>
		<div id="listen_now">
			<script type="text/javascript" src="http://www.museter.com/mrp.js"></script>
			<script type="text/javascript">
				MRP.insert({
					'url':'http://broadcast.pinewave.tw:8000/;',
					'codec':'mp3',
					'volume':100,
					'autoplay':false,
					'jsevents':true,
					'buffering':5,
					'title':'Pinewave Radio',
					'welcome':'Pinewave Radio',
					'wmode':'transparent',
					'skin':'mcclean',
					'width':0,
					'height':0
				});
			</script>

		</div>
		<header id="header">
			<div id="top_img">
				<div id="top_link" onclick="window.location='http://radio.pinewave.tw';"></div>
				<?php
					if(YII_DEBUG == true){
						echo '<div style="position: absolute; color: red; font-size: 165px;top: 90px;">這是測試版!!!</div>';
					}
				?>
			</div>
		</header>
		<!-- The navigation bar -->
		<div id="top_nav">

				<a href="/pinewave_radio.m3u" target="_blank"><div id="top_nav_head"></div></a>
				<?php
					$site = array('about', 'program', 'staff', 'board', 'fb');
					foreach($site as $thisSite){
						echo Html::headImgButton($thisSite);
					}
				?>

		</div>
		<div class="box_line"></div>

			<?php echo $content; ?>

		<div class="box_line"></div>

		<footer id="footer">
				<div id="bot_chooser">
					<div id="bot_ch1" class="footer_ch" onclick="window.location='http://www.ncu.edu.tw'"></div>
					<div id="bot_ch2" class="footer_ch" onclick="window.location='http://osa-55.adm.ncu.edu.tw/main.php'"></div>
					<div id="bot_ch3" class="footer_ch" onclick="window.location='http://love.adm.ncu.edu.tw/NCU_Counsel/'"></div>
					<div id="bot_ch4" class="footer_ch" onclick="window.location='/index.php/admin/index'"></div>
				</div>

		</footer>
	</body>
</html>