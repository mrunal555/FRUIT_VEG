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
			<li><a href="purchase_detail.php">Add Salary</a></li>
			<li><a href="view_purchase_salary.php" class="active">View Salary</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="submenu">
		<a href="view_purchase_salary.php"><div class="submenu">View Purchase Salary</div></a>
		<a href="view_sales_salary.php"><div class="submenu">View Sales Salary</div></a>
		<a href="view_ac_salary.php"><div class="submenu select">View Account Salary</div></a>
		<a href="view_hr_salary.php"><div class="submenu">View HR Salary</div></a>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Update Salary</h2>
		<br /><br />
		<center>
		<?php
			if(isset($_REQUEST['eid']))
			{
				$veid = $_REQUEST['eid'];
				$sel = "select * from salary where emp_id = '$veid'";
				$res = mysql_query($sel);
				$row = mysql_fetch_array($res); 
			}
			if(isset($_REQUEST['btn_update']))
			{
				$veid = $_REQUEST['eid'];
				$vsalary = $_REQUEST['txt_salary'];
				
				$update = "update salary set salary = '$vsalary' where emp_id = '$veid'";
				mysql_query($update);
				header("location:view_ac_salary.php");
				
			}
		?>
		<form method="post">
			<table align="center" height="200px" width="36%">
				<tr>
					<th>Employee ID</th>
					<td><input type="text" name="txt_eid" value="<?php echo $row['emp_id'] ?>" class="input" readonly="true" /></td>
				</tr>
				<tr>
					<th>Employee Name</th>
					<td><input type="text" name="txt_emp" value="<?php echo $row['emp_name'] ?>" class="input" readonly="true" /></td>
				</tr>
				<tr>
					<th>Total Salary</th>
					<td><input type="text" name="txt_salary" value="<?php echo $row['salary'] ?>" class="input" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="btn_update" value="Update" class="btn" /></td>
				</tr>
			</table>
		</form>
		</center>	
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