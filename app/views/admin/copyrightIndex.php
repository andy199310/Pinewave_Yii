<a href="/admin/copyrightOver">顯示尚未填寫的節目(已播出的)</a><br><br>
依年份月度顯示清單：
<form action="/admin/copyrightByMonth" method="POST">
	年分：
	<select name="year">
		<option value="2013">2013</option>
		<option value="2014">2014</option>
	</select>

	月分：
	<select name="month">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
	</select>

	<input type="submit" value="查詢">
</form>

<?php
/**
 * User: Green
 * Date: 2013/10/2
 * Time: 上午 1:55
 */