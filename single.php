<?php include("admin/Common.php"); ?>
<?php $CatID=99999; ?>
<?php
$ID=0;
if(isset($_REQUEST["ProductID"]))
$ID=trim($_REQUEST["ProductID"]);
?>
<?php
/*Review*/
$ReviewName="";
$ReviewReview="";
$ReviewRatings=0;
$msg1="";
/*Review*/



$Name="";
$NameArabic="";
$MetaDes="";
$MetaKey="";
$URL="";
$Pricee=0;
$Overview="";
$OverviewArabic="";
$Description="";
$DescriptionArabic="";
$Stock="";
$StockText="";
$Manufacture=0;
$BrandImage="";
$Category="";
$Cat=array();
$Discountt=0;
$Quantity=0;
$Ratings=60;
$Image="";
$Shipping = 0;
$RelatedProducts="";

	if(isset($_REQUEST["ProductID"]))
	{
			$ID=trim($_REQUEST["ProductID"]);
			$query="SELECT p.ID,p.ProductName,p.ProductNameArabic,p.Categories,p.RelatedProducts,p.MetaDescription,p.Quantity,p.Image,p.Shipping,p.Overview,p.OverviewArabic,s.StockName,s.Text,p.Discount,p.Manufacture,p.Ratings,b.Image as bimg,p.Price,p.MetaKeywords,p.Description,p.DescriptionArabic,p.URL FROM products p LEFT JOIN brands b ON p.Manufacture = b.ID LEFT JOIN p_stocks s ON p.Stock = s.ID WHERE  p.URL='" . $ID . "' AND p.Status=1";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
		
		if($num==0)
		{
			redirect("404.php");
		}
		else
		{
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			
			$ID=$row["ID"];
			$Name=$row["ProductName"];
			$NameArabic=$row["ProductNameArabic"];
			$MetaDes=$row["MetaDescription"];
			$MetaKey=$row["MetaKeywords"];
			$URL=$row["URL"];
			$Pricee=$row["Price"];
			$Overview=$row["Overview"];
			$OverviewArabic=$row["OverviewArabic"];
			$Description=$row["Description"];
			$DescriptionArabic=$row["DescriptionArabic"];
			$Stock=$row["StockName"];
			$StockText=$row["Text"];
			$Manufacture=$row["Manufacture"];
			$Shipping = $row["Shipping"];
			$Discountt=$row["Discount"];
			$Quantity=$row["Quantity"];
			$Ratings=$row["Ratings"];
			$Category=explode(',',$row["Categories"]);
			$BrandImage=$row["bimg"];
			$RelatedProducts=$row["RelatedProducts"];
			$Image=$row["Image"];
			$Img = explode(',',$Image);
			$numb=count($Img);
		}
	}
	else
	{
			redirect("404.php");
	}
	// echo $Pricee;
	// exit();
if(isset($_POST["action1"]) && $_POST["action1"] == "submit_form")
{	
	if(isset($_POST["ReviewName"]))
		$ReviewName=trim($_POST["ReviewName"]);
	if(isset($_POST["ReviewReview"]))
		$ReviewReview=trim($_POST["ReviewReview"]);
	if(isset($_POST["ReviewRatings"]))
		$ReviewRatings=trim($_POST["ReviewRatings"]);

	
		

	
		if($ReviewName == "")
		{
			$msg1='(<span style="color:red">Please Enter Name</span>)';
		}
		else if($ReviewReview == "")
		{
			$msg1='(<span style="color:red">Please Enter Review</span>)';
		}
		
			


	if($msg1=="")
	{

	
		$query="INSERT INTO product_reviews SET DateAdded=NOW(),
				Name = '" . dbinput($ReviewName) . "',
				Review = '" . dbinput($ReviewReview) . "',
				Ratings = '" . dbinput($ReviewRatings) . "',
				ProductID = '" . $ID . "'";
		mysql_query($query) or die (mysql_error());
		// echo $query;
		// $ID = mysql_insert_id();
		$_SESSION["msg1"]='(<span style="color:darkgreen">Your Review has been Sended</span>)';		
		
		redirect("".$URL."");	
	}
		

}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $Name; ?> - <?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $Name; ?>">
<meta name="keywords" content="<?php echo SiteTitle; ?>">
<meta name="author" content="<?php echo SiteTitle; ?>">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
        <meta property="og:url"           content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="<?php echo $Name; ?>" />
	<meta property="og:description"   content="<?php echo $Name.' || Price: '. ($Discountt != 0 ? CURRENCY_SYMBOL.$Discountt : CURRENCY_SYMBOL.$Pricee); ?>" />
	<meta property="og:image"         content="<?php echo "http://".$_SERVER[HTTP_HOST].'/admin/'.DIR_PRODUCTS_IMAGES . $Img[0]; ?>" />
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!-- js -->
<script src="js/jquery.min.js"></script>
<!-- //js -->
<!-- cart -->
<script src="js/simpleCart.min.js"></script>
<!-- cart -->
<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smooth-scrolling -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- //end-smooth-scrolling -->
</head>
	
<body>
<!--header-->
	
	
	<?php include("header.php"); ?>
	<!--//header-->
<!-- banner -->
	<div class="banner10" id="home1">
		<div class="container">
			<h2><?php echo dboutput($Name); ?></h2>
		</div>
	</div>
<!-- //banner -->

<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
	<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li><?php echo get_breadcrumbs($Category[count($Category)-1], 'categories', 10); ?>
				<li><i> / </i><?php echo $Name; ?></li>
			</ul>
		</div>
	</div>
<!-- //breadcrumbs -->

