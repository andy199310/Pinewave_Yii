<?php
/**
 * User: Green
 * Date: 2013/8/13
 * Time: 上午 2:15
 */
	$cs = Yii::app()->clientScript;
	$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/program_schedule.css');
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/player.js');
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/schedule.js');


	$schedule = date("Y-m");
	$schedule = preg_split("/-/",$schedule);
	$y = (int)$schedule[0];
	$m = (int)$schedule[1];
	$index = 0;

?>

<div id="program_cnt">
	<div id="program_cnt_left">
		<?=$programLeft?>
	</div>
	<div id="program_cnt_right">

		<div id="schedule_outer">
			<div class="h2" id="schedule_month" y="<?=$y?>" m="<?=$m?>">
				<span class="date" id="schedule_date"><?=$m?></span>月
			</div>
			<div id="previous_month" class="month_choose">上個月</div>
			<div id="next_month" class="month_choose">下個月</div>
			<br>每日節目首播時間為22:00~23:00<br>每日21:00~22:00重播上周同日節目，23:00~24:00重播該日節目<br><br>

			<?php
				if(!($y%400)||$y%100&&!($y%4))
					$lastDay = array(0,31,29,31,30,31,30,31,31,30,31,30,31);
				else
					$lastDay = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
				$firstDay = date("l",mktime(0,0,0,$m,1,$y));
				$countDay = 1;
				$start = 0;
			?>

			<table id="schedule" cellspacing="5" cellpadding="0">
				<tr class="head">
					<td><span class="h1">MON</span><br>星期一</td>
					<td><span class="h1">TUE</span><br>星期二</td>
					<td><span class="h1">WED</span><br>星期三</td>
					<td><span class="h1">THU</span><br>星期四</td>
					<td><span class="h1">FRI</span><br>星期五</td>
					<td><span class="h1">SUN</span><br>星期日</td>
				</tr>

				<?php
					for($i = 0;$i < 6;$i++){
						//IDK
						if($start == 0 && $i == 5)
							break;
						echo "<tr>";
						for($j = 0;$j < 7;$j++){
							if($i == 0 && $start == 0){
								if($j == 0 && $firstDay == "Monday")
									$start = 1;
								else if($j == 1 && $firstDay == "Tuesday")
									$start = 1;
								else if($j==2&&$firstDay=="Wednesday")
									$start = 1;
								else if($j==3&&$firstDay=="Thursday")
									$start = 1;
								else if($j==4&&$firstDay=="Friday")
									$start = 1;
								else if($j==5&&$firstDay=="Saturday"){
									$start = 1;
									$countDay++;
									continue;
								}else if($j==5)
									continue;
								else if($j==6&&$firstDay=="Sunday")
									$start = 1;
							}else if($j == 5){
								$countDay++;
								continue;
							}else if($countDay > $lastDay[$m])
								$start = 0;


							//echo $index;
							//Start putting(?)
							if($start == 1){
								$displayDay = $countDay;
								if($index < count($monthData)){
									//TODO inner
									$datetime = sprintf('%04d-%02d-%02d', $y, $m, $countDay);
									$thisIndexTime = substr($monthData[$index]->datetime, 0, 10);
									if(strtotime($thisIndexTime) == strtotime($datetime)){
										echo "<td class=\"aru\"><div class=\"date\">{$displayDay}</div>";
										while(strtotime($thisIndexTime) <= strtotime($datetime)){
											$pid = $monthData[$index]->data->ProgramData->id;
											$name = $monthData[$index]->data->ProgramData->name;
											echo "<div class=\"p1\"><a href=\"/index.php/program/{$pid}\">{$name}</a></div>";
											$index++;
											if($index < count($monthData)){
												$thisIndexTime = substr($monthData[$index]->datetime, 0, 10);
											}else{
												break;
											}
										}
										echo "</td>";
									}else{
										echo "<td><div class=\"date\">{$displayDay}</div><div class=\"p1\">&nbsp;</div></td>";
									}

								}else{
									echo "<td><div class=\"date\">{$displayDay}</div><div class=\"p1\">&nbsp;</div></td>";
								}
								$countDay++;

							}else{
								echo "<td>&nbsp;</td>";
							}

						}

						echo "</tr>";

					}
				?>

			</table>

		</div>

	</div>
</div>