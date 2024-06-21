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
if(!isset($_POST['submit'])) {
$rs=mysql_query("select userid,name from userregn where userid not in (select userid from license where issuedstatus='yes')") or die(mysql_error());
echo "<form action='attendance.php' method='post'><table border='1' align='center' width='40%'><tr><th colspan='4'>Attendance for the Day : <input type='text' name='day' value='".date('Y-m-d',time()+19800)."' readonly style='border:0;background:#caefc0' size='7'></th></tr><tr><th>User Id</th><th>UserName</th><th>Present</th><th>Absent</th></tr>";
while($r=mysql_fetch_row($rs)) {
echo "<tr>";
echo "<td>$r[0]</td><td><input type='hidden' name='n[]' value='$r[1]'>$r[1]</td>";
echo "<td><input type='hidden' name='h[]' value='$r[0]'><input type='radio' name='$r[0]' value='present' checked>P</td><td><input type='radio' name='$r[0]' value='absent'>A</td>";
echo "</tr>";
}
echo "<tr><th colspan='4'><input type='submit' name='submit' value='GO'></tr></table></form>";
} else {
$h=$_POST['h'];
$n=$_POST['n'];
$ad=$_POST['day'];
	for($i=0; $i<sizeof($h); $i++) {
	$at=$_POST[$h[$i]];
	mysql_query("insert into attendance (userid,name,adate,attend) values ('$h[$i]','$n[$i]','$ad','$at')") or die("<center>Attendance Already Regisered for this Date<br><a href='attendance.php'>Back</a></center>");
	}
echo "<center>Attendance registered for $ad<br><a href='attendance.php'>Back</a></center>";
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>
//kkknkkk