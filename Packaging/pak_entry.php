<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['btn_submit']))
		{
			
			#$vsale = $_REQUEST['txt_sale'];
			$vproduct = $_REQUEST['txt_product'];
			$vsub = $_REQUEST['txt_sub'];
			$vqty = $_REQUEST['txt_qty'];
			$vprice = $_REQUEST['txt_price'];
			$vtotal = $vqty * $vprice;
			$vdate = $_REQUEST['txt_date'];
			
			$name=$_FILES['userfile']['name'];
			$tmp=$_FILES['userfile']['tmp_name'];
			$type=$_FILES['userfile']['type'];
			$size=$_FILES['userfile']['size'];
			$path="../../FRUIT_VEG/Photos/".$name;
		
		
			if($_FILES['type']='image/jpg' || $_FILES['type']='image/jpeg' || $_FILES['type']='image/png')
			{
				move_uploaded_file($tmp,$path);
				$insert = "insert into pak_entry(p_id,sp_id,image_name,quantity,price,total_price,date) values('$vproduct','$vsub','$path','$vqty','$vprice','$vtotal','$vdate')";
				mysql_query($insert);
				header("location:pak_entry.php");
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
			abc.open("GET","pak_ajax.php?con="+str,true);
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
			<li><a href="pak_home.php">Home</a></li>
			<li><a href="attendance.php">Attendance</a></li>
			<li><a href="pak_profile.php">View Profile</a></li>
			<li><a href="product_master.php">Product Master</a></li>
			<li><a href="sub_product_master.php">Sub Product Master</a></li>
			<li><a href="pak_entry.php" class="active">Product Entry</a></li>
			<li><a href="view_pak_entry.php">View Product Entry</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Package Entry</h2>
		<br /><br />
		<center>
			<form method="post" enctype="multipart/form-data">
				<table align="center" border="0" width="450px" height="340px">
					
					<tr align="center">
						<th>Product</th>
						<td>
							<select name="txt_product" class="input" id="product" onchange="showproduct(this.value)">
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
					<tr align="center">
						<th>Sub Product</th>
						<td>
							<select name="txt_sub" class="input" id="subproduct">
								<option value="" selected="selected">--Select--</option>
							</select>
						</td>
					</tr>
					<tr align="center">
						<th>Sub Product Image</th>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="userfile" /></td>
					</tr>
					<tr align="center">
						<th>Quantity (In Kg)</th>
						<td><input type="text" name="txt_qty" class="input" /></td>
					</tr>
					<tr align="center">
						<th>Price (per Kg)</th>
						<td><input type="text" name="txt_price" class="input" /></td>
					</tr>
					<tr align="center">
						<th>Total Price</th>
						<td><input type="text" name="txt_total" class="input" value="<?php echo $vtotal ?>" /></td>
					</tr>
					<tr align="center">
						<th>Date</th>
						<td><input type="date" name="txt_date" class="input" /></td>
					</tr>
					<tr align="center">
						<td align="center" colspan="2"><input type="submit" name="btn_submit" value="Submit" class="btn" /></td>
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