現正編輯：<?=$volumeData->ProgramData->name?> <?=$volumeData->FirstOnAirTime->datetime?> 版權清單 <br>

<a href="/admin/addCopyright/<?=$vid?>">加新歌</a><br>
<br>
<table>
	<tr>
		<td>歌曲名稱</td>
		<td>演唱者</td>
		<td>作詞</td>
		<td>作曲</td>
		<td>編曲</td>
		<td>發行公司</td>
		<td>播放次數</td>
		<td>編輯</td>
	</tr>
	<?php
		foreach($copyrightData as $smallData){
			echo '<tr>';

			echo '<td>'.$smallData->name.'</td>';
			echo '<td>'.$smallData->singer.'</td>';
			echo '<td>'.$smallData->lyricist.'</td>';
			echo '<td>'.$smallData->composer.'</td>';
			echo '<td>'.$smallData->arranger.'</td>';
			echo '<td>'.$smallData->company.'</td>';
			echo '<td>'.$smallData->playCount.'</td>';

			echo '<td><a href="/admin/editCopyright/'.$smallData->cid.'">編輯</a></td>';

			echo '</tr>';
		}

	?>

</table>



