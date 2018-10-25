<?php
include("admin/Common.php");
$id = 0;
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$url = isset($_GET['url']) ? $_GET['url'] : "";
if(!isset($_SESSION['LoginCustomer']) || $_SESSION['LoginCustomer']==false)
{
	$_SESSION["CartMessage"] = '<section id="" class="mainnavbar">
	<div class="col-md-12">
	<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<b>You must <a href="login">login </a>to add items to your wish list.</b>
	</div>
	</div>
</section>';
}
else if($id == 0) 
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
else 
{
    $resource = mysql_query("SELECT * FROM wishlist WHERE ProductID=".$id." AND UserID=".$_SESSION["CustomerID"]) or die(mysql_error());
	if(mysql_num_rows($resource) == 0)
	{
		$_SESSION["CartMessage"] = '<section id="msgcart" class="mainnavbar">
		<div class="col-md-12">
		<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<b>Product is is not listed in your <a href="wishlist" >wishlist</a></b>
		</div>
		</div>
	</section>';
	}
	else
	{
		mysql_query("DELETE FROM wishlist WHERE ProductID='".(int)$id."' AND UserID=".(int)$_SESSION["CustomerID"]."") or die(mysql_error());
		$_SESSION["CartMessage"] = '<section id="msgcart" class="mainnavbar">
		<div class="col-md-12">
		<div class="alert alert-success alert-dismissable">
			<i class="fa fa-check"></i>
			<b>Product Removed to your <a href="wishlist" >wishlist</a></b>
		</div>
		</div>
	</section>';
	}
}

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