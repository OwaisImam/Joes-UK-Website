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
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script src="js/jquery.min.js"></script>
<!-- //js -->
<!-- countdown -->
<link rel="stylesheet" href="css/jquery.countdown.css" />
<!-- //countdown -->
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
</head>
	
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=982307405150852";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<!--header-->
	<?php include("header.php"); ?>
	<!--//header-->
<!-- banner -->
	
		<div class="container">
		<div class="col-md-12">
			<?php include("slider.php"); ?>
		</div>
	</div>
<!-- //banner -->

<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="col-md-5 wthree_banner_bottom_left">
				<div class="video-img">
	<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
						<span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
					</a>
				</div>
				<!-- pop-up-box -->    
						<link href="css/popuo-box.css" rel="stylesheet" type="text/css" property="" media="all" />
						<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!--//pop-up-box -->
					<div id="small-dialog" class="mfp-hide">
						<br>
                        <h4>Our Shop Located @</h4>
                        <br><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2558.1949500822097!2d67.08234670801936!3d24.93772457028967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f503e80fe73%3A0xc6a3d063ed72b61a!2sJoes+Uk!5e0!3m2!1sen!2s!4v1493897978717" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					<script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
					</script>
			</div>
                
                    
		<div class="col-md-7 wthree_banner_bottom_right">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home">Shirts</a></li>
						<li role="presentation"><a href="#t-shirt" role="tab" id="jeans-tab" data-toggle="tab" aria-controls="t-shirt">T-Shirts</a></li>
						<li role="presentation"><a href="#kids" role="tab" id="kids-tab" data-toggle="tab" aria-controls="kids">Kids</a></li>
						<li role="presentation"><a href="#shoes" role="tab" id="shoes-tab" data-toggle="tab" aria-controls="shoes">Shoes</a></li>
						<li role="presentation"><a href="#women" role="tab" id="women-tab" data-toggle="tab" aria-controls="women">Women</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
                        <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE Status = 1 AND FIND_IN_SET(107,Categories) AND FIND_IN_SET(125,Categories) ORDER BY RAND() Limit 3";
				$res = mysql_query($query) or die(mysql_error());
				$res22=$res;
				$cou=0;
				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				{
?>
<?php
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
							<div class="agile_ecommerce_tabs">
                            
                             <?php
				}
				?>
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
                                    
                                    <?php 
									for($i=0;$i<2;$i++)
									{
										?> 
											<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$Image[$i] ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
										
                                        <?php } ?>
										<div class="w3_hs_bottom">
											<ul>
												<li>
													<a href="#" data-toggle="modal" data-target="#<?php echo $row['ID'] ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
												</li>
                                               <li>
										<a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>" ><span class="glyphicon glyphicon glyphicon-heart-empty"  aria-hidden="true"></span></a>
									</li>
											</ul>
										</div>
									</div>
									<h5><a href="<?php echo dboutput($row['URL']); ?>"><?php echo dboutput($row['ProductName']); ?></a></h5>
									<div class="simpleCart_shelfItem">
										<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
										<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
									</div>
								</div>

								<!--modal-video-->
				<div class="modal video-modal fade" id="<?php echo $row['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							</div>
							<section>
								<div class="modal-body">
									<div class="col-md-5 modal_body_left">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
									</div>
									<div class="col-md-7 modal_body_right">
										<h4><?php echo dboutput($row['ProductName']); ?></h4>
										<p><?php echo dboutput($row['Description']);?></p>
										<div class="rating">
											 <?php
								$Ratings=$row["Ratings"];
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
                   &nbsp;&nbsp;&nbsp; <p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
											<div class="clearfix"> </div>
										</div>
										<div class="modal_body_right_cart simpleCart_shelfItem">
												<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
                                    
                                    <p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
                                     <p><a class="item_add" href="<?php echo dboutput($row['URL']); ?>">View Product</a></p>
								<p><a class="item_add"  href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
										</div>
										
										
									</div>
									<div class="clearfix"> </div>
								</div>
							</section>
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
                                
                               <div class="clearfix"> </div>
							</div>
                         </div>
                            
                     <div role="tabpanel" class="tab-pane fade" id="t-shirt" aria-labelledby="t-shirt-tab">
                       <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE Status = 1 AND FIND_IN_SET(107,Categories) AND FIND_IN_SET(126,Categories) ORDER BY RAND() Limit 3";
				$res = mysql_query($query) or die(mysql_error());
				$res22=$res;
				$cou=0;
				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				{
?>
<?php
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
							<div class="agile_ecommerce_tabs">
                      <?php } ?>
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
										<div class="w3_hs_bottom">
											<ul>
												<li>
													<a href="#" data-toggle="modal" data-target="#<?php echo $row['ID'] ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
												</li>
                                               <li>
										<a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>" ><span class="glyphicon glyphicon glyphicon-heart-empty"  aria-hidden="true"></span></a>
									</li>
											</ul>
										</div>
									</div>
								<h5><a href="<?php echo dboutput($row['URL']); ?>"><?php echo dboutput($row['ProductName']); ?></a></h5>
									<div class="simpleCart_shelfItem">
									<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
											<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
									</div>
								</div>
								
                                	<!--modal-video-->
				<div class="modal video-modal fade" id="<?php echo $row['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							</div>
							<section>
								<div class="modal-body">
									<div class="col-md-5 modal_body_left">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
									</div>
									<div class="col-md-7 modal_body_right">
										<h4><?php echo dboutput($row['ProductName']); ?></h4>
										<p><?php echo dboutput($row['Description']);?></p>
										<div class="rating">
											 <?php
								$Ratings=$row["Ratings"];
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
                   &nbsp;&nbsp;&nbsp; <p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
											<div class="clearfix"> </div>
										</div>
										<div class="modal_body_right_cart simpleCart_shelfItem">
												<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
                                    
                                    <p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
                                     <p><a class="item_add" href="<?php echo dboutput($row['URL']); ?>">View Product</a></p>
								<p><a class="item_add"  href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
										</div>
										
										
									</div>
									<div class="clearfix"> </div>
								</div>
							</section>
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
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="kids" aria-labelledby="watches-tab">
                        <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE Status = 1 AND FIND_IN_SET(108,Categories) ORDER BY RAND() Limit 3";
				$res = mysql_query($query) or die(mysql_error());
				$res22=$res;
				$cou=0;
				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				{
?>
<?php
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
							<div class="agile_ecommerce_tabs">
                      <?php } ?>
							
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
										<div class="w3_hs_bottom">
											<ul>
												<li>
													<a href="#" data-toggle="modal" data-target="#<?php echo $row['ID'] ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
												</li>
                                               <li>
										<a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>" ><span class="glyphicon glyphicon glyphicon-heart-empty"  aria-hidden="true"></span></a>
									</li>
											</ul>
										</div>
									</div>
								<h5><a href="<?php echo dboutput($row['URL']); ?>"><?php echo dboutput($row['ProductName']); ?></a></h5>
									<div class="simpleCart_shelfItem">
									<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
											<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
									</div>
								</div>
							
                            	<!--modal-video-->
				<div class="modal video-modal fade" id="<?php echo $row['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							</div>
							<section>
								<div class="modal-body">
									<div class="col-md-5 modal_body_left">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
									</div>
									<div class="col-md-7 modal_body_right">
										<h4><?php echo dboutput($row['ProductName']); ?></h4>
										<p><?php echo dboutput($row['Description']);?></p>
										<div class="rating">
											 <?php
								$Ratings=$row["Ratings"];
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
                   &nbsp;&nbsp;&nbsp; <p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
											<div class="clearfix"> </div>
										</div>
										<div class="modal_body_right_cart simpleCart_shelfItem">
												<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
                                    
                                    <p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
                                     <p><a class="item_add" href="<?php echo dboutput($row['URL']); ?>">View Product</a></p>
								<p><a class="item_add"  href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
										</div>
										
										
									</div>
									<div class="clearfix"> </div>
								</div>
							</section>
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
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="shoes" aria-labelledby="sandals-tab">
                           <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE Status = 1 AND FIND_IN_SET(107,Categories) AND FIND_IN_SET(143,Categories) ORDER BY RAND() Limit 3";
				$res = mysql_query($query) or die(mysql_error());
				$res22=$res;
				$cou=0;
				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				{
?>
<?php
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
							<div class="agile_ecommerce_tabs">
                            <?php } ?>
                            
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
										<div class="w3_hs_bottom">
											<ul>
												<li>
													<a href="#" data-toggle="modal" data-target="#<?php echo $row['ID'] ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
												</li>
                                               <li>
										<a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>" ><span class="glyphicon glyphicon glyphicon-heart-empty"  aria-hidden="true"></span></a>
									</li>
											</ul>
										</div>
									</div>
								<h5><a href="<?php echo dboutput($row['URL']); ?>"><?php echo dboutput($row['ProductName']); ?></a></h5>
									<div class="simpleCart_shelfItem">
									<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
											<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
									</div>
								</div>
								
                                	<!--modal-video-->
				<div class="modal video-modal fade" id="<?php echo $row['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							</div>
							<section>
								<div class="modal-body">
									<div class="col-md-5 modal_body_left">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
									</div>
									<div class="col-md-7 modal_body_right">
										<h4><?php echo dboutput($row['ProductName']); ?></h4>
										<p><?php echo dboutput($row['Description']);?></p>
										<div class="rating">
											 <?php
								$Ratings=$row["Ratings"];
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
                   &nbsp;&nbsp;&nbsp; <p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
											<div class="clearfix"> </div>
										</div>
										<div class="modal_body_right_cart simpleCart_shelfItem">
												<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
                                    
                                    <p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
                                     <p><a class="item_add" href="<?php echo dboutput($row['URL']); ?>">View Product</a></p>
								<p><a class="item_add"  href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
										</div>
										
										
									</div>
									<div class="clearfix"> </div>
								</div>
							</section>
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
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="women" aria-labelledby="jewellery-tab">
                              <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE Status = 1 AND FIND_IN_SET(106,Categories) ORDER BY RAND() Limit 3";
				$res = mysql_query($query) or die(mysql_error());
				$res22=$res;
				$cou=0;
				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				{
?>
<?php
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
							<div class="agile_ecommerce_tabs">
                            <?php } ?>
							
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
								<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
										<div class="w3_hs_bottom">
											<ul>
												<li>
													<a href="#" data-toggle="modal" data-target="#<?php echo $row['ID'] ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
												</li>
                                              <li>
										<a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>" ><span class="glyphicon glyphicon glyphicon-heart-empty"  aria-hidden="true"></span></a>
									</li>
											</ul>
										</div>
									</div>
									<h5><a href="<?php echo dboutput($row['URL']); ?>"><?php echo dboutput($row['ProductName']); ?></a></h5>
									<div class="simpleCart_shelfItem">
										<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
										<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
									</div>
								</div>
								
                                	<!--modal-video-->
				<div class="modal video-modal fade" id="<?php echo $row['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							</div>
							<section>
								<div class="modal-body">
									<div class="col-md-5 modal_body_left">
										<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
									</div>
									<div class="col-md-7 modal_body_right">
										<h4><?php echo dboutput($row['ProductName']); ?></h4>
										<p><?php echo dboutput($row['Description']);?></p>
										<div class="rating">
											 <?php
								$Ratings=$row["Ratings"];
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
                   &nbsp;&nbsp;&nbsp; <p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
											<div class="clearfix"> </div>
										</div>
										<div class="modal_body_right_cart simpleCart_shelfItem">
												<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
                                    
                                    <p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
                                     <p><a class="item_add" href="<?php echo dboutput($row['URL']); ?>">View Product</a></p>
								<p><a class="item_add"  href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
										</div>
										
										
									</div>
									<div class="clearfix"> </div>
								</div>
							</section>
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
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>

					<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
