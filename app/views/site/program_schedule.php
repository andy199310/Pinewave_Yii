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

function schedule($y,$m)
{
	if(!($y%400)||$y%100&&!($y%4))
		$lastDay = array(0,31,29,31,30,31,30,31,31,30,31,30,31);
	else
		$lastDay = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	$firstDay = date("l",mktime(0,0,0,$m,1,$y));
	$countDay = 1;
	$start = 0;
	$tmp = "<div class=\"h2\" id=\"schedule_month\" y=\"{$y}\" m=\"{$m}\"><span class=\"date\" id=\"schedule_date\">{$m}</span>月</div>";
	$tmp .= '<div id="previous_month">上個月</div><div id="next_month">下個月</div>';
	$tmp .= "<br>每日節目首播時間為23:00~24:00<br>每日22:00~23:00重播上周同日節目，24:00~1:00重播該日節目<br><br>";
	$tmp .= "<table id=\"schedule\" cellspacing=\"5\" cellpadding=\"0\">";
	$tmp .= "<tr class=\"head\"><td><span class=\"h1\">MON</span><br>星期一</td><td><span class=\"h1\">TUE</span><br>星期二</td><td><span class=\"h1\">WED</span><br>星期三</td><td><span class=\"h1\">THU</span><br>星期四</td><td><span class=\"h1\">FRI</span><br>星期五</td><td><span class=\"h1\">SUN</span><br>星期日</td></tr>";
	for($i = 0;$i < 6;$i++)
	{
		if(!$start && $i == 5)
			break;
		$tmp .= "<tr>";
		for($j = 0;$j < 7;$j++)
		{
			if(!$i && !$start)
			{
				if($j==0&&$firstDay=="Monday")
					$start = 1;
				else if($j==1&&$firstDay=="Tuesday")
					$start = 1;
				else if($j==2&&$firstDay=="Wednesday")
					$start = 1;
				else if($j==3&&$firstDay=="Thursday")
					$start = 1;
				else if($j==4&&$firstDay=="Friday")
				{
					$start = 1;
					//			$countDay++;
					//			continue;
				}
				//		else if($j==4)
				//			continue;
				else if($j==5&&$firstDay=="Saturday")
				{
					$start = 1;
					$countDay++;
					continue;
				}
				else if($j==5)
					continue;
				else if($j==6&&$firstDay=="Sunday")
					$start = 1;
			}
			else if( /*$j == 4 ||*/ $j == 5)
			{
				$countDay++;
				continue;
			}
			else if($countDay > $lastDay[$m])
				$start = 0;

			if($start)
			{
				$displayDay = $countDay;
				$datetime = sprintf('%04d-%02d-%02d%%', $y, $m, $countDay);
				$schedule_as = mysql_fetch_array(mysql_query("select * from `schedule` where `datetime` LIKE '{$datetime}%' AND `first` = '1';"));
				if($schedule_as)
				{
					if($schedule_as['program'])
					{
						$program_as = mysql_fetch_array(mysql_query("select * from `program` where `id` = '{$schedule_as['program']}';"));
						// Special
						if($y == 2011 && $m == 12 && $countDay == 26)
							$tmp .= "<td class=\"aru\"><div class=\"date\">{$displayDay}</div><div class=\"p1\"><a href=\"?view=46\">曙光。早饗月</a><div style=\"height:10px;\"></div><a href=\"?view=49\">那些失眠的日子</a></div>";
						else if($program_as)
							$tmp .= "<td class=\"aru\"><div class=\"date\">{$displayDay}</div><div class=\"p1\"><a href=\"/index.php/program/{$program_as['id']}\">{$program_as['name']}</a></div>";
						else
							$tmp .= "<td class=\"aru\"><div class=\"date\">{$displayDay}</div><div class=\"p1\"><a href=\"#\">program id error</a></div>";
					}
					else
					{
						if($schedule_as['url'])
							$tmp .= "<td class=\"aru\"><div class=\"date\">{$displayDay}</div><div class=\"p1\"><a href=\"{$schedule_as['url']}\">{$schedule_as['name']}</a></div></td>";
						else
							$tmp .= "<td class=\"aru\"><div class=\"date\">{$displayDay}</div><div class=\"p1\"><a href=\"#\">{$schedule_as['name']}</a></div></td>";
					}
				}
				else
					$tmp .= "<td><div class=\"date\">{$displayDay}</div><div class=\"p1\">&nbsp;</div></td>";
				$countDay++;
			}
			else
			{
				$tmp .= "<td>&nbsp;</td>";
			}
		}
		$tmp .= "</tr>";
	}
	$tmp .= "</table>";
	return $tmp;
}
?>



<div id="program_cnt">
	<div id="program_cnt_left">
		<?=$programLeft?>
	</div>
	<div id="program_cnt_right">
	<?php
		$schedule = date("Y-m");
		$schedule = preg_split("/-/",$schedule);
		echo schedule((int)$schedule[0],(int)$schedule[1]);
	?>
	</div>
</div>