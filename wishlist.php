<?php include("admin/Common.php"); ?>
<?php $CatID=99999; ?>
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
<title>Wishlist - <?php echo SiteTitle; ?></title>
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
.icon-size{
	font-size:2em;
	color:#000;
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
	<!--contact-->
	<div class="checkout">
    <div class="container">
        <h3>Your Wishlist</span></h3>

        <div class="checkout-right">
            <table class="timetable_sub">
                <thead>
                <tr>

                    <th>S No.</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>View Product</th>
                    <th>Add To Cart</th>
                    <th>Remove</th>
                </tr>
                </thead>
								<tbody>
<?php
    $resource = mysql_query("SELECT p.ID, p.ProductName, p.Discount, p.Quantity, p.Price, p.URL, p.Overview, p.Image, p.Description, w.DateAdded FROM wishlist w JOIN products p ON p.ID=w.ProductID WHERE w.UserID=".$_SESSION["CustomerID"]) or die(mysql_error());
	if(mysql_num_rows($resource) > 0)
	{
		while($row = mysql_fetch_array($resource))
		{
?>
								 <tr class="rem1">
										 <td class="invert"><?php echo $row['ID']; ?> </td>
                                         
                                         <td class="invert-image">
											<a href="<?php echo $row["URL"]; ?>" class="tb-img"><?php $i=0; foreach(explode(',',$row["Image"]) as $Img)
														{ 
														?>
														<?php echo ($i==0 ? '<img class="img-responsive" style="height: 200px; max-width: 200px; " src="admin/'.DIR_PRODUCTS_IMAGES.$Img.'" alt="">' : ''); $i++; ?>
														<?php
														}
														?></a>
										</td>
										 <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <?php echo $row['Quantity']; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert"><?php echo dboutput($row['ProductName']); ?></td>

										 <td class="invert">
                                    <?php
                                    $Discount = $row["Discount"];
                                    $Price = $row["Price"];
                                    //var_dump($row);die;
                                    echo ($Discount != 0 ? CURRENCY_SYMBOL . ($Discount ): CURRENCY_SYMBOL . $Discount);
                                    ?></td>
                                    
                              
                                <td class="invert">
								<a href="<?php echo $row["URL"]; ?>"><span class="glyphicon glyphicon-zoom-in icon-size" aria-hidden="true"></span></a>
									</td>
                                    <td class="invert">
                                      <<a class="item_add"  href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon-ok icon-size" aria-hidden="true"></span></a>

                                     </td>
										 <td class="invert">
                                    <div class="rem">
                                  
                                        <div onClick="location.href='update_wishlist.php?Delete=true&id=<?php echo $row["ID"]; ?>&url=<?php echo $_SERVER["REQUEST_URI"]; ?>'" class="close1"></div>
                                    </div>

                                </td>
                                
									</tr>
<?php
		}
	}
	else
	{
?>
									<tr>
										<td colspan="10"><center><h3>No product in your wishlist</h3></center></td>
									</tr>
<?php
	}
?>
								</tbody>
							</table>
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