<!-- //banner-bottom -->

<!-- banner-bottom1 -->
	<div class="banner-bottom1">
		<div class="agileinfo_banner_bottom1_grids">
			<div class="col-md-7 agileinfo_banner_bottom1_grid_left">
				<h3>Grand Opening Event With flat<span>20% <i>Discount</i></span></h3>
				<a href="products.html">Shop Now</a>
			</div>
			<div class="col-md-5 agileinfo_banner_bottom1_grid_right">
				<h4>hot deal</h4>
				<div class="timer_wrap">
					<div id="counter"> </div>
				</div>
				<script src="js/jquery.countdown.js"></script>
				<script src="js/script.js"></script>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //banner-bottom1 -->

<!-- special-deals -->
	<div class="special-deals">
		<div class="container">
			<h2>Special Deals</h2>
			<div class="w3agile_special_deals_grids">
				<div class="col-md-7 w3agile_special_deals_grid_left">
					<div class="w3agile_special_deals_grid_left_grid">
						<img src="images/26.jpg" alt=" " class="img-responsive" />
						<div class="w3agile_special_deals_grid_left_grid_pos1">
							<h5>30%<span>Off/-</span></h5>
						</div>
						<div class="w3agile_special_deals_grid_left_grid_pos">
							<h4>We Offer <span>Best Products</span></h4>
						</div>
					</div>
					<div class="wmuSlider example1">
						<div class="wmuSliderWrapper">
                        	<?php 
		$query="SELECT ID,Name,Image,URL,Text
		FROM banners WHERE ID <>0 AND Status = 1 AND Name = 'article' ORDER BY RAND() LIMIT 3";
		$r = mysql_query($query) or die(mysql_error());
		$n = mysql_num_rows($r);
		while($row =  mysql_fetch_array($r))
		{
		?>
			<article style="position: absolute; width: 100%; opacity: 0;"> 
			<div class="banner-wrap">
			<div class="w3agile_special_deals_grid_left_grid1">
				<?php if(is_file('admin/'.DIR_WEBSITE_BANNERS.dboutput($row['Image']))) echo '<img src="admin/'.DIR_WEBSITE_BANNERS.dboutput($row['Image']).'" class="img-responsive"/>'; 
				?>
                		<?php echo '<p>'.$row['Text'].'</p>'; 
				?>
                
                </div>
								</div>
							</article>
		<?php 
		}
		?>
        
									
						
						</div>
					</div>
						<script src="js/jquery.wmuSlider.js"></script> 
						<script>
							$('.example1').wmuSlider();         
						</script> 
				</div>
				<div class="col-md-5 w3agile_special_deals_grid_right">
					<img src="images/25.jpg" alt=" " class="img-responsive" />
					<div class="w3agile_special_deals_grid_right_pos">
						<h4>Women's <span>Special</span></h4>
						<h5>save up <span>to</span> 30%</h5>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //special-deals -->
