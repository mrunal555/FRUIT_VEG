<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
<style>
#product_content
{
	background-color: white;
	height:auto;	
	color:black;
	padding:20px;
}
</style>
</head>
<body>

<?php
session_start();
include("header.php");



include('db/con1.php');



  $total=$_POST['total'];

$name=$_POST['name'];
$add=$_POST['address'];
$email=$_POST['email'];
$phone=$_POST['phone'];

//$max=count($_SESSION['ccc']);

       
			foreach($_SESSION['ccc'] as $key=>$value)
            {
				 echo $key."\n";
				 echo $value."\n";
				 echo "\n";
				 $row=mysql_query("select *from products where id=$key") or die(mysql_error());
				 while($rows=mysql_fetch_array($row))
				 {
				 $a=$rows['name'];
				 
				 }
				 mysql_query("INSERT INTO `bill`( `o_total`, `name`, `addd`, `email`, `phone`, `pn`, `qty`) VALUES ('$total','$name','$add','$email','$phone','$key','$value')");
			}
			/*$orderid=mysql_insert_id();
            $pid=$_SESSION['ccc'][$i]['productid'];
            $q=$_SESSION['ccc'][$i]['qty'];
			$r=$_SESSION['ccc'][$i]['pr'];
            
         echo $pid;
		 echo $q;
		 echo $r;*/
           // mysql_query("INSERT INTO `bill`( `o_total`, `name`, `add`, `email`, `phone`, `pn`, `qty`, `pr`) VALUES ('$total','$add','$email','$phone','$pid','$q','$r')");
       
        die('Thank You! your order has been placed!');
      
?>
?>
</div>
</body>
</html>