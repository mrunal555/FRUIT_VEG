<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		$sel = "select * from customer_reg join country on country.c_id = customer_reg.c_id join state on state.s_id = customer_reg.s_id join city on city.ct_id = customer_reg.ct_id where username = '$vuser'";
		$res = mysql_query($sel);
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
			
			$update = "update customer_reg set fname = '$vfnm',lname = '$vlnm',address = '$vadd',c_id = '$vcountry',s_id = '$vstate',ct_id = '$vcity',contact = '$vmob',e_mail = '$vemail',dob = '$vdob' where username = '$vuser'";
			mysql_query($update);
			header("location:cust_profile.php");
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

	<div id="name">Welcome -&nbsp;<b class="user"><?php echo $vuser ?></b>&nbsp;</div>
	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="cust_home.php">Home</a></li>
			<li><a href="cust_profile.php" class="active">View Profile</a></li>
			<li><a href="view_product.php">View Product</a></li>
			<li><a href="add_cart.php">My Shopping Cart</a></li>
			<li><a href="my_order.php">My Shopping Order</a></li>
			<li><a href="all_purchase.php">My All Purchase</a></li>
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
					<td align="center"><input type="text" name="txt_fnm" value="<?php echo $rows['fname'] ?>" class="input" /></td>
				</tr>
				<tr>
					<th>Last Name</th>
					<td align="center"><input type="text" name="txt_lnm" value="<?php echo $rows['lname'] ?>" class="input" /></td>
				</tr>
				<tr>
					<th>Address</th>
					<td align="center"><input type="text" name="txt_address" value="<?php echo $rows['address'] ?>" class="input" /></td>
				</tr>
				<tr>
					<th>Country</th>
					<td align="center">
					<select name="txt_country" id="country" class="input" onchange="showstate(this.value)">
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
						<select name="txt_state" id="state" class="input" onchange="showcity(this.value)">
							<option value="<?php echo $rows['fname'] ?>"><?php echo $rows['state'] ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th>City</th>
					<td align="center">
						<select name="txt_city" id="city" class="input">
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
					<td align="center"><input type="text" name="txt_mob" value="<?php echo $rows['contact'] ?>" class="input" /></td>
				</tr>
				<tr>
					<th>E-mail</th>
					<td align="center"><input type="text" name="txt_email" value="<?php echo $rows['e_mail'] ?>" class="input" /></td>
				</tr>
				<tr>
					<th>Date Of Birth</th>
					<td align="center"><input type="text" name="txt_dob" value="<?php echo $rows['dob'] ?>" class="input" /></td>
				</tr>
			</table>
			<table style="margin-top:10px;">
					<tr>
						<td align="center"><input type="submit" name="btn_update" value="Update" class="btn" /></a></td>
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