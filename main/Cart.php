<?php
session_start();
$total = 0;
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Bi rd : Cart</title>
<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>

<!--Main container starts here-->
<div class="main_wrapper">
<!--Header starts here-->
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/header.php'; ?>
<!--Header ends here-->
<!--Navbar starts here-->
<!--Navbar ends here-->
<!--Content starts here-->
<div class="content_wrapper">
<!--left-sidebar starts-->
<?php include "includes/left-sidebar.php"; ?>
<!--left-sidebar ends-->
<div id="content_area">
<?php cart(); ?>
<div id="shopping_cart">
<span style="float: right;font-size: 18px;padding:

5px;line-height: 40px;">
<?php
if (isset($_SESSION['customer_email'])) {
echo "Welcome:

".$_SESSION['customer_email']."<b style='color: yellow;'> Your</b>";

} else {
echo "<b>Welcome Guest:</b>";
}
?>
<span style="color: white;"><b style="color:
yellow;">Shopping Cart-</b> Total Items: <?php total_items(); ?>

|| Total Price: <?php

total_price(); ?></span>

<span><a href="index.php" style="color:

yellow;">Back to Shop</a>
<?php
if (!isset($_SESSION['customer_email'])) {
echo "<a href='checkout.php' style='color:

orange;'>Login</a>";

} else {
echo "<a href='logout.php' style='color:

orange;''>Logout</a>";
}
?>
</span>
</span>
</div>

<div id="packages_box">
<?php
global $con;
$ip = getIp();
$sel_price = "SELECT * FROM cart WHERE

ip_add='$ip'";

$run_price = mysqli_query($con, $sel_price);
if(mysqli_num_rows($run_price)){
?>
<form action="" method="post"

enctype="multipart/form-data">

<table align="center" width="700px"

style="border-radius: 10px; margin-top: 10px; padding: 15px;"
bgcolor="#db7093">

<tr align="center">
<th>Remove</th>
<th>Package(s)</th>
<th>Quantity</th>
<th>Total Cost</th>
</tr>
<?php

while ($p_price =

mysqli_fetch_array($run_price)) {

$pack_id = $p_price['p_id'];
$pack_price = "SELECT * FROM packages

WHERE package_id='$pack_id'";

$run_pack_price = mysqli_query($con,

$pack_price);

while ($pp_price =

mysqli_fetch_array($run_pack_price)) {

$package_price =

array($pp_price['package_price']);

$package_title =

$pp_price['package_title'];

$package_image =

$pp_price['package_image'];

$single_price =

$pp_price['package_price'];

$values =

array_sum($package_price);

$total += $values;
?>
<tr align="center">
<td><input type="checkbox"
name="remove[]" value="<?php echo $pack_id; ?>"></td>

<td>
<?php echo

$package_title; ?><br>

<img

src="admin_area/package_images/<?php echo $package_image; ?>"

width="60px"

height="60px">

</td>
<td>1
</td>
<td>
<?php echo "Rs." .

$single_price; ?>

</td>
</tr>
<?php
}
}
?>
<tr align="right">
<td colspan="4"><b>Sub

Total:</b></td>

<td>
<?php echo "Rs." . $total; ?>
</td>
</tr>
<tr align="center">
<td colspan="3"><input type="submit"

name="update_cart" value="Update Cart"></td>

<td>
<button><a href="checkout.php"
style="text-decoration:

none; color: black;">Checkout</a></button>
</td>
</tr>
<tr>
<td height="80px" colspan="5">

<button disabled="true"><a

id="buy" href="payment.php">buy</a></button>
</td>
</tr>
</table>
</form>
<?php
}
else

echo "<h1 style='text-align: center; margin-
top: 25px;'>nothing to display.

..</h1>";

?>
<?php
function updatecart()
{
global $con;
$ip = getIp();
if (isset($_POST['update_cart'])) {
foreach ($_POST['remove'] as $remove_id)

{

$delete_package = "DELETE FROM cart

WHERE p_id='$remove_id' AND ip_add='$ip'";

$run_delete = mysqli_query($con,

$delete_package);

if ($run_delete) {
echo

"<script>window.open('cart.php','self')</script>";

}
}
}
if (isset($_POST['continue'])) {
echo

"<script>window.open('index.php','self')</script>";

}
}
echo @$up_cart = updatecart();

?>
</div>
</div>
</div>
</div>
<!--Main container ends here-->
</body>
</html>