<!-- new-products -->
	<div class="new-products">
		<div class="container">
			<h3>New Products</h3>
               <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE Status = 1 ORDER BY RAND() Limit 4";
				$res = mysql_query($query) or die(mysql_error());
				$res22=$res;
				$cou=0;
				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				{
?>
<?php
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
			<div class="agileinfo_new_products_grids">
            <?php
				}
				?>
				<div class="col-md-3 agileinfo_new_products_grid">
					<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
						<div class="hs-wrapper hs-wrapper1">
                  	<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
                       	<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
                        	<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
							
                               
							<div class="w3_hs_bottom w3_hs_bottom_sub">
								<ul>
									<li>
										<a href="#" data-toggle="modal" data-target="#<?php echo $row["ID"]; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</li>
                                    
									<li>
										<a href="add_to_wishlist.php?id=<?php echo $ProductIDTemp; ?>&name=<?php echo $ProductNameTemp; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>" ><span class="glyphicon glyphicon-heart-empty"  aria-hidden="true"></span></a>
									</li>
								</ul>
							</div>
						</div>
			<h5><a href="<?php echo dboutput($row['URL']); ?>"><?php echo dboutput($row['ProductName']); ?></a></h5>
						<div class="simpleCart_shelfItem">
							<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
                                    
							<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
						</div>
					</div>
				</div>
				
                	<!--modal-video-->
                  
					<div class="modal video-modal fade" id="<?php echo $row['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="">	
				
				
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
							</div>
							<section>
								<div class="modal-body">
									<div class="col-md-5 modal_body_left">
											<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/>
									</div>
									<div class="col-md-7 modal_body_right">
										<h4><?php echo dboutput($row['ProductName']); ?></h4>
										<p><?php echo dboutput($row['Description']);?></p>
										<div class="rating">
											 <?php
								$Ratings=$row["Ratings"];
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
                   &nbsp;&nbsp;&nbsp; <p><?php echo round(($Ratings*0.05), 2); ?> out of 5</p>
											<div class="clearfix"> </div>
										</div>
										<div class="modal_body_right_cart simpleCart_shelfItem">
											<?php
										$Discount = $row["Discount"];
									$Price = $row["Price"];
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
											<p><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
                                            <p><a class="item_add" href="<?php echo dboutput($row['URL']); ?>">View Product</a></p>
                                            <p><a class="item_add" href="add_to_wishlist.php?id=<?php echo $ProductIDTemp; ?>&name=<?php echo $ProductNameTemp; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to Wishlist</a></p>
										</div>
										
										
									</div>
									<div class="clearfix"> </div>
								</div>
							</section>
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
				
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //new-products -->

<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h3>Top Brands</h3>
			<div class="sliderfig">
				<ul id="flexiselDemo1">			
					<li>
						<img src="images/4.png" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="images/5.png" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="images/6.png" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="images/7.png" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="images/46.jpg" alt=" " class="img-responsive" />
					</li>
				</ul>
			</div>
					<script type="text/javascript">
							$(window).load(function() {
								$("#flexiselDemo1").flexisel({
									visibleItems: 4,
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
		</div>
	</div>
<!-- //top-brands -->

<!--Footer-->
<?php include("footer.php"); ?>
<!--Footer-->
</body>
</html>