<!-- single -->
	<div class="single">
		<div class="container">
			<div class="col-md-4 single-left">
				<div class="flexslider">
					<ul class="slides">
                   <?php
						  for($i = 0 ; $i < $numb ; $i++)
						  {
						  ?>
                          <li data-thumb="ImageResizer.php?w=800&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Img[$i]; ?>">
							
                            <div class="thumb-image"> <img src="ImageResizer.php?w=400&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Img[$i]; ?>" data-imagezoom="true" class="img-responsive"> </div>
							</li>	
							<?php
						  }
						  ?>
					</ul>
				</div>
				<!-- flixslider -->
					<script defer src="js/jquery.flexslider.js"></script>
					<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
					<script>
					// Can also be used with $(document).ready()
					$(window).load(function() {
					  $('.flexslider').flexslider({
						animation: "slide",
						controlNav: "thumbnails"
					  });
					});
					</script>
				<!-- flixslider -->
				<!-- zooming-effect -->
					<script src="js/imagezoom.js"></script>
				<!-- //zooming-effect -->
			</div>
			<div class="col-md-8 single-right">
				<h3><?php echo $Name; ?></h3>
				<div class="rating1">
					<span class="starRating">
                   <?php
							
							 $r = round(($Ratings*0.05), 2);
							 $t =(100*0.05);							 
							for($i = 0; $i< $r ; $i++)
							{
								if($i < $r )
								{
								echo "<div class='rating-left'>
								<img src='images/star-.png' alt='Rating' class='img-responsive' />
								</div> ";
								}
							}
							?>
                            <?php
							for($i=5; $i > $r; $i--)
							{
								
								echo "<div class='rating-left'>
												<img src='images/star.png' alt='Rating' class='img-responsive' />
											</div>
											";
								
								
							}
							?>
						
					</span>
                  <p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
				</div>
					<div class="description">
						<h5><i>Description</i></h5>
						<?php echo $Description; ?>
					</div>
					<div class="color-quality">
						<div class="color-quality-left">
							<h5>Item Code : </h5>
					
								<div class="entry value3"><span><?php echo $ID; ?></span></div>
								
						
						</div>
						<div class="color-quality-right">
							<h5>Quantity :</h5>
							 <div class="quantity"> 
								<div class="quantity-select">                           
									
									<div class="entry value3"><span><?php echo $Quantity; ?></span></div>
									
								</div>
							</div>
							

						</div>
						<div class="clearfix"> </div>
					</div>
					
                  
                <div class="options-area">
				
				<?php
				$query = "SELECT DISTINCT o.ID,o.OptionName FROM product_options po LEFT JOIN p_options o ON po.OptionID = o.ID where o.Status = 1 AND po.ProductID=".$ID;
				$res = mysql_query($query);
				while($row = mysql_fetch_array($res))
				{
				?>
                
				<?php
				} 
				?>
					<div class="simpleCart_shelfItem">
                    
                    <?php
						$Discountt = $Discountt;
						$Pricee = $Pricee;
						echo ($Pricee != 0 ? '<p><span>'.CURRENCY_SYMBOL.$Pricee.' </span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discountt.'</i></p>' : CURRENCY_SYMBOL.$Pricee);
						
					?>
						
							<p><a class="item_add" href="add_to_cart.php?id=<?php echo $ID; ?>&name=<?php echo $Name; ?>&quantity=1&options=0&url=<?php echo $URL; ?>">Add to cart</a></p>
						</div>

			</div></div></div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="w3l_related_products">
		<div class="container">
			<h3>Related Products</h3>
              <?php 
						$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND FIND_IN_SET(ID,'".$RelatedProducts."') ORDER BY ID DESC Limit 10";
						$res = mysql_query($query) or die(mysql_error());
						$cou=0;
						while($row = mysql_fetch_array($res,MYSQL_ASSOC))
						{
						$Image=explode(',', $row["Image"]);
						$img1 = $Image[0];
						if($row["Discount"] != 0)
						{
							$persentage = ($row["Discount"] / $row["Price"]) * 100;
							$persentage = 100 - $persentage;
							$persentage = round($persentage);
						}
						if($cou%4==0)
						{
						?>
             <ul id="flexiselDemo2">
           		  <?php
				}
				?>	
                	
		  
				<li>
					<div class="w3l_related_products_grid">
						<div class="agile_ecommerce_tab_left dresses_grid">
							<div class="hs-wrapper hs-wrapper3">
								<img src="<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>">
							
								<div class="w3_hs_bottom">
									<div class="flex_ecommerce">
				<a  href="<?php echo dboutput($row['URL']); ?>"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
                                     
										<a href="add_to_wishlist.php?id=<?php echo $ProductIDTemp; ?>&name=<?php echo $ProductNameTemp; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>" ><span class="glyphicon glyphicon-heart-empty"  aria-hidden="true"></span></a>
									
									</div>
								</div>
							</div>
							<h5><a href="<?php echo dboutput($row['URL']); ?>"><?php echo dboutput($row['ProductName']); ?></a></h5>
							<div class="simpleCart_shelfItem">
                             <?php
						$Discount = $row["Discount"];
						$Price = $row["Price"];
						echo ($Price != 0 ? '<p class="flexisel_ecommerce_cart"><span>'.CURRENCY_SYMBOL.$Price.' </span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price);
					?>
								
								<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
							</div>
						</div>
					</div>
			
            	</li>
              
                <?php
								$cou++;
								if($cou%4==0)
								{
								?>
								 </ul>
								<?php
								}
								
								}
								?>
              
		</div>
	</div>
    
    
 
   						  
<!-- //single -->

<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo2").flexisel({
							visibleItems:4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems:2
								},
								tablet: { 
									changePoint:768,
									visibleItems: 3
								}
							}
						});
						
					});
				</script>
				<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	<!--footer-->
	<?php include("footer.php"); ?>
	<!--//footer-->	
</body>
</html>