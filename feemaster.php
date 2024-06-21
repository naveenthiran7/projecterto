<?php
session_start();
include("db.php");
?>
<html>
<style>
.ar{text-align:right;}
</style>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value=="") {
window.alert("Field is Empty... Cant Submit !")
return false
}
return true
}
function check1() {
if(ff.u.value==""||ff.u1.value==""||ff.u2.value==""||ff.u3.value=="") {
window.alert("Field is Empty... Cant Submit !")
return false
}
return true
}
</script>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
$rs=mysql_query("select * from feemaster") or die(mysql_error());
if(mysql_num_rows($rs)>0) {
if(!isset($_REQUEST['fid'])&&!isset($_POST['submitt'])) {
echo "<div style='float:right'><table border='1' align='center'><tr><th colspan='5'>FEE INFO</th></tr><tr><th>Fee Id</th><th>Licence Type</th><th>Duration</th><th>Fee</th><th>Task</th></tr>";
while($r=mysql_fetch_row($rs)) {
echo "<tr><td>$r[0]</td><td>$r[1]</td><td>$r[2] (in Months)</td><td>$r[3]</td><td><a href='feemaster.php?fid=$r[0]'>Edit</a></td></tr>";
}
echo "</table></div>";
} else if(isset($_REQUEST['fid'])&&!isset($_POST['submitt'])) {
echo "<div style='float:right'><form name='ff' action='feemaster.php' method='post' onsubmit='return check1()'><table border='1' align='center'><tr><th colspan='5'>FEE INFO</th></tr><tr><th>Fee Id</th><th>Licence Type</th><th>Duration</th><th>Fee</th><th>Task</th></tr><tr><th colspan='5'><a href='feemaster.php'>Cancel Editing</a></th></tr>";
while($r1=mysql_fetch_row($rs)) {
if($r1[0]==$_REQUEST['fid']) {
echo "<tr><td><input type='hidden' name='u' value=$r1[0]>$r1[0]</td><td>";
?>
<select name="u1">
<option value="two_wheeler_lic_training">Two Wheeler Licence with Training</option>
<option value="two_wheeler_lic_only">Two Wheeler Licence Only</option>
<option value="four_wheeler_lic_training">Four Wheeler Licence with Training</option>
<option value="four_wheeler_lic_only">Four Wheeler Licence Only</option>
</select>
<?php
echo "</td><td><input type='text' name='u2' value=$r1[2] size='5'></td><td><input type='text' name='u3' value=$r1[3] size='5'></td><td><input type='submit' name='submitt' value='Edit'></td></tr>";
} else
echo "<tr><td>$r1[0]</td><td>$r1[1]</td><td>$r1[2] (in Months)</td><td>$r1[3]</td><td>&nbsp;</td></tr>";
}
echo "</table></form></div>";
} else if(isset($_POST['submitt'])) {
	$fid=$_POST['u'];
	$lictype=$_POST['u1'];
	$duration=$_POST['u2'];
	$fee=$_POST['u3'];
	$str="update feemaster set lictype='$lictype',duration=$duration,fee=$fee where fid=$fid";
	if(mysql_query($str)) {
	echo "<div style='float:right'><h3 align='center'>Record Modified...<br><a href='feemaster.php'>Refresh</a></h3></div>";
	} else {
	echo "<div style='float:right'><h3 align='center'>".mysql_error()."<br><a href='feemaster.php'>Refresh</a></h3></div>";
	}
}
} else {
	echo "<div style='float:right'><h3 align='center'>No Fee Structure Defined !</h3></div>";
}
if(!isset($_POST['submit'])) {
?>
<form name="f" action="feemaster.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">FEE MASTER</th>
</tr>
<tr>
<td class="ar">Select Type</td>
<td>
<select name="t1">
<option value="two_wheeler_lic_training">Two Wheeler Licence with Training</option>
<option value="two_wheeler_lic_only">Two Wheeler Licence Only</option>
<option value="four_wheeler_lic_training">Four Wheeler Licence with Training</option>
<option value="four_wheeler_lic_only">Four Wheeler Licence Only</option>
</select>
</td>
</tr>
<tr>
<td class="ar">Duration</td>
<td><input type="text" name="t2">(in Month)</td>
</tr>
<tr>
<td class="ar">Fee</td>
<td><input type="text" name="t3"></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Insert">
</td>
</tr>
</table>
</form>
<?php
} else if(isset($_POST['submit'])) {
	$lictype=$_POST['t1'];
	$duration=$_POST['t2'];
	$fee=$_POST['t3'];
	$str="insert into feemaster (lictype,duration,fee) values ('$lictype',$duration,$fee)";
	if(mysql_query($str)) {
	echo "<h3 align='center'>Fee Structure Created !</h3>";
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	}
	echo "<br><center><a href='feemaster.php'>Back</a></center>";
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>