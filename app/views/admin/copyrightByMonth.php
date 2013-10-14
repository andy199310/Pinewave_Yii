目前查詢： <?=$year?> 年 <?=$month?>月份 版權清單<br>

<table>
	<tr>
		<td>歌曲名稱</td>
		<td>演唱者</td>
		<td>作詞</td>
		<td>作曲</td>
		<td>編曲</td>
		<td>發行公司</td>
		<td>播放日數</td>
		<td>播放次數</td>
	</tr>

	<?php
		foreach($copyrightData as $smallData){
			echo "<tr>";

			echo '<td>'.$smallData->name.'</td>';
			echo '<td>'.$smallData->singer.'</td>';
			echo '<td>'.$smallData->lyricist.'</td>';
			echo '<td>'.$smallData->composer.'</td>';
			echo '<td>'.$smallData->arranger.'</td>';
			echo '<td>'.$smallData->company.'</td>';

			$date = preg_replace("/([0-9]{4})-([0-9]{2})-([0-9]{2}) (.+)/","\\1/\\2/\\3",$smallData->VolumeDataWithMonth->FirstOnAirTime->datetime);

			echo '<td>'.$date.'</td>';

			echo '<td>'.$smallData->playCount.'</td>';

			echo "</tr>";
		}
	?>
</table>


<a href="/admin/copyrightDownload/<?=$year?>/<?=$month?>">點我下載</a>


<?php
/**
 * User: Green
 * Date: 2013/10/2
 * Time: 上午 2:26
 */