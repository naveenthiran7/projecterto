<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value==""||f.t6.value=="") {
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
var name=s.substring(0,s.indexOf('*'))
var lictype=s.substring(s.indexOf('*')+1,s.indexOf('@'))
var tot=s.substring(s.indexOf('@')+1,s.indexOf('&'))
var paid=s.substring(s.indexOf('&')+1,s.indexOf('~'))
var bal=s.substring(s.indexOf('~')+1)
f.t2.value=name
f.t3.value=lictype
f.t4.value=tot
f.t5.value=paid
f.t6.value=bal
}
}
ob.open("GET","getuserpmt.php?id="+p,true);
ob.send()
} else {
f.t2.value=""
f.t3.value=""
f.t4.value=""
f.t5.value=""
f.t6.value=""
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
$rs=mysql_query("select userid from payment where totamt-paidamt>0 and userid in (select userid from license)") or die(mysql_error());
if(!isset($_POST['submit'])) {
?>
<form name="f" action="payment.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">PAYMENT</th>
</tr>
<tr>
<td class="ar">Select User Id</td>
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
<td class="ar">Name</td>
<td><input type="text" name="t2" readonly></td>
</tr>
<tr>
<td class="ar">License Type</td>
<td><input type="text" name="t3" readonly></td>
</tr>
<tr>
<td class="ar">Bill Amount</td>
<td><input type="text" name="t4" readonly></td>
</tr>
<tr>
<td class="ar">Paid Amount</td>
<td><input type="text" name="t5" readonly></td>
</tr>
<tr>
<td class="ar">Now Paying</td>
<td><input type="text" name="t6"></td>
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
	$userid=$_POST['t1'];
	$totamt=$_POST['t4'];
	$paidamt=$_POST['t5'];
	$paying=$_POST['t6'];
if($paying>($totamt-$paidamt)) {
	echo "<h3 align='center'>Amount is greater than Payable...</h3>";
	echo "<h4 align='center'><a href='payment.php'>Back</a></h4>";	
} else {
	$strr="update payment set paidamt=paidamt+$paying where userid='$userid'";
	if(mysql_query($strr)) {
	echo "<h3 align='center'>Payment Received...!<br><a href='payment.php'>Refresh</a></h3>";	
	} else {
	echo "<h3 align='center'>".mysql_error()."</h3>";
	echo "<h4 align='center'><a href='payment.php'>Back</a></h4>";	
	}
}	
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>