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


	<form>
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
		<a href="backup_attendance.php"><div class="submenu select">Backup Attendance</div></a>
		
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">ENTER PATH TO SAVE BACK UP</h2>
		<br /><br />
		<center>
		<?php
			if(isset($_REQUEST['tab']))
			{
			$t_name = $_POST['tab'];

			$backupFile ="$_POST[back]"."$_POST[tab]".".doc";
	
			$query = "SELECT * INTO OUTFILE '$backupFile' FROM $t_name";

			$r = mysql_query($query);
			/*while($f=mysql_fetch_field($r))
			{
				$h = $f->emp_name."\t"; 
			}*/
			
				echo "<script>alert('back up is created')</script>";
			//header("location:backup_attendance.php");
			}
		?>
			<form method="post">
		
				<table>
					<tr>					
						<td>
							<select name="tab" class="input">
								<option value="attendance">attendance</option>
							</select>
						</td>
					
				
					
						PATH : Ex: D:/
						<td><input type="text" name="back" value="D:/" class="input" size="20"> </td> 
						<td><input type="submit" name="backup" value="Back up" class="btn"></td>
					
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