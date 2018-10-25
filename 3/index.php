<?php include("admin/Common.php"); ?>
<?php $CatID = 0; ?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo SiteTitle; ?></title>


<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="favicon/manifest.json">
<link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

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
<meta property="og:image"         content="<?php echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>admin/<?php echo DIR_LOGOS.$_SETTINGS_Header_LOGO; ?>" />
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
<link rel='shortcut icon' href='admin/<?php echo DIR_LOGOS.$_SETTINGS_Header_LOGO; ?>' type='image/x-icon' >
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
<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4AVFat8UoCEv0bDbw2FTq07N0soX94C2";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->


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

<?php
		$querysss="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND BestSeller = 1 ORDER BY ID DESC Limit 12";
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
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND BestSeller = 1 ORDER BY ID DESC Limit 12";
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
								<div class="gallery-info item-container">
							<div class="col-md-3 gallery-grid rollover-item ">
								<a href="<?php echo dboutput($row['URL']); ?>"><img src="" lsrc="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
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

<?php
		$querysss="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 ORDER BY ID DESC Limit 12";
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
					<style>
.item.container {
    display:inline-block;

    
}

.rollover-item {
    position:relative;
    overflow:hidden;
}

.description{
    position:absolute;
    left:0;
    display:block;
    bottom:100%;
    width:100%; /* as image */
    height:1em; /* as image */
    text-align:center;
    text-decoration:none;
    color:black;
    font-weight:bold;
/*
    background:rgba(0, 0, 0, 0.7); */
    transition:bottom 0.5s ease;
}

.rollover-item:hover .description {
    bottom:0px;
}
.btn.btn-order {
	font-weight: bold;
	border: 1px solid #cf142b;
	border-radius: 0px;
}
.btn.btn-order:hover {
	background-color: #cf142b;
}
</style>
					<div id="carousel-0" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
           <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 ORDER BY RAND() Limit 12";
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
							<div class="item <?php echo ($cou == 0 ? 'active' : ''); ?>">
				<?php
				}
				?>
								<div class="gallery-info item-container">
							<div class="col-md-3 gallery-grid rollover-item rollover-item">
								<a href="<?php echo dboutput($row['URL']); ?>"><img src="" lsrc="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
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
<!--
									<div class="description">
									<div style="position: absolute; right: 0px; left: 0px; bottom: 20px;">
									<button class="btn btn-lg btn-default btn-order" data-toggle="modal" data-target="#quickorders<?php echo $row["ID"]; ?>" href="#quickorders<?php echo $row["ID"]; ?>" style="border: 1px solid #000; color: #000; ">ORDER NOW</button>
									</div>
									</div>
