<?php include("admin/Common.php"); ?>
<?php include ('pagination.php'); //include of paginat page ?>
<?php
$Name="";
$NameArabic="";
$MetaDes="";
$MetaKey="";
$Description="";
$DescriptionArabic="";
$URL="";
$Parent=0;
$Banner="";
$ID=0;
$CatID=0;

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
<title>Deals - <?php echo SiteTitle; ?></title>
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
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
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
<script>
$(document).ready(
    function()
    {
        $("input:checkbox").change(
            function()
            {
                if( $(this).is(":checked") )
                {
                    $("#frmsubmit").submit();
                }
				else
				{
					$("#frmsubmit").submit();
				}
            }
        )
    }
);
</script>
<?php
$query="SELECT Max(Price) as MaxPrice FROM products WHERE Status = 1";
$result = mysql_query ($query) or die(mysql_error()); 
$maxx = mysql_fetch_array($result);
$max = $maxx['MaxPrice'];

?>
						<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-3" ).slider({
               range:true,
			   animate: "slow",
               min: 0,
               max: <?php echo $max; ?>,
               values: [ <?php if(isset($_REQUEST['minprice'])){ echo $_REQUEST['minprice'];}else{ echo 0; }; ?>, <?php if(isset($_REQUEST['maxprice'])){ echo $_REQUEST['maxprice'];}else{ echo $max; }; ?> ],
               slide: function( event, ui ) {
                  $( "#price" ).val( "<?php echo 'Rs. '; ?>" + ui.values[ 0 ] + " - " + "<?php echo 'Rs. '; ?>" + ui.values[ 1 ] );
				  $( "#minprice" ).val( ui.values[ 0 ]);
				  $( "#maxprice" ).val( ui.values[ 1 ]);
				  $("#frmsubmit").submit();
               }
           });
         $( "#price" ).val( "<?php echo 'Rs. '; ?>" + $( "#slider-3" ).slider( "values", 0 ) + " - " +
            "<?php echo 'Rs. '; ?>" + $( "#slider-3" ).slider( "values", 1 ));
							});//]]>  
						</script>
						<script type="text/javascript" src="js/jquery-ui.js"></script>
	<!--//header-->
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active"><?php echo $Name; ?></li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--contact-->
	<div class="products">	 
		<div class="container">
			<div class="col-md-3 rsidebar hidden-xs">
				<div class="rsidebar-top">
					<div class="sidebar-row">
						<a href="#"><h4> Categories </h4></a>
									<?php
									$query6="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = 0 ORDER BY Sort";
									$result6 = mysql_query ($query6) or die(mysql_error());
									$num6 = mysql_num_rows($result6);
									if($num6 != 0)
									{
										echo '<ul class="faq">';
									}
									while($row6 = mysql_fetch_array($result6,MYSQL_ASSOC))
									{
									?>
							<li class="item<?php echo $row6["ID"]; ?>">
								<a href="category.php?ID=<?php echo $row6['ID']; ?>" <?php echo ($row6['ID'] == $ID ? 'style="font-weight:bold;"' : ''); ?>><?php echo $row6['CategoryName']; ?>
									<?php
									$query7="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = ".$row6['ID']." ORDER BY Sort";
									$result7 = mysql_query ($query7) or die(mysql_error()); 
									$num7 = mysql_num_rows($result7);
									if($num7 != 0)
									{
										echo '<span class="glyphicon glyphicon-menu-down"></span></a>
							<ul>';
										while($row7 = mysql_fetch_array($result7,MYSQL_ASSOC))
										{
										?>
							
									<li class="subitem1"><a href="category.php?ID=<?php echo $row7['ID']; ?>" <?php echo ($row7['ID'] == $ID ? 'style="font-weight:bold;"' : ''); ?>><?php echo $row7['CategoryName']; ?></a></li>
									<?php
												echo '</a>';
											}
											echo '</ul>';
										}
										else
										{
											echo'</a>';
										}
										?>
							</li>
<?php
									}
									?>
							<?php
							?>
						</ul>
						<!-- script for tabs -->
						<script type="text/javascript">
							$(function() {
							
								var menu_ul = $('.faq > li > ul'),
									   menu_a  = $('.faq > li > a');
								
								menu_ul.hide();
							
								menu_a.click(function(e) {
									e.preventDefault();
									if(!$(this).hasClass('active')) {
										menu_a.removeClass('active');
										menu_ul.filter(':visible').slideUp('normal');
										$(this).addClass('active').next().stop(true,true).slideDown('normal');
									} else {
										$(this).removeClass('active');
										$(this).next().stop(true,true).slideUp('normal');
									}
								});
							
							});
						</script>
						<!-- script for tabs -->
					</div>
                    <form id="frmsubmit" action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="get">
					<input type="hidden" name="ID" value="<?php echo $ID; ?>" />
					<div class="sidebar-row">
						<h4>Filter By Price</h4>
						<div class="row">
                          <p>         
							 <input type="text" id="price" 
								style="border:0; color:#000; font-weight:bold; background:none;">
							<input type="hidden" name="minprice" id="minprice" value="0">
							<input type="hidden" name="maxprice" id="maxprice" value="<?php echo $maxx['MaxPrice']; ?>">
						  </p>
						  <div id="slider-3"></div>
						</div>
					</div>
					<div class="sidebar-row">
						<h4>Size</h4>
						<div class="row row1 scroll-pane">
                            <?php
							$query="SELECT ID,ValueName FROM p_options_values WHERE Status = 1 AND OptionID = 1 ORDER BY Sort";
							$result = mysql_query ($query) or die(mysql_error());
							$num = mysql_num_rows($result);
							if($num == 0)
							{ ?>
							<label class="checkbox">Not Available</label>
							<?php
							}
							$i=1;
							while($row = mysql_fetch_array($result,MYSQL_ASSOC))
							{
							?>
							<label <?php if(isset($_REQUEST['size'.$i.''])){echo ($_REQUEST['size'.$i.''] == $row['ID'] ? 'style="font-weight:bold;"' : '');}; ?> for="fsize-<?php echo $i; ?>" class="checkbox"><input id="fsize-<?php echo $i; ?>" <?php if(isset($_REQUEST['size'.$i.''])){echo ($_REQUEST['size'.$i.''] == $row['ID'] ? 'checked' : '');}; ?> type="checkbox" name="size<?php echo $i; ?>" value="<?php echo $row['ID']; ?>"><i></i><?php echo $row['ValueName']; ?></label>
                           	<?php
							$i++;
							}
							?>
						</div>

						<h4>Color</h4>
						<div class="row row1 scroll-pane">
                            <?php
							$query="SELECT ID,ValueName FROM p_options_values WHERE Status = 1 AND OptionID = 2 ORDER BY Sort";
							$result = mysql_query ($query) or die(mysql_error());
							$num = mysql_num_rows($result);
							if($num == 0)
							{ ?>
							<label class="checkbox">Not Available</label>
							<?php
							}
							$i=1;
							while($row = mysql_fetch_array($result,MYSQL_ASSOC))
							{
							?>
							<label <?php if(isset($_REQUEST['color'.$i.''])){echo ($_REQUEST['color'.$i.''] == $row['ID'] ? 'style="font-weight:bold;"' : '');}; ?> for="fcolor-<?php echo $i; ?>" class="checkbox"><input id="fcolor-<?php echo $i; ?>" <?php if(isset($_REQUEST['color'.$i.''])){echo ($_REQUEST['color'.$i.''] == $row['ID'] ? 'checked' : '');}; ?> type="checkbox" name="color<?php echo $i; ?>" value="<?php echo $row['ID']; ?>"><i></i><?php echo $row['ValueName']; ?></label>
                           	<?php
							$i++;
							}
							?>
						</div>
					</div>
				</div>
		<?php 
		$query="SELECT ID,Name,Image,URL
		FROM banners WHERE ID <>0 AND Status = 1 AND Type = 2 ORDER BY RAND() LIMIT 3";
		$r = mysql_query($query) or die(mysql_error());
		$n = mysql_num_rows($r);
		while($row =  mysql_fetch_array($r))
		{
		?>
				<br/>
				<a href="<?php echo dboutput($row['URL']); ?>"><img src="admin/<?php echo DIR_WEBSITE_BANNERS.dboutput($row['Image']); ?>" class="img-responsive"/></a>
		<?php 
		}
		?>
			</div>
			<div class="col-md-9 product-model-sec">
                    <div class="sortby">
                    	<span class="pull-right">Sort By
                       <select id="input-sort" id="sorting" name="sort" onchange='this.form.submit()'>
                            <option value="0" selected="selected">Default</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 1 ? 'selected' : '');}; ?> value="1">Name (A - Z)</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 2 ? 'selected' : '');}; ?> value="2">Name (Z - A)</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 3 ? 'selected' : '');}; ?> value="3">Price (Low &gt; High)</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 4 ? 'selected' : '');}; ?> value="4">Price (High &gt; Low)</option>
                        </select>
						</span>
						<h3 class="title"><?php echo $Name; ?></h3>
                    </div>
					</form>
                    <div class="cat-banner">
						<?php echo (is_file('admin/'.DIR_CATEGORY_BANNERS . $Banner) ? '<img src="admin/'.DIR_CATEGORY_BANNERS.$Banner.'">' : '<img src="images/banner.jpg" />'); ?>
                    </div>
                    <p><?php echo $Description; ?></p>
					<br/><br/>
					<?php
					$per_page = 24;
					$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE BestSeller=1 AND Status = 1 ";
							$query2="SELECT ID FROM brands WHERE Status = 1 ORDER BY BrandName";
							$result2 = mysql_query ($query2) or die(mysql_error());
							$i2=1;
							while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
							{
															
								if(isset($_REQUEST['brand'.$i2.''])){
								$query .= ' AND Manufacture ='.$_REQUEST['brand'.$i2.''];
								};
                           	
							$i2++;
							}
							
							
							$query3="SELECT ID FROM p_options_values WHERE Status = 1 AND OptionID = 1 ORDER BY Sort";
							$result3 = mysql_query ($query3) or die(mysql_error());
							$i3=1;
							while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
							{
								
								if(isset($_REQUEST['size'.$i3.''])){
								$query .= ' AND FIND_IN_SET ('.$_REQUEST['size'.$i3.''].',Options)';
								};
                           
							$i3++;
							}
							
							
							$query4="SELECT ID FROM p_options_values WHERE Status = 1 AND OptionID = 2 ORDER BY Sort";
							$result4 = mysql_query ($query4) or die(mysql_error());
							$i4=1;
							while($row4 = mysql_fetch_array($result4,MYSQL_ASSOC))
							{
								
								if(isset($_REQUEST['color'.$i4.''])){
								$query .= ' AND FIND_IN_SET ('.$_REQUEST['color'.$i4.''].',Options)';
								
								};
                           
							$i4++;
							}
							
							
							if(isset($_REQUEST['minprice']) AND isset($_REQUEST['maxprice']))
							{
									$query .= ' AND (Price BETWEEN '.$_REQUEST['minprice'].' AND '.$_REQUEST['maxprice'].')';
							}
							else
							{
								$query .= ' AND (Price BETWEEN 0 AND '.$maxx['MaxPrice'].')';
							}
							
							
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 0)
							{
								$query .= ' ORDER BY ID DESC';	
							}
							if(!isset($_REQUEST['sort']))
							{
								$query .= ' ORDER BY ID DESC';	
							}
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 1)
							{
								$query .= ' ORDER BY ProductName ASC';	
							}
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 2)
							{
								$query .= ' ORDER BY ProductName DESC';	
							}
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 3)
							{
								$query .= ' ORDER BY Price ASC';	
							}
							if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 4)
							{
								$query .= ' ORDER BY Price DESC';	
							}
								
					// echo $query;
					// exit();
					$result = mysql_query($query) or die(mysql_error());
					$total_results = mysql_num_rows($result);
					$total_pages = ceil($total_results / $per_page);//total pages we going to have
					//-------------if page is setcheck------------------//
					if (isset($_REQUEST['page'])) {
						$show_page = $_REQUEST['page'];             //it will telles the current page
						if ($show_page > 0 && $show_page <= $total_pages) {
							$start = ($show_page - 1) * $per_page;
							$end = $start + $per_page;
						} else {
							// error - show first set of results
							$start = 0;              
							$end = $per_page;
						}
					} else {
						// if page isn't set, show first set of results
						$show_page = 1;
						$start = 0;
						$end = $per_page;
					}

					if (isset($_REQUEST['page'])) {
						$currentpage = $_REQUEST['page'];             //it will telles the current page
					} else {
						// if page isn't set, show first set of results
						$currentpage = 1;
					}

					// display pagination
					$page = intval($currentpage);

					$tpages=$total_pages;
					if ($page <= 0)
						$page = 1;
					if($total_results == 0)
					{
					echo '<h1>Product Not Found</h1>';
					}
					for ($i = $start; $i < $end; $i++) {
					if ($i == $total_results) {
						break;
					}
					$Image=explode(',', mysql_result($result, $i, 'Image'));
					$img1 = $Image[0];
					if(mysql_result($result, $i, 'Discount') != 0)
					{
						$persentage = (mysql_result($result, $i, 'Discount') / mysql_result($result, $i, 'Price')) * 100;
						$persentage = 100 - $persentage;
						$persentage = round($persentage);
					}
					$ProductIDTemp = mysql_result($result, $i, 'ID');
					$ProductNameTemp = mysql_result($result, $i, 'ProductName');
					$ProductNameArabicTemp = mysql_result($result, $i, 'ProductNameArabic');
					$Ratings = mysql_result($result, $i, 'Ratings');
					$URLTemp = mysql_result($result, $i, 'URL');
					$PriceTemp = mysql_result($result, $i, 'Price');
					$DiscountTemp = mysql_result($result, $i, 'Discount');
					?>	
									<div class="gallery-info">
										<div class="col-md-4 gallery-grid animated flipInY">
											<a href="<?php echo $URLTemp; ?>"><img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($ProductNameTemp); ?>"/></a>
											<div class="gallery-text simpleCart_shelfItem">
												<a class="name" href="<?php echo dboutput($URLTemp); ?>"><h5><?php echo dboutput($ProductNameTemp); ?></h5></a>
												<p>
													<span class="item_price">
												<?php
												$Discount = $DiscountTemp;
												$Price = $PriceTemp;
												echo ($Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price);
												?>
													</span>
												</p>
			<!--
												<h4 class="sizes">Sizes: <a href="#"> s</a> - <a href="#">m</a> - <a href="#">l</a> - <a href="#">xl</a> </h4>
			-->
												<ul>
													<!-- <li><a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a></li> -->
													<li><a class="item_add" href="add_to_cart.php?id=<?php echo $ProductIDTemp; ?>&name=<?php echo $ProductNameTemp; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
													<li><a href="add_to_wishlist.php?id=<?php echo $ProductIDTemp; ?>&name=<?php echo $ProductNameTemp; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
												</ul>
											</div>
										</div>
									</div>
					<?php
					}
					?>
					
					
					
					
					 <?php
					$string = $_SERVER['REQUEST_URI'];

					$parts = parse_url($string);

					$queryParams = array();
					parse_str($parts['query'], $queryParams);
					unset($queryParams['page']);
					unset($queryParams['tpages']);
					$queryString = http_build_query($queryParams);
					$url = $parts['path'] . '?' . $queryString;
					
					
                    $reload = $url . "&tpages=" . $tpages;
                    echo '<div class="pagination"><sapn>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</span></div>";
                    // display data in table
					?>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//contact-->	
	<!--footer-->
	<?php include("footer.php"); ?>
	<!--//footer-->		
	<!-- the jScrollPane script -->
	<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
			<script type="text/javascript" id="sourcecode">
				$(function()
				{
					$('.scroll-pane').jScrollPane();
				});
			</script>
	<!-- //the jScrollPane script -->
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<!-- the mousewheel plugin -->
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