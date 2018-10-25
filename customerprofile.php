<?php include("admin/Common.php"); ?>
<?php $CatID=99999; ?>
<?php
 if(!isset($_SESSION['LoginCustomer']) || $_SESSION['LoginCustomer']==false)
	 redirect("404.php");
$msg1="";
$msg2="";
$msg3="";
$Gender=0;
$Subscribe=1;
$FirstName="";
$LastName="";
$Address1="";
$Region="";
$PostCode="";
$Fax="";
$Phone="";
$Company="";
$Country="XXX";
$City="";
$Email="";
$OldEmailAddress="";
$OldPassword="";
$NewPassword="";
$NewPassword2="";
if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
{			
	if(isset($_POST["Subscribe"]) && ((int)$_POST["Subscribe"] == 0 || (int)$_POST["Subscribe"] == 1))
		$Subscribe=trim($_POST["Subscribe"]);	
	if(isset($_POST["Gender"]) && ((int)$_POST["Gender"] == 1 || (int)$_POST["Gender"] == 2))
		$Gender=trim($_POST["Gender"]);	
	if(isset($_POST["FirstName"]))
		$FirstName=trim($_POST["FirstName"]);
	if(isset($_POST["LastName"]))
		$LastName=trim($_POST["LastName"]);
	if(isset($_POST["Fax"]))
		$Fax=trim($_POST["Fax"]);
	if(isset($_POST["City"]))
		$City=trim($_POST["City"]);
	if(isset($_POST["Company"]))
		$Company=trim($_POST["Company"]);
	if(isset($_POST["Phone"]))
		$Phone=trim($_POST["Phone"]);
	if(isset($_POST["PostCode"]))
		$PostCode=trim($_POST["PostCode"]);
	if(isset($_POST["Region"]))
		$Region=trim($_POST["Region"]);
	if(isset($_POST["Address1"]))
		$Address1=trim($_POST["Address1"]);
	if(isset($_POST["Email"]))
		$Email=trim($_POST["Email"]);
	if(isset($_POST["Country"]))
		$Country=trim($_POST["Country"]);	

		if($Gender == 0)
		{
			$msg1='(<span style="color:red">Please Select Gender</span>)';
		}
		else if($FirstName == "")
		{
			$msg1='(<span style="color:red">Please Enter First Name</span>)';
		}		
		else if($LastName == "")
		{
			$msg1='(<span style="color:red">Please Enter Last Name</span>)';
		}
		else if($Email == "")
		{
			$msg1='(<span style="color:red">Please Enter EmailAddresss</span>)';
		}
		else if(!validEmailAddress($Email))
		{
			$msg1='(<span style="color:red">EmailAddress is not Valid!</span>)';
		}
		else if($Phone == "")
		{
			$msg1='(<span style="color:red">Please Enter Phone Number</span>)';
		}	
		else if($Address1 == "")
		{
			$msg1='(<span style="color:red">Please Enter Address</span>)';
		}	
		else if($City == "")
		{
			$msg1='(<span style="color:red">Please Enter City</span>)';
		}	
		else if($Country == "XXX")
		{
			$msg1='(<span style="color:red">Please Select Country</span>)';
		}	
		else if($Region == "")
		{
			$msg1='(<span style="color:red">Please Enter Region / State</span>)';
		}	
		
		


	if($msg1=="")
	{

		$query="UPDATE website_users SET DateModified=NOW(),
				Gender='".(int)$Gender . "',
				Subscribe='".(int)$Subscribe . "',
				FirstName = '" . dbinput($FirstName) . "',
				LastName = '" . dbinput($LastName) . "',
				Region = '" . dbinput($Region) . "',
				Country = '" . dbinput($Country) . "',
				PostCode = '" . dbinput($PostCode) . "',
				Company = '" . dbinput($Company) . "',
				Address = '" . dbinput($Address1) . "',
				Fax = '" . dbinput($Fax) . "',
				City = '" . dbinput($City) . "',
				Phone = '" . dbinput($Phone) . "',
				Email = '" . dbinput($Email) . "' WHERE ID='".$_SESSION['CustomerID']."'";
		mysql_query($query) or die (mysql_error());
		if($Subscribe == 1)
		{	
				$Email = strtolower($Email);
				$query="SELECT ID FROM newsletter_subscribers WHERE Email='".dbinput($Email) . "'";
				$r=mysql_query($query) or die (mysql_error());
				$n=mysql_num_rows($r);
				if($n==0)
				{
					$query="INSERT INTO newsletter_subscribers SET Email='".dbinput($Email) . "', DateAdded=NOW()";
					mysql_query($query) or die (mysql_error());
				}
		}
		if($Subscribe == 0)
		{	
				$Email = strtolower($Email);
				$query="SELECT ID FROM newsletter_subscribers WHERE Email='".dbinput($Email) . "'";
				$r=mysql_query($query) or die (mysql_error());
				$n=mysql_num_rows($r);
				if($n!=0)
				{
					$query="DELETE from newsletter_subscribers Where Email='".dbinput($Email) . "'";
					mysql_query($query) or die (mysql_error());
				}
		}
		$_SESSION["msg1"]='(<span style="color:darkgreen">User has been Updated Successfully.</span>)';		
		
		redirect("customerprofile.php");	
	}
}
else
{
	$query="SELECT Gender,Subscribe,FirstName,LastName,Region,Country,PostCode,Company,Fax,City,Phone,Email,Address FROM website_users WHERE Status = 1 AND ID=" . $_SESSION["CustomerID"] . "";
	 
	
	$result = mysql_query ($query) or die(mysql_error()); 
	$num = mysql_num_rows($result);
	
	if($num==0)
	{
		redirect("404.php");
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$Gender=$row["Gender"];
		$Subscribe=$row["Subscribe"];
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$Address1=$row["Address"];
		$Region=$row["Region"];
		$PostCode=$row["PostCode"];
		$Fax=$row["Fax"];
		$Phone=$row["Phone"];
		$Company=$row["Company"];
		$Country=$row["Country"];
		$City=$row["City"];
		$Email=$row["Email"];
	}
}

