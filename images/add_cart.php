<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>HERBALIFE</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
		<style>
		#product_content
{
	background-color: white;
	height:auto;	
	color:black;
	padding:20px;
}
button
{
	color:white;
	border-radius:5px;
	border:2px solid black;
	cursor:pointer;
}
		</style>
    </head>
    <body>   

<?php
session_start();
include("header.php");
include("db/connection.php");
if(isset($_REQUEST['pid']))
{
	$pid=$_REQUEST['pid'];
	
	if(isset($_SESSION['ccc']))
	{
		$cart=$_SESSION['ccc'];
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
	
	$_SESSION['ccc']=$cart;
	
	//print_r($cart);

}

$price=0;
$total=0;

?>
<div id ='product_content' >
<h2 align='center' style="padding:5px;border-radius:5px; color:White"> In Your Cart</h2>
<table style="height:50px;width:80%;margin-left:10%;margin-top:2%;text-align:center;" >
<tr style="height:30px;background-color:brown;color:white; font-weight:bold;font-size:15px;"><th>Item Code</th><th>Name</th><th>Quantity</th><th>Price</th><th>Action</th><tr>

<?php
	
	foreach($_SESSION['ccc'] as $key=>$value)
	{
			$sql=mysql_query("select id,name,new_price from products where id=$key");
			while($row=mysql_fetch_array($sql))
			{
				$price=$row['new_price']*$value;
				?>
					<tr style="background-color:gray;height:25px;">
					<td><?php echo $key;?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $value;?></td>
					<td><?php echo $price;?></td>
					<td><a href="remove_cart.php?dpid=<?php echo $key;?>"><button style="background-color:red;">Remove</button></a>
					<a href="update_cart.php?uppid=<?php echo $key;?>"><button style="background-color:green;">Quantity +1</button></a>
					<a href="update_cart.php?umpid=<?php echo $key;?>"><button style="background-color:orange;">Quantity -1</button></a></td>
					
					</tr>	
				
				<?php
				$total=$total+$price;
			}
	}
?>
<tr style="background-color:pink;height:30px;"><td colspan=3 align=center >TOTAL AMOUNT</td><td><?php echo $total;?></td>
<td colspan=2 align=center><a href="bill.php?total=<?php echo $total;?>"><button style="width:100px;background-color:violet;">Buy</button></a></td></tr>
</table>
<p style="text-align:right;margin-right:10%;font-weight:bold;font-size:15px;"><a href="index.php" >Continue shopping...</a></p>

</div>

</body>
</html>
