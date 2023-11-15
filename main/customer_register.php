<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
global $con;
$nameErr = $emailErr = $passErr = $c_imageErr = $c_image_tmpErr =
$cityErr = $conErr = $adrErr ="";
$c_name = $c_email = $c_pass = $c_passport = $c_image = $c_image_tmp
= $c_country = $c_city = $c_contact =$c_address ="" ;
$passErrs = array();
if (isset($_POST['register'])) {
$ip = getIp();
$c_name = $_POST['c_name'];
$c_email = $_POST['c_email'];
$c_pass = $_POST['c_password'];
$c_passport = $_POST['c_passport'];
$c_image = $_FILES['c_image']['name'];
$c_image_tmp = $_FILES['c_image']['tmp_name'];
$c_country = $_POST['c_country'];
$c_city = $_POST['c_city'];
$c_contact = $_POST['c_contact'];
$c_address = $_POST['c_address'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["c_name"])) {
$nameErr = "Name is required";
$flag = 1;
} else if (!preg_match("/^[a-zA-Z ]+$/", $_POST["c_name"])) {

$nameErr = "Name must contain only alphabet characters and
space.";
$flag = 1;
} else {
$c_name = test_input($_POST["c_name"]);
}
if (empty($_POST["c_city"])) {
$cityErr = "Name is required";
$flag = 1;
} else if (!preg_match("/^[a-zA-Z ]+$/", $_POST["c_city"])) {
$cityErr = "Name must contain only alphabet characters and
space.";
$flag = 1;
} else {
$c_city = test_input($_POST["c_city"]);
}
if (empty($_POST["c_address"])) {
$adrErr = "Name is required";
$flag = 1;
}
else {
$c_address = test_input($_POST["c_address"]);
}
if(empty($_POST["c_contact"])){
$conErr = "contact is required";
$flag = 1;
}else if (!preg_match('/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/',
$c_contact)) {
$conErr = 'Invalid phone number';
$flag = 1;
} else {
$c_contact= test_input($_POST["c_contact"]);
}
if(empty($_POST["c_passport"])){
$passErr = "passport id shouldnt be empty";
$flag = 1;
}
else if (!preg_match('/^[a-zA-Z0-9]{9}$/', $_POST["c_passport"]))
{

$passErr = 'Invalid passport number';
$flag = 1;
} else {
$c_passport = test_input($_POST["c_passport"]);
}
if (empty($_POST["c_email"])) {
$emailErr = "Email is required";
$flag = 1;
} else if (!filter_var($_POST["c_email"], FILTER_VALIDATE_EMAIL))
{
$emailErr = "enter valid mail";
$flag = 1;
} else {
$c_email = test_input($_POST["c_email"]);
}

if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=[\]{};':\"\\|,.<>\/?]).{8,}$/",
$_POST['c_password'])) {
$c_password = $_POST["c_password"];
} else {
$flag = 1;
if (strlen($_POST['c_password']) < 8) {
$passErrs[] = "Password must be at least 8 characters

long.";
}
if (!preg_match("/\d/", $_POST['c_password'])) {
$passErrs[] = "Password must contain at least one digit.";
}
if (!preg_match("/[a-z]/", $_POST['c_password'])) {
$passErrs[] = "Password must contain at least one

lowercase letter.";
}
if (!preg_match("/[A-Z]/", $_POST['c_password'])) {
$passErrs[] = "Password must contain at least one

uppercase letter.";
}
if (!preg_match("/[!@#$%^&*()_+\-=[\]{};':\"\\|,.<>\/?]/",

$_POST['c_password'])) {

$passErrs[] = "Password must contain at least one special

character.";
}
}
if(!$flag) {
// image will upload there
move_uploaded_file($c_image_tmp,
"customer/customer_images/$c_image");
$hash = password_hash($c_password, PASSWORD_DEFAULT);
$insert_c = "INSERT INTO customers
(customer_ip,customer_name,customer_email,customer_pass,c_passport,cu
stomer_country,customer_city,customer_contact,customer_address,custom
er_image) VALUES
('$ip','$c_name','$c_email','$hash','$c_passport','$c_country','$c_ci
ty','$c_contact','$c_address','$c_image')";
$run_c = mysqli_query($con, $insert_c);
$sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
$run_cart = mysqli_query($con, $sel_cart);
$check_cart = mysqli_num_rows($run_cart);

if ($check_cart == 0) {
$_SESSION['customer_email'] = $c_email;
echo "<script>alert('Account has been created

successfully. Thanks!')</script>";

echo "<script>window.open('index.php','_self')</script>";
} else {
$_SESSION['customer_email'] = $c_email;
echo "<script>alert('Account has been created

successfully. Thanks!')</script>";

echo

"<script>window.open('checkout.php','_self')</script>";
}
}
}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Bird : Register</title>
<link rel="stylesheet" href="styles/style.css" media="all">
<style type="text/css">
input{
padding: 5px;
margin: 5px;
border-radius: 10px;
font-size: 20px;
}
#fixm {
padding: 4px;
font-family: arial;
}
input[type="file"]{
font-size: 14px;
}
span{
color: red;
}
#fixi {
font-family: arial;
}
#btn {
border: none;
padding: 10px 10px;
text-align: center;
text-decoration: none;

