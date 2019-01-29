<?php
	ob_start();
	include("connection.php");
	session_start();
	session_destroy();
	header("location:index.php");
?>