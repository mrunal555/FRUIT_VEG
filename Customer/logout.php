<?php
	ob_start();
	include("con1.php");
	session_start();
	session_destroy();
	header("location:../../ERP_NUT/index.php");
?>