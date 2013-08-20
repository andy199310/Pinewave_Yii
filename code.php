<?php
session_start();
$pass = "";
for($i = 0;$i < 5;$i++)
   $pass.= rand(0,9);
$_SESSION['code'] = $pass;
header("content-type: image/png");
$image = imagecreate(52,22);
$black = imagecolorallocate($image,0,0,0);
$color = imagecolorallocate($image,rand(100,255),rand(100,255),rand(100,255));
imagestring($image,5,4,3,$pass,$color);
imagerectangle($image,0,0,51,21,$color);
for($i = 0;$i < 50;$i++)
{
   $point1 = rand(0,50);
   $point2 = rand(0,20);
   imageline($image,$point1,$point2,$point1,$point2,$color);
}
for($i = 0;$i < 3;$i++)
{
   $point1 = rand(0,50);
   $point2 = rand(0,20);
   $point3 = rand(0,50);
   $point4 = rand(0,20);
   imageline($image,$point1,$point2,$point3,$point4,$color);
}
imagepng($image);
?>