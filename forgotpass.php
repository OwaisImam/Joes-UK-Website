<?php include("admin/Common.php"); ?>
<?php $CatID=0; ?>
<?php
if(isset($_SESSION['LoginCustomer']) && $_SESSION['LoginCustomer']==true)
	redirect("index.php");

$Verify = array();
$CODE = "";
$msg = "";
$Email = "";
if(isset($_POST["Email"]))
{
	if(isset($_POST["Email"]))
		$Email=trim($_POST["Email"]);
	if($Email == "")
	{
		$msg = '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="fa fa-times"></i> Please enter your registered email address.
					</div>';
	}
	else if($msg == "")
	{
		$query="SELECT * FROM website_users WHERE Email='".dbinput($Email)."' AND Status = 1";
		$result = mysql_query ($query) or die("Query error: ". mysql_error()); 
		$num = mysql_num_rows($result);
		if($num==0)
		{
			$msg = '<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="fa fa-times"></i> Incorrect email address.
					</div>';
		}
		else
		{
			$row = mysql_fetch_array($result);
			$subject = "Password Recovery - " . SiteTitle;
			$to = $Email;
			$from = "Password Recovery"." <no-reply@".Domain.">";
			$message = "Dear ".$row["FirstName"]." ".$row["LastName"]."! <br/>";
			$message .= "Your login credentials for ".SiteTitle." are as follows:<br/>Email Address: <b>".$row["Email"]."</b><br/>Password: <b>".$row["Password"]. "</b><br/><br/>Regards,<br/><b>Team ".SiteTitle."</b>";
			$headers = "From: ".$from."\r\n";
			$headers .= "Return-Path: ".SiteTitle." <".EmailAddress.">"."\r\n";
			$headers .= "X-Mailer: PHP5\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL . "\r\n";
			$mail = @mail($to,$subject,$message,$headers);
			$msg='<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="fa fa-check"></i> An email has been sent to your email for password recovery. Make sure to check your Junk folder if you don\'t receive any email.
					</div>';
			$Email = "";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Forget Your Password?<?php echo SiteTitle; ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo SiteTitle; ?>" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel='shortcut icon' href='admin/<?php echo DIR_LOGOS.$_SETTINGS_Header_LOGO; ?>' type='image/x-icon' ><!--Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
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
		<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow fadeInUp" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Password Recovery</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Password<span> Recovery</span></h3>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4>Welcome ! <br> Not a Member? <a href="register.php">  Register Now »</a> </h4>
			</div>
			<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
				<?php 
				echo $msg;
				?>
				<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
					<input type="text" name="Email" value="<?php echo $Email; ?>" placeholder="E-Mail Address" id="input-email" class="user">
					<input type="submit" name="RecoverPassword" value="Recover Password">
					<div class="forgot-grid">
<!--
						<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Remember me</label>
-->
						<div class="forgot">
							Rememebr password? <a href="login" style="display: inline-block">Login now</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--//login-->

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