display: inline-block;
font-size: 16px;
margin: 4px 2px;
transition-duration: 0.4s;
cursor: pointer;
background-color: #32E875;
color: black;
border-radius: 10px;
}
#btn:hover {
scale: 1.1;
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
<span style="float: right;font-size:

18px;padding: 5px;line-height: 40px; color: white;">Welcome Guest!

<span style="color: white;"><b
style="color: yellow;">Shopping

Cart-</b> Total Items: <?php total_items(); ?> || Total Price: <?php
total_price(); ?> <a

href="cart.php" style="color:

yellow;"></span>Go to Cart</a></b></span>

</div>
<form action="customer_register.php" method="post"

enctype="multipart/form-data">

<table align="center" width="750" style="margin-
top: 20px;">

<tr align="center">
<td colspan="6">

<h2 style="margin-bottom: 15px; font-
family: Cambria;">Create an Account</h2>

</td>
</tr>
<tr>

<td align="right" id="fixm">Your

Name:</td>

<td><input id="fixi" type="text"

name="c_name" value="<?php echo $c_name?>"
required=""><span>*</span></td>
</tr>
<tr>
<td align="center"
colspan="2"><span><?php echo $nameErr;?></span></td>

</tr>
<tr>
<td align="right" id="fixm">Your

Email:</td>

<td><input type="email" name="c_email"

value="<?php echo $c_email?>" required=""><span>*</span></td>

</tr>
<tr>
<td align="center"
colspan="2"><span><?php echo $emailErr;?></span></td>

</tr>
<tr>
<td align="right" id="fixm">Your

Password:</td>

<td><input id="fixi" type="password"

name="c_password" value="<?php echo $c_pass?>"
required=""><span>*</span></td>
</tr>
<tr>
<td colspan="2" id="fixi"

align="center"><span>

<?php
if (count($passErrs) > 0) {
echo "Password is invalid.

Suggestions:";

foreach ($passErrs as $error)

{

echo "<br/> " . $error;
}
}
?>
</span></td>
</tr>

<tr>
<td align="right" id="fixm">Your Passport

ID:</td>

<td><input type="text" name="c_passport"
value="<?php echo $c_passport?>" required=""><span>*</span></td>

</tr>
<tr>
<td align="center"
colspan="2"><span><?php echo $passErr;?></span></td>

</tr>
<tr>
<td align="right" id="fixm">Your

Image:</td>

<td><input id="fixi" type="file"

name="c_image" value="<?php echo $c_image?>
required="""><span>*</span></td>
</tr>
<tr>
<td align="center"
colspan="2"><span><?php echo $c_imageErr;?></span></td>

</tr>
<tr>
<td align="right" id="fixm">Your

Country:</td>

<td>
<select name="c_country"

required="">Select a

<option>Bangladesh</option>
<option>India</option>
<option>Japan</option>
<option>China</option>
<option>Russia</option>
<option>Portugal</option>
<option>England</option>
<option>Brazil</option>
<option>Spain</option>
<option>France</option>
<option>Switzerland</option>
<option>Croatia</option>
<option>Argentina</option>
</select>
<span>*</span>
</td>
</tr>

<tr>
<td align="right" id="fixm">Your

City:</td>

<td><input id="fixi" type="text"
name="c_city" value="<?php echo $c_city;?>" required="">

<span>*</span></td>
</tr>
<tr>
<td align="center"
colspan="2"><span><?php echo $cityErr;?></span></td>

</tr>
<tr>
<td align="right" id="fixm">Your

Contact:</td>

<td><input id="fixi" type="text"
name="c_contact" value="<?php echo $c_contact;?>" required="">

<span>*</span></td>
</tr>
<tr>
<td align="center"
colspan="2"><span><?php echo $conErr;?></span></td>

</tr>
<tr>
<td align="right" id="fixm">Your

Address:</td>

<td><input id="fixi" type="text"
name="c_address" value="<?php echo $c_address;?>" required="">

<span>*</span></td>
</tr>
<tr>
<td align="center"
colspan="2"><span><?php echo $adrErr;?></span></td>

</tr>
<tr align="center">
<td colspan="6"><input id="btn"
type="submit" name="register" value="Create Account">

</td>
</tr>
<tr align="center">
<td colspan="6" style="font-size: 25px;">
already have an id? <a style="color:

black;" href="checkout.php">login here</a>

</td>
</tr>

</table>
</form>
</div>
</div>
</div>
</body>
</html>