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

	if(isset($_REQUEST["ID"]) && ctype_digit(trim($_REQUEST["ID"])))
{
		$CatID=trim($_REQUEST["ID"]);
		$ID=trim($_REQUEST["ID"]);
		$query="SELECT ID,CategoryName,CategoryNameArabic,MetaDescription,Banner,Description,DescriptionArabic,MetaKeywords,URL,Parent FROM categories WHERE ID='" . (int)$ID . "' AND Status=1";
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
		$Name=$row["CategoryName"];
		$NameArabic=$row["CategoryNameArabic"];
		$MetaDes=$row["MetaDescription"];
		$MetaKey=$row["MetaKeywords"];
		$Description=$row["Description"];
		$DescriptionArabic=$row["DescriptionArabic"];
		$URL=$row["URL"];
		$Parent=$row["Parent"];
		$Banner=$row["Banner"];
	}
}
else
{
		redirect("404.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $Name; ?> - <?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=" <?php echo SiteTitle; ?>" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script src="js/jquery.min.js"></script>
<!-- //js -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--//Custom Theme files -->
<!--js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<!--//js-->
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
<!-- banner -->
	<?php include("banner.php"); ?>
<!-- //banner -->

<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li><?php echo get_breadcrumbs_cat($Parent, 'categories', 1, $Parent); ?>
				<li><i>/</i><?php echo $Name; ?></li>
			</ul>
		</div>
	</div>
<!-- //breadcrumbs -->

<!-- dresses -->
	<div class="dresses">
		<div class="container">
			<div class="w3ls_dresses_grids">
				<div class="col-md-4 w3ls_dresses_grid_left">
					<div class="w3ls_dresses_grid_left_grid">
						<h3>Categories</h3>
						<div class="w3ls_dresses_grid_left_grid_sub">

							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            
                            	<?php
									$query6="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = 0 ORDER BY Sort";
									$result6 = mysql_query ($query6) or die(mysql_error());
									$num6 = mysql_num_rows($result6);
									if($num6 != 0)
									{
										echo '<div class="panel panel-default">';
									}
									while($row6 = mysql_fetch_array($result6,MYSQL_ASSOC))
									{
									?>
                                    
                                   <div class="panel-heading" role="tab" id="headingOne">
								  <h4 class="panel-title asd">
							<a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $row6["ID"]; ?>" aria-expanded="true" aria-controls="<?php echo $row6["ID"]; ?>">
                                    	<?php
									$query7="SELECT ID,CategoryName,CategoryNameArabic FROM categories WHERE Status = 1 AND Parent = ".$row6['ID']." ORDER BY Sort";
									$result7 = mysql_query ($query7) or die(mysql_error()); 
									$num7 = mysql_num_rows($result7);
									if($num7 != 0)
									{
				echo '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i>'.$row6['CategoryName'].' 
				';
			
		echo'<div id="'.$row6["ID"].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								   <div class="panel-body panel_text">
									<ul>';
		     while($row7 = mysql_fetch_array($result7,MYSQL_ASSOC))
										{
										?>
							
										<li><a href="category.php?ID=<?php echo $row7['ID']; ?>" <?php echo ($row7['ID'] == $ID ? 'style="font-weight:bold;"' : ''); ?>><?php echo $row7['CategoryName']; ?></li></a>
							
        <?php 
									}
									echo'
									
								</ul>
								  </div>
								</div>
                                		';
									echo ' </a> </h4></div>';
									}
		?>
        </a>
        
        <?php 
    }
	echo '</div>';
									?>
								
                                   
            </div>
			
         
						</div>
					</div>
                    
                     <form id="frmsubmit" action="<?php echo $_SERVER['PHP_SELF']; ?>?ID=<?php echo $ID; ?>" method="get">
					<input type="hidden" name="ID" value="<?php echo $ID; ?>" />
					<div class="w3ls_dresses_grid_left_grid">
						<h3>Filter By Price</h3>
						<div class="w3ls_dresses_grid_left_grid_sub">
							<div class="ecommerce_color">
                          <p>         
							 <input type="text" id="price" 
								style="border:0; color:#000; font-weight:bold; background:none;">
							<input type="hidden" name="minprice" id="minprice" value="0">
							<input type="hidden" name="maxprice" id="maxprice" value="<?php echo $maxx['MaxPrice']; ?>">
						  </p>
						  <div id="slider-3"></div>
						</div>
					</div>
                    </div>
					<div class="w3ls_dresses_grid_left_grid">
						<h3>Color</h3>
						<div class="w3ls_dresses_grid_left_grid_sub">
							<div class="ecommerce_color">
								<ul>
                                  <?php
							$query="SELECT ID,ValueName FROM p_options_values WHERE Status = 1 AND OptionID = 2 ORDER BY Sort";
							$result = mysql_query ($query) or die(mysql_error());
							$num = mysql_num_rows($result);
							if($num == 0)
							{ ?>
							<label>Not Available</label>
							<?php
							}
							$i=1;
							while($row = mysql_fetch_array($result,MYSQL_ASSOC))
							{
							?>
                       
                             <li><label style="color:#FF9B05; font-weight:150;" <?php if(isset($_REQUEST['color'.$i.''])){echo ($_REQUEST['color'.$i.''] == $row['ID'] ? 'style="font-weight:bold;"' : '');}; ?> for="fcolor-<?php echo $i; ?>" class="checkbox"><input id="fcolor-<?php echo $i; ?>" <?php if(isset($_REQUEST['color'.$i.''])){echo ($_REQUEST['color'.$i.''] == $row['ID'] ? 'checked' : '');}; ?> type="checkbox" name="color<?php echo $i; ?>" value="<?php echo $row['ID']; ?>"><i></i><?php echo $row['ValueName']; ?></label>
                           </li>
                           						
                           	<?php
							$i++;
							}
							?>
                           		
								
								</ul>
							</div>
						</div>
					</div>
					<div class="w3ls_dresses_grid_left_grid">
						<h3>Size</h3>
						<div class="w3ls_dresses_grid_left_grid_sub">
							<div class="ecommerce_color ecommerce_size">
								<ul>
                                 <?php
							$query="SELECT ID,ValueName FROM p_options_values WHERE Status = 1 AND OptionID = 1 ORDER BY Sort";
							$result = mysql_query ($query) or die(mysql_error());
							$num = mysql_num_rows($result);
							if($num == 0)
							{ ?>
							<label>Not Available</label>
							<?php
							}
							$i=1;
							while($row = mysql_fetch_array($result,MYSQL_ASSOC))
							{
							?>
					<label style="color:#212121; font-size:1em; font-weight:100;" <?php if(isset($_REQUEST['size'.$i.''])){echo ($_REQUEST['size'.$i.''] == $row['ID'] ? 'style="font-weight:bold;"' : '');}; ?> for="fsize-<?php echo $i; ?>" class="checkbox"><input id="fsize-<?php echo $i; ?>" <?php if(isset($_REQUEST['size'.$i.''])){echo ($_REQUEST['size'.$i.''] == $row['ID'] ? 'checked' : '');}; ?> type="checkbox" name="size<?php echo $i; ?>" value="<?php echo $row['ID']; ?>"><i></i><?php echo $row['ValueName']; ?></label>
                           	<?php
							$i++;
							}
							?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 w3ls_dresses_grid_right">
					<div class="col-md-6 w3ls_dresses_grid_right_left">
						<div class="w3ls_dresses_grid_right_grid1">
							<img src="images/72.jpg" alt=" " class="img-responsive" />
							<div class="w3ls_dresses_grid_right_grid1_pos1">
								<h3>Cosmetics <span>Up To</span> 10% Discount</h3>
							</div>
						</div>
					</div>
					<div class="col-md-6 w3ls_dresses_grid_right_left">
						<div class="w3ls_dresses_grid_right_grid1">
							<img src="images/73.jpg" alt=" " class="img-responsive" />
							<div class="w3ls_dresses_grid_right_grid1_pos">
								<h3>Cosmetics <span>Makeup</span> Brush</h3>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>

					<div class="w3ls_dresses_grid_right_grid2">
						<div class="w3ls_dresses_grid_right_grid2_left">
							<h3><?php echo $Name; ?></h3>
						</div>
						<div class="w3ls_dresses_grid_right_grid2_right">
                        
                            <select id="input-sort" id="sorting" name="sort" onchange='this.form.submit()' class="select_item">
                            <option value="0" selected="selected">Default</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 1 ? 'selected' : '');}; ?> value="1">Name (A - Z)</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 2 ? 'selected' : '');}; ?> value="2">Name (Z - A)</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 3 ? 'selected' : '');}; ?> value="3">Price (Low &gt; High)</option>
                            <option <?php if(isset($_REQUEST['sort'])){echo ($_REQUEST['sort'] == 4 ? 'selected' : '');}; ?> value="4">Price (High &gt; Low)</option>
                        </select>
                        
							</form>
						</div>
						<div class="clearfix"> </div>
					</div>
                    
                    <?php
					$per_page = 24;
					$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL,Ratings FROM products WHERE FIND_IN_SET (".$ID.",Categories) AND Status = 1 ";
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
					echo '<h1>Product Not Found</h1><br/><a href="home" class="btn btn-default">Continue Shopping</a>';
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
						<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_dresses">
							<div class="agile_ecommerce_tab_left dresses_grid">
								<div class="hs-wrapper hs-wrapper2">
								<img src="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($ProductNameTemp); ?>"/>
									
									<div class="w3_hs_bottom w3_hs_bottom_sub1">
										<ul>
											<li>
										<a href="<?php echo dboutput($URLTemp); ?>" ><span class="glyphicon glyphicon-send"  aria-hidden="true"></span></a>
									</li>
										</ul>
									</div>
								</div>
								<h5><a href="<?php echo dboutput($URLTemp); ?>"><?php echo $ProductNameTemp; ?></a></h5>
								<div class="simpleCart_shelfItem">
                                	<?php
												$Discount = $DiscountTemp;
												$Price = $PriceTemp;
												/*echo $Discount != 0 ? CURRENCY_SYMBOL.$Discount.'<br/><small style="color: #000"><s>'.CURRENCY_SYMBOL.$Price.'</s></small>' : CURRENCY_SYMBOL.$Price;
*/
echo $Price !=0 ? '<p><span>'.CURRENCY_SYMBOL.$Price.'</span>'.'<i class="item_price">'.CURRENCY_SYMBOL.$Discount.'</i></p>' : CURRENCY_SYMBOL.$Price;			
									
                                    ?>
									<p><a class="item_add" href="add_to_cart.php?id=<?php echo $ProductIDTemp; ?>&name=<?php echo $ProductNameTemp; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>">Add to cart</a></p>
								</div>							
							</div>
				
                        <div class="clearfix"> </div>
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
                    echo '
					<div class="col-md-6">
					<ul class="pagination pagination-sm">';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
                    // display data in table
					?>
					
					</div>
				<div class="clearfix"> </div>
			</div>
            </div>
		
	

	<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	 
<!-- //dresses -->
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
    
    <?php include "footer.php"; ?>

</body>
</html>