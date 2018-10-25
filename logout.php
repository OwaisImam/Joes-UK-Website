<?php
	session_start();
	$_SESSION["LoginCustomer"]=false;
	$_SESSION["CustomerID"]='';
	$_SESSION["CustomerFullName"]='';
	$_SESSION["Country"]='';
	$_SESSION["Shipping"]='';
	unset($_SESSION["LoginCustomer"]);
	unset($_SESSION["CustomerID"]);
	unset($_SESSION["CustomerFullName"]);
	unset($_SESSION["Country"]);
	unset($_SESSION["Shipping"]);
	header("Location: index.php");
?>