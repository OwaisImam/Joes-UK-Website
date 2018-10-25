<?php
if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true)
	redirect("index.php");
	$email="";
	$password="";
	$msg1 = "";
	$msg2 = "";
	$msg3 = "";
	if(isset($_POST["action"]) && $_POST["action"] == "submit_form")
	{
		if(isset($_POST["email"]))
			$email=trim($_POST["email"]);
		if(isset($_POST["password"]))
			$password=trim($_POST["password"]);
			
		if ($email=="")
			$msg1 = '<p style="color:red">Please Enter EmailAddress.</p>';
		if ($password=="")
			$msg2 = '<p style="color:red">Please Enter Password.</p>';
			
		if($msg1=='' && $msg2=='')
		{	
			$query="SELECT ID,FirstName,LastName,Password,Country FROM website_users WHERE Status = 1 AND Email='".dbinput($email)."'";
			$result = mysql_query ($query) or die(mysql_error()); 
			$num = mysql_num_rows($result);
			
			if($num==0)
			{
				$_SESSION["LoginCustomer"]=false;
				$_SESSION["CustomerID"]='';
				$_SESSION["CustomerFullName"]='';
				$_SESSION["Country"]='';
				$_SESSION["Shipping"]='';
				$msg3 = '<p style="color:red">Invalid Email/Password.</p>';	
			}
			else
			{
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
				if(dboutput($row["Password"]) == $password)
				{
					$_SESSION["LoginCustomer"]=true;
					$_SESSION["CustomerID"]=dboutput($row["ID"]);
					$_SESSION["CustomerFullName"]=dboutput($row["FirstName"]) .' '. dboutput($row["LastName"]);
					$_SESSION["Country"]=dboutput($row["Country"]);
					
					$query2="SELECT Percentage FROM shipping_rates WHERE CountryCode='".$row["Country"]."'";
					$result2 = mysql_query ($query2) or die(mysql_error()); 
					$num2 = mysql_num_rows($result2);
					if($num2 > 0)
					{
						$row2 = mysql_fetch_array($result2,MYSQL_ASSOC);
						$_SESSION["Shipping"]=dboutput($row2["Percentage"]);
					}
					else
					{
						$query3="SELECT Percentage FROM other_countries_shipping WHERE ID=1";
						$result3 = mysql_query ($query3) or die(mysql_error()); 
						$num3 = mysql_num_rows($result3);
						if($num3 == 1)
						{
							$row3 = mysql_fetch_array($result3,MYSQL_ASSOC);
							$_SESSION["Shipping"]=dboutput($row3["Percentage"]);
						}
					}
					
					redirect("index.php");
				}
				else
				{
					$_SESSION["LoginCustomer"]=false;
					$_SESSION["CustomerID"]='';
					$_SESSION["CustomerFullName"]='';
					$_SESSION["Country"]='';
					$_SESSION["Shipping"]='';
					$msg3 = '<p style="color:red">Invalid Email/Password.</p>';
				}
			}
		}
	}
?>
