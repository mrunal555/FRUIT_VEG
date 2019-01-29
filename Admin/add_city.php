<?php
	ob_start();
	include("connection.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['btn_submit']))
		{
			$vstate = $_REQUEST['txt_state'];
			$vcity = $_REQUEST['txt_city'];
			
			$insert = "insert into city(s_id,city) values('$vstate','$vcity')";
			mysql_query($insert);
			header("location:add_city.php");
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
			<li><a href="admin_home.php">Home</a></li>
			<li><a href="customer_detail.php">View Report</a></li>
			<li><a href="view_product.php">Purchase</a></li>
			<li><a href="customer_purchase.php">Sales</a></li>
			<li><a href="profit.php">Account</a></li>
			<li><a href="backup_attendance">HR</a></li>
			<li><a href="add_country.php">Add Country</a></li>
			<li><a href="add_state.php">Add State</a></li>
			<li><a href="add_city.php" class="active">Add City</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">City Master</h2>
		<br /><br />
		<center>
		<form method="post">
			<table align="center" border="0" width="370px" height="200px">
				<tr>
					<th>Country</th>
					<td align="center">
						<select name="txt_country" class="input" onchange="showstate(this.value)">
							<option selected="selected">--Select--</option>
							<?php
								$sel = "select * from country";
								$res = mysql_query($sel);
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
						<select name="txt_state" id="state" class="input">
							<option selected="selected">--Select--</option>							
						</select>
					</td>
				</tr>
				<tr>
					<th>City</th>
					<td align="center"><input type="text" name="txt_city" class="input" /></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" name="btn_submit" value="Submit" class="btn" /></td>
				</tr>
			</table>
		</form>
		<br /><br />
		<div class="section">City Detail</div>
		<br />
		<!--<h2 align="center">Sub Product Detail</h2>-->
		
		<form method="post">
			<table align="center" border="1" cellpadding="0" cellspacing="0" width="30%" style="text-align:center;">
				<tr class="tr_th">
					<th>Sr No.</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th colspan="2" align="center">Action</th>
				</tr>
				<?php
					$i = 1;
					$sel = "select * from state join country on country.c_id = state.c_id join city on city.s_id = state.s_id";
					$res = mysql_query($sel);
					
					while($row=mysql_fetch_array($res))
					{					
				?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['country'] ?></td>
						<td><?php echo $row['state'] ?></td>
						<td><?php echo $row['city'] ?></td>
						
						<td><a href=""><img src="images/delete.png" title="Delete" class="icon" /></a></td>
						<td><a href=""><img src="images/edit.png" title="Edit" class="icon" /></a></td>
					</tr>
				<?php
					}
				?>
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