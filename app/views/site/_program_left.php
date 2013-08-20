<?php
/**
 * User: Green
 * Date: 2013/8/12
 * Time: 下午 4:58
 */

$cs = Yii::app()->clientScript;
$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/program_left.css');


$mysql_host = "127.0.0.1"; //資料庫位址
$mysql_user = "radio"; //帳號名稱
$mysql_password = "radio57261"; //密碼
$mysql_database = "radio6"; //資料庫名稱
if(mysql_connect($mysql_host, $mysql_user, $mysql_password))
{
	mysql_select_db($mysql_database);
	mysql_query("SET NAMES UTF8");
}

?>

<div class="program_left_block">
	<!-- 常態節目-->
	<div class="program_left_title" id="1">
		<img src="/file/img/program/left/left_1.png">
	</div>
	<div class="program_left_block_cnt">
		<ul>
		<?php
		$levelc = 4;
		$programClass_re = mysql_query("select * from `programClass` where `level` = '{$levelc}' order by `id` desc;");
		while($programClass_as = mysql_fetch_array($programClass_re))
		{
			$program_re = mysql_query("select * from `program` where `class` = {$programClass_as['id']};");
			while($program_as = mysql_fetch_array($program_re))
				echo "<li><a href=\"/index.php/program/{$program_as['id']}\">{$program_as['name']}</a></li>";
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
			$levelc = 5;
			$programClass_re = mysql_query("select * from `programClass` where `level` = '{$levelc}' order by `id` desc;");
			while($programClass_as = mysql_fetch_array($programClass_re))
			{
				$program_re = mysql_query("select * from `program` where `class` = {$programClass_as['id']};");
				while($program_as = mysql_fetch_array($program_re))
					echo "<li><a href=\"/index.php/program/{$program_as['id']}\">{$program_as['name']}</a></li>";
			}
			?>
		</ul>
	</div>
</div>


<div class="program_left_block">
	<!-- 常態節目-->
	<div class="program_left_title" id="3">
		<img src="/file/img/program/left/left_3.png">
	</div>
	<div class="program_left_block_cnt">
		<ul>
			<?php
			$levelc = 6;
			$programClass_re = mysql_query("select * from `programClass` where `level` = '{$levelc}' order by `id` desc;");
			while($programClass_as = mysql_fetch_array($programClass_re))
			{
				$program_re = mysql_query("select * from `program` where `class` = {$programClass_as['id']};");
				while($program_as = mysql_fetch_array($program_re))
					echo "<li><a href=\"/index.php/program/{$program_as['id']}\">{$program_as['name']}</a></li>";
			}
			?>
		</ul>
	</div>
</div>