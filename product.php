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
	<meta property="og:url"           content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="<?php echo $Name; ?>" />
	<meta property="og:description"   content="<?php echo $Name.' || Price: '. ($Discountt != 0 ? CURRENCY_SYMBOL.$Discountt : CURRENCY_SYMBOL.$Pricee); ?>" />
	<meta property="og:image"         content="<?php echo "http://".$_SERVER[HTTP_HOST].'/admin/'.DIR_PRODUCTS_IMAGES . $Img[0]; ?>" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel='shortcut icon' href='admin/<?php echo DIR_LOGOS.$_SETTINGS_Header_LOGO; ?>' type='image/x-icon' ><!--Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--//Custom Theme files -->
<!--js
<script src="js/jquery-1.11.1.min.js"></script>
-->
<script src="js/modernizr.custom.js"></script>
<script src='js/jquery-1.9.1.js'></script>
<script src='js/jquery.elevatezoom.js'></script>
<!--//js-->
<!--flex slider-->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider1.css" type="text/css" media="screen" />
<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>
<!--flex slider-->
<script src="js/imagezoom.js"></script>
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
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
<?php echo get_breadcrumbs($Category[count($Category)-1], 'categories', 10); ?>
				<li class="active"><?php echo $Name; ?></li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--single-page-->
	<div class="single">
		<div class="container">
			<div class="single-info">		
				<div class="col-md-5 single-top wow fadeInLeft animated" data-wow-delay=".5s">	
            	<div class="zoom-left">
					<img style="border:1px solid #e8e8e6;" id="zoom_03" src="ImageResizer.php?w=400&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Img[0]; ?>" data-zoom-image="ImageResizer.php?w=800&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Img[0]; ?>"
                    />
					<br/><br/>
                    <div id="gallery_01" class="galleries" style="width:500pxfloat:left;margin-top:80px; ">
                       <?php
						  for($i = 0 ; $i < $numb ; $i++)
						  {
						  ?>
							<a  href="#" class="elevatezoom-gallery<?php echo ($i == 0  ? 'active' : ''); ?>" data-update="" data-image="ImageResizer.php?w=400&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Img[$i]; ?>" 
							data-zoom-image="ImageResizer.php?w=800&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Img[$i]; ?>">
							<img src="<?php echo 'admin/'.DIR_PRODUCTS_IMAGES . $Img[$i]; ?>" width="100"  /></a>		
							<?php
						  }
						  ?>
                    </div>
					
                </div>
                    
                    <script type="text/javascript">
                    $(document).ready(function () {
                    $("#zoom_03").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: "active", imageCrossfade: true, loadingIcon: "images/loader.gif"}); 
                    
                    $("#zoom_03").bind("click", function(e) {  
                      var ez =   $('#zoom_03').data('elevateZoom');
                      ez.closeAll(); //NEW: This function force hides the lens, tint and window	
                        $.fancybox(ez.getGalleryList());
                      return false;
                    }); 
                    
                    }); 
                    </script>
				</div>
				<div class="col-md-4 single-top-left simpleCart_shelfItem wow fadeInRight animated" data-wow-delay=".5s">
					<h3><?php echo $Name; ?></h3>
					<div class="single-rating">
						<span class="starRating">
							<?php
							for($i = 0; $i < 5;  $i++)
							{
								if($i <= ($Ratings*0.05))
									echo '<i style="color: #F07818" class="fa fa-star"></i>';
								else
									echo '<i style="color: #F07818" class="fa fa-star-o"></i>';
							}
							?>
							<input id="rating5" type="radio" name="rating" value="5" disabled="">
						</span>
						<p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
					</div>
					<h6 class="item_price">
					<?php
						$Discountt = $Discountt;
						$Pricee = $Pricee;
						echo ($Discountt != 0 ? CURRENCY_SYMBOL.$Discountt.' <small><br/><s>'.CURRENCY_SYMBOL.$Pricee.'</s></small>' : CURRENCY_SYMBOL.$Pricee);
					?>
					</h6>
					<p><?php echo $Overview; ?></p>
					<form id='myform' method='GET' action='add_to_cart.php'>
                <div class="options-area">
				<ul>
				<?php
				$query = "SELECT DISTINCT o.ID,o.OptionName FROM product_options po LEFT JOIN p_options o ON po.OptionID = o.ID where o.Status = 1 AND po.ProductID=".$ID;
				$res = mysql_query($query);
				while($row = mysql_fetch_array($res))
				{
				?>
                
				<?php
				} 
				?>
					<li>
						<div class="quantity">
                        <div class="collpse tabs">
					<div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".5s">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									  Description
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<?php echo $Description; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
             <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
				<input type="hidden" name="name" value="<?php echo $Name; ?>" />
				<input type="hidden" name="id" value="<?php echo $ID; ?>" />
				<input type="hidden" name="upsell" value="2" />
				<div class="row col-md-12">
					<div class="btn_form">
						<a type="button" class="add-cart item_add cursor-pointer" onclick="$('#myform').submit()">ADD TO CART</a>	
					</div>
					<br/><br/><br/><br/><br/><div class="fb-like" data-layout="standard" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
				</div>
                </form>
                
						</div>
					</li>
				</ul>
                </div>
               
