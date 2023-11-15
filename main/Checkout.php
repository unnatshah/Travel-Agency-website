<?php
session_start();
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Bird : Checkout</title>
<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
<div class="main_wrapper">
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/header.php'; ?>
<div class="content_wrapper">
<?php include "includes/left-sidebar.php"; ?>
<div id="content_area">
<?php cart(); ?>
<div id="shopping_cart">
<span style="float: right;font-size: 18px;padding:

5px;line-height: 40px;">
<span>
<?php
if (isset($_SESSION['customer_email'])) {
echo "<b>Welcome:

</b>".$_SESSION['customer_email'];

} else {
echo "<b>Welcome Guest:</b>";

}
?>
</span>
<span><b style="color: yellow;"><b

style='color: yellow;'> Your </b>Shopping Cart-</b>Total Items: <?php
total_items(); ?> || Total Price: <?php total_price(); ?></span> <a

href="cart.php" style="color:

yellow;">Go to Cart</a></b></span>

</div>
<div id="packages_box">
<?php
if (!isset($_SESSION['customer_email'])) {
include("includes/customer_login.php");
global $err;
echo $err;
}
?>
</div>
</div>
</div>
</div>
</body>
</html>