<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value=="") {
window.alert("Field is Empty... Cant submit !")
return false
}
return true
}
</script>
<style>
.ar {text-align:right;}
</style>
<body>
<h1 style="font-family:Tw Cen MT Condensed Extra Bold;text-align:center;">DRIVING SCHOOL MANAGEMENT</h1>
<form name="f" action="/Driving_School/" method="post" onsubmit="return check()">
<table align="center">
<tr>
<td class="ar">UserName</td>
<td><input type="text" name="t1"></td>
</tr>
<tr>
<td class="ar">Password</td>
<td><input type="password" name="t2"></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="LogIn">
<input type="reset" value="Clear">
</td>
</tr>
</table>
</form>
<?php
if(isset($_POST['submit'])) {
	$un=$_POST['t1'];
	$pw=$_POST['t2'];
	if($un=="admin" && $pw=="admin") {
	$_SESSION['userid']=$un;
	header('Location:feemaster.php');
	} else {
	$rs=mysql_query("select * from userregn where userid='$un' and password='$pw'") or die(mysql_error());
	if(mysql_num_rows($rs)>0) {
	$_SESSION['userid']=$un;
	header('Location:userp.php');
	} else {
	header('Location:/Driving_School/');
	}
	}
}
?>
</body>
</html>