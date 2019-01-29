<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['name']))
		{
			$vbill = $_REQUEST['bill_no'];
			$vdate = $_REQUEST['date'];
			$vname = $_REQUEST['name'];
			
			$sel = "select * from buy join product_entry on product_entry.pe_id = buy.pe_id join sub_product on sub_product.sp_id = Product_entry.sp_id where bill_no = '$vbill' and name = '$vname' and c_date = '$vdate'";
			$res = mysql_query($sel);
			
		
		
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

<!-- Print -->
<style type="text/css" media="print" >
           .nonPrintable{display:none;} /*class for the element we don’t want to print*/
 </style>
          <script type="text/javascript">     
        	function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
<!-- Print -->

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
			<li><a href="view_product.php">View Product</a></li>
			<li><a href="customer_buy.php" class="active">Customer Purchase</a></li>
			<li><a href="sales_profile.php">View Profile</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Customer Purchase Bill</h2>
		<br /><br />
		<center>
		
			<form method="post">
			<div id="divToPrint">
				<h1 align="center">Invoice</h1>
				<br />
			  <table align="center" width="90%" height="500" border="1" cellpadding="0" cellspacing="0" style="text-align:center;">
                  <tr height="100px;">
                    <td colspan="5" align="center" style="font-size:24px;font-weight:bold;">NUT ERP</td>
                  </tr>
                  
                  <tr>
                    <td colspan="3" style="font-size:16px;">&nbsp;Bill No :<b>&nbsp;B00<?php echo $vbill ?></b> </td>
                    <td colspan="2" style="font-size:16px;">&nbsp;Date (&nbsp;yyyy-mm-dd&nbsp;) :&nbsp;<b><?php echo $vdate ?></b> </td>
                  </tr>
				  <tr>
				  	<th colspan="5" style="font-size:16px;height:40px;text-align:left;">&nbsp;&nbsp;Customer Name :&nbsp;<b><?php echo $vname ?></b></th>
				  </tr>
                  <tr style="background-image:url(images/topbg.gif);background-size:100% 100%;color:#FFFFFF;font-size:16px;font-weight:bold;">
                    <td>Sr No</td>
                    <td>Product</td>
                    <td>Quantity(Kg)</td>
                    <td>Price(Per Kg)</td>
                    <td>Total Price </td>
                  </tr>
				  <?php
				  $i = 1;
					while($row=mysql_fetch_array($res))
					{
						$total_price = $row['b_quantity'] * $row['b_price'];									  				
				  ?>
                  <tr style="font-size:16px;">
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['sub_product'] ?></td>
                    <td><?php echo $row['b_quantity'] ?></td>
                    <td><?php echo $row['b_price'] ?>.00</td>
                    <td><?php echo $total_price ?>.00</td>
                  </tr>
				  <?php
				  		$total_amount = $total_amount + $total_price;
						$tax1 = 12.8; 
						$tax = 12.80 * $total_amount/100;
						$grand_total = $total_amount + $tax;
				  	}
				  ?>
				  <tr>
				  	<td colspan="3"></td>
					<td style="background-image:url(images/topbg.gif);background-size:100% 100%;color:#FFFFFF;font-size:16px;font-weight:bold;">Total Amount</td>
					<td style="font-size:18px;"><?php echo $total_amount ?>.00</td>
				  </tr>
				  
				  <tr>
				  	<td colspan="3"></td>
					<td style="background-image:url(images/topbg.gif);background-size:100% 100%;color:#FFFFFF;font-size:16px;font-weight:bold;">Tax&nbsp;(%)</td>
					<td style="font-size:18px;"><?php echo $tax1 ?></td>
				  </tr>
				  
				  <tr>
				  	<td colspan="3"></td>
					<td style="background-image:url(images/topbg.gif);background-size:100% 100%;color:#FFFFFF;font-size:16px;font-weight:bold;">Grand Total</td>
					<td style="font-weight:bold;font-size:18px;">Rs.&nbsp;<?php echo $grand_total ?></td>
				  </tr>
				  	
                </table>
				<?php
					}
				?>
				<br /><br /></div>
				<input type="submit" name="btn_print" value="Print" class="btn" onclick="PrintDiv();" />
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