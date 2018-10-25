<?php include("admin/Common.php"); ?>
<?php $CatID=99999; ?>
<?php 
if(!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items']))
{
	redirect("cart.php");
} 
?>
<?php
	$email="";
	$password="";
	$msg1 = "";
	$msg2 = "";
	$msg3 = "";
	if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
	{
		if(isset($_POST["email"]))
			$email=trim($_POST["email"]);
		if(isset($_POST["password"]))
			$password=trim($_POST["password"]);
			
		if ($email=="")
			$msg1 = '<p style="color:red">Please Enter EmailAddress.</p>';
		if ($password=="")
			$msg2 = '<p style="color:red">Please Enter Password.</p>';
			
		if($msg1=='' && $msg2=='')
		{	
			$query="SELECT ID,FirstName,LastName,Password,Country FROM website_users WHERE Status = 1 AND Email='".dbinput($email)."'";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
			
			
			if($num==0)
			{
				$_SESSION["LoginCustomer"]=false;
				$_SESSION["CustomerID"]='';
				$_SESSION["CustomerFullName"]='';
				$_SESSION["Country"]='';
				$_SESSION["Shipping"]='';
				$msg3 = '<p style="color:red">Invalid Email/Password.</p>';	
			}
			else
			{
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
				if(dboutput($row["Password"]) == $password)
				{
					$_SESSION["LoginCustomer"]=true;
					$_SESSION["CustomerID"]=dboutput($row["ID"]);
					$_SESSION["CustomerFullName"]=dboutput($row["FirstName"]) .' '. dboutput($row["LastName"]);
					$_SESSION["Country"]=dboutput($row["Country"]);
					
					$query2="SELECT Percentage FROM shipping_rates WHERE CountryCode='".$row["Country"]."'";
					$result2 = mysql_query ($query2) or die(mysql_error()); 
					$num2 = mysql_num_rows($result2);
					if($num2 > 0)
					{
						$row2 = mysql_fetch_array($result2,MYSQL_ASSOC);
						$_SESSION["Shipping"]=dboutput($row2["Percentage"]);
					}
					else
					{
						$query3="SELECT Percentage FROM other_countries_shipping WHERE ID=1";
						$result3 = mysql_query ($query3) or die(mysql_error()); 
						$num3 = mysql_num_rows($result3);
						if($num3 == 1)
						{
							$row3 = mysql_fetch_array($result3,MYSQL_ASSOC);
							$_SESSION["Shipping"]=dboutput($row3["Percentage"]);
						}
					}
					
					
					redirect("checkout.php");
				}
				else
				{
					$_SESSION["LoginCustomer"]=false;
					$_SESSION["CustomerID"]='';
					$_SESSION["CustomerFullName"]='';
					$_SESSION["Country"]='';
					$_SESSION["Shipping"]='';
					$msg3 = '<p style="color:red">Invalid Email/Password.</p>';
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
<title>Checkout - <?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo SiteTitle; ?>" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel='shortcut icon' href='admin/<?php echo DIR_LOGOS.$_SETTINGS_Header_LOGO; ?>' type='image/x-icon' ><!--Custom Theme files -->
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
</head>
<body>
	<!--header-->
	<?php include("header.php"); ?>
	<!--//header-->
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Checkout</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--contact-->
	<div class="contact">
		<div class="container">
			<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
				<h3 class="title">Check<span>out</span></h3>
			</div>
   <div class="col-md-12">    
    <div id="MainMenu" class="accordians">
      <div class="list-group panel">
        <a href="#checkoutmethod" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#MainMenu"><span class="number">1.</span> Login</a>
        <?php if(!isset($_SESSION['LoginCustomer']) || $_SESSION['LoginCustomer']==false){ ?>
		<div class="collapse common <?php if(!isset($_SESSION['LoginCustomer']) || $_SESSION['LoginCustomer']==false){ echo 'in';} ?>" id="checkoutmethod">
            <div class="row">
            <div class="col-sm-6">
              <div class="well">
                <h2>New Customer</h2>
                <p><strong>Register Account</strong></p>
                <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                <a href="register.php" class="btn btn-primary" style="color:#fff;">Continue</a>
                
                 </div>
            </div>
            <div class="col-sm-6">
			  <div class="well">
				<h2>Returning Customer</h2>
				<p><strong>I am a returning customer</strong></p>
				<?php 
				if(isset($msg3))
				echo $msg3
				?>
				<form action="<?php echo $_SERVER["REQUEST_URI"];?>" method="post" enctype="multipart/form-data">
				  <div class="form-group">
					<label class="control-label" for="input-email">Email Address</label>
					<?php if(isset($msg1)){echo $msg1;}?>
					<input type="text" name="email" value="<?php echo $email; ?>" placeholder="E-Mail Address" id="input-email" class="form-control">
				  </div>
				  <div class="form-group">
					<label class="control-label" for="input-password">Password</label>
					<?php if(isset($msg2)){echo $msg2;}?>
					<input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control">
					<!--<a href="">Forgotten Password</a>--></div>
				  <input type="submit" value="Login" class="btn btn-primary">
				  <input type="hidden" name="action" value="submit_form" />
				</form>
			  </div>
			</div>         
			</div>         
        </div>
		<?php } ?>
        
      
		<form action="OrderSuccess.php" method="POST">
        <a href="#shippinginfo" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#MainMenu">
        <span class="number">2. </span> Shipping Information <?php echo (isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true) ? '' : '(login first)'; ?></a>
        <?php if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true){ ?>
        <div class="collapse common <?php if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true){ echo 'in';} ?>" id="shippinginfo">
			<div class="row">
			<div class="col-md-12">
        <?php 
		$query="SELECT FirstName, LastName, Phone,PostCode,Country,Region,City,Address
		FROM website_users WHERE ID <>0 AND Status = 1 AND ID=".$_SESSION['CustomerID'];
		$r = mysql_query($query) or die(mysql_error());
		$n = mysql_num_rows($r);
		if($n == 1)
		{
		$row =  mysql_fetch_array($r);
		?>
			<div class="col-md-6">
			 <p><br/><b>Name:</b> <h4 class="title"><input type="text" class="form-control" name="CustomerName" value="<?php echo $row['FirstName'].' '.$row['LastName']; ?>" /></h4></p>
			 <p><br/><b>Address:</b> <h4 class="title"><textarea name="CustomerAddress" class="form-control" ><?php echo $row['Address'].', '.$row['City'].', '.$row['Region'].', '; getCountryByCode($row['Country']); echo ', '.$row['PostCode'];?></textarea></h4></p>
			</div>
			<div class="col-md-6">
			 <p><br/><b>Phone:</b> <h4 class="title"><input type="text" name="CustomerPhone" class="form-control" value="<?php echo $row['Phone']; ?>" /></h4></p>
			 <p><br/><b>Country:</b> <h4 class="title">
			     <select name="Country" id="input-country" class="form-control">
        <option <?php echo ($row['Country'] == 'XXX' ? 'selected' : ''); ?> value="XXX"> --- Please Select --- </option>
        <option <?php echo ($row['Country'] == 'AFG' ? 'selected' : ''); ?> value="AFG">Afghanistan</option>
		<option <?php echo ($row['Country'] == 'ALA' ? 'selected' : ''); ?> value="ALA">Aland Islands</option>
		<option <?php echo ($row['Country'] == 'ALB' ? 'selected' : ''); ?> value="ALB">Albania</option>
		<option <?php echo ($row['Country'] == 'DZA' ? 'selected' : ''); ?> value="DZA">Algeria</option>
		<option <?php echo ($row['Country'] == 'ASM' ? 'selected' : ''); ?> value="ASM">American Samoa</option>
		<option <?php echo ($row['Country'] == 'AND' ? 'selected' : ''); ?> value="AND">Andorra</option>
		<option <?php echo ($row['Country'] == 'AGO' ? 'selected' : ''); ?> value="AGO">Angola</option>
		<option <?php echo ($row['Country'] == 'AIA' ? 'selected' : ''); ?> value="AIA">Anguilla</option>
		<option <?php echo ($row['Country'] == 'ATA' ? 'selected' : ''); ?> value="ATA">Antarctica</option>
		<option <?php echo ($row['Country'] == 'ATG' ? 'selected' : ''); ?> value="ATG">Antigua and Barbuda</option>
		<option <?php echo ($row['Country'] == 'ARG' ? 'selected' : ''); ?> value="ARG">Argentina</option>
		<option <?php echo ($row['Country'] == 'ARM' ? 'selected' : ''); ?> value="ARM">Armenia</option>
		<option <?php echo ($row['Country'] == 'ABW' ? 'selected' : ''); ?> value="ABW">Aruba</option>
		<option <?php echo ($row['Country'] == 'AUS' ? 'selected' : ''); ?> value="AUS">Australia</option>
		<option <?php echo ($row['Country'] == 'AUT' ? 'selected' : ''); ?> value="AUT">Austria</option>
		<option <?php echo ($row['Country'] == 'AZE' ? 'selected' : ''); ?> value="AZE">Azerbaijan</option>
		<option <?php echo ($row['Country'] == 'BHS' ? 'selected' : ''); ?> value="BHS">Bahamas</option>
		<option <?php echo ($row['Country'] == 'BHR' ? 'selected' : ''); ?> value="BHR">Bahrain</option>
		<option <?php echo ($row['Country'] == 'BGD' ? 'selected' : ''); ?> value="BGD">Bangladesh</option>
		<option <?php echo ($row['Country'] == 'BRB' ? 'selected' : ''); ?> value="BRB">Barbados</option>
		<option <?php echo ($row['Country'] == 'BLR' ? 'selected' : ''); ?> value="BLR">Belarus</option>
		<option <?php echo ($row['Country'] == 'BEL' ? 'selected' : ''); ?> value="BEL">Belgium</option>
		<option <?php echo ($row['Country'] == 'BLZ' ? 'selected' : ''); ?> value="BLZ">Belize</option>
		<option <?php echo ($row['Country'] == 'BEN' ? 'selected' : ''); ?> value="BEN">Benin</option>
		<option <?php echo ($row['Country'] == 'BMU' ? 'selected' : ''); ?> value="BMU">Bermuda</option>
		<option <?php echo ($row['Country'] == 'BTN' ? 'selected' : ''); ?> value="BTN">Bhutan</option>
		<option <?php echo ($row['Country'] == 'BOL' ? 'selected' : ''); ?> value="BOL">Bolivia, Plurinational State of</option>
		<option <?php echo ($row['Country'] == 'BES' ? 'selected' : ''); ?> value="BES">Bonaire, Sint Eustatius and Saba</option>
		<option <?php echo ($row['Country'] == 'BIH' ? 'selected' : ''); ?> value="BIH">Bosnia and Herzegovina</option>
		<option <?php echo ($row['Country'] == 'BWA' ? 'selected' : ''); ?> value="BWA">Botswana</option>
		<option <?php echo ($row['Country'] == 'BVT' ? 'selected' : ''); ?> value="BVT">Bouvet Island</option>
		<option <?php echo ($row['Country'] == 'BRA' ? 'selected' : ''); ?> value="BRA">Brazil</option>
		<option <?php echo ($row['Country'] == 'IOT' ? 'selected' : ''); ?> value="IOT">British Indian Ocean Territory</option>
		<option <?php echo ($row['Country'] == 'BRN' ? 'selected' : ''); ?> value="BRN">Brunei Darussalam</option>
		<option <?php echo ($row['Country'] == 'BGR' ? 'selected' : ''); ?> value="BGR">Bulgaria</option>
		<option <?php echo ($row['Country'] == 'BFA' ? 'selected' : ''); ?> value="BFA">Burkina Faso</option>
		<option <?php echo ($row['Country'] == 'BDI' ? 'selected' : ''); ?> value="BDI">Burundi</option>
		<option <?php echo ($row['Country'] == 'KHM' ? 'selected' : ''); ?> value="KHM">Cambodia</option>
		<option <?php echo ($row['Country'] == 'CMR' ? 'selected' : ''); ?> value="CMR">Cameroon</option>
		<option <?php echo ($row['Country'] == 'CAN' ? 'selected' : ''); ?> value="CAN">Canada</option>
		<option <?php echo ($row['Country'] == 'CPV' ? 'selected' : ''); ?> value="CPV">Cape Verde</option>
		<option <?php echo ($row['Country'] == 'CYM' ? 'selected' : ''); ?> value="CYM">Cayman Islands</option>
		<option <?php echo ($row['Country'] == 'CAF' ? 'selected' : ''); ?> value="CAF">Central African Republic</option>
		<option <?php echo ($row['Country'] == 'TCD' ? 'selected' : ''); ?> value="TCD">Chad</option>
		<option <?php echo ($row['Country'] == 'CHL' ? 'selected' : ''); ?> value="CHL">Chile</option>
		<option <?php echo ($row['Country'] == 'CHN' ? 'selected' : ''); ?> value="CHN">China</option>
		<option <?php echo ($row['Country'] == 'CXR' ? 'selected' : ''); ?> value="CXR">Christmas Island</option>
		<option <?php echo ($row['Country'] == 'CCK' ? 'selected' : ''); ?> value="CCK">Cocos (Keeling) Islands</option>
		<option <?php echo ($row['Country'] == 'COL' ? 'selected' : ''); ?> value="COL">Colombia</option>
		<option <?php echo ($row['Country'] == 'COM' ? 'selected' : ''); ?> value="COM">Comoros</option>
		<option <?php echo ($row['Country'] == 'COG' ? 'selected' : ''); ?> value="COG">Congo</option>
		<option <?php echo ($row['Country'] == 'COD' ? 'selected' : ''); ?> value="COD">Congo, the Democratic Republic of the</option>
		<option <?php echo ($row['Country'] == 'COK' ? 'selected' : ''); ?> value="COK">Cook Islands</option>
		<option <?php echo ($row['Country'] == 'CRI' ? 'selected' : ''); ?> value="CRI">Costa Rica</option>
		<option <?php echo ($row['Country'] == 'CIV' ? 'selected' : ''); ?> value="CIV">Côte d'Ivoire</option>
		<option <?php echo ($row['Country'] == 'HRV' ? 'selected' : ''); ?> value="HRV">Croatia</option>
		<option <?php echo ($row['Country'] == 'CUB' ? 'selected' : ''); ?> value="CUB">Cuba</option>
		<option <?php echo ($row['Country'] == 'CUW' ? 'selected' : ''); ?> value="CUW">Curaçao</option>
		<option <?php echo ($row['Country'] == 'CYP' ? 'selected' : ''); ?> value="CYP">Cyprus</option>
		<option <?php echo ($row['Country'] == 'CZE' ? 'selected' : ''); ?> value="CZE">Czech Republic</option>
		<option <?php echo ($row['Country'] == 'DNK' ? 'selected' : ''); ?> value="DNK">Denmark</option>
		<option <?php echo ($row['Country'] == 'DJI' ? 'selected' : ''); ?> value="DJI">Djibouti</option>
		<option <?php echo ($row['Country'] == 'DMA' ? 'selected' : ''); ?> value="DMA">Dominica</option>
		<option <?php echo ($row['Country'] == 'DOM' ? 'selected' : ''); ?> value="DOM">Dominican Republic</option>
		<option <?php echo ($row['Country'] == 'ECU' ? 'selected' : ''); ?> value="ECU">Ecuador</option>
		<option <?php echo ($row['Country'] == 'EGY' ? 'selected' : ''); ?> value="EGY">Egypt</option>
		<option <?php echo ($row['Country'] == 'SLV' ? 'selected' : ''); ?> value="SLV">El Salvador</option>
		<option <?php echo ($row['Country'] == 'GNQ' ? 'selected' : ''); ?> value="GNQ">Equatorial Guinea</option>
		<option <?php echo ($row['Country'] == 'ERI' ? 'selected' : ''); ?> value="ERI">Eritrea</option>
		<option <?php echo ($row['Country'] == 'EST' ? 'selected' : ''); ?> value="EST">Estonia</option>
		<option <?php echo ($row['Country'] == 'ETH' ? 'selected' : ''); ?> value="ETH">Ethiopia</option>
        <option <?php echo ($row['Country'] == 'EUR' ? 'selected' : ''); ?> value="EUR">Europe</option>
		<option <?php echo ($row['Country'] == 'FLK' ? 'selected' : ''); ?> value="FLK">Falkland Islands (Malvinas)</option>
		<option <?php echo ($row['Country'] == 'FRO' ? 'selected' : ''); ?> value="FRO">Faroe Islands</option>
		<option <?php echo ($row['Country'] == 'FJI' ? 'selected' : ''); ?> value="FJI">Fiji</option>
		<option <?php echo ($row['Country'] == 'FIN' ? 'selected' : ''); ?> value="FIN">Finland</option>
		<option <?php echo ($row['Country'] == 'FRA' ? 'selected' : ''); ?> value="FRA">France</option>
		<option <?php echo ($row['Country'] == 'GUF' ? 'selected' : ''); ?> value="GUF">French Guiana</option>
		<option <?php echo ($row['Country'] == 'PYF' ? 'selected' : ''); ?> value="PYF">French Polynesia</option>
		<option <?php echo ($row['Country'] == 'ATF' ? 'selected' : ''); ?> value="ATF">French Southern Territories</option>
		<option <?php echo ($row['Country'] == 'GAB' ? 'selected' : ''); ?> value="GAB">Gabon</option>
		<option <?php echo ($row['Country'] == 'GMB' ? 'selected' : ''); ?> value="GMB">Gambia</option>
		<option <?php echo ($row['Country'] == 'GEO' ? 'selected' : ''); ?> value="GEO">Georgia</option>
		<option <?php echo ($row['Country'] == 'DEU' ? 'selected' : ''); ?> value="DEU">Germany</option>
		<option <?php echo ($row['Country'] == 'GHA' ? 'selected' : ''); ?> value="GHA">Ghana</option>
		<option <?php echo ($row['Country'] == 'GIB' ? 'selected' : ''); ?> value="GIB">Gibraltar</option>
		<option <?php echo ($row['Country'] == 'GRC' ? 'selected' : ''); ?> value="GRC">Greece</option>
		<option <?php echo ($row['Country'] == 'GRL' ? 'selected' : ''); ?> value="GRL">Greenland</option>
		<option <?php echo ($row['Country'] == 'GRD' ? 'selected' : ''); ?> value="GRD">Grenada</option>
		<option <?php echo ($row['Country'] == 'GLP' ? 'selected' : ''); ?> value="GLP">Guadeloupe</option>
		<option <?php echo ($row['Country'] == 'GUM' ? 'selected' : ''); ?> value="GUM">Guam</option>
		<option <?php echo ($row['Country'] == 'GTM' ? 'selected' : ''); ?> value="GTM">Guatemala</option>
		<option <?php echo ($row['Country'] == 'GGY' ? 'selected' : ''); ?> value="GGY">Guernsey</option>
		<option <?php echo ($row['Country'] == 'GIN' ? 'selected' : ''); ?> value="GIN">Guinea</option>
		<option <?php echo ($row['Country'] == 'GNB' ? 'selected' : ''); ?> value="GNB">Guinea-Bissau</option>
		<option <?php echo ($row['Country'] == 'GUY' ? 'selected' : ''); ?> value="GUY">Guyana</option>
		<option <?php echo ($row['Country'] == 'HTI' ? 'selected' : ''); ?> value="HTI">Haiti</option>
		<option <?php echo ($row['Country'] == 'HMD' ? 'selected' : ''); ?> value="HMD">Heard Island and McDonald Islands</option>
		<option <?php echo ($row['Country'] == 'VAT' ? 'selected' : ''); ?> value="VAT">Holy See (Vatican City State)</option>
		<option <?php echo ($row['Country'] == 'HND' ? 'selected' : ''); ?> value="HND">Honduras</option>
		<option <?php echo ($row['Country'] == 'HKG' ? 'selected' : ''); ?> value="HKG">Hong Kong</option>
		<option <?php echo ($row['Country'] == 'HUN' ? 'selected' : ''); ?> value="HUN">Hungary</option>
		<option <?php echo ($row['Country'] == 'ISL' ? 'selected' : ''); ?> value="ISL">Iceland</option>
		<option <?php echo ($row['Country'] == 'IND' ? 'selected' : ''); ?> value="IND">India</option>
		<option <?php echo ($row['Country'] == 'IDN' ? 'selected' : ''); ?> value="IDN">Indonesia</option>
		<option <?php echo ($row['Country'] == 'IRN' ? 'selected' : ''); ?> value="IRN">Iran, Islamic Republic of</option>
		<option <?php echo ($row['Country'] == 'IRQ' ? 'selected' : ''); ?> value="IRQ">Iraq</option>
		<option <?php echo ($row['Country'] == 'IRL' ? 'selected' : ''); ?> value="IRL">Ireland</option>
		<option <?php echo ($row['Country'] == 'IMN' ? 'selected' : ''); ?> value="IMN">Isle of Man</option>
		<option <?php echo ($row['Country'] == 'ISR' ? 'selected' : ''); ?> value="ISR">Israel</option>
		<option <?php echo ($row['Country'] == 'ITA' ? 'selected' : ''); ?> value="ITA">Italy</option>
		<option <?php echo ($row['Country'] == 'JAM' ? 'selected' : ''); ?> value="JAM">Jamaica</option>
		<option <?php echo ($row['Country'] == 'JPN' ? 'selected' : ''); ?> value="JPN">Japan</option>
		<option <?php echo ($row['Country'] == 'JEY' ? 'selected' : ''); ?> value="JEY">Jersey</option>
		<option <?php echo ($row['Country'] == 'JOR' ? 'selected' : ''); ?> value="JOR">Jordan</option>
		<option <?php echo ($row['Country'] == 'KAZ' ? 'selected' : ''); ?> value="KAZ">Kazakhstan</option>
		<option <?php echo ($row['Country'] == 'KEN' ? 'selected' : ''); ?> value="KEN">Kenya</option>
		<option <?php echo ($row['Country'] == 'KIR' ? 'selected' : ''); ?> value="KIR">Kiribati</option>
		<option <?php echo ($row['Country'] == 'PRK' ? 'selected' : ''); ?> value="PRK">Korea, Democratic People's Republic of</option>
		<option <?php echo ($row['Country'] == 'KOR' ? 'selected' : ''); ?> value="KOR">Korea, Republic of</option>
		<option <?php echo ($row['Country'] == 'KWT' ? 'selected' : ''); ?> value="KWT">Kuwait</option>
		<option <?php echo ($row['Country'] == 'KGZ' ? 'selected' : ''); ?> value="KGZ">Kyrgyzstan</option>
		<option <?php echo ($row['Country'] == 'LAO' ? 'selected' : ''); ?> value="LAO">Lao People's Democratic Republic</option>
		<option <?php echo ($row['Country'] == 'LVA' ? 'selected' : ''); ?> value="LVA">Latvia</option>
		<option <?php echo ($row['Country'] == 'LBN' ? 'selected' : ''); ?> value="LBN">Lebanon</option>
		<option <?php echo ($row['Country'] == 'LSO' ? 'selected' : ''); ?> value="LSO">Lesotho</option>
		<option <?php echo ($row['Country'] == 'LBR' ? 'selected' : ''); ?> value="LBR">Liberia</option>
		<option <?php echo ($row['Country'] == 'LBY' ? 'selected' : ''); ?> value="LBY">Libya</option>
		<option <?php echo ($row['Country'] == 'LIE' ? 'selected' : ''); ?> value="LIE">Liechtenstein</option>
		<option <?php echo ($row['Country'] == 'LTU' ? 'selected' : ''); ?> value="LTU">Lithuania</option>
		<option <?php echo ($row['Country'] == 'LUX' ? 'selected' : ''); ?> value="LUX">Luxembourg</option>
		<option <?php echo ($row['Country'] == 'MAC' ? 'selected' : ''); ?> value="MAC">Macao</option>
		<option <?php echo ($row['Country'] == 'MKD' ? 'selected' : ''); ?> value="MKD">Macedonia, the former Yugoslav Republic of</option>
		<option <?php echo ($row['Country'] == 'MDG' ? 'selected' : ''); ?> value="MDG">Madagascar</option>
		<option <?php echo ($row['Country'] == 'MWI' ? 'selected' : ''); ?> value="MWI">Malawi</option>
		<option <?php echo ($row['Country'] == 'MYS' ? 'selected' : ''); ?> value="MYS">Malaysia</option>
		<option <?php echo ($row['Country'] == 'MDV' ? 'selected' : ''); ?> value="MDV">Maldives</option>
		<option <?php echo ($row['Country'] == 'MLI' ? 'selected' : ''); ?> value="MLI">Mali</option>
		<option <?php echo ($row['Country'] == 'MLT' ? 'selected' : ''); ?> value="MLT">Malta</option>
		<option <?php echo ($row['Country'] == 'MHL' ? 'selected' : ''); ?> value="MHL">Marshall Islands</option>
		<option <?php echo ($row['Country'] == 'MTQ' ? 'selected' : ''); ?> value="MTQ">Martinique</option>
		<option <?php echo ($row['Country'] == 'MRT' ? 'selected' : ''); ?> value="MRT">Mauritania</option>
		<option <?php echo ($row['Country'] == 'MUS' ? 'selected' : ''); ?> value="MUS">Mauritius</option>
		<option <?php echo ($row['Country'] == 'MYT' ? 'selected' : ''); ?> value="MYT">Mayotte</option>
		<option <?php echo ($row['Country'] == 'MEX' ? 'selected' : ''); ?> value="MEX">Mexico</option>
		<option <?php echo ($row['Country'] == 'FSM' ? 'selected' : ''); ?> value="FSM">Micronesia, Federated States of</option>
		<option <?php echo ($row['Country'] == 'MDA' ? 'selected' : ''); ?> value="MDA">Moldova, Republic of</option>
		<option <?php echo ($row['Country'] == 'MCO' ? 'selected' : ''); ?> value="MCO">Monaco</option>
		<option <?php echo ($row['Country'] == 'MNG' ? 'selected' : ''); ?> value="MNG">Mongolia</option>
		<option <?php echo ($row['Country'] == 'MNE' ? 'selected' : ''); ?> value="MNE">Montenegro</option>
		<option <?php echo ($row['Country'] == 'MSR' ? 'selected' : ''); ?> value="MSR">Montserrat</option>
		<option <?php echo ($row['Country'] == 'MAR' ? 'selected' : ''); ?> value="MAR">Morocco</option>
		<option <?php echo ($row['Country'] == 'MOZ' ? 'selected' : ''); ?> value="MOZ">Mozambique</option>
		<option <?php echo ($row['Country'] == 'MMR' ? 'selected' : ''); ?> value="MMR">Myanmar</option>
		<option <?php echo ($row['Country'] == 'NAM' ? 'selected' : ''); ?> value="NAM">Namibia</option>
		<option <?php echo ($row['Country'] == 'NRU' ? 'selected' : ''); ?> value="NRU">Nauru</option>
		<option <?php echo ($row['Country'] == 'NPL' ? 'selected' : ''); ?> value="NPL">Nepal</option>
		<option <?php echo ($row['Country'] == 'NLD' ? 'selected' : ''); ?> value="NLD">Netherlands</option>
		<option <?php echo ($row['Country'] == 'NCL' ? 'selected' : ''); ?> value="NCL">New Caledonia</option>
		<option <?php echo ($row['Country'] == 'NZL' ? 'selected' : ''); ?> value="NZL">New Zealand</option>
		<option <?php echo ($row['Country'] == 'NIC' ? 'selected' : ''); ?> value="NIC">Nicaragua</option>
		<option <?php echo ($row['Country'] == 'NER' ? 'selected' : ''); ?> value="NER">Niger</option>
		<option <?php echo ($row['Country'] == 'NGA' ? 'selected' : ''); ?> value="NGA">Nigeria</option>
		<option <?php echo ($row['Country'] == 'NIU' ? 'selected' : ''); ?> value="NIU">Niue</option>
		<option <?php echo ($row['Country'] == 'NFK' ? 'selected' : ''); ?> value="NFK">Norfolk Island</option>
		<option <?php echo ($row['Country'] == 'MNP' ? 'selected' : ''); ?> value="MNP">Northern Mariana Islands</option>
		<option <?php echo ($row['Country'] == 'NOR' ? 'selected' : ''); ?> value="NOR">Norway</option>
		<option <?php echo ($row['Country'] == 'OMN' ? 'selected' : ''); ?> value="OMN">Oman</option>
		<option <?php echo ($row['Country'] == 'PAK' ? 'selected' : ''); ?> value="PAK">Pakistan</option>
		<option <?php echo ($row['Country'] == 'PLW' ? 'selected' : ''); ?> value="PLW">Palau</option>
		<option <?php echo ($row['Country'] == 'PSE' ? 'selected' : ''); ?> value="PSE">Palestinian Territory, Occupied</option>
		<option <?php echo ($row['Country'] == 'PAN' ? 'selected' : ''); ?> value="PAN">Panama</option>
		<option <?php echo ($row['Country'] == 'PNG' ? 'selected' : ''); ?> value="PNG">Papua New Guinea</option>
		<option <?php echo ($row['Country'] == 'PRY' ? 'selected' : ''); ?> value="PRY">Paraguay</option>
		<option <?php echo ($row['Country'] == 'PER' ? 'selected' : ''); ?> value="PER">Peru</option>
		<option <?php echo ($row['Country'] == 'PHL' ? 'selected' : ''); ?> value="PHL">Philippines</option>
		<option <?php echo ($row['Country'] == 'PCN' ? 'selected' : ''); ?> value="PCN">Pitcairn</option>
		<option <?php echo ($row['Country'] == 'POL' ? 'selected' : ''); ?> value="POL">Poland</option>
		<option <?php echo ($row['Country'] == 'PRT' ? 'selected' : ''); ?> value="PRT">Portugal</option>
		<option <?php echo ($row['Country'] == 'PRI' ? 'selected' : ''); ?> value="PRI">Puerto Rico</option>
		<option <?php echo ($row['Country'] == 'QAT' ? 'selected' : ''); ?> value="QAT">Qatar</option>
		<option <?php echo ($row['Country'] == 'REU' ? 'selected' : ''); ?> value="REU">Réunion</option>
		<option <?php echo ($row['Country'] == 'ROU' ? 'selected' : ''); ?> value="ROU">Romania</option>
		<option <?php echo ($row['Country'] == 'RUS' ? 'selected' : ''); ?> value="RUS">Russian Federation</option>
		<option <?php echo ($row['Country'] == 'RWA' ? 'selected' : ''); ?> value="RWA">Rwanda</option>
		<option <?php echo ($row['Country'] == 'BLM' ? 'selected' : ''); ?> value="BLM">Saint Barthélemy</option>
		<option <?php echo ($row['Country'] == 'SHN' ? 'selected' : ''); ?> value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
		<option <?php echo ($row['Country'] == 'KNA' ? 'selected' : ''); ?> value="KNA">Saint Kitts and Nevis</option>
		<option <?php echo ($row['Country'] == 'LCA' ? 'selected' : ''); ?> value="LCA">Saint Lucia</option>
		<option <?php echo ($row['Country'] == 'MAF' ? 'selected' : ''); ?> value="MAF">Saint Martin (French part)</option>
		<option <?php echo ($row['Country'] == 'SPM' ? 'selected' : ''); ?> value="SPM">Saint Pierre and Miquelon</option>
		<option <?php echo ($row['Country'] == 'VCT' ? 'selected' : ''); ?> value="VCT">Saint Vincent and the Grenadines</option>
		<option <?php echo ($row['Country'] == 'WSM' ? 'selected' : ''); ?> value="WSM">Samoa</option>
		<option <?php echo ($row['Country'] == 'SMR' ? 'selected' : ''); ?> value="SMR">San Marino</option>
		<option <?php echo ($row['Country'] == 'STP' ? 'selected' : ''); ?> value="STP">Sao Tome and Principe</option>
		<option <?php echo ($row['Country'] == 'SAU' ? 'selected' : ''); ?> value="SAU">Saudi Arabia</option>
		<option <?php echo ($row['Country'] == 'SEN' ? 'selected' : ''); ?> value="SEN">Senegal</option>
		<option <?php echo ($row['Country'] == 'SRB' ? 'selected' : ''); ?> value="SRB">Serbia</option>
		<option <?php echo ($row['Country'] == 'SYC' ? 'selected' : ''); ?> value="SYC">Seychelles</option>
		<option <?php echo ($row['Country'] == 'SLE' ? 'selected' : ''); ?> value="SLE">Sierra Leone</option>
		<option <?php echo ($row['Country'] == 'SGP' ? 'selected' : ''); ?> value="SGP">Singapore</option>
		<option <?php echo ($row['Country'] == 'SXM' ? 'selected' : ''); ?> value="SXM">Sint Maarten (Dutch part)</option>
		<option <?php echo ($row['Country'] == 'SVK' ? 'selected' : ''); ?> value="SVK">Slovakia</option>
		<option <?php echo ($row['Country'] == 'SVN' ? 'selected' : ''); ?> value="SVN">Slovenia</option>
		<option <?php echo ($row['Country'] == 'SLB' ? 'selected' : ''); ?> value="SLB">Solomon Islands</option>
		<option <?php echo ($row['Country'] == 'SOM' ? 'selected' : ''); ?> value="SOM">Somalia</option>
		<option <?php echo ($row['Country'] == 'ZAF' ? 'selected' : ''); ?> value="ZAF">South Africa</option>
		<option <?php echo ($row['Country'] == 'SGS' ? 'selected' : ''); ?> value="SGS">South Georgia and the South Sandwich Islands</option>
		<option <?php echo ($row['Country'] == 'SSD' ? 'selected' : ''); ?> value="SSD">South Sudan</option>
		<option <?php echo ($row['Country'] == 'ESP' ? 'selected' : ''); ?> value="ESP">Spain</option>
		<option <?php echo ($row['Country'] == 'LKA' ? 'selected' : ''); ?> value="LKA">Sri Lanka</option>
		<option <?php echo ($row['Country'] == 'SDN' ? 'selected' : ''); ?> value="SDN">Sudan</option>
		<option <?php echo ($row['Country'] == 'SUR' ? 'selected' : ''); ?> value="SUR">Suriname</option>
		<option <?php echo ($row['Country'] == 'SJM' ? 'selected' : ''); ?> value="SJM">Svalbard and Jan Mayen</option>
		<option <?php echo ($row['Country'] == 'SWZ' ? 'selected' : ''); ?> value="SWZ">Swaziland</option>
		<option <?php echo ($row['Country'] == 'SWE' ? 'selected' : ''); ?> value="SWE">Sweden</option>
		<option <?php echo ($row['Country'] == 'CHE' ? 'selected' : ''); ?> value="CHE">Switzerland</option>
		<option <?php echo ($row['Country'] == 'SYR' ? 'selected' : ''); ?> value="SYR">Syrian Arab Republic</option>
		<option <?php echo ($row['Country'] == 'TWN' ? 'selected' : ''); ?> value="TWN">Taiwan, Province of China</option>
		<option <?php echo ($row['Country'] == 'TJK' ? 'selected' : ''); ?> value="TJK">Tajikistan</option>
		<option <?php echo ($row['Country'] == 'TZA' ? 'selected' : ''); ?> value="TZA">Tanzania, United Republic of</option>
		<option <?php echo ($row['Country'] == 'THA' ? 'selected' : ''); ?> value="THA">Thailand</option>
		<option <?php echo ($row['Country'] == 'TLS' ? 'selected' : ''); ?> value="TLS">Timor-Leste</option>
		<option <?php echo ($row['Country'] == 'TGO' ? 'selected' : ''); ?> value="TGO">Togo</option>
		<option <?php echo ($row['Country'] == 'TKL' ? 'selected' : ''); ?> value="TKL">Tokelau</option>
		<option <?php echo ($row['Country'] == 'TON' ? 'selected' : ''); ?> value="TON">Tonga</option>
		<option <?php echo ($row['Country'] == 'TTO' ? 'selected' : ''); ?> value="TTO">Trinidad and Tobago</option>
		<option <?php echo ($row['Country'] == 'TUN' ? 'selected' : ''); ?> value="TUN">Tunisia</option>
		<option <?php echo ($row['Country'] == 'TUR' ? 'selected' : ''); ?> value="TUR">Turkey</option>
		<option <?php echo ($row['Country'] == 'TKM' ? 'selected' : ''); ?> value="TKM">Turkmenistan</option>
		<option <?php echo ($row['Country'] == 'TCA' ? 'selected' : ''); ?> value="TCA">Turks and Caicos Islands</option>
		<option <?php echo ($row['Country'] == 'TUV' ? 'selected' : ''); ?> value="TUV">Tuvalu</option>
		<option <?php echo ($row['Country'] == 'UGA' ? 'selected' : ''); ?> value="UGA">Uganda</option>
		<option <?php echo ($row['Country'] == 'UKR' ? 'selected' : ''); ?> value="UKR">Ukraine</option>
		<option <?php echo ($row['Country'] == 'ARE' ? 'selected' : ''); ?> value="ARE">United Arab Emirates</option>
		<option <?php echo ($row['Country'] == 'GBR' ? 'selected' : ''); ?> value="GBR">United Kingdom</option>
		<option <?php echo ($row['Country'] == 'USA' ? 'selected' : ''); ?> value="USA">United States</option>
		<option <?php echo ($row['Country'] == 'UMI' ? 'selected' : ''); ?> value="UMI">United States Minor Outlying Islands</option>
		<option <?php echo ($row['Country'] == 'URY' ? 'selected' : ''); ?> value="URY">Uruguay</option>
		<option <?php echo ($row['Country'] == 'UZB' ? 'selected' : ''); ?> value="UZB">Uzbekistan</option>
		<option <?php echo ($row['Country'] == 'VUT' ? 'selected' : ''); ?> value="VUT">Vanuatu</option>
		<option <?php echo ($row['Country'] == 'VEN' ? 'selected' : ''); ?> value="VEN">Venezuela, Bolivarian Republic of</option>
		<option <?php echo ($row['Country'] == 'VNM' ? 'selected' : ''); ?> value="VNM">Viet Nam</option>
		<option <?php echo ($row['Country'] == 'VGB' ? 'selected' : ''); ?> value="VGB">Virgin Islands, British</option>
		<option <?php echo ($row['Country'] == 'VIR' ? 'selected' : ''); ?> value="VIR">Virgin Islands, U.S.</option>
		<option <?php echo ($row['Country'] == 'WLF' ? 'selected' : ''); ?> value="WLF">Wallis and Futuna</option>
		<option <?php echo ($row['Country'] == 'ESH' ? 'selected' : ''); ?> value="ESH">Western Sahara</option>
		<option <?php echo ($row['Country'] == 'YEM' ? 'selected' : ''); ?> value="YEM">Yemen</option>
		<option <?php echo ($row['Country'] == 'ZMB' ? 'selected' : ''); ?> value="ZMB">Zambia</option>
		<option <?php echo ($row['Country'] == 'ZWE' ? 'selected' : ''); ?> value="ZWE">Zimbabwe</option>
      </select> </h4></p>
			</div>
			
		<?php 
		}
		?> 
			</div>
			</div>
        </div>
		<?php } ?>
        
        <a href="#billinginfo" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#MainMenu">
        <span class="number">3. </span> Billing Information <?php echo (isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true) ? '' : '(login first)'; ?></a>
        <?php if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true){ ?>
        <div class="collapse common" id="billinginfo">
			<div class="row">
			<div class="col-md-12">
        <?php 
		$query="SELECT FirstName, LastName, Phone,PostCode,Country,Region,City,Address
		FROM website_users WHERE ID <>0 AND Status = 1 AND ID=".$_SESSION['CustomerID'];
		$r = mysql_query($query) or die(mysql_error());
		$n = mysql_num_rows($r);
		if($n == 1)
		{
		$row =  mysql_fetch_array($r);
		?>
			 <a href="profile" class="pull-right btn btn-sm btn-info">Change Billing Information</a>
			<div class="col-md-6">
			 <p><br/><b>Name:</b> <h4 class="title"><?php echo $row['FirstName'].' '.$row['LastName']; ?></h4></p>
			 <p><b>Phone:</b> <h4 class="title"><?php echo $row['Phone']; ?></h4></p>
			</div>
			<div class="col-md-6">
			 <p><b>Address:</b> <h4 class="title"><?php echo $row['Address'].',<br/>'.$row['City'].', '.$row['Region'].',<br/>'; getCountryByCode($row['Country']); echo ', '.$row['PostCode'];?></h4></p>
			</div>
			
		<?php 
		}
		?> 
			</div>
			</div>
        </div>
		<?php } ?>
        
        <a href="#ordersummary" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#MainMenu"><span class="number">4. </span>Order Summary</a>
        <div class="collapse" id="ordersummary">
			<div class="">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-center">Image</td>
                <td class="text-left">Product Name</td>
                <td class="text-left">Options</td>
                <td class="text-left">Shipping</td> 
				<td class="text-left">Quantity</td>
				<td class="text-right">Option Charges</td>
                <td class="text-right">Unit Price</td>
                <td class="text-right">Total</td>
				<td class="text-center">Remove</td>
              </tr>
            </thead>
            <tbody>
					<?php
					if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
					{
						foreach($_SESSION['cart_items'] as $cart_items)
						{
						$items = explode('-',$cart_items);
						if($items[3] == 2)
						{
					  $query = "SELECT ID,ProductName,ProductNameArabic,Quantity,Image,Price,Discount,URL,Shipping FROM products WHERE Status = 1 AND ID=" . $items[0];
						$res = mysql_query($query) or die(mysql_error());
						$row=mysql_fetch_array($res);
						$Image=explode(',', $row["Image"]);
						$img1 = $Image[0];
					?>
						<tr>
							<td class="text-center">            
								<a href="<?php echo $row['URL']; ?>"> <img src="<?php echo 'admin/' . DIR_PRODUCTS_IMAGES . $img1 ?>" alt="<?php echo $row['ProductName']; ?>" title="<?php echo $row['ProductName']; ?>" class="img-responsive"/></a>
							</td>
							<td>
								<a href="<?php echo $row['URL']; ?>"><?php echo dboutput($row['ProductName']); ?></a>
							</td>
							<td>
								<?php
									$items = explode('-',$cart_items);
										if(!empty($items[4]) && $items[4] != 0)
										{
										$optionnamearray = explode(',',$items[4]);
											foreach($optionnamearray as $opt)
											{
											$query="SELECT v.ValueName,o.OptionName FROM product_options po LEFT JOIN p_options_values v ON po.ValueID = v.ID LEFT JOIN p_options o ON po.OptionID = o.ID WHERE po.ID=".$opt;
											$res = mysql_query($query) or die(mysql_error());
											$number = mysql_num_rows($res);
												if($number != 0)
												{
													while($rowoptnam=mysql_fetch_array($res))
													{
														echo $rowoptnam['OptionName'].' : ('.$rowoptnam['ValueName'].')<br>';
													}
												}
												
											}
										}
										else
										{
											echo 'Not Selected any Option';
										}
								?>
							</td>
							<td><?php echo ($row['Shipping'] == 1 ? 'Free Shipping' : ($items[2] * SHIPPING_RATE / 100 * ($Discount != 0 ? $Discount : $Price))); ?></td>
							<td class="text-left">
								<div class="input-group btn-block" style="max-width: 300px;">
								<?php echo $items[2]; ?>
								</div>
							</td>
							<td class="text-right">
							<?php
							$optiontotal=0;
								$items = explode('-',$cart_items);
									if(!empty($items[4]))
									{
									$optiontotalarray = explode(',',$items[4]);
										foreach($optiontotalarray as $opt)
										{
										$query="SELECT Increment FROM product_options WHERE ID=".$opt;
										$res = mysql_query($query) or die(mysql_error());
										$number = mysql_num_rows($res);
											if($number != 0)
											{
												$rowopt=mysql_fetch_array($res);
												$IncTotal = $rowopt["Increment"];
												$optiontotal = $optiontotal + ($IncTotal * $items[2]);
											}
										}
									}
								echo CURRENCY_SYMBOL.$optiontotal;
							?>
							</td>
							<td class="text-right">
							<?php
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							echo ($Discount != 0 ? CURRENCY_SYMBOL.$Discount : CURRENCY_SYMBOL.$Price);
							?>
							</td>
							<td class="text-right">
							<?php
							$productTotal = 0;
							if($Discount != 0)
							{
							$productTotal = $optiontotal + ($Discount * $items[2]);
							}
							else
							{
							$productTotal = $optiontotal + ($Price * $items[2]);
							}
							echo CURRENCY_SYMBOL.round($productTotal);
							?>
							</td>
							<td class="text-center"><button type="button" onclick="location.href='remove_from_cart.php?id=<?php echo $row['ID']; ?>&name=<?php echo $row['ProductName']; ?>&url=<?php echo $_SERVER['REQUEST_URI']; ?>'" title="Remove" class="btn btn-danger btn-sm">Remove</button></td>
						</tr>
					<?php
						}
						else
						{
						$query="SELECT p.ID,p.ProductName,p.ProductNameArabic,p.Image,p.Price,p.Discount,p.URL,p.Shipping,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND p.ID=".$items[0];
						$res = mysql_query($query) or die(mysql_error());
						$row=mysql_fetch_array($res);
						$Image=explode(',', $row["Image"]);
						$img1 = $Image[0];
						?>
						 <tr>
							<td class="text-center">            
								<a href="<?php echo $row['URL']; ?>"><img src="<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" alt="<?php echo $row['ProductName']; ?>" title="<?php echo $row['ProductName']; ?>" class="img-thumbnail" style="height:100px;"></a>
							</td>
							<td>
								<a href="<?php echo $row['URL']; ?>"><?php echo dboutput($row['ProductName']); ?></a>
							</td>
							<td>
							<?php
								$items = explode('-',$cart_items);
									if(!empty($items[4]))
									{
									$optionnamearray = explode(',',$items[4]);
										foreach($optionnamearray as $opt)
										{
										$query="SELECT v.ValueName,o.OptionName FROM product_options po LEFT JOIN p_options_values v ON po.ValueID = v.ID LEFT JOIN p_options o ON po.OptionID = o.ID WHERE po.ID=".$opt;
										$res = mysql_query($query) or die(mysql_error());
										$number = mysql_num_rows($res);
											if($number != 0)
											{
												while($rowoptnam=mysql_fetch_array($res))
												{
													echo $rowoptnam['OptionName'].' : ('.$rowoptnam['ValueName'].')<br>';
												}
											}
											
										}
									}
									else
									{
										echo 'Not Selected any Option';
									}
							?>
							</td>
							<td><?php echo ($row['Shipping'] == 1 ? 'Free Shipping' : 'Shipping Charges will apply according to your Country'); ?></td>
							<td class="text-left">
								<div class="input-group btn-block" style="max-width: 200px;">
								<?php echo $items[2]; ?>
								</div>
							</td>
							<td class="text-right">
							<?php
							$optiontotal=0;
								$items = explode('-',$cart_items);
									if(!empty($items[4]))
									{
									$optiontotalarray = explode(',',$items[4]);
										foreach($optiontotalarray as $opt)
										{
										$query="SELECT Increment FROM product_options WHERE ID=".$opt;
										$res = mysql_query($query) or die(mysql_error());
										$number = mysql_num_rows($res);
											if($number != 0)
											{
												$row=mysql_fetch_array($res);
													$IncTotal = $row["Increment"];
												$optiontotal = $optiontotal + ($IncTotal * $items[2]);
											}
										}
									}
									
								echo CURRENCY_SYMBOL.round($optiontotal);
							?>
							</td>
							<td class="text-right">
							<?php
								$Discount = $row["Discount"];
								$Price = $row["Price"];
								$OfferPrice = $row["OfferPrice"];
							if($OfferPrice == 0)
							{
							 echo ($Discount != 0 ? CURRENCY_SYMBOL.$Discount : CURRENCY_SYMBOL.$Price); 
							}
							else if($OfferPrice != 0)
							{
							 echo CURRENCY_SYMBOL.$OfferPrice; 
							}
							?>
							</td>
							<td class="text-right">
							<?php
							$productTotal = 0;
							if($OfferPrice != 0)
							{
							$productTotal = $optiontotal + ($OfferPrice * $items[2]);
							}
							else if($Discount != 0)
							{
							$productTotal = $optiontotal + ($Discount * $items[2]);
							}
							else
							{
							$productTotal = $optiontotal + ($Price * $items[2]);
							}
							
							echo CURRENCY_SYMBOL.$productTotal;
							?>
							</td>
							<td class="text-center"><button type="button" onclick="location.href='remove_from_cart.php?id=<?php echo $row['ID']; ?>&name=<?php echo $row['ProductName']; ?>&url=<?php echo $_SERVER['REQUEST_URI']; ?>'" title="Remove" class="btn btn-danger btn-sm">Remove</button></td>
						</tr>
						<?php
						}
						}
					}
					else
					{
					?>
						<tr>
							<td colspan="9" class="text-center">
								Your Cart is Empty!
							</td>
						</tr>
					<?php
					}
					?>
			  
            </tbody>
          </table>
	  <?php
		if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
		{
		?>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td class="text-right"><strong>Sub-Total</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><?php echo round($subtotal); ?></td>
				</tr>
				<tr>
					<td class="text-right"><strong>Option-Increment</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><?php echo round($total); ?></td>
				</tr>
				<tr>
					<td class="text-right"><strong>Shipping-Charges</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><?php echo round($shippingAmount); ?></td>
				</tr>
				<tr>
					<td class="text-right"><strong>Total</strong></td>
					<td class="text-left"><?php echo CURRENCY_SYMBOL; ?><?php echo round($grandtotal); ?></td>
				</tr>
			</tbody>
		</table>
	  <?php
	  }
	  ?>
			</div>
		</div>

        <a href="#paymentinfo" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#MainMenu"><span class="number">5. </span>Payment</a>
         <?php if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true){ ?>
        <div class="collapse" id="paymentinfo">
			<div class="col-md-12">
				<br/>
				<h3><label for="PaymentNow"><input checked type="radio" id="PaymentNow" name="PaymentNow" value="COD"> Cash on delivery</label></h3>
				<h3><label for="PaymentNow2"><input type="radio" id="PaymentNow2" name="PaymentNow" value="Paypal"> Online Transaction</label></h3>
			</div>
			<input type="submit" name="Proceed" class="btn btn-success pull-right" value="Proceed" />
		 
		</div>
        <?php } ?>
        
     
        
      </div>
    </div>
         </form>

    
   </div>
    
		</div>	
	</div>
	<!--//contact-->	
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