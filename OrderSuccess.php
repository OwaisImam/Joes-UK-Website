<?php
 include("admin/Common.php");
 $CatID=99999;
 $ID=0;
 $items = array();
 $OptionNames = array();
 $OptionNamesString = "";
 $CurrentPrice = 0;
 $CustomerName = "";
 $Country = (isset($_SESSION["Country"]) ? $_SESSION["Country"] : '');
 $CustomerAddress = "";
 $CustomerPhone = "";

	foreach($_POST as $key=> $val)
		$$key = $val;
 // $_SESSION['PaymentNow']=true;
 // $_SESSION['paymentByThrough']='Paypal';
if(isset($_POST['PaymentNow']) && $_POST['PaymentNow']=="COD")
{
	// if(isset($_SESSION['orderdetail']))
	// {
		// $OrderDetails=trim($_SESSION['orderdetail']);
		 ////// $OrderString = gzuncompress( $OrderDetails );
		 ////// $Order = unserialize( base64_decode( $OrderDetails ) );
		 ////// print_r($Order);
		 // $query="INSERT INTO orders SET CustomerID='".(int)$_SESSION['CustomerID'] . "', DateAdded=NOW(),
				// OrderDetails = '" . $OrderDetails . "',PaymentMethod = '" . $_SESSION['paymentByThrough'] . "'";
		// mysql_query($query) or die (mysql_error());
	// }
	
	if(isset($_SESSION['cart_items']) || !empty($_SESSION['cart_items']))
	{
		$query="INSERT INTO orders SET CustomerID='".(int)$_SESSION['CustomerID'] . "', DateAdded=NOW(),
				Name = '" . dbinput($CustomerName) . "',
				Address = '" . dbinput($CustomerAddress).", <br/>Country: ".dbinput($Country)."',
				PostCode = '',
				Shippings = '".getShipping($Country)."',
				Phone = '" . dbinput($CustomerPhone) . "',
				Email = '" . dbinput($CustomerEmail) . "',
				PaymentMethod = 'COD'";
		mysql_query($query) or die (mysql_error());
		$ID = mysql_insert_id();
		$_SESSION["OrderID"] = $ID;
		
		foreach($_SESSION['cart_items'] as $cart_items)
		{
		$items = explode('-',$cart_items);
			if($items[3] == 2)
			{
				$query="SELECT Price,Discount,Shipping FROM products WHERE ID=".$items[0];
				$res = mysql_query($query) or die(mysql_error());
				$row=mysql_fetch_array($res);
				$shippingAmount = $row["Shipping"];
			
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
								$OptionNames[] = $rowoptnam['OptionName'].' : ('.$rowoptnam['ValueName'].')';
							}
						}
						
					}
				}
				else
				{
					$OptionNames[] = 'Not Selected any Option';
				}
			
				$optiontotal=0;
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
			
				
				$Discount = $row["Discount"];
				$Price = $row["Price"];

				$CurrentPrice = ($Discount != 0 ? $Discount : $Price);
			}
			else
			{
			$query="SELECT p.Price,p.Discount,p.Shipping,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND p.ID=".$items[0];
			$res = mysql_query($query) or die(mysql_error());
			$row=mysql_fetch_array($res);
			
			
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
								$OptionNames[] = $rowoptnam['OptionName'].' : ('.$rowoptnam['ValueName'].')';
							}
						}
						
					}
				}
				else
				{
					$OptionNames[] = 'Not Selected any Option';
				}
				
				$optiontotal=0;
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
				
				
					$Discount = $row["Discount"];
					$Price = $row["Price"];
					$OfferPrice = $row["OfferPrice"];
				
				
				if($OfferPrice == 0)
				{
				 $CurrentPrice = ($Discount != 0 ? $Discount : $Price); 
				}
				else if($OfferPrice != 0)
				{
				 $CurrentPrice = $OfferPrice; 
				}
				
				
			}
			
			$OptionNamesString = implode(',',$OptionNames);
			
			$query="INSERT INTO orders_details SET OrderID='".(int)$ID . "', DateAdded=NOW(),
				ProductID='".(int)$items[0] . "',Product='".dbinput($items[1]). "', Shipping = '" . $shippingAmount . "',Options = '" . dbinput($OptionNamesString) . "',OptionsCharges = '" .$optiontotal. "',Quantity = '" .(int)$items[2]. "',Price = '" .$CurrentPrice. "'";
			mysql_query($query) or die (mysql_error());
			
			unset($OptionNames);
			$OptionNames = array();
			
		}
		$subject = SiteTitle." - Order placed successfully";			
		$to = $_SESSION["Email"];
		$from = SiteTitle." <donot-reply@".Domain.">";
		$message = "Dear ".$_SESSION["Name"]."! \nYour order has been placed successfully. Your order ID is ".$ID."<br/><br/>Regards,<br/><b>Team ".SiteTitle."</b>";
		$headers = "From: ".$from."\r\n";
		$headers .= "Return-Path: <".$from."\r\n";
		$headers .= "X-Mailer: PHP5\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
		$mail = @mail($to,$subject,$message,$headers);
		$subject = SiteTitle." - New order received";
		$to = SiteTitle." <info@".Domain.">";
		$from = SiteTitle." <donot-reply@".Domain.">";
		$message = "Dear admin! \nAn order has been received on ".Domain.". Order ID is ".$ID.".<a href='http://".Domain."/admin/Login.php'><b>Click here </a> to login into admin panel to view details.<br/><br/>Regards,<br/><b>Support Team ".SiteTitle."</b>";
		$headers = "From: ".$from."\r\n";
		$headers .= "Return-Path: <".$from."\r\n";
		$headers .= "X-Mailer: PHP5\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
		$mail = @mail($to,$subject,$message,$headers);
	} 
	// $_SESSION['orderdetail']=="";
	// unset($_SESSION['orderdetail']);
	if(isset($_SESSION['cart_items']))
	{
		$_SESSION['cart_items']=="";
		unset($_SESSION['cart_items']);
	}
	else
	{
		redirect("404.php");
	}
}
else if(isset($_POST['PaymentNow']) && $_POST['PaymentNow']=="Paypal")
{
	$_SESSION["SessionData"] = $_POST;
	if(isset($_SESSION['cart_items']) || !empty($_SESSION['cart_items']))
	{
		$query="INSERT INTO orders SET CustomerID='".(int)$_SESSION['CustomerID'] . "', DateAdded=NOW(),
				Name = '" . dbinput($CustomerName) . "',
				Address = '" . dbinput($CustomerAddress).", <br/>Country: ".dbinput($Country)."',
				PostCode = '',
				Shippings = '".getShipping($Country)."',
				Phone = '" . dbinput($CustomerPhone) . "',
				Email = '" . dbinput($CustomerEmail) . "',
				PaymentMethod = 'Paypal - Unpaid'";
		mysql_query($query) or die (mysql_error());
		$ID = mysql_insert_id();
		$_SESSION["OrderID"] = $ID;
		
		foreach($_SESSION['cart_items'] as $cart_items)
		{
		$items = explode('-',$cart_items);
			if($items[3] == 2)
			{
				$query="SELECT Price,Discount,Shipping FROM products WHERE ID=".$items[0];
				$res = mysql_query($query) or die(mysql_error());
				$row=mysql_fetch_array($res);
				$shippingAmount = $row["Shipping"];
				
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
								$OptionNames[] = $rowoptnam['OptionName'].' : ('.$rowoptnam['ValueName'].')';
							}
						}
						
					}
				}
				else
				{
					$OptionNames[] = 'Not Selected any Option';
				}
			
				$optiontotal=0;
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
			
				
				$Discount = $row["Discount"];
				$Price = $row["Price"];

				$CurrentPrice = ($Discount != 0 ? $Discount : $Price);
			}
			else
			{
			$query="SELECT p.Price,p.Discount,p.Shipping,up.OfferPrice FROM upsaleproducts up LEFT JOIN products p ON up.ProductID = p.ID  WHERE p.Status = 1 AND p.ID=".$items[0];
			$res = mysql_query($query) or die(mysql_error());
			$row=mysql_fetch_array($res);
			
			
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
								$OptionNames[] = $rowoptnam['OptionName'].' : ('.$rowoptnam['ValueName'].')';
							}
						}
						
					}
				}
				else
				{
					$OptionNames[] = 'Not Selected any Option';
				}
				
				$optiontotal=0;
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
				
				
					$Discount = $row["Discount"];
					$Price = $row["Price"];
					$OfferPrice = $row["OfferPrice"];
				
				
				if($OfferPrice == 0)
				{
				 $CurrentPrice = ($Discount != 0 ? $Discount : $Price); 
				}
				else if($OfferPrice != 0)
				{
				 $CurrentPrice = $OfferPrice; 
				}
				
				
			}
			
			$OptionNamesString = implode(',',$OptionNames);
			
			$query="INSERT INTO orders_details SET OrderID='".(int)$ID . "', DateAdded=NOW(),
				ProductID='".(int)$items[0] . "',Product='".dbinput($items[1]). "', Shipping = '" . $shippingAmount . "',Options = '" . dbinput($OptionNamesString) . "',OptionsCharges = '" .$optiontotal. "',Quantity = '" .(int)$items[2]. "',Price = '" .$CurrentPrice. "'";
			mysql_query($query) or die (mysql_error());

			unset($OptionNames);
			$OptionNames = array();
		}
		$subject = SiteTitle." - Order placed successfully";			
		$to = $_SESSION["Email"];
		$from = SiteTitle." <donot-reply@".Domain.">";
		$message = "Dear ".$_SESSION["Name"]."! \nYour order has been placed successfully. Your order ID is ".$ID."<br/><br/>Regards,<br/><b>Team ".SiteTitle."</b>";
		$headers = "From: ".$from."\r\n";
		$headers .= "Return-Path: <".$from."\r\n";
		$headers .= "X-Mailer: PHP5\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
		$mail = @mail($to,$subject,$message,$headers);
		$subject = SiteTitle." - New order received";
		$to = SiteTitle." <info@".Domain.">";
		$from = SiteTitle." <donot-reply@".Domain.">";
		$message = "Dear admin! \nAn order has been received on ".Domain.". Order ID is ".$ID.".<a href='http://".Domain."/admin/Login.php'><b>Click here </a> to login into admin panel to view details.<br/><br/>Regards,<br/><b>Support Team ".SiteTitle."</b>";
		$headers = "From: ".$from."\r\n";
		$headers .= "Return-Path: <".$from."\r\n";
		$headers .= "X-Mailer: PHP5\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
		$mail = @mail($to,$subject,$message,$headers);
		redirect("expresscheckout.php");
	} 
	// $_SESSION['orderdetail']=="";
	// unset($_SESSION['orderdetail']);
	if(isset($_SESSION['cart_items']))
	{
		$_SESSION['cart_items']=="";
		unset($_SESSION['cart_items']);
	}
	else
	{
		redirect("404.php");
	}
}
else if(isset($_POST['QuickOrder']) && $_POST['QuickOrder']=="Order Now")
{
	$ProductID = 0;
	$ProductName = "";
	$Name = "";
	$Quantity = 0;
	$Phone = "";
	$Address = "";
	$City = "";
	$options = array();
	foreach($_POST as $row=>$val)
		$$row = $val;
	if($ProductID == 0)
	{
		$_SESSION['CartMessage'] = '<section id="" class="mainnavbar">
		<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			Please select a product.
			</div></div>
		</section>';
	}
	else if($Name == "")
	{
		$_SESSION['CartMessage'] = '<section id="" class="mainnavbar">
		<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			Please enter your name.
			</div></div>
		</section>';
	}
	else if($Quantity < 1 || !ctype_digit($Quantity))
	{
		$_SESSION['CartMessage'] = '<section id="" class="mainnavbar">
		<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			Please select quantity.
			</div></div>
		</section>';
	}
	else if($Phone == "")
	{
		$_SESSION['CartMessage'] = '<section id="" class="mainnavbar">
		<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			Please enter your mobile number.
			</div></div>
		</section>';
	}
	else if($Address == "")
	{
		$_SESSION['CartMessage'] = '<section id="" class="mainnavbar">
		<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			Please enter your address.
			</div></div>
		</section>';
	}
	else if($City == "")
	{
		$_SESSION['CartMessage'] = '<section id="" class="mainnavbar">
		<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			Please enter your city.
			</div></div>
		</section>';
	}
	else 
	{
		$query="INSERT INTO orders SET CustomerID='0', DateAdded=NOW(),
				Name = '".dbinput($Name)."',
				Address = '" . dbinput($Address).", ".dbinput($City)."',
				PostCode = '',
				Shippings = '".getShipping($Country)."'
				Phone = '" . dbinput($Phone) . "',
				Email = '',
				PaymentMethod = 'COD'";
		mysql_query($query) or die (mysql_error());
		$ID = mysql_insert_id();
		$_SESSION["OrderID"] = $ID;

		$query="SELECT Price,Discount,Shipping FROM products WHERE ID=".$ProductID;
		$res = mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_array($res);
		$Discount = $row["Discount"];
		$Price = $row["Price"];
		$shippingAmount = $row["Shipping"];
		$CurrentPrice = ($Discount != 0 ? $Discount : $Price); 

		if(!empty($options))
		{
		$optionnamearray = $options;
			foreach($optionnamearray as $opt)
			{
				$query="SELECT v.ValueName,o.OptionName FROM product_options po LEFT JOIN p_options_values v ON po.ValueID = v.ID LEFT JOIN p_options o ON po.OptionID = o.ID WHERE po.ID=".$opt;
				$res = mysql_query($query) or die(mysql_error());
				$number = mysql_num_rows($res);
				if($number != 0)
				{
					while($rowoptnam=mysql_fetch_array($res))
					{
						$OptionNames[] = $rowoptnam['OptionName'].' : ('.$rowoptnam['ValueName'].')';
					}
				}
				
			}
		}
		else
		{
			$OptionNames[] = 'Not Selected any Option';
		}
		
		$optiontotal=0;
		if(!empty($options))
		{
		$optiontotalarray = $options;
			foreach($optiontotalarray as $opt)
			{
			$query="SELECT Increment FROM product_options WHERE ID=".$opt;
			$res = mysql_query($query) or die(mysql_error());
			$number = mysql_num_rows($res);
				if($number != 0)
				{
					$row=mysql_fetch_array($res);
					
					$IncTotal = $row["Increment"];
						
					$optiontotal = $optiontotal + ($IncTotal * $Quantity);
				}
			}
		}
			
			

		$OptionNamesString = implode(',',$OptionNames);
		
		$query="INSERT INTO orders_details SET OrderID='".(int)$ID . "', DateAdded=NOW(),
			ProductID='".(int)$ProductID . "',Product='".dbinput($ProductName). "', Shipping = '" . $shippingAmount . "', Options = '" . dbinput($OptionNamesString) . "',OptionsCharges = '" .$optiontotal. "',Quantity = '" .(int)$Quantity. "',Price = '" .$CurrentPrice. "'";
		mysql_query($query) or die (mysql_error());
		
		unset($OptionNames);
		$OptionNames = array();

		$subject = SiteTitle." - Order placed successfully";			
		$to = $Email;
		$from = SiteTitle." <donot-reply@".Domain.">";
		$message = "Dear ".$Name."! \nYour order has been placed successfully. Your order ID is ".$ID."<br/><br/>Regards,<br/><b>Team ".SiteTitle."</b>";
		$headers = "From: ".$from."\r\n";
		$headers .= "Return-Path: <".$from."\r\n";
		$headers .= "X-Mailer: PHP5\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
		$mail = @mail($to,$subject,$message,$headers);
		$subject = SiteTitle." - New order received";
		$to = SiteTitle." <info@".Domain.">";
		$from = SiteTitle." <donot-reply@".Domain.">";
		$message = "Dear admin! \nAn order has been received on ".Domain.". Order ID is ".$ID.".<a href='http://".Domain."/admin/Login.php'><b>Click here </a> to login into admin panel to view details.<br/><br/>Regards,<br/><b>Support Team ".SiteTitle."</b>";
		$headers = "From: ".$from."\r\n";
		$headers .= "Return-Path: <".$from."\r\n";
		$headers .= "X-Mailer: PHP5\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
		$mail = @mail($to,$subject,$message,$headers);
	}
}
else
{
	redirect('404.php');
	exit();	
}
redirect("success");
?>