-->
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
mysql_data_seek( $res, 0 );
//				while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				while(false)
				{
					$Image=explode(',', $row["Image"]);
					$img1 = $Image[0];
					if($row["Discount"] != 0)
					{
						$persentage = ($row["Discount"] / $row["Price"]) * 100;
						$persentage = 100 - $persentage;
						$persentage = round($persentage);
					}
?>
									<div id="quickorders<?php echo $row["ID"]; ?>" class="modal fade" role="dialog">
									  <div class="modal-dialog">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Order Form</h4>
										  </div>
										  <div class="modal-body">
				<form action="OrderSuccess.php" method="POST" >
					<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
					<input type="hidden" name="ProductName" value="<?php echo $row["ProductName"]; ?>" />
					<input type="hidden" name="ProductID" value="<?php echo $row["ID"]; ?>" />
					<div class="form-group">
						<label for="Quantity" class="cols-sm-2 control-label">Quantity</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-cube fa" aria-hidden="true"></i></span>
								<input type="number" class="form-control" name="Quantity" id="Quantity"  placeholder="Enter quantity" value="1" min="1" />
							</div>
						</div>
					</div>
					<?php
					$quickquery = "SELECT DISTINCT o.ID,o.OptionName FROM product_options po LEFT JOIN p_options o ON po.OptionID = o.ID where o.Status = 1 AND po.ProductID=".$row["ID"];
					$quickres = mysql_query($quickquery);
					while($quickrow = mysql_fetch_array($quickres))
					{
					?>
					<div class="form-group">
						<label for="Quantity" class="cols-sm-2 control-label">Select  <?php echo $quickrow['OptionName']; ?></label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-cube fa" aria-hidden="true"></i></span>
								<select class="form-control" id="options" name="options[]">
								<?php
								$quickquery2 = "SELECT DISTINCT po.ID,ov.ValueName,po.Increment FROM product_options po LEFT JOIN p_options_values ov ON po.ValueID = ov.ID where ov.Status = 1 AND po.ProductID=".$row["ID"]." AND po.OptionID =".$quickrow['ID']." ORDER BY ov.Sort ASC";
								$res2 = mysql_query($quickquery2);
								while($quickrow2 = mysql_fetch_array($res2))
								{
								if($quickrow2['Increment'] > 0)
								{
									
									$quickrow2['Increment'];
										$incCur = CURRENCY_SYMBOL.$quickrow2['Increment'];
								}
								?>
								<option value="<?php echo $quickrow2['ID']; ?>"><?php echo $quickrow2['ValueName'] . ($quickrow2['Increment'] > 0 ? ' (+'.$incCur.')' : '' ); ?></option>
								<?php
								} 
								?>
								</select> 	
							</div>
						</div>
					</div>
					<?php
					} 
					?>
					<div class="form-group">
						<label for="Name" class="cols-sm-2 control-label">Your Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="Name" id="Name"  placeholder="Enter your Name" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="Phone" class="cols-sm-2 control-label">Your Mobile Number</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="Phone" id="Phone"  placeholder="Enter your Mobile Number" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="Address" class="cols-sm-2 control-label">Address</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-home fa" aria-hidden="true"></i></span>
								<textarea class="form-control custom-control" rows="3" style="resize:none" name="Address" id="Address" placeholder="Enter your address" required></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="City" class="cols-sm-2 control-label">City</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="City" id="City"  placeholder="Enter your City" required/>
							</div>
						</div>
					</div>
					<div class="form-group ">
						<input type="submit" style="background: #cf142b" class="btn btn-primary btn-lg btn-block login-button" name="QuickOrder" value="Order Now"/>
					</div>
				</form>
										  </div>
										  <div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										  </div>
										</div>

									  </div>
									</div>
<?php
				}
		}
