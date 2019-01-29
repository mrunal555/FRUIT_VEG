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
			<li><a href="admin_home.php">Home</a></li>
			<li><a href="customer_detail.php" class="active">View Report</a></li>
			<li><a href="view_product.php">Purchase</a></li>
			<li><a href="customer_purchase.php">Sales</a></li>
			<li><a href="profit.php">Account</a></li>
			<li><a href="backup_attendance">HR</a></li>
			<li><a href="add_country.php">Add Country</a></li>
			<li><a href="add_state.php">Add State</a></li>
			<li><a href="add_city.php">Add City</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="submenu">
		<a href="customer_detail.php"><div class="submenu">Customer</div></a>
		<a href="purchase_detail.php"><div class="submenu select">Purchase</div></a>
		<a href="sales_detail.php"><div class="submenu">Sales</div></a>
		<a href="account_detail.php"><div class="submenu">Account</div></a>
		<a href="hr_detail.php"><div class="submenu">HR</div></a>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Purchase Employees Detail</h2>
		<br /><br />
		<center><form method="post">
			<table align="center" border="1" cellpadding="0" cellspacing="0" width="90%" style="text-align:center;">
				<tr class="tr_th">
					<th>SR No.</th>
					<th>Employee ID</th>					
					<th>Username</th>
					<th>Password</th>					
					<th>Contact</th>
					<th>Salary</th>					
					<!--<th align="center">Action</th>-->
				</tr>
				<?php
					$i = 1;
					$sel = "select * from purchase_reg join salary on salary.emp_id = purchase_reg.pr_emp_id";
					$res = mysql_query($sel);
					
					while($row=mysql_fetch_array($res))
					{
				?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['pr_emp_id'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo $row['password'] ?></td>
						<td><?php echo $row['contact'] ?></td>
						<td><?php echo $row['salary'] ?></td>
						
						<!--<td style="background-color:#666600;"><a href="view_pr_detail" style="color:#FFFFFF;">View All Detail</a></td>-->
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