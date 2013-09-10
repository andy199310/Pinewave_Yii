節目名稱：<?=$volumeData->ProgramData['name']?><br>

集數：<?=$volumeData->count?><br>
音檔上傳：
<?php
	if($volumeData->uploaded == '1'){
		echo "已上傳";
	}else{
		echo "未上傳";
	}
?>
<?=$volumeData->uploaded?><br>
首播時間：<?=$volumeData->FirstOnAirTime['datetime']?><br>
重播時間：<?php
	foreach($volumeReplayData->ReplayOnAirTime as $data){
		echo $data['datetime'] . '<br>';
	}

?><br>
<?php
/**
 * User: Green
 * Date: 2013/9/3
 * Time: 下午 2:58
 */

//print_r($volumeReplayData);