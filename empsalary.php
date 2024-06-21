<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value=="") {
alert("Field is Empty");
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
ob.open("GET","getempname.php?uid="+p,true)
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
echo "<br><center><a href='employee.php'>New Employee</a>&nbsp;&nbsp;<a href='empattendance.php'>Employee Attendance</a>&nbsp;&nbsp;<a href='empsalary.php'>Employee Salary</a><br><br><br></center>";
if(!isset($_POST['submit'])&&!isset($_POST['submit1'])) {
$rs=mysql_query("select id from eattend where id not in (select aid from salary)") or die(mysql_error());
?>
<form name="f" action="empsalary.php" method="post" onsubmit="return check()">
<table align="center">
<tr><th colspan="2">SALARY</th></tr>
<tr>
<td align="right">Select Attendance Id</td>
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
<td align="right">Name</td>
<td><input type="text" name="t2" readonly></td>
</tr>
<tr>
<td align="right">Basic Pay/Day</td>
<td><input type="text" name="t3"></td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="Submit"></td>
</tr>
<tr>
<th colspan="2"><br><br><a href='viewsalary.php'>View Salary</a></th>
</tr>
</table>
</form>
<?php
} else if(isset($_POST['submit'])&&!isset($_POST['submit1'])) {
	$aid=$_POST['t1'];
	$basic=$_POST['t3'];
$rs=mysql_query("select * from eattend where id=$aid") or die(mysql_error());
$r=mysql_fetch_row($rs);
	$empid=$r[1];
	$ename=$r[2];
	$mth=$r[3];
	$yr=$r[4];
	$ab=$r[5];
	$pre=$r[6];
	$basic=$basic*$pre;
	$da=$basic*.35;
	$hra=$basic*.25;
	$pf=$basic*.04;
	$esi=$basic*.02;
?>
<form name="f1" action="empsalary.php" method="post">
<table align="center">
<tr>
<td align="right">Attendance Id</td>
<td><input type="text" name="t1" value="<?php echo $aid;?>" readonly size="5"></td>
</tr>
<tr>
<td align="right">Emp Id</td>
<td><input type="text" name="t2" value="<?php echo $empid;?>" readonly></td>
</tr>
<tr>
<td align="right">Name</td>
<td><input type="text" name="t3" value="<?php echo $ename;?>" readonly></td>
</tr>
<tr>
<td align="right">Month</td>
<td><input type="text" name="t4" value="<?php echo $mth;?>" readonly></td>
</tr>
<tr>
<td align="right">Year</td>
<td><input type="text" name="t5" value="<?php echo $yr;?>" readonly></td>
</tr>
<tr>
<td align="right">Absent</td>
<td><input type="text" name="t6" value="<?php echo $ab;?>" readonly></td>
</tr>
<tr>
<td align="right">Present</td>
<td><input type="text" name="t7" value="<?php echo $pre;?>" readonly></td>
</tr>
<tr>
<td align="right">Basic</td>
<td><input type="text" name="t8" value="<?php echo $basic;?>" readonly></td>
</tr>
<tr>
<td align="right">Da</td>
<td><input type="text" name="t9" value="<?php echo $da;?>" readonly></td>
</tr>
<tr>
<td align="right">Hra</td>
<td><input type="text" name="t10" value="<?php echo $hra;?>" readonly></td>
</tr>
<tr>
<td align="right">Pf</td>
<td><input type="text" name="t11" value="<?php echo $pf;?>" readonly></td>
</tr>
<tr>
<td align="right">Esi</td>
<td><input type="text" name="t12" value="<?php echo $esi;?>" readonly></td>
</tr>
<tr>
<td align="right">Deductions</td>
<td><input type="text" name="t13" value="0"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit1" value="Submit"></td>
</tr>
</table>
</form>
<?php
} else if(isset($_POST['submit1'])) {
	$aid=$_POST['t1'];
	$basic=$_POST['t8'];
	$da=$_POST['t9'];
	$hra=$_POST['t10'];
	$pf=$_POST['t11'];
	$esi=$_POST['t12'];
	$ded=$_POST['t12'];
	$gross=$basic+$da+$hra;
	$ded=$pf+$esi+$ded;
	$net=$gross-$ded;
mysql_query("insert into salary (aid,basic,da,hra,pf,esi,ded,gross,net) values ($aid,$basic,$da,$hra,$pf,$esi,$ded,$gross,$net)") or die(mysql_error());
echo "<center><b>Salary Made !</b></center>";
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>