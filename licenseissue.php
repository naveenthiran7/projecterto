<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
return window.confirm("Are you sure to Deliver the License !")
}
</script>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
include("menu.php");
$rs=mysql_query("select * from license where issuedstatus='no' and userid in (select userid from payment where totamt-paidamt<=0)") or die(mysql_error());
if(mysql_num_rows($rs)>0) {
echo "<table border='1' align='center'><tr><th colspan='9'>License Issue</th></tr><tr><th>Id</th><th>LLR No</th><th>User Id</th><th>License Type</th><th>License No</th><th>Issued On</th><th>Expiry On</th><th>Delivered</th><th>Task</th></tr>";
while($r=mysql_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr)
echo "<td>$rr</td>";
echo "<td><a href='licenseissue.php?id=$r[0]' onclick='return check()'>Issue</a></td>";
echo "</tr>";
}
echo "</table>";
if(isset($_REQUEST['id'])) {
	mysql_query("update license set issuedstatus='yes' where licid=$_REQUEST[id]") or die(mysql_error());
	header('Location:licenseissue.php');
}
} else {
echo "<h3 align='center'>There are No Paid Users to Issue the License</h3>";
}
?>
</body>
</html>