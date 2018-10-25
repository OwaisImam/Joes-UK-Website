<?php include("admin/Common.php"); ?>
<?php $CatID = 99999; ?>
<?php
if (!isset($_SESSION['Country'])) {
    $_SESSION['Country'] = '';
}
//var_dump($_SESSION['cart_items']);die;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart - <?php echo SiteTitle; ?></title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="<?php echo SiteTitle; ?>"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- //for-mobile-apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- js -->
    <script src="js/jquery.min.js"></script>
    <!-- //js -->
    <!-- cart -->
    <script src="js/simpleCart.min.js"></script>
    <!-- cart -->
    <!-- for bootstrap working -->
    <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
    <!-- //for bootstrap working -->
    <link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!-- start-smooth-scrolling -->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->


    <!--js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!--//js-->
    <!--cart-->
    <script src="js/simpleCart.min.js"></script>
    <!--cart-->
    <!--web-fonts-->
    <link
        href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
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


</head>

<body>
<!--header-->
<?php include("header.php"); ?>
<!--//header-->
<!-- banner -->
<div class="banner10" id="home1">
    <div class="container">
        <h2>Cart</h2>
    </div>
</div>
<!-- //banner -->

<!-- breadcrumbs -->
<div class="breadcrumb_dress">
    <div class="container">
        <ul>
            <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i>
            </li>
            <li>Cart</li>
        </ul>
    </div>
</div>
<!-- //breadcrumbs -->

<!-- checkout -->
<div class="checkout">
    <div class="container">
        <h3>Your shopping cart contains: <span><?php echo $cart_count; ?> Products</span></h3>

        <div class="checkout-right">
            <table class="timetable_sub">
                <thead>
                <tr>

                    <th>S No.</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Product Name</th>
                    <th>Service Charges</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <?php
                if (isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items'])) {
                    foreach ($_SESSION['cart_items'] as $cart_items) {
                        $items = explode('-', $cart_items);
                        //echo $items[3];
                        //if ($items[3] == 2) {
                            $query = "SELECT ID,ProductName,ProductNameArabic,Quantity,Image,Price,Discount,URL,Shipping FROM products WHERE Status = 1 AND ID=" . $items[0];
                            $res = mysql_query($query) or die(mysql_error());
                            $row = mysql_fetch_array($res);
                            $Image = explode(',', $row["Image"]);
                            $img1 = $Image[0];
                            ?>
                            <tr class="rem1">
                                <td class="invert"><?php echo $row['ID']; ?> </td>

                                <td class="invert-image">
                                    <a href="<?php echo $row['URL']; ?>">
                                        <img src="<?php echo 'admin/' . DIR_PRODUCTS_IMAGES . $img1 ?>" alt="<?php echo $row['ProductName']; ?>" title="<?php echo $row['ProductName']; ?>" class="img-responsive"/>
                                    </a>
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <?php echo $row['Quantity']; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert"><?php echo dboutput($row['ProductName']); ?></td>

                                <td class="invert">
                                    <?php
                                    $items = explode('-', $cart_items);
                                    if (!empty($items[4]) && $items[4] != 0) {
                                        $optionnamearray = explode(',', $items[4]);
                                        foreach ($optionnamearray as $opt) {
                                            $query = "SELECT v.ValueName,o.OptionName FROM product_options po LEFT JOIN p_options_values v ON po.ValueID = v.ID LEFT JOIN p_options o ON po.OptionID = o.ID WHERE po.ID=" . $opt;
                                            $res = mysql_query($query) or die(mysql_error());
                                            $number = mysql_num_rows($res);
                                            if ($number != 0) {
                                                while ($rowoptnam = mysql_fetch_array($res)) {
                                                    echo $rowoptnam['OptionName'] . ' : (' . $rowoptnam['ValueName'] . ')<br>';
                                                }
                                            }

                                        }
                                    } else {
                                        echo 'Not Selected any Option';
                                    }
                                    ?>

                                </td>

                                <td class="invert">
                                    <?php
                                    $Discount = $row["Discount"];
                                    $Price = $row["Price"];
                                    //var_dump($row);die;
                                    echo ($Discount != 0 ? CURRENCY_SYMBOL . ($Price - $Discount ): CURRENCY_SYMBOL . $Price);
                                    ?></td>
                                <td class="invert">
                                    <?php
                                    echo ($Discount != 0 ? CURRENCY_SYMBOL . ($row['Quantity'] * ($Price - $Discount )) : CURRENCY_SYMBOL . ($Price * $row['Quantity']));


                                    $productTotal = 0;
                                    if ($Discount != 0) {
                                        $productTotal = $optiontotal + ($Discount * $items[2]);
                                    } else {
                                        $productTotal = $optiontotal + ($Price * $items[2]);
                                    }
                                    //echo CURRENCY_SYMBOL . round($productTotal);
                                    ?>
                                </td>
                                <td class="invert">
                                    <div class="rem">
                                        <div
                                            onClick="location.href='remove_from_cart.php?id=<?php echo $row['ID']; ?>&name=<?php echo $row['ProductName']; ?>&url=<?php echo $_SERVER['REQUEST_URI']; ?>'"
                                            class="close1"></div>
                                    </div>

                                </td>
                            </tr>
                        <?php
                        //}
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            Your Cart is Empty!
                        </td>
                    </tr>
                <?php
                }
                ?>


            </table>
        </div>
        <?php
        if (isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
        {
        ?>
        <div class="checkout-left">
            <div class="checkout-left-basket">

                <a href="checkout"><h4>Continue to basket</h4></a>
                <ul>
                    <li>Sub Total <i>-</i> <span><?php echo CURRENCY_SYMBOL; ?><?php echo round($subtotal); ?> </span>
                    </li>
                    <li>
                        Owais Charges :p <span><?php if($subtotal <= 1500){ echo $owaisCharges = 200; }else{ echo $owaisCharges = 0; } ?></span>
                    </li>
                    <li>
                        Shipping Charges <i>-</i>
                        <span><?php echo CURRENCY_SYMBOL; ?><?php echo round($shippingAmount); ?></span>
                    </li>
                    <li>Total <i>-</i> <span><?php echo CURRENCY_SYMBOL; ?><?php echo round($grandtotal); ?></span></li>
                </ul>
            </div>
            <?php
            }
            ?>
            <div class="checkout-right-basket">
                <a href="index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue
                    Shopping</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


</div>
<!-- //checkout -->
<?php include "footer.php"; ?>
<script src="js/bootstrap.js"></script>
</body>
</html>