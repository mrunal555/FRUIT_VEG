<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		$sel = "select * from pak_reg join country on country.c_id = pak_reg.c_id join state on state.s_id = pak_reg.s_id join city on city.ct_id = purchase_reg.ct_id where username = '$vuser'";
		$res = mysql_query($pak_reg);
		$rows = mysql_fetch_array($res);
		
		if(isset($_REQUEST['btn_update']))
		{
			$vuser = $_SESSION['user'];
			$vfnm = $_REQUEST['txt_fnm'];
			$vlnm = $_REQUEST['txt_lnm'];
			//$vunm = $_REQUEST['txt_unm'];
			//$vpwd = $_REQUEST['txt_pwd'];
			$vadd = $_REQUEST['txt_address'];
			$vcountry = $_REQUEST['txt_country'];
			$vstate = $_REQUEST['txt_state'];
			$vcity = $_REQUEST['txt_city'];
			//$vgender = $_REQUEST['txt_gender'];
			$vmob = $_REQUEST['txt_mob'];
			$vemail = $_REQUEST['txt_email'];
			$vdob = $_REQUEST['txt_dob'];
			
			$update = "update pak_reg set fname = '$vfnm',lname = '$vlnm',address = '$vadd',c_id = '$vcountry',s_id = '$vstate',ct_id = '$vcity',contact = '$vmob',e_mail = '$vemail',dob = '$vdob' where username = '$vuser'";
			mysql_query($update);
			header("location:pak_profile.php");
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
<title>Nut ERP</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="default.css" />

<script type="text/javascript">
		
		function showstate(str)
		{
			var abc=null;
			//alert(str);
			//browser set
			if(window.XMLHttpRequest)  /* for all browser*/
			{
				abc = new XMLHttpRequest();
			}
			else if(window.ActiveXObject) /* for IE */
			{
				abc = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			//ajax logic with open page
			abc.open("GET","country_ajax.php?con="+str,true);
			abc.send();
			
			//set XMLHTTPRequest object property
			
			abc.onreadystatechange=function()
			{
				if(abc.readyState==4)
				{
					document.getElementById("state").innerHTML=abc.responseText;
				}
			
			}
	
		}
		
		function showcity(str)
		{
			var abc=null;
			//alert(str);
			//browser set
			if(window.XMLHttpRequest)  /* for all browser*/
			{
				abc = new XMLHttpRequest();
			}
			else if(window.ActiveXObject) /* for IE */
			{
				abc = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			//ajax logic with open page
			abc.open("GET","country_ajax.php?st="+str,true);
			abc.send();
			
			//set XMLHTTPRequest object property
			
			abc.onreadystatechange=function()
			{
				if(abc.readyState==4)
				{
					document.getElementById("city").innerHTML=abc.responseText;
				}
			
			}
	
		}
		
</script>

</head>
<body>

<div id="upbg"></div>

<div id="outer">


	<div id="header">
		<div id="headercontent">
			<h1>Nut ERP</h1>
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
			<li><a href="pak_home.php">Home</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="pak_profile.php" class="active">View Profile</a></li>
			<li><a href="product_master.php">Product Master</a></li>
			<li><a href="sub_product_master.php">Sub Product Master</a></li>
			<li><a href="pak_entry.php">Product Entry</a></li>
			<li><a href="view_pak_entry.php">View Product Entry</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Edit Profile</h2>
		<br /><br />
		<center><form method="post">
			<table align="center" border="0" width="400px" height="400px" cellpadding="0" cellspacing="0">
				<tr>
					<th>First Name</th>
					<td align="center"><input type="text" name="txt_fnm" class="input" value="<?php echo $rows['fname'] ?>" /></td>
				</tr>
				<tr>
					<th>Last Name</th>
					<td align="center"><input type="text" name="txt_lnm" class="input" value="<?php echo $rows['lname'] ?>" /></td>
				</tr>
				<tr>
					<th>Address</th>
					<td align="center"><input type="text" name="txt_address" class="input" value="<?php echo $rows['address'] ?>" /></td>
				</tr>
				<tr>
					<th>Country</th>
					<td align="center">
					<select name="txt_country" class="input" id="country" onchange="showstate(this.value)">
						<option value="<?php echo $rows['c_id'] ?>"><?php echo $rows['country'] ?></option>
						<?php
							$sel="select * from country";
							$res=mysql_query($sel);
							while($row=mysql_fetch_array($res))
							{
							?>
							<option value="<?php echo $row['c_id'] ?>"><?php echo $row['country'] ?></option>
							<?php
							}
						?>
					
					</select>
					</td>
				</tr>
				<tr>
					<th>State</th>
					<td align="center">
						<select name="txt_state" class="input" id="state" onchange="showcity(this.value)">
							<option value="<?php echo $rows['fname'] ?>"><?php echo $rows['state'] ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th>City</th>
					<td align="center">
						<select name="txt_city" class="input" id="city">
							<option value="<?php echo $rows['ct_id'] ?>"><?php echo $rows['city'] ?></option>
						</select>
					</td>
				</tr>
				<!--<tr>
					<th>Gender</th>
					<td align="center">
						<input type="radio" name="txt_gender" value="male" />&nbsp;Male
						&nbsp;&nbsp;<input type="radio" name="txt_gender" value="female" />&nbsp;Female
					</td>
				</tr>-->
				<tr>
					<th>Contact No.</th>
					<td align="center"><input type="text" name="txt_mob" class="input" value="<?php echo $rows['contact'] ?>" /></td>
				</tr>
				<tr>
					<th>E-mail</th>
					<td align="center"><input type="text" name="txt_email" class="input" value="<?php echo $rows['e_mail'] ?>" /></td>
				</tr>
				<tr>
					<th>Date Of Birth</th>
					<td align="center"><input type="text" name="txt_dob" class="input" value="<?php echo $rows['dob'] ?>" /></td>
				</tr>
			</table>
			<table style="margin-top:10px;">
					<tr>
						<td align="center"><input type="submit" name="btn_update" class="btn" value="Update" /></a></td>
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
<?php
	}
	else
	{
		echo"<script>alert('Please First Login')</script>";
	}
?>