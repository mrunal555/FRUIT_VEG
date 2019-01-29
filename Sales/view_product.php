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
			<li><a href="sales_home.php">Home</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="view_product.php" class="active">View Product</a></li>
			<li><a href="customer_buy.php">Customer Purchase</a></li>
			<li><a href="sales_profile.php">View Profile</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">View Product</h2>
		<br /><br />
		<center>
			<form method="post">
			<table align="center" border="1" cellpadding="0" cellspacing="0" width="100%" style="text-align:center;z-index:-500;">
				<tr class="tr_th">
					<th>Sr No.</th>
					<th>Saller Name</th>
					<th>Product</th>
					<th>Sub Product</th>
					<th>Image</th>
					<th>Quantity (In Kg)</th>
					<th>Price (per Kg)</th>
					<th>Salling Price</th>
					<th>Total Price</th>
					<th>Date<br />(&nbsp;yyyy-mm-dd&nbsp;)</th>
					
				</tr>
				<?php
					$i = 1;
					$sel = "select * from product_entry join product on product.p_id = product_entry.p_id join sub_product on sub_product.sp_id = product_entry.sp_id";
					$res = mysql_query($sel);
					
					while($row=mysql_fetch_array($res))
					{
							//$grand_total = $row['total_price'];
							//echo $grand_total;				
				?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['saller'] ?></td>
						<td><?php echo $row['product'] ?></td>
						<td><?php echo $row['sub_product'] ?></td>
						<td style="padding-top:3px;"><img src="<?php echo $row['image_name'] ?>" height="30px" width="30px" style="border:0px;" /></td>
						<td><?php echo $row['quantity'] ?></td>
						<td><?php echo $row['price'] ?></td>
						<td><?php echo $row['sale_price'] ?></td>
						<td><?php echo $row['total_price'] ?></td>
						<td><?php echo $row['date'] ?></td>
						
					</tr>
				<?php
					}
				?>
			</table>
			<!--<div id="imgg"><img src="images/delete.png" title="Delete" width="100%" height="100%" /></div>-->
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