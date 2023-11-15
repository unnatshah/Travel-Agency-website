<?php
if (!isset($_SESSION['user_email'])) {
echo "<script>window.open('login.php?not_admin=You are not an
Admin!','_self')</script>";
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<title>View Packages</title>
<style type="text/css">
#thfix {
font-family: sans-serif;
padding: 4px;
}
</style>
</head>
<body>
<table width="795" align="center" bgcolor="#EAD2AC">
<tr align="center">

<td colspan="6"><h2 style="font-family: Cambria; margin-
top: 10px; margin-bottom: 5px;">View All

packages
Here</h2></td>

</tr>
<tr align="center" bgcolor="#5FCEE8">
<th id="thfix">Sl.</th>
<th id="thfix">Name</th>
<th id="thfix">Title</th>
<th id="thfix">Image</th>
<th id="thfix">Price</th>
<th id="thfix">Quantity</th>
</tr>
<?php
include("includes/db.php");
$i=0;
$cart = "SELECT customers.customer_name as cname,
packages.package_title as ptitle,
packages.package_image as img,
packages.package_price as price
FROM cart
INNER JOIN customers ON customers.customer_ip = cart.ip_add
INNER JOIN packages ON packages.package_id = cart.p_id";
$run_pack = mysqli_query($con, $cart);
while ($row_pack = mysqli_fetch_array($run_pack)) {
$pack_name = $row_pack['cname'];
$pack_title = $row_pack['ptitle'];
$pack_img = $row_pack['img'];
$pack_price = $row_pack['price'];
$pack_qt = 1;
$i++;

?>
<tr align="center">
<td><?php echo $i; ?></td>
<td><?php echo $pack_name; ?></td>
<td><?php echo $pack_title; ?></td>
<td><img src="package_images/<?php echo

$pack_img; ?>" width="40" height="40"></td>

<td><?php echo $pack_price; ?></td>
<td><?php echo $pack_qt; ?></td>
<td></td>
</tr>
<?php
}
?>
</table>
</body>
</html>
<?php
}
?>