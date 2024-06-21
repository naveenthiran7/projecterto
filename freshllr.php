<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value==""||f.t6.value=="") {
window.alert("Field is Empty... Cant submit !")
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
f.t3.value=ob.responseText
}
}
ob.open("GET","getllrtype.php?uid="+p,true)
ob.send()
} else {
f.t3.value=""
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
$llr=mysql_query("select ifnull(max(substr(llrno,2)),581000)+1 from llr") or die(mysql_error());
$lrw=mysql_fetch_row($llr);
$rs=mysql_query("select userid from userregn where userid not in (select userid from llr)") or die(mysql_error());
$date=new DateTime(date('Y-m-d h:i',time()+19800));
date_add($date,new DateInterval("P6M"));
$date=$date->format('Y-m-d');
$rs1=mysql_query("select llrno,userid,llrtype,validfrom,validto,amtpaid from llr where llrno not in (select llrno from license)") or die(mysql_error());
if(mysql_num_rows($rs1)>0) {
echo "<div style='float:right'><table border='1' align='center'><tr><th colspan='6'>LLR Info</th></tr><tr><th>LLR No</th><th>User Id</th><th>Type</th><th>Valif From</th><th>Valid To</th><th>Paid Amt</th></tr>";
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
echo "<th align='right'>$r1[5]</th>";
echo "</tr>";
}
echo "</table></div>";
} else {
echo "<div style='float:right'><h3 align='center'>No LLR Found...!</div>";
}
if(!isset($_POST['submit'])) {
?>
<form name="f" action="freshllr.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">LLR ISSUE FORM<br><br></th>
</tr>
<tr>
<td class="r">LLR No</td>
<td><input type="text" name="t1" value="L<?php echo $lrw[0];?>" readonly></td>
</tr>
<tr>
<td class="r">User Id</td>
<td>
<select name="t2" onchange="call(this.value)">
<option value=""> --Select-- </option>
<?php
while($r=mysql_fetch_row($rs))
echo "<option value='$r[0]'>$r[0]</option>";
?>
</select>
</td>
</tr>
<tr>
<td class="r">LLR Type</td>
<td><input type="text" name="t3" readonly></td>
</tr>
<tr>
<td class="r">Valid From</td>
<td><input type="text" name="t4" value="<?php echo date('Y-m-d',time());?>" readonly></td>
</tr>
<tr>
<td class="r">Valid Upto</td>
<td><input type="text" name="t5" value="<?php echo $date;?>" readonly></td>
</tr>
<tr>
<td class="r">Amount Paid</td>
<td><input type="text" name="t6"></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Issued">
</td>
</tr>
</table>
</form>
<?php
} else if(isset($_POST['submit'])) {
	$llrno=$_POST['t1'];
	$userid=$_POST['t2'];
	$llrtype=$_POST['t3'];
	$validfrom=$_POST['t4'];
	$validto=$_POST['t5'];
	$amt=$_POST['t6'];
	switch($llrtype) {
	case "Two Wheeler Without Gear": $str="two_without_gear";break;
	case "Two Wheeler With Gear": $str="two_with_gear";break;
	case "Four Wheeler LMVG": $str="four_lmvg";break;
	case "Four Wheeler HMVG": $str="four_hmvg";break;
	}
	$rs10=mysql_query("select totamt from payment where userid='$userid'") or die(mysql_error());
	$r10=mysql_fetch_row($rs10) or die(mysql_error());
	if($amt>$r10[0]) {
	echo "<h3 align='center'>Your Amount Exceeds Fee amount Rs.$r10[0]/-<br><br><a href='freshllr.php'>Back</a></h3>";
	} else {
	
	$str="insert into llr values ('$llrno','$userid','$str','$validfrom','$validto',$amt)";
	if(mysql_query($str)) {
		$str1="update payment set paidamt=paidamt+$amt where userid='$userid'";

	if(mysql_query($str1)) {
		$rs2=mysql_query("select name,paidamt,totamt-paidamt from userregn u,payment p where u.userid=p.userid and u.userid='$userid'") or die(mysql_error());
		$r2=mysql_fetch_row($rs2);
	echo "<h3 align='center'>LLR Registered...!<br><a href='freshllr.php'>Refresh</a></h3>";	
	echo "<br><table align='center'><tr><th>Name</th><th>Paid</th><th>Balance</th></tr><tr><td>$r2[0]</td><td>$amt</td><td>$r2[2]</td></tr></table>";
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='freshllr.php'>Back</a></h4>";	
	}
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='freshllr.php'>Back</a></h4>";	
	}
	}
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>