if(isset($_POST["action2"]) && $_POST["action2"] == "submit_form")
{			
	if(isset($_POST["OldEmailAddress"]))
		$OldEmailAddress=trim($_POST["OldEmailAddress"]);
	if(isset($_POST["OldPassword"]))
		$OldPassword=trim($_POST["OldPassword"]);
	if(isset($_POST["NewPassword"]))
		$NewPassword=trim($_POST["NewPassword"]);
	if(isset($_POST["NewPassword2"]))
		$NewPassword2=trim($_POST["NewPassword2"]);	

		if($OldEmailAddress == "")
		{
			$msg2='(<span style="color:red">Please Enter Email Address</span>)';
		}		
		else if($OldPassword == "")
		{
			$msg2='(<span style="color:red">Please Enter Current Password</span>)';
		}
		
		if($msg2=='')
		{	
			$query="SELECT Password FROM website_users WHERE Status = 1 AND Email='".dbinput($OldEmailAddress)."'";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
			
			
			if($num==0)
			{
				$msg3 = '(<span style="color:red">Invalid Email/Password.</span>)';
			}
			else
			{
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
				if(dboutput($row["Password"]) == $OldPassword)
				{
					if($NewPassword == "")
					{
						$msg3='(<span style="color:red">Please Enter New Password</span>)';
					}	
					else if($NewPassword2 == "")
					{
						$msg3='(<span style="color:red">Please Confirm New Password</span>)';
					}	
					else if($NewPassword != $NewPassword2)
					{
						$msg3='(<span style="color:red">New Password not Matching</span>)';
					}

					if($msg3=="")
					{

						$query="UPDATE website_users SET DateModified=NOW(),
								Password = '" . dbinput($NewPassword) . "'
								WHERE ID='".$_SESSION['CustomerID']."'";
						mysql_query($query) or die (mysql_error());
						
						$_SESSION["msg2"]='(<span style="color:darkgreen">Password has been Updated Successfully.</span>)';		
						
						redirect("customerprofile.php");	
					}
				}
				else
				{
					$msg3 = '(<span style="color:red">Invalid Email/Password.</span>)';
				}
			}
		}
		
}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Profile - <?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Shoppe Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel='shortcut icon' href='images/icon.png' type='image/x-icon' ><!--Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--//Custom Theme files -->
<!--js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--//js-->
<!--cart-->
<script src="js/simpleCart.min.js"></script>
<!--cart-->
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'><link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Pompiere' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Fascinate' rel='stylesheet' type='text/css'>
<link href="css/ziehharmonika.css" rel="stylesheet" type="text/css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!--web-fonts-->
<!--animation-effect-->
<link href="css/animate.min.css" rel="stylesheet"> 
<script src="js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
<!--//animation-effect-->
<!--start-smooth-scrolling-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!--//end-smooth-scrolling-->

<style>
		
		.container_pro {
			max-width: 960px;
			margin: 50px auto;
		}
		
	</style>
    
</head>
<body>
	<!--header-->
	<?php include("header.php"); ?>
	<!--//header-->
	<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> </li>				<li><i>/</i>Wishlist</li>
			</ul>
		</div>
	</div>
<!-- //breadcrumbs -->
<h1>Welcome Back <span> <?php echo $_SESSION["CustomerFullName"]; ?></span></h1>
<div class="container_pro">

	
	<div class="col">
	<?php
		  		echo $msg1;
				if(isset($_SESSION["msg1"]))
				{
					echo $_SESSION["msg1"];
					$_SESSION["msg1"]="";
				}
			?>
            </div>
		<div class="ziehharmonika">
			<h3>Profile Details</h3>
			<div>
             
             <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        
        <fieldset id="account">
          
          <legend>Your Personal Details</legend>
          
          
			<div class="form-group required">
			<label class="col-sm-2 control-label" for="gender">Gender<span class="required"></span></label>

			<div class="col-sm-10">
				<select name="Gender" id="gender" class="form-control">
					<option <?php echo ($Gender == 0 ? 'selected' : ''); ?> value="0"> --- Please Select --- </option>
					<option <?php echo ($Gender == 1 ? 'selected' : ''); ?> value="1">Male</option>
					<option <?php echo ($Gender == 2 ? 'selected' : ''); ?> value="2">Female</option>
				  </select> 
				</div>
			</div>
		  
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
            <div class="col-sm-10">
              <input type="text" name="FirstName" value="<?php echo $FirstName; ?>" placeholder="First Name" id="input-firstname" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
            <div class="col-sm-10">
              <input type="text" name="LastName" value="<?php echo $LastName; ?>" placeholder="Last Name" id="input-lastname" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
              <input type="text" name="Email" value="<?php echo $Email; ?>" placeholder="E-Mail" id="input-email" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
            <div class="col-sm-10">
              <input type="text" name="Phone" value="<?php echo $Phone; ?>" placeholder="Telephone" id="input-telephone" class="form-control">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-fax">Fax</label>
            <div class="col-sm-10">
              <input type="text" name="Fax" value="<?php echo $Fax; ?>" placeholder="Fax" id="input-fax" class="form-control">
            </div>
          </div>
          
        </fieldset>
        
        <fieldset id="address">
          <legend>Your Address</legend>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-company">Company</label>
            <div class="col-sm-10">
              <input type="text" name="Company" value="<?php echo $Company; ?>" placeholder="Company" id="input-company" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1">Address</label>
            <div class="col-sm-10">
              <input type="text" name="Address1" value="<?php echo $Address1; ?>" placeholder="Address" id="input-address-1" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-city">City</label>
            <div class="col-sm-10">
              <input type="text" name="City" value="<?php echo $City; ?>" placeholder="City" id="input-city" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-postcode">Post Code</label>
            <div class="col-sm-10">
              <input type="text" name="PostCode" value="<?php echo $PostCode; ?>" placeholder="Post Code" id="input-postcode" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
<label class="col-sm-2 control-label" for="input-country">Country</label>

