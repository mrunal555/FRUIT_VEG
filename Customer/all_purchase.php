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
			<li><a href="my_order.php">My Shopping Order</a></li>
			<li><a href="all_purchase.php" class="active">My All Purchase</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		
		<form method="post">
		<h2 align="center">My All Purchase Detail</h2>
		<br /><br />
		
		<center>
			<!-- Search Option -->
			
			<table align="center">
				<tr>
					<td><input type="text" name="txt_search" class="input" placeholder="Enter Bill No (Only Digit)" required="required" /></td>
					<td><input type="submit" name="btn_search" value="Search" class="btn" /></td>
				</tr>
			</table>
			<br />
			<?php
				
				if(isset($_REQUEST['btn_search']))
				{
					
			?>
				<table border="1" width="100%" cellpadding="0" cellspacing="0" align="center">
					<tr align="center" class="tr_th">
						<th width="3%">Sr No</th>
						<th width="5%">Bill No</th>
						
						<th>Address</th>
						<th>Contact</th>
						<th width="17%">E-Mail</th>
						<th>Date</th>
						<th width="9%">Product Name</th>
						<th width="6%">Quantity<br />(Kg.)</th>
						<th>Price<br />(Per Qty)</th>
						<th width="13%">Total Price<br />(Rs)</th>
						<th width="9%">Status</th>
						
					</tr>
				<?php
					$i = 1;
					$vsearch = $_REQUEST['txt_search'];
					$sel = "select * from buy join product_entry on product_entry.pe_id = buy.pe_id join sub_product on sub_product.sp_id = Product_entry.sp_id join product on product.p_id = sub_product.p_id where bill_no LIKE '%$vsearch%' and name = '$vuser'";
					$res = mysql_query($sel);
					while($row = mysql_fetch_array($res))
					{
						$total = $row['b_quantity'] * $row['b_price'];
				?>
				<tr align="center">
						<td><?php echo $i++ ?></td>
						<td style="color:#666600;font-weight:bold;">B00<?php echo $row['bill_no'] ?></td>
						
						<td width="17%"><?php echo $row['address'] ?></td>
						<td width="8%"><?php echo $row['contact'] ?></td>
						<td><?php echo $row['e_mail'] ?></td>
						<td width="8%"><?php echo $row['c_date'] ?></td>
						<td><?php echo $row['product'] ?>&nbsp;<?php echo $row['sub_product'] ?></td>
						<td><?php echo $row['b_quantity'] ?></td>
						<td width="8%">Rs.&nbsp;<?php echo $row['b_price'] ?>.00</td>
						<td>Rs.&nbsp;<?php echo $total ?>.00</td>
						<td style="font-weight:bold;color:#FFFFFF;background-color:#666600;"><?php echo $row['status'] ?></td>
					</tr>
				<?php
						$grand_total = $grand_total + $total;
					}
					?>
					<tr align="center">
						<td colspan="6"></td>
						<th align="center" colspan="3" class="tr_th">Grand Total</th>
						<th>Rs.&nbsp;<?php echo $grand_total ?>.00</th>
						<th></th>
					</tr>
				</table>
				<?php
					}
					else
					{
				?>
						
			<!-- Search Option -->
			
			<br />
				<table border="1" width="100%" cellpadding="0" cellspacing="0" align="center">
					<tr align="center" class="tr_th">
						<th width="3%">Sr No</th>
						<th width="5%">Bill No</th>
						
						<th>Address</th>
						<th>Contact</th>
						<th width="17%">E-Mail</th>
						<th>Date</th>
						<th width="9%">Product Name</th>
						<th width="6%">Quantity<br />(Kg.)</th>
						<th>Price<br />(Per Qty)</th>
						<th width="13%">Total Price<br />(Rs)</th>
						<th width="9%">Status</th>
						
					</tr>
					<?php
					$i = 1;
					
					$sel = "select * from buy join product_entry on product_entry.pe_id = buy.pe_id join sub_product on sub_product.sp_id = Product_entry.sp_id join product on product.p_id = sub_product.p_id where name = '$vuser' ORDER BY bill_no ASC";
					$res = mysql_query($sel);
					while($row = mysql_fetch_array($res))
					{
						$total = $row['b_quantity'] * $row['b_price'];
					?>
					<tr align="center">
						<td><?php echo $i++ ?></td>
						<td>B00<?php echo $row['bill_no'] ?></td>
						
						<td width="17%"><?php echo $row['address'] ?></td>
						<td width="8%"><?php echo $row['contact'] ?></td>
						<td><?php echo $row['e_mail'] ?></td>
						<td width="8%"><?php echo $row['c_date'] ?></td>
						<td><?php echo $row['product'] ?>&nbsp;<?php echo $row['sub_product'] ?></td>
						<td><?php echo $row['b_quantity'] ?></td>
						<td width="8%">Rs.&nbsp;<?php echo $row['b_price'] ?>.00</td>
						<td>Rs.&nbsp;<?php echo $total ?>.00</td>
						<td style="font-weight:bold;color:#FFFFFF;background-color:#666600;"><?php echo $row['status'] ?></td>
					</tr>
					<?php
						$grand_total = $grand_total + $total;
					}
					?>
					<tr align="center">
						<td colspan="6"></td>
						<th align="center" colspan="3" class="tr_th">Grand Total</th>
						<th>Rs.&nbsp;<?php echo $grand_total ?>.00</th>
						<th></th>
					</tr>
				</table>
				<?php
					}
				?>
		</center>
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