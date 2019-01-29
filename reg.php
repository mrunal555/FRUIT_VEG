<?php
	ob_start();
	include("con1.php");
	
	if(isset($_REQUEST['btn_submit']))
	{
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
		
		$insert = "insert into customer_reg(fname,lname,username,password,address,c_id,s_id,ct_id,gender,contact,e_mail,dob) values('$vfnm','$vlnm','$vunm','$vpwd','$vadd','$vcountry','$vstate','$vcity','$vgender','$vmob','$vemail','$vdob')";
		mysql_query($insert);
		header("location:login.php");
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
			
		var temp = true;		
   		var txt_lnm=document.getElementById('txt_lnm').value;
		if(txt_lnm == '')
		{
			//alert('please enter your name')
			document.getElementById('LnmErr').innerHTML='Please enter your Lnm';
			temp = false;
		}
		else
		{
			document.getElementById('LnmErr').style.display='none';
		}				

		var temp = true;
   		var txt_unm=document.getElementById('txt_unm').value;
		if(txt_unm == '')
		{
			//alert('please enter your name')
			document.getElementById('UnmErr').innerHTML='Please enter your Unm';
			temp = false;
		}
		else
		{
			document.getElementById('UnmErr').style.display='none';
		}	
			
		var temp = true;
   		var txt_pwd=document.getElementById('txt_pwd').value;
		if(txt_pwd == '')
		{
			//alert('please enter your name')
			document.getElementById('PwdErr').innerHTML='Please enter your Password';
			temp = false;
		}
		else
		{
			document.getElementById('PwdErr').style.display='none';
		}				
			
		var temp = true;
   		var txt_address=document.getElementById('txt_address').value;
		if(txt_address == '')
		{
			//alert('please enter your name')
			document.getElementById('AddrErr').innerHTML='Please enter your Address';
			temp = false;
		}
		else
		{
			document.getElementById('AddrErr').style.display='none';
		}				
	
		var dropdown = document.getElementById('country');
		//var age_group_info=document.getElementById("age_group_info")
		if(dropdown.selectedIndex==0)
		{
			//alert("Please select Age Group");
			document.getElementById('CountryErr').innerHTML="Select Your counrty Group";
			//dropdown.focus();
			temp=false; 
		}
		else
		{
			document.getElementById('CountryErr').style.display='none';
			//alert("You have selected "+dropdown[dropdown.selectedIndex].text+" as your Age Group");
		}

		var dropdown = document.getElementById('state');
		//var age_group_info=document.getElementById("age_group_info")
		if(dropdown.selectedIndex==0)
		{
			//alert("Please select Age Group");
			document.getElementById('StateErr').innerHTML="Select Your state Group";
			//dropdown.focus();
			temp=false; 
		}
		else
		{
			document.getElementById('StateErr').style.display='none';
			//alert("You have selected "+dropdown[dropdown.selectedIndex].text+" as your Age Group");
		}
			
		var dropdown = document.getElementById('city');
		//var age_group_info=document.getElementById("age_group_info")
		if(dropdown.selectedIndex==0)
		{
			//alert("Please select Age Group");
			document.getElementById('CityErr').innerHTML="Select Your city Group";
			//dropdown.focus();
			temp=false; 
		}
		else
		{
			document.getElementById('CityErr').style.display='none';
			//alert("You have selected "+dropdown[dropdown.selectedIndex].text+" as your Age Group");
		}
			
			
		var txt_mob=document.getElementById('txt_mob').value;
		if(txt_mob =='')
		{
			//alert('please enter your name');
			document.getElementById('ContactNoErr').innerHTML='please enter your Contact No';
			temp = false;
		}
		else
		{
			if(isNaN(txt_mob))
			{
				 document.getElementById('ContactNoErr').innerHTML='please enter your correct Contact No (like:9876543211)';
				 temp = false;
			}
			else if(txt_mob.length >= 10 && txt_mob.length <= 13)
			{			
				temp  = true;
			}
			else
			{
				document.getElementById('ContactNoErr').innerHTML='please enter your correct Contact No s ';
			}
		}

		var txt_email=document.getElementById('txt_email');
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(txt_email.value.match(mailformat))  
		{  
			document.getElementById('E-mailErr').style.display='block'; 
		}  
		else  
		{  
			//alert("You have entered an invalid email address!"); 
			document.getElementById('E-mailErr').innerHTML='please enter valid E-mail ID';
			temp=false;  
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


	<form method="post">
		<div id="search">
			<input type="text" class="text" maxlength="64" name="keywords" />
			<input type="submit" class="submit" value="Search" />
		</div>
	</form>


	<div id="headerpic"></div>

	
	<div id="menu">
		<!-- HINT: Set the class of any menu link below to "active" to make it appear active -->
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="reg.php" class="active">Registration</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
		</ul>
	</div>
	<div id="menubottom"></div>

	
	<div id="content">
		<h2 align="center">Customer Registration</h2>
		<br /><br />
		<center><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return  validate();">
			<table align="center" height="510px" width="40%" style="border:2px solid #000000;padding-top:10px;border-radius:10px;">
				<tr align="center">
					<th>First Name</th>
					<td>
						<input type="text" name="txt_fnm" id="txt_fnm" class="input" />
						<div id="FnmErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Last Name</th>
					<td>
						<input type="text" name="txt_lnm" id="txt_lnm" class="input" />
						<div id="LnmErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Username</th>
					<td>
						<input type="text" name="txt_unm" id="txt_unm" class="input" />
						<div id="UnmErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Password</th>
					<td>
						<input type="password" name="txt_pwd" id="txt_pwd" class="input" />
						<div id="PwdErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Address</th>
					<td>
						<input type="text" name="txt_address" id="txt_address" class="input" />
						<div id="AddrErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>Country</th>
					<td>
						<select name="txt_country" id="country" onchange="showstate(this.value)" class="input" >
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
						<select name="txt_state" id="state" onchange="showcity(this.value)" class="input">
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
						<input type="radio" name="txt_gender" id="txt_gen" value="male" />&nbsp;Male
						&nbsp;&nbsp;<input type="radio" name="txt_gender" value="female" />&nbsp;Female
					</td>
				</tr>
				<tr align="center">
					<td><strong>Contact No.</strong></td>
					<td>
						<input type="text" name="txt_mob" id="txt_mob" class="input" />
						<div id="ContactNoErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>E-mail</td>
					<td>
						<input type="text" name="txt_email" id="txt_email" class="input" />
						<div id="E-mailErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<th>DOB</th>
					<td>
						<input type="date" name="txt_dob" id="txt_dob" class="input" />
						<div id="DOBErr" style="color:#FF0000;"></div>
					</td>
				</tr>
				<tr align="center">
					<td colspan="2" align="center">
						<input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn" />
						<div id="BtnErr" style="color:#FF0000;"></div>
					</td>	
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