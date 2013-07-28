<?php
$cs=Yii::app()->clientScript;
$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/main.css');
//$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/bootstrap.css');
//$cs->registerCoreScript('jquery');
//$cs->registerCoreScript('jquery.ui');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/main.js');
//$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/bootstrap.js');
?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body id="body">
		<div id="bkfade"></div>
		<header id="header">
			<div id="top_img"></div>
		</header>
		<!-- The navigation bar -->
		<div id="top_nav">

				<div id="top_nav_head"></div>
				<?php
					$site = array('about', 'intro', 'staff', 'board', 'fb');
					foreach($site as $thisSite){
						echo Html::headImgButton($thisSite);
					}
				?>

		</div>
		<div class="box_line"></div>

		<div id="container">

			<?php echo $content; ?>

		</div>

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