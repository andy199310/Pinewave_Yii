<?php
	$cs = Yii::app()->clientScript;
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/player.js');
?>

節目名稱：<?=$volumeData->ProgramData->name?><br>

集數：<?=$volumeData->count?><br>
音檔上傳：
<?php
	if($volumeData->uploaded == '1'){
		echo "已上傳";
		$date = preg_replace("/[0-9]{4}-([0-9]{2})-([0-9]{2}) (.+)/","\\1/\\2",$volumeData->FirstOnAirTime->datetime);
?>
		<div id="player"></div>
		<?=CHtml::tag('div',
		array('onclick' => "player('{$volumeData->vid}', '{$volumeData->ProgramData->name}', '{$date}');"),"點我試聽");?>

<?php
	}else{
		echo "未上傳";
	}
?>
<a href="/index.php/admin/uploadVolume/<?=$vid?>">點我上傳</a> <br/>

<?php
	if($volumeCopyrightCount != 0){
?>
<a style="font-size: 20px;" href="/admin/showCopyright/<?=$vid?>">版權清單</a> <br/>
<?php
	}else{
	?>
<a style="font-size: 40px; rgb(71, 255, 0);" href="/admin/showCopyright/<?=$vid?>">版權清單</a> <br/>
<?php
	}
?>

首播時間：<?=$volumeData->FirstOnAirTime['datetime']?><br>
重播時間：<?php

	foreach($volumeReplayData as $data){
		foreach($data->ReplayOnAirTime as $smallData){
			echo $smallData->datetime . '<br/>';
		}
//		echo $data->ReplayOnAirTime['datetime'] . '<br>';
	}

?><br>