<!--
					<img src="images/howto.jpg" class="img-responsive" />
-->				</div>
           
		
			   <div class="clearfix"> </div>
				<!--collapse-tabs-->
				
		   <?php
			if($RelatedProducts != '')
			{
		   ?>
		   <!--related-products-->
			<div class="new">
				<div class="container">
					<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
						<h3 class="title">Related <span>Products</span></h3>
					</div>
					<div class="container">
						<div class="row">
							<div class="row">
								<div class="col-md-9">
								</div>
								<div class="col-md-3">
									<!-- Controls -->
									<div class="controls pull-right hidden-xs">
										<a class="left glyphicon glyphicon-chevron-left btn" href="#carousel-example" data-slide="prev"></a>
										<a class="right glyphicon glyphicon-chevron-right btn" href="#carousel-example" data-slide="next"></a>
									</div>
								</div>
							</div>
							<div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
								<!-- Wrapper for slides -->
								<div class="carousel-inner">
				   <?php 
						$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND FIND_IN_SET(ID,'".$RelatedProducts."') ORDER BY ID DESC Limit 20";
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
									<div class="item <?php echo ($cou == 0 ? 'active' : ''); ?>">
						<?php
						}
						?>
										<div class="gallery-info">
									<div class="col-md-3 gallery-grid animated flipInY">
										<a href="<?php echo dboutput($row['URL']); ?>"><img src="<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
										<div class="gallery-text simpleCart_shelfItem">
											<a class="name" href="<?php echo dboutput($row['URL']); ?>"><h5><?php echo dboutput($row['ProductName']); ?></h5></a>
											<p>
												<span class="item_price">
											<?php
											$Discount = $row["Discount"];
											$Price = $row["Price"];
											echo ($Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price);
											?>
												</span>
											</p>
		<!--
											<h4 class="sizes">Sizes: <a href="#"> s</a> - <a href="#">m</a> - <a href="#">l</a> - <a href="#">xl</a> </h4>
		-->
											<ul>
												<!-- <li><a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a></li> -->
												<li><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
												<li><a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
											</ul>
										</div>
									</div>
										</div>
									  <?php
										$cou++;
										if($cou%4==0)
										{
										?>
										</div>
										<?php
										}
										
						}
										?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			else
			{
				?>
<?php
		$querysss="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 ORDER BY ID DESC Limit 20";
		$ressss = mysql_query($querysss) or die(mysql_error());
		if(mysql_num_rows($ressss) > 0)
		{
?>
	<div class="new">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="row">
						<div class="col-md-9">
							<a href="#"><h3 class="title">New <span>Arrivals</span></h3></a>
						</div>
						<div class="col-md-3">
							<div class="controls pull-right">
								<a class="left glyphicon glyphicon-chevron-left btn" href="#carousel-0" data-slide="prev"></a>
								<a class="right glyphicon glyphicon-chevron-right btn" href="#carousel-0" data-slide="next"></a>
							</div>
						</div>
					</div>
					<div id="carousel-0" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
           <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 ORDER BY RAND() Limit 20";
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
							<div class="item <?php echo ($cou == 0 ? 'active' : ''); ?>">
				<?php
				}
				?>
								<div class="gallery-info">
							<div class="col-md-3 gallery-grid animated flipInY">
								<a href="<?php echo dboutput($row['URL']); ?>"><img src="<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
								<div class="gallery-text simpleCart_shelfItem">
									<a class="name" href="<?php echo dboutput($row['URL']); ?>"><h5><?php echo dboutput($row['ProductName']); ?></h5></a>
									<p>
										<span class="item_price">
									<?php
									$Discount = $row["Discount"];
									$Price = $row["Price"];
									echo ($Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price);
									?>
										</span>
									</p>
<!--
									<h4 class="sizes">Sizes: <a href="#"> s</a> - <a href="#">m</a> - <a href="#">l</a> - <a href="#">xl</a> </h4>
-->
									<ul>
										<li><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
										<li><a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
									</ul>
								</div>
							</div>
								</div>
							  <?php
								$cou++;
								if($cou%4==0)
								{
								?>
								</div>
								<?php
								}
								
								}
								?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
		}
?>

		<?php
			}
		?>
	<!--//related-products-->
			<br/><br/>
		</div>
	</div>
	<!--//single-page-->


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