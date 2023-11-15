<?php
session_start();
if (!isset($_SESSION['customer_email'])) {

echo "<script>window.open('http://localhost:63342/travel-agency-
master/travel-agency-master/customer_register.php',
'_self')</script>";
} else {
?><!DOCTYPE html>
<html>
<head>
<title>Payment Form</title>
<style>
body {
font-family: Arial, sans-serif;
background-color: #f2f2f2;
}
form {
background-color: #fff;
max-width: 500px;

margin: 0 auto;
padding: 20px;
box-shadow: 0 0 10px #ddd;
}
input[type=text], input[type=email], select {
width: 100%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
border-radius: 4px;
box-sizing: border-box;
}
input[type=submit] {
background-color: #4CAF50;
color: #fff;
padding: 12px 20px;
border: none;
border-radius: 4px;
cursor: pointer;
}
input[type=submit]:hover {
background-color: #45a049;
}
.error {
color: red;
}
</style>
</head>
<body>
<?php
include("functions/functions.php");
include("includes/db.php");
$total=0;
global $con;
$ip = getIp();
$sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";$run_price =
mysqli_query($con, $sel_price);
while ($p_price = mysqli_fetch_array($run_price)) {
$pack_id = $p_price['p_id'];
$pack_price = "SELECT * FROM packages WHERE
package_id='$pack_id'";
$run_pack_price = mysqli_query($con, $pack_price);

while ($pp_price = mysqli_fetch_array($run_pack_price)) {
$package_price = array($pp_price['package_price']);
$package_title = $pp_price['package_title'];
$package_image = $pp_price['package_image'];
$single_price = $pp_price['package_price'];
$values = array_sum($package_price);
$total += $values;
}
}
?>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $cardnumErr = $expmonthErr = $expyearErr =
$cvvErr = "";
$name = $email = $cardnum = $expmonth = $expyear = $cvv = "";
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// validate name
if (empty($_POST["name"])) {
$nameErr = "Name is required";
} else {
$name = test_input($_POST["name"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
$nameErr = "Only letters and white space allowed";
}
}
// validate email
if (empty($_POST["email"])) {
$emailErr = "Email is required";
} else {
$email = test_input($_POST["email"]);
// check if email is valid format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format";
}

}
// validate card number
if (empty($_POST["cardnum"])) {
$cardnumErr = "Card number is required";
} else {
$cardnum = test_input($_POST["cardnum"]);
// check if card number is valid format
if (!preg_match("/^[0-9]{16}$/",$cardnum)) {
$cardnumErr = "Invalid card number format";
}
}
// validate expiration month
if (empty($_POST["expmonth"])) {
$expmonthErr = "Expiration month is required";
} else {
$expmonth = test_input($_POST["expmonth"]);
}
// validate expiration year
if (empty($_POST["expyear"])) {
$expyearErr = "Expiration year is required";
} else {
$expyear = test_input($_POST["expyear"]);
// check if expiration year is valid format
if (!preg_match("/^[0-9]{4}$/",$expyear)) {
$expyearErr = "Invalid expiration year format";
}
} // validate CVV
if (empty($_POST["cvv"])) {
$cvvErr = "CVV is required";
} else {
$cvv = test_input($_POST["cvv"]);
// check if CVV is valid format
if (!preg_match("/^[0-9]{3}$/",$cvv)) {
$cvvErr = "Invalid CVV format";
}
}
// if all validations pass, process payment
if (empty($nameErr) && empty($emailErr) && empty($cardnumErr) &&
empty($expmonthErr) && empty($expyearErr) && empty($cvvErr)) {
$sql = "INSERT INTO payments (ip, name, paid) VALUES ('$ip',

'$name', '$total')";
$run = mysqli_query($con, $sql);
if($run){ echo "<script>alert('New Payment has been INSERTED
successfully!')</script>";
}
}
}

?>
<h2 align="center">Payment Form</h2>
<form method="post" action="<?php echo
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="name">Name on card:</label>
<input type="text" id="name" name="name" value="<?php echo
$name;?>">
<span class="error"><?php echo $nameErr;?></span>
<br>
<label for="email">Email:</label>
<input type="email" id="email" name="email" value="<?php echo
$email;?>">
<span class="error"><?php echo $emailErr;?></span>
<br>
<label for="cardnum">Card number:</label>
<input type="text" id="cardnum" name="cardnum" value="<?php echo
$cardnum;?>">
<span class="error"><?php echo $cardnumErr;?></span>
<br>
<label for="expmonth">Expiration month:</label>
<select id="expmonth" name="expmonth">
<option value="">--Select Month--</option>
<option value="01" <?php if ($expmonth == "01") {echo
"selected";}?>>January</option>
<option value="02" <?php if ($expmonth == "02") {echo
"selected";}?>>February</option>
<option value="03" <?php if ($expmonth == "03") {echo
"selected";}?>>March</option>
<option value="04" <?php if ($expmonth == "04") {echo
"selected";}?>>April</option>
<option value="05" <?php if ($expmonth == "05") {echo

"selected";}?>>May</option>
<option value="06" <?php if ($expmonth == "06") {echo
"selected";}?>>June</option>
<option value="07" <?php if ($expmonth == "07") {echo
"selected";}?>>July</option>
<option value="08" <?php if ($expmonth == "08") {echo
"selected";}?>>August</option>
<option value="09" <?php if ($expmonth == "09") {echo
"selected";}?>>September</option>
<option value="10" <?php if ($expmonth == "10") {echo
"selected";}?>>October</option>
<option value="11" <?php if ($expmonth == "11") {echo
"selected";}?>>November</option>
<option value="12" <?php if ($expmonth == "12") {echo
"selected";}?>>December</option>
</select>
<span class="error"><?php echo $expmonthErr;?></span>
<br>
<label for="expyear">Expiration year:</label>
<input type="text" id="expyear" name="expyear" value="<?php echo
$expyear;?>">
<span class="error"><?php echo $expyearErr;?></span>
<br>
<label for="cvv">CVV:</label>
<input type="text" id="cvv" name="cvv" value="<?php echo
$cvv;?>">
<span class="error"><?php echo $cvvErr;?></span>
<br>
Payment:
<input type="text" value="<?php echo $total?>">
<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
<?php
}
?>