<div class="col-sm-10">
    <select name="Country" id="input-country" class="form-control">
        <option <?php echo ($Country == 'XXX' ? 'selected' : ''); ?> value="XXX"> --- Please Select --- </option>
        <option <?php echo ($Country == 'AFG' ? 'selected' : ''); ?> value="AFG">Afghanistan</option>
		<option <?php echo ($Country == 'ALA' ? 'selected' : ''); ?> value="ALA">Aland Islands</option>
		<option <?php echo ($Country == 'ALB' ? 'selected' : ''); ?> value="ALB">Albania</option>
		<option <?php echo ($Country == 'DZA' ? 'selected' : ''); ?> value="DZA">Algeria</option>
		<option <?php echo ($Country == 'ASM' ? 'selected' : ''); ?> value="ASM">American Samoa</option>
		<option <?php echo ($Country == 'AND' ? 'selected' : ''); ?> value="AND">Andorra</option>
		<option <?php echo ($Country == 'AGO' ? 'selected' : ''); ?> value="AGO">Angola</option>
		<option <?php echo ($Country == 'AIA' ? 'selected' : ''); ?> value="AIA">Anguilla</option>
		<option <?php echo ($Country == 'ATA' ? 'selected' : ''); ?> value="ATA">Antarctica</option>
		<option <?php echo ($Country == 'ATG' ? 'selected' : ''); ?> value="ATG">Antigua and Barbuda</option>
		<option <?php echo ($Country == 'ARG' ? 'selected' : ''); ?> value="ARG">Argentina</option>
		<option <?php echo ($Country == 'ARM' ? 'selected' : ''); ?> value="ARM">Armenia</option>
		<option <?php echo ($Country == 'ABW' ? 'selected' : ''); ?> value="ABW">Aruba</option>
		<option <?php echo ($Country == 'AUS' ? 'selected' : ''); ?> value="AUS">Australia</option>
		<option <?php echo ($Country == 'AUT' ? 'selected' : ''); ?> value="AUT">Austria</option>
		<option <?php echo ($Country == 'AZE' ? 'selected' : ''); ?> value="AZE">Azerbaijan</option>
		<option <?php echo ($Country == 'BHS' ? 'selected' : ''); ?> value="BHS">Bahamas</option>
		<option <?php echo ($Country == 'BHR' ? 'selected' : ''); ?> value="BHR">Bahrain</option>
		<option <?php echo ($Country == 'BGD' ? 'selected' : ''); ?> value="BGD">Bangladesh</option>
		<option <?php echo ($Country == 'BRB' ? 'selected' : ''); ?> value="BRB">Barbados</option>
		<option <?php echo ($Country == 'BLR' ? 'selected' : ''); ?> value="BLR">Belarus</option>
		<option <?php echo ($Country == 'BEL' ? 'selected' : ''); ?> value="BEL">Belgium</option>
		<option <?php echo ($Country == 'BLZ' ? 'selected' : ''); ?> value="BLZ">Belize</option>
		<option <?php echo ($Country == 'BEN' ? 'selected' : ''); ?> value="BEN">Benin</option>
		<option <?php echo ($Country == 'BMU' ? 'selected' : ''); ?> value="BMU">Bermuda</option>
		<option <?php echo ($Country == 'BTN' ? 'selected' : ''); ?> value="BTN">Bhutan</option>
		<option <?php echo ($Country == 'BOL' ? 'selected' : ''); ?> value="BOL">Bolivia, Plurinational State of</option>
		<option <?php echo ($Country == 'BES' ? 'selected' : ''); ?> value="BES">Bonaire, Sint Eustatius and Saba</option>
		<option <?php echo ($Country == 'BIH' ? 'selected' : ''); ?> value="BIH">Bosnia and Herzegovina</option>
		<option <?php echo ($Country == 'BWA' ? 'selected' : ''); ?> value="BWA">Botswana</option>
		<option <?php echo ($Country == 'BVT' ? 'selected' : ''); ?> value="BVT">Bouvet Island</option>
		<option <?php echo ($Country == 'BRA' ? 'selected' : ''); ?> value="BRA">Brazil</option>
		<option <?php echo ($Country == 'IOT' ? 'selected' : ''); ?> value="IOT">British Indian Ocean Territory</option>
		<option <?php echo ($Country == 'BRN' ? 'selected' : ''); ?> value="BRN">Brunei Darussalam</option>
		<option <?php echo ($Country == 'BGR' ? 'selected' : ''); ?> value="BGR">Bulgaria</option>
		<option <?php echo ($Country == 'BFA' ? 'selected' : ''); ?> value="BFA">Burkina Faso</option>
		<option <?php echo ($Country == 'BDI' ? 'selected' : ''); ?> value="BDI">Burundi</option>
		<option <?php echo ($Country == 'KHM' ? 'selected' : ''); ?> value="KHM">Cambodia</option>
		<option <?php echo ($Country == 'CMR' ? 'selected' : ''); ?> value="CMR">Cameroon</option>
		<option <?php echo ($Country == 'CAN' ? 'selected' : ''); ?> value="CAN">Canada</option>
		<option <?php echo ($Country == 'CPV' ? 'selected' : ''); ?> value="CPV">Cape Verde</option>
		<option <?php echo ($Country == 'CYM' ? 'selected' : ''); ?> value="CYM">Cayman Islands</option>
		<option <?php echo ($Country == 'CAF' ? 'selected' : ''); ?> value="CAF">Central African Republic</option>
		<option <?php echo ($Country == 'TCD' ? 'selected' : ''); ?> value="TCD">Chad</option>
		<option <?php echo ($Country == 'CHL' ? 'selected' : ''); ?> value="CHL">Chile</option>
		<option <?php echo ($Country == 'CHN' ? 'selected' : ''); ?> value="CHN">China</option>
		<option <?php echo ($Country == 'CXR' ? 'selected' : ''); ?> value="CXR">Christmas Island</option>
		<option <?php echo ($Country == 'CCK' ? 'selected' : ''); ?> value="CCK">Cocos (Keeling) Islands</option>
		<option <?php echo ($Country == 'COL' ? 'selected' : ''); ?> value="COL">Colombia</option>
		<option <?php echo ($Country == 'COM' ? 'selected' : ''); ?> value="COM">Comoros</option>
		<option <?php echo ($Country == 'COG' ? 'selected' : ''); ?> value="COG">Congo</option>
		<option <?php echo ($Country == 'COD' ? 'selected' : ''); ?> value="COD">Congo, the Democratic Republic of the</option>
		<option <?php echo ($Country == 'COK' ? 'selected' : ''); ?> value="COK">Cook Islands</option>
		<option <?php echo ($Country == 'CRI' ? 'selected' : ''); ?> value="CRI">Costa Rica</option>
		<option <?php echo ($Country == 'CIV' ? 'selected' : ''); ?> value="CIV">Côte d'Ivoire</option>
		<option <?php echo ($Country == 'HRV' ? 'selected' : ''); ?> value="HRV">Croatia</option>
		<option <?php echo ($Country == 'CUB' ? 'selected' : ''); ?> value="CUB">Cuba</option>
		<option <?php echo ($Country == 'CUW' ? 'selected' : ''); ?> value="CUW">Curaçao</option>
		<option <?php echo ($Country == 'CYP' ? 'selected' : ''); ?> value="CYP">Cyprus</option>
		<option <?php echo ($Country == 'CZE' ? 'selected' : ''); ?> value="CZE">Czech Republic</option>
		<option <?php echo ($Country == 'DNK' ? 'selected' : ''); ?> value="DNK">Denmark</option>
		<option <?php echo ($Country == 'DJI' ? 'selected' : ''); ?> value="DJI">Djibouti</option>
		<option <?php echo ($Country == 'DMA' ? 'selected' : ''); ?> value="DMA">Dominica</option>
		<option <?php echo ($Country == 'DOM' ? 'selected' : ''); ?> value="DOM">Dominican Republic</option>
		<option <?php echo ($Country == 'ECU' ? 'selected' : ''); ?> value="ECU">Ecuador</option>
		<option <?php echo ($Country == 'EGY' ? 'selected' : ''); ?> value="EGY">Egypt</option>
		<option <?php echo ($Country == 'SLV' ? 'selected' : ''); ?> value="SLV">El Salvador</option>
		<option <?php echo ($Country == 'GNQ' ? 'selected' : ''); ?> value="GNQ">Equatorial Guinea</option>
		<option <?php echo ($Country == 'ERI' ? 'selected' : ''); ?> value="ERI">Eritrea</option>
		<option <?php echo ($Country == 'EST' ? 'selected' : ''); ?> value="EST">Estonia</option>
		<option <?php echo ($Country == 'ETH' ? 'selected' : ''); ?> value="ETH">Ethiopia</option>
		<option <?php echo ($Country == 'FLK' ? 'selected' : ''); ?> value="FLK">Falkland Islands (Malvinas)</option>
		<option <?php echo ($Country == 'FRO' ? 'selected' : ''); ?> value="FRO">Faroe Islands</option>
		<option <?php echo ($Country == 'FJI' ? 'selected' : ''); ?> value="FJI">Fiji</option>
		<option <?php echo ($Country == 'FIN' ? 'selected' : ''); ?> value="FIN">Finland</option>
		<option <?php echo ($Country == 'FRA' ? 'selected' : ''); ?> value="FRA">France</option>
		<option <?php echo ($Country == 'GUF' ? 'selected' : ''); ?> value="GUF">French Guiana</option>
		<option <?php echo ($Country == 'PYF' ? 'selected' : ''); ?> value="PYF">French Polynesia</option>
		<option <?php echo ($Country == 'ATF' ? 'selected' : ''); ?> value="ATF">French Southern Territories</option>
		<option <?php echo ($Country == 'GAB' ? 'selected' : ''); ?> value="GAB">Gabon</option>
		<option <?php echo ($Country == 'GMB' ? 'selected' : ''); ?> value="GMB">Gambia</option>
		<option <?php echo ($Country == 'GEO' ? 'selected' : ''); ?> value="GEO">Georgia</option>
		<option <?php echo ($Country == 'DEU' ? 'selected' : ''); ?> value="DEU">Germany</option>
		<option <?php echo ($Country == 'GHA' ? 'selected' : ''); ?> value="GHA">Ghana</option>
		<option <?php echo ($Country == 'GIB' ? 'selected' : ''); ?> value="GIB">Gibraltar</option>
		<option <?php echo ($Country == 'GRC' ? 'selected' : ''); ?> value="GRC">Greece</option>
		<option <?php echo ($Country == 'GRL' ? 'selected' : ''); ?> value="GRL">Greenland</option>
		<option <?php echo ($Country == 'GRD' ? 'selected' : ''); ?> value="GRD">Grenada</option>
		<option <?php echo ($Country == 'GLP' ? 'selected' : ''); ?> value="GLP">Guadeloupe</option>
		<option <?php echo ($Country == 'GUM' ? 'selected' : ''); ?> value="GUM">Guam</option>
		<option <?php echo ($Country == 'GTM' ? 'selected' : ''); ?> value="GTM">Guatemala</option>
		<option <?php echo ($Country == 'GGY' ? 'selected' : ''); ?> value="GGY">Guernsey</option>
		<option <?php echo ($Country == 'GIN' ? 'selected' : ''); ?> value="GIN">Guinea</option>
		<option <?php echo ($Country == 'GNB' ? 'selected' : ''); ?> value="GNB">Guinea-Bissau</option>
		<option <?php echo ($Country == 'GUY' ? 'selected' : ''); ?> value="GUY">Guyana</option>
		<option <?php echo ($Country == 'HTI' ? 'selected' : ''); ?> value="HTI">Haiti</option>
		<option <?php echo ($Country == 'HMD' ? 'selected' : ''); ?> value="HMD">Heard Island and McDonald Islands</option>
		<option <?php echo ($Country == 'VAT' ? 'selected' : ''); ?> value="VAT">Holy See (Vatican City State)</option>
		<option <?php echo ($Country == 'HND' ? 'selected' : ''); ?> value="HND">Honduras</option>
		<option <?php echo ($Country == 'HKG' ? 'selected' : ''); ?> value="HKG">Hong Kong</option>
		<option <?php echo ($Country == 'HUN' ? 'selected' : ''); ?> value="HUN">Hungary</option>
		<option <?php echo ($Country == 'ISL' ? 'selected' : ''); ?> value="ISL">Iceland</option>
		<option <?php echo ($Country == 'IND' ? 'selected' : ''); ?> value="IND">India</option>
		<option <?php echo ($Country == 'IDN' ? 'selected' : ''); ?> value="IDN">Indonesia</option>
		<option <?php echo ($Country == 'IRN' ? 'selected' : ''); ?> value="IRN">Iran, Islamic Republic of</option>
		<option <?php echo ($Country == 'IRQ' ? 'selected' : ''); ?> value="IRQ">Iraq</option>
		<option <?php echo ($Country == 'IRL' ? 'selected' : ''); ?> value="IRL">Ireland</option>
		<option <?php echo ($Country == 'IMN' ? 'selected' : ''); ?> value="IMN">Isle of Man</option>
		<option <?php echo ($Country == 'ISR' ? 'selected' : ''); ?> value="ISR">Israel</option>
		<option <?php echo ($Country == 'ITA' ? 'selected' : ''); ?> value="ITA">Italy</option>
		<option <?php echo ($Country == 'JAM' ? 'selected' : ''); ?> value="JAM">Jamaica</option>
		<option <?php echo ($Country == 'JPN' ? 'selected' : ''); ?> value="JPN">Japan</option>
		<option <?php echo ($Country == 'JEY' ? 'selected' : ''); ?> value="JEY">Jersey</option>
		<option <?php echo ($Country == 'JOR' ? 'selected' : ''); ?> value="JOR">Jordan</option>
		<option <?php echo ($Country == 'KAZ' ? 'selected' : ''); ?> value="KAZ">Kazakhstan</option>
		<option <?php echo ($Country == 'KEN' ? 'selected' : ''); ?> value="KEN">Kenya</option>
		<option <?php echo ($Country == 'KIR' ? 'selected' : ''); ?> value="KIR">Kiribati</option>
		<option <?php echo ($Country == 'PRK' ? 'selected' : ''); ?> value="PRK">Korea, Democratic People's Republic of</option>
		<option <?php echo ($Country == 'KOR' ? 'selected' : ''); ?> value="KOR">Korea, Republic of</option>
		<option <?php echo ($Country == 'KWT' ? 'selected' : ''); ?> value="KWT">Kuwait</option>
		<option <?php echo ($Country == 'KGZ' ? 'selected' : ''); ?> value="KGZ">Kyrgyzstan</option>
		<option <?php echo ($Country == 'LAO' ? 'selected' : ''); ?> value="LAO">Lao People's Democratic Republic</option>
		<option <?php echo ($Country == 'LVA' ? 'selected' : ''); ?> value="LVA">Latvia</option>
		<option <?php echo ($Country == 'LBN' ? 'selected' : ''); ?> value="LBN">Lebanon</option>
		<option <?php echo ($Country == 'LSO' ? 'selected' : ''); ?> value="LSO">Lesotho</option>
		<option <?php echo ($Country == 'LBR' ? 'selected' : ''); ?> value="LBR">Liberia</option>
		<option <?php echo ($Country == 'LBY' ? 'selected' : ''); ?> value="LBY">Libya</option>
		<option <?php echo ($Country == 'LIE' ? 'selected' : ''); ?> value="LIE">Liechtenstein</option>
		<option <?php echo ($Country == 'LTU' ? 'selected' : ''); ?> value="LTU">Lithuania</option>
		<option <?php echo ($Country == 'LUX' ? 'selected' : ''); ?> value="LUX">Luxembourg</option>
		<option <?php echo ($Country == 'MAC' ? 'selected' : ''); ?> value="MAC">Macao</option>
		<option <?php echo ($Country == 'MKD' ? 'selected' : ''); ?> value="MKD">Macedonia, the former Yugoslav Republic of</option>
		<option <?php echo ($Country == 'MDG' ? 'selected' : ''); ?> value="MDG">Madagascar</option>
		<option <?php echo ($Country == 'MWI' ? 'selected' : ''); ?> value="MWI">Malawi</option>
		<option <?php echo ($Country == 'MYS' ? 'selected' : ''); ?> value="MYS">Malaysia</option>
		<option <?php echo ($Country == 'MDV' ? 'selected' : ''); ?> value="MDV">Maldives</option>
		<option <?php echo ($Country == 'MLI' ? 'selected' : ''); ?> value="MLI">Mali</option>
		<option <?php echo ($Country == 'MLT' ? 'selected' : ''); ?> value="MLT">Malta</option>
		<option <?php echo ($Country == 'MHL' ? 'selected' : ''); ?> value="MHL">Marshall Islands</option>
		<option <?php echo ($Country == 'MTQ' ? 'selected' : ''); ?> value="MTQ">Martinique</option>
		<option <?php echo ($Country == 'MRT' ? 'selected' : ''); ?> value="MRT">Mauritania</option>
		<option <?php echo ($Country == 'MUS' ? 'selected' : ''); ?> value="MUS">Mauritius</option>
		<option <?php echo ($Country == 'MYT' ? 'selected' : ''); ?> value="MYT">Mayotte</option>
		<option <?php echo ($Country == 'MEX' ? 'selected' : ''); ?> value="MEX">Mexico</option>
		<option <?php echo ($Country == 'FSM' ? 'selected' : ''); ?> value="FSM">Micronesia, Federated States of</option>
		<option <?php echo ($Country == 'MDA' ? 'selected' : ''); ?> value="MDA">Moldova, Republic of</option>
		<option <?php echo ($Country == 'MCO' ? 'selected' : ''); ?> value="MCO">Monaco</option>
		<option <?php echo ($Country == 'MNG' ? 'selected' : ''); ?> value="MNG">Mongolia</option>
		<option <?php echo ($Country == 'MNE' ? 'selected' : ''); ?> value="MNE">Montenegro</option>
		<option <?php echo ($Country == 'MSR' ? 'selected' : ''); ?> value="MSR">Montserrat</option>
		<option <?php echo ($Country == 'MAR' ? 'selected' : ''); ?> value="MAR">Morocco</option>
		<option <?php echo ($Country == 'MOZ' ? 'selected' : ''); ?> value="MOZ">Mozambique</option>
		<option <?php echo ($Country == 'MMR' ? 'selected' : ''); ?> value="MMR">Myanmar</option>
		<option <?php echo ($Country == 'NAM' ? 'selected' : ''); ?> value="NAM">Namibia</option>
		<option <?php echo ($Country == 'NRU' ? 'selected' : ''); ?> value="NRU">Nauru</option>
		<option <?php echo ($Country == 'NPL' ? 'selected' : ''); ?> value="NPL">Nepal</option>
		<option <?php echo ($Country == 'NLD' ? 'selected' : ''); ?> value="NLD">Netherlands</option>
		<option <?php echo ($Country == 'NCL' ? 'selected' : ''); ?> value="NCL">New Caledonia</option>
		<option <?php echo ($Country == 'NZL' ? 'selected' : ''); ?> value="NZL">New Zealand</option>
		<option <?php echo ($Country == 'NIC' ? 'selected' : ''); ?> value="NIC">Nicaragua</option>
		<option <?php echo ($Country == 'NER' ? 'selected' : ''); ?> value="NER">Niger</option>
		<option <?php echo ($Country == 'NGA' ? 'selected' : ''); ?> value="NGA">Nigeria</option>
		<option <?php echo ($Country == 'NIU' ? 'selected' : ''); ?> value="NIU">Niue</option>
		<option <?php echo ($Country == 'NFK' ? 'selected' : ''); ?> value="NFK">Norfolk Island</option>
		<option <?php echo ($Country == 'MNP' ? 'selected' : ''); ?> value="MNP">Northern Mariana Islands</option>
		<option <?php echo ($Country == 'NOR' ? 'selected' : ''); ?> value="NOR">Norway</option>
		<option <?php echo ($Country == 'OMN' ? 'selected' : ''); ?> value="OMN">Oman</option>
		<option <?php echo ($Country == 'PAK' ? 'selected' : ''); ?> value="PAK">Pakistan</option>
		<option <?php echo ($Country == 'PLW' ? 'selected' : ''); ?> value="PLW">Palau</option>
		<option <?php echo ($Country == 'PSE' ? 'selected' : ''); ?> value="PSE">Palestinian Territory, Occupied</option>
		<option <?php echo ($Country == 'PAN' ? 'selected' : ''); ?> value="PAN">Panama</option>
		<option <?php echo ($Country == 'PNG' ? 'selected' : ''); ?> value="PNG">Papua New Guinea</option>
		<option <?php echo ($Country == 'PRY' ? 'selected' : ''); ?> value="PRY">Paraguay</option>
		<option <?php echo ($Country == 'PER' ? 'selected' : ''); ?> value="PER">Peru</option>
		<option <?php echo ($Country == 'PHL' ? 'selected' : ''); ?> value="PHL">Philippines</option>
		<option <?php echo ($Country == 'PCN' ? 'selected' : ''); ?> value="PCN">Pitcairn</option>
		<option <?php echo ($Country == 'POL' ? 'selected' : ''); ?> value="POL">Poland</option>
		<option <?php echo ($Country == 'PRT' ? 'selected' : ''); ?> value="PRT">Portugal</option>
		<option <?php echo ($Country == 'PRI' ? 'selected' : ''); ?> value="PRI">Puerto Rico</option>
		<option <?php echo ($Country == 'QAT' ? 'selected' : ''); ?> value="QAT">Qatar</option>
		<option <?php echo ($Country == 'REU' ? 'selected' : ''); ?> value="REU">Réunion</option>
		<option <?php echo ($Country == 'ROU' ? 'selected' : ''); ?> value="ROU">Romania</option>
		<option <?php echo ($Country == 'RUS' ? 'selected' : ''); ?> value="RUS">Russian Federation</option>
		<option <?php echo ($Country == 'RWA' ? 'selected' : ''); ?> value="RWA">Rwanda</option>
		<option <?php echo ($Country == 'BLM' ? 'selected' : ''); ?> value="BLM">Saint Barthélemy</option>
		<option <?php echo ($Country == 'SHN' ? 'selected' : ''); ?> value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
		<option <?php echo ($Country == 'KNA' ? 'selected' : ''); ?> value="KNA">Saint Kitts and Nevis</option>
		<option <?php echo ($Country == 'LCA' ? 'selected' : ''); ?> value="LCA">Saint Lucia</option>
		<option <?php echo ($Country == 'MAF' ? 'selected' : ''); ?> value="MAF">Saint Martin (French part)</option>
		<option <?php echo ($Country == 'SPM' ? 'selected' : ''); ?> value="SPM">Saint Pierre and Miquelon</option>
		<option <?php echo ($Country == 'VCT' ? 'selected' : ''); ?> value="VCT">Saint Vincent and the Grenadines</option>
		<option <?php echo ($Country == 'WSM' ? 'selected' : ''); ?> value="WSM">Samoa</option>
		<option <?php echo ($Country == 'SMR' ? 'selected' : ''); ?> value="SMR">San Marino</option>
		<option <?php echo ($Country == 'STP' ? 'selected' : ''); ?> value="STP">Sao Tome and Principe</option>
		<option <?php echo ($Country == 'SAU' ? 'selected' : ''); ?> value="SAU">Saudi Arabia</option>
		<option <?php echo ($Country == 'SEN' ? 'selected' : ''); ?> value="SEN">Senegal</option>
		<option <?php echo ($Country == 'SRB' ? 'selected' : ''); ?> value="SRB">Serbia</option>
		<option <?php echo ($Country == 'SYC' ? 'selected' : ''); ?> value="SYC">Seychelles</option>
		<option <?php echo ($Country == 'SLE' ? 'selected' : ''); ?> value="SLE">Sierra Leone</option>
		<option <?php echo ($Country == 'SGP' ? 'selected' : ''); ?> value="SGP">Singapore</option>
		<option <?php echo ($Country == 'SXM' ? 'selected' : ''); ?> value="SXM">Sint Maarten (Dutch part)</option>
		<option <?php echo ($Country == 'SVK' ? 'selected' : ''); ?> value="SVK">Slovakia</option>
		<option <?php echo ($Country == 'SVN' ? 'selected' : ''); ?> value="SVN">Slovenia</option>
		<option <?php echo ($Country == 'SLB' ? 'selected' : ''); ?> value="SLB">Solomon Islands</option>
		<option <?php echo ($Country == 'SOM' ? 'selected' : ''); ?> value="SOM">Somalia</option>
		<option <?php echo ($Country == 'ZAF' ? 'selected' : ''); ?> value="ZAF">South Africa</option>
		<option <?php echo ($Country == 'SGS' ? 'selected' : ''); ?> value="SGS">South Georgia and the South Sandwich Islands</option>
		<option <?php echo ($Country == 'SSD' ? 'selected' : ''); ?> value="SSD">South Sudan</option>
		<option <?php echo ($Country == 'ESP' ? 'selected' : ''); ?> value="ESP">Spain</option>
		<option <?php echo ($Country == 'LKA' ? 'selected' : ''); ?> value="LKA">Sri Lanka</option>
		<option <?php echo ($Country == 'SDN' ? 'selected' : ''); ?> value="SDN">Sudan</option>
		<option <?php echo ($Country == 'SUR' ? 'selected' : ''); ?> value="SUR">Suriname</option>
		<option <?php echo ($Country == 'SJM' ? 'selected' : ''); ?> value="SJM">Svalbard and Jan Mayen</option>
		<option <?php echo ($Country == 'SWZ' ? 'selected' : ''); ?> value="SWZ">Swaziland</option>
		<option <?php echo ($Country == 'SWE' ? 'selected' : ''); ?> value="SWE">Sweden</option>
		<option <?php echo ($Country == 'CHE' ? 'selected' : ''); ?> value="CHE">Switzerland</option>
		<option <?php echo ($Country == 'SYR' ? 'selected' : ''); ?> value="SYR">Syrian Arab Republic</option>
		<option <?php echo ($Country == 'TWN' ? 'selected' : ''); ?> value="TWN">Taiwan, Province of China</option>
		<option <?php echo ($Country == 'TJK' ? 'selected' : ''); ?> value="TJK">Tajikistan</option>
		<option <?php echo ($Country == 'TZA' ? 'selected' : ''); ?> value="TZA">Tanzania, United Republic of</option>
		<option <?php echo ($Country == 'THA' ? 'selected' : ''); ?> value="THA">Thailand</option>
		<option <?php echo ($Country == 'TLS' ? 'selected' : ''); ?> value="TLS">Timor-Leste</option>
		<option <?php echo ($Country == 'TGO' ? 'selected' : ''); ?> value="TGO">Togo</option>
		<option <?php echo ($Country == 'TKL' ? 'selected' : ''); ?> value="TKL">Tokelau</option>
		<option <?php echo ($Country == 'TON' ? 'selected' : ''); ?> value="TON">Tonga</option>
		<option <?php echo ($Country == 'TTO' ? 'selected' : ''); ?> value="TTO">Trinidad and Tobago</option>
		<option <?php echo ($Country == 'TUN' ? 'selected' : ''); ?> value="TUN">Tunisia</option>
		<option <?php echo ($Country == 'TUR' ? 'selected' : ''); ?> value="TUR">Turkey</option>
		<option <?php echo ($Country == 'TKM' ? 'selected' : ''); ?> value="TKM">Turkmenistan</option>
		<option <?php echo ($Country == 'TCA' ? 'selected' : ''); ?> value="TCA">Turks and Caicos Islands</option>
		<option <?php echo ($Country == 'TUV' ? 'selected' : ''); ?> value="TUV">Tuvalu</option>
		<option <?php echo ($Country == 'UGA' ? 'selected' : ''); ?> value="UGA">Uganda</option>
		<option <?php echo ($Country == 'UKR' ? 'selected' : ''); ?> value="UKR">Ukraine</option>
		<option <?php echo ($Country == 'ARE' ? 'selected' : ''); ?> value="ARE">United Arab Emirates</option>
		<option <?php echo ($Country == 'GBR' ? 'selected' : ''); ?> value="GBR">United Kingdom</option>
		<option <?php echo ($Country == 'USA' ? 'selected' : ''); ?> value="USA">United States</option>
		<option <?php echo ($Country == 'UMI' ? 'selected' : ''); ?> value="UMI">United States Minor Outlying Islands</option>
		<option <?php echo ($Country == 'URY' ? 'selected' : ''); ?> value="URY">Uruguay</option>
		<option <?php echo ($Country == 'UZB' ? 'selected' : ''); ?> value="UZB">Uzbekistan</option>
		<option <?php echo ($Country == 'VUT' ? 'selected' : ''); ?> value="VUT">Vanuatu</option>
		<option <?php echo ($Country == 'VEN' ? 'selected' : ''); ?> value="VEN">Venezuela, Bolivarian Republic of</option>
		<option <?php echo ($Country == 'VNM' ? 'selected' : ''); ?> value="VNM">Viet Nam</option>
		<option <?php echo ($Country == 'VGB' ? 'selected' : ''); ?> value="VGB">Virgin Islands, British</option>
		<option <?php echo ($Country == 'VIR' ? 'selected' : ''); ?> value="VIR">Virgin Islands, U.S.</option>
		<option <?php echo ($Country == 'WLF' ? 'selected' : ''); ?> value="WLF">Wallis and Futuna</option>
		<option <?php echo ($Country == 'ESH' ? 'selected' : ''); ?> value="ESH">Western Sahara</option>
		<option <?php echo ($Country == 'YEM' ? 'selected' : ''); ?> value="YEM">Yemen</option>
		<option <?php echo ($Country == 'ZMB' ? 'selected' : ''); ?> value="ZMB">Zambia</option>
		<option <?php echo ($Country == 'ZWE' ? 'selected' : ''); ?> value="ZWE">Zimbabwe</option>
      </select> 
    </div>
