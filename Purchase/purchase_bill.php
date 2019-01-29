<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['bill']))
		{
			$vbill = $_REQUEST['bill'];
			$sel = "select * from product_entry join product on product.p_id = product_entry.p_id join sub_product on sub_product.sp_id = product_entry.sp_id where pe_id = '$vbill'";
			$res = mysql_query($sel);
			$row=mysql_fetch_array($res);				
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
			<h1>Nut ERP</h1>
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
			<li><a href="sub_product_master.php">Sub Product Master</a></li>
			<li><a href="product_entry.php">Product Entry</a></li>
			<li><a href="view_product_entry.php" class="active">View Product Entry</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Purchase Bill</h2>
		<br /><br />
		<center>
		
			<form method="post">
			<div id="divToPrint">
			  <table align="center" width="70%" border="1" cellpadding="0" cellspacing="0" style="text-align:center;">
                  <tr height="100px;">
                    <td colspan="5" align="center" style="font-size:24px;font-weight:bold;">NUT ERP</td>
                  </tr>
                  
                  <tr>
                    <td colspan="3" style="font-size:16px;">&nbsp;Bill No :<b>&nbsp;000<?php echo $row['pe_id'] ?></b> </td>
                    <td colspan="2" style="font-size:16px;">&nbsp;Date (&nbsp;yyyy-mm-dd&nbsp;) :&nbsp;<b><?php echo $row['date'] ?></b> </td>
                  </tr>
				  <tr>
				  	<th colspan="5" style="font-size:16px;height:40px;text-align:left;">&nbsp;&nbsp;Saller Name :&nbsp;<?php echo $row['saller'] ?></th>
				  </tr>
                  <tr style="background-image:url(images/topbg.gif);background-size:100% 100%;color:#FFFFFF;font-size:16px;font-weight:bold;">
                    <td>Product</td>
                    <td>Sub Product </td>
                    <td>Qty(Kg)</td>
                    <td>Price(Per Kg)</td>
                    <td>Total Price </td>
                  </tr>
                  <tr style="height:200px;font-size:16px;">
                    <td><?php echo $row['product'] ?></td>
                    <td><?php echo $row['sub_product'] ?></td>
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php echo $row['price'] ?>.00</td>
                    <td><?php echo $row['total_price'] ?>.00</td>
                  </tr>
				  <tr>
				  	<td colspan="3"></td>
					<td style="background-image:url(images/topbg.gif);background-size:100% 100%;color:#FFFFFF;font-size:16px;font-weight:bold;">Grand Total</td>
					<td style="font-weight:bold;font-size:18px;"><?php echo $row['total_price'] ?>.00</td>
				  </tr>
				  	
                </table>
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