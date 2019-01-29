<?php
	ob_start();
	include("con1.php");
	
	if(isset($_REQUEST['btn_submit']))
	{
		$vemp = $_REQUEST['txt_emp'];
		$vfnm = $_REQUEST['txt_fnm'];
		$vlnm = $_REQUEST['txt_lnm'];
		$vunm = $_REQUEST['txt_unm'];
		$vpwd = $_REQUEST['txt_pwd'];
		$vadd = $_REQUEST['txt_address'];
		$vcountry = $_REQUEST['txt_country'];
		$vstate = $_REQUEST['txt_state'];
		$vcity = $_REQUEST['txt_city'];
		$vgender = $_REQUEST['txt_gender'];
		$vmob = $_REQUEST['txt_mob'];
		$vemail = $_REQUEST['txt_email'];
		$vdob = $_REQUEST['txt_dob'];
		
		$insert = "insert into account_reg(ac_emp_id,fname,lname,username,password,address,c_id,s_id,ct_id,gender,contact,e_mail,dob) values('$vemp','$vfnm','$vlnm','$vunm','$vpwd','$vadd','$vcountry','$vstate','$vcity','$vgender','$vmob','$vemail','$vdob')";
		mysql_query($insert);
		header("location:index.php");
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
  function validate()
   {
   	var temp = true;
   		var txt_fnm=document.getElementById('txt_fnm').value;
			if(txt_fnm == '')
			{
			//alert('please enter your name')
				document.getElementById('FnmErr').innerHTML='Please enter your Fnm';
				temp = false;
			}
			else
			{
				document.getElementById('FnmErr').style.display='none';
			}	
			

   			return temp;
   		}

		
		function showstate(str)
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
			abc.open("GET","country_ajax.php?con="+str,true);
			abc.send();
			
			//set XMLHTTPRequest object property
			
			abc.onreadystatechange=function()
			{
				if(abc.readyState==4)
				{
					document.getElementById("state").innerHTML=abc.responseText;
				}			
			}	
		}
		
		function showcity(str)
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
			abc.open("GET","country_ajax.php?st="+str,true);
			abc.send();
			
			//set XMLHTTPRequest object property
			
			abc.onreadystatechange=function()
			{
				if(abc.readyState==4)
				{
					document.getElementById("city").innerHTML=abc.responseText;
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


	<form method="post" action="">
		<div id="search">
			<input type="text" class="text" maxlength="64" name="keywords" />
			<input type="submit" class="submit" value="Search" />
		</div>
	</form>


	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="index.php">Login</a></li>
			<li><a href="ac_reg.php" class="active">Registration</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Account Registration</h2>
		<br /><br />
		<center><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validate();">
			<table align="center" height="600px" width="36%" style="border:2px solid #000000;padding-top:10px;border-radius:10px;">
				<tr align="center">
					<th>Employee ID</th>
					<?php
						$sel = "select * from account_reg";
						$res = mysql_query($sel);
						$a=1;
						while($row = mysql_fetch_array($res))
						{
							$a = $row['ac_id']+1;
						}
							
					?>
					<td><input type="text" name="txt_emp" value="AC00<?php echo $a ?>" class="input" readonly="true" /></td>
			
				</tr>
				<tr align="center">
					<th>First Name</th>
					<td><input type="text" name="txt_fnm" class="input" />
					<div id="FnmErr" style="color:#FF0000;"></div></td>
				</tr>
				<tr align="center">
					<th>Last Name</th>
					<td><input type="text" name="txt_lnm" class="input" />
					<div id="LnmErr" style="color:#FF0000;"></div></td>
				</tr>
				<tr align="center">
					<th>Username</th>
					<td><input type="text" name="txt_unm" class="input" />
					<div id="UnmErr" style="color:#FF0000;"></div></td>
				</tr>
				<tr align="center">
					<th>Password</th>
					<td><input type="password" name="txt_pwd" class="input" />
					<div id="PwdErr" style="color:#FF0000;"></div></td>
				</tr>
				<tr align="center">
					<th>Address</th>
					<td><input type="text" name="txt_address" class="input" />
					<div id="AddrErr" style="color:#FF0000;"></div></td>
				</tr>
				<tr align="center">
					<th>Country</th>
					<td>
					<select name="txt_country" id="country" class="input" onchange="showstate(this.value)">
						<option value="" selected="selected">--Select Country--</option>
						<?php
							$sel="select * from country";
							$res=mysql_query($sel);
							while($row=mysql_fetch_array($res))
							{
							?>
							<option value="<?php echo $row['c_id'] ?>"><?php echo $row['country'] ?></option>
							<?php
							}
							?>
					
					</select>
					<div id="CountryErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>State</th>
					<td>
						<select name="txt_state" id="state" class="input" onchange="showcity(this.value)">
							<option value="" selected="selected">--Select State--</option>
						</select>
						<div id="StateErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>City</th>
					<td>
						<select name="txt_city" id="city" class="input">
							<option value="" selected="selected">--Select City--</option>
						</select>
						<div id="CityErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Gender</th>
					<td>
						<input type="radio" name="txt_gender" value="male" />&nbsp;Male
						&nbsp;&nbsp;<input type="radio" name="txt_gender" value="female" />&nbsp;Female
					</td>
				</tr>
				<tr align="center">
					<th>Contact No.</th>
					<td><input type="text" name="txt_mob" class="input" />
					<div id="ContactNoErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>E-mail</th>
					<td><input type="text" name="txt_email" class="input" />
					<div id="E-mailErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Date Of Birth</th>
					<td><input type="date" name="txt_dob" class="input" />
					<div id="DOBErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<td colspan="2" align="center"><input type="submit" name="btn_submit" value="Submit" class="btn" /></td>
					<div id="BtnErr" style="color:#FF0000;"></div>
				</tr>
			</table>
		</form></center>
	</div>

			<!-- Secondary content area end -->
		
	<div id="footer">
			<?php include("footer.php") ?>
	</div>
	
</div>

</body>
</html>