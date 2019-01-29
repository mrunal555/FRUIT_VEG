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
			<li><a href="ac_home.php">Home</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="profit.php" class="active">Profit</a></li>
			<li><a href="ac_profile.php">View Profile</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Bussiness Profit</h2>
		<br /><br />
		<center>
			<form method="post">
				<!-- Search Option -->
			
			<table align="center">
				<tr>
					<td><input type="text" name="txt_search" class="input" placeholder="Enter Date (YYYY-MMM-DD)" required="required" /></td>
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
						<th>Customer Name</th>
						<th>Date</th>
						<th>Product Name</th>
						<th>Quantity<br />(Kg.)</th>
						<th>Purchase Price<br />(Per Qty)</th>
						<th>Salling Price<br />(Per Qty)</th>
						<th>Total Purchase<br />Price(Rs)</th>
						<th>Total Sale<br />Price(Rs)</th>
						<th>Profit</th>
						<th>Status</th>
					</tr>
					<?php
						$i = 1;
						$vsearch = $_REQUEST['txt_search'];
						$sel = "select * from buy join product_entry on product_entry.pe_id = buy.pe_id join sub_product on sub_product.sp_id = Product_entry.sp_id join product on product.p_id = sub_product.p_id  where c_date LIKE '%$vsearch%' AND status = 'paid' ORDER BY bill_no ASC";
						$res = mysql_query($sel);
						
						while($row = mysql_fetch_array($res))
						{
							$Total_Purchase_Prise = $row['b_quantity'] * $row['price'];
							$Total_Sale_Prise = $row['b_quantity'] * $row['sale_price'];
							$profit = $Total_Sale_Prise - $Total_Purchase_Prise;
					?>
					<tr align="center">
						<td><?php echo $i++ ?></td>
						<td>B00<?php echo $row['bill_no'] ?></td>
						<td><?php echo $row['name'] ?></td>
						<td style="background-color:#990000;color:#FFFFFF"><?php echo $row['c_date'] ?></td>
						<td><?php echo $row['product'] ?>&nbsp;<?php echo $row['sub_product'] ?></td>
						<td><?php echo $row['b_quantity'] ?></td>
						<td style="background-color:#FF3300;color:#FFFFFF"><?php echo $row['price'] ?></td>
						<td style="background-color:#666600;color:#FFFFFF"><?php echo $row['sale_price'] ?></td>
						<td style="background-color:#FF3300;color:#FFFFFF">Rs.&nbsp;<?php echo $Total_Purchase_Prise ?></td>
						<td style="background-color:#666600;color:#FFFFFF">Rs.&nbsp;<?php echo $Total_Sale_Prise ?></td>
						<td style="background-color:#990000;color:#FFFFFF">Rs.&nbsp;<?php echo $profit ?></td>
						<td style="color:#0033CC;font-weight:bold;"><?php echo $row['status'] ?></td>
					</tr>
					<?php
						$Grand_P_total = $Grand_P_total + $Total_Purchase_Prise;
						$Grand_S_total = $Grand_S_total + $Total_Sale_Prise;
						$Grand_profit = $Grand_profit + $profit;
						}
						
					?>
					<tr>
						<th colspan="6"></th>
						<th colspan="2" class="tr_th">Grand Total</th>
						<th>Rs.&nbsp;<?php echo $Grand_P_total ?></th>
						<th>Rs.&nbsp;<?php echo $Grand_S_total ?></th>
						<th>Rs.&nbsp;<?php echo $Grand_profit ?></th>
						<th></th>
					</tr>
				</table>
			<?php
				}
				else
				{
			?>			
				<!-- Search Option -->
				
				<table border="1" width="100%" cellpadding="0" cellspacing="0" align="center">
					<tr align="center" class="tr_th">
						<th width="3%">Sr No</th>
						<th width="5%">Bill No</th>
						<th>Customer Name</th>
						<th>Date</th>
						<th>Product Name</th>
						<th>Quantity<br />(Kg.)</th>
						<th>Purchase Price<br />(Per Qty)</th>
						<th>Salling Price<br />(Per Qty)</th>
						<th>Total Purchase<br />Price(Rs)</th>
						<th>Total Sale<br />Price(Rs)</th>
						<th>Profit</th>
						<th>Status</th>
					</tr>
					<?php
						$i = 1;
						$sel = "select * from buy join product_entry on product_entry.pe_id = buy.pe_id join sub_product on sub_product.sp_id = Product_entry.sp_id join product on product.p_id = sub_product.p_id  where status = 'paid' ORDER BY bill_no ASC";
						$res = mysql_query($sel);
						
						while($row = mysql_fetch_array($res))
						{
							$Total_Purchase_Prise = $row['b_quantity'] * $row['price'];
							$Total_Sale_Prise = $row['b_quantity'] * $row['sale_price'];
							$profit = $Total_Sale_Prise - $Total_Purchase_Prise;
					?>
					<tr align="center">
						<td><?php echo $i++ ?></td>
						<td>B00<?php echo $row['bill_no'] ?></td>
						<td><?php echo $row['name'] ?></td>
						<td><?php echo $row['c_date'] ?></td>
						<td><?php echo $row['product'] ?>&nbsp;<?php echo $row['sub_product'] ?></td>
						<td><?php echo $row['b_quantity'] ?></td>
						<td style="background-color:#FF3300;color:#FFFFFF"><?php echo $row['price'] ?></td>
						<td style="background-color:#666600;color:#FFFFFF"><?php echo $row['sale_price'] ?></td>
						<td style="background-color:#FF3300;color:#FFFFFF">Rs.&nbsp;<?php echo $Total_Purchase_Prise ?></td>
						<td style="background-color:#666600;color:#FFFFFF">Rs.&nbsp;<?php echo $Total_Sale_Prise ?></td>
						<td style="background-color:#990000;color:#FFFFFF">Rs.&nbsp;<?php echo $profit ?></td>
						<td style="color:#0033CC;font-weight:bold;"><?php echo $row['status'] ?></td>
					</tr>
					<?php
						$Grand_P_total = $Grand_P_total + $Total_Purchase_Prise;
						$Grand_S_total = $Grand_S_total + $Total_Sale_Prise;
						$Grand_profit = $Grand_profit + $profit;
						}
						
					?>
					<tr>
						<th colspan="6"></th>
						<th colspan="2" class="tr_th">Grand Total</th>
						<th style="background-color:#009900;color:#FFFFFF">Rs.&nbsp;<?php echo $Grand_P_total ?></th>
						<th style="background-color:#009900;color:#FFFFFF">Rs.&nbsp;<?php echo $Grand_S_total ?></th>
						<th style="background-color:#009900;color:#FFFFFF">Rs.&nbsp;<?php echo $Grand_profit ?></th>
						<th></th>
					</tr>
				</table>
				<?php
					}
				?>
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