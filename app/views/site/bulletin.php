<?php
/**
 * User: Green
 * Date: 2013/8/14
 * Time: 下午 3:19
 */

$cs = Yii::app()->clientScript;
$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/bulletin.css');

?>

<div id="bulletin_main">

	<div id="bulletin_title"><?=$data['title']?></div>
	<div id="bulletin_cnt">
		<div id="bulletin_content"><?=$data['content']?></div>
		<div id="bulletin_bottom">
			posted by <?=$data['author']?> at <?=$data['time']?>
		</div>
	</div>
	<div id="bulletin_back_link"><a href="/">回首頁</a></div>


</div>