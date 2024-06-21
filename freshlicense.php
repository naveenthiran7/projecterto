<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value==""||f.t6.value==""||f.t7.value=="") {
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
f.t2.value=s.substring(0,s.indexOf('*'))
f.t3.value=s.substring(s.indexOf('*')+1)
}
}
ob.open("GET","getuserid.php?id="+p,true);
ob.send()
} else {
f.t2.value=""
f.t3.value=""
}
}
</script>
<style>
.ar{text-align:right;}
</style>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
$cd=date('Y-m-d',time()+19800);
$rs=mysql_query("select llrno from llr where '$cd'>=date_add(validfrom,interval 30 day) and '$cd'<=validto and llrno not in (select llrno from license)") or die(mysql_error());
$rs1=mysql_query("select llrno,userid,lictype,licno,issuedon,expiryon,issuedstatus from license") or die(mysql_error());
if(mysql_num_rows($rs1)>0) {
echo "<div style='float:right'><table border='1' align='center'><tr><th colspan='7'>License Info</th></tr><tr><th>LLR No</th><th>User Id</th><th>Type</th><th>LIC No</th><th>Valif From</th><th>Valid To</th><th>Issued ?</th></tr>";
while($r1=mysql_fetch_row($rs1)) {
echo "<tr>";
echo "<td>$r1[0]</td>";
echo "<td>$r1[1]</td>";
switch($r1[2]) {
case 'two_without_gear': $str="Two Wheeler Without Gear";break;
case 'two_with_gear': $str="Two Wheeler With Gear";break;
case 'four_lmvg': $str="Four Wheeler LMVG";break;
case 'four_hmvg': $str="Four Wheeler HMVG";break;
}
echo "<td>$str</td>";
echo "<td>$r1[3]</td>";
echo "<td>$r1[4]</td>";
echo "<td>$r1[5]</td>";
echo "<td align='center'>$r1[6]</td>";
echo "</tr>";
}
echo "</table></div>";
} else {
echo "<div style='float:right'><h3 align='center'>No LICENSE Found...!</div>";
}
if(!isset($_POST['submit'])) {
?>
<form name="f" action="freshlicense.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">NEW LICENSE</th>
</tr>
<tr>
<td class="ar">Select LLR Id</td>
<td>
<select name="t1" onchange="call(this.value)">
<option value=""> --Select-- </option>
<?php
while($r=mysql_fetch_row($rs))
echo "<option value=$r[0]>$r[0]</option>";
?>
</select>
</td>
</tr>
<tr>
<td class="ar">User Id</td>
<td><input type="text" name="t2" readonly></td>
</tr>
<tr>
<td class="ar">Licence Type</td>
<td><input type="text" name="t3" readonly></td>
</tr>
<tr>
<td class="ar">License No</td>
<td><input type="text" name="t4"></td>
</tr>
<tr>
<td class="ar">Issue Date</td>
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
for($i=2000; $i<=2040; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Submit">
</td>
</tr>
</table>
</form>
<?php
} else if(isset($_POST['submit'])) {
	$llrno=$_POST['t1'];
	$userid=$_POST['t2'];
	$lictype=$_POST['t3'];
	$licno=$_POST['t4'];
	$issuedon=new DateTime($_POST['t7']."-".$_POST['t6']."-".$_POST['t5']);
	$expon=new DateTime($issuedon->format('Y-m-d'));
	$expon=date_add($expon,new DateInterval("P10Y"));
	$issuedon=$issuedon->format('Y-m-d');
	$expon=$expon->format('Y-m-d');
	switch($lictype) {
	case "Two Wheeler Without Gear": $str="two_without_gear";break;
	case "Two Wheeler With Gear": $str="two_with_gear";break;
	case "Four Wheeler LMVG": $str="four_lmvg";break;
	case "Four Wheeler HMVG": $str="four_hmvg";break;
	}
	$strr="insert into license (llrno,userid,lictype,licno,issuedon,expiryon) values ('$llrno','$userid','$str','$licno','$issuedon','$expon')";
	if(mysql_query($strr)) {
	echo "<h3 align='center'>License Registered...!<br><a href='freshlicense.php'>Refresh</a></h3>";	
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='freshlicense.php'>Back</a></h4>";	
	}
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>