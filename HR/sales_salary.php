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
		<a href="sale_detail.php"><div class="submenu select">Sales Detail</div></a>
		<a href="ac_detail.php"><div class="submenu">Account Detail</div></a>
		<a href="hr_detail.php"><div class="submenu">HR Detail</div></a>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Add Salary</h2>
		<br /><br />
		<center>
		<?php
			if(isset($_REQUEST['s_emp_id']))
			{
				$vid = $_REQUEST['s_emp_id'];
				$sel = "select * from sales_reg where sl_emp_id = '$vid'";
				$res = mysql_query($sel);
				$row = mysql_fetch_array($res); 
			}
			if(isset($_REQUEST['btn_submit']))
			{
				
				$veid = $_REQUEST['txt_eid'];
				$vemp = $_REQUEST['txt_emp'];
				$vsalary = $_REQUEST['txt_salary'];
				
				$select = "select * from salary where emp_id = '$veid'";
				$result = mysql_query($select);
				
				if(mysql_num_rows($result))
				{
					echo "<script>alert('This Salary ID Already Exist')</script>";
				}
				else
				{
					$insert = "insert into salary(emp_id,emp_name,salary) values('$veid','$vemp','$vsalary')";
					mysql_query($insert);
					header("location:sale_detail.php");
				}
			}
		?>
		<form method="post">
			<table align="center" height="200px" width="36%">
				<tr>
					<th>Employee ID</th>
					<td><input type="text" name="txt_eid" value="<?php echo $row['sl_emp_id'] ?>" class="input" /></td>
				</tr>
				<tr>
					<th>Employee Name</th>
					<td><input type="text" name="txt_emp" value="<?php echo $row['username'] ?>" class="input" /></td>
				</tr>
				<tr>
					<th>Total Salary</th>
					<td><input type="text" name="txt_salary" class="input" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="btn_submit" value="Submit" class="btn" /></td>
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