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
			<li><a href="attendance_wise_salary.php" class="active">View Attendance Wise Salary</a></li>
			<li><a href="hr_profile.php">View Profile</a></li>
			<li><a href="purchase_detail.php">Add Salary</a></li>
			<li><a href="view_purchase_salary.php">View Salary</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="submenu">
		<a href="backup_attendance.php"><div class="submenu">Backup Attendance</div></a>
		
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		
		<center>
		<form method="post">
			<h2 align="center" style="">View Attendance Wise Salary</h2>
		<br /><br />
			<table align="center">
				<tr>
					<td><input type="text" name="txt_search" class="input" placeholder="Enter Employee ID" /></td>
					<td><input type="submit" name="btn_search" value="Search" class="btn" /></td>
				</tr>
			</table>
			<br />
			
			<?php
				
				if(isset($_REQUEST['btn_search']))
				{
					
			?>
				<table align="center" border="1" cellpadding="0" cellspacing="0" width="100%" style="text-align:center;">
				<tr class="tr_th">
					<th>Sr No</th>
					<th style="background-color:#666600;">Employee ID</th>
					<th>Employee Name</th>
					<th>Present</th>
					<th>Absent</th>
					<th>Monthly Salary</th>
					<th>Net Salary</th>
				</tr>
				<?php
					$i = 1;
					$vsearch = $_REQUEST['txt_search'];
					$select = "select * from attendance where emp_id LIKE '%$vsearch%'";
					$result = mysql_query($select);
					while($rows = mysql_fetch_array($result))
					{
				?>
				<tr>
					<td><?php echo $i++ ?></td>
					<td><?php echo $rows['emp_id'] ?></td>
					<td><?php echo $rows['emp_name'] ?></td>
					<td><?php echo $rows['present'] ?></td>
					<td><?php echo $rows['absent'] ?></td>
					<td><?php echo $rows['salary_id'] ?></td>
					<td style="background-color:#666600;color:#FFFFFF;">Rs.&nbsp;<?php echo $rows['net_salary'] ?></td>
				</tr>
				<?php
					}
				?>
			</table>
			<br /><br />
			<?php
				}
				else
				{
			?>
				
			<table align="center" border="1" cellpadding="0" cellspacing="0" width="100%" style="text-align:center;">
				<tr class="tr_th">
					<th>Sr No.</th>
					<th>Employee ID</th>
					<th>Employee Name</th>
					<th>Present</th>
					<th>Absent</th>
					<th>Monthly Salary</th>
					<th>Net Salary</th>
				</tr>
				<?php
					$i = 1;
					$sel = "select * from attendance";
					$res = mysql_query($sel);
					while($row=mysql_fetch_array($res))
					{
				?>
				<tr>
					<td><?php echo $i++ ?></td>
					<td><?php echo $row['emp_id'] ?></td>
					<td><?php echo $row['emp_name'] ?></td>
					<td><?php echo $row['present'] ?></td>
					<td><?php echo $row['absent'] ?></td>
					<td><?php echo $row['salary_id'] ?></td>
					<td style="background-color:#666600;color:#FFFFFF;">Rs.&nbsp;<?php echo $row['net_salary'] ?></td>
					
				<?php
					}
				?>
				</tr>
			</table>
			<?php
				}
			?>
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