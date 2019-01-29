<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];
		
		if(isset($_REQUEST['paid']))
		{
			$vpaid_id = $_REQUEST['paid'];
			$vpaid = "paid";
			$update = "update buy set status = '$vpaid' where bill_no = '$vpaid_id'";
			mysql_query($update);
			header("location:customer_buy.php");
		}
	}
	else
	{
		echo"<script>alert('Please First Login')</script>";
	}
?>