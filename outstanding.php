<?php
session_start();
include("db.php");
?>
<html>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
$rs=mysql_query("select p.userid,name,lictype,totamt,paidamt,totamt-paidamt from payment p,userregn u where p.userid=u.userid and totamt-paidamt>0") or die(mysql_error());
?>
<table border="1" align="center">
<tr><th colspan="6">OUTSTANDING REPORT</th></tr><tr><th>User Id</th><th>Name</th><th>License Type</th><th>Total Amt</th><th>Paid Amt</th><th>Balance Amt</th></tr>
<?php
while($r=mysql_fetch_row($rs)) {
echo "<tr>";
echo "<td>$r[0]</td>";
echo "<td>$r[1]</td>";
switch($r[2]) {
case 'two_without_gear': $str="Two Wheeler Without Gear";break;
case 'two_with_gear': $str="Two Wheeler With Gear";break;
case 'four_lmvg': $str="Four Wheeler LMVG";break;
case 'four_hmvg': $str="Four Wheeler HMVG";break;
}
echo "<td>$str</td>";
echo "<td align='right'>$r[3]</td>";
echo "<td align='right'>$r[4]</td>";
echo "<td align='right'>$r[5]</td>";
echo "</tr>";
}
?>
</table>
<?php
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>