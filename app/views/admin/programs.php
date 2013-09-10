<a href="/index.php/admin/addProgram">加節目</a> <br>

<table>
	<tr>
		<td>代號</td>
		<td>節目名稱</td>
		<td>DJ</td>
		<td>修改</td>
	</tr>
<?php
	for($i=0; $i<count($programsData); $i++){
		echo "<tr>";
		echo "<td>{$programsData[$i]['id']}</td>";
		echo "<td>{$programsData[$i]['name']}</td>";
		echo "<td>{$programsData[$i]['dj']}</td>";
		echo "<td><a href='/index.php/admin/program/{$programsData[$i]['id']}'>點我</a> </td>";

		echo "</tr>";
	}

?>
</table>