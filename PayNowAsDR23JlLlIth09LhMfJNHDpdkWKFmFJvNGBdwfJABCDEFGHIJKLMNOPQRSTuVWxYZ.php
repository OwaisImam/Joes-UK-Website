<?php
include("admin/Common.php");
if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true)
{
	if(!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items']))
	{
	header('Location:404.php');
	exit();
	}
	else
	{
	$_SESSION['PaymentNow']=true;
	$_SESSION['paymentByThrough']='Paypal';
	$query = "UPDATE orders SET PaymentMethod = 'Paypal' WHERE ID= '".(int)$_SESSION["OrderID"]."' ";
	mysql_query($query);
	header('Location:success');
	exit();
	}
}
header('Location:404.php');
exit();
?>