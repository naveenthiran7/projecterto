<?php
include("db.php");
	$llrno=$_GET['id'];
$rs=mysql_query("select userid,llrtype from llr where llrno='$llrno'") or die(mysql_error());
$r=mysql_fetch_row($rs);
switch($r[1]) {
case 'two_without_gear': $str="Two Wheeler Without Gear";break;
case 'two_with_gear': $str="Two Wheeler With Gear";break;
case 'four_lmvg': $str="Four Wheeler LMVG";break;
case 'four_hmvg': $str="Four Wheeler HMVG";break;
}
echo $r[0]."*".$str;
?>