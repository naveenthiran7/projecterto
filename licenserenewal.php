<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value==""||f.t6.value==""||f.t7.value==""||f.t8.value=="") {
window.alert("Field is Empty... Cant Submit !")
return false
}
return true
}
function call(p) {
if(p!="") {
if(window.ActiveXObject)
ob=new ActiveXObject("Microsoft.XMLHTTP")
else
ob=new XMLHttpRequest()
ob.onreadystatechange=function() {
if(ob.readyState==4&&ob.status==200) {
var s=ob.responseText
var un=
f.t2.value=s.substring(0,s.indexOf('*'))
f.t3.value=s.substring(s.indexOf('*')+1,s.indexOf('#'))
f.t4.value=s.substring(s.indexOf('#')+1)
}
}
ob.open("GET","getexplic.php?lid="+p,true)
ob.send()
} else {
f.t2.value=""
f.t3.value=""
f.t4.value=""
}
}
</script>
<style>
.ar{text-align:right;}
</style>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
$cd=date('Y-m-d',time());
$rs=mysql_query("select licno from license l where expiryon < '$cd' and licno not in (select licno from licenserenewal) or licno in (select licno from licenserenewal where edate < '$cd')") or die(mysql_error());
include("menu.php");
if(!isset($_POST['submit'])) {
?>
<form name="f" action="licenserenewal.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">LICENSE RENEWAL</th>
</tr>
<tr>
<td class="ar">License No</td>
<td>
<select name="t1" onchange="call(this.value)">
<option value=""> --Select-- </option>
<?php
while($r=mysql_fetch_row($rs))
echo "<option value='$r[0]'>$r[0]</option>";
?>
</select>
</td>
</tr>
<tr>
<td class="ar">User Id</td>
<td><input type="text" name="t2" readonly></td>
</tr>
<tr>
<td class="ar">User Name</td>
<td><input type="text" name="t3" readonly></td>
</tr>
<tr>
<td class="ar">License Type</td>
<td><input type="text" name="t4" readonly></td>
</tr>
<tr>
<td class="ar">Renewal Date</td>
<td>
<select name="t5">
<option value="">DD</option>
<?php
for($i=1; $i<=31; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
<select name="t6">
<option value="">MM</option>
<?php
for($i=1; $i<=12; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
<select name="t7">
<option value="">YYYY</option>
<?php
for($i=2010; $i<=2040; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
</td>
</tr>
<tr>
<td class="ar">Fee Amount</td>
<td><input type="text" name="t8"></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Submit">
</td>
</tr>
</table>
</form>
<?php
} else {
	$licno=$_POST['t1'];
	$userid=$_POST['t2'];
	$name=$_POST['t3'];
switch($_POST['t4']) {
case 'Two Wheeler Without Gear': $lictype="two_without_gear";break;
case 'Two Wheeler With Gear': $lictype="two_with_gear";break;
case 'Four Wheeler LMVG': $lictype="four_lmvg";break;
case 'Four Wheeler HMVG': $lictype="four_hmvg";break;
}
	$renewal=new DateTime($_POST['t7']."-".$_POST['t6']."-".$_POST['t5']);
	$renewal=$renewal->format('Y-m-d');
	$cd=date('Y-m-d',time());
	$edate=new DateTime($renewal);
	date_add($edate,new DateInterval("P10Y"));
	$edate=$edate->format('Y-m-d');
	$fee=$_POST['t8'];
	if($cd<=$renewal) {
	$ss="insert into licenserenewal (userid,lictype,licno,rdate,edate,fee) values ('$userid','$lictype','$licno','$renewal','$edate',$fee)";
	if(mysql_query($ss)) {
	echo "<h3 align='center'>License Renewed...!</h3>";	
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='licenserenewal.php'>Back</a></h4>";	
	}
	}
	else {
	echo "<script type='text/javascript'>window.alert('Renewal date should be greater than current date')</script>";
	}
	echo "<h4 align='center'><a href='licenserenewal.php'>Refresh</a></h4>";	
}
?>
</body>
</html>