?>
<?php 
	$query="SELECT ID,Banner,Sort,Status,CategoryName,Parent,DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated FROM categories WHERE ShowOnHome = 1 AND Status = 1 ";
	$query .= " ORDER BY Sort";
	$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
	while($rows = mysql_fetch_array($result))
	{
		$querysss="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND FIND_IN_SET (".$rows["ID"].",Categories)  ORDER BY ID DESC Limit 12";
		$ressss = mysql_query($querysss) or die(mysql_error());
		if(mysql_num_rows($ressss) > 0)
		{
?>
           <?php 
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND FIND_IN_SET (".$rows["ID"].",Categories)  ORDER BY ID DESC Limit 12";
				$res = mysql_query($query) or die(mysql_error());
				$quickcou=0;
				// while($row = mysql_fetch_array($res,MYSQL_ASSOC))
				while(false)
				{
				$Image=explode(',', $row["Image"]);
				$img1 = $Image[0];
				if($row["Discount"] != 0)
				{
					$persentage = ($row["Discount"] / $row["Price"]) * 100;
					$persentage = 100 - $persentage;
					$persentage = round($persentage);
				}
				if($quickcou%4==0)
				{
				?>
							<div class="item <?php echo ($quickcou == 0 ? 'active' : ''); ?>">
				<?php
				}
				?>
									<div id="quickorder<?php echo $row["ID"]; ?>" class="modal fade" role="dialog">
									  <div class="modal-dialog">
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Order Form</h4>
										  </div>
										  <div class="modal-body">
				<form action="OrderSuccess.php" method="POST" >
					<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
					<input type="hidden" name="ProductName" value="<?php echo $row["ProductName"]; ?>" />
					<input type="hidden" name="ProductID" value="<?php echo $row["ID"]; ?>" />
					<div class="form-group">
						<label for="Quantity" class="cols-sm-2 control-label">Quantity</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-cube fa" aria-hidden="true"></i></span>
								<input type="number" class="form-control" name="Quantity" id="Quantity"  placeholder="Enter quantity" value="1" min="1" />
							</div>
						</div>
					</div>
					<?php
					$quickquery = "SELECT DISTINCT o.ID,o.OptionName FROM product_options po LEFT JOIN p_options o ON po.OptionID = o.ID where o.Status = 1 AND po.ProductID=".$row["ID"];
					$quickres = mysql_query($quickquery);
					while($quickrow = mysql_fetch_array($quickres))
					{
					?>
					<div class="form-group">
						<label for="Quantity" class="cols-sm-2 control-label">Select  <?php echo $quickrow['OptionName']; ?></label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-cube fa" aria-hidden="true"></i></span>
								<select class="form-control" id="options" name="options[]">
								<?php
								$quickquery2 = "SELECT DISTINCT po.ID,ov.ValueName,po.Increment FROM product_options po LEFT JOIN p_options_values ov ON po.ValueID = ov.ID where ov.Status = 1 AND po.ProductID=".$row["ID"]." AND po.OptionID =".$quickrow['ID']." ORDER BY ov.Sort ASC";
								$res2 = mysql_query($quickquery2);
								while($quickrow2 = mysql_fetch_array($res2))
								{
								if($quickrow2['Increment'] > 0)
								{
									
									$quickrow2['Increment'];
										$incCur = CURRENCY_SYMBOL.$quickrow2['Increment'];
								}
								?>
								<option value="<?php echo $quickrow2['ID']; ?>"><?php echo $quickrow2['ValueName'] . ($quickrow2['Increment'] > 0 ? ' (+'.$incCur.')' : '' ); ?></option>
								<?php
								} 
								?>
								</select> 	
							</div>
						</div>
					</div>
					<?php
					} 
					?>
					<div class="form-group">
						<label for="Name" class="cols-sm-2 control-label">Your Name</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="Name" id="Name"  placeholder="Enter your Name" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="Phone" class="cols-sm-2 control-label">Your Mobile Number</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="Phone" id="Phone"  placeholder="Enter your Mobile Number" required/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="Address" class="cols-sm-2 control-label">Address</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-home fa" aria-hidden="true"></i></span>
								<textarea class="form-control custom-control" rows="3" style="resize:none" name="Address" id="Address" placeholder="Enter your address" required></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="City" class="cols-sm-2 control-label">City</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></span>
								<input type="text" class="form-control" name="City" id="City"  placeholder="Enter your City" required/>
							</div>
						</div>
					</div>
					<div class="form-group ">
						<input type="submit" style="background: #cf142b" class="btn btn-primary btn-lg btn-block login-button" name="QuickOrder" value="Order Now"/>
					</div>
				</form>
										  </div>
										  <div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										  </div>
										</div>

									  </div>
									</div>
<?php
				}
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
				$query="SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status = 1 AND FIND_IN_SET (".$rows["ID"].",Categories)  ORDER BY ID DESC Limit 12";
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
								<div class="gallery-info item-container">
							<div class="col-md-3 gallery-grid rollover-item ">
								<a href="<?php echo dboutput($row['URL']); ?>"><img src="" lsrc="ImageResizer.php?w=300&img=<?php echo 'admin/'.DIR_PRODUCTS_IMAGES.$img1 ?>" class="img-responsive" alt="<?php echo dboutput($row['ProductName']); ?>"/></a>
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
<!--
									<div class="description">
									<div style="position: absolute; right: 0px; left: 0px; bottom: 20px;">
									<button class="btn btn-lg btn-default btn-order"  href="#quickorder<?php echo $row["ID"]; ?>" style="border: 1px solid #000; color: #000; ">ORDER NOW</button>
									</div>
									</div>
-->
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
$(window).on('load', function() {
    $.each(document.images, function(){
               var this_image = this;
               var src = $(this_image).attr('src') || '' ;
               if(!src.length > 0){
                   //this_image.src = options.loading; // show loading
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
