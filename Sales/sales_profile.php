<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		$sel = "select * from sales_reg join country on country.c_id = sales_reg.c_id join state on state.s_id = sales_reg.s_id join city on city.ct_id = sales_reg.ct_id where username = '$vuser'";
		$res = mysql_query($sel);
		$row = mysql_fetch_array($res);
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
<!--<link href="table.css" rel="stylesheet" type="text/css" />-->
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

	<div id="name">Welcome -&nbsp;<b class="user"><?php echo $vuser ?></b>&nbsp;</div>
	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="sales_home.php">Home</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="view_product.php">View Product</a></li>
			<li><a href="customer_buy.php">Customer Purchase</a></li>
			<li><a href="sales_profile.php" class="active">View Profile</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Profile</h2>
		<br /><br />
		<center>
		<div class="CSSTableGenerator">
		<form method="post">
			<table align="center" border="1" width="400px" height="400px" cellpadding="0" cellspacing="0">
				<tr>
					<th>First Name</th>
					<td align="center"><?php echo $row['fname'] ?></td>
				</tr>
				<tr>
					<th>Last Name</th>
					<td align="center"><?php echo $row['lname'] ?></td>
				</tr>
				<tr>
					<th>Username</th>
					<td align="center"><?php echo $row['username'] ?></td>
				</tr>
				<tr>
					<th>Address</th>
					<td align="center"><?php echo $row['address'] ?></td>
				</tr>
				<tr>
					<th>Country</th>
					<td align="center"><?php echo $row['country'] ?></td>
				</tr>
				<tr>
					<th>State</th>
					<td align="center"><?php echo $row['state'] ?></td>
				</tr>
				<tr>
					<th>City</th>
					<td align="center"><?php echo $row['city'] ?></td>
				</tr>
				<tr>
					<th>Gender</th>
					<td align="center"><?php echo $row['gender'] ?></td>
				</tr>
				<tr>
					<th>Contact No</th>
					<td align="center"><?php echo $row['contact'] ?></td>
				</tr>
				<tr>
					<th>E-Mail</th>
					<td align="center"><?php echo $row['e_mail'] ?></td>
				</tr>
				<tr>
					<th>Date Of Birth</th>
					<td align="center"><?php echo $row['dob'] ?></td>
				</tr>
				<!--<tr>
					<td colspan="2" align="center">--><!--</td>
				</tr>-->
				<table style="margin-top:10px;">
					<tr>
						<td align="center"><a href="update_profile.php" class="a"><div class="edit">Edit Profile</div></a></td>
					</tr>
				</table>
				
			</table>
			
		</form></div></center>
	</div>

			<!-- Secondary content area end -->
		
	<div id="footer">
			<?php include("footer.php") ?>
	</div>
	
</div>

</body>
</html>
<?php
	}
	else
	{
		echo"<script>alert('Please First Login')</script>";
	}
?>