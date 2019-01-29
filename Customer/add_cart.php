<?php
	ob_start();
	include("con1.php");
	session_start();
	error_reporting(0);
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['cart_id']))
		{
			$pid=$_REQUEST['cart_id'];
			$select = "select * from product_entry where pe_id = '$pid'";
			$result = mysql_query($select);
			$match = mysql_fetch_array($result);
			if($match['quantity'] == 0)
			{
				echo "<script>alert('This Product is Out Of Stock')</script>";
			}
			else
			{
				
				if(isset($_SESSION['cart']))
				{
					$cart=$_SESSION['cart'];
				}
				else
				{
					$cart=array();
				}
				
				if(isset($cart[$pid]))
				{
					$cart[$pid]++;
				}
				else
				{
					$cart[$pid]=1;
				}
				
				$_SESSION['cart']=$cart;
				
				//print_r($cart);
			
			}
		}
		
		$date = date('Y-M-d');
		
		
		if(isset($_REQUEST['btn_buy']))
		{
			$vunm = $_REQUEST['txt_nm'];
			$vadd = $_REQUEST['txt_add'];
			$vcontact = $_REQUEST['txt_contact'];
			$vemail = $_REQUEST['txt_email'];
			$cdate = $_REQUEST['txt_date'];
			$bill = $_REQUEST['txt_bill'];
			
				
			foreach($_SESSION['cart'] as $key=>$value)
            {
				 		 
				 $row = mysql_query("select * from product_entry where pe_id = $key") or die(mysql_error());
				 while($rows=mysql_fetch_array($row))
				 {
				 	$a = $rows['sale_price'];
					$qty = 	$rows['quantity'] - $value;	
					$status = Unpaid;
							 
				 }
				 $insert = "insert into buy(name,bill_no,address,contact,e_mail,c_date,pe_id,b_quantity,b_price,status) values('$vunm','$bill','$vadd','$vcontact','$vemail','$cdate','$key','$value','$a','$status')";
				mysql_query($insert);
				
				$update = "update product_entry set quantity = '$qty' where pe_id = $key";
				mysql_query($update);
				
			}	
					
			echo "<script>alert('Successfully Purchase Your Shopping Cart')</script>";
		}

	$price=0;
	$total=0;
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


	<form>
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
			<li><a href="add_cart.php" class="active">My Shopping Cart</a></li>
			<li><a href="my_order.php">My Shopping Order</a></li>
			<li><a href="all_purchase.php">My All Purchase</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Shopping Cart</h2>
		<br /><br />
			<center>
			<form method="post">
				<table align="center" width="60%" height="130px" style="margin-bottom:20px;">
					<tr>
						<th>Name</th>
						<td align="center"><input type="text" name="txt_nm" value="<?php echo $vuser ?>" class="input" required="required" placeholder="Enter Your Name" /></td>
						<th>Address</th>
						<td align="center"><input type="text" name="txt_add" class="input" required="required" placeholder="Enter Your Address" /></td>
					</tr>
					<tr>
						<th>Contact</th>
						<td align="center"><input type="text" name="txt_contact" class="input" required="required" placeholder="Enter Your Contact" /></td>
						<th>E-mail</th>
						<td align="center"><input type="text" name="txt_email" class="input" required="required" placeholder="Enter Your E-mail" /></td>
					</tr>
					<tr>
						<th>Date</th>
						<td align="center"><input type="text" name="txt_date" value="<?php echo $date ?>" class="input" readonly="true" /></td>
						<?php
							$b = 1;
							$select = "select * from buy";
							$result = mysql_query($select);
							while($roww = mysql_fetch_array($result))
							{
								$b = $roww['bill_no'] + 1;
							}
						?>
						<th>Bill No</th>
						<td align="center"><input type="text" name="txt_bill" value="<?php echo $b ?>" class="input" readonly="true" /></td>
					</tr>
				</table>
				<table border="1" width="80%" cellpadding="0" cellspacing="0" align="center">
					<tr class="tr_th">
						<th>Sr No</th>
						<th>Product Name</th>
						<th>Quantity&nbsp;(Kg.)</th>
						<th width="20%">Price&nbsp;(Rs)</th>
						<th colspan="3">Action</th>
					</tr>
					<?php
						$i = 1;
						foreach($_SESSION['cart'] as $key=>$value)
						{
							$sel = "select * from product_entry join product on product.p_id = product_entry.p_id join sub_product on sub_product.sp_id = product_entry.sp_id where pe_id = '$key'";
							$res = mysql_query($sel);
							
							while($row=mysql_fetch_array($res))
							{
								$price = $row['sale_price'] * $value;
								
							?>
								<tr align="center" height="40px">
									<td><?php echo $i++ ?></td>
									<td><?php echo $row['product'] ?>&nbsp;<?php echo $row['sub_product'] ?></td>
									<td><?php echo $value ?></td>
									<td><?php echo $price ?>.00</td>
									<td><a href="update_cart.php?uppid=<?php echo $key ?>" class="a"><div class="buy">Quantity + 1</div></a></td>
									<td><a href="update_cart.php?umpid=<?php echo $key ?>" class="a"><div class="buy">Quantity - 1</div></a></td>
									<td><a href="update_cart.php?remove=<?php echo $key ?>" class="a"><div class="buy">Remove</div></a></td>
								</tr>
							<?php
							}	
							$total = $total + $price;
						}
						
					?>
					<tr align="center" style="height:50px;">
						<th colspan="3" class="tr_th">Grand Total</th>
						<td><b><?php echo $total ?>.00</b></td>
						<td colspan="3"><input type="submit" name="btn_buy" value="Buy" class="btn" /></td>
						<!--<td colspan="3"><a href="" class="a"><div class="buy">Buy</div></a></td>-->
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