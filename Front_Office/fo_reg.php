<?php
	ob_start();
	include("con1.php");
	
	if(isset($_REQUEST['btn_submit']))
	{
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
		
		$insert = "insert into fo_reg(fname,lname,username,password,address,c_id,s_id,ct_id,gender,contact,e_mail,dob) values('$vfnm','$vlnm','$vunm','$vpwd','$vadd','$vcountry','$vstate','$vcity','$vgender','$vmob','$vemail','$vdob')";
		mysql_query($insert);
		header("location:index.php");
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
			<li><a href="fo_reg.php" class="active">Registration</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Registration</h2>
		<br /><br />
		<center><form method="post">
			<table align="center" height="350px" width="320px">
				<tr>
					<td>First Name</td>
					<td><input type="text" name="txt_fnm" /></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><input type="text" name="txt_lnm" /></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="txt_unm" /></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="txt_pwd" /></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="txt_address" /></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>
					<select name="txt_country" id="country" onchange="showstate(this.value)">
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
				<tr>
					<td>State</td>
					<td>
						<select name="txt_state" id="state" onchange="showcity(this.value)">
							<option value="" selected="selected">--Select State--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>City</td>
					<td>
						<select name="txt_city" id="city">
							<option value="" selected="selected">--Select City--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>
						<input type="radio" name="txt_gender" value="male" />&nbsp;Male
						&nbsp;&nbsp;<input type="radio" name="txt_gender" value="female" />&nbsp;Female
					</td>
				</tr>
				<tr>
					<td>Contact No.</td>
					<td><input type="text" name="txt_mob" /></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><input type="text" name="txt_email" /></td>
				</tr>
				<tr>
					<td>Date Of Birth</td>
					<td><input type="date" name="txt_dob" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="btn_submit" value="Submit" /></td>
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