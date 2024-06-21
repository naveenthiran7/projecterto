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
if(parseInt(f.t5.value)>31) {
alert("Absent Days is Invalid");
return false;
}
if(f.t3.value=="Feb" && parseInt(f.t5.value)>29) {
alert("Month Feb cant exceed 29 days");
return false;
}
return true;
}
function call(p) {
if(p!="") {
if(window.ActiveXObject)
ob=new ActiveXObject("Microsoft.XMLHTTP")
else
ob=new XMLHttpRequest()
ob.onreadystatechange=function() {
if(ob.readyState==4&&ob.status==200) {
f.t2.value=ob.responseText
}
}
ob.open("GET","getemp.php?uid="+p,true)
ob.send()
} else {
f.t2.value=""
}
}
</script>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
$m=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
echo "<br><center><a href='employee.php'>New Employee</a>&nbsp;&nbsp;<a href='empattendance.php'>Employee Attendance</a>&nbsp;&nbsp;<a href='empsalary.php'>Employee Salary</a><br><br><br></center>";
if(!isset($_POST['submit'])) {
$rs=mysql_query("select id from employee order by id");
?>
<form name="f" action="empattendance.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">EMPLOYEE ATTENDANCE</TH>
</tr>
<tr>
<td align="right">Select Employee Id</td>
<td>
<select name="t1" onchange="call(this.value)">
<option value="">--Select--</option>
<?php
while($r=mysql_fetch_row($rs))
echo "<option value=$r[0]>$r[0]</option>";
?>
</select>
</td>
</tr>
<tr>
<td align="right">Employee Name</td>
<td><input type="text" name="t2" readonly></td>
</tr>
<tr>
<td align="right">Month</td>
<td>
<select name="t3">
<option value="">--Select--</option>
<?php
foreach($m as $mm)
echo "<option value=$mm>$mm</option>";
?>
</select>
</td>
</tr>
<tr>
<td align="right">Year</td>
<td>
<select name="t4">
<option value="">--Select--</option>
<?php
for($i=2010; $i<=2020; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
</td>
</tr>
<tr>
<td align="right">Absent</td>
<td><input type="text" name="t5" value="0"></td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="Submit"></td>
</tr>
<tr>
<th colspan="2"><br><br><a href='viewattendance.php'>View Attendance</a></th>
</tr>
</form>
<?php
} else {
	$eid=$_POST['t1'];
	$ename=$_POST['t2'];
	$mth=$_POST['t3'];
	$yr=$_POST['t4'];
	$ab=$_POST['t5'];
$rs=mysql_query("select * from eattend where empid=$eid and month='$mth' and year=$yr") or die(mysql_error());
if(mysql_num_rows($rs)>0) {
echo "<center><b>Attendance for the month $mth is already made for this employee</b></center>";
} else {
switch($mth) {
case "Jan":$d=31;break;
case "Feb":$d=28;break;
case "Mar":$d=31;break;
case "Apr":$d=30;break;
case "May":$d=31;break;
case "Jun":$d=30;break;
case "Jul":$d=31;break;
case "Aug":$d=31;break;
case "Sep":$d=30;break;
case "Oct":$d=31;break;
case "Nov":$d=30;break;
case "Dec":$d=31;break;
}
	$pre=$d-$ab;
mysql_query("insert into eattend (empid,ename,month,year,absent,present) values ($eid,'$ename','$mth',$yr,$ab,$pre)") or die(mysql_error());
echo "<center><b>Attendance Registered !</b></center>";
}
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>