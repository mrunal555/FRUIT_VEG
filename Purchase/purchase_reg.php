<?php
	ob_start();
	include("con1.php");
	
	if(isset($_REQUEST['btn_submit']))
	{
		$vemp = $_REQUEST['txt_emp'];
		$vfnm = $_REQUEST['txt_fnm'];
		$vlnm = $_REQUEST['txt_lnm'];
		$vunm = $_REQUEST['txt_unm'];
		$vpwd = $_REQUEST['txt_pwd'];
		$vadd = $_REQUEST['txt_address'];
		$vcountry = $_REQUEST['txt_country'];
		$vstate = $_REQUEST['txt_state'];
		$vcity = $_REQUEST['txt_city'];
		$vgender = $_REQUEST['txt_gender'];
		$vmob = $_REQUEST['txt_mob'];
		$vemail = $_REQUEST['txt_email'];
		$vdob = $_REQUEST['txt_dob'];
		
		$insert = "insert into purchase_reg(pr_emp_id,fname,lname,username,password,address,c_id,s_id,ct_id,gender,contact,e_mail,dob) values('$vemp','$vfnm','$vlnm','$vunm','$vpwd','$vadd','$vcountry','$vstate','$vcity','$vgender','$vmob','$vemail','$vdob')";
		mysql_query($insert);
		header("location:index.php");
		
		/*
		$table = "CREATE TABLE `$vemp` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`emp_name` VARCHAR( 100 ) NOT NULL ,
				`in_time` VARCHAR( 100 ) NOT NULL ,
				`out_time` VARCHAR( 100 ) NOT NULL ,
				`current_date` DATE NOT NULL
				) ENGINE = INNODB";
		mysql_query($table);*/
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
			<li><a href="index.php">Login</a></li>
			<li><a href="purchase_reg.php" class="active">Registration</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Purchase Registration</h2>
		<br /><br />
		<center><form method="post">
			<table align="center" height="600px" width="36%" style="border:2px solid #000000;padding-top:10px;border-radius:10px;">
				<tr align="center">
					<th>Employee ID</th>
					<?php
						$sel = "select * from purchase_reg";
						$res = mysql_query($sel);
						$a=1;
						while($row = mysql_fetch_array($res))
						{
							$a = $row['pr_id']+1;
						}
							
					?>
					<td><input type="text" name="txt_emp" class="input" value="PR00<?php echo $a ?>" readonly="true" /></td>
			
				</tr>
				<tr align="center">
					<th>First Name</td>
					<td><input type="text" name="txt_fnm" class="input" /></td>
				</tr>
				<tr align="center">
					<th>Last Name</td>
					<td><input type="text" name="txt_lnm" class="input" /></td>
				</tr>
				<tr align="center">
					<th>Username</td>
					<td><input type="text" name="txt_unm" class="input" /></td>
				</tr>
				<tr align="center">
					<th>Password</td>
					<td><input type="password" name="txt_pwd" class="input" /></td>
				</tr>
				<tr align="center">
					<th>Address</td>
					<td><input type="text" name="txt_address" class="input" /></td>
				</tr>
				<tr align="center">
					<th>Country</td>
					<td>
					<select name="txt_country" id="country" class="input" onchange="showstate(this.value)">
						<option value="" selected="selected">--Select Country--</option>
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
				<tr align="center">
					<th>State</td>
					<td>
						<select name="txt_state" id="state" class="input" onchange="showcity(this.value)">
							<option value="" selected="selected">--Select State--</option>
						</select>
					</td>
				</tr>
				<tr align="center">
					<th>City</td>
					<td>
						<select name="txt_city" id="city" class="input">
							<option value="" selected="selected">--Select City--</option>
						</select>
					</td>
				</tr>
				<tr align="center">
					<th>Gender</td>
					<td>
						<input type="radio" name="txt_gender" value="male" />&nbsp;Male
						&nbsp;&nbsp;<input type="radio" name="txt_gender" value="female" />&nbsp;Female
					</td>
				</tr>
				<tr align="center">
					<th>Contact No.</td>
					<td><input type="text" name="txt_mob" class="input" /></td>
				</tr>
				<tr align="center">
					<th>E-mail</td>
					<td><input type="text" name="txt_email" class="input" /></td>
				</tr>
				<tr align="center">
					<th>Date Of Birth</td>
					<td><input type="date" name="txt_dob" class="input" /></td>
				</tr>
				<tr align="center">
					<td colspan="2" align="center"><input type="submit" name="btn_submit" value="Submit" class="btn" /></td>
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