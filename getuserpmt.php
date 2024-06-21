<?php
include("db.php");
	$userid=$_GET['id'];
$rs=mysql_query("select name,l.lictype,totamt,paidamt from payment p,userregn u,license l where p.userid=u.userid and p.userid=l.userid and p.userid='$userid'") or die(mysql_error());
$r=mysql_fetch_row($rs);
echo $r[0]."*".$r[1]."@".$r[2]."&".$r[3]."~".($r[2]-$r[3]);
?>