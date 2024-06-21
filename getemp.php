<?php
include("db.php");
	$id=$_GET['uid'];
$rs=mysql_query("select name from employee where id=$id") or die(mysql_error());
$r=mysql_fetch_row($rs);
echo $r[0];
?>