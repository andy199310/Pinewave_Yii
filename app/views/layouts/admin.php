<?php
$cs=Yii::app()->clientScript;
$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/main.css');
//$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/bootstrap.css');
$cs->registerCoreScript('jquery');
//$cs->registerCoreScript('jquery.ui');
//$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/hahapo.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/main.js');
?>

<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body id="body">
<header id="header">

</header>
<!-- The navigation bar -->
<div id="top_nav">

</div>

<div id="container">

	<?php echo $content; ?>

</div>


<footer id="footer">

</footer>
</body>
</html>