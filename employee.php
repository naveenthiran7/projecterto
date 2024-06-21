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
if(!isset($_POST['submit'])) {
?>
<form name="f" action="employee.php" method="post" onsubmit="return check()">
<table align="center">
<tr><th colspan="2">NEW EMPLOYEE</th></tr>
<!--tr>
<td align="right">Employee Id</td>
<td><input type="text" name="t1" value="" readonly></td>
</tr-->
<tr>
<td align="right">Employee Name</td>
<td><input type="text" name="t1"></td>
</tr>
<tr>
<td align="right">Gender</td>
<td><input type="radio" name="g" value="male" checked="checked">Male &nbsp; <input type="radio" name="g" value="female">Female</td>
</tr>
<tr>
<td align="right">Address</td>
<td><textarea name="t2"></textarea></td>
</tr>
<tr>
<td align="right">City</td>
<td><input type="text" name="t3"></td>
</tr>
<tr>
<td align="right">Mobile</td>
<td><input type="text" name="t4" maxlength="10"></td>
</tr>
<tr>
<td align="right">Date of Join</td>
<td><input type="text" name="t5"></td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="Insert"></td>
</tr>
<tr>
<th colspan="2"><br><br><a href='viewemployee.php'>View Employee</a></th>
</tr>
</form>

<?php
} else {
	$name=$_POST['t1'];
	$g=$_POST['g'];
	$addr=$_POST['t2'];
	$city=$_POST['t3'];
	$mobile=$_POST['t4'];
	$doj=$_POST['t5'];
mysql_query("insert into employee (name,gender,addr,city,mobile,doj) values ('$name','$g','$addr','$city','$mobile','$doj')") or die(mysql_error());
header('Location:employee.php');
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>