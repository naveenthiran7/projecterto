<?php
session_start();
include("db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>RTO Management</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
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
<div id="wrapper">
	<div id="menu">
		<ul>
			<li><a href="/RTO/">Homepage</a></li>
			<li><a href="/RTO/gallery.php">Gallery</a></li>
			<li><a href="/RTO/about.php">About</a></li>
			<!--li><a href="#">Resources</a></li-->
			<li class="current_page_item"><a href="contact.php">Contact</a></li>
		</ul>
	</div>
	<div id="logo">
		<h1 style="font-family:Tw Cen MT Condensed Extra Bold;text-transform:none;"><a href="#">RTO Management System</a></h1>
		<h2></h2>
	</div>
	<hr />
	<div id="page">
<div id="content">
<div class="post">
<h2 class="title"><a href="#">RTO Mgmt. Welcomes U</a></h2>
<div class="entry">
<!--p align="justify">The School is established in 1985 by Hon. Senthil Nathan AVL. From there on this school begins its victorious Journey by serving the people at its best.  At Any time this school leads the people who arrived to them.</p>
<p>Our other public services and its history can be found in facebook <a href="#">gnmnc@facebook.com</a></p-->

</div>
<!--p class="meta"><span class="posted">Posted by <a href="#">OLDSM</a> on February, 2012</span> <a href="#" class="permalink">Read more</a> <a href="#" class="comments">Comments</a> </p-->
</div>

		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li id="search">
					<h2>Contact Us</h2>
						<div>
<ul>
<li>1. #838, North Main street, K.K.Nagar, Madurai</li>
<li>(0452) 5522-666 (3-lines)</li>
<li>2. 33,North Vadamboki st, Madurai</li>
<li>(0452) 6655-256 (2-lines)</li>
<li>3. 654,Vetri Building, South Gate, Madurai</li>
<li>(0452) 4477-445 (4-lines)</li>
</ul>


						</div>

				</li>

			</ul>
		</div>
		<!-- end #sidebar -->
	</div>
	<!-- end #page -->
	<div id="footer">
		<p>(c) RTO Management System </p>
	</div>
</div>
</body>
</html>