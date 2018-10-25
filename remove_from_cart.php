<?php
session_start();
 
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$url = isset($_GET['url']) ? $_GET['url'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
 
// remove the item from the array
unset($_SESSION['cart_items'][$id]);
$_SESSION['CartMessage'] = '<section id="msgcart" class="mainnavbar">
		<div class="col-md-12">
		
		<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-check"></i>
			<b>'.$name.'</b> is Successfully Removed from your Cart.
		</div>
		
		</div>
	</section>';
// redirect to product list and tell the user it was added to cart
// header('Location: cart.php?action=removed&id=' . $id . '&name=' . $name);
if($url != "")
{
	header('Location: '.$url);
	exit();
}
else
{
	header('Location: index.php');
	exit();
}
?>