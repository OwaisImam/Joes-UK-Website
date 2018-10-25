<?php include("admin/Common.php"); ?>
<?php $CatID=99999; 
if(isset($_POST["callbackmodal"]) && $_POST["callbackmodal"] == "Request Call Back")
{
	$CallbackName="";
	$CallbackPhone="";
	$CallbackEmail="";
	$CallbackMessage="";
	$msg="";
	
	if(isset($_POST["CallbackName"]))
		$CallbackName=trim($_POST["CallbackName"]);

	if(isset($_POST["CallbackPhone"]))
		$CallbackPhone=trim($_POST["CallbackPhone"]);
	
	if(isset($_POST["CallbackEmail"]))
	$CallbackEmail=trim($_POST["CallbackEmail"]);

	if(isset($_POST["CallbackMessage"]))
		$CallbackMessage=trim($_POST["CallbackMessage"]);

		if($CallbackName == "")
		{
			$msg="Please enter your name";
			$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
				'.$msg.'
			</div></div></section>';
		}

		else if($CallbackMessage == "")
		{
			$msg="Please enter your message";
			$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
				'.$msg.'
			</div></div></section>';
		}
		
		else if($msg == "")
		{
			$query="INSERT INTO messages (Name, Email, Telephone, Message, DateAdded) VALUES ('".addslashes($CallbackName)."', '".addslashes($CallbackEmail)."', '".addslashes($CallbackPhone)."', '".addslashes($CallbackMessage)."', NOW())";
			$a=mysql_query($query) or die(mysql_error());
			if($a)
			{
				$subject = "A callback request received on ".SiteTitle;				
				$to = "Info at ".Domain." <info@".Domain.">";
				$from = "donot-reply@".Domain." <donot-reply@".Domain.">";
				$message = "Following are the details of the message:<br/><br/>";
				$message.= "Name: ".$CallbackName." <br/>Phone No.: ".$CallbackPhone."<br/>Email.: ".$CallbackEmail."<br/>Message: ".$CallbackMessage."<br/>";
				$headers = "From: ".$from."\r\n";
				$headers .= "Return-Path: <".$from."\r\n";
				$headers .= "X-Mailer: PHP5\r\n";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
				$mail = @mail($to,$subject,$message,$headers);
				$msg = ' Thank you for requesting call back. We\'ll call you back very soon.';
				$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-success alert-dismissable">
					<i class="fa fa-check"></i>
					'.$msg.'
				</div></div></section>';
			}
			else
			{
				$msg = 'An error occured, please try again later!';
				$_SESSION['contmsg'] = '<section id="" class="mainnavbar">
				<div class="col-md-12"><div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					'.$msg.'
				</div></div></section>';
			}
		}
}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Contact Us - <?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Shoppe Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel='shortcut icon' href='images/icon.png' type='image/x-icon' ><link rel='shortcut icon' href='images/icon.png' type='image/x-icon' >
<!--Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--//Custom Theme files -->
<!--js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--//js-->
<!--cart-->
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
 new WOW().init();
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
</head>
<body>
	<!--header-->
	<?php include("header.php"); ?>
	<!--//header-->
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Contact Us</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--contact-->
	<div class="contact">
		<div class="container">
			<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
				<h3 class="title">How To <span> Find Us</span></h3>
				<p>Feel free to contact us anytime anywhere </p>
				<?php if(isset($_SESSION['contmsg'])) { echo $_SESSION['contmsg']; $_SESSION['contmsg'] = ""; } ?>
			</div>
		</div>	
	</div>
	<div class="address"><!--address-->
		<div class="container">
			<div class="address-row">
				<div class="col-md-6 address-left wow fadeInLeft animated" data-wow-delay=".5s">
					<div class="address-grid">
						<h4 class="wow fadeIndown animated" data-wow-delay=".5s">DROP US A LINE </h4>
						<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
							<input class="wow fadeIndown animated" data-wow-delay=".6s" type="text" placeholder="Name" required name="Name">
							<input class="wow fadeIndown animated" data-wow-delay=".7s" type="text" placeholder="Email" required name="Email">
							<input class="wow fadeIndown animated" data-wow-delay=".8s" type="text" placeholder="Contact No." required name="Phone">
							<textarea class="wow fadeIndown animated" data-wow-delay=".8s" placeholder="Message" required name="Message"></textarea>
							<input class="wow fadeIndown animated" data-wow-delay=".9s" type="submit" name="SendMsg" value="SEND">
						</form>
					</div>
				</div>
				<div class="col-md-6 address-right">
					<div class="address-info wow fadeInRight animated" data-wow-delay=".5s">
						<h4>ADDRESS</h4>
						<p><?php echo Address; ?></p>
					</div>
					<div class="address-info address-mdl wow fadeInRight animated" data-wow-delay=".7s">
						<h4>PHONE </h4>
<?php
				$query="SELECT ID,PhoneNumber,Status, DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, 
				DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated
				FROM telephones WHERE Status = 1 ";
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
?>						<p><a href="callto:<?php echo $row["PhoneNumber"]; ?>"><?php echo $row["PhoneNumber"]; ?></a></p>
<?php
				}
				?>
					</div>
					<div class="address-info wow fadeInRight animated" data-wow-delay=".6s">
						<h4>MAIL</h4>
<?php
				$query="SELECT ID,EmailAddress,Status, DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, 
				DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated
				FROM emails WHERE Status = 1 ";
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
?>						<p><a href="mailto:<?php echo $row["EmailAddress"]; ?>"><?php echo $row["EmailAddress"]; ?></a></p>
<?php
				}
				?>
					</div>
				</div>
			</div>	
		</div>	
	</div>
<!--
	<div class="contact">
		<div class="container">
			<iframe class="wow zoomIn animated animated" data-wow-delay=".5s" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57537.641430789925!2d-74.03215321337959!3d40.719122105634035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1456152197129" allowfullscreen=""></iframe>
		</div>	
	</div>
-->
	<!--//contact-->	
	<!--footer-->
	<?php include("footer.php"); ?>
	<!--//footer-->		
	<!--search jQuery-->
	<script src="js/main.js"></script>
	<!--//search jQuery-->
	<!--smooth-scrolling-of-move-up-->
	<script type="text/javascript">
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