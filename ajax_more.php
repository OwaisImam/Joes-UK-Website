<?php
include('admin/Common.php');
if(isset($_POST["ID"]) && !empty($_POST["ID"])){

//include database configuration file

//count all rows except already displayed
$queryAll = mysql_query("SELECT COUNT(*) as num_rows FROM products WHERE ID < ".$_POST['ID']." ORDER BY ID DESC");
$row = mysql_fetch_assoc($queryAll);
$allRows = $row['num_rows'];

$showLimit = 20;

//get rows query
$query = mysql_query("SELECT ID,ProductName,ProductNameArabic,Image,Price,Discount,URL FROM products WHERE Status=1 AND ID < ".$_POST['ID']." ORDER BY ID DESC LIMIT ".$showLimit);

//number of rows
$rowCount = mysql_num_rows($query);

if($rowCount > 0){ 
    while($row = mysql_fetch_assoc($query)){ 
        $tutorial_ID = $row["ID"]; ?>
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
				-->
													<ul>
														<!-- <li><a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a></li> -->
														<li><a class="item_add" href="add_to_cart.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
														<li><a href="add_to_wishlist.php?id=<?php echo $row["ID"]; ?>&name=<?php echo $row["ProductName"]; ?>&quantity=1&upsell=2&options=0&url=<?php echo $_SERVER['REQUEST_URI']; ?>"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
													</ul>
												</div>
											</div>
										</div>
<?php } ?>
<?php if($allRows > $showLimit){ ?>
								</div>
								<div class="row">
									<div class="col-md-12 show_more_main" ID="show_more_main<?php echo $tutorial_id; ?>">
										<span ID="<?php echo $tutorial_id; ?>" class="show_more" title="Load more posts">Show more</span>
										<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
									</div>
<?php } ?>  
<?php 
    } 
}
?>