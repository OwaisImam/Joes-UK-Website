<?php
if(isset($_POST["Subscribe"]) && $_POST["Subscribe"] == "Subscribe")
{
	$msg="";
	
	if(isset($_POST["EmailAddress"]))
		$EmailAddress=trim($_POST["EmailAddress"]);

		if($EmailAddress == "")
		{
			$msg="Please enter your email";
			?> <script>alert('<?php echo $msg; ?>');</script> <?php 
		}
		else if($msg == "")
		{
			if(mysql_num_rows(mysql_query("SELECT ID from subscribers WHERE Email='".mysql_escape_string($EmailAddress)."'")) > 0)
			{
				?> <script>alert('You are already subscribed to our newsletter!');</script> <?php 
			}
			else
			{
				$query="INSERT INTO subscribers SET 
				Email = '".dbinput($EmailAddress)."', 
				DateAdded=NOW()";
				$a=mysql_query($query) or die(mysql_error());
				if($a)
				{
					?> <script>alert('You have been subscribed to our newsletter!');</script> <?php 
				}
				else
				{
					?> <script>alert('Soory an error occured, please try again later!');</script> <?php 
				}
			}
		}
}
?>

<!-- newsletter -->
	<div class="newsletter">
		<div class="container">
			<div class="col-md-6 w3agile_newsletter_left">
				<h3>Newsletter</h3>
				<p>Subscribe to our newsletter for latest news & offers .</p>
			</div>
			<div class="col-md-6 w3agile_newsletter_right">
				<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
					<input type="email" name="EmailAddress" placeholder="Enter Your Email" required>
					<input type="submit" name="Subscribe" value="" />
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //newsletter -->

<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-3 w3_footer_grid">
					<h3>Contact</h3>
					<p>Feel free to contact us anytime anywhere</p>
					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><?php echo Address; ?><span></span></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
                        <?php
				$query="SELECT ID,EmailAddress,Status, DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, 
				DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated
				FROM emails WHERE Status = 1 ";
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
?>			<a href="mailto:<?php echo $row["EmailAddress"]; ?>"><?php echo $row["EmailAddress"]; ?></a>
<?php
				}
				?>
                        </li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
                        <?php
				$query="SELECT ID,PhoneNumber,Status, DATE_FORMAT(DateAdded, '%D %b %Y<br>%r') AS Added, 
				DATE_FORMAT(DateModified, '%D %b %Y<br>%r') AS Updated
				FROM telephones WHERE Status = 1 ";
				$result = mysql_query ($query) or die("Could not select because: ".mysql_error()); 
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
				{
?>						<a href="callto:<?php echo $row["PhoneNumber"]; ?>"><?php echo $row["PhoneNumber"]; ?></a>
<?php
				}
				?>
                        </li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Information</h3>
					<ul class="info"> 
						<li><a href="about-us">About Us</a></li>
						<li><a href="contact">Contact Us</a></li>
						<li><a href="return-policy">Return Policy</a></li>
						<li><a href="faq">FAQ's</a></li>
						<li><a href="products">Special Products</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Category</h3>
					<ul class="info"> 
						<li><a href="home">Home</a></li>
						<li><a href="men">Men</a></li>
						<li><a href="women">Women</a></li>
						<li><a href="kids">Kids</a></li>
						<li><a href="sale">Sale</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Profile</h3>
					<ul class="info"> 
						<li><a href="products.html">Summer Store</a></li>
						<li><a href="checkout.html">My Cart</a></li>
					</ul>
					<h4>Follow Us</h4>
					<div class="agileits_social_button">
						<ul>
							<?php 
					$query="SELECT ID,Image,URL
					FROM socialmedia WHERE ID <>0 AND Status = 1 ORDER BY Sort ASC Limit 5";
					$r = mysql_query($query) or die(mysql_error());
					$n = mysql_num_rows($r);
					if($n != 0)
					{
					while($row =  mysql_fetch_array($r))
					{
					?>
							<li><a href="<?php echo dboutput($row['URL']); ?>" target="_blank" class="<?php echo dboutput($row['Name']); ?>"> <img src="admin/<?php echo DIR_SOCIALMEDIA_IMAGES.dboutput($row['Image']); ?>" /></a></li>
					<?php 
					}
					}
					?>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="footer-copy">
			<div class="footer-copy1">
				<div class="footer-copy-pos">
					<a href="#home1" class="scroll"><img src="images/arrow.png" alt=" " class="img-responsive" /></a>
				</div>
			</div>
			<div class="container">
						<p>© <?php echo date('Y'); ?> <?php echo SiteTitle; ?> . All rights reserved</p>
			</div>
		</div>
	</div>
<!-- //footer -->