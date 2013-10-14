<?php
/**
 * User: Green
 * Date: 2013/10/10
 * Time: 下午 4:13
 */

echo "<h1>尚未填寫版權清單的節目：</h1>";

?>
<table>
	<tr>
		<td>節目名稱</td>
		<td>DJ</td>
		<td>首播日期</td>
		<td>點我編輯</td>
	</tr>
	<?php
		foreach($data as $smallData){
			if($smallData['CopyRightCount'] <= 0 && !($smallData['vid'] > 5 && $smallData['vid'] < 68)){
				echo "<tr>";
				echo "<td>".$smallData['name']."</td>";
				echo "<td>".$smallData['dj']."</td>";
				echo "<td>".$smallData['datetime']."</td>";
				echo "<td>"."<a href='/admin/volume/".$smallData['vid']."'>點我編輯</a>"."</td>";
				echo "</tr>";
			}

		}
	?>
</table>