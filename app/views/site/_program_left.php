<?php
/**
 * User: Green
 * Date: 2013/8/12
 * Time: 下午 4:58
 */

$cs = Yii::app()->clientScript;
$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/program_left.css');
?>

<div class="program_left_block">
	<!-- 常態節目-->
	<div class="program_left_title" id="1">
		<img src="/file/img/program/left/left_1.png">
	</div>
	<div class="program_left_block_cnt">
		<ul>
		<?php
			foreach ($programsCommon as $data){
//				$name = $data->ScheduleLeftData->ProgramData->name;
//				$id = $data->ScheduleLeftData->ProgramData->id;
				$name = $data->name;
				$id = $data->id;
				echo "<li><a href=\"/index.php/program/{$id}\">{$name}</a></li>";
			}
		?>
		</ul>
	</div>
</div>


<div class="program_left_block">
	<!-- DJ Free-->
	<div class="program_left_title" id="2">
		<img src="/file/img/program/left/left_2.png">
	</div>
	<div class="program_left_block_cnt">
		<ul>
			<?php
				foreach ($programsDJFree as $data){
					$name = $data->name;
					$id = $data->id;
					echo "<li><a href=\"/index.php/program/{$id}\">{$name}</a></li>";
				}
			?>
		</ul>
	</div>
</div>


<div class="program_left_block">
	<!-- 特別企劃-->
	<div class="program_left_title" id="3">
		<img src="/file/img/program/left/left_3.png">
	</div>
	<div class="program_left_block_cnt">
		<ul>
			<?php
			foreach ($programsEvent as $data){
				$name = $data->name;
				$id = $data->id;
				echo "<li><a href=\"/index.php/program/{$id}\">{$name}</a></li>";
			}
			?>


		</ul>
	</div>
</div>