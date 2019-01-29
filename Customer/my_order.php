<?php
	ob_start();
	include("con1.php");
	session_start();
	error_reporting(0);
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
			<li><a href="cust_home.php">Home</a></li>
			<li><a href="cust_profile.php">View Profile</a></li>
			<li><a href="view_product.php">View Product</a></li>
			<li><a href="add_cart.php">My Shopping Cart</a></li>
			<li><a href="my_order.php" class="active">My Shopping Order</a></li>
			<li><a href="all_purchase.php">My All Purchase</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">My Shopping Order</h2>
		<br /><br />
		<center>
			<form method="post">
				<table border="1" width="80%" cellpadding="0" cellspacing="0" align="center">
					<tr align="center" class="tr_th">
						<th>Sr No</th>
						<th>Product Name</th>
						<th>Quantity&nbsp;(Kg.)</th>
						<th>Price&nbsp;(Per Qty)</th>
						<th width="20%">Total Price&nbsp;(Rs)</th>
						
					</tr>
					<?php
					$i = 1;
					foreach($_SESSION['cart'] as $key=>$value)
						{
							$sel = "select * from product_entry join product on product.p_id = product_entry.p_id join sub_product on sub_product.sp_id = product_entry.sp_id where pe_id = '$key'";
							$res = mysql_query($sel);
							
							while($row=mysql_fetch_array($res))
							{
								$price = $row['sale_price'];
								$total_price = $value * $price;
								
								
							?>
								<tr align="center" height="40px">
									<td><?php echo $i++ ?></td>
									<td><?php echo $row['product'] ?>&nbsp;<?php echo $row['sub_product'] ?></td>
									<td><?php echo $value ?></td>
									<td><?php echo $price ?>.00</td>
									<td><?php echo $total_price ?>.00</td>
									
								</tr>
							<?php
							}	
							$grand_total = $grand_total + $total_price;
						}
						
					?>
					
					<tr align="center">
						<td colspan="3"></td>						
						<th class="tr_th">Grand Total</th>
						<th>Rs.&nbsp;<?php echo $grand_total ?>.00</th>
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