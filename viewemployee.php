<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value=="") {
alert("Field is Empty");
return false;
}
if(f.t4.value.length!=10) {
alert("Mobile No should be 10 digits");
return false;
}
return true;
}
</script>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
echo "<br><center><a href='employee.php'>New Employee</a>&nbsp;&nbsp;<a href='empattendance.php'>Employee Attendance</a>&nbsp;&nbsp;<a href='empsalary.php'>Employee Salary</a><br><br><br></center>";
$rs=mysql_query("select * from employee") or die(mysql_error());
echo "<table border='1' align='center'><tr><th colspan='7'>EMPLOYEE REPORT</th></tr><tr><th>Id</th><th>Name</th><th>Gender</th><th>Address</th><th>City</th><th>Mobile</th><th>Hiredate</th></tr>";
while($r=mysql_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr)
echo "<td>$rr</td>";
echo "</tr>";
}
echo "</table>";
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>