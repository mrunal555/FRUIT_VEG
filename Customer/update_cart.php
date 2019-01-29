<?php
	ob_start();
	include("con1.php");
	session_start();
	if($_SESSION['user'])
	{
		$vuser = $_SESSION['user'];

		if(isset($_REQUEST['uppid']))
		{
			$uppid=$_REQUEST['uppid'];
			if(isset($_SESSION['cart']))
			{
				$cart=$_SESSION['cart'][$uppid]++;
			}
			print_r($cart);
			header("location:add_cart.php");
		}
		
		if(isset($_REQUEST['umpid']))
		{
			$umpid=$_REQUEST['umpid'];
			if(isset($_SESSION['cart']))
			{
				$cart=$_SESSION['cart'][$umpid]--;
			}
			if($_SESSION['cart'][$umpid]==0)
			{
				unset($_SESSION['cart'][$umpid]);
			}
			//print_r($cart);
			header("location:add_cart.php");
		}
		
		if(isset($_REQUEST['remove']))
		{
			$rid = $_REQUEST['remove'];
			unset($_SESSION['cart'][$rid]);
			header("location:add_cart.php");
		}
		
	}
	else
	{
		echo"<script>alert('Please First Login')</script>";
	}
?>