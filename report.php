<?php
session_start();
include("db.php");
?>
<html>
<script type="text/javascript">
function call(p) {
if(p!="") {
if(window.ActiveXObject)
ob=new ActiveXObject("Microsoft.XMLHTTP")
else
ob=new XMLHttpRequest()
ob.onreadystatechange=function() {
if(ob.readyState==4&&ob.status==200) {
document.getElementById("d").innerHTML=ob.responseText
}
}
ob.open("GET","getreport.php?id="+p,true);
ob.send()
} else {
document.getElementById("d").innerHTML=""
}
}
</script>
<body style="background: #EDFBD2 url(images/img03.jpg) repeat-x top;background-attachment:fixed;">
<?php
if(isset($_SESSION['userid'])&&$_SESSION['userid']=="admin") {
include("menu.php");
?>
<h3 align="center">CATEGORY WISE REPORT</h3>
<center>
Select any License Category
<select name="s" onchange="call(this.value)">
<option value=""> --Select-- </option>
<option value="two_without_gear">Two Wheeler Without Gear</option>
<option value="two_with_gear">Two Wheeler With Gear</option>
<option value="four_lmvg">Four Wheeler LMVWG</option>
<option value="four_hmvg">Four Wheeler HMVWG</option>
</select>
<div id="d"></div>
</center>
<?php
} else {
echo "<h3 align='center'>You are not Authorized to View this Page!</h3>";
}
?>
</body>
</html>