</div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-region">Region / State</label>
            <div class="col-sm-10">
              <input type="text" name="Region" value="<?php echo $Region; ?>" placeholder="Region / State" id="input-region" class="form-control">
            </div>
          </div>
		  
		  
          
       </fieldset>
       
        
        
        <fieldset>
          <legend>Newsletter</legend>
          <div class="form-group">
            <label class="col-sm-2 control-label">Subscribe</label>
            <div class="col-sm-10">
              <label class="radio-inline"><input type="radio" <?php echo ($Subscribe == 1 ? 'checked' : ''); ?> name="Subscribe" value="1">Yes</label>
              <label class="radio-inline"><input type="radio" name="Subscribe" value="0" <?php echo ($Subscribe == 0 ? 'checked' : ''); ?>>No</label>
            </div>
          </div>
        </fieldset>
        <fieldset>        
       <div class="buttons">
          <div class="col">
              <div class="col">
                  <div class="pull-right">
                    <input type="submit" value="Update" class="btn btn-primary">
                  </div>
               </div>
		  </div>
        </div>
		</fieldset>
				<input type="hidden" name="action" value="submit_form" />
              </form>

            </div>
            
            
			<h3>Shipping Information</h3>
			<div>
				
                 <?php 
		$query="SELECT FirstName, LastName, Phone,PostCode,Country,Region,City,Address
		FROM website_users WHERE ID <>0 AND Status = 1 AND ID=".$_SESSION['CustomerID'];
		$r = mysql_query($query) or die(mysql_error());
		$n = mysql_num_rows($r);
		if($n == 1)
		{
		$row =  mysql_fetch_array($r);
		?>
			<div class="row">
			<div class="col-md-6">
			 <p><b>Name:</b> <h4 class="title"><?php echo $row['FirstName'].' '.$row['LastName']; ?></h4></p>
			 <p><b>Phone:</b> <h4 class="title"><?php echo $row['Phone']; ?></h4></p>
			</div>
			<div class="col-md-6">
			 <p><b>Address:</b> <h4 class="title"><?php echo $row['Address'].',<br/>'.$row['City'].', '.$row['Region'].',<br/>'; getCountryByCode($row['Country']); echo ', '.$row['PostCode'];?></h4></p>
			</div>
			</div>
			
		<?php 
		}
		?>
        
			</div>
           
			<h3>Reset Password</h3>
			<div>
				<div class="col">
			<?php
		  		echo $msg2;
				echo $msg3;
				if(isset($_SESSION["msg2"]))
				{
					echo $_SESSION["msg2"];
					$_SESSION["msg2"]="";
				}
			?>
            </div>
      <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        

        <fieldset>
          <legend>Previous Login Info</legend>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password">EmailAddress</label>
            <div class="col-sm-10">
              <input type="text" name="OldEmailAddress" value="<?php echo $OldEmailAddress; ?>" placeholder="EmailAddress" id="input-password" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm">Current Password</label>
            <div class="col-sm-10">
              <input type="password" name="OldPassword" value="<?php echo $OldPassword; ?>" placeholder="Current Password" id="input-confirm" class="form-control">
            </div>
          </div>
        
        </fieldset>
		
		<fieldset>
          <legend>Change Password</legend>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password">New Password</label>
            <div class="col-sm-10">
              <input type="password" name="NewPassword" value="" placeholder="New Password" id="input-password" class="form-control">
            </div>
          </div>
          
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm">Confirm Password</label>
            <div class="col-sm-10">
              <input type="password" name="NewPassword2" value="" placeholder="Confirm Password" id="input-confirm" class="form-control">
            </div>
          </div>
        
        </fieldset>
        
        
        <fieldset>        
       <div class="buttons">
          <div class="col">
              <div class="col">
                  <div class="pull-right">
                    <input type="submit" value="Reset" class="btn btn-primary">
                  </div>
               </div>
		  </div>
        </div>
		</fieldset>
				<input type="hidden" name="action2" value="submit_form" />
              </form>
        
        
			</div>
            
            
            <h3>Order History</h3>
			<div>
            <div class="row">
        <div class="col-sm-3">
            <a href="#" class="nav-tabs-dropdown btn btn-block btn-primary">Orders</a>
            <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-pills nav-stacked well">
            <?php
	$query="SELECT o.ID,o.Shippings,o.Discount, u.FirstName,u.LastName,u.Gender,u.Address,u.City,u.Region,u.Country,u.PostCode,u.Phone,u.Email,u.Fax,u.IP,o.Status,o.CancleReason,o.ReturnReason,o.ReShipping,DATE_FORMAT(o.DateAdded, '%D %b %Y %r') AS DateAdded FROM orders o LEFT JOIN website_users u ON o.CustomerID = u.ID WHERE  o.CustomerID='" . (int)$_SESSION["CustomerID"] . "' Order By ID DESC";
	$result = mysql_query($query) or die("Could not select Role because: ".mysql_error()); 
	$result2 = mysql_query($query) or die("Could not select Role because: ".mysql_error()); 
	$num = mysql_num_rows($result);
	$i = 0; 
	while($iii = mysql_fetch_array($result))
	{ $i++;
?>
              <li <?php echo ($i == 1 ? 'class="active"' : ''); ?>><a href="#vtab<?php echo $i; ?>" data-toggle="tab">Order#<?php echo $iii["ID"]; ?></a></li>
<?php
	}
	?>
            </ul>
        </div>


				
                
                <div class="col-sm-9">
            <div class="tab-content">
			<?php
			$i = 0;
			while($row = mysql_fetch_array($result2))
			{ $i++
				?>
                <div role="tabpanel" class="tab-pane fade <?php echo ($i == 1 ? 'in active' : ''); ?>" id="vtab<?php echo $i; ?>">
<?php
	$optiontotal=0;
		$ID=$row["ID"];
		$ReShipping=$row["ReShipping"];
		$Status=$row["Status"];
		$CancleReason=$row["CancleReason"];
		$ReturnReason=$row["ReturnReason"];
		$FirstName=$row["FirstName"];
		$LastName=$row["LastName"];
		$Gender=$row["Gender"];
		$Address=$row["Address"];
		$City=$row["City"];
		$Region=$row["Region"];
		$Country=$row["Country"];
		$PostCode=$row["PostCode"];
		$Phone=$row["Phone"];
		$Email=$row["Email"];
		$Fax=$row["Fax"];
		$IP=$row["IP"];
		$Shippings=$row["Shippings"];
		$Discount=$row["Discount"];
		$DateAdded=$row["DateAdded"];
?>
        <div class="col-md-6 no-print">
          <div class="box">
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
              <!-- form start -->
              <div class="box-body">
			  
			  <div class="form-group">
                  <label id="labelimp" >Order Status: </label>
                  <?php $s = mysql_query("SELECT ID, OrderStatus FROM order_status WHERE Status=1") or die(mysql_error());
					while($ss = mysql_fetch_array($s))
					{ ?>
				  <?php echo ($Status == $ss["ID"] ? $ss["OrderStatus"] : ''); ?>
				  <?php
					} ?>
                </div>
				<?php
				if($ReturnReason != "")
				{ ?>
				<div class="form-group">
                  <label id="labelimp" for="CancleReason" >Cancle Reason: </label>
                  <?php 
					echo $CancleReason;
				  ?>
                </div>
				<?php
				}
				?>				
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		
		<div class="col-md-6">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label id="labelimp" >Order Date: </label>
                  <label>
                  <?php echo $DateAdded; ?></label>
                  
                </div>
				<?php
				if($ReturnReason != "")
				{ ?>
				<div class="form-group">
                  <label id="labelimp" for="ReturnReason" >Return Reason: </label>
                  <?php 
					echo $ReturnReason;
				  ?>
                </div>			   
                <div class="form-group">
                  <label id="labelimp" >Re Shipping: </label>
                  <label>
                  <?php echo ($ReShipping == 1 ? 'Yes' : 'No'); ?></label>
                </div>
				<?php
				}
				?>
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		</div>
		<div class="col-md-12">
          <div class="box">
          
            <!-- general form elements -->
            <div style="padding:15px;" class="box-primary">
            
              <!-- form start -->
              <div class="box-body">
               
			   <label id="labelimp" >Shipping Details: </label>
				
				<div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-left">Name</td>
                <td class="text-left">Address</td>
                <td class="text-left">Postal Code</td>
                <td class="text-left">Phone</td> 
				<td class="text-left">Email</td>
              </tr>
            </thead>
            <tbody>
					<?php
					$query="SELECT ID,Name,Address,PostCode,Phone,Email FROM orders WHERE ID='" . (int)$ID . "'";
					$res = mysql_query($query) or die(mysql_error());
					$number = mysql_num_rows($res);
					
					if($number > 0)
					{
						while($row = mysql_fetch_array($res))
						{
					?>
						<tr>
							<td>
								<?php echo $row["Name"]; ?>
							</td>
							<td>
								<?php echo $row["Address"]; ?>
							</td>
							<td>
								<?php echo $row["PostCode"]; ?>
							</td>
							<td>
								<?php echo $row["Phone"]; ?>
							</td>
							<td class="text-left">
								<?php echo $row["Email"]; ?>
							</td>
						</tr>
					<?php
						}
					}
					?>
            </tbody>
          </table>
			   <label id="labelimp" >Order Details: </label>
				
				<div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-center">Image</td>
                <td class="text-left">Product Name</td>
                <td class="text-left">Options</td>
                <td class="text-left">Shipping Charges</td> 
				<td class="text-left">Quantity</td>
				<td class="text-right">Option Charges</td>
                <td class="text-right">Unit Price</td>
                <td class="text-right">Total</td>
				<!--<td class="text-center">Remove</td>-->
              </tr>
            </thead>
            <tbody>
					<?php
					$query="SELECT ProductID,Product,Shipping,Options,OptionsCharges,Quantity,Price FROM orders_details WHERE OrderID=".$ID."";
					$res = mysql_query($query) or die(mysql_error());
					$number = mysql_num_rows($res);
					
					if($number > 0)
					{
						while($row = mysql_fetch_array($res))
						{
						
						$query2="SELECT Image FROM products WHERE ID=".$row['ProductID'];
						$res2 = mysql_query($query2) or die(mysql_error());
						$row2=mysql_fetch_array($res2);
						$Image=explode(',', $row2["Image"]);
						$img1 = $Image[0];
					?>
						<tr>
							<td class="text-center">            
								<img src="admin/<?php echo DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-thumbnail" style="height:100px;">
							</td>
							<td>
								<?php echo dboutput($row['Product']); ?>
							</td>
							<td>
								<?php
									echo str_replace(",","<br>","".$row['Options']."");
								?>
							</td>
							<td><?php echo ($row['Shipping'] == 1 ? 'Free Shipping' : $Shippings.'%'); ?></td>
							<!--<td class="text-left">
								<form action="update_quantity.php" method="GET">
								<div class="input-group btn-block" style="max-width: 200px;">
								<input type="text" name="quantity" value="<?php echo $row['Quantity']; ?>" size="1" class="form-control custom-padding">
								<span class="input-group-btn">
								<button type="submit" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Update"><i class="fa fa-refresh"></i></button>
								</span></div>
								</form>
							</td>-->
							<td class="text-left">
							<?php echo $row['Quantity']; ?>
							</td>
							<td class="text-right">
							<?php echo CURRENCY_SYMBOL.$row['OptionsCharges']; ?>
							</td>
							<td class="text-right">
							<?php echo CURRENCY_SYMBOL.$row['Price']; ?>
							</td>
							<td class="text-right">
							<?php
							echo CURRENCY_SYMBOL.round(($row['Price'] * $row['Quantity']) + $row['OptionsCharges']);
							?>
							</td>
							<!--<td class="text-center"><button type="button" onclick="location.href='remove_from_cart.php?id=<?php //echo $row['ID']; ?>&name=<?php //echo $row['ProductName']; ?>&url=<?php //echo $_SERVER['REQUEST_URI']; ?>'" title="Remove" class="btn btn-danger btn-sm">Remove</button></td>-->
						</tr>
					<?php
						$subtotal = ($row['Price'] * $row['Quantity']) + $subtotal;
						$optiontotal = $row['OptionsCharges'] + $optiontotal;
						if($row['Shipping'] == 2)
						{
					$shippingAmount = ((($Shippings / 100) * $row['Price']) * $row['Quantity']) + $shippingAmount;
							$shippingAmount = number_format((float)$shippingAmount, 2, '.', '');
						}
						}
					}
					else
					{
					?>
						<tr>
							<td colspan="9" class="text-center">
								Order Cart is Empty!
							</td>
						</tr>
					<?php
					}
					?>
			  
            </tbody>
          </table>
        </div>
				
            </div>
            <!-- /.box -->
            <!-- Form Element sizes -->
          </div>
        </div>
		</div>
		<div style="background-color:white;" class="col-sm-8 col-sm-offset-4">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td class="text-right"><strong>Sub-Total</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><?php echo round($subtotal); ?></td>
				</tr>
				<tr>
					<td class="text-right"><strong>Option-Increment</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><?php echo round($optiontotal); ?></td>
				</tr>
				<tr>
					<td class="text-right"><strong>Shipping-Charges</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><?php echo round($shippingAmount); ?></td>
				</tr>
				<tr>
					<td class="text-right"><strong>Total</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><h4 class="title"><?php echo round($subtotal+$optiontotal+$shippingAmount); ?></h4></td>
				</tr>
			</tbody>
		</table>
		</div>
      </section>
    </form>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
                </div>
				<?php
				}
				?>
                
</div></div></div>
			</div>

		</div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/ziehharmonika.js"></script>
<script>
$(document).ready(function() {
		$('.ziehharmonika').ziehharmonika({
			collapsible: true,
			prefix: '★'
		});
	});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	<!--footer-->
	<?php include("footer.php"); ?>
	<!--//footer-->		
	<!--search jQuery-->
	<script src="js/main.js"></script>
	<!--//search jQuery-->
	<!--smooth-scrolling-of-move-up-->
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!--//smooth-scrolling-of-move-up-->
	<!--Bootstrap core JavaScript
    ================================================== -->
    <!--Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>