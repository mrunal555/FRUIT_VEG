<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];		
		
		//Print in text box
		$sel = "select * from account_reg join salary on salary.emp_id = account_reg.ac_emp_id where username = '$vuser'";
		$res = mysql_query($sel);
		$row = mysql_fetch_array($res);
		
				
		$present = 1;
		$date = date('Y-m-d');
		if(isset($_REQUEST['btn_submit']))
		{
			
			$veid = $_REQUEST['txt_eid'];
			$vemp = $_REQUEST['txt_emp'];
			$total_days = 31;
			$vdate = $_REQUEST['txt_cdate'];			
			$absent = $total_days - $present;
			$salary = $row['salary'];
			$per_day_salary = $salary/31;
			$net_salary = $per_day_salary * $present; 
			
			//match in 'if' condition
			$vempid = $_REQUEST['txt_eid'];
			$select = "select * from attendance where emp_id = '$vempid'";
			$result = mysql_query($select);
			$rows = mysql_fetch_array($result);
			
			if($_REQUEST['txt_cdate'] != $rows['c_date'])
			{
				if(mysql_num_rows($result))
				{
					
					$a = $rows['present'] + 1;
					$absent = $total_days - $a;
					$net_salary = $per_day_salary * $a;
					
					$update = "update attendance set emp_id = '$veid',emp_name = '$vemp',total_days = '$total_days',c_date = '$vdate',present = '$a',absent = '$absent',salary_id = '$salary',net_salary = '$net_salary' where emp_id = '$vempid'";
					mysql_query($update);
					echo "<script>alert('Updated Attendance')</script>";			
				}
				else
				{	
					$insert = "insert into attendance(emp_id,emp_name,total_days,c_date,present,absent,salary_id,net_salary) values('$veid','$vemp','$total_days','$vdate','$present','$absent','$salary','$net_salary')";
					mysql_query($insert);
					echo "<script>alert('Inserted Attendance')</script>";			
				}
			}
			else
			{
				echo "<script>alert('Already Exist Your Attendance of $vdate ')</script>";
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

	<div id="name">Welcome -&nbsp;<b class="user"><?php echo $vuser ?></b>&nbsp;</div>
	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="ac_home.php">Home</a></li>
			<li><a href="attendance.php" class="active">Attendance</a></li>
			<li><a href="profit.php">Profit</a></li>
			<li><a href="ac_profile.php">View Profile</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Attendance</h2>
		<br /><br />
		<center>
			<form method="post">
			<?php
				
			?>
				<table align="center" border="0" width="470px" height="180px">
					<tr>
						<th>Employee ID</th>
						<td><input type="text" name="txt_eid" value="<?php echo $row['ac_emp_id'] ?>" class="input" readonly="true" /></td>
					</tr>
					<tr>
						<th>Employee Name</th>
						<td><input type="text" name="txt_emp" value="<?php echo $row['username'] ?>" class="input" readonly="true" /></td>
					</tr>
					<tr>
						<th>Current Date</th>
						<td><input type="text" name="txt_cdate" value="<?php echo $date ?>" class="input" readonly="true" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="Submit" name="btn_submit" value="Submit" class="btn" /></td>
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