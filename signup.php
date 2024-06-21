<?php
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value==""||f.t6.value==""||f.t7.value==""||f.t8.value==""||f.t9.value==""||f.t10.value==""||f.t11.value==""||f.t12.value=="") {
window.alert("Field is Empty... Cant submit !")
return false
}
if(f.t11.value!=f.t12.value) {
window.alert("Confirm Password does not Match!")
f.t12.focus()
return false
}
if(!f.g[0].checked&&!f.g[1].checked) {
window.alert("Select any Gender !")
return false
}
return true
}
</script>
<style>
.r {text-align:right;}
</style>
<body>
<?php
$rs=mysql_query("select concat('D',ifnull(max(convert(substr(userid,2),signed)),9999)+1) from userregn") or die(mysql_error());
$r=mysql_fetch_row($rs);
if(!isset($_POST['submit'])) {
?>
<div align="right"><a href="/Driving_School/">Home</a></div>
<form name="f" action="signup.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">REGISTRATION FORM<br><br></th>
</tr>
<tr>
<td class="r">Your Id</td>
<td><input type="text" name="t1" value="<?php echo $r[0];?>" readonly></td>
</tr>
<tr>
<td class="r">Name</td>
<td><input type="text" name="t2"></td>
</tr>
<tr>
<td class="r">Gender</td>
<td>
<input type="radio" name="g" value="male">Male
<input type="radio" name="g" value="female">Female
</td>
</tr>
<tr>
<td class="r">Are You Working ?</td>
<td>
<select name="t3">
<option value="yes">Yes</option>
<option value="no">No</option>
</select>
</td>
</tr>
<tr>
<td class="r">Address</td>
<td><textarea name="t4" rows="3"></textarea></td>
</tr>
<tr>
<td class="r">City</td>
<td><input type="text" name="t5"></td>
</tr>
<tr>
<td class="r">DOB</td>
<td>
<select name="t6">
<?php
for($i=1; $i<=31; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
<select name="t7">
<?php
for($i=1; $i<=12; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
<select name="t8">
<?php
for($i=1960; $i<=2020; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
</td>
</tr>
<tr>
<td class="r">Age</td>
<td><input type="text" name="t9"></td>
</tr>
<tr>
<td class="r">Licence Type</td>
<td>
<select name="t10">
<option value="two_without_gear">Two Wheeler Without Gear</option>
<option value="two_with_gear">Two Wheeler With Gear</option>
<option value="four_lmvg">Four Wheeler LMVG</option>
<option value="four_hmvg">Four Wheeler HMVG</option>
</select>
</td>
</tr>
<tr>
<td class="r">Password</td>
<td><input type="password" name="t11"></td>
</tr>
<tr>
<td class="r">Confirm Password</td>
<td><input type="password" name="t12"></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Register">
<input type="reset" value="Clear">
</td>
</tr>
</table>
</form>
<?php
} else if(isset($_POST['submit'])) {
	$userid=$_POST['t1'];
	$name=$_POST['t2'];
	$gender=$_POST['g'];
	$workst=$_POST['t3'];
	$addr=$_POST['t4'];
	$city=$_POST['t5'];
	$dob=$_POST['t8']."-".$_POST['t7']."-".$_POST['t6'];
	$age=$_POST['t9'];
	$lictype=$_POST['t10'];
	$password=$_POST['t11'];
	$dob=new DateTime($dob);
	$dob=$dob->format('Y-m-d');
	$str="insert into userregn values ('$userid','$name','$gender','$workst','$addr','$city','$dob',$age,'$lictype','$password')";
	if(mysql_query($str)) {
	echo "<h3 align='center'>Registered Successfully...!<br><a href='/Driving_School/'>Home</a></h3>";
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='signup.php'>Back</a></h4>";
	}
}
?>
</body>
</html>