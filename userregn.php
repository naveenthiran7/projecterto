<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value==""||f.t6.value==""||f.t7.value==""||f.t8.value==""||f.t9.value==""||f.t10.value==""||f.t11.value==""||f.t12.value==""||f.t13.value=="") {
window.alert("Field is Empty... Cant submit !")
return false
}
if(f.t12.value!=f.t13.value) {
window.alert("Confirm Password does not Match!")
f.t13.focus()
return false
}
if(!f.g[0].checked&&!f.g[1].checked) {
window.alert("Select any Gender !")
return false
}
if(parseInt(f.t9.value)<18) {
window.alert("Age Below 18 ! Cant Register...")
return false
}
if(f.t14.value.length!=10) {
alert("Mobile no should be 10 digits");
return false;
}
return true
}
function call(p) {
if(p!="") {
var yy=parseInt(p)
var d=new Date()
var yyy=d.getYear()
yyy=parseInt(yyy)+1900
f.t9.value=(yyy-yy)
} else {
f.t9.value=""
}
}
</script>
<style>
.r {text-align:right;}
</style>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
$rs=mysql_query("select concat('D',ifnull(max(convert(substr(userid,2),signed)),9999)+1) from userregn") or die(mysql_error());
$r=mysql_fetch_row($rs);
if(!isset($_POST['submit'])) {
?>
<form name="f" action="userregn.php" method="post" onsubmit="return check()">
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
<select name="t8" onchange="call(this.value)">
<option value=""> --yyyy-- </option>
<?php
for($i=1960; $i<=2020; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
</td>
</tr>
<tr>
<td class="r">Age</td>
<td><input type="text" name="t9" readonly></td>
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
<td class="r">Training Type</td>
<td>
<select name="t11">
<option value="with_training">With Training</option>
<option value="without_training">Without Training</option>
</select>
</td>
</tr>
<tr>
<td class="r">Password</td>
<td><input type="password" name="t12"></td>
</tr>
<tr>
<td class="r">Confirm Password</td>
<td><input type="password" name="t13"></td>
</tr>
<tr>
<td class="r">Mobile No</td>
<td><input type="text" name="t14" maxlength="10"></td>
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
	$trngtype=$_POST['t11'];
	$password=$_POST['t12'];
	$mobile=$_POST['t14'];
	$dob=new DateTime($dob);
	$dob=$dob->format('Y-m-d');
	if($trngtype=="with_training" && ($lictype=="two_without_gear" || $lictype=="two_with_gear"))
	$rs1=mysql_query("select fee from feemaster where lictype='two_wheeler_lic_training'");
	else if($trngtype=="with_training" && ($lictype=="four_lmvg" || $lictype=="four_hmvg"))
	$rs1=mysql_query("select fee from feemaster where lictype='four_wheeler_lic_training'");
	else if($trngtype=="without_training" && ($lictype=="two_without_gear" || $lictype=="two_with_gear"))
	$rs1=mysql_query("select fee from feemaster where lictype='two_wheeler_lic_only'");
	else if($trngtype=="without_training" && ($lictype=="four_lmvg" || $lictype=="four_hmvg"))
	$rs1=mysql_query("select fee from feemaster where lictype='four_wheeler_lic_only'");
	$r1=mysql_fetch_row($rs1); 
	$str="insert into userregn values ('$userid','$name','$gender','$workst','$addr','$city','$dob',$age,'$lictype','$trngtype','$password',$r1[0],'$mobile')";
	if(mysql_query($str)) {
		$str1="insert into payment (userid,totamt) values ('$userid',$r1[0])";
	if(mysql_query($str1))
	echo "<h3 align='center'>Registered Successfully...!<br><a href='userregn.php'>Home</a></h3>";
	else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='userregn.php'>Back</a></h4>";		
	}
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='userregn.php'>Back</a></h4>";
	}
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>