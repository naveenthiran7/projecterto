<?php
session_start();
include("db.php");
?>
<html>
<style>
a {
font-family:arial;
font-weight:bold;
font-size:smaller;
color:green;
width:55px;
padding:5px 5px 5px 0px;
}
a:hover{
background:#caefc0;
}
</style>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])) {
$ru=mysql_query("select name from userregn where userid='$_SESSION[userid]'") or die(mysql_error());
$rr=mysql_fetch_row($ru);
?>
<div align="right"><i>Welcome <b><?php echo $rr[0];?></b></i>&nbsp;|&nbsp;<a href="logout.php">SignOut</a>|</div>
<?php
$rs=mysql_query("select * from llr where userid='$_SESSION[userid]'") or die(mysql_error());
echo "<br><br><br>";
if(mysql_num_rows($rs)>0) {
echo "<br><table border='1' align='center'><tr><th colspan='6'>LLR INFO</th></tr><tr><th>LLR No</th><th>Your Id</th><th>License Type</th><th>Valid From</th><th>Valid To</th><th>LLR Fee</th></tr>";
while($r=mysql_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr)
echo "<td>$rr</td>";
echo "</tr>";
}
echo "</table><br><br><hr width='500'>";
} else {
echo "<hr><h3 align='center'>No LLR Details Found...!</h3><hr>";
}

$rs=mysql_query("select * from license where userid='$_SESSION[userid]'") or die(mysql_error());
if(mysql_num_rows($rs)>0) {
echo "<br><table border='1' align='center'><TR><th colspan='8'>LICENSE INFO</th></TR><tr><th>Id</th><th>LLR No</th><th>Your Id</th><th>License Type</th><th>License No</th><th>Valid From</th><th>Valid To</th><th>Issued ?</th></tr>";
while($r=mysql_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr)
echo "<td>$rr</td>";
echo "</tr>";
}
echo "</table>";
} else {
echo "<hr><h3 align='center'>No License Details Found...!</h3><hr>";
}
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>