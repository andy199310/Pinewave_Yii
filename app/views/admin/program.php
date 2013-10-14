節目名稱：<?=$programData->name?><br>
<a href='/index.php/admin/editProgram/<?=$programData->id?>'>編輯節目資訊</a><br>
<a href='/index.php/admin/uploadBar/<?=$programData->id?>'>上傳橫批</a><br>

<a href="/index.php/admin/addVolume/<?=$id?>">加小集</a><br>
<?php
/**
 * User: Green
 * Date: 2013/9/2
 * Time: 下午 12:48
 */


?>
集數資訊：<br>
<table>
	<tr>
		<td>流水號</td>
		<td>集數</td>
		<td>首播日期</td>
		<td>編輯</td>
	</tr>
	<?php

	if($programVolumeData != NULL){
		for($i=0; $i<count($programVolumeData->volume); $i++){
			echo '<tr>';
			echo "<td>{$programData->volume[$i]['vid']}</td>";
			echo "<td>{$programData->volume[$i]['count']}</td>";
			echo "<td>{$programData->volume[$i]->FirstOnAirTime['datetime']}</td>";
			echo "<td><a href='/index.php/admin/volume/{$programData->volume[$i]['vid']}'>編輯</a></td>";
			echo '</tr>';
		}
	}

	?>
</table>