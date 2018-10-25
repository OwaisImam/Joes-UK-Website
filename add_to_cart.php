<?php
session_start();
 
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = 1;
$upsell = isset($_GET['upsell']) ? $_GET['upsell'] : 0;
$url = isset($_GET['url']) ? $_GET['url'] : "";
if(isset($_GET['options']) && $_GET['options'] != 0)
{
$options = isset($_GET['options']) ? implode(',',$_GET['options']) : "";
}else
$options = 0;


if($id == 0 || $quantity == 0 || $upsell == 0) 
{
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
}
/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
if(!isset($_SESSION['cart_items'])){
    $_SESSION['cart_items'] = array();
}
 
// check if the item is in the array, if it is, do not add
if(array_key_exists($id, $_SESSION['cart_items'])){
    // redirect to product list and tell the user it was added to cart
    // header('Location: products.php?action=exists&id' . $id . '&name=' . $name);
	unset($_SESSION['cart_items'][$id]); 
	$_SESSION['cart_items'][$id]=$id.'-'.$name.'-'.$quantity.'-'.$upsell.'-'.$options;
	$_SESSION['CartMessage'] = '<section id="msgcart" class="mainnavbar">
	<div class="col-md-12">
	
	<div class="alert alert-success alert-dismissable">
		<i class="fa fa-check"></i>
		<b>'.$name.'</b> is Successfully Added to your Cart.
	</div>
	
	</div>
</section>';
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
}
 
// else, add the item to the array
else{
    $_SESSION['cart_items'][$id]=$id.'-'.$name.'-'.$quantity.'-'.$upsell.'-'.$options;
	$_SESSION['CartMessage'] = '<section id="msgcart" class="mainnavbar">
		<div class="col-md-12">
		
		<div class="alert alert-success alert-dismissable">
			<i class="fa fa-check"></i>
			<b>'.$name.'</b> is Successfully Added to your Cart.
		</div>
		
		</div>
	</section>';
    // redirect to product list and tell the user it was added to cart
    //header('Location: products.php?action=added&id' . $id . '&name=' . $name);
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
}
?>