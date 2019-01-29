<?php
	include("connection.php");
	
	if(isset($_REQUEST['con']))
	{
		$vcon=$_REQUEST['con'];
		
		$sel="select * from state where c_id='$vcon'";
		$res=mysql_query($sel);
	
	?>
	<option value="" selected="selected">--Select State--</option>
	<?php
	
	while($row=mysql_fetch_array($res))
	{
	?>
	<option value="<?php echo $row['s_id'] ?>"><?php echo $row['state'] ?></option>
	<?php
	}
	
	}
?>


<?php
	
	if(isset($_REQUEST['st']))
	{
		$vst=$_REQUEST['st'];
		$sel2="select * from city where s_id='$vst'";
		$res2=mysql_query($sel2);
		
		?>
		<option value="" selected="selected">--Select City--</option>
		<?php
		
		while($row2=mysql_fetch_array($res2))
		{
		?>
		<option value="<?php echo $row2['ct_id'] ?>"><?php echo $row2['city'] ?></option>
		<?php
		}
		
	}
?>