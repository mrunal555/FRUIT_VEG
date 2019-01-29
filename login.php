<?php
	ob_start();
	include("con1.php");
	session_start();
	
	if(isset($_REQUEST['btn_login']))
	{
		$vunm = $_REQUEST['txt_unm'];
		$vpwd = $_REQUEST['txt_pwd'];
		
		$sel = "select * from customer_reg where username = '$vunm' and password = '$vpwd'";
		$res = mysql_query($sel);
		
		if(mysql_num_rows($res))
		{
			$_SESSION['user'] = $vunm;
			header("location:Customer/cust_home.php");
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
<script >
	function validate();
	{
				var temp = true;
	   		var txt_unm=document.getElementById('txt_unm').value;
			if(txt_unm == '')
			{
				//alert('please enter your name')
				document.getElementById('UnmErr').innerHTML='Please enter your Unm';
				temp = false;
			}
			else
			{
				document.getElementById('UnmErr').style.display='none';
			}	
			
			var temp = true;
   			var txt_pwd=document.getElementById('txt_pwd').value;
			if(txt_pwd == '')
			{
				//alert('please enter your name')
				document.getElementById('PwdErr').innerHTML='Please enter your Password';
				temp = false;
			}
			else
			{
				document.getElementById('PwdErr').style.display='none';
			}				

		} 
</script>

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
			<li><a href="index.php">Home</a></li>
			<li><a href="login.php" class="active">Login</a></li>
			<li><a href="reg.php">Registration</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
	<br /><br />
		<h2 align="center">Customer Login</h2>
		<br /><br />
		<center><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return  validate();">
			<table align="center" height="150px" width="36%" style="border:2px solid #000000;padding-top:10px;box-shadow:3px 3px 3px #000000;border-radius:10px;">
				<tr align="center">
					<th>Username</th>
					<td>
						<input type="text" name="txt_unm" class="input" />
						<div id="UnmErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Password</th>
					<td>
						<input type="password" name="txt_pwd" class="input" />
						<div id="PwdErr" style="color:#FF0000;"></div>
					</td>
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