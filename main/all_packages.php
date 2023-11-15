<?php
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Bird : All Packages</title>
<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
<div class="main_wrapper">
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/header.php'; ?>
<div class="content_wrapper">
<?php include "includes/left-sidebar.php"; ?>
<div id="content_area">
<div id="shopping_cart">

<span style="font-size: 18px;padding: 5px;line-
height: 40px;">Welcome Guest! <span><b

style="color: yellow;">Shopping Cart-
</b> Total Items: <?php total_items(); ?> || Total Price: <?php
total_price(); ?></span><a href="cart.php"
style="color: yellow;">Go to Cart</a></b></span>

</div>
<div id="packages_box">
<?php
$get_pack = "SELECT * FROM packages";
$run_pack = mysqli_query($con, $get_pack);
while ($row_pack = mysqli_fetch_array($run_pack)) {
$pack_id = $row_pack['package_id'];
$pack_cat = $row_pack['package_cat'];
$pack_type = $row_pack['package_type'];
$pack_title = $row_pack['package_title'];
$pack_price = $row_pack['package_price'];
$pack_image = $row_pack['package_image'];
echo "
<div id='single_package'>

<h3 style='font-family: Cambria; margin-
bottom: 2px;'>$pack_title</h3>

<img

src='admin_area/package_images/$pack_image' width='180' height='180'>

<p><b> Cost Rs $pack_price</b></p>
<a href='details.php?pack_id=$pack_id'

style='float: left; font-size:18px;text-decoration:
none;'>Details</a>

<a href='index.php?pack_id=$pack_id'><button

style='float: right; font-size:14px; cursor: pointer; padding: 2px
4px;'>Book</button></a>
</div>
";
}
?>
</div>
</div>
</div>
</div>
</body>
</html>