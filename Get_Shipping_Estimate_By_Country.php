<?php
session_start();

// get the product id
$CountryCode = isset($_GET['CountryCode']) ? $_GET['CountryCode'] : "";
 
// remove the item from the array
$_SESSION['Country']=$CountryCode;
 
// redirect to product list and tell the user it was added to cart
// header('Location: cart.php?action=removed&id=' . $id . '&name=' . $name);

	header('Location: cart.php');
	exit();

?>