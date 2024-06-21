<?php
include("db.php");
	$licno=$_GET['lid'];
$rs=mysql_query("select l.userid,name,l.lictype from license l,userregn u where l.userid=u.userid and licno='$licno'") or die(mysql_error());
$r=mysql_fetch_row($rs);
switch($r[2]) {
case 'two_without_gear': $str="Two Wheeler Without Gear";break;
case 'two_with_gear': $str="Two Wheeler With Gear";break;
case 'four_lmvg': $str="Four Wheeler LMVG";break;
case 'four_hmvg': $str="Four Wheeler HMVG";break;
}
echo $r[0]."*".$r[1]."#".$str;
?>