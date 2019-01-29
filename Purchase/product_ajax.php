<?php
	ob_start();
	include("con1.php");
	
	if(isset($_REQUEST['con']))
	{
		$vcon=$_REQUEST['con'];
		
		$sel="select * from sub_product where p_id='$vcon'";
		$res=mysql_query($sel);
	
		?>
		<option value="" selected="selected">--Select--</option>
		<?php
		
		while($row=mysql_fetch_array($res))
		{
		?>
		<option value="<?php echo $row['sp_id'] ?>"><?php echo $row['sub_product'] ?></option>
		<?php
		}
	
	}
?>