<?php
/**
 * User: Green
 * Date: 2013/8/7
 * Time: 下午 6:14
 */


$cs = Yii::app()->clientScript;
$cs->registerCSSFile(Yii::app()->request->baseUrl.'/css/board.css');

$cs->registerScriptFile(Yii::app()->request->baseUrl.'/app/js/board.js');

$pdo_dsn = "mysql:localhost;dbname=radio";
$pdo_user = "radio";
$pdo_password = "radio57261";

$DB = new PDO($pdo_dsn, $pdo_user, $pdo_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

function deText($text)
{
//	$text = preg_replace("(<)","",$text);
//	$text = preg_replace("(>)","",$text);
//	$text = preg_replace("( )","&nbsp;",$text);
//	$text = nl2br($text);
//	$text = preg_replace("/<br \/>/","<br>",$text);
	return $text;
}
function board($DB, $display, $page)
{
	$mysql_host = "127.0.0.1"; //資料庫位址
	$mysql_user = "radio"; //帳號名稱
	$mysql_password = "radio57261"; //密碼
	$mysql_database = "radio"; //資料庫名稱
	if(mysql_connect($mysql_host, $mysql_user, $mysql_password))
	{
		mysql_select_db($mysql_database);
		mysql_query("SET NAMES UTF8");
	}
	// MySQL QUERY

	$board_query = "select * from `radio`.`board` where `fid` = 0 order by `id` desc limit :Page , :Display";
	$respond_query = "select * from `radio`.`board` where `fid` = :ID order by `id`";

	/*--------------------*/

	$tmp = "";
	$tmpP = ($page-1)*$display;

	$board_rs = $DB->prepare($board_query);
	$board_rs->bindParam(':Page', $tmpP, PDO::PARAM_INT);
	$board_rs->bindParam(':Display', $display, PDO::PARAM_INT);
	$board_rs->execute();
	$board_as = $board_rs->fetchAll();

	foreach($board_as as $as_value)
	{
		$time = preg_replace("/[0-9]{4}-([0-9]{2})-([0-9]{2})/","\\1/\\2",$as_value['time']);
		$tmp .= "<div class=\"board\"><div class=\"title\"><div class=\"respondButton\" onclick=\"respond({$as_value['id']});\">回覆留言</div>";
		$tmp .= "<div class=\"author\">留言者：{$as_value['author']} ({$time})</div></div><div class=\"content\">{$as_value['content']}</div>";

		$respond_rs = $DB->prepare($respond_query);
		$respond_rs->bindParam(':ID', $as_value['id'], PDO::PARAM_INT);
		$respond_rs->execute();
		$respond_as = $respond_rs->fetchAll();
		foreach($respond_as as $as_value)
		{
			$time = preg_replace("/[0-9]{4}-([0-9]{2})-([0-9]{2})/","\\1/\\2",$as_value['time']);
			$tmp .= "<div class=\"respond\"><div class=\"title\"><div class=\"author\">回覆者：{$as_value['author']} ({$time})</div></div><div class=\"content\">{$as_value['content']}</div></div>";
		}
		$tmp .= "<form method=\"post\"><div class=\"respond active\" id=\"ra{$as_value['id']}\"><div class=\"title\"><div class=\"author\">回覆者：<input type=\"text\" name=\"author\"><br>驗證碼：<img src=\"/code.php\"> <input type=\"text\" name=\"code\"></div></div><div  class=\"content\"><textarea name=\"content\"></textarea></div><input type=\"hidden\" name=\"fid\" value=\"{$as_value['id']}\"><input type=\"submit\" name=\"respond\" value=\"送出\"></div></form></div>";
	}
	$tmpP = ($page-1) * $display;
	$board_re = mysql_query("select * from `board` where `board`.`fid` = '0';");
	$total = mysql_num_rows($board_re);
	if($total > $display)
	{
		$maxPage = ceil($total/$display);
		$tmp .=  "<ul class=\"pagination\">";
		if($page == 1)
		{
			$tmp .=  "<li class=\"disabled\">|<</li>";
			$tmp .=  "<li class=\"disabled\"><<</li>";
		}
		else
		{
			$tmpP = $page-1;
			$tmp .=  "<li><a href=\"/index.php/board/1\">|<</a></li>";
			$tmp .=  "<li><a href=\"/index.php/board/{$tmpP}\"><<</a></li>";
		}
		if($maxPage > 10)
		{
			if($page < 5)
			{
				$strPage = 1;
				$endPage = 10;
			}
			elseif($page+5 > $maxPage)
			{
				$strPage = $maxPage - 9;
				$endPage = $maxPage;
			}
			else
			{
				$strPage = $page-4;
				$endPage = $page+5;
			}
		}
		else
		{
			$strPage = 1;
			$endPage = $maxPage;
		}
		for($i = $strPage;$i <= $endPage;$i++)
		{
			if($i == $page)
				$tmp .=  "<li class=\"current\">{$i}</li>";
			else
				$tmp .=  "<li><a href=\"/index.php/board/{$i}\">{$i}</a></li>";
		}
		$tmp .=  "<li class=\"total\">{$page}/{$maxPage}</li>";
		if($page == $maxPage)
		{
			$tmp .=  "<li class=\"disabled\">>></li>";
			$tmp .=  "<li class=\"disabled\">>|</li>";
		}
		else
		{
			$tmpP = $page+1;
			$tmp .=  "<li><a href=\"/index.php/board/{$tmpP}\">>></a></li>";
			$tmp .=  "<li><a href=\"/index.php/board/{$maxPage}\">>|</a></li>";
		}
		$tmp .=  "</ul>";
	}
	return $tmp;
}

if(isset($_POST['post']) || isset($_POST['respond']))
{
	session_start();
	$mysql_host = "127.0.0.1"; //資料庫位址
	$mysql_user = "radio"; //帳號名稱
	$mysql_password = "radio57261"; //密碼
	$mysql_database = "radio6"; //資料庫名稱
	if(mysql_connect($mysql_host, $mysql_user, $mysql_password))
	{
		mysql_select_db($mysql_database);
		mysql_query("SET NAMES UTF8");
	}
	$error = false;
	if($_POST['author']==""){
		$error = true;}
	else if($_POST['content']==""){
		$error = true;}
	else if(!isset($_SESSION['code']) || $_POST['code']!=$_SESSION['code']){
		$error = true;}
	else if(isset($_POST['respond']))
	{
		if($_POST['fid']==""){
			$error = true;}
		else
		{
			$fid = deText($_POST['fid']);
			if(!mysql_query("select * from `board` where `id` = '{$fid}';"))
				$error = true;
		}
	}
	$author = deText($_POST['author']);
	$content = deText($_POST['content']);
	if(!$error)//!$error
	{
		$post_query = "insert into `radio6`.`board`(`id`,`fid`,`author`,`time`,`ip`,`code`,`content`) values(NULL,0, :Author ,now(), :Server , :Code , :Content );";
		$respond_query = "insert into `radio6`.`board`(`id`,`fid`,`author`,`time`,`ip`,`code`,`content`) values(NULL, :FID , :Author ,now(), :Server , :Code , :Content );";
		if(isset($_POST['post']))
		{
			$post_dht = $DB->prepare($post_query);
			$post_dht->bindParam(':Author', $author, PDO::PARAM_INT);
			$post_dht->bindParam(':Server', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR, 16);
			$post_dht->bindParam(':Code', $_SESSION['code'], PDO::PARAM_STR, 5);
			$post_dht->bindParam(':Content', $content);
			$post_dht->execute();
		}
		else if(isset($_POST['respond']))
		{
			$post_dht = $DB->prepare($respond_query);
			$post_dht->bindParam(':FID', $fid, PDO::PARAM_INT);
			$post_dht->bindParam(':Author', $author, PDO::PARAM_INT);
			$post_dht->bindParam(':Server', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR, 16);
			$post_dht->bindParam(':Code', $_SESSION['code'], PDO::PARAM_STR, 5);
			$post_dht->bindParam(':Content', $content);
			$post_dht->execute();
		}
	}
}
?>
<div id="board_main">
	<div style="clear:both;"></div>
	<div id="postButton" onclick="post();">發表留言</div>
	<div id="post">
		<div class="boardTop"></div>
		<div class="board">
			<form method="post">
				<div class="title"><div class="author">留言者：<input type="text" name="author"> 驗證碼：<img src="/code.php"> <input type="text" name="code"></div></div>
				<div class="content"><textarea name="content"></textarea></div>
				<input type="submit" name="post" value="送出">
			</form>
		</div>
		<div class="boardBottom"></div>
	</div>
	<?php
	if(isset($_POST['post']) || isset($_POST['respond']))
	{
		if(!$error)
			echo "<script>alert('發表成功!');</script>";
		else
			echo "<script>alert('發表失敗!');</script>";
	}
	echo board($DB, $display, $page);
	?>





</div>



</div>