<?php include("admin/Common.php"); ?>
<?php $CatID = 0; ?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo SiteTitle; ?>">
<meta name="keywords" content="<?php echo SiteTitle; ?>">
<meta name="author" content="<?php echo SiteTitle; ?>">
<meta property="og:url"           content="<?php echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php echo SiteTitle; ?>" />
<meta property="og:description"   content="<?php echo SiteTitle; ?>" />
<meta property="og:image"         content="<?php echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>images/logo.png" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '222095388204796');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=222095388204796&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
<!--Custom Theme files -->
<link rel='shortcut icon' href='images/icon.png' type='image/x-icon' >
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!--//Custom Theme files -->
<!--js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--//js-->
<!--cart-- >
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
	 // new WOW().init();
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
	<!--banner-->
	<div class="container">
		<div class="col-md-12">
			<?php include("slider.php"); ?>
		</div>
<!--
		<div class="col-md-4 side-banner">
			<?php 
			$query="SELECT ID,Name,Heading,Text,Image,URL
			FROM banners WHERE ID <>0 AND Status = 1 AND Type = 1 ORDER BY RAND() LIMIT 2 ";
			$r = mysql_query($query) or die(mysql_error());
			$n = mysql_num_rows($r);
			while($row =  mysql_fetch_array($r))
			{
			?>
				<a href="<?php echo dboutput($row['URL']); ?>">
					<img src="admin/<?php echo DIR_WEBSITE_BANNERS.dboutput($row['Image']); ?>" />
				</a>
			<?php 
			}
			?>
		</div>
-->
	</div>
	<!--//banner-->
	<!--new-->
<style>
.show_more_main {
margin: 15px 25px;
text-align: center;
width: 92%;
}
.show_more {
background-color: #f8f8f8;
background-image: -webkit-linear-gradient(top,#fcfcfc 0,#f8f8f8 100%);
background-image: linear-gradient(top,#fcfcfc 0,#f8f8f8 100%);
border: 1px solid;
border-color: #d3d3d3;
color: #333;
font-size: 12px;
outline: 0;
}
.show_more {
cursor: pointer;
padding: 10px 30px;
text-align: center;
font-weight:bold;
}
.loding {
background-color: #e9e9e9;
border: 1px solid;
border-color: #c6c6c6;
color: #333;
font-size: 12px;
margin: 15px 25px;
text-align: center;
width: 92%;
padding: 10px 30px;
outline: 0;
font-weight:bold;
}
.loding_txt {
background-image: url(images/loading_16.gif);
background-position: left;
background-repeat: no-repeat;
border: 0;
display: inline-block;
height: 16px;
padding-left: 20px;
}
</style>
		   <!--related-products-- >
			<div class="new">
				<div class="container">
					<div class="col-md-12">
						<div class="title-info fadeInUp animated">
							<h3 class="title">New <span>Arrivals</span></h3>
						</div>
						<div class="container">
							<div class="row products-list-full">
					   <?php 
							$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 ORDER BY ID DESC Limit 12";
							$res = mysql_query($query) or die(mysql_error());
							$cou=0;
							if(mysql_num_rows($res) > 0)
							{
								while($row = mysql_fetch_array($res,MYSQL_ASSOC))
								{
									$tutorial_id = 	$row['ID'];
									$Image=explode(',', $row["Image"]);
									$img1 = $Image[0];
									if($row["Discount"] != 0)
									{
										$persentage = ($row["Discount"] / $row["Price"]) * 100;
										$persentage = 100 - $persentage;
										$persentage = round($persentage);
									}
	?>
										<div class="gallery-info">
											<div class="col-md-3 gallery-grid animated flipInY">
												<a href="<?php echo dboutput($row['URL']); ?>"><img lsrc="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" src="images/loader.gif" class="img-responsive img-load-after" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
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
				-- >
													<ul>
														<li><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
														<li><a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
													</ul>
												</div>
											</div>
										</div>
											<?php											
								}
								?>
								</div>
								<div class="row">
									<div class="col-md-12 show_more_main" ID="show_more_main<?php echo $tutorial_id; ?>">
										<span ID="<?php echo $tutorial_id; ?>" class="show_more" title="Load more posts">Show more</span>
										<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
									</div>
								<?php
							}
											?>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--//new-- >
<?php
		$querysss="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND BestSeller = 1 ORDER BY ID DESC Limit 20";
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
							<a href="deals"><h3 class="title"><span>Deals</span></h3></a>
						</div>
						<div class="col-md-3">
							<div class="controls pull-right">
								<a class="left glyphicon glyphicon-chevron-left btn" href="#carousel-00" data-slide="prev"></a>
								<a class="right glyphicon glyphicon-chevron-right btn" href="#carousel-00" data-slide="next"></a>
							</div>
						</div>
					</div>
					<div id="carousel-00" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
           <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND BestSeller = 1 ORDER BY ID DESC Limit 20";
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
								<a href="<?php echo dboutput($row['URL']); ?>"><img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
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
-->
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
								<a href="<?php echo dboutput($row['URL']); ?>"><img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
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
	$query="SELECT ID,Banner,Sort,Status,CategoryName,Parent,DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated FROM categories WHERE ShowOnHome = 1 AND Status = 1 ";
	$query .= " ORDER BY Sort";
	$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
	while($rows = mysql_fetch_array($result))
	{
		$querysss="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND FIND_IN_SET (".$rows["ID"].",Categories)  ORDER BY ID DESC Limit 20";
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
							<a href="category.php?ID=<?php echo $rows['ID']; ?>"><h3 class="title"><span><?php echo $rows['CategoryName']; ?></span></h3></a>
						</div>
						<div class="col-md-3">
							<div class="controls pull-right">
								<a class="left glyphicon glyphicon-chevron-left btn" href="#carousel-<?php echo $rows["ID"]; ?>" data-slide="prev"></a>
								<a class="right glyphicon glyphicon-chevron-right btn" href="#carousel-<?php echo $rows["ID"]; ?>" data-slide="next"></a>
							</div>
						</div>
					</div>
					<div id="carousel-<?php echo $rows["ID"]; ?>" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
           <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND FIND_IN_SET (".$rows["ID"].",Categories)  ORDER BY ID DESC Limit 20";
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
								<a href="<?php echo dboutput($row['URL']); ?>"><img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
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
	}
?>
	<!--trend-->
	<br/><br/><br/><br/>&nbsp;
	<!--//trend-->
	<!--footer-->
	<?php include("footer.php"); ?>
	<!--//footer-->		
	<!--search jQuery-->
	<script src="js/main.js"></script>
	<!--//search jQuery-->
	<!--smooth-scrolling-of-move-up-->
	<script type="text/javascript">
 $(window).load(function () {
    $.each(document.getElementsByClassName('img-load-after'), function(){
               var this_image = this;
               var src = $(this_image).attr('src') || '' ;
			   if(src == "images/loader.gif"){
                   var lsrc = $(this_image).attr('lsrc') || '' ;
                   if(lsrc.length > 0){
                       var img = new Image();
                       img.src = lsrc;
                       $(img).load(function() {
                           this_image.src = this.src;
                       });
                   }
               }
           });
  });
		$(document).ready(function() {
	$(document).on('click','.show_more',function(){
		var ID = $(this).attr('ID');
		$('.show_more').hide();
		$('.loding').show();
		$.ajax({
			type:'POST',
			url:'ajax_more.php',
			data:'ID='+ID,
			success:function(html){
				$('#show_more_main'+ID).remove();
				$('.products-list-full').append(html);
			}
		});
		
	});
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