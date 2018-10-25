<?php
///**/
$subtotal = 0;
if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
{
    foreach($_SESSION['cart_items'] as $cart_items) {
        $items = explode('-', $cart_items);
        //if ($items[3] == 2) {
            $query = "SELECT Price,Discount FROM products WHERE Status = 1 AND ID=" . $items[0];
            $res = mysql_query($query) or die(mysql_error());
            $row=mysql_fetch_array($res);
            $subtotal += $row['Price'] - $row['Discount'];
            //echo "<p>".$query."</p>";
        //}
    }
}
//echo $subtotal;die;
///**/
//die;



if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true)
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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=117085584989568";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- header -->
<?php  if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true)
{
}
else {
	
	?>
	<div class="modal fade" id="myModal88" tabindex="-1" role="dialog" aria-labelledby="myModal88"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;</button>
					<h4 class="modal-title" id="myModalLabel">
						Don't Wait, Login now!</h4>
				</div>
				<div class="modal-body modal-body-sub">
					<div class="row">
						<div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
							<div class="sap_tabs">	
								<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
									<ul>
										<li class="resp-tab-item" aria-controls="tab_item-0"><span>Sign in</span></li>
										<li class="resp-tab-item" aria-controls="tab_item-1"><span>Sign up</span></li>
									</ul>		
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="facts">
											<div class="register">
                 <?php 
				if(isset($msg3))
				echo $msg3
				?>
			<form action="<?php echo $_SERVER["login.php"];?>" method="post" enctype="multipart/form-data">			
               <?php if(isset($msg1)){echo $msg1;}?>
			<input name="email" placeholder="Email Address" type="text" value="<?php echo $email; ?>" placeholder="E-Mail Address" id="input-email">	
            <?php if(isset($msg2)){echo $msg2;}?>					
	<input name="password" placeholder="Password" type="password" >										
								<div class="sign-up">
					<div class="forgot-grid">

						<label class="checkbox" style="font-weight:400"><input type="checkbox" name="checkbox"><i></i>Remember me</label>

						<div class="forgot">
                        <div class="cart box_1">
							<a href="recovery">Forgot your password?</a>
                            </div>
						</div>
						<div class="clearfix"> </div>
					</div>
                        		<input type="submit" value="Sign in" name="Sign In"/>
                                <input type="hidden" name="action" value="submit_form" />
													</div>
												</form>
											</div>
										</div> 
									</div>	

									<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="facts">
											<div class="register">
                                            <?php
							echo $msg;
							if(isset($_SESSION["msg"]))
							{
								echo $_SESSION["msg"];
								$_SESSION["msg"]="";
							}
						?>
												<form action="<?php echo $_SERVER["register.php"];?>" method="post">			
													
                                                    <fieldset id="account">
					  
					  <legend>Your Personal Details</legend>
					  
					  
						<div class="form-group required">
						<label class="col-sm-4 control-label" for="gender">Gender<span class="required"> *</span></label>

						<div class="col-sm-8">
							<select name="Gender" id="gender" class="form-control">
								<option <?php echo ($Gender == 0 ? 'selected' : ''); ?> value="0"> --- Please Select --- </option>
								<option <?php echo ($Gender == 1 ? 'selected' : ''); ?> value="1">Male</option>
								<option <?php echo ($Gender == 2 ? 'selected' : ''); ?> value="2">Female</option>
							  </select> 
							</div>
						</div>
                        
                          <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-firstname">First Name<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="text" name="FirstName" value="<?php echo $FirstName; ?>" placeholder="First Name" id="input-firstname" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-lastname">Last Name<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="text" name="LastName" value="<?php echo $LastName; ?>" placeholder="Last Name" id="input-lastname" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-email">E-Mail<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="text" name="Email" value="<?php echo $Email; ?>" placeholder="E-Mail" id="input-email" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-telephone">Contact Number<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="text" name="Phone" value="<?php echo $Phone; ?>" placeholder="Telephone" id="input-telephone" class="form-control">
						</div>
					  </div>
	
					</fieldset>
					
					<fieldset id="address">
					  <legend>Your Address</legend>

					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-address-1">Address<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="text" name="Address1" value="<?php echo $Address1; ?>" placeholder="Address Line 1" id="input-address-1" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-city">City<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="text" name="City" value="<?php echo $City; ?>" placeholder="City" id="input-city" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-postcode">Post Code</label>
						<div class="col-sm-8">
						  <input type="text" name="PostCode" value="<?php echo $PostCode; ?>" placeholder="Post Code" id="input-postcode" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group required">
			<label class="col-sm-4 control-label" for="input-country">Country<span class="required"> *</span></label>

			<div class="col-sm-8">
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
                    <option <?php echo ($Country == 'EUR' ? 'selected' : ''); ?> value="EUR">Europe</option>
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
						<label class="col-sm-4 control-label" for="input-region">Region / State<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="text" name="Region" value="<?php echo $Region; ?>" placeholder="Region / State" id="input-region" class="form-control">
						</div>
					  </div>
					  
					  
					  
				   </fieldset>
				   
					<fieldset>
					  <legend>Your Password</legend>
					  
					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-password">Password<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="password" name="Password" value="<?php echo $Password; ?>" placeholder="Password" id="input-password" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group required">
						<label class="col-sm-4 control-label" for="input-confirm">Password Confirm<span class="required"> *</span></label>
						<div class="col-sm-8">
						  <input type="password" name="Password2" value="<?php echo $Password2; ?>" placeholder="Password Confirm" id="input-confirm" class="form-control">
						</div>
					  </div>
					
					</fieldset>
					
					<fieldset>
					  <legend>Newsletter</legend>
					  <div class="form-group">
						<label class="col-sm-4 control-label">Subscribe</label>
						<div class="col-sm-8">
						  <label class="radio-inline"><input type="radio" <?php echo ($Subscribe == 1 ? 'checked' : ''); ?> name="Subscribe" value="1">Yes</label>
						  <label class="radio-inline"><input type="radio" name="Subscribe" value="0" <?php echo ($Subscribe == 0 ? 'checked' : ''); ?>>No</label>
						</div>
					  </div>
					</fieldset>
													<div class="sign-up">
														<input type="submit" value="Create Account"/>
                                                        <input type="hidden" name="action" value="submit_form2" />
													</div>
												</form>
											</div>
										</div>
									</div> 			        					            	      
								</div>	
							</div>
							<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function () {
									$('#horizontalTab').easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any width like 600px
										fit: true   // 100% fit in a container
									});
								});
							</script>
							<div id="OR" class="hidden-xs">
								OR</div>
						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<div class="row text-center sign-with">
								<div class="col-md-12">
									<h3 class="other-nw">
										Sign in with</h3>
								</div>
								<div class="col-md-12">
									<ul class="social">
										<li class="social_facebook"><a href="#" class="entypo-facebook"></a></li>
										<li class="social_dribbble"><a href="#" class="entypo-dribbble"></a></li>
										<li class="social_twitter"><a href="#" class="entypo-twitter"></a></li>
										<li class="social_behance"><a href="#" class="entypo-behance"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$('#myModal88').modal('show');
	</script>
    
    <?php }?>
	<div class="header">
		<div class="container">
       				<?php echo ((isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true) ?
					 ' <div class="cart box_1">
					 <div class="total2">
Welcome <a href="profile" >'.$_SESSION["CustomerFullName"].' <a href="wishlist">| Wishlist |</a> </a><a href="logout.php"> Log Out</a>
</div></div>' : 
			'<div class="w3l_login"><a href="#" data-toggle="modal" data-target="#myModal88"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></div>'); ?>                
						<div class="w3l_logo">
				<h1><a href="home"><img src="images/Logo (2).png" class="img-responsive"/></a></h1>
			</div>
			<div class="search">
				<input class="search_box" type="checkbox" id="search_box">
				<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
				<div class="search_form">
					<form action="search.php" method="post">
						<input type="text" name="keyword" placeholder="Search...">
						<input type="submit" value="Send">
					</form>
				</div>
			</div>
            <?php
						$cart_count=0;
						if(isset($_SESSION['cart_items']))
						{
						$cart_count=count($_SESSION['cart_items']);
						}
					?>
					<?php
				$shippingProducts = 0;
				$shippingAmount = 0;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					foreach($_SESSION['cart_items'] as $cart_items)
					{
						$items = explode('-',$cart_items);
						if($items[3] == 2)
						{
							$query="SELECT Price,Discount FROM products WHERE Status = 1 AND Shipping <> 1 AND ID=".$items[0];
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							($Discount != 0 ? $shippingProducts = $shippingProducts + ($Discount * $items[2]) : $shippingProducts = $shippingProducts + ($Price * $items[2]));

						}
						else
						{
							$query="SELECT p.Price,p.Discount,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND Shipping <> 1 AND p.ID=".$items[0];
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							$OfferPrice = $row["OfferPrice"];
							if($OfferPrice < 1)
							{
							 ($Discount != 0 ? $shippingProducts = $shippingProducts + ($Discount * $items[2]) : $shippingProducts = $shippingProducts + ($Price * $items[2]));
							}
							else if($OfferPrice > 0)
							{
							 $shippingProducts = $shippingProducts + ($OfferPrice * $items[2]);
							}
						}
					}
				}
				if($shippingProducts != 0)
				{
					if(!isset($_SESSION['Country']) || $_SESSION['Country'] == '')
					{
						$query="SELECT Percentage FROM other_countries_shipping WHERE ID=1";
						$res = mysql_query($query) or die(mysql_error());
						$row=mysql_fetch_array($res);
						$shippingAmount = ($row["Percentage"] / 100) * $shippingProducts;
						$shippingAmount = number_format((float)$shippingAmount, 2, '.', '');
					}
					else
					{
						$query="SELECT Percentage FROM shipping_rates WHERE ID<>0 AND CountryCode = '".$_SESSION['Country']."' ORDER BY ID DESC Limit 1";
						$res = mysql_query($query) or die(mysql_error());
						$numperc = mysql_num_rows($res);
						if($numperc == 1)
						{
							$row=mysql_fetch_array($res);
							$shippingAmount = ($row["Percentage"] / 100) * $shippingProducts;
							$shippingAmount = number_format((float)$shippingAmount, 2, '.', '');
						}
						else
						{
							$query="SELECT Percentage FROM other_countries_shipping WHERE ID=1";
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);
							$shippingAmount = ($row["Percentage"] / 100) * $shippingProducts;
							$shippingAmount = number_format((float)$shippingAmount, 2, '.', '');
						}
					}
				}
				?>				
				<?php
				//$subtotal=0;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					foreach($_SESSION['cart_items'] as $cart_items)
					{
						$items = explode('-',$cart_items);
						if($items[3] == 2)
						{
							$query="SELECT Price,Discount FROM products WHERE Status = 1 AND ID=".$items[0];
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);					
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							//($Discount != 0 ? $subtotal = $subtotal + ($Discount * $items[2]) : $subtotal = $subtotal + ($Price * $items[2]));

						}
						else
						{
							$query="SELECT p.Price,p.Discount,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND p.ID=".$items[0];
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							$OfferPrice = $row["OfferPrice"];
							if($OfferPrice == 0)
							{
                                if($Discount != 0){
                               //     $subtotal += $Discount * $items[2];
                                }else{
                                 //   $subtotal += $Price * $items[2];
                                }
							}
							else if($OfferPrice != 0)
							{
							// $subtotal += ($OfferPrice * $items[2]);
							}
						}
					}
				}
				?>
				<?php
				$total=0;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					foreach($_SESSION['cart_items'] as $cart_items)
					{
					$items = explode('-',$cart_items);
						if(!empty($items[4]))
						{
						$optionarray = explode(',',$items[4]);
							foreach($optionarray as $op)
							{
							$query="SELECT Increment FROM product_options WHERE ID=".$op;
							$res = mysql_query($query) or die(mysql_error());
							$number = mysql_num_rows($res);
								if($number != 0)
								{
									$row=mysql_fetch_array($res);
									$IncTotal = $row["Increment"];
									$total = $total + ($IncTotal * $items[2]);
								}
							}
						}
					}
				}
				?>
				<?php
                if(($total + $subtotal + $shippingAmount > 0) AND $total + $subtotal + $shippingAmount <= 1500){
                    $owaisCharges = 200;
                }else{
                    $owaisCharges = 0;
                }
				$grandtotal = $total + $subtotal + $shippingAmount + $owaisCharges;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					$_SESSION['Payment_Amount'] = round($grandtotal);
				}
				else
				{
					$_SESSION['Payment_Amount'] = 0;
				}					
				?>
				<?php
					$cart_count=0;
					if(isset($_SESSION['cart_items']))
					{
					$cart_count=count($_SESSION['cart_items']);
					}
				?>
				<?php
				$shippingProducts = 0;
				$shippingAmount = 0;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					foreach($_SESSION['cart_items'] as $cart_items)
					{
						$items = explode('-',$cart_items);
						if($items[3] == 2)
						{
							$query="SELECT Price,Discount FROM products WHERE Status = 1 AND Shipping <> 1 AND ID=".$items[0];
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);
							
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							($Discount != 0 ? $shippingProducts = $shippingProducts + ($Discount * $items[2]) : $shippingProducts = $shippingProducts + ($Price * $items[2]));

						}
						else
						{
						$query="SELECT p.Price,p.Discount,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND Shipping <> 1 AND p.ID=".$items[0];
						$res = mysql_query($query) or die(mysql_error());
						$row=mysql_fetch_array($res);
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							$OfferPrice = $row["OfferPrice"];
						}
					}
				}
				if($shippingProducts != 0)
				{
					if(!isset($_SESSION['Country']) || $_SESSION['Country'] == '')
					{
						$query="SELECT Percentage FROM other_countries_shipping WHERE ID=1";
						$res = mysql_query($query) or die(mysql_error());
						$row=mysql_fetch_array($res);
						$shippingAmount = ($row["Percentage"] / 100) * $shippingProducts;
						$shippingAmount = number_format((float)$shippingAmount, 2, '.', '');
					}
					else
					{
						$query="SELECT Percentage FROM shipping_rates WHERE ID<>0 AND CountryCode = '".$_SESSION['Country']."' ORDER BY ID DESC Limit 1";
						$res = mysql_query($query) or die(mysql_error());
						$numperc = mysql_num_rows($res);
						if($numperc == 1)
						{
							$row=mysql_fetch_array($res);
							$shippingAmount = ($row["Percentage"] / 100) * $shippingProducts;
							$shippingAmount = number_format((float)$shippingAmount, 2, '.', '');
						}
						else
						{
							$query="SELECT Percentage FROM other_countries_shipping WHERE ID=1";
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);
							$shippingAmount = ($row["Percentage"] / 100) * $shippingProducts;
							$shippingAmount = number_format((float)$shippingAmount, 2, '.', '');
						}
					}
				}
				?>				
				<?php
				//$subtotal=0;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					foreach($_SESSION['cart_items'] as $cart_items)
					{
						$items = explode('-',$cart_items);
						if($items[3] == 2)
						{
							$query="SELECT Price,Discount FROM products WHERE Status = 1 AND ID=".$items[0];
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);					
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							//($Discount != 0 ? $subtotal = $subtotal + ($Discount * $items[2]) : $subtotal = $subtotal + ($Price * $items[2]));
						}
						else
						{
							$query="SELECT p.Price,p.Discount,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND p.ID=".$items[0];
							$res = mysql_query($query) or die(mysql_error());
							$row=mysql_fetch_array($res);
							$Discount = $row["Discount"];
							$Price = $row["Price"];
							$OfferPrice = $row["OfferPrice"];
                            if($OfferPrice == 0)
                            {
                                if($Discount != 0){
                              //      $subtotal += $Discount * $items[2];
                                }else{
                                //    $subtotal += $Price * $items[2];
                                }
                            }
                            else if($OfferPrice != 0)
                            {
                                //$subtotal += ($OfferPrice * $items[2]);
                            }
						}
					}
				}
				?>
				<?php
				$total=0;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					foreach($_SESSION['cart_items'] as $cart_items)
					{
					$items = explode('-',$cart_items);
						if(!empty($items[4]))
						{
						$optionarray = explode(',',$items[4]);
							foreach($optionarray as $op)
							{
							$query="SELECT Increment FROM product_options WHERE ID=".$op;
							$res = mysql_query($query) or die(mysql_error());
							$number = mysql_num_rows($res);
								if($number != 0)
								{
									$row=mysql_fetch_array($res);
									$IncTotal = $row["Increment"];
									$total = $total + ($IncTotal * $items[2]);
								}
							}
						}
					}
				}
				?>
				<?php
                if(($total + $subtotal + $shippingAmount > 0) AND $total + $subtotal + $shippingAmount <= 1500){
                    $owaisCharges = 200;
                }else{
                    $owaisCharges = 0;
                }
				$grandtotal = $total + $subtotal + $shippingAmount + $owaisCharges;
				if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
				{
					$_SESSION['Payment_Amount'] = round($grandtotal);
				}
				else
				{
					$_SESSION['Payment_Amount'] = 0;
				}					
				?>
                
		<div class="cart box_1">
      
				<a href="cart">
					<div class="total">
                   
			<span ><?php echo CURRENCY_SYMBOL; ?><?php echo round($grandtotal); ?> </span>(<span id="simpleCart_quantity"> <?php echo $cart_count; ?> </span>items)
            
            </div>
					<img src="images/bag.png" alt="" />
				</a>
                <ul class="dropdown-menu">
									<li>
									  <table class="table table-striped">
										<tbody>
										<?php
										if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
										{
											foreach($_SESSION['cart_items'] as $cart_items)
											{
											$items = explode('-',$cart_items);
											if($items[3] == 2)
											{
											$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND ID=".$items[0];
											$res = mysql_query($query) or die(mysql_error());
											$row=mysql_fetch_array($res);
											$Image=explode(',', $row["Image"]);
											$img1 = $Image[0];
										?>
											<tr>
												<td class="text-center">            
													<a href="<?php echo $row['URL']; ?>">
														<img src="<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" alt="<?php echo $row['ProductName']; ?>" title="<?php echo $row['ProductName']; ?>" class="cart-img"></a>
												</td>
												<td class="text-left">
													<a href="<?php echo $row['URL']; ?>"><?php echo dboutput($row['ProductName']); ?></a>
												</td>
												<td class="text-right">x <?php echo $items[2]; ?></td>
												<td class="text-right">
												<?php
													$Discount = $row["Discount"];
													$Price = $row["Price"];
									echo ($Discount != 0 ? CURRENCY_SYMBOL.$Discount : CURRENCY_SYMBOL.$Discount);
												?>
												</td>
												<td class="text-center"><button type="button" onclick="location.href='remove_from_cart.php?id=<?php echo $row['ID']; ?>&name=<?php echo $row['ProductName']; ?>&url=<?php echo $_SERVER['REQUEST_URI']; ?>'" title="Remove" class="btn btn-danger btn-xs">x</button></td>
											</tr>
										<?php
											}
											else
											{
											$query="SELECT p.ID,p.ProductName,p.ProductNameArabic,p.Image,p.Price,p.Discount,p.URL,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND p.ID=".$items[0];
											$res = mysql_query($query) or die(mysql_error());
											$row=mysql_fetch_array($res);
											$Image=explode(',', $row["Image"]);
											$img1 = $Image[0];
											?>
											 <tr>
												<td class="text-center">            
													<a href="<?php echo $row['URL']; ?>"><img src="<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" alt="<?php echo $row['ProductName']; ?>" title="<?php echo $row['ProductName']; ?>" class="img-thumb"></a>
												</td>
												<td class="text-left">
													<a href="<?php echo $row['URL']; ?>"><?php echo dboutput($row['ProductName']); ?></a>
												</td>
												<td class="text-right">x <?php echo $items[2]; ?></td>
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
												<td class="text-center"><button type="button" onclick="location.href='remove_from_cart.php?id=<?php echo $row['ID']; ?>&name=<?php echo $row['ProductName']; ?>&url=<?php echo $_SERVER['REQUEST_URI']; ?>'" title="Remove" class="btn btn-danger btn-xs">x</button></td>
											</tr>
											<?php
											}
											}
										}
										else
										{
										?>
											<tr>
												<td class="text-center">
													Your Cart is Empty!
												</td>
											</tr>
										<?php
										}
										?>
										</tbody>
									  </table>
									</li>
								<?php
								if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
								{
								?>
								<div>
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
								<p class="text-right"><a class="btn btn-info" href="cart"><strong><i class="fa fa-shopping-cart"></i> View Cart</strong></a>&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="checkout"><strong><i class="fa fa-share"></i> Checkout</strong></a></p>
							  </div>
							  <?php
							  }
							  ?>
			
								</ul>
				
				<div class="clearfix"> </div>
			</div>	
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li class="active"><a href="home" class="act"  <?php echo ($CatID == 0 ? '' : ''); ?>>Home</a></li>	
						<!-- Mega Menu -->
                        
                        <?php
							$query="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = 0 ORDER BY Sort Limit 6";
							$result = mysql_query ($query) or die(mysql_error()); 
							$num = mysql_num_rows($result);
							if($num != 0)
							{
							$i=0;
							while($row = mysql_fetch_array($result,MYSQL_ASSOC))
							{
							$i++;
							?>
                             <?php
							$query2="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = ".$row['ID']." ORDER BY Sort ASC";
							$result2 = mysql_query ($query2) or die(mysql_error()); 
							$num2 = mysql_num_rows($result2);
							if($num2 != 0)
							{
							echo '<li class="dropdown">'; ?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $row['CategoryName']; ?><b class="caret"></b></a>
						
                                    
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
                                
                              <?php
							while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
							{
							?>
							<div class="col-sm-3">
							<ul class="multi-column-dropdown">
             <li> <a href="category.php?ID=<?php echo $row2['ID']; ?>"><?php echo $row2['CategoryName']; ?></a></li>
											
                                             <?php
							$query3="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = ".$row2['ID']." ORDER BY Sort ASC";
							$result3 = mysql_query ($query3) or die(mysql_error()); 
							$num3 = mysql_num_rows($result3);
							if($num3 != 0)
							{
							echo '';
							while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
							{
							?>
			<li><a href="category.php?ID=<?php echo $row3['ID']; ?>"><?php echo $row3['CategoryName']; ?></a></li>
							<?php
							}
							}
							?>
											
										</ul>
									</div>
                                    <?php
							}
							echo '
								</ul>
							</li>';
							}
							else
							{
							?>
							<li><a href="category.php?ID=<?php echo $row['ID']; ?>"><?php echo $row['CategoryName']; ?></a></li>
							<?php
							}
							}
							?>
						</ul> 
                        
                       
<?php
if($i%4 == 0)
{
?>
    </div>
	<div class="row">
									
<?php									
}
?>
							<?php
							}
							?>
						<div class="clearfix"></div>
								</div>
                                            	<?php 
	if(isset($_SESSION['CartMessage']))
	{
		echo $_SESSION['CartMessage'];
		unset($_SESSION['CartMessage']);
	}
	?>	
							
				</div>
			</nav>
		</div>
	</div>
<!-- //header -->