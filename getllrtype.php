<?php
include("db.php");
	$userid=$_GET['uid'];
$rs=mysql_query("select lictype from userregn where userid='$userid'") or die(mysql_error());
$r=mysql_fetch_row($rs);
switch($r[0]) {
case 'two_without_gear': $str="Two Wheeler Without Gear";break;
case 'two_with_gear': $str="Two Wheeler With Gear";break;
case 'four_lmvg': $str="Four Wheeler LMVG";break;
case 'four_hmvg': $str="Four Wheeler HMVG";break;
}
echo $str;
?>