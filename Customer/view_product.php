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
			<li><a href="cust_home.php">Home</a></li>
			<li><a href="cust_profile.php">View Profile</a></li>
			<li><a href="view_product.php" class="active">View Product</a></li>
			<li><a href="add_cart.php">My Shopping Cart</a></li>
			<li><a href="my_order.php">My Shopping Order</a></li>
			<li><a href="all_purchase.php">My All Purchase</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">View Product</h2>
		<br /><br />
			<form method="post">
			
				<?php
					$i = 1;
					$sel = "select * from product_entry join product on product.p_id = product_entry.p_id join sub_product on sub_product.sp_id = product_entry.sp_id";
					$res = mysql_query($sel);
					
					while($row=mysql_fetch_array($res))
					{
											
				?>
				
				<center><div class="product_img">
				<table align="center" cellpadding="0" cellspacing="0" style="border:2px solid #000000;padding:10px;border-radius:10px;">
					<tr>
						<td><img src="../Photos/<?php echo $row['image_name'] ?>" height="200px" width="200px" style="border:0px;" /></td>
					</tr>
					<tr>
						<td align="center"><b><?php echo $row['product'] ?>&nbsp;<?php echo $row['sub_product'] ?></b></td>
					</tr>
					<tr>
						<td align="center" style="color:#FF0000;"><b>Rs.&nbsp;<?php echo $row['sale_price'] ?>.00</b></td>
					</tr>
					<tr>
						<td align="center"><a href="add_cart.php?cart_id=<?php echo $row['pe_id'] ?>" class="a"><div class="buy">Add To Cart</div></a></td>
					</tr>
				</table>
			</div></center>
					
				<?php
					}
					
				?>
			</table>
			<!--<div id="imgg"><img src="images/delete.png" title="Delete" width="100%" height="100%" /></div>-->
		</form>
		
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