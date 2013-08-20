<?php
	$cs = Yii::app()->clientScript;
	$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/program_one.css');
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/player.js');
	$imgSrc = Yii::app()->params['programImgPath'].'pic'.$programData['id'].'.jpg';
//	$chooseFilePath = 'xxx';
?>

<div id="program_cnt">
	<div id="program_cnt_left">
		<?=$programLeft?>
	</div>
	<div id="program_cnt_right">
		<div id="program_one_name"><?=$programData['name'];?></div>
		<div class="program_cross"></div>
		<div id="program_one_dj">主持人：<?=$programData['dj']?></div>
		<div id="program_one_pic">
			<img src="<?=$imgSrc?>">
		</div>
		<div id="program_one_intro">
			<?=$programData['introduction']?>
		</div>

		<div id="program_one_choose">
			<div id="program_one_choose_word">隨選即聽</div>
			<div class="program_cross"></div>
			<div id="player"></div>
			<ul id="program_one_choose">
			<?php
				foreach($programChooseData as $data){
					$date = preg_replace("/[0-9]{4}-([0-9]{2})-([0-9]{2}) (.+)/","\\1/\\2",$data['datetime']);
					echo CHtml::tag('li',
					array('onclick' => "player('{$data['id']}', '{$programData['name']}', '{$date}');"),$date);
				}
			?>
			</ul>
		</div>

	</div>
</div>