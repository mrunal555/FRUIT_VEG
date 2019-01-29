<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['btn_submit']))
		{
			$vproduct = $_REQUEST['txt_select'];
			$vsub = $_REQUEST['txt_sub'];
			
			$insert = "insert into sub_product(p_id,sub_product) values('$vproduct','$vsub')";
			mysql_query($insert);
			header("location:sub_product_master.php");
		}
		
		if(isset($_REQUEST['spid']))
		{
			$vspid = $_REQUEST['spid'];
			
			$del = "delete from sub_product where sp_id = '$vspid'";
			mysql_query($del);
			header("location:sub_product_master.php");
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
			<li><a href="purchase_home.php">Home</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="purchase_profile.php">View Profile</a></li>
			<li><a href="product_master.php">Product Master</a></li>
			<li><a href="sub_product_master.php" class="active">Sub Product Master</a></li>
			<li><a href="product_entry.php">Product Entry</a></li>
			<li><a href="view_product_entry.php">View Product Entry</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Sub Product Master</h2>
		<br /><br />
		<center>
		<form method="post">
			<table align="center" border="0" width="370px" height="130px">
				<tr>
					<th>Product</th>
					<td align="center">
						<select name="txt_select" class="input">
							<option selected="selected">--Select--</option>
							<?php
								$sel = "select * from product";
								$res = mysql_query($sel);
								while($row=mysql_fetch_array($res))
								{
							?>
							<option value="<?php echo $row['p_id'] ?>"><?php echo $row['product'] ?></option>
							<?php
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Sub Product</th>
					<td align="center"><input type="text" name="txt_sub" class="input" /></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" name="btn_submit" value="Submit" class="btn" /></td>
				</tr>
			</table>
		</form>
		<br /><br />
		<div class="section">Sub Product Detail</div>
		<br />
		<!--<h2 align="center">Sub Product Detail</h2>-->
		
		<form method="post">
			<table align="center" border="1" cellpadding="0" cellspacing="0" width="30%" style="text-align:center;">
				<tr class="tr_th">
					<th>Sr No.</th>
					<th>Product</th>
					<th>Sub Product</th>
					<th colspan="2" align="center">Action</th>
				</tr>
				<?php
					$i = 1;
					$sel = "select * from sub_product join product on product.p_id = sub_product.p_id";
					$res = mysql_query($sel);
					
					while($row=mysql_fetch_array($res))
					{					
				?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['product'] ?></td>
						<td><?php echo $row['sub_product'] ?></td>
						
						<td><a href="sub_product_master.php?spid=<?php echo $row['sp_id'] ?>" onclick="return confirm('Are You Sure Want to Delete')"><img src="images/delete.png" title="Delete" class="icon" /></a></td>
						<td><a href="sub_product_update.php?sp_eid=<?php echo $row['sp_id'] ?>"><img src="images/edit.png" title="Edit" class="icon" /></a></td>
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