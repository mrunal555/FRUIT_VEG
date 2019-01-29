<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
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

	<div id="name">Welcome -&nbsp;<b class="user"><?php echo $vuser ?></b>&nbsp;</div>
	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="hr_home.php">Home</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="attendance_wise_salary.php">View Attendance Wise Salary</a></li>
			<li><a href="hr_profile.php">View Profile</a></li>
			<li><a href="purchase_detail.php" class="active">Add Salary</a></li>
			<li><a href="view_purchase_salary.php">View Salary</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	
	<div id="submenu">
		<a href="purchase_detail.php"><div class="submenu">Purchase Detail</div></a>
		<a href="sale_detail.php"><div class="submenu">Sales Detail</div></a>
		<a href="ac_detail.php"><div class="submenu">Account Detail</div></a>
		<a href="hr_detail.php"><div class="submenu select">HR Detail</div></a>
	</div>
	<div id="menubottom"></div>
	<div id="content">
		<h2 align="center">HR Employees Detail</h2>
		<br /><br />
		<center><form method="post">
			<table align="center" border="1" cellpadding="0" cellspacing="0" width="100%" style="text-align:center;">
				<tr class="tr_th">
					<th>SR No.</th>
					<th>Emp ID</th>
					
					<th>Username</th>
					
					<th>Contact</th>
					<th>E-Mail</th>
					
					<th align="center">Action</th>
				</tr>
				<?php
					$i = 1;
					$sel = "select * from hr_reg";
					$res = mysql_query($sel);
					
					while($row=mysql_fetch_array($res))
					{
				?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['hr_emp_id'] ?></td>
						
						<td><?php echo $row['username'] ?></td>
						
						<td><?php echo $row['contact'] ?></td>
						<td><?php echo $row['e_mail'] ?></td>
						
						
						<td style="background-color:#666600;"><a href="hr_salary.php?h_emp_id=<?php echo $row['hr_emp_id'] ?>" style="color:#FFFFFF;">Add Salary</a></td>
						
					</tr>
				<?php
					}
					
				?>
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
<?php
	}
	else
	{
		echo"<script>alert('Please First Login')</script>";
	}
?>