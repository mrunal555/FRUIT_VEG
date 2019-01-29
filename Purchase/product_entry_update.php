<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['pe_eid']))
		{
			$vpe_eid = $_REQUEST['pe_eid'];
			$select = "select * from product_entry join sub_product on sub_product.sp_id = product_entry.sp_id join product on product.p_id = product_entry.p_id where pe_id = '$vpe_eid'";
			$result = mysql_query($select);
			$rows = mysql_fetch_array($result);
		}
		
		if(isset($_REQUEST['btn_update']))
		{
			$pe_eid = $_REQUEST['pe_eid'];
			$vsaller = $_REQUEST['txt_sale'];
			$vproduct = $_REQUEST['txt_product'];
			$vsub = $_REQUEST['txt_sub'];
			$vqty = $_REQUEST['txt_qty'];
			$vprice = $_REQUEST['txt_price'];
			$vtotal = $vqty * $vprice;
			$vsale = $vprice * 10/100;
			$vsale_price = $vprice + $vsale;
			$vdate = $_REQUEST['txt_date'];
			
			$name=$_FILES['userfile']['name'];
			$tmp=$_FILES['userfile']['tmp_name'];
			$type=$_FILES['userfile']['type'];
			$size=$_FILES['userfile']['size'];
			$path="../../FRUIT_VEG/Photos/".$name;
		
		
			if($_FILES['type']='image/jpg' || $_FILES['type']='image/jpeg' || $_FILES['type']='image/png')
			{
				move_uploaded_file($tmp,$path);
				$update = "update product_entry set saller = '$vsaller',p_id = '$vproduct',sp_id = '$vsub',image_name = '$path',quantity = '$vqty',price = '$vprice',sale_price = '$vsale_price',total_price = '$vtotal',date = '$vdate' where pe_id = '$pe_eid'";
				mysql_query($update);
				header("location:view_product_entry.php");
				//$insertRec="insert into reg(profimage) values('$path')";
				//mysql_query($insertRec)or die('Query Not Fire');
				
			}
			
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
		
		function showproduct(str)
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
			abc.open("GET","product_ajax.php?con="+str,true);
			abc.send();
			
			//set XMLHTTPRequest object property
			
			abc.onreadystatechange=function()
			{
				if(abc.readyState==4)
				{
					document.getElementById("subproduct").innerHTML=abc.responseText;
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


	<form method="post" enctype="multipart/form-data">
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
		<h2 align="center">Product Entry</h2>
		<br /><br />
		<center>
			<form method="post" enctype="multipart/form-data">
				<table align="center" border="0" width="450px" height="340px">
					<tr align="center">
						<th>Saller Name</th>
						<td><input type="text" name="txt_sale" value="<?php echo $rows['saller'] ?>" required="required" class="input" /></td>
					</tr>
					<tr align="center">
						<th>Product</th>
						<td>
							<select name="txt_product" class="input" id="product" onchange="showproduct(this.value)">
								<option value="<?php echo $rows['p_id'] ?>"><?php echo $rows['product'] ?></option>
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
					<tr align="center">
						<th>Sub Product</th>
						<td>
							<select name="txt_sub" class="input" id="subproduct">
								<option value="<?php echo $rows['sp_id'] ?>"><?php echo $rows['sub_product'] ?></option>
							</select>
						</td>
					</tr>
					<tr align="center">
						<th>Sub Product Image</th>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="userfile" /></td>
					</tr>
					<tr align="center">
						<th>Quantity (In Kg)</th>
						<td><input type="text" name="txt_qty" class="input" value="<?php echo $rows['quantity'] ?>" /></td>
					</tr>
					<tr align="center">
						<th>Price (per Kg)</th>
						<td><input type="text" name="txt_price" class="input" value="<?php echo $rows['price'] ?>" /></td>
					</tr>
					<tr align="center">
						<th>Total Price</th>
						<td><input type="text" name="txt_total" class="input" value="<?php echo $rows['total_price'] ?>" /></td>
					</tr>
					<tr align="center">
						<th>Date</th>
						<td><input type="date" name="txt_date" class="input" value="<?php echo $rows['date'] ?>" /></td>
					</tr>
					<tr align="center">
						<td align="center" colspan="2"><input type="submit" name="btn_update" value="Update" class="btn" /></td>
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