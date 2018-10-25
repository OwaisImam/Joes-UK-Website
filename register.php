
<?php
if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true)
	redirect("index.php");
$msg="";
$Status=1;
$Gender=0;
$Subscribe=1;
$ID=0;
$FirstName="";
$LastName="";
$Address1="";
$Address2="";
$Region="";
$PostCode="";
$Phone="";
$Country="PAK";
$City="";
$Email="";
$Password="";
$Password2="";
$IP = '';
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$IP = get_client_ip();
if(isset($_POST["action"]) && $_POST["action"] == "submit_form2")
{			
	if(isset($_POST["Subscribe"]) && ((int)$_POST["Subscribe"] == 0 || (int)$_POST["Subscribe"] == 1))
		$Subscribe=trim($_POST["Subscribe"]);	
	if(isset($_POST["Gender"]) && ((int)$_POST["Gender"] == 1 || (int)$_POST["Gender"] == 2))
		$Gender=trim($_POST["Gender"]);	
	if(isset($_POST["FirstName"]))
		$FirstName=trim($_POST["FirstName"]);
	if(isset($_POST["LastName"]))
		$LastName=trim($_POST["LastName"]);
	if(isset($_POST["Password"]))
		$Password=trim($_POST["Password"]);
	if(isset($_POST["Password2"]))
		$Password2=trim($_POST["Password2"]);
	if(isset($_POST["City"]))
		$City=trim($_POST["City"]);
	if(isset($_POST["Phone"]))
		$Phone=trim($_POST["Phone"]);
	if(isset($_POST["PostCode"]))
		$PostCode=trim($_POST["PostCode"]);
	if(isset($_POST["Region"]))
		$Region=trim($_POST["Region"]);
	if(isset($_POST["Address1"]))
		$Address1=trim($_POST["Address1"]);
	if(isset($_POST["Email"]))
		$Email=trim($_POST["Email"]);
	if(isset($_POST["Country"]))
		$Country=trim($_POST["Country"]);	

		if($Gender == 0)
		{
			$msg='<p style="color:red">Please Select Gender</p>';
		}
		else if($FirstName == "")
		{
			$msg='<p style="color:red">Please Enter First Name</p>';
		}		
		else if($LastName == "")
		{
			$msg='<p style="color:red">Please Enter Last Name</p>';
		}
		else if($Email == "")
		{
			$msg='<p style="color:red">Please Enter EmailAddresss</p>';
		}
		else if(!validEmailAddress($Email))
		{
			$msg='<p style="color:red">EmailAddress is not Valid!</p>';
		}
		else if($Phone == "")
		{
			$msg='<p style="color:red">Please Enter Phone Number</p>';
		}	
		else if($Address1 == "")
		{
			$msg='<p style="color:red">Please Enter Address</p>';
		}	
		else if($City == "")
		{
			$msg='<p style="color:red">Please Enter City</p>';
		}	
		else if($Country == "XXX")
		{
			$msg='<p style="color:red">Please Select Country</p>';
		}	
		else if($Region == "")
		{
			$msg='<p style="color:red">Please Enter Region / State</p>';
		}	
		else if($Password == "")
		{
			$msg='<p style="color:red">Please Enter Password</p>';
		}	
		else if($Password2 == "")
		{
			$msg='<p style="color:red">Please Confirm Password</p>';
		}	
		else if($Password != $Password2)
		{
			$msg='<p style="color:red">Password not Matching</p>';
		}	

		


	if($msg=="")
	{

		$query="INSERT INTO website_users SET DateAdded=NOW(),
				Status='".(int)$Status . "',
				Gender='".(int)$Gender . "',
				Subscribe='".(int)$Subscribe . "',
				FirstName = '" . dbinput($FirstName) . "',
				LastName = '" . dbinput($LastName) . "',
				IP = '" . dbinput($IP) . "',
				Region = '" . dbinput($Region) . "',
				Country = '" . dbinput($Country) . "',
				PostCode = '" . dbinput($PostCode) . "',
				City = '" . dbinput($City) . "',
				Phone = '" . dbinput($Phone) . "',
				Email = '" . dbinput($Email) . "',
				Password = '" . dbinput($Password) . "',
				Address = '" . dbinput($Address1) . " '";
		mysql_query($query) or die ('Could not add user because: ' . mysql_error());
		// echo $query;
		//$ID = mysql_insert_id();
		if($Subscribe == 1)
		{	
				$Email = strtolower($Email);
				$query="SELECT ID FROM newsletter_subscribers WHERE Email='".dbinput($Email) . "'";
				$r=mysql_query($query) or die (mysql_error());
				$n=mysql_num_rows($r);
				if($n==0)
				{
					$query="INSERT INTO newsletter_subscribers SET Email='".dbinput($Email) . "', DateAdded=NOW()";
					mysql_query($query) or die (mysql_error());
				}
		}
		$subject = SiteTitle." - Account created successfully";
		$to = $_SESSION["Email"];
		$from = SiteTitle." <donot-reply@".Domain.">";
		$message = "Dear ".$Name."! \nYour account has been successfully created. <a href='http://".Domain."' ><b>Click here</b></a> to login in your account.<br/><br/>Regards,<br/><b>Team ".SiteTitle."</b>";
		$headers = "From: ".$from."\r\n";
		$headers .= "Return-Path: <".$from."\r\n";
		$headers .= "X-Mailer: PHP5\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
		$mail = @mail($to,$subject,$message,$headers);
		$_SESSION["msg"]='<p style="color:darkgreen">You have registred Successfully. Please <a href="login.php">login now</a></p>';		
		
		redirect("index.php");	
	}
		

}
?>