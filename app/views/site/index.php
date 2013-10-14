<?php
	$cs = Yii::app()->clientScript;
	$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/index.css');
?>
<div id="upper">
<div id="special_event"><a href="<?=Yii::app()->params['event']['url']?>"><img src="/file/img/special_event/freshManNew.jpg" style="width:100%;height: 100%"/></a></div>
<div id="next_program">
	<?php
		if($nextProgram != NULL){
	?>
	<div id="next_program_word">即將播出</div>
	<div id="next_program_all">
		<div id="next_program_left">
			<div id="next_program_image"><?//=$nextProgram['pic']?></div>
			<div id="next_program_program_name"><?=$nextProgram->data->ProgramData->name?></div>
		</div>
		<div id="next_program_right">
			<div id="next_program_dj"><?=$nextProgram->data->ProgramData->dj?></div>
			<div id="next_program_intro"><?=$nextProgram->data->ProgramData->simple_intro?></div>
			<div id="next_program_link"><?=CHtml::tag('a',array('href'=>$this->createUrl('index.php/program/'. $nextProgram->data->ProgramData->id)), '...see more')?></div>
		</div>
	</div>
	<?php
	}else{
			?>
			<div id="next_program_word">即將播出</div>
			<div id="next_program_all">
				<div id="next_program_left">
					<div id="next_program_image"></div>
					<div id="next_program_program_name"></div>
				</div>
				<div id="next_program_right">
					<div id="next_program_dj"></div>
					<div id="next_program_intro"></div>
					<div id="next_program_link"></div>
				</div>
			</div>
	<?php
		}
	?>
</div>
</div>
<div id="down">
<div id="before_program">
	<?php
	if($previousProgram != NULL){
	?>
	<div id="before_program_word">熱門節目</div>
	<div id="before_program_all">
		<div id="before_program_left">
			<div id="before_program_image"><?//=$previousProgram['pic']?></div>
			<div id="before_program_program_name"><?=$previousProgram->data->ProgramData->name?></div>
		</div>
		<div id="before_program_right">
			<div id="before_program_dj"><?=$previousProgram->data->ProgramData->dj?></div>
			<div id="before_program_intro"><?=$previousProgram->data->ProgramData->simple_intro?></div>
			<div id="before_program_link"><?=CHtml::tag('a',array('href'=>$this->createUrl('index.php/program/'. $previousProgram->data->ProgramData->id)), '...see more')?></div>
		</div>
	</div>
	<?php
	}else{
	?>
	<div id="before_program_word">熱門節目</div>
	<div id="before_program_all">
		<div id="before_program_left">
			<div id="before_program_image"></div>
			<div id="before_program_program_name"></div>
		</div>
		<div id="before_program_right">
			<div id="before_program_dj"></div>
			<div id="before_program_intro"></div>
			<div id="before_program_link"></div>
		</div>
	</div>
	<?php
	}
	?>
</div>
<div id="bulletin">
	<div id="bulletin_title"></div>
	<div id="bulletin_cnt">
	<?php
		foreach($bulletinData as $thisData){
			$time = preg_replace("/[0-9]{4}-([0-9]{2})-([0-9]{2}).*/","\\1/\\2",$thisData['time']);
			$a = CHtml::tag('a', array('href'=>$this->createUrl('index.php/bulletin/'. $thisData['id'])), $time.$thisData['title']);
			$div = CHtml::tag('div', array('class'=>'bulletin_link'), $a);
			echo $div;

		}

	?>
	</div>
</div>
</div>