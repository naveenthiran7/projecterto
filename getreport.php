<?php
include("db.php");
	$lictype=$_GET['id'];
$rs=mysql_query("select llrno,userid,lictype,licno,issuedon,expiryon,issuedstatus from license where lictype='$lictype'") or die(mysql_error());
if(mysql_num_rows($rs)>0) {
echo "<br><br><table border='1' align='center'><tr><th>LLR No</th><th>User Id</th><th>License Type</th><th>License No</th><th>Issued On</th><th>Expiry On</th><th>Delivered</th></tr>";
while($r=mysql_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr)
echo "<td>$rr</td>";
echo "</tr>";
}
echo "</table>";
} else {
echo "<h3 align='center'>Sorry! No License Holders Available in this Category !</h3>";
}
?>