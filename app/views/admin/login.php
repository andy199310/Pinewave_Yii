<div id="login_main" style="margin: 30px auto; text-align: center">
	<div id="errorMsg" style="color: red; background-color: rgba(255,255,255,0.8); border-radius: 5px; font-size: 1.5em;display: inline-block;">
	<?php
		echo $errorMsg;
	?>
	</div>
	<h1>松濤電台管理系統</h1>
	<form method="post">
		帳號：<input type="text" name="user"/><br>
		密碼：<input type="password" name="pass"/><br>
		<input type="submit" value="登入"/>
	</form>
</div>