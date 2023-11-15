<?php
session_start();
include("functions/functions.php");
?>
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Bird : Home</title>
<link rel="stylesheet" href="styles/style.css" media="all">
<style>
.adminbtn {
background-color: #4CAF50; /* Green */
border: none;
color: white;
padding: 1px 2px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 14px;
cursor: pointer;
-webkit-transition-duration: 0.4s; /* Safari */
transition-duration: 0.4s;
float: right;
margin-top: 12px;
margin-left: 2px;
}
.adminbtn:hover {
box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px

50px 0 rgba(0, 0, 0, 0.19);
}
</style>
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

<span style="float: right;font-size: 18px;line-
height: 40px;">

<span class="space">
<?php
if (isset($_SESSION['customer_email'])) {
echo "<b>Welcome: </b>" .

$_SESSION['customer_email'] ;
} else {
echo "<b>Welcome Guest!</b>";
}
?>
</span>
<span class="space">
<b style="color: yellow;">Your Shopping

Cart-</b> Total Items: <?php total_items(); ?>

|| Total Price: <?php total_price(); ?>
</span>
<div class="space">
<a href="cart.php" style="color:

yellow;">Go to Cart</a>
<?php
if (!isset($_SESSION['customer_email'])) {
echo "<a href='checkout.php' style='color:

orange;'>User Login</a>";

} else {
echo "<a href='logout.php' style='color:

orange;''>Logout</a>";
}
?>

<button class="adminbtn"><a style="text-
decoration: none; color: #ffffff;"

href="admin_area/index.php">Admin Login</a></button>

</div>

</span>
</div>
<div id="packages_box">
<?php getPack(); ?>
<?php getCatPack(); ?>
<?php getTypePack(); ?>
</div>
</div>
</div>
</div>
<!--Main container ends-->
</body>
</html>