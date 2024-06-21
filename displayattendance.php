<?php
session_start();
include("db.php");
?>
<html>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
echo "<br><center><a href='attendance.php'>Attendance</a>&nbsp;&nbsp;<a href='displayattendance.php'>Display Attendance</a><br><br></center>";
$rs=mysql_query("select userid,name from userregn where userid not in (select userid from license where issuedstatus='yes')") or die(mysql_error());
echo "<table border='1' align='center'><tr><th>User Id</th><th>Name</th><th>Issues</th><th>Total Days</th><th>Present</th><th>Absent</th></tr>";
$d=date('m',time()+19800);
while($r=mysql_fetch_row($rs)) {
$c=0;$p=0;$a=0;$t=0;
echo "<tr>";
foreach($r as $rr)
echo "<td>$rr</td>";
	$rs1=mysql_query("select attend from attendance where userid='$r[0]' and adate like '%-$d-%' order by adate") or die(mysql_error());
	while($r1=mysql_fetch_row($rs1)) {
	if($r1[0]=="absent") {
	$c++;$a++;
	if($c==6)
	break;
	} else {
	$c=0;$p++;
	}
	$t++;
	}
if($c==6)
echo "<td>User Absent for 6 Days !</td>";
else
echo "<td>No Issue</td>";
echo "<td>$t</td><td>$p</td><td>$a</td>";
echo "</tr>";
}
echo "</table>";
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>