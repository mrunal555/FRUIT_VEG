<?php
	ob_start();
	include("con1.php");
	session_start();
	
	if(isset($_REQUEST['btn_login']))
	{
		$vunm = $_REQUEST['txt_unm'];
		$vpwd = $_REQUEST['txt_pwd'];
		
		$sel = "select * from pak_reg where username = '$vunm' and password = '$vpwd'";
		$res = mysql_query($sel);
		
		if(mysql_num_rows($res))
		{
			$_SESSION['user'] = $vunm;
			header("location:pak_home.php");
		}
		else
		{
			echo"<script>alert('Invalid Username Or Password')</script>";
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	zenlike1.0 by nodethirtythree design
	http://www.nodethirtythree.com

-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Fruit &amp; Veg ERP</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="default.css" />
</head>
<body>

<div id="upbg"></div>

<div id="outer">


	<div id="header">
		<div id="headercontent">
			<h1>Fruit & Vegetable Packaging ERP</h1>
			<h2></h2>
		</div>
	</div>


	<form method="post" action="">
		<div id="search">
			<input type="text" class="text" maxlength="64" name="keywords" />
			<input type="submit" class="submit" value="Search" />
		</div>
	</form>


	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="index.php" class="active">Login</a></li>
			<li><a href="pak_reg.php">Registration</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
	<br /><br />
		<h2 align="center">Packaging Login</h2>
		<br /><br />
		<center><form method="post">
			<table align="center" height="150px" width="36%" style="border:2px solid #000000;padding-top:10px;box-shadow:3px 3px 3px #000000;border-radius:10px;">
				<tr align="center">
					<th>Username</th>
					<td><input type="text" name="txt_unm" class="input" /></td>
				</tr>
				<tr align="center">
					<th>Password</th>
					<td><input type="password" name="txt_pwd" class="input" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="btn_login" value="Login" class="btn" /></td>
				</tr>
			</table>
		</form></center>
	</div>

			<!-- Secondary content area end -->
		
	<div id="footer">
			<?php include("footer.php") ?>
	</div>
	
</div>

</body>
</html>